<?php
session_start();
date_default_timezone_set("America/Bogota");
//set random name for the image, used time() for uniqueness
if (isset($_REQUEST['cod_tercero'])) {

	$ruta_foto_orig                        = '../archivador/foto/original/';
	$nombre_foto_cryp                      = date("YmsHis");
	$formato                               = '.jpg';
	$respuesta_json                        = "";

	$cod_tercero                           = intval($_REQUEST['cod_tercero']);
	$identificacion_tercero                = intval($_REQUEST['identificacion_tercero']);
	$parte_foto_cedula                     = addslashes($_REQUEST['parte_foto_cedula']);

	$fecha_ymdHis                          = date("YmdHis");
	$nombre_archivo_foto                   = $fecha_ymdHis.'_'.'CEDULA'.'_'.$parte_foto_cedula.'_'.$cod_tercero.'_'.$identificacion_tercero.'_ori';

	$url_img_foto_orig                     = $ruta_foto_orig.$nombre_archivo_foto.$formato;
	$_SESSION['url_img_foto_sesion']       = $url_img_foto_orig;

	move_uploaded_file($_FILES['webcam']['tmp_name'], $url_img_foto_orig);
	echo $url_img_foto_orig;
	//echo json_encode($url_img_foto_orig);
/*
	$datos_json = '';
	$datos_json .= '	{ ';
	$datos_json .= '   		 	"cod_tercero": ' .$cod_tercero. ', ';
	$datos_json .= '			"url_img_foto_orig": "' .$url_img_foto_orig. '", ';
	$datos_json .= '			"parte_foto_cedula": "' .$parte_foto_cedula. '" ';
	$datos_json .= '	} ';
	header('Content-Type: application/json');
	echo ($datos_json);
*/
}
?>