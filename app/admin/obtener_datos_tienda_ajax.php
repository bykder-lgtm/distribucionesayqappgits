<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
header('Content-Type: application/json');
if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit(); }

$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
if ($cod_tienda <= 0) { echo json_encode(['success' => false, 'mensaje' => 'Código de tienda inválido']); exit(); }
// Consultar datos de la tienda
$sql_tienda = "SELECT t.*, b.nombre_banco_cuenta, b.numero_banco_cuenta, b.nombre_titular_cuenta FROM tbl15_tienda t LEFT JOIN tbl14_banco_cuenta b ON t.cod_banco_cuenta = b.cod_banco_cuenta WHERE t.cod_tienda = '$cod_tienda'";
$exec_tienda = mysqli_query($conectar, $sql_tienda) or die(mysqli_error($conectar));

if (mysqli_num_rows($exec_tienda) > 0) {
    $tienda = mysqli_fetch_assoc($exec_tienda);
    echo json_encode(['success' => true, 'tienda' => $tienda]);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Tienda no encontrada']);
}
?>
