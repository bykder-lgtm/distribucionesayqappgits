<?php
/**
 * app/admin/administrativo/liquidacion.php
 * Módulo de Liquidación - Cálculo de márgenes y comparativos
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_liquidacion_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);
$liq_service = new DayqLiquidacionService($conectar);

$dayq_page_title = 'Liquidación de Créditos';
include __DIR__ . '/layout_header.php';

$accion = dayq_get_str('accion', '');
$cod_credito = dayq_get_int('cod_credito', 0);

// Si se solicita liquidación de un crédito específico
$liquidacion_especifica = null;
if ($accion === 'calcular' && $cod_credito > 0) {
    $credito = $db_service->getCreditoDetalle($cod_credito);
    if ($credito && $credito['cod_cuentas_cobrar']) {
        $liquidacion_especifica = $liq_service->getComparativoLiquidacion($credito['cod_cuentas_cobrar'], $cod_credito);
    }
}

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
$fecha_desde = isset($_GET['fecha_desde']) && $_GET['fecha_desde'] !== '' ? dayq_get_str('fecha_desde') : null;
$fecha_hasta = isset($_GET['fecha_hasta']) && $_GET['fecha_hasta'] !== '' ? dayq_get_str('fecha_hasta') : null;
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-file-invoice-dollar"></i> Liquidación de Créditos</h1>
  </div>

  <!-- BUSCADOR -->
  <div class="dayq-section">
    <div style="display: flex; gap: 10px; margin-bottom: 12px;">
      <input type="text" id="buscar" placeholder="Buscar crédito (ID, cliente, comercio)..." style="flex: 1; padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <input type="date" id="fecha_desde" value="<?php echo isset($fecha_desde) ? $fecha_desde : ''; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);" placeholder="Desde">
      <input type="date" id="fecha_hasta" value="<?php echo isset($fecha_hasta) ? $fecha_hasta : ''; ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text);" placeholder="Hasta">
      <button class="dayq-btn dayq-btn-primary" onclick="buscarLiquidaciones()">Buscar</button>
    </div>
  </div>

  <!-- SI HAY LIQUIDACIÓN ESPECÍFICA, MOSTRARLA -->
  <?php if ($liquidacion_especifica): ?>
    <div class="dayq-section">
      <h3 class="dayq-section-title">📊 Análisis Comparativo de Liquidación</h3>
      <div class="dayq-grid-2">
        <!-- LIQUIDACIÓN COMERCIAL -->
        <div style="background: var(--card2); padding: 16px; border-radius: 8px; border-left: 4px solid var(--accent);">
          <h4 style="color: var(--accent); margin-bottom: 12px; font-size: 12px; font-weight: 700; text-transform: uppercase;">Cálculo Comercial (Cliente)</h4>
          <table style="width: 100%; font-size: 11px;">
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Valor Contado:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_especifica['comercial']['valor_contado']); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Interés Aplicado:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;"><?php echo dayq_formato_porcentaje($liquidacion_especifica['comercial']['interes_ptj']); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Recargo:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_especifica['comercial']['recargo']); ?></td>
            </tr>
            <tr style="background: rgba(79,142,247,0.1); border: 1px solid var(--border);">
              <td style="padding: 6px; font-weight: 700; color: var(--accent);">Valor Financiado:</td>
              <td style="padding: 6px; text-align: right; font-weight: 700; color: var(--accent);">$<?php echo dayq_formato_moneda($liquidacion_especifica['comercial']['valor_financiado']); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Nº Cuotas:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;"><?php echo $liquidacion_especifica['comercial']['numero_cuota']; ?></td>
            </tr>
            <tr>
              <td style="padding: 6px; color: var(--text3);">Cuota Mensual:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_especifica['comercial']['monto_cuota']); ?></td>
            </tr>
          </table>
        </div>

        <!-- LIQUIDACIÓN INTERNA -->
        <div style="background: var(--card2); padding: 16px; border-radius: 8px; border-left: 4px solid var(--green);">
          <h4 style="color: var(--green); margin-bottom: 12px; font-size: 12px; font-weight: 700; text-transform: uppercase;">Cálculo Interno (Flexitech)</h4>
          <table style="width: 100%; font-size: 11px;">
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Valor del Cliente:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_especifica['interna']['valor_cliente']); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Al Habilitador (70%):</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_especifica['interna']['valor_habilitador']); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">% Comisión:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;"><?php echo dayq_formato_porcentaje($liquidacion_especifica['interna']['comision_ptj']); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border);">
              <td style="padding: 6px; color: var(--text3);">Comisión:</td>
              <td style="padding: 6px; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_especifica['interna']['comision']); ?></td>
            </tr>
            <tr style="background: rgba(0,200,150,0.1); border: 1px solid var(--border);">
              <td style="padding: 6px; font-weight: 700; color: var(--green);">Utilidad Neta:</td>
              <td style="padding: 6px; text-align: right; font-weight: 700; color: var(--green);">$<?php echo dayq_formato_moneda($liquidacion_especifica['interna']['utilidad']); ?></td>
            </tr>
            <tr style="background: rgba(0,200,150,0.1);">
              <td style="padding: 6px; font-weight: 700; color: var(--green);">Margen Real:</td>
              <td style="padding: 6px; text-align: right; font-weight: 700; color: var(--green);"><?php echo dayq_formato_porcentaje($liquidacion_especifica['interna']['margen_real'], 1); ?></td>
            </tr>
          </table>
        </div>
      </div>

      <!-- VALIDACIÓN DE MARGEN -->
      <div style="margin-top: 12px; padding: 12px; background: <?php echo $liquidacion_especifica['margen_cumple_minimo'] ? 'rgba(0,200,150,0.1)' : 'rgba(255,94,122,0.1)'; ?>; border: 1px solid <?php echo $liquidacion_especifica['margen_cumple_minimo'] ? 'var(--green)' : 'var(--red)'; ?>; border-radius: 6px;">
        <p style="margin: 0; font-size: 12px; color: <?php echo $liquidacion_especifica['margen_cumple_minimo'] ? 'var(--green)' : 'var(--red)'; ?>;">
          <strong><?php echo $liquidacion_especifica['margen_cumple_minimo'] ? '✓ Margen válido' : '✗ Margen bajo'; ?></strong><br>
          Margen requerido: 15% | Margen actual: <?php echo dayq_formato_porcentaje($liquidacion_especifica['interna']['margen_real'], 1); ?>
        </p>
      </div>
    </div>
  <?php endif; ?>

  <!-- LISTADO DE CRÉDITOS PARA LIQUIDAR -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Créditos Disponibles para Liquidación</h3>
    <?php
    $tabla_creditos = $db_service->getCreditosTable($pagina, 10, $fecha_desde, $fecha_hasta, $buscar);
    $creditos = $tabla_creditos['items'];
    $total_paginas = $tabla_creditos['total_paginas'];
    ?>

    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Comercio</th>
          <th>Línea</th>
          <th>Valor Fin.</th>
          <th>Abonado</th>
          <th>Saldo</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($creditos) > 0): ?>
          <?php foreach ($creditos as $cred): ?>
            <tr>
              <td>#<?php echo $cred['cod_factura']; ?></td>
              <td><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></td>
              <td>$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></td>
              <td>$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
              <td><strong>$<?php echo dayq_formato_moneda((isset($cred['valor']) ? $cred['valor'] : 0) - (isset($cred['abonado']) ? $cred['abonado'] : 0)); ?></strong></td>
              <td><span class="badge <?php echo dayq_get_estado_clase($cred['nombre_estado_factura']); ?>">
                <?php echo dayq_get_estado_texto($cred['nombre_estado_factura']); ?>
              </span></td>
              <td>
                <a href="?m=liquidacion&accion=calcular&cod_credito=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn"><i class="fa-solid fa-calculator"></i> Liquidar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="9" style="text-align: center; padding: 20px; color: var(--text3);">
              No hay créditos en el período seleccionado
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=liquidacion&page=1">&laquo;</a>
          <a href="?m=liquidacion&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=liquidacion&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=liquidacion&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
          <a href="?m=liquidacion&page=<?php echo $total_paginas; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function buscarLiquidaciones() {
  const buscar = document.getElementById('buscar').value;
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  let url = '?m=liquidacion&buscar=' + encodeURIComponent(buscar);
  if (desde) url += '&fecha_desde=' + desde;
  if (hasta) url += '&fecha_hasta=' + hasta;
  window.location.href = url;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
