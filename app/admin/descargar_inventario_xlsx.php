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
$cod_administrador                   = intval($_GET['cod_administrador']);

if (isset($_GET['cod_barra_nombre_producto'])) { 
    $cod_barra_nombre_producto = addslashes($_GET['cod_barra_nombre_producto']); 
    if ($cod_barra_nombre_producto <> '') { 
        $filtro_cod_barra_nombre_producto = "AND ((cod_producto_barra = '$cod_barra_nombre_producto') OR (nombre_producto LIKE '%$cod_barra_nombre_producto%'))"; 
    } else { 
        $filtro_cod_barra_nombre_producto = "";  
    }
} else { 
    $cod_barra_nombre_producto = ''; 
    $filtro_cod_barra_nombre_producto = ""; 
}


if (isset($_GET['cod_dependencia'])) { 
    $cod_dependencia = intval($_GET['cod_dependencia']); 
    if ($cod_dependencia <> '') { 
        $filtro_dependencia = "AND (cod_dependencia = '$cod_dependencia')"; 
    } else { 
        $filtro_dependencia = "";  
    }
} else { 
    $cod_dependencia = ''; 
    $filtro_dependencia = ""; 
}


if (isset($_GET['nombre_tipo_producto'])) { 
    $nombre_tipo_producto = addslashes($_GET['nombre_tipo_producto']); 
    if ($nombre_tipo_producto <> '') { 
        $filtro_tipo_producto = "AND (nombre_tipo_producto = '$nombre_tipo_producto')"; 
    } else { 
        $filtro_tipo_producto = "";  
    }
} else { 
    $nombre_tipo_producto = ''; 
    $filtro_tipo_producto = ""; 
}

if (isset($_GET['nombre_tipo_precio_venta'])) { 
    $nombre_tipo_precio_venta = addslashes($_GET['nombre_tipo_precio_venta']); 
    if ($nombre_tipo_precio_venta <> '') { 
        $filtro_tipo_precio_venta = "AND (nombre_tipo_precio_venta = '$nombre_tipo_precio_venta')"; 
    } else { 
        $filtro_tipo_precio_venta = "";  
    }
} else { 
    $nombre_tipo_precio_venta = ''; 
    $filtro_tipo_precio_venta = ""; 
}


if (isset($_GET['nombre_tipo_unidad_medida'])) { 
    $nombre_tipo_unidad_medida = addslashes($_GET['nombre_tipo_unidad_medida']); 
    if ($nombre_tipo_unidad_medida <> '') { 
        $filtro_tipo_unidad_medida = "AND (nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida')"; 
    } else { 
        $filtro_tipo_unidad_medida = "";  
    }
} else { 
    $nombre_tipo_unidad_medida = ''; 
    $filtro_tipo_unidad_medida = ""; 
}

if (isset($_GET['nombre_estado'])) { 
    $nombre_estado = addslashes($_GET['nombre_estado']); 
    if ($nombre_estado <> '') { 
        $filtro_nombre_estado = "AND (nombre_estado = '$nombre_estado')"; 
    } else { 
        $filtro_nombre_estado = "";  
    }
} else { 
    $nombre_estado = ''; 
    $filtro_nombre_estado = ""; 
}


if (isset($_GET['cod_categoria'])) { 
    $cod_categoria = intval($_GET['cod_categoria']); 
    if ($cod_categoria <> '') { 
        $filtro_categoria = "AND (cod_categoria = '$cod_categoria')"; 
    } else { 
        $filtro_categoria = "";  
    }
} else { 
    $cod_categoria = ''; 
    $filtro_categoria = ""; 
}

if (isset($_GET['nombre_tipo_compra'])) { 
    $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); 
    if ($nombre_tipo_compra <> '') { 
        $filtro_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')"; 
    } else { 
        $filtro_tipo_compra = "";  
    }
} else { 
    $nombre_tipo_compra = ''; 
    $filtro_tipo_compra = ""; 
}

if (isset($_GET['cod_tipo_producto_cocina'])) { 
    $cod_tipo_producto_cocina = intval($_GET['cod_tipo_producto_cocina']); 
    if ($cod_tipo_producto_cocina <> '') { 
        $filtro_tipo_producto_cocina = "AND (cod_tipo_producto_cocina = '$cod_tipo_producto_cocina')"; 
    } else { 
        $filtro_tipo_producto_cocina = "";  
    }
} else { 
    $cod_tipo_producto_cocina = ''; 
    $filtro_tipo_producto_cocina = ""; 
}

