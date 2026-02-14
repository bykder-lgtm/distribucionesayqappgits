<?php 
$nombre_pagina          = "Productos";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_coordinador.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_coordinador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>

<style>
/* ============================================ */
/* LISTA PRODUCTOS COORDINADOR - TEMA AZUL INDIGO */
/* ============================================ */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
}

.page-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(99, 102, 241, 0.4);
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.page-header h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    z-index: 2;
}

.page-header p {
    color: rgba(255,255,255,0.9);
    font-size: 0.85rem;
    margin: 0.5rem 0 0 0;
    position: relative;
    z-index: 2;
}

.header-stats {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    position: relative;
    z-index: 2;
}

.header-stat {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 12px;
    text-align: center;
}

.header-stat-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: white;
}

.header-stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
}

/* Search Bar */
.search-bar {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(99, 102, 241, 0.3);
    border-radius: 16px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.search-bar input {
    flex: 1;
    background: transparent;
    border: none;
    color: white;
    font-size: 0.95rem;
    outline: none;
}

.search-bar input::placeholder {
    color: rgba(255,255,255,0.5);
}

.search-bar i {
    color: #6366f1;
    font-size: 1.1rem;
}

/* Add Button */
.add-button {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 1rem;
    width: 100%;
    font-size: 1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
}

.add-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(99, 102, 241, 0.5);
}

/* Product Cards */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 1rem;
}

.product-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(99, 102, 241, 0.3);
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;
}

.product-card:hover {
    border-color: #6366f1;
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(99, 102, 241, 0.2);
}

.product-image {
    width: 100%;
    height: 140px;
    object-fit: cover;
    background: #1a1f2e;
}

.product-status {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    padding: 0.25rem 0.6rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
}

.product-status.active {
    color: #818cf8;
    border: 1px solid #818cf8;
}

.product-status.inactive {
    color: #ef4444;
    border: 1px solid #ef4444;
}

.product-info {
    padding: 1rem;
}

