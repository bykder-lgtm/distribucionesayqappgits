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
$pagina_else = addslashes($_POST['pagina']);
//--------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------------//
if (isset($_POST['motivo']) <> '') { $motivo = mysqli_real_escape_string($conectar,(($_POST['motivo']))); } else { $motivo = ''; }
if (isset($_POST['anamnesicos']) <> '') { $anamnesicos = mysqli_real_escape_string($conectar,(($_POST['anamnesicos']))); } else { $anamnesicos = ''; }
if (isset($_POST['vacum_can']) <> '') { $vacum_can = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_can']))); } else { $vacum_can = ''; }
if (isset($_POST['vacum_fel']) <> '') { $vacum_fel = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_fel']))); } else { $vacum_fel = ''; }
if (isset($_POST['vacum_can_pvc']) <> '') { $vacum_can_pvc = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_can_pvc']))); } else { $vacum_can_pvc = ''; }
if (isset($_POST['vacum_can_pvc_fecha']) <> '') { $vacum_can_pvc_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_can_pvc_fecha']))); } else { $vacum_can_pvc_fecha = ''; }
if (isset($_POST['vacum_fel_pvc']) <> '') { $vacum_fel_pvc = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_fel_pvc']))); } else { $vacum_fel_pvc = ''; }
if (isset($_POST['vacum_fel_pvc_fecha']) <> '') { $vacum_fel_pvc_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_fel_pvc_fecha']))); } else { $vacum_fel_pvc_fecha = ''; }
if (isset($_POST['vacum_can_triple']) <> '') { $vacum_can_triple = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_can_triple']))); } else { $vacum_can_triple = ''; }
if (isset($_POST['vacum_can_triple_fecha']) <> '') { $vacum_can_triple_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_can_triple_fecha']))); } else { $vacum_can_triple_fecha = ''; }
if (isset($_POST['vacum_fel_triple']) <> '') { $vacum_fel_triple = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_fel_triple']))); } else { $vacum_fel_triple = ''; }
if (isset($_POST['vacum_fel_triple_fecha']) <> '') { $vacum_fel_triple_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_fel_triple_fecha']))); } else { $vacum_fel_triple_fecha = ''; }
if (isset($_POST['vacum_can_rabia']) <> '') { $vacum_can_rabia = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_can_rabia']))); } else { $vacum_can_rabia = ''; }
if (isset($_POST['vacum_can_rabia_fecha']) <> '') { $vacum_can_rabia_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_can_rabia_fecha']))); } else { $vacum_can_rabia_fecha = ''; }
if (isset($_POST['vacum_fel_rabia']) <> '') { $vacum_fel_rabia = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_fel_rabia']))); } else { $vacum_fel_rabia = ''; }
if (isset($_POST['vacum_fel_rabia_fecha']) <> '') { $vacum_fel_rabia_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_fel_rabia_fecha']))); } else { $vacum_fel_rabia_fecha = ''; }
if (isset($_POST['vacum_can_otra']) <> '') { $vacum_can_otra = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_can_otra']))); } else { $vacum_can_otra = ''; }
if (isset($_POST['vacum_can_otra_fecha']) <> '') { $vacum_can_otra_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_can_otra_fecha']))); } else { $vacum_can_otra_fecha = ''; }
if (isset($_POST['vacum_fel_otra']) <> '') { $vacum_fel_otra = mysqli_real_escape_string($conectar,(strtoupper($_POST['vacum_fel_otra']))); } else { $vacum_fel_otra = ''; }
if (isset($_POST['vacum_fel_otra_fecha']) <> '') { $vacum_fel_otra_fecha = mysqli_real_escape_string($conectar,(($_POST['vacum_fel_otra_fecha']))); } else { $vacum_fel_otra_fecha = ''; }
if (isset($_POST['vacum_can_otra_cual']) <> '') { $vacum_can_otra_cual = mysqli_real_escape_string($conectar,(($_POST['vacum_can_otra_cual']))); } else { $vacum_can_otra_cual = ''; }
if (isset($_POST['vacum_fel_otra_cual']) <> '') { $vacum_fel_otra_cual = mysqli_real_escape_string($conectar,(($_POST['vacum_fel_otra_cual']))); } else { $vacum_fel_otra_cual = ''; }
if (isset($_POST['ult_desparacit']) <> '') { $ult_desparacit = mysqli_real_escape_string($conectar,(strtoupper($_POST['ult_desparacit']))); } else { $ult_desparacit = ''; }
if (isset($_POST['ult_desparacit_producto']) <> '') { $ult_desparacit_producto = mysqli_real_escape_string($conectar,(strtoupper($_POST['ult_desparacit_producto']))); } else { $ult_desparacit_producto = ''; }
if (isset($_POST['ult_desparacit_fecha']) <> '') { $ult_desparacit_fecha = mysqli_real_escape_string($conectar,(($_POST['ult_desparacit_fecha']))); } else { $ult_desparacit_fecha = ''; }
if (isset($_POST['nombre_alimentacion']) <> '') { $nombre_alimentacion = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_alimentacion']))); } else { $nombre_alimentacion = ''; }
if (isset($_POST['nombre_estado_reproductivo']) <> '') { $nombre_estado_reproductivo = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_estado_reproductivo']))); } else { $nombre_estado_reproductivo = ''; }
if (isset($_POST['nombre_alergias']) <> '') { $nombre_alergias = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_alergias']))); } else { $nombre_alergias = ''; }
if (isset($_POST['nombre_enf_ant']) <> '') { $nombre_enf_ant = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_enf_ant']))); } else { $nombre_enf_ant = ''; }
if (isset($_POST['nombre_cirugias']) <> '') { $nombre_cirugias = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_cirugias']))); } else { $nombre_cirugias = ''; }
if (isset($_POST['ant_fam']) <> '') { $ant_fam = mysqli_real_escape_string($conectar,(strtoupper($_POST['ant_fam']))); } else { $ant_fam = ''; }
if (isset($_POST['nombre_habitat']) <> '') { $nombre_habitat = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_habitat']))); } else { $nombre_habitat = ''; }
if (isset($_POST['exa_fis_tllc']) <> '') { $exa_fis_tllc = mysqli_real_escape_string($conectar,(($_POST['exa_fis_tllc']))); } else { $exa_fis_tllc = ''; }
if (isset($_POST['exa_fis_fc']) <> '') { $exa_fis_fc = mysqli_real_escape_string($conectar,(($_POST['exa_fis_fc']))); } else { $exa_fis_fc = ''; }
if (isset($_POST['exa_fis_fresp']) <> '') { $exa_fis_fresp = mysqli_real_escape_string($conectar,(($_POST['exa_fis_fresp']))); } else { $exa_fis_fresp = ''; }
if (isset($_POST['exa_fis_pulso']) <> '') { $exa_fis_pulso = mysqli_real_escape_string($conectar,(($_POST['exa_fis_pulso']))); } else { $exa_fis_pulso = ''; }
if (isset($_POST['exa_fis_temperat']) <> '') { $exa_fis_temperat = mysqli_real_escape_string($conectar,(($_POST['exa_fis_temperat']))); } else { $exa_fis_temperat = ''; }
if (isset($_POST['exa_fis_peso']) <> '') { $exa_fis_peso = mysqli_real_escape_string($conectar,(($_POST['exa_fis_peso']))); } else { $exa_fis_peso = ''; }
if (isset($_POST['cod_actitud']) <> '') { $cod_actitud = intval($_POST['cod_actitud']); } else { $cod_actitud = ''; }
if (isset($_POST['cod_condicion_corporal']) <> '') { $cod_condicion_corporal = intval($_POST['cod_condicion_corporal']); } else { $cod_condicion_corporal = ''; }
if (isset($_POST['cod_estado_hidratacion']) <> '') { $cod_estado_hidratacion = intval($_POST['cod_estado_hidratacion']); } else { $cod_estado_hidratacion = ''; }
if (isset($_POST['conjuntival']) <> '') { $conjuntival = mysqli_real_escape_string($conectar,(strtoupper($_POST['conjuntival']))); } else { $conjuntival = ''; }
if (isset($_POST['conjuntival_observ']) <> '') { $conjuntival_observ = mysqli_real_escape_string($conectar,(($_POST['conjuntival_observ']))); } else { $conjuntival_observ = ''; }
if (isset($_POST['oral']) <> '') { $oral = mysqli_real_escape_string($conectar,(strtoupper($_POST['oral']))); } else { $oral = ''; }
if (isset($_POST['oral_observ']) <> '') { $oral_observ = mysqli_real_escape_string($conectar,(($_POST['oral_observ']))); } else { $oral_observ = ''; }
if (isset($_POST['vulvar_prepucial']) <> '') { $vulvar_prepucial = mysqli_real_escape_string($conectar,(strtoupper($_POST['vulvar_prepucial']))); } else { $vulvar_prepucial = ''; }
if (isset($_POST['vulvar_prepucial_observ']) <> '') { $vulvar_prepucial_observ = mysqli_real_escape_string($conectar,(($_POST['vulvar_prepucial_observ']))); } else { $vulvar_prepucial_observ = ''; }
if (isset($_POST['rectal']) <> '') { $rectal = mysqli_real_escape_string($conectar,(strtoupper($_POST['rectal']))); } else { $rectal = ''; }
if (isset($_POST['rectal_observ']) <> '') { $rectal_observ = mysqli_real_escape_string($conectar,(($_POST['rectal_observ']))); } else { $rectal_observ = ''; }
if (isset($_POST['ojos']) <> '') { $ojos = mysqli_real_escape_string($conectar,(strtoupper($_POST['ojos']))); } else { $ojos = ''; }
if (isset($_POST['ojos_observ']) <> '') { $ojos_observ = mysqli_real_escape_string($conectar,(($_POST['ojos_observ']))); } else { $ojos_observ = ''; }
if (isset($_POST['oidos']) <> '') { $oidos = mysqli_real_escape_string($conectar,(strtoupper($_POST['oidos']))); } else { $oidos = ''; }
if (isset($_POST['oidos_observ']) <> '') { $oidos_observ = mysqli_real_escape_string($conectar,(($_POST['oidos_observ']))); } else { $oidos_observ = ''; }
if (isset($_POST['nodulos_linfa']) <> '') { $nodulos_linfa = mysqli_real_escape_string($conectar,(strtoupper($_POST['nodulos_linfa']))); } else { $nodulos_linfa = ''; }
if (isset($_POST['nodulos_linfa_observ']) <> '') { $nodulos_linfa_observ = mysqli_real_escape_string($conectar,(($_POST['nodulos_linfa_observ']))); } else { $nodulos_linfa_observ = ''; }
if (isset($_POST['piel_anexos']) <> '') { $piel_anexos = mysqli_real_escape_string($conectar,(strtoupper($_POST['piel_anexos']))); } else { $piel_anexos = ''; }
if (isset($_POST['piel_anexos_observ']) <> '') { $piel_anexos_observ = mysqli_real_escape_string($conectar,(($_POST['piel_anexos_observ']))); } else { $piel_anexos_observ = ''; }
if (isset($_POST['locomocion']) <> '') { $locomocion = mysqli_real_escape_string($conectar,(strtoupper($_POST['locomocion']))); } else { $locomocion = ''; }
if (isset($_POST['locomocion_observ']) <> '') { $locomocion_observ = mysqli_real_escape_string($conectar,(($_POST['locomocion_observ']))); } else { $locomocion_observ = ''; }
if (isset($_POST['aparato_musculoesquelet']) <> '') { $aparato_musculoesquelet = mysqli_real_escape_string($conectar,(strtoupper($_POST['aparato_musculoesquelet']))); } else { $aparato_musculoesquelet = ''; }
if (isset($_POST['aparato_musculoesquelet_observ']) <> '') { $aparato_musculoesquelet_observ = mysqli_real_escape_string($conectar,(($_POST['aparato_musculoesquelet_observ']))); } else { $aparato_musculoesquelet_observ = ''; }
if (isset($_POST['sistem_nervioso']) <> '') { $sistem_nervioso = mysqli_real_escape_string($conectar,(strtoupper($_POST['sistem_nervioso']))); } else { $sistem_nervioso = ''; }
if (isset($_POST['sistem_nervioso_observ']) <> '') { $sistem_nervioso_observ = mysqli_real_escape_string($conectar,(($_POST['sistem_nervioso_observ']))); } else { $sistem_nervioso_observ = ''; }
if (isset($_POST['aparato_cardiovascu']) <> '') { $aparato_cardiovascu = mysqli_real_escape_string($conectar,(strtoupper($_POST['aparato_cardiovascu']))); } else { $aparato_cardiovascu = ''; }
if (isset($_POST['aparato_cardiovascu_observ']) <> '') { $aparato_cardiovascu_observ = mysqli_real_escape_string($conectar,(($_POST['aparato_cardiovascu_observ']))); } else { $aparato_cardiovascu_observ = ''; }
if (isset($_POST['aparato_respirat']) <> '') { $aparato_respirat = mysqli_real_escape_string($conectar,(strtoupper($_POST['aparato_respirat']))); } else { $aparato_respirat = ''; }
if (isset($_POST['aparato_respirat_observ']) <> '') { $aparato_respirat_observ = mysqli_real_escape_string($conectar,(($_POST['aparato_respirat_observ']))); } else { $aparato_respirat_observ = ''; }
if (isset($_POST['aparato_digestivo']) <> '') { $aparato_digestivo = mysqli_real_escape_string($conectar,(strtoupper($_POST['aparato_digestivo']))); } else { $aparato_digestivo = ''; }
if (isset($_POST['aparato_digestivo_observ']) <> '') { $aparato_digestivo_observ = mysqli_real_escape_string($conectar,(($_POST['aparato_digestivo_observ']))); } else { $aparato_digestivo_observ = ''; }
if (isset($_POST['aparato_genitourinario']) <> '') { $aparato_genitourinario = mysqli_real_escape_string($conectar,(strtoupper($_POST['aparato_genitourinario']))); } else { $aparato_genitourinario = ''; }
if (isset($_POST['aparato_genitourinario_observ']) <> '') { $aparato_genitourinario_observ = mysqli_real_escape_string($conectar,(($_POST['aparato_genitourinario_observ']))); } else { $aparato_genitourinario_observ = ''; }
if (isset($_POST['plan_diag_cuadhemat']) <> '') { $plan_diag_cuadhemat = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cuadhemat']))); } else { $plan_diag_cuadhemat = ''; }
if (isset($_POST['plan_diag_cuadhemat_autorizado']) <> '') { $plan_diag_cuadhemat_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cuadhemat_autorizado']))); } else { $plan_diag_cuadhemat_autorizado = ''; }
if (isset($_POST['plan_diag_cuadhemat_fecha']) <> '') { $plan_diag_cuadhemat_fecha = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cuadhemat_fecha']))); } else { $plan_diag_cuadhemat_fecha = ''; }
if (isset($_POST['plan_diag_cuadhemat_lab']) <> '') { $plan_diag_cuadhemat_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cuadhemat_lab']))); } else { $plan_diag_cuadhemat_lab = ''; }
if (isset($_POST['plan_diag_cuadhemat_resul']) <> '') { $plan_diag_cuadhemat_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cuadhemat_resul']))); } else { $plan_diag_cuadhemat_resul = ''; }
if (isset($_POST['plan_diag_parcialorina']) <> '') { $plan_diag_parcialorina = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_parcialorina']))); } else { $plan_diag_parcialorina = ''; }
if (isset($_POST['plan_diag_parcialorina_autorizado']) <> '') { $plan_diag_parcialorina_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_parcialorina_autorizado']))); } else { $plan_diag_parcialorina_autorizado = ''; }
if (isset($_POST['plan_diag_parcialorina_fecha']) <> '') { $plan_diag_parcialorina_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_parcialorina_fecha']))); } else { $plan_diag_parcialorina_fecha = ''; }
if (isset($_POST['plan_diag_parcialorina_lab']) <> '') { $plan_diag_parcialorina_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_parcialorina_lab']))); } else { $plan_diag_parcialorina_lab = ''; }
if (isset($_POST['plan_diag_parcialorina_resul']) <> '') { $plan_diag_parcialorina_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_parcialorina_resul']))); } else { $plan_diag_parcialorina_resul = ''; }
if (isset($_POST['plan_diag_coprologico']) <> '') { $plan_diag_coprologico = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_coprologico']))); } else { $plan_diag_coprologico = ''; }
if (isset($_POST['plan_diag_coprologico_autorizado']) <> '') { $plan_diag_coprologico_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_coprologico_autorizado']))); } else { $plan_diag_coprologico_autorizado = ''; }
if (isset($_POST['plan_diag_coprologico_fecha']) <> '') { $plan_diag_coprologico_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_coprologico_fecha']))); } else { $plan_diag_coprologico_fecha = ''; }
if (isset($_POST['plan_diag_coprologico_lab']) <> '') { $plan_diag_coprologico_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_coprologico_lab']))); } else { $plan_diag_coprologico_lab = ''; }
if (isset($_POST['plan_diag_coprologico_resul']) <> '') { $plan_diag_coprologico_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_coprologico_resul']))); } else { $plan_diag_coprologico_resul = ''; }
if (isset($_POST['plan_diag_citologfecal']) <> '') { $plan_diag_citologfecal = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citologfecal']))); } else { $plan_diag_citologfecal = ''; }
if (isset($_POST['plan_diag_citologfecal_autorizado']) <> '') { $plan_diag_citologfecal_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citologfecal_autorizado']))); } else { $plan_diag_citologfecal_autorizado = ''; }
if (isset($_POST['plan_diag_citologfecal_fecha']) <> '') { $plan_diag_citologfecal_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_citologfecal_fecha']))); } else { $plan_diag_citologfecal_fecha = ''; }
if (isset($_POST['plan_diag_citologfecal_lab']) <> '') { $plan_diag_citologfecal_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citologfecal_lab']))); } else { $plan_diag_citologfecal_lab = ''; }
if (isset($_POST['plan_diag_citologfecal_resul']) <> '') { $plan_diag_citologfecal_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citologfecal_resul']))); } else { $plan_diag_citologfecal_resul = ''; }
if (isset($_POST['plan_diag_citolog']) <> '') { $plan_diag_citolog = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citolog']))); } else { $plan_diag_citolog = ''; }
if (isset($_POST['plan_diag_citolog_autorizado']) <> '') { $plan_diag_citolog_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citolog_autorizado']))); } else { $plan_diag_citolog_autorizado = ''; }
if (isset($_POST['plan_diag_citolog_fecha']) <> '') { $plan_diag_citolog_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_citolog_fecha']))); } else { $plan_diag_citolog_fecha = ''; }
if (isset($_POST['plan_diag_citolog_lab']) <> '') { $plan_diag_citolog_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citolog_lab']))); } else { $plan_diag_citolog_lab = ''; }
if (isset($_POST['plan_diag_citolog_resul']) <> '') { $plan_diag_citolog_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_citolog_resul']))); } else { $plan_diag_citolog_resul = ''; }
if (isset($_POST['plan_diag_quimicsang1']) <> '') { $plan_diag_quimicsang1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang1']))); } else { $plan_diag_quimicsang1 = ''; }
if (isset($_POST['plan_diag_quimicsang1_autorizado']) <> '') { $plan_diag_quimicsang1_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang1_autorizado']))); } else { $plan_diag_quimicsang1_autorizado = ''; }
if (isset($_POST['plan_diag_quimicsang1_fecha']) <> '') { $plan_diag_quimicsang1_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_quimicsang1_fecha']))); } else { $plan_diag_quimicsang1_fecha = ''; }
if (isset($_POST['plan_diag_quimicsang1_lab']) <> '') { $plan_diag_quimicsang1_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang1_lab']))); } else { $plan_diag_quimicsang1_lab = ''; }
if (isset($_POST['plan_diag_quimicsang1_resul']) <> '') { $plan_diag_quimicsang1_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang1_resul']))); } else { $plan_diag_quimicsang1_resul = ''; }
if (isset($_POST['plan_diag_quimicsang2']) <> '') { $plan_diag_quimicsang2 = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang2']))); } else { $plan_diag_quimicsang2 = ''; }
if (isset($_POST['plan_diag_quimicsang2_autorizado']) <> '') { $plan_diag_quimicsang2_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang2_autorizado']))); } else { $plan_diag_quimicsang2_autorizado = ''; }
if (isset($_POST['plan_diag_quimicsang2_fecha']) <> '') { $plan_diag_quimicsang2_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_quimicsang2_fecha']))); } else { $plan_diag_quimicsang2_fecha = ''; }
if (isset($_POST['plan_diag_quimicsang2_lab']) <> '') { $plan_diag_quimicsang2_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang2_lab']))); } else { $plan_diag_quimicsang2_lab = ''; }
if (isset($_POST['plan_diag_quimicsang2_resul']) <> '') { $plan_diag_quimicsang2_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang2_resul']))); } else { $plan_diag_quimicsang2_resul = ''; }
if (isset($_POST['plan_diag_quimicsang3']) <> '') { $plan_diag_quimicsang3 = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang3']))); } else { $plan_diag_quimicsang3 = ''; }
if (isset($_POST['plan_diag_quimicsang3_autorizado']) <> '') { $plan_diag_quimicsang3_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang3_autorizado']))); } else { $plan_diag_quimicsang3_autorizado = ''; }
if (isset($_POST['plan_diag_quimicsang3_fecha']) <> '') { $plan_diag_quimicsang3_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_quimicsang3_fecha']))); } else { $plan_diag_quimicsang3_fecha = ''; }
if (isset($_POST['plan_diag_quimicsang3_lab']) <> '') { $plan_diag_quimicsang3_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang3_lab']))); } else { $plan_diag_quimicsang3_lab = ''; }
if (isset($_POST['plan_diag_quimicsang3_resul']) <> '') { $plan_diag_quimicsang3_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang3_resul']))); } else { $plan_diag_quimicsang3_resul = ''; }
if (isset($_POST['plan_diag_quimicsang4']) <> '') { $plan_diag_quimicsang4 = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang4']))); } else { $plan_diag_quimicsang4 = ''; }
if (isset($_POST['plan_diag_quimicsang4_autorizado']) <> '') { $plan_diag_quimicsang4_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang4_autorizado']))); } else { $plan_diag_quimicsang4_autorizado = ''; }
if (isset($_POST['plan_diag_quimicsang4_fecha']) <> '') { $plan_diag_quimicsang4_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_quimicsang4_fecha']))); } else { $plan_diag_quimicsang4_fecha = ''; }
if (isset($_POST['plan_diag_quimicsang4_lab']) <> '') { $plan_diag_quimicsang4_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang4_lab']))); } else { $plan_diag_quimicsang4_lab = ''; }
if (isset($_POST['plan_diag_quimicsang4_resul']) <> '') { $plan_diag_quimicsang4_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_quimicsang4_resul']))); } else { $plan_diag_quimicsang4_resul = ''; }
if (isset($_POST['plan_diag_rayx']) <> '') { $plan_diag_rayx = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_rayx']))); } else { $plan_diag_rayx = ''; }
if (isset($_POST['plan_diag_rayx_autorizado']) <> '') { $plan_diag_rayx_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_rayx_autorizado']))); } else { $plan_diag_rayx_autorizado = ''; }
if (isset($_POST['plan_diag_rayx_fecha']) <> '') { $plan_diag_rayx_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_rayx_fecha']))); } else { $plan_diag_rayx_fecha = ''; }
if (isset($_POST['plan_diag_rayx_lab']) <> '') { $plan_diag_rayx_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_rayx_lab']))); } else { $plan_diag_rayx_lab = ''; }
if (isset($_POST['plan_diag_rayx_resul']) <> '') { $plan_diag_rayx_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_rayx_resul']))); } else { $plan_diag_rayx_resul = ''; }
if (isset($_POST['plan_diag_usg']) <> '') { $plan_diag_usg = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_usg']))); } else { $plan_diag_usg = ''; }
if (isset($_POST['plan_diag_usg_autorizado']) <> '') { $plan_diag_usg_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_usg_autorizado']))); } else { $plan_diag_usg_autorizado = ''; }
if (isset($_POST['plan_diag_usg_fecha']) <> '') { $plan_diag_usg_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_usg_fecha']))); } else { $plan_diag_usg_fecha = ''; }
if (isset($_POST['plan_diag_usg_lab']) <> '') { $plan_diag_usg_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_usg_lab']))); } else { $plan_diag_usg_lab = ''; }
if (isset($_POST['plan_diag_usg_resul']) <> '') { $plan_diag_usg_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_usg_resul']))); } else { $plan_diag_usg_resul = ''; }
if (isset($_POST['plan_diag_cultivo']) <> '') { $plan_diag_cultivo = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cultivo']))); } else { $plan_diag_cultivo = ''; }
if (isset($_POST['plan_diag_cultivo_autorizado']) <> '') { $plan_diag_cultivo_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cultivo_autorizado']))); } else { $plan_diag_cultivo_autorizado = ''; }
if (isset($_POST['plan_diag_cultivo_fecha']) <> '') { $plan_diag_cultivo_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_cultivo_fecha']))); } else { $plan_diag_cultivo_fecha = ''; }
if (isset($_POST['plan_diag_cultivo_lab']) <> '') { $plan_diag_cultivo_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cultivo_lab']))); } else { $plan_diag_cultivo_lab = ''; }
if (isset($_POST['plan_diag_cultivo_resul']) <> '') { $plan_diag_cultivo_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_cultivo_resul']))); } else { $plan_diag_cultivo_resul = ''; }
if (isset($_POST['plan_diag_antibiograma']) <> '') { $plan_diag_antibiograma = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_antibiograma']))); } else { $plan_diag_antibiograma = ''; }
if (isset($_POST['plan_diag_antibiograma_autorizado']) <> '') { $plan_diag_antibiograma_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_antibiograma_autorizado']))); } else { $plan_diag_antibiograma_autorizado = ''; }
if (isset($_POST['plan_diag_antibiograma_fecha']) <> '') { $plan_diag_antibiograma_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_antibiograma_fecha']))); } else { $plan_diag_antibiograma_fecha = ''; }
if (isset($_POST['plan_diag_antibiograma_lab']) <> '') { $plan_diag_antibiograma_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_antibiograma_lab']))); } else { $plan_diag_antibiograma_lab = ''; }
if (isset($_POST['plan_diag_antibiograma_resul']) <> '') { $plan_diag_antibiograma_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_antibiograma_resul']))); } else { $plan_diag_antibiograma_resul = ''; }
if (isset($_POST['plan_diag_otro']) <> '') { $plan_diag_otro = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_otro']))); } else { $plan_diag_otro = ''; }
if (isset($_POST['plan_diag_otro_autorizado']) <> '') { $plan_diag_otro_autorizado = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_otro_autorizado']))); } else { $plan_diag_otro_autorizado = ''; }
if (isset($_POST['plan_diag_otro_fecha']) <> '') { $plan_diag_otro_fecha = mysqli_real_escape_string($conectar,(($_POST['plan_diag_otro_fecha']))); } else { $plan_diag_otro_fecha = ''; }
if (isset($_POST['plan_diag_otro_lab']) <> '') { $plan_diag_otro_lab = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_otro_lab']))); } else { $plan_diag_otro_lab = ''; }
if (isset($_POST['plan_diag_otro_resul']) <> '') { $plan_diag_otro_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_otro_resul']))); } else { $plan_diag_otro_resul = ''; }
if (isset($_POST['plan_diag_interpre_resul']) <> '') { $plan_diag_interpre_resul = mysqli_real_escape_string($conectar,(strtoupper($_POST['plan_diag_interpre_resul']))); } else { $plan_diag_interpre_resul = ''; }
if (isset($_POST['fecha_control']) <> '') { $fecha_control = mysqli_real_escape_string($conectar,(($_POST['fecha_control']))); } else { $fecha_control = ''; }
if (isset($_POST['cod_historia_clinica']) <> '') { $cod_historia_clinica = intval($_POST['cod_historia_clinica']); } else { $cod_historia_clinica = ''; }
if (isset($_POST['cod_cliente']) <> '') { $cod_cliente = intval($_POST['cod_cliente']); } else { $cod_cliente = ''; }
if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = mysqli_real_escape_string($conectar,(($_POST['fecha_ymd']))); } else { $fecha_ymd = ''; }
if (isset($_POST['hora']) <> '') { $hora = mysqli_real_escape_string($conectar,(($_POST['hora']))); } else { $hora = ''; }
if (isset($_POST['pagina']) <> '') { $pagina = mysqli_real_escape_string($conectar,(($_POST['pagina']))); } else { $pagina = ''; }
if (isset($_POST['costo_motivo_consulta']) <> '') { $costo_motivo_consulta = mysqli_real_escape_string($conectar,(($_POST['costo_motivo_consulta']))); } else { $costo_motivo_consulta = '0'; }
if (isset($_POST['cod_empresa']) <> '') { $cod_empresa = intval($_POST['cod_empresa']); } else { $cod_empresa = ''; }

//-----------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------//
$sqlr_actitud = "SELECT nombre_actitud FROM tbl15_actitud WHERE cod_actitud = '$cod_actitud'";
$modificar_actitud = mysqli_query($conectar, $sqlr_actitud) or die(mysqli_error($conectar));
$datos_actitud = mysqli_fetch_assoc($modificar_actitud);

$nombre_actitud                = $datos_actitud['nombre_actitud'];
//-----------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------//
$sqlr_condicion_corporal = "SELECT nombre_condicion_corporal FROM tbl15_condicion_corporal WHERE cod_condicion_corporal = '$cod_condicion_corporal'";
$modificar_condicion_corporal = mysqli_query($conectar, $sqlr_condicion_corporal) or die(mysqli_error($conectar));
$datos_condicion_corporal = mysqli_fetch_assoc($modificar_condicion_corporal);

$nombre_condicion_corporal     = $datos_condicion_corporal['nombre_condicion_corporal'];
//-----------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------//
$sqlr_estado_hidratacion = "SELECT nombre_estado_hidratacion FROM tbl15_estado_hidratacion WHERE cod_estado_hidratacion = '$cod_estado_hidratacion'";
$modificar_estado_hidratacion = mysqli_query($conectar, $sqlr_estado_hidratacion) or die(mysqli_error($conectar));
$datos_estado_hidratacion = mysqli_fetch_assoc($modificar_estado_hidratacion);

$nombre_estado_hidratacion     = $datos_estado_hidratacion['nombre_estado_hidratacion'];
//-----------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------//
$fecha_time                    = time();
$fecha_mes                     = date("Y-m", strtotime($fecha_ymd));
$fecha_mes                     = date("m", strtotime($fecha_ymd));
$fecha_anyo                    = date("Y", strtotime($fecha_ymd));
$fecha_dmy                     = date("d-m-Y", strtotime($fecha_ymd));
$fecha_reg_time                = time();
$cuenta                        = $cuenta_actual;
$cod_estado_facturacion        = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//

$actualizar_historia_clinica = "UPDATE tbl15_historia_clinica SET 
motivo = '$motivo', costo_motivo_consulta = '$costo_motivo_consulta', anamnesicos = '$anamnesicos', vacum_can = '$vacum_can', vacum_fel = '$vacum_fel', 
vacum_can_pvc = '$vacum_can_pvc', vacum_can_pvc_fecha = '$vacum_can_pvc_fecha', 
vacum_fel_pvc = '$vacum_fel_pvc', vacum_fel_pvc_fecha = '$vacum_fel_pvc_fecha', 
vacum_can_triple = '$vacum_can_triple', vacum_can_triple_fecha = '$vacum_can_triple_fecha', 
vacum_fel_triple = '$vacum_fel_triple', vacum_fel_triple_fecha = '$vacum_fel_triple_fecha', 
vacum_can_rabia = '$vacum_can_rabia', vacum_can_rabia_fecha = '$vacum_can_rabia_fecha', 
vacum_fel_rabia = '$vacum_fel_rabia', vacum_fel_rabia_fecha = '$vacum_fel_rabia_fecha', 
vacum_can_otra = '$vacum_can_otra', vacum_can_otra_fecha = '$vacum_can_otra_fecha', 
vacum_fel_otra = '$vacum_fel_otra', vacum_fel_otra_fecha = '$vacum_fel_otra_fecha', 
vacum_can_otra_cual = '$vacum_can_otra_cual', vacum_fel_otra_cual = '$vacum_fel_otra_cual', 
ult_desparacit = '$ult_desparacit', ult_desparacit_producto = '$ult_desparacit_producto', 
ult_desparacit_fecha = '$ult_desparacit_fecha', nombre_alimentacion = '$nombre_alimentacion', 
nombre_estado_reproductivo = '$nombre_estado_reproductivo', nombre_alergias = '$nombre_alergias', 
nombre_enf_ant = '$nombre_enf_ant', nombre_cirugias = '$nombre_cirugias', 
ant_fam = '$ant_fam', nombre_habitat = '$nombre_habitat', exa_fis_tllc = '$exa_fis_tllc', 
exa_fis_fc = '$exa_fis_fc', exa_fis_fresp = '$exa_fis_fresp', exa_fis_pulso = '$exa_fis_pulso', 
exa_fis_temperat = '$exa_fis_temperat', exa_fis_peso = '$exa_fis_peso', cod_actitud = '$cod_actitud', nombre_actitud = '$nombre_actitud', 
cod_condicion_corporal = '$cod_condicion_corporal', nombre_condicion_corporal = '$nombre_condicion_corporal', 
cod_estado_hidratacion = '$cod_estado_hidratacion', nombre_estado_hidratacion = '$nombre_estado_hidratacion', 
conjuntival = '$conjuntival', conjuntival_observ = '$conjuntival_observ', oral = '$oral', 
oral_observ = '$oral_observ', vulvar_prepucial = '$vulvar_prepucial', vulvar_prepucial_observ = '$vulvar_prepucial_observ', 
rectal = '$rectal', rectal_observ = '$rectal_observ', ojos = '$ojos', ojos_observ = '$ojos_observ', 
oidos = '$oidos', oidos_observ = '$oidos_observ', nodulos_linfa = '$nodulos_linfa', 
nodulos_linfa_observ = '$nodulos_linfa_observ', piel_anexos = '$piel_anexos', piel_anexos_observ = '$piel_anexos_observ', 
locomocion = '$locomocion', locomocion_observ = '$locomocion_observ', aparato_musculoesquelet = '$aparato_musculoesquelet', 
aparato_musculoesquelet_observ = '$aparato_musculoesquelet_observ', sistem_nervioso = '$sistem_nervioso', 
sistem_nervioso_observ = '$sistem_nervioso_observ', aparato_cardiovascu = '$aparato_cardiovascu', 
aparato_cardiovascu_observ = '$aparato_cardiovascu_observ', aparato_respirat = '$aparato_respirat', 
aparato_respirat_observ = '$aparato_respirat_observ', aparato_digestivo = '$aparato_digestivo', 
aparato_digestivo_observ = '$aparato_digestivo_observ', aparato_genitourinario = '$aparato_genitourinario', 
aparato_genitourinario_observ = '$aparato_genitourinario_observ', plan_diag_cuadhemat = '$plan_diag_cuadhemat', 
plan_diag_cuadhemat_autorizado = '$plan_diag_cuadhemat_autorizado', plan_diag_cuadhemat_fecha = '$plan_diag_cuadhemat_fecha', 
plan_diag_cuadhemat_lab = '$plan_diag_cuadhemat_lab', plan_diag_cuadhemat_resul = '$plan_diag_cuadhemat_resul', 
plan_diag_parcialorina = '$plan_diag_parcialorina', plan_diag_parcialorina_autorizado = '$plan_diag_parcialorina_autorizado', 
plan_diag_parcialorina_fecha = '$plan_diag_parcialorina_fecha', plan_diag_parcialorina_lab = '$plan_diag_parcialorina_lab', 
plan_diag_parcialorina_resul = '$plan_diag_parcialorina_resul', plan_diag_coprologico = '$plan_diag_coprologico', 
plan_diag_coprologico_autorizado = '$plan_diag_coprologico_autorizado', plan_diag_coprologico_fecha = '$plan_diag_coprologico_fecha', 
plan_diag_coprologico_lab = '$plan_diag_coprologico_lab', plan_diag_coprologico_resul = '$plan_diag_coprologico_resul', 
plan_diag_citologfecal = '$plan_diag_citologfecal', plan_diag_citologfecal_autorizado = '$plan_diag_citologfecal_autorizado', 
plan_diag_citologfecal_fecha = '$plan_diag_citologfecal_fecha', plan_diag_citologfecal_lab = '$plan_diag_citologfecal_lab', 
plan_diag_citologfecal_resul = '$plan_diag_citologfecal_resul', plan_diag_citolog = '$plan_diag_citolog', 
plan_diag_citolog_autorizado = '$plan_diag_citolog_autorizado', plan_diag_citolog_fecha = '$plan_diag_citolog_fecha', 
plan_diag_citolog_lab = '$plan_diag_citolog_lab', plan_diag_citolog_resul = '$plan_diag_citolog_resul', 
plan_diag_quimicsang1 = '$plan_diag_quimicsang1', plan_diag_quimicsang1_autorizado = '$plan_diag_quimicsang1_autorizado', 
plan_diag_quimicsang1_fecha = '$plan_diag_quimicsang1_fecha', plan_diag_quimicsang1_lab = '$plan_diag_quimicsang1_lab', 
plan_diag_quimicsang1_resul = '$plan_diag_quimicsang1_resul', plan_diag_quimicsang2 = '$plan_diag_quimicsang2', 
plan_diag_quimicsang2_autorizado = '$plan_diag_quimicsang2_autorizado', plan_diag_quimicsang2_fecha = '$plan_diag_quimicsang2_fecha', 
plan_diag_quimicsang2_lab = '$plan_diag_quimicsang2_lab', plan_diag_quimicsang2_resul = '$plan_diag_quimicsang2_resul', 
plan_diag_quimicsang3 = '$plan_diag_quimicsang3', plan_diag_quimicsang3_autorizado = '$plan_diag_quimicsang3_autorizado', 
plan_diag_quimicsang3_fecha = '$plan_diag_quimicsang3_fecha', plan_diag_quimicsang3_lab = '$plan_diag_quimicsang3_lab', 
plan_diag_quimicsang3_resul = '$plan_diag_quimicsang3_resul', plan_diag_quimicsang4 = '$plan_diag_quimicsang4', 
plan_diag_quimicsang4_autorizado = '$plan_diag_quimicsang4_autorizado', plan_diag_quimicsang4_fecha = '$plan_diag_quimicsang4_fecha', 
plan_diag_quimicsang4_lab = '$plan_diag_quimicsang4_lab', plan_diag_quimicsang4_resul = '$plan_diag_quimicsang4_resul', 
plan_diag_rayx = '$plan_diag_rayx', plan_diag_rayx_autorizado = '$plan_diag_rayx_autorizado', 
plan_diag_rayx_fecha = '$plan_diag_rayx_fecha', plan_diag_rayx_lab = '$plan_diag_rayx_lab', 
plan_diag_rayx_resul = '$plan_diag_rayx_resul', plan_diag_usg = '$plan_diag_usg', 
plan_diag_usg_autorizado = '$plan_diag_usg_autorizado', plan_diag_usg_fecha = '$plan_diag_usg_fecha', 
plan_diag_usg_lab = '$plan_diag_usg_lab', plan_diag_usg_resul = '$plan_diag_usg_resul', 
plan_diag_cultivo = '$plan_diag_cultivo', plan_diag_cultivo_autorizado = '$plan_diag_cultivo_autorizado', 
plan_diag_cultivo_fecha = '$plan_diag_cultivo_fecha', plan_diag_cultivo_lab = '$plan_diag_cultivo_lab', 
plan_diag_cultivo_resul = '$plan_diag_cultivo_resul', plan_diag_antibiograma = '$plan_diag_antibiograma', 
plan_diag_antibiograma_autorizado = '$plan_diag_antibiograma_autorizado', plan_diag_antibiograma_fecha = '$plan_diag_antibiograma_fecha', 
plan_diag_antibiograma_lab = '$plan_diag_antibiograma_lab', plan_diag_antibiograma_resul = '$plan_diag_antibiograma_resul', 
plan_diag_otro = '$plan_diag_otro', plan_diag_otro_autorizado = '$plan_diag_otro_autorizado', 
plan_diag_otro_fecha = '$plan_diag_otro_fecha', plan_diag_otro_lab = '$plan_diag_otro_lab', 
plan_diag_otro_resul = '$plan_diag_otro_resul', plan_diag_interpre_resul = '$plan_diag_interpre_resul', 
fecha_control = '$fecha_control', cod_cliente = '$cod_cliente', cod_estado_facturacion = '$cod_estado_facturacion', 
fecha_ymd = '$fecha_ymd', hora = '$hora', fecha_time = '$fecha_time', fecha_mes = '$fecha_mes',  
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_dmy = '$fecha_dmy', fecha_reg_time = '$fecha_reg_time', cod_empresa = '$cod_empresa', 
cod_administrador = '$cod_administrador', cuenta = '$cuenta_actual'
WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
foreach ($_POST["cod_lista_problema"] as $clave => $cod_lista_problema) { 

$nombre_lista_problema               = $_POST["nombre_lista_problema"][$clave];
$nombre_lista_maestra                = $_POST["nombre_lista_maestra"][$clave];
$nombre_diagnostico_diferencial      = $_POST["nombre_diagnostico_diferencial"][$clave];

$agregar_reg_pyg = "UPDATE tbl15_lista_problema SET nombre_lista_problema = '$nombre_lista_problema', nombre_lista_maestra = '$nombre_lista_maestra', 
nombre_diagnostico_diferencial = '$nombre_diagnostico_diferencial' WHERE (cod_lista_problema = '$cod_lista_problema')";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
}
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
foreach ($_POST["cod_plan_terapeutico"] as $clave => $cod_plan_terapeutico) { 

$plan_terapeutico_ts                 = $_POST["plan_terapeutico_ts"][$clave];
$plan_terapeutico_p                  = $_POST["plan_terapeutico_p"][$clave];
$plan_terapeutico_s                  = $_POST["plan_terapeutico_s"][$clave];
$plan_terapeutico_e                  = $_POST["plan_terapeutico_e"][$clave];
//$facturar                            = $_POST["facturar"][$clave];
$nombre_producto                     = $_POST["nombre_producto"][$clave];
$nombre_tipo_presentacion            = $_POST["nombre_tipo_presentacion"][$clave];
$posologia_cantidad                  = $_POST["posologia_cantidad"][$clave];
$posologia_peso                      = $_POST["posologia_peso"][$clave];
$und_producto                        = $_POST["und_producto"][$clave];
$nombre_via_administracion           = $_POST["nombre_via_administracion"][$clave];
$nombre_frec_duracion                = $_POST["nombre_frec_duracion"][$clave];
$cod_producto                        = $_POST["cod_producto"][$clave];
$und_producto_venta                  = $und_producto;

$sqlr_consulta = "SELECT facturar FROM tbl15_plan_terapeutico WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'";
$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
$datos_prod = mysqli_fetch_assoc($modificar_consulta);

$facturar                            = $datos_prod['facturar'];

$sqlr_consulta = "SELECT und_producto FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
$datos_prod = mysqli_fetch_assoc($modificar_consulta);

$und_producto_viejo                  = $datos_prod['und_producto'];

$agregar_reg_pyg = "UPDATE tbl15_plan_terapeutico SET plan_terapeutico_ts = '$plan_terapeutico_ts', plan_terapeutico_p = '$plan_terapeutico_p', plan_terapeutico_s = '$plan_terapeutico_s', 
plan_terapeutico_e = '$plan_terapeutico_e', facturar = '$facturar', nombre_producto = '$nombre_producto', nombre_tipo_presentacion = '$nombre_tipo_presentacion', 
posologia_cantidad = '$posologia_cantidad', posologia_peso = '$posologia_peso', und_producto = '$und_producto', nombre_via_administracion = '$nombre_via_administracion', 
nombre_frec_duracion = '$nombre_frec_duracion', cod_producto = '$cod_producto'
WHERE (cod_plan_terapeutico = '$cod_plan_terapeutico')";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

//$und_producto                        = $und_producto_viejo - $und_producto_venta;

//$agregar_reg_pyg = "UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE (cod_producto = '$cod_producto')";
//$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
}
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
foreach ($_POST["cod_auxiliar_pasante"] as $clave => $cod_auxiliar_pasante) { 

$nombre_auxiliar_pasante             = $_POST["nombre_auxiliar_pasante"][$clave];
$doc_auxiliar_pasante                = $_POST["doc_auxiliar_pasante"][$clave];
$semestre_auxiliar_pasante           = $_POST["semestre_auxiliar_pasante"][$clave];
$cod_administrador                   = $_POST["cod_administrador"][$clave];

$agregar_reg_pyg = "UPDATE tbl15_auxiliar_pasante SET nombre_auxiliar_pasante = '$nombre_auxiliar_pasante', doc_auxiliar_pasante = '$doc_auxiliar_pasante', 
semestre_auxiliar_pasante = '$semestre_auxiliar_pasante', cod_administrador = '$cod_administrador' WHERE (cod_auxiliar_pasante = '$cod_auxiliar_pasante')";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
}
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
?>
<h3>Se ha guardado correctamente la historia clinica</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_historia_clinica_individual_medico.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>&pagina=<?php echo $pagina_else ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_else?>">
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