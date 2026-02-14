<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<!--<script type="text/javascript" src="../js/qrcode.js"></script>-->
<script type="text/javascript" src="../js/qrious.js"></script>

<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_info_factura_venta'])) {

	$pagina_local                                         = $_SERVER['PHP_SELF'];
	$cod_administrador_sesion_db                          = $cod_administrador;
	$subtitulo_tipo_caja                                  = '';
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_info_empresa_global = "SELECT qr_pago_bancolombia, numero_cuenta_pago_bancolombia FROM tbl15_info_empresa_global WHERE cod_info_empresa_global = '1'";
	$consultar_info_info_empresa_global = mysqli_query($conectar, $sql_info_info_empresa_global) or die(mysqli_error($conectar));
	$info_info_empresa_global = mysqli_fetch_assoc($consultar_info_info_empresa_global);

	$qr_pago_bancolombia                                  = $info_info_empresa_global['qr_pago_bancolombia'];
	$numero_cuenta_pago_bancolombia                       = $info_info_empresa_global['numero_cuenta_pago_bancolombia'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_impresora = "SELECT tamano_papel_impresora FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_sesion_db'";
	$consultar_info_impresora = mysqli_query($conectar, $sql_info_impresora) or die(mysqli_error($conectar));
	$info_impresora = mysqli_fetch_assoc($consultar_info_impresora);

	$tamano_papel_impresora                               = $info_impresora['tamano_papel_impresora'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$cod_info_factura_venta                               = intval($_GET['cod_info_factura_venta']);
	$cod_info_factura_venta_codif                         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
	$cod_info_factura_venta_codif_cryp                    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_redirecionar_despues_de_venta_a_cajavirtual_global == '1') {
	$pagina                                               = "../admin/lista_caja_virtual.php".'?cod_info_factura_venta='.$cod_info_factura_venta.'&pagina=../admin/facturacion_venta_temporal_producto_manual_pos.php'.'&modo_venta_por_defecto=manual';
	} else {
	$pagina                                               = addslashes($_GET['pagina']).'?cod_info_factura_venta='.$cod_info_factura_venta;
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
	$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
	$info_emp = mysqli_fetch_assoc($consultar_informacion);

	$titulo_emp                                           = $info_emp['titulo'];
	$desarrollador_emp                                    = $info_emp['desarrollador'];
	$pag_desarrollador_emp                                = $info_emp['pag_desarrollador'];
	$correo_desarrollador_emp                             = $info_emp['correo_desarrollador'];
	$anyo_emp                                             = $info_emp['anyo'];
	$nombre_emp                                           = $info_emp['nombre'];
	$eslogan_emp                                          = $info_emp['eslogan'];
	$nombre_propietario_emp                               = $info_emp['nombre_propietario'];
	$cedula_propietario_emp                               = $info_emp['cedula_propietario'];
	$res_emp                                              = $info_emp['res'];
	$res1_emp                                             = $info_emp['res1'];
	$res2_emp                                             = $info_emp['res2'];
	$fecha_res_emp                                        = $info_emp['fecha_res'];
	$prefijo_res_emp                                      = $info_emp['prefijo_res'];
	$pais_emp                                             = $info_emp['pais'];
	$departamento_emp                                     = $info_emp['departamento'];
	$ciudad_emp                                           = $info_emp['ciudad'];
	$localidad_emp                                        = $info_emp['localidad'];
	$direccion_emp                                        = $info_emp['direccion'];
	$correo_emp                                           = $info_emp['correo'];
	$cabecera_emp                                         = $info_emp['cabecera'];
	$telefono_emp                                         = $info_emp['telefono'];
	$nit_empresa_emp                                      = $info_emp['nit_empresa'];
	$regimen_emp                                          = $info_emp['regimen'];
	$propietario_nombres_apellidos_emp                    = $info_emp['propietario_nombres_apellidos'];
	$propietario_nit_emp                                  = $info_emp['propietario_nit'];
	$propietario_url_firma_emp                            = $info_emp['propietario_url_firma'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_info_fact = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
	$info_fact = mysqli_fetch_assoc($resultado_info_fact);

	$cod_factura                                          = $info_fact['cod_factura'];
	$fecha_anyo                                           = $info_fact['fecha_anyo'];
	$fecha_hora                                           = substr($info_fact['fecha_hora'], 0, 5);
	$total_precio_compra                                  = $info_fact['total_precio_compra'];
	$total_precio_venta                                   = $info_fact['total_precio_venta'];
	$total_datos_data                                     = $info_fact['total_datos_data'];
	$cod_tercero                                          = $info_fact['cod_tercero'];
	$cuenta                                               = $info_fact['cuenta'];
	$vlr_cancelado                                        = $info_fact['vlr_cancelado'];
	$vlr_vuelto                                           = $info_fact['vlr_vuelto'];
	$cod_tipo_pago                                        = $info_fact['cod_tipo_pago'];
	$cod_administrador                                    = $info_fact['cod_administrador'];
	$cod_tipo_forma_pago                                  = $info_fact['cod_tipo_forma_pago'];
	$nombre_tipo_factura                                  = $info_fact['nombre_tipo_factura'];
	$nombre_tipo_moneda                                   = $info_fact['nombre_tipo_moneda'];
	$cod_resolucion_facturacion                           = $info_fact['cod_resolucion_facturacion'];
	$descuento_ptj                                        = $info_fact['descuento_ptj'];
	$cod_caja_virtual                                     = $info_fact['cod_caja_virtual'];
	$cod_base_caja                                        = $info_fact['cod_base_caja'];
	$monto_deuda                                          = $info_fact['monto_deuda'];
	$subtotal                                             = $info_fact['subtotal'];
	$abonado                                              = $info_fact['abonado'];
	$cod_domiciliario                                     = $info_fact['cod_domiciliario'];
	$cod_cufe                                             = $info_fact['cod_cufe'];
	$dataico_email_status                                 = $info_fact['dataico_email_status'];
	$dataico_uuid                                         = $info_fact['dataico_uuid'];
	$dataico_issue_date                                   = $info_fact['dataico_issue_date'];
	$dataico_dian_messages                                = $info_fact['dataico_dian_messages'];
	$dataico_payment_date                                 = $info_fact['dataico_payment_date'];
	$dataico_customer_status                              = $info_fact['dataico_customer_status'];
	$dataico_validation_date                              = $info_fact['dataico_validation_date'];
	$dataico_qrcode                                       = $info_fact['dataico_qrcode'];
	$dataico_xml                                          = $info_fact['dataico_xml'];
	$dataico_invoice_type_code                            = $info_fact['dataico_invoice_type_code'];
	$dataico_dian_status                                  = $info_fact['dataico_dian_status'];
	$dataico_dian_error                                   = $info_fact['dataico_dian_error'];
	$dataico_dian_path                                    = $info_fact['dataico_dian_path'];
	$cod_estado_factura_electronica_enviado_dian          = $info_fact['cod_estado_factura_electronica_enviado_dian'];
	$cod_estado_factura_electronica_enviado_dataico       = $info_fact['cod_estado_factura_electronica_enviado_dataico'];
	$cod_estado_alquiler_renta                            = $info_fact['cod_estado_alquiler_renta'];
    $fecha_ini_renta_alquiler                             = $info_fact['fecha_ini_renta_alquiler'];
    $fecha_fin_renta_alquiler                             = $info_fact['fecha_fin_renta_alquiler'];
	$dataico_xml_url                                      = $info_fact['dataico_xml_url'];
	$dataico_pdf_url                                      = $info_fact['dataico_pdf_url'];
	$retefuente_ptj                                       = $info_fact['retefuente_ptj'];
	$reteica_ptj                                          = $info_fact['reteica_ptj'];
	$reteiva_ptj                                          = $info_fact['reteiva_ptj'];

	$cod_operador_credito                                 = $info_fact['cod_operador_credito'];
	$cod_tienda                                           = $info_fact['cod_tienda'];
	$cod_entidad_crediticia                               = $info_fact['cod_entidad_crediticia'];
	$monto_deuda                                          = $info_fact['monto_deuda'];
	$monto_cuota                                          = $info_fact['monto_cuota'];
	$numero_cuota                                         = $info_fact['numero_cuota'];
	$nombre_tipo_cobro                                    = ($info_fact['nombre_tipo_cobro']);

    $longitud_cod_cufe                                    = strlen($cod_cufe);
    $mitad_longitud_cod_cufe                              = $longitud_cod_cufe / 2;
    $cod_cufe_parte1                                      = substr($cod_cufe, 0, $mitad_longitud_cod_cufe);
    $cod_cufe_parte2                                      = substr($cod_cufe, $mitad_longitud_cod_cufe+1, $longitud_cod_cufe);
	$url_vpfe_dian                                        = "https://catalogo-vpfe.dian.gov.co/document/searchqr";
	$url_vpfe_dian_qr                                     = $url_vpfe_dian."?documentkey=".'<br>'.$cod_cufe_parte1.'<br>'.$cod_cufe_parte2;
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
	$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
	$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

	$nombre_tipo_forma_pago                               = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
	//---------------------------------------------------------------------------------------------------------------------------------//
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
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_agente_dian_contribuyente = "SELECT * FROM tbl15_agente_dian WHERE (cod_agente_dian = '$cod_agente_dian_contribuyente')";
	$consulta_agente_dian_contribuyente = mysqli_query($conectar, $sql_agente_dian_contribuyente) or die(mysqli_error($conectar));
	$matriz_agente_dian_contribuyente = mysqli_fetch_assoc($consulta_agente_dian_contribuyente);

	$nombre_agente_dian_contribuyente                     = $matriz_agente_dian_contribuyente['nombre_agente_dian'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_agente_dian_retenedor = "SELECT * FROM tbl15_agente_dian WHERE (cod_agente_dian = '$cod_agente_dian_retenedor')";
	$consulta_agente_dian_retenedor = mysqli_query($conectar, $sql_agente_dian_retenedor) or die(mysqli_error($conectar));
	$matriz_agente_dian_retenedor = mysqli_fetch_assoc($consulta_agente_dian_retenedor);

	$nombre_agente_dian_retenedor                         = $matriz_agente_dian_retenedor['nombre_agente_dian'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_agente_dian_autoretenedor = "SELECT * FROM tbl15_agente_dian WHERE (cod_agente_dian = '$cod_agente_dian_autoretenedor')";
	$consulta_agente_dian_autoretenedor = mysqli_query($conectar, $sql_agente_dian_autoretenedor) or die(mysqli_error($conectar));
	$matriz_agente_dian_autoretenedor = mysqli_fetch_assoc($consulta_agente_dian_autoretenedor);

	$nombre_agente_dian_autoretenedor                     = $matriz_agente_dian_autoretenedor['nombre_agente_dian'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
	$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
	$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

	$usario_vendedor                                      = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
	$cod_caja                                             = $matriz_usario_vendedor['cod_caja'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_diseno_usario_vendedor = "SELECT nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE (cod_domiciliario = '$cod_domiciliario')";
	$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
	$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

	$usario_domiciliario                                  = $matriz_usario_vendedor['nombres_domiciliario'].' '.$matriz_usario_vendedor['apellidos_domiciliario'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
	$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

	$nombre_cliente                                       = trim($matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['nombre2_tercero'].' '.$matriz_cliente['apellido1_tercero'].' '.$matriz_cliente['apellido2_tercero']);
	$cedula_cli                                           = $matriz_cliente['identificacion_tercero'];
	$direccion_cli                                        = $matriz_cliente['direccion_tercero'];
	$nombre_tipo_identificacion                           = $matriz_cliente['nombre_tipo_identificacion'];
	$digito_tercero                                       = $matriz_cliente['digito_tercero'];
	$total_puntos_redimibles_campanya_tercero             = $matriz_cliente['total_puntos_redimibles_campanya_tercero'];
	if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$cod_servicio_propina                                 = '22222222';
	$cod_servicio_cava                                    = '55555555';
	$cod_servicio_domicilio                               = '44444444';
	$cod_servicio_descuento_punto_redimible               = '11112222';
	$cod_servicio_descuento                               = '33333333';
	$cod_servicio_imp_bolsa                               = '11111111';
	$cod_servicio_retefuente                              = '11113333';
	$cod_servicio_cupobrilla                              = '11114444';
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_venta_product = "SELECT Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_manual,
	Sum(((und_venta*precio_venta_producto_orig) - ((und_venta*precio_venta_producto_orig)))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_automatico, 
	Sum((und_venta*precio_venta_producto_orig) - (und_venta*precio_venta_producto)) As total_descuento_manual_producto,
	Sum(und_venta*precio_venta_producto_orig) As subtotal_sin_descuento_con_impuestos, 
	SUM((((und_venta * precio_venta_producto_orig) - (und_venta * precio_venta_producto)) + (und_venta * precio_venta_producto)) / ((iva_ptj/100)+(100/100))) As subtotal_con_descuento_e_impuestos, 
	Sum(peso_producto * und_venta) As total_peso_producto 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
	AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
	$consulta_venta_product = mysqli_query($conectar, $sql_venta_product) or die(mysqli_error($conectar));
	$suma_venta_product = mysqli_fetch_assoc($consulta_venta_product);

	$subtotal_base_sin_descuento_manual                   = ($suma_venta_product['subtotal_base_sin_descuento_manual']);
	$subtotal_base_sin_descuento_automatico               = ($suma_venta_product['subtotal_base_sin_descuento_automatico']);
	$total_descuento_manual_producto                      = ($suma_venta_product['total_descuento_manual_producto']);
	$subtotal_sin_descuento_con_impuestos                 = ($suma_venta_product['subtotal_sin_descuento_con_impuestos']);
	$subtotal_con_descuento_e_impuestos                   = ($suma_venta_product['subtotal_con_descuento_e_impuestos']);
	$total_peso_producto                                  = ($suma_venta_product['total_peso_producto']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_venta_descuento_manual_como_concepto = "SELECT Sum(total_venta_producto) As total_descuento_manual_como_concepto FROM tbl15_venta_producto 
	WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
	$consulta_venta_descuento_manual_como_concepto = mysqli_query($conectar, $sql_venta_descuento_manual_como_concepto) or die(mysqli_error($conectar));
	$suma_venta_descuento_manual_como_concepto = mysqli_fetch_assoc($consulta_venta_descuento_manual_como_concepto);

	$total_descuento_manual_como_concepto                 = ($suma_venta_descuento_manual_como_concepto['total_descuento_manual_como_concepto']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_venta_descuento_directamente_en_el_precio_venta = "SELECT Sum((und_venta*precio_venta_producto_orig) - (und_venta*precio_venta_producto)) As total_descuento_directamente_en_el_precio_venta 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
	AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
	$consulta_venta_descuento_directamente_en_el_precio_venta = mysqli_query($conectar, $sql_venta_descuento_directamente_en_el_precio_venta) or die(mysqli_error($conectar));
	$suma_venta_descuento_directamente_en_el_precio_venta = mysqli_fetch_assoc($consulta_venta_descuento_directamente_en_el_precio_venta);

	$total_descuento_directamente_en_el_precio_venta      = ($suma_venta_descuento_directamente_en_el_precio_venta['total_descuento_directamente_en_el_precio_venta']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_venta_descuento_puntos_redimibles_como_concepto = "SELECT Sum(total_venta_producto) As total_descuento_puntos_redimibles_como_concepto, nombre_producto FROM tbl15_venta_producto 
	WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento_punto_redimible')";
	$consulta_venta_descuento_puntos_redimibles_como_concepto = mysqli_query($conectar, $sql_venta_descuento_puntos_redimibles_como_concepto) or die(mysqli_error($conectar));
	$existe_descuento_puntos_redimibles = intval(mysqli_num_rows($consulta_venta_descuento_puntos_redimibles_como_concepto));
	$suma_venta_descuento_puntos_redimibles_como_concepto = mysqli_fetch_assoc($consulta_venta_descuento_puntos_redimibles_como_concepto);

	$total_descuento_puntos_redimibles_como_concepto      = ($suma_venta_descuento_puntos_redimibles_como_concepto['total_descuento_puntos_redimibles_como_concepto']);
	$nombre_producto_puntos_redimibles                    = ($suma_venta_descuento_puntos_redimibles_como_concepto['nombre_producto']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_venta_retefuente = "SELECT Sum(total_venta_producto) As total_descuento_retefuente, nombre_producto FROM tbl15_venta_producto 
	WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_retefuente')";
	$consulta_venta_retefuente = mysqli_query($conectar, $sql_venta_retefuente) or die(mysqli_error($conectar));
	$existe_venta_retefuente = intval(mysqli_num_rows($consulta_venta_retefuente));
	$suma_venta_retefuente = mysqli_fetch_assoc($consulta_venta_retefuente);

	$total_descuento_retefuente                           = ($suma_venta_retefuente['total_descuento_retefuente']);
	$nombre_producto_retefuente                           = ($suma_venta_retefuente['nombre_producto']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	//$total_descuentos_manual_y_en_el_precio_venta         = $total_descuento_manual_como_concepto + (-$total_descuento_directamente_en_el_precio_venta);
	//$total_suma_de_todos_los_descuentos                   = $total_descuento_manual_como_concepto + $total_descuento_puntos_redimibles_como_concepto + (-$total_descuento_directamente_en_el_precio_venta);
	$total_descuentos_manual_y_en_el_precio_venta         = intval($total_descuento_manual_como_concepto);
	$total_suma_de_todos_los_descuentos                   = intval($total_descuento_manual_como_concepto + $total_descuento_puntos_redimibles_como_concepto);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
	Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
	Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
	FROM tbl15_venta_producto 
	WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
	$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
	$suma = mysqli_fetch_assoc($consulta_temporal);

	$total_venta_neta                    = ($subtotal_base_sin_descuento_automatico);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') {
		$subtotal_base                       = 0;
		$total_iva                           = 0;
	} else {
		$subtotal_base                       = ($suma['subtotal_base']);
		$total_iva                           = ($suma['total_iva']);
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$total_venta_temp                    = ($suma['total_venta']);
	$total_venta_sin_descuento           = ($subtotal_base_sin_descuento_automatico);
	$vlr_cambio                          = ($vlr_cancelado - $total_venta_temp);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_existe_descuento_manual = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
	$consulta_existe_descuento_manual = mysqli_query($conectar, $sql_existe_descuento_manual) or die(mysqli_error($conectar));
	$existe_descuento_manual = mysqli_num_rows($consulta_existe_descuento_manual);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($existe_descuento_manual == '0' && $cod_estado_mostrar_descuento_manual_factura_venta_global == '1') {
		$nombre_producto_descuento             = '';
		$precio_venta_producto_descuento       = '0';
		$total_venta_producto_descuento        = '0';
		//$total_descuento_venta                 = ($subtotal_base_sin_descuento_automatico - $subtotal_base_sin_descuento_manual);
		//$total_descuento_venta                 = $total_descuento_manual_producto;
		$total_descuento_venta                 = $total_suma_de_todos_los_descuentos;
		//$descuento_ptj_dif                     = ($total_descuento_venta / $subtotal_base_sin_descuento_automatico) * 100;
		$descuento_ptj_dif                     = 0;
		$subtotal_base_sin_descuento           = ($subtotal_con_descuento_e_impuestos);
		$existe_descuento_manual               = "NO";
	} else {
		$sql_servicio_descuento = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, nombre_tipo_precio 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
		$consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
		$existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
		$info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

		$nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
		$precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
		$total_venta_producto_descuento        = $subtotal_base_sin_descuento_manual;
		//$total_descuento_venta                 = $info_servicio_descuento['total_venta_producto'];
		$total_descuento_venta                 = $total_suma_de_todos_los_descuentos;
		$descuento_ptj_dif                     = $info_servicio_descuento['nombre_tipo_precio'];
		$subtotal_base_sin_descuento           = ($subtotal_base_sin_descuento_manual);
		$existe_descuento_manual               = "SI";
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, cupo_credito_ptj
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_propina')";
	$consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
	$existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
	$info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

	$nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
	$precio_venta_producto_propina         = $info_servicio_propina['precio_venta_producto'];
	$total_venta_producto_propina          = $info_servicio_propina['total_venta_producto'];
	$ptj_servicio_propina                  = $info_servicio_propina['cupo_credito_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_servicio_cupobrilla = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, cupo_credito_ptj
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_cupobrilla')";
	$consulta_servicio_cupobrilla = mysqli_query($conectar, $sql_servicio_cupobrilla) or die(mysqli_error($conectar));
	$existe_servicio_cupobrilla = mysqli_num_rows($consulta_servicio_cupobrilla);
	$info_servicio_cupobrilla = mysqli_fetch_assoc($consulta_servicio_cupobrilla);

	$nombre_producto_cupobrilla               = $info_servicio_cupobrilla['nombre_producto'];
	$precio_venta_producto_cupobrilla         = $info_servicio_cupobrilla['precio_venta_producto'];
	$total_venta_producto_cupobrilla          = $info_servicio_cupobrilla['total_venta_producto'];
	$ptj_servicio_cupobrilla                  = $info_servicio_cupobrilla['cupo_credito_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_servicio_domicilio = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, cupo_credito_ptj
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_domicilio')";
	$consulta_servicio_domicilio = mysqli_query($conectar, $sql_servicio_domicilio) or die(mysqli_error($conectar));
	$existe_servicio_domicilio = mysqli_num_rows($consulta_servicio_domicilio);
	$info_servicio_domicilio = mysqli_fetch_assoc($consulta_servicio_domicilio);

	$nombre_producto_domicilio               = $info_servicio_domicilio['nombre_producto'];
	$precio_venta_producto_domicilio         = $info_servicio_domicilio['precio_venta_producto'];
	$total_venta_producto_domicilio          = $info_servicio_domicilio['total_venta_producto'];
	$ptj_servicio_domicilio                  = $info_servicio_domicilio['cupo_credito_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
	$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
	$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

	$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$cod_factura_strpad                   = str_pad($cod_factura, 3, "0", STR_PAD_LEFT);
	$cod_info_factura_strpad              = str_pad($cod_info_factura_venta, 3, "0", STR_PAD_LEFT);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_subproducto_mostrar_imprimir_global == '1') {
		$condcional_mostrar_subproductos_imprimir = " AND (nombre_tipo_producto <> 'SUBPRODUCTO')";
	} else {
		$condcional_mostrar_subproductos_imprimir = '';
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_agrupar_por_producto_imp_global == '1') { 
	  $agrupar_productos_imp = 'GROUP BY cod_producto_barra';
	  $select_productos_imp = 'SUM(und_venta) as und_venta, precio_venta_producto, SUM(total_venta_producto) as total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj, precio_ipc, comentario_producto, nombre_tipo_unidad_medida, und_caja_sobre, cajas_sobre, nombre_tipo_und_caja_sobre, cedula, nombre_cliente, und_caja_sobre'; 
	} else { 
	  $agrupar_productos_imp = ''; 
	  $select_productos_imp = 'und_venta, precio_venta_producto, total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj, precio_ipc, comentario_producto, nombre_tipo_unidad_medida, und_caja_sobre, cajas_sobre, nombre_tipo_und_caja_sobre, cedula, nombre_cliente, und_caja_sobre'; 
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$resta                               = 1516399999;
	$time_seg                            = time();
	$time_date_ymd                       = strtotime(date("Y/m/d"));
	$fecha                               = date("Ymd");
	$hora                                = date("His");
	$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
	$hora_venta_his                      = date("His");
	$fecha_hoy                           = date("Y-m-d");
	$url_qr                              = $url_encuesta_experiencia_compra."/pageditaxe/admin/inicio.php?cod_info_factura_venta_codif_cryp=".$cod_info_factura_venta_codif_cryp;
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($total_descuentos_manual_y_en_el_precio_venta == '0') { $existe_descuento_factura_signo = ''; } else { $existe_descuento_factura_signo = '-'; }
	if ($total_descuento_puntos_redimibles_como_concepto == '0') { $existe_descuento_puntos_redimibles_signo = ''; } else { $existe_descuento_puntos_redimibles_signo = '-'; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_btn_imp_pos_nav_orden_compra_global == '1') {
		$factura_venta_orden_venta = 'ORDEN DE PEDIDO';
	}  else {
		$factura_venta_orden_venta = 'FACTURA DE VENTA';
	}
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $saldo_pendiente_cuenta_cobrar = 0;
    if (($cod_tipo_pago == '2') && ($cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global == '1')) {

        if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '1') {
            $calcular_datos_cuenta_cobrar = "SELECT total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
            $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
            $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);
            
            $total_subtotal_cuenta_cobrar                                = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
            $saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar;
            //$saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar + $total_venta;
        } else {
            $calcular_datos_cuenta_cobrar = "SELECT Sum(monto_deuda) AS monto_deuda, Sum(subtotal) AS total_subtotal_cuenta_cobrar, Sum(abonado) AS abonado 
            FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0') GROUP BY cod_tercero";
            $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
            $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);
            
            $total_subtotal_cuenta_cobrar                                = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
            $saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar;
            //$saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar + $total_venta;
        }
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_tipo_pago == '2') {
		$sql_cuenta_cobrar_venta = "SELECT cod_cuentas_cobrar FROM tbl15_cuentas_cobrar WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_cuenta_cobrar_venta = mysqli_query($conectar, $sql_cuenta_cobrar_venta);
        $datos_cuenta_cobrar_venta = mysqli_fetch_assoc($consulta_cuenta_cobrar_venta);

		$cod_cuentas_cobrar                               = $datos_cuenta_cobrar_venta['cod_cuentas_cobrar'];
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
	$resultado_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
	$info_operador_credito = mysqli_fetch_assoc($resultado_operador_credito);

	$identificacion_tercero_operador_credito              = $info_operador_credito['identificacion_tercero'];
	$nombre_operador_credito                              = $info_operador_credito['nombre_operador_credito'];
	$telefono1_tercero_operador_credito                   = $info_operador_credito['telefono1_tercero'];
	$correo_tercero_operador_credito                      = $info_operador_credito['correo_tercero'];
	$direccion_tercero_operador_credito                   = $info_operador_credito['direccion_tercero'];
	$cod_departamento_operador_credito                    = $info_operador_credito['cod_departamento'];
	$cod_municipio_operador_credito                       = $info_operador_credito['cod_municipio'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_entidad_crediticia = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
	$consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia);
	$data_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

	$nombre_entidad_crediticia                            = $data_entidad_crediticia['nombre_entidad_crediticia'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_tienda = "SELECT * FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
	$resultado_tienda = mysqli_query($conectar, $sql_tienda) or die(mysqli_error($conectar));
	$info_tienda = mysqli_fetch_assoc($resultado_tienda);

	$nombre_tienda                                       = $info_tienda['nombre_tienda'];
	$garantia_tienda                                     = $info_tienda['garantia_tienda'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	?>
	<script>
	function printPageArea(areaID){

	var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
	var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
	$("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

	var printContent = document.getElementById(areaID);
	$("#area_imprimible_invisible").show();
	$("#area_imprimible_invisible_cocina").hide();
	document.getElementById("listo").focus();

	var WinPrint = window.open('', '', 'width=400,height=1000');
	WinPrint.document.write(printContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	}
	</script>

	<script>
	function printPageAreaCocina(areaID2){

	var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
	var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
	$("#codigo_codabar_zapateria_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

	var printContent2 = document.getElementById(areaID2);
	$("#area_imprimible_invisible").hide();
	$("#area_imprimible_invisible_cocina").show();

	var WinPrint2 = window.open('', '', 'width=400,height=1000');
	WinPrint2.document.write(printContent2.innerHTML);
	WinPrint2.document.close();
	WinPrint2.focus();
	WinPrint2.print();
	WinPrint2.close();
	}
	</script>

	<div class="table-responsive">

    <?php if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA') { ?>
	<table class="table table-striped">
	  <tr>
	  	<?php if ($cod_estado_factura_electronica_enviado_dian == '1') { ?>
        <td style="text-align:center;" id="resultado_envio_dian<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/btn_dian_peq.png" class='img-polaroid'><br>Enviado a la Dian</td>
        <?php } ?>
        <?php if ($dataico_dian_error <> '') { ?>
        <td style="text-align:center;" id="resultado_error_envio_dian_dataico<?php echo $cod_info_factura_venta ?>"><?php echo $dataico_dian_error; ?></td>
        <?php } ?>
        <?php if ($cod_estado_factura_electronica_enviado_dian == '0' && $cod_estado_factura_electronica_enviado_dataico == '1') { ?>
        <td style="text-align:center;" id="apidian<?php echo $cod_info_factura_venta ?>" data="<?php echo $cod_info_factura_venta ?>"><a class="EnviarFacturaDianDataico" style="cursor:pointer;"><img src="../imagenes/enviar_historia_clinica_correo.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
        <?php if ($cod_estado_factura_electronica_enviado_dataico == '1') { ?>
        <td style="text-align:center;" id="cod_estado_factura_electronica_enviado_dataico<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/btn_dataico.png" class='img-polaroid'><br>Enviado a Dataico</td>
        <?php } ?>
	  </tr>
	</table>
	<?php } ?>

	<table class="table table-striped">
	  <tr>
	    <td><font color='black' size= "+3">TIPO FACTURA:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_factura; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+3">FACTURA NO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $prefijo_resolucion_facturacion.'|'.$cod_factura; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+3">TIPO DE PAGO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_pago; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+3">CLIENTE:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+3">SUBTOTAL:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", "."); ?></font></td>
	  </tr>
<!--
	  <tr>
	    <td><font color='green' size= "+2">%DESCUENTO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo intval($descuento_ptj_dif).'%'; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='green' size= "+2">$DESCUENTO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_descuento_venta, 0, ",", "."); ?></font></td>
	  </tr>
-->
	  <tr>
	    <td><font color='green' size= "+2">IVA:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_iva, 0, ",", "."); ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+3">TOTAL VENTA:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_venta_temp, 0, ",", "."); ?></font></td>
	  </tr>

	<?php if (($cod_tipo_pago == '2') && ($cod_estado_tipo_venta_zapateria_global == '1')) { ?>
	  <tr>
	    <td><font color='black' size= "+3">ABONADO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+3">PENDIENTE:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
	  </tr>
	<?php } ?>

	<?php if ($cod_tipo_pago == '1') { ?>
	  <tr>
	    <td><font color='black' size= "+3">RECIBIDO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($vlr_cancelado, 0, ",", "."); ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+4">CAMBIO:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+4"><?php echo number_format($vlr_cambio, 0, ",", "."); ?></font></td>
	  </tr>
	<?php } ?>
	</table>

	<table class="table table-striped">
	  <tr>
	    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"><br>REGRESAR</a></td>

		<?php if ($cod_estado_habilitar_btn_imp_venta_nav_global == '0') { ?>
	    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"><br>IMPRIMIR POS</a></td>
		<?php } ?>

	    <?php if ($cod_estado_btn_imprimir_venta_nav_zapateria_global == '1') { ?>
	    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir2" onclick="printPageAreaCocina('area_imprimible_invisible_cocina')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"><br>IMPRIMIR TICKET</a></td>
	    <?php } ?>

		<?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
	    <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button><br>IMPRIMIR FACTURA</td>
		<?php } ?>

		<?php if ($cod_estado_habilitar_btn_imp_nav_carta_pdf_global == '0') { ?>
	    <td style="text-align:center;"><a href="../admin/ver_factura_venta_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR FACTURA PDF</a></td>
		<?php } ?>

		<?php if ($cod_estado_btn_imp_nav_carta_por_caja_pdf_global == '1') { ?>
	    <td style="text-align:center;"><a href="../admin/ver_factura_venta_por_caja_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR FACTURA POR CAJA PDF</a></td>
		<?php } ?>

		<?php if ($cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global == '1') { ?>
	    <td style="text-align:center;"><a href="../admin/ver_factura_venta_por_caja_remision_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR REMISION PDF</a></td>
		<?php } ?>

		<?php if ($cod_estado_btn_imp_carta_nav_orden_compra_pdf_global == '1') { ?>
	    <td style="text-align:center;"><a href="../admin/ver_factura_venta_orden_venta_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR ORDEN PEDIDO PDF</a></td>
		<?php } ?>

		<?php if ($cod_tipo_pago == '2') { ?>
			<?php if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '1') { ?>
	    		<td style="text-align:center;"><a href="../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>"><img src="../imagenes/remision.png"><br>CUENTA POR COBRAR</a></td>
			<?php } else { ?>
	    		<td style="text-align:center;"><a href="../admin/cuentas_cobrar_detalle_factura.php?cod_tercero=<?php echo $cod_tercero?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>"><img src="../imagenes/remision.png"><br>CUENTA POR COBRAR</a></td>
	    		<?php } ?>
		<?php } ?>

		<?php if ($cod_estado_abrir_cajon_monedero_driv_direct == '1') { ?>
	    <td style="text-align:center;"><button id="btnAbrirCaja"><img src="../imagenes/abrir_caja_reg.png" alt="Abrir"></button><br>ABRIR CAJON MONEDERO</td>
		<?php } ?>

	<?php 
	if ($nombre_tipo_factura == 'ELECTRONICA') { ?>
        <td style="text-align:center;"><button id="btnGenerarZipFev" class="btnGenerarZipFev" style="cursor:pointer;" data="<?php echo $cod_info_factura_venta ?>" data_url_xml="<?php echo $informacion_archivo_factura_fev_xml ?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png" class="img-polaroid" alt=""></button></td>

	    <td style="text-align:center;"></td>
	    <?php if ($nombre_operador_factura_electronica == 'DATAICO') { ?>
	    <!--<td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_puntoycoma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png"></a></td>-->
	    <!--<td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_coma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_csv.png"></a></td>-->
	    <?php } ?>
	    <?php if ($nombre_operador_factura_electronica == 'MONEYBOX') { ?>
	    <!--<td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_moneybox_xlsx.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png"></a></td>-->
	    <?php } ?>
	<?php } ?>
	  </tr>
	</table>

	</center>
	<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<div id="wrapper" style="width: 99%;">

	<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

	<?php if ($tamano_papel_impresora == '58') { ?>

		<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		<tr>
		<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
		</tr>
		</table>
		<?php } ?>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		<tr>
		<td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_emp; ?></strong></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		<tr>
		<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		<tr>
		<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		<tr>
		<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		<tr>
		<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
		</tr>
		</table>


		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>


		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		  <tr>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FECHA: <?php echo $fecha_anyo; ?>|<?php echo $fecha_hora; ?></strong></td>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FACTURA DE VENTA: <?php echo $prefijo_resolucion_facturacion.' '.$cod_factura; ?></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TIPO DE PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_tipo_identificacion; ?> CLIENTE: <?php echo $cedula_cli.$digito_tercero; ?></strong></td>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CLIENTE: <?php echo utf8_decode($nombre_cliente); ?></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CAJA: <?php echo $cod_caja; ?></strong></td>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_concepto_multi_virtual; ?> VIRTUAL: <?php echo $cod_base_caja; ?></strong></td>
		  </tr>
		</table>
		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
		  <tr>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>VENDEDOR (A): <?php echo $usario_vendedor; ?></strong></td>
		    <?php if ($cod_estado_peso_producto_global == '1') { ?>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TOTAL PESO (KG): <?php echo number_format($total_peso_producto, 0, ",", "."); ?></strong></td>
		    <?php } ?>
		  </tr>
		  <tr>
		    <?php if ($cod_estado_domiciliario_global == '1') { ?>
		    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>DOMICILIARIO: <?php echo $usario_domiciliario; ?></strong></td>
		    <?php } ?>
		  </tr>
		</table>


		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
		<tr>
		<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;">CANT</th>
		<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"></th>
		<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;">..</th><?php } ?>
		<th style="text-align: center; width:50%; font-family: Courier; font-size:9pt;">DESCRIPCION</th>
		<th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;">P.UNIT</th>
		<th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;">P.TOTAL</th>
		<th style="text-align: center; width:10%; font-family: Courier; font-size:5pt;"></th>
		</tr>
		<?php
		if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }


		$resultado_sql = "SELECT $select_productos_imp 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND ((cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
		AND (cod_producto_barra <> '$cod_servicio_domicilio')) 
		$condcional_mostrar_subproductos_imprimir $agrupar_productos_imp $ordenamiento";
		$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
		while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

			$cod_producto                = $info_venta['cod_producto'];
			$cod_producto_barra          = $info_venta['cod_producto_barra'];
			$nombre_producto             = $info_venta['nombre_producto'];
			$und_venta                   = $info_venta['und_venta'];
			$precio_venta_producto       = $info_venta['precio_venta_producto'];
			$total_venta_producto        = $info_venta['total_venta_producto'];
			$iva_ptj                     = $info_venta['iva_ptj'];
			$precio_ipc                  = $info_venta['precio_ipc'];
			$comentario_producto         = $info_venta['comentario_producto'];
			$und_caja_sobre              = $info_venta['und_caja_sobre'];
			$cajas_sobre                 = $info_venta['cajas_sobre'];
			$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
			$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

			if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
			//if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
			if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
			if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

			$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
			$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
			$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

			$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

			if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
		?>
		<tr>
		<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $und_venta ?></strong></td>
		<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_tipo_und_caja_sobre ?></strong></td>
		<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
		<td style="text-align: left; width:50%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_producto ?></strong></td>
		<td style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
		<td style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
		<td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong><?php echo $nombre_tipo_iva ?></strong></td>
		</tr>
		<?php } ?>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		  <tr>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>SUBTOTAL</strong></td>
		    <!--<td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>%DESCUENTO</strong></td>-->
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>$DESCUENTO</strong></td>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>IVA</strong></td>
			<?php if ($existe_servicio_propina <> '0') { ?>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_producto_propina." ".$ptj_servicio_propina."%" ?></strong></td>
			<?php } ?>
			<?php if ($existe_servicio_cupobrilla <> '0') { ?>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_producto_cupobrilla." ".$ptj_servicio_cupobrilla."%" ?></strong></td>
			<?php } ?>
		    <td style="text-align: center; width: 5%; font-family: Courier; font-size:8pt;"><strong></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($subtotal_base_sin_descuento, 0, ",", ".") ?></strong></td>
		    <!--<td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo intval($descuento_ptj_dif) ?>%</strong></td>-->
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>-<?php echo number_format(abs($total_descuento_venta), 0, ",", ".") ?></strong></td>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_iva, 0, ",", ".") ?></strong></td>
			<?php if ($existe_servicio_propina <> '0') { ?>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto_propina, 0, ",", ".") ?></strong></td>
			<?php } ?>
			<?php if ($existe_servicio_cupobrilla <> '0') { ?>
		    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto_cupobrilla, 0, ",", ".") ?></strong></td>
			<?php } ?>
		    <td style="text-align: center; width: 5%; font-family: Courier; font-size:8pt;"><strong></strong></td>
		  </tr>
		</table>

		<?php if ($cod_tipo_pago == '1') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong>RECIBIDO</strong></td>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong>CAMBIO</strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($vlr_cancelado, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($vlr_cambio, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
			  </tr>
			</table>
		<?php } else { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
			  </tr>
			</table>
		<?php } ?>


		<?php if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') { ?>
		<?php } else { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center; width:20%; font-family: Courier; font-size:8pt;"><strong>RESUMEN DE IMPUESTOS</strong></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>TIPO</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>COMPRA</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>BASE/IMP</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>IVA</strong></td>
			</td>
			<?php
			$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
			Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
			Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19')";
			$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
			$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

			$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
			$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
			$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
			//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

			$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
			Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
			Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5') 
			AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
			$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
			$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

			$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
			$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
			$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
			//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

			$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
			Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
			Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0') 
			AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
			$consulta_total_tipos_iva_0 = mysqli_query($conectar, $sql_total_tipos_iva_0) or die(mysqli_error($conectar));
			$datos_total_tipos_iva_0 = mysqli_fetch_assoc($consulta_total_tipos_iva_0);

			$total_venta_0                         = $datos_total_tipos_iva_0['total_venta'];
			$total_base_iva_0                      = $datos_total_tipos_iva_0['total_base_iva'];
			$total_iva_0                           = $datos_total_tipos_iva_0['total_iva'];
			//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;

			$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc) AS total_precio_ipc
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
			$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
			$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

			$total_precio_ipc                      = $datos_total_tipos_iva_ipc['total_precio_ipc'];
			$total_valor_base                      = $total_base_iva_19 + $total_base_iva_5 + $total_base_iva_0;
			$total_valor_iva                       = $total_iva_19 + $total_iva_5 + $total_iva_0;
			$total_valor_total                     = $total_venta_19 + $total_venta_5 + $total_venta_0;
			//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;
			/*
			$resultado_sql = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva";
			$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
			while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

			$nombre_tipo_iva             = $info_venta['nombre_tipo_iva'];
			$descripcion_tipo_iva        = $info_venta['descripcion_tipo_iva'];
			$iva                         = $info_venta['iva'];

			$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
			Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
			Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
			FROM tbl15_venta_producto WHERE (iva_ptj = '$iva_ptj')";
			$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
			$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

			$total_venta                         = $datos_total_tipos_iva['total_venta'];
			$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
			$total_iva                           = $datos_total_tipos_iva['total_iva'];
			*/
			?>
			<tr>
			<td style="text-align: left; width:10%; font-family: Courier; font-size:8pt;"><strong>G=19%</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_19, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_base_iva_19, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_iva_19, 0, ",", ".") ?></strong></td>
			</tr>
			<tr>
			<td style="text-align: left; width:10%; font-family: Courier; font-size:8pt;"><strong>S=5%</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_5, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_base_iva_5, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_iva_5, 0, ",", ".") ?></strong></td>
			</tr>
			<tr>
			<td style="text-align: left; width:10%; font-family: Courier; font-size:8pt;"><strong>A=0%</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_0, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_base_iva_0, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_iva_0, 0, ",", ".") ?></strong></td>
			</tr>
			<?php //} ?>
			</table>
		<?php } ?>


		<?php 
		$sql_total_imp_bolsa = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
		Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
		Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_imp_bolsa')";
		$consulta_total_imp_bolsa = mysqli_query($conectar, $sql_total_imp_bolsa) or die(mysqli_error($conectar));
		$total_imp_bolsa = mysqli_num_rows($consulta_total_imp_bolsa);
		$datos_total_imp_bolsa = mysqli_fetch_assoc($consulta_total_imp_bolsa);

		$total_venta_imp_bolsa                 = $datos_total_imp_bolsa['total_venta'];
		$total_base_iva_imp_bolsa              = $datos_total_imp_bolsa['total_base_iva'];
		$total_iva_imp_bolsa                   = $datos_total_imp_bolsa['total_iva'];

		if (intval($total_venta_imp_bolsa) == '0') { } else { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>IMP A LA BOLSA</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_imp_bolsa, 0, ",", ".") ?></strong></td>
			</tr>
			</table>
		<?php } ?>


		<?php 
		$sql_total_impoconsumo = "SELECT Sum(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
		WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
		$consulta_total_impoconsumo = mysqli_query($conectar, $sql_total_impoconsumo) or die(mysqli_error($conectar));
		$total_impoconsumo = mysqli_num_rows($consulta_total_impoconsumo);
		$datos_total_impoconsumo = mysqli_fetch_assoc($consulta_total_impoconsumo);

		$total_impoconsumo                     = $datos_total_impoconsumo['total_impoconsumo'];

		if (intval($total_impoconsumo) == '0') { } else { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>I = IMPO CONSUMO</strong></td>
			<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_impoconsumo, 0, ",", ".") ?></strong></td>
			</tr>
			</table>
		<?php } ?>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>FACTURA <?php echo $nombre_tipo_resolucion_facturacion ?></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>RESOLUCION DIAN: <?php echo $numero_resolucion_facturacion ?></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>DESDE <?php echo $prefijo_resolucion_facturacion ?> <?php echo ($ini_resolucion_facturacion) ?> AL <?php echo $prefijo_resolucion_facturacion ?> <?php echo $fin_resolucion_facturacion ?></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>REGIMEN <?php echo $regimen_emp ?></strong></td>
		  </tr>
		</table>


		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>Muchas gracias por su preferencia</strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
		  </tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		  <tr>
		    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
		  </tr>
		  <tr>
		    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_php"></div></td>
		  </tr>
		</table>

		<?php if ($cod_estado_encuesta_experiencia_compra_global == '1') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Califica tu experiencia de compra en</strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $url_encuesta_experiencia_compra ?></strong></td>
			  </tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
			    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;"><div id="qrcode"></div></td>
			    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
			  </tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
			    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;"><strong>ESCANEAME</strong></td>
			    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
			  </tr>
			</table>
		<?php } ?>
		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
		  <tr>
		    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrm58 ==></strong></td>
		  </tr>
		</table>


		<?php if ($cod_estado_btn_imprimir_venta_nav_zapateria_global == '1') { ?>
			<div id="area_imprimible_invisible_cocina" style="width: 99%;text-align: center;">
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center; width: 99%; font-family: Courier; font-size:12pt;"><strong><?php echo $nombre_emp; ?></strong></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TICKET</strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?> | <?php echo $fecha_hora; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>USUARIO (A): <?php echo $usario_vendedor; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>ID: <?php echo $cod_info_factura_strpad; ?></strong></td>
			  </tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
			<tr>
			<th style="text-align: center; width:10%; font-family: Courier; font-size:7pt;">CANT</th>
			<th style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"></th>
			<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:7pt;">..</th><?php } ?>
			<th style="text-align: center; width:50%; font-family: Courier; font-size:8pt;">DESCRIPCION</th>
			<th style="text-align: center; width:15%; font-family: Courier; font-size:7pt;">P.TOTAL</th>
			<th style="text-align: center; width:5%; font-family: Courier; font-size:7pt;"></th>
			</tr>
			<?php
			$total_venta_temp = 0;
			$condicional_entero = "";

			$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
			$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
			while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

				$cod_producto                = $info_venta['cod_producto'];
				$cod_producto_barra          = $info_venta['cod_producto_barra'];
				$nombre_producto             = $info_venta['nombre_producto'];
				$und_venta                   = $info_venta['und_venta'];
				$comentario_producto         = $info_venta['comentario_producto'];
				$precio_venta_producto       = $info_venta['precio_venta_producto'];
				$total_venta_producto        = $info_venta['total_venta_producto'];
				$total_venta_temp           += $total_venta_producto;
				$comentario_producto         = $info_venta['comentario_producto'];
				$und_caja_sobre              = $info_venta['und_caja_sobre'];
				$cajas_sobre                 = $info_venta['cajas_sobre'];
				$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
				$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

			  if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
			  //if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
			  if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
			  if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
			?>
			<tr>
			<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta ?></strong></td>
			<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_tipo_und_caja_sobre ?></strong></td>
			<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
			<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:5%; font-family: Courier; font-size:5pt;"><strong></strong></td>
			</tr>
			<?php } ?>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>TOTAL</strong></td>
			<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>ABANADO</strong></td>
			<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>PENDIENTE</strong></td>
			<td style="text-align: center; width:5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
			</tr>
			<tr>
			<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
			<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
			<td style="text-align: center; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
			<td style="text-align: center; width:5%; font-family: Courier; font-size:5pt;"><strong></strong></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_zapateria_php"></div></td>
			  </tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrmzap58 ==></strong></td>
			  </tr>
			</table>
			</div>
		<?php } ?>

	<?php } else { ?>

		<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
			<tr>
			<td style="text-align: center; width: 98%; font-family: Helvetica; font-weight: bold; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
			</tr>
			</table>
		<?php } ?>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		<tr>
		<td style="text-align: center; width: 99%; font-family: Helvetica; font-weight: bold; font-size:10pt;"><?php echo $nombre_emp; ?></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		<tr>
		<th style="text-align: center; width: 99%; font-family: Helvetica; font-weight: bold; font-size:7pt;"><?php echo $localidad_emp; ?></th>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		<tr>
		<th style="text-align: center; width: 99%; font-family: Helvetica; font-weight: bold; font-size:7pt;">NIT: <?php echo $nit_empresa_emp; ?></th>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		<tr>
		<th style="text-align: center; width: 99%; font-family: Helvetica; font-weight: bold; font-size:7pt;">DIRECCION: <?php echo $direccion_emp; ?></th>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		<tr>
		<th style="text-align: center; width: 99%; font-family: Helvetica; font-weight: bold; font-size:7pt;">TELEFONO: <?php echo $telefono_emp; ?></th>
		</tr>
		</table>


		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>


		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		  <tr>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:8pt;">FECHA: <?php echo $fecha_anyo; ?>|<?php echo $fecha_hora; ?></th>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:8pt;"><?php echo $factura_venta_orden_venta; ?>: <?php echo $prefijo_resolucion_facturacion.' '.$cod_factura; ?></th>
		  </tr>
		  <tr>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></th>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">TIPO DE PAGO: <?php echo $nombre_tipo_pago; ?></th>
		  </tr>
		  <tr>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;"><?php echo $nombre_tipo_identificacion; ?> CLIENTE: <?php echo $cedula_cli.$digito_tercero; ?></th>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">CLIENTE: <?php echo utf8_decode($nombre_cliente); ?></th>
		  </tr>
		  <tr>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">CAJA: <?php echo $cod_caja; ?></th>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;"><?php echo $nombre_concepto_multi_virtual; ?> VIRTUAL: <?php echo $cod_base_caja; ?></th>
		  </tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
		  <tr>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">VENDEDOR (A): <?php echo $usario_vendedor; ?></th>
		    <?php if ($cod_estado_peso_producto_global == '1') { ?>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">TOTAL PESO (KG): <?php echo number_format($total_peso_producto, 0, ",", "."); ?></th>
		    <?php } ?>
		  </tr>
		  <tr>
		    <?php if ($cod_estado_domiciliario_global == '1') { ?>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">DOMICILIARIO: <?php echo $usario_domiciliario; ?></th>
		    <?php } ?>
		  </tr>

		  <tr>
		  	<?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?>
		    <th style="text-align: left; width: 95%; font-family: Helvetica; font-weight: bold; font-size:7pt;">PUNTOS REDIMIBLES ACUMULADOS: <?php echo intval($total_puntos_redimibles_campanya_tercero); ?></th>
		    <?php } ?>
		  </tr>

		  <?php if ($cod_estado_renta_alquiler_global == '1' && $cod_estado_alquiler_renta == '1') { ?>
		  <tr>
		    <th style="text-align: left; width: 95%; font-family: Helvetica; font-weight: bold; font-size:7pt;">FECHA INICIO <?php echo ($nombre_tipo_plan_alquiler_defect_global); ?>: <?php echo ($fecha_ini_renta_alquiler); ?></th>
		  </tr>
		  <tr>
		    <th style="text-align: left; width: 95%; font-family: Helvetica; font-weight: bold; font-size:7pt;">FECHA FINAL <?php echo ($nombre_tipo_plan_alquiler_defect_global); ?>: <?php echo ($fecha_fin_renta_alquiler); ?></th>
		  </tr>
		  <?php } ?>

		  <?php if (($cod_tipo_pago == '2') && ($cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global == '1')) { ?>
		  <tr>
		    <th style="text-align: left; width: 49%; font-family: Helvetica; font-weight: bold; font-size:7pt;">SALDO PENDIENTE: <?php echo number_format($saldo_pendiente_cuenta_cobrar, 0, ",", "."); ?></th>
		  </tr>
		  <?php } ?>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>

		<?php if ($cod_estado_modelo_factura_tirilla_avenidajuan_global == '0') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Helvetica; font-weight: bold; font-size:7pt;">
				<tr>
					<th style="text-align: center; width:25%; font-family: Helvetica; font-weight: bold; font-size:7pt;">CODIGO</th>
					<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Helvetica; font-weight: bold; font-size:7pt;">..</th><?php } ?>
					<th style="text-align: center; width:30%; font-family: Helvetica; font-weight: bold; font-size:7pt;">DESCRIPCION</th>
					<th style="text-align: center; width:10%; font-family: Helvetica; font-weight: bold; font-size:7pt;">VALOR</th>
					<th style="text-align: center; width:5%; font-family: Helvetica; font-weight: bold; font-size:7pt;"></th>
				</tr>
			<?php
			if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }

			$resultado_sql = "SELECT $select_productos_imp 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
			AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')
			$condcional_mostrar_subproductos_imprimir $agrupar_productos_imp $ordenamiento ";
			$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
			while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

				$cod_producto                   = $info_venta['cod_producto'];
				$cod_producto_barra             = $info_venta['cod_producto_barra'];
				$nombre_producto                = $info_venta['nombre_producto'];
				$und_venta                      = $info_venta['und_venta'];
				$precio_venta_producto          = $info_venta['precio_venta_producto'];
				$total_venta_producto           = $info_venta['total_venta_producto'];
				$iva_ptj                        = $info_venta['iva_ptj'];
				$precio_ipc                     = $info_venta['precio_ipc'];
				$comentario_producto            = $info_venta['comentario_producto'];
				$und_caja_sobre                 = $info_venta['und_caja_sobre'];
				$cajas_sobre                    = $info_venta['cajas_sobre'];
				$nombre_tipo_und_caja_sobre     = $info_venta['nombre_tipo_und_caja_sobre'];
				$nombre_tipo_unidad_medida      = $info_venta['nombre_tipo_unidad_medida'];
				$cedula                         = $info_venta['cedula'];
				$nombre_cliente                 = $info_venta['nombre_cliente'];
				$und_caja_sobre                 = $info_venta['und_caja_sobre'];

				if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
				//if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
				if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
				if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

				$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
				$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
				$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

				$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

				if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
				if ($cajas_sobre == '0') { $cajas_sobre = 1; }
				if ($und_caja_sobre == '0' || $und_caja_sobre == '0.00') { $und_caja_sobre = 1; }

				if ($cod_estado_converir_und_a_caja_mostrar_imprimir_global == '1') { 
					if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
						$und_venta = ($und_venta); 
						$nombre_tipo_unidad_medida = 'UND'; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
						$precio_venta_producto = ($precio_venta_producto); 
					} else { 
						$und_venta = ($und_venta / $cajas_sobre); 
						$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
						$precio_venta_producto = ($precio_venta_producto * $cajas_sobre);
					}
				} else { 
					if ($nombre_tipo_unidad_medida == 'CAJA') {
						$und_venta = ($info_venta['und_venta'] / $cajas_sobre); 
						$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
						$precio_venta_producto = ($precio_venta_producto * $cajas_sobre);
						$und_venta_alter = ($info_venta['und_venta'] / $cajas_sobre); 
					}
					elseif ($nombre_tipo_unidad_medida == 'SOBRE') { 
						$und_venta = ($info_venta['und_venta'] / $cajas_sobre); 
						$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
						$precio_venta_producto = ($precio_venta_producto * $cajas_sobre);
						$und_venta_alter = ($info_venta['und_venta'] / $cajas_sobre); 
					} else { 
						$und_venta = ($und_venta); 
						$nombre_tipo_unidad_medida = 'UND'; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
						$precio_venta_producto = ($precio_venta_producto);
					}
				}
			?>
				<tr>
					<td style="text-align: left; width:25%; font-family: Helvetica; font-weight: bold; font-size:8pt;"><?php echo $cod_producto_barra.'<br>'.$und_venta.' '.$nombre_tipo_unidad_medida.' X '.number_format($precio_venta_producto, 0, ",", ".") ?></td>
					<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Helvetica; font-weight: bold; font-size:7pt;"><?php echo $comentario_producto ?></td><?php } ?>
					<td style="text-align: left; width:30%; font-family: Helvetica; font-weight: bold; font-size:7pt;"><?php echo $nombre_producto ?></td>
					<td style="text-align: right; width:10%; font-family: Helvetica; font-weight: bold; font-size:8pt;"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></td>
					<td style="text-align: left; width:5%; font-family: Helvetica; font-weight: bold; font-size:5pt;"><?php echo $nombre_tipo_iva ?></td>
				</tr>
			<?php } ?>
			</table>
		<?php } else { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
				<tr>
					<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;">CANT</th>
					<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"></th>
					<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;">..</th><?php } ?>
					<th style="text-align: center; width:50%; font-family: Courier; font-size:9pt;">DESCRIPCION</th>
					<th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;">P.UNIT</th>
					<th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;">P.TOTAL</th>
					<th style="text-align: center; width:10%; font-family: Courier; font-size:5pt;"></th>
				</tr>
			<?php
			if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }

			$resultado_sql = "SELECT $select_productos_imp 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
			AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')
			$condcional_mostrar_subproductos_imprimir $agrupar_productos_imp $ordenamiento";
			$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
			while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

				$cod_producto                   = $info_venta['cod_producto'];
				$cod_producto_barra             = $info_venta['cod_producto_barra'];
				$nombre_producto                = $info_venta['nombre_producto'];
				$und_venta                      = $info_venta['und_venta'];
				$precio_venta_producto          = $info_venta['precio_venta_producto'];
				$total_venta_producto           = $info_venta['total_venta_producto'];
				$iva_ptj                        = $info_venta['iva_ptj'];
				$precio_ipc                     = $info_venta['precio_ipc'];
				$comentario_producto            = $info_venta['comentario_producto'];
				$und_caja_sobre                 = $info_venta['und_caja_sobre'];
				$cajas_sobre                    = $info_venta['cajas_sobre'];
				$nombre_tipo_und_caja_sobre     = $info_venta['nombre_tipo_und_caja_sobre'];
				$nombre_tipo_unidad_medida      = $info_venta['nombre_tipo_unidad_medida'];
				$cedula                         = $info_venta['cedula'];
				$nombre_cliente                 = $info_venta['nombre_cliente'];
				$und_caja_sobre                 = $info_venta['und_caja_sobre'];

				if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
				//if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
				if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
				if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

				$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
				$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
				$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

				$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

				if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
				if ($cajas_sobre == '0') { $cajas_sobre = 1; }
				if ($und_caja_sobre == '0' || $und_caja_sobre == '0.00') { $und_caja_sobre = 1; }

				if ($cod_estado_converir_und_a_caja_mostrar_imprimir_global == '1') { 
					if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
						$und_venta = ($und_venta); 
						$nombre_tipo_unidad_medida = 'UND'; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
						$precio_venta_producto = ($precio_venta_producto); 
					} else { 
						$und_venta = ($und_venta / $cajas_sobre); 
						$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
						$precio_venta_producto = ($precio_venta_producto * $cajas_sobre);
					}
				} else { 
					if ($nombre_tipo_unidad_medida == 'CAJA') {
						$und_venta = ($info_venta['und_venta'] / $cajas_sobre); 
						$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
						$precio_venta_producto = ($precio_venta_producto * $cajas_sobre);
						$und_venta_alter = ($info_venta['und_venta'] / $cajas_sobre); 
					}
					elseif ($nombre_tipo_unidad_medida == 'SOBRE') { 
						$und_venta = ($info_venta['und_venta'] / $cajas_sobre); 
						$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
						$precio_venta_producto = ($precio_venta_producto * $cajas_sobre);
						$und_venta_alter = ($info_venta['und_venta'] / $cajas_sobre); 
					} else { 
						$und_venta = ($und_venta); 
						$nombre_tipo_unidad_medida = 'UND'; 
						$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
						$precio_venta_producto = ($precio_venta_producto);
					}
				}
			?>
				<tr>
					<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><?php echo $und_venta ?></th>
					<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><?php echo $nombre_tipo_unidad_medida ?></th>
					<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: left; width:10%; font-family: Courier; font-size:9pt;"><?php echo $comentario_producto ?></th><?php } ?>
					<th style="text-align: left; width:50%; font-family: Courier; font-size:9pt;"><?php echo $nombre_producto ?></th>
					<th style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></th>
					<th style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></th>
					<th style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><?php echo $nombre_tipo_iva ?></th>
				</tr>
			<?php } ?>
			</table>
		<?php } ?>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
		<tr>
		<td style="text-align: center;"><=============================================></td>
		</tr>
		</table>

		<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt; border-spacing: 1px;">
		  <tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">SUBTOTAL:</th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">$DESCUENTO:</th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo $existe_descuento_factura_signo ?> <?php echo number_format(abs($total_descuentos_manual_y_en_el_precio_venta), 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php if ($nombre_producto_puntos_redimibles <> '') { ?>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_puntos_redimibles ?>:</th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo $existe_descuento_puntos_redimibles_signo ?> <?php echo number_format(abs($total_descuento_puntos_redimibles_como_concepto), 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php } ?>
		<tr>
		    <!--<th style="text-align: center; width: 9%; font-family: Helvetica; font-size:7pt;">%DESCUENTO</th>-->
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">$TOTAL DESCUENTO:</th>
		    <!--<th style="text-align: center; width: 9%; font-family: Helvetica; font-size:7pt;"><?php echo intval($descuento_ptj_dif) ?>%</th>-->
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo $existe_descuento_factura_signo ?> <?php echo number_format(abs($total_descuento_venta), 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>

		<?php if ($regimen_emp == 'RESPONSABLE_DE_IVA') { ?>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">IVA:</th>
			<th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($total_iva, 0, ",", ".") ?></th>
			<th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php } ?>

		<?php if ($nombre_producto_retefuente <> '') { ?>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_retefuente ?> (<?php echo $retefuente_ptj ?>%):</th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format(($total_descuento_retefuente), 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php } ?>

		<?php if ($existe_servicio_propina <> '0') { ?>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_propina." (".$ptj_servicio_propina."%):" ?></th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($total_venta_producto_propina, 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php } ?>

		<?php if ($existe_servicio_cupobrilla <> '0') { ?>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_cupobrilla." (".$ptj_servicio_cupobrilla."%):" ?></th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($total_venta_producto_cupobrilla, 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php } ?>

		<?php if ($existe_servicio_domicilio <> '0') { ?>
		<tr>
		    <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_domicilio ?>:</th>
		    <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($total_venta_producto_domicilio, 0, ",", ".") ?></th>
		    <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
		</tr>
		<?php } ?>
		</table>


		<?php if ($cod_tipo_pago == '1') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:7pt;"><strong>RECIBIDO <?php echo $nombre_tipo_forma_pago ?></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:9pt;"><strong>CAMBIO</strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:10pt;"><strong>TOTAL</strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:9pt;"><strong><?php echo number_format($vlr_cancelado, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:9pt;"><strong><?php echo number_format($vlr_cambio, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			  </tr>
			</table>
		<?php } else { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:9pt;"><strong></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:10pt;"><strong>TOTAL</strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			    <td style="text-align: center; width: 40%; font-family: Helvetica; font-size:9pt;"><strong></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
			    <td style="text-align: center; width: 10%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			  </tr>
			</table>
		<?php } ?>


		<?php if ($cod_estado_btn_imp_pos_nav_orden_compra_global == '0') { ?>
			<?php if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') { ?>
			<?php } else { ?>
				<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
				<tr>
				<td style="text-align: center;"><=============================================></td>
				</tr>
				</table>

				<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
				<tr>
				<td style="text-align: center; width:20%; font-family: Helvetica; font-size:7pt;"><strong>RESUMEN DE IMPUESTOS</strong></td>
				</tr>
				</table>

				<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
				<tr>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong>TIPO</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong>COMPRA</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong>BASE/IMP</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong>IVA</strong></td>
				</td>
				<?php
				$cod_servicio_propina                                 = '22222222';
				$cod_servicio_cava                                    = '55555555';
				$cod_servicio_domicilio                               = '44444444';
				$cod_servicio_descuento_punto_redimible               = '11112222';
				$cod_servicio_descuento                               = '33333333';
				$cod_servicio_imp_bolsa                               = '11111111';
				$cod_servicio_retefuente                              = '11113333';
			
				$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
				Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
				Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
				FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19') 
				AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
				$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
				$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

				$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
				$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
				$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
				//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

				$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
				Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
				Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
				FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5') 
				AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
				$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
				$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

				$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
				$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
				$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
				//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

				$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
				Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
				Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
				FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0') 
				AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
				$consulta_total_tipos_iva_0 = mysqli_query($conectar, $sql_total_tipos_iva_0) or die(mysqli_error($conectar));
				$datos_total_tipos_iva_0 = mysqli_fetch_assoc($consulta_total_tipos_iva_0);

				$total_venta_0                         = $datos_total_tipos_iva_0['total_venta'];
				$total_base_iva_0                      = $datos_total_tipos_iva_0['total_base_iva'];
				$total_iva_0                           = $datos_total_tipos_iva_0['total_iva'];
				//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;

				$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc) AS total_precio_ipc
				FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
				$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
				$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

				$total_precio_ipc                      = $datos_total_tipos_iva_ipc['total_precio_ipc'];
				$total_valor_base                      = $total_base_iva_19 + $total_base_iva_5 + $total_base_iva_0;
				$total_valor_iva                       = $total_iva_19 + $total_iva_5 + $total_iva_0;
				$total_valor_total                     = $total_venta_19 + $total_venta_5 + $total_venta_0;
				//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;
				/*
				$resultado_sql = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva";
				$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
				while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

				$nombre_tipo_iva             = $info_venta['nombre_tipo_iva'];
				$descripcion_tipo_iva        = $info_venta['descripcion_tipo_iva'];
				$iva                         = $info_venta['iva'];

				$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
				Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
				Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
				FROM tbl15_venta_producto WHERE (iva_ptj = '$iva_ptj')";
				$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
				$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

				$total_venta                         = $datos_total_tipos_iva['total_venta'];
				$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
				$total_iva                           = $datos_total_tipos_iva['total_iva'];
				*/
				?>
				<tr>
				<td style="text-align: left; width:10%; font-family: Helvetica; font-size:7pt;"><strong>G=19%</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_venta_19, 0, ",", ".") ?></strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_base_iva_19, 0, ",", ".") ?></strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_iva_19, 0, ",", ".") ?></strong></td>
				</tr>
				<tr>
				<td style="text-align: left; width:10%; font-family: Helvetica; font-size:7pt;"><strong>S=5%</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_venta_5, 0, ",", ".") ?></strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_base_iva_5, 0, ",", ".") ?></strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_iva_5, 0, ",", ".") ?></strong></td>
				</tr>
				<tr>
				<td style="text-align: left; width:10%; font-family: Helvetica; font-size:7pt;"><strong>A=0%</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_venta_0, 0, ",", ".") ?></strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_base_iva_0, 0, ",", ".") ?></strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_iva_0, 0, ",", ".") ?></strong></td>
				</tr>
				<?php //} ?>
				</table>
			<?php } ?>

			<?php 
			$sql_total_imp_bolsa = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
			Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
			Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_imp_bolsa')";
			$consulta_total_imp_bolsa = mysqli_query($conectar, $sql_total_imp_bolsa) or die(mysqli_error($conectar));
			$total_imp_bolsa = mysqli_num_rows($consulta_total_imp_bolsa);
			$datos_total_imp_bolsa = mysqli_fetch_assoc($consulta_total_imp_bolsa);

			$total_venta_imp_bolsa                 = $datos_total_imp_bolsa['total_venta'];
			$total_base_iva_imp_bolsa              = $datos_total_imp_bolsa['total_base_iva'];
			$total_iva_imp_bolsa                   = $datos_total_imp_bolsa['total_iva'];

			if (intval($total_venta_imp_bolsa) == '0') { } else { ?>
				<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
				<tr>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong>IMP A LA BOLSA</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_venta_imp_bolsa, 0, ",", ".") ?></strong></td>
				</tr>
				</table>
			<?php } ?>


			<?php 
			$sql_total_impoconsumo = "SELECT Sum(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
			WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
			$consulta_total_impoconsumo = mysqli_query($conectar, $sql_total_impoconsumo) or die(mysqli_error($conectar));
			$total_impoconsumo = mysqli_num_rows($consulta_total_impoconsumo);
			$datos_total_impoconsumo = mysqli_fetch_assoc($consulta_total_impoconsumo);

			$total_impoconsumo                     = $datos_total_impoconsumo['total_impoconsumo'];

			if (intval($total_impoconsumo) == '0') { } else { ?>
				<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
				<tr>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong>I = IMPO CONSUMO</strong></td>
				<td style="text-align: left; width:20%; font-family: Helvetica; font-size:7pt;"><strong><?php echo number_format($total_impoconsumo, 0, ",", ".") ?></strong></td>
				</tr>
				</table>
			<?php } ?>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><strong>FACTURA <?php echo $nombre_tipo_resolucion_facturacion ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><strong>RESOLUCION DIAN: <?php echo $numero_resolucion_facturacion ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><strong>DESDE <?php echo $prefijo_resolucion_facturacion ?> <?php echo ($ini_resolucion_facturacion) ?> AL <?php echo $prefijo_resolucion_facturacion ?> <?php echo $fin_resolucion_facturacion ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><strong>REGIMEN <?php echo $regimen_emp ?></strong></td>
			  </tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;">****************************************</td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><strong>Muchas gracias por su preferencia</strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;">****************************************</td>
			  </tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:7pt;"><div id="codigo_codabar_php"></div></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:7pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:7pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
			  </tr>
			</table>

			<?php if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><br></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;">CUFE: <?php echo $cod_cufe_parte1."<br>".$cod_cufe_parte2 ?></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><br></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><?php echo $url_vpfe_dian_qr ?></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><img id="qr_factura_electronica"></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_agente_dian_contribuyente ?></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_agente_dian_retenedor ?></th>
			  </tr>
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_agente_dian_autoretenedor ?></th>
			  </tr>
			</table>
			<?php } ?>

			<?php if ($qr_pago_bancolombia <> '') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><img id="qr_pago_bancolombia"><br>Cuenta Bancolombia Ahorros: <?php echo $numero_cuenta_pago_bancolombia ?></th>
			  </tr>
			</table>
			<?php } ?>


			<?php if ($cod_estado_encuesta_experiencia_compra_global == '1') { ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			<tr>
			<td style="text-align: center;"><=============================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:7pt;"><strong>Califica tu experiencia de compra en</strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:7pt;"><strong><?php echo $url_encuesta_experiencia_compra ?></strong></td>
			  </tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 32%; font-family: Helvetica; font-size:7pt;">.</td>
			    <td style="text-align: center; width: 32%; font-family: Helvetica; font-size:7pt;"><div id="qrcode"></div></td>
			    <td style="text-align: center; width: 32%; font-family: Helvetica; font-size:7pt;">.</td>
			  </tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 32%; font-family: Helvetica; font-size:7pt;">.</td>
			    <td style="text-align: center; width: 32%; font-family: Helvetica; font-size:7pt;"><strong>ESCANEAME</strong></td>
			    <td style="text-align: center; width: 32%; font-family: Helvetica; font-size:7pt;">.</td>
			  </tr>
			</table>
			<?php } ?>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 99%; font-family: Helvetica; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrm80 ==></strong></td>
			  </tr>
			</table>
		<?php } ?>

		<?php if ($cod_estado_btn_imprimir_venta_nav_zapateria_global == '1') { ?>
			<div id="area_imprimible_invisible_cocina" style="width: 99%;text-align: center;">
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center; width: 99%; font-family: Helvetica; font-size:12pt;"><strong><?php echo $nombre_emp; ?></strong></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:8pt;"><strong>TICKET</strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Helvetica; font-size:8pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Helvetica; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?> | <?php echo $fecha_hora; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Helvetica; font-size:8pt;"><strong>CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Helvetica; font-size:8pt;"><strong>USUARIO (A): <?php echo $usario_vendedor; ?></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: left; width: 98%; font-family: Helvetica; font-size:8pt;"><strong>ID: <?php echo $cod_info_factura_strpad; ?></strong></td>
			  </tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center; width:10%; font-family: Helvetica; font-size:7pt;"><strong>CANT</strong></td>
			<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Helvetica; font-size:7pt;">..</th><?php } ?>
			<td style="text-align: center; width:50%; font-family: Helvetica; font-size:8pt;"><strong>DESCRIPCION</strong></td>
			<td style="text-align: center; width:15%; font-family: Helvetica; font-size:7pt;"><strong>P.TOTAL</strong></td>
			<td style="text-align: center; width:5%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			</tr>
			<?php
			$total_venta_temp = 0;
			$condicional_entero = "";

			$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
			$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
			while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

				$cod_producto                = $info_venta['cod_producto'];
				$cod_producto_barra          = $info_venta['cod_producto_barra'];
				$nombre_producto             = $info_venta['nombre_producto'];
				$und_venta                   = $info_venta['und_venta'];
				$comentario_producto         = $info_venta['comentario_producto'];
				$precio_venta_producto       = $info_venta['precio_venta_producto'];
				$total_venta_producto        = $info_venta['total_venta_producto'];
				$total_venta_temp           += $total_venta_producto;
				$comentario_producto         = $info_venta['comentario_producto'];
				$und_caja_sobre              = $info_venta['und_caja_sobre'];
				$cajas_sobre                 = $info_venta['cajas_sobre'];
				$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
				$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

			  if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
			  //if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
			  if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
			  if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
			?>
			<tr>
			<td style="text-align: center; width:10%; font-family: Helvetica; font-size:8pt;"><strong><?php echo $und_venta ?></strong></td>
			<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Helvetica; font-size:7pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
			<td style="text-align: left; width:50%; font-family: Helvetica; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
			<td style="text-align: right; width:14%; font-family: Helvetica; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
			<td style="text-align: left; width:5%; font-family: Helvetica; font-size:5pt;"><strong></strong></td>
			</tr>
			<?php } ?>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center; width:10%; font-family: Helvetica; font-size:7pt;"><strong>TOTAL</strong></td>
			<td style="text-align: center; width:50%; font-family: Helvetica; font-size:8pt;"><strong>ABANADO</strong></td>
			<td style="text-align: center; width:15%; font-family: Helvetica; font-size:7pt;"><strong>PENDIENTE</strong></td>
			<td style="text-align: center; width:5%; font-family: Helvetica; font-size:7pt;"><strong></strong></td>
			</tr>
			<tr>
			<td style="text-align: center; width:10%; font-family: Helvetica; font-size:8pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
			<td style="text-align: center; width:50%; font-family: Helvetica; font-size:8pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
			<td style="text-align: center; width:14%; font-family: Helvetica; font-size:8pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
			<td style="text-align: center; width:5%; font-family: Helvetica; font-size:5pt;"><strong></strong></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			<tr>
			<td style="text-align: center;"><=======================================></td>
			</tr>
			</table>

			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:8pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:8pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
			  </tr>
			  <tr>
			    <td style="text-align: center; width: 98%; font-family: Helvetica; font-size:8pt;"><div id="codigo_codabar_zapateria_php"></div></td>
			  </tr>
			</table>
			<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
			  <tr>
			    <td style="text-align: center; width: 99%; font-family: Helvetica; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrmzap80 ==></strong></td>
			  </tr>
			</table>
			</div>
		<?php } ?>

	</div>
	<?php } ?>

