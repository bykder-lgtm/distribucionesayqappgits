<?php
include_once('../conexiones/conexione.php');
date_default_timezone_set("America/Bogota");
/*
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
*/
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

require_once ('class_php/PHPWord/src/PhpWord/Autoloader.php');
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\TemplateProcessor;

$phpWordTemplated = new TemplateProcessor('../archivador/templates/docx/plantilla_firma_carta_word.docx');
//$phpWord = new PhpWord();
//$phpWordTemplated->setCreator("Luis Cabrera Benito");
//$phpWordTemplated->setTitle("Saltos");

$nombre                   = $propietario_nombres_apellidos_emp;
$direccion                = $direccion_emp;
$municipio                = $departamento_emp;
$provincia                = $localidad_emp;
$cp                       = "02541";
$telefono                 = $telefono_emp;

// --- Asignamos valores a la plantilla
$phpWordTemplated->setValue('nombre_empresa', $nombre);
$phpWordTemplated->setValue('direccion_empresa', $direccion);
$phpWordTemplated->setValue('municipio_empresa', $municipio);
$phpWordTemplated->setValue('provincia_empresa', $provincia);
$phpWordTemplated->setValue('cp_empresa', $cp);
$phpWordTemplated->setValue('telefono_empresa', $telefono);
$phpWordTemplated->setValue('nombre_firmante', $propietario_nombres_apellidos_emp);
$phpWordTemplated->setValue('reg_medico', $reg_medico_emp);
$phpWordTemplated->setValue('licencia_ocupacional', $licencia_emp);
//$phpWordTemplated->setImageValue('macroNameImage', '../imagenes/firma.jpg');
//$phpWordTemplated->setImg('macroNameImage', array('src' => '../imagenes/firma.jpg', 'swh'=>'200'));
//$phpWordTemplated->setImg('macroNameImage',array('src' => '../imagenes/firma.png','swh'=>'200', 'size'=>array(0=>$width, 1=>$height));
//$phpWordTemplated->setImage("macroNameImage", "../imagenes/firma.png", "log.png", 30, 30);
//$phpWordTemplated->replaceStrToImg('macroNameImage', $propietario_url_firma_emp);
//$phpWordTemplated->setImageValue('macroNameImage', $propietario_url_firma_emp);
//$phpWordTemplated->setImageValue('macroNameImage', array('path' => $propietario_url_firma_emp, 'width' => 100, 'height' => 100, 'ratio' => false));
//$phpWordTemplated->setImg('macroNameImage', array('src'  => $propietario_url_firma_emp,'size' => array( 102, 40 )));
// --- Guardamos el documento
$phpWordTemplated->saveAs('../archivador/archivador_office/formato_plantilla_carta_word_docx.docx');
header("Content-Disposition: attachment; filename=formato_plantilla_carta_word_docx.docx; charset=iso-8859-1");
echo file_get_contents('../archivador/archivador_office/formato_plantilla_carta_word_docx.docx');
?>