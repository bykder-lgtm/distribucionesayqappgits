<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1; 
$nombre_empresa                    = addslashes($_GET['nombre_empresa']);
$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$total_motivo                      = intval($_GET['total_motivo']);
$cuenta                            = addslashes($_GET['cuenta']);
$fecha                             = addslashes($_GET['fecha']);
$fecha_ini_seg                     = strtotime($fecha_ini);
$fecha_seg                         = strtotime($fecha);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);
$fecha_ymdhis                      = date("Y/m/d H:i:s");
$anyo_fecha_ini                    = date("Y", $fecha_ini_seg);
$frag_empresa                      = explode('-', $nombre_empresa);
$nombre_empresa_frag               = substr($nombre_empresa, 0, 30);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_factura_max = "SELECT MAX(cod_factura) AS cod_factura_max FROM tbl15_info_factura_venta";
$resultado_info_factura_max = mysqli_query($conectar, $sql_info_factura_max);
$info_info_factura_max = mysqli_fetch_assoc($resultado_info_factura_max);

$cod_factura_max                   = $info_info_factura_max['cod_factura_max'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_factura = "SELECT cod_factura, fecha_ini, fecha_fin, nombre_empresa, motivo FROM tbl15_info_factura_venta WHERE cod_factura = '$cod_factura_max'";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$fecha_ini_db                      = $info_info_factura['fecha_ini'];
$fecha_fin_db                      = $info_info_factura['fecha_fin'];
$nombre_empresa_db                 = $info_info_factura['nombre_empresa'];
$motivo_db                         = $info_info_factura['motivo'];
$cod_factura                       = $info_info_factura['cod_factura']+1;
$nombre_archivo                    = 'PERFIL_SOCIODEMOCRAFICO_'.$cod_factura.'_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT cod_empresa, nombre_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_empresa                       = $info_profesional['cod_empresa'];
$direccion_empresa                 = $info_profesional['direccion_empresa'];
$telefono_empresa                  = $info_profesional['telefono_empresa'];
$nit_empresa                       = $info_profesional['nit_empresa'];

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                        = $info_empresa_data['titulo'];
$nombre_emp                        = $info_empresa_data['nombre'];
$eslogan_emp                       = $info_empresa_data['eslogan'];
$direccion_emp                     = $info_empresa_data['direccion'];
$ciudad_emp                        = $info_empresa_data['ciudad'];
$pais_emp                          = $info_empresa_data['pais'];
$correo_emp                        = $info_empresa_data['correo'];
$img_cabecera_emp                  = $info_empresa_data['img_cabecera'];
$telefono_emp                      = $info_empresa_data['telefono'];
$info_legal_emp                    = $info_empresa_data['info_legal'];
$logotipo_emp                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                      = $info_empresa_data['cabecera'];
$icono_emp                         = $info_empresa_data['icono'];
$desarrollador_emp                 = $info_empresa_data['desarrollador'];
$anyo_emp                          = $info_empresa_data['anyo'];
$url_pag                           = $info_empresa_data['url_pag'];
$nombre_font_emp                   = $info_empresa_data['nombre_font'];
$tamano_font_emp                   = $info_empresa_data['tamano_font'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_factura'];
$res_emp                           = $info_empresa_data['res'];
$res1_emp                          = $info_empresa_data['res1'];
$res2_emp                          = $info_empresa_data['res2'];
$departamento_emp                  = $info_empresa_data['departamento'];
$localidad_emp                     = $info_empresa_data['localidad'];
$reg_medico_emp                    = $info_empresa_data['reg_medico'];
$regimen_emp                       = $info_empresa_data['regimen'];
$version_emp                       = $info_empresa_data['version'];
$propietario_url_firma_emp         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                    = $info_empresa_data['fecha_time'];
$licencia_emp                      = $info_empresa_data['licencia'];
$info_histclinic_emp               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp               = $info_empresa_data['info_aptlaboral'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
if ($total_motivo==1) {
$motivo = addslashes($_GET['motivo']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==2) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==3) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_estrato, tbl15_cliente.fecha_nac_ymd, tbl15_historia_clinica.nombre_estado_civil, 
tbl15_historia_clinica.nombre_escolaridad, tbl15_historia_clinica.nombre_escolaridad_estado, tbl15_historia_clinica.clasrieg_ergo1_trabestat, tbl15_historia_clinica.clasrieg_ergo1_trabestat,
tbl15_historia_clinica.clasrieg_ergo1_esfuerfis, tbl15_historia_clinica.clasrieg_ergo1_movrepet, tbl15_historia_clinica.clasrieg_ergo1_postforz,
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==4) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==5) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==6) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==7) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==8) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==9) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==10) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);
$motivo10 = addslashes($_GET['motivo10']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9') 
OR (tbl15_historia_clinica.motivo='$motivo10')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==11) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);
$motivo10 = addslashes($_GET['motivo10']);
$motivo11 = addslashes($_GET['motivo11']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1,, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9') 
OR (tbl15_historia_clinica.motivo='$motivo10') OR (tbl15_historia_clinica.motivo='$motivo11')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==12) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);
$motivo10 = addslashes($_GET['motivo10']);
$motivo11 = addslashes($_GET['motivo11']);
$motivo12 = addslashes($_GET['motivo12']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9') 
OR (tbl15_historia_clinica.motivo='$motivo10') OR (tbl15_historia_clinica.motivo='$motivo11') OR (tbl15_historia_clinica.motivo='$motivo12')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==13) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);
$motivo10 = addslashes($_GET['motivo10']);
$motivo11 = addslashes($_GET['motivo11']);
$motivo12 = addslashes($_GET['motivo12']);
$motivo13 = addslashes($_GET['motivo13']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9') 
OR (tbl15_historia_clinica.motivo='$motivo10') OR (tbl15_historia_clinica.motivo='$motivo11') OR (tbl15_historia_clinica.motivo='$motivo12') 
OR (tbl15_historia_clinica.motivo='$motivo13')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==14) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);
$motivo10 = addslashes($_GET['motivo10']);
$motivo11 = addslashes($_GET['motivo11']);
$motivo12 = addslashes($_GET['motivo12']);
$motivo13 = addslashes($_GET['motivo13']);
$motivo14 = addslashes($_GET['motivo14']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9') 
OR (tbl15_historia_clinica.motivo='$motivo10') OR (tbl15_historia_clinica.motivo='$motivo11') OR (tbl15_historia_clinica.motivo='$motivo12') 
OR (tbl15_historia_clinica.motivo='$motivo13') OR (tbl15_historia_clinica.motivo='$motivo14')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==15) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);
$motivo9 = addslashes($_GET['motivo9']);
$motivo10 = addslashes($_GET['motivo10']);
$motivo11 = addslashes($_GET['motivo11']);
$motivo12 = addslashes($_GET['motivo12']);
$motivo13 = addslashes($_GET['motivo13']);
$motivo14 = addslashes($_GET['motivo14']);
$motivo15 = addslashes($_GET['motivo15']);

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo,
tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_grupo_rh, tbl15_cliente.fecha_nac_ymd, tbl15_historia_clinica.nombre_escolaridad, tbl15_historia_clinica.nombre_escolaridad_estado, 
tbl15_historia_clinica.nombre_estado_civil, 
tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.nombre_empresa = tbl15_historia_clinica.nombre_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') 
OR (tbl15_historia_clinica.motivo='$motivo4') OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') 
OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8') OR (tbl15_historia_clinica.motivo='$motivo9') 
OR (tbl15_historia_clinica.motivo='$motivo10') OR (tbl15_historia_clinica.motivo='$motivo11') OR (tbl15_historia_clinica.motivo='$motivo12') 
OR (tbl15_historia_clinica.motivo='$motivo13') OR (tbl15_historia_clinica.motivo='$motivo14') OR (tbl15_historia_clinica.motivo='$motivo15')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
if (PHP_SAPI == 'cli')
	die('Este ejemplo solo debe ejecutarse desde un navegador web');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/class_php/PHPExcel/PHPExcel.php';

