<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-barcode.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_cuentas_pagar_factura_editable_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Pagar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cuentas_pagar              = intval($_GET['cod_cuentas_pagar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);
$cod_info_factura_compra        = intval($_GET['cod_info_factura_compra']);
$cliente                        = addslashes($_GET['cliente']);
$pagina                         = addslashes($_GET['pagina']);
$pagina_local                   = $_SERVER['PHP_SELF'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_pagar_abonos WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                    = $sum_monto_deuda['total_venta'];
$total_abonado                  = $sum_abonos['total_abonado'];
$total_deuda                    = $total_venta - $total_abonado;

$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong><a href="../admin/cuentas_pagar_detalle_factura_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero?>"><font size="5px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="6px">ABONOS PROVEEDOR: <?php echo $nombre_cliente;?> </font></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="6px">FACTURA: <?php echo $cod_factura; ?></font></strong></td>
</tr>
</table>

<br>

<table class="table table-striped">
  <tr>
    <?php if ($cod_seguridad== '1') { ?><th style="text-align: center;">TOTAL CREDITO</th><?php } ?>
    <th style="text-align: center;">TOTAL ABONADO</th>
    <th style="text-align: center;">TOTAL PENDIENTE</th>
    <th style="text-align: center;">FECHA REG</th>
    <th style="text-align: center;">FECHA PAGO</th>
    <th style="text-align: center;">ID</th>
    <th style="text-align: center;">GUARDAR</th>
  </tr>
<?php
  $sql = "SELECT * FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
  $consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
  $total_datos = mysqli_num_rows($consulta);
  $datos = mysqli_fetch_assoc($consulta);

  $monto_deuda                = $datos['monto_deuda'];
  $abonado                    = $datos['abonado'];
  $fecha                      = $datos['fecha'];
  $fecha_pago                 = $datos['fecha_pago'];
  $cuenta                     = $datos['cuenta'];
  $total_pendiente            = $monto_deuda - $abonado;
?>
  <tr>
    <?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><input style="text-align: center; font-size:40px;" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'monto_deuda', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $monto_deuda;?>"></td><?php } ?>
    <td style="text-align: center; font-size:40px;"><?php echo number_format($abonado, 0, ",", "."); ?></td>
    <td style="text-align: center; font-size:40px;"><?php echo number_format($total_pendiente, 0, ",", "."); ?></td>
    <td style="text-align: center; font-size:20px;"><?php echo $fecha; ?></td>
    <?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><input style="text-align: center;" type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_pago', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $fecha_pago;?>"></td><?php } ?>
    <td style="text-align: center; font-size:20px;"><?php echo $cod_cuentas_pagar; ?></td>
    <td style="text-align: center;"><a href="<?php echo $pagina_local;?>?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/guardar.png alt="Abonar"></a></td>
  </tr>
</table>

</div>

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

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>ABONOS CUENTAS POR PAGAR (POR FACTURA)</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT PROVEEDOR: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE PROVEEDOR: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong>ABONO</strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong>FECHA</strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong>PAGO A</strong></td>
<td style="text-align: left; width:2%; font-family: Courier; font-size:9pt;"><strong></strong></td>
</td>
<?php
$sql = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar') ORDER BY fecha_invert DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_pagar_abonos     = $datos_cuenta_pagar['cod_cuentas_pagar_abonos'];
$abonado                      = $datos_cuenta_pagar['abonado'];
$cuenta                       = $datos_cuenta_pagar['cuenta'];
$mensaje                      = $datos_cuenta_pagar['mensaje'];
$fecha_pago                   = $datos_cuenta_pagar['fecha_pago'];
$hora                         = $datos_cuenta_pagar['hora'];
?>
<tr>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo $cuenta ?></strong></td>
<td style="text-align: left; width:2%; font-family: Courier; font-size:9pt;"><strong></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>SALDO PENDIENTE:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_deuda, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"></td>
    <!--<td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"><div id="barcodeTarget" class="barcodeTarget"></div></td>-->
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cob_abon</td>
  </tr>
</table>

    </div>
  </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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