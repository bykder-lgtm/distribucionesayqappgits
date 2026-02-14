<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_fum_nofum_exfum, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Fuma') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_fum_nofum_exfum, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='No Fuma') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_fum_nofum_exfum, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Exfumador') AND ((nombre_empresa)='$nombre_empresa'))";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$Fuma                        = $dato01['habit_tox_fum_nofum_exfum'];
$nofum                       = $dato02['habit_tox_fum_nofum_exfum'];
$exfum                       = $dato03['habit_tox_fum_nofum_exfum'];
$vector_habitos_extra_lab    = array($Fuma, $nofum, $exfum);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_habitos_extra_lab as &$conteo_habit_extra_lab) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$nombre_habit_extra_lab = 'SI';
echo ' "nombre_habit_extra_lab": "' .$nombre_habit_extra_lab. '",';
echo ' "conteo_habit_extra_lab": '  .intval($conteo_habit_extra_lab). ''. '';
}
if ($contador == 2) {
$nombre_habit_extra_lab = 'NO';
echo ' "nombre_habit_extra_lab": "' .$nombre_habit_extra_lab. '",';
echo ' "conteo_habit_extra_lab": '  .intval($conteo_habit_extra_lab). ''. '';
}
if ($contador == 3) {
$nombre_habit_extra_lab = 'EX';
echo ' "nombre_habit_extra_lab": "' .$nombre_habit_extra_lab. '",';
echo ' "conteo_habit_extra_lab": '  .intval($conteo_habit_extra_lab). ''. '';
}
unset($conteo_habit_extra_lab); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>