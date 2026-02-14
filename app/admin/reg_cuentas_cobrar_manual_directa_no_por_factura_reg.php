<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_factura']) <> '') { $cod_factura = mysqli_real_escape_string($conectar, ($_POST['cod_factura'])); } else { $cod_factura = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['monto_deuda']) <> '') { $monto_deuda = mysqli_real_escape_string($conectar, ($_POST['monto_deuda'])); } else { $monto_deuda = ''; }
	if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
	if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = ''; }
	if (isset($_POST['cod_sino']) <> '') { $cod_sino = mysqli_real_escape_string($conectar, ($_POST['cod_sino'])); } else { $cod_sino = '1'; }
	if (isset($_POST['cod_puc']) <> '') { $cod_puc = intval($_POST['cod_puc']); $cod_puc_post = intval($_POST['cod_puc']); } else { $cod_puc = ''; $cod_puc_post = ''; }
	if (isset($_POST['cod_movimiento_contable_cuenta_personal']) <> '') { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = '0'; }
	if (isset($_POST['mensaje']) <> '') { $mensaje = mysqli_real_escape_string($conectar, ($_POST['mensaje'])); } else { $mensaje = ''; }
	if (isset($_POST['cod_tipo_pago']) <> '') { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	$nombre_nota_observacion                                  = 'SOPORTES CUENTA COBRAR | '.$mensaje;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
	$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
	$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

	$cod_movimiento_contable                                  = $datos_autoincremento_egresos['AUTO_INCREMENT'];

	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

	$cod_cuentas_cobrar                                       = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
//-------------------------------------- -----------------------------------------------------------------//
	$cod_administrador                                        = ($_SESSION['cod_administrador']);
	$fecha_anyo                                               = $fecha_pago;
	$fecha_seg       	                                      = time();
	$fecha_mes	                                              = date("Y-m", strtotime($fecha_pago));
	$anyo		                                              = date("Y", strtotime($fecha_pago));
	$fecha	                                                  = $fecha_pago;
	$fecha_invert	                                          = $fecha_pago;
	$hora	                                                  = date("H:i:s");
	$cuenta                                                   = $cuenta_actual;
	$vendedor                                                 = $cuenta_actual;
	$subtotal                                                 = $monto_deuda;
	$abonado                                                  = 0;
	$cod_estado_cuenta_cobrar                                 = 1;
	$fecha_modificacion_cuenta_cobrar                         = date("Y-m-d H:i:s");
	$fecha_factura                                            = $fecha_pago;
	$tipo_soporte                                             = "CUENTA_COBRAR";
	$cod_tipo_nota_observacion                                = 16;
	$cod_dependencia                                          = 1;
	$nombre_ccosto                                            = 'PERSONAL';
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
		$nombre_normal2                                       = $tipo_soporte.'_'.$fecha_ymdHis.'_'.$cod_movimiento_contable.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
		$url_img_orig_producto                                = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                                 = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                         = "";
		$formato_img2                                         = "";
		$nombre_normal2                                       = "";
		$url_img_orig_producto                                = "";
		$url_img_min_producto                                 = "";
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_permiso_usuario = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (cod_factura = '$cod_factura')";
	$consulta_datos_permiso_usuario = mysqli_query($conectar, $sql_datos_permiso_usuario) or die(mysqli_error($conectar));
	$matriz_datos_permiso_usuario = mysqli_fetch_assoc($consulta_datos_permiso_usuario);

	$cod_info_factura_venta            = $matriz_datos_permiso_usuario['cod_info_factura_venta'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_tercero = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_tercero = mysqli_query($conectar, $sql_datos_tercero) or die(mysqli_error($conectar));
	$matriz_datos_tercero = mysqli_fetch_assoc($consulta_datos_tercero);

	$nombres_clientes                  = $matriz_datos_tercero['nombre1_tercero'].' '.$matriz_datos_tercero['nombre2_tercero'].' '.$matriz_datos_tercero['apellido1_tercero'].' '.$matriz_datos_tercero['apellido2_tercero'];
	$nit_cliente                       = $matriz_datos_tercero['identificacion_tercero'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

	$cod_cuentas_cobrar                = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$agreg = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_factura, cod_tercero, monto_deuda, subtotal, abonado, vendedor, cuenta, 
	fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_info_factura_venta, cod_tipo_forma_pago, mensaje, url_img_orig_producto) 
	VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$abonado', '$vendedor', '$cuenta', 
	'$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_info_factura_venta', '$cod_tipo_forma_pago', '$mensaje', '$url_img_orig_producto')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, cod_tipo_nota_observacion, cod_movimiento_contable, 
	url_img_orig_producto, url_img_min_producto, cod_cuentas_cobrar) 
	VALUES ('$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$cod_administrador', '$fecha_creacion', '$cod_tipo_nota_observacion', '$cod_movimiento_contable', 
	'$url_img_orig_producto', '$url_img_min_producto', '$cod_cuentas_cobrar')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($cod_estado_generar_movimiento_contable_automatico_global == '1' && $cod_sino == '2') {
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_anyo));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_anyo));
		$anyo                                                  = date("Y", strtotime($fecha_anyo));
		$fecha_seg                                             = strtotime($fecha_anyo);

		$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt                  = 0;
		$fecha_movimiento_contable_cuenta_personal             = $fecha_pago;

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_movimiento_contable                               = $datos_autoincremento_egresos['AUTO_INCREMENT'];

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                              = $info_guia_movimiento['cod_guia']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
		$doc_modifica                                          = "CUENTA POR COBRAR: ".$cod_factura." | ".$nombres_clientes." | "." | ".$fecha_anyo." | ID ".$cod_cuentas_cobrar;
		$descripcion_movimiento                                = "cuenta por cobrar: ".$cod_factura." | ID ".$cod_cuentas_cobrar." | ".$mensaje;
		$total_costo_movimiento_contable                       = $monto_deuda;
		$cod_tipo_nota_observacion                             = 16;
		$comentario                                            = $mensaje;
