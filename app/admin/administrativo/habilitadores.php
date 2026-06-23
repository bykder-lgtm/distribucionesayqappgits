<?php
/**
 * app/admin/administrativo/habilitadores.php
 * Módulo de Habilitadores - Gestión de líneas de crédito
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Habilitadores / Líneas de Crédito';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-handshake"></i> Habilitadores / Líneas de Crédito</h1>
    <div class="dayq-topbar-actions">
      <div class="dayq-topbar-filter">
        <input type="text" id="buscar" placeholder="Buscar línea..." value="<?php echo htmlspecialchars($buscar); ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        <button class="dayq-btn dayq-btn-primary" onclick="buscarHabilitadores()">Buscar</button>
      </div>
    </div>
  </div>

  <!-- TABLA DE HABILITADORES -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Entidades de Crédito Activas</h3>
    <?php
    $total_registros = $db_service->getHabilitadoresTotal($buscar);
    $por_pagina = 15;
    $total_paginas = ceil($total_registros / $por_pagina);
    $habilitadores = $db_service->getHabilitadoresPaginados($pagina, $por_pagina, $buscar);
    ?>

    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>NIT</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Créditos</th>
          <th>Valor Total</th>
          <th>Comisión (%)</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($habilitadores) > 0): ?>
          <?php foreach ($habilitadores as $hab): ?>
            <tr>
              <td><strong><?php echo htmlspecialchars($hab['nombre_entidad_crediticia']); ?></strong></td>
              <td><?php echo htmlspecialchars(isset($hab['nit_entidad']) ? $hab['nit_entidad'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($hab['nombre_contacto']) ? $hab['nombre_contacto'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($hab['telefono_entidad']) ? $hab['telefono_entidad'] : '-'); ?></td>
              <td style="text-align: center; font-weight: 600;"><?php echo isset($hab['total_creditos']) ? $hab['total_creditos'] : 0; ?></td>
              <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($hab['valor_total']) ? $hab['valor_total'] : 0); ?></td>
              <td style="text-align: center; font-weight: 600;"><?php echo dayq_formato_porcentaje(isset($hab['comision_ptj']) ? $hab['comision_ptj'] : 0); ?></td>
              <td>
                <a href="?m=habilitador_detalle&id=<?php echo $hab['cod_entidad_crediticia']; ?>" class="dayq-btn">Ver Detalle</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" style="text-align: center; padding: 20px; color: var(--text3);">
              No hay habilitadores registrados
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=habilitadores&page=1">&laquo;</a>
          <a href="?m=habilitadores&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=habilitadores&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=habilitadores&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
          <a href="?m=habilitadores&page=<?php echo $total_paginas; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function buscarHabilitadores() {
  const buscar = document.getElementById('buscar').value;
  window.location.href = '?m=habilitadores&buscar=' + encodeURIComponent(buscar);
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
