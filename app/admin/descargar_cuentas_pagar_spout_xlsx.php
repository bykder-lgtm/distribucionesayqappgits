<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
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
$fecha                                                             = date("Y_m_d");
$hora                                                              = date("H_i_s");
$nombre_archivo                                                    = "REPORTE_CUENTAS_POR_PAGAR_".$fecha.'__'.$hora;
$total_monto_deuda_sum                                             = 0;
$total_abonado_sum                                                 = 0;
$total_subtotal_sum                                                = 0;

require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
if (isset($_GET['fecha_hoy'])) { 
    // Headers
    $writer->addRow(array('0ID', 'NIT', 'TERCERO', 'TOTAL DEUDA', 'TOTAL ABONADO', 'PENDIENTE', 'DIRECCION', 'TELEFONO'));
    // Then a foreach
    $calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, 
    tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_pagar.cod_tercero, 
    Sum(tbl15_cuentas_pagar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_pagar.subtotal) AS 
    subtotal, Sum(tbl15_cuentas_pagar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
    tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
    FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero
    GROUP BY tbl15_cuentas_pagar.cod_tercero ORDER BY tbl15_tercero.nombre1_tercero";
    $consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
    while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar)) {
        
        $cod_cuentas_pagar             = $datos_cuenta_pagar['cod_cuentas_pagar'];
        $monto_deuda                   = $datos_cuenta_pagar['monto_deuda'];
        $subtotal                      = $datos_cuenta_pagar['subtotal'];
        $abonado                       = $datos_cuenta_pagar['abonado'];
        $cod_tercero                   = $datos_cuenta_pagar['cod_tercero'];
        $cod_factura                   = $datos_cuenta_pagar['cod_factura'];
        $cliente                       = trim($datos_cuenta_pagar['nombre1_tercero']." ".$datos_cuenta_pagar['apellido1_tercero']);
        $direccion_tercero             = $datos_cuenta_pagar['direccion_tercero'];
        $telefono1_tercero             = $datos_cuenta_pagar['telefono1_tercero'];
        $nombre_ciudad                 = $datos_cuenta_pagar['nombre_ciudad'];
        $identificacion_tercero        = $datos_cuenta_pagar['identificacion_tercero'];

        $total_monto_deuda_sum        += $monto_deuda;
        $total_abonado_sum            += $abonado;
        $total_subtotal_sum           += $subtotal;

        $writer->addRow(array($cod_cuentas_pagar, $identificacion_tercero, $cliente, intval($monto_deuda), intval($abonado), intval($subtotal), $direccion_tercero, $telefono1_tercero));
        //$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
    }
    //$writer->addRow(array('', '', 'TOTALES', $total_monto_deuda_sum, $total_abonado_sum, $total_subtotal_sum, '', ''));

    $writer->close();
}