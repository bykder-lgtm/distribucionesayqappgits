<?php 
$nombre_pagina = "Detalle Tienda";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_lider.php"); ?>
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_lider.php"); ?>

<?php
$cod_tienda = isset($_GET['cod_tienda']) ? intval($_GET['cod_tienda']) : 0;
if ($cod_tienda <= 0) { header("Location: lista_tienda_lider_movil.php"); exit; }

// Consultar información de la tienda
$sql = "SELECT t.*, a.nombres_apellidos_tercero AS nombre_aliado, b.nombre_banco_cuenta, b.numero_banco_cuenta 
FROM tbl15_tienda t LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador 
LEFT JOIN tbl15_banco_cuenta b ON t.cod_banco_cuenta = b.cod_banco_cuenta WHERE t.cod_tienda = '$cod_tienda'";
$resultado = mysqli_query($conectar, $sql);
$tienda = mysqli_fetch_assoc($resultado);

if (!$tienda) { header("Location: lista_tienda_lider_movil.php"); exit; }
// Encriptar código de tienda para enlaces públicos
$cod_tienda_cryp = DAXCODIFCRYPTOR::encriptardax(DAXCODIFCRYPTOR::encodifdax($tienda['cod_tienda']));
// Consultar productos de la tienda
$sql_productos = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, descripcion_producto, und_producto FROM tbl15_producto WHERE (cod_tienda = '$cod_tienda') ORDER BY cod_producto ASC";
$res_productos = mysqli_query($conectar, $sql_productos);
$total_productos = $res_productos ? mysqli_num_rows($res_productos) : 0;
// Consultar vendedores de la tienda
$sql_vendedores = "SELECT * FROM tbl15_administrador WHERE cod_vendedor = '$cod_tienda' AND cod_seguridad = '2' ORDER BY nombres_apellidos_tercero ASC";
$res_vendedores = mysqli_query($conectar, $sql_vendedores);
$total_vendedores = $res_vendedores ? mysqli_num_rows($res_vendedores) : 0;
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
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Quill Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

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
        max-width: 900px;
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
        transition: all 0.3s ease;
    }
    .back-btn:hover {
        background: rgba(139, 92, 246, 0.2);
        color: #8b5cf6;
        text-decoration: none;
    }
    .page-title {
        color: white; margin: 0; font-size: 1.25rem; font-weight: 700;
    }
    
    .profile-card {
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        padding: 2rem 1.5rem;
        text-align: center;
        position: relative;
    }
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .profile-avatar {
        width: 100px; height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        margin: 0 auto 1rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 3rem; color: white;
        border: 4px solid rgba(255,255,255,0.1);
        position: relative;
        z-index: 2;
    }
    .profile-name {
        color: white; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;
        position: relative; z-index: 2;
    }
    .profile-subtitle {
        color: rgba(255,255,255,0.8); font-size: 0.9rem; margin-bottom: 0.25rem;
        position: relative; z-index: 2;
    }
    .profile-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: rgba(255,255,255,0.2);
    }
    
    /* Botones Firma y GPS */
    .signature-gps-buttons {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
        justify-content: center;
        position: relative;
        z-index: 2;
    }
    .btn-firma-gps {
        flex: 1;
        max-width: 120px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 0.75rem 0.5rem;
        border-radius: 12px;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        transition: all 0.3s ease;
    }
    .btn-firma-gps:hover {
        background: rgba(255,255,255,0.25);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .btn-firma-gps.has-gps {
        background: rgba(139, 92, 246, 0.3);
        border-color: rgba(139, 92, 246, 0.5);
    }
    
    .profile-status {
        border-radius: 15px;
        color: white; font-size: 0.8rem; font-weight: 600;
        text-transform: uppercase;
        position: relative; z-index: 2;
    }
    
    .profile-body {
        padding: 1.5rem;
    }
    
    .detail-section {
        margin-bottom: 1.5rem;
    }
    .section-title {
        color: #8b5cf6;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    .detail-item {
        background: rgba(255,255,255,0.03);
        padding: 0.75rem 1rem;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .detail-label {
        color: rgba(255,255,255,0.5); font-size: 0.85rem;
    }
    .detail-value {
        color: white; font-weight: 600; font-size: 0.95rem; text-align: right;
        max-width: 60%;
        word-break: break-word;
    }
    
    .document-section {
        background: rgba(255,255,255,0.03);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .document-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .document-item:last-child {
        border-bottom: none;
    }
    .document-label {
        color: rgba(255,255,255,0.7);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .document-status {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .document-status.uploaded {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    .document-status.missing {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
    .document-link {
        color: #8b5cf6;
        text-decoration: none;
        font-size: 0.8rem;
        margin-left: 0.5rem;
    }
    .document-link:hover {
        color: #7c3aed;
        text-decoration: underline;
    }
    
    .image-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .image-item {
        aspect-ratio: 1;
        border-radius: 12px;
        overflow: hidden;
        background: rgba(255,255,255,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .image-item:hover {
        border-color: #8b5cf6;
        transform: scale(1.02);
    }
    .image-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-placeholder {
        color: rgba(255,255,255,0.3);
        font-size: 2rem;
    }
    
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 2rem;
    }
    .action-btn-full {
        padding: 1rem;
        border-radius: 12px;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .action-btn-full.edit {
        background: rgba(139, 92, 246, 0.2);
        color: #8b5cf6;
    }
    .action-btn-full.edit:hover {
        background: #8b5cf6;
        color: white;
        text-decoration: none;
    }
    .action-btn-full.back {
        background: rgba(107, 114, 128, 0.2);
        color: #9ca3af;
    }
    .action-btn-full.back:hover {
        background: #6b7280;
        color: white;
        text-decoration: none;
    }

    @media(min-width: 600px) {
        .detail-grid { grid-template-columns: repeat(2, 1fr); }
        .image-gallery { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
    }

    /* Estilos para productos */
    .productos-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    .producto-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
    }
    .producto-item:hover {
        border-color: rgba(139, 92, 246, 0.3);
        background: rgba(255,255,255,0.05);
    }
    .producto-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }
    .producto-info {
        flex: 1;
    }
    .producto-nombre {
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }
    .producto-codigo {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.6);
        margin-bottom: 0.5rem;
    }
    .producto-precio {
        font-size: 1.25rem;
        font-weight: 700;
        color: #8b5cf6;
    }
    .producto-stock {
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .producto-stock.disponible {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    .producto-stock.agotado {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
    .producto-descripcion {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
        margin: 0.5rem 0;
        line-height: 1.4;
    }
    .producto-empty {
        text-align: center;
        padding: 2rem;
        color: rgba(255,255,255,0.5);
        border: 2px dashed rgba(255,255,255,0.1);
        border-radius: 12px;
    }
    .producto-empty i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(139, 92, 246, 0.3);
    }
    .producto-empty p {
        margin: 0;
        font-size: 0.9rem;
    }

    @media(min-width: 600px) {
        .productos-list { grid-template-columns: repeat(2, 1fr); }
    }

    /* Bottom Navigation */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border-top: 1px solid rgba(139, 92, 246, 0.2);
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
        color: #8b5cf6;
        text-decoration: none;
    }
    .nav-item.active {
        background: rgba(139, 92, 246, 0.1);
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
    
    /* Modales Firma y GPS */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.8);
        backdrop-filter: blur(8px);
        z-index: 5000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        overflow-y: auto;
    }
    .modal-overlay.show { display: flex; }
    
    .modal-content {
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
    
    .modal-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        padding: 1.5rem;
        border-radius: 20px 20px 0 0;
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header h2 {
        color: white;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .modal-close {
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        width: 36px; height: 36px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .modal-close:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(90deg);
    }
    .modal-body {
        padding: 1.5rem;
    }
    
    .form-label {
        color: rgba(255,255,255,0.9);
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-input {
        width: 100%;
        background: rgba(139, 92, 246, 0.1);
        border: 1px solid rgba(139, 92, 246, 0.3);
        color: white;
        padding: 0.75rem;
        border-radius: 12px;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    .form-input:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    }
    
    /* SweetAlert2 sobre modales */
    .swal2-container.swal2-above-modal {
        z-index: 9999 !important;
    }
    div:has(> .swal2-above-modal) {
        z-index: 9999 !important;
    }
    
    /* Botón submit */
    .submit-btn {
        background: #8b5cf6;
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .submit-btn:hover {
        background: #7c3aed;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }
</style>
</head>
<body>

<main class="page-container">
    <div class="page-header">
        <a href="lista_tienda_lider_movil.php" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Detalle de Tienda</h1>
    </div>

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fa-solid fa-store"></i>
            </div>
            <h2 class="profile-name"><?php echo $tienda['nombre_tienda'] ?: 'Tienda sin nombre'; ?></h2>
            <p class="profile-subtitle">NIT: <?php echo $tienda['identificacion_tercero']; ?></p>
            <span class="profile-status" style="<?php echo $tienda['cod_estado'] == '1' ? 'background: #10b981;' : 'background: #ef4444;'; ?>"><?php echo $tienda['cod_estado'] == '1' ? 'Activa' : 'Inactiva'; ?></span>
        </div>
        
        <div class="profile-body">
            <!-- Información Básica -->
            <div class="detail-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-info-circle"></i>
                    Información Básica
                </h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Teléfono</span>
                        <span class="detail-value"><?php echo $tienda['telefono1_tercero'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Correo</span>
                        <span class="detail-value"><?php echo $tienda['correo_tercero'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Dirección</span>
                        <span class="detail-value"><?php echo $tienda['direccion_tercero'] ?: 'No registrada'; ?></span>
                    </div>
                </div>
            </div>

            <!-- Representante Legal -->
            <?php if (!empty($tienda['nombre_representante']) || !empty($tienda['documento_representante'])): ?>
            <div class="detail-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-user-tie"></i>
                    Representante Legal
                </h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nombre</span>
                        <span class="detail-value"><?php echo $tienda['nombre_representante'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Documento</span>
                        <span class="detail-value"><?php echo $tienda['documento_representante'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Correo</span>
                        <span class="detail-value"><?php echo $tienda['correo_representante'] ?: 'No registrado'; ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Información Comercial -->
            <div class="detail-section">
                <h3 class="section-title"><i class="fa-solid fa-dollar-sign"></i>Información Comercial</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Aliado Estratégico</span>
                        <span class="detail-value"><?php echo $tienda['nombre_aliado'] ?: 'No asignado'; ?></span>
                    </div>
                </div>
            </div>

            <!-- Ubicación -->
            <?php if (!empty($tienda['ubicacion_gps_tienda'])): ?>
            <div class="detail-section">
                <h3 class="section-title"><i class="fa-solid fa-map-marker-alt"></i>Ubicación GPS</h3>
                <div class="detail-grid">
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Coordenadas</span>
                        <span class="detail-value"><?php echo $tienda['ubicacion_gps_tienda']; ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Imágenes de la Tienda -->
            <div class="detail-section">
                <h3 class="section-title"><i class="fa-solid fa-images"></i>Imágenes de la Tienda</h3>
                <div class="image-gallery">
                    <?php 
                    $imagenes = ['Fachada' => $tienda['url_img_fachada_tienda'], 'Interior' => $tienda['url_img_interna_tienda'], 'Opcional' => $tienda['url_img_otraopcional_tienda']];
                    foreach ($imagenes as $tipo => $url): ?>
                    <div class="image-item" <?php if (!empty($url)): ?>onclick="mostrarImagen('<?php echo $url; ?>', '<?php echo $tipo; ?>')"<?php endif; ?>>
                        <?php if (!empty($url)): ?>
                            <img src="<?php echo $url; ?>" alt="<?php echo $tipo; ?> de la tienda">
                        <?php else: ?>
                            <div class="image-placeholder">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Botones Firma, GPS e Imágenes -->
            <div class="signature-gps-buttons">
                <button class="btn-firma-gps" 
                    data-cod="<?php echo htmlspecialchars($cod_tienda_cryp, ENT_QUOTES); ?>"
                    data-nombre="<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>"
                    data-estado="<?php echo isset($tienda['cod_estado_firma_signature']) ? htmlspecialchars($tienda['cod_estado_firma_signature'], ENT_QUOTES) : '0'; ?>"
                    data-url="<?php echo isset($tienda['url_firma_electronica']) ? htmlspecialchars($tienda['url_firma_electronica'], ENT_QUOTES) : ''; ?>"
                    onclick="abrirModalRevisionFirma(this.getAttribute('data-cod'), this.getAttribute('data-nombre'), this.getAttribute('data-estado'), this.getAttribute('data-url'))">
                    <i class="fa-solid fa-signature"></i> Firma
                </button>
                <button class="btn-firma-gps <?php echo !empty($tienda['ubicacion_gps_tienda']) ? 'has-gps' : ''; ?>" 
                    data-cod="<?php echo htmlspecialchars($cod_tienda_cryp, ENT_QUOTES); ?>"
                    data-nombre="<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>"
                    data-gps="<?php echo isset($tienda['ubicacion_gps_tienda']) ? htmlspecialchars($tienda['ubicacion_gps_tienda'], ENT_QUOTES) : ''; ?>"
                    onclick="abrirModalRevisionGPS(this.getAttribute('data-cod'), this.getAttribute('data-nombre'), this.getAttribute('data-gps'))">
                    <i class="fa-solid fa-map-marker-alt"></i> GPS
                </button>
                <button class="btn-firma-gps" 
                    data-cod="<?php echo htmlspecialchars($cod_tienda_cryp, ENT_QUOTES); ?>"
                    data-nombre="<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>"
                    onclick="abrirModalImagenes(this.getAttribute('data-cod'), this.getAttribute('data-nombre'))">
                    <i class="fa-solid fa-images"></i> Imágenes
                </button>
            </div>

            <!-- Vendedores de la Tienda -->
            <div class="detail-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; border-bottom: 1px solid rgba(139, 92, 246, 0.2); padding-bottom: 0.5rem;">
                    <h3 class="section-title" style="border: none; margin: 0; padding: 0;">
                        <i class="fa-solid fa-users"></i>
                        Vendedores (<?php echo $total_vendedores; ?>)
                    </h3>
                </div>
                
                <div class="productos-list">
                    <?php if ($res_vendedores && mysqli_num_rows($res_vendedores) > 0): ?>
                        <?php while($vendedor = mysqli_fetch_assoc($res_vendedores)): ?>
                        <div class="producto-item">
                            <div class="producto-header">
                                <div class="producto-info">
                                    <div class="producto-nombre"><?php echo $vendedor['nombres_apellidos_tercero']; ?></div>
                                    <?php if (!empty($vendedor['identificacion_tercero'])): ?>
                                    <div class="producto-codigo">CC: <?php echo $vendedor['identificacion_tercero']; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($vendedor['telefono1_tercero'])): ?>
                                    <div class="producto-codigo"><i class="fa fa-phone"></i> <?php echo $vendedor['telefono1_tercero']; ?></div>
                                    <?php endif; ?>
                                </div>
                                <span class="producto-stock <?php echo ($vendedor['cod_estado_activacion_usuario'] == '1') ? 'disponible' : 'agotado'; ?>">
                                    <?php echo ($vendedor['cod_estado_activacion_usuario'] == '1') ? 'Activo' : 'Inactivo'; ?>
                                </span>
                            </div>
                            <?php if (!empty($vendedor['correo_tercero'])): ?>
                            <div class="producto-descripcion">
                                <i class="fa fa-envelope"></i> <?php echo $vendedor['correo_tercero']; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="producto-empty" style="grid-column: 1 / -1;">
                            <i class="fa-solid fa-users"></i>
                            <p>No hay vendedores registrados en esta tienda</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Productos de la Tienda -->
            <div class="detail-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; border-bottom: 1px solid rgba(139, 92, 246, 0.2); padding-bottom: 0.5rem;">
                    <h3 class="section-title" style="border: none; margin: 0; padding: 0;">
                        <i class="fa-solid fa-box"></i>
                        Productos (<?php echo $total_productos; ?>)
                    </h3>
                </div>
                
                <div class="productos-list">
                    <?php if ($res_productos && mysqli_num_rows($res_productos) > 0): ?>
                        <?php while($producto = mysqli_fetch_assoc($res_productos)): ?>
                        <div class="producto-item">
                            <div class="producto-header">
                                <div class="producto-info">
                                    <div class="producto-nombre"><?php echo $producto['nombre_producto']; ?></div>
                                    <?php if (!empty($producto['cod_producto_barra'])): ?>
                                    <div class="producto-codigo">Código: <?php echo $producto['cod_producto_barra']; ?></div>
                                    <?php endif; ?>
                                    <div class="producto-precio">$<?php echo number_format($producto['precio_venta_producto'], 0, ',', '.'); ?></div>
                                </div>
                                <span class="producto-stock <?php echo ($producto['und_producto'] > 0) ? 'disponible' : 'agotado'; ?>">
                                    <?php echo ($producto['und_producto'] > 0) ? 'Stock: ' . $producto['und_producto'] : 'Agotado'; ?>
                                </span>
                            </div>
                            <?php if (!empty($producto['descripcion_producto'])): ?>
                            <div class="producto-descripcion"><?php echo substr($producto['descripcion_producto'], 0, 150); ?><?php echo strlen($producto['descripcion_producto']) > 150 ? '...' : ''; ?></div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="producto-empty"><i class="fa-solid fa-box-open"></i><p>No hay productos registrados</p></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="action-buttons">
                <a href="lista_tienda_lider_movil.php" class="action-btn-full back"><i class="fa-solid fa-arrow-left"></i>Volver al Listado</a>
            </div>
        </div>
    </div>
</main>

<!-- Modal Revisión Firma -->
<div class="modal-overlay" id="modalRevisionFirma">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-signature"></i> Firma Electrónica</h2>
            <button class="modal-close" onclick="cerrarModalRevisionFirma()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="revision_firma_cod_tienda" value="">
            <input type="hidden" id="revision_firma_nombre_tienda" value="">
            <input type="hidden" id="revision_firma_cod_estado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="background: linear-gradient(135deg, rgba(139,92,246,0.2), rgba(109,40,217,0.2)); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                    <i class="fa-solid fa-signature" style="font-size: 2.5rem; color: #8b5cf6;"></i>
                    <h3 style="color: #8b5cf6; margin: 0.5rem 0;" id="revision_firma_nombre"></h3>
                </div>
            </div>
            
            <!-- Contenedor de Firma Existente -->
            <div id="firma_existente_container" style="background: white; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: none; justify-content: center; align-items: center; min-height: 200px;">
                <img id="revision_imagen_firma" src="" alt="Firma Electrónica" style="max-width: 100%; max-height: 300px;">
            </div>
            
            <!-- Mensaje de Firma Pendiente -->
            <div id="firma_pendiente_container" style="background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.3); border-radius: 12px; padding: 2rem; text-align: center; margin-bottom: 1.5rem; display: none;">
                <i class="fa-solid fa-pen-fancy" style="font-size: 3rem; color: #fbbf24; margin-bottom: 1rem;"></i>
                <h4 style="color: #fbbf24; margin: 0 0 0.5rem 0;">Firma Pendiente</h4>
                <p style="color: rgba(255,255,255,0.7); margin: 0;">Esta tienda aún no ha registrado su firma electrónica.</p>
            </div>
            
            <!-- Opciones de Compartir -->
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-share-nodes"></i> Compartir Enlace para Firmar
                </h4>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                    <button onclick="compartirWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button onclick="compartirEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                    <button onclick="copiarEnlace()" style="background: #8b5cf6; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                        <i class="fa-solid fa-copy"></i> Copiar
                    </button>
                </div>
            </div>
            
            <!-- Botones de Gestión (solo si hay firma) -->
            <div id="firma_botones_gestion" style="display: none; gap: 1rem;">
                <button onclick="gestionarFirma('rechazar')" style="flex: 1; background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.5); padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-times"></i> Rechazar
                </button>
                <button onclick="gestionarFirma('aceptar')" style="flex: 1; background: #8b5cf6; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-check"></i> Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Revisión GPS -->
<div class="modal-overlay" id="modalRevisionGPS">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-map-marker-alt"></i> Ubicación GPS</h2>
            <button class="modal-close" onclick="cerrarModalRevisionGPS()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="revision_gps_cod_tienda" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="color: white; margin-bottom: 0.5rem;" id="revision_gps_nombre_tienda"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;" id="revision_gps_coordenadas"></p>
            </div>
            
            <div id="gps_mapa_container" style="background: white; border-radius: 12px; margin-bottom: 1.5rem; min-height: 300px; display: none;">
                <iframe id="gps_mapa_iframe" width="100%" height="300" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div id="gps_sin_ubicacion" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 2rem; text-align: center; display: none;">
                <i class="fa-solid fa-map-marker-slash" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
                <h4 style="color: #ef4444; margin: 0 0 0.5rem 0;">Sin Ubicación GPS</h4>
                <p style="color: rgba(255,255,255,0.7); margin: 0 0 1.5rem 0;">Esta tienda aún no ha registrado su ubicación GPS.</p>
                
                <!-- Opciones de Compartir Enlace para Capturar GPS -->
                <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-top: 1rem;">
                    <h4 style="color: #8b5cf6; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-share-nodes"></i> Compartir Enlace para Capturar GPS
                    </h4>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                        <button onclick="compartirGPSWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </button>
                        <button onclick="compartirGPSEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                            <i class="fa-solid fa-envelope"></i> Email
                        </button>
                        <button onclick="copiarEnlaceGPS()" style="background: #8b5cf6; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                            <i class="fa-solid fa-copy"></i> Copiar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Botones de Acción -->
            <div style="display: flex; gap: 1rem;" id="gps_botones_accion">
                <button onclick="abrirGoogleMaps()" style="flex: 1; background: #4285F4; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-map"></i> Abrir en Google Maps
                </button>
                <button onclick="copiarCoordenadas()" style="flex: 1; background: #8b5cf6; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-copy"></i> Copiar Coordenadas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Imágenes de la Tienda -->
<div class="modal-overlay" id="modalImagenesTienda">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-images"></i> Imágenes de la Tienda</h2>
            <button class="modal-close" onclick="cerrarModalImagenes()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="imagenes_cod_tienda" value="">
            <input type="hidden" id="imagenes_nombre_tienda" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(79,70,229,0.2)); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                    <i class="fa-solid fa-camera" style="font-size: 2.5rem; color: #8b5cf6;"></i>
                    <h3 style="color: #8b5cf6; margin: 0.5rem 0;">Cargar Imágenes de Tienda</h3>
                    <p style="color: rgba(255,255,255,0.7); margin: 0;" id="imagenes_tienda_nombre_display"></p>
                </div>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Comparta el siguiente enlace para que el aliado pueda cargar las imágenes de la tienda.</p>
            </div>
            
            <!-- Opciones de Compartir Enlace -->
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-share-nodes"></i> Compartir Enlace de Carga
                </h4>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                    <button onclick="compartirImagenesWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button onclick="compartirImagenesEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                    <button onclick="copiarEnlaceImagenes()" style="background: #8b5cf6; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                        <i class="fa-solid fa-copy"></i> Copiar
                    </button>
                </div>
            </div>
            
            <button type="button" onclick="cerrarModalImagenes()" class="submit-btn" style="margin-top: 1rem; background: rgba(255,255,255,0.1); width: 100%;">
                <i class="fa-solid fa-check"></i> Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
function mostrarImagen(url, tipo) {
    Swal.fire({
        title: tipo + ' de la Tienda',
        imageUrl: url,
        imageWidth: '90%',
        imageHeight: 'auto',
        showCloseButton: true,
        showConfirmButton: false,
        background: '#1a1f2e',
        color: 'white'
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // ====================== GESTIÓN DE FIRMAS ======================
    window.abrirModalRevisionFirma = function(codTiendaCryp, nombreTienda, codEstadoFirma, urlFirma) {
        console.log('abrirModalRevisionFirma:', { codTiendaCryp, nombreTienda, codEstadoFirma, urlFirma });
        
        codEstadoFirma = String(codEstadoFirma);
        urlFirma = urlFirma ? String(urlFirma).trim() : '';
        
        document.getElementById('revision_firma_cod_tienda').value = codTiendaCryp;
        document.getElementById('revision_firma_nombre_tienda').value = nombreTienda;
        document.getElementById('revision_firma_cod_estado').value = codEstadoFirma;
        document.getElementById('revision_firma_nombre').textContent = nombreTienda;
        
        var firmaExistenteContainer = document.getElementById('firma_existente_container');
        var firmaPendienteContainer = document.getElementById('firma_pendiente_container');
        var firmaBotonesGestion = document.getElementById('firma_botones_gestion');
        
        if (codEstadoFirma === '0' && urlFirma.length > 0) {
            document.getElementById('revision_imagen_firma').src = urlFirma;
            firmaExistenteContainer.style.display = 'flex';
            firmaPendienteContainer.style.display = 'none';
            firmaBotonesGestion.style.display = 'flex';
        } else {
            firmaExistenteContainer.style.display = 'none';
            firmaPendienteContainer.style.display = 'block';
            firmaBotonesGestion.style.display = 'none';
        }
        
        document.getElementById('modalRevisionFirma').classList.add('show');
    }
    
    window.cerrarModalRevisionFirma = function() {
        document.getElementById('modalRevisionFirma').classList.remove('show');
        document.getElementById('revision_imagen_firma').src = '';
    }
    
    window.compartirWhatsApp = function() {
        var codTienda = document.getElementById('revision_firma_cod_tienda').value;
        var nombreTienda = document.getElementById('revision_firma_nombre_tienda').value;
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        var mensaje = '¡Hola! Por favor firma el documento de ' + nombreTienda + ' en el siguiente enlace: ' + enlaceFirma;
        var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
        window.open(urlWhatsApp, '_blank');
    }
    
    window.compartirEmail = function() {
        var codTienda = document.getElementById('revision_firma_cod_tienda').value;
        var nombreTienda = document.getElementById('revision_firma_nombre_tienda').value;
        
        if (!codTienda) { 
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se encontró el código de la tienda', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' }
            }); 
            return; 
        }
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        Swal.fire({
            title: 'Enviar por Correo',
            html: '<p style="margin-bottom: 15px;">Ingrese el correo electrónico del destinatario:</p><input type="email" id="emailFirmaInput" class="swal2-input" placeholder="ejemplo@correo.com" style="background: #2d3748; color: white; border: 1px solid #4a5568; padding: 10px; border-radius: 8px;">',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '📧 Enviar',
            cancelButtonText: 'Cancelar',
            background: '#1a1f2e',
            color: 'white',
            confirmButtonColor: '#8b5cf6',
            cancelButtonColor: '#6b7280',
            customClass: { container: 'swal2-above-modal' },
            preConfirm: () => {
                const email = Swal.getPopup().querySelector('#emailFirmaInput').value;
                if (!email) {
                    Swal.showValidationMessage('Por favor ingrese un correo electrónico');
                    return false;
                }
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.showValidationMessage('Por favor ingrese un correo electrónico válido');
                    return false;
                }
                return email;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const email = result.value;
                
                Swal.fire({
                    title: 'Enviando correo...',
                    html: 'Por favor espere',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: { container: 'swal2-above-modal' },
                    didOpen: () => { Swal.showLoading(); }
                });
                
                $.ajax({
                    url: 'enviar_firma_tienda_email.php',
                    type: 'POST',
                    data: {
                        correo: email,
                        nombre_tienda: nombreTienda,
                        enlace_firma: enlaceFirma
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Correo enviado!',
                                text: response.mensaje,
                                background: '#1a1f2e',
                                color: 'white',
                                confirmButtonColor: '#8b5cf6',
                                customClass: { container: 'swal2-above-modal' }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.mensaje || 'No se pudo enviar el correo',
                                background: '#1a1f2e',
                                color: 'white',
                                confirmButtonColor: '#ef4444',
                                customClass: { container: 'swal2-above-modal' }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar correo:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Conexión',
                            text: 'No se pudo conectar con el servidor para enviar el correo',
                            background: '#1a1f2e',
                            color: 'white',
                            confirmButtonColor: '#ef4444',
                            customClass: { container: 'swal2-above-modal' }
                        });
                    }
                });
            }
        });
    }
    
    window.copiarEnlace = function() {
        var codTienda = document.getElementById('revision_firma_cod_tienda').value;
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        navigator.clipboard.writeText(enlaceFirma).then(function() {
            Swal.fire({ 
                icon: 'success', title: '¡Copiado!', text: 'Enlace copiado al portapapeles', timer: 1500, showConfirmButton: false, background: '#1a1f2e', color: 'white',
                customClass: { container: 'swal2-above-modal' }
            });
        }).catch(function() {
            Swal.fire({ 
                icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace', background: '#1a1f2e', color: 'white',
                customClass: { container: 'swal2-above-modal' } 
            });
        });
    }
    
    window.gestionarFirma = function(accion) {
        var codTienda = document.getElementById('revision_firma_cod_tienda').value;
        var nombreTienda = document.getElementById('revision_firma_nombre_tienda').value;
        
        var texto = accion === 'aceptar' ? '¿Deseas aceptar esta firma?' : '¿Deseas rechazar esta firma?';
        var icono = accion === 'aceptar' ? 'success' : 'warning';
        
        Swal.fire({
            title: 'Confirmar ' + (accion === 'aceptar' ? 'Aceptación' : 'Rechazo'),
            text: texto, icon: icono, showCancelButton: true, confirmButtonColor: accion === 'aceptar' ? '#8b5cf6' : '#ef4444', cancelButtonColor: '#6b7280', confirmButtonText: 'Sí, ' + accion,
            cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white',
            customClass: { container: 'swal2-above-modal' }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success', title: 'Firma ' + (accion === 'aceptar' ? 'Aceptada' : 'Rechazada'), text: 'La acción se ha registrado exitosamente', background: '#1a1f2e', color: 'white',
                    customClass: { container: 'swal2-above-modal' }
                }).then(() => {
                    cerrarModalRevisionFirma();
                    location.reload();
                });
            }
        });
    }
    
    // ====================== GESTIÓN DE GPS ======================
    window.abrirModalRevisionGPS = function(codTiendaCryp, nombreTienda, coordenadasGPS) {
        console.log('abrirModalRevisionGPS:', { codTiendaCryp, nombreTienda, coordenadasGPS });
        
        document.getElementById('revision_gps_cod_tienda').value = codTiendaCryp;
        document.getElementById('revision_gps_nombre_tienda').textContent = nombreTienda;
        
        var mapaContainer = document.getElementById('gps_mapa_container');
        var sinUbicacion = document.getElementById('gps_sin_ubicacion');
        var botonesAccion = document.getElementById('gps_botones_accion');
        var coordenadasTexto = document.getElementById('revision_gps_coordenadas');
        
        if (coordenadasGPS && coordenadasGPS.trim() !== '') {
            mapaContainer.style.display = 'block';
            sinUbicacion.style.display = 'none';
            botonesAccion.style.display = 'flex';
            coordenadasTexto.textContent = 'Coordenadas: ' + coordenadasGPS;
            coordenadasTexto.style.display = 'block';
            var iframe = document.getElementById('gps_mapa_iframe');
            var googleMapsUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(coordenadasGPS) + '&output=embed';
            iframe.src = googleMapsUrl;
            
            window.currentGPSCoords = coordenadasGPS;
        } else {
            mapaContainer.style.display = 'none';
            sinUbicacion.style.display = 'block';
            botonesAccion.style.display = 'none';
            coordenadasTexto.style.display = 'none';
            window.currentGPSCoords = null;
        }
        
        document.getElementById('modalRevisionGPS').classList.add('show');
    }
    
    window.cerrarModalRevisionGPS = function() {
        document.getElementById('modalRevisionGPS').classList.remove('show');
        document.getElementById('gps_mapa_iframe').src = '';
        window.currentGPSCoords = null;
    }
    
    window.abrirGoogleMaps = function() {
        if (window.currentGPSCoords) {
            var googleMapsUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(window.currentGPSCoords);
            window.open(googleMapsUrl, '_blank');
        } else {
            Swal.fire({ 
                icon: 'error', title: 'Error', text: 'No hay coordenadas disponibles', background: '#1a1f2e', color: 'white',
                customClass: { container: 'swal2-above-modal' }
            });
        }
    }
    
    window.copiarCoordenadas = function() {
        if (window.currentGPSCoords) {
            navigator.clipboard.writeText(window.currentGPSCoords).then(function() {
                Swal.fire({ 
                    icon: 'success', title: '¡Copiado!', text: 'Coordenadas copiadas al portapapeles', timer: 1500, showConfirmButton: false, background: '#1a1f2e', color: 'white',
                    customClass: { container: 'swal2-above-modal' }
                });
            }).catch(function() {
                Swal.fire({ 
                    icon: 'error', title: 'Error', text: 'No se pudo copiar las coordenadas', background: '#1a1f2e', color: 'white',
                    customClass: { container: 'swal2-above-modal' }
                });
            });
        } else {
            Swal.fire({ 
                icon: 'error', title: 'Error', text: 'No hay coordenadas disponibles', background: '#1a1f2e', color: 'white',
                customClass: { container: 'swal2-above-modal' } 
            });
        }
    }
    
    // ====================== COMPARTIR ENLACE PARA CAPTURAR GPS ======================
    window.compartirGPSWhatsApp = function() {
        var codTienda = document.getElementById('revision_gps_cod_tienda').value;
        var nombreTienda = document.getElementById('revision_gps_nombre_tienda').textContent;
        
        if (!codTienda) { 
            alert('No se encontró el código de la tienda'); 
            return; 
        }
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        var mensaje = '¡Hola! Por favor registra la ubicación GPS de ' + nombreTienda + ' en el siguiente enlace: ' + enlaceGPS;
        var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
        window.open(urlWhatsApp, '_blank');
    }
    
    window.compartirGPSEmail = function() {
        var codTienda = document.getElementById('revision_gps_cod_tienda').value;
        var nombreTienda = document.getElementById('revision_gps_nombre_tienda').textContent;
        
        if (!codTienda) { 
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se encontró el código de la tienda', 
                background: '#1a1f2e', 
                color: 'white',
                confirmButtonColor: '#ef4444',
                customClass: { container: 'swal2-above-modal' }
            });
            return; 
        }
        
        Swal.fire({
            title: 'Enviar por Correo',
            html: '<p style="margin-bottom: 15px;">Ingrese el correo electrónico del destinatario:</p>',
            input: 'email',
            inputPlaceholder: 'ejemplo@correo.com',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
            background: '#1a1f2e',
            color: 'white',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            customClass: { container: 'swal2-above-modal' },
            inputAttributes: {
                autocomplete: 'email',
                style: 'background: #2d3748; color: white; border: 1px solid #4a5568; padding: 10px; border-radius: 8px;'
            },
            inputValidator: (value) => {
                if (!value) {
                    return 'Debe ingresar un correo electrónico';
                }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    return 'Ingrese un correo electrónico válido';
                }
            }
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                var currentPath = window.location.pathname;
                var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
                var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTienda);
                
                Swal.fire({
                    title: 'Enviando correo...',
                    html: 'Por favor espere',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: { container: 'swal2-above-modal' },
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                $.ajax({
                    url: '../admin/enviar_gps_tienda_email.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        correo: result.value,
                        nombre_tienda: nombreTienda,
                        enlace_gps: enlaceGPS
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Correo Enviado!',
                                text: response.mensaje || 'El correo se envió exitosamente',
                                background: '#1a1f2e',
                                color: 'white',
                                confirmButtonColor: '#8b5cf6',
                                customClass: { container: 'swal2-above-modal' }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.mensaje || 'No se pudo enviar el correo',
                                background: '#1a1f2e',
                                color: 'white',
                                confirmButtonColor: '#ef4444',
                                customClass: { container: 'swal2-above-modal' }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar correo:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Conexión',
                            text: 'No se pudo conectar con el servidor para enviar el correo',
                            background: '#1a1f2e',
                            color: 'white',
                            confirmButtonColor: '#ef4444',
                            customClass: { container: 'swal2-above-modal' }
                        });
                    }
                });
            }
        });
    }
    
    window.copiarEnlaceGPS = function() {
        var codTienda = document.getElementById('revision_gps_cod_tienda').value;
        
        if (!codTienda) { 
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se encontró el código de la tienda', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' }
            }); 
            return; 
        }
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        navigator.clipboard.writeText(enlaceGPS).then(function() {
            Swal.fire({ 
                icon: 'success', 
                title: '¡Copiado!', 
                text: 'Enlace copiado al portapapeles', 
                timer: 1500, 
                showConfirmButton: false, 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' }
            });
        }).catch(function() {
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se pudo copiar el enlace', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' } 
            });
        });
    }
    
    // ====================== GESTIÓN DE IMÁGENES DE TIENDA ======================
    window.abrirModalImagenes = function(codTiendaCryp, nombreTienda) {
        console.log('abrirModalImagenes:', { codTiendaCryp, nombreTienda });
        
        document.getElementById('imagenes_cod_tienda').value = codTiendaCryp;
        document.getElementById('imagenes_nombre_tienda').value = nombreTienda;
        document.getElementById('imagenes_tienda_nombre_display').textContent = nombreTienda;
        
        document.getElementById('modalImagenesTienda').classList.add('show');
    }
    
    window.cerrarModalImagenes = function() {
        document.getElementById('modalImagenesTienda').classList.remove('show');
    }
    
    window.compartirImagenesWhatsApp = function() {
        var codTienda = document.getElementById('imagenes_cod_tienda').value;
        var nombreTienda = document.getElementById('imagenes_nombre_tienda').value;
        
        if (!codTienda) { 
            alert('No se encontró el código de la tienda'); 
            return; 
        }
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceImagenes = window.location.origin + basePath + 'imagenes_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        var mensaje = '¡Hola! Por favor carga las imágenes de ' + nombreTienda + ' en el siguiente enlace: ' + enlaceImagenes;
        var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
        window.open(urlWhatsApp, '_blank');
    }
    
    window.compartirImagenesEmail = function() {
        var codTienda = document.getElementById('imagenes_cod_tienda').value;
        var nombreTienda = document.getElementById('imagenes_nombre_tienda').value;
        
        if (!codTienda) { 
            alert('No se encontró el código de la tienda'); 
            return; 
        }
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceImagenes = window.location.origin + basePath + 'imagenes_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        Swal.fire({
            title: 'Enviar por Correo',
            html: '<p style="margin-bottom: 15px;">Ingrese el correo electrónico del destinatario:</p><input type="email" id="emailImagenesInput" class="swal2-input" placeholder="ejemplo@correo.com" style="background: #2d3748; color: white; border: 1px solid #4a5568; padding: 10px; border-radius: 8px;">',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '📧 Enviar',
            cancelButtonText: 'Cancelar',
            background: '#1a1f2e',
            color: 'white',
            confirmButtonColor: '#ec4899',
            cancelButtonColor: '#6b7280',
            customClass: { container: 'swal2-above-modal' },
            preConfirm: () => {
                const email = Swal.getPopup().querySelector('#emailImagenesInput').value;
                if (!email) {
                    Swal.showValidationMessage('Por favor ingrese un correo electrónico');
                    return false;
                }
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.showValidationMessage('Por favor ingrese un correo electrónico válido');
                    return false;
                }
                return email;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const email = result.value;
                
                Swal.fire({
                    title: 'Enviando correo...',
                    html: 'Por favor espere',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: { container: 'swal2-above-modal' },
                    didOpen: () => { Swal.showLoading(); }
                });
                
                $.ajax({
                    url: 'enviar_imagenes_tienda_email.php',
                    type: 'POST',
                    data: {
                        correo: email,
                        nombre_tienda: nombreTienda,
                        enlace_imagenes: enlaceImagenes
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Correo enviado!',
                                text: response.mensaje,
                                background: '#1a1f2e',
                                color: 'white',
                                confirmButtonColor: '#ec4899',
                                customClass: { container: 'swal2-above-modal' }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.mensaje || 'No se pudo enviar el correo',
                                background: '#1a1f2e',
                                color: 'white',
                                confirmButtonColor: '#ef4444',
                                customClass: { container: 'swal2-above-modal' }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Conexión',
                            text: 'No se pudo conectar con el servidor para enviar el correo',
                            background: '#1a1f2e',
                            color: 'white',
                            confirmButtonColor: '#ef4444',
                            customClass: { container: 'swal2-above-modal' }
                        });
                    }
                });
            }
        });
    }
    
    window.copiarEnlaceImagenes = function() {
        var codTienda = document.getElementById('imagenes_cod_tienda').value;
        
        if (!codTienda) { 
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se encontró el código de la tienda', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' }
            }); 
            return; 
        }
        
        var currentPath = window.location.pathname;
        var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
        var enlaceImagenes = window.location.origin + basePath + 'imagenes_tienda.php?cod=' + encodeURIComponent(codTienda);
        
        navigator.clipboard.writeText(enlaceImagenes).then(function() {
            Swal.fire({ 
                icon: 'success', 
                title: '¡Copiado!', 
                text: 'Enlace copiado al portapapeles', 
                timer: 1500, 
                showConfirmButton: false, 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' }
            });
        }).catch(function() {
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se pudo copiar el enlace', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal2-above-modal' } 
            });
        });
    }
});
</script>

</body>
</html>
