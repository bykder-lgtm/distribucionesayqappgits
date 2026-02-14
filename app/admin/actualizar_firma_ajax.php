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
// Validaciones
if ($cod_administrador <= 0) { $response['message'] = 'Usuario no válido'; echo json_encode($response); exit; }
// Verificar que se subió un archivo
if (!isset($_FILES['nueva_firma']) || $_FILES['nueva_firma']['error'] != 0) { $response['message'] = 'Por favor seleccione una imagen para la firma'; echo json_encode($response); exit; }
// Verificar que es una imagen válida
$tipos_permitidos                                               = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
if (!in_array($_FILES['nueva_firma']['type'], $tipos_permitidos)) { $response['message'] = 'Formato de imagen no válido. Use JPG, PNG, GIF o WebP'; echo json_encode($response); exit; }
// Verificar tamaño máximo (5MB)
$max_size                                                       = 5 * 1024 * 1024;
if ($_FILES['nueva_firma']['size'] > $max_size) { $response['message'] = 'La imagen es demasiado grande. Máximo 5MB'; echo json_encode($response); exit; }
// Directorio para guardar las firmas
$directorio_firmas                                              = '../archivador/firma/';
if (!file_exists($directorio_firmas)) { mkdir($directorio_firmas, 0777, true); }
// Generar nombre único para el archivo
$extension                                                      = pathinfo($_FILES['nueva_firma']['name'], PATHINFO_EXTENSION);
$nombre_archivo                                                 = 'firma_' . $cod_administrador . '_' . time() . '.' . $extension;
$ruta_firma                                                     = $directorio_firmas . $nombre_archivo;
// Mover el archivo subido
if (!move_uploaded_file($_FILES['nueva_firma']['tmp_name'], $ruta_firma)) { $response['message'] = 'Error al guardar la imagen'; echo json_encode($response); exit; }
// Actualizar en la base de datos
$sql_actualizar = "UPDATE tbl15_administrador SET url_img_firma_prof_ori = '".mysqli_real_escape_string($conectar, $ruta_firma)."' WHERE cod_administrador = '$cod_administrador'";
$resultado = mysqli_query($conectar, $sql_actualizar);

if ($resultado) {
    $response['success']                                        = true;
    $response['message']                                        = 'Firma actualizada correctamente';
    $response['url_firma']                                      = $ruta_firma;
} else {
    // Si falla la actualización, eliminar el archivo subido
    if (file_exists($ruta_firma)) { unlink($ruta_firma); }
    $response['message']                                        = 'Error al actualizar la firma: ' . mysqli_error($conectar);
}
mysqli_close($conectar);
echo json_encode($response);
?>
