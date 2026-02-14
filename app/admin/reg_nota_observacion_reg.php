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

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {


	if (isset($_POST['nombre_nota_observacion']) <> '') { $nombre_nota_observacion = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_nota_observacion'])); } else { $nombre_nota_observacion = ''; }
	if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = mysqli_real_escape_string($conectar, strip_tags($_POST['fecha_ymd'])); } else { $fecha_ymd = ''; }
	if (isset($_POST['cod_tipo_nota_observacion']) <> '') { $cod_tipo_nota_observacion = intval($_POST['cod_tipo_nota_observacion']); } else { $cod_tipo_nota_observacion = '1'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$fecha_hora                                         = date("H:i:s");
	$fecha_creacion                                     = date("Y-m-d");
	$tipo_soporte                                       = "NOTAS";
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_ymdHis                                       = date("YmdHis");
	$formato                                            = 'jpg';
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d");

	$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                    = '../archivador/firma/original/';
	$ruta_foto_orig                                     = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                       = explode(".", $url_img1);
		$formato_img2                                       = end($formato_img2);
		$nombre_normal2                                     = $tipo_soporte.'_'.$fecha_ymdHis.'.'.$formato_img2;
		$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                               = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                       = "";
		$formato_img2                                       = "";
		$nombre_normal2                                     = "";
		$url_img_orig_producto                              = "";
		$url_img_min_producto                               = "";
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, cod_tipo_nota_observacion, url_img_orig_producto, url_img_min_producto) 
	VALUES ('$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$cod_administrador', '$fecha_creacion', '$cod_tipo_nota_observacion', '$url_img_orig_producto', '$url_img_min_producto')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_nota_observacion.php">
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