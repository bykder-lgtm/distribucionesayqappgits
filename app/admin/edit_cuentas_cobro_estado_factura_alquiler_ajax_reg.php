<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php'); 
 date_default_timezone_set("America/Bogota");
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = ($_SESSION['usuario']);
$tab                                   = addslashes($_GET['tab']);
$tipo                                  = addslashes($_GET['tipo']);
$campo                                 = addslashes($_GET['campo']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'cod_estado')) {
	$cod_estado                            = intval($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado = '$cod_estado' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado = '$cod_estado' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'cod_estado_pago_propietario')) {
	$cod_estado_pago_propietario           = intval($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_pago_propietario = '$cod_estado_pago_propietario' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_pago_propietario = '$cod_estado_pago_propietario' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'fecha_alerta_pago_comision_prop')) {
	$fecha_alerta_pago_comision_prop       = addslashes($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET fecha_alerta_pago_comision_prop = '$fecha_alerta_pago_comision_prop' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'cod_estado_pago')) {
	$cod_estado_pago                       = intval($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_pago = '$cod_estado_pago' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_pago = '$cod_estado_pago' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'cod_tipo_forma_pago')) {
	$cod_tipo_forma_pago                   = intval($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'nombre_tabla_mes')) {
	$nombre_tabla_mes                      = addslashes($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);
	$fecha_mes                             = date("Y").'-'.$nombre_tabla_mes;

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET fecha_mes = '$fecha_mes' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET fecha_mes = '$fecha_mes' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'mensaje')) {
	$mensaje                               = addslashes($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET mensaje = '$mensaje' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET mensaje = '$mensaje' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'cod_estado_envio_correo')) {
	$cod_estado_envio_correo               = intval($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_envio_correo_cuenta_cobro = '$cod_estado_envio_correo' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_envio_correo_cuenta_cobro = '$cod_estado_envio_correo' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'numero_alerta')) {
	$numero_alerta                         = intval($_GET['valor']);
	$cod_cuentas_cobrar_alerta             = intval($_GET['id']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET numero_alerta = '$numero_alerta' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET numero_alerta = '$numero_alerta' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>