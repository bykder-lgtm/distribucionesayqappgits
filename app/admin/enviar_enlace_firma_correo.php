<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
session_start();

$anyo_actual = date("Y");
$fecha_hoy = date("Y-m-d");
$hora_hoy = date("H:i:s");
$fecha_ymd_his = date("Y-m-d H:i:s");
$fecha_time = time();

// Verificar que se recibieron los datos necesarios
if (!isset($_POST['correo']) || !isset($_POST['enlace']) || !isset($_POST['nombre_tienda'])) { echo json_encode(array('success' => false, 'mensaje' => 'Datos incompletos')); exit; }

$correo_receptor = trim($_POST['correo']);
$enlace_firma = trim($_POST['enlace']);
$nombre_tienda = trim($_POST['nombre_tienda']);
$cod_tienda = isset($_POST['cod_tienda']) ? trim($_POST['cod_tienda']) : '';

// Validar correo
if (empty($correo_receptor) || !filter_var($correo_receptor, FILTER_VALIDATE_EMAIL)) { echo json_encode(array('success' => false, 'mensaje' => 'Correo electrónico no válido')); exit; }

require_once '../PHPMailer/PHPMailerAutoload.php';

// Obtener configuración SMTP
$sql_info_correo_smtp = "SELECT * FROM tbl15_correo_smtp WHERE (cod_estado_correo_predeterminado = '1' AND cod_estado = '1')";
$resultado_info_correo_smtp = mysqli_query($conectar, $sql_info_correo_smtp);
$info_emprecorreo_smtp = mysqli_fetch_assoc($resultado_info_correo_smtp);

if (!$info_emprecorreo_smtp) { echo json_encode(array('success' => false, 'mensaje' => 'No se encontró configuración SMTP')); exit; }

$Host = $info_emprecorreo_smtp['host_correo_smtp'];
$SMTPAuth = $info_emprecorreo_smtp['auth_correo_smtp'];
$Username = $info_emprecorreo_smtp['nombre_correo_smtp'];
$Password = $info_emprecorreo_smtp['contrasena_app_correo_smtp'];
$SMTPSecure = $info_emprecorreo_smtp['secure_correo_smtp'];
$Port = $info_emprecorreo_smtp['port_correo_smtp'];

// Obtener información de la empresa
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

if (!$info_empresa_data) { echo json_encode(array('success' => false, 'mensaje' => 'No se encontró información de la empresa')); exit; }

$titulo_emp = isset($info_empresa_data['titulo']) ? $info_empresa_data['titulo'] : '';
$nombre_emp = isset($info_empresa_data['nombre']) ? $info_empresa_data['nombre'] : 'Sistema';
$eslogan_emp = isset($info_empresa_data['eslogan']) ? $info_empresa_data['eslogan'] : '';
$direccion_emp = isset($info_empresa_data['direccion']) ? $info_empresa_data['direccion'] : '';
$ciudad_emp = isset($info_empresa_data['ciudad']) ? $info_empresa_data['ciudad'] : '';
$telefono_emp = isset($info_empresa_data['telefono']) ? $info_empresa_data['telefono'] : '';
$correo_emp = isset($info_empresa_data['correo']) ? $info_empresa_data['correo'] : '';
$url_pag = isset($info_empresa_data['url_pag']) ? $info_empresa_data['url_pag'] : '';
$logotipo_emp = isset($info_empresa_data['logotipo']) ? $info_empresa_data['logotipo'] : '';
$desarrollador_emp = isset($info_empresa_data['desarrollador']) ? $info_empresa_data['desarrollador'] : 'Desarrollador';

// Configuración del correo
$nombre_emisor = ucwords(strtolower($nombre_emp));
$correo_emisor = $Username;
$asunto_correo_enviar = "Firma Electrónica Pendiente - " . htmlspecialchars($nombre_tienda);

