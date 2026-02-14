<?php
date_default_timezone_set("America/Bogota");
if (isset($_POST['cod_cliente'])) { $cod_cliente = intval($_POST['cod_cliente']); } else { $cod_cliente = 0; }
if (isset($_POST['cedula'])) { $cedula = intval($_POST['cedula']); } else { $cedula = 0; }

$fecha_ymdHis                                = date("YmdHis");
$resultado_firma                             = array();
$imagedata                                   = base64_decode($_POST['img_data']);
$nombre_firma_cryp                           = crc32($fecha_ymdHis);
$nombre_archivo_firma                        = $fecha_ymdHis.'_'.$cod_cliente.'_'.$cedula.'_ori';

//Location to where you want to created sign image
$url_img_firma_orig                          = '../archivador/firma/original/'.$nombre_archivo_firma.'.jpg';
file_put_contents($url_img_firma_orig, $imagedata);
$resultado_firma['status']                   = 1;
$resultado_firma['url_img_firma_orig']       = $url_img_firma_orig;
echo json_encode($url_img_firma_orig);
//echo $url_img_firma_orig;
?>