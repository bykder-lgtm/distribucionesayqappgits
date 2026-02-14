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
$leyenda3_defec_global             = $info_empresa_data['leyenda3_defec_global'];
$leyenda2_defec_global             = $info_empresa_data['leyenda2_defec_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$serguridad_pagina                                = 1; 
$cod_info_gasto_inmueble_inquilino_venta          = intval($_GET['cod_info_gasto_inmueble_inquilino_venta']);
$cuenta                                           = addslashes($_GET['cuenta']);
$cod_caja_virtual                                 = intval($_GET['cod_caja_virtual']);
//$cod_factura                                      = intval($_GET['cod_factura']);
//$cod_tercero                                      = intval($_GET['cod_tercero']);
$fecha_impr                                       = date("Ymd");
$hora_impr                                        = date("His");
$fecha_emision                                    = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$datos_data_info_factura = "SELECT * FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);
 	 	
$cod_info_gasto_inmueble_inquilino_venta    = $data_info_factura['cod_info_gasto_inmueble_inquilino_venta'];
$cod_cuentas_cobrar                         = $data_info_factura['cod_cuentas_cobrar'];
$cod_factura                                = $data_info_factura['cod_factura'];
$cod_tercero                                = $data_info_factura['cod_tercero'];
$fecha_ymdhis                               = $data_info_factura['fecha_ymdhis'];
$cuenta                                     = $data_info_factura['cuenta'];
$cod_estado_factura                         = $data_info_factura['cod_estado_factura'];
$cod_base_caja                              = $data_info_factura['cod_base_caja'];
$descuento_ptj                              = $data_info_factura['descuento_ptj'];
$cod_tipo_pago                              = $data_info_factura['cod_tipo_pago'];
//$cod_administrador                          = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                       = $data_info_factura['nombre_tipo_producto'];
$cod_tipo_forma_pago                        = $data_info_factura['cod_tipo_forma_pago'];
$fecha_creacion                             = $data_info_factura['fecha_creacion'];
$fecha_modificacion                         = $data_info_factura['fecha_modificacion'];
$cod_resolucion_facturacion                 = $data_info_factura['cod_resolucion_facturacion'];
$fecha_pago                                 = $data_info_factura['fecha_pago'];
$cod_producto                               = $data_info_factura['cod_producto'];
$cod_producto_barra                         = $data_info_factura['cod_producto_barra'];
$nombre_producto                            = $data_info_factura['nombre_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cuentas_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_factura = '$cod_factura')";
$consulta_info_cuentas_cobrar = mysqli_query($conectar, $sql_info_cuentas_cobrar);
$datos_info_cuentas_cobrar = mysqli_fetch_assoc($consulta_info_cuentas_cobrar);

$cod_tercero_inquilino                      = $datos_info_cuentas_cobrar['cod_tercero'];
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
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, nombre_tipo_identificacion FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_inquilino'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_tipo_identificacion     = $total_cliente['nombre_tipo_identificacion'];
$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$nombre2_tercero                = $total_cliente['nombre2_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$apellido2_tercero              = $total_cliente['apellido2_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT cod_producto_barra, nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                         = $total_producto['cod_producto_barra'];
$nombre_tipo_producto                       = $total_producto['nombre_tipo_producto'];
$direccion_producto                         = $total_producto['direccion_producto'];
$descripcion_producto                       = $total_producto['descripcion_producto'];
$cod_tercero_propietario                    = $total_producto['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                         = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_gasto_inmueble_inquilino_venta_strpad           = str_pad($cod_info_gasto_inmueble_inquilino_venta, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_aprobado == '1') { $url_img_firma_pago = '../imagenes/firma_usuario/firma_aprobado_por_propietario.png'; } else { $url_img_firma_pago = '../imagenes/firma_usuario/firma_aprobado_por_propietario.png'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//$total_pagar                                = $monto_deuda_alerta - ($total_deduccion);
$total_gastado_saldo_favor = 0;
$obtener_gasto = "SELECT SUM(precio_venta_producto) AS total_gastado_saldo_favor FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') ORDER BY cod_gasto_inmueble_inquilino_venta_temporal DESC";
$consultar_gasto = mysqli_query($conectar, $obtener_gasto) or die(mysqli_error($conectar));
$info_gasto = mysqli_fetch_assoc($consultar_gasto);

$total_gastado_saldo_favor                   = $info_gasto['total_gastado_saldo_favor'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_facturas = "SELECT deduccion_saldo_favor FROM tbl15_cuentas_cobrar WHERE (cod_factura = '$cod_factura')";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$datos_total_facturas = mysqli_fetch_array($consulta_total_facturas);

$deduccion_saldo_favor                       = $datos_total_facturas['deduccion_saldo_favor'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$total_gastado_entregar                      = $deduccion_saldo_favor - $total_gastado_saldo_favor;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                        = '5';
$margen_der                        = '5';
$margen_inf_encabezado             = '15';
$margen_sup_encabezado             = '2';
$posicion_sup_encabezado           = '5';
$posicion_inf_encabezado           = '2';

$titulo_doc_pdf                    = 'COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$autor_doc_pdf                     = 'COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$creador_doc_pdf                   = 'COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$tema_doc_pdf                      = 'COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;
$palabras_claves_doc_pdf           = 'COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero;

$cod_factura_strpad                = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad           = str_pad($cod_info_gasto_inmueble_inquilino_venta, 6, "0", STR_PAD_LEFT);
$nombres_completos                 = "COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '';
$headerE = '';
$footer = '';
$footerE = '';

$mpdf->SetWatermarkImage('../imagenes/logo_casa_veterinaria.png', 0.15, '', array(10,50));
$mpdf->showWatermarkImage = true;

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
    <td width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="5px" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center;" rowspan="6"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" height="80px"/></th>
            <th style="text-align:center;" colspan="2">'.$nombre_emp.' <br> NIT: '.$nit_empresa_emp.'</th>
            <th style="text-align:center;" rowspan="6"><barcode code="'.$cod_info_gasto_inmueble_inquilino_venta_strpad.'" type="C128A" size="0.6" height="1" /></th>
          </tr>
          <tr>
            <th style="text-align:center;" colspan="2">REGIMEN: '.$regimen_emp.'</th>
          </tr>
          <tr>
            <th style="text-align:center;" colspan="2">SALDO A FAVOR: '.$nombre_tipo_producto.'</th>
          </tr>
          <tr>
            <td style="text-align:right;"></td>
            <td style="text-align:left;"></td>
          </tr>
        </table>
  </tr>
</table>';





$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
          <tr>
            <th style="text-align:left;" valign="top">ARRENDATARIO (A): </th>
            <th style="text-align:left;" valign="top">'.$nombre1_tercero.' | '.number_format($identificacion_tercero, 0, ",", ".").'</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">DIRECCION: </th>
            <th style="text-align:left;" valign="top">'.$direccion_producto.'</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">CONTRATO: </th>
            <th style="text-align:left;" valign="top">'.$cod_factura.'</th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">SALDO A FAVOR: </th>
            <th style="text-align:left;" valign="top">$ '.number_format($deduccion_saldo_favor, 0, ",", ".").'</th>
          </tr>
        </table>
  </tr>
</table>';


$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center;">DISTRIBUIDOS ASI:</th>
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
            <th style="text-align:center; width:30%;" valign="top">CONCEPTO</th>
            <th style="text-align:left; width:60%;" valign="top">DETALLE</th>
            <th style="text-align:center; width:2%;" valign="top"></th>
            <th style="text-align:center; width:8%;" valign="top">COSTO</th>
           </tr>
           ';

            $obtener_cie10diag = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') ORDER BY cod_gasto_inmueble_inquilino_venta_temporal DESC";
            $consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
            while ($info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag)) {

            $cod_gasto_inmueble_inquilino_venta_temporal      = $info_cie10diag['cod_gasto_inmueble_inquilino_venta_temporal'];
            $nombre_gasto_inmueble_detalle                    = $info_cie10diag['nombre_gasto_inmueble_detalle'];
            $descripcion_gasto_inmueble_detalle               = $info_cie10diag['descripcion_gasto_inmueble_detalle'];
            $precio_venta_producto                            = $info_cie10diag['precio_venta_producto'];
            //$total_gastado_saldo_favor                                     += $precio_venta_producto;

$codigoHTML.='
          <tr>
            <td style="text-align:left;" valign="top">'.$nombre_gasto_inmueble_detalle.'</td>
            <td style="text-align:left;" valign="top">'.$descripcion_gasto_inmueble_detalle.'</td>
            <td style="text-align:left;" valign="top">$</td>
            <td style="text-align:right;" valign="top">'.number_format($precio_venta_producto, 0, ",", ".").'</td>
           </tr>
           ';
       		}
$codigoHTML.='
          <tr>
            <th style="text-align:left;" valign="top"><hr></th>
            <th style="text-align:left;" valign="top"><hr></th>
            <th style="text-align:left;" valign="top"><hr></th>
            <th style="text-align:left;" valign="top"><hr></th>
           </tr>
          <tr>
            <th style="text-align:left;" valign="top"></th>
            <th style="text-align:left;" valign="top">TOTAL</th>
            <th style="text-align:left;" valign="top">$</th>
            <th style="text-align:right;" valign="top">'.number_format($total_gastado_saldo_favor, 0, ",", ".").'</th>
           </tr>
        </table>
  </tr>
</table>';
 	 	
$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
			<td style="text-align:justify;">'.$leyenda2_defec_global.'</td>
           </tr>
        </table>
<br>';

$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
			<th style="text-align:left;">TOTAL GASTADO SALDO A FAVOR: $'.number_format($total_gastado_saldo_favor, 0, ",", ".").'</th>
           </tr>
        </table>
';

$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
			<th style="text-align:left;">TOTAL A ENTREGAR DE SALDO A FAVOR: $'.number_format($total_gastado_entregar, 0, ",", ".").'</th>
           </tr>
          <tr>
			<td style="text-align:left;">EN LETRA: '.convertir_numeros_a_letras($total_gastado_entregar).'</td>
           </tr>
        </table>
<br>';

$codigoHTML.='
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_remision_emp.'pt; width:100%">
          <tr>
			<td style="text-align:left;"></td>
			<td style="text-align:left;">- Anexo facturas</td>
           </tr>
          <tr>
          	<td style="text-align:left;"></td>
			<td style="text-align:left;">- Para constancia se firma el '.date("d-m-Y", strtotime($fecha_emision)).'</td>
           </tr>
        </table>
<br>';

$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <th width="576" height="10" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="" cellspacing="2px" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:left;" valign="top">Administrador</th>
            <th style="text-align:left;" valign="top">Acepto;</th>
            <th style="text-align:left;" valign="top"></th>
          </tr>


          <tr>
            <th style="text-align:left;" valign="top"><img src="'.$url_img_firma_prof_ori_firma.'" height="50px"/></th>
            <th style="text-align:left;" valign="top"></th>
            <th style="text-align:left;" valign="top"></th>
          </tr>
          <tr>
            <th style="text-align:left;" valign="top">_______________________________<br>'.$nombre_emp.'<br>NIT: '.$nit_empresa_emp.'</th>
            <th style="text-align:left;" valign="top">_______________________________<br>'.$nombre1_tercero.'<br>'.$nombre_tipo_identificacion.': '.number_format($identificacion_tercero, 0, ",", ".").'</th>
            <th style="text-align:left;" valign="top"></th>
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
$nombre_archivo = 'COMPROBANTE_CUENTA_DE_ARREGLO_ARRENDATARIO_NO_DEDUCIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$cod_cuentas_cobrar.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$cod_info_gasto_inmueble_inquilino_venta.'_'.$nombre_tipo_producto.'_'.$nombre1_tercero.'.pdf';
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