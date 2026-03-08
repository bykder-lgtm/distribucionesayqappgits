<?php
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['error' => 'Sesión no iniciada']); exit; }
$cod_administrador = $_SESSION['cod_administrador'];

// Parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? trim(mysqli_real_escape_string($conectar, $_GET['busqueda'])) : '';
$filtro_doc = isset($_GET['filtro_doc']) ? mysqli_real_escape_string($conectar, $_GET['filtro_doc']) : '';
$sort = isset($_GET['sort']) ? mysqli_real_escape_string($conectar, $_GET['sort']) : 'fecha_desc';
$cod_asesor = isset($_GET['cod_asesor']) ? (int)$_GET['cod_asesor'] : 0;
$cod_depto = isset($_GET['cod_departamento']) ? (int)$_GET['cod_departamento'] : 0;
$cod_muni = isset($_GET['cod_municipio']) ? (int)$_GET['cod_municipio'] : 0;
$fecha_registro = isset($_GET['fecha_registro']) ? mysqli_real_escape_string($conectar, $_GET['fecha_registro']) : '';
$fecha_doc_filtro = isset($_GET['fecha_documentacion']) ? mysqli_real_escape_string($conectar, $_GET['fecha_documentacion']) : '';

$where = "WHERE a.cod_seguridad = '23' AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))";

if (!empty($busqueda)) { $where .= " AND (a.cod_administrador = '$busqueda' OR a.cod_administrador LIKE '$busqueda' OR a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%' OR a.nit_razon_social LIKE '%$busqueda%' OR a.nombre_razon_social LIKE '%$busqueda%' OR a.barrio_tercero LIKE '%$busqueda%')"; }
if ($cod_asesor > 0) { $where .= " AND a.cod_asesor = '$cod_asesor'"; }
if ($cod_depto > 0) { $where .= " AND a.cod_departamento = '$cod_depto'"; }
if ($cod_muni > 0) { $where .= " AND a.cod_municipio = '$cod_muni'"; }
if (!empty($fecha_registro)) { $where .= " AND DATE(a.fecha) = '$fecha_registro'"; }
if (!empty($fecha_doc_filtro)) { $where .= " AND DATE(a.fecha_documentacion) = '$fecha_doc_filtro'"; }

if ($filtro_doc == '1' || $filtro_doc == 'alguno') {
    $where .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '' OR (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '2' || $filtro_doc == 'completo') {
    $where .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '' AND (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '3' || $filtro_doc == 'ninguno') {
    $where .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '' AND (a.url_documentacion_cedula_aliado IS NULL OR a.url_documentacion_cedula_aliado = ''))";
}

$order_by = "a.fecha_documentacion DESC";
if ($sort == 'fecha_asc') { $order_by = "a.fecha_documentacion ASC"; }
elseif ($sort == 'nombre_asc') { $order_by = "a.nombres_apellidos_tercero ASC"; }
elseif ($sort == 'nombre_desc') { $order_by = "a.nombres_apellidos_tercero DESC"; }

$sql = "SELECT a.cod_administrador, a.nombres, a.apellidos, a.nombres_apellidos_tercero, a.fecha_documentacion, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.url_documentacion_cedula_aliado
FROM tbl15_administrador a $where
ORDER BY $order_by";
$res = mysqli_query($conectar, $sql);
$aliados = [];
function verificarExistencia($url) {
    if (empty($url)) return false;
    if (strpos($url, 'http') === 0) return true; 
    // La mayoría de las rutas en DB son ../archivador/... y se ejecutan desde app/ajax // Resolvemos la ruta relativa a la ubicación de este archivo
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
        $aliados[] = ['cod_administrador' => $row['cod_administrador'], 'nombres_apellidos_tercero' => $row['nombres_apellidos_tercero'] ?: ($row['nombres'] . ' ' . $row['apellidos']), 'fecha' => date('d/m/Y', strtotime($row['fecha_documentacion'])), 'fecha_raw' => $row['fecha_documentacion'], 'documentos' => $docs, 'total_cargados' => count($docs), 'alguno_falta' => $alguno_falta];
    }
}
// Calcular estadísticas filtradas para el modal
$sql_firmados = "SELECT COUNT(DISTINCT f.cod_aliado_estrategico) as total 
FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador
$where AND f.cod_estado_firma_signature = 1";
$res_firmados = mysqli_query($conectar, $sql_firmados);
$total_firmados = ($res_firmados) ? mysqli_fetch_assoc($res_firmados)['total'] : 0;

$sql_docs_count = "SELECT COUNT(*) as total FROM tbl15_administrador a $where 
AND (
    (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_rut_aliado IS NOT NULL) OR 
    (a.url_documentacion_camaracomercio_aliado != '' AND a.url_documentacion_camaracomercio_aliado IS NOT NULL) OR 
    (a.url_documentacion_cedula_aliado != '' AND a.url_documentacion_cedula_aliado IS NOT NULL)
)";
$res_docs_count = mysqli_query($conectar, $sql_docs_count);
$total_docs_count = ($res_docs_count) ? mysqli_fetch_assoc($res_docs_count)['total'] : 0;

echo json_encode(['aliados' => $aliados, 'stats' => ['total' => count($aliados), 'firmados' => (int)$total_firmados, 'docs' => (int)$total_docs_count]]);
?>
