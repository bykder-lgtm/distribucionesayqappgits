<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['fecha_nac_ymd'] <> '')) {
//$fecha_nac_ymd                       = mysqli_real_escape_string($conectar,(($_POST['fecha_nac_ymd'])));
$fecha_nac_ymd                  = new DateTime(mysqli_real_escape_string($conectar,($_POST['fecha_nac_ymd'])));
$fecha_hoy_time                 = new DateTime();
$edad                           = $fecha_hoy_time -> diff($fecha_nac_ymd);
$anyo                           = $edad->y;
$mes                            = $edad->m;
$dia                            = $edad->d;
$edad_anyo                      = $anyo;
$edad_mes                       = ($anyo*12+$mes);
echo $edad_anyo."-".$edad_mes;
}
?>