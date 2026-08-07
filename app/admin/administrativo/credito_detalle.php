<?php
/**
 * app/admin/administrativo/credito_detalle.php
 * Detalle de Crédito - Información completa con 8 tabs según diseño Flexitech
 * Tabs: Resumen | Solicitud | Documentos | Liquidaciones | Pagos | Historial | Anulaciones | Comunicación
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_liquidacion_service.php';
require_once __DIR__ . '/includes/dayq_archivo_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$cod_credito = dayq_get_int('id', 0);
if ($cod_credito <= 0) {
    header('Location: ?m=creditos_lista');
    exit;
}

$db_service = new DayqDbService($conectar);
$liq_service = new DayqLiquidacionService($conectar);
$archivo_service = new DayqArchivoService($conectar);

$credito = $db_service->getCreditoDetalle($cod_credito);
if (!$credito) {
    echo "Crédito no encontrado";
    exit;
}

// ─── Guardar nota interna ───
$nota_guardada = false;
$nota_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && dayq_post('action') === 'guardar_nota_interna') {
    $texto = trim(dayq_post('nota_interna'));
    if ($texto === '') {
        $nota_error = 'El texto de la nota es obligatorio';
    } else {
        $admin_id = isset($_SESSION['cod_administrador']) ? (int)$_SESSION['cod_administrador'] : 0;
        $cuenta = isset($_SESSION['cuenta_actual']) ? dayq_e($conectar, $_SESSION['cuenta_actual']) : '';
        $fecha_ymd = date('Y-m-d');
        $fecha_hora = date('H:i:s');
        $fecha_creacion = date('Y-m-d H:i:s');
        $texto_e = dayq_e($conectar, $texto);
        $sql = "INSERT INTO tbl15_nota_observacion 
            (cod_info_factura_venta, nombre_nota_observacion, cuenta, cod_administrador, 
             fecha_ymd, fecha_hora, fecha_creacion, cod_tipo_nota_observacion, 
             codigo_estado_revision, cod_posicion, active)
            VALUES (
                $cod_credito, '$texto_e', '$cuenta', $admin_id,
                '$fecha_ymd', '$fecha_hora', '$fecha_creacion', 1,
                1, 0, 1
            )";
        if ($conectar->query($sql)) {
            header('Location: ?m=credito_detalle&id=' . $cod_credito . '&tab=comunicacion&nota_ok=1');
            exit;
        } else {
            $nota_error = 'Error al guardar la nota: ' . $conectar->error;
        }
    }
}

$nota_guardada = isset($_GET['nota_ok']) && $_GET['nota_ok'] === '1';

$dayq_page_title = 'Detalle de Crédito #' . (int)$credito['cod_info_factura_venta'] . (!empty($credito['cod_factura']) && $credito['cod_factura'] !== '0' ? ' / F:' . $credito['cod_factura'] : '');
include __DIR__ . '/layout_header.php';

$tab_activo = isset($_GET['tab']) ? preg_replace('/[^a-z_]/', '', $_GET['tab']) : 'resumen';
?>

<div class="dayq-container">
  <!-- Header del crédito -->
  <div class="dayq-topbar" style="margin-bottom:0;">
    <div class="dayq-topbar-left">
      <a href="?m=creditos_lista" class="dayq-btn" style="margin-right:12px;">← Volver</a>
      <h1 class="dayq-topbar-title">
        Crédito #<?php echo (int)$credito['cod_info_factura_venta']; ?><?php if (!empty($credito['cod_factura']) && $credito['cod_factura'] !== '0'): ?> <small style="color: var(--text3); font-weight: 400;">/ F:<?php echo htmlspecialchars($credito['cod_factura']); ?></small><?php endif; ?>
        <span class="badge <?php echo dayq_get_estado_clase($credito['nombre_estado_factura']); ?>">
          <?php echo dayq_get_estado_texto($credito['nombre_estado_factura']); ?>
        </span>
      </h1>
      <button class="dayq-help-btn" onclick="showModuleGuide('credito_detalle')" title="Guía del detalle de crédito"><i class="fa-solid fa-circle-question"></i></button>
    </div>
  </div>

  <!-- Breadcrumb de habilitador -->
  <div style="padding: 8px 0 12px; font-size: 12px; color: var(--text3); display: flex; gap: 6px; align-items: center;">
    <span class="chip"><?php echo 'CR-' . (int)$credito['cod_info_factura_venta']; ?><?php if (!empty($credito['cod_factura']) && $credito['cod_factura'] !== '0'): ?> / F:<?php echo htmlspecialchars($credito['cod_factura']); ?><?php endif; ?></span>
    <span style="color: var(--text3);">/</span>
    <span class="chip"><?php echo htmlspecialchars(isset($credito['nombre_entidad_crediticia']) ? $credito['nombre_entidad_crediticia'] : '-'); ?></span>
    <?php if (isset($credito['nombre_tienda'])): ?>
      <span style="color: var(--text3);">/</span>
      <span class="chip"><?php echo htmlspecialchars($credito['nombre_tienda']); ?></span>
    <?php endif; ?>
  </div>

  <!-- TABS -->
  <div class="dayq-section" style="padding: 0; border: none;">
    <div class="dayq-tabs">
      <button class="dayq-tab-btn <?php echo $tab_activo === 'resumen' ? 'active' : ''; ?>" onclick="cambiarTab('resumen')"><i class="fa-solid fa-chart-simple"></i> Resumen</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'solicitud' ? 'active' : ''; ?>" onclick="cambiarTab('solicitud')"><i class="fa-solid fa-file-pen"></i> Solicitud</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'documentos' ? 'active' : ''; ?>" onclick="cambiarTab('documentos')"><i class="fa-solid fa-folder-open"></i> Documentos</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'liquidaciones' ? 'active' : ''; ?>" onclick="cambiarTab('liquidaciones')"><i class="fa-solid fa-file-invoice-dollar"></i> Liquidaciones</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'pagos' ? 'active' : ''; ?>" onclick="cambiarTab('pagos')"><i class="fa-solid fa-money-bill-transfer"></i> Pagos</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'historial' ? 'active' : ''; ?>" onclick="cambiarTab('historial')"><i class="fa-solid fa-clock-rotate-left"></i> Historial</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'anulaciones' ? 'active' : ''; ?>" onclick="cambiarTab('anulaciones')"><i class="fa-solid fa-ban"></i> Anulaciones</button>
      <button class="dayq-tab-btn <?php echo $tab_activo === 'comunicacion' ? 'active' : ''; ?>" onclick="cambiarTab('comunicacion')"><i class="fa-solid fa-comments"></i> Comunicación</button>
    </div>
  </div>

  <!-- ======================== TAB: RESUMEN ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'resumen' ? 'active' : ''; ?>">
    <div class="dayq-grid-2" style="margin-bottom:16px;">
      <div class="dayq-section">
        <h3 class="dayq-section-title"><i class="fa-solid fa-user"></i> Información del Cliente</h3>
        <div class="info-grid">
          <div class="info-item">
            <span class="info-key">Nombre</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['nombres_apellidos_tercero']) ? $credito['nombres_apellidos_tercero'] : '-'); ?></span>
          </div>
          <div class="info-item">
            <span class="info-key">CC</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['identificacion_tercero']) ? $credito['identificacion_tercero'] : '-'); ?></span>
          </div>
          <div class="info-item">
            <span class="info-key">Teléfono</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['telefono1_tercero']) ? $credito['telefono1_tercero'] : '-'); ?></span>
          </div>
          <div class="info-item">
            <span class="info-key">Correo</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['correo_tercero']) ? $credito['correo_tercero'] : '-'); ?></span>
          </div>
        </div>
      </div>

      <div class="dayq-section">
        <h3 class="dayq-section-title"><i class="fa-solid fa-store"></i> Información del Comercio</h3>
        <div class="info-grid">
          <div class="info-item">
            <span class="info-key">Comercio</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['nombre_tienda']) ? $credito['nombre_tienda'] : '-'); ?></span>
          </div>
          <div class="info-item">
            <span class="info-key">NIT</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['tienda_nit']) ? $credito['tienda_nit'] : '-'); ?></span>
          </div>
          <div class="info-item">
            <span class="info-key">Dirección</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['tienda_direccion']) ? $credito['tienda_direccion'] : '-'); ?></span>
          </div>
          <div class="info-item">
            <span class="info-key">Línea de Crédito</span>
            <span class="info-val"><?php echo htmlspecialchars(isset($credito['nombre_entidad_crediticia']) ? $credito['nombre_entidad_crediticia'] : '-'); ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Resumen Financiero -->
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-chart-pie"></i> Resumen Financiero</h3>
      <?php
      $monto_deuda = isset($credito['monto_deuda']) ? $credito['monto_deuda'] : 0;
      $abonado = isset($credito['abonado']) ? $credito['abonado'] : 0;
      $valor_contado = isset($credito['total_precio_venta']) ? $credito['total_precio_venta'] : 0;
      $pendiente = $monto_deuda - $abonado;
      ?>
      <div class="dayq-grid-3">
        <div class="fin-summary-card" style="background: var(--card2); padding: 14px; border-radius: 8px; border-left: 4px solid var(--accent);">
          <div class="fin-summary-label">Valor Financiado</div>
          <div class="fin-summary-val" style="color: var(--accent);">$<?php echo dayq_formato_moneda($monto_deuda); ?></div>
          <div class="fin-summary-sub">Contado: $<?php echo dayq_formato_moneda($valor_contado); ?></div>
        </div>
        <div class="fin-summary-card" style="background: var(--card2); padding: 14px; border-radius: 8px; border-left: 4px solid var(--green);">
          <div class="fin-summary-label">Abonado</div>
          <div class="fin-summary-val" style="color: var(--green);">$<?php echo dayq_formato_moneda($abonado); ?></div>
          <div class="fin-summary-sub"><?php echo $monto_deuda > 0 ? round(($abonado / $monto_deuda) * 100, 1) : 0; ?>% del total</div>
        </div>
        <div class="fin-summary-card" style="background: var(--card2); padding: 14px; border-radius: 8px; border-left: 4px solid var(--yellow);">
          <div class="fin-summary-label">Saldo Pendiente</div>
          <div class="fin-summary-val" style="color: var(--yellow);">$<?php echo dayq_formato_moneda(max($pendiente, 0)); ?></div>
          <div class="fin-summary-sub"><?php echo isset($credito['numero_cuota']) ? $credito['numero_cuota'] . ' cuotas' : '-'; ?></div>
        </div>
      </div>

      <!-- Debug: Referencias del crédito -->
      <div style="margin-top: 14px; padding: 8px 14px; background: var(--card2); border-radius: 6px; border: 1px solid var(--border); font-size: 11px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <span style="color: var(--text3); text-transform: uppercase; font-weight: 700; letter-spacing: 0.4px; font-size: 9px;">🔍 Depuración:</span>
        <span style="display: flex; align-items: center; gap: 8px;">
          <span style="color: var(--text3);">N° Factura:</span>
          <code style="font-family: 'DM Mono', monospace; font-size: 12px; font-weight: 700; color: var(--accent); background: rgba(0,0,0,0.06); padding: 2px 8px; border-radius: 4px;">
            <?php echo htmlspecialchars(!empty($credito['cod_factura']) && $credito['cod_factura'] !== '0' ? $credito['cod_factura'] : '-'); ?>
          </code>
        </span>
        <span style="color: var(--text3);">|</span>
        <span style="display: flex; align-items: center; gap: 8px;">
          <span style="color: var(--text3);">ID Interno (cod_info_factura_venta):</span>
          <code style="font-family: 'DM Mono', monospace; font-size: 12px; font-weight: 700; color: var(--text); background: rgba(0,0,0,0.06); padding: 2px 8px; border-radius: 4px;">
            <?php echo (int)$cod_credito; ?>
          </code>
        </span>
        <?php if ($credito['cod_cuentas_cobrar']): ?>
          <span class="badge badge-success" style="font-size: 9px;">✔️ Liquidable</span>
        <?php else: ?>
          <span class="badge badge-danger" style="font-size: 9px;">❌ Sin cuentas por cobrar</span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Acciones rápidas -->
    <div class="dayq-section" style="margin-top: 12px;">
      <div style="display: flex; gap: 8px; flex-wrap: wrap;">
        <a href="?m=liquidaciones&cod_credito=<?php echo $cod_credito; ?>" class="dayq-btn dayq-btn-primary"><i class="fa-solid fa-calculator"></i> Liquidar</a>
        <a href="?m=anulaciones&accion=calcular&cod_credito=<?php echo $cod_credito; ?>" class="dayq-btn" style="background:rgba(255,94,122,0.15);color:var(--red);border-color:rgba(255,94,122,0.3);"><i class="fa-solid fa-ban"></i> Anular</a>
      </div>
    </div>
  </div>

  <!-- ======================== TAB: SOLICITUD ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'solicitud' ? 'active' : ''; ?>">
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-file-pen"></i> Datos de la Solicitud</h3>
      <div class="dayq-grid-2">
        <div style="background: var(--card2); padding: 16px; border-radius: 8px;">
          <table class="detail-table">
            <tr>
              <td class="detail-label">Fecha de Radicación</td>
              <td class="detail-val"><?php echo dayq_formato_fecha_hora(isset($credito['fecha_creacion']) ? $credito['fecha_creacion'] : ''); ?></td>
            </tr>
            <tr>
              <td class="detail-label">Producto / Descripción</td>
              <td class="detail-val">-</td>
            </tr>
            <tr>
              <td class="detail-label">Valor Contado</td>
              <td class="detail-val" style="font-weight: 700;">$<?php echo dayq_formato_moneda($valor_contado); ?></td>
            </tr>
            <tr>
              <td class="detail-label">Línea de Crédito</td>
              <td class="detail-val">
                <span class="badge badge-blue"><?php echo htmlspecialchars(isset($credito['nombre_entidad_crediticia']) ? $credito['nombre_entidad_crediticia'] : '-'); ?></span>
              </td>
            </tr>
          </table>
        </div>

        <div style="background: var(--card2); padding: 16px; border-radius: 8px;">
          <table class="detail-table">
            <tr>
              <td class="detail-label">N° Cuotas Seleccionadas</td>
              <td class="detail-val"><?php echo isset($credito['numero_cuota']) ? $credito['numero_cuota'] . ' cuotas' : '-'; ?></td>
            </tr>
            <tr>
              <td class="detail-label">Valor por Cuota</td>
              <td class="detail-val" style="font-weight: 700;">$<?php echo dayq_formato_moneda(isset($credito['monto_cuota']) ? $credito['monto_cuota'] : 0); ?></td>
            </tr>
            <tr>
              <td class="detail-label">Interés (%)</td>
              <td class="detail-val"><?php echo dayq_formato_porcentaje(isset($credito['interes_ptj']) ? $credito['interes_ptj'] : 0); ?></td>
            </tr>
            <tr>
              <td class="detail-label">Estado Actual</td>
              <td class="detail-val">
                <span class="badge <?php echo dayq_get_estado_clase($credito['nombre_estado_factura']); ?>">
                  <?php echo dayq_get_estado_texto($credito['nombre_estado_factura']); ?>
                </span>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <!-- Cambio de estado -->
      <?php if (isset($credito['nombre_estado_factura']) && $credito['nombre_estado_factura'] !== 'ANULADA'): ?>
      <div style="margin-top: 16px; padding: 16px; background: var(--card2); border-radius: 8px; border: 1px solid var(--border);">
        <h4 style="font-size: 12px; font-weight: 600; margin-bottom: 10px; color: var(--text);">
          <i class="fa-solid fa-arrows-rotate"></i> Cambiar Estado del Crédito
        </h4>
        <form method="POST" action="reg_dayq.php" style="display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap;">
          <input type="hidden" name="entity" value="estado_credito">
          <input type="hidden" name="id" value="<?php echo $cod_credito; ?>">
          <input type="hidden" name="redirect" value="credito_detalle">
          <div>
            <label style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 4px;">Nuevo Estado</label>
            <select name="nuevo_estado" style="padding: 8px 12px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
              <?php
              $est_actual = $credito['nombre_estado_factura'];
              $opts = [];
              if ($est_actual === 'ABIERTA') $opts = ['PENDIENTE', 'APROBADA', 'CERRADA'];
              elseif ($est_actual === 'PENDIENTE') $opts = ['ABIERTA', 'APROBADA', 'CERRADA'];
              elseif ($est_actual === 'APROBADA') $opts = ['ABIERTA', 'CERRADA'];
              elseif ($est_actual === 'CERRADA') $opts = ['ABIERTA'];
              foreach ($opts as $opt): ?>
                <option value="<?php echo $opt; ?>"><?php echo dayq_get_estado_texto($opt); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 16px;" onclick="return confirm('¿Está seguro de cambiar el estado del crédito a ' + this.form.nuevo_estado.options[this.form.nuevo_estado.selectedIndex].text + '?')">
            <i class="fa-solid fa-check"></i> Cambiar Estado
          </button>
        </form>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- ======================== TAB: DOCUMENTOS ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'documentos' ? 'active' : ''; ?>">
    <?php
    $archivos = $db_service->getCreditoArchivos($cod_credito);
    ?>
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-folder-open"></i> Documentos Adjuntos</h3>
      <?php if (count($archivos) > 0): ?>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <?php foreach ($archivos as $archivo): ?>
            <div class="voucher-block" style="display: flex; align-items: center; gap: 12px; background: var(--card2); padding: 12px 16px; border-radius: 8px; border: 1px solid var(--border);">
              <div style="font-size: 24px;">📄</div>
              <div style="flex: 1;">
                <div style="font-weight: 600; font-size: 12px;"><?php echo htmlspecialchars($archivo['nombre_archivo_adjunto']); ?></div>
                <div style="font-size: 10px; color: var(--text3);">
                  <?php echo htmlspecialchars(isset($archivo['tipo_archivo']) ? $archivo['tipo_archivo'] : 'Documento'); ?>
                  · <?php echo dayq_formato_fecha_hora($archivo['fecha_creacion']); ?>
                </div>
              </div>
              <div style="display: flex; gap: 6px;">
                <a href="?m=descargar_archivo&id=<?php echo $archivo['cod_archivo_adjunto']; ?>" class="dayq-btn" style="padding: 6px 10px; font-size: 11px;">
                  <i class="fa-solid fa-download"></i> Descargar
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div style="text-align: center; padding: 40px; color: var(--text3);">
          <i class="fa-solid fa-folder-open" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
          <p>No hay documentos adjuntos para este crédito</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- ======================== TAB: LIQUIDACIONES ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'liquidaciones' ? 'active' : ''; ?>">
    <?php
    if ($credito['cod_cuentas_cobrar']) {
      $liq_comercial = $liq_service->getLiquidacionComercial($credito['cod_cuentas_cobrar']);
      $liq_interna = $liq_service->getLiquidacionInterna($cod_credito);
    ?>
      <div class="dayq-grid-2">
        <!-- Liquidación Comercial (Cliente) -->
        <div class="dayq-section">
          <h3 class="dayq-section-title" style="color: var(--accent);">Liquidación Comercial <small style="color: var(--text3); font-weight: 400;">(Cliente)</small></h3>
          <div style="background: var(--card2); padding: 16px; border-radius: 8px; border-left: 4px solid var(--accent);">
            <table class="detail-table" style="width: 100%;">
              <tr>
                <td class="detail-label">Valor Contado</td>
                <td class="detail-val">$<?php echo dayq_formato_moneda($liq_comercial['valor_contado']); ?></td>
              </tr>
              <tr>
                <td class="detail-label">Recargo Administrativo (<?php echo dayq_formato_porcentaje($liq_comercial['interes_ptj']); ?>)</td>
                <td class="detail-val">$<?php echo dayq_formato_moneda($liq_comercial['recargo']); ?></td>
              </tr>
              <tr style="background: rgba(79,142,247,0.08); border-radius: 6px;">
                <td class="detail-label" style="font-weight: 700;">Valor Financiado (Cliente paga)</td>
                <td class="detail-val" style="color: var(--accent); font-weight: 700; font-size: 15px;">$<?php echo dayq_formato_moneda($liq_comercial['valor_financiado']); ?></td>
              </tr>
              <tr>
                <td class="detail-label">Cuota Seleccionada (<?php echo $liq_comercial['numero_cuota']; ?>)</td>
                <td class="detail-val">$<?php echo dayq_formato_moneda($liq_comercial['monto_cuota']); ?></td>
              </tr>
              <tr>
                <td class="detail-label" style="font-weight: 700;">Total a Pagar (Cliente)</td>
                <td class="detail-val" style="color: var(--yellow); font-weight: 700; font-size: 15px;">$<?php echo dayq_formato_moneda($liq_comercial['monto_cuota'] * $liq_comercial['numero_cuota']); ?></td>
              </tr>
            </table>
          </div>
        </div>

        <!-- Liquidación Interna (Flexitech) -->
        <div class="dayq-section">
          <h3 class="dayq-section-title" style="color: var(--green);">Liquidación Interna <small style="color: var(--text3); font-weight: 400;">(Flexitech)</small></h3>
          <div style="background: var(--card2); padding: 16px; border-radius: 8px; border-left: 4px solid var(--green);">
            <table class="detail-table" style="width: 100%;">
              <tr>
                <td class="detail-label">Valor Contado</td>
                <td class="detail-val">$<?php echo dayq_formato_moneda($liq_interna['valor_cliente']); ?></td>
              </tr>
              <tr>
                <td class="detail-label">% Cobrado por <?php echo htmlspecialchars(isset($credito['nombre_entidad_crediticia']) ? $credito['nombre_entidad_crediticia'] : 'Habilitador'); ?> (<?php echo dayq_formato_porcentaje($liq_interna['porcentaje_habilitador']); ?>)</td>
                <td class="detail-val">$<?php echo dayq_formato_moneda($liq_interna['valor_habilitador']); ?></td>
              </tr>
              <tr>
                <td class="detail-label">Comisión (<?php echo dayq_formato_porcentaje($liq_interna['comision_ptj']); ?>)</td>
                <td class="detail-val">$<?php echo dayq_formato_moneda($liq_interna['comision']); ?></td>
              </tr>
              <tr style="background: rgba(0,200,150,0.08); border-radius: 6px;">
                <td class="detail-label" style="font-weight: 700;">Utilidad Flexitech</td>
                <td class="detail-val" style="color: var(--green); font-weight: 700; font-size: 15px;">$<?php echo dayq_formato_moneda($liq_interna['utilidad']); ?></td>
              </tr>
              <tr>
                <td class="detail-label">Margen Real</td>
                <td class="detail-val" style="color: var(--green); font-weight: 700;">
                  <?php echo dayq_formato_porcentaje($liq_interna['margen_real']); ?>
                  <?php if ($liq_interna['margen_real'] >= 15): ?>
                    <span class="badge badge-success" style="margin-left: 6px;">Cumple margen</span>
                  <?php else: ?>
                    <span class="badge badge-danger" style="margin-left: 6px;">Margen bajo</span>
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </div>

          <!-- Mini donut chart de distribución -->
          <div style="margin-top: 12px; background: var(--card2); padding: 12px; border-radius: 8px; display: flex; align-items: center; gap: 16px;">
            <svg width="80" height="80" viewBox="0 0 80 80">
              <circle cx="40" cy="40" r="28" fill="none" stroke="#2a3350" stroke-width="12"/>
              <?php
              $circ = 2 * M_PI * 28;
              $pct_hab = $liq_interna['valor_habilitador'] + $liq_interna['comision'];
              $total_op = $liq_interna['utilidad'] + $pct_hab;
              $dash_hab = $total_op > 0 ? ($pct_hab / $total_op) * $circ : $circ * 0.85;
              $dash_util = $total_op > 0 ? ($liq_interna['utilidad'] / $total_op) * $circ : $circ * 0.15;
              ?>
              <circle cx="40" cy="40" r="28" fill="none" stroke="#4f8ef7" stroke-width="12"
                stroke-dasharray="<?php echo round($dash_hab, 1); ?> <?php echo round($circ - $dash_hab, 1); ?>"
                stroke-dashoffset="0" transform="rotate(-90 40 40)"/>
              <circle cx="40" cy="40" r="28" fill="none" stroke="#00c896" stroke-width="12"
                stroke-dasharray="<?php echo round($dash_util, 1); ?> <?php echo round($circ - $dash_util, 1); ?>"
                stroke-dashoffset="-<?php echo round($dash_hab, 1); ?>" transform="rotate(-90 40 40)"/>
            </svg>
            <div style="flex: 1;">
              <div style="font-size: 10px; color: var(--text3);">Distribución</div>
              <div style="display: flex; gap: 12px; margin-top: 4px; font-size: 10px;">
                <div><span style="color:#4f8ef7;">■</span> A habilitador: $<?php echo dayq_formato_moneda($pct_hab); ?></div>
                <div><span style="color:#00c896;">■</span> Utilidad: $<?php echo dayq_formato_moneda($liq_interna['utilidad']); ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Validación de margen -->
      <div class="dayq-section" style="margin-top: 12px;">
        <div style="padding: 12px 16px; background: <?php echo $liq_interna['margen_real'] >= 15 ? 'rgba(0,200,150,0.1)' : 'rgba(255,94,122,0.1)'; ?>; border: 1px solid <?php echo $liq_interna['margen_real'] >= 15 ? 'var(--green)' : 'var(--red)'; ?>; border-radius: 8px; font-size: 12px;">
          <strong style="color: <?php echo $liq_interna['margen_real'] >= 15 ? 'var(--green)' : 'var(--red)'; ?>;">
            <?php echo $liq_interna['margen_real'] >= 15 ? '✓' : '✗'; ?> Esta operación
            <?php echo $liq_interna['margen_real'] >= 15 ? 'cumple' : 'NO cumple'; ?> con el margen mínimo establecido (15.00%).
          </strong>
          <span style="color: var(--text3); margin-left: 8px;">Margen actual: <?php echo dayq_formato_porcentaje($liq_interna['margen_real']); ?></span>
        </div>
      </div>
    <?php } else { ?>
      <div class="dayq-section">
        <div style="text-align: center; padding: 40px; color: var(--text3);">
          <i class="fa-solid fa-file-invoice-dollar" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
          <p>No hay información de liquidación disponible para este crédito</p>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- ======================== TAB: PAGOS ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'pagos' ? 'active' : ''; ?>">
    <?php
    if ($credito['cod_cuentas_cobrar']) {
      $abonos = $db_service->getCuentaAbonos($credito['cod_cuentas_cobrar']);
    ?>
      <div class="dayq-section">
        <h3 class="dayq-section-title"><i class="fa-solid fa-money-bill-transfer"></i> Historial de Abonos</h3>
        <?php if (count($abonos) > 0): ?>
          <div class="dayq-table-wrap">
            <table class="dayq-table">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Monto</th>
                  <th>Forma de Pago</th>
                  <th>Registrado</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($abonos as $abono): ?>
                  <tr>
                    <td><?php echo dayq_formato_fecha($abono['fecha_pago']); ?></td>
                    <td><strong style="color: var(--green);">$<?php echo dayq_formato_moneda($abono['abonado']); ?></strong></td>
                    <td><?php echo htmlspecialchars($abono['cod_tipo_forma_pago']); ?></td>
                    <td style="color: var(--text3); font-size: 11px;"><?php echo dayq_formato_fecha_hora($abono['fecha_creacion']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div style="margin-top: 12px; text-align: right;">
            <strong>Total Abonado:</strong> <span style="color: var(--green); font-weight: 700;">$<?php echo dayq_formato_moneda($abonado); ?></span>
            <span style="margin: 0 8px; color: var(--text3);">|</span>
            <strong>Pendiente:</strong> <span style="color: var(--yellow); font-weight: 700;">$<?php echo dayq_formato_moneda(max($pendiente, 0)); ?></span>
          </div>
        <?php else: ?>
          <div style="text-align: center; padding: 40px; color: var(--text3);">
            <i class="fa-solid fa-credit-card" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
            <p>No hay abonos registrados para este crédito</p>
          </div>
        <?php endif; ?>
      </div>
    <?php } else { ?>
      <div class="dayq-section">
        <div style="text-align: center; padding: 40px; color: var(--text3);">
          <i class="fa-solid fa-credit-card" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
          <p>No hay información de pagos disponible</p>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- ======================== TAB: HISTORIAL ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'historial' ? 'active' : ''; ?>">
    <?php
    $notas = $db_service->getCreditoNotas($cod_credito);
    ?>
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-clock-rotate-left"></i> Historial de Cambios y Notas</h3>

      <!-- Línea de tiempo -->
      <div style="display: flex; flex-direction: column; gap: 12px;">
        <!-- Evento: Creación -->
        <div style="display: flex; gap: 12px;">
          <div style="display: flex; flex-direction: column; align-items: center; width: 24px;">
            <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--accent); border: 2px solid var(--accent);"></div>
            <div style="width: 2px; flex: 1; background: var(--border); min-height: 20px;"></div>
          </div>
          <div style="flex: 1; background: var(--card2); padding: 10px 14px; border-radius: 6px;">
            <div style="font-size: 11px; font-weight: 600; color: var(--accent);">Crédito Creado</div>
            <div style="font-size: 11px; color: var(--text3);">
              <span style="color: var(--text);">#<?php echo (int)$credito['cod_info_factura_venta']; ?><?php if (!empty($credito['cod_factura']) && $credito['cod_factura'] !== '0'): ?> / F:<?php echo htmlspecialchars($credito['cod_factura']); ?><?php endif; ?></span>
              · Valor: $<?php echo dayq_formato_moneda($valor_contado); ?>
            </div>
            <div style="font-size: 10px; color: var(--text3); margin-top: 2px;">
              <?php echo dayq_formato_fecha_hora($credito['fecha_creacion']); ?>
            </div>
          </div>
        </div>

        <!-- Evento: Estado actual -->
        <div style="display: flex; gap: 12px;">
          <div style="display: flex; flex-direction: column; align-items: center; width: 24px;">
            <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--green); border: 2px solid var(--green);"></div>
            <div style="width: 2px; flex: 1; background: var(--border); min-height: 0;"></div>
          </div>
          <div style="flex: 1; background: var(--card2); padding: 10px 14px; border-radius: 6px;">
            <div style="font-size: 11px; font-weight: 600; color: var(--green);">Estado Actual: <?php echo dayq_get_estado_texto($credito['nombre_estado_factura']); ?></div>
            <div style="font-size: 10px; color: var(--text3); margin-top: 2px;">
              Saldo: $<?php echo dayq_formato_moneda(max($pendiente, 0)); ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Notas -->
      <?php if (count($notas) > 0): ?>
        <h4 style="font-size: 12px; font-weight: 600; color: var(--text3); margin: 16px 0 8px; text-transform: uppercase; letter-spacing: 0.5px;">Notas y Observaciones</h4>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <?php foreach ($notas as $nota): ?>
            <div style="background: var(--card2); padding: 12px 14px; border-radius: 6px; border-left: 3px solid var(--accent);">
              <p style="font-size: 12px; color: var(--text); margin: 0;"><?php echo htmlspecialchars($nota['observacion']); ?></p>
              <small style="color: var(--text3);">Admin #<?php echo $nota['cod_administrador']; ?> · <?php echo dayq_formato_fecha_hora($nota['fecha_creacion']); ?></small>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- ======================== TAB: ANULACIONES ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'anulaciones' ? 'active' : ''; ?>">
    <?php
    $impacto_anulacion = $liq_service->getImpactoAnulacion($cod_credito);
    ?>
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-ban"></i> Información de Anulación</h3>

      <?php if ($impacto_anulacion): ?>
        <!-- Impacto financiero en grid -->
        <div class="impact-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 16px;">
          <div class="impact-card" style="background: var(--card2); padding: 12px; border-radius: 8px; border: 1px solid var(--border);">
            <div class="impact-label" style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600;">Valor Financiado</div>
            <div class="impact-val" style="font-size: 16px; font-weight: 700; color: var(--accent);">$<?php echo dayq_formato_moneda($impacto_anulacion['valor_financiado']); ?></div>
          </div>
          <div class="impact-card" style="background: var(--card2); padding: 12px; border-radius: 8px; border: 1px solid var(--border);">
            <div class="impact-label" style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600;">% Penalidad Hab.</div>
            <div class="impact-val" style="font-size: 16px; font-weight: 700; color: var(--yellow);"><?php echo dayq_formato_porcentaje($impacto_anulacion['comision_ptj'] + $impacto_anulacion['aval_ptj']); ?></div>
          </div>
          <div class="impact-card" style="background: var(--card2); padding: 12px; border-radius: 8px; border: 1px solid var(--border);">
            <div class="impact-label" style="font-size: 10px; color: var(--text3); text-transform: uppercase; font-weight: 600;">Costos Asociados</div>
            <div class="impact-val" style="font-size: 16px; font-weight: 700;">$<?php echo dayq_formato_moneda($impacto_anulacion['penalidad']); ?></div>
          </div>
          <div class="impact-card" style="background: rgba(255,94,122,0.08); padding: 12px; border-radius: 8px; border: 1px solid rgba(255,94,122,0.3);">
            <div class="impact-label" style="font-size: 10px; color: var(--red); text-transform: uppercase; font-weight: 600;">Pérdida Total</div>
            <div class="impact-val" style="font-size: 16px; font-weight: 700; color: var(--red);">-$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?></div>
          </div>
        </div>

        <!-- Tabla de detalle -->
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
                <td>$<?php echo dayq_formato_moneda($impacto_anulacion['valor_financiado']); ?></td>
                <td>$<?php echo dayq_formato_moneda($impacto_anulacion['penalidad']); ?></td>
                <td>$0</td>
                <td style="color: var(--red); font-weight: 700;">-$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?></td>
              </tr>
              <tr>
                <td><strong>% Penalidad</strong></td>
                <td>—</td>
                <td><?php echo dayq_formato_porcentaje($impacto_anulacion['comision_ptj'] + $impacto_anulacion['aval_ptj']); ?></td>
                <td>—</td>
                <td>—</td>
              </tr>
              <tr>
                <td><strong>Detalle</strong></td>
                <td>Abonado: $<?php echo dayq_formato_moneda($impacto_anulacion['abonado']); ?></td>
                <td>Comisión: $<?php echo dayq_formato_moneda($impacto_anulacion['comision_ptj'] > 0 ? ($impacto_anulacion['valor_financiado'] * $impacto_anulacion['comision_ptj']) / 100 : 0); ?><br>
                    Aval: $<?php echo dayq_formato_moneda($impacto_anulacion['aval_ptj'] > 0 ? ($impacto_anulacion['valor_financiado'] * $impacto_anulacion['aval_ptj']) / 100 : 0); ?></td>
                <td>Viajes/viáticos: $0</td>
                <td style="color: var(--red); font-weight: 700;">Utilidad perdida</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div style="text-align: right; padding: 12px; background: rgba(255,94,122,0.08); border-radius: 8px; border: 1px solid rgba(255,94,122,0.2);">
          <strong style="color: var(--red);">Resumen:</strong>
          <span style="color: var(--text3); margin: 0 8px;">Total penalidades y costos = $<?php echo dayq_formato_moneda($impacto_anulacion['penalidad']); ?></span>
          <span style="margin: 0 4px;">|</span>
          <strong style="color: var(--red); font-size: 16px;">Utilidad perdida: -$<?php echo dayq_formato_moneda($impacto_anulacion['perdida_total']); ?></strong>
        </div>

        <!-- Acción -->
        <div style="margin-top: 12px;">
          <a href="?m=anulaciones&accion=calcular&cod_credito=<?php echo $cod_credito; ?>" class="dayq-btn" style="background: rgba(255,94,122,0.15); color: var(--red); border: 1px solid rgba(255,94,122,0.3);">
            <i class="fa-solid fa-ban"></i> Gestionar Anulación
          </a>
        </div>
      <?php else: ?>
        <div style="text-align: center; padding: 40px; color: var(--text3);">
          <i class="fa-solid fa-ban" style="font-size: 32px; display: block; margin-bottom: 12px; opacity: 0.5;"></i>
          <p>No hay información de anulación disponible para este crédito</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- ======================== TAB: COMUNICACIÓN ======================== -->
  <div class="dayq-tab-content <?php echo $tab_activo === 'comunicacion' ? 'active' : ''; ?>">
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-comments"></i> Historial de Comunicación</h3>
      <div class="dayq-grid-2">
        <div style="background: var(--card2); padding: 16px; border-radius: 8px;">
          <h4 style="font-size: 12px; font-weight: 600; margin-bottom: 12px; color: var(--text);">
            <i class="fa-brands fa-whatsapp" style="color: #25D366;"></i> WhatsApp
          </h4>
          <div style="text-align: center; padding: 20px; color: var(--text3);">
            <i class="fa-brands fa-whatsapp" style="font-size: 28px; display: block; margin-bottom: 8px; opacity: 0.4;"></i>
            <p style="font-size: 12px;">No hay mensajes de WhatsApp registrados</p>
            <a href="#" class="dayq-btn dayq-btn-primary" style="margin-top: 8px; font-size: 11px;">
              <i class="fa-brands fa-whatsapp"></i> Enviar WhatsApp
            </a>
          </div>
        </div>

        <div style="background: var(--card2); padding: 16px; border-radius: 8px;">
          <h4 style="font-size: 12px; font-weight: 600; margin-bottom: 12px; color: var(--text);">
            <i class="fa-solid fa-envelope"></i> Correos Electrónicos
          </h4>
          <div style="text-align: center; padding: 20px; color: var(--text3);">
            <i class="fa-solid fa-envelope" style="font-size: 28px; display: block; margin-bottom: 8px; opacity: 0.4;"></i>
            <p style="font-size: 12px;">No hay correos registrados</p>
            <div style="font-size: 11px; color: var(--text3);">
              Contacto: <?php echo htmlspecialchars(isset($credito['correo_tercero']) ? $credito['correo_tercero'] : 'No disponible'); ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Notas internas -->
      <div class="dayq-section" style="margin-top: 12px;">
        <h4 style="font-size: 12px; font-weight: 600; margin-bottom: 8px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.5px;">
          <i class="fa-solid fa-note-sticky"></i> Notas Internas
        </h4>

        <?php if ($nota_guardada): ?>
          <div style="padding: 10px 14px; background: rgba(0,200,150,0.12); border: 1px solid rgba(0,200,150,0.25); border-radius: 6px; color: var(--green); font-size: 12px; margin-bottom: 10px;">
            <i class="fa-solid fa-check-circle"></i> Nota guardada correctamente
          </div>
        <?php endif; ?>
        <?php if ($nota_error): ?>
          <div style="padding: 10px 14px; background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.25); border-radius: 6px; color: var(--red); font-size: 12px; margin-bottom: 10px;">
            <i class="fa-solid fa-exclamation-circle"></i> <?php echo htmlspecialchars($nota_error); ?>
          </div>
        <?php endif; ?>

        <form method="post" action="?m=credito_detalle&id=<?php echo $cod_credito; ?>&tab=comunicacion">
          <input type="hidden" name="action" value="guardar_nota_interna">
          <textarea name="nota_interna" placeholder="Agregar una nota interna sobre la comunicación con el cliente..."
            style="width: 100%; padding: 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-height: 80px; resize: vertical;"></textarea>
          <button type="submit" class="dayq-btn dayq-btn-primary" style="margin-top: 8px; font-size: 11px;"><i class="fa-solid fa-floppy-disk"></i> Guardar Nota</button>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
.info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4px 16px;
}
.info-item {
  display: flex;
  flex-direction: column;
  padding: 6px 0;
  border-bottom: 1px solid rgba(42,51,80,0.4);
}
.info-key {
  font-size: 10px;
  color: var(--text3);
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.3px;
}
.info-val {
  font-size: 12px;
  color: var(--text);
  font-weight: 500;
  margin-top: 1px;
}
.detail-table {
  width: 100%;
  border-collapse: collapse;
}
.detail-table td {
  padding: 7px 0;
  border-bottom: 1px solid rgba(42,51,80,0.4);
  font-size: 12px;
}
.detail-table tr:last-child td {
  border-bottom: none;
}
.detail-label {
  color: var(--text3);
  width: 45%;
}
.detail-val {
  font-weight: 600;
  color: var(--text);
  text-align: right;
}
.dayq-topbar-left {
  display: flex;
  align-items: center;
}
.fin-summary-label {
  font-size: 10px;
  color: var(--text3);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
  margin-bottom: 4px;
}
.fin-summary-val {
  font-size: 20px;
  font-weight: 700;
  font-family: 'DM Mono', monospace;
  line-height: 1.2;
}
.fin-summary-sub {
  font-size: 10px;
  color: var(--text3);
  margin-top: 2px;
}
</style>

<script>
function cambiarTab(nombre) {
  window.location.href = '?m=credito_detalle&id=<?php echo $cod_credito; ?>&tab=' + nombre;
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
