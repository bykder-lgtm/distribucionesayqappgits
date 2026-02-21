<?php
include_once('../conexiones/conexione.php'); 
date_default_timezone_set("America/Bogota");

// Verificar si es una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['success' => false, 'message' => 'Método no permitido']); exit; }

// Obtener datos
$cod_aliado = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
$nombre_banco = isset($_POST['nombre_banco_cuenta']) ? trim($_POST['nombre_banco_cuenta']) : '';
$nombre_tipo_cuenta = isset($_POST['nombre_tipo_cuenta']) ? trim($_POST['nombre_tipo_cuenta']) : '';
$numero_cuenta = isset($_POST['numero_banco_cuenta']) ? trim($_POST['numero_banco_cuenta']) : '';
$titular = isset($_POST['nombre_titular_cuenta']) ? trim($_POST['nombre_titular_cuenta']) : '';

// Mapeo de Tipo de Cuenta
$cod_tipo_cuenta = 0;
if ($nombre_tipo_cuenta == 'Ahorros') $cod_tipo_cuenta = 1;
if ($nombre_tipo_cuenta == 'Corriente') $cod_tipo_cuenta = 2;

// Validaciones básicas
if ($cod_aliado <= 0 || empty($nombre_banco) || empty($numero_cuenta)) { 
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios', 'debug' => $_POST]);  
    exit; 
}

// Valores por defecto
$cod_estado = 1; // Activo
$fecha_creacion = date('Y-m-d H:i:s');
$identificacion_titular = 0; // No viene en el formulario pero es obligatorio en la tabla
$cod_banco = 0; // No tenemos el ID del banco, solo el nombre
$cod_administrador = 0;
$cod_tercero = 0;
$cod_tienda = 0;
$cod_puc = 0;
$cod_movimiento = 0;

// Update: Asegurar que nombre_banco_cuenta y nombre_titular_cuenta sean UPPER y seguros
$nombre_banco = strtoupper($nombre_banco);
$titular = strtoupper($titular);

// Insertar en la base de datos coincidiendo con la estructura dada
$sql = "INSERT INTO tbl15_banco_cuenta (cod_banco_cuenta, nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta, 
cod_tipo_cuenta_banco, cod_banco, cod_administrador, cod_tercero, cod_aliado_estrategico, cod_puc, cod_movimiento_contable_cuenta_personal, 
cod_tienda, fecha_creacion, cod_estado) 
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conectar, $sql);

if ($stmt) {
    // Tipos: s=string, i=integer
    // nombre_banco_cuenta (s), numero_banco_cuenta (s), nombre_titular_cuenta (s), identificacion_titular_cuenta (i), cod_tipo_cuenta_banco (i),
    // cod_banco (i), cod_administrador (i), cod_tercero (i), cod_aliado_estrategico (i), cod_puc (i), cod_movimiento (i), cod_tienda (i),
    // fecha_creacion (s), cod_estado (i)
    mysqli_stmt_bind_param($stmt, "sssiiiiiiiiisi", 
    $nombre_banco, $numero_cuenta, $titular, $identificacion_titular, 
    $cod_tipo_cuenta, $cod_banco, $cod_administrador, $cod_tercero, $cod_aliado, $cod_puc, $cod_movimiento,
    $cod_tienda, $fecha_creacion, $cod_estado);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cuenta registrada exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar en BD: ' . mysqli_error($conectar)]);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta: ' . mysqli_error($conectar)]);
}
?>
