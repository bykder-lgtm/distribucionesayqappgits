<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if ($_GET['cod_movimiento_contable'] <> NULL) {
  $cod_movimiento_contable            = intval($_GET['cod_movimiento_contable']);

  $obtener_info_ingre_operacional = "SELECT * FROM tbl15_movimiento_contable WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
  $resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
  $total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
  $info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional);

  $cod_factura                        = $info_ingre_operacional['cod_factura'];
  $doc_modifica                       = $info_ingre_operacional['doc_modifica'];
  $nombre_tipo_documento_db           = $info_ingre_operacional['nombre_tipo_documento'];
  $descripcion_movimiento             = $info_ingre_operacional['descripcion_movimiento'];
  $total_costo_movimiento_contable_mov= $info_ingre_operacional['total_costo_movimiento_contable'];
  $total_venta_movimiento_contable    = $info_ingre_operacional['total_venta_movimiento_contable'];
  $cod_clientes                       = $info_ingre_operacional['cod_clientes'];
  //$nombres_clientes                   = $info_ingre_operacional['nombres_clientes'];
  $nit_cliente                        = $info_ingre_operacional['nit_cliente'];
  $digito                             = $info_ingre_operacional['digito'];
  $estado_devol                       = $info_ingre_operacional['estado_devol'];
  $motivo_devol                       = $info_ingre_operacional['motivo_devol'];
  $direccion                          = $info_ingre_operacional['direccion'];
  $no_cuenta                          = $info_ingre_operacional['no_cuenta'];
  $elaborada                          = $info_ingre_operacional['elaborada'];
  $revisada                           = $info_ingre_operacional['revisada'];
  $autorizada                         = $info_ingre_operacional['autorizada'];
  $contabilizada                      = $info_ingre_operacional['contabilizada'];
  $motivo_modificacion                = $info_ingre_operacional['motivo_modificacion'];
  $fecha_anyo                         = $info_ingre_operacional['fecha_anyo'];
  $fecha_ymd                          = $info_ingre_operacional['fecha_ymd'];
  $fecha_mes                          = $info_ingre_operacional['fecha_mes'];
  $anyo                               = $info_ingre_operacional['anyo'];
  $fecha_seg                          = $info_ingre_operacional['fecha_seg'];
  $fecha_factura                      = $info_ingre_operacional['fecha_factura'];
  $cuenta                             = $info_ingre_operacional['cuenta'];
  $cod_caja_virtual                   = $info_ingre_operacional['cod_caja_virtual'];
  $observacion                        = $info_ingre_operacional['observacion'];
  $cod_tipo_pago                      = $info_ingre_operacional['cod_tipo_pago'];
  $cod_tipo_forma_pago                = $info_ingre_operacional['cod_tipo_forma_pago'];
  //$nombre_tipo_forma_pago             = $info_ingre_operacional['nombre_tipo_forma_pago'];
  $descripcion_tipo_forma_pago        = $info_ingre_operacional['descripcion_tipo_forma_pago'];
  $cod_guia                           = $info_ingre_operacional['cod_guia'];
  $cod_tercero                        = $info_ingre_operacional['cod_tercero'];

  $dia                                = date("d", $fecha_seg);
  $mes                                = date("m", $fecha_seg);
  $anyo                               = date("Y", $fecha_seg);
  $firma                              = "MARIA LORENA VALENCIA";

  $total_costo_movimiento_contable_debito  = 0;
  $total_costo_movimiento_contable_credito  = 0;

  $total_datos_debitos                = 0;
  $total_datos_creditos               = 0;

  $obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
  $info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

  $nit_cliente                        = $info_cliente['identificacion_tercero'];
  $nombres_clientes                   = $info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].' '.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero'];
  $digito                             = $info_cliente['digito_tercero'];

  $sql_guia_movimiento = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
  $consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
  $info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

  $nombre_tipo_forma_pago             = $info_guia_movimiento['nombre_tipo_forma_pago'];

  $sql_mov_contable_debito = "SELECT * FROM tbl15_movimiento_contable_concepto 
  WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'DEBITOS')";
  $consulta_mov_contable_debito = mysqli_query($conectar, $sql_mov_contable_debito) or die(mysqli_error($conectar));
  $total_datos_debitos = mysqli_num_rows($consulta_mov_contable_debito);

  $sql_mov_contable_credito = "SELECT * FROM tbl15_movimiento_contable_concepto 
  WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'CREDITOS')";
  $consulta_mov_contable_credito = mysqli_query($conectar, $sql_mov_contable_credito) or die(mysqli_error($conectar));
  $total_datos_creditos = mysqli_num_rows($consulta_mov_contable_credito);

  if ($total_datos_debitos > $total_datos_creditos) {
    $repetir_movimiento_debitos = 0;
    $repetir_movimiento_creditos = $total_datos_debitos - $total_datos_creditos;
  } elseif ($total_datos_debitos < $total_datos_creditos) {
    $repetir_movimiento_debitos = $total_datos_creditos - $total_datos_debitos;
    $repetir_movimiento_creditos = 0;
  } else {
    $repetir_movimiento_debitos = 0;
    $repetir_movimiento_creditos = 0;
  }
  if ($nombre_tipo_documento_db == 'RECIBO DE CAJA') {
    $titulo_documento = 'DEBE';
  } elseif ($nombre_tipo_documento_db == 'COMPROBANTE DE EGRESO') {
    $titulo_documento = 'PAGADO A';
  } else {
    $titulo_documento = 'CLIENTE';
  }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                            = $info_empresa_data['titulo'];
