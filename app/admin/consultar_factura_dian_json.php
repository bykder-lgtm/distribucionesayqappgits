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

if (isset($_GET['cod_info_factura_venta'])) {

	$cod_info_factura_venta                  = intval($_GET['cod_info_factura_venta']);
	$respuesta_json                          = "";
	//$tab                       		       = $_POST['tab'];
	//$campo                     		       = $_POST['campo'];
	//$tipo                      		       = $_POST['tipo'];
	$envio_dian                  		     = 1;
	$envio_dian_fecha_ymdhis     		     = date("Y/m/d H:i:s");
	//header( 'Content-Type: application/json' );
	$env                                     = 'PRODUCCION';
	$dataico_account_id                      = '01867aec-4551-8985-9a93-a15111e8b07f';
	$dataico_auth_token                      = "fa9f63014982b46e0f44974c1f4fbde4";
	$invoice_type_code                       = 'FACTURA_VENTA';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$headers = [ 'Content-Type: application/json', 'Auth-token: '.$dataico_auth_token ];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_sql = "SELECT fecha_anyo, cod_factura, cod_tipo_forma_pago, descuento_ptj, cod_tercero, cod_tipo_pago, observacion, cod_resolucion_facturacion FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_factura                             = $matriz_consulta['cod_factura'];
	$cod_tipo_forma_pago                     = $matriz_consulta['cod_tipo_forma_pago'];
	$descuento_ptj                           = $matriz_consulta['descuento_ptj'];
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
	$datos_json = '';
	$datos_json .= '	{ ';
	$datos_json .= '		"invoice": { ';
	$datos_json .= '			"dataico_account_id": "' .$dataico_account_id. '", ';
	$datos_json .= '			"number": "' .$prefijo_resolucion_facturacion.$cod_factura. '" ';
	$datos_json .= ' 		} ';
	$datos_json .= '	} ';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$directorio_certificado_seguridad        = dirname(__FILE__);
	$nombre_archivo_certificado_seguridad    = "cacert.pem";
	$ruta_certificado_seguridad_comilla      = $directorio_certificado_seguridad.'\"'.$nombre_archivo_certificado_seguridad;
	$ruta_certificado_seguridad              = str_replace('"', '', $ruta_certificado_seguridad_comilla);
	$url_enviar_datos_dataico                = "https://api.dataico.com/direct/dataico_api/v2/invoices";
/*
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
	if ( $estado_peticion != 201 ) { die ("Respuesta: $respuesta_json"); }
	curl_close($curl);
	$respuesta_peticion = json_decode($respuesta_json, true);
*/
	//if ( $estado_peticion != 201 ) { die("Error: al llamar la URL $url_enviar_datos_dataico. Fallo con el estado $estado_peticion. Respuesta: $respuesta_json. Error curl: ".curl_error($curl)); }
	//if ($estado_peticion != 201) { die("Error: llamada a URL $url_enviar_datos_dataico falló con el estado $estado_peticion"); } else { die("Factura enviada correctamente"); }
	//if ( $estado_peticion != 201 ) { die($respuesta_json); }
	//if ( $estado_peticion == 201 ) { die("$respuesta_json"); }
	//elseif ( $estado_peticion == 400 ) { die("$respuesta_json "."Erro de serv"); }





	header('Content-Type: application/json');
	echo ($datos_json);
}
?>