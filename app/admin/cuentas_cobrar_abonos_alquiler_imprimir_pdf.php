<?php ob_start();?>
<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
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
$serguridad_pagina                 = 1; 
$cod_cuentas_cobrar_abonos         = intval($_GET['cod_cuentas_cobrar_abonos']);
$cod_factura                       = intval($_GET['cod_factura']);
$cod_tercero                       = intval($_GET['cod_tercero']);
$cliente                           = addslashes($_GET['cliente']);

$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos'";
$consulta_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos);

$abonado                              = $datos_cuentas_cobrar_abonos['abonado'];
$monto_cuota_interes                  = $datos_cuentas_cobrar_abonos['monto_cuota_interes'];
$descuento_retefuente                 = $datos_cuentas_cobrar_abonos['descuento_retefuente'];
$descuento_reparacion_servicio        = $datos_cuentas_cobrar_abonos['descuento_reparacion_servicio'];
$descuento_otro_impuesto_dian         = $datos_cuentas_cobrar_abonos['descuento_otro_impuesto_dian'];
$descuento_administracion_incluida    = $datos_cuentas_cobrar_abonos['descuento_administracion_incluida'];
$numero_alerta                        = $datos_cuentas_cobrar_abonos['numero_alerta'];
$fecha_pago_deuda                     = $datos_cuentas_cobrar_abonos['fecha_pago_deuda'];
$fecha_pago_reg                       = $datos_cuentas_cobrar_abonos['fecha_pago_reg'];
$cod_producto                         = $datos_cuentas_cobrar_abonos['cod_producto'];
$cod_producto_barra                   = $datos_cuentas_cobrar_abonos['cod_producto_barra'];
$nombre_producto                      = $datos_cuentas_cobrar_abonos['nombre_producto'];
$cod_cuentas_cobrar_alerta            = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar                   = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar'];
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
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar' AND (cod_estado_archivado = '0')";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar' AND (cod_estado_archivado = '0')";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                   = $sum_monto_deuda['total_venta'];
$total_abonado                 = $sum_abonos['total_abonado'];
$total_deuda                   = $total_venta - $total_abonado;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_alerta  = "SELECT monto_deuda FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$consulta_cuentas_cobrar_alerta  = mysqli_query($conectar, $sql_cuentas_cobrar_alerta ) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_alerta  = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta );

