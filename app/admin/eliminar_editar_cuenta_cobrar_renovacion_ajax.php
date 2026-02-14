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
$cod_administrador  = $_SESSION['cod_administrador'];
include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                        = $info_empresa_data['titulo'];
$nombre_emp                                        = $info_empresa_data['nombre'];
$eslogan_emp                                       = $info_empresa_data['eslogan'];
$direccion_emp                                     = $info_empresa_data['direccion'];
$ciudad_emp                                        = $info_empresa_data['ciudad'];
$pais_emp                                          = $info_empresa_data['pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
$cuenta_actual      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
$tab                                = addslashes($_GET['tab']);
$tipo                               = addslashes($_GET['tipo']);
$campo                              = addslashes($_GET['campo']);
$pagina                             = addslashes($_GET['pagina']);

$fecha_elim                         = date("Y-m-d H:i:s");	
$usuario_elim                       = $cuenta_actual;


if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_Eliminar_Renovacion_cod_cuentas_cobrar_alerta_ajax') {
	$cod_cuentas_cobrar_alerta     = intval($_GET['llave']);
	$cod_cuentas_cobrar            = intval($_GET['cod_cuentas_cobrar']);
	$cod_tercero                   = intval($_GET['cod_tercero']);
	$cod_factura                   = intval($_GET['cod_factura']);
	$pagina_redirect               = $pagina.'?cod_cuentas_cobrar'.$cod_cuentas_cobrar.'&cod_tercero'.$cod_tercero.'&cod_factura'.$cod_factura.'&pagina'.$pagina;

	$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta);
	$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

		$cod_cuentas_cobrar_abonos                    = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos']; 
		$numero_alerta                                = $datos_cuentas_cobrar_alerta['numero_alerta']; 
		$cod_factura                                  = $datos_cuentas_cobrar_alerta['cod_factura']; 
		$cod_clientes                                 = $datos_cuentas_cobrar_alerta['cod_clientes']; 
		$cod_tercero                                  = $datos_cuentas_cobrar_alerta['cod_tercero']; 
		$cod_producto                                 = $datos_cuentas_cobrar_alerta['cod_producto']; 
		$cod_producto_barra                           = $datos_cuentas_cobrar_alerta['cod_producto_barra']; 
		$nombre_producto                              = $datos_cuentas_cobrar_alerta['nombre_producto']; 
		$monto_deuda                                  = $datos_cuentas_cobrar_alerta['monto_deuda']; 
		$monto_deuda_sin_interes                      = $datos_cuentas_cobrar_alerta['monto_deuda_sin_interes']; 
		$subtotal                                     = $datos_cuentas_cobrar_alerta['subtotal']; 
		$subtotal_sin_interes                         = $datos_cuentas_cobrar_alerta['subtotal_sin_interes']; 
		$numero_cuota                                 = $datos_cuentas_cobrar_alerta['numero_cuota']; 
		$monto_cuota                                  = $datos_cuentas_cobrar_alerta['monto_cuota']; 
		$monto_cuota_sin_interes                      = $datos_cuentas_cobrar_alerta['monto_cuota_sin_interes']; 
		$interes_ptj                                  = $datos_cuentas_cobrar_alerta['interes_ptj']; 
		$monto_deuda_mas_interes                      = $datos_cuentas_cobrar_alerta['monto_deuda_mas_interes']; 
		$monto_cuota_interes                          = $datos_cuentas_cobrar_alerta['monto_cuota_interes']; 
		$total_recibido                               = $datos_cuentas_cobrar_alerta['total_recibido']; 
		$total_pendiente                              = $datos_cuentas_cobrar_alerta['total_pendiente']; 
		$nombre_tipo_cobro                            = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro']; 
		$descuento                                    = $datos_cuentas_cobrar_alerta['descuento']; 
		$abonado                                      = $datos_cuentas_cobrar_alerta['abonado']; 
		$total_pagar                                  = $datos_cuentas_cobrar_alerta['total_pagar']; 
		$mensaje                                      = $datos_cuentas_cobrar_alerta['mensaje']; 
		$vendedor                                     = $datos_cuentas_cobrar_alerta['vendedor']; 
		$cuenta                                       = $datos_cuentas_cobrar_alerta['cuenta']; 
		$deduccion_retefuente                         = $datos_cuentas_cobrar_alerta['deduccion_retefuente']; 
		$deduccion_reparacion                         = $datos_cuentas_cobrar_alerta['deduccion_reparacion']; 
		$deduccion_servicio                           = $datos_cuentas_cobrar_alerta['deduccion_servicio']; 
		$deduccion_otro_impuesto_dian                 = $datos_cuentas_cobrar_alerta['deduccion_otro_impuesto_dian']; 
		$deduccion_otro_concepto                      = $datos_cuentas_cobrar_alerta['deduccion_otro_concepto']; 
		$deduccion_servicio_energia                   = $datos_cuentas_cobrar_alerta['deduccion_servicio_energia']; 
		$deduccion_servicio_agua                      = $datos_cuentas_cobrar_alerta['deduccion_servicio_agua']; 
		$deduccion_servicio_gas                       = $datos_cuentas_cobrar_alerta['deduccion_servicio_gas']; 
		$deduccion_deudas_anteriores                  = $datos_cuentas_cobrar_alerta['deduccion_deudas_anteriores']; 
		$ingreso_administracion_incluida              = $datos_cuentas_cobrar_alerta['ingreso_administracion_incluida']; 
		$ingreso_gasto_juridica                       = $datos_cuentas_cobrar_alerta['ingreso_gasto_juridica']; 
		$deduccion_saldo_favor                        = $datos_cuentas_cobrar_alerta['deduccion_saldo_favor']; 
		$ingreso_otro_concepto                        = $datos_cuentas_cobrar_alerta['ingreso_otro_concepto']; 
		$ingreso_deudas_anteriores                    = $datos_cuentas_cobrar_alerta['ingreso_deudas_anteriores']; 
		$numero_deudas_anteriores                     = $datos_cuentas_cobrar_alerta['numero_deudas_anteriores']; 
		$total_deduccion                              = $datos_cuentas_cobrar_alerta['total_deduccion']; 
		$total_ingreso                                = $datos_cuentas_cobrar_alerta['total_ingreso']; 
		$fecha_pago                                   = $datos_cuentas_cobrar_alerta['fecha_pago']; 
		$fecha                                        = $datos_cuentas_cobrar_alerta['fecha']; 
		$fecha_mes                                    = $datos_cuentas_cobrar_alerta['fecha_mes']; 
		$anyo                                         = $datos_cuentas_cobrar_alerta['anyo']; 
		$fecha_invert                                 = $datos_cuentas_cobrar_alerta['fecha_invert']; 
		$fecha_seg                                    = $datos_cuentas_cobrar_alerta['fecha_seg']; 
		$fecha_pago_reg                               = $datos_cuentas_cobrar_alerta['fecha_pago_reg']; 
		$hora_pago_reg                                = $datos_cuentas_cobrar_alerta['hora_pago_reg']; 
		$fecha_creacion                               = $datos_cuentas_cobrar_alerta['fecha_creacion']; 
		$cod_info_factura_venta                       = $datos_cuentas_cobrar_alerta['cod_info_factura_venta']; 
		$url_img_orig_producto                        = $datos_cuentas_cobrar_alerta['url_img_orig_producto']; 
		$url_img_min_producto                         = $datos_cuentas_cobrar_alerta['url_img_min_producto']; 
		$cod_tipo_calificacion                        = $datos_cuentas_cobrar_alerta['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion                     = $datos_cuentas_cobrar_alerta['nombre_tipo_calificacion']; 
		$cod_administrador                            = $datos_cuentas_cobrar_alerta['cod_administrador']; 
		$cod_estado                                   = $datos_cuentas_cobrar_alerta['cod_estado']; 
		$cod_estado_contrato                          = $datos_cuentas_cobrar_alerta['cod_estado_contrato']; 
		$cod_tipo_forma_pago                          = $datos_cuentas_cobrar_alerta['cod_tipo_forma_pago']; 
		$cod_tipo_moneda                              = $datos_cuentas_cobrar_alerta['cod_tipo_moneda']; 
		$cod_estado_envio_correo_cuenta_cobro         = $datos_cuentas_cobrar_alerta['cod_estado_envio_correo_cuenta_cobro']; 
		$cod_estado_renovacio_contrato                = $datos_cuentas_cobrar_alerta['cod_estado_renovacio_contrato']; 
		$deduccion_comision                           = $datos_cuentas_cobrar_alerta['deduccion_comision']; 
		$cod_renovacion_contrato                      = $datos_cuentas_cobrar_alerta['cod_renovacion_contrato']; 

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_alerta_copia (cod_cuentas_cobrar_alerta, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, numero_alerta, cod_factura, cod_clientes, cod_tercero, 
		cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, 
		monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, 
		nombre_tipo_cobro, descuento, abonado, total_pagar, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, 
		deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, 
		deduccion_deudas_anteriores, ingreso_administracion_incluida, ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, 
		ingreso_deudas_anteriores, numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, 
		fecha_seg, fecha_pago_reg, hora_pago_reg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, 
		cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_tipo_moneda, 
		cod_estado_envio_correo_cuenta_cobro, cod_estado_renovacio_contrato, deduccion_comision, cod_renovacion_contrato, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_abonos', '$numero_alerta', '$cod_factura', '$cod_clientes', '$cod_tercero', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', 
		'$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', 
		'$nombre_tipo_cobro', '$descuento', '$abonado', '$total_pagar', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', 
		'$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', 
		'$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', 
		'$ingreso_deudas_anteriores', '$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', 
		'$fecha_seg', '$fecha_pago_reg', '$hora_pago_reg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', 
		'$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_tipo_moneda', 
		'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_renovacio_contrato', '$deduccion_comision', '$cod_renovacion_contrato', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$consulta_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos);
	$existe_cuentas_cobrar_abonos = mysqli_num_rows($consulta_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos);

		$cod_cuentas_cobrar_abonos                    = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos']; 
		$cod_factura                                  = $datos_cuentas_cobrar_abonos['cod_factura']; 
		$cod_clientes                                 = $datos_cuentas_cobrar_abonos['cod_clientes']; 
		$cod_tercero                                  = $datos_cuentas_cobrar_abonos['cod_tercero']; 
		$cod_producto                                 = $datos_cuentas_cobrar_abonos['cod_producto']; 
		$cod_producto_barra                           = $datos_cuentas_cobrar_abonos['cod_producto_barra']; 
		$nombre_producto                              = $datos_cuentas_cobrar_abonos['nombre_producto']; 
		$monto_deuda                                  = $datos_cuentas_cobrar_abonos['monto_deuda']; 
		$subtotal                                     = $datos_cuentas_cobrar_abonos['subtotal']; 
		$descuento                                    = $datos_cuentas_cobrar_abonos['descuento']; 
		$abonado                                      = $datos_cuentas_cobrar_abonos['abonado']; 
		$total_pagar                                  = $datos_cuentas_cobrar_abonos['total_pagar']; 
		$monto_deuda_sin_interes                      = $datos_cuentas_cobrar_abonos['monto_deuda_sin_interes']; 
		$subtotal_sin_interes                         = $datos_cuentas_cobrar_abonos['subtotal_sin_interes']; 
		$monto_cuota_sin_interes                      = $datos_cuentas_cobrar_abonos['monto_cuota_sin_interes']; 
		$total_recibido                               = $datos_cuentas_cobrar_abonos['total_recibido']; 
		$total_pendiente                              = $datos_cuentas_cobrar_abonos['total_pendiente']; 
		$interes_ptj                                  = $datos_cuentas_cobrar_abonos['interes_ptj']; 
		$monto_deuda_mas_interes                      = $datos_cuentas_cobrar_abonos['monto_deuda_mas_interes']; 
		$monto_cuota_interes                          = $datos_cuentas_cobrar_abonos['monto_cuota_interes']; 
		$mensaje                                      = $datos_cuentas_cobrar_abonos['mensaje']; 
		$cod_administrador                            = $datos_cuentas_cobrar_abonos['cod_administrador']; 
		$vendedor                                     = $datos_cuentas_cobrar_abonos['vendedor']; 
		$cuenta                                       = $datos_cuentas_cobrar_abonos['cuenta']; 
		$deduccion_retefuente                         = $datos_cuentas_cobrar_abonos['deduccion_retefuente']; 
		$deduccion_reparacion                         = $datos_cuentas_cobrar_abonos['deduccion_reparacion']; 
		$deduccion_servicio                           = $datos_cuentas_cobrar_abonos['deduccion_servicio']; 
		$deduccion_otro_impuesto_dian                 = $datos_cuentas_cobrar_abonos['deduccion_otro_impuesto_dian']; 
		$deduccion_otro_concepto                      = $datos_cuentas_cobrar_abonos['deduccion_otro_concepto']; 
		$deduccion_servicio_energia                   = $datos_cuentas_cobrar_abonos['deduccion_servicio_energia']; 
		$deduccion_servicio_agua                      = $datos_cuentas_cobrar_abonos['deduccion_servicio_agua']; 
		$deduccion_servicio_gas                       = $datos_cuentas_cobrar_abonos['deduccion_servicio_gas']; 
		$deduccion_deudas_anteriores                  = $datos_cuentas_cobrar_abonos['deduccion_deudas_anteriores']; 
		$ingreso_administracion_incluida              = $datos_cuentas_cobrar_abonos['ingreso_administracion_incluida']; 
		$ingreso_gasto_juridica                       = $datos_cuentas_cobrar_abonos['ingreso_gasto_juridica']; 
		$deduccion_saldo_favor                        = $datos_cuentas_cobrar_abonos['deduccion_saldo_favor']; 
		$ingreso_otro_concepto                        = $datos_cuentas_cobrar_abonos['ingreso_otro_concepto']; 
		$ingreso_deudas_anteriores                    = $datos_cuentas_cobrar_abonos['ingreso_deudas_anteriores']; 
		$numero_deudas_anteriores                     = $datos_cuentas_cobrar_abonos['numero_deudas_anteriores']; 
		$total_deduccion                              = $datos_cuentas_cobrar_abonos['total_deduccion']; 
		$total_ingreso                                = $datos_cuentas_cobrar_abonos['total_ingreso']; 
		$cod_abono_global                             = $datos_cuentas_cobrar_abonos['cod_abono_global']; 
		$fecha_pago                                   = $datos_cuentas_cobrar_abonos['fecha_pago']; 
		$fecha_anyo                                   = $datos_cuentas_cobrar_abonos['fecha_anyo']; 
		$fecha_mes                                    = $datos_cuentas_cobrar_abonos['fecha_mes']; 
		$anyo                                         = $datos_cuentas_cobrar_abonos['anyo']; 
		$fecha_invert                                 = $datos_cuentas_cobrar_abonos['fecha_invert']; 
		$fecha_seg                                    = $datos_cuentas_cobrar_abonos['fecha_seg']; 
		$hora                                         = $datos_cuentas_cobrar_abonos['hora']; 
		$fecha_pago_deuda                             = $datos_cuentas_cobrar_abonos['fecha_pago_deuda']; 
		$fecha_pago_reg                               = $datos_cuentas_cobrar_abonos['fecha_pago_reg']; 
		$hora_pago_reg                                = $datos_cuentas_cobrar_abonos['hora_pago_reg']; 
		$fecha_creacion                               = $datos_cuentas_cobrar_abonos['fecha_creacion']; 
		$cod_info_factura_venta                       = $datos_cuentas_cobrar_abonos['cod_info_factura_venta']; 
		$cod_estado                                   = $datos_cuentas_cobrar_abonos['cod_estado']; 
		$cod_estado_contrato                          = $datos_cuentas_cobrar_abonos['cod_estado_contrato']; 
		$cod_tipo_forma_pago                          = $datos_cuentas_cobrar_abonos['cod_tipo_forma_pago']; 
		$numero_alerta                                = $datos_cuentas_cobrar_abonos['numero_alerta']; 
		$url_img_orig_producto                        = $datos_cuentas_cobrar_abonos['url_img_orig_producto']; 
		$url_img_min_producto                         = $datos_cuentas_cobrar_abonos['url_img_min_producto']; 
		$cod_tipo_calificacion                        = $datos_cuentas_cobrar_abonos['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion                     = $datos_cuentas_cobrar_abonos['nombre_tipo_calificacion']; 
		$cod_dependencia                              = $datos_cuentas_cobrar_abonos['cod_dependencia']; 
		$cod_tipo_moneda                              = $datos_cuentas_cobrar_abonos['cod_tipo_moneda']; 
		$cod_estado_envio_correo_cuenta_cobro         = $datos_cuentas_cobrar_abonos['cod_estado_envio_correo_cuenta_cobro']; 
		$cod_estado_renovacio_contrato                = $datos_cuentas_cobrar_abonos['cod_estado_renovacio_contrato']; 
		$deduccion_comision                           = $datos_cuentas_cobrar_abonos['deduccion_comision']; 
		$cod_renovacion_contrato                      = $datos_cuentas_cobrar_abonos['cod_renovacion_contrato']; 

		if ($existe_cuentas_cobrar_abonos <> '0') {
			$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, 
			monto_deuda, subtotal, descuento, abonado, total_pagar, monto_deuda_sin_interes, subtotal_sin_interes, monto_cuota_sin_interes, 
			total_recibido, total_pendiente, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, mensaje, cod_administrador, vendedor, 
			cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, 
			deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, ingreso_administracion_incluida, 
			ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, numero_deudas_anteriores, total_deduccion, 
			total_ingreso, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_pago_deuda, fecha_pago_reg, 
			hora_pago_reg, fecha_creacion, cod_info_factura_venta, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, 
			numero_alerta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia, cod_tipo_moneda, 
			cod_estado_envio_correo_cuenta_cobro, cod_estado_renovacio_contrato, deduccion_comision, cod_renovacion_contrato, fecha_elim, usuario_elim) 
			VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
			'$monto_deuda', '$subtotal', '$descuento', '$abonado', '$total_pagar', '$monto_deuda_sin_interes', '$subtotal_sin_interes', '$monto_cuota_sin_interes', 
			'$total_recibido', '$total_pendiente', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$mensaje', '$cod_administrador', '$vendedor', 
			'$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', 
			'$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', 
			'$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', '$numero_deudas_anteriores', '$total_deduccion', 
			'$total_ingreso', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_pago_deuda', '$fecha_pago_reg', 
			'$hora_pago_reg', '$fecha_creacion', '$cod_info_factura_venta', '$cod_estado', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', 
			'$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia', '$cod_tipo_moneda', 
			'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_renovacio_contrato', '$deduccion_comision', '$cod_renovacion_contrato', '$fecha_elim', '$usuario_elim')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

			$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')");
			$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
		}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
}

