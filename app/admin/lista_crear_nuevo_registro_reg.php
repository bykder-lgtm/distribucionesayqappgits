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

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$tabla                          = addslashes($_GET['tabla']);
$cod_cliente                    = intval($_GET['cod_cliente']);
$pagina                         = addslashes($_GET['pagina']);
//--------------------------------------------------------------------------------------------------------------//
$obtener_cedula = "SELECT nombre_empresa FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$nombre_empresa                      = $info_cliente['nombre_empresa'];
//--------------------------------------------------------------------------------------------------------------//
$fecha_time                     = time();
$fecha_ymd                      = date("Y/m/d", $fecha_time);
$fecha_dmy                      = date("d/m/Y", $fecha_time);
$fecha_my                       = date("m/Y", $fecha_time);
$fecha_mes                      = date("m/Y", $fecha_time);
$fecha_dia                      = date("d", $fecha_time);
//$fecha_mes                    = date("m", $fecha_time);
$fecha_anyo                     = date("Y", $fecha_time);
$hora                           = date("H:i", $fecha_time);
$fecha_reg_time                 = $fecha_time;
$cuenta                         = $cuenta_actual;

$fecha_ymd1                     = date("Y-m-d", $fecha_time);
$fecha_dmy1                     = date("d-m-Y", $fecha_time);
$fecha_mes1                     = date("m-Y", $fecha_time);
$fecha_hora                     = date("H:i:s", $fecha_time);
$motivo                         = 'PRE-INGRESO';
//--------------------------------------------------------------------------------------------------------------//
if ($tabla=='tbl15_actitud_laboral') {

$sql_autoincremento_actitud_laboral = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_actitud_laboral'";
$exec_autoincremento_actitud_laboral = mysqli_query($conectar, $sql_autoincremento_actitud_laboral) or die(mysqli_error($conectar));
$datos_autoincremento_actitud_laboral = mysqli_fetch_assoc($exec_autoincremento_actitud_laboral);
$cod_actitud_laboral = $datos_autoincremento_actitud_laboral['AUTO_INCREMENT'];

$sql_data = "INSERT INTO tbl15_actitud_laboral (cod_cliente, cod_administrador, motivo_actilab, fecha_dmy, fecha_ymd, fecha_time, fecha_mes, fecha_anyo, fecha_reg_time) 
VALUES ('$cod_cliente', '$cod_administrador', '$motivo', '$fecha_dmy', '$fecha_ymd', '$fecha_time', '$fecha_mes', '$fecha_anyo', '$fecha_reg_time')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_concepto_actitud_laboral.php?cod_actitud_laboral=<?php echo $cod_actitud_laboral ?>&cod_cliente=<?php echo $cod_cliente ?>&cod_historia_clinica=0&pagina=<?php echo $pagina ?>">
<?php }
//--------------------------------------------------------------------------------------------------------------//
if ($tabla=='tbl15_manipulacion_alimento') {

$sql_autoincremento_manipulacion_alimento = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_manipulacion_alimento'";
$exec_autoincremento_manipulacion_alimento = mysqli_query($conectar, $sql_autoincremento_manipulacion_alimento) or die(mysqli_error($conectar));
$datos_autoincremento_manipulacion_alimento = mysqli_fetch_assoc($exec_autoincremento_manipulacion_alimento);
$cod_manipulacion_alimento = $datos_autoincremento_manipulacion_alimento['AUTO_INCREMENT'];

$sql_data2 = "INSERT INTO tbl15_manipulacion_alimento (cod_cliente, cod_administrador, motivo_manipulacion_alimento, fecha_dmy, fecha_ymd, fecha_time, fecha_mes, fecha_anyo, fecha_reg_time) 
VALUES ('$cod_cliente', '$cod_administrador', '$motivo', '$fecha_dmy', '$fecha_ymd', '$fecha_time', '$fecha_mes', '$fecha_anyo', '$fecha_reg_time')";
$exec_data2 = mysqli_query($conectar, $sql_data2) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_manipulacion_alimento.php?cod_manipulacion_alimento=<?php echo $cod_manipulacion_alimento ?>&cod_cliente=<?php echo $cod_cliente ?>&cod_historia_clinica=0&pagina=<?php echo $pagina ?>">
<?php }
//--------------------------------------------------------------------------------------------------------------//
if ($tabla=='tbl15_trabajo_altura') {

$sql_autoincremento_trabajo_altura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_trabajo_altura'";
$exec_autoincremento_trabajo_altura = mysqli_query($conectar, $sql_autoincremento_trabajo_altura) or die(mysqli_error($conectar));
$datos_autoincremento_trabajo_altura = mysqli_fetch_assoc($exec_autoincremento_trabajo_altura);
$cod_trabajo_altura = $datos_autoincremento_trabajo_altura['AUTO_INCREMENT'];

$sql_data3 = "INSERT INTO tbl15_trabajo_altura (cod_cliente, cod_administrador, motivo_trabajo_altura, fecha_dmy, fecha_ymd, fecha_time, fecha_mes, fecha_anyo, fecha_reg_time) 
VALUES ('$cod_cliente', '$cod_administrador', '$motivo', '$fecha_dmy', '$fecha_ymd', '$fecha_time', '$fecha_mes', '$fecha_anyo', '$fecha_reg_time')";
$exec_data3 = mysqli_query($conectar, $sql_data3) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_trabajo_altura.php?cod_trabajo_altura=<?php echo $cod_trabajo_altura ?>&cod_cliente=<?php echo $cod_cliente ?>&cod_historia_clinica=0&pagina=<?php echo $pagina ?>">
<?php }
//--------------------------------------------------------------------------------------------------------------//
if ($tabla=='tbl15_consentimiento_informado') {

$sql_autoincremento_consentimiento_informado = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_consentimiento_informado'";
$exec_autoincremento_consentimiento_informado = mysqli_query($conectar, $sql_autoincremento_consentimiento_informado) or die(mysqli_error($conectar));
$datos_autoincremento_consentimiento_informado = mysqli_fetch_assoc($exec_autoincremento_consentimiento_informado);
$cod_consentimiento_informado = $datos_autoincremento_consentimiento_informado['AUTO_INCREMENT'];

$sql_data2 = "INSERT INTO tbl15_consentimiento_informado (cod_cliente, cod_administrador, motivo_cosulta, nombre_empresa, 
fecha_dmy, 	fecha_ymd, fecha_hora, fecha_time, fecha_mes, fecha_anyo, fecha_reg_time) 
VALUES ('$cod_cliente', '$cod_administrador', '$motivo', '$nombre_empresa', '$fecha_dmy1', 
'$fecha_ymd1', '$fecha_hora', '$fecha_time', '$fecha_mes1', '$fecha_anyo', '$fecha_reg_time')";
$exec_data2 = mysqli_query($conectar, $sql_data2) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_consentimiento_informado.php?cod_consentimiento_informado=<?php echo $cod_consentimiento_informado ?>&cod_cliente=<?php echo $cod_cliente ?>&cod_historia_clinica=0&pagina=<?php echo $pagina ?>">
<?php }
//--------------------------------------------------------------------------------------------------------------//
if ($tabla=='tbl15_satisfacion_usuario_encuesta') {

$sql_autoincremento_consentimiento_informado = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_satisfacion_usuario_encuesta'";
$exec_autoincremento_consentimiento_informado = mysqli_query($conectar, $sql_autoincremento_consentimiento_informado) or die(mysqli_error($conectar));
$datos_autoincremento_consentimiento_informado = mysqli_fetch_assoc($exec_autoincremento_consentimiento_informado);
$cod_tbl15_satisfacion_usuario_encuesta= $datos_autoincremento_consentimiento_informado['AUTO_INCREMENT'];

$sql_data2 = "INSERT INTO tbl15_tbl15_satisfacion_usuario_encuesta(cod_cliente, cod_administrador, motivo_cosulta, nombre_empresa, 
fecha_dmy, 	fecha_ymd, fecha_hora, fecha_time, fecha_mes, fecha_anyo, fecha_reg_time) 
VALUES ('$cod_cliente', '$cod_administrador', '$motivo', '$nombre_empresa', '$fecha_dmy1', 
'$fecha_ymd1', '$fecha_hora', '$fecha_time', '$fecha_mes1', '$fecha_anyo', '$fecha_reg_time')";
$exec_data2 = mysqli_query($conectar, $sql_data2) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_satisfacion_usuario_encuesta.php?cod_satisfacion_usuario_encuesta=<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>&cod_cliente=<?php echo $cod_cliente ?>&cod_historia_clinica=0&pagina=<?php echo $pagina ?>">
<?php }
//--------------------------------------------------------------------------------------------------------------//
if ($tabla=='tbl15_remision') {

$sql_autoincremento_trabajo_altura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_remision'";
$exec_autoincremento_trabajo_altura = mysqli_query($conectar, $sql_autoincremento_trabajo_altura) or die(mysqli_error($conectar));
$datos_autoincremento_trabajo_altura = mysqli_fetch_assoc($exec_autoincremento_trabajo_altura);
$cod_remision                   = $datos_autoincremento_trabajo_altura['AUTO_INCREMENT'];

$sql_max_cod_hist_clinic = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica FROM tbl15_historia_clinica WHERE cod_cliente = '$cod_cliente'";
$exec_max_cod_hist_clinic = mysqli_query($conectar, $sql_max_cod_hist_clinic) or die(mysqli_error($conectar));
$datos_max_cod_hist_clinic = mysqli_fetch_assoc($exec_max_cod_hist_clinic);

$cod_historia_clinica           = $datos_max_cod_hist_clinic['cod_historia_clinica'];

$sql_info_hist_clinic = "SELECT motivo, nombre_empresa, cod_grupo_area_cargo, ciudad_empresa, exa_fis_talla, exa_fis_peso, 
exa_fis_imc, exa_fis_interpreimc, exa_fis_fresp, exa_fis_ta, exa_fis_fc, exa_fis_lateral, exa_fis_periabdom, exa_fis_temperat, 
exa_fis_ojoder_sncorre_vlejan, exa_fis_ojoder_sncorre_vcerca, exa_fis_ojoder_cncorre_vlejan, exa_fis_ojoder_cncorre_vcerca, 
exa_fis_ojoizq_sncorre_vlejan, exa_fis_ojoizq_sncorre_vcerca, exa_fis_ojoizq_cncorre_vlejan, exa_fis_ojoizq_cncorre_vcerca, 
exa_fis_ojoamb_sncorre_vlejan, exa_fis_ojoamb_sncorre_vcerca, exa_fis_oojoamb_cncorre_vlejan, exa_fis_ojoamb_cncorre_vcerca
 FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$exec_info_hist_clinic = mysqli_query($conectar, $sql_info_hist_clinic) or die(mysqli_error($conectar));
$datos_info_hist_clinic = mysqli_fetch_assoc($exec_info_hist_clinic);

$motivo                         = $datos_info_hist_clinic['motivo'];;
$nombre_empresa                 = $datos_info_hist_clinic['nombre_empresa'];
$cod_grupo_area_cargo           = $datos_info_hist_clinic['cod_grupo_area_cargo'];
$ciudad_empresa                 = $datos_info_hist_clinic['ciudad_empresa'];
$exa_fis_talla                  = $datos_info_hist_clinic['exa_fis_talla'];
$exa_fis_peso                   = $datos_info_hist_clinic['exa_fis_peso'];
$exa_fis_imc                    = $datos_info_hist_clinic['exa_fis_imc'];
$exa_fis_interpreimc            = $datos_info_hist_clinic['exa_fis_interpreimc'];
$exa_fis_fresp                  = $datos_info_hist_clinic['exa_fis_fresp'];
$exa_fis_ta                     = $datos_info_hist_clinic['exa_fis_ta'];
$exa_fis_fc                     = $datos_info_hist_clinic['exa_fis_fc'];
$exa_fis_lateral                = $datos_info_hist_clinic['exa_fis_lateral'];
$exa_fis_periabdom              = $datos_info_hist_clinic['exa_fis_periabdom'];
$exa_fis_temperat               = $datos_info_hist_clinic['exa_fis_temperat'];
$exa_fis_ojoder_sncorre_vlejan  = $datos_info_hist_clinic['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca  = $datos_info_hist_clinic['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan  = $datos_info_hist_clinic['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca  = $datos_info_hist_clinic['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan  = $datos_info_hist_clinic['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca  = $datos_info_hist_clinic['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan  = $datos_info_hist_clinic['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca  = $datos_info_hist_clinic['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan  = $datos_info_hist_clinic['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca  = $datos_info_hist_clinic['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan = $datos_info_hist_clinic['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca  = $datos_info_hist_clinic['exa_fis_ojoamb_cncorre_vcerca'];

$sql_data3 = "INSERT INTO tbl15_remision (cod_cliente, cod_administrador, motivo, fecha_dmy, fecha_ymd, fecha_time, fecha_mes, fecha_anyo, fecha_reg_time, 
nombre_empresa, cod_grupo_area_cargo, ciudad_empresa, exa_fis_talla, exa_fis_peso, exa_fis_imc, exa_fis_interpreimc, exa_fis_fresp, 
exa_fis_ta, exa_fis_fc, exa_fis_lateral, exa_fis_periabdom, exa_fis_temperat, 
exa_fis_ojoder_sncorre_vlejan, exa_fis_ojoder_sncorre_vcerca, exa_fis_ojoder_cncorre_vlejan, exa_fis_ojoder_cncorre_vcerca, 
exa_fis_ojoizq_sncorre_vlejan, exa_fis_ojoizq_sncorre_vcerca, exa_fis_ojoizq_cncorre_vlejan, exa_fis_ojoizq_cncorre_vcerca, 
exa_fis_ojoamb_sncorre_vlejan, exa_fis_ojoamb_sncorre_vcerca, exa_fis_oojoamb_cncorre_vlejan, exa_fis_ojoamb_cncorre_vcerca) 
VALUES ('$cod_cliente', '$cod_administrador', '$motivo', '$fecha_dmy', '$fecha_ymd', '$fecha_time', '$fecha_mes', '$fecha_anyo', '$fecha_reg_time', 
'$nombre_empresa', '$cod_grupo_area_cargo', '$ciudad_empresa', '$exa_fis_talla', '$exa_fis_peso', '$exa_fis_imc', '$exa_fis_interpreimc', '$exa_fis_fresp', 
'$exa_fis_ta', '$exa_fis_fc', '$exa_fis_lateral', '$exa_fis_periabdom', '$exa_fis_temperat', 
'$exa_fis_ojoder_sncorre_vlejan', '$exa_fis_ojoder_sncorre_vcerca', '$exa_fis_ojoder_cncorre_vlejan', '$exa_fis_ojoder_cncorre_vcerca', 
'$exa_fis_ojoizq_sncorre_vlejan', '$exa_fis_ojoizq_sncorre_vcerca', '$exa_fis_ojoizq_cncorre_vlejan', '$exa_fis_ojoizq_cncorre_vcerca', 
'$exa_fis_ojoamb_sncorre_vlejan', '$exa_fis_ojoamb_sncorre_vcerca', '$exa_fis_oojoamb_cncorre_vlejan', '$exa_fis_ojoamb_cncorre_vcerca')";
$exec_data3 = mysqli_query($conectar, $sql_data3) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_remision.php?cod_remision=<?php echo $cod_remision ?>&cod_cliente=<?php echo $cod_cliente ?>&cod_historia_clinica=<?php echo $cod_historia_clinica ?>&pagina=<?php echo $pagina ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>