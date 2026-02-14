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

	if (isset($_POST['cod_banner_slider']) <> '') { $cod_banner_slider = intval($_POST['cod_banner_slider']); } else { $cod_banner_slider = ''; }
	if (isset($_POST['nombre_banner_slider']) <> '') { $nombre_banner_slider = mysqli_real_escape_string($conectar, ($_POST['nombre_banner_slider'])); } else { $nombre_banner_slider = ''; }
	if (isset($_POST['texto_boton_accion_banner_slider']) <> '') { $texto_boton_accion_banner_slider = mysqli_real_escape_string($conectar, ($_POST['texto_boton_accion_banner_slider'])); } else { $texto_boton_accion_banner_slider = ''; }
	if (isset($_POST['url_accion_banner_slider']) <> '') { $url_accion_banner_slider = mysqli_real_escape_string($conectar, ($_POST['url_accion_banner_slider'])); } else { $url_accion_banner_slider = ''; }
	if (isset($_POST['posicion_banner_slider']) <> '') { $posicion_banner_slider = mysqli_real_escape_string($conectar, ($_POST['posicion_banner_slider'])); } else { $posicion_banner_slider = ''; }
	if (isset($_POST['cod_estado']) <> '') { $cod_estado = mysqli_real_escape_string($conectar, ($_POST['cod_estado'])); } else { $cod_estado = ''; }

	$sql_data = 'UPDATE tbl15_banner_slider SET nombre_banner_slider = "'.$nombre_banner_slider.'", texto_boton_accion_banner_slider = "'.$texto_boton_accion_banner_slider.'", 
	url_accion_banner_slider = "'.$url_accion_banner_slider.'", posicion_banner_slider = "'.$posicion_banner_slider.'", cod_estado = "'.$cod_estado.'" 
	WHERE cod_banner_slider = "'.$cod_banner_slider.'"';
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$pagina                       = addslashes($_POST['pagina']);
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