/* ----------------------------------------------------------------------------------------------------------/ */
		$agreg_mov_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, cod_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable,  
		cod_tercero, nombres_clientes, nit_cliente, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, 
		cod_tipo_nota_observacion, cod_cuentas_cobrar, url_img_orig_producto, cod_dependencia, nombre_ccosto)
		VALUES ('$nombre_estado_factura', '$cod_factura',  '$doc_modifica', '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', 
		'$cod_tercero', '$nombres_clientes', '$nit_cliente', '$fecha_anyo', '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', 
		'$cod_tipo_nota_observacion', '$cod_cuentas_cobrar', '$url_img_orig_producto', '$cod_dependencia', '$nombre_ccosto')";
		$resultado_mov = mysqli_query($conectar, $agreg_mov_reg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'CUENTAS POR COBRAR') AND (codigo_parametrizacion_puc_cuentas_estaticas = '15')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//2633
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//138020
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS COBRAR A TERCEROS
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO
		
		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		//$cod_puc                                               = '2633';
		//$codigo_puc                                            = '138020';
		//$nombre_puc                                            = 'CUENTAS POR COBRAR DE TERCEROS';
		//$tipo_puc                                              = 'ACTIVO';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $monto_deuda;
		$total_costo_movimiento_contable                       = $monto_deuda;	

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	    $sql_puc_credito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
	    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
	    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);
        //$existe_reg = mysqli_num_rows($resultado_puc_credito);

	    $cod_puc_credito_db                                = $info_puc_credito['cod_puc'];
	    $codigo_puc_credito_db                             = $info_puc_credito['codigo_puc'];
	    $nombre_puc_credito_db                             = $info_puc_credito['nombre_puc'];
	    $tipo_puc_credito_db                               = $info_puc_credito['tipo_puc'];
	    $saldo_actual_puc_credito_db                       = $info_puc_credito['saldo_actual_puc'];

		$nombre_tipo_movimiento 	                       = 'CREDITOS';
		$cod_puc                                           = $cod_puc_credito_db;
		$codigo_puc                                        = $codigo_puc_credito_db;
		$nombre_puc                                        = $nombre_puc_credito_db;
		$tipo_puc                                          = $tipo_puc_credito_db;
		$und_vendida                                       = '1';
		$costo_movimiento_contable                         = $monto_deuda;
		$total_costo_movimiento_contable                   = $monto_deuda;	

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

		$saldo_actual_puc_credito                          = $saldo_actual_puc_credito_db - $costo_movimiento_contable;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_credito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'CUENTAS POR COBRAR') AND (codigo_parametrizacion_puc_cuentas_estaticas = '15')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//2633
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//138020
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS COBRAR A TERCEROS
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		//$cod_puc                                               = '2633';
		//$codigo_puc                                            = '138020';
		//$nombre_puc                                            = 'CUENTAS POR COBRAR DE TERCEROS';
		//$tipo_puc                                              = 'ACTIVO';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $monto_deuda;
		$total_costo_movimiento_contable                       = $monto_deuda;

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $monto_deuda;
		$saldo_actual_puc                                      = $monto_deuda;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $monto_deuda;
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
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_else ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>