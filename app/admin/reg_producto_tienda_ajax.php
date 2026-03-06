<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){
    // Valid user
} else { 
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Sesión no válida']);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cod_tienda             = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
    $cod_administrador      = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
    $cod_producto_barra     = isset($_POST['cod_producto_barra']) ? trim(addslashes($_POST['cod_producto_barra'])) : '';
    $nombre_producto        = isset($_POST['nombre_producto']) ? trim(addslashes($_POST['nombre_producto'])) : '';
    $precio_compra_producto = isset($_POST['precio_compra_producto']) ? floatval($_POST['precio_compra_producto']) : 0;
    $precio_venta_producto  = isset($_POST['precio_venta_producto']) ? floatval($_POST['precio_venta_producto']) : 0;
    $cod_categoria          = isset($_POST['cod_categoria']) ? intval($_POST['cod_categoria']) : 0;
    $iva_ptj                = isset($_POST['iva_ptj']) ? floatval($_POST['iva_ptj']) : 0;
    $descripcion_producto   = isset($_POST['descripcion_producto']) ? trim(addslashes($_POST['descripcion_producto'])) : '';
    $cod_estado             = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1; // Activo por defecto
    $fecha_creacion = date("Y-m-d H:i:s");
    
    // Manejo de imagen (opcional)
    $url_img_orig_producto = '';
    $url_img_min_producto = '';
    $und_producto = 1;

    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../archivador/img_producto/';
        // Crear directorio si no existe
        if (!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }
        
        $file_name = $_FILES['imagen_producto']['name'];
        $file_tmp = $_FILES['imagen_producto']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        // Validar tipo de archivo
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_ext, $allowed_types)) {
            $new_filename = 'producto_' . $cod_tienda . '_' . time() . '.' . $file_ext;
            $upload_path = $upload_dir . $new_filename;
            if (move_uploaded_file($file_tmp, $upload_path)) { $url_img_orig_producto = '../archivador/img_producto/' . $new_filename; $url_img_min_producto = $url_img_orig_producto; }
        }
    }
    // Validaciones básicas
    if (empty($nombre_producto)) { echo json_encode(['success' => false, 'message' => 'El nombre del producto es obligatorio']); exit; }
    if (empty($cod_producto_barra)) { echo json_encode(['success' => false, 'message' => 'El código de producto es obligatorio']); exit; }
    if ($precio_compra_producto < 0 || $precio_venta_producto < 0) { echo json_encode(['success' => false, 'message' => 'Los precios no pueden ser negativos']); exit; }
    // Verificar que la tienda existe
    $check_tienda = "SELECT cod_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $result_tienda = mysqli_query($conectar, $check_tienda);
    
    if (mysqli_num_rows($result_tienda) == 0) { echo json_encode(['success' => false, 'message' => 'La tienda no existe']); exit; }
    // Verificar si el código de producto ya existe en esta tienda
    $check_codigo = "SELECT cod_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra' AND cod_tienda = '$cod_tienda'";
    $result_codigo = mysqli_query($conectar, $check_codigo);
    
    if (mysqli_num_rows($result_codigo) > 0) { echo json_encode(['success' => false, 'message' => 'Ya existe un producto con este código en la tienda']); exit; }    
    // Insertar el producto
    $sql_insert = "INSERT INTO tbl15_producto (cod_tienda, cod_producto_barra, nombre_producto, und_producto, precio_compra_producto, precio_venta_producto, cod_categoria,
    iva_ptj, descripcion_producto, cod_estado, fecha_creacion, active_producto, url_img_orig_producto, url_img_min_producto, url_img_producto_orig, url_img_producto_min) 
    VALUES ('$cod_tienda', '$cod_producto_barra', UPPER('$nombre_producto'), '$und_producto', '$precio_compra_producto', '$precio_venta_producto', '$cod_categoria',
    '$iva_ptj', '$descripcion_producto', '$cod_estado', '$fecha_creacion', 'SI', '$url_img_orig_producto', '$url_img_min_producto', '$url_img_orig_producto', '$url_img_min_producto')";
    $result_insert = mysqli_query($conectar, $sql_insert);
    
    if ($result_insert) {
        echo json_encode(['success' => true, 'message' => 'Producto registrado correctamente', 'cod_producto' => mysqli_insert_id($conectar)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el producto: ' . mysqli_error($conectar) ]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>