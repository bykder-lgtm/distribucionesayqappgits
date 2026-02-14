<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                                            = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                                   = $_SESSION['usuario'];
$cod_administrador_sesion                                 = $_SESSION['cod_administrador'];
$tipo_ajax                                                = addslashes($_REQUEST['tipo_ajax']);
$campo                                                    = addslashes($_REQUEST['campo']);
// ------------------------------------------------------------------------------------------------- //
$retorno_array                                            = array();
$retorno_array2                                           = array();
$codigoHTML_menu                                          = '';
$codigoHTML_menu_total_reg                                = '';
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_info_factura_venta') && ($tipo_ajax=='info_factura_venta')) {

	$cod_info_factura_venta                               = intval($_REQUEST['cod_info_factura_venta']); 
	$estructura_factura_fev_xml_remota                  = trim($_REQUEST['estructura_factura_fev_xml_remota']); 
	//-------------------------------------- -----------------------------------------------------------------//
	$obtener_info_fact = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
	$info_fact = mysqli_fetch_assoc($resultado_info_fact);

	$cod_factura                                          = $info_fact['cod_factura'];
	$fecha_anyo                                           = $info_fact['fecha_anyo'];
	$fecha_hora                                           = substr($info_fact['fecha_hora'], 0, 5);
	$total_precio_compra                                  = $info_fact['total_precio_compra'];
	$total_precio_venta                                   = $info_fact['total_precio_venta'];
	$cod_tercero                                          = $info_fact['cod_tercero'];
	$cuenta                                               = $info_fact['cuenta'];
	$cod_tipo_pago                                        = $info_fact['cod_tipo_pago'];
	$cod_administrador                                    = $info_fact['cod_administrador'];
	$cod_tipo_forma_pago                                  = $info_fact['cod_tipo_forma_pago'];
	$cod_resolucion_facturacion                           = $info_fact['cod_resolucion_facturacion'];
	$cod_caja_virtual                                     = $info_fact['cod_caja_virtual'];
	$dataico_xml_url                                      = $info_fact['dataico_xml_url'];
	$dataico_pdf_url                                      = $info_fact['dataico_pdf_url'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$cod_tipo_resolucion_facturacion                      = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
	$nombre_tipo_resolucion_facturacion                   = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	$numero_resolucion_facturacion                        = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
	$ini_resolucion_facturacion                           = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
	$fin_resolucion_facturacion                           = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
	$prefijo_resolucion_facturacion                       = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
	$fecha_resolucion_facturacion                         = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
	$vigencia_meses_resolucion_facturacion                = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
	$nombre_tipo_estado                                   = $matriz_resolucion_facturacion['nombre_tipo_estado'];

	$ruta_directorio_crear                                = "../archivador/";
	$nombre_carpeta_crear_global                          = 'FEVRIPS/';
	$nombre_carpeta_crear_factura                         = $prefijo_resolucion_facturacion.$cod_factura.'_'.$cod_info_factura_venta;
	$ruta_directorio_carpeta                              = $ruta_directorio_crear.$nombre_carpeta_crear_global;
	$ruta_directorio_carpeta_factura                      = $ruta_directorio_crear.$nombre_carpeta_crear_global.'/'.$nombre_carpeta_crear_factura;
	$nombre_archivo_factura_fev_xml_crear                 = 'XML_FE_'.$prefijo_resolucion_facturacion.$cod_factura.'_'.$cod_info_factura_venta.".xml";
	$nombre_archivo_factura_fev_pdf_crear                 = 'PDF_FE_'.$prefijo_resolucion_facturacion.$cod_factura.'_'.$cod_info_factura_venta.".pdf";
	//---------------------------------------------------------------------------------------------------------------------------------//
	$zip                                                  = new ZipArchive(); //Objeto de Libreria ZipArchive
	//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
	//$salida_ruta_nombre_zip                               = $ruta_directorio_carpeta.'.zip';
	$salida_ruta_nombre_zip                               = $ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.'.zip';

	if($zip->open($salida_ruta_nombre_zip, ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
		$zip->addFile($ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.'/'.$nombre_archivo_factura_fev_xml_crear); //Agregamos el archivo SQL a ZIP
		$zip->addFile($ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.'/'.$nombre_archivo_factura_fev_pdf_crear);
		//$zip->addFile($ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.$nombre_archivo_factura_fev_xml_crear, $ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.$nombre_archivo_factura_fev_pdf_crear);
		$zip->close(); //Cerramos el ZIP
		unlink($ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.'/'.$nombre_archivo_factura_fev_xml_crear);
  		unlink($ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura.'/'.$nombre_archivo_factura_fev_pdf_crear);
  		//deleteDirectory($ruta_directorio_crear.$nombre_carpeta_crear_global.$nombre_carpeta_crear_factura);

		//unlink($ruta_directorio_carpeta); //Eliminamos el archivo temporal SQL
		//header ("Location: $salida_ruta_nombre_zip"); // Redireccionamos para descargar el Arcivo ZIP
		$afectado = "SI";
	} else {
		$afectado = "NO";
	}

	header('Content-Type: application/json'); 
	
	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_venta'] = "".$cod_info_factura_venta;
	$datos_array['salida_ruta_nombre_zip'] = "".$salida_ruta_nombre_zip;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>