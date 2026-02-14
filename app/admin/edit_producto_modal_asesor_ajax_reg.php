<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
if (!verificar_usuario()) { header("Location:../index.php"); exit; }
header('Content-Type: application/json');
$respuesta_ajax = array();
if (!isset($_POST['cod_producto']) || !intval($_POST['cod_producto'])) {
    $respuesta_ajax['afectado'] = 'NO';
    $respuesta_ajax['mensaje'] = 'cod_producto inválido';
    echo json_encode($respuesta_ajax); exit;
}
$cod_producto = intval($_POST['cod_producto']);
$cod_producto_barra = isset($_POST['cod_producto_barra']) ? mysqli_real_escape_string($conectar, $_POST['cod_producto_barra']) : '';
$nombre_producto = isset($_POST['nombre_producto']) ? mysqli_real_escape_string($conectar, $_POST['nombre_producto']) : '';
$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
$und_producto = isset($_POST['und_producto']) ? intval($_POST['und_producto']) : 1;
$precio_compra_producto = isset($_POST['precio_compra_producto']) ? intval($_POST['precio_compra_producto']) : 0;
$precio_venta_producto = isset($_POST['precio_venta_producto']) ? intval($_POST['precio_venta_producto']) : 0;
$cod_categoria = isset($_POST['cod_categoria']) ? intval($_POST['cod_categoria']) : 0;
$iva_ptj = isset($_POST['iva_ptj']) ? intval($_POST['iva_ptj']) : '';
$descripcion_producto = isset($_POST['descripcion_producto']) ? mysqli_real_escape_string($conectar, $_POST['descripcion_producto']) : '';
$cod_estado = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 0;

// Validaciones basicas
$errores = array();
if (trim($cod_producto_barra) === '') $errores[] = 'cod_producto_barra';
if (trim($nombre_producto) === '') $errores[] = 'nombre_producto';
if ($cod_tienda <= 0) $errores[] = 'cod_tienda';
if ($precio_compra_producto === '') $errores[] = 'precio_compra_producto';
if ($precio_venta_producto === '') $errores[] = 'precio_venta_producto';
if ($cod_categoria <= 0) $errores[] = 'cod_categoria';
if ($cod_estado <= 0) $errores[] = 'cod_estado';
if (!empty($errores)) { $respuesta_ajax['afectado']='NO'; $respuesta_ajax['mensaje']='Faltan: '.implode(', ',$errores); echo json_encode($respuesta_ajax); exit; }
// precio checks
if ($precio_venta_producto <= 0) { $respuesta_ajax['afectado']='NO'; $respuesta_ajax['mensaje']='Faltan o son inválidos los campos: precio_venta_producto'; echo json_encode($respuesta_ajax); exit; }
if ($precio_venta_producto < $precio_compra_producto) { $respuesta_ajax['afectado']='NO'; $respuesta_ajax['mensaje']='Faltan o son inválidos los campos: precio_venta_producto, precio_compra_producto'; echo json_encode($respuesta_ajax); exit; }

