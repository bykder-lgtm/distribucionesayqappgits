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

<div class="breadcrumbs"><a href="../admin/menu_eliminar_venta.php"><h4>Reasignar cod factura ventas automatico</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_POST['nombre_tipo_factura'])) {
	$nombre_tipo_factura                                  = addslashes($_POST['nombre_tipo_factura']);
} else {
	$nombre_tipo_factura                                  = 'POS';
}
?>
<form name="formulario" method="post" enctype="multipart/form-data" action="../admin/reasignar_cod_factura_ventas_automatico_reg.php">
	<table class="table table-striped">
	<thead>
	<tr>
		<th style="text-align:center;">Tipo de Factura</th>
		<th style="text-align:center;"></th>
	</tr>
	<tr>
	    <td style="text-align:center;">
	        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
	            <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo ""; }
	            $consulta2_sql = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura WHERE (nombre_tipo_factura = '$nombre_tipo_factura') ORDER BY nombre_tipo_factura DESC";
	            $consulta2 = mysqli_query($conectar, $consulta2_sql);
	            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
	            $seleccionado = "selected"; } else { $seleccionado = ""; }
	            $codigo = $datos2['nombre_tipo_factura'];
	            $nombre = $datos2['nombre_tipo_factura'];
	            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	        </select>
	    </td>
		<td style="text-align:center;"><input type="submit" value="Reasignar Cod Facturas de Venta" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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