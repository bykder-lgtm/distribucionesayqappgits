<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
require '../PHPMailer/PHPMailerAutoload.php';
include_once '../admin/smtp_conf_correo.php';
date_default_timezone_set('America/Bogota');
include_once('../evitar_mensaje_error/error.php');

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//$cuenta_actual = addslashes($_SESSION['usuario']);
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
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

$leyenda1_defec_global             = $info_empresa_data['leyenda1_defec_global'];
$leyenda2_defec_global             = $info_empresa_data['leyenda2_defec_global'];
$leyenda3_defec_global             = $info_empresa_data['leyenda3_defec_global'];
$leyenda4_defec_global             = $info_empresa_data['leyenda4_defec_global'];
$leyenda5_defec_global             = $info_empresa_data['leyenda5_defec_global'];
$leyenda_envio_correo_defec_global = $info_empresa_data['leyenda_envio_correo_defec_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$serguridad_pagina                        = 1; 
$pagina                                   = addslashes($_GET['pagina']);

if (isset($_GET['cod_cuentas_cobrar_alerta']) <> '') { $cod_cuentas_cobrar_alerta = intval($_GET['cod_cuentas_cobrar_alerta']); } else { $cod_cuentas_cobrar_alerta = ''; }
if (isset($_GET['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = intval($_GET['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
if (isset($_GET['cod_cuentas_cobrar_abonos']) <> '') { $cod_cuentas_cobrar_abonos = intval($_GET['cod_cuentas_cobrar_abonos']); } else { $cod_cuentas_cobrar_abonos = ''; }
if (isset($_GET['cod_factura']) <> '') { $cod_factura = addslashes($_GET['cod_factura']); } else { $cod_factura = ''; }
if (isset($_GET['cod_tercero']) <> '') { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_GET['cliente']) <> '') { $cliente = addslashes($_GET['cliente']); } else { $cliente = ''; }
if (isset($_GET['cod_estado_pago']) <> '') { $cod_estado_pago = intval($_GET['cod_estado_pago']); } else { $cod_estado_pago = ''; }

$pagina_redirect                   = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina;

$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_emision                     = date("Y-m-d");
$fecha_time                        = time();
$fecha_reg_time                    = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos'";
$consulta_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos);

$abonado                              = $datos_cuentas_cobrar_abonos['abonado'];
$monto_cuota_interes                  = $datos_cuentas_cobrar_abonos['monto_cuota_interes'];
$deduccion_retefuente                 = $datos_cuentas_cobrar_abonos['deduccion_retefuente'];
$deduccion_reparacion                 = $datos_cuentas_cobrar_abonos['deduccion_reparacion'];

$deduccion_otro_impuesto_dian         = $datos_cuentas_cobrar_abonos['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida      = $datos_cuentas_cobrar_abonos['ingreso_administracion_incluida'];
$numero_alerta                        = $datos_cuentas_cobrar_abonos['numero_alerta'];
$fecha_pago_deuda                     = $datos_cuentas_cobrar_abonos['fecha_pago_deuda'];
$fecha_pago_reg                       = $datos_cuentas_cobrar_abonos['fecha_pago_reg'];
$cod_producto                         = $datos_cuentas_cobrar_abonos['cod_producto'];
$cod_producto_barra                   = $datos_cuentas_cobrar_abonos['cod_producto_barra'];
$nombre_producto                      = $datos_cuentas_cobrar_abonos['nombre_producto'];
$cod_cuentas_cobrar_alerta            = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar                   = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar'];
$ingreso_gasto_juridica               = $datos_cuentas_cobrar_abonos['ingreso_gasto_juridica'];
$deduccion_saldo_favor                = $datos_cuentas_cobrar_abonos['deduccion_saldo_favor'];
$total_deduccion                      = $datos_cuentas_cobrar_abonos['total_deduccion'];
$total_ingreso                        = $datos_cuentas_cobrar_abonos['total_ingreso'];
$total_recibido                       = $datos_cuentas_cobrar_abonos['total_recibido'];
$total_pendiente                      = $datos_cuentas_cobrar_abonos['total_pendiente'];
$total_pagar                          = $datos_cuentas_cobrar_abonos['total_pagar'];
$cod_tipo_forma_pago                  = $datos_cuentas_cobrar_abonos['cod_tipo_forma_pago'];
$ingreso_deudas_anteriores            = $datos_cuentas_cobrar_abonos['ingreso_deudas_anteriores'];
$fecha_pago_periodo_orig              = $datos_cuentas_cobrar_abonos['fecha_pago_periodo_orig'];

$deduccion_servicio                   = $datos_cuentas_cobrar_abonos['deduccion_servicio'];
$deduccion_otro_concepto              = $datos_cuentas_cobrar_abonos['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_cuentas_cobrar_abonos['ingreso_otro_concepto'];

$deduccion_servicio_energia           = $datos_cuentas_cobrar_abonos['deduccion_servicio_energia'];
$deduccion_servicio_agua              = $datos_cuentas_cobrar_abonos['deduccion_servicio_agua'];
$deduccion_servicio_gas               = $datos_cuentas_cobrar_abonos['deduccion_servicio_gas'];
$deduccion_deudas_anteriores          = $datos_cuentas_cobrar_abonos['deduccion_deudas_anteriores'];
$cod_administrador                    = $datos_cuentas_cobrar_abonos['cod_administrador'];
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
if ($url_img_firma_prof_ori_firma == '') { $url_img_firma_prof_ori_firma = '../imagenes/firma_usuario/firma_yamid.jpg'; } else { $url_img_firma_prof_ori_firma = $datos_administrador['url_img_firma_prof_ori']; } 
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_consulta_tipo_forma_pago) or die(mysqli_error($conectar));
$total_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago     = $total_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, nombre_tipo_identificacion, correo_tercero 
FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_tipo_identificacion            = $total_cliente['nombre_tipo_identificacion'];
$identificacion_tercero                = $total_cliente['identificacion_tercero'];
$nombre1_tercero                       = $total_cliente['nombre1_tercero'];
$nombre2_tercero                       = $total_cliente['nombre2_tercero'];
$apellido1_tercero                     = $total_cliente['apellido1_tercero'];
$apellido2_tercero                     = $total_cliente['apellido2_tercero'];
$nombre_cliente                        = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
$correo_enviar                         = $total_cliente['correo_tercero'];
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                          = $sum_monto_deuda['total_venta'];
$total_abonado                        = $sum_abonos['total_abonado'];
$total_deuda                          = $total_venta - $total_abonado;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_alerta  = "SELECT monto_deuda, fecha_pago_periodo_orig, fecha_mes FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$consulta_cuentas_cobrar_alerta  = mysqli_query($conectar, $sql_cuentas_cobrar_alerta ) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_alerta  = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta );

$monto_deuda_alerta                   = $datos_cuentas_cobrar_alerta['monto_deuda'];
$fecha_pago_periodo_orig              = $datos_cuentas_cobrar_alerta['fecha_pago_periodo_orig'];
$fecha_mes                            = $datos_cuentas_cobrar_alerta['fecha_mes'];
$fecha_mes_complet                    = $fecha_mes.'-01';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT nombre_tipo_producto, direccion_producto, descripcion_producto FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$nombre_tipo_producto                 = $total_producto['nombre_tipo_producto'];
$direccion_producto                   = $total_producto['direccion_producto'];
$descripcion_producto                 = $total_producto['descripcion_producto'];
//-------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_pago_final                     = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+ 1 month'));
$nombre_tabla_mes                     = date("m", strtotime($fecha_pago_periodo_orig));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes               = $matriz_consulta['nombre_letra_tabla_mes'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina_local                             = $_SERVER['PHP_SELF'];
$nombre_emisor                            = "Notificaciones ".ucwords(strtolower($nombre_emp));
$correo_emisor                            = $Username;
$nombre_receptor                          = str_replace(" ", "_", $nombre1_tercero);
$correo_receptor                          = $correo_enviar;
$nombre_contacto1_limp                    = str_replace(" ", "_", $nombre1_tercero);
$motivo_consulta_limp                     = str_replace(" ", "_", $nombre1_tercero);
$nombre_empresa_limp                      = str_replace(" ", "_", $nombre1_tercero);
$nombres_limp                             = str_replace(" ", "_", $nombre1_tercero);
$cod_historia_clinica_strpad              = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$cod_factura_strpad                       = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_ymd_hora                           = date("Y/m/d H:i:s", $fecha_time);
$fecha_reg_time_dmy                       = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica                   = date("Y/m/d", $fecha_time);
$nombre_documento                         = "COMPROBANTE_DE_INGRESO_ ".$cod_factura_strpad.' '.$nombres_limp;
$invitacion                               = "COMPROBANTE_DE_INGRESO_ ".$cod_factura_strpad.' '.$nombres_limp;

$asunto_emisor_parte_superior             = "COMPROBANTE DE INGRESO ".$cod_factura_strpad.' '.$nombre1_tercero;
$asunto_correo_enviar                     = "COMPROBANTE DE INGRESO ".$cod_factura_strpad.' '.$nombre1_tercero;
$nombre_tipo_asunto                       = "COMPROBANTE DE INGRESO ".$cod_factura_strpad.' '.$nombre1_tercero;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_tipo_forma_pago == '1') { $url_img_firma_pago = '../imagenes/firma_usuario/firma_vacia.jpg'; } else { $url_img_firma_pago = '../imagenes/firma_usuario/firma_pagado.png'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                        = '5';
$margen_der                        = '5';
$margen_inf_encabezado             = '15';
$margen_sup_encabezado             = '2';
$posicion_sup_encabezado           = '5';
$posicion_inf_encabezado           = '2';

$titulo_doc_pdf                    = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero.'_'.$fecha_impr.'_'.$hora_impr;
$autor_doc_pdf                     = $nombre_emp.' - '.$cuenta_actual.' - '.$nombres_des.' '.$apellidos_des;
$creador_doc_pdf                   = $nombre_emp.' - '.$cuenta_actual.' - '.$fecha_impr.' - '.$hora_impr;
$tema_doc_pdf                      = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$palabras_claves_doc_pdf           = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero.'_'.$fecha_impr.'_'.$hora_impr;

$cod_factura_strpad                = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad           = str_pad($cod_cuentas_cobrar_abonos, 6, "0", STR_PAD_LEFT);
$nombres_completos                 = "COMPROBANTE_INGRESO";
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
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center; font-size:15px; width:33%"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" height="50px"/></th>
            <th style="text-align:center; font-size:15px; width:33%"><font size="+1">COMPROBANTE DE INGRESO</font> <br> '.$nombre_emp.' <br> NIT: '.$nit_empresa_emp.'</th>
            <th style="text-align:center; font-size:16px; width:33%">CI-'.$cod_cuentas_cobrar_abonos.'</th>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">FECHA COMPROBANTE</th>
            <th style="text-align:left;" valign="top">'.date("d-m-Y", strtotime($fecha_pago_reg)).'</th>
            <th style="text-align:left;" valign="top">MES</th>
            <th style="text-align:center;" valign="top">'.$nombre_letra_tabla_mes.'</th>
           </tr>
          <tr>
            <th style="text-align:left">ARRENDATARIO</th>
            <th style="text-align:left">'.$nombre1_tercero.'</th>
            <th style="text-align:left">PERIODO FACTURADO</th>
            <th style="text-align:center">'.date("d-m-Y", strtotime($fecha_pago_periodo_orig)).' A '.date("d-m-Y", strtotime($fecha_pago_final)).'</th>
          </tr>
          <tr>
            <th style="text-align:left">CONTRATO</th>
            <th style="text-align:left">'.$cod_factura.'</th>
            <th style="text-align:left">'.$nombre_tipo_identificacion.'</th>
            <th style="text-align:center">'.number_format($identificacion_tercero, 0, ",", ".").'</th>
          </tr>
          <tr>
            <th style="text-align:left">DIRECCION</th>
            <th style="text-align:left">'.$direccion_producto.'</th>
            <th style="text-align:left"></th>
            <th style="text-align:center"></th>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="2px" cellspacing="0px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
            <tr>
                <th style="text-align:center;" colspan="2">DEDUCCIONES</th>
                <th style="text-align:center;" colspan="2">INGRESOS</th>
            </tr>
            <tr>
                <th style="text-align:left; width:25%">RETEFUENTE: </th>
                <th style="text-align:left; width:25%">$ '.number_format($deduccion_retefuente, 0, ",", ".").'</th>
                <th style="text-align:left;">CANON DE ARRIENDO:</th>
                <th style="text-align:left;">$ '.number_format($monto_deuda_alerta, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">REPARACIONES O SERVICIOS: </th>
                <th style="text-align:left;">$ '.number_format($deduccion_reparacion, 0, ",", ".").'</th>
                <th style="text-align:left; width:25%">INTERESES: </th>
                <th style="text-align:left; width:25%">$ '.number_format($monto_cuota_interes, 0, ",", ".").'</span></th>
            </tr>
            <tr>
                <th style="text-align:left;">OTROS IMPUESTOS (DIAN): </th>
                <th style="text-align:left;">$ '.number_format($deduccion_otro_impuesto_dian, 0, ",", ".").'</th>
                <th style="text-align:left;">GASTOS JURIDICA: </th>
                <th style="text-align:left;">$ '.number_format($ingreso_gasto_juridica, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO ENERGIA: </th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_energia, 0, ",", ".").'</th>
                <th style="text-align:left;">ADMINISTRACION INCLUIDA: </th>
                <th style="text-align:left;">$ '.number_format($ingreso_administracion_incluida, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO AGUA:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_agua, 0, ",", ".").'</th>
                <th style="text-align:left;">DEUDAS ANTERIORES:</th>
                <th style="text-align:left;">$ '.number_format($ingreso_deudas_anteriores, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO GAS:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_gas, 0, ",", ".").'</th>
                <th style="text-align:left;">OTROS CONCEPTOS:</th>
                <th style="text-align:left;">$ '.number_format($ingreso_otro_concepto, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">DEUDAS ANTERIORES MES:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_deudas_anteriores, 0, ",", ".").'</th>
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
        <table align="center" border="1" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center; font-size:15px">FORMA DE PAGO: <br>'.$nombre_tipo_forma_pago.'</th>
            <th style="text-align:center; font-size:15px">TOTAL A PAGAR: <br>$ '.number_format($total_pagar, 0, ",", ".").'</th>
            <th style="text-align:center; font-size:15px">TOTAL RECIBIDO: <br>$ '.number_format($total_recibido, 0, ",", ".").'</th>
            <th style="text-align:center; font-size:15px">TOTAL PENDIENTE: <br>$ '.number_format($total_pendiente, 0, ",", ".").'</th>
           </tr>
        </table>
</table>';


$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left; width:50%" valign="top">EN LETRA: '.convertir_numeros_a_letras($abonado).'</th>
            <th style="text-align:left; width:50%" valign="top"></th>
           </tr>
          <tr>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_pago.'" height="50px"/></th>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_prof_ori_firma.'" height="50px"/></th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">_______________________________<br>DOCUMENTO PAGADO POR '.$nombre_tipo_forma_pago.'<br>Firma de quien cancela<br>Firma Y Cedula</th>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma quien recibe</th>
          </tr>
<!--
          <tr>
            <th style="text-align:left;" valign="top">'.$direccion_emp.'</th>
            <th style="text-align:left;" valign="top"></th>
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
-->
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
    <thead>
      <tr>
        <th style="text-align:center;">----------------------------------------------------------------------------------------------------------------------</th>
      </tr>
    </thead>
</table>
';

if ($cod_tipo_forma_pago == '1') {

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center; font-size:15px; width:33%"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" height="50px"/></th>
            <th style="text-align:center; font-size:15px; width:33%"><font size="+1">COMPROBANTE DE INGRESO</font> <br> '.$nombre_emp.' <br> NIT: '.$nit_empresa_emp.'</th>
            <th style="text-align:center; font-size:16px; width:33%">CI-'.$cod_cuentas_cobrar_abonos.'</th>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">FECHA COMPROBANTE</th>
            <th style="text-align:left;" valign="top">'.date("d-m-Y", strtotime($fecha_pago_reg)).'</th>
            <th style="text-align:left;" valign="top">MES</th>
            <th style="text-align:center;" valign="top">'.$nombre_letra_tabla_mes.'</th>
           </tr>
          <tr>
            <th style="text-align:left">ARRENDATARIO</th>
            <th style="text-align:left">'.$nombre1_tercero.'</th>
            <th style="text-align:left">PERIODO FACTURADO</th>
            <th style="text-align:center">'.date("d-m-Y", strtotime($fecha_pago_periodo_orig)).' A '.date("d-m-Y", strtotime($fecha_pago_final)).'</th>
          </tr>
          <tr>
            <th style="text-align:left">CONTRATO</th>
            <th style="text-align:left">'.$cod_factura.'</th>
            <th style="text-align:left">'.$nombre_tipo_identificacion.'</th>
            <th style="text-align:center">'.number_format($identificacion_tercero, 0, ",", ".").'</th>
          </tr>
          <tr>
            <th style="text-align:left">DIRECCION</th>
            <th style="text-align:left">'.$direccion_producto.'</th>
            <th style="text-align:left"></th>
            <th style="text-align:center"></th>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="2px" cellspacing="0px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
            <tr>
                <th style="text-align:center;" colspan="2">DEDUCCIONES</th>
                <th style="text-align:center;" colspan="2">INGRESOS</th>
            </tr>
            <tr>
                <th style="text-align:left; width:25%">RETEFUENTE: </th>
                <th style="text-align:left; width:25%">$ '.number_format($deduccion_retefuente, 0, ",", ".").'</th>
                <th style="text-align:left;">CANON DE ARRIENDO:</th>
                <th style="text-align:left;">$ '.number_format($monto_deuda_alerta, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">REPARACIONES O SERVICIOS: </th>
                <th style="text-align:left;">$ '.number_format($deduccion_reparacion, 0, ",", ".").'</th>
                <th style="text-align:left; width:25%">INTERESES: </th>
                <th style="text-align:left; width:25%">$ '.number_format($monto_cuota_interes, 0, ",", ".").'</span></th>
            </tr>
            <tr>
                <th style="text-align:left;">OTROS IMPUESTOS (DIAN): </th>
                <th style="text-align:left;">$ '.number_format($deduccion_otro_impuesto_dian, 0, ",", ".").'</th>
                <th style="text-align:left;">GASTOS JURIDICA: </th>
                <th style="text-align:left;">$ '.number_format($ingreso_gasto_juridica, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO ENERGIA: </th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_energia, 0, ",", ".").'</th>
                <th style="text-align:left;">ADMINISTRACION INCLUIDA: </th>
                <th style="text-align:left;">$ '.number_format($ingreso_administracion_incluida, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO AGUA:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_agua, 0, ",", ".").'</th>
                <th style="text-align:left;">DEUDAS ANTERIORES:</th>
                <th style="text-align:left;">$ '.number_format($ingreso_deudas_anteriores, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">SERVICIO GAS:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_servicio_gas, 0, ",", ".").'</th>
                <th style="text-align:left;">OTROS CONCEPTOS:</th>
                <th style="text-align:left;">$ '.number_format($ingreso_otro_concepto, 0, ",", ".").'</th>
            </tr>
            <tr>
                <th style="text-align:left;">DEUDAS ANTERIORES MES:</th>
                <th style="text-align:left;">$ '.number_format($deduccion_deudas_anteriores, 0, ",", ".").'</th>
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
        <table align="center" border="1" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center; font-size:15px">FORMA DE PAGO: <br>'.$nombre_tipo_forma_pago.'</th>
            <th style="text-align:center; font-size:15px">TOTAL A PAGAR: <br>$ '.number_format($total_pagar, 0, ",", ".").'</th>
            <th style="text-align:center; font-size:15px">TOTAL RECIBIDO: <br>$ '.number_format($total_recibido, 0, ",", ".").'</th>
            <th style="text-align:center; font-size:15px">TOTAL PENDIENTE: <br>$ '.number_format($total_pendiente, 0, ",", ".").'</th>
           </tr>
        </table>
</table>';


$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left; width:50%" valign="top">EN LETRA: '.convertir_numeros_a_letras($abonado).'</th>
            <th style="text-align:left; width:50%" valign="top"></th>
           </tr>
          <tr>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_pago.'" height="50px"/></th>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_prof_ori_firma.'" height="50px"/></th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma de quien cancela<br>Firma Y Cedula</th>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma quien recibe</th>
          </tr>
<!--
          <tr>
            <th style="text-align:left;" valign="top">'.$direccion_emp.'</th>
            <th style="text-align:left;" valign="top"></th>
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
-->
        </table>
  </tr>
</table>';
}

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

$nombre_archivo = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_alerta.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero.'.pdf';
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
    <th style='text-align:center;'><span style='font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_emp."</span></th>
  </tr>
</thead>
<tbody>
</tbody>
</table>

<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='1'>
<thead>
  <tr>
    <th style='text-align:center;'><span style='font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_tipo_asunto."</span></th>
  </tr>
</thead>
<tbody>
</tbody>
</table>

<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='1'>
<thead>
  <tr>
    <th style='text-align:center;'><span style='font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$leyenda_envio_correo_defec_global.' '.$correo_emp."</span></th>
  </tr>
</thead>
<tbody>
</tbody>
</table>
";
$mensaje .= "</body>";
$mensaje .= "</html>";

	$cod_tipo_modulo_envio_correo         = "15";
	$nombre_tipo_modulo_envio_correo      = "COMPROBANTE INGRESO PAGADO - INMOBILIARIA";
	$id_origen_correo                     = $cod_cuentas_cobrar_abonos;
	$nombre_tabla_origen_correo           = "tbl15_cuentas_cobrar_abonos";
	$nombre_campo_origen_correo           = "cod_cuentas_cobrar_abonos";
	$nombre_origen_correo                 = "Recordatorio comprobante ingreso pagado inquilino";
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

		$sql_data = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_envio_correo_comprobante_ingreso = '1' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_envio_correo_comprobante_ingreso = '1' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
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
