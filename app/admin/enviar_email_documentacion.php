<?php
// Aumentar tiempo de ejecución para archivos grandes
set_time_limit(120);
ini_set('max_execution_time', 120);

include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/smtp_conf_correo.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
header('Content-Type: application/json');

// Obtener información de la empresa
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);
if (!$info_empresa_data) { echo json_encode(['success' => false, 'message' => 'No se encontró información de la empresa']); exit; }

$titulo_emp                 = isset($info_empresa_data['titulo']) ? $info_empresa_data['titulo'] : '';
$nombre_emp                 = isset($info_empresa_data['nombre']) ? $info_empresa_data['nombre'] : 'Sistema';
$eslogan_emp                = isset($info_empresa_data['eslogan']) ? $info_empresa_data['eslogan'] : '';
$direccion_emp              = isset($info_empresa_data['direccion']) ? $info_empresa_data['direccion'] : '';
$ciudad_emp                 = isset($info_empresa_data['ciudad']) ? $info_empresa_data['ciudad'] : '';
$telefono_emp               = isset($info_empresa_data['telefono']) ? $info_empresa_data['telefono'] : '';
$correo_emp                 = isset($info_empresa_data['correo']) ? $info_empresa_data['correo'] : '';
$url_pag                    = isset($info_empresa_data['url_pag']) ? $info_empresa_data['url_pag'] : '';
$logotipo_emp               = isset($info_empresa_data['logotipo']) ? $info_empresa_data['logotipo'] : '';

