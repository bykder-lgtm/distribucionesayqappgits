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

$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_inmueble_barra']) <> '') { $cod_inmueble_barra = mysqli_real_escape_string($conectar, addslashes(($_POST['cod_inmueble_barra']))); } else { $cod_inmueble_barra = ''; }
	if (isset($_POST['nombre_inmueble']) <> '') { $nombre_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['nombre_inmueble']))); } else { $nombre_inmueble = ''; }
	if (isset($_POST['descripcion_inmueble']) <> '') { $descripcion_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['descripcion_inmueble']))); } else { $descripcion_inmueble = ''; }
	if (isset($_POST['direccion_inmueble']) <> '') { $direccion_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['direccion_inmueble']))); } else { $direccion_inmueble = ''; }
	if (isset($_POST['precio_alquiler_inmueble']) <> '') { $precio_alquiler_inmueble = intval($_POST['precio_alquiler_inmueble']); } else { $precio_alquiler_inmueble = ''; }
	if (isset($_POST['latitud_inmueble']) <> '') { $latitud_inmueble = mysqli_real_escape_string($conectar, ($_POST['latitud_inmueble'])); } else { $latitud_inmueble = ''; }
	if (isset($_POST['longitud_inmueble']) <> '') { $longitud_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['longitud_inmueble']))); } else { $longitud_inmueble = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
	if (isset($_POST['cod_tipo_inmueble']) <> '') { $cod_tipo_inmueble = intval($_POST['cod_tipo_inmueble']); } else { $cod_tipo_inmueble = ''; }
	if (isset($_POST['cod_estado_inmueble']) <> '') { $cod_estado_inmueble = intval($_POST['cod_estado_inmueble']); } else { $cod_estado_inmueble = '1'; }

	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_FILES['archivo_adjunto']) <> '') { $archivo_adjunto = $_FILES['archivo_adjunto']['name']; } else { $archivo_adjunto = ''; }

	$creador                         = $cuenta_actual;
	$fecha_compra                    = date("Y-m-d");
	$fecha_creacion                  = date("Y-m-d H:i:s");
	$fecha_hora                      = date("H:i:s");
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_ymd                       = date("Y-m-d");
	$ruta_archivo_adjunto_orig       = '../archivador/documentos/';

	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_inmueble'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_inmueble = $datos_autoincremento_sesion['AUTO_INCREMENT'];

	$agreg = "INSERT INTO tbl15_inmueble (cod_inmueble_barra, nombre_inmueble, descripcion_inmueble, direccion_inmueble, precio_alquiler_inmueble, latitud_inmueble, longitud_inmueble, cod_tercero, cod_tipo_inmueble, cod_estado_inmueble) 
	VALUES ('$cod_inmueble_barra', UPPER('$nombre_inmueble'), UPPER('$descripcion_inmueble'), '$direccion_inmueble', '$precio_alquiler_inmueble', '$latitud_inmueble', '$longitud_inmueble', '$cod_tercero', '$cod_tipo_inmueble', '$cod_estado_inmueble')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
	$ruta_firma_orig                 = '../archivador/firma/original/';
	$ruta_foto_orig                  = '../archivador/foto/original/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_max_imagen = "SELECT MAX(cod_posicion) AS cod_posicion FROM tbl15_inmueble_foto WHERE cod_inmueble = '$cod_inmueble'";
	$consulta_max_imagen = mysqli_query($conectar, $sql_max_imagen) or die(mysqli_error($conectar));
	$info_max_imagen = mysqli_fetch_assoc($consulta_max_imagen);

	$cod_posicion                       = $info_max_imagen['cod_posicion']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 

		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$formato_orig2                   = strtolower($formato_img2);
		$nombre_foto_cryp                = crc32($url_img1);
		$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_inmueble.'_ori'.'.'.$formato_orig2;
		$url_img_orig_inmueble           = $ruta_foto_orig.$nombre_normal2;
		copy($_FILES['url_img1']['tmp_name'], $url_img_orig_inmueble);
/* ----------------------------------------------------------------------------------------------------------/ */
		$imagen_foto_miniatura                              = new upload($_FILES['url_img1']);
		if ($imagen_foto_miniatura->uploaded) {
			$imagen_foto_miniatura->image_resize                = true; // default is true
			$imagen_foto_miniatura->image_convert               = $formato;
			$imagen_foto_miniatura->image_x                     = 200; // para el ancho a cortar
			$imagen_foto_miniatura->image_ratio_y               = true; // para que se ajuste dependiendo del ancho definido
			$imagen_foto_miniatura->file_new_name_body          = $fecha_ymdHis.'_'.$cod_inmueble.'_min'; // agregamos un nuevo nombre
			$imagen_foto_miniatura->process($ruta_foto_miniatura);

			$nombre_miniatura                                   = $fecha_ymdHis.'_'.$cod_inmueble.'_min'.'.'.$formato;
			$url_img_min_inmueble                               = $ruta_foto_miniatura.$nombre_miniatura;

			$sql_data = sprintf("UPDATE tbl15_inmueble SET url_img_orig_inmueble = '$url_img_orig_inmueble', url_img_min_inmueble = '$url_img_min_inmueble' WHERE cod_inmueble = '$cod_inmueble'");
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

			$sql_data = "INSERT INTO tbl15_inmueble_foto (cod_inmueble, nombre_inmueble, nombre_producto, url_img_orig_inmueble, url_img_min_inmueble, fecha_ymd, fecha_hora, cod_posicion) 
			VALUES ('$cod_inmueble', '$nombre_inmueble', '$nombre_producto', '$url_img_orig_inmueble', '$url_img_min_inmueble', '$fecha_ymd', '$fecha_hora', '$cod_posicion')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		} else { 
			echo 'error : ' . $imagen_foto_miniatura->error; 
		}
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_inmueble.php">
<?php 
} 
?>
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