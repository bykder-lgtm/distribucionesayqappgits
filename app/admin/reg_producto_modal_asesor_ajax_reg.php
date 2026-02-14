<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);
//$cuenta                                     = $_SESSION['usuario'];

$retorno_array                                                      = array();
$retorno_array2                                                     = array();
$codigoHTML_menu                                                    = '';
$codigoHTML_menu_total_reg                                          = '';
$respuesta_ajax                                                     = array();

if (isset($_POST['cod_producto_barra'])) {
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

    // Validación servidor: campos obligatorios
    $errores = array();
    if (!isset($_POST['cod_producto_barra']) || trim($_POST['cod_producto_barra']) === '') { $errores[] = 'cod_producto_barra'; }
    if (!isset($_POST['nombre_producto']) || trim($_POST['nombre_producto']) === '') { $errores[] = 'nombre_producto'; }
    if (!isset($_POST['cod_tienda']) || trim($_POST['cod_tienda']) === '' || intval($_POST['cod_tienda']) <= 0) { $errores[] = 'cod_tienda'; }
    if (!isset($_POST['precio_compra_producto']) || trim($_POST['precio_compra_producto']) === '') { $errores[] = 'precio_compra_producto'; }
    if (!isset($_POST['precio_venta_producto']) || trim($_POST['precio_venta_producto']) === '') { $errores[] = 'precio_venta_producto'; }
    if (!isset($_POST['cod_categoria']) || trim($_POST['cod_categoria']) === '' || intval($_POST['cod_categoria']) <= 0) { $errores[] = 'cod_categoria'; }
    if (!isset($_POST['cod_estado']) || trim($_POST['cod_estado']) === '' || intval($_POST['cod_estado']) <= 0) { $errores[] = 'cod_estado'; }
    if (!isset($_FILES['imagen_producto']) || !isset($_FILES['imagen_producto']['tmp_name']) || $_FILES['imagen_producto']['error'] !== UPLOAD_ERR_OK) { $errores[] = 'imagen_producto'; }

    if (!empty($errores)) {
        header('Content-Type: application/json');
        $respuesta_ajax['afectado'] = 'NO';
        $respuesta_ajax['mensaje'] = 'Faltan o son inválidos los campos: ' . implode(', ', $errores);
        echo json_encode($respuesta_ajax);
        exit;
    }

    // Validación servidor adicional: precio_venta_producto debe ser mayor a 0
    if (intval($precio_venta_producto) <= 0) {
        header('Content-Type: application/json');
        $respuesta_ajax['afectado'] = 'NO';
        $respuesta_ajax['mensaje'] = 'Faltan o son inválidos los campos: precio_venta_producto';
        echo json_encode($respuesta_ajax);
        exit;
    }

    // Validación servidor adicional: precio_venta_producto debe ser >= precio_compra_producto
    if (intval($precio_venta_producto) < intval($precio_compra_producto)) {
        header('Content-Type: application/json');
        $respuesta_ajax['afectado'] = 'NO';
        $respuesta_ajax['mensaje'] = 'Faltan o son inválidos los campos: precio_venta_producto, precio_compra_producto';
        echo json_encode($respuesta_ajax);
        exit;
    }

    // manejar subida de imagen (original + miniatura)
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
                // crear miniatura
                function create_thumbnail($src, $dest, $maxW = 300, $maxH = 300) {
                    $info = @getimagesize($src);
                    if (!$info) return false;
                    $mime = $info['mime'];
                    switch ($mime) { case 'image/jpeg': $img = imagecreatefromjpeg($src); break; case 'image/png': $img = imagecreatefrompng($src); break; 
                        case 'image/gif': $img = imagecreatefromgif($src); break; default: return false; }
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
                @create_thumbnail($origPath, $miniPath, 300, 300);
                $url_img_orig_producto = '../archivador/foto/original/' . $origName;
                $url_img_min_producto = '../archivador/foto/miniatura/' . $miniName;
            }
        }
    }    
    $nombre_tipo_producto                                               = 'PRODUCTO';
    $nombre_tipo_unidad_medida                                          = "UND";
    $nombre_tipo_precio_venta                                           = "PV1";
    $nombre_promocion                                                   = "Nuevo";
    $nombre_promocion_ing                                               = "new";
    $cod_promocion                                                      = "1";
    $nombre_estado                                                      = "HABILITADO";
    $cod_dependencia                                                    = "1";
    $fecha_creacion                                                     = date("Y-m-d H:i:s");

    $sql_autoincremento_tienda = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_producto'";
    $exec_autoincremento_tienda = mysqli_query($conectar, $sql_autoincremento_tienda) or die(mysqli_error($conectar));
    $datos_autoincremento_tienda = mysqli_fetch_assoc($exec_autoincremento_tienda);

    $cod_producto                                                       = $datos_autoincremento_tienda['AUTO_INCREMENT'];
    $abrev_tienda                                                       = 'TIENDA'.$cod_tienda;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_producto = "SELECT cod_producto FROM tbl15_producto WHERE cod_producto_barra = '".($cod_producto_barra)."' AND (cod_tienda = '".($cod_tienda)."')";
	$consultar_dato_producto = mysqli_query($conectar, $sql_dato_producto) or die(mysqli_error($conectar));
	$info_dato_producto = mysqli_fetch_assoc($consultar_dato_producto);
	$existe_dato_producto = mysqli_num_rows(@$consultar_dato_producto);

	//$cod_administrador                                              = intval($info_dato_aliado['cod_administrador']);
	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_producto > 0) {

    } else {
        $sql_data = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, cod_tienda, und_producto, precio_compra_producto, precio_venta_producto, 
        cod_categoria, iva_ptj, descripcion_producto, url_img_min_producto, url_img_orig_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_precio_venta, nombre_promocion, 
        nombre_promocion_ing, cod_promocion, nombre_estado, cod_dependencia, fecha_creacion, cod_estado) 
        VALUES ('$cod_producto_barra', UPPER('$nombre_producto'), '$cod_tienda', '$und_producto', '$precio_compra_producto', '$precio_venta_producto', 
        '$cod_categoria', '$iva_ptj', '$descripcion_producto', " . ( ($url_img_min_producto!=='') ? "'".$url_img_min_producto."'" : "''" ) . ", " . ( ($url_img_orig_producto!=='') ? "'".$url_img_orig_producto."'" : "''" ) . ", '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_precio_venta', '$nombre_promocion', 
        '$nombre_promocion_ing', '$cod_promocion', '$nombre_estado', '$cod_dependencia', '$fecha_creacion', '$cod_estado')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                    = $afectado;
	$respuesta_ajax['cod_producto']                = $cod_producto;
	$respuesta_ajax['mensaje']                     = 'Hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>