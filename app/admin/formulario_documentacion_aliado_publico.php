<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// Verificar si hay token en la URL
$token = isset($_GET['token']) ? mysqli_real_escape_string($conectar, $_GET['token']) : '';

if (empty($token)) { echo "<script>alert('Enlace inválido o expirado.'); window.close();</script>"; exit; }

// Buscar el aliado por token
$sql_aliado = "SELECT cod_administrador, nombres_apellidos_tercero, cedula, nombres, apellidos, correo, telefono, url_documentacion_rut_aliado, url_documentacion_camaracomercio_aliado
FROM tbl15_administrador WHERE token_documentacion = '$token' AND cod_seguridad = '23'";
$res_aliado = mysqli_query($conectar, $sql_aliado);
if (!$res_aliado || mysqli_num_rows($res_aliado) == 0) { echo "<script>alert('Enlace inválido o expirado.'); window.close();</script>"; exit; }

$aliado = mysqli_fetch_assoc($res_aliado);
$cod_aliado = $aliado['cod_administrador'];

// Obtener información de la empresa
$sql_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$res_empresa = mysqli_query($conectar, $sql_empresa);
$empresa = mysqli_fetch_assoc($res_empresa);
$nombre_empresa = isset($empresa['nombre_info_empresa']) ? $empresa['nombre_info_empresa'] : 'Sistema de Créditos';
$logo_empresa = isset($empresa['url_logo_min']) ? $empresa['url_logo_min'] : '../imagenes/logo.png';

// Obtener bancos disponibles
$sql_bancos = "SELECT cod_banco, nombre_banco FROM tbl15_banco WHERE cod_estado = '1' ORDER BY nombre_banco ASC";
$res_bancos = mysqli_query($conectar, $sql_bancos);

