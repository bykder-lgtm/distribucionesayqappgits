<?php
require_once __DIR__ . '/bootstrap.php';

function dayq_redirect_mod($m, $msg = '', $err = '') {
	$q = 'modulo.php?m=' . rawurlencode($m);
	if ($msg !== '') {
		$q .= '&msg=' . rawurlencode($msg);
	}
	if ($err !== '') {
		$q .= '&err=' . rawurlencode($err);
	}
	header('Location: ' . $q);
	exit;
}

function dayq_redirect_compra($id, $msg = '', $err = '') {
	$q = 'modulo.php?m=compra';
	if ($msg !== '') {
		$q .= '&msg=' . rawurlencode($msg);
	}
	if ($err !== '') {
		$q .= '&err=' . rawurlencode($err);
	}
	header('Location: ' . $q);
	exit;
}

function dayq_tx_begin(mysqli $conectar) {
	if (method_exists($conectar, 'begin_transaction')) {
		$conectar->begin_transaction();
		return;
	}
	$conectar->autocommit(false);
	$conectar->query('START TRANSACTION');
}

function dayq_tx_commit(mysqli $conectar) {
	$conectar->commit();
	$conectar->autocommit(true);
}

function dayq_tx_rollback(mysqli $conectar) {
	$conectar->rollback();
	$conectar->autocommit(true);
}

function dayq_try_delete_or_redirect(mysqli $conectar, $modulo, $tabla, $id, $label) {
	$sql = 'DELETE FROM ' . $tabla . ' WHERE id = ' . (int) $id;
	if (!$conectar->query($sql)) {
		$errno = (int) $conectar->errno;
		if ($errno === 1451 || $errno === 1217) {
			dayq_redirect_mod($modulo, '', 'No es posible eliminar ' . $label . ' porque está siendo usado por otros registros');
		}
		dayq_redirect_mod($modulo, '', 'No se pudo eliminar ' . $label);
	}
	if ((int) $conectar->affected_rows < 1) {
		dayq_redirect_mod($modulo, '', 'No se encontró el registro para eliminar');
	}
	dayq_redirect_mod($modulo, 'Registro eliminado');
}

$entity = dayq_post('entity');
$action = dayq_post('action', 'save');

if ($entity === 'medio_pago') {
	$id = (int) dayq_post('id');
	if ($action === 'delete' && $id > 0) {
		dayq_try_delete_or_redirect($conectar, 'medio_pago', 'medio_pago', $id, 'el medio de pago');
	}
	$codigo = dayq_post('codigo');
	$nombre = dayq_post('nombre');
	$activo = dayq_post('activo') === '1' ? 1 : 0;
	if ($codigo === '' || $nombre === '') {
		dayq_redirect_mod('medio_pago', '', 'Código y nombre obligatorios');
	}
	$c = dayq_e($conectar, $codigo);
	$n = dayq_e($conectar, $nombre);
	if ($id > 0) {
		$conectar->query("UPDATE medio_pago SET codigo='$c', nombre='$n', activo=$activo WHERE id=$id");
	} else {
		$conectar->query("INSERT INTO medio_pago (codigo, nombre, activo) VALUES ('$c','$n',$activo)");
	}
	dayq_redirect_mod('medio_pago', 'Guardado');
}

if ($entity === 'cuenta') {
	$id = (int) dayq_post('id');
	if ($action === 'delete' && $id > 0) {
		dayq_try_delete_or_redirect($conectar, 'cuenta', 'cuenta', $id, 'la cuenta');
	}
	$codigo = dayq_post('codigo');
	$nombre = dayq_post('nombre');
	$saldo = (float) dayq_post('saldo_actual');
	$activo = dayq_post('activo') === '1' ? 1 : 0;
	if ($codigo === '' || $nombre === '') {
		dayq_redirect_mod('cuenta', '', 'Código y nombre obligatorios');
	}
	$c = dayq_e($conectar, $codigo);
	$n = dayq_e($conectar, $nombre);
	if ($id > 0) {
		$conectar->query("UPDATE cuenta SET codigo='$c', nombre='$n', activo=$activo WHERE id=$id");
	} else {
		$conectar->query("INSERT INTO cuenta (codigo, nombre, saldo_actual, activo) VALUES ('$c','$n',$saldo,$activo)");
	}
	dayq_redirect_mod('cuenta', 'Guardado');
}

