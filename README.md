```

 ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
 ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
 ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
 ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓                  ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓                  ▓▓▓▓▓▓▓▓                       ▓▓▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓            ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓            ▓▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓
              ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓     ▓▓▓▓▓▓▓▓             ▓▓▓▓▓▓▓▓

                                                https://www.tim-international.net/
```

# Visma API – A RESTful Web API for Visma Administration

This is a lightweight proof of concept of how to setup a web server serving a Restful Web API using PHP for your data stored in Visma Administration.

Note: This concept or any of the instructions for setting it up do not encourage you to make any changes to the database.

**Disclaimer: This contribution is provided without support or guarantees and should be used at your own risk.
Do not underestimate the harm that can be done by gaining accessing to your Visma installation and data.**


## How To Install Visma

For this example we will place this project in `C:\VismaAPI\`.

1. Download this repository from the link https://github.com/timint/visma-api/archive/refs/heads/main.zip and extract it to `C:\VismaAPI\`.

2. Download ZIP archive of PHP for Windows from https://windows.php.net/. For this example we are using `VS16 x64 Thread Safe`.

  Example: https://windows.php.net/downloads/releases/php-8.1.10-Win32-vs16-x64.zip

  Extract the contents to the directory `C:\VismaAPI\php\`.

3. Download the Microsoft SQL Server Drivers for PHP. Make sure it's the corresponding version of your Visma installation, e.g. `SQL Server 2017`.

  * SQL Server 2016: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2016
  * SQL Server 2017: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2017
  * SQL Server 2019: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15

  The downloaded executable file will let you extract the contents to a temporary destination. For this example we are using `C:\Users\Me\Downloads\SQLSRV\`

4. Copy the following file:

    C:\Users\Me\Downloads\SQLSRV\php_sqlsrv_80_ts_x64.dll   =>   C:\VismaAPI\php\ext\php_sqlsrv.dll

  (You may now safely delete the temporary folder C:\Users\Me\Downloads\SQLSRV\)

5. Open settings.ini and edit the database name and secret key.

```
secret_key = 0123456789abcdef0123456789abcdef   ; Make this one up
sql.database = SPCS_Adm_Ovnbol1000              ; The Visma database name for your company profile
```

6. Start the webserver by executing `C:\VismaAPI\start.cmd`

7. Try accessing the web API with your web browser. Authentication is not required for localhost.

  * GET https://127.0.0.1:8668/invoices
  * GET https://127.0.0.1:8668/invoices?page=2
  * GET https://127.0.0.1:8668/invoices/123456

  Accessing the API from an external email address. Send the HTTP Authentication header along with the secret key:

    Authentication: 0123456789abcdef0123456789abcdef

8. To allow external requests over the web you need to make sure the HTTP TCP port is accessable from the web. This usually means it has to be permitted in firewalls.


## How to start the server

Execute the file `start.cmd`.


## How to modify the API:

Edit `api.php` with your favourite editor.


## How to change the listening port 8668

1. Make sure the server is not running.

2. Edit `C:\VismaAPI\settings.ini` with your favourite text editor. Change 8668 to something else.

3. Now start again by executing `start.cmd`.


## How to install as a Windows service

1. Download [NSSM](https://nssm.cc/) and place the nssm.exe executable in the folder `C:\VismaAPI\`.

2. Execute `service_install.cmd`.

Your service can now be maintained in Windows Service Manager. Go to Windows Start Menu and type `services` to access the Service Manager.
For instance you can configure the Windows Service to start automatically upon computer reboot.


## How to find your database name or inspect table data

You can use [HeidiSQL](https://www.heidisql.com/) to confirm that the SQL server is accessable and to inspect the database tables.
To do so, download and install HeidiSQL. Try connecting with the following details:

    Network Type: Microsoft SQL Server (Named pipe)

    Library: MSOLEDBSQL

    Hostname / IP: localhost\VISMA

    [x] Use Windows Authentication

  When successfully connected make note of the database name.


## How to add an ODBC Data Source for use with Heidi SQL

1. Click **Start** and type ODBC. Open "Data Sources (ODBC)".

2. Under the tab "User DSN" click the button "Add".

3. Select "ODBC Driver 11 for Microsoft SQL" and click the button "Complete".

4. Specifically give the new Data Source the following configuration, aside from what is already predefined:

    Name: Visma API
    Server: localhost\VISMA

    Click the button "Next"

    [x] Use Integrated Windows Authentication

    Application Intent: READONLY


## Trobleshoot: Error SQLSetConnectAttr failed

Try updating your ODBC drivers to the very latest:

  https://docs.microsoft.com/en-us/sql/connect/odbc/download-odbc-driver-for-sql-server?view=sql-server-2017
