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
$cuenta_actual                             = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$envio_dian_usuario                        = $_SESSION['usuario'];

$sql_infos_empresas = "SELECT dataico_entorno_desarrollo_api_global, dataico_account_id_api_global, dataico_auth_token_api_global, 
dataico_tipo_factura_api_global, dataico_send_dian_api_global, dataico_send_email_api_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$dataico_entorno_desarrollo_api_global       = $info_empresa_data['dataico_entorno_desarrollo_api_global'];
$dataico_account_id_api_global               = $info_empresa_data['dataico_account_id_api_global'];
$dataico_auth_token_api_global               = $info_empresa_data['dataico_auth_token_api_global'];
$dataico_tipo_factura_api_global             = $info_empresa_data['dataico_tipo_factura_api_global'];
$dataico_send_dian_api_global                = $info_empresa_data['dataico_send_dian_api_global'];
$dataico_send_email_api_global               = $info_empresa_data['dataico_send_email_api_global'];

if (isset($_REQUEST['cod_info_factura_compra'])) {

	$cod_info_factura_compra                  = intval($_REQUEST['cod_info_factura_compra']);
	$respuesta_json                          = "";
	//$tab                       		       = $_REQUEST['tab'];
	//$campo                     		       = $_REQUEST['campo'];
	//$tipo                      		       = $_REQUEST['tipo'];
	$envio_dian                  		     = 1;
	$envio_dian_fecha_ymdhis     		     = date("Y/m/d H:i:s");
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$headers = [ 'Content-Type: application/json', 'Auth-token: '.$dataico_auth_token_api_global ];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_sql = "SELECT fecha_anyo, cod_factura, cod_tipo_forma_pago, cod_tercero, cod_tipo_pago, observacion, cod_resolucion_facturacion, cod_factura_doc_soporte
	FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_factura                             = $matriz_consulta['cod_factura'];
	$cod_factura_doc_soporte                 = $matriz_consulta['cod_factura_doc_soporte'];
	$cod_tipo_forma_pago                     = $matriz_consulta['cod_tipo_forma_pago'];
	$cod_tercero                             = $matriz_consulta['cod_tercero'];
	$cod_tipo_pago                           = $matriz_consulta['cod_tipo_pago'];
	$observacion                             = $matriz_consulta['observacion'];
	$cod_resolucion_facturacion              = $matriz_consulta['cod_resolucion_facturacion'];
	$fecha_anyo                              = date("d/m/Y", strtotime($matriz_consulta['fecha_anyo']));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_forma_pago = "SELECT nombre_tipo_forma_pago, nombre_tipo_forma_pago2 FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
	$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
	$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

	$nombre_tipo_forma_pago          = $datos_forma_pago['nombre_tipo_forma_pago'];
	$nombre_tipo_forma_pago2         = $datos_forma_pago['nombre_tipo_forma_pago2'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_tercero = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$consulta_tercero = mysqli_query($conectar, $mostrar_datos_tercero) or die(mysqli_error($conectar));
	$matriz_consulta_tercero = mysqli_fetch_assoc($consulta_tercero);

	$nombre_tipo_tercero                     = $matriz_consulta_tercero['nombre_tipo_tercero'];
	$nombre_tipo_identificacion              = $matriz_consulta_tercero['nombre_tipo_identificacion'];
	$identificacion_tercero                  = $matriz_consulta_tercero['identificacion_tercero'];
	$digito_tercero                          = $matriz_consulta_tercero['digito_tercero'];
	$nombre1_tercero                         = trim($matriz_consulta_tercero['nombre1_tercero']);
	$nombre2_tercero                         = trim($matriz_consulta_tercero['nombre2_tercero']);
	$apellido1_tercero                       = trim($matriz_consulta_tercero['apellido1_tercero']);
	$apellido2_tercero                       = trim($matriz_consulta_tercero['apellido2_tercero']);
	$direccion_tercero                       = $matriz_consulta_tercero['direccion_tercero'];
	$telefono1_tercero                       = $matriz_consulta_tercero['telefono1_tercero'];
	$telefono2_tercero                       = $matriz_consulta_tercero['telefono2_tercero'];
	$correo_tercero                          = $matriz_consulta_tercero['correo_tercero'];
	$nombre_pais                             = $matriz_consulta_tercero['nombre_pais'];
	$nombre_departamento                     = $matriz_consulta_tercero['nombre_departamento'];
	$nombre_ciudad                           = $matriz_consulta_tercero['nombre_ciudad'];
	$nombre_tipo_cliente                     = $matriz_consulta_tercero['nombre_tipo_cliente'];
	$nombre_tipo_regimen                     = $matriz_consulta_tercero['nombre_tipo_regimen'];
	$nombre_tipo_impuesto                    = $matriz_consulta_tercero['nombre_tipo_impuesto'];
	$nombres_tercero                         = trim($nombre1_tercero.' '.$nombre2_tercero);
	$apellidos_tercero                       = trim($apellido1_tercero.' '.$apellido2_tercero);
	$nombre_cliente_concat                   = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero);
	$cod_pais                                = $matriz_consulta_tercero['cod_pais'];
	$cod_departamento                        = $matriz_consulta_tercero['cod_departamento'];
	$cod_municipio                           = $matriz_consulta_tercero['cod_municipio'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_pais = "SELECT nombre_pais_abrev FROM tbl15_pais WHERE cod_pais = '".($cod_pais)."'";
	$consultar_pais = mysqli_query($conectar, $obtener_pais) or die(mysqli_error($conectar));
	$info_pais = mysqli_fetch_assoc($consultar_pais);

	$nombre_pais_abrev                       = $info_pais['nombre_pais_abrev'];
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_departamento = "SELECT * FROM tbl15_departamento WHERE cod_departamento = '".($cod_departamento)."'";
	$consultar_departamento = mysqli_query($conectar, $obtener_departamento) or die(mysqli_error($conectar));
	$info_departamento = mysqli_fetch_assoc($consultar_departamento);

	$nombre_departamento                     = $info_departamento['nombre_departamento'];
	$codigo_departamento                     = $info_departamento['codigo_departamento'];
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_municipio = "SELECT * FROM tbl15_municipio WHERE cod_municipio = '".($cod_municipio)."'";
	$consultar_municipio = mysqli_query($conectar, $obtener_municipio) or die(mysqli_error($conectar));
	$info_municipio = mysqli_fetch_assoc($consultar_municipio);

	$nombre_municipio                        = $info_municipio['nombre_municipio'];
	$nombre_ciudad                           = $nombre_municipio;
	$codigo_municipio                        = $info_municipio['codigo_municipio'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	if ($nombre_pais == 'COLOMBIA') { $nombre_pais = "CO"; } else { $nombre_pais = $nombre_pais; }
	if ($direccion_tercero == '') { $direccion_tercero = 'SAN PELAYO'; } else { $direccion_tercero = $direccion_tercero; }
	if ($telefono1_tercero == '') { $telefono1_tercero = '11111111'; } else { $telefono1_tercero = $telefono1_tercero; }
	if ($nombre_ciudad == '') { $nombre_ciudad = 'SAN PELAYO'; } else { $nombre_ciudad = $nombre_ciudad; }
	if ($correo_tercero == '') { $correo_tercero = 'sincorreo@gmail.com'; } else { $correo_tercero = $correo_tercero; }
	if ($cod_tipo_pago == 1) { $tipo_medio_pago = "DEBITO"; } else { $tipo_medio_pago = "CREDITO"; }
	if ($observacion == '') { $observacion = "SIN OBSERVACIONES"; } else { $observacion = $observacion; }
	if ($nombre_tipo_cliente == 'PERSONA_NATURAL') { $nombre_cliente_concat = ""; } else { $nombre_cliente_concat = $nombre_cliente_concat; $nombres_tercero = ''; $apellidos_tercero = ''; }
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$numero_resolucion_facturacion           = $matriz_consulta_resolucion_facturacion['numero_resolucion_facturacion'];
	$prefijo_resolucion_facturacion          = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
	//$datos_json = '';
	//$datos_json .= '	{ ';
	//$datos_json .= '		"actions": { ';
	//$datos_json .= '   		 	"send_dian": ' .$dataico_send_dian_api_global. ', ';
	//$datos_json .= '   		 	"send_email": ' .$dataico_send_email_api_global. '';
	//$datos_json .= '		}, ';

	$datos_json = '';
	$datos_json .= '	{ ';
	$datos_json .= '		"support_doc": { ';
	$datos_json .= '			"env": "' .$dataico_entorno_desarrollo_api_global. '", ';
	$datos_json .= '   		 	"send_dian": ' .$dataico_send_dian_api_global. ', ';
	$datos_json .= '   		 	"send_email": ' .$dataico_send_email_api_global. ', ';
	$datos_json .= '			"issue_date": "' .$fecha_anyo. '", ';
	$datos_json .= '			"payment_date": "' .$fecha_anyo. '", ';
	$datos_json .= '			"resident_type": "RESIDENTE", ';
	$datos_json .= '			"generation_type": "POR_OPERACION", ';
	$datos_json .= '			"order_reference": "", ';
	$datos_json .= '			"payment_means": "' .$nombre_tipo_forma_pago2. '", ';
	$datos_json .= '			"currency": "COP", ';
	$datos_json .= '			"notes": [';
	$datos_json .= '"Notas u observaciones"';
	$datos_json .= '			 ], ';

	//$datos_json .= '			"number": "' .$cod_factura. '", ';
	//$datos_json .= '			"dataico_account_id": "' .$dataico_account_id_api_global. '", ';
	//$datos_json .= '			"invoice_type_code": "' .$dataico_tipo_factura_api_global. '", ';
	//$datos_json .= '			"payment_means_type": "' .$tipo_medio_pago. '", ';
	//$datos_json .= '			"numbering": { ';
	//$datos_json .= '				"resolution_number": "' .$numero_resolucion_facturacion. '", ';
	//$datos_json .= '				"prefix": "' .$prefijo_resolucion_facturacion. '", ';
	//$datos_json .= '				"flexible": true ';
	//$datos_json .= '			}, ';

	$datos_json .= '			"customer": { ';
	$datos_json .= '				"department": "' .$codigo_departamento. '", ';
	$datos_json .= '				"address_line": "' .$direccion_tercero. '", ';
	$datos_json .= '				"party_type": "' .$nombre_tipo_cliente. '", ';
	$datos_json .= '				"city": "' .$codigo_municipio. '", ';
	$datos_json .= '				"tax_level_code": "' .$nombre_tipo_impuesto. '", ';
	$datos_json .= '				"email": "' .$correo_tercero. '", ';
	$datos_json .= '				"country_code": "' .$nombre_pais_abrev. '", ';
	$datos_json .= '				"first_name": "' .$nombres_tercero. '", ';
	$datos_json .= '				"phone": "' .$telefono1_tercero. '", ';
	$datos_json .= '				"party_identification_type": "' .$nombre_tipo_identificacion. '", ';
	$datos_json .= '				"company_name": "' .$nombre_cliente_concat. '", ';
	$datos_json .= '				"family_name": "' .$apellidos_tercero. '", ';
	$datos_json .= '				"regimen": "' .$nombre_tipo_regimen. '", ';
	$datos_json .= '				"party_identification": "' .$identificacion_tercero. '" ';
	$datos_json .= ' 			}, ';

	$datos_json .= '			"items": [ ';

	$incremental                         = 0;

	$sql = "SELECT cod_factura_compra_producto, cod_producto_barra, nombre_producto, und_compra, precio_compra_producto, total_compra_producto, iva_ptj	
	FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta = mysqli_query($conectar, $sql);
	$total = mysqli_num_rows($consulta);
	while ($datos = mysqli_fetch_assoc($consulta)) {

		$cod_factura_compra_producto     = $datos['cod_factura_compra_producto'];
		$cod_producto_barra              = $datos['cod_producto_barra'];
		$nombre_producto                 = $datos['nombre_producto'];
		$und_compra                       = $datos['und_compra'];
		$precio_compra_producto          = $datos['precio_compra_producto'];
		$iva_ptj                         = $datos['iva_ptj'];
		$incremental++;


		if ($total <> $incremental) {
			$datos_json .= ' 		{ ';
			$datos_json .= '			"sku": "' .$cod_producto_barra. '", ';
			$datos_json .= '			"quantity": ' .$und_compra. ', ';
			$datos_json .= '			"description": "' .$nombre_producto. '", ';
			$datos_json .= '			"measuring_unit": "94", ';
			$datos_json .= '			"price": ' .$precio_compra_producto. ', ';

			$datos_json .= '			"taxes": [';
			$datos_json .= ' 				{ ';
			$datos_json .= '   	 				"tax_category": "IVA", ';
			$datos_json .= '   		 			"tax_rate": ' .$iva_ptj. ', ';
			$datos_json .= '   		 			"tax_amount": 0';
			$datos_json .= ' 				} ';
			$datos_json .= ' 			] ';
			$datos_json .= ' 		}, ';
		} else {
			$datos_json .= ' 		{ ';
			$datos_json .= '			"sku": "' .$cod_producto_barra. '", ';
			$datos_json .= '			"quantity": ' .$und_compra. ', ';
			$datos_json .= '			"description": "' .$nombre_producto. '", ';
			$datos_json .= '			"price": ' .$precio_compra_producto. ', ';

			$datos_json .= '			"taxes": [';
			$datos_json .= ' 				{ ';
			$datos_json .= '   	 				"tax_category": "IVA", ';
			$datos_json .= '   		 			"tax_rate": ' .$iva_ptj. ', ';
			$datos_json .= '   		 			"tax_amount": 0';
			$datos_json .= ' 				} ';
			$datos_json .= ' 			] ';
			$datos_json .= ' 		} ';
		}
	}
			$datos_json .= ' 	], ';

			$datos_json .= '	"payment_means_type": "' .$tipo_medio_pago. '", ';

			//$datos_json .= '	"retentions": [';
			//$datos_json .= ' 		{ ';
			//$datos_json .= '   	 		"tax_category": "RET_FUENTE", ';
			//$datos_json .= '   			"tax_rate": 0, ';
			//$datos_json .= '   		 	"tax_amount": 0, ';
			//$datos_json .= '   		 	"base_amount": 0';
			//$datos_json .= ' 		} ';
			//$datos_json .= ' 	], ';

			$datos_json .= '	"number": "' .$cod_factura_doc_soporte. '", ';
			$datos_json .= '	"numbering": { ';
			$datos_json .= '		"resolution_number": "' .$numero_resolucion_facturacion. '", ';
			$datos_json .= '		"prefix": "' .$prefijo_resolucion_facturacion. '" ';
			$datos_json .= '	} ';

	$datos_json .= '		} ';
	$datos_json .= '	} ';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$directorio_certificado_seguridad        = dirname(__FILE__);
	$nombre_archivo_certificado_seguridad    = "cacert.pem";
	$ruta_certificado_seguridad_comilla      = $directorio_certificado_seguridad.'\"'.$nombre_archivo_certificado_seguridad;
	$ruta_certificado_seguridad              = str_replace('"', '', $ruta_certificado_seguridad_comilla);
	$url_enviar_datos_dataico                = "https://api.dataico.com/direct/dataico_api/v2/support_docs";


	$curl = curl_init($url_enviar_datos_dataico);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE); 
	curl_setopt($curl, CURLOPT_CAINFO, $ruta_certificado_seguridad);
	//curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
	//curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); 

	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $datos_json);

	$respuesta_json = curl_exec($curl);
	$estado_peticion = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	//if ( $estado_peticion != 201 ) { die ("Respuesta: $respuesta_json"); }
	curl_close($curl);
	$respuesta_peticion = json_decode($respuesta_json, true);

	//if ( $estado_peticion != 201 ) { die ("Respuesta: $respuesta_json"); }
	//if ( $estado_peticion != 201 ) { die("Error: al llamar la URL $url_enviar_datos_dataico. Fallo con el estado $estado_peticion. Respuesta: $respuesta_json. Error curl: ".curl_error($curl)); }
	//if ($estado_peticion != 201) { die("Error: llamada a URL $url_enviar_datos_dataico falló con el estado $estado_peticion"); } else { die("Factura enviada correctamente"); }
	//if ( $estado_peticion != 201 ) { die($respuesta_json); }
	//if ( $estado_peticion == 201 ) { die("$respuesta_json"); }
	//elseif ( $estado_peticion == 400 ) { die("$respuesta_json "."Erro de serv"); }

	header('Content-Type: application/json');
	//echo ($datos_json);
	echo ($respuesta_json);
}
?>