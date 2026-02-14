<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
include_once('../evitar_mensaje_error/error.php');
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre_campo_undidades_inv1                                       = $info_empresa_data['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                       = $info_empresa_data['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                       = $info_empresa_data['nombre_campo_undidades_inv3'];
$cod_tipo_sistema_numeracion                                       = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];
$nombre_empresa                                                    = strtoupper($info_empresa_data['nombre']);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha_hora                          = date("H:i:s");
$fecha                               = date("Ymd");
$hora                                = date("His");
$nombre_archivo                      = "REPORTE_CAJAS_VIRTUALES_".$fecha.'_'.$hora;
$cabecera_emp                        = "CAJAS_VIRTUALES";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
// Headers
$writer->addRow(array('CAJA', 'USUARIO', 'DESCRIPCION', 'DOMICILIARIO', 'OBSERVACION', 'TOTAL_VENTA', 'CLIENTE', 'FECHA', 'ID'));
// Then a foreach

$sql_datos_venta_temp = "SELECT cod_venta_producto_temporal, cod_producto_barra, und_venta, nombre_producto, cod_estado_revisado, comentario_producto, precio_venta_producto, cod_info_factura_venta
FROM tbl15_venta_producto_temporal ORDER BY cod_info_factura_venta DESC";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

    $cod_venta_producto_temporal         = $datos_venta_temp['cod_venta_producto_temporal'];
    $nombre_producto                     = $datos_venta_temp['nombre_producto'];
    $und_venta                           = $datos_venta_temp['und_venta'];
    $comentario_producto                 = $datos_venta_temp['comentario_producto'];
    $precio_venta_producto               = $datos_venta_temp['precio_venta_producto'];
    $cod_info_factura_venta              = $datos_venta_temp['cod_info_factura_venta'];

    $mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, cod_estado_revisado, 
    nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, fecha_modificacion, 
    cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, observacion, latitud, longitud, latitud_longitud, cod_estado_revisado_notificacion_vendedor, observacion_tercero, cod_domiciliario
    FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $datos = mysqli_fetch_assoc($consulta);

        $cod_info_factura_venta                            = $datos['cod_info_factura_venta'];
        $cod_caja_virtual                                  = $datos['cod_caja_virtual'];
        $cuenta                                            = $datos['cuenta'];
        $cod_tercero                                       = $datos['cod_tercero'];
        $fecha_anyo                                        = $datos['fecha_anyo'];
        $fecha_hora                                        = $datos['fecha_hora'];
        $cod_administrador                                 = $datos['cod_administrador'];
        $cod_prioridad                                     = $datos['cod_prioridad'];
        $cod_base_caja                                     = $datos['cod_base_caja'];
        $nombre1_tercero                                   = $datos['nombre1_tercero'];
        $nombre2_tercero                                   = $datos['nombre2_tercero'];
        $apellido1_tercero                                 = $datos['apellido1_tercero'];
        $apellido2_tercero                                 = $datos['apellido2_tercero'];
        $identificacion_tercero                            = $datos['identificacion_tercero'];
        $fecha_nac_tercero                                 = $datos['fecha_nac_tercero'];
        $direccion_tercero                                 = $datos['direccion_tercero'];
        $telefono1_tercero                                 = $datos['telefono1_tercero'];
        $correo_tercero                                    = $datos['correo_tercero'];
        $cod_estado_revisado                               = $datos['cod_estado_revisado'];
        $cod_tipo_metodo_envio                             = $datos['cod_tipo_metodo_envio'];
        $cod_tipo_aplicacion                               = $datos['cod_tipo_aplicacion'];
        $cod_zona_envio                                    = $datos['cod_zona_envio'];
        $observacion_db                                    = $datos['observacion'];
        $latitud                                           = $datos['latitud'];
        $longitud                                          = $datos['longitud'];
        $latitud_longitud                                  = $datos['latitud_longitud'];
        $cod_estado_revisado_notificacion_vendedor         = $datos['cod_estado_revisado_notificacion_vendedor'];
        $observacion_tercero                               = $datos['observacion_tercero'];
        $cod_domiciliario                                  = $datos['cod_domiciliario'];

        $sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
        $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
        $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

        $nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
        $nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
        $apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
        $apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

        $cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

        $sql_info_usuario = "SELECT cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
        $consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
        $datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

        $cuenta_usuario                     = $datos_info_usuario['cuenta'];

        $sql_vendedor_domiciliario = "SELECT nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE cod_domiciliario = '$cod_domiciliario'";
        $consulta_vendedor_domiciliario = mysqli_query($conectar, $sql_vendedor_domiciliario) or die(mysqli_error($conectar));
        $datos_vendedor_domiciliario = mysqli_fetch_assoc($consulta_vendedor_domiciliario);

        $nombres_domiciliario                  = $datos_vendedor_domiciliario['nombres_domiciliario'].' '.$datos_vendedor_domiciliario['apellidos_domiciliario'];

    $writer->addRow(array($cod_base_caja, $cuenta_usuario, $nombre_producto.$comentario_producto, $nombres_domiciliario, $observacion_tercero, $precio_venta_producto, $cliente, $fecha_anyo, $cod_info_factura_venta));
}
//$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
$writer->close();
?>