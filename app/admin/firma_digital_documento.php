<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
// ============================================
// VALIDACIONES DE SEGURIDAD AL CARGAR LA PÁGINA
// ============================================
// 1. Validar que lleguen los parámetros necesarios
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$hash_seguridad = isset($_GET['hash']) ? trim($_GET['hash']) : '';

if (empty($token) || empty($hash_seguridad)) { die('<h1>Error: Enlace inválido</h1><p>El enlace de firma no es válido o está incompleto.</p>'); }
// 2. Validar formato del token
if (strlen($token) !== 64 || !ctype_xdigit($token)) { die('<h1>Error: Token inválido</h1><p>El token de firma no tiene un formato válido.</p>'); }
// 3. Buscar el documento en la base de datos
$sql_documento = "SELECT f.cod_firma_digital_documento, f.cod_aliado_estrategico, f.nombre_tipo_firma_digital, f.fecha_creacion_registro_firma_digital_documento,
f.cod_estado_firma_signature, f.cod_estado, f.ip_maquina as ip_creador, a.nombres, a.apellidos, a.correo, a.identificacion
FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador
WHERE f.token_firma_digital_documento = ? AND f.cod_estado = 1";
$stmt = mysqli_prepare($conectar, $sql_documento);
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) { die('<h1>Error: Documento no encontrado</h1><p>El documento de firma no existe o ha sido desactivado.</p>'); }

$documento = mysqli_fetch_assoc($result);

// 4. Validar si ya fue firmado
if ($documento['cod_estado_firma_signature'] == 1) { die('<h1>Documento ya firmado</h1><p>Este documento ya ha sido firmado exitosamente.</p>'); }
// 5. Validar expiración (48 horas)
$fecha_creacion = strtotime($documento['fecha_creacion_registro_firma_digital_documento']);
$fecha_expiracion = $fecha_creacion + (48 * 3600);
$tiempo_restante = $fecha_expiracion - time();

if ($tiempo_restante <= 0) { die('<h1>Enlace expirado</h1><p>Este enlace de firma ha expirado. Por favor, solicite uno nuevo.</p>'); }
// 6. Validar hash de seguridad del servidor
$secret_server_key = SECRET_KEY;
$timestamp_expiracion = $fecha_expiracion;
$datos_para_hash = $token . '|' . $documento['cod_aliado_estrategico'] . '|' . $timestamp_expiracion . '|' . $documento['ip_creador'];
$hash_calculado = hash_hmac('sha256', $datos_para_hash, $secret_server_key);

if (!hash_equals($hash_calculado, $hash_seguridad)) { die('<h1>Error de seguridad</h1><p>El hash de seguridad no coincide. Este enlace puede haber sido manipulado.</p>'); }

