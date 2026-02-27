<?php
include_once('../conexiones/conexione.php');
$res = mysqli_query($conectar, "SHOW TABLES");
while($row = mysqli_fetch_array($res)) { echo $row[0] . "\n"; }
?>
