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
<!--<a href="#"><h4>Reporte Cuentas por Pagar - Cartera Vencida</h4></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_hoy                         = date("Y-m-d");
$monto_deuda_smtr                  = 0;
$abonado_smtr                      = 0;
$subtotal_smtr                     = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">

<table class="table table-striped">
	<tr>
		<th style="text-align: center;"><h4>Reporte Cuentas por Pagar</h4></th>
	</tr>
</table>

<?php include_once('../admin/reporte_cuentas_pagar_menu.php'); ?>

<table class="table table-striped">
	<tr>
		<th style="text-align: center;"><h4>Listado Pagada</h4></th>
	</tr>
</table>

<table class="table table-striped">
	<tr>
		<th style="text-align: center;">VER</th>
		<th style="text-align: center;">FACTURA</th>
		<th style="text-align: center;">TERCERO</th>
		<th style="text-align: center;">TOTAL CREDITO</th>
		<th style="text-align: center;">TOTAL ABONADO</th>
		<th style="text-align: center;">TOTAL PENDIENTE</th>
		<th style="text-align: center;">FECHA REG</th>
		<th style="text-align: center;">FECHA PAGO</th>
		<th style="text-align: center;">VENDEDOR</th>
		<th style="text-align: center;">ID</th>
	</tr>
<?php
$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.subtotal, tbl15_cuentas_pagar.mensaje, tbl15_cuentas_pagar.fecha_pago, 
tbl15_cuentas_pagar.fecha, tbl15_cuentas_pagar.vendedor, tbl15_cuentas_pagar.cod_info_factura_compra, tbl15_cuentas_pagar.cod_estado_pago
FROM tbl15_cuentas_pagar WHERE ((tbl15_cuentas_pagar.cod_estado_pago = '1') OR (tbl15_cuentas_pagar.subtotal <= '0')) ORDER BY tbl15_cuentas_pagar.cod_cuentas_pagar DESC";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar)) {

	$cod_cuentas_pagar                               = $datos_cuenta_pagar['cod_cuentas_pagar'];
	$cod_info_factura_compra                         = $datos_cuenta_pagar['cod_info_factura_compra'];
	$cod_factura                                     = $datos_cuenta_pagar['cod_factura'];
	$monto_deuda                                     = $datos_cuenta_pagar['monto_deuda'];
	$abonado                                         = $datos_cuenta_pagar['abonado'];
	$subtotal                                        = $datos_cuenta_pagar['subtotal'];
	$mensaje                                         = $datos_cuenta_pagar['mensaje'];
	$fecha                                           = $datos_cuenta_pagar['fecha'];
	$fecha_pago                                      = $datos_cuenta_pagar['fecha_pago'];
	$vendedor                                        = $datos_cuenta_pagar['vendedor'];
	$cod_estado_pago                                 = $datos_cuenta_pagar['cod_estado_pago'];
	$cod_tercero                                     = $datos_cuenta_pagar['cod_tercero'];
	$monto_deuda_smtr                                = $monto_deuda_smtr + $monto_deuda;
	$abonado_smtr                                    = $abonado_smtr + $abonado;
	$subtotal_smtr                                   = $subtotal_smtr + $subtotal;

    $sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

	$cliente                                         = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];

	$fecha_ini_seg                                   = strtotime($fecha_hoy);
	$fecha_fin_seg                                   = strtotime($fecha_pago);
	$fecha_dif_seg                                   = floor($fecha_fin_seg - $fecha_ini_seg);
	$dias_vence_vigencia                             = ($fecha_dif_seg / (60 * 60 * 24));

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
	
	if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '1') {
		$url_redirect = "../admin/cuentas_pagar_detalle_factura_directa_no_por_factura.php?cod_tercero=".$cod_tercero."&cod_cuentas_pagar=".$cod_cuentas_pagar.'&cod_estado_pago='.$cod_estado_pago."&pagina=".$pagina;
	} else {
		$url_redirect = "../admin/cuentas_pagar_detalle_factura.php?cod_tercero=".$cod_tercero."&cod_cuentas_pagar=".$cod_cuentas_pagar.'&cod_estado_pago='.$cod_estado_pago."&pagina=".$pagina;
	}
	//if ($cod_estado_pago == '0' && $subtotal <= '0') {
?>
	<tr>

		<td style="text-align: center;"><a href="<?php echo $url_redirect ?>" target="_blank"><img src="../imagenes/ver.png"></a></td>
		<td style="text-align: center;"><?php echo $cod_factura;?></td>
		<td style="text-align: left;"><?php echo $cliente;?></td>
		<td style="text-align: right;"><?php echo number_format($monto_deuda, 0, ",", ".")?></td>
		<td style="text-align: right;"><?php echo number_format($abonado, 0, ",", ".");?></td>
		<td style="text-align: right;"><?php echo number_format($subtotal, 0, ",", "."); ?></td>
		<td style="text-align: center;"><?php echo $fecha;?></td>
		<td style="text-align: center;"><?php echo $fecha_pago;?></td>
		<td style="text-align: center;"><?php echo $vendedor; ?></td>
		<td style="text-align: center;"><?php echo $cod_cuentas_pagar; ?></td>
	</tr>
	<?php //} ?>
<?php } ?>
</table>
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