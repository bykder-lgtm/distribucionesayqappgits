<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY enf_lab, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (enf_lab='SI') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY enf_lab, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (enf_lab='NO') AND ((nombre_empresa)='$nombre_empresa'))";
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