<?php
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { die('Sesión no iniciada'); }

$cod_aliado = isset($_GET['cod_aliado']) ? intval($_GET['cod_aliado']) : 0;
if ($cod_aliado <= 0) die('Aliado no válido');

$sql = "SELECT nombres_apellidos_tercero, nombres, apellidos, url_documentacion_rut_aliado, url_documentacion_camaracomercio_aliado, url_documentacion_cedula_aliado
        FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado'";
$res = mysqli_query($conectar, $sql);
$row = mysqli_fetch_assoc($res);
if (!$row) die('Aliado no encontrado');

$nombre_aliado = $row['nombres_apellidos_tercero'] ?: ($row['nombres'] . ' ' . $row['apellidos']);
$nombre_archivo_zip = "Documentos_" . preg_replace('/[^A-Za-z0-9_\-]/', '_', $nombre_aliado) . ".zip";

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
            // Case 2: Relative path. Try to resolve it.
            // Documentation path is usually relative to the site root
            $normalized_url = ltrim($url, '/');
            $possible_paths = [
                $_SERVER['DOCUMENT_ROOT'] . "/" . $normalized_url,
                $_SERVER['DOCUMENT_ROOT'] . "/sistemaseditaxe/mysqli/distribucionesayqapp/" . $normalized_url,
                "c:/xampp/htdocs/sistemaseditaxe/mysqli/distribucionesayqapp/" . $normalized_url,
                "../../" . $normalized_url,
                "../" . $normalized_url,
                $url
            ];
            
            foreach ($possible_paths as $path) {
                if (file_exists($path) && is_file($path)) {
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
