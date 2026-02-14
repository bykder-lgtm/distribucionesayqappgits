<?php
$ruta_directorio_actual       = dirname(__FILE__);
$nombre_archivo_bat           = 'cron_copia_seguridad.bat';

exec('c:\windows\system32\cmd.exe /c '.$ruta_directorio_actual.'\cron_copia_seguridad.bat');
//--------------------------------------------------------------------------------------------------//
include_once('../conexiones/conexione.php');
include_once('../session/funciones_admin.php');
date_default_timezone_set("America/Bogota");
include_once('../evitar_mensaje_error/error.php'); 
verificar_usuario();

$cuenta_actual               = addslashes($_SESSION['usuario']);

$obtener_cod_sesion = "SELECT cod_sesion FROM tbl15_sesion WHERE usuario = '$cuenta_actual' ORDER BY cod_sesion DESC LIMIT 1";
$resultado_cod_sesion = mysqli_query($conectar, $obtener_cod_sesion) or die(mysqli_error($conectar));
$matriz_cod_sesion = mysqli_fetch_assoc($resultado_cod_sesion);

$cod_sesion                  = $matriz_cod_sesion['cod_sesion'];
$ips                         = $_SERVER['REMOTE_ADDR'];
$fecha_salida_time           = time();
$fecha_salida                = date("Y-m-d H:i:s");
/*
$agregar_regis = sprintf("UPDATE tbl15_sesion SET fecha_salida_time = '$fecha_salida_time', fecha_salida = '$fecha_salida' WHERE (cod_sesion = '$cod_sesion')");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

session_unset();
session_destroy();
session_start();
session_regenerate_id(true);
*/
?>