$horas_restantes = floor($tiempo_restante / 3600);
$minutos_restantes = floor(($tiempo_restante % 3600) / 60);
$nombre_completo = $documento['nombres'] . ' ' . $documento['apellidos'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Digital - <?php echo htmlspecialchars($documento['nombre_tipo_firma_digital']); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
            background: rgba(26, 31, 46, 0.95);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .header-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
        }
        
        .header-icon i {
            font-size: 2rem;
            color: white;
        }
        
        h1 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }
        
        .info-box {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            color: white;
        }
        
        .info-item:last-child {
            margin-bottom: 0;
        }
        
        .info-item i {
            color: #10b981;
            width: 20px;
        }
        
        .expiration-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .expiration-warning i {
            color: #f59e0b;
            font-size: 1.5rem;
        }
        
        .expiration-warning div {
            flex: 1;
        }
        
        .expiration-warning strong {
            color: #f59e0b;
            display: block;
            margin-bottom: 0.25rem;
        }
        
        .expiration-warning span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
        
        .signature-container {
            background: rgba(255, 255, 255, 0.05);
            border: 2px dashed rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .signature-label {
            color: #10b981;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        #signature-pad {
            width: 100%;
            height: 200px;
            background: white;
            border-radius: 8px;
            cursor: crosshair;
            touch-action: none;
        }
        
        .signature-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.75rem;
        }
        
        button {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }
        
        .btn-clear {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .btn-clear:hover {
            background: rgba(239, 68, 68, 0.3);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            font-size: 1rem;
            padding: 1.25rem;
            margin-top: 1.5rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .security-notice {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-top:</rem;
            text-align: center;
        }
        
        .security-notice i {
            color: #6366f1;
            margin-right: 0.5rem;
        }
        
        .security-notice span {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }
        
        @media (max-width: 640px) {
            .container {
                padding: 1.5rem;
            }
            
            h1 {
                font-size: 1.25rem;
            }
            
            #signature-pad {
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <h1><?php echo htmlspecialchars($documento['nombre_tipo_firma_digital']); ?></h1>
            <p class="subtitle">Firma digital de documento</p>
        </div>
        
        <div class="info-box">
            <div class="info-item"><i class="fa-solid fa-user"></i><strong><?php echo htmlspecialchars($nombre_completo); ?></strong></div>
            <div class="info-item"><i class="fa-solid fa-id-card"></i><span>CC: <?php echo htmlspecialchars($documento['identificacion']); ?></span></div>
            <div class="info-item"><i class="fa-solid fa-envelope"></i><span><?php echo htmlspecialchars($documento['correo']); ?></span></div>
        </div>
        
        <div class="expiration-warning">
            <i class="fa-solid fa-clock"></i><div><strong>Tiempo restante para firmar</strong><span id="tiempo-restante"><?php echo $horas_restantes; ?>h <?php echo $minutos_restantes; ?>m restantes</span></div>
        </div>
        
        <div class="signature-container">
            <div class="signature-label"><i class="fa-solid fa-pen"></i>Dibuje su firma aquí</div>
            <canvas id="signature-pad"></canvas>
            <div class="signature-actions">
                <button type="button" class="btn-clear" onclick="clearSignature()"><i class="fa-solid fa-eraser"></i> Limpiar</button>
            </div>
        </div>
        <button type="button" class="btn-submit" onclick="submitSignature()"><i class="fa-solid fa-check-circle"></i> Firmar Documento</button>
        <div class="security-notice"><i class="fa-solid fa-shield-halved"></i><span>Conexión segura. Su firma está protegida con encriptación.</span></div>
    </div>
    <input type="hidden" id="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="hidden" id="hash" value="<?php echo htmlspecialchars($hash_seguridad); ?>">
    <script>
    // ============================================
    // VALIDACIONES DE SEGURIDAD DEL CLIENTE
    // ============================================
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;
    let hasDrawn = false;
    let lastX = 0;
    let lastY = 0;
    
    // Configurar tamaño del canvas
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
    }
    
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    
    // Funciones de dibujo
    function startDrawing(e) {
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        const x = (e.clientX || e.touches[0].clientX) - rect.left;
        const y = (e.clientY || e.touches[0].clientY) - rect.top;
        lastX = x;
        lastY = y;
    }
    
    function draw(e) {
        if (!isDrawing) return;
        e.preventDefault();
        
        hasDrawn = true;
        const rect = canvas.getBoundingClientRect();
        const x = (e.clientX || e.touches[0].clientX) - rect.left;
        const y = (e.clientY || e.touches[0].clientY) - rect.top;
        
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.stroke();
        
        lastX = x;
        lastY = y;
    }
    
    function stopDrawing() {
        isDrawing = false;
    }
    
    // Event listeners para mouse
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Event listeners para touch
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    
    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        hasDrawn = false;
    }
    
    async function submitSignature() {
        // Validación 1: Verificar que se haya dibujado algo
        if (!hasDrawn) {
            Swal.fire({
                icon: 'warning',
                title: 'Firma requerida',
                text: 'Por favor dibuje su firma antes de continuar',
                background: '#1a1f2e',
                color: 'white'
            });
            return;
        }
        
        // Validación 2: Confirmar acción
        const result = await Swal.fire({
            icon: 'question',
            title: '¿Confirmar firma?',
            text: 'Una vez firmado, no podrá modificar el documento',
            showCancelButton: true,
            confirmButtonText: 'Sí, firmar',
            cancelButtonText: 'Cancelar',
            background: '#1a1f2e',
            color: 'white',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#ef4444'
        });
        
        if (!result.isConfirmed) return;
        
        // Mostrar loading
        Swal.fire({
            title: 'Procesando firma...',
            html: 'Por favor espere',
            allowOutsideClick: false,
            background: '#1a1f2e',
            color: 'white',
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Convertir firma a base64
        const firmaBase64 = canvas.toDataURL('image/png');
        const token = document.getElementById('token').value;
        const hash = document.getElementById('hash').value;
        
        // Enviar firma al servidor
        try {
            const response = await fetch('../ajax/procesar_firma_digital.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    token: token,
                    hash: hash,
                    firma: firmaBase64
                })
            });
            
            const data = await response.json();
            
            Swal.close();
            
            if (data.success) {
                await Swal.fire({
                    icon: 'success',
                    title: '¡Firma exitosa!',
                    text: data.mensaje,
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#10b981'
                });
                
                // Redirigir o cerrar
                window.location.href = 'firma_exitosa.php';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error,
                    background: '#1a1f2e',
                    color: 'white'
                });
            }
        } catch (error) {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo procesar la firma. Verifique su conexión.',
                background: '#1a1f2e',
                color: 'white'
            });
        }
    }
    
    // Actualizar contador de tiempo
    let tiempoRestanteSegundos = <?php echo $tiempo_restante; ?>;
    setInterval(() => {
        tiempoRestanteSegundos--;
        if (tiempoRestanteSegundos <= 0) {
            location.reload();
        }
        
        const horas = Math.floor(tiempoRestanteSegundos / 3600);
        const minutos = Math.floor((tiempoRestanteSegundos % 3600) / 60);
        document.getElementById('tiempo-restante').textContent = `${horas}h ${minutos}m restantes`;
    }, 60000); // Actualizar cada minuto
    </script>
</body>
</html>
<?php mysqli_close($conectar); ?>
