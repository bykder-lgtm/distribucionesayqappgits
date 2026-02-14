<?php
// Aumentar tiempo de ejecución
set_time_limit(120);
ini_set('max_execution_time', 120);

include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/smtp_conf_correo.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
// Verificar sesión
if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
header('Content-Type: application/json');

// Obtener información de la empresa para el pie de página
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre_emp                 = isset($info_empresa_data['nombre']) ? $info_empresa_data['nombre'] : 'Sistema';
$telefono_emp               = isset($info_empresa_data['telefono']) ? $info_empresa_data['telefono'] : '';
$correo_emp                 = isset($info_empresa_data['correo']) ? $info_empresa_data['correo'] : '';
$direccion_emp              = isset($info_empresa_data['direccion']) ? $info_empresa_data['direccion'] : '';
$ciudad_emp                 = isset($info_empresa_data['ciudad']) ? $info_empresa_data['ciudad'] : '';

if (isset($_POST['email_destino']) && isset($_POST['nombre_asesor']) && isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    
    $email_destino          = trim($_POST['email_destino']);
    $nombre_asesor          = trim($_POST['nombre_asesor']);
    $usuario                = trim($_POST['usuario']);
    $contrasena             = trim($_POST['contrasena']); // Nota: Si es solo informativa, debe ser la original no la encriptada, o advertir si es encriptada.
    // Asumimos que se pasa la cédula como contraseña inicial visible, no el hash.
    // Validar datos
    if (empty($email_destino) || empty($nombre_asesor) || empty($usuario)) { echo json_encode(['success' => false, 'message' => 'Datos incompletos']); exit; }
    // Validar formato de correo
    if (!filter_var($email_destino, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido']); exit; }
    // Configuración del correo
    $nombre_emisor          = ucwords(strtolower($nombre_emp));
    $nombre_receptor        = ucwords(strtolower($nombre_asesor));
    $asunto_correo_enviar   = "Bienvenido a " . $nombre_emp . " - Credenciales de Acceso";
    
    // Construir Mensaje HTML con Tema Índigo
    $mensaje_html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenida</title>
        <style>
            body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .header { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); padding: 30px 20px; text-align: center; color: white; }
            .content { padding: 40px 30px; color: #374151; }
            .credentials-box { background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center; }
            .credential-label { font-size: 0.85rem; color: #6b7280; text-transform: uppercase; margin-bottom: 5px; font-weight: 600; }
            .credential-value { font-size: 1.2rem; color: #111827; font-weight: bold; margin-bottom: 15px; font-family: monospace; }
            .btn { display: inline-block; background: #6366f1; color: white; text-decoration: none; padding: 12px 30px; border-radius: 6px; font-weight: bold; margin-top: 20px; }
            .footer { background-color: #1f2937; color: #9ca3af; text-align: center; padding: 20px; font-size: 0.85rem; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1 style="margin: 0; font-size: 24px;">¡Bienvenido al Equipo!</h1>
            </div>
            <div class="content">
                <p>Hola <strong>' . htmlspecialchars($nombre_asesor) . '</strong>,</p>
                <p>Nos complace darte la bienvenida a <strong>' . htmlspecialchars($nombre_emp) . '</strong>. Tu cuenta de asesor ha sido creada exitosamente. A continuación encontrarás tus credenciales para acceder a la plataforma:</p>
                
                <div class="credentials-box">
                    <div class="credential-label">Usuario / Cuenta</div>
                    <div class="credential-value">' . htmlspecialchars($usuario) . '</div>
                    
                    <div class="credential-label">Contraseña Inicial</div>
                    <div class="credential-value">' . htmlspecialchars($contrasena) . '</div>
                    
                    <p style="font-size: 0.8rem; color: #ef4444; margin-top: 10px;">* Por seguridad, te recomendamos cambiar tu contraseña al iniciar sesión.</p>
                </div>
                
                <p>Para comenzar, ingresa al sistema haciendo clic en el siguiente botón:</p>
                
                <div style="text-align: center;">
                    <a href="' . (isset($info_empresa_data['url_pag']) ? $info_empresa_data['url_pag'] : '#') . '" class="btn">Iniciar Sesión</a>
                </div>
            </div>
            <div class="footer">
                <p>' . htmlspecialchars($nombre_emp) . ' | Contacto: ' . htmlspecialchars($telefono_emp) . '</p>
                <p>' . htmlspecialchars($direccion_emp) . ', ' . htmlspecialchars($ciudad_emp) . '</p>
                <p>&copy; ' . date('Y') . ' Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
    </html>';

    // Texto plano alternativo
    $mensaje_texto = "Hola " . $nombre_asesor . ",\n\n";
    $mensaje_texto .= "Bienvenido a " . $nombre_emp . ". Tu cuenta ha sido creada.\n\n";
    $mensaje_texto .= "Tus credenciales de acceso son:\n";
    $mensaje_texto .= "Usuario: " . $usuario . "\n";
    $mensaje_texto .= "Contraseña: " . $contrasena . "\n\n";
    $mensaje_texto .= "Por favor ingresa al sistema y cambia tu contraseña.\n";

    try {
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
        if (empty($Host) || empty($Username) || empty($Password)) { echo json_encode(['success' => false, 'message' => 'Configuración SMTP incompleta.']); exit; }
        
        $mail->setFrom($Username, $nombre_emisor);
        $mail->addAddress($email_destino, $nombre_receptor);
        $mail->Subject = $asunto_correo_enviar;
        $mail->isHTML(true);
        $mail->Body = $mensaje_html;        
        $mail->AltBody = $mensaje_texto;
        // Enviar correo
        if ($mail->Send()) { echo json_encode(['success' => true, 'message' => 'Credenciales enviadas correctamente a ' . $email_destino]); } else { echo json_encode(['success' => false, 'message' => 'No se pudo enviar el correo: ' . $mail->ErrorInfo]); }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
