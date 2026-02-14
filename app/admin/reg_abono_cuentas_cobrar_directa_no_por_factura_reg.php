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
$cuenta_actual                                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                                                  = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                                                = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                                              = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                                         = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                                          = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                                             = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                                           = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                                            = ($_SESSION['cod_administrador']);
$cod_base_caja                                                = ($_SESSION['cod_base_caja']);
$cod_estado_cuenta_cobrar                                     = 1;
$fecha_modificacion_cuenta_cobrar                             = date("Y-m-d H:i:s");
$cuenta                                                       = ($cuenta_actual);
$tipo_soporte                                                 = "ABONO_CUENTA_COBRAR";
$cod_tipo_nota_observacion                                    = 12;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_movimiento_contable_cuenta_personal_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global     = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_movimiento_contable_cuenta_personal_global        = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_tercero                                              = intval($_POST['cod_tercero']);
	$abonado                                                  = addslashes($_POST['abonado']);
	$mensaje                                                  = addslashes($_POST['mensaje']);
	$fecha_pago                                               = addslashes($_POST['fecha_pago']);
	$cod_tipo_forma_pago                                      = intval($_POST['cod_tipo_forma_pago']);
	$cod_dependencia                                          = intval($_POST['cod_dependencia']);
	if (isset($_POST['pagina'])) { $pagina = addslashes($_POST['pagina']); } else { $pagina = "../admin/cuentas_cobrar_abonos.php"; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_POST['cod_sino'])) { $cod_sino = intval($_POST['cod_sino']); } else { $cod_sino = 1; }
	if (isset($_POST['cod_puc'])) { $cod_puc = intval($_POST['cod_puc']); $cod_puc_post = intval($_POST['cod_puc']); } else { $cod_puc = 0; $cod_puc_post = 0; }
	if (isset($_POST['cod_movimiento_contable_cuenta_personal'])) { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = 0; }
	if (isset($_POST['cod_tipo_pago']) <> '') { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	$nombre_nota_observacion                                  = 'SOPORTES ABONO CUENTA COBRAR | '.$mensaje;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
	$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

	$nit_cliente                                              = $info_cliente['identificacion_tercero'];
	$nombres_clientes                                         = $info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].' '.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero'];
	$digito                                                   = $info_cliente['digito_tercero'];
//-------------------------------------- -----------------------------------------------------------------//
	$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
	$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
	$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

	$cod_movimiento_contable                                  = $datos_autoincremento_egresos['AUTO_INCREMENT'];

	$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
	$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);

	$cod_cuentas_cobrar_abonos                                = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
