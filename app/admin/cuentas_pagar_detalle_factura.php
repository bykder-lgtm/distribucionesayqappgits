<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="js/jquery-barcode.js"></script>
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
<a href="#"><h4>Cuentas por Pagar</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                         = $_SERVER['PHP_SELF'];
$cod_tercero                    = intval($_GET['cod_tercero']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_hoy                         = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente);
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                        = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr               = 0;
$abonado_smtr                   = 0;
$subtotal_smtr                  = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_pagar.mensaje, tbl15_cuentas_pagar.fecha_pago, tbl15_cuentas_pagar.vendedor, tbl15_cuentas_pagar.cod_info_factura_compra
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero 
WHERE (tbl15_cuentas_pagar.cod_tercero='$cod_tercero') AND (tbl15_cuentas_pagar.subtotal > '0') ORDER BY tbl15_cuentas_pagar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura            = $datos_total_facturas['cod_factura'];
$cod_factura_strpad     = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura_strpad ?>";
var estandar_barras = "code128";
var renderer = "css";

var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 30, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
$("#barcodeTarget").html("").show().barcode(cod_factura, estandar_barras, settings);

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong><a href="../admin/lista_cuentas_pagar.php"><font size="5px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">CUENTAS POR PAGAR<br><br>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">FACTURA - <?php echo $cliente;?><br><br>
</tr>
<!--
<tr>
<td style="text-align: center;"><strong><a href="../admin/ver_cuentas_pagar_abonos_globales.php?cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>"><font size="5px">VER ABONOS GLOBALES</font></a></strong></td><br><br>
</tr>
-->
</table>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
</tr>
</table>

<table class="table table-striped">
	<tr>
		<?php if ($cod_seguridad== '3') { ?>
		<td style="text-align: center;"><strong>ELIM</strong></td>
		<?php } ?>
		<td style="text-align: center;"><strong>FACTURA</strong></td>
		<td style="text-align: center;"><strong>TERCERO</strong></td>
		<td style="text-align: center;"><strong>TOTAL CREDITO</strong></td>
		<td style="text-align: center;"><strong>TOTAL ABONADO</strong></td>
		<td style="text-align: center;"><strong>VER ABONOS</strong></td>
		<td style="text-align: center;"><strong>TOTAL PENDIENTE</strong></td>
		<td style="text-align: center;"><strong>ABONAR</strong></td>
		<td style="text-align: center;"><strong>VER</strong></td>
		<!--<td style="text-align: center;"><strong>PRODUCTOS</strong></td>-->
		<td style="text-align: center;"><strong>FECHA REG</strong></td>
		<td style="text-align: center;"><strong>FECHA PAGO</strong></td>

		<?php if ($cod_estado_modulo_cuenta_pagar_abono_editar_compra_global == '1') { ?>
		<th style="text-align: center">...</th>
		<?php } ?>

		<td style="text-align: center;"><strong>VENDEDOR</strong></td>
		<td style="text-align: center;"><strong>ID</strong></td>
	</tr>
