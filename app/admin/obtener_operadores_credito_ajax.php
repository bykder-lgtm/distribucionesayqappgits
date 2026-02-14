<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()) { } else { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

try {
    // Consultar los operadores de crédito activos
    $sql = "SELECT cod_operador_credito, nombre_operador_credito FROM tbl15_operador_credito ORDER BY nombre_operador_credito ASC";
    $resultado = mysqli_query($conectar, $sql);
    if (!$resultado) { throw new Exception('Error al consultar operadores de crédito: ' . mysqli_error($conectar)); }
    
    $operadores = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $operadores[] = array(
            'cod_operador_credito' => $fila['cod_operador_credito'],
            'nombre_operador_credito' => $fila['nombre_operador_credito']
        );
    }
    echo json_encode(['success' => true, 'operadores' => $operadores]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
