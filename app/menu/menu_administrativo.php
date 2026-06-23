<?php
/**
 * menu_administrativo.php - Sidebar de navegación administrativa
 * Basado en diseño Flexitech Dashboard
 */
$base = 'modulo.php';
$current = isset($_GET['m']) ? preg_replace('/[^a-z_]/', '', $_GET['m']) : 'dashboard';
function dayq_menu_active($mod, $current) {
    return $mod === $current ? ' active' : '';
}
?>
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="../../imagenes/logo_admin.png" alt="Portal administrativo">
  </div>
  <nav class="sidebar-nav">
    <a class="nav-item<?php echo dayq_menu_active('dashboard', $current); ?>" href="<?php echo $base; ?>?m=dashboard">
      <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span> <span>Dashboard</span>
    </a>
    <a class="nav-item<?php echo (dayq_menu_active('creditos_lista', $current) || dayq_menu_active('credito_detalle', $current)) ? ' active' : ''; ?>" href="<?php echo $base; ?>?m=creditos_lista">
      <span class="nav-icon"><i class="fa-solid fa-credit-card"></i></span> <span>Créditos</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('liquidaciones', $current); ?>" href="<?php echo $base; ?>?m=liquidaciones">
      <span class="nav-icon"><i class="fa-solid fa-file-invoice-dollar"></i></span> <span>Liquidaciones</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('comercios', $current); ?>" href="<?php echo $base; ?>?m=comercios">
      <span class="nav-icon"><i class="fa-solid fa-store"></i></span> <span>Comercios</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('clientes', $current); ?>" href="<?php echo $base; ?>?m=clientes">
      <span class="nav-icon"><i class="fa-solid fa-users"></i></span> <span>Clientes</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('habilitadores', $current); ?>" href="<?php echo $base; ?>?m=habilitadores">
      <span class="nav-icon"><i class="fa-solid fa-handshake"></i></span> <span>Habilitadores</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('anulaciones', $current); ?>" href="<?php echo $base; ?>?m=anulaciones">
      <span class="nav-icon"><i class="fa-solid fa-ban"></i></span> <span>Anulaciones</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('pagos_comercios', $current); ?>" href="<?php echo $base; ?>?m=pagos_comercios">
      <span class="nav-icon"><i class="fa-solid fa-money-bill-transfer"></i></span> <span>Pagos Comercios</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('pagos_habilitadores', $current); ?>" href="<?php echo $base; ?>?m=pagos_habilitadores">
      <span class="nav-icon"><i class="fa-solid fa-building-columns"></i></span> <span>Pagos Habilitadores</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('gastos', $current); ?>" href="<?php echo $base; ?>?m=gastos">
      <span class="nav-icon"><i class="fa-solid fa-file-invoice-dollar"></i></span> <span>Gastos</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('prestamos', $current); ?>" href="<?php echo $base; ?>?m=prestamos">
      <span class="nav-icon"><i class="fa-solid fa-hand-holding-dollar"></i></span> <span>Préstamos Empleados</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('tesoreria', $current); ?>" href="<?php echo $base; ?>?m=tesoreria">
      <span class="nav-icon"><i class="fa-solid fa-coins"></i></span> <span>Tesorería</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('reportes', $current); ?>" href="<?php echo $base; ?>?m=reportes">
      <span class="nav-icon"><i class="fa-solid fa-chart-bar"></i></span> <span>Reportes</span> <span class="nav-arrow">›</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('documentos', $current); ?>" href="<?php echo $base; ?>?m=documentos">
      <span class="nav-icon"><i class="fa-solid fa-folder-open"></i></span> <span>Documentos</span>
    </a>
    <a class="nav-item<?php echo dayq_menu_active('configuracion', $current); ?>" href="<?php echo $base; ?>?m=configuracion">
      <span class="nav-icon"><i class="fa-solid fa-gear"></i></span> <span>Configuración</span>
    </a>
  </nav>
  <div class="sidebar-logout">
    <a class="nav-item" href="../../session/salir_administrativo.php">
      <span class="nav-icon"><i class="fa-solid fa-right-from-bracket"></i></span> <span>Cerrar sesión</span>
    </a>
  </div>
</aside>
