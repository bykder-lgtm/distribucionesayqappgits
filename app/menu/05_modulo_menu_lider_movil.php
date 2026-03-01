<?php
// Detectar la página actual para resaltar el menú activo
$pagina_actual = basename($_SERVER['PHP_SELF']);

// Definir las páginas asociadas a cada ítem del menú
$menu_inicio         = ['dashboard_lider_movil.php'];
$menu_creditos       = ['lista_info_factura_venta_lider_movil.php'];
$menu_coordinadores  = ['lista_coordinador_lider_movil.php'];
$menu_asesores       = ['lista_asesor_lider_movil.php'];
$menu_aliados        = ['lista_aliado_lider_movil.php', 'lista_aliado_asesor_lider_movil.php'];
$menu_tiendas        = ['lista_tienda_lider_movil.php', 'lista_producto_lider_movil.php'];
$menu_consultas      = ['lista_consultas_lider_movil.php'];
$menu_config         = ['config_lider_movil.php', 'parametrizacion_cuota_entidad_crediticia_lider_movil.php'];
?>
<!-- Bottom Navigation -->
<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <a href="../admin/dashboard_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_inicio) ? 'active' : ''; ?>"><i class="fa-solid fa-house"></i><span>Inicio</span></a>
    <a href="../admin/lista_info_factura_venta_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_creditos) ? 'active' : ''; ?>"><i class="fa-solid fa-credit-card"></i><span>Créditos</span></a>
    <a href="../admin/lista_coordinador_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_coordinadores) ? 'active' : ''; ?>"><i class="fa-solid fa-users-gear"></i><span>Coord.</span></a>
    <a href="../admin/lista_asesor_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_asesores) ? 'active' : ''; ?>"><i class="fa-solid fa-user-tie"></i><span>Asesores</span></a>
    <a href="../admin/lista_aliado_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_aliados) ? 'active' : ''; ?>"><i class="fa-solid fa-handshake"></i><span>Aliados</span></a>
    <a href="../admin/lista_tienda_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_tiendas) ? 'active' : ''; ?>"><i class="fa-solid fa-store"></i><span>Tiendas</span></a>
    <a href="../admin/config_lider_movil.php" class="nav-item <?php echo in_array($pagina_actual, $menu_config) ? 'active' : ''; ?>"><i class="fa-solid fa-gear"></i><span>Config</span></a>
</nav>

<style>
/* Estilos sobrescritos para asegurar que quepa en móviles */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-top: 1px solid rgba(139, 92, 246, 0.2);
    display: flex;
    justify-content: space-between; /* Mejor distribución */
    padding: 0.5rem 0.25rem;
    z-index: 1000;
    backdrop-filter: blur(20px);
    overflow-x: auto; /* Permitir scroll si es muy muy pequeño */
}

.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: rgba(255,255,255,0.5);
    transition: all 0.3s ease;
    padding: 0.4rem 0.25rem; /* Reducir padding horizontal */
    border-radius: 12px;
    flex: 1; /* Distribuir espacio equitativamente */
    min-width: 50px; /* Ancho mínimo para toque */
}

.nav-item:hover, .nav-item.active {
    color: #8b5cf6;
    text-decoration: none;
    background: rgba(139, 92, 246, 0.05);
}

.nav-item.active {
    background: rgba(139, 92, 246, 0.1);
}

.nav-item i {
    font-size: 1.1rem; /* Icono ligeramente más pequeño */
    margin-bottom: 0.2rem;
}

.nav-item span {
    font-size: 0.55rem; /* Texto más pequeño */
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    white-space: nowrap; /* Evitar salto de línea */
}

/* Ajuste específico para pantallas muy pequeñas */
@media (max-width: 360px) {
    .nav-item i { font-size: 1rem; }
    .nav-item span { font-size: 0.5rem; display: none; } /* Ocultar texto en pantallas mini si se desea, o dejarlo */
    .nav-item.active span { display: block; } /* Mostrar solo el activo o ajustar */
    .nav-item span { display: block; transform: scale(0.9); }
}
</style>