if ($entity === 'cliente') {
	$id = (int) dayq_post('id');
	if ($action === 'delete' && $id > 0) {
		dayq_try_delete_or_redirect($conectar, 'cliente', 'cliente', $id, 'el cliente');
	}
	$nombre = dayq_post('nombre');
	$doc = dayq_post('documento');
	$activo = dayq_post('activo') === '1' ? 1 : 0;
	if ($nombre === '') {
		dayq_redirect_mod('cliente', '', 'Nombre obligatorio');
	}
	$n = dayq_e($conectar, $nombre);
	$d = dayq_e($conectar, $doc);
	if ($id > 0) {
		$conectar->query("UPDATE cliente SET nombre='$n', documento='$d', activo=$activo WHERE id=$id");
	} else {
		$conectar->query("INSERT INTO cliente (nombre, documento, activo) VALUES ('$n','$d',$activo)");
	}
	dayq_redirect_mod('cliente', 'Guardado');
}

if ($entity === 'proveedor') {
	$id = (int) dayq_post('id');
	if ($action === 'delete' && $id > 0) {
		dayq_try_delete_or_redirect($conectar, 'proveedor', 'proveedor', $id, 'el proveedor');
	}
	$nombre = dayq_post('nombre');
	$nit = dayq_post('nit');
	$activo = dayq_post('activo') === '1' ? 1 : 0;
	if ($nombre === '') {
		dayq_redirect_mod('proveedor', '', 'Nombre obligatorio');
	}
	$n = dayq_e($conectar, $nombre);
	$t = dayq_e($conectar, $nit);
	if ($id > 0) {
		$conectar->query("UPDATE proveedor SET nombre='$n', nit='$t', activo=$activo WHERE id=$id");
	} else {
		$conectar->query("INSERT INTO proveedor (nombre, nit, activo) VALUES ('$n','$t',$activo)");
	}
	dayq_redirect_mod('proveedor', 'Guardado');
}

if ($entity === 'movimiento_cuenta') {
	$id = (int) dayq_post('id');
	if ($action === 'delete' && $id > 0) {
		if (dayq_eliminar_movimiento_y_revertir_saldo($conectar, $id)) {
			$conectar->query('UPDATE gasto SET movimiento_cuenta_id = NULL WHERE movimiento_cuenta_id = ' . $id);
			dayq_redirect_mod('movimiento_cuenta', 'Movimiento eliminado y saldo revertido');
		}
		dayq_redirect_mod('movimiento_cuenta', '', 'No se pudo eliminar');
	}
	$cuenta_id = (int) dayq_post('cuenta_id');
	$tipo = dayq_post('tipo');
	$monto = (float) dayq_post('monto');
	$fecha_raw = dayq_post('fecha') ?: date('Y-m-d\TH:i');
	$fecha = str_replace('T', ' ', $fecha_raw);
	if (strlen($fecha) === 16) {
		$fecha .= ':00';
	}
	$medio = dayq_post('medio_pago_id');
	$medio_id = $medio !== '' ? (int) $medio : null;
	$desc = dayq_post('descripcion');
	$ref = dayq_post('referencia');
	if ($cuenta_id < 1 || !in_array($tipo, ['INGRESO', 'SALIDA'], true) || $monto <= 0) {
		dayq_redirect_mod('movimiento_cuenta', '', 'Datos inválidos');
	}
	$nid = dayq_aplicar_movimiento($conectar, $cuenta_id, $tipo, $monto, $medio_id, $desc, $ref, 'MANUAL', null, true, $fecha);
	if (!$nid) {
		dayq_redirect_mod('movimiento_cuenta', '', 'Error al registrar movimiento');
	}
	dayq_redirect_mod('movimiento_cuenta', 'Movimiento registrado');
}

