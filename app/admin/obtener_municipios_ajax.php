<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include ("../session/funciones_admin.php");
header('Content-Type: application/json');
//if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit(); }
// Validar que se recibió el código de departamento
if (!isset($_GET['cod_departamento']) || empty($_GET['cod_departamento'])) { echo json_encode(['success' => false, 'mensaje' => 'Código de departamento no especificado']); exit(); }
$cod_departamento = intval($_GET['cod_departamento']);

try {
    // Consultar municipios del departamento activos
    $sql = "SELECT cod_municipio, nombre_municipio FROM tbl15_municipio WHERE cod_departamento = '$cod_departamento' AND cod_estado = 1 ORDER BY nombre_municipio ASC";
    $exec = mysqli_query($conectar, $sql);
    if (!$exec) { echo json_encode(['success' => false, 'mensaje' => 'Error en consulta: ' . mysqli_error($conectar)]); exit(); }
    $municipios = [];
    while ($row = mysqli_fetch_assoc($exec)) { $municipios[] = ['cod_municipio' => $row['cod_municipio'], 'nombre_municipio' => $row['nombre_municipio']]; }
    echo json_encode(['success' => true, 'municipios' => $municipios, 'total' => count($municipios)]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'mensaje' => 'Excepción: ' . $e->getMessage()]);
}
?>
