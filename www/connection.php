<?php
$host='localhost';
$database='bdkhr'; 
$user='root'; 
$pswd=''; 
 
$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
mysql_select_db($database) or die("Не могу подключиться к базе.");
mysql_query ('SET NAMES cp1251');
?>