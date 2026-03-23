<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../session/funciones_admin.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");
// Verificar sesión
if (!verificar_usuario()) { echo json_encode(array('success' => false, 'message' => 'Sesión no válida')); exit; }

$fecha                                                              = date("Y-m-d");
$fecha_hora                                                         = date("H:i:s");
try {
    // ==================== OBTENER DATOS DEL FORMULARIO ====================
    $cod_administrador                                                  = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
    $codigo_tipo_vendedor                                               = isset($_POST['codigo_tipo_vendedor']) ? intval($_POST['codigo_tipo_vendedor']) : 0;
    $identificacion_tercero                                             = isset($_POST['identificacion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_tercero'])) : '';
    $nombre1_tercero                                                    = isset($_POST['nombre1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre1_tercero'])) : '';
    $apellido1_tercero                                                  = isset($_POST['apellido1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['apellido1_tercero'])) : '';
    $telefono1_tercero                                                  = isset($_POST['telefono1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['telefono1_tercero'])) : '';
    $correo_tercero                                                     = isset($_POST['correo_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['correo_tercero'])) : '';
    $direccion_tercero                                                  = isset($_POST['direccion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['direccion_tercero'])) : '';
    $barrio_tercero                     = isset($_POST['barrio_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['barrio_tercero'])) : '';
    $cod_departamento                   = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio                      = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
    $cod_estado_activacion_usuario       = isset($_POST['cod_estado_activacion_usuario']) ? intval($_POST['cod_estado_activacion_usuario']) : 1;
    // Construir nombre completo
    $nombres_apellidos_tercero                                          = trim($nombre1_tercero . ' ' . $apellido1_tercero);
    // ==================== VALIDACIONES ====================
    if ($cod_administrador <= 0) { echo json_encode(array('success' => false, 'message' => 'Código de vendedor inválido')); exit; }
    if (empty($identificacion_tercero)) { echo json_encode(array('success' => false, 'message' => 'La identificación es obligatoria')); exit; }
    if (empty($nombre1_tercero)) { echo json_encode(array('success' => false, 'message' => 'El nombre es obligatorio')); exit; }
    if (empty($telefono1_tercero)) { echo json_encode(array('success' => false, 'message' => 'El teléfono es obligatorio')); exit; }
    if (empty($correo_tercero)) { echo json_encode(array('success' => false, 'message' => 'El correo es obligatorio')); exit; }
    // ==================== VERIFICAR QUE EL VENDEDOR EXISTE ====================
    $sql_verificar = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador' AND cod_seguridad = '2'";
    $result_verificar = mysqli_query($conectar, $sql_verificar);
    if (!$result_verificar || mysqli_num_rows($result_verificar) == 0) { echo json_encode(array('success' => false, 'message' => 'El vendedor no existe o no es válido')); exit; }
    // ==================== ACTUALIZAR VENDEDOR ====================
    $sql_update = "UPDATE tbl15_administrador SET 
        codigo_tipo_vendedor = '$codigo_tipo_vendedor', identificacion_tercero = '$identificacion_tercero', cedula = '$identificacion_tercero', nombre1_tercero = UPPER('$nombre1_tercero'), nombres = UPPER('$nombre1_tercero'),
        apellido1_tercero = UPPER('$apellido1_tercero'), apellidos = UPPER('$apellido1_tercero'), nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'),
        telefono1_tercero = '$telefono1_tercero', telefono = '$telefono1_tercero', correo_tercero = '$correo_tercero', correo = '$correo_tercero',
        direccion_tercero = UPPER('$direccion_tercero'), barrio_tercero = UPPER('$barrio_tercero'), 
        cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio',
        cod_estado_activacion_usuario = '$cod_estado_activacion_usuario' WHERE cod_administrador = '$cod_administrador' AND cod_seguridad = '2'";
    if (mysqli_query($conectar, $sql_update)) { echo json_encode(array('success' => true, 'message' => 'Vendedor actualizado correctamente'));
    } else { echo json_encode(array('success' => false, 'message' => 'Error al actualizar el vendedor: ' . mysqli_error($conectar))); }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()));
}
mysqli_close($conectar);
?>
