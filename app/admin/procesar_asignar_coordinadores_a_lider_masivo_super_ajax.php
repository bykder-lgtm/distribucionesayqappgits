<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 1 = Super Administrador)
// Ajusta esto según el código de seguridad real del supersuario que vaya a asignar líderes.
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '1') { 
    echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    if ($_POST['accion'] == 'asignar_coordinadores_lider_masivo') {
        $ids_coordinadores = isset($_POST['ids_coordinadores']) ? $_POST['ids_coordinadores'] : [];
        $id_lider = isset($_POST['id_lider']) ? (int)$_POST['id_lider'] : 0;
        
        if (!is_array($ids_coordinadores) || count($ids_coordinadores) == 0) {
            echo json_encode(['status' => 'error', 'message' => 'No se han seleccionado coordinadores.']);
            exit;
        }

        $query_lider = ($id_lider > 0) ? "'$id_lider'" : "''";
        
        // Sanitize IDs (force integers to avoid injection)
        $clean_ids = array_map('intval', $ids_coordinadores);
        $ids_string = implode(',', $clean_ids);

        $sql_update = "UPDATE tbl15_administrador SET cod_lider = $query_lider WHERE cod_administrador IN ($ids_string) AND cod_seguridad = '21'";
        
        if (mysqli_query($conectar, $sql_update)) { 
            echo json_encode(['status' => 'success', 'message' => count($clean_ids) . ' coordinadores han sido asignados exitosamente.']); 
        } else { 
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); 
        }
        exit;
    }
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
