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

if (isset($_POST["cod_producto_imagen"])) {

	$cod_producto_imagen             = intval($_POST['cod_producto_imagen']);
	$pagina                          = addslashes($_POST['pagina']);
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	/* ----------------------------------------------------------------------------------------------------------/ */
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_hora                      = date("H:i:s");
	$fecha_ymd                       = date("Y-m-d");
	/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
	$ruta_firma_orig                 = '../archivador/firma/original/';
	$ruta_foto_orig                  = '../archivador/foto/original/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	$mostrar_datos_sql = "SELECT * FROM tbl15_producto_imagen WHERE cod_producto_imagen = '$cod_producto_imagen'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_producto                    = $matriz_consulta['cod_producto'];
	$cod_producto_barra              = $matriz_consulta['cod_producto_barra'];
	$url_img_orig_producto           = $matriz_consulta['url_img_orig_producto'];
	$url_img_min_producto            = $matriz_consulta['url_img_min_producto'];
	$url_img_producto_orig           = $url_img_orig_producto;
	$url_img_producto_min            = $url_img_min_producto;
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 

	$formato_img2                    = explode(".", $url_img1);
	$formato_img2                    = end($formato_img2);
	$formato_orig2                   = strtolower($formato_img2);
	$nombre_foto_cryp                = crc32($url_img1);
	$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_ori'.'.'.$formato_orig2;
	$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;

	copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
	/* ----------------------------------------------------------------------------------------------------------/ */
	$imagen_foto_miniatura                              = new upload($_FILES['url_img1']);
	if ($imagen_foto_miniatura->uploaded) {
		$imagen_foto_miniatura->image_resize                = true; // default is true
		$imagen_foto_miniatura->image_convert               = $formato;
		$imagen_foto_miniatura->image_x                     = 350; // para el ancho a cortar
		$imagen_foto_miniatura->image_ratio_y               = true; // para que se ajuste dependiendo del ancho definido
		$imagen_foto_miniatura->file_new_name_body          = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_min'; // agregamos un nuevo nombre
		$imagen_foto_miniatura->process($ruta_foto_miniatura);

		$nombre_miniatura = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_min'.'.'.$formato;
		$url_img_min_producto = $ruta_foto_miniatura.$nombre_miniatura;

		$sql_data = sprintf("UPDATE tbl15_producto_imagen SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' WHERE cod_producto_imagen = '$cod_producto_imagen'");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	} else { 
		echo 'error : ' . $imagen_foto_miniatura->error; 
	}
	/* ----------------------------------------------------------------------------------------------------------/ */
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_producto_imagen.php?cod_producto=<?php echo $cod_producto ?>&pagina=<?php echo $pagina ?>">
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