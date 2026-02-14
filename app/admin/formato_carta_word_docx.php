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
$phpWord = new PhpWord();

$phpWord->addParagraphStyle('multipleTab',array('tabs' => array(new\PhpOffice\PhpWord\Style\Tab('left', 1550),new\PhpOffice\PhpWord\Style\Tab('center', 3200),new \PhpOffice\PhpWord\Style\Tab('right', 5300),)),array('name' => 'Arial', 'size' => '12', 'bold' => 'true'), array('alignment' => 'center'));
$phpWord->addParagraphStyle('texto_derecha',array('tabs' => array(new\PhpOffice\PhpWord\Style\Tab('right', 9090))),array('name' => 'Arial', 'size' => '12', 'bold' => 'true'), array('alignment' => 'center'));
$phpWord->addParagraphStyle('texto_centrado',array('tabs' => array(new\PhpOffice\PhpWord\Style\Tab('center', 4680))),array('name' => 'Arial', 'size' => '12', 'bold' => 'true'), array('alignment' => 'center'));
$phpWord->addParagraphStyle('texto_justificado', array('align' => 'justify', 'spaceAfter' => 100));
//------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------//
$section_portada = $phpWord->addSection();
$marca_agua = $section_portada->addHeader();
$marca_agua->addWatermark('../imagenes/marca_agua.png', array('marginTop' => 100, 'marginLeft' => 100));
//------------------------------------------------------------------------------------------------------//
$header = $section_portada->addHeader();
$header->addImage('../imagenes/logo_superior_pdf_imprimir.png', array('width' => 600, 'height' => 48));
//------------------------------------------------------------------------------------------------------//
$firma_footer = $section_portada->addFooter();
$firma_footer->addImage($propietario_url_firma_emp, array('width' => 200, 'height' => 60));
$firma_footer->addText(htmlspecialchars("______________________________"), null, 'texto_centrado');
$firma_footer->addText(htmlspecialchars($propietario_nombres_apellidos_emp), null, 'texto_centrado');
$firma_footer->addText(htmlspecialchars("Reg. Médico: ".$reg_medico_emp), null, 'texto_centrado');
$firma_footer->addText(htmlspecialchars("Licencia Salud Ocupacional: ".$licencia_emp), null, 'texto_centrado');
//------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------//
//Guardando phpWord
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('01_formato_carta_word_docx.docx');
#$objWriter->save('php://output');
header("Content-Disposition: attachment; filename='01_formato_carta_word_docx.docx'");
echo file_get_contents('Documento01.docx');
?>
