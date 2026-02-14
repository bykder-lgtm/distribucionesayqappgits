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

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (enf_lab='SI'))
GROUP BY enf_lab, nombre_empresa, motivo";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (enf_lab='NO'))
GROUP BY enf_lab, nombre_empresa, motivo";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$enf_lab_si                = $dato01['enf_lab'];
$enf_lab_no                = $dato02['enf_lab'];
$vector_enf_lab    = array($enf_lab_si, $enf_lab_no);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_enf_lab as &$conteo_enf_lab) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$nombre_enf_lab = 'CON ENFERMEDAD';
echo ' "nombre_enf_lab": "' .$nombre_enf_lab. '",';
echo ' "conteo_enf_lab": '  .intval($conteo_enf_lab). ''. '';
}
if ($contador == 2) {
$nombre_enf_lab = 'SIN ENFERMEDAD';
echo ' "nombre_enf_lab": "' .$nombre_enf_lab. '",';
echo ' "conteo_enf_lab": '  .intval($conteo_enf_lab). ''. '';
}
unset($conteo_enf_lab); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>