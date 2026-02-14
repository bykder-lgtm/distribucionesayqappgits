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
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Crear Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy = date("Y/m/d");
$fecha_hoy_time = strtotime(date("Y/m/d"));
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$cod_cliente = intval($_GET['cod_cliente']);

$sql_info_empresa = "SELECT titulo, nombre, eslogan, direccion, ciudad, pais, correo, cabecera, img_cabecera, telefono, info_legal, 
res, res1, res2, departamento, localidad, reg_medico, regimen, version, propietario_url_firma, fecha_time, licencia,
logotipo, icono, propietario_nombres_apellidos, propietario_nit, nit_empresa, desarrollador, anyo, url_pag, nombre_font FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                   = $info_empresa_data['titulo'];
$nombre_emp                   = $info_empresa_data['nombre'];
$eslogan_emp                  = $info_empresa_data['eslogan'];
$direccion_emp                = $info_empresa_data['direccion'];
$ciudad_emp                   = $info_empresa_data['ciudad'];
$pais_emp                     = $info_empresa_data['pais'];
$correo_emp                   = $info_empresa_data['correo'];
$img_cabecera_emp             = $info_empresa_data['img_cabecera'];
$telefono_emp                 = $info_empresa_data['telefono'];
$info_legal_emp               = $info_empresa_data['info_legal'];
$logotipo_emp                 = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp          = $info_empresa_data['propietario_nit'];
$nit_empresa_emp              = $info_empresa_data['nit_empresa'];
$cabecera_emp                 = $info_empresa_data['cabecera'];
$icono_emp                    = $info_empresa_data['icono'];
$desarrollador_emp            = $info_empresa_data['desarrollador'];
$anyo_emp                     = $info_empresa_data['anyo'];
$url_pag                      = $info_empresa_data['url_pag'];
$nombre_font                  = $info_empresa_data['nombre_font'];
$res_emp                      = $info_empresa_data['res'];
$res1_emp                     = $info_empresa_data['res1'];
$res2_emp                     = $info_empresa_data['res2'];
$departamento_emp             = $info_empresa_data['departamento'];
$localidad_emp                = $info_empresa_data['localidad'];
$reg_medico_emp               = $info_empresa_data['reg_medico'];
$regimen_emp                  = $info_empresa_data['regimen'];
$version_emp                  = $info_empresa_data['version'];
$propietario_url_firma_emp    = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp               = $info_empresa_data['fecha_time'];
$licencia_emp                 = $info_empresa_data['licencia'];

$sql_historia_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cod_cliente, tbl15_cliente.nombre_tipo_doc, 
tbl15_cliente.nombre_ocupacion, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_contacto1, 
tbl15_cliente.parentesco_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.antperson_alergia_si, tbl15_cliente.antperson_alergia_no, tbl15_cliente.nombre_escolaridad,
tbl15_cliente.antperson_patologico_si, tbl15_cliente.antperson_patologico_no, tbl15_cliente.antperson_quirurgico_si, tbl15_cliente.antperson_quirurgico_no, 
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, 
tbl15_cliente.url_img_foto AS url_img_foto_cli,
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_cliente.edad_anyo,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_actividad_ecoemp, 
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.correo, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, 
tbl15_cliente.cargo_empresa, tbl15_cliente.area_empresa, tbl15_cliente.ciudad_empresa, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2,
tbl15_cliente.nombre_tipo_regimen, tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_numero_hijos, tbl15_cliente.nombre_arl, tbl15_cliente.lugar_nac, 
tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_estado_civil, tbl15_cliente.nombre_raza, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2, 
tbl15_historia_clinica.nombre_laboratorio, tbl15_historia_clinica.motivo,  tbl15_historia_clinica.fecha_reg_time, 
tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cuenta, 
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
tbl15_historia_clinica.ant_quirur_fech_aprox3, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.cod_grupo_area, tbl15_historia_clinica.cod_grupo_area_cargo, tbl15_historia_clinica.cod_administrador
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
$tel_cliente                  = $info_historia_clinica['tel_cliente'];
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
$cargo_empresa                = $info_historia_clinica['cargo_empresa'];
$area_empresa                 = $info_historia_clinica['area_empresa'];
$ciudad_empresa               = $info_historia_clinica['ciudad_empresa'];
$direccion_contacto1          = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2          = $info_historia_clinica['direccion_contacto2'];
$direccion_contacto2          = $info_historia_clinica['direccion_contacto2'];
$cod_grupo_area               = $info_historia_clinica['cod_grupo_area'];
$cod_grupo_area_cargo         = $info_historia_clinica['cod_grupo_area_cargo'];
$fecha_time                   = $info_historia_clinica['fecha_time'];
$fecha_reg_time               = $info_historia_clinica['fecha_reg_time'];
$fecha_ymd                    = $info_historia_clinica['fecha_ymd'];
$cuenta                       = $info_historia_clinica['cuenta'];
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
$fecha_ymd_hora               = date("Y/m/d H:i:s", $fecha_time);
$fecha_dmy                    = $info_historia_clinica['fecha_dmy'];
$fecha_reg_time_dmy           = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica       = date("Y/m/d", $fecha_time);
$fecha_y_hora_registro        = date("Y/m/d H:i:s");
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/reg_historia_clinica_mejorada_reg.php">
	<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<tbody>
<!--<tr><th>HISTORIA CLINICA No.</th><td align="center"><?php echo $cod_historia_clinica ?></td></tr>-->
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
<td style="text-align:center">
<select name="motivo">
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
</tr>

</thead>
<tbody></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" class="table table-responsive" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
    	<th style="text-align:center">FECHA Y HORA:
    	<div id="fecha_ymd_hora" class="input-append date"><input type="text" name="fecha_ymd_hora" value="<?php echo $fecha_y_hora_registro ?>" required></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></th>
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

<td style="text-align:center"><select name="nombre_empresa_contratante">
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

<td style="text-align:center"><select id="nombre_empresa" name="nombre_empresa" onChange="conocer_empresa_laborar();">
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

