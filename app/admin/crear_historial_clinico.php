<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<link rel="stylesheet" href="../estilo_css/ui-darkness-jquery-ui-1.8.14.custom.css">

<link rel="stylesheet" href="../estilo_css/estilo_multiselect_chosen.css">
<link rel="stylesheet" href="../estilo_css/prism.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<!--
link href="../estilo_css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../estilo_css/ui-darkness-theme.css">
<link rel="stylesheet" href="../estilo_css/ui-darkness-jquery-ui-1.8.14.custom.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui-1.8.23.custom.css">
-->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Crear Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cliente = intval($_GET['cod_cliente']);

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cedula = $datos_cliente['cedula'];
$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$apellido2 = $datos_cliente['apellido2'];

$fecha_hoy = date("d/m/Y");
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/crear_historial_clinico_reg.php">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<p><a>CC:</a>
<td><?php echo ($cedula) ?></td></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<p><a>Nombres:</a>
<td><?php echo ($nombres.' '.$apellido1.' '.$apellido2) ?></td></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<p><a>Fecha:</a></p>
<td><input class="form-control" id="fecha_dmy" name="fecha_dmy" placeholder="dd/mm/aaaa" type="text" value="<?php echo $fecha_hoy ?>" required/></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>
<p><a>Motivo De Consulta:</a></p>
<td><textarea rows="11" name="motivo" class="input-block-level"><p><strong>Motivo De Consulta</strong>:</p></textarea></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<p><a>Laboratorio:</a>
<div><select name="nombre_laboratorio[]" data-placeholder="Listado Laboratorio" class="chosen-select" multiple tabindex="4">
<?php 	
$consulta2_sql = "SELECT cod_laboratorio, nombre_laboratorio FROM tbl15_laboratorio WHERE cod_estado_laboratorio = '1' ORDER BY cod_laboratorio ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_laboratorio = $datos2['cod_laboratorio'];
$nombre_laboratorio = $datos2['nombre_laboratorio'];
?>
<option value="<?php echo $nombre_laboratorio ?>"><?php echo $nombre_laboratorio ?></option>
<?php } ?>
</select></div></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<p><a>Medicamentos:</a>
<div>1:<select name="cod_medicamento[]" id="lista_medicamento1" data-placeholder="Listado de Medicamentos" class="chosen-select" tabindex="4">
<?php   
$consulta2_sql = "SELECT cod_medicamento, nombre_medicamento FROM tbl15_medicamento WHERE cod_estado = '1' ORDER BY nombre_medicamento ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_medicamento = $datos2['cod_medicamento'];
$nombre_medicamento = $datos2['nombre_medicamento'];
?>
<option value="<?php echo $nombre_medicamento ?>"><?php echo $nombre_medicamento ?></option>
<?php } ?>
<option value="0" selected>Selecione...</option>
</select></div></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div>2:<select name="cod_medicamento[]" id="lista_medicamento2" data-placeholder="Listado de Medicamentos" class="chosen-select" tabindex="4">
<?php   
$consulta2_sql = "SELECT cod_medicamento, nombre_medicamento FROM tbl15_medicamento WHERE cod_estado = '1' ORDER BY nombre_medicamento ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_medicamento = $datos2['cod_medicamento'];
$nombre_medicamento = $datos2['nombre_medicamento'];
?>
<option value="<?php echo $nombre_medicamento ?>"><?php echo $nombre_medicamento ?></option>
<?php } ?>
<option value="0" selected>Selecione...</option>
</select></div></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div>3:<select name="cod_medicamento[]" id="lista_medicamento3" data-placeholder="Listado de Medicamentos" class="chosen-select" tabindex="4">
<?php   
$consulta2_sql = "SELECT cod_medicamento, nombre_medicamento FROM tbl15_medicamento WHERE cod_estado = '1' ORDER BY nombre_medicamento ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_medicamento = $datos2['cod_medicamento'];
$nombre_medicamento = $datos2['nombre_medicamento'];
?>
<option value="<?php echo $nombre_medicamento ?>"><?php echo $nombre_medicamento ?></option>
<?php } ?>
<option value="0" selected>Selecione...</option>
</select></div></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div>4:<select name="cod_medicamento[]" id="lista_medicamento4" data-placeholder="Listado de Medicamentos" class="chosen-select" tabindex="4">
<?php   
$consulta2_sql = "SELECT cod_medicamento, nombre_medicamento FROM tbl15_medicamento WHERE cod_estado = '1' ORDER BY nombre_medicamento ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_medicamento = $datos2['cod_medicamento'];
$nombre_medicamento = $datos2['nombre_medicamento'];
?>
<option value="<?php echo $nombre_medicamento ?>"><?php echo $nombre_medicamento ?></option>
<?php } ?>
<option value="0" selected>Selecione...</option>
</select></div></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div>5:<select name="cod_medicamento[]" id="lista_medicamento5" data-placeholder="Listado de Medicamentos" class="chosen-select" tabindex="4">
<?php   
$consulta2_sql = "SELECT cod_medicamento, nombre_medicamento FROM tbl15_medicamento WHERE cod_estado = '1' ORDER BY nombre_medicamento ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_medicamento = $datos2['cod_medicamento'];
$nombre_medicamento = $datos2['nombre_medicamento'];
?>
<option value="<?php echo $nombre_medicamento ?>"><?php echo $nombre_medicamento ?></option>
<?php } ?>
<option value="0" selected>Selecione...</option>
</select></div></p>

