<?php 
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_dia_mes_anyo.php');

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//$cuenta_actual = addslashes($_SESSION['usuario']);

$fecha_ini                                                  = addslashes($_GET['fecha_ini']);
$fecha_fin                                                  = addslashes($_GET['fecha_fin']);
$nombre_empresa_contratante                                             = addslashes($_GET['nombre_empresa_contratante']);
$total_motivo                                               = intval($_GET['total_motivo']);
$total_muestra                                              = intval($_GET['total_muestra']);
$cuenta                                                     = addslashes($_GET['cuenta']);
$fecha                                                      = addslashes($_GET['fecha']);

$cuenta_actual                                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                                                = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                                              = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                                            = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                                                 = $info_empresa_data['titulo'];
$nombre_emp                                                 = $info_empresa_data['nombre'];
$eslogan_emp                                                = $info_empresa_data['eslogan'];
$direccion_emp                                              = $info_empresa_data['direccion'];
$ciudad_emp                                                 = $info_empresa_data['ciudad'];
$correo_emp                                                 = $info_empresa_data['correo'];
$img_cabecera_emp                                           = $info_empresa_data['img_cabecera'];
$telefono_emp                                               = $info_empresa_data['telefono'];
$info_legal_emp                                             = $info_empresa_data['info_legal'];
$propietario_nombres_apellidos_emp                          = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                        = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                            = $info_empresa_data['nit_empresa'];
$cabecera_emp                                               = $info_empresa_data['cabecera'];
$icono_emp                                                  = $info_empresa_data['icono'];
$nombre_font_emp                                            = $info_empresa_data['nombre_font'];
$tamano_font_hc_emp                                         = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp                                     = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp                                   = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp                                 = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_informe_emp                                    = $info_empresa_data['tamano_font_informe'];
$tamano_font_remision_emp                                   = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp                                    = $info_empresa_data['tamano_font_factura'];
$departamento_emp                                           = $info_empresa_data['departamento'];
$localidad_emp                                              = $info_empresa_data['localidad'];
$reg_medico_emp                                             = $info_empresa_data['reg_medico'];
$regimen_emp                                                = $info_empresa_data['regimen'];
$propietario_url_firma_emp                                  = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                             = $info_empresa_data['fecha_time'];
$licencia_emp                                               = $info_empresa_data['licencia'];
$info_histclinic_emp                                        = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                        = $info_empresa_data['info_aptlaboral'];

$serguridad_pagina                                          = 1; 
$fecha_hoy_ymd_seg                                          = strtotime(date("Y/m/d"));

$fecha_time_ini                                             = strtotime($fecha_ini);
$fecha_time_fin                                             = strtotime($fecha_fin);
$fecha_ini_ymd                                              = date("Y_m_d", $fecha_time_ini);
$fecha_fin_ymd                                              = date("Y_m_d", $fecha_time_fin);
$fecha_ini_esp                                              = fecha_en_espanol_dia_mes_anyo($fecha_time_ini);
$fecha_fin_esp                                              = fecha_en_espanol_dia_mes_anyo($fecha_time_fin);
$nombre_empresa_contratante_limpia                                      = str_replace(' ', '_', $nombre_empresa_contratante);

$fecha_time                                                 = time();
$fecha_ymd                                                  = date("Y/m/d", $fecha_time);
$fecha_dmy                                                  = date("d/m/Y", $fecha_time);
$fecha_mes                                                  = date("m/Y", $fecha_time);
$fecha_anyo                                                 = date("Y", $fecha_time);
$hora                                                       = date("H:i", $fecha_time);
$fecha_reg_time                                             = time();
$cuenta                                                     = $cuenta_actual;
$cuenta_reg                                                 = $cuenta_actual;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
if ($total_motivo==1) { $motivo = addslashes($_GET['motivo']); $nombre_motivo = $motivo; $motivos = "(motivo='".$motivo."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."')"; }
elseif ($total_motivo==2) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $nombre_motivo = $motivo.' Y '.$motivo2; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."')"; }
elseif ($total_motivo==3) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $nombre_motivo = $motivo.', '.$motivo2.' Y '.$motivo3; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."')"; }
elseif ($total_motivo==4) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.' Y '.$motivo4; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."')"; }
elseif ($total_motivo==5) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.' Y '.$motivo5; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."')"; }
elseif ($total_motivo==6) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.' Y '.$motivo6; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo6."')"; }
elseif ($total_motivo==7) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.' Y '.$motivo7; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."')"; }
elseif ($total_motivo==8) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.' Y '.$motivo8; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."')"; }
elseif ($total_motivo==9) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.' Y '.$motivo9; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."')"; }
elseif ($total_motivo==10) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $motivo10 = addslashes($_GET['motivo10']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.' Y '.$motivo10; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."')"; }
elseif ($total_motivo==11) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $motivo10 = addslashes($_GET['motivo10']); $motivo11 = addslashes($_GET['motivo11']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.' Y '.$motivo11; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."')"; }
elseif ($total_motivo==12) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $motivo10 = addslashes($_GET['motivo10']); $motivo11 = addslashes($_GET['motivo11']); $motivo12 = addslashes($_GET['motivo12']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.',  '.$motivo11.' Y '.$motivo12; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."' OR (motivo='".$motivo12."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."' OR (tbl15_historia_clinica.motivo='".$motivo12."')"; }
elseif ($total_motivo==13) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $motivo10 = addslashes($_GET['motivo10']); $motivo11 = addslashes($_GET['motivo11']); $motivo12 = addslashes($_GET['motivo12']); $motivo13 = addslashes($_GET['motivo13']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.',  '.$motivo11.', '.$motivo12.' Y '.$motivo13; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."' OR (motivo='".$motivo12."' OR (motivo='".$motivo13."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."' OR (tbl15_historia_clinica.motivo='".$motivo12."') OR (tbl15_historia_clinica.motivo='".$motivo13."')"; }
elseif ($total_motivo==14) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $motivo10 = addslashes($_GET['motivo10']); $motivo11 = addslashes($_GET['motivo11']); $motivo12 = addslashes($_GET['motivo12']); $motivo13 = addslashes($_GET['motivo13']); $motivo14 = addslashes($_GET['motivo14']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.',  '.$motivo11.', '.$motivo12.', '.$motivo13.' Y '.$motivo14; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."' OR (motivo='".$motivo12."' OR (motivo='".$motivo13."') OR (motivo='".$motivo14."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."' OR (tbl15_historia_clinica.motivo='".$motivo12."') OR (tbl15_historia_clinica.motivo='".$motivo13."') OR (tbl15_historia_clinica.motivo='".$motivo14."')"; }
elseif ($total_motivo==15) { $motivo = addslashes($_GET['motivo']); $motivo2 = addslashes($_GET['motivo2']); $motivo3 = addslashes($_GET['motivo3']); $motivo4 = addslashes($_GET['motivo4']); $motivo5 = addslashes($_GET['motivo5']); $motivo6 = addslashes($_GET['motivo6']); $motivo7 = addslashes($_GET['motivo7']); $motivo8 = addslashes($_GET['motivo8']); $motivo9 = addslashes($_GET['motivo9']); $motivo10 = addslashes($_GET['motivo10']); $motivo11 = addslashes($_GET['motivo11']); $motivo12 = addslashes($_GET['motivo12']); $motivo13 = addslashes($_GET['motivo13']); $motivo14 = addslashes($_GET['motivo14']); $motivo15 = addslashes($_GET['motivo15']); $nombre_motivo = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.',  '.$motivo11.', '.$motivo12.', '.$motivo13.', '.$motivo14.' Y '.$motivo15; $motivos = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."' OR (motivo='".$motivo12."' OR (motivo='".$motivo13."') OR (motivo='".$motivo14."') OR (motivo='".$motivo15."')"; $motivos_ = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."' OR (tbl15_historia_clinica.motivo='".$motivo12."') OR (tbl15_historia_clinica.motivo='".$motivo13."') OR (tbl15_historia_clinica.motivo='".$motivo14."') OR (tbl15_historia_clinica.motivo='".$motivo15."')"; }
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion, motivo FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (cod_estado_facturacion=1) AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos)) GROUP BY cod_estado_facturacion";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion, motivo FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND ((cod_estado_facturacion)=2) AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos)) GROUP BY cod_estado_facturacion";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$poblacion_eval              = $datos1['conteo_estado_facturacion'];
$poblacion_no_eval           = $datos2['conteo_estado_facturacion'];
$total_poblacion             = $poblacion_eval + $poblacion_no_eval;

$ptj_cobertura               = ($poblacion_eval / $total_muestra) * 100;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_nombre_sexo, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.motivo
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos_) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND ((tbl15_cliente.nombre_sexo)='M'))
GROUP BY tbl15_cliente.nombre_sexo";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2= "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_nombre_sexo, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.motivo
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos_) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND ((tbl15_cliente.nombre_sexo)='F'))
GROUP BY tbl15_cliente.nombre_sexo";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$sexo_masculino         = $datos1['conteo_nombre_sexo'];
$sexo_femenino          = $datos2['conteo_nombre_sexo'];
$total_smtr_sexo             = $sexo_masculino + $sexo_femenino;

