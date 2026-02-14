<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);

if (isset($_GET['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); } else { $nombre_tipo_compra = "0"; }
if (isset($_GET['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_GET['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = "0"; }

$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "VENTAS_GENERALES_DEL_".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
    if ($cod_administrador == "0") {
        $filtro_consulta_vendedor = "";
        $filtro_consulta_vendedor_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
    }
    if ($cod_tercero == "0") {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
    }
    if ($cod_tipo_pago == "0") {
        $filtro_consulta_tipo_pago = "";
        $filtro_consulta_tipo_pago_rel = "";
    } else {
        $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
        $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
    }
    if ($cod_tipo_forma_pago == "0") {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }
    if ($cod_dependencia == "0") {
        $filtro_consulta_dependencia = "";
        $filtro_consulta_dependencia_rel = "";
    } else {
        $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_rel = "AND (tbl15_venta_producto.cod_dependencia = '$cod_dependencia')";
    }
    if ($nombre_tipo_factura =='0') {
        $filtro_consulta_nombre_tipo_factura = "";
        $filtro_consulta_nombre_tipo_factura_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
    }
    if ($nombre_tipo_compra =='0') {
        $filtro_consulta_nombre_tipo_compra = "";
        $filtro_consulta_nombre_tipo_compra_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
        $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_venta_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
    }

    if ($cod_tipo_metodo_envio == "0") {
        $filtro_consulta_tipo_metodo_envio = "";
        $filtro_consulta_tipo_metodo_envio_rel = "";
    } else {
        $filtro_consulta_tipo_metodo_envio = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
        $filtro_consulta_tipo_metodo_envio_rel = "AND (tbl15_venta_producto.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    }
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
if (PHP_SAPI == 'cli')
	die('Este ejemplo solo debe ejecutarse desde un navegador web');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/class_php/PHPExcel/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$increment                        = 1;
$increment_estilo                 = 1;

// Set document properties
$objPHPExcel->getProperties()
->setCreator("VENTAS_GENERALES")
->setLastModifiedBy("VENTAS_GENERALES")
->setTitle("LISTA - "."VENTAS_GENERALES")
->setSubject("LISTA - "."VENTAS_GENERALES")
->setDescription("VENTAS_GENERALES")
->setKeywords("VENTAS_GENERALES")
->setCategory("VENTAS_GENERALES");
// Add some data
//$objPHPExcel->getActiveSheet()->mergeCells('A1:G1'); 
//$estilo = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri', 'color' => array( 'rgb' => 'B8CCE4' ) ));
$estilo_texto = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri' ));
$estilo_celda_centrada = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ) ); 

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("O")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("P")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("Q")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, 'TIPO_FACTURA')
            ->setCellValue('B'.$increment, 'FACTURA')
            ->setCellValue('C'.$increment, 'CODIGO')
            ->setCellValue('D'.$increment, 'PRODUCTO')
            ->setCellValue('E'.$increment, 'UND')
            ->setCellValue('F'.$increment, 'T.P')
            ->setCellValue('G'.$increment, 'P.VENTA')
            ->setCellValue('H'.$increment, 'TOTAL')
            ->setCellValue('I'.$increment, '%IVA')
            ->setCellValue('J'.$increment, 'IVA')
            ->setCellValue('K'.$increment, 'FORMA_PAGO')
            ->setCellValue('L'.$increment, 'TIPO_PAGO')
            ->setCellValue('M'.$increment, 'DEPENDENCIA')
            ->setCellValue('N'.$increment, 'VENDEDOR')
            ->setCellValue('O'.$increment, 'FECHA_VENTA')
            ->setCellValue('P'.$increment, 'HORA')
            ->setCellValue('Q'.$increment, 'ID');

$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, 
tbl15_venta_producto.precio_venta_producto, tbl15_venta_producto.iva_ptj, tbl15_venta_producto.descuento_ptj, tbl15_venta_producto.cod_resolucion_facturacion, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.cod_dependencia, tbl15_venta_producto.nombre_tipo_factura, tbl15_venta_producto.und_producto, 
tbl15_venta_producto.nombre_tipo_compra, tbl15_venta_producto.cod_tipo_metodo_envio, tbl15_venta_producto.nombre_tipo_cobro, tbl15_venta_producto.nombre_tipo_precio_venta
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
$filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_venta_producto            = $info_cliente['cod_venta_producto'];
    $cod_producto                  = $info_cliente['cod_producto'];
    $cod_producto_barra            = $info_cliente['cod_producto_barra'];
    $cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
    $cod_factura                   = $info_cliente['cod_factura'];
    $cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
    $nombre_producto               = $info_cliente['nombre_producto'];
    $und_venta                     = $info_cliente['und_venta'];
    $precio_compra_producto        = $info_cliente['precio_compra_producto'];
    $precio_costo_producto         = $info_cliente['precio_costo_producto'];
    $total_compra_producto         = $info_cliente['total_compra_producto'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $total_venta_producto          = $info_cliente['total_venta_producto'];
    $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
    $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
    $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
    $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
    $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
    $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
    //$cuenta                        = $info_cliente['cuenta'];
    $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
    $cod_administrador_db          = $info_cliente['cod_administrador'];
    $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
    $comision_ptj                  = $info_cliente['comision_ptj'];
    $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
    $cod_dependencia               = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
    $und_producto                  = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio         = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro             = $info_cliente['nombre_tipo_cobro'];
    $iva_ptj                       = $info_cliente['iva_ptj'];
    $descuento_ptj                 = $info_cliente['descuento_ptj'];
    $cod_resolucion_facturacion    = $info_cliente['cod_resolucion_facturacion'];
    $nombre_tipo_precio_venta      = $info_cliente['nombre_tipo_precio_venta'];

    $total_iva_por_producto_venta  = ((($total_venta_producto - (($descuento_ptj/100)*$total_venta_producto))/(($iva_ptj/100)+(100/100)))*($iva_ptj/100));

    if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
    if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

    $total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
    $total_comision                = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum     += $total_ganancia_venta;

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

    $sql_resolucion = "SELECT prefijo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion = mysqli_query($conectar, $sql_resolucion) or die(mysqli_error($conectar));
    $datos_resolucion = mysqli_fetch_assoc($consulta_resolucion);

    $prefijo_resolucion_facturacion    = $datos_resolucion['prefijo_resolucion_facturacion'];

    $sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE cod_tipo_metodo_envio = '$cod_tipo_metodo_envio'";
    $consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio) or die(mysqli_error($conectar));
    $datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

    $nombre_tipo_metodo_envio      = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];
    $total_total_venta_producto   += $total_venta_producto;

$increment++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $nombre_tipo_factura)
            ->setCellValue('B'.$increment, $prefijo_resolucion_facturacion.' '.$cod_factura)
            ->setCellValue('C'.$increment, $cod_producto_barra)
            ->setCellValue('D'.$increment, $nombre_producto)
            ->setCellValue('E'.$increment, $und_venta)
            ->setCellValue('F'.$increment, $nombre_tipo_precio_venta)
            ->setCellValue('G'.$increment, $precio_venta_producto)
            ->setCellValue('H'.$increment, $total_venta_producto)
            ->setCellValue('I'.$increment, $iva_ptj)
            ->setCellValue('J'.$increment, round($total_iva_por_producto_venta, 2))
            ->setCellValue('K'.$increment, $nombre_tipo_forma_pago)
            ->setCellValue('L'.$increment, $nombre_tipo_pago)
            ->setCellValue('M'.$increment, $nombre_dependencia)
            ->setCellValue('N'.$increment, $cuenta)
            ->setCellValue('O'.$increment, $fecha_ymd_venta_producto)
            ->setCellValue('P'.$increment, $fecha_hora_venta_producto)
            ->setCellValue('Q'.$increment, $cod_venta_producto);
}
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->getStyle('A'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('E'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('F'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

$objPHPExcel->getActiveSheet()->getStyle('G'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle("G".$nombre_celda_suma)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle("G".$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->setCellValue("G".$nombre_celda_suma, "TOTAL");

$objPHPExcel->getActiveSheet()->getStyle('H'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle("H".$nombre_celda_suma)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle("H".$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle("H".$nombre_celda_suma)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
$objPHPExcel->getActiveSheet()->setCellValue("H".$nombre_celda_suma, '=SUM(H'.$celda_inicial.':H'.$celda_final.')');

$objPHPExcel->getActiveSheet()->getStyle('J'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle("J".$nombre_celda_suma)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle("J".$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle("J".$nombre_celda_suma)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
$objPHPExcel->getActiveSheet()->setCellValue("J".$nombre_celda_suma, '=SUM(J'.$celda_inicial.':J'.$celda_final.')');

$objPHPExcel->getActiveSheet()->getStyle('I'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('K'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('L'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('M'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('N'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('O'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('P'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('Q'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

// Rename worksheet


$objPHPExcel->getActiveSheet()->setTitle("VENTAS_GENERALES");
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombre_archivo.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
