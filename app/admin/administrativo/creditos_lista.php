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
$filtro_linea = dayq_get_int('linea', 0);
$estado_qs = $filtro_estado !== '' ? '&estado=' . urlencode($filtro_estado) : '';
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-credit-card"></i> Créditos</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('creditos_lista')" title="Guía del módulo de créditos"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <input type="text" id="buscar" placeholder="Buscar por ID, cliente, comercio..." value="<?php echo htmlspecialchars($buscar); ?>"
        style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 180px;">
      <select id="filtro_linea" style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        <option value="0">Todas las líneas</option>
        <?php
        $lineas_opts = $db_service->getHabilitadoresPaginados(1, 999, '', 1);
        foreach ($lineas_opts as $lin):
          $sel = $filtro_linea == $lin['cod_entidad_crediticia'] ? 'selected' : '';
        ?>
        <option value="<?php echo $lin['cod_entidad_crediticia']; ?>" <?php echo $sel; ?>>
          <?php echo htmlspecialchars($lin['nombre_entidad_crediticia']); ?>
        </option>
        <?php endforeach; ?>
      </select>
      <span style="font-size: 11px; color: var(--text3); font-weight: 600; margin-right: 2px;">Período:</span>
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
    if ($filtro_linea > 0) {
        $where .= " AND oc.cod_entidad_crediticia = $filtro_linea";
    }

    $por_pagina = 15;
    $r_tot = $db_service->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta ifv
        LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
        LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
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
            LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
            LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
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
      <table class="dayq-table" id="tabla-creditos">
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
                <td><strong>#<?php echo (int)$cred['cod_info_factura_venta']; ?></strong><?php if (!empty($cred['cod_factura']) && $cred['cod_factura'] !== '0'): ?> <small style="color:var(--text3);font-weight:400;">/ F:<?php echo $cred['cod_factura']; ?></small><?php endif; ?></td>
                <td><strong><?php echo htmlspecialchars(isset($cred['cliente']) ? $cred['cliente'] : '-'); ?></strong></td>
                <td style="color: var(--text3); font-size: 11px;"><?php echo htmlspecialchars(isset($cred['cc_cliente']) ? $cred['cc_cliente'] : '-'); ?></td>
                <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
                <td><span class="badge badge-blue"><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></span></td>
                <td style="font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cred['total_precio_venta']) ? $cred['total_precio_venta'] : 0); ?></td>
                <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($cred['monto_deuda']) ? $cred['monto_deuda'] : 0); ?></td>
                <td style="color: var(--green); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
                <td>
                  <?php
                    $est = isset($cred['nombre_estado_factura']) ? $cred['nombre_estado_factura'] : '';
                    $id_cred = $cred['cod_info_factura_venta'];
                  ?>
                  <span class="badge <?php
                    echo $est === 'ABIERTA' ? 'badge-success' : ($est === 'PENDIENTE' ? 'badge-warning' : ($est === 'ANULADA' ? 'badge-danger' : 'badge-info'));
                  ?>">
                    <?php echo dayq_get_estado_texto($est); ?>
                  </span>
                  <?php if ($est !== 'ANULADA'): ?>
                    <button onclick="abrirModalEstado(<?php echo $id_cred; ?>, '<?php echo $est; ?>')" style="background: none; border: none; color: var(--text3); cursor: pointer; font-size: 10px; margin-left: 2px;" title="Cambiar estado">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                  <?php endif; ?>
                </td>
                <td style="color: var(--text3); font-size: 11px;"><?php echo dayq_formato_fecha($cred['fecha_creacion']); ?></td>
                <td style="text-align: center;">
                  <div class="action-icons" style="display: flex; gap: 4px; justify-content: center;">
                    <a href="?m=credito_detalle&id=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Ver detalle">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="?m=liquidaciones&cod_credito=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Liquidar">
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
          <?php 
          $linea_qs = $filtro_linea > 0 ? '&linea=' . $filtro_linea : '';
          $pag_qs = '&buscar=' . urlencode($buscar) . '&fecha_desde=' . urlencode($fecha_desde) . '&fecha_hasta=' . urlencode($fecha_hasta) . $estado_qs . $linea_qs;
          ?>
          <?php if ($pagina > 1): ?>
            <a href="?m=creditos_lista&page=1<?php echo $pag_qs; ?>" title="Primera página">&laquo;</a>
            <a href="?m=creditos_lista&page=<?php echo $pagina - 1; ?><?php echo $pag_qs; ?>" title="Página anterior">&lsaquo;</a>
          <?php endif; ?>
          <?php
          $inicio = max(1, $pagina - 2);
          $fin = min($total_paginas, $pagina + 2);
          for ($i = $inicio; $i <= $fin; $i++):
          ?>
            <?php if ($i === $pagina): ?>
              <span class="active"><?php echo $i; ?></span>
            <?php else: ?>
              <a href="?m=creditos_lista&page=<?php echo $i; ?><?php echo $pag_qs; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($pagina < $total_paginas): ?>
            <a href="?m=creditos_lista&page=<?php echo $pagina + 1; ?><?php echo $pag_qs; ?>" title="Página siguiente">&rsaquo;</a>
            <a href="?m=creditos_lista&page=<?php echo $total_paginas; ?><?php echo $pag_qs; ?>" title="Última página">&raquo;</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL CAMBIAR ESTADO -->
