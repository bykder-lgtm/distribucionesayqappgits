<?php 
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                            = $info_empresa_data['titulo'];
$nombre_emp                            = $info_empresa_data['nombre'];
$eslogan_emp                           = $info_empresa_data['eslogan'];
$direccion_emp                         = $info_empresa_data['direccion'];
$ciudad_emp                            = $info_empresa_data['ciudad'];
$pais_emp                              = $info_empresa_data['pais'];
$correo_emp                            = $info_empresa_data['correo'];
$img_cabecera_emp                      = $info_empresa_data['img_cabecera'];
$telefono_emp                          = $info_empresa_data['telefono'];
$info_legal_emp                        = $info_empresa_data['info_legal'];
$logotipo_emp                          = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp     = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                   = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                       = $info_empresa_data['nit_empresa'];
$cabecera_emp                          = $info_empresa_data['cabecera'];
$icono_emp                             = $info_empresa_data['icono'];
$desarrollador_emp                     = $info_empresa_data['desarrollador'];
$anyo_emp                              = $info_empresa_data['anyo'];
$url_pag                               = $info_empresa_data['url_pag'];
$nombre_font                           = $info_empresa_data['nombre_font'];
$res_emp                               = $info_empresa_data['res'];
$res1_emp                              = $info_empresa_data['res1'];
$res2_emp                              = $info_empresa_data['res2'];
$departamento_emp                      = $info_empresa_data['departamento'];
$localidad_emp                         = $info_empresa_data['localidad'];
$reg_medico_emp                        = $info_empresa_data['reg_medico'];
$regimen_emp                           = $info_empresa_data['regimen'];
$version_emp                           = $info_empresa_data['version'];
$propietario_url_firma_emp             = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                        = $info_empresa_data['fecha_time'];
$licencia_emp                          = $info_empresa_data['licencia'];
$tamano_font_emp                       = $info_empresa_data['tamano_font'];
$info_histclinic_emp                   = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                   = $info_empresa_data['info_aptlaboral'];

require_once dirname(__FILE__).'/class_php/PHPWord/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Shared\Converter;

//Instancia phpWord.
//$phpWord = new \PhpOffice\PhpWord\PhpWord();
$phpWord = new PhpWord();
//$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->addParagraphStyle('multipleTab',array('tabs' => array(new\PhpOffice\PhpWord\Style\Tab('left', 1550),new\PhpOffice\PhpWord\Style\Tab('center', 3200),new \PhpOffice\PhpWord\Style\Tab('right', 5300),)),array('name' => 'Arial', 'size' => '12', 'bold' => 'true'), array('alignment' => 'center'));
$phpWord->addParagraphStyle('texto_derecha',array('tabs' => array(new\PhpOffice\PhpWord\Style\Tab('right', 9090))),array('name' => 'Arial', 'size' => '12', 'bold' => 'true'), array('alignment' => 'center'));
$phpWord->addParagraphStyle('texto_centrado',array('tabs' => array(new\PhpOffice\PhpWord\Style\Tab('center', 4680))),array('name' => 'Arial', 'size' => '12', 'bold' => 'true'), array('alignment' => 'center'));
$phpWord->addParagraphStyle('texto_justificado', array('align' => 'justify', 'spaceAfter' => 100));
// Tabla personalizada
$estilo_fila       = array('borderColor' => 'F2F2F2','borderSize' => '5','cellMargin' => '20','bgColor' => '088A68',);
$estilo_columna    = array('borderColor' => 'F2F2F2','borderSize' => '5','cellMargin' => '20','bgColor' => '5882FA',);

$styleTable        = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
$styleFirstRow     = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$styleCell         = array('valign' => 'center');
$styleCellBTLR     = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fontStyle         = array('bold' => true, 'align' => 'center');
//------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------//
$section_portada = $phpWord->addSection();

//$marca_agua = $section_portada->addHeader();
//$marca_agua->addWatermark('../imagenes/marca_agua.png', array('marginTop' => 200, 'marginLeft' => 55));
//------------------------------------------------------------------------------------------------------//
$header = $section_portada->addHeader();
$header->addImage('../imagenes/logo_superior_pdf_imprimir.png', array('width' => 600, 'height' => 48));
//------------------------------------------------------------------------------------------------------//
$firma_footer = $section_portada->addFooter();
//$firma_footer->addText(htmlspecialchars("FIRMA"), null, 'texto_centrado');
$firma_footer->addImage($propietario_url_firma_emp, array('width' => 200, 'height' => 60));
$firma_footer->addText(htmlspecialchars("______________________________"), null, 'texto_centrado');
$firma_footer->addText(htmlspecialchars($propietario_nombres_apellidos_emp), null, 'texto_centrado');
$firma_footer->addText(htmlspecialchars("Reg. Médico: ".$reg_medico_emp), null, 'texto_centrado');
$firma_footer->addText(htmlspecialchars("Licencia Salud Ocupacional: ".$licencia_emp), null, 'texto_centrado');

