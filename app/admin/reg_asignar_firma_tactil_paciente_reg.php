<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {
include("../admin/class_php/class.upload.php");
//include("../admin/class_php/class.upload.php");
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_cliente                         = intval($_POST['cod_cliente']);
$cod_historia_clinica                = intval($_POST['cod_historia_clinica']);
/* ---------------------------------------------------------------------------------------------------------- */
$fecha_ymd_hora                      = date("Y/m/d H:i:s");
$formato                             = 'jpg';
$time                                = time();
$fecha_ymdHis                        = date("YmdHis");
$fecha_time                          = strtotime($fecha_ymd_hora);
$fecha_ymd                           = date("Y/m/d", $fecha_time);
$fecha_dmy                           = date("d/m/Y", $fecha_time);
$fecha_mes                           = date("m/Y", $fecha_time);
$fecha_anyo                          = date("Y", $fecha_time);
$hora                                = date("H:i", $fecha_time);
$fecha_reg_time                      = time();
$cuenta                              = $cuenta_actual;
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura                = '../archivador/firma/miniatura/';
$ruta_foto_miniatura                 = '../archivador/foto/miniatura/';
$ruta_firma_orig                     = '../archivador/firma/original/';
$ruta_foto_orig                      = '../archivador/foto/original/';
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
if (isset($_FILES['url_img_firma']['name'])) {
$url_img_firma                       = $_FILES['url_img_firma']['name'];
$formato_img1                        = explode(".", $url_img_firma);
$formato_img1                        = end($formato_img1);
$formato_orig1                       = strtolower($formato_img1);
$nombre_firma_cryp                   = crc32($url_img_firma);
$nombre_normal1                      = $fecha_ymdHis.'_'.$cod_historia_clinica.'_'.$cod_cliente.'_'.$nombre_firma_cryp.'_'.$cedula.'_ori'.'.'.$formato_orig1;
$url_img_firma_orig                  = $ruta_firma_orig.$nombre_normal1;
$url_img_firma_min                   = $ruta_firma_orig.$nombre_normal1;
if ($url_img_firma <> '') { copy($_FILES['url_img_firma']['tmp_name'], $url_img_firma_orig); }
}
/* ----------------------------------------------------------------------------------------------------------/ */
if (isset($_POST['url_img_firma']) <> '') { 
$url_img_firma                   = addslashes($_POST['url_img_firma']);
$url_img_firma_orig              = $url_img_firma;
$url_img_firma_min               = $url_img_firma;
} 
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img_firma <> '') {
$actualizar_firma_cliente = "UPDATE tbl15_cliente SET url_img_firma = '$url_img_firma_orig', url_img_firma_min = '$url_img_firma_min' WHERE cod_cliente = '$cod_cliente'";
$resultado_firma_cliente = mysqli_query($conectar, $actualizar_firma_cliente) or die(mysqli_error($conectar));
 	
$actualizar_firma_historia = "UPDATE tbl15_historia_clinica SET url_img_firma_orig = '$url_img_firma_orig', url_img_firma_min = '$url_img_firma_min' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_firma_historia = mysqli_query($conectar, $actualizar_firma_historia) or die(mysqli_error($conectar));
}
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$url_redict = "../admin/vista_previa_foto_firma_tactil_paciente_historia_clinica.php?cod_historia_clinica=".$cod_historia_clinica."&cod_cliente=".$cod_cliente;
?>
<h3>Se ha guardado correctamente la información</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="1; <?php echo $url_redict ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="1; <?php echo $pagina_else?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
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