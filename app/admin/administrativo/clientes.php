<?php
/**
 * app/admin/administrativo/clientes.php
 * Módulo de Clientes - Gestión de terceros
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);

// AJAX: obtener datos de un cliente para editar
$ajax = dayq_get_str('ajax', '');
if ($ajax === 'get_cliente') {
    header('Content-Type: application/json');
    $id = dayq_get_int('id', 0);
    if ($id <= 0) {
        echo json_encode(['success' => false]);
        exit;
    }
    $data = $db_service->getClienteDetalle($id);
    if ($data) {
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

$dayq_page_title = 'Clientes';
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$buscar = dayq_get_str('buscar', '');
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title"><i class="fa-solid fa-users"></i> Clientes</h1>
    <button class="dayq-help-btn" onclick="showModuleGuide('clientes')" title="Guía del módulo de clientes"><i class="fa-solid fa-circle-question"></i></button>
    <div class="dayq-topbar-actions">
      <div class="dayq-topbar-filter">
        <input type="text" id="buscar" placeholder="Buscar cliente (nombre, ID)..." value="<?php echo htmlspecialchars($buscar); ?>" style="padding: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
        <button class="dayq-btn dayq-btn-primary" onclick="buscarClientes()">Buscar</button>
      </div>
    </div>
  </div>

  <!-- TABLA DE CLIENTES -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Listado de Clientes</h3>
    <?php
    $total_registros = $db_service->getClientesTotal($buscar);
    $por_pagina = 15;
    $total_paginas = ceil($total_registros / $por_pagina);
    $clientes = $db_service->getClientesPaginados($pagina, $por_pagina, $buscar);
    ?>

    <div class="dayq-table-wrap"><table class="dayq-table" id="tabla-clientes">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Identificación</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Créditos Activos</th>
          <th>Valor Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($clientes) > 0): ?>
          <?php foreach ($clientes as $cliente): ?>
            <tr>
              <td><strong><?php echo htmlspecialchars($cliente['nombres_apellidos_tercero']); ?></strong></td>
              <td><?php echo htmlspecialchars(isset($cliente['identificacion_tercero']) ? $cliente['identificacion_tercero'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cliente['telefono1_tercero']) ? $cliente['telefono1_tercero'] : '-'); ?></td>
              <td><?php echo htmlspecialchars(isset($cliente['correo_tercero']) ? $cliente['correo_tercero'] : '-'); ?></td>
              <td style="text-align: center; font-weight: 600;"><?php echo isset($cliente['total_creditos']) ? $cliente['total_creditos'] : 0; ?></td>
              <td style="font-weight: 600; color: var(--accent);">$<?php echo dayq_formato_moneda(isset($cliente['valor_total']) ? $cliente['valor_total'] : 0); ?></td>
              <td>
                <div style="display: flex; gap: 4px;">
                  <a href="?m=cliente_detalle&id=<?php echo $cliente['cod_tercero']; ?>" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Ver detalle">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <button onclick="abrirModalEditarCliente(<?php echo $cliente['cod_tercero']; ?>)" class="dayq-btn" style="padding: 4px 8px; font-size: 11px;" title="Editar">
                    <i class="fa-solid fa-pen"></i>
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 20px; color: var(--text3);">
              No hay clientes registrados
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
      <div class="dayq-pagination">
        <?php if ($pagina > 1): ?>
          <a href="?m=clientes&page=1" title="Primera página">&laquo;</a>
          <a href="?m=clientes&page=<?php echo $pagina - 1; ?>" title="Página anterior">&lsaquo;</a>
        <?php endif; ?>

        <?php 
        $inicio = max(1, $pagina - 2);
        $fin = min($total_paginas, $pagina + 2);
        for ($i = $inicio; $i <= $fin; $i++):
        ?>
          <?php if ($i === $pagina): ?>
            <span class="active"><?php echo $i; ?></span>
          <?php else: ?>
            <a href="?m=clientes&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
          <a href="?m=clientes&page=<?php echo $pagina + 1; ?>" title="Página siguiente">&rsaquo;</a>
          <a href="?m=clientes&page=<?php echo $total_paginas; ?>" title="Última página">&raquo;</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL EDITAR CLIENTE -->
<div id="modalCliente" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
  <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; width: 480px; max-width: 95%; max-height: 90vh; overflow-y: auto; padding: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 style="margin: 0; font-size: 16px;">Editar Cliente</h3>
      <button onclick="cerrarModalCliente()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text3);" title="Cerrar">&times;</button>
    </div>
    <form method="POST" action="reg_dayq.php" onsubmit="return validarFormCliente()">
      <input type="hidden" name="entity" value="cliente">
      <input type="hidden" name="id" id="cliente_id" value="0">
      
      <div style="display: grid; gap: 12px;">
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Nombre *</label>
          <input type="text" name="nombre" id="cli_nombre" required
            pattern=".{3,}" title="El nombre debe tener al menos 3 caracteres"
            style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Teléfono</label>
          <input type="tel" name="telefono" id="cli_telefono"
            pattern="[0-9\-\+\s]{7,20}" title="Ingrese un número telefónico válido (7-20 dígitos)"
            style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Email</label>
          <input type="email" name="correo" id="cli_correo"
            pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" title="Ingrese un correo electrónico válido"
            style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Dirección</label>
          <input type="text" name="direccion" id="cli_direccion"
            style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
      </div>
      
      <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 20px;">
        <button type="button" onclick="cerrarModalCliente()" class="dayq-btn" style="padding: 8px 16px;">Cancelar</button>
        <button type="submit" class="dayq-btn dayq-btn-primary" style="padding: 8px 20px; background: var(--accent); color: white;">
          <i class="fa-solid fa-save"></i> Guardar Cambios
        </button>
      </div>
    </form>
  </div>
</div>

<style>
.dayq-modal {
  display: none;
}
</style>

<script>
// Inicializar filtros de tabla
document.addEventListener('DOMContentLoaded', function() {
    var tables = document.querySelectorAll('.dayq-table');
    if (tables.length > 0 && typeof initFiltrosTabla === 'function') {
        initFiltrosTabla(tables[0].id || 'tabla-clientes', {
            tipos: {
                0: 'text',  // Nombre
                1: 'text',  // Identificación
                2: 'text',  // Teléfono
                3: 'text'   // Email
            }
        });
    }
});

function buscarClientes() {
  const buscar = document.getElementById('buscar').value;
  window.location.href = '?m=clientes&buscar=' + encodeURIComponent(buscar);
}

function abrirModalEditarCliente(id) {
  // Cargar datos del cliente vía AJAX
  fetch('?m=clientes&ajax=get_cliente&id=' + id)
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        document.getElementById('cliente_id').value = id;
        document.getElementById('cli_nombre').value = data.data.nombre || '';
        document.getElementById('cli_telefono').value = data.data.telefono || '';
        document.getElementById('cli_correo').value = data.data.email || '';
        document.getElementById('cli_direccion').value = data.data.direccion_tercero || '';
        document.getElementById('modalCliente').style.display = 'flex';
      } else {
        alert('Error al cargar datos del cliente');
      }
    })
    .catch(function() { alert('Error de conexión al cargar datos del cliente'); });
}

function cerrarModalCliente() {
  document.getElementById('modalCliente').style.display = 'none';
}

function validarFormCliente() {
  var nombre = document.getElementById('cli_nombre').value.trim();
  if (nombre.length < 3) {
    alert('El nombre debe tener al menos 3 caracteres');
    document.getElementById('cli_nombre').focus();
    return false;
  }
  return true;
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalCliente').addEventListener('click', function(e) {
  if (e.target === this) cerrarModalCliente();
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
