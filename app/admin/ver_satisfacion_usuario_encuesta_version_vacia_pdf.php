<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

if (isset($_GET['cod_satisfacion_usuario_encuesta'])) { $cod_tbl15_satisfacion_usuario_encuesta= intval($_GET['cod_satisfacion_usuario_encuesta']); } else { $cod_tbl15_satisfacion_usuario_encuesta= 0;	}
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
$obtener_tbl15_satisfacion_usuario_encuesta= "SELECT * FROM tbl15_tbl15_satisfacion_usuario_encuestaWHERE cod_tbl15_satisfacion_usuario_encuesta= '".($cod_satisfacion_usuario_encuesta)."'";
$consultar_tbl15_satisfacion_usuario_encuesta= mysqli_query($conectar, $obtener_satisfacion_usuario_encuesta) or die(mysqli_error($conectar));
$info_satisfacion_usuario_encuesta= mysqli_fetch_assoc($consultar_satisfacion_usuario_encuesta);

$cod_cliente                          = $info_satisfacion_usuario_encuesta['cod_cliente'];
$cod_administrador                    = $info_satisfacion_usuario_encuesta['cod_administrador'];

$cod_sede                             = $info_satisfacion_usuario_encuesta['cod_sede'];
$calif_serv_global                    = $info_satisfacion_usuario_encuesta['calif_serv_global'];
$examedic_experiencia_servicio        = $info_satisfacion_usuario_encuesta['examedic_experiencia_servicio'];
$audiomet_experiencia_servicio        = $info_satisfacion_usuario_encuesta['audiomet_experiencia_servicio'];
$optomet_experiencia_servicio         = $info_satisfacion_usuario_encuesta['optomet_experiencia_servicio'];
$visiomet_experiencia_servicio        = $info_satisfacion_usuario_encuesta['visiomet_experiencia_servicio'];
$espiro_experiencia_servicio          = $info_satisfacion_usuario_encuesta['espiro_experiencia_servicio'];
$osteomusc_experiencia_servicio       = $info_satisfacion_usuario_encuesta['osteomusc_experiencia_servicio'];
$vacunacion_experiencia_servicio      = $info_satisfacion_usuario_encuesta['vacunacion_experiencia_servicio'];
$labclinic_experiencia_servicio       = $info_satisfacion_usuario_encuesta['labclinic_experiencia_servicio'];
$recep_experiencia_servicio           = $info_satisfacion_usuario_encuesta['recep_experiencia_servicio'];
$otros_experiencia_servicio           = $info_satisfacion_usuario_encuesta['otros_experiencia_servicio'];
$comentario_suger                     = $info_satisfacion_usuario_encuesta['comentario_suger'];
$nombre_recomend_ips                  = $info_satisfacion_usuario_encuesta['nombre_recomend_ips'];
$tel_contacto1                        = $info_satisfacion_usuario_encuesta['tel_contacto1'];
$correo_contacto1                     = $info_satisfacion_usuario_encuesta['correo_contacto1'];

$fecha_mes                            = $info_satisfacion_usuario_encuesta['fecha_mes'];
$fecha_anyo                           = $info_satisfacion_usuario_encuesta['fecha_anyo'];
$fecha_ymd                            = $info_satisfacion_usuario_encuesta['fecha_ymd'];
$fecha_dmy                            = $info_satisfacion_usuario_encuesta['fecha_dmy'];
$fecha_hora                            = $info_satisfacion_usuario_encuesta['fecha_hora'];

$fecha_time                           = $info_satisfacion_usuario_encuesta['fecha_time'];
$fecha_reg_time                       = $info_satisfacion_usuario_encuesta['fecha_reg_time'];
$cuenta                               = $info_satisfacion_usuario_encuesta['cuenta'];
$cuenta_reg                           = $info_satisfacion_usuario_encuesta['cuenta_reg'];
$nombre_empresa                       = $info_satisfacion_usuario_encuesta['nombre_empresa'];

$dia                                  = date("d", strtotime($fecha_ymd));
$mes                                  = date("m", strtotime($fecha_ymd));
$anyo                                 = date("Y", strtotime($fecha_ymd));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, nombre_sexo, url_img_firma_min AS url_img_firma_min_cli, direccion, lugar_residencia,
tel_cliente, cod_entidad, fecha_nac_ymd, nombre_arl, nombre_tipo_regimen FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres                             = $info_cliente['nombres'];
$apellido1                           = $info_cliente['apellido1'];
$apellido2                           = $info_cliente['apellido2'];
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
$nom_ape                             = $nombres.' '.$apellido1.' '.$apellido2;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '".($cod_entidad)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];
$nombres_completos                   = "ENCUESTA DE SATISFACION AL USUARIO";
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');
$margen_izq                          = '10';
$margen_der                          = '10';
$margen_inf_encabezado               = '20';
$margen_sup_encabezado               = '5';
$posicion_sup_encabezado             = '5';
$posicion_inf_encabezado             = '20';

