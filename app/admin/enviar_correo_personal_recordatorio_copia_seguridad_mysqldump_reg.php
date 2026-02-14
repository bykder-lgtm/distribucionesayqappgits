<?php
include_once('../conexiones/conexione.php');
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
$nombre_archivo_txt                         = $base_datos.'.txt';
$nombre_archivo_zip                         = $base_datos.'_'.date("Y_m_d__H_i_s");
$ruta_archivo                               = '../Bases_cron/';
$ruta_nombre_archivo_txt                    = $ruta_archivo.$nombre_archivo_txt;
$ruta_nombre_archivo_zip                    = $ruta_archivo.$nombre_archivo_zip;

$command                                    = 'C:\xampp\mysql\bin\mysqldump --opt -u '.$conexion_usuario.' -p'.$conexion_contrasena.' '.$base_datos.' > '.$ruta_nombre_archivo_txt;
system($command, $output); //Ejecutamos el comando para respaldo

$zip_comprimido                             = new ZipArchive(); //Objeto de Libreria ZipArchive
//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
$salida_ruta_nombre_zip                     = $ruta_archivo.$nombre_archivo_zip.'.zip';

if($zip_comprimido->open($salida_ruta_nombre_zip, ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
	$zip_comprimido->addFile($ruta_nombre_archivo_txt); //Agregamos el archivo SQL a ZIP
	$zip_comprimido->close(); //Cerramos el ZIP
	unlink($ruta_nombre_archivo_txt); //Eliminamos el archivo temporal SQL
	//header ("Location: $salida_ruta_nombre_zip"); // Redireccionamos para descargar el Arcivo ZIP
	} else {
	//echo 'Error'; //Enviamos el mensaje de error
}

$pagina_local                               = $_SERVER['PHP_SELF'];
$nombre_emisor                              = "Alertas y Notificaciones ".ucwords(strtolower($nombre_emp));
$correo_emisor                              = $Username;
$nombre_receptor                            = str_replace(" ", "_", $nombres_apellidos);
$correo_receptor                            = $correo_desarrollador_emp;
$cod_curl_strpad                            = str_pad($cod_curl, 6, "0", STR_PAD_LEFT);
$correo_enviar                              = $correo_desarrollador_emp;
$nombre_tipo_asunto                         = 'Copia de Seguridad';
$nombre_documento                           = 'Copia de Seguridad';
$asunto_emisor_parte_superior               = $titulo_emp;
$asunto_correo_enviar                       = "".ucwords(strtolower($nombre_emp)).' - '.$nombre_tipo_asunto;
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

  $cod_tipo_modulo_envio_correo         = "7";
  $nombre_tipo_modulo_envio_correo      = "COPIA DE SEGURIDAD - EDITAXE POS";
  $id_origen_correo                     = "";
  $nombre_tabla_origen_correo           = "";
  $nombre_campo_origen_correo           = "";
  $nombre_origen_correo                 = "Recordatorio copia de seguridad";
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
  $mail->AddAttachment($salida_ruta_nombre_zip, $nombre_archivo_zip);

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
?>