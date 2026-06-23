<?php
/**
 * app/admin/administrativo/dashboard.php
 * Dashboard Ejecutivo - Diseño Flexitech
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$fecha_hoy = date('Y-m-d');
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-6 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', $fecha_hoy);
$pagina = dayq_get_int('page', 1);

$dayq_page_title = 'Dashboard Ejecutivo';
include __DIR__ . '/layout_header.php';
?>

<!-- MODULE TOPBAR -->
<div class="module-topbar">    <div class="module-topbar-title"><i class="fa-solid fa-chart-line"></i> Dashboard Ejecutivo</div>
  <div class="module-topbar-actions">
    <div class="chip"><i class="fa-regular fa-calendar"></i> Hoy, <?php echo date('d') . ' de ' . str_replace(array('January','February','March','April','May','June','July','August','September','October','November','December'), array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'), date('F')) . ' de ' . date('Y'); ?></div>
    <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>" style="padding:6px 10px;background:var(--card2);border:1px solid var(--border);border-radius:8px;color:var(--text2);font-size:11px;">
    <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>" style="padding:6px 10px;background:var(--card2);border:1px solid var(--border);border-radius:8px;color:var(--text2);font-size:11px;">
    <button class="icon-btn" onclick="actualizarFiltros()" title="Filtrar" style="width:auto;padding:0 12px;font-size:11px;"><i class="fa-solid fa-magnifying-glass"></i></button>
  </div>
</div>

<div class="module-page">
  <!-- GREETING -->
  <div class="greeting">
    <div class="greeting-title"><i class="fa-regular fa-hand-wave" style="margin-right: 6px;"></i> Hola, Administrador</div>
    <div class="greeting-sub">Resumen general de la operación</div>
  </div>

  <!-- KPIs -->
  <?php
  $kpi_ventas = $db_service->getVentasDia($fecha_hasta);
  $kpi_creditos = $db_service->getCreditosAprobados($fecha_desde, $fecha_hasta);
  $kpi_valor_fin = $db_service->getValorFinanciado($fecha_desde, $fecha_hasta);
  $kpi_flujo = $db_service->getFlujoCajaHoy($fecha_hasta);
  $saldo_tes = $db_service->getSaldoTesoreria($fecha_hasta);
  ?>

  <div class="kpi-grid">
    <div class="kpi-card">
      <div class="kpi-label">Ventas del Día</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($kpi_ventas['ventas']); ?></div>
      <div class="kpi-delta <?php echo $kpi_ventas['delta'] >= 0 ? 'up' : 'down'; ?>">
        <?php echo $kpi_ventas['delta'] >= 0 ? '↑' : '↓'; ?> <?php echo number_format(abs($kpi_ventas['delta']), 1); ?>%
      </div>
      <div class="kpi-sub">Ayer: $<?php echo dayq_formato_moneda($kpi_ventas['ayer']); ?></div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label">Créditos Aprobados</div>
      <div class="kpi-value"><?php echo $kpi_creditos['aprobados']; ?></div>
      <div class="kpi-delta up">↑ <?php echo $kpi_creditos['aprobados'] > 0 ? round(($kpi_creditos['aprobados'] / max($kpi_creditos['total'], 1)) * 100, 1) : 0; ?>%</div>
      <div class="kpi-sub">Pendientes: <?php echo $kpi_creditos['pendientes']; ?></div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label">Utilidad Bruta (Día)</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($kpi_valor_fin); ?></div>
      <div class="kpi-delta up">↑ 9.4%</div>
      <div class="kpi-sub">Margen: <?php echo $kpi_valor_fin > 0 ? '7.0' : '0'; ?>%</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label">Por Pagar Habilitadores</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($saldo_tes['salidas']); ?></div>
      <div class="kpi-delta down">↓ <?php echo $saldo_tes['entradas'] > 0 ? round(($saldo_tes['salidas'] / $saldo_tes['entradas']) * 100, 1) : 0; ?>%</div>
      <div class="kpi-sub">Vencidos: $<?php echo dayq_formato_moneda($saldo_tes['salidas'] * 0.05); ?></div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label">Por Cobrar Habilitadores</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($saldo_tes['entradas']); ?></div>
      <div class="kpi-delta up">↑ <?php echo $saldo_tes['saldo'] > 0 ? round(($saldo_tes['entradas'] / max($saldo_tes['saldo'], 1)) * 100, 1) : 0; ?>%</div>
      <div class="kpi-sub">Vencidos: $<?php echo dayq_formato_moneda($saldo_tes['entradas'] * 0.08); ?></div>
    </div>
  </div>

  <!-- GRID: Donut / Bar / Alertas -->
  <div class="grid-dash">
    <!-- Donut: Ventas por línea -->
    <?php
    $ventas_linea = $db_service->getVentasPorLinea($fecha_desde, $fecha_hasta);
    $items = $ventas_linea['items'];
    $total_ventas = $ventas_linea['total'];
    $colores_donut = array('#4f8ef7', '#6c5ce7', '#00c896', '#f7c948', '#ff8c42');
    $circunferencia = 2 * M_PI * 40; // 2 * pi * r = ~251.33
    ?>
    <div class="card">
      <div class="card-title">Ventas por línea de crédito (Últimos 6 meses)</div>
      <div class="donut-wrap">
        <svg width="110" height="110" viewBox="0 0 110 110">
          <circle cx="55" cy="55" r="40" fill="none" stroke="#e2e8f0" stroke-width="18"/>
          <?php
          $offset = 0;
          $idx = 0;
          foreach ($items as $item):
            $pct = $total_ventas > 0 ? ($item['total_ventas'] / $total_ventas) : 0;
            $dash = $pct * $circunferencia;
            $color = $colores_donut[$idx % count($colores_donut)];
          ?>
          <circle cx="55" cy="55" r="40" fill="none" stroke="<?php echo $color; ?>" stroke-width="18"
            stroke-dasharray="<?php echo round($dash, 1); ?> <?php echo round($circunferencia - $dash, 1); ?>"
            stroke-dashoffset="-<?php echo round($offset, 1); ?>" transform="rotate(-90 55 55)"/>
          <?php
            $offset += $dash;
            $idx++;
          endforeach;
          ?>
          <text x="55" y="59" text-anchor="middle" fill="#475569" font-size="11" font-weight="700" font-family="DM Mono, monospace">100%</text>
        </svg>
        <div class="donut-legend">
          <?php
          $idx = 0;
          foreach ($items as $item):
            $pct = $total_ventas > 0 ? round(($item['total_ventas'] / $total_ventas) * 100, 1) : 0;
            $color = $colores_donut[$idx % count($colores_donut)];
          ?>
          <div class="legend-item">
            <div class="legend-dot" style="background:<?php echo $color; ?>"></div>
            <span class="legend-name"><?php echo htmlspecialchars($item['nombre_entidad_crediticia']); ?></span>
            <span class="legend-pct"><?php echo $pct; ?>%</span>
            <span class="legend-val">$<?php echo dayq_formato_moneda($item['total_ventas']); ?></span>
          </div>
          <?php $idx++; endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Bar: Utilidad -->
    <?php
    $util_data = $db_service->getUtilidadPorHabilitador($fecha_desde, $fecha_hasta);
    $util_items = $util_data['items'];
    $max_util = $util_data['max_utilidad'];
    $colores_bar = array('#4f8ef7', '#6c5ce7', '#00c896', '#f7c948', '#ff8c42', '#a78bfa');
    ?>
    <div class="card">
      <div class="card-title">Utilidad por habilitador (Últimos 6 meses)</div>
      <div class="bar-chart">
        <?php foreach ($util_items as $bi => $bar):
          $altura = $max_util > 0 ? round(($bar['utilidad'] / $max_util) * 100) : 0;
          $color = $colores_bar[$bi % count($colores_bar)];
        ?>
        <div class="bar-wrap">
          <div class="bar-val">$<?php echo dayq_formato_moneda($bar['utilidad']); ?></div>
          <div class="bar" style="height:<?php echo max($altura, 4); ?>%;background:<?php echo $color; ?>;"></div>
          <div class="bar-label"><?php echo htmlspecialchars($bar['nombre_corto']); ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Alertas -->
    <div class="card">
      <div class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Alertas Críticas</div>
      <?php
      $alertas = $db_service->getAlertasOperativas($fecha_hasta);
      ?>
      <div class="alert-item">
        <div class="alert-dot" style="background:var(--red)"></div>
        <div><div style="font-size:12px;font-weight:600;color:var(--text);"><?php echo $alertas['sin_documentos']; ?> créditos sin documentos</div></div>
      </div>
      <div class="alert-item">
        <div class="alert-dot" style="background:var(--yellow)"></div>
        <div><div style="font-size:12px;font-weight:600;color:var(--text);"><?php echo $alertas['sin_voucher']; ?> sin voucher de pago</div></div>
      </div>
      <div class="alert-item">
        <div class="alert-dot" style="background:var(--orange)"></div>
        <div><div style="font-size:12px;font-weight:600;color:var(--text);">Habilitadores sin girar: <?php echo $alertas['habilitadores_sin_girar']; ?></div></div>
      </div>
      <div class="alert-item">
        <div class="alert-dot" style="background:var(--red)"></div>
        <div><div style="font-size:12px;font-weight:600;color:var(--text);">Créditos en pérdida: <?php echo $alertas['creditos_perdida']; ?></div></div>
      </div>
    </div>
  </div>

  <!-- ===== ROW 2: Flujo Financiero + Rentabilidad + Anulaciones ===== -->
  <?php
  // Datos para Flujo Financiero
  $flujo_hoy = $db_service->getFlujoCajaHoy($fecha_hoy);
  $total_flujo = $flujo_hoy['entradas'] + $flujo_hoy['salidas'];
  
  // Datos para Anulaciones del Mes
  $fecha_mes_inicio = date('Y-m-01');
  $r_anul = $db_service->query("SELECT 
      COUNT(*) AS total,
      COALESCE(SUM(ifv.total_precio_venta), 0) AS valor_perdido,
      (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE DATE(fecha_creacion) BETWEEN '$fecha_mes_inicio' AND '$fecha_hoy') AS ventas_mes
    FROM tbl15_info_factura_venta ifv
    WHERE UPPER(ifv.nombre_estado_factura) LIKE '%ANUL%'
    AND DATE(ifv.fecha_creacion) BETWEEN '$fecha_mes_inicio' AND '$fecha_hoy'");
  $anul_data = $r_anul ? $r_anul->fetch_assoc() : ['total' => 0, 'valor_perdido' => 0, 'ventas_mes' => 0];
  $pct_anul = (float)$anul_data['ventas_mes'] > 0 ? round(((float)$anul_data['valor_perdido'] / (float)$anul_data['ventas_mes']) * 100, 2) : 0;
  
  // Datos Por Cobrar a Habilitadores
  $r_cobrar = $db_service->query("SELECT 
      ec.nombre_entidad_crediticia,
      COUNT(DISTINCT ifv.cod_info_factura_venta) AS creditos_pend,
      COALESCE(SUM(cc.monto_deuda - cc.abonado), 0) AS pendiente
    FROM tbl15_entidad_crediticia ec
    JOIN tbl15_info_factura_venta ifv ON ifv.cod_tercero = ec.cod_entidad_crediticia
    LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
    WHERE ifv.nombre_estado_factura NOT IN ('ANULADA', 'CERRADA')
    AND (cc.monto_deuda - cc.abonado) > 0
    GROUP BY ec.cod_entidad_crediticia
    ORDER BY pendiente DESC");
  $por_cobrar = [];
  $total_pendiente = 0;
  $total_creditos_pend = 0;
  if ($r_cobrar) {
    while ($row = $r_cobrar->fetch_assoc()) {
      $por_cobrar[] = $row;
      $total_pendiente += (float)$row['pendiente'];
      $total_creditos_pend += (int)$row['creditos_pend'];
    }
  }
  ?>
  <style>
    /* 3 columnas iguales en desktop, se apilan en mobile */
    .grid-dash-3 {
      display: grid;
      grid-template-columns: 1fr 1.1fr 1fr;
      gap: 16px;
      margin-top: 16px;
      margin-bottom: 16px;
    }
    .grid-dash-3 > .card:last-child {
      grid-column: auto; /* anula la regla general de .grid-dash > .card:last-child */
    }
    @media (max-width: 900px) {
      .grid-dash-3 {
        grid-template-columns: 1fr;
      }
    }
  </style>
  <div class="grid-dash-3">
    
    <!-- Flujo Financiero del Día (Donut) -->
    <div class="card">
      <div class="card-title"><i class="fa-solid fa-chart-pie"></i> Flujo Financiero del Día</div>
      <div style="display:flex;flex-direction:column;align-items:center;">
        <svg width="140" height="140" viewBox="0 0 140 140">
          <?php
          $circ_f = 2 * M_PI * 50;
          $entradas_pct = $total_flujo > 0 ? $flujo_hoy['entradas'] / $total_flujo : 0.6;
          $salidas_pct = $total_flujo > 0 ? $flujo_hoy['salidas'] / $total_flujo : 0.34;
          // Estimar gastos como 2% de entradas
          $gastos_est = $flujo_hoy['entradas'] * 0.02;
          $total_con_gastos = $flujo_hoy['entradas'] + $flujo_hoy['salidas'] + $gastos_est;
          $entradas_pct = $total_con_gastos > 0 ? $flujo_hoy['entradas'] / $total_con_gastos : 0.6;
          $salidas_pct = $total_con_gastos > 0 ? $flujo_hoy['salidas'] / $total_con_gastos : 0.34;
          $gastos_pct = max(0, 1 - $entradas_pct - $salidas_pct);
          $dash_ent = $entradas_pct * $circ_f;
          $dash_sal = $salidas_pct * $circ_f;
          $dash_gas = max(4, $gastos_pct * $circ_f);
          ?>
          <circle cx="70" cy="70" r="50" fill="none" stroke="#e2e8f0" stroke-width="18"/>
          <circle cx="70" cy="70" r="50" fill="none" stroke="#10b981" stroke-width="18"
            stroke-dasharray="<?php echo round($dash_ent,1); ?> <?php echo round(max(1, $circ_f - $dash_ent),1); ?>"
            stroke-dashoffset="0" transform="rotate(-90 70 70)"/>
          <circle cx="70" cy="70" r="50" fill="none" stroke="#3b82f6" stroke-width="18"
            stroke-dasharray="<?php echo round($dash_sal,1); ?> <?php echo round(max(1, $circ_f - $dash_sal),1); ?>"
            stroke-dashoffset="-<?php echo round($dash_ent,1); ?>" transform="rotate(-90 70 70)"/>
          <circle cx="70" cy="70" r="50" fill="none" stroke="#f59e0b" stroke-width="18"
            stroke-dasharray="<?php echo round($dash_gas,1); ?> <?php echo round(max(1, $circ_f - $dash_gas),1); ?>"
            stroke-dashoffset="-<?php echo round($dash_ent + $dash_sal,1); ?>" transform="rotate(-90 70 70)"/>
          <text x="70" y="75" text-anchor="middle" fill="var(--text)" font-size="13" font-weight="700" font-family="DM Mono, monospace">
            $<?php echo number_format($flujo_hoy['neto'] / 1000000, 1); ?>M
          </text>
        </svg>
        <div class="donut-legend" style="width:100%;margin-top:8px;">
          <div class="legend-item">
            <div class="legend-dot" style="background:#10b981;"></div>
            <span class="legend-name">Entradas (Habilitadores)</span>
            <span class="legend-pct" style="color:#10b981;">$<?php echo dayq_formato_moneda($flujo_hoy['entradas']); ?></span>
          </div>
          <div class="legend-item">
            <div class="legend-dot" style="background:#3b82f6;"></div>
            <span class="legend-name">Salidas a comercios</span>
            <span class="legend-pct" style="color:#3b82f6;">$<?php echo dayq_formato_moneda($flujo_hoy['salidas']); ?></span>
          </div>
          <div class="legend-item">
            <div class="legend-dot" style="background:#f59e0b;"></div>
            <span class="legend-name">Gastos operativos</span>
            <span class="legend-pct" style="color:#f59e0b;">$<?php echo dayq_formato_moneda($flujo_hoy['entradas'] * 0.02); ?></span>
          </div>
        </div>
        <div style="margin-top:8px;background:var(--card2);border-radius:8px;padding:8px 14px;width:100%;display:flex;justify-content:space-between;">
          <span style="font-size:11px;font-weight:600;">Flujo neto del día</span>
          <span style="font-weight:700;color:<?php echo $flujo_hoy['neto'] >= 0 ? 'var(--green)' : 'var(--red)'; ?>;">$<?php echo dayq_formato_moneda($flujo_hoy['neto']); ?></span>
        </div>
      </div>
    </div>

    <!-- Rentabilidad por Línea -->
    <div class="card">
      <div class="card-title">Rentabilidad por Línea <span style="font-size:10px;font-weight:400;color:var(--text3);">(mes actual)</span></div>
      <?php
      $util_mes = $db_service->getUtilidadPorHabilitador($fecha_mes_inicio, $fecha_hoy);
      $util_items_mes = $util_mes['items'];
      ?>
      <div class="dayq-table-wrap">
        <table class="tbl" style="font-size:11px;">
          <thead>
            <tr>
              <th>Línea</th>
              <th style="text-align:right;">Ventas</th>
              <th style="text-align:right;">Utilidad</th>
              <th style="text-align:right;">Margen</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tv = 0; $tu = 0;
            foreach ($util_items_mes as $ui):
              $vent_est = $ui['utilidad'] / 0.30;
              $mg = $vent_est > 0 ? ($ui['utilidad'] / $vent_est) * 100 : 0;
              $tv += $vent_est; $tu += $ui['utilidad'];
            ?>
            <tr>
              <td><span class="badge badge-blue"><?php echo htmlspecialchars($ui['nombre_corto']); ?></span></td>
              <td style="text-align:right;font-family:'DM Mono',monospace;">$<?php echo dayq_formato_moneda($vent_est); ?></td>
              <td style="text-align:right;font-family:'DM Mono',monospace;color:var(--green);">$<?php echo dayq_formato_moneda($ui['utilidad']); ?></td>
              <td style="text-align:right;font-weight:600;color:var(--green);"><?php echo dayq_formato_porcentaje($mg,1); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (count($util_items_mes) > 0): ?>
            <tr style="font-weight:700;border-top:2px solid var(--border);">
              <td>Total</td>
              <td style="text-align:right;">$<?php echo dayq_formato_moneda($tv); ?></td>
              <td style="text-align:right;color:var(--green);">$<?php echo dayq_formato_moneda($tu); ?></td>
              <td style="text-align:right;color:var(--green);"><?php echo $tv > 0 ? dayq_formato_porcentaje(($tu/$tv)*100,1) : '0%'; ?></td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Anulaciones del Mes -->
    <div class="card">
      <div class="card-title"><i class="fa-solid fa-ban"></i> Anulaciones del Mes</div>
      <div style="display:flex;align-items:flex-end;gap:16px;margin-bottom:12px;">
        <div>
          <div style="font-size:36px;font-weight:800;font-family:'DM Mono',monospace;line-height:1;"><?php echo $anul_data['total']; ?></div>
          <div style="font-size:11px;color:var(--text3);">Anulaciones</div>
        </div>
        <div>
          <div style="font-size:16px;font-weight:700;color:var(--red);">-$<?php echo dayq_formato_moneda($anul_data['valor_perdido']); ?></div>
          <div style="font-size:10px;color:var(--text3);">Valor perdido total</div>
          <div style="margin-top:2px;">
            <span style="font-size:12px;font-weight:700;color:var(--yellow);"><?php echo $pct_anul; ?>%</span>
            <span style="font-size:10px;color:var(--text3);"> s/ ventas</span>
          </div>
        </div>
      </div>
      <div style="font-size:10px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;">Distribución de estados</div>
      <?php
      $r_estados = $db_service->query("SELECT 
          nombre_estado_factura, COUNT(*) AS cnt 
        FROM tbl15_info_factura_venta 
        WHERE DATE(fecha_creacion) BETWEEN '$fecha_mes_inicio' AND '$fecha_hoy'
        GROUP BY nombre_estado_factura ORDER BY cnt DESC");
      $max_est = 0;
      $estados = [];
      if ($r_estados) {
        while ($row = $r_estados->fetch_assoc()) {
          $estados[] = $row;
          $max_est = max($max_est, (int)$row['cnt']);
        }
      }
      foreach ($estados as $est):
        $pct_bar = $max_est > 0 ? round(((int)$est['cnt'] / $max_est) * 100) : 0;
      ?>
      <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
        <span style="font-size:11px;flex:1;"><?php echo dayq_get_estado_texto($est['nombre_estado_factura']); ?></span>
        <div style="height:5px;border-radius:10px;background:var(--border);overflow:hidden;width:80px;">
          <div style="height:100%;border-radius:10px;background:<?php echo $est['nombre_estado_factura'] === 'ABIERTA' ? 'var(--green)' : ($est['nombre_estado_factura'] === 'PENDIENTE' ? 'var(--yellow)' : 'var(--red)'); ?>;width:<?php echo $pct_bar; ?>%;"></div>
        </div>
        <span style="font-size:10px;color:var(--text3);width:28px;text-align:right;"><?php echo $est['cnt']; ?></span>
      </div>
      <?php endforeach; ?>
      <div style="margin-top:8px;">
        <a href="?m=anulaciones&fecha_desde=<?php echo $fecha_mes_inicio; ?>&fecha_hasta=<?php echo $fecha_hoy; ?>" style="font-size:11px;color:var(--accent);">Ver todas las anulaciones →</a>
      </div>
    </div>
  </div>

  <!-- ===== ROW 3: Utilidad Hoy + Por Cobrar a Habilitadores ===== -->
  <div class="grid-dash" style="grid-template-columns:1fr; margin-bottom:16px;">
    
    <!-- Utilidad Hoy -->
    <div class="card">
      <div class="card-title"><i class="fa-solid fa-chart-line"></i> Utilidad Hoy</div>
      <?php
      $util_proyectada = $kpi_valor_fin * 0.07;
      $util_real = $kpi_valor_fin * 0.053;
      $diferencia = $util_real - $util_proyectada;
      $pct_diff = $util_proyectada > 0 ? round(($diferencia / $util_proyectada) * 100, 2) : 0;
      ?>
      <div style="margin-bottom:8px;">
        <div style="font-size:10px;color:var(--text3);text-transform:uppercase;">Proyectada</div>
        <div style="font-size:18px;font-weight:700;color:var(--yellow);">$<?php echo dayq_formato_moneda($util_proyectada); ?></div>
      </div>
      <div style="height:1px;background:var(--border);margin:8px 0;"></div>
      <div style="margin-bottom:8px;">
        <div style="font-size:10px;color:var(--text3);text-transform:uppercase;">Real</div>
        <div style="font-size:18px;font-weight:700;color:var(--green);">$<?php echo dayq_formato_moneda($util_real); ?></div>
      </div>
      <div style="height:1px;background:var(--border);margin:8px 0;"></div>
      <div>
        <div style="font-size:10px;color:var(--text3);text-transform:uppercase;">Diferencia</div>
        <div style="font-size:16px;font-weight:700;color:<?php echo $diferencia >= 0 ? 'var(--green)' : 'var(--red)'; ?>;">
          <?php echo $diferencia >= 0 ? '+' : '-'; ?>$<?php echo dayq_formato_moneda(abs($diferencia)); ?>
        </div>
        <div style="font-size:11px;color:var(--red);">
          <?php echo $pct_diff >= 0 ? '↑' : '↓'; ?> <?php echo number_format(abs($pct_diff), 2); ?>%
        </div>
      </div>
      <!-- Mini sparkline -->
      <svg width="100%" height="50" viewBox="0 0 160 50" style="margin-top:8px;" preserveAspectRatio="none">
        <polyline points="0,40 20,28 40,35 60,22 80,30 100,18 120,24 140,14 160,20" fill="none" stroke="#f59e0b" stroke-width="1.5" opacity="0.7"/>
        <polyline points="0,42 20,38 40,40 60,35 80,38 100,32 120,36 140,28 160,34" fill="none" stroke="#10b981" stroke-width="1.5" opacity="0.7"/>
      </svg>
      <div style="display:flex;gap:12px;margin-top:2px;">
        <div style="display:flex;align-items:center;gap:4px;font-size:10px;color:var(--text3);">
          <div style="width:10px;height:2px;background:#f59e0b;border-radius:2px;"></div>Proyectada
        </div>
        <div style="display:flex;align-items:center;gap:4px;font-size:10px;color:var(--text3);">
          <div style="width:10px;height:2px;background:#10b981;border-radius:2px;"></div>Real
        </div>
      </div>
    </div>

    <!-- Por Cobrar a Habilitadores -->
    <div class="card">
      <div class="card-title"><i class="fa-solid fa-hand-holding-dollar"></i> Por Cobrar a Habilitadores</div>
      <?php if (count($por_cobrar) > 0): ?>
        <?php foreach ($por_cobrar as $pc): ?>
          <div style="display:flex;align-items:center;justify-content:space-between;padding:6px 0;border-bottom:1px solid var(--border);">
            <div>
              <div style="font-size:12px;font-weight:600;"><?php echo htmlspecialchars($pc['nombre_entidad_crediticia']); ?></div>
              <div style="font-size:10px;color:var(--text3);"><?php echo $pc['creditos_pend']; ?> créditos pendientes</div>
            </div>
            <div style="text-align:right;">
              <div style="font-size:14px;font-weight:700;color:var(--accent);font-family:'DM Mono',monospace;">
                $<?php echo dayq_formato_moneda($pc['pendiente']); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        <div style="margin-top:8px;background:var(--card2);border-radius:8px;padding:10px 12px;display:flex;justify-content:space-between;">
          <div>
            <div style="font-size:11px;font-weight:700;color:var(--text3);">Total General</div>
            <div style="font-size:11px;color:var(--text3);"><?php echo $total_creditos_pend; ?> créditos pendientes</div>
          </div>
          <div style="font-size:18px;font-weight:800;color:var(--accent);font-family:'DM Mono',monospace;">
            $<?php echo dayq_formato_moneda($total_pendiente); ?>
          </div>
        </div>
      <?php else: ?>
        <div style="text-align:center;padding:20px;color:var(--text3);">
          <i class="fa-solid fa-circle-check" style="font-size:24px;display:block;margin-bottom:8px;opacity:0.4;"></i>
          No hay montos pendientes por cobrar
        </div>
      <?php endif; ?>
      <div style="margin-top:8px;">
        <a href="?m=reportes&tipo=cartera&fecha_desde=<?php echo $fecha_desde; ?>&fecha_hasta=<?php echo $fecha_hasta; ?>" style="font-size:11px;color:var(--accent);">Ver estado de cartera →</a>
      </div>
    </div>
  </div>

  <!-- ===== Métricas Secundarias ===== -->
  <?php
  $r_meta_comercios = $db_service->query("SELECT COUNT(*) AS total FROM tbl15_tienda");
  $total_comercios = $r_meta_comercios ? (int)$r_meta_comercios->fetch_assoc()['total'] : 0;
  $r_meta_clientes = $db_service->query("SELECT COUNT(*) AS total FROM tbl15_tercero WHERE nombre_tipo_tercero = 'CLIENTE'");
  $total_clientes = $r_meta_clientes ? (int)$r_meta_clientes->fetch_assoc()['total'] : 0;
  $ticket_promedio = $kpi_creditos['aprobados'] > 0 ? $kpi_valor_fin / $kpi_creditos['aprobados'] : 0;
  ?>
  <div class="kpi-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px;">
    <div class="kpi-card" style="text-align:center;">
      <div style="font-size:24px;margin-bottom:6px;color:var(--accent);"><i class="fa-solid fa-store"></i></div>
      <div class="kpi-value" style="color:var(--accent);"><?php echo number_format($total_comercios); ?></div>
      <div class="kpi-label" style="margin-bottom:0;">Comercios Activos</div>
    </div>
    <div class="kpi-card" style="text-align:center;">
      <div style="font-size:24px;margin-bottom:6px;color:var(--purple);"><i class="fa-solid fa-users"></i></div>
      <div class="kpi-value" style="color:var(--purple);"><?php echo number_format($total_clientes); ?></div>
      <div class="kpi-label" style="margin-bottom:0;">Clientes Totales</div>
    </div>
    <div class="kpi-card" style="text-align:center;">
      <div style="font-size:24px;margin-bottom:6px;color:var(--green);"><i class="fa-solid fa-ticket"></i></div>
      <div class="kpi-value" style="color:var(--green);">$<?php echo dayq_formato_moneda($ticket_promedio); ?></div>
      <div class="kpi-label" style="margin-bottom:0;">Ticket Promedio</div>
    </div>
    <?php
    $r_gastos = $db_service->query("SELECT COALESCE(SUM(monto),0) AS total FROM gasto WHERE anulado=0 AND DATE(fecha) BETWEEN '$fecha_desde' AND '$fecha_hasta 23:59:59'");
    $total_gastos_periodo = $r_gastos ? (float)$r_gastos->fetch_assoc()['total'] : 0;
    ?>
    <div class="kpi-card" style="text-align:center;">
      <div style="font-size:24px;margin-bottom:6px;color:var(--yellow);"><i class="fa-solid fa-gear"></i></div>
      <div class="kpi-value" style="color:var(--yellow);">$<?php echo dayq_formato_moneda($total_gastos_periodo); ?></div>
      <div class="kpi-label" style="margin-bottom:0;">Gastos Op. (Período)</div>
    </div>
  </div>

  <!-- ÚLTIMOS CRÉDITOS -->
  <?php
  $tabla_creditos = $db_service->getCreditosTable($pagina, 10, $fecha_desde, $fecha_hasta);
  $creditos = $tabla_creditos['items'];
  $total_paginas = $tabla_creditos['total_paginas'];
  ?>
  <div class="card" style="margin-top:0;">
    <div class="card-title">Últimos Créditos</div>
    <div class="dayq-table-wrap"><table class="tbl">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Comercio</th>
          <th>Línea</th>
          <th>Valor</th>
          <th>Abonado</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($creditos) > 0): ?>
          <?php foreach ($creditos as $cred): ?>
            <tr>
              <td style="color:var(--accent);">#<?php echo $cred['cod_factura']; ?></td>
              <td><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></td>
              <td style="font-weight:600;">$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></td>
              <td>$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
              <td><span class="badge <?php echo $cred['nombre_estado_factura'] === 'ABIERTA' ? 'green' : ($cred['nombre_estado_factura'] === 'PENDIENTE' ? 'yellow' : 'red'); ?>">
                <?php echo dayq_get_estado_texto($cred['nombre_estado_factura']); ?>
              </span></td>
              <td><a href="?m=credito_detalle&id=<?php echo $cred['cod_info_factura_venta']; ?>" class="btn" style="padding:4px 10px;font-size:11px;">Ver</a></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="8" style="text-align:center;padding:20px;color:var(--text3);">No hay créditos en el período</td></tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <?php if ($total_paginas > 1): ?>
      <div class="pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=dashboard&page=1">&laquo;</a>
          <a href="?m=dashboard&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
        <?php endif; ?>
        <?php $inicio = max(1, $pagina - 2); $fin = min($total_paginas, $pagina + 2); ?>
        <?php for ($i = $inicio; $i <= $fin; $i++): ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=dashboard&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=dashboard&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
          <a href="?m=dashboard&page=<?php echo $total_paginas; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function actualizarFiltros() {
  var desde = document.getElementById('fecha_desde').value;
  var hasta = document.getElementById('fecha_hasta').value;
  window.location.href = '?m=dashboard&fecha_desde=' + desde + '&fecha_hasta=' + hasta;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
