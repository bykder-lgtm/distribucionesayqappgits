<?php
// Endpoint para actualizar el estado de revisión de una imagen
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

$cod_administrador                                              = $_SESSION['cod_administrador'];
$cuenta                                                         = $_SESSION['usuario'];
// Función para crear thumbnail
function crearThumbnail($source, $dest, $targetWidth, $targetHeight, $quality = 85) {
    // Verificar que el archivo fuente existe
    if (!file_exists($source)) { return false; }
    // Obtener información de la imagen
    $imageInfo = getimagesize($source);
    if ($imageInfo === false) { return false; }

    $originalWidth = $imageInfo[0];
    $originalHeight = $imageInfo[1];
    $type = $imageInfo[2];

    // Calcular nuevas dimensiones manteniendo la proporción
    $ratio = min($targetWidth / $originalWidth, $targetHeight / $originalHeight);
    $newWidth = (int)($originalWidth * $ratio);
    $newHeight = (int)($originalHeight * $ratio);

    // Crear imagen desde el archivo fuente según su tipo
    switch ($type) {
        case IMAGETYPE_JPEG: $source_image = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG: $source_image = imagecreatefrompng($source);
            break;
        case IMAGETYPE_GIF: $source_image = imagecreatefromgif($source);
            break;
        default: return false;
    }
    if (!$source_image) { return false; }
    // Crear nueva imagen con las dimensiones calculadas
    $destination_image = imagecreatetruecolor($newWidth, $newHeight);

    // Para PNG con transparencia
    if ($type == IMAGETYPE_PNG) {
        imagealphablending($destination_image, false);
        imagesavealpha($destination_image, true);
        $transparent = imagecolorallocatealpha($destination_image, 255, 255, 255, 127);
        imagefill($destination_image, 0, 0, $transparent);
    }
    // Redimensionar la imagen
    imagecopyresampled($destination_image, $source_image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    // Guardar la imagen redimensionada
    $result = false;
    switch ($type) { case IMAGETYPE_JPEG:
            $result = imagejpeg($destination_image, $dest, $quality);
            break;
        case IMAGETYPE_PNG: $result = imagepng($destination_image, $dest, (int)((100 - $quality) / 10));
            break;
        case IMAGETYPE_GIF:  $result = imagegif($destination_image, $dest);
            break;
    }
    // Liberar memoria
    imagedestroy($source_image);
    imagedestroy($destination_image);
    return $result;
}

try {
    // Variables de fecha y hora
    $fecha_ymdHis                                                   = date('Y-m-d H:i:s');
    $fecha_ymd                                                      = date('Y-m-d');
    $fecha_reg                                                      = date('YmdHis');
    $fecha_hora                                                     = date('H:i:s');

    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { throw new Exception('Método no permitido'); }
    // Verificar sesión activa
    if (!isset($_SESSION['cod_administrador'])) { throw new Exception('Sesión no válida'); }
    // Obtener y validar parámetros
    if (!isset($_POST['cod_nota_observacion']) || empty($_POST['cod_nota_observacion'])) { throw new Exception('Código de nota observación requerido'); }

    $cod_nota_observacion                                           = (int)$_POST['cod_nota_observacion'];
    $cod_info_factura_venta                                         = isset($_POST['cod_info_factura_venta']) ? (int)$_POST['cod_info_factura_venta'] : 0;
    $cod_tercero                                                    = isset($_POST['cod_tercero']) ? (int)$_POST['cod_tercero'] : 0;
    $cod_tipo_metodo_aprobacion                                     = 2; // REVISIÓN MANUAL
    $codigo_estado_revision                                         = 1; // POR REVISAR
    // Log de depuración
    error_log("POST data received: " . print_r($_POST, true));
    error_log("FILES data received: " . print_r($_FILES, true));
    // Verificar que se envió una imagen
    if (!isset($_FILES['imagen'])) { throw new Exception('No se recibió el campo imagen'); }
    // Configuración del directorio de destino
    $directorio_fotos_original                                      = '../archivador/fotos_notas_observacion/orig/';
    $directorio_fotos_thumbnail                                     = '../archivador/fotos_notas_observacion/min/';
    // Crear el directorio original si no existe
    if (!file_exists($directorio_fotos_original)) { if (!mkdir($directorio_fotos_original, 0755, true)) { throw new Exception('No se pudo crear el directorio de fotos original: '.$directorio_fotos_original); } }
    // Crear el directorio minificado si no existe
    if (!file_exists($directorio_fotos_thumbnail)) { if (!mkdir($directorio_fotos_thumbnail, 0755, true)) { throw new Exception('No se pudo crear el directorio de fotos minificado: '.$directorio_fotos_thumbnail); } }
    // Verificar permisos de escritura
    if (!is_writable($directorio_fotos_original)) { throw new Exception('No hay permisos de escritura en el directorio: ' . $directorio_fotos_original); }
    // Información del archivo
    $archivo_temporal                                               = $_FILES['imagen']['tmp_name'];
    $tipo_archivo                                                   = $_FILES['imagen']['type'];
    $tamaño_archivo                                                 = $_FILES['imagen']['size'];
    // Validar que el archivo temporal existe
    if (!file_exists($archivo_temporal)) { throw new Exception('El archivo temporal no existe'); }
    // Validar tamaño del archivo (máximo 10MB)
    if ($tamaño_archivo > 10 * 1024 * 1024) { throw new Exception('El archivo es demasiado grande. Máximo 10MB permitido'); }
    // Validar tipo de archivo
    $tipos_permitidos                                               = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($tipo_archivo, $tipos_permitidos)) { throw new Exception('Tipo de archivo no permitido: '.$tipo_archivo.'. Solo se permiten JPG, JPEG y PNG'); }
    // Generar nombre único para el archivo
    $timestamp                                                      = date('Y-m-d_H-i-s');
    $extension                                                      = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    // Extensión por defecto
    if (empty($extension)) { $extension = 'jpg'; }
    $nombre_archivo_original                                        = "nota_{$cod_nota_observacion}_{$fecha_reg}_orig.{$extension}";
    $ruta_completa_original                                         = $directorio_fotos_original.$nombre_archivo_original;
    // Mover el archivo al directorio de destino
    if (!move_uploaded_file($archivo_temporal, $ruta_completa_original)) { throw new Exception('Error al guardar el archivo en: '.$ruta_completa_original); }
    // Verificar que el archivo se guardó correctamente
    if (!file_exists($ruta_completa_original)) { throw new Exception('El archivo no se guardó correctamente'); }
    // Crear thumbnail (imagen minificada)
    $nombre_archivo_thumbnail                                       = "nota_{$cod_nota_observacion}_{$fecha_reg}_mini.{$extension}";
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
    // Respuesta exitosa
    $url_img_orig_producto                                          = $ruta_completa_original;
    $url_img_min_producto                                           = $ruta_completa_thumbnail;

    $sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET fecha_ymd = '%s', fecha_hora = '%s', cuenta = '%s', 
    cod_administrador = '%s', url_img_orig_producto = '%s', url_img_min_producto = '%s', codigo_estado_revision = '%s'
    WHERE (cod_nota_observacion = '%s')",
    $fecha_ymd, $fecha_hora, $cuenta, $cod_administrador, $url_img_orig_producto, $url_img_min_producto, $codigo_estado_revision, $cod_nota_observacion);
    $resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

    $respuesta = [
        'success' => true,
        'message' => 'Imagen guardada exitosamente',
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
        'cod_nota_observacion' => $cod_nota_observacion,
        'cod_info_factura_venta' => $cod_info_factura_venta,
        'cod_tercero' => $cod_tercero,
        'timestamp' => $timestamp
    ];
    
    echo json_encode($respuesta);
    
} catch (Exception $e) {
    // Log del error
    error_log("Error en subir_imagen_nota_observacion_ajax.php: " . $e->getMessage());
    
    // Respuesta de error
    http_response_code(400);
    $respuesta = [
        'success' => false,
        'message' => $e->getMessage(),
        'cod_nota_observacion' => isset($cod_nota_observacion) ? $cod_nota_observacion : null,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    echo json_encode($respuesta);
} catch (Error $e) {
    // Capturar errores fatales también
    error_log("Error fatal en subir_imagen_nota_observacion_ajax.php: " . $e->getMessage());
    
    http_response_code(500);
    $respuesta = [
        'success' => false,
        'message' => 'Error interno del servidor: ' . $e->getMessage(),
        'cod_nota_observacion' => isset($cod_nota_observacion) ? $cod_nota_observacion : null,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    echo json_encode($respuesta);
}

?>