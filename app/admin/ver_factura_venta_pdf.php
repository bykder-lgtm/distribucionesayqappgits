<?php ob_start();?>
<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");

$serguridad_pagina                                    = 1; 
$cod_info_factura_venta                               = intval($_GET['cod_info_factura_venta']);
$fecha                                                = addslashes($_GET['fecha']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina                                               = addslashes($_GET['pagina']).'?cod_info_factura_venta='.$cod_info_factura_venta;
$cod_info_factura_venta_codif                         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
$cod_info_factura_venta_codif_cryp                    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_info_empresa_global = "SELECT qr_pago_bancolombia, numero_cuenta_pago_bancolombia FROM tbl15_info_empresa_global WHERE cod_info_empresa_global = '1'";
$consultar_info_info_empresa_global = mysqli_query($conectar, $sql_info_info_empresa_global) or die(mysqli_error($conectar));
$info_info_empresa_global = mysqli_fetch_assoc($consultar_info_info_empresa_global);

$qr_pago_bancolombia                                  = $info_info_empresa_global['qr_pago_bancolombia'];
$numero_cuenta_pago_bancolombia                       = $info_info_empresa_global['numero_cuenta_pago_bancolombia'];
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
$sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_propina')";
$consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
$existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
$info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

$nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
$precio_venta_producto_propina         = $info_servicio_propina['precio_venta_producto'];
$total_venta_producto_propina          = $info_servicio_propina['total_venta_producto'];
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
$sql_servicio_domicilio = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_domicilio')";
$consulta_servicio_domicilio = mysqli_query($conectar, $sql_servicio_domicilio) or die(mysqli_error($conectar));
$existe_servicio_domicilio = mysqli_num_rows($consulta_servicio_domicilio);
$info_servicio_domicilio = mysqli_fetch_assoc($consulta_servicio_domicilio);

$nombre_producto_domicilio               = $info_servicio_domicilio['nombre_producto'];
$precio_venta_producto_domicilio         = $info_servicio_domicilio['precio_venta_producto'];
$total_venta_producto_domicilio          = $info_servicio_domicilio['total_venta_producto'];	
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
include_once('mpdf/mpdf.php');
$margen_izq                                           = '10';
$margen_der                                           = '10';
$margen_inf_encabezado                                = '5';
$margen_sup_encabezado                                = '10';
$posicion_sup_encabezado                              = '5';
$posicion_inf_encabezado                              = '5';

$titulo_doc_pdf                                       = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$autor_doc_pdf                                        = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$creador_doc_pdf                                      = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$tema_doc_pdf                                         = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$palabras_claves_doc_pdf                              = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$cod_factura_strpad                                   = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad                              = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);
$nombres_completos                                    = "FACTURA";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$headerE = '
';
$headerE = '
';
$footer = '
<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
'.$cufe.'
<tr><td width="100%" style="text-align: center;"><h6>Software '.$titulo_emp.' - Implementado por Proveedor Tecnológico '.$desarrollador_emp.'</h6></td></tr>
<tr><td width="100%" style="text-align: right;"><h6>[Página {PAGENO} de {nbpg}]</h6></td></tr>

