<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");
$fecha_creacion = date("Y-m-d H:i:s");

try {
    // Recibir datos del POST
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : '';
    $cedula = isset($_POST['cedula']) ? mysqli_real_escape_string($conectar, trim($_POST['cedula'])) : '';
    $nombres = mysqli_real_escape_string($conectar, trim($_POST['nombres']));
    $apellidos = mysqli_real_escape_string($conectar, trim($_POST['apellidos']));

    $sql_autoincremento_vendedor = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_vendedor'";
    $exec_autoincremento_vendedor = mysqli_query($conectar, $sql_autoincremento_vendedor) or die(mysqli_error($conectar));
    $datos_autoincremento_vendedor = mysqli_fetch_assoc($exec_autoincremento_vendedor);

    $cod_vendedor                                      = $datos_autoincremento_vendedor['AUTO_INCREMENT'];

    $sql_autoincremento_administrador_vendedor = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
    $exec_autoincremento_administrador_vendedor = mysqli_query($conectar, $sql_autoincremento_administrador_vendedor) or die(mysqli_error($conectar));
    $datos_autoincremento_administrador_vendedor = mysqli_fetch_assoc($exec_autoincremento_administrador_vendedor);

    $cod_administrador                             = $datos_autoincremento_administrador_vendedor['AUTO_INCREMENT'];

	$identificacion_tercero                        = $cedula;
	$nombre1_tercero                               = $nombres;
	$apellido1_tercero                             = $apellidos;
	$cuenta                                        = trim($nombres.$cod_administrador);
	$nombre_tipo_identificacion                    = 'CC';

    $sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $existe_info_factura_venta = mysqli_num_rows($consulta_info_factura_venta);
    $info_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_tienda                                    = $info_info_factura_venta['cod_tienda'];
    $cod_aliado_estrategico                        = $info_info_factura_venta['cod_administrador_aliado_estrategico'];
    $cod_seguridad                                 = '2';
/*
	$sql_data = "INSERT INTO tbl15_vendedor (cod_vendedor, cedula, nombres, apellidos, identificacion_tercero, nombre1_tercero, apellido1_tercero, 
	nombre_tipo_identificacion, cuenta, cod_tienda, cod_aliado_estrategico) 
	VALUES ('$cod_vendedor', '$cedula', UPPER('$nombres'), UPPER('$apellidos'), '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'), 
	'$nombre_tipo_identificacion', '$cuenta', '$cod_tienda', '$cod_aliado_estrategico')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
*/
	$sql_data = "INSERT INTO tbl15_administrador (cod_administrador, cedula, nombres, apellidos, identificacion_tercero, nombre1_tercero, apellido1_tercero, 
	nombre_tipo_identificacion, cuenta, cod_tienda, cod_aliado_estrategico, cod_seguridad, fecha_creacion, url_pag_redirec_ini_sesion, cod_estado) 
	VALUES ('$cod_administrador', '$cedula', UPPER('$nombres'), UPPER('$apellidos'), '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'), 
	'$nombre_tipo_identificacion', '$cuenta', '$cod_tienda', '$cod_aliado_estrategico', '$cod_seguridad', '$fecha_creacion', '../admin/dashboard_vendedor_movil.php', '1')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_info_factura_venta = sprintf("UPDATE tbl15_info_factura_venta SET cod_vendedor = '$cod_administrador' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
	$resultado_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));

    // Validar campos obligatorios
    if (empty($nombres) || empty($apellidos) || empty($cedula)) { throw new Exception('Los nombres, apellidos y cédula son obligatorios'); }
    // Preparar la consulta de inserción
    $sql_insertar = "INSERT INTO tbl15_vendedor (cedula, nombres, apellidos, identificacion_tercero, nombre1_tercero, apellido1_tercero, nombre_tipo_identificacion, cuenta, cod_aliado_estrategico, fecha_creacion) 
    VALUES (?, UPPER(?), UPPER(?), ?, UPPER(?), UPPER(?), ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conectar, $sql_insertar);
    if (!$stmt) { throw new Exception('Error al preparar la consulta: ' . mysqli_error($conectar)); }
    mysqli_stmt_bind_param($stmt, "ississssis", $cedula, $nombres, $apellidos, $identificacion_tercero, $nombre1_tercero, $apellido1_tercero, $nombre_tipo_identificacion, $cuenta, $cod_aliado_estrategico, $fecha_creacion);
    if (!mysqli_stmt_execute($stmt)) { throw new Exception('Error al registrar el vendedor: ' . mysqli_stmt_error($stmt)); }
    // Obtener el ID del vendedor recién insertado
    $cod_vendedor_nuevo = mysqli_insert_id($conectar);
    mysqli_stmt_close($stmt);
    
    if ($cod_vendedor_nuevo > 0) { echo json_encode(array('success' => true, 'message' => 'Vendedor registrado correctamente', 'cod_vendedor' => $cod_vendedor_nuevo)); } else { throw new Exception('No se pudo obtener el código del vendedor registrado'); }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'message' => $e->getMessage() ));
}
mysqli_close($conectar);
?>
