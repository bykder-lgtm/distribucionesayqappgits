<?php
include_once("../conexiones/conexione.php");
header('Content-Type: application/json; charset=utf-8');
session_start();

if (!isset($_SESSION['cod_administrador'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']);
    exit;
}

$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;

if ($cod_tienda <= 0) {
    echo json_encode(['success' => false, 'message' => 'Código de tienda no válido']);
    exit;
}

// cod_estado = 0 (Inactivo / Archivado para tiendas)
$sql = "UPDATE tbl15_tienda SET cod_estado = 0 WHERE cod_tienda = '$cod_tienda'";

if (mysqli_query($conectar, $sql)) {
    echo json_encode(['success' => true, 'message' => 'Tienda archivada correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al archivar la tienda: ' . mysqli_error($conectar)]);
}
?>
