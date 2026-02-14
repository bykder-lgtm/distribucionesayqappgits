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
$invoice_issue_date                        = date("d/m/Y");
//$tab                       		       = $_REQUEST['tab'];
//$campo                     		       = $_REQUEST['campo'];
//$tipo                      		       = $_REQUEST['tipo'];

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

if (isset($_REQUEST['cod_info_factura_venta'])) {

	$cod_info_factura_venta                  = intval($_REQUEST['cod_info_factura_venta']);
	$respuesta_json                          = "";
	$envio_dian                  		     = 1;
	$envio_dian_fecha_ymdhis     		     = date("Y/m/d H:i:s");
	$fecha_nota_debito                      = date("d/m/Y");
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$headers = [ 'Content-Type: application/json', 'Auth-token: '.$dataico_auth_token_api_global ];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_sql = "SELECT fecha_anyo, cod_factura, cod_tipo_forma_pago, descuento_ptj, cod_tercero, cod_tipo_pago, observacion, cod_resolucion_facturacion, cod_cufe 
	FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_factura                             = $matriz_consulta['cod_factura'];
	$cod_tipo_forma_pago                     = $matriz_consulta['cod_tipo_forma_pago'];
	$descuento_ptj                           = $matriz_consulta['descuento_ptj'];
	$cod_tercero                             = $matriz_consulta['cod_tercero'];
	$cod_tipo_pago                           = $matriz_consulta['cod_tipo_pago'];
	$observacion                             = $matriz_consulta['observacion'];
	$cod_resolucion_facturacion              = $matriz_consulta['cod_resolucion_facturacion'];
	$cod_cufe                                = $matriz_consulta['cod_cufe'];
	$fecha_anyo                              = date("d/m/Y", strtotime($matriz_consulta['fecha_anyo']));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_forma_pago = "SELECT nombre_tipo_forma_pago, nombre_tipo_forma_pago2 FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
	$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
	$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

	$nombre_tipo_forma_pago                  = $datos_forma_pago['nombre_tipo_forma_pago'];
	$nombre_tipo_forma_pago2                 = $datos_forma_pago['nombre_tipo_forma_pago2'];
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
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_municipio = "SELECT * FROM tbl15_municipio WHERE cod_municipio = '".($cod_municipio)."'";
	$consultar_municipio = mysqli_query($conectar, $obtener_municipio) or die(mysqli_error($conectar));
	$info_municipio = mysqli_fetch_assoc($consultar_municipio);

	$nombre_municipio                        = $info_municipio['nombre_municipio'];
	$nombre_ciudad                           = $nombre_municipio;
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	if ($nombre_pais == 'COLOMBIA') { $nombre_pais = "CO"; } else { $nombre_pais = $nombre_pais; }
	if ($descuento_ptj == 0) { $descuento_ptj = ""; } else { $descuento_ptj = $descuento_ptj; }
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
	$mostrar_datos_resolucion_nota_debito = "SELECT * FROM tbl15_resolucion_facturacion WHERE nombre_tipo_resolucion_facturacion = 'NOTA CREDITO'";
	$consulta_resolucion_nota_debito = mysqli_query($conectar, $mostrar_datos_resolucion_nota_debito) or die(mysqli_error($conectar));
	$matriz_consulta_resolucion_nota_debito = mysqli_fetch_assoc($consulta_resolucion_nota_debito);

	$numero_resolucion_facturacion           = $matriz_consulta_resolucion_nota_debito['numero_resolucion_facturacion'];
	$prefijo_nota_debito                    = $matriz_consulta_resolucion_nota_debito['prefijo_resolucion_facturacion'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_nota_debito = "SELECT MAX(cod_factura_nota_debito) cod_factura_nota_debito FROM tbl15_info_nota_debito WHERE (prefijo_nota_debito = '$prefijo_nota_debito')";
	$consulta_nota_debito = mysqli_query($conectar, $mostrar_nota_debito) or die(mysqli_error($conectar));
	$matriz_nota_debito = mysqli_fetch_assoc($consulta_nota_debito);

	$cod_factura_nota_debito                = $matriz_nota_debito['cod_factura_nota_debito'] + 1;
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$datos_json = '';
	$datos_json .= '	{ ';
	$datos_json .= '		"actions": { ';
	$datos_json .= '   		 	"send_dian": ' .$dataico_send_dian_api_global. ', ';
	$datos_json .= '   		 	"send_email": ' .$dataico_send_email_api_global. '';
	$datos_json .= '		}, ';

	$datos_json .= '		"credit_note": { ';
	$datos_json .= '			"env": "' .$dataico_entorno_desarrollo_api_global. '", ';
	$datos_json .= '			"number": "' .$cod_factura_nota_debito. '", ';
	$datos_json .= '			"issue_date": "' .$fecha_nota_debito. '", ';
	$datos_json .= '			"dataico_account_id": "' .$dataico_account_id_api_global. '", ';
	$datos_json .= '			"invoice_cufe": "' .$cod_cufe. '", ';
	$datos_json .= '			"invoice_number": "' .$prefijo_resolucion_facturacion.$cod_factura. '", ';
	$datos_json .= '			"invoice_issue_date": "' .$invoice_issue_date. '", ';
	$datos_json .= '			"reason": "ANULACION", ';

	$datos_json .= '			"numbering": { ';
	$datos_json .= '				"prefix": "' .$prefijo_nota_debito. '", ';
	$datos_json .= '				"flexible": false ';
	$datos_json .= '			}, ';

	$datos_json .= '			"customer": { ';
	$datos_json .= '				"party_identification_type": "' .$nombre_tipo_identificacion. '", ';
	$datos_json .= '				"party_identification": "' .$identificacion_tercero. '", ';
	$datos_json .= '				"party_type": "' .$nombre_tipo_cliente. '", ';
	$datos_json .= '				"tax_level_code": "' .$nombre_tipo_impuesto. '", ';
	$datos_json .= '				"regimen": "' .$nombre_tipo_regimen. '", ';
	$datos_json .= '				"company_name": "' .$nombre_cliente_concat. '", ';
	$datos_json .= '				"first_name": "' .$nombres_tercero. '", ';
	$datos_json .= '				"family_name": "' .$apellidos_tercero. '", ';
	//$datos_json .= '				"department": "' .$cod_departamento. '", ';
	//$datos_json .= '				"city": "' .$cod_municipio. '", ';
	//$datos_json .= '				"address_line": "' .$direccion_tercero. '", ';
	//$datos_json .= '				"country_code": "' .$nombre_pais_abrev. '", ';
	$datos_json .= '				"email": "' .$correo_tercero. '", ';
	$datos_json .= '				"phone": "' .$telefono1_tercero. '" ';
	$datos_json .= ' 			}, ';

	$datos_json .= '			"items": [ ';

	$incremental                         = 0;

	$sql = "SELECT cod_venta_producto, cod_producto_barra, nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_venta_producto, 
	total_venta_producto, fecha_ymd_venta_producto, descuento_ptj, iva_ptj, ptj_imp_consumo, ptj_ret_iva, ptj_ret_ica, ptj_ret_fuente, ptj_ipc, precio_ipc_total, 
	precio_ipc, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_moneda, nombre_tipo_unidad_medida 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta = mysqli_query($conectar, $sql);
	$total = mysqli_num_rows($consulta);
	while ($datos = mysqli_fetch_assoc($consulta)) {

		$cod_venta_producto                             = $datos['cod_venta_producto'];
		$cod_producto_barra                             = $datos['cod_producto_barra'];
		$nombre_producto                                = $datos['nombre_producto'];
		$und_venta                                      = $datos['und_venta'];
		$precio_compra_producto                         = $datos['precio_compra_producto'];
		$total_compra_producto                          = $datos['total_compra_producto'];
		$precio_venta_producto                          = $datos['precio_venta_producto'];
		$total_venta_producto                           = $datos['total_venta_producto'];
		$fecha_ymd_venta_producto                       = $datos['fecha_ymd_venta_producto'];
		$descuento_ptj                                  = $datos['descuento_ptj'];
		$iva_ptj                                        = $datos['iva_ptj'];
		$ptj_imp_consumo                                = $datos['ptj_imp_consumo'];
		$ptj_ret_iva                                    = $datos['ptj_ret_iva'];
		$ptj_ret_ica                                    = $datos['ptj_ret_ica'];
		$ptj_ret_fuente                                 = $datos['ptj_ret_fuente'];
		$ptj_ipc                                        = $datos['ptj_ipc'];
		$precio_ipc_total                               = $datos['precio_ipc_total'];
		$precio_ipc                                     = $datos['precio_ipc'];
		$nombre_tipo_unidad_medida                      = $datos['nombre_tipo_unidad_medida'];
		//$precio_venta_producto                          = ($precio_venta_producto * $und_venta);
		$precio_venta_producto_sin_iva                  = (($precio_venta_producto - (($descuento_ptj/100) * $precio_venta_producto)) / (($iva_ptj/100) + (100/100)));

	    $sql_tipo_unidad_medida= "SELECT cod_tipo_unidad_medida_norma_internacional FROM tbl15_tipo_unidad_medida WHERE (nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida')";
	    $consulta_tipo_unidad_medida = mysqli_query($conectar, $sql_tipo_unidad_medida) or die(mysqli_error($conectar));
	    $datos_tipo_unidad_medida = mysqli_fetch_assoc($consulta_tipo_unidad_medida);

	    $cod_tipo_unidad_medida_norma_internacional     = $datos_tipo_unidad_medida['cod_tipo_unidad_medida_norma_internacional'];

		$incremental++;

		if ($total <> $incremental) {
			$datos_json .= ' 				{ ';
			$datos_json .= '					"sku": "' .$cod_producto_barra. '", ';
			$datos_json .= '					"quantity": ' .$und_venta. ', ';
			$datos_json .= '					"description": "' .$nombre_producto. '", ';
			$datos_json .= '   	 				"measuring_unit": "94", ';
			//$datos_json .= '					"measuring_unit": "' .$cod_tipo_unidad_medida_norma_internacional. '", ';
			$datos_json .= '					"price": ' .$precio_venta_producto_sin_iva. ', ';

			$datos_json .= '					"taxes": [';
			$datos_json .= ' 						{ ';
			$datos_json .= '   	 						"tax_category": "IVA", ';
			$datos_json .= '   		 					"tax_rate": ' .$iva_ptj. '';
			$datos_json .= ' 						} ';
			$datos_json .= ' 					] ';
			$datos_json .= ' 				}, ';
		} else {
			$datos_json .= ' 				{ ';
			$datos_json .= '					"sku": "' .$cod_producto_barra. '", ';
			$datos_json .= '					"quantity": ' .$und_venta. ', ';
			$datos_json .= '					"description": "' .$nombre_producto. '", ';
			$datos_json .= '   	 				"measuring_unit": "94", ';
			//$datos_json .= '					"measuring_unit": "' .$cod_tipo_unidad_medida_norma_internacional. '", ';
			$datos_json .= '					"price": ' .$precio_venta_producto_sin_iva. ', ';

			$datos_json .= '					"taxes": [';
			$datos_json .= ' 						{ ';
			$datos_json .= '   	 						"tax_category": "IVA", ';
			$datos_json .= '   		 					"tax_rate": ' .$iva_ptj. '';
			$datos_json .= ' 						} ';
			$datos_json .= ' 					] ';
			$datos_json .= ' 				} ';
		}
	}

	$datos_json .= '			] ';

	$datos_json .= '		} ';
	$datos_json .= '	} ';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$directorio_certificado_seguridad        = dirname(__FILE__);
	$nombre_archivo_certificado_seguridad    = "cacert.pem";
	$ruta_certificado_seguridad_comilla      = $directorio_certificado_seguridad.'\"'.$nombre_archivo_certificado_seguridad;
	$ruta_certificado_seguridad              = str_replace('"', '', $ruta_certificado_seguridad_comilla);
	$url_enviar_datos_dataico                = "https://api.dataico.com/direct/dataico_api/v2/credit_notes";
/*
*/
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