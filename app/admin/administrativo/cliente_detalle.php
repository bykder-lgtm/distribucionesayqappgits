<?php
/**
 * app/admin/administrativo/cliente_detalle.php
 * Detalle de Cliente - Información del cliente y sus créditos
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$cod_cliente = dayq_get_int('id', 0);
if ($cod_cliente <= 0) {
    header('Location: ?m=clientes');
    exit;
}

$db_service = new DayqDbService($conectar);

$cliente = $db_service->getClienteDetalle($cod_cliente);
if (!$cliente) {
    echo 'Cliente no encontrado';
    exit;
}

$dayq_page_title = 'Detalle de Cliente: ' . $cliente['nombre'];
include __DIR__ . '/layout_header.php';

$pagina = dayq_get_int('page', 1);
$creditos_data = $db_service->getCreditosPorCliente($cod_cliente, $pagina, 15);
$creditos = $creditos_data['items'];
$total_paginas = $creditos_data['total_paginas'];
?>

<div class="dayq-container">
  <div class="dayq-topbar">
    <h1 class="dayq-topbar-title">
      <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($cliente['nombre']); ?>
    </h1>
    <div style="display: flex; gap: 6px;">
      <button onclick="abrirModalEditarCliente(<?php echo $cod_cliente; ?>)" class="dayq-btn" style="padding: 6px 12px;" title="Editar datos del cliente">
        <i class="fa-solid fa-pen"></i> Editar
      </button>
      <a href="?m=clientes" class="dayq-btn"><i class="fa-solid fa-arrow-left"></i> Volver a Clientes</a>
    </div>
  </div>

  <!-- MENSAJES FLASH -->
  <?php if (isset($_GET['msg']) && $_GET['msg'] !== ''): ?>
    <div class="dayq-alert dayq-alert-success">
      <i class="fa-solid fa-check-circle"></i> <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_GET['err']) && $_GET['err'] !== ''): ?>
    <div class="dayq-alert dayq-alert-danger">
      <i class="fa-solid fa-exclamation-circle"></i> <?php echo htmlspecialchars($_GET['err']); ?>
    </div>
  <?php endif; ?>

  <!-- INFO DEL CLIENTE -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Información del Cliente</h3>
    <div class="dayq-grid-3">
      <div style="font-size: 12px;">
        <p><strong>Identificación:</strong> <?php echo htmlspecialchars(isset($cliente['identificacion']) ? $cliente['identificacion'] : '-'); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars(isset($cliente['telefono']) ? $cliente['telefono'] : '-'); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars(isset($cliente['email']) ? $cliente['email'] : '-'); ?></p>
      </div>
      <div style="font-size: 12px;">
        <p><strong>Total Créditos:</strong> <?php echo isset($cliente['total_creditos']) ? $cliente['total_creditos'] : 0; ?></p>
        <p><strong>Valor Total:</strong> <span style="color: var(--accent); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cliente['valor_total']) ? $cliente['valor_total'] : 0); ?></span></p>
        <p><strong>Saldo Deuda:</strong> <span style="color: var(--yellow); font-weight: 600;">$<?php echo dayq_formato_moneda(isset($cliente['monto_deuda']) ? $cliente['monto_deuda'] : 0); ?></span></p>
      </div>
    </div>
  </div>

  <!-- CRÉDITOS DEL CLIENTE -->
  <div class="dayq-section">
    <h3 class="dayq-section-title">Créditos Asociados</h3>

    <?php if (count($creditos) > 0): ?>
    <div class="dayq-table-wrap"><table class="dayq-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Comercio</th>
          <th>Línea</th>
          <th>Valor</th>
          <th>Abonado</th>
          <th>Saldo</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($creditos as $cred): ?>
        <tr>
          <td><strong>#<?php echo (int)$cred['cod_info_factura_venta']; ?></strong><?php if (!empty($cred['cod_factura']) && $cred['cod_factura'] !== '0'): ?> <small style="color:var(--text3);font-weight:400;">/ F:<?php echo $cred['cod_factura']; ?></small><?php endif; ?></td>
          <td><?php echo htmlspecialchars(isset($cred['comercio']) ? $cred['comercio'] : '-'); ?></td>
          <td><?php echo htmlspecialchars(isset($cred['linea']) ? $cred['linea'] : '-'); ?></td>
          <td>$<?php echo dayq_formato_moneda(isset($cred['valor']) ? $cred['valor'] : 0); ?></td>
          <td>$<?php echo dayq_formato_moneda(isset($cred['abonado']) ? $cred['abonado'] : 0); ?></td>
          <td><strong>$<?php echo dayq_formato_moneda((isset($cred['valor']) ? $cred['valor'] : 0) - (isset($cred['abonado']) ? $cred['abonado'] : 0)); ?></strong></td>
          <td><span class="badge <?php echo dayq_get_estado_clase($cred['nombre_estado_factura']); ?>">
            <?php echo dayq_get_estado_texto($cred['nombre_estado_factura']); ?>
          </span></td>
          <td>
            <a href="?m=credito_detalle&id=<?php echo $cred['cod_info_factura_venta']; ?>" class="dayq-btn">Ver</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>

    <!-- PAGINACIÓN -->
    <?php if ($total_paginas > 1): ?>
    <div class="dayq-pagination">
      <?php if ($pagina > 1): ?>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=1">&laquo;</a>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $pagina - 1; ?>">&lsaquo;</a>
      <?php endif; ?>
      <?php $inicio = max(1, $pagina - 2); $fin = min($total_paginas, $pagina + 2); ?>
      <?php for ($i = $inicio; $i <= $fin; $i++): ?>
        <?php if ($i === $pagina): ?>
          <span class="active"><?php echo $i; ?></span>
        <?php else: ?>
          <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($pagina < $total_paginas): ?>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $pagina + 1; ?>">&rsaquo;</a>
        <a href="?m=cliente_detalle&id=<?php echo $cod_cliente; ?>&page=<?php echo $total_paginas; ?>">&raquo;</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <p style="color: var(--text3); text-align: center; padding: 20px;">Este cliente no tiene créditos registrados</p>
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
      <input type="hidden" name="redirect" value="m=cliente_detalle&id=<?php echo $cod_cliente; ?>">
      
      <div style="display: grid; gap: 12px;">
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Nombre *</label>
          <input type="text" name="nombre" id="cli_nombre" required
            pattern=".{3,}" title="El nombre debe tener al menos 3 caracteres"
            style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 13px;">
        </div>
        <div>
          <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px;">Identificación</label>
          <input type="text" id="cli_identificacion" readonly disabled
            style="width: 100%; padding: 8px 10px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text3); font-size: 13px; opacity: 0.7;">
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

<script>
function abrirModalEditarCliente(id) {
  // Cargar datos del cliente vía AJAX desde el endpoint de clientes.php
  fetch('?m=clientes&ajax=get_cliente&id=' + id)
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        document.getElementById('cliente_id').value = id;
        document.getElementById('cli_nombre').value = data.data.nombre || '';
        document.getElementById('cli_identificacion').value = data.data.identificacion || '-';
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

<style>
.dayq-alert {
  padding: 10px 14px;
  border-radius: 8px;
  margin-bottom: 12px;
  font-size: 12px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.dayq-alert-success { background: rgba(0,200,150,0.1); border: 1px solid var(--green); color: var(--green); }
.dayq-alert-danger { background: rgba(239,68,68,0.1); border: 1px solid var(--red); color: var(--red); }
</style>

<?php include __DIR__ . '/layout_footer.php'; ?>
