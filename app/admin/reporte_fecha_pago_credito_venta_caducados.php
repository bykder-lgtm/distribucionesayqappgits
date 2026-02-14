<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Fecha de Pago Creditos</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$seleccionado                            = 0;
$pagina                                  = $_SERVER['PHP_SELF'];
$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
$fecha_pago_ini                          = date("Y-m-d");
?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="../admin/reporte_fecha_pago_credito_venta_caducados.php">Reporte Pagos Vencidos</a></th>
<th style="text-align:center;"><a href="../admin/reporte_fecha_pago_credito_venta_a_caducar.php">Reporte Pagos a Vencer</a></th>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center;"><a href="#"></a></th>
<th style="text-align:center;"><a href="#">Factura</a></th>
<th style="text-align:center;"><a href="#">Cliente</a></th>
<th style="text-align:center;"><a href="#">Telefono</a></th>
<th style="text-align:center;"><a href="#">Correo</a></th>
<th style="text-align:center;"><a href="#">Feha Registro</a></th>
<th style="text-align:center;"><a href="#">Mensaje</a></th>
<th style="text-align:center;"><a href="#">Feha Pago</a></th>
<th style="text-align:center;"><a href="#">Total Venta</a></th>
<th style="text-align:center;"><a href="#">abonado</a></th>
<th style="text-align:center;"><a href="#">Pendiente</a></th>
<th style="text-align:center;"><a href="#">Ver</a></th>
</tr>
</thead>
<tbody>
<?php
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
$anyo_actual                             = date("Y");
$fecha_actual                            = date("Y-m-d");
$concat_observ                           = "";
$fecha_hoy                               = date("Y-m-d");

$sql_cliente = "SELECT * FROM tbl15_info_factura_venta WHERE (fecha_pago < '$fecha_hoy') AND (nombre_estado_factura = 'CERRADA') AND (cod_tipo_pago = '2') AND (subtotal <> '0') ORDER BY fecha_pago ASC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_info_factura_venta                  = $info_cliente['cod_info_factura_venta'];
$cod_factura                             = $info_cliente['cod_factura'];
$cod_tercero                             = $info_cliente['cod_tercero'];
$vlr_cancelado                           = $info_cliente['vlr_cancelado'];
$vlr_vuelto                              = $info_cliente['vlr_vuelto'];
$fecha_anyo                              = $info_cliente['fecha_anyo'];
$fecha_hora                              = $info_cliente['fecha_hora'];
$cod_tipo_pago                           = $info_cliente['cod_tipo_pago'];
$cod_administrador                       = $info_cliente['cod_administrador'];
$total_precio_compra                     = $info_cliente['total_precio_compra'];
$total_precio_venta                      = $info_cliente['total_precio_venta'];
$cod_dependencia                         = $info_cliente['cod_dependencia'];
$cod_tipo_forma_pago                     = $info_cliente['cod_tipo_forma_pago'];
$nombre_tipo_factura                     = $info_cliente['nombre_tipo_factura'];
$nombre_tipo_moneda                      = $info_cliente['nombre_tipo_moneda'];
$total_datos_data                        = $info_cliente['total_datos_data'];
$observacion_tercero                     = $info_cliente['observacion_tercero'];
$cod_base_caja                           = $info_cliente['cod_base_caja'];
$cod_estado_cava                         = $info_cliente['cod_estado_cava'];
$cod_cuentas_cobrar                      = $info_cliente['cod_cuentas_cobrar'];
$fecha_pago                              = $info_cliente['fecha_pago'];

$dias_seg                                = (strtotime($fecha_hoy)-strtotime($fecha_pago))/86400;
$dias_abs                                = abs($dias_seg); 
$dias                                    = floor($dias_abs);

if ($dias_seg > 0) { $mensaje_dias_cumple = "LA FECHA DE PAGO VENCIO HACE ".$dias." DIAS"; } elseif ($dias_seg < 0) { $mensaje_dias_cumple = "LA FECHA DE PAGO VENCIO HACE ".$dias." DIAS"; } else { $mensaje_dias_cumple = "VENCIO HOY"; }

$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero, direccion_tercero, telefono1_tercero, correo_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_tercero                          = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];
$direccion_tercero                       = $datos_dependencia['direccion_tercero'];
$telefono1_tercero                       = $datos_dependencia['telefono1_tercero'];
$correo_tercero                          = $datos_dependencia['correo_tercero'];

$sql_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$resultado_cuenta_cobrar = mysqli_query($conectar, $sql_cuenta_cobrar) or die(mysqli_error($conectar));
$matriz_cuenta_cobrar = mysqli_fetch_assoc($resultado_cuenta_cobrar);

$monto_deuda                         = $matriz_cuenta_cobrar['monto_deuda'];
$subtotal                            = $matriz_cuenta_cobrar['subtotal'];
$abonado                             = $matriz_cuenta_cobrar['abonado'];

if ($telefono1_tercero <> '') {
	$url_redir_whatapp = '<br><a href="https://api.whatsapp.com/send?phone=57'.$telefono1_tercero.'&text=Hola%20'.$nombre_tercero.'" target="_blank"><img src="../imagenes/btn_tel_whatapp_peq.png"></a> | ';
	$url_redir_telefono = '<a href="tel:57'.$telefono1_tercero.'" target="_blank"><img src="../imagenes/btn_tel_telefono_peq.png"></a>';
} else {
	$url_redir_whatapp = '';
	$url_redir_telefono = '';
}
?>
<tr>
<td style="text-align:left"></td>
<td style="text-align:center"><?php echo $cod_factura ?></td>
<td style="text-align:left"><?php echo $nombre_tercero ?></td>
<td style="text-align:center"><?php echo $telefono1_tercero ?><?php echo $url_redir_whatapp ?><?php echo $url_redir_telefono ?></td>
<td style="text-align:center"><?php echo $correo_tercero ?></td>
<td style="text-align:center"><?php echo $fecha_anyo ?></td>
<td style="text-align:center"><?php echo $mensaje_dias_cumple ?></td>
<td style="text-align:center"><?php echo $fecha_pago ?></td>
<td style="text-align:center"><?php echo number_format($monto_deuda, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo number_format($abonado, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo number_format($subtotal, 0, ",", ".") ?></td>

<td style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>