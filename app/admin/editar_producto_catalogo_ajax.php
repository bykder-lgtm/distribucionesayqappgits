<?php
// Editar producto desde el catálogo
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { throw new Exception('Método no permitido'); }
    // Verificar sesión activa
    if (!isset($_SESSION['cod_administrador'])) { throw new Exception('Sesión no válida'); }
    $cod_administrador = $_SESSION['cod_administrador'];
    // Obtener y validar parámtros
    $cod_producto = isset($_POST['cod_producto']) ? (int)$_POST['cod_producto'] : 0;
    $cod_producto_barra = isset($_POST['cod_producto_barra']) ? trim($_POST['cod_producto_barra']) : '';
    $nombre_producto = isset($_POST['nombre_producto']) ? strtoupper(trim($_POST['nombre_producto'])) : '';
    $cod_tienda = isset($_POST['cod_tienda']) ? (int)$_POST['cod_tienda'] : 0;
    $precio_compra_producto = isset($_POST['precio_compra_producto']) ? (float)$_POST['precio_compra_producto'] : 0;
    $precio_venta_producto = isset($_POST['precio_venta_producto']) ? (float)$_POST['precio_venta_producto'] : 0;
    $cod_categoria = isset($_POST['cod_categoria']) ? (int)$_POST['cod_categoria'] : 0;
    $iva_ptj = isset($_POST['iva_ptj']) ? (float)$_POST['iva_ptj'] : 0;
    $descripcion_producto = isset($_POST['descripcion_producto']) ? trim($_POST['descripcion_producto']) : '';
    $cod_estado = isset($_POST['cod_estado']) ? (int)$_POST['cod_estado'] : 1;
    // Validaciones básicas
    if ($cod_producto <= 0) { throw new Exception('Código de producto no válido'); }
    if (empty($cod_producto_barra)) { throw new Exception('El código del producto es obligatorio'); }
    if (empty($nombre_producto)) { throw new Exception('El nombre del producto es obligatorio'); }
    if ($precio_venta_producto <= 0) { throw new Exception('El precio de venta debe ser mayor a 0'); }
    // Verificar que el producto existe
    $sql_verificar = "SELECT cod_producto, url_img_orig_producto, url_img_min_producto FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
    $resultado_verificar = mysqli_query($conectar, $sql_verificar);
    if (mysqli_num_rows($resultado_verificar) == 0) { throw new Exception('Producto no encontrado'); }
    
    $producto_actual = mysqli_fetch_assoc($resultado_verificar);
    // Verificar si el código de producto ya existe en otro registro
    $sql_verificar_codigo = "SELECT cod_producto FROM tbl15_producto WHERE cod_producto_barra = '" . mysqli_real_escape_string($conectar, $cod_producto_barra) . "' AND cod_producto != '$cod_producto'";
    $resultado_verificar_codigo = mysqli_query($conectar, $sql_verificar_codigo);
    if (mysqli_num_rows($resultado_verificar_codigo) > 0) { throw new Exception('Ya existe otro producto con ese código'); }
    
    // Obtener nombre de estado y categoría
    $sql_estado = "SELECT nombre_estado FROM tbl15_estado WHERE cod_estado = '$cod_estado'";
    $consulta_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($consulta_estado);
    $nombre_estado = isset($datos_estado['nombre_estado']) ? $datos_estado['nombre_estado'] : 'HABILITADO';
    
    $sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria'";
    $consulta_categoria = mysqli_query($conectar, $sql_categoria);
    $datos_categoria = mysqli_fetch_assoc($consulta_categoria);
    $nombre_categoria = isset($datos_categoria['nombre_categoria']) ? $datos_categoria['nombre_categoria'] : '';
    
    // Procesar imagen si se subió una nueva
    $url_img_orig_producto = $producto_actual['url_img_orig_producto'];
    $url_img_min_producto = $producto_actual['url_img_min_producto'];
    
    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] == 0) {
        $directorio_orig = '../archivador/img_producto/orig/';
        $directorio_min = '../archivador/img_producto/min/';
        
        // Crear directorios si no existen
        if (!file_exists($directorio_orig)) { mkdir($directorio_orig, 0777, true); }
        if (!file_exists($directorio_min)) { mkdir($directorio_min, 0777, true); }
        
        $nombre_archivo = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['imagen_producto']['name']);
        $ruta_orig = $directorio_orig . $nombre_archivo;
        $ruta_min = $directorio_min . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['imagen_producto']['tmp_name'], $ruta_orig)) {
            $url_img_orig_producto = $ruta_orig;
            
            // Crear miniatura
            $tipo_imagen = $_FILES['imagen_producto']['type'];
            list($ancho_orig, $alto_orig) = getimagesize($ruta_orig);
            
            $ancho_nuevo = 300;
            $alto_nuevo = ($alto_orig / $ancho_orig) * $ancho_nuevo;
            
            $imagen_nueva = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
            
            switch ($tipo_imagen) {
                case 'image/jpeg':
                    $imagen_orig = imagecreatefromjpeg($ruta_orig);
                    break;
                case 'image/png':
                    $imagen_orig = imagecreatefrompng($ruta_orig);
                    imagealphablending($imagen_nueva, false);
                    imagesavealpha($imagen_nueva, true);
                    break;
                case 'image/gif':
                    $imagen_orig = imagecreatefromgif($ruta_orig);
                    break;
                case 'image/webp':
                    $imagen_orig = imagecreatefromwebp($ruta_orig);
                    break;
                default:
                    $imagen_orig = imagecreatefromjpeg($ruta_orig);
            }
            
            if ($imagen_orig) {
                imagecopyresampled($imagen_nueva, $imagen_orig, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_orig, $alto_orig);
                
                switch ($tipo_imagen) {
                    case 'image/png':
                        imagepng($imagen_nueva, $ruta_min);
                        break;
                    case 'image/gif':
                        imagegif($imagen_nueva, $ruta_min);
                        break;
                    default:
                        imagejpeg($imagen_nueva, $ruta_min, 85);
                }
                imagedestroy($imagen_orig);
                imagedestroy($imagen_nueva);
                $url_img_min_producto = $ruta_min;
            }
        }
    }
    // Actualizar producto
    $sql_actualizar = "UPDATE tbl15_producto SET 
    cod_producto_barra = '" . mysqli_real_escape_string($conectar, $cod_producto_barra) . "',
    nombre_producto = '" . mysqli_real_escape_string($conectar, $nombre_producto) . "',
    cod_tienda = '$cod_tienda',
    precio_compra_producto = '$precio_compra_producto',
    precio_venta_producto = '$precio_venta_producto',
    cod_categoria = '$cod_categoria',
    nombre_categoria = '" . mysqli_real_escape_string($conectar, $nombre_categoria) . "',
    iva_ptj = '$iva_ptj',
    descripcion_producto = '" . mysqli_real_escape_string($conectar, $descripcion_producto) . "',
    cod_estado = '$cod_estado',
    nombre_estado = '" . mysqli_real_escape_string($conectar, $nombre_estado) . "',
    url_img_orig_producto = '" . mysqli_real_escape_string($conectar, $url_img_orig_producto) . "',
    url_img_min_producto = '" . mysqli_real_escape_string($conectar, $url_img_min_producto) . "'
    WHERE cod_producto = '$cod_producto'";
    $resultado = mysqli_query($conectar, $sql_actualizar);
    if (!$resultado) { throw new Exception('Error al actualizar el producto: ' . mysqli_error($conectar)); }
    
    // Respuesta exitosa
    $respuesta = ['success' => true, 'mensaje' => 'Producto actualizado correctamente', 'cod_producto' => $cod_producto, 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
    
} catch (Exception $e) {
    error_log("Error en editar_producto_catalogo_ajax.php: " . $e->getMessage());
    http_response_code(400);
    $respuesta = ['success' => false, 'mensaje' => $e->getMessage(), 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
} catch (Error $e) {
    error_log("Error fatal en editar_producto_catalogo_ajax.php: " . $e->getMessage());
    http_response_code(500);
    $respuesta = ['success' => false, 'mensaje' => 'Error interno del servidor', 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
}
?>
