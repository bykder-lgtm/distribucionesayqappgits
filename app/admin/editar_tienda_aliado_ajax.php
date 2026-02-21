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
$cod_tienda                                                     = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
$nombre_tienda                                                  = isset($_POST['nombre_tienda']) ? trim($_POST['nombre_tienda']) : '';
$identificacion_tercero                                         = isset($_POST['identificacion_tercero']) ? trim($_POST['identificacion_tercero']) : '';
$direccion_tienda                                               = isset($_POST['direccion_tienda']) ? trim($_POST['direccion_tienda']) : '';
$telefono_tienda                                                = isset($_POST['telefono_tienda']) ? trim($_POST['telefono_tienda']) : '';
$correo_tercero                                                 = isset($_POST['correo_tercero']) ? trim($_POST['correo_tercero']) : '';
$ubicacion_gps_tienda                                           = isset($_POST['ubicacion_gps_tienda']) ? trim($_POST['ubicacion_gps_tienda']) : '';
$barrio_tercero                                                 = isset($_POST['barrio_tercero']) ? trim($_POST['barrio_tercero']) : '';
$cod_estado                                                     = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
$cod_tipo_sector                                                = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
$existe_rues                                                    = isset($_POST['existe_rues']) ? trim($_POST['existe_rues']) : '';
$venta_presencial                                               = isset($_POST['venta_presencial']) ? trim($_POST['venta_presencial']) : '';
$venta_online                                                   = isset($_POST['venta_online']) ? trim($_POST['venta_online']) : '';
$nombre_plataforma_ecommerce                                    = isset($_POST['nombre_plataforma_ecommerce']) ? trim($_POST['nombre_plataforma_ecommerce']) : '';
$nombre_sistema_contable                                        = isset($_POST['nombre_sistema_contable']) ? trim($_POST['nombre_sistema_contable']) : '';
$nombre1_tercero                                                = $nombre_tienda;
// Validaciones
if ($cod_tienda <= 0) { $response['message'] = 'Código de tienda no válido'; echo json_encode($response); exit; }
if (empty($nombre_tienda)) { $response['message'] = 'El nombre de la tienda es obligatorio'; echo json_encode($response); exit; }
// Verificar que la tienda existe y obtener datos actuales
$sql_verificar = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
$resultado_verificar = mysqli_query($conectar, $sql_verificar);
if (mysqli_num_rows($resultado_verificar) == 0) { $response['message'] = 'Tienda no encontrada'; echo json_encode($response); exit; }
$tienda_actual = mysqli_fetch_assoc($resultado_verificar);
// ========== FUNCIÓN PARA PROCESAR ARCHIVOS ==========
function procesarArchivo($file_key, $directorio, $prefijo = '') {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return ''; }
    if (!file_exists($directorio)) { mkdir($directorio, 0777, true); }
    $nombre_archivo                                                 = $prefijo . time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_archivo                                                   = $directorio . $nombre_archivo;
    if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_archivo)) { return $ruta_archivo; }
    return '';
}
// ========== FUNCIÓN PARA PROCESAR IMÁGENES CON MINIATURA ==========
function procesarImagen($file_key, $directorio_orig, $directorio_min = null, $ancho_min = 200) {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return array('orig' => '', 'min' => ''); }
    if (!file_exists($directorio_orig)) { mkdir($directorio_orig, 0777, true); }
    if ($directorio_min && !file_exists($directorio_min)) { mkdir($directorio_min, 0777, true); }
    $nombre_archivo                                                 = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_orig                                                      = $directorio_orig . $nombre_archivo;

    if (!move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_orig)) {return array('orig' => '', 'min' => ''); }
    
    $ruta_min = '';
    if ($directorio_min) {
        $ruta_min                                                       = $directorio_min.$nombre_archivo;
        $tipo_imagen                                                    = $_FILES[$file_key]['type'];
        $dimensiones                                                    = getimagesize($ruta_orig);
        if ($dimensiones) {
            $ancho_orig                                                 = $dimensiones[0];
            $alto_orig                                                  = $dimensiones[1];
            $alto_nuevo                                                 = ($alto_orig / $ancho_orig) * $ancho_min;
            $imagen_nueva                                               = imagecreatetruecolor($ancho_min, $alto_nuevo);
            
            switch ($tipo_imagen) {
                case 'image/jpeg':
                    $imagen_orig = imagecreatefromjpeg($ruta_orig);
                    break;
                case 'image/png':
                    $imagen_orig = imagecreatefrompng($ruta_orig);
                    imagealphablending($imagen_nueva, false);
                    imagesavealpha($imagen_nueva, true);
                    break;
                case 'image/gif':
                    $imagen_orig = imagecreatefromgif($ruta_orig);
                    break;
                case 'image/webp':
                    $imagen_orig = imagecreatefromwebp($ruta_orig);
                    break;
                default:
                    $imagen_orig = @imagecreatefromjpeg($ruta_orig);
            }
            if ($imagen_orig) {
                imagecopyresampled($imagen_nueva, $imagen_orig, 0, 0, 0, 0, $ancho_min, $alto_nuevo, $ancho_orig, $alto_orig);
                
                switch ($tipo_imagen) {
                    case 'image/png':
                        imagepng($imagen_nueva, $ruta_min);
                        break;
                    case 'image/gif':
                        imagegif($imagen_nueva, $ruta_min);
                        break;
                    default:
                        imagejpeg($imagen_nueva, $ruta_min, 85);
                }
                imagedestroy($imagen_orig);
                imagedestroy($imagen_nueva);
            }
        }
    }
    return array('orig' => $ruta_orig, 'min' => $ruta_min);
}
// ========== PROCESAR IMAGEN LOGO DE LA TIENDA ==========
// Mantener valores actuales por defecto
$url_img_orig_tienda                                            = isset($tienda_actual['url_img_orig_tienda']) ? $tienda_actual['url_img_orig_tienda'] : '';
$url_img_min_tienda                                             = isset($tienda_actual['url_img_min_tienda']) ? $tienda_actual['url_img_min_tienda'] : '';

