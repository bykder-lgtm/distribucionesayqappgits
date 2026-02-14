<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1;
if (isset($_GET['cod_consentimiento_informado'])) { $cod_consentimiento_informado = intval($_GET['cod_consentimiento_informado']); } else { $cod_consentimiento_informado = 0; }
if (isset($_GET['fecha'])) { $fecha = addslashes($_GET['fecha']); } else { $fecha = date("Y/m/d"); }

$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$fecha_ini_seg                     = strtotime($fecha_ini);
$fecha_seg                         = strtotime($fecha);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);
$fecha_ymdhis                      = date("Y/m/d H:i:s");
$anyo_fecha_ini                    = date("Y", $fecha_ini_seg);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
//$sql_info_factura_max = "SELECT MAX(cod_factura) AS cod_factura_max FROM tbl15_info_factura_venta";
//$resultado_info_factura_max = mysqli_query($conectar, $sql_info_factura_max);
//$info_info_factura_max = mysqli_fetch_assoc($resultado_info_factura_max);

//$cod_factura_max                   = $info_info_factura_max['cod_factura_max'];
//-----------------------------------------------------------------------------------------------------//
////-----------------------------------------------------------------------------------------------------//
//$sql_info_factura = "SELECT cod_factura, fecha_ini, fecha_fin, nombre_empresa, motivo FROM tbl15_info_factura_venta WHERE cod_factura = '$cod_factura_max'";
//$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
//$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

//$fecha_ini_db                      = $info_info_factura['fecha_ini'];
//$fecha_fin_db                      = $info_info_factura['fecha_fin'];
//$nombre_empresa_db                 = $info_info_factura['nombre_empresa'];
//$motivo_db                         = $info_info_factura['motivo'];
//$cod_factura                       = $info_info_factura['cod_factura']+1;
$nombre_archivo                    = 'RIPS_SALUD_OCUPACIONAL'.$cod_consentimiento_informado.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
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

//$estilo = array('font'  => array('bold'  => true, 'size'  => 10, 'name'  => 'Calibri', 'color' => array( 'rgb' => 'F2DDDC' ) ));
$estilo_texto                         = array('font' => array('bold' => false, 'size' => 8, 'name'  => 'Calibri'));
$estilo_texto_negrita                 = array('font' => array('bold' => true, 'size'  => 8, 'name'  => 'Calibri'));
$estilo_texto_grande_negrita          = array('font' => array('bold' => true, 'size'  => 15, 'name'  => 'Calibri'));
$estilo_texto_extra_grande_negrita    = array('font' => array('bold' => true, 'size'  => 30, 'name'  => 'Calibri'));
$estilo_celda_centro_borde            = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ), 'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));
$estilo_celda_centro                  = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ));
$estilo_celda_izquierda               = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ));
$estilo_celda_izquierda_borde         = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ), 'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));
$estilo_celda_derecha                 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, ));
$estilo_celda_derecha_borde           = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, ), 'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));
$estilo_celda_centro_borde_ext        = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ), 'borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '000000'), ), ));

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$increment                        = 5;
$increment_estilo_celda5          = 5;
$fecha_hoy_time                   = strtotime(date("Y/m/d"));
// Set document properties
$objPHPExcel->getProperties()
			->setCreator($cabecera_emp)
			->setLastModifiedBy($cabecera_emp)
			->setTitle("RIPS SALUD OCUPACIONAL - ".$cabecera_emp)
			->setSubject("RIPS SALUD OCUPACIONAL - ".$cabecera_emp)
			->setDescription($cabecera_emp)
			->setKeywords($cabecera_emp)
			->setCategory($cabecera_emp);


