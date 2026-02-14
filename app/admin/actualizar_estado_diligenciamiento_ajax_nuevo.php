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
if (isset($_POST['cod_info_factura_venta']) && isset($_POST['campo']) && isset($_POST['estado'])) {
    // Obtener y limpiar los datos recibidos
    $cod_info_factura_venta = intval($_POST['cod_info_factura_venta']);
    $campo = mysqli_real_escape_string($conectar, trim($_POST['campo']));
    $estado = intval($_POST['estado']);
    
    // Validar campos obligatorios
    if ($cod_info_factura_venta <= 0 || empty($campo) || !in_array($estado, [0, 1])) {
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Datos inválidos en la petición';
        echo json_encode($respuesta_ajax);
        exit();
    }
    
    // Lista de campos válidos
    $campos_validos = [
        'cod_estado_dilig_infocliente',
        'cod_estado_dilig_infoproducto', 
        'cod_estado_dilig_infocreditval',
        'cod_estado_dilig_infoequipogest',
        'cod_estado_dilig_infocomercial',
        'cod_estado_dilig_infodocumentfoto'
    ];
    
    // Validar que el campo sea válido
    if (!in_array($campo, $campos_validos)) {
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Campo de diligenciamiento no válido';
        echo json_encode($respuesta_ajax);
        exit();
    }
    
    // Iniciar transacción
    //mysqli_begin_transaction($conectar);
    try {
        // Actualizar el estado del campo específico
        $sql_estado = sprintf("UPDATE tbl15_info_factura_venta SET %s = %d WHERE cod_info_factura_venta = %d", 
            $campo, $estado, $cod_info_factura_venta);
        $resultado_estado = mysqli_query($conectar, $sql_estado);
        
        if (!$resultado_estado) { throw new Exception('Error al actualizar el estado: ' . mysqli_error($conectar)); }
        
        // Verificar si todos los campos de diligenciamiento están completados
        $sql_verificacion = sprintf("SELECT cod_estado_dilig_infocliente, cod_estado_dilig_infoproducto, 
            cod_estado_dilig_infocreditval, cod_estado_dilig_infoequipogest, 
            cod_estado_dilig_infocomercial, cod_estado_dilig_infodocumentfoto 
            FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = %d", $cod_info_factura_venta);
        $resultado_verificacion = mysqli_query($conectar, $sql_verificacion);
        
        if (!$resultado_verificacion) { throw new Exception('Error al verificar estados: ' . mysqli_error($conectar)); }
        
        $fila = mysqli_fetch_assoc($resultado_verificacion);
        if ($fila) {
            // Verificar si todos los campos están en 1
            $todos_completados = (
                $fila['cod_estado_dilig_infocliente'] == 1 &&
                $fila['cod_estado_dilig_infoproducto'] == 1 &&
                $fila['cod_estado_dilig_infocreditval'] == 1 &&
                $fila['cod_estado_dilig_infoequipogest'] == 1 &&
                $fila['cod_estado_dilig_infocomercial'] == 1 &&
                $fila['cod_estado_dilig_infodocumentfoto'] == 1
            );
            
            // Actualizar cod_estado_dilig_todo según corresponda
            $nuevo_estado_todo = $todos_completados ? 1 : 0;
            $sql_todo = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_dilig_todo = %d WHERE cod_info_factura_venta = %d",
                $nuevo_estado_todo, $cod_info_factura_venta);
            $resultado_todo = mysqli_query($conectar, $sql_todo);
            
            if (!$resultado_todo) { throw new Exception('Error al actualizar estado total: ' . mysqli_error($conectar)); }
        }
        
        // Confirmar transacción
        mysqli_commit($conectar);
        
        // Preparar respuesta exitosa
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = true;
        $respuesta_ajax['message'] = 'Estado de diligenciamiento actualizado correctamente';
        $respuesta_ajax['campo'] = $campo;
        $respuesta_ajax['estado'] = $estado;
        $respuesta_ajax['cod_info_factura_venta'] = $cod_info_factura_venta;
        $respuesta_ajax['todos_completados'] = isset($todos_completados) ? $todos_completados : false;
        
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