if (isset($_GET['nombre_promocion'])) { 
    $nombre_promocion = addslashes($_GET['nombre_promocion']); 
    if ($nombre_promocion <> '') { 
        $filtro_promocion = "AND (nombre_promocion = '$nombre_promocion')"; 
    } else { 
        $filtro_promocion = "";  
    }
} else { 
    $nombre_promocion = ''; 
    $filtro_promocion = ""; 
}

if (isset($_GET['cod_opcion_descontable_inv'])) { 
    $cod_opcion_descontable_inv = intval($_GET['cod_opcion_descontable_inv']); 
    if ($cod_opcion_descontable_inv <> '') { 
        $filtro_opcion_descontable_inv = "AND (cod_opcion_descontable_inv = '$cod_opcion_descontable_inv')"; 
    } else { 
        $filtro_opcion_descontable_inv = "";  
    }
} else { 
    $cod_opcion_descontable_inv = ''; 
    $filtro_opcion_descontable_inv = ""; 
}

if (isset($_GET['campo_ordenamiento'])) {
    $campo_ordenamiento = addslashes($_GET['campo_ordenamiento']);
    $tipo_ordenamiento = addslashes($_GET['tipo_ordenamiento']);
    $buscar = '';
    $cod_dependencias = '0';
} else {
    $campo_ordenamiento = 'nombre_producto';
    $tipo_ordenamiento = 'DESC';
    $buscar = '';
    $cod_dependencias = '0';
}
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_dependencia_get = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_dependencia_get = mysqli_query($conectar, $sql_dependencia_get) or die(mysqli_error($conectar));
$datos_dependencia_get = mysqli_fetch_assoc($consulta_dependencia_get);

$nombre_dependencia_get             = $datos_dependencia_get['nombre_dependencia'];
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_hora                          = date("H:i:s");
$fecha                               = date("Ymd");
$hora                                = date("His");
$nombre_archivo                      = "INVENTARIO".'_'.$nombre_empresa."_".$nombre_dependencia_get."_".$fecha.'_'.$hora.'.csv';

