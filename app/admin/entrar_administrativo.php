<!-- Portal administrativo DayQ — acceso solo por URL dedicada -->
<?php
include_once __DIR__ . '/01_modulo_diseno_superior_libre.php';
include_once __DIR__ . '/02_modulo_estilo_css.php';
$fondo_gif_fs = __DIR__ . '/../imagenes/fondo_gif.gif';
$dayq_fondo_src = null;
if (file_exists($fondo_gif_fs)) {
	$sn = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', (string) $_SERVER['SCRIPT_NAME']) : '';
	$appDir = dirname(dirname($sn));
	if ($appDir === '/' || $appDir === '\\' || $appDir === '.' || $appDir === '') {
		$dayq_fondo_src = '/imagenes/fondo_gif.gif';
	} else {
		$dayq_fondo_src = rtrim($appDir, '/') . '/imagenes/fondo_gif.gif';
	}
}
?>
<link href="../estilo_css/portal_administrativo.css" rel="stylesheet">
</head>
<body id="pageBody" class="dayq-adm-login-page">
<?php include_once __DIR__ . '/../menu/03_menu_navegacion_libre_entrar.php'; ?>
<div class="dayq-adm-login-hero<?php echo $dayq_fondo_src ? '' : ' dayq-adm-login-hero--fallback'; ?>" aria-hidden="true">
	<?php if ($dayq_fondo_src !== null) : ?>
	<img class="dayq-adm-bg-img" src="<?php echo htmlspecialchars($dayq_fondo_src, ENT_QUOTES, 'UTF-8'); ?>" alt="">
	<?php endif; ?>
	<div class="dayq-adm-login-overlay"></div>
</div>
<div class="container-fluid h-100 content">
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="row-fluid">
<div class="span12" id="divMain">
<div class="dayq-adm-login-wrap">
<div class="dayq-adm-panel">
	<div class="dayq-adm-login-brand">
		<img src="../imagenes/logo_admin.png" alt="Portal administrativo" class="dayq-adm-login-logo">
	</div>
	<h1 class="dayq-adm-title">Portal administrativo</h1>
	<form class="dayq-adm-form" method="POST" action="verificacion_administrativo.php" autocomplete="off">
		<?php
		if (!empty($_GET['error'])) {
			$err = (string) $_GET['error'];
			echo '<div class="dayq-adm-alert" role="alert"><span class="dayq-adm-alert__icon" aria-hidden="true"><i class="fa fa-exclamation-circle"></i></span><span class="dayq-adm-alert__text">' . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '</span></div>';
		}
		?>
		<div class="dayq-adm-field">
			<label class="dayq-adm-label" for="adm_cuenta">Usuario</label>
			<div class="dayq-adm-input-wrap">
				<span class="dayq-adm-input-wrap__icon" aria-hidden="true"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control dayq-adm-input" id="adm_cuenta" name="cuenta" placeholder="Ingrese su usuario" required autofocus>
			</div>
		</div>
		<div class="dayq-adm-field">
			<label class="dayq-adm-label" for="adm_pass">Contraseña</label>
			<div class="dayq-adm-input-wrap">
				<span class="dayq-adm-input-wrap__icon" aria-hidden="true"><i class="fa fa-lock"></i></span>
				<input type="password" class="form-control dayq-adm-input" name="contrasena" id="adm_pass" placeholder="Ingrese su contraseña" required>
			</div>
		</div>
		<div class="dayq-adm-field dayq-adm-field--submit">
			<button class="dayq-adm-btn" type="submit" onclick="cifrar()"><i class="fa fa-sign-in" aria-hidden="true"></i><span>Entrar al portal</span></button>
		</div>
	</form>
</div>
</div>
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<br><br><br><br>
<?php include_once __DIR__ . '/04_modulo_footer.php'; ?>
<?php include_once __DIR__ . '/05_modulo_js.php'; ?>
<script src="js/sha1.js"></script>
<script>
function cifrar() {
	var input_pass = document.getElementById('adm_pass');
	input_pass.value = sha1(input_pass.value);
}
</script>
</body>
</html>
