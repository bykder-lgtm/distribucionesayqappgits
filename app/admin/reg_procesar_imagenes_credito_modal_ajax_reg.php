<?php
// Configuración de respuesta JSON
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$codigo_estado_facturacion                        = 1;
$cod_estado_factura                               = $codigo_estado_facturacion;
$fecha_ymd                                        = date('Y-m-d');
$fecha_hora                                       = date('H:i:s');
$fecha_modificacion                               = date('Y-m-d H:i:s');
$codigo_tipo_estado_cargue_documentacion          = 1; //CARGUE DE IMAGENES INICIALES

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success' => false, 'message' => 'Método no permitido']); exit; }
try {
    // Verificar que sea una acción válida
    if (!isset($_POST['action']) || $_POST['action'] !== 'procesar_imagenes_credito') { throw new Exception('Acción no válida'); }
    // Obtener y validar parámetros
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : 0;
    $cod_tercero = isset($_POST['cod_tercero']) ? intval($_POST['cod_tercero']) : 0;
    $cod_tipo_metodo_aprobacion = isset($_POST['cod_tipo_metodo_aprobacion']) ? intval($_POST['cod_tipo_metodo_aprobacion']) : 0;
    $btn_origen = isset($_POST['btn_origen']) ? addslashes($_POST['btn_origen']) : '';
    $cod_notas_observacion = isset($_POST['cod_notas_observacion']) ? addslashes($_POST['cod_notas_observacion']) : '';

    // Validar que todos los parámetros sean válidos
    if ($cod_info_factura_venta <= 0) { throw new Exception('Código de factura inválido: ' . $cod_info_factura_venta); }
    if ($cod_tercero <= 0) { throw new Exception('Código de tercero inválido: ' . $cod_tercero); }
    if ($cod_tipo_metodo_aprobacion <= 0) { throw new Exception('Código de método de aprobación inválido: ' . $cod_tipo_metodo_aprobacion); }
    
    // Actualizar el estado del proceso o realizar acciones adicionales
    $sql_info_factura_venta = "UPDATE tbl15_info_factura_venta SET cod_tipo_metodo_aprobacion = ?, cod_estado_factura = ?, codigo_estado_facturacion = ?, codigo_tipo_estado_cargue_documentacion = ? WHERE cod_info_factura_venta = ?";
    $stmt_preparar_info_factura_venta = mysqli_prepare($conectar, $sql_info_factura_venta);
    if ($stmt_preparar_info_factura_venta === false) { throw new Exception('Error al preparar consulta de actualización: '.mysqli_error($conectar)); }
    mysqli_stmt_bind_param($stmt_preparar_info_factura_venta, "iiiii", $cod_tipo_metodo_aprobacion, $cod_estado_factura, $codigo_estado_facturacion, $codigo_tipo_estado_cargue_documentacion, $cod_info_factura_venta);
    if (!mysqli_stmt_execute($stmt_preparar_info_factura_venta)) { throw new Exception('Error al ejecutar actualización: ' . mysqli_stmt_error($stmt_preparar_info_factura_venta)); }
    $filas_afectadas_info_factura_venta = mysqli_stmt_affected_rows($stmt_preparar_info_factura_venta); if ($filas_afectadas_info_factura_venta === 0) { throw new Exception('No se encontró la factura para actualizar o los datos ya estaban actualizados'); }
    mysqli_stmt_close($stmt_preparar_info_factura_venta);

    $nombre_notificacion_alerta_renovacion            = 'Atento al grupo';
    $descipcion_notificacion_alerta_renovacion        = 'Atento al grupo de whatsapp para envío del código o link al cliente';
    $cod_tipo_notificacion_alerta                     = 5;
    $fecha_creacion                                   = date('Y-m-d H:i:s');
    $fecha                                            = date('Y-m-d');
    $fecha_mes                                        = date('Y-m');
    $anyo                                             = date('Y');
    $fecha_invert                                     = date('Y-m-d');
    $fecha_seg                                        = time();
    $cod_estado                                       = '0';
    $cod_estado_aviso                                 = '0';
    // Obtener cod_administrador y cod_tienda de la factura
    // Obtener cod_administrador y cod_tienda de la factura
    $sql_factura = "SELECT cod_administrador, cod_administrador_aliado_estrategico, cod_tienda FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_factura = mysqli_query($conectar, $sql_factura);
    $datos_factura = mysqli_fetch_assoc($consulta_factura);

    $cod_administrador_notif = !empty($datos_factura['cod_administrador_aliado_estrategico']) ? $datos_factura['cod_administrador_aliado_estrategico'] : $datos_factura['cod_administrador'];
    $cod_tienda_notif = isset($datos_factura['cod_tienda']) ? $datos_factura['cod_tienda'] : 0;

    // Insertar la notificación en la base de datos
    $sql_insert = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_info_factura_venta, cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
    cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso) 
    VALUES ('$cod_info_factura_venta', '$cod_administrador_notif', '$cod_tienda_notif', '$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', 
    '$cod_tipo_notificacion_alerta', '$fecha_creacion', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
    $resultado = mysqli_query($conectar, $sql_insert);

    if($filas_afectadas_info_factura_venta <> 0) { $afectado = 'SI'; } else { $afectado = 'NO'; }
    // Respuesta exitosa
    $respuesta = ['success' => true, 'afectado' => $afectado, 'btn_origen' => $btn_origen, 'cod_notas_observacion_vector' => $cod_notas_observacion, 'message' => "Imágenes procesadas",
        'data' => ['cod_info_factura_venta' => $cod_info_factura_venta, 'cod_tercero' => $cod_tercero, 'cod_tipo_metodo_aprobacion' => $cod_tipo_metodo_aprobacion, 'cod_estado_factura' => $cod_estado_factura, 'fecha_procesamiento' => $fecha_ymd . ' ' . $fecha_hora]
    ];
    echo json_encode($respuesta);
} catch (Exception $e) {
    // Respuesta de error
    http_response_code(400);
    $respuesta = ['success' => false, 'message' => $e->getMessage(), 'error_code' => 'PROCESSING_ERROR'];
    echo json_encode($respuesta);
}
?>