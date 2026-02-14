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

if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); } else { $id = '0'; }
if (isset($_REQUEST['codigo_puc'])) { $codigo_puc = addslashes($_REQUEST['codigo_puc']); } else { $codigo_puc = '0'; }
if (isset($_REQUEST['nombre_puc'])) { $nombre_puc = addslashes($_REQUEST['nombre_puc']); } else { $nombre_puc = '0'; }
if (isset($_REQUEST['campo'])) { $campo = addslashes($_REQUEST['campo']); } else { $campo = '0'; }
if (isset($_REQUEST['valor'])) { $valor_intro = addslashes($_REQUEST['valor']); } else { $valor_intro = '0'; }
if (isset($_REQUEST['jqui'])) { $jqui = addslashes($_REQUEST['jqui']); } else { $jqui = '0'; }
//**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_ingre_operacional' && $jqui == '0') {
$puc_ingre_operacional         = intval($valor_intro);
$cod_ingre_operacional         = $id;

$agregar_reg_pyg = "UPDATE tbl15_ingre_operacional SET puc_ingre_operacional = '$puc_ingre_operacional' 
WHERE cod_ingre_operacional = '$cod_ingre_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_ingre_operacional[]' && $jqui == 'jqui') {
$puc_ingre_operacional          = $codigo_puc;
$nombre_ingre_operacional       = $nombre_puc;
$cod_ingre_operacional          = $id;

$agregar_reg_pyg = "UPDATE tbl15_ingre_operacional SET puc_ingre_operacional = '$puc_ingre_operacional',
nombre_ingre_operacional = '$nombre_ingre_operacional' WHERE cod_ingre_operacional = '$cod_ingre_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_ingre_operacional' && $jqui == '0') {
$nombre_ingre_operacional      = addslashes($valor_intro);
$cod_ingre_operacional         = $id;

$agregar_reg_pyg = "UPDATE tbl15_ingre_operacional SET nombre_ingre_operacional = '$nombre_ingre_operacional' WHERE cod_ingre_operacional = '$cod_ingre_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
//**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_costo_operacional' && $jqui == '0') {
$puc_costo_operacional         = intval($valor_intro);
$cod_costo_operacional         = $id;

$agregar_reg_pyg = "UPDATE tbl15_costo_operacional SET puc_costo_operacional = '$puc_costo_operacional' 
WHERE cod_costo_operacional = '$cod_costo_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_costo_operacional[]' && $jqui == 'jqui') {
$puc_costo_operacional          = $codigo_puc;
$nombre_costo_operacional       = $nombre_puc;
$cod_costo_operacional          = $id;

$agregar_reg_pyg = "UPDATE tbl15_costo_operacional SET puc_costo_operacional = '$puc_costo_operacional',
nombre_costo_operacional = '$nombre_costo_operacional' WHERE cod_costo_operacional = '$cod_costo_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_costo_operacional' && $jqui == '0') {
$nombre_costo_operacional      = addslashes($valor_intro);
$cod_costo_operacional         = $id;

$agregar_reg_pyg = "UPDATE tbl15_costo_operacional SET nombre_costo_operacional = '$nombre_costo_operacional' WHERE cod_costo_operacional = '$cod_costo_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
//**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_gasto_operacional' && $jqui == '0') {
$puc_gasto_operacional         = intval($valor_intro);
$cod_gasto_operacional         = $id;

$agregar_reg_pyg = "UPDATE tbl15_gasto_operacional SET puc_gasto_operacional = '$puc_gasto_operacional' 
WHERE cod_gasto_operacional = '$cod_gasto_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_gasto_operacional[]' && $jqui == 'jqui') {
$puc_gasto_operacional          = $codigo_puc;
$nombre_gasto_operacional       = $nombre_puc;
$cod_gasto_operacional          = $id;

$agregar_reg_pyg = "UPDATE tbl15_gasto_operacional SET puc_gasto_operacional = '$puc_gasto_operacional',
nombre_gasto_operacional = '$nombre_gasto_operacional' WHERE cod_gasto_operacional = '$cod_gasto_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_gasto_operacional' && $jqui == '0') {
$nombre_gasto_operacional      = addslashes($valor_intro);
$cod_gasto_operacional         = $id;

$agregar_reg_pyg = "UPDATE tbl15_gasto_operacional SET nombre_gasto_operacional = '$nombre_gasto_operacional' WHERE cod_gasto_operacional = '$cod_gasto_operacional'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
//**************************************************************************************************//
//**************************************************************************************************//
?>