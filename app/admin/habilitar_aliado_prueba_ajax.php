<?php
header('Content-Type: application/json');

include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin_visitante_intern.php");

$response = array('success' => false, 'message' => '');
if (!isset($_POST['cod_administrador']) || empty($_POST['cod_administrador'])) { $response['message'] = 'ID de aliado no proporcionado.'; echo json_encode($response); exit; }
$cod_aliado = mysqli_real_escape_string($conectar, $_POST['cod_administrador']);
// Actualizar el estado de usuario de prueba a 0
$sql_update = "UPDATE tbl15_administrador SET cod_estado_usuario_prueba = '0' WHERE cod_administrador = '$cod_aliado'";

if (mysqli_query($conectar, $sql_update)) {
    if (mysqli_affected_rows($conectar) > 0) {
        $response['success'] = true;
        $response['message'] = 'El aliado ha sido habilitado como aliado normal exitosamente.';
    } else {
        $response['message'] = 'El aliado ya era un aliado normal o no se encontró.';
    }
} else {
    $response['message'] = 'Error al actualizar: ' . mysqli_error($conectar);
}
echo json_encode($response);
?>
