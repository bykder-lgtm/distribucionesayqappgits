<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$cod_info_factura_sticker            = intval($_GET['cod_info_factura_sticker']);
$fecha_hora                          = date("H:i:s");
$fecha                               = date("Ymd");
$hora                                = date("His");
$nombre_archivo                      = "STICKER_BARRAS_".$cod_info_factura_sticker.'_'.$fecha.'_'.$hora;
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
->setCreator("STICKER BARRAS")
->setLastModifiedBy("STICKER BARRAS")
->setTitle("LISTA - "."STICKER BARRAS")
->setSubject("LISTA - "."STICKER BARRAS")
->setDescription("STICKER BARRAS")
->setKeywords("STICKER BARRAS")
->setCategory("STICKER BARRAS");
// Add some data
//$objPHPExcel->getActiveSheet()->mergeCells('A1:G1'); 

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, 'CODIGO_BARRAS')
            ->setCellValue('B'.$increment, 'NOMBRE_PRODUCTO')
            ->setCellValue('C'.$increment, 'UNIDADES')
            ->setCellValue('D'.$increment, 'PRECIO_COMPRA')
            ->setCellValue('E'.$increment, 'PRECIO_VENTA')
            ->setCellValue('F'.$increment, 'PRECIO_COMPRA_CODIF')
            ->setCellValue('G'.$increment, 'PRECIO_VENTA_CODIF')
            ->setCellValue('H'.$increment, 'FECHA_COMPRA')
            ->setCellValue('I'.$increment, 'COD_PROVEEDOR');
            //->setCellValue('G'.$increment, 'EMPRESA');

$incremento                 = 0;
$arrayCodigos               = array();
$cod_letra_numero_compra    = 0;
$cod_letra_numero_venta     = 0;
$nombre_letra_numero_compra = 0;
$nombre_letra_numero_venta  = 0;

$mostrar_datos_sql = "SELECT und_venta, nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

$und_venta                  = $datos['und_venta'];
$nombre_producto            = substr($datos['nombre_producto'], 0, 80);
$cod_producto_barra         = $datos['cod_producto_barra'];
$precio_compra_producto     = intval($datos['precio_compra_producto']);
$precio_venta_producto      = intval($datos['precio_venta_producto']);
//$fecha_ult_compra           = $datos['fecha_ult_compra'];
$arrayCodigos[]             = (string)$cod_producto_barra; 
$cantidad_contadores        = substr_count($precio_compra_producto, '0');
$contar_palabra             = str_word_count($precio_compra_producto, 1, '0');
$cantidad_separaciones      = count($contar_palabra);

$cantidad_digitos_compra    = strlen($precio_compra_producto);
$matriz_digitos_compra      = str_split($precio_compra_producto);
$codif_letra_precio_compra  = "";

$cantidad_digitos_venta     = strlen($precio_venta_producto);
$matriz_digitos_venta       = str_split($precio_venta_producto);
$codif_letra_precio_venta   = "";

$total_caracteres           = strlen($nombre_producto);
$contar_ceros_compra        = 0;
$contar_ceros_venta         = 0;

for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
$cod_letra_numero_compra    = $matriz_digitos_compra[$i];

$sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
$consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
$datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

if ($cod_letra_numero_compra == '0') {
$nombre_letra_numero_compra = $contar_ceros_compra++;
} else {
$nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
}
$codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
}

for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

$cod_letra_numero_venta     = $matriz_digitos_venta[$i];

$sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
$consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
$datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

if ($cod_letra_numero_venta == '0') { 
$nombre_letra_numero_venta = $contar_ceros_venta++;
} else {
$nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
}
$codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
}

$sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_tercero                = $datos_producto['cod_tercero'];
$fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
$fecha_compra               = date("mY", strtotime($fecha_ult_compra));
$increment ++;

$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A'.$increment, $cod_producto_barra)
            ->setCellValue('B'.$increment, $nombre_producto)
            ->setCellValue('C'.$increment, $und_venta)
            ->setCellValue('D'.$increment, $precio_compra_producto)
            ->setCellValue('E'.$increment, $precio_venta_producto)
            ->setCellValue('F'.$increment, $codif_letra_precio_compra)
            ->setCellValue('G'.$increment, $codif_letra_precio_venta)
            ->setCellValue('H'.$increment, $fecha_ult_compra)
            ->setCellValue('I'.$increment, $cod_tercero);
}
// Rename worksheet
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->setTitle("STICKER BARRAS");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombre_archivo.'.xls"');
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
