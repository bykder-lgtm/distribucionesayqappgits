<?php ob_start();?>
<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");

$serguridad_pagina                                    = 1; 
$cod_info_factura_venta                               = intval($_GET['cod_info_factura_venta']);
$fecha                                                = addslashes($_GET['fecha']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                                          = $info_fact['cod_factura'];
$fecha_anyo                                           = $info_fact['fecha_anyo'];
$fecha_hora                                           = $info_fact['fecha_hora'];
$total_precio_compra                                  = $info_fact['total_precio_compra'];
$total_precio_venta                                   = $info_fact['total_precio_venta'];
$total_datos_data                                     = $info_fact['total_datos_data'];
$cod_tercero                                          = $info_fact['cod_tercero'];
$cuenta                                               = $info_fact['cuenta'];
$vlr_cancelado                                        = $info_fact['vlr_cancelado'];
$vlr_vuelto                                           = $info_fact['vlr_vuelto'];
$cod_tipo_pago                                        = $info_fact['cod_tipo_pago'];
$cod_administrador                                    = $info_fact['cod_administrador'];
$cod_tipo_forma_pago                                  = $info_fact['cod_tipo_forma_pago'];
$nombre_tipo_factura                                  = $info_fact['nombre_tipo_factura'];
$nombre_tipo_moneda                                   = $info_fact['nombre_tipo_moneda'];
$cod_resolucion_facturacion                           = $info_fact['cod_resolucion_facturacion'];
$descuento_ptj                                        = $info_fact['descuento_ptj'];
$cod_caja_virtual                                     = $info_fact['cod_caja_virtual'];
$cod_base_caja                                        = $info_fact['cod_base_caja'];
$cod_cufe                                             = $info_fact['cod_cufe'];

$cod_info_factura_venta_codif                         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
$cod_info_factura_venta_codif_cryp                    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);

