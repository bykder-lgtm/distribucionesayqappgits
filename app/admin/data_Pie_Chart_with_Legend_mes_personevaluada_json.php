<?php
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion FROM tbl15_historia_clinica 
WHERE ((($tipo_fecha)='$fecha')  AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa')) GROUP BY cod_estado_facturacion";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion FROM tbl15_historia_clinica 
WHERE ((($tipo_fecha)='$fecha')  AND ((cod_estado_facturacion)=2) AND ((nombre_empresa)='$nombre_empresa')) GROUP BY cod_estado_facturacion";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$poblacion_eval              = $datos1['conteo_estado_facturacion'];
$poblacion_no_eval           = $datos2['conteo_estado_facturacion'];
$total_poblacion             = $poblacion_eval + $poblacion_no_eval;
$vector_poblacion_eval       = array($poblacion_eval, $poblacion_no_eval);

$prefix = '';
echo "[\n";
$contador = 0;

foreach ($vector_poblacion_eval as &$conteo_poblacion_eval) {

$contador ++;

if ($contador == '1') { $nombre_person_eval          = 'PERSONAS EVALUADAS'; }
if ($contador == '2') { $nombre_person_eval          = 'PERSONAS NO EVALUADAS'; }

echo $prefix . " {\n";
echo '  "nombre_person_eval": "' . $nombre_person_eval . '",';
echo '  "conteo_estado_facturacion": ' . intval($conteo_poblacion_eval) . '';
//echo '  "nombre_pais": "' . $nombre_pais . '"';
//echo '  "color": "' . $color . '"';
echo " }";
$prefix = ",\n";
}
echo "\n]";
?>