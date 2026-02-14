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
$cod_manipulacion_alimento      = intval($_POST['cod_manipulacion_alimento']);
$cod_historia_clinica           = intval($_POST['cod_historia_clinica']);

if (isset($_POST['ant_tos_expectora']) <> '') { $ant_tos_expectora = addslashes($_POST['ant_tos_expectora']); } else { $ant_tos_expectora = ''; }
if (isset($_POST['ant_fiebre_febricula']) <> '') { $ant_fiebre_febricula = addslashes($_POST['ant_fiebre_febricula']); } else { $ant_fiebre_febricula = ''; }
if (isset($_POST['ant_lesion_piel_unyas']) <> '') { $ant_lesion_piel_unyas = addslashes($_POST['ant_lesion_piel_unyas']); } else { $ant_lesion_piel_unyas = ''; }
if (isset($_POST['ant_piel_ojos_amarillos']) <> '') { $ant_piel_ojos_amarillos = addslashes($_POST['ant_piel_ojos_amarillos']); } else { $ant_piel_ojos_amarillos = ''; }
if (isset($_POST['ant_purito']) <> '') { $ant_purito = addslashes($_POST['ant_purito']); } else { $ant_purito = ''; }
if (isset($_POST['rec_piel']) <> '') { $rec_piel = addslashes($_POST['rec_piel']); } else { $rec_piel = ''; }
if (isset($_POST['rec_unyas']) <> '') { $rec_unyas = addslashes($_POST['rec_unyas']); } else { $rec_unyas = ''; }
if (isset($_POST['rec_mucosa']) <> '') { $rec_mucosa = addslashes($_POST['rec_mucosa']); } else { $rec_mucosa = ''; }
if (isset($_POST['rec_aparato_gastro']) <> '') { $rec_aparato_gastro = addslashes($_POST['rec_aparato_gastro']); } else { $rec_aparato_gastro = ''; }
if (isset($_POST['rec_extemidad']) <> '') { $rec_extemidad = addslashes($_POST['rec_extemidad']); } else { $rec_extemidad = ''; }
if (isset($_POST['rec_obser']) <> '') { $rec_obser = addslashes($_POST['rec_obser']); } else { $rec_obser = ''; }
if (isset($_POST['resexalab_cult_faringeo']) <> '') { $resexalab_cult_faringeo = addslashes($_POST['resexalab_cult_faringeo']); } else { $resexalab_cult_faringeo = ''; }
if (isset($_POST['resexalab_koh_cult_unyas']) <> '') { $resexalab_koh_cult_unyas = addslashes($_POST['resexalab_koh_cult_unyas']); } else { $resexalab_koh_cult_unyas = ''; }
if (isset($_POST['resexalab_bk_seriado']) <> '') { $resexalab_bk_seriado = addslashes($_POST['resexalab_bk_seriado']); } else { $resexalab_bk_seriado = ''; }
if (isset($_POST['resexalab_observ']) <> '') { $resexalab_observ = addslashes($_POST['resexalab_observ']); } else { $resexalab_observ = ''; }
if (isset($_POST['resexalab_nombre_lab_clinico']) <> '') { $resexalab_nombre_lab_clinico = addslashes($_POST['resexalab_nombre_lab_clinico']); } else { $resexalab_nombre_lab_clinico = ''; }
if (isset($_POST['resexalab_nombre_bacteriologo']) <> '') { $resexalab_nombre_bacteriologo = addslashes($_POST['resexalab_nombre_bacteriologo']); } else { $resexalab_nombre_bacteriologo = ''; }
if (isset($_POST['resexalab_numero_tajeta']) <> '') { $resexalab_numero_tajeta = addslashes($_POST['resexalab_numero_tajeta']); } else { $resexalab_numero_tajeta = ''; }
if (isset($_POST['concepto_manipulador']) <> '') { $concepto_manipulador = addslashes($_POST['concepto_manipulador']); } else { $concepto_manipulador = ''; }
if (isset($_POST['concepto_tratamiento_manipulador']) <> '') { $concepto_tratamiento_manipulador = addslashes($_POST['concepto_tratamiento_manipulador']); } else { $concepto_tratamiento_manipulador = ''; }
if (isset($_POST['concepto_descrip_tratamiento']) <> '') { $concepto_descrip_tratamiento = addslashes($_POST['concepto_descrip_tratamiento']); } else { $concepto_descrip_tratamiento = ''; }
if (isset($_POST['concepto_requiere_reubicado']) <> '') { $concepto_requiere_reubicado = addslashes($_POST['concepto_requiere_reubicado']); } else { $concepto_requiere_reubicado = ''; }
if (isset($_POST['concepto_fecha_cntl_medi']) <> '') { $concepto_fecha_cntl_medi = addslashes($_POST['concepto_fecha_cntl_medi']); } else { $concepto_fecha_cntl_medi = ''; }
if (isset($_POST['control_medico_dia']) <> '') { $control_medico_dia = addslashes($_POST['control_medico_dia']); } else { $control_medico_dia = ''; }
if (isset($_POST['control_medico_mes']) <> '') { $control_medico_mes = addslashes($_POST['control_medico_mes']); } else { $control_medico_mes = ''; }
if (isset($_POST['control_medico_anyo']) <> '') { $control_medico_anyo = intval($_POST['control_medico_anyo']); } else { $control_medico_anyo = ''; }

