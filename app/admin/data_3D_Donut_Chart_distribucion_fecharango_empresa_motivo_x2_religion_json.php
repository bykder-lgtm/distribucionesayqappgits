<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha_ini                   = addslashes($_GET['fecha_ini']);
$fecha_fin                   = addslashes($_GET['fecha_fin']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$motivo                      = addslashes($_GET['motivo']);
$motivo2                     = addslashes($_GET['motivo2']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query = "SELECT COUNT(nombre_religion) AS conteo_nombre_religion, nombre_religion FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin')) AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion='1')
GROUP BY nombre_religion ORDER BY nombre_religion DESC";
$result = mysqli_query($conectar, $query);

// Print out datoss
$prefix = '';
echo "[\n";
while ($datos = mysqli_fetch_assoc($result) ) {

$nombre_religion = $datos['nombre_religion'];
$conteo_nombre_religion = $datos['conteo_nombre_religion'];

echo $prefix . " {\n";
echo '  "nombre_religion": "' . $nombre_religion . '",';
echo '  "conteo_nombre_religion": ' . intval($conteo_nombre_religion) . '';
//echo '  "nombre_pais": "' . $nombre_pais . '"';
//echo '  "color": "' . $color . '"';
echo " }";
$prefix = ",\n";
}
echo "\n]";
?>