if ($sexo_masculino > $sexo_femenino) {
$sexo_txt = 'MASCULINO';
$porcentaje_sexo = ($sexo_masculino / $total_smtr_sexo) * 100;
} else {
$sexo_txt = 'FEMENINO';
$porcentaje_sexo = ($sexo_femenino / $total_smtr_sexo) * 100;
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT tbl15_historia_clinica.fecha_ymd, tbl15_cliente.fecha_nac_time, 
tbl15_cliente.fecha_nac_ymd, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.motivo
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
HAVING ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos_) AND (tbl15_historia_clinica.cod_estado_facturacion=1))";
$result1 = mysqli_query($conectar, $query1);

$conteo1              = 0;
$conteo2              = 0;
$conteo3              = 0;
$conteo4              = 0;
$conteo5              = 0;
$total_edad_20_00     = 0;
$total_edad_20_29     = 0;
$total_edad_30_39     = 0;
$total_edad_40_49     = 0;
$total_edad_50_00     = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$fecha_nac_time       = $dato01['fecha_nac_time'];
$diferencia_edad      = abs($fecha_hoy_ymd_seg - $fecha_nac_time);
$edad_anyo            = floor($diferencia_edad / (365*24*60*60));

if (($edad_anyo < 20))                        {   $total_edad_20_00   = $total_edad_20_00 + 1;  }
if (($edad_anyo >= 20) && ($edad_anyo <= 29)) {   $total_edad_20_29   = $total_edad_20_29 + 1;  }
if (($edad_anyo >= 30) && ($edad_anyo <= 39)) {   $total_edad_30_39   = $total_edad_30_39 + 1;  }
if (($edad_anyo >= 40) && ($edad_anyo <= 49)) {   $total_edad_40_49   = $total_edad_40_49 + 1;  }
if (($edad_anyo >= 50))                       {   $total_edad_50_00   = $total_edad_50_00 + 1;  }
}
$vector_edad             = array($total_edad_20_00, $total_edad_20_29, $total_edad_30_39, $total_edad_40_49, $total_edad_50_00);
$rango_mas_valores       = max($vector_edad);
$suma_edad               = array_sum($vector_edad);

for($i=0;$i<count($vector_edad);$i++) {
    if($vector_edad[$i]==$rango_mas_valores) {
        $posicion_indice = $i;
        }
}

$contador = 0;
$ptj_edad_final = 0;

foreach ($vector_edad as &$conteo_vector_edad) {
$contador ++;

        if ($contador == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor 20'; }
        if ($contador == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = '20 - 29'; }
        if ($contador == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = '30 - 39'; }
        if ($contador == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = '40 - 49'; }
        if ($contador == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'MAYOR 50'; }

        if ($ptj_edad > $ptj_edad_final) {
            $ptj_edad_final = $ptj_edad;
            $conteo = $contador;
        }
}
unset($conteo_vector_edad);

        if ($posicion_indice == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor 20'; }
        if ($posicion_indice == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = '20 - 29'; }
        if ($posicion_indice == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = '30 - 39'; }
        if ($posicion_indice == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = '40 - 49'; }
        if ($posicion_indice == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'MAYOR 50'; }
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, dat_ocupa_dura_anyo1, cod_estado_facturacion, nombre_empresa_contratante, motivo FROM tbl15_historia_clinica
HAVING ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1))";
$result1 = mysqli_query($conectar, $query1);

$total_edad_02_00  = 0;
$total_edad_02_05  = 0;
$total_edad_06_10  = 0;
$total_edad_11_15  = 0;
$total_edad_16_20  = 0;
$total_edad_21_00  = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$dat_ocupa_dura_anyo1           = $dato01['dat_ocupa_dura_anyo1'];

if ($dat_ocupa_dura_anyo1 < 2)                                      { $total_edad_02_00 = $total_edad_02_00 + 1; }
if (($dat_ocupa_dura_anyo1 >= 2) && ($dat_ocupa_dura_anyo1 <= 5))   { $total_edad_02_05 = $total_edad_02_05 + 1; }
if (($dat_ocupa_dura_anyo1 >= 6) && ($dat_ocupa_dura_anyo1 <= 10))  { $total_edad_06_10 = $total_edad_06_10 + 1; }
if (($dat_ocupa_dura_anyo1 >= 11) && ($dat_ocupa_dura_anyo1 <= 15)) { $total_edad_11_15 = $total_edad_11_15 + 1; }
if (($dat_ocupa_dura_anyo1 >= 16) && ($dat_ocupa_dura_anyo1 <= 20)) { $total_edad_16_20 = $total_edad_16_20 + 1; }
if (($dat_ocupa_dura_anyo1 >= 21))                                  { $total_edad_21_00 = $total_edad_21_00 + 1; }
}
$vector_edad_distrib             = array($total_edad_02_00, $total_edad_02_05, $total_edad_06_10, $total_edad_11_15, $total_edad_16_20, $total_edad_21_00);
$rango_mas_valores               = max($vector_edad_distrib);

$posicion_indice = 0;
for($i=0;$i<count($vector_edad_distrib);$i++) {
    if($vector_edad_distrib[$i] == $rango_mas_valores) {
        $posicion_indice = $i;
        }
}
if ($posicion_indice == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector_antig = 'Menor de 2 Años'; }
if ($posicion_indice == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector_antig = 'De 2 a 5 Años'; }
if ($posicion_indice == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector_antig = 'De 6 a 10 Años'; }
if ($posicion_indice == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector_antig = 'De 11 a 15 Años'; }
if ($posicion_indice == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector_antig = 'De 16 a 20 Años'; }
if ($posicion_indice == 5) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector_antig = 'Mayor de 20 Años'; }
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(nombre_escolaridad) AS conteo_nombre_escolaridad, nombre_escolaridad, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1)) 
GROUP BY nombre_escolaridad, nombre_empresa_contratante, motivo ORDER BY conteo_nombre_escolaridad DESC";
$result1 = mysqli_query($conectar, $query1);

$contador            = 0;

