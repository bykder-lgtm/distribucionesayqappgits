<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include ("../session/funciones_admin.php");
header('Content-Type: application/json');
//if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit(); }

try {
    // Consultar departamentos activos
    $sql = "SELECT cod_departamento, nombre_departamento FROM tbl15_departamento WHERE cod_estado = 1 ORDER BY nombre_departamento ASC";
    $exec = mysqli_query($conectar, $sql);
    if (!$exec) { echo json_encode(['success' => false, 'mensaje' => 'Error en consulta: ' . mysqli_error($conectar)]); exit(); }
    $departamentos = [];
    while ($row = mysqli_fetch_assoc($exec)) { $departamentos[] = ['cod_departamento' => $row['cod_departamento'], 'nombre_departamento' => $row['nombre_departamento']]; }
    echo json_encode(['success' => true, 'departamentos' => $departamentos, 'total' => count($departamentos)]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'mensaje' => 'Excepción: ' . $e->getMessage()]);
}
?>
