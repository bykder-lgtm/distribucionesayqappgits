<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');

$response                                   = array('success' => false);
$tipo_imagen                                = '';
$codigo_tipo_estado_cargue_documentacion    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_nota_observacion = isset($_POST['cod_nota_observacion']) ? intval($_POST['cod_nota_observacion']) : 0;
    $codigo_estado_revision = isset($_POST['codigo_estado_revision']) ? intval($_POST['codigo_estado_revision']) : 0;
    $descripcion_nota_observacion = isset($_POST['descripcion_nota_observacion']) ? trim($_POST['descripcion_nota_observacion']) : '';

    if ($cod_nota_observacion > 0) {

	    $sql_nota_observacion = "SELECT cod_info_factura_venta, cod_estado_obligatorio, cod_estado_obligatorio2, url_img_orig_producto, url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_nota_observacion = '$cod_nota_observacion')";
	    $consulta_nota_observacion = mysqli_query($conectar, $sql_nota_observacion);
	    $datos_nota_observacion = mysqli_fetch_assoc($consulta_nota_observacion);

        $cod_info_factura_venta                                         = $datos_nota_observacion['cod_info_factura_venta'];
	    $cod_estado_obligatorio                                         = $datos_nota_observacion['cod_estado_obligatorio'];
	    $cod_estado_obligatorio2                                        = $datos_nota_observacion['cod_estado_obligatorio2'];
        $url_img_orig_producto2                                         = $datos_nota_observacion['url_img_orig_producto'];
        $url_img_min_producto2                                          = $datos_nota_observacion['url_img_min_producto'];

        if ($cod_estado_obligatorio == '1' && $codigo_estado_revision == '3') { //RECHAZADO INICIAL
            $codigo_tipo_estado_cargue_documentacion = '0'; // DOCUMENTACIÓN INICIAL
            $tipo_imagen = 'DOCUMENTACION INICIAL';
            $sql_actualizar = "UPDATE tbl15_info_factura_venta SET codigo_tipo_estado_cargue_documentacion = '$codigo_tipo_estado_cargue_documentacion' WHERE cod_info_factura_venta = $cod_info_factura_venta";
        	$consulta_actualizar = mysqli_query($conectar, $sql_actualizar);
        }
        if ($cod_estado_obligatorio2 == '1' && $codigo_estado_revision == '3') { //RECHAZADO FINAL
            $codigo_tipo_estado_cargue_documentacion = '1'; // DOCUMENTACIÓN FINAL
            $tipo_imagen = 'DOCUMENTACION FINAL';
            $sql_actualizar = "UPDATE tbl15_info_factura_venta SET codigo_tipo_estado_cargue_documentacion = '$codigo_tipo_estado_cargue_documentacion' WHERE cod_info_factura_venta = $cod_info_factura_venta";
        	$consulta_actualizar = mysqli_query($conectar, $sql_actualizar);
        }
        if ($codigo_estado_revision == '3') { //RECHAZADO
            $url_img_orig_producto = '';
            $url_img_min_producto = '';
            $sql_borar_imagen = "UPDATE tbl15_nota_observacion SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto', url_img_orig_producto2 = '$url_img_orig_producto2', url_img_min_producto2 = '$url_img_min_producto2' WHERE cod_nota_observacion = $cod_nota_observacion";
        	$consulta_borar_imagen = mysqli_query($conectar, $sql_borar_imagen);

        }

        $descripcion_nota_observacion = mysqli_real_escape_string($conectar, $descripcion_nota_observacion);
        $sql = "UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision', descripcion_nota_observacion = '$descripcion_nota_observacion' WHERE cod_nota_observacion = $cod_nota_observacion";
        if (mysqli_query($conectar, $sql)) {
            $response['success'] = true;
            $response['tipo_imagen'] = $tipo_imagen;
            $response['codigo_tipo_estado_cargue_documentacion'] = $codigo_tipo_estado_cargue_documentacion;
            $response['cod_estado_obligatorio'] = $cod_estado_obligatorio;
            $response['cod_estado_obligatorio2'] = $cod_estado_obligatorio2;
        } else {
            $response['error'] = 'Error al guardar en la base de datos.';
        }
    } else {
        $response['error'] = 'Datos incompletos.';
    }
} else {
    $response['error'] = 'Método no permitido.';
}

echo json_encode($response);
