<html>
<head>
<title>������ �����</title>
</head>
<body>
<h3>������ �����</h3>
<table>
<?php
include ("../connection.php");
$idkhr = mysql_real_escape_string($_GET["idkhr"]);
echo '<h4><a href="work.php?idkhr='.$idkhr.'">�������� ����� ������</a><h4>';
$where = "";
if ($idkhr != 0) {
	$where = " WHERE `khr_id`='".$idkhr."'"; 
};	
$query = "SELECT * FROM work".$where;
$res = mysql_query($query);
if (mysql_num_rows($res) != 0) {
	echo "<tr>
		<td>�����</td>
		<td>��� �������</td>
		<td>��������</td>
		<td>���� ������ (�������)</td>
		
	</tr>";
} else {
	echo "����� ���� ��� �����";	
};
while($row = mysql_fetch_array($res))
{
	if (!$row['type']) {	
		$type = "������";
	}	
	else {	
		$type = "�������";	
	};
	$title = $row['title'];
	if (strlen($title) == 0) {
		$title = '��� ��������';
	};	
	echo "<tr>
		<td>".$row['num']."</td>";
	echo "	<td>$type</td>";
	$idwork = $row['id'];
	echo '<td><a href="work.php?idwork='.$idwork.'&idkhr='.$idkhr.'">'.htmlspecialchars(stripslashes($title)).'</a></td>';
	echo "	<td>".$row['begin_cur']."</td>";
	echo "</tr>";
	
		
};
mysql_close($dbh);
?>
</table>
</body>
</html>
