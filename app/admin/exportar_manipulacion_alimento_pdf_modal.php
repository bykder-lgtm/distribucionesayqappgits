<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../conexiones/conexione.php';

$cod_manipulacion_alimento           = intval($_POST['cod_manipulacion_alimento']);
$cod_historia_clinica                = intval($_POST['cod_historia_clinica']);
$cod_cliente                         = intval($_POST['cod_cliente']);
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
$obtener_manipulacion_alimento = "SELECT * FROM tbl15_manipulacion_alimento WHERE cod_manipulacion_alimento = '".($cod_manipulacion_alimento)."'";
$consultar_manipulacion_alimento = mysqli_query($conectar, $obtener_manipulacion_alimento) or die(mysqli_error($conectar));
$info_manipulacion_alimento= mysqli_fetch_assoc($consultar_manipulacion_alimento);

$cod_cliente                          = $info_manipulacion_alimento['cod_cliente'];
$cod_administrador                    = $info_manipulacion_alimento['cod_administrador'];
$motivo_manipulacion_alimento         = $info_manipulacion_alimento['motivo_manipulacion_alimento'];
$ant_tos_expectora                    = $info_manipulacion_alimento['ant_tos_expectora'];
$ant_fiebre_febricula                 = $info_manipulacion_alimento['ant_fiebre_febricula'];
$ant_lesion_piel_unyas                = $info_manipulacion_alimento['ant_lesion_piel_unyas'];
$ant_piel_ojos_amarillos              = $info_manipulacion_alimento['ant_piel_ojos_amarillos'];
$ant_purito                           = $info_manipulacion_alimento['ant_purito'];
$rec_piel                             = $info_manipulacion_alimento['rec_piel'];
$rec_unyas                            = $info_manipulacion_alimento['rec_unyas'];
$rec_mucosa                           = $info_manipulacion_alimento['rec_mucosa'];
$rec_aparato_gastro                   = $info_manipulacion_alimento['rec_aparato_gastro'];
$rec_extemidad                        = $info_manipulacion_alimento['rec_extemidad'];
$rec_obser                            = $info_manipulacion_alimento['rec_obser'];
$resexalab_cult_faringeo              = $info_manipulacion_alimento['resexalab_cult_faringeo'];
$resexalab_koh_cult_unyas             = $info_manipulacion_alimento['resexalab_koh_cult_unyas'];
$resexalab_bk_seriado                 = $info_manipulacion_alimento['resexalab_bk_seriado'];
$resexalab_observ                     = $info_manipulacion_alimento['resexalab_observ'];
$resexalab_nombre_lab_clinico         = $info_manipulacion_alimento['resexalab_nombre_lab_clinico'];
$resexalab_nombre_bacteriologo        = $info_manipulacion_alimento['resexalab_nombre_bacteriologo'];
$resexalab_numero_tajeta              = $info_manipulacion_alimento['resexalab_numero_tajeta'];
$concepto_manipulador                 = $info_manipulacion_alimento['concepto_manipulador'];
$concepto_tratamiento_manipulador     = $info_manipulacion_alimento['concepto_tratamiento_manipulador'];
$concepto_descrip_tratamiento         = $info_manipulacion_alimento['concepto_descrip_tratamiento'];
$concepto_requiere_reubicado          = $info_manipulacion_alimento['concepto_requiere_reubicado'];
$concepto_fecha_cntl_medi             = $info_manipulacion_alimento['concepto_fecha_cntl_medi'];
$control_medico_dia                   = $info_manipulacion_alimento['control_medico_dia'];
$control_medico_mes                   = $info_manipulacion_alimento['control_medico_mes'];
$control_medico_anyo                  = $info_manipulacion_alimento['control_medico_anyo'];
$afiliacion_eps                       = $info_manipulacion_alimento['afiliacion_eps'];
$afiliacion_ars                       = $info_manipulacion_alimento['afiliacion_ars'];
$fecha_mes                            = $info_manipulacion_alimento['fecha_mes'];
$fecha_anyo                           = $info_manipulacion_alimento['fecha_anyo'];
$fecha_ymd_hora                       = $info_manipulacion_alimento['fecha_ymd'];
$fecha_dmy                            = $info_manipulacion_alimento['fecha_dmy'];
$fecha_time                           = $info_manipulacion_alimento['fecha_time'];
$fecha_reg_time                       = $info_manipulacion_alimento['fecha_reg_time'];
$cuenta                               = $info_manipulacion_alimento['cuenta'];
$cuenta_reg                           = $info_manipulacion_alimento['cuenta_reg'];
$fecha_hora                           = date("H:i", $fecha_time);
$cod_grupo_area                       = $info_manipulacion_alimento['cod_grupo_area'];
$cod_grupo_area_cargo                 = $info_manipulacion_alimento['cod_grupo_area_cargo'];
$costo_motivo_consulta                = $info_manipulacion_alimento['costo_motivo_consulta'];
$cod_factura                          = $info_manipulacion_alimento['cod_factura'];
$nombre_ocupacion                     = $info_manipulacion_alimento['nombre_ocupacion'];
$nombre_empresa                       = $info_manipulacion_alimento['nombre_empresa'];
$cargo_empresa                        = $info_manipulacion_alimento['cargo_empresa'];
$area_empresa                         = $info_manipulacion_alimento['area_empresa'];
$ciudad_empresa                       = $info_manipulacion_alimento['ciudad_empresa'];
$nombre_empresa_contratante           = $info_manipulacion_alimento['nombre_empresa_contratante'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_estructura_manipulacion_alimento = "SELECT nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, motivo, cod_cliente,  
cod_administrador, nombre_arl, nombre_tipo_regimen FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_manipulacion_alimento = mysqli_query($conectar, $obtener_estructura_manipulacion_alimento) or die(mysqli_error($conectar));
$info_estructura_manipulacion_alimento= mysqli_fetch_assoc($consultar_estructura_manipulacion_alimento);
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
$nombres_completos                   = "CERTIFICADO DE MANIPULACION DE ALIMENTOS-".$nombres_cli.'_'.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_manipulacion_alimento;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
require_once('../admin/tcpdf/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'Legal', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Miguel Caro');
$pdf->SetTitle('Reporte');

$pdf->setPrintHeader(false); 
$pdf->setPrintFooter(TRUE);
$pdf->SetMargins(20, 10, 20, 20); 
$pdf->SetAutoPageBreak(true, 20); 
$pdf->SetFont('Helvetica', '', 10);
$pdf->addPage();

$codigoHTML = '';

$codigoHTML .= '
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
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>&nbsp; 1. IDENTIFICACION DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td>1.1 </td>
    <td colspan="3">Apellidos: '.$apellido1_cli.'</td>
    <td>1.2 </td>
    <td colspan="2">Nombres: '.$nombres_cli.'</td>
  </tr>
  <tr>
    <td>1.3 </td>
    <td colspan="3">Tipo de documento: '.$nombre_tipo_doc.'</td>
    <td>1.4 </td>
    <td colspan="2">Numero documento: '.$cedula.'</td>
  </tr>
  <tr>
    <td>1.5 </td>
    <td>Sexo: </td>
    <td colspan="2">
        <table border="0" cellspacing="0" cellpadding="0" align="left">
          <tr>
            <td>&nbsp;&nbsp;'.$nombre_sexo.'&nbsp;&nbsp;</td>
          </tr>
      </table></td>
    <td>1.6 </td>
    <td colspan="2">Edad: '.$edad_anyo.' Años</td>
  </tr>

 <tr>
    <td></td>
    <td colspan="3">Motivo Consulta: '.$motivo_manipulacion_alimento.'</td>
    <td></td>
    <td colspan="2"></td>
  </tr>

  <tr>
    <td>1.7 </td>
    <td colspan="2">Afiliación EPS: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;&nbsp;'.$afiliacion_eps.'&nbsp;&nbsp;</td></tr></table></td>
    <td>1.8 </td>
    <td>Régimen: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;'.$nombre_tipo_regimen.'&nbsp;</td></tr></table></td>
  </tr>
  <tr>
    <td>1.9 </td>
    <td colspan="6">Nombre Empresa: &nbsp;'.$nombre_entidad.'&nbsp;</td>
  </tr>

   <tr>
    <td>1.10 </td>
    <td colspan="2">Afiliación ARL: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;&nbsp;'.$afiliacion_ars.'&nbsp;&nbsp;</td></tr></table></td>
    <td>1.11 </td>
    <td>Nombre aseguradora: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;'.$nombre_arl.'&nbsp;</td></tr></table></td>
  </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  <tr>
    <td>1.12 </td>
    <td colspan="6">Dirección residencia: '.$lugar_residencia.'</td>
  </tr>
  <tr>
    <td>1.13 </td>
    <td colspan="3">Barrio: '.$direccion.'</td>
    <td>1.14 </td>
    <td colspan="2">Teléfonos: '.$tel_cliente.'</td>
  </tr>
  <tr>
    <td>1.15 </td>
    <td colspan="6">Nombre del establecimiento donde labora:  '.$nombre_empresa.'</td>
  </tr>
  <tr>
    <td>1.16 </td>
    <td colspan="6">Dirección establecimiento: '.$direccion_empresa.'</td>
  </tr>
  <tr>
    <td>1.17 </td>
    <td colspan="3">Barrio: '.$direccion_empresa.'</td>
    <td>1.18 </td>
    <td colspan="2">Teléfonos: '.$telefono_empresa.'</td>
  </tr>
  <tr>
    <td>1.19 </td>
    <td colspan="3">Cargo que desempeña: '.$cargo_empresa.'</td>
    <td>1.20 </td>
    <td colspan="2">Área de trabajo: '.$area_empresa.'</td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>2. ANTECEDENTES INFECCIOSOS DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td colspan="6">El paciente ha presentado alguno de los siguientes síntomas en los últimos 15 o más días: </td>
    <td></td>
  </tr>
  <tr>
    <td>Tos con expectoración</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$ant_tos_expectora.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Fiebre o febrículas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$ant_fiebre_febricula.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Lesiones en piel o uñas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$ant_lesion_piel_unyas.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td></td>
  </tr>
  <tr>
    <td>Piel y ojos amarillos </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$ant_piel_ojos_amarillos.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Prurito</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$ant_purito.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>3. RECONOCIMIENTO MEDICO DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td rowspan="3">3.1 </td>
    <td colspan="6">Datos positivos al examen físico del manipulador de alimentos: </td>
  </tr>
  <tr>
    <td>Piel</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$rec_piel.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Uñas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$rec_unyas.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Mucosas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$rec_mucosa.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>Aparato gastrointestinal</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$rec_aparato_gastro.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Extremidades</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$rec_extemidad.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">Observaciones: '.$rec_obser.'</td>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>4. RESULTADOS DE EXAMENES DE LABORATORIO </strong></td>
  </tr>
  <tr>
    <td rowspan="3">4.1 </td>
    <td colspan="6">Exámenes clínicos del manipulador de alimentos:<strong> </strong></td>
  </tr>
  <tr>
    <td >Cultivo faríngeo</td>
    <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$resexalab_cult_faringeo.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">KOH + cultivo uñas negativo</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$resexalab_koh_cult_unyas.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">BK Seriado (en caso de sintomático respiratorio)</td>
    <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$resexalab_bk_seriado.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">Observaciones: '.$resexalab_observ.'</td>
  </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  <tr>
    <td>4.2 </td>
    <td colspan="6">Nombre del tbl15_laboratorio clínico: '.$resexalab_nombre_lab_clinico.'</td>
  </tr>
  <tr>
    <td>4.3 </td>
    <td colspan="6">Nombre y apellido del bacteriólogo que realizo el análisis: '.$resexalab_nombre_bacteriologo.'</td>
  </tr>
  <tr>
    <td>4.4 </td>
    <td colspan="6">Número de tarjeta profesional: '.$resexalab_numero_tajeta.'</td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="3"><strong>5. CONCEPTO MEDICO Y TRATAMIENTO</strong></td>
  </tr>
  <tr>
    <td>5.1</td>
    <td>Concepto médico del manipulador de alimentos: </td>
    <td ><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$concepto_manipulador.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.2</td>
    <td>El manipulador de alimentos requiere tratamiento: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$concepto_tratamiento_manipulador.'&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  <tr>
    <td>5.3</td>
    <td colspan="2">Descripción tratamiento: '.$concepto_descrip_tratamiento.'</td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
';
$obtener_medicamento_formulado = "SELECT * FROM tbl15_medicamento_formulado WHERE cod_manipulacion_alimento = '".($cod_manipulacion_alimento)."'";
$consultar_medicamento_formulado = mysqli_query($conectar, $obtener_medicamento_formulado) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_medicamento_formulado);

