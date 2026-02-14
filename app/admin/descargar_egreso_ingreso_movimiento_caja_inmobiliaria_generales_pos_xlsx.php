<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha_dmy_ini                           = addslashes($_GET['fecha_dmy_ini']);
$fecha_dmy_fin                           = addslashes($_GET['fecha_dmy_fin']);

$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "EGRESOS_GENERALES_DEL_".$fecha_dmy_ini.'_AL_'.$fecha_dmy_fin.'_'.$fecha.''.$hora;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
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
->setCreator("EGRESOS_GENERALES")
->setLastModifiedBy("EGRESOS_GENERALES")
->setTitle("LISTA - "."EGRESOS_GENERALES")
->setSubject("LISTA - "."EGRESOS_GENERALES")
->setDescription("EGRESOS_GENERALES")
->setKeywords("EGRESOS_GENERALES")
->setCategory("EGRESOS_GENERALES");
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
            ->setCellValue('A'.$increment, 'CONCEPTO')
            ->setCellValue('B'.$increment, 'COSTO')
            ->setCellValue('C'.$increment, 'COMENTARIO')
            ->setCellValue('D'.$increment, 'FECHA');

$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_egreso                          = $info_info_factura['cod_egreso'];
$conceptos                           = $info_info_factura['conceptos'];
$costo                               = $info_info_factura['costo'];
$comentario                          = $info_info_factura['comentario'];
$fecha_dmy                           = $info_info_factura['fecha_dmy'];
$nombre_ccosto                       = $info_info_factura['nombre_ccosto'];

$increment++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $conceptos)
            ->setCellValue('B'.$increment, $costo)
            ->setCellValue('C'.$increment, $comentario)
            ->setCellValue('D'.$increment, $fecha_dmy);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle("EGRESOS_GENERALES");
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
