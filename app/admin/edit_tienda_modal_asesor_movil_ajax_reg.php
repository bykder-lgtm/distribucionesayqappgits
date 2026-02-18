<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cod_administrador = ($_SESSION['cod_administrador']);
// Leer cod_tienda desde 'cod_tienda_edit' que es el nombre del campo en el formulario
$cod_tienda = isset($_POST['cod_tienda_edit']) ? intval($_POST['cod_tienda_edit']) : (isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0);
if ($cod_tienda <= 0) { echo json_encode(['success' => false, 'message' => 'ID de tienda inválido']); exit; }
// Variables POST - Mapeadas según estructura de tbl15_tienda con valores por defecto
$nombre_tienda = isset($_POST['nombre1_tercero']) ? mysqli_real_escape_string($conectar, $_POST['nombre1_tercero']) : '';
// Campos eliminados del formulario - mantener valores existentes o usar por defecto
$identificacion_tercero = isset($_POST['identificacion_tercero']) && !empty($_POST['identificacion_tercero']) ? mysqli_real_escape_string($conectar, $_POST['identificacion_tercero']) : ''; // Dejar vacío para que no se actualice si no viene
$telefono1_tercero = isset($_POST['telefono1_tercero']) && !empty($_POST['telefono1_tercero']) ? mysqli_real_escape_string($conectar, $_POST['telefono1_tercero']) : ''; // Dejar vacío para no actualizar
$direccion_tercero = isset($_POST['direccion_tercero']) && !empty($_POST['direccion_tercero']) ? mysqli_real_escape_string($conectar, $_POST['direccion_tercero']) : ''; // Dejar vacío para no actualizar
$barrio_tercero = isset($_POST['barrio_tercero']) && !empty($_POST['barrio_tercero']) ? mysqli_real_escape_string($conectar, $_POST['barrio_tercero'])  : ''; // Dejar vacío para no actualizar
$correo_tercero = isset($_POST['correo_tercero']) && !empty($_POST['correo_tercero']) ? mysqli_real_escape_string($conectar, $_POST['correo_tercero']) : ''; // Dejar vacío para no actualizar
$nombre_representante = isset($_POST['nombre_representante']) && !empty($_POST['nombre_representante']) ? mysqli_real_escape_string($conectar, $_POST['nombre_representante']) : ''; // Dejar vacío para no actualizar
$documento_representante = isset($_POST['documento_representante']) && !empty($_POST['documento_representante']) ? intval($_POST['documento_representante']) : ''; // Null para no actualizar
$correo_representante = isset($_POST['correo_representante']) && !empty($_POST['correo_representante']) ? mysqli_real_escape_string($conectar, $_POST['correo_representante']) : ''; // Dejar vacío para no actualizar
// Campos que sí vienen del formulario
$cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? mysqli_real_escape_string($conectar, $_POST['cod_aliado_estrategico']) : '';
$cod_banco_cuenta = isset($_POST['cod_banco_cuenta']) ? mysqli_real_escape_string($conectar, $_POST['cod_banco_cuenta']) : '';
$ubicacion_gps_tienda = isset($_POST['ubicacion_gps_tienda']) ? mysqli_real_escape_string($conectar, $_POST['ubicacion_gps_tienda']) : '';
// Funciones para procesar archivos e imágenes
function procesarArchivo($file_key, $directorio) {
    global $conectar;
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return null; }
    if (!file_exists($directorio)) { mkdir($directorio, 0777, true); }
    $nombre_archivo = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_archivo = $directorio . $nombre_archivo;
    if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_archivo)) { return $ruta_archivo; }
    return null;
}
function procesarImagen($file_key, $directorio_orig) {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return array('orig' => null, 'min' => null); }
    if (!file_exists($directorio_orig)) { mkdir($directorio_orig, 0777, true); }
    $nombre_archivo = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_orig = $directorio_orig . $nombre_archivo;
    if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_orig)) { return array('orig' => $ruta_orig, 'min' => $ruta_orig); }
    return array('orig' => null, 'min' => null);
}
// Construir SQL UPDATE dinámicamente - solo actualiza campos que vienen del formulario
$campos_update = array();
$campos_update[] = "nombre_tienda = '$nombre_tienda'";
$campos_update[] = "nombre1_tercero = '$nombre_tienda'";
// Solo actualizar estos campos si vienen con valor
if (!empty($identificacion_tercero)) { $campos_update[] = "identificacion_tercero = '$identificacion_tercero'"; }
if (!empty($telefono1_tercero)) { $campos_update[] = "telefono1_tercero = '$telefono1_tercero'"; }
if (!empty($direccion_tercero)) { $campos_update[] = "direccion_tercero = '$direccion_tercero'"; }
if (!empty($barrio_tercero)) { $campos_update[] = "barrio_tercero = '$barrio_tercero'"; }
if (!empty($correo_tercero)) { $campos_update[] = "correo_tercero = '$correo_tercero'"; }
if (!empty($nombre_representante)) { $campos_update[] = "nombre_representante = '$nombre_representante'"; }
if ($documento_representante !== null) { $campos_update[] = "documento_representante = '$documento_representante'"; }
if (!empty($correo_representante)) { $campos_update[] = "correo_representante = '$correo_representante'"; }
// Campos que sí vienen del formulario
$campos_update[] = "cod_aliado_estrategico = '$cod_aliado_estrategico'";
$campos_update[] = "cod_banco_cuenta = '$cod_banco_cuenta'";
$campos_update[] = "ubicacion_gps_tienda = '$ubicacion_gps_tienda'";
$sql_update = "UPDATE tbl15_tienda SET " . implode(", ", $campos_update);
// Procesar logo de la tienda
$imgs_logo = procesarImagen('imagen_tienda', '../archivador/img_tienda/orig/');
if ($imgs_logo['orig']) { $sql_update .= ", url_img_orig_tienda = '{$imgs_logo['orig']}', url_img_min_tienda = '{$imgs_logo['min']}'"; }
// Procesar imagen de fachada
$imgs_fachada = procesarImagen('url_img_fachada_tienda', '../archivador/img_establecimiento/');
if ($imgs_fachada['orig']) { $sql_update .= ", url_img_fachada_tienda = '{$imgs_fachada['orig']}'"; }
// Procesar imagen interna
$imgs_interna = procesarImagen('url_img_interna_tienda', '../archivador/img_establecimiento/');
if ($imgs_interna['orig']) { $sql_update .= ", url_img_interna_tienda = '{$imgs_interna['orig']}'"; }
// Procesar selfie con admin
$imgs_selfie = procesarImagen('url_img_selfieadmin_tienda', '../archivador/img_establecimiento/');
if ($imgs_selfie['orig']) { $sql_update .= ", url_img_selfieadmin_tienda = '{$imgs_selfie['orig']}'"; }
$sql_update .= " WHERE cod_tienda = $cod_tienda AND cod_administrador = '$cod_administrador'";
if (mysqli_query($conectar, $sql_update)) { echo json_encode(['success' => true, 'message' => 'Tienda actualizada correctamente', 'nombre_tienda' => $nombre_tienda]); } else { echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); }
?>