.product-name {
    font-size: 0.9rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-store {
    font-size: 0.75rem;
    color: #6366f1;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-price {
    font-size: 1.1rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.75rem;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    flex: 1;
    padding: 0.5rem;
    border-radius: 8px;
    border: none;
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    transition: all 0.3s ease;
}

.action-btn.primary {
    background: rgba(99, 102, 241, 0.2);
    color: #6366f1;
}

.action-btn.primary:hover {
    background: #6366f1;
    color: white;
}

/* Modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
    z-index: 2000;
    display: none;
    align-items: flex-end;
    justify-content: center;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 24px 24px 0 0;
    width: 100%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 0;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from { transform: translateY(100%); }
    to { transform: translateY(0); }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(99, 102, 241, 0.2);
    position: sticky;
    top: 0;
    background: #1a1f2e;
    z-index: 10;
}

.modal-body {
    padding: 1.5rem;
}

.modal-header h2 {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

.modal-close {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 1rem;
}

/* Form Styles */
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

.form-input, .form-select, .form-textarea {
    width: 100%;
    background: rgba(99, 102, 241, 0.1);
    border: 1px solid rgba(99, 102, 241, 0.3);
    border-radius: 12px;
    padding: 0.85rem 1rem;
    color: white;
    font-size: 0.95rem;
    outline: none;
    transition: all 0.3s ease;
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.file-input-wrapper {
    position: relative;
    border: 2px dashed rgba(99, 102, 241, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    background: rgba(99, 102, 241, 0.05);
    transition: all 0.3s ease;
}

.file-input-wrapper:hover {
    border-color: #6366f1;
    background: rgba(99, 102, 241, 0.1);
}

.file-input-wrapper input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-input-icon {
    font-size: 2rem;
    color: #6366f1;
    margin-bottom: 0.5rem;
}

.image-preview {
    margin-top: 1rem;
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    display: none;
    border: 1px solid rgba(99, 102, 241, 0.3);
}

.submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 2rem;
    transition: all 0.3s ease;
}

/* Bottom Navigation */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-top: 1px solid rgba(99, 102, 241, 0.2);
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
    color: #6366f1;
    text-decoration: none;
}

.nav-item.active {
    background: rgba(99, 102, 241, 0.1);
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

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-state i {
    font-size: 4rem;
    color: rgba(99, 102, 241, 0.3);
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: white;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
}

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-in {
    animation: fadeInUp 0.5s ease forwards;
}

.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
</style>
</head>
<body>

<?php
// Obtener parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
$cod_tienda_filtro = isset($_GET['tienda']) ? mysqli_real_escape_string($conectar, $_GET['tienda']) : '';

// Consulta de productos
$sql_productos = "SELECT p.*, t.nombre_tienda 
FROM tbl15_producto p
INNER JOIN tbl15_tienda t ON p.cod_tienda = t.cod_tienda
WHERE t.cod_administrador = '$cod_administrador'";

if (!empty($busqueda)) {
    $sql_productos .= " AND (p.nombre_producto LIKE '%$busqueda%' OR p.cod_producto_barra LIKE '%$busqueda%')";
}

if (!empty($cod_tienda_filtro)) {
    $sql_productos .= " AND p.cod_tienda = '$cod_tienda_filtro'";
}

$sql_productos .= " ORDER BY p.fecha_creacion DESC LIMIT 50";
$resultado_productos = mysqli_query($conectar, $sql_productos);
$total_productos = mysqli_num_rows($resultado_productos);

// Consultas para combos del modal
$sql_tiendas = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_administrador = '$cod_administrador' AND cod_estado = '1' ORDER BY nombre_tienda ASC";
$res_tiendas = mysqli_query($conectar, $sql_tiendas);

$sql_categorias = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
$res_categorias = mysqli_query($conectar, $sql_categorias);

$sql_iva = "SELECT iva FROM tbl15_tipo_iva WHERE cod_estado = '1' ORDER BY iva ASC";
$res_iva = mysqli_query($conectar, $sql_iva);

$sql_estado = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
$res_estado = mysqli_query($conectar, $sql_estado);

// Siguiente código de barra
$sql_cod = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra), 20,0) DESC LIMIT 0,1";
$cons_cod = mysqli_query($conectar, $sql_cod);
$row_cod = mysqli_fetch_assoc($cons_cod);
$next_code = isset($row_cod['cod_producto_barra']) ? $row_cod['cod_producto_barra'] + 1 : 1;
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-boxes-stacked"></i> Productos</h1>
        <p>Gestiona el catálogo de tus tiendas</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_productos; ?></div>
                <div class="header-stat-label">Total</div>
            </div>
            <!-- Más stats aquí si es necesario -->
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-bar animate-in delay-1">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar producto..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrarProductos(this.value)">
    </div>

    <!-- Add Button -->
    <button class="add-button animate-in delay-1" onclick="abrirModalProducto()">
        <i class="fa-solid fa-plus"></i>
        Registrar Nuevo Producto
    </button>

    <!-- Product Grid -->
    <div class="product-grid" id="productGrid">
        <?php if ($total_productos > 0): ?>
            <?php while ($prod = mysqli_fetch_assoc($resultado_productos)): 
                $imagen = !empty($prod['url_img_producto']) ? $prod['url_img_producto'] : 'https://via.placeholder.com/150';
                $estado_clase = $prod['cod_estado'] == 1 ? 'active' : 'inactive';
                $estado_texto = $prod['cod_estado'] == 1 ? 'Activo' : 'Inactivo';
            ?>
            <div class="product-card animate-in delay-2">
                <div class="product-status <?php echo $estado_clase; ?>"><?php echo $estado_texto; ?></div>
                <img src="<?php echo $imagen; ?>" alt="<?php echo $prod['nombre_producto']; ?>" class="product-image">
                <div class="product-info">
                    <div class="product-name"><?php echo ucwords(strtolower($prod['nombre_producto'])); ?></div>
                    <div class="product-store">
                        <i class="fa-solid fa-store"></i> <?php echo ucwords(strtolower($prod['nombre_tienda'])); ?>
                    </div>
                    <div class="product-price">$<?php echo number_format($prod['precio_venta_producto'], 0, ',', '.'); ?></div>
                    <div class="product-actions">
                        <button class="action-btn primary" onclick="editarProducto(<?php echo $prod['cod_producto']; ?>)">
                            <i class="fa-solid fa-edit"></i> Editar
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-box-open"></i>
                <h3>No hay productos</h3>
                <p>No se encontraron productos registrados</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Modal Registro/Edición -->
