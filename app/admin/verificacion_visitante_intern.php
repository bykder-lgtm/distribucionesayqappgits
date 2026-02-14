<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
date_default_timezone_set("America/Bogota");

$usuario             = stripslashes($_POST['cuenta']);
$usuario             = strip_tags($usuario);
$clave               = addslashes($_POST['contrasena']);
$pagina              = addslashes($_POST['pagina']);

$cod_mesa            = 0;

$resultado_conexion = conexiones($usuario, $clave);

// Verificar el estado de activación del usuario
if ($resultado_conexion === 'INACTIVO') {
	$error = 'Su cuenta de usuario se encuentra INACTIVA. No tiene permiso para iniciar sesión. Por favor contacte al administrador del sistema';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0.1; <?php echo $pagina ?>?error=<?php echo urlencode($error) ?>">
<?php
	exit;
}

if ($resultado_conexion === 'ESPERA_ACTIVACION') {
	// Usuario en espera de activación - redirigir a cambio de contraseña

	if ($_SERVER) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; } 
		elseif (isset($_SERVER["HTTP_CLIENT_IP"])) { $ip = $_SERVER["HTTP_CLIENT_IP"]; } 
		else { $ip = $_SERVER["REMOTE_ADDR"]; }
	} else {  
		if (getenv('HTTP_X_FORWARDED_FOR') ) { $ip = getenv('HTTP_X_FORWARDED_FOR'); } 
		elseif (getenv('HTTP_CLIENT_IP') ) { $ip = getenv('HTTP_CLIENT_IP'); } 
		else { $ip = getenv('REMOTE_ADDR'); }  
	} 

	if ($ip == '127.0.0.1') {
		$ciudad                      = "0";
		$region                      = "0";
		$cod_area                    = "0";
		$cod_dma                     = "0";
		$nombre_pais                 = "0";
		$cod_pais                    = "0";
		$longitud                    = "0";
		$latitud                     = "0";
	} else {
		include_once('../admin/class_php/geoplugin.class.php');

		$geoplugin = new geoPlugin();
		$geoplugin->locate();
		$ciudad                      = "{$geoplugin->city}";
		$region                      = "{$geoplugin->region}";
		$cod_area                    = "{$geoplugin->areaCode}";
		$cod_dma                     = "{$geoplugin->dmaCode}";
		$nombre_pais                 = "{$geoplugin->countryName}";
		$cod_pais                    = "{$geoplugin->countryCode}";
		$longitud                    = "{$geoplugin->longitude}";
		$latitud                     = "{$geoplugin->latitude}";
	}

	$navegador                   = $_SERVER['HTTP_USER_AGENT'];
	$fecha_entrada_time          = time();
	$fecha_entrada               = date("Y-m-d H:i:s");

	// Redirigir a página de cambio de contraseña para usuarios en espera de activación
	$pag_redirec_sesion_ini      = "../admin/cambiar_contrasena_activacion.php";

	$agregar_registros_sesion = "INSERT INTO tbl15_sesion (usuario, ip, navegador, fecha_entrada_time, ciudad, region, cod_area, cod_dma, 
	nombre_pais, cod_pais, longitud, latitud, fecha_entrada)
	VALUES ('$usuario', '$ip', '$navegador', '$fecha_entrada_time', '$ciudad', '$region', '$cod_area', '$cod_dma', '$nombre_pais', 
	'$cod_pais', '$longitud', '$latitud', '$fecha_entrada')";
	$resultado_sql1 = mysqli_query($conectar, $agregar_registros_sesion) or die(mysqli_error($conectar));

	header("Location:$pag_redirec_sesion_ini");
	exit;
}

if ($resultado_conexion === true) {
	// Usuario ACTIVO - permitir inicio de sesión normal

	if ($_SERVER) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; } 
		elseif (isset($_SERVER["HTTP_CLIENT_IP"])) { $ip = $_SERVER["HTTP_CLIENT_IP"]; } 
		else { $ip = $_SERVER["REMOTE_ADDR"]; }
	} else {  
		if (getenv('HTTP_X_FORWARDED_FOR') ) { $ip = getenv('HTTP_X_FORWARDED_FOR'); } 
		elseif (getenv('HTTP_CLIENT_IP') ) { $ip = getenv('HTTP_CLIENT_IP'); } 
		else { $ip = getenv('REMOTE_ADDR'); }  
	} 

	if ($ip == '127.0.0.1') {
		$ciudad                      = "0";
		$region                      = "0";
		$cod_area                    = "0";
		$cod_dma                     = "0";
		$nombre_pais                 = "0";
		$cod_pais                    = "0";
		$longitud                    = "0";
		$latitud                     = "0";
	} else {
		include_once('../admin/class_php/geoplugin.class.php');

		$geoplugin = new geoPlugin();
		$geoplugin->locate();
		$ciudad                      = "{$geoplugin->city}";
		$region                      = "{$geoplugin->region}";
		$cod_area                    = "{$geoplugin->areaCode}";
		$cod_dma                     = "{$geoplugin->dmaCode}";
		$nombre_pais                 = "{$geoplugin->countryName}";
		$cod_pais                    = "{$geoplugin->countryCode}";
		$longitud                    = "{$geoplugin->longitude}";
		$latitud                     = "{$geoplugin->latitude}";
	}

	$navegador                   = $_SERVER['HTTP_USER_AGENT'];
	$fecha_entrada_time          = time();
	$fecha_entrada               = date("Y-m-d H:i:s");

	$pag_redirec_sesion_ini      = "../admin/bienvenida_animacion_flexitech_movil.php";

	$agregar_registros_sesion = "INSERT INTO tbl15_sesion (usuario, ip, navegador, fecha_entrada_time, ciudad, region, cod_area, cod_dma, 
	nombre_pais, cod_pais, longitud, latitud, fecha_entrada)
	VALUES ('$usuario', '$ip', '$navegador', '$fecha_entrada_time', '$ciudad', '$region', '$cod_area', '$cod_dma', '$nombre_pais', 
	'$cod_pais', '$longitud', '$latitud', '$fecha_entrada')";
	$resultado_sql1 = mysqli_query($conectar, $agregar_registros_sesion) or die(mysqli_error($conectar));

	header("Location:$pag_redirec_sesion_ini");
	exit;
} else {
	// Usuario o contraseña incorrectos
	$error = 'El nombre de usuario o la contraseña no son correctos';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0.1; <?php echo $pagina ?>?error=<?php echo $error ?>">
<?php
}
?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->