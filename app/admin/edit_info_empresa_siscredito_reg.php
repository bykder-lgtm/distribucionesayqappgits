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

	if (isset($_POST['cod_info_empresa']) <> '') { $cod_info_empresa = intval($_POST['cod_info_empresa']); } else { $cod_info_empresa = ''; }
	if (isset($_POST['resena_info_empresa']) <> '') { $resena_info_empresa = mysqli_real_escape_string($conectar, ($_POST['resena_info_empresa'])); } else { $resena_info_empresa = ''; }
	if (isset($_POST['mision_info_empresa']) <> '') { $mision_info_empresa = mysqli_real_escape_string($conectar, ($_POST['mision_info_empresa'])); } else { $mision_info_empresa = ''; }
	if (isset($_POST['vision_info_empresa']) <> '') { $vision_info_empresa = mysqli_real_escape_string($conectar, ($_POST['vision_info_empresa'])); } else { $vision_info_empresa = ''; }
	if (isset($_POST['direccion']) <> '') { $direccion = mysqli_real_escape_string($conectar, ($_POST['direccion'])); } else { $direccion = ''; }
	if (isset($_POST['localidad']) <> '') { $localidad = mysqli_real_escape_string($conectar, ($_POST['localidad'])); } else { $localidad = ''; }
	if (isset($_POST['correo']) <> '') { $correo = mysqli_real_escape_string($conectar, ($_POST['correo'])); } else { $correo = ''; }
	if (isset($_POST['tel1']) <> '') { $tel1 = mysqli_real_escape_string($conectar, ($_POST['tel1'])); } else { $tel1 = ''; }
	if (isset($_POST['tel2']) <> '') { $tel2 = mysqli_real_escape_string($conectar, ($_POST['tel2'])); } else { $tel2 = ''; }
	if (isset($_POST['politica_tratamiento_datos_info_empresa']) <> '') { $politica_tratamiento_datos_info_empresa = mysqli_real_escape_string($conectar, ($_POST['politica_tratamiento_datos_info_empresa'])); } else { $politica_tratamiento_datos_info_empresa = ''; }
	if (isset($_POST['declaracion_privacidad_info_empresa']) <> '') { $declaracion_privacidad_info_empresa = mysqli_real_escape_string($conectar, ($_POST['declaracion_privacidad_info_empresa'])); } else { $declaracion_privacidad_info_empresa = ''; }
	if (isset($_POST['politica_devolucion_info_empresa']) <> '') { $politica_devolucion_info_empresa = mysqli_real_escape_string($conectar, ($_POST['politica_devolucion_info_empresa'])); } else { $politica_devolucion_info_empresa = ''; }
	if (isset($_POST['info_entrega_info_empresa']) <> '') { $info_entrega_info_empresa = mysqli_real_escape_string($conectar, ($_POST['info_entrega_info_empresa'])); } else { $info_entrega_info_empresa = ''; }
	if (isset($_POST['politica_calidad_info_empresa']) <> '') { $politica_calidad_info_empresa = mysqli_real_escape_string($conectar, ($_POST['politica_calidad_info_empresa'])); } else { $politica_calidad_info_empresa = ''; }
	if (isset($_POST['principios_filosoficos_info_empresa']) <> '') { $principios_filosoficos_info_empresa = mysqli_real_escape_string($conectar, ($_POST['principios_filosoficos_info_empresa'])); } else { $principios_filosoficos_info_empresa = ''; }
	if (isset($_POST['url_redsocial_facebook']) <> '') { $url_redsocial_facebook = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_facebook'])); } else { $url_redsocial_facebook = ''; }
	if (isset($_POST['url_redsocial_twitter']) <> '') { $url_redsocial_twitter = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_twitter'])); } else { $url_redsocial_twitter = ''; }
	if (isset($_POST['url_redsocial_linkedin']) <> '') { $url_redsocial_linkedin = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_linkedin'])); } else { $url_redsocial_linkedin = ''; }
	if (isset($_POST['url_redsocial_skype']) <> '') { $url_redsocial_skype = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_skype'])); } else { $url_redsocial_skype = ''; }
	if (isset($_POST['url_redsocial_instagram']) <> '') { $url_redsocial_instagram = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_instagram'])); } else { $url_redsocial_instagram = ''; }
	if (isset($_POST['url_redsocial_pinterest']) <> '') { $url_redsocial_pinterest = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_pinterest'])); } else { $url_redsocial_pinterest = ''; }
	if (isset($_POST['url_redsocial_youtube']) <> '') { $url_redsocial_youtube = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_youtube'])); } else { $url_redsocial_youtube = ''; }
	if (isset($_POST['url_redsocial_tiktok']) <> '') { $url_redsocial_tiktok = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_tiktok'])); } else { $url_redsocial_tiktok = ''; }
	if (isset($_POST['url_redsocial_telegram']) <> '') { $url_redsocial_telegram = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_telegram'])); } else { $url_redsocial_telegram = ''; }
	if (isset($_POST['url_redsocial_whatsapp']) <> '') { $url_redsocial_whatsapp = mysqli_real_escape_string($conectar, ($_POST['url_redsocial_whatsapp'])); } else { $url_redsocial_whatsapp = ''; }
	if (isset($_POST['description']) <> '') { $description = mysqli_real_escape_string($conectar, ($_POST['description'])); } else { $description = ''; }
	if (isset($_POST['keywords']) <> '') { $keywords = mysqli_real_escape_string($conectar, ($_POST['keywords'])); } else { $keywords = ''; }
	if (isset($_POST['author']) <> '') { $author = mysqli_real_escape_string($conectar, ($_POST['author'])); } else { $author = ''; }
	if (isset($_POST['url_mapa1']) <> '') { $url_mapa1 = mysqli_real_escape_string($conectar, ($_POST['url_mapa1'])); } else { $url_mapa1 = ''; }
	if (isset($_POST['url_mapa2']) <> '') { $url_mapa2 = mysqli_real_escape_string($conectar, ($_POST['url_mapa2'])); } else { $url_mapa2 = ''; }

	$sql_data = 'UPDATE tbl15_info_empresa SET 
	resena_info_empresa = "'.$resena_info_empresa.'", 
	mision_info_empresa = "'.$mision_info_empresa.'", 
	vision_info_empresa = "'.$vision_info_empresa.'", 
	direccion = "'.$direccion.'", 
	localidad = "'.$localidad.'", 
	correo = "'.$correo.'", 
	tel1 = "'.$tel1.'", 
	tel2 = "'.$tel2.'", 
	politica_tratamiento_datos_info_empresa = "'.$politica_tratamiento_datos_info_empresa.'", 
	declaracion_privacidad_info_empresa = "'.$declaracion_privacidad_info_empresa.'", 
	politica_devolucion_info_empresa = "'.$politica_devolucion_info_empresa.'", 
	info_entrega_info_empresa = "'.$info_entrega_info_empresa.'", 
	politica_calidad_info_empresa = "'.$politica_calidad_info_empresa.'", 
	principios_filosoficos_info_empresa = "'.$principios_filosoficos_info_empresa.'", 
	url_redsocial_facebook = "'.$url_redsocial_facebook.'", 
	url_redsocial_twitter = "'.$url_redsocial_twitter.'", 
	url_redsocial_linkedin = "'.$url_redsocial_linkedin.'", 
	url_redsocial_skype = "'.$url_redsocial_skype.'", 
	url_redsocial_instagram = "'.$url_redsocial_instagram.'", 
	url_redsocial_pinterest = "'.$url_redsocial_pinterest.'", 
	url_redsocial_youtube = "'.$url_redsocial_youtube.'", 
	url_redsocial_tiktok = "'.$url_redsocial_tiktok.'", 
	url_redsocial_telegram = "'.$url_redsocial_telegram.'", 
	url_redsocial_whatsapp = "'.$url_redsocial_whatsapp.'", 
	description = "'.$description.'", 
	keywords = "'.$keywords.'", 
	author = "'.$author.'", 
	url_mapa1 = "'.$url_mapa1.'", 
	url_mapa2 = "'.$url_mapa2.'" 
	WHERE cod_info_empresa = "'.$cod_info_empresa.'"';
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