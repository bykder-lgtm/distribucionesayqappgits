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
	myajax.Link('guardar_cuentas_pagar_abonos_editable.php?valor='+valor+'&campo='+campo+'&id='+id);
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
$pagina                            = $_SERVER['PHP_SELF'];
$cod_tercero                       = intval($_GET['cod_tercero']);

$tab1                              = 'tbl15_cuentas_pagar_por_factura_directa';
$tab2                              = 'tbl15_cuentas_pagar_por_abono_directa';

$campo1                            = 'cod_cuentas_pagar';
$campo2                            = 'cod_cuentas_pagar_abonos';
$tipo                              = 'eliminar';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_hoy                         = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$calcular_datos_cuenta_pagar = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_pagar, total_subtotal_cuenta_pagar, total_abonado_cuenta_pagar 
FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

$total_monto_deuda_cuenta_pagar                   = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];
$total_subtotal_cuenta_pagar                      = $datos_cuenta_pagar['total_subtotal_cuenta_pagar'];
$total_abonado_cuenta_pagar                       = $datos_cuenta_pagar['total_abonado_cuenta_pagar'];
$identificacion_tercero                            = $datos_cuenta_pagar['identificacion_tercero'];
$nombre1_tercero                                   = $datos_cuenta_pagar['nombre1_tercero'];
$apellido1_tercero                                 = $datos_cuenta_pagar['apellido1_tercero'];
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
<td style="text-align: center;"><strong><a href="../admin/lista_cuentas_pagar_directa_no_por_factura.php"><font size="5px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">CUENTAS POR PAGAR<br><br>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">FACTURAS EN CREDITO - <?php echo $cliente;?><br><br>
</tr>
<?php if ($total_subtotal_cuenta_pagar <> '0') { ?>
<tr>
<td style="text-align: center;"><a href="../admin/reg_abono_cuentas_pagar_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero?>&pagina=<?php echo $pagina?>"><font size="6px">NUEVO ABONO</font></a></td>
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

		<?php if ($cod_estado_modulo_cuenta_pagar_abono_editar_compra_global == '1') { ?>
		<th style="text-align: center">...</th>
		<?php } ?>

		<td style="text-align: center;"><strong>VENDEDOR</strong></td>
		<td style="text-align: center;"></td>

		<td style="text-align: center;"><strong>ID</strong></td>
		<?php if ($cod_estado_cuenta_pagar_editar== '1') { ?>
		<td style="text-align: center;"><strong>EDIT</strong></td>
		<?php } ?>
		<?php if ($cod_estado_cuenta_pagar_eliminar == '1') { ?>
		<th style="text-align:center">ELIM</th>
		<?php } ?>
	</tr>
<?php
$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_pagar.mensaje, tbl15_cuentas_pagar.fecha_pago, tbl15_cuentas_pagar.fecha, tbl15_cuentas_pagar.vendedor, 
tbl15_cuentas_pagar.cod_info_factura_compra, tbl15_cuentas_pagar.cod_estado_pago
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
		<td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
		<td style="text-align: right;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></td>
		<td style="text-align: center;"><a href="../admin/edit_factura_compra.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/ver_lista_peq.png alt="Abonar"></a></td>
		<!--<td style="text-align: center;"><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/agregar.png alt="productos"></a></td>-->
		<td style="text-align: center;"><font size='3'><?php echo $fecha;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>

		<?php if ($cod_estado_modulo_cuenta_pagar_abono_editar_compra_global == '1') { ?>
		<td style="text-align: center"><a href="<?php echo $url_actualizar_estado_pago ?>"><?php echo $boton_alerta_caducidad ?><a/></td>
		<?php } ?>

		<td style="text-align: center;"><font size='3'><?php echo $vendedor; ?></font></td>
		<td style="text-align: left;"><?php echo $mensaje;?></td>
		<td style="text-align: center;"><font size='3'><?php echo $cod_cuentas_pagar; ?></font></td>
		<?php if ($cod_estado_cuenta_pagar_editar== '1') { ?>
		<td style="text-align: center;"><a href="../admin/edit_cuentas_pagar_factura_directa_no_por_factura.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/editar.png alt="Abonar"></a></td>
		<?php } ?>
		<?php if ($cod_estado_cuenta_pagar_eliminar == '1') { ?>
		<td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_cuentas_pagar; ?>&cod_tercero=<?php echo $cod_tercero;?>&tab=<?php echo $tab1; ?>&campo=<?php echo $campo1; ?>&tipo=<?php echo $tipo; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
		<?php } ?>
	</tr>
<?php } ?>
</table>

<br>

  <table class="table table-striped">
    <tr>
      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center; width:50%"><button id="btnImprimirCreditoAbonoCuentaPagar"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
      <?php } ?>
    </tr>
  </table>