if ($entity === 'gasto') {
	$id = (int) dayq_post('id');
	if ($action === 'anular' && $id > 0) {
		$r = $conectar->query('SELECT movimiento_cuenta_id, anulado FROM gasto WHERE id = ' . $id);
		$row = $r->fetch_assoc();
		if (!$row || (int) $row['anulado'] === 1) {
			dayq_redirect_mod('gasto', '', 'Gasto no encontrado o ya anulado');
		}
		$mid = (int) $row['movimiento_cuenta_id'];
		$motivo = dayq_post('motivo_anulacion');
		$m = dayq_e($conectar, $motivo);
		dayq_tx_begin($conectar);
		try {
			if ($mid > 0 && !dayq_eliminar_movimiento_y_revertir_saldo($conectar, $mid, false)) {
				throw new RuntimeException('rev');
			}
			$conectar->query("UPDATE gasto SET anulado=1, fecha_anulacion=NOW(), motivo_anulacion='$m', movimiento_cuenta_id=NULL WHERE id=$id");
			dayq_tx_commit($conectar);
		} catch (Exception $e) {
			dayq_tx_rollback($conectar);
			dayq_redirect_mod('gasto', '', 'No se pudo anular');
		}
		dayq_redirect_mod('gasto', 'Gasto anulado y movimiento revertido');
	}
	$cuenta_id = (int) dayq_post('cuenta_id');
	$concepto = dayq_post('concepto');
	$monto = (float) dayq_post('monto');
	$fecha_raw = dayq_post('fecha') ?: date('Y-m-d\TH:i');
	$fecha = str_replace('T', ' ', $fecha_raw);
	if (strlen($fecha) === 16) {
		$fecha .= ':00';
	}
	if ($cuenta_id < 1 || $concepto === '' || $monto <= 0) {
		dayq_redirect_mod('gasto', '', 'Cuenta, concepto y monto obligatorios');
	}
	dayq_tx_begin($conectar);
	try {
		$c = dayq_e($conectar, $concepto);
		$conectar->query("INSERT INTO gasto (fecha, concepto, monto, cuenta_id, anulado) VALUES ('$fecha','$c',$monto,$cuenta_id,0)");
		$gid = (int) $conectar->insert_id;
		$mid = dayq_aplicar_movimiento($conectar, $cuenta_id, 'SALIDA', $monto, null, $c, 'GASTO-' . $gid, 'GASTO', $gid, false, $fecha);
		if (!$mid) {
			throw new RuntimeException('mov');
		}
		$conectar->query("UPDATE gasto SET movimiento_cuenta_id = $mid WHERE id = $gid");
		dayq_tx_commit($conectar);
		dayq_redirect_mod('gasto', 'Gasto registrado con salida en cuenta');
	} catch (Exception $e) {
		dayq_tx_rollback($conectar);
		dayq_redirect_mod('gasto', '', 'Error al guardar gasto');
	}
}

