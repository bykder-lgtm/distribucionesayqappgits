<?php 
$nombre_pagina          = "Configuración";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->

<?php
// Obtener datos del usuario/aliado actual
$firma_actual = '';
$foto_actual = '';
$datos_usuario = array();

if (isset($cod_administrador) && !empty($cod_administrador)) {
    $sql_usuario = "SELECT cod_administrador, nombres, apellidos, url_img_firma_prof_ori, url_img_foto_grande FROM tbl15_administrador WHERE cod_administrador = '" . mysqli_real_escape_string($conectar, $cod_administrador) . "'";
    $resultado_usuario = mysqli_query($conectar, $sql_usuario);
    if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
        $datos_usuario = mysqli_fetch_assoc($resultado_usuario);
        $firma_actual = isset($datos_usuario['url_img_firma_prof_ori']) ? $datos_usuario['url_img_firma_prof_ori'] : '';
        $foto_actual = isset($datos_usuario['url_img_foto_grande']) ? $datos_usuario['url_img_foto_grande'] : '';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $nombre_pagina ?>">
<meta name="author" content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script src="../js/signature_pad/docs/js/signature_pad.umd.min.js"></script>

<style>
/* Estilos para la página de configuración */
.config-container {
    padding: 1rem;
    max-width: 800px;
    margin: 0 auto;
}

.config-card {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
}

.config-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
}

.config-card-header i {
    font-size: 1.5rem;
    color: #00d4ff;
}

.config-card-header h3 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.firma-preview-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.firma-preview {
    width: 100%;
    max-width: 300px;
    height: 150px;
    background: rgba(255, 255, 255, 0.05);
    border: 2px dashed rgba(65, 105, 225, 0.5);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.firma-preview img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.firma-preview .no-firma {
    color: rgba(255, 255, 255, 0.5);
    text-align: center;
    padding: 1rem;
}

.firma-preview .no-firma i {
    font-size: 3rem;
    display: block;
    margin-bottom: 0.5rem;
}

.form-group-config {
    margin-bottom: 1rem;
}

.form-group-config label {
    display: block;
    color: #00d4ff;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-group-config input[type="file"] {
    width: 100%;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 8px;
    color: white;
    font-size: 0.9rem;
}

.btn-config {
    width: 100%;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-config-primary {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
}

.btn-config-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
}

.btn-config-primary:disabled {
    background: rgba(255, 255, 255, 0.2);
    cursor: not-allowed;
    transform: none;
}

.alert-config {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    display: none;
}

.alert-config.success {
    background: rgba(72, 187, 120, 0.2);
    border: 1px solid #48bb78;
    color: #48bb78;
}

.alert-config.error {
    background: rgba(255, 111, 0, 0.2);
    border: 1px solid #ff6f00;
    color: #ff6f00;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    margin-bottom: 1.5rem;
}

.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-avatar i {
    font-size: 1.5rem;
    color: white;
}

.user-details h4 {
    color: white;
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
}

.user-details p {
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
    font-size: 0.85rem;
}

.page-header-config {
    padding: 1rem;
    background: linear-gradient(135deg, rgba(65, 105, 225, 0.2) 0%, rgba(0, 212, 255, 0.1) 100%);
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
    margin-bottom: 1rem;
}

.page-header-config h2 {
    color: white;
    margin: 0;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page-header-config h2 i {
    color: #00d4ff;
}

/* Estilos para checkboxes de autorización */
.auth-section {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(65, 105, 225, 0.3);
}

.auth-section-title {
    color: #00d4ff;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.auth-checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.auth-checkbox-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(65, 105, 225, 0.2);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.auth-checkbox-item:hover {
    background: rgba(65, 105, 225, 0.1);
    border-color: rgba(65, 105, 225, 0.4);
}

.auth-checkbox-item input[type="checkbox"] {
    display: none;
}

.auth-checkbox-custom {
    width: 22px;
    height: 22px;
    min-width: 22px;
    border: 2px solid rgba(65, 105, 225, 0.5);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.05);
}

.auth-checkbox-item input[type="checkbox"]:checked + .auth-checkbox-custom {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    border-color: #00d4ff;
}

.auth-checkbox-custom i {
    color: white;
    font-size: 0.75rem;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.auth-checkbox-item input[type="checkbox"]:checked + .auth-checkbox-custom i {
    opacity: 1;
}

.auth-checkbox-text {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.85rem;
    line-height: 1.4;
    flex: 1;
}

.auth-checkbox-text a {
    color: #00d4ff;
    text-decoration: underline;
}

.auth-checkbox-text a:hover {
    color: #5b7ce6;
}

/* Tabs para seleccionar tipo de firma */
.firma-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.firma-tab {
    flex: 1;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 8px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.firma-tab:hover {
    background: rgba(65, 105, 225, 0.2);
    color: white;
}

.firma-tab.active {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    border-color: #5b7ce6;
    color: white;
}

.firma-tab i {
    display: block;
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
}

.firma-content {
    display: none;
}

.firma-content.active {
    display: block;
}

/* Canvas de firma táctil */
.canvas-container {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
}

.firma-canvas {
    width: 100%;
    height: 200px;
    background: white;
    border: 2px solid rgba(65, 105, 225, 0.5);
    border-radius: 12px;
    cursor: crosshair;
    touch-action: none;
}

.canvas-controls {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
}

.btn-canvas {
    flex: 1;
    padding: 0.6rem 1rem;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
}

.btn-canvas-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(65, 105, 225, 0.3);
}

.btn-canvas-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
}

.btn-canvas-danger {
    background: rgba(255, 107, 107, 0.2);
    color: #ff6b6b;
    border: 1px solid rgba(255, 107, 107, 0.3);
}

.btn-canvas-danger:hover {
    background: rgba(255, 107, 107, 0.3);
}

.firma-hint {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.8rem;
    text-align: center;
    margin-top: 0.5rem;
}

.divider-text {
    text-align: center;
    color: rgba(255, 255, 255, 0.4);
    font-size: 0.8rem;
    margin: 1rem 0;
    position: relative;
}

.divider-text::before,
.divider-text::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: rgba(65, 105, 225, 0.3);
}