if (isset($_POST['afiliacion_eps']) <> '') { $afiliacion_eps = addslashes($_POST['afiliacion_eps']); } else { $afiliacion_eps = ''; }
if (isset($_POST['afiliacion_ars']) <> '') { $afiliacion_ars = addslashes($_POST['afiliacion_ars']); } else { $afiliacion_ars = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
$fecha_ymd_hora            = addslashes($_POST['fecha_ymd_hora']);
$fecha_time                = strtotime($fecha_ymd_hora);
$fecha_ymd                 = date("Y/m/d", $fecha_time);
$fecha_dmy                 = date("d/m/Y", $fecha_time);
$fecha_mes                 = date("m/Y", $fecha_time);
$fecha_anyo                = date("Y", $fecha_time);
$hora                      = date("H:i", $fecha_time);
$fecha_reg_time            = time();
$cuenta                    = $cuenta_actual;
$cuenta_reg                = $cuenta_actual;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_historia_clinica = "UPDATE tbl15_manipulacion_alimento SET ant_tos_expectora = '$ant_tos_expectora', ant_fiebre_febricula = '$ant_fiebre_febricula', 
ant_lesion_piel_unyas = '$ant_lesion_piel_unyas', ant_piel_ojos_amarillos = '$ant_piel_ojos_amarillos', 
ant_purito = '$ant_purito', rec_piel = '$rec_piel', rec_unyas = '$rec_unyas', rec_mucosa = '$rec_mucosa', rec_aparato_gastro = '$rec_aparato_gastro', 
rec_extemidad = '$rec_extemidad', rec_obser = '$rec_obser', resexalab_cult_faringeo = '$resexalab_cult_faringeo', resexalab_koh_cult_unyas = '$resexalab_koh_cult_unyas', 
resexalab_bk_seriado = '$resexalab_bk_seriado', resexalab_observ = '$resexalab_observ', resexalab_nombre_lab_clinico = '$resexalab_nombre_lab_clinico', 
resexalab_nombre_bacteriologo = '$resexalab_nombre_bacteriologo', resexalab_numero_tajeta = '$resexalab_numero_tajeta', 
concepto_manipulador = '$concepto_manipulador', concepto_tratamiento_manipulador = '$concepto_tratamiento_manipulador', 
concepto_descrip_tratamiento = '$concepto_descrip_tratamiento', concepto_requiere_reubicado = '$concepto_requiere_reubicado',
concepto_fecha_cntl_medi = '$concepto_fecha_cntl_medi', control_medico_dia = '$control_medico_dia', control_medico_mes = '$control_medico_mes', 
control_medico_anyo = '$control_medico_anyo', afiliacion_eps = '$afiliacion_eps', afiliacion_ars = '$afiliacion_ars',
fecha_dmy = '$fecha_dmy', fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', 
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_reg_time = '$fecha_reg_time'
WHERE cod_manipulacion_alimento = '$cod_manipulacion_alimento'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<h3>Se ha guardado correctamente el certificado de manipulación de alimentos</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_manipulacion_alimento.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_manipulacion_alimento.php">
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