<html>
<head>
<title>Добавление/Редактирование работы</title>
</head>
<body>
<h3>Добавление/Редактирование работы</h3><br> 
<form action="">
КХР &nbsp;&nbsp;
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
Номер <input type="text" size="10" value="<?php echo $row['num']; ?> ">&nbsp;&nbsp;&nbsp; 
Название <input type="text" size="60" value="<?php echo $title; ?>"><br>
Предыд. <input type="text" size="10">&nbsp;&nbsp;&nbsp; 
Послед. <input type="text" size="10"><br>
Дата начала <input type="text" size="20" value="<?php echo $row['begin_cur'] ?>">&nbsp;&nbsp;&nbsp;
Дата окончания <input type="text" size="20" value="<?php echo $row['end_cur'] ?>"><br><br>
<table width="25%" border="1" cellpadding="5" cellspacing="0">
	<caption>Трудоёмкость</caption>
<tr>
    <th>Отв.</th>   <th>Исполнитель</th>  <th>I кв.</th>  <th>II кв.</th>  <th>III кв.</th> <th>IV кв.</th>
</tr>
<?php 
	$query = "SELECT * FROM executor";
	$res = mysql_query($query);
    for ($i = 0; $i < 5; ++$i) {
        echo '<tr>
            <td><input type="checkbox"></td>
            <td>
            <select>
            <option>Не выбрано</option>';
       	while($row = mysql_fetch_array($res)) {
	    	$title = $row['title'];
		    echo '<option>'.$title.'</option>';		
    	};
        mysql_data_seek($res,0);
        echo '	</select>
            </td>
            <td><input type="text" size="10"></td>
            <td><input type="text" size="10"></td>
            <td><input type="text" size="10"></td>
            <td><input type="text" size="10"></td>
        </tr>';
}
?>
</table><br>
<input type="submit" value="Сохранить">
</form>
<?php mysql_close($dbh); ?>
</body>
</html>
