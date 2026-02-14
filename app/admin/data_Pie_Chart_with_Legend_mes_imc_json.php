<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='BAJO PESO') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='PESO NORMAL') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='SOBREPESO') AND ((nombre_empresa)='$nombre_empresa'))";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$query4 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD I') AND ((nombre_empresa)='$nombre_empresa'))";
$result4 = mysqli_query($conectar, $query4);
$dato04 = mysqli_fetch_assoc($result4);

$query5 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD II') AND ((nombre_empresa)='$nombre_empresa'))";
$result5 = mysqli_query($conectar, $query5);
$dato05 = mysqli_fetch_assoc($result5);

$query6 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD III') AND ((nombre_empresa)='$nombre_empresa'))";
$result6 = mysqli_query($conectar, $query6);
$dato06 = mysqli_fetch_assoc($result6);

$query7 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD EXTREMA') AND ((nombre_empresa)='$nombre_empresa'))";
$result7 = mysqli_query($conectar, $query7);
$dato07 = mysqli_fetch_assoc($result7);

$bajo_peso                  = $dato01['exa_fis_interpreimc'];
$peso_normal                = $dato02['exa_fis_interpreimc'];
$sobreso                    = $dato03['exa_fis_interpreimc'];
$obesidad1                  = $dato04['exa_fis_interpreimc'];
$obesidad2                  = $dato05['exa_fis_interpreimc'];
$obesidad3                  = $dato06['exa_fis_interpreimc'];
$obesidad_extrema           = $dato07['exa_fis_interpreimc'];
$vector_imc    = array($bajo_peso, $peso_normal, $sobreso, $obesidad1, $obesidad2, $obesidad3, $obesidad_extrema);

$prefix = '';
echo "[\n";
$contador = 0;

//for ($i=0; $i < 7; $i++) { 
foreach ($vector_imc as &$conteo_imc) {
echo $prefix . " {\n";

$contador ++;
if ($contador == 1) {
$nombre_imc = 'BAJO PESO';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
if ($contador == 2) {
$nombre_imc = 'PESO NORMAL';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
if ($contador == 3) {
$nombre_imc = 'SOBREPESO';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
if ($contador == 4) {
$nombre_imc = 'OBESIDAD I';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
if ($contador == 5) {
$nombre_imc = 'OBESIDAD II';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
if ($contador == 6) {
$nombre_imc = 'OBESIDAD III';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
if ($contador == 7) {
$nombre_imc = 'OBESIDAD EXTREMA';
echo ' "nombre_imc": "' .$nombre_imc. '",';
echo ' "conteo_imc": '  .intval($conteo_imc). ''. '';
}
unset($conteo_imc); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>