</table>
';
$footerE = '
<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
'.$cufe.'
<tr><td width="100%" style="text-align: center;"><h6>Software '.$titulo_emp.' - Implementado por Proveedor Tecnológico '.$desarrollador_emp.'</h6></td></tr>
<tr><td width="100%" style="text-align: right;"><h6>[Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
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
</style>';

$codigoHTML = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center; font-size:8pt;" colspan="2" rowspan="2"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:100px;"></td>
    <td style="text-align:left; font-size:11pt; font-weight: bold;" colspan="2">Factura '.$nombre_tipo_factura.' de Venta:</td>
    <td style="text-align:center; font-size:11pt; font-weight: bold;">'.$prefijo_resolucion_facturacion.' '.$cod_factura.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="3">Representación Gráfica</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:11pt; font-weight: bold;" colspan="2" width="40%">'.$nombre_emp.' NIT '.$propietario_nit_emp.'</td>
    <td style="text-align:left; font-size:7pt;" colspan="3">Habilitación Numeración de Facturación '.$nombre_tipo_factura.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="2">Actividad Económica Principal 4773</td>
    <td style="text-align:left; font-size:7pt;" colspan="3">No. '.$numero_resolucion_facturacion.' de '.$fecha_resolucion_facturacion.' - '.$fecha_vencimiento_resolucion_facturacion.' autoriza '.$prefijo_resolucion_facturacion.'-'.$ini_resolucion_facturacion.' a '.$prefijo_resolucion_facturacion.'-'.$fin_resolucion_facturacion.'</td>
    <td style="text-align:center; font-size:7pt;"></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="2">No somos Agente Retenedor del Impuesto sobre las Ventas - IVA</td>
    <td style="text-align:left; font-size:7pt; width: 20%;">Tipo de Operación</td>
    <td style="text-align:left; font-size:7pt width: 50%;">Estandar</td>
    <td style="text-align:center; font-size:7pt;" rowspan="7"><barcode code="'.$pag_desarrollador_emp.'" size="1" type="QR" error="M" class="barcode" /></td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt;" colspan="2">No somos Autorretenedor del Impuesto sobre la Renta y Complementarios</td>
    <td style="text-align:left; font-size:7pt;">Fecha de Generación</td>
    <td style="text-align:left; font-size:7pt;">'.$fecha_anyo.' '.$fecha_hora.'</td>
  </tr>
  <tr>
  <td style="text-align:center; font-size:7pt;"></td>
  <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Fecha de Vencimiento</td>fecha_anyo
    <td style="text-align:left; font-size:7pt;">'.$fecha_anyo.' '.$fecha_hora.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Fecha de Validación</td>
    <td style="text-align:left; font-size:7pt;">'.$fecha_anyo.' '.$fecha_hora.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Forma de Pago</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_forma_pago.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Medio de Pago</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_pago.'</td>
  </tr>
  <tr>
  <td style="text-align:center; font-size:7pt;" colspan="1" rowspan="0"><barcode code="'.$cod_factura_strpad.'" type="C128A" size="0.6" height="1" /></td>
    <td style="text-align:center; font-size:7pt;"></td>
    <td style="text-align:left; font-size:7pt;">Moneda</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_tipo_moneda.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<hr>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight: bold; width: 50%" colspan="2">DATOS DEL EMISOR / VENDEDOR</td>
    <td style="text-align:center; font-size:11pt; font-weight: bold; width: 50%" colspan="2">DATOS DEL ADQUIRIENTE / COMPRADOR</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Razón Social</td>
    <td style="text-align:left; font-size:7pt;">'.$propietario_nombres_apellidos_emp.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Razón Social </td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_cliente.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Nombre Comercial</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_emp.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Nombre Comercial</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_cliente.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">CC</td>
    <td style="text-align:left; font-size:7pt;">'.$propietario_nit_emp.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">'.$nombre_tipo_identificacion.'</td>
    <td style="text-align:left; font-size:7pt;">'.$cedula_cli.''.$digito_tercero.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Obligación</td>
    <td style="text-align:left; font-size:7pt;">IVA</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Obligación</td>
    <td style="text-align:left; font-size:7pt;">IVA</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Email</td>
    <td style="text-align:left; font-size:7pt;">'.$correo_emp.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Email</td>
    <td style="text-align:left; font-size:7pt;">'.$correo_tercero.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Teléfono</td>
    <td style="text-align:left; font-size:7pt;">'.$telefono_emp.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Teléfono</td>
    <td style="text-align:left; font-size:7pt;">'.$telefono1_tercero.'</td>direccion_emp
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Dirección</td>
    <td style="text-align:left; font-size:7pt;">'.$direccion_emp.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Dirección</td>
    <td style="text-align:left; font-size:7pt;">'.$direccion_tercero.'</td>
  </tr>
  <tr>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Ciudad, Depart.</td>
    <td style="text-align:left; font-size:7pt;">'.$ciudad_emp.', '.$departamento_emp.' '.$abrev_pais.'</td>
    <td style="text-align:left; font-size:7pt; font-weight: bold;">Ciudad, Depart.</td>
    <td style="text-align:left; font-size:7pt;">'.$nombre_ciudad.', '.$nombre_departamento.' '.$abrev_pais.'</td>
  </tr>
</table>
';

   
$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="400" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
          <tr>
            <td style="text-align:center; font-size:6pt;" width="30" valign="top"><strong>No</strong></td>
            <td style="text-align:left; font-size:9pt;" width="50" valign="top"><strong>REF</strong></td>
            <td style="text-align:left; font-size:9pt;" width="220" valign="top"><strong>DESCRIPCIÓN</strong></td>
            <td style="text-align:center; font-size:9pt;" width="40" valign="top"><strong>CANT</strong></td>
            <td style="text-align:center; font-size:9pt;" width="40" valign="top"><strong>U/M</strong></td>
            <!--<td style="text-align:right; font-size:9pt;" width="70" valign="top"><strong>PRECIO</strong></td>-->
            <td style="text-align:right; font-size:9pt;" width="40" valign="top"><strong>IMP</strong></td>
            <td style="text-align:right; font-size:9pt;" width="100" valign="top"><strong>SUBTOTAL</strong></td>
            <td style="text-align:right; font-size:9pt;" width="100" valign="top"><strong>TOTAL ITEM</strong></td>
           </tr>';

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$nombre_producto_cliente          = '';
$contador_item                    = 0;

$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql);
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta) ) { 

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
	//$total_venta_temp              += $total_venta_producto;
	//$total_costo_motivo_consulta   += $total_venta_producto;
	$contador_item++;

	$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
	$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
	$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

	$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

	if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
	if ($nombre_cliente=='') { $nombre_producto_cliente = $nombre_producto; } else { $nombre_producto_cliente = $nombre_cliente.' - '.$nombre_producto; }

	
	if ($cajas_sobre == '0') { $cajas_sobre = 1; }
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
	}

	if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_venta; $und_venta_caja = intval($und_caja_sobre); $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $und_venta_caja = ''; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $und_venta_caja = ''; $subtitulo_tipo_caja = "|UND"; } }
	if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$codigoHTML.='
          <tr>
            <td style="text-align:center; font-size:6pt;">'.$contador_item.'</td>
            <td style="text-align:left; font-size:9pt;">'.$cod_producto_barra.'</td>
            <td style="text-align:left; font-size:9pt;">'.$nombre_producto.'</td>
            <td style="text-align:right; font-size:9pt;">'.$und_venta.'</td>
            <td style="text-align:center; font-size:9pt;">'.$nombre_tipo_unidad_medida.'</td>
            <!--<td style="text-align:right; font-size:9pt;t">'.number_format($precio_venta_producto_antes_de_iva, 0, ",", ".").'</td>-->
            <td style="text-align:right; font-size:9pt;">'.intval($iva_ptj).'</td>
            <td style="text-align:right; font-size:9pt;">'.number_format($precio_venta_producto, 0, ",", ".").'</td>
            <td style="text-align:right; font-size:9pt;">'.number_format($total_venta_producto, 0, ",", ".").'</td>
          </tr>';
}
$codigoHTML.='
        </table>
  </tr>
