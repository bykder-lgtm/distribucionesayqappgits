<?php
/**
 * app/admin/administrativo/tesoreria.php
 * Módulo de Tesorería - Movimientos de caja
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$dayq_page_title = 'Tesorería';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
$tab_activo = isset($_GET['tab']) ? preg_replace('/[^a-z_]/', '', $_GET['tab']) : 'movimientos';
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-coins"></i> Tesorería</h1>
    <div class="dayq-topbar-actions">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);">
      <button class="dayq-btn dayq-btn-primary" onclick="actualizarTesoreria()">Actualizar</button>
    </div>
  </div>

  <!-- DATOS COMPARTIDOS -->
  <?php
  $saldo = $db_service->getSaldoTesoreria($fecha_hasta);
  $flujo_hoy = $db_service->getFlujoCajaHoy(date('Y-m-d'));
  $ctas_result = $db_service->getCuentasBancarias();
  $todas_cuentas = $ctas_result['items'];
  ?>

  <!-- RESUMEN DE SALDO -->
  <div class="kpi-grid" style="margin-bottom: 24px;">
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-coins"></i> Saldo Actual</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($saldo['saldo']); ?></div>
      <div class="kpi-sub">Acumulado</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-arrow-down"></i> Entradas Totales</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($saldo['entradas']); ?></div>
      <div class="kpi-sub">Período</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-arrow-up"></i> Salidas Totales</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($saldo['salidas']); ?></div>
      <div class="kpi-sub">Período</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-chart-line"></i> Flujo Neto (Hoy)</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($flujo_hoy['neto']); ?></div>
      <div class="kpi-sub">Diferencia</div>
    </div>
  </div>

  <!-- TABS -->
  <div class="dayq-section" style="padding: 0; border: none;">
    <div class="dayq-tabs">
      <a class="dayq-tab-btn <?php echo $tab_activo === 'movimientos' ? 'active' : ''; ?>" href="?m=tesoreria&tab=movimientos&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">
        <i class="fa-solid fa-arrow-right-arrow-left"></i> Movimientos
      </a>
      <a class="dayq-tab-btn <?php echo $tab_activo === 'conciliacion' ? 'active' : ''; ?>" href="?m=tesoreria&tab=conciliacion&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">
        <i class="fa-solid fa-scale-balanced"></i> Conciliación bancaria
      </a>
      <a class="dayq-tab-btn <?php echo $tab_activo === 'cuentas' ? 'active' : ''; ?>" href="?m=tesoreria&tab=cuentas&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>">
        <i class="fa-solid fa-building-columns"></i> Cuentas bancarias
      </a>
    </div>
  </div>

  <!-- TAB: MOVIMIENTOS -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'movimientos' ? 'active' : ''; ?>" data-tab="movimientos">
    <div class="dayq-section">
      <h3 class="dayq-section-title">Movimientos de Caja</h3>
    <?php
    $total_registros = $db_service->getMovimientosCajaTotal($fecha_desde, $fecha_hasta);
    $por_pagina = 15;
    $total_paginas = ceil($total_registros / $por_pagina);
    $movimientos = $db_service->getMovimientosCajaPaginados($pagina, $por_pagina, $fecha_desde, $fecha_hasta);
    ?>

    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Concepto</th>
          <th>Tipo</th>
          <th>Entrada</th>
          <th>Salida</th>
          <th>Saldo</th>
          <th>Creado</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($movimientos) > 0): ?>
          <?php 
          $saldo_acumulado = 0;
          foreach ($movimientos as $mov):
            $entrada = isset($mov['entrada']) && $mov['entrada'] > 0 ? $mov['entrada'] : 0;
            $salida = isset($mov['salida']) && $mov['salida'] > 0 ? $mov['salida'] : 0;
            $saldo_acumulado += $entrada - $salida;
          ?>
            <tr>
              <td><?php echo dayq_formato_fecha($mov['fecha_movimiento']); ?></td>
              <td><?php echo htmlspecialchars(isset($mov['concepto']) ? $mov['concepto'] : '-'); ?></td>
              <td><span class="badge <?php echo ($entrada > 0 ? 'badge-success' : 'badge-danger'); ?>">
                <?php echo ($entrada > 0 ? 'Entrada' : 'Salida'); ?>
              </span></td>
              <td style="color: var(--green); font-weight: 600;">
                <?php echo $entrada > 0 ? '$' . dayq_formato_moneda($entrada) : '-'; ?>
              </td>
              <td style="color: var(--red); font-weight: 600;">
                <?php echo $salida > 0 ? '$' . dayq_formato_moneda($salida) : '-'; ?>
              </td>
              <td style="font-weight: 700; color: var(--accent);">$<?php echo dayq_formato_moneda($saldo_acumulado); ?></td>
              <td style="font-size: 10px; color: var(--text3);"><?php echo dayq_formato_fecha_hora($mov['fecha_creacion']); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 20px; color: var(--text3);">
              No hay movimientos en el período seleccionado
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php
    $qs_pag = '&tab=' . urlencode($tab_activo) . '&fecha_desde=' . urlencode($fecha_desde) . '&fecha_hasta=' . urlencode($fecha_hasta);
    ?>
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=tesoreria&page=1<?php echo $qs_pag; ?>">&laquo;</a>
          <a href="?m=tesoreria&page=<?php echo $pagina - 1; ?><?php echo $qs_pag; ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=tesoreria&page=<?php echo $i; ?><?php echo $qs_pag; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=tesoreria&page=<?php echo $pagina + 1; ?><?php echo $qs_pag; ?>">&rsaquo;</a>
          <a href="?m=tesoreria&page=<?php echo $total_paginas; ?><?php echo $qs_pag; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

  <!-- TAB: CONCILIACIÓN BANCARIA -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'conciliacion' ? 'active' : ''; ?>" data-tab="conciliacion">
    <?php
    $saldo_libros = $saldo['saldo'];
    ?>
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-scale-balanced"></i> Conciliación Bancaria</h3>
      <p style="font-size: 11px; color: var(--text3); margin-bottom: 16px;">
        Resumen del saldo contable registrado en movimientos de caja y las cuentas bancarias configuradas en el sistema.
      </p>

      <?php if (count($todas_cuentas) == 0): ?>
        <div style="text-align: center; padding: 40px; color: var(--text3);">
          <i class="fa-solid fa-building-columns" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
          <p>No hay cuentas bancarias configuradas para conciliar.</p>
          <p style="font-size: 11px; margin-top: 4px;">Configure cuentas bancarias en el sistema para asociarlas con los movimientos de caja registrados.</p>
        </div>
      <?php endif; ?>

      <div class="dayq-grid-2" style="margin-bottom: 16px;">
        <div style="background: var(--card2); padding: 16px; border-radius: 8px; border-left: 4px solid var(--accent);">
          <h4 style="font-size: 12px; color: var(--accent); margin-bottom: 8px; font-weight: 700; text-transform: uppercase;">
            <i class="fa-solid fa-book"></i> Saldo en Libros
          </h4>
          <div style="font-size: 26px; font-weight: 700; color: var(--accent); font-family: 'DM Mono', monospace;">
            $<?php echo dayq_formato_moneda($saldo_libros); ?>
          </div>
          <div style="font-size: 11px; color: var(--text3); margin-top: 4px;">
            Según movimientos de caja registrados (Entradas - Salidas)
          </div>
        </div>
        <div style="background: var(--card2); padding: 16px; border-radius: 8px; border-left: 4px solid var(--green);">
          <h4 style="font-size: 12px; color: var(--green); margin-bottom: 8px; font-weight: 700; text-transform: uppercase;">
            <i class="fa-solid fa-building-columns"></i> Cuentas Bancarias
          </h4>
          <div style="font-size: 26px; font-weight: 700; color: var(--green); font-family: 'DM Mono', monospace;">
            <?php echo count($todas_cuentas); ?>
          </div>
          <div style="font-size: 11px; color: var(--text3); margin-top: 4px;">
            Cuenta(s) bancaria(s) configurada(s) en el sistema
          </div>
        </div>
      </div>

      <!-- Listado de cuentas bancarias configuradas -->
      <?php if (count($todas_cuentas) > 0): ?>
      <h4 style="font-size: 12px; font-weight: 700; color: var(--text); margin-bottom: 8px;">Cuentas Bancarias Configuradas</h4>
      <div class="dayq-table-wrap">
        <table class="dayq-table">
          <thead>
            <tr>
              <th>Banco</th>
              <th>Nombre de la Cuenta</th>
              <th>Número</th>
              <th>Tipo</th>
              <th>Titular</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($todas_cuentas as $cta): ?>
            <tr>
              <td style="font-weight: 600;"><?php echo htmlspecialchars(isset($cta['nombre_banco']) ? $cta['nombre_banco'] : '-'); ?></td>
              <td><?php echo htmlspecialchars($cta['nombre_banco_cuenta']); ?></td>
              <td style="font-family: 'DM Mono', monospace;"><?php echo htmlspecialchars($cta['numero_banco_cuenta']); ?></td>
              <td><?php echo htmlspecialchars(isset($cta['nombre_tipo_cuenta_banco']) ? $cta['nombre_tipo_cuenta_banco'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cta['nombre_titular_cuenta']) ? $cta['nombre_titular_cuenta'] : '-'); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- TAB: CUENTAS BANCARIAS -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'cuentas' ? 'active' : ''; ?>" data-tab="cuentas">
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-building-columns"></i> Cuentas Bancarias</h3>
	  <p style="font-size: 11px; color: var(--text3); margin-bottom: 16px;">
        Cuentas bancarias activas registradas en el sistema. Los saldos se gestionan desde los movimientos de caja.
      </p>

      <?php if (count($todas_cuentas) > 0): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 12px;">
          <?php foreach ($todas_cuentas as $cta): ?>
            <div style="background: linear-gradient(135deg, var(--card2), var(--card)); padding: 16px; border-radius: 10px; border: 1px solid var(--border);">
              <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(79,142,247,0.15); display: flex; align-items: center; justify-content: center; font-size: 16px; color: #4f8ef7;"><i class="fa-solid fa-building-columns"></i></div>
                <div>
                  <div style="font-weight: 600; font-size: 12px;"><?php echo htmlspecialchars($cta['nombre_banco_cuenta']); ?></div>
                  <div style="font-size: 10px; color: var(--text3);"><?php echo htmlspecialchars(isset($cta['nombre_banco']) ? $cta['nombre_banco'] : 'Sin banco asignado'); ?></div>
                </div>
              </div>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 11px;">
                <div>
                  <div style="color: var(--text3); font-weight: 600; text-transform: uppercase;">Número</div>
                  <div style="font-family: 'DM Mono', monospace; font-weight: 500;"><?php echo htmlspecialchars($cta['numero_banco_cuenta']); ?></div>
                </div>
                <div>
                  <div style="color: var(--text3); font-weight: 600; text-transform: uppercase;">Tipo</div>
                  <div><?php echo htmlspecialchars(isset($cta['nombre_tipo_cuenta_banco']) ? $cta['nombre_tipo_cuenta_banco'] : '-'); ?></div>
                </div>
                <div style="grid-column: 1 / -1;">
                  <div style="color: var(--text3); font-weight: 600; text-transform: uppercase;">Titular</div>
                  <div><?php echo htmlspecialchars(isset($cta['nombre_titular_cuenta']) ? $cta['nombre_titular_cuenta'] : '-'); ?></div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div style="margin-top: 16px; background: var(--card2); padding: 14px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <div style="font-size: 11px; color: var(--text3); font-weight: 600; text-transform: uppercase;">Total Cuentas Bancarias</div>
            <div style="font-size: 10px; color: var(--text3);">Configuradas y activas en el sistema</div>
          </div>
		  <div style="font-size: 22px; font-weight: 700; color: var(--green); font-family: 'DM Mono', monospace;">
            <?php echo count($todas_cuentas); ?>
          </div>
        </div>
      <?php else: ?>
        <div style="text-align: center; padding: 40px; color: var(--text3);">
          <i class="fa-solid fa-building-columns" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
          <p>No hay cuentas bancarias configuradas en el sistema.</p>
          <p style="font-size: 11px; margin-top: 4px;">Las cuentas bancarias se gestionan desde el módulo de aliados estratégicos, donde se asignan bancos y cuentas a cada aliado.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
function actualizarTesoreria() {
  var desde = document.getElementById('fecha_desde').value;
  var hasta = document.getElementById('fecha_hasta').value;
  var m = window.location.search.match(/[?&]tab=([^&]*)/);
  var tab = m ? decodeURIComponent(m[1].replace(/\+/g, ' ')) : 'movimientos';
  window.location.href = '?m=tesoreria&tab=' + encodeURIComponent(tab) + '&fecha_desde=' + encodeURIComponent(desde) + '&fecha_hasta=' + encodeURIComponent(hasta);
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
