<?php
session_start();
date_default_timezone_set("America/Bogota");
//set random name for the image, used time() for uniqueness
$ruta_foto_orig                        = '../archivador/foto/original/';
$nombre_foto_cryp                      = date("YmsHis");
$formato                               = '.jpg';
$cod_cliente                           = $_SESSION['cod_cliente_sesion'];
$cedula                                = $_SESSION['cedula_sesion'];
$fecha_ymdHis                          = date("YmdHis");
$nombre_archivo_foto                   = $fecha_ymdHis.'_'.$cod_cliente.'_'.$cedula.'_ori';

$url_img_foto_orig                     = $ruta_foto_orig.$nombre_archivo_foto.$formato;

$_SESSION['url_img_foto_sesion']       = $url_img_foto_orig;

move_uploaded_file($_FILES['webcam']['tmp_name'], $url_img_foto_orig);
echo $url_img_foto_orig;
//echo json_encode($url_img_foto_orig);
?>
