<?php
// Endpoint para actualizar la entidad crediticia de una factura
ob_start(); // Capturar cualquier output no deseado
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean(); // Limpiar el buffer
header('Content-Type: application/json; charset=utf-8');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                       = $_SESSION['usuario'];
$cod_administrador                            = $_SESSION['cod_administrador'];
// Función para enviar respuesta JSON y terminar
function sendJsonResponse($data) { echo json_encode($data); exit; }

try {
    // Verificar conexión a la base de datos
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }
    // Obtener y validar parámetros
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : '';
    $cod_entidad_crediticia = isset($_POST['cod_entidad_crediticia']) ? intval($_POST['cod_entidad_crediticia']) : '';
    $cod_tipo_simulacion_credito = isset($_POST['cod_tipo_simulacion_credito']) ? intval($_POST['cod_tipo_simulacion_credito']) : '1';
    $monto_deuda = isset($_POST['monto_deuda']) ? intval($_POST['monto_deuda']) : '';
    $monto_cuota = isset($_POST['monto_cuota']) ? intval($_POST['monto_cuota']) : '';
    $numero_cuotas = isset($_POST['numero_cuotas']) ? intval($_POST['numero_cuotas']) : '';
    $valor_contado = isset($_POST['valor_contado']) ? intval($_POST['valor_contado']) : '';
    // Validaciones
    if ($cod_info_factura_venta === '') { sendJsonResponse(['success' => false, 'message' => 'ID de factura no especificado']); }
    if ($cod_entidad_crediticia === '') { sendJsonResponse(['success' => false, 'message' => 'Entidad crediticia no especificada']); }
    if ($monto_deuda === '' || !is_numeric($monto_deuda)) { sendJsonResponse(['success' => false, 'message' => 'Monto de deuda inválido']); }
    if ($monto_cuota === '' || !is_numeric($monto_cuota)) { sendJsonResponse(['success' => false, 'message' => 'Monto de cuota inválido']); }
    // Verificar que la factura existe
    $sql_verificar = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_verificar = mysqli_query($conectar, $sql_verificar);
    
    if (!$consulta_verificar || mysqli_num_rows($consulta_verificar) == 0) { sendJsonResponse(['success' => false, 'message' => 'Factura no encontrada']); }
    // Verificar que la entidad crediticia existe
    $sql_verificar_entidad = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
    $consulta_verificar_entidad = mysqli_query($conectar, $sql_verificar_entidad);
    
    if (!$consulta_verificar_entidad || mysqli_num_rows($consulta_verificar_entidad) == 0) { sendJsonResponse(['success' => false, 'message' => 'Entidad crediticia no encontrada']); }

    $sql_info_factura_venta = "SELECT cod_entidad_crediticia, cod_tercero FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_entidad_crediticia_db                     = $datos_info_factura_venta['cod_entidad_crediticia'];
    $cod_tercero                                   = $datos_info_factura_venta['cod_tercero'];
    $cod_tipo_nota_observacion                     = 20;
    $fecha_creacion                                = date('Y-m-d');

    if($cod_entidad_crediticia_db != $cod_entidad_crediticia) { //si la entidad crediticia ha cambiado
        
        $codigo_tipo_estado_cargue_documentacion = 0;
        $sql_actualizar = "UPDATE tbl15_info_factura_venta SET codigo_tipo_estado_cargue_documentacion = '$codigo_tipo_estado_cargue_documentacion' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $consulta_actualizar = mysqli_query($conectar, $sql_actualizar);

        $sql_nota_observacion_verif = "SELECT cod_nota_observacion, nombre_nota_observacion, cod_documento_requisito_entidad_crediticia 
        FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	    $consulta_nota_observacion_verif = mysqli_query($conectar, $sql_nota_observacion_verif) or die(mysqli_error($conectar));
	    while ($datos_nota_observacion_verif = mysqli_fetch_assoc($consulta_nota_observacion_verif)) {

            $cod_nota_observacion                                           = $datos_nota_observacion_verif['cod_nota_observacion'];
            $nombre_nota_observacion                                        = $datos_nota_observacion_verif['nombre_nota_observacion'];
            $cod_documento_requisito_entidad_crediticia_db                  = $datos_nota_observacion_verif['cod_documento_requisito_entidad_crediticia'];

            $sql_documento_requisito_entidad_crediticia_verif  = "SELECT cod_documento_requisito_entidad_crediticia, nombre_documento_requisito_entidad_crediticia FROM tbl15_documento_requisito_entidad_crediticia 
            WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_documento_requisito_entidad_crediticia = '$cod_documento_requisito_entidad_crediticia_db')";
            $consulta_documento_requisito_entidad_crediticia_verif  = mysqli_query($conectar, $sql_documento_requisito_entidad_crediticia_verif ) or die(mysqli_error($conectar));
            $datos_documento_requisito_entidad_crediticia_verif  = mysqli_fetch_assoc($consulta_documento_requisito_entidad_crediticia_verif );

            $cod_documento_requisito_entidad_crediticia                     = $datos_documento_requisito_entidad_crediticia_verif['cod_documento_requisito_entidad_crediticia'];
            $nombre_documento_requisito_entidad_crediticia                  = $datos_documento_requisito_entidad_crediticia_verif['nombre_documento_requisito_entidad_crediticia'];

            if($nombre_documento_requisito_entidad_crediticia != '') { //si el documento existe en la nueva entidad crediticia
                //Actualizar el codigo_tipo_estado_cargue_documentacion en la nota_observacion
                //$codigo_tipo_estado_cargue_documentacion = 0;
                //$sql_update_nota_observacion = "UPDATE tbl15_nota_observacion SET codigo_tipo_estado_cargue_documentacion = '$codigo_tipo_estado_cargue_documentacion' WHERE cod_nota_observacion = '$cod_nota_observacion'";
                //$consulta_update_nota_observacion = mysqli_query($conectar, $sql_update_nota_observacion);
            } else {
                //Eliminar la nota_observacion ya que el documento no existe en la nueva entidad crediticia
                $sql_delete_nota_observacion = "DELETE FROM tbl15_nota_observacion WHERE cod_nota_observacion = '$cod_nota_observacion'";
                $consulta_delete_nota_observacion = mysqli_query($conectar, $sql_delete_nota_observacion);
            }
        }
            
        $sql_documento_requisito_entidad_crediticia = "SELECT * FROM tbl15_documento_requisito_entidad_crediticia 
        WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_estado = '1') ORDER BY cod_posicion DESC";
	    $consulta_documento_requisito_entidad_crediticia = mysqli_query($conectar, $sql_documento_requisito_entidad_crediticia) or die(mysqli_error($conectar));
	    while ($datos_documento_requisito_entidad_crediticia = mysqli_fetch_assoc($consulta_documento_requisito_entidad_crediticia)) {

            $cod_documento_requisito_entidad_crediticia                     = $datos_documento_requisito_entidad_crediticia['cod_documento_requisito_entidad_crediticia'];
            $nombre_documento_requisito_entidad_crediticia                  = $datos_documento_requisito_entidad_crediticia['nombre_documento_requisito_entidad_crediticia'];
            $nombre_tipo_recorte_foto                                       = $datos_documento_requisito_entidad_crediticia['nombre_tipo_recorte_foto'];
            $cod_estado_obligatorio                                         = $datos_documento_requisito_entidad_crediticia['cod_estado_obligatorio'];
            $cod_estado_obligatorio2                                        = $datos_documento_requisito_entidad_crediticia['cod_estado_obligatorio2'];
            $cod_posicion                                                   = $datos_documento_requisito_entidad_crediticia['cod_posicion'];

            $sql_nota_observacion  = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta' AND cod_documento_requisito_entidad_crediticia = '$cod_documento_requisito_entidad_crediticia')";
            $consulta_nota_observacion  = mysqli_query($conectar, $sql_nota_observacion ) or die(mysqli_error($conectar));
            $datos_nota_observacion  = mysqli_fetch_assoc($consulta_nota_observacion );

            $nombre_nota_observacion                                        = $datos_nota_observacion['nombre_nota_observacion'];

            if($nombre_nota_observacion != $nombre_documento_requisito_entidad_crediticia) { //si el documento no existia en la tabla
                $sql_insert = "INSERT INTO tbl15_nota_observacion (cod_info_factura_venta, cod_documento_requisito_entidad_crediticia, nombre_nota_observacion, 
                cod_estado_obligatorio, cod_estado_obligatorio2, cod_posicion, cuenta, cod_administrador, cod_tercero, fecha_creacion, cod_tipo_nota_observacion) 
                VALUES ('$cod_info_factura_venta', '$cod_documento_requisito_entidad_crediticia', '$nombre_documento_requisito_entidad_crediticia', 
                '$cod_estado_obligatorio', '$cod_estado_obligatorio2', '$cod_posicion', '$cuenta', '$cod_administrador', '$cod_tercero', '$fecha_creacion', '$cod_tipo_nota_observacion')";
                $resultado = mysqli_query($conectar, $sql_insert);
            } else {
            }
        }
    }

    $sql_entidad_crediticia = "SELECT aliado_estrategico_interes_ptj FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $aliado_estrategico_interes_ptj                = $datos_entidad_crediticia['aliado_estrategico_interes_ptj'];
    $fecha_modificacion                            = date('Y-m-d H:i:s');
    
    // Lógica según tipo de simulación
    if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) {
        // PRECIO DE CONTADO: El input es el valor de contado, el monto_deuda es el crédito calculado
        $total_precio_venta                        = $monto_deuda;         // Valor a crédito (con intereses)
        $monto_deuda_sin_interes                   = $valor_contado;       // Valor de contado (sin intereses)
        $subtotal                                  = $valor_contado;
        $subtotal_sin_interes                      = $valor_contado;
        $precio_venta_producto_orig                = $valor_contado;       // Valor original (contado)
    } else {
        // PRECIO A CRÉDITO: El input es el valor a crédito, el valorTotalCredito muestra el contado
        // Aquí valor_contado viene del input (que es el precio a crédito) y monto_deuda viene del valorTotalCredito (que es el contado)
        // PERO el frontend envía: valor_contado = input (precio crédito), monto_deuda = valorTotalCredito (contado calculado)
        // Necesitamos invertir la lógica:
        $valor_credito_ingresado                   = $valor_contado;       // El input es el precio a crédito
        $valor_contado_calculado                   = $monto_deuda;         // valorTotalCredito muestra el contado
        
        $total_precio_venta                        = $valor_credito_ingresado;  // El monto total de deuda es el crédito (con intereses)
        $monto_deuda                               = $valor_credito_ingresado;  // Actualizar el monto_deuda
        $monto_deuda_sin_interes                   = $valor_contado_calculado;  // Valor de contado (sin intereses)
        $subtotal                                  = $valor_contado_calculado;
        $subtotal_sin_interes                      = $valor_contado_calculado;
        $precio_venta_producto_orig                = $valor_contado_calculado;  // Valor original (contado)
        $valor_contado                             = $valor_contado_calculado;  // Actualizar para el UPDATE
    }
    
    $numero_cuota                                  = $numero_cuotas;
    $monto_cuota_sin_interes                       = $valor_contado;
    $interes_ptj                                   = $aliado_estrategico_interes_ptj;
    $precio_venta_producto                         = $monto_cuota;
    $total_venta_producto                          = $monto_cuota;

    $sql_actualizar = "UPDATE tbl15_info_factura_venta SET cod_entidad_crediticia = '$cod_entidad_crediticia', monto_deuda = '$monto_deuda', monto_cuota = '$monto_cuota',
    total_precio_venta = '$total_precio_venta', monto_deuda_sin_interes = '$monto_deuda_sin_interes', subtotal = '$subtotal', subtotal_sin_interes = '$subtotal_sin_interes',
    numero_cuota = '$numero_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes', interes_ptj = '$interes_ptj', 
    cod_tipo_simulacion_credito = '$cod_tipo_simulacion_credito' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_actualizar = mysqli_query($conectar, $sql_actualizar);

    $sql_actualizar2 = "UPDATE tbl15_venta_producto_temporal SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto',
    precio_venta_producto_orig = '$precio_venta_producto_orig' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_actualizar2 = mysqli_query($conectar, $sql_actualizar2);

    if (!$consulta_actualizar) { sendJsonResponse(['success' => false, 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); }

    sendJsonResponse([
        'success' => true,
        'message' => 'Entidad crediticia actualizada correctamente',
        'data' => [
            'cod_info_factura_venta' => $cod_info_factura_venta,
            'cod_entidad_crediticia' => $cod_entidad_crediticia,
            'monto_deuda' => $monto_deuda,
            'monto_cuota' => $monto_cuota,
            'valor_contado' => $valor_contado,
            'fecha_modificacion' => $fecha_modificacion
        ]
    ]);

} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>