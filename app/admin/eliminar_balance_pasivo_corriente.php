<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if ((isset($_GET['cod_pasivo_corriente'])) && ($_GET['cod_pasivo_corriente'] != "")) {

$cod_pasivo_corriente            = intval($_GET["cod_pasivo_corriente"]);
$cod_balance_general             = intval($_GET["cod_balance_general"]);

$borrar_sql = ("DELETE FROM tbl15_pasivo_corriente WHERE cod_pasivo_corriente = '$cod_pasivo_corriente'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$url_redir = "../admin/edit_balance_general.php?cod_balance_general=".$cod_balance_general;
header("Location: $url_redir");
}
?>