<?php 
$nombre_pagina          = "Catálogo de Productos";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
/* Estilos para la vista de lista de productos */
.productos-lista-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.producto-lista-item {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 12px;
    display: flex;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
}

.producto-lista-item:hover {
    transform: translateX(5px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.3);
    border-color: rgba(0, 212, 255, 0.5);
}

.producto-lista-imagen {
    width: 100px;
    min-width: 100px;
    height: 100px;
    object-fit: cover;
    background: #0a0e27;
}

.producto-lista-info {
    flex: 1;
    padding: 0.75rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.producto-lista-nombre {
    color: #00d4ff;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.producto-lista-codigo {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.7rem;
    margin-bottom: 0.25rem;
}

.producto-lista-descripcion {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.75rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.producto-lista-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.producto-lista-precio {
    color: #5b7ce6;
    font-size: 1.1rem;
    font-weight: 700;
}

.producto-lista-precio-credito {
    color: #00d4ff;
    font-size: 0.8rem;
    font-weight: 600;
}

.producto-lista-stock {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 8px;
}

.stock-disponible {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
}

.stock-bajo {
    background: rgba(255, 152, 0, 0.15);
    color: #ff9800;
}

.stock-agotado {
    background: rgba(255, 111, 0, 0.15);
    color: #ff6f00;
}

/* Header de la página */
.page-header-catalogo {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.tienda-info-header {
    flex: 1;
}

.tienda-nombre-header {
    color: #00d4ff;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
}

.tienda-productos-count {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
    margin: 0;
}

.btn-volver {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-volver:hover {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

/* Buscador */
.search-container-lista {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 12px;
    padding: 0.75rem;
    margin-bottom: 1rem;
}

.search-input-lista {
    width: 100%;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 8px;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    color: white;
    font-size: 0.9rem;
    outline: none;
    transition: all 0.3s ease;
}

.search-input-lista::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.search-input-lista:focus {
    border-color: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
}

.search-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #5b7ce6;
}

/* Estado vacío */
.empty-state-lista {
    text-align: center;
    padding: 3rem 1rem;
    color: rgba(255, 255, 255, 0.7);
}

.empty-state-lista i {
    font-size: 4rem;
    color: #5b7ce6;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state-lista h4 {
    color: #00d4ff;
    margin-bottom: 0.5rem;
}

/* Promoción badge */
.producto-promocion-badge {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
    color: white;
    font-size: 0.65rem;
    padding: 0.15rem 0.4rem;
    border-radius: 4px;
    font-weight: 600;
    margin-left: 0.5rem;
    text-transform: uppercase;
}

/* Botón Nuevo Producto */
.btn-nuevo-producto {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
    white-space: nowrap;
}

.btn-nuevo-producto:hover {
    background: linear-gradient(135deg, #5b7ce6 0%, #00d4ff 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
}

/* Contenedor de acciones del producto */
.producto-acciones {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Botón Editar Producto */
.btn-editar-producto {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    color: white;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-editar-producto:hover {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
}

/* Estilos para modales */
.modal-producto .modal-content {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 12px;
    color: white;
}

.modal-producto .modal-header {
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
    padding: 1rem 1.5rem;
}

.modal-producto .modal-title {
    color: #00d4ff;
    font-weight: 600;
}

.modal-producto .close {
    color: #00d4ff;
    opacity: 0.8;
}

.modal-producto .close:hover {
    color: #fff;
    opacity: 1;
}

.modal-producto .modal-body {
    padding: 1.5rem;
}

.modal-producto .form-group label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}

.modal-producto .form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 8px;
    color: white;
    padding: 0.75rem;
}

.modal-producto .form-control:focus {
    border-color: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
    outline: none;
    background: rgba(255, 255, 255, 0.08);
}

.modal-producto .form-control::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

.modal-producto select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2300d4ff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px;
}

.modal-producto select.form-control option {
    background: #1a1d3a;
    color: white;
}

.modal-producto .modal-footer {
    border-top: 1px solid rgba(65, 105, 225, 0.3);
    padding: 1rem 1.5rem;
}

.modal-producto .btn-cancelar {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.modal-producto .btn-cancelar:hover {
    background: rgba(255, 255, 255, 0.2);
}

.modal-producto .btn-guardar {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.modal-producto .btn-guardar:hover {
    background: linear-gradient(135deg, #5b7ce6 0%, #00d4ff 100%);
    transform: translateY(-2px);
}

.modal-producto .btn-guardar:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.modal-producto .alert {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
}

.modal-producto .alert-success {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border: 1px solid rgba(0, 212, 255, 0.3);
}

.modal-producto .alert-danger {
    background: rgba(255, 111, 0, 0.15);
    color: #ff6f00;
    border: 1px solid rgba(255, 111, 0, 0.3);
}

.modal-producto .preview-imagen {
    margin-top: 0.5rem;
    max-width: 100%;
    border-radius: 8px;
    display: none;
}

.modal-producto .text-muted {
    color: rgba(255, 255, 255, 0.5) !important;
    font-size: 0.75rem;
}

/* Layout de 2 columnas para modales en móviles */
.modal-producto .modal-body .row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

.modal-producto .modal-body .row .col-md-6,
.modal-producto .modal-body .row .col-md-12 {
    padding: 0;
    width: 100%;
    max-width: 100%;
    flex: none;
}

.modal-producto .modal-body .row .col-md-12 {
    grid-column: 1 / -1;
}

.modal-producto .form-group {
    margin-bottom: 0.5rem;
}

.modal-producto .form-group label {
    font-size: 0.75rem;
    margin-bottom: 0.25rem;
}

.modal-producto .form-control {
    padding: 0.5rem 0.75rem;
    font-size: 0.85rem;
}

/* Modal más compacto */
.modal-producto .modal-body {
    padding: 1rem;
    max-height: 70vh;
    overflow-y: auto;
}

.modal-producto .modal-header,
.modal-producto .modal-footer {
    padding: 0.75rem 1rem;
}

.modal-producto .modal-title {
    font-size: 1rem;
}

/* Para pantallas muy pequeñas, mantener 2 columnas pero más compacto */
@media (max-width: 400px) {
    .modal-producto .modal-body .row {
        gap: 0.5rem;
    }
    .modal-producto .form-control {
        padding: 0.4rem 0.6rem;
        font-size: 0.8rem;
    }
    .modal-producto .form-group label {
        font-size: 0.7rem;
    }
}

/* ============================================ */
/* MODAL DETALLE PRODUCTO - DISEÑO PROFESIONAL */
/* ============================================ */

#modalDetalleProducto .modal-content {
    background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);
    border: 1px solid rgba(65, 105, 225, 0.4);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 30px rgba(0, 212, 255, 0.1);
}

#modalDetalleProducto .modal-header {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    border-bottom: none;
    padding: 1rem 1.5rem;
    position: relative;
}

#modalDetalleProducto .modal-title {
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

#modalDetalleProducto .close {
    color: white;
    opacity: 0.9;
    text-shadow: none;
    font-size: 1.5rem;
}

#modalDetalleProducto .close:hover {
    color: #00d4ff;
    opacity: 1;
}

.detalle-producto-container {
    padding: 0;
}

.detalle-producto-imagen-wrapper {
    position: relative;
    width: 100%;
    background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    overflow: hidden;
}

.detalle-producto-imagen-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at center, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
}

.detalle-producto-imagen {
    max-width: 100%;
    max-height: 250px;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    position: relative;
    z-index: 1;
}

.detalle-producto-info {
    padding: 1.5rem;
}

.detalle-producto-nombre {
    color: #00d4ff;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.detalle-producto-codigo {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.85rem;
    margin-bottom: 1rem;
}

.detalle-producto-codigo span {
    color: #5b7ce6;
    font-weight: 600;
}

.detalle-badges-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.badge-detalle {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.badge-stock-disponible {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(0, 212, 255, 0.1) 100%);
    color: #00d4ff;
    border: 1px solid rgba(0, 212, 255, 0.3);
}

.badge-stock-bajo {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.badge-stock-agotado {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.1) 100%);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.badge-promocion {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
    color: white;
    border: none;
}

.badge-categoria {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
    color: #a78bfa;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.detalle-precios-card {
    background: linear-gradient(135deg, rgba(65, 105, 225, 0.15) 0%, rgba(0, 212, 255, 0.1) 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 16px;
    padding: 1rem;
    margin-bottom: 1rem;
}

.detalle-precios-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.detalle-precio-item {
    text-align: center;
}

.detalle-precio-label {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.detalle-precio-valor {
    font-size: 1.4rem;
    font-weight: 800;
}

.detalle-precio-contado {
    color: #5b7ce6;
}

.detalle-precio-credito {
    color: #00d4ff;
}

.detalle-descripcion {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1rem;
}

.detalle-descripcion-titulo {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.detalle-descripcion-titulo i {
    color: #5b7ce6;
}

.detalle-descripcion-texto {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.9rem;
    line-height: 1.6;
}

.detalle-info-extra {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.detalle-info-item {
    background: rgba(65, 105, 225, 0.1);
    border: 1px solid rgba(65, 105, 225, 0.2);
    border-radius: 10px;
    padding: 0.75rem;
    text-align: center;
}

.detalle-info-item i {
    color: #5b7ce6;
    font-size: 1.2rem;
    margin-bottom: 0.25rem;
    display: block;
}

.detalle-info-item .label {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.7rem;
    text-transform: uppercase;
}

.detalle-info-item .value {
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
}

#modalDetalleProducto .modal-footer {
    background: rgba(0, 0, 0, 0.2);
    border-top: 1px solid rgba(65, 105, 225, 0.2);
    padding: 1rem 1.5rem;
    display: flex;
    gap: 0.75rem;
}

.btn-detalle-simular {
    flex: 1;
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-detalle-simular:hover {
    background: linear-gradient(135deg, #5b7ce6 0%, #00d4ff 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 212, 255, 0.4);
    color: white;
    text-decoration: none;
}

.btn-detalle-cerrar {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-detalle-cerrar:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Hacer clickeable la imagen y nombre */
.producto-clickeable {
    cursor: pointer;
    transition: all 0.3s ease;
}

.producto-clickeable:hover {
    opacity: 0.9;
}

.producto-lista-imagen.producto-clickeable:hover {
    transform: scale(1.02);
}

.producto-lista-nombre.producto-clickeable:hover {
    color: #5b7ce6;
    text-decoration: underline;
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
// Obtener el código de tienda del parámetro GET
if (isset($_GET['cod_tienda'])) { $cod_tienda_param = intval($_GET['cod_tienda']); } else { $cod_tienda_param = $cod_tienda; /*Usar la tienda del usuario si no se especifica*/}

// Obtener información de la tienda
$sql_tienda_info = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda_param'";
$consulta_tienda_info = mysqli_query($conectar, $sql_tienda_info);
$datos_tienda_info = mysqli_fetch_assoc($consulta_tienda_info);
$nombre_tienda_actual = isset($datos_tienda_info['nombre_tienda']) ? $datos_tienda_info['nombre_tienda'] : 'Tienda';

// Obtener el interés predeterminado para calcular precio crédito
$sql_entidad_crediticia = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
$consulta_entidad = mysqli_query($conectar, $sql_entidad_crediticia);
$matriz_entidad = mysqli_fetch_assoc($consulta_entidad);
$entidad_crediticia_interes_ptj = isset($matriz_entidad['entidad_crediticia_interes_ptj']) ? $matriz_entidad['entidad_crediticia_interes_ptj'] : 0;

// Obtener búsqueda
$buscador = isset($_GET['buscar']) ? mysqli_real_escape_string($conectar, trim($_GET['buscar'])) : '';
?>

<main class="container py-3 mb-5">
    <!-- Header con info de tienda -->
    <div class="page-header-catalogo">
        <a href="lista_tiendas_aliado_movil.php" class="btn-volver">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
        <div class="tienda-info-header">
            <h1 class="tienda-nombre-header"><i class="fa fa-store"></i> <?php echo ucwords(strtolower($nombre_tienda_actual)); ?></h1>
            <?php
            // Contar productos de esta tienda
            $sql_count = "SELECT COUNT(*) as total FROM tbl15_producto WHERE (cod_tienda = '$cod_tienda_param') AND (nombre_estado = 'HABILITADO')";
            $consulta_count = mysqli_query($conectar, $sql_count);
            $datos_count = mysqli_fetch_assoc($consulta_count);
            $total_productos = $datos_count['total'];
            ?>
            <p class="tienda-productos-count"><?php echo $total_productos; ?> productos disponibles</p>
        </div>
        <button type="button" class="btn-nuevo-producto" data-toggle="modal" data-target="#modalRegistrarProducto">
            <i class="fa fa-plus-circle"></i> Nuevo Producto
        </button>
    </div>

    <!-- Buscador -->
    <div class="search-container-lista">
        <form action="" method="GET">
            <input type="hidden" name="cod_tienda" value="<?php echo $cod_tienda_param; ?>">
            <div class="search-wrapper">
                <i class="fa fa-search search-icon"></i>
                <input type="search" class="search-input-lista" name="buscar" value="<?php echo htmlspecialchars($buscador); ?>" placeholder="Buscar producto por nombre o código...">
            </div>
        </form>
    </div>

    <!-- Lista de Productos -->
    <div class="productos-lista-container">
        <?php
        // Construir consulta de productos filtrada por tienda
        $sql_productos = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, 
        precio_venta_producto, descripcion_producto, url_img_min_producto, nombre_promocion, cod_estado 
        FROM tbl15_producto WHERE (cod_tienda = '$cod_tienda_param') AND (nombre_estado = 'HABILITADO')";
        // Agregar filtro de búsqueda si existe
        if (!empty($buscador)) { $sql_productos .= " AND (nombre_producto LIKE '%$buscador%' OR cod_producto_barra LIKE '%$buscador%' OR descripcion_producto LIKE '%$buscador%')"; }
        $sql_productos .= " ORDER BY cod_producto DESC";
        
        $consulta_productos = mysqli_query($conectar, $sql_productos);
        
        if (mysqli_num_rows($consulta_productos) > 0) {
            while ($producto = mysqli_fetch_assoc($consulta_productos)) {
                $cod_producto = $producto['cod_producto'];
                $cod_producto_barra = $producto['cod_producto_barra'];
                $nombre_producto = $producto['nombre_producto'];
                $und_producto = $producto['und_producto'];
                $precio_venta = $producto['precio_venta_producto'];
                $descripcion = $producto['descripcion_producto'];
                $url_img = $producto['url_img_min_producto'];
                $nombre_promocion = $producto['nombre_promocion'];
                // Calcular precio con interés (crédito)
                $precio_credito = round($precio_venta / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
                // Imagen por defecto si no existe
                if (empty($url_img)) { $url_img = '../archivador/img_producto/orig/sin_imagen.jpg'; }
                // Determinar estado del stock
                $stock_class = 'stock-disponible';
                $stock_text = 'Disponible';
                if ($und_producto <= 0) { $stock_class = 'stock-agotado'; $stock_text = 'Agotado'; } elseif ($und_producto <= 5) { $stock_class = 'stock-bajo'; $stock_text = 'Últimas unidades'; }
        ?>
        <div class="producto-lista-item" data-cod="<?php echo $cod_producto; ?>" 
             data-nombre="<?php echo htmlspecialchars($nombre_producto); ?>" 
             data-codigo-barra="<?php echo htmlspecialchars($cod_producto_barra); ?>"
             data-descripcion="<?php echo htmlspecialchars($descripcion); ?>"
             data-precio-contado="<?php echo $precio_venta; ?>"
             data-precio-credito="<?php echo $precio_credito; ?>"
             data-stock="<?php echo $und_producto; ?>"
             data-stock-class="<?php echo $stock_class; ?>"
             data-stock-text="<?php echo $stock_text; ?>"
             data-promocion="<?php echo htmlspecialchars($nombre_promocion); ?>"
             data-imagen="<?php echo $url_img; ?>">
            <img src="<?php echo $url_img; ?>" alt="<?php echo $nombre_producto; ?>" class="producto-lista-imagen producto-clickeable" onclick="abrirDetalleProducto(this.parentElement)">
            <div class="producto-lista-info">
                <div>
                    <h3 class="producto-lista-nombre producto-clickeable" onclick="abrirDetalleProducto(this.closest('.producto-lista-item'))">
                        <?php echo ucwords(strtolower($nombre_producto)); ?>
                        <?php if (!empty($nombre_promocion)) { ?>
                            <span class="producto-promocion-badge"><?php echo $nombre_promocion; ?></span>
                        <?php } ?>
                    </h3>
                    <?php if (!empty($cod_producto_barra)) { ?>
                        <p class="producto-lista-codigo">Código: <?php echo $cod_producto_barra; ?></p>
                    <?php } ?>
                    <?php if (!empty($descripcion)) { ?>
                        <p class="producto-lista-descripcion"><?php echo $descripcion; ?></p>
                    <?php } ?>
                </div>
                <div class="producto-lista-footer">
                    <div>
                        <div class="producto-lista-precio">$<?php echo number_format($precio_venta, 0, ",", "."); ?></div>
                        <div class="producto-lista-precio-credito"><i class="fa fa-credit-card"></i> Crédito: $<?php echo number_format($precio_credito, 0, ",", "."); ?></div>
                    </div>
                    <div class="producto-acciones">
                        <span class="producto-lista-stock <?php echo $stock_class; ?>">
                            <i class="fa fa-cube"></i> <?php echo $stock_text; ?>
                        </span>
                        <button type="button" class="btn-editar-producto" data-id="<?php echo $cod_producto; ?>" title="Editar producto">
                            <i class="fa fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
        ?>
        <div class="empty-state-lista">
            <i class="fa fa-box-open"></i>
            <h4>No hay productos disponibles</h4>
            <p><?php echo !empty($buscador) ? 'No se encontraron productos con "' . htmlspecialchars($buscador) . '"' : 'Esta tienda aún no tiene productos registrados.'; ?></p>
        </div>
        <?php } ?>
    </div>
</main>

<?php include_once("../menu/05_modulo_menu_visitante_intern_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

<!-- Modal Detalle Producto -->
<div class="modal fade" id="modalDetalleProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-shopping-bag"></i> Detalle del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body detalle-producto-container">
                <!-- Imagen del Producto -->
                <div class="detalle-producto-imagen-wrapper">
                    <img id="detalle-imagen" src="" alt="Producto" class="detalle-producto-imagen">
                </div>
                
                <!-- Información del Producto -->
                <div class="detalle-producto-info">
                    <h2 id="detalle-nombre" class="detalle-producto-nombre"></h2>
                    <p id="detalle-codigo" class="detalle-producto-codigo">Código: <span></span></p>
                    
                    <!-- Badges -->
                    <div class="detalle-badges-row">
                        <span id="detalle-badge-stock" class="badge-detalle">
                            <i class="fa fa-cube"></i> <span></span>
                        </span>
                        <span id="detalle-badge-promocion" class="badge-detalle badge-promocion" style="display: none;">
                            <i class="fa fa-tag"></i> <span></span>
                        </span>
                    </div>
                    
                    <!-- Precios -->
                    <div class="detalle-precios-card">
                        <div class="detalle-precios-grid">
                            <div class="detalle-precio-item">
                                <div class="detalle-precio-label">Precio Contado</div>
                                <div id="detalle-precio-contado" class="detalle-precio-valor detalle-precio-contado">$0</div>
                            </div>
                            <div class="detalle-precio-item">
                                <div class="detalle-precio-label"><i class="fa fa-credit-card"></i> Precio Crédito</div>
                                <div id="detalle-precio-credito" class="detalle-precio-valor detalle-precio-credito">$0</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Descripción -->
                    <div id="detalle-descripcion-wrapper" class="detalle-descripcion">
                        <div class="detalle-descripcion-titulo">
                            <i class="fa fa-align-left"></i> Descripción
                        </div>
                        <p id="detalle-descripcion" class="detalle-descripcion-texto"></p>
                    </div>
                    
                    <!-- Info Extra -->
                    <div class="detalle-info-extra">
                        <div class="detalle-info-item">
                            <i class="fa fa-cubes"></i>
                            <div class="label">Stock</div>
                            <div id="detalle-stock-cantidad" class="value">0 unidades</div>
                        </div>
                        <div class="detalle-info-item">
                            <i class="fa fa-barcode"></i>
                            <div class="label">Código</div>
                            <div id="detalle-codigo-barra" class="value">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-detalle-cerrar" data-dismiss="modal">Cerrar</button>
                <a id="detalle-btn-simular" href="#" class="btn-detalle-simular">
                    <i class="fa fa-calculator"></i> Simular Crédito
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Producto -->
<div class="modal fade modal-producto" id="modalRegistrarProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle"></i> Registrar Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            // Obtener el próximo código de producto
            $mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra), 20,0) DESC LIMIT 0,1";
            $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
            $matriz_consulta = mysqli_fetch_assoc($consulta);
            $nuevo_cod_producto_barra = isset($matriz_consulta['cod_producto_barra']) ? $matriz_consulta['cod_producto_barra'] + 1 : 1;
            ?>
            <div class="modal-body">
                <div id="result_register"></div>
                <form id="form_registrar_producto" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Código Producto *</label>
                                <input type="text" name="cod_producto_barra" id="reg_cod_producto_barra" value="<?php echo $nuevo_cod_producto_barra; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre Producto *</label>
                                <input type="text" name="nombre_producto" id="reg_nombre_producto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio Compra *</label>
                                <input type="text" name="precio_compra_producto" id="reg_precio_compra_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio Venta (Contado) *</label>
                                <input type="text" name="precio_venta_producto" id="reg_precio_venta_producto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Categoría *</label>
                                <select name="cod_categoria" id="reg_cod_categoria" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    $consulta_cat_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY nombre_categoria ASC";
                                    $consulta_cat = mysqli_query($conectar, $consulta_cat_sql);
                                    while ($datos_cat = mysqli_fetch_assoc($consulta_cat)) {
                                        echo "<option value='" . $datos_cat['cod_categoria'] . "'>" . $datos_cat['nombre_categoria'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IVA *</label>
                                <select name="iva_ptj" id="reg_iva_ptj" class="form-control" required>
                                    <?php
                                    $consulta_iva_sql = "SELECT iva FROM tbl15_tipo_iva WHERE (cod_estado = '1') ORDER BY iva ASC";
                                    $consulta_iva = mysqli_query($conectar, $consulta_iva_sql);
                                    while ($datos_iva = mysqli_fetch_assoc($consulta_iva)) {
                                        $selected = ($datos_iva['iva'] == 0) ? 'selected' : '';
                                        echo "<option value='" . $datos_iva['iva'] . "' $selected>" . $datos_iva['iva'] . "%</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion_producto" id="reg_descripcion_producto" rows="2" class="form-control" placeholder="Descripción del producto..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Imagen Producto</label>
                                <input type="file" name="imagen_producto" id="reg_imagen_producto" accept="image/*" class="form-control">
                                <small class="text-muted">Se guardará versión original y miniatura.</small>
                                <img id="preview_img_reg" src="" class="preview-imagen" style="max-width:150px; margin-top:10px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="cod_estado" id="reg_cod_estado" class="form-control" required>
                                    <?php
                                    $consulta_estado_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
                                    $consulta_estado = mysqli_query($conectar, $consulta_estado_sql);
                                    while ($datos_estado = mysqli_fetch_assoc($consulta_estado)) {
                                        $selected = ($datos_estado['cod_estado'] == 1) ? 'selected' : '';
                                        echo "<option value='" . $datos_estado['cod_estado'] . "' $selected>" . $datos_estado['nombre_estado'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cod_tienda" value="<?php echo $cod_tienda_param; ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-guardar" id="btn_guardar_producto"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Producto -->
<div class="modal fade modal-producto" id="modalEditarProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="result_edit"></div>
                <form id="form_editar_producto" enctype="multipart/form-data">
                    <input type="hidden" name="cod_producto" id="edit_cod_producto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Código Producto *</label>
                                <input type="text" name="cod_producto_barra" id="edit_cod_producto_barra" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre Producto *</label>
                                <input type="text" name="nombre_producto" id="edit_nombre_producto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio Compra *</label>
                                <input type="text" name="precio_compra_producto" id="edit_precio_compra_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio Venta (Contado) *</label>
                                <input type="text" name="precio_venta_producto" id="edit_precio_venta_producto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Categoría *</label>
                                <select name="cod_categoria" id="edit_cod_categoria" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    $consulta_cat_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY nombre_categoria ASC";
                                    $consulta_cat = mysqli_query($conectar, $consulta_cat_sql);
                                    while ($datos_cat = mysqli_fetch_assoc($consulta_cat)) {
                                        echo "<option value='" . $datos_cat['cod_categoria'] . "'>" . $datos_cat['nombre_categoria'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IVA *</label>
                                <select name="iva_ptj" id="edit_iva_ptj" class="form-control" required>
                                    <?php
                                    $consulta_iva_sql = "SELECT iva FROM tbl15_tipo_iva WHERE (cod_estado = '1') ORDER BY iva ASC";
                                    $consulta_iva = mysqli_query($conectar, $consulta_iva_sql);
                                    while ($datos_iva = mysqli_fetch_assoc($consulta_iva)) {
                                        echo "<option value='" . $datos_iva['iva'] . "'>" . $datos_iva['iva'] . "%</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion_producto" id="edit_descripcion_producto" rows="2" class="form-control" placeholder="Descripción del producto..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Imagen Producto (dejar en blanco para mantener)</label>
                                <input type="file" name="imagen_producto" id="edit_imagen_producto" accept="image/*" class="form-control">
                                <small class="text-muted">Se guardará versión original y miniatura.</small>
                                <img id="preview_img_edit" src="" class="preview-imagen" style="max-width:150px; margin-top:10px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="cod_estado" id="edit_cod_estado" class="form-control" required>
                                    <?php
                                    $consulta_estado_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
                                    $consulta_estado = mysqli_query($conectar, $consulta_estado_sql);
                                    while ($datos_estado = mysqli_fetch_assoc($consulta_estado)) {
                                        echo "<option value='" . $datos_estado['cod_estado'] . "'>" . $datos_estado['nombre_estado'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cod_tienda" value="<?php echo $cod_tienda_param; ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-guardar" id="btn_guardar_edicion"><i class="fa fa-save"></i> Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
// Función para abrir modal de detalle de producto
function abrirDetalleProducto(elemento) {
    // Obtener datos del elemento
    var datos = {
        cod: $(elemento).data('cod'),
        nombre: $(elemento).data('nombre'),
        codigoBarra: $(elemento).data('codigo-barra'),
        descripcion: $(elemento).data('descripcion'),
        precioContado: $(elemento).data('precio-contado'),
        precioCredito: $(elemento).data('precio-credito'),
        stock: $(elemento).data('stock'),
        stockClass: $(elemento).data('stock-class'),
        stockText: $(elemento).data('stock-text'),
        promocion: $(elemento).data('promocion'),
        imagen: $(elemento).data('imagen')
    };
    
    // Formatear precios
    function formatPrecio(num) {
        return '$' + parseInt(num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Actualizar modal con datos
    $('#detalle-imagen').attr('src', datos.imagen);
    $('#detalle-nombre').text(datos.nombre);
    $('#detalle-codigo span').text(datos.codigoBarra || '-');
    $('#detalle-codigo-barra').text(datos.codigoBarra || '-');
    $('#detalle-precio-contado').text(formatPrecio(datos.precioContado));
    $('#detalle-precio-credito').text(formatPrecio(datos.precioCredito));
    $('#detalle-stock-cantidad').text(datos.stock + ' unidades');
    
    // Badge de stock
    var $badgeStock = $('#detalle-badge-stock');
    $badgeStock.removeClass('badge-stock-disponible badge-stock-bajo badge-stock-agotado');
    if (datos.stockClass === 'stock-disponible') {
        $badgeStock.addClass('badge-stock-disponible');
    } else if (datos.stockClass === 'stock-bajo') {
        $badgeStock.addClass('badge-stock-bajo');
    } else {
        $badgeStock.addClass('badge-stock-agotado');
    }
    $badgeStock.find('span').text(datos.stockText);
    
    // Badge de promoción
    if (datos.promocion && datos.promocion.trim() !== '') {
        $('#detalle-badge-promocion').show().find('span').text(datos.promocion);
    } else {
        $('#detalle-badge-promocion').hide();
    }
    
    // Descripción (interpretar como HTML)
    if (datos.descripcion && datos.descripcion.trim() !== '') {
        // Decodificar entidades HTML y mostrar como HTML
        var descripcionHtml = $('<textarea/>').html(datos.descripcion).text();
        $('#detalle-descripcion').html(descripcionHtml);
        $('#detalle-descripcion-wrapper').show();
    } else {
        $('#detalle-descripcion-wrapper').hide();
    }
    
    // Enlace para simular crédito (pasar el precio)
    var urlSimular = '../admin/simulador_credito_visitante_intern_interes_max_entidad_crediticia_libre_aliado_movil.php?monto=' + datos.precioContado;
    $('#detalle-btn-simular').attr('href', urlSimular);
    
    // Abrir modal
    $('#modalDetalleProducto').modal('show');
}

$(document).ready(function() {
    // Función para formatear números con separador de miles
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Función para quitar formato de números
    function unformatNumber(str) {
        return String(str || '').replace(/[^0-9\-]/g, '');
    }
    
    // Formateo de precios en tiempo real - Modal Registro
    $('#reg_precio_compra_producto, #reg_precio_venta_producto').on('input', function() {
        var $this = $(this);
        var raw = unformatNumber($this.val());
        $this.data('raw', raw);
        if (raw === '') { $this.val(''); return; }
        $this.val(formatNumber(raw));
    });
    
    // Formateo de precios en tiempo real - Modal Edición
    $('#edit_precio_compra_producto, #edit_precio_venta_producto').on('input', function() {
        var $this = $(this);
        var raw = unformatNumber($this.val());
        $this.data('raw', raw);
        if (raw === '') { $this.val(''); return; }
        $this.val(formatNumber(raw));
    });
    
    // Previsualización de imagen - Registro
    $('#reg_imagen_producto').on('change', function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img_reg').attr('src', e.target.result).css('display', 'block');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_img_reg').css('display', 'none').attr('src', '');
        }
    });
    
    // Previsualización de imagen - Edición
    $('#edit_imagen_producto').on('change', function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img_edit').attr('src', e.target.result).css('display', 'block');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
    
    // Guardar nuevo producto
    $('#btn_guardar_producto').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var form = $('#form_registrar_producto');
        
        // Validación básica
        var nombre = $.trim($('#reg_nombre_producto').val());
        var precio_compra_raw = $('#reg_precio_compra_producto').data('raw') || unformatNumber($('#reg_precio_compra_producto').val());
        var precio_venta_raw = $('#reg_precio_venta_producto').data('raw') || unformatNumber($('#reg_precio_venta_producto').val());
        var cod_categoria = $('#reg_cod_categoria').val();
        
        if (!nombre) {
            $('#result_register').html('<div class="alert alert-danger">El nombre del producto es obligatorio.</div>');
            return;
        }
        
        if (!precio_venta_raw || Number(precio_venta_raw) <= 0) {
            $('#result_register').html('<div class="alert alert-danger">El precio de venta debe ser mayor a 0.</div>');
            return;
        }
        
        if (!cod_categoria) {
            $('#result_register').html('<div class="alert alert-danger">Debe seleccionar una categoría.</div>');
            return;
        }
        
        var formData = new FormData(form[0]);
        formData.set('precio_compra_producto', precio_compra_raw || 0);
        formData.set('precio_venta_producto', precio_venta_raw);
        
        $('#result_register').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Guardando...</div>');
        $btn.prop('disabled', true);
        
        $.ajax({
            type: 'POST',
            url: '../admin/registrar_producto_catalogo_ajax.php',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response && response.success) {
                    $('#result_register').html('<div class="alert alert-success">' + (response.mensaje || 'Producto registrado correctamente.') + '</div>');
                    setTimeout(function() {
                        $('#modalRegistrarProducto').modal('hide');
                        location.reload();
                    }, 1500);
                } else {
                    $('#result_register').html('<div class="alert alert-danger">' + (response.mensaje || 'Error al registrar el producto.') + '</div>');
                }
            },
            error: function() {
                $('#result_register').html('<div class="alert alert-danger">Error en la petición. Intente nuevamente.</div>');
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    });
    
    // Abrir modal de edición
    $(document).on('click', '.btn-editar-producto', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (!id) return;
        
        $('#result_edit').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Cargando datos...</div>');
        
        $.ajax({
            url: '../admin/obtener_producto_catalogo_ajax.php',
            method: 'GET',
            dataType: 'json',
            data: { cod_producto: id },
            success: function(resp) {
                if (resp && resp.success) {
                    var p = resp.producto;
                    $('#edit_cod_producto').val(p.cod_producto);
                    $('#edit_cod_producto_barra').val(p.cod_producto_barra);
                    $('#edit_nombre_producto').val(p.nombre_producto);
                    $('#edit_cod_categoria').val(p.cod_categoria);
                    $('#edit_iva_ptj').val(p.iva_ptj);
                    $('#edit_cod_estado').val(p.cod_estado);
                    $('#edit_descripcion_producto').val(p.descripcion_producto);
                    
                    // Formatear precios
                    var pc = String(p.precio_compra_producto || 0);
                    var pv = String(p.precio_venta_producto || 0);
                    $('#edit_precio_compra_producto').val(formatNumber(pc)).data('raw', pc);
                    $('#edit_precio_venta_producto').val(formatNumber(pv)).data('raw', pv);
                    
                    // Mostrar imagen actual
                    if (p.url_img_min_producto) {
                        $('#preview_img_edit').attr('src', p.url_img_min_producto).css('display', 'block');
                    } else {
                        $('#preview_img_edit').css('display', 'none').attr('src', '');
                    }
                    
                    $('#result_edit').html('');
                    $('#modalEditarProducto').modal('show');
                } else {
                    alert('No se pudo cargar el producto.');
                }
            },
            error: function() {
                alert('Error al cargar el producto.');
            }
        });
    });
    
    // Guardar edición
    $('#btn_guardar_edicion').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var form = $('#form_editar_producto');
        
        var precio_compra_raw = $('#edit_precio_compra_producto').data('raw') || unformatNumber($('#edit_precio_compra_producto').val());
        var precio_venta_raw = $('#edit_precio_venta_producto').data('raw') || unformatNumber($('#edit_precio_venta_producto').val());
        
        var formData = new FormData(form[0]);
        formData.set('precio_compra_producto', precio_compra_raw || 0);
        formData.set('precio_venta_producto', precio_venta_raw);
        
        $('#result_edit').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Guardando...</div>');
        $btn.prop('disabled', true);
        
        $.ajax({
            url: '../admin/editar_producto_catalogo_ajax.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(resp) {
                if (resp && resp.success) {
                    $('#result_edit').html('<div class="alert alert-success">' + (resp.mensaje || 'Producto actualizado correctamente.') + '</div>');
                    setTimeout(function() {
                        $('#modalEditarProducto').modal('hide');
                        location.reload();
                    }, 1500);
                } else {
                    $('#result_edit').html('<div class="alert alert-danger">' + (resp.mensaje || 'Error al actualizar el producto.') + '</div>');
                }
            },
            error: function() {
                $('#result_edit').html('<div class="alert alert-danger">Error en la petición.</div>');
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    });
    
    // Limpiar modal al cerrar
    $('#modalRegistrarProducto').on('hidden.bs.modal', function() {
        $('#form_registrar_producto')[0].reset();
        $('#preview_img_reg').css('display', 'none').attr('src', '');
        $('#result_register').html('');
        $('#reg_precio_compra_producto, #reg_precio_venta_producto').data('raw', '');
    });
    
    $('#modalEditarProducto').on('hidden.bs.modal', function() {
        $('#form_editar_producto')[0].reset();
        $('#preview_img_edit').css('display', 'none').attr('src', '');
        $('#result_edit').html('');
    });
});
</script>

</body>
</html>
