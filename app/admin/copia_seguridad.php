<?php
include_once('../conexiones/conexione.php');
date_default_timezone_set('America/Bogota');
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
$cod_curl                               = 1;
$fecha_hoy                              = time();
$fecha_hoy_time                         = time();
$fecha_ymd_his                          = date("Y-m-d H:i:s");
 // ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$nombre_archivo_txt         = $base_datos.'.txt';
$nombre_archivo_zip         = $base_datos.'_'.date("Y_m_d__H_i_s");
$ruta_archivo               = '../Bases_cron/';
$ruta_nombre_archivo_txt    = $ruta_archivo.$nombre_archivo_txt;
$ruta_nombre_archivo_zip    = $ruta_archivo.$nombre_archivo_zip;

$command = 'C:\xampp\mysql\bin\mysqldump --opt -u '.$conexion_usuario.' -p'.$conexion_contrasena.' '.$base_datos.' > '.$ruta_nombre_archivo_txt;
system($command, $output); //Ejecutamos el comando para respaldo

$zip                        = new ZipArchive(); //Objeto de Libreria ZipArchive
//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
$salida_ruta_nombre_zip     = $ruta_archivo.$nombre_archivo_zip.'.zip';

if($zip->open($salida_ruta_nombre_zip, ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
	$zip->addFile($ruta_nombre_archivo_txt); //Agregamos el archivo SQL a ZIP
	$zip->close(); //Cerramos el ZIP
	unlink($ruta_nombre_archivo_txt); //Eliminamos el archivo temporal SQL
	//header ("Location: $salida_ruta_nombre_zip"); // Redireccionamos para descargar el Arcivo ZIP
	} else {
	//echo 'Error'; //Enviamos el mensaje de error
}
?>