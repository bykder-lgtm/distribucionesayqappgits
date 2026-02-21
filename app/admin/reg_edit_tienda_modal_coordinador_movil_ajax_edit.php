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

//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_tienda']) && !empty($_POST['cod_tienda'])) {

	$cod_tienda                                                     = intval($_POST['cod_tienda']);
	$identificacion_tercero                                         = addslashes($_POST['identificacion_tercero']);
	$nombre1_tercero                                                = trim(addslashes($_POST['nombre1_tercero']));
	$telefono1_tercero                                              = trim(addslashes($_POST['telefono1_tercero']));
	$correo_tercero                                                 = trim(addslashes($_POST['correo_tercero']));
	$direccion_tercero                                              = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $cod_estado                                                     = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
    $cod_aliado_estrategico                                         = intval($_POST['cod_aliado_estrategico']);
    $nombre_representante                                           = isset($_POST['nombre_representante']) ? trim(addslashes($_POST['nombre_representante'])) : '';
    $documento_representante                                        = isset($_POST['documento_representante']) ? intval($_POST['documento_representante']) : 0;
    $correo_representante                                           = isset($_POST['correo_representante']) ? trim(addslashes($_POST['correo_representante'])) : '';
    $cod_tipo_sector                                                = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
    $existe_rues                                                    = isset($_POST['existe_rues']) ? trim(addslashes($_POST['existe_rues'])) : '';
    $venta_presencial                                               = isset($_POST['venta_presencial']) ? trim(addslashes($_POST['venta_presencial'])) : '';
    $venta_online                                                   = isset($_POST['venta_online']) ? trim(addslashes($_POST['venta_online'])) : '';
    $nombre_plataforma_ecommerce                                    = isset($_POST['nombre_plataforma_ecommerce']) ? trim(addslashes($_POST['nombre_plataforma_ecommerce'])) : '';
    $nombre_sistema_contable                                        = isset($_POST['nombre_sistema_contable']) ? trim(addslashes($_POST['nombre_sistema_contable'])) : '';
    $cod_banco_cuenta                                               = isset($_POST['cod_banco_cuenta']) ? intval($_POST['cod_banco_cuenta']) : 0;
    $garantia_tienda                                                = isset($_POST['garantia_tienda']) ? trim(addslashes($_POST['garantia_tienda'])) : '';
	//---------------------------------------------------------------------------------------------------------------------------------//
	$nombre_tienda                                                  = $nombre1_tercero;
	//---------------------------------------------------------------------------------------------------------------------------------//
    
    // Verificar que la tienda existe y pertenece al aliado
    $sql_verif = "SELECT cod_tienda, cod_aliado_estrategico FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $exec_verif = mysqli_query($conectar, $sql_verif) or die(mysqli_error($conectar));
    
    if (mysqli_num_rows($exec_verif) == 0) {
        echo json_encode(['success' => false, 'mensaje' => 'Tienda no encontrada']);
        exit();
    }
    
    // Obtener datos actuales de la tienda para los archivos
    $tienda_actual = mysqli_fetch_assoc($exec_verif);
    
    // ========== PROCESAR IMAGEN LOGO DE LA TIENDA (SOLO SI SE SUBIÓ UNA NUEVA) ==========
    $img_logo = procesarImagen('imagen_tienda', '../archivador/img_tienda/orig/', '../archivador/img_tienda/min/');
    $url_img_orig_tienda = $img_logo['orig'];
    $url_img_min_tienda = $img_logo['min'];
    
    // ========== PROCESAR DOCUMENTACIÓN ==========
    $directorio_docs = '../archivador/documentacion_tienda/';
    $url_documentacion_rut_tienda = procesarArchivo('url_rut_tienda', $directorio_docs, 'rut_');
    $url_documentacion_camaracomercio_tienda = procesarArchivo('url_camara_comercio_tienda', $directorio_docs, 'camara_');
    
    // ========== PROCESAR IMÁGENES DEL ESTABLECIMIENTO ==========
    $directorio_imgs = '../archivador/img_establecimiento/';
    $url_img_fachada_tienda = procesarArchivo('url_img_fachada_tienda', $directorio_imgs, 'fachada_');
    $url_img_interna_tienda = procesarArchivo('url_img_interna_tienda', $directorio_imgs, 'interna_');
    $url_img_selfieadmin_tienda = procesarArchivo('url_img_selfieadmin_tienda', $directorio_imgs, 'selfie_');
    
    //---------------------------------------------------------------------------------------------------------------------------------//
    
    // Construir la parte dinámica del UPDATE
    $campos_update = array();
    $campos_update[] = "identificacion_tercero = '$identificacion_tercero'";
    $campos_update[] = "nombre_tienda = UPPER('$nombre_tienda')";
    $campos_update[] = "nombre1_tercero = UPPER('$nombre1_tercero')";
    $campos_update[] = "telefono1_tercero = '$telefono1_tercero'";
    $campos_update[] = "correo_tercero = '$correo_tercero'";
    $campos_update[] = "direccion_tercero = '$direccion_tercero'";
    $campos_update[] = "cod_estado = '$cod_estado'";
    $campos_update[] = "nombre_representante = UPPER('$nombre_representante')";
    $campos_update[] = "documento_representante = '$documento_representante'";
    $campos_update[] = "correo_representante = '$correo_representante'";
    $campos_update[] = "cod_tipo_sector = '$cod_tipo_sector'";
    $campos_update[] = "existe_rues = '$existe_rues'";
    $campos_update[] = "venta_presencial = '$venta_presencial'";
    $campos_update[] = "venta_online = '$venta_online'";
    $campos_update[] = "nombre_plataforma_ecommerce = '$nombre_plataforma_ecommerce'";
    $campos_update[] = "nombre_sistema_contable = '$nombre_sistema_contable'";
    $campos_update[] = "cod_banco_cuenta = '$cod_banco_cuenta'";
    $campos_update[] = "garantia_tienda = '$garantia_tienda'";
    
    // Solo actualizar archivos si se subieron nuevos
    if (!empty($url_img_orig_tienda)) {
        $campos_update[] = "url_img_orig_tienda = '$url_img_orig_tienda'";
        $campos_update[] = "url_img_min_tienda = '$url_img_min_tienda'";
    }
    if (!empty($url_documentacion_rut_tienda)) {
        $campos_update[] = "url_documentacion_rut_tienda = '$url_documentacion_rut_tienda'";
    }
    if (!empty($url_documentacion_camaracomercio_tienda)) {
        $campos_update[] = "url_documentacion_camaracomercio_tienda = '$url_documentacion_camaracomercio_tienda'";
    }
    if (!empty($url_img_fachada_tienda)) {
        $campos_update[] = "url_img_fachada_tienda = '$url_img_fachada_tienda'";
    }
    if (!empty($url_img_interna_tienda)) {
        $campos_update[] = "url_img_interna_tienda = '$url_img_interna_tienda'";
    }
    if (!empty($url_img_selfieadmin_tienda)) {
        $campos_update[] = "url_img_selfieadmin_tienda = '$url_img_selfieadmin_tienda'";
    }
    
    $sql_update = "UPDATE tbl15_tienda SET " . implode(', ', $campos_update) . " WHERE cod_tienda = '$cod_tienda'";
    
    $exec_update = mysqli_query($conectar, $sql_update);
    
    if ($exec_update && mysqli_affected_rows($conectar) >= 0) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Tienda actualizada correctamente',
            'cod_tienda' => $cod_tienda,
            'nombre_tienda' => $nombre_tienda
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Error al actualizar la tienda: ' . mysqli_error($conectar)
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Datos incompletos. El código de tienda es requerido.'
    ]);
}
?>