<table class="table table-striped">
	<tr>
		<?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
		<td style="text-align: center;"><strong>IMP</strong></td>
		<?php } ?>
		<td style="text-align: center;"><strong>ABONOS</strong></td>
		<td style="text-align: center;"><strong>PAGO A</strong></td>
		<td style="text-align: center;"><strong>MENSAJE</strong></td>
		<td style="text-align: center;"><strong>FORMA PAGO</strong></td>
		<td style="text-align: center;"><strong>DEPENDENCIA</strong></td>
		<td style="text-align: center;"><strong>FECHA</strong></td>
		<td style="text-align: center;"><strong>HORA</strong></td>
		<td style="text-align: center;"><strong>ID</strong></td>
		<!--<td style="text-align: center;"><strong>IMP</strong></td>-->
		<?php if ($cod_estado_cuenta_pagar_eliminar == '1') { ?>
		<th style="text-align:center">ELIM</th>
		<?php } ?>
	</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_cuentas_pagar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

	$cod_cuentas_pagar_abonos   = $datos['cod_cuentas_pagar_abonos'];
	$abonado                    = $datos['abonado'];
	$cuenta                     = $datos['cuenta'];
	$mensaje                    = $datos['mensaje'];
	$fecha_pago                 = $datos['fecha_pago'];
	$hora                       = $datos['hora'];
	$cod_dependencia            = $datos['cod_dependencia'];
	$cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];

	$sql_datos_cuenta_cobrar = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$nombre_tipo_forma_pago       = $datos_cuenta_cobrar['nombre_tipo_forma_pago'];

	$sql_datos_movimiento_contable_cuenta_personal_concepto = "SELECT cod_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (cod_cuentas_pagar_abonos = '$cod_cuentas_pagar_abonos')";
	$consulta_datos_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal_concepto);
	$datos_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal_concepto);

	$cod_movimiento_contable_cuenta_personal       = $datos_movimiento_contable_cuenta_personal_concepto['cod_movimiento_contable_cuenta_personal'];

	$sql_datos_movimiento_contable_cuenta_personal = "SELECT nombre_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
	$consulta_datos_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal);
	$datos_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal);

	$nombre_puc       = $datos_movimiento_contable_cuenta_personal['nombre_puc'];
?>

	<tr>
      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center;"><button onclick="btnImprimirAbonoCuentaPagar(<?php echo $cod_cuentas_pagar_abonos; ?>)"><img src="../imagenes/imprimir_imgpeq.png" alt="imprimir"></button></td>
      <?php } ?>
		<?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'abonado', <?php echo $cod_cuentas_pagar_abonos;?>)" class="cajgrand" id="<?php echo $cod_cuentas_pagar_abonos;?>" value="<?php echo $abonado;?>" size="3"></td><?php } else { ?><td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td><?php } ?>
		<td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
		<td align="left"><font size="4px"><?php echo $mensaje; ?></font></td>
		<td style="text-align: center;">
			<font size="4px">
			<?php echo $nombre_tipo_forma_pago; ?>
			<br>
			<a href="../admin/edit_cuentas_pagar_directa_no_por_factura_forma_pago_movimiento_contable_cuenta_personal.php?cod_cuentas_pagar_abonos=<?php echo $cod_cuentas_pagar_abonos ?>&cod_movimiento_contable_cuenta_personal=<?php echo $cod_movimiento_contable_cuenta_personal ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_cuentas_pagar=<?php echo $cod_cuentas_pagar ?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>">(<?php echo $nombre_puc; ?>)</a>
			</font>
		</td>

		<td style="text-align:center">
		    <select name="cod_dependencia" id="<?php echo $cod_cuentas_pagar_abonos; ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
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
		<td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_pagar_abonos; ?></font></td>
		<?php if ($cod_estado_cuenta_pagar_eliminar == '1') { ?>
		<td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_cuentas_pagar_abonos; ?>&cod_tercero=<?php echo $cod_tercero;?>&tab=<?php echo $tab2; ?>&campo=<?php echo $campo2; ?>&tipo=<?php echo $tipo; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
		<?php } ?>
		<!--<td style="text-align: center;"><a href="../admin/cuentas_pagar_abonos_imprimir_80mm_pdf.php?cod_cuentas_pagar_abonos=<?php echo $cod_cuentas_pagar_abonos?>&cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>"  target="_blank"><img src=../imagenes/imprimir_imgpeq.png alt="imprimir_imgpeq"></a></td>-->
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
		<td style="text-align: center;"><font size='5'><?php echo number_format($total_monto_deuda_cuenta_pagar, 0, ",", ".")?></font></a></td>
		<td style="text-align: center;"><font size='5'><?php echo number_format($total_abonado_cuenta_pagar, 0, ",", ".");?></font></td>
		<td style="text-align: center;"><font size='5'><?php echo number_format($total_subtotal_cuenta_pagar, 0, ",", "."); ?></font></td>
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
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>CUENTAS POR PAGAR (POR CLIENTE)</strong></td>
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

$cod_cuentas_pagar             = $datos_cuenta_pagar['cod_cuentas_pagar'];
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

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
    $.ajax({ url:"cuentas_pagar_abonos_dependencia_ajax.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

   <script>  
  $(document).ready(function(){ 
    $('#btnImprimirCreditoAbonoCuentaPagar').click(function(){
    var cod_tercero = <?php echo $cod_tercero ?>;
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_abono_y_cuenta_pagar_todo_ticket_pos.php", method:"GET", data:{cod_tercero:cod_tercero, campo:"cod_tercero", id:cod_tercero, origen:origen }, 
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

  <script>  
	function btnImprimirAbonoCuentaPagar(cod_cuentas_pagar_abonos) {
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_abono_cuenta_pagar_ticket_pos.php", method:"GET", data:{cod_cuentas_pagar_abonos:cod_cuentas_pagar_abonos, campo:"cod_cuentas_pagar_abonos", id:cod_cuentas_pagar_abonos, origen:origen }, 
       success: function(response) {
           if(response==1){
               //alert('Imprimiendo....');
           } else {
               //alert('Error');
           }
       }
      });  
    }
  </script>
</body>
</html>