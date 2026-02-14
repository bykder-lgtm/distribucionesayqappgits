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

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_activfis) AS habit_tox_activfis, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (habit_tox_activfis='Fisicamente activo'))
GROUP BY habit_tox_activfis, nombre_empresa, motivo";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_activfis) AS habit_tox_activfis, nombre_empresa, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND ((motivo='$motivo') OR (motivo='$motivo2')) AND (cod_estado_facturacion=1) AND (habit_tox_activfis='Sedentario'))
GROUP BY habit_tox_activfis, nombre_empresa, motivo";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$fisicamente_activo          = $dato01['habit_tox_activfis'];
$sedentario                  = $dato02['habit_tox_activfis'];
$vector_actividad_fisica    = array($fisicamente_activo, $sedentario);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_actividad_fisica as &$conteo_actividad_fisica) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$nombre_actividad_fisica = 'Fisicamente activo';
echo ' "nombre_actividad_fisica": "' .$nombre_actividad_fisica. '",';
echo ' "conteo_actividad_fisica": '  .intval($conteo_actividad_fisica). ''. '';
}
if ($contador == 2) {
$nombre_actividad_fisica = 'Sedentario';
echo ' "nombre_actividad_fisica": "' .$nombre_actividad_fisica. '",';
echo ' "conteo_actividad_fisica": '  .intval($conteo_actividad_fisica). ''. '';
}
unset($conteo_actividad_fisica); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>