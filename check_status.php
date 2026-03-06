<?php
include_once("app/conexiones/conexione.php");
$query = "SELECT DISTINCT cod_estado FROM tbl15_tienda";
$result = mysqli_query($conectar, $query);
while($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}
?>
