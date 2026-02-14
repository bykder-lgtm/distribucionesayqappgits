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
$cod_historia_clinica            = intval($_POST['cod_historia_clinica']);
$cod_cliente                     = intval($_POST['cod_cliente']);
$nombre_tipo_certificado         = addslashes($_POST['nombre_tipo_certificado']);
$nombre_archivo_adjunto          = addslashes($_POST['nombre_archivo_adjunto']);
$descripcion_archivo_adjunto     = addslashes($_POST['descripcion_archivo_adjunto']);
$pagina                          = ($_POST['pagina']);
$tbl15_archivo_adjunto                 = $_FILES['tbl15_archivo_adjunto']['name'];
$pagina_redirect                 = $pagina."?cod_historia_clinica=".$cod_historia_clinica."&cod_cliente=".$cod_cliente."&pagina=".$pagina;
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cedula = "SELECT cedula FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$resultado_cedula = mysqli_query($conectar, $sql_cedula) or die(mysqli_error($conectar));
$data_cedula = mysqli_fetch_assoc($resultado_cedula);

$cedula                          = $data_cedula['cedula'];

$sql_info_historia_clinica = "SELECT cod_empresa, motivo_consulta FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$cons_info_historia_clinica = mysqli_query($conectar, $sql_info_historia_clinica) or die(mysqli_error($conectar));
$dato_info_historia_clinica = mysqli_fetch_assoc($cons_info_historia_clinica);

$cod_empresa                     = $dato_info_historia_clinica['cod_empresa'];
$motivo_consulta                 = $dato_info_historia_clinica['motivo_consulta'];
/* ----------------------------------------------------------------------------------------------------------/ */
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$fecha_creacion                  = date("Y-m-d");
$fecha_hora                      = date("H:i:s");
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_archivo_adjunto            = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
$formato1                        = explode(".", $tbl15_archivo_adjunto);
$formato                         = end($formato1);
$formato_orig2                   = strtolower($formato);
$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cliente.'_'.$cod_historia_clinica.'.'.$formato_orig2;
$url_archivo_adjunto             = $ruta_archivo_adjunto.$nombre_normal2;
/* ----------------------------------------------------------------------------------------------------------/ */
copy($_FILES['tbl15_archivo_adjunto']['tmp_name'], $url_archivo_adjunto);
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "INSERT INTO tbl15_archivo_adjunto (nombre_archivo_adjunto, descripcion_archivo_adjunto, nombre_tipo_certificado, cod_cliente, cod_empresa, cod_historia_clinica, 
url_archivo_adjunto, fecha_creacion, fecha_hora, formato) 
VALUES ('$nombre_archivo_adjunto', '$descripcion_archivo_adjunto', '$nombre_tipo_certificado', '$cod_cliente', '$cod_empresa', '$cod_historia_clinica', 
'$url_archivo_adjunto', '$fecha_creacion', '$fecha_hora', '$formato')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
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