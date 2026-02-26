<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
$cod_tienda                                                         = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
$response                                                           = array('success' => false, 'creditos' => array());
if ($cod_tienda > 0) {
    // Consultar facturas con estado ABIERTA (créditos activos) de esta tienda
    $consulta_sql = "SELECT i.cod_info_factura_venta, i.cod_factura, i.total_precio_venta, i.fecha_anyo, i.fecha_hora, t.nombre1_tercero, t.nombre2_tercero, t.apellido1_tercero, t.apellido2_tercero, t.identificacion_tercero
    FROM tbl15_info_factura_venta i LEFT JOIN tbl15_tercero t ON i.cod_tercero = t.cod_tercero
    WHERE i.cod_tienda = '$cod_tienda' AND i.nombre_estado_factura = 'ABIERTA' ORDER BY i.fecha_anyo DESC, i.fecha_hora DESC";
    $consulta = mysqli_query($conectar, $consulta_sql);
    if ($consulta) {
        while ($row = mysqli_fetch_assoc($consulta)) {
            $nombre_tercero = trim($row['nombre1_tercero'] . ' ' . $row['nombre2_tercero'] . ' ' . $row['apellido1_tercero'] . ' ' . $row['apellido2_tercero']);
            $response['creditos'][] = array('cod_info_factura_venta' => $row['cod_info_factura_venta'], 'cod_factura' => $row['cod_factura'], 'total_precio_venta' => $row['total_precio_venta'], 'fecha' => $row['fecha_anyo'], 'tercero' => $nombre_tercero, 'identificacion' => $row['identificacion_tercero']);
        }
        $response['success'] = true;
    }
}
mysqli_close($conectar);
echo json_encode($response);
?>
