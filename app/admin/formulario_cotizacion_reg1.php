<?php 
$nombre_pagina          = "Cotizacion";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$pagina                 = '../admin/ver_producto.php'
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_inicio_sesion.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php include_once("../admin/01_info_empresa.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>
<?php include_once("../admin/01_rastreador_geolocalizacion_gps_javacript.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<?php include_once("../pixel_facebook_js/pixel_facebook.php"); ?>

<?php include_once("../admin/02_modulo_meta.php"); ?>
    
<?php include_once("../admin/03_modulo_css.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php include_once("04_modulo_main_top.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
if (isset($_POST['nombre_origen_formulario'])) {
  require '../PHPMailer/PHPMailerAutoload.php';
  include_once '../admin/class_php/smtp.conf.outlook.php';

  if (isset($_POST['cod_producto_codifcryp']) <> '') { 
    $cod_producto_codifcryp            = ($_POST['cod_producto_codifcryp']);
    $cod_producto_codif                = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));
  } else { 
    $cod_producto = ''; 
  }

  if (isset($_POST['nombre']) <> '') { $nombre = mysqli_real_escape_string($conectar,(($_POST['nombre']))); } else { $nombre = ''; }
  if (isset($_POST['nombre_origen_formulario']) <> '') { $nombre_origen_formulario = mysqli_real_escape_string($conectar,(($_POST['nombre_origen_formulario']))); } else { $nombre_origen_formulario = ''; }
  if (isset($_POST['correo']) <> '') { $correo = mysqli_real_escape_string($conectar,(($_POST['correo']))); } else { $correo = ''; }
  if (isset($_POST['telefono']) <> '') { $telefono = mysqli_real_escape_string($conectar,(($_POST['telefono']))); } else { $telefono = ''; }
  if (isset($_POST['telefono_whatsapp']) <> '') { $telefono_whatsapp = mysqli_real_escape_string($conectar,(($_POST['telefono_whatsapp']))); } else { $telefono_whatsapp = ''; }
  if (isset($_POST['comentario']) <> '') { $comentario = mysqli_real_escape_string($conectar,(($_POST['comentario']))); } else { $comentario = ''; }
  if (isset($_POST['asunto']) <> '') { $asunto = mysqli_real_escape_string($conectar,(($_POST['asunto']))); } else { $asunto = ''; }

  if ($nombre_origen_formulario == 'FORMULARIO_COTIZACION_PRODUCTO') { $nombre_asunto_pagina = 'Cotizacion Por Pagina Web'; } elseif ($nombre_origen_formulario == 'FORMULARIO_CONTACTO') { $nombre_asunto_pagina = 'Contacto Por Pagina Web'; } else { $nombre_asunto_pagina = ''; }

  $obtener_cedula = "SELECT cod_producto_bar, nombre_producto FROM tbl01_producto WHERE cod_producto = '".($cod_producto)."'";
  $consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
  $info_cliente = mysqli_fetch_assoc($consultar_cedula);

  $cod_producto_bar                = $info_cliente['cod_producto_bar'];
  $nombre_producto                 = utf8_decode($info_cliente['nombre_producto']);

  $nombre_estado      = "PENDIENTE";
  $ip                 = "";
  $nombre_pais        = "";
  $region             = "";
  $ciudad             = "";
  $longitud           = "";
  $latitud            = "";
  $fecha_ymd_his      = date("Y-m-d H:i:s");
  $fecha_hora         = date("H:i:"."00");
  $fecha_ymd          = date("Y-m-d");
  $fecha_mes          = date("Y-m");
  $fecha_anyo         = date("Y");
  $fecha_time         = time();

  $sql_autoincremento_cotizar_producton = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl01_cotizar_producto'";
  $exec_autoincremento_cotizar_producto = mysqli_query($conectar, $sql_autoincremento_cotizar_producton) or die(mysqli_error($conectar));
  $datos_autoincremento_cotizar_producto = mysqli_fetch_assoc($exec_autoincremento_cotizar_producto);
  $cod_cotizar_producto = $datos_autoincremento_cotizar_producto['AUTO_INCREMENT'];

  $sql = "INSERT INTO tbl01_cotizar_producto (cod_producto, cod_producto_bar, nombre_producto, asunto, nombre, correo, 
  telefono, telefono_whatsapp, comentario, nombre_origen_formulario, nombre_estado, ip, nombre_pais, region, ciudad, 
  longitud, latitud, fecha_ymd_his, fecha_hora, fecha_ymd, fecha_mes, fecha_anyo, fecha_time) 
  VALUE (\"$cod_producto\",\"$cod_producto_bar\",\"$nombre_producto\",\"$asunto\",\"$nombre\",\"$correo\",
  \"$telefono\",\"$telefono_whatsapp\",\"$comentario\",\"$nombre_origen_formulario\",\"$nombre_estado\",\"$ip\",\"$nombre_pais\",\"$region\",\"$ciudad\",
  \"$longitud\",\"$latitud\",\"$fecha_ymd_his\",\"$fecha_hora\",\"$fecha_ymd\",\"$fecha_mes\",\"$fecha_anyo\",\"$fecha_time\")";
  $insertar_datos = mysqli_query($conectar,$sql);

  $nombre_emisor                            = "Notificaciones ".ucwords(strtolower($nombre_emp));
  $correo_emisor                            = $Username;
  $nombre_receptor                          = 'Industrias Corfibra';
  $correo_enviar                            = $correo_emp;
  $correo_receptor                          = $correo_enviar;
  $nombre_contacto1_limp                    = str_replace(" ", "_", $nombre1_tercero_propietario);
  $motivo_consulta_limp                     = str_replace(" ", "_", $nombre1_tercero_propietario);
  $nombre_empresa_limp                      = str_replace(" ", "_", $nombre1_tercero_propietario);
  $nombres_limp                             = str_replace(" ", "_", $nombre1_tercero_propietario);
  $cod_historia_clinica_strpad              = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
  $asunto_emisor_parte_superior             = $nombre_asunto_pagina;
  $asunto_correo_enviar                     = $nombre_asunto_pagina;
  $nombre_tipo_asunto                       = $nombre_asunto_pagina;


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
      <th style='text-align:center;'><span style='color: #000; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>".$nombre_tipo_asunto."</span></th>
    </tr>
    <tr>
      <th style='text-align:center;'><span style='color: #000; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Producto: ".$cod_producto_bar.' - '.$nombre_producto."</span></th>
    </tr>
    <tr>
      <th style='text-align:center;'><span style='color: #000; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Correo: ".$correo."</span></th>
    </tr>
    <tr>
      <th style='text-align:center;'><span style='color: #000; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Numero de Telefono: ".$telefono."</span></th>
    </tr>
    <tr>
      <th style='text-align:center;'><span style='color: #000; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Numero de Whatsapp: ".$telefono_whatsapp."</span></th>
    </tr>
    <tr>
      <th style='text-align:center;'><span style='color: #000; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Mensaje: ".$comentario."</span></th>
    </tr>

  </thead>
  <tbody>
  </tbody>
  </table>
  ";
  $mensaje .= "</body>";
  $mensaje .= "</html>";

  $mail = new PHPMailer;
  $mail->SMTPDebug = 0;                          // Enable verbose debug output
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
  //$mail->AddAttachment($ruta_global_archivo, $nombre_archivo);

  if(!$mail->send()) { //INICIO SI EL CORREO NO SE ENVIA PORQUE HAY ERRORES
    $error = $mail->ErrorInfo;
    $tipo = 'correo';
  } //FIN SI EL CORREO NO SE ENVIAA PORQUE HAY ERRORES
  else { // INICIO SI EN CORREO SE ENVIO CORRECTAMENTE
  } //FIN SI EN CORREO SE ENVIO CORRECTAMENTE
    $url_redir = "../admin/formulario_cotizacion_opcion_imprimir.php?cod_cotizar_producto=".$cod_cotizar_producto."&pagina=".$pagina;
  ?>
  <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo ($url_redir) ?>"> 
<?php
} 
?>
    <!-- End Cart -->
    <!-- End Shop Page -->

<?php include_once("../admin/09_modulo_footer.php"); ?>

<?php include_once("../admin/10_modulo_js.php"); ?>

</body>

</html>