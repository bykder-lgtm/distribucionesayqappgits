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

$cod_pyg                       = intval($_GET['cod_pyg']);
$campo                         = addslashes($_GET['campo']);
$fecha_mes                     = addslashes($_GET['fecha_mes']);
//$anyo                          = addslashes($_GET['anyo']);

$obtener_info_pyg = "SELECT fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo FROM tbl15_pyg WHERE cod_pyg = '$cod_pyg'";
$resultado_info_pyg = mysqli_query($conectar, $obtener_info_pyg) or die(mysqli_error($conectar));
$info_pyg = mysqli_fetch_assoc($resultado_info_pyg);

$fecha_anyo                       = $info_pyg['fecha_anyo'];
$fecha_mes                        = $info_pyg['fecha_mes'];
$fecha_seg                        = $info_pyg['fecha_seg'];
$fecha_ymd                        = $info_pyg['fecha_ymd'];
$anyo                             = $info_pyg['anyo'];
$ip                               = $_SERVER["REMOTE_ADDR"];
$cuenta                           = $cuenta_actual;

if ($campo == 'ingre_operacional') {

$data_sql = "INSERT INTO tbl15_ingre_operacional (cod_pyg, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
VALUES ('$cod_pyg', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$url_redir = "../admin/edit_pyg.php?cod_pyg=".$cod_pyg."&fecha_mes=".$fecha_mes;
header("Location: $url_redir");
}

if ($campo == 'costo_operacional') {

$data_sql = "INSERT INTO tbl15_costo_operacional (cod_pyg, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
VALUES ('$cod_pyg', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$url_redir = "../admin/edit_pyg.php?cod_pyg=".$cod_pyg."&fecha_mes=".$fecha_mes;
header("Location: $url_redir");
}
if ($campo == 'gasto_operacional') {

$data_sql = "INSERT INTO tbl15_gasto_operacional (cod_pyg, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
VALUES ('$cod_pyg', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$url_redir = "../admin/edit_pyg.php?cod_pyg=".$cod_pyg."&fecha_mes=".$fecha_mes;
header("Location: $url_redir");
}
?>