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

if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes = '0'; }
if (isset($_POST['numero_cuota']) <> '') { $numero_cuota = intval($_POST['numero_cuota']); } else { $numero_cuota = ''; }
if (isset($_POST['interes_ptj']) <> '') { $interes_ptj = mysqli_real_escape_string($conectar, ($_POST['interes_ptj'])); } else { $interes_ptj = '0'; }
if (isset($_POST['nombre_tipo_cobro']) <> '') { $nombre_tipo_cobro = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cobro'])); } else { $nombre_tipo_cobro = ''; }
if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = ''; }
if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = intval($_POST['cod_administrador']); } else { $cod_administrador = ''; }
if (isset($_POST['cod_tipo_moneda']) <> '') { $cod_tipo_moneda = intval($_POST['cod_tipo_moneda']); } else { $cod_tipo_moneda = ''; }
if (isset($_POST['clausula_alquiler']) <> '') { $clausula_alquiler = mysqli_real_escape_string($conectar, ($_POST['clausula_alquiler'])); } else { $clausula_alquiler = ''; }

if (isset($_POST['cod_producto']) <> '') { $cod_producto = intval($_POST['cod_producto']); } else { $cod_producto = ''; }
if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar, ($_POST['cod_producto_barra'])); } else { $cod_producto_barra = ''; }
if (isset($_POST['nombre_producto']) <> '') { $nombre_producto = mysqli_real_escape_string($conectar, ($_POST['nombre_producto'])); } else { $nombre_producto = ''; }
if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes_libre = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes_libre = '0'; }
if (isset($_POST['mensaje']) <> '') { $mensaje = mysqli_real_escape_string($conectar, ($_POST['mensaje'])); } else { $mensaje = ''; }
if (isset($_POST['cod_factura']) <> '') { $cod_factura = intval($_POST['cod_factura']); } else { $cod_factura = ''; }

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
/* ----------------------------------------------------------------------------------------------------------/ */
//$sql_max_cuenta_cobrar = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_cuentas_cobrar";
//$consulta_max_cuenta_cobrar = mysqli_query($conectar, $sql_max_cuenta_cobrar);
//$datos_max_cuenta_cobrar = mysqli_fetch_assoc($consulta_max_cuenta_cobrar);

//$cod_factura                     = $datos_max_cuenta_cobrar['cod_factura']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "UPDATE tbl15_producto SET cod_estado_inmueble = '$cod_estado_inmueble' WHERE cod_producto = '$cod_producto'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$agreg = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_tercero, monto_deuda_sin_interes, numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, 
monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, monto_cuota_interes, vendedor, 
cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, abonado, cod_factura, cod_tipo_forma_pago, mensaje, url_img_orig_producto, 
url_img_min_producto, cod_administrador, cod_tipo_moneda, clausula_alquiler, cod_producto, cod_producto_barra, nombre_producto, cod_estado_contrato) 
VALUES ('$cod_cuentas_cobrar', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', '$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago', 
'$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', '$monto_cuota_interes', '$vendedor', 
'$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$abonado', '$cod_factura', '$cod_tipo_forma_pago', '$mensaje', '$url_img_orig_producto', 
'$url_img_min_producto', '$cod_administrador', '$cod_tipo_moneda', '$clausula_alquiler', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$cod_estado_contrato')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

$monto_deuda_sin_interes        = ($monto_deuda_sin_interes_libre + ($monto_deuda_sin_interes_libre * ($interes_ptj/100)));
$monto_deuda                    = ($monto_deuda_sin_interes_libre + ($monto_deuda_sin_interes_libre * ($interes_ptj/100)));
$subtotal                       = $monto_deuda;	
$subtotal_sin_interes           = $monto_deuda;
$monto_cuota 	                = $monto_deuda;
$monto_cuota_sin_interes 	    = $monto_deuda;
$monto_cuota_interes            = ($monto_deuda * ($interes_ptj/100));
/* ----------------------------------------------------------------------------------------------------------/ */
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
	} else { 
		$fecha_pago_alerta              = $fecha_mes_real.'-'.$dia_corte_pago;
		$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
		$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
	}

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
if ($url_img1 <> '') { 
copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
}
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