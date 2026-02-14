<?php 
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha_ini                   = addslashes($_GET['fecha_ini']);
$fecha_fin                   = addslashes($_GET['fecha_fin']);
$nombre_empresa_contratante  = addslashes($_GET['nombre_empresa_contratante']);
$total_motivo                = intval($_GET['total_motivo']);
$total_muestra               = intval($_GET['total_muestra']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

if ($total_motivo==1) { 
$motivo = addslashes($_GET['motivo']);

$motivos = "motivo='".$motivo."'";
$motivos_ = "tbl15_historia_clinica.motivo='".$motivo."'";
}
elseif ($total_motivo==2) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."')";
}
elseif ($total_motivo==3) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);
$motivo3 = addslashes($_GET['motivo3']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."')";
}
elseif ($total_motivo==4) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);
$motivo3 = addslashes($_GET['motivo3']);
$motivo4 = addslashes($_GET['motivo4']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."')";
}
elseif ($total_motivo==5) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);
$motivo3 = addslashes($_GET['motivo3']);
$motivo4 = addslashes($_GET['motivo4']);
$motivo5 = addslashes($_GET['motivo5']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."')";
}
elseif ($total_motivo==6) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);
$motivo3 = addslashes($_GET['motivo3']);
$motivo4 = addslashes($_GET['motivo4']);
$motivo5 = addslashes($_GET['motivo5']);
$motivo6 = addslashes($_GET['motivo6']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."')";
}
elseif ($total_motivo==7) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);
$motivo3 = addslashes($_GET['motivo3']);
$motivo4 = addslashes($_GET['motivo4']);
$motivo5 = addslashes($_GET['motivo5']);
$motivo6 = addslashes($_GET['motivo6']);
$motivo7 = addslashes($_GET['motivo7']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."')";
}
elseif ($total_motivo==8) { 
$motivo = addslashes($_GET['motivo']);
$motivo2 = addslashes($_GET['motivo2']);
$motivo3 = addslashes($_GET['motivo3']);
$motivo4 = addslashes($_GET['motivo4']);
$motivo5 = addslashes($_GET['motivo5']);
$motivo6 = addslashes($_GET['motivo6']);
$motivo7 = addslashes($_GET['motivo7']);
$motivo8 = addslashes($_GET['motivo8']);

$motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."')";
$motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."')";
}

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='BAJO PESO'))
GROUP BY exa_fis_interpreimc";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='PESO NORMAL'))
GROUP BY exa_fis_interpreimc";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='SOBREPESO'))
GROUP BY exa_fis_interpreimc";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$query4 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD I'))
GROUP BY exa_fis_interpreimc";
$result4 = mysqli_query($conectar, $query4);
$dato04 = mysqli_fetch_assoc($result4);

$query5 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD II'))
GROUP BY exa_fis_interpreimc";
$result5 = mysqli_query($conectar, $query5);
$dato05 = mysqli_fetch_assoc($result5);

$query6 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD III'))
GROUP BY exa_fis_interpreimc";
$result6 = mysqli_query($conectar, $query6);
$dato06 = mysqli_fetch_assoc($result6);

$query7 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD EXTREMA'))
GROUP BY exa_fis_interpreimc";
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