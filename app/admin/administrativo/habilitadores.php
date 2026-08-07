<?php
/**
 * app/admin/administrativo/habilitadores.php
 * Módulo de Líneas de Crédito - Gestión de entidades crediticias (habilitadores)
 *
 * Funcionalidades:
 * - Listado paginado con filtros (nombre, estado)
 * - Crear, editar, activar/desactivar líneas de crédito
 * - AJAX para carga de datos en modal de edición
 * - Badge de estado visual (Activo/Inactivo)
 *
 * Tablas principales:
 * - tbl15_entidad_crediticia
 *
 * @see changelog/CAMBIOS_20260724.md
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

// AJAX: obtener datos de un habilitador para editar
$ajax = dayq_get_str('ajax', '');
if ($ajax === 'get_habilitador') {
    header('Content-Type: application/json');
    $id = dayq_get_int('id', 0);
    if ($id <= 0) {
        echo json_encode(['success' => false]);
        exit;
    }
    $data = $db_service->getHabilitadorParaEditar($id);
    if ($data) {
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

$dayq_page_title = 'Líneas de Crédito';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
$filtro_estado = dayq_get_str('estado', '1'); // 1 = activos por defecto
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-handshake"></i> Líneas de Crédito</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('habilitadores')" title="Guía de líneas de crédito"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <div class="dayq-topbar-filter">
        <input type="text" id="buscar" placeholder="Buscar línea..." value="<?php echo htmlspecialchars($buscar); ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; width: 180px;">
        <select id="filtro_estado" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
          <option value="1" <?php echo $filtro_estado === '1' ? 'selected' : ''; ?>>Activos</option>
          <option value="0" <?php echo $filtro_estado === '0' ? 'selected' : ''; ?>>Inactivos</option>
          <option value="" <?php echo $filtro_estado === '' ? 'selected' : ''; ?>>Todos</option>
        </select>
        <button class="dayq-btn dayq-btn-primary" onclick="buscarHabilitadores()"><i class="fa-solid fa-search"></i> Buscar</button>
        <button class="dayq-btn" onclick="abrirModalCrear()" style="background: var(--accent); color: white;"><i class="fa-solid fa-plus"></i> Nueva Línea</button>
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

  <!-- TABLA DE HABILITADORES -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">
      Líneas de Crédito 
      <span style="font-size: 11px; color: var(--text3); font-weight: 400;">
        (<?php echo $filtro_estado === '1' ? 'Activas' : ($filtro_estado === '0' ? 'Inactivas' : 'Todas'); ?>)
      </span>
    </h3>
    <?php
    // Filtrar por estado a nivel SQL
    $estado_filtro = $filtro_estado !== '' ? $filtro_estado : null;
    $total_registros = $db_service->getHabilitadoresTotal($buscar, $estado_filtro);
    $por_pagina = 15;
    $total_paginas = max(1, ceil($total_registros / $por_pagina));
    $pagina = min($pagina, $total_paginas);
    $habilitadores = $db_service->getHabilitadoresPaginados($pagina, $por_pagina, $buscar, $estado_filtro);
    ?>

    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>NIT</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Créditos</th>
          <th>Valor Total</th>
          <th>Comisión (%)</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($habilitadores) > 0): ?>
          <?php foreach ($habilitadores as $hab): 
            $activo = isset($hab['cod_estado']) && $hab['cod_estado'] == 1;
          ?>
            <tr style="<?php echo !$activo ? 'opacity: 0.6;' : ''; ?>">
              <td><strong><?php echo htmlspecialchars($hab['nombre_entidad_crediticia']); ?></strong></td>
              <td><?php echo htmlspecialchars(isset($hab['nit']) ? $hab['nit'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($hab['nombre_contacto']) ? $hab['nombre_contacto'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($hab['telefono1_tercero']) ? $hab['telefono1_tercero'] : '-'); ?></td>
              <td style="text-align: center; font-weight: 600;"><?php echo isset($hab['total_creditos']) ? $hab['total_creditos'] : 0; ?></td>
              <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($hab['valor_total']) ? $hab['valor_total'] : 0); ?></td>
              <td style="text-align: center; font-weight: 600;"><?php echo dayq_formato_porcentaje(isset($hab['comision_ptj']) ? $hab['comision_ptj'] : 0); ?></td>
              <td>
                <span class="badge <?php echo $activo ? 'badge-success' : 'badge-danger'; ?>">
                  <?php echo $activo ? 'Activo' : 'Inactivo'; ?>
                </span>
              </td>
              <td>
                <div style="display: flex; gap: 4px;">
                  <a href="?m=habilitador_detalle&id=<?php echo $hab['cod_entidad_crediticia']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Ver detalle">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <button onclick="abrirModalEditar(<?php echo $hab['cod_entidad_crediticia']; ?>)" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Editar">
                    <i class="fa-solid fa-pen"></i>
                  </button>
                  <?php if ($activo): ?>
                    <button onclick="confirmarDesactivar(<?php echo $hab['cod_entidad_crediticia']; ?>)" class="dayq-btn" style="padding: 4px 8px; font-size: 11px; color: var(--red);" title="Desactivar">
                      <i class="fa-solid fa-ban"></i>
                    </button>
                  <?php else: ?>
                    <button onclick="confirmarActivar(<?php echo $hab['cod_entidad_crediticia']; ?>)" class="dayq-btn" style="padding: 4px 8px; font-size: 11px; color: var(--green);" title="Reactivar">
                      <i class="fa-solid fa-check"></i>
                    </button>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="9" style="text-align: center; padding: 20px; color: var(--text3);">
              No hay líneas de crédito registradas
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=habilitadores&page=1&estado=<?php echo urlencode($filtro_estado); ?>&buscar=<?php echo urlencode($buscar); ?>">&laquo;</a>
          <a href="?m=habilitadores&page=<?php echo $pagina - 1; ?>&estado=<?php echo urlencode($filtro_estado); ?>&buscar=<?php echo urlencode($buscar); ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=habilitadores&page=<?php echo $i; ?>&estado=<?php echo urlencode($filtro_estado); ?>&buscar=<?php echo urlencode($buscar); ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=habilitadores&page=<?php echo $pagina + 1; ?>&estado=<?php echo urlencode($filtro_estado); ?>&buscar=<?php echo urlencode($buscar); ?>">&rsaquo;</a>
          <a href="?m=habilitadores&page=<?php echo $total_paginas; ?>&estado=<?php echo urlencode($filtro_estado); ?>&buscar=<?php echo urlencode($buscar); ?>">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL CREAR/EDITAR HABILITADOR -->
<div id="modalHabilitador" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
  <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; width: 520px; max-width: 95%; max-height: 90vh; overflow-y: auto; padding: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 id="modalTitle" style="margin: 0; font-size: 16px;">Nueva Línea de Crédito</h3>
      <button onclick="cerrarModal()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text3);">&times;</button>
    </div>
    <form id="formHabilitador" method="POST" action="reg_dayq.php">
      <input type="hidden" name="entity" value="habilitador">
      <input type="hidden" name="id" id="habilitador_id" value="0">
      <input type="hidden" name="action" value="save">
      
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
        <div style="grid-column: 1 / -1;">
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Nombre *</label>
          <input type="text" name="nombre" id="hab_nombre" required style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">NIT</label>
          <input type="text" name="nit" id="hab_nit" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Teléfono</label>
          <input type="text" name="telefono" id="hab_telefono" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Email</label>
          <input type="email" name="correo" id="hab_correo" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Nombre Contacto</label>
          <input type="text" name="nombre_contacto" id="hab_contacto" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Interés (%)</label>
          <input type="number" name="interes_ptj" id="hab_interes" step="0.01" min="0" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Comisión (%)</label>
          <input type="number" name="comision_ptj" id="hab_comision" step="0.01" min="0" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div id="estado_field" style="display: none;">
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Estado</label>
          <select name="cod_estado" id="hab_estado" style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
      
      <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 20px;">
        <button type="button" onclick="cerrarModal()" class="dayq-btn" style="padding: 8px 16px;">Cancelar</button>
        <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px; background: var(--accent); color: white;">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- FORMULARIO OCULTO PARA DESACTIVAR/ACTIVAR -->
<form id="formAccion" method="POST" action="reg_dayq.php" style="display: none;">
  <input type="hidden" name="entity" value="habilitador">
  <input type="hidden" name="id" id="accion_id" value="0">
  <input type="hidden" name="action" id="accion_tipo" value="delete">
</form>

<style>
.dayq-alert {
  padding: 10px 14px;
  border-radius: 8px;
  margin-bottom: 12px;
  font-size: 12px;
}
.dayq-alert-success {
  background: rgba(0,200,150,0.1);
  border: 1px solid var(--green);
  color: var(--green);
}
.dayq-alert-danger {
  background: rgba(239,68,68,0.1);
  border: 1px solid var(--red);
  color: var(--red);
}
</style>

<script>
function buscarHabilitadores() {
  const buscar = document.getElementById('buscar').value;
  const estado = document.getElementById('filtro_estado').value;
  window.location.href = '?m=habilitadores&estado=' + encodeURIComponent(estado) + '&buscar=' + encodeURIComponent(buscar);
}

function abrirModalCrear() {
  document.getElementById('modalTitle').textContent = 'Nueva Línea de Crédito';
  document.getElementById('habilitador_id').value = '0';
  document.getElementById('formHabilitador').reset();
  document.getElementById('estado_field').style.display = 'none';
  document.getElementById('modalHabilitador').style.display = 'flex';
}

function abrirModalEditar(id) {
  document.getElementById('modalTitle').textContent = 'Editar Línea de Crédito';
  document.getElementById('habilitador_id').value = id;
  document.getElementById('estado_field').style.display = 'block';
  
  // Cargar datos vía AJAX
  fetch('?m=habilitadores&ajax=get_habilitador&id=' + id)
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        document.getElementById('hab_nombre').value = data.data.nombre_entidad_crediticia || '';
        document.getElementById('hab_nit').value = data.data.identificacion_tercero || '';
        document.getElementById('hab_telefono').value = data.data.telefono1_tercero || '';
        document.getElementById('hab_correo').value = data.data.correo_tercero || '';
        document.getElementById('hab_contacto').value = data.data.nombre_contacto || '';
        document.getElementById('hab_interes').value = data.data.interes_ptj || 0;
        document.getElementById('hab_comision').value = data.data.comision_ptj || 0;
        document.getElementById('hab_estado').value = data.data.cod_estado || 1;
      }
    })
    .catch(() => alert('Error al cargar datos del habilitador'));
  
  document.getElementById('modalHabilitador').style.display = 'flex';
}

function cerrarModal() {
  document.getElementById('modalHabilitador').style.display = 'none';
}

function confirmarDesactivar(id) {
  if (confirm('¿Está seguro de desactivar esta línea de crédito?')) {
    document.getElementById('accion_id').value = id;
    document.getElementById('accion_tipo').value = 'delete';
    document.getElementById('formAccion').submit();
  }
}

function confirmarActivar(id) {
  if (confirm('¿Está seguro de reactivar esta línea de crédito?')) {
    document.getElementById('accion_id').value = id;
    document.getElementById('accion_tipo').value = 'activate';
    document.getElementById('formAccion').submit();
  }
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalHabilitador').addEventListener('click', function(e) {
  if (e.target === this) cerrarModal();
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
