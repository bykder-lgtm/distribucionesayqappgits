<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$pagina = $_SERVER['PHP_SELF']; 
?>

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_certificado_apoyo_emocional_reg.php">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">Nombres y Apellidos</th>
			<th style="text-align:center">Numero de Documento</th>
		</tr>
		<tr>
			<td style="text-align:center"><input class="input-block-level" name="nombre_propietario_mascota" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="documento_propietario_mascota" type="number" value="" required /></td>
		</tr>
		<tr>
			<th style="text-align:center">Dirección</th>
			<th style="text-align:center">Correo Electronico</th>
		</tr>
		<tr>
			<td style="text-align:center"><input class="input-block-level" name="direccion_propietario_mascota" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="correo_propietario_mascota" type="text" value="" /></td>
		</tr>
		<tr>
			<th style="text-align:center">Nombre de la Mascota</th>
			<th style="text-align:center">Edad de la Mascota (Años)</th>
		</tr>
		<tr>
			<td style="text-align:center"><input class="input-block-level" name="nombre_mascota" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="edad_mascota" type="number" value="" step="any" lang="en" min="1" max="999" oninput="validity.valid||(value='');" required /></td>
		</tr>
		<tr>
			<th style="text-align:center">Raza de la Mascota</th>
			<th style="text-align:center">Color de la Mascota</th>
		</tr>
		<tr>
			<td style="text-align:center"><input class="input-block-level" name="nombre_raza_mascota" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="color_mascota" type="text" value="" required /></td>
		</tr>
		<tr>
			<th style="text-align:center">Peso de la Mascota (Kilos)</th>
			<th style="text-align:center">Talla de la Mascota</th>
		</tr>
		<tr>
			<td style="text-align:center"><input class="input-block-level" name="peso_mascota" type="number" value="" step="any" lang="en" min="1" max="999" oninput="validity.valid||(value='');" required /></td>
			<td style="text-align:center">
				<select name="talla_mascota" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
					<?php if (isset($nombre_talla)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_talla, nombre_talla FROM tbl15_talla WHERE (cod_estado = '1') ORDER BY cod_talla ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_talla) and $nombre_talla == $datos2['nombre_talla']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_talla'];
					$nombre = $datos2['nombre_talla'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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
<script src="js/jquery-ui.js"></script>


<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
	descripcion_producto = CKEDITOR.replace("descripcion_producto");
	CKFinder.setupCKEditor(descripcion_producto, 'ckeditor/ckfinder');
}
</script>

</body>
</html>