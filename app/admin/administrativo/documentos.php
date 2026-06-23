<?php
/**
 * app/admin/administrativo/documentos.php
 * Documentos - Gestión de archivos
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$dayq_page_title = 'Documentos';
include __DIR__ . '/layout_header.php';
?>
<div class="module-topbar">
  <div class="module-topbar-title">📁 Documentos</div>
  <div class="module-topbar-actions">
    <button class="btn btn-primary" style="padding:6px 12px;font-size:11px;">+ Subir</button>
  </div>
</div>
<div class="module-page">
  <div class="card">
    <div class="card-title">Documentos Recientes</div>
    <p style="color:var(--text3);padding:20px;text-align:center;font-size:12px;">Módulo en construcción — próximamente</p>
  </div>
</div>
<?php include __DIR__ . '/layout_footer.php'; ?>
