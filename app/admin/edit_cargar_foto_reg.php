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
include("../admin/class_php/class.upload.php");
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_cliente                 = intval($_POST['cod_cliente']);
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cedula = "SELECT cedula FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$resultado_cedula = mysqli_query($conectar, $sql_cedula) or die(mysqli_error($conectar));
$data_cedula = mysqli_fetch_assoc($resultado_cedula);
$cedula = $data_cedula['cedula'];
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_historia_clinica        = intval($_POST['cod_historia_clinica']);
$pagina                      = addslashes($_POST['pagina']);
$time                        = time();
$fecha_ymdHis                = date("YmdHis");
$formato                     = 'jpg';
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura        = '../archivador/firma/miniatura/';
$ruta_foto_miniatura         = '../archivador/foto/miniatura/';
$ruta_firma_orig             = '../archivador/firma/original/';
$ruta_foto_orig              = '../archivador/foto/original/';
/* ----------------------------------------------------------------------------------------------------------/ */
$url_img_foto                = $_FILES['url_img_foto']['name'];
$formato_img2                = explode(".", $url_img_foto);
$formato_img2                = end($formato_img2);
$formato_orig2               = strtolower($formato_img2);
$nombre_foto_cryp            = crc32($url_img_foto);
$nombre_normal2              = $fecha_ymdHis.'_'.$cod_cliente.'_'.$nombre_foto_cryp.'_'.$cedula.'_ori'.'.'.$formato_orig2;
$url_img_foto_orig           = $ruta_foto_orig.$nombre_normal2;
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img_foto <> '') { 
copy($_FILES['url_img_foto']['tmp_name'], $url_img_foto_orig);

/* ----------------------------------------------------------------------------------------------------------/ */
$imagen_foto_miniatura                              = new upload($_FILES['url_img_foto']);
if ($imagen_foto_miniatura->uploaded) {
$imagen_foto_miniatura->image_resize         		= true; // default is true
$imagen_foto_miniatura->image_convert               = $formato;
$imagen_foto_miniatura->image_x              		= 200; // para el ancho a cortar
$imagen_foto_miniatura->image_ratio_y        		= true; // para que se ajuste dependiendo del ancho definido
$imagen_foto_miniatura->file_new_name_body   		= $fecha_ymdHis.'_'.$cod_cliente.'_'.$nombre_foto_cryp.'_'.$cedula.'_min'; // agregamos un nuevo nombre
$imagen_foto_miniatura->process($ruta_foto_miniatura);

$nombre_miniatura = $fecha_ymdHis.'_'.$cod_cliente.'_'.$nombre_foto_cryp.'_'.$cedula.'_min'.'.'.$formato;
$url_img_foto_min = $ruta_foto_miniatura.$nombre_miniatura;

$sql_data = sprintf("UPDATE tbl15_cliente SET url_img_foto = '$url_img_foto_orig', url_img_foto_min = '$url_img_foto_min' WHERE cod_cliente = '$cod_cliente'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = "UPDATE tbl15_historia_clinica SET url_img_foto_orig = '$url_img_foto_orig', url_img_foto_min = '$url_img_foto_min' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//echo 'La imagen_foto_miniatura ha sido subida';
} else { echo 'error : ' . $imagen_foto_miniatura->error; }
/* ----------------------------------------------------------------------------------------------------------/ */
}
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