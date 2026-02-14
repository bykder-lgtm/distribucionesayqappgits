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

<div class="breadcrumbs">
<a href="../admin/menu_archivar_venta.php"><h4>Archivar Facturas de Venta Por Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<?php if ($cod_estado_reporte_venta_archivada == '1') { ?><a href="../admin/reporte_venta_archivadas_fechas.php">Reporte de Ventas Archivadas<?php } ?></h4></a>
</div>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_POST['fecha_ymd_venta_producto_ini'])) {
	$fecha_ymd_venta_producto_ini                         = addslashes($_POST['fecha_ymd_venta_producto_ini']);
	$fecha_ymd_venta_producto_fin                         = addslashes($_POST['fecha_ymd_venta_producto_fin']);
	$nombre_tipo_factura                                  = addslashes($_POST['nombre_tipo_factura']);
} else {
	$fecha_ymd_venta_producto_ini                         = date("Y-m-d");
	$fecha_ymd_venta_producto_fin                         = date("Y-m-d");
	$nombre_tipo_factura                                  = '';
}
?>
<form name="formulario" method="post" enctype="multipart/form-data" action="../admin/ver_archivar_ventas_por_fechas_y_tipo_factura.php">
	<table class="table table-striped">
	<thead>
	<tr>
		<th style="text-align:center;">Fecha Inicial</th>
		<th style="text-align:center;">Fecha Final</th>
		<th style="text-align:center;">Tipo de Factura</th>
		<th style="text-align:center;"></th>
	</tr>
	<tr>
		<td style="text-align:center;"><input type="date" name="fecha_ymd_venta_producto_ini" id="fecha_ymd_venta_producto_ini" value="<?php echo $fecha_ymd_venta_producto_ini ?>" class="form-control" required ></td>
		<td style="text-align:center;"><input type="date" name="fecha_ymd_venta_producto_fin" id="fecha_ymd_venta_producto_fin" value="<?php echo $fecha_ymd_venta_producto_fin ?>" class="form-control" required ></td>
	    <td style="text-align:center;">
	        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
	            <?php if (isset($nombre_tipo_factura)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
	            $consulta2_sql = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura WHERE (cod_estado = '1') ORDER BY nombre_tipo_factura DESC";
	            $consulta2 = mysqli_query($conectar, $consulta2_sql);
	            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
	            $seleccionado = "selected"; } else { $seleccionado = ""; }
	            $codigo = $datos2['nombre_tipo_factura'];
	            $nombre = $datos2['nombre_tipo_factura'];
	            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	        </select>
	    </td>
		<td style="text-align:center;"><input type="submit" value="Ver Facturas de Venta" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
	</tr>
	</thead>
	</table>
</form>

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