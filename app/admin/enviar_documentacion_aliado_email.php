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

if (isset($_POST['correo']) && isset($_POST['nombre_aliado']) && isset($_POST['enlace'])) {
    $correo                 = trim($_POST['correo']);
    $nombre_aliado          = trim($_POST['nombre_aliado']);
    $enlace                 = trim($_POST['enlace']);
    
    if (empty($correo) || empty($nombre_aliado) || empty($enlace)) { echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']); exit; }
    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success' => false, 'mensaje' => 'El correo electrónico no es válido']); exit; }
    
    // Configuración del correo
    $nombre_emisor          = ucwords(strtolower($nombre_emp));
    $correo_emisor          = $Username; // El correo emisor es el configurado en SMTP
    $nombre_receptor        = ucwords(strtolower($nombre_aliado));
    $correo_receptor        = $correo;
    $asunto_correo_enviar   = "Cargue de Documentación Legal - Sistema de Distribuciones";
    
    try {
        $mensaje_html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
                .header { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 30px 20px; text-align: center; }
                .header h1 { margin: 0; font-size: 24px; }
                .header .icon { font-size: 48px; margin-bottom: 10px; }
                .content { padding: 30px 20px; color: #333; }
                .content p { line-height: 1.6; margin: 15px 0; }
                .link-box { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 20px; border-radius: 8px; text-align: center; margin: 25px 0; }
                .link-box h2 { margin: 0 0 15px 0; font-size: 16px; font-weight: normal; }
                .button { display: inline-block; background: white; color: #8b5cf6; padding: 14px 35px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; margin: 10px 0; transition: all 0.3s ease; }
                .button:hover { background: #f3f4f6; }
                .info-box { background: #f0fdf4; border-left: 4px solid #10b981; padding: 15px; margin: 20px 0; }
                .warning-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; }
                .docs-list { background: #f9fafb; border-radius: 8px; padding: 15px; margin: 20px 0; }
                .docs-list h3 { margin: 0 0 10px 0; color: #374151; font-size: 14px; }
                .docs-list ul { margin: 0; padding-left: 20px; color: #6b7280; }
                .docs-list li { margin: 8px 0; }
                .footer { background: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <div class="icon">📄</div>
                    <h1>Cargue de Documentación Legal</h1>
                </div>
                <div class="content">
                    <p>Estimado(a) <strong>' . htmlspecialchars($nombre_receptor) . '</strong>,</p>
                    <p>Para completar tu registro como aliado estratégico en el <strong>Sistema de Distribuciones AYQ</strong>, necesitamos que cargues tu documentación legal.</p>
                    
                    <div class="link-box">
                        <h2>Haz clic en el siguiente botón para cargar tus documentos:</h2>
                        <a href="' . htmlspecialchars($enlace) . '" class="button">📤 CARGAR DOCUMENTACIÓN</a>
                        <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">O copia y pega este enlace en tu navegador:</p>
                        <p style="font-size: 11px; word-break: break-all; opacity: 0.7;">' . htmlspecialchars($enlace) . '</p>
                    </div>
                    
                    <div class="docs-list">
                        <h3>📋 Documentos requeridos:</h3>
                        <ul>
                            <li><strong>RUT (Registro Único Tributario)</strong> - Archivo actualizado</li>
                            <li><strong>Cámara de Comercio</strong> - Certificado vigente</li>
                            <li><strong>Cédula del Representante Legal</strong> - Ambas caras</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <strong>✓ Instrucciones:</strong>
                        <ul style="margin: 10px 0; padding-left: 20px;">
                            <li>Prepara los documentos en formato digital (PDF o imágenes)</li>
                            <li>Haz clic en el enlace para acceder al formulario de carga</li>
                            <li>Sube cada documento en el campo correspondiente</li>
                            <li>Asegúrate de que los documentos sean legibles</li>
                        </ul>
                    </div>
                    
                    <div class="warning-box">
                        <strong>⚠️ Importante:</strong>
                        <ul style="margin: 10px 0; padding-left: 20px;">
                            <li>Los documentos deben estar vigentes y legibles</li>
                            <li>El tamaño máximo por archivo es de 5 MB</li>
                            <li>Formatos aceptados: PDF, JPG, JPEG, PNG</li>
                            <li>Si tienes problemas, contacta al administrador</li>
                        </ul>
                    </div>
                    
                    <p style="text-align: center; margin-top: 30px;">
                        <strong>¿Tienes preguntas?</strong><br>
                        Contáctanos: ' . htmlspecialchars($telefono_emp) . '<br>
                        Email: ' . htmlspecialchars($correo_emp) . '
                    </p>
                </div>
                <div class="footer">
                    <p><strong>Sistema de Distribuciones AYQ</strong></p>
                    <p>' . htmlspecialchars($direccion_emp) . ' - ' . htmlspecialchars($ciudad_emp) . '</p>
                    <p>Este es un correo automático, por favor no responder.</p>
                    <p>© ' . date('Y') . ' Todos los derechos reservados.</p>
                </div>
            </div>
        </body>
        </html>
        ';
        
        // Texto alternativo sin HTML
        $mensaje_texto = "Hola " . $nombre_receptor . ",\n\n";
        $mensaje_texto .= "Para completar tu registro como aliado estratégico en el Sistema de Distribuciones AYQ, necesitamos que cargues tu documentación legal.\n\n";
        $mensaje_texto .= "Accede al siguiente enlace para cargar tus documentos:\n";
        $mensaje_texto .= $enlace . "\n\n";
        $mensaje_texto .= "Documentos requeridos:\n";
        $mensaje_texto .= "- RUT (Registro Único Tributario)\n";
        $mensaje_texto .= "- Cámara de Comercio\n";
        $mensaje_texto .= "- Cédula del Representante Legal\n\n";
        $mensaje_texto .= "Si tienes preguntas, contáctanos:\n";
        $mensaje_texto .= "Teléfono: " . $telefono_emp . "\n";
        $mensaje_texto .= "Email: " . $correo_emp . "\n\n";
        $mensaje_texto .= "Sistema de Distribuciones AYQ\n";
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
        if ($mail->Send()) { echo json_encode(['success' => true, 'mensaje' => 'Correo enviado exitosamente a '.$correo_receptor]); } else { echo json_encode(['success' => false, 'mensaje' => 'No se pudo enviar el correo: ' . $mail->ErrorInfo]); }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos. Se requiere correo, nombre y enlace.']);
}
?>
