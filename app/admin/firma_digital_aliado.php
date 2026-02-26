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
// 1. Buscar el documento en la base de datos (CON datos extendidos para el contrato)
$sql_documento = "SELECT f.cod_firma_digital_documento, f.cod_aliado_estrategico, f.cod_tienda, f.nombre_tipo_firma_digital, 
f.fecha_creacion_registro_firma_digital_documento, f.cod_estado_firma_signature, f.cod_estado, f.ip_maquina as ip_creador,
a.nombres, a.apellidos, a.correo, a.cedula as identificacion, a.telefono, a.nombre_razon_social, a.nit_razon_social,
a.direccion_tercero, a.barrio_tercero,
t.nombre_tienda, t.nit_razon_social as nit_tienda, t.nombre_razon_social as razon_social_tienda,
t.nombre_representante as representante_tienda, t.documento_representante as documento_rep_tienda,
t.correo_tercero as correo_tienda, t.telefono1_tercero as telefono_tienda, t.direccion_tercero as direccion_tienda_campo
FROM tbl15_firma_digital_documento f 
INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador 
LEFT JOIN tbl15_tienda t ON f.cod_tienda = t.cod_tienda
WHERE f.token_firma_digital_documento = ?";
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

// ============================================
// OBTENER DATOS PARA LA PLANTILLA DEL CONTRATO
// ============================================

// Variables para la plantilla del contrato
$nombre_intermediario_credito   = 'DISTRIBUCIONES A & Q S.A.S';
$firma_gestor_operador          = ''; // Se llenará cuando se firme por el gestor
$nombre_rep_legal_gestor        = ''; // Se llenará cuando se firme por el gestor
$documento_rep_legal_gestor     = '';
$fecha_firma_gestor             = '';
$firma_intermediario            = '';
$representante_intermediario    = '';
$documento_intermediario        = '';
$fecha_intermediario            = '';

// Datos del aliado/tienda para la sección de aceptación
$razon_social_tienda            = $documento['razon_social_tienda'] ?: ($documento['nombre_razon_social'] ?: ($documento['nombre_tienda'] ?: ''));
$nit_tienda                     = $documento['nit_tienda'] ?: ($documento['nit_razon_social'] ?: '');
$representante_legal_aliado     = $nombre_completo;
$documento_aliado               = $documento['identificacion'] ?: '';
$correo_tienda                  = $documento['correo_tienda'] ?: ($documento['correo'] ?: '');
$telefono_tienda                = $documento['telefono_tienda'] ?: ($documento['telefono'] ?: '');
$direccion_tienda               = $documento['direccion_tienda_campo'] ?: ($documento['direccion_tercero'] ?: '');