$coluna_anidad = 3 + $total_datos;
$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
<thead>
<tr>
    <td style="text-align:center" rowspan="'.$coluna_anidad.'">5.4 </td>
    <td style="text-align:center" rowspan="'.$coluna_anidad.'">Medicamentos formulados: </td>
    <td style="text-align:center" rowspan="2">Nombre genérico</td>
    <td style="text-align:center" rowspan="2">Concentración</td>
    <td style="text-align:center" rowspan="2">Forma farmacéutica</td>
    <td style="text-align:center" rowspan="2">Dosis/vía de administración</td>
    <td style="text-align:center" colspan="2">Cantidad prescrita</td>
</tr>
  <tr>
    <td>En Números</td>
    <td>En letras</td>
  </tr>
</thead>
<tbody>';
while ($info_medicamento_formulado = mysqli_fetch_assoc($consultar_medicamento_formulado)) {
$cod_medicamento_formulado       = $info_medicamento_formulado['cod_medicamento_formulado'];
$nombre_generico                 = $info_medicamento_formulado['nombre_generico'];
$concentracion                   = $info_medicamento_formulado['concentracion'];
$forma_farmaceutica              = $info_medicamento_formulado['forma_farmaceutica'];
$dosis                           = $info_medicamento_formulado['dosis'];
$cantidad_numero                 = $info_medicamento_formulado['cantidad_numero'];
$cantidad_letra                  = $info_medicamento_formulado['cantidad_letra'];
$codigoHTML.='
<tr>
<td>'.$nombre_generico.'</td>
<td>'.$concentracion.'</td>
<td>'.$forma_farmaceutica.'</td>
<td>'.$dosis.'</td>
<td>'.$cantidad_numero.'</td>
<td>'.$cantidad_letra.'</td>
</tr>';
} 
$codigoHTML.='
</tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td>5.5</td>
    <td colspan="2">El manipulador requiere ser reubicado    temporalmente fuera del área de alimentos:</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;'.$concepto_requiere_reubicado.'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.6</td>
    <td>Fecha control médico: </td>
    <td colspan="2"><div align="center">
      <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;&nbsp;DIA&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;'.$control_medico_dia.'&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;MES&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;'.$control_medico_mes.'&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;AÑO&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;'.$control_medico_anyo.'&nbsp;&nbsp;</td>
        </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
      </table>
    </div></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="4" valign="top"><strong>6. DATOS MEDICO TRATANTE</strong></td>
  </tr>
  <tr>
    <td><p>6.1 </p></td>
    <td><p>Firma: <img src="'.$propietario_url_firma_emp.'" height="60px"/></p></td>
    <td><p>6.2 </p></td>
    <td><p>Nombre y apellido: '.$propietario_nombres_apellidos_emp.'</p></td>
  </tr>
  <tr>
    <td><p>6.3 </p></td>
    <td><p>Tipo de documento: CC</p></td>
    <td><p>6.3 </p></td>
    <td><p>Número de documento: '.$propietario_nit_emp.'</p></td>
  </tr>
  <tr>
    <td><p>6.5 </p></td>
    <td><p>Registro medico: '.$reg_medico_emp.'</p></td>
    <td><p>6.6 </p></td>
    <td><p>Institución donde labora: '.$direccion_emp.'</p></td>
  </tr>
  <tr>
    <td><p>6.7 </p></td>
    <td><p>Dirección: '.$direccion_emp.'</p></td>
    <td><p>6.8 </p></td>
    <td><p>Teléfono: '.$telefono_emp.'</p></td>
  </tr>
</table>
</body>
</html>
';

$nombre_archivo = 'reporte_venta_'.$cod_manipulacion_alimento.'.pdf';
$pdf->writeHTML($codigoHTML, true, 0, true, 0);
$pdf->lastPage();
$pdf->output('../archivador/pdf/'.$nombre_archivo, 'F');
?>