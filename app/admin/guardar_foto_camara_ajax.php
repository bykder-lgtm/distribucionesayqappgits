<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");
include("../admin/class_php/class.upload.php");

$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                   = $_SESSION['usuario'];
$cod_administrador                                  = $_SESSION['cod_administrador'];
$cuenta                                             = $cuenta_visitante;
// Limpiar cualquier salida previa
ob_clean();
$retorno_array                                      = array();
$retorno_array2                                     = array();
$codigoHTML_menu                                    = '';
$codigoHTML_menu_total_reg                          = '';
$fecha_reg                                          = date('YmdHis');
$time                                               = time();
$fecha_ymdHis                                       = date("YmdHis");
$formato                                            = 'jpg';
$fecha_hora                                         = date("H:i:s");
$fecha_ymd                                          = date("Y-m-d");
$fecha_creacion                                     = date("Y-m-d");
// Configurar headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Función para crear thumbnail
function crearThumbnail($ruta_original, $ruta_thumbnail, $ancho_max = 300, $alto_max = 300, $calidad = 75) {
    try {
        // Obtener información de la imagen original
        $info_imagen                                                    = getimagesize($ruta_original);
        if (!$info_imagen) { return false; }
        $ancho_original                                                 = $info_imagen[0];
        $alto_original                                                  = $info_imagen[1];
        $tipo_imagen                                                    = $info_imagen[2];
        // Calcular nuevas dimensiones manteniendo proporción
        $ratio                                                          = min($ancho_max / $ancho_original, $alto_max / $alto_original);
        $nuevo_ancho                                                    = intval($ancho_original * $ratio);
        $nuevo_alto                                                     = intval($alto_original * $ratio);
        // Crear imagen desde archivo según tipo
        switch ($tipo_imagen) {
            case IMAGETYPE_JPEG: $imagen_original = imagecreatefromjpeg($ruta_original); break;
            case IMAGETYPE_PNG: $imagen_original = imagecreatefrompng($ruta_original); break;
            default: return false;
        }
        if (!$imagen_original) { return false; }
        // Crear nueva imagen con las dimensiones calculadas
        $imagen_thumbnail                                               = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        // Para PNG, preservar transparencia
        if ($tipo_imagen == IMAGETYPE_PNG) {
            imagealphablending($imagen_thumbnail, false);
            imagesavealpha($imagen_thumbnail, true);
            $transparente = imagecolorallocatealpha($imagen_thumbnail, 255, 255, 255, 127);
            imagefill($imagen_thumbnail, 0, 0, $transparente);
        }
        // Redimensionar la imagen
        imagecopyresampled($imagen_thumbnail, $imagen_original, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
        // Guardar thumbnail según tipo
        $resultado = false;
        switch ($tipo_imagen) {
            case IMAGETYPE_JPEG: $resultado = imagejpeg($imagen_thumbnail, $ruta_thumbnail, $calidad); break;
            // Para PNG, convertir calidad de 0-100 a 0-9
            case IMAGETYPE_PNG: $calidad_png = intval((100 - $calidad) / 10); $resultado = imagepng($imagen_thumbnail, $ruta_thumbnail, $calidad_png); break;
        }
        // Liberar memoria
        imagedestroy($imagen_original);
        imagedestroy($imagen_thumbnail);
        return $resultado;
    } catch (Exception $e) {
        error_log("Error creando thumbnail: " . $e->getMessage());
        return false;
    }
}
// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success' => false, 'message' => 'Método no permitido']); exit; }

try {
    if (isset($_POST['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_POST['cod_info_factura_venta']); } else { $cod_info_factura_venta = 0; }
    if (isset($_POST['cod_tercero'])) { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = 0; }
    if (isset($_POST['cod_tipo_metodo_aprobacion'])) { $cod_tipo_metodo_aprobacion = intval($_POST['cod_tipo_metodo_aprobacion']); } else { $cod_tipo_metodo_aprobacion = 0; }
    if (isset($_POST['cod_nota_observacion'])) { $cod_nota_observacion = intval($_POST['cod_nota_observacion']); } else { $cod_nota_observacion = 0; }

    $calcular_datos_cuenta_cobrar = "SELECT cod_tercero FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];

    $datos_data_info_factura = "SELECT identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $codigo_estado_revision                                         = 1; //POR REVISAR
    // Log de depuración
    error_log("POST data received: " . print_r($_POST, true));
    error_log("FILES data received: " . print_r($_FILES, true));
    // Verificar que se envió una url_img1
    if (!isset($_FILES['url_img1'])) { throw new Exception('No se recibió el campo url_img1'); }
    // Configuración del directorio de destino
    $directorio_fotos_original                                      = '../archivador/fotos_camara/orig/';
    $directorio_fotos_thumbnail                                     = '../archivador/fotos_camara/min/';
    // Crear el directorio original si no existe
    if (!file_exists($directorio_fotos_original)) { if (!mkdir($directorio_fotos_original, 0755, true)) { throw new Exception('No se pudo crear el directorio de fotos original: '.$directorio_fotos_original); } }
    // Crear el directorio minificado si no existe
    if (!file_exists($directorio_fotos_thumbnail)) { if (!mkdir($directorio_fotos_thumbnail, 0755, true)) { throw new Exception('No se pudo crear el directorio de fotos minificado: '.$directorio_fotos_thumbnail); } }
    // Verificar permisos de escritura
    if (!is_writable($directorio_fotos_original)) { throw new Exception('No hay permisos de escritura en el directorio: ' . $directorio_fotos_original); }
    // Información del archivo
    $archivo_temporal                                               = $_FILES['url_img1']['tmp_name'];
    $tipo_archivo                                                   = $_FILES['url_img1']['type'];
    $tamaño_archivo                                                 = $_FILES['url_img1']['size'];
    // Validar que el archivo temporal existe
    if (!file_exists($archivo_temporal)) { throw new Exception('El archivo temporal no existe'); }
    // Validar tamaño del archivo (máximo 10MB)
    if ($tamaño_archivo > 10 * 1024 * 1024) { throw new Exception('El archivo es demasiado grande. Máximo 10MB permitido'); }
    // Validar tipo de archivo
    $tipos_permitidos                                               = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($tipo_archivo, $tipos_permitidos)) { throw new Exception('Tipo de archivo no permitido: '.$tipo_archivo.'. Solo se permiten JPG, JPEG y PNG'); }
    // Generar nombre único para el archivo
    $timestamp                                                      = date('Y-m-d_H-i-s');
    $extension                                                      = pathinfo($_FILES['url_img1']['name'], PATHINFO_EXTENSION);
    // Extensión por defecto
    if (empty($extension)) { $extension = 'jpg'; }

    $nombre_archivo_original                                        = "foto_{$cod_info_factura_venta}_{$cod_tercero}_{$cod_nota_observacion}_{$fecha_reg}_orig.{$extension}";
    $ruta_completa_original                                         = $directorio_fotos_original.$nombre_archivo_original;
    // Mover el archivo al directorio de destino
    if (!move_uploaded_file($archivo_temporal, $ruta_completa_original)) { throw new Exception('Error al guardar el archivo en: '.$ruta_completa_original); }
    // Verificar que el archivo se guardó correctamente
    if (!file_exists($ruta_completa_original)) { throw new Exception('El archivo no se guardó correctamente'); }
    // Crear thumbnail (imagen minificada)
    $nombre_archivo_thumbnail                                       = "foto_{$cod_info_factura_venta}_{$cod_tercero}_{$cod_nota_observacion}_{$fecha_reg}_mini.{$extension}";
    $ruta_completa_thumbnail                                        = $directorio_fotos_thumbnail.$nombre_archivo_thumbnail;
    // Generar thumbnail con calidad reducida y tamaño menor
    if (crearThumbnail($ruta_completa_original, $ruta_completa_thumbnail, 300, 300, 75)) {
        $thumbnail_creado = true;
        $tamaño_thumbnail = filesize($ruta_completa_thumbnail);
    } else {
        $thumbnail_creado = false;
        $tamaño_thumbnail = 0;
        error_log("Warning: No se pudo crear el thumbnail para: " . $nombre_archivo_original);
    }
    // Obtener información del archivo guardado
    $tamaño_archivo_guardado                                        = filesize($ruta_completa_original);
    $url_archivo_original                                           = $directorio_fotos_original.$nombre_archivo_original;
    //error_log("Archivo guardado exitosamente: ".$ruta_completa." (Tamaño: ".$tamaño_archivo_guardado." bytes)");
    // Respuesta exitosa
    $url_img_orig_producto                                          = $ruta_completa_original;
    $url_img_min_producto                                           = $ruta_completa_thumbnail;

    $sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', cuenta = '$cuenta', 
    cod_administrador = '$cod_administrador', codigo_estado_revision = '$codigo_estado_revision', url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto'
    WHERE (cod_nota_observacion = '$cod_nota_observacion')");
    $resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

    $respuesta = [
        'success' => true,
        'message' => 'Foto guardada exitosamente',
        'url' => $directorio_fotos_thumbnail.$nombre_archivo_thumbnail,
        'original' => [
            'filename' => $nombre_archivo_original,
            'url' => $url_archivo_original,
            'size' => $tamaño_archivo_guardado
        ],
        'thumbnail' => [
            'created' => $thumbnail_creado,
            'filename' => $thumbnail_creado ? $nombre_archivo_thumbnail : null,
            'url' => $thumbnail_creado ? $directorio_fotos_thumbnail.$nombre_archivo_thumbnail : null,
            'size' => $tamaño_thumbnail
        ],
        'cod_info_factura_venta' => $cod_info_factura_venta,
        'cod_tercero' => $cod_tercero,
        'cod_nota_observacion' => $cod_nota_observacion,
        'cod_tipo_metodo_aprobacion' => $cod_tipo_metodo_aprobacion,
        //'path' => $ruta_completa,
        'timestamp' => $timestamp
    ];
    
    echo json_encode($respuesta);
    
} catch (Exception $e) {
    // Log del error
    error_log("Error en guardar_foto_camara.php: " . $e->getMessage());
    
    // Respuesta de error
    http_response_code(400);
    $respuesta = [
        'success' => false,
        'message' => $e->getMessage(),
        'cod_info_factura_venta' => $cod_info_factura_venta,
        'cod_nota_observacion' => $cod_nota_observacion,
        'cod_tercero' => $cod_tercero,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    echo json_encode($respuesta);
} catch (Error $e) {
    // Capturar errores fatales también
    error_log("Error fatal en guardar_foto_camara.php: " . $e->getMessage());
    
    http_response_code(500);
    $respuesta = [
        'success' => false,
        'message' => 'Error interno del servidor: ' . $e->getMessage(),
        'cod_info_factura_venta' => $cod_info_factura_venta,
        'cod_nota_observacion' => $cod_nota_observacion,
        'cod_tercero' => $cod_tercero,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    echo json_encode($respuesta);
}
/*
header('Content-Type: application/json');
$datos_array['success'] = true;
$datos_array['url'] = "url archivo";
$datos_array['message'] = "Foto guardada exitosamente";
echo json_encode($datos_array);
*/
?>