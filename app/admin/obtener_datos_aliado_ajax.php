<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

$response = array('success' => false, 'message' => 'Error desconocido');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET') { $response['message'] = 'Método no permitido'; echo json_encode($response); exit; }

$cod_aliado = isset($_REQUEST['cod_aliado']) ? intval($_REQUEST['cod_aliado']) : 0;
if ($cod_aliado <= 0) { $response['message'] = 'Código de aliado no válido'; echo json_encode($response); exit; }

$sql = "SELECT cod_administrador, identificacion_tercero, telefono1_tercero, correo_tercero, direccion_tercero, barrio_tercero, cod_departamento, cod_municipio, cod_tipo_sector, cod_lider, cod_coordinador, cod_asesor FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado'";
$resultado = mysqli_query($conectar, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) { $response['message'] = 'Aliado no encontrado'; echo json_encode($response); exit; }
$aliado = mysqli_fetch_assoc($resultado);

$response['success'] = true;
$response['aliado'] = $aliado;

mysqli_close($conectar);
echo json_encode($response);
?>
