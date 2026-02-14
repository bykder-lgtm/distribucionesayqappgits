<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$cod_trabajo_altura         = intval($_GET['cod_trabajo_altura']);
$cod_cliente                = intval($_GET['cod_cliente']);
$cod_historia_clinica       = intval($_GET['cod_historia_clinica']);
$fecha_hoy                  = time();

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                            = $info_empresa_data['titulo'];
$nombre_emp                            = $info_empresa_data['nombre'];
$eslogan_emp                           = $info_empresa_data['eslogan'];
$direccion_emp                         = $info_empresa_data['direccion'];
$ciudad_emp                            = $info_empresa_data['ciudad'];
$pais_emp                              = $info_empresa_data['pais'];
$correo_emp                            = $info_empresa_data['correo'];
$img_cabecera_emp                      = $info_empresa_data['img_cabecera'];
$telefono_emp                          = $info_empresa_data['telefono'];
$info_legal_emp                        = $info_empresa_data['info_legal'];
$logotipo_emp                          = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp     = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                   = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                       = $info_empresa_data['nit_empresa'];
$cabecera_emp                          = $info_empresa_data['cabecera'];
$icono_emp                             = $info_empresa_data['icono'];
$desarrollador_emp                     = $info_empresa_data['desarrollador'];
$anyo_emp                              = $info_empresa_data['anyo'];
$url_pag                               = $info_empresa_data['url_pag'];
$nombre_font_emp                       = $info_empresa_data['nombre_font'];
$tamano_font_emp                       = $info_empresa_data['tamano_font'];
$tamano_font_hc_emp                    = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp                = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp              = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp            = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_remision_emp              = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp               = $info_empresa_data['tamano_font_factura'];
$res_emp                               = $info_empresa_data['res'];
$res1_emp                              = $info_empresa_data['res1'];
$res2_emp                              = $info_empresa_data['res2'];
$departamento_emp                      = $info_empresa_data['departamento'];
$localidad_emp                         = $info_empresa_data['localidad'];
$reg_medico_emp                        = $info_empresa_data['reg_medico'];
$regimen_emp                           = $info_empresa_data['regimen'];
$version_emp                           = $info_empresa_data['version'];
$propietario_url_firma_emp             = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                        = $info_empresa_data['fecha_time'];
$licencia_emp                          = $info_empresa_data['licencia'];
$info_histclinic_emp                   = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                   = $info_empresa_data['info_aptlaboral'];