</table>';

$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" width="20" valign="top">'.$contador_item.'</td>
    <td style="text-align:right" width="354" valign="top">SUBTOTAL:</td>
    <td style="text-align:right" width="250" valign="top">$</td>
    <td style="text-align:right" width="" valign="top">'.number_format($subtotal_base_sin_descuento, 0, ",", ".").'</td>
  </tr>
  <tr>
    <td style="text-align:center" width="20" valign="top"></td>
    <td style="text-align:right" width="354" valign="top">DESCUENTO:</td>
    <td style="text-align:right" width="250" valign="top">$</td>
    <td style="text-align:right" width="" valign="top">'.$existe_descuento_factura_signo.number_format(abs($total_descuentos_manual_y_en_el_precio_venta), 0, ",", ".").'</td>
  </tr>
';
if ($nombre_producto_puntos_redimibles <> '') {
	$codigoHTML.='
	  <tr>
	    <td style="text-align:center" width="20" valign="top"></td>
	    <td style="text-align:right" width="354" valign="top">'.$nombre_producto_puntos_redimibles.':</td>
	    <td style="text-align:right" width="250" valign="top">$</td>
	    <td style="text-align:right" width="" valign="top">'.$existe_descuento_factura_signo.number_format(abs($total_descuento_puntos_redimibles_como_concepto), 0, ",", ".").'</td>
	  </tr>
	';
}
if ($regimen_emp == 'RESPONSABLE_DE_IVA') {
	$codigoHTML.='
	  <tr>
	    <td style="text-align:center" width="20" valign="top"></td>
	    <td style="text-align:right" width="354" valign="top">IVA:</td>
	    <td style="text-align:right" width="250" valign="top">$</td>
	    <td style="text-align:right" width="" valign="top">'.number_format($total_iva, 0, ",", ".").'</td>
	  </tr>
	';
}
if ($nombre_producto_retefuente <> '') {
	$codigoHTML.='
	  <tr>
	    <td style="text-align:center" width="20" valign="top"></td>
	    <td style="text-align:right" width="354" valign="top">'.$nombre_producto_retefuente.' ('.$retefuente_ptj.'%):</td>
	    <td style="text-align:right" width="250" valign="top">$</td>
	    <td style="text-align:right" width="" valign="top">'.number_format($total_descuento_retefuente, 0, ",", ".").'</td>
	  </tr>
	';
}
if ($existe_servicio_propina <> '0') {
	$codigoHTML.='
	  <tr>
	    <td style="text-align:center" width="20" valign="top"></td>
	    <td style="text-align:right" width="354" valign="top">'.$nombre_producto_propina.' ('.$ptj_servicio_propina.'%):'.'</td>
	    <td style="text-align:right" width="250" valign="top">$</td>
	    <td style="text-align:right" width="" valign="top">'.number_format($total_venta_producto_propina, 0, ",", ".").'</td>
	  </tr>
	';
}
if ($existe_servicio_cupobrilla <> '0') {
	$codigoHTML.='
	  <tr>
	    <td style="text-align:center" width="20" valign="top"></td>
	    <td style="text-align:right" width="354" valign="top">'.$nombre_producto_cupobrilla.' ('.$ptj_servicio_cupobrilla.'%):'.'</td>
	    <td style="text-align:right" width="250" valign="top">$</td>
	    <td style="text-align:right" width="" valign="top">'.number_format($total_venta_producto_cupobrilla, 0, ",", ".").'</td>
	  </tr>
	';
}
if ($existe_servicio_domicilio <> '0') {
	$codigoHTML.='
	  <tr>
	    <td style="text-align:center" width="20" valign="top"></td>
	    <td style="text-align:right" width="354" valign="top">'.$nombre_producto_domicilio.':</td>
	    <td style="text-align:right" width="250" valign="top">$</td>
	    <td style="text-align:right" width="" valign="top">'.number_format($total_venta_producto_domicilio, 0, ",", ".").'</td>
	  </tr>
	';
}
$codigoHTML.='
  <tr>
    <td style="text-align:right" valign="top"></td>
    <td style="text-align:right" valign="top">TOTAL A PAGAR:</td>
    <td style="text-align:right" width="250" valign="top">$</td>
    <td style="text-align:right" valign="top">'.number_format($total_venta_temp, 0, ",", ".").'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="45" valign="top">SON:</td>
    <td width="650" valign="top">'.convertir_numeros_a_letras($total_venta_temp).'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td><p><strong>FIRMA EMISOR</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="50px"/></div>
    <div>___________________________________</div><br> 
      <!-- <p><strong>'.$nombres_prof.' '.$apellidos_prof.'</strong></p></td> -->

    <td><p><strong>FIRMA CLIENTE</strong></p>
    <div><img src="../imagenes/firma_vacia.jpg" height="50px"/></div>
    <div>___________________________________</div><br> 
       <!-- <p><strong>'.$nombres_cli.' '.$apellido1_cli.'</strong></p></td> -->
  </tr>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <th style="text-align:center">INFORMACION PARA PAGO</th>
  </tr>
  <tr>
    <th style="text-align:center">
    	<barcode code="'.$qr_pago_bancolombia.'" size="0.65" type="QR" error="M" class="barcode" />
    	<br>
    	Cuenta Bancolombia Ahorros: '.$numero_cuenta_pago_bancolombia.'
    </th>
  </tr>
</table>

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
$nombre_archivo = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa.'.pdf';
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
?>
<?php ob_end_flush(); ?>