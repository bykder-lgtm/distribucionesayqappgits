<?php 
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_dia_mes_anyo.php');

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                          = $info_empresa_data['titulo'];
$nombre_emp                          = $info_empresa_data['nombre'];
$eslogan_emp                         = $info_empresa_data['eslogan'];
$direccion_emp                       = $info_empresa_data['direccion'];
$ciudad_emp                          = $info_empresa_data['ciudad'];
$correo_emp                          = $info_empresa_data['correo'];
$img_cabecera_emp                    = $info_empresa_data['img_cabecera'];
$telefono_emp                        = $info_empresa_data['telefono'];
$info_legal_emp                      = $info_empresa_data['info_legal'];
$propietario_nombres_apellidos_emp   = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                     = $info_empresa_data['nit_empresa'];
$cabecera_emp                        = $info_empresa_data['cabecera'];
$icono_emp                           = $info_empresa_data['icono'];
$nombre_font_emp                     = $info_empresa_data['nombre_font'];
$tamano_font_hc_emp                  = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp              = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp            = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp          = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_informe_emp             = $info_empresa_data['tamano_font_informe'];
$tamano_font_remision_emp            = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp             = $info_empresa_data['tamano_font_factura'];
$departamento_emp                    = $info_empresa_data['departamento'];
$localidad_emp                       = $info_empresa_data['localidad'];
$reg_medico_emp                      = $info_empresa_data['reg_medico'];
$regimen_emp                         = $info_empresa_data['regimen'];
$propietario_url_firma_emp           = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                      = $info_empresa_data['fecha_time'];
$licencia_emp                        = $info_empresa_data['licencia'];
$info_histclinic_emp                 = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                 = $info_empresa_data['info_aptlaboral'];

$serguridad_pagina                   = 1;
$cod_informe_condiciones_salud       = intval($_GET['cod_informe_condiciones_salud']);
$fecha_ini                           = addslashes($_GET['fecha_ini']);
$fecha_fin                           = addslashes($_GET['fecha_fin']);
$nombre_empresa_contratante                      = addslashes($_GET['nombre_empresa_contratante']);
$total_motivo                        = intval($_GET['total_motivo']);
$total_muestra                       = intval($_GET['total_muestra']);
$fecha_hoy_ymd_seg                   = strtotime(date("Y/m/d"));

$fecha_time_ini                      = strtotime($fecha_ini);
$fecha_time_fin                      = strtotime($fecha_fin);
$fecha_ini_ymd                       = date("Y_m_d", $fecha_time_ini);
$fecha_fin_ymd                       = date("Y_m_d", $fecha_time_fin);
$fecha_ini_esp                       = fecha_en_espanol_dia_mes_anyo($fecha_time_ini);
$fecha_fin_esp                       = fecha_en_espanol_dia_mes_anyo($fecha_time_fin);
$nombre_empresa_contratante_limpia               = str_replace(' ', '_', $nombre_empresa_contratante);
$fecha_hoy                           = date("Y/m/d");
$pagina                              = $_SERVER['PHP_SELF'];

$query2 = "SELECT * FROM tbl15_informe_condiciones_salud WHERE (cod_informe_condiciones_salud = '$cod_informe_condiciones_salud')";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$fecha_ini                = $datos2['fecha_ini'];
$fecha_fin                = $datos2['fecha_fin'];
$nombre_empresa_contratante           = $datos2['nombre_empresa'];
$total_muestra            = $datos2['total_muestra'];
$total_motivo             = $datos2['total_motivo'];
$motivo                   = $datos2['motivo'];
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$sql_informe_condiciones_salud = "SELECT * FROM tbl15_informe_condiciones_salud WHERE (cod_informe_condiciones_salud = '$cod_informe_condiciones_salud')";
$result_informe_condiciones_salud = mysqli_query($conectar, $sql_informe_condiciones_salud);
$datos_informe_condiciones_salud = mysqli_fetch_assoc($result_informe_condiciones_salud);