<?php } ?>
<!--</div>-->
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
	<script>
	window.onload = function() {
	var cod_estado_habilitar_btn_imp_venta_nav_global = "<?php echo $cod_estado_habilitar_btn_imp_venta_nav_global ?>";

	if (cod_estado_habilitar_btn_imp_venta_nav_global == '0') {
		document.getElementById("foco_btn_imprimir").focus();
	} else {
		document.getElementById("btnImprimir").focus();
	}
	}
	</script>

	<script>  
	$(document).ready(function(){  
	  $('#btnImprimir').click(function(){
	  var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;  
	    $.ajax({ url:"imprimir_factura_venta_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta }, 
	     success: function(response){
	         if(response==1){
	             //alert('Imprimiendo....');
	         }else{
	             //alert('Error');
	         }
	     }
	    });
	  document.getElementById("listo").focus();  
	  });
	});  
	</script>

	<script> 
	$(document).ready(function(){  
	  $('#btnAbrirCaja').click(function(){
	  var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;
	    $.ajax({ url:"imprimir_abrir_caja_reg_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta }, 
	     success: function(response){
	         if(response==1){
	             //alert('Imprimiendo....');
	         }else{
	             //alert('Error');
	         }
	     }
	    });
	  document.getElementById("listo").focus();  
	  });
	});  
	</script>

	<script type="text/javascript">
	/*
	var qrcode = new QRCode(document.getElementById("qrcode"), {
	  width : 60,
	  height : 60
	});
	function makeCode () {    
	  var text = "https://editaxe.xyz";
	  qrcode.makeCode(text);
	}
	makeCode();
	*/
	</script>

