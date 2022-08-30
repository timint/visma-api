<?php

	/**
	 * Visma RESTful Web API
	 * Author: T. Almroth (info@tim-international.net)
	 * Created in 2021
	 */

	$settings = parse_ini_file('settings.ini');

	######################################################################
	## Application
	######################################################################

	ob_start();

	$timestamp = microtime(true);

	function sqlsrv_escape($data) {
		if (!isset($data) or empty($data) ) return '';
		if (is_numeric($data)) return $data;

		$non_displayables = array(
			'/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
			'/%1[0-9a-f]/',             // url encoded 16-31
			'/[\x00-\x08]/',            // 00-08
			'/\x0b/',                   // 11
			'/\x0c/',                   // 12
			'/[\x0e-\x1f]/'             // 14-31
		);
		foreach ($non_displayables as $regex) $data = preg_replace($regex, '', $data);
		$data = str_replace("'", "''", $data);
		return $data;
	}

	function unparse_url(array $parsed): string {
		$parsed['scheme'] = isset($parsed['scheme']) ? $parsed['scheme'] : (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'off') ? 'https' : 'http');
		$parsed['host'] = !empty($parsed['host']) ? $parsed['host'] : $_SERVER['HTTP_HOST'];
		$parsed['path'] = !empty($parsed['path']) ? $parsed['path'] : parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$parsed['query'] = !empty($parsed['query']) ? (is_array($parsed['query']) ? http_build_query($parsed['query'], '&') : $parsed['query']) : '';

		return strtr('scheme://host'. (!empty($parsed['port']) ? ':'.$port : '') .'path' . (!empty($parsed['query']) ? '?'.$parsed['query'] : ''), $parsed);
	}

	ini_set('date.timezone', $settings['timezone']);
	ini_set('display_errors', $settings['display_errors']);

	try {

	// Require PHP version
		if (version_compare(PHP_VERSION, '5.4', '<')){
			throw new Exception('Detected PHP version '. PHP_VERSION .' while 5.4 is the minimum version required.');
		}

	// Fix float precision issue in PHP 7.1
		if (version_compare(phpversion(), '7.1', '>=')) {
			ini_set('serialize_precision', 4);
		}

		$incoming_data = file_get_contents('php://input');

		if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
			if (empty($_SERVER['HTTP_AUTHENTICATION'])) {
				throw new Exception('Missing HTTP header: Authentication', 400);
			}

			if ($_SERVER['HTTP_AUTHENTICATION'] != $settings['secret_key']) {
				throw new Exception('Access denied as the authentication key was not recognized', 401);
			}
		}

	// Connect to database
		if (!$conn = sqlsrv_connect($settings['sql.named_pipe'], [
			'Database' => $settings['sql.database'],
			//'UID' => $settings['sql.user'],
			//'PWD' => $settings['sql.password'],
			'CharacterSet' => 'UTF-8',
			'ReturnDatesAsStrings' => true]
		)) {
			if ($errors = sqlsrv_errors()) {
				throw new Exception('Cannot connect to database: '. $errors[0]['message'], 500);
			} else {
				throw new Exception('Cannot connect to database for unknown reason', 500);
			}
		}

		$json = [];

		switch(true) {

		//--------------------------------------------------------------------
		// Return a list of Invoices
		//--------------------------------------------------------------------

			case preg_match('#/invoices/?(\?|$)#', $_SERVER['REQUEST_URI']):

				if ($_SERVER['REQUEST_METHOD'] != 'GET') {
					throw new Exception('This resource does only support HTTP GET requests', 400);
				}

				if (empty($_GET['page']) || is_numeric($_GET['page'])) $_GET['page'] = 1;

				$query = (
					"SELECT
						DOKNR as id,
						ERORDER as order_id,
						CAST(REV AS INTEGER) AS REV,
						TOTALT as total_amount,
						SENBETDAT as last_paid,
						(CASE WHEN (SALDO_KR > 0) THEN 'unpaid' ELSE 'paid' END) as status,
						SALDO_KR as remaining,
						DATUM3 as updated_at,
						DATUM1 as created_at
					FROM dbo.OOF
					WHERE DOKNR != ''
					". (!empty($_GET['query']) ? "AND ERORDER like '%". sqlsrv_escape($_GET['query']) ."%'" : "") ."
					". (!empty($_GET['order_id']) ? "AND ERORDER = '". sqlsrv_escape($_GET['order_id']) ."'" : "") ."
					". (!empty($_GET['from_date']) ? "AND DATUM1 > '". date('Y-m-d H:i:s', strtotime($_GET['from_date'])) ."'" : "") ."
					ORDER BY DATUM1 DESC;"
				);

				if ($stmt = sqlsrv_query($conn, $query, [], ['Scrollable' => SQLSRV_CURSOR_STATIC])) {

					if (!empty($_GET['page']) && $_GET['page'] > 1) {
						sqlsrv_fetch($result_set, SQLSRV_SCROLL_ABSOLUTE, ($_GET['page'] -1) * $settings['items_per_page'] - 2);
					}

					while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

						$json[] = [
							'id'            => $row['id'],
							'status'        => $row['status'],
							'total_amount'  => (float)$row['total_amount'],
							//'remaining'     => (float)$row['remaining'],
							'last_paid,'    => $row['last_paid'] ? date('c', strtotime($row['last_paid'])) : null,
							'updated_at'    => date('c', strtotime($row['updated_at'])),
							'created_at'    => date('c', strtotime($row['created_at'])),
						];

						if (count($json) == $settings['items_per_page']) break;
					}

					$links = [];
					$num_rows = sqlsrv_num_rows($stmt);
					$num_pages = ceil($num_rows / $settings['items_per_page']);

					if (!empty($_GET['page']) && $_GET['page'] < $num_pages) {
						$links[] = '<'. unparse_url(['query' => 'page='.($_GET['page']+1)]) .'>; rel="next"';
					}

					if ($num_pages > 1) {
						$links[] = '<'. unparse_url(['query' => 'page='.$num_pages]) .'>; rel="last"';
					}

					if (!empty($links)) header('Link: '. implode(',', $links));

					sqlsrv_free_stmt($stmt);

				} else if ($errors = sqlsrv_errors()) {
					throw new Exception($errors[0]['message'], 500);
				}

				break;

		//--------------------------------------------------------------------
		// Return an Invoice
		//--------------------------------------------------------------------

			case preg_match('#/invoices/([0-9]+)$#', $_SERVER['REQUEST_URI'], $matches):

				if ($_SERVER['REQUEST_METHOD'] != 'GET') {
					throw new Exception('This resource does only support HTTP GET requests', 400);
				}

				$query = (
					"SELECT TOP 1
						i.*,
						i.DOKNR as id,
						CAST(i.REV AS INTEGER) AS REV,
						i.TOTALT as total_amount,
						i.DATUM3 as updated_at,
						i.DATUM1 as created_at
					FROM dbo.OOF AS i
					WHERE i.DOKNR = '". sqlsrv_escape($matches[1]) ."';"
				);

				if ($stmt = sqlsrv_query($conn, $query)) {

					if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
						$json[] = $row;
					} else {
						throw new Exception('Could not find invoice in database', 404);
					}

				} else if ($errors = sqlsrv_errors()) {
					throw new Exception($errors[0]['message'] . var_export($errors, true), 500);
				}

				sqlsrv_free_stmt($stmt);

				break;

			default:
				throw new Exception('Unknown resource', 404);
		}

		if ($buffer = ob_get_clean()) {
			if (trim($buffer) != '') {
				//throw new Exception('Unexpected buffer output: '. $buffer, 500);
				throw new Exception('Unexpected buffer output', 500);
			}
		}

	} catch (Exception $e) {
		http_response_code($e->getCode());
		$json = ['error' => $e->getMessage()];
	}

	if (!empty($pretty_print)) {
		$json = json_encode($json, JSON_PRETTY_PRINT);
	} else {
		$json = json_encode($json);
	}

	if ($json === false) {
		$json = '{"error":"Unknown error while encoding JSON"}';
	}

	$date = date('r');

	header('Date: '.$date);
	header('Content-Type: application/json; charset=UTF-8');
	//header('Content-Length: '.strlen($json));
	header('X-Runtime: '.round(microtime(true) - $timestamp, 3));

	echo $json;
	exit;
