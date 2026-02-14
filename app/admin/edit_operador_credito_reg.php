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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

	$cod_operador_credito                 = intval($_POST['cod_operador_credito']);
	$nombre1_tercero                      = (addslashes($_POST['nombre1_tercero']));
	$identificacion_tercero               = (addslashes($_POST['identificacion_tercero']));
	$digito_tercero                       = (addslashes($_POST['digito_tercero']));
	$direccion_tercero                    = (addslashes($_POST['direccion_tercero']));
	$telefono1_tercero                    = (addslashes($_POST['telefono1_tercero']));
	$correo_tercero                       = (addslashes($_POST['correo_tercero']));
	$cod_pais                             = (addslashes($_POST['cod_pais']));
	$cod_departamento                     = (addslashes($_POST['cod_departamento']));
	$cod_municipio                        = (addslashes($_POST['cod_municipio']));
	$nombre_tipo_cliente                  = (addslashes($_POST['nombre_tipo_cliente']));
	$nombre_tipo_regimen                  = (addslashes($_POST['nombre_tipo_regimen']));
	$nombre_tipo_impuesto                 = (addslashes($_POST['nombre_tipo_impuesto']));
	$pagina                               = (addslashes($_POST['pagina']));
	$nombre_operador_credito              = $nombre1_tercero;

	$sql_data = sprintf("UPDATE tbl15_operador_credito SET nombre_operador_credito = UPPER('$nombre_operador_credito'), nombre1_tercero = UPPER('$nombre1_tercero'), 
	identificacion_tercero = '$identificacion_tercero', digito_tercero = '$digito_tercero', direccion_tercero = '$direccion_tercero', telefono1_tercero = '$telefono1_tercero', 
	correo_tercero = '$correo_tercero', cod_pais = '$cod_pais', cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio', nombre_tipo_cliente = '$nombre_tipo_cliente', 
	nombre_tipo_regimen = '$nombre_tipo_regimen', nombre_tipo_impuesto = '$nombre_tipo_impuesto'
	WHERE cod_operador_credito = '$cod_operador_credito'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>
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