$objPHPExcel->getActiveSheet()->mergeCells('B1:V1');//INFORME DE CONDICIONES DE SALUD --
$objPHPExcel->getActiveSheet()->mergeCells('B2:L4');//INFORMACIÓN SOCIODEMOGRAFÍCA --
$objPHPExcel->getActiveSheet()->mergeCells('M2:Q4');//INFORMACIÓN DE EXPOSICIÓN ACTUAL --
$objPHPExcel->getActiveSheet()->mergeCells('R2:R4');//DIAGNÓSTICOS ENCONTRADOS --

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'INFORME DE CONDICIONES DE SALUD')
			->setCellValue('B2', 'INFORMACIÓN SOCIODEMOGRAFÍCA')
			->setCellValue('M2', 'INFORMACIÓN DE EXPOSICIÓN ACTUAL')
			->setCellValue('R2', 'DIAGNÓSTICOS ENCONTRADOS')

            ->setCellValue('A'.$increment, '#')
            ->setCellValue('B'.$increment, 'CEDULA')
            ->setCellValue('C'.$increment, 'NOMBRES Y APELLIDOS')
            ->setCellValue('D'.$increment, 'TIPO DE SANGRE (RH)')
            ->setCellValue('E'.$increment, 'SEXO')
            ->setCellValue('F'.$increment, 'FECHA NACIDO')
            ->setCellValue('G'.$increment, 'EDAD')
            ->setCellValue('H'.$increment, 'GRADO DE ESCOLARIDAD')
            ->setCellValue('I'.$increment, 'ESTADO ESCOLARIDAD')
            ->setCellValue('J'.$increment, 'ESTRATO SOCIAL')
            ->setCellValue('K'.$increment, 'TIPO DE POBLACIÓN')
            ->setCellValue('L'.$increment, 'ESTADO CIVIL')
            ->setCellValue('M'.$increment, 'Cargas estáticas')
            ->setCellValue('N'.$increment, 'Sobre esfuerzos')
            ->setCellValue('O'.$increment, 'Carga dinámica')
            ->setCellValue('P'.$increment, 'Movimientos repetitivos')
            ->setCellValue('Q'.$increment, 'Posturas inadecuadas')
            ->setCellValue('R'.$increment, 'CÓDIGO CIE10 (Dec.1477) - NOMBRE DE DIAGNÓSTICO')
            ->setCellValue('S'.$increment, 'RECOMENDACIONES MÉDICAS')
            ->setCellValue('T'.$increment, 'TALLA (MTS)')
            ->setCellValue('U'.$increment, 'PESO (KG)')
            ->setCellValue('V'.$increment, 'IMC')
            ->setCellValue('W'.$increment, 'CARGO');