.divider-text::before {
    left: 0;
}

.divider-text::after {
    right: 0;
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<main class="container py-4 mb-5">
    <!-- Encabezado de la página -->
    <div class="page-header-config"><h2><i class="fa fa-cog"></i> Configuración</h2></div>

    <div class="config-container">
        <!-- Información del usuario -->
        <div class="user-info">
            <div class="user-avatar"><?php if (!empty($foto_actual) && file_exists($foto_actual)) { ?><img src="<?php echo $foto_actual; ?>" alt="Foto"><?php } else { ?><i class="fa fa-user"></i><?php } ?></div>
            <div class="user-details">
                <h4><?php echo isset($datos_usuario['nombres']) ? ucwords(strtolower($datos_usuario['nombres'] . ' ' . $datos_usuario['apellidos'])) : 'Usuario'; ?></h4>
                <p>ID: <?php echo $cod_administrador; ?></p>
            </div>
        </div>
        <!-- Card de Firma -->
        <div class="config-card">
            <div class="config-card-header"><i class="fa fa-pen-fancy"></i><h3>Mi Firma Digital</h3></div>
            <div id="alertFirma" class="alert-config"></div>
            <!-- Firma actual -->
            <div class="firma-preview-container">
                <div class="firma-preview" id="firmaPreviewContainer">
                    <?php if (!empty($firma_actual) && file_exists($firma_actual)) { ?>
                        <img src="<?php echo $firma_actual; ?>" alt="Firma actual" id="firmaPreviewImg">
                    <?php } else { ?>
                        <div class="no-firma" id="noFirmaText"><i class="fa fa-signature"></i><span>Sin firma registrada</span></div>
                    <?php } ?>
                </div>
            </div>
            <!-- Tabs para seleccionar método -->
            <div class="firma-tabs">
                <div class="firma-tab active" data-tab="tactil"><i class="fa fa-hand-pointer"></i>Dibujar Firma</div>
                <div class="firma-tab" data-tab="archivo"><i class="fa fa-upload"></i>Subir Imagen</div>
            </div>
            <!-- Contenido: Firma Táctil -->
            <div class="firma-content active" id="content-tactil">
                <div class="canvas-container">
                    <canvas id="firmaCanvas" class="firma-canvas"></canvas>
                    <div class="canvas-controls">
                        <button type="button" class="btn-canvas btn-canvas-danger" id="btnLimpiar"><i class="fa fa-eraser"></i> Limpiar</button>
                        <button type="button" class="btn-canvas btn-canvas-secondary" id="btnDeshacer"><i class="fa fa-undo"></i> Deshacer</button>
                    </div>
                    <p class="firma-hint"><i class="fa fa-info-circle"></i> Dibuje su firma con el dedo o mouse</p>
                </div>
                <button type="button" class="btn-config btn-config-primary" id="btnGuardarFirmaTactil"><i class="fa fa-save"></i> Guardar Firma Táctil</button>
                <input type="hidden" id="firmaBase64" name="firma_base64">
                <input type="hidden" id="codAdminTactil" value="<?php echo $cod_administrador; ?>">
            </div>
            <!-- Contenido: Subir Archivo -->
            <div class="firma-content" id="content-archivo">
                <form id="formFirma" enctype="multipart/form-data">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                    <div class="form-group-config">
                        <label for="nueva_firma"><i class="fa fa-image"></i> Seleccionar imagen de firma</label>
                        <input type="file" id="nueva_firma" name="nueva_firma" accept="image/*">
                        <small style="color: rgba(255,255,255,0.5); display: block; margin-top: 0.5rem;">Formatos: JPG, PNG, GIF. Tamaño recomendado: 400x200px</small>
                    </div>
                    <button type="submit" class="btn-config btn-config-primary" id="btnGuardarFirma"><i class="fa fa-save"></i> Guardar Imagen</button>
                </form>
            </div>
            
            <!-- Sección de Autorizaciones -->
            <div class="auth-section">
                <div class="auth-section-title"><i class="fa fa-shield-alt"></i> Autorizaciones y Consentimientos</div>
                <div class="auth-checkbox-group">
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="cod_estado_autorizo_datos_firma_contrato_alianza" name="cod_estado_autorizo_datos_firma_contrato_alianza" value="1">
                        <span class="auth-checkbox-custom"><i class="fa fa-check"></i></span>
                        <span class="auth-checkbox-text">Autorizo el uso de mis datos y firma electrónica para diligenciar el <strong>contrato de alianza comercial</strong>.</span>
                    </label>
                    
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="cod_estado_autorizo_datos_firma_contrato_agencia" name="cod_estado_autorizo_datos_firma_contrato_agencia" value="1">
                        <span class="auth-checkbox-custom"><i class="fa fa-check"></i></span>
                        <span class="auth-checkbox-text">Autorizo el uso de mis datos y firma electrónica para diligenciar el <strong>contrato de agencia comercial</strong>.</span>
                    </label>
                    
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="cod_estado_autorizo_datos_firma_acuerdo_confidencialidad" name="cod_estado_autorizo_datos_firma_acuerdo_confidencialidad" value="1">
                        <span class="auth-checkbox-custom"><i class="fa fa-check"></i></span>
                        <span class="auth-checkbox-text">Autorizo el uso de mis datos y firma electrónica para diligenciar el <strong>acuerdo de confidencialidad</strong>.</span>
                    </label>
                    
                    <label class="auth-checkbox-item">
                        <input type="checkbox" id="cod_estado_declaro_autorizo_informacion_sumistrada_real" name="cod_estado_declaro_autorizo_informacion_sumistrada_real" value="1">
                        <span class="auth-checkbox-custom"><i class="fa fa-check"></i></span>
                        <span class="auth-checkbox-text">Declaro que la información personal suministrada es real y autorizo el uso de la misma. <a href="#" onclick="alert('Política de tratamiento de datos'); return false;">Ver política de tratamiento de datos</a></span>
                    </label>
                </div>
                
                <button type="button" class="btn-config btn-config-primary" id="btnGuardarAutorizaciones" style="margin-top: 1rem;"><i class="fa fa-save"></i> Guardar Autorizaciones</button>
                <input type="hidden" id="codAdminAuth" value="<?php echo $cod_administrador; ?>">
            </div>
        </div>

        <!-- Card de Opciones Extra -->
        <div class="config-card">
            <div class="config-card-header"><i class="fa fa-folder-open"></i><h3>Otras Opciones</h3></div>
            <div class="form-group-config">
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 1rem;">Gestione sus registros archivados:</p>
                <a href="lista_archivados_aliado_movil.php" class="btn-config btn-config-primary" style="background: rgba(65, 105, 225, 0.2); border: 1px solid rgba(65, 105, 225, 0.4);">
                    <i class="fa fa-box-archive"></i> Ver Registros Archivados
                </a>
            </div>
        </div>
    </div>
</main>

<script>
// ===================== TABS =====================
document.querySelectorAll('.firma-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.firma-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.firma-content').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('content-' + this.dataset.tab).classList.add('active');
    });
});

