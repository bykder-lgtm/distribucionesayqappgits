<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1;
if (isset($_GET['cod_informe_condiciones_salud'])) { $cod_informe_condiciones_salud = intval($_GET['cod_informe_condiciones_salud']); } else { $cod_informe_condiciones_salud = 0; }
if (isset($_GET['fecha'])) { $fecha = addslashes($_GET['fecha']); } else { $fecha = date("Y/m/d"); }
if (isset($_GET['cuenta'])) { $cuenta = addslashes($_GET['cuenta']); } else { $cuenta = ""; }

$cod_empresa                       = addslashes($_GET['cod_empresa']);
$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$total_motivo                      = intval($_GET['total_motivo']);
$fecha_ini_seg                     = strtotime($fecha_ini);
$fecha_seg                         = strtotime($fecha);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);
$fecha_ymdhis                      = date("Y/m/d H:i:s");
$anyo_fecha_ini                    = date("Y", $fecha_ini_seg);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_obtener_empresa = "SELECT * FROM empresa WHERE cod_empresa = '$cod_empresa'";
$consulta_obtener_empresa = mysqli_query($conectar, $sql_obtener_empresa) or die(mysqli_error($conectar));
$matriz_obtener_empresa = mysqli_fetch_assoc($consulta_obtener_empresa);

$nombre_empresa                = $matriz_obtener_empresa['nombre_empresa'];
$razonsocial_empresa           = $matriz_obtener_empresa['razonsocial_empresa'];
$direccion_empresa             = $matriz_obtener_empresa['direccion_empresa'];
$telefono_empresa              = $matriz_obtener_empresa['telefono_empresa'];
$nit_empresa                   = $matriz_obtener_empresa['nit_empresa'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$frag_empresa                      = explode('-', $nombre_empresa);
$nombre_empresa_frag               = substr($nombre_empresa, 0, 30);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
//$sql_info_factura_max = "SELECT MAX(cod_factura) AS cod_factura_max FROM info_factura";
//$resultado_info_factura_max = mysqli_query($conectar, $sql_info_factura_max);
//$info_info_factura_max = mysqli_fetch_assoc($resultado_info_factura_max);

//$cod_factura_max                   = $info_info_factura_max['cod_factura_max'];
//-----------------------------------------------------------------------------------------------------//
////-----------------------------------------------------------------------------------------------------//
//$sql_info_factura = "SELECT cod_factura, fecha_ini, fecha_fin, cod_empresa, motivo FROM info_factura WHERE cod_factura = '$cod_factura_max'";
//$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
//$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

//$fecha_ini_db                      = $info_info_factura['fecha_ini'];
//$fecha_fin_db                      = $info_info_factura['fecha_fin'];
//$nombre_empresa_db                 = $info_info_factura['nombre_empresa'];
//$motivo_db                         = $info_info_factura['motivo'];
//$cod_factura                       = $info_info_factura['cod_factura']+1;
$nombre_archivo                    = 'PERFIL_SOCIODEMOCRAFICO_'.$cod_informe_condiciones_salud.'_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_empresa = "SELECT * FROM info_empresa WHERE cod_info_empresa = '1'";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND (historia_clinica.motivo='$motivo') AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
	$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==2) {
	$motivo = addslashes($_GET['motivo']); 
	$motivo2 = addslashes($_GET['motivo2']); 

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2')) AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
	$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==3) {
	$motivo = addslashes($_GET['motivo']); 
	$motivo2 = addslashes($_GET['motivo2']); 
	$motivo3 = addslashes($_GET['motivo3']); 

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
	$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==4) {
	$motivo = addslashes($_GET['motivo']); 
	$motivo2 = addslashes($_GET['motivo2']); 
	$motivo3 = addslashes($_GET['motivo3']); 
	$motivo4 = addslashes($_GET['motivo4']); 

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
	$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==5) {
	$motivo = addslashes($_GET['motivo']); 
	$motivo2 = addslashes($_GET['motivo2']); 
	$motivo3 = addslashes($_GET['motivo3']); 
	$motivo4 = addslashes($_GET['motivo4']); 
	$motivo5 = addslashes($_GET['motivo5']); 

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
	$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
}
elseif ($total_motivo==6) {
	$motivo = addslashes($_GET['motivo']); 
	$motivo2 = addslashes($_GET['motivo2']); 
	$motivo3 = addslashes($_GET['motivo3']); 
	$motivo4 = addslashes($_GET['motivo4']); 
	$motivo5 = addslashes($_GET['motivo5']); 
	$motivo6 = addslashes($_GET['motivo6']); 

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9') 
	OR (historia_clinica.motivo='$motivo10')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9') 
	OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9') 
	OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') OR (historia_clinica.motivo='$motivo12')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9') 
	OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') OR (historia_clinica.motivo='$motivo12') 
	OR (historia_clinica.motivo='$motivo13')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9') 
	OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') OR (historia_clinica.motivo='$motivo12') 
	OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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

	$sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
	cliente.nombre_grupo_rh, cliente.nombre_sexo, cliente.nombre_estrato, cliente.fecha_nac_ymd, historia_clinica.nombre_estado_civil, 
	historia_clinica.nombre_escolaridad, historia_clinica.nombre_escolaridad_estado, historia_clinica.clasrieg_ergo1_trabestat, historia_clinica.clasrieg_ergo1_trabestat,
	historia_clinica.clasrieg_ergo1_esfuerfis, historia_clinica.clasrieg_ergo1_movrepet, historia_clinica.clasrieg_ergo1_postforz, 
	historia_clinica.clasrieg_ergo1_carga, cliente.nombre_estrato, cliente.nombre_raza, historia_clinica.exa_fis_talla, 
	historia_clinica.exa_fis_peso, historia_clinica.exa_fis_imc, historia_clinica.cargo_empresa, 
	cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
	historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
	historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
	FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
	ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
	WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
	AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') 
	OR (historia_clinica.motivo='$motivo4') OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') 
	OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9') 
	OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') OR (historia_clinica.motivo='$motivo12') 
	OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15')) 
	AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
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
$estilo_texto                         = array('font' => array('bold' => false, 'size' => 8, 'name'  => 'Calibri'));
$estilo_texto_negrita                 = array('font' => array('bold' => true, 'size'  => 8, 'name'  => 'Calibri'));
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
PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$increment                        = 5;
$increment_estilo_celda5          = 5;
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


