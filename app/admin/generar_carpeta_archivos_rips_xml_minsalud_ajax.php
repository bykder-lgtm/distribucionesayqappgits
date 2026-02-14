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
$sql_infos_empresa_global = "SELECT * FROM tbl15_info_empresa_global WHERE cod_info_empresa_global = '2'";
$resultado_infos_empresa_global = mysqli_query($conectar, $sql_infos_empresa_global);
$info_empresa_data_global = mysqli_fetch_assoc($resultado_infos_empresa_global);

$numDocumentoIdObligado_info_empresa_global                = $info_empresa_data_global['numDocumentoIdObligado_info_empresa_global'];
$codPrestador_info_empresa_global                          = $info_empresa_data_global['codPrestador_info_empresa_global'];
$codPrestador_digito_info_empresa_global                   = $info_empresa_data_global['codPrestador_digito_info_empresa_global'];
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT nit_empresa FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nit_empresa                                              = $info_empresa_data['nit_empresa'];
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_info_factura_venta') && ($tipo_ajax=='tbl15_info_factura_venta')) {

	$cod_info_factura_venta                               = intval($_REQUEST['cod_info_factura_venta']); 
	$informacion_archivo_factura_fev_xml                  = trim($_REQUEST['estructura_factura_fev_xml_remota']); 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_total_tipo_factura = "SELECT cod_resolucion_facturacion, cod_factura, dataico_xml_url, cod_tipo_forma_pago, descuento_ptj, cod_tercero, cod_tipo_pago, observacion, fecha_anyo
	FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
	$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

	$cod_factura                                          = $datos_total_tipo_factura['cod_factura'];
	$cod_tipo_forma_pago                                  = $datos_total_tipo_factura['cod_tipo_forma_pago'];
	$descuento_ptj                                        = $datos_total_tipo_factura['descuento_ptj'];
	$cod_tercero                                          = $datos_total_tipo_factura['cod_tercero'];
	$cod_tipo_pago                                        = $datos_total_tipo_factura['cod_tipo_pago'];
	$observacion                                          = $datos_total_tipo_factura['observacion'];
	$cod_resolucion_facturacion                           = $datos_total_tipo_factura['cod_resolucion_facturacion'];
	$fecha_anyo                                           = date("d/m/Y", strtotime($datos_total_tipo_factura['fecha_anyo']));
	$dataico_xml_url                                      = $datos_total_tipo_factura['dataico_xml_url'];
  //-------------------------------------------------------------------------------------------------------------------//
  //-------------------------------------------------------------------------------------------------------------------//
    $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
    $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $prefijo_resolucion_facturacion                       = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_cliente = "SELECT nombre_tipo_doc, fecha_nac_ymd, nombre_sexo, cod_pais, cod_departamento, cod_municipio FROM tbl15_cliente WHERE (cod_cliente = '$cod_cliente')";
	$consulta_cliente = mysqli_query($conectar, $sql_cliente);
	$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

	$nombre_tipo_doc                                      = $datos_cliente['nombre_tipo_doc'];
	$fecha_nac_ymd                                        = $datos_cliente['fecha_nac_ymd'];
	$fecha_nac_cliente                                    = date("Y-m-d", strtotime($fecha_nac_ymd));
	$nombre_sexo                                          = $datos_cliente['nombre_sexo'];
	if ($nombre_sexo == 'F') { $codigo_sexo_cliente = "M"; } elseif ($nombre_sexo == 'M') { $codigo_sexo_cliente = "H"; } else { $codigo_sexo_cliente = "H"; }
	$cod_pais                                             = $datos_cliente['cod_pais'];
	$cod_departamento                                     = $datos_cliente['cod_departamento'];
	$cod_municipio                                        = $datos_cliente['cod_municipio'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_pais = "SELECT nombre_pais_abrev FROM tbl15_pais WHERE cod_pais = '".($cod_pais)."'";
	$consultar_pais = mysqli_query($conectar, $obtener_pais) or die(mysqli_error($conectar));
	$info_pais = mysqli_fetch_assoc($consultar_pais);

	$nombre_pais_abrev                                    = $info_pais['nombre_pais_abrev'];
	$codigo_pais                                          = $info_pais['codigo_pais'];
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_departamento = "SELECT * FROM tbl15_departamento WHERE cod_departamento = '".($cod_departamento)."'";
	$consultar_departamento = mysqli_query($conectar, $obtener_departamento) or die(mysqli_error($conectar));
	$info_departamento = mysqli_fetch_assoc($consultar_departamento);

	$nombre_departamento                                  = $info_departamento['nombre_departamento'];
	$codigo_departamento                                  = $info_departamento['codigo_departamento'];
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_municipio = "SELECT * FROM tbl15_municipio WHERE cod_municipio = '".($cod_municipio)."'";
	$consultar_municipio = mysqli_query($conectar, $obtener_municipio) or die(mysqli_error($conectar));
	$info_municipio = mysqli_fetch_assoc($consultar_municipio);

	$nombre_municipio                                     = $info_municipio['nombre_municipio'];
	$nombre_ciudad                                        = $nombre_municipio;
	$codigo_municipio                                     = $info_municipio['codigo_municipio'];
  //-------------------------------------------------------------------------------------------------------------------//
  //-------------------------------------------------------------------------------------------------------------------//
	$consecutivo_paciente_agrupado                        = 0;
	$consecutivo_paciente                                 = 0;

	$informacion_archivo_rips_json                        = "";
	$numFactura                                           = $prefijo_resolucion_facturacion.$cod_factura;
	$tipoUsuario                                          = "02";
	$codSexo                                              = "M";
	$incapacidad                                          = "NO";
	$valorPagoModerador                                   = 0;
	$numFEVPagoModerador                                  = "";
	$tipoDiagnosticoPrincipal                             = "02";

	$tipoNota                                             = "null";
	$numNota                                              = "null";
	$idMIPRES                                             = "null";
	$codDiagnosticoRelacionadoE1                          = "null";
	$codDiagnosticoRelacionadoE2                          = "null";
	$codDiagnosticoRelacionadoE3                          = "null";
	$codDiagnosticoCausaMuerte                            = "null";
	$xmlFevFile                                           = "";

	$datos_json = '';
	//$datos_json .= '{';
	//$datos_json .= '	"rips": {';
	$datos_json .= '	{';

	$datos_json .= '		"numDocumentoIdObligado": "' .$nit_empresa. '", '; //T01 - Número del NIT con el cual se identifique el facturador electrónico en salud.
	$datos_json .= '		"numFactura": "' .$numFactura. '", '; // T02 - Número que corresponda al sistema de numeración consecutiva según las disposiciones de la DIAN
	$datos_json .= '   		"tipoNota": ' .$tipoNota. ', '; // T03 - Tipo de nota débito o crédito, o nota ajuste RIPS que se requiere realizar para un ajuste contable o en las facturas 01: Nota crédito - 02: Nota débito - 03: Nota ajuste - null: no aplica
	$datos_json .= '   		"numNota": ' .$numNota. ', '; // T04 - Número de la nota crédito, débito o nota ajuste RIPS emitida por el facturador electrónico en salud. - Si el tipo de nota es por ajuste de RIPS (T03 = 03) el número de nota no es obligatorio (T04 = null).
	$datos_json .= '		"usuarios": [';

	$sql_venta_producto_paciente_agrupado = "SELECT cod_cliente FROM tbl15_venta_producto_paciente WHERE (cod_info_factura_venta = '$cod_info_factura_venta') GROUP BY cod_cliente";
	$consulta_venta_producto_paciente_agrupado = mysqli_query($conectar, $sql_venta_producto_paciente_agrupado);
	$total_agrupado = mysqli_num_rows($consulta_venta_producto_paciente_agrupado);
	while ($datos_venta_producto_paciente_agrupado = mysqli_fetch_assoc($consulta_venta_producto_paciente_agrupado)) {

	  $consecutivo_paciente_agrupado++;
	  $cod_cliente                                          = $datos_venta_producto_paciente_agrupado['cod_cliente'];
	//-------------------------------------------------------------------------------------------------------------------//
	  $sql_cliente = "SELECT cedula, nombre_tipo_doc, fecha_nac_ymd, nombre_sexo, cod_pais, cod_departamento, cod_municipio FROM tbl15_cliente WHERE (cod_cliente = '$cod_cliente')";
	  $consulta_cliente = mysqli_query($conectar, $sql_cliente);
	  $datos_cliente = mysqli_fetch_assoc($consulta_cliente);

	  $nombre_tipo_doc_cliente                              = $datos_cliente['nombre_tipo_doc'];
	  $identificacion_cliente                               = $datos_cliente['cedula'];
	  $nombre_sexo                                          = $datos_cliente['nombre_sexo'];
	  $cod_pais                                             = $datos_cliente['cod_pais'];
	  $cod_departamento                                     = $datos_cliente['cod_departamento'];
	  $cod_municipio                                        = $datos_cliente['cod_municipio'];
	  $fecha_nac_ymd                                        = $datos_cliente['fecha_nac_ymd'];
	  $fecha_nac_cliente                                    = date("Y-m-d", strtotime($fecha_nac_ymd));
	  if ($nombre_sexo == 'F') { $codigo_sexo_cliente = "M"; } elseif ($nombre_sexo == 'M') { $codigo_sexo_cliente = "H"; } else { $codigo_sexo_cliente = "H"; }
	//-------------------------------------------------------------------------------------------------------------------//
	  $obtener_pais = "SELECT * FROM tbl15_pais WHERE cod_pais = '".($cod_pais)."'";
	  $consultar_pais = mysqli_query($conectar, $obtener_pais) or die(mysqli_error($conectar));
	  $info_pais = mysqli_fetch_assoc($consultar_pais);

	  $nombre_pais_abrev                                    = $info_pais['nombre_pais_abrev'];
	  $codigo_pais                                          = $info_pais['codigo_pais'];
	  //-------------------------------------------------------------------------------------------------------------------//
	  $obtener_departamento = "SELECT * FROM tbl15_departamento WHERE cod_departamento = '".($cod_departamento)."'";
	  $consultar_departamento = mysqli_query($conectar, $obtener_departamento) or die(mysqli_error($conectar));
	  $info_departamento = mysqli_fetch_assoc($consultar_departamento);

	  $nombre_departamento                                  = $info_departamento['nombre_departamento'];
	  $codigo_departamento                                  = $info_departamento['codigo_departamento'];
	  //-------------------------------------------------------------------------------------------------------------------//
	  $obtener_municipio = "SELECT * FROM tbl15_municipio WHERE cod_municipio = '".($cod_municipio)."'";
	  $consultar_municipio = mysqli_query($conectar, $obtener_municipio) or die(mysqli_error($conectar));
	  $info_municipio = mysqli_fetch_assoc($consultar_municipio);

	  $nombre_municipio                                     = $info_municipio['nombre_municipio'];
	  $nombre_ciudad                                        = $nombre_municipio;
	  $codigo_municipio                                     = $info_municipio['codigo_municipio'];

   $datos_json .= '        {';
   $datos_json .= '           "tipoDocumentoIdentificacion": "' .$nombre_tipo_doc_cliente. '", '; // U01 - Tipo de documento de identificación del usuario. - CC, CE, CD, PA, SC, PE, RC, TI, CN, AS, MS, DE, PT
   $datos_json .= '           "numDocumentoIdentificacion": "' .$identificacion_cliente. '", '; // U02 - Corresponde al número del documento de identificación del usuario
   $datos_json .= '           "tipoUsuario": "' .$tipoUsuario. '", '; // U03 - Identificador para determinar la condición del usuario en relación con el Sistema de Salud según la cobertura al momento de la atención - 01: Contributivo cotizante - 02: Contributivo beneficiario - 03: Contributivo adicional - 04: Subsidiado - 05: No afiliado - 06: Especial o Excepción cotizante - 07: Especial o Excepción beneficiario - 08: Personas privadas de la libertad a cargo del Fondo Nacional de Salud - 09: Tomador / Amparado ARL
   $datos_json .= '           "fechaNacimiento": "' .$fecha_nac_cliente. '", '; // U04 - Fecha de nacimiento del usuario.
   $datos_json .= '           "codSexo": "' .$codigo_sexo_cliente. '", '; // U05 - identificador de sexo según aparece en el documento de identificación registrado en el campo numDocumentoIdentificacion - H: Hombre - I: Indeterminado o Intersexual - M: Mujer
   $datos_json .= '           "codPaisResidencia": "' .$codigo_pais. '", '; // U06 - Código del país de residencia habitual
   $datos_json .= '           "codMunicipioResidencia": "' .$codigo_municipio. '", '; // U07 - Código del municipio de residencia habitual.
   $datos_json .= '           "codZonaTerritorialResidencia": "' .$codigo_departamento. '", '; // U08 - Identificador del DANE para determinar la zona de residencia del usuario
   $datos_json .= '           "incapacidad": "' .$incapacidad. '", '; // U09 - Identificador de la expedición de una incapacidad soportada en la atención en salud que se reporta en RIPS - SI o NO
   $datos_json .= '           "codPaisOrigen": "' .$codigo_pais. '", '; // U11 - Código del país de origen (de nacimiento)
   $datos_json .= '           "consecutivo": ' .$consecutivo_paciente_agrupado. ', '; // U10 - Número consecutivo que identifique el registro
   $datos_json .= '			  "servicios": {';
   $datos_json .= '					"consultas": [';

   $sql_venta_producto = "SELECT * FROM tbl15_venta_producto_paciente WHERE (cod_cliente = '$cod_cliente') AND (cod_info_factura_venta = '$cod_info_factura_venta')";
   $consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
   $total = mysqli_num_rows($consulta_venta_producto);
   while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {
               
      $consecutivo_paciente++;
      $cedula                                               = $datos_venta_producto['cedula'];
      $nombres                                              = $datos_venta_producto['nombres'];
      $apellido1                                            = $datos_venta_producto['apellido1'];
      $nombres_apellidos                                    = $nombres.' '.$apellido1;
      $motivo                                               = $datos_venta_producto['motivo'];
      $fecha_ymd                                            = $datos_venta_producto['fecha_ymd'];
      $precio_venta_producto                                = $datos_venta_producto['precio_venta_producto'];
      $total_venta_producto                                 = $datos_venta_producto['total_venta_producto'];
      $cod_producto_barra                                   = $datos_venta_producto['cod_producto_barra'];
      $nombre_producto                                      = $datos_venta_producto['nombre_producto'];
      $cod_historia_clinica                                 = $datos_venta_producto['cod_historia_clinica'];
      $fecha_anyo                                           = $datos_venta_producto['fecha_anyo'];

      $numAutorizacion                                      = "null";
      $codConsulta                                          = "890301";
      $modalidadGrupoServicioTecSal                         = "01";
      $grupoServicios                                       = "01";
      $codServicio                                          = "407";
      $finalidadTecnologiaSalud                             = "11";
      $causaMotivoAtencion                                  = "26";
      $codDiagnosticoRelacionado1                           = "null";
      $codDiagnosticoRelacionado2                           = "null";
      $codDiagnosticoRelacionado3                           = "null";
      $tipoDiagnosticoPrincipal                             = "02";
      $conceptoRecaudo                                      = "05";
      $valorPagoModerador                                   = 0;
      $numFEVPagoModerador                                  = "null";
	//-------------------------------------------------------------------------------------------------------------------//
	  $sql_historia_clinica = "SELECT cod_administrador, fecha_time  FROM tbl15_historia_clinica WHERE (cod_historia_clinica = '$cod_historia_clinica')";
	  $consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
	  $datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

	  $cod_administrador                                    = $datos_historia_clinica['cod_administrador'];
	  $fecha_time                                           = $datos_historia_clinica['fecha_time'];
	  $fecha_hora_atencion                                  = date("Y-m-d H:i", $fecha_time);
	//-------------------------------------------------------------------------------------------------------------------//
      $sql_administrador = "SELECT cedula FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
      $consulta_administrador = mysqli_query($conectar, $sql_administrador);
      $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

      $nombre_tipo_doc_realizo_consulta                     = "CC";
      $cedula_realizo_consulta                              = $datos_administrador['cedula'];
	//-------------------------------------------------------------------------------------------------------------------//
      $sql_cie10diag = "SELECT cie10_cod FROM tbl15_cie10diag WHERE (cod_historia_clinica = '$cod_historia_clinica') LIMIT 0, 1";
      $consulta_cie10diag = mysqli_query($conectar, $sql_cie10diag);
      $datos_cie10diag = mysqli_fetch_assoc($consulta_cie10diag);

      $codDiagnosticoPrincipal                              = $datos_cie10diag['cie10_cod'];
	//-------------------------------------------------------------------------------------------------------------------//
      $datos_json .= '                 {';
      $datos_json .= '                    "codPrestador": "' .$nit_empresa. '", '; // C01 - Código otorgado por el Ministerio de Salud y Protección Social al prestador de servicios de salud o del obligado a reportar. (IPSCodHabilitación)
      $datos_json .= '                    "fechaInicioAtencion": "' .$fecha_hora_atencion. '", '; // C02 - Fecha y hora de la consulta.
      $datos_json .= '                    "numAutorizacion": "' .$numAutorizacion. '", '; // C03 - Número asignado por la entidad responsable de pago o demás pagadores a los que aplique, para ordenar la prestación o provisión de servicios o tecnologías de salud. - Cuando el servicio de salud no requiera autorización se informa null.
      $datos_json .= '                    "codConsulta": "' .$codConsulta. '", '; // C04 - Código de la consulta definido en el Sistema, según la Clasificación Única de Procedimientos en Salud, CUPS. (CUPSRips)
      $datos_json .= '                    "modalidadGrupoServicioTecSal": "' .$modalidadGrupoServicioTecSal. '", '; // C05 - Identificador para determinar la forma de prestar un servicio de salud en condiciones particulares en relación con elgrupo de servicios - 01: Intramural - 02: Extramural unidad móvil - 03: Extramural domiciliaria - 04: Extramural jornada de salud - 06: Telemedicina interactiva - 07: Telemedicina no interactiva - 08: Telemedicina telexperticia - 09: Telemedicina telemonitoreo (ModalidadAtencion)
      $datos_json .= '                    "grupoServicios": "' .$grupoServicios. '", '; // C06 - Representa el conjunto de servicios que se encuentran relacionados entre sí y que comparten similitudes en la forma de prestación, en los estándares y criterios que deben cumplir - 01: Consulta externa - 02: Apoyo diagnóstico y complementación terapéutica - 03: Internación - 04: Quirúrgico - 05: Atención inmediata (GrupoServicios)
      $datos_json .= '                    "codServicio": ' .$codServicio. ', '; // C07 - Código del servicio que según la norma de habilitación del SGSSS representa la unidad básica habilitante del Sistema Único de Habilitación - 105: CUIDADO INTERMEDIO NEONATAL - 106: CUIDADO INTERMEDIOPEDIATRICO - 107: CUIDADO INTERMEDIOADULTOS - 108: CUIDADO INTENSIVONEONATAL - 109: CUIDADO INTENSIVO PEDIATRICO - 110: CUIDADO INTENSIVOADULTOS (Servicios)
      $datos_json .= '                    "finalidadTecnologiaSalud": "' .$finalidadTecnologiaSalud. '", '; // C08 - Identificador de la finalidad con que se realiza la consulta. (RIPSFinalidadConsultaVersion2)
      $datos_json .= '                    "causaMotivoAtencion": "' .$causaMotivoAtencion. '", '; // C09 - Identificador de la causa que origina el servicio de salud – consulta. (RIPSCausaExternaVersion2)
      $datos_json .= '                    "codDiagnosticoPrincipal": "' .$codDiagnosticoPrincipal. '", '; // C10 - Código del diagnóstico principal confirmado o presuntivo, según la versión vigente de la Clasificación Internacional de Enfermedades – CIE (CIE10)
      $datos_json .= '                    "codDiagnosticoRelacionado1": "' .$codDiagnosticoRelacionado1. '", '; // C11 - Código del diagnóstico relacionado número 1 confirmado o presuntivo, según la versión vigente de la Clasificación Internacional de Enfermedades – CIE (CIE10)
      $datos_json .= '                    "codDiagnosticoRelacionado2": ' .$codDiagnosticoRelacionado2. ', '; // C12 - Código del diagnóstico relacionado número 2 confirmado o presuntivo, según la versión vigente de la Clasificación Internacional de Enfermedades – CIE (CIE10)
      $datos_json .= '                    "codDiagnosticoRelacionado3": ' .$codDiagnosticoRelacionado3. ', '; // C13 - Código del diagnóstico relacionado número 3 confirmado o presuntivo, según la versión vigente de la Clasificación Internacional de Enfermedades – CIE (CIE10)
      $datos_json .= '                    "tipoDiagnosticoPrincipal": "' .$tipoDiagnosticoPrincipal. '", '; // C14 - Identificador para determinar si el diagnóstico es confirmado o presuntivo - 01: Impresión diagnóstica - 02: Confirmado nuevo - 03: Confirmado repetido (RIPSTipoDiagnosticoPrincipalVersion2)
      $datos_json .= '                    "tipoDocumentoIdentificacion": "' .$nombre_tipo_doc_realizo_consulta. '", '; // C15 - Corresponde al tipo de documento de identificación de la persona que realizó la consulta
      $datos_json .= '                    "numDocumentoIdentificacion": "' .$cedula_realizo_consulta. '", '; // C16 - Corresponde al número del documento de identificación de la persona que realizó la consulta
      $datos_json .= '                    "vrServicio": ' .$precio_venta_producto. ', '; // C17 - Valor monetario de la consulta según el manual tarifario o la tarifa pactada en el acuerdo de voluntades
      $datos_json .= '                    "conceptoRecaudo": "' .$conceptoRecaudo. '", '; // C18 - Tipo de pago moderador según el plan de beneficios o planes o pólizas adquiridas. 02: Cuota moderadora - 03: Pagos compartidos en planes voluntarios de salud - 05: No aplica (conceptoRecaudo)
      $datos_json .= '                    "valorPagoModerador": ' .$valorPagoModerador. ', '; // C19 - Valor monetario del pago moderador. Cuando no aplique pago moderador se debe informar cero (0).
      $datos_json .= '                    "numFEVPagoModerador": "' .$numFEVPagoModerador. '", '; // C20 - Número de factura electrónica de venta o documento equivalente emitido al usuario y que soporte el valor registrado en el campo C19 o informado por la entidad responsable de pago o demás pagadores - Cuando no aplique pago moderador se debe informar null.
   	  $datos_json .= '                    "consecutivo": ' .$consecutivo_paciente. ''; // U10 - Número consecutivo que identifique el registro
      $datos_json .= '                 }';

      //if ($total <> $consecutivo_paciente) { $datos_json .= '              },'; } else { $datos_json .= '              }'; } 
   }
   $datos_json .= '            ]';
   $datos_json .= '           }';
   if ($total_agrupado <> $consecutivo_paciente_agrupado) { $datos_json .= '              },'; } else { $datos_json .= '              }'; } 
}
$datos_json .= '     ]';
$datos_json .= '  }';
  //-------------------------------------------------------------------------------------------------------------------//
  //-------------------------------------------------------------------------------------------------------------------//
	$ruta_directorio_crear                                = "../archivador/";
	$nombre_carpeta_crear_global                          = 'FEVRIPS';
	$nombre_carpeta_crear_factura                         = $prefijo_resolucion_facturacion.$cod_factura.'_'.$cod_info_factura_venta;
	$ruta_directorio_carpeta                              = $ruta_directorio_crear.$nombre_carpeta_crear_global;
	$ruta_directorio_carpeta_factura                      = $ruta_directorio_crear.$nombre_carpeta_crear_global.'/'.$nombre_carpeta_crear_factura;
	$nombre_archivo_rips_json_crear                       = $prefijo_resolucion_facturacion.$cod_factura.'_'.$cod_info_factura_venta.".json";
	$nombre_archivo_factura_fev_xml_crear                 = $prefijo_resolucion_facturacion.$cod_factura.'_'.$cod_info_factura_venta.".xml";
	$ruta_global_carpeta_archivo_rips_json_crear          = $ruta_directorio_carpeta_factura.'/'.$nombre_archivo_rips_json_crear;
	$ruta_global_carpeta_archivo_factura_fev_xml_crear    = $ruta_directorio_carpeta_factura.'/'.$nombre_archivo_factura_fev_xml_crear;
	$informacion_archivo_rips_json                        = $datos_json;
  //-------------------------------------------------------------------------------------------------------------------//
  //-------------------------------------------------------------------------------------------------------------------//
	if(!is_dir($ruta_directorio_carpeta_factura)){

		@mkdir($ruta_directorio_crear.$nombre_carpeta_crear_global, 0700); 
		@mkdir($ruta_directorio_crear.$nombre_carpeta_crear_global.'/'.$nombre_carpeta_crear_factura, 0700); 

		$creacion_archivo_rips_json                           = fopen($ruta_global_carpeta_archivo_rips_json_crear, 'a+');
		$creacion_archivo_factura_fev_xml                     = fopen($ruta_global_carpeta_archivo_factura_fev_xml_crear, 'a+');

		fwrite($creacion_archivo_rips_json, $informacion_archivo_rips_json);
		fwrite($creacion_archivo_factura_fev_xml, $informacion_archivo_factura_fev_xml);

		$url_pdf_factura_electronica_local                    = "";
		$url_xml_factura_electronica_local                    = $ruta_global_carpeta_archivo_factura_fev_xml_crear;
		$url_rips_factura_electronica_local                   = $ruta_global_carpeta_archivo_rips_json_crear;
		$resultado                                            = "Carpeta y archivo creados correctamente: ".$nombre_archivo_factura_fev_xml_crear;
	} else { 
		$creacion_archivo_rips_json                           = fopen($ruta_global_carpeta_archivo_rips_json_crear, 'a+');
		$creacion_archivo_factura_fev_xml                     = fopen($ruta_global_carpeta_archivo_factura_fev_xml_crear, 'a+');

		fwrite($creacion_archivo_rips_json, $informacion_archivo_rips_json);
		fwrite($creacion_archivo_factura_fev_xml, $informacion_archivo_factura_fev_xml);

		$url_pdf_factura_electronica_local                    = "";
		$url_xml_factura_electronica_local                    = $ruta_global_carpeta_archivo_factura_fev_xml_crear;
		$url_rips_factura_electronica_local                   = $ruta_global_carpeta_archivo_rips_json_crear;
		$resultado                                            = "Carpeta y archivo creados correctamente: ".$nombre_archivo_factura_fev_xml_crear;
	}
  //-------------------------------------------------------------------------------------------------------------------//
  //-------------------------------------------------------------------------------------------------------------------//

	$data_sql = ("UPDATE tbl15_info_factura_venta SET url_xml_factura_electronica_local = '$url_xml_factura_electronica_local', url_rips_factura_electronica_local = '$url_rips_factura_electronica_local' 
	WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json'); 
	
	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_venta'] = "".$cod_info_factura_venta;
	$datos_array['resultado'] = "".$resultado;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>