<?php
$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_pagar.mensaje, tbl15_cuentas_pagar.fecha_pago, tbl15_cuentas_pagar.fecha, tbl15_cuentas_pagar.vendedor, tbl15_cuentas_pagar.cod_info_factura_compra, tbl15_cuentas_pagar.cod_estado_pago
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero 
WHERE (tbl15_cuentas_pagar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_pagar.cod_cuentas_pagar DESC";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar)) {

	$cod_cuentas_pagar              = $datos_cuenta_pagar['cod_cuentas_pagar'];
	$cod_info_factura_compra        = $datos_cuenta_pagar['cod_info_factura_compra'];
	$cod_factura                    = $datos_cuenta_pagar['cod_factura'];
	$cliente                        = $datos_cuenta_pagar['nombre1_tercero']." ".$datos_cuenta_pagar['apellido1_tercero'];
	$monto_deuda                    = $datos_cuenta_pagar['monto_deuda'];
	$abonado                        = $datos_cuenta_pagar['abonado'];
	$subtotal                       = $datos_cuenta_pagar['subtotal'];
	$mensaje                        = $datos_cuenta_pagar['mensaje'];
	$fecha                          = $datos_cuenta_pagar['fecha'];
	$fecha_pago                     = $datos_cuenta_pagar['fecha_pago'];
	$vendedor                       = $datos_cuenta_pagar['vendedor'];
	$cod_estado_pago                = $datos_cuenta_pagar['cod_estado_pago'];
	$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
	$abonado_smtr                   = $abonado_smtr + $abonado;
	$subtotal_smtr                  = $subtotal_smtr + $subtotal;

	if (($fecha_hoy > $fecha_pago) && ($subtotal > '0')) { $condicional_fecha_subtotal = true; } else { $condicional_fecha_subtotal = false; }
	if ($cod_estado_pago == '0') { $condicional_estado_pago = true; } else { $condicional_estado_pago = false; }

	if ($condicional_fecha_subtotal && $condicional_estado_pago) { 
		$cod_estado_pago_invert = '1';
		$url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_pagar_reg.php?cod_cuentas_pagar='.$cod_cuentas_pagar.'&cod_factura='.$cod_factura.'&cod_info_factura_compra='.$cod_info_factura_compra.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
		$boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; 
	} else { 
		$cod_estado_pago_invert = '0';
		$url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_pagar_reg.php?cod_cuentas_pagar='.$cod_cuentas_pagar.'&cod_factura='.$cod_factura.'&cod_info_factura_compra='.$cod_info_factura_compra.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
		$boton_alerta_caducidad = '<img src="../imagenes/sem_atendido_peq.png">'; 
	}
?>
	<tr>
		<?php if ($cod_seguridad== '3') { ?>
		<td style="text-align: center;"><a href="../modificar_eliminar/eliminar_cuentas_pagar_y_abonos.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/eliminar.png alt="Abonar"></a></td>
		<?php } ?>
		<td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
		<td><font size='3'><?php echo $cliente;?></font></td>
		<td style="text-align: right;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></td>
		<td style="text-align: right;"><font size='3'><a href="../admin/cuentas_pagar_abonos.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><?php echo number_format($abonado, 0, ",", ".");?></a></font></td>
		<td style="text-align: center;"><font size='3'><a href="../admin/cuentas_pagar_abonos.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/btn_previsualizar_venta_servicio2.png alt=""></a></font></td>
		<td style="text-align: right;"><font size='5'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>

		<?php if ($subtotal <> '0') { ?>
		<td style="text-align: center;"><a href="../admin/cuentas_pagar_abonos.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/base_caja.png alt="Abonar"></a></td>
		<?php } else { ?>
		<td style="text-align: center;"></td>
		<?php } ?>

		<td style="text-align: center;"><a href="../admin/ver_factura_compra.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/ver_lista_peq.png alt="Abonar"></a></td>

		<!--<td style="text-align: center;"><a href="../admin/productos_fiados.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/agregar.png alt="productos"></a></td>-->
		<td style="text-align: center;"><font size='3'><?php echo $fecha;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>
		<?php if ($cod_estado_modulo_cuenta_pagar_abono_editar_compra_global == '1') { ?>
		<td style="text-align: center"><a href="<?php echo $url_actualizar_estado_pago ?>"><?php echo $boton_alerta_caducidad ?><a/></td>
		<?php } ?>
		<td style="text-align: center;"><font size='3'><?php echo $vendedor; ?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $cod_cuentas_pagar; ?></font></td>
	</tr>
<?php } ?>
</table>

<br>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong><font size='5'>TOTAL CREDITO</font></strong></td>
<td style="text-align: center;"><strong><font size='5'>TOTAL ABONADO</font></strong></td>
<td style="text-align: center;"><strong><font size='5'>TOTAL PENDIENTE</font></strong></td>
</tr>
<tr>
<td style="text-align: center;"><font size='5'><?php echo number_format($monto_deuda_smtr, 0, ",", ".")?></font></a></td>
<td style="text-align: center;"><font size='5'><?php echo number_format($abonado_smtr, 0, ",", ".");?></font></td>
<td style="text-align: center;"><font size='5'><?php echo number_format($subtotal_smtr, 0, ",", "."); ?></font></td>
</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: left;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:11pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>CUENTAS POR PAGAR (POR TERCERO)</strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT TERCERO: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="1" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong>FACT</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:10pt;"><strong>CREDIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:10pt;"><strong>ABONAD</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>PENDIENTE</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>FECHA</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
<tr>
</tr>
<?php
$monto_deuda_smtr_1              = 0;
$abonado_smtr_1                  = 0;
$subtotal_smtr_1                 = 0;

$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_pagar.mensaje, tbl15_cuentas_pagar.fecha_pago, tbl15_cuentas_pagar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero 
WHERE (tbl15_cuentas_pagar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_pagar.fecha_invert DESC";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar)) {

$cod_cuentas_pagar            = $datos_cuenta_pagar['cod_cuentas_pagar'];
$cod_factura                   = $datos_cuenta_pagar['cod_factura'];
$cliente                       = $datos_cuenta_pagar['nombre1_tercero']." ".$datos_cuenta_pagar['apellido1_tercero'];
$monto_deuda                   = $datos_cuenta_pagar['monto_deuda'];
$abonado                       = $datos_cuenta_pagar['abonado'];
$subtotal                      = $datos_cuenta_pagar['subtotal'];
$mensaje                       = $datos_cuenta_pagar['mensaje'];
$fecha_pago                    = $datos_cuenta_pagar['fecha_pago'];
$vendedor                      = $datos_cuenta_pagar['vendedor'];
$monto_deuda_smtr_1            = $monto_deuda_smtr_1 + $monto_deuda;
$abonado_smtr_1                = $abonado_smtr_1 + $abonado;
$subtotal_smtr_1               = $subtotal_smtr_1 + $subtotal;
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong><?php echo $cod_factura ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:15%; font-family: Courier; font-size:10pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
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
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL PENDIENTE:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
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
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cobdetallfact</td>
  </tr>
</table>

		</div>
	</div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
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
</body>
</html>