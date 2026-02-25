<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
// Fallback para versiones de PHP menores a 5.6.0
if (!function_exists('hash_equals')) { function hash_equals($str1, $str2) { if (strlen($str1) != strlen($str2)) { return false; } else { $res = $str1 ^ $str2; $ret = 0; for ($i = strlen($res) - 1; $i >= 0; $i--) { $ret |= ord($res[$i]); } return !$ret; } } }
// ============================================
// VALIDACIONES DE SEGURIDAD AL CARGAR LA PÁGINA
// ============================================
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$hash_seguridad = isset($_GET['hash']) ? trim($_GET['hash']) : '';

if (empty($token) || empty($hash_seguridad)) { die('<div style="font-family:sans-serif; text-align:center; padding:50px;"><h1 style="color:#ef4444;">Error: Enlace inválido</h1><p>El enlace de firma no es válido o está incompleto.</p></div>'); }
// 1. Buscar el documento en la base de datos
$sql_documento = "SELECT f.cod_firma_digital_documento, f.cod_aliado_estrategico, f.nombre_tipo_firma_digital, f.fecha_creacion_registro_firma_digital_documento, 
f.cod_estado_firma_signature, f.cod_estado, f.ip_maquina as ip_creador, a.nombres, a.apellidos, a.correo, a.cedula as identificacion, a.telefono
FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador WHERE f.token_firma_digital_documento = ?";
$stmt = mysqli_prepare($conectar, $sql_documento);
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) == 0) { die('<div style="font-family:sans-serif; text-align:center; padding:50px;"><h1 style="color:#ef4444;">Error: Documento no encontrado</h1><p>El documento de firma no existe o ha sido desactivado.</p></div>'); }
$documento = mysqli_fetch_assoc($result);
// 2. Validar si ya fue firmado
if ($documento['cod_estado_firma_signature'] == 1) { header("Location: firma_exitosa.php?msg=" . urlencode("Este documento ya ha sido firmado exitosamente.")); exit; }
// 3. Validar expiración (48 horas)
$fecha_creacion_ts = strtotime($documento['fecha_creacion_registro_firma_digital_documento']);
$fecha_expiracion_ts = $fecha_creacion_ts + (48 * 3600);
$tiempo_restante = $fecha_expiracion_ts - time();

if ($tiempo_restante <= 0) { die('<div style="font-family:sans-serif; text-align:center; padding:50px;"><h1 style="color:#f59e0b;">Enlace expirado</h1><p>Este enlace de firma ha expirado (48 horas de validez). Por favor, solicite uno nuevo al asesor.</p></div>'); }
// 4. Validar hash de seguridad (Sincronizado con crear_documento_firma_aliado_ajax.php)
$datos_para_hash = $token . '|' . $documento['cod_aliado_estrategico'] . '|' . $fecha_expiracion_ts . '|' . $documento['ip_creador'];
$hash_calculado = hash_hmac('sha256', $datos_para_hash, SECRET_KEY);