//$estilo = array('font'  => array('bold'  => true, 'size'  => 10, 'name'  => 'Calibri', 'color' => array( 'rgb' => 'F2DDDC' ) ));
$estilo_texto                         = array('font' => array('bold' => false, 'size' => 10, 'name'  => 'Calibri'));
$estilo_texto_negrita                 = array('font' => array('bold' => true, 'size'  => 10, 'name'  => 'Calibri'));
$estilo_texto_grande_negrita          = array('font' => array('bold' => true, 'size'  => 15, 'name'  => 'Calibri'));
$estilo_texto_extra_grande_negrita    = array('font' => array('bold' => true, 'size'  => 30, 'name'  => 'Calibri'));
$estilo_celda_centro_borde            = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ), 'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));
$estilo_celda_centro                  = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ));
$estilo_celda_izquierda               = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ));
$estilo_celda_izquierda_borde         = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ), 'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));
$estilo_celda_derecha                 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, ));
$estilo_celda_derecha_borde           = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, ), 'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));
$estilo_celda_centro_borde_ext        = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ), 'borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$increment                        = 5;
$increment_estilo_celda5                 = 5;
$fecha_hoy_time                   = strtotime(date("Y/m/d"));
// Set document properties
$objPHPExcel->getProperties()
			->setCreator($cabecera_emp)
			->setLastModifiedBy($cabecera_emp)
			->setTitle("PERFIL SOCIODEMOGRAFICO - ".$cabecera_emp)
			->setSubject("PERFIL SOCIODEMOGRAFICO - ".$cabecera_emp)
			->setDescription($cabecera_emp)
			->setKeywords($cabecera_emp)
			->setCategory($cabecera_emp);

PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

$objPHPExcel->getActiveSheet()->mergeCells('B1:AW1');//INFORME DE CONDICIONES DE SALUD
$objPHPExcel->getActiveSheet()->mergeCells('B2:V4');//INFORMACIÓN SOCIODEMOGRAFÍCA

$objPHPExcel->getActiveSheet()->mergeCells('w2:AF3');//ANTECEDENTES DE EXPOSICIÓN LABORAL (DME)
$objPHPExcel->getActiveSheet()->mergeCells('w4:X4');//Cargas estáticas
$objPHPExcel->getActiveSheet()->mergeCells('Y4:Z4');//Sobre esfuerzos	
$objPHPExcel->getActiveSheet()->mergeCells('AA4:AB4');//Carga dinámica
$objPHPExcel->getActiveSheet()->mergeCells('AC4:AD4');//Movimientos repetitivos
$objPHPExcel->getActiveSheet()->mergeCells('AE4:AF4');//Posturas inadecuadas

$objPHPExcel->getActiveSheet()->mergeCells('AG2:AK3');//INFORMACIÓN DE EXPOSICIÓN ACTUAL

$objPHPExcel->getActiveSheet()->mergeCells('AL2:AU3');//X
$objPHPExcel->getActiveSheet()->mergeCells('AL4:AM4');//Transtornos columna
$objPHPExcel->getActiveSheet()->mergeCells('AN4:AO4');//Tendinitis Bursitis
$objPHPExcel->getActiveSheet()->mergeCells('AP4:AQ4');//S.Túnel Carpiano
$objPHPExcel->getActiveSheet()->mergeCells('AR4:AS4');//Osteoartritis
$objPHPExcel->getActiveSheet()->mergeCells('AT4:AU4');//Otros