$titulo_doc_pdf                      = $nombres_completos;
$autor_doc_pdf                       = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                     = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                        = "ENCUESTA DE SATISFACION AL USUARIO";
$palabras_claves_doc_pdf             = "ENCUESTA DE SATISFACION AL USUARIO";
$cod_satisfacion_usuario_encuesta_strpad    = str_pad($cod_satisfacion_usuario_encuesta, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf = new mPDF('c','Legal');
$mpdf                                = new mPDF('c','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center"><strong>ENCUESTA DE SATISFACIÓN AL USUARIO<strong></td>
    <td width="25%" align="center"><barcode code="'.$cod_satisfacion_usuario_encuesta_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">CESU: '.$cod_satisfacion_usuario_encuesta_strpad.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center"><strong>ENCUESTA DE SATISFACIÓN AL USUARIO<strong></td>
    <td width="25%" align="center"><barcode code="'.$cod_satisfacion_usuario_encuesta_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">CESU: '.$cod_satisfacion_usuario_encuesta_strpad.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
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
<br><br>
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:center">AGRADECEMOS SU OPINION, VITAL PARA NUESTRO MEJORAMIENTO CONTINUO.</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td rowspan="2" style="text-align:center">FECHA:</td>
    <td style="text-align:center">DIA</td>
    <td style="text-align:center">MES</td>
    <td style="text-align:center">AÑO</td>
    <td rowspan="2" style="text-align:center; width:60%"></td>
  </tr>
  <tr>
    <td style="text-align:left">.</td>
    <td style="text-align:left">.</td>
    <td style="text-align:left">.</td>
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">1. ¿Cómo calificaria su expreriencia global respecto a los servicios que ha recibido?</td>
  </tr>
</table>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:center; width:10%">'.$nombre_experiencia_servicio.'</td>';
}
$codigoHTML .= '
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="2" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">2. Por favor califique los servicios realizados</td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:center; width:40%"><strong>SERVICIO</strong></td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:center"><strong>'.$nombre_experiencia_servicio.'</strong></td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">EXAMEN MÉDICO</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">AUDIOMETRÍA</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">OPTOMETRÍA</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">VISIOMETRÍA</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">ESPEROMETRÍA</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">OSTEMUSCULAR</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">VACUNACIÓN</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">LABORATORIO CLÍNICO</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">RECEPCIÓN</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
  <tr>
    <td style="text-align:left">OTROS</td>
';
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_experiencia_servicio = $datos2['nombre_experiencia_servicio']; 
$codigoHTML .= '
    <td style="text-align:left; width:15%">.</td>';
}
$codigoHTML .= '
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">3. ¿Tiene alguna sugerencia y/o comentario?</td>
  </tr>
  <tr>
    <td style="text-align:left; height:100px">
    ________________________________________________________________________________________________________
    <br>
    ________________________________________________________________________________________________________
    <br>
    ________________________________________________________________________________________________________
    </td>
  </tr>
</table>
<br>

<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left; width:45%">4. ¿Recomendaria a sus familiares y amigos este consultorio?</td>
';
$consulta2_sql = ("SELECT cod_recomendacion_fam_amigos, nombre_recomendacion_fam_amigos FROM tbl15_recomendacion_fam_amigos ORDER BY cod_recomendacion_fam_amigos ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_reg = mysqli_num_rows($consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {

$nombre_recomendacion_fam_amigos = $datos2['nombre_recomendacion_fam_amigos']; 
$codigoHTML .= '
    <td style="text-align:center">'.$nombre_recomendacion_fam_amigos.'</td>';
}
$codigoHTML .= '
  </tr>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left"><strong>Apreciado usuario: </strong>en caso de requerir respuesta a su comentario y/o sugerencia por favor diligencie los siguientes datos</td>
  </tr>
</table>

<br>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">Nombre del paciente: </td>
  </tr>
  <tr>
    <td style="text-align:left">Cedula: '.$cedula.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono de contacto: '.$tel_contacto1.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Email: '.$correo_contacto1.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Empresa remitente: '.$nombre_empresa.'</td>
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
$nombre_archivo = 'ENCUESTA_SATISFACION_USUARIO.pdf';
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