// Diseño del correo HTML
$mensaje = "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Firma Electrónica Pendiente</title>
</head>
<body style='margin: 0; padding: 0; background-color: #f5f5f5; font-family: Arial, Helvetica, sans-serif;'>
    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #f5f5f5; padding: 20px 0;'>
        <tr>
            <td align='center'>
                <table width='600' cellpadding='0' cellspacing='0' border='0' style='background-color: #ffffff; max-width: 600px; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);'>
                    
                    <!-- HEADER -->
                    <tr>
                        <td align='center' style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px;'>
                            <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: bold;'>" . htmlspecialchars($nombre_emp) . "</h1>
                            " . (!empty($eslogan_emp) ? "<p style='color: #ffffff; margin: 10px 0 0; font-size: 14px; opacity: 0.9;'>" . htmlspecialchars($eslogan_emp) . "</p>" : "") . "
                        </td>
                    </tr>
                    
                    <!-- ICON SECTION -->
                    <tr>
                        <td align='center' style='padding: 40px 20px 20px;'>
                            <div style='width: 80px; height: 80px; background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(5,150,105,0.2)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;'>
                                <span style='font-size: 40px;'>✓</span>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- MAIN CONTENT -->
                    <tr>
                        <td style='padding: 0 40px;'>
                            <h2 style='color: #10b981; margin: 0 0 20px; font-size: 24px; text-align: center;'>¡Tienda Registrada Exitosamente!</h2>
                            <p style='color: #374151; margin: 0 0 15px; font-size: 16px; line-height: 1.6; text-align: center;'>
                                Su tienda <strong>" . htmlspecialchars($nombre_tienda) . "</strong> ha sido registrada correctamente en nuestro sistema.
                            </p>
                            <p style='color: #6b7280; margin: 0 0 30px; font-size: 15px; line-height: 1.6; text-align: center;'>
                                Para completar el proceso, solamente necesita proporcionar su firma electrónica.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- STEPS SECTION -->
                    <tr>
                        <td style='padding: 0 40px 30px;'>
                            <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #f9fafb; border-radius: 8px; padding: 25px;'>
                                <tr>
                                    <td>
                                        <h3 style='color: #1f2937; margin: 0 0 15px; font-size: 18px; font-weight: 600;'>Pasos para firmar:</h3>
                                        <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                            <tr>
                                                <td style='color: #667eea; font-weight: bold; font-size: 24px; padding: 8px 0; width: 40px;'>1</td>
                                                <td style='color: #4b5563; font-size: 15px; padding: 8px 0; line-height: 1.5;'>Haga clic en el botón de abajo</td>
                                            </tr>
                                            <tr>
                                                <td style='color: #667eea; font-weight: bold; font-size: 24px; padding: 8px 0;'>2</td>
                                                <td style='color: #4b5563; font-size: 15px; padding: 8px 0; line-height: 1.5;'>Dibuje su firma en el recuadro que aparecerá</td>
                                            </tr>
                                            <tr>
                                                <td style='color: #667eea; font-weight: bold; font-size: 24px; padding: 8px 0;'>3</td>
                                                <td style='color: #4b5563; font-size: 15px; padding: 8px 0; line-height: 1.5;'>Presione 'Confirmar Firma' para finalizar</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- CTA BUTTON -->
                    <tr>
                        <td align='center' style='padding: 0 40px 40px;'>
                            <a href='" . htmlspecialchars($enlace_firma) . "' style='display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; padding: 16px 40px; border-radius: 8px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);'>
                                ✍️ Firmar Ahora
                            </a>
                        </td>
                    </tr>
                    
                    <!-- LINK ALTERNATIVO -->
                    <tr>
                        <td style='padding: 0 40px 40px;'>
                            <p style='color: #6b7280; margin: 0 0 10px; font-size: 13px; text-align: center;'>
                                Si el botón no funciona, copie y pegue este enlace en su navegador:
                            </p>
                            <p style='color: #667eea; margin: 0; font-size: 13px; text-align: center; word-break: break-all;'>
                                <a href='" . htmlspecialchars($enlace_firma) . "' style='color: #667eea; text-decoration: none;'>" . htmlspecialchars($enlace_firma) . "</a>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- FOOTER -->
                    <tr>
                        <td style='background-color: #f9fafb; padding: 30px 40px; border-top: 1px solid #e5e7eb;'>
                            <p style='color: #9ca3af; margin: 0 0 10px; font-size: 13px; text-align: center;'>
                                Este correo fue enviado por <strong>" . htmlspecialchars($nombre_emp) . "</strong>
                            </p>
                            " . (!empty($direccion_emp) ? "<p style='color: #9ca3af; margin: 0 0 5px; font-size: 12px; text-align: center;'>" . htmlspecialchars($direccion_emp) . "</p>" : "") . "
                            " . (!empty($telefono_emp) ? "<p style='color: #9ca3af; margin: 0 0 5px; font-size: 12px; text-align: center;'>Tel: " . htmlspecialchars($telefono_emp) . "</p>" : "") . "
                            " . (!empty($correo_emp) ? "<p style='color: #9ca3af; margin: 0; font-size: 12px; text-align: center;'>Email: " . htmlspecialchars($correo_emp) . "</p>" : "") . "
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
";

