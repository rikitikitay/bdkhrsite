<?php
$host='localhost';
$database='bdkhr'; 
$user='root'; 
$pswd=''; 
 
$dbh = mysql_connect($host, $user, $pswd) or die("�� ���� ����������� � MySQL.");
mysql_select_db($database) or die("�� ���� ������������ � ����.");
mysql_query ('SET NAMES cp1251');
?>
