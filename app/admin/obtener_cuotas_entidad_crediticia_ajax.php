<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
header('Content-Type: application/json');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
$cod_entidad_crediticia = isset($_POST['cod_entidad_crediticia']) ? intval($_POST['cod_entidad_crediticia']) : 0;
if ($cod_entidad_crediticia == 0) { echo json_encode(['success' => false, 'message' => 'Entidad crediticia no especificada', 'cuotas' => []]); exit; }
// Obtener valor predeterminado de la entidad
$sql_def = "SELECT administrativo_ptj FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
$res_def = mysqli_query($conectar, $sql_def);
$default_admin_ptj = 0;
if ($res_def && $row_def = mysqli_fetch_assoc($res_def)) { $default_admin_ptj = $row_def['administrativo_ptj']; }

$sql = "SELECT cod_parametrizacion_entidad_crediticia_cuota, cuota, interes_ptj, ptj_seguro, ptj_fondo_garantia, administrativo_ptj, tipo_ptj_seguro, tipo_fondo_garantia, fecha_creacion, fecha_modificacion 
FROM tbl15_parametrizacion_entidad_crediticia_cuota WHERE cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_estado = '1' ORDER BY cuota ASC";
$resultado = mysqli_query($conectar, $sql);
$cuotas = [];
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) { 
        $cuotas[] = ['cod' => $row['cod_parametrizacion_entidad_crediticia_cuota'], 'cuota' => $row['cuota'], 'interes_ptj' => $row['interes_ptj'], 'ptj_seguro' => $row['ptj_seguro'], 'ptj_fondo_garantia' => $row['ptj_fondo_garantia'], 'administrativo_ptj' => $row['administrativo_ptj'], 'tipo_ptj_seguro' => $row['tipo_ptj_seguro'], 'tipo_fondo_garantia' => $row['tipo_fondo_garantia'], 'fecha_creacion' => $row['fecha_creacion'], 'fecha_modificacion' => $row['fecha_modificacion']]; 
    }
}
echo json_encode(['success' => true, 'cuotas' => $cuotas, 'total' => count($cuotas), 'default_administrativo_ptj' => $default_admin_ptj]);
?>
