<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
require '../PHPMailer/PHPMailerAutoload.php';
include_once '../admin/smtp_conf_correo.php';
date_default_timezone_set('America/Bogota');
include_once('../evitar_mensaje_error/error.php');
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
$cod_curl                               = 1;
$fecha_hoy                              = time();
$fecha_hoy_time                         = time();
$fecha_ymd_his                          = date("Y-m-d H:i:s");
$anyo_actual                            = date("Y");

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
$tamano_font_aptlab_emp            = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_factura'];
$tamano_font_remision_emp          = $info_empresa_data['tamano_font_remision'];
$res_emp                           = $info_empresa_data['res'];
$res1_emp                          = $info_empresa_data['res1'];
$res2_emp                          = $info_empresa_data['res2'];
$fecha_res_emp                     = $info_empresa_data['fecha_res'];
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
$pag_desarrollador_emp             = $info_empresa_data['pag_desarrollador'];
$correo_desarrollador_emp          = $info_empresa_data['correo_desarrollador'];
$url_pag_emp                       = $info_empresa_data['url_pag'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$serguridad_pagina                        = 1; 
$pagina                                   = addslashes($_GET['pagina']);

if (isset($_GET['cod_cuentas_cobrar_factura_comision_propietario']) <> '') { $cod_cuentas_cobrar_factura_comision_propietario = intval($_GET['cod_cuentas_cobrar_factura_comision_propietario']); } else { $cod_cuentas_cobrar_factura_comision_propietario = ''; }
if (isset($_GET['cod_cuentas_cobrar_alerta']) <> '') { $cod_cuentas_cobrar_alerta = intval($_GET['cod_cuentas_cobrar_alerta']); } else { $cod_cuentas_cobrar_alerta = ''; }
if (isset($_GET['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = intval($_GET['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
if (isset($_GET['cod_cuentas_cobrar_abonos']) <> '') { $cod_cuentas_cobrar_abonos = intval($_GET['cod_cuentas_cobrar_abonos']); } else { $cod_cuentas_cobrar_abonos = ''; }
if (isset($_GET['cod_factura']) <> '') { $cod_factura = addslashes($_GET['cod_factura']); } else { $cod_factura = ''; }
if (isset($_GET['cod_tercero']) <> '') { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_GET['cliente']) <> '') { $cliente = addslashes($_GET['cliente']); } else { $cliente = ''; }
if (isset($_GET['cod_estado_pago']) <> '') { $cod_estado_pago = intval($_GET['cod_estado_pago']); } else { $cod_estado_pago = ''; }
if (isset($_GET['palabra']) <> '') { $palabra = intval($_GET['palabra']); } else { $palabra = ''; }

$pagina_redirect                   = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina.'&palabra='.$palabra;

$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_emision                     = date("Y-m-d");
$fecha_time                        = time();
$fecha_reg_time                    = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_factura_comision_propietario = "SELECT * FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario'";
$consulta_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_cuentas_cobrar_factura_comision_propietario);

$cod_cuentas_cobrar_alerta            = $datos_cuentas_cobrar_factura_comision_propietario['cod_cuentas_cobrar_alerta'];
$abonado                              = $datos_cuentas_cobrar_factura_comision_propietario['abonado'];
$monto_cuota_interes                  = $datos_cuentas_cobrar_factura_comision_propietario['monto_cuota_interes'];
$deduccion_retefuente                 = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_retefuente'];
$deduccion_reparacion                 = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_reparacion'];

$deduccion_otro_impuesto_dian         = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida      = $datos_cuentas_cobrar_factura_comision_propietario['ingreso_administracion_incluida'];
$numero_alerta                        = $datos_cuentas_cobrar_factura_comision_propietario['numero_alerta'];
$fecha_pago_deuda                     = $datos_cuentas_cobrar_factura_comision_propietario['fecha_pago_deuda'];
$fecha_pago_reg                       = $datos_cuentas_cobrar_factura_comision_propietario['fecha_pago_reg'];
$cod_producto                         = $datos_cuentas_cobrar_factura_comision_propietario['cod_producto'];
$cod_producto_barra                   = $datos_cuentas_cobrar_factura_comision_propietario['cod_producto_barra'];
$nombre_producto                      = $datos_cuentas_cobrar_factura_comision_propietario['nombre_producto'];
$cod_cuentas_cobrar_abonos            = $datos_cuentas_cobrar_factura_comision_propietario['cod_cuentas_cobrar_abonos'];
$cod_cuentas_cobrar                   = $datos_cuentas_cobrar_factura_comision_propietario['cod_cuentas_cobrar'];
$cod_factura                          = $datos_cuentas_cobrar_factura_comision_propietario['cod_factura'];
$cod_tercero                          = $datos_cuentas_cobrar_factura_comision_propietario['cod_tercero'];
$ingreso_gasto_juridica               = $datos_cuentas_cobrar_factura_comision_propietario['ingreso_gasto_juridica'];
$deduccion_saldo_favor                = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_saldo_favor'];
$total_deduccion                      = $datos_cuentas_cobrar_factura_comision_propietario['total_deduccion'];
$total_ingreso                        = $datos_cuentas_cobrar_factura_comision_propietario['total_ingreso'];
$total_recibido                       = $datos_cuentas_cobrar_factura_comision_propietario['total_recibido'];
$total_pendiente                      = $datos_cuentas_cobrar_factura_comision_propietario['total_pendiente'];
$total_pagar                          = $datos_cuentas_cobrar_factura_comision_propietario['total_pagar'];
$cod_tipo_forma_pago                  = $datos_cuentas_cobrar_factura_comision_propietario['cod_tipo_forma_pago'];
$ingreso_deudas_anteriores            = $datos_cuentas_cobrar_factura_comision_propietario['ingreso_deudas_anteriores'];
$fecha_pago                           = $datos_cuentas_cobrar_factura_comision_propietario['fecha_pago'];

$deduccion_servicio                   = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_servicio'];
$deduccion_otro_concepto              = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_cuentas_cobrar_factura_comision_propietario['ingreso_otro_concepto'];

$deduccion_servicio_energia           = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_servicio_energia'];
$deduccion_servicio_agua              = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_servicio_agua'];
$deduccion_servicio_gas               = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_servicio_gas'];
$deduccion_deudas_anteriores          = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_deudas_anteriores'];
$deduccion_comision                   = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_comision'];
$deduccion_imp_cuatroxmil             = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_imp_cuatroxmil'];
$ingreso_impuesto_iva                 = $datos_cuentas_cobrar_factura_comision_propietario['ingreso_impuesto_iva'];


$cod_administrador                    = $datos_cuentas_cobrar_factura_comision_propietario['cod_administrador'];
$fecha_pago                           = $fecha_pago_deuda;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_administrador = "SELECT cedula, nombres, apellidos, url_img_firma_prof_min, url_img_firma_prof_ori FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cedula_firma                      = $datos_administrador['cedula'];
$nombres_firma                     = $datos_administrador['nombres'];
$apellidos_firma                   = $datos_administrador['apellidos'];
$url_img_firma_prof_min_firma      = $datos_administrador['url_img_firma_prof_min'];
$url_img_firma_prof_ori_firma      = $datos_administrador['url_img_firma_prof_ori'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_consulta_tipo_forma_pago) or die(mysqli_error($conectar));
$total_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago     = $total_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, nombre_tipo_identificacion FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_tipo_identificacion     = $total_cliente['nombre_tipo_identificacion'];
$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$nombre2_tercero                = $total_cliente['nombre2_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$apellido2_tercero              = $total_cliente['apellido2_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                                = $sum_monto_deuda['total_venta'];
$total_abonado                              = $sum_abonos['total_abonado'];
$total_deuda                                = $total_venta - $total_abonado;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_factura_comision_propietario  = "SELECT monto_deuda FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario'";
$consulta_cuentas_cobrar_factura_comision_propietario  = mysqli_query($conectar, $sql_cuentas_cobrar_factura_comision_propietario ) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_factura_comision_propietario  = mysqli_fetch_assoc($consulta_cuentas_cobrar_factura_comision_propietario );

$monto_deuda_alerta                         = $datos_cuentas_cobrar_factura_comision_propietario ['monto_deuda'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT cod_producto_barra, nombre_producto, nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                         = $total_producto['cod_producto_barra'];
$nombre_producto                            = $total_producto['nombre_producto'];
$nombre_tipo_producto                       = $total_producto['nombre_tipo_producto'];
$direccion_producto                         = $total_producto['direccion_producto'];
$descripcion_producto                       = $total_producto['descripcion_producto'];
$cod_tercero_propietario                    = $total_producto['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_propietario = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_propietario = mysqli_query($conectar, $sql_consulta_propietario) or die(mysqli_error($conectar));
$total_propietario = mysqli_fetch_assoc($consulta_propietario);

$identificacion_tercero_propietario         = $total_propietario['identificacion_tercero'];
$nombre1_tercero_propietario                = $total_propietario['nombre1_tercero'];
$nombre2_tercero_propietario                = $total_propietario['nombre2_tercero'];
$apellido1_tercero_propietario              = $total_propietario['apellido1_tercero'];
$apellido2_tercero_propietario              = $total_propietario['apellido2_tercero'];
$nombre_cliente_propietario                 = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$cliente_propietario                        = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$nombre_tipo_identificacion_propietario     = $total_propietario['nombre_tipo_identificacion'];
$telefono1_tercero_propietario              = $total_propietario['telefono1_tercero'];
$correo_tercero_propietario                 = $total_propietario['correo_tercero'];
$nombre_pais_propietario                    = $total_propietario['nombre_pais'];
$correo_enviar                              = $total_propietario['correo_tercero'];
$direccion_tercero_propietario              = $total_propietario['direccion_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_pago_final                           = date('Y-m-d', strtotime($fecha_pago.'+ 1 month'));
$nombre_tabla_mes                           = date("m", strtotime($fecha_pago));
$nombre_tabla_mes_fecha_pago_deuda          = date("m", strtotime($fecha_pago_deuda));
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes                     = $matriz_consulta['nombre_letra_tabla_mes'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes_fecha_pago_deuda'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes_fecha_pago_deuda    = $matriz_consulta['nombre_letra_tabla_mes'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                         = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_cuentas_cobrar_factura_comision_propietario_strpad           = str_pad($cod_cuentas_cobrar_factura_comision_propietario, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina_local                             = $_SERVER['PHP_SELF'];
$nombre_emisor                            = "Notificaciones ".ucwords(strtolower($nombre_emp));
$correo_emisor                            = $Username;
$nombre_receptor                          = str_replace(" ", "_", $nombre1_tercero_propietario);
$correo_receptor                          = $correo_enviar;
$nombre_contacto1_limp                    = str_replace(" ", "_", $nombre1_tercero_propietario);
$motivo_consulta_limp                     = str_replace(" ", "_", $nombre1_tercero_propietario);
$nombre_empresa_limp                      = str_replace(" ", "_", $nombre1_tercero_propietario);
$nombres_limp                             = str_replace(" ", "_", $nombre1_tercero_propietario);
$cod_historia_clinica_strpad              = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$fecha_ymd_hora                           = date("Y/m/d H:i:s", $fecha_time);
$fecha_reg_time_dmy                       = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica                   = date("Y/m/d", $fecha_time);
$nombre_documento                         = "COMPROBANTE_PAGO_COMISION_PROPIETARIO_ ".$cod_factura_strpad.' '.$nombres_limp.' '.$nombre_empresa_limp;
$invitacion                               = "COMPROBANTE_PAGO_COMISION_PROPIETARIO_ ".$cod_factura_strpad.' '.$nombres_limp.' '.$nombre_empresa_limp;

$asunto_emisor_parte_superior             = $nombre_documento;
$asunto_correo_enviar                     = $nombre_documento;
$nombre_tipo_asunto                       = $nombre_documento;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_tipo_forma_pago == '1') { $url_img_firma_pago = '../imagenes/firma_usuario/firma_vacia.jpg'; } else { $url_img_firma_pago = '../imagenes/firma_usuario/firma_pagado.png'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                   = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                        = '5';
$margen_der                        = '5';
$margen_inf_encabezado             = '15';
$margen_sup_encabezado             = '2';
$posicion_sup_encabezado           = '5';
$posicion_inf_encabezado           = '2';

$titulo_doc_pdf                    = 'COMPROBANTE_PAGO_COMISION_PROPIETARIO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_factura_comision_propietario.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero_propietario;
$autor_doc_pdf                     = 'COMPROBANTE_PAGO_COMISION_PROPIETARIO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_factura_comision_propietario.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero_propietario;
$creador_doc_pdf                   = 'COMPROBANTE_PAGO_COMISION_PROPIETARIO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_factura_comision_propietario.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero_propietario;
$tema_doc_pdf                      = 'COMPROBANTE_PAGO_COMISION_PROPIETARIO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_factura_comision_propietario.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero_propietario;
$palabras_claves_doc_pdf           = 'COMPROBANTE_PAGO_COMISION_PROPIETARIO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_factura_comision_propietario.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero_propietario;

$cod_factura_strpad                = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad           = str_pad($cod_cuentas_cobrar_factura_comision_propietario, 6, "0", STR_PAD_LEFT);
$nombres_completos                 = "COMPROBANTE_PAGO_COMISION_PROPIETARIO";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '';
$headerE = '';
$footer = '';
$footerE = '';

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
</style>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="5px" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center;" rowspan="6"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" height="80px"/></th>
            <th style="text-align:center;" colspan="2">'.$nombre_emp.' <br> NIT: '.$nit_empresa_emp.'</th>
            <th style="text-align:center;" rowspan="6">FACTURA DE VENTA N°: <br> COM-'.$cod_cuentas_cobrar_factura_comision_propietario.'<br><barcode code="'.$cod_cuentas_cobrar_factura_comision_propietario_strpad.'" type="C128A" size="0.6" height="1" /></th>
          </tr>
          <tr>
            <th style="text-align:center;" colspan="2">REGIMEN: '.$regimen_emp.'</th>
          </tr>
          <tr>
            <th style="text-align:center;" colspan="2">COMPROBANTE DE COMISION PROPIETARIO</th>
          </tr>
          <tr>
            <th style="text-align:right;"></th>
            <th style="text-align:left;"></th>
          </tr>
        </table>
  </tr>
</table>';


   $codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;">MES FACTURADO: </th>
            <th style="text-align:left;">'.$nombre_letra_tabla_mes_fecha_pago_deuda.'</th>
          </tr>
          <tr>
            <th style="text-align:left;">PERIODO FACTURADO: </th>
            <th style="text-align:left;">'.date("d-m-Y", strtotime($fecha_pago)).' A '.date("d-m-Y", strtotime($fecha_pago_final)).'</th>
          </tr>
          <tr>
            <th style="text-align:left;">CONTRATO: </th>
            <th style="text-align:left;">'.$cod_factura.'</th>
          </tr>
        </table>
</table>';
       

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left; width:20%" valign="top">IDENTIFICACION: </th>
            <th style="text-align:left; width:80%" valign="top">'.number_format($identificacion_tercero_propietario, 0, ",", ".").'</th>
           </tr>
          <tr>
            <th style="text-align:left;" valign="top">CLIENTE: </th>
            <th style="text-align:left;" valign="top">'.$nombre1_tercero_propietario.'</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">DIRECCION: </th>
            <th style="text-align:left;" valign="top">'.$direccion_tercero_propietario.'</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">DESTINACION: </th>
            <th style="text-align:left;" valign="top">'.$nombre_tipo_producto.'</th>
          </tr>
        </table>
  </tr>
</table>';


$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center;">DETALLE FACTURACION DEL MES</th>
           </tr>
        </table>
</table>';


$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left; width:20%" valign="top">DOC </th>
            <th style="text-align:left; width:80%" valign="top">DESCRIPCION</th>
           </tr>
          <tr>
            <th style="text-align:left;" valign="top">AR-'.$cod_cuentas_cobrar_alerta.'</th>
            <th style="text-align:left;" valign="top">'.$cod_producto_barra.' - '.$nombre_producto.' - '.$nombre_tipo_producto.'</th>
          </tr>
        </table>
  </tr>
</table>';



$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="2px" cellspacing="0px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
            <tr>
                <th style="text-align:center;" colspan="2">DEDUCCIONES</th>
                <th style="text-align:center;" colspan="2">INGRESOS</th>
            </tr>
            <tr>
                <th style="text-align:left; width:25%">COMISION ADMINISTRACION: </th>
                <th style="text-align:left; width:25%">$ '.number_format($deduccion_comision, 0, ",", ".").'</th>
                <th style="text-align:left;">CANON DE ARRIENDO:</th>
                <th style="text-align:left;">$ '.number_format($monto_deuda_alerta, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left; width:25%">CUATRO POR MIL:</th>
                <th style="text-align:left; width:25%">$ '.number_format($deduccion_imp_cuatroxmil, 0, ",", ".").'</th>
                <th style="text-align:left; width:25%">IVA FAVORABLE:</th>
                <th style="text-align:left; width:25%">$ '.number_format($ingreso_impuesto_iva, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left; width:25%">RETEFUENTE PARA TERCEROS: </th>
                <th style="text-align:left; width:25%">$ '.number_format($deduccion_retefuente, 0, ",", ".").'</th>
                <th style="text-align:left;">OTROS CONCEPTOS:</th>
                <th style="text-align:left;">$ '.number_format($ingreso_otro_concepto, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO ENERGIA: </th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_energia, 0, ",", ".").'</th>
                <th style="text-align:left; width:25%"></th>
                <th style="text-align:left; width:25%"></span></th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO AGUA:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_agua, 0, ",", ".").'</th>
                <th style="text-align:left;"></th>
                <th style="text-align:left;"></th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO GAS:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_gas, 0, ",", ".").'</th>
                <th style="text-align:left;"></th>
                <th style="text-align:left;"></th>
            </tr>
            <tr>
                <th style="text-align:left;">REPARACIONES:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_reparacion, 0, ",", ".").'</th>
                <th style="text-align:left;"></th>
                <th style="text-align:left;"></th>
            </tr>
            <tr>
                <th style="text-align:left;">OTROS CONCEPTOS:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_otro_concepto, 0, ",", ".").'</th>
                <th style="text-align:left;"></th>
                <th style="text-align:left;"></th>
            </tr>
            <tr>
                <th style="text-align:left; font-size:15px">TOTAL DEDUCCIONES: </th>
                <th style="text-align:left; font-size:15px">$ '.number_format($total_deduccion, 0, ",", ".").'</th>
                <th style="text-align:left; font-size:15px">TOTAL INGRESOS: </th>
                <th style="text-align:left; font-size:15px">$ '.number_format($total_ingreso, 0, ",", ".").'</th>
            </tr>
        </table>
  </tr>
</table>';




$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center;" colspan="2"><hr>EL PAGO DE SU FACTURA ES MES VENCIDO</th><hr>
          </tr>
        </table>
';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center; width:50%; font-size:17px" valign="top">TOTAL A PAGAR </th>
            <th style="text-align:left; width:50%; font-size:18px" valign="top">$'.number_format($total_pagar, 0, ",", ".").'</th>
           </tr>
          <tr>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_pago.'" height="50px"/></th>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_prof_ori_firma.'" height="50px"/></th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">_______________________________<br>DOCUMENTO PAGADO POR '.$nombre_tipo_forma_pago.'<br>Firma quien recibe<br>Firma Y Cedula</th>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma de quien cancela</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">'.$direccion_emp.'</th>
            <th style="text-align:left;" valign="top">ESTA FACTURA HA SIDO PAGADA EL DIA: '.date("d-m-Y", strtotime($fecha_pago_reg)).'</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">TEL: '.$telefono_emp.'</th>
            <th style="text-align:left;" valign="top"></th>
          </tr>

          <tr>
            <th style="text-align:left; font-size:8px" valign="top">Facebook: inmobiliariaintegrales (grupo cerrado)</th>
            <th style="text-align:left; font-size:8px" valign="top"></th>
          </tr>

          <tr>
            <th style="text-align:left; font-size:8px" valign="top">Correo: '.$correo_emp.'</th>
            <th style="text-align:left; font-size:8px" valign="top"></th>
          </tr>
        </table>
  </tr>
</table>';



$codigoHTML.='
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

$nombre_archivo = 'COMPROBANTE_PAGO_COMISION_PROPIETARIO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar_factura_comision_propietario.'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_alerta.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero_propietario.'.pdf';
$ruta_global_archivo = $ruta.$ruta.$nombre_archivo;
$mpdf->Output($ruta_global_archivo, 'F');
//exit;
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
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
$mensaje = "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name='x-apple-disable-message-reformatting'>
  <title></title>
</head>
";
$mensaje .= "<body class='clean-body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000'>";
$mensaje .= "
<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='1'>
<thead>
  <tr>
    <th style='text-align:center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_emp."</span></th>
  </tr>
</thead>
<tbody>
</tbody>
</table>

<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='1'>
<thead>
  <tr>
    <th style='text-align:center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_tipo_asunto."</span></th>
  </tr>
</thead>
<tbody>
</tbody>
</table>
";
$mensaje .= "</body>";
$mensaje .= "</html>";

	$cod_tipo_modulo_envio_correo         = "16";
	$nombre_tipo_modulo_envio_correo      = "COMPROBANTE COMISION PROPIETARIO - INMOBILIARIA";
	$id_origen_correo                     = $cod_cuentas_cobrar_factura_comision_propietario;
	$nombre_tabla_origen_correo           = "tbl15_cuentas_cobrar_factura_comision_propietario";
	$nombre_campo_origen_correo           = "cod_cuentas_cobrar_factura_comision_propietario";
	$nombre_origen_correo                 = "Recordatorio comprobante comision pagado propietario";
	$correo_emisor                        = $correo_emisor;
	$correo_receptor                      = $correo_receptor;
	$asunto_correo                        = $asunto_correo_enviar;
	$mensaje_correo                       = $mensaje;
	$fecha_envio_correo                   = date("Y-m-d");
	$hora_envio_correo                    = date("H:i:s");
	$fecha_ymd_his                        = date("Y-m-d H:i:s");
	$fecha_time                           = time();
	$url_origen_correo                    = $_SERVER['PHP_SELF'];

	$mail = new PHPMailer;
	$mail->SMTPDebug = 3;                          // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $Host;  // Specify main and backup SMTP servers
	$mail->SMTPAuth = $SMTPAuth;                               // Enable SMTP authentication
	$mail->Username = $Username;                   // SMTP username
	$mail->Password = $Password;                             // SMTP password
	$mail->SMTPSecure = $SMTPSecure;                              // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $Port;                                      // TCP port to connect to
	$mail->setFrom($correo_emisor, $asunto_emisor_parte_superior);
	$mail->addAddress($correo_receptor, $nombre_receptor);
	$mail->Subject = $asunto_correo_enviar;
	$mail->MsgHTML($mensaje);
	$mail->AddAttachment($ruta_global_archivo, $nombre_archivo);

	if(!$mail->send()) { //INICIO SI EL CORREO NO SE ENVIA PORQUE HAY ERRORES
	    $cod_estado_envio_correo            = 0;
	    $nombre_estado_envio_correo         = "No Enviado";
	    $descripcion_error_envio_correo     = $mail->ErrorInfo;
	}
	else { // INICIO SI EN CORREO SE ENVIO CORRECTAMENTE
	    $cod_estado_envio_correo            = 1;
	    $nombre_estado_envio_correo         = "Enviado Correctamente";
	    $descripcion_error_envio_correo     = "";

		$sql_data = "UPDATE tbl15_cuentas_cobrar_factura_comision_propietario SET cod_estado_envio_correo_comision_propietario = '1' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_envio_correo_comision_propietario = '1' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
  <?php
  } //FIN SI EN CORREO SE ENVIO CORRECTAMENTE
  $sql_envio_correo = "INSERT INTO tbl15_envio_correo (cod_tipo_modulo_envio_correo, nombre_tipo_modulo_envio_correo, id_origen_correo, nombre_tabla_origen_correo, nombre_campo_origen_correo, 
  nombre_origen_correo, correo_emisor, correo_receptor, cod_estado_envio_correo, nombre_estado_envio_correo, descripcion_error_envio_correo, fecha_envio_correo, hora_envio_correo, 
  url_origen_correo, fecha_ymd_his, fecha_time, asunto_correo) 
  VALUES ('$cod_tipo_modulo_envio_correo', '$nombre_tipo_modulo_envio_correo', '$id_origen_correo', '$nombre_tabla_origen_correo', '$nombre_campo_origen_correo', 
  '$nombre_origen_correo', '$correo_emisor', '$correo_receptor', '$cod_estado_envio_correo', '$nombre_estado_envio_correo', '$descripcion_error_envio_correo', '$fecha_envio_correo', '$hora_envio_correo', 
  '$url_origen_correo', '$fecha_ymd_his', '$fecha_time', '$asunto_correo')";
  $resultado_envio_correo = mysqli_query($conectar, $sql_envio_correo) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
