<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 20 = Líder)
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '20') { echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    if ($_POST['accion'] == 'asignar_credito_revisor') {
        $id_credito = isset($_POST['id_credito']) ? (int)$_POST['id_credito'] : 0;
        $id_revisor = isset($_POST['id_revisor_nuevo']) ? (int)$_POST['id_revisor_nuevo'] : 0; // 0 significa No Asignado
        
        if ($id_credito > 0) {
            // Si el id es 0, lo ponemos como vacío o 0
            $query_revisor = ($id_revisor > 0) ? "'$id_revisor'" : "''";
            $sql_update = "UPDATE tbl15_info_factura_venta SET cod_administrador_revisor = $query_revisor WHERE cod_info_factura_venta = '$id_credito'";
            if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'El crédito ha sido asignado correctamente al revisor.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identificador de crédito no válido.']);
        }
        exit;
    }
    // Aquí se pueden agregar más acciones si luego quieres arrastrar "Líder a Coordinador" o "Aliado a Asesor", etc.
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
