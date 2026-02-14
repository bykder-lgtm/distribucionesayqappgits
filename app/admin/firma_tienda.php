<?php
/**
 * Página de Firma Electrónica para Tiendas
 * Recibe el parámetro 'cod' que contiene el cod_tienda encriptado
 * Desencripta y muestra la información de la tienda para firma
 */

include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// Obtener y desencriptar el código de tienda
$cod_tienda_cryp = isset($_GET['cod']) ? $_GET['cod'] : '';
$cod_tienda = 0;
$tienda_valida = false;

if (!empty($cod_tienda_cryp)) {
    try {
        // Desencriptar el código
        $cod_tienda_codif = DAXCODIFCRYPTOR::descriptardax($cod_tienda_cryp);
        $cod_tienda = DAXCODIFCRYPTOR::descodifdax($cod_tienda_codif);
        
        // Verificar que existe la tienda
        if ($cod_tienda > 0) {
            $sql_tienda = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
            $consulta_tienda = mysqli_query($conectar, $sql_tienda);
            
            if ($consulta_tienda && mysqli_num_rows($consulta_tienda) > 0) {
                $tienda_valida = true;
                $datos_tienda = mysqli_fetch_assoc($consulta_tienda);
                
                // Verificar si ya tiene firma
                $ya_firmado = false;
                $ya_revisado = false;

                if (!empty($datos_tienda['url_firma_electronica'])) { $ya_firmado = true; }
                if ($datos_tienda['cod_estado_firma_signature'] == 1) { $ya_revisado = true; }
            }
        }
    } catch (Exception $e) {
        $tienda_valida = false;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Electrónica - Tienda</title>
    <link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 18px 20px;
            text-align: center;
            color: white;
        }
        
        .header h1 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .header p {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .content {
            padding: 20px 20px;
        }
        
        /* Información compacta */
        .info-compact {
            background: #f7fafc;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px 20px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .info-label {
            font-size: 0.75rem;
            color: #667eea;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 0.85rem;
            color: #2d3748;
            font-weight: 600;
        }
        
        .signature-area {
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin: 10px 0 15px 0;
            background: #f7fafc;
        }
        
        .signature-area p {
            margin-bottom: 10px !important;
            font-size: 0.85rem;
        }
        
        .signature-area canvas {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            width: 100%;
            max-width: 100%;
            height: 180px;
            cursor: crosshair;
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        
        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(72, 187, 120, 0.4);
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-secondary:hover {
            background: #cbd5e0;
        }
        
        .error-container {
            text-align: center;
            padding: 60px 30px;
        }
        
        .error-icon {
            width: 100px;
            height: 100px;
            background: #fed7d7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .error-icon::before {
            content: "✕";
            font-size: 48px;
            color: #c53030;
        }
        
        .error-container h2 {
            color: #c53030;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        .error-container p {
            color: #718096;
            font-size: 1rem;
        }
        
        .success-message {
            display: none;
            text-align: center;
            padding: 40px;
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            background: #c6f6d5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .success-icon::before {
            content: "✓";
            font-size: 48px;
            color: #276749;
        }
        
        .success-message h2 {
            color: #276749;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        @media (max-width: 480px) {
            .content {
                padding: 25px 20px;
            }
            
            .header {
                padding: 25px 20px;
            }
            
            .header h1 {
                font-size: 1.4rem;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Estilos para Autorizaciones y Consentimientos */
        .auth-section {
            background: #f7fafc;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #e2e8f0;
        }
        
        .auth-title {
            font-size: 0.95rem;
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .auth-icon {
            font-size: 1rem;
        }
        
        .auth-subtitle {
            font-size: 0.8rem;
            color: #718096;
            margin-bottom: 12px;
        }
        
        .auth-checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .auth-checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 12px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .auth-checkbox-item:hover {
            border-color: #667eea;
            box-shadow: 0 2px 6px rgba(102, 126, 234, 0.12);
        }
        
        .auth-checkbox-item input[type="checkbox"] {
            display: none;
        }
        
        .auth-checkbox-custom {
            width: 20px;
            height: 20px;
            min-width: 20px;
            border: 2px solid #cbd5e0;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            background: white;
        }
        
        .auth-checkbox-custom .checkmark {
            color: white;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .auth-checkbox-item input[type="checkbox"]:checked + .auth-checkbox-custom {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border-color: #48bb78;
        }
        
        .auth-checkbox-item input[type="checkbox"]:checked + .auth-checkbox-custom .checkmark {
            opacity: 1;
        }
        
        .auth-checkbox-text {
            color: #4a5568;
            font-size: 0.78rem;
            line-height: 1.4;
            flex: 1;
        }
        
        .auth-checkbox-text strong {
            color: #2d3748;
        }
        
        .auth-warning {
            background: #fed7d7;
            color: #c53030;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 0.85rem;
            display: none;
        }
        
        /* Notificaciones Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 90%;
            max-width: 400px;
        }
        
        .toast {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .toast-error {
            background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
            color: white;
        }
        
        .toast-warning {
            background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%);
            color: white;
        }
        
        .toast-success {
            background: linear-gradient(135deg, #68d391 0%, #48bb78 100%);
            color: white;
        }
        
        .toast-icon {
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        
        .toast-message {
            font-size: 0.9rem;
            font-weight: 500;
            line-height: 1.4;
        }
        
        .toast-close {
            margin-left: auto;
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0.8;
            padding: 0;
        }
        
        .toast-close:hover {
            opacity: 1;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor de notificaciones toast -->
    <div id="toastContainer" class="toast-container"></div>
    
    <div class="container">
        <?php if ($tienda_valida): ?>
        <?php if ($ya_firmado): ?>
        <div class="header">
            <h1>Documento Firmado</h1>
            <p>Esta tienda ya cuenta con firma registrada,</p>
            <?php if ($ya_revisado): ?>
                <p>y aceptada.</p>
            <?php else: ?>
                <p>pero esta en revision para ser aceptada.</p>
            <?php endif; ?>
        </div>
        <div class="success-message" style="display: block;">
            <div class="success-icon"></div>
            <h2>¡Firma ya registrada!</h2>
            <p>La firma electrónica para <strong><?php echo htmlspecialchars($datos_tienda['nombre_tienda']); ?></strong> ya fue capturada anteriormente.</p>
            <p style="margin-top: 15px; color: #718096; font-size: 0.9em;">No es necesario realizar ninguna acción adicional.</p>
        </div>
        <?php else: ?>
        <div class="header">
            <h1>Firma Electrónica</h1>
            <p>Complete su firma para finalizar el registro</p>
        </div>
        
        <div class="content" id="formContent">
            <!-- Información compacta de la tienda -->
            <div class="info-compact">
                <div class="info-item">
                    <span class="info-label">Tienda:</span>
                    <span class="info-value"><?php echo htmlspecialchars($datos_tienda['nombre_tienda']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">NIT:</span>
                    <span class="info-value"><?php echo htmlspecialchars($datos_tienda['identificacion_tercero']); ?></span>
                </div>
                <?php if (!empty($datos_tienda['nombre_representante'])): ?>
                <div class="info-item">
                    <span class="info-label">Representante:</span>
                    <span class="info-value"><?php echo htmlspecialchars($datos_tienda['nombre_representante']); ?></span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="signature-area">
                <p style="margin-bottom: 15px; color: #718096;">Dibuje su firma en el recuadro:</p>
                <canvas id="signatureCanvas"></canvas>
            </div>
            

            <!-- Sección de Autorizaciones y Consentimientos -->
            <div class="auth-section">
                <h3 class="auth-title"><span class="auth-icon">🛡️</span> Autorizaciones y Consentimientos</h3>
                <p class="auth-subtitle">Por favor, lea y acepte los siguientes términos antes de firmar:</p>
                
                <div class="auth-checkbox-group">
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="auth_contrato_alianza" name="auth_contrato_alianza" value="1">
                        <span class="auth-checkbox-custom"><span class="checkmark">✓</span></span>
                        <span class="auth-checkbox-text">Autorizo el uso de mis datos y firma electrónica para diligenciar el <strong>contrato de alianza comercial</strong>.</span>
                    </label>
                    
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="auth_contrato_agencia" name="auth_contrato_agencia" value="1">
                        <span class="auth-checkbox-custom"><span class="checkmark">✓</span></span>
                        <span class="auth-checkbox-text">Autorizo el uso de mis datos y firma electrónica para diligenciar el <strong>contrato de agencia comercial</strong>.</span>
                    </label>
                    
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="auth_confidencialidad" name="auth_confidencialidad" value="1">
                        <span class="auth-checkbox-custom"><span class="checkmark">✓</span></span>
                        <span class="auth-checkbox-text">Autorizo el uso de mis datos y firma electrónica para diligenciar el <strong>acuerdo de confidencialidad</strong>.</span>
                    </label>
                    
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="auth_datos_reales" name="auth_datos_reales" value="1">
                        <span class="auth-checkbox-custom"><span class="checkmark">✓</span></span>
                        <span class="auth-checkbox-text">Declaro que la información personal suministrada es real y autorizo el uso de la misma según la <strong>política de tratamiento de datos</strong>.</span>
                    </label>
                </div>
            </div>
            
            <div class="btn-group">
                <button type="button" class="btn btn-secondary" onclick="limpiarFirma()">🗑️ Limpiar</button>
                <button type="button" class="btn btn-primary" onclick="guardarFirma()">✓ Confirmar Firma</button>
            </div>
        </div>
        
        <div class="success-message" id="successMessage">
            <div class="success-icon"></div>
            <h2>¡Firma registrada exitosamente!</h2>
            <p>Gracias por completar el proceso de firma electrónica.</p>
        </div>
        <?php endif; ?>
        
        <?php else: ?>
        <div class="error-container">
            <div class="error-icon"></div>
            <h2>Enlace no válido</h2>
            <p>El enlace de firma electrónica no es válido o ha expirado. Por favor, solicite un nuevo enlace.</p>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if ($tienda_valida && !$ya_firmado): ?>
    <script>
    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    
    // Ajustar tamaño del canvas
    // Ajustar tamaño del canvas preserving content
    function resizeCanvas() {
        // Guardar contenido actual
        let tempCanvas = document.createElement('canvas');
        let tempCtx = tempCanvas.getContext('2d');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        tempCtx.drawImage(canvas, 0, 0);

        // Redimensionar
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = 200; // Mantener altura fija

        // Restaurar contenido (escalado si fuera necesario, pero mejor centrado o mantenido)
        ctx.drawImage(tempCanvas, 0, 0);

        // Restaurar estilos de línea
        ctx.strokeStyle = '#2d3748';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
    }
    
    // Inicializar
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width;
    canvas.height = 200;
    ctx.strokeStyle = '#2d3748';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';

    // Solo redimensionar al terminar de cambiar tamaño para evitar borrados constantes en scroll
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(resizeCanvas, 100);
    });
    
    // Eventos de dibujo
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Eventos táctiles
    canvas.addEventListener('touchstart', startDrawingTouch);
    canvas.addEventListener('touchmove', drawTouch);
    canvas.addEventListener('touchend', stopDrawing);
    
    function startDrawing(e) {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }
    
    function startDrawingTouch(e) {
        e.preventDefault();
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        const touch = e.touches[0];
        [lastX, lastY] = [touch.clientX - rect.left, touch.clientY - rect.top];
    }
    
    function draw(e) {
        if (!isDrawing) return;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }
    
    function drawTouch(e) {
        if (!isDrawing) return;
        e.preventDefault();
        const rect = canvas.getBoundingClientRect();
        const touch = e.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.stroke();
        [lastX, lastY] = [x, y];
    }
    
    function stopDrawing() {
        isDrawing = false;
    }
    
    function limpiarFirma() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    
    // Función para mostrar notificaciones toast
    function showToast(message, type = 'error', duration = 4000) {
        const container = document.getElementById('toastContainer');
        const icons = {
            error: '⚠️',
            warning: '⚡',
            success: '✓'
        };
        
        const toast = document.createElement('div');
        toast.className = 'toast toast-' + type;
        toast.innerHTML = `
            <span class="toast-icon">${icons[type]}</span>
            <span class="toast-message">${message}</span>
            <button class="toast-close" onclick="this.parentElement.remove()">×</button>
        `;
        
        container.appendChild(toast);
        
        // Auto-remove después de la duración
        setTimeout(() => {
            toast.style.animation = 'fadeOut 0.3s ease forwards';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }
    
    function guardarFirma() {
        // Verificar que todas las autorizaciones estén marcadas
        const auth1 = document.getElementById('auth_contrato_alianza').checked;
        const auth2 = document.getElementById('auth_contrato_agencia').checked;
        const auth3 = document.getElementById('auth_confidencialidad').checked;
        const auth4 = document.getElementById('auth_datos_reales').checked;
        
        if (!auth1 || !auth2 || !auth3 || !auth4) {
            showToast('Por favor, debe aceptar todas las autorizaciones antes de firmar.', 'warning');
            // Resaltar los checkboxes no marcados
            document.querySelectorAll('.auth-checkbox-item').forEach(function(item) {
                const checkbox = item.querySelector('input[type="checkbox"]');
                if (!checkbox.checked) {
                    item.style.borderColor = '#c53030';
                    item.style.background = '#fff5f5';
                } else {
                    item.style.borderColor = '#48bb78';
                    item.style.background = '#f0fff4';
                }
            });
            return;
        }
        
        // Verificar si hay firma
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const pixels = imageData.data;
        let hasContent = false;
        
        for (let i = 3; i < pixels.length; i += 4) {
            if (pixels[i] > 0) {
                hasContent = true;
                break;
            }
        }
        
        if (!hasContent) {
            showToast('Por favor, dibuje su firma en el recuadro antes de confirmar.', 'warning');
            return;
        }
        
        // Obtener imagen de firma
        const firmaBase64 = canvas.toDataURL('image/png');
        
        // Enviar al servidor
        fetch('../admin/guardar_firma_tienda_ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cod_tienda_cryp: '<?php echo $cod_tienda_cryp; ?>',
                firma: firmaBase64
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('formContent').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block';
            } else {
                showToast('Error al guardar la firma: ' + data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Error de conexión. Por favor, intente nuevamente.', 'error');
            console.error('Error:', error);
        });
    }
    </script>
    <?php endif; ?>
</body>
</html>
