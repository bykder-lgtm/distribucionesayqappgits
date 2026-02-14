<?php 
date_default_timezone_set("America/Bogota");
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha_ini                   = addslashes($_GET['fecha_ini']);
$fecha_fin                   = addslashes($_GET['fecha_fin']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
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

$query1 = "SELECT tbl15_historia_clinica.fecha_ymd, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') AND ($motivos_) AND (tbl15_historia_clinica.cod_estado_facturacion=1))";
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