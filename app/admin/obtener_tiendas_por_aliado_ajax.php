<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Recibir parámetros
$cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
// Inicializar respuesta
$response = array('success' => false, 'tiendas' => array(), 'mensaje' => '');

if ($cod_aliado_estrategico > 0) {
    // Consultar tiendas según cod_aliado_estrategico - INCLUYE cod_departamento y cod_municipio
    $consulta_sql = "SELECT cod_tienda, nombre_tienda, identificacion_tercero, nombre1_tercero, telefono1_tercero, correo_tercero, direccion_tercero, cod_departamento, cod_municipio, comision_ptj, cod_estado 
    FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado_estrategico' ORDER BY nombre_tienda ASC";
    $consulta = mysqli_query($conectar, $consulta_sql);
    
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        while ($row = mysqli_fetch_assoc($consulta)) {
            $response['tiendas'][] = array(
                'cod_tienda' => $row['cod_tienda'],
                'nombre_tienda' => $row['nombre_tienda'],
                'identificacion_tercero' => $row['identificacion_tercero'],
                'nombre1_tercero' => $row['nombre1_tercero'],
                'telefono1_tercero' => $row['telefono1_tercero'],
                'correo_tercero' => $row['correo_tercero'],
                'direccion_tercero' => $row['direccion_tercero'],
                'cod_departamento' => $row['cod_departamento'],
                'cod_municipio' => $row['cod_municipio'],
                'comision_ptj' => $row['comision_ptj'],
                'cod_estado' => $row['cod_estado']
            );
        }
        $response['success'] = true;
        $response['mensaje'] = 'Tiendas cargadas correctamente';
    } else {
        $response['mensaje'] = 'No se encontraron tiendas para este aliado';
    }
} else {
    $response['mensaje'] = 'Código de aliado no válido: ' . $cod_aliado_estrategico;
}
// Cerrar conexión
mysqli_close($conectar);
// Enviar respuesta JSON
echo json_encode($response);
?>
