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
<!--</head>
<body id="pageBody">-->

<script language="javascript" src="../admin/class_php/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_cie10_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); 
$pagina_local = $_SERVER['PHP_SELF'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy                    = date("Y/m/d");
$fecha_hoy_time               = strtotime(date("Y/m/d"));
$cod_historia_clinica         = intval($_GET['cod_historia_clinica']);
$cod_cliente                  = intval($_GET['cod_cliente']);
$pagina_local                 = $_SERVER['PHP_SELF'];
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = ''; }

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
tbl15_historia_clinica.dat_ocupa_cabeza1, tbl15_historia_clinica.dat_ocupa_manos1, tbl15_historia_clinica.dat_ocupa_tronco1, 
tbl15_historia_clinica.dat_ocupa_pies1, tbl15_historia_clinica.dat_ocupa_cabeza2, tbl15_historia_clinica.dat_ocupa_manos2, 
tbl15_historia_clinica.dat_ocupa_tronco2, tbl15_historia_clinica.dat_ocupa_pies2, tbl15_historia_clinica.dat_ocupa_cabeza3, 
tbl15_historia_clinica.dat_ocupa_manos3, tbl15_historia_clinica.dat_ocupa_tronco3, tbl15_historia_clinica.dat_ocupa_pies3, 
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
tbl15_historia_clinica.exa_fis_pielfanera_obser, tbl15_historia_clinica.exaosteo_homb_movart, tbl15_historia_clinica.exaosteo_homb_fuerza, 
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
tbl15_cliente.lugar_procedencia, tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.ant_fam_asma_pad, tbl15_historia_clinica.ant_fam_asma_mad, tbl15_historia_clinica.ant_fam_asma_herm, 
tbl15_historia_clinica.ant_fam_asma_otro, tbl15_historia_clinica.ant_fam_asma_otro_cual, tbl15_historia_clinica.habit_tox_toxicomania, 
tbl15_historia_clinica.ant_pato_convulsion, tbl15_historia_clinica.ant_pato_claustrofobia, tbl15_historia_clinica.ant_pato_dificuloler, 
tbl15_historia_clinica.ant_pato_cardiopatia, tbl15_historia_clinica.ant_pato_lentes, tbl15_historia_clinica.ant_pato_dificuldistincolor, 
tbl15_historia_clinica.exa_fis_sistemmusculesquelet, tbl15_historia_clinica.exa_fis_sistemmusculesquelet_observ, 
tbl15_historia_clinica.clasrieg_segur1_sismo, tbl15_historia_clinica.clasrieg_segur1_delincuenciacomun, 
tbl15_historia_clinica.clasrieg_segur1_accitransito, tbl15_historia_clinica.clasrieg_segur1_caidaobjetos, 
tbl15_historia_clinica.clasrieg_segur1_puestotrabdesorden, tbl15_historia_clinica.clasrieg_segur2_sismo, 
tbl15_historia_clinica.clasrieg_segur2_delincuenciacomun, tbl15_historia_clinica.clasrieg_segur2_accitransito, 
tbl15_historia_clinica.clasrieg_segur2_caidaobjetos, tbl15_historia_clinica.clasrieg_segur2_puestotrabdesorden, 
tbl15_historia_clinica.clasrieg_segur3_sismo, tbl15_historia_clinica.clasrieg_segur3_delincuenciacomun, 
tbl15_historia_clinica.clasrieg_segur3_accitransito, tbl15_historia_clinica.clasrieg_segur3_caidaobjetos, 
tbl15_historia_clinica.clasrieg_segur3_puestotrabdesorden,
tbl15_historia_clinica.sintoma_covid19_todo,
tbl15_historia_clinica.sintoma_covid19,
tbl15_historia_clinica.covid19_fiebre,
tbl15_historia_clinica.covid19_escolofrio,
tbl15_historia_clinica.covid19_cansansio,
tbl15_historia_clinica.covid19_malestar_gral,
tbl15_historia_clinica.covid19_fatiga,
tbl15_historia_clinica.covid19_tos_seca,
tbl15_historia_clinica.covid19_cefaleas,
tbl15_historia_clinica.covid19_congestion_nasal,
tbl15_historia_clinica.covid19_secrecion_nasal,
tbl15_historia_clinica.covid19_dorlor_garganta,
tbl15_historia_clinica.covid19_diarrea,
tbl15_historia_clinica.covid19_dificul_resp,
tbl15_historia_clinica.covid19_inapetencia,
tbl15_historia_clinica.covid19_perdida_olfato,
tbl15_historia_clinica.covid19_perdida_gusto,
tbl15_historia_clinica.covid19_dedos_covid,
tbl15_historia_clinica.covid19_dolor_pecho,
tbl15_historia_clinica.covid19_confusion,
tbl15_historia_clinica.covid19_color_azul_labios,
tbl15_historia_clinica.habit_tox_medicamento,
tbl15_historia_clinica.habit_tox_horasueno,
tbl15_historia_clinica.ant_gine_problem_mamario,
tbl15_historia_clinica.ant_gine_problem_ginecol,
tbl15_historia_clinica.ant_gine_cree_estar_embarazada,
tbl15_historia_clinica.ant_pato_enf_hepaticas,
tbl15_historia_clinica.ant_pato_transplates,
tbl15_historia_clinica.ant_pato_obesidad_morbida,
tbl15_historia_clinica.ant_pato_hereditarios,
tbl15_historia_clinica.ant_pato_enf_infaltil,
tbl15_historia_clinica.ant_pato_enf_dental,
tbl15_historia_clinica.ant_pato_enf_corazon,
tbl15_historia_clinica.ant_pato_enf_renal,
tbl15_historia_clinica.exa_fis_sto2, 
tbl15_historia_clinica.covid19_artralgia, 
tbl15_historia_clinica.covid19_artralgia_valor, 
tbl15_historia_clinica.covid19_mialgia, 
tbl15_historia_clinica.covid19_mialgia_valor, 
tbl15_historia_clinica.covid19_astenia, 
tbl15_historia_clinica.covid19_astenia_valor, 
tbl15_historia_clinica.covid19_odinofagia, 
tbl15_historia_clinica.covid19_odinofagia_valor, 
tbl15_historia_clinica.covid19_irritacion_ardor_ojos, 
tbl15_historia_clinica.covid19_irritacion_ardor_ojos_valor, 
tbl15_historia_clinica.covid19_nauseas, 
tbl15_historia_clinica.covid19_nauseas_valor, 
tbl15_historia_clinica.covid19_contacto_person_sospech_covid, 
tbl15_historia_clinica.covid19_contacto_person_sospech_covid_valor, 
tbl15_historia_clinica.nombre_tiempo_molestia_actual_covid, 
tbl15_historia_clinica.valor_tiempo_molestia_actual_covid, 
tbl15_historia_clinica.nombre_temperatura_covid, 
tbl15_historia_clinica.valor_temperatura_covid, 
tbl15_historia_clinica.nombre_pulso_covid, 
tbl15_historia_clinica.valor_pulso_covid, 
tbl15_historia_clinica.nombre_saturacion_covid, 
tbl15_historia_clinica.valor_saturacion_covid
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
//$edad_anyo          = $info_historia_clinica['edad_anyo'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$nombre_grupo_rh              = $info_historia_clinica['nombre_grupo_rh'];
$tel_cliente_hist             = $info_historia_clinica['tel_cliente_hist'];
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
$nombre_laboratorio           = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento           = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento      = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica     = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica = $info_historia_clinica['descripcion_ayuda_diagnostica'];
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
$cargo_empresa                = $info_historia_clinica['cargo_empresa'];
$area_empresa                 = $info_historia_clinica['area_empresa'];
$ciudad_empresa               = $info_historia_clinica['ciudad_empresa'];
$direccion_contacto1          = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2          = $info_historia_clinica['direccion_contacto2'];
$direccion_contacto2          = $info_historia_clinica['direccion_contacto2'];
//$cod_administrador = $info_historia_clinica['cod_administrador'];
$motivo                       = $info_historia_clinica['motivo'];
$cod_grupo_area               = $info_historia_clinica['cod_grupo_area'];
$cod_grupo_area_cargo         = $info_historia_clinica['cod_grupo_area_cargo'];
$dat_ocupa_emp1               = $info_historia_clinica['dat_ocupa_emp1'];
$dat_ocupa_carg1              = $info_historia_clinica['dat_ocupa_carg1'];
$dat_ocupa_visu1              = $info_historia_clinica['dat_ocupa_visu1'];
$dat_ocupa_audi1              = $info_historia_clinica['dat_ocupa_audi1'];
$dat_ocupa_altu1              = $info_historia_clinica['dat_ocupa_altu1'];
$dat_ocupa_resp1              = $info_historia_clinica['dat_ocupa_resp1'];
$dat_ocupa_cabeza1            = $info_historia_clinica['dat_ocupa_cabeza1'];
$dat_ocupa_manos1             = $info_historia_clinica['dat_ocupa_manos1'];
$dat_ocupa_tronco1            = $info_historia_clinica['dat_ocupa_tronco1'];
$dat_ocupa_pies1              = $info_historia_clinica['dat_ocupa_pies1'];
$dat_ocupa_fech_ini1          = $info_historia_clinica['dat_ocupa_fech_ini1'];
$dat_ocupa_dura_anyo1         = $info_historia_clinica['dat_ocupa_dura_anyo1'];
$dat_ocupa_emp2               = $info_historia_clinica['dat_ocupa_emp2'];
$dat_ocupa_carg2              = $info_historia_clinica['dat_ocupa_carg2'];
$dat_ocupa_visu2              = $info_historia_clinica['dat_ocupa_visu2'];
$dat_ocupa_audi2              = $info_historia_clinica['dat_ocupa_audi2'];
$dat_ocupa_altu2              = $info_historia_clinica['dat_ocupa_altu2'];
$dat_ocupa_resp2              = $info_historia_clinica['dat_ocupa_resp2'];
$dat_ocupa_cabeza2            = $info_historia_clinica['dat_ocupa_cabeza2'];
$dat_ocupa_manos2             = $info_historia_clinica['dat_ocupa_manos2'];
$dat_ocupa_tronco2            = $info_historia_clinica['dat_ocupa_tronco2'];
$dat_ocupa_pies2              = $info_historia_clinica['dat_ocupa_pies2'];
$dat_ocupa_fech_ini2          = $info_historia_clinica['dat_ocupa_fech_ini2'];
$dat_ocupa_dura_anyo2         = $info_historia_clinica['dat_ocupa_dura_anyo2'];
$dat_ocupa_emp3               = $info_historia_clinica['dat_ocupa_emp3'];
$dat_ocupa_carg3              = $info_historia_clinica['dat_ocupa_carg3'];
$dat_ocupa_visu3              = $info_historia_clinica['dat_ocupa_visu3'];
$dat_ocupa_audi3              = $info_historia_clinica['dat_ocupa_audi3'];
$dat_ocupa_altu3              = $info_historia_clinica['dat_ocupa_altu3'];
$dat_ocupa_resp3              = $info_historia_clinica['dat_ocupa_resp3'];
$dat_ocupa_cabeza3            = $info_historia_clinica['dat_ocupa_cabeza3'];
$dat_ocupa_manos3             = $info_historia_clinica['dat_ocupa_manos3'];
$dat_ocupa_tronco3            = $info_historia_clinica['dat_ocupa_tronco3'];
$dat_ocupa_pies3              = $info_historia_clinica['dat_ocupa_pies3'];
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

$ant_fam_asma_pad            = $info_historia_clinica['ant_fam_asma_pad'];
$ant_fam_asma_mad            = $info_historia_clinica['ant_fam_asma_mad'];
$ant_fam_asma_herm           = $info_historia_clinica['ant_fam_asma_herm'];
$ant_fam_asma_otro           = $info_historia_clinica['ant_fam_asma_otro'];
$ant_fam_asma_otro_cual      = $info_historia_clinica['ant_fam_asma_otro_cual'];
$habit_tox_toxicomania       = $info_historia_clinica['habit_tox_toxicomania'];
$ant_pato_convulsion         = $info_historia_clinica['ant_pato_convulsion'];
$ant_pato_claustrofobia      = $info_historia_clinica['ant_pato_claustrofobia'];
$ant_pato_dificuloler        = $info_historia_clinica['ant_pato_dificuloler'];
$ant_pato_cardiopatia        = $info_historia_clinica['ant_pato_cardiopatia'];
$ant_pato_lentes             = $info_historia_clinica['ant_pato_lentes'];
$ant_pato_dificuldistincolor = $info_historia_clinica['ant_pato_dificuldistincolor'];
$exa_fis_sistemmusculesquelet             = $info_historia_clinica['exa_fis_sistemmusculesquelet'];
$exa_fis_sistemmusculesquelet_observ      = $info_historia_clinica['exa_fis_sistemmusculesquelet_observ'];

$clasrieg_segur1_sismo                 = $info_historia_clinica['clasrieg_segur1_sismo'];
$clasrieg_segur1_delincuenciacomun     = $info_historia_clinica['clasrieg_segur1_delincuenciacomun'];
$clasrieg_segur1_accitransito          = $info_historia_clinica['clasrieg_segur1_accitransito'];
$clasrieg_segur1_caidaobjetos          = $info_historia_clinica['clasrieg_segur1_caidaobjetos'];
$clasrieg_segur1_puestotrabdesorden    = $info_historia_clinica['clasrieg_segur1_puestotrabdesorden'];
$clasrieg_segur2_sismo                 = $info_historia_clinica['clasrieg_segur2_sismo'];
$clasrieg_segur2_delincuenciacomun     = $info_historia_clinica['clasrieg_segur2_delincuenciacomun'];
$clasrieg_segur2_accitransito          = $info_historia_clinica['clasrieg_segur2_accitransito'];
$clasrieg_segur2_caidaobjetos          = $info_historia_clinica['clasrieg_segur2_caidaobjetos'];
$clasrieg_segur2_puestotrabdesorden    = $info_historia_clinica['clasrieg_segur2_puestotrabdesorden'];
$clasrieg_segur3_sismo                 = $info_historia_clinica['clasrieg_segur3_sismo'];
$clasrieg_segur3_delincuenciacomun     = $info_historia_clinica['clasrieg_segur3_delincuenciacomun'];
$clasrieg_segur3_accitransito          = $info_historia_clinica['clasrieg_segur3_accitransito'];
$clasrieg_segur3_caidaobjetos          = $info_historia_clinica['clasrieg_segur3_caidaobjetos'];
$clasrieg_segur3_puestotrabdesorden    = $info_historia_clinica['clasrieg_segur3_puestotrabdesorden'];
$sintoma_covid19_todo                  = $info_historia_clinica['sintoma_covid19_todo'];
$sintoma_covid19                       = $info_historia_clinica['sintoma_covid19'];
$covid19_fiebre                        = $info_historia_clinica['covid19_fiebre'];
$covid19_escolofrio                    = $info_historia_clinica['covid19_escolofrio'];
$covid19_cansansio                     = $info_historia_clinica['covid19_cansansio'];
$covid19_malestar_gral                 = $info_historia_clinica['covid19_malestar_gral'];
$covid19_fatiga                        = $info_historia_clinica['covid19_fatiga'];
$covid19_tos_seca                      = $info_historia_clinica['covid19_tos_seca'];
$covid19_cefaleas                      = $info_historia_clinica['covid19_cefaleas'];
$covid19_congestion_nasal              = $info_historia_clinica['covid19_congestion_nasal'];
$covid19_secrecion_nasal               = $info_historia_clinica['covid19_secrecion_nasal'];
$covid19_dorlor_garganta               = $info_historia_clinica['covid19_dorlor_garganta'];
$covid19_diarrea                       = $info_historia_clinica['covid19_diarrea'];
$covid19_dificul_resp                  = $info_historia_clinica['covid19_dificul_resp'];
$covid19_inapetencia                   = $info_historia_clinica['covid19_inapetencia'];
$covid19_perdida_olfato                = $info_historia_clinica['covid19_perdida_olfato'];
$covid19_perdida_gusto                 = $info_historia_clinica['covid19_perdida_gusto'];
$covid19_dedos_covid                   = $info_historia_clinica['covid19_dedos_covid'];
$covid19_dolor_pecho                   = $info_historia_clinica['covid19_dolor_pecho'];
$covid19_confusion                     = $info_historia_clinica['covid19_confusion'];
$covid19_color_azul_labios             = $info_historia_clinica['covid19_color_azul_labios'];

$habit_tox_medicamento                 = $info_historia_clinica['habit_tox_medicamento'];
$habit_tox_horasueno                   = $info_historia_clinica['habit_tox_horasueno'];
$ant_gine_problem_mamario              = $info_historia_clinica['ant_gine_problem_mamario'];
$ant_gine_problem_ginecol              = $info_historia_clinica['ant_gine_problem_ginecol'];
$ant_gine_cree_estar_embarazada        = $info_historia_clinica['ant_gine_cree_estar_embarazada'];
$ant_pato_enf_hepaticas                = $info_historia_clinica['ant_pato_enf_hepaticas'];
$ant_pato_transplates                  = $info_historia_clinica['ant_pato_transplates'];
$ant_pato_obesidad_morbida             = $info_historia_clinica['ant_pato_obesidad_morbida'];
$ant_pato_hereditarios                 = $info_historia_clinica['ant_pato_hereditarios'];
$ant_pato_enf_infaltil                 = $info_historia_clinica['ant_pato_enf_infaltil'];
$ant_pato_enf_dental                   = $info_historia_clinica['ant_pato_enf_dental'];
$ant_pato_enf_corazon                  = $info_historia_clinica['ant_pato_enf_corazon'];
$ant_pato_enf_renal                    = $info_historia_clinica['ant_pato_enf_renal'];
$exa_fis_sto2                          = $info_historia_clinica['exa_fis_sto2'];

$covid19_artralgia                     = $info_historia_clinica['covid19_artralgia'];
$covid19_artralgia_valor               = $info_historia_clinica['covid19_artralgia_valor'];
$covid19_mialgia                       = $info_historia_clinica['covid19_mialgia'];
$covid19_mialgia_valor                 = $info_historia_clinica['covid19_mialgia_valor'];
$covid19_astenia                       = $info_historia_clinica['covid19_astenia'];
$covid19_astenia_valor                 = $info_historia_clinica['covid19_astenia_valor'];
$covid19_odinofagia                    = $info_historia_clinica['covid19_odinofagia'];
$covid19_odinofagia_valor              = $info_historia_clinica['covid19_odinofagia_valor'];
$covid19_irritacion_ardor_ojos         = $info_historia_clinica['covid19_irritacion_ardor_ojos'];
$covid19_irritacion_ardor_ojos_valor   = $info_historia_clinica['covid19_irritacion_ardor_ojos_valor'];
$covid19_nauseas                       = $info_historia_clinica['covid19_nauseas'];
$covid19_nauseas_valor                 = $info_historia_clinica['covid19_nauseas_valor'];
$covid19_contacto_person_sospech_covid = $info_historia_clinica['covid19_contacto_person_sospech_covid'];
$covid19_contacto_person_sospech_covid_valor = $info_historia_clinica['covid19_contacto_person_sospech_covid_valor'];
$nombre_tiempo_molestia_actual_covid   = $info_historia_clinica['nombre_tiempo_molestia_actual_covid'];
$valor_tiempo_molestia_actual_covid    = $info_historia_clinica['valor_tiempo_molestia_actual_covid'];
$nombre_temperatura_covid              = $info_historia_clinica['nombre_temperatura_covid'];
$valor_temperatura_covid               = $info_historia_clinica['valor_temperatura_covid'];
$nombre_pulso_covid                    = $info_historia_clinica['nombre_pulso_covid'];
$valor_pulso_covid                     = $info_historia_clinica['valor_pulso_covid'];
$nombre_tbl15_saturacion_covid              = $info_historia_clinica['nombre_saturacion_covid'];
$valor_tbl15_saturacion_covid               = $info_historia_clinica['valor_saturacion_covid'];
?>
<form name="formulario_edicion" id="formulario_edicion" class="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_historia_clinica_mejorada_reg.php">
 <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<tbody>
<!--<tr><th>HISTORIA CLINICA No.</th><td style="text-align:center"><?php echo $cod_historia_clinica ?></td></tr>-->
<tr><th bgcolor="#FAC090">FECHA HISTORIA</th><td bgcolor="#FAC090" align="center"><?php echo $fecha_hisroria_clinica ?></td><td bgcolor="#FAC090" align="center">HC - <?php echo $cod_historia_clinica ?></td></tr>

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
<th bgcolor="#FAC090">TIPO DE IDENTIFICACIÓN</th>
<th bgcolor="#FAC090">IDENTIFICACIÓN</th>
<th bgcolor="#FAC090">NOMBRES</th>
<th bgcolor="#FAC090">APELLIDOS</th>
<th bgcolor="#FAC090">SEXO</th>
<th bgcolor="#FAC090">FECHA DE NACIMIENTO</th>
<th bgcolor="#FAC090">EDAD</th>
</tr></thead>
<tbody><tr>
<td style="text-align:center"><input class="input-block-level" name="nombre_tipo_doc" type="text" value="<?php echo $nombre_tipo_doc ?>" maxlength="3" required/></td>
<td style="text-align:center"><input class="input-block-level" name="cedula" type="number" value="<?php echo $cedula ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="nombres" type="text" value="<?php echo $nombres_cli ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="apellido1" type="text" value="<?php echo $apellido1_cli ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_sexo" type="text" value="<?php echo $nombre_sexo ?>" maxlength="1" required/></td>
<td style="text-align:center"><div id="fecha_nac_ymd" class="input-append date"><input type="text" name="fecha_nac_ymd" value="<?php echo $fecha_nac_ymd ?>" readonly></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td>
<td style="text-align:center"><?php echo $edad_anyo ?></td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">LUGAR DE NACIMIENTO</th>
<th bgcolor="#FAC090">DIRRECIÓN DE RESIDENCIA</th>
<th bgcolor="#FAC090">ESTADO CIVIL</th>
<th bgcolor="#FAC090">NIVEL EDUCATIVO</th>
<th bgcolor="#FAC090">TELEFONO Y/O CELULAR</th>
<th bgcolor="#FAC090">Nº HIJOS</th></tr></thead>
<tbody><tr>
<td style="text-align:center"><input class="input-block-level" name="lugar_nac" type="text" value="<?php echo $lugar_nac ?>"/></td>
<td style="text-align:center"><input class="input-block-level" name="lugar_procedencia" type="text" value="<?php echo $lugar_procedencia ?>" /></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_estado_civil" type="text" value="<?php echo $nombre_estado_civil ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_escolaridad" type="text" value="<?php echo $nombre_escolaridad ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="tel_cliente" type="tel" value="<?php echo $tel_cliente_cli ?>" /></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_numero_hijos" type="number" value="<?php echo $nombre_numero_hijos ?>" maxlength="2" required /></td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr><th bgcolor="#FAC090">EPS</th><th bgcolor="#FAC090">TIPO RÉGIMEN</th><th bgcolor="#FAC090">FONDO DE PENSIONES</th><th bgcolor="#FAC090">ARL</th></tr></thead>
<tbody><tr>

