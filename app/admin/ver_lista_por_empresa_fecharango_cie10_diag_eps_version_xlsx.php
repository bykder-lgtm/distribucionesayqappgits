<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
include_once('../evitar_mensaje_error/error.php');
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1; 
$nombre_empresa                    = addslashes($_GET['nombre_empresa']);
$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$cod_entidad                       = intval($_GET['cod_entidad']);
$total_cie10_diag                  = intval($_GET['total_cie10_diag']);
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
$nombre_archivo                    = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
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
if ($total_cie10_diag==1) {
$cie10_diag = addslashes($_GET['cie10_diag']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND (tbl15_cie10diag.cie10_diag='$cie10_diag') AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==2) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2')) AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==3) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==4) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==5) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==6) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==7) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==8) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==9) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') OR (tbl15_cie10diag.cie10_diag='$cie10_diag9')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==10) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==11) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==12) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==13) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);
$cie10_diag13 = addslashes($_GET['cie10_diag13']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==14) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);
$cie10_diag13 = addslashes($_GET['cie10_diag13']);
$cie10_diag14 = addslashes($_GET['cie10_diag14']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13') OR (tbl15_cie10diag.cie10_diag='$cie10_diag14')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==15) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);
$cie10_diag13 = addslashes($_GET['cie10_diag13']);
$cie10_diag14 = addslashes($_GET['cie10_diag14']);
$cie10_diag15 = addslashes($_GET['cie10_diag15']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13') OR (tbl15_cie10diag.cie10_diag='$cie10_diag14') OR (tbl15_cie10diag.cie10_diag='$cie10_diag15')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
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
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$smtr_total_costo_cie10_diag_consulta = 0;
$numero                           = 0;
$increment                        = 2;
$increment_estilo                 = 2;
// Set document properties
$objPHPExcel->getProperties()
->setCreator($cabecera_emp)
->setLastModifiedBy($cabecera_emp)
->setTitle("LISTA - ".$cabecera_emp)
->setSubject("LISTA - ".$cabecera_emp)
->setDescription($cabecera_emp)
->setKeywords($cabecera_emp)
->setCategory($cabecera_emp);
// Add some data
$objPHPExcel->getActiveSheet()->mergeCells('A1:G1'); 

$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A1', ''.$nombre_empresa.' DEL '.$fecha_ini.' AL '.$fecha_fin)
            ->setCellValue('A'.$increment, '#')
            ->setCellValue('B'.$increment, 'CEDULA')
            ->setCellValue('C'.$increment, 'NOMBRES Y APELLIDOS')
            ->setCellValue('D'.$increment, 'CONCEPTO')
            ->setCellValue('E'.$increment, 'DIÁGNOSTICO')
            ->setCellValue('F'.$increment, 'EPS')
            ->setCellValue('G'.$increment, 'COD');

while ($info_cie10_diag_conteo = mysqli_fetch_assoc($resultado_cie10_diag_conteo) ) { 

$numero++;
$cod_historia_clinica          = $info_cie10_diag_conteo['cod_historia_clinica'];
$cod_cliente                   = $info_cie10_diag_conteo['cod_cliente'];
$cedula                        = $info_cie10_diag_conteo['cedula'];
$nombres                       = $info_cie10_diag_conteo['nombres'];
$apellido1                     = $info_cie10_diag_conteo['apellido1'];
$nombres_apellidos             = $nombres.' '.$apellido1;
$motivo                        = $info_cie10_diag_conteo['motivo'];
$nombre_sexo                   = $info_cie10_diag_conteo['nombre_sexo'];
$nombre_empresa                = $info_cie10_diag_conteo['nombre_empresa'];
$nombre_entidad                = $info_cie10_diag_conteo['nombre_entidad'];
$cie10_diag                    = $info_cie10_diag_conteo['cie10_diag'];
$fecha_time                    = $info_cie10_diag_conteo['fecha_time'];
$fecha_dmy                     = date("Y/m/d", $fecha_time);
$hora                          = date("H:i", $fecha_time);
//$mes                           = fecha_en_espanol_mes(strtotime($fecha_ymd));
//$fecha_anyo                    = $info_cie10_diag_conteo['fecha_anyo'];
$increment ++;

$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A'.$increment, $numero)
            ->setCellValue('B'.$increment, $cedula)
            ->setCellValue('C'.$increment, $nombres_apellidos)
            ->setCellValue('D'.$increment, $motivo)
            ->setCellValue('E'.$increment, $cie10_diag)
            ->setCellValue('F'.$increment, $nombre_entidad)
            ->setCellValue('G'.$increment, $cod_historia_clinica);
}
// Rename worksheet
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo+1;
$celda_final                      = $increment;

//$objPHPExcel->getActiveSheet()->setCellValue("D".$nombre_celda_suma, "TOTAL");
//$objPHPExcel->getActiveSheet()->setCellValue("E".$nombre_celda_suma, '=SUM(E'.$celda_inicial.':E'.$celda_final.')');

$objPHPExcel->getActiveSheet()->setTitle($nombre_empresa_frag);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//$estilo = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri', 'color' => array( 'rgb' => 'B8CCE4' ) ));
$estilo_texto = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri' ));
$estilo_celda_centrada = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ) ); 
//$sheet->getDefaultStyle()->applyFromArray($style); 

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('C2D69A');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo)->applyFromArray($estilo_texto);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

$objPHPExcel->getActiveSheet()->getStyle('A'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('B'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('C'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('D'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('E'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('F'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('G'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getStyle('A'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('E'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('F'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('G'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

// Redirect output to a client’s web browser (Excel2007)
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
