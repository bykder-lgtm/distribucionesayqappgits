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

<div class="breadcrumbs"></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET["llave"])) {
	$cod_info_factura_compra                            = intval($_GET["llave"]);
	$tab                                                = addslashes($_GET["tab"]);
	$tipo                                               = addslashes($_GET["tipo"]);
	$campo                                              = addslashes($_GET["campo"]);
	$pagina                                             = addslashes($_GET["pagina"]);

	$sql_cuentas_pagar = "SELECT cod_cuentas_pagar, cod_factura, cod_tercero, monto_deuda, abonado, subtotal, fecha_pago FROM tbl15_cuentas_pagar WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta_cuentas_pagar = mysqli_query($conectar, $sql_cuentas_pagar) or die(mysqli_error($conectar));
	$matriz_cuentas_pagar = mysqli_fetch_assoc($consulta_cuentas_pagar);

	$cod_cuentas_pagar                                  = $matriz_cuentas_pagar['cod_cuentas_pagar'];
	$cod_factura                                        = $matriz_cuentas_pagar['cod_factura'];
	$cod_tercero                                        = $matriz_cuentas_pagar['cod_tercero'];
	$monto_deuda                                        = $matriz_cuentas_pagar['monto_deuda'];
	$abonado                                            = $matriz_cuentas_pagar['abonado'];
	$subtotal                                           = $matriz_cuentas_pagar['subtotal'];
	$fecha_pago                                         = $matriz_cuentas_pagar['fecha_pago'];

    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

    $nombre1_tercero                                    = $datos_tipo_nota_observacion['nombre1_tercero'];
?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th style="text-align:center">EXISTE UNA CUENTA POR PAGAR</th>
			</tr>
			<tr>
				<th style="text-align:center">DESEAS ELIMINARLA TAMBIEN?</th>
			</tr>
			<tr>
				<th style="text-align:center">CUENTA POR PAGAR</th>
			</tr>
		</thead>
	</table>
 	 	
	<table class="table table-hover">
		<thead>
			<tr>
				<th style="text-align:center">ID</th>
				<th style="text-align:center">FACTURA</th>
				<th style="text-align:center">PROVEEDOR</th>
				<th style="text-align:center">TOTAL DEUDA</th>
				<th style="text-align:center">TOTAL ABONADO</th>
				<th style="text-align:center">PENDIENTE</th>
				<th style="text-align:center">FECHA</th>
			</tr>
			<tr>
				<td style="text-align:center"><?php echo $cod_cuentas_pagar; ?></td>
				<td style="text-align:center"><?php echo $cod_factura; ?></td>
				<td style="text-align:center"><?php echo $nombre1_tercero; ?></td>
				<td style="text-align:center"><?php echo number_format($monto_deuda, 0, ",", "."); ?></td>
				<td style="text-align:center"><?php echo number_format($abonado, 0, ",", "."); ?></td>
				<td style="text-align:center"><?php echo number_format($subtotal, 0, ",", "."); ?></td>
				<td style="text-align:center"><?php echo $fecha_pago; ?></td>
			</tr>
		</thead>
	</table>

	<table class="table table-hover">
		<thead>
			<tr>
				<th style="text-align:center"><a href="../admin/eliminar_compra.php?llave=<?php echo $cod_info_factura_compra; ?>&tab=<?php echo $tab; ?>&campo=<?php echo $campo; ?>&tipo=<?php echo $tipo; ?>&cod_cuentas_pagar=<?php echo $cod_cuentas_pagar; ?>&pagina=<?php echo $pagina; ?>">ELIMINAR SOLO LA FACTURA DE COMPRA</a></th>
				<th style="text-align:center"><a href="../admin/eliminar_compra_credito_cuenta_pagar_reg.php?llave=<?php echo $cod_info_factura_compra; ?>&tab=<?php echo $tab; ?>&campo=<?php echo $campo; ?>&tipo=<?php echo $tipo; ?>&cod_cuentas_pagar=<?php echo $cod_cuentas_pagar; ?>&pagina=<?php echo $pagina; ?>">ELIMINAR LA FACTURA DE COMPRA Y LA CUENTA POR COBRAR</a></th>
			</tr>
		</thead>
	</table>
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