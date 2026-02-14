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
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Unidad Medida</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_tipo_unidad_medida = intval($_GET['cod_tipo_unidad_medida']);

$sql_cliente = "SELECT * FROM tbl15_tipo_unidad_medida WHERE cod_tipo_unidad_medida = '$cod_tipo_unidad_medida'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_tipo_unidad_medida                = $datos_cliente['nombre_tipo_unidad_medida'];
$nombre_completo_tipo_unidad_medida       = $datos_cliente['nombre_completo_tipo_unidad_medida'];
$valor_equivalencia                       = $datos_cliente['valor_equivalencia'];
$nombre_equivalencia                      = $datos_cliente['nombre_equivalencia'];
$cod_estado                               = $datos_cliente['cod_estado'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_tipo_unidad_medida_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE UNIDAD ABREV</th>
			<th style="text-align:center">NOMBRE UNIDAD MEDIDA</th>
			<th style="text-align:center">VALOR</th>
			<th style="text-align:center">EQUIVALENCIA</th>
			<th style="text-align:center">ESTADO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
    		<td style="text-align:center"><input class="input-block-level" name="nombre_tipo_unidad_medida" type="text" value="<?php echo $nombre_tipo_unidad_medida ?>" required/></td>
    		<td style="text-align:center"><input class="input-block-level" name="nombre_completo_tipo_unidad_medida" type="text" value="<?php echo $nombre_completo_tipo_unidad_medida ?>"/></td>
    		<td style="text-align:center"><input class="input-block-level" name="valor_equivalencia" type="text" value="<?php echo $valor_equivalencia ?>"/></td>
    		<td style="text-align:center"><input class="input-block-level" name="nombre_equivalencia" type="text" value="<?php echo $nombre_equivalencia ?>"/></td>
			<td style="text-align:center">
				<select name="cod_estado" id="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
				    <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
				    $consulta2_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
				    $consulta2 = mysqli_query($conectar, $consulta2_sql);
				    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
				    if(isset($cod_estado) AND $cod_estado == $datos2['cod_estado']) {
				    $seleccionado = "selected"; } else { $seleccionado = ""; }
				    $codigo = $datos2['cod_estado'];
				    $nombre = $datos2['nombre_estado'];
				    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_tipo_unidad_medida" value="<?php echo $cod_tipo_unidad_medida ?>">
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