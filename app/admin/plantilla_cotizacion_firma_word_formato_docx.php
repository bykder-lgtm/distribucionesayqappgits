<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_dia_mes_anyo.php');
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
$nombre_propietario_emp                = $info_empresa_data['nombre_propietario'];
$cedula_propietario_emp                = $info_empresa_data['cedula_propietario'];
$especialidad_emp                      = $info_empresa_data['especialidad'];
$especialidad2_emp                     = $info_empresa_data['especialidad2'];
$universidad_emp                       = $info_empresa_data['universidad'];
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
$nombre_plantilla_word                 = 'plantilla_cotizacion_firma_carta_word.docx';

require_once ('class_php/PHPWord/src/PhpWord/Autoloader.php');
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\ListItem;

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$phpWordTemplated = $phpWord->loadTemplate('../archivador/templates/docx/'.$nombre_plantilla_word);
//$phpWordTemplated = new \PhpOffice\PhpWord\TemplateProcessor('../archivador/templates/docx/'.$nombre_plantilla_word);
//$phpWordTemplated = new TemplateProcessor('../archivador/templates/docx/'.$nombre_plantilla_word);
//$phpWord = new PhpWord();

//$phpWordTemplated->setCreator("Luis Cabrera Benito");
//$phpWordTemplated->setTitle("Saltos");

$fecha_actual                          = strtotime(date("Y-m-d"));
$mes_actual                            = fecha_en_espanol_mes($fecha_actual);
$dia_actual                            = fecha_en_espanol_dia($fecha_actual);
$anyo_actual                           = fecha_en_espanol_anyo($fecha_actual);
$nombre                                = $propietario_nombres_apellidos_emp;
$direccion                             = $direccion_emp;
$municipio                             = $departamento_emp;
$provincia                             = $localidad_emp;
$telefono                              = $telefono_emp;
$nombre_archivo_word                   = 'cotizacion_firma_carta_word.docx';
// --- Asignamos valores a la plantilla
$phpWordTemplated->setValue('nombre_propietario_emp', $nombre_propietario_emp);
$phpWordTemplated->setValue('especialidad_emp', $especialidad_emp);
$phpWordTemplated->setValue('universidad_emp', $universidad_emp);
$phpWordTemplated->setValue('licencia_emp', $licencia_emp);
$phpWordTemplated->setValue('departamento_emp', (ucwords(strtolower($departamento_emp))));
$phpWordTemplated->setValue('mes_actual', $mes_actual);
$phpWordTemplated->setValue('dia_actual', $dia_actual);
$phpWordTemplated->setValue('anyo_actual', $anyo_actual);
$phpWordTemplated->setValue('licencia_ocupacional', $licencia_emp);

$phpWordTemplated->setValue('nombre_propietario_firma_emp', $nombre_propietario_emp);
$phpWordTemplated->setValue('especialidad2', $especialidad2_emp);
$phpWordTemplated->setValue('cedula_propietario_emp', $cedula_propietario_emp);

$phpWordTemplated->setValue('direccion_emp', $direccion_emp);
$phpWordTemplated->setValue('telefono_emp', $telefono_emp);

$section_portada = $phpWord->addSection();
$header = $section_portada->addHeader();
$header->addImage('../imagenes/firma.jpg', array('width' => 600, 'height' => 48));

//$phpWordTemplated->setImageValue('firma_recibibe', '../imagenes/firma.jpg');
//$phpWordTemplated->replaceStrToImg('firma_recibibe', $propietario_url_firma_emp);
//$phpWordTemplated->setImageValue('firma_recibibe', $propietario_url_firma_emp);
//$phpWordTemplated->setImageValue('firma_recibibe', array('path' => $propietario_url_firma_emp, 'width' => 100, 'height' => 100, 'ratio' => false));
//$phpWordTemplated->setImg('firma_recibibe', array('src'  => $propietario_url_firma_emp,'size' => array( 102, 40 )));

# Para que no diga que se abre en modo de compatibilidad
//$phpWordTemplated->getCompatibility()->setOoxmlVersion(15);
# Idioma español de México
//$phpWordTemplated->getSettings()->setThemeFontLang(new Language("ES-MX"));
// --- Guardamos el documento

//header("Content-Description: File Transfer");
//header('Content-Disposition: attachment; filename="' . $nombre_archivo_word . '"');
//header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
//header('Content-Transfer-Encoding: binary');
//header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//header('Expires: 0');
//$phpWordTemplated->save("php://output");

$phpWordTemplated->saveAs('../archivador/archivador_office/'.$nombre_archivo_word);
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$nombre_archivo_word."; charset=iso-8859-1");
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

echo file_get_contents('../archivador/archivador_office/'.$nombre_archivo_word);
unlink('../archivador/archivador_office/'.$nombre_archivo_word);
?>