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
    $sql_imagenes = "SELECT cod_nota_observacion, nombre_nota_observacion, url_img_orig_producto, url_img_min_producto, codigo_estado_revision, fecha_ymd, fecha_hora 
                     FROM tbl15_nota_observacion WHERE cod_info_factura_venta = '$cod_info_factura_venta' ORDER BY fecha_ymd DESC, fecha_hora DESC";
    $consulta_imagenes = mysqli_query($conectar, $sql_imagenes);
    if (!$consulta_imagenes) { sendJsonResponse(['success' => false, 'message' => 'Error en consulta: ' . mysqli_error($conectar)]); }

    $imagenes = [];
    while ($fila = mysqli_fetch_assoc($consulta_imagenes)) {
        // Verificar que los archivos existen
        $cod_nota_observacion                       = $fila['cod_nota_observacion'];
        $nombre_nota_observacion                    = $fila['nombre_nota_observacion'];
        $url_img_min_producto                       = $fila['url_img_min_producto'];
        $url_img_orig_producto                      = $fila['url_img_orig_producto'];
        $codigo_estado_revision                     = $fila['codigo_estado_revision'];
        $fecha_ymd                                  = $fila['fecha_ymd'];
        $fecha_hora                                 = $fila['fecha_hora'];

        $calcular_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
        $consulta_estado_revision = mysqli_query($conectar, $calcular_estado_revision) or die(mysqli_error($conectar));
        $estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

        $nombre_estado_revision                     = $estado_revision['nombre_estado_revision'];
        $color_fondo_celda_estado                   = $estado_revision['color_fondo_celda_estado'];
        $color_letra_celda_estado                   = $estado_revision['color_letra_celda_estado'];
        $color_fondo_celda                          = $estado_revision['color_fondo_celda'];
        $color_letra_celda                          = $estado_revision['color_letra_celda'];

        // Si las URLs son relativas, verificar si los archivos existen
        $archivo_existe = true;
        if (!empty($url_img_min_producto) && !filter_var($url_img_min_producto, FILTER_VALIDATE_URL)) {
            // Es una ruta relativa, verificar si el archivo existe
            $ruta_completa = $url_img_min_producto;
            $archivo_existe = file_exists($ruta_completa);
        }
        
        if ($archivo_existe) {
            $imagenes[] = [
                'cod_nota_observacion' => $cod_nota_observacion,
                'nombre_nota_observacion' => $nombre_nota_observacion,
                'codigo_estado_revision' => $codigo_estado_revision,
                'nombre_estado_revision' => $nombre_estado_revision,
                'color_fondo_celda_estado' => $color_fondo_celda_estado,
                'color_letra_celda_estado' => $color_letra_celda_estado,
                'color_fondo_celda' => $color_fondo_celda,
                'color_letra_celda' => $color_letra_celda,
                'url_img_orig_producto' => $url_img_orig_producto,
                'url_img_min_producto' => $url_img_min_producto,
                'fecha_ymd' => $fecha_ymd,
                'fecha_hora' => $fecha_hora
            ];
        }
    }
    sendJsonResponse(['success' => true, 'imagenes' => $imagenes, 'total' => count($imagenes)]);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>