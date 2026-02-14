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
$cod_administrador                  = ($_SESSION['cod_administrador']);
$pagina_else                        = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

if (isset($_POST['cod_concepto_movimiento_caja']) <> '') { $cod_concepto_movimiento_caja = intval($_POST['cod_concepto_movimiento_caja']); } else { $cod_concepto_movimiento_caja = ''; }
if (isset($_POST['costo']) <> '') { $costo = mysqli_real_escape_string($conectar, ($_POST['costo'])); } else { $costo = ''; }
if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
if (isset($_POST['comentario']) <> '') { $comentario = mysqli_real_escape_string($conectar, ($_POST['comentario'])); } else { $comentario = ''; }
if (isset($_POST['codigo_puc']) <> '') { $codigo_puc = mysqli_real_escape_string($conectar, ($_POST['codigo_puc'])); } else { $codigo_puc = ''; }
if (isset($_POST['nombre_puc']) <> '') { $nombre_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_puc'])); } else { $nombre_puc = ''; }
if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = ''; }
if (isset($_POST['nombre_ccosto']) <> '') { $nombre_ccosto = mysqli_real_escape_string($conectar, ($_POST['nombre_ccosto'])); } else { $nombre_ccosto = ''; }
if (isset($_POST['fecha_dmy']) <> '') { $fecha_dmy = mysqli_real_escape_string($conectar, ($_POST['fecha_dmy'])); } else { $fecha_dmy = ''; }
if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = mysqli_real_escape_string($conectar, ($_POST['cod_tipo_forma_pago'])); } else { $cod_tipo_forma_pago = ''; }
if (isset($_POST['cod_cuentas_pagar']) <> '') { $cod_cuentas_pagar = intval($_POST['cod_cuentas_pagar']); } else { $cod_cuentas_pagar = '0'; }
if (isset($_POST['nombre_cuenta_pagar']) <> '') { $nombre_cuenta_pagar = mysqli_real_escape_string($conectar, ($_POST['nombre_cuenta_pagar'])); } else { $nombre_cuenta_pagar = ''; }
if (isset($_POST['nombre_tipo_puc']) <> '') { $nombre_tipo_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_puc'])); } else { $nombre_tipo_puc = ''; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
//-------------------------------------- -----------------------------------------------------------------//
if (($nombre_cuenta_pagar <> '') && ($cod_cuentas_pagar <> '0')) { $nombre_tipo_cuenta_cobrar_pagar = 'CUENTA_PAGAR'; } else { $nombre_tipo_cuenta_cobrar_pagar    = ''; }
//-------------------------------------- -----------------------------------------------------------------//
$sql_info_factura = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$nombre_concepto_movimiento_caja                    = $info_info_factura['nombre_concepto_movimiento_caja'];
$nombre_tipo_puc                                    = $info_info_factura['nombre_tipo_puc'];
$simbolo_tipo_operacion                             = $info_info_factura['simbolo_tipo_operacion'];

$fecha_time     	                                = time();
$fecha_mes_ym	                                    = date("Y-m", strtotime($fecha_dmy));
$anyo		                                        = date("Y", strtotime($fecha_dmy));
$hora	                                            = date("H:i:s");
$cuenta                                             = $cuenta_actual;

$time                                               = time();
$fecha_ymdHis                                       = date("YmdHis");
$formato                                            = 'jpg';
$fecha_hora                                         = date("H:i:s");
$fecha_ymd                                          = date("Y-m-d");

$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
$ruta_firma_orig                                    = '../archivador/firma/original/';
$ruta_foto_orig                                     = '../archivador/documentos/';
//-------------------------------------- -----------------------------------------------------------------//
$sql_movimiento_caja = "SELECT total_compra_producto, total_venta_producto, total_saldo, fecha_ymd_movimiento_caja FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '1')";
$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
$datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

$total_compra_producto                 = $datos_movimiento_caja['total_compra_producto'];
$total_venta_producto                  = $datos_movimiento_caja['total_venta_producto'];
$total_saldo                           = $datos_movimiento_caja['total_saldo'];
$fecha_ymd_movimiento_caja             = $datos_movimiento_caja['fecha_ymd_movimiento_caja'];
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
if ($nombre_tipo_puc == 'INGRESO') {
$total_saldo_final                     = $total_saldo + $costo;
} else {
$total_saldo_final                     = $total_saldo - $costo;
}
//-------------------------------------- -----------------------------------------------------------------//
$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_egreso'";
$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);
$cod_egreso = $datos_autoincremento_egresos['AUTO_INCREMENT'];
//-------------------------------------- -----------------------------------------------------------------//
if ($url_img1 <> '') { 
$formato_img2                                       = explode(".", $url_img1);
$formato_img2                                       = end($formato_img2);
$nombre_normal2                                     = $fecha_ymdHis.'_'.$nombre_tipo_puc.'_'.$cod_egreso.'.'.$formato_img2;
$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
$url_img_min_producto                               = $ruta_foto_orig.$nombre_normal2;
} else { 
$formato_img2                                       = "";
$formato_img2                                       = "";
$nombre_normal2                                     = "";
$url_img_orig_producto                              = "";
$url_img_min_producto                               = "";
}
//-------------------------------------- -----------------------------------------------------------------//
$agreg = "INSERT INTO tbl15_egreso (cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, nombre_tipo_puc, simbolo_tipo_operacion, 
costo, cod_tercero, comentario, codigo_puc, nombre_puc, cod_dependencia, total_compra_producto, total_venta_producto, total_saldo, 
cod_tipo_forma_pago, fecha_dmy, fecha_time, fecha_mes_ym, anyo, hora, cuenta, nombre_ccosto, fecha_ymd_movimiento_caja, 
cod_cuentas_pagar, nombre_cuenta_pagar, nombre_tipo_cuenta_cobrar_pagar, url_img_orig_producto, url_img_min_producto) 
VALUES ('$cod_concepto_movimiento_caja', '$nombre_concepto_movimiento_caja', '$nombre_tipo_puc', '$simbolo_tipo_operacion', 
'$costo', '$cod_tercero', '$comentario', '$codigo_puc', '$nombre_puc', '$cod_dependencia', '$total_compra_producto', '$total_venta_producto', '$total_saldo',  
'$cod_tipo_forma_pago', '$fecha_dmy', '$fecha_time', '$fecha_mes_ym', '$anyo', '$hora', '$cuenta', '$nombre_ccosto', '$fecha_ymd_movimiento_caja', 
'$cod_cuentas_pagar', '$nombre_cuenta_pagar', '$nombre_tipo_cuenta_cobrar_pagar', '$url_img_orig_producto', '$url_img_min_producto')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

