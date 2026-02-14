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
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);

$sql_historia_clinica = "SELECT * FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_cliente = $info_historia_clinica['cod_cliente'];
$motivo = $info_historia_clinica['motivo'];
$nombre_laboratorio = $info_historia_clinica['nombre_laboratorio'];
$analisis = $info_historia_clinica['analisis'];
$nombre_medicamento = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica = $info_historia_clinica['descripcion_ayuda_diagnostica'];
$fecha_reg_time = $info_historia_clinica['fecha_reg_time'];
$fecha_time = $info_historia_clinica['fecha_time'];
$fecha_ymd = $info_historia_clinica['fecha_ymd'];
$fecha_dmy = $info_historia_clinica['fecha_dmy'];
$hora = $info_historia_clinica['hora'];
$cuenta = $info_historia_clinica['cuenta'];

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cedula = $datos_cliente['cedula'];
$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$apellido2 = $datos_cliente['apellido2'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_historia_clinica_reg.php">
<fieldset>

<p><a>CC:</a>
<td><?php echo ($cedula) ?></td></p>

<p><a>Nombres:</a>
<td><?php echo ($nombres.' '.$apellido1.' '.$apellido2) ?></td></p>

<p><a>Fecha:</a></p>
<td><input type="text" name="fecha_dmy" id="name" value="<?php echo ($fecha_dmy) ?>"  class="input-block-level" /></td>
<br><br>

<p><a>Motivo De Consulta:</a></p>
<td><textarea rows="11" name="motivo" class="input-block-level"><?php echo ($motivo) ?></textarea></td>
<br><br>

<p><a>Laboratorio:</a></p>
<td><textarea rows="11" name="nombre_laboratorio" class="input-block-level"><?php echo ($nombre_laboratorio) ?></textarea></td>
<br><br>

<p><a>Medicamentos:</a></p>
<td><textarea rows="11" name="nombre_medicamento" class="input-block-level"><?php echo ($nombre_medicamento) ?></textarea></td>
<br><br>

<p><a>Descripción Medicamentos:</a></p>
<td><textarea rows="11" name="descripcion_medicamento" class="input-block-level"><?php echo ($descripcion_medicamento) ?></textarea></td>
<br><br>

<p><a>Ayudas Diagnósticas:</a></p>
<td><textarea rows="11" name="nombre_ayuda_diagnostica" class="input-block-level"><?php echo ($nombre_ayuda_diagnostica) ?></textarea></td>
<br><br>

<p><a>Descripción Ayudas Diagnósticas:</a></p>
<td><textarea rows="11" name="descripcion_ayuda_diagnostica" class="input-block-level"><?php echo ($descripcion_ayuda_diagnostica) ?></textarea></td>
<hr>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
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
motivo = CKEDITOR.replace("motivo");
CKFinder.setupCKEditor(motivo, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
nombre_laboratorio = CKEDITOR.replace("nombre_laboratorio");
CKFinder.setupCKEditor(nombre_laboratorio, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
nombre_medicamento = CKEDITOR.replace("nombre_medicamento");
CKFinder.setupCKEditor(nombre_medicamento, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
descripcion_medicamento = CKEDITOR.replace("descripcion_medicamento");
CKFinder.setupCKEditor(descripcion_medicamento, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
nombre_ayuda_diagnostica = CKEDITOR.replace("nombre_ayuda_diagnostica");
CKFinder.setupCKEditor(nombre_ayuda_diagnostica, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
descripcion_ayuda_diagnostica = CKEDITOR.replace("descripcion_ayuda_diagnostica");
CKFinder.setupCKEditor(descripcion_ayuda_diagnostica, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
}
</script>

</body>
</html>