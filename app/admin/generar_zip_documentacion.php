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
    // Obtener información del aliado y su posible tienda
    $sql = "SELECT a.nombres, a.apellidos, a.nombre_razon_social, a.cedula, a.url_documentacion_cedula_aliado, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado,
            (SELECT t.nombre_tienda FROM tbl15_tienda t WHERE t.cod_aliado_estrategico = a.cod_administrador LIMIT 1) as nombre_tienda
    FROM tbl15_administrador a WHERE a.cod_administrador = '$cod_aliado'";
    $result = mysqli_query($conectar, $sql);
    
    if (!$result || mysqli_num_rows($result) === 0) { echo json_encode(['success' => false, 'message' => 'Aliado no encontrado']); exit; }
    $aliado = mysqli_fetch_assoc($result);
    
    // Determinar nombre comercial o de tienda
    $comercial = !empty($aliado['nombre_tienda']) ? $aliado['nombre_tienda'] : (!empty($aliado['nombre_razon_social']) ? $aliado['nombre_razon_social'] : "");
    $nombre_comercial_slug = !empty($comercial) ? "_" . preg_replace('/[^A-Za-z0-9_\-]/', '_', $comercial) : "";
    
    $docs = [
        'Cedula' => $aliado['url_documentacion_cedula_aliado'],
        'RUT' => $aliado['url_documentacion_rut_aliado'],
        'CamaraComercio' => $aliado['url_documentacion_camaracomercio_aliado']
    ];
    
    $archivos_a_comprimir = [];
    $archivos_info = [];
    $base_dir = dirname(__DIR__) . '/';

    foreach ($docs as $tipo => $url) {
        if (!empty($url)) {
            $path_to_check = $url;
            // Si la ruta en DB es ../archivador... y estamos en app/admin, file_exists(url) debería funcionar.
            // Pero por si acaso probamos rutas absolutas también.
            $possible_paths = [$url, $base_dir . ltrim($url, './'), realpath($base_dir . $url)];
            
            foreach ($possible_paths as $path) {
                if ($path && file_exists($path) && is_file($path)) {
                    $archivos_a_comprimir[$tipo] = $path;
                    $archivos_info[] = ['nombre' => ucfirst($tipo), 'archivo' => basename($path), 'tamano' => filesize($path)];
                    break;
                }
            }
        }
    }

    if (empty($archivos_a_comprimir)) { echo json_encode(['success' => false, 'message' => 'No se encontraron documentos físicos para comprimir en el servidor']); exit; }
    
    // Crear directorio temporal si no existe
    $temp_dir = $base_dir . 'archivador/temp_zips/';
    if (!is_dir($temp_dir)) { mkdir($temp_dir, 0777, true); }
    
    // Nombre del archivo ZIP
    $nombre_zip = $aliado['nombres'] . '_' . $aliado['apellidos'] . $nombre_comercial_slug . '_' . date('YmdHis') . '.zip';
    $ruta_zip = $temp_dir . $nombre_zip;
    
    // Crear el archivo ZIP
    $zip = new ZipArchive();
    if ($zip->open($ruta_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) { echo json_encode(['success' => false, 'message' => 'No se pudo crear el archivo ZIP']); exit; }
    
    // Agregar archivos al ZIP
    foreach ($archivos_a_comprimir as $tipo => $ruta_archivo) { 
        $nombre_en_zip = ucfirst($tipo) . '.' . pathinfo($ruta_archivo, PATHINFO_EXTENSION); 
        $zip->addFile($ruta_archivo, $nombre_en_zip); 
    }
    $zip->close();
    
    // Generar enlace relativo del ZIP
    $enlace_zip = 'archivador/temp_zips/' . $nombre_zip;
    echo json_encode(['success' => true, 'message' => 'ZIP creado exitosamente', 'zip_path' => $enlace_zip, 'zip_name' => $nombre_zip, 'archivos' => $archivos_info, 'aliado_nombre' => $aliado['nombres'] . ' ' . $aliado['apellidos'], 'aliado_cedula' => $aliado['cedula']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
