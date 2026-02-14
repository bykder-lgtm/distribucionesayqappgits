<?php ob_start();?>
<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');

$serguridad_pagina                          = 1; 
$cod_info_plan_accion_correctiva_preventiva_mejora    = intval($_GET['cod_info_plan_accion_correctiva_preventiva_mejora']);
$fecha                                      = addslashes($_GET['fecha']);

$sql_info_factura = "SELECT * FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
$data_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$cod_factura                       = $data_info_factura['cod_factura'];
$cod_tercero                       = $data_info_factura['cod_tercero'];
$cod_historia_clinica              = $data_info_factura['cod_historia_clinica'];
$fecha_ini                         = $data_info_factura['fecha_ini'];
$fecha_fin                         = $data_info_factura['fecha_fin'];
$cod_empresa                       = $data_info_factura['cod_empresa'];
$nombre_empresa                    = $data_info_factura['nombre_empresa'];
$razonsocial_empresa               = $data_info_factura['razonsocial_empresa'];
$total_motivo                      = $data_info_factura['total_motivo'];
$total_muestra                     = $data_info_factura['total_muestra'];
$fecha_ymdhis                      = $data_info_factura['fecha_ymdhis'];
$cuenta                            = $data_info_factura['cuenta'];
$cod_estado_factura                = $data_info_factura['cod_estado_factura'];
$cod_base_caja                     = $data_info_factura['cod_base_caja'];
$descuento_ptj                     = $data_info_factura['descuento_ptj'];
$iva_ptj                           = $data_info_factura['iva_ptj'];
$flete_ptj                         = $data_info_factura['flete_ptj'];
$cod_cliente                       = $data_info_factura['cod_cliente'];
$vlr_cancelado                     = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                        = $data_info_factura['vlr_vuelto'];
$fecha_dia                         = $data_info_factura['fecha_dia'];
$fecha_mes                         = $data_info_factura['fecha_mes'];
$fecha_anyo                        = $data_info_factura['fecha_anyo'];
$anyo                              = $data_info_factura['anyo'];
$fecha_hora                        = $data_info_factura['fecha_hora'];
$fecha_remision                    = $data_info_factura['fecha_remision'];
$nombre_ccosto                     = $data_info_factura['nombre_ccosto'];
$garantia_meses                    = $data_info_factura['garantia_meses'];
$observacion                       = $data_info_factura['observacion'];
$cod_tipo_pago                     = $data_info_factura['cod_tipo_pago'];
$cod_administrador                 = $data_info_factura['cod_administrador'];
$nombre_tipo_producto              = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra               = $data_info_factura['total_precio_compra'];
$total_precio_venta                = $data_info_factura['total_precio_venta'];
$cod_dependencia                   = $data_info_factura['cod_dependencia'];
$servicio                          = $data_info_factura['servicio'];
$cod_tipo_forma_pago               = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago            = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago       = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura               = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                   = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                    = $data_info_factura['fecha_creacion'];
$fecha_modificacion                = $data_info_factura['fecha_modificacion'];
$nombre_maquina                    = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                   = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                 = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion        = $data_info_factura['cod_resolucion_facturacion'];
$nombre_comentario                 = $data_info_factura['nombre_comentario'];
$nombre_factura_remision           = $data_info_factura['nombre_factura_remision'];
$nombre_tipo_pendiente             = $data_info_factura['nombre_tipo_pendiente'];
$descripcion_tipo_pendiente        = $data_info_factura['descripcion_tipo_pendiente'];
$fecha_entrega                     = $data_info_factura['fecha_entrega'];
$hora_entrega                      = $data_info_factura['hora_entrega'];
//$nombre_elaboro                    = $data_info_factura['nombre_elaboro'];
$cod_administrador                 = $data_info_factura['cod_administrador'];
$monto_deuda                       = $data_info_factura['monto_deuda'];
$subtotal                          = $data_info_factura['subtotal'];
$total_abono                       = $data_info_factura['total_abono'];

$fecha_seg                         = strtotime($fecha_anyo);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);

$sql_usuario = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_usuario = mysqli_query($conectar, $sql_usuario);
$info_usuario = mysqli_fetch_assoc($resultado_usuario);

$nombre_elaboro                    = $info_usuario['nombres'].' '.$info_usuario['apellidos'];


$sql_profesional = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombre1_tercero                   = $info_profesional['nombre1_tercero'];
$nombre2_tercero                   = $info_profesional['nombre2_tercero'];
$apellido1_tercero                 = $info_profesional['apellido1_tercero'];
$apellido2_tercero                 = $info_profesional['apellido2_tercero'];
$identificacion_tercero            = $info_profesional['identificacion_tercero'];
$direccion_tercero                 = $info_profesional['direccion_tercero'];
$telefono1_tercero                 = $info_profesional['telefono1_tercero'];
$telefono2_tercero                 = $info_profesional['telefono2_tercero'];
$digito_tercero                    = $info_profesional['digito_tercero'];
$nombres_tercero_completo          = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$info_profesional['digito_tercero']; }

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
$celular_emp                       = $info_empresa_data['celular'];
$url_pag_emp                       = $info_empresa_data['url_pag'];

