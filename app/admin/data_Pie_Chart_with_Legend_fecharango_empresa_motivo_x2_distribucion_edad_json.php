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

$query1 = "SELECT fecha_ymd, dat_ocupa_dura_anyo1, cod_estado_facturacion, nombre_empresa, motivo
FROM tbl15_historia_clinica
HAVING ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1))";
$result1 = mysqli_query($conectar, $query1);

$total_edad_02_00      = 0;
$total_edad_02_05    = 0;
$total_edad_06_10   = 0;
$total_edad_11_15  = 0;
$total_edad_16_20  = 0;
$total_edad_21_00     = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$dat_ocupa_dura_anyo1           = $dato01['dat_ocupa_dura_anyo1'];

if ($dat_ocupa_dura_anyo1 < 2)                                      { $total_edad_02_00 = $total_edad_02_00 + 1; }
if (($dat_ocupa_dura_anyo1 >= 2) && ($dat_ocupa_dura_anyo1 <= 5))   { $total_edad_02_05 = $total_edad_02_05 + 1; }
if (($dat_ocupa_dura_anyo1 >= 6) && ($dat_ocupa_dura_anyo1 <= 10))  { $total_edad_06_10 = $total_edad_06_10 + 1; }
if (($dat_ocupa_dura_anyo1 >= 11) && ($dat_ocupa_dura_anyo1 <= 15)) { $total_edad_11_15 = $total_edad_11_15 + 1; }
if (($dat_ocupa_dura_anyo1 >= 16) && ($dat_ocupa_dura_anyo1 <= 20)) { $total_edad_16_20 = $total_edad_16_20 + 1; }
if (($dat_ocupa_dura_anyo1 >= 21))                                  { $total_edad_21_00 = $total_edad_21_00 + 1; }
}
$vector_edad_distrib             = array($total_edad_02_00, $total_edad_02_05, $total_edad_06_10, $total_edad_11_15, $total_edad_16_20, $total_edad_21_00);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_edad_distrib as &$edad_rango_distrib) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$edad_anyo_distrib = 'Menor de 2 Años';
echo ' "edad_anyo_distrib": "' .$edad_anyo_distrib. '",';
echo ' "conteo_edad_distrib": '  .intval($edad_rango_distrib). ''. '';
}
if ($contador == 2) {
$edad_anyo_distrib = 'De 2 a 5 Años';
echo ' "edad_anyo_distrib": "' .$edad_anyo_distrib. '",';
echo ' "conteo_edad_distrib": '  .intval($edad_rango_distrib). ''. '';
}
if ($contador == 3) {
$edad_anyo_distrib = 'De 6 a 10 Años';
echo ' "edad_anyo_distrib": "' .$edad_anyo_distrib. '",';
echo ' "conteo_edad_distrib": '  .intval($edad_rango_distrib). ''. '';
}
if ($contador == 4) {
$edad_anyo_distrib = 'De 11 a 15 Años';
echo ' "edad_anyo_distrib": "' .$edad_anyo_distrib. '",';
echo ' "conteo_edad_distrib": '  .intval($edad_rango_distrib). ''. '';
}
if ($contador == 5) {
$edad_anyo_distrib = 'De 16 a 20 Años';
echo ' "edad_anyo_distrib": "' .$edad_anyo_distrib. '",';
echo ' "conteo_edad_distrib": '  .intval($edad_rango_distrib). ''. '';
}
if ($contador == 6) {
$edad_anyo_distrib = 'Mayor de 20 Años';
echo ' "edad_anyo_distrib": "' .$edad_anyo_distrib. '",';
echo ' "conteo_edad_distrib": '  .intval($edad_rango_distrib). ''. '';
}
unset($edad_rango_distrib); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>