if (isset($_FILES['imagen_tienda']) && $_FILES['imagen_tienda']['error'] == 0) { $img_logo = procesarImagen('imagen_tienda', '../archivador/img_tienda/orig/', '../archivador/img_tienda/min/'); if (!empty($img_logo['orig'])) { $url_img_orig_tienda = $img_logo['orig']; $url_img_min_tienda = $img_logo['min']; } }
// ========== PROCESAR DOCUMENTACIÓN ==========
$directorio_docs                                                = '../archivador/documentacion_tienda/';
// Mantener valores actuales o actualizar si se sube nuevo archivo
$url_documentacion_rut_tienda                                   = isset($tienda_actual['url_documentacion_rut_tienda']) ? $tienda_actual['url_documentacion_rut_tienda'] : '';
$nuevo_rut                                                      = procesarArchivo('url_documentacion_rut_tienda', $directorio_docs, 'rut_');
if (!empty($nuevo_rut)) { $url_documentacion_rut_tienda = $nuevo_rut; }

$url_documentacion_camaracomercio_tienda                        = isset($tienda_actual['url_documentacion_camaracomercio_tienda']) ? $tienda_actual['url_documentacion_camaracomercio_tienda'] : '';
$nuevo_camara                                                   = procesarArchivo('url_documentacion_camaracomercio_tienda', $directorio_docs, 'camara_');
if (!empty($nuevo_camara)) { $url_documentacion_camaracomercio_tienda = $nuevo_camara; }

$url_documentacion_contratofirma_tienda                         = isset($tienda_actual['url_documentacion_contratofirma_tienda']) ? $tienda_actual['url_documentacion_contratofirma_tienda'] : '';
$nuevo_contrato                                                 = procesarArchivo('url_documentacion_contratofirma_tienda', $directorio_docs, 'contrato_');
if (!empty($nuevo_contrato)) { $url_documentacion_contratofirma_tienda = $nuevo_contrato; }

$url_documentacion_extra1_tienda                                = isset($tienda_actual['url_documentacion_extra1_tienda']) ? $tienda_actual['url_documentacion_extra1_tienda'] : '';
$nuevo_extra                                                    = procesarArchivo('url_documentacion_extra1_tienda', $directorio_docs, 'extra_');
if (!empty($nuevo_extra)) { $url_documentacion_extra1_tienda = $nuevo_extra; }
// ========== PROCESAR IMÁGENES DEL ESTABLECIMIENTO ==========
$directorio_imgs                                                = '../archivador/img_establecimiento/';

$url_img_fachada_tienda                                         = isset($tienda_actual['url_img_fachada_tienda']) ? $tienda_actual['url_img_fachada_tienda'] : '';
$nuevo_fachada                                                  = procesarArchivo('url_img_fachada_tienda', $directorio_imgs, 'fachada_');
if (!empty($nuevo_fachada)) { $url_img_fachada_tienda = $nuevo_fachada; }

