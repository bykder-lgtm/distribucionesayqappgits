<?php
session_start();
header('Content-Type: application/json');
// Verificar sesión
if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

// Incluir la conexión a la base de datos
include_once("../conexiones/conexione.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_aliado = isset($_POST['cod_aliado']) ? intval($_POST['cod_aliado']) : 0;
    
    if ($cod_aliado <= 0) { echo json_encode(['success' => false, 'message' => 'ID de aliado no válido']); exit; }
    // Obtener información del aliado
    $sql = "SELECT nombres, apellidos, cedula, url_documentacion_cedula_aliado, url_documentacion_rut_aliado, url_documentacion_camaracomercio_aliado 
    FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado'";
    $result = mysqli_query($conectar, $sql);
    
    if (!$result || mysqli_num_rows($result) === 0) { echo json_encode(['success' => false, 'message' => 'Aliado no encontrado']); exit; }
    $aliado = mysqli_fetch_assoc($result);
    // Verificar que al menos un archivo exista
    $archivos_a_comprimir = [];
    $archivos_info = [];
    // Directorio base donde se guardan los archivos
    $base_dir = dirname(__DIR__) . '/';
    // Verificar cédula
    if (!empty($aliado['url_documentacion_cedula_aliado'])) {
        $ruta_completa = $aliado['url_documentacion_cedula_aliado'];
        if (file_exists($ruta_completa)) {
            $archivos_a_comprimir['cedula'] = $ruta_completa;
            $archivos_info[] = ['nombre' => 'Cédula', 'archivo' => basename($aliado['url_documentacion_cedula_aliado']), 'tamano' => filesize($ruta_completa)];
        }
    }
    // Verificar RUT
    if (!empty($aliado['url_documentacion_rut_aliado'])) {
        $ruta_completa = $aliado['url_documentacion_rut_aliado'];
        if (file_exists($ruta_completa)) {
            $archivos_a_comprimir['rut'] = $ruta_completa;
            $archivos_info[] = ['nombre' => 'RUT', 'archivo' => basename($aliado['url_documentacion_rut_aliado']), 'tamano' => filesize($ruta_completa)];
        }
    }
    // Verificar Cámara de Comercio
    if (!empty($aliado['url_documentacion_camaracomercio_aliado'])) {
        $ruta_completa = $aliado['url_documentacion_camaracomercio_aliado'];
        if (file_exists($ruta_completa)) {
            $archivos_a_comprimir['camara'] = $ruta_completa;
            $archivos_info[] = ['nombre' => 'Cámara de Comercio', 'archivo' => basename($aliado['url_documentacion_camaracomercio_aliado']), 'tamano' => filesize($ruta_completa)];
        }
    }
    if (empty($archivos_a_comprimir)) { echo json_encode(['success' => false, 'message' => 'No se encontraron documentos para comprimir']); exit; }
    // Crear directorio temporal si no existe
    $temp_dir = $base_dir . 'archivador/temp_zips/';
    if (!is_dir($temp_dir)) { mkdir($temp_dir, 0777, true); }
    // Nombre del archivo ZIP
    $nombre_zip = 'Documentacion_' . $aliado['nombres'] . '_' . $aliado['apellidos'] . '_' . date('YmdHis') . '.zip';
    $ruta_zip = $temp_dir . $nombre_zip;
    // Crear el archivo ZIP
    $zip = new ZipArchive();
    if ($zip->open($ruta_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) { echo json_encode(['success' => false, 'message' => 'No se pudo crear el archivo ZIP']); exit; }
    // Agregar archivos al ZIP
    foreach ($archivos_a_comprimir as $tipo => $ruta_archivo) { $nombre_en_zip = ucfirst($tipo) . '_' . basename($ruta_archivo); $zip->addFile($ruta_archivo, $nombre_en_zip); }
    $zip->close();
    // Generar enlace relativo del ZIP
    $enlace_zip = 'archivador/temp_zips/' . $nombre_zip;
    echo json_encode(['success' => true, 'message' => 'ZIP creado exitosamente', 'zip_path' => $enlace_zip, 'zip_name' => $nombre_zip, 'archivos' => $archivos_info, 'aliado_nombre' => $aliado['nombres'] . ' ' . $aliado['apellidos'], 'aliado_cedula' => $aliado['cedula']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
