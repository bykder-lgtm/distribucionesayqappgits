<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_producto_codifcryp'])) {

    $cod_producto_codifcryp                                         = ($_POST['cod_producto_codifcryp']);
    $cod_producto_codif                                             = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                                                   = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));
    $valor_credito                                                  = intval($_POST['valor_credito']);
    $cod_entidad_crediticia                                         = intval($_POST['cod_entidad_crediticia']);
    $cod_tipo_cobro                                                 = intval($_POST['cod_tipo_cobro']);
    $cod_meses_credito                                              = intval($_POST['cod_meses_credito']);
    $nombre_tipo_tercero                                            = addslashes($_POST['nombre_tipo_tercero']);
    $nombre_tipo_tercero_modulo_creacion                            = addslashes($_POST['nombre_tipo_tercero_modulo_creacion']);
    $cod_administrador                                              = intval($_POST['cod_administrador']);
    $cod_seguridad                                                  = intval($_POST['cod_seguridad']);
    $cod_aliado_estrategico                                         = $cod_administrador;
	//---------------------------------------------------------------------------------------------------------------------------------//
	if (isset($_POST['nombre_tipo_identificacion'])) { $nombre_tipo_identificacion = addslashes($_POST['nombre_tipo_identificacion']); } else { $nombre_tipo_identificacion = 'CC'; }
	if (isset($_POST['identificacion_tercero'])) { $identificacion_tercero = addslashes($_POST['identificacion_tercero']); } else { $identificacion_tercero = ''; }
	if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes(trim($_POST['nombre1_tercero'])); } else { $nombre1_tercero = ''; }
	if (isset($_POST['nombre2_tercero'])) { $nombre2_tercero = addslashes(trim($_POST['nombre2_tercero'])); } else { $nombre2_tercero = ''; }
	if (isset($_POST['apellido1_tercero'])) { $apellido1_tercero = addslashes(trim($_POST['apellido1_tercero'])); } else { $apellido1_tercero = ''; }
	if (isset($_POST['apellido2_tercero'])) { $apellido2_tercero = addslashes(trim($_POST['apellido2_tercero'])); } else { $apellido2_tercero = ''; }
	if (isset($_POST['fecha_nac_tercero'])) { $fecha_nac_tercero = addslashes($_POST['fecha_nac_tercero']); } else { $fecha_nac_tercero = ''; }
	if (isset($_POST['fecha_expedicion_tercero'])) { $fecha_expedicion_tercero = addslashes($_POST['fecha_expedicion_tercero']); } else { $fecha_expedicion_tercero = ''; }
	if (isset($_POST['telefono1_tercero'])) { $telefono1_tercero = addslashes($_POST['telefono1_tercero']); } else { $telefono1_tercero = ''; }
	if (isset($_POST['correo_tercero'])) { $correo_tercero = addslashes($_POST['correo_tercero']); } else { $correo_tercero = ''; }
	if (isset($_POST['direccion_tercero'])) { $direccion_tercero = addslashes($_POST['direccion_tercero']); } else { $direccion_tercero = ''; }
	if (isset($_POST['nombre_estado_civil'])) { $nombre_estado_civil = addslashes($_POST['nombre_estado_civil']); } else { $nombre_estado_civil = ''; }
	if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = date("Y-m-d"); }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$nombre_actividad_ecoemp                                        = gethostname();
	$fecha_creacion                                                 = date("Y-m-d");
    $fecha_expiracion_cupon_descuento                               = date("H:i:s");
    $direccion_contacto1                                            = $_SERVER["REMOTE_ADDR"];
	$tel_contacto1                                                  = $cuenta_actual;
	$cod_estado_cliente                                             = 1;

	$cod_administrador                                              = ($_SESSION['cod_administrador']);
	$fecha_anyo                                                     = $fecha_creacion;
	$fecha_seg       	                                            = time();
	$fecha_mes	                                                    = date("Y-m", strtotime($fecha_creacion));
	$anyo		                                                    = date("Y", strtotime($fecha_creacion));
	$fecha	                                                        = $fecha_creacion;
	$fecha_invert	                                                = $fecha_creacion;
	$hora	                                                        = date("H:i:s");
	$cuenta                                                         = $cuenta_actual;
	$vendedor                                                       = $cuenta_actual;
	$cod_estado_cuenta_cobrar                                       = 1;
	$fecha_modificacion_cuenta_cobrar                               = date("Y-m-d H:i:s");
	$fecha_factura                                                  = $fecha_creacion;
	$tipo_soporte                                                   = "CUENTA_COBRAR";
	$cod_dependencia                                                = 1;
	$nombre_ccosto                                                  = 'PERSONAL';
	$nombre_maquina                                                 = gethostname();
	$observacion_tercero                                            = '.';
	$fecha_entrega                                                  = date("Y-m-d");
	$fecha_venta_ymd_dian                                           = $fecha_anyo;
	$fecha_venta_hora_dian                                          = date("Y-m-d");
	$retefuente_ptj                                                 = 0;
