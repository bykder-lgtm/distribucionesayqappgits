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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Plantilla Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_tipo_historia_clinica = intval($_GET['cod_tipo_historia_clinica']);

$sql_historia_clinica = "SELECT cod_tipo_historia_clinica, nombre_tipo_historia_clinica, estructura_tipo_historia_clinica, estructura_evolucion FROM tbl15_tipo_historia_clinica WHERE cod_tipo_historia_clinica = '$cod_tipo_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$nombre_tipo_historia_clinica = $info_historia_clinica['nombre_tipo_historia_clinica'];
$estructura_tipo_historia_clinica = $info_historia_clinica['estructura_tipo_historia_clinica'];
$estructura_evolucion = $info_historia_clinica['estructura_evolucion'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_plantilla_historia_clinica_reg.php">
<fieldset>

<table border="1" class="table table-responsive">
		<thead><tr><th><input type="text" name="nombre_tipo_historia_clinica" value="<?php echo $nombre_tipo_historia_clinica ?>" class="input-block-level" required></th>
	</tr>
<th>ESTRUCTURA HISTORIA CLINICA</th>
</thead>
    <tbody><tr><td><textarea rows="11" name="estructura_tipo_historia_clinica" class="input-block-level"><?php echo ($estructura_tipo_historia_clinica) ?></textarea></td></tr></tbody>
</table>

<table border="1" class="table table-responsive">
		<thead><tr><th>ESTRUCTURA EVOLUCIÓN</th></tr></thead>
    <tbody><tr><td><textarea rows="11" name="estructura_evolucion" class="input-block-level"><?php echo ($estructura_evolucion) ?></textarea></td></tr></tbody>
</table>
<hr>
<input type="hidden" name="cod_tipo_historia_clinica" value="<?php echo $cod_tipo_historia_clinica ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
window.onload = function() {
//-------------------------------------------------------------------------------------------------//
estructura_tipo_historia_clinica = CKEDITOR.replace("estructura_tipo_historia_clinica");
CKFinder.setupCKEditor(estructura_tipo_historia_clinica, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
estructura_evolucion = CKEDITOR.replace("estructura_evolucion");
CKFinder.setupCKEditor(estructura_evolucion, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
}
</script>

</body>
</html>