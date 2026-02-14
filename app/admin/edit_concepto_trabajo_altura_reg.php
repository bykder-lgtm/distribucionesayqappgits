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
$cod_trabajo_altura          = intval($_POST['cod_trabajo_altura']);
$cod_cliente                 = intval($_POST['cod_cliente']);
$cod_historia_clinica        = intval($_POST['cod_historia_clinica']);
$fecha_time                  = strtotime($_POST['fecha_ymd']);
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cedula = "SELECT cedula FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$resultado_cedula = mysqli_query($conectar, $sql_cedula) or die(mysqli_error($conectar));
$data_cedula = mysqli_fetch_assoc($resultado_cedula);
$cedula = $data_cedula['cedula'];
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_hist_clinic = "SELECT motivo FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_hist_clinic = mysqli_query($conectar, $sql_hist_clinic) or die(mysqli_error($conectar));
$data_hist_clinic = mysqli_fetch_assoc($resultado_hist_clinic);
//$motivo_actilab = $data_hist_clinic['motivo'];
/* ----------------------------------------------------------------------------------------------------------/ */
if (isset($_POST['motivo_trabajo_altura']) <> '') { $motivo_trabajo_altura = addslashes($_POST['motivo_trabajo_altura']); } else { $motivo_trabajo_altura = ''; }
if (isset($_POST['trab_ant_centro_trab']) <> '') { $trab_ant_centro_trab = addslashes($_POST['trab_ant_centro_trab']); } else { $trab_ant_centro_trab = ''; }
if (isset($_POST['trab_ant_tiempo']) <> '') { $trab_ant_tiempo = addslashes($_POST['trab_ant_tiempo']); } else { $trab_ant_tiempo = ''; }
if (isset($_POST['trab_ant_puesto']) <> '') { $trab_ant_puesto = addslashes($_POST['trab_ant_puesto']); } else { $trab_ant_puesto = ''; }
if (isset($_POST['trab_ant_descrip_tarea']) <> '') { $trab_ant_descrip_tarea = addslashes($_POST['trab_ant_descrip_tarea']); } else { $trab_ant_descrip_tarea = ''; }
if (isset($_POST['trab_ant_acci_lab_secue']) <> '') { $trab_ant_acci_lab_secue = addslashes($_POST['trab_ant_acci_lab_secue']); } else { $trab_ant_acci_lab_secue = ''; }
if (isset($_POST['trab_ant_enf_prof_secue']) <> '') { $trab_ant_enf_prof_secue = addslashes($_POST['trab_ant_enf_prof_secue']); } else { $trab_ant_enf_prof_secue = ''; }
if (isset($_POST['ant_fam_diabetes']) <> '') { $ant_fam_diabetes = addslashes($_POST['ant_fam_diabetes']); } else { $ant_fam_diabetes = 'NO'; }
if (isset($_POST['ant_fam_hipertension']) <> '') { $ant_fam_hipertension = addslashes($_POST['ant_fam_hipertension']); } else { $ant_fam_hipertension = 'NO'; }
if (isset($_POST['ant_fam_cardiacas']) <> '') { $ant_fam_cardiacas = addslashes($_POST['ant_fam_cardiacas']); } else { $ant_fam_cardiacas = 'NO'; }
if (isset($_POST['ant_fam_asma']) <> '') { $ant_fam_asma = addslashes($_POST['ant_fam_asma']); } else { $ant_fam_asma = 'NO'; }
if (isset($_POST['ant_fam_convulsiones']) <> '') { $ant_fam_convulsiones = addslashes($_POST['ant_fam_convulsiones']); } else { $ant_fam_convulsiones = 'NO'; }
if (isset($_POST['ant_fam_otros']) <> '') { $ant_fam_otros = addslashes($_POST['ant_fam_otros']); } else { $ant_fam_otros = 'NO'; }
if (isset($_POST['ant_fam_cuales']) <> '') { $ant_fam_cuales = addslashes($_POST['ant_fam_cuales']); } else { $ant_fam_cuales = ''; }
if (isset($_POST['ant_gine_menarquia']) <> '') { $ant_gine_menarquia = addslashes($_POST['ant_gine_menarquia']); } else { $ant_gine_menarquia = ''; }
if (isset($_POST['ant_gine_fmu']) <> '') { $ant_gine_fmu = addslashes($_POST['ant_gine_fmu']); } else { $ant_gine_fmu = ''; }
if (isset($_POST['ant_gine_ritmo']) <> '') { $ant_gine_ritmo = addslashes($_POST['ant_gine_ritmo']); } else { $ant_gine_ritmo = ''; }
if (isset($_POST['ant_gine_g']) <> '') { $ant_gine_g = addslashes($_POST['ant_gine_g']); } else { $ant_gine_g = ''; }
if (isset($_POST['ant_gine_p']) <> '') { $ant_gine_p = addslashes($_POST['ant_gine_p']); } else { $ant_gine_p = ''; }
if (isset($_POST['ant_gine_a']) <> '') { $ant_gine_a = addslashes($_POST['ant_gine_a']); } else { $ant_gine_a = ''; }
if (isset($_POST['ant_gine_c']) <> '') { $ant_gine_c = addslashes($_POST['ant_gine_c']); } else { $ant_gine_c = ''; }
if (isset($_POST['ant_gine_ivsa']) <> '') { $ant_gine_ivsa = addslashes($_POST['ant_gine_ivsa']); } else { $ant_gine_ivsa = ''; }
if (isset($_POST['ant_gine_mpf']) <> '') { $ant_gine_mpf = addslashes($_POST['ant_gine_mpf']); } else { $ant_gine_mpf = ''; }
if (isset($_POST['ant_gine_fpp']) <> '') { $ant_gine_fpp = addslashes($_POST['ant_gine_fpp']); } else { $ant_gine_fpp = ''; }
if (isset($_POST['ant_gine_doc']) <> '') { $ant_gine_doc = addslashes($_POST['ant_gine_doc']); } else { $ant_gine_doc = ''; }
if (isset($_POST['ant_gine_fecha']) <> '') { $ant_gine_fecha = addslashes($_POST['ant_gine_fecha']); } else { $ant_gine_fecha = ''; }
if (isset($_POST['ant_gine_resultado']) <> '') { $ant_gine_resultado = addslashes($_POST['ant_gine_resultado']); } else { $ant_gine_resultado = ''; }
if (isset($_POST['ant_gine_tratamiento']) <> '') { $ant_gine_tratamiento = addslashes($_POST['ant_gine_tratamiento']); } else { $ant_gine_tratamiento = ''; }
if (isset($_POST['ant_gine_cual']) <> '') { $ant_gine_cual = addslashes($_POST['ant_gine_cual']); } else { $ant_gine_cual = ''; }
if (isset($_POST['ant_nopatolog_fuma']) <> '') { $ant_nopatolog_fuma = addslashes($_POST['ant_nopatolog_fuma']); } else { $ant_nopatolog_fuma = 'NO'; }
if (isset($_POST['ant_nopatolog_alcohol']) <> '') { $ant_nopatolog_alcohol = addslashes($_POST['ant_nopatolog_alcohol']); } else { $ant_nopatolog_alcohol = 'NO'; }
if (isset($_POST['ant_nopatolog_toxicomanias']) <> '') { $ant_nopatolog_toxicomanias = addslashes($_POST['ant_nopatolog_toxicomanias']); } else { $ant_nopatolog_toxicomanias = 'NO'; }
if (isset($_POST['ant_nopatolog_otros']) <> '') { $ant_nopatolog_otros = addslashes($_POST['ant_nopatolog_otros']); } else { $ant_nopatolog_otros = 'NO'; }
if (isset($_POST['ant_nopatolog_cuanto']) <> '') { $ant_nopatolog_cuanto = addslashes($_POST['ant_nopatolog_cuanto']); } else { $ant_nopatolog_cuanto = ''; }
if (isset($_POST['ant_person_pato_convul']) <> '') { $ant_person_pato_convul = addslashes($_POST['ant_person_pato_convul']); } else { $ant_person_pato_convul = 'NO'; }
if (isset($_POST['ant_person_pato_dificulresp']) <> '') { $ant_person_pato_dificulresp = addslashes($_POST['ant_person_pato_dificulresp']); } else { $ant_person_pato_dificulresp = 'NO'; }
if (isset($_POST['ant_person_pato_reacalerg']) <> '') { $ant_person_pato_reacalerg = addslashes($_POST['ant_person_pato_reacalerg']); } else { $ant_person_pato_reacalerg = 'NO'; }
if (isset($_POST['ant_person_pato_problemcorazon']) <> '') { $ant_person_pato_problemcorazon = addslashes($_POST['ant_person_pato_problemcorazon']); } else { $ant_person_pato_problemcorazon = 'NO'; }
if (isset($_POST['ant_person_pato_claustofob']) <> '') { $ant_person_pato_claustofob = addslashes($_POST['ant_person_pato_claustofob']); } else { $ant_person_pato_claustofob = 'NO'; }
if (isset($_POST['ant_person_pato_presionalta']) <> '') { $ant_person_pato_presionalta = addslashes($_POST['ant_person_pato_presionalta']); } else { $ant_person_pato_presionalta = 'NO'; }
if (isset($_POST['ant_person_pato_dificuloler']) <> '') { $ant_person_pato_dificuloler = addslashes($_POST['ant_person_pato_dificuloler']); } else { $ant_person_pato_dificuloler = 'NO'; }
if (isset($_POST['ant_person_pato_tomamedicam']) <> '') { $ant_person_pato_tomamedicam = addslashes($_POST['ant_person_pato_tomamedicam']); } else { $ant_person_pato_tomamedicam = 'NO'; }
if (isset($_POST['ant_person_pato_diabetes']) <> '') { $ant_person_pato_diabetes = addslashes($_POST['ant_person_pato_diabetes']); } else { $ant_person_pato_diabetes = 'NO'; }
if (isset($_POST['ant_person_pato_usalentes']) <> '') { $ant_person_pato_usalentes = addslashes($_POST['ant_person_pato_usalentes']); } else { $ant_person_pato_usalentes = 'NO'; }
if (isset($_POST['ant_person_pato_problempulmonar']) <> '') { $ant_person_pato_problempulmonar = addslashes($_POST['ant_person_pato_problempulmonar']); } else { $ant_person_pato_problempulmonar = 'NO'; }
if (isset($_POST['ant_person_pato_dificuldistinguircolor']) <> '') { $ant_person_pato_dificuldistinguircolor = addslashes($_POST['ant_person_pato_dificuldistinguircolor']); } else { $ant_person_pato_dificuldistinguircolor = 'NO'; }
if (isset($_POST['explo_fis_signovital']) <> '') { $explo_fis_signovital = addslashes($_POST['explo_fis_signovital']); } else { $explo_fis_signovital = ''; }
if (isset($_POST['explo_fis_fc']) <> '') { $explo_fis_fc = addslashes($_POST['explo_fis_fc']); } else { $explo_fis_fc = ''; }
if (isset($_POST['explo_fis_fr']) <> '') { $explo_fis_fr = addslashes($_POST['explo_fis_fr']); } else { $explo_fis_fr = ''; }
if (isset($_POST['explo_fis_ta']) <> '') { $explo_fis_ta = addslashes($_POST['explo_fis_ta']); } else { $explo_fis_ta = ''; }
if (isset($_POST['explo_fis_antropometria']) <> '') { $explo_fis_antropometria = addslashes($_POST['explo_fis_antropometria']); } else { $explo_fis_antropometria = ''; }
if (isset($_POST['explo_fis_peso']) <> '') { $explo_fis_peso = addslashes($_POST['explo_fis_peso']); } else { $explo_fis_peso = ''; }
if (isset($_POST['explo_fis_talla']) <> '') { $explo_fis_talla = addslashes($_POST['explo_fis_talla']); } else { $explo_fis_talla = ''; }
if (isset($_POST['explo_fis_imc']) <> '') { $explo_fis_imc = addslashes($_POST['explo_fis_imc']); } else { $explo_fis_imc = ''; }
if (isset($_POST['explo_fis_perimuneca']) <> '') { $explo_fis_perimuneca = addslashes($_POST['explo_fis_perimuneca']); } else { $explo_fis_perimuneca = ''; }
if (isset($_POST['explo_fis_pericintura']) <> '') { $explo_fis_pericintura = addslashes($_POST['explo_fis_pericintura']); } else { $explo_fis_pericintura = ''; }
if (isset($_POST['explo_fis_visionav']) <> '') { $explo_fis_visionav = addslashes($_POST['explo_fis_visionav']); } else { $explo_fis_visionav = ''; }
if (isset($_POST['explo_fis_od']) <> '') { $explo_fis_od = addslashes($_POST['explo_fis_od']); } else { $explo_fis_od = ''; }
if (isset($_POST['explo_fis_oi']) <> '') { $explo_fis_oi = addslashes($_POST['explo_fis_oi']); } else { $explo_fis_oi = ''; }
if (isset($_POST['explo_fis_ishihara']) <> '') { $explo_fis_ishihara = addslashes($_POST['explo_fis_ishihara']); } else { $explo_fis_ishihara = ''; }
if (isset($_POST['explo_fis_cabeza']) <> '') { $explo_fis_cabeza = addslashes($_POST['explo_fis_cabeza']); } else { $explo_fis_cabeza = ''; }
if (isset($_POST['explo_fis_cuello']) <> '') { $explo_fis_cuello = addslashes($_POST['explo_fis_cuello']); } else { $explo_fis_cuello = ''; }
if (isset($_POST['explo_fis_cadiopulm']) <> '') { $explo_fis_cadiopulm = addslashes($_POST['explo_fis_cadiopulm']); } else { $explo_fis_cadiopulm = ''; }
if (isset($_POST['explo_fis_digestivo']) <> '') { $explo_fis_digestivo = addslashes($_POST['explo_fis_digestivo']); } else { $explo_fis_digestivo = ''; }
if (isset($_POST['explo_fis_sistemmuscesquelet']) <> '') { $explo_fis_sistemmuscesquelet = addslashes($_POST['explo_fis_sistemmuscesquelet']); } else { $explo_fis_sistemmuscesquelet = ''; }
if (isset($_POST['explo_fis_pielanexos']) <> '') { $explo_fis_pielanexos = addslashes($_POST['explo_fis_pielanexos']); } else { $explo_fis_pielanexos = ''; }
if (isset($_POST['explo_fis_testromberg']) <> '') { $explo_fis_testromberg = addslashes($_POST['explo_fis_testromberg']); } else { $explo_fis_testromberg = ''; }
if (isset($_POST['explo_fis_priebmarcha']) <> '') { $explo_fis_priebmarcha = addslashes($_POST['explo_fis_priebmarcha']); } else { $explo_fis_priebmarcha = ''; }
if (isset($_POST['explo_fis_recomenespeciftrab']) <> '') { $explo_fis_recomenespeciftrab = addslashes($_POST['explo_fis_recomenespeciftrab']); } else { $explo_fis_recomenespeciftrab = ''; }
if (isset($_POST['explo_fis_recomenespecifempre']) <> '') { $explo_fis_recomenespecifempre = addslashes($_POST['explo_fis_recomenespecifempre']); } else { $explo_fis_recomenespecifempre = ''; }
if (isset($_POST['explo_fis_idx']) <> '') { $explo_fis_idx = addslashes($_POST['explo_fis_idx']); } else { $explo_fis_idx = ''; }
if (isset($_POST['nombre_acepta_trab_altura']) <> '') { $nombre_acepta_trab_altura = addslashes($_POST['nombre_acepta_trab_altura']); } else { $nombre_acepta_trab_altura = ''; }
if (isset($_POST['nombre_tipo_remision']) <> '') { $nombre_tipo_remision = addslashes($_POST['nombre_tipo_remision']); } else { $nombre_tipo_remision = ''; }
if (isset($_POST['fecha_control']) <> '') { $fecha_control = addslashes($_POST['fecha_control']); } else { $fecha_control = ''; }

