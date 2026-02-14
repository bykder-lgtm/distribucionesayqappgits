<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

$anyo_actual                                                         = date("Y");
$fecha_hoy                                                           = date("Y-m-d");
$hora_hoy                                                            = date("H:i:s");
$fecha_ymd_his                                                       = date("Y-m-d H:i:s");
$fecha_time                                                          = time();
/** * Función para enviar correo de bienvenida a un nuevo aliado * con sus credenciales de acceso al sistema */
function enviarCorreoBienvenidaAliado($conectar, $cod_administrador, $nombres, $apellidos, $correo_aliado, $cuenta, $identificacion_tercero) {
    // Definir variables de fecha y hora
    $anyo_actual                                                         = date("Y");
    $fecha_hoy                                                           = date("Y-m-d");
    $hora_hoy                                                            = date("H:i:s");
    $fecha_ymd_his                                                       = date("Y-m-d H:i:s");
    $fecha_time                                                          = time();
    // Verificar que el correo no esté vacío
    if (empty($correo_aliado) || !filter_var($correo_aliado, FILTER_VALIDATE_EMAIL)) { return array('success' => false, 'mensaje' => 'Correo electrónico no válido'); }
    
    require_once '../PHPMailer/PHPMailerAutoload.php';
    // Obtener configuración SMTP directamente (no usar include porque $conectar no está en scope global)
    $sql_info_correo_smtp = "SELECT * FROM tbl15_correo_smtp WHERE (cod_estado_correo_predeterminado = '1' AND cod_estado = '1')";
    $resultado_info_correo_smtp = mysqli_query($conectar, $sql_info_correo_smtp);
    $info_emprecorreo_smtp = mysqli_fetch_assoc($resultado_info_correo_smtp);
    if (!$info_emprecorreo_smtp) { return array('success' => false, 'mensaje' => 'No se encontró configuración SMTP'); }
    
    $Host                                                                = $info_emprecorreo_smtp['host_correo_smtp'];
    $SMTPAuth                                                            = $info_emprecorreo_smtp['auth_correo_smtp'];
    $Username                                                            = $info_emprecorreo_smtp['nombre_correo_smtp'];
    $Password                                                            = $info_emprecorreo_smtp['contrasena_app_correo_smtp'];
    $SMTPSecure                                                          = $info_emprecorreo_smtp['secure_correo_smtp'];
    $Port                                                                = $info_emprecorreo_smtp['port_correo_smtp'];
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
    // Configuración del correo
    $nombre_emisor                                                       = ucwords(strtolower($nombre_emp));
    $correo_emisor                                                       = $Username; // El correo emisor es el configurado en SMTP
    $nombre_receptor                                                     = ucwords(strtolower($nombres . ' ' . $apellidos));
    $correo_receptor                                                     = $correo_aliado;
    $asunto_correo_enviar                                                = "Bienvenido a " . ucwords(strtolower($nombre_emp)) . " - Sus credenciales de acceso";
    // Contraseña inicial (número de identificación)
    $contrasena_inicial                                                  = $identificacion_tercero;
    // URL de acceso al sistema
    $url_acceso                                                          = $url_pag . "/app/admin/entrar_escoger_intern.php";
    if (empty($url_pag)) { $url_acceso = "Su URL de acceso al sistema"; }
    // ========================================================================================
    // DISEÑO DEL CORREO HTML PROFESIONAL
    // ========================================================================================
    $mensaje = "
    <!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='x-apple-disable-message-reformatting'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Bienvenido - Credenciales de Acceso</title>
    </head>
    <body style='margin: 0; padding: 0; background-color: #f5f5f5; font-family: Arial, Helvetica, sans-serif;'>
        <!-- Wrapper principal -->
        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #f5f5f5; padding: 20px 0;'>
            <tr>
                <td align='center'>
                    <!-- Container principal -->
                    <table width='600' cellpadding='0' cellspacing='0' border='0' style='background-color: #ffffff; max-width: 600px;'>
                        
                        <!-- HEADER -->
                        <tr>
                            <td align='center' style='background-color: #2c5aa0; padding: 30px 20px;'>
                                <h1 style='color: #ffffff; margin: 0; font-size: 26px; font-weight: bold; text-transform: uppercase;'>" . htmlspecialchars($nombre_emp) . "</h1>
                                <p style='color: #ffffff; margin: 8px 0 0; font-size: 14px;'>" . htmlspecialchars($eslogan_emp) . "</p>
                            </td>
                        </tr>
                        <!-- DIVIDER -->
                        <tr>
                            <td style='background-color: #28a745; height: 4px; line-height: 4px; font-size: 1px;'>&nbsp;</td>
                        </tr>
                        <!-- WELCOME SECTION -->
                        <tr>
                            <td align='center' style='background-color: #f8f9fa; padding: 40px 20px;'>
                                <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                    <tr>
                                        <td align='center'>
                                            <div style='width: 80px; height: 80px; background-color: #28a745; border-radius: 50%; margin: 0 auto 20px; line-height: 80px; text-align: center;'>
                                                <span style='color: #ffffff; font-size: 36px; font-weight: bold;'>✓</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center'>
                                            <h2 style='color: #2c5aa0; font-size: 22px; margin: 0 0 15px; font-weight: bold;'>¡Bienvenido(a), " . htmlspecialchars(ucwords(strtolower($nombres))) . "!</h2>
                                            <p style='color: #444444; font-size: 16px; line-height: 1.6; margin: 0;'>Su cuenta como <strong style='color: #2c5aa0;'>Aliado Estratégico</strong> ha sido creada exitosamente.<br>A continuación encontrará sus credenciales de acceso al sistema.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- CREDENTIALS SECTION -->
                <tr>
                    <td align='center' style='padding: 30px 20px; background-color: #ffffff;'>
                        <table width='90%' cellpadding='0' cellspacing='0' border='0' style='background-color: #6366f1; border-radius: 10px; max-width: 500px;'>
                            <tr>
                                <td align='center' style='padding: 25px 20px;'>
                                    <p style='color: #ffffff; font-size: 18px; font-weight: bold; margin: 0 0 20px; text-transform: uppercase;'>🔐 Sus Credenciales de Acceso</p>
                                    
                                    <!-- Usuario -->
                                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #ffffff; border-radius: 8px; margin-bottom: 15px;'>
                                        <tr>
                                            <td style='padding: 15px 20px;'>
                                                <p style='color: #666666; font-size: 12px; margin: 0 0 5px; text-transform: uppercase; font-weight: bold;'>👤 Usuario</p>
                                                <p style='color: #000000; font-size: 18px; font-weight: bold; margin: 0; word-break: break-all;'>" . htmlspecialchars($cuenta) . "</p>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <!-- Contraseña -->
                                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #ffffff; border-radius: 8px;'>
                                        <tr>
                                            <td style='padding: 15px 20px;'>
                                                <p style='color: #666666; font-size: 12px; margin: 0 0 5px; text-transform: uppercase; font-weight: bold;'>🔑 Contraseña Temporal</p>
                                                <p style='color: #000000; font-size: 18px; font-weight: bold; margin: 0; word-break: break-all;'>" . htmlspecialchars($contrasena_inicial) . "</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- WARNING SECTION -->
                <tr>
                    <td style='padding: 0 20px 30px;'>
                        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #fff3cd; border-left: 4px solid #ffc107;'>
                            <tr>
                                <td style='padding: 20px;'>
                                    <p style='color: #856404; font-size: 14px; margin: 0; line-height: 1.6;'><strong style='color: #664d03;'>⚠️ IMPORTANTE:</strong> Por seguridad, al iniciar sesión por primera vez, el sistema le solicitará cambiar su contraseña. Le recomendamos elegir una contraseña segura que contenga letras, números y caracteres especiales.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- INFO SECTION -->
                <tr>
                    <td style='padding: 30px 20px; background-color: #e8f4fd;'>
                        <h3 style='color: #2c5aa0; font-size: 18px; margin: 0 0 15px; font-weight: bold;'>📋 Primeros Pasos</h3>
                        <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                            <tr>
                                <td style='color: #333333; font-size: 14px; line-height: 1.8; padding-left: 20px;'>
                                    • Ingrese al sistema con las credenciales proporcionadas<br>
                                    • Cambie su contraseña temporal por una personal y segura<br>
                                    • Complete su perfil con la información requerida<br>
                                    • Explore las funcionalidades disponibles para aliados<br>
                                    • Ante cualquier duda, contacte a su asesor asignado
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- BUTTON SECTION -->
                <tr>
                    <td align='center' style='padding: 30px 20px; background-color: #ffffff;'>
                        <table cellpadding='0' cellspacing='0' border='0'>
                            <tr>
                                <td align='center' style='background-color: #28a745; border-radius: 50px;'>
                                    <a href='" . htmlspecialchars($url_acceso) . "' style='display: block; color: #ffffff; text-decoration: none; padding: 15px 40px; font-size: 16px; font-weight: bold; text-transform: uppercase;'>Acceder al Sistema</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <!-- CONTACT INFO -->
                <tr>
                    <td align='center' style='padding: 20px; background-color: #f8f9fa;'>
                        <p style='color: #666666; font-size: 14px; margin: 0 0 10px;'>¿Necesita ayuda? Contáctenos:</p>
                        <p style='color: #2c5aa0; font-size: 14px; margin: 0; font-weight: bold;'>
                            📞 " . htmlspecialchars($telefono_emp) . " &nbsp;|&nbsp; 
                            ✉️ " . htmlspecialchars($correo_emp) . "
                        </p>
                        <p style='color: #666666; font-size: 13px; margin: 10px 0 0;'>
                            📍 " . htmlspecialchars($direccion_emp) . ", " . htmlspecialchars($ciudad_emp) . "
                        </p>
                    </td>
                </tr>
                <!-- FOOTER -->
                <tr>
                    <td align='center' style='background-color: #2c5aa0; padding: 25px 20px;'>
                        <p style='color: #ffffff; font-size: 14px; margin: 0 0 8px; font-weight: bold;'>" . htmlspecialchars($nombre_emp) . "</p>
                        <p style='color: #ffffff; font-size: 12px; margin: 0;'>&copy; " . $anyo_actual . " Todos los derechos reservados</p>
                        <p style='color: #ffffff; font-size: 11px; margin: 12px 0 0;'>Desarrollado por <a href='" . htmlspecialchars($pag_desarrollador_emp) . "' style='color: #90caf9; text-decoration: none;'>" . htmlspecialchars($desarrollador_emp) . "</a></p>
                        <p style='color: #cccccc; font-size: 10px; margin: 12px 0 0;'>Este correo fue enviado automáticamente. Por favor no responda a este mensaje.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
    </body>
    </html>";
    // ========================================================================================
    // ENVÍO DEL CORREO
    // ========================================================================================
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
        $mail->setFrom($Username, $nombre_emisor); // Usar Username como remitente
        $mail->addAddress($correo_receptor, $nombre_receptor);
        $mail->Subject = $asunto_correo_enviar;
        $mail->isHTML(true);
        $mail->Body = $mensaje;
        
        if(!$mail->send()) { $cod_estado_envio_correo = 0; $nombre_estado_envio_correo = "No Enviado"; $descripcion_error_envio_correo = $mail->ErrorInfo; } else { $cod_estado_envio_correo = 1; $nombre_estado_envio_correo = "Enviado Correctamente"; $descripcion_error_envio_correo = ""; }
         // Registrar el envío en la base de datos
        $cod_tipo_modulo_envio_correo                                        = "10"; // Tipo para bienvenida aliado
        $nombre_tipo_modulo_envio_correo                                     = "BIENVENIDA ALIADO - CREDENCIALES";
        $id_origen_correo                                                    = $cod_administrador;
        $nombre_tabla_origen_correo                                          = "tbl15_administrador";
        $nombre_campo_origen_correo                                          = "cod_administrador";
        $nombre_origen_correo                                                = "Correo de bienvenida aliado";
        $url_origen_correo                                                   = $_SERVER['PHP_SELF'];

        $sql_envio_correo = "INSERT INTO tbl15_envio_correo (cod_tipo_modulo_envio_correo, nombre_tipo_modulo_envio_correo, id_origen_correo, nombre_tabla_origen_correo, nombre_campo_origen_correo, 
        nombre_origen_correo, correo_emisor, correo_receptor, cod_estado_envio_correo, nombre_estado_envio_correo, descripcion_error_envio_correo, fecha_envio_correo, hora_envio_correo, 
        url_origen_correo, fecha_ymd_his, fecha_time, asunto_correo) 
        VALUES ('$cod_tipo_modulo_envio_correo', '$nombre_tipo_modulo_envio_correo', '$id_origen_correo', '$nombre_tabla_origen_correo', '$nombre_campo_origen_correo', 
        '$nombre_origen_correo', '$correo_emisor', '$correo_receptor', '$cod_estado_envio_correo', '$nombre_estado_envio_correo', '$descripcion_error_envio_correo', '$fecha_hoy', '$hora_hoy', 
        '$url_origen_correo', '$fecha_ymd_his', '$fecha_time', '$asunto_correo_enviar')";
        mysqli_query($conectar, $sql_envio_correo);
        
        return array('success' => ($cod_estado_envio_correo == 1), 'mensaje' => $nombre_estado_envio_correo, 'error' => $descripcion_error_envio_correo);
    } catch (Exception $e) {
        return array('success' => false, 'mensaje' => 'Error al enviar correo', 'error' => $e->getMessage());
    }
}
?>
