<html>
<head>
<title>����������/�������������� ������</title>
</head>
<body>
<h3>����������/�������������� ������</h3><br> 
<form action="">
��� &nbsp;&nbsp;
<select>
<?php 	
	include "../connection.php";
	$query = "SELECT * FROM khr";
	$res = mysql_query($query);
	while($row = mysql_fetch_array($res)) {
		$title = $row['num'];
		$order = $row['order'];
		echo '<option>'.$title.' ('.$order.')</option>'; 
	};
	$id = $_GET['id'];
	$query = "SELECT * FROM work WHERE id="."'$id'";
	$res = mysql_query($query);
	$row = mysql_fetch_assoc($res);
	$title = $row['title'];
		
?>
</select><br>
����� <input type="text" size="10" value="<?php echo $row['num']; ?> ">&nbsp;&nbsp;&nbsp; 
�������� <input type="text" size="60" value="<?php echo $title; ?>"><br>
������. <input type="text" size="10">&nbsp;&nbsp;&nbsp; 
������. <input type="text" size="10"><br>
���� ������ <input type="text" size="20" value="<?php echo $row['begin_cur'] ?>">&nbsp;&nbsp;&nbsp;
���� ��������� <input type="text" size="20" value="<?php echo $row['end_cur'] ?>"><br><br>
<table width="25%" border="1" cellpadding="5" cellspacing="0">
	<caption>�����������</caption>
<tr>
    <th>���.</th>   <th>�����������</th>  <th>I ��.</th>  <th>II ��.</th>  <th>III ��.</th> <th>IV ��.</th>
</tr>
<?php 

// while  
echo '<tr>
	<td><input type="checkbox"></td>
	<td>
	<select>
	<option>�� �������</option>';
include "select_executor.php";
echo '	</select>
	</td>
	<td><input type="text" size="10"></td>
	<td><input type="text" size="10"></td>
	<td><input type="text" size="10"></td>
	<td><input type="text" size="10"></td>
</tr>';
?>
</table><br>
<input type="submit" value="���������">
</form>
<?php mysql_close($dbh); ?>
</body>
</html>