while ($datos1 = mysqli_fetch_assoc($result1) ) {
$contador++;

$nombre_escolaridad           = $datos1['nombre_escolaridad'];
$conteo_nombre_escolaridad    = $datos1['conteo_nombre_escolaridad'];

if ($contador == 1) { 
$pos1_nombre_escolaridad      = $nombre_escolaridad;
$pos1_conteo_escolaridad      = $conteo_nombre_escolaridad;
$pos1_ptj_escolaridad         = ($pos1_conteo_escolaridad / $total_poblacion) * 100; 
}
if ($contador == 2) { 
$pos2_nombre_escolaridad      = $nombre_escolaridad;
$pos2_conteo_escolaridad      = $conteo_nombre_escolaridad;
$pos2_ptj_escolaridad         = ($pos2_conteo_escolaridad / $total_poblacion) * 100; 
}
if ($contador == 3) { 
$pos3_nombre_escolaridad      = $nombre_escolaridad;
$pos3_conteo_escolaridad      = $conteo_nombre_escolaridad;
$pos3_ptj_escolaridad         = ($pos3_conteo_escolaridad / $total_poblacion) * 100; 
}
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Fuma'))
GROUP BY habit_tox_fum_nofum_exfum";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='No Fuma'))
GROUP BY habit_tox_fum_nofum_exfum";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Exfumador'))
GROUP BY habit_tox_fum_nofum_exfum";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$fuma                        = $dato01['habit_tox_fum_nofum_exfum'];
$nofum                       = $dato02['habit_tox_fum_nofum_exfum'];
$exfum                       = $dato03['habit_tox_fum_nofum_exfum'];
$fuma_ptj                    = ($fuma / $total_poblacion) * 100;
$nofum_ptj                   = ($nofum / $total_poblacion) * 100;
$exfum_ptj                   = ($exfum / $total_poblacion) * 100;

$vector_habitos_extra_lab    = array($fuma, $nofum, $exfum);
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_activfis) AS habit_tox_activfis, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (habit_tox_activfis='Fisicamente activo'))
GROUP BY habit_tox_activfis";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(habit_tox_activfis) AS habit_tox_activfis, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (habit_tox_activfis='Sedentario'))
GROUP BY habit_tox_activfis";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$fisicamente_activo          = $dato01['habit_tox_activfis'];
$sedentario                  = $dato02['habit_tox_activfis'];
$fisicamente_activo_ptj      = ($fisicamente_activo / $total_poblacion) * 100;
$sedentario_ptj              = ($sedentario / $total_poblacion) * 100;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='BAJO PESO'))
GROUP BY exa_fis_interpreimc";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='PESO NORMAL'))
GROUP BY exa_fis_interpreimc";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='SOBREPESO'))
GROUP BY exa_fis_interpreimc";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$query4 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD I'))
GROUP BY exa_fis_interpreimc";
$result4 = mysqli_query($conectar, $query4);
$dato04 = mysqli_fetch_assoc($result4);

$query5 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD II'))
GROUP BY exa_fis_interpreimc";
$result5 = mysqli_query($conectar, $query5);
$dato05 = mysqli_fetch_assoc($result5);

$query6 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD III'))
GROUP BY exa_fis_interpreimc";
$result6 = mysqli_query($conectar, $query6);
$dato06 = mysqli_fetch_assoc($result6);

$query7 = "SELECT fecha_ymd, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD EXTREMA'))
GROUP BY exa_fis_interpreimc";
$result7 = mysqli_query($conectar, $query7);
$dato07 = mysqli_fetch_assoc($result7);

$bajo_peso                  = $dato01['exa_fis_interpreimc'];
$peso_normal                = $dato02['exa_fis_interpreimc'];
$sobreso                    = $dato03['exa_fis_interpreimc'];
$obesidad1                  = $dato04['exa_fis_interpreimc'];
$obesidad2                  = $dato05['exa_fis_interpreimc'];
$obesidad3                  = $dato06['exa_fis_interpreimc'];
$obesidad_extrema           = $dato07['exa_fis_interpreimc'];

$bajo_peso_ptj              = ($bajo_peso / $total_poblacion) * 100;
$peso_normal_ptj            = ($peso_normal / $total_poblacion) * 100;
$sobreso_ptj                = ($sobreso / $total_poblacion) * 100;
$obesidad1_ptj              = ($obesidad1 / $total_poblacion) * 100;
$obesidad2_ptj              = ($obesidad2 / $total_poblacion) * 100;
$obesidad3_ptj              = ($obesidad3 / $total_poblacion) * 100;
$obesidad_extrema_ptj       = ($obesidad_extrema / $total_poblacion) * 100;
$obesidad_total             = $obesidad1_ptj + $obesidad2_ptj + $obesidad3_ptj + $obesidad_extrema_ptj;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(ant_impor_accilab) AS ant_impor_accilab, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND ((ant_impor_accilab)='SI'))
GROUP BY ant_impor_accilab";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(ant_impor_accilab) AS ant_impor_accilab, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND ((ant_impor_accilab)='NO'))
GROUP BY ant_impor_accilab";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$ant_impor_accilab_si                = $dato01['ant_impor_accilab'];
$ant_impor_accilab_no                = $dato02['ant_impor_accilab'];
$ant_impor_accilab_si_ptj            = ($ant_impor_accilab_si / $total_poblacion) * 100;
$ant_impor_accilab_no_ptj            = ($ant_impor_accilab_no / $total_poblacion) * 100;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (enf_lab='SI'))
GROUP BY enf_lab";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1) AND (enf_lab='NO'))
GROUP BY enf_lab";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$enf_lab_si                = $dato01['enf_lab'];
$enf_lab_no                = $dato02['enf_lab'];
$enf_lab_si_ptj            = ($enf_lab_si / $total_poblacion) * 100;
$enf_lab_no_ptj            = ($enf_lab_no / $total_poblacion) * 100;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, 
clasrieg_fis1_ruid, clasrieg_fis1_ilum, clasrieg_fis1_noionic, clasrieg_fis1_vibra,
clasrieg_fis1_tempextrem, clasrieg_fis1_cambpres, clasrieg_quim1_gasvapor, clasrieg_quim1_aeroliq, 
clasrieg_quim1_solid, clasrieg_quim1_liquid, clasrieg_biolog1_viru, clasrieg_biolog1_bacter, 
clasrieg_biolog1_parasi, clasrieg_biolog1_morde, clasrieg_biolog1_picad, clasrieg_biolog1_hongo, 
clasrieg_ergo1_trabestat, clasrieg_ergo1_esfuerfis, clasrieg_ergo1_carga, clasrieg_ergo1_postforz, 
clasrieg_ergo1_movrepet, clasrieg_ergo1_jortrab, clasrieg_psi1_monoto, clasrieg_psi1_relhuman, 
clasrieg_psi1_contentarea, clasrieg_psi1_orgtiemptrab, clasrieg_segur1_mecanic, clasrieg_segur1_electri, 
clasrieg_segur1_locat, clasrieg_segur1_fisiquim, clasrieg_segur1_public, clasrieg_segur1_espconfi, 
clasrieg_segur1_trabaltura, clasrieg_observ1_otro, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica 
HAVING ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1))";
$result1 = mysqli_query($conectar, $query1);

$clasrieg_fis1_ruid__          = 0;
$clasrieg_fis1_ilum__          = 0;
$clasrieg_fis1_noionic__       = 0;
$clasrieg_fis1_vibra__         = 0;
$clasrieg_fis1_tempextrem__    = 0;
$clasrieg_fis1_cambpres__      = 0;
$clasrieg_quim1_gasvapor__     = 0; 
$clasrieg_quim1_aeroliq__      = 0; 
$clasrieg_quim1_solid__        = 0; 
$clasrieg_quim1_liquid__       = 0; 
$clasrieg_biolog1_viru__       = 0; 
$clasrieg_biolog1_bacter__     = 0; 
$clasrieg_biolog1_parasi__     = 0; 
$clasrieg_biolog1_morde__      = 0; 
$clasrieg_biolog1_picad__      = 0; 
$clasrieg_biolog1_hongo__      = 0; 
$clasrieg_ergo1_trabestat__    = 0; 
$clasrieg_ergo1_esfuerfis__    = 0; 
$clasrieg_ergo1_carga__        = 0; 
$clasrieg_ergo1_postforz__     = 0; 
$clasrieg_ergo1_movrepet__     = 0; 
$clasrieg_ergo1_jortrab__      = 0; 
$clasrieg_psi1_monoto__        = 0; 
$clasrieg_psi1_relhuman__      = 0; 
$clasrieg_psi1_contentarea__   = 0; 
$clasrieg_psi1_orgtiemptrab__  = 0; 
$clasrieg_segur1_mecanic__     = 0; 
$clasrieg_segur1_electri__     = 0; 
$clasrieg_segur1_locat__       = 0; 
$clasrieg_segur1_fisiquim__    = 0; 
$clasrieg_segur1_public__      = 0; 
$clasrieg_segur1_espconfi__    = 0; 
$clasrieg_segur1_trabaltura__  = 0; 
$clasrieg_observ1_otro__       = 0; 

