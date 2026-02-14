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
<a class="btn btn-primary" href="#"><h6></h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if (isset($_GET['pagina'])) {
$pagina                      = $_GET['pagina'];
?>
<form method="post" name="formulario" action="../admin/pregunta_producto_copia_inventario_alfabetico_por_letra_reg.php">
<table class="table table-striped">
    <tr>
        <th style="text-align:center">DESEA HACER UNA COPIA DEL INVENTARIO ACTUAL POR LETRA?</th>
    </tr>
    <tr>
		<th style="text-align:center">HACER INVENTARIO DE LOS PRODUCTOS INICIADOS POR LA LETRA:
			<select name="nombre_letra_alfabeto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
				<?php if (isset($nombre_letra_alfabeto)) { echo ""; } else { echo ""; }
				$consulta2_sql = ("SELECT cod_letra_alfabeto, nombre_letra_alfabeto FROM tbl15_letra_alfabeto ORDER BY cod_letra_alfabeto ASC");
				$consulta2 = mysqli_query($conectar, $consulta2_sql);
				while ($datos2 = mysqli_fetch_assoc($consulta2)) {
				if(isset($nombre_letra_alfabeto) and $nombre_letra_alfabeto == $datos2['nombre_letra_alfabeto']) {
				$seleccionado = "selected"; } else { $seleccionado = ""; }
				$codigo = $datos2['nombre_letra_alfabeto'];
				$nombre = $datos2['nombre_letra_alfabeto'];
				echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			</select>
			<input type="submit" value="Crear Inventario" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
			<input name="pagina" type="hidden" value="<?php echo $pagina ?>" />
		</th>
    </tr>
</table>
</form>
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