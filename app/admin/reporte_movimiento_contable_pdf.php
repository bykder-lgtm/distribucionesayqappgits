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

if ($_GET['nombre_tipo_documento'] <> NULL) {
  $cod_tercero                        = intval($_GET['cod_tercero']);
  $nombre_tipo_documento              = addslashes($_GET['nombre_tipo_documento']);
  $fecha_ymd_venta_producto_ini       = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin       = addslashes($_GET['fecha_ymd_venta_producto_fin']);

  if ($cod_tercero==0) {
      $filtro_consulta_tercero = "";
      $filtro_consulta_tercero_rel = "";
      $nombre_tercero_get                                  = 'TODOS';
  } else {
      $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
      $filtro_consulta_tercero_rel = "AND (cod_tercero = '$cod_tercero')";

      $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
      $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
      $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

      $nombre_tercero_get                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'];
  }

  if ($nombre_tipo_documento=='0') {
      $filtro_consulta_tipo_documento = "";
      $filtro_consulta_tipo_documento_rel = "";
      $nombre_tipo_documento_get = 'TODOS';
  } else {
      $filtro_consulta_tipo_documento = "AND (nombre_tipo_documento = '$nombre_tipo_documento')";
      $filtro_consulta_tipo_documento_rel = "AND (nombre_tipo_documento = '$nombre_tipo_documento')";
      $nombre_tipo_documento_get = $nombre_tipo_documento;
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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
  include_once('mpdf/mpdf.php');
  $margen_izq                         = '5';
  $margen_der                         = '5';
  $margen_inf_encabezado              = '5';
  $margen_sup_encabezado              = '5';
  $posicion_sup_encabezado            = '5';
  $posicion_inf_encabezado            = '5';

  $titulo_doc_pdf                     = 'REPORTE MOVIMIENTO CONTABLE'.' - '.$nombre_tipo_documento_get.' - '.$nombre_tercero_get;
  $autor_doc_pdf                      = 'REPORTE MOVIMIENTO CONTABLE'.' - '.$nombre_tipo_documento_get.' - '.$nombre_tercero_get;
  $creador_doc_pdf                    = 'REPORTE MOVIMIENTO CONTABLE'.' - '.$nombre_tipo_documento_get.' - '.$nombre_tercero_get;
  $tema_doc_pdf                       = 'REPORTE MOVIMIENTO CONTABLE'.' - '.$nombre_tipo_documento_get.' - '.$nombre_tercero_get;
  $palabras_claves_doc_pdf            = 'REPORTE MOVIMIENTO CONTABLE'.' - '.$nombre_tipo_documento_get.' - '.$nombre_tercero_get;

  //$mpdf = new mPDF('c','Legal');
  $mpdf = new mPDF('en-GB-x','Letter','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
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
      </td>
    </tr>
  </table>
  ';
  $codigoHTML.='
  <br>
  <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
      <tr>
          <th style="text-align:center;">REPORTE MOVIMIENTOS CONTABLES</th>
      </tr>
  </table>

<br>

  <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
      <tr>
          <th style="text-align:center;">TERCERO: '.$nombre_tercero_get.'</th>
          <th style="text-align:center;">TIPO MOVIMIENTO: '.$nombre_tipo_documento_get.'</th>
          <th style="text-align:center;">FECHA INICAL: '.$fecha_ymd_venta_producto_ini.'</th>
          <th style="text-align:center;">FECHA FINAL: '.$fecha_ymd_venta_producto_fin.'</th>
      </tr>
  </table>

<br>

  <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
      <tr>
          <th style="text-align:center;">RESUMEN</th>
      </tr>
  </table>
  <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
      <thead>
          <tr>
              <th style="text-align:center;">Tipo Movimiento Contable</th>
              <th style="text-align:center;">Total Movimiento</th>
          </tr>
      </thead>
  <tbody>
  ';

  $sql_cliente = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable, nombre_tipo_documento 
  FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_tercero $filtro_consulta_tipo_documento
  AND (nombre_estado_factura = 'CERRADA') GROUP BY nombre_tipo_documento DESC";
  $resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
  while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $nombre_tipo_documento                   = $info_cliente['nombre_tipo_documento'];
  $total_costo_movimiento_contable         = $info_cliente['total_costo_movimiento_contable'];
  $total_costo_movimiento_contable_sum     += $total_costo_movimiento_contable;

  $codigoHTML.='
    <tr>
        <td style="text-align:left">'.$nombre_tipo_documento.'</td>
        <td style="text-align:right">'.number_format($total_costo_movimiento_contable, 0, ",", ".").'</td>
    </tr>
  ';
  }
    $codigoHTML.='
<!--
    <tr>
        <td style="text-align:left">TOTAL</td>
        <td style="text-align:right">'.number_format($total_costo_movimiento_contable_sum, 0, ",", ".").'</td>
    </tr>
-->
  </tbody>
  </table>

<br>
  <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
      <tr>
          <th style="text-align:center;">DETALLADO</th>
      </tr>
  </table>
  <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
      <thead>
          <tr>
              <th style="text-align:center;">Guia</th>
              <th style="text-align:center;">Tipo Movimiento Contable</th>
              <th style="text-align:center;">Tercero</th>
              <th style="text-align:center;">Descripcion</th>
              <th style="text-align:center;">Total Movimiento</th>
              <th style="text-align:center;">Forma pago</th>
              <th style="text-align:center;">Fecha</th>
          </tr>
      </thead>
  <tbody>
  ';
  $total_movimiento_contable                      = 0;

  $sql_mov_detalle = "SELECT * FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_tercero $filtro_consulta_tipo_documento
  AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_movimiento_contable DESC";
  $resultado_mov_detalle = mysqli_query($conectar, $sql_mov_detalle) or die(mysqli_error($conectar));
  while ($info_mov_detalle = mysqli_fetch_assoc($resultado_mov_detalle)) {

  $cod_movimiento_contable                 = $info_mov_detalle['cod_movimiento_contable'];
  $nombre_estado_factura                   = $info_mov_detalle['nombre_estado_factura'];
  $cod_factura                             = $info_mov_detalle['cod_factura'];
  $doc_modifica                            = $info_mov_detalle['doc_modifica'];
  $nombre_tipo_documento                   = $info_mov_detalle['nombre_tipo_documento'];
  $descripcion_movimiento                  = $info_mov_detalle['descripcion_movimiento'];
  $total_costo_movimiento_contable         = $info_mov_detalle['total_costo_movimiento_contable'];
  $cod_tercero                             = $info_mov_detalle['cod_tercero'];
  $fecha_ymd                               = $info_mov_detalle['fecha_ymd'];
  $cod_guia                                = $info_mov_detalle['cod_guia'];
  $cod_tipo_forma_pago                     = $info_mov_detalle['cod_tipo_forma_pago'];
  $descripcion_tipo_forma_pago             = $info_mov_detalle['descripcion_tipo_forma_pago'];
  $total_movimiento_contable              += $total_costo_movimiento_contable;

  $sql_tipo_pago = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
  $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

  $identificacion_tercero       = $datos_tipo_pago['identificacion_tercero'];
  $nombre1_tercero              = $datos_tipo_pago['nombre1_tercero'];
  $nombre2_tercero              = $datos_tipo_pago['nombre2_tercero'];
  $apellido1_tercero            = $datos_tipo_pago['apellido1_tercero'];
  $apellido2_tercero            = $datos_tipo_pago['apellido2_tercero'];
  $nombre_tercero               = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

  $sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
  $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
  $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

  $nombre_tipo_forma_pago                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
  $codigoHTML.='
    <tr>
        <td style="text-align:center">'.$cod_guia.'</td>
        <td style="text-align:left">'.$nombre_tipo_documento.'</td>
        <td style="text-align:left">'.$nombre_tercero.'</td>
        <td style="text-align:left">'.$descripcion_movimiento.'</td>
        <td style="text-align:right">'.number_format($total_costo_movimiento_contable, 0, ",", ".").'</td>
        <td style="text-align:center">'.$nombre_tipo_forma_pago.'</td>
        <td style="text-align:center">'.$fecha_ymd.'</td>
    </tr>
  ';
  }
  $codigoHTML.='
    <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <th style="text-align:right;">TOTAL</th>
        <th style="text-align:right;">'.number_format($total_movimiento_contable, 0, ",", ".").'</th>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
    </tr>
  </tbody>
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
  $nombre_archivo = ''.$titulo_doc_pdf;
  $mpdf->Output($nombre_archivo, 'I');
  exit;
}
?>