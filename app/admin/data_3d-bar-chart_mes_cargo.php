<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(dat_ocupa_carg1) AS conteo_dat_ocupa_carg1, dat_ocupa_carg1, nombre_empresa
FROM tbl15_historia_clinica
GROUP BY $tipo_fecha, cod_estado_facturacion, dat_ocupa_carg1, nombre_empresa
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

$prefix = '';
echo "[\n";
$contador = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$dat_ocupa_carg1          = $datos['dat_ocupa_carg1'];
$conteo_dat_ocupa_carg1   = $datos['conteo_dat_ocupa_carg1'];

echo $prefix . " {\n";
echo '  "nombre_sexo": "' . $nombre_sexo . '",';
echo '  "conteo_dat_ocupa_carg1": ' . intval($conteo_dat_ocupa_carg1) . '';
//echo '  "nombre_pais": "' . $nombre_pais . '"';
//echo '  "color": "' . $color . '"';
echo " }";
$prefix = ",\n";
}

echo "\n]";
?>