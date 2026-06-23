<?php
/**
 * app/admin/administrativo/prestamos.php
 * Préstamos Empleados
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$dayq_page_title = 'Préstamos Empleados';
include __DIR__ . '/layout_header.php';
?>
<div class="module-topbar">
  <div class="module-topbar-title">🎯 Préstamos Empleados</div>

</div>
<div class="module-page">
  <div class="kpi-grid" style="grid-template-columns:repeat(3,1fr);">
    <div class="kpi-card"><div class="kpi-label">Préstamos activos</div><div class="kpi-value" style="color:var(--accent);">0</div><div class="kpi-sub">Sin registros</div></div>
    <div class="kpi-card"><div class="kpi-label">Saldo total</div><div class="kpi-value" style="color:var(--yellow);">$0</div><div class="kpi-sub">Sin registros</div></div>
    <div class="kpi-card"><div class="kpi-label">Cuotas este mes</div><div class="kpi-value" style="color:var(--green);">$0</div><div class="kpi-sub">Sin registros</div></div>
  </div>
  <div class="card mt">
    <div class="card-title">Préstamos Activos</div>
    <p style="color:var(--text3);padding:20px;text-align:center;font-size:12px;">Módulo en construcción — próximamente</p>
  </div>
</div>
<?php include __DIR__ . '/layout_footer.php'; ?>
