<?php
header('Content-Type: application/json');
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_administrador = $_SESSION['cod_administrador'];
// Obtener info del usuario actual para conocer su rol (cod_seguridad)
$sql_user = "SELECT cod_seguridad FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador' AND cod_estado != '0'";
$res_user = mysqli_query($conectar, $sql_user);
$user_data = mysqli_fetch_assoc($res_user);
if (!$user_data) { echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']); exit; }

$cod_seguridad = $user_data['cod_seguridad'];
// Construir subquery de aliados según el rol // cod_seguridad: 21 (Lider), 22 (Coordinador), 2 (Asesor) // Aliados tienen cod_seguridad = 23
$subquery_aliados = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_seguridad = '23' AND cod_estado != '0' AND cod_estado_activacion_usuario != '3'";

if ($cod_seguridad == '21') { // LIDER
    $subquery_aliados .= " AND cod_lider = '$cod_administrador'";
} elseif ($cod_seguridad == '22') { // COORDINADOR
    $subquery_aliados .= " AND cod_coordinador = '$cod_administrador'";
} elseif ($cod_seguridad == '2') { // ASESOR
    $subquery_aliados .= " AND cod_asesor = '$cod_administrador'";
} else {
    // Si no es ninguno de los roles anteriores, devolvemos vacío o restringido // Para administradores (rol 1 u otros), quizá mostrar todo? // El requerimiento dice Lideres, Coordinadores y Asesores.
}
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

// 1. Contar TOTAL de tiendas que pertenecen a este usuario (con o sin GPS)
$sql_total = "SELECT COUNT(*) as total FROM tbl15_tienda t $joins WHERE t.cod_aliado_estrategico IN ($subquery_aliados) AND t.cod_estado != '0' $condiciones";
$res_total = mysqli_query($conectar, $sql_total);
$row_total = mysqli_fetch_assoc($res_total);
$total_tiendas = (int)$row_total['total'];

// 2. Obtener solo tiendas CON GPS - Con filtros dinámicos
$sql_gps = "SELECT t.cod_tienda, t.nombre_tienda, t.nombre1_tercero as dueno, t.direccion_tercero, t.telefono1_tercero, t.ubicacion_gps_tienda, a.nombres_apellidos_tercero as nombre_aliado
FROM tbl15_tienda t $joins 
WHERE t.cod_aliado_estrategico IN ($subquery_aliados) AND t.ubicacion_gps_tienda IS NOT NULL 
AND t.ubicacion_gps_tienda != '' AND t.cod_estado != '0' $condiciones";

$res_gps = mysqli_query($conectar, $sql_gps);
$tiendas = [];

while ($row = mysqli_fetch_assoc($res_gps)) {
    // GPS format is usually "lat, lng"
    $coords = explode(',', $row['ubicacion_gps_tienda']);
    if (count($coords) == 2) {
        $tiendas[] = ['id' => $row['cod_tienda'],'nombre' => $row['nombre_tienda'],'dueno' => $row['dueno'],'aliado' => $row['nombre_aliado'],'direccion' => $row['direccion_tercero'],'telefono' => $row['telefono1_tercero'],'lat' => trim($coords[0]),'lng' => trim($coords[1])];
    }
}
echo json_encode(['success' => true,'total' => $total_tiendas,'data' => $tiendas]);
?>
