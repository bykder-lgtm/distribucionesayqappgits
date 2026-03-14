<?php
session_start();
include_once('../conexiones/conexione.php');
header('Content-Type: application/json');

// Validación de sesión básica (cod_seguridad 20 = Líder)
if(!isset($_SESSION["cod_seguridad"]) || $_SESSION["cod_seguridad"] != '20') { echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    if ($_POST['accion'] == 'asignar_vendedor_tienda') {
        $id_vendedor = isset($_POST['id_vendedor']) ? (int)$_POST['id_vendedor'] : 0;
        $id_tienda = isset($_POST['id_tienda_nueva']) ? (int)$_POST['id_tienda_nueva'] : 0; // 0 significa No Asignado
        
        if ($id_vendedor > 0) {
            // Si el id es 0, lo ponemos como vacío o 0
            $query_tienda = ($id_tienda > 0) ? "'$id_tienda'" : "''";
            $sql_update = "UPDATE tbl15_administrador SET cod_tienda = $query_tienda WHERE cod_administrador = '$id_vendedor' AND cod_seguridad = '2'";
            if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'El vendedor ha sido asignado correctamente a la tienda.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]); }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identificador de vendedor no válido.']);
        }
        exit;
    }
    // Aquí se pueden agregar más acciones si luego quieres arrastrar "Líder a Coordinador" o "Aliado a Asesor", etc.
}
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
?>