// Firma del aliado (vacía hasta que firme)
$firma_aliado                   = '';
$nombre_rep_legal_aliado        = $nombre_completo;
$documento_rep_legal_aliado     = $documento['identificacion'];
$fecha_firma_aliado             = ''; // Se llenará al firmar
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
            padding: 15px;
            color: var(--text-main);
        }
        
        .page-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        /* ====== HEADER STICKY ====== */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 12px 16px;
            border-radius: 16px;
            margin-bottom: 1rem;
            border: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .sticky-header .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sticky-header .logo-icon {
            width: 42px; height: 42px;
            background: rgba(139, 92, 246, 0.15);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(139, 92, 246, 0.3);
            flex-shrink: 0;
        }

        .sticky-header .logo-icon i {
            font-size: 1.1rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sticky-header .header-info h1 {
            font-size: 0.95rem; font-weight: 700; line-height: 1.2;
        }
        .sticky-header .header-info p {
            font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;
        }

        .sticky-timer {
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.25);
            border-radius: 10px;
            padding: 6px 12px;
            display: flex; align-items: center; gap: 6px;
            flex-shrink: 0;
        }
        .sticky-timer i { color: var(--accent); font-size: 0.8rem; }
        .sticky-timer span { font-size: 0.75rem; font-weight: 600; color: var(--accent); white-space: nowrap; }

        /* ====== INFO CARD ====== */
        .info-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        .user-name {
            font-size: 1.1rem; font-weight: 600;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 0.75rem;
        }
        .user-name i { color: var(--primary); }
        .user-details { display: grid; gap: 6px; font-size: 0.85rem; color: var(--text-muted); }
        .detail-item { display: flex; align-items: center; gap: 8px; }
        .detail-item i { width: 16px; font-size: 0.8rem; color: var(--primary); }

        /* ====== CONTRATO SECTION ====== */
        .contrato-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        .contrato-toggle-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
            padding-bottom: 0.75rem;
        }

        .contrato-toggle-header h2 {
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .contrato-toggle-header h2 i {
            color: var(--secondary);
        }

        .contrato-toggle-icon {
            width: 32px; height: 32px;
            background: rgba(16, 185, 129, 0.15);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            transition: transform 0.3s ease;
        }
        .contrato-toggle-icon i { color: var(--secondary); font-size: 0.85rem; }
        .contrato-toggle-icon.expanded { transform: rotate(180deg); }

        .contrato-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }
        .contrato-body.expanded {
            max-height: 100000px;
            transition: max-height 1s ease-in;
        }

        .contrato-scroll-indicator {
            text-align: center;
            padding: 10px;
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .contrato-scroll-indicator i { color: var(--secondary); }

        .contrato-read-badge {
            display: none;
            background: rgba(16, 185, 129, 0.15);
            color: var(--secondary);
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .contrato-read-badge.visible { display: inline-flex; align-items: center; gap: 5px; }

        /* ====== FIRMA SECTION ====== */
        .signature-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 1.5rem 1.5rem 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            overflow: hidden;
        }

        .signature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title i { color: var(--primary); }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(139, 92, 246, 0.2);
            color: var(--primary);
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.75rem;
        }
        
        .canvas-container {
            background: #fff;
            border-radius: 16px;
            position: relative;
            margin-bottom: 1.25rem;
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
            left: 0; right: 0;
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
            font-family: 'Outfit', sans-serif;
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
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgba(139, 92, 246, 0.4); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }

        .footer-note {
            margin-top: 1.25rem;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .footer-note i { color: var(--secondary); }

        /* ====== CHECKBOX LECTURA ====== */
        .accept-check {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: rgba(139, 92, 246, 0.08);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 1.25rem;
            cursor: pointer;
        }
        .accept-check input[type="checkbox"] {
            width: 20px; height: 20px;
            margin-top: 2px;
            accent-color: var(--primary);
            flex-shrink: 0;
            cursor: pointer;
        }
        .accept-check label {
            font-size: 0.85rem;
            color: var(--text-muted);
            cursor: pointer;
            line-height: 1.4;
        }
        .accept-check label strong { color: var(--text-main); }

        @media (max-width: 500px) {
            .sticky-header { padding: 10px 12px; flex-wrap: wrap; }
            .sticky-header .header-info h1 { font-size: 0.85rem; }
            .sticky-timer { padding: 5px 8px; }
            .info-card, .contrato-section, .signature-card { padding: 1rem; }
            #signature-pad { height: 180px; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <!-- ====== HEADER STICKY ====== -->
    <div class="sticky-header">
        <div class="header-left">
            <div class="logo-icon">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div class="header-info">
                <h1>Oferta Mercantil</h1>
                <p>Firma Digital de Aliado Comercial</p>
            </div>
        </div>
        <div class="sticky-timer">
            <i class="fa-solid fa-clock"></i>
            <span id="countdown"><?php echo $horas_restantes; ?>h <?php echo $minutos_restantes; ?>m</span>
        </div>
    </div>

    <!-- ====== INFO DEL ALIADO ====== -->
    <div class="info-card">
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
            <?php if(!empty($documento['nombre_tienda'])): ?>
            <div class="detail-item"><i class="fa-solid fa-store" style="color: var(--secondary);"></i> <span style="color: var(--secondary); font-weight: 600;"><?php echo htmlspecialchars($documento['nombre_tienda']); ?></span></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ====== CONTRATO (EXPANDIBLE) ====== -->
    <div class="contrato-section">
        <div class="contrato-toggle-header" onclick="toggleContrato()">
            <h2>
                <i class="fa-solid fa-file-lines"></i>
                Contrato - Oferta Mercantil
                <span class="contrato-read-badge" id="readBadge"><i class="fa-solid fa-check-circle"></i> Leído</span>
            </h2>
            <div class="contrato-toggle-icon" id="toggleIcon">
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <div class="contrato-scroll-indicator" id="scrollIndicator">
            <i class="fa-solid fa-hand-pointer"></i>
            Toque para expandir y leer el contrato completo
        </div>
        <div class="contrato-body" id="contratoBody">
            <?php include_once('plantilla_contrato_oferta_mercantil.php'); ?>
        </div>
    </div>

    <!-- ====== SECCIÓN DE FIRMA ====== -->
    <div class="signature-card">
        <div class="badge">Validación de Identidad</div>
        <div class="section-title">
            <i class="fa-solid fa-signature"></i>
            Firme en el recuadro blanco
        </div>

        <!-- Checkbox de aceptación -->
        <div class="accept-check" onclick="document.getElementById('acceptCheck').click()">
            <input type="checkbox" id="acceptCheck" onchange="toggleSubmitBtn()" onclick="event.stopPropagation()">
            <label for="acceptCheck" onclick="event.stopPropagation()">
                Declaro que he <strong>leído y comprendido</strong> en su integridad la Oferta Mercantil y <strong>acepto</strong> todas las condiciones comerciales, jurídicas, económicas y operativas contenidas en el documento.
            </label>
        </div>

        <div class="canvas-container">
            <canvas id="signature-pad"></canvas>
            <div class="canvas-labels">Espacio para su firma manual</div>
        </div>

        <div class="canvas-actions">
            <button type="button" class="btn btn-clear" onclick="clearPad()">
                <i class="fa-solid fa-eraser"></i> Borrar
            </button>
            <button type="button" class="btn btn-submit" id="submitBtn" onclick="sendSignature()" disabled>
                <i class="fa-solid fa-signature"></i> Confirmar Firma
            </button>
        </div>

        <div class="footer-note">
            <i class="fa-solid fa-shield-halved"></i>
            Esta plataforma utiliza encriptación de grado bancario para proteger su firma.
        </div>
    </div>

</div>

<input type="hidden" id="token" value="<?php echo htmlspecialchars($token); ?>">
<input type="hidden" id="hash" value="<?php echo htmlspecialchars($hash_seguridad); ?>">

<script>
    // ====== CONTRATO TOGGLE ======
    let contratoExpanded = false;
    function toggleContrato() {
        const body = document.getElementById('contratoBody');
        const icon = document.getElementById('toggleIcon');
        const indicator = document.getElementById('scrollIndicator');
        contratoExpanded = !contratoExpanded;
        if (contratoExpanded) {
            body.classList.add('expanded');
            icon.classList.add('expanded');
            indicator.innerHTML = '<i class="fa-solid fa-eye"></i> Contrato visible — desplácese para leer';
        } else {
            body.classList.remove('expanded');
            icon.classList.remove('expanded');
            indicator.innerHTML = '<i class="fa-solid fa-hand-pointer"></i> Toque para expandir y leer el contrato completo';
        }
    }

    // ====== ACCEPT CHECKBOX ======
    function toggleSubmitBtn() {
        const check = document.getElementById('acceptCheck');
        const btn = document.getElementById('submitBtn');
        btn.disabled = !check.checked;
    }

    // ====== SIGNATURE PAD ======
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;
    let hasDrawn = false;
    let lastX = 0;
    let lastY = 0;

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
        if (!document.getElementById('acceptCheck').checked) {
            return Swal.fire({ icon: 'warning', title: 'Aceptación requerida', text: 'Debe aceptar los términos del contrato antes de firmar.', confirmButtonColor: '#8b5cf6' });
        }
        if (!hasDrawn) { return Swal.fire({ icon: 'warning', title: 'Firma requerida', text: 'Por favor, dibuje su firma en el recuadro.', confirmButtonColor: '#8b5cf6' }); }
        const confirm = await Swal.fire({ 
            title: '¿Confirmar firma?', 
            html: 'Al confirmar, su firma quedará registrada en el documento oficial de la <strong>Oferta Mercantil</strong>.<br><br><small style="color:#94a3b8;">Esta acción tiene validez jurídica conforme a la legislación colombiana.</small>', 
            icon: 'question', 
            showCancelButton: true, 
            confirmButtonColor: '#10b981', 
            cancelButtonColor: '#94a3b8', 
            confirmButtonText: '<i class="fa-solid fa-check"></i> Sí, confirmar firma', 
            cancelButtonText: 'Revisar' 
        });
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

    // ====== COUNTDOWN ======
    let seconds = <?php echo $tiempo_restante; ?>;
    const countdownEl = document.getElementById('countdown');
    setInterval(() => { if (seconds <= 0) { location.reload(); return; } seconds--; const h = Math.floor(seconds / 3600); const m = Math.floor((seconds % 3600) / 60); countdownEl.innerText = `${h}h ${m}m`; }, 1000);
</script>
</body>
</html>
<?php mysqli_close($conectar); ?>
