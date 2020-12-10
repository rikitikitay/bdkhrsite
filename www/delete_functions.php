<?php
function delete_dependency($idwork) {
    $query = 'DELETE FROM `dependency` WHERE `work_id`='.$idwork;
    mysql_query($query);            
}
function delete_volume($idwork) {
    $query = 'DELETE FROM `volume` WHERE `work_id`='.$idwork;
    mysql_query($query);
}
function delete_work($idwork) {
    delete_volume($idwork);
    delete_dependency($idwork);
    $query = 'DELETE FROM `work` WHERE `id`='.$idwork;
    mysql_query($query);
}
function delete_khr($idkhr) {
    $query = 'SELECT `id` FROM `work` WHERE `khr_id`='.$idkhr;
    $res = mysql_query($query);
    while ($row = mysql_fetch_array($res)) {
        $idwork = $row['id'];
        delete_work($idwork);    
    }
    $query = 'DELETE FROM `khr` WHERE `id` ='.$idkhr;
    mysql_query($query);
}
?>
