<?php
// Endpoint para obtener los estados de revisión disponibles
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

function sendJsonResponse($data) { echo json_encode($data); exit; }

try {
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }
    // Consultar todos los estados de revisión
    $sql_estados = "SELECT cod_estado_revision, codigo_estado_revision, nombre_estado_revision, color_fondo_celda FROM tbl15_estado_revision WHERE (codigo_estado_revision <> '0') ORDER BY codigo_estado_revision ASC";
    $consulta_estados = mysqli_query($conectar, $sql_estados);
    
    if (!$consulta_estados) { sendJsonResponse(['success' => false, 'message' => 'Error en consulta: ' . mysqli_error($conectar)]); }
    $estados = [];
    while ($fila = mysqli_fetch_assoc($consulta_estados)) {
        $estados[] = [
            'cod_estado_revision' => $fila['cod_estado_revision'],
            'codigo_estado_revision' => $fila['codigo_estado_revision'],
            'nombre_estado_revision' => $fila['nombre_estado_revision'],
            'color_fondo_celda' => $fila['color_fondo_celda']
        ];
    }
    sendJsonResponse(['success' => true, 'estados' => $estados, 'total' => count($estados)]);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
