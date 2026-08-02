<?php
/**
 * app/admin/administrativo/pagos_habilitadores.php
 * Pagos de Habilitadores - Gestión de pagos recibidos de entidades crediticias
 * Datos desde tbl15_movimiento_caja (entradas/débitos de habilitadores) + tbl15_cuentas_cobrar
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Pagos de Habilitadores';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
$buscar = dayq_get_str('buscar', '');
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-building-columns"></i> Pagos de Habilitadores</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('pagos_habilitadores')" title="Guía de pagos de habilitadores"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <input type="text" id="buscar" placeholder="Buscar habilitador o lote..." value="<?php echo htmlspecialchars($buscar); ?>"
        style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 160px;">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <button class="dayq-btn dayq-btn-primary" onclick="buscarPagos()"><i class="fa-solid fa-search"></i> Buscar</button>
      <button class="dayq-btn" style="background: var(--accent); color: white; border: none;" onclick="abrirModalBanco()"><i class="fa-solid fa-building-columns"></i> Asignar Banco</button>
    </div>
  </div>

  <!-- MODAL ASIGNAR BANCO -->
  <div id="modalAsignarBanco" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1001; align-items: center; justify-content: center;">
    <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; width: 420px; max-width: 95%; padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h3 style="margin: 0; font-size: 15px;"><i class="fa-solid fa-building-columns"></i> Asignar Cuenta Bancaria</h3>
        <button onclick="cerrarModalBanco()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text3);" title="Cerrar">&times;</button>
      </div>
      <form method="POST" action="reg_dayq.php">
        <input type="hidden" name="entity" value="asignar_banco">
        <input type="hidden" name="redirect" value="pagos_habilitadores">
        <div style="margin-bottom: 12px;">
          <label style="font-size: 11px; color: var(--text3); font-weight: 600; display: block; margin-bottom: 4px;">ID del Movimiento</label>
          <input type="number" name="cod_movimiento" id="asignar_mov_id" min="1" readonly required style="width: 100%; padding: 9px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 14px; font-weight: 700;">
        </div>
        <div style="margin-bottom: 16px;">
          <label style="font-size: 11px; color: var(--text3); font-weight: 600; display: block; margin-bottom: 4px;">Cuenta Bancaria</label>
          <select name="cod_banco_cuenta" style="width: 100%; padding: 9px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
            <option value="0">Sin asignar</option>
            <?php
            $bancos_sel = $db_service->getCuentasBancarias();
            if ($bancos_sel['success'] && count($bancos_sel['items']) > 0):
              foreach ($bancos_sel['items'] as $b):
            ?>
            <option value="<?php echo $b['cod_banco_cuenta']; ?>">
              <?php echo htmlspecialchars($b['nombre_banco_cuenta']); ?> - <?php echo htmlspecialchars($b['numero_banco_cuenta']); ?>
            </option>
            <?php endforeach; endif; ?>
          </select>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 8px;">
          <button type="button" onclick="cerrarModalBanco()" class="dayq-btn" style="padding: 8px 16px;">Cancelar</button>
          <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px;">
            <i class="fa-solid fa-check"></i> Asignar
          </button>
        </div>
      </form>
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

  // Pendiente por cobrar desde cuentas_cobrar
  $r_pend = $db_service->query("SELECT COALESCE(SUM(cc.monto_deuda - cc.abonado), 0) AS pendiente_total
    FROM tbl15_cuentas_cobrar cc
    JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
    WHERE ifv.nombre_estado_factura NOT IN ('ANULADA', 'CERRADA')");
  $pendiente_total = $r_pend ? (float)$r_pend->fetch_assoc()['pendiente_total'] : 0;
  $promedio_dias = $db_service->getPromedioDiasPago();
  $hab_atrasados = $db_service->getHabilitadoresConAtraso();
  $total_atraso = 0;
  foreach ($hab_atrasados as $ha) { $total_atraso += (float)$ha['monto_atrasado']; }
  $cobrado_hoy_kpi = $db_service->getPagosRecibidosHoy($hoy_sql);
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
      <div class="kpi-value">$<?php echo dayq_formato_moneda($cobrado_hoy_kpi); ?></div>
      <div class="kpi-sub"><?php echo dayq_formato_fecha($hoy_sql); ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-hourglass-half"></i> Pendiente x Cobrar</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($pendiente_total); ?></div>
      <div class="kpi-sub">De cuentas activas</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-clock"></i> Promedio Pago</div>
      <div class="kpi-value" style="color: var(--accent);"><?php echo $promedio_dias; ?> días</div>
      <div class="kpi-sub">Desde creación crédito</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-triangle-exclamation"></i> Con Atraso</div>
      <div class="kpi-value" style="color: var(--red);"><?php echo count($hab_atrasados); ?></div>
      <div class="kpi-sub">$<?php echo dayq_formato_moneda($total_atraso); ?> > 60 días</div>
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
        mc.cod_banco_cuenta,
        ec.nombre_entidad_crediticia AS habilitador_nombre,
        ec.cod_entidad_crediticia AS habilitador_id,
        bc.nombre_banco_cuenta AS banco_nombre
      FROM tbl15_movimiento_caja mc
      LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = mc.cod_tercero
      LEFT JOIN tbl15_banco_cuenta bc ON bc.cod_banco_cuenta = mc.cod_banco_cuenta
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

    <div class="dayq-table-wrap">        <table class="dayq-table" id="tabla-pagos-hab">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Habilitador</th>
            <th>Lote / Concepto</th>
            <th>Cuenta Bancaria</th>
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
              <td style="font-size: 11px;">
                <?php if (!empty($p['banco_nombre'])): ?>
                  <span class="badge badge-blue" style="font-size: 10px;"><?php echo htmlspecialchars($p['banco_nombre']); ?></span>
                <?php else: ?>
                  <span style="color: var(--text3);">—</span>
                <?php endif; ?>
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
                <?php if (empty($p['cod_banco_cuenta'])): ?>
                  <button onclick="abrirModalBanco(<?php echo $p['cod_movimiento_caja']; ?>)" class="dayq-btn" style="padding: 4px 8px; font-size: 10px;" title="Asignar cuenta bancaria">
                    <i class="fa-solid fa-building-columns"></i>
                  </button>
                <?php endif; ?>
                <a href="?m=tesoreria&tab=movimientos&fecha_desde=<?php echo date('Y-m-d', strtotime($p['fecha_ymd_movimiento_caja'] . ' - 1 day')); ?>&fecha_hasta=<?php echo $p['fecha_ymd_movimiento_caja']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 10px;" title="Ver en tesorería">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" style="text-align: center; padding: 40px; color: var(--text3);">
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
        <strong style="font-size: 12px;">Total Cobrado de Habilitadores</strong>
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
function abrirModalBanco(movId) {
  document.getElementById('asignar_mov_id').value = movId || '';
  document.getElementById('modalAsignarBanco').style.display = 'flex';
}

function cerrarModalBanco() {
  document.getElementById('modalAsignarBanco').style.display = 'none';
}

document.addEventListener('click', function(e) {
  var modal = document.getElementById('modalAsignarBanco');
  if (e.target === modal) cerrarModalBanco();
});

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

// Inicializar filtros de tabla
document.addEventListener('DOMContentLoaded', function() {
    var tables = document.querySelectorAll('.dayq-table');
    if (tables.length > 0 && typeof initFiltrosTabla === 'function') {
        initFiltrosTabla(tables[0].id || 'tabla-pagos-hab', {
            tipos: {
                0: 'date',    // Fecha
                1: 'text',    // Habilitador
                2: 'text',    // Lote / Concepto
                3: 'text',    // Cuenta Bancaria
                4: 'text',    // Valor
                5: 'select'   // Estado
            },
            opciones: {
                5: ['Recibido', 'Hoy', 'Pendiente']
            }
        });
    }
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
