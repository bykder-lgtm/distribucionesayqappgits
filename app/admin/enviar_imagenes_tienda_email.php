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

$titulo_emp                 = isset($info_empresa_data['titulo']) ? $info_empresa_data['titulo'] : '';
$nombre_emp                 = isset($info_empresa_data['nombre']) ? $info_empresa_data['nombre'] : 'Sistema';
$eslogan_emp                = isset($info_empresa_data['eslogan']) ? $info_empresa_data['eslogan'] : '';
$direccion_emp              = isset($info_empresa_data['direccion']) ? $info_empresa_data['direccion'] : '';
$ciudad_emp                 = isset($info_empresa_data['ciudad']) ? $info_empresa_data['ciudad'] : '';
$telefono_emp               = isset($info_empresa_data['telefono']) ? $info_empresa_data['telefono'] : '';
$correo_emp                 = isset($info_empresa_data['correo']) ? $info_empresa_data['correo'] : '';
$url_pag                    = isset($info_empresa_data['url_pag']) ? $info_empresa_data['url_pag'] : '';
$logotipo_emp               = isset($info_empresa_data['logotipo']) ? $info_empresa_data['logotipo'] : '';
$desarrollador_emp          = isset($info_empresa_data['desarrollador']) ? $info_empresa_data['desarrollador'] : 'Desarrollador';
$pag_desarrollador_emp      = isset($info_empresa_data['pag_desarrollador']) ? $info_empresa_data['pag_desarrollador'] : '#';