// ===================== SIGNATURE PAD =====================
var canvas = document.getElementById('firmaCanvas');
var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(255, 255, 255)',
    penColor: 'rgb(0, 0, 0)',
    minWidth: 0.5,
    maxWidth: 4,
    throttle: 0,
    minDistance: 0,
    velocityFilterWeight: 0.7,
    dotSize: function() {
        return (this.minWidth + this.maxWidth) / 2;
    }
});

// Ajustar tamaño del canvas
function resizeCanvas() {
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    var rect = canvas.getBoundingClientRect();
    canvas.width = rect.width * ratio;
    canvas.height = rect.height * ratio;
    canvas.getContext('2d').scale(ratio, ratio);
    signaturePad.clear();
}

window.addEventListener('resize', resizeCanvas);
resizeCanvas();

// Limpiar canvas
document.getElementById('btnLimpiar').addEventListener('click', function() {
    signaturePad.clear();
});

// Deshacer (último trazo)
document.getElementById('btnDeshacer').addEventListener('click', function() {
    var data = signaturePad.toData();
    if (data && data.length > 0) {
        data.pop();
        signaturePad.fromData(data);
    }
});

// Guardar firma táctil
document.getElementById('btnGuardarFirmaTactil').addEventListener('click', function() {
    var btn = this;
    var alertEl = document.getElementById('alertFirma');
    
    if (signaturePad.isEmpty()) {
        alertEl.className = 'alert-config error';
        alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> Por favor dibuje su firma antes de guardar';
        alertEl.style.display = 'block';
        return;
    }
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
    alertEl.style.display = 'none';
    
    var firmaData = signaturePad.toDataURL('image/png');
    var codAdmin = document.getElementById('codAdminTactil').value;
    
    $.ajax({
        url: 'actualizar_firma_tactil_ajax.php',
        type: 'POST',
        data: { 
            cod_administrador: codAdmin,
            firma_base64: firmaData
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alertEl.className = 'alert-config success';
                alertEl.innerHTML = '<i class="fa fa-check-circle"></i> ' + response.message;
                alertEl.style.display = 'block';
                if (response.url_firma) {
                    var container = document.getElementById('firmaPreviewContainer');
                    container.innerHTML = '<img src="' + response.url_firma + '?' + new Date().getTime() + '" alt="Firma" id="firmaPreviewImg">';
                }
            } else {
                alertEl.className = 'alert-config error';
                alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> ' + response.message;
                alertEl.style.display = 'block';
            }
        },
        error: function() {
            alertEl.className = 'alert-config error';
            alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> Error de conexión';
            alertEl.style.display = 'block';
        },
        complete: function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-save"></i> Guardar Firma Táctil';
        }
    });
});
// ===================== SUBIR ARCHIVO =====================
document.getElementById('nueva_firma').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var container = document.getElementById('firmaPreviewContainer');
            var noFirmaText = document.getElementById('noFirmaText');
            if (noFirmaText) noFirmaText.style.display = 'none';
            container.innerHTML = '<img src="' + e.target.result + '" alt="Vista previa" id="firmaPreviewImg">';
        };
        reader.readAsDataURL(file);
    }
});
document.getElementById('formFirma').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var btn = document.getElementById('btnGuardarFirma');
    var alertEl = document.getElementById('alertFirma');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
    alertEl.style.display = 'none';
    
    $.ajax({
        url: 'actualizar_firma_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alertEl.className = 'alert-config success';
                alertEl.innerHTML = '<i class="fa fa-check-circle"></i> ' + response.message;
                alertEl.style.display = 'block';
                if (response.url_firma) {
                    var container = document.getElementById('firmaPreviewContainer');
                    container.innerHTML = '<img src="' + response.url_firma + '?' + new Date().getTime() + '" alt="Firma" id="firmaPreviewImg">';
                }
            } else {
                alertEl.className = 'alert-config error';
                alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> ' + response.message;
                alertEl.style.display = 'block';
            }
        },
        error: function() {
            alertEl.className = 'alert-config error';
            alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> Error de conexión';
            alertEl.style.display = 'block';
        },
        complete: function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-save"></i> Guardar Imagen';
        }
    });
});

