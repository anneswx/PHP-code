<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_webconn = "localhost";
$database_webconn = "system";
$username_webconn = "root";
$password_webconn = "admin";
$webconn = mysql_pconnect($hostname_webconn, $username_webconn, $password_webconn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>