<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); }
$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);

$retorno_array                                                      = array();
$retorno_array2                                                     = array();
$codigoHTML_menu                                                    = '';
$codigoHTML_menu_total_reg                                          = '';
$respuesta_ajax                                                     = array();
// ========== FUNCIÓN PARA PROCESAR ARCHIVOS ==========
function procesarArchivo($file_key, $directorio, $prefijo = '') {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return ''; }
    if (!file_exists($directorio)) { mkdir($directorio, 0777, true); }
    $nombre_archivo = $prefijo . time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_archivo = $directorio . $nombre_archivo;
    if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_archivo)) { return $ruta_archivo; }
    return '';
}
// ========== FUNCIÓN PARA PROCESAR IMÁGENES CON MINIATURA ==========
function procesarImagen($file_key, $directorio_orig, $directorio_min = null, $ancho_min = 200) {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] != 0) { return array('orig' => '', 'min' => ''); }
    if (!file_exists($directorio_orig)) { mkdir($directorio_orig, 0777, true); }
    if ($directorio_min && !file_exists($directorio_min)) { mkdir($directorio_min, 0777, true); }
    
    $nombre_archivo                                                 = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES[$file_key]['name']);
    $ruta_orig                                                      = $directorio_orig . $nombre_archivo;
    if (!move_uploaded_file($_FILES[$file_key]['tmp_name'], $ruta_orig)) { return array('orig' => '', 'min' => ''); }
    $ruta_min                                                       = '';
    if ($directorio_min) {
        $ruta_min                                                   = $directorio_min . $nombre_archivo;
        $tipo_imagen                                                = $_FILES[$file_key]['type'];
        $dimensiones                                                = getimagesize($ruta_orig);
        if ($dimensiones) {
            $ancho_orig                                             = $dimensiones[0];
            $alto_orig                                              = $dimensiones[1];
            $alto_nuevo                                             = ($alto_orig / $ancho_orig) * $ancho_min;
            $imagen_nueva                                           = imagecreatetruecolor($ancho_min, $alto_nuevo);
            
            switch ($tipo_imagen) {
                case 'image/jpeg':
                    $imagen_orig                                    = imagecreatefromjpeg($ruta_orig);
                    break;
                case 'image/png':
                    $imagen_orig                                    = imagecreatefrompng($ruta_orig);
                    imagealphablending($imagen_nueva, false);
                    imagesavealpha($imagen_nueva, true);
                    break;
                case 'image/gif':
                    $imagen_orig = imagecreatefromgif($ruta_orig);
                    break;
                case 'image/webp':
                    $imagen_orig                                    = imagecreatefromwebp($ruta_orig);
                    break;
                default:
                    $imagen_orig                                    = @imagecreatefromjpeg($ruta_orig);
            }
            if ($imagen_orig) {
                imagecopyresampled($imagen_nueva, $imagen_orig, 0, 0, 0, 0, $ancho_min, $alto_nuevo, $ancho_orig, $alto_orig);
                
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
            }
        }
    }
    return array('orig' => $ruta_orig, 'min' => $ruta_min);
}
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['identificacion_tercero'])) {

	$identificacion_tercero                                         = trim(addslashes($_POST['identificacion_tercero']));
	$nombre1_tercero                                                = trim(addslashes($_POST['nombre1_tercero']));
	$telefono1_tercero                                              = trim(addslashes($_POST['telefono1_tercero']));
	$correo_tercero                                                 = trim(addslashes($_POST['correo_tercero']));
	$direccion_tercero                                              = trim(addslashes($_POST['direccion_tercero']));
	$barrio_tercero                                                 = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
    $cod_aliado_estrategico                                         = intval($_POST['cod_aliado_estrategico']);
    $cod_departamento                                               = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio                                                  = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
    $nombre_representante                                           = isset($_POST['nombre_representante']) ? trim(addslashes($_POST['nombre_representante'])) : '';
    $documento_representante                                        = isset($_POST['documento_representante']) ? trim(addslashes($_POST['documento_representante'])) : '';
    $correo_representante                                           = isset($_POST['correo_representante']) ? trim(addslashes($_POST['correo_representante'])) : '';
    $nombre_tipo_industria                                          = isset($_POST['nombre_tipo_industria']) ? trim(addslashes($_POST['nombre_tipo_industria'])) : '';
    $nombre_tipo_subindustria                                       = isset($_POST['nombre_tipo_subindustria']) ? trim(addslashes($_POST['nombre_tipo_subindustria'])) : '';
    $nombre_tipo_otraindustria                                      = isset($_POST['nombre_tipo_otraindustria']) ? trim(addslashes($_POST['nombre_tipo_otraindustria'])) : '';
    $numero_comercios                                               = isset($_POST['numero_comercios']) ? intval($_POST['numero_comercios']) : 1;
    $cod_tipo_sector                                                = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
    $existe_rues                                                    = isset($_POST['existe_rues']) ? trim(addslashes($_POST['existe_rues'])) : '';
    $venta_presencial                                               = isset($_POST['venta_presencial']) ? trim(addslashes($_POST['venta_presencial'])) : '';
    $venta_online                                                   = isset($_POST['venta_online']) ? trim(addslashes($_POST['venta_online'])) : '';
    $nombre_plataforma_ecommerce                                    = isset($_POST['nombre_plataforma_ecommerce']) ? trim(addslashes($_POST['nombre_plataforma_ecommerce'])) : '';
    $nombre_sistema_contable                                        = isset($_POST['nombre_sistema_contable']) ? trim(addslashes($_POST['nombre_sistema_contable'])) : '';
    $cod_banco_cuenta                                               = isset($_POST['cod_banco_cuenta']) ? intval($_POST['cod_banco_cuenta']) : 0;
    $ubicacion_gps_tienda                                           = isset($_POST['ubicacion_gps_tienda']) ? trim(addslashes($_POST['ubicacion_gps_tienda'])) : '';
    $tipo_tienda                                                    = isset($_POST['tipo_tienda']) ? trim(addslashes($_POST['tipo_tienda'])) : 'normal';
	//---------------------------------------------------------------------------------------------------------------------------------//
	$nombre_tienda                                                  = $nombre1_tercero;
    $nombre_tipo_tercero                                            = 'TIENDA';
    $nombre_tipo_cliente                                            = "PERSONA_NATURAL";
    $nombre_tipo_regimen                                            = "SIMPLE";
    $nombre_tipo_impuesto                                           = "SIMPLIFICADO";
    $fecha_creacion                                                 = date('Y-m-d H:i:s');
    $cod_estado                                                     = 1; // Activo
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_tienda = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tienda'";
    $exec_autoincremento_tienda = mysqli_query($conectar, $sql_autoincremento_tienda) or die(mysqli_error($conectar));
    $datos_autoincremento_tienda = mysqli_fetch_assoc($exec_autoincremento_tienda);

    $cod_tienda                                                     = $datos_autoincremento_tienda['AUTO_INCREMENT'];
    $cod_tienda_codif                                               = DAXCODIFCRYPTOR::encodifdax($cod_tienda);
    $cod_tienda_codifcryp                                           = DAXCODIFCRYPTOR::encriptardax($cod_tienda_codif);
    $abrev_tienda                                                   = 'TIENDA'.$cod_tienda;
    // ========== PROCESAR IMAGEN LOGO DE LA TIENDA ==========
    $img_logo                                                       = procesarImagen('imagen_tienda', '../archivador/img_tienda/orig/', '../archivador/img_tienda/min/');
    $url_img_orig_tienda                                            = $img_logo['orig'];
    $url_img_min_tienda                                             = $img_logo['min'];
    // ========== PROCESAR DOCUMENTACIÓN ==========
    $directorio_docs                                                = '../archivador/documentacion_tienda/';
    // Corregido: Se usan los nombres reales de los campos del formulario
    $url_documentacion_rut_tienda                                   = procesarArchivo('url_rut_tienda', $directorio_docs, 'rut_');
    $url_documentacion_camaracomercio_tienda                        = procesarArchivo('url_camara_comercio_tienda', $directorio_docs, 'camara_');
    $url_documentacion_contratofirma_tienda                         = procesarArchivo('url_documentacion_contratofirma_tienda', $directorio_docs, 'contrato_');
    $url_documentacion_extra1_tienda                                = procesarArchivo('url_documentacion_extra1_tienda', $directorio_docs, 'extra_');
    // ========== PROCESAR IMÁGENES DEL ESTABLECIMIENTO ==========
    $directorio_imgs                                                = '../archivador/img_establecimiento/';
    $url_img_fachada_tienda                                         = procesarArchivo('url_img_fachada_tienda', $directorio_imgs, 'fachada_');
    $url_img_interna_tienda                                         = procesarArchivo('url_img_interna_tienda', $directorio_imgs, 'interna_');
    $url_img_selfieadmin_tienda                                     = procesarArchivo('url_img_selfieadmin_tienda', $directorio_imgs, 'selfie_');
    $url_img_otraopcional_tienda                                    = procesarArchivo('url_img_otraopcional_tienda', $directorio_imgs, 'otra_');
    // La jerarquía se deriva del aliado estratégico


    // Validación básica
    if(empty($nombre1_tercero)) {
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = "El nombre de la tienda es obligatorio.";
        header('Content-Type: application/json');
        echo json_encode($respuesta_ajax);
        exit;
    }

	//---------------------------------------------------------------------------------------------------------------------------------//
	// Se verifica si la tienda ya existe con esa identificación (solo si se proporcionó una)
    if (!empty($identificacion_tercero)) {
        $sql_existe = "SELECT cod_tienda FROM tbl15_tienda WHERE identificacion_tercero = '$identificacion_tercero'";
        $res_existe = mysqli_query($conectar, $sql_existe);
        if ($res_existe && mysqli_num_rows($res_existe) > 0) {
            $respuesta_ajax['success'] = false;
            $respuesta_ajax['message'] = "Ya existe una tienda registrada con el documento $identificacion_tercero";
            header('Content-Type: application/json');
            echo json_encode($respuesta_ajax);
            exit;
        }
    }

	$sql_data = "INSERT INTO tbl15_tienda (identificacion_tercero, nombre_tienda, abrev_tienda, nombre1_tercero, telefono1_tercero, correo_tercero, direccion_tercero, barrio_tercero,
    cod_aliado_estrategico, cod_departamento, cod_municipio, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, fecha_creacion, cod_estado,
    nombre_representante, documento_representante, correo_representante, nombre_tipo_industria, nombre_tipo_subindustria, 
    nombre_tipo_otraindustria, numero_comercios, cod_tipo_sector, existe_rues, venta_presencial, venta_online, 
    nombre_plataforma_ecommerce, nombre_sistema_contable, cod_banco_cuenta, ubicacion_gps_tienda,
    url_img_orig_tienda, url_img_min_tienda, url_documentacion_rut_tienda, url_documentacion_camaracomercio_tienda,
    url_documentacion_contratofirma_tienda, url_documentacion_extra1_tienda, url_img_fachada_tienda, url_img_interna_tienda,
    url_img_selfieadmin_tienda, url_img_otraopcional_tienda, cod_administrador) 
    VALUES ('$identificacion_tercero', UPPER('$nombre_tienda'), UPPER('$abrev_tienda'), UPPER('$nombre1_tercero'), '$telefono1_tercero', '$correo_tercero', UPPER('$direccion_tercero'), UPPER('$barrio_tercero'),
    '$cod_aliado_estrategico', '$cod_departamento', '$cod_municipio', '$nombre_tipo_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$fecha_creacion', '$cod_estado',
    UPPER('$nombre_representante'), '$documento_representante', '$correo_representante', UPPER('$nombre_tipo_industria'), UPPER('$nombre_tipo_subindustria'), 
    UPPER('$nombre_tipo_otraindustria'), '$numero_comercios', '$cod_tipo_sector', '$existe_rues', '$venta_presencial', '$venta_online', 
    '$nombre_plataforma_ecommerce', '$nombre_sistema_contable', '$cod_banco_cuenta', '$ubicacion_gps_tienda',
    '$url_img_orig_tienda', '$url_img_min_tienda', '$url_documentacion_rut_tienda', '$url_documentacion_camaracomercio_tienda',
    '$url_documentacion_contratofirma_tienda', '$url_documentacion_extra1_tienda', '$url_img_fachada_tienda', '$url_img_interna_tienda',
    '$url_img_selfieadmin_tienda', '$url_img_otraopcional_tienda', '$cod_administrador')";
    $exec_data = mysqli_query($conectar, $sql_data);
    
    if (!$exec_data) {
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = "Error en base de datos: " . mysqli_error($conectar);
        header('Content-Type: application/json');
        echo json_encode($respuesta_ajax);
        exit;
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                    = $afectado;
	$respuesta_ajax['success']                     = true;
	$respuesta_ajax['cod_tienda_codifcryp']        = $cod_tienda_codifcryp;
	$respuesta_ajax['cod_tienda']                  = $cod_tienda;
	$respuesta_ajax['nombre_tienda']               = $nombre_tienda;
	$respuesta_ajax['correo_tercero']              = $correo_tercero;
	$respuesta_ajax['telefono1_tercero']           = $telefono1_tercero;
	$respuesta_ajax['mensaje']                     = 'Hecho correctamente.';
	$respuesta_ajax['message']                     = 'Hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>