<?php
/**
 * app/admin/administrativo/configuracion.php
 * Módulo de Configuración - Ajustes del sistema
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$dayq_page_title = 'Configuración';
include __DIR__ . '/layout_header.php';
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-gear"></i> Configuración</h1>
  </div>

  <!-- TABS -->
  <div class="dayq-section" style="padding: 0; border: none;">
    <div class="dayq-tabs">
      <button class="dayq-tab-btn active" onclick="cambiarTab('general')">General</button>
      <button class="dayq-tab-btn" onclick="cambiarTab('margenes')">Márgenes</button>
      <button class="dayq-tab-btn" onclick="cambiarTab('usuarios')">Usuarios</button>
      <button class="dayq-tab-btn" onclick="cambiarTab('logs')">Logs</button>
    </div>
  </div>

  <!-- TAB: GENERAL -->
  <div class="dayq-tab-content active">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Configuración General del Sistema</h3>
      <div class="dayq-grid-2">
        <div>
          <label style="display: block; font-size: 11px; font-weight: 600; color: var(--text3); margin-bottom: 6px; text-transform: uppercase;">
            Nombre de Empresa
          </label>
          <input type="text" value="Distribuciones & Acuerdos YQ" readonly style="width: 100%; padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; font-weight: 600; color: var(--text3); margin-bottom: 6px; text-transform: uppercase;">
            Versión Sistema
          </label>
          <input type="text" value="DayQ v2.0 - Phase 2" readonly style="width: 100%; padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        </div>
      </div>
      <div style="margin-top: 12px;">
        <label style="display: block; font-size: 11px; font-weight: 600; color: var(--text3); margin-bottom: 6px; text-transform: uppercase;">
          Último Backup
        </label>
        <input type="text" value="<?php echo date('d/m/Y H:i:s'); ?>" readonly style="width: 100%; padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      </div>
    </div>
  </div>

  <!-- TAB: MÁRGENES -->
  <div class="dayq-tab-content">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Configuración de Márgenes Financieros</h3>
      <table style="width: 100%; font-size: 12px;">
        <tr style="border-bottom: 1px solid var(--border);">
          <td style="padding: 12px; font-weight: 600; width: 40%; color: var(--text3);">Margen Mínimo Requerido (%)</td>
          <td style="padding: 12px;">
            <input type="number" value="15" step="0.1" style="width: 80px; padding: 6px; background: var(--bg); border: 1px solid var(--border); border-radius: 4px; color: var(--text); font-size: 12px;">
          </td>
        </tr>
        <tr style="border-bottom: 1px solid var(--border);">
          <td style="padding: 12px; font-weight: 600; color: var(--text3);">Comisión Habilitador (% de valor)</td>
          <td style="padding: 12px;">
            <input type="number" value="30" step="0.1" style="width: 80px; padding: 6px; background: var(--bg); border: 1px solid var(--border); border-radius: 4px; color: var(--text); font-size: 12px;">
          </td>
        </tr>
        <tr style="border-bottom: 1px solid var(--border);">
          <td style="padding: 12px; font-weight: 600; color: var(--text3);">Distribución a Habilitador (%)</td>
          <td style="padding: 12px;">
            <input type="number" value="70" step="0.1" style="width: 80px; padding: 6px; background: var(--bg); border: 1px solid var(--border); border-radius: 4px; color: var(--text); font-size: 12px;">
          </td>
        </tr>
        <tr>
          <td style="padding: 12px; font-weight: 600; color: var(--text3);">Penalidad por Anulación (%)</td>
          <td style="padding: 12px;">
            <input type="number" value="5" step="0.1" style="width: 80px; padding: 6px; background: var(--bg); border: 1px solid var(--border); border-radius: 4px; color: var(--text); font-size: 12px;">
          </td>
        </tr>
      </table>
      <div style="margin-top: 12px;">
        <button class="dayq-btn dayq-btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>

  <!-- TAB: USUARIOS -->
  <div class="dayq-tab-content">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Usuarios del Sistema</h3>
      <table class="dayq-table">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Último Acceso</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>admin@dayq.com</td>
            <td>Administrador</td>
            <td><span class="badge badge-info">Admin</span></td>
            <td><span class="badge badge-success">Activo</span></td>
            <td><?php echo date('d/m/Y H:i'); ?></td>
          </tr>
          <tr>
            <td>revisor@dayq.com</td>
            <td>Revisor Créditos</td>
            <td><span class="badge badge-info">Revisor</span></td>
            <td><span class="badge badge-success">Activo</span></td>
            <td><?php echo date('d/m/Y', strtotime('-2 days')) . ' 14:30'; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- TAB: LOGS -->
  <div class="dayq-tab-content">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Registro de Actividad</h3>
      <table class="dayq-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Acción</th>
            <th>Detalles</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo date('d/m/Y H:i:s'); ?></td>
            <td>admin@dayq.com</td>
            <td><span class="badge badge-info">Acceso</span></td>
            <td>Ingreso al Dashboard</td>
          </tr>
          <tr>
            <td><?php echo date('d/m/Y H:i:s', strtotime('-5 minutes')); ?></td>
            <td>revisor@dayq.com</td>
            <td><span class="badge badge-success">Aprobación</span></td>
            <td>Crédito #12345 aprobado</td>
          </tr>
          <tr>
            <td><?php echo date('d/m/Y H:i:s', strtotime('-1 hour')); ?></td>
            <td>admin@dayq.com</td>
            <td><span class="badge badge-warning">Modificación</span></td>
            <td>Configuración de márgenes actualizada</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function cambiarTab(nombre) {
  document.querySelectorAll('.dayq-tab-content').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('.dayq-tab-btn').forEach(el => el.classList.remove('active'));
  
  const tabIndex = Array.from(document.querySelectorAll('.dayq-tab-btn')).findIndex(el => {
    return el.getAttribute('onclick').includes(nombre);
  });
  
  if (tabIndex >= 0) {
    document.querySelectorAll('.dayq-tab-content')[tabIndex].classList.add('active');
    document.querySelectorAll('.dayq-tab-btn')[tabIndex].classList.add('active');
  }
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
