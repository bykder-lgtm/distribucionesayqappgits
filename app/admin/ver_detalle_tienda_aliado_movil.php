<?php 
$nombre_pagina          = "Detalle Tienda";
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
$cod_tienda = isset($_GET['cod_tienda']) ? intval($_GET['cod_tienda']) : 0;
if ($cod_tienda <= 0) { header("Location: lista_tiendas_aliado_movil.php"); exit; }
// Consultar información de la tienda
$sql = "SELECT t.*, a.nombres_apellidos_tercero AS nombre_aliado, b.nombre_banco_cuenta, b.numero_banco_cuenta 
FROM tbl15_tienda t LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador 
LEFT JOIN tbl15_banco_cuenta b ON t.cod_banco_cuenta = b.cod_banco_cuenta WHERE t.cod_tienda = '$cod_tienda' AND t.cod_aliado_estrategico = '$cod_administrador'";
$resultado = mysqli_query($conectar, $sql);
$tienda = mysqli_fetch_assoc($resultado);

if (!$tienda) { header("Location: lista_tiendas_aliado_movil.php"); exit; }
// Consultar productos de la tienda
$sql_productos = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, descripcion_producto, und_producto FROM tbl15_producto WHERE (cod_tienda = '$cod_tienda') ORDER BY cod_producto ASC";
$res_productos = mysqli_query($conectar, $sql_productos);
$total_productos = $res_productos ? mysqli_num_rows($res_productos) : 0;
// Contar productos activos e inactivos
$productos_activos = 0;
$productos_inactivos = 0;
if ($res_productos) {
    mysqli_data_seek($res_productos, 0);
    while ($prod = mysqli_fetch_assoc($res_productos)) { if ($prod['und_producto'] > 0) { $productos_activos++; } else { $productos_inactivos++; } }
    mysqli_data_seek($res_productos, 0);
}

