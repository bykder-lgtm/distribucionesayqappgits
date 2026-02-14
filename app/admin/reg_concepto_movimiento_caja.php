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
<a href="#"><h4>Registrar Concepto Movimiento de Caja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_movimiento_contable_cuenta_personal.php">.</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina          = $_SERVER['PHP_SELF']; 
$tipo_puc_get    = "";
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_concepto_movimiento_caja_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center;">NOMBRE</th>
			<th style="text-align:center;">TIPO</th>
			<th style="text-align:center;">ID PUC</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center;"><input class="input-block-level" name="nombre_concepto_movimiento_caja" type="text" value="" placeholder="" required/></td>
			<td style="text-align:center;">
		        <select name="nombre_tipo_puc" id="nombre_tipo_puc" class="selectpicker" data-show-subtext="true" data-live-search="true">
		            <?php if (isset($tipo_puc_get)) { echo "<option value='' $seleccionado >Escoger</option>"; } else { echo "<option value='' $seleccionado >Escoger</option>"; }
		            $consulta2_sql = "SELECT * FROM tbl15_tipo_puc WHERE (cod_estado = '1')";
		            $consulta2 = mysqli_query($conectar, $consulta2_sql);
		            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		            if(isset($tipo_puc_get) AND $tipo_puc_get == $datos2['nombre_tipo_puc']) {
		            $seleccionado = "selected"; } else { $seleccionado = ""; }
		            $codigo = $datos2['nombre_tipo_puc'];
		            $nombre = $datos2['nombre_tipo_puc'];
		            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		        </select>
			</td>
			<td style="text-align:center;"><input class="input-block-level" name="cod_puc" type="text" value="" placeholder="" /></td>
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