<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");
// Obtener parámetros
$nombre_banco_cuenta = isset($_POST['nombre_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_banco_cuenta'])) : '';
$numero_banco_cuenta = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['numero_banco_cuenta'])) : '';
$nombre_titular_cuenta = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_titular_cuenta'])) : '';
$identificacion_titular_cuenta = isset($_POST['identificacion_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_titular_cuenta'])) : '';
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
$cod_estado = 1;

$sql_autoincremento_banco_cuenta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_banco_cuenta'";
$exec_autoincremento_banco_cuenta = mysqli_query($conectar, $sql_autoincremento_banco_cuenta) or die(mysqli_error($conectar));
$datos_autoincremento_banco_cuenta = mysqli_fetch_assoc($exec_autoincremento_banco_cuenta);

$cod_banco_cuenta                             = $datos_autoincremento_banco_cuenta['AUTO_INCREMENT'];

$sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
$existe_info_factura_venta = mysqli_num_rows($consulta_info_factura_venta);
$info_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$cod_tienda                                    = $info_info_factura_venta['cod_tienda'];
$cod_aliado_estrategico                        = $info_info_factura_venta['cod_administrador_aliado_estrategico'];
// Validar campos requeridos
if (empty($nombre_banco_cuenta) || empty($numero_banco_cuenta)) { echo json_encode(array('success' => false, 'message' => 'Los campos Nombre del Banco y Número de Cuenta son obligatorios' )); exit; }
// Insertar nueva cuenta bancaria
$sql_info_factura_venta = sprintf("UPDATE tbl15_info_factura_venta SET cod_banco_cuenta = '$cod_banco_cuenta' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
$resultado_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));

$sql = "INSERT INTO tbl15_banco_cuenta (nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta, cod_tienda, cod_aliado_estrategico, cod_estado) VALUES (UPPER(?), ?, UPPER(?), ?, ?, ?, ?)";
$stmt = mysqli_prepare($conectar, $sql);
mysqli_stmt_bind_param($stmt, "sissiii", $nombre_banco_cuenta, $numero_banco_cuenta, $nombre_titular_cuenta, $identificacion_titular_cuenta, $cod_tienda, $cod_aliado_estrategico, $cod_estado);
if (mysqli_stmt_execute($stmt)) {
    $cod_banco_cuenta = mysqli_insert_id($conectar);
    
    echo json_encode(array('success' => true, 'message' => 'Cuenta bancaria registrada correctamente', 'cod_banco_cuenta' => $cod_banco_cuenta, 'cod_info_factura_venta' => $cod_info_factura_venta));
} else {
    echo json_encode(array('success' => false, 'message' => 'Error al registrar la cuenta bancaria: ' . mysqli_error($conectar)));
}
mysqli_stmt_close($stmt);
mysqli_close($conectar);
?>