// ===================== GUARDAR AUTORIZACIONES =====================
document.getElementById('btnGuardarAutorizaciones').addEventListener('click', function() {
    var btn = this;
    var alertEl = document.getElementById('alertFirma');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
    alertEl.style.display = 'none';
    
    var codAdmin = document.getElementById('codAdminAuth').value;
    var auth1 = document.getElementById('cod_estado_autorizo_datos_firma_contrato_alianza').checked ? 1 : 0;
    var auth2 = document.getElementById('cod_estado_autorizo_datos_firma_contrato_agencia').checked ? 1 : 0;
    var auth3 = document.getElementById('cod_estado_autorizo_datos_firma_acuerdo_confidencialidad').checked ? 1 : 0;
    var auth4 = document.getElementById('cod_estado_declaro_autorizo_informacion_sumistrada_real').checked ? 1 : 0;
    
    $.ajax({
        url: 'actualizar_autorizaciones_ajax.php',
        type: 'POST',
        data: {
            cod_administrador: codAdmin,
            cod_estado_autorizo_datos_firma_contrato_alianza: auth1,
            cod_estado_autorizo_datos_firma_contrato_agencia: auth2,
            cod_estado_autorizo_datos_firma_acuerdo_confidencialidad: auth3,
            cod_estado_declaro_autorizo_informacion_sumistrada_real: auth4
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alertEl.className = 'alert-config success';
                alertEl.innerHTML = '<i class="fa fa-check-circle"></i> ' + response.message;
                alertEl.style.display = 'block';
            } else {
                alertEl.className = 'alert-config error';
                alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> ' + response.message;
                alertEl.style.display = 'block';
            }
        },
        error: function() {
            alertEl.className = 'alert-config error';
            alertEl.innerHTML = '<i class="fa fa-exclamation-circle"></i> Error de conexión';
            alertEl.style.display = 'block';
        },
        complete: function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-save"></i> Guardar Autorizaciones';
        }
    });
});
</script>

<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>
