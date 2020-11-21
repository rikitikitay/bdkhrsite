<?php
include("../connection.php");
$number = mysql_real_escape_string($_GET["number"]);
$title = mysql_real_escape_string($_GET["title"]);
$order = mysql_real_escape_string($_GET["order"]);
$begin = $_GET["begin"];
$id = mysql_real_escape_string($_GET["id"]);
if ($id != 0) {  
	$query = "UPDATE `khr` SET `order`= '".$order."', `num`= '".$number."', `title`= '".$title."', `begin`='".$begin."'  WHERE id='".$id."'";
	$sql = mysql_query($query) or die(mysql_error());
	if ($sql) 
	{
		echo 'Редактирование прошло успешно';
	}
	else 
	{
		echo 'Редактирование не удалось';
	};
} else {
	$query = "INSERT INTO `khr`(`id`, `order`, `num`, `title`, `begin`) VALUES (NULL,'".$order."','".$number."','".$title."','".$begin."')";
	$sql = mysql_query($query) or die(mysql_error());
	if ($sql) 
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