<td><input class="input-block-level" name="nombre_medicamento[]" id="nombre_medicamento1" type="text" value=""/></td>
<br>
<td><input class="input-block-level" name="nombre_medicamento[]" id="nombre_medicamento2" type="text" value=""/></td>
<br>
<td><input class="input-block-level" name="nombre_medicamento[]" id="nombre_medicamento3" type="text" value=""/></td>
<br>
<td><input class="input-block-level" name="nombre_medicamento[]" id="nombre_medicamento4" type="text" value=""/></td>
<br>
<td><input class="input-block-level" name="nombre_medicamento[]" id="nombre_medicamento5" type="text" value=""/></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><textarea rows="11" name="descripcion_medicamento" class="input-block-level"><p></p></textarea></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>
<p><a>Ayudas Diagnosticas:</a>
<div><select name="cod_ayuda_diagnostica[]" data-placeholder="Listado Ayudas Diagnosticas" class="chosen-select" multiple tabindex="4">
<?php 	
$consulta2_sql = "SELECT cod_ayuda_diagnostica, nombre_ayuda_diagnostica FROM tbl15_ayuda_diagnostica WHERE cod_estado = '1' ORDER BY nombre_ayuda_diagnostica ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_ayuda_diagnostica = $datos2['cod_ayuda_diagnostica'];
$nombre_ayuda_diagnostica = $datos2['nombre_ayuda_diagnostica'];
?>
<option value="<?php echo $cod_ayuda_diagnostica ?>"><?php echo $nombre_ayuda_diagnostica ?></option>
<?php } ?>
</select></div></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><textarea rows="11" name="descripcion_ayuda_diagnostica" class="input-block-level"><p></p></textarea></td>
<hr>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-ui.js"></script>
<!--
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="../js/jquery-ui.js"></script>
-->
<!-- <script src="../js/jquery-1.12.4.js"></script>-->
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script>
$( function() {
$( "#fecha_dmy" ).datepicker();
} );
</script>
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
window.onload = function() {
//-------------------------------------------------------------------------------------------------//
motivo = CKEDITOR.replace("motivo");
CKFinder.setupCKEditor(motivo, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
enfermedad_actual = CKEDITOR.replace("enfermedad_actual");
CKFinder.setupCKEditor(enfermedad_actual, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
antecedente = CKEDITOR.replace("antecedente");
CKFinder.setupCKEditor(antecedente, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
examen_fisico = CKEDITOR.replace("examen_fisico");
CKFinder.setupCKEditor(examen_fisico, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
analisis = CKEDITOR.replace("analisis");
CKFinder.setupCKEditor(analisis, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
//diagnostico = CKEDITOR.replace("diagnostico");
//CKFinder.setupCKEditor(diagnostico, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
descripcion_medicamento = CKEDITOR.replace("descripcion_medicamento");
CKFinder.setupCKEditor(descripcion_medicamento, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
descripcion_ayuda_diagnostica = CKEDITOR.replace("descripcion_ayuda_diagnostica");
CKFinder.setupCKEditor(descripcion_ayuda_diagnostica, 'ckeditor/ckfinder');
//-------------------------------------------------------------------------------------------------//
plan = CKEDITOR.replace("plan");
CKFinder.setupCKEditor(plan, 'ckeditor/ckfinder');
}
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
// Change es un tbl15_evento que se ejecuta cada vez que se cambia el valor de un elemento (input, select, etc).
$('#lista_medicamento1').change(function(e) {
$('#nombre_medicamento1').val($(this).val());

var lista_medicamento1 = document.getElementById("lista_medicamento1");
var nombre_medicamento1 = document.getElementById("nombre_medicamento1");

});
$('#lista_medicamento2').change(function(e) {
$('#nombre_medicamento2').val($(this).val());

var lista_medicamento2 = document.getElementById("lista_medicamento2");
var nombre_medicamento2 = document.getElementById("nombre_medicamento2");

});
$('#lista_medicamento3').change(function(e) {
$('#nombre_medicamento3').val($(this).val());

var lista_medicamento3 = document.getElementById("lista_medicamento3");
var nombre_medicamento3 = document.getElementById("nombre_medicamento2");

});
$('#lista_medicamento4').change(function(e) {
$('#nombre_medicamento4').val($(this).val());

var lista_medicamento4 = document.getElementById("lista_medicamento4");
var nombre_medicamento4 = document.getElementById("nombre_medicamento4");

});
$('#lista_medicamento5').change(function(e) {
$('#nombre_medicamento5').val($(this).val());

var lista_medicamento5 = document.getElementById("lista_medicamento5");
var nombre_medicamento5 = document.getElementById("nombre_medicamento5");

});
});
</script>

</body>
</html>