while ($datos = mysqli_fetch_assoc($result1)) {

$clasrieg_fis1_ruid          = $datos['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum          = $datos['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic       = $datos['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra         = $datos['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem    = $datos['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres      = $datos['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor     = $datos['clasrieg_quim1_gasvapor']; 
$clasrieg_quim1_aeroliq      = $datos['clasrieg_quim1_aeroliq']; 
$clasrieg_quim1_solid        = $datos['clasrieg_quim1_solid']; 
$clasrieg_quim1_liquid       = $datos['clasrieg_quim1_liquid']; 
$clasrieg_biolog1_viru       = $datos['clasrieg_biolog1_viru']; 
$clasrieg_biolog1_bacter     = $datos['clasrieg_biolog1_bacter']; 
$clasrieg_biolog1_parasi     = $datos['clasrieg_biolog1_parasi']; 
$clasrieg_biolog1_morde      = $datos['clasrieg_biolog1_morde']; 
$clasrieg_biolog1_picad      = $datos['clasrieg_biolog1_picad']; 
$clasrieg_biolog1_hongo      = $datos['clasrieg_biolog1_hongo']; 
$clasrieg_ergo1_trabestat    = $datos['clasrieg_ergo1_trabestat']; 
$clasrieg_ergo1_esfuerfis    = $datos['clasrieg_ergo1_esfuerfis']; 
$clasrieg_ergo1_carga        = $datos['clasrieg_ergo1_carga']; 
$clasrieg_ergo1_postforz     = $datos['clasrieg_ergo1_postforz']; 
$clasrieg_ergo1_movrepet     = $datos['clasrieg_ergo1_movrepet']; 
$clasrieg_ergo1_jortrab      = $datos['clasrieg_ergo1_jortrab']; 
$clasrieg_psi1_monoto        = $datos['clasrieg_psi1_monoto']; 
$clasrieg_psi1_relhuman      = $datos['clasrieg_psi1_relhuman']; 
$clasrieg_psi1_contentarea   = $datos['clasrieg_psi1_contentarea']; 
$clasrieg_psi1_orgtiemptrab  = $datos['clasrieg_psi1_orgtiemptrab']; 
$clasrieg_segur1_mecanic     = $datos['clasrieg_segur1_mecanic']; 
$clasrieg_segur1_electri     = $datos['clasrieg_segur1_electri']; 
$clasrieg_segur1_locat       = $datos['clasrieg_segur1_locat']; 
$clasrieg_segur1_fisiquim    = $datos['clasrieg_segur1_fisiquim']; 
$clasrieg_segur1_public      = $datos['clasrieg_segur1_public']; 
$clasrieg_segur1_espconfi    = $datos['clasrieg_segur1_espconfi']; 
$clasrieg_segur1_trabaltura  = $datos['clasrieg_segur1_trabaltura']; 
$clasrieg_observ1_otro       = $datos['clasrieg_observ1_otro']; 

if ($clasrieg_fis1_ruid == "S") { $clasrieg_fis1_ruid__ = $clasrieg_fis1_ruid__ + 1; }
if ($clasrieg_fis1_ilum == "S") { $clasrieg_fis1_ilum__ = $clasrieg_fis1_ilum__ + 1; }
if ($clasrieg_fis1_noionic == "S") { $clasrieg_fis1_noionic__ = $clasrieg_fis1_noionic__ + 1; }
if ($clasrieg_fis1_vibra == "S") { $clasrieg_fis1_vibra__ = $clasrieg_fis1_vibra__ + 1; }
if ($clasrieg_fis1_tempextrem == "S") { $clasrieg_fis1_tempextrem__ = $clasrieg_fis1_tempextrem__ + 1; }
if ($clasrieg_fis1_cambpres == "S") { $clasrieg_fis1_cambpres__ = $clasrieg_fis1_cambpres__ + 1; }
if ($clasrieg_quim1_gasvapor == "S") { $clasrieg_quim1_gasvapor__ = $clasrieg_quim1_gasvapor__ + 1; }
if ($clasrieg_quim1_aeroliq == "S") { $clasrieg_quim1_aeroliq__ = $clasrieg_quim1_aeroliq__ + 1; }
if ($clasrieg_quim1_solid == "S") { $clasrieg_quim1_solid__ = $clasrieg_quim1_solid__ + 1; }
if ($clasrieg_quim1_liquid == "S") { $clasrieg_quim1_liquid__ = $clasrieg_quim1_liquid__ + 1; }
if ($clasrieg_biolog1_viru == "S") { $clasrieg_biolog1_viru__ = $clasrieg_biolog1_viru__ + 1; }
if ($clasrieg_biolog1_bacter == "S") { $clasrieg_biolog1_bacter__ = $clasrieg_biolog1_bacter__ + 1; }
if ($clasrieg_biolog1_parasi == "S") { $clasrieg_biolog1_parasi__ = $clasrieg_biolog1_parasi__ + 1; }
if ($clasrieg_biolog1_morde == "S") { $clasrieg_biolog1_morde__ = $clasrieg_biolog1_morde__ + 1; }
if ($clasrieg_biolog1_picad == "S") { $clasrieg_biolog1_picad__ = $clasrieg_biolog1_picad__ + 1; }
if ($clasrieg_biolog1_hongo == "S") { $clasrieg_biolog1_hongo__ = $clasrieg_biolog1_hongo__ + 1; }
if ($clasrieg_ergo1_trabestat == "S") { $clasrieg_ergo1_trabestat__ = $clasrieg_ergo1_trabestat__ + 1; }
if ($clasrieg_ergo1_esfuerfis == "S") { $clasrieg_ergo1_esfuerfis__ = $clasrieg_ergo1_esfuerfis__ + 1; }
if ($clasrieg_ergo1_carga == "S") { $clasrieg_ergo1_carga__ = $clasrieg_ergo1_carga__ + 1; }
if ($clasrieg_ergo1_postforz == "S") { $clasrieg_ergo1_postforz__ = $clasrieg_ergo1_postforz__ + 1; }
if ($clasrieg_ergo1_movrepet == "S") { $clasrieg_ergo1_movrepet__ = $clasrieg_ergo1_movrepet__ + 1; }
if ($clasrieg_ergo1_jortrab == "S") { $clasrieg_ergo1_jortrab__ = $clasrieg_ergo1_jortrab__ + 1; }
if ($clasrieg_psi1_monoto == "S") { $clasrieg_psi1_monoto__ = $clasrieg_psi1_monoto__ + 1; }
if ($clasrieg_psi1_relhuman == "S") { $clasrieg_psi1_relhuman__ = $clasrieg_psi1_relhuman__ + 1; }
if ($clasrieg_psi1_contentarea == "S") { $clasrieg_psi1_contentarea__ = $clasrieg_psi1_contentarea__ + 1; }
if ($clasrieg_psi1_orgtiemptrab == "S") { $clasrieg_psi1_orgtiemptrab__ = $clasrieg_psi1_orgtiemptrab__ + 1; }
if ($clasrieg_segur1_mecanic == "S") { $clasrieg_segur1_mecanic__ = $clasrieg_segur1_mecanic__ + 1; }
if ($clasrieg_segur1_electri == "S") { $clasrieg_segur1_electri__ = $clasrieg_segur1_electri__ + 1; }
if ($clasrieg_segur1_locat == "S") { $clasrieg_segur1_locat__ = $clasrieg_segur1_locat__ + 1; }
if ($clasrieg_segur1_fisiquim == "S") { $clasrieg_segur1_fisiquim__ = $clasrieg_segur1_fisiquim__ + 1; }
if ($clasrieg_segur1_public == "S") { $clasrieg_segur1_public__ = $clasrieg_segur1_public__ + 1; }
if ($clasrieg_segur1_espconfi == "S") { $clasrieg_segur1_espconfi__ = $clasrieg_segur1_espconfi__ + 1; }
if ($clasrieg_segur1_trabaltura == "S") { $clasrieg_segur1_trabaltura__ = $clasrieg_segur1_trabaltura__ + 1; }
if ($clasrieg_observ1_otro == "S") { $clasrieg_observ1_otro__ = $clasrieg_observ1_otro__ + 1; }
}
$vector_riesgo             = array($clasrieg_fis1_ruid__, $clasrieg_fis1_ilum__, $clasrieg_fis1_noionic__, $clasrieg_fis1_vibra__, $clasrieg_fis1_tempextrem__, $clasrieg_fis1_cambpres__, $clasrieg_quim1_gasvapor__, $clasrieg_quim1_aeroliq__, $clasrieg_quim1_solid__, $clasrieg_quim1_liquid__, $clasrieg_biolog1_viru__, $clasrieg_biolog1_bacter__, $clasrieg_biolog1_parasi__, $clasrieg_biolog1_morde__, $clasrieg_biolog1_picad__, $clasrieg_biolog1_hongo__, $clasrieg_ergo1_trabestat__, $clasrieg_ergo1_esfuerfis__, $clasrieg_ergo1_carga__, $clasrieg_ergo1_postforz__, $clasrieg_ergo1_movrepet__, $clasrieg_ergo1_jortrab__, $clasrieg_psi1_monoto__, $clasrieg_psi1_relhuman__, $clasrieg_psi1_contentarea__, $clasrieg_psi1_orgtiemptrab__, $clasrieg_segur1_mecanic__, $clasrieg_segur1_electri__, $clasrieg_segur1_locat__, $clasrieg_segur1_fisiquim__, $clasrieg_segur1_public__, $clasrieg_segur1_espconfi__, $clasrieg_segur1_trabaltura__, $clasrieg_observ1_otro);
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$portada_informe_condiciones_salud                          = '
<div class="table-responsive"><table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt"><tr><td style="text-align:center"><strong>DIAGNÓSTICO DE CONDICIONES DE SALUD</strong></td></tr></table></div>
<div class="table-responsive"><table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt"><tr><td style="text-align:center"><strong>'.$nombre_empresa_contratante.'</strong></td></tr></table></div>
<div class="table-responsive"><table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt"><tr><td style="text-align:center"><strong>ELABORADO POR: '.$nombre_emp.'</strong></td></tr></table></div>
<div class="table-responsive"><table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt"><tr><td style="text-align:center"><strong>MOTIVO: '.$nombre_motivo.'</strong></td></tr></table></div>
<div class="table-responsive"><table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt"><tr><td style="text-align:center"><strong>Del '.$fecha_ini_esp.' al '.$fecha_fin_esp.'</strong></td></tr></table></div>
';
$introduccion_informe_condiciones_salud                     = '
<div class="table-responsive">
<table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:center"><strong>INTRODUCCIÓN</strong></td></tr>
<tr><td style="text-align:justify">El Diagnóstico de Salud constituye una de las tareas claves dentro del análisis de información de Salud y 
Seguridad en el Trabajo. Esta fundamentado en la información recolectada durante la realización de las actividades de Medicina del trabajo y 
hoy en día constituye una herramienta básica para el equipo de Salud y Seguridad en el Trabajo en la toma de decisiones.
<br><br>
Se realiza con base en la información recolectada a partir de los exámenes médicos y paraclìnicos, su importancia radica en los hallazgos, las 
asociaciones exposición-efecto y análisis del comportamiento de las diferentes variables a través del tiempo.

Su realización comprende varias etapas sucesivas donde se determinan las fuentes de información, se establecen los formatos de recolección 
de información, se identifican y priorizan las variables a estudiar, posteriormente se realiza un análisis cruzando las variables más relevantes 
para el área de Salud y Seguridad en el Trabajo.
<br><br>
Las variables a evaluar se pueden clasificar en grandes grupos, las asociadas al individuo, las asociadas al puesto de trabajo y los hallazgos 
clínicos, buscando siempre la correlación de los factores de riesgo del puesto de trabajo y la condición clínica de cada persona.
<br><br>
Finalmente se establecen una serie de recomendaciones generales para ser ejecutadas por parte de todos los actores del Sistema de Gestión de Salud 
y Seguridad en el Trabajo. Las personas asignadas a la administración del sistema de gestión se encargarán de la vigilancia y control del cumplimiento de dichas recomendaciones.
</td></tr>
</table>
</div>
';
$objetivo_informe_condiciones_salud                         = '
<div class="table-responsive">
<table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>1. OBJETIVOS</strong></td></tr>
<tr><td style="text-align:justify">Caracterizar la población del '.$nombre_empresa_contratante.' mediante el análisis de información contenida en 
 la Historia Clínica Ocupacional, evaluando variables sociodemográficas, laborales, antecedentes médicos,  hábitos de vida, morbilidad sentida, 
 resultados y análisis de pruebas complementarias y diagnósticos realizados.
<br><br>
Establecer las patologías de origen común y profesional de mayor incidencia y prevalencia con el fin de diseñar actividades de prevención de la 
enfermedad tendientes a disminuir su aparición y evitando el deterioro y/o las complicaciones de las que ya estuvieren presentes.
<br><br>
Establecer la asociación entre los factores de riesgo del puesto de trabajo con la morbilidad sentida y los hallazgos clínicos realizados por los 
profesionales de salud, para determinar las estrategias de control en la fuente, el medio y el trabajador.
<br><br>
Recomendar actividades de Promoción de la salud y Prevención de la enfermedad, de aplicación colectiva, a seguir en los próximos meses de acuerdo 
con la situación diagnosticada.
</td></tr>
</table>
</div>
';
$material_metodo_informe_condiciones_salud                  = '
<div class="table-responsive">
<table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>2. MATERIALES Y MÉTODOS</strong></td></tr>
<tr><td style="text-align:left">Fuentes de Información</td></tr>
<tr><td style="text-align:left">Las fuentes de información utilizadas para realizar el diagnóstico de salud fueron las siguientes:</td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Historias clínicas de exámenes médicos ocupacionales, realizadas entre mes de año a mes de año a la población trabajadora. </td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Perfiles médicos y psicológicos de cargo. </td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Profesiogramas realizados en el año. </td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Planta de personal de la tbl15_empresa.</td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Informes de Accidentalidad consolidados año-año.</td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Informe de Enfermedades profesionales año-año.</td></tr>
<tr><td style="text-align:left">Procesamiento de Datos:</td></tr>
<tr><td style="text-align:left">•	Herramienta usada para el almacenamiento y procesamiento de la información</td></tr>
</table>
</div>
';
$resultado_nivel_nal_informe_condiciones_salud              = '
<div class="table-responsive">
<table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3. RESULTADOS CONSOLIDADOS</strong></td></tr>
<tr><td style="text-align:justify">Los hallazgos de la Evaluación Médica Ocupacional de la población trabajadora del '.$nombre_empresa_contratante.', se presentan a continuación en tablas y gráficas que reflejan la situación general de salud de la Empresa.</td></tr>
</table>
</div>
';
$caracter_sociodemo_informe_condiciones_salud               = '
<div class="table-responsive">
<table class="table table-striped" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.1. CARACTERÍSTICAS SOCIODEMOGRÁFICAS DE LA POBLACIÓN</strong></td></tr>
<tr><td style="text-align:left">3.1.1. Población Evaluada</td></tr>
<tr><td style="text-align:justify">Se evaluó a los trabajadores del '.$nombre_empresa_contratante.', teniendo como base una población objeto de 
'.$total_muestra.' funcionarios, practicando '.$poblacion_eval.' exámenes médicos ocupacionales 
entre la fecha de '.$fecha_ini_esp.' a fecha de '.$fecha_fin_esp.', con una cobertura del '.round($ptj_cobertura, 2).'%. </td></tr>
</table>
</div>
';
$distrib_sexo_informe_condiciones_salud                     = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.1.2. Distribución por Sexo</strong></td></tr>
<tr><td style="text-align:left">Se encontró predominio del tbl15_sexo '.$sexo_txt.' con el '.round($porcentaje_sexo, 2).'%.</td></tr>
</table>
</div>
';
$distrib_grup_etarico_informe_condiciones_salud             = '
<table class="table table-bordered" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.1.3. Distribución de la población según Grupo Etário</strong></td></tr>
<tr><td style="text-align:left">Un '.round($ptj_edad_final, 2).' % de las personas evaluadas se encuentran en el rango de '.$nombre_posicion_vector.' años</td></tr>
</table>
';
$distrib_nivel_escolar_informe_condiciones_salud            = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.1.4 Distribución del Nivel de Escolaridad de la población</strong></td></tr>
<tr><td style="text-align:left">El Nivel de tbl15_escolaridad, con mayor porcentaje dentro de la Empresa corresponde a 
'.$pos1_nombre_escolaridad.' con un '.round($pos1_ptj_escolaridad, 2).'%; 
en segundo lugar está '.$pos2_nombre_escolaridad.', con '.round($pos2_ptj_escolaridad, 2).'%; 
en tercer lugar '.$pos3_nombre_escolaridad.', con '.round($pos3_ptj_escolaridad, 2).'%.</td></tr>
</table>
</div>
';
$caracteristica_lab_cargo_informe_condiciones_salud         = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.2. CARACTERÍSTICAS LABORALES</strong></td></tr>
<tr><td style="text-align:left"><strong>3.2.1. Distribución de la población según Cargos</strong></td></tr>
<tr><td style="text-align:left">Los cargos predominantes en los evaluados fueron:</td></tr>
</table>
</div>
';
$distrib_poblacion_antig_informe_condiciones_salud  = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.2.2 Distribución de la Población por Antigüedad </strong></td></tr>
<tr><td style="text-align:left">El porcentaje predominante corresponde a los Trabajadores '.$nombre_posicion_vector_antig.' de antigüedad en la Empresa.</td></tr>
</table>
</div>
';
$peligro_precibid_informe_condiciones_salud                 = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.2.3. Peligros percibidos</strong></td></tr>
<tr><td style="text-align:left">Los resultados aquí mostrados se basan en el auto-reporte de los trabajadores donde se evalúa la percepción que tienen con respecto a los peligros en el ambiente de trabajo. Es importante cruzar esta información con la matriz de peligros de la Empresa.
En orden descendente, los peligros reportados son:
</td></tr>
</table>
</div>

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp .'pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Peligro</th>
    <th style="text-align:center"># declarantes</th>
    <th style="text-align:center">% declarantes</th>
</tr>
</thead>
<tbody>
';
$contador = 0;

foreach ($vector_riesgo as &$conteo_riesgo) {
$contador ++;
$peligro_precibid_informe_condiciones_salud                 .= '
  <tr>
';
if ($contador == 1 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Ruido'; 
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
 }
 if ($contador == 2 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Iluminación';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 3 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Rad no Ionic';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 4 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Vibraciones';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 5 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Temp Extremas';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 6 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Cambios de Presión';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 7 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Gases y Vapores';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 8 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Aerosoles Líquidos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 9 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Sólidos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 10 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Líquidos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 11 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Virus';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 12 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Bacterias';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 13 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Parásitos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 14 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Mordeduras';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 15 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Picaduras';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 16 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Hongos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 17 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Trabajo Estático';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 18 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Esfuerzo Físico';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 19 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Cargas';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 20 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Posturas Forzadas';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 21 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Movimientos Repetitivos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 22 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Jornada de Trabajo';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 23 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Monotonía';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 24 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Relaciones Humanas';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 25 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Contenido de la Terea';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 26 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Org. del Tiempo de Trabajo';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 27 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Mecánicos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 28 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Eléctricos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 29 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Locativos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 30 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Físicoquimicos';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 31 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Público';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 32 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Espacios Confinados';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 33 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Trabajos en Alturas';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
if ($contador == 34 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Otros';
$peligro_precibid_informe_condiciones_salud                 .= '
<td>'.$nombre_riesgo .'</td>
<td style="text-align:center">'.intval($conteo_riesgo) .'</td>
<td style="text-align:center">'.round((($conteo_riesgo / $total_poblacion) *100), 2) .'%</td>
';
}
}
unset($conteo_riesgo); // rompe la referencia con el último elemento
$peligro_precibid_informe_condiciones_salud                 .= '
  </tr>
</tbody>
</table>
</div>
';
$factor_riesg_ocupacional_informe_condiciones_salud         = '

';
$habit_extra_lab_informe_condiciones_salud                  = '
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.4. HÁBITOS EXTRALABORALES</strong></td></tr>
<tr><td style="text-align:left">3.4.1. Tabaquismo</td></tr>
<tr><td style="text-align:left">El '.round($fuma_ptj, 2).'% de las personas evaluadas refirió fumar, 
un  '.round($exfum_ptj, 2).'% ser exfumadores y 
un '.round($nofum_ptj, 2).' % refirió no ser fumador.</td></tr>
</table>
';
$consumo_cigarr_informe_condiciones_salud                   = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'. $tamano_font_informe_emp .'pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Consumo de cigarrillo</th>
    <th style="text-align:center">#</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<tr>
    <td style="text-align:left">SI</td>
    <td style="text-align:center">'. intval($fuma).'</td>
    <td style="text-align:center">'. round($fuma_ptj, 2) .'%</td>
</tr>
<tr>
    <td style="text-align:left">NO</td>
    <td style="text-align:center">'. intval($nofum) .'</td>
    <td style="text-align:center">'. round($nofum_ptj, 2) .'%</td>
</tr>
<tr>
    <td style="text-align:left">EX</td>
    <td style="text-align:center">'. intval($exfum) .'</td>
    <td style="text-align:center">'. round($exfum_ptj, 2) .'%</td>
</tr>

<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center">'. $total_poblacion .'</th>
    <th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>
';
$actividad_fisica_informe_condiciones_salud                 = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.4.2. Actividad Física</strong></td></tr>

<tr><td style="text-align:left">Un '.round($fisicamente_activo_ptj, 2).'% de la población evaluada refirió realizar algún tipo de actividad física, 
en forma periódica, un '.round($sedentario_ptj, 2).'% no la realiza.</td></tr>
</table>
</div>
';
$masa_corp_informe_condiciones_salud                        = '
<table class="table table-bordered" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.4.3 Indice de Masa Corporal </strong></td></tr>
<tr><td style="text-align:left">El '.round($sobreso_ptj, 2).'% de la población presenta sobrepeso y el '.round($obesidad_total, 2).'% obesidad.</td></tr>
<tr><td style="text-align:left">Para un total de '.round($sobreso_ptj + $obesidad_total, 2).'%  de problemas de sobrepeso y obesidad.</td></tr>
</table>
';
$enf_laboral_informe_condiciones_salud                      = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.5. PATOLOGÍA OCUPACIONAL REPORTADA</strong></td></tr>
<tr><td style="text-align:left">La patología ocupacional se refiere a los antecedentes de accidentalidad laboral y enfermedad de origen laboral que hayan referido los trabajadores en el último año dentro de la Empresa.</td></tr>
</table>
</div>
';

$enf_laboral_reportada_informe_condiciones_salud            = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Enfermedad laboral reportada</th>
    <th style="text-align:center">#</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<tr>
    <td style="text-align:center">Con enfermedad</td>
    <td style="text-align:center">'.intval($enf_lab_si).'</td>
    <td style="text-align:center">'. round($enf_lab_si_ptj, 2).'%</td>
</tr>
<tr>
    <td style="text-align:center">Sin enfermedad</td>
    <td style="text-align:center">'.intval($enf_lab_no).'</td>
    <td style="text-align:center">'.round($enf_lab_no_ptj, 2).'%</td>
</tr>

<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center">'.$total_poblacion.'</th>
    <th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>
';

$accidente_lab_informe_condiciones_salud                    = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp .'pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Accidente de trabajo</th>
    <th style="text-align:center">#</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<tr>
    <td style="text-align:center">Accidentado</td>
    <td style="text-align:center">'.intval($ant_impor_accilab_si).'</td>
    <td style="text-align:center">'.round($ant_impor_accilab_si_ptj, 2) .'%</td>
</tr>
<tr>
    <td style="text-align:center">No accidentado</td>
    <td style="text-align:center">'.intval($ant_impor_accilab_no) .'</td>
    <td style="text-align:center">'.round($ant_impor_accilab_no_ptj, 2) .'%</td>
</tr>

<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center">'.$total_poblacion .'</th>
    <th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>
';
$diag_principales_informe_condiciones_salud                 = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>3.6. PRINCIPALES DIAGNÓSTICOS</strong></td></tr>
<tr><td style="text-align:left">Los diagnósticos de mayor incidencia encontradas en los Trabajadores evaluados en el '.$nombre_empresa_contratante.', se presentan a continuación:<br></td></tr>
</table>
</div>
';
$contador = 0;
$query1 = "SELECT tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.motivo, Count(tbl15_cie10diag.cie10_diag) AS conteo_cie10_cod, tbl15_cie10diag.cie10_diag
FROM tbl15_historia_clinica LEFT JOIN tbl15_cie10diag ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos_) AND (tbl15_historia_clinica.cod_estado_facturacion=1)) 
GROUP BY tbl15_cie10diag.cie10_diag ORDER BY conteo_cie10_cod DESC LIMIT 0,14";
$result1 = mysqli_query($conectar, $query1);
while ($dato01 = mysqli_fetch_assoc($result1)) { 
$contador++;

$conteo_cie10_cod          = $dato01['conteo_cie10_cod'];
$nombre_cie10_diag         = $dato01['cie10_diag'];
$conteo_cie10_cod_ptj      = ($conteo_cie10_cod / $total_poblacion) * 100;

$diag_principales_informe_condiciones_salud                 .= '
<table class="table table-bordered" style="font-family:mono;  font-size:'.$tamano_font_informe_emp.'pt">
<tr>
    <td style="text-align:left">'.$contador.'. '.$nombre_cie10_diag.', personas afectadas, equivalentes al '.round($conteo_cie10_cod_ptj, 2).'% de la Población.<br></td>
</tr>
</table>
';
 }

$recomendacion_general_informe_condiciones_salud            = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>4. RECOMENDACIONES </strong></td></tr>
<tr><td style="text-align:left"><strong>4.1. RECOMENDACIONES GENERALES</strong></td></tr>
<tr><td style="text-align:left">El área o las personas asignadas a la gestión de salud y tbl15_seguridaden el trabajo deben promover y facilitar la generación de entornos de trabajo saludables, mediante estrategias dirigidas a las condiciones específicas de la tbl15_empresa, según su distribución por tbl15_sexo, grupos etarios, tbl15_escolaridad, área de residencia y demás indicadores sociodemográficos.
La promoción del autocuidado de la salud es costo-efectiva. La población trabajadora debe tener una creciente conciencia sobre la necesidad de proteger su salud , modificar los hábitos de vida no saludables como el consumo de cigarrillo y el sedentarismo y participar activamente en el control de riesgos ocupacionales, con mecanismos como el auto reporte de condiciones inseguras en àreas de trabajo, el uso permanente de elementos de protección personal durante la exposición, las prácticas seguras y la formalización de  procedimientos seguros en el trabajo diario. 
</td></tr>
</table>
</div>
';
$recomendacion_especif_informe_condiciones_salud            = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>4.2. RECOMENDACIONES ESPECÍFICAS</strong></td></tr>
<tr><td style="text-align:left">De acuerdo con los resultados del presente análisis se sugiere proponer las siguientes actividades:</td></tr>
</table>
</div>
';
$promo_preven_salud_informe_condiciones_salud               = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>PROMOCION Y PREVENCION EN SALUD</strong></td></tr>
<tr><td style="text-align:left">• Realizar campañas de capacitación en cuidado visual en conjunto con el departamento de Bienestar Social dirigidas a concientizar a los Trabajadores en la Higiene visual y la importancia del control y evaluación anual en la EPS tratante. 
</td></tr>
<tr><td style="text-align:left">• Implementar campañas de sensibilización por medios escritos o impresos que indiquen la Importancia de la actividad física regular dentro de la población.</td></tr>
<tr><td style="text-align:left">• Implementar un programa de acondicionamiento físico dentro de la Empresa que fomente la práctica regular de ejercicio. </td></tr>
<tr><td style="text-align:left">• Realizar periódicamente campañas de control de peso y toma de Tensión arterial como mecanismo primario de tamizaje y control del riesgo cardiovascular.</td></tr>
<tr><td style="text-align:left">• Capacitar a los trabajadores en la prevención de los factores de riesgo cardiovascular, promover pautas de autocuidado y estilos de vida saludables, control del estrés.</td></tr>
<tr><td style="text-align:left">• Realización de campañas de capacitación en Higiene Postural dirigidas a concientizar a los Trabajadores en la adopción de posturas adecuadas durante la jornada laboral.</td></tr>
</table>
</div>
';
$control_riesg_ocupa_informe_condiciones_salud              = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>CONTROL DE RIESGOS OCUPACIONALES</strong></td></tr>
<tr><td style="text-align:left">• Verificar el cumplimiento de las recomendaciones dadas en los estudios y mediciones de iluminación realizadas en los puestos de trabajo evaluados por solicitud a los encargados de la gestión de Salud y Seguridad en el Trabajo.</td></tr>
<tr><td style="text-align:left">Recomendaciones específicas para los riesgos prioritarios según matriz de peligros.
Recomendaciones específicas para las enfermedades y condiciones adversas probablemente relacionadas con los riesgos documentados en la matriz de peligros.
</td></tr>
</table>
</div>
';
$divulg_resultado_informe_condiciones_salud                 = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>DIVULGACIÓN DE LA ACTIVIDAD Y RESULTADOS</strong></td></tr>
<tr><td style="text-align:left">• Es importante que los trabajadores conozcan los resultados de la actividad de tal manera que se refleje en las políticas para Salud y Seguridad en el Trabajo. Para lograr un impacto en la población es importante retroalimentar dicha información individualmente garantizando así el cumplimiento de las recomendaciones realizadas.</td></tr>
</table>
</div>
';
$medida_control_informe_condiciones_salud                   = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>MEDIDAS DE CONTROL</strong></td></tr>
<tr><td style="text-align:left">• Para los trabajadores que resultaron con anormalidad en los exámenes deben cumplir con los tratamientos y recomendaciones. Las actividades de control no solamente deben incluir al trabajador si no a todos los factores de riesgo a que se encuentra expuesto durante sus jornadas de trabajo.</td></tr>
</table>
</div>
';
$seguimiento_informe_condiciones_salud                      = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:'.$tamano_font_informe_emp.'pt">
<tr><td style="text-align:left"><strong>SEGUIMIENTO</strong></td></tr>
<tr><td style="text-align:left">• Para todos los trabajadores a los que se les implementó una medida de control se debe controlar en un tiempo prudencial no mayor a seis meses. Es importante realizar un seguimiento, no solo médico sino del puesto de trabajo y de los factores de riesgo a los que se encuentra expuesto.</td></tr>
</table>
</div>
';
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$sql_autoincremento_informe_condiciones_salud = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_informe_condiciones_salud'";
$exec_autoincremento_informe_condiciones_salud = mysqli_query($conectar, $sql_autoincremento_informe_condiciones_salud) or die(mysqli_error($conectar));
$datos_autoincremento_informe_condiciones_salud = mysqli_fetch_assoc($exec_autoincremento_informe_condiciones_salud);
$cod_informe_condiciones_salud = $datos_autoincremento_informe_condiciones_salud['AUTO_INCREMENT'];
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
if ($total_motivo==1) { 
$motivo                              = addslashes($_GET['motivo']);

$motivos                             = "motivo='".$motivo."'";
$motivos_                            = "tbl15_historia_clinica.motivo='".$motivo."'";
$url_motivos                         = "motivo=".$motivo;
$motivo_limpia                       = str_replace(' ', '_', $motivo);
$nombre_motivo                       = $motivo;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==2) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2);
$nombre_motivo                       = $motivo.' Y '.$motivo2;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==3) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3);
$nombre_motivo                       = $motivo.', '.$motivo2.' Y '.$motivo3;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==4) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.' Y '.$motivo4;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==5) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.' Y '.$motivo5;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==6) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.' Y '.$motivo6;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==7) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.' Y '.$motivo7;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==8) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.' Y '.$motivo8;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==9) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.' Y '.$motivo9;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==10) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);
$motivo10                            = addslashes($_GET['motivo10']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9."&motivo10=".$motivo10;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9.'-'.$motivo10);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.' Y '.$motivo10;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, motivo10, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$motivo10', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==11) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);
$motivo10                            = addslashes($_GET['motivo10']);
$motivo11                            = addslashes($_GET['motivo11']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9."&motivo10=".$motivo10."&motivo11=".$motivo11;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9.'-'.$motivo10.'-'.$motivo11);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.' Y '.$motivo11;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, motivo10, motivo11, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$motivo10', '$motivo11', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==12) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);
$motivo10                            = addslashes($_GET['motivo10']);
$motivo11                            = addslashes($_GET['motivo11']);
$motivo12                            = addslashes($_GET['motivo12']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."') OR (motivo='".$motivo12."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."') OR (tbl15_historia_clinica.motivo='".$motivo12."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9."&motivo10=".$motivo10."&motivo11=".$motivo11."&motivo12=".$motivo12;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9.'-'.$motivo10.'-'.$motivo11.'-'.$motivo12);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.', '.$motivo11.' Y '.$motivo12;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, motivo10, motivo11, motivo12, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$motivo10', '$motivo11', '$motivo12', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==13) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);
$motivo10                            = addslashes($_GET['motivo10']);
$motivo11                            = addslashes($_GET['motivo11']);
$motivo12                            = addslashes($_GET['motivo12']);
$motivo13                            = addslashes($_GET['motivo13']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."') OR (motivo='".$motivo12."') OR (motivo='".$motivo13."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."') OR (tbl15_historia_clinica.motivo='".$motivo12."') OR (tbl15_historia_clinica.motivo='".$motivo13."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9."&motivo10=".$motivo10."&motivo11=".$motivo11."&motivo12=".$motivo12."&motivo13=".$motivo13;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9.'-'.$motivo10.'-'.$motivo11.'-'.$motivo12.'-'.$motivo13);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.', '.$motivo11.', '.$motivo12.' Y '.$motivo13;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, motivo10, motivo11, motivo12, motivo13, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$motivo10', '$motivo11', '$motivo12', '$motivo13', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==14) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);
$motivo10                            = addslashes($_GET['motivo10']);
$motivo11                            = addslashes($_GET['motivo11']);
$motivo12                            = addslashes($_GET['motivo12']);
$motivo13                            = addslashes($_GET['motivo13']);
$motivo14                            = addslashes($_GET['motivo14']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."') OR (motivo='".$motivo12."') OR (motivo='".$motivo13."') OR (motivo='".$motivo14."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."') OR (tbl15_historia_clinica.motivo='".$motivo12."') OR (tbl15_historia_clinica.motivo='".$motivo13."') OR (tbl15_historia_clinica.motivo='".$motivo14."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9."&motivo10=".$motivo10."&motivo11=".$motivo11."&motivo12=".$motivo12."&motivo13=".$motivo13."&motivo14=".$motivo14;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9.'-'.$motivo10.'-'.$motivo11.'-'.$motivo12.'-'.$motivo13.'-'.$motivo14);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.', '.$motivo11.', '.$motivo12.', '.$motivo13.' Y '.$motivo14;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, motivo10, motivo11, motivo12, motivo13, motivo14, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$motivo10', '$motivo11', '$motivo12', '$motivo13', '$motivo14', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
elseif ($total_motivo==15) { 
$motivo                              = addslashes($_GET['motivo']);
$motivo2                             = addslashes($_GET['motivo2']);
$motivo3                             = addslashes($_GET['motivo3']);
$motivo4                             = addslashes($_GET['motivo4']);
$motivo5                             = addslashes($_GET['motivo5']);
$motivo6                             = addslashes($_GET['motivo6']);
$motivo7                             = addslashes($_GET['motivo7']);
$motivo8                             = addslashes($_GET['motivo8']);
$motivo9                             = addslashes($_GET['motivo9']);
$motivo10                            = addslashes($_GET['motivo10']);
$motivo11                            = addslashes($_GET['motivo11']);
$motivo12                            = addslashes($_GET['motivo12']);
$motivo13                            = addslashes($_GET['motivo13']);
$motivo14                            = addslashes($_GET['motivo14']);
$motivo15                            = addslashes($_GET['motivo15']);

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."') OR (motivo='".$motivo9."') OR (motivo='".$motivo10."') OR (motivo='".$motivo11."') OR (motivo='".$motivo12."') OR (motivo='".$motivo13."') OR (motivo='".$motivo14."') OR (motivo='".$motivo15."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."') OR (tbl15_historia_clinica.motivo='".$motivo9."') OR (tbl15_historia_clinica.motivo='".$motivo10."') OR (tbl15_historia_clinica.motivo='".$motivo11."') OR (tbl15_historia_clinica.motivo='".$motivo12."') OR (tbl15_historia_clinica.motivo='".$motivo13."') OR (tbl15_historia_clinica.motivo='".$motivo14."') OR (tbl15_historia_clinica.motivo='".$motivo15."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8."&motivo9=".$motivo9."&motivo10=".$motivo10."&motivo11=".$motivo11."&motivo12=".$motivo12."&motivo13=".$motivo13."&motivo14=".$motivo14."&motivo15=".$motivo15;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8.'-'.$motivo9.'-'.$motivo10.'-'.$motivo11.'-'.$motivo12.'-'.$motivo13.'-'.$motivo14.'-'.$motivo15);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.', '.$motivo8.', '.$motivo9.', '.$motivo10.', '.$motivo11.', '.$motivo12.', '.$motivo13.', '.$motivo14.' Y '.$motivo15;

