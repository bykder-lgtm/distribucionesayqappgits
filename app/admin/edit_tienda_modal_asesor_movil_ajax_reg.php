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
$nombre_tienda = isset($_POST['nombre1_tercero']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['nombre1_tercero']))) : '';
$identificacion_tercero = isset($_POST['identificacion_tercero']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['identificacion_tercero']))) : '';
$telefono1_tercero = isset($_POST['telefono_tienda']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['telefono_tienda']))) : '';
$direccion_tercero = isset($_POST['direccion_tercero']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['direccion_tercero']))) : '';
$barrio_tercero = isset($_POST['barrio_tercero']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['barrio_tercero']))) : '';
$correo_tercero = isset($_POST['correo_tercero']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['correo_tercero']))) : '';

// Nuevos campos de información del negocio
$cod_tipo_sector = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
$existe_rues = isset($_POST['existe_rues']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['existe_rues']))) : '';
$venta_presencial = isset($_POST['venta_presencial']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['venta_presencial']))) : '';
$venta_online = isset($_POST['venta_online']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['venta_online']))) : '';
$nombre_plataforma_ecommerce = isset($_POST['nombre_plataforma_ecommerce']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['nombre_plataforma_ecommerce']))) : '';
$nombre_sistema_contable = isset($_POST['nombre_sistema_contable']) ? mysqli_real_escape_string($conectar, trim(addslashes($_POST['nombre_sistema_contable']))) : '';

// Otros campos
$cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? mysqli_real_escape_string($conectar, $_POST['cod_aliado_estrategico']) : '';
$cod_banco_cuenta = isset($_POST['cod_banco_cuenta']) ? mysqli_real_escape_string($conectar, $_POST['cod_banco_cuenta']) : '';
$ubicacion_gps_tienda = isset($_POST['ubicacion_gps_tienda']) ? mysqli_real_escape_string($conectar, $_POST['ubicacion_gps_tienda']) : '';
$cod_departamento = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
$cod_municipio = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
$cod_tipo_tienda = ($cod_aliado_estrategico == '0' || empty($cod_aliado_estrategico)) ? 1 : 0;

// Funciones para procesar archivos e imágenes
function procesarArchivo($fKey, $fDir, $fAllow = null) {
    global $conectar;
    if (!isset($_FILES[$fKey]) || $_FILES[$fKey]['error'] != 0) { return null; }
    
    $fData = $_FILES[$fKey];
    $fName = $fData['name'];

    // Validar extensión si se especifican permitidos
    if ($fAllow !== null) {
        $pInf = pathinfo($fName);
        $fExt = isset($pInf['extension']) ? $pInf['extension'] : '';
        $fExt = strtolower($fExt);
        if (!in_array($fExt, $fAllow)) { return null; }
    }

    if (!file_exists($fDir)) { mkdir($fDir, 0777, true); }
    $fSanit = preg_replace('/[^a-zA-Z0-9\._-]/', '', $fName);
    $fFinal = time() . '_' . $fSanit;
    $fDest = $fDir . $fFinal;
    $fTmp = $fData['tmp_name'];
    
    if (move_uploaded_file($fTmp, $fDest)) { return $fDest; }
    return null;
}
function procesarImagen($imgKey, $origPath) {
    if (!isset($_FILES[$imgKey]) || $_FILES[$imgKey]['error'] != 0) { return array('orig' => null, 'min' => null); }
    $imgObj = $_FILES[$imgKey];
    
    if (!file_exists($origPath)) { mkdir($origPath, 0777, true); }
    $iNm = preg_replace('/[^a-zA-Z0-9\._-]/', '', $imgObj['name']);
    $iSave = time() . '_' . $iNm;
    $iRuta = $origPath . $iSave;
    $iTmp = $imgObj['tmp_name'];
    
    if (move_uploaded_file($iTmp, $iRuta)) { return array('orig' => $iRuta, 'min' => $iRuta); }
    return array('orig' => null, 'min' => null);
}
// Construir SQL UPDATE dinámicamente
$campos_update = array();
$campos_update[] = "nombre_tienda = UPPER('$nombre_tienda')";
$campos_update[] = "nombre1_tercero = UPPER('$nombre_tienda')";
$campos_update[] = "identificacion_tercero = '$identificacion_tercero'";
$campos_update[] = "nit_razon_social = '$identificacion_tercero'";
$campos_update[] = "telefono1_tercero = '$telefono1_tercero'";
$campos_update[] = "direccion_tercero = UPPER('$direccion_tercero')";
$campos_update[] = "barrio_tercero = UPPER('$barrio_tercero')";
$campos_update[] = "correo_tercero = '$correo_tercero'";
$campos_update[] = "cod_tipo_sector = '$cod_tipo_sector'";
$campos_update[] = "existe_rues = '$existe_rues'";
$campos_update[] = "venta_presencial = '$venta_presencial'";
$campos_update[] = "venta_online = '$venta_online'";
$campos_update[] = "nombre_plataforma_ecommerce = UPPER('$nombre_plataforma_ecommerce')";
$campos_update[] = "nombre_sistema_contable = UPPER('$nombre_sistema_contable')";
$campos_update[] = "cod_aliado_estrategico = '$cod_aliado_estrategico'";
$campos_update[] = "cod_banco_cuenta = '$cod_banco_cuenta'";
$campos_update[] = "ubicacion_gps_tienda = '$ubicacion_gps_tienda'";
$campos_update[] = "cod_tipo_tienda = '$cod_tipo_tienda'";
$campos_update[] = "cod_departamento = '$cod_departamento'";
$campos_update[] = "cod_municipio = '$cod_municipio'";

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

// ========== PROCESAR DOCUMENTACIÓN LEGAL (Solo PDF) ==========
$directorio_docs = '../archivador/documentacion_tienda/';
$permitidos_pdf = array('pdf');
$url_rut = procesarArchivo('url_rut_tienda', $directorio_docs, $permitidos_pdf);
if ($url_rut) { $sql_update .= ", url_documentacion_rut_tienda = '$url_rut'"; }

$url_camara = procesarArchivo('url_camara_comercio_tienda', $directorio_docs, $permitidos_pdf);
if ($url_camara) { $sql_update .= ", url_documentacion_camaracomercio_tienda = '$url_camara'"; }
$sql_update .= " WHERE cod_tienda = $cod_tienda";
if (mysqli_query($conectar, $sql_update)) { echo json_encode(['success' => true, 'message' => 'Tienda actualizada correctamente', 'nombre_tienda' => $nombre_tienda]); } else { echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); }
?>
