<?php
/**
 * app/admin/administrativo/habilitador_detalle.php
 * Detalle de Habilitador - Información de la entidad crediticia y sus créditos
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$cod_habilitador = dayq_get_int('id', 0);
if ($cod_habilitador <= 0) {
    header('Location: ?m=habilitadores');
    exit;
}

$db_service = new DayqDbService($conectar);

$habilitador = $db_service->getHabilitadorDetalle($cod_habilitador);
if (!$habilitador) {
    echo 'Habilitador no encontrado';
    exit;
}

$dayq_page_title = 'Detalle de Habilitador: ' . $habilitador['nombre_entidad_crediticia'];
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$creditos_data = $db_service->getCreditosPorHabilitador($cod_habilitador, $pagina, 15);
$creditos = $creditos_data['items'];
$total_paginas = $creditos_data['total_paginas'];
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title">
      <i class="fa-solid fa-handshake"></i> <?php echo htmlspecialchars($habilitador['nombre_entidad_crediticia']); ?>
    </h1>
    <a href="?m=habilitadores" class="dayq-btn"><i class="fa-solid fa-arrow-left"></i> Volver a Habilitadores</a>
  </div>

  <!-- INFO DEL HABILITADOR -->
  <div class="dayq-section">
    <h3 class="dayq-section-title"><i class="fa-solid fa-building"></i> Información de la Entidad</h3>
    <div class="dayq-grid-3">
      <div style="font-size: 12px;">
        <p><strong>NIT:</strong> <?php echo htmlspecialchars(isset($habilitador['nit']) ? $habilitador['nit'] : '-'); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars(isset($habilitador['telefono']) ? $habilitador['telefono'] : '-'); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars(isset($habilitador['email']) ? $habilitador['email'] : '-'); ?></p>
      </div>
      <div style="font-size: 12px;">
        <p><strong>Interés (%):</strong> <?php echo dayq_formato_porcentaje(isset($habilitador['interes_ptj']) ? $habilitador['interes_ptj'] : 0); ?></p>
        <p><strong>Comisión (%):</strong> <?php echo dayq_formato_porcentaje(isset($habilitador['comision_ptj']) ? $habilitador['comision_ptj'] : 0); ?></p>
        <p><strong>Estado:</strong> 
          <span class="badge <?php echo (isset($habilitador['cod_estado']) && $habilitador['cod_estado'] == 1) ? 'badge-success' : 'badge-danger'; ?>">
            <?php echo (isset($habilitador['cod_estado']) && $habilitador['cod_estado'] == 1) ? 'Activo' : 'Inactivo'; ?>
          </span>
        </p>
      </div>
      <div style="font-size: 12px;">
        <p><strong>Total Créditos:</strong> <?php echo isset($habilitador['total_creditos']) ? $habilitador['total_creditos'] : 0; ?></p>
        <p><strong>Valor Total:</strong> <span style="color: var(--accent); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($habilitador['valor_total']) ? $habilitador['valor_total'] : 0); ?></span></p>
        <p><strong>Total Girado:</strong> <span style="color: var(--green); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($habilitador['total_girar']) ? $habilitador['total_girar'] : 0); ?></span></p>
      </div>
    </div>
  </div>

  <!-- CRÉDITOS ASOCIADOS -->
  <div class="dayq-section">
    <h3 class="dayq-section-title"><i class="fa-solid fa-file-invoice-dollar"></i> Créditos Asociados</h3>

    <?php if (count($creditos) > 0): ?>
    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Comercio</th>
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
          <td><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></td>
          <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
          <td>$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></td>
          <td>$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
          <td><strong>$<?php echo dayq_formato_moneda(isset($cred['saldo']) ? $cred['saldo'] : 0); ?></strong></td>
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
        <a href="?m=habilitador_detalle&id=<?php echo $cod_habilitador; ?>&page=1">&laquo;</a>
        <a href="?m=habilitador_detalle&id=<?php echo $cod_habilitador; ?>&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
      <?php endif; ?>
      <?php $inicio = max(1, $pagina - 2); $fin = min($total_paginas, $pagina + 2); ?>
      <?php for ($i = $inicio; $i <= $fin; $i++): ?>
        <?php if ($i === $pagina): ?>
          <span class="active"><?php echo $i; ?></span>
        <?php else: ?>
          <a href="?m=habilitador_detalle&id=<?php echo $cod_habilitador; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($pagina < $total_paginas): ?>
        <a href="?m=habilitador_detalle&id=<?php echo $cod_habilitador; ?>&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
        <a href="?m=habilitador_detalle&id=<?php echo $cod_habilitador; ?>&page=<?php echo $total_paginas; ?>">&raquo;</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <p style="color: var(--text3); text-align: center; padding: 20px;">Este habilitador no tiene créditos registrados</p>
    <?php endif; ?>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>
