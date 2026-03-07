<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
header('Content-Type: application/json');
if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit(); }

$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);
// Validar que se recibieron los datos necesarios
if (!isset($_POST['cod_tienda']) || empty($_POST['cod_tienda'])) { echo json_encode(['success' => false, 'mensaje' => 'Código de tienda no especificado']); exit(); }

$cod_tienda                                                         = intval($_POST['cod_tienda']);
$nombre1_tercero                                                    = isset($_POST['nombre1_tercero']) ? trim(addslashes($_POST['nombre1_tercero'])) : '';
$identificacion_tercero                                             = isset($_POST['identificacion_tercero']) ? trim(addslashes($_POST['identificacion_tercero'])) : '';
$telefono1_tercero                                                  = isset($_POST['telefono1_tercero']) ? trim(addslashes($_POST['telefono1_tercero'])) : '';
$correo_tercero                                                     = isset($_POST['correo_tercero']) ? trim(addslashes($_POST['correo_tercero'])) : '';
$direccion_tercero                                                  = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
$barrio_tercero                                                     = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
$cod_departamento                                                   = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : null;
$cod_municipio                                                      = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : null;
$cod_estado                                                         = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
// Validar campos requeridos
if (empty($nombre1_tercero)) { echo json_encode(['success' => false, 'mensaje' => 'El nombre de la tienda es requerido']); exit(); }
if (empty($identificacion_tercero)) { echo json_encode(['success' => false, 'mensaje' => 'El NIT/Documento es requerido']); exit(); }
if (empty($telefono1_tercero)) { echo json_encode(['success' => false, 'mensaje' => 'El teléfono es requerido']); exit(); }
if (empty($correo_tercero)) { echo json_encode(['success' => false, 'mensaje' => 'El correo es requerido']); exit(); }
if (empty($cod_departamento)) { echo json_encode(['success' => false, 'mensaje' => 'El departamento es requerido']); exit(); }
if (empty($cod_municipio)) { echo json_encode(['success' => false, 'mensaje' => 'El municipio es requerido']); exit(); }
// Verificar que la tienda existe
$sql_verif = "SELECT cod_tienda, cod_aliado_estrategico FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
$exec_verif = mysqli_query($conectar, $sql_verif) or die(mysqli_error($conectar));
if (mysqli_num_rows($exec_verif) == 0) { echo json_encode(['success' => false, 'mensaje' => 'Tienda no encontrada']); exit(); }
// Actualizar los datos de la tienda
$nombre_tienda                                                      = $nombre1_tercero;

$sql_update = "UPDATE tbl15_tienda SET nombre_tienda = UPPER('$nombre_tienda'), nombre1_tercero = UPPER('$nombre1_tercero'),
identificacion_tercero = '$identificacion_tercero', telefono1_tercero = '$telefono1_tercero', correo_tercero = '$correo_tercero',
direccion_tercero = UPPER('$direccion_tercero'), barrio_tercero = UPPER('$barrio_tercero'), cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio', cod_estado = '$cod_estado' WHERE cod_tienda = '$cod_tienda'";
$exec_update = mysqli_query($conectar, $sql_update);

if ($exec_update && mysqli_affected_rows($conectar) >= 0) {
    echo json_encode(['success' => true, 'mensaje' => 'Tienda actualizada correctamente', 'cod_tienda' => $cod_tienda, 'nombre_tienda' => $nombre_tienda]);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar la tienda: ' . mysqli_error($conectar)]);
}
?>
