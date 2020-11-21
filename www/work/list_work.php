<html>
<head>
<title>Список работ</title>
</head>
<body>
<h3>Список работ</h3>
<table>
<?php
include ("../connection.php");
echo '<h4><a href="work.php?id='; echo $id; echo '">Добавить новую работу</a><h4>';
$id = mysql_real_escape_string($_GET["id"]);
$where = "";
if ($id != 0) {
	$where = " WHERE `id_khr`='".$id."'"; 
};	
$query = "SELECT * FROM work".$where;
$res = mysql_query($query);
if (mysql_num_rows($res) != 0) {
	echo "<tr>
		<td>Номер</td>
		<td>Тип позиции</td>
		<td>Название</td>
		<td>Дата начала (текущая)</td>
		
	</tr>";
} else {
	echo "Здесь пока нет работ";	
};
while($row = mysql_fetch_array($res))
{
	if (!$row['type']) {	
		$type = "Работа";
	}	
	else {	
		$type = "Доплата";	
	};
	$title = $row['title'];
	if (strlen($title) == 0) {
		$title = 'Без названия';
	};	
	echo "<tr>
		<td>".$row['num']."</td>";
	echo "	<td>$type</td>";
	$id = $row['id'];
	echo '<td><a href="work.php?id='; echo $id; echo '">'.$title.'</a></td>';
	echo "	<td>".$row['begin_cur']."</td>";
	echo "</tr>";
	
		
};
mysql_close($dbh);
?>
</table>
</body>
</html>
