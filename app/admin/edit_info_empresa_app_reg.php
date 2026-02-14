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

	$cod_info_empresa                            = intval($_POST['cod_info_empresa']);
	$nombre                                      = addslashes($_POST['nombre']);
	$eslogan                                     = addslashes($_POST['eslogan']);
	$titulo                                      = addslashes($_POST['titulo']);
	$cabecera                                    = addslashes($_POST['cabecera']);
	$nit_empresa                                 = addslashes($_POST['nit_empresa']);
	$telefono                                    = addslashes($_POST['telefono']);
	$celular                                     = addslashes($_POST['celular']);
	$tel1                                        = addslashes($_POST['tel1']);
	$tel2                                        = addslashes($_POST['tel2']);
	$tel3                                        = addslashes($_POST['tel3']);
	$tel4                                        = addslashes($_POST['tel4']);
	$direccion                                   = addslashes($_POST['direccion']);
	$dir_oficiana1                               = addslashes($_POST['dir_oficiana1']);
	$dir_oficiana2                               = addslashes($_POST['dir_oficiana2']);
	$dir_oficiana3                               = addslashes($_POST['dir_oficiana3']);
	$dir_oficiana4                               = addslashes($_POST['dir_oficiana4']);
	$keywords                                    = addslashes($_POST['keywords']);
	$description                                 = addslashes($_POST['description']);
	$url_mapa1                                   = addslashes($_POST['url_mapa1']);
	$url_mapa2                                   = addslashes($_POST['url_mapa2']);
	$resena_info_empresa                         = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['resena_info_empresa']));
	$mision_info_empresa                         = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['mision_info_empresa']));
	$vision_info_empresa                         = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['vision_info_empresa']));
	$principios_filosoficos_info_empresa         = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['principios_filosoficos_info_empresa']));
	$declaracion_privacidad_info_empresa         = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['declaracion_privacidad_info_empresa']));
	$politica_devolucion_info_empresa            = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['politica_devolucion_info_empresa']));
	$politica_calidad_info_empresa               = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['politica_calidad_info_empresa']));
	$info_legal                                  = mysqli_real_escape_string($conectar, str_replace('"', "'", $_POST['info_legal']));
	$pagina                                      = addslashes($_POST['pagina']);

	$sql_data = sprintf("UPDATE tbl15_info_empresa SET nombre = '$nombre', eslogan = '$eslogan', titulo = '$titulo', cabecera = '$cabecera', nit_empresa = '$nit_empresa', 
	telefono = '$telefono', celular = '$celular', tel1 = '$tel1', tel2 = '$tel2', tel3 = '$tel3', tel4 = '$tel4', 
	direccion = '$direccion', dir_oficiana1 = '$dir_oficiana1', dir_oficiana2 = '$dir_oficiana2', dir_oficiana3 = '$dir_oficiana3', dir_oficiana4 = '$dir_oficiana4', 
	keywords = '$keywords', description = '$description', url_mapa1 = '$url_mapa1', url_mapa2 = '$url_mapa2', resena_info_empresa = '$resena_info_empresa', 
	mision_info_empresa = '$mision_info_empresa', vision_info_empresa = '$vision_info_empresa', principios_filosoficos_info_empresa = '$principios_filosoficos_info_empresa', 
	declaracion_privacidad_info_empresa = '$declaracion_privacidad_info_empresa', politica_devolucion_info_empresa = '$politica_devolucion_info_empresa', 
	politica_calidad_info_empresa = '$politica_calidad_info_empresa', info_legal = '$info_legal' 
	WHERE cod_info_empresa = '$cod_info_empresa'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_empresa_app.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_empresa_app.php">
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