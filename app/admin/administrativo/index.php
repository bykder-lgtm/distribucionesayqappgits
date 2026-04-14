<?php
require_once __DIR__ . '/bootstrap.php';
$dayq_page_title = 'Panel de control';

function dayq_dash_scalar($con, $sql) {
	$r = mysqli_query($con, $sql);
	if (!$r) {
		return 0;
	}
	$row = mysqli_fetch_row($r);
	if (!$row || $row[0] === null) {
		return 0;
	}
	return $row[0];
}

function dayq_dash_rows($con, $sql) {
	$out = array();
	$r = mysqli_query($con, $sql);
	if (!$r) {
		return $out;
	}
	while ($row = mysqli_fetch_assoc($r)) {
		$out[] = $row;
	}
	return $out;
}

function dayq_dash_kpi($accent, $icon_class, $label, $value_html) {
	echo '<article class="dayq-dash-card dayq-dash-card--' . $accent . '">';
	echo '<div class="dayq-dash-card__icon"><i class="fa-solid ' . $icon_class . '" aria-hidden="true"></i></div>';
	echo '<div class="dayq-dash-card__body">';
	echo '<p class="dayq-dash-card__label">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p class="dayq-dash-card__val">' . $value_html . '</p>';
	echo '</div></article>';
}

$kpi_ing_mes = (float) dayq_dash_scalar($conectar,
	"SELECT COALESCE(SUM(monto), 0) FROM movimiento_cuenta
	 WHERE tipo = 'INGRESO' AND YEAR(fecha) = YEAR(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE())"
);
$kpi_egr_mes = (float) dayq_dash_scalar($conectar,
	"SELECT COALESCE(SUM(monto), 0) FROM movimiento_cuenta
	 WHERE tipo = 'SALIDA' AND YEAR(fecha) = YEAR(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE())"
);
$kpi_cobrar = (float) dayq_dash_scalar($conectar,
	"SELECT COALESCE(SUM(monto_pendiente), 0) FROM obligacion_financiera
	 WHERE tipo = 'POR_COBRAR' AND estado IN ('PENDIENTE', 'PAGADO_PARCIAL')"
);

$rows_mov = dayq_dash_rows($conectar,
	"SELECT m.fecha, m.tipo, m.monto, m.descripcion, c.codigo AS cuenta_codigo
	 FROM movimiento_cuenta m
	 INNER JOIN cuenta c ON c.id = m.cuenta_id
	 ORDER BY m.fecha DESC LIMIT 8"
);

$rows_ob = dayq_dash_rows($conectar,
	"SELECT concepto, tipo, monto_pendiente, fecha_vencimiento, estado
	 FROM obligacion_financiera
	 WHERE fecha_vencimiento >= CURDATE()
	 AND fecha_vencimiento <= DATE_ADD(CURDATE(), INTERVAL 14 DAY)
	 AND estado IN ('PENDIENTE', 'PAGADO_PARCIAL')
	 ORDER BY fecha_vencimiento ASC LIMIT 10"
);

$rows_compra = dayq_dash_rows($conectar,
	"SELECT numero, fecha, total, estado FROM compra
	 WHERE estado <> 'ANULADO'
	 ORDER BY fecha DESC LIMIT 5"
);

$mes_corto = array(
	'01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr',
	'05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago',
	'09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic',
);
$labels_chart = array();
$yms = array();
for ($i = 5; $i >= 0; $i--) {
	$t = strtotime('-' . $i . ' months', strtotime(date('Y-m-01')));
	$ym = date('Y-m', $t);
	$yms[] = $ym;
	$m = date('m', $t);
	$labels_chart[] = (isset($mes_corto[$m]) ? $mes_corto[$m] : $m) . ' ' . date('Y', $t);
}

$ing_by_ym = array();
$egr_by_ym = array();
foreach ($yms as $ym) {
	$ing_by_ym[$ym] = 0.0;
	$egr_by_ym[$ym] = 0.0;
}

$sql_trend = "
SELECT DATE_FORMAT(fecha, '%Y-%m') AS ym,
	SUM(CASE WHEN tipo = 'INGRESO' THEN monto ELSE 0 END) AS ing,
	SUM(CASE WHEN tipo = 'SALIDA' THEN monto ELSE 0 END) AS egr
FROM movimiento_cuenta
WHERE fecha >= DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 5 MONTH)
GROUP BY DATE_FORMAT(fecha, '%Y-%m')
ORDER BY DATE_FORMAT(fecha, '%Y-%m')
";
$rt = mysqli_query($conectar, $sql_trend);
if ($rt) {
	while ($row = mysqli_fetch_assoc($rt)) {
		$ym = isset($row['ym']) ? $row['ym'] : '';
		if ($ym !== '' && isset($ing_by_ym[$ym])) {
			$ing_by_ym[$ym] = (float) $row['ing'];
			$egr_by_ym[$ym] = (float) $row['egr'];
		}
	}
}

$data_ing = array();
$data_egr = array();
foreach ($yms as $ym) {
	$data_ing[] = round($ing_by_ym[$ym], 2);
	$data_egr[] = round($egr_by_ym[$ym], 2);
}

$labels_json = json_encode($labels_chart);
$data_ing_json = json_encode($data_ing);
$data_egr_json = json_encode($data_egr);

include __DIR__ . '/layout_header.php';
?>
<div class="dayq-dash">
<h1 class="dayq-dash-page-title">Panel de control</h1>

