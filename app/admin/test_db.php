<?php
include_once('../conexiones/conexione.php');
$res = mysqli_query($conectar, "DESCRIBE tbl15_tarea");
while($row = mysqli_fetch_assoc($res)) {
    echo $row['Field'] . " - ";
}
?>