$agregar_regis = sprintf("UPDATE tbl15_movimiento_caja SET total_saldo = '$total_saldo_final' WHERE cod_movimiento_caja = '1'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//

if (($nombre_cuenta_pagar <> '') && ($cod_cuentas_pagar <> '0')) {

	$nombre_tipo_cuenta_cobrar_pagar = 'CUENTA_PAGAR';
	$abonado                         = $costo;
	$mensaje                         = $comentario.' | MOV CAJA';
	$fecha_pago                      = $fecha_dmy;

	$fecha_anyo                      = date("Y-m-d", strtotime($fecha_pago));
	$fecha_mes                       = date("Y-m", strtotime($fecha_pago));
	$anyo                            = date("Y", strtotime($fecha_pago));
	$fecha_invert                    = date("Y-m-d", strtotime($fecha_pago));
	$fecha_seg                       = strtotime($fecha_pago);
	$hora                            = date("H:i:s");

	$sql_autoincremento_cuentas_pagar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar_abonos'";
	$exec_autoincremento_cuentas_pagar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_pagar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_pagar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_pagar_abonos);

	$cod_cuentas_pagar_abonos        = $datos_autoincremento_cuentas_pagar_abonos['AUTO_INCREMENT'];

	$sql_info_cuentas_pagar = "SELECT * FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
	$resultado_info_cuentas_pagar = mysqli_query($conectar, $sql_info_cuentas_pagar) or die(mysqli_error($conectar));
	$info_info_cuentas_pagar = mysqli_fetch_assoc($resultado_info_cuentas_pagar);

	$cod_factura                      = $info_info_cuentas_pagar['cod_factura'];
	$cod_tercero                      = $info_info_cuentas_pagar['cod_tercero'];
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$agregar_reg_cuentas_pagar_abonos = "INSERT INTO tbl15_cuentas_pagar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
	anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_cuentas_pagar) 
	VALUES ('$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', 
	'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_cuentas_pagar')";
	$resultado_cuentas_pagar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_pagar_abonos) or die(mysqli_error($conectar));
	//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$sql_cuenta_pagar_factura = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'";
	$consulta_cuenta_pagar_factura = mysqli_query($conectar, $sql_cuenta_pagar_factura) or die(mysqli_error($conectar));
	$dato_cuenta_pagar_factura = mysqli_fetch_assoc($consulta_cuenta_pagar_factura);

	$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_pagar_abonos WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'";
	$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
	$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

	$monto_deuda             = $dato_cuenta_pagar_factura['monto_deuda'];
	$abonado_total           = $total_abono_factura['abonado'];
	$subtotal                = $monto_deuda - $abonado_total;

	$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_pagar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/opcion_imprimir_egreso_ingreso_movimiento_caja_inmobiliaria.php?cod_egreso=<?php echo $cod_egreso ?>&cod_dependencia=<?php echo $cod_dependencia ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina_else ?>">
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