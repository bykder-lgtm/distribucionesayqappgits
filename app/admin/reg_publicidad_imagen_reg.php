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
include("../admin/class_php/class.upload.php");

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	$pagina_else = addslashes($_POST['pagina']);
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_hora                      = date("H:i:s");
	$fecha_ymd                       = date("Y-m-d");
	$cod_estado                      = 1;
/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_firma_miniatura            = '../archivador/publicidad/miniatura/';
	$ruta_foto_miniatura             = '../archivador/publicidad/miniatura/';
	$ruta_firma_orig                 = '../archivador/publicidad/original/';
	$ruta_foto_orig                  = '../archivador/publicidad/original/';
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_max_imagen = "SELECT MAX(cod_posicion) AS cod_posicion FROM tbl15_publicidad";
	$consulta_max_imagen = mysqli_query($conectar, $sql_max_imagen) or die(mysqli_error($conectar));
	$info_max_imagen = mysqli_fetch_assoc($consulta_max_imagen);

	$cod_posicion                    = $info_max_imagen['cod_posicion']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_publicidad = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_publicidad'";
	$exec_autoincremento_publicidad = mysqli_query($conectar, $sql_autoincremento_publicidad) or die(mysqli_error($conectar));
	$datos_autoincremento_publicidad = mysqli_fetch_assoc($exec_autoincremento_publicidad);
	$cod_publicidad = $datos_autoincremento_publicidad['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 

		$formato_img2                                       = explode(".", $url_img1);
		$formato_img2                                       = end($formato_img2);
		$formato_orig2                                      = strtolower($formato_img2);
		$nombre_foto_cryp                                   = crc32($url_img1);
		$nombre_normal2                                     = $fecha_ymdHis.'_'.$cod_publicidad.'_ori'.'.'.$formato_orig2;
		$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;

		copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
/* ----------------------------------------------------------------------------------------------------------/ */
		$imagen_foto_miniatura                              = new upload($_FILES['url_img1']);
		if ($imagen_foto_miniatura->uploaded) {
			$imagen_foto_miniatura->image_resize                = true; // default is true
			$imagen_foto_miniatura->image_convert               = $formato;
			$imagen_foto_miniatura->image_x                     = 200; // para el ancho a cortar
			$imagen_foto_miniatura->image_ratio_y               = true; // para que se ajuste dependiendo del ancho definido
			$imagen_foto_miniatura->file_new_name_body          = $fecha_ymdHis.'_'.$cod_publicidad.'_min'; // agregamos un nuevo nombre
			$imagen_foto_miniatura->process($ruta_foto_miniatura);

			$nombre_miniatura                                   = $fecha_ymdHis.'_'.$cod_publicidad.'_min'.'.'.$formato;
			$url_img_min_producto                               = $ruta_foto_miniatura.$nombre_miniatura;
			$url_imagen                                         = $url_img_orig_producto;
			$url_imagen_min                                     = $url_img_min_producto;
			$fecha_time                                         = $time;
			$fecha_dmy                                          = $fecha_ymd;
			$hora                                               = $fecha_hora;

			$sql_data = "INSERT INTO tbl15_publicidad (url_imagen, url_imagen_min, cod_estado, cod_posicion, fecha_time, fecha_dmy, hora) 
			VALUES ('$url_imagen', '$url_imagen_min', '$cod_estado', '$cod_posicion', '$fecha_time', '$fecha_dmy', '$hora')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	} else { echo 'error : ' . $imagen_foto_miniatura->error; }
/* ----------------------------------------------------------------------------------------------------------/ */
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_publicidad_imagen.php?pagina=<?php echo $pagina_else ?>">
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