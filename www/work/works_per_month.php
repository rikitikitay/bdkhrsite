<html>
<head>
<title>
������ �� �����
</title>
</head>
<body>
<h3>������ �� �����</h3>
<form name="search" method="get" action="works_per_month.php">
<input type="text" size="5" name="year">&nbsp;&nbsp;&nbsp;
<select name="month">
    <option value="1">������</option>;
    <option value="2">�������</option>;             
    <option value="3">����</option>;
    <option value="4">������</option>;
    <option value="5">���</option>;
    <option value="6">����</option>;
    <option value="7">����</option>;
    <option value="8">������</option>;
    <option value="9">��������</option>;
    <option value="10">�������</option>;
    <option value="11">������</option>;
    <option value="12">�������</option>;
</select> 
<input type="submit" value="�����">
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
    <th>�����</th>
    <th>��� �������</th>
    <th>��������</th>
    <th>���� ������</th>
    <th>���� ���������</th>
</tr>
<?php    
    while ($row = mysql_fetch_array($res)) {
        if (!$row['type']) {	
		$type = "������";
        }	
        else {	
            $type = "�������";	
        };
        $title = $row['title'];
        if (strlen($title) == 0) {
            $title = '��� ��������';
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
    echo '��� �����, ��������������� � ���� ������';
} 

mysql_close($dbh);
?>
</body>
</html>