<td style="text-align:center"><select name="cod_entidad" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_entidad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_entidad, nombre_entidad FROM tbl15_entidad ORDER BY nombre_entidad ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_entidad) and $cod_entidad == $datos2['cod_entidad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_entidad'];
$nombre = $datos2['nombre_entidad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td style="text-align:center"><input class="input-block-level" name="nombre_tipo_regimen" type="text" value="<?php echo $nombre_tipo_regimen ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_fondo_pension" type="text" value="<?php echo $nombre_fondo_pension ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_arl" type="text" value="<?php echo $nombre_arl ?>" required/></td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle">DATOS DE CONTACTO EN CASO DE EMERGENCIA</th></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">NOMBRES COMPLETOS RESPONSABLE</th>
<th bgcolor="#FAC090">PARENTESCO</th>
<th bgcolor="#FAC090">DIRRECIÓN</th>
<th bgcolor="#FAC090">TELEFONO Y/O CELULAR</th>
</tr></thead>
<tbody><tr>
<td style="text-align:center"><input class="input-block-level" name="nombre_contacto1" type="text" value="<?php echo $nombre_contacto1 ?>" /></td>
<td style="text-align:center"><input class="input-block-level" name="parentesco_contacto1" type="text" value="<?php echo $parentesco_contacto1 ?>" /></td>
<td style="text-align:center"><input class="input-block-level" name="direccion_contacto1" type="text" value="<?php echo $direccion_contacto1 ?>" /></td>
<td style="text-align:center"><input class="input-block-level" name="tel_contacto1" type="text" value="<?php echo $tel_contacto1 ?>" /></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead>
<tr>
<td style="text-align:center" bgcolor="#FAC090"><strong>TIPO DE EXAMEN A REALIZAR O EVALUACIÓN</strong></td>
<td style="text-align:center" bgcolor="#FAC090"><strong>COSTO EVALUACIÓN</strong></td>
<td style="text-align:center" bgcolor="#FAC090"><strong>FACTURA</strong></td>
</tr>
<tr>
<td style="text-align:center">
<select name="motivo" required>
<?php if (isset($motivo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_motivo_consulta, motivo FROM tbl15_motivo_consulta ORDER BY motivo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($motivo) and $motivo == $datos2['motivo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['motivo'];
$nombre = $datos2['motivo'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="costo_motivo_consulta" type="number" value="<?php echo $costo_motivo_consulta ?>" required/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="cod_factura" type="number" value="<?php echo $cod_factura ?>" required/></td>
</tr>
</thead>
<tbody></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" class="table table-responsive" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
    	<th style="text-align:center">FECHA Y HORA:
    	<div id="fecha_ymd_hora" class="input-append date"><input type="text" name="fecha_ymd_hora" value="<?php echo $fecha_ymd_hora ?>" required></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></th>
</td></tr></thead><tbody></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr>
<th style="text-align:center">EMPRESA CONTRATANTE</th>
<th style="text-align:center">EMPRESA A LABORAR</th>
<th style="text-align:center">ACTIVIDAD ECONÓMICA DE LA EMPRESA</th>
</tr></thead>
<tbody><tr>

<td style="text-align:center"><select name="nombre_empresa_contratante" required>
<?php if (isset($nombre_empresa_contratante)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa_contratante, nombre_empresa_contratante FROM tbl15_empresa_contratante ORDER BY nombre_empresa_contratante ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa_contratante) and $nombre_empresa_contratante == $datos2['nombre_empresa_contratante']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa_contratante'];
$nombre = $datos2['nombre_empresa_contratante'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td style="text-align:center"><select id="nombre_empresa" name="nombre_empresa" onChange="conocer_empresa_laborar();" required>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) and $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td style="text-align:center"><select name="nombre_actividad_ecoemp" required>
<?php if (isset($nombre_actividad_ecoemp)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_actividad_ecoemp, nombre_actividad_ecoemp FROM tbl15_actividad_ecoemp ORDER BY nombre_actividad_ecoemp ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_actividad_ecoemp) and $nombre_actividad_ecoemp == $datos2['nombre_actividad_ecoemp']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_actividad_ecoemp'];
$nombre = $datos2['nombre_actividad_ecoemp'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

</tr></tbody>
</table>

<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr>
<th style="text-align:center">AREA A LABORAR Y CARGO</th>
<!--<th style="text-align:center">Area a Laborar</th>-->
<th style="text-align:center">CIUDAD</th>
</tr></thead>
<tbody><tr>

<td style="text-align:center"><input style="text-align:center" name="cod_grupo_area_cargo" id="cod_grupo_area_cargo" class="cod_grupo_area_cargo" onChange="conocer_cargo();" type="text" value="<?php echo $cod_grupo_area_cargo ?>" required/></td>
<!--<td><input class="input-block-level" name="cargo_empresa" type="text" value="<?php echo $cargo_empresa ?>" /></td>-->
<!--<td style="text-align:center"><input class="input-block-level" name="area_empresa" type="text" value="<?php echo $area_empresa ?>" /></td>-->
<td style="text-align:center"><input class="input-block-level" name="ciudad_empresa" type="text" value="<?php echo $ciudad_empresa ?>" /></td>
</tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">2. DATOS OCUPACIONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.1. Historia Laboral</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td rowspan="2" style="text-align:center"><strong>Empresa nombre comercial</strong><br />ACTUAL (1) ANTERIORES (2 Y 3)</td>
            <td rowspan="2" style="text-align:center"><strong>Cargo</strong> </td>
            <td colspan="8" style="text-align:center"><strong>Elementos de protección personal</strong></td>
            <td rowspan="2" style="text-align:center"><strong>Fecha inicio</strong></td>
            <td rowspan="2" style="text-align:center"><strong>Duración (Años)</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>Visual</strong></td>
            <td style="text-align:center"><strong>Auditivo</strong></td>
            <td style="text-align:center"><strong>Alturas</strong></td>
            <td style="text-align:center"><strong>Respiratorios</strong></td>
            <td style="text-align:center"><strong>Cabeza</strong></td>
            <td style="text-align:center"><strong>Manos</strong></td>
            <td style="text-align:center"><strong>Tronco</strong></td>
            <td style="text-align:center"><strong>Pies</strong></td>
        </tr>
        <tr>
<td style="text-align:center"><select id="dat_ocupa_emp1" name="dat_ocupa_emp1" disabled>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) and $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>
<!--<td><input style="text-align:center" class="input-block-level" name="dat_ocupa_emp1" type="text" value="<?php echo $nombre_empresa ?>"/></td>-->

<td style="text-align:center"><select name="dat_ocupa_carg1" id="dat_ocupa_carg1" disabled>
 <?php if (isset($cod_grupo_area_cargo)) { echo "<option value='0' >Selecione</option>";
 } else { echo  "<option value='0' selected >Seleccione</option>"; }
$consulta2_sql = ("SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area.nombre_grupo, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, 
tbl15_grupo_area_cargo.cod_grupo_area_cargo, tbl15_grupo_area.cod_grupo_area 
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area ORDER BY nombre_grupo_area ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_grupo_area_cargo) AND ($cod_grupo_area_cargo == $datos2['cod_grupo_area_cargo'])) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_grupo_area_cargo'];
$nombre = $datos2['nombre_grupo_area_cargo'];
$nombre2 = $datos2['nombre_grupo_area'];
 echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
 </select></td>
<!--<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_carg1" type="text" value="<?php echo $dat_ocupa_carg1 ?>"/></td>-->
<td style="text-align:center"><input name="dat_ocupa_visu1" class="dat_ocupa_visu1" id="dat_ocupa_visu1" type="checkbox" value="S" <? if($dat_ocupa_visu1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_audi1" class="dat_ocupa_audi1" id="dat_ocupa_audi1" type="checkbox" value="S" <? if($dat_ocupa_audi1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_altu1" class="dat_ocupa_altu1" id="dat_ocupa_altu1" type="checkbox" value="S" <? if($dat_ocupa_altu1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_resp1" class="dat_ocupa_resp1" id="dat_ocupa_resp1" type="checkbox" value="S" <? if($dat_ocupa_resp1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_cabeza1" class="dat_ocupa_cabeza1" id="dat_ocupa_cabeza1" type="checkbox" value="S" <? if($dat_ocupa_cabeza1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_manos1" class="dat_ocupa_manos1" id="dat_ocupa_manos1" type="checkbox" value="S" <? if($dat_ocupa_manos1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_tronco1" class="dat_ocupa_tronco1" id="dat_ocupa_tronco1" type="checkbox" value="S" <? if($dat_ocupa_tronco1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_pies1" class="dat_ocupa_pies1" id="dat_ocupa_pies1" type="checkbox" value="S" <? if($dat_ocupa_pies1=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_fech_ini1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_fech_ini1 ?>"/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_dura_anyo1" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $dat_ocupa_dura_anyo1 ?>"/></td>
</tr>
<tr>
<td><input style="text-align:center" class="input-block-level" name="dat_ocupa_emp2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_emp2 ?>"/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_carg2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_carg2 ?>"/></td>
<td style="text-align:center"><input name="dat_ocupa_visu2" class="dat_ocupa_visu2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_visu2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_audi2" class="dat_ocupa_audi2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_audi2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_altu2" class="dat_ocupa_altu2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_altu2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_resp2" class="dat_ocupa_resp2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_resp2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_cabeza2" class="dat_ocupa_cabeza2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_cabeza2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_manos2" class="dat_ocupa_manos2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_manos2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_tronco2" class="dat_ocupa_tronco2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_tronco2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_pies2" class="dat_ocupa_pies2" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_pies2=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_fech_ini2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_fech_ini2 ?>"/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_dura_anyo2" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $dat_ocupa_dura_anyo2 ?>"/></td>
</tr>
<tr>
<td><input style="text-align:center" class="input-block-level" name="dat_ocupa_emp3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_emp3 ?>"/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_carg3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_carg3 ?>"/></td>
<td style="text-align:center"><input name="dat_ocupa_visu3" class="dat_ocupa_visu3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_visu3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_audi3" class="dat_ocupa_audi3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_audi3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_altu3" class="dat_ocupa_altu3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_altu3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_resp3" class="dat_ocupa_resp3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_resp3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_cabeza3" class="dat_ocupa_cabeza3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_cabeza3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_manos3" class="dat_ocupa_manos3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_manos3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_tronco3" class="dat_ocupa_tronco3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_tronco3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input name="dat_ocupa_pies3" class="dat_ocupa_pies3" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="S" <? if($dat_ocupa_pies3=='S'){ echo "checked"; } ?>></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_fech_ini3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_fech_ini3 ?>"/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_dura_anyo3" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $dat_ocupa_dura_anyo3 ?>"/></td>
</tr>
<tr>
<td colspan="8"><strong>Observaciones: <input class="input-block-level" name="dat_ocupa_observacion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $dat_ocupa_observacion ?>"/></strong></td>
</tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>2.2. Clasificación de riesgos</strong></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td style="text-align:center" colspan="6" bgcolor="#95B3D7"><strong>FÍSICOS</strong></td>
            <td style="text-align:center" colspan="4" bgcolor="#B6DDE8"><strong>QUÍMICOS</strong></td>
            <td style="text-align:center" colspan="6" bgcolor="#C5BE97"><strong>BIOLÓGICO</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#B2A1C7"><strong>ERGONÓMICOS</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#E6B9B8"><strong>PSICOSOCIALES</strong></td>
            <td style="text-align:center" colspan="8" bgcolor="#FAC090"><strong>SEGURIDAD</strong></td>
            <td style="text-align:center" colspan="3" bgcolor="#FF6666"><strong>OBSERVACIONES</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>EMPRESA</strong></td>
            <td><img src="../imagenes/img_riesgos/01.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/02.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/03.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/04.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/05.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/06.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/07.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/08.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/09.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/10.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/11.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/12.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/13.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/14.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/15.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/16.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/17.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/18.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/19.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/20.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/21.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/22.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/23.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/24.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/25.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/26.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/27.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/28.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/29.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/30.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/31.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/32.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/33.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/35.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/34.jpg" /></td>
            <td></td>
        </tr>
        <tr>
<td style="text-align:center"><select id="clasrieg_carg1" name="clasrieg_carg1" disabled>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) and $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>
<!--<td style="text-align:center"><input class="input-block-level" name="clasrieg_carg1" type="text" value="<?php echo $nombre_empresa ?>"/></td>-->
<td style='text-align:center'><input name='clasrieg_fis1_ruid' class="clasrieg_fis1_ruid" id="clasrieg_fis1_ruid" type='checkbox' value='S' <? if($clasrieg_fis1_ruid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis1_ilum' class="clasrieg_fis1_ilum" id="clasrieg_fis1_ilum" type='checkbox' value='S' <? if($clasrieg_fis1_ilum=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis1_noionic' class="clasrieg_fis1_noionic" id="clasrieg_fis1_noionic" type='checkbox' value='S' <? if($clasrieg_fis1_noionic=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis1_vibra' class="clasrieg_fis1_vibra" id="clasrieg_fis1_vibra" type='checkbox' value='S' <? if($clasrieg_fis1_vibra=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis1_tempextrem' class="clasrieg_fis1_tempextrem" id="clasrieg_fis1_tempextrem" type='checkbox' value='S' <? if($clasrieg_fis1_tempextrem=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis1_cambpres' class="clasrieg_fis1_cambpres" id="clasrieg_fis1_cambpres" type='checkbox' value='S' <? if($clasrieg_fis1_cambpres=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim1_gasvapor' class="clasrieg_quim1_gasvapor" id="clasrieg_quim1_gasvapor" type='checkbox' value='S' <? if($clasrieg_quim1_gasvapor=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim1_aeroliq' class="clasrieg_quim1_aeroliq" id="clasrieg_quim1_aeroliq" type='checkbox' value='S' <? if($clasrieg_quim1_aeroliq=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim1_solid' class="clasrieg_quim1_solid" id="clasrieg_quim1_solid" type='checkbox' value='S' <? if($clasrieg_quim1_solid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim1_liquid' class="clasrieg_quim1_liquid" id="clasrieg_quim1_liquid" type='checkbox' value='S' <? if($clasrieg_quim1_liquid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog1_viru' class="clasrieg_biolog1_viru" id="clasrieg_biolog1_viru" type='checkbox' value='S' <? if($clasrieg_biolog1_viru=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog1_bacter' class="clasrieg_biolog1_bacter" id="clasrieg_biolog1_bacter" type='checkbox' value='S' <? if($clasrieg_biolog1_bacter=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog1_parasi' class="clasrieg_biolog1_parasi" id="clasrieg_biolog1_parasi" type='checkbox' value='S' <? if($clasrieg_biolog1_parasi=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog1_morde' class="clasrieg_biolog1_morde" id="clasrieg_biolog1_morde" type='checkbox' value='S' <? if($clasrieg_biolog1_morde=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog1_picad' class="clasrieg_biolog1_picad" id="clasrieg_biolog1_picad" type='checkbox' value='S' <? if($clasrieg_biolog1_picad=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog1_hongo' class="clasrieg_biolog1_hongo" id="clasrieg_biolog1_hongo" type='checkbox' value='S' <? if($clasrieg_biolog1_hongo=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo1_trabestat' class="clasrieg_ergo1_trabestat" id="clasrieg_ergo1_trabestat" type='checkbox' value='S' <? if($clasrieg_ergo1_trabestat=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo1_esfuerfis' class="clasrieg_ergo1_esfuerfis" id="clasrieg_ergo1_esfuerfis" type='checkbox' value='S' <? if($clasrieg_ergo1_esfuerfis=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo1_carga' class="clasrieg_ergo1_carga" id="clasrieg_ergo1_carga" type='checkbox' value='S' <? if($clasrieg_ergo1_carga=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo1_postforz' class="clasrieg_ergo1_postforz" id="clasrieg_ergo1_postforz" type='checkbox' value='S' <? if($clasrieg_ergo1_postforz=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo1_movrepet' class="clasrieg_ergo1_movrepet" id="clasrieg_ergo1_movrepet" type='checkbox' value='S' <? if($clasrieg_ergo1_movrepet=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo1_jortrab' class="clasrieg_ergo1_jortrab" id="clasrieg_ergo1_jortrab" type='checkbox' value='S' <? if($clasrieg_ergo1_jortrab=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi1_monoto' class="clasrieg_psi1_monoto" id="clasrieg_psi1_monoto" type='checkbox' value='S' <? if($clasrieg_psi1_monoto=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi1_relhuman' class="clasrieg_psi1_relhuman" id="clasrieg_psi1_relhuman" type='checkbox' value='S' <? if($clasrieg_psi1_relhuman=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi1_contentarea' class="clasrieg_psi1_contentarea" id="clasrieg_psi1_contentarea" type='checkbox' value='S' <? if($clasrieg_psi1_contentarea=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi1_orgtiemptrab' class="clasrieg_psi1_orgtiemptrab" id="clasrieg_psi1_orgtiemptrab" type='checkbox' value='S' <? if($clasrieg_psi1_orgtiemptrab=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_mecanic' class="clasrieg_segur1_mecanic" id="clasrieg_segur1_mecanic" type='checkbox' value='S' <? if($clasrieg_segur1_mecanic=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_electri' class="clasrieg_segur1_electri" id="clasrieg_segur1_electri" type='checkbox' value='S' <? if($clasrieg_segur1_electri=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_locat' class="clasrieg_segur1_locat" id="clasrieg_segur1_locat" type='checkbox' value='S' <? if($clasrieg_segur1_locat=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_fisiquim' class="clasrieg_segur1_fisiquim" id="clasrieg_segur1_fisiquim" type='checkbox' value='S' <? if($clasrieg_segur1_fisiquim=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_public' class="clasrieg_segur1_public" id="clasrieg_segur1_public" type='checkbox' value='S' <? if($clasrieg_segur1_public=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_espconfi' class="clasrieg_segur1_espconfi" id="clasrieg_segur1_espconfi" type='checkbox' value='S' <? if($clasrieg_segur1_espconfi=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_trabaltura' class="clasrieg_segur1_trabaltura" id="clasrieg_segur1_trabaltura" type='checkbox' value='S' <? if($clasrieg_segur1_trabaltura=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur1_accitransito' class="clasrieg_segur1_accitransito" id="clasrieg_segur1_accitransito" type='checkbox' value='S' <? if($clasrieg_segur1_accitransito=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_observ1_otro' class="clasrieg_observ1_otro" id="clasrieg_observ1_otro" type='checkbox' value='S' <? if($clasrieg_observ1_otro=='S'){ echo 'checked'; } ?>></td>
<td style="text-align:center"><input class="input-block-level" name="clasrieg_observ1_coment" id="clasrieg_observ1_coment" type="text" value="<?php echo $clasrieg_observ1_coment ?>"/></td>
        </tr>
        <tr>
<td style="text-align:center"><input class="input-block-level" name="clasrieg_carg2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $clasrieg_carg2 ?>"/></td>
<td style='text-align:center'><input name='clasrieg_fis2_ruid' class="clasrieg_fis2_ruid" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis2_ruid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis2_ilum' class="clasrieg_fis2_ilum" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis2_ilum=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis2_noionic' class="clasrieg_fis2_noionic" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis2_noionic=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis2_vibra' class="clasrieg_fis2_vibra" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis2_vibra=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis2_tempextrem' class="clasrieg_fis2_tempextrem" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis2_tempextrem=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis2_cambpres' class="clasrieg_fis2_cambpres" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis2_cambpres=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim2_gasvapor' class="clasrieg_quim2_gasvapor" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim2_gasvapor=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim2_aeroliq' class="clasrieg_quim2_aeroliq" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim2_aeroliq=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim2_solid' class="clasrieg_quim2_solid" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim2_solid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim2_liquid' class="clasrieg_quim2_liquid" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim2_liquid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog2_viru' class="clasrieg_biolog2_viru" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog2_viru=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog2_bacter' class="clasrieg_biolog2_bacter" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog2_bacter=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog2_parasi' class="clasrieg_biolog2_parasi" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog2_parasi=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog2_morde' class="clasrieg_biolog2_morde" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog2_morde=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog2_picad' class="clasrieg_biolog2_picad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog2_picad=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog2_hongo' class="clasrieg_biolog2_hongo" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog2_hongo=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo2_trabestat' class="clasrieg_ergo2_trabestat" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo2_trabestat=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo2_esfuerfis' class="clasrieg_ergo2_esfuerfis" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo2_esfuerfis=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo2_carga' class="clasrieg_ergo2_carga" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo2_carga=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo2_postforz' class="clasrieg_ergo2_postforz" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo2_postforz=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo2_movrepet' class="clasrieg_ergo2_movrepet" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo2_movrepet=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo2_jortrab' class="clasrieg_ergo2_jortrab" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo2_jortrab=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi2_monoto' class="clasrieg_psi2_monoto" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi2_monoto=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi2_relhuman' class="clasrieg_psi2_relhuman" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi2_relhuman=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi2_contentarea' class="clasrieg_psi2_contentarea" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi2_contentarea=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi2_orgtiemptrab' class="clasrieg_psi2_orgtiemptrab" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi2_orgtiemptrab=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_mecanic' class="clasrieg_segur2_mecanic" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_mecanic=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_electri' class="clasrieg_segur2_electri" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_electri=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_locat' class="clasrieg_segur2_locat" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_locat=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_fisiquim' class="clasrieg_segur2_fisiquim" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_fisiquim=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_public' class="clasrieg_segur2_public" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_public=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_espconfi' class="clasrieg_segur2_espconfi" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_espconfi=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_trabaltura' class="clasrieg_segur2_trabaltura" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur2_trabaltura=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur2_accitransito' class="clasrieg_segur2_accitransito" id="clasrieg_segur2_accitransito" type='checkbox' value='S' <? if($clasrieg_segur2_accitransito=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_observ2_otro' class="clasrieg_observ2_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_observ2_otro=='S'){ echo 'checked'; } ?>></td>
<td style="text-align:center"><input class="input-block-level" name="clasrieg_observ2_coment" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $clasrieg_observ2_coment ?>"/></td>
        </tr>
        <tr>
<td style="text-align:center"><input class="input-block-level" name="clasrieg_carg3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $clasrieg_carg3 ?>"/></td>
<td style='text-align:center'><input name='clasrieg_fis3_ruid' class="clasrieg_fis3_ruid" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis3_ruid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis3_ilum' class="clasrieg_fis3_ilum" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis3_ilum=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis3_noionic' class="clasrieg_fis3_noionic" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis3_noionic=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis3_vibra' class="clasrieg_fis3_vibra" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis3_vibra=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis3_tempextrem' class="clasrieg_fis3_tempextrem" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis3_tempextrem=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_fis3_cambpres' class="clasrieg_fis3_cambpres" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_fis3_cambpres=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim3_gasvapor' class="clasrieg_quim3_gasvapor" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim3_gasvapor=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim3_aeroliq' class="clasrieg_quim3_aeroliq" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim3_aeroliq=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim3_solid' class="clasrieg_quim3_solid" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim3_solid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_quim3_liquid' class="clasrieg_quim3_liquid" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_quim3_liquid=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog3_viru' class="clasrieg_biolog3_viru" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog3_viru=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog3_bacter' class="clasrieg_biolog3_bacter" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog3_bacter=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog3_parasi' class="clasrieg_biolog3_parasi" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog3_parasi=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog3_morde' class="clasrieg_biolog3_morde" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog3_morde=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog3_picad' class="clasrieg_biolog3_picad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog3_picad=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_biolog3_hongo' class="clasrieg_biolog3_hongo" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_biolog3_hongo=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo3_trabestat' class="clasrieg_ergo3_trabestat" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo3_trabestat=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo3_esfuerfis' class="clasrieg_ergo3_esfuerfis" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo3_esfuerfis=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo3_carga' class="clasrieg_ergo3_carga" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo3_carga=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo3_postforz' class="clasrieg_ergo3_postforz" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo3_postforz=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo3_movrepet' class="clasrieg_ergo3_movrepet" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo3_movrepet=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_ergo3_jortrab' class="clasrieg_ergo3_jortrab" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_ergo3_jortrab=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi3_monoto' class="clasrieg_psi3_monoto" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi3_monoto=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi3_relhuman' class="clasrieg_psi3_relhuman" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi3_relhuman=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi3_contentarea' class="clasrieg_psi3_contentarea" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi3_contentarea=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_psi3_orgtiemptrab' class="clasrieg_psi3_orgtiemptrab" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_psi3_orgtiemptrab=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_mecanic' class="clasrieg_segur3_mecanic" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_mecanic=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_electri' class="clasrieg_segur3_electri" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_electri=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_locat' class="clasrieg_segur3_locat" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_locat=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_fisiquim' class="clasrieg_segur3_fisiquim" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_fisiquim=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_public' class="clasrieg_segur3_public" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_public=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_espconfi' class="clasrieg_segur3_espconfi" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_espconfi=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_trabaltura' class="clasrieg_segur3_trabaltura" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_segur3_trabaltura=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_segur3_accitransito' class="clasrieg_segur3_accitransito" id="clasrieg_segur3_accitransito" type='checkbox' value='S' <? if($clasrieg_segur3_accitransito=='S'){ echo 'checked'; } ?>></td>
<td style='text-align:center'><input name='clasrieg_observ3_otro' class="clasrieg_observ3_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($clasrieg_observ3_otro=='S'){ echo 'checked'; } ?>></td>
<td style="text-align:center"><input class="input-block-level" name="clasrieg_observ3_coment" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $clasrieg_observ3_coment ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
function conocer_cargo(){
cod_grupo_area_cargo = document.getElementById("cod_grupo_area_cargo").value;
document.getElementById("dat_ocupa_carg1").value = cod_grupo_area_cargo;
}
function conocer_empresa_laborar(){
nombre_empresa = document.getElementById("nombre_empresa").value;
document.getElementById("dat_ocupa_emp1").value = nombre_empresa;
document.getElementById("clasrieg_carg1").value = nombre_empresa;
}
</script>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>Antecedentes relacionados de importancia</strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.3 Accidente Laboral&nbsp;&nbsp;&nbsp;
SI<input type="radio" name="ant_impor_accilab" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_impor_accilab=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_impor_accilab" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_impor_accilab=='NO')?'checked':'' ?> ></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>FECHA</strong></td>
            <td style="text-align:center"><strong>EMPRESA</strong></td>
            <td style="text-align:center"><strong>CAUSA</strong></td>
            <td style="text-align:center"><strong>TIPO DE LESIÓN</strong></td>
            <td style="text-align:center"><strong>PARTE AFECTADA</strong></td>
            <td style="text-align:center"><strong>DIAS INCAPACIDAD</strong></td>
            <td style="text-align:center"><strong>SECUELAS</strong></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_fecha1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_fecha1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_empre1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_empre1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_causa1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_causa1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_tip_lesi1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_tip_lesi1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_part_afect1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_part_afect1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_dias_incap1" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_impor_dias_incap1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_secuela1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_secuela1 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_fecha2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_fecha2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_empre2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_empre2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_causa2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_causa2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_tip_lesi2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_tip_lesi2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_part_afect2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_part_afect2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_dias_incap2" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_impor_dias_incap2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_secuela2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_impor_secuela2 ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>2.4 Enfermedad Laboral&nbsp;&nbsp;&nbsp;
SI<input type="radio" name="enf_lab" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($enf_lab=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="enf_lab" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($enf_lab=='NO')?'checked':'' ?> ></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <td><strong>Cual: </strong><input class="input-block-level" name="enf_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $enf_cual ?>"/></td>
        <td><strong>Hace Cuánto: </strong><input class="input-block-level" name="enf_hace_cuanto" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $enf_hace_cuanto ?>"/></td>
        <td><strong>Descripción: </strong><input class="input-block-level" name="enf_descripcion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $enf_descripcion ?>"/></td></tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">3. ANTECEDENTES FAMILIARES/PERSONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>3.1 ANTECEDENTES FAMILIARES</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td><strong>No Presenta Antecedentes Familiares&nbsp;&nbsp;&nbsp;<input name="ant_fam_no_presenta" id="<?php echo $cod_historia_clinica ?>" type="checkbox" value="NO" /></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td></td>
<td style="text-align:center"><strong>Padre</strong></td>
<td style="text-align:center"><strong>Madre</strong></td>
<td style="text-align:center"><strong>H/nos</strong></td>
<td style="text-align:center"><strong>Otros</strong></td>
<td style="text-align:center"><strong>Cual</strong></td>
<td style="text-align:center"></td>
<td style="text-align:center"><strong>Padre</strong></td>
<td style="text-align:center"><strong>Madre</strong></td>
<td style="text-align:center"><strong>H/nos</strong></td>
<td style="text-align:center"><strong>Otros</strong></td>
<td style="text-align:center"><strong>Cual</strong></td>
<td style="text-align:center">&nbsp;</td>
<td style="text-align:center"><strong>Padre</strong></td>
<td style="text-align:center"><strong>Madre</strong></td>
<td style="text-align:center"><strong>H/nos</strong></td>
<td style="text-align:center"><strong>Otros</strong></td>
<td style="text-align:center"><strong>Cual</strong></td>
</tr>
<tr>
<td><strong>Hipertensión</strong></td>
<td style="text-align:center"><input name='ant_fam_hiper_pad' class="ant_fam_hiper_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_hiper_pad=='S'){ echo 'checked'; } ?>></td>
<td style="text-align:center"><input name="ant_fam_hiper_mad" class="ant_fam_hiper_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_hiper_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_hiper_herm" class="ant_fam_hiper_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_hiper_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_hiper_otro" class="ant_fam_hiper_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_hiper_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_hiper_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_hiper_otro_cual ?>"/></td>
<td><strong>Cardiopatia</strong><strong> </strong></td>
<td style="text-align:center"><input name="ant_fam_cadio_pad" class="ant_fam_cadio_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_cadio_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_cadio_mad" class="ant_fam_cadio_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_cadio_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_cadio_herm" class="ant_fam_cadio_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_cadio_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_cadio_otro" class="ant_fam_cadio_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_cadio_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_cadio_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_cadio_otro_cual ?>"/></td>
<td><strong>Osteomusculares</strong></td>
<td style="text-align:center"><input name="ant_fam_osteomusc_pad" class="ant_fam_osteomusc_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_osteomusc_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_osteomusc_mad" class="ant_fam_osteomusc_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_osteomusc_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_osteomusc_herm" class="ant_fam_osteomusc_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_osteomusc_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_osteomusc_otro" class="ant_fam_osteomusc_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_osteomusc_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_osteomusc_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_osteomusc_otro_cual ?>"/></td>
</tr>
<tr>
<td><strong>Diabetes</strong></td>
<td style="text-align:center"><input name="ant_fam_diabet_pad" class="ant_fam_diabet_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_diabet_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_diabet_mad" class="ant_fam_diabet_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_diabet_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_diabet_herm" class="ant_fam_diabet_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_diabet_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_diabet_otro" class="ant_fam_diabet_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_diabet_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_diabet_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_diabet_otro_cual ?>"/></td>
<td><strong>Trans. Convulsivo</strong></td>
<td style="text-align:center"><input name="ant_fam_trans_convul_pad" class="ant_fam_trans_convul_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trans_convul_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_trans_convul_mad" class="ant_fam_trans_convul_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trans_convul_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_trans_convul_herm" class="ant_fam_trans_convul_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trans_convul_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_trans_convul_otro" class="ant_fam_trans_convul_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trans_convul_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_trans_convul_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_trans_convul_otro_cual ?>"/></td>
<td><strong>Artitris</strong></td>
<td style="text-align:center"><input name="ant_fam_artitri_pad" class="ant_fam_artitri_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_artitri_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_artitri_mad" class="ant_fam_artitri_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_artitri_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_artitri_herm" class="ant_fam_artitri_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_artitri_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_artitri_otro" class="ant_fam_artitri_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_artitri_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_artitri_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_artitri_otro_cual ?>"/></td>
</tr>
<tr>
<td><strong>ACV o Trombosis</strong></td>
<td style="text-align:center"><input name="ant_fam_trombos_pad" class="ant_fam_trombos_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trombos_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_trombos_mad" class="ant_fam_trombos_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trombos_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_trombos_herm" class="ant_fam_trombos_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trombos_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_trombos_otro" class="ant_fam_trombos_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_trombos_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_trombos_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_trombos_otro_cual ?>"/></td>
<td><strong>Efermedad Genetica </strong></td>
<td style="text-align:center"><input name="ant_fam_enf_gene_pad" class="ant_fam_enf_gene_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_gene_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_enf_gene_mad" class="ant_fam_enf_gene_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_gene_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_enf_gene_herm" class="ant_fam_enf_gene_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_gene_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_enf_gene_otro" class="ant_fam_enf_gene_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_gene_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_enf_gene_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_enf_gene_otro_cual ?>"/></td>
<td><strong>Varices</strong></td>
<td style="text-align:center"><input name="ant_fam_varice_pad" class="ant_fam_varice_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_varice_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_varice_mad" class="ant_fam_varice_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_varice_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_varice_herm" class="ant_fam_varice_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_varice_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_varice_otro" class="ant_fam_varice_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_varice_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_varice_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_varice_otro_cual ?>"/></td>
</tr>
<tr>
<td><strong>Tumores Malignos </strong></td>
<td style="text-align:center"><input name="ant_fam_tum_malig_pad" class="ant_fam_tum_malig_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tum_malig_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_tum_malig_mad" class="ant_fam_tum_malig_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tum_malig_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_tum_malig_herm" class="ant_fam_tum_malig_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tum_malig_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_tum_malig_otro" class="ant_fam_tum_malig_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tum_malig_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_tum_malig_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_tum_malig_otro_cual ?>"/></td>
<td><strong>Alergias</strong></td>
<td style="text-align:center"><input name="ant_fam_alerg_pad" class="ant_fam_alerg_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_alerg_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_alerg_mad" class="ant_fam_alerg_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_alerg_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_alerg_herm" class="ant_fam_alerg_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_alerg_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_alerg_otro" class="ant_fam_alerg_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_alerg_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_alerg_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_alerg_otro_cual ?>"/></td>
<td><strong>Asma</strong></td>
<td style="text-align:center"><input name="ant_fam_asma_pad" class="ant_fam_asma_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_asma_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_asma_mad" class="ant_fam_asma_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_asma_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_asma_herm" class="ant_fam_asma_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_asma_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_asma_otro" class="ant_fam_asma_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_asma_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_asma_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_asma_otro_cual ?>"/></td>
</tr>
<tr>
<td><strong>Enfermedad Mental</strong></td>
<td style="text-align:center"><input name="ant_fam_enf_ment_pad" class="ant_fam_enf_ment_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_ment_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_enf_ment_mad" class="ant_fam_enf_ment_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_ment_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_enf_ment_herm" class="ant_fam_enf_ment_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_ment_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_enf_ment_otro" class="ant_fam_enf_ment_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_enf_ment_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_enf_ment_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_enf_ment_otro_cual ?>"/></td>
<td><strong>Tuberculosis</strong></td>
<td style="text-align:center"><input name="ant_fam_tuber_pad" class="ant_fam_tuber_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tuber_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_tuber_mad" class="ant_fam_tuber_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tuber_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_tuber_herm" class="ant_fam_tuber_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tuber_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_tuber_otro" class="ant_fam_tuber_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_tuber_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_tuber_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_tuber_otro_cual ?>"/></td>
<td><strong>Otros</strong></td>
<td style="text-align:center"><input name="ant_fam_otro_pad" class="ant_fam_otro_pad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_otro_pad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_otro_mad" class="ant_fam_otro_mad" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_otro_mad=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_otro_herm" class="ant_fam_otro_herm" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_otro_herm=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input name="ant_fam_otro_otro" class="ant_fam_otro_otro" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='S' <? if($ant_fam_otro_otro=='S'){ echo 'checked'; } ?> /></td>
<td style="text-align:center"><input class="input-block-level" name="ant_fam_otro_otro_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_otro_otro_cual ?>"/></td>
</tr>
</tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_fam_descripcion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam_descripcion ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.2 Antecedentes Patológicos</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#B6DDE8"><strong>No Presenta Antecedentes Patológicos&nbsp;&nbsp;&nbsp;<input name='ant_pato_no_presenta' id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='X' <? if($ant_pato_no_presenta=='X'){ echo 'checked'; } ?>></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Neurologicos</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_neuro" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_neuro=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_neuro" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_neuro=='NO')?'checked':'' ?> ></td>
<td><strong>Pulmonar</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_resp" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_resp=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_resp" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_resp=='NO')?'checked':'' ?> ></td>
<td><strong>Dermatologico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_derma" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_derma=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_derma" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_derma=='NO')?'checked':'' ?> ></td>	
<td><strong>Psiquiatrico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_psiq" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_psiq=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_psiq" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_psiq=='NO')?'checked':'' ?> ></td>
<td><strong>Alergico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_alerg" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_alerg=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_alerg" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_alerg=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
<td><strong>Osteomusculares</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_osteomusc" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_osteomusc=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_osteomusc" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_osteomusc=='NO')?'checked':'' ?> ></td>	
<td><strong>Gastrointestinal</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_gastrointes" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_gastrointes=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_gastrointes" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_gastrointes=='NO')?'checked':'' ?> ></td>	
<td><strong>Hematologico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_hematolog" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_hematolog=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_hematolog" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_hematolog=='NO')?'checked':'' ?> ></td>	
<td><strong>Organos de los Sentidos </strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_org_sentid" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_org_sentid=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_org_sentid" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_org_sentid=='NO')?'checked':'' ?> ></td>	
<td><strong>Cancer</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_onco" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_onco=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_onco" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_onco=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
            <td><strong>Hipertensión</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_hiperten" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_hiperten=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_hiperten" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_hiperten=='NO')?'checked':'' ?> ></td>	
<td><strong>Genitourinario</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_genurinario" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_genurinario=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_genurinario" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_genurinario=='NO')?'checked':'' ?> ></td>	
<td><strong>Infeccioso</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_infesios" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_infesios=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_infesios" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_infesios=='NO')?'checked':'' ?> ></td>	
<td><strong>Congénito</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_congenit" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_congenit=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_congenit" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_congenit=='NO')?'checked':'' ?> ></td>	
<td><strong>Famacologico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_farmacolog" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_farmacolog=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_farmacolog" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_farmacolog=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
<td><strong>Transfusiones</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_transfus" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_transfus=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_transfus" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_transfus=='NO')?'checked':'' ?> ></td>	
<td><strong>Endocrino (Diabetes Tiroides)</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_endocrino" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_endocrino=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_endocrino" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_endocrino=='NO')?'checked':'' ?> ></td>	
<td><strong>Vasculares</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_vascular" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_vascular=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_vascular" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_vascular=='NO')?'checked':'' ?> ></td>	
<td><strong>Autoinmunes</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_auntoinmun" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_auntoinmun=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_auntoinmun" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_auntoinmun=='NO')?'checked':'' ?> ></td>	
<td><strong>Convulsiones (Ataques)</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_convulsion" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_convulsion=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_convulsion" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_convulsion=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
<td><strong>Claustrofobia</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_claustrofobia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_claustrofobia=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_claustrofobia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_claustrofobia=='NO')?'checked':'' ?> ></td>	
<td><strong>Dificultad Al Oler</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_dificuloler" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_dificuloler=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_dificuloler" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_dificuloler=='NO')?'checked':'' ?> ></td>	
<td><strong>Cardiopatia</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_cardiopatia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_cardiopatia=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_cardiopatia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_cardiopatia=='NO')?'checked':'' ?> ></td>	
<td><strong>Usa Lentes</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_lentes" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_lentes=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_lentes" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_lentes=='NO')?'checked':'' ?> ></td>	
<td><strong>Dificultad para Distinguir los Colores</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_dificuldistincolor" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_dificuldistincolor=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_dificuldistincolor" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_dificuldistincolor=='NO')?'checked':'' ?> ></td>	
        </tr>
       <tr>
<td><strong>Efermedades Hepaticas</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_enf_hepaticas" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_enf_hepaticas=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_enf_hepaticas" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_enf_hepaticas=='NO')?'checked':'' ?> ></td>	
<td><strong>Transplantes</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_transplates" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_transplates=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_transplates" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_transplates=='NO')?'checked':'' ?> ></td>	
<td><strong>Obesidad Morbida (IMC > 40)</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_obesidad_morbida" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_obesidad_morbida=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_obesidad_morbida" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_obesidad_morbida=='NO')?'checked':'' ?> ></td>	
<td><strong>Hereditarios</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_hereditarios" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_hereditarios=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_hereditarios" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_hereditarios=='NO')?'checked':'' ?> ></td>	
<td><strong>Enfermedades Infantiles</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_enf_infaltil" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_enf_infaltil=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_enf_infaltil" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_enf_infaltil=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
<td><strong>Enfermedad Dental</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_enf_dental" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_enf_dental=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_enf_dental" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_enf_dental=='NO')?'checked':'' ?> ></td>	
<td><strong>Enfermedad del Corazon</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_enf_corazon" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_enf_corazon=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_enf_corazon" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_enf_corazon=='NO')?'checked':'' ?> ></td>	
<td><strong>Enfermedad Renal</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_enf_renal" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_enf_renal=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_enf_renal" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_enf_renal=='NO')?'checked':'' ?> ></td>	
<td><strong>Otros</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_otro" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_pato_otro=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_otro" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_pato_otro=='NO')?'checked':'' ?> ></td>	
<td><strong></strong></td>
<td style="text-align:center"></td>
<td style="text-align:center"></td>	
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_pato_descripcion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_pato_descripcion ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.3 Antecedentes para Alturas</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#B6DDE8"><strong>Presenta Antecedentes para Alturas&nbsp;&nbsp;&nbsp;
        	NO<input type="radio" name="ant_altu_no" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_no=='NO')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
        	NA<input type="radio" name="ant_altu_no" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_no=='NA')?'checked':'' ?> ></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
