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

if (isset($_GET['dias_alerta_entrega_venta'])) {
$dias_alerta_entrega_venta               = addslashes($_GET['dias_alerta_entrega_venta']);
$fecha_pago_fin                          = date('Y-m-d', strtotime($fecha_pago_ini.'+'.$dias_alerta_entrega_venta.' day'));
}
?>
<form action="" id="" method="GET">

<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="../admin/reporte_fecha_pago_credito_venta_caducados.php">Reporte Pagos Vencidos</a></th>
<th style="text-align:center;"><a href="../admin/reporte_fecha_pago_credito_venta_a_caducar.php">Reporte Pagos a Vencer</a></th>
</tr>
</table>

<table class="table table-striped">
  <tr>
    <th style="text-align:center;">DIAS PARA EL PAGO: <input class="" name="dias_alerta_entrega_venta" type="number" value="<?php echo $dias_alerta_entrega_venta ?>" required/></th>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>

<?php if (isset($_GET['dias_alerta_entrega_venta'])) { ?>
<table class="table table-striped">
<tr>
<td style="text-align:left;">DIAS: <?php echo $dias_alerta_entrega_venta ?></td>
</tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
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

$sql_cliente = "SELECT * FROM tbl15_info_factura_venta WHERE (fecha_pago BETWEEN '$fecha_pago_ini' AND '$fecha_pago_fin') AND (cod_tipo_pago = '2') AND (subtotal <> '0') ORDER BY fecha_pago ASC";
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

$fecha_cumpleanos_alerta                 = date('Y-m-d', strtotime($fecha_pago_ini.'+'.$dias_alerta_entrega_venta.' day'));
$dias_seg                                = (strtotime($fecha_pago)-strtotime($fecha_actual))/86400;
$dias_abs                                = abs($dias_seg); 
$dias                                    = floor($dias_abs);

if ($dias_seg > 0) { $mensaje_dias_cumple = "LA FECHA DE PAGO VENCE DENTRO DE ".$dias." DIAS"; } elseif ($dias_seg < 0) { $mensaje_dias_cumple = "LA FECHA DE PAGO VENCE DENTRO DE ".$dias." DIAS"; } else { $mensaje_dias_cumple = "VENCE HOY"; }

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
<hr>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->

<script>
function printPageArea(areaID){

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>REPORTE VENTAS</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>VENDEDOR: <?php echo $cuenta_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>DEPENDENCIA: <?php echo $nombre_dependencia_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TIPO PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA INI: <?php echo $fecha_ymd_venta_producto_ini; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL VENTA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL VENTA CONTADO:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_contado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL VENTA CREDITO:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_credito, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL ABONOS:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_cuenta_credito_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL CAJA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_caja_venta_fisica, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php if ($cod_seguridad==1) { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL GRESOS:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier;total_caja_venta_fisica font-size:8pt;"><strong><?php echo number_format($total_egreso, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL UTILIDAD:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"> <strong><?php echo number_format($total_utilidad, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL GANACIA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_ganancia, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL COMISION:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"> <strong><?php echo number_format($total_comision_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php } ?>
<?php if ($cod_estado_propina_global == '1') { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL PROPINA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"> <strong><?php echo number_format($total_suma_servicio_propina, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php } ?>

<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><strong>FORMAS DE PAGO</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<thead>
<tr>
<th style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong></strong></th>
<th style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong></strong></th>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_total_forma_pago = "SELECT Sum(tbl15_venta_producto.total_venta_producto) AS suma_total_venta_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_venta_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_venta_producto.cod_tipo_forma_pago
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_factura_rel
GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

$nombre_tipo_forma_pago        = $datos_total_forma_pago['nombre_tipo_forma_pago'];
$suma_total_venta_producto     = $datos_total_forma_pago['suma_total_venta_producto'];

?>
<tr>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_tipo_forma_pago?>:</strong></td>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($suma_total_venta_producto, 0, ",", ".")?></strong></td>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php } ?>
</tbody>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:5%; font-family: Courier; font-size:8pt;"><strong>Und</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>Concepto</strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>P.Total</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong>Id</strong></td>
</tr>
<?php
$suma_total_venta = 0;
$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_factura_rel
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_venta_producto            = $info_cliente['cod_venta_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
$cod_factura                   = $info_cliente['cod_factura'];
$cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_venta                     = $info_cliente['und_venta'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_compra_producto          = $info_cliente['total_compra_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$total_venta_producto          = $info_cliente['total_venta_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
$nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
$suma_total_venta              = $suma_total_venta + $total_venta_producto;
$total_comision                = $total_comision + ($total_venta_producto * ($comision_ptj/100));

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];
?>
<tr>
<td style="text-align: center; width:5%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:3%; font-family: Courier; font-size:5pt;"><?php echo $cod_venta_producto ?></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'_'?></strong>_imp_repvent</td>
  </tr>
</table>
</div>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>