<?php
date_default_timezone_set("America/Bogota");
// Set proper HTTP response headers
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');
$fecha_mes                   = addslashes($_GET['fecha_mes']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));
$anyo_seg_menor_constante    = 31556899;
$anyo_seg_constante          = 31556900;
$fecha_hoy_prueba            = 1538197200;
//$edad_menor20                 = $fecha_hoy_ymd_seg - 631137999;
$time_edad_20                = $fecha_hoy_ymd_seg - (20*365*24*60*60);
$time_edad_29                = $fecha_hoy_ymd_seg - (29*365*24*60*60);
$time_edad_30                = $fecha_hoy_ymd_seg - (30*365*24*60*60);
$time_edad_39                = $fecha_hoy_ymd_seg - (39*365*24*60*60);
$time_edad_40                = $fecha_hoy_ymd_seg - (40*365*24*60*60);
$time_edad_49                = $fecha_hoy_ymd_seg - (49*365*24*60*60);
$time_edad_50                = $fecha_hoy_ymd_seg - (50*365*24*60*60);
//cod_visita 	url_pagina 	navegador 	ip 	nombre_pais 	region 	ciudad 	longitud 	latitud 	fecha_time
$query1 = "SELECT tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.fecha_nac_time, tbl15_cliente.fecha_nac_time, 
tbl15_cliente.fecha_nac_ymd, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
HAVING (((tbl15_historia_clinica.fecha_mes)='$fecha_mes') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1))";
$result1 = mysqli_query($conectar, $query1);

$conteo1 = 0;
$conteo2 = 0;
$conteo3 = 0;
$conteo4 = 0;
$conteo5 = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$fecha_nac_time           = $dato01['fecha_nac_time'];
$diferencia_edad          = abs($fecha_hoy_ymd_seg - $fecha_nac_time);
$edad_anyo                = floor($diferencia_edad / (365*60*60*24));

if ($edad_anyo < 20) {
$total_1_edad_20 = $conteo1++;
}
if (($edad_anyo >= 20) && ($edad_anyo <= 29)) {
$total_2_edad_20_29 = $conteo2++;
}
if (($edad_anyo >= 30) && ($edad_anyo <= 39)) {
$total_3_edad_30_39 = $conteo3++;
}
if (($edad_anyo >= 40) && ($edad_anyo <= 59)) {
$total_4_edad_39_40 = $conteo4++;
}
if (($edad_anyo >= 50)) {
$total_5_edad_50 = $conteo5++;
}
}
$vector_edad             = array($total_1_edad_20, $total_2_edad_20_29, $total_3_edad_30_39, $total_4_edad_39_40, $total_5_edad_50);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_edad as &$edad_rango) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$edad_anyo = 'Menor 20';
echo ' "edad_anyo": "' .$edad_anyo. '",';
echo ' "conteo_edad": '  .$edad_rango. ''. '';
}
if ($contador == 2) {
$edad_anyo = '20 - 29';
echo ' "edad_anyo": "' .$edad_anyo. '",';
echo ' "conteo_edad": '  .$edad_rango. ''. '';
}
if ($contador == 3) {
$edad_anyo = '30 - 39';
echo ' "edad_anyo": "' .$edad_anyo. '",';
echo ' "conteo_edad": '  .$edad_rango. ''. '';
}
if ($contador == 4) {
$edad_anyo = '40 - 49';
echo ' "edad_anyo": "' .$edad_anyo. '",';
echo ' "conteo_edad": '  .$edad_rango. ''. '';
}
if ($contador == 5) {
$edad_anyo = 'Mayor 50';
echo ' "edad_anyo": "' .$edad_anyo. '",';
echo ' "conteo_edad": '  .$edad_rango. ''. '';
}
unset($edad_rango); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>