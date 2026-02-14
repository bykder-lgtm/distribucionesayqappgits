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
//$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_actitud_laboral                        = intval($_POST['cod_actitud_laboral']);
$cod_cliente                                = intval($_POST['cod_cliente']);
$cod_historia_clinica                       = intval($_POST['cod_historia_clinica']);
$fecha_time                                 = strtotime($_POST['fecha_ymd']);
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cedula = "SELECT cedula FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$resultado_cedula = mysqli_query($conectar, $sql_cedula) or die(mysqli_error($conectar));
$data_cedula = mysqli_fetch_assoc($resultado_cedula);
$cedula                                     = $data_cedula['cedula'];
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_hist_clinic = "SELECT motivo, cod_grupo_area, cod_grupo_area_cargo, costo_motivo_consulta, cod_factura, nombre_ocupacion, 
nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, 
exa_fis_talla, exa_fis_peso, exa_fis_imc, exa_fis_interpreimc, exa_fis_fresp, exa_fis_ta, 
exa_fis_fc, exa_fis_lateral, exa_fis_periabdom, exa_fis_temperat, exa_fis_ojoder_sncorre_vlejan, exa_fis_ojoder_sncorre_vcerca, 
exa_fis_ojoder_cncorre_vlejan, exa_fis_ojoder_cncorre_vcerca, exa_fis_ojoizq_sncorre_vlejan, exa_fis_ojoizq_sncorre_vcerca, 
exa_fis_ojoizq_cncorre_vlejan, exa_fis_ojoizq_cncorre_vcerca, exa_fis_ojoamb_sncorre_vlejan, exa_fis_ojoamb_sncorre_vcerca, 
exa_fis_oojoamb_cncorre_vlejan, exa_fis_ojoamb_cncorre_vcerca FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_hist_clinic = mysqli_query($conectar, $sql_hist_clinic) or die(mysqli_error($conectar));
$data_hist_clinic = mysqli_fetch_assoc($resultado_hist_clinic);
//$motivo_actilab = $data_hist_clinic['motivo'];
$nombre_tipo_remision                       = '';
$cod_grupo_area                             = $data_hist_clinic['cod_grupo_area'];
$cod_grupo_area_cargo                       = $data_hist_clinic['cod_grupo_area_cargo'];
$costo_motivo_consulta                      = $data_hist_clinic['costo_motivo_consulta'];
$cod_factura                                = $data_hist_clinic['cod_factura'];
$nombre_ocupacion                           = $data_hist_clinic['nombre_ocupacion'];
$nombre_empresa                             = $data_hist_clinic['nombre_empresa'];
$cargo_empresa                              = $data_hist_clinic['cargo_empresa'];
$area_empresa                               = $data_hist_clinic['area_empresa'];
$ciudad_empresa                             = $data_hist_clinic['ciudad_empresa'];
$nombre_empresa_contratante                 = $data_hist_clinic['nombre_empresa_contratante'];
$exa_fis_talla                              = $data_hist_clinic['exa_fis_talla'];
$exa_fis_peso                               = $data_hist_clinic['exa_fis_peso'];
$exa_fis_imc                                = $data_hist_clinic['exa_fis_imc'];
$exa_fis_interpreimc                        = $data_hist_clinic['exa_fis_interpreimc'];
$exa_fis_fresp                              = $data_hist_clinic['exa_fis_fresp'];
$exa_fis_ta                                 = $data_hist_clinic['exa_fis_ta'];
$exa_fis_fc                                 = $data_hist_clinic['exa_fis_fc'];
$exa_fis_lateral                            = $data_hist_clinic['exa_fis_lateral'];
$exa_fis_periabdom                          = $data_hist_clinic['exa_fis_periabdom'];
$exa_fis_temperat                           = $data_hist_clinic['exa_fis_temperat'];
$exa_fis_ojoder_sncorre_vlejan              = $data_hist_clinic['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca              = $data_hist_clinic['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan              = $data_hist_clinic['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca              = $data_hist_clinic['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan              = $data_hist_clinic['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca              = $data_hist_clinic['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan              = $data_hist_clinic['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca              = $data_hist_clinic['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan              = $data_hist_clinic['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca              = $data_hist_clinic['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan             = $data_hist_clinic['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca              = $data_hist_clinic['exa_fis_ojoamb_cncorre_vcerca'];
$estructura_remision                        = '';
/* ----------------------------------------------------------------------------------------------------------/ */
if (isset($_POST['motivo_actilab']) <> '') { $motivo_actilab = addslashes($_POST['motivo_actilab']); } else { $motivo_actilab = ''; }
if (isset($_POST['aptdesemp_carg']) <> '') { $aptdesemp_carg = addslashes($_POST['aptdesemp_carg']); } else { $aptdesemp_carg = ''; }
if (isset($_POST['present_restric']) <> '') { $present_restric = addslashes($_POST['present_restric']); } else { $present_restric = ''; }
if (isset($_POST['aplazad']) <> '') { $aplazad = addslashes($_POST['aplazad']); } else { $aplazad = ''; }
if (isset($_POST['contin_lab1']) <> '') { $contin_lab1 = addslashes($_POST['contin_lab1']); } else { $contin_lab1 = ''; }
if (isset($_POST['aplaz1']) <> '') { $aplaz1 = addslashes($_POST['aplaz1']); } else { $aplaz1 = ''; }
if (isset($_POST['resig_tarea1']) <> '') { $resig_tarea1 = addslashes($_POST['resig_tarea1']); } else { $resig_tarea1 = ''; }
if (isset($_POST['temporal1']) <> '') { $temporal1 = addslashes($_POST['temporal1']); } else { $temporal1 = ''; }
if (isset($_POST['contin_lab2']) <> '') { $contin_lab2 = addslashes($_POST['contin_lab2']); } else { $contin_lab2 = ''; }
if (isset($_POST['aplaz2']) <> '') { $aplaz2 = addslashes($_POST['aplaz2']); } else { $aplaz2 = ''; }
if (isset($_POST['resig_tarea2']) <> '') { $resig_tarea2 = addslashes($_POST['resig_tarea2']); } else { $resig_tarea2 = ''; }
if (isset($_POST['temporal2']) <> '') { $temporal2 = addslashes($_POST['temporal2']); } else { $temporal2 = ''; }
if (isset($_POST['rein_trab']) <> '') { $rein_trab = addslashes($_POST['rein_trab']); } else { $rein_trab = ''; }
if (isset($_POST['aplaz3']) <> '') { $aplaz3 = addslashes($_POST['aplaz3']); } else { $aplaz3 = ''; }
if (isset($_POST['resig_tarea3']) <> '') { $resig_tarea3 = addslashes($_POST['resig_tarea3']); } else { $resig_tarea3 = ''; }
if (isset($_POST['temporal3']) <> '') { $temporal3 = addslashes($_POST['temporal3']); } else { $temporal3 = ''; }
if (isset($_POST['realiz']) <> '') { $realiz = addslashes($_POST['realiz']); } else { $realiz = ''; }
if (isset($_POST['exacomple_opto']) <> '') { $exacomple_opto = addslashes($_POST['exacomple_opto']); } else { $exacomple_opto = ''; }
if (isset($_POST['exacomple_espiro']) <> '') { $exacomple_espiro = addslashes($_POST['exacomple_espiro']); } else { $exacomple_espiro = ''; }
if (isset($_POST['exacomple_audi']) <> '') { $exacomple_audi = addslashes($_POST['exacomple_audi']); } else { $exacomple_audi = ''; }
if (isset($_POST['exacomple_psico']) <> '') { $exacomple_psico = addslashes($_POST['exacomple_psico']); } else { $exacomple_psico = ''; }
if (isset($_POST['exacomple_visio']) <> '') { $exacomple_visio = addslashes($_POST['exacomple_visio']); } else { $exacomple_visio = ''; }
if (isset($_POST['exacomple_lab']) <> '') { $exacomple_lab = addslashes($_POST['exacomple_lab']); } else { $exacomple_lab = ''; }
if (isset($_POST['exacomple_otro']) <> '') { $exacomple_otro = addslashes($_POST['exacomple_otro']); } else { $exacomple_otro = ''; }
if (isset($_POST['acuedenfa_segvial_apto']) <> '') { $acuedenfa_segvial_apto = addslashes($_POST['acuedenfa_segvial_apto']); } else { $acuedenfa_segvial_apto = ''; }
if (isset($_POST['acuedenfa_segvial_nocump']) <> '') { $acuedenfa_segvial_nocump = addslashes($_POST['acuedenfa_segvial_nocump']); } else { $acuedenfa_segvial_nocump = ''; }
if (isset($_POST['acuedenfa_segvial_aplaz']) <> '') { $acuedenfa_segvial_aplaz = addslashes($_POST['acuedenfa_segvial_aplaz']); } else { $acuedenfa_segvial_aplaz = ''; }
if (isset($_POST['acuedenfa_segvial_obser']) <> '') { $acuedenfa_segvial_obser = addslashes($_POST['acuedenfa_segvial_obser']); } else { $acuedenfa_segvial_obser = ''; }
if (isset($_POST['acuedenfa_espconf_apto']) <> '') { $acuedenfa_espconf_apto = addslashes($_POST['acuedenfa_espconf_apto']); } else { $acuedenfa_espconf_apto = ''; }
if (isset($_POST['acuedenfa_espconf_nocump']) <> '') { $acuedenfa_espconf_nocump = addslashes($_POST['acuedenfa_espconf_nocump']); } else { $acuedenfa_espconf_nocump = ''; }
if (isset($_POST['acuedenfa_espconf_aplaz']) <> '') { $acuedenfa_espconf_aplaz = addslashes($_POST['acuedenfa_espconf_aplaz']); } else { $acuedenfa_espconf_aplaz = ''; }
if (isset($_POST['acuedenfa_espconf_obser']) <> '') { $acuedenfa_espconf_obser = addslashes($_POST['acuedenfa_espconf_obser']); } else { $acuedenfa_espconf_obser = ''; }
if (isset($_POST['acuedenfa_altu_apto']) <> '') { $acuedenfa_altu_apto = addslashes($_POST['acuedenfa_altu_apto']); } else { $acuedenfa_altu_apto = ''; }
if (isset($_POST['acuedenfa_altu_nocump']) <> '') { $acuedenfa_altu_nocump = addslashes($_POST['acuedenfa_altu_nocump']); } else { $acuedenfa_altu_nocump = ''; }
if (isset($_POST['acuedenfa_altu_aplaz']) <> '') { $acuedenfa_altu_aplaz = addslashes($_POST['acuedenfa_altu_aplaz']); } else { $acuedenfa_altu_aplaz = ''; }
if (isset($_POST['acuedenfa_altu_obser']) <> '') { $acuedenfa_altu_obser = addslashes($_POST['acuedenfa_altu_obser']); } else { $acuedenfa_altu_obser = ''; }
if (isset($_POST['acuedenfa_alime_apto']) <> '') { $acuedenfa_alime_apto = addslashes($_POST['acuedenfa_alime_apto']); } else { $acuedenfa_alime_apto = ''; }
if (isset($_POST['acuedenfa_alime_nocump']) <> '') { $acuedenfa_alime_nocump = addslashes($_POST['acuedenfa_alime_nocump']); } else { $acuedenfa_alime_nocump = ''; }
if (isset($_POST['acuedenfa_alime_aplaz']) <> '') { $acuedenfa_alime_aplaz = addslashes($_POST['acuedenfa_alime_aplaz']); } else { $acuedenfa_alime_aplaz = ''; }
if (isset($_POST['acuedenfa_alime_obser']) <> '') { $acuedenfa_alime_obser = addslashes($_POST['acuedenfa_alime_obser']); } else { $acuedenfa_alime_obser = ''; }
if (isset($_POST['acuedenfa_actdepor_apto']) <> '') { $acuedenfa_actdepor_apto = addslashes($_POST['acuedenfa_actdepor_apto']); } else { $acuedenfa_actdepor_apto = ''; }
if (isset($_POST['acuedenfa_actdepor_nocump']) <> '') { $acuedenfa_actdepor_nocump = addslashes($_POST['acuedenfa_actdepor_nocump']); } else { $acuedenfa_actdepor_nocump = ''; }
if (isset($_POST['acuedenfa_actdepor_aplaz']) <> '') { $acuedenfa_actdepor_aplaz = addslashes($_POST['acuedenfa_actdepor_aplaz']); } else { $acuedenfa_actdepor_aplaz = ''; }
if (isset($_POST['acuedenfa_actdepor_obser']) <> '') { $acuedenfa_actdepor_obser = addslashes($_POST['acuedenfa_actdepor_obser']); } else { $acuedenfa_actdepor_obser = ''; }
if (isset($_POST['acuedenfa_brigad_apto']) <> '') { $acuedenfa_brigad_apto = addslashes($_POST['acuedenfa_brigad_apto']); } else { $acuedenfa_brigad_apto = ''; }
if (isset($_POST['acuedenfa_brigad_nocump']) <> '') { $acuedenfa_brigad_nocump = addslashes($_POST['acuedenfa_brigad_nocump']); } else { $acuedenfa_brigad_nocump = ''; }
if (isset($_POST['acuedenfa_brigad_aplaz']) <> '') { $acuedenfa_brigad_aplaz = addslashes($_POST['acuedenfa_brigad_aplaz']); } else { $acuedenfa_brigad_aplaz = ''; }
if (isset($_POST['acuedenfa_brigad_obser']) <> '') { $acuedenfa_brigad_obser = addslashes($_POST['acuedenfa_brigad_obser']); } else { $acuedenfa_brigad_obser = ''; }
if (isset($_POST['acuedenfa_medica_apto']) <> '') { $acuedenfa_medica_apto = addslashes($_POST['acuedenfa_medica_apto']); } else { $acuedenfa_medica_apto = ''; }
if (isset($_POST['acuedenfa_medica_nocump']) <> '') { $acuedenfa_medica_nocump = addslashes($_POST['acuedenfa_medica_nocump']); } else { $acuedenfa_medica_nocump = ''; }
if (isset($_POST['acuedenfa_medica_aplaz']) <> '') { $acuedenfa_medica_aplaz = addslashes($_POST['acuedenfa_medica_aplaz']); } else { $acuedenfa_medica_aplaz = ''; }
if (isset($_POST['acuedenfa_medica_obser']) <> '') { $acuedenfa_medica_obser = addslashes($_POST['acuedenfa_medica_obser']); } else { $acuedenfa_medica_obser = ''; }
if (isset($_POST['acuedenfa_realiz']) <> '') { $acuedenfa_realiz = addslashes($_POST['acuedenfa_realiz']); } else { $acuedenfa_realiz = ''; }
if (isset($_POST['acuedenfa_realiz_obser']) <> '') { $acuedenfa_realiz_obser = addslashes($_POST['acuedenfa_realiz_obser']); } else { $acuedenfa_realiz_obser = ''; }
if (isset($_POST['enfosteo_contperocupa']) <> '') { $enfosteo_contperocupa = addslashes($_POST['enfosteo_contperocupa']); } else { $enfosteo_contperocupa = ''; }
if (isset($_POST['enfosteo_contperpromprev']) <> '') { $enfosteo_contperpromprev = addslashes($_POST['enfosteo_contperpromprev']); } else { $enfosteo_contperpromprev = ''; }
if (isset($_POST['enfosteo_habnutsalud']) <> '') { $enfosteo_habnutsalud = addslashes($_POST['enfosteo_habnutsalud']); } else { $enfosteo_habnutsalud = ''; }
if (isset($_POST['enfosteo_eppelemprot']) <> '') { $enfosteo_eppelemprot = addslashes($_POST['enfosteo_eppelemprot']); } else { $enfosteo_eppelemprot = ''; }
if (isset($_POST['enfosteo_manejmedic']) <> '') { $enfosteo_manejmedic = addslashes($_POST['enfosteo_manejmedic']); } else { $enfosteo_manejmedic = ''; }
if (isset($_POST['enfosteo_ejerreg']) <> '') { $enfosteo_ejerreg = addslashes($_POST['enfosteo_ejerreg']); } else { $enfosteo_ejerreg = ''; }
if (isset($_POST['enfosteo_dejhabitfum']) <> '') { $enfosteo_dejhabitfum = addslashes($_POST['enfosteo_dejhabitfum']); } else { $enfosteo_dejhabitfum = ''; }
if (isset($_POST['enfosteo_contnutrieps']) <> '') { $enfosteo_contnutrieps = addslashes($_POST['enfosteo_contnutrieps']); } else { $enfosteo_contnutrieps = ''; }
if (isset($_POST['enfosteo_redconsualcoh']) <> '') { $enfosteo_redconsualcoh = addslashes($_POST['enfosteo_redconsualcoh']); } else { $enfosteo_redconsualcoh = ''; }
if (isset($_POST['enfosteo_realpruebcomp']) <> '') { $enfosteo_realpruebcomp = addslashes($_POST['enfosteo_realpruebcomp']); } else { $enfosteo_realpruebcomp = ''; }
if (isset($_POST['enfosteo_remieps']) <> '') { $enfosteo_remieps = addslashes($_POST['enfosteo_remieps']); } else { $enfosteo_remieps = ''; }
if (isset($_POST['enfosteo_contperpypeps']) <> '') { $enfosteo_contperpypeps = addslashes($_POST['enfosteo_contperpypeps']); } else { $enfosteo_contperpypeps = ''; }
if (isset($_POST['enfosteo_remiepsmedigenesp']) <> '') { $enfosteo_remiepsmedigenesp = addslashes($_POST['enfosteo_remiepsmedigenesp']); } else { $enfosteo_remiepsmedigenesp = ''; }
if (isset($_POST['enfosteo_eppcarg']) <> '') { $enfosteo_eppcarg = addslashes($_POST['enfosteo_eppcarg']); } else { $enfosteo_eppcarg = ''; }
if (isset($_POST['enfosteo_pausactiva']) <> '') { $enfosteo_pausactiva = addslashes($_POST['enfosteo_pausactiva']); } else { $enfosteo_pausactiva = ''; }
if (isset($_POST['enfosteo_ingrepve']) <> '') { $enfosteo_ingrepve = addslashes($_POST['enfosteo_ingrepve']); } else { $enfosteo_ingrepve = ''; }
if (isset($_POST['enfosteo_pausaergo']) <> '') { $enfosteo_pausaergo = addslashes($_POST['enfosteo_pausaergo']); } else { $enfosteo_pausaergo = ''; }
if (isset($_POST['enfosteo_bloqsolar']) <> '') { $enfosteo_bloqsolar = addslashes($_POST['enfosteo_bloqsolar']); } else { $enfosteo_bloqsolar = ''; }
if (isset($_POST['enfosteo_recommanejcarg']) <> '') { $enfosteo_recommanejcarg = addslashes($_POST['enfosteo_recommanejcarg']); } else { $enfosteo_recommanejcarg = ''; }
if (isset($_POST['enfosteo_observ']) <> '') { $enfosteo_observ = addslashes($_POST['enfosteo_observ']); } else { $enfosteo_observ = ''; }
if (isset($_POST['prio_osteo']) <> '') { $prio_osteo = addslashes($_POST['prio_osteo']); } else { $prio_osteo = ''; }
if (isset($_POST['prio_manialiment']) <> '') { $prio_manialiment = addslashes($_POST['prio_manialiment']); } else { $prio_manialiment = ''; }
if (isset($_POST['prio_visual']) <> '') { $prio_visual = addslashes($_POST['prio_visual']); } else { $prio_visual = ''; }
if (isset($_POST['prio_altura']) <> '') { $prio_altura = addslashes($_POST['prio_altura']); } else { $prio_altura = ''; }
if (isset($_POST['prio_piel']) <> '') { $prio_piel = addslashes($_POST['prio_piel']); } else { $prio_piel = ''; }
if (isset($_POST['prio_resp']) <> '') { $prio_resp = addslashes($_POST['prio_resp']); } else { $prio_resp = ''; }
if (isset($_POST['prio_biolog']) <> '') { $prio_biolog = addslashes($_POST['prio_biolog']); } else { $prio_biolog = ''; }
if (isset($_POST['prio_tempextem']) <> '') { $prio_tempextem = addslashes($_POST['prio_tempextem']); } else { $prio_tempextem = ''; }
if (isset($_POST['prio_espconfi']) <> '') { $prio_espconfi = addslashes($_POST['prio_espconfi']); } else { $prio_espconfi = ''; }
if (isset($_POST['prio_cuidvoz']) <> '') { $prio_cuidvoz = addslashes($_POST['prio_cuidvoz']); } else { $prio_cuidvoz = ''; }
if (isset($_POST['prio_quim']) <> '') { $prio_quim = addslashes($_POST['prio_quim']); } else { $prio_quim = ''; }
if (isset($_POST['prio_audi']) <> '') { $prio_audi = addslashes($_POST['prio_audi']); } else { $prio_audi = ''; }
if (isset($_POST['recomend_emp']) <> '') { $recomend_emp = addslashes($_POST['recomend_emp']); } else { $recomend_emp = ''; }
if (isset($_POST['recomend_trab']) <> '') { $recomend_trab = addslashes($_POST['recomend_trab']); } else { $recomend_trab = ''; }
if (isset($_POST['prio_otro']) <> '') { $prio_otro = addslashes($_POST['prio_otro']); } else { $prio_otro = ''; }
if (isset($_POST['prio_otro_descripcion']) <> '') { $prio_otro_descripcion = addslashes($_POST['prio_otro_descripcion']); } else { $prio_otro_descripcion = ''; }
if (isset($_POST['temporal1_num']) <> '') { $temporal1_num = intval($_POST['temporal1_num']); } else { $temporal1_num = ''; }
if (isset($_POST['temporal2_num']) <> '') { $temporal2_num = intval($_POST['temporal2_num']); } else { $temporal2_num = ''; }
if (isset($_POST['temporal3_num']) <> '') { $temporal3_num = intval($_POST['temporal3_num']); } else { $temporal3_num = ''; }
if (isset($_POST['enfosteo_retroparaclinicexamen']) <> '') { $enfosteo_retroparaclinicexamen = addslashes($_POST['enfosteo_retroparaclinicexamen']); } else { $enfosteo_retroparaclinicexamen = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
$fecha_mes                   =  date("m/Y", $fecha_time);
$fecha_anyo                  =  date("Y", $fecha_time);
$fecha_ymd                   =  date("Y/m/d", $fecha_time);
$fecha_dmy                   =  date("d/m/Y", $fecha_time);
$fecha_reg_time              =  time();
$cuenta                      =  $cuenta_actual;
$cuenta_reg                  =  $cuenta_actual;
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_autoincremento_remision = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_remision'";
$exec_autoincremento_remision = mysqli_query($conectar, $sql_autoincremento_remision) or die(mysqli_error($conectar));
$datos_autoincremento_remision = mysqli_fetch_assoc($exec_autoincremento_remision);
$cod_remision                = $datos_autoincremento_remision['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
$actualizar_historia_clinica = "UPDATE tbl15_actitud_laboral SET motivo_actilab = '$motivo_actilab', aptdesemp_carg = '$aptdesemp_carg', present_restric = '$present_restric',
aplazad = '$aplazad', contin_lab1 = '$contin_lab1', aplaz1 = '$aplaz1', resig_tarea1 = '$resig_tarea1',
temporal1 = '$temporal1', contin_lab2 = '$contin_lab2', aplaz2 = '$aplaz2', resig_tarea2 = '$resig_tarea2',
temporal2 = '$temporal2', rein_trab = '$rein_trab', aplaz3 = '$aplaz3', resig_tarea3 = '$resig_tarea3',
temporal3 = '$temporal3', realiz = '$realiz', exacomple_opto = '$exacomple_opto', exacomple_espiro = '$exacomple_espiro',
exacomple_audi = '$exacomple_audi', exacomple_psico = '$exacomple_psico', exacomple_visio = '$exacomple_visio', exacomple_lab = '$exacomple_lab',
exacomple_otro = '$exacomple_otro', acuedenfa_segvial_apto = '$acuedenfa_segvial_apto', acuedenfa_segvial_nocump = '$acuedenfa_segvial_nocump', 
acuedenfa_segvial_aplaz = '$acuedenfa_segvial_aplaz', acuedenfa_segvial_obser = '$acuedenfa_segvial_obser',
acuedenfa_espconf_apto = '$acuedenfa_espconf_apto', acuedenfa_espconf_nocump = '$acuedenfa_espconf_nocump',
acuedenfa_espconf_aplaz = '$acuedenfa_espconf_aplaz', acuedenfa_espconf_obser = '$acuedenfa_espconf_obser',
acuedenfa_altu_apto = '$acuedenfa_altu_apto', acuedenfa_altu_nocump = '$acuedenfa_altu_nocump',
acuedenfa_altu_aplaz = '$acuedenfa_altu_aplaz', acuedenfa_altu_obser = '$acuedenfa_altu_obser',
acuedenfa_alime_apto = '$acuedenfa_alime_apto', acuedenfa_alime_nocump = '$acuedenfa_alime_nocump',
acuedenfa_alime_aplaz = '$acuedenfa_alime_aplaz', acuedenfa_alime_obser = '$acuedenfa_alime_obser',
acuedenfa_actdepor_apto = '$acuedenfa_actdepor_apto', acuedenfa_actdepor_nocump = '$acuedenfa_actdepor_nocump',
acuedenfa_actdepor_aplaz = '$acuedenfa_actdepor_aplaz', acuedenfa_actdepor_obser = '$acuedenfa_actdepor_obser',
acuedenfa_brigad_apto = '$acuedenfa_brigad_apto', acuedenfa_brigad_nocump = '$acuedenfa_brigad_nocump',
acuedenfa_brigad_aplaz = '$acuedenfa_brigad_aplaz', acuedenfa_brigad_obser = '$acuedenfa_brigad_obser',
acuedenfa_medica_apto = '$acuedenfa_medica_apto', acuedenfa_medica_nocump = '$acuedenfa_medica_nocump',
acuedenfa_medica_aplaz = '$acuedenfa_medica_aplaz', acuedenfa_medica_obser = '$acuedenfa_medica_obser',
acuedenfa_realiz = '$acuedenfa_realiz', acuedenfa_realiz_obser = '$acuedenfa_realiz_obser',
enfosteo_contperocupa = '$enfosteo_contperocupa', enfosteo_contperpromprev = '$enfosteo_contperpromprev',
enfosteo_habnutsalud = '$enfosteo_habnutsalud', enfosteo_eppelemprot = '$enfosteo_eppelemprot',
enfosteo_manejmedic = '$enfosteo_manejmedic', enfosteo_ejerreg = '$enfosteo_ejerreg',
enfosteo_dejhabitfum = '$enfosteo_dejhabitfum', enfosteo_contnutrieps = '$enfosteo_contnutrieps',
enfosteo_redconsualcoh = '$enfosteo_redconsualcoh', enfosteo_realpruebcomp = '$enfosteo_realpruebcomp',
enfosteo_remieps = '$enfosteo_remieps', enfosteo_contperpypeps = '$enfosteo_contperpypeps', 
enfosteo_remiepsmedigenesp = '$enfosteo_remiepsmedigenesp', enfosteo_eppcarg = '$enfosteo_eppcarg', 
enfosteo_pausactiva = '$enfosteo_pausactiva', enfosteo_ingrepve = '$enfosteo_ingrepve', 
enfosteo_pausaergo = '$enfosteo_pausaergo', enfosteo_bloqsolar = '$enfosteo_bloqsolar', 
enfosteo_recommanejcarg = '$enfosteo_recommanejcarg', 
enfosteo_observ = '$enfosteo_observ', prio_osteo = '$prio_osteo', prio_manialiment = '$prio_manialiment', 
prio_visual = '$prio_visual', prio_altura = '$prio_altura', prio_piel = '$prio_piel', prio_resp = '$prio_resp',
prio_biolog = '$prio_biolog', prio_tempextem = '$prio_tempextem', prio_espconfi = '$prio_espconfi', prio_cuidvoz = '$prio_cuidvoz',
prio_quim = '$prio_quim', prio_audi = '$prio_audi', recomend_emp = '$recomend_emp', recomend_trab = '$recomend_trab',
prio_otro = '$prio_otro', temporal1_num = '$temporal1_num', temporal2_num = '$temporal2_num', temporal3_num = '$temporal3_num',
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_ymd = '$fecha_ymd', fecha_dmy = '$fecha_dmy',
fecha_time = '$fecha_time', fecha_reg_time = '$fecha_reg_time', cuenta = '$cuenta', cuenta_reg = '$cuenta_reg', 
enfosteo_retroparaclinicexamen = '$enfosteo_retroparaclinicexamen' 
WHERE cod_actitud_laboral = '$cod_actitud_laboral'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$actualizar_trabajo_altura = "UPDATE tbl15_trabajo_altura SET explo_fis_recomenespecifempre = '$recomend_emp', 
explo_fis_recomenespeciftrab = '$recomend_trab' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_trabajo_altura = mysqli_query($conectar, $actualizar_trabajo_altura) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cedula = "SELECT cod_remision FROM tbl15_remision WHERE cod_actitud_laboral = '$cod_actitud_laboral'";
$resultado_cedula = mysqli_query($conectar, $sql_cedula) or die(mysqli_error($conectar));
$existe_remision = mysqli_num_rows($resultado_cedula);
/* ----------------------------------------------------------------------------------------------------------/ */
if (($enfosteo_remieps <> '') && ($existe_remision == 0)) { 

$sql_data = "INSERT INTO tbl15_remision (cod_actitud_laboral, cod_historia_clinica, cod_cliente, cod_administrador, motivo, nombre_tipo_remision, enfosteo_remieps, 
cod_grupo_area, cod_grupo_area_cargo, costo_motivo_consulta, cod_factura, nombre_ocupacion, 
nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, 
exa_fis_talla, exa_fis_peso, exa_fis_imc, exa_fis_interpreimc, exa_fis_fresp, exa_fis_ta, exa_fis_fc, 
exa_fis_lateral, exa_fis_periabdom, exa_fis_temperat, exa_fis_ojoder_sncorre_vlejan, exa_fis_ojoder_sncorre_vcerca, 
exa_fis_ojoder_cncorre_vlejan, exa_fis_ojoder_cncorre_vcerca, exa_fis_ojoizq_sncorre_vlejan, exa_fis_ojoizq_sncorre_vcerca, 
exa_fis_ojoizq_cncorre_vlejan, exa_fis_ojoizq_cncorre_vcerca, exa_fis_ojoamb_sncorre_vlejan, exa_fis_ojoamb_sncorre_vcerca, 
exa_fis_oojoamb_cncorre_vlejan, exa_fis_ojoamb_cncorre_vcerca, estructura_remision, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$cod_actitud_laboral', '$cod_historia_clinica', '$cod_cliente', '$cod_administrador', '$motivo_actilab', '$nombre_tipo_remision', '$enfosteo_remieps', 
'$cod_grupo_area', '$cod_grupo_area_cargo', '$costo_motivo_consulta', '$cod_factura', '$nombre_ocupacion', 
'$nombre_empresa', '$cargo_empresa', '$area_empresa', '$ciudad_empresa', '$nombre_empresa_contratante', 
'$exa_fis_talla', '$exa_fis_peso', '$exa_fis_imc', '$exa_fis_interpreimc', '$exa_fis_fresp', '$exa_fis_ta', '$exa_fis_fc', 
'$exa_fis_lateral', '$exa_fis_periabdom', '$exa_fis_temperat', '$exa_fis_ojoder_sncorre_vlejan', '$exa_fis_ojoder_sncorre_vcerca', 
'$exa_fis_ojoder_cncorre_vlejan', '$exa_fis_ojoder_cncorre_vcerca', '$exa_fis_ojoizq_sncorre_vlejan', '$exa_fis_ojoizq_sncorre_vcerca', 
'$exa_fis_ojoizq_cncorre_vlejan', '$exa_fis_ojoizq_cncorre_vcerca', '$exa_fis_ojoamb_sncorre_vlejan', '$exa_fis_ojoamb_sncorre_vcerca', 
'$exa_fis_oojoamb_cncorre_vlejan', '$exa_fis_ojoamb_cncorre_vcerca', '$estructura_remision', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<h3>Se ha guardado correctamente la información</h3>
<?php if (($enfosteo_remieps <> '') && ($existe_remision == 0))  { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_remision.php?cod_remision=<?php echo $cod_remision ?>&cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>&pagina=../admin/lista_concepto_actitud_laboral.php">
<!--<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/reg_remision.php?cod_remision=<?php echo $cod_remision ?>&cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>&pagina=../admin/lista_concepto_actitud_laboral.php">-->
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_concepto_actitud_laboral.php">
<?php } } ?>
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