<td><strong>Epilepsia</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_epilep" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_epilep=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_epilep" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_epilep=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_epilep" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_epilep=='NA')?'checked':'' ?> ></td>
<td><strong>Otitis media</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_otitmed" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_otitmed=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_otitmed" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_otitmed=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_otitmed" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_otitmed=='NA')?'checked':'' ?> ></td>
<td><strong>Enfermedad de maniere</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_enfmanier" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_enfmanier=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_enfmanier" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_enfmanier=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_enfmanier" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_enfmanier=='NA')?'checked':'' ?> ></td>
<td><strong>Traumas craneales</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_traumcran" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_traumcran=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_traumcran" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_traumcran=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_traumcran" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_traumcran=='NA')?'checked':'' ?> ></td>
        </tr>
        <tr>
<td><strong>Tumores cerebrales</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_tumcereb" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_tumcereb=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_tumcereb" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_tumcereb=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_tumcereb" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_tumcereb=='NA')?'checked':'' ?> ></td>
<td><strong>Malformaciones cerebrales</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_malfocereb" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_malfocereb=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_malfocereb" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_malfocereb=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_malfocereb" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_malfocereb=='NA')?'checked':'' ?> ></td>
<td><strong>Trombosis (ACV)</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_trombo" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_trombo=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_trombo" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_trombo=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_trombo" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_trombo=='NA')?'checked':'' ?> ></td>
<td><strong>Hipoacusia</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_hipoac" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_hipoac=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_hipoac" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_hipoac=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_hipoac" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_hipoac=='NA')?'checked':'' ?> ></td>
        </tr>
        <tr>
