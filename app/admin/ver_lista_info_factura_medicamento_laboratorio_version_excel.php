<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1; 
$cod_info_factura_venta                  = intval($_GET['cod_info_factura_venta']);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_factura_max = "SELECT MAX(cod_factura) AS cod_factura_max FROM tbl15_info_factura_venta";
$resultado_info_factura_max = mysqli_query($conectar, $sql_info_factura_max);
$info_info_factura_max = mysqli_fetch_assoc($resultado_info_factura_max);

$cod_factura_max                   = $info_info_factura_max['cod_factura_max'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$cod_factura                       = $info_info_factura['cod_factura'];
$nombre_empresa                    = $info_info_factura['nombre_empresa'];
$razonsocial_empresa               = $info_info_factura['razonsocial_empresa'];
$fecha_anyo                        = $info_info_factura['fecha_anyo'];
$nombre_tipo_producto              = $info_info_factura['nombre_tipo_producto'];
$nombre_empresa_frag               = substr($nombre_empresa, 0, 30);
$nombre_archivo                    = $nombre_tipo_producto.'_'.$cod_factura.'_'.$nombre_empresa.'_FECHA_'.$fecha_anyo;
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT cod_empresa, nombre_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_empresa                       = $info_profesional['cod_empresa'];
$direccion_empresa                 = $info_profesional['direccion_empresa'];
$telefono_empresa                  = $info_profesional['telefono_empresa'];
$nit_empresa                       = $info_profesional['nit_empresa'];

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                        = $info_empresa_data['titulo'];
$nombre_emp                        = $info_empresa_data['nombre'];
$eslogan_emp                       = $info_empresa_data['eslogan'];
$direccion_emp                     = $info_empresa_data['direccion'];
$ciudad_emp                        = $info_empresa_data['ciudad'];
$pais_emp                          = $info_empresa_data['pais'];
$correo_emp                        = $info_empresa_data['correo'];
$img_cabecera_emp                  = $info_empresa_data['img_cabecera'];
$telefono_emp                      = $info_empresa_data['telefono'];
$info_legal_emp                    = $info_empresa_data['info_legal'];
$logotipo_emp                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                      = $info_empresa_data['cabecera'];
$icono_emp                         = $info_empresa_data['icono'];
$desarrollador_emp                 = $info_empresa_data['desarrollador'];
$anyo_emp                          = $info_empresa_data['anyo'];
$url_pag                           = $info_empresa_data['url_pag'];
$nombre_font_emp                   = $info_empresa_data['nombre_font'];
$tamano_font_emp                   = $info_empresa_data['tamano_font'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_factura'];
$res_emp                           = $info_empresa_data['res'];
$res1_emp                          = $info_empresa_data['res1'];
$res2_emp                          = $info_empresa_data['res2'];
$departamento_emp                  = $info_empresa_data['departamento'];
$localidad_emp                     = $info_empresa_data['localidad'];
$reg_medico_emp                    = $info_empresa_data['reg_medico'];
$regimen_emp                       = $info_empresa_data['regimen'];
$version_emp                       = $info_empresa_data['version'];
$propietario_url_firma_emp         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                    = $info_empresa_data['fecha_time'];
$licencia_emp                      = $info_empresa_data['licencia'];
$info_histclinic_emp               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp               = $info_empresa_data['info_aptlaboral'];
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
$increment                        = 2;
$increment_estilo                 = 2;
// Set document properties
$objPHPExcel->getProperties()
->setCreator($cabecera_emp)
->setLastModifiedBy($cabecera_emp)
->setTitle("LISTA - ".$cabecera_emp)
->setSubject("LISTA - ".$cabecera_emp)
->setDescription($cabecera_emp)
->setKeywords($cabecera_emp)
->setCategory($cabecera_emp);
// Add some data
$objPHPExcel->getActiveSheet()->mergeCells('A1:D1'); 

$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A1', ''.$nombre_empresa.' ('.$fecha_anyo.')')
            //->setCellValue('A'.$increment, '#')
            ->setCellValue('A'.$increment, 'CANTIDAD')
            ->setCellValue('B'.$increment, 'CONCEPTO')
            ->setCellValue('C'.$increment, 'VALOR UNITARIO')
            ->setCellValue('D'.$increment, 'VALOR TOTAL');
            //->setCellValue('G'.$increment, 'EMPRESA');
$sql_motivo_conteo = "SELECT * FROM tbl15_venta_producto WHERE cod_factura = '$cod_factura' ORDER BY cod_venta_producto DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo) ) { 

$numero++;
$cod_venta_producto             = $info_motivo_conteo['cod_venta_producto'];
$cod_producto                   = $info_motivo_conteo['cod_producto'];
$cod_producto_barra             = $info_motivo_conteo['cod_producto_barra'];
$cedula                         = $info_motivo_conteo['cedula'];
$nombre_cliente                 = $info_motivo_conteo['nombre_cliente'];
$nombre_producto                = $info_motivo_conteo['nombre_producto'];
$und_venta                      = $info_motivo_conteo['und_venta'];
$precio_costo_producto          = $info_motivo_conteo['precio_costo_producto'];
$total_costo_producto           = $info_motivo_conteo['total_costo_producto'];
$precio_venta_producto          = $info_motivo_conteo['precio_venta_producto'];
$total_venta_producto           = $info_motivo_conteo['total_venta_producto'];
$nombre_tipo_producto           = $info_motivo_conteo['nombre_tipo_producto'];
$fecha_ymd_venta_producto       = $info_motivo_conteo['fecha_ymd_venta_producto'];
$mes                            = fecha_en_espanol_mes(strtotime($fecha_ymd_venta_producto));
$increment ++;
if ($nombre_cliente=='') { $nombre_producto_cliente = $nombre_producto; } else { $nombre_producto_cliente = $nombre_cliente.' - '.$nombre_producto; }

$objPHPExcel->setActiveSheetIndex(0)

            //->setCellValue('A'.$increment, $numero)
            ->setCellValue('A'.$increment, $und_venta)
            ->setCellValue('B'.$increment, $nombre_producto_cliente)
            ->setCellValue('C'.$increment, $precio_venta_producto)
            ->setCellValue('D'.$increment, $total_venta_producto);
            //->setCellValue('G'.$increment, $nombre_empresa);
}
// Rename worksheet
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->setCellValue("C".$nombre_celda_suma, "TOTAL");
$objPHPExcel->getActiveSheet()->setCellValue("D".$nombre_celda_suma, '=SUM(D'.$celda_inicial.':D'.$celda_final.')');

$objPHPExcel->getActiveSheet()->setTitle($nombre_empresa_frag);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//$estilo = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri', 'color' => array( 'rgb' => 'B8CCE4' ) ));
$estilo_texto = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri' ));
$estilo_celda_centrada = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ) ); 
//$sheet->getDefaultStyle()->applyFromArray($style); 

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('C2D69A');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo)->applyFromArray($estilo_texto);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

$objPHPExcel->getActiveSheet()->getStyle('A'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('B'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('C'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle('D'.$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getStyle('A'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

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
