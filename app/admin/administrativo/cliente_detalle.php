<?php
/**
 * app/admin/administrativo/cliente_detalle.php
 * Detalle de Cliente - Información del cliente y sus créditos
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$cod_cliente = dayq_get_int('id', 0);
if ($cod_cliente <= 0) {
    header('Location: ?m=clientes');
    exit;
}

$db_service = new DayqDbService($conectar);

$cliente = $db_service->getClienteDetalle($cod_cliente);
if (!$cliente) {
    echo 'Cliente no encontrado';
    exit;
}

$dayq_page_title = 'Detalle de Cliente: ' . $cliente['nombre'];
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$creditos_data = $db_service->getCreditosPorCliente($cod_cliente, $pagina, 15);
$creditos = $creditos_data['items'];
$total_paginas = $creditos_data['total_paginas'];
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title">
      <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($cliente['nombre']); ?>
    </h1>
    <a href="?m=clientes" class="dayq-btn"><i class="fa-solid fa-arrow-left"></i> Volver a Clientes</a>
  </div>

  <!-- INFO DEL CLIENTE -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Información del Cliente</h3>
    <div class="dayq-grid-3">
      <div style="font-size: 12px;">
        <p><strong>Identificación:</strong> <?php echo htmlspecialchars(isset($cliente['identificacion']) ? $cliente['identificacion'] : '-'); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars(isset($cliente['telefono']) ? $cliente['telefono'] : '-'); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars(isset($cliente['email']) ? $cliente['email'] : '-'); ?></p>
      </div>
      <div style="font-size: 12px;">
        <p><strong>Total Créditos:</strong> <?php echo isset($cliente['total_creditos']) ? $cliente['total_creditos'] : 0; ?></p>
        <p><strong>Valor Total:</strong> <span style="color: var(--accent); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cliente['valor_total']) ? $cliente['valor_total'] : 0); ?></span></p>
        <p><strong>Saldo Deuda:</strong> <span style="color: var(--yellow); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cliente['monto_deuda']) ? $cliente['monto_deuda'] : 0); ?></span></p>
      </div>
    </div>
  </div>

  <!-- CRÉDITOS DEL CLIENTE -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Créditos Asociados</h3>

    <?php if (count($creditos) > 0): ?>
    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Comercio</th>
          <th>Línea</th>
          <th>Valor</th>
          <th>Abonado</th>
          <th>Saldo</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($creditos as $cred): ?>
        <tr>
          <td>#<?php echo $cred['cod_factura']; ?></td>
          <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
          <td><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></td>
          <td>$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></td>
          <td>$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
          <td><strong>$<?php echo dayq_formato_moneda((isset($cred['valor']) ? $cred['valor'] : 0) - (isset($cred['abonado']) ? $cred['abonado'] : 0)); ?></strong></td>
          <td><span class="badge <?php echo dayq_get_estado_clase($cred['nombre_estado_factura']); ?>">
            <?php echo dayq_get_estado_texto($cred['nombre_estado_factura']); ?>
          </span></td>
          <td>
            <a href="?m=credito_detalle&id=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn">Ver</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
    <div class="dayq-pagination">
      <?php if ($pagina > 1): ?>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=1">&laquo;</a>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
      <?php endif; ?>
      <?php $inicio = max(1, $pagina - 2); $fin = min($total_paginas, $pagina + 2); ?>
      <?php for ($i = $inicio; $i <= $fin; $i++): ?>
        <?php if ($i === $pagina): ?>
          <span class="active"><?php echo $i; ?></span>
        <?php else: ?>
          <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($pagina < $total_paginas): ?>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $total_paginas; ?>">&raquo;</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <p style="color: var(--text3); text-align: center; padding: 20px;">Este cliente no tiene créditos registrados</p>
    <?php endif; ?>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>
