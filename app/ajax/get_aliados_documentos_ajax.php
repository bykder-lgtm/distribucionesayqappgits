<?php
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['error' => 'Sesión no iniciada']); exit; }
$cod_administrador = $_SESSION['cod_administrador'];
$sql = "SELECT a.cod_administrador, a.nombres, a.apellidos, a.nombres_apellidos_tercero, a.fecha, 
a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.url_documentacion_cedula_aliado
FROM tbl15_administrador a WHERE a.cod_seguridad = '23'
AND ( (url_documentacion_rut_aliado != '' AND url_documentacion_rut_aliado IS NOT NULL) 
OR (url_documentacion_camaracomercio_aliado != '' AND url_documentacion_camaracomercio_aliado IS NOT NULL) 
OR (url_documentacion_cedula_aliado != '' AND url_documentacion_cedula_aliado IS NOT NULL) )
AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))
ORDER BY a.fecha DESC";
$res = mysqli_query($conectar, $sql);
$aliados = [];

function verificarExistencia($url) {
    if (empty($url)) return false;
    if (strpos($url, 'http') === 0) return true; 

    // La mayoría de las rutas en DB son ../archivador/... y se ejecutan desde app/ajax
    // Resolvemos la ruta relativa a la ubicación de este archivo
    $fullPath = __DIR__ . DIRECTORY_SEPARATOR . $url;

    // file_exists funciona correctamente con rutas relativas construidas con __DIR__
    return file_exists($fullPath);
}
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $docs = [];
        $alguno_falta = false;
        $posibles = ['RUT' => $row['url_documentacion_rut_aliado'], 'Cámara de Comercio' => $row['url_documentacion_camaracomercio_aliado'], 'Cédula' => $row['url_documentacion_cedula_aliado']];
        foreach ($posibles as $nombre => $url) {
            if (!empty($url)) {
                $existe = verificarExistencia($url);
                if (!$existe) $alguno_falta = true;
                $docs[] = ['nombre' => $nombre, 'url' => $url, 'existe' => $existe];
            }
        }
        if (count($docs) > 0) { $aliados[] = ['cod_administrador' => $row['cod_administrador'], 'nombres_apellidos_tercero' => $row['nombres_apellidos_tercero'] ?: ($row['nombres'] . ' ' . $row['apellidos']), 'fecha' => date('d/m/Y', strtotime($row['fecha'])), 'documentos' => $docs, 'alguno_falta' => $alguno_falta]; }
    }
}
echo json_encode($aliados);
?>
