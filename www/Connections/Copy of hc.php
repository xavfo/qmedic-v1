<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hc = "localhost";
$database_hc = "hc";
$username_hc = "root";
$password_hc = "root";
$hc = mysql_pconnect($hostname_hc, $username_hc, $password_hc) or trigger_error(mysql_error(),E_USER_ERROR); 
?>