//$footer = $section_portada->addFooter();
//$footer->addText(htmlspecialchars("BARRIO EL BIGHT, VILLA MONICA LOCAL 101, DIAGONAL - Teléfonos: 3115637331"), null, 'texto_centrado');
//$footer->addText(htmlspecialchars("Email: hlaboral@gmail.com - SAN ANDRES - COLOMBIA"), null, 'texto_centrado');
//$footer->addPreserveText(htmlspecialchars('Página {PAGE} de {NUMPAGES}.'), array('align' => 'center'));
//$footer->addLink('http://google.com', htmlspecialchars('Direct Google'));
//------------------------------------------------------------------------------------------------------//
// Texto con formato
$section_portada->addText(htmlspecialchars("\tDIAGNÓSTICO DE CONDICIONES DE SALUD"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\tCEINSUALEGRES LTDA"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\tELABORADO POR: DR. EDINSON CASTRO VALDERRAMA"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\tMOTIVO: PERIODICO Y PRE-INGRESO"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\t"), null, 'texto_centrado');
$section_portada->addText(htmlspecialchars("\tDel 17 de Enero del 2020 al 31 de Enero del 2020"), null, 'texto_centrado');
//------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------//
$section_portada->addTextBreak(1);
$section_introduccion = $phpWord->addSection();
$section_introduccion->addText(htmlspecialchars("\tINTRODUCCIÓN"), null, 'texto_centrado');
$html = '';
$html .= '<p>Some well formed HTML snippet needs to be used</p>';
$html .= '<p>With for example <strong>some<sup>1</sup> <em>inline</em> formatting</strong><sub>1</sub></p>';
$html .= '<p>Unordered (bulleted) list:</p>';
$html .= '<ul><li>Item 1</li><li>Item 2</li><ul><li>Item 2.1</li><li>Item 2.1</li></ul></ul>';
$html .= '<p>Ordered (numbered) list:</p>';
$html .= '<ol><li>Item 1</li><li>Item 2</li></ol>';
$html .= '<tr>';
$html .= '<th style="text-align:center">Peligro</th>';
$html .= '<th style="text-align:center"># declarantes</th>';
$html .= '<th style="text-align:center">% declarantes</th>';
$html .= '</tr>';

\PhpOffice\PhpWord\Shared\Html::addHtml($section_introduccion, $html);

