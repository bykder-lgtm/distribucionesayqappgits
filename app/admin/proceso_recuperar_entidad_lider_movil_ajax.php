<?php
include_once("../conexiones/conexione.php");
header('Content-Type: application/json; charset=utf-8');
session_start();

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_administrador = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
$tipo_entidad = isset($_POST['tipo_entidad']) ? $_POST['tipo_entidad'] : 'Entidad';
if ($cod_administrador <= 0) { echo json_encode(['success' => false, 'message' => 'Código de registro no válido']); exit; }
// Restaurar estados activos: cod_estado = 1 y cod_estado_activacion_usuario = 1
$sql = "UPDATE tbl15_administrador SET cod_estado = 1, cod_estado_activacion_usuario = 1 WHERE cod_administrador = '$cod_administrador'";

if (mysqli_query($conectar, $sql)) { echo json_encode(['success' => true, 'message' => $tipo_entidad . ' recuperado correctamente']); } else { echo json_encode(['success' => false, 'message' => 'Error al recuperar el registro: ' . mysqli_error($conectar)]); }
?>
