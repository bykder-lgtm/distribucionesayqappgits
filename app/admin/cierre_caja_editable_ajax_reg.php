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


$valor_intro             = addslashes($_GET['valor']);
$campo                   = addslashes($_GET['campo']);
$cod_cierre_cajas        = intval($_GET['id']);

if ($campo == 'comentario') {

$comentario = addslashes($valor_intro); 

$data_sql = ("UPDATE tbl15_cierre_caja SET comentario = '$comentario' WHERE cod_cierre_cajas = '$cod_cierre_cajas'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'cod_producto_barra') {

}
else {

}
?>