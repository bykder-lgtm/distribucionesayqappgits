<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$fecha_hoy = time();

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                          = $info_empresa_data['titulo'];
$nombre_emp                          = $info_empresa_data['nombre'];
$eslogan_emp                         = $info_empresa_data['eslogan'];
$direccion_emp                       = $info_empresa_data['direccion'];
$ciudad_emp                          = $info_empresa_data['ciudad'];
$pais_emp                            = $info_empresa_data['pais'];
$correo_emp                          = $info_empresa_data['correo'];
$img_cabecera_emp                    = $info_empresa_data['img_cabecera'];
$telefono_emp                        = $info_empresa_data['telefono'];
$info_legal_emp                      = $info_empresa_data['info_legal'];
$logotipo_emp                        = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp   = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                     = $info_empresa_data['nit_empresa'];
$cabecera_emp                        = $info_empresa_data['cabecera'];
$icono_emp                           = $info_empresa_data['icono'];
$desarrollador_emp                   = $info_empresa_data['desarrollador'];
$anyo_emp                            = $info_empresa_data['anyo'];
$url_pag                             = $info_empresa_data['url_pag'];
$nombre_font_emp                     = $info_empresa_data['nombre_font'];
$tamano_font_hc_emp                  = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp              = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp            = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp          = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_remision_emp            = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp             = $info_empresa_data['tamano_font_factura'];
$res_emp                             = $info_empresa_data['res'];
$res1_emp                            = $info_empresa_data['res1'];
$res2_emp                            = $info_empresa_data['res2'];
$departamento_emp                    = $info_empresa_data['departamento'];
$localidad_emp                       = $info_empresa_data['localidad'];
$reg_medico_emp                      = $info_empresa_data['reg_medico'];
$regimen_emp                         = $info_empresa_data['regimen'];
$version_emp                         = $info_empresa_data['version'];
$propietario_url_firma_emp           = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                      = $info_empresa_data['fecha_time'];
$licencia_emp                        = $info_empresa_data['licencia'];
$info_histclinic_emp                 = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                 = $info_empresa_data['info_aptlaboral'];

$sql_historia_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cod_cliente, tbl15_cliente.nombre_tipo_doc, 
tbl15_cliente.nombre_ocupacion, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_contacto1, 
tbl15_cliente.parentesco_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.antperson_alergia_si, tbl15_cliente.antperson_alergia_no, tbl15_cliente.nombre_escolaridad,
tbl15_cliente.antperson_patologico_si, tbl15_cliente.antperson_patologico_no, tbl15_cliente.antperson_quirurgico_si, tbl15_cliente.antperson_quirurgico_no, 
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, 
tbl15_cliente.url_img_foto AS url_img_foto_cli,
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_cliente.edad_anyo, tbl15_cliente.nombre_empresa,
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente AS tel_cliente_cli, tbl15_cliente.correo, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, 
tbl15_cliente.cargo_empresa, tbl15_cliente.area_empresa, tbl15_cliente.ciudad_empresa, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2,
tbl15_cliente.nombre_tipo_regimen, tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_numero_hijos, tbl15_cliente.nombre_arl, tbl15_cliente.lugar_nac, 
tbl15_cliente.lugar_residencia, tbl15_cliente.lugar_procedencia, tbl15_cliente.nombre_estado_civil, tbl15_cliente.nombre_raza, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2, 
tbl15_historia_clinica.motivo, tbl15_historia_clinica.dat_ocupa_emp1, tbl15_historia_clinica.dat_ocupa_carg1, tbl15_historia_clinica.dat_ocupa_visu1, 
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
tbl15_historia_clinica.ant_fam_hiper_otro_cual,tbl15_historia_clinica.ant_fam_diabet_pad, 
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
tbl15_historia_clinica.ant_fam_descripcion, tbl15_historia_clinica.ant_pato_no_presenta, 
tbl15_historia_clinica.ant_pato_neuro, tbl15_historia_clinica.ant_pato_resp, 
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
tbl15_historia_clinica.ant_trau_fech_aprox3, tbl15_historia_clinica.ant_quirur, 
tbl15_historia_clinica.ant_quirur_enfer1, tbl15_historia_clinica.ant_quirur_observ1, 
tbl15_historia_clinica.ant_quirur_fech_aprox1, tbl15_historia_clinica.ant_quirur_enfer2, 
tbl15_historia_clinica.ant_quirur_observ2, tbl15_historia_clinica.ant_quirur_fech_aprox2, 
tbl15_historia_clinica.ant_quirur_enfer3, tbl15_historia_clinica.ant_quirur_observ3, 
tbl15_historia_clinica.ant_quirur_fech_aprox3, tbl15_historia_clinica.ant_inmuni, 
tbl15_historia_clinica.ant_inmuni_tetano, tbl15_historia_clinica.ant_inmuni_tetano_anyo, 
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
tbl15_historia_clinica.rev_sist_orgsentido, tbl15_historia_clinica.rev_sist_observ_orgsentido, 
tbl15_historia_clinica.rev_sist_neurolog, tbl15_historia_clinica.rev_sist_observ_neurolog, 
tbl15_historia_clinica.rev_sist_resp, tbl15_historia_clinica.rev_sist_observ_resp, 
tbl15_historia_clinica.rev_sist_gastrointes, tbl15_historia_clinica.rev_sist_observ_gastrointes, 
tbl15_historia_clinica.rev_sist_geniuri, tbl15_historia_clinica.rev_sist_observ_geniuri, 
tbl15_historia_clinica.rev_sist_osteomus, tbl15_historia_clinica.rev_sist_observ_osteomus, 
tbl15_historia_clinica.rev_sist_dermato, tbl15_historia_clinica.rev_sist_noref_dermato, 
tbl15_historia_clinica.rev_sist_cardiovas, tbl15_historia_clinica.rev_sist_noref_cardiovas, 
tbl15_historia_clinica.rev_sist_constitu, tbl15_historia_clinica.rev_sist_observ_constitu, 
tbl15_historia_clinica.rev_sist_metabolendocri, tbl15_historia_clinica.rev_sist_observ_metabolendocri, 
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
tbl15_historia_clinica.exaosteo_manyega_fuerza, tbl15_historia_clinica.exaosteo_manpatte_sig, tbl15_historia_clinica.rev_sist_observ_cardiovas, 
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
tbl15_historia_clinica.total_terapia, tbl15_historia_clinica.nombre_laboratorio, tbl15_historia_clinica.rev_sist_observ_dermato, 
tbl15_historia_clinica.nombre_medicamento, tbl15_historia_clinica.descripcion_medicamento, tbl15_historia_clinica.nombre_ayuda_diagnostica, 
tbl15_historia_clinica.descripcion_ayuda_diagnostica, tbl15_historia_clinica.nombre_religion, tbl15_historia_clinica.nombre_ocupacion, 
tbl15_historia_clinica.nombre_estado_civil, tbl15_historia_clinica.nombre_escolaridad, tbl15_historia_clinica.nombre_tipo_regimen, tbl15_historia_clinica.nombre_fondo_pension, 
tbl15_historia_clinica.nombre_actividad_ecoemp, tbl15_historia_clinica.nombre_estrato, tbl15_historia_clinica.nombre_numero_hijos, 
tbl15_historia_clinica.nombre_arl, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.cargo_empresa, tbl15_historia_clinica.area_empresa, 
tbl15_historia_clinica.ciudad_empresa, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente AS tel_cliente_hist, tbl15_historia_clinica.correo, 
tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia AS lugar_residencia_hist, tbl15_historia_clinica.nombre_contacto1, tbl15_historia_clinica.tel_contacto1, 
tbl15_historia_clinica.parentesco_contacto1, tbl15_historia_clinica.direccion_contacto1, tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.fecha_anyo, 
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_reg_time, 
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.cuenta, tbl15_historia_clinica.cuenta_reg, 
tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.ant_fam_asma_pad, tbl15_historia_clinica.ant_fam_asma_mad, tbl15_historia_clinica.ant_fam_asma_herm, 
tbl15_historia_clinica.ant_fam_asma_otro, tbl15_historia_clinica.ant_fam_asma_otro_cual, tbl15_historia_clinica.habit_tox_toxicomania, 
tbl15_historia_clinica.ant_pato_convulsion, tbl15_historia_clinica.ant_pato_claustrofobia, tbl15_historia_clinica.ant_pato_dificuloler, 
tbl15_historia_clinica.ant_pato_cardiopatia, tbl15_historia_clinica.ant_pato_lentes, tbl15_historia_clinica.ant_pato_dificuldistincolor, 
tbl15_historia_clinica.exa_fis_sistemmusculesquelet, tbl15_historia_clinica.exa_fis_sistemmusculesquelet_observ, 
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

$cod_entidad                         = $info_historia_clinica['cod_entidad'];
$cod_administrador                   = $info_historia_clinica['cod_administrador'];

$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];

$sql_profesional = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombres_prof                        = $info_profesional['nombres'];
$apellidos_prof                      = $info_profesional['apellidos'];

$cedula                              = $info_historia_clinica['cedula'];
$nombres_cli                         = $info_historia_clinica['nombres'];
$apellido1_cli                       = $info_historia_clinica['apellido1'];
$apellido2_cli                       = $info_historia_clinica['apellido2'];
$fecha_nac_time                      = $info_historia_clinica['fecha_nac_time'];
$fecha_nac_ymd                       = date("Y/m/d", $fecha_nac_time);
$nombre_ocupacion                    = $info_historia_clinica['nombre_ocupacion'];

$diferencia_edad                     = abs($fecha_hoy - $fecha_nac_time);
$edad_anyo                           = floor($diferencia_edad / (365*60*60*24));
//$edad_anyo                           = $info_historia_clinica['edad_anyo'];
$nombre_grupo_rh                     = $info_historia_clinica['nombre_grupo_rh'];
$tel_cliente_hist                    = $info_historia_clinica['tel_cliente_hist'];

