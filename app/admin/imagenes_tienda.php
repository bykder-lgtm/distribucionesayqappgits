<?php
/**
 * Página de Carga de Imágenes para Tiendas
 * Recibe el parámetro 'cod' que contiene el cod_tienda encriptado
 * Desencripta y muestra el formulario para cargar imágenes
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
                
                // Verificar qué imágenes ya están cargadas
                $tiene_original = !empty($datos_tienda['url_img_orig_tienda']);
                $tiene_fachada = !empty($datos_tienda['url_img_fachada_tienda']);
                $tiene_interior = !empty($datos_tienda['url_img_interna_tienda']);
                $tiene_selfie = !empty($datos_tienda['url_img_selfieadmin_tienda']);
                $tiene_opcional = !empty($datos_tienda['url_img_otraopcional_tienda']);
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
    <title>Carga de Imágenes - Tienda</title>
    <link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 2rem;
            text-align: center;
            color: white;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .header i {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }
        
        .header p {
            font-size: 0.9rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }
        
        .content {
            padding: 2rem;
        }
        
        .info-box {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .info-box h3 {
            color: #10b981;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .info-box p {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .upload-section {
            margin-bottom: 1.5rem;
        }
        
        .upload-label {
            color: #10b981;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .upload-description {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
            margin-bottom: 0.75rem;
        }
        
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }
        
        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem;
            background: rgba(16, 185, 129, 0.1);
            border: 2px dashed rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            color: rgba(255,255,255,0.8);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input-label:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.5);
        }
        
        .file-input-label.has-file {
            background: rgba(16, 185, 129, 0.2);
            border-style: solid;
            border-color: #10b981;
        }
        
        .preview-container {
            margin-top: 0.75rem;
            display: none;
        }
        
        .preview-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid rgba(16, 185, 129, 0.3);
        }
        
        .image-uploaded {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 12px;
            padding: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #3b82f6;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
        
        .btn-submit:disabled {
            background: rgba(255,255,255,0.1);
            cursor: not-allowed;
            transform: none;
        }
        
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            color: #ef4444;
        }
        
        .error-message i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            color: #10b981;
        }
        
        .success-message i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php if (!$tienda_valida): ?>
        <div class="container">
            <div class="content">
                <div class="error-message">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <h2>Enlace no válido</h2>
                    <p>El enlace que has utilizado no es válido o ha expirado.</p>
                    <p style="margin-top: 0.5rem; font-size: 0.85rem;">Por favor, contacta al asesor que te compartió el enlace.</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="header"><i class="fa-solid fa-images"></i><h1>Carga de Imágenes</h1><p><?php echo $datos_tienda['nombre_tienda']; ?></p></div>
            
            <div class="content">
                <div class="info-box"><h3>¡Bienvenido!</h3><p>Por favor, carga las imágenes de tu tienda. Asegúrate de que las fotos sean claras y de buena calidad.</p></div>
                
                <form id="formImagenes" enctype="multipart/form-data">
                    <input type="hidden" name="cod_tienda_cryp" value="<?php echo $cod_tienda_cryp; ?>">
                    <!-- Imagen Original -->
                    <div class="upload-section">
                        <div class="upload-label"><i class="fa-solid fa-camera"></i>Logo de la Tienda *</div>
                        <div class="upload-description">Logo original de la tienda</div>
                        
                        <?php if ($tiene_original): ?>
                            <div class="image-uploaded"><i class="fa-solid fa-check-circle"></i>Imagen ya cargada - Puedes reemplazarla si lo deseas</div>
                        <?php endif; ?>
                        
                        <div class="file-input-wrapper">
                            <input type="file" id="imgOriginal" name="img_original" accept="image/*" onchange="previewImage(this, 'previewOriginal')">
                            <label for="imgOriginal" class="file-input-label" id="labelOriginal"><i class="fa-solid fa-cloud-arrow-up"></i><span>Seleccionar logo original</span></label>
                        </div>
                        <div class="preview-container" id="previewOriginal"></div>
                    </div>
                    
                    <!-- Imagen Fachada -->
                    <div class="upload-section">
                        <div class="upload-label"><i class="fa-solid fa-store"></i>Foto de Fachada *</div>
                        <div class="upload-description">Foto de la entrada principal de la tienda</div>
                        
                        <?php if ($tiene_fachada): ?>
                            <div class="image-uploaded"><i class="fa-solid fa-check-circle"></i>Imagen ya cargada - Puedes reemplazarla si lo deseas</div>
                        <?php endif; ?>
                        
                        <div class="file-input-wrapper">
                            <input type="file" id="imgFachada" name="img_fachada" accept="image/*" onchange="previewImage(this, 'previewFachada')">
                            <label for="imgFachada" class="file-input-label" id="labelFachada"><i class="fa-solid fa-cloud-arrow-up"></i><span>Seleccionar imagen de fachada</span></label>
                        </div>
                        <div class="preview-container" id="previewFachada"></div>
                    </div>
                    
                    <!-- Imagen Interior -->
                    <div class="upload-section">
                        <div class="upload-label"><i class="fa-solid fa-shop"></i>Foto Interior *</div>
                        <div class="upload-description">Foto del interior de la tienda</div>
                        
                        <?php if ($tiene_interior): ?>
                            <div class="image-uploaded"><i class="fa-solid fa-check-circle"></i>Imagen ya cargada - Puedes reemplazarla si lo deseas</div>
                        <?php endif; ?>
                        
                        <div class="file-input-wrapper">
                            <input type="file" id="imgInterior" name="img_interior" accept="image/*" onchange="previewImage(this, 'previewInterior')">
                            <label for="imgInterior" class="file-input-label" id="labelInterior"><i class="fa-solid fa-cloud-arrow-up"></i><span>Seleccionar imagen interior</span></label>
                        </div>
                        <div class="preview-container" id="previewInterior"></div>
                    </div>
                    
                    <!-- Imagen Selfie Admin -->
                    <div class="upload-section">
                        <div class="upload-label"><i class="fa-solid fa-user-tie"></i>Selfie con Administrador *</div>
                        <div class="upload-description">Foto con el administrador en la tienda</div>
                        
                        <?php if ($tiene_selfie): ?>
                            <div class="image-uploaded"><i class="fa-solid fa-check-circle"></i>Imagen ya cargada - Puedes reemplazarla si lo deseas</div>
                        <?php endif; ?>
                        
                        <div class="file-input-wrapper">
                            <input type="file" id="imgSelfie" name="img_selfie" accept="image/*" onchange="previewImage(this, 'previewSelfie')">
                            <label for="imgSelfie" class="file-input-label" id="labelSelfie"><i class="fa-solid fa-cloud-arrow-up"></i><span>Seleccionar selfie con administrador</span></label>
                        </div>
                        <div class="preview-container" id="previewSelfie"></div>
                    </div>
                    
                    <!-- Imagen Opcional -->
                    <div class="upload-section">
                        <div class="upload-label"><i class="fa-solid fa-image"></i>Foto Opcional</div>
                        <div class="upload-description">Foto adicional de tu tienda (opcional)</div>
                        
                        <?php if ($tiene_opcional): ?>
                            <div class="image-uploaded"><i class="fa-solid fa-check-circle"></i>Imagen ya cargada - Puedes reemplazarla si lo deseas</div>
                        <?php endif; ?>
                        
                        <div class="file-input-wrapper">
                            <input type="file" id="imgOpcional" name="img_opcional" accept="image/*" onchange="previewImage(this, 'previewOpcional')">
                            <label for="imgOpcional" class="file-input-label" id="labelOpcional"><i class="fa-solid fa-cloud-arrow-up"></i><span>Seleccionar imagen opcional</span></label>
                        </div>
                        <div class="preview-container" id="previewOpcional"></div>
                    </div>
                    
                    <button type="submit" class="btn-submit" id="btnEnviar"><i class="fa-solid fa-upload"></i>Cargar Imágenes</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    
    <script>
        function previewImage(input, containerId) {
            const container = document.getElementById(containerId);
            const label = input.nextElementSibling;
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    container.innerHTML = '<img src="' + e.target.result + '" class="preview-image" alt="Preview">';
                    container.style.display = 'block';
                    if (label) {
                        label.classList.add('has-file');
                        const span = label.querySelector('span');
                        if (span) {
                            span.textContent = input.files[0].name;
                        }
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        document.getElementById('formImagenes').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const btnEnviar = document.getElementById('btnEnviar');
            
            // Validar que todas las imágenes obligatorias estén presentes
            const hasOriginal = document.getElementById('imgOriginal').files.length > 0 || <?php echo $tiene_original ? 'true' : 'false'; ?>;
            const hasFachada = document.getElementById('imgFachada').files.length > 0 || <?php echo $tiene_fachada ? 'true' : 'false'; ?>;
            const hasInterior = document.getElementById('imgInterior').files.length > 0 || <?php echo $tiene_interior ? 'true' : 'false'; ?>;
            const hasSelfie = document.getElementById('imgSelfie').files.length > 0 || <?php echo $tiene_selfie ? 'true' : 'false'; ?>;
            
            const missingImages = [];
            if (!hasOriginal) missingImages.push('Foto Original');
            if (!hasFachada) missingImages.push('Fachada');
            if (!hasInterior) missingImages.push('Interior');
            if (!hasSelfie) missingImages.push('Selfie con Administrador');
            
            if (missingImages.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Imágenes requeridas',
                    text: 'Faltan las siguientes imágenes: ' + missingImages.join(', '),
                    confirmButtonColor: '#10b981'
                });
                return;
            }
            
            btnEnviar.disabled = true;
            btnEnviar.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Cargando...';
            
            fetch('guardar_imagenes_tienda_ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: data.message,
                        confirmButtonColor: '#10b981'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#ef4444'
                    });
                    btnEnviar.disabled = false;
                    btnEnviar.innerHTML = '<i class="fa-solid fa-upload"></i> Cargar Imágenes';
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar las imágenes. Por favor, intenta nuevamente.',
                    confirmButtonColor: '#ef4444'
                });
                btnEnviar.disabled = false;
                btnEnviar.innerHTML = '<i class="fa-solid fa-upload"></i> Cargar Imágenes';
            });
        });
    </script>
</body>
</html>
