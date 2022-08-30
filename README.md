
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


# Visma API

This is a lightweight concept of how to setup a web server serving a Restful Web API for your data stored in Visma Administration.

Note: This proof of concept and any of the instructions do not encourage you to make any changes to the database.

Disclaimer: This contribution is provided without support and should be used at your own risk.
Do not underestimate the harm that can be caused by gaining accessing to your Visma installation and data.


## How To Install Visma RESTful Web API

For this example we will place this project in `C:\VismaAPI\`.

1. Download ZIP archive of PHP for Windows from https://windows.php.net/. For this example we are using `VS16 x64 Thread Safe`.

  Example: https://windows.php.net/downloads/releases/php-8.0.11-nts-Win32-vs16-x64.zip

  Extract the contents to the directory `C:\VismaAPI\php\`.

2. Download the Microsoft SQL Server Drivers for PHP. Make sure it's the corresponding version of your Visma installation, e.g. `SQL Server 2017`.

  SQL Server 2016: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2016
  SQL Server 2017: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2017
  SQL Server 2019: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15

  The downloaded executable file will let you extract the contents to a temporary destination. For this example we are using `C:\Users\Me\Downloads\SQLSRV\`

3. Copy the following file:

  C:\Users\Me\Downloads\SQLSRV\php_sqlsrv_80_ts_x64.dll   =>   C:\VismaAPI\php\ext\php_sqlsrv.dll

  (You may now safely delete the temporary folder C:\Users\Me\Downloads\SQLSRV\)

5. Open settings.ini and edit the database name and secret key.

  secret_key = b14fc93bfb16230565419b66de0f447c   ; Make this one up
  sql.database = SPCS_Adm_Ovnbol1000

6. Start the webserver by executing `C:\VismaAPI\start.cmd`

7. Try accessing the web API with your web browser. Authentication is not required for localhost.

  GET https://127.0.0.1:8668/invoices
  GET https://127.0.0.1:8668/invoices?page=2
  GET https://127.0.0.1:8668/invoices/123456

8. To allow external requests over the web you need to make sure the HTTP TCP port is accessable from the web. This usually mean in has to be opened in firewalls.


## How to execute the server

Execute `start.cmd`.


## How to make modify the API:

Edit `api.php` with your favourite editor.


## How to change the listening port 8668

1. Make sure the server is not running.

2. Edit `C:\VismaAPI\start.cmd` with your favourite text editor and change 8668 to something else.

3. Now execute `start.cmd`.


## How to install as a Windows service

1. Download ((https://nssm.cc/|NSSM)) and place the nssm.exe executable in the folder `C:\VismaAPI\`.

2. Execute `service_install.cmd`.

Your service can now be maintained in Windows Service Manager. Click Start and type `services` to access the Service Manager.


## How to find your database name or inspect table data

You can use HeidiSQL to confirm that the SQL server is accessable and inspect the database tables.
To do this you can download HeidiSQL and connect with the following credentials:

  Network Type: Microsoft SQL Server (Named pipe)
  Library: MSOLEDBSQL
  Hostname / IP: localhost\VISMA
  [x] Use Windows Authentication

  When successfully connected make note of the database name.


## How to add an ODBC Data Source for use with Heidi SQL

Click **Start** and type ODBC. Open "Data Sources (ODBC)".

  Under the tab "User DSN" click the button "Add".

  Select "ODBC Driver 11 for Microsoft SQL" and click the button "Complete".

  Specifically give the new Data Source the following configuration, aside from what is already predefined:

    Name: Visma API
    Server: localhost\VISMA

    Click the button "Next"

    [x] Use Integrated Windows Authentication

    Application Intent: READONLY


## Trobleshoot: Error SQLSetConnectAttr failed

Try updating your ODBC drivers to the very latest:

  https://docs.microsoft.com/en-us/sql/connect/odbc/download-odbc-driver-for-sql-server?view=sql-server-2017
