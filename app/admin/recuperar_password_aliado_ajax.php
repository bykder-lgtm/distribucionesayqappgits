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
if (!$info_empresa_data) { return array('success' => false, 'mensaje' => 'No se encontró información de la empresa'); }

$titulo_emp                                                          = isset($info_empresa_data['titulo']) ? $info_empresa_data['titulo'] : '';
$nombre_emp                                                          = isset($info_empresa_data['nombre']) ? $info_empresa_data['nombre'] : 'Sistema';
$eslogan_emp                                                         = isset($info_empresa_data['eslogan']) ? $info_empresa_data['eslogan'] : '';
$direccion_emp                                                       = isset($info_empresa_data['direccion']) ? $info_empresa_data['direccion'] : '';
$ciudad_emp                                                          = isset($info_empresa_data['ciudad']) ? $info_empresa_data['ciudad'] : '';
$telefono_emp                                                        = isset($info_empresa_data['telefono']) ? $info_empresa_data['telefono'] : '';
$correo_emp                                                          = isset($info_empresa_data['correo']) ? $info_empresa_data['correo'] : '';
$url_pag                                                             = isset($info_empresa_data['url_pag']) ? $info_empresa_data['url_pag'] : '';
$logotipo_emp                                                        = isset($info_empresa_data['logotipo']) ? $info_empresa_data['logotipo'] : '';
$desarrollador_emp                                                   = isset($info_empresa_data['desarrollador']) ? $info_empresa_data['desarrollador'] : 'Desarrollador';
$pag_desarrollador_emp                                               = isset($info_empresa_data['pag_desarrollador']) ? $info_empresa_data['pag_desarrollador'] : '#';

if (isset($_POST['cod_administrador']) && isset($_POST['correo'])) {
    $cod_administrador                                                   = intval($_POST['cod_administrador']);
    $correo                                                              = trim($_POST['correo']);
    $nombre_aliado                                                       = isset($_POST['nombre_aliado']) ? trim($_POST['nombre_aliado']) : 'Aliado';
    // Verificar que el aliado existe
    $sql_check = "SELECT cod_administrador, correo_tercero, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $result_check = mysqli_query($conectar, $sql_check);
    if (mysqli_num_rows($result_check) == 0) { echo json_encode(['success' => false, 'mensaje' => 'El aliado no existe']); exit; }

    $data_aliado = mysqli_fetch_assoc($result_check);
    $correo_aliado                                                      = $data_aliado['correo_tercero'];
    $nombre_completo                                                    = $data_aliado['nombres_apellidos_tercero'];
    // Generar contraseña temporal aleatoria de 8 caracteres
    $caracteres                                                         = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
    $password_temporal                                                  = '';
    $longitud                                                           = 8;
    
    for ($i = 0; $i < $longitud; $i++) { $password_temporal .= $caracteres[rand(0, strlen($caracteres) - 1)]; }
    // Encriptar la contraseña con SHA1 para guardarla en la base de datos
    $password_encriptada                                                = sha1($password_temporal);
    // Actualizar la contraseña en la base de datos
    $sql_update = "UPDATE tbl15_administrador SET contrasena = '$password_encriptada' WHERE cod_administrador = '$cod_administrador'";
    $exec_update = mysqli_query($conectar, $sql_update);
    if (!$exec_update) { echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar la contraseña en la base de datos']); exit; }
    // Configuración del correo
    $nombre_emisor                                                       = ucwords(strtolower($nombre_emp));
    $correo_emisor                                                       = $Username; // El correo emisor es el configurado en SMTP
    $nombre_receptor                                                     = ucwords(strtolower($nombre_aliado));
    $correo_receptor                                                     = $correo_aliado;
    $asunto_correo_enviar                                                = "Recuperación de Contraseña - Sistema de Distribuciones";
    try {
        $mensaje_html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
                .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 30px 20px; text-align: center; }
                .header h1 { margin: 0; font-size: 24px; }
                .content { padding: 30px 20px; }
                .password-box { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 20px; border-radius: 8px; text-align: center; margin: 20px 0; }
                .password-box h2 { margin: 0 0 10px 0; font-size: 16px; font-weight: normal; }
                .password-box .password { font-size: 32px; font-weight: bold; letter-spacing: 4px; font-family: monospace; }
                .info-box { background: #f0fdf4; border-left: 4px solid #10b981; padding: 15px; margin: 20px 0; }
                .warning-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; }
                .footer { background: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; }
                .button { display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>🔐 Recuperación de Contraseña</h1>
                </div>
                <div class="content">
                    <p>Hola <strong>' . htmlspecialchars($nombre_completo) . '</strong>,</p>
                    <p>Se ha generado una nueva contraseña temporal para tu cuenta en el Sistema de Distribuciones.</p>
                    
                    <div class="password-box">
                        <h2>Tu nueva contraseña temporal es:</h2>
                        <div class="password">' . htmlspecialchars($password_temporal) . '</div>
                    </div>
                    
                    <div class="info-box">
                        <strong>✓ Instrucciones:</strong>
                        <ul style="margin: 10px 0; padding-left: 20px;">
                            <li>Usa esta contraseña para iniciar sesión en el sistema</li>
                            <li>Puedes cambiarla desde tu perfil después de iniciar sesión</li>
                            <li>Guarda esta contraseña en un lugar seguro</li>
                        </ul>
                    </div>
                    
                    <div class="warning-box">
                        <strong>⚠️ Importante:</strong>
                        <ul style="margin: 10px 0; padding-left: 20px;">
                            <li>Esta contraseña es confidencial y personal</li>
                            <li>No la compartas con nadie</li>
                            <li>Si no solicitaste este cambio, contacta al administrador</li>
                        </ul>
                    </div>
                    
                    <p style="text-align: center;">
                        <a href="https://distribucionesayq.com/app/admin/entrar_escoger_intern.php" class="button">Ir al Sistema</a>
                    </p>
                </div>
                <div class="footer">
                    <p><strong>Sistema de Distribuciones</strong></p>
                    <p>Este es un correo automático, por favor no responder.</p>
                    <p>© ' . date('Y') . ' Todos los derechos reservados.</p>
                </div>
            </div>
        </body>
        </html>
        ';
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
        $mail->setFrom($Username, $nombre_emisor); // Usar Username como remitente
        $mail->addAddress($correo_receptor, $nombre_receptor);
        $mail->Subject = $asunto_correo_enviar;
        $mail->isHTML(true);
        $mail->Body = $mensaje_html;        
        // Credenciales del correo - IMPORTANTE: Configurar con las credenciales reales
        $mail->AltBody = "Hola $nombre_completo,\n\nTu nueva contraseña temporal es: $password_temporal\n\nUsa esta contraseña para iniciar sesión en el sistema.\n\nSistema de Distribuciones";
        // Enviar correo
        if ($mail->Send()) {
            echo json_encode(['success' => true, 'mensaje' => 'Contraseña temporal enviada al correo ' . $correo_aliado, 'password_temporal' => $password_temporal]);
        } else {
            // Si falla el envío del correo, revertir el cambio de contraseña sería ideal
            // Pero por ahora solo informamos del error
            echo json_encode(['success' => false, 'mensaje' => 'La contraseña fue actualizada pero no se pudo enviar el correo: ' . $mail->ErrorInfo]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']);
}
?>