<?php if ($qr_pago_bancolombia <> '0') { ?>
	<script type="text/javascript">
	$(document).ready(function() {
		var generar_qr_pago_bancolombia = "<?php echo $qr_pago_bancolombia;?>";
		new QRious({
			element: document.getElementById("qr_pago_bancolombia"),
			value: generar_qr_pago_bancolombia, // La URL o el texto
			size: 120,
			backgroundAlpha: 0, // 0 para fondo transparente
			foreground: "#000", // Color del QR
			level: "L", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
		});
	});
	</script>
<?php } ?>

<?php if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA') { ?>

<script type="text/javascript">
$(document).ready(function() {
	var cod_cufe = "<?php echo $cod_cufe;?>";
	var url_vpfe_dian = "https://catalogo-vpfe.dian.gov.co/document/searchqr";
	var url_vpfe_dian_qr = url_vpfe_dian+"?documentkey="+cod_cufe;
	new QRious({
		element: document.getElementById("qr_factura_electronica"),
		value: url_vpfe_dian_qr, // La URL o el texto
		size: 120,
		backgroundAlpha: 0, // 0 para fondo transparente
		foreground: "#000", // Color del QR
		level: "L", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
	});
});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.EnviarFacturaDianDataico').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_venta = $(this).parent().attr('data');
        var tab = "tbl15_info_factura_venta";
        var campo = "cod_info_factura_venta";
        var tipo_ajax = "tbl15_info_factura_venta";
        var cod_resolucion_facturacion = "<?php echo $cod_resolucion_facturacion;?>";
        var pagina = "<?php echo $pagina;?>";

        var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

        $.ajax({
            type: "GET",
            url: "../admin/enviar_datos_factura_venta_dian_json.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
            },
            success:function(respuesta){

                if(respuesta.errors) {
                    var dataico_dian_error = respuesta.errors[0].error;
                    var dataico_dian_path = respuesta.errors[0].path;
                    var error_respuesta = "Error";
                    var imagen_status_error = "../imagenes/error.jpg";
                    var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
                    var imagen_status_dataico = "../imagenes/btn_dataico_gris.png";
                    var resultado_envio_dian = "No Enviado a la Dian";
                    var resultado_envio_dataico = "No Enviado a Dataico";
                    var imagen_status = "../imagenes/error.jpg";


                    var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina+'&'+'dataico_dian_error='+dataico_dian_error+'&'+'dataico_dian_path='+dataico_dian_path;
                    $.ajax({
                        type: "POST",
                        url: "../admin/guardar_factura_venta_enviada_error_dian_dataico_json_ajax.php",
                        data: datos_url_ajax,
                        beforeSend: function(objeto){
                            //$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                        },
                        success:function(respuesta){
                            if (respuesta.dataico_dian_error) { var dataico_dian_error = respuesta.dataico_dian_error; } else { var dataico_dian_error = ''; }
                            if (respuesta.dataico_dian_path) { var dataico_dian_path = respuesta.dataico_dian_path; } else { var dataico_dian_path = ''; }

                            $('#apidian'+cod_info_factura_venta).html("");
                            $('#apidian'+cod_info_factura_venta).html('Error: '+dataico_dian_error+'<br>'+dataico_dian_path);
                        }
                    });
                    //$('#resultado_envio_dian'+cod_info_factura_venta).html("<img src="+imagen_status_dian+" class='img-polaroid'>"+"<br>"+resultado_envio_dian);
                    //$('#resultado_envio_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_dataico+" class='img-polaroid'>"+"<br>"+resultado_envio_dataico);
                    $('#enviando_cargador'+cod_info_factura_venta).html("");
                    $('#resultado_error_envio_dian_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_error+" class='img-polaroid'>"+"<br>"+dataico_dian_error+" ["+dataico_dian_path+"]");
                } else {
                    if (respuesta.number) { var cod_factura_prefijo = respuesta.number; } else { var cod_factura_prefijo = ''; }
                    if (respuesta.numbering.prefix) { var prefijo_resolucion_facturacion = respuesta.numbering.prefix; } else { var prefijo_resolucion_facturacion = ''; }
                    if (respuesta.numbering.resolution_number) { var numero_resolucion_facturacion = respuesta.numbering.resolution_number; } else { var numero_resolucion_facturacion = ''; }
                    if (respuesta.email_status) { var dataico_email_status = respuesta.email_status; } else { var dataico_email_status = ''; }
                    if (respuesta.uuid) { var dataico_uuid = respuesta.uuid; } else { var dataico_uuid = ''; }
                    if (respuesta.cufe) { var cod_cufe = respuesta.cufe; } else { var cod_cufe = ''; }
                    if (respuesta.issue_date) { var dataico_issue_date = respuesta.issue_date; } else { var dataico_issue_date = ''; }
                    if (respuesta.dian_messages) { var dataico_dian_messages = respuesta.dian_messages; } else { var dataico_dian_messages = ''; }
                    if (respuesta.payment_date) { var dataico_payment_date = respuesta.payment_date; } else { var dataico_payment_date = ''; }
                    if (respuesta.customer_status) { var dataico_customer_status = respuesta.customer_status; } else { var dataico_customer_status = ''; }
                    if (respuesta.xml_url) { var dataico_xml_url = respuesta.xml_url; } else { var dataico_xml_url = ''; }
                    if (respuesta.validation_date) { var dataico_validation_date = respuesta.validation_date; } else { var dataico_validation_date = ''; }
                    if (respuesta.qrcode) { var dataico_qrcode = respuesta.qrcode; } else { var dataico_qrcode = ''; }
                    if (respuesta.xml) { var dataico_xml = respuesta.xml; } else { var dataico_xml = ''; }
                    if (respuesta.invoice_type_code) { var dataico_invoice_type_code = respuesta.invoice_type_code; } else { var dataico_invoice_type_code = ''; }
                    if (respuesta.pdf_url) { var dataico_pdf_url = respuesta.pdf_url; } else { var dataico_pdf_url = ''; }
                    if (respuesta.dian_status) { var dataico_dian_status = respuesta.dian_status; } else { var dataico_dian_status = ''; }

                    if (dataico_dian_status == 'DIAN_ACEPTADO') {
                        var cod_estado_factura_electronica_enviado_dian = 1;
                        var cod_estado_factura_electronica_enviado_dataico = 1;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dian_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#estadodian'+cod_info_factura_venta).html("");
                                $('#estadodataico'+cod_info_factura_venta).html("");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                            
                                $('#estadodian'+cod_info_factura_venta).html("<img src="+imagen_status_dian+" class='img-polaroid'>");
                                $('#estadodataico'+cod_info_factura_venta).html("<img src="+imagen_status_dataico+" class='img-polaroid'>");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/enviar_historia_clinica_correo.png">');

                            }
                        });
                    } 
                    if (dataico_dian_status == 'DIAN_NO_ENVIADO') {
                        var cod_estado_factura_electronica_enviado_dian = 0;
                        var cod_estado_factura_electronica_enviado_dataico = 1;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
                        
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#estadodian'+cod_info_factura_venta).html("");
                                $('#estadodataico'+cod_info_factura_venta).html("");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                                var longitud_cod_cufe = cod_cufe.length;
                                var mitad_longitud_cod_cufe = longitud_cod_cufe / 2;
                                var cod_cufe_parte1 = cod_cufe.substr(0, mitad_longitud_cod_cufe);
                                var cod_cufe_parte2 = cod_cufe.substr(mitad_longitud_cod_cufe + 1, longitud_cod_cufe);
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";

                                $('#estadodataico'+cod_info_factura_venta).html("<img src="+imagen_status_dataico+" class='img-polaroid'>");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/enviar_historia_clinica_correo.png">');

                            }
                        });
                    } 
                    if (dataico_dian_status == 'DIAN_RECHAZADO') {
                        var cod_estado_factura_electronica_enviado_dian = 0;
                        var cod_estado_factura_electronica_enviado_dataico = 0;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;

                        var dataico_dian_messages = respuesta.dian_messages;

                        $('#apidian'+cod_info_factura_venta).html("");
                        $('#apidian'+cod_info_factura_venta).html(dataico_dian_messages);
/*
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dian_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#estadodian'+cod_info_factura_venta).html("");
                                $('#estadodataico'+cod_info_factura_venta).html("");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                            }
                        });
*/
                    }
                }
            }
        });
    });
});
</script>
<?php } ?>

