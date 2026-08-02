<?php
/**
 * app/admin/administrativo/reportes.php
 * Módulo de Reportes - Análisis de rentabilidad
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Reportes';
include __DIR__ . '/layout_header.php';

$reporte = isset($_GET['tipo']) ? preg_replace('/[^a-z_]/', '', $_GET['tipo']) : 'rentabilidad';
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-chart-bar"></i> Reportes y Análisis</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('reportes')" title="Guía de reportes"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);">
      <button class="dayq-btn dayq-btn-primary" onclick="actualizarReporte()">Actualizar</button>
    </div>
  </div>

  <!-- TABS DE REPORTES -->
  <div class="dayq-section" style="padding: 0; border: none;">
    <div class="dayq-tabs">
      <button class="dayq-tab-btn <?php echo $reporte === 'rentabilidad' ? 'active' : ''; ?>" onclick="cambiarReporte('rentabilidad')">Rentabilidad</button>
      <button class="dayq-tab-btn <?php echo $reporte === 'cartera' ? 'active' : ''; ?>" onclick="cambiarReporte('cartera')">Cartera</button>
      <button class="dayq-tab-btn <?php echo $reporte === 'comercios' ? 'active' : ''; ?>" onclick="cambiarReporte('comercios')">Por Comercio</button>
      <button class="dayq-tab-btn <?php echo $reporte === 'lineas' ? 'active' : ''; ?>" onclick="cambiarReporte('lineas')">Por Línea</button>
    </div>
  </div>

  <!-- TAB: RENTABILIDAD -->
  <div class="dayq-tab-content <?php echo $reporte === 'rentabilidad' ? 'active' : ''; ?>">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Análisis de Rentabilidad</h3>
      <?php
      $kpi_ventas = $db_service->getVentasDia(date('Y-m-d'));
      $kpi_creditos = $db_service->getCreditosAprobados($fecha_desde, $fecha_hasta);
      $kpi_valor = $db_service->getValorFinanciado($fecha_desde, $fecha_hasta);
      $saldo = $db_service->getSaldoTesoreria();
      
      // Obtener datos de rentabilidad por línea
      $rentabilidad_data = $db_service->getUtilidadPorLinea($fecha_desde, $fecha_hasta);
      $rentabilidad_items = $rentabilidad_data['items'];
      $total_utilidad = 0;
foreach ($rentabilidad_items as $item) {
    $total_utilidad += $item['utilidad'];
}
      ?>
      
      <!-- KPIs del período -->
      <div class="kpi-grid" style="margin-bottom: 16px;">
        <div class="kpi-card">
          <div class="kpi-label"><i class="fa-solid fa-calendar"></i> Período</div>
          <div class="kpi-value" style="font-size: 14px;"><?php echo dayq_formato_fecha($fecha_desde); ?> - <?php echo dayq_formato_fecha($fecha_hasta); ?></div>
          <div class="kpi-sub">Rango de análisis</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-label"><i class="fa-solid fa-check-circle"></i> Créditos Aprobados</div>
          <div class="kpi-value"><?php echo $kpi_creditos['aprobados']; ?> <span style="font-size: 14px; color: var(--text3); font-weight: 400;">de <?php echo $kpi_creditos['total']; ?></span></div>
          <div class="kpi-sub">En el período</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-label"><i class="fa-solid fa-dollar-sign"></i> Valor Financiado</div>
          <div class="kpi-value">$<?php echo dayq_formato_moneda($kpi_valor); ?></div>
          <div class="kpi-sub">Total período</div>
        </div>
      </div>

      <!-- Tabla de Rentabilidad por Línea -->
      <div style="background: var(--card); border: 1px solid var(--border); border-radius: 8px; overflow: hidden; margin-bottom: 16px;">
        <div style="padding: 10px 14px; border-bottom: 1px solid var(--border);">
          <span style="font-size: 12px; font-weight: 700;">Rentabilidad por Línea</span>
        </div>
        <div class="dayq-table-wrap">
          <table class="dayq-table" style="font-size: 11px;">
            <thead>
              <tr>
                <th>Línea</th>
                <th style="text-align: right;">Ventas (Cliente paga)</th>
                <th style="text-align: right;">Costo Línea</th>
                <th style="text-align: right;">Utilidad Bruta</th>
                <th style="text-align: right;">Gastos Asoc.</th>
                <th style="text-align: right;">Utilidad Neta</th>
                <th style="text-align: right;">Margen Real</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($rentabilidad_items) > 0): ?>
                <?php 
                $total_ventas = 0;
                $total_costos = 0;
                $total_gastos = 0;
                foreach ($rentabilidad_items as $item): 
                  $ventas = $item['utilidad'] / 0.30; // Estimación inversa del 30%
                  $costo_hab = $ventas * 0.70;
                  $gastos_asoc = $ventas * 0.02;
                  $utilidad_neta = $item['utilidad'] - $gastos_asoc;
                  $margen = $ventas > 0 ? ($utilidad_neta / $ventas) * 100 : 0;
                  $total_ventas += $ventas;
                  $total_costos += $costo_hab;
                  $total_gastos += $gastos_asoc;
                ?>
                <tr>
                  <td><strong><?php echo htmlspecialchars($item['nombre']); ?></strong></td>
                  <td style="text-align: right; font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($ventas); ?></td>
                  <td style="text-align: right; font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($costo_hab); ?></td>
                  <td style="text-align: right; font-family: 'DM Mono', monospace; color: var(--green);">$<?php echo dayq_formato_moneda($item['utilidad']); ?></td>
                  <td style="text-align: right; font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($gastos_asoc); ?></td>
                  <td style="text-align: right; font-family: 'DM Mono', monospace; color: var(--green); font-weight: 700;">$<?php echo dayq_formato_moneda($utilidad_neta); ?></td>
                  <td style="text-align: right; font-weight: 700; color: <?php echo $margen >= 10 ? 'var(--green)' : 'var(--yellow)'; ?>;">
                    <?php echo dayq_formato_porcentaje($margen, 1); ?>
                  </td>
                </tr>
                <?php endforeach; ?>
                <!-- Fila de totales -->
                <tr style="background: rgba(79,142,247,0.08); font-weight: 700;">
                  <td style="color: var(--accent);">Total General</td>
                  <td style="text-align: right; color: var(--accent);">$<?php echo dayq_formato_moneda($total_ventas); ?></td>
                  <td style="text-align: right; color: var(--accent);">$<?php echo dayq_formato_moneda($total_costos); ?></td>
                  <td style="text-align: right; color: var(--green);">$<?php echo dayq_formato_moneda($total_utilidad); ?></td>
                  <td style="text-align: right; color: var(--accent);">$<?php echo dayq_formato_moneda($total_gastos); ?></td>
                  <td style="text-align: right; color: var(--green); font-size: 13px;">$<?php echo dayq_formato_moneda($total_utilidad - $total_gastos); ?></td>
                  <td style="text-align: right; color: var(--green); font-size: 13px;">
                    <?php echo $total_ventas > 0 ? dayq_formato_porcentaje((($total_utilidad - $total_gastos) / $total_ventas) * 100, 1) : '0%'; ?>
                  </td>
                </tr>
              <?php else: ?>
                <tr>
                  <td colspan="7" style="text-align: center; padding: 30px; color: var(--text3);">
                    No hay datos de rentabilidad para el período seleccionado
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Donut Chart de Utilidad Neta -->
      <?php if (count($rentabilidad_items) > 0): ?>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
        <div style="background: var(--card); border: 1px solid var(--border); border-radius: 8px; padding: 16px;">
          <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text3); margin-bottom: 14px;">
            <i class="fa-solid fa-chart-pie"></i> Distribución de Utilidad por Línea
          </div>
          <div style="display: flex; align-items: center; gap: 20px;">
            <svg width="120" height="120" viewBox="0 0 120 120">
              <circle cx="60" cy="60" r="45" fill="none" stroke="#2a3350" stroke-width="18"/>
              <?php
              $circ = 2 * M_PI * 45;
              $offset_donut = 0;
              $colores_donut = ['#4f8ef7', '#6c5ce7', '#00c896', '#f7c948', '#ff8c42', '#a78bfa'];
              $di = 0;
              foreach ($rentabilidad_items as $item):
                $pct_util = $total_utilidad > 0 ? $item['utilidad'] / $total_utilidad : 0;
                $dash = $pct_util * $circ;
                $color = $colores_donut[$di % count($colores_donut)];
              ?>
              <circle cx="60" cy="60" r="45" fill="none" stroke="<?php echo $color; ?>" stroke-width="18"
                stroke-dasharray="<?php echo round($dash, 1); ?> <?php echo round($circ - $dash, 1); ?>"
                stroke-dashoffset="-<?php echo round($offset_donut, 1); ?>" transform="rotate(-90 60 60)"/>
              <?php
                $offset_donut += $dash;
                $di++;
              endforeach;
              ?>
              <text x="60" y="64" text-anchor="middle" fill="var(--text)" font-size="12" font-weight="700" font-family="DM Mono, monospace">
                $<?php echo number_format($total_utilidad / 1000000, 1); ?>M
              </text>
            </svg>
            <div style="flex: 1;">
              <?php
              $di = 0;
              foreach ($rentabilidad_items as $item):
                $pct = $total_utilidad > 0 ? round(($item['utilidad'] / $total_utilidad) * 100, 1) : 0;
                $color = $colores_donut[$di % count($colores_donut)];
              ?>
              <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 6px; font-size: 11px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo $color; ?>;"></span>
                <span style="flex: 1; color: var(--text2);"><?php echo htmlspecialchars($item['nombre_corto']); ?></span>
                <span style="font-weight: 700;"><?php echo $pct; ?>%</span>
                <span style="color: var(--text3); font-size: 10px;">$<?php echo dayq_formato_moneda($item['utilidad']); ?></span>
              </div>
              <?php $di++; endforeach; ?>
            </div>
          </div>
        </div>

        <div style="background: var(--card); border: 1px solid var(--border); border-radius: 8px; padding: 16px; display: flex; flex-direction: column; justify-content: center;">
          <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text3); margin-bottom: 12px;">
            <i class="fa-solid fa-chart-line"></i> Resumen del Período
          </div>
          <div style="text-align: center;">
            <div style="font-size: 10px; color: var(--text3);">Utilidad Neta Total</div>
            <div style="font-size: 28px; font-weight: 800; color: var(--green); font-family: 'DM Mono', monospace;">
              $<?php echo dayq_formato_moneda($total_utilidad - $total_gastos); ?>
            </div>
            <div style="font-size: 12px; color: var(--green); margin-top: 4px;">
              Margen: <?php echo $total_ventas > 0 ? dayq_formato_porcentaje((($total_utilidad - $total_gastos) / $total_ventas) * 100, 1) : '0%'; ?>
            </div>
            <div style="margin-top: 12px; display: flex; gap: 16px; justify-content: center;">
              <div>
                <div style="font-size: 11px; color: var(--text3);">Ventas Totales</div>
                <div style="font-size: 16px; font-weight: 700; color: var(--accent);">$<?php echo dayq_formato_moneda($total_ventas); ?></div>
              </div>
              <div>
                <div style="font-size: 11px; color: var(--text3);">Créditos</div>
                <div style="font-size: 16px; font-weight: 700;"><?php echo $kpi_creditos['aprobados']; ?></div>
              </div>
              <div>
                <div style="font-size: 11px; color: var(--text3);">Gastos</div>
                <div style="font-size: 16px; font-weight: 700; color: var(--orange);">$<?php echo dayq_formato_moneda($total_gastos); ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- TAB: CARTERA -->
  <div class="dayq-tab-content <?php echo $reporte === 'cartera' ? 'active' : ''; ?>">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Estado de Cartera</h3>
      <?php
      $cartera = $db_service->query("
        SELECT 
          fc.nombre_estado_factura,
          COUNT(*) as cantidad,
          SUM(ifv.total_precio_venta) as valor_total,
          SUM(cc.abonado) as abonado,
          SUM(cc.monto_deuda - cc.abonado) as pendiente
        FROM tbl15_info_factura_venta ifv
        LEFT JOIN tbl15_cuentas_cobrar cc ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
        LEFT JOIN tbl15_factura_credito_estado fc ON ifv.cod_estado_factura = fc.cod_estado_factura
        GROUP BY fc.nombre_estado_factura
        ORDER BY cantidad DESC
      ");
      ?>
      <div class="dayq-table-wrap"><table class="dayq-table">
        <thead>
          <tr>
            <th>Estado</th>
            <th>Cantidad</th>
            <th>Valor Total</th>
            <th>Abonado</th>
            <th>Pendiente</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($cartera && count($cartera) > 0): ?>
            <?php foreach ($cartera as $row): ?>
              <tr>
                <td><span class="badge <?php echo dayq_get_estado_clase($row['nombre_estado_factura']); ?>">
                  <?php echo dayq_get_estado_texto($row['nombre_estado_factura']); ?>
                </span></td>
                <td style="text-align: center; font-weight: 600;"><?php echo isset($row['cantidad']) ? $row['cantidad'] : 0; ?></td>
                <td>$<?php echo dayq_formato_moneda(isset($row['valor_total']) ? $row['valor_total'] : 0); ?></td>
                <td style="color: var(--green); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($row['abonado']) ? $row['abonado'] : 0); ?></td>
                <td style="color: var(--yellow); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($row['pendiente']) ? $row['pendiente'] : 0); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table></div>
    </div>
  </div>

  <!-- TAB: COMERCIOS -->
  <div class="dayq-tab-content <?php echo $reporte === 'comercios' ? 'active' : ''; ?>">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Top 10 Comercios por Volumen</h3>
      <?php
      $top_comercios = $db_service->query("
        SELECT 
          t.cod_tienda,
          t.nombre_tienda,
          COUNT(ifv.cod_info_factura_venta) as total_creditos,
          SUM(ifv.total_precio_venta) as valor_total,
          SUM(cc.abonado) as abonado,
          SUM(cc.monto_deuda - cc.abonado) as pendiente
        FROM tbl15_tienda t
        LEFT JOIN tbl15_info_factura_venta ifv ON t.cod_tienda = ifv.cod_tienda
        LEFT JOIN tbl15_cuentas_cobrar cc ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
        WHERE ifv.fecha_creacion BETWEEN '$fecha_desde' AND '$fecha_hasta'
        GROUP BY t.cod_tienda
        ORDER BY valor_total DESC
        LIMIT 10
      ");
      ?>
      <div class="dayq-table-wrap"><table class="dayq-table">
        <thead>
          <tr>
            <th>Comercio</th>
            <th>Créditos</th>
            <th>Valor Total</th>
            <th>Abonado</th>
            <th>Pendiente</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($top_comercios && count($top_comercios) > 0): ?>
            <?php foreach ($top_comercios as $row): ?>
              <tr>
                <td><strong><?php echo htmlspecialchars($row['nombre_tienda']); ?></strong></td>
                <td style="text-align: center;"><?php echo isset($row['total_creditos']) ? $row['total_creditos'] : 0; ?></td>
                <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($row['valor_total']) ? $row['valor_total'] : 0); ?></td>
                <td style="color: var(--green); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($row['abonado']) ? $row['abonado'] : 0); ?></td>
                <td style="color: var(--yellow); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($row['pendiente']) ? $row['pendiente'] : 0); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table></div>
    </div>
  </div>

  <!-- TAB: LÍNEAS -->
  <div class="dayq-tab-content <?php echo $reporte === 'lineas' ? 'active' : ''; ?>">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Performance por Línea de Crédito</h3>
      <?php
      $lineas = $db_service->query("
        SELECT 
          ec.cod_entidad_crediticia,
          ec.nombre_entidad_crediticia,
          COUNT(ifv.cod_info_factura_venta) as total_creditos,
          SUM(ifv.total_precio_venta) as valor_total,
          SUM(cc.abonado) as abonado,
          SUM(cc.monto_deuda - cc.abonado) as pendiente
        FROM tbl15_entidad_crediticia ec
        LEFT JOIN tbl15_operador_credito oc ON oc.cod_entidad_crediticia = ec.cod_entidad_crediticia
        LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_operador_credito = oc.cod_operador_credito
        LEFT JOIN tbl15_cuentas_cobrar cc ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
        WHERE ifv.fecha_creacion BETWEEN '$fecha_desde' AND '$fecha_hasta'
        GROUP BY ec.cod_entidad_crediticia
        ORDER BY valor_total DESC
      ");
      ?>
      <div class="dayq-table-wrap"><table class="dayq-table">
        <thead>
          <tr>
            <th>Línea</th>
            <th>Créditos</th>
            <th>Valor Total</th>
            <th>Abonado</th>
            <th>Pendiente</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($lineas && count($lineas) > 0): ?>
            <?php foreach ($lineas as $row): ?>
              <tr>
                <td><strong><?php echo htmlspecialchars($row['nombre_entidad_crediticia']); ?></strong></td>
                <td style="text-align: center;"><?php echo isset($row['total_creditos']) ? $row['total_creditos'] : 0; ?></td>
                <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($row['valor_total']) ? $row['valor_total'] : 0); ?></td>
                <td style="color: var(--green); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($row['abonado']) ? $row['abonado'] : 0); ?></td>
                <td style="color: var(--yellow); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($row['pendiente']) ? $row['pendiente'] : 0); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<script>
function cambiarReporte(tipo) {
  window.location.href = '?m=reportes&tipo=' + tipo + '&fecha_desde=<?php echo $fecha_desde; ?>&fecha_hasta=<?php echo $fecha_hasta; ?>';
}

function actualizarReporte() {
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  window.location.href = '?m=reportes&tipo=<?php echo $reporte; ?>&fecha_desde=' + desde + '&fecha_hasta=' + hasta;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
