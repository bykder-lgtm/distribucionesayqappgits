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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                             = $_SESSION['usuario'];
$cod_administrador_sesion           = $_SESSION['cod_administrador'];
$tipo_ajax                          = addslashes($_REQUEST['tipo_ajax']);
$campo                              = addslashes($_REQUEST['campo']);
// ------------------------------------------------------------------------------------------------- //
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_info_factura_venta') && ($tipo_ajax=='tbl15_info_factura_venta')) {
	if (isset($_REQUEST['cod_estado_factura_electronica_enviado_dian'])) { $cod_estado_factura_electronica_enviado_dian = addslashes($_REQUEST['cod_estado_factura_electronica_enviado_dian']); } else { $cod_estado_factura_electronica_enviado_dian = ''; }
	if (isset($_REQUEST['cod_estado_factura_electronica_enviado_dataico'])) { $cod_estado_factura_electronica_enviado_dataico = addslashes($_REQUEST['cod_estado_factura_electronica_enviado_dataico']); } else { $cod_estado_factura_electronica_enviado_dataico = ''; }
	if (isset($_REQUEST['cod_factura_prefijo'])) { $cod_factura_prefijo = addslashes($_REQUEST['cod_factura_prefijo']); } else { $cod_factura_prefijo = ''; }
	if (isset($_REQUEST['prefijo_resolucion_facturacion'])) { $prefijo_resolucion_facturacion = addslashes($_REQUEST['prefijo_resolucion_facturacion']); } else { $prefijo_resolucion_facturacion = ''; }
	if (isset($_REQUEST['numero_resolucion_facturacion'])) { $numero_resolucion_facturacion = addslashes($_REQUEST['numero_resolucion_facturacion']); } else { $numero_resolucion_facturacion = ''; }

	if (isset($_REQUEST['cod_cufe'])) { $cod_cufe = addslashes($_REQUEST['cod_cufe']); } else { $cod_cufe = ''; }
	if (isset($_REQUEST['dataico_email_status'])) { $dataico_email_status = addslashes($_REQUEST['dataico_email_status']); } else { $dataico_email_status = ''; }
	if (isset($_REQUEST['dataico_uuid'])) { $dataico_uuid = addslashes($_REQUEST['dataico_uuid']); } else { $dataico_uuid = ''; }
	if (isset($_REQUEST['dataico_issue_date'])) { $dataico_issue_date = addslashes($_REQUEST['dataico_issue_date']); } else { $dataico_issue_date = ''; }
	if (isset($_REQUEST['dataico_payment_date'])) { $dataico_payment_date = addslashes($_REQUEST['dataico_payment_date']); } else { $dataico_payment_date = ''; }
	if (isset($_REQUEST['dataico_xml_url'])) { $dataico_xml_url = addslashes($_REQUEST['dataico_xml_url']); } else { $dataico_xml_url = ''; }
	if (isset($_REQUEST['dataico_customer_status'])) { $dataico_customer_status = addslashes($_REQUEST['dataico_customer_status']); } else { $dataico_customer_status = ''; }
	if (isset($_REQUEST['dataico_validation_date'])) { $dataico_validation_date = addslashes($_REQUEST['dataico_validation_date']); } else { $dataico_validation_date = ''; }
	if (isset($_REQUEST['dataico_qrcode'])) { $dataico_qrcode = addslashes($_REQUEST['dataico_qrcode']); } else { $dataico_qrcode = ''; }
	if (isset($_REQUEST['dataico_xml'])) { $dataico_xml = addslashes($_REQUEST['dataico_xml']); } else { $dataico_xml = ''; }
	if (isset($_REQUEST['dataico_invoice_type_code'])) { $dataico_invoice_type_code = addslashes($_REQUEST['dataico_invoice_type_code']); } else { $dataico_invoice_type_code = ''; }
	if (isset($_REQUEST['dataico_pdf_url'])) { $dataico_pdf_url = addslashes($_REQUEST['dataico_pdf_url']); } else { $dataico_pdf_url = ''; }
	if (isset($_REQUEST['dataico_dian_status'])) { $dataico_dian_status = addslashes($_REQUEST['dataico_dian_status']); } else { $dataico_dian_status = ''; }
	if (isset($_REQUEST['dataico_dian_error'])) { $dataico_dian_error = addslashes($_REQUEST['dataico_dian_error']); } else { $dataico_dian_error = ''; }
	if (isset($_REQUEST['dataico_dian_path'])) { $dataico_dian_path = addslashes($_REQUEST['dataico_dian_path']); } else { $dataico_dian_path = ''; }

	if (isset($_REQUEST['dataico_dian_messages'])) { 
		$dataico_dian_messages0 = addslashes($_REQUEST['dataico_dian_messages']); 
		$dataico_dian_messages1 = str_replace("'", " PULG ", $dataico_dian_messages0);
		$dataico_dian_messages2 = str_replace(",", ".", $dataico_dian_messages1);
		$dataico_dian_messages3 = str_replace("#", " NO ", $dataico_dian_messages2);
		$dataico_dian_messages4 = str_replace("%", " PTJ ", $dataico_dian_messages3);
		$dataico_dian_messages = trim(str_replace('"', " PULG ", $dataico_dian_messages4));
	} else { 
		$dataico_dian_messages = ''; 
	}

	$explode_factura                                 = explode($prefijo_resolucion_facturacion, $cod_factura_prefijo);
	$cod_factura                                     = $explode_factura[1];

    $sql_resolucion_facturacion = "SELECT cod_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (numero_resolucion_facturacion = '$numero_resolucion_facturacion') AND (prefijo_resolucion_facturacion = '$prefijo_resolucion_facturacion')";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
    $datos_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $cod_resolucion_facturacion                      = $datos_resolucion_facturacion['cod_resolucion_facturacion'];

    $sql_info_factura_venta = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion') AND (cod_factura = '$cod_factura')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_info_factura_venta                      = $datos_info_factura_venta['cod_info_factura_venta'];

	$tiempo_final                                = microtime(true);
	$tiempo_ejecucion_dian_dataico               = $tiempo_final - $tiempo_inicial;

	$data_sql = ("UPDATE tbl15_info_factura_venta SET cod_estado_factura_electronica_enviado_dian = '$cod_estado_factura_electronica_enviado_dian', 
	cod_estado_factura_electronica_enviado_dataico = '$cod_estado_factura_electronica_enviado_dataico', cod_cufe = '$cod_cufe', dataico_email_status = '$dataico_email_status', 
	dataico_uuid = '$dataico_uuid', dataico_issue_date = '$dataico_issue_date', dataico_dian_messages = '$dataico_dian_messages', dataico_payment_date = '$dataico_payment_date', 
	dataico_xml_url = '$dataico_xml_url', dataico_customer_status = '$dataico_customer_status', dataico_validation_date = '$dataico_validation_date', dataico_qrcode = '$dataico_qrcode', 
	dataico_xml = '$dataico_xml', dataico_invoice_type_code = '$dataico_invoice_type_code', dataico_pdf_url = '$dataico_pdf_url', dataico_dian_status = '$dataico_dian_status', 
	tiempo_ejecucion_dian_dataico = '$tiempo_ejecucion_dian_dataico' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if ($cod_estado_factura_electronica_enviado_dian == '1') { $resultado_envio_dian = 'Enviado a la Dian'; } else { $resultado_envio_dian = 'No Enviado a la Dian'; }
	if ($cod_estado_factura_electronica_enviado_dataico == '1') { $resultado_envio_dataico = 'Enviado Dataico'; } else { $resultado_envio_dataico = 'No Enviado a Dataico'; }

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json'); 

	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_venta'] = "".$cod_info_factura_venta;
	$datos_array['cod_factura'] = "".$cod_factura;
	$datos_array['cod_estado_factura_electronica_enviado_dian'] = "".$cod_estado_factura_electronica_enviado_dian;
	$datos_array['cod_estado_factura_electronica_enviado_dataico'] = "".$cod_estado_factura_electronica_enviado_dataico;
	$datos_array['resultado_envio_dian'] = "".$resultado_envio_dian;
	$datos_array['resultado_envio_dataico'] = "".$resultado_envio_dataico;
	$datos_array['cod_factura_prefijo'] = "".$cod_factura_prefijo;
	$datos_array['prefijo_resolucion_facturacion'] = "".$prefijo_resolucion_facturacion;
	$datos_array['numero_resolucion_facturacion'] = "".$numero_resolucion_facturacion;
	$datos_array['cod_cufe'] = "".$cod_cufe;
	$datos_array['dataico_email_status'] = "".$dataico_email_status;
	$datos_array['dataico_uuid'] = "".$dataico_uuid;
	$datos_array['dataico_issue_date'] = "".$dataico_issue_date;
	$datos_array['dataico_dian_messages'] = "".$dataico_dian_messages;
	$datos_array['dataico_payment_date'] = "".$dataico_payment_date;
	$datos_array['dataico_xml_url'] = "".$dataico_xml_url;
	$datos_array['dataico_customer_status'] = "".$dataico_customer_status;
	$datos_array['dataico_validation_date'] = "".$dataico_validation_date;
	$datos_array['dataico_qrcode'] = "".$dataico_qrcode;
	$datos_array['dataico_xml'] = "".$dataico_xml;
	$datos_array['dataico_invoice_type_code'] = "".$dataico_invoice_type_code;
	$datos_array['dataico_pdf_url'] = "".$dataico_pdf_url;
	$datos_array['dataico_dian_status'] = "".$dataico_dian_status;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>