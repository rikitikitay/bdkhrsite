<?php
include("../connection.php");
$number = mysql_real_escape_string($_GET["number"]);
$title = mysql_real_escape_string($_GET["title"]);
$order = mysql_real_escape_string($_GET["order"]);
$begin = $_GET["begin"];
$idkhr = mysql_real_escape_string($_GET["idkhr"]);
if ($idkhr != 0) {  
	$query = "UPDATE `khr` SET `order`= '".$order."', `num`= '".$number."', `title`= '".$title."', `begin`='".$begin."'  WHERE id='".$idkhr."'";
	$res = mysql_query($query) or die(mysql_error());
	if ($res) 
	{
		echo 'Редактирование прошло успешно';
	}
	else 
	{
		echo 'Редактирование не удалось';
	};
} else {
	$query = "INSERT INTO `khr`(`id`, `order`, `num`, `title`, `begin`) VALUES (NULL,'".$order."','".$number."','".$title."','".$begin."')";
	$res = mysql_query($query) or die(mysql_error());
	if ($res) 
	{
		echo 'Добавление прошло успешно';
	}
	else 
	{
		echo 'Добавление не удалось';
	};	
}
mysql_close($dbh);
?>
