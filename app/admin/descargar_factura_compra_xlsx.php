<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$cod_info_factura_compra                 = intval($_GET['cod_info_factura_compra']);
$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "FACTURA_COMPRA_".$cod_info_factura_compra.'_'.$fecha.''.$hora;
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
->setCreator("FACTURA_COMPRA")
->setLastModifiedBy("FACTURA_COMPRA")
->setTitle("LISTA - "."FACTURA_COMPRA")
->setSubject("LISTA - "."FACTURA_COMPRA")
->setDescription("FACTURA_COMPRA")
->setKeywords("FACTURA_COMPRA")
->setCategory("FACTURA_COMPRA");
// Add some data
//$objPHPExcel->getActiveSheet()->mergeCells('A1:G1'); 

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("O")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("P")->setAutoSize(true);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, 'TIPO_FACTURA')
            ->setCellValue('B'.$increment, 'FACTURA')
            ->setCellValue('C'.$increment, 'CODIGO')
            ->setCellValue('D'.$increment, 'PRODUCTO')
            ->setCellValue('E'.$increment, 'UND')
            ->setCellValue('F'.$increment, 'P.COMPRA')
            ->setCellValue('G'.$increment, 'P.TOTAL COMPRA')
            ->setCellValue('H'.$increment, 'IVA')
            ->setCellValue('I'.$increment, 'TIPO_PAGO')
            ->setCellValue('J'.$increment, 'VENDEDOR')
            ->setCellValue('K'.$increment, 'FECHA_COMPRA')
            ->setCellValue('L'.$increment, 'PROVEEDOR');

$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_compra_producto, 
tbl15_factura_compra_producto.total_compra_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.cod_administrador, tbl15_factura_compra_producto.iva_ptj, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.cod_tipo_pago, 
tbl15_factura_compra_producto.cod_tipo_forma_pago, tbl15_factura_compra_producto.cod_dependencia, 
tbl15_factura_compra_producto.nombre_tipo_compra, tbl15_factura_compra_producto.und_producto
FROM tbl15_tercero RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.cod_info_factura_compra = '$cod_info_factura_compra') 
ORDER BY tbl15_factura_compra_producto.cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
$cod_factura                   = $info_cliente['cod_factura'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_compra                    = $info_cliente['und_compra'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_costo_producto          = $info_cliente['total_costo_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$total_compra_producto         = $info_cliente['total_compra_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$nombre_propietario            = $info_cliente['nombre1_tercero'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
$cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$und_producto                  = $info_cliente['und_producto'];

$total_comision                = ($total_compra_producto * ($comision_ptj/100));

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

$increment++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $nombre_tipo_compra)
            ->setCellValue('B'.$increment, $cod_factura)
            ->setCellValue('C'.$increment, $cod_producto_barra)
            ->setCellValue('D'.$increment, $nombre_producto)
            ->setCellValue('E'.$increment, $und_compra)
            ->setCellValue('F'.$increment, $precio_compra_producto)
            ->setCellValue('G'.$increment, $total_compra_producto)
            ->setCellValue('H'.$increment, $iva_ptj)
            ->setCellValue('I'.$increment, $nombre_tipo_pago)
            ->setCellValue('J'.$increment, $cuenta)
            ->setCellValue('K'.$increment, $fecha_ymd_venta_producto)
            ->setCellValue('L'.$increment, $nombre_propietario);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle("FACTURA_COMPRA");
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
