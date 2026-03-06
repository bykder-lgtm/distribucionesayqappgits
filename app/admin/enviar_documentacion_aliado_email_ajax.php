<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'mensaje' => 'Sesión no iniciada']); exit; }

// Obtener datos
$correo_receptor = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$zip_path = isset($_POST['zip_path']) ? trim($_POST['zip_path']) : '';
$nombre_aliado = isset($_POST['nombre_aliado']) ? trim($_POST['nombre_aliado']) : 'Aliado';

if (empty($correo_receptor) || !filter_var($correo_receptor, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success' => false, 'mensaje' => 'Correo electrónico no válido']); exit; }
if (empty($zip_path)) { echo json_encode(['success' => false, 'mensaje' => 'Ruta del archivo no válida']); exit; }
// La ruta viene como 'archivador/temp_zips/archivo.zip' relativa a app/
$ruta_completa = dirname(__DIR__) . '/' . $zip_path;
if (!file_exists($ruta_completa)) { echo json_encode(['success' => false, 'mensaje' => 'El archivo ZIP no existe en el servidor: ' . $zip_path]); exit; }

require_once '../PHPMailer/PHPMailerAutoload.php';

// Obtener configuración SMTP
$sql_info_correo_smtp = "SELECT * FROM tbl15_correo_smtp WHERE (cod_estado_correo_predeterminado = '1' AND cod_estado = '1')";
$resultado_info_correo_smtp = mysqli_query($conectar, $sql_info_correo_smtp);
$info_correo_smtp = mysqli_fetch_assoc($resultado_info_correo_smtp);

if (!$info_correo_smtp) { echo json_encode(['success' => false, 'mensaje' => 'No se encontró configuración SMTP activa']); exit; }

// Obtener información de la empresa
$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa = mysqli_fetch_assoc($resultado_info_empresa);
$nombre_empresa = isset($info_empresa['nombre_info_empresa']) ? $info_empresa['nombre_info_empresa'] : 'Distribuciones AYQ';

try {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $info_correo_smtp['host_correo_smtp'];
    $mail->SMTPAuth = true;
    $mail->Username = $info_correo_smtp['nombre_correo_smtp'];
    $mail->Password = $info_correo_smtp['contrasena_app_correo_smtp'];
    $mail->SMTPSecure = $info_correo_smtp['secure_correo_smtp'];
    $mail->Port = intval($info_correo_smtp['port_correo_smtp']);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($info_correo_smtp['nombre_correo_smtp'], $nombre_empresa);
    $mail->addAddress($correo_receptor);
    $mail->Subject = "Documentación Legal - " . $nombre_aliado;
    $mail->isHTML(true);

    $mensaje = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e7eb; border-radius: 12px;'>
        <h2 style='color: #3b82f6;'>Documentación de Aliado</h2>
        <p>Cordial saludo,</p>
        <p>Adjunto a este correo encontrará los documentos legales comprimidos del aliado <strong>$nombre_aliado</strong>.</p>
        <div style='background: #f3f4f6; padding: 15px; border-radius: 8px; margin: 20px 0;'>
            <p style='margin: 0; font-size: 14px; color: #4b5563;'>Este es un envío automático desde el sistema de gestión.</p>
        </div>
        <p style='font-size: 12px; color: #9ca3af; text-align: center;'>&copy; " . date('Y') . " $nombre_empresa. Todos los derechos reservados.</p>
    </div>
    ";

    $mail->Body = $mensaje;
    
    // Adjuntar el archivo ZIP
    $mail->addAttachment($ruta_completa, basename($ruta_completa));

    if($mail->send()) {
        echo json_encode(['success' => true, 'mensaje' => 'Correo enviado exitosamente a ' . $correo_receptor]);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al enviar el correo: ' . $mail->ErrorInfo]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'mensaje' => 'Excepción al enviar correo: ' . $e->getMessage()]);
}
?>
