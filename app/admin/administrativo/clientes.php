<?php
/**
 * app/admin/administrativo/clientes.php
 * Módulo de Clientes - Gestión de terceros
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Clientes';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-users"></i> Clientes</h1>
    <div class="dayq-topbar-actions">
      <div class="dayq-topbar-filter">
        <input type="text" id="buscar" placeholder="Buscar cliente (nombre, ID)..." value="<?php echo htmlspecialchars($buscar); ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        <button class="dayq-btn dayq-btn-primary" onclick="buscarClientes()">Buscar</button>
      </div>
    </div>
  </div>

  <!-- TABLA DE CLIENTES -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Listado de Clientes</h3>
    <?php
    $total_registros = $db_service->getClientesTotal($buscar);
    $por_pagina = 15;
    $total_paginas = ceil($total_registros / $por_pagina);
    $clientes = $db_service->getClientesPaginados($pagina, $por_pagina, $buscar);
    ?>

    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Identificación</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Créditos Activos</th>
          <th>Valor Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($clientes) > 0): ?>
          <?php foreach ($clientes as $cliente): ?>
            <tr>
              <td><strong><?php echo htmlspecialchars($cliente['nombres_apellidos_tercero']); ?></strong></td>
              <td><?php echo htmlspecialchars(isset($cliente['identificacion_tercero']) ? $cliente['identificacion_tercero'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cliente['telefono1_tercero']) ? $cliente['telefono1_tercero'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cliente['correo_tercero']) ? $cliente['correo_tercero'] : '-'); ?></td>
              <td style="text-align: center; font-weight: 600;"><?php echo isset($cliente['total_creditos']) ? $cliente['total_creditos'] : 0; ?></td>
              <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($cliente['valor_total']) ? $cliente['valor_total'] : 0); ?></td>
              <td>
                <a href="?m=cliente_detalle&id=<?php echo $cliente['cod_tercero']; ?>" class="dayq-btn">Ver Detalle</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 20px; color: var(--text3);">
              No hay clientes registrados
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=clientes&page=1">&laquo;</a>
          <a href="?m=clientes&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=clientes&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=clientes&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
          <a href="?m=clientes&page=<?php echo $total_paginas; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function buscarClientes() {
  const buscar = document.getElementById('buscar').value;
  window.location.href = '?m=clientes&buscar=' + encodeURIComponent(buscar);
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
