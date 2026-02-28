<?php
// Detectar página actual para resaltar menú activo
$pagina_actual = basename($_SERVER['PHP_SELF']);
function esMenuActivoVendedor($paginas) {
    global $pagina_actual;
    if (is_array($paginas)) {
        foreach ($paginas as $pag) {
            if (strpos($pagina_actual, $pag) !== false) return 'active';
        }
    } else {
        if (strpos($pagina_actual, $paginas) !== false) return 'active';
    }
    return '';
}
?>
<style>
/* Iconos y labels blancos por defecto */
.menu-item-modern .custom-icon-menu {
    color: #ffffff !important;
}
.menu-item-modern .menu-label {
    color: #ffffff !important;
}

/* Estilos cuando el item está activo - Vendedor: naranja/amber */
.menu-item-modern.active .icon-container-menu {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.3) 0%, rgba(217, 119, 6, 0.3) 100%);
    border-radius: 12px;
    transform: scale(1.05);
}
.menu-item-modern.active .custom-icon-menu {
    color: #f59e0b !important;
    text-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
}
.menu-item-modern.active .menu-label {
    color: #f59e0b !important;
    font-weight: 700;
}
</style>
  <!-- Menú inferior Vendedor -->
  <nav class="btn_menu_navegacion_movil_enrollment d-flex justify-content-around">
    
    <a href="../admin/dashboard_vendedor_movil.php" id="dashboard_vendedor" class="menu-item-modern <?php echo esMenuActivoVendedor('dashboard_vendedor'); ?>">
      <div class="icon-container-menu"><i class="fa fa-bar-chart custom-icon-menu"></i><span class="menu-label">Inicio</span></div>
    </a>

    <a href="../admin/lista_catalogo_tienda_productos_vendedor_movil.php" id="catalogo_vendedor" class="menu-item-modern <?php echo esMenuActivoVendedor('catalogo_tienda_productos_vendedor'); ?>">
      <div class="icon-container-menu"><i class="fa fa-shopping-bag custom-icon-menu"></i><span class="menu-label">Catálogo</span></div>
    </a>

    <a href="../admin/simulador_credito_vendedor_movil_libre.php" id="simulador_vendedor" class="menu-item-modern <?php echo esMenuActivoVendedor('simulador_credito_vendedor'); ?>">
      <div class="icon-container-menu"><i class="fa fa-calculator custom-icon-menu"></i><span class="menu-label">Simular</span></div>
    </a>

    <a href="../admin/lista_info_factura_venta_siscredito_visitante_intern_vendedor_movil.php" id="lista_creditos_vendedor" class="menu-item-modern <?php echo esMenuActivoVendedor(['lista_info_factura_venta_siscredito_visitante_intern_vendedor', 'lista_info_factura_venta_abierta_siscredito_visitante_intern_vendedor', 'lista_info_factura_venta_cerrada_siscredito_visitante_intern_vendedor', 'lista_comprobantes_pago_siscredito_visitante_intern_vendedor']); ?>">
      <div class="icon-container-menu"><i class="fa fa-credit-card custom-icon-menu"></i><span class="menu-label">Créditos</span></div>
    </a>

    <a href="../admin/lista_consultas_siscredito_visitante_intern_vendedor_movil.php" id="consultas_vendedor" class="menu-item-modern <?php echo esMenuActivoVendedor('consultas_siscredito_visitante_intern_vendedor'); ?>">
      <div class="icon-container-menu"><i class="fa fa-search custom-icon-menu"></i><span class="menu-label">Consultas</span></div>
    </a>

    <a href="../session/salir_visitante_intern.php?token=<?php echo $token ?>" id="salir" class="menu-item-modern">
      <div class="icon-container-menu"><i class="fa fa-sign-out custom-icon-menu"></i><span class="menu-label">Salir</span></div>
    </a>

  </nav>