$objPHPExcel->getActiveSheet()->mergeCells('B1:V1');//INFORME DE CONDICIONES DE SALUD --
$objPHPExcel->getActiveSheet()->mergeCells('B2:L4');//INFORMACIÓN SOCIODEMOGRAFÍCA --
$objPHPExcel->getActiveSheet()->mergeCells('M2:Q4');//INFORMACIÓN DE EXPOSICIÓN ACTUAL --
$objPHPExcel->getActiveSheet()->mergeCells('R2:R4');//DIAGNÓSTICOS ENCONTRADOS --

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'INFORME DE CONDICIONES DE SALUD')
			->setCellValue('B2', 'INFORMACIÓN SOCIODEMOGRAFÍCA')
			->setCellValue('M2', 'INFORMACIÓN DE EXPOSICIÓN ACTUAL')
			->setCellValue('R2', 'DIAGNÓSTICOS ENCONTRADOS')

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
            ->setCellValue('K'.$increment, 'TIPO DE POBLACIÓN')
            ->setCellValue('L'.$increment, 'ESTADO CIVIL')
            ->setCellValue('M'.$increment, 'Cargas estáticas')
            ->setCellValue('N'.$increment, 'Sobre esfuerzos')
            ->setCellValue('O'.$increment, 'Carga dinámica')
            ->setCellValue('P'.$increment, 'Movimientos repetitivos')
            ->setCellValue('Q'.$increment, 'Posturas inadecuadas')
            ->setCellValue('R'.$increment, 'CÓDIGO CIE10 (Dec.1477) - NOMBRE DE DIAGNÓSTICO')
            ->setCellValue('S'.$increment, 'RECOMENDACIONES MÉDICAS')
            ->setCellValue('T'.$increment, 'TALLA (MTS)')
            ->setCellValue('U'.$increment, 'PESO (KG)')
            ->setCellValue('V'.$increment, 'IMC')
            ->setCellValue('W'.$increment, 'CARGO');

