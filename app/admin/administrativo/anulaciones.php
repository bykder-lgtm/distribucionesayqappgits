<?php
/**
 * app/admin/administrativo/anulaciones.php
 * Módulo de Anulaciones - Gestión de cancelación de créditos
 * Diseño basado en análisis Flexitech: detalle completo con impacto financiero
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_liquidacion_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);
$liq_service = new DayqLiquidacionService($conectar);

$dayq_page_title = 'Anulaciones de Crédito';
include __DIR__ . '/layout_header.php';

$accion = dayq_get_str('accion', '');
$cod_credito = dayq_get_int('cod_credito', 0);

// Si se solicita anulación de un crédito específico
$impacto_anulacion = null;
$credito_anular = null;
if ($accion === 'calcular' && $cod_credito > 0) {
    $credito_anular = $db_service->getCreditoDetalle($cod_credito);
    if ($credito_anular) {
        $impacto_anulacion = $liq_service->getImpactoAnulacion($cod_credito);
    }
}

$pagina = dayq_get_int('page', 1);
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-ban"></i> Anulaciones de Crédito</h1>
    <div class="dayq-topbar-actions">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);">
      <button class="dayq-btn dayq-btn-primary" onclick="actualizarFiltros()">Filtrar</button>
    </div>
  </div>

  <!-- KPIs de anulaciones -->
  <?php
  // Contar anulaciones del período
  $desde_sql = $db_service->escape($fecha_desde);
  $hasta_sql = $db_service->escape($fecha_hasta);
  $r_kpi = $db_service->query("SELECT 
      COUNT(*) AS total_anulaciones,
      COALESCE(SUM(ifv.total_precio_venta), 0) AS valor_perdido
    FROM tbl15_info_factura_venta ifv
    WHERE UPPER(ifv.nombre_estado_factura) LIKE '%ANUL%'
    AND DATE(ifv.fecha_creacion) BETWEEN '$desde_sql' AND '$hasta_sql'");
  $kpi_data = $r_kpi ? $r_kpi->fetch_assoc() : ['total_anulaciones' => 0, 'valor_perdido' => 0];
  
  $total_ventas_periodo = $db_service->getValorFinanciado($fecha_desde, $fecha_hasta);
  $pct_sobre_ventas = $total_ventas_periodo > 0 ? round(((float)$kpi_data['valor_perdido'] / $total_ventas_periodo) * 100, 2) : 0;
  ?>
  <div class="kpi-grid" style="margin-bottom: 24px;">
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-ban"></i> Total Anulaciones</div>
      <div class="kpi-value"><?php echo $kpi_data['total_anulaciones']; ?></div>
      <div class="kpi-sub">En el período</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-sack-dollar"></i> Valor Perdido Total</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($kpi_data['valor_perdido']); ?></div>
      <div class="kpi-sub">Suma de valores</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-percentage"></i> % Sobre Ventas</div>
      <div class="kpi-value"><?php echo $pct_sobre_ventas; ?>%</div>
      <div class="kpi-sub">Del total financiado</div>
    </div>
  </div>

  <!-- SI HAY IMPACTO, MOSTRAR ANÁLISIS DETALLADO -->
  <?php if ($impacto_anulacion && $credito_anular): ?>
    <div class="dayq-section">
      <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
        <h3 class="dayq-section-title" style="margin-bottom: 0;">
          <i class="fa-solid fa-file-pen"></i> Análisis de Impacto — Anulación
        </h3>
        <span class="badge badge-danger">⚠️ En análisis</span>
        <span style="font-size: 12px; color: var(--text3);">
          Crédito relacionado: <strong style="color: var(--accent);">#<?php echo $credito_anular['cod_factura']; ?></strong>
        </span>
      </div>

      <!-- Grid de Impacto Financiero -->
      <div class="impact-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 16px;">
        <div class="impact-card" style="background: var(--card2); padding: 14px; border-radius: 8px; border: 1px solid var(--border);">
          <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 6px;">
            <span style="width: 26px; height: 26px; border-radius: 6px; background: rgba(79,142,247,0.12); display: flex; align-items: center; justify-content: center; color: #4f8ef7; font-size: 13px;"><i class="fa-solid fa-hand-holding-dollar"></i></span>
            <span style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600;">Valor Financiado</span>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: var(--accent); font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($impacto_anulacion['valor_financiado']); ?></div>
        </div>
        <div class="impact-card" style="background: var(--card2); padding: 14px; border-radius: 8px; border: 1px solid var(--border);">
          <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 6px;">
            <span style="width: 26px; height: 26px; border-radius: 6px; background: rgba(247,201,72,0.12); display: flex; align-items: center; justify-content: center; color: #f7c948; font-size: 13px;"><i class="fa-solid fa-percentage"></i></span>
            <span style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600;">Penalidad Hab.</span>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: var(--yellow); font-family: 'DM Mono', monospace;"><?php echo dayq_formato_porcentaje($impacto_anulacion['comision_ptj'] + $impacto_anulacion['aval_ptj']); ?></div>
        </div>
        <div class="impact-card" style="background: var(--card2); padding: 14px; border-radius: 8px; border: 1px solid var(--border);">
          <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 6px;">
            <span style="width: 26px; height: 26px; border-radius: 6px; background: rgba(0,200,150,0.12); display: flex; align-items: center; justify-content: center; color: #00c896; font-size: 13px;"><i class="fa-solid fa-receipt"></i></span>
            <span style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600;">Costos Asociados</span>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: var(--text); font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($impacto_anulacion['penalidad']); ?></div>
        </div>
        <div class="impact-card" style="background: rgba(255,94,122,0.08); padding: 14px; border-radius: 8px; border: 1px solid rgba(255,94,122,0.3);">
          <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 6px;">
            <span style="width: 26px; height: 26px; border-radius: 6px; background: rgba(239,68,68,0.15); display: flex; align-items: center; justify-content: center; color: var(--red); font-size: 13px;"><i class="fa-solid fa-circle-exclamation"></i></span>
            <span style="font-size: 10px; color: var(--red); text-transform: uppercase; font-weight: 600;">Pérdida Total</span>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: var(--red); font-family: 'DM Mono', monospace;">-$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?></div>
        </div>
      </div>

      <!-- Tabla de detalle del impacto -->
      <div class="dayq-table-wrap" style="margin-bottom: 12px;">
        <table class="dayq-table">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Valor Financiado al Cliente</th>
              <th>Penalidad del Habilitador</th>
              <th>Costos Asociados</th>
              <th>Pérdida Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Monto</strong></td>
              <td><strong>$<?php echo dayq_formato_moneda($impacto_anulacion['valor_financiado']); ?></strong></td>
              <td><strong>$<?php echo dayq_formato_moneda($impacto_anulacion['penalidad']); ?></strong></td>
              <td><strong>$0</strong></td>
              <td style="color: var(--red); font-weight: 700;"><strong>-$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?></strong></td>
            </tr>
            <tr>
              <td><strong>% Penalidad</strong></td>
              <td>—</td>
              <td><?php echo dayq_formato_porcentaje($impacto_anulacion['comision_ptj'] + $impacto_anulacion['aval_ptj']); ?></td>
              <td>—</td>
              <td>—</td>
            </tr>
            <tr>
              <td><strong>Valor Penalidad</strong></td>
              <td>—</td>
              <td>
                Comisión (<?php echo dayq_formato_porcentaje($impacto_anulacion['comision_ptj']); ?>): 
                $<?php echo dayq_formato_moneda($impacto_anulacion['comision_ptj'] > 0 ? ($impacto_anulacion['valor_financiado'] * $impacto_anulacion['comision_ptj']) / 100 : 0); ?><br>
                Aval (<?php echo dayq_formato_porcentaje($impacto_anulacion['aval_ptj']); ?>): 
                $<?php echo dayq_formato_moneda($impacto_anulacion['aval_ptj'] > 0 ? ($impacto_anulacion['valor_financiado'] * $impacto_anulacion['aval_ptj']) / 100 : 0); ?>
              </td>
              <td>Viajes/viáticos: $0<br>Otros gastos: $0</td>
              <td style="color: var(--red); font-weight: 700;">Utilidad perdida</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Resumen -->
      <div style="margin-top: 12px; padding: 12px 16px; background: rgba(255,94,122,0.08); border: 1px solid rgba(255,94,122,0.2); border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
        <div>
          <strong style="color: var(--red);">Resumen:</strong>
          <span style="color: var(--text3); margin-left: 8px;">Total penalidades y costos = <strong>$<?php echo dayq_formato_moneda($impacto_anulacion['penalidad']); ?></strong></span>
        </div>
        <div style="font-size: 18px; font-weight: 700; color: var(--red);">
          Utilidad perdida: -$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?>
        </div>
      </div>

      <!-- Advertencia -->
      <div style="margin-top: 12px; padding: 12px; background: rgba(255,94,122,0.1); border: 1px solid var(--red); border-radius: 6px;">
        <p style="margin: 0; font-size: 12px; color: var(--red);">
          <strong>⚠️ Advertencia:</strong> Al anular este crédito se generará una pérdida de 
          <strong>$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?></strong> para Flexitech.
        </p>
      </div>

      <!-- Responsable y observaciones (editable) -->
      <div style="margin-top: 12px; display: flex; gap: 16px; background: var(--card2); padding: 14px; border-radius: 8px;">
        <div style="flex: 1;">
          <label style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 4px;">Responsable</label>
          <input type="text" value="Administrador" style="width: 100%; padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        </div>
        <div style="flex: 2;">
          <label style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 4px;">Observaciones</label>
          <input type="text" placeholder="Motivo de la anulación..." style="width: 100%; padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- LISTADO DE CRÉDITOS ANULADOS / DISPONIBLES -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">
      <?php echo $impacto_anulacion ? 'Créditos Disponibles para Anulación' : 'Historial de Anulaciones y Créditos'; ?>
    </h3>
    <?php
    // Mostrar créditos anulados + disponibles
    $tabla_creditos = $db_service->getCreditosTable($pagina, 10, $fecha_desde, $fecha_hasta);
    $creditos = $tabla_creditos['items'];
    $total_paginas = $tabla_creditos['total_paginas'];
    ?>

    <div class="dayq-table-wrap">
      <table class="dayq-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Comercio</th>
            <th>Valor Fin.</th>
            <th>Abonado</th>
            <th>Saldo</th>
            <th>Estado</th>
            <th style="text-align: center;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($creditos) > 0): ?>
            <?php foreach ($creditos as $cred): ?>
              <tr>
                <td><span style="color: var(--accent); font-weight: 600;">#<?php echo $cred['cod_factura']; ?></span></td>
                <td><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></td>
                <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
                <td><strong>$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></strong></td>
                <td>$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
                <td><strong>$<?php echo dayq_formato_moneda((isset($cred['valor']) ? $cred['valor'] : 0) - (isset($cred['abonado']) ? $cred['abonado'] : 0)); ?></strong></td>
                <td>
                  <span class="badge <?php
                    $est = isset($cred['nombre_estado_factura']) ? $cred['nombre_estado_factura'] : '';
                    echo $est === 'ANULADA' ? 'badge-danger' : ($est === 'ABIERTA' ? 'badge-success' : 'badge-warning');
                  ?>">
                    <?php echo dayq_get_estado_texto($est); ?>
                  </span>
                </td>
                <td style="text-align: center;">
                  <?php if (isset($cred['nombre_estado_factura']) && $cred['nombre_estado_factura'] !== 'ANULADA'): ?>
                    <a href="?m=anulaciones&accion=calcular&cod_credito=<?php echo $cred['cod_info_factura_venta']; ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>" class="dayq-btn" style="padding: 4px 10px; font-size: 11px;">
                      <i class="fa-solid fa-calculator"></i> Calcular Impacto
                    </a>
                  <?php else: ?>
                    <span class="badge badge-danger">Anulado</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" style="text-align: center; padding: 30px; color: var(--text3);">
                <i class="fa-solid fa-ban" style="font-size: 24px; display: block; margin-bottom: 8px; opacity: 0.5;"></i>
                No hay créditos en el período seleccionado
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=anulaciones&page=1&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&laquo;</a>
          <a href="?m=anulaciones&page=<?php echo $pagina - 1; ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=anulaciones&page=<?php echo $i; ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=anulaciones&page=<?php echo $pagina + 1; ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&rsaquo;</a>
          <a href="?m=anulaciones&page=<?php echo $total_paginas; ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function actualizarFiltros() {
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  window.location.href = '?m=anulaciones&fecha_desde=' + desde + '&fecha_hasta=' + hasta;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
