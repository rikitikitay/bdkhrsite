<html>
<head>
<title>Добавление/Редактирование работы</title>
</head>
<body>
<h3>Добавление/Редактирование работы</h3><br> 
<form action="work.php" method = "get">
<label>
КХР &nbsp;&nbsp;
<select>
<?php 	
	include "../connection.php";
	$query = "SELECT * FROM khr";
    $res = mysql_query($query);
    $idkhr = $_GET['idkhr'];
	while($row = mysql_fetch_array($res)) {
		$number = $row['num'];
        $order = $row['order'];
        $id = $row['id'];
        $option = '<option ';
        if ($id == $idkhr) {
            $option = $option.'selected';
        }
        $option = $option.'>'.$number.' ('.$order.')</option>'; 
        echo $option;
	};
	$idwork = $_GET['idwork'];
	$query = "SELECT * FROM work WHERE id="."'$idwork'";
	$res = mysql_query($query);
	$row = mysql_fetch_assoc($res);
    $title = $row['title'];
    $number = $row['num'];
    $begin_current = $row['begin_cur'];
    $end_current = $row['end_cur'];
    $type_work = $row['type'];
		
?>
</select>
</label><br>
<label>
Номер <input type="text" size="10" value="<?php echo $number; ?> ">&nbsp;&nbsp;&nbsp;
</label>
<label>
Название 
<input 
type="text" 
size="60"
value="<?php echo htmlspecialchars(stripslashes($title)); ?>">&nbsp;&nbsp;&nbsp;
</label>
<?php 
    $query = "SELECT * FROM dependency WHERE work_id="."'$idwork'";
	$res = mysql_query($query);
    $row = mysql_fetch_assoc($res);
    $type_dependency = $row['type'];
    $next = $row['next_id'];
    // previous num
    $prev = $row['prev_id'];
    $query = "SELECT num FROM work WHERE id = "."'$prev'";
    $res = mysql_query($query);
    $row = mysql_fetch_assoc($res);
    $prev = $row['num'];
    // next num    
    $query = "SELECT num FROM work WHERE id = "."'$next'";
    $res = mysql_query($query);
    $row = mysql_fetch_assoc($res);
    $next = $row['num'];
    
?>
<label title="0 - работа; 1 - доплата">
Тип работы <input type="text" size="10" value="<?php echo $type_work?>">
</label><br>
<label>
Предыд. <input type="text" size="10" value="<?php echo $prev?>">&nbsp;&nbsp;&nbsp;
</label>
<label>
Послед. <input type="text" size="10" value="<?php echo $next?>">&nbsp;&nbsp;&nbsp;
</label>
<label title = "0 - требуется для завершения; 1 - требуется для начала">
Тип зависимости<input type="text" size="10" value="<?php echo $type_dependency?>">
</label><br>
<label>
Дата начала <input type="text" size="20" value="<?php echo $begin_current ?>">&nbsp;&nbsp;&nbsp;
</label>
<label>
Дата окончания <input type="text" size="20" value="<?php echo $end_current ?>">
</label><br><br>
<table width="25%" border="1" cellpadding="5" cellspacing="0">
	<caption>Трудоёмкость</caption>
<tr>
    <th>Отв.</th>
    <th>Исполнитель</th>
    <th>I кв.</th>
    <th>II кв.</th>
 <?php /*   <th>III кв.</th>
    <th>IV кв.</th>
 */ ?>
</tr>
<?php
    $row = mysql_fetch_array(mysql_query('SELECT MAX(`order`) AS `max_order` FROM volume')); // до цикла 
    $max_order = $row['max_order'];   // до цикла      
    $query = "SELECT * FROM volume WHERE `work_id` = ".$idwork." AND `order` = 1 AND `quoter` = 1"; // это до цикла в более жирном запросе
    $res = mysql_query($query) or die("error"); // ну и это тоже соответственно
    $row = mysql_fetch_array($res); // и это
    $volume = $row['volume']; // это во внутренний цикл
    $resp = $row['resp']; // внешний цикл
    $executor_id = $row['executor_id']; // внешний цикл
	$query = "SELECT * FROM executor";  // это до цикла
    $res_exec = mysql_query($query); // ну тоже ды, причём переменную по-особому обозвать
    /*  for ($i = 0; $i < 5; ++$i) { */ // переделать, связав с макс_ордер ?>
        <tr> <?php // внешний цикл ?>
<td><input type="checkbox" <?php if ($resp != 0) { echo " checked";} //внешний цикл ?> >
</td> <?php // внешний цикл ?> 
<td>
<select>
    <option>Не выбрано</option>';
<?php       
    while($row_exec = mysql_fetch_array($res_exec)) {
        $title = $row_exec['title'];
        $id = $row_exec['id'];
        $option = '<option ';
        if ($id == $executor_id) {
            $option = $option.'selected';
        }
        $option = $option.'>'.$title.'</option>'; 
        echo $option;
    };
    mysql_data_seek($res_exec,0); 
?>
</select>
</td><?php // внешний цикл ?>
<td><input type="text" size="10" value="<?php echo $volume ?>"></td> <?php // внутренний цикл ?>
<td><input type="text" size="10"></td>
 <?php       /*           <td><input type="text" size="10"></td>
            <td><input type="text" size="10"></td> 
        </tr>'; */ // внешний цикл
// }
?>
</table><br>
<input type="submit" value="Сохранить">
</form>
<?php mysql_close($dbh); ?>
</body>
</html>
