<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_producto_codifcryp'])) {

    $cod_producto_codifcryp                      = ($_POST['cod_producto_codifcryp']);
    $cod_producto_codif                          = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                                = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));
    $valor_credito                               = intval($_POST['valor_credito']);
    $cod_entidad_crediticia                      = intval($_POST['cod_entidad_crediticia']);
    $cod_tipo_cobro                              = intval($_POST['cod_tipo_cobro']);
    $cod_meses_credito                           = intval($_POST['cod_meses_credito']);
    $nombre_tipo_tercero                         = addslashes($_POST['nombre_tipo_tercero']);
    $nombre_tipo_tercero_modulo_creacion         = addslashes($_POST['nombre_tipo_tercero_modulo_creacion']);
    $cod_administrador                           = intval($_POST['cod_administrador']);
    $cod_seguridad                               = intval($_POST['cod_seguridad']);
	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad == '25') { // CLIENTE
    	$pagina_redirect = "../admin/lista_cliente_siscredito_visitante_intern.php";
    } elseif ($cod_seguridad == '23') { // ALIADO ESTRATEGICO
    	$pagina_redirect = "../admin/lista_aliado_estrategico_siscredito_visitante_intern.php";
    } else {
    	$pagina_redirect = "../admin/lista_cliente_siscredito_visitante_intern.php";
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	if (isset($_POST['nombre_tipo_identificacion'])) { $nombre_tipo_identificacion = addslashes($_POST['nombre_tipo_identificacion']); } else { $nombre_tipo_identificacion = 'CC'; }
	if (isset($_POST['identificacion_tercero'])) { $identificacion_tercero = addslashes($_POST['identificacion_tercero']); } else { $identificacion_tercero = ''; }
	if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes(trim($_POST['nombre1_tercero'])); } else { $nombre1_tercero = ''; }
	if (isset($_POST['nombre2_tercero'])) { $nombre2_tercero = addslashes(trim($_POST['nombre2_tercero'])); } else { $nombre2_tercero = ''; }
	if (isset($_POST['apellido1_tercero'])) { $apellido1_tercero = addslashes(trim($_POST['apellido1_tercero'])); } else { $apellido1_tercero = ''; }
	if (isset($_POST['apellido2_tercero'])) { $apellido2_tercero = addslashes(trim($_POST['apellido2_tercero'])); } else { $apellido2_tercero = ''; }
	if (isset($_POST['fecha_nac_tercero'])) { $fecha_nac_tercero = addslashes($_POST['fecha_nac_tercero']); } else { $fecha_nac_tercero = ''; }
	if (isset($_POST['fecha_expedicion_tercero'])) { $fecha_expedicion_tercero = addslashes($_POST['fecha_expedicion_tercero']); } else { $fecha_expedicion_tercero = ''; }
	if (isset($_POST['telefono1_tercero'])) { $telefono1_tercero = addslashes($_POST['telefono1_tercero']); } else { $telefono1_tercero = ''; }
	if (isset($_POST['correo_tercero'])) { $correo_tercero = addslashes($_POST['correo_tercero']); } else { $correo_tercero = ''; }
	if (isset($_POST['direccion_tercero'])) { $direccion_tercero = addslashes($_POST['direccion_tercero']); } else { $direccion_tercero = ''; }
	if (isset($_POST['nombre_estado_civil'])) { $nombre_estado_civil = addslashes($_POST['nombre_estado_civil']); } else { $nombre_estado_civil = ''; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$nombre_actividad_ecoemp                                        = gethostname();
	$fecha_creacion                                                 = date("Y-m-d");
    $fecha_expiracion_cupon_descuento                               = date("H:i:s");
    $direccion_contacto1                                            = $_SERVER["REMOTE_ADDR"];
	$tel_contacto1                                                  = $cuenta_actual;
	$cod_estado_cliente                                             = 1;
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_tercero                      = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
    $cod_tercero_codif                = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
    $cod_tercero_codifcryp            = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);

	$sql_data = "INSERT INTO tbl15_tercero (cod_tercero, nombre_tipo_tercero, nombre_tipo_tercero_modulo_creacion, cod_producto, valor_credito, cod_entidad_crediticia, cod_tipo_cobro, cod_meses_credito, 
	nombre_tipo_identificacion, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, 
	fecha_nac_tercero, fecha_expedicion_tercero, telefono1_tercero, correo_tercero, direccion_tercero, nombre_estado_civil, fecha_creacion, 
	cod_administrador, cod_estado_cliente, fecha_expiracion_cupon_descuento, nombre_actividad_ecoemp, direccion_contacto1, tel_contacto1, cod_seguridad, cod_intermediario_credito) 
	VALUES ('$cod_tercero', '$nombre_tipo_tercero', '$nombre_tipo_tercero_modulo_creacion', '$cod_producto', '$valor_credito', '$cod_entidad_crediticia', '$cod_tipo_cobro', '$cod_meses_credito', 
	'$nombre_tipo_identificacion', '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), 
	'$fecha_nac_tercero', '$fecha_expedicion_tercero', '$telefono1_tercero', '$correo_tercero', '$direccion_tercero', '$nombre_estado_civil', '$fecha_creacion', 
	'$cod_administrador', '$cod_estado_cliente', '$fecha_expiracion_cupon_descuento', '$nombre_actividad_ecoemp', '$direccion_contacto1', '$tel_contacto1', '$cod_seguridad', '1')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$url_redir = "../admin/lista_aliado_estrategico_siscredito_visitante_intern.php?cod_tercero_codifcryp=".$cod_tercero_codifcryp;
	header("Location: $url_redir");
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
}
?>