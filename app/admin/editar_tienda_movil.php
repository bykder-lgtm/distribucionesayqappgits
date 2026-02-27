<?php 
$nombre_pagina = "Editar Tienda";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php"); ?>
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_asesor.php"); ?>

<?php
$cod_tienda = isset($_GET['cod_tienda']) ? intval($_GET['cod_tienda']) : 0;

if (!$cod_tienda) { header("Location: lista_aliado_asesor_movil.php"); exit; }

// Obtener información de la tienda
$sql = "SELECT t.*, a.nombres_apellidos_tercero as nombre_aliado, a.nombres, a.apellidos, a.comision_ptj FROM tbl15_tienda t LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador WHERE t.cod_tienda = '$cod_tienda'";
$r = mysqli_query($conectar, $sql);
$tienda = mysqli_fetch_assoc($r);

if (!$tienda) { header("Location: lista_aliado_asesor_movil.php"); exit; }

// Obtener aliados para el select
$sql_aliados = "SELECT cod_administrador, nombres_apellidos_tercero, nombres, apellidos, comision_ptj FROM tbl15_administrador WHERE cod_seguridad = '23' AND cod_estado_activacion_usuario = '1' ORDER BY nombres_apellidos_tercero, nombres";
$res_aliados = mysqli_query($conectar, $sql_aliados);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
        min-height: 100vh;
        margin: 0; padding: 0; box-sizing: border-box;
    }
    .page-container {
        padding: 1rem;
        padding-bottom: 100px;
        max-width: 800px;
        margin: 0 auto;
    }
    .page-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .back-btn {
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        width: 40px; height: 40px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        text-decoration: none;
    }
    .page-title {
        color: white; margin: 0; font-size: 1.25rem;
    }
    
    .edit-card {
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .edit-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        padding: 1.5rem;
        text-align: center;
    }
    .edit-title {
        color: white; font-size: 1.5rem; font-weight: 700; margin: 0;
        display: flex; align-items: center; justify-content: center; gap: 0.75rem;
    }
    
    .edit-body {
        padding: 1.5rem;
    }

    /* Form Styles */
    .form-section-title {
        color: #10b981; font-size: 0.9rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1px; margin: 1.5rem 0 1rem 0; padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(16, 185, 129, 0.2); display: flex; align-items: center; gap: 0.5rem;
    }
    .form-section-title:first-child { margin-top: 0; }
    
    .form-group { margin-bottom: 1rem; }
    .form-label { 
        display: block; color: rgba(255,255,255,0.8); font-size: 0.85rem; 
        font-weight: 600; margin-bottom: 0.5rem; 
    }
    .form-input, .form-select {
        width: 100%; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 12px; padding: 0.85rem 1rem; color: white; font-size: 0.95rem; outline: none;
        transition: all 0.3s ease; box-sizing: border-box;
    }
    .form-input:focus, .form-select:focus { 
        border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); 
    }
    .form-select {
        appearance: none; cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 1rem center; background-size: 1rem;
        background-color: rgba(16, 185, 129, 0.1);
    }
    .form-select option { background-color: #1a1f2e; color: white; }

    .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    @media(max-width: 640px) {
        .form-row { grid-template-columns: repeat(2, 1fr) !important; gap: 0.5rem; }
    }

    .file-input-wrapper {
        position: relative; border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 12px;
        padding: 1.5rem; text-align: center; background: rgba(16, 185, 129, 0.05); 
        transition: all 0.3s ease; cursor: pointer;
    }
    .file-input-wrapper:hover { border-color: #10b981; background: rgba(16, 185, 129, 0.1); }
    .file-input-wrapper input[type="file"] {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;
    }
    .file-input-icon { font-size: 2rem; color: #10b981; margin-bottom: 0.5rem; }
    .file-input-text { font-size: 0.85rem; color: rgba(255,255,255,0.7); }
    .image-preview {
        margin-top: 1rem; width: 100%; height: 150px; object-fit: cover; border-radius: 8px;
        display: none; border: 1px solid rgba(16, 185, 129, 0.3);
    }
    .current-file {
        margin-top: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1);
        border-radius: 8px; font-size: 0.8rem; color: #10b981;
        display: flex; align-items: center; gap: 0.5rem;
    }

    .gps-btn {
        background: #10b981; color: white; border: none; padding: 0.85rem; border-radius: 12px;
        cursor: pointer; width: 100%; display: flex; align-items: center; justify-content: center;
        gap: 0.5rem; font-weight: 600; transition: all 0.3s ease;
    }
    .gps-btn:hover { background: #059669; }
    .gps-status { 
        margin-top: 0.5rem; font-size: 0.8rem; padding: 0.5rem; border-radius: 8px; display: none; 
    }

    .submit-btn {
        width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none;
        padding: 1rem; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; 
        margin-top: 1.5rem; transition: all 0.3s ease;
    }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3); }

    .action-buttons {
        display: flex; gap: 0.75rem; margin-top: 1.5rem;
    }
    .cancel-btn {
        flex: 1; background: rgba(255,255,255,0.1); color: white; border: none;
        padding: 1rem; border-radius: 12px; font-size: 1rem; font-weight: 600; cursor: pointer;
        text-decoration: none; text-align: center;
    }
    .cancel-btn:hover { background: rgba(255,255,255,0.2); color: white; text-decoration: none; }

    /* Bottom Navigation Styles */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border-top: 1px solid rgba(16, 185, 129, 0.2);
        display: flex;
        justify-content: space-around;
        padding: 0.75rem 0;
        z-index: 1000;
        backdrop-filter: blur(20px);
    }
    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: rgba(255,255,255,0.5);
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 12px;
    }
    .nav-item:hover, .nav-item.active {
        color: #10b981;
        text-decoration: none;
    }
    .nav-item.active {
        background: rgba(16, 185, 129, 0.1);
    }
    .nav-item i {
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }
    .nav-item span {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>
</head>
<body>

<main class="page-container">
    <div class="page-header">
        <a href="ver_detalle_tienda_movil.php?cod_tienda=<?php echo $cod_tienda; ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Editar Tienda</h1>
    </div>

    <div class="edit-card">
        <div class="edit-header">
            <h2 class="edit-title">
                <i class="fa-solid fa-store"></i>
                <?php echo $tienda['nombre_tienda']; ?>
            </h2>
        </div>
        
        <div class="edit-body">
            <form id="formEditarTienda" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="cod_tienda" value="<?php echo $cod_tienda; ?>">

                <!-- Sección 1: Información Básica -->
                <div class="form-section-title">
                    <i class="fa-solid fa-info-circle"></i> Información Básica
                </div>

                <div class="form-group">
                    <label class="form-label">Aliado Estratégico *</label>
                    <select class="form-select" name="cod_aliado_estrategico" id="cod_aliado_estrategico" onchange="actualizarBancosYComision(this)" required>
                        <option value="">Seleccione...</option>
                        <?php while($aliado = mysqli_fetch_assoc($res_aliados)): ?>
                            <option value="<?php echo $aliado['cod_administrador']; ?>" 
                                    data-comision="<?php echo $aliado['comision_ptj']; ?>"
                                    <?php echo ($aliado['cod_administrador'] == $tienda['cod_aliado_estrategico']) ? 'selected' : ''; ?>>
                                <?php echo !empty($aliado['nombres_apellidos_tercero']) ? $aliado['nombres_apellidos_tercero'] : ($aliado['nombres'] . ' ' . $aliado['apellidos']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre de la Tienda *</label>
                    <input type="text" class="form-input" name="nombre1_tercero" id="nombre1_tercero" value="<?php echo htmlspecialchars($tienda['nombre_tienda']); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIT / Documento *</label>
                        <input type="number" class="form-input" name="identificacion_tercero" id="identificacion_tercero" value="<?php echo $tienda['identificacion_tercero']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="telefono1_tercero" value="<?php echo $tienda['telefono1_tercero']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Dirección *</label>
                    <input type="text" class="form-input" name="direccion_tercero" id="direccion_tercero" value="<?php echo htmlspecialchars($tienda['direccion_tercero']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-input" name="correo_tercero" id="correo_tercero" value="<?php echo $tienda['correo_tercero']; ?>" required>
                </div>

                <!-- Sección 2: Representante Legal -->
                <div class="form-section-title">
                    <i class="fa-solid fa-user-tie"></i> Representante Legal
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" class="form-input" name="nombre_representante" id="nombre_representante" value="<?php echo htmlspecialchars($tienda['nombre_representante']); ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Documento</label>
                        <input type="number" class="form-input" name="documento_representante" id="documento_representante" value="<?php echo $tienda['documento_representante']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-input" name="correo_representante" id="correo_representante" value="<?php echo $tienda['correo_representante']; ?>">
                    </div>
                </div>

                <!-- Sección 3: Información Financiera -->
                <div class="form-section-title"><i class="fa-solid fa-dollar-sign"></i> Información Financiera</div>
                
                <div class="form-group">
                    <label class="form-label">Banco</label>
                    <select class="form-select" name="cod_banco_cuenta" id="cod_banco_cuenta"><option value="">Cargando bancos...</option></select>
                    <div id="loading_bancos" style="display:none; color: #10b981; font-size: 0.8rem; margin-top: 5px;">Cargando bancos...</div>
                </div>

                <!-- Sección 4: Ubicación GPS -->
                <div class="form-section-title"><i class="fa-solid fa-map-marker-alt"></i> Ubicación GPS</div>
                
                <div class="form-group">
                    <button type="button" class="gps-btn" onclick="obtenerUbicacion()"><i class="fa-solid fa-location-crosshairs"></i> Actualizar Ubicación</button>
                    <div id="gpsStatus" class="gps-status"></div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Coordenadas</label>
                    <input type="text" class="form-input" name="ubicacion_gps_tienda" id="ubicacion_gps_tienda" value="<?php echo $tienda['ubicacion_gps_tienda']; ?>" readonly placeholder="Latitud, Longitud">
                </div>

                <!-- Sección 5: Documentación Legal -->
                <div class="form-section-title">
                    <i class="fa-solid fa-file-contract"></i> Documentación Legal
                </div>
                
                <div class="form-group">
                    <label class="form-label">RUT (PDF/Imagen)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_rut_tienda" id="url_rut_tienda" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-input-text">Seleccionar nuevo archivo o mantener actual</div>
                    </div>
                    <?php if (!empty($tienda['url_documentacion_rut_tienda'])): ?>
                    <div class="current-file">
                        <i class="fa-solid fa-file"></i>
                        Archivo actual: <?php echo basename($tienda['url_documentacion_rut_tienda']); ?>
                        <a href="../<?php echo $tienda['url_documentacion_rut_tienda']; ?>" target="_blank" style="color: #10b981; margin-left: auto;"><i class="fa-solid fa-external-link-alt"></i></a>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="form-label">Cámara de Comercio (PDF/Imagen)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_camara_comercio_tienda" id="url_camara_comercio_tienda" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-input-text">Seleccionar nuevo archivo o mantener actual</div>
                    </div>
                    <?php if (!empty($tienda['url_documentacion_camaracomercio_tienda'])): ?>
                    <div class="current-file">
                        <i class="fa-solid fa-file"></i>
                        Archivo actual: <?php echo basename($tienda['url_documentacion_camaracomercio_tienda']); ?>
                        <a href="../<?php echo $tienda['url_documentacion_camaracomercio_tienda']; ?>" target="_blank" style="color: #10b981; margin-left: auto;"><i class="fa-solid fa-external-link-alt"></i></a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sección 6: Imágenes del Establecimiento -->
                <div class="form-section-title"><i class="fa-solid fa-camera"></i> Imágenes del Establecimiento</div>

                <div class="form-group">
                    <label class="form-label">Logo de la Tienda</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="imagen_tienda" id="imagen_tienda" accept="image/*" onchange="previewImage(this, 'preview_logo')">
                        <div class="file-input-icon"><i class="fa-solid fa-image"></i></div>
                        <div class="file-input-text">Seleccionar nueva imagen o mantener actual</div>
                    </div>
                    <?php if (!empty($tienda['url_img_orig_tienda'])): ?>
                    <div class="current-file">
                        <i class="fa-solid fa-image"></i>
                        Imagen actual: <?php echo basename($tienda['url_img_orig_tienda']); ?>
                        <a href="../<?php echo $tienda['url_img_orig_tienda']; ?>" target="_blank" style="color: #10b981; margin-left: auto;">
                            <i class="fa-solid fa-external-link-alt"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    <img id="preview_logo" class="image-preview" alt="Vista previa logo">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fachada</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="url_img_fachada_tienda" id="url_img_fachada_tienda" accept="image/*" onchange="previewImage(this, 'preview_fachada')">
                            <div class="file-input-icon"><i class="fa-solid fa-store"></i></div>
                        </div>
                        <?php if (!empty($tienda['url_img_fachada_tienda'])): ?>
                        <div class="current-file">
                            <i class="fa-solid fa-image"></i>
                            <?php echo basename($tienda['url_img_fachada_tienda']); ?>
                            <a href="../<?php echo $tienda['url_img_fachada_tienda']; ?>" target="_blank" style="color: #10b981; margin-left: auto;">
                                <i class="fa-solid fa-external-link-alt"></i>
                            </a>
                        </div>
                        <?php endif; ?>
                        <img id="preview_fachada" class="image-preview" alt="Vista previa">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Interna</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="url_img_interna_tienda" id="url_img_interna_tienda" accept="image/*" onchange="previewImage(this, 'preview_interna')">
                            <div class="file-input-icon"><i class="fa-solid fa-person-shelter"></i></div>
                        </div>
                        <?php if (!empty($tienda['url_img_interna_tienda'])): ?>
                        <div class="current-file">
                            <i class="fa-solid fa-image"></i>
                            <?php echo basename($tienda['url_img_interna_tienda']); ?>
                            <a href="../<?php echo $tienda['url_img_interna_tienda']; ?>" target="_blank" style="color: #10b981; margin-left: auto;"><i class="fa-solid fa-external-link-alt"></i></a>
                        </div>
                        <?php endif; ?>
                        <img id="preview_interna" class="image-preview" alt="Vista previa">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Selfie con Admin</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_img_selfieadmin_tienda" id="url_img_selfieadmin_tienda" accept="image/*" onchange="previewImage(this, 'preview_selfie')">
                        <div class="file-input-icon"><i class="fa-solid fa-camera-retro"></i></div>
                        <div class="file-input-text">Seleccionar nuevo selfie o mantener actual</div>
                    </div>
                    <?php if (!empty($tienda['url_img_selfieadmin_tienda'])): ?>
                    <div class="current-file">
                        <i class="fa-solid fa-image"></i>
                        Selfie actual: <?php echo basename($tienda['url_img_selfieadmin_tienda']); ?>
                        <a href="../<?php echo $tienda['url_img_selfieadmin_tienda']; ?>" target="_blank" style="color: #10b981; margin-left: auto;">
                            <i class="fa-solid fa-external-link-alt"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    <img id="preview_selfie" class="image-preview" alt="Vista previa selfie">
                </div>

                <div class="action-buttons">
                    <a href="ver_detalle_tienda_movil.php?cod_tienda=<?php echo $cod_tienda; ?>" class="cancel-btn"><i class="fa-solid fa-times"></i> Cancelar</a>
                    <button type="submit" class="submit-btn" style="flex: 2;">
                        <i class="fa-solid fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
// Cargar bancos al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const codAliado = document.getElementById('cod_aliado_estrategico').value;
    if (codAliado) {
        actualizarBancosYComision(document.getElementById('cod_aliado_estrategico'));
    }
});

function actualizarBancosYComision(select) {
    const codAliado = select.value;
    
    // Cargar bancos
    const bancoSelect = document.getElementById('cod_banco_cuenta');
    const loading = document.getElementById('loading_bancos');
    
    if (codAliado) {
        bancoSelect.disabled = true;
        loading.style.display = 'block';
        
        $.ajax({
            url: 'obtener_bancos_cuenta_por_aliado_ajax.php',
            type: 'POST',
            data: { cod_aliado_estrategico: codAliado },
            dataType: 'json',
            success: function(response) {
                bancoSelect.innerHTML = '';
                
                if (response.success && response.bancos.length > 0) {
                    bancoSelect.innerHTML = '<option value="">-- Seleccione un banco --</option>';
                    response.bancos.forEach(function(banco) {
                        let textoOpcion = banco.nombre_banco_cuenta + ' - ' + banco.numero_banco_cuenta;
                        if (banco.nombre_titular_cuenta) {
                            textoOpcion += ' (' + banco.nombre_titular_cuenta + ')';
                        }
                        
                        const selected = banco.cod_banco_cuenta == '<?php echo $tienda["cod_banco_cuenta"]; ?>' ? 'selected' : '';
                        bancoSelect.innerHTML += '<option value="' + banco.cod_banco_cuenta + '" ' + selected + '>' + textoOpcion + '</option>';
                    });
                } else {
                    bancoSelect.innerHTML = '<option value="">-- No hay bancos registrados --</option>';
                }
                
                bancoSelect.disabled = false;
                loading.style.display = 'none';
            },
            error: function() {
                loading.style.display = 'none';
                bancoSelect.innerHTML = '<option value="">-- Error al cargar bancos --</option>';
                bancoSelect.disabled = false;
            }
        });
    } else {
        bancoSelect.innerHTML = '<option value="">Seleccione Aliado primero</option>';
        bancoSelect.disabled = true;
    }
}

// Obtener ubicación GPS
function obtenerUbicacion() {
    const status = document.getElementById('gpsStatus');
    const input = document.getElementById('ubicacion_gps_tienda');
    
    status.style.display = 'block';
    status.style.background = 'rgba(0, 212, 255, 0.2)';
    status.style.color = '#00d4ff';
    status.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...';
    
    if (!navigator.geolocation) {
        status.style.background = 'rgba(239, 68, 68, 0.2)';
        status.style.color = '#ef4444';
        status.innerHTML = 'Tu navegador no soporta geolocalización';
        return;
    }
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude.toFixed(6);
            const lng = position.coords.longitude.toFixed(6);
            input.value = lat + ',' + lng;
            
            status.style.background = 'rgba(16, 185, 129, 0.2)';
            status.style.color = '#10b981';
            status.innerHTML = '<i class="fa fa-check"></i> Ubicación actualizada: ' + lat + ', ' + lng;
        },
        function(error) {
            status.style.background = 'rgba(239, 68, 68, 0.2)';
            status.style.color = '#ef4444';
            status.innerHTML = 'Error al obtener ubicación. Asegúrate de tener el GPS activado.';
        },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

// Previsualizar imagen
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

function updateFileName(input) {
    if (input.files && input.files.length > 0) {
        const fileName = input.files[0].name;
        const wrapper = input.parentElement;
        const textElement = wrapper.querySelector('.file-input-text');
        if (textElement) {
            textElement.textContent = fileName;
            textElement.style.color = '#10b981';
            textElement.style.fontWeight = 'bold';
        }
    }
}

// Envío del formulario
document.getElementById('formEditarTienda').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('cod_administrador', '<?php echo $cod_administrador; ?>');
    
    Swal.fire({
        title: 'Guardando cambios...',
        text: 'Procesando información',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
        background: '#1a1f2e',
        color: 'white'
    });

    $.ajax({
        url: '../admin/edit_tienda_modal_asesor_movil_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'Los cambios se guardaron correctamente',
                    confirmButtonColor: '#10b981',
                    background: '#1a1f2e',
                    color: 'white'
                }).then(() => {
                    window.location.href = 'ver_detalle_tienda_movil.php?cod_tienda=<?php echo $cod_tienda; ?>';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'No se pudieron guardar los cambios',
                    confirmButtonColor: '#10b981',
                    background: '#1a1f2e',
                    color: 'white'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX:', xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'Hubo un problema al enviar los datos. Intenta nuevamente.',
                confirmButtonColor: '#10b981',
                background: '#1a1f2e',
                color: 'white'
            });
        }
    });
});
</script>

<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

</body>
</html>