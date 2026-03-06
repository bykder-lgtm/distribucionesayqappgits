<?php
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['error' => 'Sesión no iniciada']); exit; }
$cod_administrador = $_SESSION['cod_administrador'];

$sql = "SELECT DISTINCT a.cod_administrador, a.nombres, a.apellidos, a.nombres_apellidos_tercero, f.fecha_generacion_firma_digital_documento, f.base64_firma_digital_documento 
FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador
WHERE f.cod_estado_firma_signature = 1 AND a.cod_seguridad = '23' 
AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))
ORDER BY f.fecha_generacion_firma_digital_documento DESC";
$res = mysqli_query($conectar, $sql);
$aliados = [];
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $aliados[] = ['cod_administrador' => $row['cod_administrador'], 'nombres_apellidos_tercero' => $row['nombres_apellidos_tercero'] ?: ($row['nombres'] . ' ' . $row['apellidos']), 'fecha_firma' => date('d/m/Y H:i', strtotime($row['fecha_generacion_firma_digital_documento'])), 'firma_base64' => $row['base64_firma_digital_documento']];
    }
}
echo json_encode($aliados);
?>
