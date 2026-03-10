<?php
include_once("../conexiones/conexione.php");
header('Content-Type: application/json; charset=utf-8');
session_start();

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_item = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
$tipo = isset($_POST['tipo_entidad']) ? $_POST['tipo_entidad'] : 'persona';

if ($cod_item <= 0) { echo json_encode(['success' => false, 'message' => 'Código de registro no válido']); exit; }

if ($tipo == 'tienda') {
    $sql = "UPDATE tbl15_tienda SET cod_estado = 1 WHERE cod_tienda = '$cod_item'";
} else {
    // Restaurar estados activos personas: cod_estado = 1 y cod_estado_activacion_usuario = 1
    $sql = "UPDATE tbl15_administrador SET cod_estado = 1, cod_estado_activacion_usuario = 1 WHERE cod_administrador = '$cod_item'";
}
if (mysqli_query($conectar, $sql)) {  echo json_encode(['success' => true, 'message' => ($tipo == 'tienda' ? 'Tienda' : 'Persona') . ' recuperada correctamente']); } else { echo json_encode(['success' => false, 'message' => 'Error al recuperar el registro: ' . mysqli_error($conectar)]); }
?>
