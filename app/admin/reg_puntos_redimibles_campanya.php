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
<a href="#"><h4>Registrar Campaña Puntos Redimibles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_puntos_redimibles_campanya.php">Lista de Campaña Puntos Redimibles</h4></a>
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

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_puntos_redimibles_campanya_reg.php">
<fieldset>

<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE CAMPAÑA PUNTOS REDIMIBLES</th>
      		<th style="text-align:center">POR CADA ($PESOS)</th>
			<th style="text-align:center">GANAS (PUNTO)</th>
			<th style="text-align:center">EQUIVALENCIA EN PESOS DE UN PUNTO (VALOR DEL PUNTO)</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center;"><input class="input-block-level" name="nombre_puntos_redimibles_campanya" type="text" value="" placeholder="" required/></td>
			<td style="text-align:center;"><input class="input-block-level" name="valor_puntos_redimibles_campanya" type="number" value="" placeholder="" min="1" required/></td>
      		<td style="text-align:center;"><input class="input-block-level" name="cantidad_puntos_x_valor_redimibles_campanya" type="number" value="1" placeholder="" min="1" readonly required/></td>
      		<td style="text-align:center;"><input class="input-block-level" name="equivalencia_en_pesos_de_un_punto" type="number" value="" placeholder="" min="0" required/></td>
		</tr>
    	</tbody>
</table>

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