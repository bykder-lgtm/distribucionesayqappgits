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
<a href="#"><h4>Registrar Cargo a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_grupo_area_cargo.php">Lista de Cargo a Laborar</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_grupo_area_cargo_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead><tr>
		<th style="text-align:center">NOMBRE AREA A LABORAR</th>
		<th style="text-align:center">NOMBRE CARGO A LABORAR</th>
		<th style="text-align:center">FUNCIÓN CARGO A LABORAR</th>
	</tr></thead>
    <tbody><tr>
    	 <td style="text-align:center"><select name="cod_grupo_area" id="cod_grupo_area" onChange="conocer_cargo();" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_grupo_area)) { echo "<option value='0' >Selecione</option>";
} else { echo  "<option value='0' selected >Seleccione</option>"; }
$consulta2_sql = ("SELECT nombre_grupo_area, cod_grupo_area FROM tbl15_grupo_area ORDER BY nombre_grupo_area ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_grupo_area) AND ($cod_grupo_area == $datos2['cod_grupo_area'])) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_grupo_area'];
$nombre2 = $datos2['nombre_grupo_area'];
echo "<option value='".$codigo."' $seleccionado >".$nombre2."</option>"; } ?>
</select></td>
    	<td style="text-align:center"><input class="input-block-level" name="nombre_grupo_area_cargo" type="text" value="" required autofocus/></td>
    	<td style="text-align:center"><textarea name="funcion_grupo_area_cargo" rows="4" cols="20"></textarea></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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