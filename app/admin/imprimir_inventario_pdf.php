<?php ob_start();?>
<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');

$serguridad_pagina                           = 1; 
$fecha_ymd                                   = date("Y-m-d");
$fecha_hora                                  = date("H:i:s");

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                 = $info_empresa_data['titulo'];
$nombre_emp                                 = $info_empresa_data['nombre'];
$eslogan_emp                                = $info_empresa_data['eslogan'];
$direccion_emp                              = $info_empresa_data['direccion'];
$ciudad_emp                                 = $info_empresa_data['ciudad'];
$pais_emp                                   = $info_empresa_data['pais'];
$correo_emp                                 = $info_empresa_data['correo'];
$img_cabecera_emp                           = $info_empresa_data['img_cabecera'];
$telefono_emp                               = $info_empresa_data['telefono'];
$info_legal_emp                             = $info_empresa_data['info_legal'];
$logotipo_emp                               = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp          = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                        = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                            = $info_empresa_data['nit_empresa'];
$cabecera_emp                               = $info_empresa_data['cabecera'];
$icono_emp                                  = $info_empresa_data['icono'];
$desarrollador_emp                          = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                      = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                   = $info_empresa_data['anyo'];
$url_pag                                    = $info_empresa_data['url_pag'];
$nombre_font                                = $info_empresa_data['nombre_font'];
$res_emp                                    = $info_empresa_data['res'];
$res1_emp                                   = $info_empresa_data['res1'];
$res2_emp                                   = $info_empresa_data['res2'];
$departamento_emp                           = $info_empresa_data['departamento'];
$localidad_emp                              = $info_empresa_data['localidad'];
$reg_medico_emp                             = $info_empresa_data['reg_medico'];
$regimen_emp                                = $info_empresa_data['regimen'];
$version_emp                                = $info_empresa_data['version'];
$propietario_url_firma_emp                  = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                             = $info_empresa_data['fecha_time'];
$licencia_emp                               = $info_empresa_data['licencia'];
$tamano_font_emp                            = $info_empresa_data['tamano_font'];
$info_histclinic_emp                        = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                        = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                    = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                    = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                       = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                       = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                   = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                   = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                     = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                       = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual              = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                   = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                              = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                        = $info_empresa_data['nombre_tipo_empresa'];
$dias_vencimiento_producto_alerta           = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                     = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                            = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                            = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                        = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                         = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra            = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global     = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global             = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global              = $info_empresa_data['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global               = $info_empresa_data['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                  = $info_empresa_data['cod_estado_sticker_barras_global'];
$cod_estado_modulo_contabilidad_global             = $info_empresa_data['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global               = $info_empresa_data['cod_estado_modulo_cotizacion_global'];

$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$total_codigos                                = $datos_conteo_atendido_mujer['total_codigos'];
$total_compra_producto                        = $datos_conteo_atendido_mujer['total_compra_producto'];
$total_venta_producto                         = $datos_conteo_atendido_mujer['total_venta_producto'];
$total_compra_producto_bodega                 = $datos_conteo_atendido_mujer['total_compra_producto_bodega'];
$total_venta_producto_bodega                  = $datos_conteo_atendido_mujer['total_venta_producto_bodega'];

$total_compra_producto_mostrador_bodega       = $total_compra_producto + $total_compra_producto_bodega;
$total_venta_producto_mostrador_bodega        = $total_venta_producto + $total_venta_producto_bodega;

include_once('mpdf/mpdf.php');
$margen_izq = '10';
$margen_der = '10';
$margen_inf_encabezado = '10';
$margen_sup_encabezado = '10';
$posicion_sup_encabezado = '5';
$posicion_inf_encabezado = '2';

$titulo_doc_pdf                    = 'INVENTARIO_'.$nombre_emp;
$autor_doc_pdf                     = 'INVENTARIO_'.$nombre_emp;
$creador_doc_pdf                   = 'INVENTARIO_'.$nombre_emp;
$tema_doc_pdf                      = 'INVENTARIO_'.$nombre_emp;
$palabras_claves_doc_pdf           = 'INVENTARIO_'.$nombre_emp;
$aaaaaa   = "FACTURA";
$nombres_completos                 = "FACTURA";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%">
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
-->
';
$headerE = '
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%">
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
-->
';
$footer = '
<!--
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
-->
';
$footerE = '
<!--
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
-->
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

$codigoHTML.='
        <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center" valign="top">INVENTARIO</th>
            <th style="text-align:center" valign="top">FECHA</th>
            <th style="text-align:center" valign="top">HORA</th>
            <th style="text-align:center">TOTAL CODIGOS</th>
            <th style="text-align:center">TOTAL INV PRECIO COMPRA</th>
            <th style="text-align:center">TOTAL INV PRECIO VENTA</th>
          </tr>
          <tr>
            <td style="text-align:center">'.$nombre_emp.'</td>
            <td style="text-align:center">'.$fecha_ymd.'</td>
            <td style="text-align:center">'.$fecha_hora.'</td>
            <td style="text-align:center">'.number_format($total_codigos, 0, ",", ".").'</td>
            <td style="text-align:center">'.number_format($total_compra_producto, 0, ",", ".").'</td>
            <td style="text-align:center">'.number_format($total_venta_producto, 0, ",", ".").'</td>
          </tr>
        </table>';



$codigoHTML.='
        <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:8pt; width:100%">
          <tr>
            <td style="text-align:center" width="50" valign="top"><strong>CODIGO</strong></td>
            <td style="text-align:center" width="250" valign="top"><strong>NOMBRE PRODUCTO</strong></td>
            <td style="text-align:center" width="50" valign="top"><strong>UND</strong></td>
            <td style="text-align:center" width="50" valign="top"><strong>MEDIDA</strong></td>
            ';
            if ($cod_estado_inventario_bodega_global == '1') { $codigoHTML.=' <td style="text-align:center" width="50" valign="top"><strong>UND BODEGA</strong></td>'; }
$codigoHTML.='
            <td style="text-align:center" width="50" valign="top"><strong>PRECIO COMPRA</strong></td>
            <td style="text-align:center" width="50" valign="top"><strong>PRECIO VENTA</strong></td>
            <td style="text-align:center" width="30" valign="top"><strong>..</strong></td>
            <td style="text-align:center" width="30" valign="top"><strong>..</strong></td>
           </tr>';
$sql_cliente = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, und_producto_bodega, precio_compra_producto, precio_venta_producto, cod_dependencia, iva_ptj, cod_tercero, nombre_tipo_medida
FROM tbl15_producto ORDER BY nombre_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
      
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_producto                  = $info_cliente['und_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$cod_tercero                   = $info_cliente['cod_tercero'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$und_producto_bodega           = $info_cliente['und_producto_bodega'];
$nombre_tipo_medida            = $info_cliente['nombre_tipo_medida'];

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

$codigoHTML.='
          <tr>
            <td style="text-align:center">'.$cod_producto_barra.'</td>
            <td style="text-align:left">'.$nombre_producto.'</td>
            <td style="text-align:center">'.$und_producto.'</td>
            <td style="text-align:center">'.$nombre_tipo_medida.'</td>
            ';
            if ($cod_estado_inventario_bodega_global == '1') { $codigoHTML.='<td style="text-align:center">'.$und_producto_bodega.'</td>'; }
$codigoHTML.='
            <td style="text-align:right">'.number_format($precio_compra_producto, 0, ",", ".").'</td>
            <td style="text-align:right">'.number_format($precio_venta_producto, 0, ",", ".").'</td>
            <td style="text-align:left"></td>
            <td style="text-align:left"></td>
          </tr>';
}
$codigoHTML.='
        </table>
        ';

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
$nombre_archivo = 'INVENTARIO_'.$nombre_emp.'.pdf';
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