if (!hash_equals($hash_calculado, $hash_seguridad)) {
    die('<div style="font-family:sans-serif; text-align:center; padding:50px;"><h1 style="color:#ef4444;">Error de seguridad</h1><p>El hash de seguridad no coincide. Este enlace puede haber sido manipulado.</p></div>');
}
$horas_restantes = floor($tiempo_restante / 3600);
$minutos_restantes = floor(($tiempo_restante % 3600) / 60);
$nombre_completo = $documento['nombres'] . ' ' . $documento['apellidos'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Firma de Aliado - <?php echo htmlspecialchars($nombre_completo); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root { --primary: #8b5cf6; --primary-dark: #7c3aed; --secondary: #10b981; --bg-dark: #0f172a; --card-bg: #1e293b; --text-main: #f8fafc; --text-muted: #94a3b8; --accent: #f59e0b; }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(at 0% 0%, rgba(139, 92, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.1) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            color: var(--text-main);
        }
        
        .signature-card {
            max-width: 500px;
            width: 100%;
            background: var(--card-bg);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .signature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo-container {
            width: 70px;
            height: 70px;
            background: rgba(139, 92, 246, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }
        
        .logo-container i {
            font-size: 1.75rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(139, 92, 246, 0.2);
            color: var(--primary);
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
        }
        
        .info-section {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .user-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-name i { color: var(--primary); }
        
        .user-details {
            display: grid;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .detail-item i { width: 16px; font-size: 0.85rem; }

        .timer-bar {
            background: rgba(245, 158, 11, 0.1);
            border-radius: 12px;
            padding: 10px 15px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .timer-bar i { color: var(--accent); }
        .timer-text { font-size: 0.85rem; font-weight: 500; color: var(--accent); }
        
        .canvas-container {
            background: #fff;
            border-radius: 16px;
            position: relative;
            margin-bottom: 1.5rem;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        #signature-pad {
            width: 100%;
            height: 220px;
            cursor: crosshair;
            display: block;
        }

        .canvas-labels {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            pointer-events: none;
            color: #ccc;
            font-size: 0.8rem;
            font-style: italic;
        }
        
        .canvas-actions {
            display: flex;
            gap: 12px;
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            outline: none;
        }
        
        .btn-clear {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            flex: 1;
        }
        
        .btn-clear:hover { background: rgba(239, 68, 68, 0.2); }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            flex: 2;
            box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3);
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(139, 92, 246, 0.4);
        }

        .btn-submit:active { transform: translateY(0); }
        
        .footer-note {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .footer-note i { color: var(--secondary); }

        @media (max-width: 400px) {
            .signature-card { padding: 1.25rem; }
            #signature-pad { height: 180px; }
            h1 { font-size: 1.25rem; }
        }
    </style>
</head>
<body>

    <div class="signature-card">
        <div class="header">
            <div class="badge">Validación de Identidad</div>
            <div class="logo-container">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <h1>Firma de Aliado</h1>
            <p style="color:var(--text-muted); font-size:0.9rem;">Por favor, firme en el recuadro blanco</p>
        </div>

        <div class="info-section">
            <div class="user-name">
                <i class="fa-solid fa-circle-user"></i>
                <?php echo htmlspecialchars($nombre_completo); ?>
            </div>
            <div class="user-details">
                <div class="detail-item"><i class="fa-solid fa-id-card"></i> Documento: <?php echo htmlspecialchars($documento['identificacion']); ?></div>
                <div class="detail-item"><i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($documento['correo']); ?></div>
                <?php if($documento['telefono']): ?>
                <div class="detail-item"><i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($documento['telefono']); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="timer-bar">
            <span><i class="fa-solid fa-clock-rotate-left"></i> <span class="timer-text">Expira en:</span></span>
            <span id="countdown" class="timer-text"><?php echo $horas_restantes; ?>h <?php echo $minutos_restantes; ?>m</span>
        </div>

        <div class="canvas-container">
            <canvas id="signature-pad"></canvas>
            <div class="canvas-labels">Espacio para su firma manual</div>
        </div>

        <div class="canvas-actions">
            <button type="button" class="btn btn-clear" onclick="clearPad()">
                <i class="fa-solid fa-eraser"></i> Borrar
            </button>
            <button type="button" class="btn btn-submit" id="submitBtn" onclick="sendSignature()">
                <i class="fa-solid fa-signature"></i> Confirmar Firma
            </button>
        </div>

        <div class="footer-note">
            <i class="fa-solid fa-shield-check"></i>
            Esta plataforma utiliza encriptación de grado bancario para proteger su firma.
        </div>
    </div>

    <input type="hidden" id="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="hidden" id="hash" value="<?php echo htmlspecialchars($hash_seguridad); ?>">

    <script>
        const canvas = document.getElementById('signature-pad');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let hasDrawn = false;
        let lastX = 0;
        let lastY = 0;

        // Ajustar resolución del canvas
        function setupCanvas() {
            const ratio = window.devicePixelRatio || 1;
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width * ratio;
            canvas.height = rect.height * ratio;
            ctx.scale(ratio, ratio);
            
            ctx.strokeStyle = '#1e293b';
            ctx.lineWidth = 2.5;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
        }
        window.addEventListener('load', setupCanvas);
        window.addEventListener('resize', setupCanvas);

        function getPos(e) {
            const rect = canvas.getBoundingClientRect();
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            return { x: clientX - rect.left, y: clientY - rect.top };
        }

        function start(e) { isDrawing = true; const pos = getPos(e); lastX = pos.x; lastY = pos.y; draw(e); }

        function draw(e) {
            if (!isDrawing) return;
            e.preventDefault();
            hasDrawn = true;
            const pos = getPos(e);
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            lastX = pos.x;
            lastY = pos.y;
        }
        function stop() { isDrawing = false; }

        canvas.addEventListener('mousedown', start);
        canvas.addEventListener('mousemove', draw);
        window.addEventListener('mouseup', stop);
        canvas.addEventListener('touchstart', start);
        canvas.addEventListener('touchmove', draw);
        window.addEventListener('touchend', stop);

        function clearPad() { ctx.setTransform(1, 0, 0, 1, 0, 0); ctx.clearRect(0, 0, canvas.width, canvas.height); setupCanvas(); hasDrawn = false; }

        async function sendSignature() {
            if (!hasDrawn) { return Swal.fire({ icon: 'warning', title: 'Firma requerida', text: 'Por favor, dibuje su firma en el recuadro.', confirmButtonColor: '#8b5cf6' }); }
            const confirm = await Swal.fire({ title: '¿Confirmar firma?', text: "Al confirmar, su firma quedará registrada en el documento oficial.", icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#94a3b8', confirmButtonText: 'Sí, confirmar', cancelButtonText: 'Revisar' });
            if (!confirm.isConfirmed) return;
            // Loading
            Swal.fire({ title: 'Procesando firma...', text: 'Guardando datos de seguridad', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

            const base64 = canvas.toDataURL('image/png');
            const token = document.getElementById('token').value;
            const hash = document.getElementById('hash').value;

            try {
                const response = await fetch('procesar_firma_aliado_ajax.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ token: token, hash: hash, firma: base64 }) });
                const data = await response.json();
                if (data.success) { Swal.fire({ icon: 'success', title: '¡Firma Exitosa!', text: 'El documento ha sido firmado correctamente.', showConfirmButton: false, timer: 2000}).then(() => { window.location.href = 'firma_exitosa.php'; }); } else { Swal.fire({ icon: 'error', title: 'Error', text: data.error || 'No se pudo procesar la firma.' }); }
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Error de red', text: 'No hay conexión con el servidor.' });
            }
        }
        // Countdown
        let seconds = <?php echo $tiempo_restante; ?>;
        const countdownEl = document.getElementById('countdown');
        setInterval(() => { if (seconds <= 0) { location.reload(); return; } seconds--; const h = Math.floor(seconds / 3600); const m = Math.floor((seconds % 3600) / 60); countdownEl.innerText = `${h}h ${m}m restantes`; }, 1000);
    </script>
</body>
</html>
<?php mysqli_close($conectar); ?>
