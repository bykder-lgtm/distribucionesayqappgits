<?php
/**
 * app/admin/administrativo/liquidaciones.php
 * Módulo de Liquidaciones - Vista dedicada con tabs Comercial e Interna
 * Diseño basado en análisis Flexitech: 2 tabs + gráfica donut
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_liquidacion_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);
$liq_service = new DayqLiquidacionService($conectar);

$dayq_page_title = 'Liquidaciones';
include __DIR__ . '/layout_header.php';

$tab_activo = isset($_GET['tab']) ? preg_replace('/[^a-z_]/', '', $_GET['tab']) : 'comercial';
$cod_credito = dayq_get_int('cod_credito', 0);
$buscar = dayq_get_str('buscar', '');
$pagina = dayq_get_int('page', 1);

// Obtener datos de liquidación si se seleccionó un crédito
$liquidacion_data = null;
$credito_seleccionado = null;
$error_liquidacion = '';
if ($cod_credito > 0) {
    $credito_seleccionado = $db_service->getCreditoDetalle($cod_credito);
    if (!$credito_seleccionado) {
        $error_liquidacion = 'No se encontró un crédito con el ID ingresado';
    } elseif (!$credito_seleccionado['cod_cuentas_cobrar']) {
        $error_liquidacion = 'El crédito no tiene información de cuentas por cobrar para liquidar';
    } else {
        $comparativo = $liq_service->getComparativoLiquidacion(
            $credito_seleccionado['cod_cuentas_cobrar'],
            $cod_credito
        );
        if ($comparativo) {
            $liquidacion_data = $comparativo;
        } else {
            $error_liquidacion = 'No se pudo calcular la liquidación. Verifique los datos del crédito.';
        }
    }
}
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-file-invoice-dollar"></i> Liquidaciones</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('liquidaciones')" title="Guía de liquidaciones"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <input type="text" id="buscar" placeholder="Buscar crédito (ID)..."
        value="<?php echo htmlspecialchars($buscar); ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 160px;">
      <input type="number" id="cod_credito_input" placeholder="ID Crédito..."
        value="<?php echo $cod_credito > 0 ? $cod_credito : ''; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; width: 120px;">
      <button class="dayq-btn dayq-btn-primary" onclick="buscarLiquidacion()">
        <i class="fa-solid fa-calculator"></i> Calcular
      </button>
    </div>
  </div>

  <!-- MENSAJES FLASH -->
  <?php if (isset($_GET['err']) && $_GET['err'] !== ''): ?>
    <div class="dayq-alert dayq-alert-danger"><?php echo htmlspecialchars($_GET['err']); ?></div>
  <?php endif; ?>
  <?php if ($error_liquidacion !== ''): ?>
    <?php if ($error_liquidacion === 'El crédito no tiene información de cuentas por cobrar para liquidar' && $credito_seleccionado): ?>
      <!-- Mensaje profesional para crédito sin cuentas por cobrar -->
      <div style="background: var(--card2); border: 1px solid var(--border); border-radius: 10px; overflow: hidden; margin-bottom: 16px;">
        <div style="display: flex; align-items: stretch;">
          <div style="width: 6px; background: linear-gradient(180deg, #f59e0b, #ef4444); flex-shrink: 0;"></div>
          <div style="flex: 1; padding: 20px;">
            <div style="display: flex; align-items: flex-start; gap: 14px;">
              <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(245,158,11,0.12); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 18px; color: #f59e0b;"></i>
              </div>
              <div style="flex: 1; min-width: 0;">
                <h4 style="margin: 0 0 4px; font-size: 14px; font-weight: 700; color: var(--text);">
                  Crédito sin registros contables
                </h4>
                <p style="margin: 0 0 8px; font-size: 12px; color: var(--text2); line-height: 1.5;">
                  El crédito <strong>#<?php echo (int)$credito_seleccionado['cod_info_factura_venta']; ?></strong>
                  (<?php echo htmlspecialchars(isset($credito_seleccionado['nombres_apellidos_tercero']) ? $credito_seleccionado['nombres_apellidos_tercero'] : 'Cliente desconocido'); ?>)
                  no tiene cuentas por cobrar asociadas. Esto puede ocurrir si el crédito fue creado
                  sin el flujo completo de activación financiera.
                </p>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                  <a href="?m=liquidaciones" class="dayq-btn" style="padding: 7px 14px; font-size: 11px;">
                    <i class="fa-solid fa-arrow-left"></i> Volver al listado
                  </a>
                  <a href="?m=credito_detalle&id=<?php echo (int)$credito_seleccionado['cod_info_factura_venta']; ?>" class="dayq-btn" style="padding: 7px 14px; font-size: 11px;">
                    <i class="fa-solid fa-eye"></i> Ver detalle del crédito
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <!-- Otros errores: alerta simple -->
      <div class="dayq-alert dayq-alert-danger">
        <i class="fa-solid fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error_liquidacion); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <!-- TABS -->
  <div class="dayq-section" style="padding: 0; border: none;">
    <div class="dayq-tabs">
      <button class="dayq-tab-btn <?php echo $tab_activo === 'comercial' ? 'active' : ''; ?>"
        onclick="cambiarTab('comercial')">
        <i class="fa-solid fa-store"></i> Liquidación Comercial
      </button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'interna' ? 'active' : ''; ?>"
        onclick="cambiarTab('interna')">
        <i class="fa-solid fa-building"></i> Liquidación Interna
      </button>
    </div>
  </div>

  <?php if ($liquidacion_data && $credito_seleccionado): ?>
    <!-- Header del crédito seleccionado -->
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; padding: 12px; background: var(--card2); border-radius: 8px;">
      <span style="font-size: 12px; color: var(--text3);">Crédito:</span>
      <strong style="color: var(--accent); font-size: 14px;">#<?php echo $credito_seleccionado['cod_factura']; ?></strong>
      <span style="color: var(--text3);">|</span>
      <span style="font-size: 12px; color: var(--text3);">Cliente:</span>
      <strong style="font-size: 12px;"><?php echo htmlspecialchars(isset($credito_seleccionado['nombres_apellidos_tercero']) ? $credito_seleccionado['nombres_apellidos_tercero'] : '-'); ?></strong>
      <span class="badge <?php echo dayq_get_estado_clase($credito_seleccionado['nombre_estado_factura']); ?>">
        <?php echo dayq_get_estado_texto($credito_seleccionado['nombre_estado_factura']); ?>
      </span>
    </div>

    <!-- TAB: LIQUIDACIÓN COMERCIAL -->
    <div class="dayq-tab-content <?php echo $tab_activo === 'comercial' ? 'active' : ''; ?>">
      <div class="dayq-section">
        <h3 class="dayq-section-title"><i class="fa-solid fa-store"></i> Liquidación Comercial <small style="color: var(--text3); font-weight: 400;">(Cliente)</small></h3>
        <div class="dayq-grid-2">
          <div style="background: var(--card2); padding: 20px; border-radius: 8px; border-left: 4px solid var(--accent);">
            <table style="width: 100%; font-size: 12px; border-collapse: collapse;">
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Valor Contado <span style="color: var(--text3); font-size: 10px;">(base sin interés)</span></td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_data['comercial']['valor_contado']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Valor Crédito <span style="color: var(--text3); font-size: 10px;">(monto registrado)</span></td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_data['comercial']['valor_credito']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Recargo Administrativo (<?php echo dayq_formato_porcentaje($liquidacion_data['comercial']['interes_ptj']); ?>)</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_data['comercial']['recargo']); ?></td>
              </tr>
              <tr style="background: rgba(79,142,247,0.08); border: 1px solid var(--border);">
                <td style="padding: 10px; font-weight: 700;">Valor Financiado (Cliente paga)</td>
                <td style="padding: 10px; text-align: right; font-weight: 700; color: var(--accent); font-size: 16px;">$<?php echo dayq_formato_moneda($liquidacion_data['comercial']['valor_financiado']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Cuota Seleccionada (<?php echo $liquidacion_data['comercial']['numero_cuota']; ?>)</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_data['comercial']['monto_cuota']); ?></td>
              </tr>
              <tr>
                <td style="padding: 10px 0; font-weight: 700; color: var(--text);">Total a Pagar (Cliente)</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 700; color: var(--yellow); font-size: 16px;">
                  $<?php echo dayq_formato_moneda($liquidacion_data['comercial']['monto_cuota'] * $liquidacion_data['comercial']['numero_cuota']); ?>
                </td>
              </tr>
            </table>
          </div>

          <!-- Resumen visual -->
          <div style="background: var(--card2); padding: 20px; border-radius: 8px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <div style="font-size: 11px; color: var(--text3); text-transform: uppercase; margin-bottom: 8px;">Distribución del Pago</div>
            <svg width="100" height="100" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="36" fill="none" stroke="#2a3350" stroke-width="14"/>
              <?php
              $circ = 2 * M_PI * 36;
              $total_com = $liquidacion_data['comercial']['valor_financiado'];
              $pct_contado = $total_com > 0 ? $liquidacion_data['comercial']['valor_contado'] / $total_com : 0.8;
              $dash_contado = $pct_contado * $circ;
              $dash_recargo = $circ - $dash_contado;
              ?>
              <circle cx="50" cy="50" r="36" fill="none" stroke="#4f8ef7" stroke-width="14"
                stroke-dasharray="<?php echo round($dash_contado, 1); ?> <?php echo round($circ - $dash_contado, 1); ?>"
                stroke-dashoffset="0" transform="rotate(-90 50 50)"/>
              <circle cx="50" cy="50" r="36" fill="none" stroke="#f7c948" stroke-width="14"
                stroke-dasharray="<?php echo round($dash_recargo, 1); ?> <?php echo round($circ - $dash_recargo, 1); ?>"
                stroke-dashoffset="-<?php echo round($dash_contado, 1); ?>" transform="rotate(-90 50 50)"/>
            </svg>
            <div style="display: flex; gap: 16px; margin-top: 12px;">
              <div style="display: flex; align-items: center; gap: 4px; font-size: 10px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #4f8ef7;"></span>
                Contado: $<?php echo dayq_formato_moneda($liquidacion_data['comercial']['valor_contado']); ?>
              </div>
              <div style="display: flex; align-items: center; gap: 4px; font-size: 10px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #f7c948;"></span>
                Recargo: $<?php echo dayq_formato_moneda($liquidacion_data['comercial']['recargo']); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- TAB: LIQUIDACIÓN INTERNA -->
    <div class="dayq-tab-content <?php echo $tab_activo === 'interna' ? 'active' : ''; ?>">
      <div class="dayq-section">
        <h3 class="dayq-section-title"><i class="fa-solid fa-building"></i> Liquidación Interna <small style="color: var(--text3); font-weight: 400;">(Flexitech)</small></h3>
        <div class="dayq-grid-2">
          <div style="background: var(--card2); padding: 20px; border-radius: 8px; border-left: 4px solid var(--green);">
            <table style="width: 100%; font-size: 12px; border-collapse: collapse;">
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Valor Contado</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_data['interna']['valor_cliente']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Línea de Crédito</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">
                  <span class="badge badge-blue"><?php echo htmlspecialchars(isset($credito_seleccionado['nombre_entidad_crediticia']) ? $credito_seleccionado['nombre_entidad_crediticia'] : '-'); ?></span>
                </td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">% Cobrado al Cliente</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;"><?php echo dayq_formato_porcentaje($liquidacion_data['comercial']['interes_ptj']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Valor Financiado (Cliente)</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda($liquidacion_data['comercial']['valor_financiado']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Cuotas</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;"><?php echo $liquidacion_data['comercial']['numero_cuota']; ?> cuotas</td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Fecha Aprobación</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">
                  <?php echo dayq_formato_fecha($credito_seleccionado['fecha_creacion']); ?>
                </td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Habilitador</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">
                  <?php echo htmlspecialchars(isset($credito_seleccionado['nombre_entidad_crediticia']) ? $credito_seleccionado['nombre_entidad_crediticia'] : 'Addi Colombia S.A.S.'); ?>
                </td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">% Cobrado por Addi</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;"><?php echo dayq_formato_porcentaje($liquidacion_data['interna']['comision_ptj']); ?></td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 10px 0; color: var(--text3);">Valor a Pagar a Habilitador</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($liquidacion_data['interna']['valor_habilitador']); ?></td>
              </tr>
              <tr style="background: rgba(0,200,150,0.08); border: 1px solid var(--border);">
                <td style="padding: 10px; font-weight: 700; color: var(--green);">Utilidad Flexitech</td>
                <td style="padding: 10px; text-align: right; font-weight: 700; color: var(--green); font-size: 16px;">$<?php echo dayq_formato_moneda($liquidacion_data['interna']['utilidad']); ?></td>
              </tr>
              <tr style="background: rgba(0,200,150,0.05);">
                <td style="padding: 10px 0; font-weight: 700; color: var(--text);">Margen Real</td>
                <td style="padding: 10px 0; text-align: right; font-weight: 700; color: var(--green); font-size: 16px;">
                  <?php echo dayq_formato_porcentaje($liquidacion_data['interna']['margen_real'], 1); ?>
                </td>
              </tr>
            </table>
          </div>

          <!-- Donut chart de distribución + validación -->
          <div>
            <div style="background: var(--card2); padding: 20px; border-radius: 8px; display: flex; flex-direction: column; align-items: center; margin-bottom: 12px;">
              <div style="font-size: 11px; color: var(--text3); text-transform: uppercase; margin-bottom: 12px;">Distribución de la Operación</div>
              <svg width="120" height="120" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="45" fill="none" stroke="#2a3350" stroke-width="16"/>
                <?php
                $circ_int = 2 * M_PI * 45;
                $total_int = $liquidacion_data['interna']['utilidad'] + $liquidacion_data['interna']['valor_habilitador'] + $liquidacion_data['interna']['comision'];
                $dash_hab = $total_int > 0 ? (($liquidacion_data['interna']['valor_habilitador'] + $liquidacion_data['interna']['comision']) / $total_int) * $circ_int : $circ_int * 0.85;
                $dash_util_int = $total_int > 0 ? ($liquidacion_data['interna']['utilidad'] / $total_int) * $circ_int : $circ_int * 0.15;
                ?>
                <circle cx="60" cy="60" r="45" fill="none" stroke="#4f8ef7" stroke-width="16"
                  stroke-dasharray="<?php echo round($dash_hab, 1); ?> <?php echo round($circ_int - $dash_hab, 1); ?>"
                  stroke-dashoffset="0" transform="rotate(-90 60 60)"/>
                <circle cx="60" cy="60" r="45" fill="none" stroke="#00c896" stroke-width="16"
                  stroke-dasharray="<?php echo round($dash_util_int, 1); ?> <?php echo round($circ_int - $dash_util_int, 1); ?>"
                  stroke-dashoffset="-<?php echo round($dash_hab, 1); ?>" transform="rotate(-90 60 60)"/>
                <text x="60" y="64" text-anchor="middle" fill="var(--text)" font-size="12" font-weight="700" font-family="DM Mono, monospace">
                  $<?php echo number_format($liquidacion_data['interna']['utilidad'] / 1000, 1); ?>K
                </text>
              </svg>
              <div style="display: flex; gap: 16px; margin-top: 12px;">
                <div style="display: flex; align-items: center; gap: 4px; font-size: 10px;">
                  <span style="width: 8px; height: 8px; border-radius: 50%; background: #4f8ef7;"></span>
                  A Habilitador: $<?php echo dayq_formato_moneda($liquidacion_data['interna']['valor_habilitador']); ?>
                </div>
                <div style="display: flex; align-items: center; gap: 4px; font-size: 10px;">
                  <span style="width: 8px; height: 8px; border-radius: 50%; background: #00c896;"></span>
                  Utilidad: $<?php echo dayq_formato_moneda($liquidacion_data['interna']['utilidad']); ?>
                </div>
              </div>
            </div>

            <!-- Validación de margen -->
            <div style="padding: 12px; background: <?php echo $liquidacion_data['margen_cumple_minimo'] ? 'rgba(0,200,150,0.1)' : 'rgba(255,94,122,0.1)'; ?>; border: 1px solid <?php echo $liquidacion_data['margen_cumple_minimo'] ? 'var(--green)' : 'var(--red)'; ?>; border-radius: 8px; font-size: 12px; text-align: center;">
              <strong style="color: <?php echo $liquidacion_data['margen_cumple_minimo'] ? 'var(--green)' : 'var(--red)'; ?>;">
                <i class="fa-solid <?php echo $liquidacion_data['margen_cumple_minimo'] ? 'fa-circle-check' : 'fa-circle-xmark'; ?>" style="margin-right: 4px;"></i>
                <?php echo $liquidacion_data['margen_cumple_minimo'] ? 'Esta operación cumple' : 'Esta operación NO cumple'; ?> 
                con el margen mínimo establecido (15.00%).
              </strong>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php else: ?>
    <!-- Estado vacío: no hay crédito seleccionado -->
    <div class="dayq-section">
      <div style="text-align: center; padding: 40px 20px 24px; color: var(--text3);">
        <i class="fa-solid fa-calculator" style="font-size: 40px; display: block; margin-bottom: 12px; opacity: 0.3;"></i>
        <h3 style="font-size: 15px; color: var(--text); margin-bottom: 4px;">Selecciona un Crédito</h3>
        <p style="font-size: 12px; margin-bottom: 8px;">
          Ingresa el ID del crédito arriba o selecciona uno del listado
        </p>
      </div>

      <!-- Listado de créditos disponibles -->
      <?php
      $tabla_creditos = $db_service->getCreditosTable($pagina, 10, null, null, $buscar);
      $creditos_disponibles = $tabla_creditos['items'];
      $total_paginas_liq = $tabla_creditos['total_paginas'];
      ?>
      <div style="border-top: 1px solid var(--border); padding-top: 16px;">
        <h4 style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text3); margin-bottom: 12px;">
          <i class="fa-solid fa-list"></i> Créditos disponibles
          <?php if ($buscar): ?>
            <span style="color: var(--accent); font-weight: 600;">para &quot;<?php echo htmlspecialchars($buscar); ?>&quot;</span>
          <?php endif; ?>
        </h4>
        <?php if (count($creditos_disponibles) > 0): ?>
          <div class="dayq-table-wrap" style="max-height: 360px; overflow-y: auto;">
            <table class="dayq-table" style="font-size: 11px;">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Línea</th>
                  <th style="text-align: right;">Valor</th>
                  <th>Estado</th>
                  <th style="text-align: center;">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($creditos_disponibles as $cred): ?>
                  <tr>
                    <td><strong>#<?php echo (int)$cred['cod_info_factura_venta']; ?></strong><?php if (!empty($cred['cod_factura']) && $cred['cod_factura'] !== '0'): ?> <small style="color:var(--text3);font-weight:400;">/ F:<?php echo $cred['cod_factura']; ?></small><?php endif; ?></td>
                    <td><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></td>
                    <td><span class="badge badge-info"><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></span></td>
                    <td style="text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></td>
                    <td><span class="badge <?php echo dayq_get_estado_clase($cred['nombre_estado_factura']); ?>"><?php echo dayq_get_estado_texto($cred['nombre_estado_factura']); ?></span></td>
                    <td style="text-align: center;">
                      <a href="?m=liquidaciones&cod_credito=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn" style="padding: 4px 10px; font-size: 10px;">
                        <i class="fa-solid fa-calculator"></i> Liquidar
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php if ($total_paginas_liq > 1): ?>
            <div class="dayq-pagination" style="margin-top: 12px;">
              <?php
              $liq_inicio = max(1, $pagina - 2);
              $liq_fin = min($total_paginas_liq, $pagina + 2);
              for ($i = $liq_inicio; $i <= $liq_fin; $i++):
              ?>
                <?php if ($i === $pagina): ?>
                  <span class="active"><?php echo $i; ?></span>
                <?php else: ?>
                  <a href="?m=liquidaciones&page=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>"><?php echo $i; ?></a>
                <?php endif; ?>
              <?php endfor; ?>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <div style="text-align: center; padding: 24px; color: var(--text3);">
            <i class="fa-solid fa-inbox" style="font-size: 20px; display: block; margin-bottom: 6px;"></i>
            <?php if ($buscar): ?>
              No se encontraron créditos con &quot;<?php echo htmlspecialchars($buscar); ?>&quot;
            <?php else: ?>
              No hay créditos disponibles para liquidar
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<!-- Modal de error profesional: ID requerido -->
<div id="modalErrorLiquidacion" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.55); z-index: 1000; align-items: center; justify-content: center;" onclick="if(event.target===this)this.style.display='none'">
  <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 28px 24px; width: 380px; max-width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.4); text-align: center;" onclick="event.stopPropagation()">
    <div style="width: 52px; height: 52px; border-radius: 50%; background: rgba(239,68,68,0.12); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; font-size: 24px; color: var(--red);">
      <i class="fa-solid fa-circle-exclamation"></i>
    </div>
    <h3 style="margin: 0 0 6px; font-size: 15px; font-weight: 700; color: var(--text);">ID de Crédito Requerido</h3>
    <p style="margin: 0 0 20px; font-size: 13px; color: var(--text2); line-height: 1.5;">
      Por favor ingresa un ID de crédito para calcular su liquidación.
    </p>
    <button type="button" class="dayq-btn dayq-btn-primary" onclick="document.getElementById('modalErrorLiquidacion').style.display='none'; document.getElementById('cod_credito_input').focus();" style="margin: 0 auto;">
      <i class="fa-solid fa-check"></i> Entendido
    </button>
  </div>
</div>

<script>
function cambiarTab(tab) {
  var cod = document.getElementById('cod_credito_input').value;
  window.location.href = '?m=liquidaciones&tab=' + tab + (cod ? '&cod_credito=' + cod : '');
}

function buscarLiquidacion() {
  var cod = document.getElementById('cod_credito_input').value;
  var q = document.getElementById('buscar').value;
  if (cod) {
    window.location.href = '?m=liquidaciones&cod_credito=' + cod;
  } else if (q) {
    window.location.href = '?m=liquidaciones&buscar=' + encodeURIComponent(q);
  } else {
    document.getElementById('modalErrorLiquidacion').style.display = 'flex';
  }
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
