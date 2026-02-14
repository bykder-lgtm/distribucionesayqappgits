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

if (isset($_GET['cod_estado_hoy'])) { $cod_estado_hoy = addslashes($_POST['cod_estado_hoy']); } else { $cod_estado_hoy = '1'; }
if (isset($_GET['cod_estado_pago'])) { $cod_estado_pago = addslashes($_POST['cod_estado_pago']); } else { $cod_estado_pago = '0'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_POST['buscar_por']); } else { $buscar_por = 'documento_nombre_inquilino'; }

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
	$total_pagar                           = addslashes($_POST['total_pagar_hidden']);

	$monto_deuda_alerta                    = addslashes($_POST['monto_deuda_alerta_hidden']);
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

	$sql_total_facturas = "SELECT deduccion_saldo_favor FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
	$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

	if ($deduccion_saldo_favor == 0) { $deduccion_saldo_favor = $datos_total_facturas['deduccion_saldo_favor']; } else { $deduccion_saldo_favor = $deduccion_saldo_favor; }

	$deduccion_servicio                    = addslashes($_POST['deduccion_servicio_hidden']);
	$deduccion_otro_concepto               = addslashes($_POST['deduccion_otro_concepto_hidden']);
	$ingreso_otro_concepto                 = addslashes($_POST['ingreso_otro_concepto_hidden']);

	$deduccion_servicio_energia            = addslashes($_POST['deduccion_servicio_energia_hidden']);
	$deduccion_servicio_agua               = addslashes($_POST['deduccion_servicio_agua_hidden']);
	$deduccion_servicio_gas                = addslashes($_POST['deduccion_servicio_gas_hidden']);
	$deduccion_deudas_anteriores           = addslashes($_POST['deduccion_deudas_anteriores_hidden']);

	$monto_deuda                           = $monto_deuda_alerta;
	$monto_deuda_sin_interes               = $monto_deuda_alerta;
	$subtotal_sin_interes                  = $monto_deuda_alerta;
	$monto_cuota                           = $monto_deuda_alerta;
	$monto_cuota_sin_interes               = $monto_deuda_alerta;

	$pagina                                = addslashes($_POST['pagina']);
	$pagina_redirect                       = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina.'&cod_estado_hoy='.$cod_estado_hoy.'&cod_estado_pago='.$cod_estado_pago.'&buscar_por='.$buscar_por;

	$fecha_pago_reg                        = $fecha_pago;
	$hora_pago_reg                         = date("H:i:s");

	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	$cliente                       = "";
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
	$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);
	$cod_cuentas_cobrar_abonos = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_hora                      = date("H:i:s");
	$fecha_ymd                       = date("Y-m-d");

	$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
	$ruta_firma_orig                 = '../archivador/firma/original/';
	$ruta_foto_orig                  = '../archivador/documentos/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
	$formato_img2                    = explode(".", $url_img1);
	$formato_img2                    = end($formato_img2);
	$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'_'.$cod_cuentas_cobrar_abonos.'.'.$formato_img2;
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
	$cod_estado_renovacio_contrato   = 1;
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
	$cod_renovacion_contrato         = $datos_cuentas_cobrar_alerta['cod_renovacion_contrato'];
	$cod_tercero_propietario         = $datos_cuentas_cobrar_alerta['cod_tercero_propietario'];
	$fecha_pago_periodo_orig         = $datos_cuentas_cobrar_alerta['fecha_pago_periodo_orig'];

	if (($fecha_pago_seg > $fecha_pago_alerta_seg) || ($total_recibido < $total_pagar)) { $cod_tipo_calificacion = "2"; $nombre_tipo_calificacion = "MALA"; } else { $cod_tipo_calificacion = "1"; $nombre_tipo_calificacion = "BUENA"; }
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_cuentas_cobrar, cod_tercero, cod_factura, abonado, cuenta, fecha_pago, 
	fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, 
	cod_cuentas_cobrar_alerta, numero_alerta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, monto_cuota_interes, 
	deduccion_retefuente, deduccion_reparacion, deduccion_otro_impuesto_dian, ingreso_administracion_incluida, fecha_pago_deuda, fecha_pago_reg, hora_pago_reg, total_pagar, 
	cod_producto, cod_producto_barra, nombre_producto, ingreso_gasto_juridica, deduccion_saldo_favor, total_deduccion, total_ingreso, total_recibido, total_pendiente, ingreso_deudas_anteriores, 
	deduccion_servicio, deduccion_otro_concepto, ingreso_otro_concepto, deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, 
	monto_deuda_sin_interes, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, cod_renovacion_contrato, cod_tercero_propietario, fecha_pago_periodo_orig) 
	VALUES ('$cod_cuentas_cobrar', '$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago', 
	'$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', 
	'$cod_cuentas_cobrar_alerta', '$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$monto_cuota_interes', 
	'$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_otro_impuesto_dian', '$ingreso_administracion_incluida', '$fecha_pago_deuda', '$fecha_pago_reg', '$hora_pago_reg', '$total_pagar', 
	'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$total_deduccion', '$total_ingreso', '$total_recibido', '$total_pendiente', '$ingreso_deudas_anteriores', 
	'$deduccion_servicio', '$deduccion_otro_concepto', '$ingreso_otro_concepto', '$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', 
	'$monto_deuda_sin_interes', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', '$cod_renovacion_contrato', '$cod_tercero_propietario', '$fecha_pago_periodo_orig')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
	$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

	$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
	$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
	$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

	$monto_deuda_db                  = $dato_cuenta_cobrar_factura['monto_deuda'];
	$abonado_total                   = $total_abono_factura['abonado'];
	$subtotal_db                     = $monto_deuda_db - $abonado_total;
	$url_img_min_producto            = 'reg_cuentas_cobrar_agrupado_detalle_factura_alquiler_reg.php';

	if ($subtotal_db <= '0' ) { $cod_estado_contrato = 1; } else { $cod_estado_contrato = 0; } 
	//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal_db', cod_tipo_calificacion = '$cod_tipo_calificacion', 
	nombre_tipo_calificacion = '$nombre_tipo_calificacion', cod_estado_contrato = '$cod_estado_contrato', deduccion_saldo_favor = '$deduccion_saldo_favor' 
	WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos', cod_estado = '1', 
	cod_tipo_calificacion = '$cod_tipo_calificacion', nombre_tipo_calificacion = '$nombre_tipo_calificacion', fecha_pago_reg = '$fecha_pago_reg', 
	hora_pago_reg = '$hora_pago_reg', monto_cuota_interes = '$monto_cuota_interes', deduccion_retefuente = '$deduccion_retefuente', 
	deduccion_reparacion = '$deduccion_reparacion', deduccion_servicio = '$deduccion_servicio', deduccion_otro_impuesto_dian = '$deduccion_otro_impuesto_dian', 
	ingreso_administracion_incluida = '$ingreso_administracion_incluida', abonado = '$abonado', total_pagar = '$total_pagar', 
	ingreso_gasto_juridica = '$ingreso_gasto_juridica', deduccion_saldo_favor = '$deduccion_saldo_favor', total_deduccion = '$total_deduccion', 
	total_ingreso = '$total_ingreso', total_recibido = '$total_recibido', total_pendiente = '$total_pendiente', ingreso_deudas_anteriores = '$ingreso_deudas_anteriores', 
	deduccion_servicio = '$deduccion_servicio', deduccion_otro_concepto = '$deduccion_otro_concepto', ingreso_otro_concepto = '$ingreso_otro_concepto', 
	deduccion_servicio_energia = '$deduccion_servicio_energia', deduccion_servicio_agua = '$deduccion_servicio_agua', deduccion_servicio_gas = '$deduccion_servicio_gas', 
	deduccion_deudas_anteriores = '$deduccion_deudas_anteriores', mensaje = '$mensaje', cod_estado_renovacio_contrato = '$cod_estado_renovacio_contrato', 
	url_img_min_producto = '$url_img_min_producto', cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//$resultado_abono = $total_pagar - $abonado;
	//$resultado_abono = $total_pendiente;
	if ($total_pendiente > '0') {

		$sql_autoincremento_cuentas_cobrar_alerta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_alerta'";
		$exec_autoincremento_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
		$datos_autoincremento_cuentas_cobrar_alerta = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_alerta);
		$cod_cuentas_cobrar_alerta_cbk = $datos_autoincremento_cuentas_cobrar_alerta['AUTO_INCREMENT'];

		$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
		$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
		$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

		$cod_cuentas_cobrar              = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar'];
		$cod_cuentas_cobrar_abonos       = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos'];
		$numero_alerta                   = $datos_cuentas_cobrar_alerta['numero_alerta'];
		$cod_factura                     = $datos_cuentas_cobrar_alerta['cod_factura'];
		$cod_tercero                     = $datos_cuentas_cobrar_alerta['cod_tercero'];
		$cod_producto                    = $datos_cuentas_cobrar_alerta['cod_producto'];
		$cod_producto_barra              = $datos_cuentas_cobrar_alerta['cod_producto_barra'];
		$nombre_producto                 = $datos_cuentas_cobrar_alerta['nombre_producto'];
		$monto_deuda                     = $total_pendiente;
		$monto_deuda_sin_interes         = $total_pendiente;
		$subtotal                        = $total_pendiente;
		$subtotal_sin_interes            = $total_pendiente;
		$numero_cuota                    = $datos_cuentas_cobrar_alerta['numero_cuota'];
		$monto_cuota                     = $total_pendiente;
		$monto_cuota_sin_interes         = $total_pendiente;
		$nombre_tipo_cobro               = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro'];
		$vendedor                        = $datos_cuentas_cobrar_alerta['vendedor'];
		$cuenta                          = $datos_cuentas_cobrar_alerta['cuenta'];
		$fecha_pago                      = $datos_cuentas_cobrar_alerta['fecha_pago'];
		$fecha                           = $datos_cuentas_cobrar_alerta['fecha'];
		$fecha_mes                       = $datos_cuentas_cobrar_alerta['fecha_mes'];
		$anyo                            = $datos_cuentas_cobrar_alerta['anyo'];
		$fecha_invert                    = $datos_cuentas_cobrar_alerta['fecha_invert'];
		$fecha_seg                       = $datos_cuentas_cobrar_alerta['fecha_seg'];
		$cod_administrador               = $datos_cuentas_cobrar_alerta['cod_administrador'];
		$cod_tipo_moneda                 = $datos_cuentas_cobrar_alerta['cod_tipo_moneda'];
		$cod_tercero_propietario         = $datos_cuentas_cobrar_alerta['cod_tercero_propietario'];
		$cod_estado                      = 2;
		$total_pagar                     = $monto_deuda;
		$total_pendiente                 = $monto_deuda;

		$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_alerta (cod_cuentas_cobrar_alerta_cbk, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, numero_alerta, cod_factura, cod_tercero, 
		cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, 
		monto_cuota_sin_interes, nombre_tipo_cobro, vendedor, cuenta, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_administrador, cod_estado, 
		cod_tipo_moneda, cod_renovacion_contrato, cod_tercero_propietario, total_pagar, total_pendiente, fecha_pago_periodo_orig) 
		VALUES ('$cod_cuentas_cobrar_alerta_cbk', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_abonos', '$numero_alerta', '$cod_factura', '$cod_tercero', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', 
		'$monto_cuota_sin_interes', '$nombre_tipo_cobro', '$vendedor', '$cuenta', '$fecha_pago_reg', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_administrador', '$cod_estado', 
		'$cod_tipo_moneda', '$cod_renovacion_contrato', '$cod_tercero_propietario', '$total_pagar', '$total_pendiente', '$fecha_pago_periodo_orig')";
		$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	}
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_opcion_alquiler_imprimir.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta ?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&pagina=<?php echo $pagina_redirect ?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>">
<?php } ?>