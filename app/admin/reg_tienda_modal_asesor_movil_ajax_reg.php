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
function procesarArchivo($fKey, $fDir, $fPrefix = '', $fAllow = null) {
    if (!isset($_FILES[$fKey]) || $_FILES[$fKey]['error'] != 0) { return ''; }
    
    $fData = $_FILES[$fKey];
    $fName = $fData['name'];
    
    // Validar extensión si se especifican permitidos
    if ($fAllow !== null) {
        $fInf = pathinfo($fName);
        $fExt = isset($fInf['extension']) ? $fInf['extension'] : '';
        $fExt = strtolower($fExt);
        if (!in_array($fExt, $fAllow)) { return ''; }
    }

    if (!file_exists($fDir)) { mkdir($fDir, 0777, true); }
    $fSanitized = preg_replace('/[^a-zA-Z0-9\._-]/', '', $fName);
    $fStoreName = $fPrefix . time() . '_' . $fSanitized;
    $fTarget = $fDir . $fStoreName;
    $fTmpSrc = $fData['tmp_name'];
    
    if (move_uploaded_file($fTmpSrc, $fTarget)) { return $fTarget; }
    return '';
}
// ========== FUNCIÓN PARA PROCESAR IMÁGENES CON MINIATURA ==========
function procesarImagen($imgKey, $origD, $minD = null, $minW = 200) {
    if (!isset($_FILES[$imgKey]) || $_FILES[$imgKey]['error'] != 0) { return array('orig' => '', 'min' => ''); }
    $imgData = $_FILES[$imgKey];
    
    if (!file_exists($origD)) { mkdir($origD, 0777, true); }
    if ($minD && !file_exists($minD)) { mkdir($minD, 0777, true); }
    
    $fRawName = $imgData['name'];
    $fClean = preg_replace('/[^a-zA-Z0-9\._-]/', '', $fRawName);
    $fSave = time() . '_' . $fClean;
    $oPath = $origD . $fSave;
    $tSource = $imgData['tmp_name'];
    
    if (!move_uploaded_file($tSource, $oPath)) { return array('orig' => '', 'min' => ''); }
    
    $mPath = '';
    if ($minD) {
        $mPath = $minD . $fSave;
        $iType = $imgData['type'];
        $iSize = getimagesize($oPath);
        if ($iSize) {
            $wOrig = $iSize[0];
            $hOrig = $iSize[1];
            $hNew  = ($hOrig / $wOrig) * $minW;
            $canvas = imagecreatetruecolor($minW, $hNew);
            
            switch ($iType) {
                case 'image/jpeg': $imgRes = imagecreatefromjpeg($oPath); break;
                case 'image/png':
                    $imgRes = imagecreatefrompng($oPath);
                    imagealphablending($canvas, false);
                    imagesavealpha($canvas, true);
                    break;
                case 'image/gif': $imgRes = imagecreatefromgif($oPath); break;
                case 'image/webp': $imgRes = imagecreatefromwebp($oPath); break;
                default: $imgRes = @imagecreatefromjpeg($oPath);
            }
            if ($imgRes) {
                imagecopyresampled($canvas, $imgRes, 0, 0, 0, 0, $minW, $hNew, $wOrig, $hOrig);
                switch ($iType) {
                    case 'image/png': imagepng($canvas, $mPath); break;
                    case 'image/gif': imagegif($canvas, $mPath); break;
                    default: imagejpeg($canvas, $mPath, 85);
                }
                imagedestroy($imgRes);
                imagedestroy($canvas);
            }
        }
    }
    return array('orig' => $oPath, 'min' => $mPath);
}
//---------------------------------------------------------------------------------------------------------------------------------//
// Cambiar validación para requerir solo nombre de tienda y cod_aliado
if (isset($_POST['nombre1_tercero']) && !empty($_POST['nombre1_tercero']) && isset($_POST['cod_aliado_estrategico'])) {

	$nombre1_tercero                                                = trim(addslashes($_POST['nombre1_tercero']));
    $cod_aliado_estrategico                                         = intval($_POST['cod_aliado_estrategico']);
    // Generar identificación automática si no viene (basado en timestamp + aliado)
    $identificacion_tercero                                         = isset($_POST['identificacion_tercero']) && !empty($_POST['identificacion_tercero']) ? trim(addslashes($_POST['identificacion_tercero'])) : '';
    // Campos con valores por defecto si no vienen del formulario
	$telefono1_tercero                                              = isset($_POST['telefono_tienda']) && !empty($_POST['telefono_tienda']) ? trim(addslashes($_POST['telefono_tienda'])) : '';
	$correo_tercero                                                 = isset($_POST['correo_tercero']) && !empty($_POST['correo_tercero']) ? trim(addslashes($_POST['correo_tercero'])) : '';
	$direccion_tercero                                              = isset($_POST['direccion_tercero']) && !empty($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $barrio_tercero                                                 = isset($_POST['barrio_tercero']) && !empty($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
    $cod_departamento                                               = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio                                                  = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
    // Representante legal - valores por defecto
    $nombre_representante                                           = isset($_POST['nombre_representante']) && !empty($_POST['nombre_representante']) ? trim(addslashes($_POST['nombre_representante'])) : '';
    $documento_representante                                        = isset($_POST['documento_representante']) && !empty($_POST['documento_representante']) ? trim(addslashes($_POST['documento_representante'])) : '';
    $correo_representante                                           = isset($_POST['correo_representante']) && !empty($_POST['correo_representante']) ? trim(addslashes($_POST['correo_representante'])) : '';
    $nombre_tipo_industria                                          = isset($_POST['nombre_tipo_industria']) ? trim(addslashes($_POST['nombre_tipo_industria'])) : '';
    $nombre_tipo_subindustria                                       = isset($_POST['nombre_tipo_subindustria']) ? trim(addslashes($_POST['nombre_tipo_subindustria'])) : '';
    $nombre_tipo_otraindustria                                      = isset($_POST['nombre_tipo_otraindustria']) ? trim(addslashes($_POST['nombre_tipo_otraindustria'])) : '';
    $numero_comercios                                               = isset($_POST['numero_comercios']) ? intval($_POST['numero_comercios']) : 1;
    $cod_tipo_aliado                                                = isset($_POST['cod_tipo_aliado']) ? intval($_POST['cod_tipo_aliado']) : 0;
    $cod_tipo_sector                                                = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
    $existe_rues                                                    = isset($_POST['existe_rues']) ? trim(addslashes($_POST['existe_rues'])) : '';
    $venta_presencial                                               = isset($_POST['venta_presencial']) ? trim(addslashes($_POST['venta_presencial'])) : '';
    $venta_online                                                   = isset($_POST['venta_online']) ? trim(addslashes($_POST['venta_online'])) : '';
    $nombre_plataforma_ecommerce                                    = isset($_POST['nombre_plataforma_ecommerce']) ? trim(addslashes($_POST['nombre_plataforma_ecommerce'])) : '';
    $nombre_sistema_contable                                        = isset($_POST['nombre_sistema_contable']) ? trim(addslashes($_POST['nombre_sistema_contable'])) : '';
    $cod_banco_cuenta                                               = isset($_POST['cod_banco_cuenta']) ? intval($_POST['cod_banco_cuenta']) : 0;
    $ubicacion_gps_tienda                                           = isset($_POST['ubicacion_gps_tienda']) ? trim(addslashes($_POST['ubicacion_gps_tienda'])) : '';
    // Nuevos campos para Tipo de Cliente y Razón Social
    $nombre_tipo_cliente                                            = isset($_POST['nombre_tipo_cliente']) && !empty($_POST['nombre_tipo_cliente']) ? trim(addslashes($_POST['nombre_tipo_cliente'])) : 'PERSONA_NATURAL';
    $nombre_razon_social                                            = isset($_POST['nombre_razon_social']) && !empty($_POST['nombre_razon_social']) ? trim(addslashes($_POST['nombre_razon_social'])) : '';
	//---------------------------------------------------------------------------------------------------------------------------------//
	$nombre_tienda                                                  = $nombre1_tercero;
    $nombre_tipo_tercero                                            = 'TIENDA';
    $nombre_tipo_regimen                                            = "SIMPLE";
    $nombre_tipo_impuesto                                           = "NO_RESPONSABLE_DE_IVA";
    $cod_estado                                                     = "1";
    $fecha_creacion                                                 = date("Y-m-d H:i:s");
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_tienda = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tienda'";
    $exec_autoincremento_tienda = mysqli_query($conectar, $sql_autoincremento_tienda);
    if (!$exec_autoincremento_tienda) { echo json_encode(array('success' => false, 'message' => 'Error al obtener autoincremento: ' . mysqli_error($conectar))); exit; }
    $datos_autoincremento_tienda = mysqli_fetch_assoc($exec_autoincremento_tienda);

    $cod_tienda                                                     = $datos_autoincremento_tienda['AUTO_INCREMENT'];
    $cod_tienda_codif                                               = DAXCODIFCRYPTOR::encodifdax($cod_tienda);
    $cod_tienda_codifcryp                                           = DAXCODIFCRYPTOR::encriptardax($cod_tienda_codif);
    $abrev_tienda                                                   = 'TIENDA'.$cod_tienda;
    // ========== PROCESAR IMAGEN LOGO DE LA TIENDA ==========
    $img_logo                                                       = procesarImagen('imagen_tienda', '../archivador/img_tienda/orig/', '../archivador/img_tienda/min/');
    $url_img_orig_tienda                                            = $img_logo['orig'];
    $url_img_min_tienda                                             = $img_logo['min'];
    // ========== PROCESAR DOCUMENTACIÓN LEGAL (Solo PDF) ==========
    $directorio_docs                                                = '../archivador/documentacion_tienda/';
    $permitidos_pdf                                                 = array('pdf');
    $url_documentacion_rut_tienda                                   = procesarArchivo('url_documentacion_rut_tienda', $directorio_docs, 'rut_', $permitidos_pdf);
    $url_documentacion_camaracomercio_tienda                        = procesarArchivo('url_documentacion_camaracomercio_tienda', $directorio_docs, 'camara_', $permitidos_pdf);
    $url_documentacion_contratofirma_tienda                         = procesarArchivo('url_documentacion_contratofirma_tienda', $directorio_docs, 'contrato_', $permitidos_pdf);
    $url_documentacion_extra1_tienda                                = procesarArchivo('url_documentacion_extra1_tienda', $directorio_docs, 'extra_', $permitidos_pdf);
    // ========== PROCESAR IMÁGENES DEL ESTABLECIMIENTO ==========
    $directorio_imgs                                                = '../archivador/img_establecimiento/';
    $url_img_fachada_tienda                                         = procesarArchivo('url_img_fachada_tienda', $directorio_imgs, 'fachada_');
    $url_img_interna_tienda                                         = procesarArchivo('url_img_interna_tienda', $directorio_imgs, 'interna_');
    $url_img_selfieadmin_tienda                                     = procesarArchivo('url_img_selfieadmin_tienda', $directorio_imgs, 'selfie_');
    $url_img_otraopcional_tienda                                    = procesarArchivo('url_img_otraopcional_tienda', $directorio_imgs, 'otra_');
	//---------------------------------------------------------------------------------------------------------------------------------//
    $existe_dato_aliado = 0;
    if ($cod_aliado_estrategico > 0) {
	    $sql_dato_aliado = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_administrador = '".($cod_aliado_estrategico)."'";
	    $consultar_dato_aliado = mysqli_query($conectar, $sql_dato_aliado);
        if (!$consultar_dato_aliado) { echo json_encode(array('success' => false, 'message' => 'Error al consultar aliado: ' . mysqli_error($conectar))); exit; }
	    $info_dato_aliado = mysqli_fetch_assoc($consultar_dato_aliado);
	    $existe_dato_aliado = mysqli_num_rows($consultar_dato_aliado);
    } else {
        // Si es 0 es una tienda rápida
        $existe_dato_aliado = 1;
    }
    $cod_tipo_tienda = ($cod_aliado_estrategico == 0) ? 1 : 0;

	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_aliado > 0) {
		$sql_data = "INSERT INTO tbl15_tienda (identificacion_tercero, nombre_tienda, abrev_tienda, nombre1_tercero, telefono1_tercero, 
        correo_tercero, direccion_tercero, barrio_tercero, cod_aliado_estrategico, cod_departamento, 
        cod_municipio, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, 
        fecha_creacion, cod_estado, nombre_representante, documento_representante, correo_representante, 
        nombre_tipo_industria, nombre_tipo_subindustria, nombre_tipo_otraindustria, numero_comercios, 
        cod_tipo_aliado, cod_tipo_sector, existe_rues, venta_presencial, venta_online, nombre_plataforma_ecommerce, 
        nombre_sistema_contable, cod_banco_cuenta, ubicacion_gps_tienda, url_img_orig_tienda, 
        url_img_min_tienda, url_documentacion_rut_tienda, url_documentacion_camaracomercio_tienda, 
        url_documentacion_contratofirma_tienda, url_documentacion_extra1_tienda, url_img_fachada_tienda, 
        url_img_interna_tienda, url_img_selfieadmin_tienda, url_img_otraopcional_tienda, nombre_razon_social, 
        cod_administrador, cod_tipo_tienda, descripcion_tienda, nit_razon_social, garantia_tienda) 
        VALUES ('$identificacion_tercero', UPPER('$nombre_tienda'), UPPER('$abrev_tienda'), UPPER('$nombre1_tercero'), '$telefono1_tercero', 
        '$correo_tercero', '$direccion_tercero', UPPER('$barrio_tercero'), '$cod_aliado_estrategico', '$cod_departamento', 
        '$cod_municipio', '$nombre_tipo_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', 
        '$fecha_creacion', '$cod_estado', UPPER('$nombre_representante'), '$documento_representante', '$correo_representante', 
        UPPER('$nombre_tipo_industria'), UPPER('$nombre_tipo_subindustria'), UPPER('$nombre_tipo_otraindustria'), '$numero_comercios', 
        '$cod_tipo_aliado', '$cod_tipo_sector', '$existe_rues', '$venta_presencial', '$venta_online', '$nombre_plataforma_ecommerce', 
        '$nombre_sistema_contable', '$cod_banco_cuenta', '$ubicacion_gps_tienda', '$url_img_orig_tienda', 
        '$url_img_min_tienda', '$url_documentacion_rut_tienda', '$url_documentacion_camaracomercio_tienda', 
        '$url_documentacion_contratofirma_tienda', '$url_documentacion_extra1_tienda', '$url_img_fachada_tienda', 
        '$url_img_interna_tienda', '$url_img_selfieadmin_tienda', '$url_img_otraopcional_tienda', UPPER('$nombre_razon_social'), 
        '$cod_administrador', '$cod_tipo_tienda', '', '$identificacion_tercero', '')";
		$exec_data = mysqli_query($conectar, $sql_data);
        if (!$exec_data) { echo json_encode(array('success' => false, 'message' => 'Error al registrar tienda: ' . mysqli_error($conectar))); exit; }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => 'El aliado estratégico seleccionado no existe.'));
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
	echo json_encode($respuesta_ajax);
}
?>