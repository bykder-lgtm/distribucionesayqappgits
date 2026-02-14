<?php
include_once('../conexiones/conexione.php'); 
date_default_timezone_set("America/Bogota");
header('Content-Type: application/json');

try {
    // Verificar que sea método POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { throw new Exception('Método no permitido'); }

    // Obtener y validar datos
    $cod_banco_cuenta = isset($_POST['cod_banco_cuenta_edit']) ? intval($_POST['cod_banco_cuenta_edit']) : 0;
    $cod_aliado = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
    $nombre_banco = isset($_POST['nombre_banco_cuenta']) ? trim($_POST['nombre_banco_cuenta']) : '';
    $nombre_tipo_cuenta = isset($_POST['nombre_tipo_cuenta']) ? trim($_POST['nombre_tipo_cuenta']) : '';
    $numero_cuenta = isset($_POST['numero_banco_cuenta']) ? trim($_POST['numero_banco_cuenta']) : '';
    $titular = isset($_POST['nombre_titular_cuenta']) ? trim($_POST['nombre_titular_cuenta']) : '';

    // Validaciones básicas
    if ($cod_banco_cuenta <= 0) { throw new Exception('Código de cuenta no válido'); }
    if ($cod_aliado <= 0) { throw new Exception('Código de aliado no válido'); }
    if (empty($nombre_banco) || empty($numero_cuenta)) { throw new Exception('Faltan datos obligatorios: banco y número de cuenta'); }
    // Mapeo de Tipo de Cuenta
    $cod_tipo_cuenta = 0;
    if ($nombre_tipo_cuenta == 'Ahorros') $cod_tipo_cuenta = 1;
    if ($nombre_tipo_cuenta == 'Corriente') $cod_tipo_cuenta = 2;

    // Normalizar datos
    $nombre_banco = strtoupper(mysqli_real_escape_string($conectar, $nombre_banco));
    $numero_cuenta = mysqli_real_escape_string($conectar, $numero_cuenta);
    $titular = strtoupper(mysqli_real_escape_string($conectar, $titular));
    $nombre_tipo_cuenta = mysqli_real_escape_string($conectar, $nombre_tipo_cuenta);

    // Verificar que la cuenta pertenezca al aliado (seguridad)
    $sql_verificar = "SELECT cod_banco_cuenta FROM tbl15_banco_cuenta WHERE cod_banco_cuenta = '$cod_banco_cuenta' AND cod_aliado_estrategico = '$cod_aliado' AND cod_estado = '1'";
    $resultado_verificar = mysqli_query($conectar, $sql_verificar);
    if (!$resultado_verificar || mysqli_num_rows($resultado_verificar) == 0) { throw new Exception('La cuenta no existe o no pertenece a este aliado'); }
    // Actualizar la cuenta bancaria
    $sql_update = "UPDATE tbl15_banco_cuenta SET nombre_banco_cuenta = '$nombre_banco', numero_banco_cuenta = '$numero_cuenta', nombre_titular_cuenta = '$titular', 
    cod_tipo_cuenta_banco = '$cod_tipo_cuenta' WHERE cod_banco_cuenta = '$cod_banco_cuenta' AND cod_aliado_estrategico = '$cod_aliado'";
    $resultado_update = mysqli_query($conectar, $sql_update);

    if (!$resultado_update) { throw new Exception('Error en la actualización: ' . mysqli_error($conectar)); }
    if (mysqli_affected_rows($conectar) == 0) { throw new Exception('No se realizaron cambios. Verifique que los datos sean diferentes a los actuales.'); }
    // Respuesta exitosa
    $response = array('success' => true, 'message' => 'Cuenta bancaria actualizada exitosamente', 'affected_rows' => mysqli_affected_rows($conectar));
} catch (Exception $e) {
    // Respuesta de error
    $response = array('success' => false, 'message' => $e->getMessage(), 'debug_data' => $_POST);
}
// Enviar respuesta JSON
echo json_encode($response);
?>