<div class="modal-overlay" id="modalProducto" style="align-items: flex-start; padding-top: 20px;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle"><i class="fa-solid fa-box"></i> Nuevo Producto</h2>
            <button class="modal-close" onclick="cerrarModal()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <form id="formProducto" enctype="multipart/form-data">
                <input type="hidden" name="cod_producto" id="cod_producto">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Código Barra *</label>
                        <input type="text" class="form-input" name="cod_producto_barra" id="cod_producto_barra" value="<?php echo $next_code; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tienda *</label>
                        <select class="form-select" name="cod_tienda" id="cod_tienda" required>
                            <option value="">Seleccione</option>
                            <?php 
                            mysqli_data_seek($res_tiendas, 0);
                            while ($t = mysqli_fetch_assoc($res_tiendas)): ?>
                            <option value="<?php echo $t['cod_tienda']; ?>"><?php echo $t['nombre_tienda']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre Producto *</label>
                    <input type="text" class="form-input" name="nombre_producto" id="nombre_producto" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Precio Compra *</label>
                        <input type="text" class="form-input precio-input" name="precio_compra_producto" id="precio_compra_producto" required>
                    </div>
                    <div class="form-group">
                         <label class="form-label">Precio Venta *</label>
                        <input type="text" class="form-input precio-input" name="precio_venta_producto" id="precio_venta_producto" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Categoría *</label>
                         <select class="form-select" name="cod_categoria" id="cod_categoria" required>
                            <option value="">Seleccione</option>
                            <?php 
                            mysqli_data_seek($res_categorias, 0);
                            while ($c = mysqli_fetch_assoc($res_categorias)): ?>
                            <option value="<?php echo $c['cod_categoria']; ?>"><?php echo $c['nombre_categoria']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">IVA *</label>
                        <select class="form-select" name="iva_ptj" id="iva_ptj" required>
                            <?php 
                            mysqli_data_seek($res_iva, 0);
                            while ($i = mysqli_fetch_assoc($res_iva)): ?>
                            <option value="<?php echo $i['iva']; ?>"><?php echo $i['iva']; ?>%</option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-textarea" name="descripcion_producto" id="descripcion_producto" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="cod_estado" id="cod_estado" required>
                        <?php 
                        mysqli_data_seek($res_estado, 0);
                        while ($e = mysqli_fetch_assoc($res_estado)): ?>
                        <option value="<?php echo $e['cod_estado']; ?>"><?php echo $e['nombre_estado']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Imagen Producto</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="imagen_producto" id="imagen_producto" accept="image/*" onchange="previewImage(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-image"></i></div>
                        <div class="file-input-text">Toca para subir imagen</div>
                    </div>
                    <img id="preview" class="image-preview" alt="Vista previa">
                </div>

                <button type="submit" class="submit-btn" id="btnGuardar">
                    <i class="fa-solid fa-save"></i> Guardar Producto
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <a href="dashboard_coordinador_movil.php" class="nav-item">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
    <a href="lista_tienda_coordinador_movil.php" class="nav-item">
        <i class="fa-solid fa-store"></i>
        <span>Tiendas</span>
    </a>
    <a href="lista_info_factura_venta_coordinador_movil.php" class="nav-item">
        <i class="fa-solid fa-credit-card"></i>
        <span>Créditos</span>
    </a>
    <a href="lista_producto_coordinador_movil.php" class="nav-item active">
        <i class="fa-solid fa-boxes-stacked"></i>
        <span>Productos</span>
    </a>
    <a href="config_coordinador_movil.php" class="nav-item">
        <i class="fa-solid fa-gear"></i>
        <span>Config</span>
    </a>
