<html>
<head>
<title>������ ���</title>
</head>
<body>
<h3>������ ���</h3>
<table>
<?php
include ("connection.php");
mysql_query ('SET NAMES cp1251');
echo '<h4><a href="khr/khr.php?id='; echo $id; echo '">�������� ����� ���</a><h4>';
$query = "SELECT * FROM khr";
$res = mysql_query($query);
echo "<tr>
		<td>�����</td>
		<td>��������</td>
		<td>�����</td>
		<td>���� ������</td>
		
	</tr>";
while($row = mysql_fetch_array($res))
{	
	$id =  $row['id'];
	echo '<tr>';
	echo '<td>'.$row['num'].'</td>';
	$title = $row['title'];
	if (strlen($title) == 0) {
		$title = '��� ��������';
	};
	echo '<td><a href="work/list_work.php?id='; echo $id; echo '">'.$title.'</a></td>';
	echo '<td>('.$row['order'].')</td>';
	echo '<td>'.$row['begin'].'</td>';
	echo '<td><a href="khr/khr.php?id='; echo $id; echo '">�������������</a></td>';
	echo '<td><a href="khr/delete_khr.php?id='; echo $id; echo '">�������</a></td>';
	echo '</tr>';	
};
mysql_close($dbh);
?>
</table>
</body>
</html>