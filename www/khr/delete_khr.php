<?php
include "../connection.php";
include "../delete_functions.php";
$idkhr = mysql_real_escape_string($_GET["idkhr"]);
if ($idkhr != 0) {  
    delete_khr($idkhr);	
};
mysql_close($dbh);
?>