if ($cod_cufe == "") { $cufe = ''; } else { $cufe = '<tr><td width="100%" style="text-align: center;"><h6>CUFE: '.$cod_cufe.'</h6></td></tr>'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombre1_tercero                                      = $info_profesional['nombre1_tercero'];
$nombre2_tercero                                      = $info_profesional['nombre2_tercero'];
$apellido1_tercero                                    = $info_profesional['apellido1_tercero'];
$apellido2_tercero                                    = $info_profesional['apellido2_tercero'];
$identificacion_tercero                               = $info_profesional['identificacion_tercero'];
$nombre_tipo_identificacion                           = $info_profesional['nombre_tipo_identificacion'];
$direccion_tercero                                    = $info_profesional['direccion_tercero'];
$telefono1_tercero                                    = $info_profesional['telefono1_tercero'];
$digito_tercero                                       = $info_profesional['digito_tercero'];
$correo_tercero                                       = $info_profesional['correo_tercero'];
$nombre_departamento                                  = $info_profesional['nombre_departamento'];
$nombre_ciudad                                        = $info_profesional['nombre_ciudad'];
$nombre_cliente                                       = $nombre1_tercero.' '.$nombre2_terceroo.' '.$apellido1_tercero.' '.$apellido2_tercero;
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$info_profesional['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
$data_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago                                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                               = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_resolucion_facturacion                           = $matriz_consulta['cod_resolucion_facturacion'];
$cod_tipo_resolucion_facturacion                      = $matriz_consulta['cod_tipo_resolucion_facturacion'];
$nombre_tipo_resolucion_facturacion                   = $matriz_consulta['nombre_tipo_resolucion_facturacion'];
$numero_resolucion_facturacion                        = $matriz_consulta['numero_resolucion_facturacion'];
$ini_resolucion_facturacion                           = $matriz_consulta['ini_resolucion_facturacion'];
$fin_resolucion_facturacion                           = $matriz_consulta['fin_resolucion_facturacion'];
$prefijo_resolucion_facturacion                       = $matriz_consulta['prefijo_resolucion_facturacion'];
$fecha_resolucion_facturacion                         = $matriz_consulta['fecha_resolucion_facturacion'];
$vigencia_meses_resolucion_facturacion                = $matriz_consulta['vigencia_meses_resolucion_facturacion'];
$fecha_reg                                            = $matriz_consulta['fecha_reg'];
$nombre_tipo_estado                                   = $matriz_consulta['nombre_tipo_estado'];
$fecha_vencimiento_resolucion_facturacion             = $matriz_consulta['fecha_vencimiento_resolucion_facturacion'];
$fecha_alerta_vence_vigencia                          = strtotime($fecha_vencimiento_resolucion_facturacion) - strtotime($fecha_hoy);
$dias_vence_vigencia                                  = $fecha_alerta_vence_vigencia/(60*60*24);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                                      = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                                             = $matriz_usario_vendedor['cod_caja'];
$hora_impresion                                       = date("H:i:s");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                        = $info_empresa_data['titulo'];
$nombre_emp                                                        = $info_empresa_data['nombre'];
$eslogan_emp                                                       = $info_empresa_data['eslogan'];
$direccion_emp                                                     = $info_empresa_data['direccion'];
$ciudad_emp                                                        = $info_empresa_data['ciudad'];
$pais_emp                                                          = $info_empresa_data['pais'];
$correo_emp                                                        = $info_empresa_data['correo'];
$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                                      = $info_empresa_data['telefono'];
$info_legal_emp                                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                                 = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                      = $info_empresa_data['cabecera'];
$icono_emp                                                         = $info_empresa_data['icono'];
$desarrollador_emp                                                 = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                                             = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                                          = $info_empresa_data['anyo'];
$url_pag                                                           = $info_empresa_data['url_pag'];
$nombre_font                                                       = $info_empresa_data['nombre_font'];
$res_emp                                                           = $info_empresa_data['res'];
$res1_emp                                                          = $info_empresa_data['res1'];
$res2_emp                                                          = $info_empresa_data['res2'];
$departamento_emp                                                  = $info_empresa_data['departamento'];
$localidad_emp                                                     = $info_empresa_data['localidad'];
$reg_medico_emp                                                    = $info_empresa_data['reg_medico'];
$regimen_emp                                                       = $info_empresa_data['regimen'];
$version_emp                                                       = $info_empresa_data['version'];
$propietario_url_firma_emp                                         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                                    = $info_empresa_data['fecha_time'];
$licencia_emp                                                      = $info_empresa_data['licencia'];
$tamano_font_emp                                                   = $info_empresa_data['tamano_font'];
$info_histclinic_emp                                               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                               = $info_empresa_data['info_aptlaboral'];
$cod_estado_converir_und_a_caja_mostrar_imprimir_global            = $info_empresa_data['cod_estado_converir_und_a_caja_mostrar_imprimir_global'];
if ($pais_emp == 'COLOMBIA') { $abrev_pais = '(CO)'; } else { $abrev_pais = '(CO)'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                                           = '10';
$margen_der                                           = '10';
$margen_inf_encabezado                                = '5';
$margen_sup_encabezado                                = '10';
$posicion_sup_encabezado                              = '5';
$posicion_inf_encabezado                              = '2';

$titulo_doc_pdf                                       = 'ORDEN_PEDIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$autor_doc_pdf                                        = 'ORDEN_PEDIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$creador_doc_pdf                                      = 'ORDEN_PEDIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$tema_doc_pdf                                         = 'ORDEN_PEDIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$palabras_claves_doc_pdf                              = 'ORDEN_PEDIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$cod_factura_strpad                                   = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad                              = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);
$nombres_completos                                    = "ORDEN_PEDIDO";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$headerE = '
';
$headerE = '
';
$footer = '
<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
'.$cufe.'
<tr><td width="100%" style="text-align: center;"><h6>Software '.$titulo_emp.' - Implementado por Proveedor Tecnológico '.$desarrollador_emp.'</h6></td></tr>
<tr><td width="100%" style="text-align: right;"><h6>[Página {PAGENO} de {nbpg}]</h6></td></tr>

</table>
';
$footerE = '
<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
'.$cufe.'
<tr><td width="100%" style="text-align: center;"><h6>Software '.$titulo_emp.' - Implementado por Proveedor Tecnológico '.$desarrollador_emp.'</h6></td></tr>
<tr><td width="100%" style="text-align: right;"><h6>[Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';
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

$codigoHTML = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center; font-size:8pt;" colspan="2" rowspan="2"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:100px;"></td>
    <td style="text-align:left; font-size:11pt; font-weight: bold;" colspan="2">ORDEN DE PEDIDO No:</td>
    <td style="text-align:center; font-size:11pt; font-weight: bold;">'.''.$cod_factura.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="3"><!--Representación Gráfica--></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:11pt; font-weight: bold;" colspan="2" width="40%">'.$nombre_emp.' NIT '.$propietario_nit_emp.'</td>
    <td style="text-align:left; font-size:7pt;" colspan="3">Fecha de Generación: '.$fecha_anyo.' '.$fecha_hora.'<!--Habilitación Numeración de Facturación '.$nombre_tipo_factura.'--></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="2">Actividad Económica Principal 4773</td>
    <td style="text-align:left; font-size:7pt;" colspan="3">Fecha de Vencimiento: '.$fecha_anyo.' '.$fecha_hora.'<!--No. '.$numero_resolucion_facturacion.' de '.$fecha_resolucion_facturacion.' - '.$fecha_vencimiento_resolucion_facturacion.' autoriza '.$prefijo_resolucion_facturacion.'-'.$ini_resolucion_facturacion.' a '.$prefijo_resolucion_facturacion.'-'.$fin_resolucion_facturacion.'--></td>
    <td style="text-align:center; font-size:7pt;"></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="2">No somos Agente Retenedor del Impuesto sobre las Ventas - IVA</td>
    <td style="text-align:left; font-size:7pt; width: 20%;">Fecha de Validación: <!--Tipo de Operación--></td>
    <td style="text-align:left; font-size:7pt width: 50%;">'.$fecha_anyo.' '.$fecha_hora.'<!--Estandar--></td>
    <td style="text-align:center; font-size:7pt;" rowspan="7"><!--<barcode code="'.$pag_desarrollador_emp.'" size="1" type="QR" error="M" class="barcode" />--></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="2">No somos Autorretenedor del Impuesto sobre la Renta y Complementarios</td>
    <td style="text-align:left; font-size:7pt;">Forma de Pago</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_forma_pago.'</td>
  </tr>
  <tr>
  <td style="text-align:center; font-size:7pt;"></td>
  <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Medio de Pago</td>fecha_anyo
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_pago.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Moneda</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_moneda.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Vendedor</td>
    <td style="text-align:left; font-size:7pt;">'.$usario_vendedor.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Caja</td>
    <td style="text-align:left; font-size:7pt;">'.$cod_base_caja.'</td>
  </tr>
  <tr>
  <td style="text-align:center; font-size:7pt;" colspan="1" rowspan="0"><!--<barcode code="'.$cod_factura_strpad.'" type="C128A" size="0.6" height="1" />--></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;"></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<hr>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight: bold; width: 50%" colspan="2">DATOS DEL EMISOR / VENDEDOR</td>
    <td style="text-align:center; font-size:11pt; font-weight: bold; width: 50%" colspan="2">DATOS DEL ADQUIRIENTE / COMPRADOR</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Razón Social</td>
    <td style="text-align:left; font-size:7pt;">'.$propietario_nombres_apellidos_emp.'</td>
    <td style="text-align:left; font-size:7pt;">Razón Social </td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_cliente.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Nombre Comercial</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_emp.'</td>
    <td style="text-align:left; font-size:7pt;">Nombre Comercial</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_cliente.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">CC</td>
    <td style="text-align:left; font-size:7pt;">'.$propietario_nit_emp.'</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_identificacion.'</td>
    <td style="text-align:left; font-size:7pt;">'.$identificacion_tercero.''.$digito_tercero.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Obligación</td>
    <td style="text-align:left; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Obligación</td>
    <td style="text-align:left; font-size:7pt;"></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Email</td>
    <td style="text-align:left; font-size:7pt;">'.$correo_emp.'</td>
    <td style="text-align:left; font-size:7pt;">Email</td>
    <td style="text-align:left; font-size:7pt;">'.$correo_tercero.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Teléfono</td>
    <td style="text-align:left; font-size:7pt;">'.$telefono_emp.'</td>
    <td style="text-align:left; font-size:7pt;">Teléfono</td>
    <td style="text-align:left; font-size:7pt;">'.$telefono1_tercero.'</td>direccion_emp
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Dirección</td>
    <td style="text-align:left; font-size:7pt;">'.$direccion_emp.'</td>
    <td style="text-align:left; font-size:7pt;">Dirección</td>
    <td style="text-align:left; font-size:7pt;">'.$direccion_tercero.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;">Ciudad, Depart.</td>
    <td style="text-align:left; font-size:7pt;">'.$ciudad_emp.', '.$departamento_emp.' '.$abrev_pais.'</td>
    <td style="text-align:left; font-size:7pt;">Ciudad, Depart.</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_ciudad.', '.$nombre_departamento.' '.$abrev_pais.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<hr>
<!-- /////////////////////////////////////////////////// -->
';


   
$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="400" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
          <tr>
            <td style="text-align:center; font-size:6pt;" width="30" valign="top"><strong>No</strong></td>
            <td style="text-align:left; font-size:9pt;" width="50" valign="top"><strong>REF</strong></td>
            <td style="text-align:left; font-size:9pt;" width="220" valign="top"><strong>DESCRIPCIÓN</strong></td>
            <td style="text-align:center; font-size:9pt;" width="40" valign="top"><strong>CANT</strong></td>
            <td style="text-align:center; font-size:9pt;" width="40" valign="top"><strong>U/M</strong></td>
            <td style="text-align:right; font-size:9pt;" width="70" valign="top"><strong>PRECIO</strong></td>
            <td style="text-align:right; font-size:9pt;" width="40" valign="top"><strong>IMP</strong></td>
            <td style="text-align:right; font-size:9pt;" width="100" valign="top"><strong>SUBTOTAL</strong></td>
            <td style="text-align:right; font-size:9pt;" width="100" valign="top"><strong>TOTAL ITEM</strong></td>
           </tr>';

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$nombre_producto_cliente          = '';
$contador_item                    = 0;

$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto ASC";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql);
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta) ) { 

	$cod_producto                   = $info_venta['cod_producto'];
	$cod_producto_barra             = $info_venta['cod_producto_barra'];
	$nombre_producto                = $info_venta['nombre_producto'];
	$und_venta                      = $info_venta['und_venta'];
	$precio_venta_producto          = $info_venta['precio_venta_producto'];
	$total_venta_producto           = $info_venta['total_venta_producto'];
	$iva_ptj                        = $info_venta['iva_ptj'];
	$precio_ipc                     = $info_venta['precio_ipc'];
	$comentario_producto            = $info_venta['comentario_producto'];
	$und_caja_sobre                 = $info_venta['und_caja_sobre'];
	$cajas_sobre                    = $info_venta['cajas_sobre'];
	$nombre_tipo_und_caja_sobre     = $info_venta['nombre_tipo_und_caja_sobre'];
	$nombre_tipo_unidad_medida      = $info_venta['nombre_tipo_unidad_medida'];
	$cedula                         = $info_venta['cedula'];
	$nombre_cliente                 = $info_venta['nombre_cliente'];

	$total_venta_temp              += $total_venta_producto;
	$total_costo_motivo_consulta   += $total_venta_producto;
	$contador_item++;

	if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_venta; $und_venta_caja = intval($und_caja_sobre); $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $und_venta_caja = ''; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $und_venta_caja = ''; $subtitulo_tipo_caja = "|UND"; } }
	if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

	$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
	$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
	$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

	$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

	if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
	if ($nombre_cliente=='') { $nombre_producto_cliente = $nombre_producto; } else { $nombre_producto_cliente = $nombre_cliente.' - '.$nombre_producto; }

	$precio_venta_producto_antes_de_iva = $precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100));

	if ($cajas_sobre == '0') { $cajas_sobre = 1; }
	if ($cod_estado_converir_und_a_caja_mostrar_imprimir_global == '1') { 
		if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
			$und_venta = ($und_venta); 
			$nombre_tipo_unidad_medida = 'UND'; 
			$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
			$precio_venta_producto = ($precio_venta_producto); 
		} else { 
			$und_venta = ($und_venta / $cajas_sobre); 
			$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
			$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
			$precio_venta_producto = ($precio_venta_producto * $cajas_sobre); 
		}
	} else { 
		if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
			$und_venta = ($und_venta); 
			$nombre_tipo_unidad_medida = 'UND'; 
			$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
			$precio_venta_producto = ($precio_venta_producto); 
		} else { 
			$und_venta = ($und_venta / $cajas_sobre); 
			$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
			$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
			$precio_venta_producto = ($precio_venta_producto * $cajas_sobre); 
		}
	}
		
