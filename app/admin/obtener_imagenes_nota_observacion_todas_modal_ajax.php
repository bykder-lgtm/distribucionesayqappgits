<?php
// Endpoint para obtener las imágenes guardadas de un crédito
ob_start(); // Capturar cualquier output no deseado
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean(); // Limpiar el buffer
header('Content-Type: application/json; charset=utf-8');
// Función para enviar respuesta JSON y terminar
function sendJsonResponse($data) { echo json_encode($data); exit; }

try {
    // Verificar conexión a la base de datos
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, trim($_POST['cod_info_factura_venta'])) : '';
    if ($cod_info_factura_venta === '') { sendJsonResponse(['success' => false, 'message' => 'cod_info_factura_venta no especificado']); }
    // Consultar todas las imágenes guardadas para este crédito
    $imagenes = [];
    $sql_imagenes = "SELECT * FROM tbl15_nota_observacion WHERE cod_info_factura_venta = '$cod_info_factura_venta' ORDER BY cod_nota_observacion DESC";
    $consulta_imagenes = mysqli_query($conectar, $sql_imagenes);
    if (!$consulta_imagenes) { sendJsonResponse(['success' => false, 'message' => 'Error en consulta: ' . mysqli_error($conectar)]); }
    while ($fila = mysqli_fetch_assoc($consulta_imagenes)) {
        // Verificar que los archivos existen
        $cod_nota_observacion              = $fila['cod_nota_observacion'];
        $nombre_nota_observacion           = $fila['nombre_nota_observacion'];
        $descripcion_nota_observacion      = $fila['descripcion_nota_observacion'];   
        $codigo_estado_revision            = $fila['codigo_estado_revision'];
        $cod_estado_obligatorio            = $fila['cod_estado_obligatorio'];
        $cod_estado_obligatorio2           = $fila['cod_estado_obligatorio2'];
        $url_img_min_producto              = $fila['url_img_min_producto'];
        $url_img_orig_producto             = $fila['url_img_orig_producto'];
        // Si las URLs son relativas, verificar si los archivos existen
        $archivo_existe = true;
        /*
        if (!empty($url_img_orig_producto) && !filter_var($url_img_orig_producto, FILTER_VALIDATE_URL)) { // Es una ruta relativa, verificar si el archivo existe
            $ruta_completa = $url_img_min_producto;
            $archivo_existe = file_exists($ruta_completa);
        }
        */
        if ($archivo_existe) {
            $imagenes[] = [
                'cod_nota_observacion' => $cod_nota_observacion,
                'nombre_nota_observacion' => $nombre_nota_observacion,
                'descripcion_nota_observacion' => $descripcion_nota_observacion,
                'codigo_estado_revision' => $codigo_estado_revision,               
                'url_img_orig_producto' => $url_img_orig_producto,
                'url_img_min_producto' => $url_img_min_producto,
                'cod_estado_obligatorio' => $cod_estado_obligatorio,
                'cod_estado_obligatorio2' => $cod_estado_obligatorio2,
                'fecha_ymd' => $fila['fecha_ymd'],
                'fecha_hora' => $fila['fecha_hora']
            ];
        }
    }
    sendJsonResponse(['success' => true, 'imagenes' => $imagenes, 'total' => count($imagenes)]);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>