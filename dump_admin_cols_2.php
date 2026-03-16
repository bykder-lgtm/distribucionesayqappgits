<?php
include("app/conexiones/conexione.php");
$res = mysqli_query($conectar, "SHOW COLUMNS FROM tbl15_administrador");
while($row = mysqli_fetch_assoc($res)) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
