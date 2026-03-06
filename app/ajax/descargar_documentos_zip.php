<?php
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { die('Sesión no iniciada'); }

$cod_aliado = isset($_GET['cod_aliado']) ? intval($_GET['cod_aliado']) : 0;
if ($cod_aliado <= 0) die('Aliado no válido');

$sql = "SELECT a.nombres_apellidos_tercero, a.nombres, a.apellidos, a.nombre_razon_social, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.url_documentacion_cedula_aliado,
        (SELECT t.nombre_tienda FROM tbl15_tienda t WHERE t.cod_aliado_estrategico = a.cod_administrador LIMIT 1) as nombre_tienda
FROM tbl15_administrador a WHERE a.cod_administrador = '$cod_aliado'";
$res = mysqli_query($conectar, $sql);
$row = mysqli_fetch_assoc($res);
if (!$row) die('Aliado no encontrado');

$nombre_aliado = $row['nombres_apellidos_tercero'] ?: ($row['nombres'] . ' ' . $row['apellidos']);
$comercial = !empty($row['nombre_tienda']) ? $row['nombre_tienda'] : (!empty($row['nombre_razon_social']) ? $row['nombre_razon_social'] : "");
$nombre_comercial = !empty($comercial) ? "_" . $comercial : "";
$nombre_archivo_zip = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nombre_aliado . $nombre_comercial) . ".zip";

$zip = new ZipArchive();
$tmp_file = tempnam(sys_get_temp_dir(), 'zip');

if ($zip->open($tmp_file, ZipArchive::CREATE) !== TRUE) { die("No se pudo crear el archivo ZIP"); }
$docs = ['RUT' => $row['url_documentacion_rut_aliado'], 'CamaraComercio' => $row['url_documentacion_camaracomercio_aliado'], 'Cedula' => $row['url_documentacion_cedula_aliado']];

$has_files = false;
foreach ($docs as $key => $url) {
    if (!empty($url)) {
        $found = false;
        // Case 1: URL is absolute
        if (strpos($url, 'http') === 0) {
            $content = @file_get_contents($url);
            if ($content) {
                $ext = pathinfo($url, PATHINFO_EXTENSION) ?: 'pdf';
                $zip->addFromString($key . "." . $ext, $content);
                $found = true;
            }
        } else {
            $possible_paths = [__DIR__ . DIRECTORY_SEPARATOR . $url, realpath(__DIR__ . DIRECTORY_SEPARATOR . $url)];
            
            foreach ($possible_paths as $path) {
                if ($path && file_exists($path) && is_file($path)) {
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $zip->addFile($path, $key . "." . $ext);
                    $found = true;
                    break;
                }
            }
        }
        if ($found) $has_files = true;
    }
}
$zip->close();
if (!$has_files) { @unlink($tmp_file); die('No hay archivos disponibles para descargar'); }

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename="' . $nombre_archivo_zip . '"');
header('Content-Length: ' . filesize($tmp_file));
readfile($tmp_file);
unlink($tmp_file);
?>