if (isset($_POST['zip_path']) && isset($_POST['email_destino']) && isset($_POST['aliado_nombre'])) {
    $zip_path               = trim($_POST['zip_path']);
    $email_destino          = trim($_POST['email_destino']);
    $aliado_nombre          = trim($_POST['aliado_nombre']);
    $mensaje_adicional      = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';
    // Validar datos
    if (empty($zip_path) || empty($email_destino) || empty($aliado_nombre)) { echo json_encode(['success' => false, 'message' => 'Datos incompletos']); exit; }
    // Validar formato de correo
    if (!filter_var($email_destino, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido']); exit; }
    // Validar que el archivo ZIP exista
    $base_dir = dirname(__DIR__) . '/';
    $ruta_completa_zip = $base_dir . $zip_path;
    if (!file_exists($ruta_completa_zip)) { echo json_encode(['success' => false, 'message' => 'Archivo ZIP no encontrado en: ' . $zip_path]); exit; }
    // Verificar tamaño del archivo (máximo 25MB para evitar problemas de timeout)
    $tamano_archivo = filesize($ruta_completa_zip);
    $tamano_mb = round($tamano_archivo / (1024 * 1024), 2);
    if ($tamano_archivo > 25 * 1024 * 1024) { echo json_encode(['success' => false, 'message' => 'El archivo es demasiado grande (' . $tamano_mb . ' MB). Máximo 25 MB permitido.']); exit; }
    
    // Configuración del correo
    $nombre_emisor          = ucwords(strtolower($nombre_emp));
    $correo_emisor          = $Username;
    $nombre_receptor        = ucwords(strtolower($aliado_nombre));
    $correo_receptor        = $email_destino;
    $asunto_correo_enviar   = "Documentación de Aliado - " . $aliado_nombre;
    
    try {
        $mensaje_html = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <title>Documentación de Aliado</title>
        </head>
        <body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: Arial, Helvetica, sans-serif;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
                <tr>
                    <td align="center">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; max-width: 600px;">
                            
                            <!-- HEADER -->
                            <tr>
                                <td align="center" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); padding: 30px 20px;">
                                    <div style="font-size: 48px; margin-bottom: 10px;">📄</div>
                                    <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold;">Documentación de Aliado</h1>
                                </td>
                            </tr>
                            
                            <!-- DIVIDER -->
                            <tr>
                                <td style="background-color: #4f46e5; height: 4px; line-height: 4px; font-size: 1px;">&nbsp;</td>
                            </tr>
                            
                            <!-- CONTENT -->
                            <tr>
                                <td style="padding: 30px 20px; background-color: #ffffff;">
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 15px;">Estimado/a,</p>
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 25px;">Se adjunta la documentación correspondiente al aliado: <strong style="color: #6366f1;">' . htmlspecialchars($aliado_nombre) . '</strong></p>';
        
        if (!empty($mensaje_adicional)) {
            $mensaje_html .= '
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f9fafb; border-radius: 8px; padding: 20px; margin: 20px 0;">
                                        <tr>
                                            <td>
                                                <p style="color: #374151; font-size: 14px; margin: 0 0 10px; font-weight: bold;">💬 Mensaje:</p>
                                                <p style="color: #6b7280; font-size: 14px; line-height: 1.8; margin: 0;">' . nl2br(htmlspecialchars($mensaje_adicional)) . '</p>
                                            </td>
                                        </tr>
                                    </table>';
        }
        
        $mensaje_html .= '
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eff6ff; border-left: 4px solid #3b82f6; margin: 20px 0;">
                                        <tr>
                                            <td style="padding: 20px;">
                                                <p style="color: #1e40af; font-size: 14px; margin: 0 0 10px; font-weight: bold;">📦 Archivo Adjunto:</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="color: #1e3a8a; font-size: 14px; line-height: 1.8; padding-left: 15px;">
                                                            • El archivo adjunto contiene todos los documentos solicitados<br>
                                                            • Los documentos están en formato comprimido (ZIP)<br>
                                                            • Descargue el archivo desde el adjunto de este correo<br>
                                                            • Si tiene problemas para abrir el archivo, contáctenos
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 20px 0 0;">Si tiene alguna pregunta o necesita información adicional, no dude en contactarnos.</p>
                                </td>
                            </tr>
                            
                            <!-- CONTACT INFO -->
                            <tr>
                                <td align="center" style="padding: 20px; background-color: #f8f9fa;">
                                    <p style="color: #666666; font-size: 14px; margin: 0 0 10px;">¿Necesita ayuda? Contáctenos:</p>
                                    <p style="color: #6366f1; font-size: 14px; margin: 0; font-weight: bold;">
                                        📞 ' . htmlspecialchars($telefono_emp) . ' | 
                                        ✉️ ' . htmlspecialchars($correo_emp) . '
                                    </p>
                                    <p style="color: #666666; font-size: 13px; margin: 10px 0 0;">
                                        📍 ' . htmlspecialchars($direccion_emp) . ', ' . htmlspecialchars($ciudad_emp) . '
                                    </p>
                                </td>
                            </tr>
                            
                            <!-- FOOTER -->
                            <tr>
                                <td align="center" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); padding: 25px 20px;">
                                    <p style="color: #ffffff; font-size: 14px; margin: 0 0 8px; font-weight: bold;">' . htmlspecialchars($nombre_emp) . '</p>
                                    <p style="color: #ffffff; font-size: 12px; margin: 0;">© ' . date('Y') . ' Todos los derechos reservados</p>
                                    <p style="color: rgba(255,255,255,0.7); font-size: 10px; margin: 12px 0 0;">Este correo fue enviado automáticamente. Por favor no responda a este mensaje.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ';
        
        // Texto alternativo sin HTML
        $mensaje_texto = "Estimado/a,\n\n";
        $mensaje_texto .= "Se adjunta la documentación correspondiente al aliado: " . $aliado_nombre . "\n\n";
        
        if (!empty($mensaje_adicional)) {
            $mensaje_texto .= "========================================\n";
            $mensaje_texto .= "         MENSAJE\n";
            $mensaje_texto .= "========================================\n\n";
            $mensaje_texto .= $mensaje_adicional . "\n\n";
        }
        
        $mensaje_texto .= "========================================\n";
        $mensaje_texto .= "     ARCHIVO ADJUNTO\n";
        $mensaje_texto .= "========================================\n\n";
        $mensaje_texto .= "• El archivo adjunto contiene todos los documentos solicitados\n";
        $mensaje_texto .= "• Los documentos están en formato comprimido (ZIP)\n";
        $mensaje_texto .= "• Descargue el archivo desde el adjunto de este correo\n";
        $mensaje_texto .= "• Si tiene problemas para abrir el archivo, contáctenos\n\n";
        $mensaje_texto .= "Si tiene alguna pregunta o necesita información adicional, no dude en contactarnos.\n\n";
        $mensaje_texto .= "Atentamente,\n";
        $mensaje_texto .= "Equipo de Soporte\n\n";
        $mensaje_texto .= "---\n";
        $mensaje_texto .= $nombre_emp . "\n";
        $mensaje_texto .= "Teléfono: " . $telefono_emp . "\n";
        $mensaje_texto .= "Email: " . $correo_emp . "\n";
        $mensaje_texto .= "© " . date('Y') . " Todos los derechos reservados.";
        
        // Configuración del servidor SMTP
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
        $mail->Timeout = 60;
        // Verificar configuración SMTP
        if (empty($Host) || empty($Username) || empty($Password)) { echo json_encode(['success' => false, 'message' => 'Configuración SMTP incompleta. Verifique la configuración en el panel de administración.']); exit; }
        
        $mail->setFrom($Username, $nombre_emisor);
        $mail->addAddress($correo_receptor, $nombre_receptor);
        $mail->Subject = $asunto_correo_enviar;
        $mail->isHTML(true);
        $mail->Body = $mensaje_html;        
        $mail->AltBody = $mensaje_texto;
        // Adjuntar el archivo ZIP
        $mail->addAttachment($ruta_completa_zip, basename($zip_path));
        // Enviar correo
        if ($mail->Send()) { echo json_encode(['success' => true, 'message' => 'Email enviado exitosamente a ' . $correo_receptor]); } else { echo json_encode(['success' => false, 'message' => 'No se pudo enviar el correo: ' . $mail->ErrorInfo]); }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos. Se requiere zip_path, email_destino y aliado_nombre.']);
}
?>
