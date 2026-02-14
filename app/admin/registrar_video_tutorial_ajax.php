<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: application/json');

include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin_visitante_intern.php");

$response = array('success' => false, 'message' => '');

// Verificar que se reciba el nombre del video
if (!isset($_POST['nombre_videotutorial']) || empty($_POST['nombre_videotutorial'])) { $response['message'] = 'Error: El nombre del video es requerido'; echo json_encode($response); exit; }
// Obtener tipo de video
$tipo_video = isset($_POST['tipo_video']) ? $_POST['tipo_video'] : 'youtube';

// Validar según el tipo
if ($tipo_video === 'youtube') {
    if (!isset($_POST['url_videotutorial']) || empty($_POST['url_videotutorial'])) { $response['message'] = 'Error: La URL del video de YouTube es requerida'; echo json_encode($response); exit; }
    $url_videotutorial = mysqli_real_escape_string($conectar, trim($_POST['url_videotutorial']));
} else {
    // Subir archivo de video
    if (!isset($_FILES['archivo_video']) || $_FILES['archivo_video']['error'] !== UPLOAD_ERR_OK) { $response['message'] = 'Error: No se recibió el archivo de video'; echo json_encode($response); exit; }
    
    $archivo = $_FILES['archivo_video'];
    $nombre_archivo = $archivo['name'];
    $tmp_archivo = $archivo['tmp_name'];
    $tamano_archivo = $archivo['size'];
    $tipo_archivo = $archivo['type'];
    // Validar tipo de archivo
    $tipos_permitidos = array('video/mp4', 'video/webm', 'video/ogg');
    if (!in_array($tipo_archivo, $tipos_permitidos)) { $response['message'] = 'Error: Tipo de archivo no permitido. Use MP4, WebM u OGG'; echo json_encode($response); exit; }
    // Validar tamaño (máximo 100MB)
    $tamano_maximo = 100 * 1024 * 1024;
    if ($tamano_archivo > $tamano_maximo) { $response['message'] = 'Error: El archivo es demasiado grande. Máximo 100MB'; echo json_encode($response); exit; }
    
    // Crear directorio si no existe
    $directorio_videos = '../archivador/videotutoriales/';
    $directorio_miniaturas = '../archivador/videotutoriales/miniaturas/';
    
    if (!is_dir($directorio_videos)) { mkdir($directorio_videos, 0755, true); }
    if (!is_dir($directorio_miniaturas)) { mkdir($directorio_miniaturas, 0755, true); }
    
    // Generar nombre único
    $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
    $nombre_nuevo = 'video_' . time() . '_' . rand(1000, 9999) . '.' . $extension;
    $ruta_destino = $directorio_videos . $nombre_nuevo;
    // Mover archivo
    if (!move_uploaded_file($tmp_archivo, $ruta_destino)) { $response['message'] = 'Error al guardar el archivo de video en el servidor'; echo json_encode($response); exit; }
    $url_videotutorial = $ruta_destino;
    
    // Procesar miniatura si se subió
    if (isset($_FILES['miniatura_video']) && $_FILES['miniatura_video']['error'] === UPLOAD_ERR_OK) {
        $miniatura = $_FILES['miniatura_video'];
        $ext_miniatura = pathinfo($miniatura['name'], PATHINFO_EXTENSION);
        $nombre_miniatura = 'thumb_' . time() . '_' . rand(1000, 9999) . '.' . $ext_miniatura;
        $ruta_miniatura = $directorio_miniaturas . $nombre_miniatura;
        
        if (move_uploaded_file($miniatura['tmp_name'], $ruta_miniatura)) {
            // Guardar ruta de miniatura (se puede agregar a la BD si es necesario)
        }
    }
}
// Obtener y sanitizar datos
$nombre_videotutorial       = mysqli_real_escape_string($conectar, trim($_POST['nombre_videotutorial']));
$descripcion_videotutorial  = isset($_POST['descripcion_videotutorial']) ? mysqli_real_escape_string($conectar, trim($_POST['descripcion_videotutorial'])) : '';
$nomb_videotutorial         = mysqli_real_escape_string($conectar, strtoupper(trim($_POST['nombre_videotutorial'])));
$cod_estado                 = 1; // Activo por defecto

// Generar fechas
$fecha_mes                  = date('Y-m');
$fecha_anyo                 = date('Y');
$fecha_ymd                  = date('Y-m-d');
$fecha_dmy                  = date('d-m-Y');
$fecha_time                 = time();
$fecha_reg_time             = time();
// Insertar en la base de datos
$sql_insertar = "INSERT INTO tbl15_videotutorial (nombre_videotutorial, descripcion_videotutorial, url_videotutorial, cod_estado, fecha_mes, fecha_anyo, fecha_ymd, fecha_dmy, fecha_time, fecha_reg_time) 
VALUES ('$nombre_videotutorial', '$descripcion_videotutorial', '$url_videotutorial', '$cod_estado', '$fecha_mes', '$fecha_anyo', '$fecha_ymd', '$fecha_dmy', '$fecha_time', '$fecha_reg_time')";
if (mysqli_query($conectar, $sql_insertar)) {
    $response['success'] = true;
    $response['message'] = 'Video tutorial registrado correctamente';
    $response['id'] = mysqli_insert_id($conectar);
} else {
    $response['message'] = 'Error al registrar el video: ' . mysqli_error($conectar);
}

echo json_encode($response);
?>
