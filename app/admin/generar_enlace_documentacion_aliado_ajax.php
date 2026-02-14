<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(array('success' => false, 'mensaje' => 'Método no permitido')); exit; }
// Verificar sesión activa
if (isset($_SESSION['cod_administrador'])) { echo json_encode(array('success' => false, 'mensaje' => 'Sesión no válida')); exit; }
// Obtener código del aliado
$cod_administrador = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
if ($cod_administrador <= 0) { echo json_encode(array('success' => false, 'mensaje' => 'Código de aliado no válido')); exit; }

// Verificar que el aliado existe
$sql_verificar = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$result = mysqli_query($conectar, $sql_verificar);
if (!$result || mysqli_num_rows($result) === 0) { echo json_encode(array('success' => false, 'mensaje' => 'Aliado no encontrado')); exit; }
// Construir la URL del formulario público
// Detectar el protocolo (http o https)
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
// Obtener la ruta base de la aplicación
$script_path = dirname($_SERVER['SCRIPT_NAME']);
$base_path = dirname($script_path); // Subir un nivel desde /admin
// Construir enlace completo
$enlace = $protocol . '://' . $host . $base_path . '/admin/formulario_documentacion_aliado_publico.php?token=' . $token;
echo json_encode(array('success' => true, 'enlace' => $enlace, 'token' => $token, 'nombre_aliado' => $aliado['nombres_apellidos_tercero']));
mysqli_close($conectar);
?>
