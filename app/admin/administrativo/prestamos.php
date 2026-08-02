<?php
/**
 * app/admin/administrativo/prestamos.php
 * Módulo de Préstamos Empleados - CRUD completo
 * Tablas: tbl15_prestamo_empleado, tbl15_prestamo_empleado_cuota
 *
 * Funcionalidades:
 * - Listado con KPIs y paginación
 * - Crear préstamo con generación automática de cuotas
 * - Detalle de préstamo con tabla de cuotas
 * - Pago de cuotas (descuento nómina / voluntario)
 * - Anulación de préstamos
 *
 * @see changelog/CAMBIOS_20260724.md
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

// AJAX: obtener empleados para el buscador con autocompletado
$ajax = dayq_get_str('ajax', '');
if ($ajax === 'get_empleados') {
    header('Content-Type: application/json');
    $buscar_emp = dayq_get_str('q', '');
    $empleados = $db_service->getEmpleadosActivos($buscar_emp);
    echo json_encode(['success' => true, 'items' => $empleados]);
    exit;
}

// AJAX: registrar empleado nuevo desde el modal
if ($ajax === 'crear_empleado') {
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'error' => 'Método no permitido']);
        exit;
    }
    $res = $db_service->crearEmpleado([
        'nombres' => dayq_post('nombres'),
        'apellidos' => dayq_post('apellidos'),
        'documento' => dayq_post('documento'),
        'telefono' => dayq_post('telefono'),
        'correo' => dayq_post('correo'),
        'direccion' => dayq_post('direccion'),
        'cod_admin' => isset($_SESSION['cod_administrador']) ? (int)$_SESSION['cod_administrador'] : 0
    ]);
    if ($res['id'] > 0) {
        $item = $db_service->getEmpleadoPorId($res['id']);
        if ($item) {
            echo json_encode(['success' => true, 'reutilizado' => $res['reutilizado'], 'item' => $item]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo recuperar el empleado registrado']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo registrar el empleado']);
    }
    exit;
}

$dayq_page_title = 'Préstamo Empleado';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
$accion = dayq_get_str('accion', 'lista'); // lista, detalle, crear
$id = dayq_get_int('id', 0);
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-hand-holding-dollar"></i> Préstamo Empleado</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('prestamos')" title="Guía del módulo de préstamos"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <div class="dayq-topbar-filter">
        <?php if ($accion === 'lista'): ?>
        <input type="text" id="buscar" placeholder="Buscar empleado..." value="<?php echo htmlspecialchars($buscar); ?>"
          style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        <button class="dayq-btn dayq-btn-primary" onclick="buscarPrestamos()"><i class="fa-solid fa-search"></i> Buscar</button>
        <button class="dayq-btn" onclick="window.location.href='?m=prestamos&accion=crear'"
          style="background: var(--accent); color: white;"><i class="fa-solid fa-plus"></i> Nuevo Préstamo</button>
        <?php else: ?>
        <a href="?m=prestamos" class="dayq-btn"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- MENSAJES FLASH -->
  <?php if (isset($_GET['msg']) && $_GET['msg'] !== ''): ?>
    <div class="dayq-alert dayq-alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
  <?php endif; ?>
  <?php if (isset($_GET['err']) && $_GET['err'] !== ''): ?>
    <div class="dayq-alert dayq-alert-danger"><?php echo htmlspecialchars($_GET['err']); ?></div>
  <?php endif; ?>

  <?php if ($accion === 'lista'): ?>
  <!-- ========== VISTA LISTADO ========== -->
  <?php
  $kpis = $db_service->getPrestamosKPIs();
  ?>
  <div class="kpi-grid" style="margin-bottom: 24px;">
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-file-invoice"></i> Préstamos Activos</div>
      <div class="kpi-value" style="color: var(--accent);"><?php echo $kpis['prestamos_activos']; ?></div>
      <div class="kpi-sub">Vigentes</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-sack-dollar"></i> Saldo Total</div>
      <div class="kpi-value" style="color: var(--yellow);">$<?php echo dayq_formato_moneda($kpis['saldo_total']); ?></div>
      <div class="kpi-sub">Por cobrar</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-regular fa-calendar"></i> Cuotas del Mes</div>
      <div class="kpi-value" style="color: var(--green);">$<?php echo dayq_formato_moneda($kpis['cuotas_mes']); ?></div>
      <div class="kpi-sub">Por vencer</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label"><i class="fa-solid fa-triangle-exclamation"></i> Cuotas Vencidas</div>
      <div class="kpi-value" style="color: var(--red);"><?php echo $kpis['cuotas_vencidas']; ?></div>
      <div class="kpi-sub">Con atraso</div>
    </div>
  </div>

  <div class="dayq-section">
    <h3 class="dayq-section-title">Listado de Préstamos</h3>
    <?php
    $data = $db_service->getPrestamosLista($pagina, 15, $buscar);
    $prestamos = $data['items'];
    $total_paginas = $data['total_paginas'];
    ?>
    <div class="dayq-table-wrap"><table class="dayq-table" id="tabla-prestamos-principal">
      <thead>
        <tr>
          <th>ID</th>
          <th>Empleado</th>
          <th>Documento</th>
          <th>Monto</th>
          <th>Cuotas</th>
          <th>Valor Cuota</th>
          <th>Total Pagar</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($prestamos) > 0): ?>
          <?php foreach ($prestamos as $p): 
            $estado_texto = $p['cod_estado_prestamo'] == 1 ? 'Activo' : ($p['cod_estado_prestamo'] == 2 ? 'Pagado' : 'Anulado');
            $estado_clase = $p['cod_estado_prestamo'] == 1 ? 'badge-info' : ($p['cod_estado_prestamo'] == 2 ? 'badge-success' : 'badge-danger');
          ?>
          <tr>
            <td>#<?php echo $p['cod_prestamo_empleado']; ?></td>
            <td><strong><?php echo htmlspecialchars(isset($p['empleado_nombre']) ? $p['empleado_nombre'] : '-'); ?></strong></td>
            <td style="color: var(--text3); font-size: 11px;"><?php echo htmlspecialchars(isset($p['empleado_documento']) ? $p['empleado_documento'] : '-'); ?></td>
            <td style="font-weight: 600;">$<?php echo dayq_formato_moneda($p['monto_prestamo']); ?></td>
            <td style="text-align: center;"><?php echo $p['numero_cuotas']; ?></td>
            <td style="font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($p['valor_cuota']); ?></td>
            <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda($p['total_pagar']); ?></td>
            <td style="color: var(--text3); font-size: 11px;"><?php echo dayq_formato_fecha($p['fecha_prestamo']); ?></td>
            <td><span class="badge <?php echo $estado_clase; ?>"><?php echo $estado_texto; ?></span></td>
            <td>
              <a href="?m=prestamos&accion=detalle&id=<?php echo $p['cod_prestamo_empleado']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;">
                <i class="fa-solid fa-eye"></i> Detalle
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="10" style="text-align: center; padding: 30px; color: var(--text3);">
            <i class="fa-solid fa-inbox" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>
            No hay préstamos registrados
          </td></tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php $pag_qs = '&buscar=' . urlencode($buscar); ?>
        <?php if ($pagina > 1): ?>
          <a href="?m=prestamos&page=1<?php echo $pag_qs; ?>">&laquo;</a>
          <a href="?m=prestamos&page=<?php echo $pagina - 1; ?><?php echo $pag_qs; ?>">&lsaquo;</a>
        <?php endif; ?>
        <?php $inicio = max(1, $pagina - 2); $fin = min($total_paginas, $pagina + 2); ?>
        <?php for ($i = $inicio; $i <= $fin; $i++): ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=prestamos&page=<?php echo $i; ?><?php echo $pag_qs; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=prestamos&page=<?php echo $pagina + 1; ?><?php echo $pag_qs; ?>">&rsaquo;</a>
          <a href="?m=prestamos&page=<?php echo $total_paginas; ?><?php echo $pag_qs; ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php elseif ($accion === 'crear'): ?>
  <!-- ========== VISTA CREAR PRÉSTAMO ========== -->
  <div class="dayq-section">
    <h3 class="dayq-section-title"><i class="fa-solid fa-plus-circle"></i> Nuevo Préstamo</h3>
    <form method="POST" action="reg_dayq.php" style="max-width: 600px;" onsubmit="return validarFormPrestamo()">
      <input type="hidden" name="entity" value="prestamo">
      <input type="hidden" name="action" value="save">
      
      <div style="display: grid; gap: 14px;">
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Empleado *</label>
          <div style="position: relative;">
            <input type="text" id="buscador_empleado" autocomplete="off"
              placeholder="Buscar empleado por nombre o documento..."
              style="width: 100%; padding: 10px 36px 10px 14px; background: var(--card2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 13px;"
              oninput="buscarEmpleadoInput()" onfocus="buscarEmpleadoInput()">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--text3); font-size: 13px; pointer-events: none;"></i>
            <div id="resultados_empleado" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; background: var(--card); border: 1px solid var(--border); border-radius: 8px; max-height: 240px; overflow-y: auto; z-index: 50; box-shadow: 0 12px 40px rgba(0,0,0,0.4);"></div>
          </div>
          <input type="hidden" name="cod_empleado" id="cod_empleado_hidden" value="">
          <div id="empleado_seleccionado" style="display: none; margin-top: 8px; padding: 8px 12px; background: rgba(79,142,247,0.08); border: 1px solid rgba(79,142,247,0.25); border-radius: 8px; font-size: 11px; color: var(--text);"></div>
          <div id="error_empleado" style="display: none; margin-top: 6px; font-size: 11px; color: var(--red);">
            <i class="fa-solid fa-circle-exclamation"></i> Debe seleccionar un empleado de la lista antes de crear el préstamo.
          </div>
          <div id="empleado_notice" style="display: none; margin-top: 6px; font-size: 11px; color: var(--yellow);"></div>
          <div style="margin-top: 8px;">
            <button type="button" class="dayq-btn" onclick="abrirModalNuevoEmpleado()" style="padding: 6px 12px; font-size: 11px; background: rgba(0,200,150,0.1); color: var(--green); border: 1px solid rgba(0,200,150,0.3);">
              <i class="fa-solid fa-user-plus"></i> Registrar Empleado
            </button>
          </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Monto del Préstamo *</label>
            <input type="number" name="monto_prestamo" id="monto_prestamo" step="0.01" min="1" required
              style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Número de Cuotas *</label>
            <input type="number" name="numero_cuotas" id="num_cuotas" min="1" max="60" value="1" required
              style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Interés (%)</label>
            <input type="number" name="interes_ptj" id="interes_ptj" step="0.01" min="0" value="0"
              style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Método de Pago</label>
            <select name="cod_metodo_pago" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
              <option value="1">Descuento de Nómina</option>
              <option value="2">Pago Voluntario</option>
            </select>
          </div>
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Valor Cuota (estimado)</label>
          <div id="valor_cuota_estimado" style="padding: 8px 10px; background: var(--card2); border: 1px dashed var(--border); border-radius: 6px; color: var(--text2); font-size: 13px;">
            $0.00 (calcular)
          </div>
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Notas (opcional)</label>
          <textarea name="notas" rows="3" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px; resize: vertical;"></textarea>
        </div>
      </div>
      
      <div style="display: flex; gap: 8px; margin-top: 20px;">
        <a href="?m=prestamos" class="dayq-btn" style="padding: 8px 16px;">Cancelar</a>
        <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px; background: var(--accent); color: white;">
          <i class="fa-solid fa-save"></i> Crear Préstamo
        </button>
      </div>
    </form>
  </div>

  <!-- MODAL REGISTRAR EMPLEADO -->
  <div id="modalNuevoEmpleado" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; width: 480px; max-width: 95%; padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; font-size: 16px;"><i class="fa-solid fa-user-plus" style="color: var(--green);"></i> Registrar Empleado</h3>
        <button type="button" onclick="cerrarModalNuevoEmpleado()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text3);">&times;</button>
      </div>
      <form id="formNuevoEmpleado" onsubmit="return guardarNuevoEmpleado()">
        <div style="display: grid; gap: 12px;">
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Nombres *</label>
              <input type="text" name="nombres" id="emp_nombres" required style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
            </div>
            <div>
              <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Apellidos *</label>
              <input type="text" name="apellidos" id="emp_apellidos" required style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
            </div>
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Documento (CC) *</label>
            <input type="text" name="documento" id="emp_documento" required maxlength="14" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Teléfono</label>
            <input type="text" name="telefono" id="emp_telefono" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Correo</label>
            <input type="email" name="correo" id="emp_correo" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Dirección</label>
            <input type="text" name="direccion" id="emp_direccion" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
          </div>
          <div id="emp_error" style="display: none; font-size: 11px; color: var(--red);"></div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 20px;">
          <button type="button" class="dayq-btn" onclick="cerrarModalNuevoEmpleado()" style="padding: 8px 16px;">Cancelar</button>
          <button type="submit" id="btnGuardarEmpleado" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px; background: var(--accent); color: white;">
            <i class="fa-solid fa-check"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
  document.getElementById('monto_prestamo').addEventListener('input', calcularCuota);
  document.getElementById('num_cuotas').addEventListener('input', calcularCuota);
  document.getElementById('interes_ptj').addEventListener('input', calcularCuota);
  
  function calcularCuota() {
    const monto = parseFloat(document.getElementById('monto_prestamo').value) || 0;
    const cuotas = parseInt(document.getElementById('num_cuotas').value) || 1;
    const interes = parseFloat(document.getElementById('interes_ptj').value) || 0;
    
    const total = monto + (monto * interes / 100);
    const valorCuota = cuotas > 0 ? total / cuotas : total;
    
    document.getElementById('valor_cuota_estimado').textContent = '$' + valorCuota.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',') + 
      ' (Total: $' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ')';
  }

  // ═══ Buscador de empleado (autocomplete) ═══
  var _timerBusquedaEmp = null;
  var _resultadosEmpleados = [];
  var _indiceEmpleado = -1;

  function escHtml(s) {
    var div = document.createElement('div');
    div.textContent = s == null ? '' : String(s);
    return div.innerHTML;
  }

  function buscarEmpleadoInput() {
    var input = document.getElementById('buscador_empleado');
    var q = (input.value || '').trim();
    var cont = document.getElementById('resultados_empleado');

    // Si ya había un empleado seleccionado y el usuario reescribe, se limpia la selección
    if (document.getElementById('cod_empleado_hidden').value) {
      limpiarSeleccionEmpleado();
    }

    document.getElementById('error_empleado').style.display = 'none';
    var avisoBuscar = document.getElementById('empleado_notice');
    if (avisoBuscar) avisoBuscar.style.display = 'none';
    clearTimeout(_timerBusquedaEmp);
    if (q.length < 2) {
      cont.style.display = 'none';
      return;
    }
    _timerBusquedaEmp = setTimeout(function() {
      var terminoBusqueda = q;
      fetch('?m=prestamos&ajax=get_empleados&q=' + encodeURIComponent(q))
        .then(function(r) { return r.json(); })
        .then(function(data) {
          // Ignorar respuestas obsoletas si el usuario siguió escribiendo
          if (terminoBusqueda !== (document.getElementById('buscador_empleado').value || '').trim()) {
            return;
          }
          if (!data || !data.success) { cont.style.display = 'none'; return; }
          _resultadosEmpleados = data.items || [];
          _indiceEmpleado = -1;
          if (!_resultadosEmpleados.length) {
            cont.innerHTML = '<div style="padding:10px 14px; color: var(--text3); font-size: 12px;">Sin resultados para "' + escHtml(q) + '"</div>';
            cont.style.display = 'block';
            return;
          }
          var html = '';
          for (var i = 0; i < _resultadosEmpleados.length; i++) {
            var it = _resultadosEmpleados[i];
            html += '<div class="empleado-opcion" style="padding:9px 12px; cursor:pointer; border-bottom: 1px solid var(--border); display:flex; align-items:center; gap:10px;" onmouseenter="resaltarOpcionEmp(' + i + ')">';
            html += '<div style="width:30px; height:30px; border-radius:50%; background: rgba(79,142,247,0.15); color: var(--accent); display:flex; align-items:center; justify-content:center; flex-shrink:0;"><i class="fa-solid fa-user"></i></div>';
            html += '<div style="flex:1; min-width:0;">';
            html += '<div style="font-size:12px; font-weight:700;">' + escHtml(it.nombre || '-') + '</div>';
            html += '<div style="font-size:11px; color: var(--text3);">Doc: ' + escHtml(it.documento || '-') + '</div>';
            html += '</div>';
            html += '</div>';
          }
          cont.innerHTML = html;
          cont.style.display = 'block';
          // Bind directo: el clic debe seleccionar aunque haya stopPropagation en ancestros
          var opcionesRender = cont.querySelectorAll('.empleado-opcion');
          for (var j = 0; j < opcionesRender.length; j++) {
            (function(el, idx) {
              el.addEventListener('click', function(ev) {
                ev.preventDefault();
                ev.stopPropagation();
                if (_resultadosEmpleados[idx]) seleccionarEmpleado(_resultadosEmpleados[idx]);
              });
            })(opcionesRender[j], j);
          }
        })
        .catch(function() { cont.style.display = 'none'; });
    }, 250);
  }

  function resaltarOpcionEmp(idx) {
    _indiceEmpleado = idx;
    var opciones = document.querySelectorAll('#resultados_empleado .empleado-opcion');
    for (var i = 0; i < opciones.length; i++) {
      opciones[i].style.background = (i === idx) ? 'rgba(79,142,247,0.12)' : 'transparent';
    }
  }

  function seleccionarEmpleado(item) {
    document.getElementById('cod_empleado_hidden').value = item.cod_tercero;
    var chip = document.getElementById('empleado_seleccionado');
    chip.innerHTML = '<i class="fa-solid fa-circle-check" style="color: var(--green);"></i> ' +
      '<strong>' + escHtml(item.nombre || '-') + '</strong>' +
      ' <span style="color: var(--text3);">(' + escHtml(item.documento || '-') + ')</span>' +
      ' <button type="button" onclick="limpiarSeleccionEmpleado()" style="margin-left:6px; background:none; border:none; color:var(--red); cursor:pointer; font-size:12px;" title="Quitar"><i class="fa-solid fa-xmark"></i></button>';
    chip.style.display = 'block';
    document.getElementById('resultados_empleado').style.display = 'none';
    document.getElementById('buscador_empleado').value = '';
    document.getElementById('buscador_empleado').setAttribute('readonly', 'readonly');
    document.getElementById('error_empleado').style.display = 'none';
  }

  function limpiarSeleccionEmpleado() {
    document.getElementById('cod_empleado_hidden').value = '';
    document.getElementById('empleado_seleccionado').style.display = 'none';
    document.getElementById('empleado_seleccionado').innerHTML = '';
    var avisoLimp = document.getElementById('empleado_notice');
    if (avisoLimp) avisoLimp.style.display = 'none';
    var input = document.getElementById('buscador_empleado');
    input.value = '';
    input.removeAttribute('readonly');
    input.focus();
  }

  function validarFormPrestamo() {
    var cod = document.getElementById('cod_empleado_hidden').value;
    if (!cod) {
      document.getElementById('error_empleado').style.display = 'block';
      var input = document.getElementById('buscador_empleado');
      input.removeAttribute('readonly');
      input.focus();
      return false;
    }
    return true;
  }

  // Cerrar resultados al hacer clic fuera del buscador
  document.addEventListener('click', function(e) {
    var cont = document.getElementById('resultados_empleado');
    var input = document.getElementById('buscador_empleado');
    if (cont && cont.style.display === 'block' && input && !input.contains(e.target) && !cont.contains(e.target)) {
      cont.style.display = 'none';
    }
  });

  // Navegación con teclado (flechas + Enter + Escape)
  document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('buscador_empleado');
    if (!input) return;
    input.addEventListener('keydown', function(e) {
      var cont = document.getElementById('resultados_empleado');
      if (cont.style.display !== 'block' || !_resultadosEmpleados.length) return;
      if (e.key === 'ArrowDown') {
        e.preventDefault();
        _indiceEmpleado = Math.min(_indiceEmpleado + 1, _resultadosEmpleados.length - 1);
        resaltarOpcionEmp(_indiceEmpleado);
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        _indiceEmpleado = Math.max(_indiceEmpleado - 1, 0);
        resaltarOpcionEmp(_indiceEmpleado);
      } else if (e.key === 'Enter') {
        e.preventDefault();
        var idxEnter = _indiceEmpleado >= 0 ? _indiceEmpleado : 0;
        if (_resultadosEmpleados[idxEnter]) {
          seleccionarEmpleado(_resultadosEmpleados[idxEnter]);
        }
      } else if (e.key === 'Escape') {
        e.preventDefault();
        e.stopPropagation();
        cont.style.display = 'none';
      }
    });
  });

  // ═══ Modal Registrar Empleado ═══
  function abrirModalNuevoEmpleado() {
    document.getElementById('formNuevoEmpleado').reset();
    document.getElementById('emp_error').style.display = 'none';
    document.getElementById('modalNuevoEmpleado').style.display = 'flex';
  }

  function cerrarModalNuevoEmpleado() {
    document.getElementById('modalNuevoEmpleado').style.display = 'none';
  }

  function guardarNuevoEmpleado() {
    var btn = document.getElementById('btnGuardarEmpleado');
    var errEl = document.getElementById('emp_error');
    errEl.style.display = 'none';

    var nombres = document.getElementById('emp_nombres').value.trim();
    var apellidos = document.getElementById('emp_apellidos').value.trim();
    var documento = document.getElementById('emp_documento').value.trim();
    if (!nombres || !apellidos || !documento) {
      errEl.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Nombres, apellidos y documento son obligatorios.';
      errEl.style.display = 'block';
      return false;
    }

    btn.disabled = true;
    var fd = new FormData(document.getElementById('formNuevoEmpleado'));
    fetch('?m=prestamos&ajax=crear_empleado', { method: 'POST', body: fd })
      .then(function(r) { return r.json(); })
      .then(function(data) {
        btn.disabled = false;
        if (data && data.success && data.item) {
          cerrarModalNuevoEmpleado();
          seleccionarEmpleado(data.item);
          var aviso = document.getElementById('empleado_notice');
          if (data.reutilizado && aviso) {
            aviso.innerHTML = '<i class="fa-solid fa-circle-info"></i> El documento ya estaba registrado. Se seleccionó el empleado existente.';
            aviso.style.display = 'block';
          } else if (aviso) {
            aviso.style.display = 'none';
          }
        } else {
          errEl.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> ' + escHtml((data && data.error) ? data.error : 'No se pudo registrar el empleado.');
          errEl.style.display = 'block';
        }
      })
      .catch(function() {
        btn.disabled = false;
        errEl.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Error de conexión al registrar el empleado.';
        errEl.style.display = 'block';
      });
    return false;
  }

  document.getElementById('modalNuevoEmpleado').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalNuevoEmpleado();
  });
  </script>

  <?php elseif ($accion === 'detalle' && $id > 0): ?>
  <!-- ========== VISTA DETALLE PRÉSTAMO ========== -->
  <?php
  $prestamo = $db_service->getPrestamoDetalle($id);
  if (!$prestamo):
  ?>
  <div class="dayq-section">
    <p style="color: var(--red); text-align: center; padding: 20px;">Préstamo no encontrado</p>
  </div>
  <?php else:
  $cuotas = $db_service->getCuotasPrestamo($id);
  $estado_texto = $prestamo['cod_estado_prestamo'] == 1 ? 'Activo' : ($prestamo['cod_estado_prestamo'] == 2 ? 'Pagado' : 'Anulado');
  $estado_clase = $prestamo['cod_estado_prestamo'] == 1 ? 'badge-info' : ($prestamo['cod_estado_prestamo'] == 2 ? 'badge-success' : 'badge-danger');
  $cuotas_pagadas = 0;
  $total_pagado = 0;
  foreach ($cuotas as $c) {
      if ($c['cod_estado_cuota'] == 2) { $cuotas_pagadas++; $total_pagado += $c['valor_cuota']; }
  }
  ?>
  <div class="dayq-section">
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
      <div>
        <h3 class="dayq-section-title" style="margin: 0 0 8px 0;">
          Préstamo #<?php echo $prestamo['cod_prestamo_empleado']; ?>
          <span class="badge <?php echo $estado_clase; ?>"><?php echo $estado_texto; ?></span>
        </h3>
        <p style="margin: 0; color: var(--text3); font-size: 12px;">
          Empleado: <strong><?php echo htmlspecialchars(isset($prestamo['empleado_nombre']) ? $prestamo['empleado_nombre'] : '-'); ?></strong>
          (<?php echo htmlspecialchars(isset($prestamo['empleado_documento']) ? $prestamo['empleado_documento'] : '-'); ?>)
        </p>
      </div>
      <div style="display: flex; gap: 8px;">
        <?php if ($prestamo['cod_estado_prestamo'] == 1): ?>
          <button class="dayq-btn" style="color: var(--red);" onclick="if(confirm('¿Anular este préstamo?')) document.getElementById('formAnular').submit();">
            <i class="fa-solid fa-ban"></i> Anular
          </button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="kpi-grid" style="margin-bottom: 16px; grid-template-columns: repeat(4, 1fr);">
    <div class="kpi-card">
      <div class="kpi-label">Monto</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($prestamo['monto_prestamo']); ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label">Cuotas</div>
      <div class="kpi-value"><?php echo $cuotas_pagadas; ?> / <?php echo $prestamo['numero_cuotas']; ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label">Valor Cuota</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($prestamo['valor_cuota']); ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label">Total Pagar</div>
      <div class="kpi-value">$<?php echo dayq_formato_moneda($prestamo['total_pagar']); ?></div>
    </div>
  </div>

  <div class="dayq-section">
    <h3 class="dayq-section-title"><i class="fa-solid fa-list"></i> Cuotas del Préstamo</h3>
    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th># Cuota</th>
          <th>Valor</th>
          <th>Vencimiento</th>
          <th>Estado</th>
          <th>Fecha Pago</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cuotas as $c): 
          $est_cuota = $c['cod_estado_cuota'] == 1 ? 'Pendiente' : ($c['cod_estado_cuota'] == 2 ? 'Pagada' : 'Anulada');
          $est_clase = $c['cod_estado_cuota'] == 1 ? 'badge-warning' : ($c['cod_estado_cuota'] == 2 ? 'badge-success' : 'badge-danger');
          $vencida = $c['cod_estado_cuota'] == 1 && strtotime($c['fecha_vencimiento']) < time();
        ?>
        <tr style="<?php echo $vencida ? 'background: rgba(239,68,68,0.05);' : ''; ?>">
          <td style="font-weight: 600;"><?php echo $c['numero_cuota']; ?></td>
          <td style="font-family: 'DM Mono', monospace;">$<?php echo dayq_formato_moneda($c['valor_cuota']); ?></td>
          <td style="color: <?php echo $vencida ? 'var(--red)' : 'var(--text3)'; ?>;">
            <?php echo dayq_formato_fecha($c['fecha_vencimiento']); ?>
            <?php if ($vencida): ?><span style="color: var(--red); font-size: 10px;"> (Vencida)</span><?php endif; ?>
          </td>
          <td><span class="badge <?php echo $est_clase; ?>"><?php echo $est_cuota; ?></span></td>
          <td><?php echo $c['fecha_pago'] ? dayq_formato_fecha($c['fecha_pago']) : '-'; ?></td>
          <td>
            <?php if ($c['cod_estado_cuota'] == 1 && $prestamo['cod_estado_prestamo'] == 1): ?>
              <button class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" onclick="abrirModalPago(<?php echo $c['cod_prestamo_empleado_cuota']; ?>, <?php echo $c['valor_cuota']; ?>)">
                <i class="fa-solid fa-check"></i> Pagar
              </button>
            <?php else: ?>
              <span style="color: var(--text3); font-size: 11px;">—</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>
  </div>

  <!-- Formulario oculto para anular -->
  <form id="formAnular" method="POST" action="reg_dayq.php" style="display: none;">
    <input type="hidden" name="entity" value="prestamo">
    <input type="hidden" name="action" value="anular">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="motivo" value="Anulación manual">
  </form>

  <!-- Modal Pago de Cuota -->
  <div id="modalPagoCuota" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; width: 450px; max-width: 95%; padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; font-size: 16px;">Pagar Cuota</h3>
        <button onclick="cerrarModalPago()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text3);">&times;</button>
      </div>
      <form method="POST" action="reg_dayq.php">
        <input type="hidden" name="entity" value="pago_cuota">
        <input type="hidden" name="id" id="pago_cuota_id" value="0">
        <input type="hidden" name="cod_prestamo" value="<?php echo $id; ?>">
        
        <div style="display: grid; gap: 12px;">
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Valor a Pagar</label>
            <div id="pago_valor_cuota" style="font-size: 18px; font-weight: 700; color: var(--accent); font-family: 'DM Mono', monospace;">$0</div>
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Forma de Pago</label>
            <select name="cod_tipo_forma_pago" required style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
              <option value="1">Descuento de Nómina</option>
              <option value="2">Efectivo</option>
              <option value="3">Transferencia</option>
            </select>
          </div>
          <div>
            <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Cuenta Bancaria (solo descuento nómina)</label>
            <select name="cod_banco_cuenta" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
              <option value="">N/A</option>
              <?php
              $cuentas = $db_service->getCuentasBancarias();
              if ($cuentas['success']) {
                  foreach ($cuentas['items'] as $cta):
              ?>
              <option value="<?php echo $cta['cod_banco_cuenta']; ?>">
                <?php echo htmlspecialchars($cta['nombre_banco_cuenta'] . ' - ' . $cta['numero_banco_cuenta']); ?>
              </option>
              <?php endforeach; } ?>
            </select>
          </div>
        </div>
        
        <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 20px;">
          <button type="button" onclick="cerrarModalPago()" class="dayq-btn" style="padding: 8px 16px;">Cancelar</button>
          <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px; background: var(--accent); color: white;">
            <i class="fa-solid fa-check"></i> Confirmar Pago
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
  function abrirModalPago(cuotaId, valor) {
    document.getElementById('pago_cuota_id').value = cuotaId;
    document.getElementById('pago_valor_cuota').textContent = '$' + valor.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    document.getElementById('modalPagoCuota').style.display = 'flex';
  }
  
  function cerrarModalPago() {
    document.getElementById('modalPagoCuota').style.display = 'none';
  }
  
  document.getElementById('modalPagoCuota').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalPago();
  });
  </script>

  <?php endif; ?>
  <?php endif; ?>
</div>

<style>
.dayq-alert {
  padding: 10px 14px;
  border-radius: 8px;
  margin-bottom: 12px;
  font-size: 12px;
}
.dayq-alert-success { background: rgba(0,200,150,0.1); border: 1px solid var(--green); color: var(--green); }
.dayq-alert-danger { background: rgba(239,68,68,0.1); border: 1px solid var(--red); color: var(--red); }
</style>

<script>
function buscarPrestamos() {
  const buscar = document.getElementById('buscar').value;
  window.location.href = '?m=prestamos&buscar=' + encodeURIComponent(buscar);
}
// Inicializar filtros de tabla
document.addEventListener('DOMContentLoaded', function() {
    var tables = document.querySelectorAll('.dayq-table');
    if (tables.length > 0 && typeof initFiltrosTabla === 'function') {
        initFiltrosTabla(tables[0].id || 'tabla-prestamos', {
            tipos: {
                0: 'text',    // ID
                1: 'text',    // Empleado
                2: 'text',    // Documento
                3: 'text',    // Monto
                4: 'text',    // Cuotas
                8: 'select'   // Estado
            },
            opciones: {
                8: ['Activo', 'Pagado', 'Anulado']
            }
        });
    }
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