$nombre_emp                            = $info_empresa_data['nombre'];
$eslogan_emp                           = $info_empresa_data['eslogan'];
$direccion_emp                         = $info_empresa_data['direccion'];
$ciudad_emp                            = $info_empresa_data['ciudad'];
$pais_emp                              = $info_empresa_data['pais'];
$correo_emp                            = $info_empresa_data['correo'];
$img_cabecera_emp                      = $info_empresa_data['img_cabecera'];
$telefono_emp                          = $info_empresa_data['telefono'];
$info_legal_emp                        = $info_empresa_data['info_legal'];
$logotipo_emp                          = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp     = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                   = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                       = $info_empresa_data['nit_empresa'];
$cabecera_emp                          = $info_empresa_data['cabecera'];
$icono_emp                             = $info_empresa_data['icono'];
$desarrollador_emp                     = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                 = $info_empresa_data['pag_desarrollador'];
$anyo_emp                              = $info_empresa_data['anyo'];
$url_pag                               = $info_empresa_data['url_pag'];
$nombre_font                           = $info_empresa_data['nombre_font'];
$res_emp                               = $info_empresa_data['res'];
$res1_emp                              = $info_empresa_data['res1'];
$res2_emp                              = $info_empresa_data['res2'];
$departamento_emp                      = $info_empresa_data['departamento'];
$localidad_emp                         = $info_empresa_data['localidad'];
$reg_medico_emp                        = $info_empresa_data['reg_medico'];
$regimen_emp                           = $info_empresa_data['regimen'];
$version_emp                           = $info_empresa_data['version'];
$propietario_url_firma_emp             = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                        = $info_empresa_data['fecha_time'];
$licencia_emp                          = $info_empresa_data['licencia'];
$tamano_font_emp                       = $info_empresa_data['tamano_font'];
$info_histclinic_emp                   = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                   = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp               = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp               = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                  = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                  = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp              = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp              = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                  = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual         = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta              = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                         = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                   = $info_empresa_data['nombre_tipo_empresa'];
$url_pag_emp                           = $info_empresa_data['url_pag'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                         = '10';
$margen_der                         = '10';
$margen_inf_encabezado              = '15';
$margen_sup_encabezado              = '5';
$posicion_sup_encabezado            = '1';
$posicion_inf_encabezado            = '20';

$titulo_doc_pdf                     = $nombre_tipo_documento_db.' '.$cod_movimiento_contable;
$autor_doc_pdf                      = $nombre_tipo_documento_db.' '.$cod_movimiento_contable;
$creador_doc_pdf                    = $nombre_tipo_documento_db.' '.$cod_movimiento_contable;
$tema_doc_pdf                       = $nombre_tipo_documento_db.' '.$cod_movimiento_contable;
$palabras_claves_doc_pdf            = $nombre_tipo_documento_db.' '.$cod_movimiento_contable;

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '
<!--
<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_certificado_manipulacion_alimento_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[FECHA - HORA: '.$fecha_ymd_hora.' - '.$fecha_hora.']  [CMA: '.$cod_manipulacion_alimento.']  [HC: '.$cod_historia_clinica.']</strong></td>
    </tr>
  </tbody>
</table>
-->
';
$headerE = '
<!--
<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_certificado_manipulacion_alimento_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[FECHA - HORA: '.$fecha_ymd_hora.' - '.$fecha_hora.']  [CMA: '.$cod_manipulacion_alimento.']  [HC: '.$cod_historia_clinica.']</strong></td>
    </tr>
  </tbody>
</table>
-->
';
$footer = '
<!--
<table align="center" border="0" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
-->
';
$footerE = '
<!--
<table align="center" border="0" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
-->
';
$mpdf->SetHTMLHeader(($header));
$mpdf->SetHTMLHeader(($headerE),'E');
$mpdf->SetHTMLFooter(($footer));
$mpdf->SetHTMLFooter(($footerE),'E');

$codigoHTML='
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head></head>
<body>

<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:12pt; width:100%">
  <tr>
    <td style="text-align:center">
    '.$nombre_emp.'
    <br>
    NIT: '.$nit_empresa_emp.'
    <br>
    DIRECCION: '.$direccion_emp.'
    <br>
    TELEFONO: '.$telefono_emp.'
    <br>
    EMAIL: '.$correo_emp.'
    <br>
    '.$url_pag_emp.'
    </td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
  <tr>
    <td style="text-align:center">'.$nombre_tipo_documento_db.' NO: '.$cod_guia.'</td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
  <tr>
    <td colspan="3">FECHA EMISION: '.date("d-m-Y", strtotime($fecha_ymd)).'</td>
    <td style="text-align:left; width:150px">OBSERVACION:</td>
    <td >'.$doc_modifica.'</td>
  </tr>
  <tr>
    <td colspan="3">'.$titulo_documento.': '.$nombres_clientes.' - '.$nit_cliente.'</td>
    <td>FACTURA #:</td>
    <td>'.$cod_factura.'</td>
  </tr>
  <tr>
<!--
    <td style="text-align:center"></td>
    <td style="text-align:left"></td>
    <td>FECHA:</td>
    <td>'.$fecha_factura.'</td>
-->
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
  <tr>
    <td style="text-align:left">DESCRIPCION DEL MOVIMIENTO: '.$descripcion_movimiento.'</td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
  <tr>
    <td style="text-align:left">FORMA DE PAGO: '.$nombre_tipo_forma_pago.' | '.$descripcion_tipo_forma_pago.'</td>
  </tr>
</table>
';
$codigoHTML.='
<br>
<div>
    <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%"><tr><td style="text-align:center">CUENTA</td></tr></table>

      <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
        <tr> 
          <td style="text-align:center">Codigo</td>
          <td style="text-align:center">Nombre</td>
          <td style="text-align:center">Valor</td>
        </tr>
';
$incre = 0;
$obtener_info_movimiento_contable_concepto = "SELECT * FROM tbl15_movimiento_contable_concepto 
WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'DEBITOS')";
$resultado_info_movimiento_contable_concepto = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto) or die(mysqli_error($conectar));
while ($info_movimiento_contable_concepto = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto)) {

$cod_movimiento_contable_concepto               = $info_movimiento_contable_concepto['cod_movimiento_contable_concepto'];
$nombre_tipo_movimiento                         = $info_movimiento_contable_concepto['nombre_tipo_movimiento'];
$nombre_tipo_documento                          = $info_movimiento_contable_concepto['nombre_tipo_documento'];
$codigo_puc                                     = $info_movimiento_contable_concepto['codigo_puc'];
$nombre_puc                                     = $info_movimiento_contable_concepto['nombre_puc'];
$tipo_puc                                       = $info_movimiento_contable_concepto['tipo_puc'];
$und_vendida                                    = $info_movimiento_contable_concepto['und_vendida'];
$costo_movimiento_contable                      = $info_movimiento_contable_concepto['costo_movimiento_contable'];
$venta_movimiento_contable                      = $info_movimiento_contable_concepto['venta_movimiento_contable'];
$total_costo_movimiento_contable                = $info_movimiento_contable_concepto['total_costo_movimiento_contable'];
$total_venta_movimiento_contable                = $info_movimiento_contable_concepto['total_venta_movimiento_contable'];
$total_costo_movimiento_contable_debito        += $total_costo_movimiento_contable;
$incre++;
$codigoHTML.='
  <tr>
    <td style="text-align:left">'.$codigo_puc.'</td>
    <td style="text-align:left">'.$nombre_puc.'</td>
    <td style="text-align:right">'.number_format($costo_movimiento_contable, 0, ",", ".").'</td>
  </tr>
';
}
$codigoHTML.='
        </table>
