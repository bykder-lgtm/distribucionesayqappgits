<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
/*
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
*/
if (isset($_GET['cod_certificado_apoyo_emocional_codifcryp'])) { 

	$cod_certificado_apoyo_emocional_codifcryp                         = ($_GET['cod_certificado_apoyo_emocional_codifcryp']);
	$cod_certificado_apoyo_emocional_codif                             = DAXCODIFCRYPTOR::descriptardax($cod_certificado_apoyo_emocional_codifcryp);
	$cod_certificado_apoyo_emocional                                   = intval(DAXCODIFCRYPTOR::descodifdax($cod_certificado_apoyo_emocional_codif));

	$pagina_local                                                      = $_SERVER['PHP_SELF'];
	$fecha_hoy_time                                                    = strtotime(date("Y/m/d"));
	$fecha_hoy                                                         = time();
	$hora_impresion                                                    = date("H:i:s");
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
	$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
	$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

	$titulo_emp                                                        = $info_empresa_data['titulo'];
	$nombre_emp                                                        = $info_empresa_data['nombre'];
	$eslogan_emp                                                       = $info_empresa_data['eslogan'];
	$direccion_emp                                                     = $info_empresa_data['direccion'];
	$ciudad_emp                                                        = $info_empresa_data['ciudad'];
	$pais_emp                                                          = $info_empresa_data['pais'];
	$correo_emp                                                        = $info_empresa_data['correo'];
	$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
	$telefono_emp                                                      = $info_empresa_data['telefono'];
	$info_legal_emp                                                    = $info_empresa_data['info_legal'];
	$logotipo_emp                                                      = $info_empresa_data['logotipo'];
	$propietario_nombres_apellidos_emp                                 = $info_empresa_data['propietario_nombres_apellidos'];
	$propietario_nit_emp                                               = $info_empresa_data['propietario_nit'];
	$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
	$cabecera_emp                                                      = $info_empresa_data['cabecera'];
	$icono_emp                                                         = $info_empresa_data['icono'];
	$desarrollador_emp                                                 = $info_empresa_data['desarrollador'];
	$pag_desarrollador_emp                                             = $info_empresa_data['pag_desarrollador'];
	$anyo_emp                                                          = $info_empresa_data['anyo'];
	$url_pag                                                           = $info_empresa_data['url_pag'];
	$nombre_font                                                       = $info_empresa_data['nombre_font'];
	$res_emp                                                           = $info_empresa_data['res'];
	$res1_emp                                                          = $info_empresa_data['res1'];
	$res2_emp                                                          = $info_empresa_data['res2'];
	$departamento_emp                                                  = $info_empresa_data['departamento'];
	$localidad_emp                                                     = $info_empresa_data['localidad'];
	$reg_medico_emp                                                    = $info_empresa_data['reg_medico'];
	$regimen_emp                                                       = $info_empresa_data['regimen'];
	$version_emp                                                       = $info_empresa_data['version'];
	$propietario_url_firma_emp                                         = $info_empresa_data['propietario_url_firma'];
	$fecha_time_emp                                                    = $info_empresa_data['fecha_time'];
	$licencia_emp                                                      = $info_empresa_data['licencia'];
	$tamano_font_emp                                                   = $info_empresa_data['tamano_font'];
	$info_histclinic_emp                                               = $info_empresa_data['info_histclinic'];
	$info_aptlaboral_emp                                               = $info_empresa_data['info_aptlaboral'];
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cedula, tarjeta_profesional, cod_caja FROM tbl15_administrador WHERE (cuenta = '$cuenta_actual')";
	$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
	$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

	$usario_vendedor                                      = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
	$cedula                                               = $matriz_usario_vendedor['cedula'];
	$tarjeta_profesional                                  = $matriz_usario_vendedor['tarjeta_profesional'];
	$cod_caja                                             = $matriz_usario_vendedor['cod_caja'];
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	$sql_certificado_apoyo_emocional = "SELECT * FROM tbl15_certificado_apoyo_emocional WHERE (cod_certificado_apoyo_emocional = '$cod_certificado_apoyo_emocional')";
	$consulta_certificado_apoyo_emocional = mysqli_query($conectar, $sql_certificado_apoyo_emocional) or die(mysqli_error($conectar));
	$matriz_certificado_apoyo_emocional = mysqli_fetch_assoc($consulta_certificado_apoyo_emocional);

	$cod_certificado_apoyo_emocional                                             = $matriz_certificado_apoyo_emocional['cod_certificado_apoyo_emocional'];
	$nombre_certificado_apoyo_emocional                                          = $matriz_certificado_apoyo_emocional['nombre_certificado_apoyo_emocional'];
	$descripcion_certificado_apoyo_emocional                                     = $matriz_certificado_apoyo_emocional['descripcion_certificado_apoyo_emocional'];
	$estructura_todo_certificado_apoyo_emocional_esp                             = $matriz_certificado_apoyo_emocional['estructura_todo_certificado_apoyo_emocional_esp'];
	$estructura_todo_certificado_apoyo_emocional_eng                             = $matriz_certificado_apoyo_emocional['estructura_todo_certificado_apoyo_emocional_eng'];
	$estructura_titulo_certificado_apoyo_emocional_esp                           = $matriz_certificado_apoyo_emocional['estructura_titulo_certificado_apoyo_emocional_esp'];
	$estructura_profesional_certificado_apoyo_emocional_esp                      = $matriz_certificado_apoyo_emocional['estructura_profesional_certificado_apoyo_emocional_esp'];
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp            = $matriz_certificado_apoyo_emocional['estructura_propietario_diagnosti_certificado_apoyo_emocional_esp'];
	$estructura_justificacion_certificado_apoyo_emocional_esp                    = $matriz_certificado_apoyo_emocional['estructura_justificacion_certificado_apoyo_emocional_esp'];
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp                    = $matriz_certificado_apoyo_emocional['estructura_tabla_mascota_certificado_apoyo_emocional_esp'];
	$estructura_vigencia_certificado_apoyo_emocional_esp                         = $matriz_certificado_apoyo_emocional['estructura_vigencia_certificado_apoyo_emocional_esp'];
	$estructura_titulo_certificado_apoyo_emocional_eng                           = $matriz_certificado_apoyo_emocional['estructura_titulo_certificado_apoyo_emocional_eng'];
	$estructura_profesional_certificado_apoyo_emocional_eng                      = $matriz_certificado_apoyo_emocional['estructura_profesional_certificado_apoyo_emocional_eng'];
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng            = $matriz_certificado_apoyo_emocional['estructura_propietario_diagnosti_certificado_apoyo_emocional_eng'];
	$estructura_justificacion_certificado_apoyo_emocional_eng                    = $matriz_certificado_apoyo_emocional['estructura_justificacion_certificado_apoyo_emocional_eng'];
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng                    = $matriz_certificado_apoyo_emocional['estructura_tabla_mascota_certificado_apoyo_emocional_eng'];
	$estructura_vigencia_certificado_apoyo_emocional_eng                         = $matriz_certificado_apoyo_emocional['estructura_vigencia_certificado_apoyo_emocional_eng'];
	$nombre_mascota                                                              = $matriz_certificado_apoyo_emocional['nombre_mascota'];
	$edad_mascota                                                                = $matriz_certificado_apoyo_emocional['edad_mascota'];
	$unidad_medida_edad_mascota                                                  = $matriz_certificado_apoyo_emocional['unidad_medida_edad_mascota'];
	$nombre_raza_mascota                                                         = $matriz_certificado_apoyo_emocional['nombre_raza_mascota'];
	$color_mascota                                                               = $matriz_certificado_apoyo_emocional['color_mascota'];
	$peso_mascota                                                                = $matriz_certificado_apoyo_emocional['peso_mascota'];
	$unidad_medida_peso_mascota                                                  = $matriz_certificado_apoyo_emocional['unidad_medida_peso_mascota'];
	$talla_mascota                                                               = $matriz_certificado_apoyo_emocional['talla_mascota'];
	$nombre_propietario_mascota                                                  = $matriz_certificado_apoyo_emocional['nombre_propietario_mascota'];
	$documento_propietario_mascota                                               = $matriz_certificado_apoyo_emocional['documento_propietario_mascota'];
	$direccion_propietario_mascota                                               = $matriz_certificado_apoyo_emocional['direccion_propietario_mascota'];
	$correo_propietario_mascota                                                  = $matriz_certificado_apoyo_emocional['correo_propietario_mascota'];
	$fecha_certificado_apoyo_emocional                                           = $matriz_certificado_apoyo_emocional['fecha_certificado_apoyo_emocional'];
	$hora_certificado_apoyo_emocional                                            = $matriz_certificado_apoyo_emocional['hora_certificado_apoyo_emocional'];
	$fecha_creacion_certificado_apoyo_emocional                                  = $matriz_certificado_apoyo_emocional['fecha_creacion_certificado_apoyo_emocional'];
	$fecha_modificacion_certificado_apoyo_emocional                              = $matriz_certificado_apoyo_emocional['fecha_modificacion_certificado_apoyo_emocional'];
	$cuenta                                                                      = $matriz_certificado_apoyo_emocional['cuenta'];
	$cod_administrador                                                           = $matriz_certificado_apoyo_emocional['cod_administrador'];
	$cod_estado                                                                  = $matriz_certificado_apoyo_emocional['cod_estado'];
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	$nombres_completos                   = "CERTIFICADO DE APOYO EMOCIONAL-".$nombre_propietario_mascota.'_'.$nombre_mascota.'-'.$cod_certificado_apoyo_emocional;
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	include_once('mpdf/mpdf.php');
	$margen_izq                             = '10';
	$margen_der                             = '10';
	$margen_inf_encabezado                  = '85';
	$margen_sup_encabezado                  = '5';
	$posicion_sup_encabezado                = '5';
	$posicion_inf_encabezado                = '5';

	$titulo_doc_pdf                         = $nombre_propietario_mascota.'_'.$nombre_mascota.'-'.$cod_certificado_apoyo_emocional;
	$autor_doc_pdf                          = $nombre_propietario_mascota.'_'.$nombre_mascota.'-'.$cod_certificado_apoyo_emocional;
	$creador_doc_pdf                        = $nombre_propietario_mascota.'_'.$nombre_mascota.'-'.$cod_certificado_apoyo_emocional;
	$tema_doc_pdf                           = "CERTIFICADO DE APOYO EMOCIONAL";
	$palabras_claves_doc_pdf                = "CERTIFICADO DE APOYO EMOCIONAL";
	$cod_consentimiento_informado_strpad    = str_pad($cod_certificado_apoyo_emocional, 6, "0", STR_PAD_LEFT);
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	//$mpdf = new mPDF('c','Legal');
	$mpdf = new mPDF('c','Letter','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
	$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	$header = '
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:calibri;  font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
	  <tr>
	    <td width="100%" align="center"><img src="../imagenes/cabecera certificado apoyo emocional.png" /></td>
	  </tr>
	</table>
	';
	$headerE = '
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:calibri;  font-size:'.$tamano_font_manaliment_emp.'pt; width:100%">
	  <tr>
	    <td width="100%" align="center"><img src="../imagenes/cabecera certificado apoyo emocional.png" /></td>
	  </tr>
	</table>
	';
	$footer = '
	';
	$footerE = '
	';
	$mpdf->SetHTMLHeader(($header));
	$mpdf->SetHTMLHeader(($headerE),'E');
	$mpdf->SetHTMLFooter(($footer));
	$mpdf->SetHTMLFooter(($footerE),'E');

	$codigoHTML = '
	<!DOCTYPE html>
	<html lang="es">
	<head>
	<title></title>
	<meta charset="utf-8" />
	</head>

	<body>
	<style type="text/css"> 
	#centrar { margin-right:auto; margin-left:auto; width: 30%; } 
	.Estilo1 { color: #FF0000; font-weight: bold; }
	.Estilo2 {color: #FF0000}
	</style>

	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<br>
	'.$estructura_todo_certificado_apoyo_emocional_esp.'
	<br>
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:calibri; font-size:10pt; width:100%">
	  <tr>
	    <td><p><strong>Cordialmente</strong></p>
	    <div><img src="../imagenes/firma_jean.png" height="70px"/></div>
	    <div>_________________________________________ </div>
	        <p><strong>Jean Paulina Plaza Viellard</strong></p>
	        <p><strong>Cc: 50.760.399</strong></p>
	        <p><strong>Cel: 300 895906</strong></p>
	    </td>
	    <td><p><strong></strong></p>
	    <div></div>
	    <div></div>
	    <p><strong></strong></p></td>
	  </tr>
	</table>
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<div style="page-break-after: always"></div>
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<br>
	'.$estructura_todo_certificado_apoyo_emocional_eng.'
	<br>
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:calibri; font-size:10pt; width:100%">
	  <tr>
	    <td><p><strong>Cordially</strong></p>
	    <div><img src="../imagenes/firma_jean.png" height="70px"/></div>
	    <div>_________________________________________ </div>
	        <p><strong>Jean Paulina Plaza Viellard</strong></p>
	        <p><strong>Cc: 50.760.399</strong></p>
	        <p><strong>Cel: 300 895906</strong></p>
	    </td>
	    <td><p><strong></strong></p>
	    <div></div>
	    <div></div>
	    <p><strong></strong></p></td>
	  </tr>
	</table>

	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<div style="page-break-after: always"></div>
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->

	<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">
	  <tr>
	    <td style="text-align: center;"><img src="../imagenes/anexo_cedula_jean.png"/></td>
	  </tr>
	  <tr>
	    <td style="text-align: center;"><img src="../imagenes/anexo_tarjeta_profesional_jean.png"/></td>
	  </tr>
	</table>

	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	<!-- ***************************************************************************************************************************** -->
	</body>
	</html>
	';
	$mpdf->WriteHTML(($codigoHTML));
	$mpdf->SetTitle($titulo_doc_pdf);
	$mpdf->SetAuthor($autor_doc_pdf);
	$mpdf->SetCreator($autor_doc_pdf);
	$mpdf->SetSubject($tema_doc_pdf);
	$mpdf->SetKeywords($palabras_claves_doc_pdf);
	$ruta = '../pdfs/';
	$nombre_archivo = 'CERTIFICADO_DE_APOYO_EMOCIONAL'.'_'.$nombre_propietario_mascota.'_'.$nombre_mascota.'_'.$cod_certificado_apoyo_emocional.'.pdf';


	$mpdf->Output($nombre_archivo, 'I');
	exit;
	/*
	$mpdf->WriteHTML('<tocpagebreak sheet-size="A4-L" toc-sheet-size="A5" toc-preHTML="This ToC should print on an A5 sheet" />');
	$mpdf->WriteHTML('<tocentry content="A4 landscape" /><p>This page appears just after the ToC and should print on an A4 (landscape) sheet</p>');
	$mpdf->WriteHTML('<pagebreak sheet-size="A5-L" />');
	$mpdf->WriteHTML('<tocentry content="A5 landscape" /><p>This should print on an A5 (landscape) sheet</p>');
	$mpdf->WriteHTML('<pagebreak sheet-size="Letter" />');
	$mpdf->WriteHTML('<tocentry content="Letter portrait" /><p>This should print on an Letter sheet</p>');
	$mpdf->WriteHTML('<pagebreak sheet-size="150mm 150mm" />');
	$mpdf->WriteHTML('<tocentry content="150mm square" /><p>This should print on a sheet 150mm x 150mm</p>');
	$mpdf->WriteHTML('<pagebreak sheet-size="11.69in 8.27in" />');
	*/
}
?>
<?php ob_end_flush(); ?>