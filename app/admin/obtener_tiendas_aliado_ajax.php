<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_aliado = isset($_POST['cod_aliado']) ? intval($_POST['cod_aliado']) : 0;
if ($cod_aliado <= 0) { echo json_encode(['success' => false, 'message' => 'Código de aliado no válido']); exit; }
$sql = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado' AND cod_estado = '1' ORDER BY nombre_tienda ASC";
$res = mysqli_query($conectar, $sql);
if ($res) {
    $tiendas = [];
    while ($row = mysqli_fetch_assoc($res)) { $tiendas[] = $row; }
    echo json_encode(['success' => true, 'tiendas' => $tiendas]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al obtener tiendas: ' . mysqli_error($conectar)]);
}

mysqli_close($conectar);
?>
