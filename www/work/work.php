<html>
<head>
<title>����������/�������������� ������</title>
</head>
<body>
<h3>����������/�������������� ������</h3><br> 
<form name="work" action="make_work.php" method = "get">
<label>
<label>
<input name="idwork" type="hidden" value="<?php echo $_GET['idwork']?>">
</label>
��� &nbsp;&nbsp;
<select name="idkhr">
<?php 
    include "../delete_functions.php";
	include "../connection.php";
    $idwork = $_GET['idwork']; // need for new works
    if ($idwork > 0) {
        $query = "SELECT * FROM work WHERE id="."'$idwork'";
        $res = mysql_query($query);
        $row = mysql_fetch_array($res);
        $title = $row['title'];
        $number_work = $row['num'];
        $begin_current = $row['begin_cur'];
        $end_current = $row['end_cur'];
        $type_work = $row['type'];
        $idkhr = $row['khr_id'];
    }; 
?>
    <option value="0">�� �������</option>
<?php
    $query = "SELECT * FROM khr";
    $res = mysql_query($query);
    if (is_null($idkhr)) {
        $idkhr = $_GET['idkhr'];
    }
	while($row = mysql_fetch_array($res)) {
		$number = $row['num'];
        $order = $row['order'];
        $id = $row['id'];
        $option = '<option value="'.$id.'" ';
        if ($id == $idkhr) {
            $option = $option.'selected';
        };
        $option = $option.'>'.$number.' ('.$order.')</option>';
        $number = NULL; 
        echo $option;
    };
    
?>
</select>
</label><br>
<label>
����� <input name="number" type="text" size="10" value="<?php echo $number_work; ?>">&nbsp;&nbsp;&nbsp;
</label>
<label>
�������� 
<input 
name="title"
type="text" 
size="60"
value="<?php echo htmlspecialchars(stripslashes($title)); ?>">&nbsp;&nbsp;&nbsp;
</label>
<label title="0 - ������; 1 - �������">
��� ������ <input name="typework" type="text" size="10" value="<?php echo $type_work?>">
</label><br>
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
<label>
������. <input name="prev" type="text" size="10" value="<?php echo $prev?>">&nbsp;&nbsp;&nbsp;
</label>
<label>
������. <input name="next" type="text" size="10" value="<?php echo $next?>">&nbsp;&nbsp;&nbsp;
</label>
<label title = "0 - ��������� ��� ����������; 1 - ��������� ��� ������">
��� �����������<input name="type_dependency" type="text" size="10" value="<?php echo $type_dependency?>">
</label><br>
<label>
���� ������ <input name="begin_current" type="text" size="20" value="<?php echo $begin_current ?>">&nbsp;&nbsp;&nbsp;
</label>
<label>
���� ��������� <input name="end_current" type="text" size="20" value="<?php echo $end_current ?>">
</label><br><br>
<table width="25%" border="1" cellpadding="5" cellspacing="0">
	<caption>�����������</caption>
<tr>
    <th>���.</th>
    <th>�����������</th>
    <th>I ��.</th>
    <th>II ��.</th>
    <th>III ��.</th>
    <th>IV ��.</th>
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
<td><input name="resp<?php echo $i; ?>" type="checkbox" <?php if ($resp != 0) { echo " checked";} ?> >
</td>  
<td>
<select name="exec<?php echo $i; ?>">
    <option value="0" >�� �������</option>';
<?php       
        while($row_exec = mysql_fetch_array($res_exec)) {
            $title = $row_exec['title'];
            $id = $row_exec['id'];
            $option = '<option value="'.$id.'"';
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
<td><input name="<?php echo 'order'.$i.'quoter'.$j ?>" type="text" size="10" value="<?php echo $volume ?>"></td>
<?php 
        };
?>
</tr>
<?php
    };
?>
</table><br>
<input type="submit" value="���������">&nbsp;&nbsp;&nbsp;
<a href="<?php echo 'delete_work.php?idwork='.$idwork; ?>">�������</a>
</form>
<?php mysql_close($dbh); ?>
</body>
</html>
