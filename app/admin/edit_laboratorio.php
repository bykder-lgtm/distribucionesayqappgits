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
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Laboratorio</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$cod_laboratorio = intval($_GET['cod_laboratorio']);

$sql_cliente = "SELECT * FROM tbl15_laboratorio WHERE cod_laboratorio = '$cod_laboratorio'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_laboratorio = $datos_cliente['nombre_laboratorio'];
$cod_estado = $datos_cliente['cod_estado'];
$cod_tipo_historia_clinica = $datos_cliente['cod_tipo_historia_clinica'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_laboratorio_reg.php">
<fieldset>

<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th>NOMBRE LABORATORIO</th>
			<th>TIPO</th>
			<th>ESTADO</th>
		</tr></thead>
    <tbody>
    	<tr>
<td><input class="input-block-level" name="nombre_laboratorio" type="text" value="<?php echo $nombre_laboratorio ?>" required autofocus/></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><select name="cod_tipo_historia_clinica" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_tipo_historia_clinica)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_tipo_historia_clinica, nombre_tipo_historia_clinica FROM tbl15_tipo_historia_clinica ORDER BY cod_tipo_historia_clinica ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_tipo_historia_clinica) and $cod_tipo_historia_clinica == $datos2['cod_tipo_historia_clinica']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_tipo_historia_clinica'];
$nombre = $datos2['nombre_tipo_historia_clinica'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><select name="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_estado)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY cod_estado ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_estado'];
$nombre = $datos2['nombre_estado'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_laboratorio" value="<?php echo $cod_laboratorio ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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

</body>
</html>