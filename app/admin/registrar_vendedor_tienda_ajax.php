<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador_sesion                                           = ($_SESSION['cod_administrador']);
$retorno_array                                                      = array();
$respuesta_ajax                                                     = array();
$url_pag_redirec_ini_sesion                                         = '../app/';
$cod_caja_virtual                                                   = 1;
$cod_caja                                                           = 1;
$nombre_maquina                                                     = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$cod_tipo_tercero                                                   = "2"; // Vendedor
$nombre_tipo_tercero                                                = 'VENDEDOR';
$nombre_tipo_cliente                                                = "PERSONA_NATURAL";
$nombre_tipo_regimen                                                = "SIMPLE";
$nombre_tipo_impuesto                                               = "NO_RESPONSABLE_DE_IVA";
$nombre_tipo_identificacion                                         = "CC";
$cod_seguridad                                                      = "2"; // Vendedor
$cod_estado_activacion_usuario                                      = "1"; // Activo
$fecha                                                              = date("Y-m-d");
$fecha_hora                                                         = date("H:i:s");
$creador                                                            = $cuenta_actual;
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['identificacion_tercero'])) {
	$identificacion_tercero                                         = addslashes($_POST['identificacion_tercero']);
	$nombre1_tercero_post                                           = isset($_POST['nombre1_tercero']) ? trim(addslashes($_POST['nombre1_tercero'])) : '';
	$apellido1_tercero_post                                         = isset($_POST['apellido1_tercero']) ? trim(addslashes($_POST['apellido1_tercero'])) : '';
	$nombres_apellidos_post                                         = isset($_POST['nombres_apellidos_tercero']) ? trim(addslashes($_POST['nombres_apellidos_tercero'])) : '';
	// Si se enviaron nombre y apellido por separado, construir nombres_apellidos_tercero
	if (!empty($nombre1_tercero_post)) {
	    $nombre1_tercero = $nombre1_tercero_post;
	    $apellido1_tercero = $apellido1_tercero_post;
	    $nombres_apellidos_tercero = trim($nombre1_tercero . ' ' . $apellido1_tercero);
	} else if (!empty($nombres_apellidos_post)) {
	    $nombre1_tercero = $nombres_apellidos_post;
	    $apellido1_tercero = '';
	    $nombres_apellidos_tercero = $nombres_apellidos_post;
	} else {
	    echo json_encode(array('success' => false, 'message' => 'El nombre es obligatorio')); exit;
	}
	$telefono1_tercero                                              = trim(addslashes($_POST['telefono1_tercero']));
	$correo_tercero                                                 = trim(addslashes($_POST['correo_tercero']));
	$direccion_tercero                                              = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $cod_tienda                                                     = intval($_POST['cod_tienda']);
    
    $cedula                                                         = $identificacion_tercero;
    $nombres                                                        = $nombre1_tercero;
    $apellidos                                                      = $apellido1_tercero;
    $correo                                                         = $correo_tercero;
    $telefono                                                       = $telefono1_tercero;
    $contrasena                                                     = sha1($identificacion_tercero); // Contraseña inicial encriptada
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_administrador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
    $exec_autoincremento_administrador = mysqli_query($conectar, $sql_autoincremento_administrador) or die(mysqli_error($conectar));
    $datos_autoincremento_administrador = mysqli_fetch_assoc($exec_autoincremento_administrador);

    $cod_administrador                                              = $datos_autoincremento_administrador['AUTO_INCREMENT'];
    $cuenta                                                         = $identificacion_tercero.'-'.$cod_administrador;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_vendedor = "SELECT cod_administrador FROM tbl15_administrador WHERE identificacion_tercero = '".($identificacion_tercero)."' AND cod_seguridad = '2' AND cod_vendedor = '$cod_tienda'";
	$consultar_dato_vendedor = mysqli_query($conectar, $sql_dato_vendedor) or die(mysqli_error($conectar));
	$info_dato_vendedor = mysqli_fetch_assoc($consultar_dato_vendedor);
	$existe_dato_vendedor = mysqli_num_rows(@$consultar_dato_vendedor);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_matriz_tienda = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '".($cod_tienda)."'";
	$consultar_matriz_tienda = mysqli_query($conectar, $sql_matriz_tienda) or die(mysqli_error($conectar));
	$info_matriz_tienda = mysqli_fetch_assoc($consultar_matriz_tienda);

	$cod_aliado_estrategico                                         = $info_matriz_tienda['cod_aliado_estrategico'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_matriz_asesor = "SELECT cod_lider, cod_coordinador, cod_asesor FROM tbl15_administrador WHERE cod_administrador = '".($cod_aliado_estrategico)."'";
	$consultar_matriz_asesor = mysqli_query($conectar, $sql_matriz_asesor) or die(mysqli_error($conectar));
	$info_matriz_asesor = mysqli_fetch_assoc($consultar_matriz_asesor);

	$cod_lider                                                      = isset($info_matriz_asesor['cod_lider']) ? $info_matriz_asesor['cod_lider'] : 0;
    $cod_coordinador                                                = isset($info_matriz_asesor['cod_coordinador']) ? $info_matriz_asesor['cod_coordinador'] : 0;
    $cod_asesor                                                     = isset($info_matriz_asesor['cod_asesor']) ? $info_matriz_asesor['cod_asesor'] : 0;
	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_vendedor > 0) {
        // El vendedor ya existe, no se registra nuevamente
        $afectado = "EXISTE";
        $cod_administrador = intval($info_dato_vendedor['cod_administrador']);
    } else {
		$sql_data = "INSERT INTO tbl15_administrador (identificacion_tercero, nombre1_tercero, apellido1_tercero, telefono1_tercero, correo_tercero, direccion_tercero, 
        nombres_apellidos_tercero, cod_tipo_tercero, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, nombre_tipo_identificacion, 
        cod_seguridad, cod_estado_activacion_usuario, fecha, fecha_hora, creador, cedula, nombres, apellidos, correo, telefono, cuenta, contrasena, 
        cod_vendedor, url_pag_redirec_ini_sesion, cod_caja_virtual, cod_caja, nombre_maquina, cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico) 
		VALUES ('$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'), '$telefono1_tercero', '$correo_tercero', '$direccion_tercero', 
        UPPER('$nombres_apellidos_tercero'), '$cod_tipo_tercero', '$nombre_tipo_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$nombre_tipo_identificacion', 
        '$cod_seguridad', '$cod_estado_activacion_usuario', '$fecha', '$fecha_hora', '$creador', '$cedula', UPPER('$nombres'), UPPER('$apellidos'), '$correo', '$telefono', '$cuenta', '$contrasena', 
        '$cod_tienda', '$url_pag_redirec_ini_sesion', '$cod_caja_virtual', '$cod_caja', '$nombre_maquina', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_aliado_estrategico')";
		$exec_data = mysqli_query($conectar, $sql_data);
        if ($exec_data && mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; $cod_administrador = mysqli_insert_id($conectar); } else { $afectado = "NO"; $error_mysql = mysqli_error($conectar); }
    }
	// Limpiar cualquier output buffer antes de enviar JSON
	if (ob_get_length()) ob_clean();
	header('Content-Type: application/json');
	$respuesta_ajax['success']                     = ($afectado == "SI");
	$respuesta_ajax['cod_administrador']           = $cod_administrador;
    
    if ($afectado == "SI") {
        $respuesta_ajax['message']                 = 'Vendedor registrado correctamente. Credenciales: Usuario: ' . $cuenta . ' / Contraseña: ' . $identificacion_tercero;
    } elseif ($afectado == "EXISTE") {
        $respuesta_ajax['message']                 = 'El vendedor ya existe en esta tienda.';
    } else {
        $respuesta_ajax['message']                 = 'Error al registrar el vendedor.';
        $respuesta_ajax['error']                   = isset($error_mysql) ? $error_mysql : 'Error desconocido';
    }
	echo json_encode($respuesta_ajax);
}
?>
