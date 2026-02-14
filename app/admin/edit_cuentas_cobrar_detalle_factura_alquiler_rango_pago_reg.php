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

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

if (isset($_POST['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = intval($_POST['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
if (isset($_POST['nombre_tipo_cobro']) <> '') { $nombre_tipo_cobro = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cobro'])); } else { $nombre_tipo_cobro = ''; }
if (isset($_POST['numero_cuota']) <> '') { $numero_cuota = intval($_POST['numero_cuota']); } else { $numero_cuota = ''; }
if (isset($_POST['cod_tipo_moneda']) <> '') { $cod_tipo_moneda = intval($_POST['cod_tipo_moneda']); } else { $cod_tipo_moneda = ''; }
if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes = '0'; }
if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

if (isset($_POST['interes_ptj']) <> '') { $interes_ptj = mysqli_real_escape_string($conectar, ($_POST['interes_ptj'])); } else { $interes_ptj = '0'; }
if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes_libre = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes_libre = '0'; }

/* ----------------------------------------------------------------------------------------------------------/ */
$sql_total_facturas = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura                     = $datos_total_facturas['cod_factura'];
$cod_tercero                     = $datos_total_facturas['cod_tercero'];
$cod_producto                    = $datos_total_facturas['cod_producto'];
$cod_producto_barra              = $datos_total_facturas['cod_producto_barra'];
$nombre_producto                 = $datos_total_facturas['nombre_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$formato                         = 'jpg';
$fecha_hora                      = date("H:i:s");
$fecha_ymd                       = date("Y-m-d");
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
$ruta_firma_orig                 = '../archivador/firma/original/';
$ruta_foto_orig                  = '../archivador/documentos/';

if ($nombre_tipo_cobro == 'DIARIO') { 
$tipo_cobro                     = 'day';
$numero_alerta                  = 0;
$numero_alerta_correcion        = 0;
} elseif ($nombre_tipo_cobro == 'SEMANAL') {
$tipo_cobro                     = 'week';
$numero_alerta                  = 0;
$numero_alerta_correcion        = 0;
} elseif ($nombre_tipo_cobro == 'QUINCENAL') {
$tipo_cobro                     = 'week';
$numero_alerta                  = 0;
$numero_alerta_correcion        = 0;
} elseif ($nombre_tipo_cobro == 'MES VENCIDO') {
$tipo_cobro                     = 'month';
$numero_alerta                  = 0;
$numero_alerta_correcion        = 0;
} elseif ($nombre_tipo_cobro == 'MES ANTICIPADO') {
$tipo_cobro                     = 'month';
$numero_alerta                  = 0;
$numero_alerta_correcion        = -1;
} else {
$tipo_cobro                     = 'year';
$numero_alerta                  = 0;
$numero_alerta_correcion        = 0;
}

if ($url_img1 <> '') { 
$formato_img2                    = explode(".", $url_img1);
$formato_img2                    = end($formato_img2);
$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'.'.$formato_img2;
$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
} else { 
$formato_img2                    = "";
$formato_img2                    = "";
$nombre_normal2                  = "";
$url_img_orig_producto           = "";
$url_img_min_producto            = "";
}
/* ----------------------------------------------------------------------------------------------------------/ */
$monto_deuda                    = ($monto_deuda_sin_interes + ($monto_deuda_sin_interes * ($interes_ptj/100))) * $numero_cuota;
$subtotal                       = $monto_deuda;	
$subtotal_sin_interes           = $monto_deuda_sin_interes;
$monto_cuota 	                = $monto_deuda_sin_interes_libre;
$monto_cuota_sin_interes 	    = $monto_deuda_sin_interes_libre;
$monto_cuota_interes            = ($monto_deuda_sin_interes_libre * ($interes_ptj/100));
/* ----------------------------------------------------------------------------------------------------------/ */
$fecha_seg       	            = time();
$fecha_mes	                    = date("Y-m", strtotime($fecha_pago));
$anyo		                    = date("Y", strtotime($fecha_pago));
$fecha	                        = $fecha_pago;
$fecha_invert	                = $fecha_pago;
$hora	                        = date("H:i:s");
$cuenta                         = $cuenta_actual;
$vendedor                       = $cuenta_actual;
$abonado                        = 0;
$cod_estado_inmueble            = 0;
$cod_estado                     = 0;
$cod_estado_contrato            = 0;
$monto_deuda_sin_interes        = ($monto_deuda_sin_interes + ($monto_deuda_sin_interes * ($interes_ptj/100))) * $numero_cuota;
$usuario_elim                   = $cuenta_actual;
/* ----------------------------------------------------------------------------------------------------------/ */
//$sql_max_cuenta_cobrar = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_cuentas_cobrar";
//$consulta_max_cuenta_cobrar = mysqli_query($conectar, $sql_max_cuenta_cobrar);
//$datos_max_cuenta_cobrar = mysqli_fetch_assoc($consulta_max_cuenta_cobrar);

//$cod_factura                     = $datos_max_cuenta_cobrar['cod_factura']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
//$sql_data = "UPDATE tbl15_producto SET cod_estado_inmueble = '$cod_estado_inmueble' WHERE cod_producto = '$cod_producto'";
//$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar SET monto_deuda_sin_interes = '$monto_deuda_sin_interes', numero_cuota = '$numero_cuota', monto_deuda = '$monto_deuda', 
subtotal = '$subtotal', subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota = '$monto_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes', monto_cuota_interes = '$monto_cuota_interes', 
fecha = '$fecha', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_invert = '$fecha_invert', fecha_seg = '$fecha_seg', abonado = '$abonado', cod_estado_contrato = '$cod_estado_contrato'
WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$query_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta);
while ($datos_cuentas_cobrar_alerta = mysqli_fetch_array($query_cuentas_cobrar_alerta)) {
	
$cod_cuentas_cobrar_alerta_cbk                = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar_cbk                       = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar'];
$cod_cuentas_cobrar_abonos_cbk                = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos'];
$numero_alerta_cbk                            = $datos_cuentas_cobrar_alerta['numero_alerta'];
$cod_factura_cbk                              = $datos_cuentas_cobrar_alerta['cod_factura'];
$cod_clientes_cbk                             = $datos_cuentas_cobrar_alerta['cod_clientes'];
$cod_tercero_cbk                              = $datos_cuentas_cobrar_alerta['cod_tercero'];
$cod_producto_cbk                             = $datos_cuentas_cobrar_alerta['cod_producto'];
$cod_producto_barra_cbk                       = $datos_cuentas_cobrar_alerta['cod_producto_barra'];
$nombre_producto_cbk                          = $datos_cuentas_cobrar_alerta['nombre_producto'];
$monto_deuda_cbk                              = $datos_cuentas_cobrar_alerta['monto_deuda'];
$monto_deuda_sin_interes_cbk                  = $datos_cuentas_cobrar_alerta['monto_deuda_sin_interes'];
$subtotal_cbk                                 = $datos_cuentas_cobrar_alerta['subtotal'];
$subtotal_sin_interes_cbk                     = $datos_cuentas_cobrar_alerta['subtotal_sin_interes'];
$numero_cuota_cbk                             = $datos_cuentas_cobrar_alerta['numero_cuota'];
$monto_cuota_cbk                              = $datos_cuentas_cobrar_alerta['monto_cuota'];
$monto_cuota_sin_interes_cbk                  = $datos_cuentas_cobrar_alerta['monto_cuota_sin_interes'];
$interes_ptj_cbk                              = $datos_cuentas_cobrar_alerta['interes_ptj'];
$monto_deuda_mas_interes_cbk                  = $datos_cuentas_cobrar_alerta['monto_deuda_mas_interes'];
$monto_cuota_interes_cbk                      = $datos_cuentas_cobrar_alerta['monto_cuota_interes'];
$nombre_tipo_cobro_cbk                        = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro'];
$descuento_cbk                                = $datos_cuentas_cobrar_alerta['descuento'];
$abonado_cbk                                  = $datos_cuentas_cobrar_alerta['abonado'];
$total_pagar_cbk                              = $datos_cuentas_cobrar_alerta['total_pagar'];
$mensaje_cbk                                  = $datos_cuentas_cobrar_alerta['mensaje'];
$vendedor_cbk                                 = $datos_cuentas_cobrar_alerta['vendedor'];
$cuenta_cbk                                   = $datos_cuentas_cobrar_alerta['cuenta'];
$deduccion_retefuente_cbk                     = $datos_cuentas_cobrar_alerta['deduccion_retefuente'];
$deduccion_reparacion_cbk                     = $datos_cuentas_cobrar_alerta['deduccion_reparacion'];
$deduccion_otro_impuesto_dian_cbk             = $datos_cuentas_cobrar_alerta['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida_cbk          = $datos_cuentas_cobrar_alerta['ingreso_administracion_incluida'];
$fecha_pago_cbk                               = $datos_cuentas_cobrar_alerta['fecha_pago'];
$fecha_cbk                                    = $datos_cuentas_cobrar_alerta['fecha'];
$fecha_mes_cbk                                = $datos_cuentas_cobrar_alerta['fecha_mes'];
$anyo_cbk                                     = $datos_cuentas_cobrar_alerta['anyo'];
$fecha_invert_cbk                             = $datos_cuentas_cobrar_alerta['fecha_invert'];
$fecha_seg_cbk                                = $datos_cuentas_cobrar_alerta['fecha_seg'];
$fecha_pago_reg_cbk                           = $datos_cuentas_cobrar_alerta['fecha_pago_reg'];
$hora_pago_reg_cbk                            = $datos_cuentas_cobrar_alerta['hora_pago_reg'];
$fecha_creacion_cbk                           = $datos_cuentas_cobrar_alerta['fecha_creacion'];
$cod_info_factura_venta_cbk                   = $datos_cuentas_cobrar_alerta['cod_info_factura_venta'];
$url_img_orig_producto_cbk                    = $datos_cuentas_cobrar_alerta['url_img_orig_producto'];
$url_img_min_producto_cbk                     = $datos_cuentas_cobrar_alerta['url_img_min_producto'];
$cod_tipo_calificacion_cbk                    = $datos_cuentas_cobrar_alerta['cod_tipo_calificacion'];
$nombre_tipo_calificacion_cbk                 = $datos_cuentas_cobrar_alerta['nombre_tipo_calificacion'];
$cod_administrador_cbk                        = $datos_cuentas_cobrar_alerta['cod_administrador'];
$cod_estado_cbk                               = $datos_cuentas_cobrar_alerta['cod_estado'];
$cod_estado_contrato_cbk                      = $datos_cuentas_cobrar_alerta['cod_estado_contrato'];
$cod_tipo_moneda_cbk                          = $datos_cuentas_cobrar_alerta['cod_tipo_moneda'];

$deduccion_servicio_cbk                       = $datos_cuentas_cobrar_alerta['deduccion_servicio'];
$deduccion_otro_concepto_cbk                  = $datos_cuentas_cobrar_alerta['deduccion_otro_concepto'];
$ingreso_otro_concepto_cbk                    = $datos_cuentas_cobrar_alerta['ingreso_otro_concepto'];

$sql_insetar = "INSERT INTO tbl15_cuentas_cobrar_alerta_copia (cod_cuentas_cobrar_alerta, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, numero_alerta, 
cod_factura, cod_clientes, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, 
subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, 
nombre_tipo_cobro, descuento, abonado, total_pagar, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion,
deduccion_otro_impuesto_dian, ingreso_administracion_incluida, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, fecha_pago_reg, 
hora_pago_reg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, 
cod_administrador, cod_estado, cod_estado_contrato, cod_tipo_moneda, usuario_elim, deduccion_servicio, deduccion_otro_concepto, ingreso_otro_concepto) 
VALUES ('$cod_cuentas_cobrar_alerta_cbk', '$cod_cuentas_cobrar_cbk', '$cod_cuentas_cobrar_abonos_cbk', '$numero_alerta_cbk', 
'$cod_factura_cbk', '$cod_clientes_cbk', '$cod_tercero_cbk', '$cod_producto_cbk', '$cod_producto_barra_cbk', '$nombre_producto_cbk', '$monto_deuda_cbk', '$monto_deuda_sin_interes_cbk', 
'$subtotal_cbk', '$subtotal_sin_interes_cbk', '$numero_cuota_cbk', '$monto_cuota_cbk', '$monto_cuota_sin_interes_cbk', '$interes_ptj_cbk', '$monto_deuda_mas_interes_cbk', '$monto_cuota_interes_cbk', 
'$nombre_tipo_cobro_cbk', '$descuento_cbk', '$abonado_cbk', '$total_pagar_cbk', '$mensaje_cbk', '$vendedor_cbk', '$cuenta_cbk', '$deduccion_retefuente_cbk', '$deduccion_reparacion_cbk',
'$deduccion_otro_impuesto_dian_cbk', '$ingreso_administracion_incluida_cbk', '$fecha_pago_cbk', '$fecha_cbk', '$fecha_mes_cbk', '$anyo_cbk', '$fecha_invert_cbk', '$fecha_seg_cbk', '$fecha_pago_reg_cbk', 
'$hora_pago_reg_cbk', '$fecha_creacion_cbk', '$cod_info_factura_venta_cbk', '$url_img_orig_producto_cbk', '$url_img_min_producto_cbk', '$cod_tipo_calificacion_cbk', '$nombre_tipo_calificacion_cbk', 
'$cod_administrador_cbk', '$cod_estado_cbk', '$cod_estado_contrato_cbk', '$cod_tipo_moneda_cbk', '$usuario_elim', '$deduccion_servicio_cbk', '$deduccion_otro_concepto_cbk', '$ingreso_otro_concepto_cbk')";
$resultado_alerta = mysqli_query($conectar, $sql_insetar) or die(mysqli_error($conectar));
}
/* ----------------------------------------------------------------------------------------------------------/ */
$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$query_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos);
while ($datos_cuentas_cobrar_abonos = mysqli_fetch_array($query_cuentas_cobrar_abonos)) {
	
$cod_cuentas_cobrar_abonos_cbk                = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos'];
$cod_cuentas_cobrar_cbk                       = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar'];
$cod_factura_cbk                              = $datos_cuentas_cobrar_abonos['cod_factura'];
$cod_clientes_cbk                             = $datos_cuentas_cobrar_abonos['cod_clientes'];
$cod_tercero_cbk                              = $datos_cuentas_cobrar_abonos['cod_tercero'];
$cod_producto_cbk                             = $datos_cuentas_cobrar_abonos['cod_producto'];
$cod_producto_barra_cbk                       = $datos_cuentas_cobrar_abonos['cod_producto_barra'];
$nombre_producto_cbk                          = $datos_cuentas_cobrar_abonos['nombre_producto'];
$monto_deuda_cbk                              = $datos_cuentas_cobrar_abonos['monto_deuda'];
$subtotal_cbk                                 = $datos_cuentas_cobrar_abonos['subtotal'];
$descuento_cbk                                = $datos_cuentas_cobrar_abonos['descuento'];
$abonado_cbk                                  = $datos_cuentas_cobrar_abonos['abonado'];
$total_pagar_cbk                              = $datos_cuentas_cobrar_abonos['total_pagar'];
$monto_deuda_sin_interes_cbk                  = $datos_cuentas_cobrar_abonos['monto_deuda_sin_interes'];
$subtotal_sin_interes_cbk                     = $datos_cuentas_cobrar_abonos['subtotal_sin_interes'];
$monto_cuota_sin_interes_cbk                  = $datos_cuentas_cobrar_abonos['monto_cuota_sin_interes'];
$interes_ptj_cbk                              = $datos_cuentas_cobrar_abonos['interes_ptj'];
$monto_deuda_mas_interes_cbk                  = $datos_cuentas_cobrar_abonos['monto_deuda_mas_interes'];
$monto_cuota_interes_cbk                      = $datos_cuentas_cobrar_abonos['monto_cuota_interes'];
$mensaje_cbk                                  = $datos_cuentas_cobrar_abonos['mensaje'];
$cod_administrador_cbk                        = $datos_cuentas_cobrar_abonos['cod_administrador'];
$vendedor_cbk                                 = $datos_cuentas_cobrar_abonos['vendedor'];
$cuenta_cbk                                   = $datos_cuentas_cobrar_abonos['cuenta'];
$deduccion_retefuente_cbk                     = $datos_cuentas_cobrar_abonos['deduccion_retefuente'];
$deduccion_reparacion_cbk                     = $datos_cuentas_cobrar_abonos['deduccion_reparacion'];
$deduccion_otro_impuesto_dian_cbk             = $datos_cuentas_cobrar_abonos['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida_cbk          = $datos_cuentas_cobrar_abonos['ingreso_administracion_incluida'];
$cod_abono_global_cbk                         = $datos_cuentas_cobrar_abonos['cod_abono_global'];
$fecha_pago_cbk                               = $datos_cuentas_cobrar_abonos['fecha_pago'];
$fecha_anyo_cbk                               = $datos_cuentas_cobrar_abonos['fecha_anyo'];
$fecha_mes_cbk                                = $datos_cuentas_cobrar_abonos['fecha_mes'];
$anyo_cbk                                     = $datos_cuentas_cobrar_abonos['anyo'];
$fecha_invert_cbk                             = $datos_cuentas_cobrar_abonos['fecha_invert'];
$fecha_seg_cbk                                = $datos_cuentas_cobrar_abonos['fecha_seg'];
$hora_cbk                                     = $datos_cuentas_cobrar_abonos['hora'];
$fecha_pago_deuda_cbk                         = $datos_cuentas_cobrar_abonos['fecha_pago_deuda'];
$fecha_pago_reg_cbk                           = $datos_cuentas_cobrar_abonos['fecha_pago_reg'];
$hora_pago_reg_cbk                            = $datos_cuentas_cobrar_abonos['hora_pago_reg'];
$fecha_creacion_cbk                           = $datos_cuentas_cobrar_abonos['fecha_creacion'];
$cod_info_factura_venta_cbk                   = $datos_cuentas_cobrar_abonos['cod_info_factura_venta'];
$cod_estado_cbk                               = $datos_cuentas_cobrar_abonos['cod_estado'];
$cod_estado_contrato_cbk                      = $datos_cuentas_cobrar_abonos['cod_estado_contrato'];
$cod_tipo_forma_pago_cbk                      = $datos_cuentas_cobrar_abonos['cod_tipo_forma_pago'];
$cod_cuentas_cobrar_alerta_cbk                = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta'];
$numero_alerta_cbk                            = $datos_cuentas_cobrar_abonos['numero_alerta'];
$url_img_orig_producto_cbk                    = $datos_cuentas_cobrar_abonos['url_img_orig_producto'];
$url_img_min_producto_cbk                     = $datos_cuentas_cobrar_abonos['url_img_min_producto'];
$cod_tipo_calificacion_cbk                    = $datos_cuentas_cobrar_abonos['cod_tipo_calificacion'];
$nombre_tipo_calificacion_cbk                 = $datos_cuentas_cobrar_abonos['nombre_tipo_calificacion'];
$cod_dependencia_cbk                          = $datos_cuentas_cobrar_abonos['cod_dependencia'];
$cod_tipo_moneda_cbk                          = $datos_cuentas_cobrar_abonos['cod_tipo_moneda'];

$deduccion_servicio_cbk                       = $datos_cuentas_cobrar_abonos['deduccion_servicio'];
$deduccion_otro_concepto_cbk                  = $datos_cuentas_cobrar_abonos['deduccion_otro_concepto'];
$ingreso_otro_concepto_cbk                    = $datos_cuentas_cobrar_abonos['ingreso_otro_concepto'];


$sql_insetar = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, 
cod_tercero, cod_producto, cod_producto_barra, nombre_producto, monto_deuda, subtotal, descuento, abonado, 
total_pagar, monto_deuda_sin_interes, subtotal_sin_interes, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, mensaje, 
cod_administrador, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_otro_impuesto_dian, ingreso_administracion_incluida, cod_abono_global, 
fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_pago_deuda, fecha_pago_reg, hora_pago_reg, 
fecha_creacion, cod_info_factura_venta, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, numero_alerta, 
url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia, cod_tipo_moneda, usuario_elim, 
deduccion_servicio, deduccion_otro_concepto, ingreso_otro_concepto) 
VALUES ('$cod_cuentas_cobrar_abonos_cbk', '$cod_cuentas_cobrar_cbk', '$cod_factura_cbk', '$cod_clientes_cbk', 
'$cod_tercero_cbk', '$cod_producto_cbk', '$cod_producto_barra_cbk', '$nombre_producto_cbk', '$monto_deuda_cbk', '$subtotal_cbk', '$descuento_cbk', '$abonado_cbk', 
'$total_pagar_cbk', '$monto_deuda_sin_interes_cbk', '$subtotal_sin_interes_cbk', '$monto_cuota_sin_interes_cbk', '$interes_ptj_cbk', '$monto_deuda_mas_interes_cbk', '$monto_cuota_interes_cbk', '$mensaje_cbk', 
'$cod_administrador_cbk', '$vendedor_cbk', '$cuenta_cbk', '$deduccion_retefuente_cbk', '$deduccion_servicio_cbk', '$deduccion_otro_impuesto_dian_cbk', '$ingreso_administracion_incluida_cbk', '$cod_abono_global_cbk', 
'$fecha_pago_cbk', '$fecha_anyo_cbk', '$fecha_mes_cbk', '$anyo_cbk', '$fecha_invert_cbk', '$fecha_seg_cbk', '$hora_cbk', '$fecha_pago_deuda_cbk', '$fecha_pago_reg_cbk', '$hora_pago_reg_cbk', 
'$fecha_creacion_cbk', '$cod_info_factura_venta_cbk', '$cod_estado_cbk', '$cod_estado_contrato_cbk', '$cod_tipo_forma_pago_cbk', '$cod_cuentas_cobrar_alerta_cbk', '$numero_alerta_cbk', 
'$url_img_orig_producto_cbk', '$url_img_min_producto_cbk', '$cod_tipo_calificacion_cbk', '$nombre_tipo_calificacion_cbk', '$cod_dependencia_cbk', '$cod_tipo_moneda_cbk', '$usuario_elim', 
'$deduccion_servicio_cbk', '$deduccion_otro_concepto_cbk', '$ingreso_otro_concepto_cbk')";
$resultado_alerta = mysqli_query($conectar, $sql_insetar) or die(mysqli_error($conectar));
}
/* ----------------------------------------------------------------------------------------------------------/ */
$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$monto_deuda_sin_interes        = ($monto_deuda_sin_interes_libre + ($monto_deuda_sin_interes_libre * ($interes_ptj/100)));
$monto_deuda                    = ($monto_deuda_sin_interes_libre + ($monto_deuda_sin_interes_libre * ($interes_ptj/100)));
$subtotal                       = $monto_deuda;	
$subtotal_sin_interes           = $monto_deuda;
$monto_cuota 	                = $monto_deuda;
$monto_cuota_sin_interes 	    = $monto_deuda;
$monto_cuota_interes            = ($monto_deuda * ($interes_ptj/100));
/* ----------------------------------------------------------------------------------------------------------/ */
for ($i=0; $i < $numero_cuota; $i++) {
$numero_alerta++;
$numero_alerta_correcion++;

//if ($numero_alerta == $numero_cuota) {
//$fecha_pago_alerta_normal       = date('Y-m-d', strtotime($fecha_pago.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
//$fecha_pago_alerta              = date('Y-m-d', strtotime($fecha_pago_alerta_normal.'-1'.' day'));
//$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta_normal));
//$anyo	                        = date("Y", strtotime($fecha_pago_alerta_normal));
//} else { }
$fecha_pago_alerta              = date('Y-m-d', strtotime($fecha_pago.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
$anyo	                        = date("Y", strtotime($fecha_pago_alerta));

$agreg_alerta = "INSERT INTO tbl15_cuentas_cobrar_alerta (cod_cuentas_cobrar, numero_alerta, cod_tercero, monto_deuda_sin_interes, 
numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, 
monto_cuota_interes, vendedor, cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, abonado, cod_factura, cod_administrador, cod_tipo_moneda, 
cod_producto, cod_producto_barra, nombre_producto, cod_estado) 
VALUES ('$cod_cuentas_cobrar', '$numero_alerta', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', 
'$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago_alerta', '$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', 
'$monto_cuota_interes', '$vendedor', '$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$abonado', '$cod_factura', '$cod_administrador', '$cod_tipo_moneda', 
'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$cod_estado')";
$resultado_alerta = mysqli_query($conectar, $agreg_alerta) or die(mysqli_error($conectar));
}
//if ($url_img1 <> '') { 
//copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
//}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina_else ?>">
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