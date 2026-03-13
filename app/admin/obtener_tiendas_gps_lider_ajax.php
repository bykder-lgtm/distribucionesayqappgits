<?php
header('Content-Type: application/json');
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }

$cod_administrador = $_SESSION['cod_administrador'];
$subquery_aliados = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_lider = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado != '0' AND cod_estado_activacion_usuario != '3'";

// Condiciones dinámicas compartidas
$condiciones = "";

if (isset($_GET['cod_departamento']) && !empty($_GET['cod_departamento'])) {
    $cod_depto = intval($_GET['cod_departamento']);
    $condiciones .= " AND t.cod_departamento = '$cod_depto'";
}
if (isset($_GET['cod_municipio']) && !empty($_GET['cod_municipio'])) {
    $cod_muni = intval($_GET['cod_municipio']);
    $condiciones .= " AND t.cod_municipio = '$cod_muni'";
}
if (isset($_GET['barrio']) && !empty($_GET['barrio'])) {
    $barrio = mysqli_real_escape_string($conectar, trim($_GET['barrio']));
    $condiciones .= " AND t.barrio_tercero LIKE '%$barrio%'";
}
if (isset($_GET['lider']) && !empty($_GET['lider'])) {
    $lider = mysqli_real_escape_string($conectar, trim($_GET['lider']));
    $condiciones .= " AND lider.nombres_apellidos_tercero LIKE '%$lider%'";
}
if (isset($_GET['coordinador']) && !empty($_GET['coordinador'])) {
    $coordinador = mysqli_real_escape_string($conectar, trim($_GET['coordinador']));
    $condiciones .= " AND coord.nombres_apellidos_tercero LIKE '%$coordinador%'";
}
if (isset($_GET['asesor']) && !empty($_GET['asesor'])) {
    $asesor = mysqli_real_escape_string($conectar, trim($_GET['asesor']));
    $condiciones .= " AND ase.nombres_apellidos_tercero LIKE '%$asesor%'";
}
if (isset($_GET['aliado']) && !empty($_GET['aliado'])) {
    $aliado = mysqli_real_escape_string($conectar, trim($_GET['aliado']));
    $condiciones .= " AND a.nombres_apellidos_tercero LIKE '%$aliado%'";
}

// Join necesario para los filtros de jerarquía
$joins = "LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador
          LEFT JOIN tbl15_administrador lider ON a.cod_lider = lider.cod_administrador
          LEFT JOIN tbl15_administrador coord ON a.cod_coordinador = coord.cod_administrador
          LEFT JOIN tbl15_administrador ase ON a.cod_asesor = ase.cod_administrador";

// Total tiendas filtradas
$sql_total = "SELECT COUNT(*) as total FROM tbl15_tienda t $joins WHERE t.cod_aliado_estrategico IN ($subquery_aliados) AND t.cod_estado != '0' $condiciones";
$res_total = mysqli_query($conectar, $sql_total);
if (!$res_total) { echo json_encode(['success' => false, 'message' => 'Error en consulta total: ' . mysqli_error($conectar)]); exit; }
$row_total = mysqli_fetch_assoc($res_total);
$total_tiendas = (int)$row_total['total'];

// Tiendas con GPS filtradas
$sql_gps = "SELECT t.cod_tienda, t.nombre_tienda, t.nombre1_tercero as dueno, t.direccion_tercero, t.telefono1_tercero, t.ubicacion_gps_tienda, a.nombres_apellidos_tercero as nombre_aliado
FROM tbl15_tienda t $joins
WHERE t.cod_aliado_estrategico IN ($subquery_aliados) AND t.ubicacion_gps_tienda IS NOT NULL 
AND t.ubicacion_gps_tienda != '' AND t.cod_estado != '0' $condiciones";

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
