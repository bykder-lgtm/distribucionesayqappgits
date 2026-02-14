<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT tbl15_historia_clinica.$tipo_fecha, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
WHERE (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

$conteo1              = 0;
$conteo2              = 0;
$conteo3              = 0;
$conteo4              = 0;
$conteo5              = 0;
$total_edad_20_00     = 0;
$total_edad_20_29     = 0;
$total_edad_30_39     = 0;
$total_edad_40_49     = 0;
$total_edad_50_00     = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$fecha_nac_time       = $dato01['fecha_nac_time'];
$diferencia_edad      = abs($fecha_hoy_ymd_seg - $fecha_nac_time);
$edad_anyo            = floor($diferencia_edad / (365*24*60*60));

if (($edad_anyo < 20))                        {   $total_edad_20_00   = $total_edad_20_00 + 1;  }
if (($edad_anyo >= 20) && ($edad_anyo <= 29)) {   $total_edad_20_29   = $total_edad_20_29 + 1;  }
if (($edad_anyo >= 30) && ($edad_anyo <= 39)) {   $total_edad_30_39   = $total_edad_30_39 + 1;  }
if (($edad_anyo >= 40) && ($edad_anyo <= 49)) {   $total_edad_40_49   = $total_edad_40_49 + 1;  }
if (($edad_anyo >= 50))                       {   $total_edad_50_00   = $total_edad_50_00 + 1;  }
}
$vector_edad          = array($total_edad_20_00, $total_edad_20_29, $total_edad_30_39, $total_edad_40_49, $total_edad_50_00);


$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_edad as &$edad_rango) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$nombre_edad_anyo = 'Menor 20';
echo ' "nombre_edad_anyo": "' .$nombre_edad_anyo. '",';
echo ' "conteo_edad_anyo": '  .intval($edad_rango). ''. '';
}
if ($contador == 2) {
$nombre_edad_anyo = '20 - 29';
echo ' "nombre_edad_anyo": "' .$nombre_edad_anyo. '",';
echo ' "conteo_edad_anyo": '  .intval($edad_rango). ''. '';
}
if ($contador == 3) {
$nombre_edad_anyo = '30 - 39';
echo ' "nombre_edad_anyo": "' .$nombre_edad_anyo. '",';
echo ' "conteo_edad_anyo": '  .intval($edad_rango). ''. '';
}
if ($contador == 4) {
$nombre_edad_anyo = '40 - 49';
echo ' "nombre_edad_anyo": "' .$nombre_edad_anyo. '",';
echo ' "conteo_edad_anyo": '  .intval($edad_rango). ''. '';
}
if ($contador == 5) {
$nombre_edad_anyo = 'Mayor 50';
echo ' "nombre_edad_anyo": "' .$nombre_edad_anyo. '",';
echo ' "conteo_edad_anyo": '  .intval($edad_rango). ''. '';
}
unset($edad_rango); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>