if ($entity === 'obligacion_financiera') {
	$id = (int) dayq_post('id');
	if ($action === 'delete' && $id > 0) {
		dayq_try_delete_or_redirect($conectar, 'obligacion_financiera', 'obligacion_financiera', $id, 'la obligación financiera');
	}
	$tipo = dayq_post('tipo');
	$estado = dayq_post('estado');
	$concepto = dayq_post('concepto');
	$monto = (float) dayq_post('monto');
	$monto_pend = (float) dayq_post('monto_pendiente');
	$fv = dayq_post('fecha_vencimiento');
	$cli = dayq_post('cliente_id');
	$prov = dayq_post('proveedor_id');
	$cuenta_reg = dayq_post('cuenta_registro_id');
	if (!in_array($tipo, ['POR_COBRAR', 'POR_PAGAR'], true) || !in_array($estado, ['PENDIENTE', 'PAGADO_PARCIAL', 'PAGADO', 'ANULADO'], true) || $concepto === '' || $fv === '') {
		dayq_redirect_mod('obligacion_financiera', '', 'Datos incompletos');
	}
	$c = dayq_e($conectar, $concepto);
	$cli_sql = $cli !== '' ? (int) $cli : 'NULL';
	$prov_sql = $prov !== '' ? (int) $prov : 'NULL';
	$cr_sql = $cuenta_reg !== '' ? (int) $cuenta_reg : 'NULL';

	if ($id > 0) {
		dayq_tx_begin($conectar);
		try {
			$old = $conectar->query('SELECT estado, tipo, monto_pendiente, cuenta_registro_id FROM obligacion_financiera WHERE id = ' . $id . ' FOR UPDATE')->fetch_assoc();
			if (!$old) {
				dayq_tx_rollback($conectar);
				dayq_redirect_mod('obligacion_financiera', '', 'No encontrado');
			}
			$estado_old = $old['estado'];
			$conectar->query("UPDATE obligacion_financiera SET tipo='$tipo', concepto='$c', monto=$monto, monto_pendiente=$monto_pend, fecha_vencimiento='$fv', estado='$estado', cliente_id=$cli_sql, proveedor_id=$prov_sql, cuenta_registro_id=$cr_sql WHERE id=$id");

			$pasa_a_pagado = ($estado === 'PAGADO' && $estado_old !== 'PAGADO' && $monto_pend > 0);
			if ($pasa_a_pagado && $cr_sql !== 'NULL') {
				$cuenta_reg_id = (int) $cuenta_reg;
				$mov_tipo = ($old['tipo'] === 'POR_COBRAR') ? 'INGRESO' : 'SALIDA';
				$mp = dayq_aplicar_movimiento($conectar, $cuenta_reg_id, $mov_tipo, $monto_pend, null, 'Obligación #' . $id, 'OB-' . $id, 'OBLIGACION', $id, false, null);
				if (!$mp) {
					throw new RuntimeException('mov');
				}
				$conectar->query("UPDATE obligacion_financiera SET monto_pendiente=0 WHERE id=$id");
			}
			dayq_tx_commit($conectar);
		} catch (Exception $e) {
			dayq_tx_rollback($conectar);
			dayq_redirect_mod('obligacion_financiera', '', 'No se pudo guardar obligación o su movimiento');
		}
	} else {
		$conectar->query("INSERT INTO obligacion_financiera (tipo, concepto, monto, monto_pendiente, fecha_vencimiento, estado, cliente_id, proveedor_id, cuenta_registro_id) VALUES ('$tipo','$c',$monto,$monto_pend,'$fv','$estado',$cli_sql,$prov_sql,$cr_sql)");
	}
	dayq_redirect_mod('obligacion_financiera', 'Guardado');
}

