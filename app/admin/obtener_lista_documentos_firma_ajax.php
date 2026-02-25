<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_asesor                                                         = $_SESSION['cod_administrador'];
$buscar                                                             = isset($_POST['buscar']) ? mysqli_real_escape_string($conectar, $_POST['buscar']) : '';
$desde                                                              = isset($_POST['desde']) ? $_POST['desde'] : '';
$hasta                                                              = isset($_POST['hasta']) ? $_POST['hasta'] : '';
$filtro_status                                                      = isset($_POST['filtro_status']) ? $_POST['filtro_status'] : 'todos';
$where = " WHERE f.cod_administrador = '$cod_asesor' ";

if (!empty($buscar)) { $where .= " AND (a.nombres LIKE '%$buscar%' OR a.apellidos LIKE '%$buscar%' OR a.cedula LIKE '%$buscar%') "; }
if (!empty($desde)) { $where .= " AND DATE(f.fecha_creacion_registro_firma_digital_documento) >= '$desde' "; }
if (!empty($hasta)) { $where .= " AND DATE(f.fecha_creacion_registro_firma_digital_documento) <= '$hasta' "; }
if ($filtro_status == 'firmado') { $where .= " AND f.cod_estado_firma_signature = 1 "; } elseif ($filtro_status == 'pendiente') { $where .= " AND f.cod_estado_firma_signature = 0 "; }

$sql = "SELECT f.cod_firma_digital_documento as id, f.nombre_tipo_firma_digital, 
f.fecha_creacion_registro_firma_digital_documento as fecha_creacion, f.token_firma_digital_documento as token,
f.hash_seguridad_servidor as hash, f.base64_firma_digital_documento as base64_firma,
f.fecha_generacion_firma_digital_documento as fecha_firma, f.cod_estado_firma_signature, f.cod_estado,
a.nombres, a.apellidos, a.cedula as identificacion,
t.nombre_tienda
FROM tbl15_firma_digital_documento f 
INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador 
LEFT JOIN tbl15_tienda t ON f.cod_tienda = t.cod_tienda
$where 
ORDER BY f.fecha_creacion_registro_firma_digital_documento DESC";
$res = mysqli_query($conectar, $sql);

if ($res) {
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        // Formatear fechas para mejor lectura si es necesario
        $row['fecha_creacion'] = date('d/m/Y H:i', strtotime($row['fecha_creacion']));
        if ($row['fecha_firma']) { $row['fecha_firma'] = date('d/m/Y H:i', strtotime($row['fecha_firma'])); }
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $data]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al obtener registros: ' . mysqli_error($conectar)]);
}
mysqli_close($conectar);
?>
