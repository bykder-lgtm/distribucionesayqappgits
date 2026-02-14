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

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Fuma'))
GROUP BY habit_tox_fum_nofum_exfum, nombre_empresa, motivo";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='No Fuma'))
GROUP BY habit_tox_fum_nofum_exfum, nombre_empresa, motivo";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Exfumador'))
GROUP BY habit_tox_fum_nofum_exfum, nombre_empresa, motivo";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$fuma                        = $dato01['habit_tox_fum_nofum_exfum'];
$nofum                       = $dato02['habit_tox_fum_nofum_exfum'];
$exfum                       = $dato03['habit_tox_fum_nofum_exfum'];
$vector_habitos_extra_lab    = array($fuma, $nofum, $exfum);

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