$sql_data = "INSERT INTO tbl15_informe_condiciones_salud (nombre_empresa, fecha_ini, fecha_fin, total_motivo, total_muestra, motivo, motivo2, motivo3, motivo4, motivo5, 
motivo6, motivo7, motivo8, motivo9, motivo10, motivo11, motivo12, motivo13, motivo14, motivo15, portada_informe_condiciones_salud, introduccion_informe_condiciones_salud, 
objetivo_informe_condiciones_salud, material_metodo_informe_condiciones_salud, resultado_nivel_nal_informe_condiciones_salud, 
caracter_sociodemo_informe_condiciones_salud, distrib_sexo_informe_condiciones_salud, distrib_grup_etarico_informe_condiciones_salud, 
distrib_nivel_escolar_informe_condiciones_salud, caracteristica_lab_cargo_informe_condiciones_salud, 
distrib_poblacion_antig_informe_condiciones_salud, peligro_precibid_informe_condiciones_salud, 
factor_riesg_ocupacional_informe_condiciones_salud, habit_extra_lab_informe_condiciones_salud, consumo_cigarr_informe_condiciones_salud, 
actividad_fisica_informe_condiciones_salud, masa_corp_informe_condiciones_salud, enf_laboral_informe_condiciones_salud, enf_laboral_reportada_informe_condiciones_salud, 
accidente_lab_informe_condiciones_salud, diag_principales_informe_condiciones_salud, recomendacion_general_informe_condiciones_salud, 
recomendacion_especif_informe_condiciones_salud, promo_preven_salud_informe_condiciones_salud, control_riesg_ocupa_informe_condiciones_salud, 
divulg_resultado_informe_condiciones_salud, medida_control_informe_condiciones_salud, seguimiento_informe_condiciones_salud, 
fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, hora, fecha_time, fecha_reg_time, cuenta, cuenta_reg) 
VALUES ('$nombre_empresa_contratante', '$fecha_ini', '$fecha_fin', '$total_motivo', '$total_muestra', '$motivo', '$motivo2', '$motivo3', '$motivo4', '$motivo5', 
'$motivo6', '$motivo7', '$motivo8', '$motivo9', '$motivo10', '$motivo11', '$motivo12', '$motivo13', '$motivo14', '$motivo15', '$portada_informe_condiciones_salud', '$introduccion_informe_condiciones_salud', 
'$objetivo_informe_condiciones_salud', '$material_metodo_informe_condiciones_salud', '$resultado_nivel_nal_informe_condiciones_salud', 
'$caracter_sociodemo_informe_condiciones_salud', '$distrib_sexo_informe_condiciones_salud', '$distrib_grup_etarico_informe_condiciones_salud', 
'$distrib_nivel_escolar_informe_condiciones_salud', '$caracteristica_lab_cargo_informe_condiciones_salud', 
'$distrib_poblacion_antig_informe_condiciones_salud', '$peligro_precibid_informe_condiciones_salud', 
'$factor_riesg_ocupacional_informe_condiciones_salud', '$habit_extra_lab_informe_condiciones_salud', '$consumo_cigarr_informe_condiciones_salud', 
'$actividad_fisica_informe_condiciones_salud', '$masa_corp_informe_condiciones_salud', '$enf_laboral_informe_condiciones_salud', '$enf_laboral_reportada_informe_condiciones_salud',
'$accidente_lab_informe_condiciones_salud', '$diag_principales_informe_condiciones_salud', '$recomendacion_general_informe_condiciones_salud', 
'$recomendacion_especif_informe_condiciones_salud', '$promo_preven_salud_informe_condiciones_salud', '$control_riesg_ocupa_informe_condiciones_salud', 
'$divulg_resultado_informe_condiciones_salud', '$medida_control_informe_condiciones_salud', '$seguimiento_informe_condiciones_salud', 
'$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$cuenta', '$cuenta_reg')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>">
<?php
}
?>