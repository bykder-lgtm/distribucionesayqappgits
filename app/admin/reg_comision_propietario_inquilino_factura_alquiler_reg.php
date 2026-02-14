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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                           = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                         = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                       = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                  = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                   = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                      = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                    = ($_SESSION['cod_cliente_sesion']);
//$cod_administrador                     = ($_SESSION['cod_administrador']);
$cod_base_caja                         = ($_SESSION['cod_base_caja']);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_cuentas_cobrar                    = intval($_POST['cod_cuentas_cobrar']);
	$cod_factura                           = intval($_POST['cod_factura']);
	$cod_tercero                           = intval($_POST['cod_tercero']);
	$mensaje                               = addslashes($_POST['mensaje']);
	$fecha_pago                            = addslashes($_POST['fecha_pago']);
	$cod_tipo_forma_pago                   = intval($_POST['cod_tipo_forma_pago']);
	$numero_alerta                         = intval($_POST['numero_alerta']);
	$cod_cuentas_cobrar_alerta             = intval($_POST['cod_cuentas_cobrar_alerta']);
	$cod_administrador                     = intval($_POST['cod_administrador']);
	$monto_cuota_interes                   = addslashes($_POST['monto_cuota_interes_hidden']);
	$monto_cuota_interes                   = addslashes($_POST['monto_cuota_interes']);
	$total_pagar                           = addslashes($_POST['total_pagar_hidden']);
	//$total_pagar                           = addslashes($_POST['subtotal_abonado']);
	$monto_deuda_alerta                    = addslashes($_POST['monto_deuda_alerta']);
	$palabra                               = addslashes($_POST['palabra']);
	$monto_deuda                           = $monto_deuda_alerta;
	$monto_cuota_interes                   = $monto_deuda_alerta;


	$deduccion_retefuente                  = addslashes($_POST['deduccion_retefuente_hidden']);
	$deduccion_reparacion                  = addslashes($_POST['deduccion_reparacion_hidden']);

	$deduccion_otro_impuesto_dian          = addslashes($_POST['deduccion_otro_impuesto_dian_hidden']);
	$ingreso_administracion_incluida       = addslashes($_POST['ingreso_administracion_incluida_hidden']);
	$ingreso_deudas_anteriores             = addslashes($_POST['ingreso_deudas_anteriores_hidden']);

	$ingreso_gasto_juridica                = addslashes($_POST['ingreso_gasto_juridica_hidden']);
	$deduccion_saldo_favor                 = addslashes($_POST['deduccion_saldo_favor_hidden']);
	$total_deduccion                       = addslashes($_POST['total_deduccion_hidden']);
	$total_ingreso                         = addslashes($_POST['total_ingreso_hidden']);
	$total_recibido                        = addslashes($_POST['total_recibido_hidden']);
	$total_pendiente                       = addslashes($_POST['total_pendiente_hidden']);
	$abonado                               = $total_recibido;

	$deduccion_servicio                    = addslashes($_POST['deduccion_servicio_hidden']);
	$deduccion_otro_concepto               = addslashes($_POST['deduccion_otro_concepto_hidden']);
	$ingreso_otro_concepto                 = addslashes($_POST['ingreso_otro_concepto_hidden']);

	$deduccion_servicio_energia            = addslashes($_POST['deduccion_servicio_energia_hidden']);
	$deduccion_servicio_agua               = addslashes($_POST['deduccion_servicio_agua_hidden']);
	$deduccion_servicio_gas                = addslashes($_POST['deduccion_servicio_gas_hidden']);
	$deduccion_deudas_anteriores           = addslashes($_POST['deduccion_deudas_anteriores_hidden']);
	$deduccion_comision                    = addslashes($_POST['deduccion_comision_hidden']);
	$deduccion_imp_cuatroxmil              = addslashes($_POST['deduccion_imp_cuatroxmil_hidden']);

	$ingreso_impuesto_iva                  = addslashes($_POST['ingreso_impuesto_iva_hidden']);
	$deduccion_comision_ptj                = addslashes($_POST['deduccion_comision_ptj']);

	$pagina                                = addslashes($_POST['pagina']);
	$pagina_redirect                       = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina;

	$fecha_pago_reg                        = $fecha_pago;
	$hora_pago_reg                         = date("H:i:s");

	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	$cliente                       = "";
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_factura_comision_propietario'";
	$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);
	$cod_cuentas_cobrar_factura_comision_propietario = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
	$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
	$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

	$monto_cuota_alerta              = $datos_cuentas_cobrar_alerta['monto_cuota'];
	$fecha_pago_alerta               = $datos_cuentas_cobrar_alerta['fecha_pago'];
	$fecha_pago_alerta_seg           = strtotime($fecha_pago_alerta);
	$fecha_pago_seg                  = strtotime($fecha_pago);
	$fecha_pago_deuda                = $fecha_pago_alerta;
	$cod_producto                    = $datos_cuentas_cobrar_alerta['cod_producto'];
	$cod_producto_barra              = $datos_cuentas_cobrar_alerta['cod_producto_barra'];
	$nombre_producto                 = $datos_cuentas_cobrar_alerta['nombre_producto'];
	$cod_cuentas_cobrar_abonos       = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos'];
	$cod_producto                    = $datos_cuentas_cobrar_alerta['cod_producto'];
	$cod_producto_barra              = $datos_cuentas_cobrar_alerta['cod_producto_barra'];
	$nombre_producto                 = $datos_cuentas_cobrar_alerta['nombre_producto'];
	$cod_tercero_propietario         = $datos_cuentas_cobrar_alerta['cod_tercero_propietario'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_hora                      = date("H:i:s");
	$fecha_ymd                       = date("Y-m-d");

	$fecha_ymd_venta_producto 	    = date("Y-m-d");
	$fecha_mes_venta_producto 	    = date("Y-m");
	$fecha_anyo_venta_producto 	    = date("Y");
	$fecha_hora_venta_producto 	    = date("H:I:s");
	$fecha_seg_venta_producto       = time();

	$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
	$ruta_firma_orig                 = '../archivador/firma/original/';
	$ruta_foto_orig                  = '../archivador/documentos/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'_'.$cod_cuentas_cobrar_factura_comision_propietario.'.'.$formato_img2;
		$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                    = "";
		$formato_img2                    = "";
		$nombre_normal2                  = "";
		$url_img_orig_producto           = "";
		$url_img_min_producto            = "";
	}
	//-------------------------------------- -----------------------------------------------------------------//
	$fecha_anyo                      = date("Y-m-d", strtotime($fecha_pago));
	$fecha_mes                       = date("Y-m", strtotime($fecha_pago));
	$anyo                            = date("Y", strtotime($fecha_pago));
	$fecha_invert                    = date("Y-m-d", strtotime($fecha_pago));
	$fecha_seg                       = strtotime($fecha_pago);
	$hora                            = date("H:i:s");
	$cod_estado_pago_propietario     = '1';
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_factura_comision_propietario (cod_cuentas_cobrar, cod_cuentas_cobrar_alerta, cod_cuentas_cobrar_abonos, cod_tercero, cod_factura, 
	abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, 
	numero_alerta, url_img_orig_producto, url_img_min_producto, monto_cuota_interes, monto_deuda,
	deduccion_retefuente, deduccion_reparacion, deduccion_otro_impuesto_dian, ingreso_administracion_incluida, fecha_pago_deuda, fecha_pago_reg, hora_pago_reg, total_pagar, 
	cod_producto, cod_producto_barra, nombre_producto, ingreso_gasto_juridica, deduccion_saldo_favor, total_deduccion, total_ingreso, total_recibido, total_pendiente, ingreso_deudas_anteriores, 
	deduccion_servicio, deduccion_otro_concepto, ingreso_otro_concepto, deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, 
	deduccion_comision, deduccion_imp_cuatroxmil, cod_estado_pago_propietario, ingreso_impuesto_iva, deduccion_comision_ptj, cod_tercero_propietario) 
	VALUES ('$cod_cuentas_cobrar', '$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar_abonos', '$cod_tercero', '$cod_factura', 
	'$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', 
	'$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$monto_cuota_interes', '$monto_deuda', 
	'$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_otro_impuesto_dian', '$ingreso_administracion_incluida', '$fecha_pago_deuda', '$fecha_pago_reg', '$hora_pago_reg', '$total_pagar', 
	'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$total_deduccion', '$total_ingreso', '$total_recibido', '$total_pendiente', '$ingreso_deudas_anteriores', 
	'$deduccion_servicio', '$deduccion_otro_concepto', '$ingreso_otro_concepto', '$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', 
	'$deduccion_comision', '$deduccion_imp_cuatroxmil', '$cod_estado_pago_propietario', '$ingreso_impuesto_iva', '$deduccion_comision_ptj', '$cod_tercero_propietario')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario', cod_estado_pago_propietario = '$cod_estado_pago_propietario' 
	WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
	if (empty($_POST['cod_gasto_inmueble_inquilino_venta_temporal'])) {
	} else {
		foreach ($_POST['cod_gasto_inmueble_inquilino_venta_temporal'] as $clave=>$cod_gasto_inmueble_inquilino_venta_temporal) {

			$obtener_cie10diag = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')";
			$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
			$info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag);

			$nombre_gasto_inmueble_detalle         = $info_cie10diag['nombre_gasto_inmueble_detalle'];
			$descripcion_gasto_inmueble_detalle    = $info_cie10diag['descripcion_gasto_inmueble_detalle'];
			$precio_venta_producto                 = $info_cie10diag['precio_venta_producto'];
			$precio_compra_producto                = $info_cie10diag['precio_compra_producto'];
			$cod_gasto_inmueble                    = $info_cie10diag['cod_gasto_inmueble'];
			$cod_cuentas_cobrar                    = $info_cie10diag['cod_cuentas_cobrar'];
			$cod_factura                           = $info_cie10diag['cod_factura'];
			$cod_producto                          = $info_cie10diag['cod_producto'];
			$cod_producto_barra                    = $info_cie10diag['cod_producto_barra'];
			$nombre_producto                       = $info_cie10diag['nombre_producto'];
			$url_img_orig_producto                 = $info_cie10diag['url_img_orig_producto'];
			$url_img_min_producto                  = $info_cie10diag['url_img_min_producto'];
			$fecha_gasto_inmueble_detalle          = $info_cie10diag['fecha_gasto_inmueble_detalle'];
			$fecha                                 = $info_cie10diag['fecha'];
			$fecha_mes                             = $info_cie10diag['fecha_mes'];
			$anyo                                  = $info_cie10diag['anyo'];
			$fecha_invert                          = $info_cie10diag['fecha_invert'];
			$fecha_seg                             = $info_cie10diag['fecha_seg'];
			$fecha_creacion                        = $info_cie10diag['fecha_creacion'];
			$cod_tipo_estado_incluido              = $info_cie10diag['cod_tipo_estado_incluido'];
			$cod_info_gasto_inmueble_inquilino_venta = $info_cie10diag['cod_info_gasto_inmueble_inquilino_venta'];

			if ($cod_tipo_estado_incluido == '0') {
				$sql_insert = "INSERT INTO tbl15_gasto_inmueble_inquilino_venta (nombre_gasto_inmueble_detalle, descripcion_gasto_inmueble_detalle, precio_venta_producto, precio_compra_producto, cod_gasto_inmueble, 
				cod_cuentas_cobrar, cod_cuentas_cobrar_alerta, cod_cuentas_cobrar_abonos, cod_cuentas_cobrar_factura_comision_propietario, 
				cod_factura, cod_tercero, cod_tercero_propietario, cod_producto, cod_producto_barra, nombre_producto, 
				url_img_orig_producto, url_img_min_producto, fecha_gasto_inmueble_detalle, fecha, fecha_mes, anyo, 
				fecha_invert, fecha_seg, fecha_creacion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_hora_venta_producto, fecha_seg_venta_producto, 
				cod_info_gasto_inmueble_inquilino_venta) 
				VALUES ('$nombre_gasto_inmueble_detalle', '$descripcion_gasto_inmueble_detalle', '$precio_venta_producto', '$precio_compra_producto', '$cod_gasto_inmueble', 
				'$cod_cuentas_cobrar', '$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar_factura_comision_propietario', 
				'$cod_factura', '$cod_tercero', '$cod_tercero_propietario', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
				'$url_img_orig_producto', '$url_img_min_producto', '$fecha_gasto_inmueble_detalle', '$fecha', '$fecha_mes', '$anyo', 
				'$fecha_invert', '$fecha_seg', '$fecha_creacion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_hora_venta_producto', '$fecha_seg_venta_producto', 
				'$cod_info_gasto_inmueble_inquilino_venta')";
				$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_insert) or die(mysqli_error($conectar));

				$borrar_sql = sprintf("DELETE FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')");
				$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
			}
		}
		$data_sql = ("UPDATE tbl15_info_gasto_inmueble_inquilino_venta SET nombre_estado_factura2 = 'CERRADA' WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

		$sql_verificar_existencia = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'";
		$consulta_verificar_existencia = mysqli_query($conectar, $sql_verificar_existencia) or die(mysqli_error($conectar));
		$existe_verificar_existencia = mysqli_num_rows($consulta_verificar_existencia);

		if ($existe_verificar_existencia == '0') {
			$data_sql = ("UPDATE tbl15_info_gasto_inmueble_inquilino_venta SET nombre_estado_factura = 'CERRADA' WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
		}
		$data_sql = ("UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET cod_tipo_estado_incluido = '0' WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	}
//-------------------------------------- -----------------------------------------------------------------//
if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/comision_propietario_opcion_alquiler_imprimir.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario ?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta ?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&pagina=<?php echo $pagina_redirect ?>&palabra=<?php echo $palabra ?>">
<?php 
} 
?>