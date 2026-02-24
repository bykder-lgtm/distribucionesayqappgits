<?php
ob_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

$identificacion = isset($_POST['identificacion']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion'])) : '';
$cod_tienda     = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;

$response = array('existe' => false);
if (!empty($identificacion)) {
    // Verificar si ya existe un vendedor con esta identificación para la tienda
    $sql = "SELECT cod_administrador FROM tbl15_administrador WHERE identificacion_tercero = '$identificacion' AND cod_seguridad = '2'";
    // Si se especificó una tienda, limitar la verificación a esa tienda
    if ($cod_tienda > 0) { $sql .= " AND cod_vendedor = '$cod_tienda'"; }
    
    $resultado = mysqli_query($conectar, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) { $response['existe'] = true; }
}
mysqli_close($conectar);
echo json_encode($response);
?>
