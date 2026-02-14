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
$cod_administrador                       = addslashes($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_compra                      = addslashes($_GET['nombre_tipo_compra']);

$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "COMPRAS_GENERALES_DEL_".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_factura_compra_producto.cod_administrador = '$cod_administrador')";
}
if ($cod_tercero==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
$filtro_consulta_tercero_rel = "AND (tbl15_factura_compra_producto.cod_tercero = '$cod_tercero')";
}
if ($cod_tipo_pago==0) {
$filtro_consulta_tipo_pago = "";
$filtro_consulta_tipo_pago_rel = "";
} else {
$filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
$filtro_consulta_tipo_pago_rel = "AND (tbl15_factura_compra_producto.cod_tipo_pago = '$cod_tipo_pago')";
}
if ($cod_tipo_forma_pago==0) {
$filtro_consulta_tipo_forma_pago = "";
$filtro_consulta_tipo_forma_pago_rel = "";
} else {
$filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_factura_compra_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}
if ($cod_dependencia==0) {
$filtro_consulta_dependencia = "";
$filtro_consulta_dependencia_rel = "";
} else {
$filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
$filtro_consulta_dependencia_rel = "AND (tbl15_factura_compra_producto.cod_dependencia = '$cod_dependencia')";
}
if ($nombre_tipo_compra=='0') {
$filtro_consulta_nombre_tipo_compra = "";
$filtro_consulta_nombre_tipo_compra_rel = "";
} else {
$filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
$filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_factura_compra_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
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
->setCreator("COMPRAS_GENERALES")
->setLastModifiedBy("COMPRAS_GENERALES")
->setTitle("LISTA - "."COMPRAS_GENERALES")
->setSubject("LISTA - "."COMPRAS_GENERALES")
->setDescription("COMPRAS_GENERALES")
->setKeywords("COMPRAS_GENERALES")
->setCategory("COMPRAS_GENERALES");
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
            ->setCellValue('H'.$increment, 'IVA%')
            ->setCellValue('I'.$increment, 'IVA$')
            ->setCellValue('J'.$increment, 'TIPO_PAGO')
            ->setCellValue('K'.$increment, 'VENDEDOR')
            ->setCellValue('L'.$increment, 'FECHA_VENTA')
            ->setCellValue('M'.$increment, 'PROVEEDOR')
            ->setCellValue('N'.$increment, 'COD_PROVEEDOR');

$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_compra_producto, 
tbl15_factura_compra_producto.total_compra_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.cod_administrador, tbl15_factura_compra_producto.iva_ptj, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.cod_tipo_pago, 
tbl15_factura_compra_producto.cod_tipo_forma_pago, tbl15_factura_compra_producto.cod_dependencia, 
tbl15_factura_compra_producto.nombre_tipo_compra, tbl15_factura_compra_producto.und_producto, tbl15_factura_compra_producto.cod_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_compra_rel
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
$cod_tercero                   = $info_cliente['cod_tercero'];

$total_comision                = ($total_compra_producto * ($comision_ptj/100));
$iva_valor                     = round(($precio_compra_producto * ($iva_ptj/100)), 2);

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
            ->setCellValue('I'.$increment, $iva_valor)
            ->setCellValue('J'.$increment, $nombre_tipo_pago)
            ->setCellValue('K'.$increment, $cuenta)
            ->setCellValue('L'.$increment, $fecha_ymd_venta_producto)
            ->setCellValue('M'.$increment, $nombre_propietario)
            ->setCellValue('N'.$increment, $cod_tercero);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle("COMPRAS_GENERALES");
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
