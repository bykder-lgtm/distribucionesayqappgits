<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

// Recibir parámetros
$cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;

// Inicializar respuesta
$response = array('success' => false, 'vendedores' => array());

if ($cod_aliado_estrategico > 0) {
    // Consultar vendedores de tbl15_administrador
    // Filtrar por cod_seguridad = '2' (vendedores) y cod_aliado_estrategico
    $consulta_sql = "SELECT cod_administrador, nombres_apellidos_tercero, identificacion_tercero, telefono1_tercero, correo_tercero 
                     FROM tbl15_administrador 
                     WHERE cod_seguridad = '2' 
                     AND cod_aliado_estrategico = '$cod_aliado_estrategico' 
                     AND cod_estado_activacion_usuario = '1'
                     ORDER BY nombres_apellidos_tercero ASC";
    
    $consulta = mysqli_query($conectar, $consulta_sql);
    
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        while ($row = mysqli_fetch_assoc($consulta)) {
            $response['vendedores'][] = array(
                'cod_administrador' => $row['cod_administrador'],
                'nombres_apellidos_tercero' => $row['nombres_apellidos_tercero'],
                'identificacion_tercero' => $row['identificacion_tercero'],
                'telefono1_tercero' => $row['telefono1_tercero'],
                'correo_tercero' => $row['correo_tercero']
            );
        }
        $response['success'] = true;
    }
}

// Cerrar conexión
mysqli_close($conectar);

// Enviar respuesta JSON
echo json_encode($response);
?>
