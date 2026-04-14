<?php
include_once __DIR__ . '/../conexiones/conexione.php';
include_once __DIR__ . '/../evitar_mensaje_error/error.php';
require_once __DIR__ . '/../session/funciones_admin_administrativo.php';
date_default_timezone_set('America/Bogota');

$usuario = isset($_POST['cuenta']) ? stripslashes((string) $_POST['cuenta']) : '';
$usuario = strip_tags($usuario);
$clave = isset($_POST['contrasena']) ? (string) $_POST['contrasena'] : '';
$nombre_maquina = gethostname();

$res = conexiones_portal_administrativo($usuario, $clave);

function portal_adm_redirect_error($msg) {
	$q = rawurlencode($msg);
	header('Location: entrar_administrativo.php?error=' . $q);
	exit;
}

if ($res === false) {
	portal_adm_redirect_error('Usuario o contraseña incorrectos, o sin rol de portal administrativo.');
}
if ($res === 'INACTIVO') {
	portal_adm_redirect_error('Usuario inactivo.');
}
if ($res === 'ESPERA_ACTIVACION') {
	portal_adm_redirect_error('Usuario en espera de activación.');
}
if ($res !== true) {
	portal_adm_redirect_error('No se pudo iniciar sesión.');
}

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} else {
	$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0';
}

if ($ip === '127.0.0.1') {
	$ciudad = '0';
	$region = '0';
	$cod_area = '0';
	$cod_dma = '0';
	$nombre_pais = '0';
	$cod_pais = '0';
	$longitud = '0';
	$latitud = '0';
} else {
	include_once __DIR__ . '/class_php/geoplugin.class.php';
	$geoplugin = new geoPlugin();
	$geoplugin->locate();
	$ciudad = (string) $geoplugin->city;
	$region = (string) $geoplugin->region;
	$cod_area = (string) $geoplugin->areaCode;
	$cod_dma = (string) $geoplugin->dmaCode;
	$nombre_pais = (string) $geoplugin->countryName;
	$cod_pais = (string) $geoplugin->countryCode;
	$longitud = (string) $geoplugin->longitude;
	$latitud = (string) $geoplugin->latitude;
}

$navegador = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$fecha_entrada_time = time();
$fecha_entrada = date('Y-m-d H:i:s');
$usuario_sql = mysqli_real_escape_string($conectar, $usuario);

$agregar_registros_sesion = "INSERT INTO tbl15_sesion (usuario, ip, navegador, fecha_entrada_time, ciudad, region, cod_area, cod_dma, 
	nombre_pais, cod_pais, longitud, latitud, fecha_entrada, nombre_maquina)
	VALUES ('$usuario_sql', '$ip', '$navegador', '$fecha_entrada_time', '$ciudad', '$region', '$cod_area', '$cod_dma', '$nombre_pais', 
	'$cod_pais', '$longitud', '$latitud', '$fecha_entrada', '$nombre_maquina')";
mysqli_query($conectar, $agregar_registros_sesion) or die(mysqli_error($conectar));

header('Location: administrativo/index.php');
exit;
