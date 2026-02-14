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
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <title>Recuperación de Contraseña</title>
        </head>
        <body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: Arial, Helvetica, sans-serif;">
            <!-- Wrapper principal -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
                <tr>
                    <td align="center">
                        <!-- Container principal -->
                        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; max-width: 600px;">
                            
                            <!-- HEADER -->
                            <tr>
                                <td align="center" style="background-color: #10b981; padding: 30px 20px;">
                                    <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold;">🔐 Recuperación de Contraseña</h1>
                                </td>
                            </tr>
                            
                            <!-- DIVIDER -->
                            <tr>
                                <td style="background-color: #059669; height: 4px; line-height: 4px; font-size: 1px;">&nbsp;</td>
                            </tr>
                            
                            <!-- CONTENT -->
                            <tr>
                                <td style="padding: 30px 20px; background-color: #ffffff;">
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 15px;">Hola <strong style="color: #10b981;">' . htmlspecialchars($nombre_completo) . '</strong>,</p>
                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 25px;">Se ha generado una nueva contraseña temporal para tu cuenta en el Sistema de Distribuciones.</p>
                                </td>
                            </tr>
                            
                            <!-- PASSWORD BOX -->
                            <tr>
                                <td align="center" style="padding: 0 20px 30px;">
                                    <table width="90%" cellpadding="0" cellspacing="0" border="0" style="background-color: #10b981; border-radius: 10px; max-width: 500px;">
                                        <tr>
                                            <td align="center" style="padding: 25px 20px;">
                                                <p style="color: #ffffff; font-size: 16px; margin: 0 0 15px; font-weight: normal;">Tu nueva contraseña temporal es:</p>
                                                <p style="color: #ffffff; font-size: 32px; font-weight: bold; letter-spacing: 4px; font-family: Courier, monospace; margin: 0; word-break: break-all;">' . htmlspecialchars($password_temporal) . '</p>
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
                                                <p style="color: #065f46; font-size: 14px; margin: 0 0 10px; font-weight: bold;">✓ Instrucciones:</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="color: #047857; font-size: 14px; line-height: 1.8; padding-left: 15px;">
                                                            • Usa esta contraseña para iniciar sesión en el sistema<br>
                                                            • Puedes cambiarla desde tu perfil después de iniciar sesión<br>
                                                            • Guarda esta contraseña en un lugar seguro
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
                                                            • Esta contraseña es confidencial y personal<br>
                                                            • No la compartas con nadie<br>
                                                            • Si no solicitaste este cambio, contacta al administrador
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- BUTTON -->
                            <tr>
                                <td align="center" style="padding: 10px 20px 30px;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td align="center" style="background-color: #10b981; border-radius: 8px;">
                                                <a href="https://distribucionesayq.com/app/admin/entrar_escoger_intern.php" style="display: block; color: #ffffff; text-decoration: none; padding: 14px 35px; font-size: 16px; font-weight: bold;">Ir al Sistema</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- FOOTER -->
                            <tr>
                                <td align="center" style="background-color: #f9fafb; padding: 25px 20px;">
                                    <p style="color: #374151; font-size: 14px; margin: 0 0 8px; font-weight: bold;">Sistema de Distribuciones</p>
                                    <p style="color: #6b7280; font-size: 12px; margin: 0 0 8px;">Este es un correo automático, por favor no responder.</p>
                                    <p style="color: #6b7280; font-size: 12px; margin: 0;">© ' . date('Y') . ' Todos los derechos reservados.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
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
