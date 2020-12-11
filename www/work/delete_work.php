<?php
include "../connection.php";
include "../delete_functions.php";

$idwork = mysql_real_escape_string($_GET["idwork"]);
if ($idwork != 0) {
    delete_work($idwork);
};
mysql_close($dbh);
?>
