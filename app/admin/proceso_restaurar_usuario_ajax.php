<?php
include_once("../conexiones/conexione.php");
header('Content-Type: application/json; charset=utf-8');
session_start();

if (!isset($_SESSION['cod_administrador'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']);
    exit;
}

$cod_administrador = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;

if ($cod_administrador <= 0) {
    echo json_encode(['success' => false, 'message' => 'Código de administrador no válido']);
    exit;
}

// cod_estado = 1 (ACTIVO)
// cod_estado_activacion_usuario = 1 (ACTIVO)
$sql = "UPDATE tbl15_administrador SET cod_estado = '1', cod_estado_activacion_usuario = '1' WHERE cod_administrador = '$cod_administrador'";

if (mysqli_query($conectar, $sql)) {
    echo json_encode(['success' => true, 'message' => 'Usuario restaurado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al restaurar el usuario: ' . mysqli_error($conectar)]);
}
?>
