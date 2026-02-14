<?php
// Archivo de prueba simple para debuggear el JSON
header('Content-Type: application/json; charset=utf-8');

$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? $_POST['cod_info_factura_venta'] : 'no_recibido';

echo json_encode([
    'success' => true,
    'message' => 'Endpoint funcionando correctamente',
    'cod_info_factura_venta_recibido' => $cod_info_factura_venta,
    'timestamp' => date('Y-m-d H:i:s'),
    'imagenes' => [
        [
            'cod_nota_observacion' => '1',
            'nombre_nota_observacion' => 'Imagen de prueba',
            'url_img_orig_producto' => 'path/to/image.jpg',
            'url_img_min_producto' => 'path/to/thumb.jpg',
            'fecha_ymd' => '2024-11-04',
            'fecha_hora' => '10:30:00'
        ]
    ],
    'total' => 1
]);
?>