$nombre_tipo_doc                     = $info_historia_clinica['nombre_tipo_doc'];
$nombre_sexo                         = $info_historia_clinica['nombre_sexo'];
$nombre_contacto1                    = $info_historia_clinica['nombre_contacto1'];
$parentesco_contacto1                = $info_historia_clinica['parentesco_contacto1'];
$tel_contacto1                       = $info_historia_clinica['tel_contacto1'];
$antperson_alergia_si                = $info_historia_clinica['antperson_alergia_si'];
$antperson_alergia_no                = $info_historia_clinica['antperson_alergia_no'];
$antperson_patologico_si             = $info_historia_clinica['antperson_patologico_si'];
$antperson_patologico_no             = $info_historia_clinica['antperson_patologico_no'];
$antperson_quirurgico_si             = $info_historia_clinica['antperson_quirurgico_si'];
$antperson_quirurgico_no             = $info_historia_clinica['antperson_quirurgico_no'];
$url_img_firma_min_cli               = $info_historia_clinica['url_img_firma_min_cli'];
$url_img_firma_cli                   = $info_historia_clinica['url_img_firma_cli'];
$url_img_foto_min_cli                = $info_historia_clinica['url_img_foto_min_cli'];
$url_img_foto_cli                    = $info_historia_clinica['url_img_foto_cli'];
$url_img_firma_min                   = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig                  = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min                    = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig                   = $info_historia_clinica['url_img_foto_orig'];
$nombre_laboratorio                  = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento                  = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento             = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica            = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica       = $info_historia_clinica['descripcion_ayuda_diagnostica'];
$nombre_tipo_regimen                 = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension                = $info_historia_clinica['nombre_fondo_pension'];
$nombre_numero_hijos                 = $info_historia_clinica['nombre_numero_hijos'];
$lugar_residencia                    = $info_historia_clinica['lugar_residencia'];
$lugar_residencia_hist               = $info_historia_clinica['lugar_residencia_hist'];
$nombre_estado_civil                 = $info_historia_clinica['nombre_estado_civil'];
$nombre_arl                          = $info_historia_clinica['nombre_arl'];
$lugar_nac                           = $info_historia_clinica['lugar_nac'];
$direccion                           = $info_historia_clinica['direccion'];
$nombre_raza                         = $info_historia_clinica['nombre_raza'];
$nombre_escolaridad                  = $info_historia_clinica['nombre_escolaridad'];
$direccion_contacto1                 = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2                 = $info_historia_clinica['direccion_contacto2'];
$nombre_empresa                      = $info_historia_clinica['nombre_empresa'];
$cargo_empresa                       = $info_historia_clinica['cargo_empresa'];
$area_empresa                        = $info_historia_clinica['area_empresa'];
$ciudad_empresa                      = $info_historia_clinica['ciudad_empresa'];
$direccion_contacto1                 = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2                 = $info_historia_clinica['direccion_contacto2'];
$direccion_contacto2                 = $info_historia_clinica['direccion_contacto2'];
$motivo                              = $info_historia_clinica['motivo'];
//$dat_ocupa_emp1                      = $info_historia_clinica['dat_ocupa_emp1'];
$dat_ocupa_emp1                      = $info_historia_clinica['nombre_empresa'];
$dat_ocupa_carg1                     = $info_historia_clinica['dat_ocupa_carg1'];
$dat_ocupa_visu1                     = $info_historia_clinica['dat_ocupa_visu1'];
$dat_ocupa_audi1                     = $info_historia_clinica['dat_ocupa_audi1'];
$dat_ocupa_altu1                     = $info_historia_clinica['dat_ocupa_altu1'];
$dat_ocupa_resp1                     = $info_historia_clinica['dat_ocupa_resp1'];
$dat_ocupa_cabeza1                   = $info_historia_clinica['dat_ocupa_cabeza1'];
$dat_ocupa_manos1                    = $info_historia_clinica['dat_ocupa_manos1'];
$dat_ocupa_tronco1                   = $info_historia_clinica['dat_ocupa_tronco1'];
$dat_ocupa_pies1                     = $info_historia_clinica['dat_ocupa_pies1'];
$dat_ocupa_fech_ini1                 = $info_historia_clinica['dat_ocupa_fech_ini1'];
$dat_ocupa_dura_anyo1                = $info_historia_clinica['dat_ocupa_dura_anyo1'];
$dat_ocupa_emp2                      = $info_historia_clinica['dat_ocupa_emp2'];
$dat_ocupa_carg2                     = $info_historia_clinica['dat_ocupa_carg2'];
$dat_ocupa_visu2                     = $info_historia_clinica['dat_ocupa_visu2'];
$dat_ocupa_audi2                     = $info_historia_clinica['dat_ocupa_audi2'];
$dat_ocupa_altu2                     = $info_historia_clinica['dat_ocupa_altu2'];
$dat_ocupa_resp2                     = $info_historia_clinica['dat_ocupa_resp2'];
$dat_ocupa_cabeza2                   = $info_historia_clinica['dat_ocupa_cabeza2'];
$dat_ocupa_manos2                    = $info_historia_clinica['dat_ocupa_manos2'];
$dat_ocupa_tronco2                   = $info_historia_clinica['dat_ocupa_tronco2'];
$dat_ocupa_pies2                     = $info_historia_clinica['dat_ocupa_pies2'];
$dat_ocupa_fech_ini2                 = $info_historia_clinica['dat_ocupa_fech_ini2'];
$dat_ocupa_dura_anyo2                = $info_historia_clinica['dat_ocupa_dura_anyo2'];
$dat_ocupa_emp3                      = $info_historia_clinica['dat_ocupa_emp3'];
$dat_ocupa_carg3                     = $info_historia_clinica['dat_ocupa_carg3'];
$dat_ocupa_visu3                     = $info_historia_clinica['dat_ocupa_visu3'];
$dat_ocupa_audi3                     = $info_historia_clinica['dat_ocupa_audi3'];
$dat_ocupa_altu3                     = $info_historia_clinica['dat_ocupa_altu3'];
$dat_ocupa_resp3                     = $info_historia_clinica['dat_ocupa_resp3'];
$dat_ocupa_cabeza3                   = $info_historia_clinica['dat_ocupa_cabeza3'];
$dat_ocupa_manos3                    = $info_historia_clinica['dat_ocupa_manos3'];
$dat_ocupa_tronco3                   = $info_historia_clinica['dat_ocupa_tronco3'];
$dat_ocupa_pies3                     = $info_historia_clinica['dat_ocupa_pies3'];
$dat_ocupa_fech_ini3                 = $info_historia_clinica['dat_ocupa_fech_ini3'];
$dat_ocupa_dura_anyo3                = $info_historia_clinica['dat_ocupa_dura_anyo3'];
$dat_ocupa_observacion               = $info_historia_clinica['dat_ocupa_observacion'];
//$clasrieg_carg1                      = $info_historia_clinica['clasrieg_carg1'];
$clasrieg_carg1                      = $info_historia_clinica['nombre_empresa'];
$clasrieg_fis1_ruid                  = $info_historia_clinica['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum                  = $info_historia_clinica['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic               = $info_historia_clinica['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra                 = $info_historia_clinica['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem            = $info_historia_clinica['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres              = $info_historia_clinica['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor             = $info_historia_clinica['clasrieg_quim1_gasvapor'];
$clasrieg_quim1_aeroliq              = $info_historia_clinica['clasrieg_quim1_aeroliq'];
$clasrieg_quim1_solid                = $info_historia_clinica['clasrieg_quim1_solid'];
$clasrieg_quim1_liquid               = $info_historia_clinica['clasrieg_quim1_liquid'];
$clasrieg_biolog1_viru               = $info_historia_clinica['clasrieg_biolog1_viru'];
$clasrieg_biolog1_bacter             = $info_historia_clinica['clasrieg_biolog1_bacter'];
$clasrieg_biolog1_parasi             = $info_historia_clinica['clasrieg_biolog1_parasi'];
$clasrieg_biolog1_morde              = $info_historia_clinica['clasrieg_biolog1_morde'];
$clasrieg_biolog1_picad              = $info_historia_clinica['clasrieg_biolog1_picad'];
$clasrieg_biolog1_hongo              = $info_historia_clinica['clasrieg_biolog1_hongo'];
$clasrieg_ergo1_trabestat            = $info_historia_clinica['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis            = $info_historia_clinica['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga                = $info_historia_clinica['clasrieg_ergo1_carga'];
$clasrieg_ergo1_postforz             = $info_historia_clinica['clasrieg_ergo1_postforz'];
$clasrieg_ergo1_movrepet             = $info_historia_clinica['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_jortrab              = $info_historia_clinica['clasrieg_ergo1_jortrab'];
$clasrieg_psi1_monoto                = $info_historia_clinica['clasrieg_psi1_monoto'];
$clasrieg_psi1_relhuman              = $info_historia_clinica['clasrieg_psi1_relhuman'];
$clasrieg_psi1_contentarea           = $info_historia_clinica['clasrieg_psi1_contentarea'];
$clasrieg_psi1_orgtiemptrab          = $info_historia_clinica['clasrieg_psi1_orgtiemptrab'];
$clasrieg_segur1_mecanic             = $info_historia_clinica['clasrieg_segur1_mecanic'];
$clasrieg_segur1_electri             = $info_historia_clinica['clasrieg_segur1_electri'];
$clasrieg_segur1_locat               = $info_historia_clinica['clasrieg_segur1_locat'];
$clasrieg_segur1_fisiquim            = $info_historia_clinica['clasrieg_segur1_fisiquim'];
$clasrieg_segur1_public              = $info_historia_clinica['clasrieg_segur1_public'];
$clasrieg_segur1_espconfi            = $info_historia_clinica['clasrieg_segur1_espconfi'];
$clasrieg_segur1_trabaltura          = $info_historia_clinica['clasrieg_segur1_trabaltura'];
$clasrieg_observ1_otro               = $info_historia_clinica['clasrieg_observ1_otro'];
$clasrieg_observ1_coment             = $info_historia_clinica['clasrieg_observ1_coment'];
$clasrieg_carg2                      = $info_historia_clinica['clasrieg_carg2'];
$clasrieg_fis2_ruid                  = $info_historia_clinica['clasrieg_fis2_ruid'];
$clasrieg_fis2_ilum                  = $info_historia_clinica['clasrieg_fis2_ilum'];
$clasrieg_fis2_noionic               = $info_historia_clinica['clasrieg_fis2_noionic'];
$clasrieg_fis2_vibra                 = $info_historia_clinica['clasrieg_fis2_vibra'];
$clasrieg_fis2_tempextrem            = $info_historia_clinica['clasrieg_fis2_tempextrem'];
$clasrieg_fis2_cambpres              = $info_historia_clinica['clasrieg_fis2_cambpres'];
$clasrieg_quim2_gasvapor             = $info_historia_clinica['clasrieg_quim2_gasvapor'];
$clasrieg_quim2_aeroliq              = $info_historia_clinica['clasrieg_quim2_aeroliq'];
$clasrieg_quim2_solid                = $info_historia_clinica['clasrieg_quim2_solid'];
$clasrieg_quim2_liquid               = $info_historia_clinica['clasrieg_quim2_liquid'];
$clasrieg_biolog2_viru               = $info_historia_clinica['clasrieg_biolog2_viru'];
$clasrieg_biolog2_bacter             = $info_historia_clinica['clasrieg_biolog2_bacter'];
$clasrieg_biolog2_parasi             = $info_historia_clinica['clasrieg_biolog2_parasi'];
$clasrieg_biolog2_morde              = $info_historia_clinica['clasrieg_biolog2_morde'];
$clasrieg_biolog2_picad              = $info_historia_clinica['clasrieg_biolog2_picad'];
$clasrieg_biolog2_hongo              = $info_historia_clinica['clasrieg_biolog2_hongo'];
$clasrieg_ergo2_trabestat            = $info_historia_clinica['clasrieg_ergo2_trabestat'];
$clasrieg_ergo2_esfuerfis            = $info_historia_clinica['clasrieg_ergo2_esfuerfis'];
$clasrieg_ergo2_carga                = $info_historia_clinica['clasrieg_ergo2_carga'];
$clasrieg_ergo2_postforz             = $info_historia_clinica['clasrieg_ergo2_postforz'];
$clasrieg_ergo2_movrepet             = $info_historia_clinica['clasrieg_ergo2_movrepet'];
$clasrieg_ergo2_jortrab              = $info_historia_clinica['clasrieg_ergo2_jortrab'];
$clasrieg_psi2_monoto                = $info_historia_clinica['clasrieg_psi2_monoto'];
$clasrieg_psi2_relhuman              = $info_historia_clinica['clasrieg_psi2_relhuman'];
$clasrieg_psi2_contentarea           = $info_historia_clinica['clasrieg_psi2_contentarea'];
$clasrieg_psi2_orgtiemptrab          = $info_historia_clinica['clasrieg_psi2_orgtiemptrab'];
$clasrieg_segur2_mecanic             = $info_historia_clinica['clasrieg_segur2_mecanic'];
$clasrieg_segur2_electri             = $info_historia_clinica['clasrieg_segur2_electri'];
$clasrieg_segur2_locat               = $info_historia_clinica['clasrieg_segur2_locat'];
$clasrieg_segur2_fisiquim            = $info_historia_clinica['clasrieg_segur2_fisiquim'];
$clasrieg_segur2_public              = $info_historia_clinica['clasrieg_segur2_public'];
$clasrieg_segur2_espconfi            = $info_historia_clinica['clasrieg_segur2_espconfi'];
$clasrieg_segur2_trabaltura          = $info_historia_clinica['clasrieg_segur2_trabaltura'];
$clasrieg_observ2_otro               = $info_historia_clinica['clasrieg_observ2_otro'];
$clasrieg_observ2_coment             = $info_historia_clinica['clasrieg_observ2_coment'];
$clasrieg_carg3                      = $info_historia_clinica['clasrieg_carg3'];
$clasrieg_fis3_ruid                  = $info_historia_clinica['clasrieg_fis3_ruid'];
$clasrieg_fis3_ilum                  = $info_historia_clinica['clasrieg_fis3_ilum'];
$clasrieg_fis3_noionic               = $info_historia_clinica['clasrieg_fis3_noionic'];
$clasrieg_fis3_vibra                 = $info_historia_clinica['clasrieg_fis3_vibra'];
$clasrieg_fis3_tempextrem            = $info_historia_clinica['clasrieg_fis3_tempextrem'];
$clasrieg_fis3_cambpres              = $info_historia_clinica['clasrieg_fis3_cambpres'];
$clasrieg_quim3_gasvapor             = $info_historia_clinica['clasrieg_quim3_gasvapor'];
$clasrieg_quim3_aeroliq              = $info_historia_clinica['clasrieg_quim3_aeroliq'];
$clasrieg_quim3_solid                = $info_historia_clinica['clasrieg_quim3_solid'];
$clasrieg_quim3_liquid               = $info_historia_clinica['clasrieg_quim3_liquid'];
$clasrieg_biolog3_viru               = $info_historia_clinica['clasrieg_biolog3_viru'];
$clasrieg_biolog3_bacter             = $info_historia_clinica['clasrieg_biolog3_bacter'];
$clasrieg_biolog3_parasi             = $info_historia_clinica['clasrieg_biolog3_parasi'];
$clasrieg_biolog3_morde              = $info_historia_clinica['clasrieg_biolog3_morde'];
$clasrieg_biolog3_picad              = $info_historia_clinica['clasrieg_biolog3_picad'];
$clasrieg_biolog3_hongo              = $info_historia_clinica['clasrieg_biolog3_hongo'];
$clasrieg_ergo3_trabestat            = $info_historia_clinica['clasrieg_ergo3_trabestat'];
$clasrieg_ergo3_esfuerfis            = $info_historia_clinica['clasrieg_ergo3_esfuerfis'];
$clasrieg_ergo3_carga                = $info_historia_clinica['clasrieg_ergo3_carga'];
$clasrieg_ergo3_postforz             = $info_historia_clinica['clasrieg_ergo3_postforz'];
$clasrieg_ergo3_movrepet             = $info_historia_clinica['clasrieg_ergo3_movrepet'];
$clasrieg_ergo3_jortrab              = $info_historia_clinica['clasrieg_ergo3_jortrab'];
$clasrieg_psi3_monoto                = $info_historia_clinica['clasrieg_psi3_monoto'];
$clasrieg_psi3_relhuman              = $info_historia_clinica['clasrieg_psi3_relhuman'];
$clasrieg_psi3_contentarea           = $info_historia_clinica['clasrieg_psi3_contentarea'];
$clasrieg_psi3_orgtiemptrab          = $info_historia_clinica['clasrieg_psi3_orgtiemptrab'];
$clasrieg_segur3_mecanic             = $info_historia_clinica['clasrieg_segur3_mecanic'];
$clasrieg_segur3_electri             = $info_historia_clinica['clasrieg_segur3_electri'];
$clasrieg_segur3_locat               = $info_historia_clinica['clasrieg_segur3_locat'];
$clasrieg_segur3_fisiquim            = $info_historia_clinica['clasrieg_segur3_fisiquim'];
$clasrieg_segur3_public              = $info_historia_clinica['clasrieg_segur3_public'];
$clasrieg_segur3_espconfi            = $info_historia_clinica['clasrieg_segur3_espconfi'];
$clasrieg_segur3_trabaltura          = $info_historia_clinica['clasrieg_segur3_trabaltura'];
$clasrieg_observ3_otro               = $info_historia_clinica['clasrieg_observ3_otro'];
$clasrieg_observ3_coment             = $info_historia_clinica['clasrieg_observ3_coment'];
$ant_impor_accilab                   = $info_historia_clinica['ant_impor_accilab'];
$ant_impor_fecha1                    = $info_historia_clinica['ant_impor_fecha1'];
$ant_impor_empre1                    = $info_historia_clinica['ant_impor_empre1'];
$ant_impor_causa1                    = $info_historia_clinica['ant_impor_causa1'];
$ant_impor_tip_lesi1                 = $info_historia_clinica['ant_impor_tip_lesi1'];
$ant_impor_part_afect1               = $info_historia_clinica['ant_impor_part_afect1'];
$ant_impor_dias_incap1               = $info_historia_clinica['ant_impor_dias_incap1'];
$ant_impor_secuela1                  = $info_historia_clinica['ant_impor_secuela1'];
$ant_impor_fecha2                    = $info_historia_clinica['ant_impor_fecha2'];
$ant_impor_empre2                    = $info_historia_clinica['ant_impor_empre2'];
$ant_impor_causa2                    = $info_historia_clinica['ant_impor_causa2'];
$ant_impor_tip_lesi2 = $info_historia_clinica['ant_impor_tip_lesi2'];
$ant_impor_part_afect2 = $info_historia_clinica['ant_impor_part_afect2'];
$ant_impor_dias_incap2 = $info_historia_clinica['ant_impor_dias_incap2'];
$ant_impor_secuela2 = $info_historia_clinica['ant_impor_secuela2'];
$enf_lab = $info_historia_clinica['enf_lab'];
$enf_cual = $info_historia_clinica['enf_cual'];
$enf_hace_cuanto = $info_historia_clinica['enf_hace_cuanto'];
$enf_descripcion = $info_historia_clinica['enf_descripcion'];
$ant_fam_no_presenta = $info_historia_clinica['ant_fam_no_presenta'];
$ant_fam_hiper_pad = $info_historia_clinica['ant_fam_hiper_pad'];
$ant_fam_hiper_mad = $info_historia_clinica['ant_fam_hiper_mad'];
$ant_fam_hiper_herm = $info_historia_clinica['ant_fam_hiper_herm'];
$ant_fam_hiper_otro = $info_historia_clinica['ant_fam_hiper_otro'];
$ant_fam_hiper_otro_cual = $info_historia_clinica['ant_fam_hiper_otro_cual'];
$ant_fam_diabet_pad = $info_historia_clinica['ant_fam_diabet_pad'];
$ant_fam_diabet_mad = $info_historia_clinica['ant_fam_diabet_mad'];
$ant_fam_diabet_herm = $info_historia_clinica['ant_fam_diabet_herm'];
$ant_fam_diabet_otro = $info_historia_clinica['ant_fam_diabet_otro'];
$ant_fam_diabet_otro_cual = $info_historia_clinica['ant_fam_diabet_otro_cual'];
$ant_fam_trombos_pad = $info_historia_clinica['ant_fam_trombos_pad'];
$ant_fam_trombos_mad = $info_historia_clinica['ant_fam_trombos_mad'];
$ant_fam_trombos_herm = $info_historia_clinica['ant_fam_trombos_herm'];
$ant_fam_trombos_otro = $info_historia_clinica['ant_fam_trombos_otro'];
$ant_fam_trombos_otro_cual = $info_historia_clinica['ant_fam_trombos_otro_cual'];
$ant_fam_tum_malig_pad = $info_historia_clinica['ant_fam_tum_malig_pad'];
$ant_fam_tum_malig_mad = $info_historia_clinica['ant_fam_tum_malig_mad'];
$ant_fam_tum_malig_herm = $info_historia_clinica['ant_fam_tum_malig_herm'];
$ant_fam_tum_malig_otro = $info_historia_clinica['ant_fam_tum_malig_otro'];
$ant_fam_tum_malig_otro_cual = $info_historia_clinica['ant_fam_tum_malig_otro_cual'];
$ant_fam_enf_ment_pad = $info_historia_clinica['ant_fam_enf_ment_pad'];
$ant_fam_enf_ment_mad = $info_historia_clinica['ant_fam_enf_ment_mad'];
$ant_fam_enf_ment_herm = $info_historia_clinica['ant_fam_enf_ment_herm'];
$ant_fam_enf_ment_otro = $info_historia_clinica['ant_fam_enf_ment_otro'];
$ant_fam_enf_ment_otro_cual = $info_historia_clinica['ant_fam_enf_ment_otro_cual'];
$ant_fam_cadio_pad = $info_historia_clinica['ant_fam_cadio_pad'];
$ant_fam_cadio_mad = $info_historia_clinica['ant_fam_cadio_mad'];
$ant_fam_cadio_herm = $info_historia_clinica['ant_fam_cadio_herm'];
$ant_fam_cadio_otro = $info_historia_clinica['ant_fam_cadio_otro'];
$ant_fam_cadio_otro_cual = $info_historia_clinica['ant_fam_cadio_otro_cual'];
$ant_fam_trans_convul_pad = $info_historia_clinica['ant_fam_trans_convul_pad'];
$ant_fam_trans_convul_mad = $info_historia_clinica['ant_fam_trans_convul_mad'];
$ant_fam_trans_convul_herm = $info_historia_clinica['ant_fam_trans_convul_herm'];
$ant_fam_trans_convul_otro = $info_historia_clinica['ant_fam_trans_convul_otro'];
$ant_fam_trans_convul_otro_cual = $info_historia_clinica['ant_fam_trans_convul_otro_cual'];
$ant_fam_enf_gene_pad = $info_historia_clinica['ant_fam_enf_gene_pad'];
$ant_fam_enf_gene_mad = $info_historia_clinica['ant_fam_enf_gene_mad'];
$ant_fam_enf_gene_herm = $info_historia_clinica['ant_fam_enf_gene_herm'];
$ant_fam_enf_gene_otro = $info_historia_clinica['ant_fam_enf_gene_otro'];
$ant_fam_enf_gene_otro_cual = $info_historia_clinica['ant_fam_enf_gene_otro_cual'];
$ant_fam_alerg_pad = $info_historia_clinica['ant_fam_alerg_pad'];
$ant_fam_alerg_mad = $info_historia_clinica['ant_fam_alerg_mad'];
$ant_fam_alerg_herm = $info_historia_clinica['ant_fam_alerg_herm'];
$ant_fam_alerg_otro = $info_historia_clinica['ant_fam_alerg_otro'];
$ant_fam_alerg_otro_cual = $info_historia_clinica['ant_fam_alerg_otro_cual'];
$ant_fam_tuber_pad = $info_historia_clinica['ant_fam_tuber_pad'];
$ant_fam_tuber_mad = $info_historia_clinica['ant_fam_tuber_mad'];
$ant_fam_tuber_herm = $info_historia_clinica['ant_fam_tuber_herm'];
$ant_fam_tuber_otro = $info_historia_clinica['ant_fam_tuber_otro'];
$ant_fam_tuber_otro_cual = $info_historia_clinica['ant_fam_tuber_otro_cual'];
$ant_fam_osteomusc_pad = $info_historia_clinica['ant_fam_osteomusc_pad'];
$ant_fam_osteomusc_mad = $info_historia_clinica['ant_fam_osteomusc_mad'];
$ant_fam_osteomusc_herm = $info_historia_clinica['ant_fam_osteomusc_herm'];
$ant_fam_osteomusc_otro = $info_historia_clinica['ant_fam_osteomusc_otro'];
$ant_fam_osteomusc_otro_cual = $info_historia_clinica['ant_fam_osteomusc_otro_cual'];
$ant_fam_artitri_pad = $info_historia_clinica['ant_fam_artitri_pad'];
$ant_fam_artitri_mad = $info_historia_clinica['ant_fam_artitri_mad'];
$ant_fam_artitri_herm = $info_historia_clinica['ant_fam_artitri_herm'];
$ant_fam_artitri_otro = $info_historia_clinica['ant_fam_artitri_otro'];
$ant_fam_artitri_otro_cual = $info_historia_clinica['ant_fam_artitri_otro_cual'];
$ant_fam_varice_pad = $info_historia_clinica['ant_fam_varice_pad'];
$ant_fam_varice_mad = $info_historia_clinica['ant_fam_varice_mad'];
$ant_fam_varice_herm = $info_historia_clinica['ant_fam_varice_herm'];
$ant_fam_varice_otro = $info_historia_clinica['ant_fam_varice_otro'];
$ant_fam_varice_otro_cual = $info_historia_clinica['ant_fam_varice_otro_cual'];
$ant_fam_otro_pad = $info_historia_clinica['ant_fam_otro_pad'];
$ant_fam_otro_mad = $info_historia_clinica['ant_fam_otro_mad'];
$ant_fam_otro_herm = $info_historia_clinica['ant_fam_otro_herm'];
$ant_fam_otro_otro = $info_historia_clinica['ant_fam_otro_otro'];
$ant_fam_otro_otro_cual = $info_historia_clinica['ant_fam_otro_otro_cual'];
$ant_fam_descripcion = $info_historia_clinica['ant_fam_descripcion'];
$ant_pato_no_presenta = $info_historia_clinica['ant_pato_no_presenta'];
$ant_pato_neuro = $info_historia_clinica['ant_pato_neuro'];
$ant_pato_resp = $info_historia_clinica['ant_pato_resp'];
$ant_pato_derma = $info_historia_clinica['ant_pato_derma'];
$ant_pato_psiq = $info_historia_clinica['ant_pato_psiq'];
$ant_pato_alerg = $info_historia_clinica['ant_pato_alerg'];
$ant_pato_osteomusc = $info_historia_clinica['ant_pato_osteomusc'];
$ant_pato_gastrointes = $info_historia_clinica['ant_pato_gastrointes'];
$ant_pato_hematolog = $info_historia_clinica['ant_pato_hematolog'];
$ant_pato_org_sentid = $info_historia_clinica['ant_pato_org_sentid'];
$ant_pato_onco = $info_historia_clinica['ant_pato_onco'];
$ant_pato_hiperten = $info_historia_clinica['ant_pato_hiperten'];
$ant_pato_genurinario = $info_historia_clinica['ant_pato_genurinario'];
$ant_pato_infesios = $info_historia_clinica['ant_pato_infesios'];
$ant_pato_congenit = $info_historia_clinica['ant_pato_congenit'];
$ant_pato_farmacolog = $info_historia_clinica['ant_pato_farmacolog'];
$ant_pato_transfus = $info_historia_clinica['ant_pato_transfus'];
$ant_pato_endocrino = $info_historia_clinica['ant_pato_endocrino'];
$ant_pato_vascular = $info_historia_clinica['ant_pato_vascular'];
$ant_pato_auntoinmun = $info_historia_clinica['ant_pato_auntoinmun'];
$ant_pato_otro = $info_historia_clinica['ant_pato_otro'];
$ant_pato_descripcion = $info_historia_clinica['ant_pato_descripcion'];
$ant_altu_no = $info_historia_clinica['ant_altu_no'];
$ant_altu_epilep = $info_historia_clinica['ant_altu_epilep'];
$ant_altu_otitmed = $info_historia_clinica['ant_altu_otitmed'];
$ant_altu_enfmanier = $info_historia_clinica['ant_altu_enfmanier'];
$ant_altu_traumcran = $info_historia_clinica['ant_altu_traumcran'];
$ant_altu_tumcereb = $info_historia_clinica['ant_altu_tumcereb'];
$ant_altu_malfocereb = $info_historia_clinica['ant_altu_malfocereb'];
$ant_altu_trombo = $info_historia_clinica['ant_altu_trombo'];
$ant_altu_hipoac = $info_historia_clinica['ant_altu_hipoac'];
$ant_altu_arritcardi = $info_historia_clinica['ant_altu_arritcardi'];
$ant_altu_hipogli = $info_historia_clinica['ant_altu_hipogli'];
$ant_altu_fobia = $info_historia_clinica['ant_altu_fobia'];
$ant_altu_observ = $info_historia_clinica['ant_altu_observ'];
$ant_trau = $info_historia_clinica['ant_trau'];
$ant_trau_enfer1 = $info_historia_clinica['ant_trau_enfer1'];
$ant_trau_observ1 = $info_historia_clinica['ant_trau_observ1'];
$ant_trau_fech_aprox1 = $info_historia_clinica['ant_trau_fech_aprox1'];
$ant_trau_enfer2 = $info_historia_clinica['ant_trau_enfer2'];
$ant_trau_observ2 = $info_historia_clinica['ant_trau_observ2'];
$ant_trau_fech_aprox2 = $info_historia_clinica['ant_trau_fech_aprox2'];
$ant_trau_enfer3 = $info_historia_clinica['ant_trau_enfer3'];
$ant_trau_observ3 = $info_historia_clinica['ant_trau_observ3'];
$ant_trau_fech_aprox3 = $info_historia_clinica['ant_trau_fech_aprox3'];
$ant_quirur = $info_historia_clinica['ant_quirur'];
$ant_quirur_enfer1 = $info_historia_clinica['ant_quirur_enfer1'];
$ant_quirur_observ1 = $info_historia_clinica['ant_quirur_observ1'];
$ant_quirur_fech_aprox1 = $info_historia_clinica['ant_quirur_fech_aprox1'];
$ant_quirur_enfer2 = $info_historia_clinica['ant_quirur_enfer2'];
$ant_quirur_observ2 = $info_historia_clinica['ant_quirur_observ2'];
$ant_quirur_fech_aprox2 = $info_historia_clinica['ant_quirur_fech_aprox2'];
$ant_quirur_enfer3 = $info_historia_clinica['ant_quirur_enfer3'];
$ant_quirur_observ3 = $info_historia_clinica['ant_quirur_observ3'];
$ant_quirur_fech_aprox3 = $info_historia_clinica['ant_quirur_fech_aprox3'];
$ant_inmuni = $info_historia_clinica['ant_inmuni'];
$ant_inmuni_tetano = $info_historia_clinica['ant_inmuni_tetano'];
$ant_inmuni_tetano_anyo = $info_historia_clinica['ant_inmuni_tetano_anyo'];
$ant_inmuni_fiebtifo = $info_historia_clinica['ant_inmuni_fiebtifo'];
$ant_inmuni_fiebtifo_anyo = $info_historia_clinica['ant_inmuni_fiebtifo_anyo'];
$ant_inmuni_hepatita = $info_historia_clinica['ant_inmuni_hepatita'];
$ant_inmuni_hepatita_anyo = $info_historia_clinica['ant_inmuni_hepatita_anyo'];
$ant_inmuni_influenza = $info_historia_clinica['ant_inmuni_influenza'];
$ant_inmuni_influenza_anyo = $info_historia_clinica['ant_inmuni_influenza_anyo'];
$ant_inmuni_hepatitb = $info_historia_clinica['ant_inmuni_hepatitb'];
$ant_inmuni_hepatitb_anyo = $info_historia_clinica['ant_inmuni_hepatitb_anyo'];
$ant_inmuni_saramp = $info_historia_clinica['ant_inmuni_saramp'];
$ant_inmuni_saramp_anyo = $info_historia_clinica['ant_inmuni_saramp_anyo'];
$ant_inmuni_fiebamarill = $info_historia_clinica['ant_inmuni_fiebamarill'];
$ant_inmuni_fiebamarill_anyo = $info_historia_clinica['ant_inmuni_fiebamarill_anyo'];
$ant_inmuni_otra = $info_historia_clinica['ant_inmuni_otra'];
$ant_inmuni_otra_anyo = $info_historia_clinica['ant_inmuni_otra_anyo'];
$ant_inmuni_observacion = $info_historia_clinica['ant_inmuni_observacion'];
$ant_gine_prim_mestrua = $info_historia_clinica['ant_gine_prim_mestrua'];
$ant_gine_anyos = $info_historia_clinica['ant_gine_anyos'];
$ant_gine_cliclo = $info_historia_clinica['ant_gine_cliclo'];
$ant_gine_fum = $info_historia_clinica['ant_gine_fum'];
$ant_gine_fup = $info_historia_clinica['ant_gine_fup'];
$ant_gine_fuc = $info_historia_clinica['ant_gine_fuc'];
$ant_gine_fich_gine = $info_historia_clinica['ant_gine_fich_gine'];
$ant_gine_fich_gine_g = $info_historia_clinica['ant_gine_fich_gine_g'];
$ant_gine_fich_gine_p = $info_historia_clinica['ant_gine_fich_gine_p'];
$ant_gine_fich_gine_a = $info_historia_clinica['ant_gine_fich_gine_a'];
$ant_gine_fich_gine_c = $info_historia_clinica['ant_gine_fich_gine_c'];
$ant_gine_fich_gine_m = $info_historia_clinica['ant_gine_fich_gine_m'];
$ant_gine_fich_gine_e = $info_historia_clinica['ant_gine_fich_gine_e'];
$ant_gine_fich_gine_v = $info_historia_clinica['ant_gine_fich_gine_v'];
$ant_gine_fech_ult_exa_mama = $info_historia_clinica['ant_gine_fech_ult_exa_mama'];
$ant_gine_planifica = $info_historia_clinica['ant_gine_planifica'];
$ant_gine_observacion = $info_historia_clinica['ant_gine_observacion'];
$habit_tox_fum_nofum_exfum = $info_historia_clinica['habit_tox_fum_nofum_exfum'];
$habit_tox_ciga_aldia = $info_historia_clinica['habit_tox_ciga_aldia'];
$habit_tox_anyos_fum = $info_historia_clinica['habit_tox_anyos_fum'];
$habit_tox_tiem_sinfum = $info_historia_clinica['habit_tox_tiem_sinfum'];
$habit_tox_consum_alcoh = $info_historia_clinica['habit_tox_consum_alcoh'];
$habit_tox_activ_extralab = $info_historia_clinica['habit_tox_activ_extralab'];
$habit_tox_activfis = $info_historia_clinica['habit_tox_activfis'];
$habit_tox_actividad = $info_historia_clinica['habit_tox_actividad'];
$habit_tox_frecuenc = $info_historia_clinica['habit_tox_frecuenc'];
$habit_tox_tiempo = $info_historia_clinica['habit_tox_tiempo'];
$rev_sist_orgsentido = $info_historia_clinica['rev_sist_orgsentido'];
$rev_sist_observ_orgsentido = $info_historia_clinica['rev_sist_observ_orgsentido'];
$rev_sist_neurolog = $info_historia_clinica['rev_sist_neurolog'];
$rev_sist_observ_neurolog = $info_historia_clinica['rev_sist_observ_neurolog'];
$rev_sist_resp = $info_historia_clinica['rev_sist_resp'];
$rev_sist_observ_resp = $info_historia_clinica['rev_sist_observ_resp'];
$rev_sist_gastrointes = $info_historia_clinica['rev_sist_gastrointes'];
$rev_sist_observ_gastrointes = $info_historia_clinica['rev_sist_observ_gastrointes'];
$rev_sist_geniuri = $info_historia_clinica['rev_sist_geniuri'];
$rev_sist_observ_geniuri = $info_historia_clinica['rev_sist_observ_geniuri'];
$rev_sist_osteomus = $info_historia_clinica['rev_sist_osteomus'];
$rev_sist_observ_osteomus = $info_historia_clinica['rev_sist_observ_osteomus'];
$rev_sist_dermato = $info_historia_clinica['rev_sist_dermato'];
$rev_sist_observ_dermato = $info_historia_clinica['rev_sist_observ_dermato'];
$rev_sist_cardiovas = $info_historia_clinica['rev_sist_cardiovas'];
$rev_sist_observ_cardiovas = $info_historia_clinica['rev_sist_observ_cardiovas'];
$rev_sist_constitu = $info_historia_clinica['rev_sist_constitu'];
$rev_sist_observ_constitu = $info_historia_clinica['rev_sist_observ_constitu'];
$rev_sist_metabolendocri = $info_historia_clinica['rev_sist_metabolendocri'];
$rev_sist_observ_metabolendocri = $info_historia_clinica['rev_sist_observ_metabolendocri'];
$eval_estment_norm_orient = $info_historia_clinica['eval_estment_norm_orient'];
$eval_estment_disf_orient = $info_historia_clinica['eval_estment_disf_orient'];
$eval_estment_halla_orient = $info_historia_clinica['eval_estment_halla_orient'];
$eval_estment_norm_atenconcent = $info_historia_clinica['eval_estment_norm_atenconcent'];
$eval_estment_disf_atenconcent = $info_historia_clinica['eval_estment_disf_atenconcent'];
$eval_estment_halla_atenconcent = $info_historia_clinica['eval_estment_halla_atenconcent'];
$eval_estment_norm_sensoper = $info_historia_clinica['eval_estment_norm_sensoper'];
$eval_estment_disf_sensoper = $info_historia_clinica['eval_estment_disf_sensoper'];
$eval_estment_halla_sensoper = $info_historia_clinica['eval_estment_halla_sensoper'];
$eval_estment_norm_memor = $info_historia_clinica['eval_estment_norm_memor'];
$eval_estment_disf_memor = $info_historia_clinica['eval_estment_disf_memor'];
$eval_estment_halla_memor = $info_historia_clinica['eval_estment_halla_memor'];
$eval_estment_norm_pensami = $info_historia_clinica['eval_estment_norm_pensami'];
$eval_estment_disf_pensami = $info_historia_clinica['eval_estment_disf_pensami'];
$eval_estment_halla_pensami = $info_historia_clinica['eval_estment_halla_pensami'];
$eval_estment_norm_lenguaj = $info_historia_clinica['eval_estment_norm_lenguaj'];
$eval_estment_disf_lenguaj = $info_historia_clinica['eval_estment_disf_lenguaj'];
$eval_estment_halla_lenguaj = $info_historia_clinica['eval_estment_halla_lenguaj'];
$eval_estment_concept = $info_historia_clinica['eval_estment_concept'];
$exa_fis_peso = $info_historia_clinica['exa_fis_peso'];
$exa_fis_talla = $info_historia_clinica['exa_fis_talla'];
$exa_fis_imc = $info_historia_clinica['exa_fis_imc'];
$exa_fis_interpreimc = $info_historia_clinica['exa_fis_interpreimc'];
$exa_fis_fresp = $info_historia_clinica['exa_fis_fresp'];
$exa_fis_fc = $info_historia_clinica['exa_fis_fc'];
$exa_fis_ta = $info_historia_clinica['exa_fis_ta'];
$exa_fis_lateral = $info_historia_clinica['exa_fis_lateral'];
$exa_fis_periabdom = $info_historia_clinica['exa_fis_periabdom'];
$exa_fis_temperat = $info_historia_clinica['exa_fis_temperat'];
$exa_fis_concepto = $info_historia_clinica['exa_fis_concepto'];
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
$exa_fis_ojo = $info_historia_clinica['exa_fis_ojo'];
$exa_fis_ojo_obser = $info_historia_clinica['exa_fis_ojo_obser'];
$exa_fis_oido = $info_historia_clinica['exa_fis_oido'];
$exa_fis_oido_obser = $info_historia_clinica['exa_fis_oido_obser'];
$exa_fis_cabeza = $info_historia_clinica['exa_fis_cabeza'];
$exa_fis_cabeza_obser = $info_historia_clinica['exa_fis_cabeza_obser'];
$exa_fis_nariz = $info_historia_clinica['exa_fis_nariz'];
$exa_fis_nariz_obser = $info_historia_clinica['exa_fis_nariz_obser'];
$exa_fis_orofaring = $info_historia_clinica['exa_fis_orofaring'];
$exa_fis_orofaring_obser = $info_historia_clinica['exa_fis_orofaring_obser'];
$exa_fis_cuello = $info_historia_clinica['exa_fis_cuello'];
$exa_fis_cuello_obser = $info_historia_clinica['exa_fis_cuello_obser'];
$exa_fis_torax = $info_historia_clinica['exa_fis_torax'];
$exa_fis_torax_obser = $info_historia_clinica['exa_fis_torax_obser'];
$exa_fis_glandumama = $info_historia_clinica['exa_fis_glandumama'];
$exa_fis_glandumama_obser = $info_historia_clinica['exa_fis_glandumama_obser'];
$exa_fis_cardiopulm = $info_historia_clinica['exa_fis_cardiopulm'];
$exa_fis_cardiopulm_obser = $info_historia_clinica['exa_fis_cardiopulm_obser'];
$exa_fis_abdomen = $info_historia_clinica['exa_fis_abdomen'];
$exa_fis_abdomen_obser = $info_historia_clinica['exa_fis_abdomen_obser'];
$exa_fis_genital = $info_historia_clinica['exa_fis_genital'];
$exa_fis_genital_obser = $info_historia_clinica['exa_fis_genital_obser'];
$exa_fis_miemsup = $info_historia_clinica['exa_fis_miemsup'];
$exa_fis_miemsup_obser = $info_historia_clinica['exa_fis_miemsup_obser'];
$exa_fis_mieminf = $info_historia_clinica['exa_fis_mieminf'];
$exa_fis_mieminf_obser = $info_historia_clinica['exa_fis_mieminf_obser'];
$exa_fis_columna = $info_historia_clinica['exa_fis_columna'];
$exa_fis_columna_obser = $info_historia_clinica['exa_fis_columna_obser'];
$exa_fis_neurolog = $info_historia_clinica['exa_fis_neurolog'];
$exa_fis_neurolog_obser = $info_historia_clinica['exa_fis_neurolog_obser'];
$exa_fis_neurolog_romberg = $info_historia_clinica['exa_fis_neurolog_romberg'];
$exa_fis_neurolog_barany = $info_historia_clinica['exa_fis_neurolog_barany'];
$exa_fis_neurolog_dixhalp = $info_historia_clinica['exa_fis_neurolog_dixhalp'];
$exa_fis_neurolog_mciega = $info_historia_clinica['exa_fis_neurolog_mciega'];
$exa_fis_neurolog_pciega = $info_historia_clinica['exa_fis_neurolog_pciega'];
$exa_fis_estmentaparent = $info_historia_clinica['exa_fis_estmentaparent'];
$exa_fis_estmentaparent_obser = $info_historia_clinica['exa_fis_estmentaparent_obser'];
$exa_fis_pielfanera = $info_historia_clinica['exa_fis_pielfanera'];
$exa_fis_pielfanera_obser = $info_historia_clinica['exa_fis_pielfanera_obser'];
$exaosteo_homb_movart = $info_historia_clinica['exaosteo_homb_movart'];
$exaosteo_homb_fuerza = $info_historia_clinica['exaosteo_homb_fuerza'];
$exaosteo_manjobe_sig = $info_historia_clinica['exaosteo_manjobe_sig'];
$exaosteo_manjobe_lat = $info_historia_clinica['exaosteo_manjobe_lat'];
$exaosteo_manjobe_movart = $info_historia_clinica['exaosteo_manjobe_movart'];
$exaosteo_manjobe_fuerza = $info_historia_clinica['exaosteo_manjobe_fuerza'];
$exaosteo_manyega_sig = $info_historia_clinica['exaosteo_manyega_sig'];
$exaosteo_manyega_lat = $info_historia_clinica['exaosteo_manyega_lat'];
$exaosteo_manyega_movart = $info_historia_clinica['exaosteo_manyega_movart'];
$exaosteo_manyega_fuerza = $info_historia_clinica['exaosteo_manyega_fuerza'];
$exaosteo_manpatte_sig = $info_historia_clinica['exaosteo_manpatte_sig'];
$exaosteo_manpatte_lat = $info_historia_clinica['exaosteo_manpatte_lat'];
$exaosteo_epicond_sig = $info_historia_clinica['exaosteo_epicond_sig'];
$exaosteo_epicond_lat = $info_historia_clinica['exaosteo_epicond_lat'];
$exaosteo_tinel_sig = $info_historia_clinica['exaosteo_tinel_sig'];
$exaosteo_tinel_lat = $info_historia_clinica['exaosteo_tinel_lat'];
$exaosteo_epitro_sig = $info_historia_clinica['exaosteo_epitro_sig'];
$exaosteo_epitro_lat = $info_historia_clinica['exaosteo_epitro_lat'];
$exaosteo_phalen_sig = $info_historia_clinica['exaosteo_phalen_sig'];
$exaosteo_phalen_lat = $info_historia_clinica['exaosteo_phalen_lat'];
$exaosteo_thomp_sig = $info_historia_clinica['exaosteo_thomp_sig'];
$exaosteo_thomp_lat = $info_historia_clinica['exaosteo_thomp_lat'];
$exaosteo_finkel_sig = $info_historia_clinica['exaosteo_finkel_sig'];
$exaosteo_finkel_lat = $info_historia_clinica['exaosteo_finkel_lat'];
$exaosteo_laseg_sig = $info_historia_clinica['exaosteo_laseg_sig'];
$exaosteo_bostezo_sig = $info_historia_clinica['exaosteo_bostezo_sig'];
$exaosteo_bostezo_lat = $info_historia_clinica['exaosteo_bostezo_lat'];
$exaosteo_flexion = $info_historia_clinica['exaosteo_flexion'];
$exaosteo_cajon_sig = $info_historia_clinica['exaosteo_cajon_sig'];
$exaosteo_cajon_lat = $info_historia_clinica['exaosteo_cajon_lat'];
$exaosteo_extension = $info_historia_clinica['exaosteo_extension'];
$exaosteo_mcmurray_sig = $info_historia_clinica['exaosteo_mcmurray_sig'];
$exaosteo_mcmurray_lat = $info_historia_clinica['exaosteo_mcmurray_lat'];
$exaosteo_bragard_sig = $info_historia_clinica['exaosteo_bragard_sig'];
$exaosteo_bragard_lat = $info_historia_clinica['exaosteo_bragard_lat'];
$exaosteo_tredelen = $info_historia_clinica['exaosteo_tredelen'];
$exaosteo_valmarcha = $info_historia_clinica['exaosteo_valmarcha'];
$exaosteo_observ = $info_historia_clinica['exaosteo_observ'];
$paracli_audimet = $info_historia_clinica['paracli_audimet'];
$paracli_audimet_observ = $info_historia_clinica['paracli_audimet_observ'];
$paracli_visiomet = $info_historia_clinica['paracli_visiomet'];
$paracli_visiomet_observ = $info_historia_clinica['paracli_visiomet_observ'];
$paracli_torax = $info_historia_clinica['paracli_torax'];
$paracli_torax_observ = $info_historia_clinica['paracli_torax_observ'];
$paracli_espiro = $info_historia_clinica['paracli_espiro'];
$paracli_espiro_observ = $info_historia_clinica['paracli_espiro_observ'];
$paracli_ekg = $info_historia_clinica['paracli_ekg'];
$paracli_ekg_observ = $info_historia_clinica['paracli_ekg_observ'];
$paracli_rxcolum = $info_historia_clinica['paracli_rxcolum'];
$paracli_rxcolum_observ = $info_historia_clinica['paracli_rxcolum_observ'];
$paracli_otrcomplement = $info_historia_clinica['paracli_otrcomplement'];
$paracli_otrcomplement_observ = $info_historia_clinica['paracli_otrcomplement_observ'];
$paracli_fisiote = $info_historia_clinica['paracli_fisiote'];
$paracli_fisiote_observ = $info_historia_clinica['paracli_fisiote_observ'];
$paracli_lab = $info_historia_clinica['paracli_lab'];
$paracli_lab_observ = $info_historia_clinica['paracli_lab_observ'];
$paracli_otro = $info_historia_clinica['paracli_otro'];
$paracli_otro_observ = $info_historia_clinica['paracli_otro_observ'];
$control_examen = $info_historia_clinica['control_examen'];
$cod_tipo_historia_clinica = $info_historia_clinica['cod_tipo_historia_clinica'];
$cod_estado_facturacion = $info_historia_clinica['cod_estado_facturacion'];
$total_terapia = $info_historia_clinica['total_terapia'];
$nombre_laboratorio = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica = $info_historia_clinica['descripcion_ayuda_diagnostica'];
$nombre_religion = $info_historia_clinica['nombre_religion'];
$nombre_ocupacion = $info_historia_clinica['nombre_ocupacion'];
$nombre_estado_civil = $info_historia_clinica['nombre_estado_civil'];
$nombre_escolaridad = $info_historia_clinica['nombre_escolaridad'];
$nombre_tipo_regimen = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension = $info_historia_clinica['nombre_fondo_pension'];
$nombre_actividad_ecoemp = $info_historia_clinica['nombre_actividad_ecoemp'];
$nombre_estrato = $info_historia_clinica['nombre_estrato'];
$nombre_numero_hijos = $info_historia_clinica['nombre_numero_hijos'];
$nombre_arl = $info_historia_clinica['nombre_arl'];
$nombre_empresa = $info_historia_clinica['nombre_empresa'];
$cargo_empresa = $info_historia_clinica['cargo_empresa'];
$area_empresa = $info_historia_clinica['area_empresa'];
$ciudad_empresa = $info_historia_clinica['ciudad_empresa'];
$nombre_empresa_contratante = $info_historia_clinica['nombre_empresa_contratante'];
$tel_cliente_cli = $info_historia_clinica['tel_cliente_cli'];
$correo = $info_historia_clinica['correo'];
$cod_entidad = $info_historia_clinica['cod_entidad'];
$lugar_procedencia = $info_historia_clinica['lugar_procedencia'];
$nombre_contacto1 = $info_historia_clinica['nombre_contacto1'];
$tel_contacto1 = $info_historia_clinica['tel_contacto1'];
$parentesco_contacto1 = $info_historia_clinica['parentesco_contacto1'];
$direccion_contacto1 = $info_historia_clinica['direccion_contacto1'];
$fecha_mes = $info_historia_clinica['fecha_mes'];
$fecha_anyo = $info_historia_clinica['fecha_anyo'];
$fecha_ymd = $info_historia_clinica['fecha_ymd'];
$fecha_dmy = $info_historia_clinica['fecha_dmy'];
$hora = $info_historia_clinica['hora'];
$fecha_time = $info_historia_clinica['fecha_time'];
$fecha_reg_time = $info_historia_clinica['fecha_reg_time'];
$url_img_firma_min = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig = $info_historia_clinica['url_img_foto_orig'];
$cuenta = $info_historia_clinica['cuenta'];
$cuenta_reg = $info_historia_clinica['cuenta_reg'];

$ant_fam_asma_pad                      = $info_historia_clinica['ant_fam_asma_pad'];
$ant_fam_asma_mad                      = $info_historia_clinica['ant_fam_asma_mad'];
$ant_fam_asma_herm                     = $info_historia_clinica['ant_fam_asma_herm'];
$ant_fam_asma_otro                     = $info_historia_clinica['ant_fam_asma_otro'];
$ant_fam_asma_otro_cual                = $info_historia_clinica['ant_fam_asma_otro_cual'];
$habit_tox_toxicomania                 = $info_historia_clinica['habit_tox_toxicomania'];
$ant_pato_convulsion                   = $info_historia_clinica['ant_pato_convulsion'];
$ant_pato_claustrofobia                = $info_historia_clinica['ant_pato_claustrofobia'];
$ant_pato_dificuloler                  = $info_historia_clinica['ant_pato_dificuloler'];
$ant_pato_cardiopatia                  = $info_historia_clinica['ant_pato_cardiopatia'];
$ant_pato_lentes                       = $info_historia_clinica['ant_pato_lentes'];
$ant_pato_dificuldistincolor           = $info_historia_clinica['ant_pato_dificuldistincolor'];
$exa_fis_sistemmusculesquelet          = $info_historia_clinica['exa_fis_sistemmusculesquelet'];
$exa_fis_sistemmusculesquelet_observ   = $info_historia_clinica['exa_fis_sistemmusculesquelet_observ'];
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
$nombre_pais                           = $info_historia_clinica['nombre_pais'];

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
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$fecha_time                          = $info_historia_clinica['fecha_time'];
$fecha_reg_time                      = $info_historia_clinica['fecha_reg_time'];
$fecha_ymd                           = $info_historia_clinica['fecha_ymd'];
$cuenta                              = $info_historia_clinica['cuenta'];
$fecha_ymd_hora                      = date("Y/m/d H:i:s", $fecha_time);
$fecha_dmy                           = $info_historia_clinica['fecha_dmy'];
$fecha_reg_time_dmy                  = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica              = date("Y/m/d", $fecha_time);
$nombres_completos                   = "HISTORIA CLÍNICA-".$nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_historia_clinica;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');
$margen_izq                          = '10';
$margen_der                          = '10';
$margen_inf_encabezado               = '20';
$margen_sup_encabezado               = '30';
$posicion_sup_encabezado             = '5';
$posicion_inf_encabezado             = '20';

$titulo_doc_pdf                      = $nombres_completos;
$autor_doc_pdf                       = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                     = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                        = "HISTORIA CLÍNICA";
$palabras_claves_doc_pdf             = $nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_historia_clinica;
$cod_historia_clinica_strpad         = str_pad($cod_historia_clinica, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf                                = new mPDF('c','A4');
$mpdf                                = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">HISTORIA CLÍNICA</td>
    <td width="25%" align="center"><barcode code="'.$cod_historia_clinica_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">HISTORIA CLÍNICA</td>
    <td width="25%" align="center"><barcode code="'.$cod_historia_clinica_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';
$mpdf->SetHTMLHeader(($header));
$mpdf->SetHTMLHeader(($headerE),'E');
$mpdf->SetHTMLFooter(($footer));
$mpdf->SetHTMLFooter(($footerE),'E');

$codigoHTML = '
<!DOCTYPE html>
<html lang="es">
<head>
<title></title>
<meta charset="utf-8" />
</head>

<body>
<style type="text/css"> 
#centrar { margin-right:auto; margin-left:auto; width: 30%; } 
.Estilo1 { color: #FF0000; font-weight: bold; }
.Estilo2 {color: #FF0000}
</style>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
<tbody>

</tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%"><thead><tr><th valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%"><thead><tr><th valign="middle"><img src="'.$url_img_foto_min_cli.'" width="71px"/></th></tr></thead></table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>NOMBRES Y APELLIDOS</th>
<th>TIPO IDENTIFICACIÓN</th>
<th>IDENTIFICACIÓN</th>
<th>GÉNERO</th>
<th>EDAD</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$nombres_cli.' '.$apellido1_cli.'</td>
<td align="center">'.$nombre_tipo_doc.'</td>
<td align="center">'.$cedula.'</td>
<td align="center">'.$nombre_sexo.'</td>
<td align="center">'.$edad_anyo.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
<thead><tr>
<th>FECHA DE NACIMIENTO</th>
<th>LUGAR DE NACIMIENTO</th>
<th>LUGAR DE RESIDENCIA ULTIMOS 5 AÑOS</th>
<th>ESTADO CIVIL</th>
<th>Nº HIJOS</th>
<th>NACIONALIDAD</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$fecha_nac_ymd.'</td>
<td align="center">'.$lugar_nac.'</td>
<td align="center">'.$lugar_residencia.' - '.$direccion.'</td>
<td align="center">'.$nombre_estado_civil.'</td>
<td align="center">'.$nombre_numero_hijos.'</td>
<td align="center">'.$nombre_pais.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>TELEFONO Y/O CELULAR</th>
<th>NIVEL EDUCATIVO</th>
<th>NOMBRE EPS</th>
<th>TIPO DE RÉGIMEN</th>
<th>FONDO DE PENSIONES</th>
<th>ARL</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$tel_cliente_cli.'</td>
<td align="center">'.$nombre_escolaridad.'</td>
<td align="center">'.$nombre_entidad.'</td>
<td align="center">'.$nombre_tipo_regimen.'</td>
<td align="center">'.$nombre_fondo_pension.'</td>
<td align="center">'.$nombre_arl.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;"><thead><tr><th valign="middle">DATOS DE CONTACTO EN CASO DE EMERGENCIA</th></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>NOMBRE</th>
<th>DIRECCIÓN</th>
<th>PARENTESCO</th>
<th>TELÉFONO</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$nombre_contacto1.'</td>
<td align="center">'.$direccion_contacto1.'</td>
<td align="center">'.$parentesco_contacto1.'</td>
<td align="center">'.$tel_contacto1.'</td>
</tr></tbody>
</table>
<br>
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr><td align="center"><strong>MOTIVO DE EVALUACIÓN:</strong> '.$motivo.'</td></tr></thead>
<tbody></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;"><thead><tr><th valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>EMPRESA CONTRATANTE</th>
<th>EMPRESA A LABORAR</th>
<th>CARGO</th>
<th>AREA A LABORAR</th>
<th>CIUDAD</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$nombre_empresa_contratante.'</td>
<td align="center">'.$nombre_empresa.'</td>
<td align="center">'.$cargo_empresa.'</td>
<td align="center">'.$area_empresa.'</td>
<td align="center">'.$ciudad_empresa.'</td>
</tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">2. DATOS OCUPACIONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.1. Historia Laboral</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center" rowspan="2"><strong>Empresa nombre comercial</strong><br />ACTUAL (1) ANTERIORES (2 Y 3)</td>
            <td style="text-align:center" rowspan="2"><strong>Cargo</strong> </td>
            <td style="text-align:center" colspan="8"><strong>Elementos de protección personal</strong></td>
            <td style="text-align:center" rowspan="2"><strong>Fecha inicio</strong></td>
            <td style="text-align:center" rowspan="2"><strong>Duración (Años)</strong></td>
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
            <td>'.$dat_ocupa_emp1.'</td>
            <td style="text-align:center">'.$cargo_empresa.'</td>
            <!--<td style="text-align:center">'.$dat_ocupa_carg1.'</td>-->
            <td style="text-align:center">'.$dat_ocupa_visu1.'</td>
            <td style="text-align:center">'.$dat_ocupa_audi1.'</td>
            <td style="text-align:center">'.$dat_ocupa_altu1.'</td>
            <td style="text-align:center">'.$dat_ocupa_resp1.'</td>
            <td style="text-align:center">'.$dat_ocupa_cabeza1.'</td>
            <td style="text-align:center">'.$dat_ocupa_manos1.'</td>
            <td style="text-align:center">'.$dat_ocupa_tronco1.'</td>
            <td style="text-align:center">'.$dat_ocupa_pies1.'</td>
            <td style="text-align:center">'.$dat_ocupa_fech_ini1.'</td>
            <td style="text-align:center">'.$dat_ocupa_dura_anyo1.'</td>
        </tr>
        <tr>
            <td>'.$dat_ocupa_emp2.'</td>
            <td style="text-align:center">'.$dat_ocupa_carg2.'</td>
            <td style="text-align:center">'.$dat_ocupa_visu2.'</td>
            <td style="text-align:center">'.$dat_ocupa_audi2.'</td>
            <td style="text-align:center">'.$dat_ocupa_altu2.'</td>
            <td style="text-align:center">'.$dat_ocupa_resp2.'</td>
            <td style="text-align:center">'.$dat_ocupa_cabeza2.'</td>
            <td style="text-align:center">'.$dat_ocupa_manos2.'</td>
            <td style="text-align:center">'.$dat_ocupa_tronco2.'</td>
            <td style="text-align:center">'.$dat_ocupa_pies2.'</td>
            <td style="text-align:center">'.$dat_ocupa_fech_ini2.'</td>
            <td style="text-align:center">'.$dat_ocupa_dura_anyo2.'</td>
        </tr>
        <tr>
            <td>'.$dat_ocupa_emp3.'</td>
            <td style="text-align:center">'.$dat_ocupa_carg3.'</td>
            <td style="text-align:center">'.$dat_ocupa_visu3.'</td>
            <td style="text-align:center">'.$dat_ocupa_audi3.'</td>
            <td style="text-align:center">'.$dat_ocupa_altu3.'</td>
            <td style="text-align:center">'.$dat_ocupa_resp3.'</td>
            <td style="text-align:center">'.$dat_ocupa_cabeza3.'</td>
            <td style="text-align:center">'.$dat_ocupa_manos3.'</td>
            <td style="text-align:center">'.$dat_ocupa_tronco3.'</td>
            <td style="text-align:center">'.$dat_ocupa_pies3.'</td>
            <td style="text-align:center">'.$dat_ocupa_fech_ini3.'</td>
            <td style="text-align:center">'.$dat_ocupa_dura_anyo3.'</td>
        </tr>
        <tr>
            <td colspan="8"><strong>Observaciones: '.$dat_ocupa_observacion.'</strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>2.2. Clasificación de riesgos</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td style="text-align:center" colspan="6" bgcolor="#95B3D7"><strong>FÍSICOS</strong></td>
            <td style="text-align:center" colspan="4" bgcolor="#B6DDE8"><strong>QUÍMICOS</strong></td>
            <td style="text-align:center" colspan="6" bgcolor="#C5BE97"><strong>BIOLÓGICO</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#B2A1C7"><strong>ERGONÓMICOS</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#E6B9B8"><strong>PSICOSOCIALES</strong></td>
            <td style="text-align:center" colspan="7" bgcolor="#FAC090"><strong>SEGURIDAD</strong></td>
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
            <td><img src="../imagenes/img_riesgos/34.jpg" /></td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align:center">'.$clasrieg_carg1.'</td>
            <td style="text-align:center">'.$clasrieg_fis1_ruid.'</td>
            <td style="text-align:center">'.$clasrieg_fis1_ilum.'</td>
            <td style="text-align:center">'.$clasrieg_fis1_noionic.'</td>
            <td style="text-align:center">'.$clasrieg_fis1_vibra.'</td>
            <td style="text-align:center">'.$clasrieg_fis1_tempextrem.'</td>
            <td style="text-align:center">'.$clasrieg_fis1_cambpres.'</td>
            <td style="text-align:center">'.$clasrieg_quim1_gasvapor.'</td>
            <td style="text-align:center">'.$clasrieg_quim1_aeroliq.'</td>
            <td style="text-align:center">'.$clasrieg_quim1_solid.'</td>
            <td style="text-align:center">'.$clasrieg_quim1_liquid.'</td>
            <td style="text-align:center">'.$clasrieg_biolog1_viru.'</td>
            <td style="text-align:center">'.$clasrieg_biolog1_bacter.'</td>
            <td style="text-align:center">'.$clasrieg_biolog1_parasi.'</td>
            <td style="text-align:center">'.$clasrieg_biolog1_morde.'</td>
            <td style="text-align:center">'.$clasrieg_biolog1_picad.'</td>
            <td style="text-align:center">'.$clasrieg_biolog1_hongo.'</td>
            <td style="text-align:center">'.$clasrieg_ergo1_trabestat.'</td>
            <td style="text-align:center">'.$clasrieg_ergo1_esfuerfis.'</td>
            <td style="text-align:center">'.$clasrieg_ergo1_carga.'</td>
            <td style="text-align:center">'.$clasrieg_ergo1_postforz.'</td>
            <td style="text-align:center">'.$clasrieg_ergo1_movrepet.'</td>
            <td style="text-align:center">'.$clasrieg_ergo1_jortrab.'</td>
            <td style="text-align:center">'.$clasrieg_psi1_monoto.'</td>
            <td style="text-align:center">'.$clasrieg_psi1_relhuman.'</td>
            <td style="text-align:center">'.$clasrieg_psi1_contentarea.'</td>
            <td style="text-align:center">'.$clasrieg_psi1_orgtiemptrab.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_mecanic.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_electri.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_locat.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_fisiquim.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_public.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_espconfi.'</td>
            <td style="text-align:center">'.$clasrieg_segur1_trabaltura.'</td>
            <td style="text-align:center">'.$clasrieg_observ1_otro.'</td>
            <td style="text-align:center">'.$clasrieg_observ1_coment.'</td>
        </tr>
        <tr>
            <td style="text-align:center">'.$clasrieg_carg2.'</td>
            <td style="text-align:center">'.$clasrieg_fis2_ruid.'</td>
            <td style="text-align:center">'.$clasrieg_fis2_ilum.'</td>
            <td style="text-align:center">'.$clasrieg_fis2_noionic.'</td>
            <td style="text-align:center">'.$clasrieg_fis2_vibra.'</td>
            <td style="text-align:center">'.$clasrieg_fis2_tempextrem.'</td>
            <td style="text-align:center">'.$clasrieg_fis2_cambpres.'</td>
            <td style="text-align:center">'.$clasrieg_quim2_gasvapor.'</td>
            <td style="text-align:center">'.$clasrieg_quim2_aeroliq.'</td>
            <td style="text-align:center">'.$clasrieg_quim2_solid.'</td>
            <td style="text-align:center">'.$clasrieg_quim2_liquid.'</td>
            <td style="text-align:center">'.$clasrieg_biolog2_viru.'</td>
            <td style="text-align:center">'.$clasrieg_biolog2_bacter.'</td>
            <td style="text-align:center">'.$clasrieg_biolog2_parasi.'</td>
            <td style="text-align:center">'.$clasrieg_biolog2_morde.'</td>
            <td style="text-align:center">'.$clasrieg_biolog2_picad.'</td>
            <td style="text-align:center">'.$clasrieg_biolog2_hongo.'</td>
            <td style="text-align:center">'.$clasrieg_ergo2_trabestat.'</td>
            <td style="text-align:center">'.$clasrieg_ergo2_esfuerfis.'</td>
            <td style="text-align:center">'.$clasrieg_ergo2_carga.'</td>
            <td style="text-align:center">'.$clasrieg_ergo2_postforz.'</td>
            <td style="text-align:center">'.$clasrieg_ergo2_movrepet.'</td>
            <td style="text-align:center">'.$clasrieg_ergo2_jortrab.'</td>
            <td style="text-align:center">'.$clasrieg_psi2_monoto.'</td>
            <td style="text-align:center">'.$clasrieg_psi2_relhuman.'</td>
            <td style="text-align:center">'.$clasrieg_psi2_contentarea.'</td>
            <td style="text-align:center">'.$clasrieg_psi2_orgtiemptrab.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_mecanic.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_electri.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_locat.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_fisiquim.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_public.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_espconfi.'</td>
            <td style="text-align:center">'.$clasrieg_segur2_trabaltura.'</td>
            <td style="text-align:center">'.$clasrieg_observ2_otro.'</td>
            <td style="text-align:center">'.$clasrieg_observ2_coment.'</td>
        </tr>
        <tr>
            <td style="text-align:center">'.$clasrieg_carg3.'</td>
            <td style="text-align:center">'.$clasrieg_fis3_ruid.'</td>
            <td style="text-align:center">'.$clasrieg_fis3_ilum.'</td>
            <td style="text-align:center">'.$clasrieg_fis3_noionic.'</td>
            <td style="text-align:center">'.$clasrieg_fis3_vibra.'</td>
            <td style="text-align:center">'.$clasrieg_fis3_tempextrem.'</td>
            <td style="text-align:center">'.$clasrieg_fis3_cambpres.'</td>
            <td style="text-align:center">'.$clasrieg_quim3_gasvapor.'</td>
            <td style="text-align:center">'.$clasrieg_quim3_aeroliq.'</td>
            <td style="text-align:center">'.$clasrieg_quim3_solid.'</td>
            <td style="text-align:center">'.$clasrieg_quim3_liquid.'</td>
            <td style="text-align:center">'.$clasrieg_biolog3_viru.'</td>
            <td style="text-align:center">'.$clasrieg_biolog3_bacter.'</td>
            <td style="text-align:center">'.$clasrieg_biolog3_parasi.'</td>
            <td style="text-align:center">'.$clasrieg_biolog3_morde.'</td>
            <td style="text-align:center">'.$clasrieg_biolog3_picad.'</td>
            <td style="text-align:center">'.$clasrieg_biolog3_hongo.'</td>
            <td style="text-align:center">'.$clasrieg_ergo3_trabestat.'</td>
            <td style="text-align:center">'.$clasrieg_ergo3_esfuerfis.'</td>
            <td style="text-align:center">'.$clasrieg_ergo3_carga.'</td>
            <td style="text-align:center">'.$clasrieg_ergo3_postforz.'</td>
            <td style="text-align:center">'.$clasrieg_ergo3_movrepet.'</td>
            <td style="text-align:center">'.$clasrieg_ergo3_jortrab.'</td>
            <td style="text-align:center">'.$clasrieg_psi3_monoto.'</td>
            <td style="text-align:center">'.$clasrieg_psi3_relhuman.'</td>
            <td style="text-align:center">'.$clasrieg_psi3_contentarea.'</td>
            <td style="text-align:center">'.$clasrieg_psi3_orgtiemptrab.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_mecanic.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_electri.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_locat.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_fisiquim.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_public.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_espconfi.'</td>
            <td style="text-align:center">'.$clasrieg_segur3_trabaltura.'</td>
            <td style="text-align:center">'.$clasrieg_observ3_otro.'</td>
            <td style="text-align:center">'.$clasrieg_observ3_coment.'</td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>Antecedentes relacionados de importancia</strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.3 Accidente Laboral&nbsp;&nbsp;&nbsp;['.$ant_impor_accilab.']</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
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
            <td>'.$ant_impor_fecha1.'</td>
            <td>'.$ant_impor_empre1.'</td>
            <td>'.$ant_impor_causa1.'</td>
            <td>'.$ant_impor_tip_lesi1.'</td>
            <td>'.$ant_impor_part_afect1.'</td>
            <td style="text-align:center">'.$ant_impor_dias_incap1.'</td>
            <td>'.$ant_impor_secuela1.'</td>
        </tr>
        <tr>
            <td>'.$ant_impor_fecha2.'</td>
            <td>'.$ant_impor_empre2.'</td>
            <td>'.$ant_impor_causa2.'</td>
            <td>'.$ant_impor_tip_lesi2.'</td>
            <td>'.$ant_impor_part_afect2.'</td>
            <td style="text-align:center">'.$ant_impor_dias_incap2.'</td>
            <td>'.$ant_impor_secuela2.'</td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>2.4 Enfermedad Laboral&nbsp;&nbsp;&nbsp;['.$enf_lab.']</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
    	<tr>
        <td><strong>Cual: </strong>'.$enf_cual.'</td>
        <td><strong>Hace Cuánto: </strong>'.$enf_hace_cuanto.'</td>
        <td><strong>Descripción: </strong>'.$enf_descripcion.'</td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">3. ANTECEDENTES FAMILIARES/PERSONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>3.1 ANTECEDENTES FAMILIARES</strong></td></tr>
    </tbody>
</table>
<!--
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr><td><strong>No Presenta Antecedentes Familiares&nbsp;&nbsp;&nbsp;['.$ant_fam_no_presenta.']</strong></td></tr>
    </tbody>
</table>
-->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
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
            <td style="text-align:center">'.$ant_fam_hiper_pad.'</td>
            <td style="text-align:center">'.$ant_fam_hiper_mad.'</td>
            <td style="text-align:center">'.$ant_fam_hiper_herm.'</td>
            <td style="text-align:center">'.$ant_fam_hiper_otro.'</td>
            <td>'.$ant_fam_hiper_otro_cual.'</td>
            <td><strong>Cardiopatia</strong><strong> </strong></td>
            <td style="text-align:center">'.$ant_fam_cadio_pad.'</td>
            <td style="text-align:center">'.$ant_fam_cadio_mad.'</td>
            <td style="text-align:center">'.$ant_fam_cadio_herm.'</td>
            <td style="text-align:center">'.$ant_fam_cadio_otro.'</td>
            <td>'.$ant_fam_cadio_otro_cual.'</td>
            <td><strong>Osteomusculares</strong></td>
            <td style="text-align:center">'.$ant_fam_osteomusc_pad.'</td>
            <td style="text-align:center">'.$ant_fam_osteomusc_mad.'</td>
            <td style="text-align:center">'.$ant_fam_osteomusc_herm.'</td>
            <td style="text-align:center">'.$ant_fam_osteomusc_otro.'</td>
            <td>'.$ant_fam_osteomusc_otro_cual.'</td>
        </tr>
        <tr>
            <td><strong>Diabetes</strong></td>
            <td style="text-align:center">'.$ant_fam_diabet_pad.'</td>
            <td style="text-align:center">'.$ant_fam_diabet_mad.'</td>
            <td style="text-align:center">'.$ant_fam_diabet_herm.'</td>
            <td style="text-align:center">'.$ant_fam_diabet_otro.'</td>
            <td>'.$ant_fam_diabet_otro_cual.'</td>
            <td><strong>Trans. Convulsivo</strong></td>
            <td style="text-align:center">'.$ant_fam_trans_convul_pad.'</td>
            <td style="text-align:center">'.$ant_fam_trans_convul_mad.'</td>
            <td style="text-align:center">'.$ant_fam_trans_convul_herm.'</td>
            <td style="text-align:center">'.$ant_fam_trans_convul_otro.'</td>
            <td>'.$ant_fam_trans_convul_otro_cual.'</td>
            <td><strong>Artitris</strong></td>
            <td style="text-align:center">'.$ant_fam_artitri_pad.'</td>
            <td style="text-align:center">'.$ant_fam_artitri_mad.'</td>
            <td style="text-align:center">'.$ant_fam_artitri_herm.'</td>
            <td style="text-align:center">'.$ant_fam_artitri_otro.'</td>
            <td>'.$ant_fam_artitri_otro_cual.'</td>
        </tr>
        <tr>
            <td><strong>ACV o Trombosis</strong></td>
            <td style="text-align:center">'.$ant_fam_trombos_pad.'</td>
            <td style="text-align:center">'.$ant_fam_trombos_mad.'</td>
            <td style="text-align:center">'.$ant_fam_trombos_herm.'</td>
            <td style="text-align:center">'.$ant_fam_trombos_otro.'</td>
            <td>'.$ant_fam_trombos_otro_cual.'</td>
            <td><strong>Efermedad Genetica </strong></td>
            <td style="text-align:center">'.$ant_fam_enf_gene_pad.'</td>
            <td style="text-align:center">'.$ant_fam_enf_gene_mad.'</td>
            <td style="text-align:center">'.$ant_fam_enf_gene_herm.'</td>
            <td style="text-align:center">'.$ant_fam_enf_gene_otro.'</td>
            <td>'.$ant_fam_enf_gene_otro_cual.'</td>
            <td><strong>Varices</strong></td>
            <td style="text-align:center">'.$ant_fam_varice_pad.'</td>
            <td style="text-align:center">'.$ant_fam_varice_mad.'</td>
            <td style="text-align:center">'.$ant_fam_varice_herm.'</td>
            <td style="text-align:center">'.$ant_fam_varice_otro.'</td>
            <td>'.$ant_fam_varice_otro_cual.'</td>
        </tr>
        <tr>
            <td><strong>Tumores Malignos </strong></td>
            <td style="text-align:center">'.$ant_fam_tum_malig_pad.'</td>
            <td style="text-align:center">'.$ant_fam_tum_malig_mad.'</td>
            <td style="text-align:center">'.$ant_fam_tum_malig_herm.'</td>
            <td style="text-align:center">'.$ant_fam_tum_malig_otro.'</td>
            <td>'.$ant_fam_tum_malig_otro_cual.'</td>
            <td><strong>Alergias</strong></td>
            <td style="text-align:center">'.$ant_fam_alerg_pad.'</td>
            <td style="text-align:center">'.$ant_fam_alerg_mad.'</td>
            <td style="text-align:center">'.$ant_fam_alerg_herm.'</td>
            <td style="text-align:center">'.$ant_fam_alerg_otro.'</td>
            <td>'.$ant_fam_alerg_otro_cual.'</td>
            <td><strong>Asma</strong></td>
            <td style="text-align:center">'.$ant_fam_asma_pad.'</td>
            <td style="text-align:center">'.$ant_fam_asma_mad.'</td>
            <td style="text-align:center">'.$ant_fam_asma_herm.'</td>
            <td style="text-align:center">'.$ant_fam_asma_otro.'</td>
            <td>'.$ant_fam_asma_otro_cual.'</td>
        </tr>
        <tr>
            <td><strong>Enfermedad Mental </strong></td>
            <td style="text-align:center">'.$ant_fam_enf_ment_pad.'</td>
            <td style="text-align:center">'.$ant_fam_enf_ment_mad.'</td>
            <td style="text-align:center">'.$ant_fam_enf_ment_herm.'</td>
            <td style="text-align:center">'.$ant_fam_enf_ment_otro.'</td>
           <td>'.$ant_fam_enf_ment_otro_cual.'</td>
            <td><strong>Tuberculosis</strong></td>
            <td style="text-align:center">'.$ant_fam_tuber_pad.'</td>
            <td style="text-align:center">'.$ant_fam_tuber_mad.'</td>
            <td style="text-align:center">'.$ant_fam_tuber_herm.'</td>
            <td style="text-align:center">'.$ant_fam_tuber_otro.'</td>
            <td>'.$ant_fam_tuber_otro_cual.'</td>
            <td><strong>Otros</strong></td>
            <td style="text-align:center">'.$ant_fam_otro_pad.'</td>
            <td style="text-align:center">'.$ant_fam_otro_mad.'</td>
            <td style="text-align:center">'.$ant_fam_otro_herm.'</td>
            <td style="text-align:center">'.$ant_fam_otro_otro.'</td>
            <td>'.$ant_fam_otro_otro_cual.'</td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong>'.$ant_fam_descripcion.'</td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.2 Antecedentes Patológicos</strong></td></tr></tbody>
</table>
<!--
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#B6DDE8"><strong>No Presenta Antecedentes Patológicos&nbsp;&nbsp;&nbsp;['.$ant_pato_no_presenta.']</strong></td></tr>
    </tbody>
</table>
-->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Neurologicos</strong></td>
            <td style="text-align:center">'.$ant_pato_neuro.'</td>
            <td><strong>Pulmonar</strong></td>
            <td style="text-align:center">'.$ant_pato_resp.'</td>
            <td><strong>Dermatologico</strong></td>
            <td style="text-align:center">'.$ant_pato_derma.'</td>
            <td><strong>Psiquiatrico</strong></td>
            <td style="text-align:center">'.$ant_pato_psiq.'</td>
            <td><strong>Alergico</strong></td>
            <td style="text-align:center">'.$ant_pato_alerg.'</td>
        </tr>
        <tr>
            <td><strong>Osteomusculares</strong></td>
            <td style="text-align:center">'.$ant_pato_osteomusc.'</td>
            <td><strong>Gastrointestinal</strong></td>
            <td style="text-align:center">'.$ant_pato_gastrointes.'</td>
            <td><strong>Hematologico</strong></td>
            <td style="text-align:center">'.$ant_pato_hematolog.'</td>
            <td><strong>Organos de los Sentidos </strong></td>
            <td style="text-align:center">'.$ant_pato_org_sentid.'</td>
            <td><strong>Cancer</strong></td>
            <td style="text-align:center">'.$ant_pato_onco.'</td>
        </tr>
        <tr>
            <td><strong>Hipertensión</strong></td>
            <td style="text-align:center">'.$ant_pato_hiperten.'</td>
            <td><strong>Genitourinario</strong></td>
            <td style="text-align:center">'.$ant_pato_genurinario.'</td>
            <td><strong>Infeccioso</strong></td>
            <td style="text-align:center">'.$ant_pato_infesios.'</td>
            <td><strong>Congénito</strong></td>
            <td style="text-align:center">'.$ant_pato_congenit.'</td>
            <td><strong>Famacologico</strong></td>
            <td style="text-align:center">'.$ant_pato_farmacolog.'</td>
        </tr>
        <tr>
			<td><strong>Transfusiones</strong></td>
			<td style="text-align:center">'.$ant_pato_transfus.'</td>
			<td><strong>Endocrino (Diabetes Tiroides)</strong></td>
			<td style="text-align:center">'.$ant_pato_endocrino.'</td>
			<td><strong>Vasculares</strong></td>
			<td style="text-align:center">'.$ant_pato_vascular.'</td>
			<td><strong>Autoinmunes</strong></td>
			<td style="text-align:center">'.$ant_pato_auntoinmun.'</td>
			<td><strong>Convulsiones (Ataques)</strong></td>
			<td style="text-align:center">'.$ant_pato_convulsion.'</td>
        </tr>
        <tr>
			<td><strong>Claustrofobia</strong></td>
			<td style="text-align:center">'.$ant_pato_claustrofobia.'</td>
			<td><strong>Dificultad Al Oler</strong></td>
			<td style="text-align:center">'.$ant_pato_dificuloler.'</td>
			<td><strong>Cardiopatia</strong></td>
			<td style="text-align:center">'.$ant_pato_cardiopatia.'</td>
			<td><strong>Usa Lentes</strong></td>
			<td style="text-align:center">'.$ant_pato_lentes.'</td>
			<td><strong>Dificultad para Distinguir los Colores</strong></td>
			<td style="text-align:center">'.$ant_pato_dificuldistincolor.'</td>
        </tr>
        <tr>
			<td><strong>Efermedades Hepaticas</strong></td>
			<td style="text-align:center">'.$ant_pato_enf_hepaticas.'</td>
			<td><strong>Transplantes</strong></td>
			<td style="text-align:center">'.$ant_pato_transplates.'</td>
			<td><strong>Obesidad Morbida (IMC > 40)</strong></td>
			<td style="text-align:center">'.$ant_pato_obesidad_morbida.'</td>
			<td><strong>Hereditarios</strong></td>
			<td style="text-align:center">'.$ant_pato_hereditarios.'</td>
			<td><strong>Enfermedades Infantiles</strong></td>
			<td style="text-align:center">'.$ant_pato_enf_infaltil.'</td>
        </tr>
        <tr>
			<td><strong>Enfermedad Dental</strong></td>
			<td style="text-align:center">'.$ant_pato_enf_dental.'</td>
			<td><strong>Enfermedad del Corazon</strong></td>
			<td style="text-align:center">'.$ant_pato_enf_corazon.'</td>
			<td><strong>Enfermedad Renal</strong></td>
			<td style="text-align:center">'.$ant_pato_enf_renal.'</td>
			<td><strong>Otros</strong></td>
			<td style="text-align:center">'.$ant_pato_otro.'</td>
			<td><strong></strong></td>
			<td style="text-align:center"></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong>'.$ant_pato_descripcion.'</td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.3 Antecedentes para Alturas&nbsp;&nbsp;&nbsp;</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Epilepsia</strong></td>
            <td style="text-align:center">'.$ant_altu_epilep.'</td>
            <td><strong>Otitis media</strong></td>
            <td style="text-align:center">'.$ant_altu_otitmed.'</td>
            <td><strong>Enfermedad de maniere</strong></td>
            <td style="text-align:center">'.$ant_altu_enfmanier.'</td>
            <td><strong>Traumas craneales</strong></td>
            <td style="text-align:center">'.$ant_altu_traumcran.'</td>
        </tr>
        <tr>
            <td><strong>Tumores cerebrales</strong></td>
            <td style="text-align:center">'.$ant_altu_tumcereb.'</td>
            <td><strong>Malformaciones cerebrales</strong></td>
            <td style="text-align:center">'.$ant_altu_malfocereb.'</td>
            <td><strong>Trombosis (ACV)</strong></td>
            <td style="text-align:center">'.$ant_altu_trombo.'</td>
            <td><strong>Hipoacusia</strong></td>
            <td style="text-align:center">'.$ant_altu_hipoac.'</td>         
        </tr>
        <tr>
            <td><strong>Arritmia cardíaca</strong></td>
            <td style="text-align:center">'.$ant_altu_arritcardi.'</td>
            <td><strong>Hipoglicemias</strong></td>
            <td style="text-align:center">'.$ant_altu_hipogli.'</td>
            <td><strong>Fobias</strong></td>
            <td style="text-align:center">'.$ant_altu_fobia.'</td>                        
        </tr>
            </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong>'.$ant_altu_observ.'</td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.4 Antecedentes Traumáticos &nbsp;&nbsp;&nbsp;['.$ant_trau.']</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Enfermedad</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
            <td style="text-align:center"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td>'.$ant_trau_enfer1.'</td>
            <td>'.$ant_trau_observ1.'</td>
            <td style="text-align:center">'.$ant_trau_fech_aprox1.'</td>
        </tr>
        <tr>
            <td>'.$ant_trau_enfer2.'</td>
            <td>'.$ant_trau_observ2.'</td>
            <td style="text-align:center">'.$ant_trau_fech_aprox2.'</td>
        </tr>
        <tr>
            <td>'.$ant_trau_enfer3.'</td>
            <td>'.$ant_trau_observ3.'</td>
            <td style="text-align:center">'.$ant_trau_fech_aprox3.'</td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.5 Antecedentes Quirúrgicos&nbsp;&nbsp;&nbsp;['.$ant_quirur.']</strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Enfermedad</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
            <td style="text-align:center"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td>'.$ant_quirur_enfer1.'</td>
            <td>'.$ant_quirur_observ1.'</td>
            <td style="text-align:center">'.$ant_quirur_fech_aprox1.'</td>
        </tr>
        <tr>
            <td>'.$ant_quirur_enfer2.'</td>
            <td>'.$ant_quirur_observ2.'</td>
            <td style="text-align:center">'.$ant_quirur_fech_aprox2.'</td>
        </tr>
        <tr>
            <td>'.$ant_quirur_enfer3.'</td>
            <td>'.$ant_quirur_observ3.'</td>
            <td style="text-align:center">'.$ant_quirur_fech_aprox3.'</td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.6 Antecedentes - Inmunizaciones (Presenta Vacunas:&nbsp;&nbsp;&nbsp;['.$ant_inmuni.'])</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Vacuna</strong></td>
            <td></td>
            <td style="text-align:center"><strong>Año Aplicación</strong></td>
            <td style="text-align:center"><strong>Vacuna</strong></td>
            <td></td>
            <td style="text-align:center"><strong>Año Aplicación</strong></td>
        </tr>
        <tr>
            <td><strong>TETANO</strong></td>
            <td style="text-align:center">'.$ant_inmuni_tetano.'</td>
            <td style="text-align:center">'.$ant_inmuni_tetano_anyo.'</td>
            <td><strong>FIEBRE TIFOIDEA</strong></td>
            <td style="text-align:center">'.$ant_inmuni_fiebtifo.'</td>
            <td style="text-align:center">'.$ant_inmuni_fiebtifo_anyo.'</td>
        </tr>
        <tr>
            <td><strong>HEPATITIS A</strong></td>
            <td style="text-align:center">'.$ant_inmuni_hepatita.'</td>
            <td style="text-align:center">'.$ant_inmuni_hepatita_anyo.'</td>
            <td><strong>INFLUENZA</strong></td>
            <td style="text-align:center">'.$ant_inmuni_influenza.'</td>
            <td style="text-align:center">'.$ant_inmuni_influenza_anyo.'</td>
        </tr>
        <tr>
            <td><strong>HEPATITIS B </strong></td>
            <td style="text-align:center">'.$ant_inmuni_hepatitb.'</td>
            <td style="text-align:center">'.$ant_inmuni_hepatitb_anyo.'</td>
            <td><strong>SARAMPION</strong></td>
            <td style="text-align:center">'.$ant_inmuni_saramp.'</td>
            <td style="text-align:center">'.$ant_inmuni_saramp_anyo.'</td>
        </tr>
        <tr>
            <td><strong>FIEBRE AMARILLA</strong></td>
            <td style="text-align:center">'.$ant_inmuni_fiebamarill.'</td>
            <td style="text-align:center">'.$ant_inmuni_fiebamarill_anyo.'</td>
            <td><strong>OTRA</strong></td>
            <td style="text-align:center">'.$ant_inmuni_otra.'</td>
            <td style="text-align:center">'.$ant_inmuni_otra_anyo.'</td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong>'.$ant_inmuni_observacion.'</td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090">3.7 <strong>Antecedentes Ginecologicos</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Primera Mestruación </strong></td>
            <td style="text-align:center"><strong>Años</strong></td>
            <td style="text-align:center"><strong>Ciclo</strong></td>
            <td style="text-align:center"><strong>FUM</strong></td>
            <td style="text-align:center"><strong>FUP</strong></td>
            <td style="text-align:center"><strong>FUC</strong></td>
            <td style="text-align:center" colspan="7" width="30%"><strong>FICHAS GINECOBSTETRICA</strong></td>
            <td style="text-align:center"><strong>Fecha Ultimo Examen de Mama</strong></td>
        </tr>
        <tr>
            <td style="text-align:center">'.$ant_gine_prim_mestrua.'</td>
            <td style="text-align:center">'.$ant_gine_anyos.'</td>
            <td style="text-align:center">'.$ant_gine_cliclo.'</td>
            <td style="text-align:center">'.$ant_gine_fum.'</td>
            <td style="text-align:center">'.$ant_gine_fup.'</td>
            <td style="text-align:center">'.$ant_gine_fuc.'</td>
            <td style="text-align:center">G-'.$ant_gine_fich_gine_g.'</td>
            <td style="text-align:center">P-'.$ant_gine_fich_gine_p.'</td>
            <td style="text-align:center">A-'.$ant_gine_fich_gine_a.'</td>
            <td style="text-align:center">C-'.$ant_gine_fich_gine_c.'</td>
            <td style="text-align:center">M-'.$ant_gine_fich_gine_m.'</td>
            <td style="text-align:center">E-'.$ant_gine_fich_gine_e.'</td>
            <td style="text-align:center">V-'.$ant_gine_fich_gine_v.'</td>
            <td style="text-align:center">'.$ant_gine_fech_ult_exa_mama.'</td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>Planificaciones: </strong>'.$ant_gine_planifica.'</td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong>'.$ant_gine_observacion.'</td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<tbody>
<tr><td colspan="9" bgcolor="#FAC090"><strong>3.8 Hábitos Personales </strong></td></tr>
<tr>
<td colspan="2"><strong>Tabaquismo:&nbsp;'.$habit_tox_fum_nofum_exfum.'</strong></td>
<td colspan="3"><strong>No. Cigarrillos al día:</strong>'.$habit_tox_ciga_aldia.'</td>
<td colspan="2"><strong>Total Años fumando: </strong>'.$habit_tox_anyos_fum.'</td>
<td colspan="2"><strong>Tiempo sin fumar:</strong>'.$habit_tox_tiem_sinfum.'</td>
</tr>
<tr>
<td colspan="3"><strong>Consumo de Alcohol:&nbsp;'.$habit_tox_consum_alcoh.'</strong>
<br>
<strong>Toxicomanías:&nbsp;'.$habit_tox_consum_alcoh.'</strong></td>
<td colspan="6"><strong>Actividad Extralaboral:</strong>'.$habit_tox_activ_extralab.'</td>
</tr>
<tr>
<td colspan="3"><strong>Actividad física:&nbsp;</strong>'.$habit_tox_activfis.'</td>
<td colspan="2"><strong>Actividad: </strong>'.$habit_tox_actividad.'</td>
<td colspan="2"><strong>Frecuencia: </strong>'.$habit_tox_frecuenc.'</td>
<td colspan="2"><strong>Tiempo: </strong>'.$habit_tox_tiempo.'</td>
</tr>
<tr>
<td colspan="3"><strong></strong></td>
<td colspan="2"><strong>Medicamentos: </strong>'.$habit_tox_medicamento.'</td>
<td colspan="2"><strong>Horas de Sueño: </strong>'.$habit_tox_horasueno.'</td>
<td colspan="2"><strong></strong></td>
</tr>
</tbody>
</table>
<br>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">4. REVISIÓN POR SISTEMAS</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Síntomas</strong></td>
            <td style="text-align:center"><strong>Refiere</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
        </tr>
        <tr>
            <td><strong>Órgano de los Sentidos </strong></td>
            <td style="text-align:center">'.$rev_sist_orgsentido.'</td>
            <td>'.$rev_sist_observ_orgsentido.'</td>
        </tr>
        <tr>
            <td><strong>Neurológicos</strong></td>
            <td style="text-align:center">'.$rev_sist_neurolog.'</td>
            <td>'.$rev_sist_observ_neurolog.'</td>
        </tr>
        <tr>
            <td><strong>Respiratorios</strong></td>
            <td style="text-align:center">'.$rev_sist_resp.'</td>
            <td>'.$rev_sist_observ_resp.'</td>
        </tr>
        <tr>
            <td><strong>Gastrointestinales</strong></td>
            <td style="text-align:center">'.$rev_sist_gastrointes.'</td>
            <td>'.$rev_sist_observ_gastrointes.'</td>
        </tr>
        <tr>
            <td><strong>Genitourinarios</strong></td>
            <td style="text-align:center">'.$rev_sist_geniuri.'</td>
            <td>'.$rev_sist_observ_geniuri.'</td>
        </tr>
        <tr>
            <td><strong>Osteomuscular</strong></td>
            <td style="text-align:center">'.$rev_sist_osteomus.'</td>
            <td>'.$rev_sist_observ_osteomus.'</td>
        </tr>
        <tr>
            <td><strong>Dermatológicos</strong></td>
            <td style="text-align:center">'.$rev_sist_dermato.'</td>
            <td>'.$rev_sist_observ_dermato.'</td>
        </tr>
        <tr>
            <td><strong>Cardiovasculares</strong></td>
            <td style="text-align:center">'.$rev_sist_cardiovas.'</td>
            <td>'.$rev_sist_observ_cardiovas.'</td>
        </tr>
        <tr>
            <td><strong>Constitucionales</strong></td>
            <td style="text-align:center">'.$rev_sist_constitu.'</td>
            <td>'.$rev_sist_observ_constitu.'</td>
        </tr>
        <tr>
            <td><strong>Metabolico y Endocrino</strong></td>
            <td style="text-align:center">'.$rev_sist_metabolendocri.'</td>
            <td>'.$rev_sist_observ_metabolendocri.'</td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">5. EVALUACIÓN DEL ESTADO MENTAL</span></strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>PROCESOS</strong></td>
            <td style="text-align:center"><strong>NORMAL</strong></td>
            <td style="text-align:center"><strong>DISFUNCIÓN</strong></td>
            <td style="text-align:center"><strong>HALLAZGO</strong></td>
        </tr>
        <tr>
            <td><strong>ORIENTACIÓN</strong></td>
            <td style="text-align:center">'.$eval_estment_norm_orient.'</td>
            <td>'.$eval_estment_disf_orient.'</td>
            <td>'.$eval_estment_halla_orient.'</td>
        </tr>
        <tr>
            <td>
            <strong>ATENCIÓN CONCENTRACIÓN</strong></td>
            <td style="text-align:center">'.$eval_estment_norm_atenconcent.'</td>
            <td>'.$eval_estment_disf_atenconcent.'</td>
            <td>'.$eval_estment_halla_atenconcent.'</td>
        </tr>
        <tr>
            <td><strong>SENSOPERCEPCIÓN</strong></td>
            <td style="text-align:center">'.$eval_estment_norm_sensoper.'</td>
            <td>'.$eval_estment_disf_sensoper.'</td>
            <td>'.$eval_estment_halla_sensoper.'</td>
        </tr>
        <tr>
            <td><strong>MEMORIA</strong></td>
            <td style="text-align:center">'.$eval_estment_norm_memor.'</td>
            <td>'.$eval_estment_disf_memor.'</td>
            <td>'.$eval_estment_halla_memor.'</td>
        </tr>
        <tr>
            <td><strong>PENSAMIENTO</strong></td>
            <td style="text-align:center">'.$eval_estment_norm_pensami.'</td>
            <td>'.$eval_estment_disf_pensami.'</td>
            <td>'.$eval_estment_halla_pensami.'</td>
        </tr>
        <tr>
            <td><strong>LENGUAJE</strong></td>
            <td style="text-align:center">'.$eval_estment_norm_lenguaj.'</td>
            <td>'.$eval_estment_disf_lenguaj.'</td>
            <td>'.$eval_estment_halla_lenguaj.'</td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td><strong>CONCEPTO:&nbsp;&nbsp;&nbsp;</strong>'.$eval_estment_concept.'</td>
        </tr>
    </tbody>
</table>

<br>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">6. EXAMEN FÍSICO</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<tbody>
<tr>
<td><strong>&nbsp;Talla: '.$exa_fis_talla.' (Mts)</strong></td>
<td><strong>PESO: '.$exa_fis_peso.' (Kg)</strong></td>
<td><strong>IMC:'.$exa_fis_imc.'</strong></td>
<td><strong>INTERPRETACIÓN IMC:'.$exa_fis_interpreimc.'</strong></td>
<td><strong>F. Resp: '.$exa_fis_fresp.' (/Min)</strong></td>
</tr>
<tr>
<td><strong>TA: '.$exa_fis_ta.' (Mm/Hg)</strong></td>
<td><strong>FC: '.$exa_fis_fc.' (/Min)</strong></td>
<td><strong>Lateralidad:&nbsp;&nbsp;&nbsp;&nbsp;'.$exa_fis_lateral.'</strong></td>
<td><strong>Perímetro Abdominal: '.$exa_fis_periabdom.' (Cm)</strong></td>
<td><strong>Temperatura:&nbsp;&nbsp;&nbsp;&nbsp;'.$exa_fis_temperat.'</strong></td>
</tr>
</tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td><strong>CONCEPTO &nbsp;&nbsp;&nbsp;&nbsp;'.$exa_fis_concepto.'</strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EXAMEN FÍSICO N(Normal) &ndash; A(Anormal) &ndash; NE(No examinado)</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
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
            <td style="text-align:center">'.$exa_fis_ojoder_sncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoder_sncorre_vcerca.'</td>
            <td style="text-align:center">'.$exa_fis_ojoder_cncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoder_cncorre_vcerca.'</td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td style="text-align:center">'.$exa_fis_ojoizq_sncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoizq_sncorre_vcerca.'</td>
            <td style="text-align:center">'.$exa_fis_ojoizq_cncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoizq_cncorre_vcerca.'</td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td style="text-align:center">'.$exa_fis_ojoamb_sncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoamb_sncorre_vcerca.'</td>
            <td style="text-align:center">'.$exa_fis_oojoamb_cncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoamb_cncorre_vcerca.'</td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<tbody>
<tr>
<td><strong>OJOS</strong></td>
<td style="text-align:center">'.$exa_fis_ojo.'</td>
<td>'.$exa_fis_ojo_obser.'</td>
</tr>
<tr>
<td><strong>OIDOS</strong></td>
<td style="text-align:center">'.$exa_fis_oido.'</td>
<td>'.$exa_fis_oido_obser.'</td>
</tr>
<tr>
<td><strong>CABEZA</strong></td>
<td style="text-align:center">'.$exa_fis_cabeza.'</td>
<td>'.$exa_fis_cabeza_obser.'</td>
</tr>
<tr>
<td><strong>NARIZ</strong></td>
<td style="text-align:center">'.$exa_fis_nariz.'</td>
<td>'.$exa_fis_nariz_obser.'</td>
</tr>
<tr>
<td><strong>OROFARINGE</strong></td>
<td style="text-align:center">'.$exa_fis_orofaring.'</td>
<td>'.$exa_fis_orofaring_obser.'</td>
</tr>
<tr>
<td><strong>CUELLO</strong></td>
<td style="text-align:center">'.$exa_fis_cuello.'</td>
<td>'.$exa_fis_cuello_obser.'</td>
</tr>
<tr>
<td><strong>TÓRAX</strong></td>
<td style="text-align:center">'.$exa_fis_torax.'</td>
<td>'.$exa_fis_torax_obser.'</td>
</tr>
<tr>
<td><strong>SISTEMA MUSCULO ESQUELÉTICO</strong></td>
<td style="text-align:center">'.$exa_fis_sistemmusculesquelet.'</td>
<td>'.$exa_fis_sistemmusculesquelet_observ.'</td>
</tr>
<tr>
<td ><strong>GLÁNDULAS MAMARIAS</strong></td>
<td style="text-align:center">'.$exa_fis_glandumama.'</td>
<td>'.$exa_fis_glandumama_obser.'</td>
</tr>
<tr>
<td><strong>CARDIOPULMONAR</strong></td>
<td style="text-align:center">'.$exa_fis_cardiopulm.'</td>
<td>'.$exa_fis_cardiopulm_obser.'</td>
</tr>
<tr>
<td><strong>ABDOMEN</strong></td>
<td style="text-align:center">'.$exa_fis_abdomen.'</td>
<td>'.$exa_fis_abdomen_obser.'</td>
</tr>
<tr>
<td ><strong>GENITALES</strong></td>
<td style="text-align:center">'.$exa_fis_genital.'</td>
<td>'.$exa_fis_genital_obser.'</td>
</tr>
<tr>
<td><strong>MIEMBROS SUPERIORES</strong></td>
<td style="text-align:center">'.$exa_fis_miemsup.'</td>
<td>'.$exa_fis_miemsup_obser.'</td>
</tr>
<tr>
<td><strong>MIEMBROS INFERIORES</strong></td>
<td style="text-align:center">'.$exa_fis_mieminf.'</td>
<td>'.$exa_fis_mieminf_obser.'</td>
</tr>
<tr>
<td><strong>COLUMNA</strong></td>
<td style="text-align:center">'.$exa_fis_columna.'</td>
<td>'.$exa_fis_columna_obser.'</td>
</tr>
<tr>
<td><strong>NEUROLÓGICO</strong><strong> (PRUEBAS DE EQUILIBRIO)</strong>
<br>
<strong>(Equilibrio Estático)</strong><br>';
if ($exa_fis_neurolog_romberg <> "") { $codigoHTML.='Prueba de Romberg <strong>['.$exa_fis_neurolog_romberg.']</strong>'; }
if ($exa_fis_neurolog_barany <> "") { $codigoHTML.='<br>Prueba de Barany <strong>['.$exa_fis_neurolog_barany.']</strong>'; }
if ($exa_fis_neurolog_dixhalp <> "") { $codigoHTML.='<br>Maniobra de Dix Halpike <strong>['.$exa_fis_neurolog_dixhalp.']</strong>'; }
$codigoHTML.='<br><strong>(Equilibrio Dinamico)</strong>';
if ($exa_fis_neurolog_mciega <> "") { $codigoHTML.='<br>Marcha a Ciegas <strong>['.$exa_fis_neurolog_mciega.']</strong>'; }
if ($exa_fis_neurolog_pciega <> "") { $codigoHTML.='<br>Pisoteo a Ciegas <strong>['.$exa_fis_neurolog_pciega.']</strong>'; }
$codigoHTML.='
</td>
<td style="text-align:center">'.$exa_fis_neurolog.'</td>
<td>'.$exa_fis_neurolog_obser.'</td>
</tr>
<tr>
<td><strong>ESTADO MENTAL APARENTE</strong></td>
<td style="text-align:center">'.$exa_fis_estmentaparent.'</td>
<td>'.$exa_fis_estmentaparent_obser.'</td>
</tr>
<tr>
<td><strong>PIEL Y FANERAS</strong></td>
<td style="text-align:center">'.$exa_fis_pielfanera.'</td>
<td>'.$exa_fis_pielfanera_obser.'</td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">7. EXAMEN OSTEOMUSCULAR </span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<tbody>
<tr>
<td><strong>Maniobra semiológicas</strong></td>
<td colspan="2"><strong>Interpretación</strong></td>
<td><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="2"><strong>Movilidad Articular</strong></td>
<td colspan="3"><strong>Fuerza</strong></td>
</tr>
<tr>
<td colspan="3"><strong>Hombro</strong></td>
<td><strong>MMSS</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_homb_movart.'</td>
<td style="text-align:center" colspan="3">'.$exaosteo_homb_fuerza.'</td>
</tr>
<tr>
<td><strong>Maniobra Jobe</strong></td>
<td style="text-align:center">'.$exaosteo_manjobe_sig.'</td>
<td style="text-align:center">'.$exaosteo_manjobe_lat.'</td>
<td><strong>MMII</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_manjobe_movart.'</td>
<td style="text-align:center" colspan="3">'.$exaosteo_manjobe_fuerza.'</td>
</tr>
<tr>
<td><strong>Maniobra de Yergason</strong></td>
<td style="text-align:center">'.$exaosteo_manyega_sig.'</td>
<td style="text-align:center">'.$exaosteo_manyega_lat.'</td>
<td><strong>Columna</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_manyega_movart.'</td>
<td style="text-align:center" colspan="3">'.$exaosteo_manyega_fuerza.'</td>
</tr>
<tr>
<td><strong>Maniobra de Patte</strong></td>
<td style="text-align:center">'.$exaosteo_manpatte_sig.'</td>
<td style="text-align:center">'.$exaosteo_manpatte_lat.'</td>
<td><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="2"><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="3"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td style="text-align:center" colspan="3"><strong>Codo</strong></td>
<td style="text-align:center" colspan="6"><strong>Mu&ntilde;eca</strong></td>
</tr>
<tr>
<td><strong>Prueba de Epicondilitis</strong></td>
<td style="text-align:center">'.$exaosteo_epicond_sig.'</td>
<td style="text-align:center">'.$exaosteo_epicond_lat.'</td>
<td colspan="2"><strong>Phalen</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_phalen_sig.'</td>
<td style="text-align:center" colspan="2">'.$exaosteo_phalen_lat.'</td>
</tr>
<tr>
<td><strong>Prueba de Epitrocleitis</strong></td>
<td style="text-align:center">'.$exaosteo_epitro_sig.'</td>
<td style="text-align:center">'.$exaosteo_epitro_lat.'</td>
<td colspan="2"><strong>Finkelstein</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_finkel_sig.'</td>
<td style="text-align:center" colspan="2">'.$exaosteo_finkel_lat.'</td>
</tr>
<tr>
<td><strong>Prueba de Thompson</strong></td>
<td style="text-align:center">'.$exaosteo_thomp_sig.'</td>
<td style="text-align:center">'.$exaosteo_thomp_lat.'</td>
<td colspan="2"><strong>Tinel</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_tinel_sig.'</td>
<td style="text-align:center" colspan="2">'.$exaosteo_tinel_lat.'</td>
</tr>
<tr>
<td style="text-align:center" colspan="3"><strong>Lumbar</strong></td>
<td style="text-align:center" colspan="6"><strong>Miembro Inferior</strong></td>
</tr>
<tr>
<td><strong>Signo de Lasegue</strong></td>
<td style="text-align:center">'.$exaosteo_laseg_sig.'</td>
<td style="text-align:center">&nbsp;</td>
<td colspan="2"><strong>Signo del Cajón</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_cajon_sig.'</td>
<td style="text-align:center" colspan="2">'.$exaosteo_cajon_lat.'</td>
</tr>
<tr>
<td><strong>Signo de Schober Flexión</strong></td>
<td style="text-align:center">'.$exaosteo_flexion.'</td>
<td><strong>Cm</strong></td>
<td colspan="2"><strong>Signo del Bostezo</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_bostezo_sig.'</td>
<td style="text-align:center" colspan="2">'.$exaosteo_bostezo_lat.'</td>
</tr>
<tr>
<td><strong>Signo de Schober </strong> <strong>Extensión</strong></td>
<td style="text-align:center">'.$exaosteo_extension.'</td>
<td><strong>Grados</strong></td>
<td colspan="2"><strong>Mc Murray</strong></td>
<td style="text-align:center" colspan="2">'.$exaosteo_mcmurray_sig.'</td>
<td style="text-align:center" colspan="2">'.$exaosteo_mcmurray_lat.'</td>
</tr>
<tr>
<td><strong>Signo de Bragard</strong></td>
<td style="text-align:center">'.$exaosteo_bragard_sig.'</td>
<td style="text-align:center">'.$exaosteo_bragard_lat.'</td>
</tr>
<tr>
<td colspan="3"><strong>Cadera</strong></td>
<td colspan="6"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>Trendelemburg</strong></td>
<td style="text-align:center">'.$exaosteo_tredelen.'</td>
<td></td>
<td colspan="6"></td>
</tr>
<tr><td colspan="9"><strong>Valoración de la Marcha: </strong>'.$exaosteo_valmarcha.'</td></tr>
<tr><td colspan="9"><strong>Observaciones Generales: </strong>'.$exaosteo_observ.'</td></tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
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
<td style="text-align:center"><strong>'.$paracli_audimet.'</strong></td>
<td>'.$paracli_audimet_observ.'</td>
</tr>
<tr>
<td><strong>Visiometría / Optometría</strong></td>
<td style="text-align:center"><strong>'.$paracli_visiomet.'</strong></td>
<td>'.$paracli_visiomet_observ.'</td>
</tr>
<tr>
<td><strong>Rx de Tórax </strong></td>
<td style="text-align:center"><strong>'.$paracli_torax.'</strong></td>
<td>'.$paracli_torax_observ.'</td>
</tr>
<tr>
<td><strong>Espirometría</strong></td>
<td style="text-align:center"><strong>'.$paracli_espiro.'</strong></td>
<td>'.$paracli_espiro_observ.'</td>
</tr>
<tr>
<td><strong>EKG</strong></td>
<td style="text-align:center"><strong>'.$paracli_ekg.'</strong></td>
<td>'.$paracli_ekg_observ.'</td>
</tr>
<tr>
<td><strong>Rx de Columna</strong></td>
<td style="text-align:center"><strong>'.$paracli_rxcolum.'</strong></td>
<td>'.$paracli_rxcolum_observ.'</td>
</tr>
<tr>
<td><strong>Otras pruebas complementarias</strong></td>
<td style="text-align:center"><strong>'.$paracli_otrcomplement.'</strong></td>
<td>'.$paracli_otrcomplement_observ.'</td>
</tr>
<tr>
<td><strong>Examen por Fisioterapia</strong></td>
<td style="text-align:center"><strong>'.$paracli_fisiote.'</strong></td>
<td>'.$paracli_fisiote_observ.'</td>
</tr>
<tr>
<td><strong>Laboratorios</strong></td>
<td style="text-align:center"><strong>'.$paracli_lab.'</strong></td>
<td>'.$paracli_lab_observ.'</td>
</tr>
<tr>
<td><strong>Otros</strong></td>
<td style="text-align:center"><strong>'.$paracli_otro.'</strong></td>
<td><strong>Cuales: </strong> '.$paracli_otro_observ.'</td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead>
<tr>
<td style="text-align:center"><strong>CIE 10</strong></td>
<td style="text-align:center"><strong>Diágnostico</strong></td>
<td style="text-align:center"><strong>Impresión Diagnostica</strong></td>
<td style="text-align:center"><strong>Confirmado Nuevo</strong></td>
<td style="text-align:center"><strong>Confirmado Repetido</strong></td>
<td style="text-align:center"><strong>DIÁGNOSTICO PRINCIPAL</strong></td>
</tr>
</thead>
<tbody>';
$obtener_cie10diag = "SELECT * FROM tbl15_cie10diag WHERE cod_historia_clinica = $cod_historia_clinica";
$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_cie10diag);
while ($info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag)) {
$cod_cie10diag      = $info_cie10diag["cod_cie10diag"];
$cie10_cod          = $info_cie10diag["cie10_cod"];
$cie10_diag         = $info_cie10diag["cie10_diag"];
$cie10_impdiag      = $info_cie10diag["cie10_impdiag"];
$cie10_confirnuev   = $info_cie10diag["cie10_confirnuev"];
$cie10_confirepet   = $info_cie10diag["cie10_confirepet"];
$cie10_diagprinc    = $info_cie10diag["cie10_diagprinc"];
$codigoHTML.='
<tr>
<td>'.$cie10_cod.'</td>
<td>'.$cie10_diag.'</td>
<td style="text-align:center">'.$cie10_impdiag.'</td>
<td style="text-align:center">'.$cie10_confirnuev.'</td>
<td style="text-align:center">'.$cie10_confirepet.'</td>
<td style="text-align:center">'.$cie10_diagprinc.'</td>
</tr>';
} 
$codigoHTML.='
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
';
if ($sintoma_covid19=='SI') {
$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090" style="text-align:center"><strong>En caso se presentar problemas respiratorios, por favor marque "SI"</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EN LOS ULTIMOS 14 DÍAS HA PRESENTADO ESTOS SÍNTOMAS </strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td style="text-align:left"><strong>FIEBRE MAYOR A 38 °C</strong></td>
    <td style="text-align:center"><strong>'.$covid19_fiebre.'</strong></td>
    <td style="text-align:left"><strong>ESCALOFRIOS</strong></td>
    <td style="text-align:center"><strong>'.$covid19_escolofrio.'</strong></td>
    <td style="text-align:left"><strong>CANSANCIO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_cansansio.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>MALESTAR GENERAL</strong></td>
    <td style="text-align:center"><strong>'.$covid19_malestar_gral.'</strong></td>
    <td style="text-align:left"><strong>FATIGA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_fatiga.'</strong></td>
    <td style="text-align:left"><strong>TOS SECA O PRODUCTIVA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_tos_seca.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>CEFALEA (DOLOR DE CABEZA)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_cefaleas.'</strong></td>
    <td style="text-align:left"><strong>CONGESTION NASAL</strong></td>
    <td style="text-align:center"><strong>'.$covid19_congestion_nasal.'</strong></td>
    <td style="text-align:left"><strong>RINORREA (ESCURRIMIENTO NASAL)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_secrecion_nasal.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>DOLOR DE GARGANTA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dorlor_garganta.'</strong></td>
    <td style="text-align:left"><strong>DIARREA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_diarrea.'</strong></td>
    <td style="text-align:left"><strong>DIFICULTAD RESPIRATORIA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dificul_resp.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>INAPETENCIA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_inapetencia.'</strong></td>
    <td style="text-align:left"><strong>ANOSMIA (PERDIDA DEL OLFATO)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_perdida_olfato.'</strong></td>
    <td style="text-align:left"><strong>DISGEUSIA (PERDIDA EL GUSTO)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_perdida_gusto.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>DEDOS DE COVID(MORETONES EN CUALQUIER SITIO DEL CUERPO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dedos_covid.'</strong></td>
    <td style="text-align:left"><strong>DOLOR U OPRESION EN EL PECHO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dolor_pecho.'</strong></td>
    <td style="text-align:left"><strong>CONFUSION</strong></td>
    <td style="text-align:center"><strong>'.$covid19_confusion.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>COLORACION AZULADA EN LABIOS O EL ROSTRO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_color_azul_labios.'</strong></td>
    <td style="text-align:left"><strong>ARTRALGIAS (Dolor de articulaciones)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_artralgia.'</strong></td>
    <td style="text-align:left"><strong>MIALGIAS (Dolor muscular)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_mialgia.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>ASTENIA (Debilidad muscular)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_astenia.'</strong></td>
    <td style="text-align:left"><strong>ODINOFAGIA (Dolor al tragar)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_odinofagia.'</strong></td>
    <td style="text-align:left"><strong>IRRITACIÓN O ARDOR EN LOS OJOS</strong></td>
    <td style="text-align:center"><strong>'.$covid19_irritacion_ardor_ojos.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>NAUSEAS O VOMITO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_nauseas.'</strong></td>
    <td style="text-align:left"><strong>¿HA ESTADO EN CONTACTO CON PERSONAS SOSPECHOSAS O CONFIRMADAS POR COVID-19?</strong></td>
    <td style="text-align:center"><strong>'.$covid19_contacto_person_sospech_covid.'</strong></td>
    <td style="text-align:left"><strong></strong></td>
    <td style="text-align:center"><strong></strong></td>
  </tr>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
    <tr>
    <td style="text-align:left"><strong>¿CUÁNTO TIEMPO TIENE CON SU MOLESTIA ACTUAL?</strong></td>
    <td style="text-align:center"><strong>'.$nombre_tiempo_molestia_actual_covid.'</strong></td>
    </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
    <tr>
    <td style="text-align:left"><strong>TEMPERATURA:</strong></td>
    <td style="text-align:left"><strong>'.$nombre_temperatura_covid.'</strong></td>
    <td style="text-align:left"><strong>PULSO:</strong></td>
    <td style="text-align:left"><strong>'.$nombre_pulso_covid.'</strong></td>
    <td style="text-align:left"><strong>SATURACIÓN:</strong></td>
    <td style="text-align:left"><strong>'.$nombre_saturacion_covid.'</strong></td>
    </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
';
} 
$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>CONTROL</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody>
    	<tr>
    		<td style="text-align:justify">'.$control_examen.'</td>
    	</tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="justify" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:7pt; width:100%">
    <tbody>
    	<tr>
    		<td style="text-align:justify">'.$info_histclinic_emp.'</td>
    	</tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><strong>Medico</strong>
    <div style="text-align:center"><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_prof.' '.$apellidos_prof.'</strong>
    <br />
    <strong>Reg. Medico '.$reg_medico_emp.'</strong>
    <br />
    <strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong> </td>
    <td width="387" valign="top"><strong>Paciente</strong>
    <div style="text-align:center"><img src="'.$url_img_firma_min_cli.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_cli.' '.$apellido1_cli.'</strong><br />
    <strong>C.C '.$cedula.'</strong> </td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->

</body>
</html>
';
$mpdf->WriteHTML(($codigoHTML));
$mpdf->SetTitle($titulo_doc_pdf);
$mpdf->SetAuthor($autor_doc_pdf);
$mpdf->SetCreator($autor_doc_pdf);
$mpdf->SetSubject($tema_doc_pdf);
$mpdf->SetKeywords($palabras_claves_doc_pdf);
$ruta = '../pdfs/';
$nombre_archivo = 'HC_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
$mpdf->Output($nombre_archivo, 'I');
$mpdf->Output();
exit;
/*
$mpdf->WriteHTML('<tocpagebreak sheet-size="A4-L" toc-sheet-size="A5" toc-preHTML="This ToC should print on an A5 sheet" />');
$mpdf->WriteHTML('<tocentry content="A4 landscape" /><p>This page appears just after the ToC and should print on an A4 (landscape) sheet</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="A5-L" />');
$mpdf->WriteHTML('<tocentry content="A5 landscape" /><p>This should print on an A5 (landscape) sheet</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="Letter" />');
$mpdf->WriteHTML('<tocentry content="Letter portrait" /><p>This should print on an Letter sheet</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="150mm 150mm" />');
$mpdf->WriteHTML('<tocentry content="150mm square" /><p>This should print on a sheet 150mm x 150mm</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="11.69in 8.27in" />');
*/
?>
<?php ob_end_flush(); ?>