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
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Videotutorial</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_videotutorial                = intval($_GET['cod_videotutorial']);

$sql_cliente = "SELECT * FROM tbl15_videotutorial WHERE cod_videotutorial = '$cod_videotutorial'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_videotutorial             = $datos_cliente['nombre_videotutorial'];
$descripcion_videotutorial        = $datos_cliente['descripcion_videotutorial'];
$url_videotutorial                = $datos_cliente['url_videotutorial'];
$cod_estado                       = $datos_cliente['cod_estado'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_videotutorial_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th>NOMBRE VIDEO</th>
			<th>DESCRIPCION VIDEO</th>
		</tr></thead>
    <tbody>
    	<tr>
<td><input class="input-block-level" name="nombre_videotutorial" type="text" value="<?php echo $nombre_videotutorial ?>" required autofocus/></td>
<td><textarea class="input-block-level" name="descripcion_videotutorial" rows="5" cols="10"><?php echo $descripcion_videotutorial ?></textarea></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th>URL VIDEO</th>
			<th>ESTADO VIDEO</th>
		</tr></thead>
    <tbody>
    	<tr>
<td><input class="input-block-level" name="url_videotutorial" type="text" value="<?php echo $url_videotutorial ?>"/></td>

<td><select name="cod_estado" id="cod_estado" onChange="conocer_cargo();" class="input-block-level" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_estado)) { echo "<option value='0' >Selecione</option>";
} else { echo  "<option value='0' selected >Seleccione</option>"; }
$consulta2_sql = ("SELECT nombre_estado, cod_estado FROM tbl15_estado ORDER BY cod_estado ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_estado) AND ($cod_estado == $datos2['cod_estado'])) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_estado'];
$nombre2 = $datos2['nombre_estado'];
echo "<option value='".$codigo."' $seleccionado >".$nombre2."</option>"; } ?>
</select></td>

    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_videotutorial" value="<?php echo $cod_videotutorial ?>">
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