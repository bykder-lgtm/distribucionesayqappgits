<?php
/**
 * app/admin/administrativo/creditos_lista.php
 * Listado de Créditos - Vista principal del módulo de créditos
 * Diseño basado en el análisis Flexitech
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Créditos';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
$filtro_estado = dayq_get_str('estado', '');
$estado_qs = $filtro_estado !== '' ? '&estado=' . urlencode($filtro_estado) : '';
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-credit-card"></i> Créditos</h1>
    <div class="dayq-topbar-actions">
      <input type="text" id="buscar" placeholder="Buscar por ID, cliente, comercio..." value="<?php echo htmlspecialchars($buscar); ?>"
        style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 200px;">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <button class="dayq-btn dayq-btn-primary" onclick="buscarCreditos()"><i class="fa-solid fa-search"></i> Buscar</button>
    </div>
  </div>

  <!-- KPIs del módulo -->
  <?php
  $kpi_creditos = $db_service->getCreditosAprobados($fecha_desde, $fecha_hasta);
  $kpi_valor = $db_service->getValorFinanciado($fecha_desde, $fecha_hasta);
  $saldo_tes = $db_service->getSaldoTesoreria($fecha_hasta);
  ?>
  <div class="kpi-grid" style="margin-bottom: 24px;">
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-credit-card"></i> Total Créditos</div>
      <div class="kpi-value"><?php echo $kpi_creditos['total']; ?></div>
      <div class="kpi-sub">En el período</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-circle-check"></i> Aprobados</div>
      <div class="kpi-value"><?php echo $kpi_creditos['aprobados']; ?></div>
      <div class="kpi-sub"><?php echo $kpi_creditos['total'] > 0 ? round(($kpi_creditos['aprobados'] / $kpi_creditos['total']) * 100, 1) : 0; ?>% del total</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-hourglass-half"></i> Pendientes</div>
      <div class="kpi-value"><?php echo $kpi_creditos['pendientes']; ?></div>
      <div class="kpi-sub">Por gestionar</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-sack-dollar"></i> Valor Financiado</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($kpi_valor); ?></div>
      <div class="kpi-sub">Total período</div>
    </div>
  </div>

  <!-- Tabla de créditos -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Listado de Créditos</h3>
    <?php
    // Construir consulta con filtros
    $where = "WHERE 1=1";
    if ($fecha_desde && $fecha_hasta) {
        $desde = $db_service->escape($fecha_desde);
        $hasta = $db_service->escape($fecha_hasta);
        $where .= " AND DATE(ifv.fecha_creacion) BETWEEN '$desde' AND '$hasta'";
    }
    if ($buscar !== '') {
        $q = $db_service->escape("%$buscar%");
        $where .= " AND (ifv.cod_factura LIKE '$q'
                   OR t.nombres_apellidos_tercero LIKE '$q'
                   OR ti.nombre_tienda LIKE '$q')";
    }
    if ($filtro_estado !== '') {
        $est = $db_service->escape($filtro_estado);
        $where .= " AND ifv.nombre_estado_factura = '$est'";
    }

    $por_pagina = 15;
    $r_tot = $db_service->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta ifv
        LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
        $where");
    $total = 0;
    if ($r_tot && ($row = $r_tot->fetch_assoc())) {
        $total = (int) $row['total'];
    }
    $total_paginas = $total > 0 ? (int) ceil($total / $por_pagina) : 1;
    $pagina = min($pagina, $total_paginas);
    $offset = ($pagina - 1) * $por_pagina;

    $sql = "SELECT
                ifv.cod_info_factura_venta,
                ifv.cod_factura,
                ifv.total_precio_venta,
                ifv.fecha_creacion,
                ifv.nombre_estado_factura,
                t.nombres_apellidos_tercero AS cliente,
                t.identificacion_tercero AS cc_cliente,
                ti.nombre_tienda AS comercio,
                ec.nombre_entidad_crediticia AS linea,
                cc.cod_cuentas_cobrar,
                cc.monto_deuda,
                cc.abonado,
                (cc.monto_deuda - cc.abonado) AS saldo
            FROM tbl15_info_factura_venta ifv
            LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
            LEFT JOIN tbl15_tienda ti ON ti.cod_tienda = ifv.cod_tercero
            LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
            LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
            $where
            ORDER BY ifv.fecha_creacion DESC
            LIMIT $offset, $por_pagina";

    $r = $db_service->query($sql);
    $creditos = array();
    if ($r) {
        while ($row = $r->fetch_assoc()) {
            $creditos[] = $row;
        }
    }
    ?>

    <div class="dayq-table-wrap">
      <table class="dayq-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>CC</th>
            <th>Comercio</th>
            <th>Línea</th>
            <th>Valor Contado</th>
            <th>Valor Cliente</th>
            <th>Abonado</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th style="text-align: center;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($creditos) > 0): ?>
            <?php foreach ($creditos as $cred): ?>
              <tr>
                <td><span class="credit-link">#<?php echo !empty($cred['cod_factura']) ? $cred['cod_factura'] : $cred['cod_info_factura_venta']; ?></span></td>
                <td><strong><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></strong></td>
                <td style="color: var(--text3); font-size: 11px;"><?php echo htmlspecialchars(isset($cred['cc_cliente']) ? $cred['cc_cliente'] : '-'); ?></td>
                <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
                <td><span class="badge badge-blue"><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></span></td>
                <td style="font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cred['total_precio_venta']) ? $cred['total_precio_venta'] : 0); ?></td>
                <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($cred['monto_deuda']) ? $cred['monto_deuda'] : 0); ?></td>
                <td style="color: var(--green); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
                <td>
                  <span class="badge <?php
                    $est = isset($cred['nombre_estado_factura']) ? $cred['nombre_estado_factura'] : '';
                    echo $est === 'ABIERTA' ? 'badge-success' : ($est === 'PENDIENTE' ? 'badge-warning' : ($est === 'ANULADA' ? 'badge-danger' : 'badge-info'));
                  ?>">
                    <?php echo dayq_get_estado_texto($est); ?>
                  </span>
                </td>
                <td style="color: var(--text3); font-size: 11px;"><?php echo dayq_formato_fecha($cred['fecha_creacion']); ?></td>
                <td style="text-align: center;">
                  <div class="action-icons" style="display: flex; gap: 4px; justify-content: center;">
                    <a href="?m=credito_detalle&id=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Ver detalle">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="?m=liquidacion&accion=calcular&cod_credito=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Liquidar">
                      <i class="fa-solid fa-calculator"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="11" style="text-align: center; padding: 30px; color: var(--text3);">
                <i class="fa-solid fa-inbox" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>
                No hay créditos en el período seleccionado
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Paginación -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <span class="dayq-pagination-info">Mostrando <?php echo $total === 0 ? 0 : $offset + 1; ?>–<?php echo min($offset + $por_pagina, $total); ?> de <?php echo $total; ?></span>
        <div class="dayq-pagination-links">
          <?php if ($pagina > 1): ?>
            <a href="?m=creditos_lista&page=1&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $estado_qs; ?>">&laquo;</a>
            <a href="?m=creditos_lista&page=<?php echo $pagina - 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $estado_qs; ?>">&lsaquo;</a>
          <?php endif; ?>
          <?php
          $inicio = max(1, $pagina - 2);
          $fin = min($total_paginas, $pagina + 2);
          for ($i = $inicio; $i <= $fin; $i++):
          ?>
            <?php if ($i === $pagina): ?>
              <span class="active"><?php echo $i; ?></span>
            <?php else: ?>
              <a href="?m=creditos_lista&page=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>"><?php echo $i; ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($pagina < $total_paginas): ?>
            <a href="?m=creditos_lista&page=<?php echo $pagina + 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&rsaquo;</a>
            <a href="?m=creditos_lista&page=<?php echo $total_paginas; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&raquo;</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function buscarCreditos() {
  const buscar = document.getElementById('buscar').value;
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  let url = '?m=creditos_lista&buscar=' + encodeURIComponent(buscar);
  if (desde) url += '&fecha_desde=' + desde;
  if (hasta) url += '&fecha_hasta=' + hasta;
  window.location.href = url;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