<td><strong>Arritmia cardíaca</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_arritcardi" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_arritcardi=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_arritcardi" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_arritcardi=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_arritcardi" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_arritcardi=='NA')?'checked':'' ?> ></td>
<td><strong>Hipoglicemias</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_hipogli" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_hipogli=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_hipogli" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_hipogli=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_hipogli" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_hipogli=='NA')?'checked':'' ?> ></td>
<td><strong>Fobias</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_fobia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_altu_fobia=='SI')?'checked':'' ?> required></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_fobia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_altu_fobia=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_fobia" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($ant_altu_fobia=='NA')?'checked':'' ?> ></td>
        </tr>
            </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_altu_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_altu_observ ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.4 Antecedentes Traumáticos &nbsp;&nbsp;&nbsp;
SI<input type="radio" name="ant_trau" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_trau=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_trau" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_trau=='NO')?'checked':'' ?> ></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Enfermedad</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
            <td style="text-align:center"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_enfer1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_enfer1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_observ1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_observ1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_fech_aprox1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_fech_aprox1 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_enfer2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_enfer2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_observ2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_observ2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_fech_aprox2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_fech_aprox2 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_enfer3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_enfer3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_observ3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_observ3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_fech_aprox3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_trau_fech_aprox3 ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.5 Antecedentes Quirúrgicos&nbsp;&nbsp;&nbsp;
SI<input type="radio" name="ant_quirur" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_quirur=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_quirur" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_quirur=='NO')?'checked':'' ?> ></strong></td></tr></tbody>
</table>

<table align="center" border="1" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Enfermedad</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
            <td style="text-align:center"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_enfer1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_enfer1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_observ1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_observ1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_fech_aprox1" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_fech_aprox1 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_enfer2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_enfer2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_observ2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_observ2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_fech_aprox2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_fech_aprox2 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_enfer3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_enfer3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_observ3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_observ3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_fech_aprox3" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_quirur_fech_aprox3 ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.6 Antecedentes - Inmunizaciones (Presenta Vacunas:&nbsp;&nbsp;&nbsp; 
SI<input type="radio" name="ant_inmuni" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_inmuni" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni=='NO')?'checked':'' ?> ></strong></td></tr></tbody>
</table>
<table align="center" border="1" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Vacuna</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"><strong>Año Aplicación</strong></td>
            <td style="text-align:center"><strong>Vacuna</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"><strong>Año Aplicación</strong></td>
        </tr>
        <tr>
            <td><strong>TETANO</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_tetano" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_tetano=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_tetano" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_tetano=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_tetano_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_tetano_anyo ?>"/></td>
            <td><strong>FIEBRE TIFOIDEA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_fiebtifo" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_fiebtifo=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_fiebtifo" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_fiebtifo=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_fiebtifo_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_fiebtifo_anyo ?>"/></td>
        </tr>
        <tr>
            <td><strong>HEPATITIS A </strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_hepatita" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_hepatita=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_hepatita" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_hepatita=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_hepatita_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_hepatita_anyo ?>"/></td>
            <td><strong>INFLUENZA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_influenza" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_influenza=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_influenza" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_influenza=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_influenza_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_influenza_anyo ?>"/></td>
        </tr>
        <tr>
            <td><strong>HEPATITIS B </strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_hepatitb" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_hepatitb=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_hepatitb" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_hepatitb=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_hepatitb_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_hepatitb_anyo ?>"/></td>
            <td><strong>SARAMPION</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_saramp" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_saramp=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_saramp" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_saramp=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_saramp_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_saramp_anyo ?>"/></td>
        </tr>
        <tr>
            <td><strong>FIEBRE AMARILLA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_fiebamarill" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_fiebamarill=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_fiebamarill" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_fiebamarill=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_fiebamarill_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_fiebamarill_anyo ?>"/></td>
            <td><strong>OTRA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_otra" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ant_inmuni_otra=='SI')?'checked':'' ?> required></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_otra" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ant_inmuni_otra=='NO')?'checked':'' ?> ></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_otra_anyo" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_inmuni_otra_anyo ?>"/></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_inmuni_observacion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_inmuni_observacion ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090">3.7 <strong>Antecedentes Ginecologicos</strong></td></tr></tbody>
</table>
<table align="center" border="1" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Primera Mestruación </strong></td>
            <td style="text-align:center"><strong>Años</strong></td>
            <td style="text-align:center"><strong>Ciclo</strong></td>
            <td style="text-align:center"><strong>FUM</strong></td>
            <td style="text-align:center"><strong>FUP</strong></td>
            <td style="text-align:center"><strong>FUC</strong></td>
            <td style="text-align:center" colspan="7" width="30%"><strong>FICHAS GINECOBSTETRICA</strong></td>
            <td style="text-align:center"><strong>Fecha Ultimo Examen de Mama </strong></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_prim_mestrua" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_prim_mestrua ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_anyos" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_anyos ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_cliclo" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_cliclo ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fum" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_fum ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fup" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_fup ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fuc" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_fuc ?>"/></td>
            <td style="text-align:center"><strong>G<input class="input-block-level" name="ant_gine_fich_gine_g" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_g ?>"/></strong></td>
            <td style="text-align:center"><strong>P<input class="input-block-level" name="ant_gine_fich_gine_p" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_p ?>"/></strong></td>
            <td style="text-align:center"><strong>A<input class="input-block-level" name="ant_gine_fich_gine_a" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_a ?>"/></strong></td>
            <td style="text-align:center"><strong>C<input class="input-block-level" name="ant_gine_fich_gine_c" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_c ?>"/></strong></td>
            <td style="text-align:center"><strong>M<input class="input-block-level" name="ant_gine_fich_gine_m" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_m ?>"/></strong></td>
            <td style="text-align:center"><strong>E<input class="input-block-level" name="ant_gine_fich_gine_e" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_e ?>"/></strong></td>
            <td style="text-align:center"><strong>V<input class="input-block-level" name="ant_gine_fich_gine_v" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $ant_gine_fich_gine_v ?>"/></strong></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fech_ult_exa_mama" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_fech_ult_exa_mama ?>"/></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>Problemas Mamarios</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_problem_mamario" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_problem_mamario ?>"/></td>
            <td style="text-align:center"><strong>Problemas Ginecologicos</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_problem_ginecol" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_problem_ginecol ?>"/></td>
            <td style="text-align:center"><strong>Cree estar embarazada?</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_cree_estar_embarazada" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_cree_estar_embarazada ?>"/></td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Planificaciones: </strong><input class="input-block-level" name="ant_gine_planifica" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_planifica ?>"/></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_gine_observacion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_gine_observacion ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr><td colspan="14" bgcolor="#FAC090"><strong>3.8 Hábitos Personales </strong></td></tr>
<tr>
<td style="text-align:center" colspan="8"><strong>
Tabaquismo:&nbsp;Fuma<input type="radio" name="habit_tox_fum_nofum_exfum" id="<?php echo $cod_historia_clinica ?>" value="Fuma" <?php echo ($habit_tox_fum_nofum_exfum=='Fuma')?'checked':'' ?> required>
&nbsp;No Fuma<input type="radio" name="habit_tox_fum_nofum_exfum" id="<?php echo $cod_historia_clinica ?>" value="No Fuma" <?php echo ($habit_tox_fum_nofum_exfum=='No Fuma')?'checked':'' ?> >
&nbsp;Exfumador<input type="radio" name="habit_tox_fum_nofum_exfum" id="<?php echo $cod_historia_clinica ?>" value="Exfumador" <?php echo ($habit_tox_fum_nofum_exfum=='Exfumador')?'checked':'' ?> >
</strong></td>
<td style="text-align:center;" colspan="1"><strong>No. Cigarrillos al día:</strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_ciga_aldia" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $habit_tox_ciga_aldia ?>" /></td>
<td style="text-align:center;" colspan="1"><strong>Total Años fumando: </strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_anyos_fum" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $habit_tox_anyos_fum ?>"/></td>
<td style="text-align:center;" colspan="1"><strong>Tiempo sin fumar:</strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_tiem_sinfum" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $habit_tox_tiem_sinfum ?>"/></td>
</tr>
<tr>
<td style="text-align:center" colspan="8"><strong>
Consumo de Alcohol:&nbsp;SI<input type="radio" name="habit_tox_consum_alcoh" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($habit_tox_consum_alcoh=='SI')?'checked':'' ?> required>
&nbsp;NO<input type="radio" name="habit_tox_consum_alcoh" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($habit_tox_consum_alcoh=='NO')?'checked':'' ?> >
</strong>
<br>
<strong>Toxicomanías:&nbsp;SI<input type="radio" name="habit_tox_toxicomania" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($habit_tox_toxicomania=='SI')?'checked':'' ?> >
&nbsp;NO<input type="radio" name="habit_tox_toxicomania" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($habit_tox_toxicomania=='NO')?'checked':'' ?> >
</strong>
</td>
<td style="text-align:center" colspan="3"><strong>Actividad Extralaboral:</strong><input style="text-align:center" class="input-block-level" name="habit_tox_activ_extralab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $habit_tox_activ_extralab ?>"/></td>
</tr>
<tr>
<td style="text-align:center" colspan="8"><strong>
Actividad física:&nbsp;Sedentario<input type="radio" name="habit_tox_activfis" id="<?php echo $cod_historia_clinica ?>" value="Sedentario" <?php echo ($habit_tox_activfis=='Sedentario')?'checked':'' ?> required>
&nbsp;Físicamente activo<input type="radio" name="habit_tox_activfis" id="<?php echo $cod_historia_clinica ?>" value="Fisicamente activo" <?php echo ($habit_tox_activfis=='Fisicamente activo')?'checked':'' ?> >
</strong></td>
<td style="text-align:center" colspan="1"><strong>Actividad: </strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_actividad" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $habit_tox_actividad ?>"/></td>
<td style="text-align:center" colspan="1"><strong>Frecuencia: </strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_frecuenc" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $habit_tox_frecuenc ?>"/></td>
<td style="text-align:center" colspan="1"><strong>Tiempo: </strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_tiempo" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $habit_tox_tiempo ?>"/></td>
</tr>
<tr>
<td style="text-align:center" colspan="8"></td>
<td style="text-align:center" colspan="1"><strong>Medicamentos: </strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_medicamento" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $habit_tox_medicamento ?>"/></td>
<td style="text-align:center" colspan="1"><strong>Horas de Sueño: </strong><input style="text-align:center;width:150px;height:20px" class="input-block-level" name="habit_tox_horasueno" id="<?php echo $cod_historia_clinica ?>" type="number" value="<?php echo $habit_tox_horasueno ?>"/></td>
<td style="text-align:center" colspan="1"><strong></strong></td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">4. REVISIÓN POR SISTEMAS</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
    	<tr><td bgcolor="#B6DDE8"><strong>No Refiere&nbsp;&nbsp;&nbsp;<input name="rev_sist_no" id="<?php echo $cod_historia_clinica ?>" type='checkbox' value='NO' <? if($rev_sist_no=='NO'){ echo 'checked'; } ?> /></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Síntomas</strong></td>
            <td style="text-align:center"><strong>Refiere</strong></td>
             <td style="text-align:center"><strong>Observaciones</strong></td>
        </tr>
        <tr>
<td><strong>Órgano de los Sentidos </strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_orgsentido" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_orgsentido=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_orgsentido" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_orgsentido=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_orgsentido" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_orgsentido ?>"/></td>
</tr>
<tr>
<td><strong>Neurológicos</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_neurolog" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_neurolog=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_neurolog" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_neurolog=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_neurolog" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_neurolog ?>"/></td>
</tr>
<tr>
<td><strong>Respiratorios</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_resp" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_resp=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_resp" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_resp=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_resp" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_resp ?>"/></td>
</tr>
<tr>
<td><strong>Gastrointestinales</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_gastrointes" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_gastrointes=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_gastrointes" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_gastrointes=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_gastrointes" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_gastrointes ?>"/></td>
</tr>
<tr>
<td><strong>Genitourinarios</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_geniuri" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_geniuri=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_geniuri" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_geniuri=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_geniuri" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_geniuri ?>"/></td>
</tr>
<tr>
<td><strong>Osteomuscular</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_osteomus" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_osteomus=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_osteomus" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_osteomus=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_osteomus" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_osteomus ?>"/></td>
</tr>
<tr>
<td><strong>Dermatológicos</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_dermato" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_dermato=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_dermato" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_dermato=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_dermato" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_dermato ?>"/></td>
</tr>
<tr>
<td><strong>Cardiovasculares</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_cardiovas" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_cardiovas=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_cardiovas" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_cardiovas=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_cardiovas" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_cardiovas ?>"/></td>
</tr>
<tr>
<td><strong>Constitucionales</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_constitu" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_constitu=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_constitu" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_constitu=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_constitu" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_constitu ?>"/></td>
</tr>
<tr>
<td><strong>Metabolico y Endocrino</strong></td>
<td style="text-align:center">
	SI<input type="radio" name="rev_sist_metabolendocri" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($rev_sist_metabolendocri=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="rev_sist_metabolendocri" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($rev_sist_metabolendocri=='NO')?'checked':'' ?> ></td>
<td><input class="input-block-level" name="rev_sist_observ_metabolendocri" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rev_sist_observ_metabolendocri ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">5. EVALUACIÓN DEL ESTADO MENTAL</span></strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>PROCESOS</strong></td>
            <td style="text-align:center"><strong>NORMAL</strong></td>
            <td style="text-align:center"><strong>DISFUNCIÓN</strong></td>
            <td style="text-align:center"><strong>HALLAZGO</strong></td>
        </tr>
        <tr>
            <td><strong>ORIENTACIÓN</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_orient" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_norm_orient ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_orient" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_disf_orient ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_halla_orient" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_halla_orient ?>"/></td>
        </tr>
        <tr>
            <td>
            <strong>ATENCIÓN CONCENTRACIÓN</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_atenconcent" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_norm_atenconcent ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_atenconcent" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_disf_atenconcent ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_halla_atenconcent" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_halla_atenconcent ?>"/></td>
        </tr>
        <tr>
            <td><strong>SENSOPERCEPCIÓN</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_sensoper" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_norm_sensoper ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_sensoper" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_disf_sensoper ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_halla_sensoper" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_halla_sensoper ?>"/></td>
        </tr>
        <tr>
            <td><strong>MEMORIA</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_memor" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_norm_memor ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_memor" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_disf_memor ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_halla_memor" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_halla_memor ?>"/></td>
        </tr>
        <tr>
            <td><strong>PENSAMIENTO</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_pensami" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_norm_pensami ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_pensami" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_disf_pensami ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_halla_pensami" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_halla_pensami ?>"/></td>
        </tr>
        <tr>
            <td><strong>LENGUAJE</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_lenguaj" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_norm_lenguaj ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_lenguaj" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_disf_lenguaj ?>"/></td>
            <td><input class="input-block-level" name="eval_estment_halla_lenguaj" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $eval_estment_halla_lenguaj ?>"/></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td><strong>CONCEPTO:&nbsp;&nbsp;&nbsp;
            	NORMAL<input type="radio" name="eval_estment_concept" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($eval_estment_concept=='NORMAL')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
            	ANORMAL<input type="radio" name="eval_estment_concept" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($eval_estment_concept=='ANORMAL')?'checked':'' ?> ></strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">6. EXAMEN FÍSICO</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td style="text-align:center"><strong>&nbsp;Talla: (Mts)<input style="text-align:center" name="exa_fis_talla" class="exa_fis_talla" id="exa_fis_talla" type="text" value="<?php echo $exa_fis_talla ?>" onChange="calc_imc();" required/></strong></td>
<td style="text-align:center"><strong>PESO: (Kg)<input style="text-align:center" name="exa_fis_peso" class="exa_fis_peso" id="exa_fis_peso" type="text" value="<?php echo $exa_fis_peso ?>" onChange="calc_imc();" required/></strong></td>
<td style="text-align:center"><strong>IMC:<input style="text-align:center" name="exa_fis_imc" class="exa_fis_imc" id="exa_fis_imc" type="text" value="<?php echo $exa_fis_imc ?>"/></strong></td>
<td style="text-align:center"><strong>INTERPRETACIÓN IMC:<input style="text-align:center" name="exa_fis_interpreimc" class="exa_fis_interpreimc" id="exa_fis_interpreimc" type="text" value="<?php echo $exa_fis_interpreimc ?>"/></strong></td>
<td style="text-align:center"><strong>F. Resp: (/Min)<input style="text-align:center" name="exa_fis_fresp" class="exa_fis_fresp" id="exa_fis_fresp" type="text" value="<?php echo $exa_fis_fresp ?>" required/></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong>TA: (Mm/Hg)<input style="text-align:center" name="exa_fis_ta" class="exa_fis_ta" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ta ?>" required/></strong></td>
<td style="text-align:center"><strong>FC: (/Min)<input style="text-align:center" name="exa_fis_fc" class="exa_fis_fc" id="exa_fis_fc" type="text" value="<?php echo $exa_fis_fc ?>" required/></strong></td>
<td style="text-align:center"><strong>
Lateralidad&nbsp;&nbsp;&nbsp;&nbsp;
D<input type="radio" name="exa_fis_lateral" id="<?php echo $cod_historia_clinica ?>" value="D" <?php echo ($exa_fis_lateral=='D')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
I<input type="radio" name="exa_fis_lateral" id="<?php echo $cod_historia_clinica ?>" value="I" <?php echo ($exa_fis_lateral=='I')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exa_fis_lateral" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exa_fis_lateral=='AM')?'checked':'' ?> >
</strong></td>
<td style="text-align:center"><strong>Perímetro Abdominal: (Cm)<input style="text-align:center" name="exa_fis_periabdom" class="exa_fis_periabdom" id="exa_fis_periabdom" type="number" value="<?php echo $exa_fis_periabdom ?>" required/>
<td style="text-align:center"><strong>
Temperatura:&nbsp;&nbsp;&nbsp;&nbsp;
<input class="input-block-level" name="exa_fis_temperat" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_temperat ?>"/>
</strong></td>
</tr>
<tr>
<td style="text-align:center"><strong>%STO2</strong><input class="input-block-level" name="exa_fis_sto2" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_sto2 ?>"/></td>
</tr>
</tr>
</tbody>
</table>

<script>
function calc_imc(){
var exa_fis_talla = document.getElementById("exa_fis_talla").value;
var exa_fis_peso = document.getElementById("exa_fis_peso").value;
var exa_fis_imc = (exa_fis_peso / Math.pow(exa_fis_talla, 2)).toFixed(2);
var exa_fis_interpreimc = "";
var img_imc = "";

if ((exa_fis_imc  < 18.50)) { exa_fis_interpreimc = "BAJO PESO"; img_imc = '<img src="../imagenes/imc/peso1.png">'; }
if ((exa_fis_imc  >= 18.50) && (exa_fis_imc  <= 24.99)) { exa_fis_interpreimc = "PESO NORMAL"; img_imc = '<img src="../imagenes/imc/peso2.png">'; }
if ((exa_fis_imc  >= 25.0) && (exa_fis_imc  <= 29.99)) { exa_fis_interpreimc = "SOBREPESO"; img_imc = '<img src="../imagenes/imc/peso3.png">'; }
if ((exa_fis_imc  >= 30.0) && (exa_fis_imc  <= 34.99)) { exa_fis_interpreimc = "OBESIDAD I"; img_imc = '<img src="../imagenes/imc/peso4.png">'; }
if ((exa_fis_imc  >= 35.0) && (exa_fis_imc  <= 39.99)) { exa_fis_interpreimc = "OBESIDAD II"; img_imc = '<img src="../imagenes/imc/peso5.png">'; }
if ((exa_fis_imc  >= 40.0) && (exa_fis_imc  <= 49.99)) { exa_fis_interpreimc = "OBESIDAD III"; img_imc = '<img src="../imagenes/imc/peso6.png">'; }
if ((exa_fis_imc  >= 50.0)) { exa_fis_interpreimc = "OBESIDAD EXTREMA"; img_imc = '<img src="../imagenes/imc/peso7.png">'; }

document.getElementById("exa_fis_imc").value = exa_fis_imc;
document.getElementById("exa_fis_interpreimc").value = exa_fis_interpreimc;
document.getElementsByName("img_imc").innerHTML=img_imc;
}
</script>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EXAMEN FÍSICO N(Normal) &ndash;  A(Anormal) &ndash;  NE(No examinado) </strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td colspan="5"></td></tr>
        <tr>
            <td style="text-align:center" rowspan="2"><strong>AGUDEZA VISUAL</strong></td>
            <td style="text-align:center" colspan="2"><strong>SIN CORRECCIÓN</strong></td>
            <td style="text-align:center" colspan="2"><strong>CON CORRECCIÓN</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>V/ LEJANA</strong></td>
            <td style="text-align:center"><strong>V/ CERCANA</strong></td>
            <td style="text-align:center"><strong>V/ LEJANA</strong></td>
            <td style="text-align:center"><strong>V/ CERCANA</strong></td>
        </tr>
        <tr>
            <td><strong>OJO DERECHO</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vlejan" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoder_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vcerca" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoder_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vlejan" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoder_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vcerca" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoder_cncorre_vcerca ?>"/></td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vlejan" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoizq_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vcerca" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoizq_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vlejan" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoizq_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vcerca" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoizq_cncorre_vcerca ?>"/></td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vlejan" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoamb_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vcerca" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoamb_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_oojoamb_cncorre_vlejan"id="<?php echo $cod_historia_clinica ?>"  type="text" value="<?php echo $exa_fis_oojoamb_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_cncorre_vcerca" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_ojoamb_cncorre_vcerca ?>"/></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td><strong>OJOS</strong></td>
<td style="text-align:center"><strong>

N<input type="radio" name="exa_fis_ojo" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_ojo=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_ojo" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_ojo=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_ojo" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_ojo=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_ojo_obser" type="text" value="<?php echo $exa_fis_ojo_obser ?>"/></td>
</tr>
<tr>
<td><strong>OIDOS</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_oido" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_oido=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_oido" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_oido=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_oido" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_oido=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_oido_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_oido_obser ?>"/></td>
</tr>
<tr>
<td><strong>CABEZA</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_cabeza" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_cabeza=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_cabeza" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_cabeza=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_cabeza" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_cabeza=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_cabeza_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_cabeza_obser ?>"/></td>
</tr>
<tr>
<td><strong>NARIZ</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_nariz" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_nariz=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_nariz" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_nariz=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_nariz" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_nariz=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_nariz_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_nariz_obser ?>"/></td>
</tr>
<tr>
<td><strong>OROFARINGE</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_orofaring" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_orofaring=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_orofaring" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_orofaring=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_orofaring" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_orofaring=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_orofaring_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_orofaring_obser ?>"/></td>
</tr>
<tr>
<td><strong>CUELLO</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_cuello" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_cuello=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_cuello" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_cuello=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_cuello" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_cuello=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_cuello_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_cuello_obser ?>"/></td>
</tr>
<tr>
<td><strong>TÓRAX</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_torax" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_torax=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_torax" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_torax=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_torax" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_torax=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_torax_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_torax_obser ?>"/></td>
</tr>

<tr>
<td><strong>SISTEMA MUSCULO ESQUELÉTICO</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_sistemmusculesquelet" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_sistemmusculesquelet=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_sistemmusculesquelet" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_sistemmusculesquelet=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_sistemmusculesquelet" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_sistemmusculesquelet=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_sistemmusculesquelet_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_sistemmusculesquelet_observ ?>"/></td>
</tr>

<tr>
<td bgcolor="#95B3D7"><strong>GLÁNDULAS MAMARIAS</strong></td>
<td style="text-align:center" bgcolor="#95B3D7"><strong>
N<input type="radio" name="exa_fis_glandumama" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_glandumama=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_glandumama" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_glandumama=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_glandumama" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_glandumama=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_glandumama_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_glandumama_obser ?>"/></td>
</tr>
<tr>
<td><strong>CARDIOPULMONAR</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_cardiopulm" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_cardiopulm=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_cardiopulm" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_cardiopulm=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_cardiopulm" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_cardiopulm=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_cardiopulm_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_cardiopulm_obser ?>"/></td>
</tr>
<tr>
<td><strong>ABDOMEN</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_abdomen" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_abdomen=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_abdomen" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_abdomen=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_abdomen" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_abdomen=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_abdomen_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_abdomen_obser ?>"/></td>
</tr>
<tr>
<td bgcolor="#95B3D7"><strong>GENITALES</strong></td>
<td style="text-align:center" bgcolor="#95B3D7"><strong>
N<input type="radio" name="exa_fis_genital" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_genital=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_genital" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_genital=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_genital" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_genital=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_genital_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_genital_obser ?>"/></td>
</tr>
<tr>
<td><strong>MIEMBROS SUPERIORES</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_miemsup" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_miemsup=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_miemsup" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_miemsup=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_miemsup" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_miemsup=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_miemsup_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_miemsup_obser ?>"/></td>
</tr>
<tr>
<td><strong>MIEMBROS INFERIORES</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_mieminf" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_mieminf=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_mieminf" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_mieminf=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_mieminf" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_mieminf=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_mieminf_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_mieminf_obser ?>"/></td>
</tr>
<tr>
<td><strong>COLUMNA</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_columna" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_columna=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_columna" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_columna=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_columna" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_columna=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_columna_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_columna_obser ?>"/></td>
</tr>
<tr>
<td bgcolor="#95B3D7"><strong>NEUROLÓGICO</strong><strong> (PRUEBAS DE EQUILIBRIO)</strong>
<div><strong>Equilibrio Estático&nbsp;&nbsp;</strong>
<br><strong>[Prueba de Romberg&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_romberg" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exa_fis_neurolog_romberg=='Pos')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_romberg" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exa_fis_neurolog_romberg=='Neg')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_romberg" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($exa_fis_neurolog_romberg=='NA')?'checked':'' ?> />)]</strong>

<strong>[Prueba de Barany&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_barany" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exa_fis_neurolog_barany=='Pos')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_barany" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exa_fis_neurolog_barany=='Neg')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_barany" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($exa_fis_neurolog_barany=='NA')?'checked':'' ?> />)]</strong>

<br><strong>[Maniobra de Dix Halpike&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_dixhalp" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exa_fis_neurolog_dixhalp=='Pos')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_dixhalp" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exa_fis_neurolog_dixhalp=='Neg')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_dixhalp" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($exa_fis_neurolog_dixhalp=='NA')?'checked':'' ?> />)]</strong>

<br><strong>Equilibrio Dinamico</strong>&nbsp;&nbsp;
<br><strong>[Marcha a Ciegas&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_mciega" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exa_fis_neurolog_mciega=='Pos')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_mciega" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exa_fis_neurolog_mciega=='Neg')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_mciega" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($exa_fis_neurolog_mciega=='NA')?'checked':'' ?> />)</strong>

<strong>[Pisoteo a Ciegas&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_pciega" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exa_fis_neurolog_pciega=='Pos')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_pciega" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exa_fis_neurolog_pciega=='Neg')?'checked':'' ?> />
&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_pciega" id="<?php echo $cod_historia_clinica ?>" value="NA" <?php echo ($exa_fis_neurolog_pciega=='NA')?'checked':'' ?> />)]</strong>

</div>
</td>
<td style="text-align:center" bgcolor="#95B3D7"><strong>
N<input type="radio" name="exa_fis_neurolog" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_neurolog=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_neurolog" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_neurolog=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_neurolog" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_neurolog=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_neurolog_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_neurolog_obser ?>"/></td>
</tr>
<tr>
<td><strong>ESTADO MENTAL APARENTE</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_estmentaparent" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_estmentaparent=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_estmentaparent" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_estmentaparent=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_estmentaparent" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_estmentaparent=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_estmentaparent_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_estmentaparent_obser ?>"/></td>
</tr>
<tr>
<td><strong>PIEL Y FANERAS</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_pielfanera" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($exa_fis_pielfanera=='N')?'checked':'' ?> />&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_pielfanera" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($exa_fis_pielfanera=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_pielfanera" id="<?php echo $cod_historia_clinica ?>" value="NE" <?php echo ($exa_fis_pielfanera=='NE')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_pielfanera_obser" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_pielfanera_obser ?>"/></td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">7. EXAMEN OSTEOMUSCULAR </span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td style="text-align:center"><strong>Maniobra semiológicas</strong></td>
<td style="text-align:center" colspan="2"><strong>Interpretación</strong></td>
<td><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="2"><strong>Movilidad Articular</strong></td>
<td style="text-align:center" colspan="3"><strong>Fuerza</strong></td>
</tr>
<tr>
<td colspan="3"><strong>Hombro</strong></td>
<td><strong>MMSS</strong></td>
<td style="text-align:center" colspan="2"><strong>
Normal<input type="radio" name="exaosteo_homb_movart" id="<?php echo $cod_historia_clinica ?>" value="Normal" <?php echo ($exaosteo_homb_movart=='Normal')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Anormal<input type="radio" name="exaosteo_homb_movart" id="<?php echo $cod_historia_clinica ?>" value="Anormal" <?php echo ($exaosteo_homb_movart=='Anormal')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="3"><strong>
Normal<input type="radio" name="exaosteo_homb_fuerza" id="<?php echo $cod_historia_clinica ?>" value="Normal" <?php echo ($exaosteo_homb_fuerza=='Normal')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Anormal<input type="radio" name="exaosteo_homb_fuerza" id="<?php echo $cod_historia_clinica ?>" value="Anormal" <?php echo ($exaosteo_homb_fuerza=='Anormal')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Maniobra Jobe</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_manjobe_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_manjobe_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_manjobe_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_manjobe_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_manjobe_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_manjobe_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_manjobe_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_manjobe_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_manjobe_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_manjobe_lat=='AM')?'checked':'' ?> ></strong></td>

<td><strong>MMII</strong></td>
<td style="text-align:center" colspan="2"><strong>
Normal<input type="radio" name="exaosteo_manjobe_movart" id="<?php echo $cod_historia_clinica ?>" value="Normal" <?php echo ($exaosteo_manjobe_movart=='Normal')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Anormal<input type="radio" name="exaosteo_manjobe_movart" id="<?php echo $cod_historia_clinica ?>" value="Anormal" <?php echo ($exaosteo_manjobe_movart=='Anormal')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="3"><strong>
Normal<input type="radio" name="exaosteo_manjobe_fuerza" id="<?php echo $cod_historia_clinica ?>" value="Normal" <?php echo ($exaosteo_manjobe_fuerza=='Normal')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Anormal<input type="radio" name="exaosteo_manjobe_fuerza" id="<?php echo $cod_historia_clinica ?>" value="Anormal" <?php echo ($exaosteo_manjobe_fuerza=='Anormal')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Maniobra de Yergason</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_manyega_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_manyega_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_manyega_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_manyega_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_manyega_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_manyega_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_manyega_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_manyega_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_manyega_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_manyega_lat=='AM')?'checked':'' ?> ></strong></td>

