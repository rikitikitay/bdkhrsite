<?php
include ("../connection.php");
$idkhr = mysql_real_escape_string($_GET["idkhr"]);
if ($idkhr != 0) {  
	$query = "DELETE FROM `khr` WHERE `id`='".$idkhr."'";
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
