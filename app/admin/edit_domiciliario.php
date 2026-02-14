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
<?php
$cod_domiciliario              = intval($_GET['cod_domiciliario']);
$pagina                                          = addslashes($_GET['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_domiciliario WHERE cod_domiciliario = '$cod_domiciliario'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_domiciliario                                = $matriz_consulta['cod_domiciliario'];
$nombres_domiciliario                            = $matriz_consulta['nombres_domiciliario'];
$apellidos_domiciliario                          = $matriz_consulta['apellidos_domiciliario'];
$cod_estado                                      = $matriz_consulta['cod_estado'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Domiciliarios</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_domiciliario_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
      		<th style="text-align:center">NOMBRES DOMICILIARIO</th>
      		<th style="text-align:center">APELLIDOS DOMICILIARIO</th>
		    <th style="text-align:center">ESTADO</th>
		</tr>
	</thead>
    <tbody>
	    <tr>
      		<td style="text-align:center;"><input class="input-block-level" name="nombres_domiciliario" type="text" value="<?php echo $nombres_domiciliario ?>" placeholder="" required/></td>
      		<td style="text-align:center;"><input class="input-block-level" name="apellidos_domiciliario" type="text" value="<?php echo $apellidos_domiciliario ?>" placeholder="" /></td>

		    <td style="text-align:center;">
		        <select name="cod_estado" class="input-block-level">
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
<input type="hidden" name="cod_domiciliario" value="<?php echo $cod_domiciliario ?>"/>
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