$objPHPExcel->getActiveSheet()->mergeCells('AV2:AV3');//DIAGNÓSTICOS ENCONTRADOS
//AW

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'INFORME DE CONDICIONES DE SALUD')
			->setCellValue('B2', 'INFORMACIÓN SOCIODEMOGRAFÍCA')

			->setCellValue('W2', 'ANTECEDENTES DE EXPOSICIÓN LABORAL (DME)')
			->setCellValue('W4', 'Cargas estáticas')
			->setCellValue('Y4', 'Sobre esfuerzos')
			->setCellValue('AA4', 'Carga dinámica')
			->setCellValue('AC4', 'Movimientos repetitivos')
			->setCellValue('AE4', 'Posturas inadecuadas')
			->setCellValue('AG2', 'INFORMACIÓN DE EXPOSICIÓN ACTUAL')

			->setCellValue('AL2', 'X')
			->setCellValue('AL4', 'Transtornos columna')
			->setCellValue('AN4', 'Tendinitis Bursitis')
			->setCellValue('AP4', 'S.Túnel Carpiano')
			->setCellValue('AR4', 'Osteoartritis')
			->setCellValue('AT4', 'Otros')

			->setCellValue('AV2', 'DIAGNÓSTICOS ENCONTRADOS')


            ->setCellValue('A'.$increment, '#')
            ->setCellValue('B'.$increment, 'CEDULA')
            ->setCellValue('C'.$increment, 'NOMBRES Y APELLIDOS')
            ->setCellValue('D'.$increment, 'TIPO DE SANGRE (RH)')
            ->setCellValue('E'.$increment, 'SEXO')
            ->setCellValue('F'.$increment, 'FECHA NACIDO')
            ->setCellValue('G'.$increment, 'EDAD')
            ->setCellValue('H'.$increment, 'GRADO DE ESCOLARIDAD')
            ->setCellValue('I'.$increment, 'ESTADO ESCOLARIDAD')
            ->setCellValue('J'.$increment, 'ESTRATO SOCIAL')
            ->setCellValue('K'.$increment, 'TIPO DE VIVIENDA')
            ->setCellValue('L'.$increment, 'TIPO DE POBLACIÓN')
            ->setCellValue('M'.$increment, 'ESTADO CIVIL')
            ->setCellValue('N'.$increment, 'Padre')
            ->setCellValue('O'.$increment, 'Madre')
            ->setCellValue('P'.$increment, 'Hermanos')
            ->setCellValue('Q'.$increment, 'Conyuje')
            ->setCellValue('R'.$increment, 'Hijos')
            ->setCellValue('S'.$increment, 'Otros Familiares')
            ->setCellValue('T'.$increment, 'No Familiares')
            ->setCellValue('U'.$increment, 'VIVE SOLO')
            ->setCellValue('V'.$increment, 'TOTAL HOGAR')
            ->setCellValue('W'.$increment, 'Meses')
            ->setCellValue('X'.$increment, 'H.DIA')
            ->setCellValue('Y'.$increment, 'Meses')
            ->setCellValue('Z'.$increment, 'H.DIA')
            ->setCellValue('AA'.$increment, 'Meses')
            ->setCellValue('AB'.$increment, 'H.DIA')
            ->setCellValue('AC'.$increment, 'Meses')
            ->setCellValue('AD'.$increment, 'H.DIA')
            ->setCellValue('AE'.$increment, 'Meses')
            ->setCellValue('AF'.$increment, 'H.DIA')
            ->setCellValue('AG'.$increment, 'Cargas estáticas')
            ->setCellValue('AH'.$increment, 'Sobre esfuerzos')
            ->setCellValue('AI'.$increment, 'Carga dinámica')
            ->setCellValue('AJ'.$increment, 'Movimientos repetitivos')
            ->setCellValue('AK'.$increment, 'Posturas inadecuadas')
            ->setCellValue('AL'.$increment, 'NIEGA ')
            ->setCellValue('AM'.$increment, 'SI ')
            ->setCellValue('AN'.$increment, 'NIEGA ')
            ->setCellValue('AO'.$increment, 'SI ')
            ->setCellValue('AP'.$increment, 'NIEGA ')
            ->setCellValue('AQ'.$increment, 'SI ')
            ->setCellValue('AR'.$increment, 'NIEGA ')
            ->setCellValue('AS'.$increment, 'SI ')
            ->setCellValue('AT'.$increment, 'NIEGA ')
            ->setCellValue('AU'.$increment, 'SI ')
            ->setCellValue('AV'.$increment, 'CÓDIGO CIE10 (Dec.1477) - NOMBRE DE DIAGNÓSTICO ')
            ->setCellValue('AW'.$increment, 'RECOMENDACIONES MÉDICAS');
            
