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
    if (strpos($url, 'http') === 0) return true; // URLs externas se asumen válidas
    
    $root = "c:/xampp/htdocs/sistemaseditaxe/mysqli/distribucionesayqapp/";
    $path = $root . ltrim($url, '/');
    return file_exists($path);
}

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $docs = [];
        if (!empty($row['url_documentacion_rut_aliado']) && verificarExistencia($row['url_documentacion_rut_aliado'])) {
            $docs[] = ['nombre' => 'RUT', 'url' => $row['url_documentacion_rut_aliado']];
        }
        if (!empty($row['url_documentacion_camaracomercio_aliado']) && verificarExistencia($row['url_documentacion_camaracomercio_aliado'])) {
            $docs[] = ['nombre' => 'Cámara de Comercio', 'url' => $row['url_documentacion_camaracomercio_aliado']];
        }
        if (!empty($row['url_documentacion_cedula_aliado']) && verificarExistencia($row['url_documentacion_cedula_aliado'])) {
            $docs[] = ['nombre' => 'Cédula', 'url' => $row['url_documentacion_cedula_aliado']];
        }
        
        if (count($docs) > 0) {
            $aliados[] = [
                'cod_administrador' => $row['cod_administrador'],
                'nombres_apellidos_tercero' => $row['nombres_apellidos_tercero'] ?: ($row['nombres'] . ' ' . $row['apellidos']),
                'fecha' => date('d/m/Y', strtotime($row['fecha'])),
                'documentos' => $docs
            ];
        }
    }
}
echo json_encode($aliados);
?>