<td><strong>Columna</strong></td>
<td style="text-align:center" colspan="2"><strong>
Normal<input type="radio" name="exaosteo_manyega_movart" id="<?php echo $cod_historia_clinica ?>" value="Normal" <?php echo ($exaosteo_manyega_movart=='Normal')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Anormal<input type="radio" name="exaosteo_manyega_movart" id="<?php echo $cod_historia_clinica ?>" value="Anormal" <?php echo ($exaosteo_manyega_movart=='Anormal')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="3"><strong>
Normal<input type="radio" name="exaosteo_manyega_fuerza" id="<?php echo $cod_historia_clinica ?>" value="Normal" <?php echo ($exaosteo_manyega_fuerza=='Normal')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Anormal<input type="radio" name="exaosteo_manyega_fuerza" id="<?php echo $cod_historia_clinica ?>" value="Anormal" <?php echo ($exaosteo_manyega_fuerza=='Anormal')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Maniobra de Patte</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_manpatte_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_manpatte_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_manpatte_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_manpatte_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_manpatte_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_manpatte_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_manpatte_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_manpatte_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_manpatte_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_manpatte_lat=='AM')?'checked':'' ?> ></strong></td>

<td><strong>&nbsp;</strong></td>
<td colspan="2"><strong>&nbsp;</strong></td>
<td colspan="3"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td colspan="3"><strong>Codo</strong></td>
<td colspan="6"><strong>Mu&ntilde;eca</strong></td>
</tr>
<tr>
<td><strong>Prueba de Epicondilitis</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_epicond_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_epicond_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_epicond_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_epicond_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_epicond_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_epicond_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_epicond_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_epicond_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_epicond_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_epicond_lat=='AM')?'checked':'' ?> ></strong></td>

<td colspan="2"><strong>Phalen</strong></td>
<td style="text-align:center" colspan="2"><strong>
Pos<input type="radio" name="exaosteo_phalen_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_phalen_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_phalen_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_phalen_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="2"><strong>
Der<input type="radio" name="exaosteo_phalen_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_phalen_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_phalen_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_phalen_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_phalen_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_phalen_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Prueba de Epitrocleitis</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_epitro_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_epitro_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_epitro_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_epitro_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_epitro_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_epitro_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_epitro_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_epitro_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_epitro_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_epitro_lat=='AM')?'checked':'' ?> ></strong></td>

<td colspan="2"><strong>Finkelstein</strong></td>
<td style="text-align:center" colspan="2"><strong>
Pos<input type="radio" name="exaosteo_finkel_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_finkel_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_finkel_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_finkel_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="2"><strong>
Der<input type="radio" name="exaosteo_finkel_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_finkel_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_finkel_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_finkel_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_finkel_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_finkel_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Prueba de Thompson</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_thomp_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_thomp_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_thomp_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_thomp_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_thomp_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_thomp_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_thomp_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_thomp_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_thomp_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_thomp_lat=='AM')?'checked':'' ?> ></strong></td>

<td colspan="2"><strong>Tinel</strong></td>
<td style="text-align:center" colspan="2"><strong>
Pos<input type="radio" name="exaosteo_tinel_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_tinel_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_tinel_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_tinel_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="2"><strong>
Der<input type="radio" name="exaosteo_tinel_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_tinel_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_tinel_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_tinel_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_tinel_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_tinel_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td colspan="3"><strong>Lumbar</strong></td>
<td colspan="6"><strong>Miembro Inferior</strong></td>
</tr>
<tr>
<td><strong>Signo de Lasegue</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_laseg_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_laseg_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_laseg_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_laseg_sig=='Neg')?'checked':'' ?> ></strong></td>

<td>&nbsp;</td>
<td colspan="2"><strong>Signo del Cajón</strong></td>
<td style="text-align:center" colspan="2"><strong>
Pos<input type="radio" name="exaosteo_cajon_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_cajon_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_cajon_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_cajon_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="2"><strong>
Der<input type="radio" name="exaosteo_cajon_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_cajon_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_cajon_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_cajon_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_cajon_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_cajon_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Signo de Schober Flexión</strong></td>
<td><input style="text-align:center" class="input-block-level" name="exaosteo_flexion" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exaosteo_flexion ?>"/></td>
<td><strong>Cm</strong></td>
<td colspan="2"><strong>Signo del Bostezo</strong></td>
<td style="text-align:center" colspan="2"><strong>
Pos<input type="radio" name="exaosteo_bostezo_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_bostezo_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_bostezo_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_bostezo_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="2"><strong>
Der<input type="radio" name="exaosteo_bostezo_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_bostezo_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_bostezo_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_bostezo_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_bostezo_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_bostezo_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Signo de Schober </strong> <strong>Extensión</strong></td>
<td><input style="text-align:center" class="input-block-level" name="exaosteo_extension" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exaosteo_extension ?>"/></td>
<td><strong>Grados</strong></td>
<td colspan="2"><strong>Mc Murray</strong></td>
<td style="text-align:center" colspan="2"><strong>
Pos<input type="radio" name="exaosteo_mcmurray_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_mcmurray_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_mcmurray_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_mcmurray_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center" colspan="2"><strong>
Der<input type="radio" name="exaosteo_mcmurray_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_mcmurray_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_mcmurray_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_mcmurray_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_mcmurray_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_mcmurray_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td><strong>Signo de Bragard</strong></td>
<td style="text-align:center"><strong>
Pos<input type="radio" name="exaosteo_bragard_sig" id="<?php echo $cod_historia_clinica ?>" value="Pos" <?php echo ($exaosteo_bragard_sig=='Pos')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Neg<input type="radio" name="exaosteo_bragard_sig" id="<?php echo $cod_historia_clinica ?>" value="Neg" <?php echo ($exaosteo_bragard_sig=='Neg')?'checked':'' ?> ></strong></td>

<td style="text-align:center"><strong>
Der<input type="radio" name="exaosteo_bragard_lat" id="<?php echo $cod_historia_clinica ?>" value="Der" <?php echo ($exaosteo_bragard_lat=='Der')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Izq<input type="radio" name="exaosteo_bragard_lat" id="<?php echo $cod_historia_clinica ?>" value="Izq" <?php echo ($exaosteo_bragard_lat=='Izq')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exaosteo_bragard_lat" id="<?php echo $cod_historia_clinica ?>" value="AM" <?php echo ($exaosteo_bragard_lat=='AM')?'checked':'' ?> ></strong></td>
</tr>
<tr>
<td colspan="3"><strong>Cadera</strong></td>
<td colspan="6"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>Trendelemburg</strong></td>
<td style="text-align:center"><strong>
Positivo<input type="radio" name="exaosteo_tredelen" id="<?php echo $cod_historia_clinica ?>" value="Positivo" <?php echo ($exaosteo_tredelen=='Positivo')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
Negativo<input type="radio" name="exaosteo_tredelen" id="<?php echo $cod_historia_clinica ?>" value="Negativo" <?php echo ($exaosteo_tredelen=='Negativo')?'checked':'' ?> >
</strong></td>
<td></td>
<td colspan="6"></td>
</tr>
<tr><td colspan="9"><strong>Valoración de la Marcha</strong><input class="input-block-level" name="exaosteo_valmarcha" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exaosteo_valmarcha ?>"/></td></tr>
<tr><td colspan="9"><strong>Observaciones Generales:</strong><input class="input-block-level" name="exaosteo_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exaosteo_observ ?>"/></td></tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td colspan="3" bgcolor="#FAC090"><span style="color:#FF0000"><strong>8. PARACLÍNICOS Y VALORACIONES COMPLEMENTARIAS <em>N(Normal) &ndash; A(Anormal) &ndash; NR(No Realizado)</em></strong></span></td>
</tr>
<tr>
<td style="text-align:center"><strong>Grupo</strong></td>
<td style="text-align:center"><strong>Valores</strong></td>
<td style="text-align:center"><strong>Observaciones</strong></td>
</tr>
<tr>
<td><strong>Audiometría</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_audimet" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_audimet=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_audimet" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_audimet=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_audimet" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_audimet=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_audimet_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_audimet_observ ?>"/></td>
</tr>
<tr>
<td><strong>Visiometría / Optometría</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_visiomet" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_visiomet=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_visiomet" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_visiomet=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_visiomet" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_visiomet=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_visiomet_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_visiomet_observ ?>"/></td>
</tr>
<tr>
<td><strong>Rx de Tórax </strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_torax" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_torax=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_torax" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_torax=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_torax" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_torax=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_torax_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_torax_observ ?>"/></td>
</tr>
<tr>
<td><strong>Espirometría</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_espiro" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_espiro=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_espiro" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_espiro=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_espiro" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_espiro=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_espiro_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_espiro_observ ?>"/></td>
</tr>
<tr>
<td><strong>EKG</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_ekg" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_ekg=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_ekg" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_ekg=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_ekg" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_ekg=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_ekg_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_ekg_observ ?>"/></td>
</tr>
<tr>
<td><strong>Rx de Columna</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_rxcolum" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_rxcolum=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_rxcolum" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_rxcolum=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_rxcolum" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_rxcolum=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_rxcolum_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_rxcolum_observ ?>"/></td>
</tr>
<tr>
<td><strong>Otras pruebas complementarias</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_otrcomplement" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_otrcomplement=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_otrcomplement" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_otrcomplement=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_otrcomplement" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_otrcomplement=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_otrcomplement_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_otrcomplement_observ ?>"/></td>
</tr>
<tr>
<td><strong>Examen por Fisioterapia</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_fisiote" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_fisiote=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_fisiote" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_fisiote=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_fisiote" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_fisiote=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_fisiote_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_fisiote_observ ?>"/></td>
</tr>
<tr>
<td><strong>Laboratorios</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_lab" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_lab=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_lab" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_lab=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_lab" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_lab=='NR')?'checked':'' ?> ></strong></td>
<td><input class="input-block-level" name="paracli_lab_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_lab_observ ?>"/></td>
</tr>
<tr>
<td><strong>Otros</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="paracli_otro" id="<?php echo $cod_historia_clinica ?>" value="N" <?php echo ($paracli_otro=='N')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_otro" id="<?php echo $cod_historia_clinica ?>" value="A" <?php echo ($paracli_otro=='A')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
NR<input type="radio" name="paracli_otro" id="<?php echo $cod_historia_clinica ?>" value="NR" <?php echo ($paracli_otro=='NR')?'checked':'' ?> ></strong></td>
<td><strong>Cuales:</strong><input class="input-block-level" name="paracli_otro_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $paracli_otro_observ ?>"/></td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#FAC090" align="center">
    			<strong>
BUSCAR CIE 10: <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/>
<input type="hidden" id="valor_campos" name="valor_campos" value="<?php echo $cod_historia_clinica ?>-<?php echo $cod_cliente ?>-<?php echo $pagina_local ?>"/>
    			</strong>
<script type="text/javascript">
function hacer_busqueda() {
var xmlhttp;

var valor_buscar=document.getElementById('busqueda').value;
var valor_campos=document.getElementById('valor_campos').value;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_cie10_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&valor_campos="+valor_campos);
}
</script>
<div id="logo_cargador"></div>
    		</td>
    	</tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<!--
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th valign="middle"><a href="#" class="btn-link btn_cie10" data-toggle="modal" data-target="#listado_cie10_modal">LISTADO CIE 10</a></th>
        </tr>
    </thead>
</table>
<div class="modal fade" id="ventana_modal_cie10_id" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title">LISTADO CIE10</div>
            <div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
        </div>
    </div>
</div>
-->
<!-- /////////////////////////////////////////////////// -->

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table border="1" class="table table-striped">
<thead>
<tr>
<td style="text-align:center"><strong>CIE 10</strong></td>
<td style="text-align:center"><strong>Diágnostico</strong></td>
<td style="text-align:center"><strong>Impresión Diagnostica</strong></td>
<td style="text-align:center"><strong>Confirmado Nuevo</strong></td>
<td style="text-align:center"><strong>Confirmado Repetido</strong></td>
<td style="text-align:center"><strong>DIÁGNOSTICO PRINCIPAL</strong></td>
<th>Elim</th>
</tr>
</thead>
<tbody>
<?php
$tab                      = 'tbl15_cie10diag';
$campo                    = 'cod_cie10diag';
$tipo                     = 'eliminar';

$obtener_cie10diag = "SELECT * FROM tbl15_cie10diag WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_cie10diag);

