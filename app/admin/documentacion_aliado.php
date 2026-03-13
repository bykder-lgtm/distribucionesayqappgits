<?php
/** * Página Pública para Cargue de Documentación del Aliado * Recibe el parámetro 'cod' que contiene el cod_administrador encriptado * Desencripta y muestra el formulario para subir documentos*/
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// Obtener y desencriptar el código del aliado
$cod_aliado_cryp                                  = isset($_GET['cod']) ? $_GET['cod'] : '';
$cod_aliado                                       = 0;
$aliado_valido                                    = false;
$datos_aliado                                     = array();

if (!empty($cod_aliado_cryp)) {
    try {
        // Desencriptar el código
        $cod_aliado_codif                         = DAXCODIFCRYPTOR::descriptardax($cod_aliado_cryp);
        $cod_aliado                               = DAXCODIFCRYPTOR::descodifdax($cod_aliado_codif);
        // Verificar que existe el aliado
        if ($cod_aliado > 0) {
            $sql_aliado = "SELECT cod_administrador, nombres_apellidos_tercero, cedula, telefono, correo, url_documentacion_rut_aliado, url_documentacion_camaracomercio_aliado, url_documentacion_cedula_aliado, url_img_firma_prof_ori, fecha_firma_electronica FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado'";
            $consulta_aliado = mysqli_query($conectar, $sql_aliado);
            // Si falla la consulta por campo inexistente, intentar sin el campo de firma
            if (!$consulta_aliado) {
                $sql_aliado = "SELECT cod_administrador, nombres_apellidos_tercero, cedula, telefono, correo, url_documentacion_rut_aliado, url_documentacion_camaracomercio_aliado, url_documentacion_cedula_aliado FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado'";
                $consulta_aliado = mysqli_query($conectar, $sql_aliado);
            }
            if ($consulta_aliado && mysqli_num_rows($consulta_aliado) > 0) { $aliado_valido = true; $datos_aliado = mysqli_fetch_assoc($consulta_aliado); }
        }
    } catch (Exception $e) {
        $aliado_valido = false;
    }
}
// Consultar bancos disponibles
$sql_bancos = "SELECT cod_banco, nombre_banco FROM tbl15_banco WHERE cod_estado = '1' ORDER BY nombre_banco ASC";
$res_bancos = mysqli_query($conectar, $sql_bancos);
// Consultar cuentas bancarias existentes del aliado
$cuentas_banco = array();
if ($aliado_valido) {
    $sql_cuentas = "SELECT * FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico = '$cod_aliado' AND cod_estado = '1'";
    $res_cuentas = mysqli_query($conectar, $sql_cuentas);
    if ($res_cuentas) { while ($cuenta = mysqli_fetch_assoc($res_cuentas)) { $cuentas_banco[] = $cuenta; } }
}
// Verificar si los documentos están completos
$rut_cargado                                      = !empty($datos_aliado['url_documentacion_rut_aliado']);
$camara_cargado                                   = !empty($datos_aliado['url_documentacion_camaracomercio_aliado']);
$cedula_cargada                                   = !empty($datos_aliado['url_documentacion_cedula_aliado']);
$documentos_completos                             = $rut_cargado && $camara_cargado && $cedula_cargada;
// Verificar si ya tiene cuenta bancaria
$tiene_cuenta_bancaria                            = count($cuentas_banco) > 0;
// Verificar si ya tiene firma electrónica
$tiene_firma                                      = !empty($datos_aliado['url_img_firma_prof_ori']);
// Verificar si toda la información está completa
$informacion_completa                             = $documentos_completos && $tiene_cuenta_bancaria && $tiene_firma;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
    <title>Documentación - <?php echo $aliado_valido ? htmlspecialchars($datos_aliado['nombres_apellidos_tercero']) : 'Enlace Inválido'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
            color: white;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 1rem;
            padding-bottom: 2rem;
        }
        
        .header {
            text-align: center;
            padding: 2rem 1rem;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(124, 58, 237, 0.2));
            border-radius: 20px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }
        
        .header-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }
        
        .header h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        
        .aliado-name {
            color: #8b5cf6;
            font-weight: 700;
        }
        
        .card {
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #8b5cf6;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .form-input, .form-select {
            width: 100%;
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            padding: 0.85rem 1rem;
            color: white;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .form-input:focus, .form-select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }
        
        .form-select {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%238b5cf6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }
        
        .form-select option {
            background-color: #1a1f2e;
            color: white;
        }
        
        .file-upload {
            position: relative;
            border: 2px dashed rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            background: rgba(139, 92, 246, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload:hover {
            border-color: #8b5cf6;
            background: rgba(139, 92, 246, 0.1);
        }
        
        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        .file-upload-icon {
            font-size: 2rem;
            color: #8b5cf6;
            margin-bottom: 0.5rem;
        }
        
        .file-upload-text {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
        }
        
        .file-upload-name {
            margin-top: 0.5rem;
            color: #10b981;
            font-size: 0.85rem;
            font-weight: 600;
            display: none;
        }
        
        .file-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        
        .file-status.uploaded {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .file-status.pending {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .btn-secondary {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .cuenta-item {
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
        }
        
        .cuenta-item .banco-nombre {
            font-weight: 600;
            color: white;
            margin-bottom: 0.25rem;
        }
        
        .cuenta-item .banco-numero {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        
        .cuenta-item .banco-tipo {
            color: #8b5cf6;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        .error-container {
            text-align: center;
            padding: 3rem 1rem;
        }
        
        .error-icon {
            font-size: 4rem;
            color: #ef4444;
            margin-bottom: 1rem;
        }
        
        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            color: #10b981;
            margin-bottom: 1rem;
            display: none;
        }
        
        .complete-message {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
            border: 1px solid rgba(16, 185, 129, 0.4);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            color: #10b981;
            margin-bottom: 1rem;
        }
        
        .complete-message i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
        
        .complete-message h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .complete-message p {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .file-upload.disabled {
            opacity: 0.5;
            pointer-events: none;
            cursor: not-allowed;
        }
        
        .form-input:disabled,
        .form-select:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: rgba(255, 255, 255, 0.05);
        }
        
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.5rem;
            }
        }
        
        /* Modal de Firma */
        .modal-firma {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }
        
        .modal-firma.show {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .modal-firma-content {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }
        
        .modal-firma-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #8b5cf6;
        }
        
        .modal-firma-header h2 {
            color: #2d3748;
            font-size: 1.5rem;
            margin: 0;
        }
        
        .modal-firma-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #718096;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-firma-close:hover {
            color: #2d3748;
        }
        
        .signature-area-modal {
            border: 2px dashed #8b5cf6;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            margin: 1rem 0;
            background: #f7fafc;
        }
        
        .signature-area-modal canvas {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            width: 100%;
            max-width: 100%;
            height: 200px;
            cursor: crosshair;
            touch-action: none;
        }
        
        .firma-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .btn-limpiar-firma {
            flex: 1;
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-limpiar-firma:hover {
            background: #cbd5e0;
        }
        
        .btn-confirmar-firma {
            flex: 1;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }
        
        .btn-confirmar-firma:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .firma-status {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .firma-status i {
            color: #10b981;
            font-size: 1.5rem;
        }
        
        .firma-status-text {
            flex: 1;
        }
        
        .firma-status-text strong {
            color: #10b981;
            display: block;
            margin-bottom: 0.25rem;
        }
        
        .firma-status-text span {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }
        
        .btn-firmar-documento {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            margin-bottom: 1rem;
        }
        
        .btn-firmar-documento:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }
        
        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        .btn-firmar-documento:disabled:hover {
            transform: none;
            box-shadow: none;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if ($aliado_valido): ?>
    
    <div class="header">
        <div class="header-icon">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <h1>Documentación Legal</h1>
        <p>Aliado: <span class="aliado-name"><?php echo htmlspecialchars(!empty($datos_aliado['nombres_apellidos_tercero']) ? $datos_aliado['nombres_apellidos_tercero'] : ($datos_aliado['nombres'] . ' ' . $datos_aliado['apellidos'])); ?></span></p>
    </div>
    
    <div id="successMessage" class="success-message">
        <i class="fa-solid fa-check-circle"></i> Información guardada correctamente
    </div>
    
    <?php if ($informacion_completa): ?>
    <!-- Mensaje de información completa -->
    <div class="complete-message">
        <i class="fa-solid fa-circle-check"></i>
        <h2>¡Información Completa!</h2>
        <p>Todos los documentos y la cuenta bancaria han sido cargados correctamente.</p>
        <p style="margin-top: 1rem; font-size: 0.9rem;">Si necesitas actualizar alguna información, contacta a tu asesor.</p>
    </div>
    <?php endif; ?>
    
    <!-- Formulario Único -->
    <form id="formCompleto" enctype="multipart/form-data">
        <input type="hidden" name="cod_aliado" value="<?php echo $cod_aliado; ?>">
        <input type="hidden" name="accion" value="guardar_todo">
        
        <!-- Sección Documentos -->
        <div class="card">
            <h3 class="card-title"><i class="fa-solid fa-folder-open"></i> Documentos Requeridos</h3>
            <!-- Cédula -->
            <div class="form-group">
                <label class="form-label">Cédula</label>
                <?php if (!empty($datos_aliado['url_documentacion_cedula_aliado'])): ?>
                <div class="file-status uploaded">
                    <i class="fa-solid fa-check-circle" style="color: #10b981;"></i>
                    <span style="color: rgba(255,255,255,0.8); flex: 1;">Documento cargado</span>
                    <a href="<?php echo htmlspecialchars($datos_aliado['url_documentacion_cedula_aliado']); ?>" target="_blank" style="color: #8b5cf6;"><i class="fa-solid fa-eye"></i></a>
                </div>
                <?php else: ?>
                <div class="file-status pending">
                    <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                    <span style="color: rgba(255,255,255,0.8);">Pendiente de cargar</span>
                </div>
                <div class="file-upload">
                    <input type="file" name="cedula_file" id="cedula_file" accept=".pdf">
                    <div class="file-upload-icon"><i class="fa-solid fa-cloud-upload-alt"></i></div>
                    <div class="file-upload-text">Haz clic o arrastra el archivo aquí</div>
                    <div class="file-upload-name" id="cedula_file_name"></div>
                </div>
                <?php endif; ?>
            </div>
            <!-- RUT -->
            <div class="form-group">
                <label class="form-label">RUT (Registro Único Tributario)</label>
                <?php if (!empty($datos_aliado['url_documentacion_rut_aliado'])): ?>
                <div class="file-status uploaded">
                    <i class="fa-solid fa-check-circle" style="color: #10b981;"></i>
                    <span style="color: rgba(255,255,255,0.8); flex: 1;">Documento cargado</span>
                    <a href="<?php echo htmlspecialchars($datos_aliado['url_documentacion_rut_aliado']); ?>" target="_blank" style="color: #8b5cf6;"><i class="fa-solid fa-eye"></i></a>
                </div>
                <?php else: ?>
                <div class="file-status pending">
                    <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                    <span style="color: rgba(255,255,255,0.8);">Pendiente de cargar</span>
                </div>
                <div class="file-upload">
                    <input type="file" name="rut_file" id="rut_file" accept=".pdf">
                    <div class="file-upload-icon"><i class="fa-solid fa-cloud-upload-alt"></i></div>
                    <div class="file-upload-text">Haz clic o arrastra el archivo aquí</div>
                    <div class="file-upload-name" id="rut_file_name"></div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Cámara de Comercio -->
            <div class="form-group">
                <label class="form-label">Cámara de Comercio</label>
                <?php if (!empty($datos_aliado['url_documentacion_camaracomercio_aliado'])): ?>
                <div class="file-status uploaded">
                    <i class="fa-solid fa-check-circle" style="color: #10b981;"></i>
                    <span style="color: rgba(255,255,255,0.8); flex: 1;">Documento cargado</span>
                    <a href="<?php echo htmlspecialchars($datos_aliado['url_documentacion_camaracomercio_aliado']); ?>" target="_blank" style="color: #8b5cf6;"><i class="fa-solid fa-eye"></i></a>
                </div>
                <?php else: ?>
                <div class="file-status pending">
                    <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                    <span style="color: rgba(255,255,255,0.8);">Pendiente de cargar</span>
                </div>
                <div class="file-upload">
                    <input type="file" name="camara_file" id="camara_file" accept=".pdf">
                    <div class="file-upload-icon"><i class="fa-solid fa-cloud-upload-alt"></i></div>
                    <div class="file-upload-text">Haz clic o arrastra el archivo aquí</div>
                    <div class="file-upload-name" id="camara_file_name"></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Sección Cuentas Bancarias -->
        <div class="card">
            <h3 class="card-title"><i class="fa-solid fa-building-columns"></i> Cuenta Bancaria</h3>
            
            <!-- Lista de cuentas existentes -->
            <?php if (count($cuentas_banco) > 0): ?>
            <div id="listaCuentas" style="margin-bottom: 1rem;">
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 0.75rem;">Cuentas registradas:</p>
                <?php foreach ($cuentas_banco as $cuenta): ?>
                <div class="cuenta-item">
                    <div class="banco-nombre"><?php echo htmlspecialchars($cuenta['nombre_banco_cuenta']); ?></div>
                    <div class="banco-numero"><?php echo htmlspecialchars($cuenta['numero_banco_cuenta']); ?></div>
                    <div class="banco-tipo">
                        <?php 
                        $tipo = isset($cuenta['cod_tipo_cuenta_banco']) ? $cuenta['cod_tipo_cuenta_banco'] : 0;
                        if ($tipo == 1) echo 'Cuenta de Ahorros';
                        elseif ($tipo == 2) echo 'Cuenta Corriente';
                        else echo 'Otro';
                        ?>
                        <?php if (!empty($cuenta['nombre_titular_cuenta'])): ?>
                         - <?php echo htmlspecialchars($cuenta['nombre_titular_cuenta']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 1rem;"><i class="fa-solid fa-plus-circle" style="color: #8b5cf6;"></i> Agregar cuenta bancaria:</p>
            <?php endif; ?>
            
            <?php if (!$tiene_cuenta_bancaria): ?>
            <div class="form-group">
                <label class="form-label">Banco</label>
                <select class="form-select" name="nombre_banco_cuenta" id="nombre_banco_cuenta">
                    <option value="">Seleccione un banco...</option>
                    <?php 
                    if ($res_bancos && mysqli_num_rows($res_bancos) > 0) {
                        mysqli_data_seek($res_bancos, 0);
                        while($banco = mysqli_fetch_assoc($res_bancos)) {
                            echo '<option value="' . htmlspecialchars($banco['nombre_banco']) . '">' . htmlspecialchars($banco['nombre_banco']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tipo de Cuenta</label>
                    <select class="form-select" name="cod_tipo_cuenta_banco" id="cod_tipo_cuenta_banco">
                        <option value="">Seleccione...</option>
                        <option value="1">Ahorros</option>
                        <option value="2">Corriente</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Número de Cuenta</label>
                    <input type="text" class="form-input" name="numero_banco_cuenta" id="numero_banco_cuenta" placeholder="Ej: 123456789">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nombre del Titular</label>
                    <input type="text" class="form-input" name="nombre_titular_cuenta" id="nombre_titular_cuenta" placeholder="Nombre completo del titular">
                </div>
                
                <div class="form-group">
                    <label class="form-label">CC/NIT del Titular</label>
                    <input type="text" class="form-input" name="identificacion_titular_cuenta" id="identificacion_titular_cuenta" placeholder="Ej: 123456789">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Certificado Bancario (PDF/Imagen)</label>
                <div class="file-upload">
                    <input type="file" name="certificado_banco" id="certificado_banco" accept=".pdf">
                    <div class="file-upload-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    <div class="file-upload-text">Haz clic o arrastra el certificado bancario aquí</div>
                    <div class="file-upload-name" id="certificado_banco_name"></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Sección de Firma -->
        <div class="card">
            <h3 class="card-title"><i class="fa-solid fa-signature"></i> Firma Electrónica</h3>
            
            <?php if ($tiene_firma): ?>
            <!-- Firma ya cargada -->
            <div class="firma-status">
                <i class="fa-solid fa-check-circle"></i>
                <div class="firma-status-text">
                    <strong>Firma Registrada</strong>
                    <span>Tu firma electrónica ha sido capturada exitosamente</span>
                </div>
            </div>
            <div style="background: white; padding: 1rem; border-radius: 12px; text-align: center; margin-bottom: 1rem;">
                <img src="<?php echo htmlspecialchars($datos_aliado['url_img_firma_prof_ori']); ?>" alt="Firma" style="max-width: 100%; max-height: 150px;">
            </div>
            <?php else: ?>
            <!-- Formulario para firmar -->
            <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 1rem;">Para finalizar el proceso, por favor firme el documento digitalmente.</p>
            
            <div id="firmaStatusContainer" style="display: none;">
                <div class="firma-status">
                    <i class="fa-solid fa-check-circle"></i>
                    <div class="firma-status-text">
                        <strong>Firma Registrada</strong>
                        <span>Tu firma electrónica ha sido capturada exitosamente</span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <button type="button" class="btn btn-firmar-documento" id="btnAbrirFirma" onclick="abrirModalFirma()" <?php echo $tiene_firma ? 'disabled' : ''; ?>>
                <i class="fa-solid fa-pen-fancy"></i> <span id="btnFirmaText">Firmar Documento</span>
            </button>
        </div>
        
        <!-- Botón único para guardar todo -->
        <?php if (!$informacion_completa): ?>
        <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem;" id="btnGuardar">
            <i class="fa-solid fa-save"></i> Guardar Información
        </button>
        <?php endif; ?>
    </form>
    
    <!-- Modal de Firma -->
    <div id="modalFirma" class="modal-firma">
        <div class="modal-firma-content">
            <div class="modal-firma-header">
                <h2><i class="fa-solid fa-signature"></i> Firmar Documento</h2>
                <button class="modal-firma-close" onclick="cerrarModalFirma()">×</button>
            </div>
            
            <p style="color: #718096; margin-bottom: 1rem; font-size: 0.95rem;">Dibuje su firma en el recuadro usando el mouse o su dedo en dispositivos táctiles:</p>
            
            <div class="signature-area-modal">
                <canvas id="signatureCanvas"></canvas>
            </div>
            
            <div class="firma-buttons">
                <button type="button" class="btn btn-limpiar-firma" onclick="limpiarFirma()">
                    <i class="fa-solid fa-eraser"></i> Limpiar
                </button>
                <button type="button" class="btn btn-confirmar-firma" onclick="confirmarFirma()">
                    <i class="fa-solid fa-check"></i> Confirmar Firma
                </button>
            </div>
        </div>
    </div>
    
    <?php else: ?>
    
    <!-- Enlace inválido -->
    <div class="error-container">
        <div class="error-icon"><i class="fa-solid fa-link-slash"></i></div>
        <h2 style="margin-bottom: 0.5rem;">Enlace Inválido</h2>
        <p style="color: rgba(255,255,255,0.7);">El enlace que has utilizado no es válido o ha expirado.</p>
        <p style="color: rgba(255,255,255,0.5); font-size: 0.85rem; margin-top: 1rem;">Por favor, solicita un nuevo enlace a tu asesor.</p>
    </div>
    
    <?php endif; ?>
</div>

<script>
// Mostrar nombre del archivo seleccionado (solo si el elemento existe y no está deshabilitado)
var rutInput = document.getElementById('rut_file');
if (rutInput) {
    rutInput.addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        var fileNameDiv = document.getElementById('rut_file_name');
        if (fileName && fileNameDiv) {
            fileNameDiv.textContent = fileName;
            fileNameDiv.style.display = 'block';
        } else if (fileNameDiv) {
            fileNameDiv.style.display = 'none';
        }
    });
}

var camaraInput = document.getElementById('camara_file');
if (camaraInput) {
    camaraInput.addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        var fileNameDiv = document.getElementById('camara_file_name');
        if (fileName && fileNameDiv) {
            fileNameDiv.textContent = fileName;
            fileNameDiv.style.display = 'block';
        } else if (fileNameDiv) {
            fileNameDiv.style.display = 'none';
        }
    });
}

var cedulaInput = document.getElementById('cedula_file');
if (cedulaInput) {
    cedulaInput.addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        var fileNameDiv = document.getElementById('cedula_file_name');
        if (fileName && fileNameDiv) {
            fileNameDiv.textContent = fileName;
            fileNameDiv.style.display = 'block';
        } else if (fileNameDiv) {
            fileNameDiv.style.display = 'none';
        }
    });
}

var certificadoInput = document.getElementById('certificado_banco');
if (certificadoInput) {
    certificadoInput.addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        var fileNameDiv = document.getElementById('certificado_banco_name');
        if (fileName && fileNameDiv) {
            fileNameDiv.textContent = fileName;
            fileNameDiv.style.display = 'block';
        } else if (fileNameDiv) {
            fileNameDiv.style.display = 'none';
        }
    });
}