<td style="text-align:center"><select name="nombre_actividad_ecoemp">
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

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">AREA A LABORAR Y CARGO</th>
<!--<th style="text-align:center">Area a Laborar</th>-->
<th bgcolor="#FAC090">CIUDAD</th>
</tr></thead>
<tbody><tr>
<!--<td align="center"><?php echo $cargo_empresa ?></td>-->
<td><select name="cod_grupo_area_cargo" id="cod_grupo_area_cargo" onChange="conocer_cargo();" class="selectpicker" data-show-subtext="true" data-live-search="true">
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
echo "<option value='".$codigo."' $seleccionado >".$nombre2.' - '.$nombre."</option>"; } ?>
</select></td>
<!--<td><input class="input-block-level" name="cargo_empresa" type="text" value="<?php echo $cargo_empresa ?>" /></td>-->
<!--<td style="text-align:center"><input class="input-block-level" name="area_empresa" type="text" value="<?php echo $area_empresa ?>" /></td>-->
<td><input style="text-align:center" class="input-block-level" name="ciudad_empresa" type="text" value="<?php echo $ciudad_empresa ?>"/></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">2. DATOS OCUPACIONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.1. Historia Laboral</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center" rowspan="2"><strong>Empresa nombre comercial</strong><br />ACTUAL (1) ANTERIORES (2 Y 3)</td>
            <td style="text-align:center" rowspan="2"><strong>Cargo</strong> </td>
            <td style="text-align:center" colspan="4"><strong>Elementos de protección personal</strong></td>
            <td style="text-align:center" rowspan="2"><strong>Fecha inicio</strong></td>
            <td style="text-align:center" rowspan="2"><strong>Duración (Años)</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>Visual</strong></td>
            <td style="text-align:center"><strong>auditivo</strong></td>
            <td style="text-align:center"><strong>alturas</strong></td>
            <td style="text-align:center"><strong>respiratorios</strong></td>
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

            <td style="text-align:center"><input name="dat_ocupa_visu1" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_audi1" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_altu1" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_resp1" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_fech_ini1" type="text" value=""/></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_dura_anyo1" type="number" value=""/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="dat_ocupa_emp2" type="text" value=""/></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_carg2" type="text" value=""/></td>
            <td style="text-align:center"><input name="dat_ocupa_visu2" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_audi2" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_altu2" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_resp2" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_fech_ini2" type="text" value=""/></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_dura_anyo2" type="number" value=""/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="dat_ocupa_emp3" type="text" value=""/></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_carg3" type="text" value=""/></td>
            <td style="text-align:center"><input name="dat_ocupa_visu3" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_audi3" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_altu3" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="dat_ocupa_resp3" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_fech_ini3" type="text" value=""/></td>
            <td style="text-align:center"><input style="text-align:center" class="input-block-level" name="dat_ocupa_dura_anyo3" type="number" value=""/></td>
        </tr>
        <tr>
            <td colspan="8"><strong>Observaciones: <input class="input-block-level" name="dat_ocupa_observacion" type="text" value=""/></strong></td>
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

            <td style="text-align:center"><input name="clasrieg_fis1_ruid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis1_ilum" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis1_noionic" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis1_vibra" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis1_tempextrem" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis1_cambpres" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim1_gasvapor" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim1_aeroliq" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim1_solid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim1_liquid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog1_viru" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog1_bacter" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog1_parasi" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog1_morde" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog1_picad" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog1_hongo" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo1_trabestat" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo1_esfuerfis" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo1_carga" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo1_postforz" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo1_movrepet" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo1_jortrab" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi1_monoto" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi1_relhuman" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi1_contentarea" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi1_orgtiemptrab" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_mecanic" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_electri" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_locat" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_fisiquim" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_public" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_espconfi" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur1_trabaltura" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_observ1_otro" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input class="input-block-level" name="clasrieg_observ1_coment" type="text" value=""/></td>
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="clasrieg_carg2" type="text" value=""/></td>
            <td style="text-align:center"><input name="clasrieg_fis2_ruid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis2_ilum" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis2_noionic" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis2_vibra" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis2_tempextrem" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis2_cambpres" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim2_gasvapor" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim2_aeroliq" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim2_solid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim2_liquid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog2_viru" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog2_bacter" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog2_parasi" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog2_morde" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog2_picad" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog2_hongo" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo2_trabestat" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo2_esfuerfis" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo2_carga" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo2_postforz" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo2_movrepet" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo2_jortrab" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi2_monoto" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi2_relhuman" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi2_contentarea" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi2_orgtiemptrab" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_mecanic" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_electri" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_locat" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_fisiquim" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_public" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_espconfi" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur2_trabaltura" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_observ2_otro" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input class="input-block-level" name="clasrieg_observ2_coment" type="text" value=""/></td>
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="clasrieg_carg3" type="text" value=""/></td>
            <td style="text-align:center"><input name="clasrieg_fis3_ruid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis3_ilum" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis3_noionic" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis3_vibra" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis3_tempextrem" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_fis3_cambpres" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim3_gasvapor" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim3_aeroliq" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim3_solid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_quim3_liquid" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog3_viru" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog3_bacter" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog3_parasi" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog3_morde" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog3_picad" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_biolog3_hongo" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo3_trabestat" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo3_esfuerfis" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo3_carga" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo3_postforz" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo3_movrepet" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_ergo3_jortrab" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi3_monoto" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi3_relhuman" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi3_contentarea" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_psi3_orgtiemptrab" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_mecanic" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_electri" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_locat" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_fisiquim" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_public" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_espconfi" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_segur3_trabaltura" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input name="clasrieg_observ3_otro" type="checkbox" value="S" /></td>
            <td style="text-align:center"><input class="input-block-level" name="clasrieg_observ3_coment" type="text" value=""/></td>
        </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
