<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

// Inicializar respuesta
$response = array('success' => false, 'message' => 'Error desconocido');

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $response['message'] = 'Método no permitido'; echo json_encode($response); exit; }
// Recibir parámetros
$cod_administrador                                              = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
$cod_estado_autorizo_datos_firma_contrato_alianza               = isset($_POST['cod_estado_autorizo_datos_firma_contrato_alianza']) ? intval($_POST['cod_estado_autorizo_datos_firma_contrato_alianza']) : 0;
$cod_estado_autorizo_datos_firma_contrato_agencia               = isset($_POST['cod_estado_autorizo_datos_firma_contrato_agencia']) ? intval($_POST['cod_estado_autorizo_datos_firma_contrato_agencia']) : 0;
$cod_estado_autorizo_datos_firma_acuerdo_confidencialidad       = isset($_POST['cod_estado_autorizo_datos_firma_acuerdo_confidencialidad']) ? intval($_POST['cod_estado_autorizo_datos_firma_acuerdo_confidencialidad']) : 0;
$cod_estado_declaro_autorizo_informacion_sumistrada_real        = isset($_POST['cod_estado_declaro_autorizo_informacion_sumistrada_real']) ? intval($_POST['cod_estado_declaro_autorizo_informacion_sumistrada_real']) : 0;
// Validaciones
if ($cod_administrador <= 0) { $response['message'] = 'Usuario no válido'; echo json_encode($response); exit; }
// Actualizar en la base de datos
$sql_actualizar = "UPDATE tbl15_administrador SET 
    cod_estado_autorizo_datos_firma_contrato_alianza = '$cod_estado_autorizo_datos_firma_contrato_alianza',
    cod_estado_autorizo_datos_firma_contrato_agencia = '$cod_estado_autorizo_datos_firma_contrato_agencia',
    cod_estado_autorizo_datos_firma_acuerdo_confidencialidad = '$cod_estado_autorizo_datos_firma_acuerdo_confidencialidad',
    cod_estado_declaro_autorizo_informacion_sumistrada_real = '$cod_estado_declaro_autorizo_informacion_sumistrada_real'
    WHERE cod_administrador = '$cod_administrador'";
$resultado = mysqli_query($conectar, $sql_actualizar);
if ($resultado) {
    $response['success']                                        = true;
    $response['message']                                        = 'Autorizaciones guardadas correctamente';
} else {
    $response['message']                                        = 'Error al guardar las autorizaciones: ' . mysqli_error($conectar);
}
mysqli_close($conectar);
echo json_encode($response);
?>
