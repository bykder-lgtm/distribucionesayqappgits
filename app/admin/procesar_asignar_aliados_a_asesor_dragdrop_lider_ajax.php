<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 20 = Líder)
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '20') { echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    if ($_POST['accion'] == 'asignar_aliado_asesor') {
        $id_aliado = isset($_POST['id_aliado']) ? (int)$_POST['id_aliado'] : 0;
        $id_asesor = isset($_POST['id_asesor_nuevo']) ? (int)$_POST['id_asesor_nuevo'] : 0; // 0 significa No Asignado
        
        if ($id_aliado > 0) {
            // Si el id es 0, lo ponemos como vacío o 0
            $query_asesor = ($id_asesor > 0) ? "'$id_asesor'" : "''";
            $sql_update = "UPDATE tbl15_administrador SET cod_asesor = $query_asesor WHERE cod_administrador = '$id_aliado' AND cod_seguridad = '23'";
            if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'El aliado ha sido asignado correctamente.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identificador de aliado no válido.']);
        }
        exit;
    }
    // Aquí se pueden agregar más acciones si luego quieres arrastrar "Líder a Coordinador" o "Aliado a Asesor", etc.
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