// Envío del formulario completo
var formCompleto = document.getElementById('formCompleto');
if (formCompleto) {
    formCompleto.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        // Verificar si los campos existen en el formulario
        var rutInput = document.getElementById('rut_file');
        var camaraInput = document.getElementById('camara_file');
        var cedulaInput = document.getElementById('cedula_file');
        var bancoSelect = document.getElementById('nombre_banco_cuenta');
        var numeroCuentaInput = document.getElementById('numero_banco_cuenta');
        var tipoCuentaSelect = document.getElementById('cod_tipo_cuenta_banco');
        
        // Solo validar los campos que existen
        var rutFile = rutInput ? rutInput.files[0] : null;
        var camaraFile = camaraInput ? camaraInput.files[0] : null;
        var cedulaFile = cedulaInput ? cedulaInput.files[0] : null;
        var bancoSeleccionado = bancoSelect ? bancoSelect.value : '';
        var numeroCuenta = numeroCuentaInput ? numeroCuentaInput.value : '';
        var tipoCuenta = tipoCuentaSelect ? tipoCuentaSelect.value : '';
        
        // Validar que haya al menos algo para guardar (solo en campos disponibles)
        var hayDocumentos = rutFile || camaraFile || cedulaFile;
        var hayCuenta = bancoSeleccionado && numeroCuenta && tipoCuenta;
        
        if (!hayDocumentos && !hayCuenta) {
            Swal.fire({ 
                icon: 'warning', 
                title: 'Atención', 
                text: 'Selecciona al menos un documento para subir o completa los datos de la cuenta bancaria', 
                background: '#1a1f2e', 
                color: 'white' 
            });
            return;
        }
        
        // Validar cuenta bancaria si se llenó parcialmente (solo si los campos existen)
        if (bancoSelect && (bancoSeleccionado || numeroCuenta || tipoCuenta) && !hayCuenta) {
            Swal.fire({ 
                icon: 'warning', 
                title: 'Datos incompletos', 
                text: 'Por favor complete todos los campos de la cuenta bancaria (Banco, Tipo y Número)', 
                background: '#1a1f2e', 
                color: 'white' 
            });
            return;
        }
        
        Swal.fire({ 
            title: 'Guardando información...', 
            html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #8b5cf6;"></i>', 
            showConfirmButton: false, 
            allowOutsideClick: false, 
            background: '#1a1f2e', 
            color: 'white' 
        });
        
        // Agregar firma si existe
        if (firmaBase64) {
            formData.append('firma_electronica', firmaBase64);
        }
        
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
                        text: response.mensaje || 'Información guardada correctamente', 
                        background: '#1a1f2e', 
                        color: 'white' 
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({ 
                        icon: 'error', 
                        title: 'Error', 
                        text: response.mensaje || 'Error al guardar la información', 
                        background: '#1a1f2e', 
                        color: 'white' 
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
                    color: 'white' 
                });
            }
        });
    });
}
// ===== GESTIÓN DE FIRMA =====
let firmaGuardada = false;
let firmaBase64 = '';

