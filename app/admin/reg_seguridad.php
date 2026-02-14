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
<a href="#"><h4>Registrar Tipo de Rol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_seguridad.php">Lista de Tipo de Rol</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF']; ?>

<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_seguridad_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th>NOMBRES</th>
			<th>APELLIDOS</th>
			<th>seguridad</th>
			<th>TIPO seguridad</th>
			<th>TIPO PROFESIONAL</th>
			<th style="text-align:center">REG</th>
		</tr></thead>
    <tbody>
    	<tr>
<td><input class="input-block-level" name="nombres" type="text" value="" placeholder="Escribe tus Nombres" required/></td>
<td><input class="input-block-level" name="apellidos" type="text" value="" placeholder="Escribe tus apellidos" required/></td>
<td><input class="input-block-level" name="cuenta" type="text" value="" placeholder="Escribe tu nombre de seguridad" required/></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><select name="cod_seguridad" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_seguridad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_seguridad, nombre_seguridad FROM tbl15_seguridad WHERE (cod_estado = '1') ORDER BY cod_seguridad ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_seguridad) and $cod_seguridad == $datos2['cod_seguridad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_seguridad'];
$nombre = $datos2['nombre_seguridad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->	
<td><select name="cod_tipo_historia_clinica" class="selectpicker" data-show-subtext="true" data-live-search="true">
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
<td><input type="text" name="reg_medico" value=""  class="input-block-level"/></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th>SEXO</th>
			<th>CONTRASEÑA</th>
			<th>CONTRASEÑA</th>
			<th>CORREO</th>
			<th>TELEFONO</th>
		</tr></thead>
    <tbody>
    	<tr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><select name="nombre_sexo" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_sexo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_sexo, nombre_sexo FROM tbl15_sexo ORDER BY cod_sexo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_sexo) and $cod_sexo == $datos2['cod_sexo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_sexo'];
$nombre = $datos2['nombre_sexo'];
echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td><input class="input-block-level" name="contrasena1" type="password" value="" placeholder="Escribe tu contraseña" required autofocus/></td>
<td><input class="input-block-level" name="contrasena2" type="password" value="" placeholder="Repita la contraseña" required autofocus/></td>
<td><input class="input-block-level" name="correo" type="email" value="" placeholder="ejemplo@dominio.com"/></td>
<td><input class="input-block-level" name="telefono" type="number" value="" placeholder="Escribe tu telefono" required autofocus/></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
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