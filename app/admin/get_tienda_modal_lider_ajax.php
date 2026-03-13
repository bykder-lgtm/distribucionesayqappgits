<?php
header('Content-Type: application/json; charset=UTF-8');
session_start();
include_once('../conexiones/conexione.php');
// Validar sesión
if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
$cod_administrador = $_SESSION['cod_administrador'];
$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
if ($cod_tienda <= 0) { echo json_encode(['success' => false, 'message' => 'ID de tienda inválido']); exit; }
// Asegurar codificación UTF-8
mysqli_set_charset($conectar, "utf8mb4");
// Consultar datos de la tienda y su jerarquía desde el aliado
$sql = "SELECT t.*, a.cod_lider, a.cod_coordinador, a.cod_asesor FROM tbl15_tienda t LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador WHERE t.cod_tienda = ?";
$stmt = mysqli_prepare($conectar, $sql);
mysqli_stmt_bind_param($stmt, "i", $cod_tienda);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($row = mysqli_fetch_assoc($result)) {
    // Respuesta exitosa - La codificación UTF-8 se maneja con mysqli_set_charset
    echo json_encode(['success' => true, 'tienda' => $row], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['success' => false, 'message' => 'Tienda no encontrada o permiso denegado']);
}
?>
