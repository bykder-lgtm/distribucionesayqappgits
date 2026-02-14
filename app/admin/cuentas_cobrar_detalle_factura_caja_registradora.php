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
	myajax.Link('guardar_cuentas_cobrar_abonos_editable.php?valor='+valor+'&campo='+campo+'&id='+id);
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

$tab                               = 'tbl15_cuentas_cobrar_por_factura';
$campo                             = 'cod_tercero';
$tipo                              = 'eliminar';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_hoy                         = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$calcular_datos_cuenta_cobrar = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar 
FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$total_monto_deuda_cuenta_cobrar                   = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
$total_subtotal_cuenta_cobrar                      = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
$total_abonado_cuenta_cobrar                       = $datos_cuenta_cobrar['total_abonado_cuenta_cobrar'];
$identificacion_tercero                            = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre1_tercero                                   = $datos_cuenta_cobrar['nombre1_tercero'];
$apellido1_tercero                                 = $datos_cuenta_cobrar['apellido1_tercero'];
$nombre_cliente                                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                                  = 0;
$abonado_smtr                                      = 0;
$subtotal_smtr                                     = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong><a href="../admin/lista_cuentas_cobrar_version_independiente.php"><font size="5px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">CUENTAS POR COBRAR<br><br>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">FACTURAS EN CREDITO - <?php echo $cliente;?><br><br>
</tr>
<?php if ($total_subtotal_cuenta_cobrar <> '0') { ?>
<tr>
<td style="text-align: center;"><a href="../admin/reg_abono_cuentas_cobrar_caja_registradora.php?cod_tercero=<?php echo $cod_tercero?>&pagina=<?php echo $pagina?>"><font size="6px">NUEVO ABONO</font></a></td>
</tr>
<?php } ?>
</table>
</table>

<table class="table table-striped">
	<tr>
		<td style="text-align: center;"><strong>FACTURA</strong></td>
		<td style="text-align: center;"><strong>TOTAL CREDITO</strong></td>
		<td style="text-align: center;"><strong>VER PROD</strong></td>
		<!--<td style="text-align: center;"><strong>PRODUCTOS</strong></td>-->
		<td style="text-align: center;"><strong>FECHA REG</strong></td>
		<td style="text-align: center;"><strong>FECHA PAGO</strong></td>

		<?php if ($cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global == '1') { ?>
		<th style="text-align: center">...</th>
		<?php } ?>

		<td style="text-align: center;"><strong>VENDEDOR</strong></td>
		<?php if ($cod_estado_cuenta_cobrar_editar== '1') { ?>
		<td style="text-align: center;"><strong>EDIT</strong></td>
		<?php } ?>
	</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.cod_cuentas_cobrar DESC";
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
$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
$abonado_smtr                   = $abonado_smtr + $abonado;
$subtotal_smtr                  = $subtotal_smtr + $subtotal;

if (($fecha_hoy > $fecha_pago) && ($subtotal > '0')) { $boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; } else { $boton_alerta_caducidad = ''; }
?>
	<tr>
		<td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
		<td style="text-align: right;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></td>
		<td style="text-align: center;"><a href="../admin/edit_factura_venta.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/ver_lista_peq.png alt="Abonar"></a></td>
		<!--<td style="text-align: center;"><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/agregar.png alt="productos"></a></td>-->
		<td style="text-align: center;"><font size='3'><?php echo $fecha;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>

		<?php if ($cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global == '1') { ?>
		<td style="text-align: center"><?php echo $boton_alerta_caducidad ?></td>
		<?php } ?>

		<td style="text-align: center;"><font size='3'><?php echo $vendedor; ?></font></td>
		<?php if ($cod_estado_cuenta_cobrar_editar== '1') { ?>
		<td style="text-align: center;"><a href="../admin/edit_cuentas_cobrar_factura_caja_registradora.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/editar.png alt="Abonar"></a></td>
		<?php } ?>
	</tr>
<?php } ?>
</table>

