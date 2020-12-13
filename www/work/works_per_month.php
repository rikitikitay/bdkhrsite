<html>
<head>
<title>
Работы за месяц
</title>
</head>
<body>
<h3>Работы за месяц</h3>
<form name="search" method="get" action="works_per_month.php">
<input type="text" size="5" name="year">&nbsp;&nbsp;&nbsp;
<select name="month">
    <option value="1">Январь</option>;
    <option value="2">Февраль</option>;             
    <option value="3">Март</option>;
    <option value="4">Апрель</option>;
    <option value="5">Май</option>;
    <option value="6">Июнь</option>;
    <option value="7">Июль</option>;
    <option value="8">Август</option>;
    <option value="9">Сентябрь</option>;
    <option value="10">Октябрь</option>;
    <option value="11">Ноябрь</option>;
    <option value="12">Декабрь</option>;
</select> 
<input type="submit" value="Найти">
</form>
<?php
include "../connection.php";
$month = mysql_real_escape_string($_GET['month']);
$year = mysql_real_escape_string($_GET['year']);
if (strlen($month) == 0) {
    $month = 'NULL';
}
if (strlen($year) == 0) {
    $year = 'NULL';
}
$query = 'SELECT * FROM `work` 
        WHERE MONTH(`end_cur`)='.$month.' AND
        YEAR(`end_cur`)='.$year;
$res = mysql_query($query) or die(mysql_error());
if (mysql_num_rows($res) != 0) { 
?>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Номер</th>
    <th>Тип позиции</th>
    <th>Название</th>
    <th>Дата начала</th>
    <th>Дата окончания</th>
</tr>
<?php    
    while ($row = mysql_fetch_array($res)) {
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
?>
<tr>
    <td><?php echo $row['num']; ?></td>
    <td><?php echo $type; ?></td>
    <td>
    <a href="
    <?php 
    $idwork = $row['id']; 
    echo 'work.php?idwork='.$idwork
    ?>">
    <?php 
    echo htmlspecialchars(stripslashes($title)); 
    ?></a>
    </td>
    <td><?php echo $row['begin_cur']; ?></td>
    <td><?php echo $row['end_cur']; ?></td>
</tr>
<?php
    }
?>
</table>
<?php
} else {
    echo 'Нет работ, заканчивающихся в этом месяце';
} 

mysql_close($dbh);
?>
</body>
</html>
