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
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

$tab                         = addslashes($_POST['tab']);
$campo                       = addslashes($_POST['campo']);
$tipo                        = addslashes($_POST['tipo']);
$nombre_tab_mad              = addslashes($_POST['nombre_tab_mad']);
$nombre_campo_key            = addslashes($_POST['nombre_campo_key']);
$nombre_campo_calc           = addslashes($_POST['nombre_campo_calc']);
$nombre_campo_update         = addslashes($_POST['nombre_campo_update']);
$llave_tab_mad               = intval($_POST['llave_tab_mad']);

if ($tipo == 'eliminar') {
$llave                       = intval($_POST['llave']);

$borrar_sql = "DELETE FROM $tab WHERE $campo = '$llave'";
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$obtener_info_ingre_operacional = "SELECT SUM($nombre_campo_calc) AS total_costo_movimiento_contable FROM $tab 
WHERE ($nombre_campo_key = '$llave_tab_mad') AND (nombre_tipo_movimiento = 'DEBITOS')";
$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
$info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional);

$total_costo_movimiento_contable    = $info_ingre_operacional['total_costo_movimiento_contable'];

$agregar_total_nota_credit = "UPDATE $nombre_tab_mad SET $nombre_campo_update = '$total_costo_movimiento_contable' 
WHERE $nombre_campo_key = '$llave_tab_mad'";
$resultado_total_nota_credit = mysqli_query($conectar, $agregar_total_nota_credit) or die(mysqli_error($conectar));
} 
?>