<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

$cod_administrador_sesion = $_SESSION['cod_administrador'];
// Get admin info for aliado_estrategico and tienda
$sql_admin = "SELECT cod_administrador, cod_tienda FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_sesion'";
$result_admin = mysqli_query($conectar, $sql_admin);
$admin_data = mysqli_fetch_assoc($result_admin);
// Check if action is delete
if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $cod_entidad_crediticia = intval($_POST['cod_entidad_crediticia']);
    $sql_delete = "DELETE FROM tbl15_parametrizacion_cuota_entidad_crediticia_cuota WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
    if (mysqli_query($conectar, $sql_delete)) { echo json_encode(['success' => true, 'message' => 'Parametrización eliminada correctamente']); } else { echo json_encode(['success' => false, 'message' => 'Error al eliminar: ' . mysqli_error($conectar)]); }
    exit;
}
// Save action
$cod_administrador   = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
$cod_tienda          = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
$cod_entidad_crediticia  = isset($_POST['cod_entidad_crediticia']) ? intval($_POST['cod_entidad_crediticia']) : 0;
$nombre_entidad_crediticia = isset($_POST['nombre_entidad_crediticia']) ? mysqli_real_escape_string($conectar, $_POST['nombre_entidad_crediticia']) : '';
$cuotas_json         = isset($_POST['cuotas']) ? $_POST['cuotas'] : '[]';

$cuotas = json_decode($cuotas_json, true);

if (empty($cuotas) || $cod_entidad_crediticia == 0) { echo json_encode(['success' => false, 'message' => 'Datos incompletos. Verifique la entidad y las cuotas.']); exit; }
// Get entity data for additional fields
$sql_entidad = "SELECT * FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
$result_entidad = mysqli_query($conectar, $sql_entidad);
$entidad_data = mysqli_fetch_assoc($result_entidad);

if (!$entidad_data) { echo json_encode(['success' => false, 'message' => 'Entidad crediticia no encontrada.']); exit; }
// Get defaults from entity data
$aval_ptj = isset($entidad_data['aliado_estrategico_aval_ptj']) ? $entidad_data['aliado_estrategico_aval_ptj'] : '0.00';
$cod_posicion = isset($entidad_data['cod_posicion']) ? $entidad_data['cod_posicion'] : 0;
$cod_estado_entidad_predeterminada = isset($entidad_data['cod_estado_entidad_predeterminada_interes_defect']) ? $entidad_data['cod_estado_entidad_predeterminada_interes_defect'] : 0;
$meses_max = isset($entidad_data['meses_max_entidad_crediticia']) ? $entidad_data['meses_max_entidad_crediticia'] : 0;
$quincenal_max = isset($entidad_data['quicenal_max_entidad_crediticia']) ? $entidad_data['quicenal_max_entidad_crediticia'] : 0;
$cod_estado_entrar_portal = isset($entidad_data['cod_estado_entrar_portal']) ? $entidad_data['cod_estado_entrar_portal'] : 0;
$url_pagina_web_consulta = isset($entidad_data['url_pagina_web_consulta']) ? mysqli_real_escape_string($conectar, $entidad_data['url_pagina_web_consulta']) : '';
$url_pagina_web_consultar_cupo = isset($entidad_data['url_pagina_web_consultar_cupo']) ? mysqli_real_escape_string($conectar, $entidad_data['url_pagina_web_consultar_cupo']) : '';
$url_pagina_web_estudio_cupo = isset($entidad_data['url_pagina_web_estudio_cupo']) ? mysqli_real_escape_string($conectar, $entidad_data['url_pagina_web_estudio_cupo']) : '';
$url_pagina_web_valor_pagar = isset($entidad_data['url_pagina_web_valor_pagar']) ? mysqli_real_escape_string($conectar, $entidad_data['url_pagina_web_valor_pagar']) : '';
$url_pagina_web = isset($entidad_data['url_pagina_web']) ? mysqli_real_escape_string($conectar, $entidad_data['url_pagina_web']) : '';
$cod_estado_activar_portal = isset($entidad_data['cod_estado_activar_portal']) ? $entidad_data['cod_estado_activar_portal'] : 0;
// cod_aliado_estrategico - use cod_administrador as reference  
$cod_aliado_estrategico = $cod_administrador;
$fecha_creacion = date("d/m/Y h:i:s A");
// Begin transaction
mysqli_query($conectar, "START TRANSACTION");

try {
    // Delete existing parameterization for this entity
    $sql_delete_existing = "DELETE FROM tbl15_parametrizacion_cuota_entidad_crediticia_cuota WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
    mysqli_query($conectar, $sql_delete_existing);
    
    // Insert new cuotas
    foreach ($cuotas as $cuota) {
        $num_cuota     = intval($cuota['cuota']);
        $interes_ptj   = number_format(floatval($cuota['interes_ptj']), 2, '.', '');
        $ptj_seguro    = number_format(floatval($cuota['ptj_seguro']), 2, '.', '');
        $ptj_fondo_garantia = number_format(floatval($cuota['ptj_fondo_garantia']), 2, '.', '');
        
        $sql_insert = "INSERT INTO tbl15_parametrizacion_cuota_entidad_crediticia_cuota (
        cod_administardor, cod_aliado_estrategico, cod_tienda, cod_entidad_crediticia, nombre_entidad_crediticia, cuota, interes_ptj, ptj_seguro, ptj_fondo_garantia,
        aval_ptj, cod_posicion, cod_estado_entidad_predeterminada_interes_defect, meses_max_entidad_crediticia, quicenal_max_entidad_crediticia, cod_estado_entrar_portal,
        url_pagina_web_consulta, url_pagina_web_consultar_cupo, url_pagina_web_estudio_cupo, url_pagina_web_valor_pagar, url_pagina_web,
        cod_estado_activar_portal,
        fecha_creacion,
        cod_estado) 
        VALUES (
        '$cod_administrador', '$cod_aliado_estrategico', '$cod_tienda', '$cod_entidad_crediticia', '$nombre_entidad_crediticia', '$num_cuota', '$interes_ptj', '$ptj_seguro', '$ptj_fondo_garantia',
        '$aval_ptj', '$cod_posicion', '$cod_estado_entidad_predeterminada', '$meses_max', '$quincenal_max', '$cod_estado_entrar_portal', '$url_pagina_web_consulta',
        '$url_pagina_web_consultar_cupo', '$url_pagina_web_estudio_cupo', '$url_pagina_web_valor_pagar', '$url_pagina_web', '$cod_estado_activar_portal',
        '$fecha_creacion', '1')";
        if (!mysqli_query($conectar, $sql_insert)) { throw new Exception('Error al insertar cuota ' . $num_cuota . ': ' . mysqli_error($conectar)); }
    }
    // Commit transaction
    mysqli_query($conectar, "COMMIT");
    echo json_encode(['success' => true, 'message' => 'Parametrización guardada correctamente. ' . count($cuotas) . ' cuotas registradas.']);
} catch (Exception $e) {
    // Rollback on error
    mysqli_query($conectar, "ROLLBACK");
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