<h2 class="dayq-dash-section-title">Resumen</h2>
<div class="dayq-dash-kpi-grid dayq-dash-kpi-grid--three">
<?php
dayq_dash_kpi('emerald', 'fa-arrow-trend-up', 'Ingresos del mes', '$ ' . number_format($kpi_ing_mes, 0, ',', '.'));
dayq_dash_kpi('slate', 'fa-arrow-trend-down', 'Egresos del mes', '$ ' . number_format($kpi_egr_mes, 0, ',', '.'));
dayq_dash_kpi('blue', 'fa-hand-holding-dollar', 'Cartera por cobrar pendiente', '$ ' . number_format($kpi_cobrar, 0, ',', '.'));
?>
</div>

<h2 class="dayq-dash-section-title">Actividad reciente</h2>
<div class="dayq-dash-two-cols">
	<div class="dayq-dash-panel">
		<h3 class="dayq-dash-panel__head">Últimos movimientos de cuenta</h3>
		<div class="dayq-adm-table-wrap">
		<table class="dayq-adm-table">
			<thead><tr><th>Fecha</th><th>Cuenta</th><th>Tipo</th><th>Monto</th><th>Descripción</th></tr></thead>
			<tbody>
			<?php if (count($rows_mov) < 1) : ?>
				<tr><td colspan="5">Sin registros</td></tr>
			<?php else : ?>
				<?php foreach ($rows_mov as $rw) : ?>
				<tr>
					<td><?php echo htmlspecialchars(substr((string) (isset($rw['fecha']) ? $rw['fecha'] : ''), 0, 16), ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars(isset($rw['cuenta_codigo']) ? $rw['cuenta_codigo'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars(isset($rw['tipo']) ? $rw['tipo'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo '$ ' . number_format((float) (isset($rw['monto']) ? $rw['monto'] : 0), 0, ',', '.'); ?></td>
					<td><?php echo htmlspecialchars(isset($rw['descripcion']) ? $rw['descripcion'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		</div>
	</div>
	<div class="dayq-dash-panel">
		<h3 class="dayq-dash-panel__head">Obligaciones próximas a vencer (14 días)</h3>
		<div class="dayq-adm-table-wrap">
		<table class="dayq-adm-table">
			<thead><tr><th>Vence</th><th>Tipo</th><th>Pendiente</th><th>Estado</th><th>Concepto</th></tr></thead>
			<tbody>
			<?php if (count($rows_ob) < 1) : ?>
				<tr><td colspan="5">Sin registros</td></tr>
			<?php else : ?>
				<?php foreach ($rows_ob as $rw) : ?>
				<tr>
					<td><?php echo htmlspecialchars(isset($rw['fecha_vencimiento']) ? $rw['fecha_vencimiento'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars(isset($rw['tipo']) ? $rw['tipo'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo '$ ' . number_format((float) (isset($rw['monto_pendiente']) ? $rw['monto_pendiente'] : 0), 0, ',', '.'); ?></td>
					<td><?php echo htmlspecialchars(isset($rw['estado']) ? $rw['estado'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars(isset($rw['concepto']) ? $rw['concepto'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div class="dayq-dash-panel">
	<h3 class="dayq-dash-panel__head">Compras recientes</h3>
	<div class="dayq-adm-table-wrap">
	<table class="dayq-adm-table">
		<thead><tr><th>Número</th><th>Fecha</th><th>Total</th><th>Estado</th></tr></thead>
		<tbody>
		<?php if (count($rows_compra) < 1) : ?>
			<tr><td colspan="4">Sin registros</td></tr>
		<?php else : ?>
			<?php foreach ($rows_compra as $rw) : ?>
			<tr>
				<td><?php echo htmlspecialchars(isset($rw['numero']) ? $rw['numero'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
				<td><?php echo htmlspecialchars(substr((string) (isset($rw['fecha']) ? $rw['fecha'] : ''), 0, 16), ENT_QUOTES, 'UTF-8'); ?></td>
				<td><?php echo '$ ' . number_format((float) (isset($rw['total']) ? $rw['total'] : 0), 0, ',', '.'); ?></td>
				<td><?php echo htmlspecialchars(isset($rw['estado']) ? $rw['estado'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
	</div>
</div>

<div class="dayq-dash-panel">
	<h3 class="dayq-dash-panel__head">Ingresos y egresos por mes</h3>
	<p style="color:#64748b;font-size:0.85rem;margin:0 0 1rem;">Totales según <code>movimiento_cuenta</code> (últimos 6 meses).</p>
	<div class="dayq-dash-chart-wrap">
		<canvas id="dayqChart" height="220"></canvas>
	</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
(function() {
	var labels = <?php echo $labels_json; ?>;
	var ing = <?php echo $data_ing_json; ?>;
	var egr = <?php echo $data_egr_json; ?>;
	new Chart(document.getElementById('dayqChart'), {
		type: 'line',
		data: {
			labels: labels,
			datasets: [
				{ label: 'Ingresos', data: ing, borderColor: '#2563eb', tension: 0.2, fill: false },
				{ label: 'Egresos', data: egr, borderColor: '#64748b', tension: 0.2, fill: false }
			]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: { legend: { position: 'bottom' } },
			scales: {
				y: { beginAtZero: true }
			}
		}
	});
})();
</script>
<?php include __DIR__ . '/layout_footer.php'; ?>