$codigoHTML.='
          <tr>
            <td style="text-align:center; font-size:6pt;">'.$contador_item.'</td>
            <td style="text-align:left; font-size:9pt;">'.$cod_producto_barra.'</td>
            <td style="text-align:left; font-size:9pt;">'.$nombre_producto.'</td>
            <td style="text-align:center; font-size:9pt;">'.$und_venta.'</td>
            <td style="text-align:center; font-size:9pt;">'.$nombre_tipo_unidad_medida.'</td>
            <td style="text-align:right; font-size:9pt;t">'.number_format($precio_venta_producto_antes_de_iva, 0, ",", ".").'</td>
            <td style="text-align:right; font-size:9pt;">0</td>
            <td style="text-align:right; font-size:9pt;">'.number_format($precio_venta_producto, 0, ",", ".").'</td>
            <td style="text-align:right; font-size:9pt;">'.number_format($total_venta_producto, 0, ",", ".").'</td>
          </tr>';
}
$codigoHTML.='
        </table>
  </tr>
</table>';

$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" width="20" valign="top">'.$contador_item.'</td>
    <td style="text-align:right" width="354" valign="top">SUBTOTAL</td>
    <td style="text-align:right" width="332" valign="top">$ '.number_format($total_costo_motivo_consulta, 0, ",", ".").'</td>
  </tr>
  <tr>
    <td style="text-align:right" valign="top"></td>
    <td style="text-align:right" valign="top">TOTAL A PAGAR</td>
    <td style="text-align:right" valign="top">$ '.number_format($total_costo_motivo_consulta, 0, ",", ".").'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="45" valign="top">SON:</td>
    <td width="650" valign="top">'.convertir_numeros_a_letras($total_costo_motivo_consulta).'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td><p><strong>FIRMA EMISOR</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="90px"/></div>
    <div>___________________________________</div><br> 
      <!-- <p><strong>'.$nombres_prof.' '.$apellidos_prof.'</strong></p></td> -->

    <td><p><strong>FIRMA CLIENTE</strong></p>
    <div><img src="../imagenes/firma_vacia.jpg" height="90px"/></div>
    <div>___________________________________</div><br> 
       <!-- <p><strong>'.$nombres_cli.' '.$apellido1_cli.'</strong></p></td> -->
  </tr>
<!--
  <tr>
    <td><p><strong>Reg. M&eacute;dico: '.$reg_medico_emp. ' </strong><strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong><strong> </strong></p></td>
    <td><p><strong>C.C '.$cedula.'</strong> </p></td>
  </tr>
-->
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="693" valign="top">TEL</td>
  </tr>
</table>
-->
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
$nombre_archivo = 'ORDEN_PEDIDO_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa.'.pdf';
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