while ($info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag)) {
$cod_cie10diag      = $info_cie10diag['cod_cie10diag'];
$cie10_cod          = $info_cie10diag['cie10_cod'];
$cie10_diag         = $info_cie10diag['cie10_diag'];
$cie10_impdiag      = $info_cie10diag['cie10_impdiag'];
$cie10_confirnuev   = $info_cie10diag['cie10_confirnuev'];
$cie10_confirepet   = $info_cie10diag['cie10_confirepet'];
$cie10_diagprinc    = $info_cie10diag['cie10_diagprinc'];
?>
<tr id="tr<?php echo $cod_cie10diag;?>">
<td id="cod_cie10diag<?php echo $cod_cie10diag;?>"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_cie10diag', <?php echo $cod_cie10diag;?>)" class="input-block-level" id="<?php echo $cod_cie10diag;?>" value="<?php echo $cie10_cod;?>" size="15"></td>
<td id="cie10_diag<?php echo $cod_cie10diag;?>"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cie10_diag', <?php echo $cod_cie10diag;?>)" class="input-block-level" id="<?php echo $cod_cie10diag;?>" value="<?php echo $cie10_diag;?>" size="200"></td>
<td id="cie10_impdiag<?php echo $cod_cie10diag;?>"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cie10_impdiag', <?php echo $cod_cie10diag;?>)" class="input-block-level" id="<?php echo $cod_cie10diag;?>" value="<?php echo $cie10_impdiag;?>"></td>
<td id="cie10_confirnuev<?php echo $cod_cie10diag;?>"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cie10_confirnuev', <?php echo $cod_cie10diag;?>)" class="input-block-level" id="<?php echo $cod_cie10diag;?>" value="<?php echo $cie10_confirnuev;?>"></td>
<td id="cie10_confirepet<?php echo $cod_cie10diag;?>"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cie10_confirepet', <?php echo $cod_cie10diag;?>)" class="input-block-level" id="<?php echo $cod_cie10diag;?>" value="<?php echo $cie10_confirepet;?>"></td>
<td id="cie10_diagprinc<?php echo $cod_cie10diag;?>"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cie10_diagprinc', <?php echo $cod_cie10diag;?>)" class="input-block-level" id="<?php echo $cod_cie10diag;?>" value="<?php echo $cie10_diagprinc;?>"></td>
<td class="service_list" id="cod_cie10diag<?php echo $cod_cie10diag ?>" data="<?php echo $cod_cie10diag ?>"><a class="eliminar" id="cod_cie10diag<?php echo $cod_cie10diag ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
</tr id="tr<?php echo $cod_cie10diag;?>">
<?php } ?>
</tbody>
</table>
</div>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090" style="text-align:center"><strong>En caso se presentar problemas respiratorios, por favor marque "SI"</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EN LOS ULTIMOS 14 DÍAS HA PRESENTADO ESTOS SÍNTOMAS </strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090">
<strong> Mostrar en historia clinica
SI<input type="radio" name="sintoma_covid19" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($sintoma_covid19=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="sintoma_covid19" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($sintoma_covid19=='NO')?'checked':'' ?> >
	</strong>
    </td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090">
<strong> Marcar todo en 
SI<input type="radio" name="sintoma_covid19_todo" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($sintoma_covid19_todo=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="sintoma_covid19_todo" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($sintoma_covid19_todo=='NO')?'checked':'' ?> >
	</strong>
    </td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:left" width="300px"><strong>FIEBRE MAYOR A 38 °C</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_fiebre" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_fiebre=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_fiebre" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_fiebre=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>ESCALOFRIOS</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_escolofrio" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_escolofrio=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_escolofrio" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_escolofrio=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>CANSANCIO</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_cansansio" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_cansansio=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_cansansio" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_cansansio=='NO')?'checked':'' ?> >
	</strong></td>
  </tr>
  <tr>
    <td style="text-align:left" width="300px"><strong>MALESTAR GENERAL</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_malestar_gral" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_malestar_gral=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_malestar_gral" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_malestar_gral=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>FATIGA</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_fatiga" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_fatiga=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_fatiga" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_fatiga=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>TOS SECA O PRODUCTIVA</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_tos_seca" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_tos_seca=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_tos_seca" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_tos_seca=='NO')?'checked':'' ?> >
	</strong></td>
  </tr>
  <tr>
    <td style="text-align:left" width="300px"><strong>CEFALEA (DOLOR DE CABEZA)</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_cefaleas" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_cefaleas=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_cefaleas" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_cefaleas=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>CONGESTION NASAL</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_congestion_nasal" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_congestion_nasal=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_congestion_nasal" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_congestion_nasal=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>RINORREA (ESCURRIMIENTO NASAL)</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_secrecion_nasal" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_secrecion_nasal=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_secrecion_nasal" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_secrecion_nasal=='NO')?'checked':'' ?> >
	</strong></td>
  </tr>
  <tr>
    <td style="text-align:left" width="300px"><strong>DOLOR DE GARGANTA</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_dorlor_garganta" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_dorlor_garganta=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_dorlor_garganta" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_dorlor_garganta=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>DIARREA</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_diarrea" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_diarrea=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_diarrea" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_diarrea=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>DIFICULTAD RESPIRATORIA</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_dificul_resp" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_dificul_resp=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_dificul_resp" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_dificul_resp=='NO')?'checked':'' ?> >
	</strong></td>
  </tr>
  <tr>
    <td style="text-align:left" width="300px"><strong>INAPETENCIA</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_inapetencia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_inapetencia=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_inapetencia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_inapetencia=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>ANOSMIA (PERDIDA DEL OLFATO)</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_perdida_olfato" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_perdida_olfato=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_perdida_olfato" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_perdida_olfato=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>DISGEUSIA (PERDIDA EL GUSTO)</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_perdida_gusto" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_perdida_gusto=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_perdida_gusto" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_perdida_gusto=='NO')?'checked':'' ?> >
	</strong></td>
  </tr>
  <tr>
    <td style="text-align:left" width="300px"><strong>DEDOS DE COVID(MORETONES EN CUALQUIER SITIO DEL CUERPO</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_dedos_covid" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_dedos_covid=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_dedos_covid" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_dedos_covid=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>DOLOR TORÁCICO</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_dolor_pecho" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_dolor_pecho=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_dolor_pecho" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_dolor_pecho=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>CONFUSION</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_confusion" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_confusion=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_confusion" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_confusion=='NO')?'checked':'' ?> >
	</strong></td>
  </tr>
  <tr>
    <td style="text-align:left" width="300px"><strong>COLORACION AZULADA EN LABIOS O EL ROSTRO</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_color_azul_labios" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_color_azul_labios=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_color_azul_labios" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_color_azul_labios=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>ARTRALGIAS (Dolor de articulaciones)</strong></td>
    <td style="text-align:center">
SI<input type="radio" name="covid19_artralgia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_artralgia=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_artralgia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_artralgia=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:left" width="300px"><strong>MIALGIAS (Dolor muscular)</strong></td>
    <td style="text-align:center">
SI<input type="radio" name="covid19_mialgia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_mialgia=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_mialgia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_mialgia=='NO')?'checked':'' ?> >
    </td>
  </tr>

  <tr>
    <td style="text-align:left" width="300px"><strong>ASTENIA (Debilidad muscular)</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_astenia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_astenia=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_astenia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_astenia=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>ODINOFAGIA (Dolor al tragar)</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_odinofagia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_odinofagia=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_odinofagia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_odinofagia=='NO')?'checked':'' ?> >
    </strong></td>
    <td style="text-align:left" width="300px"><strong>IRRITACIÓN O ARDOR EN LOS OJOS</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_irritacion_ardor_ojos" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_irritacion_ardor_ojos=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_irritacion_ardor_ojos" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_irritacion_ardor_ojos=='NO')?'checked':'' ?> >
    </strong></td>
  </tr>

  <tr>
    <td style="text-align:left" width="300px"><strong>NAUSEAS O VOMITO</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_nauseas" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_nauseas=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_nauseas" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_nauseas=='NO')?'checked':'' ?> >
	</strong></td>
    <td style="text-align:left" width="300px"><strong>¿HA ESTADO EN CONTACTO CON PERSONAS SOSPECHOSAS O CONFIRMADAS POR COVID-19?</strong></td>
    <td style="text-align:center"><strong>
SI<input type="radio" name="covid19_contacto_person_sospech_covid" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($covid19_contacto_person_sospech_covid=='SI')?'checked':'' ?>/>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="covid19_contacto_person_sospech_covid" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($covid19_contacto_person_sospech_covid=='NO')?'checked':'' ?> >
    </strong></td>
    <td style="text-align:left"></td>
    <td style="text-align:center"></td>
  </tr>
</table>


