<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Inicializar respuesta
$response = array('success' => false, 'message' => 'Error desconocido');
// Verificar método GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') { $response['message'] = 'Método no permitido'; echo json_encode($response); exit; }
// Recibir parámetro
$cod_tienda = isset($_GET['cod_tienda']) ? intval($_GET['cod_tienda']) : 0;
// Validaciones
if ($cod_tienda <= 0) { $response['message'] = 'Código de tienda no válido'; echo json_encode($response); exit; }
// Consultar tienda con todos los campos nuevos
$sql_tienda = "SELECT cod_tienda, nombre_tienda, identificacion_tercero, abrev_tienda, direccion_tercero, telefono1_tercero, correo_tercero, ubicacion_gps_tienda, cod_estado, url_img_orig_tienda, 
url_img_min_tienda, url_documentacion_rut_tienda, url_documentacion_camaracomercio_tienda, url_documentacion_contratofirma_tienda, url_documentacion_extra1_tienda,
url_img_fachada_tienda, url_img_interna_tienda, url_img_selfieadmin_tienda, url_img_otraopcional_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
$resultado = mysqli_query($conectar, $sql_tienda);
if (!$resultado || mysqli_num_rows($resultado) == 0) { $response['message'] = 'Tienda no encontrada'; echo json_encode($response); exit; }
$tienda = mysqli_fetch_assoc($resultado);

$response['success'] = true;
$response['tienda'] = $tienda;

mysqli_close($conectar);
echo json_encode($response);
?>