include_once('mpdf/mpdf.php');
$margen_izq = '5';
$margen_der = '5';
$margen_inf_encabezado = '5';
$margen_sup_encabezado = '5';
$posicion_sup_encabezado = '5';
$posicion_inf_encabezado = '2';

$titulo_doc_pdf                    = 'PLAN_ACCION_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$autor_doc_pdf                     = 'PLAN_ACCION_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$creador_doc_pdf                   = 'PLAN_ACCION_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$tema_doc_pdf                      = 'PLAN_ACCION_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$palabras_claves_doc_pdf           = 'PLAN_ACCION_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$aaaaaa   = "PLAN_ACCION_";
$cod_factura_strpad                = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad           = str_pad($cod_info_plan_accion_correctiva_preventiva_mejora, 6, "0", STR_PAD_LEFT);
$nombres_completos                 = "PLAN_ACCION_";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/*
$header = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:left" rowspan="6" width="200"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:200px;"></td>
    <th style="text-align:center; font-size:18pt;" width="442">'.$nombre_emp.'</th>
    <td style="text-align:right" rowspan="6" width="140"><barcode code="'.$pag_desarrollador_emp.'" size="1" type="QR" error="M" class="barcode" /></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">NIT: '.$propietario_nit_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">TELEFONO: '.$telefono_emp.' - EMAIL: '.$correo_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">'.$ciudad_emp.' - '.$departamento_emp.', '.$pais_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"><barcode code="'.$cod_factura_strpad.'" type="C128A" size="0.6" height="1" /></td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:left" rowspan="6" width="140"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:100px;"></td>
    <th style="text-align:center; font-size:18pt;" width="442">'.$nombre_emp.'</th>
    <td style="text-align:right" rowspan="6" width="140"><barcode code="'.$pag_desarrollador_emp.'" size="1" type="QR" error="M" class="barcode" /></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">NIT: '.$propietario_nit_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">TELEFONO: '.$telefono_emp.' - EMAIL: '.$correo_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">'.$ciudad_emp.' - '.$departamento_emp.', '.$pais_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"><barcode code="'.$cod_factura_strpad.'" type="C128A" size="0.6" height="1" /></td>
  </tr>
</table>
';
$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';

$mpdf->SetHTMLHeader(($header));
$mpdf->SetHTMLHeader(($headerE),'E');
$mpdf->SetHTMLFooter(($footer));
$mpdf->SetHTMLFooter(($footerE),'E');
*/
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
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="1" cellspacing="4" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr >
    <td style="text-align:center" colspan="3" rowspan="2" width="20"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:120px;"></td>
    <td style="text-align:left; font-size:12pt;" width="120">'.$eslogan_emp.'</td>
    <td></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:13pt" width="120"><strong>'.$nombre_emp.'<br>NIT. '.$nit_empresa_emp.'</strong></td>
    <td style="text-align:center; font-size:8pt" rowspan="2"> '.$direccion_emp.' 
    <br>
    Cel. '.$telefono_emp.'
    <br>
    '.$ciudad_emp.' - '.$departamento_emp.' 
    <br>
     '.$correo_emp.'
    <br>
    '.$url_pag_emp.'
    </td>
  </tr>
  <tr>
    <td style="text-align:center" width="8">......</td>
    <td style="text-align:center" width="8"></td>
    <td style="text-align:center" width="8"></td>
    <td style="text-align:center; font-size:12pt"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align:center" width="8"></td>
    <td style="text-align:center" width="8"></td>
    <td style="text-align:center" width="8"></td>
    <td style="text-align:center; font-size:8pt">Diseño, ingeniera, recubrimiento Industrial, Tanques en cualquier forma y capacidad, Laminas, Ductos y Tuberías, Juegos para parques de Diversiones, etc.</td>
    <td style="text-align:center" width="120">ORDEN DE PRODUCCION<br>'.$cod_factura_strpad.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
  <td style="text-align:left" colspan="4">FECHA: '.$fecha_anyo.'</td>
    <td style="text-align:left">CLIENTE:</td>
    <td style="text-align:left">'.$nombres_tercero_completo.'</td>
    <td style="text-align:left">CC.ó NIT: '.$identificacion_tercero.$digito_tercero.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:left">DIRECCION:</td>
    <td style="text-align:left" colspan="2">'.$direccion_tercero.'</td>
    <td style="text-align:left">TELEFONO: </td>
    <td style="text-align:left">'.$telefono1_tercero.'</td>
  </tr>
</table>