//-------------------------------------- -----------------------------------------------------------------//
	$cliente                                                        = "";
	$fecha_ymd                                                      = $fecha_creacion;
	$fecha_anyo_seg                                                 = strtotime($fecha_anyo);
	$fecha_dia                                                      = date("Y-m-d", $fecha_anyo_seg);
	$fecha_hora_venta_producto                                      = date("H:i:s");
	$comentario                                                     = "";
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                                           = time();
	$fecha_ymdHis                                                   = date("YmdHis");
	$formato                                                        = 'jpg';
	$fecha_hora                                                     = date("H:i:s");
	$fecha_reg                                                      = date("Y-m-d");
	$nombre_tipo_moneda                                             = "COP";
	$cod_tipo_pago                                                  = 2;
	$cod_tipo_forma_pago                                            = 22;
	$cod_resolucion_facturacion                                     = 1;
	$cod_tipo_nota_observacion                                      = 20;
	$codigo_estado_revision                                         = 0;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
	$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	$nombre_tipo_factura                           = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_administrador = "SELECT cod_lider, cod_coordinador, cod_asesor FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$resultado_administrador = mysqli_query($conectar, $obtener_administrador) or die(mysqli_error($conectar));
	$info_administrador = mysqli_fetch_assoc($resultado_administrador);

	$cod_lider                                     = $info_administrador['cod_lider'];
	$cod_coordinador                               = $info_administrador['cod_coordinador'];
	$cod_asesor                                    = $info_administrador['cod_asesor'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

	$cod_cuentas_cobrar                            = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_factura_venta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
	$exec_autoincremento_info_factura_venta = mysqli_query($conectar, $sql_autoincremento_info_factura_venta) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura_venta = mysqli_fetch_assoc($exec_autoincremento_info_factura_venta);

	$cod_info_factura_venta                        = $datos_autoincremento_info_factura_venta['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_producto = "SELECT cod_producto_barra, nombre_producto, precio_compra_producto, precio_venta_producto, nombre_tipo_unidad_medida FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $datos_producto = mysqli_fetch_assoc($consulta_producto);

    $cod_producto_barra                            = $datos_producto['cod_producto_barra'];
    $nombre_producto                               = $datos_producto['nombre_producto'];
    $precio_compra_producto                        = $datos_producto['precio_compra_producto'];
    $precio_venta_producto                         = $datos_producto['precio_venta_producto'];
    $nombre_tipo_unidad_medida                     = $datos_producto['nombre_tipo_unidad_medida'];
    $und_producto                                  = 1;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_tercero = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_dato_tercero = mysqli_query($conectar, $sql_dato_tercero) or die(mysqli_error($conectar));
	$info_dato_tercero = mysqli_fetch_assoc($consultar_dato_tercero);
	$existe_dato_tercero = mysqli_num_rows(@$consultar_dato_tercero);

	$cod_tercero                                   = $info_dato_tercero['cod_tercero'];
   	$cod_tercero_codif                             = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
	$cod_tercero_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                     = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    $meses_max_entidad_crediticia                  = $datos_entidad_crediticia['meses_max_entidad_crediticia'];
    $quicenal_max_entidad_crediticia               = $datos_entidad_crediticia['quicenal_max_entidad_crediticia'];
    $url_entidad_crediticia_imag_min               = $datos_entidad_crediticia['url_entidad_crediticia_imag_min'];
    $url_entidad_crediticia_imag_orig              = $datos_entidad_crediticia['url_entidad_crediticia_imag_orig'];

    $sql_meses_credito = "SELECT * FROM tbl15_meses_credito WHERE (cod_meses_credito = '$cod_meses_credito')";
    $consulta_meses_credito = mysqli_query($conectar, $sql_meses_credito) or die(mysqli_error($conectar));
    $datos_meses_credito = mysqli_fetch_assoc($consulta_meses_credito);

    $codigo_meses_credito                        = $datos_meses_credito['codigo_meses_credito'];
    $nombre_meses_credito                        = $datos_meses_credito['nombre_meses_credito'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad = '23') { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                    = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                       = 'aliado_estrategico_aval_ptj';
    } elseif ($cod_seguridad = '22') { //ASESOR
        $nombre_compo_interes_ptj                    = 'asesor_interes_ptj';
        $nombre_compo_aval_ptj                       = 'asesor_aval_ptj';
    } else { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                    = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                       = 'aliado_estrategico_aval_ptj';
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
    if (($meses_max_entidad_crediticia <> '0' && $quicenal_max_entidad_crediticia == '0')) { //CUANDO SEA POR MES Y NO QUINCENAL
        $nombre_tipo_cobro = 'MENSUAL';
        $numero_tipo_cobro = 1;
		$aumento_del_mes_o_quincena = "+1 month";
		$tipo_cobro = "month";
		//$fecha_pago = date('Y-m-d', strtotime(date('Y-m-d'.'+1 month')));
        $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
        if ($numero_cuotas > $meses_max_entidad_crediticia) {
            $numero_cuotas = $meses_max_entidad_crediticia  * $numero_tipo_cobro;
        } else {
            $numero_cuotas = $numero_cuotas;
        }
    } elseif (($meses_max_entidad_crediticia == '0' && $quicenal_max_entidad_crediticia <> '0')) { //CUANDO NO SEA POR MES Y SI QUINCENAL
        $nombre_tipo_cobro = 'QUINCENAL';
        $numero_tipo_cobro = 2;
 		$aumento_del_mes_o_quincena = "+15 day";
		$tipo_cobro = "day";
		//$fecha_pago = date('Y-m-d', strtotime(date('Y-m-d'.'+15 day')));
        $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
        if ($numero_cuotas > $quicenal_max_entidad_crediticia) {
            $numero_cuotas = $quicenal_max_entidad_crediticia;
        } else {
            $numero_cuotas = $numero_cuotas;
        }
    } else { //CUANDO SEA POR MES Y QUINCENAL O NINGUNO DE LOS DOS (TIENE PRIORIDAD EL MES)
        $nombre_tipo_cobro = 'MENSUAL';
        $numero_tipo_cobro = 1;
		$aumento_del_mes_o_quincena = "+1 month";
		$tipo_cobro = "month";
		//$fecha_pago = date('Y-m-d', strtotime(date('Y-m-d'.'+1 month')));
        $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
    }

    $interes_ptj                                   = $datos_entidad_crediticia[$nombre_compo_interes_ptj];
    $aval_ptj                                      = $datos_entidad_crediticia[$nombre_compo_aval_ptj];
    $total_interes                                 = $valor_credito * ($interes_ptj / 100);
    $total_pagar                                   = $valor_credito + $total_interes;
    $cuota_credito                                 = $total_pagar / $numero_cuotas;
    $monto_deuda                                   = $total_pagar;
    $monto_deuda_sin_interes                       = $precio_venta_producto;
    $subtotal                                      = $total_pagar;
    $subtotal_sin_interes                          = $precio_venta_producto;
    $numero_cuota                                  = $numero_cuotas;
    $monto_cuota                                   = $cuota_credito;
    $monto_deuda_mas_interes                       = $total_pagar;
    $monto_cuota_interes                           = $total_interes;
    $total_pendiente                               = $total_pagar;
	$total_precio_compra                           = $precio_venta_producto;
	$total_precio_venta                            = $total_pagar;
	$total_valor_venta                             = $total_pagar;
	$total_valor_recibir                           = $total_pagar;

	$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
	$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
	$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

	//$cod_factura                         = $maxima_factura['cod_factura']+1;
	$cod_factura                         = 0;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;
	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_tercero > 0) {

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_factura, cod_tipo_forma_pago, monto_deuda, subtotal, total_pendiente, total_valor_venta, monto_deuda_mas_interes, 
		total_valor_recibir, vendedor, cuenta, cod_producto, cod_producto_barra, nombre_producto, 
		cod_tercero, cod_entidad_crediticia, cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico, monto_deuda_sin_interes, 
		fecha_pago, fecha_reg, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, 
		subtotal_sin_interes, numero_cuota, monto_cuota, interes_ptj, monto_cuota_interes, nombre_tipo_cobro, fecha_creacion, cod_administrador, nombre1_tercero, 
		nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero) 
		VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tipo_forma_pago', '$monto_deuda', '$subtotal', '$total_pendiente', '$total_valor_venta', '$monto_deuda_mas_interes',
		'$total_valor_recibir', '$vendedor', '$cuenta', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
		'$cod_tercero', '$cod_entidad_crediticia', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_aliado_estrategico', '$monto_deuda_sin_interes', 
		'$fecha_pago', '$fecha_reg', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', 
		'$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', '$interes_ptj', '$monto_cuota_interes', '$nombre_tipo_cobro', '$fecha_creacion', '$cod_administrador', '$nombre1_tercero', 
		'$nombre2_tercero', '$apellido1_tercero', '$apellido2_tercero', '$identificacion_tercero')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/*
		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
		total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
		WHERE (cod_tercero = '$cod_tercero')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

		$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
		nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_venta_producto, 
		total_venta_producto, nombre_tipo_producto, und_producto, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
		nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
		fecha_alerta, cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
		cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, 
		cod_dependencia, precio_venta_producto_orig, cod_categoria, nombre_tipo_precio, cod_base_caja, cod_puc, cod_marca, cupo_credito_ptj)
		VALUES ('$cod_info_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
		'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_venta_producto', 
		'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
		'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
		'$fecha_alerta', '$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
		'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', 
		'$cod_dependencia', '$precio_venta_producto_orig', '$cod_categoria', '$nombre_tipo_precio', '$cod_base_caja', '$cod_puc', '$cod_marca', '$cupo_credito_ptj')";
		$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));

		$agregar_regis = "INSERT INTO tbl15_info_factura_venta (cod_estado_factura, cod_factura, fecha_anyo, fecha_dia, fecha_mes, anyo, fecha_hora, total_precio_compra, 
		total_precio_venta, cod_tercero, nombre_estado_factura, cuenta, cod_tipo_pago, cod_tipo_forma_pago, cod_administrador, nombre_tipo_factura, 
		nombre_tipo_moneda, nombre_maquina, cod_resolucion_facturacion, observacion_tercero, monto_deuda, subtotal, fecha_entrega, fecha_pago, 
		fecha_venta_ymd_dian, fecha_venta_hora_dian, retefuente_ptj)
		VALUES ('$cod_estado_factura', '$cod_factura', '$fecha_anyo', '$fecha_dia', '$fecha_mes', '$anyo', '$fecha_hora', '$total_precio_compra', 
		'$total_precio_venta', '$cod_tercero', 	'$nombre_estado_factura', '$cuenta', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$cod_administrador', '$nombre_tipo_factura',
		'$nombre_tipo_moneda', '$nombre_maquina', '$cod_resolucion_facturacion', '$observacion_tercero', '$monto_deuda', '$subtotal', '$fecha_entrega', '$fecha_pago', 
		'$fecha_venta_ymd_dian', '$fecha_venta_hora_dian', '$retefuente_ptj')";
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

		$actualiza_producto = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto', WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
*/
    } else {
		$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
		$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
		$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

		$cod_tercero                                   = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	   	$cod_tercero_codif                             = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
    	$cod_tercero_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);

		$sql_data = "INSERT INTO tbl15_tercero (cod_tercero, nombre_tipo_tercero, nombre_tipo_tercero_modulo_creacion, cod_producto, valor_credito, cod_entidad_crediticia, cod_tipo_cobro, cod_meses_credito, 
		nombre_tipo_identificacion, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, 
		fecha_nac_tercero, fecha_expedicion_tercero, telefono1_tercero, correo_tercero, direccion_tercero, nombre_estado_civil, fecha_creacion, 
		cod_administrador, cod_estado_cliente, fecha_expiracion_cupon_descuento, nombre_actividad_ecoemp, direccion_contacto1, tel_contacto1, cod_seguridad, 
		cod_estado_cuenta_cobrar, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar, fecha_modificacion_cuenta_cobrar) 
		VALUES ('$cod_tercero', '$nombre_tipo_tercero', '$nombre_tipo_tercero_modulo_creacion', '$cod_producto', '$valor_credito', '$cod_entidad_crediticia', '$cod_tipo_cobro', '$cod_meses_credito', 
		'$nombre_tipo_identificacion', '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), 
		'$fecha_nac_tercero', '$fecha_expedicion_tercero', '$telefono1_tercero', '$correo_tercero', '$direccion_tercero', '$nombre_estado_civil', '$fecha_creacion', 
		'$cod_administrador', '$cod_estado_cliente', '$fecha_expiracion_cupon_descuento', '$nombre_actividad_ecoemp', '$direccion_contacto1', '$tel_contacto1', '$cod_seguridad', 
		'$cod_estado_cuenta_cobrar', '$total_monto_deuda_cuenta_cobrar', '$total_subtotal_cuenta_cobrar', '$total_abonado_cuenta_cobrar', '$fecha_modificacion_cuenta_cobrar')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_factura, cod_tipo_forma_pago, monto_deuda, subtotal, total_pendiente, total_valor_venta, monto_deuda_mas_interes, 
		total_valor_recibir, vendedor, cuenta, cod_producto, cod_producto_barra, nombre_producto, 
		cod_tercero, cod_entidad_crediticia, cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico, monto_deuda_sin_interes, 
		fecha_pago, fecha_reg, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, 
		subtotal_sin_interes, numero_cuota, monto_cuota, interes_ptj, monto_cuota_interes, nombre_tipo_cobro, fecha_creacion, cod_administrador, nombre1_tercero, 
		nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero) 
		VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tipo_forma_pago', '$monto_deuda', '$subtotal', '$total_pendiente', '$total_valor_venta', '$monto_deuda_mas_interes',
		'$total_valor_recibir', '$vendedor', '$cuenta', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
		'$cod_tercero', '$cod_entidad_crediticia', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_aliado_estrategico', '$monto_deuda_sin_interes', 
		'$fecha_pago', '$fecha_reg', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', 
		'$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', '$interes_ptj', '$monto_cuota_interes', '$nombre_tipo_cobro', '$fecha_creacion', '$cod_administrador', '$nombre1_tercero', 
		'$nombre2_tercero', '$apellido1_tercero', '$apellido2_tercero', '$identificacion_tercero')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_sql = "SELECT * FROM tbl15_documento_requisito_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_estado = '1') ORDER BY cod_documento_requisito_entidad_crediticia DESC";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	    $cod_documento_requisito_entidad_crediticia     = $matriz_consulta['cod_documento_requisito_entidad_crediticia'];
	    $nombre_documento_requisito_entidad_crediticia  = $matriz_consulta['nombre_documento_requisito_entidad_crediticia'];
	    $nombre_nota_observacion                        = $nombre_documento_requisito_entidad_crediticia;

		$sql_data = "INSERT INTO tbl15_nota_observacion (cod_cuentas_cobrar, nombre_nota_observacion, cuenta, cod_administrador, cod_tercero, cod_tipo_nota_observacion, fecha_creacion, codigo_estado_revision) 
		VALUES ('$cod_cuentas_cobrar', '$nombre_nota_observacion', '$cuenta', '$cod_administrador', '$cod_tercero', '$cod_tipo_nota_observacion', '$fecha_creacion', '$codigo_estado_revision')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$numero_alerta                  = 0;
	$numero_alerta_correcion        = 0;
	$fecha_invert	                = $fecha_pago;
	$cod_estado                     = 0;

	for ($contador=0; $contador < $numero_cuota ; $contador++) { 

		$numero_alerta++;
		$numero_alerta_correcion++;
		$dia_corte_pago                 = date("d", strtotime($fecha_pago));
		$mes_corte_pago                 = date("m", strtotime($fecha_pago));
		$anyo_corte_pago                = date("Y", strtotime($fecha_pago));
	    $fecha_pago_modif               = $anyo_corte_pago.'-'.$mes_corte_pago.'-'.'01';
	    $fecha_mes_pago_modif           = $anyo_corte_pago.'-'.$mes_corte_pago;
	    $fecha_mes_modif                = date('Y-m-d', strtotime($fecha_pago_modif.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
	    $fecha_mes_real                 = date("Y-m", strtotime($fecha_mes_modif));

		$fecha_pago_alerta_datetime     = DateTime::createFromFormat('Y-m-d', $fecha_mes_modif); //(1) aquí se pone el formato que tiene el dato original
		$ultimo_del_dia	                = $fecha_pago_alerta_datetime->format('t');

		if ($dia_corte_pago > $ultimo_del_dia) { 
			$fecha_pago_alerta              = $fecha_mes_real.'-'.$ultimo_del_dia;
			$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
			$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
			$fecha_pago_periodo_orig        = $fecha_pago_alerta;
		} else { 
			$fecha_pago_alerta              = $fecha_mes_real.'-'.$dia_corte_pago;
			$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
			$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
			$fecha_pago_periodo_orig        = $fecha_pago_alerta;
		}
		$fecha_alerta_mes                                  = date('Y-m-d', strtotime($fecha_pago_periodo_orig.$aumento_del_mes_o_quincena));

		$agreg_alerta = "INSERT INTO tbl15_cuentas_cobrar_alerta (cod_cuentas_cobrar, numero_alerta, cod_tercero, monto_deuda_sin_interes, 
		numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, 
		monto_cuota_interes, vendedor, cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_factura, cod_administrador, 
		cod_producto, cod_producto_barra, nombre_producto, cod_estado, total_pagar, total_pendiente) 
		VALUES ('$cod_cuentas_cobrar', '$numero_alerta', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', 
		'$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago_alerta', '$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', 
		'$monto_cuota_interes', '$vendedor', '$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_factura', '$cod_administrador', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$cod_estado', '$total_pagar', '$total_pendiente')";
		$resultado_alerta = mysqli_query($conectar, $agreg_alerta) or die(mysqli_error($conectar));
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad == '25') { // CLIENTE
    	$pagina_redirect = "../admin/lista_cliente_siscredito_visitante_intern.php";
    } elseif ($cod_seguridad == '23') { // ALIADO ESTRATEGICO
    	$pagina_redirect = "../admin/lista_cuenta_por_cobrar_aliado_estrategico_siscredito_visitante_intern.php";
    } else {
    	$pagina_redirect = "../admin/lista_cliente_siscredito_visitante_intern.php";
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$url_redir = $pagina_redirect."?cod_cuentas_cobrar=".$cod_cuentas_cobrar."&cod_entidad_crediticia=".$cod_entidad_crediticia."&cod_tercero_codifcryp=".$cod_tercero_codifcryp;
	header("Location: $url_redir");
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
}
?>