if ($cod_dependencia==0) {
    $filtro_consulta_dependencia = "";
    $filtro_consulta_dependencia_and = "";
    $filtro_consulta_dependencia_rel = "";
} else {
    $filtro_consulta_dependencia = "WHERE (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_and = "AND (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_rel = "WHERE (tbl15_producto.cod_dependencia = '$cod_dependencia')";
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

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$increment                        = 1;
$increment_estilo                 = 1;
// Set document properties
$objPHPExcel->getProperties()
->setCreator("INVENTARIO")
->setLastModifiedBy("INVENTARIO")
->setTitle("LISTA - "."INVENTARIO")
->setSubject("LISTA - "."INVENTARIO")
->setDescription("INVENTARIO")
->setKeywords("INVENTARIO")
->setCategory("INVENTARIO");
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

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('G'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('H'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('I'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('J'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
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

$objPHPExcel->getActiveSheet()->getColumnDimension("R")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('R'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("S")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('S'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("T")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('T'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("U")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('U'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("V")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('V'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("W")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('W'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("X")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('X'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("Y")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Y'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("Z")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('Z'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AA")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AA'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AB")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AB'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AC")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AC'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AD")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AD'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AE")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AE'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AF")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AF'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AG")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AG'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AH")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AH'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AI")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AI'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->getActiveSheet()->getColumnDimension("AJ")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle('AJ'.$increment)->applyFromArray($estilo_celda_centrada);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, '0ID')
            ->setCellValue('B'.$increment, 'CODIGO_BARRAS')
            ->setCellValue('C'.$increment, 'CODIGO_BARRAS2')
            ->setCellValue('D'.$increment, 'NOMBRE_PRODUCTO')
            ->setCellValue('E'.$increment, 'UNIDADES_'.$nombre_campo_undidades_inv1)
            ->setCellValue('F'.$increment, 'UNIDADES_'.$nombre_campo_undidades_inv2)
            ->setCellValue('G'.$increment, 'UNIDADES_BODEGA2')
            ->setCellValue('H'.$increment, 'PRECIO_COMPRA')
            ->setCellValue('I'.$increment, 'TOTAL_PCOMPRA')
            ->setCellValue('J'.$increment, 'PRECIO_VENTA1')
            ->setCellValue('K'.$increment, 'TOTAL_PVENTA')
            ->setCellValue('L'.$increment, 'PRECIO_VENTA2')
            ->setCellValue('M'.$increment, 'PRECIO_VENTA3')
            ->setCellValue('N'.$increment, 'PRECIO_VENTA4')
            ->setCellValue('O'.$increment, 'PRECIO_VENTA5')
            ->setCellValue('P'.$increment, 'IVA')
            ->setCellValue('Q'.$increment, 'IVA_SALUDABLE')
            ->setCellValue('R'.$increment, 'COMISION_PTJ')
            ->setCellValue('S'.$increment, 'IMPOCONSUMO')
            ->setCellValue('T'.$increment, 'DEPENDENCIA')
            ->setCellValue('U'.$increment, 'COD_SUBDEPENDENCIA')
            ->setCellValue('V'.$increment, 'PESO_PRODUCTO')
            ->setCellValue('W'.$increment, 'UNIDAD_MEDIDA')
            ->setCellValue('X'.$increment, 'TIPO_PRODUCTO')
            ->setCellValue('Y'.$increment, 'TIPO_PRECIO_VENTA')
            ->setCellValue('Z'.$increment, 'PRESENTACION_UND')
            ->setCellValue('AA'.$increment, 'PRESENTACION_CAJA')
            ->setCellValue('AB'.$increment, 'PRESENTACION_UND_CAJA')
            ->setCellValue('AC'.$increment, 'PRESENTACION_UND_SOBRE')
            ->setCellValue('AD'.$increment, 'COD_CATEGORIA')
            ->setCellValue('AE'.$increment, 'COD_SUBCATEGORIA')
            ->setCellValue('AF'.$increment, 'COD_MARCA')
            ->setCellValue('AG'.$increment, 'COD_PROVEEDOR')
            ->setCellValue('AH'.$increment, 'URL_IMAGEN_PRODUCTO_ORIG')
            ->setCellValue('AI'.$increment, 'URL_IMAGEN_PRODUCTO_MIN')
            ->setCellValue('AJ'.$increment, 'ESATADO_PRODUCTO');
            //->setCellValue('G'.$increment, 'EMPRESA');

$incremento                 = 0;
$arrayCodigos               = array();
$cod_letra_numero_compra    = 0;
$cod_letra_numero_venta     = 0;
$nombre_letra_numero_compra = 0;
$nombre_letra_numero_venta  = 0;

$mostrar_datos_sql = "SELECT * 
FROM tbl15_producto WHERE (cod_producto >= '0') 
$filtro_dependencia $filtro_tipo_producto $filtro_tipo_precio_venta $filtro_tipo_unidad_medida $filtro_nombre_estado $filtro_categoria
$filtro_tipo_compra $filtro_tipo_producto_cocina $filtro_promocion $filtro_opcion_descontable_inv ORDER BY $campo_ordenamiento $tipo_ordenamiento";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_producto                         = $datos['cod_producto'];
    $cod_producto_barra                   = $datos['cod_producto_barra'];
    $cod_producto_barra2                  = $datos['cod_producto_barra2'];
    $nombre_producto                      = $datos['nombre_producto'];
    $und_producto                         = $datos['und_producto'];
    $und_producto_bodega                  = $datos['und_producto_bodega'];
    $und_producto_bodega2                 = $datos['und_producto_bodega2'];
    $precio_compra_producto               = $datos['precio_compra_producto'];
    $precio_costo_producto                = $datos['precio_costo_producto'];
    $precio_venta_producto                = $datos['precio_venta_producto'];
    $precio_venta_producto2               = $datos['precio_venta_producto2'];
    $precio_venta_producto3               = $datos['precio_venta_producto3'];
    $precio_venta_producto4               = $datos['precio_venta_producto4'];
    $precio_venta_producto5               = $datos['precio_venta_producto5'];
    $iva_ptj                              = $datos['iva_ptj'];
    $iva_saludable_ptj                    = $datos['iva_saludable_ptj'];
    $comision_ptj                         = $datos['comision_ptj'];
    $precio_ipc                           = $datos['precio_ipc'];
    $cod_dependencia                      = $datos['cod_dependencia'];
    $cod_dependencia_sub                  = $datos['cod_dependencia_sub'];
    $peso_producto                        = $datos['peso_producto'];
    $nombre_tipo_unidad_medida            = $datos['nombre_tipo_unidad_medida'];
    $nombre_tipo_producto                 = $datos['nombre_tipo_producto'];
    $nombre_tipo_precio_venta             = $datos['nombre_tipo_precio_venta'];
    $und_unidades                         = $datos['und_unidades'];
    $und_caja                             = $datos['und_caja'];
    $cajas_sobre                          = $datos['cajas_sobre'];
    $und_sobre                            = $datos['und_sobre'];
    $cod_categoria                        = $datos['cod_categoria'];
    $cod_categoria_sub                    = $datos['cod_categoria_sub'];
    $cod_marca                            = $datos['cod_marca'];
    $cod_tercero                          = $datos['cod_tercero'];
    $cod_proveedor                        = $datos['cod_proveedor'];
    $url_img_orig_producto                = $datos['url_img_orig_producto'];
    $url_img_min_producto                 = $datos['url_img_min_producto'];
    $nombre_estado                        = $datos['nombre_estado'];

    if ($und_producto > 0) { $total_pcompra = $und_producto * $precio_compra_producto; } else { $total_pcompra = 0; }
    if ($und_producto > 0) { $total_pventa = $und_producto * $precio_venta_producto; } else { $total_pventa = 0; }

    if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
    if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_bodega = intval($und_producto_bodega); } else { $und_producto_bodega = $und_producto_bodega; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_costo_producto = intval($precio_costo_producto); } else { $precio_costo_producto = $precio_costo_producto; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

    $increment ++;


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$increment, $cod_producto)
            ->setCellValue('B'.$increment, $cod_producto_barra)
            ->setCellValue('C'.$increment, $cod_producto_barra2)
            ->setCellValue('D'.$increment, $nombre_producto)
            ->setCellValue('E'.$increment, $und_producto)
            ->setCellValue('F'.$increment, $und_producto_bodega)
            ->setCellValue('G'.$increment, $und_producto_bodega2)
            ->setCellValue('H'.$increment, $precio_compra_producto)
            ->setCellValue('I'.$increment, $total_pcompra)
            ->setCellValue('J'.$increment, $precio_venta_producto)
            ->setCellValue('K'.$increment, $total_pventa)
            ->setCellValue('L'.$increment, $precio_venta_producto2)
            ->setCellValue('M'.$increment, $precio_venta_producto3)
            ->setCellValue('N'.$increment, $precio_venta_producto4)
            ->setCellValue('O'.$increment, $precio_venta_producto5)
            ->setCellValue('P'.$increment, $iva_ptj)
            ->setCellValue('Q'.$increment, $iva_saludable_ptj)
            ->setCellValue('R'.$increment, $comision_ptj)
            ->setCellValue('S'.$increment, $precio_ipc)
            ->setCellValue('T'.$increment, $cod_dependencia)
            ->setCellValue('U'.$increment, $cod_dependencia_sub)
            ->setCellValue('V'.$increment, $peso_producto)
            ->setCellValue('W'.$increment, $nombre_tipo_unidad_medida)
            ->setCellValue('X'.$increment, $nombre_tipo_producto)
            ->setCellValue('Y'.$increment, $nombre_tipo_precio_venta)
            ->setCellValue('Z'.$increment, $und_unidades)
            ->setCellValue('AA'.$increment, $und_caja)
            ->setCellValue('AB'.$increment, $cajas_sobre)
            ->setCellValue('AC'.$increment, $und_sobre)
            ->setCellValue('AD'.$increment, $cod_categoria)
            ->setCellValue('AE'.$increment, $cod_categoria_sub)
            ->setCellValue('AF'.$increment, $cod_marca)
            ->setCellValue('AG'.$increment, $cod_tercero)
            ->setCellValue('AH'.$increment, $url_img_orig_producto)
            ->setCellValue('AI'.$increment, $url_img_min_producto)
            ->setCellValue('AJ'.$increment, $nombre_estado);
            //->setCellValue('G'.$increment, 'EMPRESA');
}
$nombre_celda_suma                = $increment+1;
$celda_inicial                    = $increment_estilo+1;
$celda_final                      = $increment;

$objPHPExcel->getActiveSheet()->getStyle('A'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('B'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('C'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('D'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

$objPHPExcel->getActiveSheet()->getStyle('H'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle("H".$nombre_celda_suma)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle("H".$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->setCellValue("H".$nombre_celda_suma, "TOTAL");

$objPHPExcel->getActiveSheet()->getStyle('I'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle("I".$nombre_celda_suma)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle("I".$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle("I".$nombre_celda_suma)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
$objPHPExcel->getActiveSheet()->setCellValue("I".$nombre_celda_suma, '=SUM(I'.$celda_inicial.':I'.$celda_final.')');

$objPHPExcel->getActiveSheet()->getStyle('K'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle("K".$nombre_celda_suma)->applyFromArray($estilo_texto);
$objPHPExcel->getActiveSheet()->getStyle("K".$nombre_celda_suma)->applyFromArray($estilo_celda_centrada);
$objPHPExcel->getActiveSheet()->getStyle("K".$nombre_celda_suma)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
$objPHPExcel->getActiveSheet()->setCellValue("K".$nombre_celda_suma, '=SUM(K'.$celda_inicial.':K'.$celda_final.')');

$objPHPExcel->getActiveSheet()->getStyle('G'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('I'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('J'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('K'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('L'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('M'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('N'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('O'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('P'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
$objPHPExcel->getActiveSheet()->getStyle('Q'.$nombre_celda_suma)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle("STICKER BARRAS");
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
