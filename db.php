<?php

$host = 'localhost';
$database = 'my_db';
$user = 'root';
$pswd = '';
$dbh = mysql_connect($host, $user, $pswd) or die('Не могу соединиться c MySql');
mysql_select_db($database, $dbh) or die('no DB');
mysql_query("SET NAMES 'utf-8'");

?>