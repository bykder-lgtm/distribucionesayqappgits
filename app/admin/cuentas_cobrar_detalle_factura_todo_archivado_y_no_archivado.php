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
<a href="#"><h4>Cuentas por Cobrar</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$cod_tercero                       = intval($_GET['cod_tercero']);
$cod_cuentas_cobrar                = intval($_GET['cod_cuentas_cobrar']);

$tab                               = 'tbl15_cuentas_cobrar_por_factura';
$tab2                              = 'tbl15_cuentas_cobrar_archivar_por_factura';
$campo                             = 'cod_cuentas_cobrar';
$tipo                              = 'eliminar';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente);
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero            = $total_cliente['identificacion_tercero'];
$nombre1_tercero                   = $total_cliente['nombre1_tercero'];
$apellido1_tercero                 = $total_cliente['apellido1_tercero'];
$nombre_cliente                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                  = 0;
$abonado_smtr                      = 0;
$subtotal_smtr                     = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') AND (tbl15_cuentas_cobrar.subtotal > '0') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

//$cod_cuentas_cobrar                = $datos_total_facturas['cod_cuentas_cobrar'];
$cod_factura                       = $datos_total_facturas['cod_factura'];
$cod_factura_strpad                = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$fecha_hoy                         = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura_strpad ?>";
var estandar_barras = "code128";
var renderer = "css";

var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 40, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
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
<td style="text-align: center;"><strong><font size="5">CUENTAS POR COBRAR<br><br>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">FACTURAS EN CREDITO - <?php echo $cliente;?><br><br>
</tr>
</table>

<table class="table table-striped">
	<tr>
		<td style="text-align: center;"><strong>FACTURA</strong></td>
		<td style="text-align: center;"><strong>CLIENTE</strong></td>
		<td style="text-align: center;"><strong>TOTAL CREDITO</strong></td>
		<td style="text-align: center;"><strong>TOTAL ABONADO</strong></td>
		<td style="text-align: center;"><strong>TOTAL PENDIENTE</strong></td>
		<td style="text-align: center;"><strong></strong></td>
		<td style="text-align: center;"><strong>FECHA REG</strong></td>
		<td style="text-align: center;"><strong>FECHA PAGO</strong></td>
		<td style="text-align: center;"><strong>VENDEDOR</strong></td>
		<td style="text-align: center;"><strong>ID</strong></td>
	</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor, 
tbl15_cuentas_cobrar.cod_info_factura_venta, tbl15_cuentas_cobrar.cod_estado_pago
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY tbl15_cuentas_cobrar.cod_cuentas_cobrar DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

	$cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
	$cod_info_factura_venta         = $datos_cuenta_cobrar['cod_info_factura_venta'];
	$cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
	$cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
	$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
	$abonado                        = $datos_cuenta_cobrar['abonado'];
	$subtotal                       = $datos_cuenta_cobrar['subtotal'];
	$mensaje                        = $datos_cuenta_cobrar['mensaje'];
	$fecha                          = $datos_cuenta_cobrar['fecha'];
	$fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
	$vendedor                       = $datos_cuenta_cobrar['vendedor'];
	$cod_estado_pago                = $datos_cuenta_cobrar['cod_estado_pago'];
	$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
	$abonado_smtr                   = $abonado_smtr + $abonado;
	$subtotal_smtr                  = $subtotal_smtr + $subtotal;

	if (($fecha_hoy > $fecha_pago) && ($subtotal > '0')) { $condicional_fecha_subtotal = true; } else { $condicional_fecha_subtotal = false; }
	if ($cod_estado_pago == '0') { $condicional_estado_pago = true; } else { $condicional_estado_pago = false; }

	if ($condicional_fecha_subtotal && $condicional_estado_pago) { 
		$cod_estado_pago_invert = '1';
		$url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_cobrar_reg.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
		$boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; 
	} else { 
		$cod_estado_pago_invert = '0';
		$url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_cobrar_reg.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
		$boton_alerta_caducidad = '<img src="../imagenes/sem_atendido_peq.png">'; 
	}
?>
	<tr>
		<td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
		<td><font size='3'><?php echo $cliente;?></font></td>
		<td style="text-align: right;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></td>
		<td style="text-align: right;"><font size='3'><?php echo number_format($abonado, 0, ",", ".");?></font></td>
		<td style="text-align: right;"><font size='5'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
		<td style="text-align: left;"><?php echo $mensaje;?></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $vendedor; ?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $cod_cuentas_cobrar; ?></font></td>
	</tr>
<?php } ?>
</table>

<br>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong>ABONOS</strong></td>
<td style="text-align: center;"><strong>PAGO A</strong></td>
<td style="text-align: center;"><strong>MENSAJE</strong></td>
<td style="text-align: center;"><strong>FORMA PAGO</strong></td>
<td style="text-align: center;"><strong>FECHA</strong></td>
<td style="text-align: center;"><strong>HORA</strong></td>
<td style="text-align: center;"><strong>ID</strong></td>
</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') ORDER BY cod_cuentas_cobrar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
    $abonado                    = $datos['abonado'];
    $cuenta                     = $datos['cuenta'];
    $mensaje                    = $datos['mensaje'];
    $fecha_pago                 = $datos['fecha_pago'];
    $hora                       = $datos['hora'];
    $cod_dependencia            = $datos['cod_dependencia'];
    $cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
?>
<tr>
<td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
<td style="text-align: left;"><font size="4px"><?php echo $mensaje; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $nombre_tipo_forma_pago; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $fecha_pago; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $hora; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_cobrar_abonos; ?></font></td>
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
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>CUENTAS POR COBRAR (POR CLIENTE)</strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT CLIENTE: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="2" width="275px" cellspacing="2" cellpadding="2" style="font-family: Courier; font-size:9pt;">
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

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

	$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
	$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
	$cliente                       = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
	$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
	$abonado                       = $datos_cuenta_cobrar['abonado'];
	$subtotal                      = $datos_cuenta_cobrar['subtotal'];
	$mensaje                       = $datos_cuenta_cobrar['mensaje'];
	$fecha                         = $datos_cuenta_cobrar['fecha'];
	$vendedor                      = $datos_cuenta_cobrar['vendedor'];
	$monto_deuda_smtr_1            = $monto_deuda_smtr_1 + $monto_deuda;
	$abonado_smtr_1                = $abonado_smtr_1 + $abonado;
	$subtotal_smtr_1               = $subtotal_smtr_1 + $subtotal;
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong><?php echo $cod_factura ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:15%; font-family: Courier; font-size:10pt;"><strong><?php echo $fecha ?></strong></td>
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
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: right; width: 50%; font-family: Courier; font-size:10pt;"><strong>$ <?php echo number_format($monto_deuda_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 50%; font-family: Courier; font-size:10pt;"><strong>$ <?php echo number_format($abonado_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>TOTAL PENDIENTE:</strong></td>
    <td style="text-align: right; width: 50%; font-family: Courier; font-size:10pt;"><strong>$ <?php echo number_format($subtotal_smtr_1, 0, ",", ".") ?></strong></td>
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
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?>_imp_cobdetallfact</strong></td>
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