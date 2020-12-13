<html>
<head>
<title>Список работ</title>
</head>
<body>
<h3>Список работ</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<?php
include ("../connection.php");
$idkhr = mysql_real_escape_string($_GET["idkhr"]);
echo '<h4><a href="work.php?idkhr='.$idkhr.'">Добавить новую работу</a><h4>';
$where = "";
if ($idkhr != 0) {
	$where = " WHERE `khr_id`='".$idkhr."'"; 
};	
$query = "SELECT * FROM `work`".$where;
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
	$idwork = $row['id'];
	echo '<td><a href="work.php?idwork='.$idwork.'">'.htmlspecialchars(stripslashes($title)).'</a></td>';
    echo "	<td>".$row['begin_cur']."</td>";
	echo "</tr>";
	
		
};
mysql_close($dbh);
?>
</table>
</body>
</html>
