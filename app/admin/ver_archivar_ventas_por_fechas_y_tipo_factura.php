<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
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

<div class="breadcrumbs"><a href="../admin/archivar_ventas_por_fechas_y_tipo_factura.php"><h4>Lista de Facturas de Venta a Archivar</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_POST['fecha_ymd_venta_producto_ini'])) { 
    $fecha_ymd_venta_producto_ini            = addslashes($_POST['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_POST['fecha_ymd_venta_producto_fin']);
    $fecha_mes_venta_producto_ini            = date("Y-m", strtotime($fecha_ymd_venta_producto_ini));
    $fecha_mes_venta_producto_fin            = date("Y-m", strtotime($fecha_ymd_venta_producto_fin));
    $nombre_tipo_factura                     = addslashes($_POST['nombre_tipo_factura']);

    if ($nombre_tipo_factura=='0') {
        $filtro_consulta_nombre_tipo_factura = "";
        $filtro_consulta_nombre_tipo_factura_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
    }
?>
	<table class="table table-striped">
		<tr>
			<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR FACTURA</strong></a></td>
		</tr>
	</table>

	<table class="table table-striped">
	<tr>
	<td style="text-align:right;"><input type="checkbox" id="seleccionar-todos"><strong> Seleccionar todos</strong></td>
	</tr>
	</table>

	<form method="post" name="formulario" action="../admin/archivar_ventas_por_fechas_y_tipo_factura_reg.php">
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Factura</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tercero</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Recibido</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Fecha</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Hora</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Vendedor</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Pago</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Forma Pago</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Factura</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Check</a></th>
					<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">ID</a></th>
				</tr>
			</thead>
			<tbody>
		<?php
		$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta 
		WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_nombre_tipo_factura AND (nombre_estado_factura = 'CERRADA') 
		ORDER BY cod_info_factura_venta DESC";
		$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
		while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

		$cod_info_factura_venta        = $datos_total_tipo_factura['cod_info_factura_venta'];
		$cod_factura                   = $datos_total_tipo_factura['cod_factura'];
		$cod_tercero                   = $datos_total_tipo_factura['cod_tercero'];
		$vlr_cancelado                 = $datos_total_tipo_factura['vlr_cancelado'];
		$vlr_vuelto                    = $datos_total_tipo_factura['vlr_vuelto'];
		$fecha_anyo                    = $datos_total_tipo_factura['fecha_anyo'];
		$fecha_hora                    = $datos_total_tipo_factura['fecha_hora'];
		$cod_tipo_pago                 = $datos_total_tipo_factura['cod_tipo_pago'];
		$cod_administrador             = $datos_total_tipo_factura['cod_administrador'];
		$total_precio_compra           = $datos_total_tipo_factura['total_precio_compra'];
		$total_precio_venta            = $datos_total_tipo_factura['total_precio_venta'];
		$cod_dependencia               = $datos_total_tipo_factura['cod_dependencia'];
		$cod_tipo_forma_pago           = $datos_total_tipo_factura['cod_tipo_forma_pago'];
		$nombre_tipo_factura           = $datos_total_tipo_factura['nombre_tipo_factura'];
		$nombre_tipo_moneda            = $datos_total_tipo_factura['nombre_tipo_moneda'];
		$total_datos_data              = $datos_total_tipo_factura['total_datos_data'];

		$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
		$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
		$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

		$nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

		$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
		$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
		$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

		$cuenta                        = $datos_administrador['cuenta'];

		$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
		$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
		$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

		$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

		$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
		$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
		$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

		$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
		?>
			<tr>
				<td style="text-align:center"><?php echo ($cod_factura)?></td>
				<td style="text-align:left"><?php echo $nombre_tercero?></td>
				<td style="text-align:right"><?php echo number_format($total_precio_venta, 0, ",", ".")?></td>
				<td style="text-align:right"><?php echo number_format($vlr_cancelado, 0, ",", ".")?></td>
				<td style="text-align:center"><?php echo $fecha_anyo?></td>
				<td style="text-align:center"><?php echo $fecha_hora?></td>
				<td style="text-align:center"><?php echo $cuenta?></td>
				<td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
				<td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
				<td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
				<td style="text-align:center"><div id="listado"><input name="cod_info_factura_venta[]" type="checkbox" value='<?php echo $cod_info_factura_venta;?>'></div></td>
				<td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
			</tr>
		<?php } ?>
		</tbody>
		</table>


		<table class="table table-striped">
			<tr>
				<td style="text-align:center;"><input type="submit" name="submit" value="ARCHIVAR FACTURAS ESCOGIDAS" title="ARCHIVAR FACTURAS ESCOGIDAS" /></td>
			</tr>
			<input name="fecha_ymd_venta_producto_ini" type="hidden" value='<?php echo $fecha_ymd_venta_producto_ini;?>'>
			<input name="fecha_ymd_venta_producto_fin" type="hidden" value='<?php echo $fecha_ymd_venta_producto_fin;?>'>
			<input name="cod_administrador" type="hidden" value='<?php echo $cod_administrador;?>'>
			<input name="cod_tercero" type="hidden" value='<?php echo $cod_tercero;?>'>
			<input name="cod_tipo_pago" type="hidden" value='<?php echo $cod_tipo_pago;?>'>
			<input name="cod_tipo_forma_pago" type="hidden" value='<?php echo $cod_tipo_forma_pago;?>'>
			<input name="cod_dependencia" type="hidden" value='<?php echo $cod_dependencia;?>'>
			<input name="nombre_tipo_factura" type="hidden" value='<?php echo $nombre_tipo_factura;?>'>
			<input name="nombre_tipo_compra" type="hidden" value='<?php echo $nombre_tipo_compra;?>'>
			<input name="pagina" type="hidden" value='<?php echo $pagina;?>'>
		</table>
	</form>

	<script>
	  $(function(){
	    $('#seleccionar-todos').change(function() {
	      $('#listado > input[type=checkbox]').prop('checked', $(this).is(':checked'));
	    });
	  });
	</script>
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