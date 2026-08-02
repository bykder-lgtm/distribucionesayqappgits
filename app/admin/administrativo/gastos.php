<?php
/**
 * app/admin/administrativo/gastos.php
 * Gastos Operativos - Registro y visualización de gastos del período
 * Diseño basado en análisis Flexitech: tabla con categorías, filtros y gráfica donut
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

$pagina = dayq_get_int('page', 1);
$fecha_desde = dayq_get_str('fecha_desde', date('Y-m-d', strtotime('-3 months')));
$fecha_hasta = dayq_get_str('fecha_hasta', date('Y-m-d'));
$categoria_filtro = dayq_get_str('categoria', '');
$buscar = dayq_get_str('buscar', '');
$mostrar_anulados = dayq_get_str('anulado', '0');

// ─── Exportar a CSV (antes de layout_header para que los headers funcionen) ───
if (dayq_get_str('export', '') === 'csv') {
    $desde_sql = $db_service->escape($fecha_desde);
    $hasta_sql = $db_service->escape($fecha_hasta);
    $buscar_sql = $buscar ? $db_service->escape("%$buscar%") : '';
    $anulado_cond = $mostrar_anulados === '1' ? '' : 'AND g.anulado = 0';
    $where = "WHERE g.fecha BETWEEN '$desde_sql' AND '$hasta_sql 23:59:59' $anulado_cond";
    if ($buscar_sql) {
        $where .= " AND (g.concepto LIKE '$buscar_sql' OR c.nombre LIKE '$buscar_sql')";
    }
    if ($categoria_filtro) {
        $cat_sql = $db_service->escape($categoria_filtro);
        $where .= " AND c.codigo LIKE '$cat_sql%'";
    }
    $r_exp = $db_service->query("SELECT
        g.id, g.fecha, g.concepto, g.monto,
        c.codigo AS cuenta_codigo, c.nombre AS cuenta_nombre
      FROM gasto g
      LEFT JOIN cuenta c ON c.id = g.cuenta_id
      $where
      ORDER BY g.fecha DESC");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=gastos_' . $fecha_desde . '_a_' . $fecha_hasta . '.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Fecha', 'Concepto', 'Categoria', 'Cuenta', 'Valor']);
    if ($r_exp) {
        while ($row = $r_exp->fetch_assoc()) {
            $cod = isset($row['cuenta_codigo']) ? $row['cuenta_codigo'] : '';
            $cat = 'Operativos';
            if (strpos($cod, '5') === 0) $cat = 'Operativos';
            elseif (strpos($cod, '4') === 0) $cat = 'Ingresos';
            elseif (strpos($cod, '2') === 0) $cat = 'Financieros';
            fputcsv($out, [
                $row['id'],
                $row['fecha'],
                $row['concepto'],
                $cat,
                isset($row['cuenta_nombre']) ? $row['cuenta_nombre'] : 'General',
                $row['monto']
            ]);
        }
    }
    fclose($out);
    exit;
}

$dayq_page_title = 'Gastos Operativos';
include __DIR__ . '/layout_header.php';

// ─── Crear gasto (inline) ───
$crear_msg = '';
$crear_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && dayq_post('action') === 'crear_gasto') {
    $cuenta_id = (int) dayq_post('cuenta_id');
    $concepto = dayq_post('concepto');
    $monto = (float) dayq_post('monto');
    $fecha_raw = dayq_post('fecha') ?: date('Y-m-d\TH:i');
    $fecha = str_replace('T', ' ', $fecha_raw);
    if (strlen($fecha) === 16) {
        $fecha .= ':00';
    }
    if ($cuenta_id < 1 || $concepto === '' || $monto <= 0) {
        $crear_err = 'Cuenta, concepto y monto son obligatorios';
    } else {
        $conectar->autocommit(false);
        try {
            $c = dayq_e($conectar, $concepto);
            $conectar->query("INSERT INTO gasto (fecha, concepto, monto, cuenta_id, anulado) VALUES ('$fecha','$c',$monto,$cuenta_id,0)");
            $gid = (int) $conectar->insert_id;
            $mid = dayq_aplicar_movimiento($conectar, $cuenta_id, 'SALIDA', $monto, null, $c, 'GASTO-' . $gid, 'GASTO', $gid, false, $fecha);
            if (!$mid) {
                throw new RuntimeException('Error al crear movimiento contable');
            }
            $conectar->query("UPDATE gasto SET movimiento_cuenta_id = $mid WHERE id = $gid");
            $conectar->commit();
            $crear_msg = 'Gasto registrado correctamente con salida en cuenta';
        } catch (Exception $e) {
            $conectar->rollback();
            $crear_err = $e->getMessage() ?: 'Error al guardar el gasto';
        }
        $conectar->autocommit(true);
    }
}

// ─── Anular gasto ───
$anular_msg = '';
$anular_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && dayq_post('action') === 'anular_gasto') {
    $gasto_id = (int) dayq_post('gasto_id');
    $motivo = dayq_post('motivo_anulacion');
    if ($gasto_id < 1 || trim($motivo) === '') {
        $anular_err = 'Datos incompletos para anular el gasto';
    } else {
        $r = $conectar->query('SELECT movimiento_cuenta_id, anulado FROM gasto WHERE id = ' . $gasto_id);
        $row = $r ? $r->fetch_assoc() : null;
        if (!$row || (int)$row['anulado'] === 1) {
            $anular_err = 'Gasto no encontrado o ya anulado';
        } else {
            $mid = (int)$row['movimiento_cuenta_id'];
            $m = dayq_e($conectar, $motivo);
            $conectar->autocommit(false);
            $ok = true;
            if ($mid > 0) {
                $ok = dayq_eliminar_movimiento_y_revertir_saldo($conectar, $mid, false);
            }
            if ($ok) {
                $ok = $conectar->query("UPDATE gasto SET anulado=1, fecha_anulacion=NOW(), motivo_anulacion='$m', movimiento_cuenta_id=NULL WHERE id=$gasto_id");
            }
            if ($ok) {
                $conectar->commit();
                $anular_msg = 'Gasto anulado y saldo revertido correctamente';
            } else {
                $conectar->rollback();
                $anular_err = 'Error al anular el gasto';
            }
            $conectar->autocommit(true);
        }
    }
}

// ─── Cuentas activas para formulario inline ───
$cuentas_activas = [];
$r_ctas = $conectar->query('SELECT id, codigo, nombre FROM cuenta WHERE activo=1 ORDER BY codigo');
if ($r_ctas) {
    while ($row = $r_ctas->fetch_assoc()) {
        $cuentas_activas[] = $row;
    }
}

?>

<style>
/* Estilos inline para el formulario del modal - evita problemas de carga del CSS externo */
#modalNuevoGasto .form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  gap: 12px;
}
#modalNuevoGasto .form-group {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
#modalNuevoGasto .form-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: #64748b;
  display: flex;
  align-items: center;
  gap: 5px;
  margin-bottom: 2px;
}
#modalNuevoGasto .form-label i {
  font-size: 11px;
  color: #2563eb;
}
#modalNuevoGasto .form-label .required {
  color: #dc2626;
  margin-left: 2px;
}
#modalNuevoGasto .form-input,
#modalNuevoGasto .form-select {
  width: 100%;
  padding: 10px 14px;
  background: #ffffff;
  border: 1.5px solid #cbd5e1;
  border-radius: 8px;
  color: #0f172a;
  font-size: 14px;
  font-family: inherit;
  outline: none;
  box-shadow: 0 1px 2px rgba(0,0,0,0.04);
  transition: border-color 0.2s, box-shadow 0.2s;
  box-sizing: border-box;
}
#modalNuevoGasto .form-input:focus,
#modalNuevoGasto .form-select:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37,99,235,0.18);
  background: #ffffff;
}
#modalNuevoGasto .form-input:hover,
#modalNuevoGasto .form-select:hover {
  border-color: #94a3b8;
}
#modalNuevoGasto .form-input::placeholder {
  color: #94a3b8;
  opacity: 1;
}
#modalNuevoGasto .dayq-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 14px;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  background: transparent;
  color: #475569;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: all 0.2s;
}
#modalNuevoGasto .dayq-btn:hover {
  border-color: #2563eb;
  color: #2563eb;
  background: rgba(37,99,235,0.1);
}
#modalNuevoGasto .dayq-btn-primary {
  background: #2563eb;
  border-color: #2563eb;
  color: #fff;
}
#modalNuevoGasto .dayq-btn-primary:hover {
  background: #1d4ed8;
  border-color: #1d4ed8;
}
@media (max-width: 900px) {
  #modalNuevoGasto .form-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 540px) {
  #modalNuevoGasto .form-grid { grid-template-columns: 1fr; }
}
</style>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-file-invoice-dollar"></i> Gastos Operativos</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('gastos')" title="Guía de gastos operativos"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions" style="flex-wrap: wrap; gap: 6px;">
      <input type="text" id="buscar" placeholder="Buscar gasto..." value="<?php echo htmlspecialchars($buscar); ?>"
        style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 140px;">
      <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>"
        style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
      <select id="categoria" style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        <option value="">Todas las categorías</option>
        <option value="5" <?php echo $categoria_filtro === '5' ? 'selected' : ''; ?>>Operativos</option>
        <option value="4" <?php echo $categoria_filtro === '4' ? 'selected' : ''; ?>>Ingresos</option>
        <option value="2" <?php echo $categoria_filtro === '2' ? 'selected' : ''; ?>>Financieros</option>
      </select>
      <label style="display: flex; align-items: center; gap: 4px; font-size: 11px; color: var(--text2); cursor: pointer;">
        <input type="checkbox" id="checkAnulados" value="1" <?php echo $mostrar_anulados === '1' ? 'checked' : ''; ?> onchange="toggleAnulados(this)">
        Mostrar anulados
      </label>
      <button class="dayq-btn dayq-btn-primary" onclick="buscarGastos()"><i class="fa-solid fa-search"></i> Filtrar</button>
      <a href="?m=gastos&export=csv&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>&categoria=<?php echo urlencode($categoria_filtro); ?>&anulado=<?php echo urlencode($mostrar_anulados); ?>" class="dayq-btn dayq-btn-secondary" style="font-size: 11px;">
        <i class="fa-solid fa-file-excel"></i> Exportar Excel
      </a>
    </div>
  </div>

  <?php if ($crear_msg): ?>
    <div class="dayq-msg dayq-msg-success" style="margin-bottom: 12px; padding: 10px 14px; background: rgba(0, 200, 150, 0.12); border: 1px solid rgba(0, 200, 150, 0.25); border-radius: 6px; color: var(--green); font-size: 12px;">
      <i class="fa-solid fa-check-circle"></i> <?php echo htmlspecialchars($crear_msg); ?>
    </div>
  <?php endif; ?>
  <?php if ($crear_err): ?>
    <div class="dayq-msg dayq-msg-error" style="margin-bottom: 12px; padding: 10px 14px; background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.25); border-radius: 6px; color: var(--red); font-size: 12px;">
      <i class="fa-solid fa-exclamation-circle"></i> <?php echo htmlspecialchars($crear_err); ?>
    </div>
  <?php endif; ?>
  <?php if ($anular_msg): ?>
    <div class="dayq-msg dayq-msg-success" style="margin-bottom: 12px; padding: 10px 14px; background: rgba(0, 200, 150, 0.12); border: 1px solid rgba(0, 200, 150, 0.25); border-radius: 6px; color: var(--green); font-size: 12px;">
      <i class="fa-solid fa-check-circle"></i> <?php echo htmlspecialchars($anular_msg); ?>
    </div>
  <?php endif; ?>
  <?php if ($anular_err): ?>
    <div class="dayq-msg dayq-msg-error" style="margin-bottom: 12px; padding: 10px 14px; background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.25); border-radius: 6px; color: var(--red); font-size: 12px;">
      <i class="fa-solid fa-exclamation-circle"></i> <?php echo htmlspecialchars($anular_err); ?>
    </div>
  <?php endif; ?>

  <!-- KPIs -->
  <?php
  // Consultar datos de gastos desde la tabla existente 'gasto'
  $desde_sql = $db_service->escape($fecha_desde);
  $hasta_sql = $db_service->escape($fecha_hasta);
  $buscar_sql = $buscar ? $db_service->escape("%$buscar%") : '';

  $anulado_cond = $mostrar_anulados === '1' ? '' : 'AND g.anulado = 0';
  $where = "WHERE g.fecha BETWEEN '$desde_sql' AND '$hasta_sql 23:59:59' $anulado_cond";
  if ($buscar_sql) {
      $where .= " AND (g.concepto LIKE '$buscar_sql' OR c.nombre LIKE '$buscar_sql')";
  }
  if ($categoria_filtro) {
      $cat_sql = $db_service->escape($categoria_filtro);
      $where .= " AND c.codigo LIKE '$cat_sql%'";
  }

  // Obtener totales
  $r_tot = $db_service->query("SELECT 
      COUNT(*) AS total_gastos,
      COALESCE(SUM(g.monto), 0) AS total_monto
    FROM gasto g
    LEFT JOIN cuenta c ON c.id = g.cuenta_id
    $where");
  $totales = $r_tot ? $r_tot->fetch_assoc() : ['total_gastos' => 0, 'total_monto' => 0];
  $total_gastos = (int)$totales['total_gastos'];
  $total_monto = (float)$totales['total_monto'];

  // Consultar entradas del período para comparación
  $r_ingresos = $db_service->query("SELECT COALESCE(SUM(total_debitos), 0) AS total_ingresos
    FROM tbl15_movimiento_caja
    WHERE DATE(fecha_ymd_movimiento_caja) BETWEEN '$desde_sql' AND '$hasta_sql'");
  $total_ingresos = $r_ingresos ? (float)$r_ingresos->fetch_assoc()['total_ingresos'] : 0;
  $pct_ingresos = $total_ingresos > 0 ? round(($total_monto / $total_ingresos) * 100, 1) : 0;

  // Gastos del día de hoy
  $hoy_sql = date('Y-m-d');
  $r_hoy = $db_service->query("SELECT COALESCE(SUM(g.monto), 0) AS gastos_hoy 
    FROM gasto g WHERE DATE(g.fecha) = '$hoy_sql' " . ($mostrar_anulados === '1' ? '' : "AND g.anulado = 0") . "");
  $gastos_hoy = $r_hoy ? (float)$r_hoy->fetch_assoc()['gastos_hoy'] : 0;

  // Gastos anulados del período (anulado = 1)
  $where_anulados = "WHERE g.fecha BETWEEN '$desde_sql' AND '$hasta_sql 23:59:59' AND g.anulado = 1";
  if ($buscar_sql) {
      $where_anulados .= " AND (g.concepto LIKE '$buscar_sql' OR c.nombre LIKE '$buscar_sql')";
  }
  if ($categoria_filtro) {
      $cat_sql = $db_service->escape($categoria_filtro);
      $where_anulados .= " AND c.codigo LIKE '$cat_sql%'";
  }
  $r_anul = $db_service->query("SELECT 
      COUNT(*) AS total_anulados,
      COALESCE(SUM(g.monto), 0) AS monto_anulado
    FROM gasto g
    LEFT JOIN cuenta c ON c.id = g.cuenta_id
    $where_anulados");
  $anulados_data = $r_anul ? $r_anul->fetch_assoc() : ['total_anulados' => 0, 'monto_anulado' => 0];
  $total_anulados = (int)$anulados_data['total_anulados'];
  $monto_anulado = (float)$anulados_data['monto_anulado'];
  $pct_anulado = $total_monto > 0 ? round(($monto_anulado / $total_monto) * 100, 1) : 0;
  ?>
  <div class="kpi-grid" style="margin-bottom: 24px;">
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-receipt"></i> Total Gastos</div>
      <div class="kpi-value"><?php echo $total_gastos; ?></div>
      <div class="kpi-sub">En el período</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-sack-dollar"></i> Valor Total</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($total_monto); ?></div>
      <div class="kpi-sub">Suma de gastos</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-percentage"></i> % vs Ingresos</div>
      <div class="kpi-value"><?php echo $pct_ingresos; ?>%</div>
      <div class="kpi-sub">Del total de ingresos</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-regular fa-calendar"></i> Gastos Hoy</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($gastos_hoy); ?></div>
      <div class="kpi-sub">
        <?php echo date('d/m/Y'); ?>
        <?php if ($mostrar_anulados === '1'): ?>
          <span style="margin-left: 6px; color: var(--accent);">(incl. anulados)</span>
        <?php endif; ?>
      </div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-ban"></i> Anulados</div>
      <div class="kpi-value"><?php echo $total_anulados; ?></div>
      <div class="kpi-sub">
        $<?php echo dayq_formato_moneda($monto_anulado); ?> &middot; <?php echo $pct_anulado; ?>% del total
        <?php if ($total_anulados > 0): ?>
          <a href="?m=gasto&anulado=1&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>" style="color: var(--accent); text-decoration: none;">Ver todos</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Tabla de Gastos -->
  <div class="dayq-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <h3 class="dayq-section-title" style="margin-bottom: 0;"><i class="fa-solid fa-list"></i> Registro de Gastos</h3>
      <button class="dayq-btn dayq-btn-primary" id="btnNuevoGasto" style="font-size: 11px;" onclick="abrirModalGasto()">
        <i class="fa-solid fa-plus"></i> Nuevo gasto
      </button>
    </div>

    <!-- Modal para nuevo gasto -->
    <div id="modalNuevoGasto" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.55); z-index: 1000; align-items: center; justify-content: center;" onclick="cerrarModalGasto(event)">
      <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0; width: 520px; max-width: 94%; box-shadow: 0 20px 60px rgba(0,0,0,0.4); max-height: 90vh; overflow-y: auto;" onclick="event.stopPropagation()">
        <div style="display: flex; align-items: center; gap: 10px; padding: 18px 20px; border-bottom: 1px solid #e2e8f0; background: #f8fafc;">
          <div style="width: 34px; height: 34px; border-radius: 10px; background: rgba(37,99,235,0.15); display: flex; align-items: center; justify-content: center; font-size: 16px; color: #2563eb;">
            <i class="fa-solid fa-circle-plus"></i>
          </div>
          <div>
            <h3 style="margin: 0; font-size: 14px; font-weight: 700;">Nuevo Gasto Operativo</h3>
            <p style="margin: 1px 0 0; font-size: 11px; color: #64748b;">Registra un gasto con movimiento de salida en cuenta</p>
          </div>
          <button type="button" onclick="document.getElementById('modalNuevoGasto').style.display='none'" style="margin-left: auto; background: transparent; border: none; color: #64748b; cursor: pointer; font-size: 18px; padding: 4px;" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form method="post" action="?m=gastos" onsubmit="return validarFormGasto()" style="padding: 20px;">
          <input type="hidden" name="action" value="crear_gasto">
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label"><i class="fa-solid fa-book"></i> Cuenta <span class="required">*</span></label>
              <select name="cuenta_id" class="form-select" required>
                <option value="">Seleccionar cuenta...</option>
                <?php foreach ($cuentas_activas as $cta): ?>
                  <option value="<?php echo $cta['id']; ?>"><?php echo htmlspecialchars($cta['codigo'] . ' — ' . $cta['nombre']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label"><i class="fa-solid fa-dollar-sign"></i> Monto <span class="required">*</span></label>
              <input type="number" step="0.01" min="0.01" name="monto" class="form-input" required placeholder="0.00">
            </div>
            <div class="form-group" style="grid-column: span 2;">
              <label class="form-label"><i class="fa-solid fa-pen"></i> Concepto <span class="required">*</span></label>
              <input type="text" name="concepto" class="form-input" required placeholder="Ej: Servicio de internet, compra de insumos...">
            </div>
            <div class="form-group" style="grid-column: span 2;">
              <label class="form-label"><i class="fa-regular fa-calendar"></i> Fecha y Hora</label>
              <input type="datetime-local" name="fecha" class="form-input" value="<?php echo date('Y-m-d\TH:i'); ?>">
            </div>
          </div>
          <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 18px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
            <button type="button" class="dayq-btn" onclick="document.getElementById('modalNuevoGasto').style.display='none'">Cancelar</button>
            <button type="submit" class="dayq-btn dayq-btn-primary">
              <i class="fa-solid fa-check"></i> Guardar Gasto
            </button>
          </div>
        </form>
      </div>
    </div>

    <?php
    // Paginación
    $por_pagina = 15;
    $total_paginas = $total_gastos > 0 ? (int) ceil($total_gastos / $por_pagina) : 1;
    $pagina = min($pagina, $total_paginas);
    $offset = ($pagina - 1) * $por_pagina;

    $sql = "SELECT 
        g.id,
        g.fecha,
        g.concepto,
        g.monto,
        g.anulado,
        g.motivo_anulacion,
        g.fecha_anulacion,
        c.id AS cuenta_id,
        c.codigo AS cuenta_codigo,
        c.nombre AS cuenta_nombre
      FROM gasto g
      LEFT JOIN cuenta c ON c.id = g.cuenta_id
      $where
      ORDER BY g.fecha DESC, g.id DESC
      LIMIT $offset, $por_pagina";

    $r = $db_service->query($sql);
    $gastos = [];
    if ($r) {
      while ($row = $r->fetch_assoc()) {
        $gastos[] = $row;
      }
    }
    ?>

    <div class="dayq-table-wrap">
      <table class="dayq-table" id="tabla-gastos-principal">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Categoría</th>
            <th>Subcategoría</th>
            <th>Descripción</th>
            <th>Centro Costo</th>
            <th style="text-align: right;">Valor</th>
            <th style="text-align: center;">Soporte</th>
            <th style="text-align: center; width: 50px;">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($gastos) > 0): ?>
            <?php foreach ($gastos as $g): 
              $cuenta_nombre = isset($g['cuenta_nombre']) ? $g['cuenta_nombre'] : 'General';
              // Derivar categoría del código de cuenta
              $codigo_cuenta = isset($g['cuenta_codigo']) ? $g['cuenta_codigo'] : '';
              $categoria = 'Operativos';
              if (strpos($codigo_cuenta, '5') === 0) $categoria = 'Operativos';
              elseif (strpos($codigo_cuenta, '4') === 0) $categoria = 'Ingresos';
              elseif (strpos($codigo_cuenta, '2') === 0) $categoria = 'Financieros';
            ?>
            <tr>
              <td style="color: var(--text3); font-size: 11px;">
                <?php echo dayq_formato_fecha($g['fecha']); ?>
              </td>
              <td>
                <span class="chip" style="font-size: 10px;"><?php echo $categoria; ?></span>
              </td>
              <td style="font-size: 11px; color: var(--text2);">
                <?php echo htmlspecialchars($cuenta_nombre); ?>
              </td>
              <td>
                <strong><?php echo htmlspecialchars($g['concepto']); ?></strong>
                <?php if ((int)$g['anulado']): ?>
                  <span class="badge badge-danger" style="margin-left: 4px;">Anulado</span>
                <?php endif; ?>
              </td>
              <td><span class="chip" style="font-size: 10px;">General</span></td>
              <td style="text-align: right; font-weight: 600; <?php echo (int)$g['anulado'] ? 'color: var(--text3); text-decoration: line-through;' : 'color: var(--red);'; ?>">
                $<?php echo dayq_formato_moneda($g['monto']); ?>
              </td>
              <td style="text-align: center; font-size: 14px;">
                <?php if (!(int)$g['anulado']): ?>
                  <span style="opacity: 0.3;"><i class="fa-solid fa-paperclip"></i></span>
                <?php endif; ?>
              </td>
              <td style="text-align: center;">
                <?php if (!(int)$g['anulado']): ?>
                  <button class="dayq-btn dayq-btn-danger" style="font-size: 10px; padding: 4px 8px;"
                    onclick="mostrarModalAnular(<?php echo $g['id']; ?>, '<?php echo htmlspecialchars(addslashes($g['concepto']), ENT_QUOTES); ?>')">
                    <i class="fa-solid fa-ban"></i>
                  </button>
                <?php else: ?>
                  <span style="display: inline-block; padding: 2px 8px; border-radius: 10px; background: rgba(239,68,68,0.15); color: var(--red); font-size: 10px; font-weight: 600; white-space: nowrap;">Anulado</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" style="text-align: center; padding: 40px; color: var(--text3);">
                <i class="fa-solid fa-receipt" style="font-size: 28px; display: block; margin-bottom: 8px; opacity: 0.4;"></i>
                No hay gastos registrados en el período seleccionado
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Total del período -->
    <?php if ($total_gastos > 0): ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px; padding: 12px 16px; background: var(--card2); border-radius: 8px;">
      <div>
        <strong style="font-size: 12px;">Total Gastos del Período</strong>
        <span style="color: var(--text3); font-size: 11px; margin-left: 8px;">
          <?php echo $fecha_desde === $fecha_hasta ? dayq_formato_fecha($fecha_desde) : dayq_formato_fecha($fecha_desde) . ' — ' . dayq_formato_fecha($fecha_hasta); ?>
        </span>
      </div>
      <div style="font-size: 20px; font-weight: 700; color: var(--red); font-family: 'DM Mono', monospace;">
        $<?php echo dayq_formato_moneda($total_monto); ?>
      </div>
    </div>
    <?php endif; ?>

    <!-- Paginación -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination" style="margin-top: 12px;">
        <?php if ($pagina > 1): ?>
          <?php $anulado_qs = $mostrar_anulados === '1' ? '&anulado=1' : ''; ?>
          <a href="?m=gastos&page=1&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $anulado_qs; ?>">&laquo;</a>
          <a href="?m=gastos&page=<?php echo $pagina - 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $anulado_qs; ?>">&lsaquo;</a>
        <?php endif; ?>
        <?php
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=gastos&page=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $anulado_qs; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=gastos&page=<?php echo $pagina + 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $anulado_qs; ?>">&rsaquo;</a>
          <a href="?m=gastos&page=<?php echo $total_paginas; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?><?php echo $anulado_qs; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Gráfica Donut de Gastos por Categoría + Resumen -->
  <?php if ($total_gastos > 0): ?>
  <div class="dayq-grid-2" style="margin-top: 4px;">
    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-chart-pie"></i> Distribución por Categoría</h3>
      <?php
      // Obtener distribución por cuenta
      $r_dist = $db_service->query("SELECT 
          c.nombre AS cuenta_nombre,
          c.codigo AS cuenta_codigo,
          COUNT(*) AS cantidad,
          COALESCE(SUM(g.monto), 0) AS total_monto
        FROM gasto g
        LEFT JOIN cuenta c ON c.id = g.cuenta_id
        WHERE g.fecha BETWEEN '$desde_sql' AND '$hasta_sql 23:59:59' $anulado_cond
        GROUP BY c.id
        ORDER BY total_monto DESC");
      $distribucion = [];
      if ($r_dist) {
        while ($row = $r_dist->fetch_assoc()) {
          $distribucion[] = $row;
        }
      }
      ?>
      <div style="display: flex; align-items: center; gap: 20px;">
        <svg width="120" height="120" viewBox="0 0 120 120" style="cursor: pointer;">
          <circle cx="60" cy="60" r="45" fill="none" stroke="#2a3350" stroke-width="18"/>
          <?php
          $circ = 2 * M_PI * 45;
          $offset_donut = 0;
          $colores = ['#ff8c42', '#4f8ef7', '#00c896', '#f7c948', '#6c5ce7', '#a78bfa', '#ef4444'];
          $di = 0;
          foreach ($distribucion as $d):
            $pct = $total_monto > 0 ? (float)$d['total_monto'] / $total_monto : 0;
            $dash = $pct * $circ;
            $color = $colores[$di % count($colores)];
            $tooltip = htmlspecialchars(($d['cuenta_nombre'] ?: 'General') . ': $' . number_format((float)$d['total_monto'], 0) . ' (' . round($pct*100, 1) . '%)');
          ?>
          <circle cx="60" cy="60" r="45" fill="none" stroke="<?php echo $color; ?>" stroke-width="18"
            stroke-dasharray="<?php echo round($dash, 1); ?> <?php echo round($circ - $dash, 1); ?>"
            stroke-dashoffset="-<?php echo round($offset_donut, 1); ?>" transform="rotate(-90 60 60)"
            onmouseover="this.setAttribute('stroke-width', '22')" onmouseout="this.setAttribute('stroke-width', '18')"
            title="<?php echo $tooltip; ?>"/>
          <?php
            $offset_donut += $dash;
            $di++;
          endforeach;
          ?>
          <text x="60" y="64" text-anchor="middle" fill="var(--text)" font-size="13" font-weight="700" font-family="DM Mono, monospace">
            $<?php echo number_format($total_monto / 1000000, 1); ?>M
          </text>
        </svg>
        <div style="flex: 1;">
          <?php
          $di = 0;
          foreach ($distribucion as $d):
            $pct = $total_monto > 0 ? round(((float)$d['total_monto'] / $total_monto) * 100, 1) : 0;
            $color = $colores[$di % count($colores)];
          ?>
          <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 5px; font-size: 11px;">
            <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo $color; ?>; flex-shrink: 0;"></span>
            <span style="flex: 1; color: var(--text2);"><?php echo htmlspecialchars($d['cuenta_nombre'] ?: 'General'); ?></span>
            <span style="font-weight: 700;">$<?php echo dayq_formato_moneda($d['total_monto']); ?></span>
            <span style="color: var(--text3); font-size: 10px;">(<?php echo $pct; ?>%)</span>
          </div>
          <?php $di++; endforeach; ?>
        </div>
      </div>
    </div>

    <div class="dayq-section">
      <h3 class="dayq-section-title"><i class="fa-solid fa-chart-line"></i> Resumen Financiero</h3>
      <div class="detail-row">
        <span class="detail-label">Total Ingresos Período</span>
        <span class="detail-val" style="color: var(--green);">$<?php echo dayq_formato_moneda($total_ingresos); ?></span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Total Gastos Período</span>
        <span class="detail-val" style="color: var(--red);">$<?php echo dayq_formato_moneda($total_monto); ?></span>
      </div>
      <div class="detail-row" style="border-bottom: none;">
        <span class="detail-label" style="font-weight: 700;">Resultado Operativo</span>
        <span class="detail-val" style="font-weight: 700; color: <?php echo ($total_ingresos - $total_monto) >= 0 ? 'var(--green)' : 'var(--red)'; ?>;">
          $<?php echo dayq_formato_moneda($total_ingresos - $total_monto); ?>
        </span>
      </div>
      <div style="margin-top: 16px; padding: 12px; background: var(--card2); border-radius: 6px; text-align: center;">
        <div style="font-size: 10px; color: var(--text3); text-transform: uppercase;">Eficiencia Operativa</div>
        <div style="font-size: 24px; font-weight: 800; color: <?php echo $pct_ingresos < 30 ? 'var(--green)' : 'var(--red)'; ?>; font-family: 'DM Mono', monospace;">
          <?php echo $pct_ingresos; ?>%
        </div>
        <div style="font-size: 10px; color: var(--text3);">De ingresos destinados a gastos</div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <!-- TABLA DE DESGLOSE POR SUBCATEGORÍA -->
  <?php if ($total_gastos > 0): 
    $gastos_cat = $db_service->getGastosAgrupadosPorCategoria($fecha_desde, $fecha_hasta);
    $variacion_mensual = $db_service->getGastosVariacionMensual(6);
    $mes_anterior = count($variacion_mensual) > 1 ? (float)$variacion_mensual[count($variacion_mensual)-2]['total_monto'] : 0;
    $variacion_pct = $mes_anterior > 0 ? round((($total_monto - $mes_anterior) / $mes_anterior) * 100, 1) : 0;
  ?>
  <div class="dayq-section" style="margin-top: 16px;">
    <h3 class="dayq-section-title"><i class="fa-solid fa-layer-group"></i> Desglose por Subcategoría</h3>
    <div class="dayq-table-wrap">
      <table class="dayq-table" style="font-size: 11px;">
        <thead>
          <tr>
            <th>Categoría</th>
            <th>Subcategoría</th>
            <th style="text-align: center;">Cantidad</th>
            <th style="text-align: right;">Monto</th>
            <th style="text-align: right;">% del Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $cat_actual = '';
          $total_cat_monto = 0;
          $total_cat_cant = 0;
          foreach ($gastos_cat as $gc): 
            $pct_item = $total_monto > 0 ? round(((float)$gc['total_monto'] / $total_monto) * 100, 1) : 0;
            if ($cat_actual !== '' && $cat_actual !== $gc['categoria']):
          ?>
            <tr style="background: rgba(79,142,247,0.05); font-weight: 600;">
              <td colspan="2" style="color: var(--accent);">Total <?php echo $cat_actual; ?></td>
              <td style="text-align: center;"><?php echo $total_cat_cant; ?></td>
              <td style="text-align: right; color: var(--accent);">$<?php echo dayq_formato_moneda($total_cat_monto); ?></td>
              <td style="text-align: right;"><?php echo $total_monto > 0 ? round(($total_cat_monto / $total_monto) * 100, 1) : 0; ?>%</td>
            </tr>
          <?php $total_cat_monto = 0; $total_cat_cant = 0; endif; ?>
            <tr>
              <td><span class="chip" style="font-size: 10px;"><?php echo $gc['categoria']; ?></span></td>
              <td><?php echo htmlspecialchars($gc['subcategoria']); ?></td>
              <td style="text-align: center;"><?php echo $gc['cantidad']; ?></td>
              <td style="text-align: right; font-weight: 600;">$<?php echo dayq_formato_moneda($gc['total_monto']); ?></td>
              <td style="text-align: right; color: var(--text3);"><?php echo $pct_item; ?>%</td>
            </tr>
          <?php $cat_actual = $gc['categoria']; $total_cat_monto += (float)$gc['total_monto']; $total_cat_cant += (int)$gc['cantidad']; endforeach; ?>
          <?php if ($cat_actual !== ''): ?>
            <tr style="background: rgba(79,142,247,0.05); font-weight: 600;">
              <td colspan="2" style="color: var(--accent);">Total <?php echo $cat_actual; ?></td>
              <td style="text-align: center;"><?php echo $total_cat_cant; ?></td>
              <td style="text-align: right; color: var(--accent);">$<?php echo dayq_formato_moneda($total_cat_monto); ?></td>
              <td style="text-align: right;"><?php echo $total_monto > 0 ? round(($total_cat_monto / $total_monto) * 100, 1) : 0; ?>%</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="font-weight: 700; border-top: 2px solid var(--border);">
            <td colspan="2">Total General</td>
            <td style="text-align: center;"><?php echo $total_gastos; ?></td>
            <td style="text-align: right; color: var(--red);">$<?php echo dayq_formato_moneda($total_monto); ?></td>
            <td style="text-align: right;">100%</td>
          </tr>
        </tfoot>
      </table>
    </div>
    
    <!-- Variación Mensual -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; padding: 12px 16px; background: var(--card2); border-radius: 8px;">
      <div>
        <strong style="font-size: 12px;">Variación vs Mes Anterior</strong>
        <span style="color: var(--text3); font-size: 11px; margin-left: 8px;">
          Mes anterior: $<?php echo dayq_formato_moneda($mes_anterior); ?>
        </span>
      </div>
      <div style="font-size: 18px; font-weight: 700; color: <?php echo $variacion_pct <= 0 ? 'var(--green)' : 'var(--red)'; ?>; font-family: 'DM Mono', monospace;">
        <?php echo $variacion_pct >= 0 ? '+' : ''; ?><?php echo $variacion_pct; ?>%
        <span style="font-size: 12px; font-weight: 400;">vs mes anterior</span>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<!-- Modal de Anulación -->
<div id="modalAnular" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.55); z-index: 1000; align-items: center; justify-content: center;" onclick="cerrarModalAnular(event)">
  <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 24px; width: 420px; max-width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.4);" onclick="event.stopPropagation()">
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
      <div style="width: 36px; height: 36px; border-radius: 50%; background: rgba(239, 68, 68, 0.15); display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--red);">
        <i class="fa-solid fa-exclamation-triangle"></i>
      </div>
      <div>
        <h3 style="margin: 0; font-size: 14px;">Anular Gasto</h3>
        <p id="modalGastoConcepto" style="margin: 2px 0 0; font-size: 11px; color: var(--text3);"></p>
      </div>
    </div>
    <form method="post" action="?m=gastos">
      <input type="hidden" name="action" value="anular_gasto">
      <input type="hidden" name="gasto_id" id="modalGastoId" value="">
      <label style="font-size: 11px; color: var(--text2); display: block; margin-bottom: 6px;">
        Motivo de anulación <span style="color: var(--red);">*</span>
      </label>
      <textarea name="motivo_anulacion" id="modalMotivo" required
        style="width: 100%; padding: 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; resize: vertical; min-height: 60px;"
        placeholder="Indique la razón de la anulación..."></textarea>
      <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 16px;">
        <button type="button" class="dayq-btn" style="background: var(--card2); color: var(--text);" onclick="document.getElementById('modalAnular').style.display='none'">
          Cancelar
        </button>
        <button type="submit" class="dayq-btn dayq-btn-danger" style="font-size: 12px;">
          <i class="fa-solid fa-ban"></i> Confirmar Anulación
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function abrirModalGasto() {
  document.getElementById('modalNuevoGasto').style.display = 'flex';
  setTimeout(function() {
    var sel = document.querySelector('#modalNuevoGasto select[name="cuenta_id"]');
    if (sel) sel.focus();
  }, 150);
}

function cerrarModalGasto(e) {
  if (e && e.target !== e.currentTarget) return;
  document.getElementById('modalNuevoGasto').style.display = 'none';
}

function validarFormGasto() {
  var cuenta = document.querySelector('#modalNuevoGasto select[name="cuenta_id"]').value;
  var concepto = document.querySelector('#modalNuevoGasto input[name="concepto"]').value.trim();
  var monto = parseFloat(document.querySelector('#modalNuevoGasto input[name="monto"]').value);
  if (!cuenta) { alert('Seleccione una cuenta'); return false; }
  if (!concepto) { alert('Ingrese un concepto'); return false; }
  if (!monto || monto <= 0) { alert('Ingrese un monto válido'); return false; }
  return true;
}

function mostrarModalAnular(id, concepto) {
  document.getElementById('modalGastoId').value = id;
  document.getElementById('modalGastoConcepto').textContent = concepto;
  document.getElementById('modalAnular').style.display = 'flex';
}
function cerrarModalAnular(e) {
  if (e.target === e.currentTarget) {
    document.getElementById('modalAnular').style.display = 'none';
  }
}

function toggleAnulados(chk) {
  const url = new URL(window.location.href);
  if (chk.checked) {
    url.searchParams.set('anulado', '1');
  } else {
    url.searchParams.delete('anulado');
  }
  url.searchParams.delete('page');
  window.location.href = url.toString();
}

function buscarGastos() {
  const buscar = document.getElementById('buscar').value;
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  const categoria = document.getElementById('categoria').value;
  const anulado = document.getElementById('checkAnulados').checked ? '1' : '0';
  let url = '?m=gastos';
  if (buscar) url += '&buscar=' + encodeURIComponent(buscar);
  if (desde) url += '&fecha_desde=' + desde;
  if (hasta) url += '&fecha_hasta=' + hasta;
  if (categoria) url += '&categoria=' + encodeURIComponent(categoria);
  if (anulado === '1') url += '&anulado=1';
  window.location.href = url;
}

// Inicializar filtros de tabla
document.addEventListener('DOMContentLoaded', function() {
    var tables = document.querySelectorAll('.dayq-table');
    if (tables.length > 0 && typeof initFiltrosTabla === 'function') {
        initFiltrosTabla(tables[0].id || 'tabla-gastos', {
            tipos: {
                0: 'date',    // Fecha
                1: 'select',  // Categoría
                2: 'text',    // Subcategoría
                3: 'text',    // Descripción
                5: 'text'     // Valor
            },
            opciones: {
                1: ['Operativos', 'Ingresos', 'Financieros']
            }
        });
    }
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
