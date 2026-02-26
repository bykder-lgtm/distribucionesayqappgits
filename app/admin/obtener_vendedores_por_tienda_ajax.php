<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Recibir parámetros
$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
// Inicializar respuesta
$response = array('success' => false, 'vendedores' => array());

if ($cod_tienda > 0) {
    // Primero obtener el cod_aliado_estrategico de la tienda
    $sql_tienda = "SELECT cod_aliado_estrategico FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $res_tienda = mysqli_query($conectar, $sql_tienda);
    
    if ($res_tienda && mysqli_num_rows($res_tienda) > 0) {
        $tienda = mysqli_fetch_assoc($res_tienda);
        $cod_aliado_estrategico = $tienda['cod_aliado_estrategico'];
        
        // Consultar vendedores de tbl15_administrador
        // Filtrar por cod_seguridad = '2' (vendedores) y cod_vendedor = '$cod_tienda'
        $consulta_sql = "SELECT cod_administrador, nombres_apellidos_tercero, identificacion_tercero, telefono1_tercero, correo_tercero 
        FROM tbl15_administrador WHERE cod_seguridad = '2' AND cod_vendedor = '$cod_tienda' AND cod_estado_activacion_usuario = '1' ORDER BY nombres_apellidos_tercero ASC";
        $consulta = mysqli_query($conectar, $consulta_sql);
        
        if ($consulta) {
            while ($row = mysqli_fetch_assoc($consulta)) { $response['vendedores'][] = array('cod_vendedor' => $row['cod_administrador'], 'cuenta' => $row['identificacion_tercero'], 'nombres' => $row['nombres_apellidos_tercero'], 'apellidos' => '', 'cod_administrador' => $row['cod_administrador'], 'nombres_apellidos_tercero' => $row['nombres_apellidos_tercero'], 'identificacion_tercero' => $row['identificacion_tercero']); }
            $response['success'] = true;
        }
    }
}
mysqli_close($conectar);
echo json_encode($response);