<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
    	<tr>
    	<td style="text-align:left" width="400px"><strong>¿CUÁNTO TIEMPO TIENE CON SU MOLESTIA ACTUAL?</strong></td>
		<td style="text-align:center">
			<select name="nombre_tiempo_molestia_actual_covid" id="<?php echo $cod_historia_clinica ?>">
				<?php if (isset($nombre_tiempo_molestia_actual_covid)) { echo "<option value='' >Selecione</option>";
				} else { echo  "<option value='' selected >Selecione</option>"; }
				$consulta2_sql = ("SELECT cod_tiempo_molestia_actual_covid, nombre_tiempo_molestia_actual_covid FROM tbl15_tiempo_molestia_actual_covid ORDER BY cod_tiempo_molestia_actual_covid ASC");
				$consulta2 = mysqli_query($conectar, $consulta2_sql);
				while ($datos2 = mysqli_fetch_assoc($consulta2)) {
				if(isset($nombre_tiempo_molestia_actual_covid) AND $nombre_tiempo_molestia_actual_covid == $datos2['nombre_tiempo_molestia_actual_covid']) {
				$seleccionado = "selected"; } else { $seleccionado = ""; }
				$codigo = $datos2['nombre_tiempo_molestia_actual_covid'];
				$nombre = $datos2['nombre_tiempo_molestia_actual_covid'];
				echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			</select>
		</td>
		</tr>
</tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
    	<tr>
    		<td style="text-align:center"><strong>TEMPERATURA</strong></td>
    		<td style="text-align:center">
				<select name="nombre_temperatura_covid" id="<?php echo $cod_historia_clinica ?>">
					<?php if (isset($nombre_temperatura_covid)) { echo "<option value='' >Selecione</option>";
					} else { echo  "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_temperatura_covid, nombre_temperatura_covid FROM tbl15_temperatura_covid ORDER BY cod_temperatura_covid ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_temperatura_covid) AND $nombre_temperatura_covid == $datos2['nombre_temperatura_covid']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_temperatura_covid'];
					$nombre = $datos2['nombre_temperatura_covid'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
    		</td>

	    	<td style="text-align:left"><strong>PULSO</strong></td>
			<td style="text-align:center">
				<select name="nombre_pulso_covid" id="<?php echo $cod_historia_clinica ?>">
					<?php if (isset($nombre_pulso_covid)) { echo "<option value='' >Selecione</option>";
					} else { echo  "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_pulso_covid, nombre_pulso_covid FROM tbl15_pulso_covid ORDER BY cod_pulso_covid ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_pulso_covid) AND $nombre_pulso_covid == $datos2['nombre_pulso_covid']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_pulso_covid'];
					$nombre = $datos2['nombre_pulso_covid'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>

	    	<td style="text-align:left"><strong>SATURACIÓN</strong></td>
			<td style="text-align:center">
				<select name="nombre_saturacion_covid" id="<?php echo $cod_historia_clinica ?>">
					<?php if (isset($nombre_saturacion_covid)) { echo "<option value='' >Selecione</option>";
					} else { echo  "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_saturacion_covid, nombre_tbl15_saturacion_covidFROM tbl15_tbl15_saturacion_covidORDER BY cod_tbl15_saturacion_covidASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_saturacion_covid) AND $nombre_tbl15_saturacion_covid== $datos2['nombre_saturacion_covid']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_saturacion_covid'];
					$nombre = $datos2['nombre_saturacion_covid'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>

    	</tr>
    	</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>CONTROL</strong></td></tr></tbody>
</table>
<table align="justify" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
    	<tr>
    		<td><textarea rows="5" name="control_examen" id="<?php echo $cod_historia_clinica ?>" class="input-block-level"><?php echo $control_examen ?></textarea></td>
    	</tr>
    </tbody>
</table>

<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="justify" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
    	<tr>
    		<td><?php echo $info_histclinic_emp ?></td>
    	</tr>
    </tbody>
</table>
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
<hr>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="fecha_dmy" value="<?php echo $fecha_hoy ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
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
<!-- ***************************************************************************************************************************** -->
<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_cie10diag = $(this).parent().attr('data');
        var dataString = 'llave='+cod_cie10diag+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_cie10diag+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_cie10diag'+cod_cie10diag).fadeOut("slow");
                $('#cie10_diag'+cod_cie10diag).fadeOut("slow");
                $('#cie10_impdiag'+cod_cie10diag).fadeOut("slow");
                $('#cie10_confirnuev'+cod_cie10diag).fadeOut("slow");
                $('#cie10_confirepet'+cod_cie10diag).fadeOut("slow");
                $('#cie10_diagprinc'+cod_cie10diag).fadeOut("slow");
                $('#tr'+cod_cie10diag).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

<script type="text/javascript">
$(function() {
$("#cod_grupo_area_cargo").autocomplete({
source: "autocompletar_grupo_area_cargo_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();

$('#cod_grupo_area_cargo').val(ui.item.cod_grupo_area_cargo);
$('#nombre_grupo_area_cargo').val(ui.item.nombre_grupo_area_cargo);
$('#cod_grupo_area').val(ui.item.cod_grupo_area);

$('#clasrieg_fis1_ruid').val(ui.item.clasrieg_fis1_ruid);
$('#clasrieg_fis1_ilum').val(ui.item.clasrieg_fis1_ilum);
$('#clasrieg_fis1_noionic').val(ui.item.clasrieg_fis1_noionic);
$('#clasrieg_fis1_vibra').val(ui.item.clasrieg_fis1_vibra);
$('#clasrieg_fis1_tempextrem').val(ui.item.clasrieg_fis1_tempextrem);
$('#clasrieg_fis1_cambpres').val(ui.item.clasrieg_fis1_cambpres);
$('#clasrieg_quim1_gasvapor').val(ui.item.clasrieg_quim1_gasvapor);
$('#clasrieg_quim1_aeroliq').val(ui.item.clasrieg_quim1_aeroliq);
$('#clasrieg_quim1_solid').val(ui.item.clasrieg_quim1_solid);
$('#clasrieg_quim1_liquid').val(ui.item.clasrieg_quim1_liquid);
$('#clasrieg_biolog1_viru').val(ui.item.clasrieg_biolog1_viru);
$('#clasrieg_biolog1_bacter').val(ui.item.clasrieg_biolog1_bacter);
$('#clasrieg_biolog1_parasi').val(ui.item.clasrieg_biolog1_parasi);
$('#clasrieg_biolog1_morde').val(ui.item.clasrieg_biolog1_morde);
$('#clasrieg_biolog1_picad').val(ui.item.clasrieg_biolog1_picad);
$('#clasrieg_biolog1_hongo').val(ui.item.clasrieg_biolog1_hongo);
$('#clasrieg_ergo1_trabestat').val(ui.item.clasrieg_ergo1_trabestat);
$('#clasrieg_ergo1_esfuerfis').val(ui.item.clasrieg_ergo1_esfuerfis);
$('#clasrieg_ergo1_carga').val(ui.item.clasrieg_ergo1_carga);
$('#clasrieg_ergo1_postforz').val(ui.item.clasrieg_ergo1_postforz);
$('#clasrieg_ergo1_movrepet').val(ui.item.clasrieg_ergo1_movrepet);
$('#clasrieg_ergo1_jortrab').val(ui.item.clasrieg_ergo1_jortrab);
$('#clasrieg_psi1_monoto').val(ui.item.clasrieg_psi1_monoto);
$('#clasrieg_psi1_relhuman').val(ui.item.clasrieg_psi1_relhuman);
$('#clasrieg_psi1_contentarea').val(ui.item.clasrieg_psi1_contentarea);
$('#clasrieg_psi1_orgtiemptrab').val(ui.item.clasrieg_psi1_orgtiemptrab);
$('#clasrieg_segur1_mecanic').val(ui.item.clasrieg_segur1_mecanic);
$('#clasrieg_segur1_electri').val(ui.item.clasrieg_segur1_electri);
$('#clasrieg_segur1_locat').val(ui.item.clasrieg_segur1_locat);
$('#clasrieg_segur1_fisiquim').val(ui.item.clasrieg_segur1_fisiquim);
$('#clasrieg_segur1_public').val(ui.item.clasrieg_segur1_public);
$('#clasrieg_segur1_espconfi').val(ui.item.clasrieg_segur1_espconfi);
$('#clasrieg_segur1_trabaltura').val(ui.item.clasrieg_segur1_trabaltura);
$('#clasrieg_observ1_otro').val(ui.item.clasrieg_observ1_otro);

$('#clasrieg_segur1_sismo').val(ui.item.clasrieg_segur1_sismo);
$('#clasrieg_segur1_delincuenciacomun').val(ui.item.clasrieg_segur1_delincuenciacomun);
$('#clasrieg_segur1_accitransito').val(ui.item.clasrieg_segur1_accitransito);
$('#clasrieg_segur1_caidaobjetos').val(ui.item.clasrieg_segur1_caidaobjetos);
$('#clasrieg_segur1_puestotrabdesorden').val(ui.item.clasrieg_segur1_puestotrabdesorden);

$('#dat_ocupa_visu1').val(ui.item.dat_ocupa_visu1);
$('#dat_ocupa_audi1').val(ui.item.dat_ocupa_audi1);
$('#dat_ocupa_resp1').val(ui.item.dat_ocupa_resp1);
$('#dat_ocupa_cabeza1').val(ui.item.dat_ocupa_cabeza1);
$('#dat_ocupa_manos1').val(ui.item.dat_ocupa_manos1);
$('#dat_ocupa_tronco1').val(ui.item.dat_ocupa_tronco1);
$('#dat_ocupa_pies1').val(ui.item.dat_ocupa_pies1);
$('#dat_ocupa_altu1').val(ui.item.dat_ocupa_altu1);

var clasrieg_fis1_ruid = $('#clasrieg_fis1_ruid').val();
var clasrieg_fis1_ilum = $('#clasrieg_fis1_ilum').val();
var clasrieg_fis1_noionic = $('#clasrieg_fis1_noionic').val();
var clasrieg_fis1_vibra = $('#clasrieg_fis1_vibra').val();
var clasrieg_fis1_tempextrem = $('#clasrieg_fis1_tempextrem').val();
var clasrieg_fis1_cambpres = $('#clasrieg_fis1_cambpres').val();
var clasrieg_quim1_gasvapor = $('#clasrieg_quim1_gasvapor').val();
var clasrieg_quim1_aeroliq = $('#clasrieg_quim1_aeroliq').val();
var clasrieg_quim1_solid = $('#clasrieg_quim1_solid').val();
var clasrieg_quim1_liquid = $('#clasrieg_quim1_liquid').val();
var clasrieg_biolog1_viru = $('#clasrieg_biolog1_viru').val();
var clasrieg_biolog1_bacter = $('#clasrieg_biolog1_bacter').val();
var clasrieg_biolog1_parasi = $('#clasrieg_biolog1_parasi').val();
var clasrieg_biolog1_morde = $('#clasrieg_biolog1_morde').val();
var clasrieg_biolog1_picad = $('#clasrieg_biolog1_picad').val();
var clasrieg_biolog1_hongo = $('#clasrieg_biolog1_hongo').val();
var clasrieg_ergo1_trabestat = $('#clasrieg_ergo1_trabestat').val();
var clasrieg_ergo1_esfuerfis = $('#clasrieg_ergo1_esfuerfis').val();
var clasrieg_ergo1_carga = $('#clasrieg_ergo1_carga').val();
var clasrieg_ergo1_postforz = $('#clasrieg_ergo1_postforz').val();
var clasrieg_ergo1_movrepet = $('#clasrieg_ergo1_movrepet').val();
var clasrieg_ergo1_jortrab = $('#clasrieg_ergo1_jortrab').val();
var clasrieg_psi1_monoto = $('#clasrieg_psi1_monoto').val();
var clasrieg_psi1_relhuman = $('#clasrieg_psi1_relhuman').val();
var clasrieg_psi1_contentarea = $('#clasrieg_psi1_contentarea').val();
var clasrieg_psi1_orgtiemptrab = $('#clasrieg_psi1_orgtiemptrab').val();
var clasrieg_segur1_mecanic = $('#clasrieg_segur1_mecanic').val();
var clasrieg_segur1_electri = $('#clasrieg_segur1_electri').val();
var clasrieg_segur1_locat = $('#clasrieg_segur1_locat').val();
var clasrieg_segur1_fisiquim = $('#clasrieg_segur1_fisiquim').val();
var clasrieg_segur1_public = $('#clasrieg_segur1_public').val();
var clasrieg_segur1_espconfi = $('#clasrieg_segur1_espconfi').val();
var clasrieg_segur1_trabaltura = $('#clasrieg_segur1_trabaltura').val();
var clasrieg_observ1_otro = $('#clasrieg_observ1_otro').val();

var clasrieg_segur1_sismo = $('#clasrieg_segur1_sismo').val();
var clasrieg_segur1_delincuenciacomun = $('#clasrieg_segur1_delincuenciacomun').val();
var clasrieg_segur1_accitransito = $('#clasrieg_segur1_accitransito').val();
var clasrieg_segur1_caidaobjetos = $('#clasrieg_segur1_caidaobjetos').val();
var clasrieg_segur1_puestotrabdesorden = $('#clasrieg_segur1_puestotrabdesorden').val();

var dat_ocupa_visu1 = $('#dat_ocupa_visu1').val();
var dat_ocupa_audi1 = $('#dat_ocupa_audi1').val();
var dat_ocupa_resp1 = $('#dat_ocupa_resp1').val();
var dat_ocupa_cabeza1 = $('#dat_ocupa_cabeza1').val();
var dat_ocupa_manos1 = $('#dat_ocupa_manos1').val();
var dat_ocupa_tronco1 = $('#dat_ocupa_tronco1').val();
var dat_ocupa_pies1 = $('#dat_ocupa_pies1').val();
var dat_ocupa_altu1 = $('#dat_ocupa_altu1').val();

if (clasrieg_fis1_ruid=='S') { $('#clasrieg_fis1_ruid').val('S'); $('#clasrieg_fis1_ruid').prop('checked',true); } else { $('#clasrieg_fis1_ruid').val('N'); $('#clasrieg_fis1_ruid').prop('checked',false); } 
if (clasrieg_fis1_ilum=='S') { $('#clasrieg_fis1_ilum').val('S'); $('#clasrieg_fis1_ilum').prop('checked',true); } else { $('#clasrieg_fis1_ilum').val('N'); $('#clasrieg_fis1_ilum').prop('checked',false); } 
if (clasrieg_fis1_noionic=='S') { $('#clasrieg_fis1_noionic').val('S'); $('#clasrieg_fis1_noionic').prop('checked',true); } else { $('#clasrieg_fis1_noionic').val('N'); $('#clasrieg_fis1_noionic').prop('checked',false); } 
if (clasrieg_fis1_vibra=='S') { $('#clasrieg_fis1_vibra').val('S'); $('#clasrieg_fis1_vibra').prop('checked',true); } else { $('#clasrieg_fis1_vibra').val('N'); $('#clasrieg_fis1_vibra').prop('checked',false); } 
if (clasrieg_fis1_tempextrem=='S') { $('#clasrieg_fis1_tempextrem').val('S'); $('#clasrieg_fis1_tempextrem').prop('checked',true); } else { $('#clasrieg_fis1_tempextrem').val('N'); $('#clasrieg_fis1_tempextrem').prop('checked',false); } 
if (clasrieg_fis1_cambpres=='S') { $('#clasrieg_fis1_cambpres').val('S'); $('#clasrieg_fis1_cambpres').prop('checked',true); } else { $('#clasrieg_fis1_cambpres').val('N'); $('#clasrieg_fis1_cambpres').prop('checked',false); } 
if (clasrieg_quim1_gasvapor=='S') { $('#clasrieg_quim1_gasvapor').val('S'); $('#clasrieg_quim1_gasvapor').prop('checked',true); } else { $('#clasrieg_quim1_gasvapor').val('N'); $('#clasrieg_quim1_gasvapor').prop('checked',false); } 
if (clasrieg_quim1_aeroliq=='S') { $('#clasrieg_quim1_aeroliq').val('S'); $('#clasrieg_quim1_aeroliq').prop('checked',true); } else { $('#clasrieg_quim1_aeroliq').val('N'); $('#clasrieg_quim1_aeroliq').prop('checked',false); } 
if (clasrieg_quim1_solid=='S') { $('#clasrieg_quim1_solid').val('S'); $('#clasrieg_quim1_solid').prop('checked',true); } else { $('#clasrieg_quim1_solid').val('N'); $('#clasrieg_quim1_solid').prop('checked',false); } 
if (clasrieg_quim1_liquid=='S') { $('#clasrieg_quim1_liquid').val('S'); $('#clasrieg_quim1_liquid').prop('checked',true); } else { $('#clasrieg_quim1_liquid').val('N'); $('#clasrieg_quim1_liquid').prop('checked',false); } 
if (clasrieg_biolog1_viru=='S') { $('#clasrieg_biolog1_viru').val('S'); $('#clasrieg_biolog1_viru').prop('checked',true); } else { $('#clasrieg_biolog1_viru').val('N'); $('#clasrieg_biolog1_viru').prop('checked',false); } 
if (clasrieg_biolog1_bacter=='S') { $('#clasrieg_biolog1_bacter').val('S'); $('#clasrieg_biolog1_bacter').prop('checked',true); } else { $('#clasrieg_biolog1_bacter').val('N'); $('#clasrieg_biolog1_bacter').prop('checked',false); } 
if (clasrieg_biolog1_parasi=='S') { $('#clasrieg_biolog1_parasi').val('S'); $('#clasrieg_biolog1_parasi').prop('checked',true); } else { $('#clasrieg_biolog1_parasi').val('N'); $('#clasrieg_biolog1_parasi').prop('checked',false); } 
if (clasrieg_biolog1_morde=='S') { $('#clasrieg_biolog1_morde').val('S'); $('#clasrieg_biolog1_morde').prop('checked',true); } else { $('#clasrieg_biolog1_morde').val('N'); $('#clasrieg_biolog1_morde').prop('checked',false); } 
if (clasrieg_biolog1_picad=='S') { $('#clasrieg_biolog1_picad').val('S'); $('#clasrieg_biolog1_picad').prop('checked',true); } else { $('#clasrieg_biolog1_picad').val('N'); $('#clasrieg_biolog1_picad').prop('checked',false); } 
if (clasrieg_biolog1_hongo=='S') { $('#clasrieg_biolog1_hongo').val('S'); $('#clasrieg_biolog1_hongo').prop('checked',true); } else { $('#clasrieg_biolog1_hongo').val('N'); $('#clasrieg_biolog1_hongo').prop('checked',false); } 
if (clasrieg_ergo1_trabestat=='S') { $('#clasrieg_ergo1_trabestat').val('S'); $('#clasrieg_ergo1_trabestat').prop('checked',true); } else { $('#clasrieg_ergo1_trabestat').val('N'); $('#clasrieg_ergo1_trabestat').prop('checked',false); } 
if (clasrieg_ergo1_esfuerfis=='S') { $('#clasrieg_ergo1_esfuerfis').val('S'); $('#clasrieg_ergo1_esfuerfis').prop('checked',true); } else { $('#clasrieg_ergo1_esfuerfis').val('N'); $('#clasrieg_ergo1_esfuerfis').prop('checked',false); } 
if (clasrieg_ergo1_carga=='S') { $('#clasrieg_ergo1_carga').val('S'); $('#clasrieg_ergo1_carga').prop('checked',true); } else { $('#clasrieg_ergo1_carga').val('N'); $('#clasrieg_ergo1_carga').prop('checked',false); } 
if (clasrieg_ergo1_postforz=='S') { $('#clasrieg_ergo1_postforz').val('S'); $('#clasrieg_ergo1_postforz').prop('checked',true); } else { $('#clasrieg_ergo1_postforz').val('N'); $('#clasrieg_ergo1_postforz').prop('checked',false); } 
if (clasrieg_ergo1_movrepet=='S') { $('#clasrieg_ergo1_movrepet').val('S'); $('#clasrieg_ergo1_movrepet').prop('checked',true); } else { $('#clasrieg_ergo1_movrepet').val('N'); $('#clasrieg_ergo1_movrepet').prop('checked',false); } 
if (clasrieg_ergo1_jortrab=='S') { $('#clasrieg_ergo1_jortrab').val('S'); $('#clasrieg_ergo1_jortrab').prop('checked',true); } else { $('#clasrieg_ergo1_jortrab').val('N'); $('#clasrieg_ergo1_jortrab').prop('checked',false); } 
if (clasrieg_psi1_monoto=='S') { $('#clasrieg_psi1_monoto').val('S'); $('#clasrieg_psi1_monoto').prop('checked',true); } else { $('#clasrieg_psi1_monoto').val('N'); $('#clasrieg_psi1_monoto').prop('checked',false); } 
if (clasrieg_psi1_relhuman=='S') { $('#clasrieg_psi1_relhuman').val('S'); $('#clasrieg_psi1_relhuman').prop('checked',true); } else { $('#clasrieg_psi1_relhuman').val('N'); $('#clasrieg_psi1_relhuman').prop('checked',false); } 
if (clasrieg_psi1_contentarea=='S') { $('#clasrieg_psi1_contentarea').val('S'); $('#clasrieg_psi1_contentarea').prop('checked',true); } else { $('#clasrieg_psi1_contentarea').val('N'); $('#clasrieg_psi1_contentarea').prop('checked',false); } 
if (clasrieg_psi1_orgtiemptrab=='S') { $('#clasrieg_psi1_orgtiemptrab').val('S'); $('#clasrieg_psi1_orgtiemptrab').prop('checked',true); } else { $('#clasrieg_psi1_orgtiemptrab').val('N'); $('#clasrieg_psi1_orgtiemptrab').prop('checked',false); } 
if (clasrieg_segur1_mecanic=='S') { $('#clasrieg_segur1_mecanic').val('S'); $('#clasrieg_segur1_mecanic').prop('checked',true); } else { $('#clasrieg_segur1_mecanic').val('N'); $('#clasrieg_segur1_mecanic').prop('checked',false); } 
if (clasrieg_segur1_electri=='S') { $('#clasrieg_segur1_electri').val('S'); $('#clasrieg_segur1_electri').prop('checked',true); } else { $('#clasrieg_segur1_electri').val('N'); $('#clasrieg_segur1_electri').prop('checked',false); } 
if (clasrieg_segur1_locat=='S') { $('#clasrieg_segur1_locat').val('S'); $('#clasrieg_segur1_locat').prop('checked',true); } else { $('#clasrieg_segur1_locat').val('N'); $('#clasrieg_segur1_locat').prop('checked',false); } 
if (clasrieg_segur1_fisiquim=='S') { $('#clasrieg_segur1_fisiquim').val('S'); $('#clasrieg_segur1_fisiquim').prop('checked',true); } else { $('#clasrieg_segur1_fisiquim').val('N'); $('#clasrieg_segur1_fisiquim').prop('checked',false); } 
if (clasrieg_segur1_public=='S') { $('#clasrieg_segur1_public').val('S'); $('#clasrieg_segur1_public').prop('checked',true); } else { $('#clasrieg_segur1_public').val('N'); $('#clasrieg_segur1_public').prop('checked',false); } 
if (clasrieg_segur1_espconfi=='S') { $('#clasrieg_segur1_espconfi').val('S'); $('#clasrieg_segur1_espconfi').prop('checked',true); } else { $('#clasrieg_segur1_espconfi').val('N'); $('#clasrieg_segur1_espconfi').prop('checked',false); } 
if (clasrieg_segur1_trabaltura=='S') { $('#clasrieg_segur1_trabaltura').val('S'); $('#clasrieg_segur1_trabaltura').prop('checked',true); } else { $('#clasrieg_segur1_trabaltura').val('N'); $('#clasrieg_segur1_trabaltura').prop('checked',false); } 
if (clasrieg_observ1_otro=='S') { $('#clasrieg_observ1_otro').val('S'); $('#clasrieg_observ1_otro').prop('checked',true); } else { $('#clasrieg_observ1_otro').val('N'); $('#clasrieg_observ1_otro').prop('checked',false); } 

if (clasrieg_segur1_sismo=='S') { $('#clasrieg_segur1_sismo').val('S'); $('#clasrieg_segur1_sismo').prop('checked',true); } else { $('#clasrieg_segur1_sismo').val('N'); $('#clasrieg_segur1_sismo').prop('checked',false); } 
if (clasrieg_segur1_delincuenciacomun=='S') { $('#clasrieg_segur1_delincuenciacomun').val('S'); $('#clasrieg_segur1_delincuenciacomun').prop('checked',true); } else { $('#clasrieg_segur1_delincuenciacomun').val('N'); $('#clasrieg_segur1_delincuenciacomun').prop('checked',false); } 
if (clasrieg_segur1_accitransito=='S') { $('#clasrieg_segur1_accitransito').val('S'); $('#clasrieg_segur1_accitransito').prop('checked',true); } else { $('#clasrieg_segur1_accitransito').val('N'); $('#clasrieg_segur1_accitransito').prop('checked',false); } 
if (clasrieg_segur1_caidaobjetos=='S') { $('#clasrieg_segur1_caidaobjetos').val('S'); $('#clasrieg_segur1_caidaobjetos').prop('checked',true); } else { $('#clasrieg_segur1_caidaobjetos').val('N'); $('#clasrieg_segur1_caidaobjetos').prop('checked',false); } 
if (clasrieg_segur1_puestotrabdesorden=='S') { $('#clasrieg_segur1_puestotrabdesorden').val('S'); $('#clasrieg_segur1_puestotrabdesorden').prop('checked',true); } else { $('#clasrieg_segur1_puestotrabdesorden').val('N'); $('#clasrieg_segur1_puestotrabdesorden').prop('checked',false); } 

if (dat_ocupa_visu1=='S') { $('#dat_ocupa_visu1').val('S'); $('#dat_ocupa_visu1').prop('checked',true); } else { $('#dat_ocupa_visu1').val('N'); $('#dat_ocupa_visu1').prop('checked',false); } 
if (dat_ocupa_audi1=='S') { $('#dat_ocupa_audi1').val('S'); $('#dat_ocupa_audi1').prop('checked',true); } else { $('#dat_ocupa_audi1').val('N'); $('#dat_ocupa_audi1').prop('checked',false); } 
if (dat_ocupa_resp1=='S') { $('#dat_ocupa_resp1').val('S'); $('#dat_ocupa_resp1').prop('checked',true); } else { $('#dat_ocupa_resp1').val('N'); $('#dat_ocupa_resp1').prop('checked',false); } 
if (dat_ocupa_cabeza1=='S') { $('#dat_ocupa_cabeza1').val('S'); $('#dat_ocupa_cabeza1').prop('checked',true); } else { $('#dat_ocupa_cabeza1').val('N'); $('#dat_ocupa_cabeza1').prop('checked',false); } 
if (dat_ocupa_manos1=='S') { $('#dat_ocupa_manos1').val('S'); $('#dat_ocupa_manos1').prop('checked',true); } else { $('#dat_ocupa_manos1').val('N'); $('#dat_ocupa_manos1').prop('checked',false); } 
if (dat_ocupa_tronco1=='S') { $('#dat_ocupa_tronco1').val('S'); $('#dat_ocupa_tronco1').prop('checked',true); } else { $('#dat_ocupa_tronco1').val('N'); $('#dat_ocupa_tronco1').prop('checked',false); } 
if (dat_ocupa_pies1=='S') { $('#dat_ocupa_pies1').val('S'); $('#dat_ocupa_pies1').prop('checked',true); } else { $('#dat_ocupa_pies1').val('N'); $('#dat_ocupa_pies1').prop('checked',false); } 
if (dat_ocupa_altu1=='S') { $('#dat_ocupa_altu1').val('S'); $('#dat_ocupa_altu1').prop('checked',true); } else { $('#dat_ocupa_altu1').val('N'); $('#dat_ocupa_altu1').prop('checked',false); }
}
});
});
</script>

<script>  
 $(document).ready(function(){ 
/* -------------------------------------------------------------------------------------------------------------- */
$(".dat_ocupa_visu1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu1").val("S"); } else {	$(".dat_ocupa_visu1").val("N"); } });
$(".dat_ocupa_audi1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi1").val("S"); } else {	$(".dat_ocupa_audi1").val("N"); } });
$(".dat_ocupa_altu1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu1").val("S"); } else {	$(".dat_ocupa_altu1").val("N"); } });
$(".dat_ocupa_resp1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp1").val("S"); } else {	$(".dat_ocupa_resp1").val("N"); } });
$(".dat_ocupa_cabeza1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_cabeza1").val("S"); } else {	$(".dat_ocupa_cabeza1").val("N"); } });
$(".dat_ocupa_manos1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_manos1").val("S"); } else {	$(".dat_ocupa_manos1").val("N"); } });
$(".dat_ocupa_tronco1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_tronco1").val("S"); } else {	$(".dat_ocupa_tronco1").val("N"); } });
$(".dat_ocupa_pies1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_pies1").val("S"); } else {	$(".dat_ocupa_pies1").val("N"); } });
$(".dat_ocupa_visu2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu2").val("S"); } else {	$(".dat_ocupa_visu2").val("N"); } });
$(".dat_ocupa_audi2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi2").val("S"); } else {	$(".dat_ocupa_audi2").val("N"); } });
$(".dat_ocupa_altu2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu2").val("S"); } else {	$(".dat_ocupa_altu2").val("N"); } });
$(".dat_ocupa_resp2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp2").val("S"); } else {	$(".dat_ocupa_resp2").val("N"); } });
$(".dat_ocupa_cabeza2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_cabeza2").val("S"); } else {	$(".dat_ocupa_cabeza2").val("N"); } });
$(".dat_ocupa_manos2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_manos2").val("S"); } else {	$(".dat_ocupa_manos2").val("N"); } });
$(".dat_ocupa_tronco2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_tronco2").val("S"); } else {	$(".dat_ocupa_tronco2").val("N"); } });
$(".dat_ocupa_pies2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_pies2").val("S"); } else {	$(".dat_ocupa_pies2").val("N"); } });
$(".dat_ocupa_visu3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu3").val("S"); } else {	$(".dat_ocupa_visu3").val("N"); } });
$(".dat_ocupa_audi3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi3").val("S"); } else {	$(".dat_ocupa_audi3").val("N"); } });
$(".dat_ocupa_altu3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu3").val("S"); } else {	$(".dat_ocupa_altu3").val("N"); } });
$(".dat_ocupa_resp3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp3").val("S"); } else {	$(".dat_ocupa_resp3").val("N"); } });
$(".dat_ocupa_cabeza3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_cabeza3").val("S"); } else {	$(".dat_ocupa_cabeza3").val("N"); } });
$(".dat_ocupa_manos3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_manos3").val("S"); } else {	$(".dat_ocupa_manos3").val("N"); } });
$(".dat_ocupa_tronco3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_tronco3").val("S"); } else {	$(".dat_ocupa_tronco3").val("N"); } });
$(".dat_ocupa_pies3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_pies3").val("S"); } else {	$(".dat_ocupa_pies3").val("N"); } });
/* -------------------------------------------------------------------------------------------------------------- */
$(".clasrieg_fis1_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_ruid").val("S"); } else {	$(".clasrieg_fis1_ruid").val("N"); } });
$(".clasrieg_fis1_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_ilum").val("S"); } else {	$(".clasrieg_fis1_ilum").val("N"); } });
$(".clasrieg_fis1_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_noionic").val("S"); } else {	$(".clasrieg_fis1_noionic").val("N"); } });
$(".clasrieg_fis1_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_vibra").val("S"); } else {	$(".clasrieg_fis1_vibra").val("N"); } });
$(".clasrieg_fis1_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_tempextrem").val("S"); } else {	$(".clasrieg_fis1_tempextrem").val("N"); } });
$(".clasrieg_fis1_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_cambpres").val("S"); } else {	$(".clasrieg_fis1_cambpres").val("N"); } });
$(".clasrieg_quim1_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_gasvapor").val("S"); } else {	$(".clasrieg_quim1_gasvapor").val("N"); } });
$(".clasrieg_quim1_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_aeroliq").val("S"); } else {	$(".clasrieg_quim1_aeroliq").val("N"); } });
$(".clasrieg_quim1_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_solid").val("S"); } else {	$(".clasrieg_quim1_solid").val("N"); } });
$(".clasrieg_quim1_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_liquid").val("S"); } else {	$(".clasrieg_quim1_liquid").val("N"); } });
$(".clasrieg_biolog1_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_viru").val("S"); } else {	$(".clasrieg_biolog1_viru").val("N"); } });
$(".clasrieg_biolog1_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_bacter").val("S"); } else {	$(".clasrieg_biolog1_bacter").val("N"); } });
$(".clasrieg_biolog1_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_parasi").val("S"); } else {	$(".clasrieg_biolog1_parasi").val("N"); } });
$(".clasrieg_biolog1_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_morde").val("S"); } else {	$(".clasrieg_biolog1_morde").val("N"); } });
$(".clasrieg_biolog1_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_picad").val("S"); } else {	$(".clasrieg_biolog1_picad").val("N"); } });
$(".clasrieg_biolog1_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_hongo").val("S"); } else {	$(".clasrieg_biolog1_hongo").val("N"); } });
$(".clasrieg_ergo1_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_trabestat").val("S"); } else {	$(".clasrieg_ergo1_trabestat").val("N"); } });
$(".clasrieg_ergo1_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_esfuerfis").val("S"); } else {	$(".clasrieg_ergo1_esfuerfis").val("N"); } });
$(".clasrieg_ergo1_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_carga").val("S"); } else {	$(".clasrieg_ergo1_carga").val("N"); } });
$(".clasrieg_ergo1_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_postforz").val("S"); } else {	$(".clasrieg_ergo1_postforz").val("N"); } });
$(".clasrieg_ergo1_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_movrepet").val("S"); } else {	$(".clasrieg_ergo1_movrepet").val("N"); } });
$(".clasrieg_ergo1_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_jortrab").val("S"); } else {	$(".clasrieg_ergo1_jortrab").val("N"); } });
$(".clasrieg_psi1_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_monoto").val("S"); } else {	$(".clasrieg_psi1_monoto").val("N"); } });
$(".clasrieg_psi1_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_relhuman").val("S"); } else {	$(".clasrieg_psi1_relhuman").val("N"); } });
$(".clasrieg_psi1_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_contentarea").val("S"); } else {	$(".clasrieg_psi1_contentarea").val("N"); } });
$(".clasrieg_psi1_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_orgtiemptrab").val("S"); } else {	$(".clasrieg_psi1_orgtiemptrab").val("N"); } });
$(".clasrieg_segur1_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_mecanic").val("S"); } else {	$(".clasrieg_segur1_mecanic").val("N"); } });
$(".clasrieg_segur1_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_electri").val("S"); } else {	$(".clasrieg_segur1_electri").val("N"); } });
$(".clasrieg_segur1_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_locat").val("S"); } else {	$(".clasrieg_segur1_locat").val("N"); } });
$(".clasrieg_segur1_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_fisiquim").val("S"); } else {	$(".clasrieg_segur1_fisiquim").val("N"); } });
$(".clasrieg_segur1_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_public").val("S"); } else {	$(".clasrieg_segur1_public").val("N"); } });
$(".clasrieg_segur1_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_espconfi").val("S"); } else {	$(".clasrieg_segur1_espconfi").val("N"); } });
$(".clasrieg_segur1_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_trabaltura").val("S"); } else {	$(".clasrieg_segur1_trabaltura").val("N"); } });
$(".clasrieg_segur1_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_sismo").val("S"); } else {   $(".clasrieg_segur1_sismo").val("N"); } });
$(".clasrieg_segur1_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur1_delincuenciacomun").val("N"); } });
$(".clasrieg_segur1_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_accitransito").val("S"); } else {   $(".clasrieg_segur1_accitransito").val("N"); } });
$(".clasrieg_segur1_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_caidaobjetos").val("S"); } else {   $(".clasrieg_segur1_caidaobjetos").val("N"); } });
$(".clasrieg_segur1_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur1_puestotrabdesorden").val("N"); } });
$(".clasrieg_observ1_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ1_otro").val("S"); } else {	$(".clasrieg_observ1_otro").val("N"); } });
$(".clasrieg_fis2_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_ruid").val("S"); } else {	$(".clasrieg_fis2_ruid").val("N"); } });
$(".clasrieg_fis2_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_ilum").val("S"); } else {	$(".clasrieg_fis2_ilum").val("N"); } });
$(".clasrieg_fis2_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_noionic").val("S"); } else {	$(".clasrieg_fis2_noionic").val("N"); } });
$(".clasrieg_fis2_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_vibra").val("S"); } else {	$(".clasrieg_fis2_vibra").val("N"); } });
$(".clasrieg_fis2_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_tempextrem").val("S"); } else {	$(".clasrieg_fis2_tempextrem").val("N"); } });
$(".clasrieg_fis2_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_cambpres").val("S"); } else {	$(".clasrieg_fis2_cambpres").val("N"); } });
$(".clasrieg_quim2_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_gasvapor").val("S"); } else {	$(".clasrieg_quim2_gasvapor").val("N"); } });
$(".clasrieg_quim2_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_aeroliq").val("S"); } else {	$(".clasrieg_quim2_aeroliq").val("N"); } });
$(".clasrieg_quim2_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_solid").val("S"); } else {	$(".clasrieg_quim2_solid").val("N"); } });
$(".clasrieg_quim2_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_liquid").val("S"); } else {	$(".clasrieg_quim2_liquid").val("N"); } });
$(".clasrieg_biolog2_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_viru").val("S"); } else {	$(".clasrieg_biolog2_viru").val("N"); } });
$(".clasrieg_biolog2_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_bacter").val("S"); } else {	$(".clasrieg_biolog2_bacter").val("N"); } });
$(".clasrieg_biolog2_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_parasi").val("S"); } else {	$(".clasrieg_biolog2_parasi").val("N"); } });
$(".clasrieg_biolog2_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_morde").val("S"); } else {	$(".clasrieg_biolog2_morde").val("N"); } });
$(".clasrieg_biolog2_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_picad").val("S"); } else {	$(".clasrieg_biolog2_picad").val("N"); } });
$(".clasrieg_biolog2_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_hongo").val("S"); } else {	$(".clasrieg_biolog2_hongo").val("N"); } });
$(".clasrieg_ergo2_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_trabestat").val("S"); } else {	$(".clasrieg_ergo2_trabestat").val("N"); } });
$(".clasrieg_ergo2_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_esfuerfis").val("S"); } else {	$(".clasrieg_ergo2_esfuerfis").val("N"); } });
$(".clasrieg_ergo2_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_carga").val("S"); } else {	$(".clasrieg_ergo2_carga").val("N"); } });
$(".clasrieg_ergo2_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_postforz").val("S"); } else {	$(".clasrieg_ergo2_postforz").val("N"); } });
$(".clasrieg_ergo2_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_movrepet").val("S"); } else {	$(".clasrieg_ergo2_movrepet").val("N"); } });
$(".clasrieg_ergo2_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_jortrab").val("S"); } else {	$(".clasrieg_ergo2_jortrab").val("N"); } });
$(".clasrieg_psi2_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_monoto").val("S"); } else {	$(".clasrieg_psi2_monoto").val("N"); } });
$(".clasrieg_psi2_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_relhuman").val("S"); } else {	$(".clasrieg_psi2_relhuman").val("N"); } });
$(".clasrieg_psi2_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_contentarea").val("S"); } else {	$(".clasrieg_psi2_contentarea").val("N"); } });
$(".clasrieg_psi2_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_orgtiemptrab").val("S"); } else {	$(".clasrieg_psi2_orgtiemptrab").val("N"); } });
$(".clasrieg_segur2_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_mecanic").val("S"); } else {	$(".clasrieg_segur2_mecanic").val("N"); } });
$(".clasrieg_segur2_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_electri").val("S"); } else {	$(".clasrieg_segur2_electri").val("N"); } });
$(".clasrieg_segur2_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_locat").val("S"); } else {	$(".clasrieg_segur2_locat").val("N"); } });
$(".clasrieg_segur2_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_fisiquim").val("S"); } else {	$(".clasrieg_segur2_fisiquim").val("N"); } });
$(".clasrieg_segur2_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_public").val("S"); } else {	$(".clasrieg_segur2_public").val("N"); } });
$(".clasrieg_segur2_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_espconfi").val("S"); } else {	$(".clasrieg_segur2_espconfi").val("N"); } });
$(".clasrieg_segur2_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_trabaltura").val("S"); } else {	$(".clasrieg_segur2_trabaltura").val("N"); } });
$(".clasrieg_segur2_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_sismo").val("S"); } else {   $(".clasrieg_segur2_sismo").val("N"); } });
$(".clasrieg_segur2_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur2_delincuenciacomun").val("N"); } });
$(".clasrieg_segur2_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_accitransito").val("S"); } else {   $(".clasrieg_segur2_accitransito").val("N"); } });
$(".clasrieg_segur2_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_caidaobjetos").val("S"); } else {   $(".clasrieg_segur2_caidaobjetos").val("N"); } });
$(".clasrieg_segur2_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur2_puestotrabdesorden").val("N"); } });
$(".clasrieg_observ2_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ2_otro").val("S"); } else {	$(".clasrieg_observ2_otro").val("N"); } });
$(".clasrieg_fis3_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_ruid").val("S"); } else {	$(".clasrieg_fis3_ruid").val("N"); } });
$(".clasrieg_fis3_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_ilum").val("S"); } else {	$(".clasrieg_fis3_ilum").val("N"); } });
$(".clasrieg_fis3_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_noionic").val("S"); } else {	$(".clasrieg_fis3_noionic").val("N"); } });
$(".clasrieg_fis3_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_vibra").val("S"); } else {	$(".clasrieg_fis3_vibra").val("N"); } });
$(".clasrieg_fis3_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_tempextrem").val("S"); } else {	$(".clasrieg_fis3_tempextrem").val("N"); } });
$(".clasrieg_fis3_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_cambpres").val("S"); } else {	$(".clasrieg_fis3_cambpres").val("N"); } });
$(".clasrieg_quim3_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_gasvapor").val("S"); } else {	$(".clasrieg_quim3_gasvapor").val("N"); } });
$(".clasrieg_quim3_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_aeroliq").val("S"); } else {	$(".clasrieg_quim3_aeroliq").val("N"); } });
$(".clasrieg_quim3_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_solid").val("S"); } else {	$(".clasrieg_quim3_solid").val("N"); } });
$(".clasrieg_quim3_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_liquid").val("S"); } else {	$(".clasrieg_quim3_liquid").val("N"); } });
$(".clasrieg_biolog3_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_viru").val("S"); } else {	$(".clasrieg_biolog3_viru").val("N"); } });
$(".clasrieg_biolog3_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_bacter").val("S"); } else {	$(".clasrieg_biolog3_bacter").val("N"); } });
$(".clasrieg_biolog3_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_parasi").val("S"); } else {	$(".clasrieg_biolog3_parasi").val("N"); } });
$(".clasrieg_biolog3_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_morde").val("S"); } else {	$(".clasrieg_biolog3_morde").val("N"); } });
$(".clasrieg_biolog3_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_picad").val("S"); } else {	$(".clasrieg_biolog3_picad").val("N"); } });
$(".clasrieg_biolog3_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_hongo").val("S"); } else {	$(".clasrieg_biolog3_hongo").val("N"); } });
$(".clasrieg_ergo3_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_trabestat").val("S"); } else {	$(".clasrieg_ergo3_trabestat").val("N"); } });
$(".clasrieg_ergo3_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_esfuerfis").val("S"); } else {	$(".clasrieg_ergo3_esfuerfis").val("N"); } });
$(".clasrieg_ergo3_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_carga").val("S"); } else {	$(".clasrieg_ergo3_carga").val("N"); } });
$(".clasrieg_ergo3_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_postforz").val("S"); } else {	$(".clasrieg_ergo3_postforz").val("N"); } });
$(".clasrieg_ergo3_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_movrepet").val("S"); } else {	$(".clasrieg_ergo3_movrepet").val("N"); } });
$(".clasrieg_ergo3_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_jortrab").val("S"); } else {	$(".clasrieg_ergo3_jortrab").val("N"); } });
$(".clasrieg_psi3_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_monoto").val("S"); } else {	$(".clasrieg_psi3_monoto").val("N"); } });
$(".clasrieg_psi3_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_relhuman").val("S"); } else {	$(".clasrieg_psi3_relhuman").val("N"); } });
$(".clasrieg_psi3_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_contentarea").val("S"); } else {	$(".clasrieg_psi3_contentarea").val("N"); } });
$(".clasrieg_psi3_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_orgtiemptrab").val("S"); } else {	$(".clasrieg_psi3_orgtiemptrab").val("N"); } });
$(".clasrieg_segur3_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_mecanic").val("S"); } else {	$(".clasrieg_segur3_mecanic").val("N"); } });
$(".clasrieg_segur3_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_electri").val("S"); } else {	$(".clasrieg_segur3_electri").val("N"); } });
$(".clasrieg_segur3_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_locat").val("S"); } else {	$(".clasrieg_segur3_locat").val("N"); } });
$(".clasrieg_segur3_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_fisiquim").val("S"); } else {	$(".clasrieg_segur3_fisiquim").val("N"); } });
$(".clasrieg_segur3_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_public").val("S"); } else {	$(".clasrieg_segur3_public").val("N"); } });
$(".clasrieg_segur3_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_espconfi").val("S"); } else {	$(".clasrieg_segur3_espconfi").val("N"); } });
$(".clasrieg_segur3_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_trabaltura").val("S"); } else {	$(".clasrieg_segur3_trabaltura").val("N"); } });
$(".clasrieg_segur3_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_sismo").val("S"); } else {   $(".clasrieg_segur3_sismo").val("N"); } });
$(".clasrieg_segur3_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur3_delincuenciacomun").val("N"); } });
$(".clasrieg_segur3_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_accitransito").val("S"); } else {   $(".clasrieg_segur3_accitransito").val("N"); } });
$(".clasrieg_segur3_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_caidaobjetos").val("S"); } else {   $(".clasrieg_segur3_caidaobjetos").val("N"); } });
$(".clasrieg_segur3_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur3_puestotrabdesorden").val("N"); } });
$(".clasrieg_observ3_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ3_otro").val("S"); } else {	$(".clasrieg_observ3_otro").val("N"); } });
/* -------------------------------------------------------------------------------------------------------------- */
$(".ant_fam_hiper_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_pad").val("S"); } else {	$(".ant_fam_hiper_pad").val("N"); } });
$(".ant_fam_hiper_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_mad").val("S"); } else {	$(".ant_fam_hiper_mad").val("N"); } });
$(".ant_fam_hiper_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_herm").val("S"); } else {	$(".ant_fam_hiper_herm").val("N"); } });
$(".ant_fam_hiper_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_otro").val("S"); } else {	$(".ant_fam_hiper_otro").val("N"); } });
$(".ant_fam_cadio_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_pad").val("S"); } else {	$(".ant_fam_cadio_pad").val("N"); } });
$(".ant_fam_cadio_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_mad").val("S"); } else {	$(".ant_fam_cadio_mad").val("N"); } });
$(".ant_fam_cadio_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_herm").val("S"); } else {	$(".ant_fam_cadio_herm").val("N"); } });
$(".ant_fam_cadio_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_otro").val("S"); } else {	$(".ant_fam_cadio_otro").val("N"); } });
$(".ant_fam_osteomusc_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_pad").val("S"); } else {	$(".ant_fam_osteomusc_pad").val("N"); } });
$(".ant_fam_osteomusc_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_mad").val("S"); } else {	$(".ant_fam_osteomusc_mad").val("N"); } });
$(".ant_fam_osteomusc_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_herm").val("S"); } else {	$(".ant_fam_osteomusc_herm").val("N"); } });
$(".ant_fam_osteomusc_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_otro").val("S"); } else {	$(".ant_fam_osteomusc_otro").val("N"); } });
$(".ant_fam_diabet_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_pad").val("S"); } else {	$(".ant_fam_diabet_pad").val("N"); } });
$(".ant_fam_diabet_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_mad").val("S"); } else {	$(".ant_fam_diabet_mad").val("N"); } });
$(".ant_fam_diabet_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_herm").val("S"); } else {	$(".ant_fam_diabet_herm").val("N"); } });
$(".ant_fam_diabet_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_otro").val("S"); } else {	$(".ant_fam_diabet_otro").val("N"); } });
$(".ant_fam_trans_convul_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_pad").val("S"); } else {	$(".ant_fam_trans_convul_pad").val("N"); } });
$(".ant_fam_trans_convul_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_mad").val("S"); } else {	$(".ant_fam_trans_convul_mad").val("N"); } });
$(".ant_fam_trans_convul_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_herm").val("S"); } else {	$(".ant_fam_trans_convul_herm").val("N"); } });
$(".ant_fam_trans_convul_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_otro").val("S"); } else {	$(".ant_fam_trans_convul_otro").val("N"); } });
$(".ant_fam_artitri_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_pad").val("S"); } else {	$(".ant_fam_artitri_pad").val("N"); } });
$(".ant_fam_artitri_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_mad").val("S"); } else {	$(".ant_fam_artitri_mad").val("N"); } });
$(".ant_fam_artitri_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_herm").val("S"); } else {	$(".ant_fam_artitri_herm").val("N"); } });
$(".ant_fam_artitri_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_otro").val("S"); } else {	$(".ant_fam_artitri_otro").val("N"); } });
$(".ant_fam_trombos_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_pad").val("S"); } else {	$(".ant_fam_trombos_pad").val("N"); } });
$(".ant_fam_trombos_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_mad").val("S"); } else {	$(".ant_fam_trombos_mad").val("N"); } });
$(".ant_fam_trombos_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_herm").val("S"); } else {	$(".ant_fam_trombos_herm").val("N"); } });
$(".ant_fam_trombos_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_otro").val("S"); } else {	$(".ant_fam_trombos_otro").val("N"); } });
$(".ant_fam_enf_gene_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_pad").val("S"); } else {	$(".ant_fam_enf_gene_pad").val("N"); } });
$(".ant_fam_enf_gene_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_mad").val("S"); } else {	$(".ant_fam_enf_gene_mad").val("N"); } });
$(".ant_fam_enf_gene_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_herm").val("S"); } else {	$(".ant_fam_enf_gene_herm").val("N"); } });
$(".ant_fam_enf_gene_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_otro").val("S"); } else {	$(".ant_fam_enf_gene_otro").val("N"); } });
$(".ant_fam_varice_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_pad").val("S"); } else {	$(".ant_fam_varice_pad").val("N"); } });
$(".ant_fam_varice_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_mad").val("S"); } else {	$(".ant_fam_varice_mad").val("N"); } });
$(".ant_fam_varice_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_herm").val("S"); } else {	$(".ant_fam_varice_herm").val("N"); } });
$(".ant_fam_varice_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_otro").val("S"); } else {	$(".ant_fam_varice_otro").val("N"); } });
$(".ant_fam_tum_malig_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_pad").val("S"); } else {	$(".ant_fam_tum_malig_pad").val("N"); } });
$(".ant_fam_tum_malig_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_mad").val("S"); } else {	$(".ant_fam_tum_malig_mad").val("N"); } });
$(".ant_fam_tum_malig_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_herm").val("S"); } else {	$(".ant_fam_tum_malig_herm").val("N"); } });
$(".ant_fam_tum_malig_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_otro").val("S"); } else {	$(".ant_fam_tum_malig_otro").val("N"); } });
$(".ant_fam_alerg_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_pad").val("S"); } else {	$(".ant_fam_alerg_pad").val("N"); } });
$(".ant_fam_alerg_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_mad").val("S"); } else {	$(".ant_fam_alerg_mad").val("N"); } });
$(".ant_fam_alerg_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_herm").val("S"); } else {	$(".ant_fam_alerg_herm").val("N"); } });
$(".ant_fam_alerg_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_otro").val("S"); } else {	$(".ant_fam_alerg_otro").val("N"); } });
$(".ant_fam_otro_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_pad").val("S"); } else {	$(".ant_fam_otro_pad").val("N"); } });
$(".ant_fam_otro_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_mad").val("S"); } else {	$(".ant_fam_otro_mad").val("N"); } });
$(".ant_fam_otro_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_herm").val("S"); } else {	$(".ant_fam_otro_herm").val("N"); } });
$(".ant_fam_otro_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_otro").val("S"); } else {	$(".ant_fam_otro_otro").val("N"); } });
$(".ant_fam_enf_ment_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_pad").val("S"); } else {	$(".ant_fam_enf_ment_pad").val("N"); } });
$(".ant_fam_enf_ment_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_mad").val("S"); } else {	$(".ant_fam_enf_ment_mad").val("N"); } });
$(".ant_fam_enf_ment_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_herm").val("S"); } else {	$(".ant_fam_enf_ment_herm").val("N"); } });
$(".ant_fam_enf_ment_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_otro").val("S"); } else {	$(".ant_fam_enf_ment_otro").val("N"); } });
$(".ant_fam_tuber_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_pad").val("S"); } else {	$(".ant_fam_tuber_pad").val("N"); } });
$(".ant_fam_tuber_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_mad").val("S"); } else {	$(".ant_fam_tuber_mad").val("N"); } });
$(".ant_fam_tuber_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_herm").val("S"); } else {	$(".ant_fam_tuber_herm").val("N"); } });
$(".ant_fam_tuber_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_otro").val("S"); } else {	$(".ant_fam_tuber_otro").val("N"); } });