// Obtener cuentas bancarias del aliado
$sql_cuentas = "SELECT bc.*, b.nombre_banco FROM tbl15_banco_cuenta bc LEFT JOIN tbl15_banco b ON bc.cod_banco = b.cod_banco  WHERE bc.cod_administrador = '$cod_aliado' ORDER BY bc.cod_banco_cuenta DESC";
$res_cuentas = mysqli_query($conectar, $sql_cuentas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación - <?php echo htmlspecialchars($aliado['nombres_apellidos_tercero']); ?></title>
    <link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
            padding: 1rem;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
        }
        
        .header img {
            max-height: 50px;
            margin-bottom: 0.75rem;
        }
        
        .header h1 {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
        }
        
        /* Card aliado */
        .aliado-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .aliado-card h3 {
            color: #10b981;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .aliado-card p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
        }
        
        /* Sections */
        .section {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            color: #10b981;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Form elements */
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-input, .form-select {
            width: 100%;
            padding: 0.75rem;
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            color: white;
            font-size: 0.9rem;
            font-family: inherit;
        }
        
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        .form-select option {
            background: #1a1f2e;
            color: white;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        /* File upload */
        .file-upload {
            background: rgba(16, 185, 129, 0.05);
            border: 2px dashed rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload:hover {
            border-color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }
        
        .file-upload i {
            font-size: 2rem;
            color: rgba(16, 185, 129, 0.6);
            margin-bottom: 0.5rem;
        }
        
        .file-upload p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin: 0;
        }
        
        .file-upload small {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
        }
        
        .file-upload input {
            display: none;
        }
        
        /* Document status */
        .doc-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            font-size: 0.8rem;
        }
        
        .doc-status.uploaded {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        .doc-status.pending {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .doc-status a {
            color: inherit;
            text-decoration: none;
            margin-left: auto;
        }
        
        /* Buttons */
        .btn {
            padding: 0.85rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            width: 100%;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            width: 100%;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }
        
        /* Bank cards */
        .bank-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
        }
        
        .bank-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        
        .bank-card-title {
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .bank-card-title i {
            color: #10b981;
        }
        
        .bank-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
        }
        
        .bank-badge.active {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        .bank-badge.inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .bank-card-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }
        
        .bank-card-body p {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
        }
        
        .bank-card-body span {
            color: white;
            font-weight: 500;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: rgba(255,255,255,0.5);
        }
        
        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            opacity: 0.4;
        }
        
        /* Info note */
        .info-note {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            padding: 0.75rem;
            margin-top: 1rem;
        }
        
        .info-note p {
            color: rgba(255,255,255,0.8);
            font-size: 0.75rem;
            line-height: 1.4;
            margin: 0;
        }
        
        .info-note i {
            color: #10b981;
            margin-right: 0.35rem;
        }
        
        /* Success message */
        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
            display: none;
        }
        
        .success-message i {
            font-size: 2rem;
            color: #10b981;
            margin-bottom: 0.5rem;
        }
        
        .success-message p {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="<?php echo htmlspecialchars($logo_empresa); ?>" alt="Logo">
            <h1><?php echo htmlspecialchars($nombre_empresa); ?></h1>
            <p>Formulario de Documentación</p>
        </div>
        
        <!-- Card Aliado -->
        <div class="aliado-card">
            <h3><i class="fa-solid fa-user-tie"></i> <?php echo htmlspecialchars($aliado['nombres_apellidos_tercero']); ?></h3>
            <p><i class="fa-solid fa-id-card"></i> CC: <?php echo htmlspecialchars($aliado['cedula']); ?></p>
        </div>
        
        <!-- Sección Documentación Legal -->
        <div class="section">
            <h2 class="section-title">
                <i class="fa-solid fa-file-contract"></i> Documentación Legal
            </h2>
            
            <form id="formDocumentacion" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_aliado; ?>">
                <input type="hidden" name="action" value="guardar_documentos">
                
                <!-- RUT -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-file-pdf"></i> RUT (Registro Único Tributario)
                    </label>
                    
                    <?php if (!empty($aliado['url_documentacion_rut_aliado'])): ?>
                    <div class="doc-status uploaded">
                        <i class="fa-solid fa-check-circle"></i>
                        Documento cargado
                        <a href="<?php echo htmlspecialchars($aliado['url_documentacion_rut_aliado']); ?>" target="_blank">
                            <i class="fa-solid fa-eye"></i> Ver
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="doc-status pending">
                        <i class="fa-solid fa-clock"></i>
                        Pendiente de carga
                    </div>
                    <?php endif; ?>
                    
                    <div class="file-upload" onclick="document.getElementById('input_rut').click()">
                        <i class="fa-solid fa-cloud-upload-alt"></i>
                        <p id="label_rut">Clic para seleccionar archivo</p>
                        <small>Formato: PDF (máx. 5MB)</small>
                        <input type="file" id="input_rut" name="url_documentacion_rut_aliado" accept=".pdf" onchange="mostrarNombreArchivo(this, 'label_rut')">
                    </div>
                </div>
                
                <!-- Cámara de Comercio -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-building"></i> Cámara de Comercio
                    </label>
                    
                    <?php if (!empty($aliado['url_documentacion_camaracomercio_aliado'])): ?>
                    <div class="doc-status uploaded">
                        <i class="fa-solid fa-check-circle"></i>
                        Documento cargado
                        <a href="<?php echo htmlspecialchars($aliado['url_documentacion_camaracomercio_aliado']); ?>" target="_blank">
                            <i class="fa-solid fa-eye"></i> Ver
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="doc-status pending">
                        <i class="fa-solid fa-clock"></i>
                        Pendiente de carga
                    </div>
                    <?php endif; ?>
                    
                    <div class="file-upload" onclick="document.getElementById('input_camara').click()">
                        <i class="fa-solid fa-cloud-upload-alt"></i>
                        <p id="label_camara">Clic para seleccionar archivo</p>
                        <small>Formato: PDF (máx. 5MB)</small>
                        <input type="file" id="input_camara" name="url_documentacion_camaracomercio_aliado" accept=".pdf" onchange="mostrarNombreArchivo(this, 'label_camara')">
                    </div>
                </div>
                
                <div class="info-note">
                    <p><i class="fa-solid fa-info-circle"></i> <strong>Nota:</strong> Si carga un nuevo documento, reemplazará el actual. Deje vacío para mantener el documento existente.</p>
                </div>
                
                <br>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Guardar Documentos
                </button>
            </form>
        </div>
        
        <!-- Sección Cuentas Bancarias -->
        <div class="section">
            <h2 class="section-title">
                <i class="fa-solid fa-university"></i> Cuentas Bancarias
            </h2>
            
            <!-- Lista de cuentas existentes -->
            <div id="lista_cuentas">
                <?php if (mysqli_num_rows($res_cuentas) > 0): ?>
                    <?php while($cuenta = mysqli_fetch_assoc($res_cuentas)): ?>
                    <div class="bank-card">
                        <div class="bank-card-header">
                            <span class="bank-card-title">
                                <i class="fa-solid fa-building-columns"></i>
                                <?php echo htmlspecialchars(isset($cuenta['nombre_banco']) ? $cuenta['nombre_banco'] : 'Banco'); ?>
                            </span>
                            <span class="bank-badge <?php echo $cuenta['cod_estado'] == '1' ? 'active' : 'inactive'; ?>">
                                <?php echo $cuenta['cod_estado'] == '1' ? 'ACTIVO' : 'INACTIVO'; ?>
                            </span>
                        </div>
                        <div class="bank-card-body">
                            <p>Número: <span><?php echo htmlspecialchars($cuenta['numero_banco_cuenta']); ?></span></p>
                            <p>Tipo: <span><?php echo $cuenta['cod_tipo_cuenta_banco'] == '1' ? 'Ahorros' : 'Corriente'; ?></span></p>
                            <?php if (!empty($cuenta['nombre_titular_cuenta'])): ?>
                            <p>Titular: <span><?php echo htmlspecialchars($cuenta['nombre_titular_cuenta']); ?></span></p>
                            <?php endif; ?>
                            <?php if (!empty($cuenta['identificacion_titular_cuenta'])): ?>
                            <p>CC/NIT: <span><?php echo htmlspecialchars($cuenta['identificacion_titular_cuenta']); ?></span></p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($cuenta['url_certificado_banco_cuenta'])): ?>
                        <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid rgba(255,255,255,0.1);">
                            <a href="<?php echo htmlspecialchars($cuenta['url_certificado_banco_cuenta']); ?>" target="_blank" style="color: #10b981; font-size: 0.8rem; text-decoration: none;">
                                <i class="fa-solid fa-file-certificate"></i> Ver Certificado Bancario
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-solid fa-piggy-bank"></i>
                        <p>No hay cuentas bancarias registradas</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Formulario agregar cuenta -->
            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 1rem;">
                <h3 style="color: rgba(255,255,255,0.9); font-size: 0.95rem; font-weight: 600; margin-bottom: 1rem;">
                    <i class="fa-solid fa-plus-circle" style="color: #3b82f6;"></i> Agregar Nueva Cuenta
                </h3>
                
                <form id="formBanco" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_aliado; ?>">
                    <input type="hidden" name="action" value="agregar_banco">
                    
                    <div class="form-group">
                        <label class="form-label">Banco *</label>
                        <select class="form-select" name="cod_banco" id="cod_banco" required>
                            <option value="">Seleccione un banco</option>
                            <?php mysqli_data_seek($res_bancos, 0); ?>
                            <?php while($banco = mysqli_fetch_assoc($res_bancos)): ?>
                            <option value="<?php echo $banco['cod_banco']; ?>"><?php echo htmlspecialchars($banco['nombre_banco']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Número de Cuenta *</label>
                        <input type="text" class="form-input" name="numero_banco_cuenta" id="numero_banco_cuenta" placeholder="Ej: 1234567890" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tipo de Cuenta *</label>
                            <select class="form-select" name="cod_tipo_cuenta_banco" id="cod_tipo_cuenta_banco" required>
                                <option value="1">Ahorros</option>
                                <option value="2">Corriente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Estado *</label>
                            <select class="form-select" name="cod_estado" id="cod_estado_banco" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Titular de la Cuenta</label>
                            <input type="text" class="form-input" name="nombre_titular_cuenta" id="nombre_titular_cuenta" placeholder="Nombre completo">
                        </div>
                        <div class="form-group">
                            <label class="form-label">CC / NIT Titular</label>
                            <input type="text" class="form-input" name="identificacion_titular_cuenta" id="identificacion_titular_cuenta" placeholder="Documento">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-file-certificate"></i> Certificado Bancario</label>
                        <div class="file-upload" onclick="document.getElementById('input_certificado').click()">
                            <i class="fa-solid fa-cloud-upload-alt"></i>
                            <p id="label_certificado">Clic para seleccionar archivo</p>
                            <small>Documento PDF</small>
                            <input type="file" id="input_certificado" name="certificado_banco" accept=".pdf" onchange="mostrarNombreArchivo(this, 'label_certificado')">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa-solid fa-plus"></i> Agregar Cuenta Bancaria
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Footer -->
        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.4); font-size: 0.75rem;">
            <p><?php echo htmlspecialchars($nombre_empresa); ?> &copy; <?php echo date('Y'); ?></p>
        </div>
    </div>
    
    <script>
    function mostrarNombreArchivo(input, labelId) {
        var label = document.getElementById(labelId);
        if (input.files && input.files[0]) {
            label.innerHTML = '<i class="fa-solid fa-file-check" style="color: #10b981;"></i> ' + input.files[0].name;
        } else {
            label.textContent = 'Clic para seleccionar archivo';
        }
    }
    
    // Formulario de documentación
    $('#formDocumentacion').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        Swal.fire({
            title: 'Guardando documentos...',
            didOpen: () => { Swal.showLoading(); },
            allowOutsideClick: false,
            background: '#1a1f2e',
            color: 'white'
        });
        
        $.ajax({
            url: 'guardar_documentacion_aliado_publico_ajax.php',
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
                        title: '¡Guardado!',
                        text: response.mensaje || 'Documentos guardados correctamente',
                        background: '#1a1f2e',
                        color: 'white',
                        confirmButtonColor: '#10b981'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.mensaje || 'No se pudieron guardar los documentos',
                        background: '#1a1f2e',
                        color: 'white',
                        confirmButtonColor: '#ef4444'
                    });
                }
            },
            error: function() {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error de conexión. Intenta nuevamente.',
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#ef4444'
                });
            }
        });
    });
    
    // Formulario de cuenta bancaria
    $('#formBanco').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        Swal.fire({
            title: 'Guardando cuenta...',
            didOpen: () => { Swal.showLoading(); },
            allowOutsideClick: false,
            background: '#1a1f2e',
            color: 'white'
        });
        
        $.ajax({
            url: 'guardar_documentacion_aliado_publico_ajax.php',
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
                        title: '¡Guardado!',
                        text: response.mensaje || 'Cuenta bancaria agregada correctamente',
                        background: '#1a1f2e',
                        color: 'white',
                        confirmButtonColor: '#10b981'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.mensaje || 'No se pudo agregar la cuenta',
                        background: '#1a1f2e',
                        color: 'white',
                        confirmButtonColor: '#ef4444'
                    });
                }
            },
            error: function() {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error de conexión. Intenta nuevamente.',
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#ef4444'
                });
            }
        });
    });
    </script>
</body>
</html>