$sql_historia_clinica = "SELECT tbl15_trabajo_altura.cod_historia_clinica, tbl15_trabajo_altura.cod_cliente, tbl15_trabajo_altura.cod_administrador, tbl15_trabajo_altura.motivo_trabajo_altura, 
tbl15_trabajo_altura.trab_ant_centro_trab, tbl15_trabajo_altura.trab_ant_tiempo, tbl15_trabajo_altura.trab_ant_puesto, tbl15_trabajo_altura.trab_ant_puesto, 
tbl15_trabajo_altura.trab_ant_descrip_tarea, tbl15_trabajo_altura.trab_ant_acci_lab_secue, tbl15_trabajo_altura.trab_ant_enf_prof_secue, 
tbl15_trabajo_altura.ant_fam_diabetes, tbl15_trabajo_altura.ant_fam_hipertension, tbl15_trabajo_altura.ant_fam_cardiacas, tbl15_trabajo_altura.ant_fam_asma, 
tbl15_trabajo_altura.ant_fam_convulsiones, tbl15_trabajo_altura.ant_fam_otros, tbl15_trabajo_altura.ant_fam_cuales, tbl15_trabajo_altura.ant_gine_menarquia, 
tbl15_trabajo_altura.ant_gine_fmu, tbl15_trabajo_altura.ant_gine_ritmo, tbl15_trabajo_altura.ant_gine_g, tbl15_trabajo_altura.ant_gine_p, tbl15_trabajo_altura.ant_gine_a, 
tbl15_trabajo_altura.ant_gine_c, tbl15_trabajo_altura.ant_gine_ivsa, tbl15_trabajo_altura.ant_gine_mpf, tbl15_trabajo_altura.ant_gine_fpp, tbl15_trabajo_altura.ant_gine_doc, 
tbl15_trabajo_altura.ant_gine_fecha, tbl15_trabajo_altura.ant_gine_resultado, tbl15_trabajo_altura.ant_gine_tratamiento, tbl15_trabajo_altura.ant_gine_cual, 
tbl15_trabajo_altura.ant_nopatolog_fuma, tbl15_trabajo_altura.ant_nopatolog_alcohol, tbl15_trabajo_altura.ant_nopatolog_toxicomanias, 
tbl15_trabajo_altura.ant_nopatolog_otros, tbl15_trabajo_altura.ant_nopatolog_cuanto, 
tbl15_trabajo_altura.ant_person_pato_convul, tbl15_trabajo_altura.ant_person_pato_dificulresp, 
tbl15_trabajo_altura.ant_person_pato_reacalerg, tbl15_trabajo_altura.ant_person_pato_problemcorazon, 
tbl15_trabajo_altura.ant_person_pato_claustofob, tbl15_trabajo_altura.ant_person_pato_presionalta, 
tbl15_trabajo_altura.ant_person_pato_dificuloler, tbl15_trabajo_altura.ant_person_pato_tomamedicam, 
tbl15_trabajo_altura.ant_person_pato_diabetes, tbl15_trabajo_altura.ant_person_pato_usalentes, 
tbl15_trabajo_altura.ant_person_pato_problempulmonar, tbl15_trabajo_altura.ant_person_pato_dificuldistinguircolor, 
tbl15_trabajo_altura.explo_fis_signovital, tbl15_trabajo_altura.explo_fis_fc, tbl15_trabajo_altura.explo_fis_fr, tbl15_trabajo_altura.explo_fis_ta, 
tbl15_trabajo_altura.explo_fis_antropometria, tbl15_trabajo_altura.explo_fis_peso, tbl15_trabajo_altura.explo_fis_talla, tbl15_trabajo_altura.explo_fis_imc, 
tbl15_trabajo_altura.explo_fis_perimuneca, tbl15_trabajo_altura.explo_fis_pericintura, tbl15_trabajo_altura.explo_fis_visionav, 
tbl15_trabajo_altura.explo_fis_od, tbl15_trabajo_altura.explo_fis_oi, tbl15_trabajo_altura.explo_fis_ishihara, tbl15_trabajo_altura.explo_fis_cabeza, 
tbl15_trabajo_altura.explo_fis_cuello, tbl15_trabajo_altura.explo_fis_cadiopulm, tbl15_trabajo_altura.explo_fis_digestivo, 
tbl15_trabajo_altura.explo_fis_sistemmuscesquelet, tbl15_trabajo_altura.explo_fis_pielanexos, tbl15_trabajo_altura.explo_fis_testromberg, 
tbl15_trabajo_altura.explo_fis_dixhalp, 
tbl15_trabajo_altura.explo_fis_priebmarcha, tbl15_trabajo_altura.explo_fis_recomenespeciftrab, tbl15_trabajo_altura.explo_fis_recomenespecifempre, 
tbl15_trabajo_altura.explo_fis_idx, 
tbl15_trabajo_altura.nombre_acepta_trab_altura, tbl15_trabajo_altura.fecha_mes, tbl15_trabajo_altura.fecha_anyo, tbl15_trabajo_altura.fecha_ymd, 
tbl15_trabajo_altura.fecha_dmy, tbl15_trabajo_altura.fecha_time, tbl15_trabajo_altura.fecha_reg_time, tbl15_trabajo_altura.cuenta, tbl15_trabajo_altura.cuenta_reg, 
tbl15_cliente.nombre_tipo_doc, tbl15_cliente.nombre_ocupacion, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, 
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, 
tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, tbl15_cliente.url_img_foto AS url_img_foto_cli, 
tbl15_cliente.nombres, tbl15_cliente.apellido1,
tbl15_trabajo_altura.exa_fis_ojoder_sncorre_vlejan, tbl15_trabajo_altura.exa_fis_ojoder_sncorre_vcerca, 
tbl15_trabajo_altura.exa_fis_ojoder_cncorre_vlejan, tbl15_trabajo_altura.exa_fis_ojoder_cncorre_vcerca, 
tbl15_trabajo_altura.exa_fis_ojoizq_sncorre_vlejan, tbl15_trabajo_altura.exa_fis_ojoizq_sncorre_vcerca, 
tbl15_trabajo_altura.exa_fis_ojoizq_cncorre_vlejan, tbl15_trabajo_altura.exa_fis_ojoizq_cncorre_vcerca, 
tbl15_trabajo_altura.exa_fis_ojoamb_sncorre_vlejan, tbl15_trabajo_altura.exa_fis_ojoamb_sncorre_vcerca, 
tbl15_trabajo_altura.exa_fis_oojoamb_cncorre_vlejan, tbl15_trabajo_altura.exa_fis_ojoamb_cncorre_vcerca, 
tbl15_historia_clinica.nombre_religion, tbl15_historia_clinica.nombre_ocupacion, tbl15_historia_clinica.nombre_estado_civil, 
tbl15_historia_clinica.nombre_escolaridad, tbl15_historia_clinica.nombre_tipo_regimen, tbl15_historia_clinica.nombre_fondo_pension, 
tbl15_historia_clinica.nombre_actividad_ecoemp, tbl15_historia_clinica.nombre_estrato, tbl15_historia_clinica.nombre_numero_hijos, 
tbl15_historia_clinica.nombre_arl, tbl15_trabajo_altura.nombre_empresa, tbl15_trabajo_altura.cargo_empresa, tbl15_trabajo_altura.area_empresa, 
tbl15_trabajo_altura.ciudad_empresa, tbl15_trabajo_altura.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente, 
tbl15_historia_clinica.correo, tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia, tbl15_historia_clinica.nombre_contacto1, 
tbl15_historia_clinica.tel_contacto1, tbl15_historia_clinica.parentesco_contacto1, tbl15_historia_clinica.direccion_contacto1,
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, tbl15_historia_clinica.url_img_foto_min, 
tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.motivo, tbl15_trabajo_altura.cod_trabajo_altura, 
tbl15_trabajo_altura.nombre_tipo_remision, tbl15_trabajo_altura.fecha_control
FROM tbl15_historia_clinica RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_trabajo_altura ON tbl15_cliente.cod_cliente = tbl15_trabajo_altura.cod_cliente) 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_trabajo_altura.cod_historia_clinica 
HAVING (tbl15_trabajo_altura.cod_trabajo_altura='$cod_trabajo_altura')";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_trabajo_altura = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_entidad                            = $info_trabajo_altura['cod_entidad'];
$cod_administrador                      = $info_trabajo_altura['cod_administrador'];

