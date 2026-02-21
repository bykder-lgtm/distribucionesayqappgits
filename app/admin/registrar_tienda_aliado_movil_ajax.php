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
$identificacion_tercero                                         = isset($_POST['identificacion_tercero']) ? trim($_POST['identificacion_tercero']) : '';
$nombre_tienda                                                  = isset($_POST['nombre_tienda']) ? trim($_POST['nombre_tienda']) : '';
$direccion_tienda                                               = isset($_POST['direccion_tienda']) ? trim($_POST['direccion_tienda']) : '';
$telefono_tienda                                                = isset($_POST['telefono_tienda']) ? trim($_POST['telefono_tienda']) : '';
$correo_tercero                                                 = isset($_POST['correo_tercero']) ? trim($_POST['correo_tercero']) : '';
$ubicacion_gps_tienda                                           = isset($_POST['ubicacion_gps_tienda']) ? trim($_POST['ubicacion_gps_tienda']) : '';
$cod_aliado_estrategico                                         = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
$cod_departamento                                               = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
$cod_municipio                                                  = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
$barrio_tercero                                                 = isset($_POST['barrio_tercero']) ? trim($_POST['barrio_tercero']) : '';
$cod_tipo_sector                                                = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
$existe_rues                                                    = isset($_POST['existe_rues']) ? trim($_POST['existe_rues']) : '';
$venta_presencial                                               = isset($_POST['venta_presencial']) ? trim($_POST['venta_presencial']) : '';
$venta_online                                                   = isset($_POST['venta_online']) ? trim($_POST['venta_online']) : '';
$nombre_plataforma_ecommerce                                    = isset($_POST['nombre_plataforma_ecommerce']) ? trim($_POST['nombre_plataforma_ecommerce']) : '';
$nombre_sistema_contable                                        = isset($_POST['nombre_sistema_contable']) ? trim($_POST['nombre_sistema_contable']) : '';
$cod_administrador                                              = $cod_aliado_estrategico;
// Validaciones básicas
if (empty($nombre_tienda)) { $response['message'] = 'El nombre de la tienda es obligatorio'; echo json_encode($response); exit; }
if ($cod_aliado_estrategico <= 0) { $response['message'] = 'Error de sesión. Por favor recargue la página.'; echo json_encode($response); exit; }
if ($cod_departamento <= 0) { $response['message'] = 'El departamento es obligatorio'; echo json_encode($response); exit; }
if ($cod_municipio <= 0) { $response['message'] = 'El municipio es obligatorio'; echo json_encode($response); exit; }

$sql_autoincremento_tienda = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tienda'";
$exec_autoincremento_tienda = mysqli_query($conectar, $sql_autoincremento_tienda) or die(mysqli_error($conectar));
$datos_autoincremento_tienda = mysqli_fetch_assoc($exec_autoincremento_tienda);

