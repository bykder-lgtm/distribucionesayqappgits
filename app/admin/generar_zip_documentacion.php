<?php
date_default_timezone_set("America/Bogota");
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
    $sql = "SELECT a.nombres_apellidos_tercero, a.nombres, a.apellidos, a.nombre_razon_social, a.cedula, a.url_documentacion_cedula_aliado, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado,
    (SELECT t.nombre_tienda FROM tbl15_tienda t WHERE t.cod_aliado_estrategico = a.cod_administrador LIMIT 1) as nombre_tienda
    FROM tbl15_administrador a WHERE a.cod_administrador = '$cod_aliado'";
    $result = mysqli_query($conectar, $sql);
    
    if (!$result || mysqli_num_rows($result) === 0) { echo json_encode(['success' => false, 'message' => 'Aliado no encontrado']); exit; }
    $aliado = mysqli_fetch_assoc($result);
    
    // Determinar nombre del aliado con fallbacks
    $nombre_aliado = !empty($aliado['nombres']) ? $aliado['nombres'] : trim($aliado['apellidos'].' '.$aliado['apellidos']);
    if (empty($nombre_aliado)) { $nombre_aliado = !empty($aliado['nombre_razon_social']) ? $aliado['nombre_razon_social'] : "Aliado_" . $cod_aliado; }
    // Determinar nombre comercial o de tienda
    $nombre_comercial = !empty($aliado['nombre_tienda']) ? $aliado['nombre_tienda'] : (!empty($aliado['nombre_razon_social']) ? $aliado['nombre_razon_social'] : "");
    // Crear slugs para el nombre del archivo (reemplazar caracteres no válidos)
    $aliado_slug = preg_replace('/[^A-Za-z0-9_\-]/', '_', trim($nombre_aliado));
    $comercial_slug = !empty($nombre_comercial) ? preg_replace('/[^A-Za-z0-9_\-]/', '_', trim($nombre_comercial)) : "";
    // Limpiar guiones bajos duplicados
    $aliado_slug = preg_replace('/_+/', '_', $aliado_slug);
    $comercial_slug = preg_replace('/_+/', '_', $comercial_slug);
    
    $docs = ['Cedula' => $aliado['url_documentacion_cedula_aliado'], 'RUT' => $aliado['url_documentacion_rut_aliado'], 'CamaraComercio' => $aliado['url_documentacion_camaracomercio_aliado']];
    
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
    // Generar el nombre del archivo ZIP de forma legible
    $partes_nombre = [];
    if (!empty($aliado_slug)) $partes_nombre[] = $aliado_slug;
    if (!empty($comercial_slug)) $partes_nombre[] = $comercial_slug;
    if (!empty($aliado['cedula'])) $partes_nombre[] = $aliado['cedula'];
    $partes_nombre[] = date('Ymd_His');
    
    $nombre_zip = implode('_', $partes_nombre) . '.zip';
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

    // Crear la tabla si no existe (Corrigiendo nombre_temp_zips a VARCHAR ya que es un nombre de archivo)
    $sql_create = "CREATE TABLE IF NOT EXISTS `tbl15_temp_zips` (`cod_temp_zips` int(9) NOT NULL AUTO_INCREMENT, `nombre_temp_zips` varchar(200) NOT NULL,
    `nombre_modulo_origen` varchar(100) NOT NULL, `cod_administrador` int(9) NOT NULL, `url_temp_zips` varchar(300) NOT NULL,
    `url_documentacion_cedula_aliado` varchar(200) NOT NULL, `url_documentacion_rut_aliado` varchar(200) NOT NULL,
    `url_documentacion_camaracomercio_aliado` varchar(200) NOT NULL, `fecha_creacion` datetime NOT NULL,
    `fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, `cod_estado_descargado` tinyint(1) NOT NULL,
    `fecha_descarga` datetime NOT NULL, `cod_estado` tinyint(1) NOT NULL, PRIMARY KEY (`cod_temp_zips`)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    mysqli_query($conectar, $sql_create);

    // Insertar registro del ZIP generado
    $url_documentacion_cedula_aliado = mysqli_real_escape_string($conectar, $aliado['url_documentacion_cedula_aliado']);
    $url_documentacion_rut_aliado    = mysqli_real_escape_string($conectar, $aliado['url_documentacion_rut_aliado']);
    $url_documentacion_camaracomercio_aliado     = mysqli_real_escape_string($conectar, $aliado['url_documentacion_camaracomercio_aliado']);
    $nombre_temp_zips = mysqli_real_escape_string($conectar, $nombre_zip);
    $url_temp_zips  = mysqli_real_escape_string($conectar, $enlace_zip);
    $nombre_modulo_origen = 'Documentacion Aliado';
    $fecha_creacion = date('Y-m-d H:i:s');

    $sql_insert = "INSERT INTO `tbl15_temp_zips` (`nombre_temp_zips`, `nombre_modulo_origen`, `cod_administrador`, `url_temp_zips`, 
    `url_documentacion_cedula_aliado`, `url_documentacion_rut_aliado`, `url_documentacion_camaracomercio_aliado`,  `fecha_creacion`, `cod_estado`) 
    VALUES ('$nombre_temp_zips', '$nombre_modulo_origen', '$cod_aliado', '$url_temp_zips', 
    '$url_documentacion_cedula_aliado', '$url_documentacion_rut_aliado', '$url_documentacion_camaracomercio_aliado', '$fecha_creacion', 1)";
    mysqli_query($conectar, $sql_insert);

    echo json_encode(['success' => true, 'message' => 'ZIP creado y registrado exitosamente', 'zip_path' => $enlace_zip, 'zip_name' => $nombre_zip, 'archivos' => $archivos_info, 'aliado_nombre' => $nombre_aliado, 'aliado_cedula' => $aliado['cedula']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