$section_introduccion->addText(htmlspecialchars("\tEl Diagnóstico de Salud constituye una de las tareas claves dentro del análisis de información de Salud y Seguridad en el Trabajo. 
Esta fundamentado en la información recolectada durante la realización de las actividades de Medicina del trabajo y hoy en día constituye una herramienta básica para el equipo de Salud y Seguridad en el Trabajo en la toma de decisiones. 
Se realiza con base en la información recolectada a partir de los exámenes médicos y paraclìnicos, su importancia radica en los hallazgos, las asociaciones exposición-efecto y análisis del comportamiento de las diferentes variables a través del tiempo. 
Su realización comprende varias etapas sucesivas donde se determinan las fuentes de información, se establecen los formatos de recolección de información, se identifican y priorizan las variables a estudiar, posteriormente se realiza un análisis cruzando las variables más relevantes para el área de Salud y Seguridad en el Trabajo. 
Las variables a evaluar se pueden clasificar en grandes grupos, las asociadas al individuo, las asociadas al puesto de trabajo y los hallazgos clínicos, buscando siempre la correlación de los factores de riesgo del puesto de trabajo y la condición clínica de cada persona. 
Finalmente se establecen una serie de recomendaciones generales para ser ejecutadas por parte de todos los actores del Sistema de Gestión de Salud y Seguridad en el Trabajo. 
Las personas asignadas a la administración del sistema de gestión se encargarán de la vigilancia y control del cumplimiento de dichas recomendaciones."), null, 'texto_justificado');

$section_introduccion->addTextBreak(1);
//------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------//

$section = $phpWord->addSection();

$phpWord->addTableStyle('tabla_01', $styleTable, $styleFirstRow);
$phpWord->addTableStyle('tabla_02', $estilo_fila, $estilo_columna);
$tabla_01             = $section->addTable('tabla_01');
$tabla_02             = $section->addTable('tabla_02');

$nombre_columnas      = array('Columna 1' , 'Columna 2', 'Columna 3', 'Columna 4', 'Columna 5');
$nombre_celdas        = array('Celda 1' , 'Celda 2', 'Celda 3', 'Celda 4' , 'Celda 5', 'Celda 6', 'Celda 7' , 'Celda 8', 'Celda 9', 'Celda 10' , 'Celda 11', 'Celda 12', 'Celda 13', 'Celda 14' , 'Celda 15', 'Celda 16', 'Celda 17');
$cantidad_columnas    = count($nombre_columnas);
$cantidad_celdas      = count($nombre_celdas);
$total_filas_generar  = ceil($cantidad_celdas / $cantidad_columnas);    // 5
$total_filas          = $cantidad_columnas + 1;
$contador_filas       = 0;

$tabla_01->addRow();
for ($datos_columnas = 0; $datos_columnas <= $cantidad_columnas-1; $datos_columnas++) {
	$tabla_01->addCell(3000)->addText(htmlspecialchars($nombre_columnas[$datos_columnas]));
}

for ($datos_filas = 1; $datos_filas <= $total_filas_generar; $datos_filas++) {

	$tabla_01->addRow();
    for ($cell = 1; $cell <= $cantidad_columnas; $cell++) {
        $tabla_01->addCell(3000)->addText(htmlspecialchars($nombre_celdas[$contador_filas]));
     $contador_filas ++;
    }

}

$chartTypes           = array('pie', 'doughnut', 'bar', 'column', 'line', 'area', 'scatter', 'radar');
$twoSeries            = array('bar', 'column', 'line', 'area', 'scatter', 'radar');
$threeSeries          = array('bar', 'line');
/*/
$categories = array(
    'legend' => array('Legend 1', 'Legend 2', 'Legend 3'),
    'data' => array(
        array(
            'name' => 'data 1',
            'values' => array(10, 20, 5),
        ),
        array(
            'name' => 'data 2',
            'values' => array(20, 60, 3),
        ),
        array(
            'name' => 'data 3',
            'values' => array(50, 33, 7),
        ),
    ),
);
*/
$categories           = array('COLUMNA 1', 'COLUMNA 2', 'COLUMNA 3', 'COLUMNA 4', 'COLUMNA 5');
$series1              = array(5, 3, 4, 2, 7);
$series2              = array(15, 2, 9, 5, 9);
$series3              = array(8, 3, 2, 5, 4);

$chart = $section->addChart('pie', $categories, $series1);
$chart->getStyle()->setWidth(Converter::inchToEmu(6.5))->setHeight(Converter::inchToEmu(3));
$chart->addSeries($categories,$series2);
//$chart->addTitle(ucfirst("Titulo grafico"), 2);
/*
foreach ($chartTypes as $chartType) {
    $section->addTitle(ucfirst($chartType), 2);
    $chart = $section->addChart($chartType, $categories, $series1);
    $chart->getStyle()->setWidth(Converter::inchToEmu(6.5))->setHeight(Converter::inchToEmu(3));
    if (in_array($chartType, $twoSeries)) {
        $chart->addSeries($categories, $series2);
    }
    if (in_array($chartType, $threeSeries)) {
        $chart->addSeries($categories, $series3);
    }
    $section->addTextBreak();
}
*/
// 3D charts
/*
$section = $phpWord->addSection(array('breakType' => 'continuous'));
$section->addTitle(htmlspecialchars('3D charts'), 1);
$section = $phpWord->addSection(array('colsNum' => 2, 'breakType' => 'continuous'));

$chartTypes = array('pie', 'bar', 'column', 'line', 'area');
$multiSeries = array('bar', 'column', 'line', 'area');
$style = array('width' => Converter::cmToEmu(6.5), 'height' => Converter::cmToEmu(3), '3d' => true);
foreach ($chartTypes as $chartType) {
    $section->addTitle(ucfirst($chartType), 2);
    $chart = $section->addChart($chartType, $categories, $series1, $style);
    if (in_array($chartType, $multiSeries)) {
        $chart->addSeries($categories, $series2);
        $chart->addSeries($categories, $series3);
    }
    $section->addTextBreak();
}
*/
/*
$chart = $section->addChart('pie', $categories, $series1);
$chart->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart->addSeries($categories,$series2);

$chart2 = $section->addChart('doughnut', $categories, $series1);
$chart2->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart2->addSeries($categories,$series2);

$chart3 = $section->addChart('bar', $categories, $series1);
$chart3->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart3->addSeries($categories,$series2);

$chart4 = $section->addChart('column', $categories, $series1);
$chart4->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart4->addSeries($categories,$series2);

$chart5 = $section->addChart('area', $categories, $series1);
$chart5->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart5->addSeries($categories,$series2);

$chart6 = $section->addChart('scatter', $categories, $series1);
$chart6->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart6->addSeries($categories,$series2);

$chart7 = $section->addChart('radar', $categories, $series1);
$chart7->getStyle()->setWidth(Converter::inchToEmu(2.5))->setHeight(Converter::inchToEmu(2));
$chart7->addSeries($categories,$series2);
*/
/*
for ($datos_filas = 1; $datos_filas <= $total_filas; $datos_filas++) {
    $tabla_01->addRow();
    for ($cell = 1; $cell <= $total_columnas; $cell++) {

    	if($datos_filas == 1) {
    		$tabla_01->addCell(200)->addText(htmlspecialchars($nombre_columnas[$cell-1]));
    	} else {
    		$tabla_01->addCell(200)->addText(htmlspecialchars($nombre_celdas[$datos_filas]));
        }

    }
}
*/
// Espacio
$section->addTextBreak();
// Imagen
//$section->addImage('imagenes/imagen.jpg',array('width' => 600,'height' => 400,'wrappingStyle' => 'behind'));

//Guardando phpWord
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('01_documento_word.docx');
#$objWriter->save('php://output');
header("Content-Disposition: attachment; filename='01_documento_word.docx'");
echo file_get_contents('Documento01.docx');
?>