<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:left">CELULARES:</td>
    <td style="text-align:left">'.$telefono2_tercero.'</td>
    <td style="text-align:center">PENDIENTE:</td>
    <td style="text-align:left">'.$nombre_tipo_pendiente.'</td>
    <td style="text-align:left">'.$descripcion_tipo_pendiente.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:left">COMENTARIOS:</td>
    <td style="text-align:left">'.$nombre_comentario.'</td>
    <td style="text-align:right" rowspan="2" width="70">TIEMPO DE ENTREGA</td>
    <td style="text-align:center">FECHA:</td>
    <td style="text-align:center">'.date("d-m-Y", strtotime($fecha_entrega)).'</td>
  </tr>
  <tr>
    <td style="text-align:left">FACTURA [ ] / REMISION [ ]:</td>
    <td style="text-align:left">'.$nombre_factura_remision.'</td>
    <td style="text-align:center">HORA:</td>
    <td style="text-align:center">'.$hora_entrega.'</td>

  </tr>
</table>

</table>

  <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%; border-collapse: collapse; border:1px solid #999999">
    <tr>
    <td width="40" valign="top">  * SITIO DE ENTREGA KM 12 VIA PLANETA RICA, 100 METROS PASANDO EL PEAJE </td> 

   </tr>
</table>

 <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%; border-collapse: collapse; border:1px solid #999999">
    <tr>
   <td width="40" valign="top">  HORARIO DE ENTREGA: LUNES A VIERNES: 7:00 AM  A  11:00 AM Y  DE 1:00 PM A 3:00 PM,  SABADOS:8:00 AM A 12:00M
 </td> 

   </tr>
</table>
';
$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
        <table align="center" border="1" cellpadding="0" cellspacing="20" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%; border-collapse: collapse; border:1px solid #999999">
          <tr>
            <td style="text-align:center" width="20" valign="top"><strong>Cant. </strong></td>
            <td style="text-align:left" width="440" valign="top"><strong>Descripción</strong></td>
           </tr>';

$sql_motivo_conteo = "SELECT * FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$nombre_producto_cliente          = '';
while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo) ) { 

$numero++;
$und_venta                      = $info_motivo_conteo['und_venta'];
$cedula                         = $info_motivo_conteo['cedula'];
$nombre_cliente                 = $info_motivo_conteo['nombre_cliente'];
$nombre_producto                = $info_motivo_conteo['nombre_producto'];
$precio_venta_producto          = $info_motivo_conteo['precio_venta_producto'];
$total_venta_producto           = $info_motivo_conteo['total_venta_producto'];
$total_costo_motivo_consulta   += $total_venta_producto;
if ($nombre_cliente=='') { $nombre_producto_cliente = $nombre_producto; } else { $nombre_producto_cliente = $nombre_cliente.' - '.$nombre_producto; }

$codigoHTML.='
          <tr>
            <td style="text-align:center">'.$und_venta.'</td>
            <td style="text-align:left">'.$nombre_producto_cliente.'</td>
          </tr>';
}
$codigoHTML.='
        </table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
';

$codigoHTML.='
<table style="text-align:center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
  <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
    <tr>
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
    <td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15"><td width="5" height="15">
  </tr>
</table>

<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td width="45" valign="top">SON:</td>
    <td width="650" valign="top">'.convertir_numeros_a_letras($subtotal).'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
';

$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:9pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:left" width="200">VR. TOTAL IVA INCLUIDO</td>
    <td style="text-align:right">'.number_format($monto_deuda, 0, ",", ".").'</td>
  </tr>   
  <tr>
    <td style="text-align:left">ANTICIPO $</td>
    <td style="text-align:right">'.number_format($total_abono, 0, ",", ".").'</td>
  </tr>
  <tr>
    <td style="text-align:left">SALDO $</td>
    <td style="text-align:right">'.number_format($subtotal, 0, ",", ".").'</td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td width="387" valign="top"><strong>ELABORADO POR,</strong>
    <div style="text-align:center"><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$propietario_nombres_apellidos_emp.'</strong>
    <br />
    <strong>C.C/NIT. '.$propietario_nit_emp.'</strong>
    <br />
    </td>
    <td width="387" valign="top"><strong>ACEPTACION DE CLIENTE,</strong>
    <div style="text-align:center"><img src="../imagenes/firma_vacia.jpg" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_tercero_completo.'</strong><br />
    <strong>C.C/NIT. '.$identificacion_tercero.'</strong> </td>
  </tr>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:7pt; width:100%; border-collapse: collapse; border:1px solid #999999">
  <tr>
    <td style="text-align:center">NOTA: SE RESPONDE  UNICAMENTE POR MEDIDAS Y ESPECIFICACIONES ANOTADAS</td>
  </tr>
  <tr>
    <td style="text-align:center">ORIGINAL: EMPRESA,  COPIA 1: CLIENTE, COPIA 2: TECNICO</td>
  </tr>
  <tr>
    <td style="text-align:center"><a href="http://www.corfibra.com/">www.corfibra.com</a></td>
  </tr>
</table>

<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
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
$nombre_archivo = 'PLAN_ACCION_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa.'.pdf';
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