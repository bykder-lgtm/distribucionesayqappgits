<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

// Obtener parámetros
$nombre_banco_cuenta = isset($_POST['nombre_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_banco_cuenta'])) : '';
$numero_banco_cuenta = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['numero_banco_cuenta'])) : '';
$cod_tipo_cuenta_banco = isset($_POST['tipo_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['tipo_cuenta'])) : '1';
$nombre_titular_cuenta = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_titular_cuenta'])) : '';
$identificacion_titular_cuenta = isset($_POST['identificacion_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_titular_cuenta'])) : '';
$cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
$cod_estado = 1;

// Validar campos requeridos
if (empty($nombre_banco_cuenta) || empty($numero_banco_cuenta)) { echo json_encode(array('success' => false, 'message' => 'Los campos Nombre del Banco y Número de Cuenta son obligatorios')); exit; }
if (empty($cod_aliado_estrategico)) { echo json_encode(array('success' => false, 'message' => 'Debe especificar un Aliado Estratégico')); exit; }
// Verificar si ya existe una cuenta con el mismo número para este aliado
$sql_verificar = "SELECT cod_banco_cuenta FROM tbl15_banco_cuenta WHERE numero_banco_cuenta = '$numero_banco_cuenta' AND cod_aliado_estrategico = '$cod_aliado_estrategico'";
$consulta_verificar = mysqli_query($conectar, $sql_verificar);
if (mysqli_num_rows($consulta_verificar) > 0) { echo json_encode(array('success' => false, 'message' => 'Ya existe una cuenta bancaria con este número para este aliado')); exit; }
// Insertar nueva cuenta bancaria
$sql = "INSERT INTO tbl15_banco_cuenta (nombre_banco_cuenta, numero_banco_cuenta, cod_tipo_cuenta_banco, nombre_titular_cuenta, identificacion_titular_cuenta, cod_aliado_estrategico, cod_estado) 
VALUES (UPPER(?), ?, ?, UPPER(?), UPPER(?), ?, ?)";
$stmt = mysqli_prepare($conectar, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssii", $nombre_banco_cuenta, $numero_banco_cuenta, $cod_tipo_cuenta_banco, $nombre_titular_cuenta, $identificacion_titular_cuenta, $cod_aliado_estrategico, $cod_estado);
    
    if (mysqli_stmt_execute($stmt)) {
        $cod_banco_cuenta = mysqli_insert_id($conectar);
        echo json_encode(array('success' => true, 'message' => 'Cuenta bancaria registrada correctamente', 'cod_banco_cuenta' => $cod_banco_cuenta));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al registrar la cuenta bancaria: ' . mysqli_error($conectar)));
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('success' => false, 'message' => 'Error al preparar la consulta: ' . mysqli_error($conectar)));
}
mysqli_close($conectar);
?>
