<?php
include_once('../conexiones/conexione.php');

echo '<option value="0">Seleccione</option>';

$sql_venta_producto_temporal = "SELECT * FROM tbl15_empresa";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$cod_empresa               = $datos_venta_producto_temporal['cod_empresa'];
$nombre_empresa            = $datos_venta_producto_temporal['nombre_empresa'];

echo '<option value="' . $cod_empresa. '">' . $nombre_empresa . '</option>' . "\n";
}