<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1; 
$nombre_empresa_contratante        = addslashes($_GET['nombre_empresa_contratante']);
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
$frag_empresa                      = explode('-', $nombre_empresa_contratante);
$nombre_empresa_contratante_frag   = substr($nombre_empresa_contratante, 0, 30);
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
$nombre_archivo                    = 'LISTA_EVALUADOS_'.$cod_factura.'_'.$nombre_empresa_contratante.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT * FROM tbl15_empresa_contratante WHERE nombre_empresa_contratante = '$nombre_empresa_contratante'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_empresa_contratante           = $info_profesional['cod_empresa_contratante'];
$direccion_empresa                 = "";
$telefono_empresa                  = "";
$nit_empresa                       = "";

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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==2) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==3) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 

$sql_motivo_conteo = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.fecha_anyo, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa_contratante RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa_contratante.nombre_empresa_contratante = tbl15_historia_clinica.nombre_empresa_contratante
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa_contratante='$nombre_empresa_contratante') 
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
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$smtr_total_costo_motivo_consulta = 0;
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

            ->setCellValue('A1', ''.$nombre_empresa_contratante.' AÑO '.$anyo_fecha_ini)
            ->setCellValue('A'.$increment, '#')
            ->setCellValue('B'.$increment, 'CEDULA')
            ->setCellValue('C'.$increment, 'NOMBRES Y APELLIDOS')
            ->setCellValue('D'.$increment, 'CONCEPTO')
            ->setCellValue('E'.$increment, 'COSTO')
            ->setCellValue('F'.$increment, 'MES')
            ->setCellValue('G'.$increment, 'AÑO');
            //->setCellValue('G'.$increment, 'EMPRESA');

while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo) ) { 

$numero++;
$cedula                              = $info_motivo_conteo['cedula'];
$nombres                             = $info_motivo_conteo['nombres'];
$apellido1                           = $info_motivo_conteo['apellido1'];
$nombres_apellidos                   = $nombres.' '.$apellido1;
$motivo                              = $info_motivo_conteo['motivo'];
$fecha_ymd                           = $info_motivo_conteo['fecha_ymd'];
$nombre_empresa_contratante          = $info_motivo_conteo['nombre_empresa_contratante'];
$costo_motivo_consulta               = $info_motivo_conteo['costo_motivo_consulta'];
$mes                                 = fecha_en_espanol_mes(strtotime($fecha_ymd));
$fecha_anyo                          = $info_motivo_conteo['fecha_anyo'];
$increment ++;

$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A'.$increment, $numero)
            ->setCellValue('B'.$increment, $cedula)
            ->setCellValue('C'.$increment, $nombres_apellidos)
            ->setCellValue('D'.$increment, $motivo)
            ->setCellValue('E'.$increment, $costo_motivo_consulta)
            ->setCellValue('F'.$increment, strtoupper($mes))
            ->setCellValue('G'.$increment, $fecha_anyo);
            //->setCellValue('G'.$increment, $nombre_empresa_contratante);
}
// Rename worksheet
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->setCellValue("D".$nombre_celda_suma, "TOTAL");
$objPHPExcel->getActiveSheet()->setCellValue("E".$nombre_celda_suma, '=SUM(E'.$celda_inicial.':E'.$celda_final.')');

$objPHPExcel->getActiveSheet()->setTitle($nombre_empresa_contratante_frag);
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
