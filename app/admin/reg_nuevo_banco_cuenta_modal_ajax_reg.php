<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../session/funciones_admin.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

// Verificar sesión
if (!verificar_usuario()) { echo json_encode(array('success' => false, 'message' => 'Sesión no válida')); exit; }

$cuenta_actual = $_SESSION['usuario'];
$fecha = date("Y-m-d");
$fecha_hora = date("H:i:s");

try {
    // Obtener parámetros del formulario
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : 0;
    $nombre_banco_cuenta = isset($_POST['nombre_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_banco_cuenta'])) : '';
    $numero_banco_cuenta = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['numero_banco_cuenta'])) : '';
    $nombre_titular_cuenta = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_titular_cuenta'])) : '';
    $identificacion_titular_cuenta = isset($_POST['identificacion_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_titular_cuenta'])) : '';
    
    // Valores por defecto
    $cod_tipo_cuenta_banco = 1; // Por defecto: Ahorro
    $cod_estado = 1; // Activo
    $nombre_tipo_cuenta_banco = 'AHORRO';
    // Validar campos requeridos
    if (empty($nombre_banco_cuenta)) { echo json_encode(array('success' => false, 'message' => 'El nombre del banco es obligatorio')); exit; }
    if (empty($numero_banco_cuenta)) { echo json_encode(array('success' => false, 'message' => 'El número de cuenta es obligatorio')); exit; }
    // Obtener información de la factura (cod_tienda, cod_aliado_estrategico)
    $cod_tienda = 0;
    $cod_aliado_estrategico = 0;
    
    if ($cod_info_factura_venta > 0) {
        $sql_factura = "SELECT cod_tienda, cod_administrador_aliado_estrategico FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $result_factura = mysqli_query($conectar, $sql_factura);
        
        if (!$result_factura) { echo json_encode(array('success' => false, 'message' => 'Error en consulta de factura: ' . mysqli_error($conectar))); exit; }
        
        if (mysqli_num_rows($result_factura) > 0) {
            $info_factura = mysqli_fetch_assoc($result_factura);
            $cod_tienda = intval($info_factura['cod_tienda']);
            $cod_aliado_estrategico = intval($info_factura['cod_administrador_aliado_estrategico']);
        }
    }
    
    // Verificar si ya existe una cuenta bancaria con el mismo número
    if ($cod_tienda > 0) {
        $sql_verificar = "SELECT cod_banco_cuenta FROM tbl15_banco_cuenta WHERE numero_banco_cuenta = '$numero_banco_cuenta' AND cod_tienda = '$cod_tienda'";
        $result_verificar = mysqli_query($conectar, $sql_verificar);
        
        if (!$result_verificar) { echo json_encode(array('success' => false, 'message' => 'Error en consulta de verificación: ' . mysqli_error($conectar))); exit; }
        
        if (mysqli_num_rows($result_verificar) > 0) {
            $row_existente = mysqli_fetch_assoc($result_verificar);
            echo json_encode(array('success' => true, 'message' => 'Esta cuenta bancaria ya está registrada para esta tienda', 'cod_banco_cuenta' => $row_existente['cod_banco_cuenta']));
            exit;
        }
    }
    // Preparar fecha_creacion (formato: YYYY-MM-DD HH:MM:SS)
    $fecha_creacion = date('Y-m-d H:i:s');
    // Insertar la cuenta bancaria
    $sql_insert = "INSERT INTO tbl15_banco_cuenta (
    nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta, nombre_tipo_cuenta_banco, cod_tipo_cuenta_banco, 
    cod_banco, cod_administrador, cod_tercero, cod_aliado_estrategico, cod_tienda, url_certificado_banco_cuenta, fecha_creacion, cod_estado) 
    VALUES (UPPER('$nombre_banco_cuenta'), '$numero_banco_cuenta', UPPER('$nombre_titular_cuenta'), '$identificacion_titular_cuenta', UPPER('$nombre_tipo_cuenta_banco'), '$cod_tipo_cuenta_banco', 
    '0', '0', '0', '$cod_aliado_estrategico', '$cod_tienda', '', '$fecha_creacion', '$cod_estado')";
    if (mysqli_query($conectar, $sql_insert)) {
        $cod_banco_cuenta = mysqli_insert_id($conectar);
        echo json_encode(array('success' => true, 'message' => 'Cuenta bancaria registrada correctamente', 'cod_banco_cuenta' => $cod_banco_cuenta));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al registrar la cuenta bancaria: ' . mysqli_error($conectar)));
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()));
}
mysqli_close($conectar);
?>