// Envío del correo
try {
    $mail = new PHPMailer;
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = $Host;
    $mail->SMTPAuth = ($SMTPAuth == '1' || $SMTPAuth === true || strtolower($SMTPAuth) == 'true');
    $mail->Username = $Username;
    $mail->Password = $Password;
    $mail->SMTPSecure = $SMTPSecure;
    $mail->Port = intval($Port);
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($Username, $nombre_emisor);
    $mail->addAddress($correo_receptor);
    $mail->Subject = $asunto_correo_enviar;
    $mail->isHTML(true);
    $mail->Body = $mensaje;
    if(!$mail->send()) { $cod_estado_envio_correo = 0; $nombre_estado_envio_correo = "No Enviado"; $descripcion_error_envio_correo = $mail->ErrorInfo; } else { $cod_estado_envio_correo = 1; $nombre_estado_envio_correo = "Enviado Correctamente"; $descripcion_error_envio_correo = ""; }
    
    // Registrar el envío en la base de datos
    $cod_tipo_modulo_envio_correo = "15";
    $nombre_tipo_modulo_envio_correo = "ENLACE FIRMA ELECTRONICA TIENDA";
    $id_origen_correo = $cod_tienda;
    $nombre_tabla_origen_correo = "tbl15_maestro_tienda";
    $nombre_campo_origen_correo = "cod_tienda";
    $nombre_origen_correo = "Enlace firma electrónica - " . $nombre_tienda;
    $url_origen_correo = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    
    $correo_emisor_escaped = mysqli_real_escape_string($conectar, $correo_emisor);
    $correo_receptor_escaped = mysqli_real_escape_string($conectar, $correo_receptor);
    $descripcion_error_envio_correo_escaped = mysqli_real_escape_string($conectar, $descripcion_error_envio_correo);
    $nombre_origen_correo_escaped = mysqli_real_escape_string($conectar, $nombre_origen_correo);
    $url_origen_correo_escaped = mysqli_real_escape_string($conectar, $url_origen_correo);
    $asunto_correo_enviar_escaped = mysqli_real_escape_string($conectar, $asunto_correo_enviar);
    
    $sql_envio_correo = "INSERT INTO tbl15_envio_correo (cod_tipo_modulo_envio_correo, nombre_tipo_modulo_envio_correo, id_origen_correo, nombre_tabla_origen_correo, 
    nombre_campo_origen_correo, nombre_origen_correo, correo_emisor, correo_receptor, cod_estado_envio_correo, nombre_estado_envio_correo, 
    descripcion_error_envio_correo, fecha_envio_correo, hora_envio_correo, url_origen_correo, fecha_ymd_his, fecha_time, asunto_correo) 
    VALUES ('$cod_tipo_modulo_envio_correo', '$nombre_tipo_modulo_envio_correo', '$id_origen_correo', '$nombre_tabla_origen_correo', 
    '$nombre_campo_origen_correo', '$nombre_origen_correo_escaped', '$correo_emisor_escaped', '$correo_receptor_escaped', '$cod_estado_envio_correo', '$nombre_estado_envio_correo', 
    '$descripcion_error_envio_correo_escaped', '$fecha_hoy', '$hora_hoy', '$url_origen_correo_escaped', '$fecha_ymd_his', '$fecha_time', '$asunto_correo_enviar_escaped')";
    mysqli_query($conectar, $sql_envio_correo);
    if ($cod_estado_envio_correo == 1) { echo json_encode(array('success' => true, 'mensaje' => 'Correo enviado exitosamente a ' . $correo_receptor)); } else { echo json_encode(array('success' => false, 'mensaje' => 'Error al enviar el correo', 'error' => $descripcion_error_envio_correo)); }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'mensaje' => 'Error al enviar correo', 'error' => $e->getMessage()));
}
?>
