<html>
<head>
<title>������ �����</title>
</head>
<body>
<h3>������ �����</h3>
<table>
<?php
include ("../connection.php");
$id = mysql_real_escape_string($_GET["id"]);
$where = "";
if ($id != 0) {
	$where = " WHERE `id_khr`='".$id."'"; 
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