<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include("../session/funciones_admin.php");
// Verificar sesión
if (!verificar_usuario()) { header('Content-Type: application/json'); echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit; }
header('Content-Type: application/json');

// Verificar que se recibieron los datos necesarios
$cod_info_factura_venta_recibido = isset($_POST['cod_info_factura_venta']) ? $_POST['cod_info_factura_venta'] : null;
$archivo_recibido = isset($_FILES['comprobante']) ? $_FILES['comprobante'] : null;

if (empty($cod_info_factura_venta_recibido)) { echo json_encode(['success' => false, 'mensaje' => 'Código de crédito no recibido']); exit; }
if (!$archivo_recibido || !isset($archivo_recibido['tmp_name']) || empty($archivo_recibido['tmp_name'])) { echo json_encode(['success' => false, 'mensaje' => 'Archivo de comprobante no recibido']); exit; }

$cod_info_factura_venta = intval($cod_info_factura_venta_recibido);
$archivo = $archivo_recibido;

// Validar que el crédito existe
$sql_check = "SELECT cod_info_factura_venta, nombre_estado_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$result_check = mysqli_query($conectar, $sql_check);
if (mysqli_num_rows($result_check) == 0) { echo json_encode(['success' => false, 'mensaje' => 'El crédito no existe']); exit; }

$datos_credito = mysqli_fetch_assoc($result_check);
$nombre_estado_factura = $datos_credito['nombre_estado_factura'];
// Validar archivo
if ($archivo['error'] !== UPLOAD_ERR_OK) { echo json_encode(['success' => false, 'mensaje' => 'Error al cargar el archivo']); exit; }
// Validar tamaño (máximo 10MB)
if ($archivo['size'] > 10 * 1024 * 1024) { echo json_encode(['success' => false, 'mensaje' => 'El archivo no debe superar los 10MB']); exit; }
// Validar tipo de archivo
$allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
// Usar el tipo MIME del archivo subido (más compatible)
$file_type = $archivo['type'];

if (!in_array($file_type, $allowed_types)) { echo json_encode(['success' => false, 'mensaje' => 'Tipo de archivo no permitido. Solo imágenes (JPG, PNG) y documentos (PDF, DOC, DOCX)']); exit; }
// Obtener extensión del archivo
$extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
// Generar nombre único para el archivo
$fecha = date('Y-m-d_H-i-s');
$nombre_archivo = 'comprobante_' . $cod_info_factura_venta . '_' . $fecha . '.' . $extension;
$carpeta_destino = '../archivador/documentos/comprobante_pago/';
// Determinar carpeta de destino según el estado
//if ($nombre_estado_factura == 'CERRADA') { $carpeta_destino = '../documentos/'; } else { $carpeta_destino = '../documentos/'; }
// Crear carpeta si no existe
if (!file_exists($carpeta_destino)) { mkdir($carpeta_destino, 0777, true); }

$ruta_completa = $carpeta_destino.$nombre_archivo;
$url_img_orig_producto = $ruta_completa;
// Mover archivo a la carpeta destino
if (move_uploaded_file($archivo['tmp_name'], $ruta_completa)) {
    // Actualizar base de datos
    $url_relativa = str_replace('../', '', $ruta_completa);
    
    $sql_update = "UPDATE tbl15_info_factura_venta SET url_img_orig_producto = '$url_img_orig_producto' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $result_update = mysqli_query($conectar, $sql_update);
    
    if ($result_update) {
        echo json_encode(['success' => true, 'mensaje' => 'Comprobante de pago cargado correctamente', 'url' => $url_relativa]);
    } else {
        // Si falla la actualización, eliminar el archivo
        unlink($ruta_completa);
        echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar la base de datos: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Error al guardar el archivo en el servidor']);
}
?>
