<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 20 = Líder)
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '20') { echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    if ($_POST['accion'] == 'asignar_asesor_coordinador') {
        $id_asesor = isset($_POST['id_asesor']) ? (int)$_POST['id_asesor'] : 0;
        $id_coordinador = isset($_POST['id_coordinador']) ? (int)$_POST['id_coordinador'] : 0; // 0 significa No Asignado
        
        if ($id_asesor > 0) {
            // Si el id es 0, lo ponemos como vacío o 0
            $query_coord = ($id_coordinador > 0) ? "'$id_coordinador'" : "''";
            $sql_update = "UPDATE tbl15_administrador SET cod_coordinador = $query_coord WHERE cod_administrador = '$id_asesor' AND cod_seguridad = '22'";
            if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'El asesor ha sido asignado correctamente.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identificador de asesor no válido.']);
        }
        exit;
    }
    // Aquí se pueden agregar más acciones si luego quieres arrastrar "Líder a Coordinador" o "Aliado a Asesor", etc.
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
