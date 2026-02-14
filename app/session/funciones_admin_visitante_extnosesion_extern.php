<?php 
date_default_timezone_set("America/Bogota");
include_once('app/conexiones/conexione_sesion.php');
include_once('app/evitar_mensaje_error/error_extern.php');
//include_once('app/admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('app/admin/detectar_tipo_dispositivo.php');
session_set_cookie_params(60*60*24*2); //la sesion dura 2 dias
session_start();

$sql_info_factura_venta_carrito_compra = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_info_factura_venta_carrito_compra WHERE (nombre_estado_factura = 'ABIERTA')";
$resultado_info_factura_venta_carrito_compra = mysqli_query($conectar2, $sql_info_factura_venta_carrito_compra) or die(mysqli_error($conectar2));
$info_factura_venta_carrito_compra = mysqli_fetch_assoc($resultado_info_factura_venta_carrito_compra);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos2' AND TABLE_NAME = 'tbl15_sesion'";
$exec_autoincremento_sesion = mysqli_query($conectar2, $sql_autoincremento_sesion) or die(mysqli_error($conectar2));
$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
$cod_sesion = $datos_autoincremento_sesion['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_mesa                              = 1;
$cod_caja_virtual                      = $info_factura_venta_carrito_compra['cod_caja_virtual'] + 1;
$cod_base_caja                         = intval($cod_mesa);
$cuenta                                = rand(1000, 9999).rand(1000, 9999).$cod_sesion;
$cod_seguridad_sec                     = 0;
$cod_administrador_sec                 = 0;
$cod_tipo_historia_clinica_sec         = 0;
$usuario                               = $cuenta;
//$cod_caja_virtual                      = intval($_GET['cod_mesa']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$randomize1_pos4_ini               = rand(1000, 9999);
$randomize1_pos4_fin               = rand(1000, 9999);
$cantidad_digito1                  = strlen($cod_seguridad_sec);
$codif_cod_seguridad               = $cantidad_digito1.$randomize1_pos4_ini.$cod_seguridad_sec.$randomize1_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
$randomize2_pos4_ini               = rand(1000, 9999);
$randomize2_pos4_fin               = rand(1000, 9999);
$cantidad_digito2                  = strlen($cod_administrador_sec);
$codif2                            = $cantidad_digito2.$randomize2_pos4_ini.$cod_administrador_sec.$randomize2_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
$randomize3_pos4_ini               = rand(1000, 9999);
$randomize3_pos4_fin               = rand(1000, 9999);
$cantidad_digito3                  = strlen($cod_sesion);
$codif3                            = $cantidad_digito3.$randomize3_pos4_ini.$cod_sesion.$randomize3_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
$randomize4_pos4_ini               = rand(1000, 9999);
$randomize4_pos4_fin               = rand(1000, 9999);
$cantidad_digito4                  = strlen($cod_tipo_historia_clinica_sec);
$codif4                            = $cantidad_digito4.$randomize4_pos4_ini.$cod_tipo_historia_clinica_sec.$randomize4_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
$codif_cod_seguridad_redondeo15    = str_pad($codif_cod_seguridad, 15, $randomize1_pos4_ini, STR_PAD_RIGHT);
$cod_administrador_codif           = str_pad($codif2, 15, $randomize2_pos4_ini, STR_PAD_RIGHT);
$tokn_codif                        = str_pad($codif3, 15, $randomize3_pos4_ini, STR_PAD_RIGHT);
$cod_tipo_historia_clinica_codif   = str_pad($codif4, 15, $randomize4_pos4_ini, STR_PAD_RIGHT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_SESSION["usuario_cryp"])) {
	//header("Location: $pagina_local"); 
} else {
	$_SESSION['cod_administrador']                = 0;
	$_SESSION['usuario']                          = $cuenta;
	$_SESSION['cuenta_actual']                    = $cuenta;
	$_SESSION['usuario_cryp']                     = $cuenta;
	$_SESSION['cs_cryp']                          = 0;
	$_SESSION['ca_cryp']                          = 0;
	$_SESSION['tokn_cryp']                        = 0;
	$_SESSION['pag_redirec_sesion_cryp']          = 0;
	$_SESSION['cod_tipo_historia_clinica_cryp']   = 0;
	$_SESSION['nombres_cryp']                     = "visitante";
	$_SESSION['apellidos_cryp']                   = "ext";
	$_SESSION['nombre_sexo_cryp']                 = 0;
	$_SESSION['url_img_firma_sesion']             = '';
	$_SESSION['url_img_foto_sesion']              = '';
	$_SESSION['tipo_dispositivo']                 = $tipo_dispositivo_encontrado;
	$_SESSION['cod_cliente_sesion']               = '';
	$_SESSION['cod_base_caja']                    = $cod_base_caja;
	$_SESSION['cod_seguridad']                    = 0;
	$_SESSION['cod_caja_virtual']                 = $cod_caja_virtual;
	$_SESSION['cod_sesion']                       = $cod_sesion;
	$_SESSION['token']                            = sha1(uniqid(mt_rand(), true));
	$_SESSION['estilo_css']                       = '';
	$_SESSION['tipo_usuario']                     = 'visitante';
	$_SESSION['tipo_menu']                        = 'usuario';
	$_SESSION['vendedor_codifcryp']               = '';
	$_SESSION['inicio_sesion']                    = 'NO';
	$_SESSION['pagina_salir_visitante']           = '../admin/iniciar_sesion_visitante.php';

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
		include_once('app/admin/class_php/geoplugin.class.php');

		$geoplugin = new geoPlugin();
		$geoplugin->locate();
		//$ip                        = {$geoplugin->ip};
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

	$agregar_registros_sesion = "INSERT INTO tbl15_sesion (cod_sesion, usuario, ip, navegador, fecha_entrada_time, ciudad, region, cod_area, cod_dma, 
	nombre_pais, cod_pais, longitud, latitud, fecha_entrada)
	VALUES ('$cod_sesion', '$usuario', '$ip', '$navegador', '$fecha_entrada_time', '$ciudad', '$region', '$cod_area', '$cod_dma', '$nombre_pais', 
	'$cod_pais', '$longitud', '$latitud', '$fecha_entrada')";
	$resultado_sql1 = mysqli_query($conectar, $agregar_registros_sesion) or die(mysqli_error($conectar));
	//header("Location:../admin/nosotros_visitante_extnosesion.php"); 
}

function verificar_usuario() {
	header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	session_set_cookie_params(60*60*24*2); //la sesion dura 2 dias
	if (isset($_SESSION["usuario_cryp"])) {
		return true;
	} else {
		return false;
	}
}
?>