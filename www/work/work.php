<html>
<head>
<title>Добавление/Редактирование работы</title>
</head>
<body>
<h3>Добавление/Редактирование работы</h3><br> 
<form name="work" action="make_work.php" method = "get">
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
        };
        $option = $option.'>'.$number.' ('.$order.')</option>';
        $number = NULL; 
        echo $option;
    };
    $idwork = $_GET['idwork'];
    if ($idwork > 0) {
        $query = "SELECT * FROM work WHERE id="."'$idwork'";
        $res = mysql_query($query);
        $row = mysql_fetch_array($res);
        $title = $row['title'];
        $number = $row['num'];
        $begin_current = $row['begin_cur'];
        $end_current = $row['end_cur'];
        $type_work = $row['type'];
    };
?>
</select>
</label><br>
<label>
Номер <input name="number" type="text" size="10" value="<?php echo $number; ?> ">&nbsp;&nbsp;&nbsp;
</label>
<label>
Название 
<input 
type="text" 
size="60"
value="<?php echo htmlspecialchars(stripslashes($title)); ?>">&nbsp;&nbsp;&nbsp;
</label>
<?php 
    if ($idwork > 0) {
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
    };
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
    <th>III кв.</th>
    <th>IV кв.</th>
</tr>
<?php
 	$query = "SELECT * FROM executor";  
    $res_exec = mysql_query($query);
    if ($idwork > 0) {
        $row = mysql_fetch_array(mysql_query('SELECT MAX(`order`) AS `max_order` FROM volume WHERE `work_id` = '.$idwork));  
        $max_order = $row['max_order'];
        $query = "SELECT `resp`, `executor_id`, `volume`, `order`, `quoter`
                FROM volume WHERE `work_id` = ".$idwork."
                ORDER BY `order` ASC, `quoter` ASC";  
        $res = mysql_query($query) or die("error");
        $max_row_count = mysql_num_rows($res); 
        $row_count = 1;
        $row = mysql_fetch_array($res);
    };
    for ($i = 1; $i <= 5 || $i <= $max_order + 1 ; ++$i) {         
        if ($idwork > 0) {
            $resp = $row['resp']; 
            $executor_id = $row['executor_id']; 
            $order = $row['order'];
            if ($order != $i) { 
                $resp = 0; 
                $executor_id = 0;
            }; 
        };   
?>
<tr> 
<td><input type="checkbox" <?php if ($resp != 0) { echo " checked";} ?> >
</td>  
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
            };
            $option = $option.'>'.$title.'</option>'; 
            echo $option;
        };
        mysql_data_seek($res_exec,0); 
?>
</select>
</td>
<?php
        for ($j = 1; $j <= 4; ++$j) {
            if ($idwork > 0) { 
                $volume = $row['volume'];
                $quoter = $row['quoter'];
                $order = $row['order'];
                if ($quoter != $j || $order != $i) {
                    $volume = NULL;
                    if ($row_count > 0 && $row_count < $max_row_count + 1) { 
                        mysql_data_seek($res, $row_count - 1); 
                        $row_count -= 1; 
                    };  
                };    
                $row = mysql_fetch_array($res); 
                $row_count += 1;
            };  
?>        
<td><input type="text" size="10" value="<?php echo $volume ?>"></td> <?php // внутренний цикл ?>
<?php 
        };
?>
</tr>
<?php
    };
?>
</table><br>
<input type="submit" value="Сохранить">
</form>
<?php mysql_close($dbh); ?>
</body>
</html>
