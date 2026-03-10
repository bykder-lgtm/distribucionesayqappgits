<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../session/funciones_admin.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

// Verificar sesión
if (!verificar_usuario()) { echo json_encode(array('success' => false, 'mensaje' => 'Sesión no válida')); exit; }

$cuenta_actual = $_SESSION['usuario'];
$fecha = date("Y-m-d");
$fecha_hora = date("H:i:s");

try {
    // Obtener parámetros del formulario
    $cod_tienda                                                         = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
    $cod_banco                                                          = isset($_POST['cod_banco']) ? intval($_POST['cod_banco']) : 0;
    $numero_banco_cuenta                                                = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['numero_banco_cuenta'])) : '';
    $cod_tipo_cuenta_banco                                              = isset($_POST['cod_tipo_cuenta_banco']) ? intval($_POST['cod_tipo_cuenta_banco']) : 1;
    $cod_estado                                                         = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
    $nombre_titular_cuenta                                              = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_titular_cuenta'])) : '';
    $identificacion_titular_cuenta                                      = isset($_POST['identificacion_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_titular_cuenta'])) : '';
    // Validar campos requeridos
    if ($cod_tienda <= 0) { echo json_encode(array('success' => false, 'mensaje' => 'Código de tienda inválido')); exit; }
    if ($cod_banco <= 0) {  echo json_encode(array('success' => false, 'mensaje' => 'Debe seleccionar un banco')); exit; }
    if (empty($numero_banco_cuenta)) { echo json_encode(array('success' => false, 'mensaje' => 'El número de cuenta es obligatorio')); exit; }
    if (empty($nombre_titular_cuenta)) { echo json_encode(array('success' => false, 'mensaje' => 'El nombre del titular es obligatorio')); exit; }
    if (empty($identificacion_titular_cuenta)) { echo json_encode(array('success' => false, 'mensaje' => 'La identificación del titular es obligatoria')); exit; }
    // Verificar que la tienda existe y obtener cod_aliado_estrategico
    $sql_tienda = "SELECT cod_tienda, nombre_tienda, cod_aliado_estrategico FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda' AND cod_estado != '0'";
    $result_tienda = mysqli_query($conectar, $sql_tienda);
    if (!$result_tienda) { echo json_encode(array('success' => false, 'mensaje' => 'Error en consulta de tienda: ' . mysqli_error($conectar))); exit; }
    if (mysqli_num_rows($result_tienda) == 0) { echo json_encode(array('success' => false, 'mensaje' => 'La tienda no existe')); exit; }
    $info_tienda = mysqli_fetch_assoc($result_tienda);
    $cod_aliado_estrategico                                             = $info_tienda['cod_aliado_estrategico'];
    // Verificar si ya existe una cuenta bancaria con el mismo número para esta tienda
    $sql_verificar = "SELECT cod_banco_cuenta FROM tbl15_banco_cuenta WHERE numero_banco_cuenta = '$numero_banco_cuenta' AND cod_tienda = '$cod_tienda'";
    $result_verificar = mysqli_query($conectar, $sql_verificar);
    if (!$result_verificar) { echo json_encode(array('success' => false, 'mensaje' => 'Error en consulta de verificación: ' . mysqli_error($conectar))); exit; }
    if (mysqli_num_rows($result_verificar) > 0) { echo json_encode(array('success' => false, 'mensaje' => 'Ya existe una cuenta bancaria con este número para esta tienda')); exit; }
    // Procesar archivo de certificado si existe
    $nombre_archivo_certificado = '';
    if (isset($_FILES['certificado_banco']) && $_FILES['certificado_banco']['error'] == 0) {
        $archivo                                                            = $_FILES['certificado_banco'];
        $extension                                                          = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $extensiones_permitidas                                             = array('jpg', 'jpeg', 'png', 'pdf');
        if (!in_array($extension, $extensiones_permitidas)) { echo json_encode(array('success' => false, 'mensaje' => 'El certificado debe ser JPG, JPEG, PNG o PDF')); exit; }
        // Tamaño máximo 5MB
        if ($archivo['size'] > 5242880) { echo json_encode(array('success' => false, 'mensaje' => 'El certificado no debe superar los 5MB')); exit; }
        // Crear directorio si no existe
        $directorio_destino                                                 = '../archivador/banco_tienda/';
        if (!file_exists($directorio_destino)) { mkdir($directorio_destino, 0777, true); }
        // Generar nombre único para el archivo
        $nombre_archivo_certificado                                         = 'certificado_' . $cod_tienda . '_' . time() . '.' . $extension;
        $url_certificado_banco_cuenta                                       = $directorio_destino . $nombre_archivo_certificado;
        if (!move_uploaded_file($archivo['tmp_name'], $ruta_completa)) { echo json_encode(array('success' => false, 'mensaje' => 'Error al subir el certificado bancario')); exit; }
    }
    // Obtener el nombre del banco
    $sql_banco = "SELECT nombre_banco FROM tbl15_banco WHERE cod_banco = '$cod_banco'";
    $result_banco = mysqli_query($conectar, $sql_banco);
    if (!$result_banco) { echo json_encode(array('success' => false, 'mensaje' => 'Error en consulta de banco: ' . mysqli_error($conectar))); exit; }
    $info_banco = mysqli_fetch_assoc($result_banco);
    $nombre_banco_cuenta                                                = $info_banco['nombre_banco'];
    // Obtener el nombre del tipo de cuenta
    $sql_tipo_cuenta = "SELECT nombre_tipo_cuenta_banco FROM tbl15_tipo_cuenta_banco WHERE cod_tipo_cuenta_banco = '$cod_tipo_cuenta_banco'";
    $result_tipo_cuenta = mysqli_query($conectar, $sql_tipo_cuenta);
    $nombre_tipo_cuenta_banco                                           = 'AHORRO'; // Valor por defecto
    if ($result_tipo_cuenta && mysqli_num_rows($result_tipo_cuenta) > 0) { $info_tipo_cuenta = mysqli_fetch_assoc($result_tipo_cuenta); $nombre_tipo_cuenta_banco = $info_tipo_cuenta['nombre_tipo_cuenta_banco']; }
    // Preparar fecha_creacion (formato: YYYY-MM-DD HH:MM:SS)
    $fecha_creacion                                                     = date('Y-m-d H:i:s');
    // Insertar la cuenta bancaria
    $sql_insert = "INSERT INTO tbl15_banco_cuenta (nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta, nombre_tipo_cuenta_banco, 
    cod_tipo_cuenta_banco, cod_banco, cod_administrador, cod_tercero, cod_aliado_estrategico, cod_tienda, url_certificado_banco_cuenta, fecha_creacion, cod_estado) 
    VALUES (UPPER('$nombre_banco_cuenta'), '$numero_banco_cuenta', UPPER('$nombre_titular_cuenta'), '$identificacion_titular_cuenta', UPPER('$nombre_tipo_cuenta_banco'), 
    '$cod_tipo_cuenta_banco', '$cod_banco', '0', '0', '$cod_aliado_estrategico', '$cod_tienda', '$url_certificado_banco_cuenta', '$fecha_creacion', '$cod_estado')";
    if (mysqli_query($conectar, $sql_insert)) {
        $cod_banco_cuenta = mysqli_insert_id($conectar);
        echo json_encode(array('success' => true, 'mensaje' => 'Cuenta bancaria registrada correctamente', 'cod_banco_cuenta' => $cod_banco_cuenta));
    } else {
        // Si falla la inserción, eliminar el archivo subido
        if (!empty($nombre_archivo_certificado) && file_exists($directorio_destino . $nombre_archivo_certificado)) { unlink($directorio_destino . $nombre_archivo_certificado); }
        echo json_encode(array('success' => false, 'mensaje' => 'Error al registrar la cuenta bancaria: ' . mysqli_error($conectar)));
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'mensaje' => 'Error en el servidor: ' . $e->getMessage()));
}
mysqli_close($conectar);
?>
