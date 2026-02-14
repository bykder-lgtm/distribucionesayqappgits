<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(nombre_escolaridad) AS conteo_nombre_escolaridad, nombre_escolaridad, nombre_empresa
FROM tbl15_historia_clinica
GROUP BY tbl15_historia_clinica.$tipo_fecha, cod_estado_facturacion, nombre_escolaridad, nombre_empresa
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

// Print out datoss
$prefix = '';
echo "[\n";
while ($datos = mysqli_fetch_assoc($result1) ) {

$nombre_escolaridad 	      = $datos['nombre_escolaridad'];
$conteo_nombre_escolaridad    = $datos['conteo_nombre_escolaridad'];

$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];


echo $prefix . " {\n";
echo '  "nombre_escolaridad": "' . $nombre_escolaridad . '",';
echo '  "conteo_nombre_escolaridad": ' . intval($conteo_nombre_escolaridad) . ',';
echo '  "color": "' . $color . '"';
echo " }";
$prefix = ",\n";
}
echo "\n]";
?>