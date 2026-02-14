<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

if (isset($_GET['cod_consentimiento_informado'])) { $cod_consentimiento_informado = intval($_GET['cod_consentimiento_informado']); } else { $cod_consentimiento_informado = 0;	}
if (isset($_GET['cod_historia_clinica'])) { $cod_historia_clinica = intval($_GET['cod_historia_clinica']); } else { $cod_historia_clinica = 0; }
if (isset($_GET['cod_cliente'])) { $cod_cliente = intval($_GET['cod_cliente']);	} else { $cod_cliente = 0; }

$pagina_local                        = $_SERVER['PHP_SELF'];
$fecha_hoy_time                      = strtotime(date("Y/m/d"));
$fecha_hoy                           = time();
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
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
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_consentimiento_informado = "SELECT * FROM tbl15_consentimiento_informado WHERE cod_consentimiento_informado = '".($cod_consentimiento_informado)."'";
$consultar_consentimiento_informado = mysqli_query($conectar, $obtener_consentimiento_informado) or die(mysqli_error($conectar));
$info_consentimiento_informado= mysqli_fetch_assoc($consultar_consentimiento_informado);

$cod_historia_clinica                               = $info_consentimiento_informado['cod_historia_clinica'];
$cod_cliente                                        = $info_consentimiento_informado['cod_cliente'];
$cod_administrador                                  = $info_consentimiento_informado['cod_administrador'];
$motivo_cosulta                                     = $info_consentimiento_informado['motivo_cosulta'];
$cod_grupo_area                                     = $info_consentimiento_informado['cod_grupo_area'];
$cod_grupo_area_cargo                               = $info_consentimiento_informado['cod_grupo_area_cargo'];
$cod_factura                                        = $info_consentimiento_informado['cod_factura'];
$nombre_ocupacion                                   = $info_consentimiento_informado['nombre_ocupacion'];
$nombre_empresa                                     = $info_consentimiento_informado['nombre_empresa'];
$cargo_empresa                                      = $info_consentimiento_informado['cargo_empresa'];
$area_empresa                                       = $info_consentimiento_informado['area_empresa'];
$ciudad_empresa                                     = $info_consentimiento_informado['ciudad_empresa'];
$nombre_empresa_contratante                         = $info_consentimiento_informado['nombre_empresa_contratante'];
$objetivo_autoreport                                = $info_consentimiento_informado['objetivo_autoreport'];
$antecpersonosteo_problem_column                    = $info_consentimiento_informado['antecpersonosteo_problem_column'];
$antecpersonosteo_esguience_luxac                   = $info_consentimiento_informado['antecpersonosteo_esguience_luxac'];
$antecpersonosteo_epicondi_tunelcarp                = $info_consentimiento_informado['antecpersonosteo_epicondi_tunelcarp'];
$antecpersonosteo_enferm_huesos                     = $info_consentimiento_informado['antecpersonosteo_enferm_huesos'];
$antecpersonosteo_lesion_deport_cual                = $info_consentimiento_informado['antecpersonosteo_lesion_deport_cual'];
$antecpersonosteo_lesion_deport                     = $info_consentimiento_informado['antecpersonosteo_lesion_deport'];
$antecpersonneurol_temor_altura                     = $info_consentimiento_informado['antecpersonneurol_temor_altura'];
$antecpersonneurol_epilespsia                       = $info_consentimiento_informado['antecpersonneurol_epilespsia'];
$antecpersonneurol_ansiedad                         = $info_consentimiento_informado['antecpersonneurol_ansiedad'];
$antecpersoncardiov_enf_corazon                     = $info_consentimiento_informado['antecpersoncardiov_enf_corazon'];
$antecpersoncardiov_asma                            = $info_consentimiento_informado['antecpersoncardiov_asma'];
$antecpersoncardiov_hiperarter                      = $info_consentimiento_informado['antecpersoncardiov_hiperarter'];
$antecpersoncardiov_otra_enfer                      = $info_consentimiento_informado['antecpersoncardiov_otra_enfer'];
$antecpersoncardiov_otra_enfer_cual                 = $info_consentimiento_informado['antecpersoncardiov_otra_enfer_cual'];
$antecpersonendocrino_diabete                       = $info_consentimiento_informado['antecpersonendocrino_diabete'];
$antecpersonendocrino_anemia                        = $info_consentimiento_informado['antecpersonendocrino_anemia'];
$antecpersonendocrino_hiperuricemia                 = $info_consentimiento_informado['antecpersonendocrino_hiperuricemia'];
$antecpersonendocrino_alter_tiroid                  = $info_consentimiento_informado['antecpersonendocrino_alter_tiroid'];
$antecpersonendocrino_cancer                        = $info_consentimiento_informado['antecpersonendocrino_cancer'];
$antecpersonendocrino_piel_amarilla                 = $info_consentimiento_informado['antecpersonendocrino_piel_amarilla'];
$antecpersonendocrino_calc_colicos                  = $info_consentimiento_informado['antecpersonendocrino_calc_colicos'];
$antecpersonendocrino_hipertrof_prost               = $info_consentimiento_informado['antecpersonendocrino_hipertrof_prost'];
$antecpersonendocrino_enf_piel                      = $info_consentimiento_informado['antecpersonendocrino_enf_piel'];
$antecpersonendocrino_problem_renal                 = $info_consentimiento_informado['antecpersonendocrino_problem_renal'];
$antecpersonendocrino_reflujo                       = $info_consentimiento_informado['antecpersonendocrino_reflujo'];
$antecpersonoidnarisojos_problem_oido               = $info_consentimiento_informado['antecpersonoidnarisojos_problem_oido'];
$antecpersonoidnarisojos_vertigo                    = $info_consentimiento_informado['antecpersonoidnarisojos_vertigo'];
$antecpersonoidnarisojos_dificul_vision             = $info_consentimiento_informado['antecpersonoidnarisojos_dificul_vision'];
$antecpersonoidnarisojos_problem_ojos               = $info_consentimiento_informado['antecpersonoidnarisojos_problem_ojos'];
$antecpersoninmunizac_vacum10anyos                  = $info_consentimiento_informado['antecpersoninmunizac_vacum10anyos'];
$antecpersoninmunizac_vacum10anyos_cual             = $info_consentimiento_informado['antecpersoninmunizac_vacum10anyos_cual'];
$antecpersoninmunizac_vacum10anyos_fecha            = $info_consentimiento_informado['antecpersoninmunizac_vacum10anyos_fecha'];
$antecpersongeneral_sufre_enf_menson_ant            = $info_consentimiento_informado['antecpersongeneral_sufre_enf_menson_ant'];
$antecpersongeneral_sufre_enf_menson_ant_cual       = $info_consentimiento_informado['antecpersongeneral_sufre_enf_menson_ant_cual'];
$antecpersongeneral_tranf_sangre                    = $info_consentimiento_informado['antecpersongeneral_tranf_sangre'];
$antecpersongeneral_tranf_sangre_fecha              = $info_consentimiento_informado['antecpersongeneral_tranf_sangre_fecha'];
$antecpersongeneral_tranf_sangre_fecha_causa        = $info_consentimiento_informado['antecpersongeneral_tranf_sangre_fecha_causa'];
$antecpersongeneral_presen_reaccion                 = $info_consentimiento_informado['antecpersongeneral_presen_reaccion'];
$antecpersongeneral_trata_segui_medic_cual          = $info_consentimiento_informado['antecpersongeneral_trata_segui_medic_cual'];
$antecpersongeneral_trata_segui_medic               = $info_consentimiento_informado['antecpersongeneral_trata_segui_medic'];
$antecpersongeneral_dicho_operarse_operado_cual     = $info_consentimiento_informado['antecpersongeneral_dicho_operarse_operado_cual'];
$antecpersongeneral_dicho_operarse_operado          = $info_consentimiento_informado['antecpersongeneral_dicho_operarse_operado'];
$antecpersongeneral_alguna_hospitaliza_clinic       = $info_consentimiento_informado['antecpersongeneral_alguna_hospitaliza_clinic'];
$antecpersongeneral_alergico_algo_cual              = $info_consentimiento_informado['antecpersongeneral_alergico_algo_cual'];
$antecpersongeneral_alergico_algo                   = $info_consentimiento_informado['antecpersongeneral_alergico_algo'];
$antecpersongeneral_medicament_actualm_cual         = $info_consentimiento_informado['antecpersongeneral_medicament_actualm_cual'];
$antecpersongeneral_medicament_actualm              = $info_consentimiento_informado['antecpersongeneral_medicament_actualm'];
$antecpersongeneral_sufre_deter_fisico_cual         = $info_consentimiento_informado['antecpersongeneral_sufre_deter_fisico_cual'];
$antecpersongeneral_sufre_deter_fisico              = $info_consentimiento_informado['antecpersongeneral_sufre_deter_fisico'];
$antecpersongeneral_calif_perdcapc_lab_cual         = $info_consentimiento_informado['antecpersongeneral_calif_perdcapc_lab_cual'];
$antecpersongeneral_calif_perdcapc_lab              = $info_consentimiento_informado['antecpersongeneral_calif_perdcapc_lab'];
$antecpersongeneral_repor_arl_empresa_cual          = $info_consentimiento_informado['antecpersongeneral_repor_arl_empresa_cual'];
$antecpersongeneral_repor_arl_empresa               = $info_consentimiento_informado['antecpersongeneral_repor_arl_empresa'];
$antecpersongeneral_calif_eps_arl_enf_trab_cual     = $info_consentimiento_informado['antecpersongeneral_calif_eps_arl_enf_trab_cual'];
$antecpersongeneral_calif_eps_arl_enf_trab          = $info_consentimiento_informado['antecpersongeneral_calif_eps_arl_enf_trab'];
$nombre_empresa                                     = $info_consentimiento_informado['nombre_empresa'];
$politic_protec_datos                               = $info_consentimiento_informado['politic_protec_datos'];
$fecha_mes                                          = $info_consentimiento_informado['fecha_mes'];
$fecha_anyo                                         = $info_consentimiento_informado['fecha_anyo'];
$fecha_ymd                                          = $info_consentimiento_informado['fecha_ymd'];
$fecha_dmy                                          = $info_consentimiento_informado['fecha_dmy'];
$fecha_hora                                         = $info_consentimiento_informado['fecha_hora'];
$fecha_time                                         = $info_consentimiento_informado['fecha_time'];
$fecha_reg_time                                     = $info_consentimiento_informado['fecha_reg_time'];
$cuenta                                             = $info_consentimiento_informado['cuenta'];
$cuenta_reg                                         = $info_consentimiento_informado['cuenta_reg'];
$check_diligenciado                                 = $info_consentimiento_informado['check_diligenciado'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_empresa= "SELECT razonsocial_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '".($nombre_empresa)."'";
$consultar_empresa= mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$tbl15_info_empresa= mysqli_fetch_assoc($consultar_empresa);

$razonsocial_empresa                 = $tbl15_info_empresa['razonsocial_empresa'];
$direccion_empresa                   = $tbl15_info_empresa['direccion_empresa'];
$telefono_empresa                    = $tbl15_info_empresa['telefono_empresa'];
$nit_empresa                         = $tbl15_info_empresa['nit_empresa'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_prof = "SELECT nombres AS nombre_prof, apellidos AS apellidos_prof FROM tbl15_administrador WHERE cod_administrador = '".($cod_administrador)."'";
$consultar_prof = mysqli_query($conectar, $obtener_prof) or die(mysqli_error($conectar));
$info_prof = mysqli_fetch_assoc($consultar_prof);

$nombre_prof                         = $info_prof['nombre_prof'];
$apellidos_prof                      = $info_prof['apellidos_prof'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, nombre_sexo, url_img_firma_min AS url_img_firma_min_cli, direccion, lugar_residencia,
tel_cliente, cod_entidad, fecha_nac_ymd, nombre_arl, nombre_tipo_regimen FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres_cli                         = $info_cliente['nombres'];
$apellido1_cli                       = $info_cliente['apellido1'];
$apellido2_cli                       = $info_cliente['apellido2'];
$nombre_tipo_doc                     = $info_cliente['nombre_tipo_doc'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$nombre_sexo                         = $info_cliente['nombre_sexo'];
$direccion                           = $info_cliente['direccion'];
$lugar_residencia                    = $info_cliente['lugar_residencia'];
$tel_cliente                         = $info_cliente['tel_cliente'];
$cod_entidad                         = $info_cliente['cod_entidad'];
$nombre_arl                          = $info_cliente['nombre_arl'];
$nombre_tipo_regimen                 = $info_cliente['nombre_tipo_regimen'];
$fecha_nac_ymd                       = $info_cliente['fecha_nac_ymd'];
$fecha_nac_time                      = strtotime($fecha_nac_ymd);
$diferencia_edad                     = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                           = floor($diferencia_edad / (365*60*60*24));
$nom_ape                             = $nombres_cli.' '.$apellido1_cli.' '.$apellido2_cli;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '".($cod_entidad)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];
$nombres_completos                   = "CONSENTIMIENTO INFORMADO-".$nombres_cli.'_'.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_consentimiento_informado;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');
$margen_izq                          = '10';
$margen_der                          = '10';
$margen_inf_encabezado               = '20';
$margen_sup_encabezado               = '5';
$posicion_sup_encabezado             = '5';
$posicion_inf_encabezado             = '5';

$titulo_doc_pdf                      = $nombres_completos;
$autor_doc_pdf                       = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                     = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                        = "CONSENTIMIENTO INFORMADO";
$palabras_claves_doc_pdf             = $nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_consentimiento_informado;
$cod_consentimiento_informado_strpad    = str_pad($cod_consentimiento_informado, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
 <tbody>
  <tr>
    <td rowspan="3" align="center"><img src="../imagenes/logo_superior_borde_consentimiento_pdf_imprimir.png" /></td>
    <td align="center"><barcode code="'.$cod_consentimiento_informado_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr><td align="center"></td></tr><tr><td align="center">CCI: '.$cod_consentimiento_informado.'</td></tr>
 </tbody>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
 <tbody>
  <tr>
    <td rowspan="3" align="center"><img src="../imagenes/logo_superior_borde_consentimiento_pdf_imprimir.png" /></td>
    <td align="center"><barcode code="'.$cod_consentimiento_informado_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr><td align="center"></td></tr><tr><td align="center">CCI: '.$cod_consentimiento_informado.'</td></tr>
 </tbody>
</table>
';
$footer = '
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
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
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
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
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td style="text-align:center">AUTOREPORTE DE CONDICIONES DE SALUD Y ANTECEDENTES MEDICOS</td>
  </tr>
  <tr>
    <td>El objetivo del presente anexo es suministrar al médico ocupacional la información de su tbl15_estado de salud y 
    	antecedentes personales, para poder determinar su  aptitud laboral y sus tareas a realizar. 
    	La confidencialidad y su uso serán primordiales para la elaboración de la historia clínica ocupacional. 
    	(Resolución 2346 del 2007 y resolución 1918 del 2009 expedidas por el ministerio de protección social.
    </td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td style="text-align:center">TIPO DE IDENTIFICACIÓN</td>
    <td style="text-align:center">IDENTIFICACIÓN</td>
    <td style="text-align:center">NOMBRES</td>
    <td style="text-align:center">APELLIDOS</td>
    <td style="text-align:center">SEXO</td>
    <td style="text-align:center">FECHA DE NACIMIENTO</td>
    <td style="text-align:center">EDAD</td>
  </tr>
  <tr>
    <td style="text-align:left" width="15%">.</td>
    <td style="text-align:left" width="15%">.</td>
    <td style="text-align:left">.</td>
    <td style="text-align:left">.</td>
    <td style="text-align:left" width="5%">.</td>
    <td style="text-align:left" width="15%">.</td>
    <td style="text-align:left" width="5%">.</td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td style="text-align:center">CELULAR</td>
    <td style="text-align:center">EMPRESA</td>
    <td style="text-align:center">FECHA</td>
    <td style="text-align:center">HORA</td>
  </tr>
  <tr>
    <td style="text-align:left">.</td>
    <td style="text-align:left" width="50%">.</td>
    <td style="text-align:left">.</td>
    <td style="text-align:left">.</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td>POR FAVOR RESPONDA LAS SIGUIENTES PREGUNTAS: (Marque x a la casilla que corresponda):</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="4">I. ANTECEDENTES PERSONALES OSTEOMUSCULARES:</td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Ha tenido problemas de columna (desviación, fractura, escoliosis, hernia, cirugías, etc.) </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Esguince, luxación fracturas, o proceso inflamatorio de alguna extremidad</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Ha presentado epicondilitis, túnel del carpo, tendinitis, manguito rotador. Hombro doloroso </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Le han diagnosticado enfermedad en los huesos, articulaciones o los músculos</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Ha sufrido lesión deportiva o trauma importante</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="4">II. ANTECEDENTES PERSONALES NEUROLOGICOS, PSIQUIATRICOS, PSICOLOGICOS</td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Temor a las alturas o espacios cerrados </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Epilepsia(convulsiones), Migrañas, Accidentes Cerebro-vascular(Derrames e isquemia cerebral)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Ansiedad, Depresión, alguna enfermedad neurológica o psiquiátrica</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="4">III. ANTECEDENTES  PERSONALES CARDIOVASCULARES Y PULMONARES:</td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Enfermedades del corazón (Infartos, arritmias, soplos, alteración de válvulas cardiacas)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Asma, venas varices, neumonía</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Hipertensión arterial</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Otras enfermedades pulmonares especifique</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="4">IV. ANTECEDENTES PERSONALES DEL SISTEMA ENDOCRINO Y OTROS SISTEMAS</td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Diabetes (Azúcar elevada), e Hipoglucemias (Azúcar baja)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Anemia (cansancio fácil, palidez) </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Hiperuricemia (Gota acido úrico elevado)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Alteración de la tiroides(hipertiroidismo, hipotiroidismo)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Cáncer, Tumor o Leucemia</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Piel amarilla por Ictericia, cálculos en la vesícula, hepatitis </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Cálculos cólicos o infecciones renales</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Hipertrofia de próstata (Esfuerzo al orinar, disminución del grosor del chorro</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Enfermedades de la piel</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Problemas renales e intestinales (cólicos, infecciones, hernias, ulceras</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Reflujo, gastritis y colon irritable</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
</table>
<br>
<div style="page-break-after: always"></div>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="4">V. ANTECEDENTES PERSONALES DE LOS OIDOS NARIZ Y OJOS:</td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Problemas de oídos (Cerumen, Infecciones, Traumas y Cirugías)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Vértigo, Disminución para escuchar (Sordera)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Dificultad para la visión, usa gafas o lentes de contacto o se los han formulado</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%"><ul><li>Tiene problemas en los ojos, (Pterigio, glaucoma, ardor, cataratas)</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="5">VI. ANTECEDENTES PERSONALES DE INMUNIZACION</td>
  </tr>
  <tr>
    <td style="text-align:left" width="50%">Se ha aplicado alguna vacuna en los últimos 10 años?</td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left" width="25%">Cual:</td>
    <td style="text-align:left">Fecha:</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td colspan="6">VII. ANTECEDENTES PERSONALES GENERALES:</td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Usted sufre de alguna enfermedad no relacionada anteriormente</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Le han transfundido sangre</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td>Causa:</td>
    <td>Presentó reacción:</td>
    <td>Fecha:</td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Se encuentra en tratamiento o seguimiento médico </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Le han dicho que tenía que operarse o lo han operado?</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">De que:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Alguna vez ha tbl15_estado hospitalizado en una clínica </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Es alérgico a algo? Químicos, insectos, medicamentos, polvos, metales, mariscos, maní, condimentos</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Toma algún tbl15_medicamento actualmente?</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Sufre actualmente de algún deterioro físico o mental que pueda limitar su capacidad laboral</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Le han calificado por pérdida de capacidad laboral, o se encuentra en proceso </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>Ha tenido reportes a la ARL de las empresas donde ha laborado? </li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left" width="30%"><ul><li>han calificado por EPS/ARL alguna enfermedad relacionada con el trabajo en enfermedad laboral</li></ul></td>
    <td style="text-align:center" width="5%">SI</td>
    <td style="text-align:center" width="5%">NO</td>
    <td style="text-align:left">Cual:</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td>VIII. POLITICA DE PROTECCION DE DATOS.</td>
  </tr>
  <tr>
    <td>Me acojo a las disposiciones establecidas en la ley 1581 de 2012, (Art. 2, 6, 13, 17, y    18) 
    	y su decreto reglamentario 1377 del 2013, art 4, 13), hablan de la entrada en vigencia del régimen 
    	general de protección de datos personales desarrollando el derecho constitucional que tiene toda persona 
    	a conocer, actualizar y rectificar todo  tipo de información y que haya sido objeto de recolección en 
    	base de datos o archivos de entidades públicas o privadas.<br />
      Soy responsable del tratamiento de datos personales recolectados con ocasión de la prestación de servicios 
      en salud ocupacional, se da a conocer a sus clientes y pacientes, la importancia del proceso dando 
      cumplimiento a las disposiciones legales vigentes garantizando la confidencialidad de la información 
      registrada en la historia clínica y sus anexos.<br />
      Como son datos sensibles, no se realiza el tratamientos de estos datos para fines diferentes a los 
      establecido por la legislación vigente, estos pueden ser conocidos por terceros con previa 
      autorización del paciente o en los casos provistos por la ley.</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td>IX. CONSENTIMIENTO INFORMADO.</td>
  </tr>
  <tr>
    <td>Yo ___________________________ con documento de identificación No ______________________ en 
    	calidad de paciente/usuario previamente informado acepto que la información suministrada 
    	en esta historia clinica sea empleada estrictamente en salud ocupacional.
    	<br />
      Además certifico que he sido informado (a) a cerca de la naturaleza y propósito de estos exámenes, 
      entiendo que la realización de los mismos es voluntaria y tuve la oportunidad de retirar mi 
      consentimiento en cualquier momento, certifico que las respuestas son verídicas. 
      <br><br>Este documento es estrictamente confidencial.
    </td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="0" cellspacing="0" width="100%" style="font-family: Mono; font-size: 9pt;">
  <tr>
    <td style="text-align:left">Firma del Paciente:</td>
    <td style="text-align:center">Huella índice derecho</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:left; height:70px" width="70%">_______________________________________________________</td>
    <td style="text-align:left; border:1; height:70px"></td>
    <td style="text-align:center" width="10%"></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
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
$nombre_archivo = 'CONSENTIMIENTO_INFORMADO_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
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