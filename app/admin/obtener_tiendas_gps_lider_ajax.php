<?php
header('Content-Type: application/json');
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }

$cod_administrador = $_SESSION['cod_administrador'];
$subquery_aliados = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_lider = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado != '0' AND cod_estado_activacion_usuario != '3'";
// Total tiendas
$sql_total = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico IN ($subquery_aliados) AND cod_estado != '0'";
$res_total = mysqli_query($conectar, $sql_total);
if (!$res_total) { echo json_encode(['success' => false, 'message' => 'Error en consulta total: ' . mysqli_error($conectar)]); exit; }
$row_total = mysqli_fetch_assoc($res_total);
$total_tiendas = (int)$row_total['total'];
// Tiendas con GPS
$sql_gps = "SELECT t.cod_tienda, t.nombre_tienda, t.nombre1_tercero as dueno, t.direccion_tercero, t.telefono1_tercero, t.ubicacion_gps_tienda, a.nombres_apellidos_tercero as nombre_aliado
FROM tbl15_tienda t LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador
WHERE t.cod_aliado_estrategico IN ($subquery_aliados) AND t.ubicacion_gps_tienda IS NOT NULL 
AND t.ubicacion_gps_tienda != '' AND t.cod_estado != '0'";

$res_gps = mysqli_query($conectar, $sql_gps);
if (!$res_gps) { echo json_encode(['success' => false, 'message' => 'Error en consulta GPS: ' . mysqli_error($conectar)]); exit; }
$tiendas = [];
while ($row = mysqli_fetch_assoc($res_gps)) {
    $coords = explode(',', $row['ubicacion_gps_tienda']);
    if (count($coords) == 2) {
        $tiendas[] = ['id' => $row['cod_tienda'],'nombre' => $row['nombre_tienda'],'dueno' => $row['dueno'],'aliado' => $row['nombre_aliado'],'direccion' => $row['direccion_tercero'],'telefono' => $row['telefono1_tercero'],'lat' => trim($coords[0]),'lng' => trim($coords[1])];
    }
}

echo json_encode(['success' => true,'total' => $total_tiendas,'data' => $tiendas]);
?>
