<html>
<head>
<title>���</title>
</head>
<body>
<h3>���</h3>
<form  name="khr" action="edit_khr.php">
<?php 
	include("../connection.php");
    $idkhr = $_GET["idkhr"];
?>    
<label>
<input type="hidden" name="idkhr" value="<?php echo $idkhr; ?>">
</label>
<?php
    $query = "SELECT * FROM `khr` WHERE `id`='".$idkhr."'";
	$res = mysql_query($query) or die(mysql_error());
	$row=mysql_fetch_array($res); 
	$number = $row['num'];
	$title = $row['title'];
	$order = $row['order'];
    $begin = $row['begin'];
	mysql_close($dbh);
?>
<label>�����<input type="text" name="number" size="10" value=<?php echo $number; ?> ></label><br>
<label>��������<input type="text" name="title" size="100" value="<?php echo htmlspecialchars(stripslashes($title)); ?>" ></label><br>
<label>�����<input type="text" name="order" size="10" value=<?php echo $order; ?> ></label><br>
<label>���� ������<input type="text" name="begin" size="10" value=<?php echo $begin; ?> ></label><br>
<input type="submit" value="���������">
</form>
</body>
</html>