$cod_tienda                                                     = $datos_autoincremento_tienda['AUTO_INCREMENT'];
$abrev_tienda                                                   = 'TIENDA'.$cod_tienda;
$nombre1_tercero                                                = $nombre_tienda;
// Verificar si ya existe una tienda con el mismo nombre para este aliado
$sql_verificar = "SELECT cod_tienda FROM tbl15_tienda WHERE nombre_tienda = ? AND cod_aliado_estrategico = ?";
$stmt_verificar = mysqli_prepare($conectar, $sql_verificar);
if ($stmt_verificar === false) { $response['message'] = 'Error en consulta de verificación: ' . mysqli_error($conectar); echo json_encode($response); exit; }
mysqli_stmt_bind_param($stmt_verificar, "si", $nombre_tienda, $cod_aliado_estrategico);
mysqli_stmt_execute($stmt_verificar);
$resultado_verificar = mysqli_stmt_get_result($stmt_verificar);
if (mysqli_num_rows($resultado_verificar) > 0) { mysqli_stmt_close($stmt_verificar); $response['message'] = 'Ya existe una tienda con este nombre'; echo json_encode($response); exit; }
mysqli_stmt_close($stmt_verificar);
// ========== FUNCIÓN PARA PROCESAR ARCHIVOS ==========
function procesarArchivo($file_key, $directorio, $prefijo = '') {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return ''; }
    if (!file_exists($directorio)) { mkdir($directorio, 0777, true); }
    $nombre_archivo = $prefijo . time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_archivo = $directorio . $nombre_archivo;
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
    if (!move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_orig)) { return array('orig' => '', 'min' => ''); }
    $ruta_min                                                       = '';
    if ($directorio_min) {
        $ruta_min                                                   = $directorio_min . $nombre_archivo;
        $tipo_imagen                                                = $_FILES[$file_key]['type'];
        $dimensiones                                                = getimagesize($ruta_orig);
        if ($dimensiones) {
            $ancho_orig                                             = $dimensiones[0];
            $alto_orig                                              = $dimensiones[1];
            $alto_nuevo                                             = ($alto_orig / $ancho_orig) * $ancho_min;
            $imagen_nueva                                           = imagecreatetruecolor($ancho_min, $alto_nuevo);
            
            switch ($tipo_imagen) {
                case 'image/jpeg':
                    $imagen_orig                                    = imagecreatefromjpeg($ruta_orig);
                    break;
                case 'image/png':
                    $imagen_orig                                    = imagecreatefrompng($ruta_orig);
                    imagealphablending($imagen_nueva, false);
                    imagesavealpha($imagen_nueva, true);
                    break;
                case 'image/gif':
                    $imagen_orig = imagecreatefromgif($ruta_orig);
                    break;
                case 'image/webp':
                    $imagen_orig                                    = imagecreatefromwebp($ruta_orig);
                    break;
                default:
                    $imagen_orig                                    = @imagecreatefromjpeg($ruta_orig);
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
$img_logo                                                       = procesarImagen('imagen_tienda', '../archivador/img_tienda/orig/', '../archivador/img_tienda/min/');
$url_img_orig_tienda                                            = $img_logo['orig'];
$url_img_min_tienda                                             = $img_logo['min'];
// ========== PROCESAR DOCUMENTACIÓN ==========
$directorio_docs                                                = '../archivador/documentacion_tienda/';
$url_documentacion_rut_tienda                                   = procesarArchivo('url_documentacion_rut_tienda', $directorio_docs, 'rut_');
$url_documentacion_camaracomercio_tienda                        = procesarArchivo('url_documentacion_camaracomercio_tienda', $directorio_docs, 'camara_');
$url_documentacion_contratofirma_tienda                         = procesarArchivo('url_documentacion_contratofirma_tienda', $directorio_docs, 'contrato_');
$url_documentacion_extra1_tienda                                = procesarArchivo('url_documentacion_extra1_tienda', $directorio_docs, 'extra_');
// ========== PROCESAR IMÁGENES DEL ESTABLECIMIENTO ==========
$directorio_imgs                                                = '../archivador/img_establecimiento/';
$url_img_fachada_tienda                                         = procesarArchivo('url_img_fachada_tienda', $directorio_imgs, 'fachada_');
$url_img_interna_tienda                                         = procesarArchivo('url_img_interna_tienda', $directorio_imgs, 'interna_');
$url_img_selfieadmin_tienda                                     = procesarArchivo('url_img_selfieadmin_tienda', $directorio_imgs, 'selfie_');
$url_img_otraopcional_tienda                                    = procesarArchivo('url_img_otraopcional_tienda', $directorio_imgs, 'otra_');
// Fecha de creación
$fecha_creacion                                                 = date('Y-m-d H:i:s');
$cod_estado                                                     = 1;
// Insertar nueva tienda con todos los campos nuevos
$sql_insertar = "INSERT INTO tbl15_tienda (nombre_tienda, nombre1_tercero, abrev_tienda, identificacion_tercero, direccion_tercero, barrio_tercero, telefono1_tercero, correo_tercero, ubicacion_gps_tienda, cod_aliado_estrategico, 
cod_departamento, cod_municipio, cod_estado, fecha_creacion, cod_tipo_sector, existe_rues, venta_presencial, venta_online, nombre_plataforma_ecommerce, nombre_sistema_contable,
url_img_orig_tienda, url_img_min_tienda, url_documentacion_rut_tienda, url_documentacion_camaracomercio_tienda,
url_documentacion_contratofirma_tienda, url_documentacion_extra1_tienda, url_img_fachada_tienda, url_img_interna_tienda, url_img_selfieadmin_tienda, url_img_otraopcional_tienda, cod_administrador) 
VALUES (UPPER(?), UPPER(?), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conectar, $sql_insertar);
if ($stmt === false) { $response['message'] = 'Error al preparar inserción: ' . mysqli_error($conectar); echo json_encode($response); mysqli_close($conectar); exit; }
mysqli_stmt_bind_param($stmt, "sssssssssiiiisisssssssssssssssi",
$nombre_tienda, $nombre1_tercero, $abrev_tienda, $identificacion_tercero, $direccion_tienda,
$barrio_tercero, $telefono_tienda, $correo_tercero, $ubicacion_gps_tienda,
$cod_aliado_estrategico, $cod_departamento, $cod_municipio, $cod_estado,
$fecha_creacion, $cod_tipo_sector,
$existe_rues, $venta_presencial, $venta_online, $nombre_plataforma_ecommerce, $nombre_sistema_contable,
$url_img_orig_tienda, $url_img_min_tienda, $url_documentacion_rut_tienda, $url_documentacion_camaracomercio_tienda,
$url_documentacion_contratofirma_tienda, $url_documentacion_extra1_tienda,
$url_img_fachada_tienda, $url_img_interna_tienda, $url_img_selfieadmin_tienda, $url_img_otraopcional_tienda, $cod_administrador);
if (mysqli_stmt_execute($stmt)) {
    $cod_tienda_nuevo = mysqli_insert_id($conectar);
    $response['success'] = true;
    $response['message'] = 'Tienda registrada exitosamente';
    $response['cod_tienda'] = $cod_tienda_nuevo;
} else {
    $response['message'] = 'Error al registrar la tienda: ' . mysqli_error($conectar);
}
mysqli_stmt_close($stmt);
mysqli_close($conectar);

echo json_encode($response);
?>
