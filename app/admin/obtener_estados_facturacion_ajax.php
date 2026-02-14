<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

$origen_boton_selecion = isset($_GET['origen_boton_selecion']) ? $_GET['origen_boton_selecion'] : '';
if ($origen_boton_selecion === 'multiple_seleccion') {
    $condicional_estado = "";
} else {
    $condicional_estado = "(codigo_estado_facturacion = '2') AND";
}
$response = array();
try {
    $sql_estados = "SELECT codigo_estado_facturacion, nombre_estado_facturacion, color_fondo_celda_estado FROM tbl15_estado_facturacion WHERE $condicional_estado (cod_estado =  '1') ORDER BY codigo_estado_facturacion ASC";
    $consulta_estados = mysqli_query($conectar, $sql_estados);
    
    if ($consulta_estados) {
        $estados = array();
        while ($row = mysqli_fetch_assoc($consulta_estados)) {
            $estados[] = $row;
        }
        
        $response['success'] = true;
        $response['estados'] = $estados;
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al consultar los estados: ' . mysqli_error($conectar);
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}
echo json_encode($response);
?>