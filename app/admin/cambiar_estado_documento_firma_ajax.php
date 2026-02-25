<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_documento = isset($_POST['cod_documento']) ? intval($_POST['cod_documento']) : 0;
$nuevo_estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;
if ($cod_documento <= 0) { echo json_encode(['success' => false, 'message' => 'Código de documento no válido']); exit; }
$sql = "UPDATE tbl15_firma_digital_documento SET cod_estado = ? WHERE cod_firma_digital_documento = ?";
$stmt = mysqli_prepare($conectar, $sql);
mysqli_stmt_bind_param($stmt, "ii", $nuevo_estado, $cod_documento);
if (mysqli_stmt_execute($stmt)) {
    $mensaje = ($nuevo_estado == 0) ? 'Documento inhabilitado correctamente' : 'Documento habilitado correctamente';
    echo json_encode(['success' => true, 'message' => $mensaje]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado: ' . mysqli_error($conectar)]);
}
mysqli_close($conectar);
?>
