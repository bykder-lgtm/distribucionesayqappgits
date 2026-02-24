<?php
include_once('app/conexiones/conexione.php');
$sql = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico = 0";
$res = mysqli_query($conectar, $sql);
$data = mysqli_fetch_assoc($res);
echo "Total tiendas sin aliado: " . $data['total'] . "\n";

$sql = "DESCRIBE tbl15_tienda";
$res = mysqli_query($conectar, $sql);
while($row = mysqli_fetch_assoc($res)) {
    echo $row['Field'] . " - " . $row['Type'] . " - " . $row['Null'] . "\n";
}
?>