<div id="modalCambiarEstado" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1001; align-items: center; justify-content: center;">
  <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; width: 380px; max-width: 95%; padding: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <h3 style="margin: 0; font-size: 15px;">Cambiar Estado de Crédito</h3>
      <button onclick="cerrarModalEstado()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text3);" title="Cerrar">&times;</button>
    </div>
    <form method="POST" action="reg_dayq.php">
      <input type="hidden" name="entity" value="estado_credito">
      <input type="hidden" name="redirect" value="creditos_lista">
      <input type="hidden" name="id" id="estado_credito_id" value="0">
      <div style="margin-bottom: 14px;">
        <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 6px;">Nuevo Estado</label>
        <select name="nuevo_estado" id="estado_select" required style="width: 100%; padding: 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          <option value="ABIERTA">Abierta</option>
          <option value="PENDIENTE">Pendiente</option>
          <option value="APROBADA">Aprobada</option>
          <option value="CERRADA">Cerrada</option>
        </select>
      </div>
      <div style="display: flex; justify-content: flex-end; gap: 8px;">
        <button type="button" onclick="cerrarModalEstado()" class="dayq-btn" style="padding: 8px 16px;">Cancelar</button>
        <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px; background: var(--accent); color: white;">
          <i class="fa-solid fa-check"></i> Cambiar Estado
        </button>
      </div>
    </form>
  </div>
</div>

<script>
// Inicializar filtros de tabla
document.addEventListener('DOMContentLoaded', function() {
    var tables = document.querySelectorAll('.dayq-table');
    if (tables.length > 0 && typeof initFiltrosTabla === 'function') {
        initFiltrosTabla(tables[0].id || 'tabla-creditos', {
            tipos: {
                0: 'text',   // ID
                1: 'text',   // Cliente
                2: 'text',   // CC
                3: 'text',   // Comercio
                4: 'text',   // Línea
                8: 'select'  // Estado
            },
            opciones: {
                8: ['ABIERTA', 'PENDIENTE', 'APROBADA', 'ANULADA', 'CERRADA']
            }
        });
    }
});

function buscarCreditos() {
  const buscar = document.getElementById('buscar').value;
  const desde = document.getElementById('fecha_desde').value;
  const hasta = document.getElementById('fecha_hasta').value;
  const linea = document.getElementById('filtro_linea').value;
  let url = '?m=creditos_lista&buscar=' + encodeURIComponent(buscar);
  if (desde) url += '&fecha_desde=' + desde;
  if (hasta) url += '&fecha_hasta=' + hasta;
  if (linea) url += '&linea=' + linea;
  window.location.href = url;
}

function abrirModalEstado(id, estadoActual) {
  document.getElementById('estado_credito_id').value = id;
  var sel = document.getElementById('estado_select');
  for (var i = 0; i < sel.options.length; i++) {
    if (sel.options[i].value === estadoActual) {
      sel.selectedIndex = i;
      break;
    }
  }
  document.getElementById('modalCambiarEstado').style.display = 'flex';
}

function cerrarModalEstado() {
  document.getElementById('modalCambiarEstado').style.display = 'none';
}

document.getElementById('modalCambiarEstado').addEventListener('click', function(e) {
  if (e.target === this) cerrarModalEstado();
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
