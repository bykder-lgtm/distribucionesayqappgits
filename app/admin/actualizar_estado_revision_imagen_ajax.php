<?php
// Endpoint para actualizar el estado de revisión de una imagen
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

function sendJsonResponse($data) { echo json_encode($data); exit; }

try {
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }
    // Obtener parámetros
    $cod_nota_observacion = isset($_POST['cod_nota_observacion']) ? mysqli_real_escape_string($conectar, trim($_POST['cod_nota_observacion'])) : '';
    $codigo_estado_revision = isset($_POST['codigo_estado_revision']) ? mysqli_real_escape_string($conectar, trim($_POST['codigo_estado_revision'])) : '';
    $descripcion_nota_observacion = isset($_POST['descripcion_nota_observacion']) ? mysqli_real_escape_string($conectar, trim($_POST['descripcion_nota_observacion'])) : '';

    if ($cod_nota_observacion === '' || $codigo_estado_revision === '') { sendJsonResponse(['success' => false, 'message' => 'Parámetros incompletos']); }
    // Actualizar el estado de revisión en la tabla
    $obtener_nota_observacion = "SELECT * FROM tbl15_nota_observacion WHERE cod_nota_observacion = '$cod_nota_observacion'";
	$resultado_nota_observacion = mysqli_query($conectar, $obtener_nota_observacion) or die(mysqli_error($conectar));
	$info_nota_observacion = mysqli_fetch_assoc($resultado_nota_observacion);

	$nombre_nota_observacion                                       = $info_nota_observacion['nombre_nota_observacion'];
	$cod_info_factura_venta                                        = $info_nota_observacion['cod_info_factura_venta'];
    $fecha_ymd                                                     = '';
    $fecha_hora                                                    = '';
    $fecha_creacion                                                = '';
    $fecha_modificacion                                            = '';
    // Actualizaren la tabla
    if ($codigo_estado_revision == '0') { //POR CARGAR
        $url_img_orig_producto_por_cargar                 = '';
        $url_img_min_producto_por_cargar                  = '';

        $actualizar_estado = "UPDATE tbl15_nota_observacion SET url_img_orig_producto = '$url_img_orig_producto_por_cargar', url_img_min_producto = '$url_img_min_producto_por_cargar', 
        fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', fecha_creacion = '$fecha_creacion', fecha_modificacion = '$fecha_modificacion'
        WHERE cod_nota_observacion = '$cod_nota_observacion'";
        mysqli_query($conectar, $actualizar_estado) or die(mysqli_error($conectar));

        // Obtener datos de la factura para vincular la notificación al aliado
        $obtener_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $resultado_info_factura_venta = mysqli_query($conectar, $obtener_info_factura_venta);
        $info_info_factura_venta = mysqli_fetch_assoc($resultado_info_factura_venta);

        $nombre_notificacion_alerta_renovacion            = 'Imagen por cargar';
        $descipcion_notificacion_alerta_renovacion        = 'La imagen: '. ($nombre_nota_observacion).' esta por cargar nuevamente';
        $cod_tipo_notificacion_alerta                     = 0;
        $fecha_creacion                                   = date('Y-m-d H:i:s');
        $fecha                                            = date('Y-m-d');
        $fecha_mes                                        = date('Y-m');
        $anyo                                             = date('Y');
        $fecha_invert                                     = date('Y-m-d');
        $fecha_seg                                        = time();
        $cod_estado                                       = '0';
        $cod_estado_aviso                                 = '0';
        $cod_administrador_notif         = $info_info_factura_venta['cod_administrador_aliado_estrategico'];
        $cod_tienda_notif                = $info_info_factura_venta['cod_tienda'];

        // Insertar la notificación en la base de datos
        $sql_insert = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_info_factura_venta, cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
        cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso) 
        VALUES ('$cod_info_factura_venta', '$cod_administrador_notif', '$cod_tienda_notif', '$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', 
        '$cod_tipo_notificacion_alerta', '$fecha_creacion', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
        $resultado = mysqli_query($conectar, $sql_insert);

        $codigo_tipo_estado_cargue_documentacion          = 0;

        $agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET codigo_tipo_estado_cargue_documentacion = '$codigo_tipo_estado_cargue_documentacion' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
        $resultado = mysqli_query($conectar, $agregar_regis);
    } elseif($codigo_estado_revision == '3') { //RECHAZADO
        $url_img_orig_producto_rechaz                     = '';
        $url_img_min_producto_rechaz                      = '';

        $actualizar_estado = "UPDATE tbl15_nota_observacion SET url_img_orig_producto = '$url_img_orig_producto_rechaz', url_img_min_producto = '$url_img_min_producto_rechaz', 
        fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', fecha_creacion = '$fecha_creacion', fecha_modificacion = '$fecha_modificacion'
        WHERE cod_nota_observacion = '$cod_nota_observacion'";
        mysqli_query($conectar, $actualizar_estado) or die(mysqli_error($conectar));

        // Obtener datos de la factura para vincular la notificación al aliado
        $obtener_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $resultado_info_factura_venta = mysqli_query($conectar, $obtener_info_factura_venta);
        $info_info_factura_venta = mysqli_fetch_assoc($resultado_info_factura_venta);

        $nombre_notificacion_alerta_renovacion            = 'Imagen rechazada';
        $descipcion_notificacion_alerta_renovacion        = 'La imagen: '. ($nombre_nota_observacion).', ha sido rechazada por: '.$descripcion_nota_observacion;
        $cod_tipo_notificacion_alerta                     = 0;
        $fecha_creacion                                   = date('Y-m-d H:i:s');
        $fecha                                            = date('Y-m-d');
        $fecha_mes                                        = date('Y-m');
        $anyo                                             = date('Y');
        $fecha_invert                                     = date('Y-m-d');
        $fecha_seg                                        = time();
        $cod_estado                                       = '0';
        $cod_estado_aviso                                 = '0';
        $cod_administrador_notif         = $info_info_factura_venta['cod_administrador_aliado_estrategico'];
        $cod_tienda_notif                = $info_info_factura_venta['cod_tienda'];

        // Insertar la notificación en la base de datos
        $sql_insert = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_info_factura_venta, cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
        cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso) 
        VALUES ('$cod_info_factura_venta', '$cod_administrador_notif', '$cod_tienda_notif', '$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', 
        '$cod_tipo_notificacion_alerta', '$fecha_creacion', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
        $resultado = mysqli_query($conectar, $sql_insert);

        $codigo_tipo_estado_cargue_documentacion          = 0;

        $agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET codigo_tipo_estado_cargue_documentacion = '$codigo_tipo_estado_cargue_documentacion' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
        $resultado = mysqli_query($conectar, $agregar_regis);
    } else {

    }
    if (!isset($info_info_factura_venta)) {
        $obtener_info_factura_venta= "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $resultado_info_factura_venta = mysqli_query($conectar, $obtener_info_factura_venta) or die(mysqli_error($conectar));
        $info_info_factura_venta = mysqli_fetch_assoc($resultado_info_factura_venta);
    }

	$cod_estado_obligatorio                                        = $info_nota_observacion['cod_estado_obligatorio'];
    $cod_estado_obligatorio2                                       = $info_nota_observacion['cod_estado_obligatorio2'];
    $cod_estado_obligatorio_revisor                                = $info_nota_observacion['cod_estado_obligatorio_revisor'];
    $fecha_ymd                                                     = date("Y-m-d");
    $fecha_hora                                                    = date("H:i:s");
    $cuenta                                                        = $_SESSION['usuario'];
    $cod_administrador                                             = $_SESSION['cod_administrador'];
    $cod_tipo_nota_observacion                                     = $info_nota_observacion['cod_tipo_nota_observacion'];
    $cod_tercero                                                   = $info_info_factura_venta['cod_tercero'];
    $cod_documento_requisito_entidad_crediticia                    = $info_nota_observacion['url_img_orig_producto'];
    $url_img_orig_producto                                         = $info_nota_observacion['url_img_orig_producto'];
    $url_img_min_producto                                          = $info_nota_observacion['url_img_min_producto'];
    $url_img_orig_producto2                                        = $info_nota_observacion['url_img_orig_producto2'];
    $url_img_min_producto2                                         = $info_nota_observacion['url_img_min_producto2'];
    $fecha_creacion                                                = date("Y-m-d H:i:s");
    $fecha_modificacion                                            = date("Y-m-d H:i:s");
    $cod_posicion                                                  = $info_nota_observacion['cod_posicion'];
    $observacion_archivador                                        = $info_nota_observacion['observacion_archivador'];
    $cod_entidad_origen_archivo                                    = $info_nota_observacion['cod_entidad_origen_archivo'];

    $sql_data = "INSERT INTO tbl15_nota_observacion_historial (cod_nota_observacion, nombre_nota_observacion, descripcion_nota_observacion, cod_estado_obligatorio, cod_estado_obligatorio2, 
    cod_estado_obligatorio_revisor, fecha_ymd, fecha_hora, cuenta, cod_administrador, cod_tipo_nota_observacion, 
    cod_tercero, cod_info_factura_venta, cod_documento_requisito_entidad_crediticia, 
    url_img_orig_producto, url_img_min_producto, url_img_orig_producto2, url_img_min_producto2, fecha_creacion, fecha_modificacion, 
    cod_posicion, observacion_archivador, cod_entidad_origen_archivo, codigo_estado_revision) 
    VALUES ('$cod_nota_observacion', '$nombre_nota_observacion', '$descripcion_nota_observacion', '$cod_estado_obligatorio', '$cod_estado_obligatorio2', 
    '$cod_estado_obligatorio_revisor', '$fecha_ymd', '$fecha_hora', '$cuenta', '$cod_administrador', '$cod_tipo_nota_observacion', 
    '$cod_tercero', '$cod_info_factura_venta', '$cod_documento_requisito_entidad_crediticia', 
    '$url_img_orig_producto', '$url_img_min_producto', '$url_img_orig_producto2', '$url_img_min_producto2', '$fecha_creacion', '$fecha_modificacion', 
    '$cod_posicion', '$observacion_archivador', '$cod_entidad_origen_archivo', '$codigo_estado_revision')";
    $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

    $sql_update = "UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision' WHERE cod_nota_observacion = '$cod_nota_observacion'";
    $resultado = mysqli_query($conectar, $sql_update);
    
    if (!$resultado) { sendJsonResponse(['success' => false, 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); }
    // Obtener el nombre del estado actualizado
    $sql_estado = "SELECT nombre_estado_revision FROM tbl15_estado_revision WHERE codigo_estado_revision = '$codigo_estado_revision'";
    $consulta_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($consulta_estado);
    $nombre_estado = isset($datos_estado['nombre_estado_revision']) ? $datos_estado['nombre_estado_revision'] : 'Desconocido';

    sendJsonResponse(['success' => true, 'message' => 'Estado actualizado correctamente', 'nombre_estado' => $nombre_estado]);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
