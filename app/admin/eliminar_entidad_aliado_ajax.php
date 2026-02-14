<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (!verificar_usuario()) { header('Content-Type: application/json'); echo json_encode(['success' => false, 'mensaje' => 'No autorizado']); exit; }

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_parametrizacion_entidad_crediticia_aliado = isset($_POST['cod_parametrizacion']) ? intval($_POST['cod_parametrizacion']) : 0;
    if ($cod_parametrizacion_entidad_crediticia_aliado <= 0) { echo json_encode(['success' => false, 'mensaje' => 'Parámetro no válido']); exit; }
    // Eliminar físicamente el registro
    $sql = "DELETE FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE cod_parametrizacion_entidad_crediticia_aliado = '$cod_parametrizacion_entidad_crediticia_aliado'";
    if (mysqli_query($conectar, $sql)) {
        if (mysqli_affected_rows($conectar) > 0) {
            echo json_encode(['success' => true, 'mensaje' => 'Parametrización eliminada correctamente', 'id' => $cod_parametrizacion_entidad_crediticia_aliado]);
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'No se encontró el registro a eliminar', 'id' => $cod_parametrizacion_entidad_crediticia_aliado]);
        }
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al eliminar: ' . mysqli_error($conectar), 'id' => $cod_parametrizacion_entidad_crediticia_aliado]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Método no permitido', 'id' => $cod_parametrizacion_entidad_crediticia_aliado]);
}
?>
