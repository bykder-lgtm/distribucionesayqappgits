<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                        = ($_SESSION['usuario']);
$tab                           = addslashes($_POST['tab']);
$tipo                          = addslashes($_POST['tipo']);
$campo                         = addslashes($_POST['campo']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'total_recibido')) {
$cod_cuentas_cobrar_alerta             = intval($_POST['cod_cuentas_cobrar_alerta']);
$cod_cuentas_cobrar                    = intval($_POST['cod_cuentas_cobrar']);
$total_recibido                        = addslashes($_POST['total_recibido']);

$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET total_recibido = '$total_recibido' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET total_recibido = '$total_recibido' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'total_pendiente')) {
$cod_cuentas_cobrar_alerta             = intval($_POST['cod_cuentas_cobrar_alerta']);
$cod_cuentas_cobrar                    = intval($_POST['cod_cuentas_cobrar']);
$total_pendiente                       = addslashes($_POST['total_pendiente']);

$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET total_pendiente = '$total_pendiente' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET total_pendiente = '$total_pendiente' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>