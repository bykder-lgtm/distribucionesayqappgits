<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha_ini                   = addslashes($_GET['fecha_ini']);
$fecha_fin                   = addslashes($_GET['fecha_fin']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa, Count(tbl15_cie10diag.cie10_diag) AS conteo_cie10_cod, tbl15_cie10diag.cie10_diag
FROM tbl15_historia_clinica LEFT JOIN tbl15_cie10diag ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa')) 
GROUP BY tbl15_historia_clinica.nombre_empresa, tbl15_cie10diag.cie10_diag ORDER BY conteo_cie10_cod DESC";
$result1 = mysqli_query($conectar, $query1);

$prefix = '';
echo "[\n";

while ($dato01 = mysqli_fetch_assoc($result1)) { 

$conteo_cie10_cod          = $dato01['conteo_cie10_cod'];
$nombre_cie10_diag         = $dato01['cie10_diag'];

$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

echo $prefix . " {\n";

echo ' "color": "' .$color. '",';
echo ' "nombre_cie10_diag": "' .substr($nombre_cie10_diag, 0, 30). '",';
echo ' "conteo_cie10_cod": '  .intval($conteo_cie10_cod). ''. '';

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>