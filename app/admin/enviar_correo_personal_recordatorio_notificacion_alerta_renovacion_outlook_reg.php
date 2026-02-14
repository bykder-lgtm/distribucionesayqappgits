<?php
include_once('../conexiones/conexione.php');
require '../PHPMailer/PHPMailerAutoload.php';
include_once '../admin/smtp_conf_correo.php';
date_default_timezone_set('America/Bogota');
include_once('../evitar_mensaje_error/error.php');
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($fecha_ymd_venta_producto_ini);

  $cod_curl                               = 1;
  $fecha_hoy                              = time();
  $fecha_time                             = time();
  $fecha_hoy_time                         = time();
  $fecha_ymd_his                          = date("Y-m-d H:i:s");
  $anyo_actual                            = date("Y");

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
  $correo_desarrollador_emp                   = $info_empresa_data['correo_desarrollador'];
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
  $dias_fecha_cumpleanos                      = $info_empresa_data['dias_fecha_cumpleanos'];
  $nombres_apellidos                          = 'admin';
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
  $pagina_local                               = $_SERVER['PHP_SELF'];
  $nombre_emisor                              = "Alertas y Notificaciones ".ucwords(strtolower($nombre_emp));
  $correo_emisor                              = $Username;
  $nombre_receptor                            = str_replace(" ", "_", $nombres_apellidos);
  $correo_receptor                            = $correo_emp;
  $cod_curl_strpad                            = str_pad($cod_curl, 6, "0", STR_PAD_LEFT);
  $correo_enviar                              = $correo_emp;
  $nombre_tipo_asunto                         = 'Renovaciones';
  $asunto_emisor_parte_superior               = $titulo_emp;
  $asunto_correo_enviar                       = "Alertas y Notificaciones - ".ucwords(strtolower($nombre_emp)).' - '.$nombre_tipo_asunto;
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
  $mensaje = "
  <!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
  <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head>
  <!--[if gte mso 9]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
  <![endif]-->
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='x-apple-disable-message-reformatting'>
    <!--[if !mso]><!--><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]-->
    <title></title>
    
  <style type='text/css'>
  table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; }
  @media only screen and (min-width: 620px) { .u-row { width: 600px !important; }
  .u-row .u-col { vertical-align: top; }
  .u-row .u-col-100 { width: 600px !important; }
  }
  @media (max-width: 620px) { .u-row-container { max-width: 100% !important; padding-left: 0px !important; padding-right: 0px !important; }
  .u-row .u-col { min-width: 320px !important; max-width: 100% !important; display: block !important; }
  .u-row { width: calc(100% - 40px) !important; }
  .u-col { width: 100% !important; }
  .u-col > div { margin: 0 auto; }
  }
  body { margin: 0; padding: 0; }
  table, tr, td { vertical-align: top; border-collapse: collapse; }
  p { margin: 0; }
  .ie-container table, .mso-container table { table-layout: fixed; }
  * { line-height: inherit; }
  a[x-apple-data-detectors='true'] { color: inherit !important; text-decoration: none !important; }
  @media (max-width: 480px) { .hide-mobile { display: none !important; max-height: 0px; overflow: hidden; }
  }
  </style>

  <!--[if !mso]><!--><link href='https://fonts.googleapis.com/css?family=Lato:400,700&display=swap' rel='stylesheet' type='text/css'><link href='https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap' rel='stylesheet' type='text/css'><!--<![endif]-->

  </head>
  ";
  $mensaje .= "<body class='clean-body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000'>";

  $mensaje .= "
    <!--[if IE]><div class='ie-container'><![endif]-->
    <!--[if mso]><div class='mso-container'><![endif]-->
    <table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%' cellpadding='1' cellspacing='1'>
    <tbody>
    <tr style='vertical-align: top'>
      <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
      <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td align='center' style='background-color: #ffffff;'><![endif]-->
      

  <div class='u-row-container' style='padding: 0px;background-color: transparent'>
    <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
      <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='1' cellspacing='1' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
        
  <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
  <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
    <div style='width: 100% !important;'>
    <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
    
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:8px;font-family:arial,helvetica,sans-serif;' align='left'>
          
    <table height='0px' align='center' border='0' cellpadding='1' cellspacing='1' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
      <tbody>
        <tr style='vertical-align: top'>
          <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
            <span>&#160;</span>
          </td>
        </tr>
      </tbody>
    </table>

        </td>
      </tr>
    </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'>
          
  <table width='100%' cellpadding='1' cellspacing='1' border='0'>
    <tr>
      <td style='padding-right: 0px;padding-left: 0px;' align='center'>
        
        <img align='center' border='0' src='../imagenes/cabecera_correo_hclinica.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 150px;' width='150'/>
        
      </td>
    </tr>
  </table>

        </td>
      </tr>
    </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:6px;font-family:arial,helvetica,sans-serif;' align='left'>
          
    <table height='0px' align='center' border='0' cellpadding='1' cellspacing='1' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
      <tbody>
        <tr style='vertical-align: top'>
          <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
            <span>&#160;</span>
          </td>
        </tr>
      </tbody>
    </table>

        </td>
      </tr>
    </tbody>
  </table>

    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
    </div>
  </div>
  <!--[if (mso)|(IE)]></td><![endif]-->
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>
  </div>



  <div class='u-row-container' style='padding: 0px;background-color: transparent'>
    <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
      <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='1' cellspacing='1' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
        
  <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
  <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
    <div style='width: 100% !important;'>
    <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
  ";

  $mensaje .= "
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='1'>
  <thead>
    <tr>
      <th style='text-align:center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_emp."</span></th>
    </tr>
  </thead>
  <tbody>
  </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='1'>
  <thead>
    <tr>
      <th style='text-align:center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_tipo_asunto."</span></th>
    </tr>
  </thead>
  <tbody>
  </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='1'>
  <thead>
    <tr>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>NOMBRE RENOVACION</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>DESCRIPCION RENOVACION</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>CLIENTE</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>COSTO RENOVACION</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>FECHA REGISTRO</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>FECHA COBRO</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>VENCE EN</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>TIPO COBRO</th>
      <th style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>ID</th>
    </tr>
  </thead>
  <tbody>
  ";
  $total_total_venta_producto                      = 0;
  $total_ganancia_venta_sum                        = 0;
  $fecha_alerta_vence_vigencia                     = "";
  $fecha_hoy                                       = date("Y-m-d");
  $fecha_vencimiento_ref                           = date('Y-m-d', strtotime($fecha_hoy.' +20 days'));

  $mostrar_datos_sql = "SELECT * FROM tbl15_notificacion_alerta_renovacion WHERE (fecha_cobro_notificacion_alerta_renovacion BETWEEN '$fecha_hoy' AND '$fecha_vencimiento_ref') AND (cod_estado = '1') ORDER BY fecha_cobro_notificacion_alerta_renovacion ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  $total_reg = mysqli_num_rows($consulta);
  while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_notificacion_alerta_renovacion              = $matriz_consulta['cod_notificacion_alerta_renovacion'];
    $nombre_notificacion_alerta_renovacion           = $matriz_consulta['nombre_notificacion_alerta_renovacion'];
    $descipcion_notificacion_alerta_renovacion       = $matriz_consulta['descipcion_notificacion_alerta_renovacion'];
    $cod_guia                                        = $matriz_consulta['cod_guia'];
    $cod_tercero                                     = $matriz_consulta['cod_tercero'];
    $cod_producto                                    = $matriz_consulta['cod_producto'];
    $cod_producto_barra                              = $matriz_consulta['cod_producto_barra'];
    $precio_venta_notificacion_alerta_renovacion     = $matriz_consulta['precio_venta_notificacion_alerta_renovacion'];
    $cod_venta_producto                              = $matriz_consulta['cod_venta_producto'];
    $cod_info_factura_venta                          = $matriz_consulta['cod_info_factura_venta'];
    $cod_factura                                     = $matriz_consulta['cod_factura'];
    $nombre_tipo_producto                            = $matriz_consulta['nombre_tipo_producto'];
    $nombre_tipo_cobro                               = $matriz_consulta['nombre_tipo_cobro'];
    $fecha_inicio_notificacion_alerta_renovacion     = $matriz_consulta['fecha_inicio_notificacion_alerta_renovacion'];
    $fecha_cobro_notificacion_alerta_renovacion      = $matriz_consulta['fecha_cobro_notificacion_alerta_renovacion'];
    $cod_estado                                      = $matriz_consulta['cod_estado'];
    $cod_estado_aviso                                = $matriz_consulta['cod_estado_aviso'];
    $fecha_creacion                                  = $matriz_consulta['fecha_creacion'];
    $fecha_modificacion                              = $matriz_consulta['fecha_modificacion'];

    $sql_tipo_notificacion_alerta_renovacion = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_tipo_notificacion_alerta_renovacion = mysqli_query($conectar, $sql_tipo_notificacion_alerta_renovacion);
    $datos_tipo_notificacion_alerta_renovacion = mysqli_fetch_assoc($consulta_tipo_notificacion_alerta_renovacion);

    $nombre1_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre1_tercero'];
    $nombre2_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre2_tercero'];
    $apellido1_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido1_tercero'];
    $apellido2_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido2_tercero'];

    $nombres_apellidos_tercero                       = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

    $sql_estado = "SELECT * FROM tbl15_estado WHERE (cod_estado = '$cod_estado')";
    $consulta_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($consulta_estado);

    $nombre_estado                                   = $datos_estado['nombre_estado'];

    $fecha_ini_seg                                   = strtotime($fecha_hoy);
    $fecha_fin_seg                                   = strtotime($fecha_cobro_notificacion_alerta_renovacion);
    $fecha_dif_seg                                   = floor($fecha_fin_seg - $fecha_ini_seg);
    $dias_vence_vigencia                             = ($fecha_dif_seg / (60 * 60 * 24));
      if ($dias_vence_vigencia < 0) { $titulo_alerta   = '(VENCIO HACE '.abs($dias_vence_vigencia).' DIAS)'; } elseif ($dias_vence_vigencia > 0) { $titulo_alerta  = '(FALTAN '.abs($dias_vence_vigencia).' DIAS)'; } else { $titulo_alerta  = '(ES HOY)'; }

  $mensaje .= "
    <tr>
      <td style='text-align:left; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$nombre_notificacion_alerta_renovacion."</td>
      <td style='text-align:left; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$descipcion_notificacion_alerta_renovacion."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$nombres_apellidos_tercero."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".number_format($precio_venta_notificacion_alerta_renovacion, 0, ",", ".")."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$fecha_inicio_notificacion_alerta_renovacion."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$fecha_cobro_notificacion_alerta_renovacion."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$titulo_alerta."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$nombre_tipo_cobro."</td>
      <td style='text-align:center; color: #ffffff; font-size: 12px; line-height: 16.8px;'>".$cod_notificacion_alerta_renovacion."</td>
    </tr>
  ";
  }
  $mensaje .= "
  </tbody>
  </table>


    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
    </div>
  </div>
  <!--[if (mso)|(IE)]></td><![endif]-->
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>
  </div>



  <div class='u-row-container' style='padding: 0px;background-color: transparent'>
    <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
      <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='1' cellspacing='1' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
        
  <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
  <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
    <div style='width: 100% !important;'>
    <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
    

  <!--
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:0px 20px 0px 0px;font-family:arial,helvetica,sans-serif;' align='left'>
          
  <table width='100%' cellpadding='1' cellspacing='1' border='0'>
    <tr>
      <td style='padding-right: 0px;padding-left: 0px;' align='center'>
        
        <img align='center' border='0' src='../imagenes/image-6.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 217px;' width='217'/>
        
      </td>
    </tr>
  </table>

        </td>
      </tr>
    </tbody>
  </table>
  -->

  <!--
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 40px 10px;font-family:arial,helvetica,sans-serif;' align='left'>
          
    <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;'>Hola, </span><span style='font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;'>Por medio de este correo enviamos un archivo adjunto en pdf de la historia clínica</span></p>
    </div>
        </td>
      </tr>
    </tbody>
  </table>


  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 30px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;'>As a sorry, we offer a <span style='color: #ef0d33; font-size: 16px; line-height: 22.4px;'><strong><span style='font-size: 18px; line-height: 25.2px;'><span style='line-height: 25.2px; font-size: 18px;'>15% off</span> </span></strong></span>all items in your cart this week!</span></p>
    </div>
        </td>
      </tr>
    </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div style='line-height: 140%; text-align: center; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 16px; line-height: 22.4px;'><strong><span style='font-family: Lato, sans-serif; line-height: 22.4px; font-size: 16px;'>U S E&nbsp; &nbsp; C O D E:&nbsp; &nbsp; </span><span style='font-family: Lato, sans-serif; line-height: 22.4px; font-size: 16px; color: #218838;'>HAPPY15%</span></strong></span></p>
    </div>
        </td>
      </tr>
    </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 50px;font-family:arial,helvetica,sans-serif;' align='left'>
  <div align='center'>
      <a href='' target='_blank' style='box-sizing: border-box;display: inline-block;font-family:arial,helvetica,sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #000000; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;'>
        <span style='display:block;padding:13px 28px;line-height:120%;'><span style='font-size: 16px; line-height: 19.2px; font-family: Lato, sans-serif;'>START&nbsp; &nbsp;SHOPPING</span></span>
      </a>
  </div>
        </td>
      </tr>
    </tbody>
  </table>
  -->
    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
    </div>
  </div>
  <!--[if (mso)|(IE)]></td><![endif]-->
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>
  </div>

  <div class='u-row-container' style='padding: 0px;background-color: transparent'>
    <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
      <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='1' cellspacing='1' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
        
  <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
  <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
    <div style='width: 100% !important;'>
    <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
    
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:arial,helvetica,sans-serif;' align='left'>
  <table width='100%' cellpadding='1' cellspacing='1' border='0'>
    <tr>
      <td style='padding-right: 0px;padding-left: 0px;' align='center'>
        <img align='center' border='0' src='../imagenes/image-4.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 552px;' width='552'/>
      </td>
    </tr>
  </table>

        </td>
      </tr>
    </tbody>
  </table>

    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
    </div>
  </div>
  <!--[if (mso)|(IE)]></td><![endif]-->
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>
  </div>

  <div class='u-row-container' style='padding: 0px;background-color: transparent'>
    <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
      <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='1' cellspacing='1' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
        
  <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
  <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
    <div style='width: 100% !important;'>
    <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
    
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:40px 10px 20px;font-family:arial,helvetica,sans-serif;' align='left'>
  <div align='center'>
    <div style='display: table; max-width:207px;'>
    <!--[if (mso)|(IE)]><table width='207' cellpadding='1' cellspacing='1' border='0'><tr><td style='border-collapse:collapse;' align='center'><table width='100%' cellpadding='1' cellspacing='1' border='0' style='border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:207px;'><tr><![endif]-->
    
      <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
      <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
        <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
          <a href='https://twitter.com/' title='Twitter' target='_blank'>
            <img src='../imagenes/image-2.png' alt='Twitter' title='Twitter' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
          </a>
        </td></tr>
      </tbody></table>
      <!--[if (mso)|(IE)]></td><![endif]-->
      
      <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
      <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
        <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
          <a href='https://linkedin.com/' title='LinkedIn' target='_blank'>
            <img src='../imagenes/image-3.png' alt='LinkedIn' title='LinkedIn' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
          </a>
        </td></tr>
      </tbody></table>
      <!--[if (mso)|(IE)]></td><![endif]-->
      
      
      <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 0px;' valign='top'><![endif]-->
      <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px'>
        <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
          <a href='https://github.com/' title='GitHub' target='_blank'>
            <img src='../imagenes/image-7.png' alt='GitHub' title='GitHub' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
          </a>
        </td></tr>
      </tbody>
      </table>
      <!--[if (mso)|(IE)]></td><![endif]-->
      
      
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>

        </td>
      </tr>
    </tbody>
  </table>

    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
    </div>
  </div>
  <!--[if (mso)|(IE)]></td><![endif]-->
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>
  </div>

  <div class='u-row-container' style='padding: 0px;background-color: transparent'>
    <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
      <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='1' cellspacing='1' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='1' cellspacing='1' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
        
  <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
  <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
    <div style='width: 100% !important;'>
    <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
  <!--
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 40px;font-family:arial,helvetica,sans-serif;' align='left'>
          
    <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ffffff; font-size: 14px; line-height: 19.6px; font-family: Lato, sans-serif;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse </span></p>
    </div>

        </td>
      </tr>
    </tbody>
  </table>
  -->
  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:20px 10px 2px;font-family:arial,helvetica,sans-serif;' align='left'>
          
    <table height='0px' align='center' border='0' cellpadding='1' cellspacing='1' width='90%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #6e7074;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
      <tbody>
        <tr style='vertical-align: top'>
          <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
            <span>&#160;</span>
          </td>
        </tr>
      </tbody>
    </table>

        </td>
      </tr>
    </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 5px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>&copy; Editaxe Pos &nbsp;| &nbsp;".$anyo_actual."</span></p>
    </div>
        </td>
      </tr>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 5px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'>
      <span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Soporte Y Mantenimiento: <a href='".$pag_desarrollador_emp."'>".$desarrollador_emp."</a></span>
      </p>
    </div>
        </td>
      </tr>
    </tbody>
  </table>

  <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='1' cellspacing='1' width='100%' border='0'>
    <tbody>
      <tr>
        <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 20px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
      <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #666666; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Ha recibido este correo electrónico como usuario registrado de ".$pag_desarrollador_emp."</span></p>
  <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #666666; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Usted puede <span style='text-decoration: underline; line-height: 16.8px; font-size: 12px;'>darse de baja </span>de estos correos electrónicos aquí.</span></p>
    </div>
        </td>
      </tr>
    </tbody>
  </table>

    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
    </div>
  </div>
  <!--[if (mso)|(IE)]></td><![endif]-->
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>
  </div>


      <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
      </td>
    </tr>
    </tbody>
    </table>
    <!--[if mso]></div><![endif]-->
    <!--[if IE]></div><![endif]-->
  ";
  $mensaje .= "</body>";
  $mensaje .= "</html>";

  if ($total_reg <> '0') {

    $cod_tipo_modulo_envio_correo         = "1";
    $nombre_tipo_modulo_envio_correo      = "NOTIFICACION RENOVACIONES - EDITAXE POS";
    $id_origen_correo                     = "";
    $nombre_tabla_origen_correo           = "tbl15_notificacion_alerta_renovacion";
    $nombre_campo_origen_correo           = "cod_notificacion_alerta_renovacion";
    $nombre_origen_correo                 = "Recordatorio personal alerta renovacion";
    $correo_emisor                        = $correo_emisor;
    $correo_receptor                      = $correo_receptor;
    $asunto_correo                        = $asunto_correo_enviar;
    $mensaje_correo                       = $mensaje;
    $fecha_envio_correo                   = date("Y-m-d");
    $hora_envio_correo                    = date("H:i:s");
    $fecha_ymd_his                        = date("Y-m-d H:i:s");
    $fecha_time                           = time();
    $url_origen_correo                    = $_SERVER['PHP_SELF'];

    $sql_envio_correo = "SELECT * FROM tbl15_envio_correo WHERE (cod_tipo_modulo_envio_correo = '$cod_tipo_modulo_envio_correo') AND (fecha_envio_correo = '$fecha_envio_correo') AND (cod_estado_envio_correo = '1')";
    $consultar_envio_correo = mysqli_query($conectar, $sql_envio_correo) or die(mysqli_error($conectar));
    $existe_reg_envio_correo_repetido = mysqli_num_rows($consultar_envio_correo);

    if ($existe_reg_envio_correo_repetido == '0') {
      $mail = new PHPMailer;
      $mail->SMTPDebug = 3;                  // Enable verbose debug output
      $mail->isSMTP();                       // Set mailer to use SMTP
      $mail->Host = $Host;                   // Specify main and backup SMTP servers
      $mail->SMTPAuth = $SMTPAuth;           // Enable SMTP authentication
      $mail->Username = $Username;           // SMTP username
      $mail->Password = $Password;           // SMTP password
      $mail->SMTPSecure = $SMTPSecure;       // Enable TLS encryption, `ssl` also accepted
      $mail->Port = $Port;                   // TCP port to connect to
      $mail->setFrom($correo_emisor, $asunto_emisor_parte_superior);
      $mail->addAddress($correo_receptor, $nombre_receptor);
      $mail->Subject = $asunto_correo_enviar;
      $mail->MsgHTML($mensaje);
      //$mail->AddAttachment($ruta_global_archivo, $nombre_documento);
      //$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

      if(!$mail->send()) { //INICIO SI EL CORREO NO SE ENVIA PORQUE HAY ERRORES
        $cod_estado_envio_correo            = 0;
        $nombre_estado_envio_correo         = "No Enviado";
        $descripcion_error_envio_correo     = $mail->ErrorInfo;
      } 
      else { // INICIO SI EN CORREO SE ENVIO CORRECTAMENTE
        $cod_estado_envio_correo            = 1;
        $nombre_estado_envio_correo         = "Enviado Correctamente";
        $descripcion_error_envio_correo     = "";
      } //FIN SI EN CORREO SE ENVIO CORRECTAMENTE
      $sql_envio_correo = "INSERT INTO tbl15_envio_correo (cod_tipo_modulo_envio_correo, nombre_tipo_modulo_envio_correo, id_origen_correo, nombre_tabla_origen_correo, nombre_campo_origen_correo, 
      nombre_origen_correo, correo_emisor, correo_receptor, cod_estado_envio_correo, nombre_estado_envio_correo, descripcion_error_envio_correo, fecha_envio_correo, hora_envio_correo, 
      url_origen_correo, fecha_ymd_his, fecha_time, asunto_correo) 
      VALUES ('$cod_tipo_modulo_envio_correo', '$nombre_tipo_modulo_envio_correo', '$id_origen_correo', '$nombre_tabla_origen_correo', '$nombre_campo_origen_correo', 
      '$nombre_origen_correo', '$correo_emisor', '$correo_receptor', '$cod_estado_envio_correo', '$nombre_estado_envio_correo', '$descripcion_error_envio_correo', '$fecha_envio_correo', '$hora_envio_correo', 
      '$url_origen_correo', '$fecha_ymd_his', '$fecha_time', '$asunto_correo')";
      $resultado_envio_correo = mysqli_query($conectar, $sql_envio_correo) or die(mysqli_error($conectar));
    }
  }
}
?>