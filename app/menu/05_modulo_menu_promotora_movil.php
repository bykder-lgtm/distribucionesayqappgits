<?php
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
.menu-item-modern .custom-icon-menu { color: #ffffff !important; }
.menu-item-modern .menu-label { color: #ffffff !important; }
.menu-item-modern.active .icon-container-menu { background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(65, 105, 225, 0.3) 100%); border-radius: 12px; transform: scale(1.05); }
.menu-item-modern.active .custom-icon-menu { color: #00d4ff !important; text-shadow: 0 0 10px rgba(0, 212, 255, 0.5); }
.menu-item-modern.active .menu-label { color: #00d4ff !important; font-weight: 700; }
</style>
<nav class="btn_menu_navegacion_movil_enrollment d-flex justify-content-around">
    <a href="../admin/dashboard_promotora_movil.php" class="menu-item-modern <?php echo esMenuActivo('dashboard_promotora_movil'); ?>">
      <div class="icon-container-menu"><i class="fa fa-bar-chart custom-icon-menu"></i><span class="menu-label">Dashboard</span></div>
    </a>
    <a href="../admin/lista_aliado_promotora_movil.php" class="menu-item-modern <?php echo esMenuActivo('lista_aliado_promotora_movil'); ?>">
      <div class="icon-container-menu"><i class="fa fa-handshake-o custom-icon-menu"></i><span class="menu-label">Mi Aliado</span></div>
    </a>
    <a href="../session/salir_visitante_intern.php" class="menu-item-modern">
      <div class="icon-container-menu"><i class="fa fa-sign-out custom-icon-menu"></i><span class="menu-label">Salir</span></div>
    </a>
</nav>
