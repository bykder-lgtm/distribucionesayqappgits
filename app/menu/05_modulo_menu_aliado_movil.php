<?php
// Detectar página actual para resaltar menú activo
$pagina_actual = basename($_SERVER['PHP_SELF']);
function esMenuActivo($paginas) {
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

/* Estilos cuando el item está activo */
.menu-item-modern.active .icon-container-menu {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(65, 105, 225, 0.3) 100%);
    border-radius: 12px;
    transform: scale(1.05);
}
.menu-item-modern.active .custom-icon-menu {
    color: #00d4ff !important;
    text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
}
.menu-item-modern.active .menu-label {
    color: #00d4ff !important;
    font-weight: 700;
}
</style>
  <!-- Menú inferior -->
  <nav class="btn_menu_navegacion_movil_enrollment d-flex justify-content-around">
    
    <a href="../admin/dashboard_aliado_movil.php" id="dashboard_aliado" class="menu-item-modern <?php echo esMenuActivo('dashboard_aliado'); ?>">
      <div class="icon-container-menu"><i class="fa fa-bar-chart custom-icon-menu"></i><span class="menu-label">Inicio</span></div>
    </a>

    <a href="../admin/simulador_credito_aliado_movil_libre.php" id="simulador_credito" class="menu-item-modern <?php echo esMenuActivo('simulador_credito'); ?>">
      <div class="icon-container-menu"><i class="fa fa-calculator custom-icon-menu"></i><span class="menu-label">Simular</span></div>
    </a>
<!--
    <a href="#" id="registrar_cliente" onclick="obtener_datos_tercero_factura_venta_modal();" data-toggle="modal" data-target=".abrir_registrar_datos_tercero_factura_venta_movil_aliado_estrategico" class="menu-item-modern">
      <div class="icon-container-menu"><i class="fa fa-user-plus custom-icon-menu"></i><span class="menu-label">Reg Cliente</span></div>
    </a>

    <a href="../admin/lista_catalogo_productos_aliado_movil.php" id="lista_catalogo" class="menu-item-modern <?php echo esMenuActivo(['lista_catalogo', 'catalogo_producto']); ?>">
      <div class="icon-container-menu"><i class="fa fa-th-large custom-icon-menu"></i><span class="menu-label">Catálogo</span></div>
    </a>
-->
    <a href="../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php" id="lista_creditos" class="menu-item-modern <?php echo esMenuActivo(['lista_info_factura', 'factura_venta_siscredito']); ?>">
      <div class="icon-container-menu"><i class="fa fa-credit-card custom-icon-menu"></i><span class="menu-label">Creditos</span></div>
    </a>
<!--
    <a href="../admin/lista_comprobantes_pago_siscredito_visitante_intern_aliado_movil.php" id="lista_comprobantes" class="menu-item-modern <?php echo esMenuActivo('lista_comprobantes_pago'); ?>">
      <div class="icon-container-menu"><i class="fa fa-file-image-o custom-icon-menu"></i><span class="menu-label">Comprobantes</span></div>
    </a>
-->
    <a href="../admin/lista_tiendas_aliado_movil.php" id="lista_tiendas" class="menu-item-modern <?php echo esMenuActivo('lista_tiendas'); ?>">
      <div class="icon-container-menu"><i class="fa fa-shopping-bag custom-icon-menu"></i><span class="menu-label">Tienda</span></div>
    </a>

    <a href="../admin/lista_consultas_siscredito_visitante_intern_aliado_movil.php" id="lista_consultas" class="menu-item-modern <?php echo esMenuActivo('lista_consultas'); ?>">
      <div class="icon-container-menu"><i class="fa fa-search custom-icon-menu"></i><span class="menu-label">Consultas</span></div>
    </a>

    <a href="../admin/perfil_aliado_movil.php" id="perfil_aliado" class="menu-item-modern <?php echo esMenuActivo('perfil_aliado'); ?>">
      <div class="icon-container-menu"><i class="fa fa-user custom-icon-menu"></i><span class="menu-label">Perfil</span></div>
    </a>
<!--
    <a href="../admin/config_aliado_movil.php" id="config" class="menu-item-modern <?php echo esMenuActivo('config_aliado'); ?>">
      <div class="icon-container-menu"><i class="fa fa-cog custom-icon-menu"></i><span class="menu-label">Config</span></div>
    </a>
-->
    <a href="../session/salir_visitante_intern.php?token=<?php echo $token ?>" id="salir" class="menu-item-modern">
      <div class="icon-container-menu"><i class="fa fa-sign-out custom-icon-menu"></i><span class="menu-label">Salir</span></div>
    </a>

  </nav><?php include_once("../admin/notificaciones_aliado_movil_inc.php"); ?>
