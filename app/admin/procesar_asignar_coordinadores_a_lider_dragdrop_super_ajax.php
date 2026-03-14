<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 1 = Super Administrador)
// Ajusta esto según el código de seguridad real del supersuario que vaya a asignar líderes.
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '1') { echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    if ($_POST['accion'] == 'asignar_coordinador_lider') {
        $id_coordinador = isset($_POST['id_coordinador']) ? (int)$_POST['id_coordinador'] : 0;
        $id_lider = isset($_POST['id_lider']) ? (int)$_POST['id_lider'] : 0; // 0 significa No Asignado
        
        if ($id_coordinador > 0) {
            // Si el id es 0, lo ponemos como vacío o 0
            $query_lider = ($id_lider > 0) ? "'$id_lider'" : "''";
            $sql_update = "UPDATE tbl15_administrador SET cod_lider = $query_lider WHERE cod_administrador = '$id_coordinador' AND cod_seguridad = '21'";
            if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'El coordinador ha sido asignado correctamente.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identificador de coordinador no válido.']);
        }
        exit;
    }
    // Aquí se pueden agregar más acciones si luego quieres arrastrar "Líder a Coordinador" o "Aliado a Asesor", etc.
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