// Consultar vendedores de la tienda
$sql_vendedores = "SELECT * FROM tbl15_administrador WHERE cod_vendedor = '$cod_tienda' AND cod_seguridad = '2' ORDER BY nombres_apellidos_tercero ASC";
$res_vendedores = mysqli_query($conectar, $sql_vendedores);
$total_vendedores = $res_vendedores ? mysqli_num_rows($res_vendedores) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 50%, #0a0e27 100%);
        min-height: 100vh;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .back-btn:hover {
        background: rgba(0, 212, 255, 0.2);
        color: #00d4ff;
        text-decoration: none;
    }
    
    .page-title {
        color: #00d4ff;
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        text-shadow: 0 2px 8px rgba(0, 212, 255, 0.3);
    }
    
    .profile-card {
        background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
        border: 1px solid rgba(65, 105, 225, 0.3);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
    }
    
    .profile-header {
        background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
        padding: 2rem 1.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(0, 212, 255, 0.3) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        border: 4px solid rgba(255,255,255,0.3);
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .profile-name {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }
    
    .profile-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }
    
    .profile-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .profile-status.activo {
        background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
    }
    
    .profile-status.inactivo {
        background: linear-gradient(135deg, #ff6f00 0%, #ff9800 100%);
    }
    
    .profile-body {
        padding: 1.5rem;
    }
    
    .detail-section {
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        color: #00d4ff;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(65, 105, 225, 0.2);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 212, 255, 0.3);
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
        border: 1px solid rgba(65, 105, 225, 0.1);
        transition: all 0.3s ease;
    }
    
    .detail-item:hover {
        background: rgba(255,255,255,0.05);
        border-color: rgba(0, 212, 255, 0.3);
    }
    
    .detail-label {
        color: rgba(255,255,255,0.6);
        font-size: 0.85rem;
    }
    
    .detail-value {
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        text-align: right;
        max-width: 60%;
        word-break: break-word;
    }
    
    .document-section {
        background: rgba(255,255,255,0.03);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid rgba(65, 105, 225, 0.1);
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
        background: rgba(0, 212, 255, 0.2);
        color: #00d4ff;
    }
    
    .document-status.missing {
        background: rgba(255, 111, 0, 0.2);
        color: #ff9800;
    }
    
    .document-link {
        color: #00d4ff;
        text-decoration: none;
        font-size: 0.8rem;
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .document-link:hover {
        color: #5b7ce6;
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
        border: 1px solid rgba(65, 105, 225, 0.2);
    }
    
    .image-item:hover {
        border-color: #00d4ff;
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
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
        grid-template-columns: 1fr;
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
    
    .action-btn-full.back {
        background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.4);
    }
    
    .action-btn-full.back:hover {
        background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 212, 255, 0.5);
        color: white;
        text-decoration: none;
    }
    
    /* Estilos para productos */
    .productos-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .producto-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(65, 105, 225, 0.2);
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
    }
    
    .producto-item:hover {
        border-color: rgba(0, 212, 255, 0.5);
        background: rgba(255,255,255,0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 212, 255, 0.2);
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
        color: #00d4ff;
        text-shadow: 0 2px 4px rgba(0, 212, 255, 0.3);
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
        background: rgba(0, 212, 255, 0.2);
        color: #00d4ff;
    }
    
    .producto-stock.agotado {
        background: rgba(255, 111, 0, 0.2);
        color: #ff9800;
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
        border: 2px dashed rgba(65, 105, 225, 0.2);
        border-radius: 12px;
    }
    
    .producto-empty i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(65, 105, 225, 0.3);
    }
    
    .producto-empty p {
        margin: 0;
        font-size: 0.9rem;
    }
    
    /* Estadísticas de productos */
    .tienda-stats {
        display: flex;
        justify-content: space-between;
        gap: 0.75rem;
        margin-top: 1rem;
        padding: 1rem;
        background: rgba(255,255,255,0.03);
        border-radius: 12px;
        border: 1px solid rgba(65, 105, 225, 0.2);
    }
    
    .stat-item {
        flex: 1;
        text-align: center;
        padding: 0.75rem 0.5rem;
        border-radius: 8px;
        background: rgba(255,255,255,0.05);
    }
    
    .stat-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.8;
    }
    
    .stat-total {
        color: #00d4ff;
    }
    
    .stat-activos {
        color: #48bb78;
    }
    
    .stat-inactivos {
        color: #ff9800;
    }

    @media(min-width: 600px) {
        .detail-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .image-gallery {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
        .productos-list {
            grid-template-columns: repeat(2, 1fr);
        }
        .action-buttons {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>

<main class="page-container">
    <div class="page-header">
        <a href="lista_tiendas_aliado_movil.php" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Detalle de Tienda</h1>
    </div>

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <?php if (!empty($tienda['url_img_logo_empresa'])): ?>
                    <img src="<?php echo $tienda['url_img_logo_empresa']; ?>" alt="Logo de la tienda">
                <?php else: ?>
                    <i class="fa-solid fa-store"></i>
                <?php endif; ?>
            </div>
            <h2 class="profile-name"><?php echo $tienda['nombre_tienda'] ?: 'Tienda sin nombre'; ?></h2>
            <p class="profile-subtitle">NIT: <?php echo $tienda['identificacion_tercero']; ?></p>
            <span class="profile-status <?php echo $tienda['cod_estado'] == '1' ? 'activo' : 'inactivo'; ?>">
                <?php echo $tienda['cod_estado'] == '1' ? 'Activa' : 'Inactiva'; ?>
            </span>
        </div>
        
        <div class="profile-body">
            <!-- Estadísticas de Productos -->
            <div class="tienda-stats">
                <div class="stat-item stat-total">
                    <span class="stat-number"><?php echo $total_productos; ?></span>
                    <span class="stat-label">Total Productos</span>
                </div>
                <div class="stat-item stat-activos">
                    <span class="stat-number"><?php echo $productos_activos; ?></span>
                    <span class="stat-label">Con Stock</span>
                </div>
                <div class="stat-item stat-inactivos">
                    <span class="stat-number"><?php echo $productos_inactivos; ?></span>
                    <span class="stat-label">Agotados</span>
                </div>
            </div>

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
                <h3 class="section-title"><i class="fa-solid fa-user-tie"></i>Representante Legal</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nombre</span>
                        <span class="detail-value"><?php echo $tienda['nombre_representante'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Documento</span>
                        <span class="detail-value"><?php echo $tienda['documento_representante'] ?: 'No registrado'; ?></span>
                    </div>
                    <?php if (!empty($tienda['correo_representante'])): ?>
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Correo</span>
                        <span class="detail-value"><?php echo $tienda['correo_representante']; ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Información Comercial -->
            <div class="detail-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-dollar-sign"></i>Información Comercial</h3>
                <div class="detail-grid">
                    <!--
                    <div class="detail-item">
                        <span class="detail-label">Comisión</span>
                        <span class="detail-value"><?php echo $tienda['comision_ptj']; ?>%</span>
                    </div>
                    -->
                    <div class="detail-item">
                        <span class="detail-label">Banco</span>
                        <span class="detail-value"><?php echo $tienda['nombre_banco_cuenta']; ?></span>
                    </div>
                    <?php if (!empty($tienda['numero_banco_cuenta'])): ?>
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Cuenta Bancaria</span>
                        <span class="detail-value"><?php echo $tienda['numero_banco_cuenta']; ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Ubicación -->
            <?php if (!empty($tienda['ubicacion_gps_tienda'])): ?>
            <div class="detail-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-map-marker-alt"></i>
                    Ubicación GPS
                </h3>
                <div class="detail-grid">
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Coordenadas</span>
                        <span class="detail-value"><?php echo $tienda['ubicacion_gps_tienda']; ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Documentación Legal -->
            <div class="detail-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-file-contract"></i>
                    Documentación Legal
                </h3>
                <div class="document-section">
                    <div class="document-item">
                        <div class="document-label">
                            <i class="fa-solid fa-file-pdf"></i>
                            RUT
                        </div>
                        <div>
                            <?php if (!empty($tienda['url_documentacion_rut_tienda'])): ?>
                                <span class="document-status uploaded">Cargado</span>
                                <a href="<?php echo $tienda['url_documentacion_rut_tienda']; ?>" target="_blank" class="document-link">
                                    <i class="fa-solid fa-eye"></i> Ver
                                </a>
                            <?php else: ?>
                                <span class="document-status missing">No cargado</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="document-item">
                        <div class="document-label">
                            <i class="fa-solid fa-file-pdf"></i>
                            Cámara de Comercio
                        </div>
                        <div>
                            <?php if (!empty($tienda['url_documentacion_camaracomercio_tienda'])): ?>
                                <span class="document-status uploaded">Cargado</span>
                                <a href="<?php echo $tienda['url_documentacion_camaracomercio_tienda']; ?>" target="_blank" class="document-link">
                                    <i class="fa-solid fa-eye"></i> Ver
                                </a>
                            <?php else: ?>
                                <span class="document-status missing">No cargado</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (!empty($tienda['url_documentacion_extra1_tienda'])): ?>
                    <div class="document-item">
                        <div class="document-label">
                            <i class="fa-solid fa-file-pdf"></i>
                            Documento Extra 1
                        </div>
                        <div>
                            <span class="document-status uploaded">Cargado</span>
                            <a href="<?php echo $tienda['url_documentacion_extra1_tienda']; ?>" target="_blank" class="document-link">
                                <i class="fa-solid fa-eye"></i> Ver
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($tienda['url_documentacion_extra2_tienda'])): ?>
                    <div class="document-item">
                        <div class="document-label">
                            <i class="fa-solid fa-file-pdf"></i>
                            Documento Extra 2
                        </div>
                        <div>
                            <span class="document-status uploaded">Cargado</span>
                            <a href="<?php echo $tienda['url_documentacion_extra2_tienda']; ?>" target="_blank" class="document-link">
                                <i class="fa-solid fa-eye"></i> Ver
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Imágenes de la Tienda -->
            <div class="detail-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-images"></i>
                    Imágenes de la Tienda
                </h3>
                <div class="image-gallery">
                    <?php 
                    $imagenes = [
                        'Fachada' => $tienda['url_img_fachada_tienda'],
                        'Interior' => $tienda['url_img_interna_tienda'],
                        'Opcional' => $tienda['url_img_otraopcional_tienda']
                    ];
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

            <!-- Vendedores de la Tienda -->
            <div class="detail-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h3 class="section-title" style="margin: 0;">
                        <i class="fa-solid fa-users"></i>
                        Vendedores (<?php echo $total_vendedores; ?>)
                    </h3>
                    <button type="button" class="btn" data-toggle="modal" data-target="#modalRegistrarVendedor" style="background: rgba(65, 105, 225, 0.2); color: #4169e1; border: none; padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                        <i class="fa fa-user-plus"></i> Registrar Vendedor
                    </button>
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
                <h3 class="section-title">
                    <i class="fa-solid fa-box"></i>
                    Productos (<?php echo $total_productos; ?>)
                </h3>
                
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
                            <div class="producto-descripcion">
                                <?php echo substr(strip_tags($producto['descripcion_producto']), 0, 150); ?>
                                <?php echo strlen(strip_tags($producto['descripcion_producto'])) > 150 ? '...' : ''; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="producto-empty" style="grid-column: 1 / -1;">
                            <i class="fa-solid fa-box-open"></i>
                            <p>No hay productos registrados en esta tienda</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="action-buttons">
                <a href="lista_tiendas_aliado_movil.php" class="action-btn-full back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver al Listado
                </a>
            </div>
        </div>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_visitante_intern_movil.php"); ?>

<script>
// Función para mostrar imagen en modal o nueva ventana
function mostrarImagen(url, tipo) {
    if (!url) return;
    Swal.fire({ title: tipo + ' de la Tienda', imageUrl: url, imageAlt: tipo, width: '90%', showCloseButton: true, showConfirmButton: false, background: 'linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%)', customClass: { popup: 'swal-custom-popup' } });
}

// =====================================================
// FUNCIONES PARA REGISTRAR VENDEDOR
// =====================================================
$(document).ready(function() {
    const btnGuardarVendedor = document.getElementById('btn_guardar_vendedor');
    if (btnGuardarVendedor) {
        btnGuardarVendedor.addEventListener('click', function() {
            const form = document.getElementById('formRegistroVendedor');
            
            // Validar campos requeridos
            const nombres = document.getElementById('vend_nombres').value.trim();
            const apellidos = document.getElementById('vend_apellidos').value.trim();
            const identificacion = document.getElementById('vend_identificacion').value.trim();
            const telefono = document.getElementById('vend_telefono').value.trim();
            const correo = document.getElementById('vend_correo').value.trim();
            
            if (!nombres || !apellidos || !identificacion || !telefono || !correo) {
                Swal.fire({ icon: 'warning', title: 'Campos incompletos', text: 'Por favor completa todos los campos obligatorios', confirmButtonColor: '#4169e1' });
                return;
            }
            
            
            // Validar correo electrónico
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(correo)) {
                Swal.fire({ icon: 'warning', title: 'Correo inválido', text: 'Por favor ingresa un correo electrónico válido', confirmButtonColor: '#4169e1' });
                return;
            }
            
            const formData = new FormData(form);
            
            const btnOriginal = this.innerHTML;
            this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
            this.disabled = true;
            
            fetch('registrar_vendedor_tienda_ajax.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Vendedor Registrado!',
                        text: data.message || 'El vendedor ha sido registrado exitosamente',
                        confirmButtonColor: '#4169e1'
                    }).then(() => {
                        $('#modalRegistrarVendedor').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo registrar el vendedor',
                        confirmButtonColor: '#4169e1'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo procesar la solicitud',
                    confirmButtonColor: '#4169e1'
                });
            })
            .finally(() => {
                this.innerHTML = btnOriginal;
                this.disabled = false;
            });
        });
    }

    // Limpiar formulario al cerrar modal de vendedor
    $('#modalRegistrarVendedor').on('hidden.bs.modal', function() {
        const form = document.getElementById('formRegistroVendedor');
        if (form) form.reset();
        
        const result = document.getElementById('result_vendedor');
        if (result) result.innerHTML = '';
    });
});
</script>