//-------------------------------------- -----------------------------------------------------------------//
	$fecha_anyo                                               = date("Y-m-d", strtotime($fecha_pago));
	$fecha_mes                                                = date("Y-m", strtotime($fecha_pago));
	$anyo                                                     = date("Y", strtotime($fecha_pago));
	$fecha_invert                                             = date("Y-m-d", strtotime($fecha_pago));
	$fecha_seg                                                = strtotime($fecha_pago);
	$hora                                                     = date("H:i:s");
	$cliente                                                  = "";
	$fecha_ymd                                                = $fecha_pago;
	$fecha_anyo_seg                                           = strtotime($fecha_anyo);
	$fecha_dia                                                = date("Y-m-d", $fecha_anyo_seg);
	$fecha_factura                                            = date("Y-m-d", $fecha_anyo_seg);
	$fecha_hora_venta_producto                                = date("H:i:s");
	$cuenta                                                   = $cuenta_actual;
	$comentario                                               = $mensaje;
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                                     = time();
	$fecha_ymdHis                                             = date("YmdHis");
	$formato                                                  = 'jpg';
	$fecha_hora                                               = date("H:i:s");
	$fecha_ymd                                                = date("Y-m-d");
	$fecha_creacion                                           = date("Y-m-d");

	$ruta_firma_miniatura                                     = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                      = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                          = '../archivador/firma/original/';
	$ruta_foto_orig                                           = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                         = explode(".", $url_img1);
		$formato_img2                                         = end($formato_img2);
		$nombre_normal2                                       = $tipo_soporte.'_'.$fecha_ymdHis.'_'.$cod_movimiento_contable.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
		$url_img_orig_producto                                = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                                 = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                         = "";
		$formato_img2                                         = "";
		$nombre_normal2                                       = "";
		$url_img_orig_producto                                = "";
		$url_img_min_producto                                 = "";
	}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
	anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_puc) 
	VALUES ('$cod_tercero', '$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', 
	'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_puc')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar                          = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar                              = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar                             = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_movimiento_caja = "SELECT total_compra_producto, total_venta_producto, total_saldo, fecha_ymd_movimiento_caja FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '1')";
	$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
	$datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

	$total_compra_producto                                    = $datos_movimiento_caja['total_compra_producto'];
	$total_venta_producto                                     = $datos_movimiento_caja['total_venta_producto'];
	$total_saldo                                              = $datos_movimiento_caja['total_saldo'];
	$fecha_ymd_movimiento_caja                                = $datos_movimiento_caja['fecha_ymd_movimiento_caja'];
	$nombre_tipo_puc                                          = 'INGRESO';

	if ($nombre_tipo_puc == 'INGRESO') { $total_saldo_final = $total_saldo + $abonado; } else { $total_saldo_final = $total_saldo - $abonado; }

	$agregar_regis = sprintf("UPDATE tbl15_movimiento_caja SET total_saldo = '$total_saldo_final' WHERE cod_movimiento_caja = '1'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, cod_tipo_nota_observacion, cod_movimiento_contable, 
	url_img_orig_producto, url_img_min_producto, cod_cuentas_cobrar_abonos) 
	VALUES ('$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$cod_administrador', '$fecha_creacion', '$cod_tipo_nota_observacion', '$cod_movimiento_contable', 
	'$url_img_orig_producto', '$url_img_min_producto', '$cod_cuentas_cobrar_abonos')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($cod_estado_generar_movimiento_contable_automatico_global == '1' && $cod_sino == '2') {

		$nombre_tipo_documento                             = 'RECIBO DE CAJA';
		$nombre_estado_factura                             = 'CERRADA';
		$ip                                                = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt              = 0;
		$fecha_movimiento_contable_cuenta_personal         = date("Y-m-d");

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                          = $info_guia_movimiento['cod_guia']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
		$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
		$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
		$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

		$nit_cliente                                       = $info_cliente['identificacion_tercero'];
		$nombres_clientes                                  = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
		$digito                                            = $info_cliente['digito_tercero'];
/* ----------------------------------------------------------------------------------------------------------/ */
		$fecha_ymd                                         = $fecha_pago;
		$fecha_factura                                     = date("Y-m-d", $fecha_seg);
		$fecha_hora_venta_producto                         = date("H:i:s");
		$cuenta                                            = $cuenta_actual;
		$comentario                                        = $mensaje;
/* ----------------------------------------------------------------------------------------------------------/ */
		$doc_modifica                                      = "";
		$descripcion_movimiento                            = "Abono cuenta por cobrar: ".$nombres_clientes.' | '.$fecha_anyo.' | '.$comentario;
		$total_costo_movimiento_contable                   = $abonado;
		$cod_tipo_nota_observacion                         = 1;
		$cod_factura                                       = '';
		$venta_movimiento_contable                         = '';
		$total_venta_movimiento_contable                   = '';
/* ----------------------------------------------------------------------------------------------------------/ */
		$agreg_mov_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, cod_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable,  
		cod_tercero, nombres_clientes, nit_cliente, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, url_img_orig_producto)
		VALUES ('$nombre_estado_factura', '$cod_factura',  '$doc_modifica', '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', 
		'$cod_tercero', '$nombres_clientes', '$nit_cliente', '$fecha_anyo', '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$url_img_orig_producto')";
		$resultado_mov = mysqli_query($conectar, $agreg_mov_reg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);
        //$existe_reg = mysqli_num_rows($resultado_puc_debito);

	    $cod_puc_debito_db                                 = $info_puc_debito['cod_puc'];
	    $codigo_puc_debito_db                              = $info_puc_debito['codigo_puc'];
	    $nombre_puc_debito_db                              = $info_puc_debito['nombre_puc'];
	    $tipo_puc_debito_db                                = $info_puc_debito['tipo_puc'];
	    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];

		$nombre_tipo_movimiento 	                       = 'DEBITOS';
		$cod_puc                                           = $cod_puc_debito_db;
		$codigo_puc                                        = $codigo_puc_debito_db;
		$nombre_puc                                        = $nombre_puc_debito_db;
		$tipo_puc                                          = $tipo_puc_debito_db;
		$und_vendida                                       = '1';
		$costo_movimiento_contable                         = $abonado;
		$total_costo_movimiento_contable                   = $abonado;	

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
		venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, cod_tercero, cod_guia)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$cod_tercero', '$cod_guia')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		//if ($saldo_actual_puc_debito_db >= 0) { }
		$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $abonado;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'CUENTAS POR COBRAR') AND (codigo_parametrizacion_puc_cuentas_estaticas = '15')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//2633
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//138020
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS COBRAR A TERCEROS
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

	 	$nombre_tipo_movimiento 	                           = 'CREDITOS';
		//$cod_puc                                               = '2633';
		//$codigo_puc                                            = '138020';
		//$nombre_puc                                            = 'CUENTAS POR COBRAR DE TERCEROS';
		//$tipo_puc                                              = 'ACTIVO';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $abonado;
		$total_costo_movimiento_contable                       = $abonado;

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
		venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

		$sql_puc_credito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
	    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);
        //$existe_reg = mysqli_num_rows($resultado_puc_credito);
	    $saldo_actual_puc_credito_db                       = $info_puc_credito['saldo_actual_puc'];
		//if ($saldo_actual_puc_credito_db >= 0) { }
		$saldo_actual_puc_credito = $saldo_actual_puc_credito_db - $abonado;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_credito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'CUENTAS POR COBRAR') AND (codigo_parametrizacion_puc_cuentas_estaticas = '15')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//2633
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//138020
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS COBRAR A TERCEROS
		//$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO
		$tipo_puc                                              = 'INGRESOS';

		$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		//$cod_puc                                               = '2633';
		//$codigo_puc                                            = '138020';
		//$nombre_puc                                            = 'CUENTAS POR COBRAR DE TERCEROS';
		//$tipo_puc                                              = 'ACTIVO';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $abonado;
		$total_costo_movimiento_contable                       = $abonado;
		$fecha_seg                                             = strtotime($fecha_pago.' '.$hora);

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $abonado;
		$saldo_actual_puc                                      = $abonado;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $abonado;
		$fecha_ymd_movimiento_caja                             = date("Y-m-d");
		$fecha_mes_movimiento_caja                             = date("Y-m");
		$fecha_anyo_movimiento_caja                            = date("Y");
		$fecha_hora_movimiento_caja                            = date("H:i:s");
		$fecha_seg_movimiento_caja                             = time();
		$fecha_creacion                                        = date("Y-m-d H:i:s");
		$simbolo_tipo_operacion                                = "+";

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_cuentas_cobrar_abonos, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_abonos', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
//-------------------------------------- -----------------------------------------------------------------//
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/abono_cuentas_cobrar_directa_no_por_factura_opcion_imprimir.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&pagina=<?php echo $pagina ?>">
<?php } ?>