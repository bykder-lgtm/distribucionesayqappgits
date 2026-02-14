<?php
/**
 * Script de prueba para verificar la configuración SMTP
 * Ejecutar este archivo para verificar que el servidor SMTP esté configurado correctamente
 */

include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/smtp_conf_correo.php');

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Prueba de Configuración SMTP</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        .container { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #6366f1; }
        .info { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 15px 0; }
        .success { background: #f0fdf4; border-left: 4px solid #10b981; padding: 15px; margin: 15px 0; }
        .error { background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 15px 0; }
        .warning { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 15px 0; }
        code { background: #f1f5f9; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; }
        .btn { display: inline-block; padding: 10px 20px; background: #6366f1; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🔧 Prueba de Configuración SMTP</h1>";

echo "<h2>📊 Configuración Actual</h2>";
echo "<table>";
echo "<tr><th>Parámetro</th><th>Valor</th><th>Estado</th></tr>";

// Verificar Host
$host_status = !empty($Host) ? "✅ OK" : "❌ Vacío";
$host_class = !empty($Host) ? "success" : "error";
echo "<tr><td><strong>Host SMTP</strong></td><td><code>" . htmlspecialchars($Host ?? '') . "</code></td><td class='$host_class'>$host_status</td></tr>";

// Verificar Puerto
$port_status = !empty($Port) ? "✅ OK" : "❌ Vacío";
$port_class = !empty($Port) ? "success" : "error";
echo "<tr><td><strong>Puerto</strong></td><td><code>" . htmlspecialchars($Port ?? '') . "</code></td><td class='$port_class'>$port_status</td></tr>";

// Verificar Username
$user_status = !empty($Username) ? "✅ OK" : "❌ Vacío";
$user_class = !empty($Username) ? "success" : "error";
echo "<tr><td><strong>Usuario</strong></td><td><code>" . htmlspecialchars($Username ?? '') . "</code></td><td class='$user_class'>$user_status</td></tr>";

// Verificar Password
$pass_status = !empty($Password) ? "✅ OK" : "❌ Vacío";
$pass_class = !empty($Password) ? "success" : "error";
$pass_display = !empty($Password) ? str_repeat('*', min(strlen($Password), 20)) : '';
echo "<tr><td><strong>Contraseña</strong></td><td><code>$pass_display</code></td><td class='$pass_class'>$pass_status</td></tr>";

// Verificar SMTPSecure
$secure_status = !empty($SMTPSecure) ? "✅ OK" : "⚠️ Sin definir";
$secure_class = !empty($SMTPSecure) ? "success" : "warning";
echo "<tr><td><strong>Seguridad</strong></td><td><code>" . htmlspecialchars($SMTPSecure ?? 'none') . "</code></td><td class='$secure_class'>$secure_status</td></tr>";

// Verificar SMTPAuth
$auth_display = ($SMTPAuth == '1' || $SMTPAuth === true || strtolower($SMTPAuth) == 'true') ? 'Sí' : 'No';
$auth_status = ($SMTPAuth == '1' || $SMTPAuth === true || strtolower($SMTPAuth) == 'true') ? "✅ OK" : "⚠️ Desactivado";
$auth_class = ($SMTPAuth == '1' || $SMTPAuth === true || strtolower($SMTPAuth) == 'true') ? "success" : "warning";
echo "<tr><td><strong>Autenticación</strong></td><td><code>$auth_display</code></td><td class='$auth_class'>$auth_status</td></tr>";

echo "</table>";

// Verificación general
$configuracion_completa = !empty($Host) && !empty($Port) && !empty($Username) && !empty($Password);

if ($configuracion_completa) {
    echo "<div class='success'>";
    echo "<h3>✅ Configuración Completa</h3>";
    echo "<p>Todos los parámetros necesarios están configurados.</p>";
    echo "</div>";
} else {
    echo "<div class='error'>";
    echo "<h3>❌ Configuración Incompleta</h3>";
    echo "<p>Faltan parámetros necesarios para el envío de correos. Verifica la configuración en el panel de administración.</p>";
    echo "</div>";
}

// Información adicional
echo "<h2>📝 Información Adicional</h2>";

echo "<div class='info'>";
echo "<h4>🔍 Ubicación de la Configuración</h4>";
echo "<p>La configuración SMTP se obtiene de:</p>";
echo "<ul>";
echo "<li><strong>Archivo:</strong> <code>../admin/smtp_conf_correo.php</code></li>";
echo "<li><strong>Base de datos:</strong> Tabla <code>tbl15_correo_smtp</code></li>";
echo "<li><strong>Condición:</strong> <code>cod_estado_correo_predeterminado = '1' AND cod_estado = '1'</code></li>";
echo "</ul>";
echo "</div>";

echo "<div class='info'>";
echo "<h4>🔐 Configuración Recomendada para Gmail</h4>";
echo "<ul>";
echo "<li><strong>Host:</strong> smtp.gmail.com</li>";
echo "<li><strong>Puerto:</strong> 587 (TLS) o 465 (SSL)</li>";
echo "<li><strong>Seguridad:</strong> tls o ssl</li>";
echo "<li><strong>Usuario:</strong> tu_email@gmail.com</li>";
echo "<li><strong>Contraseña:</strong> Contraseña de aplicación (no la contraseña normal)</li>";
echo "</ul>";
echo "<p><strong>⚠️ Importante:</strong> Para Gmail debes generar una 'Contraseña de aplicación' desde tu cuenta de Google.</p>";
echo "<p>Ve a: <a href='https://myaccount.google.com/apppasswords' target='_blank'>https://myaccount.google.com/apppasswords</a></p>";
echo "</div>";

echo "<div class='info'>";
echo "<h4>📧 Configuración Recomendada para Outlook/Office365</h4>";
echo "<ul>";
echo "<li><strong>Host:</strong> smtp.office365.com</li>";
echo "<li><strong>Puerto:</strong> 587</li>";
echo "<li><strong>Seguridad:</strong> tls</li>";
echo "<li><strong>Usuario:</strong> tu_email@outlook.com</li>";
echo "<li><strong>Contraseña:</strong> Tu contraseña normal de Outlook</li>";
echo "</ul>";
echo "</div>";

// Verificar PHPMailer
echo "<h2>📦 Verificación de Dependencias</h2>";

$phpmailer_path = '../PHPMailer/class.phpmailer.php';
$smtp_path = '../PHPMailer/class.smtp.php';

if (file_exists($phpmailer_path)) { echo "<div class='success'>✅ PHPMailer encontrado: <code>$phpmailer_path</code></div>"; } else { echo "<div class='error'>❌ PHPMailer NO encontrado: <code>$phpmailer_path</code></div>"; }
if (file_exists($smtp_path)) { echo "<div class='success'>✅ SMTP class encontrada: <code>$smtp_path</code></div>"; } else { echo "<div class='error'>❌ SMTP class NO encontrada: <code>$smtp_path</code></div>"; }
echo "<a href='lista_aliado_coordinador_movil.php' class='btn'>← Volver a Aliados</a>";
echo "</div>
</body>
</html>";
?>
