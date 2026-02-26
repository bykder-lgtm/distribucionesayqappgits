<?php 
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');
try {
    if (!isset($_POST['cod_tienda']) || !isset($_POST['ubicacion_gps'])) { throw new Exception('Datos incompletos'); }

    $cod_tienda = mysqli_real_escape_string($conectar, $_POST['cod_tienda']);
    $ubicacion_gps = mysqli_real_escape_string($conectar, $_POST['ubicacion_gps']);
    $direccion_gps = isset($_POST['direccion_gps']) ? mysqli_real_escape_string($conectar, $_POST['direccion_gps']) : '';
    // Validar formato de coordenadas (latitud,longitud)
    if (!preg_match('/^-?\d+\.\d+,-?\d+\.\d+$/', $ubicacion_gps)) { throw new Exception('Formato de coordenadas no válido'); }
    // Actualizar ubicación GPS y dirección en la tabla
    $sql = "UPDATE tbl15_tienda SET ubicacion_gps_tienda = '$ubicacion_gps', direccion_tercero = '$direccion_gps' WHERE cod_tienda = '$cod_tienda'";
    if (mysqli_query($conectar, $sql)) {
        if (mysqli_affected_rows($conectar) > 0) { $response['success'] = true; $response['message'] = 'Ubicación GPS guardada correctamente'; } else { throw new Exception('No se pudo actualizar la ubicación. Verifica que la tienda exista.'); }
    } else {
        throw new Exception('Error en la base de datos: ' . mysqli_error($conectar));
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}
echo json_encode($response);
?>
