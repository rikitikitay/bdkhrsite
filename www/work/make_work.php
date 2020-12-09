<?php
include "../connection.php";
$idwork = mysql_real_escape_string($_GET['idwork']);
$idkhr = mysql_real_escape_string($_GET['idkhr']);
$typework = mysql_real_escape_string($_GET['typework']);
$number = mysql_real_escape_string($_GET['number']);
$title = mysql_real_escape_string($_GET['title']);
$begin_current = mysql_real_escape_string($_GET['begin_current']);
$end_current = mysql_real_escape_string($_GET['end_current']);
$dlt_dependency = 0; // if equil 3 then delete
$prev = mysql_real_escape_string($_GET['prev']);
if (!$prev) {
    $prev = 'NULL';
    $dlt_dependency += 1;    
}
var_dump($prev);
$next = mysql_real_escape_string($_GET['next']);
if (!$next) {
    $next = 'NULL';
    $dlt_dependency += 1;
}
$type_dependency = mysql_real_escape_string($_GET['type_dependency']);
if (!$type_dependency) {
    $dlt_dependency += 1;
} 
if ($idwork > 0) {       
    //update work
    $query = 'UPDATE `work` 
        SET 
            `khr_id`='.$idkhr.',
            `num`="'.$number.'",
            `type`="'.$typework.'",
            `title`="'.$title.'",
            `begin_cur`="'.$begin_current.'",
            `end_cur`="'.$end_current.'" 
        WHERE `id`='.$idwork;
echo $query.'<br>';
    mysql_query($query) or die(mysql_error());
    // update dependency
    $query = 'SELECT `id` FROM `dependency` WHERE `work_id`="'.$idwork.'"';
    echo $query.'<br>';
    $res = mysql_query($query) or mysql_error();
    $dep_id_count = mysql_num_rows($res);
    if ($dep_id_count != 0) { 
        $row = mysql_fetch_array($res);
        $id_dep = $row['id'];       
    } 
    if ($dlt_dependency != 3) {
        $query = 'SELECT `id` FROM `work` WHERE `num`='.$prev.' AND `khr_id`='.$idkhr;
        $res = mysql_query($query);
    echo $query.'<br>';
        if (mysql_num_rows($res) != 0) {
            $row = mysql_fetch_array($res);
            $idprev = $row['id'];
        } else $idprev= 0;
        $query = 'SELECT `id` FROM `work` WHERE `num`='.$next.' AND `khr_id`='.$idkhr.'';
        print $query.'<br>';
        $res = mysql_query($query);    
        if (mysql_num_rows($res) != 0) {
            $row = mysql_fetch_array($res);
            $idnext = $row['id'];
        } else $idnext = 0;
        if ($id_dep != 0)  {
            $query = 'UPDATE `dependency`
                SET
                    `khr_id`='.$idkhr.',
                    `prev_id`='.$idprev.',
                    `next_id`='.$idnext.',
                    `type`="'.$type_dependency.'"
                WHERE `id`='.$id_dep;        echo $query.'<br>';
        } else {
            $query = 'INSERT INTO `dependency`(`id`,`khr_id`,`work_id`,`prev_id`,`next_id`,`type`) 
                    VALUES (NULL,'.$idkhr.','.$idwork.','.$idprev.','.$idnext.','.$type_dependency.')';echo $query.'<br>';
        } 
        mysql_query($query) or die(mysql_error());
    } else {
        if ($id_dep != 0) {
            $query = 'DELETE FROM `dependency` WHERE `id`='.$id_dep;
            mysql_query($query);     
        }
    }
} else 
{
}
mysql_close($dbh);
?>
