<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../session/funciones_admin.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");
// Verificar sesión
if (!verificar_usuario()) { echo json_encode(array('success' => false, 'message' => 'Sesión no válida')); exit; }

$cuenta_actual                                                      = $_SESSION['usuario'];
$cod_administrador_sesion                                           = $_SESSION['cod_administrador'];
$fecha                                                              = date("Y-m-d");
$fecha_hora                                                         = date("H:i:s");
$nombre_maquina                                                     = gethostbyaddr($_SERVER['REMOTE_ADDR']);
try {
    // Obtener parámetros del formulario
    $cod_tienda                                                         = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
    $identificacion_tercero                                             = isset($_POST['identificacion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_tercero'])) : '';
    $nombres_apellidos_tercero                                          = isset($_POST['nombres_apellidos_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['nombres_apellidos_tercero'])) : '';
    $nombre1_tercero_post                                               = isset($_POST['nombre1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre1_tercero'])) : '';
    $apellido1_tercero_post                                             = isset($_POST['apellido1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['apellido1_tercero'])) : '';
    $telefono1_tercero                                                  = isset($_POST['telefono1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['telefono1_tercero'])) : '';
    $correo_tercero                                                     = isset($_POST['correo_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['correo_tercero'])) : '';
    $direccion_tercero                                                  = isset($_POST['direccion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['direccion_tercero'])) : '';
    // Validar campos requeridos
    if ($cod_tienda <= 0) { echo json_encode(array('success' => false, 'message' => 'Código de tienda inválido')); exit; }
    if (empty($identificacion_tercero)) { echo json_encode(array('success' => false, 'message' => 'La identificación es obligatoria')); exit; }
    // Si se enviaron nombre y apellido por separado, construir nombres_apellidos_tercero
    if (!empty($nombre1_tercero_post)) {
        $nombre1_tercero = $nombre1_tercero_post;
        $apellido1_tercero = $apellido1_tercero_post;
        $nombres_apellidos_tercero = trim($nombre1_tercero . ' ' . $apellido1_tercero);
    } else if (!empty($nombres_apellidos_tercero)) {
        $nombre1_tercero = $nombres_apellidos_tercero;
        $apellido1_tercero = '';
    } else {
        echo json_encode(array('success' => false, 'message' => 'El nombre es obligatorio')); exit;
    }
    if (empty($telefono1_tercero)) { echo json_encode(array('success' => false, 'message' => 'El teléfono es obligatorio')); exit; }
    if (empty($correo_tercero)) { echo json_encode(array('success' => false, 'message' => 'El correo es obligatorio')); exit; }
    // Validar formato de correo
    if (!filter_var($correo_tercero, FILTER_VALIDATE_EMAIL)) { echo json_encode(array('success' => false, 'message' => 'El correo electrónico no es válido')); exit; }
    // Verificar que la tienda existe y obtener información del aliado
    $sql_tienda = "SELECT cod_tienda, cod_aliado_estrategico FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $result_tienda = mysqli_query($conectar, $sql_tienda);
    if (!$result_tienda) { echo json_encode(array('success' => false, 'message' => 'Error en consulta de tienda: ' . mysqli_error($conectar))); exit; }
    if (mysqli_num_rows($result_tienda) == 0) { echo json_encode(array('success' => false, 'message' => 'La tienda no existe')); exit; }
    $info_tienda = mysqli_fetch_assoc($result_tienda);
    $cod_aliado_estrategico                                             = $info_tienda['cod_aliado_estrategico'];
    // Verificar si el vendedor ya existe para esta tienda
    $sql_verificar = "SELECT cod_administrador FROM tbl15_administrador WHERE identificacion_tercero = '$identificacion_tercero' AND cod_seguridad = '24' AND cod_vendedor = '$cod_tienda'";
    $result_verificar = mysqli_query($conectar, $sql_verificar);
    if (!$result_verificar) { echo json_encode(array('success' => false, 'message' => 'Error en consulta de verificación: ' . mysqli_error($conectar))); exit; }
    if (mysqli_num_rows($result_verificar) > 0) { echo json_encode(array('success' => false, 'message' => 'Ya existe un vendedor con esta identificación para esta tienda')); exit; }

    // Obtener información del asesor para heredar lider y coordinador
    $sql_asesor = "SELECT cod_lider, cod_coordinador, cod_asesor FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado_estrategico'";
    $result_asesor = mysqli_query($conectar, $sql_asesor);
    if (!$result_asesor) { echo json_encode(array('success' => false, 'message' => 'Error en consulta de asesor: ' . mysqli_error($conectar))); exit; }
    $info_asesor = mysqli_fetch_assoc($result_asesor);
    $cod_lider                                                          = isset($info_asesor['cod_lider']) ? $info_asesor['cod_lider'] : 0;
    $cod_coordinador                                                    = isset($info_asesor['cod_coordinador']) ? $info_asesor['cod_coordinador'] : 0;
    $cod_asesor                                                         = isset($info_asesor['cod_asesor']) ? $info_asesor['cod_asesor'] : 0;

    // Obtener el próximo código de administrador para generar el usuario
    $sql_autoincremento = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
    $result_autoincremento = mysqli_query($conectar, $sql_autoincremento);
    if (!$result_autoincremento) { echo json_encode(array('success' => false, 'message' => 'Error en consulta de autoincremento: ' . mysqli_error($conectar))); exit; }
    $info_autoincremento = mysqli_fetch_assoc($result_autoincremento);
    $cod_administrador_nuevo                                            = $info_autoincremento['AUTO_INCREMENT'];
    // Generar usuario y contraseña
    $cuenta                                                             = $identificacion_tercero . '-' . $cod_administrador_nuevo;
    $contrasena                                                         = sha1($identificacion_tercero); // Contraseña inicial es la identificación encriptada
    // Preparar otros campos
    $cod_tipo_tercero                                                   = "2"; // Vendedor
    $nombre_tipo_tercero                                                = 'VENDEDOR';
    $nombre_tipo_cliente                                                = "PERSONA_NATURAL";
    $nombre_tipo_regimen                                                = "SIMPLE";
    $nombre_tipo_impuesto                                               = "NO_RESPONSABLE_DE_IVA";
    $nombre_tipo_identificacion                                         = "CC";
    $cod_seguridad                                                      = "24"; // Vendedor
    $cod_estado_activacion_usuario                                      = "1"; // Activo
    $url_pag_redirec_ini_sesion                                         = '../app/';
    $cod_caja_virtual                                                   = 1;
    $cod_caja                                                           = 1;
    // Insertar el vendedor
    $sql_insert = "INSERT INTO tbl15_administrador (identificacion_tercero, nombre1_tercero, apellido1_tercero, telefono1_tercero, correo_tercero, direccion_tercero,
    nombres_apellidos_tercero, cod_tipo_tercero, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, nombre_tipo_identificacion,
    cod_seguridad, cod_estado_activacion_usuario, fecha, fecha_hora, creador, cedula, nombres, apellidos, 
    correo, telefono, cuenta, contrasena, cod_vendedor, url_pag_redirec_ini_sesion, cod_caja_virtual, cod_caja, nombre_maquina, 
    cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico) 
    VALUES ('$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'), '$telefono1_tercero', '$correo_tercero', '$direccion_tercero',
    UPPER('$nombres_apellidos_tercero'), '$cod_tipo_tercero', '$nombre_tipo_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$nombre_tipo_identificacion',
    '$cod_seguridad', '$cod_estado_activacion_usuario', '$fecha', '$fecha_hora', '$cuenta_actual', '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'),
    '$correo_tercero', '$telefono1_tercero', '$cuenta', '$contrasena', '$cod_tienda', '$url_pag_redirec_ini_sesion', '$cod_caja_virtual', '$cod_caja', '$nombre_maquina',
    '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_aliado_estrategico')";
    if (mysqli_query($conectar, $sql_insert)) {
        $cod_administrador_insertado = mysqli_insert_id($conectar);
        echo json_encode(array('success' => true, 'message' => 'Vendedor registrado correctamente. Credenciales: Usuario: ' . $cuenta . ' / Contraseña: ' . $identificacion_tercero, 'cod_administrador' => $cod_administrador_insertado, 'usuario' => $cuenta, 'contrasena_inicial' => $identificacion_tercero));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al registrar el vendedor: ' . mysqli_error($conectar)));
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()));
}
mysqli_close($conectar);
?>
