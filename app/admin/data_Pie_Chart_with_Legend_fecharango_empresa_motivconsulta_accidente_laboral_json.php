<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha_ini                   = addslashes($_GET['fecha_ini']);
$fecha_fin                   = addslashes($_GET['fecha_fin']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(ant_impor_accilab) AS ant_impor_accilab, nombre_empresa
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (cod_estado_facturacion=1) AND ((ant_impor_accilab)='SI') AND ((nombre_empresa)='$nombre_empresa'))
GROUP BY ant_impor_accilab, nombre_empresa";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(ant_impor_accilab) AS ant_impor_accilab, nombre_empresa
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (cod_estado_facturacion=1) AND ((ant_impor_accilab)='NO') AND ((nombre_empresa)='$nombre_empresa'))
GROUP BY ant_impor_accilab, nombre_empresa";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$ant_impor_accilab_si                = $dato01['ant_impor_accilab'];
$ant_impor_accilab_no                = $dato02['ant_impor_accilab'];
$vector_accidente_laboral    = array($ant_impor_accilab_si, $ant_impor_accilab_no);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_accidente_laboral as &$conteo_accidente_laboral) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$nombre_accidente_laboral = 'ACCIDENTADO';
echo ' "nombre_accidente_laboral": "' .$nombre_accidente_laboral. '",';
echo ' "conteo_accidente_laboral": '  .intval($conteo_accidente_laboral). ''. '';
}
if ($contador == 2) {
$nombre_accidente_laboral = 'NO ACCIDENTADO';
echo ' "nombre_accidente_laboral": "' .$nombre_accidente_laboral. '",';
echo ' "conteo_accidente_laboral": '  .intval($conteo_accidente_laboral). ''. '';
}
unset($conteo_accidente_laboral); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>