<?php
/**
 * app/admin/administrativo/pagos_habilitadores.php
 * Pagos a Habilitadores - Gestión de pagos recibidos de entidades crediticias
 * Datos desde tbl15_movimiento_caja (entradas/débitos de habilitadores) + tbl15_cuentas_cobrar
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Pagos Habilitadores';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
$buscar = dayq_get_str('buscar', '');
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-building-columns"></i> Pagos a Habilitadores</h1>
    <div class="dayq-topbar-actions">
      <input type="text" id="buscar" placeholder="Buscar habilitador o lote..." value="<?php echo htmlspecialchars($buscar); ?>"
        style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 160px;">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <button class="dayq-btn dayq-btn-primary" onclick="buscarPagos()"><i class="fa-solid fa-search"></i> Filtrar</button>
    </div>
  </div>

  <!-- KPIs -->
  <?php
  $desde_sql = $db_service->escape($fecha_desde);
  $hasta_sql = $db_service->escape($fecha_hasta);

  // Pagos de habilitadores = movimientos de caja con total_debitos > 0 (entradas)
  $r_kpi = $db_service->query("SELECT 
      COUNT(*) AS total_pagos,
      COALESCE(SUM(total_debitos), 0) AS total_cobrado
    FROM tbl15_movimiento_caja
    WHERE total_debitos > 0
    AND DATE(fecha_ymd_movimiento_caja) BETWEEN '$desde_sql' AND '$hasta_sql'");
  $kpi = $r_kpi ? $r_kpi->fetch_assoc() : ['total_pagos' => 0, 'total_cobrado' => 0];
  $total_pagos = (int)$kpi['total_pagos'];
  $total_cobrado = (float)$kpi['total_cobrado'];

  // Cobrado hoy
  $hoy_sql = date('Y-m-d');
  $r_hoy = $db_service->query("SELECT COALESCE(SUM(total_debitos), 0) AS cobrado_hoy 
    FROM tbl15_movimiento_caja 
    WHERE total_debitos > 0 AND DATE(fecha_ymd_movimiento_caja) = '$hoy_sql'");
  $cobrado_hoy = $r_hoy ? (float)$r_hoy->fetch_assoc()['cobrado_hoy'] : 0;

  // Pendiente por cobrar desde cuentas_cobrar
  $r_pend = $db_service->query("SELECT COALESCE(SUM(cc.monto_deuda - cc.abonado), 0) AS pendiente_total
    FROM tbl15_cuentas_cobrar cc
    JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
    WHERE ifv.nombre_estado_factura NOT IN ('ANULADA', 'CERRADA')");
  $pendiente_total = $r_pend ? (float)$r_pend->fetch_assoc()['pendiente_total'] : 0;
  ?>
  <div class="kpi-grid" style="margin-bottom: 24px;">
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-receipt"></i> Total Cobros</div>
      <div class="kpi-value"><?php echo $total_pagos; ?></div>
      <div class="kpi-sub">En el período</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-sack-dollar"></i> Cobrado (Período)</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($total_cobrado); ?></div>
      <div class="kpi-sub">Suma de entradas</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-regular fa-calendar"></i> Cobrado Hoy</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($cobrado_hoy); ?></div>
      <div class="kpi-sub"><?php echo dayq_formato_fecha($hoy_sql); ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-hourglass-half"></i> Pendiente x Cobrar</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($pendiente_total); ?></div>
      <div class="kpi-sub">De cuentas activas</div>
    </div>
  </div>

  <!-- Tabla de Pagos de Habilitadores -->
  <div class="dayq-section">
    <h3 class="dayq-section-title"><i class="fa-solid fa-table-list"></i> Registro de Pagos de Habilitadores</h3>
    <?php
    $where = "WHERE mc.total_debitos > 0 AND DATE(mc.fecha_ymd_movimiento_caja) BETWEEN '$desde_sql' AND '$hasta_sql'";
    $buscar_sql = $buscar ? $db_service->escape("%$buscar%") : '';
    if ($buscar_sql) {
        $where .= " AND (mc.descripcion_movimiento LIKE '$buscar_sql' OR mc.nombre_puc LIKE '$buscar_sql' OR COALESCE(ec.nombre_entidad_crediticia, '') LIKE '$buscar_sql')";
    }

    // Paginación
    $por_pagina = 15;
    $r_tot = $db_service->query("SELECT COUNT(*) AS total 
      FROM tbl15_movimiento_caja mc
      LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = mc.cod_tercero
      $where");
    $total_registros = $r_tot ? (int)$r_tot->fetch_assoc()['total'] : 0;
    $total_paginas = $total_registros > 0 ? (int)ceil($total_registros / $por_pagina) : 1;
    $pagina = min($pagina, $total_paginas);
    $offset = ($pagina - 1) * $por_pagina;

    $sql = "SELECT 
        mc.cod_movimiento_caja,
        mc.descripcion_movimiento,
        mc.total_debitos,
        mc.total_creditos,
        mc.fecha_ymd_movimiento_caja,
        mc.fecha_hora_movimiento_caja,
        mc.nombre_puc,
        ec.nombre_entidad_crediticia AS habilitador_nombre,
        ec.cod_entidad_crediticia AS habilitador_id
      FROM tbl15_movimiento_caja mc
      LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = mc.cod_tercero
      $where
      ORDER BY mc.fecha_ymd_movimiento_caja DESC, mc.fecha_hora_movimiento_caja DESC
      LIMIT $offset, $por_pagina";

    $r = $db_service->query($sql);
    $pagos = [];
    if ($r) {
      while ($row = $r->fetch_assoc()) {
        $pagos[] = $row;
      }
    }
    ?>

    <div class="dayq-table-wrap">
      <table class="dayq-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Habilitador</th>
            <th>Lote / Concepto</th>
            <th style="text-align: right;">Valor</th>
            <th style="text-align: center;">Estado</th>
            <th style="text-align: center;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($pagos) > 0): ?>
            <?php foreach ($pagos as $p): 
              $es_hoy = ($p['fecha_ymd_movimiento_caja'] == $hoy_sql);
              $es_pasado = ($p['fecha_ymd_movimiento_caja'] < $hoy_sql);
            ?>
            <tr>
              <td style="color: var(--text3); font-size: 11px;">
                <?php echo dayq_formato_fecha($p['fecha_ymd_movimiento_caja']); ?>
                <small style="display: block; color: var(--text3);">
                  <?php echo isset($p['fecha_hora_movimiento_caja']) ? date('h:i A', strtotime($p['fecha_hora_movimiento_caja'])) : '-'; ?>
                </small>
              </td>
              <td>
                <strong><?php echo htmlspecialchars($p['habilitador_nombre'] ?: 'General'); ?></strong>
                <?php if ($p['habilitador_id']): ?>
                  <br><small style="color: var(--text3);">ID: <?php echo $p['habilitador_id']; ?></small>
                <?php endif; ?>
              </td>
              <td style="font-size: 11px; max-width: 220px;">
                <?php echo htmlspecialchars($p['descripcion_movimiento'] ?: ($p['nombre_puc'] ?: '-')); ?>
              </td>
              <td style="text-align: right; font-weight: 600; color: var(--green);">
                $<?php echo dayq_formato_moneda($p['total_debitos']); ?>
              </td>
              <td style="text-align: center;">
                <?php if ($es_pasado): ?>
                  <span class="badge badge-success">Recibido</span>
                <?php elseif ($es_hoy): ?>
                  <span class="badge badge-info">Hoy</span>
                <?php else: ?>
                  <span class="badge badge-warning">Pendiente</span>
                <?php endif; ?>
              </td>
              <td style="text-align: center;">
                <a href="?m=tesoreria&tab=movimientos&fecha_desde=<?php echo date('Y-m-d', strtotime($p['fecha_ymd_movimiento_caja'] . ' - 1 day')); ?>&fecha_hasta=<?php echo $p['fecha_ymd_movimiento_caja']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 10px;">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" style="text-align: center; padding: 40px; color: var(--text3);">
                <i class="fa-solid fa-building-columns" style="font-size: 28px; display: block; margin-bottom: 8px; opacity: 0.4;"></i>
                No hay pagos de habilitadores registrados en el período seleccionado
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Totales -->
    <?php if ($total_pagos > 0): ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px; padding: 12px 16px; background: var(--card2); border-radius: 8px;">
      <div>
        <strong style="font-size: 12px;">Total Cobrado a Habilitadores</strong>
        <span style="color: var(--text3); font-size: 11px; margin-left: 8px;">Período</span>
      </div>
      <div style="font-size: 20px; font-weight: 700; color: var(--green); font-family: 'DM Mono', monospace;">
        $<?php echo dayq_formato_moneda($total_cobrado); ?>
      </div>
    </div>
    <?php endif; ?>

    <!-- Paginación -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination" style="margin-top: 12px;">
        <?php if ($pagina > 1): ?>
          <a href="?m=pagos_habilitadores&page=1&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&laquo;</a>
          <a href="?m=pagos_habilitadores&page=<?php echo $pagina - 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&lsaquo;</a>
        <?php endif; ?>
        <?php
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=pagos_habilitadores&page=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=pagos_habilitadores&page=<?php echo $pagina + 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&rsaquo;</a>
          <a href="?m=pagos_habilitadores&page=<?php echo $total_paginas; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function buscarPagos() {
  const buscar = document.getElementById('buscar').value;
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  let url = '?m=pagos_habilitadores';
  if (buscar) url += '&buscar=' + encodeURIComponent(buscar);
  if (desde) url += '&fecha_desde=' + desde;
  if (hasta) url += '&fecha_hasta=' + hasta;
  window.location.href = url;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
