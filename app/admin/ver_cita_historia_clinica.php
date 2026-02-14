<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="../estilo_css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../estilo_css/estilo_multiselect_chosen.css">
<link rel="stylesheet" href="../estilo_css/prism.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Cita Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy                       = date("Y/m/d");
$fecha_hoy_time                  = strtotime(date("Y/m/d"));
$cod_historia_clinica            = intval($_GET['cod_historia_clinica']);
$cod_cliente                     = intval($_GET['cod_cliente']);

$sql_historia_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cod_cliente, tbl15_cliente.nombre_tipo_doc, 
tbl15_cliente.nombre_ocupacion, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_contacto1, 
tbl15_cliente.parentesco_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.antperson_alergia_si, tbl15_cliente.antperson_alergia_no, tbl15_cliente.nombre_escolaridad,
tbl15_cliente.antperson_patologico_si, tbl15_cliente.antperson_patologico_no, tbl15_cliente.antperson_quirurgico_si, tbl15_cliente.antperson_quirurgico_no, 
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, 
tbl15_cliente.url_img_foto AS url_img_foto_cli,
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_cliente.nombre_empresa,
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente AS tel_cliente_cli, tbl15_cliente.correo, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, 
tbl15_cliente.cargo_empresa, tbl15_cliente.area_empresa, tbl15_cliente.ciudad_empresa, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2,
tbl15_cliente.nombre_tipo_regimen, tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_numero_hijos, tbl15_cliente.nombre_arl, tbl15_cliente.lugar_nac, 
tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_estado_civil, tbl15_cliente.nombre_raza, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2, 
tbl15_historia_clinica.motivo, 
tbl15_historia_clinica.cod_grupo_area, tbl15_historia_clinica.cod_grupo_area_cargo, 
tbl15_historia_clinica.dat_ocupa_emp1, tbl15_historia_clinica.dat_ocupa_carg1, 
tbl15_historia_clinica.dat_ocupa_visu1, 
tbl15_historia_clinica.dat_ocupa_audi1, tbl15_historia_clinica.dat_ocupa_altu1, tbl15_historia_clinica.dat_ocupa_resp1, tbl15_historia_clinica.dat_ocupa_fech_ini1, 
tbl15_historia_clinica.dat_ocupa_dura_anyo1, tbl15_historia_clinica.dat_ocupa_emp2, tbl15_historia_clinica.dat_ocupa_carg2, 
tbl15_historia_clinica.dat_ocupa_visu2, tbl15_historia_clinica.dat_ocupa_audi2, tbl15_historia_clinica.dat_ocupa_altu2, 
tbl15_historia_clinica.dat_ocupa_resp2, tbl15_historia_clinica.dat_ocupa_fech_ini2, tbl15_historia_clinica.dat_ocupa_dura_anyo2, 
tbl15_historia_clinica.dat_ocupa_emp3, tbl15_historia_clinica.dat_ocupa_carg3, tbl15_historia_clinica.dat_ocupa_visu3, 
tbl15_historia_clinica.dat_ocupa_audi3, tbl15_historia_clinica.dat_ocupa_altu3, tbl15_historia_clinica.dat_ocupa_resp3, 
tbl15_historia_clinica.dat_ocupa_fech_ini3, tbl15_historia_clinica.dat_ocupa_dura_anyo3, tbl15_historia_clinica.dat_ocupa_observacion, 
tbl15_historia_clinica.clasrieg_carg1, tbl15_historia_clinica.clasrieg_fis1_ruid, tbl15_historia_clinica.clasrieg_fis1_ilum, 
tbl15_historia_clinica.clasrieg_fis1_noionic, tbl15_historia_clinica.clasrieg_fis1_vibra, tbl15_historia_clinica.clasrieg_fis1_tempextrem, 
tbl15_historia_clinica.clasrieg_fis1_cambpres, tbl15_historia_clinica.clasrieg_quim1_gasvapor, tbl15_historia_clinica.clasrieg_quim1_aeroliq, 
tbl15_historia_clinica.clasrieg_quim1_solid, tbl15_historia_clinica.clasrieg_quim1_liquid, tbl15_historia_clinica.clasrieg_biolog1_viru, 
tbl15_historia_clinica.clasrieg_biolog1_bacter, tbl15_historia_clinica.clasrieg_biolog1_parasi, tbl15_historia_clinica.clasrieg_biolog1_morde, 
tbl15_historia_clinica.clasrieg_biolog1_picad, tbl15_historia_clinica.clasrieg_biolog1_hongo, tbl15_historia_clinica.clasrieg_ergo1_trabestat, 
tbl15_historia_clinica.clasrieg_ergo1_esfuerfis, tbl15_historia_clinica.clasrieg_ergo1_carga, tbl15_historia_clinica.clasrieg_ergo1_postforz, 
tbl15_historia_clinica.clasrieg_ergo1_movrepet, tbl15_historia_clinica.clasrieg_ergo1_jortrab, tbl15_historia_clinica.clasrieg_psi1_monoto, 
tbl15_historia_clinica.clasrieg_psi1_relhuman, tbl15_historia_clinica.clasrieg_psi1_contentarea, tbl15_historia_clinica.clasrieg_psi1_orgtiemptrab, 
tbl15_historia_clinica.clasrieg_segur1_mecanic, tbl15_historia_clinica.clasrieg_segur1_electri, tbl15_historia_clinica.clasrieg_segur1_locat, 
tbl15_historia_clinica.clasrieg_segur1_fisiquim, tbl15_historia_clinica.clasrieg_segur1_public, tbl15_historia_clinica.clasrieg_segur1_espconfi, 
tbl15_historia_clinica.clasrieg_segur1_trabaltura, tbl15_historia_clinica.clasrieg_observ1_otro, tbl15_historia_clinica.clasrieg_observ1_coment, 
tbl15_historia_clinica.clasrieg_carg2, tbl15_historia_clinica.clasrieg_fis2_ruid, tbl15_historia_clinica.clasrieg_fis2_ilum, 
tbl15_historia_clinica.clasrieg_fis2_noionic, tbl15_historia_clinica.clasrieg_fis2_vibra, tbl15_historia_clinica.clasrieg_fis2_tempextrem, 
tbl15_historia_clinica.clasrieg_fis2_cambpres, tbl15_historia_clinica.clasrieg_quim2_gasvapor, tbl15_historia_clinica.clasrieg_quim2_aeroliq, 
tbl15_historia_clinica.clasrieg_quim2_solid, tbl15_historia_clinica.clasrieg_quim2_liquid, tbl15_historia_clinica.clasrieg_biolog2_viru, 
tbl15_historia_clinica.clasrieg_biolog2_bacter, tbl15_historia_clinica.clasrieg_biolog2_parasi, tbl15_historia_clinica.clasrieg_biolog2_morde, 
tbl15_historia_clinica.clasrieg_biolog2_picad, tbl15_historia_clinica.clasrieg_biolog2_hongo, tbl15_historia_clinica.clasrieg_ergo2_trabestat, 
tbl15_historia_clinica.clasrieg_ergo2_esfuerfis, tbl15_historia_clinica.clasrieg_ergo2_carga, tbl15_historia_clinica.clasrieg_ergo2_postforz, 
tbl15_historia_clinica.clasrieg_ergo2_movrepet, tbl15_historia_clinica.clasrieg_ergo2_jortrab, tbl15_historia_clinica.clasrieg_psi2_monoto, 
tbl15_historia_clinica.clasrieg_psi2_relhuman, tbl15_historia_clinica.clasrieg_psi2_contentarea, tbl15_historia_clinica.clasrieg_psi2_orgtiemptrab, 
tbl15_historia_clinica.clasrieg_segur2_mecanic, tbl15_historia_clinica.clasrieg_segur2_electri, tbl15_historia_clinica.clasrieg_segur2_locat, 
tbl15_historia_clinica.clasrieg_segur2_fisiquim, tbl15_historia_clinica.clasrieg_segur2_public, tbl15_historia_clinica.clasrieg_segur2_espconfi, 
tbl15_historia_clinica.clasrieg_segur2_trabaltura, tbl15_historia_clinica.clasrieg_observ2_otro, tbl15_historia_clinica.clasrieg_observ2_coment, 
tbl15_historia_clinica.clasrieg_carg3, tbl15_historia_clinica.clasrieg_fis3_ruid, tbl15_historia_clinica.clasrieg_fis3_ilum, 
tbl15_historia_clinica.clasrieg_fis3_noionic, tbl15_historia_clinica.clasrieg_fis3_vibra, tbl15_historia_clinica.clasrieg_fis3_tempextrem, 
tbl15_historia_clinica.clasrieg_fis3_cambpres, tbl15_historia_clinica.clasrieg_quim3_gasvapor, tbl15_historia_clinica.clasrieg_quim3_aeroliq, 
tbl15_historia_clinica.clasrieg_quim3_solid, tbl15_historia_clinica.clasrieg_quim3_liquid, tbl15_historia_clinica.clasrieg_biolog3_viru, 
tbl15_historia_clinica.clasrieg_biolog3_bacter, tbl15_historia_clinica.clasrieg_biolog3_parasi, tbl15_historia_clinica.clasrieg_biolog3_morde, 
tbl15_historia_clinica.clasrieg_biolog3_picad, tbl15_historia_clinica.clasrieg_biolog3_hongo, tbl15_historia_clinica.clasrieg_ergo3_trabestat, 
tbl15_historia_clinica.clasrieg_ergo3_esfuerfis, tbl15_historia_clinica.clasrieg_ergo3_carga, tbl15_historia_clinica.clasrieg_ergo3_postforz, 
tbl15_historia_clinica.clasrieg_ergo3_movrepet, tbl15_historia_clinica.clasrieg_ergo3_jortrab, tbl15_historia_clinica.clasrieg_psi3_monoto, 
tbl15_historia_clinica.clasrieg_psi3_relhuman, tbl15_historia_clinica.clasrieg_psi3_contentarea, tbl15_historia_clinica.clasrieg_psi3_orgtiemptrab, 
tbl15_historia_clinica.clasrieg_segur3_mecanic, tbl15_historia_clinica.clasrieg_segur3_electri, tbl15_historia_clinica.clasrieg_segur3_locat, 
tbl15_historia_clinica.clasrieg_segur3_fisiquim, tbl15_historia_clinica.clasrieg_segur3_public, tbl15_historia_clinica.clasrieg_segur3_espconfi, 
tbl15_historia_clinica.clasrieg_segur3_trabaltura, tbl15_historia_clinica.clasrieg_observ3_otro, tbl15_historia_clinica.clasrieg_observ3_coment, 
tbl15_historia_clinica.ant_impor_accilab, tbl15_historia_clinica.ant_impor_fecha1, tbl15_historia_clinica.ant_impor_empre1, 
tbl15_historia_clinica.ant_impor_causa1, tbl15_historia_clinica.ant_impor_tip_lesi1, tbl15_historia_clinica.ant_impor_part_afect1, 
tbl15_historia_clinica.ant_impor_dias_incap1, tbl15_historia_clinica.ant_impor_secuela1, tbl15_historia_clinica.ant_impor_fecha2, 
tbl15_historia_clinica.ant_impor_empre2, tbl15_historia_clinica.ant_impor_causa2, tbl15_historia_clinica.ant_impor_tip_lesi2, 
tbl15_historia_clinica.ant_impor_part_afect2, tbl15_historia_clinica.ant_impor_dias_incap2, tbl15_historia_clinica.ant_impor_secuela2, 
tbl15_historia_clinica.enf_lab, tbl15_historia_clinica.enf_cual, tbl15_historia_clinica.enf_hace_cuanto, tbl15_historia_clinica.enf_descripcion, 
tbl15_historia_clinica.ant_fam_no_presenta, tbl15_historia_clinica.ant_fam_hiper_pad, 
tbl15_historia_clinica.ant_fam_hiper_mad, tbl15_historia_clinica.ant_fam_hiper_herm, tbl15_historia_clinica.ant_fam_hiper_otro, 
tbl15_historia_clinica.ant_fam_hiper_otro_cual, tbl15_historia_clinica.ant_fam_diabet_pad, 
tbl15_historia_clinica.ant_fam_diabet_mad, tbl15_historia_clinica.ant_fam_diabet_herm, tbl15_historia_clinica.ant_fam_diabet_otro, 
tbl15_historia_clinica.ant_fam_diabet_otro_cual, tbl15_historia_clinica.ant_fam_trombos_pad, 
tbl15_historia_clinica.ant_fam_trombos_mad, tbl15_historia_clinica.ant_fam_trombos_herm, 
tbl15_historia_clinica.ant_fam_trombos_otro, tbl15_historia_clinica.ant_fam_trombos_otro_cual, 
tbl15_historia_clinica.ant_fam_tum_malig_pad, 
tbl15_historia_clinica.ant_fam_tum_malig_mad, tbl15_historia_clinica.ant_fam_tum_malig_herm, 
tbl15_historia_clinica.ant_fam_tum_malig_otro, tbl15_historia_clinica.ant_fam_tum_malig_otro_cual, 
tbl15_historia_clinica.ant_fam_enf_ment_pad, 
tbl15_historia_clinica.ant_fam_enf_ment_mad, tbl15_historia_clinica.ant_fam_enf_ment_herm, 
tbl15_historia_clinica.ant_fam_enf_ment_otro, tbl15_historia_clinica.ant_fam_enf_ment_otro_cual, 
tbl15_historia_clinica.ant_fam_cadio_pad, 
tbl15_historia_clinica.ant_fam_cadio_mad, tbl15_historia_clinica.ant_fam_cadio_herm, 
tbl15_historia_clinica.ant_fam_cadio_otro, tbl15_historia_clinica.ant_fam_cadio_otro_cual, 
tbl15_historia_clinica.ant_fam_trans_convul_pad, 
tbl15_historia_clinica.ant_fam_trans_convul_mad, tbl15_historia_clinica.ant_fam_trans_convul_herm, 
tbl15_historia_clinica.ant_fam_trans_convul_otro, tbl15_historia_clinica.ant_fam_trans_convul_otro_cual, 
tbl15_historia_clinica.ant_fam_enf_gene_pad, 
tbl15_historia_clinica.ant_fam_enf_gene_mad, tbl15_historia_clinica.ant_fam_enf_gene_herm, 
tbl15_historia_clinica.ant_fam_enf_gene_otro, tbl15_historia_clinica.ant_fam_enf_gene_otro_cual, 
tbl15_historia_clinica.ant_fam_alerg_pad, 
tbl15_historia_clinica.ant_fam_alerg_mad, tbl15_historia_clinica.ant_fam_alerg_herm, 
tbl15_historia_clinica.ant_fam_alerg_otro, tbl15_historia_clinica.ant_fam_alerg_otro_cual, 
tbl15_historia_clinica.ant_fam_tuber_pad, 
tbl15_historia_clinica.ant_fam_tuber_mad, tbl15_historia_clinica.ant_fam_tuber_herm, 
tbl15_historia_clinica.ant_fam_tuber_otro, tbl15_historia_clinica.ant_fam_tuber_otro_cual, 
tbl15_historia_clinica.ant_fam_osteomusc_pad, 
tbl15_historia_clinica.ant_fam_osteomusc_mad, tbl15_historia_clinica.ant_fam_osteomusc_herm, 
tbl15_historia_clinica.ant_fam_osteomusc_otro, tbl15_historia_clinica.ant_fam_osteomusc_otro_cual, 
tbl15_historia_clinica.ant_fam_artitri_pad, 
tbl15_historia_clinica.ant_fam_artitri_mad, tbl15_historia_clinica.ant_fam_artitri_herm, 
tbl15_historia_clinica.ant_fam_artitri_otro, tbl15_historia_clinica.ant_fam_artitri_otro_cual, 
tbl15_historia_clinica.ant_fam_varice_pad, 
tbl15_historia_clinica.ant_fam_varice_mad, tbl15_historia_clinica.ant_fam_varice_herm, 
tbl15_historia_clinica.ant_fam_varice_otro, tbl15_historia_clinica.ant_fam_varice_otro_cual, 
tbl15_historia_clinica.ant_fam_otro_pad, 
tbl15_historia_clinica.ant_fam_otro_mad, tbl15_historia_clinica.ant_fam_otro_herm, 
tbl15_historia_clinica.ant_fam_otro_otro, tbl15_historia_clinica.ant_fam_otro_otro_cual, 
tbl15_historia_clinica.ant_fam_descripcion, 
tbl15_historia_clinica.ant_pato_no_presenta, tbl15_historia_clinica.ant_pato_neuro, tbl15_historia_clinica.ant_pato_resp, 
tbl15_historia_clinica.ant_pato_derma, tbl15_historia_clinica.ant_pato_psiq, 
tbl15_historia_clinica.ant_pato_alerg, tbl15_historia_clinica.ant_pato_osteomusc, 
tbl15_historia_clinica.ant_pato_gastrointes, tbl15_historia_clinica.ant_pato_hematolog, 
tbl15_historia_clinica.ant_pato_org_sentid, tbl15_historia_clinica.ant_pato_onco, 
tbl15_historia_clinica.ant_pato_hiperten, tbl15_historia_clinica.ant_pato_genurinario, 
tbl15_historia_clinica.ant_pato_infesios, tbl15_historia_clinica.ant_pato_congenit, 
tbl15_historia_clinica.ant_pato_farmacolog, tbl15_historia_clinica.ant_pato_transfus, 
tbl15_historia_clinica.ant_pato_endocrino, tbl15_historia_clinica.ant_pato_vascular, 
tbl15_historia_clinica.ant_pato_auntoinmun, tbl15_historia_clinica.ant_pato_otro, 
tbl15_historia_clinica.ant_pato_descripcion, 
tbl15_historia_clinica.ant_altu_no, tbl15_historia_clinica.ant_altu_epilep,
tbl15_historia_clinica.ant_altu_otitmed, tbl15_historia_clinica.ant_altu_enfmanier,
tbl15_historia_clinica.ant_altu_traumcran, tbl15_historia_clinica.ant_altu_tumcereb,
tbl15_historia_clinica.ant_altu_malfocereb, tbl15_historia_clinica.ant_altu_trombo,
tbl15_historia_clinica.ant_altu_hipoac, tbl15_historia_clinica.ant_altu_arritcardi,
tbl15_historia_clinica.ant_altu_hipogli, tbl15_historia_clinica.ant_altu_fobia,
tbl15_historia_clinica.ant_altu_observ, 
tbl15_historia_clinica.ant_trau, 
tbl15_historia_clinica.ant_trau_enfer1, tbl15_historia_clinica.ant_trau_observ1, 
tbl15_historia_clinica.ant_trau_fech_aprox1, tbl15_historia_clinica.ant_trau_enfer2, 
tbl15_historia_clinica.ant_trau_observ2, tbl15_historia_clinica.ant_trau_fech_aprox2, 
tbl15_historia_clinica.ant_trau_enfer3, tbl15_historia_clinica.ant_trau_observ3, 
tbl15_historia_clinica.ant_trau_fech_aprox3, 
tbl15_historia_clinica.ant_quirur, 
tbl15_historia_clinica.ant_quirur_enfer1, tbl15_historia_clinica.ant_quirur_observ1, 
tbl15_historia_clinica.ant_quirur_fech_aprox1, tbl15_historia_clinica.ant_quirur_enfer2, 
tbl15_historia_clinica.ant_quirur_observ2, tbl15_historia_clinica.ant_quirur_fech_aprox2, 
tbl15_historia_clinica.ant_quirur_enfer3, tbl15_historia_clinica.ant_quirur_observ3, 
tbl15_historia_clinica.ant_quirur_fech_aprox3, tbl15_historia_clinica.costo_motivo_consulta, tbl15_historia_clinica.cod_factura, 
tbl15_historia_clinica.ant_inmuni, tbl15_historia_clinica.ant_inmuni_tetano, tbl15_historia_clinica.ant_inmuni_tetano_anyo, 
tbl15_historia_clinica.ant_inmuni_fiebtifo, tbl15_historia_clinica.ant_inmuni_fiebtifo_anyo, 
tbl15_historia_clinica.ant_inmuni_hepatita, tbl15_historia_clinica.ant_inmuni_hepatita_anyo, 
tbl15_historia_clinica.ant_inmuni_influenza, tbl15_historia_clinica.ant_inmuni_influenza_anyo, 
tbl15_historia_clinica.ant_inmuni_hepatitb, tbl15_historia_clinica.ant_inmuni_hepatitb_anyo, 
tbl15_historia_clinica.ant_inmuni_saramp, tbl15_historia_clinica.ant_inmuni_saramp_anyo, 
tbl15_historia_clinica.ant_inmuni_fiebamarill, tbl15_historia_clinica.ant_inmuni_fiebamarill_anyo, 
tbl15_historia_clinica.ant_inmuni_otra, tbl15_historia_clinica.ant_inmuni_otra_anyo, 
tbl15_historia_clinica.ant_inmuni_observacion, tbl15_historia_clinica.ant_gine_prim_mestrua, 
tbl15_historia_clinica.ant_gine_anyos, tbl15_historia_clinica.ant_gine_cliclo, 
tbl15_historia_clinica.ant_gine_fum, tbl15_historia_clinica.ant_gine_fup, 
tbl15_historia_clinica.ant_gine_fuc, tbl15_historia_clinica.ant_gine_fich_gine, 
tbl15_historia_clinica.ant_gine_fich_gine_g, tbl15_historia_clinica.ant_gine_fich_gine_p, tbl15_historia_clinica.ant_gine_fich_gine_a, tbl15_historia_clinica.ant_gine_fich_gine_c, 
tbl15_historia_clinica.ant_gine_fich_gine_m, tbl15_historia_clinica.ant_gine_fich_gine_e, tbl15_historia_clinica.ant_gine_fich_gine_v, tbl15_historia_clinica.ant_gine_fech_ult_exa_mama, 
tbl15_historia_clinica.ant_gine_planifica, tbl15_historia_clinica.ant_gine_observacion, tbl15_historia_clinica.habit_tox_fum_nofum_exfum, tbl15_historia_clinica.habit_tox_ciga_aldia, 
tbl15_historia_clinica.habit_tox_anyos_fum, tbl15_historia_clinica.habit_tox_tiem_sinfum, tbl15_historia_clinica.habit_tox_consum_alcoh, tbl15_historia_clinica.habit_tox_activ_extralab, 
tbl15_historia_clinica.habit_tox_activfis, tbl15_historia_clinica.habit_tox_actividad, tbl15_historia_clinica.habit_tox_frecuenc, tbl15_historia_clinica.habit_tox_tiempo, 
tbl15_historia_clinica.rev_sist_no, tbl15_historia_clinica.rev_sist_orgsentido, tbl15_historia_clinica.rev_sist_observ_orgsentido, 
tbl15_historia_clinica.rev_sist_neurolog, tbl15_historia_clinica.rev_sist_observ_neurolog, 
tbl15_historia_clinica.rev_sist_resp, tbl15_historia_clinica.rev_sist_observ_resp, 
tbl15_historia_clinica.rev_sist_gastrointes, tbl15_historia_clinica.rev_sist_observ_gastrointes, 
tbl15_historia_clinica.rev_sist_geniuri, tbl15_historia_clinica.rev_sist_observ_geniuri, 
tbl15_historia_clinica.rev_sist_osteomus, tbl15_historia_clinica.rev_sist_observ_osteomus, 
tbl15_historia_clinica.rev_sist_dermato, tbl15_historia_clinica.rev_sist_noref_dermato, 
tbl15_historia_clinica.rev_sist_cardiovas, tbl15_historia_clinica.rev_sist_noref_cardiovas, 
tbl15_historia_clinica.rev_sist_constitu, tbl15_historia_clinica.rev_sist_observ_constitu, 
tbl15_historia_clinica.rev_sist_metabolendocri, tbl15_historia_clinica.rev_sist_observ_metabolendocri, 
tbl15_historia_clinica.rev_sist_observ_dermato, tbl15_historia_clinica.rev_sist_observ_cardiovas, 
tbl15_historia_clinica.eval_estment_norm_orient, 
tbl15_historia_clinica.eval_estment_disf_orient, tbl15_historia_clinica.eval_estment_halla_orient, tbl15_historia_clinica.eval_estment_norm_atenconcent, 
tbl15_historia_clinica.eval_estment_disf_atenconcent, tbl15_historia_clinica.eval_estment_halla_atenconcent, tbl15_historia_clinica.eval_estment_norm_sensoper, 
tbl15_historia_clinica.eval_estment_disf_sensoper, tbl15_historia_clinica.eval_estment_halla_sensoper, tbl15_historia_clinica.eval_estment_norm_memor, 
tbl15_historia_clinica.eval_estment_disf_memor, tbl15_historia_clinica.eval_estment_halla_memor, tbl15_historia_clinica.eval_estment_norm_pensami, tbl15_historia_clinica.eval_estment_disf_pensami, 
tbl15_historia_clinica.eval_estment_halla_pensami, tbl15_historia_clinica.eval_estment_norm_lenguaj, tbl15_historia_clinica.eval_estment_disf_lenguaj, 
tbl15_historia_clinica.eval_estment_halla_lenguaj, tbl15_historia_clinica.eval_estment_concept, tbl15_historia_clinica.exa_fis_peso, tbl15_historia_clinica.exa_fis_talla, 
tbl15_historia_clinica.exa_fis_imc, tbl15_historia_clinica.exa_fis_interpreimc, tbl15_historia_clinica.exa_fis_fresp, tbl15_historia_clinica.exa_fis_fc, tbl15_historia_clinica.exa_fis_ta, 
tbl15_historia_clinica.exa_fis_lateral, tbl15_historia_clinica.exa_fis_periabdom, tbl15_historia_clinica.exa_fis_temperat, tbl15_historia_clinica.exa_fis_concepto, 
tbl15_historia_clinica.exa_fis_ojoder_sncorre_vlejan, tbl15_historia_clinica.exa_fis_ojoder_sncorre_vcerca, tbl15_historia_clinica.exa_fis_ojoder_cncorre_vlejan, 
tbl15_historia_clinica.exa_fis_ojoder_cncorre_vcerca, tbl15_historia_clinica.exa_fis_ojoizq_sncorre_vlejan, tbl15_historia_clinica.exa_fis_ojoizq_sncorre_vcerca, 
tbl15_historia_clinica.exa_fis_ojoizq_cncorre_vlejan, tbl15_historia_clinica.exa_fis_ojoizq_cncorre_vcerca, tbl15_historia_clinica.exa_fis_ojoamb_sncorre_vlejan, 
tbl15_historia_clinica.exa_fis_ojoamb_sncorre_vcerca, tbl15_historia_clinica.exa_fis_oojoamb_cncorre_vlejan, tbl15_historia_clinica.exa_fis_ojoamb_cncorre_vcerca, 
tbl15_historia_clinica.exa_fis,
tbl15_historia_clinica.exa_fis_ojo, tbl15_historia_clinica.exa_fis_ojo_obser, 
tbl15_historia_clinica.exa_fis_oido, tbl15_historia_clinica.exa_fis_oido_obser, tbl15_historia_clinica.exa_fis_cabeza, tbl15_historia_clinica.exa_fis_cabeza_obser, 
tbl15_historia_clinica.exa_fis_nariz, tbl15_historia_clinica.exa_fis_nariz_obser, tbl15_historia_clinica.exa_fis_orofaring, tbl15_historia_clinica.exa_fis_orofaring_obser, 
tbl15_historia_clinica.exa_fis_cuello, tbl15_historia_clinica.exa_fis_cuello_obser, tbl15_historia_clinica.exa_fis_torax, tbl15_historia_clinica.exa_fis_torax_obser, 
tbl15_historia_clinica.exa_fis_glandumama, tbl15_historia_clinica.exa_fis_glandumama_obser, tbl15_historia_clinica.exa_fis_cardiopulm, tbl15_historia_clinica.exa_fis_cardiopulm_obser, 
tbl15_historia_clinica.exa_fis_abdomen, tbl15_historia_clinica.exa_fis_abdomen_obser, tbl15_historia_clinica.exa_fis_genital, tbl15_historia_clinica.exa_fis_genital_obser, 
tbl15_historia_clinica.exa_fis_miemsup, tbl15_historia_clinica.exa_fis_miemsup_obser, tbl15_historia_clinica.exa_fis_mieminf, tbl15_historia_clinica.exa_fis_mieminf_obser, 
tbl15_historia_clinica.exa_fis_columna, tbl15_historia_clinica.exa_fis_columna_obser, tbl15_historia_clinica.exa_fis_neurolog, tbl15_historia_clinica.exa_fis_neurolog_obser,
tbl15_historia_clinica.exa_fis_neurolog_romberg, tbl15_historia_clinica.exa_fis_neurolog_barany, tbl15_historia_clinica.exa_fis_neurolog_dixhalp,
tbl15_historia_clinica.exa_fis_neurolog_mciega, tbl15_historia_clinica.exa_fis_neurolog_pciega, 
tbl15_historia_clinica.exa_fis_estmentaparent, tbl15_historia_clinica.exa_fis_estmentaparent_obser, tbl15_historia_clinica.exa_fis_pielfanera, 
tbl15_historia_clinica.exa_fis_pielfanera_obser, tbl15_historia_clinica.exaosteo_norm_anorm, tbl15_historia_clinica.exaosteo_homb_movart, tbl15_historia_clinica.exaosteo_homb_fuerza, 
tbl15_historia_clinica.exaosteo_manjobe_sig, tbl15_historia_clinica.exaosteo_manjobe_lat, tbl15_historia_clinica.exaosteo_manjobe_movart, 
tbl15_historia_clinica.exaosteo_manjobe_fuerza, tbl15_historia_clinica.exaosteo_manyega_sig, tbl15_historia_clinica.exaosteo_manyega_lat, tbl15_historia_clinica.exaosteo_manyega_movart, 
tbl15_historia_clinica.exaosteo_manyega_fuerza, tbl15_historia_clinica.exaosteo_manpatte_sig, 
tbl15_historia_clinica.exaosteo_manpatte_lat, tbl15_historia_clinica.exaosteo_epicond_sig, tbl15_historia_clinica.exaosteo_epicond_lat, 
tbl15_historia_clinica.exaosteo_tinel_sig, tbl15_historia_clinica.exaosteo_tinel_lat, tbl15_historia_clinica.exaosteo_epitro_sig, tbl15_historia_clinica.exaosteo_epitro_lat, 
tbl15_historia_clinica.exaosteo_phalen_sig, tbl15_historia_clinica.exaosteo_phalen_lat, tbl15_historia_clinica.exaosteo_thomp_sig, tbl15_historia_clinica.exaosteo_thomp_lat, 
tbl15_historia_clinica.exaosteo_finkel_sig, tbl15_historia_clinica.exaosteo_finkel_lat, tbl15_historia_clinica.exaosteo_laseg_sig, 
tbl15_historia_clinica.exaosteo_bostezo_sig, tbl15_historia_clinica.exaosteo_bostezo_lat, tbl15_historia_clinica.exaosteo_flexion, tbl15_historia_clinica.exaosteo_cajon_sig, 
tbl15_historia_clinica.exaosteo_cajon_lat, tbl15_historia_clinica.exaosteo_extension, tbl15_historia_clinica.exaosteo_mcmurray_sig, tbl15_historia_clinica.exaosteo_mcmurray_lat, 
tbl15_historia_clinica.exaosteo_bragard_sig, tbl15_historia_clinica.exaosteo_bragard_lat, tbl15_historia_clinica.exaosteo_tredelen, tbl15_historia_clinica.exaosteo_valmarcha, 
tbl15_historia_clinica.exaosteo_observ, tbl15_historia_clinica.paracli_audimet, tbl15_historia_clinica.paracli_audimet_observ, tbl15_historia_clinica.paracli_visiomet, 
tbl15_historia_clinica.paracli_visiomet_observ, tbl15_historia_clinica.paracli_torax, tbl15_historia_clinica.paracli_torax_observ, tbl15_historia_clinica.paracli_espiro, 
tbl15_historia_clinica.paracli_espiro_observ, tbl15_historia_clinica.paracli_ekg, tbl15_historia_clinica.paracli_ekg_observ, tbl15_historia_clinica.paracli_rxcolum, 
tbl15_historia_clinica.paracli_rxcolum_observ, tbl15_historia_clinica.paracli_otrcomplement, tbl15_historia_clinica.paracli_otrcomplement_observ, tbl15_historia_clinica.paracli_fisiote, 
tbl15_historia_clinica.paracli_fisiote_observ, tbl15_historia_clinica.paracli_lab, tbl15_historia_clinica.paracli_lab_observ, tbl15_historia_clinica.paracli_otro, 
tbl15_historia_clinica.paracli_otro_observ, tbl15_historia_clinica.control_examen, tbl15_historia_clinica.cod_tipo_historia_clinica, tbl15_historia_clinica.cod_estado_facturacion, 
tbl15_historia_clinica.total_terapia, tbl15_historia_clinica.nombre_laboratorio, 
tbl15_historia_clinica.nombre_medicamento, tbl15_historia_clinica.descripcion_medicamento, tbl15_historia_clinica.nombre_ayuda_diagnostica, 
tbl15_historia_clinica.descripcion_ayuda_diagnostica, tbl15_historia_clinica.nombre_religion, tbl15_historia_clinica.nombre_ocupacion, 
tbl15_historia_clinica.nombre_estado_civil, tbl15_historia_clinica.nombre_escolaridad, tbl15_historia_clinica.nombre_tipo_regimen, tbl15_historia_clinica.nombre_fondo_pension, 
tbl15_historia_clinica.nombre_actividad_ecoemp, tbl15_historia_clinica.nombre_estrato, tbl15_historia_clinica.nombre_numero_hijos, 
tbl15_historia_clinica.nombre_arl, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.cargo_empresa, tbl15_historia_clinica.area_empresa, 
tbl15_historia_clinica.ciudad_empresa, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente AS tel_cliente_hist, tbl15_historia_clinica.correo, 
tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia, tbl15_historia_clinica.nombre_contacto1, tbl15_historia_clinica.tel_contacto1, 
tbl15_historia_clinica.parentesco_contacto1, tbl15_historia_clinica.direccion_contacto1, tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.fecha_anyo, 
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_reg_time, 
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.cuenta, tbl15_historia_clinica.cuenta_reg, 
tbl15_cliente.lugar_procedencia, tbl15_historia_clinica.cod_administrador
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (tbl15_historia_clinica.cod_historia_clinica = '$cod_historia_clinica')";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_entidad                  = $info_historia_clinica['cod_entidad'];
$cod_administrador            = $info_historia_clinica['cod_administrador'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad               = $info_entidad['nombre_entidad'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$sql_profesional = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombres_prof                 = $info_profesional['nombres'];
$apellidos_prof               = $info_profesional['apellidos'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$cedula                       = $info_historia_clinica['cedula'];
$nombres_cli                  = $info_historia_clinica['nombres'];
$apellido1_cli                = $info_historia_clinica['apellido1'];
$apellido2_cli                = $info_historia_clinica['apellido2'];
$nombre_ocupacion             = $info_historia_clinica['nombre_ocupacion'];
$nombres_completos            = $nombres_cli.' '.$apellido1_cli;
$fecha_nac_ymd                = $info_historia_clinica['fecha_nac_ymd'];
$fecha_nac_timedb             = $info_historia_clinica['fecha_nac_time'];
$fecha_nac_time               = strtotime($fecha_nac_ymd);
$diferencia_edad              = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                    = floor($diferencia_edad / (365*60*60*24));
//$edad_anyo = $info_historia_clinica['edad_anyo'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$nombre_grupo_rh              = $info_historia_clinica['nombre_grupo_rh'];
$tel_cliente                  = $info_historia_clinica['tel_cliente_cli'];
$nombre_tipo_doc              = $info_historia_clinica['nombre_tipo_doc'];
$nombre_sexo                  = $info_historia_clinica['nombre_sexo'];
$nombre_contacto1             = $info_historia_clinica['nombre_contacto1'];
$parentesco_contacto1         = $info_historia_clinica['parentesco_contacto1'];
$tel_contacto1                = $info_historia_clinica['tel_contacto1'];
$antperson_alergia_si         = $info_historia_clinica['antperson_alergia_si'];
$antperson_alergia_no         = $info_historia_clinica['antperson_alergia_no'];
$antperson_patologico_si      = $info_historia_clinica['antperson_patologico_si'];
$antperson_patologico_no      = $info_historia_clinica['antperson_patologico_no'];
$antperson_quirurgico_si      = $info_historia_clinica['antperson_quirurgico_si'];
$antperson_quirurgico_no      = $info_historia_clinica['antperson_quirurgico_no'];
$url_img_firma_min_cli        = $info_historia_clinica['url_img_firma_min_cli'];
$url_img_firma_cli            = $info_historia_clinica['url_img_firma_cli'];
$url_img_foto_min_cli         = $info_historia_clinica['url_img_foto_min_cli'];
$url_img_foto_cli             = $info_historia_clinica['url_img_foto_cli'];
$url_img_firma_min            = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig           = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min             = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig            = $info_historia_clinica['url_img_foto_orig'];
$nombre_tipo_regimen          = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension         = $info_historia_clinica['nombre_fondo_pension'];
$nombre_numero_hijos          = $info_historia_clinica['nombre_numero_hijos'];
$lugar_residencia             = $info_historia_clinica['lugar_residencia'];
$nombre_estado_civil          = $info_historia_clinica['nombre_estado_civil'];
$nombre_arl                   = $info_historia_clinica['nombre_arl'];
$lugar_nac                    = $info_historia_clinica['lugar_nac'];
$nombre_raza                  = $info_historia_clinica['nombre_raza'];
$nombre_escolaridad           = $info_historia_clinica['nombre_escolaridad'];
$direccion_contacto1          = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2          = $info_historia_clinica['direccion_contacto2'];
$nombre_empresa               = $info_historia_clinica['nombre_empresa'];
$nombre_empresa_contratante   = $info_historia_clinica['nombre_empresa_contratante'];
$nombre_actividad_ecoemp      = $info_historia_clinica['nombre_actividad_ecoemp'];

$motivo                       = $info_historia_clinica['motivo'];
$cod_grupo_area               = $info_historia_clinica['cod_grupo_area'];
$cod_grupo_area_cargo         = $info_historia_clinica['cod_grupo_area_cargo'];
$dat_ocupa_emp1               = $info_historia_clinica['dat_ocupa_emp1'];
$dat_ocupa_carg1              = $info_historia_clinica['dat_ocupa_carg1'];
$dat_ocupa_visu1              = $info_historia_clinica['dat_ocupa_visu1'];
$dat_ocupa_audi1              = $info_historia_clinica['dat_ocupa_audi1'];
$dat_ocupa_altu1              = $info_historia_clinica['dat_ocupa_altu1'];
$dat_ocupa_resp1              = $info_historia_clinica['dat_ocupa_resp1'];
$dat_ocupa_fech_ini1          = $info_historia_clinica['dat_ocupa_fech_ini1'];
$dat_ocupa_dura_anyo1         = $info_historia_clinica['dat_ocupa_dura_anyo1'];
$dat_ocupa_emp2               = $info_historia_clinica['dat_ocupa_emp2'];
$dat_ocupa_carg2              = $info_historia_clinica['dat_ocupa_carg2'];
$dat_ocupa_visu2              = $info_historia_clinica['dat_ocupa_visu2'];
$dat_ocupa_audi2              = $info_historia_clinica['dat_ocupa_audi2'];
$dat_ocupa_altu2              = $info_historia_clinica['dat_ocupa_altu2'];
$dat_ocupa_resp2              = $info_historia_clinica['dat_ocupa_resp2'];
$dat_ocupa_fech_ini2          = $info_historia_clinica['dat_ocupa_fech_ini2'];
$dat_ocupa_dura_anyo2         = $info_historia_clinica['dat_ocupa_dura_anyo2'];
$dat_ocupa_emp3               = $info_historia_clinica['dat_ocupa_emp3'];
$dat_ocupa_carg3              = $info_historia_clinica['dat_ocupa_carg3'];
$dat_ocupa_visu3              = $info_historia_clinica['dat_ocupa_visu3'];
$dat_ocupa_audi3              = $info_historia_clinica['dat_ocupa_audi3'];
$dat_ocupa_altu3              = $info_historia_clinica['dat_ocupa_altu3'];
$dat_ocupa_resp3              = $info_historia_clinica['dat_ocupa_resp3'];
$dat_ocupa_fech_ini3          = $info_historia_clinica['dat_ocupa_fech_ini3'];
$dat_ocupa_dura_anyo3         = $info_historia_clinica['dat_ocupa_dura_anyo3'];
$dat_ocupa_observacion        = $info_historia_clinica['dat_ocupa_observacion'];
$clasrieg_carg1               = $info_historia_clinica['clasrieg_carg1'];
$clasrieg_fis1_ruid           = $info_historia_clinica['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum           = $info_historia_clinica['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic        = $info_historia_clinica['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra          = $info_historia_clinica['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem     = $info_historia_clinica['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres       = $info_historia_clinica['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor      = $info_historia_clinica['clasrieg_quim1_gasvapor'];
$clasrieg_quim1_aeroliq       = $info_historia_clinica['clasrieg_quim1_aeroliq'];
$clasrieg_quim1_solid         = $info_historia_clinica['clasrieg_quim1_solid'];
$clasrieg_quim1_liquid        = $info_historia_clinica['clasrieg_quim1_liquid'];
$clasrieg_biolog1_viru        = $info_historia_clinica['clasrieg_biolog1_viru'];
$clasrieg_biolog1_bacter      = $info_historia_clinica['clasrieg_biolog1_bacter'];
$clasrieg_biolog1_parasi      = $info_historia_clinica['clasrieg_biolog1_parasi'];
$clasrieg_biolog1_morde       = $info_historia_clinica['clasrieg_biolog1_morde'];
$clasrieg_biolog1_picad       = $info_historia_clinica['clasrieg_biolog1_picad'];
$clasrieg_biolog1_hongo       = $info_historia_clinica['clasrieg_biolog1_hongo'];
$clasrieg_ergo1_trabestat     = $info_historia_clinica['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis     = $info_historia_clinica['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga         = $info_historia_clinica['clasrieg_ergo1_carga'];
$clasrieg_ergo1_postforz      = $info_historia_clinica['clasrieg_ergo1_postforz'];
$clasrieg_ergo1_movrepet      = $info_historia_clinica['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_jortrab       = $info_historia_clinica['clasrieg_ergo1_jortrab'];
$clasrieg_psi1_monoto         = $info_historia_clinica['clasrieg_psi1_monoto'];
$clasrieg_psi1_relhuman       = $info_historia_clinica['clasrieg_psi1_relhuman'];
$clasrieg_psi1_contentarea    = $info_historia_clinica['clasrieg_psi1_contentarea'];
$clasrieg_psi1_orgtiemptrab   = $info_historia_clinica['clasrieg_psi1_orgtiemptrab'];
$clasrieg_segur1_mecanic      = $info_historia_clinica['clasrieg_segur1_mecanic'];
$clasrieg_segur1_electri      = $info_historia_clinica['clasrieg_segur1_electri'];
$clasrieg_segur1_locat        = $info_historia_clinica['clasrieg_segur1_locat'];
$clasrieg_segur1_fisiquim     = $info_historia_clinica['clasrieg_segur1_fisiquim'];
$clasrieg_segur1_public       = $info_historia_clinica['clasrieg_segur1_public'];
$clasrieg_segur1_espconfi     = $info_historia_clinica['clasrieg_segur1_espconfi'];
$clasrieg_segur1_trabaltura   = $info_historia_clinica['clasrieg_segur1_trabaltura'];
$clasrieg_observ1_otro        = $info_historia_clinica['clasrieg_observ1_otro'];
$clasrieg_observ1_coment      = $info_historia_clinica['clasrieg_observ1_coment'];
$clasrieg_carg2               = $info_historia_clinica['clasrieg_carg2'];
$clasrieg_fis2_ruid           = $info_historia_clinica['clasrieg_fis2_ruid'];
$clasrieg_fis2_ilum           = $info_historia_clinica['clasrieg_fis2_ilum'];
$clasrieg_fis2_noionic        = $info_historia_clinica['clasrieg_fis2_noionic'];
$clasrieg_fis2_vibra          = $info_historia_clinica['clasrieg_fis2_vibra'];
$clasrieg_fis2_tempextrem     = $info_historia_clinica['clasrieg_fis2_tempextrem'];
$clasrieg_fis2_cambpres       = $info_historia_clinica['clasrieg_fis2_cambpres'];
$clasrieg_quim2_gasvapor      = $info_historia_clinica['clasrieg_quim2_gasvapor'];
$clasrieg_quim2_aeroliq       = $info_historia_clinica['clasrieg_quim2_aeroliq'];
$clasrieg_quim2_solid         = $info_historia_clinica['clasrieg_quim2_solid'];
$clasrieg_quim2_liquid        = $info_historia_clinica['clasrieg_quim2_liquid'];
$clasrieg_biolog2_viru        = $info_historia_clinica['clasrieg_biolog2_viru'];
$clasrieg_biolog2_bacter      = $info_historia_clinica['clasrieg_biolog2_bacter'];
$clasrieg_biolog2_parasi      = $info_historia_clinica['clasrieg_biolog2_parasi'];
$clasrieg_biolog2_morde       = $info_historia_clinica['clasrieg_biolog2_morde'];
$clasrieg_biolog2_picad       = $info_historia_clinica['clasrieg_biolog2_picad'];
$clasrieg_biolog2_hongo       = $info_historia_clinica['clasrieg_biolog2_hongo'];
$clasrieg_ergo2_trabestat     = $info_historia_clinica['clasrieg_ergo2_trabestat'];
$clasrieg_ergo2_esfuerfis     = $info_historia_clinica['clasrieg_ergo2_esfuerfis'];
$clasrieg_ergo2_carga         = $info_historia_clinica['clasrieg_ergo2_carga'];
$clasrieg_ergo2_postforz      = $info_historia_clinica['clasrieg_ergo2_postforz'];
$clasrieg_ergo2_movrepet      = $info_historia_clinica['clasrieg_ergo2_movrepet'];
$clasrieg_ergo2_jortrab       = $info_historia_clinica['clasrieg_ergo2_jortrab'];
$clasrieg_psi2_monoto         = $info_historia_clinica['clasrieg_psi2_monoto'];
$clasrieg_psi2_relhuman       = $info_historia_clinica['clasrieg_psi2_relhuman'];
$clasrieg_psi2_contentarea    = $info_historia_clinica['clasrieg_psi2_contentarea'];
$clasrieg_psi2_orgtiemptrab   = $info_historia_clinica['clasrieg_psi2_orgtiemptrab'];
$clasrieg_segur2_mecanic      = $info_historia_clinica['clasrieg_segur2_mecanic'];
$clasrieg_segur2_electri      = $info_historia_clinica['clasrieg_segur2_electri'];
$clasrieg_segur2_locat        = $info_historia_clinica['clasrieg_segur2_locat'];
$clasrieg_segur2_fisiquim     = $info_historia_clinica['clasrieg_segur2_fisiquim'];
$clasrieg_segur2_public       = $info_historia_clinica['clasrieg_segur2_public'];
$clasrieg_segur2_espconfi     = $info_historia_clinica['clasrieg_segur2_espconfi'];
$clasrieg_segur2_trabaltura   = $info_historia_clinica['clasrieg_segur2_trabaltura'];
$clasrieg_observ2_otro        = $info_historia_clinica['clasrieg_observ2_otro'];
$clasrieg_observ2_coment      = $info_historia_clinica['clasrieg_observ2_coment'];
$clasrieg_carg3               = $info_historia_clinica['clasrieg_carg3'];
$clasrieg_fis3_ruid           = $info_historia_clinica['clasrieg_fis3_ruid'];
$clasrieg_fis3_ilum           = $info_historia_clinica['clasrieg_fis3_ilum'];
$clasrieg_fis3_noionic        = $info_historia_clinica['clasrieg_fis3_noionic'];
$clasrieg_fis3_vibra          = $info_historia_clinica['clasrieg_fis3_vibra'];
$clasrieg_fis3_tempextrem     = $info_historia_clinica['clasrieg_fis3_tempextrem'];
$clasrieg_fis3_cambpres       = $info_historia_clinica['clasrieg_fis3_cambpres'];
$clasrieg_quim3_gasvapor      = $info_historia_clinica['clasrieg_quim3_gasvapor'];
$clasrieg_quim3_aeroliq       = $info_historia_clinica['clasrieg_quim3_aeroliq'];
$clasrieg_quim3_solid         = $info_historia_clinica['clasrieg_quim3_solid'];
$clasrieg_quim3_liquid        = $info_historia_clinica['clasrieg_quim3_liquid'];
$clasrieg_biolog3_viru        = $info_historia_clinica['clasrieg_biolog3_viru'];
$clasrieg_biolog3_bacter      = $info_historia_clinica['clasrieg_biolog3_bacter'];
$clasrieg_biolog3_parasi      = $info_historia_clinica['clasrieg_biolog3_parasi'];
$clasrieg_biolog3_morde       = $info_historia_clinica['clasrieg_biolog3_morde'];
$clasrieg_biolog3_picad       = $info_historia_clinica['clasrieg_biolog3_picad'];
$clasrieg_biolog3_hongo       = $info_historia_clinica['clasrieg_biolog3_hongo'];
$clasrieg_ergo3_trabestat     = $info_historia_clinica['clasrieg_ergo3_trabestat'];
$clasrieg_ergo3_esfuerfis     = $info_historia_clinica['clasrieg_ergo3_esfuerfis'];
$clasrieg_ergo3_carga         = $info_historia_clinica['clasrieg_ergo3_carga'];
$clasrieg_ergo3_postforz      = $info_historia_clinica['clasrieg_ergo3_postforz'];
$clasrieg_ergo3_movrepet      = $info_historia_clinica['clasrieg_ergo3_movrepet'];
$clasrieg_ergo3_jortrab       = $info_historia_clinica['clasrieg_ergo3_jortrab'];
$clasrieg_psi3_monoto         = $info_historia_clinica['clasrieg_psi3_monoto'];
$clasrieg_psi3_relhuman       = $info_historia_clinica['clasrieg_psi3_relhuman'];
$clasrieg_psi3_contentarea    = $info_historia_clinica['clasrieg_psi3_contentarea'];
$clasrieg_psi3_orgtiemptrab   = $info_historia_clinica['clasrieg_psi3_orgtiemptrab'];
$clasrieg_segur3_mecanic      = $info_historia_clinica['clasrieg_segur3_mecanic'];
$clasrieg_segur3_electri      = $info_historia_clinica['clasrieg_segur3_electri'];
$clasrieg_segur3_locat        = $info_historia_clinica['clasrieg_segur3_locat'];
$clasrieg_segur3_fisiquim     = $info_historia_clinica['clasrieg_segur3_fisiquim'];
$clasrieg_segur3_public       = $info_historia_clinica['clasrieg_segur3_public'];
$clasrieg_segur3_espconfi     = $info_historia_clinica['clasrieg_segur3_espconfi'];
$clasrieg_segur3_trabaltura   = $info_historia_clinica['clasrieg_segur3_trabaltura'];
$clasrieg_observ3_otro        = $info_historia_clinica['clasrieg_observ3_otro'];
$clasrieg_observ3_coment      = $info_historia_clinica['clasrieg_observ3_coment'];
$ant_impor_accilab            = $info_historia_clinica['ant_impor_accilab'];
$ant_impor_fecha1             = $info_historia_clinica['ant_impor_fecha1'];
$ant_impor_empre1             = $info_historia_clinica['ant_impor_empre1'];
$ant_impor_causa1             = $info_historia_clinica['ant_impor_causa1'];
$ant_impor_tip_lesi1          = $info_historia_clinica['ant_impor_tip_lesi1'];
$ant_impor_part_afect1        = $info_historia_clinica['ant_impor_part_afect1'];
$ant_impor_dias_incap1        = $info_historia_clinica['ant_impor_dias_incap1'];
$ant_impor_secuela1           = $info_historia_clinica['ant_impor_secuela1'];
$ant_impor_fecha2             = $info_historia_clinica['ant_impor_fecha2'];
$ant_impor_empre2             = $info_historia_clinica['ant_impor_empre2'];
$ant_impor_causa2             = $info_historia_clinica['ant_impor_causa2'];
$ant_impor_tip_lesi2          = $info_historia_clinica['ant_impor_tip_lesi2'];
$ant_impor_part_afect2        = $info_historia_clinica['ant_impor_part_afect2'];
$ant_impor_dias_incap2        = $info_historia_clinica['ant_impor_dias_incap2'];
$ant_impor_secuela2           = $info_historia_clinica['ant_impor_secuela2'];
$enf_lab                      = $info_historia_clinica['enf_lab'];
$enf_cual                     = $info_historia_clinica['enf_cual'];
$enf_hace_cuanto              = $info_historia_clinica['enf_hace_cuanto'];
$enf_descripcion              = $info_historia_clinica['enf_descripcion'];
$ant_fam_no_presenta          = $info_historia_clinica['ant_fam_no_presenta'];
$ant_fam_hiper_pad            = $info_historia_clinica['ant_fam_hiper_pad'];
$ant_fam_hiper_mad            = $info_historia_clinica['ant_fam_hiper_mad'];
$ant_fam_hiper_herm           = $info_historia_clinica['ant_fam_hiper_herm'];
$ant_fam_hiper_otro           = $info_historia_clinica['ant_fam_hiper_otro'];
$ant_fam_hiper_otro_cual      = $info_historia_clinica['ant_fam_hiper_otro_cual'];
$ant_fam_diabet_pad           = $info_historia_clinica['ant_fam_diabet_pad'];
$ant_fam_diabet_mad           = $info_historia_clinica['ant_fam_diabet_mad'];
$ant_fam_diabet_herm          = $info_historia_clinica['ant_fam_diabet_herm'];
$ant_fam_diabet_otro          = $info_historia_clinica['ant_fam_diabet_otro'];
$ant_fam_diabet_otro_cual     = $info_historia_clinica['ant_fam_diabet_otro_cual'];
$ant_fam_trombos_pad          = $info_historia_clinica['ant_fam_trombos_pad'];
$ant_fam_trombos_mad          = $info_historia_clinica['ant_fam_trombos_mad'];
$ant_fam_trombos_herm         = $info_historia_clinica['ant_fam_trombos_herm'];
$ant_fam_trombos_otro         = $info_historia_clinica['ant_fam_trombos_otro'];
$ant_fam_trombos_otro_cual    = $info_historia_clinica['ant_fam_trombos_otro_cual'];
$ant_fam_tum_malig_pad        = $info_historia_clinica['ant_fam_tum_malig_pad'];
$ant_fam_tum_malig_mad        = $info_historia_clinica['ant_fam_tum_malig_mad'];
$ant_fam_tum_malig_herm       = $info_historia_clinica['ant_fam_tum_malig_herm'];
$ant_fam_tum_malig_otro       = $info_historia_clinica['ant_fam_tum_malig_otro'];
$ant_fam_tum_malig_otro_cual  = $info_historia_clinica['ant_fam_tum_malig_otro_cual'];
$ant_fam_enf_ment_pad         = $info_historia_clinica['ant_fam_enf_ment_pad'];
$ant_fam_enf_ment_mad         = $info_historia_clinica['ant_fam_enf_ment_mad'];
$ant_fam_enf_ment_herm        = $info_historia_clinica['ant_fam_enf_ment_herm'];
$ant_fam_enf_ment_otro        = $info_historia_clinica['ant_fam_enf_ment_otro'];
$ant_fam_enf_ment_otro_cual   = $info_historia_clinica['ant_fam_enf_ment_otro_cual'];
$ant_fam_cadio_pad            = $info_historia_clinica['ant_fam_cadio_pad'];
$ant_fam_cadio_mad            = $info_historia_clinica['ant_fam_cadio_mad'];
$ant_fam_cadio_herm           = $info_historia_clinica['ant_fam_cadio_herm'];
$ant_fam_cadio_otro           = $info_historia_clinica['ant_fam_cadio_otro'];
$ant_fam_cadio_otro_cual      = $info_historia_clinica['ant_fam_cadio_otro_cual'];
$ant_fam_trans_convul_pad     = $info_historia_clinica['ant_fam_trans_convul_pad'];
$ant_fam_trans_convul_mad     = $info_historia_clinica['ant_fam_trans_convul_mad'];
$ant_fam_trans_convul_herm    = $info_historia_clinica['ant_fam_trans_convul_herm'];
$ant_fam_trans_convul_otro    = $info_historia_clinica['ant_fam_trans_convul_otro'];
$ant_fam_trans_convul_otro_cual = $info_historia_clinica['ant_fam_trans_convul_otro_cual'];
$ant_fam_enf_gene_pad         = $info_historia_clinica['ant_fam_enf_gene_pad'];
$ant_fam_enf_gene_mad         = $info_historia_clinica['ant_fam_enf_gene_mad'];
$ant_fam_enf_gene_herm        = $info_historia_clinica['ant_fam_enf_gene_herm'];
$ant_fam_enf_gene_otro        = $info_historia_clinica['ant_fam_enf_gene_otro'];
$ant_fam_enf_gene_otro_cual   = $info_historia_clinica['ant_fam_enf_gene_otro_cual'];
$ant_fam_alerg_pad            = $info_historia_clinica['ant_fam_alerg_pad'];
$ant_fam_alerg_mad            = $info_historia_clinica['ant_fam_alerg_mad'];
$ant_fam_alerg_herm           = $info_historia_clinica['ant_fam_alerg_herm'];
$ant_fam_alerg_otro           = $info_historia_clinica['ant_fam_alerg_otro'];
$ant_fam_alerg_otro_cual      = $info_historia_clinica['ant_fam_alerg_otro_cual'];
$ant_fam_tuber_pad            = $info_historia_clinica['ant_fam_tuber_pad'];
$ant_fam_tuber_mad            = $info_historia_clinica['ant_fam_tuber_mad'];
$ant_fam_tuber_herm           = $info_historia_clinica['ant_fam_tuber_herm'];
$ant_fam_tuber_otro           = $info_historia_clinica['ant_fam_tuber_otro'];
$ant_fam_tuber_otro_cual      = $info_historia_clinica['ant_fam_tuber_otro_cual'];
$ant_fam_osteomusc_pad        = $info_historia_clinica['ant_fam_osteomusc_pad'];
$ant_fam_osteomusc_mad        = $info_historia_clinica['ant_fam_osteomusc_mad'];
$ant_fam_osteomusc_herm       = $info_historia_clinica['ant_fam_osteomusc_herm'];
$ant_fam_osteomusc_otro       = $info_historia_clinica['ant_fam_osteomusc_otro'];
$ant_fam_osteomusc_otro_cual  = $info_historia_clinica['ant_fam_osteomusc_otro_cual'];
$ant_fam_artitri_pad          = $info_historia_clinica['ant_fam_artitri_pad'];
$ant_fam_artitri_mad          = $info_historia_clinica['ant_fam_artitri_mad'];
$ant_fam_artitri_herm         = $info_historia_clinica['ant_fam_artitri_herm'];
$ant_fam_artitri_otro         = $info_historia_clinica['ant_fam_artitri_otro'];
$ant_fam_artitri_otro_cual    = $info_historia_clinica['ant_fam_artitri_otro_cual'];
$ant_fam_varice_pad           = $info_historia_clinica['ant_fam_varice_pad'];
$ant_fam_varice_mad           = $info_historia_clinica['ant_fam_varice_mad'];
$ant_fam_varice_herm          = $info_historia_clinica['ant_fam_varice_herm'];
$ant_fam_varice_otro          = $info_historia_clinica['ant_fam_varice_otro'];
$ant_fam_varice_otro_cual     = $info_historia_clinica['ant_fam_varice_otro_cual'];
$ant_fam_otro_pad             = $info_historia_clinica['ant_fam_otro_pad'];
$ant_fam_otro_mad             = $info_historia_clinica['ant_fam_otro_mad'];
$ant_fam_otro_herm            = $info_historia_clinica['ant_fam_otro_herm'];
$ant_fam_otro_otro            = $info_historia_clinica['ant_fam_otro_otro'];
$ant_fam_otro_otro_cual       = $info_historia_clinica['ant_fam_otro_otro_cual'];
$ant_fam_descripcion          = $info_historia_clinica['ant_fam_descripcion'];
$ant_pato_no_presenta         = $info_historia_clinica['ant_pato_no_presenta'];
$ant_pato_neuro               = $info_historia_clinica['ant_pato_neuro'];
$ant_pato_resp                = $info_historia_clinica['ant_pato_resp'];
$ant_pato_derma               = $info_historia_clinica['ant_pato_derma'];
$ant_pato_psiq                = $info_historia_clinica['ant_pato_psiq'];
$ant_pato_alerg               = $info_historia_clinica['ant_pato_alerg'];
$ant_pato_osteomusc           = $info_historia_clinica['ant_pato_osteomusc'];
$ant_pato_gastrointes         = $info_historia_clinica['ant_pato_gastrointes'];
$ant_pato_hematolog           = $info_historia_clinica['ant_pato_hematolog'];
$ant_pato_org_sentid          = $info_historia_clinica['ant_pato_org_sentid'];
$ant_pato_onco                = $info_historia_clinica['ant_pato_onco'];
$ant_pato_hiperten            = $info_historia_clinica['ant_pato_hiperten'];
$ant_pato_genurinario         = $info_historia_clinica['ant_pato_genurinario'];
$ant_pato_infesios            = $info_historia_clinica['ant_pato_infesios'];
$ant_pato_congenit            = $info_historia_clinica['ant_pato_congenit'];
$ant_pato_farmacolog          = $info_historia_clinica['ant_pato_farmacolog'];
$ant_pato_transfus            = $info_historia_clinica['ant_pato_transfus'];
$ant_pato_endocrino           = $info_historia_clinica['ant_pato_endocrino'];
$ant_pato_vascular            = $info_historia_clinica['ant_pato_vascular'];
$ant_pato_auntoinmun          = $info_historia_clinica['ant_pato_auntoinmun'];
$ant_pato_otro                = $info_historia_clinica['ant_pato_otro'];
$ant_pato_descripcion         = $info_historia_clinica['ant_pato_descripcion'];
$ant_altu_no                  = $info_historia_clinica['ant_altu_no'];
$ant_altu_epilep              = $info_historia_clinica['ant_altu_epilep'];
$ant_altu_otitmed             = $info_historia_clinica['ant_altu_otitmed'];
$ant_altu_enfmanier           = $info_historia_clinica['ant_altu_enfmanier'];
$ant_altu_traumcran           = $info_historia_clinica['ant_altu_traumcran'];
$ant_altu_tumcereb            = $info_historia_clinica['ant_altu_tumcereb'];
$ant_altu_malfocereb          = $info_historia_clinica['ant_altu_malfocereb'];
$ant_altu_trombo              = $info_historia_clinica['ant_altu_trombo'];
$ant_altu_hipoac              = $info_historia_clinica['ant_altu_hipoac'];
$ant_altu_arritcardi          = $info_historia_clinica['ant_altu_arritcardi'];
$ant_altu_hipogli             = $info_historia_clinica['ant_altu_hipogli'];
$ant_altu_fobia               = $info_historia_clinica['ant_altu_fobia'];
$ant_altu_observ              = $info_historia_clinica['ant_altu_observ'];
$ant_trau                     = $info_historia_clinica['ant_trau'];
$ant_trau_enfer1              = $info_historia_clinica['ant_trau_enfer1'];
$ant_trau_observ1             = $info_historia_clinica['ant_trau_observ1'];
$ant_trau_fech_aprox1         = $info_historia_clinica['ant_trau_fech_aprox1'];
$ant_trau_enfer2              = $info_historia_clinica['ant_trau_enfer2'];
$ant_trau_observ2             = $info_historia_clinica['ant_trau_observ2'];
$ant_trau_fech_aprox2         = $info_historia_clinica['ant_trau_fech_aprox2'];
$ant_trau_enfer3              = $info_historia_clinica['ant_trau_enfer3'];
$ant_trau_observ3             = $info_historia_clinica['ant_trau_observ3'];
$ant_trau_fech_aprox3         = $info_historia_clinica['ant_trau_fech_aprox3'];
$ant_quirur                   = $info_historia_clinica['ant_quirur'];
$ant_quirur_enfer1            = $info_historia_clinica['ant_quirur_enfer1'];
$ant_quirur_observ1           = $info_historia_clinica['ant_quirur_observ1'];
$ant_quirur_fech_aprox1       = $info_historia_clinica['ant_quirur_fech_aprox1'];
$ant_quirur_enfer2            = $info_historia_clinica['ant_quirur_enfer2'];
$ant_quirur_observ2           = $info_historia_clinica['ant_quirur_observ2'];
$ant_quirur_fech_aprox2       = $info_historia_clinica['ant_quirur_fech_aprox2'];
$ant_quirur_enfer3            = $info_historia_clinica['ant_quirur_enfer3'];
$ant_quirur_observ3           = $info_historia_clinica['ant_quirur_observ3'];
$ant_quirur_fech_aprox3       = $info_historia_clinica['ant_quirur_fech_aprox3'];
$costo_motivo_consulta        = $info_historia_clinica['costo_motivo_consulta'];
$cod_factura                  = $info_historia_clinica['cod_factura'];
$ant_inmuni                   = $info_historia_clinica['ant_inmuni'];
$ant_inmuni_tetano            = $info_historia_clinica['ant_inmuni_tetano'];
$ant_inmuni_tetano_anyo       = $info_historia_clinica['ant_inmuni_tetano_anyo'];
$ant_inmuni_fiebtifo          = $info_historia_clinica['ant_inmuni_fiebtifo'];
$ant_inmuni_fiebtifo_anyo     = $info_historia_clinica['ant_inmuni_fiebtifo_anyo'];
$ant_inmuni_hepatita          = $info_historia_clinica['ant_inmuni_hepatita'];
$ant_inmuni_hepatita_anyo     = $info_historia_clinica['ant_inmuni_hepatita_anyo'];
$ant_inmuni_influenza         = $info_historia_clinica['ant_inmuni_influenza'];
$ant_inmuni_influenza_anyo    = $info_historia_clinica['ant_inmuni_influenza_anyo'];
$ant_inmuni_hepatitb          = $info_historia_clinica['ant_inmuni_hepatitb'];
$ant_inmuni_hepatitb_anyo     = $info_historia_clinica['ant_inmuni_hepatitb_anyo'];
$ant_inmuni_saramp            = $info_historia_clinica['ant_inmuni_saramp'];
$ant_inmuni_saramp_anyo       = $info_historia_clinica['ant_inmuni_saramp_anyo'];
$ant_inmuni_fiebamarill       = $info_historia_clinica['ant_inmuni_fiebamarill'];
$ant_inmuni_fiebamarill_anyo  = $info_historia_clinica['ant_inmuni_fiebamarill_anyo'];
$ant_inmuni_otra              = $info_historia_clinica['ant_inmuni_otra'];
$ant_inmuni_otra_anyo         = $info_historia_clinica['ant_inmuni_otra_anyo'];
$ant_inmuni_observacion       = $info_historia_clinica['ant_inmuni_observacion'];
$ant_gine_prim_mestrua        = $info_historia_clinica['ant_gine_prim_mestrua'];
$ant_gine_anyos               = $info_historia_clinica['ant_gine_anyos'];
$ant_gine_cliclo              = $info_historia_clinica['ant_gine_cliclo'];
$ant_gine_fum                 = $info_historia_clinica['ant_gine_fum'];
$ant_gine_fup                 = $info_historia_clinica['ant_gine_fup'];
$ant_gine_fuc                 = $info_historia_clinica['ant_gine_fuc'];
$ant_gine_fich_gine           = $info_historia_clinica['ant_gine_fich_gine'];
$ant_gine_fich_gine_g         = $info_historia_clinica['ant_gine_fich_gine_g'];
$ant_gine_fich_gine_p         = $info_historia_clinica['ant_gine_fich_gine_p'];
$ant_gine_fich_gine_a         = $info_historia_clinica['ant_gine_fich_gine_a'];
$ant_gine_fich_gine_c         = $info_historia_clinica['ant_gine_fich_gine_c'];
$ant_gine_fich_gine_m         = $info_historia_clinica['ant_gine_fich_gine_m'];
$ant_gine_fich_gine_e         = $info_historia_clinica['ant_gine_fich_gine_e'];
$ant_gine_fich_gine_v         = $info_historia_clinica['ant_gine_fich_gine_v'];
$ant_gine_fech_ult_exa_mama   = $info_historia_clinica['ant_gine_fech_ult_exa_mama'];
$ant_gine_planifica           = $info_historia_clinica['ant_gine_planifica'];
$ant_gine_observacion         = $info_historia_clinica['ant_gine_observacion'];
$habit_tox_fum_nofum_exfum    = $info_historia_clinica['habit_tox_fum_nofum_exfum'];
$habit_tox_ciga_aldia         = $info_historia_clinica['habit_tox_ciga_aldia'];
$habit_tox_anyos_fum          = $info_historia_clinica['habit_tox_anyos_fum'];
$habit_tox_tiem_sinfum        = $info_historia_clinica['habit_tox_tiem_sinfum'];
$habit_tox_consum_alcoh       = $info_historia_clinica['habit_tox_consum_alcoh'];
$habit_tox_activ_extralab     = $info_historia_clinica['habit_tox_activ_extralab'];
$habit_tox_activfis           = $info_historia_clinica['habit_tox_activfis'];
$habit_tox_actividad          = $info_historia_clinica['habit_tox_actividad'];
$habit_tox_frecuenc           = $info_historia_clinica['habit_tox_frecuenc'];
$habit_tox_tiempo             = $info_historia_clinica['habit_tox_tiempo'];
$rev_sist_no                  = $info_historia_clinica['rev_sist_no'];
$rev_sist_orgsentido          = $info_historia_clinica['rev_sist_orgsentido'];
$rev_sist_observ_orgsentido   = $info_historia_clinica['rev_sist_observ_orgsentido'];
$rev_sist_neurolog            = $info_historia_clinica['rev_sist_neurolog'];
$rev_sist_observ_neurolog     = $info_historia_clinica['rev_sist_observ_neurolog'];
$rev_sist_resp                = $info_historia_clinica['rev_sist_resp'];
$rev_sist_observ_resp         = $info_historia_clinica['rev_sist_observ_resp'];
$rev_sist_gastrointes         = $info_historia_clinica['rev_sist_gastrointes'];
$rev_sist_observ_gastrointes  = $info_historia_clinica['rev_sist_observ_gastrointes'];
$rev_sist_geniuri             = $info_historia_clinica['rev_sist_geniuri'];
$rev_sist_observ_geniuri      = $info_historia_clinica['rev_sist_observ_geniuri'];
$rev_sist_osteomus            = $info_historia_clinica['rev_sist_osteomus'];
$rev_sist_observ_osteomus     = $info_historia_clinica['rev_sist_observ_osteomus'];
$rev_sist_dermato             = $info_historia_clinica['rev_sist_dermato'];
$rev_sist_observ_dermato      = $info_historia_clinica['rev_sist_observ_dermato'];
$rev_sist_cardiovas           = $info_historia_clinica['rev_sist_cardiovas'];
$rev_sist_observ_cardiovas    = $info_historia_clinica['rev_sist_observ_cardiovas'];
$rev_sist_constitu            = $info_historia_clinica['rev_sist_constitu'];
$rev_sist_observ_constitu     = $info_historia_clinica['rev_sist_observ_constitu'];
$rev_sist_metabolendocri      = $info_historia_clinica['rev_sist_metabolendocri'];
$rev_sist_observ_metabolendocri = $info_historia_clinica['rev_sist_observ_metabolendocri'];
$eval_estment_norm_orient     = $info_historia_clinica['eval_estment_norm_orient'];
$eval_estment_disf_orient     = $info_historia_clinica['eval_estment_disf_orient'];
$eval_estment_halla_orient    = $info_historia_clinica['eval_estment_halla_orient'];
$eval_estment_norm_atenconcent = $info_historia_clinica['eval_estment_norm_atenconcent'];
$eval_estment_disf_atenconcent = $info_historia_clinica['eval_estment_disf_atenconcent'];
$eval_estment_halla_atenconcent = $info_historia_clinica['eval_estment_halla_atenconcent'];
$eval_estment_norm_sensoper   = $info_historia_clinica['eval_estment_norm_sensoper'];
$eval_estment_disf_sensoper   = $info_historia_clinica['eval_estment_disf_sensoper'];
$eval_estment_halla_sensoper  = $info_historia_clinica['eval_estment_halla_sensoper'];
$eval_estment_norm_memor     = $info_historia_clinica['eval_estment_norm_memor'];
$eval_estment_disf_memor     = $info_historia_clinica['eval_estment_disf_memor'];
$eval_estment_halla_memor    = $info_historia_clinica['eval_estment_halla_memor'];
$eval_estment_norm_pensami   = $info_historia_clinica['eval_estment_norm_pensami'];
$eval_estment_disf_pensami   = $info_historia_clinica['eval_estment_disf_pensami'];
$eval_estment_halla_pensami  = $info_historia_clinica['eval_estment_halla_pensami'];
$eval_estment_norm_lenguaj   = $info_historia_clinica['eval_estment_norm_lenguaj'];
$eval_estment_disf_lenguaj   = $info_historia_clinica['eval_estment_disf_lenguaj'];
$eval_estment_halla_lenguaj  = $info_historia_clinica['eval_estment_halla_lenguaj'];
$eval_estment_concept        = $info_historia_clinica['eval_estment_concept'];
$exa_fis_peso                = $info_historia_clinica['exa_fis_peso'];
$exa_fis_talla               = $info_historia_clinica['exa_fis_talla'];
$exa_fis_imc                 = $info_historia_clinica['exa_fis_imc'];
$exa_fis_interpreimc         = $info_historia_clinica['exa_fis_interpreimc'];
$exa_fis_fresp               = $info_historia_clinica['exa_fis_fresp'];
$exa_fis_fc                  = $info_historia_clinica['exa_fis_fc'];
$exa_fis_ta                  = $info_historia_clinica['exa_fis_ta'];
$exa_fis_lateral             = $info_historia_clinica['exa_fis_lateral'];
$exa_fis_periabdom           = $info_historia_clinica['exa_fis_periabdom'];
$exa_fis_temperat            = $info_historia_clinica['exa_fis_temperat'];
$exa_fis_concepto            = $info_historia_clinica['exa_fis_concepto'];
$exa_fis_ojoder_sncorre_vlejan = $info_historia_clinica['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca = $info_historia_clinica['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan = $info_historia_clinica['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca = $info_historia_clinica['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan = $info_historia_clinica['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca = $info_historia_clinica['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan = $info_historia_clinica['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca = $info_historia_clinica['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan = $info_historia_clinica['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca = $info_historia_clinica['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan = $info_historia_clinica['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca = $info_historia_clinica['exa_fis_ojoamb_cncorre_vcerca'];
$exa_fis                     = $info_historia_clinica['exa_fis'];
$exa_fis_ojo                 = $info_historia_clinica['exa_fis_ojo'];
$exa_fis_ojo_obser           = $info_historia_clinica['exa_fis_ojo_obser'];
$exa_fis_oido                = $info_historia_clinica['exa_fis_oido'];
$exa_fis_oido_obser          = $info_historia_clinica['exa_fis_oido_obser'];
$exa_fis_cabeza              = $info_historia_clinica['exa_fis_cabeza'];
$exa_fis_cabeza_obser        = $info_historia_clinica['exa_fis_cabeza_obser'];
$exa_fis_nariz               = $info_historia_clinica['exa_fis_nariz'];
$exa_fis_nariz_obser         = $info_historia_clinica['exa_fis_nariz_obser'];
$exa_fis_orofaring           = $info_historia_clinica['exa_fis_orofaring'];
$exa_fis_orofaring_obser     = $info_historia_clinica['exa_fis_orofaring_obser'];
$exa_fis_cuello              = $info_historia_clinica['exa_fis_cuello'];
$exa_fis_cuello_obser        = $info_historia_clinica['exa_fis_cuello_obser'];
$exa_fis_torax               = $info_historia_clinica['exa_fis_torax'];
$exa_fis_torax_obser         = $info_historia_clinica['exa_fis_torax_obser'];
$exa_fis_glandumama          = $info_historia_clinica['exa_fis_glandumama'];
$exa_fis_glandumama_obser    = $info_historia_clinica['exa_fis_glandumama_obser'];
$exa_fis_cardiopulm          = $info_historia_clinica['exa_fis_cardiopulm'];
$exa_fis_cardiopulm_obser    = $info_historia_clinica['exa_fis_cardiopulm_obser'];
$exa_fis_abdomen             = $info_historia_clinica['exa_fis_abdomen'];
$exa_fis_abdomen_obser       = $info_historia_clinica['exa_fis_abdomen_obser'];
$exa_fis_genital             = $info_historia_clinica['exa_fis_genital'];
$exa_fis_genital_obser       = $info_historia_clinica['exa_fis_genital_obser'];
$exa_fis_miemsup             = $info_historia_clinica['exa_fis_miemsup'];
$exa_fis_miemsup_obser       = $info_historia_clinica['exa_fis_miemsup_obser'];
$exa_fis_mieminf             = $info_historia_clinica['exa_fis_mieminf'];
$exa_fis_mieminf_obser       = $info_historia_clinica['exa_fis_mieminf_obser'];
$exa_fis_columna             = $info_historia_clinica['exa_fis_columna'];
$exa_fis_columna_obser       = $info_historia_clinica['exa_fis_columna_obser'];
$exa_fis_neurolog            = $info_historia_clinica['exa_fis_neurolog'];
$exa_fis_neurolog_obser      = $info_historia_clinica['exa_fis_neurolog_obser'];
$exa_fis_neurolog_romberg    = $info_historia_clinica['exa_fis_neurolog_romberg'];
$exa_fis_neurolog_barany     = $info_historia_clinica['exa_fis_neurolog_barany'];
$exa_fis_neurolog_dixhalp    = $info_historia_clinica['exa_fis_neurolog_dixhalp'];
$exa_fis_neurolog_mciega     = $info_historia_clinica['exa_fis_neurolog_mciega'];
$exa_fis_neurolog_pciega     = $info_historia_clinica['exa_fis_neurolog_pciega'];
$exa_fis_estmentaparent      = $info_historia_clinica['exa_fis_estmentaparent'];
$exa_fis_estmentaparent_obser = $info_historia_clinica['exa_fis_estmentaparent_obser'];
$exa_fis_pielfanera          = $info_historia_clinica['exa_fis_pielfanera'];
$exa_fis_pielfanera_obser    = $info_historia_clinica['exa_fis_pielfanera_obser'];
$exaosteo_norm_anorm         = $info_historia_clinica['exaosteo_norm_anorm'];
$exaosteo_homb_movart        = $info_historia_clinica['exaosteo_homb_movart'];
$exaosteo_homb_fuerza        = $info_historia_clinica['exaosteo_homb_fuerza'];
$exaosteo_manjobe_sig        = $info_historia_clinica['exaosteo_manjobe_sig'];
$exaosteo_manjobe_lat        = $info_historia_clinica['exaosteo_manjobe_lat'];
$exaosteo_manjobe_movart     = $info_historia_clinica['exaosteo_manjobe_movart'];
$exaosteo_manjobe_fuerza     = $info_historia_clinica['exaosteo_manjobe_fuerza'];
$exaosteo_manyega_sig        = $info_historia_clinica['exaosteo_manyega_sig'];
$exaosteo_manyega_lat        = $info_historia_clinica['exaosteo_manyega_lat'];
$exaosteo_manyega_movart     = $info_historia_clinica['exaosteo_manyega_movart'];
$exaosteo_manyega_fuerza     = $info_historia_clinica['exaosteo_manyega_fuerza'];
$exaosteo_manpatte_sig       = $info_historia_clinica['exaosteo_manpatte_sig'];
$exaosteo_manpatte_lat       = $info_historia_clinica['exaosteo_manpatte_lat'];
$exaosteo_epicond_sig        = $info_historia_clinica['exaosteo_epicond_sig'];
$exaosteo_epicond_lat        = $info_historia_clinica['exaosteo_epicond_lat'];
$exaosteo_tinel_sig          = $info_historia_clinica['exaosteo_tinel_sig'];
$exaosteo_tinel_lat          = $info_historia_clinica['exaosteo_tinel_lat'];
$exaosteo_epitro_sig         = $info_historia_clinica['exaosteo_epitro_sig'];
$exaosteo_epitro_lat         = $info_historia_clinica['exaosteo_epitro_lat'];
$exaosteo_phalen_sig         = $info_historia_clinica['exaosteo_phalen_sig'];
$exaosteo_phalen_lat         = $info_historia_clinica['exaosteo_phalen_lat'];
$exaosteo_thomp_sig          = $info_historia_clinica['exaosteo_thomp_sig'];
$exaosteo_thomp_lat          = $info_historia_clinica['exaosteo_thomp_lat'];
$exaosteo_finkel_sig         = $info_historia_clinica['exaosteo_finkel_sig'];
$exaosteo_finkel_lat         = $info_historia_clinica['exaosteo_finkel_lat'];
$exaosteo_laseg_sig          = $info_historia_clinica['exaosteo_laseg_sig'];
$exaosteo_bostezo_sig        = $info_historia_clinica['exaosteo_bostezo_sig'];
$exaosteo_bostezo_lat        = $info_historia_clinica['exaosteo_bostezo_lat'];
$exaosteo_flexion            = $info_historia_clinica['exaosteo_flexion'];
$exaosteo_cajon_sig          = $info_historia_clinica['exaosteo_cajon_sig'];
$exaosteo_cajon_lat          = $info_historia_clinica['exaosteo_cajon_lat'];
$exaosteo_extension          = $info_historia_clinica['exaosteo_extension'];
$exaosteo_mcmurray_sig       = $info_historia_clinica['exaosteo_mcmurray_sig'];
$exaosteo_mcmurray_lat       = $info_historia_clinica['exaosteo_mcmurray_lat'];
$exaosteo_bragard_sig        = $info_historia_clinica['exaosteo_bragard_sig'];
$exaosteo_bragard_lat        = $info_historia_clinica['exaosteo_bragard_lat'];
$exaosteo_tredelen           = $info_historia_clinica['exaosteo_tredelen'];
$exaosteo_valmarcha          = $info_historia_clinica['exaosteo_valmarcha'];
$exaosteo_observ             = $info_historia_clinica['exaosteo_observ'];
$paracli_audimet             = $info_historia_clinica['paracli_audimet'];
$paracli_audimet_observ      = $info_historia_clinica['paracli_audimet_observ'];
$paracli_visiomet            = $info_historia_clinica['paracli_visiomet'];
$paracli_visiomet_observ     = $info_historia_clinica['paracli_visiomet_observ'];
$paracli_torax               = $info_historia_clinica['paracli_torax'];
$paracli_torax_observ        = $info_historia_clinica['paracli_torax_observ'];
$paracli_espiro              = $info_historia_clinica['paracli_espiro'];
$paracli_espiro_observ       = $info_historia_clinica['paracli_espiro_observ'];
$paracli_ekg                 = $info_historia_clinica['paracli_ekg'];
$paracli_ekg_observ          = $info_historia_clinica['paracli_ekg_observ'];
$paracli_rxcolum             = $info_historia_clinica['paracli_rxcolum'];
$paracli_rxcolum_observ      = $info_historia_clinica['paracli_rxcolum_observ'];
$paracli_otrcomplement       = $info_historia_clinica['paracli_otrcomplement'];
$paracli_otrcomplement_observ = $info_historia_clinica['paracli_otrcomplement_observ'];
$paracli_fisiote             = $info_historia_clinica['paracli_fisiote'];
$paracli_fisiote_observ      = $info_historia_clinica['paracli_fisiote_observ'];
$paracli_lab                 = $info_historia_clinica['paracli_lab'];
$paracli_lab_observ          = $info_historia_clinica['paracli_lab_observ'];
$paracli_otro                = $info_historia_clinica['paracli_otro'];
$paracli_otro_observ         = $info_historia_clinica['paracli_otro_observ'];
$control_examen              = $info_historia_clinica['control_examen'];
$cod_tipo_historia_clinica   = $info_historia_clinica['cod_tipo_historia_clinica'];
$cod_estado_facturacion      = $info_historia_clinica['cod_estado_facturacion'];
$total_terapia               = $info_historia_clinica['total_terapia'];
$nombre_laboratorio          = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento          = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento     = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica    = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica = $info_historia_clinica['descripcion_ayuda_diagnostica'];
$nombre_religion             = $info_historia_clinica['nombre_religion'];
$nombre_ocupacion            = $info_historia_clinica['nombre_ocupacion'];
$nombre_estado_civil         = $info_historia_clinica['nombre_estado_civil'];
$nombre_escolaridad          = $info_historia_clinica['nombre_escolaridad'];
$nombre_tipo_regimen         = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension        = $info_historia_clinica['nombre_fondo_pension'];
$nombre_actividad_ecoemp     = $info_historia_clinica['nombre_actividad_ecoemp'];
$nombre_estrato              = $info_historia_clinica['nombre_estrato'];
$nombre_numero_hijos         = $info_historia_clinica['nombre_numero_hijos'];
$nombre_arl                  = $info_historia_clinica['nombre_arl'];
$nombre_empresa              = $info_historia_clinica['nombre_empresa'];
$cargo_empresa               = $info_historia_clinica['cargo_empresa'];
$area_empresa                = $info_historia_clinica['area_empresa'];
$ciudad_empresa              = $info_historia_clinica['ciudad_empresa'];
$nombre_empresa_contratante  = $info_historia_clinica['nombre_empresa_contratante'];
$tel_cliente_cli             = $info_historia_clinica['tel_cliente_cli'];
$correo                      = $info_historia_clinica['correo'];
$cod_entidad                 = $info_historia_clinica['cod_entidad'];
$lugar_residencia            = $info_historia_clinica['lugar_residencia'];
$nombre_contacto1            = $info_historia_clinica['nombre_contacto1'];
$tel_contacto1               = $info_historia_clinica['tel_contacto1'];
$parentesco_contacto1        = $info_historia_clinica['parentesco_contacto1'];
$direccion_contacto1         = $info_historia_clinica['direccion_contacto1'];
$fecha_mes                   = $info_historia_clinica['fecha_mes'];
$fecha_anyo                  = $info_historia_clinica['fecha_anyo'];
$fecha_ymd                   = $info_historia_clinica['fecha_ymd'];
$fecha_dmy                   = $info_historia_clinica['fecha_dmy'];
$hora                        = $info_historia_clinica['hora'];
$fecha_reg_time              = $info_historia_clinica['fecha_reg_time'];
$url_img_firma_min           = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig          = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min            = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig           = $info_historia_clinica['url_img_foto_orig'];
$cuenta                      = $info_historia_clinica['cuenta'];
$cuenta_reg                  = $info_historia_clinica['cuenta_reg'];
$lugar_procedencia           = $info_historia_clinica['lugar_procedencia'];
$fecha_time                  = $info_historia_clinica['fecha_time'];
$fecha_reg_time              = $info_historia_clinica['fecha_reg_time'];
$fecha_ymd                   = $info_historia_clinica['fecha_ymd'];
$cuenta                      = $info_historia_clinica['cuenta'];
$fecha_ymd_hora              = date("Y/m/d H:i:s", $fecha_time);
$fecha_dmy                   = $info_historia_clinica['fecha_dmy'];
$fecha_reg_time_dmy          = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica      = date("Y/m/d", $fecha_time);
$fecha_hisroria_clinica      = date("Y/m/d", $fecha_time);
$fecha_y_hora_registro       = date("Y/m/d H:i:s");

$sql_grupo_area_cargo = "SELECT nombre_grupo_area_cargo FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$resultado_grupo_area_cargo = mysqli_query($conectar, $sql_grupo_area_cargo);
$info_grupo_area_cargo = mysqli_fetch_assoc($resultado_grupo_area_cargo);

$nombre_grupo_area_cargo     = $info_grupo_area_cargo['nombre_grupo_area_cargo'];
?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<tbody>
<!--<tr><th>HISTORIA CLINICA No.</th><td align="center"><?php echo $cod_historia_clinica ?></td></tr>-->
<tr><th bgcolor="#FAC090">FECHA CITA</th><td bgcolor="#FAC090" align="center"><?php echo $fecha_hisroria_clinica ?></td><td bgcolor="#FAC090" align="center">HC - <?php echo $cod_historia_clinica ?></td></tr>

</tbody>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%">
	<thead><tr>
		<th valign="middle">
			<img src="<?php echo $url_img_foto_min_cli ?>" class="img-thumbnail" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/>
		</th>
	</tr></thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">NOMBRES Y APELLIDOS</th>
<th bgcolor="#FAC090">TIPO IDENTIFICACIÓN</th>
<th bgcolor="#FAC090">IDENTIFICACIÓN</th>
<th bgcolor="#FAC090">GÉNERO</th>
<th bgcolor="#FAC090">EDAD</th>
</tr></thead>
<tbody><tr>
<td align="center"><?php echo $nombres_cli.' '.$apellido1_cli ?></td>
<td align="center"><?php echo $nombre_tipo_doc ?></td>
<td align="center"><?php echo $cedula ?></td>
<td align="center"><?php echo $nombre_sexo ?></td>
<td align="center"><?php echo $edad_anyo ?></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">FECHA DE NACIMIENTO</th>
<th bgcolor="#FAC090">LUGAR DE NACIMIENTO</th>
<th bgcolor="#FAC090">DIRECCIÓN DE RESIDENCIA</th>
<th bgcolor="#FAC090">ESTADO CIVIL</th>
<th bgcolor="#FAC090">Nº HIJOS</th>
</tr></thead>
<tbody><tr>
<td align="center"><?php echo $fecha_nac_ymd ?></td>
<td align="center"><?php echo $lugar_nac ?></td>
<td align="center"><?php echo $lugar_residencia ?></td>
<td align="center"><?php echo $nombre_estado_civil ?></td>
<td align="center"><?php echo $nombre_numero_hijos ?></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">TELÉFONO FIJO O CELULAR</th>
<th bgcolor="#FAC090">NIVEL EDUCATIVO</th>
<th bgcolor="#FAC090">NOMBRE EPS</th>
<th bgcolor="#FAC090">TIPO DE RÉGIMEN</th>
<th bgcolor="#FAC090">FONDO DE PENSIONES</th>
<th bgcolor="#FAC090">ARL</th>
</tr></thead>
<tbody><tr>
<td align="center"><?php echo $tel_cliente ?></td>
<td align="center"><?php echo $nombre_escolaridad ?></td>
<td align="center"><?php echo $nombre_entidad ?></td>
<td align="center"><?php echo $nombre_tipo_regimen ?></td>
<td align="center"><?php echo $nombre_fondo_pension ?></td>
<td align="center"><?php echo $nombre_arl ?></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle">DATOS DE CONTACTO EN CASO DE EMERGENCIA</th></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">Nombre</th>
<th bgcolor="#FAC090">Dirección</th>
<th bgcolor="#FAC090">Parentesco</th>
<th bgcolor="#FAC090">Teléfono</th>
</tr></thead>
<tbody><tr>
<td align="center"><?php echo $nombre_contacto1 ?></td>
<td align="center"><?php echo $direccion_contacto1 ?></td>
<td align="center"><?php echo $parentesco_contacto1 ?></td>
<td align="center"><?php echo $tel_contacto1 ?></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead>
<tr>
<td style="text-align:center" bgcolor="#FAC090"><strong>TIPO DE EXAMEN A REALIZAR O EVALUACIÓN</strong></td>
<td style="text-align:center" bgcolor="#FAC090"><strong>COSTO EVALUACIÓN</strong></td>
</tr>
<tr>
<td style="text-align:center"><?php echo $motivo ?></td>
<td style="text-align:center"><?php echo $costo_motivo_consulta ?></td>
</tr>

</thead>
<tbody></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" class="table table-responsive" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
    	<th style="text-align:center">FECHA Y HORA:	<?php echo $fecha_y_hora_registro ?></th>
</td></tr></thead><tbody></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">EMPRESA CONTRATANTE</th>
<th bgcolor="#FAC090">EMPRESA A LABORAR</th>
<th bgcolor="#FAC090">ACTIVIDAD ECONÓMICA DE LA EMPRESA</th>
</tr></thead>
<tbody><tr>

<td style="text-align:center"><?php echo $nombre_empresa_contratante ?></td>

<td style="text-align:center"><?php echo $nombre_empresa ?></td>

<td style="text-align:center"><?php echo $nombre_actividad_ecoemp ?></td>
</tr></tbody>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">AREA A LABORAR Y CARGO</th>
<!--<th style="text-align:center">Area a Laborar</th>-->
<th bgcolor="#FAC090">CIUDAD</th>
</tr></thead>
<tbody><tr>
<!--<td align="center"><?php echo $cargo_empresa ?></td>-->
<td style="text-align:center"><?php echo $nombre_grupo_area_cargo ?></td>
<!--<td><input class="input-block-level" name="cargo_empresa" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $cargo_empresa ?>" /></td>-->
<!--<td style="text-align:center"><input class="input-block-level" name="area_empresa" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $area_empresa ?>" /></td>-->
<td style="text-align:center"><?php echo $ciudad_empresa ?></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><strong>Medico</strong>
    <div><img src="<?php echo $propietario_url_firma_emp ?>" height="90px"/></div>
    <div>_________________________________________ </div>
    <strong><?php echo $nombres_prof.' '.$apellidos_prof ?></strong>
    <br />
    <strong>Reg. Medico <?php echo $reg_medico_emp ?></strong>
    <br />
    <strong>Licencia Salud Ocupacional <?php echo $licencia_emp ?></strong> </td>
    <td width="387" valign="top"><strong>Paciente</strong>
    <div><img src="<?php echo $url_img_firma_min_cli ?>" height="90px"/></div>
    <div>_________________________________________ </div>
    <strong><?php echo $nombres_cli.' '.$apellido1_cli ?></strong><br />
    <strong>C.C <?php echo $cedula ?></strong> </td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>
<script type="text/javascript">$('#fecha_nac_ymd').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>

<script src="js/funcion_select_dependiente_area_cargo_ajax.js"></script>

<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../js/jquery-ui.js"></script>
<!--
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
-->
<!-- 1****************************************************************************************************** -->
</body>
</html>