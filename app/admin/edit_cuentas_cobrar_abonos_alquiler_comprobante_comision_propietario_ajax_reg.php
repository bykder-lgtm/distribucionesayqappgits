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
if (($tipo == 'editar') && ($campo <> 'monto_deuda_alerta')) {
	$cod_cuentas_cobrar_factura_comision_propietario      = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
	$cod_cuentas_cobrar                                   = intval($_POST['cod_cuentas_cobrar']);
	$deduccion_retefuente                                 = addslashes($_POST['deduccion_retefuente']);
	$deduccion_reparacion                                 = addslashes($_POST['deduccion_reparacion']);
	$ingreso_gasto_juridica                               = addslashes($_POST['ingreso_gasto_juridica']);
	$deduccion_otro_impuesto_dian                         = addslashes($_POST['deduccion_otro_impuesto_dian']);
	$ingreso_administracion_incluida                      = addslashes($_POST['ingreso_administracion_incluida']);
	$deduccion_saldo_favor                                = addslashes($_POST['deduccion_saldo_favor']);
	$ingreso_deudas_anteriores                            = addslashes($_POST['ingreso_deudas_anteriores']);
	$total_pagar                                          = addslashes($_POST['total_pagar']);
	$total_pendiente                                      = addslashes($_POST['total_pendiente']);
	$total_deduccion                                      = addslashes($_POST['total_deduccion']);
	$total_ingreso                                        = addslashes($_POST['total_ingreso']);
	$monto_cuota_interes                                  = addslashes($_POST['monto_cuota_interes']);
	$fecha_pago_reg                                       = addslashes($_POST['fecha_pago_reg']);
	$deduccion_servicio                                   = addslashes($_POST['deduccion_servicio']);
	$deduccion_otro_concepto                              = addslashes($_POST['deduccion_otro_concepto']);
	$ingreso_otro_concepto                                = addslashes($_POST['ingreso_otro_concepto']);
	$ingreso_impuesto_iva                                 = addslashes($_POST['ingreso_impuesto_iva']);

	$deduccion_servicio_energia                           = addslashes($_POST['deduccion_servicio_energia']);
	$deduccion_servicio_agua                              = addslashes($_POST['deduccion_servicio_agua']);
	$deduccion_servicio_gas                               = addslashes($_POST['deduccion_servicio_gas']);
	$deduccion_deudas_anteriores                          = addslashes($_POST['deduccion_deudas_anteriores']);
	$deduccion_imp_cuatroxmil                             = addslashes($_POST['deduccion_imp_cuatroxmil']);
	$deduccion_comision                                   = addslashes($_POST['deduccion_comision']);
	$deduccion_comision_ptj                               = addslashes($_POST['deduccion_comision_ptj']);

	$abonado                                              = $total_pagar;
	$total_recibido                                       = $total_pagar;

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET deduccion_retefuente = '$deduccion_retefuente', deduccion_reparacion = '$deduccion_reparacion', 
	ingreso_gasto_juridica = '$ingreso_gasto_juridica', deduccion_otro_impuesto_dian = '$deduccion_otro_impuesto_dian', ingreso_administracion_incluida = '$ingreso_administracion_incluida', 
	deduccion_saldo_favor = '$deduccion_saldo_favor', ingreso_deudas_anteriores = '$ingreso_deudas_anteriores', total_pagar = '$total_pagar', total_pendiente = '$total_pendiente', 
	total_deduccion = '$total_deduccion', total_ingreso = '$total_ingreso', monto_cuota_interes = '$monto_cuota_interes', fecha_pago_reg = '$fecha_pago_reg', 
	deduccion_servicio = '$deduccion_servicio', deduccion_otro_concepto = '$deduccion_otro_concepto', ingreso_otro_concepto = '$ingreso_otro_concepto', ingreso_impuesto_iva = '$ingreso_impuesto_iva', 
	deduccion_servicio_energia = '$deduccion_servicio_energia', deduccion_servicio_agua = '$deduccion_servicio_agua', deduccion_servicio_gas = '$deduccion_servicio_gas', 
	deduccion_deudas_anteriores = '$deduccion_deudas_anteriores', deduccion_imp_cuatroxmil = '$deduccion_imp_cuatroxmil', deduccion_comision = '$deduccion_comision', 
	abonado = '$abonado', total_recibido = '$total_recibido', deduccion_comision_ptj = '$deduccion_comision_ptj' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
	/*
	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET deduccion_retefuente = '$deduccion_retefuente', deduccion_reparacion = '$deduccion_reparacion', 
	ingreso_gasto_juridica = '$ingreso_gasto_juridica', deduccion_otro_impuesto_dian = '$deduccion_otro_impuesto_dian', ingreso_administracion_incluida = '$ingreso_administracion_incluida', 
	deduccion_saldo_favor = '$deduccion_saldo_favor', ingreso_deudas_anteriores = '$ingreso_deudas_anteriores', total_pagar = '$total_pagar', total_pendiente = '$total_pendiente', 
	total_deduccion = '$total_deduccion', total_ingreso = '$total_ingreso', monto_cuota_interes = '$monto_cuota_interes', fecha_pago_reg = '$fecha_pago_reg', 
	deduccion_servicio = '$deduccion_servicio', deduccion_otro_concepto = '$deduccion_otro_concepto', ingreso_otro_concepto = '$ingreso_otro_concepto', 
	deduccion_servicio_energia = '$deduccion_servicio_energia', deduccion_servicio_agua = '$deduccion_servicio_agua', deduccion_servicio_gas = '$deduccion_servicio_gas', 
	deduccion_deudas_anteriores = '$deduccion_deudas_anteriores' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
*/
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'monto_deuda_alerta')) {
	$cod_cuentas_cobrar_factura_comision_propietario      = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
	$cod_cuentas_cobrar                                   = intval($_POST['cod_cuentas_cobrar']);
	$deduccion_retefuente                                 = addslashes($_POST['deduccion_retefuente']);
	$deduccion_reparacion                                 = addslashes($_POST['deduccion_reparacion']);
	$ingreso_gasto_juridica                               = addslashes($_POST['ingreso_gasto_juridica']);
	$deduccion_otro_impuesto_dian                         = addslashes($_POST['deduccion_otro_impuesto_dian']);
	$ingreso_administracion_incluida                      = addslashes($_POST['ingreso_administracion_incluida']);
	$deduccion_saldo_favor                                = addslashes($_POST['deduccion_saldo_favor']);
	$ingreso_deudas_anteriores                            = addslashes($_POST['ingreso_deudas_anteriores']);
	$total_pagar                                          = addslashes($_POST['total_pagar']);
	$total_pendiente                                      = addslashes($_POST['total_pendiente']);
	$total_deduccion                                      = addslashes($_POST['total_deduccion']);
	$total_ingreso                                        = addslashes($_POST['total_ingreso']);
	$monto_cuota_interes                                  = addslashes($_POST['monto_cuota_interes']);
	$fecha_pago_reg                                       = addslashes($_POST['fecha_pago_reg']);
	$deduccion_servicio                                   = addslashes($_POST['deduccion_servicio']);
	$deduccion_otro_concepto                              = addslashes($_POST['deduccion_otro_concepto']);
	$ingreso_otro_concepto                                = addslashes($_POST['ingreso_otro_concepto']);
	$ingreso_impuesto_iva                                 = addslashes($_POST['ingreso_impuesto_iva']);

	$deduccion_servicio_energia                           = addslashes($_POST['deduccion_servicio_energia']);
	$deduccion_servicio_agua                              = addslashes($_POST['deduccion_servicio_agua']);
	$deduccion_servicio_gas                               = addslashes($_POST['deduccion_servicio_gas']);
	$deduccion_deudas_anteriores                          = addslashes($_POST['deduccion_deudas_anteriores']);
	$deduccion_imp_cuatroxmil                             = addslashes($_POST['deduccion_imp_cuatroxmil']);
	$deduccion_comision                                   = addslashes($_POST['deduccion_comision']);
	$deduccion_comision_ptj                               = addslashes($_POST['deduccion_comision_ptj']);
	$monto_deuda                                          = addslashes($_POST['monto_deuda_alerta']);

	$abonado                                              = $total_pagar;
	$total_recibido                                       = $total_pagar;

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET monto_deuda = '$monto_deuda' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'editar_fecha_pago') {
	$cod_cuentas_cobrar_factura_comision_propietario     = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
	$fecha_pago_reg                                      = addslashes($_POST['fecha_pago_reg']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET fecha_pago_reg = '$fecha_pago_reg' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'editar_cod_tipo_forma_pago') {
	$cod_cuentas_cobrar_factura_comision_propietario     = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
	$cod_tipo_forma_pago                                 = intval($_POST['cod_tipo_forma_pago']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'editar_cod_administrador') {
	$cod_cuentas_cobrar_factura_comision_propietario     = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
	$cod_administrador                                   = intval($_POST['cod_administrador']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET cod_administrador = '$cod_administrador' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'editar_mensaje') {
	$cod_cuentas_cobrar_factura_comision_propietario     = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
	$mensaje                                             = addslashes($_POST['mensaje']);

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET mensaje = '$mensaje' 
	WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>