$(".ant_fam_asma_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_pad").val("S"); } else {	$(".ant_fam_asma_pad").val("N"); } });
$(".ant_fam_asma_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_mad").val("S"); } else {	$(".ant_fam_asma_mad").val("N"); } });
$(".ant_fam_asma_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_herm").val("S"); } else {	$(".ant_fam_asma_herm").val("N"); } });
$(".ant_fam_asma_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_otro").val("S"); } else {	$(".ant_fam_asma_otro").val("N"); } });
/* -------------------------------------------------------------------------------------------------------------- */
$('input:radio[name="sintoma_covid19_todo"]').change(function(){ 
var tbl15_estado = $(this).val();
var pos = 'SI';
var neg = 'NO';

if( tbl15_estado == 'SI' ){ 
console.log(neg);
$("input:radio[name=covid19_fiebre][value='SI']").prop("checked",true);
$("input:radio[name=covid19_escolofrio][value='SI']").prop("checked",true);
$("input:radio[name=covid19_cansansio][value='SI']").prop("checked",true);
$("input:radio[name=covid19_malestar_gral][value='SI']").prop("checked",true);
$("input:radio[name=covid19_fatiga][value='SI']").prop("checked",true);
$("input:radio[name=covid19_tos_seca][value='SI']").prop("checked",true);
$("input:radio[name=covid19_cefaleas][value='SI']").prop("checked",true);
$("input:radio[name=covid19_congestion_nasal][value='SI']").prop("checked",true);
$("input:radio[name=covid19_secrecion_nasal][value='SI']").prop("checked",true);
$("input:radio[name=exaosteo_epicond_lat][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dorlor_garganta][value='SI']").prop("checked",true);
$("input:radio[name=covid19_diarrea][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dificul_resp][value='SI']").prop("checked",true);
$("input:radio[name=covid19_inapetencia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_perdida_olfato][value='SI']").prop("checked",true);
$("input:radio[name=covid19_perdida_gusto][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dedos_covid][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dolor_pecho][value='SI']").prop("checked",true);
$("input:radio[name=covid19_confusion][value='SI']").prop("checked",true);
$("input:radio[name=covid19_color_azul_labios][value='SI']").prop("checked",true);

$("input:radio[name=covid19_artralgia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_mialgia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_astenia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_odinofagia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_irritacion_ardor_ojos][value='SI']").prop("checked",true);
$("input:radio[name=covid19_nauseas][value='SI']").prop("checked",true);
$("input:radio[name=covid19_contacto_person_sospech_covid][value='SI']").prop("checked",true);
} 
else if( tbl15_estado == 'NO' ){ 
console.log(pos);
$("input:radio[name=covid19_fiebre][value='NO']").prop("checked",true);
$("input:radio[name=covid19_escolofrio][value='NO']").prop("checked",true);
$("input:radio[name=covid19_cansansio][value='NO']").prop("checked",true);
$("input:radio[name=covid19_malestar_gral][value='NO']").prop("checked",true);
$("input:radio[name=covid19_fatiga][value='NO']").prop("checked",true);
$("input:radio[name=covid19_tos_seca][value='NO']").prop("checked",true);
$("input:radio[name=covid19_cefaleas][value='NO']").prop("checked",true);
$("input:radio[name=covid19_congestion_nasal][value='NO']").prop("checked",true);
$("input:radio[name=covid19_secrecion_nasal][value='NO']").prop("checked",true);
$("input:radio[name=exaosteo_epicond_lat][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dorlor_garganta][value='NO']").prop("checked",true);
$("input:radio[name=covid19_diarrea][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dificul_resp][value='NO']").prop("checked",true);
$("input:radio[name=covid19_inapetencia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_perdida_olfato][value='NO']").prop("checked",true);
$("input:radio[name=covid19_perdida_gusto][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dedos_covid][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dolor_pecho][value='NO']").prop("checked",true);
$("input:radio[name=covid19_confusion][value='NO']").prop("checked",true);
$("input:radio[name=covid19_color_azul_labios][value='NO']").prop("checked",true);

$("input:radio[name=covid19_artralgia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_mialgia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_astenia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_odinofagia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_irritacion_ardor_ojos][value='NO']").prop("checked",true);
$("input:radio[name=covid19_nauseas][value='NO']").prop("checked",true);
$("input:radio[name=covid19_contacto_person_sospech_covid][value='NO']").prop("checked",true);
}
else { console.log(neg); } 
});
/* -------------------------------------------------------------------------------------------------------------- */
$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
//let id = this.id;
console.log("input");
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_historia_clinica ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("select");
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_historia_clinica ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("textarea");
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_historia_clinica ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});


 });  
 </script> 

<script>
$('.btn_cie10').on('click',function(){
$('.modal-body').load('cie10_ventana_modal_buscador.php?id=2',function(){
$('#ventana_modal_cie10_id').modal({show:true}); }); });
</script>
<!-- ***************************************************************************************************************************** -->
<script>
$('.btn_medicamento').on('click',function(){
$('.modal-body2').load('medicamento_ventana_modal_buscador.php?id=2',function(){ 
$('#ventana_modal_medicamento_id').modal({show:true}); }); });
</script>
<!-- ***************************************************************************************************************************** -->
<script>
$('.btn_laboratorio').on('click',function(){
$('.modal-body4').load('laboratorio_ventana_modal_buscador.php?id=2',function(){ 
$('#ventana_modal_laboratorio_id').modal({show:true}); }); });
</script>
<!-- ***************************************************************************************************************************** -->
</body>
</html>