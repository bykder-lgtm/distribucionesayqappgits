<?php
require_once __DIR__ . '/bootstrap.php';
$id = dayq_get_int('id');
$dayq_page_title = $id ? 'Editar compra' : 'Nueva compra';
$row = ['id' => 0, 'numero' => '', 'fecha' => date('Y-m-d\TH:i'), 'proveedor_id' => '', 'estado' => 'PENDIENTE', 'pagada' => 0];
$lines = [['descripcion' => '', 'cantidad' => 1, 'precio_unitario' => '0']];
if ($id > 0) {
	$q = $conectar->query('SELECT * FROM compra WHERE id=' . $id);
	if ($q && ($t = $q->fetch_assoc())) {
		$row = $t;
		$row['fecha'] = str_replace(' ', 'T', substr($row['fecha'], 0, 16));
		$lq = $conectar->query('SELECT * FROM linea_compra WHERE compra_id=' . $id . ' ORDER BY id');
		$lines = [];
		while ($lq && ($ln = $lq->fetch_assoc())) {
			$lines[] = $ln;
		}
		if (count($lines) === 0) {
			$lines[] = ['descripcion' => '', 'cantidad' => 1, 'precio_unitario' => '0'];
		}
	}
}
include __DIR__ . '/layout_header.php';

function dayq_options_proveedores_edit(mysqli $con, $sel) {
	$r = $con->query('SELECT id, nombre FROM proveedor WHERE activo=1 ORDER BY nombre');
	$o = '';
	while ($r && ($row = $r->fetch_assoc())) {
		$s = ((int) $row['id'] === (int) $sel) ? ' selected' : '';
		$o .= '<option value="' . (int) $row['id'] . '"' . $s . '>' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}
function dayq_options_cuentas_edit(mysqli $con, $sel) {
	$r = $con->query('SELECT id, codigo, nombre FROM cuenta WHERE activo=1 ORDER BY codigo');
	$o = '';
	while ($r && ($row = $r->fetch_assoc())) {
		$s = ((int) $row['id'] === (int) $sel) ? ' selected' : '';
		$o .= '<option value="' . (int) $row['id'] . '"' . $s . '>' . htmlspecialchars($row['codigo'] . ' — ' . $row['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}
function dayq_options_medios_edit(mysqli $con, $sel) {
	$r = $con->query('SELECT id, codigo FROM medio_pago WHERE activo=1 ORDER BY codigo');
	$o = '<option value="">—</option>';
	while ($r && ($row = $r->fetch_assoc())) {
		$s = ((int) $row['id'] === (int) $sel) ? ' selected' : '';
		$o .= '<option value="' . (int) $row['id'] . '"' . $s . '>' . htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}
?>
<div class="dayq-mod-scope" id="dayq-mod-compra-edit">
	<div class="dayq-mod-panel dayq-mod-modal__dialog dayq-mod-modal__dialog--wide">
		<div class="dayq-mod-modal__head">
			<h3 class="dayq-mod-modal__title"><?php echo $id ? 'Editar compra' : 'Nueva compra'; ?></h3>
		</div>
		<div class="dayq-mod-modal__body">
			<?php if (!empty($_GET['msg'])): ?><p class="alert alert-success"><?php echo htmlspecialchars((string) $_GET['msg'], ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
			<?php if (!empty($_GET['err'])): ?><p class="alert alert-error"><?php echo htmlspecialchars((string) $_GET['err'], ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
			<form method="post" action="reg_dayq.php">
				<input type="hidden" name="entity" value="compra">
				<input type="hidden" name="compra_id" value="<?php echo (int) $row['id']; ?>">
				<div class="dayq-mod-form-grid">
					<p><label>Número<br><input class="form-control" name="numero" required value="<?php echo htmlspecialchars($row['numero'], ENT_QUOTES, 'UTF-8'); ?>"></label></p>
					<p><label>Fecha<br><input class="form-control" type="datetime-local" name="fecha" value="<?php echo htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8'); ?>"></label></p>
					<p><label>Proveedor<br><select class="form-control" name="proveedor_id" required><option value="">—</option><?php echo dayq_options_proveedores_edit($conectar, $row['proveedor_id']); ?></select></label></p>
					<p><label>Estado<br><select class="form-control" name="estado"><?php foreach (['PENDIENTE', 'PAGADO_PARCIAL', 'PAGADO', 'ANULADO'] as $x) {
	$s = ($row['estado'] === $x) ? ' selected' : '';
	echo '<option value="' . $x . '"' . $s . '>' . $x . '</option>';
} ?></select></label></p>
				</div>
				<h4>Líneas de compra</h4>
				<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Descripción</th><th>Cantidad</th><th>Precio unit.</th></tr></thead><tbody>
				<?php foreach ($lines as $ln): ?>
				<tr>
					<td><input class="form-control" name="line_desc[]" value="<?php echo htmlspecialchars((string) $ln['descripcion'], ENT_QUOTES, 'UTF-8'); ?>"></td>
					<td><input class="form-control" type="number" name="line_cant[]" min="1" value="<?php echo (int) $ln['cantidad']; ?>"></td>
					<td><input class="form-control" type="number" step="0.01" name="line_pre[]" value="<?php echo htmlspecialchars((string) $ln['precio_unitario'], ENT_QUOTES, 'UTF-8'); ?>"></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td><input class="form-control" name="line_desc[]" placeholder="Nueva línea"></td>
					<td><input class="form-control" type="number" name="line_cant[]" min="1" value="1"></td>
					<td><input class="form-control" type="number" step="0.01" name="line_pre[]" value="0"></td>
				</tr>
				</tbody></table>
				<div class="dayq-mod-form-grid">
					<p class="dayq-mod-form-grid__full"><label class="dayq-mod-check"><input type="checkbox" name="crear_obligacion" value="1"> <span>Crear obligación POR_PAGAR por el total (solo si aplica)</span></label></p>
					<p class="dayq-mod-form-grid__full"><label class="dayq-mod-check"><input type="checkbox" name="pagada" value="1"<?php echo (int) $row['pagada'] ? ' checked' : ''; ?>> <span>Pagada (genera SALIDA en cuenta)</span></label></p>
					<p><label>Cuenta de pago<br><select class="form-control" name="cuenta_pago_id"><option value="">—</option><?php echo dayq_options_cuentas_edit($conectar, isset($row['cuenta_pago_id']) ? $row['cuenta_pago_id'] : ''); ?></select></label></p>
					<p><label>Medio de pago (opcional)<br><select class="form-control" name="medio_pago_id"><?php echo dayq_options_medios_edit($conectar, ''); ?></select></label></p>
				</div>
				<div class="dayq-mod-modal__foot">
					<button type="submit" class="btn btn-primary">Guardar compra</button>
					<a href="modulo.php?m=compra" class="btn">Volver al listado</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include __DIR__ . '/layout_footer.php'; ?>