$portada_informe_condiciones_salud                            = $datos_informe_condiciones_salud['portada_informe_condiciones_salud'];
$introduccion_informe_condiciones_salud                       = $datos_informe_condiciones_salud['introduccion_informe_condiciones_salud'];
$objetivo_informe_condiciones_salud                           = $datos_informe_condiciones_salud['objetivo_informe_condiciones_salud'];
$material_metodo_informe_condiciones_salud                    = $datos_informe_condiciones_salud['material_metodo_informe_condiciones_salud'];
$resultado_nivel_nal_informe_condiciones_salud                = $datos_informe_condiciones_salud['resultado_nivel_nal_informe_condiciones_salud'];
$caracter_sociodemo_informe_condiciones_salud                 = $datos_informe_condiciones_salud['caracter_sociodemo_informe_condiciones_salud'];
$distrib_sexo_informe_condiciones_salud                       = $datos_informe_condiciones_salud['distrib_sexo_informe_condiciones_salud'];
$distrib_grup_etarico_informe_condiciones_salud               = $datos_informe_condiciones_salud['distrib_grup_etarico_informe_condiciones_salud'];
$distrib_nivel_escolar_informe_condiciones_salud              = $datos_informe_condiciones_salud['distrib_nivel_escolar_informe_condiciones_salud'];
$caracteristica_lab_cargo_informe_condiciones_salud           = $datos_informe_condiciones_salud['caracteristica_lab_cargo_informe_condiciones_salud'];
$distrib_poblacion_antig_informe_condiciones_salud            = $datos_informe_condiciones_salud['distrib_poblacion_antig_informe_condiciones_salud'];
$peligro_precibid_informe_condiciones_salud                   = $datos_informe_condiciones_salud['peligro_precibid_informe_condiciones_salud'];
$factor_riesg_ocupacional_informe_condiciones_salud           = $datos_informe_condiciones_salud['factor_riesg_ocupacional_informe_condiciones_salud'];
$habit_extra_lab_informe_condiciones_salud                    = $datos_informe_condiciones_salud['habit_extra_lab_informe_condiciones_salud'];
$consumo_cigarr_informe_condiciones_salud                     = $datos_informe_condiciones_salud['consumo_cigarr_informe_condiciones_salud'];
$actividad_fisica_informe_condiciones_salud                   = $datos_informe_condiciones_salud['actividad_fisica_informe_condiciones_salud'];
$masa_corp_informe_condiciones_salud                          = $datos_informe_condiciones_salud['masa_corp_informe_condiciones_salud'];
$enf_laboral_informe_condiciones_salud                        = $datos_informe_condiciones_salud['enf_laboral_informe_condiciones_salud'];
$enf_laboral_reportada_informe_condiciones_salud              = $datos_informe_condiciones_salud['enf_laboral_reportada_informe_condiciones_salud'];
$accidente_lab_informe_condiciones_salud                      = $datos_informe_condiciones_salud['accidente_lab_informe_condiciones_salud'];
$diag_principales_informe_condiciones_salud                   = $datos_informe_condiciones_salud['diag_principales_informe_condiciones_salud'];
$recomendacion_general_informe_condiciones_salud              = $datos_informe_condiciones_salud['recomendacion_general_informe_condiciones_salud'];
$recomendacion_especif_informe_condiciones_salud              = $datos_informe_condiciones_salud['recomendacion_especif_informe_condiciones_salud'];
$promo_preven_salud_informe_condiciones_salud                 = $datos_informe_condiciones_salud['promo_preven_salud_informe_condiciones_salud'];
$control_riesg_ocupa_informe_condiciones_salud                = $datos_informe_condiciones_salud['control_riesg_ocupa_informe_condiciones_salud'];
$divulg_resultado_informe_condiciones_salud                   = $datos_informe_condiciones_salud['divulg_resultado_informe_condiciones_salud'];
$medida_control_informe_condiciones_salud                     = $datos_informe_condiciones_salud['medida_control_informe_condiciones_salud'];
$seguimiento_informe_condiciones_salud                        = $datos_informe_condiciones_salud['seguimiento_informe_condiciones_salud'];
$fecha_mes                                                    = $datos_informe_condiciones_salud['fecha_mes'];
$fecha_anyo                                                   = $datos_informe_condiciones_salud['fecha_anyo'];
$fecha_ymd                                                    = $datos_informe_condiciones_salud['fecha_ymd'];
$fecha_dmy                                                    = $datos_informe_condiciones_salud['fecha_dmy'];
$hora                                                         = $datos_informe_condiciones_salud['hora'];
$fecha_time                                                   = $datos_informe_condiciones_salud['fecha_time'];
$fecha_reg_time                                               = $datos_informe_condiciones_salud['fecha_reg_time'];
$cuenta_reg                                                   = $datos_informe_condiciones_salud['cuenta'];
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
if ($total_motivo==1) { 
$motivo                              = $datos2['motivo'];

$motivos                             = "motivo='".$motivo."'";
$motivos_                            = "tbl15_historia_clinica.motivo='".$motivo."'";
$url_motivos                         = "motivo=".$motivo;
$motivo_limpia                       = str_replace(' ', '_', $motivo);
$nombre_motivo                       = $motivo;

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
}
elseif ($total_motivo==2) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2);
$nombre_motivo                       = $motivo.' Y '.$motivo2;

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
}
elseif ($total_motivo==3) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];
$motivo3                             = $datos2['motivo3'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3);
$nombre_motivo                       = $motivo.', '.$motivo2.' Y '.$motivo3;

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
}
elseif ($total_motivo==4) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];
$motivo3                             = $datos2['motivo3'];
$motivo4                             = $datos2['motivo4'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.' Y '.$motivo4;

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
}
elseif ($total_motivo==5) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];
$motivo3                             = $datos2['motivo3'];
$motivo4                             = $datos2['motivo4'];
$motivo5                             = $datos2['motivo5'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.' Y '.$motivo5;

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
}
elseif ($total_motivo==6) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];
$motivo3                             = $datos2['motivo3'];
$motivo4                             = $datos2['motivo4'];
$motivo5                             = $datos2['motivo5'];
$motivo6                             = $datos2['motivo6'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.' Y '.$motivo6;

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
}
elseif ($total_motivo==7) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];
$motivo3                             = $datos2['motivo3'];
$motivo4                             = $datos2['motivo4'];
$motivo5                             = $datos2['motivo5'];
$motivo6                             = $datos2['motivo6'];
$motivo7                             = $datos2['motivo7'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.' Y '.$motivo7;

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
}
elseif ($total_motivo==8) { 
$motivo                              = $datos2['motivo'];
$motivo2                             = $datos2['motivo2'];
$motivo3                             = $datos2['motivo3'];
$motivo4                             = $datos2['motivo4'];
$motivo5                             = $datos2['motivo5'];
$motivo6                             = $datos2['motivo6'];
$motivo7                             = $datos2['motivo7'];
$motivo8                             = $datos2['motivo8'];

$motivos                             = "(motivo='".$motivo."') OR (motivo='".$motivo2."') OR (motivo='".$motivo3."') OR (motivo='".$motivo4."') OR (motivo='".$motivo5."') OR (motivo='".$motivo6."') OR (motivo='".$motivo7."') OR (motivo='".$motivo8."')";
$motivos_                            = "(tbl15_historia_clinica.motivo='".$motivo."') OR (tbl15_historia_clinica.motivo='".$motivo2."') OR (tbl15_historia_clinica.motivo='".$motivo3."') OR (tbl15_historia_clinica.motivo='".$motivo4."') OR (tbl15_historia_clinica.motivo='".$motivo5."') OR (tbl15_historia_clinica.motivo='".$motivo6."') OR (tbl15_historia_clinica.motivo='".$motivo7."') OR (tbl15_historia_clinica.motivo='".$motivo8."')";
$url_motivos                         = "motivo=".$motivo."&motivo2=".$motivo2."&motivo3=".$motivo3."&motivo4=".$motivo4."&motivo5=".$motivo5."&motivo6=".$motivo6."&motivo7=".$motivo7."&motivo8=".$motivo8;
$motivo_limpia                       = str_replace(' ', '_', $motivo.'-'.$motivo2.'-'.$motivo3.'-'.$motivo4.'-'.$motivo5.'-'.$motivo6.'-'.$motivo7.'-'.$motivo8);
$nombre_motivo                       = $motivo.', '.$motivo2.', '.$motivo3.', '.$motivo4.', '.$motivo5.', '.$motivo6.', '.$motivo7.' Y '.$motivo8;

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
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
?>
<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<title>DIAGNOSTICO_DE_CONDICIONES_DE_SALUD_<?php echo $nombre_empresa_contratante_limpia.'__'.$motivo_limpia.'__'.$fecha_ini_ymd.'__'.$fecha_fin_ymd;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php //include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<style>
@media all { div.saltopagina { display: none; } }
@media print { div.saltopagina { display:block; page-break-before:always; } }

#chartdiv01 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv02 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv03 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv04 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv05 { width: 100%; height: 800px; font-size: 15px; }
#chartdiv06 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv07 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv08 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv09 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv10 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv11 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv12 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv13 { width: 100%; height: 800px; font-size: 15px; }
#chartdiv14 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv15 { width: 100%; height: 600px; font-size: 15px; }

.amcharts-pie-slice {
transform: scale(1); transform-origin: 50% 50%; transition-duration: 0.3s; transition: all .3s ease-out; -webkit-transition: all .3s ease-out; 
-moz-transition: all .3s ease-out; -o-transition: all .3s ease-out; cursor: pointer; box-shadow: 0 0 30px 0 #000;
}
.amcharts-pie-slice:hover { transform: scale(1.1); filter: url(#shadow); }             
</style>
<!-- Resources -->

<script src="../js/amcharts_graf/amcharts.js"></script>
<script src="../js/amcharts_graf/funnel.js"></script>
<script src="../js/amcharts_graf/pie.js"></script>
<script src="../js/amcharts_graf/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/amcharts_graf/dataloader.min.js"></script>
<script src="../js/amcharts_graf/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="../js/amcharts_graf/plugins/export/export.css" type="text/css" media="all" />
<script src="../js/amcharts_graf/themes/light.js"></script>
<script src="../js/amcharts_graf/themes/black.js"></script>
<script src="../js/amcharts_graf/themes/chalk.js"></script>
<script src="../js/amcharts_graf/themes/dark.js"></script>
<script src="../js/amcharts_graf/themes/patterns.js"></script>

</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
 <!--Edit Main Content Area here-->
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
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
?>

<table class="table-responsive" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">

<br><br>

<?php echo ($portada_informe_condiciones_salud) ?>
<?php echo ($introduccion_informe_condiciones_salud) ?>
<?php echo ($objetivo_informe_condiciones_salud) ?>

<?php echo ($material_metodo_informe_condiciones_salud) ?>

<?php echo ($resultado_nivel_nal_informe_condiciones_salud) ?>

<?php echo ($caracter_sociodemo_informe_condiciones_salud) ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php
$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(dat_ocupa_carg1) AS conteo_dat_ocupa_carg1, dat_ocupa_carg1, nombre_empresa_contratante
FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1))
GROUP BY dat_ocupa_carg1 LIMIT 0,40";
$result1 = mysqli_query($conectar, $query1);

$smtr_porcentaje                = 0;
?>
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">ÁREA O SECCIÓN</th>
    <th style="text-align:center">POBLACION TOTAL</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
while ($datos = mysqli_fetch_assoc($result1) ) { 

$dat_ocupa_carg1              = $datos['dat_ocupa_carg1'];
$conteo_dat_ocupa_carg1       = $datos['conteo_dat_ocupa_carg1'];
$porcentaje_dat_ocupa_carg1   = (($conteo_dat_ocupa_carg1 / $total_poblacion) * 100);
$smtr_porcentaje             += $porcentaje_dat_ocupa_carg1;
?>
<tr>
    <td><?php echo $dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo $conteo_dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo  round($porcentaje_dat_ocupa_carg1, 2) ?>%</td>
</tr>
<?php } ?>
<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center"><?php echo round($ptj_cobertura, 2) ?>%</th>
</tr>
</tbody>
</table>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
var chartdiv01 = AmCharts.makeChart("chartdiv01", {
"type": "pie",
    "titles": [ {
     "text": "PERSONAS EVALUADAS",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_personevaluada_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_person_eval",
    "valueField": "conteo_estado_facturacion",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>

<div id="chartdiv01"></div>

<p>Ilustración 1: Proporción de personas evaluadas<br><br></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
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
?>

<?php echo ($distrib_sexo_informe_condiciones_salud) ?>

<script>
var chartdiv02 = AmCharts.makeChart("chartdiv02", {
"type": "pie",
    "titles": [ {
     "text": "DISTRIBUCION POR SEXO",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_sexo_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_sexo",
    "valueField": "conteo_nombre_sexo",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv02"></div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
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
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php echo ($distrib_grup_etarico_informe_condiciones_salud) ?>

<br><br>

<script>
var chartdiv03 = AmCharts.makeChart("chartdiv03", {
"type": "pie",
    "titles": [ {
     "text": "DISTRIBUCION SEGUN GRUPO ETÁRIO",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_edad_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_edad_anyo",
    "valueField": "conteo_edad_anyo",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv03"></div>


<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
<th style="text-align:center">RANGO EDAD</th>
<th style="text-align:center">No</th>
<th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
for($i=0; $i<count($vector_edad); $i++) {

  $posicion_vector = $i;

  if ($posicion_vector == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor 20'; }
  if ($posicion_vector == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = '20 - 29'; }
  if ($posicion_vector == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = '30 - 39'; }
  if ($posicion_vector == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = '40 - 49'; }
  if ($posicion_vector == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'MAYOR 50'; }
?>
<tr>
<td><?php echo $nombre_posicion_vector ?></td>
<td style="text-align:center"><?php echo $vector_edad[$i] ?></td>
<td style="text-align:center"><?php echo round($ptj_edad, 2) ?>%</td>
</tr>
<?php } ?>
<tr class="table-dark">
<th>TOTAL</th>
<th style="text-align:center"><?php echo $total_poblacion ?></th>
<th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php echo ($distrib_nivel_escolar_informe_condiciones_salud) ?>

<script>
var chartdiv04 = AmCharts.makeChart("chartdiv04", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
     "text": "ESCOLARIDAD",
     "size": 16
    } ],
    dataLoader: { "url": "data_3D_Column_Chart_fecharango_empresa_contratante_motivo_escolaridad_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },

    "valueAxes": [{
        "title": "Total"
    }],
    "graphs": [{
        "balloonText": "ESCOLARIDAD: [[category]] - [[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "ESCOLARIDAD",
        "type": "column",
        "valueField": "conteo_nombre_escolaridad"
    }],
    "depth3D": 20,
    "angle": 30,
    "rotate": true,
    "categoryField": "nombre_escolaridad",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left"
    },
    "export": {
      "enabled": true
     }
});
</script>
<div id="chartdiv04"></div> 

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">NIVEL DE ESCOLARIDAD</th>
    <th style="text-align:center">Total</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(nombre_escolaridad) AS conteo_nombre_escolaridad, nombre_escolaridad, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1)) 
GROUP BY nombre_escolaridad ORDER BY conteo_nombre_escolaridad DESC";
$result2 = mysqli_query($conectar, $query2);

$smtr_porcentaje            = 0;

while ($datos2 = mysqli_fetch_assoc($result2) ) {

$nombre_escolaridad           = $datos2['nombre_escolaridad'];
$conteo_nombre_escolaridad    = $datos2['conteo_nombre_escolaridad'];
$porcentaje_escolaridad       = ((($conteo_nombre_escolaridad / $total_poblacion) * 100));
$smtr_porcentaje             += $porcentaje_escolaridad;
?>
<tr>
    <td style="text-align:left"><?php echo $nombre_escolaridad ?></td>
    <td style="text-align:center"><?php echo $conteo_nombre_escolaridad ?></td>
    <td style="text-align:center"><?php echo round($porcentaje_escolaridad, 2) ?>%</td>
</tr>
<?php } ?>
<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center"><?php echo $smtr_porcentaje ?>%</th>
</tr>
</tbody>
</table>
</div>

<br>
<?php
$query2 = "SELECT fecha_ymd, cod_estado_facturacion, Count(dat_ocupa_carg1) AS contar_dat_ocupa_carg1, dat_ocupa_carg1, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1)) 
GROUP BY dat_ocupa_carg1 ORDER BY conteo_dat_ocupa_carg1 DESC LIMIT 0,40";
$result2 = mysqli_query($conectar, $query2);

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, Count(dat_ocupa_carg1) AS conteo_dat_ocupa_carg1, dat_ocupa_carg1, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa_contratante='$nombre_empresa_contratante') AND ($motivos) AND (cod_estado_facturacion=1))
GROUP BY dat_ocupa_carg1 ORDER BY conteo_dat_ocupa_carg1 DESC LIMIT 0,40";
$result1 = mysqli_query($conectar, $query1);
?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>
<?php echo ($caracteristica_lab_cargo_informe_condiciones_salud) ?>

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">#</th>
    <th style="text-align:center">CARGO</th>
    <th style="text-align:center">Total</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
$conteo = 0;
while ($datos = mysqli_fetch_assoc($result1) ) {
$conteo++;
$dat_ocupa_carg1          = $datos['dat_ocupa_carg1'];
$conteo_dat_ocupa_carg1   = $datos['conteo_dat_ocupa_carg1'];
$ptj_carg                 = ($conteo_dat_ocupa_carg1 / $total_poblacion) * 100;
?>
<tr>
    <td style="text-align:center"><?php echo $conteo ?></td>
    <td style="text-align:left"><?php echo $dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo $conteo_dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo round($ptj_carg, 2) ?>%</td>

</tr>
<?php } ?>
</tbody>
</table>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<br><br>
<script>
var chartdiv06 = AmCharts.makeChart("chartdiv05", {
"type": "pie",
    "titles": [ {
     "text": "DENOMINACIÓN DEL CARGO",
     "size": 16
    } ],
dataLoader: { "url": "data_3D_Column_Chart_fecharango_empresa_contratante_motivo_cargo_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "dat_ocupa_carg1",
    "valueField": "conteo_dat_ocupa_carg1",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv05"></div> 

<?php
$query1 = "SELECT fecha_ymd, dat_ocupa_dura_anyo1, cod_estado_facturacion, nombre_empresa_contratante, motivo
FROM tbl15_historia_clinica
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

if ($posicion_indice == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor de 2 Años'; }
if ($posicion_indice == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 2 a 5 Años'; }
if ($posicion_indice == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 6 a 10 Años'; }
if ($posicion_indice == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 11 a 15 Años'; }
if ($posicion_indice == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 16 a 20 Años'; }
if ($posicion_indice == 5) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Mayor de 20 Años'; }
?>

<?php echo ($distrib_poblacion_antig_informe_condiciones_salud) ?>

<script>
var chartdiv06 = AmCharts.makeChart("chartdiv06", {
"type": "pie",
    "titles": [ {
     "text": "DISTRIBUCION POR ANTIGUEDAD",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_distribucion_edad_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "edad_anyo_distrib",
    "valueField": "conteo_edad_distrib",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv06"></div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php echo ($peligro_precibid_informe_condiciones_salud) ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<br><br>

<script>
var chartdiv07 = AmCharts.makeChart( "chartdiv07", {
  "theme": "light",
  "type": "serial",
    "titles": [ {
     "text": "FACTOR DE RIESGO OCUPACIONAL",
     "size": 16
    } ],
    dataLoader: { "url": "data_Simple_Column_Chart_fecharango_empresa_contratante_motivo_peligros.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },

  "categoryField": "nombre_riesgo",
  "depth3D": 20,
  "angle": 30,

  "categoryAxis": {
    "labelRotation": 60,
    "gridPosition": "start"
  },

  "valueAxes": [ {
    "title": "Valores"
  } ],

  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "valueField": "conteo_riesgo",
    "colorField": "color",
    "type": "column",
    "lineAlpha": 0.1,
    "fillAlphas": 1
  } ],

  "chartCursor": {
    "cursorAlpha": 0,
    "zoomable": false,
    "categoryBalloonEnabled": false
  },

  "export": {
    "enabled": true
  }
} );
</script>

<div id="chartdiv07"></div>

<?php echo ($habit_extra_lab_informe_condiciones_salud) ?>

<script>
var chartdiv08 = AmCharts.makeChart("chartdiv08", {
"type": "pie",
    "titles": [ {
     "text": "CONSUMO DE CIGARRILLO",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_habito_extra_lab_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_habit_extra_lab",
    "valueField": "conteo_habit_extra_lab",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv08"></div>

<?php echo ($consumo_cigarr_informe_condiciones_salud) ?>

<?php
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
?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php echo ($actividad_fisica_informe_condiciones_salud) ?>

<script>
var chartdiv09 = AmCharts.makeChart("chartdiv09", {
"type": "pie",
    "titles": [ {
     "text": "PRACTICA DE ACTIVIDAD FÍSICA",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_actividad_fisica_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_actividad_fisica",
    "valueField": "conteo_actividad_fisica",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv09"></div>


<?php
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
?>

<?php echo ($masa_corp_informe_condiciones_salud) ?>

<script>
var chartdiv10 = AmCharts.makeChart("chartdiv10", {
"type": "pie",
    "titles": [ {
     "text": "INDICE DE MASA CORPORAL",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_imc_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_imc",
    "valueField": "conteo_imc",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv10"></div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php echo ($enf_laboral_informe_condiciones_salud) ?>

<script>
var chartdiv11 = AmCharts.makeChart("chartdiv11", {
"type": "pie",
    "titles": [ {
     "text": "ENFERMEDAD PROFESIONAL",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_enfermedad_laboral_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_enf_lab",
    "valueField": "conteo_enf_lab",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv11"></div>

<?php echo ($enf_laboral_reportada_informe_condiciones_salud) ?>

<script>
var chartdiv12 = AmCharts.makeChart("chartdiv12", {
"type": "pie",
    "titles": [ {
     "text": "ACCIDENTE LABORAL",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_accidente_laboral_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_accidente_laboral",
    "valueField": "conteo_accidente_laboral",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv12"></div>

<?php echo ($accidente_lab_informe_condiciones_salud) ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<br><br>

<script>
var chartdiv12 = AmCharts.makeChart("chartdiv13", {
"type": "pie",
    "titles": [ {
     "text": "PRINCIPALES DIAGNÓSTICOS",
     "size": 16
    } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_fecharango_empresa_contratante_motivo_diagnostico_cie10_limit15_json.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $url_motivos ?>" },
    "titleField": "nombre_cie10_diag",
    "valueField": "conteo_cie10_cod",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv13"></div>

<?php echo ($diag_principales_informe_condiciones_salud) ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="saltopagina"></div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br><br>

<?php echo ($recomendacion_general_informe_condiciones_salud) ?>
<?php echo ($recomendacion_especif_informe_condiciones_salud) ?>
<?php echo ($promo_preven_salud_informe_condiciones_salud) ?>
<?php echo ($control_riesg_ocupa_informe_condiciones_salud) ?>
<?php echo ($divulg_resultado_informe_condiciones_salud) ?>
<?php echo ($medida_control_informe_condiciones_salud) ?>
<?php echo ($seguimiento_informe_condiciones_salud) ?>
<!-- /////////////////////////////////////////////////// -->
</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<!--End Main Content Area-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php //include_once('../admin/05_modulo_js.php'); ?>

</body>
</html>