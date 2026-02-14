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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {
$cod_tbl15_satisfacion_usuario_encuesta     = intval($_POST['cod_satisfacion_usuario_encuesta']);
$cod_historia_clinica                  = intval($_POST['cod_historia_clinica']);

if (isset($_POST['cod_sede']) <> '') { $cod_sede = addslashes($_POST['cod_sede']); } else { $cod_sede = ''; }
if (isset($_POST['calif_serv_global']) <> '') { $calif_serv_global = addslashes($_POST['calif_serv_global']); } else { $calif_serv_global = ''; }
if (isset($_POST['examedic_experiencia_servicio']) <> '') { $examedic_experiencia_servicio = addslashes($_POST['examedic_experiencia_servicio']); } else { $examedic_experiencia_servicio = ''; }
if (isset($_POST['audiomet_experiencia_servicio']) <> '') { $audiomet_experiencia_servicio = addslashes($_POST['audiomet_experiencia_servicio']); } else { $audiomet_experiencia_servicio = ''; }
if (isset($_POST['optomet_experiencia_servicio']) <> '') { $optomet_experiencia_servicio = addslashes($_POST['optomet_experiencia_servicio']); } else { $optomet_experiencia_servicio = ''; }
if (isset($_POST['visiomet_experiencia_servicio']) <> '') { $visiomet_experiencia_servicio = addslashes($_POST['visiomet_experiencia_servicio']); } else { $visiomet_experiencia_servicio = ''; }
if (isset($_POST['espiro_experiencia_servicio']) <> '') { $espiro_experiencia_servicio = addslashes($_POST['espiro_experiencia_servicio']); } else { $espiro_experiencia_servicio = ''; }
if (isset($_POST['osteomusc_experiencia_servicio']) <> '') { $osteomusc_experiencia_servicio = addslashes($_POST['osteomusc_experiencia_servicio']); } else { $osteomusc_experiencia_servicio = ''; }
if (isset($_POST['vacunacion_experiencia_servicio']) <> '') { $vacunacion_experiencia_servicio = addslashes($_POST['vacunacion_experiencia_servicio']); } else { $vacunacion_experiencia_servicio = ''; }
if (isset($_POST['labclinic_experiencia_servicio']) <> '') { $labclinic_experiencia_servicio = addslashes($_POST['labclinic_experiencia_servicio']); } else { $labclinic_experiencia_servicio = ''; }
if (isset($_POST['recep_experiencia_servicio']) <> '') { $recep_experiencia_servicio = addslashes($_POST['recep_experiencia_servicio']); } else { $recep_experiencia_servicio = ''; }
if (isset($_POST['otros_experiencia_servicio']) <> '') { $otros_experiencia_servicio = addslashes($_POST['otros_experiencia_servicio']); } else { $otros_experiencia_servicio = ''; }
if (isset($_POST['comentario_suger']) <> '') { $comentario_suger = addslashes($_POST['comentario_suger']); } else { $comentario_suger = ''; }
if (isset($_POST['nombre_recomend_ips']) <> '') { $nombre_recomend_ips = addslashes($_POST['nombre_recomend_ips']); } else { $nombre_recomend_ips = ''; }
if (isset($_POST['tel_contacto1']) <> '') { $tel_contacto1 = addslashes($_POST['tel_contacto1']); } else { $tel_contacto1 = ''; }
if (isset($_POST['correo_contacto1']) <> '') { $correo_contacto1 = addslashes($_POST['correo_contacto1']); } else { $correo_contacto1 = ''; }
if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = addslashes($_POST['fecha_ymd']); } else { $fecha_ymd = ''; }
if (isset($_POST['fecha_hora']) <> '') { $fecha_hora = addslashes($_POST['fecha_hora']); } else { $fecha_hora = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
$fecha_ymd_hora            = addslashes($_POST['fecha_ymd'].' '.$_POST['fecha_hora']);
$fecha_time                = strtotime($fecha_ymd_hora);
$fecha_dmy                 = date("d-m-Y", $fecha_time);
$fecha_mes                 = date("m-Y", $fecha_time);
$fecha_anyo                = date("Y", $fecha_time);
$hora                      = date("H:i", $fecha_time);
$fecha_reg_time            = time();
$cuenta                    = $cuenta_actual;
$cuenta_reg                = $cuenta_actual;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_historia_clinica = "UPDATE tbl15_tbl15_satisfacion_usuario_encuestaSET cod_sede = '$cod_sede', calif_serv_global = '$calif_serv_global', 
examedic_experiencia_servicio = '$examedic_experiencia_servicio', audiomet_experiencia_servicio = '$audiomet_experiencia_servicio', 
optomet_experiencia_servicio = '$optomet_experiencia_servicio', visiomet_experiencia_servicio = '$visiomet_experiencia_servicio', 
espiro_experiencia_servicio = '$espiro_experiencia_servicio', osteomusc_experiencia_servicio = '$osteomusc_experiencia_servicio', 
vacunacion_experiencia_servicio = '$vacunacion_experiencia_servicio', labclinic_experiencia_servicio = '$labclinic_experiencia_servicio', 
recep_experiencia_servicio = '$recep_experiencia_servicio', otros_experiencia_servicio = '$otros_experiencia_servicio', 
comentario_suger = '$comentario_suger', nombre_recomend_ips = '$nombre_recomend_ips', 
tel_contacto1 = '$tel_contacto1', correo_contacto1 = '$correo_contacto1', 
fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', 
fecha_dmy = '$fecha_dmy', fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', 
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_reg_time = '$fecha_reg_time'
WHERE cod_tbl15_satisfacion_usuario_encuesta= '$cod_satisfacion_usuario_encuesta'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<h3>Se ha guardado correctamente el certificado de manipulación de alimentos</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_satisfacion_usuario_encuesta.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_satisfacion_usuario_encuesta.php">
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