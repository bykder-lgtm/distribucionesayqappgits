<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
$response                            = array();
$cod_administrador                   = $_SESSION['cod_administrador'];
// Validar que se reciban los parámetros necesarios
if (!isset($_POST['id'])) { $response['success'] = false; $response['message'] = 'Faltan parámetros requeridos'; echo json_encode($response); exit; }

$cod_info_factura_venta              = intval($_POST['id']);
$valor                               = intval($_POST['valor']);
$campo                               = mysqli_real_escape_string($conectar, $_POST['campo']);
$tipo_ajax                           = mysqli_real_escape_string($conectar, $_POST['tipo_ajax']);

try {
    // Actualizar
        $sql_update = "UPDATE tbl15_info_factura_venta SET $campo = '$valor' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $resultado_update = mysqli_query($conectar, $sql_update);
    
    if ($resultado_update) {
        $response['success'] = true;
        $response['message'] = 'Cambiado exitosamente a: ' . $valor;
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al actualizar el estado: ' . mysqli_error($conectar);
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}
echo json_encode($response);
?>
