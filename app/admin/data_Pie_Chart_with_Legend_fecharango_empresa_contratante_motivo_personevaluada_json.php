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


$query1 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1)) 
GROUP BY cod_estado_facturacion";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND ((cod_estado_facturacion)=2)) 
GROUP BY cod_estado_facturacion";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$poblacion_eval              = $datos1['conteo_estado_facturacion'];
//$poblacion_no_eval           = $datos2['conteo_estado_facturacion'];
$poblacion_no_eval           = $total_muestra - $poblacion_eval;
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