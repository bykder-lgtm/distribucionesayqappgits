<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Leer datos JSON
    $input = json_decode(file_get_contents('php://input'), true);
    
    $cod_tienda = intval($input['cod_tienda']);
    $tipo_documento = trim($input['tipo_documento']);
    
    // Validaciones básicas
    if (empty($tipo_documento)) { echo json_encode(['success' => false, 'message' => 'Tipo de documento no especificado']); exit; }
    
    // Verificar que la tienda existe y obtener la URL del documento actual
    $campo_bd = '';
    switch ($tipo_documento) {
        case 'rut':
            $campo_bd = 'url_documentacion_rut_tienda';
            break;
        case 'camaracomercio':
            $campo_bd = 'url_documentacion_camaracomercio_tienda';
            break;
        case 'contratofirma':
            $campo_bd = 'url_documentacion_contratofirma_tienda';
            break;
        case 'extra1':
            $campo_bd = 'url_documentacion_extra1_tienda';
            break;
        case 'extra2':
            $campo_bd = 'url_documentacion_extra2_tienda';
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Tipo de documento no válido']);
            exit;
    }
    
    $check_tienda = "SELECT cod_tienda, $campo_bd FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $result_tienda = mysqli_query($conectar, $check_tienda);
    if (mysqli_num_rows($result_tienda) == 0) { echo json_encode(['success' => false, 'message' => 'La tienda no existe']); exit; }
    
    $tienda_data = mysqli_fetch_assoc($result_tienda);
    $url_documento_actual = $tienda_data[$campo_bd];
    // Actualizar base de datos (poner campo en vacío)
    $sql_update = "UPDATE tbl15_tienda SET $campo_bd = '', fecha_modificacion = NOW() WHERE cod_tienda = '$cod_tienda'";
    $result_update = mysqli_query($conectar, $sql_update);
    
    if ($result_update) {
        // Intentar eliminar archivo físico si existe
        if (!empty($url_documento_actual)) { $archivo_fisico = '../' . $url_documento_actual; if (file_exists($archivo_fisico)) { unlink($archivo_fisico); } }
        // Registrar en log de movimientos
        $cod_administrador_sesion = isset($_SESSION['cod_administrador']) ? $_SESSION['cod_administrador'] : 0;
        $fecha_movimiento = date("Y-m-d H:i:s");
        $descripcion_mov = "Documento $tipo_documento eliminado para tienda ID: $cod_tienda";
        
        $sql_log = "INSERT INTO tbl15_registro_movimiento (cod_administrador, cod_tienda, fecha_movimiento, descripcion_movimiento, tipo_movimiento) 
        VALUES ('$cod_administrador_sesion', '$cod_tienda', '$fecha_movimiento', '$descripcion_mov', 'DOCUMENTO_ELIMINADO')";
        mysqli_query($conectar, $sql_log);
        
        echo json_encode(['success' => true, 'message' => 'Documento eliminado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el documento: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>