</nav>

<script>
function abrirModalProducto() {
    $('#formProducto')[0].reset();
    $('#cod_producto').val('');
    $('#modalTitle').html('<i class="fa-solid fa-box"></i> Nuevo Producto');
    $('#preview').hide().attr('src', '');
    $('#cod_producto_barra').val('<?php echo $next_code; ?>');
    document.getElementById('modalProducto').classList.add('show');
}

function cerrarModal() {
    document.getElementById('modalProducto').classList.remove('show');
}

function filtrarProductos(busqueda) {
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(function() {
        window.location.href = 'lista_producto_coordinador_movil.php?busqueda=' + encodeURIComponent(busqueda);
    }, 500);
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#preview').hide();
    }
}

// Formateo de precios
$('.precio-input').on('input', function() {
    var val = $(this).val().replace(/\D/g, '');
    $(this).val(val.replace(/\B(?=(\d{3})+(?!\d))/g, "."));
});

// Editar Producto
function editarProducto(id) {
    Swal.fire({
        title: 'Cargando...',
        didOpen: () => { Swal.showLoading() },
        background: '#1a1f2e', color: 'white'
    });

    $.ajax({
        url: '../admin/get_producto_modal_coordinador_ajax.php',
        type: 'GET',
        data: { cod_producto: id },
        dataType: 'json',
        success: function(resp) {
            Swal.close();
            if (resp && resp.afectado === 'SI') {
                var p = resp.producto;
                $('#cod_producto').val(p.cod_producto);
                $('#cod_producto_barra').val(p.cod_producto_barra);
                $('#nombre_producto').val(p.nombre_producto);
                $('#cod_tienda').val(p.cod_tienda);
                $('#precio_compra_producto').val(String(p.precio_compra_producto).replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                $('#precio_venta_producto').val(String(p.precio_venta_producto).replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                $('#cod_categoria').val(p.cod_categoria);
                $('#iva_ptj').val(p.iva_ptj);
                $('#descripcion_producto').val(p.descripcion_producto);
                $('#cod_estado').val(p.cod_estado);
                
                if (p.url_img_producto) {
                    $('#preview').attr('src', p.url_img_producto).show();
                } else {
                    $('#preview').hide();
                }
                
                $('#modalTitle').html('<i class="fa-solid fa-edit"></i> Editar Producto');
                document.getElementById('modalProducto').classList.add('show');
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo cargar el producto' });
            }
        }
    });
}

// Guardar Producto
$('#formProducto').on('submit', function(e) {
    e.preventDefault();
    
    // Quitar formato de miles para enviar
    var precioCompra = $('#precio_compra_producto').val().replace(/\./g, '');
    var precioVenta = $('#precio_venta_producto').val().replace(/\./g, '');
    
    var formData = new FormData(this);
    formData.set('precio_compra_producto', precioCompra);
    formData.set('precio_venta_producto', precioVenta);
    
    var url = $('#cod_producto').val() ? '../admin/edit_producto_modal_coordinador_ajax_reg.php' : '../admin/reg_producto_modal_coordinador_ajax_reg.php';
    
    Swal.fire({
        title: 'Guardando...',
        didOpen: () => { Swal.showLoading() },
        background: '#1a1f2e', color: 'white'
    });
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(resp) {
            if (resp && resp.afectado === 'SI') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Producto guardado correctamente',
                    confirmButtonColor: '#6366f1',
                    background: '#1a1f2e', color: 'white'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: resp.mensaje || 'Error al guardar',
                    background: '#1a1f2e', color: 'white'
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexión',
                background: '#1a1f2e', color: 'white'
            });
        }
    });
});

// Cerrar modal al hacer clic fuera
document.getElementById('modalProducto').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModal();
    }
});
</script>

</body>
</html>
