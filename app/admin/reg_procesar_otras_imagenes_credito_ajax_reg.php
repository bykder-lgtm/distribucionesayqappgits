<?php
// Configuración de respuesta JSON
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$codigo_estado_facturacion              = 2;
$cod_estado_factura                     = $codigo_estado_facturacion;
$fecha_ymd                              = date('Y-m-d');
$fecha_hora                             = date('H:i:s');
$fecha_modificacion                     = date('Y-m-d H:i:s');
$codigo_tipo_estado_cargue_documentacion   = 2; //CARGUE DE IMAGENES FINALES

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success' => false, 'message' => 'Método no permitido']); exit; }
try {
    // Verificar que sea una acción válida
    if (!isset($_POST['action']) || $_POST['action'] !== 'procesar_imagenes_credito') { throw new Exception('Acción no válida'); }
    // Obtener y validar parámetros
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : 0;
    $cod_tercero = isset($_POST['cod_tercero']) ? intval($_POST['cod_tercero']) : 0;
    $btn_origen = isset($_POST['btn_origen']) ? addslashes($_POST['btn_origen']) : '';

	$sql_info_factura_venta = "SELECT cod_administrador_revisor, telefono1_tercero, cod_estado_factura FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
	$matriz_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_administrador_revisor                           = $matriz_info_factura_venta['cod_administrador_revisor'];
    $telefono1_tercero                                   = $matriz_info_factura_venta['telefono1_tercero'];
    $cod_estado_factura_actual                           = $matriz_info_factura_venta['cod_estado_factura'];
    
    $sql_nota_administrador = "SELECT telefono FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $consulta_nota_administrador = mysqli_query($conectar, $sql_nota_administrador);
    $matriz_nota_administrador = mysqli_fetch_assoc($consulta_nota_administrador);

    $telefono_revisor                                    = $matriz_nota_administrador['telefono'];
    
    // Validar que todos los parámetros sean válidos
    if ($cod_info_factura_venta <= 0) { throw new Exception('Código de factura inválido: ' . $cod_info_factura_venta); }
    if ($cod_tercero <= 0) { throw new Exception('Código de tercero inválido: ' . $cod_tercero); }   
    
    // Actualizar el estado del proceso o realizar acciones adicionales
    $sql_info_factura_venta = "UPDATE tbl15_info_factura_venta SET codigo_tipo_estado_cargue_documentacion = ?, fecha_modificacion = ? WHERE cod_info_factura_venta = ?";
    $stmt_preparar_info_factura_venta = mysqli_prepare($conectar, $sql_info_factura_venta);
    if ($stmt_preparar_info_factura_venta === false) { throw new Exception('Error al preparar consulta de actualización: '.mysqli_error($conectar)); }
    mysqli_stmt_bind_param($stmt_preparar_info_factura_venta, "isi", $codigo_tipo_estado_cargue_documentacion, $fecha_modificacion, $cod_info_factura_venta);
    if (!mysqli_stmt_execute($stmt_preparar_info_factura_venta)) { throw new Exception('Error al ejecutar actualización: ' . mysqli_stmt_error($stmt_preparar_info_factura_venta)); }
    $filas_afectadas_info_factura_venta = mysqli_stmt_affected_rows($stmt_preparar_info_factura_venta);
    mysqli_stmt_close($stmt_preparar_info_factura_venta);

    if($filas_afectadas_info_factura_venta <> 0) { $afectado = 'SI'; } else { $afectado = 'NO'; }
    // Respuesta exitosa
    $respuesta = [
        'success' => true,
        'afectado' => $afectado,
        'btn_origen' => $btn_origen,
        'message' => "Imágenes procesadas exitosamente.",
        'data' => [
            'cod_info_factura_venta' => $cod_info_factura_venta,
            'cod_tercero' => $cod_tercero,
            'cod_estado_factura' => $cod_estado_factura,
            'telefono1_tercero' => $telefono1_tercero,
            'telefono_revisor' => $telefono_revisor,
            'fecha_procesamiento' => $fecha_ymd . ' ' . $fecha_hora
        ]
    ];
    echo json_encode($respuesta);
} catch (Exception $e) {
    // Respuesta de error
    http_response_code(400);
    $respuesta = [
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => 'PROCESSING_ERROR'
    ];
    echo json_encode($respuesta);
}
?>