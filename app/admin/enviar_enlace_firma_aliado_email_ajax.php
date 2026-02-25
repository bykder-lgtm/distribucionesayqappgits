<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/smtp_conf_correo.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit; }
header('Content-Type: application/json');

// Obtener información de la empresa
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);
if (!$info_empresa_data) { echo json_encode(['success' => false, 'mensaje' => 'No se encontró información de la empresa']); exit; }

$nombre_emp                 = isset($info_empresa_data['nombre']) ? $info_empresa_data['nombre'] : 'Sistema';
$telefono_emp               = isset($info_empresa_data['telefono']) ? $info_empresa_data['telefono'] : '';
$correo_emp                 = isset($info_empresa_data['correo']) ? $info_empresa_data['correo'] : '';
$direccion_emp              = isset($info_empresa_data['direccion']) ? $info_empresa_data['direccion'] : '';
$ciudad_emp                 = isset($info_empresa_data['ciudad']) ? $info_empresa_data['ciudad'] : '';

if (isset($_POST['correo']) && isset($_POST['nombre_aliado']) && isset($_POST['enlace_firma'])) {
    $correo                 = trim($_POST['correo']);
    $nombre_aliado          = trim($_POST['nombre_aliado']);
    $enlace_firma           = trim($_POST['enlace_firma']);
    
    if (empty($correo) || empty($nombre_aliado) || empty($enlace_firma)) { echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']); exit; }
    
    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success' => false, 'mensaje' => 'El correo electrónico no es válido']); exit; }
    
    // Configuración del correo
    $nombre_emisor          = ucwords(strtolower($nombre_emp));
    $correo_emisor          = $Username;
    $nombre_receptor        = ucwords(strtolower($nombre_aliado));
    $correo_receptor        = $correo;
    $asunto_correo_enviar   = "Firma Digital de Alianza Comercial - " . $nombre_receptor;
    
    try {
        $mensaje_html = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <title>Firma Digital Pendiente</title>
        </head>
        <body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: Arial, Helvetica, sans-serif;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
                <tr>
                    <td align="center">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; max-width: 600px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            
                            <!-- HEADER -->
                            <tr>
                                <td align="center" style="background-color: #8b5cf6; padding: 40px 20px;">
                                    <div style="font-size: 56px; margin-bottom: 15px;">🖋️</div>
                                    <h1 style="color: #ffffff; margin: 0; font-size: 26px; font-weight: bold; font-family: \'Outfit\', Arial, sans-serif;">Firma Digital Alianza Comercial</h1>
                                </td>
                            </tr>
                            
                            <!-- DIVIDER -->
                            <tr>
                                <td style="background-color: #7c3aed; height: 6px; line-height: 6px; font-size: 1px;">&nbsp;</td>
                            </tr>
                            
                            <!-- CONTENT -->
                            <tr>
                                <td style="padding: 40px 30px; background-color: #ffffff;">
                                    <p style="color: #1e293b; font-size: 18px; line-height: 1.6; margin: 0 0 20px; font-weight: 500;">Hola <strong>' . htmlspecialchars($nombre_receptor) . '</strong>,</p>
                                    <p style="color: #475569; font-size: 16px; line-height: 1.6; margin: 0 0 25px;">Por favor, ingrese al siguiente enlace para realizar la firma digital del documento de alianza comercial con <strong>' . htmlspecialchars($nombre_emp) . '</strong>.</p>
                                    
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 25px; margin: 25px 0;">
                                        <tr>
                                            <td>
                                                <p style="color: #1e293b; font-size: 15px; margin: 0 0 15px; font-weight: bold;">Instrucciones rápidas:</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="color: #475569; font-size: 15px; line-height: 1.8;">
                                                            <span style="color: #8b5cf6; font-weight: bold;">1.</span> Haga clic en el botón violeta "FIRMAR DOCUMENTO"<br>
                                                            <span style="color: #8b5cf6; font-weight: bold;">2.</span> Dibuje su firma en el recuadro que aparecerá en pantalla<br>
                                                            <span style="color: #8b5cf6; font-weight: bold;">3.</span> Presione el botón "Confirmar firma" para finalizar
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- BUTTON BOX -->
                            <tr>
                                <td align="center" style="padding: 0 30px 40px;">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #8b5cf6; border-radius: 12px;">
                                        <tr>
                                            <td align="center" style="padding: 30px 25px;">
                                                <table cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td align="center" style="background-color: #ffffff; border-radius: 8px;">
                                                            <a href="' . htmlspecialchars($enlace_firma) . '" style="display: block; color: #8b5cf6; text-decoration: none; padding: 16px 40px; font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">🖋️ FIRMAR DOCUMENTO</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p style="color: rgba(255,255,255,0.8); font-size: 12px; margin: 20px 0 0;">Si el botón no funciona, copie y pegue este enlace:</p>
                                                <p style="color: rgba(255,255,255,0.7); font-size: 11px; word-break: break-all; margin: 5px 0 0;">' . htmlspecialchars($enlace_firma) . '</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- INFO BOX -->
                            <tr>
                                <td style="padding: 0 30px 30px;">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #faf5ff; border-left: 4px solid #8b5cf6; border-radius: 4px;">
                                        <tr>
                                            <td style="padding: 20px;">
                                                <p style="color: #6d28d9; font-size: 14px; margin: 0; line-height: 1.5;"><strong>Nota Seguridad:</strong> Este enlace es personal e intransferible. Tiene una vigencia de 48 horas como medida de seguridad.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- CONTACT INFO -->
                            <tr>
                                <td align="center" style="padding: 25px; background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                                    <p style="color: #64748b; font-size: 14px; margin: 0 0 10px;">¿Dudas o inconvenientes?</p>
                                    <p style="color: #8b5cf6; font-size: 14px; margin: 0; font-weight: bold;">
                                        📞 ' . htmlspecialchars($telefono_emp) . ' | ✉️ ' . htmlspecialchars($correo_emp) . '
                                    </p>
                                </td>
                            </tr>
                            
                            <!-- FOOTER -->
                            <tr>
                                <td align="center" style="background-color: #8b5cf6; padding: 30px 20px;">
                                    <p style="color: #ffffff; font-size: 15px; margin: 0 0 8px; font-weight: bold;">' . htmlspecialchars($nombre_emp) . '</p>
                                    <p style="color: rgba(255,255,255,0.8); font-size: 12px; margin: 0;">© ' . date('Y') . ' Todos los derechos reservados</p>
                                    <p style="color: rgba(255,255,255,0.6); font-size: 10px; margin: 15px 0 0;">Este es un correo automático, por favor no responda.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ';
        
        // Configuración PHPMailer
        require_once('../PHPMailer/class.phpmailer.php');
        require_once('../PHPMailer/class.smtp.php');
        
        $mail = new PHPMailer();
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
        $mail->addAddress($correo_receptor, $nombre_receptor);
        $mail->Subject = $asunto_correo_enviar;
        $mail->isHTML(true);
        $mail->Body = $mensaje_html;
        
        if ($mail->Send()) { echo json_encode(['success' => true, 'mensaje' => 'Enlace de firma enviado exitosamente a ' . $correo_receptor]); } else { echo json_encode(['success' => false, 'mensaje' => 'No se pudo enviar el correo: ' . $mail->ErrorInfo]); }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos.']);
}
?>
