<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 20 = Líder)
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '20') { echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    if ($_POST['accion'] == 'asignar_tienda_aliado') {
        $id_tienda = isset($_POST['id_tienda']) ? (int)$_POST['id_tienda'] : 0;
        $id_aliado = isset($_POST['id_aliado_nuevo']) ? (int)$_POST['id_aliado_nuevo'] : 0; // 0 significa No Asignado
        
        if ($id_tienda > 0) {
            // Si el id es 0, lo ponemos como vacío o 0
            $query_aliado = ($id_aliado > 0) ? "'$id_aliado'" : "''";
            $sql_update = "UPDATE tbl15_tienda SET cod_aliado_estrategico = $query_aliado WHERE cod_tienda = '$id_tienda'";
            if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'La tienda ha sido asignada correctamente.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identificador de tienda no válido.']);
        }
        exit;
    }
    // Aquí se pueden agregar más acciones si luego quieres arrastrar "Líder a Coordinador" o "Aliado a Asesor", etc.
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
