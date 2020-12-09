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
    mysql_query($query) or die(mysql_error());
    // update dependency
    $query = 'SELECT `id` FROM `dependency` WHERE `work_id`="'.$idwork.'"';
    $res = mysql_query($query) or mysql_error();
    $dep_id_count = mysql_num_rows($res);
    if ($dep_id_count != 0) { 
        $row = mysql_fetch_array($res);
        $id_dep = $row['id'];       
    } 
    if ($dlt_dependency != 3) {
        $query = 'SELECT `id` FROM `work` WHERE `num`='.$prev.' AND `khr_id`='.$idkhr;
        $res = mysql_query($query);
        if (mysql_num_rows($res) != 0) {
            $row = mysql_fetch_array($res);
            $idprev = $row['id'];
        } else $idprev= 0;
        $query = 'SELECT `id` FROM `work` WHERE `num`='.$next.' AND `khr_id`='.$idkhr.'';
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
                WHERE `id`='.$id_dep;
        } else {
            $query = 'INSERT INTO `dependency`(`id`,`khr_id`,`work_id`,`prev_id`,`next_id`,`type`) 
                    VALUES (NULL,'.$idkhr.','.$idwork.','.$idprev.','.$idnext.','.$type_dependency.')';
        } 
        mysql_query($query) or die(mysql_error());
    } else {
        if ($id_dep != 0) {
            $query = 'DELETE FROM `dependency` WHERE `id`='.$id_dep;
            mysql_query($query);     
        }
    }
    //update volume
    $query = 'SELECT MAX(`order`) AS `max_order` 
            FROM `volume` 
            WHERE `work_id`='.$idwork;
    $res = mysql_query($query);
    if (mysql_num_rows($res) != 0) {
        $row = mysql_fetch_array($res);
        $max_order = $row['max_order'];
        $query = 'DELETE FROM `volume` WHERE `work_id`='.$idwork;
        mysql_query($query);
    }
    for ($i = 1; $i <= 5 || $i <= $max_order + 1; ++$i) {
        $resp = mysql_real_escape_string($_GET['resp'.$i]);
        if ($resp == 'on') {
            $resp = 1;
        } else {
            $resp = 0;
        }
        $executor_id = mysql_real_escape_string($_GET['exec'.$i]);
        for ($j = 1; $j <= 4; ++$j) {
            $volume = mysql_real_escape_string($_GET['order'.$i.'quoter'.$j]);
            if (strlen($volume) != 0) {
                $query = 'INSERT INTO `volume`(`id`,`khr_id`,`work_id`,`executor_id`,`quoter`,`volume`,`resp`,`order`)
                        VALUES(NULL,'.$idkhr.','.$idwork.','.$executor_id.','.$j.','.$volume.','.$resp.','.$i.')';
                mysql_query($query);
            }
        }        
    } 
    
} else 
{
}
mysql_close($dbh);
?>