if (isset($_POST['correo']) && isset($_POST['nombre_tienda']) && isset($_POST['enlace_imagenes'])) {
    $correo                 = trim($_POST['correo']);
    $nombre_tienda          = trim($_POST['nombre_tienda']);
    $enlace_imagenes        = trim($_POST['enlace_imagenes']);
    if (empty($correo) || empty($nombre_tienda) || empty($enlace_imagenes)) { echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']); exit; }
    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success' => false, 'mensaje' => 'El correo electrónico no es válido']); exit; }
    // Configuración del correo
    $nombre_emisor          = ucwords(strtolower($nombre_emp));
    $correo_emisor          = $Username;
    $nombre_receptor        = ucwords(strtolower($nombre_tienda));
    $correo_receptor        = $correo;
    $asunto_correo_enviar   = "Carga de Imágenes de Tienda - " . $nombre_tienda;
    
    try {
        $mensaje_html = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <title>Carga de Imágenes de Tienda</title>
        </head>
        <body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: Arial, Helvetica, sans-serif;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
                <tr>
                    <td align="center">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; max-width: 600px;">
                            
                            <!-- HEADER -->
                            <tr>
                                <td align="center" style="background-color: #ec4899; padding: 30px 20px;">
                                    <div style="font-size: 48px; margin-bottom: 10px;">📸</div>
                                    <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold;">Carga de Imágenes</h1>
                                </td>
                            </tr>
                            
                            <!-- DIVIDER -->
                            <tr>
                                <td style="background-color: #db2777; height: 4px; line-height: 4px; font-size: 1px;">&nbsp;</td>
                            </tr>
                            
                            <!-- CONTENT -->
                            <tr>
                                <td style="padding: 30px 20px; background-color: #ffffff;">
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 15px;">¡Hola!</p>
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 25px;">Necesitamos que cargues las <strong style="color: #ec4899;">imágenes</strong> de tu tienda <strong style="color: #ec4899;">"' . htmlspecialchars($nombre_tienda) . '"</strong> para completar tu registro.</p>
                                    
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f9fafb; border-radius: 8px; padding: 20px; margin: 20px 0;">
                                        <tr>
                                            <td>
                                                <p style="color: #374151; font-size: 14px; margin: 0 0 15px; font-weight: bold;">📱 Es muy fácil y rápido:</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="color: #6b7280; font-size: 14px; line-height: 1.8; padding-left: 15px;">
                                                            <strong style="color: #ec4899;">▶ PASO 1:</strong> Haga clic en el botón de abajo<br>
                                                            <strong style="color: #ec4899;">▶ PASO 2:</strong> Seleccione las fotos de su tienda<br>
                                                            <strong style="color: #ec4899;">▶ PASO 3:</strong> Presione "Subir Imágenes"
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
                                <td align="center" style="padding: 0 20px 30px;">
                                    <table width="90%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ec4899; border-radius: 10px; max-width: 500px;">
                                        <tr>
                                            <td align="center" style="padding: 25px 20px;">
                                                <p style="color: #ffffff; font-size: 16px; margin: 0 0 15px;">Haga clic en el botón para cargar las imágenes:</p>
                                                <table cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td align="center" style="background-color: #ffffff; border-radius: 8px;">
                                                            <a href="' . htmlspecialchars($enlace_imagenes) . '" style="display: block; color: #ec4899; text-decoration: none; padding: 14px 35px; font-size: 16px; font-weight: bold;">📸 CARGAR IMÁGENES</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p style="color: rgba(255,255,255,0.8); font-size: 12px; margin: 15px 0 0;">O copie y pegue este enlace en su navegador:</p>
                                                <p style="color: rgba(255,255,255,0.7); font-size: 11px; word-break: break-all; margin: 5px 0 0;">' . htmlspecialchars($enlace_imagenes) . '</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- INFO BOX -->
                            <tr>
                                <td style="padding: 0 20px 20px;">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f0fdf4; border-left: 4px solid #10b981;">
                                        <tr>
                                            <td style="padding: 20px;">
                                                <p style="color: #065f46; font-size: 14px; margin: 0 0 10px; font-weight: bold;">✓ ¿Qué imágenes debes cargar?</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="color: #047857; font-size: 14px; line-height: 1.8; padding-left: 15px;">
                                                            • Fachada de la tienda (vista frontal completa)<br>
                                                            • Interior de la tienda (vista general)<br>
                                                            • Productos en exhibición<br>
                                                            • Imágenes claras y con buena iluminación
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- WARNING BOX -->
                            <tr>
                                <td style="padding: 0 20px 30px;">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fef3c7; border-left: 4px solid #f59e0b;">
                                        <tr>
                                            <td style="padding: 20px;">
                                                <p style="color: #92400e; font-size: 14px; margin: 0 0 10px; font-weight: bold;">⚠️ Importante:</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="color: #b45309; font-size: 14px; line-height: 1.8; padding-left: 15px;">
                                                            • Las imágenes deben ser recientes<br>
                                                            • Formatos aceptados: JPG, JPEG, PNG<br>
                                                            • Tamaño máximo por imagen: 5 MB<br>
                                                            • Puede cargar múltiples imágenes a la vez
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- CONTACT INFO -->
                            <tr>
                                <td align="center" style="padding: 20px; background-color: #f8f9fa;">
                                    <p style="color: #666666; font-size: 14px; margin: 0 0 10px;">¿Necesita ayuda? Contáctenos:</p>
                                    <p style="color: #ec4899; font-size: 14px; margin: 0; font-weight: bold;">
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
                                <td align="center" style="background-color: #ec4899; padding: 25px 20px;">
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
        $mensaje_texto = "¡Hola!\n\n";
        $mensaje_texto .= "Necesitamos que cargues las imágenes de tu tienda \"" . $nombre_tienda . "\" para completar tu registro.\n\n";
        $mensaje_texto .= "========================================\n";
        $mensaje_texto .= "    CARGA DE IMAGENES DE TIENDA\n";
        $mensaje_texto .= "========================================\n\n";
        $mensaje_texto .= "Es muy fácil y rápido:\n\n";
        $mensaje_texto .= "> PASO 1: Haga clic en el siguiente enlace\n";
        $mensaje_texto .= "> PASO 2: Seleccione las fotos de su tienda\n";
        $mensaje_texto .= "> PASO 3: Presione \"Subir Imágenes\"\n\n";
        $mensaje_texto .= "ENLACE PARA CARGAR IMÁGENES:\n";
        $mensaje_texto .= $enlace_imagenes . "\n\n";
        $mensaje_texto .= "¿Qué imágenes debes cargar?\n";
        $mensaje_texto .= "• Fachada de la tienda (vista frontal completa)\n";
        $mensaje_texto .= "• Interior de la tienda (vista general)\n";
        $mensaje_texto .= "• Productos en exhibición\n";
        $mensaje_texto .= "• Imágenes claras y con buena iluminación\n\n";
        $mensaje_texto .= "Importante:\n";
        $mensaje_texto .= "• Las imágenes deben ser recientes\n";
        $mensaje_texto .= "• Formatos aceptados: JPG, JPEG, PNG\n";
        $mensaje_texto .= "• Tamaño máximo por imagen: 5 MB\n";
        $mensaje_texto .= "• Puede cargar múltiples imágenes a la vez\n\n";
        $mensaje_texto .= "Gracias por tu colaboración!\n\n";
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
        
        $mail->setFrom($Username, $nombre_emisor);
        $mail->addAddress($correo_receptor, $nombre_receptor);
        $mail->Subject = $asunto_correo_enviar;
        $mail->isHTML(true);
        $mail->Body = $mensaje_html;        
        $mail->AltBody = $mensaje_texto;
        
        // Enviar correo
        if ($mail->Send()) { echo json_encode(['success' => true, 'mensaje' => 'Correo enviado exitosamente a ' . $correo_receptor]); } else { echo json_encode(['success' => false, 'mensaje' => 'No se pudo enviar el correo: ' . $mail->ErrorInfo]); }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos. Se requiere correo, nombre_tienda y enlace_imagenes.']);
}
?>
