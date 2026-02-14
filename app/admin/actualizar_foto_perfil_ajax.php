<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: application/json');

include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin_visitante_intern.php");

$response = array('success' => false, 'message' => '', 'url_foto' => '');
// Verificar que se reciba el ID del administrador
if (!isset($_POST['cod_administrador']) || empty($_POST['cod_administrador'])) { $response['message'] = 'Error: No se recibió el ID del usuario'; echo json_encode($response); exit; }
$cod_administrador                                            = mysqli_real_escape_string($conectar, $_POST['cod_administrador']);
// Verificar que se reciba el archivo
if (!isset($_FILES['foto_perfil']) || $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_OK) { $response['message'] = 'Error: No se recibió el archivo de imagen'; echo json_encode($response); exit; }
// Configuración de la subida
$archivo                                                        = $_FILES['foto_perfil'];
$nombre_archivo                                                 = $archivo['name'];
$tmp_archivo                                                    = $archivo['tmp_name'];
$tamano_archivo                                                 = $archivo['size'];
$tipo_archivo                                                   = $archivo['type'];
// Validar tipo de archivo
$tipos_permitidos                                               = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp');
if (!in_array($tipo_archivo, $tipos_permitidos)) { $response['message'] = 'Error: Tipo de archivo no permitido. Use JPG, PNG, GIF o WebP'; echo json_encode($response); exit; }
// Validar tamaño (máximo 5MB)
$tamano_maximo                                                  = 5 * 1024 * 1024; // 5MB
if ($tamano_archivo > $tamano_maximo) { $response['message'] = 'Error: El archivo es demasiado grande. Máximo 5MB'; echo json_encode($response); exit; }
// Crear directorio si no existe
$directorio_base_orig                                            = '../archivador/fotos_perfil/original/';
$directorio_base_min                                             = '../archivador/fotos_perfil/miniatura/';

if (!is_dir($directorio_base_orig)) { mkdir($directorio_base_orig, 0755, true); }
if (!is_dir($directorio_base_min)) { mkdir($directorio_base_min, 0755, true); }
// Generar nombre único
$extension                                                      = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
$nombre_nuevo                                                   = 'foto_perfil_orig_'.$cod_administrador.'_'.time().'.'.$extension;
$url_img_foto_prof_orig                                         = $directorio_base_orig.$nombre_nuevo;
// Mover archivo
if (move_uploaded_file($tmp_archivo, $url_img_foto_prof_orig)) {
    // Crear miniatura (opcional)
    $nombre_miniatura                                               = 'foto_perfil_min_'.$cod_administrador.'_'.time().'.'.$extension;
    $url_img_foto_prof_min                                          = $directorio_base_min.$nombre_miniatura;
    // Intentar crear miniatura
    $imagen_original                                                = null;
    switch (strtolower($extension)) {
        case 'jpg':
        case 'jpeg':
            $imagen_original                                          = @imagecreatefromjpeg($url_img_foto_prof_orig);
            break;
        case 'png':
            $imagen_original                                          = @imagecreatefrompng($url_img_foto_prof_orig);
            break;
        case 'gif':
            $imagen_original                                          = @imagecreatefromgif($url_img_foto_prof_orig);
            break;
        case 'webp':
            $imagen_original                                          = @imagecreatefromwebp($url_img_foto_prof_orig);
            break;
    }
    if ($imagen_original) {
        $ancho_original                                                 = imagesx($imagen_original);
        $alto_original                                                  = imagesy($imagen_original);
        // Tamaño miniatura: 150x150
        $ancho_miniatura                                                = 150;
        $alto_miniatura                                                 = 150;
        $miniatura                                                      = imagecreatetruecolor($ancho_miniatura, $alto_miniatura);
        // Mantener transparencia para PNG
        if (strtolower($extension) == 'png') { imagealphablending($miniatura, false); imagesavealpha($miniatura, true); }
        imagecopyresampled($miniatura, $imagen_original, 0, 0, 0, 0, $ancho_miniatura, $alto_miniatura, $ancho_original, $alto_original);
        
        switch (strtolower($extension)) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($miniatura, $url_img_foto_prof_min, 85);
                break;
            case 'png':
                imagepng($miniatura, $url_img_foto_prof_min, 8);
                break;
            case 'gif':
                imagegif($miniatura, $url_img_foto_prof_min);
                break;
            case 'webp':
                imagewebp($miniatura, $url_img_foto_prof_min, 85);
                break;
        }
        imagedestroy($imagen_original);
        imagedestroy($miniatura);
    } else {
        // Si no se puede crear miniatura, usar la imagen original
        $url_img_foto_prof_min = $url_img_foto_prof_orig;
    }
    // Actualizar en la base de datos
    $sql_actualizar = "UPDATE tbl15_administrador SET url_img_foto_prof_orig = '$url_img_foto_prof_orig', url_img_foto_prof_min = '$url_img_foto_prof_min' WHERE cod_administrador = '$cod_administrador'";
    if (mysqli_query($conectar, $sql_actualizar)) {
        $response['success'] = true;
        $response['message'] = 'Foto de perfil actualizada correctamente';
        $response['url_foto'] = $url_img_foto_prof_orig;
    } else {
        $response['message'] = 'Error al actualizar en la base de datos: ' . mysqli_error($conectar);
    }
} else {
    $response['message'] = 'Error al guardar el archivo en el servidor';
}
echo json_encode($response);
?>
