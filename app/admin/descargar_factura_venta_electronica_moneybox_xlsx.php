<?php
require_once('../conexiones/conexione.php');
require_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$cod_info_factura_venta                  = intval($_GET['cod_info_factura_venta']);
$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");

$sql_max = "SELECT cod_factura, nombre_tipo_factura   FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$consulta_max = mysqli_query($conectar, $sql_max);
$datos_max = mysqli_fetch_assoc($consulta_max);

$cod_factura                    = $datos_max['cod_factura'];
$nombre_tipo_factura            = $datos_max['nombre_tipo_factura'];

$nombre_archivo                          = "FACTURA_".$nombre_tipo_factura."_MONEYBOX_".$cod_factura.'_'.$fecha.''.$hora.'_'.$cod_info_factura_venta;
$observacion                             = "";

/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
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

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, 'CANTIDAD')
            ->setCellValue('B'.$increment, 'CODIGO_UNIDAD')
            ->setCellValue('C'.$increment, 'NI')
            ->setCellValue('D'.$increment, 'CONCEPTO')
            ->setCellValue('E'.$increment, 'PU')
            ->setCellValue('F'.$increment, 'DESC')
            ->setCellValue('G'.$increment, 'IMPUESTO')
            ->setCellValue('H'.$increment, 'CODIGO_SAT')
            ->setCellValue('I'.$increment, 'IMP_CLAVE')
            ->setCellValue('J'.$increment, 'IMP_BASE')
            ->setCellValue('K'.$increment, 'IMP_PORCENT')
            ->setCellValue('L'.$increment, 'IMP_CLAVE')
            ->setCellValue('M'.$increment, 'IMP_BASE')
            ->setCellValue('N'.$increment, 'IMP_PORCENT');

$sql = "SELECT tbl15_tercero.nombre_tipo_tercero, tbl15_tercero.nombre_tipo_identificacion, tbl15_tercero.identificacion_tercero, 
tbl15_tercero.digito_tercero, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_tercero.apellido2_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.telefono2_tercero, 
tbl15_tercero.correo_tercero, tbl15_tercero.nombre_pais, tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.nombre_tipo_cliente,  
tbl15_tercero.nombre_tipo_regimen, tbl15_tercero.nombre_tipo_impuesto, 
tbl15_venta_producto.cod_producto_barra, tbl15_venta_producto.cod_factura, tbl15_venta_producto.nombre_producto, tbl15_venta_producto.und_venta, 
tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.descuento_ptj, tbl15_venta_producto.iva_ptj, 
tbl15_venta_producto.ptj_imp_consumo, tbl15_venta_producto.ptj_ret_iva, tbl15_venta_producto.ptj_ret_ica, tbl15_venta_producto.ptj_ret_fuente, 
tbl15_venta_producto.ptj_ipc, tbl15_venta_producto.precio_ipc_total, tbl15_venta_producto.precio_ipc, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.nombre_tipo_moneda 
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $sql);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_producto_barra              = $datos['cod_producto_barra'];
$cod_factura                     = $datos['cod_factura'];
$nombre_producto                 = $datos['nombre_producto'];
$und_venta                       = $datos['und_venta'];
$precio_compra_producto          = $datos['precio_compra_producto'];
$total_compra_producto           = $datos['total_compra_producto'];
$precio_venta_producto           = $datos['precio_venta_producto'];
$total_venta_producto            = $datos['total_venta_producto'];
$fecha_ymd_venta_producto        = $datos['fecha_ymd_venta_producto'];
$descuento_ptj                   = $datos['descuento_ptj'];
$iva_ptj                         = $datos['iva_ptj'];
$ptj_imp_consumo                 = $datos['ptj_imp_consumo'];
$ptj_ret_iva                     = $datos['ptj_ret_iva'];
$ptj_ret_ica                     = $datos['ptj_ret_ica'];
$ptj_ret_fuente                  = $datos['ptj_ret_fuente'];
$ptj_ipc                         = $datos['ptj_ipc'];
$precio_ipc_total                = $datos['precio_ipc_total'];
$precio_ipc                      = $datos['precio_ipc'];
$cod_tipo_pago                   = $datos['cod_tipo_pago'];
$cod_tipo_forma_pago             = $datos['cod_tipo_forma_pago'];
$nombre_tipo_moneda              = $datos['nombre_tipo_moneda'];