while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo) ) { 

$numero++;
$cedula                      = $info_motivo_conteo['cedula'];
$nombres                     = $info_motivo_conteo['nombres'];
$apellido1                   = $info_motivo_conteo['apellido1'];
$nombres_apellidos           = $nombres.' '.$apellido1;
$nombre_sexo                 = $info_motivo_conteo['nombre_sexo'];
$nombre_grupo_rh             = $info_motivo_conteo['nombre_grupo_rh'];
$nombre_escolaridad          = $info_motivo_conteo['nombre_escolaridad'];
$nombre_escolaridad_estado   = $info_motivo_conteo['nombre_escolaridad_estado'];
$nombre_estado_civil         = $info_motivo_conteo['nombre_estado_civil'];
$nombre_estrato              = $info_motivo_conteo['nombre_estrato'];
$tipo_vivienda               = "SI";
$tipo_poblacion              = "SI";
$tbl15_estado_civil                = "SI";
$padre                       = "SI";
$madre                       = "SI";
$hermanos                    = "SI";
$conyuje                     = "SI";
$hijos                       = "SI";
$otros_fam                   = "SI";
$no_fam                      = "SI";
$vive_solo                   = "SI";
$total_hogar                 = "SI";
$carg_estatic_meses          = "";
$carg_estatic_hdia           = "";
$sobre_esfuerzo_meses        = "";
$sobre_esfuerzo_hdia         = "";
$carg_dinamic_meses          = "";
$carg_dinamic_hdia           = "";
$mov_repet_meses             = "";
$mov_repet_hdia              = "";
$post_inadec_meses           = "";
$post_inadec_hdia            = "";

$clasrieg_ergo1_trabestat    = $info_motivo_conteo['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis    = $info_motivo_conteo['clasrieg_ergo1_esfuerfis'];
$carg_dinamic                = "";
$clasrieg_ergo1_movrepet     = $info_motivo_conteo['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_postforz     = $info_motivo_conteo['clasrieg_ergo1_postforz'];

$fecha_anyo                  = $info_motivo_conteo['fecha_anyo'];
$fecha_nac_ymd               = $info_motivo_conteo['fecha_nac_ymd'];
$fecha_nac_time              = strtotime($fecha_nac_ymd);
$diferencia_edad             = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                   = floor($diferencia_edad / (365*60*60*24));

$increment ++;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $numero)
            ->setCellValue('B'.$increment, $cedula)
            ->setCellValue('C'.$increment, $nombres_apellidos)
            ->setCellValue('D'.$increment, $nombre_grupo_rh)
            ->setCellValue('E'.$increment, $nombre_sexo)
            ->setCellValue('F'.$increment, $fecha_nac_ymd)
            ->setCellValue('G'.$increment, $edad_anyo)
            ->setCellValue('H'.$increment, $nombre_escolaridad)
			->setCellValue('I'.$increment, $nombre_escolaridad_estado)
			->setCellValue('J'.$increment, $nombre_estrato)
			->setCellValue('K'.$increment, $tipo_vivienda)
			->setCellValue('L'.$increment, $tipo_poblacion)
			->setCellValue('M'.$increment, $tbl15_estado_civil)
			->setCellValue('N'.$increment, $padre)
			->setCellValue('O'.$increment, $madre)
			->setCellValue('P'.$increment, $hermanos)
			->setCellValue('Q'.$increment, $conyuje)
			->setCellValue('R'.$increment, $hijos)
			->setCellValue('S'.$increment, $otros_fam)
			->setCellValue('T'.$increment, $no_fam)
			->setCellValue('U'.$increment, $total_hogar)
			->setCellValue('V'.$increment, $vive_solo)
			->setCellValue('W'.$increment, $carg_estatic_meses)
			->setCellValue('X'.$increment, $carg_estatic_hdia)
			->setCellValue('Y'.$increment, $sobre_esfuerzo_meses)
			->setCellValue('Z'.$increment, $sobre_esfuerzo_hdia)
			->setCellValue('AA'.$increment, $carg_dinamic_meses)
			->setCellValue('AB'.$increment, $carg_dinamic_hdia)
			->setCellValue('AC'.$increment, $mov_repet_meses)
			->setCellValue('AD'.$increment, $mov_repet_hdia)
			->setCellValue('AE'.$increment, $post_inadec_meses)
			->setCellValue('AF'.$increment, $post_inadec_hdia)
			->setCellValue('AG'.$increment, $clasrieg_ergo1_trabestat)
			->setCellValue('AH'.$increment, $clasrieg_ergo1_esfuerfis)
			->setCellValue('AI'.$increment, $carg_dinamic)
			->setCellValue('AJ'.$increment, $clasrieg_ergo1_movrepet)
			->setCellValue('AK'.$increment, $clasrieg_ergo1_postforz)
			->setCellValue('AL'.$increment, $vive_solo)
			->setCellValue('AM'.$increment, $vive_solo)
			->setCellValue('AN'.$increment, $vive_solo)
			->setCellValue('AO'.$increment, $vive_solo)
			->setCellValue('AP'.$increment, $vive_solo)
			->setCellValue('AQ'.$increment, $vive_solo)
			->setCellValue('AR'.$increment, $vive_solo)
			->setCellValue('AS'.$increment, $vive_solo)
			->setCellValue('AT'.$increment, $vive_solo)
			->setCellValue('AU'.$increment, $vive_solo)
			->setCellValue('AV'.$increment, $vive_solo)
            ->setCellValue('AW'.$increment, $vive_solo);
            //->setCellValue('G'.$increment, $nombre_empresa);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->applyFromArray($estilo_celda_centro_borde);
//$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->applyFromArray($estilo_celda_izquierda_borde);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('X'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AK'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AK'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AK'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AL'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AL'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AL'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AM'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AM'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AM'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AN'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AN'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AN'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AO'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AO'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AO'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AP'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AP'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AP'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AQ'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AQ'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AQ'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AR'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AR'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AR'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AS'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AS'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AS'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AT'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AT'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AT'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AU'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AU'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AU'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AV'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AV'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AV'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AW'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AW'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AW'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
}
// Rename worksheet
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo_celda5+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->setTitle("PERFIL SOCIODEMOGRAFICO");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */

/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('A1:AW1')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('A1:AW1')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("A1:AW1")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B2:V4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B2:V4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("B2:V4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('W2:AF3')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('W2:AF3')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("W2:AF3")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('AG2:AK3')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AG2:AK3')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("AG2:AK3")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('AL2:AU3')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AL2:AU3')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("AL2:AU3")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AV2:AV3')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AV2:AV3')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("AV2:AV3")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('EAF1DD');

/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle("A5")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($estilo_texto_extra_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($estilo_celda_centro);
//$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('W2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('W2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('W4:X4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('W4:X4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle('W4:X4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('Y4:Z4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('Y4:Z4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Y4:Z4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AA4:AB4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AA4:AB4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle('AA4:AB4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AC4:AD4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AC4:AD4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle('AC4:AD4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AE4:AF4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AE4:AF4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle('AE4:AF4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('H'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('I'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('J'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('K'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('L'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('S'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('T'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('U'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('V'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('X'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AK'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AK'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AK'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AL'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AL'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AL'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AM'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AM'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AM'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AN'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AN'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AN'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AO'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AO'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AO'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AP'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AP'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AP'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AQ'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AQ'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AQ'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AR'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AR'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AR'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AS'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AS'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AS'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AT'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AT'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AT'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AU'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AU'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AU'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AV'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AV'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AV'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('AW'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AW'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AW'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('AG2')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AG2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AG2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AG4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AG4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AG4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AH4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AH4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AH4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AI4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AI4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AI4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AJ4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AJ4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AJ4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');

$objPHPExcel->getActiveSheet()->getStyle('AK4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AK4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AK4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('AG2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AG2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AG2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('AL2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AL2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AL2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('AL4:AM4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AL4:AM4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AL4:AM4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AN4:AO4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AN4:AO4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AN4:AO4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AP4:AQ4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AP4:AQ4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AP4:AQ4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AR4:AS4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AR4:AS4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AR4:AS4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AT4:AU4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AT4:AU4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AT4:AU4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('AL2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AL2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AL2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AL4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AL4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AL4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AN4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AN4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AN4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AP4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AP4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AP4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AR4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AR4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AR4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('AT4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AT4')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AT4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('AV2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('AV2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('AV2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->setAutoFilter('B5:AW5');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombre_archivo.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