$sql_profesional = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombres_prof                           = $info_profesional['nombres'];
$apellidos_prof                         = $info_profesional['apellidos'];
/*
$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);
$nombre_entidad = $info_entidad['nombre_entidad'];
*/
$motivo                                = $info_trabajo_altura['motivo'];
$cedula                                = $info_trabajo_altura['cedula'];
$nombres_cli                           = $info_trabajo_altura['nombres'];
$apellido1_cli                         = $info_trabajo_altura['apellido1'];
$cod_cliente                           = $info_trabajo_altura['cod_cliente'];
$cod_administrador                     = $info_trabajo_altura['cod_administrador'];

$motivo_trabajo_altura                 = $info_trabajo_altura['motivo_trabajo_altura'];
$trab_ant_centro_trab                  = $info_trabajo_altura['trab_ant_centro_trab'];
$trab_ant_tiempo                       = $info_trabajo_altura['trab_ant_tiempo'];
$trab_ant_puesto                       = $info_trabajo_altura['trab_ant_puesto'];
$trab_ant_descrip_tarea                = $info_trabajo_altura['trab_ant_descrip_tarea'];
$trab_ant_acci_lab_secue               = $info_trabajo_altura['trab_ant_acci_lab_secue'];
$trab_ant_enf_prof_secue               = $info_trabajo_altura['trab_ant_enf_prof_secue'];
$ant_fam_diabetes                      = $info_trabajo_altura['ant_fam_diabetes'];
$ant_fam_hipertension                  = $info_trabajo_altura['ant_fam_hipertension'];
$ant_fam_cardiacas                     = $info_trabajo_altura['ant_fam_cardiacas'];
$ant_fam_asma                          = $info_trabajo_altura['ant_fam_asma'];
$ant_fam_convulsiones                  = $info_trabajo_altura['ant_fam_convulsiones'];
$ant_fam_otros                         = $info_trabajo_altura['ant_fam_otros'];
$ant_fam_cuales                        = $info_trabajo_altura['ant_fam_cuales'];
$ant_gine_menarquia                    = $info_trabajo_altura['ant_gine_menarquia'];
$ant_gine_fmu                          = $info_trabajo_altura['ant_gine_fmu'];
$ant_gine_ritmo                        = $info_trabajo_altura['ant_gine_ritmo'];
$ant_gine_g                            = $info_trabajo_altura['ant_gine_g'];
$ant_gine_p                            = $info_trabajo_altura['ant_gine_p'];
$ant_gine_a                            = $info_trabajo_altura['ant_gine_a'];
$ant_gine_c                            = $info_trabajo_altura['ant_gine_c'];
$ant_gine_ivsa                         = $info_trabajo_altura['ant_gine_ivsa'];
$ant_gine_mpf                          = $info_trabajo_altura['ant_gine_mpf'];
$ant_gine_fpp                          = $info_trabajo_altura['ant_gine_fpp'];
$ant_gine_doc                          = $info_trabajo_altura['ant_gine_doc'];
$ant_gine_fecha                        = $info_trabajo_altura['ant_gine_fecha'];
$ant_gine_resultado                    = $info_trabajo_altura['ant_gine_resultado'];
$ant_gine_tratamiento                  = $info_trabajo_altura['ant_gine_tratamiento'];
$ant_gine_cual                         = $info_trabajo_altura['ant_gine_cual'];
$ant_nopatolog_fuma                    = $info_trabajo_altura['ant_nopatolog_fuma'];
$ant_nopatolog_alcohol                 = $info_trabajo_altura['ant_nopatolog_alcohol'];
$ant_nopatolog_toxicomanias            = $info_trabajo_altura['ant_nopatolog_toxicomanias'];
$ant_nopatolog_otros                   = $info_trabajo_altura['ant_nopatolog_otros'];
$ant_nopatolog_cuanto                  = $info_trabajo_altura['ant_nopatolog_cuanto'];
$ant_person_pato_convul                = $info_trabajo_altura['ant_person_pato_convul'];
$ant_person_pato_dificulresp           = $info_trabajo_altura['ant_person_pato_dificulresp'];
$ant_person_pato_reacalerg             = $info_trabajo_altura['ant_person_pato_reacalerg'];
$ant_person_pato_problemcorazon        = $info_trabajo_altura['ant_person_pato_problemcorazon'];
$ant_person_pato_claustofob            = $info_trabajo_altura['ant_person_pato_claustofob'];
$ant_person_pato_presionalta           = $info_trabajo_altura['ant_person_pato_presionalta'];
$ant_person_pato_dificuloler           = $info_trabajo_altura['ant_person_pato_dificuloler'];
$ant_person_pato_tomamedicam           = $info_trabajo_altura['ant_person_pato_tomamedicam'];
$ant_person_pato_diabetes              = $info_trabajo_altura['ant_person_pato_diabetes'];
$ant_person_pato_usalentes             = $info_trabajo_altura['ant_person_pato_usalentes'];
$ant_person_pato_problempulmonar       = $info_trabajo_altura['ant_person_pato_problempulmonar'];
$ant_person_pato_dificuldistinguircolor = $info_trabajo_altura['ant_person_pato_dificuldistinguircolor'];
$explo_fis_signovital                  = $info_trabajo_altura['explo_fis_signovital'];
$explo_fis_fc                          = $info_trabajo_altura['explo_fis_fc'];
$explo_fis_fr                          = $info_trabajo_altura['explo_fis_fr'];
$explo_fis_ta                          = $info_trabajo_altura['explo_fis_ta'];
$explo_fis_antropometria               = $info_trabajo_altura['explo_fis_antropometria'];
$explo_fis_peso                        = $info_trabajo_altura['explo_fis_peso'];
$explo_fis_talla                       = $info_trabajo_altura['explo_fis_talla'];
$explo_fis_imc                         = $info_trabajo_altura['explo_fis_imc'];
$explo_fis_perimuneca                  = $info_trabajo_altura['explo_fis_perimuneca'];
$explo_fis_pericintura                 = $info_trabajo_altura['explo_fis_pericintura'];
$explo_fis_visionav                    = $info_trabajo_altura['explo_fis_visionav'];
$explo_fis_od                          = $info_trabajo_altura['explo_fis_od'];
$explo_fis_oi                          = $info_trabajo_altura['explo_fis_oi'];
$explo_fis_ishihara                    = $info_trabajo_altura['explo_fis_ishihara'];
$explo_fis_cabeza                      = $info_trabajo_altura['explo_fis_cabeza'];
$explo_fis_cuello                      = $info_trabajo_altura['explo_fis_cuello'];
$explo_fis_cadiopulm                   = $info_trabajo_altura['explo_fis_cadiopulm'];
$explo_fis_digestivo                   = $info_trabajo_altura['explo_fis_digestivo'];
$explo_fis_sistemmuscesquelet          = $info_trabajo_altura['explo_fis_sistemmuscesquelet'];
$explo_fis_pielanexos                  = $info_trabajo_altura['explo_fis_pielanexos'];
$explo_fis_testromberg                 = $info_trabajo_altura['explo_fis_testromberg'];
$explo_fis_dixhalp                     = $info_trabajo_altura['explo_fis_dixhalp'];
$explo_fis_priebmarcha                 = $info_trabajo_altura['explo_fis_priebmarcha'];
$explo_fis_recomenespeciftrab          = $info_trabajo_altura['explo_fis_recomenespeciftrab'];
$explo_fis_recomenespecifempre         = $info_trabajo_altura['explo_fis_recomenespecifempre'];
$explo_fis_idx                         = $info_trabajo_altura['explo_fis_idx'];
$nombre_acepta_trab_altura             = $info_trabajo_altura['nombre_acepta_trab_altura'];