function conocer_cargo(){
cod_grupo_area_cargo = document.getElementById("cod_grupo_area_cargo").value;
document.getElementById("dat_ocupa_carg1").value = cod_grupo_area_cargo;
document.getElementById("clasrieg_fis1_ruid").value = cod_grupo_area_cargo;
}
function conocer_empresa_laborar(){
nombre_empresa = document.getElementById("nombre_empresa").value;
document.getElementById("dat_ocupa_emp1").value = nombre_empresa;
document.getElementById("clasrieg_carg1").value = nombre_empresa;
}
</script>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>Antecedentes relacionados de importancia</strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.3 Accidente Laboral&nbsp;&nbsp;&nbsp;
SI<input type="radio" name="ant_impor_accilab" value="SI" <?php echo ($ant_impor_accilab=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_impor_accilab" value="NO" <?php echo ($ant_impor_accilab=='NO')?'checked':'' ?> ></strong></td></tr>
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
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_fecha1" type="text" value="<?php echo $ant_impor_fecha1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_empre1" type="text" value="<?php echo $ant_impor_empre1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_causa1" type="text" value="<?php echo $ant_impor_causa1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_tip_lesi1" type="text" value="<?php echo $ant_impor_tip_lesi1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_part_afect1" type="text" value="<?php echo $ant_impor_part_afect1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_dias_incap1" type="number" value="<?php echo $ant_impor_dias_incap1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_secuela1" type="text" value="<?php echo $ant_impor_secuela1 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_fecha2" type="text" value="<?php echo $ant_impor_fecha2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_empre2" type="text" value="<?php echo $ant_impor_empre2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_causa2" type="text" value="<?php echo $ant_impor_causa2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_tip_lesi2" type="text" value="<?php echo $ant_impor_tip_lesi2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_part_afect2" type="text" value="<?php echo $ant_impor_part_afect2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_dias_incap2" type="number" value="<?php echo $ant_impor_dias_incap2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_impor_secuela2" type="text" value="<?php echo $ant_impor_secuela2 ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>2.4 Enfermedad Laboral&nbsp;&nbsp;&nbsp;
SI<input type="radio" name="enf_lab" value="SI" <?php echo ($enf_lab=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="enf_lab" value="NO" <?php echo ($enf_lab=='NO')?'checked':'' ?> ></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <td><strong>Cual: </strong><input class="input-block-level" name="enf_cual" type="text" value="<?php echo $enf_cual ?>"/></td>
        <td><strong>Hace Cuánto: </strong><input class="input-block-level" name="enf_hace_cuanto" type="text" value="<?php echo $enf_hace_cuanto ?>"/></td>
        <td><strong>Descripción: </strong><input class="input-block-level" name="enf_descripcion" type="text" value="<?php echo $enf_descripcion ?>"/></td></tr>
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
        <tr><td><strong>No Presenta Antecedentes Familiares&nbsp;&nbsp;&nbsp;<input name="ant_fam_no_presenta" type="checkbox" value="NO" /></strong></td></tr>
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
            <td style="text-align:center"><input name='ant_fam_hiper_pad' type='checkbox' value='S' <? if($ant_fam_hiper_pad=='S'){ echo 'checked'; } ?>></td>
            <td style="text-align:center"><input name="ant_fam_hiper_mad" type='checkbox' value='S' <? if($ant_fam_hiper_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_hiper_herm" type='checkbox' value='S' <? if($ant_fam_hiper_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_hiper_otro" type='checkbox' value='S' <? if($ant_fam_hiper_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_hiper_otro_cual" type="text" value="<?php echo $ant_fam_hiper_otro_cual ?>"/></td>
            <td><strong>Cardiopatia</strong><strong> </strong></td>
            <td style="text-align:center"><input name="ant_fam_cadio_pad" type='checkbox' value='S' <? if($ant_fam_cadio_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_cadio_mad" type='checkbox' value='S' <? if($ant_fam_cadio_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_cadio_herm" type='checkbox' value='S' <? if($ant_fam_cadio_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_cadio_otro" type='checkbox' value='S' <? if($ant_fam_cadio_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_cadio_otro_cual" type="text" value="<?php echo $ant_fam_cadio_otro_cual ?>"/></td>
            <td><strong>Osteomusculares</strong></td>
            <td style="text-align:center"><input name="ant_fam_osteomusc_pad" type='checkbox' value='S' <? if($ant_fam_osteomusc_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_osteomusc_mad" type='checkbox' value='S' <? if($ant_fam_osteomusc_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_osteomusc_herm" type='checkbox' value='S' <? if($ant_fam_osteomusc_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_osteomusc_otro" type='checkbox' value='S' <? if($ant_fam_osteomusc_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_osteomusc_otro_cual" type="text" value="<?php echo $ant_fam_osteomusc_otro_cual ?>"/></td>
        </tr>
        <tr>
            <td><strong>Diabetes</strong></td>
            <td style="text-align:center"><input name="ant_fam_diabet_pad" type='checkbox' value='S' <? if($ant_fam_diabet_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_diabet_mad" type='checkbox' value='S' <? if($ant_fam_diabet_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_diabet_herm" type='checkbox' value='S' <? if($ant_fam_diabet_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_diabet_otro" type='checkbox' value='S' <? if($ant_fam_diabet_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_diabet_otro_cual" type="text" value="<?php echo $ant_fam_diabet_otro_cual ?>"/></td>
            <td><strong>Trans. Convulsivo</strong></td>
            <td style="text-align:center"><input name="ant_fam_trans_convul_pad" type='checkbox' value='S' <? if($ant_fam_trans_convul_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_trans_convul_mad" type='checkbox' value='S' <? if($ant_fam_trans_convul_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_trans_convul_herm" type='checkbox' value='S' <? if($ant_fam_trans_convul_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_trans_convul_otro" type='checkbox' value='S' <? if($ant_fam_trans_convul_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_trans_convul_otro_cual" type="text" value="<?php echo $ant_fam_trans_convul_otro_cual ?>"/></td>
            <td><strong>Artitris</strong></td>
            <td style="text-align:center"><input name="ant_fam_artitri_pad" type='checkbox' value='S' <? if($ant_fam_artitri_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_artitri_mad" type='checkbox' value='S' <? if($ant_fam_artitri_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_artitri_herm" type='checkbox' value='S' <? if($ant_fam_artitri_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_artitri_otro" type='checkbox' value='S' <? if($ant_fam_artitri_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_artitri_otro_cual" type="text" value="<?php echo $ant_fam_artitri_otro_cual ?>"/></td>
        </tr>
        <tr>
            <td><strong>ACV o Trombosis</strong></td>
            <td style="text-align:center"><input name="ant_fam_trombos_pad" type='checkbox' value='S' <? if($ant_fam_trombos_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_trombos_mad" type='checkbox' value='S' <? if($ant_fam_trombos_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_trombos_herm" type='checkbox' value='S' <? if($ant_fam_trombos_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_trombos_otro" type='checkbox' value='S' <? if($ant_fam_trombos_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_trombos_otro_cual" type="text" value="<?php echo $ant_fam_trombos_otro_cual ?>"/></td>
            <td><strong>Efermedad Genetica </strong></td>
            <td style="text-align:center"><input name="ant_fam_enf_gene_pad" type='checkbox' value='S' <? if($ant_fam_enf_gene_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_enf_gene_mad" type='checkbox' value='S' <? if($ant_fam_enf_gene_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_enf_gene_herm" type='checkbox' value='S' <? if($ant_fam_enf_gene_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_enf_gene_otro" type='checkbox' value='S' <? if($ant_fam_enf_gene_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_enf_gene_otro_cual" type="text" value="<?php echo $ant_fam_enf_gene_otro_cual ?>"/></td>
            <td><strong>Varices</strong></td>
            <td style="text-align:center"><input name="ant_fam_varice_pad" type='checkbox' value='S' <? if($ant_fam_varice_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_varice_mad" type='checkbox' value='S' <? if($ant_fam_varice_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_varice_herm" type='checkbox' value='S' <? if($ant_fam_varice_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_varice_otro" type='checkbox' value='S' <? if($ant_fam_varice_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_varice_otro_cual" type="text" value="<?php echo $ant_fam_varice_otro_cual ?>"/></td>
        </tr>
        <tr>
            <td><strong>Tumores Malignos </strong></td>
            <td style="text-align:center"><input name="ant_fam_tum_malig_pad" type='checkbox' value='S' <? if($ant_fam_tum_malig_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_tum_malig_mad" type='checkbox' value='S' <? if($ant_fam_tum_malig_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_tum_malig_herm" type='checkbox' value='S' <? if($ant_fam_tum_malig_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_tum_malig_otro" type='checkbox' value='S' <? if($ant_fam_tum_malig_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_tum_malig_otro_cual" type="text" value="<?php echo $ant_fam_tum_malig_otro_cual ?>"/></td>
            <td><strong>Alergias</strong></td>
            <td style="text-align:center"><input name="ant_fam_alerg_pad" type='checkbox' value='S' <? if($ant_fam_alerg_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_alerg_mad" type='checkbox' value='S' <? if($ant_fam_alerg_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_alerg_herm" type='checkbox' value='S' <? if($ant_fam_alerg_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_alerg_otro" type='checkbox' value='S' <? if($ant_fam_alerg_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_alerg_otro_cual" type="text" value="<?php echo $ant_fam_alerg_otro_cual ?>"/></td>
            <td><strong>Otros</strong></td>
            <td style="text-align:center"><input name="ant_fam_otro_pad" type='checkbox' value='S' <? if($ant_fam_otro_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_otro_mad" type='checkbox' value='S' <? if($ant_fam_otro_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_otro_herm" type='checkbox' value='S' <? if($ant_fam_otro_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_otro_otro" type='checkbox' value='S' <? if($ant_fam_otro_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_otro_otro_cual" type="text" value="<?php echo $ant_fam_otro_otro_cual ?>"/></td>
        </tr>
        <tr>
            <td><strong>Enfermedad Mental </strong></td>
            <td style="text-align:center"><input name="ant_fam_enf_ment_pad" type='checkbox' value='S' <? if($ant_fam_enf_ment_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_enf_ment_mad" type='checkbox' value='S' <? if($ant_fam_enf_ment_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_enf_ment_herm" type='checkbox' value='S' <? if($ant_fam_enf_ment_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_enf_ment_otro" type='checkbox' value='S' <? if($ant_fam_enf_ment_otro=='S'){ echo 'checked'; } ?> /></td>
           <td><input class="input-block-level" name="ant_fam_enf_ment_otro_cual" type="text" value="<?php echo $ant_fam_enf_ment_otro_cual ?>"/></td>
            <td><strong>Tuberculosis</strong></td>
            <td style="text-align:center"><input name="ant_fam_tuber_pad" type='checkbox' value='S' <? if($ant_fam_tuber_pad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_tuber_mad" type='checkbox' value='S' <? if($ant_fam_tuber_mad=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_tuber_herm" type='checkbox' value='S' <? if($ant_fam_tuber_herm=='S'){ echo 'checked'; } ?> /></td>
            <td style="text-align:center"><input name="ant_fam_tuber_otro" type='checkbox' value='S' <? if($ant_fam_tuber_otro=='S'){ echo 'checked'; } ?> /></td>
            <td><input class="input-block-level" name="ant_fam_tuber_otro_cual" type="text" value="<?php echo $ant_fam_tuber_otro_cual ?>"/></td>
            <td>&nbsp;</td>
            <td style="text-align:center">&nbsp;</td>
            <td style="text-align:center">&nbsp;</td>
            <td style="text-align:center">&nbsp;</td>
            <td style="text-align:center">&nbsp;</td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_fam_descripcion" type="text" value="<?php echo $ant_fam_descripcion ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.2 Antecedentes Patológicos</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#B6DDE8"><strong>No Presenta Antecedentes Patológicos&nbsp;&nbsp;&nbsp;<input name='ant_pato_no_presenta' type='checkbox' value='X' <? if($ant_pato_no_presenta=='X'){ echo 'checked'; } ?>></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Neurologicos</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_neuro" value="SI" <?php echo ($ant_pato_neuro=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_neuro" value="NO" <?php echo ($ant_pato_neuro=='NO')?'checked':'' ?> ></td>
<td><strong>Respiratorio</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_resp" value="SI" <?php echo ($ant_pato_resp=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_resp" value="NO" <?php echo ($ant_pato_resp=='NO')?'checked':'' ?> ></td>
<td><strong>Dermatologico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_derma" value="SI" <?php echo ($ant_pato_derma=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_derma" value="NO" <?php echo ($ant_pato_derma=='NO')?'checked':'' ?> ></td>	
<td><strong>Psiquiatrico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_psiq" value="SI" <?php echo ($ant_pato_psiq=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_psiq" value="NO" <?php echo ($ant_pato_psiq=='NO')?'checked':'' ?> ></td>
<td><strong>Alergico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_alerg" value="SI" <?php echo ($ant_pato_alerg=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_alerg" value="NO" <?php echo ($ant_pato_alerg=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
<td><strong>Osteomusculares</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_osteomusc" value="SI" <?php echo ($ant_pato_osteomusc=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_osteomusc" value="NO" <?php echo ($ant_pato_osteomusc=='NO')?'checked':'' ?> ></td>	
<td><strong>Gastrointestinal</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_gastrointes" value="SI" <?php echo ($ant_pato_gastrointes=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_gastrointes" value="NO" <?php echo ($ant_pato_gastrointes=='NO')?'checked':'' ?> ></td>	
<td><strong>Hematologico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_hematolog" value="SI" <?php echo ($ant_pato_hematolog=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_hematolog" value="NO" <?php echo ($ant_pato_hematolog=='NO')?'checked':'' ?> ></td>	
<td><strong>Organos de los Sentidos </strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_org_sentid" value="SI" <?php echo ($ant_pato_org_sentid=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_org_sentid" value="NO" <?php echo ($ant_pato_org_sentid=='NO')?'checked':'' ?> ></td>	
<td><strong>Cancer</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_onco" value="SI" <?php echo ($ant_pato_onco=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_onco" value="NO" <?php echo ($ant_pato_onco=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
            <td><strong>Hipertensión</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_hiperten" value="SI" <?php echo ($ant_pato_hiperten=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_hiperten" value="NO" <?php echo ($ant_pato_hiperten=='NO')?'checked':'' ?> ></td>	
<td><strong>Genitourinario</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_genurinario" value="SI" <?php echo ($ant_pato_genurinario=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_genurinario" value="NO" <?php echo ($ant_pato_genurinario=='NO')?'checked':'' ?> ></td>	
<td><strong>Infeccioso</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_infesios" value="SI" <?php echo ($ant_pato_infesios=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_infesios" value="NO" <?php echo ($ant_pato_infesios=='NO')?'checked':'' ?> ></td>	
<td><strong>Congénito</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_congenit" value="SI" <?php echo ($ant_pato_congenit=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_congenit" value="NO" <?php echo ($ant_pato_congenit=='NO')?'checked':'' ?> ></td>	
<td><strong>Famacologico</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_farmacolog" value="SI" <?php echo ($ant_pato_farmacolog=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_farmacolog" value="NO" <?php echo ($ant_pato_farmacolog=='NO')?'checked':'' ?> ></td>	
        </tr>
        <tr>
<td><strong>Transfusiones</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_transfus" value="SI" <?php echo ($ant_pato_transfus=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_transfus" value="NO" <?php echo ($ant_pato_transfus=='NO')?'checked':'' ?> ></td>	
<td><strong>Endicrino</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_endocrino" value="SI" <?php echo ($ant_pato_endocrino=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_endocrino" value="NO" <?php echo ($ant_pato_endocrino=='NO')?'checked':'' ?> ></td>	
<td><strong>Vasculares</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_vascular" value="SI" <?php echo ($ant_pato_vascular=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_vascular" value="NO" <?php echo ($ant_pato_vascular=='NO')?'checked':'' ?> ></td>	
<td><strong>Autoinmunes</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_auntoinmun" value="SI" <?php echo ($ant_pato_auntoinmun=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_auntoinmun" value="NO" <?php echo ($ant_pato_auntoinmun=='NO')?'checked':'' ?> ></td>	
<td><strong>Otros</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_pato_otro" value="SI" <?php echo ($ant_pato_otro=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_pato_otro" value="NO" <?php echo ($ant_pato_otro=='NO')?'checked':'' ?> ></td>	
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_pato_descripcion" type="text" value="<?php echo $ant_pato_descripcion ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.3 Antecedentes para Alturas</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td bgcolor="#B6DDE8"><strong>Presenta Antecedentes para Alturas&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_altu_no" value="NO" <?php echo ($ant_altu_no=='NO')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;NA<input type="radio" name="ant_altu_no" value="NA" <?php echo ($ant_altu_no=='NA')?'checked':'' ?> ></strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
<td><strong>Epilepsia</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_epilep" value="SI" <?php echo ($ant_altu_epilep=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_epilep" value="NO" <?php echo ($ant_altu_epilep=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_epilep" value="NA" <?php echo ($ant_altu_epilep=='NA')?'checked':'' ?> ></td>
<td><strong>Otitis media</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_otitmed" value="SI" <?php echo ($ant_altu_otitmed=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_otitmed" value="NO" <?php echo ($ant_altu_otitmed=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_otitmed" value="NA" <?php echo ($ant_altu_otitmed=='NA')?'checked':'' ?> ></td>
<td><strong>Enfermedad de maniere</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_enfmanier" value="SI" <?php echo ($ant_altu_enfmanier=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_enfmanier" value="NO" <?php echo ($ant_altu_enfmanier=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_enfmanier" value="NA" <?php echo ($ant_altu_enfmanier=='NA')?'checked':'' ?> ></td>
<td><strong>Traumas craneales</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_traumcran" value="SI" <?php echo ($ant_altu_traumcran=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_traumcran" value="NO" <?php echo ($ant_altu_traumcran=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_traumcran" value="NA" <?php echo ($ant_altu_traumcran=='NA')?'checked':'' ?> ></td>
        </tr>
        <tr>
<td><strong>Tumores cerebrales</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_tumcereb" value="SI" <?php echo ($ant_altu_tumcereb=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_tumcereb" value="NO" <?php echo ($ant_altu_tumcereb=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_tumcereb" value="NA" <?php echo ($ant_altu_tumcereb=='NA')?'checked':'' ?> ></td>
<td><strong>Malformaciones cerebrales</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_malfocereb" value="SI" <?php echo ($ant_altu_malfocereb=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_malfocereb" value="NO" <?php echo ($ant_altu_malfocereb=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_malfocereb" value="NA" <?php echo ($ant_altu_malfocereb=='NA')?'checked':'' ?> ></td>
<td><strong>Trombosis (ACV)</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_trombo" value="SI" <?php echo ($ant_altu_trombo=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_trombo" value="NO" <?php echo ($ant_altu_trombo=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_trombo" value="NA" <?php echo ($ant_altu_trombo=='NA')?'checked':'' ?> ></td>
<td><strong>Hipoacusia</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_hipoac" value="SI" <?php echo ($ant_altu_hipoac=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_hipoac" value="NO" <?php echo ($ant_altu_hipoac=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_hipoac" value="NA" <?php echo ($ant_altu_hipoac=='NA')?'checked':'' ?> ></td>
        </tr>
        <tr>
<td><strong>Arritmia cardíaca</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_arritcardi" value="SI" <?php echo ($ant_altu_arritcardi=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_arritcardi" value="NO" <?php echo ($ant_altu_arritcardi=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_arritcardi" value="NA" <?php echo ($ant_altu_arritcardi=='NA')?'checked':'' ?> ></td>
<td><strong>Hipoglicemias</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_hipogli" value="SI" <?php echo ($ant_altu_hipogli=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_hipogli" value="NO" <?php echo ($ant_altu_hipogli=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_hipogli" value="NA" <?php echo ($ant_altu_hipogli=='NA')?'checked':'' ?> ></td>
<td><strong>Fobias</strong></td>
<td style="text-align:center">SI<input type="radio" name="ant_altu_fobia" value="SI" <?php echo ($ant_altu_fobia=='SI')?'checked':'' ?> ></td>
<td style="text-align:center">NO<input type="radio" name="ant_altu_fobia" value="NO" <?php echo ($ant_altu_fobia=='NO')?'checked':'' ?> ></td>
<td style="text-align:center">NA<input type="radio" name="ant_altu_fobia" value="NA" <?php echo ($ant_altu_fobia=='NA')?'checked':'' ?> ></td>
        </tr>
            </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_altu_observ" type="text" value="<?php echo $ant_altu_observ ?>"/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.4 Antecedentes Traumáticos &nbsp;&nbsp;&nbsp;
SI<input type="radio" name="ant_trau" value="SI" <?php echo ($ant_trau=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_trau" value="NO" <?php echo ($ant_trau=='NO')?'checked':'' ?> ></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Enfermedad</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
            <td style="text-align:center"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_enfer1" type="text" value="<?php echo $ant_trau_enfer1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_observ1" type="text" value="<?php echo $ant_trau_observ1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_fech_aprox1" type="text" value="<?php echo $ant_trau_fech_aprox1 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_enfer2" type="text" value="<?php echo $ant_trau_enfer2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_observ2" type="text" value="<?php echo $ant_trau_observ2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_fech_aprox2" type="text" value="<?php echo $ant_trau_fech_aprox2 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_enfer3" type="text" value="<?php echo $ant_trau_enfer3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_observ3" type="text" value="<?php echo $ant_trau_observ3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_trau_fech_aprox3" type="text" value="<?php echo $ant_trau_fech_aprox3 ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.5 Antecedentes Quirúrgicos&nbsp;&nbsp;&nbsp;
SI<input type="radio" name="ant_quirur" value="SI" <?php echo ($ant_quirur=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
NO<input type="radio" name="ant_quirur" value="NO" <?php echo ($ant_quirur=='NO')?'checked':'' ?> ></strong></td></tr></tbody>
</table>

<table align="center" border="1" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Enfermedad</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
            <td style="text-align:center"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_enfer1" type="text" value="<?php echo $ant_quirur_enfer1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_observ1" type="text" value="<?php echo $ant_quirur_observ1 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_fech_aprox1" type="text" value="<?php echo $ant_quirur_fech_aprox1 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_enfer2" type="text" value="<?php echo $ant_quirur_enfer2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_observ2" type="text" value="<?php echo $ant_quirur_observ2 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_fech_aprox2" type="text" value="<?php echo $ant_quirur_fech_aprox2 ?>"/></td>
        </tr>
        <tr>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_enfer3" type="text" value="<?php echo $ant_quirur_enfer3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_observ3" type="text" value="<?php echo $ant_quirur_observ3 ?>"/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_quirur_fech_aprox3" type="text" value="<?php echo $ant_quirur_fech_aprox3 ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.6 Antecedentes - Inmunizaciones (Presenta Vacunas:&nbsp;&nbsp;&nbsp; SI<input type="radio" name="ant_inmuni" value="SI" required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_inmuni" value="NO">)</strong></td></tr></tbody>
</table>
<table align="center" border="1" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Vacuna</strong></td>
            <td></td>
            <td></td>
            <td><strong>Año Aplicación</strong></td>
            <td><strong>Vacuna</strong></td>
            <td></td>
            <td></td>
            <td><strong>Año Aplicación</strong></td>
        </tr>
        <tr>
            <td><strong>TETANO</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_tetano" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_tetano" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_tetano_anyo" type="number" value=""/></td>
            <td><strong>FIEBRE TIFOIDEA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_fiebtifo" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_fiebtifo" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_fiebtifo_anyo" type="number" value=""/></td>
        </tr>
        <tr>
            <td><strong>HEPATITIS A </strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_hepatita" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_hepatita" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_hepatita_anyo" type="number" value=""/></td>
            <td><strong>INFLUENZA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_influenza" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_influenza" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_influenza_anyo" type="number" value=""/></td>
        </tr>
        <tr>
            <td><strong>HEPATITIS B </strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_hepatitb" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_hepatitb" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_hepatitb_anyo" type="number" value=""/></td>
            <td><strong>SARAMPION</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_saramp" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_saramp" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_saramp_anyo" type="number" value=""/></td>
        </tr>
        <tr>
            <td><strong>FIEBRE AMARILLA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_fiebamarill" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_fiebamarill" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_fiebamarill_anyo" type="number" value=""/></td>
            <td><strong>OTRA</strong></td>
            <td style="text-align:center">SI<input type="radio" name="ant_inmuni_otra" value="SI"></td>
            <td style="text-align:center">NO<input type="radio" name="ant_inmuni_otra" value="NO"></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_inmuni_otra_anyo" type="number" value=""/></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_inmuni_observacion" type="text" value=""/></td></tr></tbody>
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
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_prim_mestrua" type="text" value=""/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_anyos" type="number" value=""/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_cliclo" type="text" value=""/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fum" type="text" value=""/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fup" type="text" value=""/></td>
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fuc" type="text" value=""/></td>
            <td style="text-align:center"><strong>G<input class="input-block-level" name="ant_gine_fich_gine_g" type="number" value=""/></strong></td>
            <td style="text-align:center"><strong>P<input class="input-block-level" name="ant_gine_fich_gine_p" type="number" value=""/></strong></td>
            <td style="text-align:center"><strong>A<input class="input-block-level" name="ant_gine_fich_gine_a" type="number" value=""/></strong></td>
            <td style="text-align:center"><strong>C<input class="input-block-level" name="ant_gine_fich_gine_c" type="number" value=""/></strong></td>
            <td style="text-align:center"><strong>M<input class="input-block-level" name="ant_gine_fich_gine_m" type="number" value=""/></strong></td>
            <td style="text-align:center"><strong>E<input class="input-block-level" name="ant_gine_fich_gine_e" type="number" value=""/></strong></td>
            <td style="text-align:center"><strong>V<input class="input-block-level" name="ant_gine_fich_gine_v" type="number" value=""/></strong></td>
            
            <td><input style="text-align:center" class="input-block-level" name="ant_gine_fech_ult_exa_mama" type="text" value=""/></td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Planificaciones: </strong><input class="input-block-level" name="ant_gine_planifica" type="text" value=""/></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong><input class="input-block-level" name="ant_gine_observacion" type="text" value=""/></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr><td colspan="14" bgcolor="#FAC090"><strong>3.8 Hábitos Personales </strong></td></tr>
<tr>
<td style="text-align:center" colspan="8"><strong>Tabaquismo:&nbsp;Fuma<input type="radio" name="habit_tox_fum_nofum_exfum" value="Fuma" required>&nbsp;No Fuma<input type="radio" name="habit_tox_fum_nofum_exfum" value="No Fuma">&nbsp;Exfumador<input type="radio" name="habit_tox_fum_nofum_exfum" value="Exfumador"></strong></td>
<td style="text-align:center" colspan="1"><strong>No. Cigarrillos al día:</strong><input style="text-align:center" class="input-block-level" name="habit_tox_ciga_aldia" type="number" value=""/></td>
<td style="text-align:center" colspan="1"><strong>Total Años fumando: </strong><input style="text-align:center" class="input-block-level" name="habit_tox_anyos_fum" type="number" value=""/></td>
<td style="text-align:center" colspan="1"><strong>Tiempo sin fumar:</strong><input style="text-align:center" class="input-block-level" name="habit_tox_tiem_sinfum" type="text" value=""/></td>
</tr>
<tr>
<td style="text-align:center" colspan="8"><strong>Consumo de Alcohol:&nbsp;SI<input type="radio" name="habit_tox_consum_alcoh" value="SI" required>&nbsp;NO<input type="radio" name="habit_tox_consum_alcoh" value="NO"></strong></td>
<td style="text-align:center" colspan="3"><strong>Actividad Extralaboral:</strong><input style="text-align:center" class="input-block-level" name="habit_tox_activ_extralab" type="text" value=""/></td>
</tr>
<tr>
<td style="text-align:center" colspan="8"><strong>Actividad física:&nbsp;Sedentario<input type="radio" name="habit_tox_activfis" value="Sedentario" required>&nbsp;Físicamente activo<input type="radio" name="habit_tox_activfis" value="Fisicamente activo"></strong></td>
<td style="text-align:center" colspan="1"><strong>Actividad: </strong><input style="text-align:center" class="input-block-level" name="habit_tox_actividad" type="text" value=""/></td>
<td style="text-align:center" colspan="1"><strong>Frecuencia: </strong><input style="text-align:center" class="input-block-level" name="habit_tox_frecuenc" type="text" value=""/></td>
<td style="text-align:center" colspan="1"><strong>Tiempo: </strong><input style="text-align:center" class="input-block-level" name="habit_tox_tiempo" type="text" value=""/></td>
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
        <tr><td bgcolor="#B6DDE8"><strong>No Refiere&nbsp;&nbsp;&nbsp;<input name="rev_sist_no" type="checkbox" value="NO" /></strong></td></tr>
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
            <td style="text-align:center">SI<input type="radio" name="rev_sist_orgsentido" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_orgsentido" value="NO"></td>
            <td><input class="input-block-level" name="rev_sist_observ_orgsentido" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Neurológicos</strong></td>
            <td style="text-align:center">SI<input type="radio" name="rev_sist_neurolog" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_neurolog" value="NO"></td>
 
            <td><input class="input-block-level" name="rev_sist_observ_neurolog" type="text" value=""/></td>

        </tr>
        <tr>
            <td><strong>Respiratorios</strong></td>
         <td style="text-align:center">SI<input type="radio" name="rev_sist_resp" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_resp" value="NO"></td>
  
            <td><input class="input-block-level" name="rev_sist_observ_resp" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Gastrointestinales</strong></td>
         <td style="text-align:center">SI<input type="radio" name="rev_sist_gastrointes" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_gastrointes" value="NO"></td>
      
            <td><input class="input-block-level" name="rev_sist_observ_gastrointes" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Genitourinarios</strong></td>
       <td style="text-align:center">SI<input type="radio" name="rev_sist_geniuri" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_geniuri" value="NO"></td>
    
            <td><input class="input-block-level" name="rev_sist_observ_geniuri" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Osteomuscular</strong></td>
<td style="text-align:center">SI<input type="radio" name="rev_sist_osteomus" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_osteomus" value="NO"></td>

            <td><input class="input-block-level" name="rev_sist_observ_osteomus" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Dermatológicos</strong></td>
			 <td style="text-align:center">SI<input type="radio" name="rev_sist_dermato" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_dermato" value="NO"></td>
      
            <td><input class="input-block-level" name="rev_sist_observ_dermato" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Cardiovasculares</strong></td>
       		 <td style="text-align:center">SI<input type="radio" name="rev_sist_cardiovas" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_cardiovas" value="NO"></td>
  
            <td><input class="input-block-level" name="rev_sist_observ_cardiovas" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Constitucionales</strong></td>
      		<td style="text-align:center">SI<input type="radio" name="rev_sist_constitu" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_constitu" value="NO"></td>

            <td><input class="input-block-level" name="rev_sist_observ_constitu" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>Metabolico y Endocrino</strong></td>
  			 <td style="text-align:center">SI<input type="radio" name="rev_sist_metabolendocri" value="SI">&nbsp;&nbsp;&nbsp; NO<input type="radio" name="rev_sist_metabolendocri" value="NO"></td>
  
            <td><input class="input-block-level" name="rev_sist_observ_metabolendocri" type="text" value=""/></td>
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
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_orient" type="text" value="NORMAL"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_orient" type="text" value=""/></td>
            <td><input class="input-block-level" name="eval_estment_halla_orient" type="text" value=""/></td>
        </tr>
        <tr>
            <td>
            <strong>ATENCIÓN CONCENTRACIÓN</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_atenconcent" type="text" value="NORMAL"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_atenconcent" type="text" value=""/></td>
            <td><input class="input-block-level" name="eval_estment_halla_atenconcent" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>SENSOPERCEPCIÓN</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_sensoper" type="text" value="NORMAL"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_sensoper" type="text" value=""/></td>
            <td><input class="input-block-level" name="eval_estment_halla_sensoper" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>MEMORIA</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_memor" type="text" value="NORMAL"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_memor" type="text" value=""/></td>
            <td><input class="input-block-level" name="eval_estment_halla_memor" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>PENSAMIENTO</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_pensami" type="text" value="NORMAL"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_pensami" type="text" value=""/></td>
            <td><input class="input-block-level" name="eval_estment_halla_pensami" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>LENGUAJE</strong></td>
            <td><input style="text-align:center" class="input-block-level" name="eval_estment_norm_lenguaj" type="text" value="NORMAL"/></td>
            <td><input class="input-block-level" name="eval_estment_disf_lenguaj" type="text" value=""/></td>
            <td><input class="input-block-level" name="eval_estment_halla_lenguaj" type="text" value=""/></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
            <td><strong>CONCEPTO:&nbsp;&nbsp;&nbsp;NORMAL<input type="radio" name="eval_estment_concept" value="NORMAL" required>&nbsp;ANORMAL<input type="radio" name="eval_estment_concept" value="ANORMAL"></strong></td>
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
<td style="text-align:center"><strong>&nbsp;Talla: (Mts)<input style="text-align:center" class="form-control input-sm" id="exa_fis_talla" name="exa_fis_talla" type="text" value="" onChange="calc_imc();" required/></strong></td>
<td style="text-align:center"><strong>PESO: (Kg)<input style="text-align:center" class="form-control input-sm" id="exa_fis_peso" name="exa_fis_peso" type="text" value="" onChange="calc_imc();" required/></strong></td>
<td style="text-align:center"><strong>IMC:<input style="text-align:center" class="form-control input-sm" id="exa_fis_imc" name="exa_fis_imc" type="text" value=""/></strong></td>
<td style="text-align:center"><strong>INTERPRETACIÓN IMC:<div style="text-align:center" id="img_imc"></div><input style="text-align:center" class="form-control input-sm" id="exa_fis_interpreimc" name="exa_fis_interpreimc" type="text" value=""/></strong></td>
<td style="text-align:center"><strong>F. Resp: (/Min)<input style="text-align:center" class="form-control input-sm" name="exa_fis_fresp" type="text" value="" required/></strong></td>

<script>
function calc_imc(){
exa_fis_talla = document.getElementById("exa_fis_talla").value;
exa_fis_peso = document.getElementById("exa_fis_peso").value;
exa_fis_imc = (exa_fis_peso / Math.pow(exa_fis_talla, 2)).toFixed(2);
exa_fis_interpreimc = "";
img_imc = "";

if ((exa_fis_imc  < 18.50)) { exa_fis_interpreimc = "BAJO PESO"; img_imc = '<img src="../imagenes/imc/peso1.png">'; }
if ((exa_fis_imc  >= 18.50) && (exa_fis_imc  <= 24.99)) { exa_fis_interpreimc = "PESO NORMAL"; img_imc = '<img src="../imagenes/imc/peso2.png">'; }
if ((exa_fis_imc  >= 25.0) && (exa_fis_imc  <= 29.99)) { exa_fis_interpreimc = "SOBREPESO"; img_imc = '<img src="../imagenes/imc/peso3.png">'; }
if ((exa_fis_imc  >= 30.0) && (exa_fis_imc  <= 34.99)) { exa_fis_interpreimc = "OBESIDAD I"; img_imc = '<img src="../imagenes/imc/peso4.png">'; }
if ((exa_fis_imc  >= 35.0) && (exa_fis_imc  <= 39.99)) { exa_fis_interpreimc = "OBESIDAD II"; img_imc = '<img src="../imagenes/imc/peso5.png">'; }
if ((exa_fis_imc  >= 40.0) && (exa_fis_imc  <= 49.99)) { exa_fis_interpreimc = "OBESIDAD III"; img_imc = '<img src="../imagenes/imc/peso6.png">'; }
if ((exa_fis_imc  >= 50.0)) { exa_fis_interpreimc = "OBESIDAD EXTREMA"; img_imc = '<img src="../imagenes/imc/peso7.png">'; }

document.getElementById("exa_fis_imc").value = exa_fis_imc;
document.getElementById("exa_fis_interpreimc").value = exa_fis_interpreimc;
document.getElementById("img_imc").innerHTML=img_imc;
}
</script>
</tr>
<tr>
<td style="text-align:center"><strong>TA: (Mm/Hg)<input style="text-align:center" class="form-control input-sm" name="exa_fis_ta" type="text" value="" required/></strong></td>
<td style="text-align:center"><strong>FC: (/Min)<input style="text-align:center" class="form-control input-sm" name="exa_fis_fc" type="text" value="" required/></strong></td>
<td style="text-align:center"><strong>Lateralidad&nbsp;&nbsp;&nbsp;&nbsp;D<input type="radio" name="exa_fis_lateral" value="D" required>&nbsp;&nbsp;&nbsp;&nbsp;
I<input type="radio" name="exa_fis_lateral" value="I">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exa_fis_lateral" value="AM"></strong></td>
<td style="text-align:center"><strong>Perímetro Abdominal: (Cm)<input style="text-align:center" class="form-control input-sm" name="exa_fis_periabdom" type="number" value=""/></strong></td>
<td style="text-align:center"><strong>Temperatura:&nbsp;&nbsp;&nbsp;&nbsp;Febril<input type="radio" name="exa_fis_temperat" value="Febril" required>&nbsp;&nbsp;&nbsp;&nbsp;
Afebril<input type="radio" name="exa_fis_temperat" value="Afebril"></strong></td>
</tr>
</tbody>
</table>

<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EXAMEN FÍSICO <input type="radio" name="exa_fis" value="N" required/> N(Normal) &ndash; 
    	<input type="radio" name="exa_fis" value="A" /> A(Anormal) &ndash; 
    	<input type="radio" name="exa_fis" value="NE" /> NE(No examinado)</strong></td></tr></tbody>

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
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vlejan" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vcerca" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vlejan" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vcerca" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vlejan" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vcerca" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vlejan" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vcerca" type="text" value=""/></td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vlejan" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vcerca" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_oojoamb_cncorre_vlejan" type="text" value=""/></td>
            <td><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_cncorre_vcerca" type="text" value=""/></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td><strong>OJOS</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_ojo" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_ojo" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_ojo_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_ojo" value="NE"></strong></td>
</tr>
<tr>
<td><strong>OIDOS</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_oido" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_oido" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_oido_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_oido" value="NE"></strong></td>
</tr>
<tr>
<td><strong>CABEZA</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_cabeza" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_cabeza" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_cabeza_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_cabeza" value="NE"></strong></td>
</tr>
<tr>
<td><strong>NARIZ</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_nariz" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_nariz" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_nariz_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_nariz" value="NE"></strong></td>
</tr>
<tr>
<td><strong>OROFARINGE</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_orofaring" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_orofaring" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_orofaring_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_orofaring" value="NE"></strong></td>
</tr>
<tr>
<td><strong>CUELLO</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_cuello" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_cuello" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_cuello_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_cuello" value="NE"></strong></td>
</tr>
<tr>
<td><strong>TÓRAX</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_torax" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_torax" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_torax_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_torax" value="NE"></strong></td>
</tr>
<tr>
<td bgcolor="#95B3D7"><strong>GLÁNDULAS MAMARIAS</strong></td>
<td style="text-align:center" bgcolor="#95B3D7"><strong>
N<input type="radio" name="exa_fis_glandumama" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_glandumama" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_glandumama_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_glandumama" value="NE"></strong></td>
</tr>
<tr>
<td><strong>CARDIOPULMONAR</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_cardiopulm" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_cardiopulm" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_cardiopulm_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_cardiopulm" value="NE"></strong></td>
</tr>
<tr>
<td><strong>ABDOMEN</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_abdomen" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_abdomen" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_abdomen_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_abdomen" value="NE"></strong></td>
</tr>
<tr>
<td bgcolor="#95B3D7"><strong>GENITALES</strong></td>
<td style="text-align:center" bgcolor="#95B3D7"><strong>
N<input type="radio" name="exa_fis_genital" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_genital" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_genital_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_genital" value="NE"></strong></td>
</tr>
<tr>
<td><strong>MIEMBROS SUPERIORES</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_miemsup" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_miemsup" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_miemsup_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_miemsup" value="NE"></strong></td>
</tr>
<tr>
<td><strong>MIEMBROS INFERIORES</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_mieminf" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_mieminf" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_mieminf_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_mieminf" value="NE"></strong></td>
</tr>
<tr>
<td><strong>COLUMNA</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_columna" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_columna" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_columna_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_columna" value="NE"></strong></td>
</tr>
<tr>
<td bgcolor="#95B3D7"><strong>NEUROLÓGICO</strong><strong> (PRUEBAS DE EQUILIBRIO)</strong>
<div><strong>Equilibrio Estático&nbsp;&nbsp;
[Prueba de Romberg&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_romberg" value="Pos">&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_romberg" value="Neg">&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_romberg" value="NA">)]
[Prueba de Barany&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_barany" value="Pos">&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_barany" value="Neg">&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_barany" value="NA">)]
<br>[Maniobra de Dix Halpike&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_dixhalp" value="Pos">&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_dixhalp" value="Neg">&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_dixhalp" value="NA">)]

<br><strong>Equilibrio Dinamico</strong>&nbsp;&nbsp;
[Marcha a Ciegas&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_mciega" value="Pos">&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_mciega" value="Neg">&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_mciega" value="NA">)]
[Pisoteo a Ciegas&nbsp;&nbsp;&nbsp;(Pos<input type="radio" name="exa_fis_neurolog_pciega" value="Pos">&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exa_fis_neurolog_pciega" value="Neg">&nbsp;&nbsp;&nbsp;NA<input type="radio" name="exa_fis_neurolog_pciega" value="NA">)]
</strong>
</div>
</td>
<td style="text-align:center" bgcolor="#95B3D7"><strong>
N<input type="radio" name="exa_fis_neurolog" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_neurolog" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_neurolog_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_neurolog" value="NE"></strong></td>
</tr>
<tr>
<td><strong>ESTADO MENTAL APARENTE</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_estmentaparent" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_estmentaparent" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_estmentaparent_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_estmentaparent" value="NE"></strong></td>
</tr>
<tr>
<td><strong>PIEL Y FANERAS</strong></td>
<td style="text-align:center"><strong>
N<input type="radio" name="exa_fis_pielfanera" value="N" />&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="exa_fis_pielfanera" value="A">&nbsp;&nbsp;&nbsp;&nbsp;
<input class="form-control input-sm" name="exa_fis_pielfanera_obser" type="text" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
NE<input type="radio" name="exa_fis_pielfanera" value="NE"></strong></td>
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
<td style="text-align:center" colspan="2"><strong>Normal<input type="radio" name="exaosteo_homb_movart" value="Normal" required>&nbsp;&nbsp;&nbsp;&nbsp;Anormal<input type="radio" name="exaosteo_homb_movart" value="Anormal"></strong></td>
<td style="text-align:center" colspan="3"><strong>Normal<input type="radio" name="exaosteo_homb_fuerza" value="Normal" required>&nbsp;&nbsp;&nbsp;&nbsp;Anormal<input type="radio" name="exaosteo_homb_fuerza" value="Anormal"></strong></td>
</tr>
<tr>
<td><strong>Maniobra Jobe</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_manjobe_sig" value="Pos" required>&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_manjobe_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_manjobe_lat" value="Der" required>&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_manjobe_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_manjobe_lat" value="AM"></strong></td>
<td><strong>MMII</strong></td>
<td style="text-align:center" colspan="2"><strong>Normal<input type="radio" name="exaosteo_manjobe_movart" value="Normal" required>&nbsp;&nbsp;&nbsp;&nbsp;Anormal<input type="radio" name="exaosteo_manjobe_movart" value="Anormal"></strong></td>
<td style="text-align:center" colspan="3"><strong>Normal<input type="radio" name="exaosteo_manjobe_fuerza" value="Normal" required>&nbsp;&nbsp;&nbsp;&nbsp;Anormal<input type="radio" name="exaosteo_manjobe_fuerza" value="Anormal"></strong></td>
</tr>
<tr>
<td><strong>Maniobra de Yergason</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_manyega_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_manyega_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_manyega_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_manyega_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_manyega_lat" value="AM"></strong></td>
<td><strong>Columna</strong></td>
<td style="text-align:center" colspan="2"><strong>Normal<input type="radio" name="exaosteo_manyega_movart" value="Normal" required>&nbsp;&nbsp;&nbsp;&nbsp;Anormal<input type="radio" name="exaosteo_manyega_movart" value="Anormal"></strong></td>
<td style="text-align:center" colspan="3"><strong>Normal<input type="radio" name="exaosteo_manyega_fuerza" value="Normal" required>&nbsp;&nbsp;&nbsp;&nbsp;Anormal<input type="radio" name="exaosteo_manyega_fuerza" value="Anormal"></strong></td>
</tr>
<tr>
<td><strong>Maniobra de Patte</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_manpatte_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_manpatte_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_manpatte_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_manpatte_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_manpatte_lat" value="AM"></strong></td>
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
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_epicond_sig" value="Pos" required>&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_epicond_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_epicond_lat" value="Der" required>&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_epicond_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_epicond_lat" value="AM"></strong></td>
<td colspan="2"><strong>Phalen</strong></td>
<td style="text-align:center" colspan="2"><strong>Pos<input type="radio" name="exaosteo_phalen_sig" value="Pos" required>&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_phalen_sig" value="Neg"></strong></td>
<td style="text-align:center" colspan="2"><strong>Der<input type="radio" name="exaosteo_phalen_lat" value="Der" required>&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_phalen_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_phalen_lat" value="AM"></strong></td>
</tr>
<tr>
<td><strong>Prueba de Epitrocleitis</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_epitro_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_epitro_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_epitro_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_epitro_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_epitro_lat" value="AM"></strong></td>
<td colspan="2"><strong>Finkelstein</strong></td>
<td style="text-align:center" colspan="2"><strong>Pos<input type="radio" name="exaosteo_finkel_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_finkel_sig" value="Neg"></strong></td>
<td style="text-align:center" colspan="2"><strong>Der<input type="radio" name="exaosteo_finkel_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_finkel_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_finkel_lat" value="AM"></strong></td>
</tr>
<tr>
<td><strong>Prueba de Thompson</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_thomp_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_thomp_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_thomp_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_thomp_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_thomp_lat" value="AM"></strong></td>
<td colspan="2"><strong>Tinel</strong></td>
<td style="text-align:center" colspan="2"><strong>Pos<input type="radio" name="exaosteo_tinel_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_tinel_sig" value="Neg"></strong></td>
<td style="text-align:center" colspan="2"><strong>Der<input type="radio" name="exaosteo_tinel_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_tinel_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_tinel_lat" value="AM"></strong></td>
</tr>
<tr>
<td colspan="3"><strong>Lumbar</strong></td>
<td colspan="6"><strong>Miembro Inferior</strong></td>
</tr>
<tr>
<td><strong>Signo de Lasegue</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_laseg_sig" value="Pos" required>&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_laseg_sig" value="Neg"></strong></td>
<td>&nbsp;</td>
<td colspan="2"><strong>Signo del Cajón</strong></td>
<td style="text-align:center" colspan="2"><strong>Pos<input type="radio" name="exaosteo_cajon_sig" value="Pos" required>&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_cajon_sig" value="Neg"></strong></td>
<td style="text-align:center" colspan="2"><strong>Der<input type="radio" name="exaosteo_cajon_lat" value="Der" required>&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_cajon_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_cajon_lat" value="AM"></strong></td>
</tr>
<tr>
<td><strong>Signo de Schober Flexión</strong></td>
<td><input style="text-align:center" class="input-block-level" name="exaosteo_flexion" type="text" value=""/></td>
<td><strong>Cm</strong></td>
<td colspan="2"><strong>Signo del Bostezo</strong></td>
<td style="text-align:center" colspan="2"><strong>Pos<input type="radio" name="exaosteo_bostezo_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_bostezo_sig" value="Neg"></strong></td>
<td style="text-align:center" colspan="2"><strong>Der<input type="radio" name="exaosteo_bostezo_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_bostezo_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_bostezo_lat" value="AM"></strong></td>
</tr>
<tr>
<td><strong>Signo de Schober </strong> <strong>Extensión</strong></td>
<td><input style="text-align:center" class="input-block-level" name="exaosteo_extension" type="text" value=""/></td>
<td><strong>Grados</strong></td>
<td colspan="2"><strong>Mc Murray</strong></td>
<td style="text-align:center" colspan="2"><strong>Pos<input type="radio" name="exaosteo_mcmurray_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_mcmurray_sig" value="Neg"></strong></td>
<td style="text-align:center" colspan="2"><strong>Der<input type="radio" name="exaosteo_mcmurray_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_mcmurray_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_mcmurray_lat" value="AM"></strong></td>
</tr>
<tr>
<td><strong>Signo de Bragard</strong></td>
<td style="text-align:center"><strong>Pos<input type="radio" name="exaosteo_bragard_sig" value="Pos" >&nbsp;&nbsp;&nbsp;&nbsp;Neg<input type="radio" name="exaosteo_bragard_sig" value="Neg"></strong></td>
<td style="text-align:center"><strong>Der<input type="radio" name="exaosteo_bragard_lat" value="Der" >&nbsp;&nbsp;&nbsp;&nbsp;Izq<input type="radio" name="exaosteo_bragard_lat" value="Izq">&nbsp;&nbsp;&nbsp;&nbsp;AM<input type="radio" name="exaosteo_bragard_lat" value="AM"></strong></td>
</tr>
<tr>
<td colspan="3"><strong>Cadera</strong></td>
<td colspan="6"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>Trendelemburg</strong></td>
<td style="text-align:center"><strong>Positivo<input type="radio" name="exaosteo_tredelen" value="Positivo" required>&nbsp;&nbsp;&nbsp;&nbsp;Negativo<input type="radio" name="exaosteo_tredelen" value="Negativo"></strong></td>
<td></td>
<td colspan="6"></td>
</tr>
<tr><td colspan="9"><strong>Valoración de la Marcha</strong><input class="input-block-level" name="exaosteo_valmarcha" type="text" value=""/></td></tr>
<tr><td colspan="9"><strong>Observaciones Generales:</strong><input class="input-block-level" name="exaosteo_observ" type="text" value=""/></td></tr>
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
<td style="text-align:center"><strong>N<input type="radio" name="paracli_audimet" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_audimet" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_audimet" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_audimet_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Visiometría / Optometría</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_visiomet" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_visiomet" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_visiomet" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_visiomet_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Rx de Tórax </strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_torax" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_torax" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_torax" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_torax_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Espirometría</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_espiro" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_espiro" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_espiro" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_espiro_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>EKG</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_ekg" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_ekg" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_ekg" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_ekg_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Rx de Columna</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_rxcolum" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_rxcolum" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_rxcolum" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_rxcolum_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Otras pruebas complementarias</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_otrcomplement" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_otrcomplement" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_otrcomplement" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_otrcomplement_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Examen por Fisioterapia</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_fisiote" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_fisiote" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_fisiote" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_fisiote_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Laboratorios</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_lab" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_lab" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_lab" value="NR"></strong></td>
<td><input class="input-block-level" name="paracli_lab_observ" type="text" value=""/></td>
</tr>
<tr>
<td><strong>Otros</strong></td>
<td style="text-align:center"><strong>N<input type="radio" name="paracli_otro" value="N">&nbsp;&nbsp;&nbsp;&nbsp;
A<input type="radio" name="paracli_otro" value="A">&nbsp;&nbsp;&nbsp;&nbsp;NR<input type="radio" name="paracli_otro" value="NR"></strong></td>
<td><strong>Cuales:</strong><input class="input-block-level" name="paracli_otro_observ" type="text" value=""/></td>
</tr>
</tbody>
</table>

<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>CIE 10</strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody><tr><td><select name="cod_cie10[]" data-placeholder="Listado Cie - 10" class="chosen-select" multiple tabindex="4">
<?php $consulta2_sql = "SELECT cod_cie10, codigo_cie10, descripcion_cie10 FROM tbl15_cie10 WHERE cod_estado_cie10 = '1' ORDER BY codigo_cie10 ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_cie10 = $datos2['cod_cie10'];
$codigo_cie10 = $datos2['codigo_cie10'];
$descripcion_cie10 = $datos2['descripcion_cie10'];
?>
<option value="<?php echo $cod_cie10 ?>"><?php echo $codigo_cie10.' - '.$descripcion_cie10 ?></option>
<?php } ?>
</select></td></tr></tbody>
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
    		<td><textarea rows="5" name="control_examen" class="input-block-level"></textarea></td>
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

<script src="js/funcion_select_dependiente_area_cargo_ajax.js"></script>

<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<!--
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
-->
<!-- 1****************************************************************************************************** -->
</body>
</html>