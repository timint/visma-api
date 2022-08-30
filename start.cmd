@echo off
title VISMA Restful API Server
cls
echo.
echo    #####################     ########     #################################
echo    #####################     ########     ####################################
echo    #####################     ########     ######################################
echo    #####################                  ########################################
echo                 ########                  ########                       ##########
echo                 ########     ########     ########     ########            ########
echo                 ########     ########     ########     ########            #########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo                 ########     ########     ########     ########             ########
echo.
echo                                                   https://www.tim-international.net/
echo.

echo Loading VISMA Restful API Server... Press Ctrl + C to shutdown
echo.

FOR /F "tokens=* USEBACKQ" %%i IN (`php\php.exe -r "preg_match('#^(?<!;)http\.port\s*=\s*(.+?)\s*$#m', file_get_contents('settings.ini'), $matches); echo $matches[1];"`) DO (SET http.port=%%i)
php\php.exe -c php\php.ini -S 0.0.0.0:%http.port% -t .\ api.php
