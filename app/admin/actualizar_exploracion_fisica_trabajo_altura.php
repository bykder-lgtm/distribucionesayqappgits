<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#"><h4>ACTUALIZANDO</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
//$fecha_hoy = date("Y/m/d");
$pagina                       = addslashes($_GET['pagina']);
$cod_historia_clinica         = intval($_GET['cod_historia_clinica']);
$cod_trabajo_altura           = intval($_GET['cod_trabajo_altura']);

$pagina_redirec = $pagina.'?cod_trabajo_altura='.$cod_trabajo_altura.'&cod_historia_clinica='.$cod_historia_clinica.'&pagina='.$pagina;

if (isset($_GET['cod_trabajo_altura'])) {

$obtener_estructura_hist_clinica = "SELECT motivo, exa_fis_fc, exa_fis_fresp, exa_fis_ta, exa_fis_peso, exa_fis_talla, 
exa_fis_imc, exa_fis_periabdom, ant_gine_prim_mestrua, ant_gine_fum, ant_gine_fich_gine_g, ant_gine_fich_gine_p, 
ant_gine_fich_gine_a, ant_gine_fich_gine_c, exa_fis_neurolog_romberg, exa_fis_neurolog_mciega, exa_fis_neurolog_dixhalp, 
exa_fis_ojoder_sncorre_vlejan, exa_fis_ojoder_sncorre_vcerca, exa_fis_ojoder_cncorre_vlejan, 
exa_fis_ojoder_cncorre_vcerca, exa_fis_ojoizq_sncorre_vlejan, exa_fis_ojoizq_sncorre_vcerca, 
exa_fis_ojoizq_cncorre_vlejan, exa_fis_ojoizq_cncorre_vcerca, exa_fis_ojoamb_sncorre_vlejan, 
exa_fis_ojoamb_sncorre_vcerca, exa_fis_oojoamb_cncorre_vlejan, exa_fis_ojoamb_cncorre_vcerca,
dat_ocupa_emp2, dat_ocupa_dura_anyo2, dat_ocupa_carg2, ant_fam_diabet_pad, ant_fam_diabet_mad, ant_fam_diabet_herm, ant_fam_diabet_otro, 
ant_fam_hiper_pad, ant_fam_hiper_mad, ant_fam_hiper_herm, ant_fam_hiper_otro, 
ant_fam_enf_ment_pad, ant_fam_enf_ment_mad, ant_fam_enf_ment_herm, ant_fam_enf_ment_otro, 
ant_fam_cadio_pad, ant_fam_cadio_mad, ant_fam_cadio_herm, ant_fam_cadio_otro, 
ant_fam_trans_convul_pad, ant_fam_trans_convul_mad, ant_fam_trans_convul_herm, ant_fam_trans_convul_otro, 
ant_fam_otro_pad, ant_fam_otro_mad, ant_fam_otro_herm, ant_fam_otro_otro, ant_fam_otro_otro_cual,
habit_tox_fum_nofum_exfum, habit_tox_consum_alcoh, habit_tox_toxicomania, ant_pato_convulsion, ant_pato_alerg, 
ant_pato_claustrofobia, ant_pato_dificuloler, ant_pato_endocrino, ant_pato_resp, ant_pato_cardiopatia, ant_pato_hiperten, 
ant_pato_farmacolog, ant_pato_lentes, ant_pato_dificuldistincolor, exa_fis_cabeza, exa_fis_cuello, exa_fis_cardiopulm, 
exa_fis_abdomen, exa_fis_sistemmusculesquelet, exa_fis_pielfanera, ant_fam_asma_pad, ant_fam_asma_mad, ant_fam_asma_herm, ant_fam_asma_otro
FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_hist_clinica = mysqli_query($conectar, $obtener_estructura_hist_clinica) or die(mysqli_error($conectar));
$info_estructura_hist_clinica= mysqli_fetch_assoc($consultar_estructura_hist_clinica);

$motivo                            = $info_estructura_hist_clinica['motivo'];
$exa_fis_fc                        = $info_estructura_hist_clinica['exa_fis_fc'];
$exa_fis_fresp                     = $info_estructura_hist_clinica['exa_fis_fresp'];
$exa_fis_ta                        = $info_estructura_hist_clinica['exa_fis_ta'];
$exa_fis_peso                      = $info_estructura_hist_clinica['exa_fis_peso'];
$exa_fis_talla                     = $info_estructura_hist_clinica['exa_fis_talla'];
$exa_fis_imc                       = $info_estructura_hist_clinica['exa_fis_imc'];
$exa_fis_periabdom                 = $info_estructura_hist_clinica['exa_fis_periabdom'];
$ant_gine_prim_mestrua             = $info_estructura_hist_clinica['ant_gine_prim_mestrua'];
$ant_gine_fum                      = $info_estructura_hist_clinica['ant_gine_fum'];
$ant_gine_fich_gine_g              = $info_estructura_hist_clinica['ant_gine_fich_gine_g'];
$ant_gine_fich_gine_p              = $info_estructura_hist_clinica['ant_gine_fich_gine_p'];
$ant_gine_fich_gine_a              = $info_estructura_hist_clinica['ant_gine_fich_gine_a'];
$ant_gine_fich_gine_c              = $info_estructura_hist_clinica['ant_gine_fich_gine_c'];
$exa_fis_neurolog_romberg          = $info_estructura_hist_clinica['exa_fis_neurolog_romberg'];
$exa_fis_neurolog_mciega           = $info_estructura_hist_clinica['exa_fis_neurolog_mciega'];
$exa_fis_neurolog_dixhalp          = $info_estructura_hist_clinica['exa_fis_neurolog_dixhalp'];
$exa_fis_ojoder_sncorre_vlejan     = $info_estructura_hist_clinica['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca     = $info_estructura_hist_clinica['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan     = $info_estructura_hist_clinica['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca     = $info_estructura_hist_clinica['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan     = $info_estructura_hist_clinica['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca     = $info_estructura_hist_clinica['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan     = $info_estructura_hist_clinica['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca     = $info_estructura_hist_clinica['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan     = $info_estructura_hist_clinica['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca     = $info_estructura_hist_clinica['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan    = $info_estructura_hist_clinica['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca     = $info_estructura_hist_clinica['exa_fis_ojoamb_cncorre_vcerca'];
$trab_ant_centro_trab              = $info_estructura_hist_clinica['dat_ocupa_emp2'];
$trab_ant_tiempo                   = $info_estructura_hist_clinica['dat_ocupa_dura_anyo2'];
$trab_ant_puesto                   = $info_estructura_hist_clinica['dat_ocupa_carg2'];

$ant_fam_diabet_pad                = $info_estructura_hist_clinica['ant_fam_diabet_pad'];
$ant_fam_diabet_mad                = $info_estructura_hist_clinica['ant_fam_diabet_mad'];
$ant_fam_diabet_herm               = $info_estructura_hist_clinica['ant_fam_diabet_herm'];
$ant_fam_diabet_otro               = $info_estructura_hist_clinica['ant_fam_diabet_otro'];
$ant_fam_hiper_pad                 = $info_estructura_hist_clinica['ant_fam_hiper_pad'];
$ant_fam_hiper_mad                 = $info_estructura_hist_clinica['ant_fam_hiper_mad'];
$ant_fam_hiper_herm                = $info_estructura_hist_clinica['ant_fam_hiper_herm'];
$ant_fam_hiper_otro                = $info_estructura_hist_clinica['ant_fam_hiper_otro'];
$ant_fam_enf_ment_pad              = $info_estructura_hist_clinica['ant_fam_enf_ment_pad'];
$ant_fam_enf_ment_mad              = $info_estructura_hist_clinica['ant_fam_enf_ment_mad'];
$ant_fam_enf_ment_herm             = $info_estructura_hist_clinica['ant_fam_enf_ment_herm'];
$ant_fam_enf_ment_otro             = $info_estructura_hist_clinica['ant_fam_enf_ment_otro'];
$ant_fam_cadio_pad                 = $info_estructura_hist_clinica['ant_fam_cadio_pad'];
$ant_fam_cadio_mad                 = $info_estructura_hist_clinica['ant_fam_cadio_mad'];
$ant_fam_cadio_herm                = $info_estructura_hist_clinica['ant_fam_cadio_herm'];
$ant_fam_cadio_otro                = $info_estructura_hist_clinica['ant_fam_cadio_otro'];
$ant_fam_trans_convul_pad          = $info_estructura_hist_clinica['ant_fam_trans_convul_pad'];
$ant_fam_trans_convul_mad          = $info_estructura_hist_clinica['ant_fam_trans_convul_mad'];
$ant_fam_trans_convul_herm         = $info_estructura_hist_clinica['ant_fam_trans_convul_herm'];
$ant_fam_trans_convul_otro         = $info_estructura_hist_clinica['ant_fam_trans_convul_otro'];
$ant_fam_otro_pad                  = $info_estructura_hist_clinica['ant_fam_otro_pad'];
$ant_fam_otro_mad                  = $info_estructura_hist_clinica['ant_fam_otro_mad'];
$ant_fam_otro_herm                 = $info_estructura_hist_clinica['ant_fam_otro_herm'];
$ant_fam_otro_otro                 = $info_estructura_hist_clinica['ant_fam_otro_otro'];
$ant_fam_otro_otro_cual            = $info_estructura_hist_clinica['ant_fam_otro_otro_cual'];
$habit_tox_fum_nofum_exfum         = $info_estructura_hist_clinica['habit_tox_fum_nofum_exfum'];
$habit_tox_consum_alcoh            = $info_estructura_hist_clinica['habit_tox_consum_alcoh'];
$habit_tox_toxicomania             = $info_estructura_hist_clinica['habit_tox_toxicomania'];
$ant_pato_convulsion               = $info_estructura_hist_clinica['ant_pato_convulsion'];
$ant_pato_alerg                    = $info_estructura_hist_clinica['ant_pato_alerg'];
$ant_pato_claustrofobia            = $info_estructura_hist_clinica['ant_pato_claustrofobia'];
$ant_pato_dificuloler              = $info_estructura_hist_clinica['ant_pato_dificuloler'];
$ant_pato_endocrino                = $info_estructura_hist_clinica['ant_pato_endocrino'];
$ant_pato_resp                     = $info_estructura_hist_clinica['ant_pato_resp'];
$ant_pato_cardiopatia              = $info_estructura_hist_clinica['ant_pato_cardiopatia'];
$ant_pato_hiperten                 = $info_estructura_hist_clinica['ant_pato_hiperten'];
$ant_pato_farmacolog               = $info_estructura_hist_clinica['ant_pato_farmacolog'];
$ant_pato_lentes                   = $info_estructura_hist_clinica['ant_pato_lentes'];
$ant_pato_dificuldistincolor       = $info_estructura_hist_clinica['ant_pato_dificuldistincolor'];
$exa_fis_cabeza                    = $info_estructura_hist_clinica['exa_fis_cabeza'];
$exa_fis_cuello                    = $info_estructura_hist_clinica['exa_fis_cuello'];
$exa_fis_cardiopulm                = $info_estructura_hist_clinica['exa_fis_cardiopulm'];
$exa_fis_abdomen                   = $info_estructura_hist_clinica['exa_fis_abdomen'];
$exa_fis_pielfanera                = $info_estructura_hist_clinica['exa_fis_pielfanera'];
$exa_fis_sistemmusculesquelet      = $info_estructura_hist_clinica['exa_fis_sistemmusculesquelet'];
$ant_fam_asma_pad                  = $info_estructura_hist_clinica['ant_fam_asma_pad'];
$ant_fam_asma_mad                  = $info_estructura_hist_clinica['ant_fam_asma_mad'];
$ant_fam_asma_herm                 = $info_estructura_hist_clinica['ant_fam_asma_herm'];
$ant_fam_asma_otro                 = $info_estructura_hist_clinica['ant_fam_asma_otro'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
if (($ant_fam_diabet_pad=='S') || ($ant_fam_diabet_mad=='S') || ($ant_fam_diabet_herm=='S') || ($ant_fam_diabet_otro=='S')) { $ant_fam_diabetes = 'SI'; } else { $ant_fam_diabetes = 'NO'; }
if (($ant_fam_hiper_pad=='S') || ($ant_fam_hiper_mad=='S') || ($ant_fam_hiper_herm=='S') || ($ant_fam_hiper_otro=='S')) { $ant_fam_hipertension = 'SI'; } else { $ant_fam_hipertension = 'NO'; }
if (($ant_fam_asma_pad=='S') || ($ant_fam_asma_mad=='S') || ($ant_fam_asma_herm=='S') || ($ant_fam_asma_otro=='S')) { $ant_fam_asma = 'SI'; } else { $ant_fam_asma = 'NO'; }
if (($ant_fam_cadio_pad=='S') || ($ant_fam_cadio_mad=='S') || ($ant_fam_cadio_herm=='S') || ($ant_fam_cadio_otro=='S')) { $ant_fam_cardiacas = 'SI'; } else { $ant_fam_cardiacas = 'NO'; }
if (($ant_fam_trans_convul_pad=='S') || ($ant_fam_trans_convul_mad=='S') || ($ant_fam_trans_convul_herm=='S') || ($ant_fam_trans_convul_otro=='S')) { $ant_fam_convulsiones = 'SI'; } else { $ant_fam_convulsiones = 'NO'; }
if (($ant_fam_otro_pad=='S') || ($ant_fam_otro_mad=='S') || ($ant_fam_otro_herm=='S') || ($ant_fam_otro_otro=='S')) { $ant_fam_otros = 'SI'; } else { $ant_fam_otros = 'NO'; }
$ant_fam_cuales = $ant_fam_otro_otro_cual;
if ($habit_tox_fum_nofum_exfum=='Fuma') { $ant_nopatolog_fuma = 'SI'; } else { $ant_nopatolog_fuma = 'NO'; }
if ($habit_tox_consum_alcoh=='SI') { $ant_nopatolog_alcohol = 'SI'; } else { $ant_nopatolog_alcohol = 'NO'; }
if ($habit_tox_toxicomania=='SI') { $ant_nopatolog_toxicomanias = 'SI'; } else { $ant_nopatolog_toxicomanias = 'NO'; }
if ($ant_pato_convulsion=='SI') { $ant_person_pato_convul = 'SI'; } else { $ant_person_pato_convul = 'NO'; }
if ($ant_pato_alerg=='SI') { $ant_person_pato_reacalerg = 'SI'; } else { $ant_person_pato_reacalerg = 'NO'; }
if ($ant_pato_claustrofobia=='SI') { $ant_person_pato_claustofob = 'SI'; } else { $ant_person_pato_claustofob = 'NO'; }
if ($ant_pato_dificuloler=='SI') { $ant_person_pato_dificuloler = 'SI'; } else { $ant_person_pato_dificuloler = 'NO'; }
if ($ant_pato_endocrino=='SI') { $ant_person_pato_diabetes = 'SI'; } else { $ant_person_pato_diabetes = 'NO'; }
if ($ant_pato_resp=='SI') { $ant_person_pato_problempulmonar = 'SI'; } else { $ant_person_pato_problempulmonar = 'NO'; }
if ($ant_pato_resp=='SI') { $ant_person_pato_dificulresp = 'SI'; } else { $ant_person_pato_dificulresp = 'NO'; }
if ($ant_pato_cardiopatia=='SI') { $ant_person_pato_problemcorazon = 'SI'; } else { $ant_person_pato_problemcorazon = 'NO'; }
if ($ant_pato_hiperten=='SI') { $ant_person_pato_presionalta = 'SI'; } else { $ant_person_pato_presionalta = 'NO'; }
if ($ant_pato_farmacolog=='SI') { $ant_person_pato_tomamedicam = 'SI'; } else { $ant_person_pato_tomamedicam = 'NO'; }
if ($ant_pato_lentes=='SI') { $ant_person_pato_usalentes = 'SI'; } else { $ant_person_pato_usalentes = 'NO'; }
if ($ant_pato_dificuldistincolor=='SI') { $ant_person_pato_dificuldistinguircolor = 'SI'; } else { $ant_person_pato_dificuldistinguircolor = 'NO'; }
if ($exa_fis_cabeza=='N') { $explo_fis_cabeza = 'NORMAL'; } elseif ($exa_fis_cabeza=='A') { $explo_fis_cabeza = 'ANORMAL'; }  elseif ($exa_fis_cabeza=='NE') { $explo_fis_cabeza = 'NO EXAMINADO'; } else { $explo_fis_cabeza = ''; }
if ($exa_fis_cuello=='N') { $explo_fis_cuello = 'NORMAL'; } elseif ($exa_fis_cuello=='A') { $explo_fis_cuello = 'ANORMAL'; }  elseif ($exa_fis_cuello=='NE') { $explo_fis_cuello = 'NO EXAMINADO'; } else { $explo_fis_cuello = ''; }
if ($exa_fis_cardiopulm=='N') { $explo_fis_cadiopulm = 'NORMAL'; } elseif ($exa_fis_cardiopulm=='A') { $explo_fis_cadiopulm = 'ANORMAL'; }  elseif ($exa_fis_cardiopulm=='NE') { $explo_fis_cadiopulm = 'NO EXAMINADO'; } else { $explo_fis_cadiopulm = ''; }
if ($exa_fis_abdomen=='N') { $explo_fis_digestivo = 'NORMAL'; } elseif ($exa_fis_abdomen=='A') { $explo_fis_digestivo = 'ANORMAL'; }  elseif ($exa_fis_abdomen=='NE') { $explo_fis_digestivo = 'NO EXAMINADO'; } else { $explo_fis_digestivo = ''; }
if ($exa_fis_sistemmusculesquelet=='N') { $explo_fis_sistemmuscesquelet = 'NORMAL'; } elseif ($exa_fis_sistemmusculesquelet=='A') { $explo_fis_sistemmuscesquelet = 'ANORMAL'; }  elseif ($exa_fis_sistemmusculesquelet=='NE') { $explo_fis_sistemmuscesquelet = 'NO EXAMINADO'; } else { $explo_fis_sistemmuscesquelet = ''; }
if ($exa_fis_pielfanera=='N') { $explo_fis_pielanexos = 'NORMAL'; } elseif ($exa_fis_pielfanera=='A') { $explo_fis_pielanexos = 'ANORMAL'; }  elseif ($exa_fis_pielfanera=='NE') { $explo_fis_pielanexos = 'NO EXAMINADO'; } else { $explo_fis_pielanexos = ''; }
//if ($aaa=='N') { $bbb = 'NORMAL'; } elseif ($aaa=='A') { $bbb = 'ANORMAL'; }  elseif ($aaa=='NE') { $bbb = 'NO EXAMINADO'; } else { $bbb = ''; }
//if ($aaa=='N') { $bbb = 'NORMAL'; } elseif ($aaa=='A') { $bbb = 'ANORMAL'; }  elseif ($aaa=='NE') { $bbb = 'NO EXAMINADO'; } else { $bbb = ''; }
//if ($aaa=='N') { $bbb = 'NORMAL'; } elseif ($aaa=='A') { $bbb = 'ANORMAL'; }  elseif ($aaa=='NE') { $bbb = 'NO EXAMINADO'; } else { $bbb = ''; }
//if ($aaa=='N') { $bbb = 'NORMAL'; } elseif ($aaa=='A') { $bbb = 'ANORMAL'; }  elseif ($aaa=='NE') { $bbb = 'NO EXAMINADO'; } else { $bbb = ''; }
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_estructura_trabajo_altura = "SELECT recomend_emp, recomend_trab FROM tbl15_actitud_laboral WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_trabajo_altura = mysqli_query($conectar, $obtener_estructura_trabajo_altura) or die(mysqli_error($conectar));
$info_estructura_trabajo_altura= mysqli_fetch_assoc($consultar_estructura_trabajo_altura);

$recomend_emp                 = $info_estructura_trabajo_altura['recomend_emp'];
$recomend_trab                = $info_estructura_trabajo_altura['recomend_trab'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$actualizar_info_trabaltura= "UPDATE tbl15_trabajo_altura SET motivo_trabajo_altura = '$motivo', explo_fis_fc = '$exa_fis_fc', 
explo_fis_fr = '$exa_fis_fresp', explo_fis_ta = '$exa_fis_ta', explo_fis_peso = '$exa_fis_peso', 
explo_fis_talla = '$exa_fis_talla', explo_fis_imc = '$exa_fis_imc', explo_fis_pericintura = '$exa_fis_periabdom', 
ant_gine_menarquia = '$ant_gine_prim_mestrua', ant_gine_fmu = '$ant_gine_fum', ant_gine_g = '$ant_gine_fich_gine_g', 
ant_gine_p = '$ant_gine_fich_gine_p', ant_gine_a = '$ant_gine_fich_gine_a', ant_gine_c = '$ant_gine_fich_gine_c', 
explo_fis_testromberg = '$exa_fis_neurolog_romberg', explo_fis_priebmarcha = '$exa_fis_neurolog_mciega', 
explo_fis_dixhalp = '$exa_fis_neurolog_dixhalp', 
exa_fis_ojoder_sncorre_vlejan = '$exa_fis_ojoder_sncorre_vlejan', exa_fis_ojoder_sncorre_vcerca = '$exa_fis_ojoder_sncorre_vcerca', 
exa_fis_ojoder_cncorre_vlejan = '$exa_fis_ojoder_cncorre_vlejan', exa_fis_ojoder_cncorre_vcerca = '$exa_fis_ojoder_cncorre_vcerca', 
exa_fis_ojoizq_sncorre_vlejan = '$exa_fis_ojoizq_sncorre_vlejan', exa_fis_ojoizq_sncorre_vcerca = '$exa_fis_ojoizq_sncorre_vcerca', 
exa_fis_ojoizq_cncorre_vlejan = '$exa_fis_ojoizq_cncorre_vlejan', exa_fis_ojoizq_cncorre_vcerca = '$exa_fis_ojoizq_cncorre_vcerca', 
exa_fis_ojoamb_sncorre_vlejan = '$exa_fis_ojoamb_sncorre_vlejan', exa_fis_ojoamb_sncorre_vcerca = '$exa_fis_ojoamb_sncorre_vcerca', 
exa_fis_oojoamb_cncorre_vlejan = '$exa_fis_oojoamb_cncorre_vlejan', exa_fis_ojoamb_cncorre_vcerca = '$exa_fis_ojoamb_cncorre_vcerca', 
explo_fis_recomenespecifempre = '$recomend_emp', explo_fis_recomenespeciftrab = '$recomend_trab', 
trab_ant_centro_trab = '$trab_ant_centro_trab', trab_ant_tiempo = '$trab_ant_tiempo', trab_ant_puesto = '$trab_ant_puesto',
ant_fam_diabetes = '$ant_fam_diabetes', ant_fam_hipertension = '$ant_fam_hipertension', ant_fam_asma = '$ant_fam_asma', 
ant_fam_cardiacas = '$ant_fam_cardiacas', ant_fam_convulsiones = '$ant_fam_convulsiones', 
ant_fam_otros = '$ant_fam_otros', ant_fam_cuales = '$ant_fam_cuales', ant_nopatolog_fuma = '$ant_nopatolog_fuma', 
ant_nopatolog_alcohol = '$ant_nopatolog_alcohol', ant_nopatolog_toxicomanias = '$ant_nopatolog_toxicomanias', 
ant_person_pato_convul = '$ant_person_pato_convul', ant_person_pato_reacalerg = '$ant_person_pato_reacalerg', 
ant_person_pato_claustofob = '$ant_person_pato_claustofob', ant_person_pato_dificuloler = '$ant_person_pato_dificuloler', 
ant_person_pato_diabetes = '$ant_person_pato_diabetes', ant_person_pato_problempulmonar = '$ant_person_pato_problempulmonar', 
ant_person_pato_dificulresp = '$ant_person_pato_dificulresp', ant_person_pato_problemcorazon = '$ant_person_pato_problemcorazon', 
ant_person_pato_presionalta = '$ant_person_pato_presionalta', ant_person_pato_tomamedicam = '$ant_person_pato_tomamedicam', 
ant_person_pato_usalentes = '$ant_person_pato_usalentes', ant_person_pato_dificuldistinguircolor = '$ant_person_pato_dificuldistinguircolor', 
explo_fis_cabeza = '$explo_fis_cabeza', explo_fis_cuello = '$explo_fis_cuello', explo_fis_cadiopulm = '$explo_fis_cadiopulm', 
explo_fis_digestivo = '$explo_fis_digestivo', explo_fis_sistemmuscesquelet = '$explo_fis_sistemmuscesquelet', 
explo_fis_pielanexos = '$explo_fis_pielanexos'
WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_info_trabaltura = mysqli_query($conectar, $actualizar_info_trabaltura) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
$(document).ready(function() {

$(".ant_person_pato_convul").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_convul").val("SI"); } else { $(".ant_person_pato_convul").val("NO"); } });
$(".ant_person_pato_dificulresp").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_dificulresp").val("SI"); } else { $(".ant_person_pato_dificulresp").val("NO"); } });
$(".ant_person_pato_reacalerg").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_reacalerg").val("SI"); } else { $(".ant_person_pato_reacalerg").val("NO"); } });
$(".ant_person_pato_problemcorazon").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_problemcorazon").val("SI"); } else { $(".ant_person_pato_problemcorazon").val("NO"); } });
$(".ant_person_pato_claustofob").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_claustofob").val("SI"); } else { $(".ant_person_pato_claustofob").val("NO"); } });
$(".ant_person_pato_presionalta").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_presionalta").val("SI"); } else { $(".ant_person_pato_presionalta").val("NO"); } });
$(".ant_person_pato_dificuloler").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_dificuloler").val("SI"); } else { $(".ant_person_pato_dificuloler").val("NO"); } });
$(".ant_person_pato_tomamedicam").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_tomamedicam").val("SI"); } else { $(".ant_person_pato_tomamedicam").val("NO"); } });
$(".ant_person_pato_diabetes").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_diabetes").val("SI"); } else { $(".ant_person_pato_diabetes").val("NO"); } });
$(".ant_person_pato_usalentes").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_usalentes").val("SI"); } else { $(".ant_person_pato_usalentes").val("NO"); } });
$(".ant_person_pato_problempulmonar").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_problempulmonar").val("SI"); } else { $(".ant_person_pato_problempulmonar").val("NO"); } });
$(".ant_person_pato_dificuldistinguircolor").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_dificuldistinguircolor").val("SI"); } else { $(".ant_person_pato_dificuldistinguircolor").val("NO"); } });

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_trabajo_altura_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_trabajo_altura ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_trabajo_altura_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_trabajo_altura ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_trabajo_altura_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_trabajo_altura ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>
</body>
</html>