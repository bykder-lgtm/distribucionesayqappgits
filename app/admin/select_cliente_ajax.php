<?php
include_once('../conexiones/conexione.php');

$cod_empresa               = intval($_POST['cod_empresa']);

$sql_venta_producto_temporal = "SELECT * FROM tbl15_cliente WHERE cod_empresa = '$cod_empresa'";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$cod_cliente               = $datos_venta_producto_temporal['cod_cliente'];
$nombres                   = $datos_venta_producto_temporal['nombres'];

echo '<option value="' . $cod_cliente. '">' . $nombres . '</option>' . "\n";
}