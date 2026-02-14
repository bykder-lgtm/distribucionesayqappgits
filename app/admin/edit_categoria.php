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
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Categoria</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_categoria             = intval($_GET['cod_categoria']);

$mostrar_datos_sql = "SELECT * FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_categoria                      = $matriz_consulta['nombre_categoria'];
$cod_estado                            = $matriz_consulta['cod_estado'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_categoria_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">COD</th>
			<th style="text-align:center">NOMBRE</th>
			<th style="text-align:center">ESTADO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td><?php echo ($cod_categoria) ?></td>
<td><input type="text" name="nombre_categoria" value="<?php echo ($nombre_categoria) ?>"  class="input-block-level" required/></td>
<td>        
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
<hr>
<input type="hidden" name="cod_categoria" value="<?php echo $cod_categoria ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
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