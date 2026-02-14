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

if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
if (isset($_POST['monto_deuda_sin_interes']) <> '') { $monto_deuda_sin_interes = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes'])); } else { $monto_deuda_sin_interes = ''; }
if (isset($_POST['numero_cuota']) <> '') { $numero_cuota = intval($_POST['numero_cuota']); } else { $numero_cuota = ''; }
if (isset($_POST['interes_ptj']) <> '') { $interes_ptj = mysqli_real_escape_string($conectar, ($_POST['interes_ptj'])); } else { $interes_ptj = ''; }
if (isset($_POST['nombre_tipo_cobro']) <> '') { $nombre_tipo_cobro = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cobro'])); } else { $nombre_tipo_cobro = ''; }
if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = ''; }
if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = intval($_POST['cod_administrador']); } else { $cod_administrador = ''; }
if (isset($_POST['mensaje']) <> '') { $mensaje = mysqli_real_escape_string($conectar, ($_POST['mensaje'])); } else { $mensaje = ''; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);
$cod_cuentas_cobrar = $datos_autoincremento_egresos['AUTO_INCREMENT'];

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
$tipo_cobro = 'day';
} elseif ($nombre_tipo_cobro == 'SEMANAL') {
$tipo_cobro = 'week';
} elseif ($nombre_tipo_cobro == 'QUINCENAL') {
$tipo_cobro = 'week';
} elseif ($nombre_tipo_cobro == 'MENSUAL') {
$tipo_cobro = 'month';
} else {
$tipo_cobro = 'year';
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
$monto_deuda                    = $monto_deuda_sin_interes + ($monto_deuda_sin_interes * ($interes_ptj/100));
$subtotal                       = $monto_deuda;	
$subtotal_sin_interes           = $monto_deuda_sin_interes;
$monto_cuota 	                = $monto_deuda / $numero_cuota;
$monto_cuota_sin_interes 	    = $monto_deuda_sin_interes / $numero_cuota;
$monto_cuota_interes            = ($monto_deuda_sin_interes * ($interes_ptj/100));
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
$numero_alerta                  = 0;

$sql_max_cuenta_cobrar = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_cuentas_cobrar";
$consulta_max_cuenta_cobrar = mysqli_query($conectar, $sql_max_cuenta_cobrar);
$datos_max_cuenta_cobrar = mysqli_fetch_assoc($consulta_max_cuenta_cobrar);

$cod_factura                     = $datos_max_cuenta_cobrar['cod_factura']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
$agreg = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_tercero, monto_deuda_sin_interes, numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, 
monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, monto_cuota_interes, vendedor, 
cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, abonado, cod_factura, cod_tipo_forma_pago, mensaje, url_img_orig_producto, 
url_img_min_producto, cod_administrador) 
VALUES ('$cod_cuentas_cobrar', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', '$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago', 
'$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', '$monto_cuota_interes', '$vendedor', 
'$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$abonado', '$cod_factura', '$cod_tipo_forma_pago', '$mensaje', '$url_img_orig_producto', 
'$url_img_min_producto', '$cod_administrador')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

for ($i=0; $i < $numero_cuota; $i++) {
$numero_alerta++;

$fecha_pago_alerta = date('Y-m-d', strtotime($fecha_pago.'+'.$numero_alerta.' '.$tipo_cobro));

$agreg_alerta = "INSERT INTO tbl15_cuentas_cobrar_alerta (cod_cuentas_cobrar, numero_alerta, cod_tercero, monto_deuda_sin_interes, 
numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, 
monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, monto_cuota_interes, vendedor, 
cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, abonado, cod_factura, cod_administrador) 
VALUES ('$cod_cuentas_cobrar', '$numero_alerta', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', 
'$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago_alerta', 
'$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', '$monto_cuota_interes', '$vendedor', 
'$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$abonado', '$cod_factura', '$cod_administrador')";
$resultado_alerta = mysqli_query($conectar, $agreg_alerta) or die(mysqli_error($conectar));
}
if ($url_img1 <> '') { 
copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_detalle_factura_prestamo.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_else ?>">
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