$url_img_interna_tienda                                         = isset($tienda_actual['url_img_interna_tienda']) ? $tienda_actual['url_img_interna_tienda'] : '';
$nuevo_interna                                                  = procesarArchivo('url_img_interna_tienda', $directorio_imgs, 'interna_');
if (!empty($nuevo_interna)) { $url_img_interna_tienda = $nuevo_interna; }

$url_img_selfieadmin_tienda                                     = isset($tienda_actual['url_img_selfieadmin_tienda']) ? $tienda_actual['url_img_selfieadmin_tienda'] : '';
$nuevo_selfie                                                   = procesarArchivo('url_img_selfieadmin_tienda', $directorio_imgs, 'selfie_');
if (!empty($nuevo_selfie)) { $url_img_selfieadmin_tienda = $nuevo_selfie; }

$url_img_otraopcional_tienda                                    = isset($tienda_actual['url_img_otraopcional_tienda']) ? $tienda_actual['url_img_otraopcional_tienda'] : '';
$nuevo_otra                                                     = procesarArchivo('url_img_otraopcional_tienda', $directorio_imgs, 'otra_');
if (!empty($nuevo_otra)) { $url_img_otraopcional_tienda = $nuevo_otra; }
// Preparar valores
$nombre_tienda_upper                                            = strtoupper($nombre_tienda);
// Actualizar tienda
$sql_actualizar = "UPDATE tbl15_tienda SET 
nombre_tienda = '" . mysqli_real_escape_string($conectar, $nombre_tienda_upper) . "',
nombre1_tercero = '" . mysqli_real_escape_string($conectar, $nombre_tienda_upper) . "',
identificacion_tercero = '" . mysqli_real_escape_string($conectar, $identificacion_tercero) . "',
direccion_tercero = '" . mysqli_real_escape_string($conectar, $direccion_tienda) . "',
barrio_tercero = '" . mysqli_real_escape_string($conectar, $barrio_tercero) . "',
telefono1_tercero = '" . mysqli_real_escape_string($conectar, $telefono_tienda) . "',
correo_tercero = '" . mysqli_real_escape_string($conectar, $correo_tercero) . "',
ubicacion_gps_tienda = '" . mysqli_real_escape_string($conectar, $ubicacion_gps_tienda) . "',
cod_estado = '$cod_estado',
url_img_orig_tienda = '" . mysqli_real_escape_string($conectar, $url_img_orig_tienda) . "',
url_img_min_tienda = '" . mysqli_real_escape_string($conectar, $url_img_min_tienda) . "',
url_documentacion_rut_tienda = '" . mysqli_real_escape_string($conectar, $url_documentacion_rut_tienda) . "',
url_documentacion_camaracomercio_tienda = '" . mysqli_real_escape_string($conectar, $url_documentacion_camaracomercio_tienda) . "',
url_documentacion_contratofirma_tienda = '" . mysqli_real_escape_string($conectar, $url_documentacion_contratofirma_tienda) . "',
url_documentacion_extra1_tienda = '" . mysqli_real_escape_string($conectar, $url_documentacion_extra1_tienda) . "',
url_img_fachada_tienda = '" . mysqli_real_escape_string($conectar, $url_img_fachada_tienda) . "',
url_img_interna_tienda = '" . mysqli_real_escape_string($conectar, $url_img_interna_tienda) . "',
url_img_selfieadmin_tienda = '" . mysqli_real_escape_string($conectar, $url_img_selfieadmin_tienda) . "',
url_img_otraopcional_tienda = '" . mysqli_real_escape_string($conectar, $url_img_otraopcional_tienda) . "',
cod_tipo_sector = '" . intval($cod_tipo_sector) . "',
existe_rues = '" . mysqli_real_escape_string($conectar, $existe_rues) . "',
venta_presencial = '" . mysqli_real_escape_string($conectar, $venta_presencial) . "',
venta_online = '" . mysqli_real_escape_string($conectar, $venta_online) . "',
nombre_plataforma_ecommerce = '" . mysqli_real_escape_string($conectar, $nombre_plataforma_ecommerce) . "',
nombre_sistema_contable = '" . mysqli_real_escape_string($conectar, $nombre_sistema_contable) . "'
WHERE cod_tienda = '$cod_tienda'";
$resultado = mysqli_query($conectar, $sql_actualizar);
if ($resultado) { $response['success'] = true; $response['message'] = 'Tienda actualizada exitosamente'; } else { $response['message'] = 'Error al actualizar la tienda: ' . mysqli_error($conectar); }

mysqli_close($conectar);
echo json_encode($response);
?>
