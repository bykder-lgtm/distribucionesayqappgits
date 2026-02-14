<?php
// Endpoint para obtener todas las entidades crediticias disponibles
ob_start(); // Capturar cualquier output no deseado
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean(); // Limpiar el buffer

header('Content-Type: application/json; charset=utf-8');
// Función para enviar respuesta JSON y terminar
function sendJsonResponse($data) { echo json_encode($data); exit; } 

try {
    // Verificar conexión a la base de datos
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }

    // Consultar todas las entidades crediticias activas
    $sql_entidades = "SELECT cod_entidad_crediticia, nombre_entidad_crediticia, aliado_estrategico_interes_ptj, observaciones_entidad_crediticia FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') ORDER BY cod_posicion ASC";
    $consulta_entidades = mysqli_query($conectar, $sql_entidades);
    
    if (!$consulta_entidades) { sendJsonResponse(['success' => false, 'message' => 'Error en consulta: ' . mysqli_error($conectar)]); }
    $entidades = [];
    while ($fila = mysqli_fetch_assoc($consulta_entidades)) {
        $entidades[] = [
            'cod_entidad_crediticia' => $fila['cod_entidad_crediticia'],
            'nombre_entidad_crediticia' => $fila['nombre_entidad_crediticia'],
            'aliado_estrategico_interes_ptj' => $fila['aliado_estrategico_interes_ptj'],
            'observaciones_entidad_crediticia' => $fila['observaciones_entidad_crediticia']
        ];
    }
    sendJsonResponse([
        'success' => true,
        'entidades' => $entidades,
        'total' => count($entidades)
    ]);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>