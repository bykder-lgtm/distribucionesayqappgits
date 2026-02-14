<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

// Verificar sesión de usuario
if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit(); }

$cuenta_actual = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$respuesta_ajax = array();

// Verificar que los datos lleguen por POST
if (isset($_POST['cod_tercero']) && isset($_POST['cod_info_factura_venta'])) {
    // Obtener y limpiar los datos recibidos
    $cod_tercero = intval($_POST['cod_tercero']);
    $cod_info_factura_venta = intval($_POST['cod_info_factura_venta']);
    $identificacion_tercero = mysqli_real_escape_string($conectar, trim($_POST['identificacion_tercero']));
    $nombre1_tercero = mysqli_real_escape_string($conectar, trim($_POST['nombre1_tercero']));
    $nombre2_tercero = mysqli_real_escape_string($conectar, trim($_POST['nombre2_tercero']));
    $apellido1_tercero = mysqli_real_escape_string($conectar, trim($_POST['apellido1_tercero']));
    $apellido2_tercero = mysqli_real_escape_string($conectar, trim($_POST['apellido2_tercero']));
    $telefono1_tercero = mysqli_real_escape_string($conectar, trim($_POST['telefono1_tercero']));
    $correo_tercero = mysqli_real_escape_string($conectar, trim($_POST['correo_tercero']));
    $direccion_tercero = mysqli_real_escape_string($conectar, trim($_POST['direccion_tercero']));
    // Construir el nombre completo concatenado
    $nombres_apellidos_tercero = trim($nombre1_tercero.' '.$nombre2_tercero.' '.  $apellido1_tercero.' '.$apellido2_tercero);
    // Eliminar espacios dobles
    $nombres_apellidos_tercero = preg_replace('/\s+/', ' ', $nombres_apellidos_tercero);
    // Validar campos obligatorios
    if (empty($identificacion_tercero) || empty($nombre1_tercero) || empty($apellido1_tercero) || empty($telefono1_tercero)) {
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Faltan campos obligatorios';
        echo json_encode($respuesta_ajax);
        exit();
    }
    // Iniciar transacción
    //mysqli_begin_transaction($conectar);
    try {
        // Actualizar la tabla tbl15_tercero
        $sql_tercero = sprintf("UPDATE tbl15_tercero SET 
            identificacion_tercero = '%s', nombre1_tercero = UPPER('%s'), nombre2_tercero = UPPER('%s'), apellido1_tercero = UPPER('%s'), 
            apellido2_tercero = UPPER('%s'), nombres_apellidos_tercero = UPPER('%s'), telefono1_tercero = '%s', correo_tercero = '%s',
            direccion_tercero = '%s' WHERE cod_tercero = %d", $identificacion_tercero, $nombre1_tercero, $nombre2_tercero,
            $apellido1_tercero, $apellido2_tercero, $nombres_apellidos_tercero, $telefono1_tercero, $correo_tercero,  $direccion_tercero, $cod_tercero
        );
        $resultado_tercero = mysqli_query($conectar, $sql_tercero);
        if (!$resultado_tercero) { throw new Exception('Error al actualizar tbl15_tercero: ' . mysqli_error($conectar)); }

        // Actualizar la tabla tbl15_info_factura_venta
        $sql_info_factura = sprintf("UPDATE tbl15_info_factura_venta SET 
            identificacion_tercero = '%s', nombre1_tercero = UPPER('%s'), nombre2_tercero = UPPER('%s'),  apellido1_tercero = UPPER('%s'), 
            apellido2_tercero = UPPER('%s'), nombres_apellidos_tercero = UPPER('%s'), telefono1_tercero = '%s',
            correo_tercero = '%s', direccion_tercero = '%s' WHERE cod_info_factura_venta = %d",
            $identificacion_tercero, $nombre1_tercero, $nombre2_tercero, $apellido1_tercero,  $apellido2_tercero, $nombres_apellidos_tercero,
            $telefono1_tercero, $correo_tercero, $direccion_tercero, $cod_info_factura_venta
        );
        $resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
        if (!$resultado_info_factura) { throw new Exception('Error al actualizar tbl15_info_factura_venta: ' . mysqli_error($conectar)); }
        // Confirmar transacción
        mysqli_commit($conectar);
        // Preparar respuesta exitosa
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = true;
        $respuesta_ajax['message'] = 'Información del cliente actualizada correctamente';
        $respuesta_ajax['cod_tercero'] = $cod_tercero;
        $respuesta_ajax['cod_info_factura_venta'] = $cod_info_factura_venta;
        $respuesta_ajax['nombres_apellidos'] = $nombres_apellidos_tercero;
        
        echo json_encode($respuesta_ajax);
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        mysqli_rollback($conectar);
        
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Error en la base de datos: ' . $e->getMessage();
        echo json_encode($respuesta_ajax);
    }
} else {
    // No se recibieron los datos necesarios
    header('Content-Type: application/json');
    $respuesta_ajax['success'] = false;
    $respuesta_ajax['message'] = 'Datos incompletos en la petición';
    echo json_encode($respuesta_ajax);
}
?>