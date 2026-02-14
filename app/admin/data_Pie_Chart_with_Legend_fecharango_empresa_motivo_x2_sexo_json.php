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

$query1 = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_nombre_sexo, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.nombre_empresa
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND ((tbl15_cliente.nombre_sexo)='M'))
GROUP BY tbl15_cliente.nombre_sexo";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2= "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_nombre_sexo, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.nombre_empresa
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND ((tbl15_cliente.nombre_sexo)='F'))
GROUP BY tbl15_cliente.nombre_sexo";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$sexo_masculino         = $datos1['conteo_nombre_sexo'];
$sexo_femenino          = $datos2['conteo_nombre_sexo'];
$total_sexo             = $sexo_masculino + $sexo_femenino;
$vector_sexo            = array($sexo_masculino, $sexo_femenino);

$prefix = '';
echo "[\n";
$contador = 0;

foreach ($vector_sexo as &$conteo_sexo) {

$contador ++;

if ($contador == '1') { $nombre_sexo          = 'MASCULINO'; }
if ($contador == '2') { $nombre_sexo          = 'FEMENINO'; }

echo $prefix . " {\n";
echo '  "nombre_sexo": "' . $nombre_sexo . '",';
echo '  "conteo_nombre_sexo": ' . intval($conteo_sexo) . '';
//echo '  "nombre_pais": "' . $nombre_pais . '"';
//echo '  "color": "' . $color . '"';
echo " }";
$prefix = ",\n";
}
echo "\n]";
?>