<br>

  <table class="table table-striped">
    <tr>
      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center; width:50%"><button id="btnImprimirCreditoAbonoCuentaCobrar"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
      <?php } ?>
    </tr>
  </table>


<table class="table table-striped">
	<tr>
		<td style="text-align: center;"><strong>ABONOS</strong></td>
		<td style="text-align: center;"><strong>PAGO A</strong></td>
		<td style="text-align: center;"><strong>MENSAJE</strong></td>
		<td style="text-align: center;"><strong>DEPENDENCIA</strong></td>
		<td style="text-align: center;"><strong>FECHA</strong></td>
		<td style="text-align: center;"><strong>HORA</strong></td>
		<td style="text-align: center;"><strong>ID</strong></td>
		<!--<td style="text-align: center;"><strong>IMP</strong></td>-->
	</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_cuentas_cobrar_abonos DESC";
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
?>
	<tr>
		<?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'abonado', <?php echo $cod_cuentas_cobrar_abonos;?>)" class="cajgrand" id="<?php echo $cod_cuentas_cobrar_abonos;?>" value="<?php echo $abonado;?>" size="3"></td><?php } else { ?><td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td><?php } ?>
		<td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
		<td align="left"><font size="4px"><?php echo $mensaje; ?></font></td>
		<td style="text-align:center">
		    <select name="cod_dependencia" id="<?php echo $cod_cuentas_cobrar_abonos; ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
		        <?php if (isset($cod_dependencia)) { echo ""; } else { echo  ""; }
		        $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
		        $consulta2 = mysqli_query($conectar, $consulta2_sql);
		        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		        if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
		        $seleccionado = "selected"; } else { $seleccionado = ""; }
		        $codigo = $datos2['cod_dependencia'];
		        $nombre = $datos2['nombre_dependencia'];
		        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		    </select>
		</td>
		<td style="text-align: center;"><font size="4px"><?php echo $fecha_pago; ?></font></td>
		<td style="text-align: center;"><font size="4px"><?php echo $hora; ?></font></td>
		<td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_cobrar_abonos; ?></font></td>
		<!--<td style="text-align: center;"><a href="../admin/cuentas_cobrar_abonos_imprimir_80mm_pdf.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos?>&cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>"  target="_blank"><img src=../imagenes/imprimir_imgpeq.png alt="imprimir_imgpeq"></a></td>-->
	</tr>
<?php } ?>
</table>

<table class="table table-striped">
	<tr>
		<td style="text-align: center;"><strong><font size='5'>TOTAL CREDITO</font></strong></td>
		<td style="text-align: center;"><strong><font size='5'>TOTAL ABONADO</font></strong></td>
		<td style="text-align: center;"><strong><font size='5'>TOTAL PENDIENTE</font></strong></td>
	</tr>
	<tr>
		<td style="text-align: center;"><font size='5'><?php echo number_format($total_monto_deuda_cuenta_cobrar, 0, ",", ".")?></font></a></td>
		<td style="text-align: center;"><font size='5'><?php echo number_format($total_abonado_cuenta_cobrar, 0, ",", ".");?></font></td>
		<td style="text-align: center;"><font size='5'><?php echo number_format($total_subtotal_cuenta_cobrar, 0, ",", "."); ?></font></td>
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

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
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
$fecha_pago                    = $datos_cuenta_cobrar['fecha_pago'];
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

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
    $.ajax({ url:"cuentas_cobrar_abonos_dependencia_ajax.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

   <script>  
  $(document).ready(function(){  
    $('#btnImprimirCreditoAbonoCuentaCobrar').click(function(){
    var cod_tercero = <?php echo $cod_tercero ?>;
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_abono_y_cuenta_cobrar_todo_ticket_pos.php", method:"GET", data:{cod_tercero:cod_tercero, campo:"cod_tercero", id:cod_tercero, origen:origen }, 
       success: function(response){
           if(response==1){
               //alert('Imprimiendo....');
           }else{
               //alert('Error');
           }
       }
      });  
    });
  });  
  </script>
  
</body>
</html>