<?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?>
	<script language="javascript">
	$('#btnGenerarZipFev').click(function(){

	    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta;?>";
	    var url_factura_fev_xml = $(this).parent().attr('data_url_xml');
	    var tab = "info_factura_venta";
	    var campo = "cod_info_factura_venta";
	    var tipo_ajax = "info_factura_venta";
	    var pagina = "<?php echo $pagina;?>";
	    var datos_vacio_url_ajax = '';
	    var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

	    $.ajax({
	        type: "POST",
	        url: "../admin/generar_peticion_curl_dataico_factura_electronica_xml_url_ajax.php",
	        data: datos_url_ajax,
	        beforeSend: function(objeto){
	            $('#btnGenerarZipFev').html('<img src="../imagenes/ajax-loader.gif"> <br> Generando Xml');
	        },
	        success:function(respuesta){
	            var estructura_factura_fev_xml_remota = respuesta;
	            var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'estructura_factura_fev_xml_remota='+estructura_factura_fev_xml_remota+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

	            $.ajax({
	                type: "POST",
	                url: "../admin/guardar_xml_local_dataico_ajax.php",
	                data: datos_url_ajax,
	                beforeSend: function(objeto){
	                    $('#btnGenerarZipFev').html('<img src="../imagenes/ajax-loader.gif"> <br> Guardando Xml');
	                },
	                success:function(respuesta){
	                    var afectado = respuesta.afectado;
	                    //var cod_info_factura_venta = respuesta.cod_info_factura_venta;
	                    //var resultado = respuesta.resultado;

	   					var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
			            $.ajax({
			                type: "POST",
			                url: "../admin/generar_peticion_curl_dataico_factura_electronica_pdf_url_ajax.php",
			                data: datos_url_ajax,
			                beforeSend: function(objeto){
			                    $('#btnGenerarZipFev').html('<img src="../imagenes/ajax-loader.gif"> <br> Generando Pdf');
			                },
			                success:function(respuesta){
			                    var estructura_factura_fev_pdf_remota = respuesta;
			                    //$('#btnGenerarZipFev').html(resultado);

	            				var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'estructura_factura_fev_pdf_remota='+estructura_factura_fev_pdf_remota+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
							    $.ajax({
							        type: "POST",
							        url: "../admin/guardar_pdf_local_dataico_ajax.php",
							        data: datos_url_ajax,
							        beforeSend: function(objeto){
							            $('#btnGenerarZipFev').html('<img src="../imagenes/ajax-loader.gif"> <br> Guardando Xml');
							        },
							        success:function(respuesta){
							           	var afectado = respuesta.afectado;
			                    		$('#btnGenerarZipFev').html('<img src="../imagenes/ajax-loader.gif"> <br> Xml Guardado');
	                    				//var cod_info_factura_venta = respuesta.cod_info_factura_venta;
	                    				//var resultado = respuesta.resultado;
	            						var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'estructura_factura_fev_xml_remota='+estructura_factura_fev_xml_remota+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
							            $.ajax({
							                type: "POST",
							                url: "../admin/generar_zip_xml_pdf_local_dataico_ajax.php",
							                data: datos_url_ajax,
							                beforeSend: function(objeto){
							                    $('#btnGenerarZipFev').html('<img src="../imagenes/ajax-loader.gif"> <br> Generando Zip');
							                },
							                success:function(respuesta){
							                    var resultado = respuesta.resultado;
							                    var salida_ruta_nombre_zip = respuesta.salida_ruta_nombre_zip;
  
							            		$('#btnGenerarZipFev').html('<img src="../imagenes/descargar.png"> <br> Desccargar');


							                }
							            });

							        }
							    });

			                }
			            });

	                }
	            });	            
	        }
	    });
	});
	</script>
<?php } ?>
</body>
</html>