$sql_historia_clincia = "SELECT cod_historia_clinica, motivo, cod_cliente, nombre_empresa, fecha_ymd, hora 
FROM tbl15_historia_clinica WHERE fecha_ymd = '".($cod_historia_clinica)."'";
$consultar_historia_clincia = mysqli_query($conectar, $sql_historia_clincia) or die(mysqli_error($conectar));
while ($info_historia_clincia = mysqli_fetch_assoc($consultar_historia_clincia)) { 

$numero++;
$cod_historia_clinica        = $info_historia_clincia['cod_historia_clinica'];
$cod_cliente                 = $info_historia_clincia['cod_cliente'];
$motivo                      = $info_historia_clincia['motivo'];
$nombre_empresa              = $info_historia_clincia['nombre_empresa'];
$fecha_ymd                   = $info_historia_clincia['fecha_ymd'];
$hora                        = $info_historia_clincia['hora'];

$sql_cliente = "SELECT cedula, nombres, apellido1, apellido2, url_img_firma_min, url_img_firma FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($consultar_cliente))

$cedula                      = $info_cliente['cedula'];
$nombres                     = $info_cliente['nombres'];
$apellido1                   = $info_cliente['apellido1'];
$apellido2                   = $info_cliente['apellido2'];
$url_img_firma_min           = $info_cliente['url_img_firma_min'];
$url_img_firma               = $info_cliente['url_img_firma'];
$nombres_apellidos           = $nombres.' '.$apellido1;

$nombre_estrato              = $info_motivo_conteo['nombre_estrato'];
$nombre_raza                 = $info_motivo_conteo['nombre_raza'];
$nombre_estrato              = $info_motivo_conteo['nombre_estrato'];
$clasrieg_ergo1_trabestat    = $info_motivo_conteo['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis    = $info_motivo_conteo['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga        = $info_motivo_conteo['clasrieg_ergo1_carga'];
$clasrieg_ergo1_movrepet     = $info_motivo_conteo['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_postforz     = $info_motivo_conteo['clasrieg_ergo1_postforz'];
$exa_fis_talla               = $info_motivo_conteo['exa_fis_talla'];
$exa_fis_peso                = $info_motivo_conteo['exa_fis_peso'];
$exa_fis_imc                 = $info_motivo_conteo['exa_fis_imc'];
$cargo_empresa               = $info_motivo_conteo['cargo_empresa'];
$fecha_anyo                  = $info_motivo_conteo['fecha_anyo'];
$fecha_nac_ymd               = $info_motivo_conteo['fecha_nac_ymd'];
$fecha_nac_time              = strtotime($fecha_nac_ymd);
$diferencia_edad             = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                   = floor($diferencia_edad / (365*60*60*24));

$tbl15_cie10                       = "";
$conteo                      = 0;

$obtener_cie10diag = "SELECT * FROM tbl15_cie10diag WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_cie10diag);

while ($info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag)) {
$cod_cie10diag              = $info_cie10diag['cod_cie10diag'];
$cie10_cod                  = $info_cie10diag['cie10_cod'];
$cie10_diag                 = $info_cie10diag['cie10_diag'];

$conteo ++;
if ($total_datos == $conteo) { $tbl15_cie10 .= "(".$cie10_cod.")"." - ".$cie10_diag; } else { $tbl15_cie10 .= "(".$cie10_cod.")"." - ".$cie10_diag." -//- "; }
}
$recomend                    = "";
$increment ++;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $numero)
            ->setCellValue('B'.$increment, $cedula)
            ->setCellValue('C'.$increment, $nombres_apellidos)
            ->setCellValue('D'.$increment, $nombre_grupo_rh)
            ->setCellValue('E'.$increment, $nombre_sexo)
            ->setCellValue('F'.$increment, $fecha_nac_ymd)
            ->setCellValue('G'.$increment, $edad_anyo)
            ->setCellValue('H'.$increment, $nombre_escolaridad)
			->setCellValue('I'.$increment, $nombre_escolaridad_estado)
			->setCellValue('J'.$increment, $nombre_estrato)
			->setCellValue('K'.$increment, $nombre_raza)
			->setCellValue('L'.$increment, $nombre_estado_civil)
			->setCellValue('M'.$increment, $clasrieg_ergo1_trabestat)
			->setCellValue('N'.$increment, $clasrieg_ergo1_esfuerfis)
			->setCellValue('O'.$increment, $clasrieg_ergo1_carga)
			->setCellValue('P'.$increment, $clasrieg_ergo1_movrepet)
			->setCellValue('Q'.$increment, $clasrieg_ergo1_postforz)
			->setCellValue('R'.$increment, $tbl15_cie10)
			->setCellValue('S'.$increment, $recomendacion_general_informe_condiciones_salud)
			->setCellValue('T'.$increment, $exa_fis_talla)
			->setCellValue('U'.$increment, $exa_fis_peso)
            ->setCellValue('V'.$increment, $exa_fis_imc)
            ->setCellValue('W'.$increment, $cargo_empresa);

$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->applyFromArray($estilo_celda_centro_borde);
//$objPHPExcel->getActiveSheet()->getStyle('A'.$increment)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->applyFromArray($estilo_celda_izquierda_borde);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_celda_izquierda_borde);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_celda_izquierda_borde);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
}
// Rename worksheet
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo_celda5+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->setTitle("RIPS SALUD OCUPACIONAL");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B2:L4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B2:L4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("B2:L4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('M2:Q4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('M2:Q4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("M2:Q4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('R2:R4')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R2:R4')->applyFromArray($estilo_celda_centro_borde_ext);
$objPHPExcel->getActiveSheet()->getStyle("R2:R4")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('EAF1DD');

/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle("A5")->getBorders()->getAllborders()->setboRderstYLE(phpexCel_stYle_bordER::BORDER_THIN)->getColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($estilo_texto_extra_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($estilo_celda_centro);
//$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('B'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('C'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('D'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('E'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('F'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('H'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('I'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('J'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('K'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('K'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('L'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('L'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('M'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('N'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('O'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('P'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');

$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');

$objPHPExcel->getActiveSheet()->getStyle('S'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('T'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('U'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('V'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');

$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->applyFromArray($estilo_texto_negrita);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment_estilo_celda5)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2DDDC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('M2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('M2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E5E0EC');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getStyle('R2')->applyFromArray($estilo_texto_grande_negrita);
$objPHPExcel->getActiveSheet()->getStyle('R2')->applyFromArray($estilo_celda_centro_borde);
$objPHPExcel->getActiveSheet()->getStyle('R2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EAF1DD');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
$objPHPExcel->getActiveSheet()->setAutoFilter('B5:S5');
/* ======================================================================================================= */
/* ---------------------------  ------------------------- */
/* ======================================================================================================= */
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