$exa_fis_ojoder_sncorre_vlejan         = $info_trabajo_altura['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca         = $info_trabajo_altura['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan         = $info_trabajo_altura['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca         = $info_trabajo_altura['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan         = $info_trabajo_altura['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca         = $info_trabajo_altura['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan         = $info_trabajo_altura['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca         = $info_trabajo_altura['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan         = $info_trabajo_altura['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca         = $info_trabajo_altura['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan        = $info_trabajo_altura['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca         = $info_trabajo_altura['exa_fis_ojoamb_cncorre_vcerca'];

$url_img_firma_min_cli                 = $info_trabajo_altura['url_img_firma_min_cli'];
$url_img_firma_cli                     = $info_trabajo_altura['url_img_firma_cli'];
$url_img_foto_min_cli                  = $info_trabajo_altura['url_img_foto_min_cli'];
$url_img_foto_cli                      = $info_trabajo_altura['url_img_foto_cli'];

$ciudad_empresa                        = $info_trabajo_altura['ciudad_empresa'];
$nombre_empresa                        = $info_trabajo_altura['nombre_empresa'];
$cargo_empresa                         = $info_trabajo_altura['cargo_empresa'];
$area_empresa                          = $info_trabajo_altura['area_empresa'];
$nombre_empresa_contratante            = $info_trabajo_altura['nombre_empresa_contratante'];
$nombre_tipo_remision                  = $info_trabajo_altura['nombre_tipo_remision'];
$fecha_control                         = $info_trabajo_altura['fecha_control'];

$url_img_firma_min                     = $info_trabajo_altura['url_img_firma_min'];
$url_img_firma_orig                    = $info_trabajo_altura['url_img_firma_orig'];
$url_img_foto_min                      = $info_trabajo_altura['url_img_foto_min'];
$url_img_foto_orig                     = $info_trabajo_altura['url_img_foto_orig'];
$cod_cliente                           = $info_trabajo_altura['cod_cliente'];

$fecha_mes                             = $info_trabajo_altura['fecha_mes'];
$fecha_anyo                            = $info_trabajo_altura['fecha_anyo'];
$fecha_ymd                             = $info_trabajo_altura['fecha_ymd'];
$fecha_dmy                             = $info_trabajo_altura['fecha_dmy'];
$fecha_time                            = $info_trabajo_altura['fecha_time'];
$fecha_reg_time                        = $info_trabajo_altura['fecha_reg_time'];
$cuenta                                = $info_trabajo_altura['cuenta'];
$cuenta_reg                            = $info_trabajo_altura['cuenta_reg'];
$fecha_reg_time_dmy                    = date("d/m/Y", $fecha_reg_time);
$nombres_completos                     = "TRABAJO EN ALTURAS-".$nombres_cli.'_'.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_trabajo_altura;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');
$margen_izq                            = '10';
$margen_der                            = '10';
$margen_inf_encabezado                 = '20';
$margen_sup_encabezado                 = '5';
$posicion_sup_encabezado               = '5';
$posicion_inf_encabezado               = '20';

$titulo_doc_pdf                        = $nombres_completos;
$autor_doc_pdf                         = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                       = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                          = "TRABAJO EN ALTURAS";
$palabras_claves_doc_pdf               = $nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_trabajo_altura;
$cod_trabajo_altura_strpad             = str_pad($cod_trabajo_altura, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf = new mPDF('c','Legal');
$mpdf                                  = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">EVALUACIÓN MÉDICA PARA TRABAJO EN ALTURAS</td>
    <td width="25%" align="center"><barcode code="'.$cod_trabajo_altura_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">TRABALTU: '.$cod_trabajo_altura.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">EVALUACIÓN MÉDICA PARA TRABAJO EN ALTURAS</td>
    <td width="25%" align="center"><barcode code="'.$cod_trabajo_altura_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">TRABALTU: '.$cod_trabajo_altura.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$footer = '
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
';
$footerE = '
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
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
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td><strong>I. TIPO DE EXAMEN</strong></td>
    <td><strong>Fecha: '.$fecha_ymd.'</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>MOTIVO DE EVALUACIÓN: </strong></td>
    <td>'.$motivo_trabajo_altura.'</td>
  </tr>
  <tr>
    <td colspan="14"><strong>II. IDENTIFICACIÓN DE LA EMPRESA</strong></td>
  </tr>
  <tr>
    <td><strong>Empresa Contratante:</strong> '.$nombre_empresa_contratante.'</td>
    <td><strong>Empresa a Laborar:</strong> '.$nombre_empresa.'</td>
  </tr>
  <tr>
    <td><strong>III. DATOS DEL TRABAJADOR</strong></td>
  </tr>
  <tr>
    <td><strong>Apellidos y Nombres:</strong> '.$nombres_cli.' '.$apellido1_cli.'</td>
    <td><strong>Identificación:</strong> '.$cedula.'</td>
  </tr>
  <tr>
    <td><strong>Cargo:</strong> '.$cargo_empresa.'</td>
    <td><strong>Ciudad:</strong> '.$ciudad_empresa.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td><strong>IV. TRABAJOS ANTERIORES</strong></td>
  </tr>
  <tr>
    <td><strong>CENTRO DE TRABAJO:</strong> '.$trab_ant_centro_trab.'</td>
    <td><strong>TIEMPO:</strong> '.$trab_ant_tiempo.'</td>
    <td><strong>PUESTO:</strong> '.$trab_ant_puesto.'</td>
    <td><strong>DESCRIPCIÓN DE LA TAREA:</strong> '.$trab_ant_descrip_tarea.'</td>
  </tr>
  <tr>
    <td colspan="2"><strong>ACCIDENTES LABORALES Y SECUELAS:</strong> '.$trab_ant_acci_lab_secue.'</td>
    <td colspan="2"><strong>ENFERMEDADES PROFESIONALES Y SECUELAS:</strong> '.$trab_ant_enf_prof_secue.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td><strong>V. ANTECEDENTES HEREDO FAMILIARES</strong></td>
    <td><strong></strong></td>
    <td><strong>VI. ANTECEDENTES GINECO OBSTÉTRICOS</strong></td>
  </tr>
  <tr>
    <td></td>
    <td><strong></strong></td>
    <td>
    <strong>Menarquia:</strong>'.$ant_gine_menarquia.' 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>F.M.U:</strong>'.$ant_gine_fmu.' 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Ritmo:</strong>'.$ant_gine_ritmo.'</td>
  </tr>
  <tr>
    <td>Diabetes<strong></strong></td>
    <td style="text-align:center">'.$ant_fam_diabetes.'</td>
    <td>
      <strong>G:</strong>'.$ant_gine_g.'
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>P:</strong>'.$ant_gine_p.' 
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>A:</strong>'.$ant_gine_a.' 
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>C:</strong>'.$ant_gine_c.' 
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>I.V.S.A:</strong>'.$ant_gine_ivsa.'</td>
  </tr>
  <tr>
    <td>Hipertensión<strong></strong></td>
    <td style="text-align:center">'.$ant_fam_hipertension.'</td>
    <td>
      <strong>M.P.F:</strong>'.$ant_gine_mpf.'&nbsp;&nbsp;&nbsp;&nbsp;
      <strong>F.P.P:</strong>'.$ant_gine_fpp.'&nbsp;&nbsp;&nbsp;&nbsp;
      <strong>D.O.C:</strong>'.$ant_gine_doc.'</td>
  </tr>
  <tr>
    <td><p>Cardiopatia<strong></strong></p></td>
    <td style="text-align:center">'.$ant_fam_cardiacas.'</td>
    <td>
      <strong>FECHA:</strong>'.$ant_gine_fecha.'&nbsp;&nbsp;&nbsp;&nbsp;
      <strong>Resultado:</strong>'.$ant_gine_resultado.'</td>
  </tr>
  <tr>
    <td>Asma</td>
    <td style="text-align:center">'.$ant_fam_asma.'</td>
    <td><strong>Tratamiento:</strong>'.$ant_gine_tratamiento.' 
    &nbsp;&nbsp;&nbsp;&nbsp;<strong>¿Cuál?</strong>'.$ant_gine_cual.'</td>
  </tr>
  <tr>
    <td>Convulsiones<strong></strong></td>
    <td style="text-align:center">'.$ant_fam_convulsiones.'</td>
    <td></td>
  </tr>
  <tr>
    <td>Otros</td>
    <td style="text-align:center">'.$ant_fam_otros.'</td>
    <td><strong>Cuáles: </strong>'.$ant_fam_cuales.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td colspan="23"><strong>VII. ANTECEDENTES PERSONALES NO PATOLÓGICOS </strong></td>
  </tr>
  <tr>
    <td><strong></strong></td>
    <td style="text-align:center" colspan="2"></td>
    <td colspan="20"><strong>Cuanto:</strong> '.$ant_nopatolog_cuanto.'</td>
  </tr>
  <tr>
    <td>Fuma</td>
    <td style="text-align:center" colspan="2">'.$ant_nopatolog_fuma.'</td>
  </tr>
  <tr>
    <td>Consume Alcohol</td>
    <td style="text-align:center" colspan="2">'.$ant_nopatolog_alcohol.'</td>
  </tr>
  <tr>
    <td>Toxicoman&iacute;as</td>
    <td style="text-align:center" colspan="2">'.$ant_nopatolog_toxicomanias.'</td>
  </tr>
  <tr>
    <td>Otros</td>
    <td style="text-align:center" colspan="2">'.$ant_nopatolog_otros.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td colspan="14">
      <strong>VIII. ANTECEDENTES PERSONALES PATOLÓGICOS</strong>
    </td>
  </tr>
  <tr>
    <td colspan="6"><strong>CONVULSIONES (ATAQUES)</strong></td>
    <td style="text-align:center;">'.$ant_person_pato_convul.'</td>
    <td colspan="6"><strong>DIFICULTAD AL RESPIRAR</strong></td>
    <td style="text-align:center">'.$ant_person_pato_dificulresp.'</td>
  </tr>
  <tr>
    <td colspan="6"><strong>REACCIONES ALÉRGICAS QUE NO LO DEJAN RESPIRAR</strong></td>
    <td style="text-align:center">'.$ant_person_pato_reacalerg.'</td>
    <td colspan="6"><strong>PROBLEMAS DEL CORAZÓN</strong></td>
    <td style="text-align:center">'.$ant_person_pato_problemcorazon.'</td>
  </tr>
  <tr>
    <td colspan="6"><strong>CLAUSTROFOBIA (MIEDO A ESTAR EN ESPACIOS CERRADOS)</strong></td>
    <td style="text-align:center">'.$ant_person_pato_claustofob.'</td>
    <td colspan="6"><strong>PRESIÓN ALTA</strong></td>
    <td style="text-align:center">'.$ant_person_pato_presionalta.'</td>
  </tr>
  <tr>
    <td colspan="6"><strong>DIFICULTAD AL OLER (EXCEPTO CON RESFRIADO)</strong></td>
    <td style="text-align:center">'.$ant_person_pato_dificuloler.'</td>
    <td colspan="6"><strong>TOMA MEDICAMENTOS</strong></td>
    <td style="text-align:center">'.$ant_person_pato_tomamedicam.'</td>
  </tr>
  <tr>
    <td colspan="6"><strong>DIABETES (AZÚCAR EN LA SANGRE)</strong></td>
    <td style="text-align:center">'.$ant_person_pato_diabetes.'</td>
    <td colspan="6"><p><strong>USA LENTES</strong></td>
    <td style="text-align:center">'.$ant_person_pato_usalentes.'</td>
  </tr>
  <tr>
    <td colspan="6"><strong>PROBLEMAS PULMONARES</strong></td>
    <td style="text-align:center">'.$ant_person_pato_problempulmonar.'</td>
    <td colspan="6"><strong>DIFICULTAD PARA DISTINGUIR LOS COLORES</strong></td>
    <td style="text-align:center">'.$ant_person_pato_dificuldistinguircolor.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td colspan="14"><strong>IX. EXPLORACIÓN FÍSICA</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>SIGNOS VITALES:</strong>'.$explo_fis_signovital.'</td>
    <td colspan="6"><strong>FC:</strong>'.$explo_fis_fc.'</td>
    <td colspan="2"><strong>FR:</strong>'.$explo_fis_fr.'</td>
    <td colspan="3"><strong>TA:</strong>'.$explo_fis_ta.'</td>
  </tr>
  <tr>
    <td colspan="3"><strong>ANTROPOMETRÍA:</strong>'.$explo_fis_antropometria.'</td>
    <td colspan="6"><strong>PESO:</strong>'.$explo_fis_peso.'</td>
    <td colspan="2"><strong>TALLA:</strong>'.$explo_fis_talla.'</td>
    <td colspan="3"><strong>IMC:</strong>'.$explo_fis_imc.'</td>
  </tr>
  <tr>
    <td colspan="3"><strong>PERÍMETRO DE LA MUÑECA:</strong>'.$explo_fis_perimuneca.'</td>
    <td colspan="12"><strong>PERÍMETRO DE LA CINTURA:</strong>'.$explo_fis_pericintura.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
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

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td colspan="2" rowspan="2"><strong>VISIÓN AV:</strong>'.$explo_fis_visionav.'</td>
    <td colspan="3"><strong>OD:</strong>'.$explo_fis_od.'</td>
    <td colspan="9" rowspan="2"><strong>ISHIHARA:</strong>'.$explo_fis_ishihara.'</td>
  </tr>
  <tr>
    <td colspan="3"><strong>OI:</strong>'.$explo_fis_oi.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>CABEZA:</strong></td>
    <td colspan="2">'.$explo_fis_cabeza.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>CUELLO:</strong></td>
    <td colspan="2">'.$explo_fis_cuello.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>CARDIO PULMONAR:</strong></td>
    <td colspan="2">'.$explo_fis_cadiopulm.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>DIGESTIVO:</strong></td>
    <td colspan="2">'.$explo_fis_digestivo.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>SISTEMA MUSCULO ESQUELÉTICO:</strong></td>
    <td colspan="2">'.$explo_fis_sistemmuscesquelet.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>PIEL Y ANEXOS:</strong></td>
    <td colspan="2">'.$explo_fis_pielanexos.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>TEST DE ROMBERG:</strong></td>
    <td colspan="2">'.$explo_fis_testromberg.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>TEST DE DIX HALPIKE:</strong></td>
    <td colspan="2">'.$explo_fis_dixhalp.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>PRUEBA DE LA MARCHA:</strong></td>
    <td colspan="2">'.$explo_fis_priebmarcha.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td><strong>X. RECOMENDACIONES ESPECÍFICAS TRABAJADOR:</strong> '.$explo_fis_recomenespeciftrab.'</td>
  </tr>
  <tr>
    <td><strong>XI. RECOMENDACIONES ESPECÍFICAS EMPRESA:</strong> '.$explo_fis_recomenespecifempre.'</td>
  </tr>
  <tr>
    <td>IDX: '.$explo_fis_idx.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_trabaltu_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center;">REMISIÓN: '.$nombre_tipo_remision.'</td>
    <td style="text-align:center;">FECHA DE CONTROL: '.$fecha_control.'</td>
    <td style="text-align:center;">ESTADO DEL TRABAJADOR: '.$nombre_acepta_trab_altura.'</td>
  </tr>
</table>
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:7pt; width:100%">
  <tr>
    <td><p><strong>FIRMA DEL MÉDICO</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
        <p><strong>'.$nombres_prof.' '.$apellidos_prof.'</strong></p></td>

    <td><p><strong>FIRMA DEL PACIENTE</strong></p>
    <div><img src="'.$url_img_firma_min_cli.'" height="60px"/></div>
    <div>_________________________________________ </div>
        <p><strong>'.$nombres_cli.' '.$apellido1_cli.'</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Reg. M&eacute;dico: '.$reg_medico_emp. ' </strong><strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong><strong> </strong></p></td>
    <td><p><strong>C.C '.$cedula.'</strong> </p></td>
  </tr>
</table>

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
$nombre_archivo = 'CONCTRABALTURA_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
$mpdf->Output($nombre_archivo, 'I');
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