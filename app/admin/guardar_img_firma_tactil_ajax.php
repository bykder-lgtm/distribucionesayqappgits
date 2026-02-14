<?php
if (isset($_POST['img_data']) && ($_POST['img_data'] <> '')) {

session_start();
date_default_timezone_set("America/Bogota");
if (isset($_POST['cod_historia_clinica'])) { $cod_historia_clinica = intval($_POST['cod_historia_clinica']); } else { $cod_historia_clinica = 0; }
if (isset($_POST['cod_cliente'])) { $cod_cliente = intval($_POST['cod_cliente']); } else { $cod_cliente = 0; }
if (isset($_POST['cedula'])) { $cedula = intval($_POST['cedula']); } else { $cedula = 0; }

$ruta_firma_orig                             = '../archivador/firma/original/';
$fecha_ymdHis                                = date("YmdHis");
$formato                                     = '.jpg';
$resultado_firma                             = array();
$imagedata                                   = base64_decode($_POST['img_data']);
$nombre_firma_cryp                           = crc32($fecha_ymdHis);
$nombre_archivo_firma                        = $fecha_ymdHis.'_'.$cod_historia_clinica.'_'.$cod_cliente.'_'.$cedula.'_ori';

$url_img_firma_orig                          = $ruta_firma_orig.$nombre_archivo_firma.$formato;
$_SESSION['url_img_firma_sesion']            = $url_img_firma_orig;
$_SESSION['cod_cliente_sesion']            = $cod_cliente;

file_put_contents($url_img_firma_orig, $imagedata);
echo json_encode($url_img_firma_orig);
//$resultado_firma['status']                   = 1;
//$resultado_firma['url_img_firma_orig']       = $url_img_firma_orig;
//echo $url_img_firma_orig;
}
?>