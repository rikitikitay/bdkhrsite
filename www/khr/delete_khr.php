<?php
include ("../connection.php");
$id = mysql_real_escape_string($_GET["id"]);
if ($id != 0) {  
	$query = "DELETE FROM `khr` WHERE `id`='".$id."'";
	$sql = mysql_query($query) or die(mysql_error());
	if ($sql) 
	{
		echo '�������� ������ �������';
	}
	else 
	{
		echo '�������� �� �������';
	};

};
mysql_close($dbh);
?>