';
$codigoHTML.='

<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="45" valign="top">SON:</td>
    <td width="650" valign="top">'.convertir_numeros_a_letras($total_costo_movimiento_contable_mov).'</td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
  <tr height="20">
    <td style="text-align:left; font-size:7pt; width:10px" rowspan="3">MOTIVOS DE MODIFICACION:</td>
    <td style="text-align:left; font-size:8pt; width:323px" rowspan="3">'.utf8_encode($motivo_modificacion).'</td>
    <td style="text-align:left; width:100px">SUB TOTAL</td>
    <td style="text-align:right">$'.number_format($total_costo_movimiento_contable_mov, 0, ",", ".").'</td>
  </tr>
  <tr>
    <td style="text-align:left">IVA 0%</td>
    <td style="text-align:right">0</td>
  </tr>
  <tr>
    <td style="text-align:left">TOTAL</td>
    <td style="text-align:right">$'.number_format($total_costo_movimiento_contable_mov, 0, ",", ".").'</td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
';
if ($nombre_tipo_documento_db == 'RECIBO DE CAJA') {
$codigoHTML.='
    <td width="387" valign="top"><strong>FIRMA,</strong>
    <div style="text-align:center"><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$propietario_nombres_apellidos_emp.'</strong>
    <br />
    <strong>C.C  '.$propietario_nit_emp.'</strong>
    <br />
    </td>
';
}
elseif ($nombre_tipo_documento_db == 'COMPROBANTE DE EGRESO') { 
$codigoHTML.='
    <td width="387" valign="top"><strong>FIRMA DE BENEFICIARIO,</strong>
    <div style="text-align:center"><img src="../imagenes/firma_vacia.jpg" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_clientes.'</strong><br />
    <strong>C.C '.$nit_cliente.'</strong>
    </td>
';
} else { 
$codigoHTML.='
    <td width="387" valign="top"><strong>APROBADO POR,</strong>
    <div style="text-align:center"><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$propietario_nombres_apellidos_emp.'</strong>
    <br />
    <strong>C.C  '.$propietario_nit_emp.'</strong>
    <br />
    </td>
    <td width="387" valign="top"><strong>.</strong>
    <div style="text-align:center"><img src="../imagenes/firma_vacia.jpg" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_clientes.'</strong><br />
    <strong>C.C '.$nit_cliente.'</strong> </td>
';
}
$codigoHTML.='
  </tr>
</table>
</body>
</html>';


$codigoHTML = mb_convert_encoding($codigoHTML, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML(($codigoHTML));
$mpdf->SetTitle($titulo_doc_pdf);
$mpdf->SetAuthor($autor_doc_pdf);
$mpdf->SetCreator($autor_doc_pdf);
$mpdf->SetSubject($tema_doc_pdf);
$mpdf->SetKeywords($palabras_claves_doc_pdf);
$ruta = '../pdfs/';
$nombre_archivo = $nombre_tipo_documento_db.' '.$anyo;
$mpdf->Output($nombre_archivo, 'I');
exit;

}
?>