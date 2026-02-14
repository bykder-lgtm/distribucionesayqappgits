<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
require_once('../evitar_mensaje_error/error.php'); 
date_default_timezone_set("America/Bogota");

include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
      } else { header("Location:../index.php");
}
$cuenta_actual                                  = addslashes($_SESSION['usuario']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_mquina_impr = "SELECT nombre_maquina, nombre_impresora FROM tbl15_administrador WHERE cuenta = '$cuenta_actual'";
$resultado_info_mquina_impr = mysqli_query($conectar, $obtener_info_mquina_impr)or die(mysqli_error($conectar));
$info_mquina_impr = mysqli_fetch_assoc($resultado_info_mquina_impr);

$nombre_maquina             = $info_mquina_impr['nombre_maquina'];
$nombre_impresora           = $info_mquina_impr['nombre_impresora'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\CapabilityProfiles\EposTepCapabilityProfile;
//$connector = new WindowsPrintConnector($nombre_impresora);
$connector = new WindowsPrintConnector("smb://".$nombre_maquina."/".$nombre_impresora);
//$printer = new Printer($connector, $profile);
$printer = new Printer($connector);
echo "1";
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->pulse();
/* Para imprimir realmente, tenemos que "cerrar" la conexión con la impresora. Recuerda incluir esto al final de todos los archivos */
$printer->close();
?>