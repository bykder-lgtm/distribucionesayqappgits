<?php
/**
 * Layout Header - Portal Administrativo DAyQ
 * 
 * Header común para todas las páginas del módulo administrativo.
 * Incluye estilos CSS, sidebar de navegación y componentes UI.
 *
 * Funcionalidades:
 * - Estilos globales con tema oscuro
 * - Mensajes flash con auto-ocultamiento
 * - Sidebar de navegación
 *
 * @see changelog/CAMBIOS_20260724.md
 */
if (!isset($dayq_page_title)) {
	$dayq_page_title = 'Portal administrativo';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo htmlspecialchars($dayq_page_title, ENT_QUOTES, 'UTF-8'); ?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" rel="stylesheet">
	<link href="../../estilo_css/portal_administrativo.css" rel="stylesheet">
	<link href="./css/style.css?v=5" rel="stylesheet">
	<style>
	/* Botón de ayuda contextual (REQ 11) */
	.dayq-help-btn {
		margin-left: 8px;
		width: 32px;
		height: 32px;
		border-radius: 8px;
		background: rgba(79,142,247,0.1);
		border: 1px solid rgba(79,142,247,0.2);
		color: #4f8ef7;
		cursor: pointer;
		font-size: 14px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		flex-shrink: 0;
		transition: all 0.15s;
	}
	.dayq-help-btn:hover {
		background: rgba(79,142,247,0.2);
		border-color: #4f8ef7;
	}
	</style>
	<script src="./js/filtros_tabla.js"></script>
	<script src="./js/guias_modulos.js"></script>
</head>
<body class="dayq-adm-app">
<div class="dayq-adm-shell">
<?php include __DIR__ . '/../../menu/menu_administrativo.php'; ?>
<div class="dayq-adm-main">	<div class="dayq-adm-topbar">
		<img src="../../imagenes/logo_admin.png" alt="Portal administrativo" class="dayq-adm-topbar-logo">
		<span class="dayq-adm-topbar-user"><i class="fa-regular fa-circle-user"></i> <?php echo htmlspecialchars(isset($_SESSION['cuenta_actual']) ? $_SESSION['cuenta_actual'] : '', ENT_QUOTES, 'UTF-8'); ?></span>
	</div>
<?php if (!empty($_GET['msg'])): ?>
	<p class="dayq-flash-msg" style="background:#dcfce7;color:#166534;padding:0.75rem;border-radius:8px;margin-bottom:1rem;"><?php echo htmlspecialchars((string) $_GET['msg'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<?php if (!empty($_GET['err'])): ?>
	<p class="dayq-flash-msg" style="background:#fee2e2;color:#991b1b;padding:0.75rem;border-radius:8px;margin-bottom:1rem;"><?php echo htmlspecialchars((string) $_GET['err'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<script>
(function () {
	var flashes = document.querySelectorAll('.dayq-flash-msg');
	if (!flashes.length) {
		return;
	}
	flashes.forEach(function (el) {
		window.setTimeout(function () {
			el.style.transition = 'opacity 280ms ease, transform 280ms ease, margin 280ms ease';
			el.style.opacity = '0';
			el.style.transform = 'translateY(-4px)';
			el.style.marginBottom = '0';
			window.setTimeout(function () {
				if (el && el.parentNode) {
					el.parentNode.removeChild(el);
				}
			}, 320);
		}, 4500);
	});
})();
</script>
