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
<a href="../admin/lista_subproducto.php"><h4>Modulo Cargar SubProductos</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cuenta                             = ($cuenta_actual);
$smtr                               = 0;
$contador_mesas_array               = 1;
$nombre_tipo_producto               = "PRODUCTO";
?>
<div class="table-responsive">
<form method="GET" name="formulario_de_actualizacion" action="../admin/reg_cargar_subproducto_principal_reg.php">
	<table class="table table-striped">
		<tr>
	        <th style="text-align:left; width:300px">PRODUCTO PRINCIPAL: 
	            <select name="cod_producto_barra" id="cod_producto_barra" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1">
	                <?php if (isset($cod_producto)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
	                $consulta2_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto FROM tbl15_producto ORDER BY nombre_producto ASC";
	                $consulta2 = mysqli_query($conectar, $consulta2_sql);
	                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	                if(isset($cod_producto) AND $cod_producto == $datos2['cod_producto']) {
	                $seleccionado = "selected"; } else { $seleccionado = ""; }
	                $codigo = $datos2['cod_producto_barra'];
	                $nombre = $datos2['cod_producto_barra'].' | '.$datos2['nombre_producto'].' | '.$datos2['precio_venta_producto'];
	                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	            </select>
	        </th>
			<th style="text-align:center;"><input type="submit" value="CARGAR" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></th>
		</tr>
	</table>
	<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
	<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
</form>
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
</body>
</html>