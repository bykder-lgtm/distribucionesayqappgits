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
if ($tipo == 'editar') {
	$cod_cuentas_cobrar_alerta             = intval($_POST['cod_cuentas_cobrar_alerta']);
	$cod_cuentas_cobrar                    = intval($_POST['cod_cuentas_cobrar']);
	$monto_deuda_alerta                    = addslashes($_POST['monto_deuda_alerta']);
	$deduccion_retefuente                  = addslashes($_POST['deduccion_retefuente']);
	$deduccion_reparacion                  = addslashes($_POST['deduccion_reparacion']);
	$ingreso_gasto_juridica                = addslashes($_POST['ingreso_gasto_juridica']);
	$deduccion_otro_impuesto_dian          = addslashes($_POST['deduccion_otro_impuesto_dian']);
	$ingreso_administracion_incluida       = addslashes($_POST['ingreso_administracion_incluida']);
	$deduccion_saldo_favor                 = addslashes($_POST['deduccion_saldo_favor']);
	$ingreso_deudas_anteriores             = addslashes($_POST['ingreso_deudas_anteriores']);
	$total_pagar                           = addslashes($_POST['total_pagar']);
	$total_pendiente                       = addslashes($_POST['total_pendiente']);
	$total_deduccion                       = addslashes($_POST['total_deduccion']);
	$total_ingreso                         = addslashes($_POST['total_ingreso']);
	$monto_cuota_interes                   = addslashes($_POST['monto_cuota_interes']);
	$fecha_pago_reg                        = addslashes($_POST['fecha_pago_reg']);
	$deduccion_servicio                    = addslashes($_POST['deduccion_servicio']);
	$deduccion_otro_concepto               = addslashes($_POST['deduccion_otro_concepto']);
	$ingreso_otro_concepto                 = addslashes($_POST['ingreso_otro_concepto']);

	$deduccion_servicio_energia            = addslashes($_POST['deduccion_servicio_energia']);
	$deduccion_servicio_agua               = addslashes($_POST['deduccion_servicio_agua']);
	$deduccion_servicio_gas                = addslashes($_POST['deduccion_servicio_gas']);
	$deduccion_deudas_anteriores           = addslashes($_POST['deduccion_deudas_anteriores']);

	$monto_deuda                           = $monto_deuda_alerta;
	$monto_deuda_sin_interes               = $monto_deuda_alerta;
	$subtotal                              = $monto_deuda_alerta;
	$subtotal_sin_interes                  = $monto_deuda_alerta;
	$monto_cuota                           = $monto_deuda_alerta;
	$monto_cuota_sin_interes               = $monto_deuda_alerta;

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET deduccion_retefuente = '$deduccion_retefuente', deduccion_reparacion = '$deduccion_reparacion', 
	ingreso_gasto_juridica = '$ingreso_gasto_juridica', deduccion_otro_impuesto_dian = '$deduccion_otro_impuesto_dian', ingreso_administracion_incluida = '$ingreso_administracion_incluida', 
	deduccion_saldo_favor = '$deduccion_saldo_favor', ingreso_deudas_anteriores = '$ingreso_deudas_anteriores', total_pagar = '$total_pagar', total_pendiente = '$total_pendiente', 
	total_deduccion = '$total_deduccion', total_ingreso = '$total_ingreso', monto_cuota_interes = '$monto_cuota_interes', fecha_pago_reg = '$fecha_pago_reg', 
	deduccion_servicio = '$deduccion_servicio', deduccion_otro_concepto = '$deduccion_otro_concepto', ingreso_otro_concepto = '$ingreso_otro_concepto', 
	deduccion_servicio_energia = '$deduccion_servicio_energia', deduccion_servicio_agua = '$deduccion_servicio_agua', deduccion_servicio_gas = '$deduccion_servicio_gas', 
	deduccion_deudas_anteriores = '$deduccion_deudas_anteriores', monto_deuda = '$monto_deuda', monto_deuda_sin_interes = '$monto_deuda_sin_interes', subtotal = '$subtotal', 
	subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota = '$monto_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes'
	WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_abonos SET deduccion_retefuente = '$deduccion_retefuente', deduccion_reparacion = '$deduccion_reparacion', 
	ingreso_gasto_juridica = '$ingreso_gasto_juridica', deduccion_otro_impuesto_dian = '$deduccion_otro_impuesto_dian', ingreso_administracion_incluida = '$ingreso_administracion_incluida', 
	deduccion_saldo_favor = '$deduccion_saldo_favor', ingreso_deudas_anteriores = '$ingreso_deudas_anteriores', total_pagar = '$total_pagar', total_pendiente = '$total_pendiente', 
	total_deduccion = '$total_deduccion', total_ingreso = '$total_ingreso', monto_cuota_interes = '$monto_cuota_interes', fecha_pago_reg = '$fecha_pago_reg', 
	deduccion_servicio = '$deduccion_servicio', deduccion_otro_concepto = '$deduccion_otro_concepto', ingreso_otro_concepto = '$ingreso_otro_concepto', 
	deduccion_servicio_energia = '$deduccion_servicio_energia', deduccion_servicio_agua = '$deduccion_servicio_agua', deduccion_servicio_gas = '$deduccion_servicio_gas', 
	deduccion_deudas_anteriores = '$deduccion_deudas_anteriores', monto_deuda = '$monto_deuda', monto_deuda_sin_interes = '$monto_deuda_sin_interes', subtotal = '$subtotal', 
	subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota = '$monto_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes' 
	WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

	if ($campo = 'deduccion_saldo_favor') {

		$sql_cuentas_cobrar_alerta = "SELECT cod_factura FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
		$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
		$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

		$cod_factura         = $datos_cuentas_cobrar_alerta['cod_factura'];

		$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar SET deduccion_saldo_favor = '$deduccion_saldo_favor' WHERE (cod_factura = '$cod_factura')";
		$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
	}

}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>