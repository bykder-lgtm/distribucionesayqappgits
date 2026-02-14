<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
    
    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

    $cod_administrador_lider                                        = $data_info_factura['cod_administrador_lider'];
    $cod_administrador_coordinador                                  = $data_info_factura['cod_administrador_coordinador'];
    $cod_administrador_asesor                                       = $data_info_factura['cod_administrador_asesor'];
    $cod_administrador_aliado_estrategico                           = $data_info_factura['cod_administrador_aliado_estrategico'];
    $cod_administrador_revisor                                      = $data_info_factura['cod_administrador_revisor'];

    $sql = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE (cod_aliado_estrategico = '$cod_administrador_aliado_estrategico') ORDER BY cod_tienda DESC";
    $resultado = mysqli_query($conectar, $sql);
    if ($resultado) {
        $tiendas = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $tiendas[] = $fila;
        }
        
        echo json_encode(array(
            'success' => true,
            'tiendas' => $tiendas,
            'cod_info_factura_venta' => $cod_info_factura_venta
        ));
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Error al obtener las tiendas: ' . mysqli_error($conectar)
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Método no permitido'
    ));
}
?>