const canvas = document.getElementById('signatureCanvas');
const ctx = canvas ? canvas.getContext('2d') : null;
let isDrawing = false;
let lastX = 0;
let lastY = 0;

function abrirModalFirma() {
    const modal = document.getElementById('modalFirma');
    modal.classList.add('show');
    
    // Inicializar canvas
    if (canvas) {
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = 200;
        
        ctx.strokeStyle = '#2d3748';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        
        // Si ya hay firma guardada, mostrarla
        if (firmaBase64) {
            const img = new Image();
            img.onload = function() {
                ctx.drawImage(img, 0, 0);
            };
            img.src = firmaBase64;
        }
    }
}

function cerrarModalFirma() {
    const modal = document.getElementById('modalFirma');
    modal.classList.remove('show');
}

if (canvas) {
    // Eventos de mouse
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Eventos táctiles
    canvas.addEventListener('touchstart', startDrawingTouch);
    canvas.addEventListener('touchmove', drawTouch);
    canvas.addEventListener('touchend', stopDrawing);
}

function startDrawing(e) {
    isDrawing = true;
    [lastX, lastY] = [e.offsetX, e.offsetY];
}

function startDrawingTouch(e) {
    e.preventDefault();
    const rect = canvas.getBoundingClientRect();
    const touch = e.touches[0];
    isDrawing = true;
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
    if (canvas && ctx) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
}

function confirmarFirma() {
    if (!canvas || !ctx) return;
    
    // Verificar si hay contenido en el canvas
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
        Swal.fire({ 
            icon: 'warning', 
            title: 'Firma requerida', 
            text: 'Por favor, dibuje su firma en el recuadro antes de confirmar', 
            background: '#1a1f2e', 
            color: 'white' 
        });
        return;
    }
    
    // Guardar firma en base64
    firmaBase64 = canvas.toDataURL('image/png');
    firmaGuardada = true;
    
    // Mostrar status de firma guardada
    document.getElementById('firmaStatusContainer').style.display = 'block';
    document.getElementById('btnFirmaText').textContent = 'Modificar Firma';
    
    // Cerrar modal
    cerrarModalFirma();
    
    Swal.fire({ 
        icon: 'success', 
        title: 'Firma capturada', 
        text: 'Tu firma ha sido guardada correctamente', 
        timer: 2000,
        showConfirmButton: false,
        background: '#1a1f2e', 
        color: 'white' 
    });
}

// Cerrar modal al hacer clic fuera
window.addEventListener('click', function(e) {
    const modal = document.getElementById('modalFirma');
    if (e.target === modal) {
        cerrarModalFirma();
    }
});
</script>

</body>
</html>
