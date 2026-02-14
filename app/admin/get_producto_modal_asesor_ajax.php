<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
if (!verificar_usuario()) { header("Location:../index.php"); exit; }
header('Content-Type: application/json');
$respuesta = array();
if (!isset($_GET['cod_producto']) || !intval($_GET['cod_producto'])) { $respuesta['afectado'] = 'NO'; $respuesta['mensaje'] = 'cod_producto inválido'; echo json_encode($respuesta); exit; }
$cod_producto = intval($_GET['cod_producto']);
$sql = "SELECT p.*, t.nombre_tienda, c.nombre_categoria, e.nombre_estado FROM tbl15_producto p 
LEFT JOIN tbl15_tienda t ON t.cod_tienda = p.cod_tienda
LEFT JOIN tbl15_categoria c ON c.cod_categoria = p.cod_categoria
LEFT JOIN tbl15_estado e ON e.cod_estado = p.cod_estado
WHERE p.cod_producto = '".intval($cod_producto)."' LIMIT 1";
$q = mysqli_query($conectar, $sql);
if (!$q) {
    $respuesta['afectado'] = 'NO';
    $respuesta['mensaje'] = 'Error en consulta';
    echo json_encode($respuesta);
    exit;
}
if (mysqli_num_rows($q) == 0) {
    $respuesta['afectado'] = 'NO';
    $respuesta['mensaje'] = 'Producto no encontrado';
    echo json_encode($respuesta);
    exit;
}
$row = mysqli_fetch_assoc($q);
$producto = array(
    'cod_producto' => $row['cod_producto'],
    'cod_producto_barra' => $row['cod_producto_barra'],
    'nombre_producto' => $row['nombre_producto'],
    'cod_tienda' => $row['cod_tienda'],
    'nombre_tienda' => $row['nombre_tienda'],
    'precio_compra_producto' => $row['precio_compra_producto'],
    'precio_venta_producto' => $row['precio_venta_producto'],
    'cod_categoria' => $row['cod_categoria'],
    'nombre_categoria' => $row['nombre_categoria'],
    'iva_ptj' => $row['iva_ptj'],
    'descripcion_producto' => $row['descripcion_producto'],
    'url_img_min_producto' => $row['url_img_min_producto'],
    'url_img_orig_producto' => $row['url_img_orig_producto'],
    'cod_estado' => $row['cod_estado'],
    'nombre_estado' => $row['nombre_estado']
);
// Cargar opciones para selects
$tiendas = array();
$q2 = mysqli_query($conectar, "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_estado = '1' ORDER BY nombre_tienda ASC");
while($r = mysqli_fetch_assoc($q2)) { $tiendas[] = $r; }
$categorias = array();
$q3 = mysqli_query($conectar, "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC");
while($r = mysqli_fetch_assoc($q3)) { $categorias[] = $r; }
$ivas = array();
$q4 = mysqli_query($conectar, "SELECT iva FROM tbl15_tipo_iva WHERE cod_estado = '1' ORDER BY iva ASC");
while($r = mysqli_fetch_assoc($q4)) { $ivas[] = $r; }
$estados = array();
$q5 = mysqli_query($conectar, "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC");
while($r = mysqli_fetch_assoc($q5)) { $estados[] = $r; }

$respuesta['afectado'] = 'SI';
$respuesta['producto'] = $producto;
$respuesta['tiendas'] = $tiendas;
$respuesta['categorias'] = $categorias;
$respuesta['ivas'] = $ivas;
$respuesta['estados'] = $estados;

echo json_encode($respuesta);
?>