if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_Eliminar_Renovacion_agrupado_cod_cuentas_cobrar_ajax') {

	$cod_cuentas_cobrar     = intval($_GET['llave']);
	$cod_tercero            = intval($_GET['cod_tercero']);
	$cod_factura            = intval($_GET['cod_factura']);
	$pagina_redirect        = $pagina.'?cod_cuentas_cobrar'.$cod_cuentas_cobrar.'&cod_tercero'.$cod_tercero.'&cod_factura'.$cod_factura.'&pagina'.$pagina;

	$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

	$cod_factura                                  = $datos_venta_producto_temporal['cod_factura']; 
	$cod_clientes                                 = $datos_venta_producto_temporal['cod_clientes']; 
	$cod_tercero                                  = $datos_venta_producto_temporal['cod_tercero']; 
	$cod_producto                                 = $datos_venta_producto_temporal['cod_producto']; 
	$cod_producto_barra                           = $datos_venta_producto_temporal['cod_producto_barra']; 
	$nombre_producto                              = $datos_venta_producto_temporal['nombre_producto']; 
	$monto_deuda                                  = $datos_venta_producto_temporal['monto_deuda']; 
	$monto_deuda_sin_interes                      = $datos_venta_producto_temporal['monto_deuda_sin_interes']; 
	$subtotal                                     = $datos_venta_producto_temporal['subtotal']; 
	$subtotal_sin_interes                         = $datos_venta_producto_temporal['subtotal_sin_interes']; 
	$numero_cuota                                 = $datos_venta_producto_temporal['numero_cuota']; 
	$monto_cuota                                  = $datos_venta_producto_temporal['monto_cuota']; 
	$monto_cuota_sin_interes                      = $datos_venta_producto_temporal['monto_cuota_sin_interes']; 
	$interes_ptj                                  = $datos_venta_producto_temporal['interes_ptj']; 
	$monto_deuda_mas_interes                      = $datos_venta_producto_temporal['monto_deuda_mas_interes']; 
	$monto_cuota_interes                          = $datos_venta_producto_temporal['monto_cuota_interes']; 
	$total_recibido                               = $datos_venta_producto_temporal['total_recibido']; 
	$total_pendiente                              = $datos_venta_producto_temporal['total_pendiente']; 
	$nombre_tipo_cobro                            = $datos_venta_producto_temporal['nombre_tipo_cobro']; 
	$cod_tipo_pago                                = $datos_venta_producto_temporal['cod_tipo_pago']; 
	$cod_tipo_forma_pago                          = $datos_venta_producto_temporal['cod_tipo_forma_pago']; 
	$descuento                                    = $datos_venta_producto_temporal['descuento']; 
	$abonado                                      = $datos_venta_producto_temporal['abonado']; 
	$mensaje                                      = $datos_venta_producto_temporal['mensaje']; 
	$vendedor                                     = $datos_venta_producto_temporal['vendedor']; 
	$cuenta                                       = $datos_venta_producto_temporal['cuenta']; 
	$deduccion_retefuente                         = $datos_venta_producto_temporal['deduccion_retefuente']; 
	$deduccion_reparacion                         = $datos_venta_producto_temporal['deduccion_reparacion']; 
	$deduccion_servicio                           = $datos_venta_producto_temporal['deduccion_servicio']; 
	$deduccion_otro_impuesto_dian                 = $datos_venta_producto_temporal['deduccion_otro_impuesto_dian']; 
	$deduccion_otro_concepto                      = $datos_venta_producto_temporal['deduccion_otro_concepto'];
	$deduccion_servicio_energia                   = $datos_venta_producto_temporal['deduccion_servicio_energia'];
	$deduccion_servicio_agua                      = $datos_venta_producto_temporal['deduccion_servicio_agua'];
	$deduccion_servicio_gas                       = $datos_venta_producto_temporal['deduccion_servicio_gas'];
	$deduccion_deudas_anteriores                  = $datos_venta_producto_temporal['deduccion_deudas_anteriores'];
	$ingreso_administracion_incluida              = $datos_venta_producto_temporal['ingreso_administracion_incluida']; 
	$ingreso_gasto_juridica                       = $datos_venta_producto_temporal['ingreso_gasto_juridica']; 
	$deduccion_saldo_favor                        = $datos_venta_producto_temporal['deduccion_saldo_favor']; 
	$ingreso_otro_concepto                        = $datos_venta_producto_temporal['ingreso_otro_concepto']; 
	$ingreso_deudas_anteriores                    = $datos_venta_producto_temporal['ingreso_deudas_anteriores']; 
	$numero_deudas_anteriores                     = $datos_venta_producto_temporal['numero_deudas_anteriores']; 
	$total_deduccion                              = $datos_venta_producto_temporal['total_deduccion']; 
	$total_ingreso                                = $datos_venta_producto_temporal['total_ingreso']; 
	$fecha_reg                                    = $datos_venta_producto_temporal['fecha_reg']; 
	$fecha_pago                                   = $datos_venta_producto_temporal['fecha_pago']; 
	$fecha                                        = $datos_venta_producto_temporal['fecha']; 
	$fecha_mes                                    = $datos_venta_producto_temporal['fecha_mes']; 
	$anyo                                         = $datos_venta_producto_temporal['anyo']; 
	$fecha_invert                                 = $datos_venta_producto_temporal['fecha_invert']; 
	$fecha_seg                                    = $datos_venta_producto_temporal['fecha_seg']; 
	$fecha_creacion                               = $datos_venta_producto_temporal['fecha_creacion']; 
	$cod_info_factura_venta                       = $datos_venta_producto_temporal['cod_info_factura_venta']; 
	$url_img_orig_producto                        = $datos_venta_producto_temporal['url_img_orig_producto']; 
	$url_img_min_producto                         = $datos_venta_producto_temporal['url_img_min_producto']; 
	$cod_tipo_calificacion                        = $datos_venta_producto_temporal['cod_tipo_calificacion']; 
	$nombre_tipo_calificacion                     = $datos_venta_producto_temporal['nombre_tipo_calificacion']; 
	$cod_administrador                            = $datos_venta_producto_temporal['cod_administrador']; 
	$cod_estado                                   = $datos_venta_producto_temporal['cod_estado']; 
	$nombre1_tercero                              = $datos_venta_producto_temporal['nombre1_tercero']; 
	$nombre2_tercero                              = $datos_venta_producto_temporal['nombre2_tercero']; 
	$apellido1_tercero                            = $datos_venta_producto_temporal['apellido1_tercero']; 
	$apellido2_tercero                            = $datos_venta_producto_temporal['apellido2_tercero']; 
	$identificacion_tercero                       = $datos_venta_producto_temporal['identificacion_tercero']; 
	$fecha_nac_tercero                            = $datos_venta_producto_temporal['fecha_nac_tercero']; 
	$direccion_tercero                            = $datos_venta_producto_temporal['direccion_tercero']; 
	$telefono1_tercero                            = $datos_venta_producto_temporal['telefono1_tercero']; 
	$correo_tercero                               = $datos_venta_producto_temporal['correo_tercero']; 
	$fecha_entrega                                = $datos_venta_producto_temporal['fecha_entrega']; 
	$hora_entrega                                 = $datos_venta_producto_temporal['hora_entrega']; 
	$cod_tipo_moneda                              = $datos_venta_producto_temporal['cod_tipo_moneda']; 
	$clausula_alquiler                            = $datos_venta_producto_temporal['clausula_alquiler']; 
	$cod_estado_contrato                          = $datos_venta_producto_temporal['cod_estado_contrato']; 
	$cod_estado_renovacio_contrato                = $datos_venta_producto_temporal['cod_estado_renovacio_contrato'];
	$cod_renovacion_contrato                      = $datos_venta_producto_temporal['cod_renovacion_contrato'];

	$sql_data = "INSERT INTO tbl15_cuentas_cobrar_copia (cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, monto_deuda, 
	monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, 
	monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, nombre_tipo_cobro, cod_tipo_pago, 
	cod_tipo_forma_pago, descuento, abonado, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, 
	deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, 
	deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, ingreso_administracion_incluida, 
	ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, 
	numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_reg, fecha_pago, fecha, fecha_mes, anyo, 
	fecha_invert, fecha_seg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, 
	cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado, nombre1_tercero, nombre2_tercero, 
	apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, 
	telefono1_tercero, correo_tercero, fecha_entrega, hora_entrega, cod_tipo_moneda, clausula_alquiler, 
	cod_estado_contrato, cod_estado_renovacio_contrato, cod_renovacion_contrato, fecha_elim, usuario_elim) 
	VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', 
	'$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', 
	'$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', '$nombre_tipo_cobro', '$cod_tipo_pago', 
	'$cod_tipo_forma_pago', '$descuento', '$abonado', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', 
	'$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', 
	'$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', 
	'$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', 
	'$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_reg', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', 
	'$fecha_invert', '$fecha_seg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', 
	'$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado', '$nombre1_tercero', '$nombre2_tercero', 
	'$apellido1_tercero', '$apellido2_tercero', '$identificacion_tercero', '$fecha_nac_tercero', '$direccion_tercero', 
	'$telefono1_tercero', '$correo_tercero', '$fecha_entrega', '$hora_entrega', '$cod_tipo_moneda', '$clausula_alquiler', 
	'$cod_estado_contrato', '$cod_estado_renovacio_contrato', '$cod_renovacion_contrato', '$fecha_elim', '$usuario_elim')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta);
	while ($datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta)) { 	

		$cod_cuentas_cobrar_alerta                    = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta']; 
		$cod_cuentas_cobrar_abonos                    = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos']; 
		$numero_alerta                                = $datos_cuentas_cobrar_alerta['numero_alerta']; 
		$cod_factura                                  = $datos_cuentas_cobrar_alerta['cod_factura']; 
		$cod_clientes                                 = $datos_cuentas_cobrar_alerta['cod_clientes']; 
		$cod_tercero                                  = $datos_cuentas_cobrar_alerta['cod_tercero']; 
		$cod_producto                                 = $datos_cuentas_cobrar_alerta['cod_producto']; 
		$cod_producto_barra                           = $datos_cuentas_cobrar_alerta['cod_producto_barra']; 
		$nombre_producto                              = $datos_cuentas_cobrar_alerta['nombre_producto']; 
		$monto_deuda                                  = $datos_cuentas_cobrar_alerta['monto_deuda']; 
		$monto_deuda_sin_interes                      = $datos_cuentas_cobrar_alerta['monto_deuda_sin_interes']; 
		$subtotal                                     = $datos_cuentas_cobrar_alerta['subtotal']; 
		$subtotal_sin_interes                         = $datos_cuentas_cobrar_alerta['subtotal_sin_interes']; 
		$numero_cuota                                 = $datos_cuentas_cobrar_alerta['numero_cuota']; 
		$monto_cuota                                  = $datos_cuentas_cobrar_alerta['monto_cuota']; 
		$monto_cuota_sin_interes                      = $datos_cuentas_cobrar_alerta['monto_cuota_sin_interes']; 
		$interes_ptj                                  = $datos_cuentas_cobrar_alerta['interes_ptj']; 
		$monto_deuda_mas_interes                      = $datos_cuentas_cobrar_alerta['monto_deuda_mas_interes']; 
		$monto_cuota_interes                          = $datos_cuentas_cobrar_alerta['monto_cuota_interes']; 
		$total_recibido                               = $datos_cuentas_cobrar_alerta['total_recibido']; 
		$total_pendiente                              = $datos_cuentas_cobrar_alerta['total_pendiente']; 
		$nombre_tipo_cobro                            = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro']; 
		$descuento                                    = $datos_cuentas_cobrar_alerta['descuento']; 
		$abonado                                      = $datos_cuentas_cobrar_alerta['abonado']; 
		$total_pagar                                  = $datos_cuentas_cobrar_alerta['total_pagar']; 
		$mensaje                                      = $datos_cuentas_cobrar_alerta['mensaje']; 
		$vendedor                                     = $datos_cuentas_cobrar_alerta['vendedor']; 
		$cuenta                                       = $datos_cuentas_cobrar_alerta['cuenta']; 
		$deduccion_retefuente                         = $datos_cuentas_cobrar_alerta['deduccion_retefuente']; 
		$deduccion_reparacion                         = $datos_cuentas_cobrar_alerta['deduccion_reparacion']; 
		$deduccion_servicio                           = $datos_cuentas_cobrar_alerta['deduccion_servicio']; 
		$deduccion_otro_impuesto_dian                 = $datos_cuentas_cobrar_alerta['deduccion_otro_impuesto_dian']; 
		$deduccion_otro_concepto                      = $datos_cuentas_cobrar_alerta['deduccion_otro_concepto']; 
		$deduccion_servicio_energia                   = $datos_cuentas_cobrar_alerta['deduccion_servicio_energia']; 
		$deduccion_servicio_agua                      = $datos_cuentas_cobrar_alerta['deduccion_servicio_agua']; 
		$deduccion_servicio_gas                       = $datos_cuentas_cobrar_alerta['deduccion_servicio_gas']; 
		$deduccion_deudas_anteriores                  = $datos_cuentas_cobrar_alerta['deduccion_deudas_anteriores']; 
		$ingreso_administracion_incluida              = $datos_cuentas_cobrar_alerta['ingreso_administracion_incluida']; 
		$ingreso_gasto_juridica                       = $datos_cuentas_cobrar_alerta['ingreso_gasto_juridica']; 
		$deduccion_saldo_favor                        = $datos_cuentas_cobrar_alerta['deduccion_saldo_favor']; 
		$ingreso_otro_concepto                        = $datos_cuentas_cobrar_alerta['ingreso_otro_concepto']; 
		$ingreso_deudas_anteriores                    = $datos_cuentas_cobrar_alerta['ingreso_deudas_anteriores']; 
		$numero_deudas_anteriores                     = $datos_cuentas_cobrar_alerta['numero_deudas_anteriores']; 
		$total_deduccion                              = $datos_cuentas_cobrar_alerta['total_deduccion']; 
		$total_ingreso                                = $datos_cuentas_cobrar_alerta['total_ingreso']; 
		$fecha_pago                                   = $datos_cuentas_cobrar_alerta['fecha_pago']; 
		$fecha                                        = $datos_cuentas_cobrar_alerta['fecha']; 
		$fecha_mes                                    = $datos_cuentas_cobrar_alerta['fecha_mes']; 
		$anyo                                         = $datos_cuentas_cobrar_alerta['anyo']; 
		$fecha_invert                                 = $datos_cuentas_cobrar_alerta['fecha_invert']; 
		$fecha_seg                                    = $datos_cuentas_cobrar_alerta['fecha_seg']; 
		$fecha_pago_reg                               = $datos_cuentas_cobrar_alerta['fecha_pago_reg']; 
		$hora_pago_reg                                = $datos_cuentas_cobrar_alerta['hora_pago_reg']; 
		$fecha_creacion                               = $datos_cuentas_cobrar_alerta['fecha_creacion']; 
		$cod_info_factura_venta                       = $datos_cuentas_cobrar_alerta['cod_info_factura_venta']; 
		$url_img_orig_producto                        = $datos_cuentas_cobrar_alerta['url_img_orig_producto']; 
		$url_img_min_producto                         = $datos_cuentas_cobrar_alerta['url_img_min_producto']; 
		$cod_tipo_calificacion                        = $datos_cuentas_cobrar_alerta['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion                     = $datos_cuentas_cobrar_alerta['nombre_tipo_calificacion']; 
		$cod_administrador                            = $datos_cuentas_cobrar_alerta['cod_administrador']; 
		$cod_estado                                   = $datos_cuentas_cobrar_alerta['cod_estado']; 
		$cod_estado_contrato                          = $datos_cuentas_cobrar_alerta['cod_estado_contrato']; 
		$cod_tipo_forma_pago                          = $datos_cuentas_cobrar_alerta['cod_tipo_forma_pago']; 
		$cod_tipo_moneda                              = $datos_cuentas_cobrar_alerta['cod_tipo_moneda']; 
		$cod_estado_envio_correo_cuenta_cobro         = $datos_cuentas_cobrar_alerta['cod_estado_envio_correo_cuenta_cobro']; 
		$cod_estado_renovacio_contrato                = $datos_cuentas_cobrar_alerta['cod_estado_renovacio_contrato']; 
		$deduccion_comision                           = $datos_cuentas_cobrar_alerta['deduccion_comision']; 
		$cod_renovacion_contrato                      = $datos_cuentas_cobrar_alerta['cod_renovacion_contrato']; 

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_alerta_copia (cod_cuentas_cobrar_alerta, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, numero_alerta, cod_factura, cod_clientes, cod_tercero, 
		cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, 
		monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, 
		nombre_tipo_cobro, descuento, abonado, total_pagar, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, 
		deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, 
		deduccion_deudas_anteriores, ingreso_administracion_incluida, ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, 
		ingreso_deudas_anteriores, numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, 
		fecha_seg, fecha_pago_reg, hora_pago_reg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, 
		cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_tipo_moneda, 
		cod_estado_envio_correo_cuenta_cobro, cod_estado_renovacio_contrato, deduccion_comision, cod_renovacion_contrato, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_abonos', '$numero_alerta', '$cod_factura', '$cod_clientes', '$cod_tercero', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', 
		'$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', 
		'$nombre_tipo_cobro', '$descuento', '$abonado', '$total_pagar', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', 
		'$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', 
		'$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', 
		'$ingreso_deudas_anteriores', '$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', 
		'$fecha_seg', '$fecha_pago_reg', '$hora_pago_reg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', 
		'$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_tipo_moneda', 
		'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_renovacio_contrato', '$deduccion_comision', '$cod_renovacion_contrato', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos);
	$existe_cuentas_cobrar_abonos = mysqli_num_rows($consulta_cuentas_cobrar_abonos);
	while ($datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos)) { 	

		$cod_cuentas_cobrar_abonos                    = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos']; 
		$cod_factura                                  = $datos_cuentas_cobrar_abonos['cod_factura']; 
		$cod_clientes                                 = $datos_cuentas_cobrar_abonos['cod_clientes']; 
		$cod_tercero                                  = $datos_cuentas_cobrar_abonos['cod_tercero']; 
		$cod_producto                                 = $datos_cuentas_cobrar_abonos['cod_producto']; 
		$cod_producto_barra                           = $datos_cuentas_cobrar_abonos['cod_producto_barra']; 
		$nombre_producto                              = $datos_cuentas_cobrar_abonos['nombre_producto']; 
		$monto_deuda                                  = $datos_cuentas_cobrar_abonos['monto_deuda']; 
		$subtotal                                     = $datos_cuentas_cobrar_abonos['subtotal']; 
		$descuento                                    = $datos_cuentas_cobrar_abonos['descuento']; 
		$abonado                                      = $datos_cuentas_cobrar_abonos['abonado']; 
		$total_pagar                                  = $datos_cuentas_cobrar_abonos['total_pagar']; 
		$monto_deuda_sin_interes                      = $datos_cuentas_cobrar_abonos['monto_deuda_sin_interes']; 
		$subtotal_sin_interes                         = $datos_cuentas_cobrar_abonos['subtotal_sin_interes']; 
		$monto_cuota_sin_interes                      = $datos_cuentas_cobrar_abonos['monto_cuota_sin_interes']; 
		$total_recibido                               = $datos_cuentas_cobrar_abonos['total_recibido']; 
		$total_pendiente                              = $datos_cuentas_cobrar_abonos['total_pendiente']; 
		$interes_ptj                                  = $datos_cuentas_cobrar_abonos['interes_ptj']; 
		$monto_deuda_mas_interes                      = $datos_cuentas_cobrar_abonos['monto_deuda_mas_interes']; 
		$monto_cuota_interes                          = $datos_cuentas_cobrar_abonos['monto_cuota_interes']; 
		$mensaje                                      = $datos_cuentas_cobrar_abonos['mensaje']; 
		$cod_administrador                            = $datos_cuentas_cobrar_abonos['cod_administrador']; 
		$vendedor                                     = $datos_cuentas_cobrar_abonos['vendedor']; 
		$cuenta                                       = $datos_cuentas_cobrar_abonos['cuenta']; 
		$deduccion_retefuente                         = $datos_cuentas_cobrar_abonos['deduccion_retefuente']; 
		$deduccion_reparacion                         = $datos_cuentas_cobrar_abonos['deduccion_reparacion']; 
		$deduccion_servicio                           = $datos_cuentas_cobrar_abonos['deduccion_servicio']; 
		$deduccion_otro_impuesto_dian                 = $datos_cuentas_cobrar_abonos['deduccion_otro_impuesto_dian']; 
		$deduccion_otro_concepto                      = $datos_cuentas_cobrar_abonos['deduccion_otro_concepto']; 
		$deduccion_servicio_energia                   = $datos_cuentas_cobrar_abonos['deduccion_servicio_energia']; 
		$deduccion_servicio_agua                      = $datos_cuentas_cobrar_abonos['deduccion_servicio_agua']; 
		$deduccion_servicio_gas                       = $datos_cuentas_cobrar_abonos['deduccion_servicio_gas']; 
		$deduccion_deudas_anteriores                  = $datos_cuentas_cobrar_abonos['deduccion_deudas_anteriores']; 
		$ingreso_administracion_incluida              = $datos_cuentas_cobrar_abonos['ingreso_administracion_incluida']; 
		$ingreso_gasto_juridica                       = $datos_cuentas_cobrar_abonos['ingreso_gasto_juridica']; 
		$deduccion_saldo_favor                        = $datos_cuentas_cobrar_abonos['deduccion_saldo_favor']; 
		$ingreso_otro_concepto                        = $datos_cuentas_cobrar_abonos['ingreso_otro_concepto']; 
		$ingreso_deudas_anteriores                    = $datos_cuentas_cobrar_abonos['ingreso_deudas_anteriores']; 
		$numero_deudas_anteriores                     = $datos_cuentas_cobrar_abonos['numero_deudas_anteriores']; 
		$total_deduccion                              = $datos_cuentas_cobrar_abonos['total_deduccion']; 
		$total_ingreso                                = $datos_cuentas_cobrar_abonos['total_ingreso']; 
		$cod_abono_global                             = $datos_cuentas_cobrar_abonos['cod_abono_global']; 
		$fecha_pago                                   = $datos_cuentas_cobrar_abonos['fecha_pago']; 
		$fecha_anyo                                   = $datos_cuentas_cobrar_abonos['fecha_anyo']; 
		$fecha_mes                                    = $datos_cuentas_cobrar_abonos['fecha_mes']; 
		$anyo                                         = $datos_cuentas_cobrar_abonos['anyo']; 
		$fecha_invert                                 = $datos_cuentas_cobrar_abonos['fecha_invert']; 
		$fecha_seg                                    = $datos_cuentas_cobrar_abonos['fecha_seg']; 
		$hora                                         = $datos_cuentas_cobrar_abonos['hora']; 
		$fecha_pago_deuda                             = $datos_cuentas_cobrar_abonos['fecha_pago_deuda']; 
		$fecha_pago_reg                               = $datos_cuentas_cobrar_abonos['fecha_pago_reg']; 
		$hora_pago_reg                                = $datos_cuentas_cobrar_abonos['hora_pago_reg']; 
		$fecha_creacion                               = $datos_cuentas_cobrar_abonos['fecha_creacion']; 
		$cod_info_factura_venta                       = $datos_cuentas_cobrar_abonos['cod_info_factura_venta']; 
		$cod_estado                                   = $datos_cuentas_cobrar_abonos['cod_estado']; 
		$cod_estado_contrato                          = $datos_cuentas_cobrar_abonos['cod_estado_contrato']; 
		$cod_tipo_forma_pago                          = $datos_cuentas_cobrar_abonos['cod_tipo_forma_pago']; 
		$cod_cuentas_cobrar_alerta                    = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta']; 
		$numero_alerta                                = $datos_cuentas_cobrar_abonos['numero_alerta']; 
		$url_img_orig_producto                        = $datos_cuentas_cobrar_abonos['url_img_orig_producto']; 
		$url_img_min_producto                         = $datos_cuentas_cobrar_abonos['url_img_min_producto']; 
		$cod_tipo_calificacion                        = $datos_cuentas_cobrar_abonos['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion                     = $datos_cuentas_cobrar_abonos['nombre_tipo_calificacion']; 
		$cod_dependencia                              = $datos_cuentas_cobrar_abonos['cod_dependencia']; 
		$cod_tipo_moneda                              = $datos_cuentas_cobrar_abonos['cod_tipo_moneda']; 
		$cod_estado_envio_correo_cuenta_cobro         = $datos_cuentas_cobrar_abonos['cod_estado_envio_correo_cuenta_cobro']; 
		$cod_estado_renovacio_contrato                = $datos_cuentas_cobrar_abonos['cod_estado_renovacio_contrato']; 
		$deduccion_comision                           = $datos_cuentas_cobrar_abonos['deduccion_comision']; 
		$cod_renovacion_contrato                      = $datos_cuentas_cobrar_abonos['cod_renovacion_contrato']; 

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, 
		monto_deuda, subtotal, descuento, abonado, total_pagar, monto_deuda_sin_interes, subtotal_sin_interes, monto_cuota_sin_interes, 
		total_recibido, total_pendiente, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, mensaje, cod_administrador, vendedor, 
		cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, 
		deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, ingreso_administracion_incluida, 
		ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, numero_deudas_anteriores, total_deduccion, 
		total_ingreso, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_pago_deuda, fecha_pago_reg, 
		hora_pago_reg, fecha_creacion, cod_info_factura_venta, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, 
		numero_alerta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia, cod_tipo_moneda, 
		cod_estado_envio_correo_cuenta_cobro, cod_estado_renovacio_contrato, deduccion_comision, cod_renovacion_contrato, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
		'$monto_deuda', '$subtotal', '$descuento', '$abonado', '$total_pagar', '$monto_deuda_sin_interes', '$subtotal_sin_interes', '$monto_cuota_sin_interes', 
		'$total_recibido', '$total_pendiente', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$mensaje', '$cod_administrador', '$vendedor', 
		'$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', 
		'$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', 
		'$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', '$numero_deudas_anteriores', '$total_deduccion', 
		'$total_ingreso', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_pago_deuda', '$fecha_pago_reg', 
		'$hora_pago_reg', '$fecha_creacion', '$cod_info_factura_venta', '$cod_estado', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', 
		'$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia', '$cod_tipo_moneda', 
		'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_renovacio_contrato', '$deduccion_comision', '$cod_renovacion_contrato', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
?>
<!--<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">-->
<?php } ?>