<!-- Modal Registrar Vendedor -->
<div class="modal fade modal-producto" id="modalRegistrarVendedor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%); border: 1px solid rgba(65, 105, 225, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(65, 105, 225, 0.2);">
                <h5 class="modal-title" style="color: #00d4ff;"><i class="fa fa-user-plus"></i> Registrar Nuevo Vendedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="result_vendedor"></div>
                <form id="formRegistroVendedor">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color: #00d4ff; font-weight: 600;">Nombres *</label>
                                <input type="text" name="nombre1_tercero" id="vend_nombres" class="form-control" required style="background: rgba(255,255,255,0.05); border: 1px solid rgba(65, 105, 225, 0.3); color: white;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color: #00d4ff; font-weight: 600;">Apellidos *</label>
                                <input type="text" name="apellido1_tercero" id="vend_apellidos" class="form-control" required style="background: rgba(255,255,255,0.05); border: 1px solid rgba(65, 105, 225, 0.3); color: white;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color: #00d4ff; font-weight: 600;">Identificación (CC) *</label>
                                <input type="text" name="identificacion_tercero" id="vend_identificacion" class="form-control" required style="background: rgba(255,255,255,0.05); border: 1px solid rgba(65, 105, 225, 0.3); color: white;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color: #00d4ff; font-weight: 600;">Teléfono *</label>
                                <input type="text" name="telefono1_tercero" id="vend_telefono" class="form-control" required style="background: rgba(255,255,255,0.05); border: 1px solid rgba(65, 105, 225, 0.3); color: white;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color: #00d4ff; font-weight: 600;">Correo Electrónico *</label>
                                <input type="email" name="correo_tercero" id="vend_correo" class="form-control" required style="background: rgba(255,255,255,0.05); border: 1px solid rgba(65, 105, 225, 0.3); color: white;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert" style="background: rgba(65, 105, 225, 0.15); border: 1px solid rgba(65, 105, 225, 0.3); color: #00d4ff;">
                                <i class="fa fa-info-circle"></i> <strong>Información:</strong> El usuario y contraseña se generarán automáticamente basándose en la identificación del vendedor.
                                <br><small>Usuario: identificacion-codigoautogenerado | Contraseña: identificación</small>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="cod_tienda" value="<?php echo $cod_tienda; ?>">
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(65, 105, 225, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" style="background: rgba(255,255,255,0.1); color: white; border: none;">
                    <i class="fa fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn" id="btn_guardar_vendedor" style="background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%); color: white; border: none; box-shadow: 0 4px 15px rgba(65, 105, 225, 0.4);">
                    <i class="fa fa-save"></i> Guardar Vendedor
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.swal-custom-popup {
    border: 1px solid rgba(65, 105, 225, 0.3) !important;
    box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3) !important;
}

.swal2-title {
    color: #00d4ff !important;
    text-shadow: 0 2px 4px rgba(0, 212, 255, 0.3) !important;
}

.swal2-close {
    color: white !important;
}

.swal2-close:hover {
    color: #00d4ff !important;
}
</style>

</body>
</html>