while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo) ) { 

$numero++;
$cod_historia_clinica        = $info_motivo_conteo['cod_historia_clinica'];
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
$nombre_raza                 = $info_motivo_conteo['nombre_raza'];
$nombre_estrato              = $info_motivo_conteo['nombre_estrato'];
$clasrieg_ergo1_trabestat    = $info_motivo_conteo['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis    = $info_motivo_conteo['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga        = $info_motivo_conteo['clasrieg_ergo1_carga'];
$clasrieg_ergo1_movrepet     = $info_motivo_conteo['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_postforz     = $info_motivo_conteo['clasrieg_ergo1_postforz'];
$exa_fis_talla               = $info_motivo_conteo['exa_fis_talla'];
$exa_fis_peso                = $info_motivo_conteo['exa_fis_peso'];
$exa_fis_imc                 = $info_motivo_conteo['exa_fis_imc'];
$cargo_empresa               = $info_motivo_conteo['cargo_empresa'];
$fecha_anyo                  = $info_motivo_conteo['fecha_anyo'];
$fecha_nac_ymd               = $info_motivo_conteo['fecha_nac_ymd'];
$fecha_nac_time              = strtotime($fecha_nac_ymd);
$diferencia_edad             = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                   = floor($diferencia_edad / (365*60*60*24));

$obtener_recomendacion = "SELECT recomendacion_general_informe_condiciones_salud FROM informe_condiciones_salud WHERE cod_informe_condiciones_salud = '".($cod_informe_condiciones_salud)."'";
$consultar_recomendacion = mysqli_query($conectar, $obtener_recomendacion) or die(mysqli_error($conectar));
$info_recomendacion = mysqli_fetch_assoc($consultar_recomendacion);

$cadena1 = $info_recomendacion['recomendacion_general_informe_condiciones_salud'];
$resultado1 = str_replace('<div class="table-responsive">', "", $cadena1);
$cadena2 = $resultado1;
$resultado2 = str_replace('<table class="table table-bordered" style="font-family:mono; font-size:15pt">', "", $cadena2);
$cadena3 = $resultado2;
$resultado3 = str_replace('<tbody>', "", $cadena3);
$cadena4 = $resultado3;
$resultado4 = str_replace('<tr>', "", $cadena4);
$cadena5 = $resultado4;
$resultado5 = str_replace('<td style="text-align:left"><strong>9. RECOMENDACIONES </strong></td>', "", $cadena5);
$cadena6 = $resultado5;
$resultado6 = str_replace('</tr>', "", $cadena6);
$cadena7 = $resultado6;
$resultado7 = str_replace('<tr>', "", $cadena7);
$cadena8 = $resultado7;
$resultado8 = str_replace('<td style="text-align:left"><strong>9.1. RECOMENDACIONES GENERALES</strong></td>', "", $cadena8);
$cadena9 = $resultado8;
$resultado9 = str_replace('</tr>', "", $cadena9);
$cadena10 = $resultado9;
$resultado10 = str_replace('<tr>', "", $cadena10);
$cadena11 = $resultado10;
$resultado11 = str_replace('<td style="text-align:left">', "", $cadena11);
$cadena12 = $resultado11;
$resultado12 = str_replace('', "", $cadena12);
$cadena13 = $resultado12;
$resultado13 = str_replace('</td>', "", $cadena13);
$cadena14 = $resultado13;
$resultado14 = str_replace('</tr>', "", $cadena14);
$cadena15 = $resultado14;
$resultado15 = str_replace('</tbody>', "", $cadena15);
$cadena16 = $resultado15;
$resultado16 = str_replace('</table>', "", $cadena16);
$cadena17 = $resultado16;
$resultado17 = str_replace('</div>', "", $cadena17);

$cadena18 = $resultado17;
$resultado18 = str_replace('<table class="table table-bordered" style="font-family:mono; font-size:12pt">', "", $cadena18);
$cadena19 = $resultado18;
$resultado19 = str_replace('<strong>4. RECOMENDACIONES </strong>', "", $cadena19);
$cadena20 = $resultado19;
$resultado20 = str_replace('<strong>4.1. RECOMENDACIONES GENERALES</strong>', "", $cadena20);

$resultado21 = (trim($resultado20));
//$recomendacion_general_informe_condiciones_salud = str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"), array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $resultado18);
$recomendacion_general_informe_condiciones_salud = str_replace(array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"), $resultado21);


$cie10                       = "";
$conteo                      = 0;

$obtener_cie10diag = "SELECT * FROM cie10diag WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_cie10diag);

while ($info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag)) {
$cod_cie10diag              = $info_cie10diag['cod_cie10diag'];
$cie10_cod                  = $info_cie10diag['cie10_cod'];
$cie10_diag                 = $info_cie10diag['cie10_diag'];

$conteo ++;
if ($total_datos == $conteo) { $cie10 .= "(".$cie10_cod.")"." - ".$cie10_diag; } else { $cie10 .= "(".$cie10_cod.")"." - ".$cie10_diag." -//- "; }
}
$recomend                    = "";
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
			->setCellValue('K'.$increment, $nombre_raza)
			->setCellValue('L'.$increment, $nombre_estado_civil)
			->setCellValue('M'.$increment, $clasrieg_ergo1_trabestat)
			->setCellValue('N'.$increment, $clasrieg_ergo1_esfuerfis)
			->setCellValue('O'.$increment, $clasrieg_ergo1_carga)
			->setCellValue('P'.$increment, $clasrieg_ergo1_movrepet)
			->setCellValue('Q'.$increment, $clasrieg_ergo1_postforz)
			->setCellValue('R'.$increment, $cie10)
			->setCellValue('S'.$increment, $recomendacion_general_informe_condiciones_salud)
			->setCellValue('T'.$increment, $exa_fis_talla)
			->setCellValue('U'.$increment, $exa_fis_peso)
            ->setCellValue('V'.$increment, $exa_fis_imc)
            ->setCellValue('W'.$increment, $cargo_empresa);

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
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_celda_izquierda_borde);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_celda_izquierda_borde);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
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
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B2:L4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B2:L4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("B2:L4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('M2:Q4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('M2:Q4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("M2:Q4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('R2:R4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R2:R4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("R2:R4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('EAF1DD');

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
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

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

$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('M2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('M2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('R2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('R2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
$objPHPExcel->getActiveSheet()->setAutoFilter('B5:S5');
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