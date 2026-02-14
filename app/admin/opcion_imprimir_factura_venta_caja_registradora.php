<?php $serguridad_pagina = 1; ?>
<?php $cod_tipo_accion_caja_registradora = "1"; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<?php include_once('../admin/01_modulo_permisos.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../estilo_css/caja_registradora_jqueryscripttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../estilo_css/caja_registradora_bootstrap.min.css">
<script src="../js/caja_registradora_math.min.js"></script>
<script src="../js/caja_registradora_jquery-3.2.1.min.js"></script>
<script src="../js/caja_registradora_popper.min.js"></script>
<script src="../js/caja_registradora_bootstrap.min.js"></script>

<script src="../js/default.js" type="text/javascript"></script>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../estilo_css/chosen_600px.css">

<link rel="stylesheet" href="../estilo_css/caja_registradora_font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/estilo_caja_registradora.css">

<script type="text/javascript" src="../js/qrious.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<style> .deshabilitar_boton { pointer-events: none; } </style>
</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<body>
<?php 
if (isset($_GET['cod_info_factura_venta'])) {
  $cod_info_factura_venta              = intval($_GET['cod_info_factura_venta']);

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
  $dataico_xml_url                                      = $info_fact['dataico_xml_url'];
  $dataico_customer_status                              = $info_fact['dataico_customer_status'];
  $dataico_validation_date                              = $info_fact['dataico_validation_date'];
  $dataico_qrcode                                       = $info_fact['dataico_qrcode'];
  $dataico_xml                                          = $info_fact['dataico_xml'];
  $dataico_invoice_type_code                            = $info_fact['dataico_invoice_type_code'];
  $dataico_pdf_url                                      = $info_fact['dataico_pdf_url'];
  $dataico_dian_status                                  = $info_fact['dataico_dian_status'];
  $dataico_dian_error                                   = $info_fact['dataico_dian_error'];
  $dataico_dian_path                                    = $info_fact['dataico_dian_path'];
  $cod_estado_factura_electronica_enviado_dian          = $info_fact['cod_estado_factura_electronica_enviado_dian'];
  $cod_estado_factura_electronica_enviado_dataico       = $info_fact['cod_estado_factura_electronica_enviado_dataico'];

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
  $sql_venta_product = "SELECT Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_manual,
  Sum(((und_venta*precio_venta_producto_orig) - ((und_venta*precio_venta_producto_orig)))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_automatico, 
  Sum((und_venta*precio_venta_producto_orig) - (und_venta*precio_venta_producto)) As total_descuento_manual_producto,
  Sum(und_venta*precio_venta_producto_orig) As subtotal_sin_descuento_con_impuestos, 
  SUM((((und_venta * precio_venta_producto_orig) - (und_venta * precio_venta_producto)) + (und_venta * precio_venta_producto)) / ((iva_ptj/100)+(100/100))) As subtotal_con_descuento_e_impuestos, 
  Sum(peso_producto * und_venta) As total_peso_producto 
  FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '11112222')";
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
  WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '33333333')";
  $consulta_venta_descuento_manual_como_concepto = mysqli_query($conectar, $sql_venta_descuento_manual_como_concepto) or die(mysqli_error($conectar));
  $suma_venta_descuento_manual_como_concepto = mysqli_fetch_assoc($consulta_venta_descuento_manual_como_concepto);

  $total_descuento_manual_como_concepto                 = ($suma_venta_descuento_manual_como_concepto['total_descuento_manual_como_concepto']);
  //---------------------------------------------------------------------------------------------------------------------------------//
  $sql_venta_descuento_directamente_en_el_precio_venta = "SELECT Sum((und_venta*precio_venta_producto_orig) - (und_venta*precio_venta_producto)) As total_descuento_directamente_en_el_precio_venta 
  FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '11112222')";
  $consulta_venta_descuento_directamente_en_el_precio_venta = mysqli_query($conectar, $sql_venta_descuento_directamente_en_el_precio_venta) or die(mysqli_error($conectar));
  $suma_venta_descuento_directamente_en_el_precio_venta = mysqli_fetch_assoc($consulta_venta_descuento_directamente_en_el_precio_venta);

  $total_descuento_directamente_en_el_precio_venta      = ($suma_venta_descuento_directamente_en_el_precio_venta['total_descuento_directamente_en_el_precio_venta']);
  //---------------------------------------------------------------------------------------------------------------------------------//
  //---------------------------------------------------------------------------------------------------------------------------------//
  $sql_venta_descuento_puntos_redimibles_como_concepto = "SELECT Sum(total_venta_producto) As total_descuento_puntos_redimibles_como_concepto, nombre_producto FROM tbl15_venta_producto 
  WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '11112222')";
  $consulta_venta_descuento_puntos_redimibles_como_concepto = mysqli_query($conectar, $sql_venta_descuento_puntos_redimibles_como_concepto) or die(mysqli_error($conectar));
  $existe_descuento_puntos_redimibles = intval(mysqli_num_rows($consulta_venta_descuento_puntos_redimibles_como_concepto));
  $suma_venta_descuento_puntos_redimibles_como_concepto = mysqli_fetch_assoc($consulta_venta_descuento_puntos_redimibles_como_concepto);

  $total_descuento_puntos_redimibles_como_concepto      = ($suma_venta_descuento_puntos_redimibles_como_concepto['total_descuento_puntos_redimibles_como_concepto']);
  $nombre_producto_puntos_redimibles                    = ($suma_venta_descuento_puntos_redimibles_como_concepto['nombre_producto']);
  //---------------------------------------------------------------------------------------------------------------------------------//
  //---------------------------------------------------------------------------------------------------------------------------------//
  //---------------------------------------------------------------------------------------------------------------------------------//
  $total_descuentos_manual_y_en_el_precio_venta         = $total_descuento_manual_como_concepto + (-$total_descuento_directamente_en_el_precio_venta);
  $total_suma_de_todos_los_descuentos                   = $total_descuento_manual_como_concepto + $total_descuento_puntos_redimibles_como_concepto + (-$total_descuento_directamente_en_el_precio_venta);
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
  $sql_existe_descuento_manual = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '33333333')";
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
    FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '33333333')";
    $consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
    $existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
    $info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

    $nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
    $precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
    $total_venta_producto_descuento        = $subtotal_base_sin_descuento_manual;
    //$total_descuento_venta                 = $info_servicio_descuento['total_venta_producto'];
    $total_descuento_venta                 = $total_suma_de_todos_los_descuentos;
    $descuento_ptj_dif                     = $info_servicio_descuento['nombre_tipo_precio'];
    $subtotal_base_sin_descuento           = ($subtotal_con_descuento_e_impuestos);
    $existe_descuento_manual               = "SI";
  }
  //---------------------------------------------------------------------------------------------------------------------------------//
  //---------------------------------------------------------------------------------------------------------------------------------//
  if ($cod_estado_deshabilitar_descuento_impresion_venta_global == '1') {
    $subtotal_base_sin_descuento                      = $total_venta_temp;
    $total_descuentos_manual_y_en_el_precio_venta     = 0;
    $total_descuento_venta                            = 0;
  }
  //---------------------------------------------------------------------------------------------------------------------------------//
  //---------------------------------------------------------------------------------------------------------------------------------//
  $sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
  FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '22222222')";
  $consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
  $existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
  $info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

  $nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
  $precio_venta_producto_propina         = $info_servicio_propina['precio_venta_producto'];
  $total_venta_producto_propina          = $info_servicio_propina['total_venta_producto'];
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
  $url_qr                              = $url_encuesta_experiencia_compra."/pageditaxe/admin/inicio.php?cod_info_factura_venta_codif_cryp=";

  if ($cod_estado_btn_imp_pos_nav_orden_compra_global == '1') {
    $factura_venta_orden_venta = 'ORDEN DE PEDIDO';
  }  else {
    $factura_venta_orden_venta = 'FACTURA DE VENTA';
  }
  //---------------------------------------------------------------------------------------------------------------------------------//
  //---------------------------------------------------------------------------------------------------------------------------------//
  $cod_factura_strpad                   = str_pad($cod_factura, 3, "0", STR_PAD_LEFT);
  $cod_info_factura_strpad              = str_pad($cod_info_factura_venta, 3, "0", STR_PAD_LEFT);
  ?>
  
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
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_factura; ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">TIPO DE PAGO:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_pago; ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">TERCERO:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">SUBTOTAL:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", "."); ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">TOTAL VENTA:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_venta_temp, 0, ",", "."); ?></font></td>
    </tr>
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
      <td style="text-align:center;"><a href="../admin/facturacion_caja_registradora.php" class="btn btn-primary">Ir a Caja Registradora</a></td>
      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center;"><button id="btnImprimirVenta"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
      <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_venta_nav_global == '0') { ?>
      <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"><br>IMPRIMIR POS</a></td>
    <?php } ?>
    </tr>
  </table>

  <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
    <script>  
    $(document).ready(function(){  
      $('#btnImprimirVenta').click(function(){
      var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;
      var origen = "0";  
        $.ajax({ url:"../admin/imprimir_factura_venta_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta, origen:origen }, 
         success: function(response){
             if(response==1) {
                 //alert('Imprimiendo....');
             } else {
                 //alert('Error');
             }
         }
        });  
      });
    });  
    </script>
  <?php } ?>

  <script>
  function printPageArea(areaID){

    var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
    var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
    $("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

    var printContent = document.getElementById(areaID);
    $("#area_imprimible_invisible").show();
    $("#area_imprimible_invisible_cocina").hide();
    //document.getElementById("listo").focus();

    var WinPrint = window.open('', '', 'width=400,height=1000');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
  }
  </script>

  <div id="wrapper" style="width: 99%;">
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>
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
      FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '11112222')
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
          <th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong>CANT</strong></th>
          <th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong></strong></th>
          <?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;">..</th><?php } ?>
          <th style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong>DESCRIPCION</strong></th>
          <th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong>P.UNIT</strong></th>
          <th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong>P.TOTAL</strong></th>
          <th style="text-align: center; width:10%; font-family: Courier; font-size:5pt;"><strong></strong></th>
        </tr>
      <?php
      if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }

      $resultado_sql = "SELECT $select_productos_imp 
      FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '11112222') 
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
          <td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $und_venta ?></strong></td>
          <td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_tipo_unidad_medida ?></strong></td>
          <?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
          <td style="text-align: left; width:50%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_producto ?></strong></td>
          <td style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
          <td style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
          <td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong><?php echo $nombre_tipo_iva ?></strong></td>
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
        <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">SUBTOTAL</th>
        <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", ".") ?></th>
        <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
    </tr>
    <tr>
        <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">$DESCUENTO</th>
        <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;">-<?php echo number_format(abs($total_descuentos_manual_y_en_el_precio_venta), 0, ",", ".") ?></th>
        <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
    </tr>
    <?php if ($nombre_producto_puntos_redimibles <> '') { ?>
    <tr>
        <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_puntos_redimibles ?></th>
        <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;">-<?php echo number_format(abs($total_descuento_puntos_redimibles_como_concepto), 0, ",", ".") ?></th>
        <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
    </tr>
    <?php } ?>
    <tr>
        <!--<th style="text-align: center; width: 9%; font-family: Helvetica; font-size:7pt;">%DESCUENTO</th>-->
        <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">$TOTAL DESCUENTO</th>
        <!--<th style="text-align: center; width: 9%; font-family: Helvetica; font-size:7pt;"><?php echo intval($descuento_ptj_dif) ?>%</th>-->
        <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;">-<?php echo number_format(abs($total_descuento_venta), 0, ",", ".") ?></th>
        <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
    </tr>

    <?php if ($regimen_emp == 'RESPONSABLE_DE_IVA') { ?>
    <tr>
        <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;">IVA</th>
      <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($total_iva, 0, ",", ".") ?></th>
      <th style="text-align: right; width: 5%; font-family: Helvetica; font-size:7pt;"></th>
    </tr>
    <?php } ?>

    <?php if ($existe_servicio_propina <> '0') { ?>
    <tr>
        <th style="text-align: right; width: 50%; font-family: Helvetica; font-size:7pt;"><?php echo $nombre_producto_propina." ".$ptj_servicio_propina."%" ?></th>
        <th style="text-align: right; width: 20%; font-family: Helvetica; font-size:7pt;"><?php echo number_format($total_venta_producto_propina, 0, ",", ".") ?></th>
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
        FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5')";
        $consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
        $datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

        $total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
        $total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
        $total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
        //$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

        $sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
        Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
        Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
        FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0')";
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
      FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '11111111')";
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
  </div>
<?php } ?>


<hr>
<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../admin/lista_caja_virtual.php" class="btn btn-warning">Ir a Modulo Administrativo</a></td>
  </tr>
</table>

</body>
</html>
