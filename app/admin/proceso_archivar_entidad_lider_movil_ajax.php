<?php
include_once("../conexiones/conexione.php");
header('Content-Type: application/json; charset=utf-8');
session_start();

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_administrador = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
$tipo_entidad = isset($_POST['tipo_entidad']) ? $_POST['tipo_entidad'] : 'Entidad';
if ($cod_administrador <= 0) { echo json_encode(['success' => false, 'message' => 'Código de registro no válido']); exit; }
// cod_estado_activacion_usuario = 5 (ARCHIVADO) // codigo_estado_activacion_usuario = 3 (Solicitado por el usuario para ARCHIVADO)
$sql = "UPDATE tbl15_administrador SET cod_estado_activacion_usuario = 3 WHERE cod_administrador = '$cod_administrador'";

if (mysqli_query($conectar, $sql)) { echo json_encode(['success' => true, 'message' => $tipo_entidad . ' archivado correctamente']); } else { echo json_encode(['success' => false, 'message' => 'Error al archivar el registro: ' . mysqli_error($conectar)]); }
?>