$fecha_mes                   =  date("m/Y", $fecha_time);
$fecha_anyo                  =  date("Y", $fecha_time);
$fecha_ymd                   =  date("Y/m/d", $fecha_time);
$fecha_dmy                   =  date("d/m/Y", $fecha_time);
$fecha_reg_time              =  time();
$cuenta                      =  $cuenta_actual;
$cuenta_reg                  =  $cuenta_actual;
/* ----------------------------------------------------------------------------------------------------------/ */
$actualizar_historia_clinica = "UPDATE tbl15_trabajo_altura SET cod_historia_clinica = '$cod_historia_clinica', cod_cliente = '$cod_cliente',
motivo_trabajo_altura = '$motivo_trabajo_altura', trab_ant_centro_trab = '$trab_ant_centro_trab', trab_ant_tiempo = '$trab_ant_tiempo',
trab_ant_puesto = '$trab_ant_puesto', trab_ant_descrip_tarea = '$trab_ant_descrip_tarea', trab_ant_acci_lab_secue = '$trab_ant_acci_lab_secue',
trab_ant_enf_prof_secue = '$trab_ant_enf_prof_secue', ant_fam_diabetes = '$ant_fam_diabetes', ant_fam_hipertension = '$ant_fam_hipertension',
ant_fam_cardiacas = '$ant_fam_cardiacas', ant_fam_asma = '$ant_fam_asma', ant_fam_convulsiones = '$ant_fam_convulsiones',
ant_fam_otros = '$ant_fam_otros', ant_fam_cuales = '$ant_fam_cuales', ant_gine_menarquia = '$ant_gine_menarquia',
ant_gine_fmu = '$ant_gine_fmu', ant_gine_ritmo = '$ant_gine_ritmo', ant_gine_g = '$ant_gine_g',
ant_gine_p = '$ant_gine_p', ant_gine_a = '$ant_gine_a', ant_gine_c = '$ant_gine_c', ant_gine_ivsa = '$ant_gine_ivsa',
ant_gine_mpf = '$ant_gine_mpf', ant_gine_fpp = '$ant_gine_fpp', ant_gine_doc = '$ant_gine_doc', ant_gine_fecha = '$ant_gine_fecha',
ant_gine_resultado = '$ant_gine_resultado', ant_gine_tratamiento = '$ant_gine_tratamiento', ant_gine_cual = '$ant_gine_cual',
ant_nopatolog_fuma = '$ant_nopatolog_fuma', ant_nopatolog_alcohol = '$ant_nopatolog_alcohol', ant_nopatolog_toxicomanias = '$ant_nopatolog_toxicomanias',
ant_nopatolog_otros = '$ant_nopatolog_otros', ant_nopatolog_cuanto = '$ant_nopatolog_cuanto', 
ant_person_pato_convul = '$ant_person_pato_convul',
ant_person_pato_dificulresp = '$ant_person_pato_dificulresp', ant_person_pato_reacalerg = '$ant_person_pato_reacalerg',
ant_person_pato_problemcorazon = '$ant_person_pato_problemcorazon', ant_person_pato_claustofob = '$ant_person_pato_claustofob',
ant_person_pato_presionalta = '$ant_person_pato_presionalta', ant_person_pato_dificuloler = '$ant_person_pato_dificuloler',
ant_person_pato_tomamedicam = '$ant_person_pato_tomamedicam', ant_person_pato_diabetes = '$ant_person_pato_diabetes',
ant_person_pato_usalentes = '$ant_person_pato_usalentes', ant_person_pato_problempulmonar = '$ant_person_pato_problempulmonar',
ant_person_pato_dificuldistinguircolor = '$ant_person_pato_dificuldistinguircolor', 
explo_fis_signovital = '$explo_fis_signovital',
explo_fis_fc = '$explo_fis_fc', explo_fis_fr = '$explo_fis_fr', explo_fis_ta = '$explo_fis_ta',
explo_fis_antropometria = '$explo_fis_antropometria', explo_fis_peso = '$explo_fis_peso', explo_fis_talla = '$explo_fis_talla',
explo_fis_imc = '$explo_fis_imc', explo_fis_perimuneca = '$explo_fis_perimuneca', explo_fis_pericintura = '$explo_fis_pericintura',
explo_fis_visionav = '$explo_fis_visionav', explo_fis_od = '$explo_fis_od', explo_fis_oi = '$explo_fis_oi',
explo_fis_ishihara = '$explo_fis_ishihara', explo_fis_cabeza = '$explo_fis_cabeza', explo_fis_cuello = '$explo_fis_cuello',
explo_fis_cadiopulm = '$explo_fis_cadiopulm', explo_fis_digestivo = '$explo_fis_digestivo',
explo_fis_sistemmuscesquelet = '$explo_fis_sistemmuscesquelet', explo_fis_pielanexos = '$explo_fis_pielanexos',
explo_fis_testromberg = '$explo_fis_testromberg', explo_fis_priebmarcha = '$explo_fis_priebmarcha',
explo_fis_recomenespeciftrab = '$explo_fis_recomenespeciftrab', explo_fis_recomenespecifempre = '$explo_fis_recomenespecifempre',
explo_fis_idx = '$explo_fis_idx', 
nombre_acepta_trab_altura = '$nombre_acepta_trab_altura', 
nombre_tipo_remision = '$nombre_tipo_remision', fecha_control = '$fecha_control', 
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_ymd = '$fecha_ymd', fecha_dmy = '$fecha_dmy', fecha_time = '$fecha_time',
fecha_reg_time = '$fecha_reg_time', cuenta = '$cuenta', cuenta_reg = '$cuenta_reg'
WHERE cod_trabajo_altura = '$cod_trabajo_altura'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
?>
<h3>Se ha guardado correctamente la información</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="1; ../admin/lista_trabajo_altura.php">
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