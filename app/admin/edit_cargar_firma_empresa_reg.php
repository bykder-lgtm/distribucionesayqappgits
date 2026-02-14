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
$cod_info_empresa                 = intval($_POST['cod_info_empresa']);
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_propietario_nit = "SELECT propietario_nit FROM tbl15_info_empresa WHERE cod_info_empresa = '$cod_info_empresa'";
$resultado_propietario_nit = mysqli_query($conectar, $sql_propietario_nit) or die(mysqli_error($conectar));
$data_propietario_nit = mysqli_fetch_assoc($resultado_propietario_nit);
$propietario_nit = $data_propietario_nit['propietario_nit'];
/* ----------------------------------------------------------------------------------------------------------/ */
//$pagina                      = addslashes($_POST['pagina']).'?pagina=lista_paciente.php';
$time                        = time();
$fecha_ymdHis                = date("YmdHis");
$formato                     = 'jpg';
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura        = '../imagenes/firma_empresa/';
$ruta_foto_miniatura         = '../imagenes/firma_empresa/';
$ruta_firma_orig             = '../imagenes/firma_empresa/';
$ruta_foto_orig              = '../imagenes/firma_empresa/';
/* ----------------------------------------------------------------------------------------------------------/ */
$url_img_firma               = $_FILES['url_img_firma']['name'];
$formato_img1                = explode(".", $url_img_firma);
$formato_img1                = end($formato_img1);
$formato_orig1               = strtolower($formato_img1);
$nombre_firma_cryp           = crc32($url_img_firma);
$nombre_normal1              = $fecha_ymdHis.'_'.$cod_info_empresa.'_ori'.'.'.$formato_orig1;
$url_img_firma_orig          = $ruta_firma_orig.$nombre_normal1;
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img_firma <> '') { 
copy($_FILES['url_img_firma']['tmp_name'], $url_img_firma_orig);
/* ----------------------------------------------------------------------------------------------------------/ */
$imagen_firma_miniatura                             = new upload($_FILES['url_img_firma']);
if ($imagen_firma_miniatura->uploaded) {
$imagen_firma_miniatura->image_resize         		= true; // default is true
$imagen_firma_miniatura->image_convert              = $formato;
$imagen_firma_miniatura->image_x              		= 200; // para el ancho a cortar
$imagen_firma_miniatura->image_ratio_y        		= true; // para que se ajuste dependiendo del ancho definido
$imagen_firma_miniatura->file_new_name_body   		= $fecha_ymdHis.'_'.$cod_info_empresa.'_min'; // agregamos un nuevo nombre
$imagen_firma_miniatura->process($ruta_firma_miniatura);

$nombre_miniatura = $fecha_ymdHis.'_'.$cod_info_empresa.'_min'.'.'.$formato;
$url_img_firma_prof_min = $ruta_firma_miniatura.$nombre_miniatura;

$sql_data = sprintf("UPDATE tbl15_info_empresa SET propietario_url_firma = '$url_img_firma_prof_min' WHERE cod_info_empresa = '$cod_info_empresa'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
} else { echo 'error : ' . $imagen_firma_miniatura->error; }
/* ----------------------------------------------------------------------------------------------------------/ */
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_empresa.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_empresa.php">
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