// manejar posible nueva imagen
$url_img_min_producto = '';
$url_img_orig_producto = '';
if (isset($_FILES['imagen_producto']) && isset($_FILES['imagen_producto']['tmp_name']) && $_FILES['imagen_producto']['error'] == UPLOAD_ERR_OK) {
    $upload = $_FILES['imagen_producto'];
    $tmp = $upload['tmp_name'];
    $origDir = __DIR__ . '/../archivador/foto/original/';
    $miniDir = __DIR__ . '/../archivador/foto/miniatura/';
    if (!is_dir($origDir)) { mkdir($origDir, 0755, true); }
    if (!is_dir($miniDir)) { mkdir($miniDir, 0755, true); }
    $ext = pathinfo($upload['name'], PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $allowed = array('jpg','jpeg','png','gif');
    if (in_array($ext, $allowed)) {
        $base = 'prod_' . time() . '_' . mt_rand(1000,9999);
        $origName = $base . '.' . $ext;
        $miniName = $base . '_min.' . $ext;
        $origPath = $origDir . $origName;
        $miniPath = $miniDir . $miniName;
        if (move_uploaded_file($tmp, $origPath)) {
            // create thumbnail
            function create_thumbnail_edit($src, $dest, $maxW = 300, $maxH = 300) {
                $info = @getimagesize($src);
                if (!$info) return false;
                $mime = $info['mime'];
                switch ($mime) { case 'image/jpeg': $img = imagecreatefromjpeg($src); break; case 'image/png': $img = imagecreatefrompng($src); break; case 'image/gif': $img = imagecreatefromgif($src); break; default: return false; }
                $w = imagesx($img); $h = imagesy($img);
                $scale = min($maxW / $w, $maxH / $h);
                if ($scale < 1) { $newW = floor($w * $scale); $newH = floor($h * $scale); } else { $newW = $w; $newH = $h; }
                $tmpImg = imagecreatetruecolor($newW, $newH);
                if ($mime == 'image/png' || $mime == 'image/gif') {
                    imagecolortransparent($tmpImg, imagecolorallocatealpha($tmpImg, 0, 0, 0, 127));
                    imagealphablending($tmpImg, false);
                    imagesavealpha($tmpImg, true);
                }
                imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newW, $newH, $w, $h);
                switch ($mime) { case 'image/jpeg': imagejpeg($tmpImg, $dest, 85); break; case 'image/png': imagepng($tmpImg, $dest); break; case 'image/gif': imagegif($tmpImg, $dest); break; }
                imagedestroy($img); imagedestroy($tmpImg);
                return true;
            }
            @create_thumbnail_edit($origPath, $miniPath, 300, 300);
            $url_img_orig_producto = '../archivador/foto/original/' . $origName;
            $url_img_min_producto = '../archivador/foto/miniatura/' . $miniName;
        }
    }
}

// preparar UPDATE
$sets = array();
$sets[] = "cod_producto_barra='".mysqli_real_escape_string($conectar,$cod_producto_barra)."'";
$sets[] = "nombre_producto=UPPER('".mysqli_real_escape_string($conectar,$nombre_producto)."')";
$sets[] = "cod_tienda='".intval($cod_tienda)."'";
$sets[] = "und_producto='".intval($und_producto)."'";
$sets[] = "precio_compra_producto='".intval($precio_compra_producto)."'";
$sets[] = "precio_venta_producto='".intval($precio_venta_producto)."'";
$sets[] = "cod_categoria='".intval($cod_categoria)."'";
$sets[] = "iva_ptj='".mysqli_real_escape_string($conectar,$iva_ptj)."'";
$sets[] = "descripcion_producto='".mysqli_real_escape_string($conectar,$descripcion_producto)."'";
if ($url_img_min_producto !== '') $sets[] = "url_img_min_producto='".mysqli_real_escape_string($conectar,$url_img_min_producto)."'";
if ($url_img_orig_producto !== '') $sets[] = "url_img_orig_producto='".mysqli_real_escape_string($conectar,$url_img_orig_producto)."'";
$sets[] = "cod_estado='".intval($cod_estado)."'";

$sql_up = "UPDATE tbl15_producto SET ".implode(', ',$sets)." WHERE cod_producto='".intval($cod_producto)."' LIMIT 1";
// Ejecutar update y manejar errores/diagnóstico
$exec_up = mysqli_query($conectar, $sql_up);
$sql_error = mysqli_error($conectar);
$affected = mysqli_affected_rows($conectar);
if ($exec_up === false) {
    $respuesta_ajax['afectado'] = 'NO';
    $respuesta_ajax['mensaje'] = 'Error en la consulta SQL.';
    $respuesta_ajax['error_sql'] = $sql_error;
    $respuesta_ajax['sql'] = $sql_up;
    echo json_encode($respuesta_ajax);
    exit;
}

if ($affected > 0) {
    $respuesta_ajax['afectado'] = 'SI';
    $respuesta_ajax['mensaje'] = 'Hecho correctamente.';
} else {
    // Ninguna fila afectada: puede deberse a que no hubo cambios o el id no existe
    $respuesta_ajax['afectado'] = 'NO';
    $respuesta_ajax['mensaje'] = 'No se detectaron cambios o id inexistente.';
    $respuesta_ajax['filas_afectadas'] = $affected;
    $respuesta_ajax['sql'] = $sql_up;
}
echo json_encode($respuesta_ajax);
?>