$monto_deuda_alerta                   = $datos_cuentas_cobrar_alerta ['monto_deuda'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT nombre_tipo_producto, direccion_producto, descripcion_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$nombre_tipo_producto                 = $total_producto['nombre_tipo_producto'];
$direccion_producto                   = $total_producto['direccion_producto'];
$descripcion_producto                 = $total_producto['descripcion_producto'];
//-------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_pago_final                     = date('Y-m-d', strtotime($fecha_pago_deuda.'+ 1 month'));
$nombre_tabla_mes                     = date("m", strtotime($fecha_pago_deuda));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes               = $matriz_consulta['nombre_letra_tabla_mes'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                   = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                        = '5';
$margen_der                        = '5';
$margen_inf_encabezado             = '5';
$margen_sup_encabezado             = '2';
$posicion_sup_encabezado           = '5';
$posicion_inf_encabezado           = '2';

$titulo_doc_pdf                    = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$autor_doc_pdf                     = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$creador_doc_pdf                   = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$tema_doc_pdf                      = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$palabras_claves_doc_pdf           = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$aaaaaa   = "COMPROBANTE_INGRESO";
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
    <td width="576" height="40" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:center; width:33%"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" height="50px"/></td>
            <th style="text-align:center; width:33%"><font size="+1">COMPROBANTE DE INGRESO</font> <br> '.$nombre_emp.' <br> NIT: '.$nit_empresa_emp.'</th>
            <td style="text-align:center; width:33%">CI-'.$cod_factura.'</td>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="90" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">FECHA COMPROBANTE</th>
            <td style="text-align:left;" valign="top">'.$fecha_pago_reg.'</td>
            <th style="text-align:left;" valign="top">MES</th>
            <td style="text-align:center;" valign="top">'.$nombre_letra_tabla_mes.'</td>
           </tr>
          <tr>
            <th style="text-align:left">ARRENDATARIO</th>
            <td style="text-align:left">'.$nombre1_tercero.'</td>
            <th style="text-align:left">PERIODO FACTURADO</th>
            <td style="text-align:center">'.$fecha_pago_deuda.' A '.$fecha_pago_final.'</td>
          </tr>
          <tr>
            <th style="text-align:left">CONTRATO</th>
            <td style="text-align:left">'.$cod_factura.'</td>
            <th style="text-align:left">'.$nombre_tipo_identificacion.'</th>
            <td style="text-align:center">'.$identificacion_tercero.'</td>
          </tr>
          <tr>
            <th style="text-align:left">DIRRECION</th>
            <td style="text-align:left">'.$direccion_producto.'</td>
            <th style="text-align:left">CANON</th>
            <td style="text-align:center">'.number_format($monto_deuda_alerta, 0, ",", ".").'</td>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="80" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="2px" cellspacing="0px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">RETEFUENTE</th>
            <td style="text-align:left;" valign="top">$ '.number_format($descuento_retefuente, 0, ",", ".").'</td>
            <th style="text-align:left;" valign="top">REPARACIONES O SERVICIOS</th>
            <td style="text-align:left;" valign="top">$ '.number_format($descuento_reparacion_servicio, 0, ",", ".").'</td>
            <th style="text-align:left">OTROS IMPUESTOS (DIAN)</th>
            <td style="text-align:left">$ '.number_format($descuento_otro_impuesto_dian, 0, ",", ".").'</td>
          </tr>
          <tr>
            <th style="text-align:left">ADMINISTRACION INCLUIDA</th>
            <td style="text-align:left">$ '.number_format($descuento_administracion_incluida, 0, ",", ".").'</td>
            <th style="text-align:left">INTERESES</th>
            <td style="text-align:left">$ '.number_format($monto_cuota_interes, 0, ",", ".").'</td>
            <th style="text-align:left"></th>
            <td style="text-align:left"></td>
          </tr>
          <tr>
            <th style="text-align:left"></th>
            <td style="text-align:left"></td>
            <th style="text-align:left">TOTAL RECIBIDO</th>
            <td style="text-align:left">$ '.number_format($abonado, 0, ",", ".").'</td>
            <th style="text-align:left">SALDO A FAVOR</th>
            <td style="text-align:left">$ 0</td>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="80" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:left; width:50%" valign="top">EN LETRA: '.convertir_numeros_a_letras($abonado).'</td>
            <td style="text-align:left; width:50%" valign="top"></td>
           </tr>
          <tr>
            <td style="text-align:left;" valign="top"></td>
            <td style="text-align:left;" valign="top"><img src="../imagenes/firma.jpg" height="50px"/></td>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma de quien cancela</th>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma quien recibe</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">.</th>
            <td style="text-align:left;" valign="top">.</td>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">'.$direccion_emp.'</th>
            <td style="text-align:left;" valign="top"></td>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">TEL: '.$telefono_emp.'</th>
            <td style="text-align:left;" valign="top"></td>
          </tr>
          <tr>
            <td style="text-align:left;" valign="top">Facebook: inmobiliariaintegrales (grupo cerrado)</td>
            <td style="text-align:left;" valign="top"></td>
          </tr>
          <tr>
            <td style="text-align:left;" valign="top">Correo: '.$correo_emp.'</td>
            <td style="text-align:left;" valign="top"></td>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
    <thead>
      <tr>
        <td style="text-align:center;">----------------------------------------------------------------------------------------------------------</td>
      </tr>
    </thead>
</table>
';


$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="40" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:center; width:33%"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" height="50px"/></td>
            <th style="text-align:center; width:33%"><font size="+1">COMPROBANTE DE INGRESO</font> <br> '.$nombre_emp.' <br> NIT: '.$nit_empresa_emp.'</th>
            <td style="text-align:center; width:33%">CI-'.$cod_factura.'</td>
          </tr>
        </table>
  </tr>
</table>';


$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="90" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">FECHA COMPROBANTE</th>
            <td style="text-align:left;" valign="top">'.$fecha_pago_reg.'</td>
            <th style="text-align:left;" valign="top">MES</th>
            <td style="text-align:center;" valign="top">'.$nombre_letra_tabla_mes.'</td>
           </tr>
          <tr>
            <th style="text-align:left">ARRENDATARIO</th>
            <td style="text-align:left">'.$nombre1_tercero.'</td>
            <th style="text-align:left">PERIODO FACTURADO</th>
            <td style="text-align:center">'.$fecha_pago_deuda.' A '.$fecha_pago_final.'</td>
          </tr>
          <tr>
            <th style="text-align:left">CONTRATO</th>
            <td style="text-align:left">'.$cod_factura.'</td>
            <th style="text-align:left">'.$nombre_tipo_identificacion.'</th>
            <td style="text-align:center">'.$identificacion_tercero.'</td>
          </tr>
          <tr>
            <th style="text-align:left">DIRRECION</th>
            <td style="text-align:left">'.$direccion_producto.'</td>
            <th style="text-align:left">CANON</th>
            <td style="text-align:center">'.number_format($monto_deuda_alerta, 0, ",", ".").'</td>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="80" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="2px" cellspacing="0px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">RETEFUENTE</th>
            <td style="text-align:left;" valign="top">$ '.number_format($descuento_retefuente, 0, ",", ".").'</td>
            <th style="text-align:left;" valign="top">REPARACIONES O SERVICIOS</th>
            <td style="text-align:left;" valign="top">$ '.number_format($descuento_reparacion_servicio, 0, ",", ".").'</td>
            <th style="text-align:left">OTROS IMPUESTOS (DIAN)</th>
            <td style="text-align:left">$ '.number_format($descuento_otro_impuesto_dian, 0, ",", ".").'</td>
          </tr>
          <tr>
            <th style="text-align:left">ADMINISTRACION INCLUIDA</th>
            <td style="text-align:left">$ '.number_format($descuento_administracion_incluida, 0, ",", ".").'</td>
            <th style="text-align:left">INTERESES</th>
            <td style="text-align:left">$ '.number_format($monto_cuota_interes, 0, ",", ".").'</td>
            <th style="text-align:left"></th>
            <td style="text-align:left"></td>
          </tr>
          <tr>
            <th style="text-align:left"></th>
            <td style="text-align:left"></td>
            <th style="text-align:left">TOTAL RECIBIDO</th>
            <td style="text-align:left">$ '.number_format($abonado, 0, ",", ".").'</td>
            <th style="text-align:left">SALDO A FAVOR</th>
            <td style="text-align:left">$ 0</td>
          </tr>
        </table>
  </tr>
</table>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="80" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:left; width:50%" valign="top">EN LETRA: '.convertir_numeros_a_letras($abonado).'</td>
            <td style="text-align:left; width:50%" valign="top"></td>
           </tr>
          <tr>
            <td style="text-align:left;" valign="top"></td>
            <td style="text-align:left;" valign="top"><img src="../imagenes/firma.jpg" height="50px"/></td>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma de quien cancela</th>
            <th style="text-align:left;" valign="top">_______________________________<br>Firma quien recibe</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">.</th>
            <td style="text-align:left;" valign="top">.</td>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">'.$direccion_emp.'</th>
            <td style="text-align:left;" valign="top"></td>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">TEL: '.$telefono_emp.'</th>
            <td style="text-align:left;" valign="top"></td>
          </tr>
          <tr>
            <td style="text-align:left;" valign="top">Facebook: inmobiliariaintegrales (grupo cerrado)</td>
            <td style="text-align:left;" valign="top"></td>
          </tr>
          <tr>
            <td style="text-align:left;" valign="top">Correo: '.$correo_emp.'</td>
            <td style="text-align:left;" valign="top"></td>
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
$nombre_archivo = 'COMPROBANTE_INGRESO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_cuentas_cobrar_abonos.'_'.$cod_cuentas_cobrar_alerta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero.'.pdf';
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