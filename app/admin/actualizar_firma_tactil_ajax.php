<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Inicializar respuesta
$response = array('success' => false, 'message' => 'Error desconocido');
// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $response['message'] = 'Método no permitido'; echo json_encode($response); exit; }
// Recibir parámetros
$cod_administrador                                              = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
$firma_base64                                                   = isset($_POST['firma_base64']) ? $_POST['firma_base64'] : '';
// Validaciones
if ($cod_administrador <= 0) { $response['message'] = 'Usuario no válido'; echo json_encode($response); exit; }
if (empty($firma_base64)) { $response['message'] = 'No se recibió la firma'; echo json_encode($response); exit; }
// Verificar que es una imagen base64 válida
if (strpos($firma_base64, 'data:image/') !== 0) { $response['message'] = 'Formato de firma no válido'; echo json_encode($response); exit; }
// Directorio para guardar las firmas
$directorio_firmas                                              = '../archivador/firma/';
if (!file_exists($directorio_firmas)) { mkdir($directorio_firmas, 0777, true); }
// Extraer los datos de la imagen
$partes                                                         = explode(',', $firma_base64);
if (count($partes) != 2) { $response['message'] = 'Datos de imagen corruptos'; echo json_encode($response); exit; }

$tipo_imagen                                                    = 'png';
if (strpos($partes[0], 'image/jpeg') !== false) { $tipo_imagen = 'jpg'; }
elseif (strpos($partes[0], 'image/gif') !== false) { $tipo_imagen = 'gif'; }
elseif (strpos($partes[0], 'image/webp') !== false) { $tipo_imagen = 'webp'; }

$datos_imagen                                                   = base64_decode($partes[1]);
if ($datos_imagen === false) { $response['message'] = 'Error al decodificar la imagen'; echo json_encode($response); exit; }
// Generar nombre único para el archivo
$nombre_archivo                                                 = 'firma_tactil_' . $cod_administrador . '_' . time() . '.' . $tipo_imagen;
$ruta_firma                                                     = $directorio_firmas . $nombre_archivo;
// Guardar el archivo
if (file_put_contents($ruta_firma, $datos_imagen) === false) { $response['message'] = 'Error al guardar la firma'; echo json_encode($response); exit; }
// Actualizar en la base de datos
$sql_actualizar                                                 = "UPDATE tbl15_administrador SET url_img_firma_prof_ori = '" . mysqli_real_escape_string($conectar, $ruta_firma) . "' WHERE cod_administrador = '$cod_administrador'";
$resultado                                                      = mysqli_query($conectar, $sql_actualizar);
if ($resultado) {
    $response['success']                                        = true;
    $response['message']                                        = 'Firma táctil guardada correctamente';
    $response['url_firma']                                      = $ruta_firma;
} else {
    // Si falla la actualización, eliminar el archivo
    if (file_exists($ruta_firma)) { unlink($ruta_firma); }
    $response['message']                                        = 'Error al actualizar la firma: ' . mysqli_error($conectar);
}
mysqli_close($conectar);
echo json_encode($response);
?>
