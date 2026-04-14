<?php
require_once __DIR__ . '/bootstrap.php';
$m = isset($_GET['m']) ? preg_replace('/[^a-z_]/', '', $_GET['m']) : 'medio_pago';
$titles = [
	'medio_pago' => 'Medio de pago',
	'cuenta' => 'Cuenta',
	'movimiento_cuenta' => 'Movimiento de cuenta',
	'gasto' => 'Gasto',
	'proveedor' => 'Proveedor',
	'cliente' => 'Cliente',
	'compra' => 'Compra',
	'obligacion_financiera' => 'Obligación financiera',
];
$dayq_page_title = isset($titles[$m]) ? $titles[$m] : 'Módulo';
include __DIR__ . '/layout_header.php';

function dayq_options_cuentas(mysqli $con) {
	$r = $con->query('SELECT id, codigo, nombre FROM cuenta WHERE activo=1 ORDER BY codigo');
	$o = '';
	while ($r && ($row = $r->fetch_assoc())) {
		$o .= '<option value="' . (int) $row['id'] . '">' . htmlspecialchars($row['codigo'] . ' — ' . $row['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}
function dayq_options_medios(mysqli $con) {
	$r = $con->query('SELECT id, codigo, nombre FROM medio_pago WHERE activo=1 ORDER BY codigo');
	$o = '';
	while ($r && ($row = $r->fetch_assoc())) {
		$o .= '<option value="' . (int) $row['id'] . '">' . htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}
function dayq_options_proveedores(mysqli $con) {
	$r = $con->query('SELECT id, nombre FROM proveedor WHERE activo=1 ORDER BY nombre');
	$o = '';
	while ($r && ($row = $r->fetch_assoc())) {
		$o .= '<option value="' . (int) $row['id'] . '">' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}
function dayq_options_clientes(mysqli $con) {
	$r = $con->query('SELECT id, nombre FROM cliente WHERE activo=1 ORDER BY nombre');
	$o = '';
	while ($r && ($row = $r->fetch_assoc())) {
		$o .= '<option value="' . (int) $row['id'] . '">' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}

/** Query string para modulo.php: conserva módulo, filtros y paginación. */
function dayq_mod_href($mod, array $over) {
	$qs = ['m' => $mod];
	if (isset($over['edit']) && (int) $over['edit'] > 0) {
		$qs['edit'] = (int) $over['edit'];
	}
	if (isset($over['q']) && $over['q'] !== '') {
		$qs['q'] = $over['q'];
	}
	if (isset($over['activo']) && $over['activo'] !== 'all') {
		$qs['activo'] = $over['activo'];
	}
	if (isset($over['page']) && (int) $over['page'] > 1) {
		$qs['page'] = (int) $over['page'];
	}
	if (isset($over['tipo']) && $over['tipo'] !== '' && $over['tipo'] !== 'all') {
		$qs['tipo'] = $over['tipo'];
	}
	if (isset($over['estado']) && $over['estado'] !== '' && $over['estado'] !== 'all') {
		$qs['estado'] = $over['estado'];
	}
	if (isset($over['fecha_desde']) && $over['fecha_desde'] !== '') {
		$qs['fecha_desde'] = $over['fecha_desde'];
	}
	if (isset($over['fecha_hasta']) && $over['fecha_hasta'] !== '') {
		$qs['fecha_hasta'] = $over['fecha_hasta'];
	}
	if (isset($over['cuenta_id']) && (int) $over['cuenta_id'] > 0) {
		$qs['cuenta_id'] = (int) $over['cuenta_id'];
	}
	if (isset($over['mov_tipo']) && $over['mov_tipo'] !== '' && $over['mov_tipo'] !== 'all') {
		$qs['mov_tipo'] = $over['mov_tipo'];
	}
	if (isset($over['anulado']) && $over['anulado'] !== '' && $over['anulado'] !== 'all') {
		$qs['anulado'] = $over['anulado'];
	}
	return 'modulo.php?' . http_build_query($qs, '', '&', PHP_QUERY_RFC3986);
}

/** Opciones select cuenta para filtro (incluye "Todas"). */
function dayq_options_cuentas_filter(mysqli $con, $selected_id) {
	$o = '<option value="0"' . ((int) $selected_id === 0 ? ' selected' : '') . '>Todas</option>';
	$r = $con->query('SELECT id, codigo, nombre FROM cuenta WHERE activo=1 ORDER BY codigo');
	while ($r && ($row = $r->fetch_assoc())) {
		$s = ((int) $row['id'] === (int) $selected_id) ? ' selected' : '';
		$o .= '<option value="' . (int) $row['id'] . '"' . $s . '>' . htmlspecialchars($row['codigo'] . ' — ' . $row['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	return $o;
}

if ($m === 'medio_pago') {
	$mp_per_page = 15;
	$mp_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$mp_act = isset($_GET['activo']) ? (string) $_GET['activo'] : 'all';
	if ($mp_act !== '0' && $mp_act !== '1') {
		$mp_act = 'all';
	}
	$mp_page = dayq_get_int('page', 1);
	if ($mp_page < 1) {
		$mp_page = 1;
	}

	$mp_where = [];
	if ($mp_q !== '') {
		$eq = dayq_e($conectar, $mp_q);
		$mp_where[] = "(codigo LIKE '%" . $eq . "%' OR nombre LIKE '%" . $eq . "%')";
	}
	if ($mp_act === '0') {
		$mp_where[] = 'activo=0';
	} elseif ($mp_act === '1') {
		$mp_where[] = 'activo=1';
	}
	$mp_where_sql = count($mp_where) ? 'WHERE ' . implode(' AND ', $mp_where) : '';

	$cr = $conectar->query('SELECT COUNT(*) AS c FROM medio_pago ' . $mp_where_sql);
	$mp_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$mp_total = (int) $crow['c'];
	}
	$mp_total_pages = $mp_total > 0 ? (int) ceil($mp_total / $mp_per_page) : 1;
	if ($mp_page > $mp_total_pages) {
		$mp_page = $mp_total_pages;
	}
	$mp_offset = ($mp_page - 1) * $mp_per_page;

	$res = $conectar->query('SELECT * FROM medio_pago ' . $mp_where_sql . ' ORDER BY codigo ASC LIMIT ' . (int) $mp_offset . ',' . (int) $mp_per_page);

	$mp_state = ['q' => $mp_q, 'activo' => $mp_act, 'page' => $mp_page];

	$ed = dayq_get_int('edit');
	$row = ['id' => 0, 'codigo' => '', 'nombre' => '', 'activo' => 1];
	$mp_modal_open = false;
	if ($ed > 0) {
		$qed = $conectar->query('SELECT * FROM medio_pago WHERE id=' . (int) $ed);
		if ($qed && ($t = $qed->fetch_assoc())) {
			$row = $t;
			$mp_modal_open = true;
		}
	}

	$mp_range_from = $mp_total === 0 ? 0 : $mp_offset + 1;
	$mp_range_to = $mp_total === 0 ? 0 : min($mp_offset + $mp_per_page, $mp_total);

	echo '<div class="dayq-mod-scope" id="dayq-mod-medio-pago">';
	echo '<div class="dayq-adm-table-wrap"><h2>Medios de pago</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="medio_pago">';
	echo '<label class="dayq-mod-filters__q">Buscar<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($mp_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Código o nombre" autocomplete="off"></label>';
	echo '<label>Activo<br><select class="form-control" name="activo">';
	echo '<option value="all"' . ($mp_act === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="1"' . ($mp_act === '1' ? ' selected' : '') . '>Sí</option>';
	echo '<option value="0"' . ($mp_act === '0' ? ' selected' : '') . '>No</option>';
	echo '</select></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Buscar</button>';
	echo '<a class="btn" href="modulo.php?m=medio_pago">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-mp-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Código</th><th>Nombre</th><th>Activo</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="4">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($trow = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($trow['codigo'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($trow['nombre'], ENT_QUOTES, 'UTF-8') . '</td><td>' . ((int) $trow['activo'] ? 'Sí' : 'No') . '</td>';
			$href_edit = dayq_mod_href('medio_pago', array_merge($mp_state, ['edit' => (int) $trow['id']]));
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<a class="dayq-mod-actions__link" href="' . htmlspecialchars($href_edit, ENT_QUOTES, 'UTF-8') . '" aria-label="Editar"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Editar</span></a>';
			echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
			echo '<input type="hidden" name="entity" value="medio_pago"><input type="hidden" name="id" value="' . (int) $trow['id'] . '"><input type="hidden" name="action" value="delete">';
			echo '<button type="submit" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-confirm-submit" data-dayq-confirm-title="Eliminar medio de pago" data-dayq-confirm="¿Eliminar este medio de pago? Esta acción no se puede deshacer." data-dayq-confirm-ok="Sí, eliminar" aria-label="Eliminar"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar</span></button>';
			echo '</form></div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="4">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $mp_range_from . '–' . (int) $mp_range_to . ' de ' . (int) $mp_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($mp_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href('medio_pago', array_merge($mp_state, ['page' => $mp_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $mp_page - 2);
	$p_to = min($mp_total_pages, $mp_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $mp_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href('medio_pago', array_merge($mp_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($mp_page >= $mp_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href('medio_pago', array_merge($mp_state, ['page' => $mp_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav>';

	echo '</div>';

	$modal_class = 'dayq-mod-modal';
	if ($mp_modal_open) {
		$modal_class .= ' is-open';
	}
	echo '<div class="' . htmlspecialchars($modal_class, ENT_QUOTES, 'UTF-8') . '" id="dayq-mp-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-mp-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="dayq-mp-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-mp-modal-title">' . ($row['id'] ? 'Editar medio de pago' : 'Nuevo medio de pago') . '</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-mp-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-mp-form">';
	echo '<input type="hidden" name="entity" value="medio_pago"><input type="hidden" name="id" id="dayq-mp-field-id" value="' . (int) $row['id'] . '">';
	echo '<p><label>Código<br><input class="form-control" id="dayq-mp-field-codigo" name="codigo" required value="' . htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Nombre<br><input class="form-control" id="dayq-mp-field-nombre" name="nombre" required value="' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label class="dayq-mod-check"><input type="checkbox" name="activo" id="dayq-mp-field-activo" value="1"' . ((int) $row['activo'] ? ' checked' : '') . '> <span>Activo</span></label></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar</button></div></form></div></div></div></div>';

	echo '<script>(function(){var scope=document.getElementById("dayq-mod-medio-pago");if(!scope)return;var modal=document.getElementById("dayq-mp-modal");var overlay=document.getElementById("dayq-mp-modal-overlay");var titleEl=document.getElementById("dayq-mp-modal-title");var idEl=document.getElementById("dayq-mp-field-id");var codEl=document.getElementById("dayq-mp-field-codigo");var nomEl=document.getElementById("dayq-mp-field-nombre");var actEl=document.getElementById("dayq-mp-field-activo");function syncEditInUrl(id){if(!window.history||typeof window.history.replaceState!=="function"||typeof URL==="undefined")return;var url=new URL(window.location.href);if(id&&parseInt(id,10)>0){url.searchParams.set("edit",String(parseInt(id,10)));}else{url.searchParams.delete("edit");}window.history.replaceState(null,"",url.toString());}function openModal(id){modal.classList.add("is-open");syncEditInUrl(id||0);}function closeModal(){modal.classList.remove("is-open");syncEditInUrl(0);}var btnNew=scope.querySelector(".dayq-mp-btn-new");if(btnNew)btnNew.addEventListener("click",function(){if(titleEl)titleEl.textContent="Nuevo medio de pago";if(idEl)idEl.value="0";if(codEl)codEl.value="";if(nomEl)nomEl.value="";if(actEl)actEl.checked=true;openModal(0);if(codEl)codEl.focus();});scope.querySelectorAll(".dayq-mp-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});if(modal.classList.contains("is-open")){syncEditInUrl(idEl&&idEl.value?idEl.value:0);}})();</script>';
	echo '</div>';
}

if ($m === 'cuenta') {
	$cu_per_page = 15;
	$cu_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$cu_act = isset($_GET['activo']) ? (string) $_GET['activo'] : 'all';
	if ($cu_act !== '0' && $cu_act !== '1') {
		$cu_act = 'all';
	}
	$cu_page = dayq_get_int('page', 1);
	if ($cu_page < 1) {
		$cu_page = 1;
	}
	$cu_where = [];
	if ($cu_q !== '') {
		$eq = dayq_e($conectar, $cu_q);
		$cu_where[] = "(codigo LIKE '%" . $eq . "%' OR nombre LIKE '%" . $eq . "%')";
	}
	if ($cu_act === '0') {
		$cu_where[] = 'activo=0';
	} elseif ($cu_act === '1') {
		$cu_where[] = 'activo=1';
	}
	$cu_where_sql = count($cu_where) ? 'WHERE ' . implode(' AND ', $cu_where) : '';
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM cuenta ' . $cu_where_sql);
	$cu_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$cu_total = (int) $crow['c'];
	}
	$cu_total_pages = $cu_total > 0 ? (int) ceil($cu_total / $cu_per_page) : 1;
	if ($cu_page > $cu_total_pages) {
		$cu_page = $cu_total_pages;
	}
	$cu_offset = ($cu_page - 1) * $cu_per_page;
	$res = $conectar->query('SELECT * FROM cuenta ' . $cu_where_sql . ' ORDER BY codigo ASC LIMIT ' . (int) $cu_offset . ',' . (int) $cu_per_page);
	$cu_state = ['q' => $cu_q, 'activo' => $cu_act, 'page' => $cu_page];
	$ed = dayq_get_int('edit');
	$row = ['id' => 0, 'codigo' => '', 'nombre' => '', 'saldo_actual' => '0', 'activo' => 1];
	$cu_modal_open = false;
	if ($ed > 0) {
		$q = $conectar->query('SELECT * FROM cuenta WHERE id=' . (int) $ed);
		if ($q && ($t = $q->fetch_assoc())) {
			$row = $t;
			$cu_modal_open = true;
		}
	}
	$cu_range_from = $cu_total === 0 ? 0 : $cu_offset + 1;
	$cu_range_to = $cu_total === 0 ? 0 : min($cu_offset + $cu_per_page, $cu_total);

	echo '<div class="dayq-mod-scope" id="dayq-mod-cuenta">';
	echo '<div class="dayq-adm-table-wrap"><h2>Cuentas</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="cuenta">';
	echo '<label class="dayq-mod-filters__q">Buscar<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($cu_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Código o nombre" autocomplete="off"></label>';
	echo '<label>Activo<br><select class="form-control" name="activo">';
	echo '<option value="all"' . ($cu_act === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="1"' . ($cu_act === '1' ? ' selected' : '') . '>Sí</option>';
	echo '<option value="0"' . ($cu_act === '0' ? ' selected' : '') . '>No</option>';
	echo '</select></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Buscar</button>';
	echo '<a class="btn" href="modulo.php?m=cuenta">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-cuenta-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Código</th><th>Nombre</th><th>Saldo</th><th>Activo</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="5">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($trow = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($trow['codigo'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($trow['nombre'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($trow['saldo_actual'], ENT_QUOTES, 'UTF-8') . '</td><td>' . ((int) $trow['activo'] ? 'Sí' : 'No') . '</td>';
			$href_edit = dayq_mod_href('cuenta', array_merge($cu_state, ['edit' => (int) $trow['id']]));
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<a class="dayq-mod-actions__link" href="' . htmlspecialchars($href_edit, ENT_QUOTES, 'UTF-8') . '" aria-label="Editar"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Editar</span></a>';
			echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
			echo '<input type="hidden" name="entity" value="cuenta"><input type="hidden" name="id" value="' . (int) $trow['id'] . '"><input type="hidden" name="action" value="delete">';
			echo '<button type="submit" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-confirm-submit" data-dayq-confirm-title="Eliminar cuenta" data-dayq-confirm="¿Eliminar esta cuenta? Esta acción no se puede deshacer." data-dayq-confirm-ok="Sí, eliminar" aria-label="Eliminar"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar</span></button>';
			echo '</form></div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="5">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $cu_range_from . '–' . (int) $cu_range_to . ' de ' . (int) $cu_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($cu_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href('cuenta', array_merge($cu_state, ['page' => $cu_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $cu_page - 2);
	$p_to = min($cu_total_pages, $cu_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $cu_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href('cuenta', array_merge($cu_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($cu_page >= $cu_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href('cuenta', array_merge($cu_state, ['page' => $cu_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	$modal_class = 'dayq-mod-modal';
	if ($cu_modal_open) {
		$modal_class .= ' is-open';
	}
	echo '<div class="' . htmlspecialchars($modal_class, ENT_QUOTES, 'UTF-8') . '" id="dayq-cuenta-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-cuenta-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="dayq-cuenta-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-cuenta-modal-title">' . ($row['id'] ? 'Editar cuenta' : 'Nueva cuenta') . '</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-cuenta-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-cuenta-form">';
	echo '<input type="hidden" name="entity" value="cuenta"><input type="hidden" name="id" id="dayq-cuenta-field-id" value="' . (int) $row['id'] . '">';
	echo '<p><label>Código<br><input class="form-control" id="dayq-cuenta-field-codigo" name="codigo" required value="' . htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Nombre<br><input class="form-control" id="dayq-cuenta-field-nombre" name="nombre" required value="' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	$cu_saldo_display = $row['id'] ? 'none' : 'block';
	$cu_saldo_dis = $row['id'] ? ' disabled' : '';
	echo '<p id="dayq-cuenta-saldo-wrap" style="display:' . $cu_saldo_display . '"><label>Saldo inicial<br><input class="form-control" type="number" step="0.01" id="dayq-cuenta-field-saldo" name="saldo_actual" value="' . htmlspecialchars((string) $row['saldo_actual'], ENT_QUOTES, 'UTF-8') . '"' . $cu_saldo_dis . '></label></p>';
	echo '<p><label class="dayq-mod-check"><input type="checkbox" name="activo" id="dayq-cuenta-field-activo" value="1"' . ((int) $row['activo'] ? ' checked' : '') . '> <span>Activo</span></label></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar</button></div></form></div></div></div></div>';

	echo '<script>(function(){var scope=document.getElementById("dayq-mod-cuenta");if(!scope)return;var modal=document.getElementById("dayq-cuenta-modal");var overlay=document.getElementById("dayq-cuenta-modal-overlay");var titleEl=document.getElementById("dayq-cuenta-modal-title");var idEl=document.getElementById("dayq-cuenta-field-id");var codEl=document.getElementById("dayq-cuenta-field-codigo");var nomEl=document.getElementById("dayq-cuenta-field-nombre");var salWrap=document.getElementById("dayq-cuenta-saldo-wrap");var salEl=document.getElementById("dayq-cuenta-field-saldo");var actEl=document.getElementById("dayq-cuenta-field-activo");function syncEditInUrl(id){if(!window.history||typeof window.history.replaceState!=="function"||typeof URL==="undefined")return;var url=new URL(window.location.href);if(id&&parseInt(id,10)>0){url.searchParams.set("edit",String(parseInt(id,10)));}else{url.searchParams.delete("edit");}window.history.replaceState(null,"",url.toString());}function openModal(id){modal.classList.add("is-open");syncEditInUrl(id||0);}function closeModal(){modal.classList.remove("is-open");syncEditInUrl(0);}var btnNew=scope.querySelector(".dayq-cuenta-btn-new");if(btnNew)btnNew.addEventListener("click",function(){if(titleEl)titleEl.textContent="Nueva cuenta";if(idEl)idEl.value="0";if(codEl)codEl.value="";if(nomEl)nomEl.value="";if(salEl){salEl.value="0";salEl.disabled=false;}if(salWrap)salWrap.style.display="";if(actEl)actEl.checked=true;openModal(0);if(codEl)codEl.focus();});scope.querySelectorAll(".dayq-cuenta-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});if(modal.classList.contains("is-open")){syncEditInUrl(idEl&&idEl.value?idEl.value:0);}})();</script>';
	echo '</div>';
}

if ($m === 'cliente') {
	$cl_per_page = 15;
	$cl_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$cl_act = isset($_GET['activo']) ? (string) $_GET['activo'] : 'all';
	if ($cl_act !== '0' && $cl_act !== '1') {
		$cl_act = 'all';
	}
	$cl_page = dayq_get_int('page', 1);
	if ($cl_page < 1) {
		$cl_page = 1;
	}
	$cl_where = [];
	if ($cl_q !== '') {
		$eq = dayq_e($conectar, $cl_q);
		$cl_where[] = "(nombre LIKE '%" . $eq . "%' OR documento LIKE '%" . $eq . "%')";
	}
	if ($cl_act === '0') {
		$cl_where[] = 'activo=0';
	} elseif ($cl_act === '1') {
		$cl_where[] = 'activo=1';
	}
	$cl_where_sql = count($cl_where) ? 'WHERE ' . implode(' AND ', $cl_where) : '';
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM cliente ' . $cl_where_sql);
	$cl_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$cl_total = (int) $crow['c'];
	}
	$cl_total_pages = $cl_total > 0 ? (int) ceil($cl_total / $cl_per_page) : 1;
	if ($cl_page > $cl_total_pages) {
		$cl_page = $cl_total_pages;
	}
	$cl_offset = ($cl_page - 1) * $cl_per_page;
	$res = $conectar->query('SELECT * FROM cliente ' . $cl_where_sql . ' ORDER BY nombre ASC LIMIT ' . (int) $cl_offset . ',' . (int) $cl_per_page);
	$cl_state = ['q' => $cl_q, 'activo' => $cl_act, 'page' => $cl_page];
	$ed = dayq_get_int('edit');
	$row = ['id' => 0, 'nombre' => '', 'documento' => '', 'activo' => 1];
	$cl_modal_open = false;
	if ($ed > 0) {
		$q = $conectar->query('SELECT * FROM cliente WHERE id=' . (int) $ed);
		if ($q && ($t = $q->fetch_assoc())) {
			$row = $t;
			$cl_modal_open = true;
		}
	}
	$cl_range_from = $cl_total === 0 ? 0 : $cl_offset + 1;
	$cl_range_to = $cl_total === 0 ? 0 : min($cl_offset + $cl_per_page, $cl_total);

	echo '<div class="dayq-mod-scope" id="dayq-mod-cliente">';
	echo '<div class="dayq-adm-table-wrap"><h2>Clientes</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="cliente">';
	echo '<label class="dayq-mod-filters__q">Buscar<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($cl_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Nombre o documento" autocomplete="off"></label>';
	echo '<label>Activo<br><select class="form-control" name="activo">';
	echo '<option value="all"' . ($cl_act === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="1"' . ($cl_act === '1' ? ' selected' : '') . '>Sí</option>';
	echo '<option value="0"' . ($cl_act === '0' ? ' selected' : '') . '>No</option>';
	echo '</select></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Buscar</button>';
	echo '<a class="btn" href="modulo.php?m=cliente">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-cliente-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Nombre</th><th>Documento</th><th>Activo</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="4">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($trow = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($trow['nombre'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars((string) $trow['documento'], ENT_QUOTES, 'UTF-8') . '</td><td>' . ((int) $trow['activo'] ? 'Sí' : 'No') . '</td>';
			$href_edit = dayq_mod_href('cliente', array_merge($cl_state, ['edit' => (int) $trow['id']]));
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<a class="dayq-mod-actions__link" href="' . htmlspecialchars($href_edit, ENT_QUOTES, 'UTF-8') . '" aria-label="Editar"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Editar</span></a>';
			echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
			echo '<input type="hidden" name="entity" value="cliente"><input type="hidden" name="id" value="' . (int) $trow['id'] . '"><input type="hidden" name="action" value="delete">';
			echo '<button type="submit" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-confirm-submit" data-dayq-confirm-title="Eliminar cliente" data-dayq-confirm="¿Eliminar este cliente? Esta acción no se puede deshacer." data-dayq-confirm-ok="Sí, eliminar" aria-label="Eliminar"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar</span></button>';
			echo '</form></div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="4">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $cl_range_from . '–' . (int) $cl_range_to . ' de ' . (int) $cl_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($cl_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href('cliente', array_merge($cl_state, ['page' => $cl_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $cl_page - 2);
	$p_to = min($cl_total_pages, $cl_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $cl_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href('cliente', array_merge($cl_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($cl_page >= $cl_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href('cliente', array_merge($cl_state, ['page' => $cl_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	$modal_class = 'dayq-mod-modal';
	if ($cl_modal_open) {
		$modal_class .= ' is-open';
	}
	echo '<div class="' . htmlspecialchars($modal_class, ENT_QUOTES, 'UTF-8') . '" id="dayq-cliente-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-cliente-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="dayq-cliente-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-cliente-modal-title">' . ($row['id'] ? 'Editar cliente' : 'Nuevo cliente') . '</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-cliente-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-cliente-form">';
	echo '<input type="hidden" name="entity" value="cliente"><input type="hidden" name="id" id="dayq-cliente-field-id" value="' . (int) $row['id'] . '">';
	echo '<p><label>Nombre<br><input class="form-control" id="dayq-cliente-field-nombre" name="nombre" required value="' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Documento<br><input class="form-control" id="dayq-cliente-field-documento" name="documento" value="' . htmlspecialchars((string) $row['documento'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label class="dayq-mod-check"><input type="checkbox" name="activo" id="dayq-cliente-field-activo" value="1"' . ((int) $row['activo'] ? ' checked' : '') . '> <span>Activo</span></label></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar</button></div></form></div></div></div></div>';

	echo '<script>(function(){var scope=document.getElementById("dayq-mod-cliente");if(!scope)return;var modal=document.getElementById("dayq-cliente-modal");var overlay=document.getElementById("dayq-cliente-modal-overlay");var titleEl=document.getElementById("dayq-cliente-modal-title");var idEl=document.getElementById("dayq-cliente-field-id");var nomEl=document.getElementById("dayq-cliente-field-nombre");var docEl=document.getElementById("dayq-cliente-field-documento");var actEl=document.getElementById("dayq-cliente-field-activo");function syncEditInUrl(id){if(!window.history||typeof window.history.replaceState!=="function"||typeof URL==="undefined")return;var url=new URL(window.location.href);if(id&&parseInt(id,10)>0){url.searchParams.set("edit",String(parseInt(id,10)));}else{url.searchParams.delete("edit");}window.history.replaceState(null,"",url.toString());}function openModal(id){modal.classList.add("is-open");syncEditInUrl(id||0);}function closeModal(){modal.classList.remove("is-open");syncEditInUrl(0);}var btnNew=scope.querySelector(".dayq-cliente-btn-new");if(btnNew)btnNew.addEventListener("click",function(){if(titleEl)titleEl.textContent="Nuevo cliente";if(idEl)idEl.value="0";if(nomEl)nomEl.value="";if(docEl)docEl.value="";if(actEl)actEl.checked=true;openModal(0);if(nomEl)nomEl.focus();});scope.querySelectorAll(".dayq-cliente-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});if(modal.classList.contains("is-open")){syncEditInUrl(idEl&&idEl.value?idEl.value:0);}})();</script>';
	echo '</div>';
}

if ($m === 'proveedor') {
	$pr_per_page = 15;
	$pr_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$pr_act = isset($_GET['activo']) ? (string) $_GET['activo'] : 'all';
	if ($pr_act !== '0' && $pr_act !== '1') {
		$pr_act = 'all';
	}
	$pr_page = dayq_get_int('page', 1);
	if ($pr_page < 1) {
		$pr_page = 1;
	}
	$pr_where = [];
	if ($pr_q !== '') {
		$eq = dayq_e($conectar, $pr_q);
		$pr_where[] = "(nombre LIKE '%" . $eq . "%' OR nit LIKE '%" . $eq . "%')";
	}
	if ($pr_act === '0') {
		$pr_where[] = 'activo=0';
	} elseif ($pr_act === '1') {
		$pr_where[] = 'activo=1';
	}
	$pr_where_sql = count($pr_where) ? 'WHERE ' . implode(' AND ', $pr_where) : '';
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM proveedor ' . $pr_where_sql);
	$pr_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$pr_total = (int) $crow['c'];
	}
	$pr_total_pages = $pr_total > 0 ? (int) ceil($pr_total / $pr_per_page) : 1;
	if ($pr_page > $pr_total_pages) {
		$pr_page = $pr_total_pages;
	}
	$pr_offset = ($pr_page - 1) * $pr_per_page;
	$res = $conectar->query('SELECT * FROM proveedor ' . $pr_where_sql . ' ORDER BY nombre ASC LIMIT ' . (int) $pr_offset . ',' . (int) $pr_per_page);
	$pr_state = ['q' => $pr_q, 'activo' => $pr_act, 'page' => $pr_page];
	$ed = dayq_get_int('edit');
	$row = ['id' => 0, 'nombre' => '', 'nit' => '', 'activo' => 1];
	$pr_modal_open = false;
	if ($ed > 0) {
		$q = $conectar->query('SELECT * FROM proveedor WHERE id=' . (int) $ed);
		if ($q && ($t = $q->fetch_assoc())) {
			$row = $t;
			$pr_modal_open = true;
		}
	}
	$pr_range_from = $pr_total === 0 ? 0 : $pr_offset + 1;
	$pr_range_to = $pr_total === 0 ? 0 : min($pr_offset + $pr_per_page, $pr_total);

	echo '<div class="dayq-mod-scope" id="dayq-mod-proveedor">';
	echo '<div class="dayq-adm-table-wrap"><h2>Proveedores</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="proveedor">';
	echo '<label class="dayq-mod-filters__q">Buscar<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($pr_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Nombre o NIT" autocomplete="off"></label>';
	echo '<label>Activo<br><select class="form-control" name="activo">';
	echo '<option value="all"' . ($pr_act === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="1"' . ($pr_act === '1' ? ' selected' : '') . '>Sí</option>';
	echo '<option value="0"' . ($pr_act === '0' ? ' selected' : '') . '>No</option>';
	echo '</select></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Buscar</button>';
	echo '<a class="btn" href="modulo.php?m=proveedor">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-proveedor-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Nombre</th><th>NIT</th><th>Activo</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="4">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($trow = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($trow['nombre'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars((string) $trow['nit'], ENT_QUOTES, 'UTF-8') . '</td><td>' . ((int) $trow['activo'] ? 'Sí' : 'No') . '</td>';
			$href_edit = dayq_mod_href('proveedor', array_merge($pr_state, ['edit' => (int) $trow['id']]));
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<a class="dayq-mod-actions__link" href="' . htmlspecialchars($href_edit, ENT_QUOTES, 'UTF-8') . '" aria-label="Editar"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Editar</span></a>';
			echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
			echo '<input type="hidden" name="entity" value="proveedor"><input type="hidden" name="id" value="' . (int) $trow['id'] . '"><input type="hidden" name="action" value="delete">';
			echo '<button type="submit" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-confirm-submit" data-dayq-confirm-title="Eliminar proveedor" data-dayq-confirm="¿Eliminar este proveedor? Esta acción no se puede deshacer." data-dayq-confirm-ok="Sí, eliminar" aria-label="Eliminar"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar</span></button>';
			echo '</form></div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="4">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $pr_range_from . '–' . (int) $pr_range_to . ' de ' . (int) $pr_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($pr_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href('proveedor', array_merge($pr_state, ['page' => $pr_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $pr_page - 2);
	$p_to = min($pr_total_pages, $pr_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $pr_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href('proveedor', array_merge($pr_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($pr_page >= $pr_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href('proveedor', array_merge($pr_state, ['page' => $pr_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	$modal_class = 'dayq-mod-modal';
	if ($pr_modal_open) {
		$modal_class .= ' is-open';
	}
	echo '<div class="' . htmlspecialchars($modal_class, ENT_QUOTES, 'UTF-8') . '" id="dayq-proveedor-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-proveedor-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="dayq-proveedor-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-proveedor-modal-title">' . ($row['id'] ? 'Editar proveedor' : 'Nuevo proveedor') . '</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-proveedor-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-proveedor-form">';
	echo '<input type="hidden" name="entity" value="proveedor"><input type="hidden" name="id" id="dayq-proveedor-field-id" value="' . (int) $row['id'] . '">';
	echo '<p><label>Nombre<br><input class="form-control" id="dayq-proveedor-field-nombre" name="nombre" required value="' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>NIT<br><input class="form-control" id="dayq-proveedor-field-nit" name="nit" value="' . htmlspecialchars((string) $row['nit'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label class="dayq-mod-check"><input type="checkbox" name="activo" id="dayq-proveedor-field-activo" value="1"' . ((int) $row['activo'] ? ' checked' : '') . '> <span>Activo</span></label></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar</button></div></form></div></div></div></div>';

	echo '<script>(function(){var scope=document.getElementById("dayq-mod-proveedor");if(!scope)return;var modal=document.getElementById("dayq-proveedor-modal");var overlay=document.getElementById("dayq-proveedor-modal-overlay");var titleEl=document.getElementById("dayq-proveedor-modal-title");var idEl=document.getElementById("dayq-proveedor-field-id");var nomEl=document.getElementById("dayq-proveedor-field-nombre");var nitEl=document.getElementById("dayq-proveedor-field-nit");var actEl=document.getElementById("dayq-proveedor-field-activo");function syncEditInUrl(id){if(!window.history||typeof window.history.replaceState!=="function"||typeof URL==="undefined")return;var url=new URL(window.location.href);if(id&&parseInt(id,10)>0){url.searchParams.set("edit",String(parseInt(id,10)));}else{url.searchParams.delete("edit");}window.history.replaceState(null,"",url.toString());}function openModal(id){modal.classList.add("is-open");syncEditInUrl(id||0);}function closeModal(){modal.classList.remove("is-open");syncEditInUrl(0);}var btnNew=scope.querySelector(".dayq-proveedor-btn-new");if(btnNew)btnNew.addEventListener("click",function(){if(titleEl)titleEl.textContent="Nuevo proveedor";if(idEl)idEl.value="0";if(nomEl)nomEl.value="";if(nitEl)nitEl.value="";if(actEl)actEl.checked=true;openModal(0);if(nomEl)nomEl.focus();});scope.querySelectorAll(".dayq-proveedor-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});if(modal.classList.contains("is-open")){syncEditInUrl(idEl&&idEl.value?idEl.value:0);}})();</script>';
	echo '</div>';
}

if ($m === 'movimiento_cuenta') {
	$mc_mod = 'movimiento_cuenta';
	$mc_per_page = 15;
	$mc_fd = isset($_GET['fecha_desde']) ? trim((string) $_GET['fecha_desde']) : '';
	$mc_fh = isset($_GET['fecha_hasta']) ? trim((string) $_GET['fecha_hasta']) : '';
	$mc_cuenta_id = dayq_get_int('cuenta_id');
	$mc_mov_tipo = isset($_GET['mov_tipo']) ? (string) $_GET['mov_tipo'] : 'all';
	if (!in_array($mc_mov_tipo, ['all', 'INGRESO', 'SALIDA'], true)) {
		$mc_mov_tipo = 'all';
	}
	$mc_page = dayq_get_int('page', 1);
	if ($mc_page < 1) {
		$mc_page = 1;
	}
	$mc_parts = [];
	if ($mc_fd !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $mc_fd)) {
		$mc_parts[] = "m.fecha >= '" . $conectar->real_escape_string($mc_fd) . " 00:00:00'";
	}
	if ($mc_fh !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $mc_fh)) {
		$mc_parts[] = "m.fecha <= '" . $conectar->real_escape_string($mc_fh) . " 23:59:59'";
	}
	if ($mc_cuenta_id > 0) {
		$mc_parts[] = 'm.cuenta_id=' . (int) $mc_cuenta_id;
	}
	if ($mc_mov_tipo !== 'all') {
		$mc_parts[] = "m.tipo='" . $conectar->real_escape_string($mc_mov_tipo) . "'";
	}
	$mc_where_sql = count($mc_parts) ? 'WHERE ' . implode(' AND ', $mc_parts) : '';
	$mc_join = 'movimiento_cuenta m JOIN cuenta c ON c.id=m.cuenta_id';
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM ' . $mc_join . ' ' . $mc_where_sql);
	$mc_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$mc_total = (int) $crow['c'];
	}
	$mc_total_pages = $mc_total > 0 ? (int) ceil($mc_total / $mc_per_page) : 1;
	if ($mc_page > $mc_total_pages) {
		$mc_page = $mc_total_pages;
	}
	$mc_offset = ($mc_page - 1) * $mc_per_page;
	$res = $conectar->query('SELECT m.*, c.codigo AS cc FROM ' . $mc_join . ' ' . $mc_where_sql . ' ORDER BY m.fecha DESC, m.id DESC LIMIT ' . (int) $mc_offset . ',' . (int) $mc_per_page);
	$mc_state = ['fecha_desde' => $mc_fd, 'fecha_hasta' => $mc_fh, 'cuenta_id' => $mc_cuenta_id, 'mov_tipo' => $mc_mov_tipo, 'page' => $mc_page];
	$mc_range_from = $mc_total === 0 ? 0 : $mc_offset + 1;
	$mc_range_to = $mc_total === 0 ? 0 : min($mc_offset + $mc_per_page, $mc_total);

	echo '<div class="dayq-mod-scope" id="dayq-mod-movimiento">';
	echo '<div class="dayq-adm-table-wrap"><h2>Movimientos</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters dayq-mod-filters--wide" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="movimiento_cuenta">';
	echo '<label>Desde<br><input class="form-control" type="date" name="fecha_desde" value="' . htmlspecialchars($mc_fd, ENT_QUOTES, 'UTF-8') . '"></label>';
	echo '<label>Hasta<br><input class="form-control" type="date" name="fecha_hasta" value="' . htmlspecialchars($mc_fh, ENT_QUOTES, 'UTF-8') . '"></label>';
	echo '<label>Cuenta<br><select class="form-control" name="cuenta_id">' . dayq_options_cuentas_filter($conectar, $mc_cuenta_id) . '</select></label>';
	echo '<label>Tipo<br><select class="form-control" name="mov_tipo">';
	echo '<option value="all"' . ($mc_mov_tipo === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="INGRESO"' . ($mc_mov_tipo === 'INGRESO' ? ' selected' : '') . '>INGRESO</option>';
	echo '<option value="SALIDA"' . ($mc_mov_tipo === 'SALIDA' ? ' selected' : '') . '>SALIDA</option>';
	echo '</select></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Filtrar</button>';
	echo '<a class="btn" href="modulo.php?m=movimiento_cuenta">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-mov-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Fecha</th><th>Cuenta</th><th>Tipo</th><th>Monto</th><th>Descripción</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="6">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($row = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['cc'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['tipo'], ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars($row['monto'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars((string) $row['descripcion'], ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
			echo '<input type="hidden" name="entity" value="movimiento_cuenta"><input type="hidden" name="id" value="' . (int) $row['id'] . '"><input type="hidden" name="action" value="delete">';
			echo '<button type="submit" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-confirm-submit" data-dayq-confirm-title="Quitar movimiento" data-dayq-confirm="Se revertirá el saldo de la cuenta y se eliminará el movimiento. ¿Desea continuar?" data-dayq-confirm-ok="Sí, quitar" aria-label="Quitar"><i class="fa-solid fa-xmark" aria-hidden="true"></i><span class="sr-only">Quitar</span></button>';
			echo '</form></div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="6">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $mc_range_from . '–' . (int) $mc_range_to . ' de ' . (int) $mc_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($mc_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href($mc_mod, array_merge($mc_state, ['page' => $mc_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $mc_page - 2);
	$p_to = min($mc_total_pages, $mc_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $mc_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href($mc_mod, array_merge($mc_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($mc_page >= $mc_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href($mc_mod, array_merge($mc_state, ['page' => $mc_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	echo '<div class="dayq-mod-modal" id="dayq-mov-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-mov-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog dayq-mod-modal__dialog--wide" role="dialog" aria-modal="true" aria-labelledby="dayq-mov-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-mov-modal-title">Nuevo movimiento</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-mov-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-mov-form">';
	echo '<input type="hidden" name="entity" value="movimiento_cuenta"><input type="hidden" name="id" value="0">';
	echo '<div class="dayq-mod-form-grid">';
	echo '<p><label>Cuenta<br><select class="form-control" name="cuenta_id" id="dayq-mov-field-cuenta" required><option value="">—</option>' . dayq_options_cuentas($conectar) . '</select></label></p>';
	echo '<p><label>Tipo<br><select class="form-control" name="tipo" id="dayq-mov-field-tipo" required><option value="INGRESO">INGRESO</option><option value="SALIDA">SALIDA</option></select></label></p>';
	echo '<p><label>Monto<br><input class="form-control" type="number" step="0.01" name="monto" id="dayq-mov-field-monto" required></label></p>';
	echo '<p><label>Fecha<br><input class="form-control" type="datetime-local" name="fecha" id="dayq-mov-field-fecha"></label></p>';
	echo '<p><label>Medio de pago (opcional)<br><select class="form-control" name="medio_pago_id" id="dayq-mov-field-medio"><option value="">—</option>' . dayq_options_medios($conectar) . '</select></label></p>';
	echo '<p><label>Referencia<br><input class="form-control" name="referencia" id="dayq-mov-field-ref"></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label>Descripción<br><input class="form-control" name="descripcion" id="dayq-mov-field-desc"></label></p>';
	echo '</div>';
	echo '<p class="dayq-mod-modal__hint"><small>El registro afecta el saldo de la cuenta seleccionada.</small></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Registrar</button></div>';
	echo '</form></div></div></div></div>';

	echo '<script>(function(){var scope=document.getElementById("dayq-mod-movimiento");if(!scope)return;var modal=document.getElementById("dayq-mov-modal");var overlay=document.getElementById("dayq-mov-modal-overlay");var form=document.getElementById("dayq-mov-form");function openModal(){if(form)form.reset();modal.classList.add("is-open");var c=document.getElementById("dayq-mov-field-cuenta");if(c)c.focus();}function closeModal(){modal.classList.remove("is-open");}var btnNew=scope.querySelector(".dayq-mov-btn-new");if(btnNew)btnNew.addEventListener("click",openModal);scope.querySelectorAll(".dayq-mov-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});})();</script>';
	echo '</div>';
}

if ($m === 'gasto') {
	$ga_mod = 'gasto';
	$ga_per_page = 15;
	$ga_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$ga_anul = isset($_GET['anulado']) ? (string) $_GET['anulado'] : 'all';
	if ($ga_anul !== '0' && $ga_anul !== '1') {
		$ga_anul = 'all';
	}
	$ga_fd = isset($_GET['fecha_desde']) ? trim((string) $_GET['fecha_desde']) : '';
	$ga_fh = isset($_GET['fecha_hasta']) ? trim((string) $_GET['fecha_hasta']) : '';
	$ga_page = dayq_get_int('page', 1);
	if ($ga_page < 1) {
		$ga_page = 1;
	}
	$ga_parts = [];
	if ($ga_q !== '') {
		$eq = dayq_e($conectar, $ga_q);
		$ga_parts[] = "g.concepto LIKE '%" . $eq . "%'";
	}
	if ($ga_anul === '0') {
		$ga_parts[] = 'g.anulado=0';
	} elseif ($ga_anul === '1') {
		$ga_parts[] = 'g.anulado=1';
	}
	if ($ga_fd !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $ga_fd)) {
		$ga_parts[] = "g.fecha >= '" . $conectar->real_escape_string($ga_fd) . " 00:00:00'";
	}
	if ($ga_fh !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $ga_fh)) {
		$ga_parts[] = "g.fecha <= '" . $conectar->real_escape_string($ga_fh) . " 23:59:59'";
	}
	$ga_where_sql = count($ga_parts) ? 'WHERE ' . implode(' AND ', $ga_parts) : '';
	$ga_join = 'gasto g JOIN cuenta c ON c.id=g.cuenta_id';
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM ' . $ga_join . ' ' . $ga_where_sql);
	$ga_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$ga_total = (int) $crow['c'];
	}
	$ga_total_pages = $ga_total > 0 ? (int) ceil($ga_total / $ga_per_page) : 1;
	if ($ga_page > $ga_total_pages) {
		$ga_page = $ga_total_pages;
	}
	$ga_offset = ($ga_page - 1) * $ga_per_page;
	$res = $conectar->query('SELECT g.*, c.codigo AS cc FROM ' . $ga_join . ' ' . $ga_where_sql . ' ORDER BY g.fecha DESC, g.id DESC LIMIT ' . (int) $ga_offset . ',' . (int) $ga_per_page);
	$ga_state = ['q' => $ga_q, 'anulado' => $ga_anul, 'fecha_desde' => $ga_fd, 'fecha_hasta' => $ga_fh, 'page' => $ga_page];
	$ga_range_from = $ga_total === 0 ? 0 : $ga_offset + 1;
	$ga_range_to = $ga_total === 0 ? 0 : min($ga_offset + $ga_per_page, $ga_total);

	echo '<div class="dayq-mod-scope" id="dayq-mod-gasto">';
	echo '<div class="dayq-adm-table-wrap"><h2>Gastos</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters dayq-mod-filters--wide" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="gasto">';
	echo '<label class="dayq-mod-filters__q">Concepto<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($ga_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Buscar" autocomplete="off"></label>';
	echo '<label>Anulado<br><select class="form-control" name="anulado">';
	echo '<option value="all"' . ($ga_anul === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="0"' . ($ga_anul === '0' ? ' selected' : '') . '>No</option>';
	echo '<option value="1"' . ($ga_anul === '1' ? ' selected' : '') . '>Sí</option>';
	echo '</select></label>';
	echo '<label>Desde<br><input class="form-control" type="date" name="fecha_desde" value="' . htmlspecialchars($ga_fd, ENT_QUOTES, 'UTF-8') . '"></label>';
	echo '<label>Hasta<br><input class="form-control" type="date" name="fecha_hasta" value="' . htmlspecialchars($ga_fh, ENT_QUOTES, 'UTF-8') . '"></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Filtrar</button>';
	echo '<a class="btn" href="modulo.php?m=gasto">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-gasto-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Fecha</th><th>Cuenta</th><th>Concepto</th><th>Monto</th><th>Anulado</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="6">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($row = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['cc'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['concepto'], ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars($row['monto'], ENT_QUOTES, 'UTF-8') . '</td><td>' . ((int) $row['anulado'] ? 'Sí' : 'No') . '</td>';
			echo '<td class="dayq-mod-actions">';
			if (!(int) $row['anulado']) {
				echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
				echo '<input type="hidden" name="entity" value="gasto"><input type="hidden" name="id" value="' . (int) $row['id'] . '"><input type="hidden" name="action" value="anular">';
				echo '<input type="hidden" name="motivo_anulacion" value="">';
				echo '<button type="button" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-gasto-anular-btn" aria-label="Anular"><i class="fa-solid fa-ban" aria-hidden="true"></i><span class="sr-only">Anular</span></button>';
				echo '</form>';
			} else {
				$motivoTxt = trim((string) (isset($row['motivo_anulacion']) ? $row['motivo_anulacion'] : ''));
				$motivoAttr = htmlspecialchars($motivoTxt, ENT_QUOTES, 'UTF-8');
				echo '<button type="button" class="dayq-mod-actions__btn dayq-gasto-motivo-btn" data-dayq-motivo="' . $motivoAttr . '" aria-label="Ver motivo de anulación"><i class="fa-solid fa-comment-dots" aria-hidden="true"></i><span class="sr-only">Ver motivo</span></button>';
			}
			echo '</td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="6">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $ga_range_from . '–' . (int) $ga_range_to . ' de ' . (int) $ga_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($ga_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href($ga_mod, array_merge($ga_state, ['page' => $ga_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $ga_page - 2);
	$p_to = min($ga_total_pages, $ga_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $ga_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href($ga_mod, array_merge($ga_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($ga_page >= $ga_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href($ga_mod, array_merge($ga_state, ['page' => $ga_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	echo '<div class="dayq-mod-modal" id="dayq-gasto-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-gasto-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog dayq-mod-modal__dialog--wide" role="dialog" aria-modal="true" aria-labelledby="dayq-gasto-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-gasto-modal-title">Nuevo gasto</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-gasto-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-gasto-form">';
	echo '<input type="hidden" name="entity" value="gasto">';
	echo '<div class="dayq-mod-form-grid">';
	echo '<p><label>Cuenta<br><select class="form-control" name="cuenta_id" id="dayq-gasto-field-cuenta" required><option value="">—</option>' . dayq_options_cuentas($conectar) . '</select></label></p>';
	echo '<p><label>Monto<br><input class="form-control" type="number" step="0.01" name="monto" id="dayq-gasto-field-monto" required></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label>Concepto<br><input class="form-control" name="concepto" id="dayq-gasto-field-concepto" required></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label>Fecha<br><input class="form-control" type="datetime-local" name="fecha" id="dayq-gasto-field-fecha"></label></p>';
	echo '</div>';
	echo '<p class="dayq-mod-modal__hint"><small>Se registrará una <strong>SALIDA</strong> en la cuenta indicada.</small></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar</button></div>';
	echo '</form></div></div></div></div>';

	echo '<script>(function(){var scope=document.getElementById("dayq-mod-gasto");if(!scope)return;var modal=document.getElementById("dayq-gasto-modal");var overlay=document.getElementById("dayq-gasto-modal-overlay");var form=document.getElementById("dayq-gasto-form");function openModal(){if(form)form.reset();modal.classList.add("is-open");var c=document.getElementById("dayq-gasto-field-cuenta");if(c)c.focus();}function closeModal(){modal.classList.remove("is-open");}function askMotivoAndSubmit(btn){var formEl=btn.closest("form");if(!formEl)return;var motivoInput=formEl.querySelector(\'input[name="motivo_anulacion"]\');var submit=function(m){if(motivoInput)motivoInput.value=m;formEl.submit();};if(window.Swal&&typeof window.Swal.fire==="function"){window.Swal.fire({title:"Anular gasto",text:"Indique el motivo de anulación",input:"text",inputPlaceholder:"Motivo de anulación",inputAttributes:{maxlength:"500"},showCancelButton:true,confirmButtonText:"Anular",cancelButtonText:"Cancelar",reverseButtons:true,focusCancel:true,confirmButtonColor:"#dc2626",cancelButtonColor:"#64748b",preConfirm:function(v){if(!v||!String(v).trim()){window.Swal.showValidationMessage("El motivo es obligatorio");return false;}return String(v).trim();}}).then(function(r){if(r&&r.isConfirmed){submit(r.value||"");}});return;}var m=window.prompt("Motivo de anulación:","");if(m&&String(m).trim()!==""){submit(String(m).trim());}}function showMotivo(btn){var motivo=btn.getAttribute("data-dayq-motivo")||"";if(window.Swal&&typeof window.Swal.fire==="function"){window.Swal.fire({title:"Motivo de anulación",text:motivo!==""?motivo:"Sin motivo registrado",icon:"info",confirmButtonText:"Cerrar"});return;}window.alert("Motivo de anulación: "+(motivo!==""?motivo:"Sin motivo registrado"));}var btnNew=scope.querySelector(".dayq-gasto-btn-new");if(btnNew)btnNew.addEventListener("click",openModal);scope.querySelectorAll(".dayq-gasto-anular-btn").forEach(function(b){b.addEventListener("click",function(){askMotivoAndSubmit(b);});});scope.querySelectorAll(".dayq-gasto-motivo-btn").forEach(function(b){b.addEventListener("click",function(){showMotivo(b);});});scope.querySelectorAll(".dayq-gasto-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});})();</script>';
	echo '</div>';
}

if ($m === 'obligacion_financiera') {
	$ob_mod = 'obligacion_financiera';
	$ob_per_page = 15;
	$ob_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$ob_filter_tipo = isset($_GET['tipo']) ? (string) $_GET['tipo'] : 'all';
	if (!in_array($ob_filter_tipo, ['all', 'POR_COBRAR', 'POR_PAGAR'], true)) {
		$ob_filter_tipo = 'all';
	}
	$ob_filter_estado = isset($_GET['estado']) ? (string) $_GET['estado'] : 'all';
	$ob_valid_est = ['PENDIENTE', 'PAGADO_PARCIAL', 'PAGADO', 'ANULADO'];
	if ($ob_filter_estado !== 'all' && !in_array($ob_filter_estado, $ob_valid_est, true)) {
		$ob_filter_estado = 'all';
	}
	$ob_page = dayq_get_int('page', 1);
	if ($ob_page < 1) {
		$ob_page = 1;
	}
	$ob_where = [];
	if ($ob_q !== '') {
		$eq = dayq_e($conectar, $ob_q);
		$ob_where[] = "concepto LIKE '%" . $eq . "%'";
	}
	if ($ob_filter_tipo !== 'all') {
		$ob_where[] = "tipo='" . $conectar->real_escape_string($ob_filter_tipo) . "'";
	}
	if ($ob_filter_estado !== 'all') {
		$ob_where[] = "estado='" . $conectar->real_escape_string($ob_filter_estado) . "'";
	}
	$ob_where_sql = count($ob_where) ? 'WHERE ' . implode(' AND ', $ob_where) : '';
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM obligacion_financiera ' . $ob_where_sql);
	$ob_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$ob_total = (int) $crow['c'];
	}
	$ob_total_pages = $ob_total > 0 ? (int) ceil($ob_total / $ob_per_page) : 1;
	if ($ob_page > $ob_total_pages) {
		$ob_page = $ob_total_pages;
	}
	$ob_offset = ($ob_page - 1) * $ob_per_page;
	$res = $conectar->query('SELECT * FROM obligacion_financiera ' . $ob_where_sql . ' ORDER BY fecha_vencimiento DESC, id DESC LIMIT ' . (int) $ob_offset . ',' . (int) $ob_per_page);
	$ob_state = ['q' => $ob_q, 'tipo' => $ob_filter_tipo, 'estado' => $ob_filter_estado, 'page' => $ob_page];
	$ed = dayq_get_int('edit');
	$row = ['id' => 0, 'tipo' => 'POR_PAGAR', 'concepto' => '', 'monto' => '', 'monto_pendiente' => '', 'fecha_vencimiento' => date('Y-m-d'), 'estado' => 'PENDIENTE', 'cliente_id' => '', 'proveedor_id' => '', 'cuenta_registro_id' => ''];
	$ob_modal_open = false;
	if ($ed > 0) {
		$q = $conectar->query('SELECT * FROM obligacion_financiera WHERE id=' . (int) $ed);
		if ($q && ($t = $q->fetch_assoc())) {
			$row = $t;
			$ob_modal_open = true;
		}
	}
	$ob_range_from = $ob_total === 0 ? 0 : $ob_offset + 1;
	$ob_range_to = $ob_total === 0 ? 0 : min($ob_offset + $ob_per_page, $ob_total);

	$selCli = (int) (isset($row['cliente_id']) ? $row['cliente_id'] : 0);
	$selProv = (int) (isset($row['proveedor_id']) ? $row['proveedor_id'] : 0);
	$selCta = (int) (isset($row['cuenta_registro_id']) ? $row['cuenta_registro_id'] : 0);
	$optCli = '<option value="">—</option>';
	$rc = $conectar->query('SELECT id, nombre FROM cliente WHERE activo=1 ORDER BY nombre');
	while ($rc && ($x = $rc->fetch_assoc())) {
		$s = ((int) $x['id'] === $selCli) ? ' selected' : '';
		$optCli .= '<option value="' . (int) $x['id'] . '"' . $s . '>' . htmlspecialchars($x['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	$optProv = '<option value="">—</option>';
	$rp = $conectar->query('SELECT id, nombre FROM proveedor WHERE activo=1 ORDER BY nombre');
	while ($rp && ($x = $rp->fetch_assoc())) {
		$s = ((int) $x['id'] === $selProv) ? ' selected' : '';
		$optProv .= '<option value="' . (int) $x['id'] . '"' . $s . '>' . htmlspecialchars($x['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	$optCta = '<option value="">—</option>';
	$rct = $conectar->query('SELECT id, codigo, nombre FROM cuenta WHERE activo=1 ORDER BY codigo');
	while ($rct && ($x = $rct->fetch_assoc())) {
		$s = ((int) $x['id'] === $selCta) ? ' selected' : '';
		$optCta .= '<option value="' . (int) $x['id'] . '"' . $s . '>' . htmlspecialchars($x['codigo'] . ' — ' . $x['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}

	echo '<div class="dayq-mod-scope" id="dayq-mod-obligacion">';
	echo '<div class="dayq-adm-table-wrap"><h2>Obligaciones financieras</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="obligacion_financiera">';
	echo '<label class="dayq-mod-filters__q">Buscar concepto<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($ob_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Concepto" autocomplete="off"></label>';
	echo '<label>Tipo<br><select class="form-control" name="tipo">';
	echo '<option value="all"' . ($ob_filter_tipo === 'all' ? ' selected' : '') . '>Todos</option>';
	echo '<option value="POR_COBRAR"' . ($ob_filter_tipo === 'POR_COBRAR' ? ' selected' : '') . '>POR_COBRAR</option>';
	echo '<option value="POR_PAGAR"' . ($ob_filter_tipo === 'POR_PAGAR' ? ' selected' : '') . '>POR_PAGAR</option>';
	echo '</select></label>';
	echo '<label>Estado<br><select class="form-control" name="estado">';
	echo '<option value="all"' . ($ob_filter_estado === 'all' ? ' selected' : '') . '>Todos</option>';
	foreach ($ob_valid_est as $ev) {
		echo '<option value="' . htmlspecialchars($ev, ENT_QUOTES, 'UTF-8') . '"' . ($ob_filter_estado === $ev ? ' selected' : '') . '>' . htmlspecialchars($ev, ENT_QUOTES, 'UTF-8') . '</option>';
	}
	echo '</select></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Buscar</button>';
	echo '<a class="btn" href="modulo.php?m=obligacion_financiera">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-ob-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo registro</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Tipo</th><th>Concepto</th><th>Monto</th><th>Pendiente</th><th>Vence</th><th>Estado</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="7">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($trow = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($trow['tipo'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($trow['concepto'], ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars($trow['monto'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($trow['monto_pendiente'], ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars($trow['fecha_vencimiento'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($trow['estado'], ENT_QUOTES, 'UTF-8') . '</td>';
			$href_edit = dayq_mod_href($ob_mod, array_merge($ob_state, ['edit' => (int) $trow['id']]));
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<a class="dayq-mod-actions__link" href="' . htmlspecialchars($href_edit, ENT_QUOTES, 'UTF-8') . '" aria-label="Editar"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Editar</span></a>';
			echo '<form method="post" action="reg_dayq.php" class="dayq-mod-actions__form">';
			echo '<input type="hidden" name="entity" value="obligacion_financiera"><input type="hidden" name="id" value="' . (int) $trow['id'] . '"><input type="hidden" name="action" value="delete">';
			echo '<button type="submit" class="dayq-mod-actions__btn dayq-mod-actions__btn--danger dayq-confirm-submit" data-dayq-confirm-title="Eliminar obligación" data-dayq-confirm="¿Eliminar esta obligación financiera? Esta acción no se puede deshacer." data-dayq-confirm-ok="Sí, eliminar" aria-label="Eliminar"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar</span></button>';
			echo '</form></div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="7">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $ob_range_from . '–' . (int) $ob_range_to . ' de ' . (int) $ob_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($ob_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href($ob_mod, array_merge($ob_state, ['page' => $ob_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $ob_page - 2);
	$p_to = min($ob_total_pages, $ob_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $ob_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href($ob_mod, array_merge($ob_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($ob_page >= $ob_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href($ob_mod, array_merge($ob_state, ['page' => $ob_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	$modal_class = 'dayq-mod-modal';
	if ($ob_modal_open) {
		$modal_class .= ' is-open';
	}
	echo '<div class="' . htmlspecialchars($modal_class, ENT_QUOTES, 'UTF-8') . '" id="dayq-ob-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-ob-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog dayq-mod-modal__dialog--wide" role="dialog" aria-modal="true" aria-labelledby="dayq-ob-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-ob-modal-title">' . ($row['id'] ? 'Editar obligación' : 'Nueva obligación') . '</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-ob-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body"><form method="post" action="reg_dayq.php" id="dayq-ob-form">';
	echo '<input type="hidden" name="entity" value="obligacion_financiera"><input type="hidden" name="id" id="dayq-ob-field-id" value="' . (int) $row['id'] . '">';
	echo '<div class="dayq-mod-form-grid">';
	echo '<p><label>Tipo<br><select class="form-control" name="tipo" id="dayq-ob-field-tipo">' . implode('', array_map(function ($x) use ($row) {
		$s = ($row['tipo'] === $x) ? ' selected' : '';
		return '<option value="' . $x . '"' . $s . '>' . $x . '</option>';
	}, ['POR_COBRAR', 'POR_PAGAR'])) . '</select></label></p>';
	echo '<p><label>Estado<br><select class="form-control" name="estado" id="dayq-ob-field-estado">' . implode('', array_map(function ($x) use ($row) {
		$s = ($row['estado'] === $x) ? ' selected' : '';
		return '<option value="' . $x . '"' . $s . '>' . $x . '</option>';
	}, ['PENDIENTE', 'PAGADO_PARCIAL', 'PAGADO', 'ANULADO'])) . '</select></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label>Concepto<br><input class="form-control" id="dayq-ob-field-concepto" name="concepto" required value="' . htmlspecialchars($row['concepto'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Monto<br><input class="form-control" type="number" step="0.01" id="dayq-ob-field-monto" name="monto" required value="' . htmlspecialchars((string) $row['monto'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Monto pendiente<br><input class="form-control" type="number" step="0.01" id="dayq-ob-field-monto-pend" name="monto_pendiente" required value="' . htmlspecialchars((string) $row['monto_pendiente'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Vencimiento<br><input class="form-control" type="date" id="dayq-ob-field-fv" name="fecha_vencimiento" required value="' . htmlspecialchars(substr((string) $row['fecha_vencimiento'], 0, 10), ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Cliente (opcional)<br><select class="form-control" name="cliente_id" id="dayq-ob-field-cli">' . $optCli . '</select></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label>Proveedor (opcional)<br><select class="form-control" name="proveedor_id" id="dayq-ob-field-prov">' . $optProv . '</select></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label>Cuenta para movimiento al pasar a PAGADO (opcional)<br><select class="form-control" name="cuenta_registro_id" id="dayq-ob-field-cta">' . $optCta . '</select></label></p>';
	echo '</div>';
	echo '<p class="dayq-mod-modal__hint"><small>Si pasa a PAGADO con monto pendiente &gt; 0 y cuenta de registro, se genera INGRESO (cobrar) o SALIDA (pagar) según el tipo <strong>previo</strong> del registro.</small></p>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar</button></div></form></div></div></div></div>';

	$ob_js_defaults = json_encode([
		'fv' => date('Y-m-d'),
	], JSON_UNESCAPED_UNICODE);
	echo '<script>(function(){var scope=document.getElementById("dayq-mod-obligacion");if(!scope)return;var modal=document.getElementById("dayq-ob-modal");var overlay=document.getElementById("dayq-ob-modal-overlay");var titleEl=document.getElementById("dayq-ob-modal-title");var idEl=document.getElementById("dayq-ob-field-id");var tipoEl=document.getElementById("dayq-ob-field-tipo");var conEl=document.getElementById("dayq-ob-field-concepto");var montoEl=document.getElementById("dayq-ob-field-monto");var mpEl=document.getElementById("dayq-ob-field-monto-pend");var fvEl=document.getElementById("dayq-ob-field-fv");var estEl=document.getElementById("dayq-ob-field-estado");var cliEl=document.getElementById("dayq-ob-field-cli");var provEl=document.getElementById("dayq-ob-field-prov");var ctaEl=document.getElementById("dayq-ob-field-cta");var defs=' . $ob_js_defaults . ';function syncEditInUrl(id){if(!window.history||typeof window.history.replaceState!=="function"||typeof URL==="undefined")return;var url=new URL(window.location.href);if(id&&parseInt(id,10)>0){url.searchParams.set("edit",String(parseInt(id,10)));}else{url.searchParams.delete("edit");}window.history.replaceState(null,"",url.toString());}function openModal(id){modal.classList.add("is-open");syncEditInUrl(id||0);}function closeModal(){modal.classList.remove("is-open");syncEditInUrl(0);}function selFirstEmpty(sel){if(!sel)return;sel.selectedIndex=0;}var btnNew=scope.querySelector(".dayq-ob-btn-new");if(btnNew)btnNew.addEventListener("click",function(){if(titleEl)titleEl.textContent="Nueva obligación";if(idEl)idEl.value="0";if(tipoEl){tipoEl.value="POR_PAGAR";}if(conEl)conEl.value="";if(montoEl)montoEl.value="";if(mpEl)mpEl.value="";if(fvEl)fvEl.value=defs.fv||"";if(estEl)estEl.value="PENDIENTE";selFirstEmpty(cliEl);selFirstEmpty(provEl);selFirstEmpty(ctaEl);openModal(0);if(conEl)conEl.focus();});scope.querySelectorAll(".dayq-ob-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});if(modal.classList.contains("is-open")){syncEditInUrl(idEl&&idEl.value?idEl.value:0);}})();</script>';
	echo '</div>';
}

if ($m === 'compra') {
	$co_mod = 'compra';
	$co_per_page = 15;
	$co_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
	$co_page = dayq_get_int('page', 1);
	if ($co_page < 1) {
		$co_page = 1;
	}
	$co_join = 'compra c JOIN proveedor p ON p.id=c.proveedor_id';
	$co_where_sql = '';
	if ($co_q !== '') {
		$eq = dayq_e($conectar, $co_q);
		$co_where_sql = "WHERE (c.numero LIKE '%" . $eq . "%' OR p.nombre LIKE '%" . $eq . "%')";
	}
	$cr = $conectar->query('SELECT COUNT(*) AS c FROM ' . $co_join . ' ' . $co_where_sql);
	$co_total = 0;
	if ($cr && ($crow = $cr->fetch_assoc())) {
		$co_total = (int) $crow['c'];
	}
	$co_total_pages = $co_total > 0 ? (int) ceil($co_total / $co_per_page) : 1;
	if ($co_page > $co_total_pages) {
		$co_page = $co_total_pages;
	}
	$co_offset = ($co_page - 1) * $co_per_page;
	$res = $conectar->query('SELECT c.*, p.nombre AS prov FROM ' . $co_join . ' ' . $co_where_sql . ' ORDER BY c.fecha DESC, c.id DESC LIMIT ' . (int) $co_offset . ',' . (int) $co_per_page);
	$co_state = ['q' => $co_q, 'page' => $co_page];
	$co_range_from = $co_total === 0 ? 0 : $co_offset + 1;
	$co_range_to = $co_total === 0 ? 0 : min($co_offset + $co_per_page, $co_total);
	$co_ed = dayq_get_int('edit');
	$co_row = ['id' => 0, 'numero' => '', 'fecha' => date('Y-m-d\TH:i'), 'proveedor_id' => '', 'estado' => 'PENDIENTE', 'pagada' => 0, 'cuenta_pago_id' => '', 'medio_pago_id' => '', 'crear_obligacion' => 0];
	$co_lines = [['descripcion' => '', 'cantidad' => 1, 'precio_unitario' => '0']];
	$co_modal_open = false;
	if ($co_ed > 0) {
		$qed = $conectar->query('SELECT * FROM compra WHERE id=' . (int) $co_ed);
		if ($qed && ($t = $qed->fetch_assoc())) {
			$co_row = $t;
			$co_row['fecha'] = str_replace(' ', 'T', substr((string) $co_row['fecha'], 0, 16));
			$lq = $conectar->query('SELECT * FROM linea_compra WHERE compra_id=' . (int) $co_ed . ' ORDER BY id');
			$co_lines = [];
			while ($lq && ($ln = $lq->fetch_assoc())) {
				$co_lines[] = $ln;
			}
			if (count($co_lines) === 0) {
				$co_lines[] = ['descripcion' => '', 'cantidad' => 1, 'precio_unitario' => '0'];
			}
			$co_modal_open = true;
		}
	}

	echo '<div class="dayq-mod-scope" id="dayq-mod-compra">';
	echo '<div class="dayq-adm-table-wrap"><h2>Compras</h2>';
	echo '<div class="dayq-mod-toolbar">';
	echo '<form class="dayq-mod-filters" method="get" action="modulo.php" role="search">';
	echo '<input type="hidden" name="m" value="compra">';
	echo '<label class="dayq-mod-filters__q">Buscar<br><input class="form-control" type="search" name="q" value="' . htmlspecialchars($co_q, ENT_QUOTES, 'UTF-8') . '" placeholder="Número o proveedor" autocomplete="off"></label>';
	echo '<div class="dayq-mod-filters__actions"><button type="submit" class="btn btn-primary">Buscar</button>';
	echo '<a class="btn" href="modulo.php?m=compra">Limpiar</a></div>';
	echo '</form>';
	echo '<div class="dayq-mod-toolbar__actions"><button type="button" class="btn btn-primary dayq-compra-btn-new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nueva compra</button></div>';
	echo '</div>';

	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Número</th><th>Fecha</th><th>Proveedor</th><th>Total</th><th>Estado</th><th>Pagada</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody>';
	if (!$res) {
		echo '<tr><td colspan="7">No se pudo cargar el listado.</td></tr>';
	} else {
		$has_rows = false;
		while ($row = $res->fetch_assoc()) {
			$has_rows = true;
			echo '<tr><td>' . htmlspecialchars($row['numero'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['prov'], ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars($row['total'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['estado'], ENT_QUOTES, 'UTF-8') . '</td><td>' . ((int) $row['pagada'] ? 'Sí' : 'No') . '</td>';
			$href_edit = dayq_mod_href($co_mod, array_merge($co_state, ['edit' => (int) $row['id']]));
			echo '<td class="dayq-mod-actions"><div class="dayq-mod-actions__inner">';
			echo '<a class="dayq-mod-actions__link" href="' . htmlspecialchars($href_edit, ENT_QUOTES, 'UTF-8') . '" aria-label="Editar compra"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Editar</span></a>';
			echo '</div></td></tr>';
		}
		if (!$has_rows) {
			echo '<tr><td colspan="7">Sin resultados con los filtros actuales.</td></tr>';
		}
	}
	echo '</tbody></table>';

	echo '<nav class="dayq-mod-pagination" aria-label="Paginación">';
	echo '<p class="dayq-mod-pagination__info">Mostrando ' . (int) $co_range_from . '–' . (int) $co_range_to . ' de ' . (int) $co_total . '</p>';
	echo '<div class="dayq-mod-pagination__links">';
	if ($co_page <= 1) {
		echo '<span class="dayq-mod-pagination__muted">Anterior</span>';
	} else {
		$h = dayq_mod_href($co_mod, array_merge($co_state, ['page' => $co_page - 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Anterior</a>';
	}
	$p_from = max(1, $co_page - 2);
	$p_to = min($co_total_pages, $co_page + 2);
	for ($pi = $p_from; $pi <= $p_to; $pi++) {
		if ($pi === $co_page) {
			echo '<span class="dayq-mod-pagination__current">' . (int) $pi . '</span>';
		} else {
			$h = dayq_mod_href($co_mod, array_merge($co_state, ['page' => $pi]));
			echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">' . (int) $pi . '</a>';
		}
	}
	if ($co_page >= $co_total_pages) {
		echo '<span class="dayq-mod-pagination__muted">Siguiente</span>';
	} else {
		$h = dayq_mod_href($co_mod, array_merge($co_state, ['page' => $co_page + 1]));
		echo '<a href="' . htmlspecialchars($h, ENT_QUOTES, 'UTF-8') . '">Siguiente</a>';
	}
	echo '</div></nav></div>';

	$co_modal_class = 'dayq-mod-modal';
	if ($co_modal_open) {
		$co_modal_class .= ' is-open';
	}
	$co_opt_prov = '<option value="">—</option>';
	$rp = $conectar->query('SELECT id, nombre FROM proveedor WHERE activo=1 ORDER BY nombre');
	while ($rp && ($x = $rp->fetch_assoc())) {
		$s = ((int) $x['id'] === (int) $co_row['proveedor_id']) ? ' selected' : '';
		$co_opt_prov .= '<option value="' . (int) $x['id'] . '"' . $s . '>' . htmlspecialchars($x['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	$co_opt_cta = '<option value="">—</option>';
	$rct = $conectar->query('SELECT id, codigo, nombre FROM cuenta WHERE activo=1 ORDER BY codigo');
	while ($rct && ($x = $rct->fetch_assoc())) {
		$s = ((int) $x['id'] === (int) (isset($co_row['cuenta_pago_id']) ? $co_row['cuenta_pago_id'] : 0)) ? ' selected' : '';
		$co_opt_cta .= '<option value="' . (int) $x['id'] . '"' . $s . '>' . htmlspecialchars($x['codigo'] . ' — ' . $x['nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	$co_opt_med = '<option value="">—</option>';
	$rm = $conectar->query('SELECT id, codigo FROM medio_pago WHERE activo=1 ORDER BY codigo');
	while ($rm && ($x = $rm->fetch_assoc())) {
		$s = ((int) $x['id'] === (int) (isset($co_row['medio_pago_id']) ? $co_row['medio_pago_id'] : 0)) ? ' selected' : '';
		$co_opt_med .= '<option value="' . (int) $x['id'] . '"' . $s . '>' . htmlspecialchars($x['codigo'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
	echo '<div class="' . htmlspecialchars($co_modal_class, ENT_QUOTES, 'UTF-8') . '" id="dayq-compra-modal" role="presentation">';
	echo '<div class="dayq-mod-modal__overlay" id="dayq-compra-modal-overlay">';
	echo '<div class="dayq-mod-modal__dialog dayq-mod-modal__dialog--wide" role="dialog" aria-modal="true" aria-labelledby="dayq-compra-modal-title" onclick="event.stopPropagation();">';
	echo '<div class="dayq-mod-modal__head">';
	echo '<h3 class="dayq-mod-modal__title" id="dayq-compra-modal-title">' . ((int) $co_row['id'] > 0 ? 'Editar compra' : 'Nueva compra') . '</h3>';
	echo '<button type="button" class="dayq-mod-modal__close dayq-compra-modal-close" aria-label="Cerrar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__body">';
	echo '<form method="post" action="reg_dayq.php" id="dayq-compra-form">';
	echo '<input type="hidden" name="entity" value="compra"><input type="hidden" name="compra_id" id="dayq-compra-field-id" value="' . (int) $co_row['id'] . '">';
	echo '<div class="dayq-mod-form-grid">';
	echo '<p><label>Número<br><input class="form-control" id="dayq-compra-field-numero" name="numero" required value="' . htmlspecialchars((string) $co_row['numero'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Fecha<br><input class="form-control" type="datetime-local" id="dayq-compra-field-fecha" name="fecha" value="' . htmlspecialchars((string) $co_row['fecha'], ENT_QUOTES, 'UTF-8') . '"></label></p>';
	echo '<p><label>Proveedor<br><select class="form-control" name="proveedor_id" id="dayq-compra-field-proveedor" required>' . $co_opt_prov . '</select></label></p>';
	echo '<p><label>Estado<br><select class="form-control" name="estado" id="dayq-compra-field-estado">';
	foreach (['PENDIENTE', 'PAGADO_PARCIAL', 'PAGADO', 'ANULADO'] as $x) {
		echo '<option value="' . $x . '"' . (((string) $co_row['estado'] === $x) ? ' selected' : '') . '>' . $x . '</option>';
	}
	echo '</select></label></p></div>';
	echo '<h4>Líneas de compra</h4>';
	echo '<table class="dayq-adm-table dayq-mod-table"><thead><tr><th>Descripción</th><th>Cantidad</th><th>Precio unit.</th><th class="dayq-mod-actions"><span class="sr-only">Acciones</span></th></tr></thead><tbody id="dayq-compra-lines-body">';
	foreach ($co_lines as $ln) {
		echo '<tr>';
		echo '<td><input class="form-control" name="line_desc[]" value="' . htmlspecialchars((string) $ln['descripcion'], ENT_QUOTES, 'UTF-8') . '"></td>';
		echo '<td><input class="form-control" type="number" name="line_cant[]" min="1" value="' . (int) $ln['cantidad'] . '"></td>';
		echo '<td><input class="form-control" type="number" step="0.01" name="line_pre[]" value="' . htmlspecialchars((string) $ln['precio_unitario'], ENT_QUOTES, 'UTF-8') . '"></td>';
		echo '<td class="dayq-mod-actions"><button type="button" class="dayq-mod-actions__btn dayq-compra-line-remove" aria-label="Eliminar línea"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar línea</span></button></td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
	echo '<p><button type="button" class="btn dayq-compra-line-add"><i class="fa-solid fa-plus" aria-hidden="true"></i> Agregar línea</button></p>';
	echo '<div class="dayq-mod-form-grid">';
	echo '<p class="dayq-mod-form-grid__full"><label class="dayq-mod-check"><input type="checkbox" name="crear_obligacion" value="1"> <span>Crear obligación POR_PAGAR por el total (solo si aplica)</span></label></p>';
	echo '<p class="dayq-mod-form-grid__full"><label class="dayq-mod-check"><input type="checkbox" name="pagada" value="1"' . ((int) $co_row['pagada'] ? ' checked' : '') . '> <span>Pagada (genera SALIDA en cuenta)</span></label></p>';
	echo '<p><label>Cuenta de pago<br><select class="form-control" name="cuenta_pago_id">' . $co_opt_cta . '</select></label></p>';
	echo '<p><label>Medio de pago (opcional)<br><select class="form-control" name="medio_pago_id">' . $co_opt_med . '</select></label></p>';
	echo '</div>';
	echo '<div class="dayq-mod-modal__foot"><button type="submit" class="btn btn-primary">Guardar compra</button></div>';
	echo '</form>';
	echo '</div></div></div></div>';
	echo '</div>';
	echo '<script>(function(){var scope=document.getElementById("dayq-mod-compra");if(!scope)return;var modal=document.getElementById("dayq-compra-modal");var overlay=document.getElementById("dayq-compra-modal-overlay");var idEl=document.getElementById("dayq-compra-field-id");var titleEl=document.getElementById("dayq-compra-modal-title");var numEl=document.getElementById("dayq-compra-field-numero");var linesBody=document.getElementById("dayq-compra-lines-body");function syncEditInUrl(id){if(!window.history||typeof window.history.replaceState!=="function"||typeof URL==="undefined")return;var url=new URL(window.location.href);if(id&&parseInt(id,10)>0){url.searchParams.set("edit",String(parseInt(id,10)));}else{url.searchParams.delete("edit");}window.history.replaceState(null,"",url.toString());}function openModal(id){modal.classList.add("is-open");syncEditInUrl(id||0);}function closeModal(){modal.classList.remove("is-open");syncEditInUrl(0);}function bindRemove(btn){btn.addEventListener("click",function(){var tr=btn.closest("tr");if(!tr||!linesBody)return;if(linesBody.querySelectorAll("tr").length<=1){tr.querySelectorAll("input").forEach(function(i){i.value=(i.name==="line_cant[]")?"1":"";});var pu=tr.querySelector(\'input[name="line_pre[]"]\');if(pu)pu.value="0";return;}tr.remove();});}function makeLineRow(data){var tr=document.createElement("tr");var desc=(data&&data.desc)?data.desc:"";var cant=(data&&data.cant)?data.cant:"1";var pre=(data&&data.pre)?data.pre:"0";tr.innerHTML=\'<td><input class="form-control" name="line_desc[]" value=""></td><td><input class="form-control" type="number" name="line_cant[]" min="1" value="1"></td><td><input class="form-control" type="number" step="0.01" name="line_pre[]" value="0"></td><td class="dayq-mod-actions"><button type="button" class="dayq-mod-actions__btn dayq-compra-line-remove" aria-label="Eliminar línea"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar línea</span></button></td>\';tr.querySelector(\'input[name="line_desc[]"]\').value=desc;tr.querySelector(\'input[name="line_cant[]"]\').value=cant;tr.querySelector(\'input[name="line_pre[]"]\').value=pre;bindRemove(tr.querySelector(".dayq-compra-line-remove"));return tr;}if(linesBody){linesBody.querySelectorAll(".dayq-compra-line-remove").forEach(bindRemove);}var addBtn=scope.querySelector(".dayq-compra-line-add");if(addBtn&&linesBody){addBtn.addEventListener("click",function(){var tr=makeLineRow();linesBody.appendChild(tr);var inp=tr.querySelector(\'input[name="line_desc[]"]\');if(inp)inp.focus();});}var form=document.getElementById("dayq-compra-form");if(form){form.addEventListener("keydown",function(e){if(e.key!=="Enter")return;var t=e.target;if(!t||!t.name)return;if(t.name==="line_desc[]"||t.name==="line_cant[]"||t.name==="line_pre[]"){e.preventDefault();if(addBtn&&t.name==="line_pre[]"){addBtn.click();}}});}var btnNew=scope.querySelector(".dayq-compra-btn-new");if(btnNew)btnNew.addEventListener("click",function(){if(titleEl)titleEl.textContent="Nueva compra";if(idEl)idEl.value="0";if(linesBody){linesBody.innerHTML="";linesBody.appendChild(makeLineRow());}openModal(0);if(numEl)numEl.focus();});scope.querySelectorAll(".dayq-compra-modal-close").forEach(function(b){b.addEventListener("click",closeModal);});if(overlay)overlay.addEventListener("click",function(e){if(e.target===overlay)closeModal();});document.addEventListener("keydown",function(e){if(e.key!=="Escape"||!modal.classList.contains("is-open"))return;closeModal();});if(modal.classList.contains("is-open")){syncEditInUrl(idEl&&idEl.value?idEl.value:0);if(linesBody&&linesBody.querySelectorAll("tr").length===0){linesBody.appendChild(makeLineRow());}}})();</script>';
}

include __DIR__ . '/layout_footer.php';
