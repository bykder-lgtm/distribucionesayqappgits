<?php

function dayq_aplicar_movimiento(mysqli $con, $cuenta_id, $tipo, $monto, $medio_pago_id, $descripcion, $referencia, $origen_tipo, $origen_id, $manage_transaction = true, $fecha_movimiento = null) {
	$cuenta_id = (int) $cuenta_id;
	$monto = round((float) $monto, 2);
	if ($cuenta_id < 1 || $monto <= 0 || !in_array($tipo, ['INGRESO', 'SALIDA'], true)) {
		return false;
	}
	$delta = ($tipo === 'INGRESO') ? $monto : -$monto;
	$fecha = $fecha_movimiento ? $fecha_movimiento : date('Y-m-d H:i:s');
	$fecha = dayq_e($con, $fecha);
	$desc = dayq_e($con, (string) $descripcion);
	$ref = dayq_e($con, (string) $referencia);
	$ot = $origen_tipo !== null && $origen_tipo !== '' ? "'" . dayq_e($con, (string) $origen_tipo) . "'" : 'NULL';
	$oid = ($origen_id !== null && (int) $origen_id > 0) ? (int) $origen_id : 'NULL';
	$mp = ($medio_pago_id !== null && (int) $medio_pago_id > 0) ? (int) $medio_pago_id : 'NULL';

	$run = function () use ($con, $delta, $cuenta_id, $fecha, $tipo, $monto, $desc, $ref, $mp, $ot, $oid) {
		$st = $con->prepare('UPDATE cuenta SET saldo_actual = saldo_actual + ? WHERE id = ?');
		$st->bind_param('di', $delta, $cuenta_id);
		$st->execute();
		$st->close();

		$sql = "INSERT INTO movimiento_cuenta (fecha, tipo, monto, descripcion, referencia, cuenta_id, medio_pago_id, origen_tipo, origen_id) VALUES (
			'$fecha', '$tipo', $monto, '$desc', '$ref', $cuenta_id, " . ($mp === 'NULL' ? 'NULL' : $mp) . ", $ot, " . ($oid === 'NULL' ? 'NULL' : $oid) . ')';
		if (!$con->query($sql)) {
			throw new RuntimeException($con->error);
		}
		return (int) $con->insert_id;
	};

	if ($manage_transaction) {
		$con->begin_transaction();
		try {
			$nid = $run();
			$con->commit();
			return $nid;
		} catch (Exception $e) {
			$con->rollback();
			return false;
		}
	}
	try {
		return $run();
	} catch (Exception $e) {
		return false;
	}
}

function dayq_eliminar_movimiento_y_revertir_saldo(mysqli $con, $movimiento_id, $manage_transaction = true) {
	$movimiento_id = (int) $movimiento_id;
	if ($movimiento_id < 1) {
		return false;
	}
	$run = function () use ($con, $movimiento_id) {
		$r = $con->query("SELECT cuenta_id, tipo, monto FROM movimiento_cuenta WHERE id = $movimiento_id FOR UPDATE");
		$row = $r->fetch_assoc();
		if (!$row) {
			return false;
		}
		$cuenta_id = (int) $row['cuenta_id'];
		$tipo = $row['tipo'];
		$monto = (float) $row['monto'];
		$revert = ($tipo === 'INGRESO') ? -$monto : $monto;
		$st = $con->prepare('UPDATE cuenta SET saldo_actual = saldo_actual + ? WHERE id = ?');
		$st->bind_param('di', $revert, $cuenta_id);
		$st->execute();
		$st->close();
		$con->query("DELETE FROM movimiento_cuenta WHERE id = $movimiento_id");
		return true;
	};
	if ($manage_transaction) {
		$con->begin_transaction();
		try {
			$ok = $run();
			if (!$ok) {
				$con->rollback();
				return false;
			}
			$con->commit();
			return true;
		} catch (Exception $e) {
			$con->rollback();
			return false;
		}
	}
	try {
		return $run();
	} catch (Exception $e) {
		return false;
	}
}
