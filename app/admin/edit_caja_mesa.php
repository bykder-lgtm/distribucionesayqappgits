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
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar <?php echo $nombre_concepto_multi_virtual; ?></h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_caja_mesa             = intval($_GET['cod_caja_mesa']);

$mostrar_datos_sql = "SELECT * FROM tbl15_caja_mesa WHERE cod_caja_mesa = '$cod_caja_mesa'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_base_caja                      = $matriz_consulta['cod_base_caja'];
$cod_administrador                  = $matriz_consulta['cod_administrador'];

?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_caja_mesa_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<!--<th style="text-align:center">ID</th>-->
			<th style="text-align:center">USUARIO</th>
			<th style="text-align:center"><?php echo $nombre_concepto_multi_virtual; ?></th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<!--<td style="text-align:center;"><?php echo ($cod_caja_mesa) ?></td>-->
		    <td style="text-align:center;">
		        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" tabindex="1" required>
		            <?php if (isset($cod_administrador)) { echo ""; } else { echo  ""; }
		            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
		            $consulta2 = mysqli_query($conectar, $consulta2_sql);
		            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
		            $seleccionado = "selected"; } else { $seleccionado = ""; }
		            $codigo = $datos2['cod_administrador'];
		            $nombre = $datos2['cuenta'];
		            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		        </select>
		    </td>
			<td><input type="number" name="cod_base_caja" value="<?php echo ($cod_base_caja) ?>"  class="input-block-level" required/></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_caja_mesa" value="<?php echo $cod_caja_mesa ?>"/>
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