if ($entity === 'compra') {
	$cid = (int) dayq_post('compra_id');
	$numero = dayq_post('numero');
	$fecha_raw = dayq_post('fecha') ?: date('Y-m-d\TH:i');
	$fecha = str_replace('T', ' ', $fecha_raw);
	if (strlen($fecha) === 16) {
		$fecha .= ':00';
	}
	$proveedor_id = (int) dayq_post('proveedor_id');
	$estado = dayq_post('estado');
	$pagada = dayq_post('pagada') === '1';
	$cuenta_pago = dayq_post('cuenta_pago_id');
	$medio_pago = dayq_post('medio_pago_id');
	$crear_ob = dayq_post('crear_obligacion') === '1';
	$descs = isset($_POST['line_desc']) ? $_POST['line_desc'] : array();
	$cants = isset($_POST['line_cant']) ? $_POST['line_cant'] : array();
	$pres = isset($_POST['line_pre']) ? $_POST['line_pre'] : array();

	if ($numero === '' || $proveedor_id < 1 || !in_array($estado, ['PENDIENTE', 'PAGADO_PARCIAL', 'PAGADO', 'ANULADO'], true)) {
		dayq_redirect_mod('compra', '', 'Número, proveedor y estado obligatorios');
	}

	$lines = [];
	$total = 0.0;
	for ($i = 0; $i < count($descs); $i++) {
		$d = trim((string) (isset($descs[$i]) ? $descs[$i] : ''));
		$cant = (int) (isset($cants[$i]) ? $cants[$i] : 0);
		$pu = (float) (isset($pres[$i]) ? $pres[$i] : 0);
		if ($d === '' && $cant === 0 && $pu == 0) {
			continue;
		}
		if ($d === '' || $cant < 1 || $pu < 0) {
			dayq_redirect_mod('compra', '', 'Líneas inválidas');
		}
		$sub = round($cant * $pu, 2);
		$total += $sub;
		$lines[] = ['d' => $d, 'cant' => $cant, 'pu' => $pu, 'sub' => $sub];
	}
	if (count($lines) < 1) {
		dayq_redirect_mod('compra', '', 'Agregue al menos una línea');
	}

	$n = dayq_e($conectar, $numero);
	$oldc = ['movimiento_cuenta_pago_id' => 0, 'obligacion_financiera_id' => null];
	dayq_tx_begin($conectar);
	try {
		if ($cid > 0) {
			$r0 = $conectar->query('SELECT movimiento_cuenta_pago_id, obligacion_financiera_id FROM compra WHERE id = ' . $cid . ' FOR UPDATE');
			if ($r0 && ($t0 = $r0->fetch_assoc())) {
				$oldc = $t0;
			}
			$conectar->query('DELETE FROM linea_compra WHERE compra_id = ' . $cid);
			$conectar->query("UPDATE compra SET numero='$n', fecha='$fecha', proveedor_id=$proveedor_id, estado='$estado', total=$total WHERE id=$cid");
		} else {
			$conectar->query("INSERT INTO compra (numero, fecha, total, estado, proveedor_id, pagada) VALUES ('$n','$fecha',$total,'$estado',$proveedor_id,0)");
			$cid = (int) $conectar->insert_id;
		}
		foreach ($lines as $ln) {
			$d = dayq_e($conectar, $ln['d']);
			$conectar->query("INSERT INTO linea_compra (descripcion, cantidad, precio_unitario, subtotal, compra_id) VALUES ('$d',{$ln['cant']},{$ln['pu']},{$ln['sub']},$cid)");
		}
		if ($crear_ob && empty($oldc['obligacion_financiera_id'])) {
			$oc = dayq_e($conectar, 'Compra ' . $numero);
			$conectar->query("INSERT INTO obligacion_financiera (tipo, concepto, monto, monto_pendiente, fecha_vencimiento, estado, cliente_id, proveedor_id, cuenta_registro_id) VALUES ('POR_PAGAR','$oc',$total,$total,CURDATE(),'PENDIENTE',NULL,$proveedor_id,NULL)");
			$oid = (int) $conectar->insert_id;
			$conectar->query("UPDATE compra SET obligacion_financiera_id=$oid WHERE id=$cid");
		}
		if ($pagada && (int) (isset($oldc['movimiento_cuenta_pago_id']) ? $oldc['movimiento_cuenta_pago_id'] : 0) < 1) {
			$cp = (int) $cuenta_pago;
			if ($cp < 1) {
				throw new RuntimeException('cuenta');
			}
			$med = $medio_pago !== '' ? (int) $medio_pago : null;
			$mid = dayq_aplicar_movimiento($conectar, $cp, 'SALIDA', $total, $med, 'Pago compra ' . $numero, 'COMPRA-' . $cid, 'COMPRA', $cid, false, $fecha);
			if (!$mid) {
				throw new RuntimeException('mov');
			}
			$conectar->query("UPDATE compra SET pagada=1, cuenta_pago_id=$cp, movimiento_cuenta_pago_id=$mid WHERE id=$cid");
		}
		dayq_tx_commit($conectar);
	} catch (Exception $e) {
		dayq_tx_rollback($conectar);
		dayq_redirect_mod('compra', '', 'Error al guardar compra');
	}
	dayq_redirect_compra($cid, 'Compra guardada');
}

dayq_redirect_mod('cuenta', '', 'Acción no reconocida');
