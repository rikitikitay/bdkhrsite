<html>
<head>
<title>���</title>
</head>
<body>
<h3>���</h3>
<form  name="khr" action="edit_khr.php">
<?php 
	include("../connection.php");
	$id = $_GET["id"];
	echo '<label><input type="hidden" name="id" value="'; echo $id; echo '"</label>';
	$query = "SELECT * FROM `khr` WHERE `id`='".$id."'";
	$sql = mysql_query($query) or die(mysql_error());
	$product=mysql_fetch_assoc($sql); 
	$number = $product['num'];
	$title = $product['title'];
	$order = $product['order'];
	mysql_close($dbh);
	
?>
<label>�����<input type="text" name="number" size="10" value=<?php echo $number; ?> ></label><br>
<label>��������<input type="text" name="title" size="100" value="<?php echo $title; ?>" ></label><br>
<label>�����<input type="text" name="order" size="10" value=<?php echo $product['order']; ?> ></label><br>
<label>���� ������<input type="text" name="begin" size="10" value=<?php echo $product['begin']; ?> ></label><br>
<input type="submit" value="���������">
</form>
</body>
</html>