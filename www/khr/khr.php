<html>
<head>
<title>КХР</title>
</head>
<body>
<h3>КХР</h3>
<form  name="khr" action="edit_khr.php">
<?php 
	include("../connection.php");
	$idkhr = $_GET["idkhr"];
	echo '<label><input type="hidden" name="idkhr" value="'; echo $idkhr; echo '"</label>';
	$query = "SELECT * FROM `khr` WHERE `id`='".$idkhr."'";
	$res = mysql_query($query) or die(mysql_error());
	$product=mysql_fetch_assoc($res); 
	$number = $product['num'];
	$title = $product['title'];
	$order = $product['order'];
    $begin = $product['begin'];
	mysql_close($dbh);
	
?>
<label>Номер<input type="text" name="number" size="10" value=<?php echo $number; ?> ></label><br>
<label>Название<input type="text" name="title" size="100" value="<?php echo htmlspecialchars(stripslashes($title)); ?>" ></label><br>
<label>Заказ<input type="text" name="order" size="10" value=<?php echo $order; ?> ></label><br>
<label>Дата начала<input type="text" name="begin" size="10" value=<?php echo $begin; ?> ></label><br>
<input type="submit" value="Сохранить">
</form>
</body>
</html>