$nombre_tipo_tercero             = $datos['nombre_tipo_tercero'];
$nombre_tipo_identificacion      = $datos['nombre_tipo_identificacion'];
$identificacion_tercero          = $datos['identificacion_tercero'];
$digito_tercero                  = $datos['digito_tercero'];
$nombre1_tercero                 = $datos['nombre1_tercero'];
$nombre2_tercero                 = $datos['nombre2_tercero'];
$apellido1_tercero               = $datos['apellido1_tercero'];
$apellido2_tercero               = $datos['apellido2_tercero'];
$direccion_tercero               = $datos['direccion_tercero'];
$telefono1_tercero               = $datos['telefono1_tercero'];
$telefono2_tercero               = $datos['telefono2_tercero'];
$correo_tercero                  = $datos['correo_tercero'];
$nombre_pais                     = $datos['nombre_pais'];
$nombre_departamento             = $datos['nombre_departamento'];
$nombre_ciudad                   = $datos['nombre_ciudad'];
$nombre_tipo_cliente             = $datos['nombre_tipo_cliente'];
$nombre_tipo_regimen             = $datos['nombre_tipo_regimen'];
$nombre_tipo_impuesto            = $datos['nombre_tipo_impuesto'];
$precio_venta_producto_sin_iva   = (($precio_venta_producto - (($descuento_ptj/100) * $precio_venta_producto)) / (($iva_ptj/100) + (100/100)));
$apellidos_tercero               = $apellido1_tercero.' '.$nombre2_tercero;

if ($cod_tipo_pago==1) { $tipo_medio_pago = "DEBITO"; } else { $tipo_medio_pago = "CREDITO"; }
if ($nombre_pais=='COLOMBIA') { $nombre_pais = "CO"; } else { $nombre_pais = $nombre_pais; }
if ($descuento_ptj==0) { $descuento_ptj = ""; } else { $descuento_ptj = $descuento_ptj; }
if ($direccion_tercero=='') { $direccion_tercero = 'SAN PELAYO'; } else { $direccion_tercero = $direccion_tercero; }
if ($telefono1_tercero=='') { $telefono1_tercero = '11111111'; } else { $telefono1_tercero = $telefono1_tercero; }
if ($nombre_ciudad=='') { $nombre_ciudad = 'SAN PELAYO'; } else { $nombre_ciudad = $nombre_ciudad; }
if ($correo_tercero=='') { $correo_tercero = 'sincorreo@gmail.com'; } else { $correo_tercero = $correo_tercero; }

$sql_forma_pago = "SELECT nombre_tipo_forma_pago, nombre_tipo_forma_pago2 FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago);
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago          = $datos_forma_pago['nombre_tipo_forma_pago'];
$nombre_tipo_forma_pago2         = $datos_forma_pago['nombre_tipo_forma_pago2'];

$metrica                         = 'NA - No Aplica';
$base_iva                        = ($precio_venta_producto / (($iva_ptj/100)+1));
$base_iva_und                    = ($base_iva * $und_venta);
//$iva_pagar                       = ($precio_venta_producto - $base_iva) * $und_venta;
//$smtr_total_venta               += $precio_venta_producto * $und_venta;
//$smtr_iva_pagar                 += $iva_pagar;

$increment++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $und_venta)
            ->setCellValue('B'.$increment, $metrica)
            ->setCellValue('C'.$increment, $cod_producto_barra)
            ->setCellValue('D'.$increment, $nombre_producto)
            ->setCellValue('E'.$increment, round($base_iva, 2))
            ->setCellValue('F'.$increment, '0')
            ->setCellValue('G'.$increment, '0')
            ->setCellValue('H'.$increment, $cod_producto_barra)
            ->setCellValue('I'.$increment, '1')
            ->setCellValue('J'.$increment, round($base_iva_und, 2))
            ->setCellValue('K'.$increment, $iva_ptj)
            ->setCellValue('L'.$increment, '')
            ->setCellValue('M'.$increment, '')
            ->setCellValue('N'.$increment, '');
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle("VENTAS_MONEYBOX");
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
