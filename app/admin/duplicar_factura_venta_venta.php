<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_info_factura_venta'])) {

	$cod_info_factura_venta_info        = intval($_GET['cod_info_factura_venta']);
	$fecha_ymd_venta_producto           = date("Y-m-d");
	$fecha_mes_venta_producto           = date("Y-m");
	$fecha_anyo_venta_producto          = date("Y");
	$fecha_seg_venta_producto           = time();
	$cod_estado_factura                 = '1';
	$descuento_ptj                      = '0';
	$flete_ptj                          = '0';
	$vlr_cancelado                      = '';
	$vlr_vuelto                         = '';
	$fecha_dia                          = strtotime(date("Y/m/d"));
	$fecha_mes                          = date("Y-m");
	$fecha_anyo                         = date("Y-m-d");
	$anyo                               = date("Y");
	$fecha_hora                         = date("H:i:s");
	$fecha_remision                     = date("Y-m-d");
	$nombre_ccosto                      = '';
	$garantia_meses                     = '';
	$observacion                        = '';
	$cod_empresa                        = '0';
	$fecha_ymdhis                       = date("Y-m-d H:is");
	$cod_tipo_cobrar                    = '1';
	$cod_tercero                        = '1';
	$nombre_estado_factura              = 'ABIERTA';
	$cod_tipo_pago                      = "1";
	$cod_tipo_forma_pago                = "1";
	$cod_estado_vacuna                  = "1";
	$cuenta                             = $cuenta_actual;
	$foco                               = 'busqueda'; 
	$buscar_por                         = 'cod_producto_barra'; 
	$pagina                             = 'facturacion_venta_temporal_producto_manual_pos.php'; 
	$cod_check_imp                      = '1';
	$cod_tipo_metodo_envio              = '1';
	$cod_tipo_inventario                = "1";
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	if (isset($_GET['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_GET['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '0'; }
	if (isset($_GET['cod_categoria'])) { $cod_categoria = intval($_GET['cod_categoria']); $condicional_url_categoria = "&cod_categoria=".$cod_categoria; } else { $condicional_url_categoria = ""; }
	if ($cod_estado_deshabilitar_und_venta_ventatemp == '1') { $cod_estado_componente_und_venta = '1'; } else { $cod_estado_componente_und_venta = '0'; }
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	$sql_info_factura_venta = "SELECT cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, cod_tercero, nombre_tipo_moneda FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta_info')";
	$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
	$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

	//$cod_tipo_pago                      = $datos_info_factura_venta['cod_tipo_pago'];
	$cod_tipo_forma_pago                = $datos_info_factura_venta['cod_tipo_forma_pago'];
	$nombre_tipo_factura                = $datos_info_factura_venta['nombre_tipo_factura'];
	$cod_tercero                        = $datos_info_factura_venta['cod_tercero'];
	$nombre_tipo_moneda                 = $datos_info_factura_venta['nombre_tipo_moneda'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_venta_producto_temporal";
	$resultado_animal = mysqli_query($conectar, $sql_animal);
	$info_animal = mysqli_fetch_assoc($resultado_animal);

	$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
	$cod_base_caja                      = $info_animal['cod_base_caja'] + 1;
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
	$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
	$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

	$cod_prioridad                      = $datos_max_prioridad['cod_prioridad'] + 1;
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_info_factura_venta = $datos_autoincremento_sesion['AUTO_INCREMENT'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	$sql_venta_producto = "SELECT cod_producto, und_venta, nombre_tipo_precio_venta, precio_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta_info')";
	$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto) or die(mysqli_error($conectar));
	while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {

		$cod_producto                   = $datos_venta_producto['cod_producto'];
		$und_venta                      = $datos_venta_producto['und_venta'];
		$nombre_tipo_precio_venta       = $datos_venta_producto['nombre_tipo_precio_venta'];

		$sql_producto = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
		$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
		$datos_producto = mysqli_fetch_assoc($consulta_producto);

		$cod_producto_barra                        = $datos_producto['cod_producto_barra'];
		$nombre_producto                           = $datos_producto['nombre_producto'];
		$und_producto                              = $datos_producto['und_producto'];
		$precio_compra_producto                    = $datos_producto['precio_compra_producto'];
		$total_compra_producto                     = $precio_compra_producto * $und_venta;
		$precio_costo_producto                     = $precio_compra_producto;
		$total_costo_producto                      = $total_compra_producto;
		$precio_venta_producto                     = $datos_producto['precio_venta_producto'];
		$total_venta_producto                      = $precio_venta_producto * $und_venta;
		$precio_venta_producto_orig                = $precio_venta_producto;
		$precio_venta_producto2                    = $datos_producto['precio_venta_producto2'];
		$precio_venta_producto3                    = $datos_producto['precio_venta_producto3']; 
		$precio_venta_producto4                    = $datos_producto['precio_venta_producto4'];
		$precio_venta_producto5                    = $datos_producto['precio_venta_producto5'];
		$nombre_tipo_unidad_medida                 = $datos_producto['nombre_tipo_unidad_medida'];
		$posologia_cantidad                        = $datos_producto['posologia_cantidad'];
		$posologia_peso                            = $datos_producto['posologia_peso'];
		$iva_ptj                                   = $datos_producto['iva_ptj'];
		$nombre_tipo_producto                      = $datos_producto['nombre_tipo_producto'];
		$nombre_tipo_presentacion                  = $datos_producto['nombre_tipo_presentacion'];
		$nombre_via_administracion                 = $datos_producto['nombre_via_administracion'];
		$nombre_frec_duracion                      = $datos_producto['nombre_frec_duracion'];
		$cod_marca                                 = $datos_producto['cod_marca'];
		$cod_proveedor                             = $datos_producto['cod_proveedor'];
		$cod_estado                                = $datos_producto['cod_estado'];
		$cod_dependencia                           = $datos_producto['cod_dependencia'];
		$fecha_ult_compra                          = $datos_producto['fecha_ult_compra'];
		$fecha_ult_venta                           = $datos_producto['fecha_ult_venta'];
		$fecha_vencimiento1                        = $datos_producto['fecha_vencimiento1'];
		$vencimiento_lote1                         = $datos_producto['vencimiento_lote1'];
		$fecha_vencimiento2                        = $datos_producto['fecha_vencimiento2'];
		$vencimiento_lote2                         = $datos_producto['vencimiento_lote2'];
		$tope_min                                  = $datos_producto['tope_min'];
		$fecha_creacion                            = $datos_producto['fecha_creacion'];
		$fecha_modificacion                        = $datos_producto['fecha_modificacion'];
		$cod_info_factura_compra                   = $datos_producto['cod_info_factura_compra'];
		$nombre_tipo_precio                        = $datos_producto['nombre_tipo_precio'];
		$cod_opcion_descontable_inv                = $datos_producto['cod_opcion_descontable_inv'];
		$cajas_sobre                               = $datos_producto['cajas_sobre'];
		$und_sobre                                 = $datos_producto['und_sobre'];
		$cod_categoria                             = $datos_producto['cod_categoria'];
		$cod_categoria_sub                         = $datos_producto['cod_categoria_sub'];
		$cod_tipo_producto_cocina                  = $datos_producto['cod_tipo_producto_cocina'];
		$peso_producto                             = $datos_producto['peso_producto'];
		$unidad_medida_peso                        = $datos_producto['unidad_medida_peso'];
		$cod_origen_produccion                     = $datos_producto['cod_origen_produccion'];
		if ($cod_producto_barra == '55555555') { $cod_estado_cava = 1; } else { $cod_estado_cava = 0; }

		if ($nombre_tipo_precio_venta == 'PV1') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto * $und_venta; } 
		elseif ($nombre_tipo_precio_venta == 'PV2') { $precio_venta_producto = $precio_venta_producto2; $total_venta_producto = $precio_venta_producto * $und_venta; } 
		elseif ($nombre_tipo_precio_venta == 'PV3') { $precio_venta_producto = $precio_venta_producto3; $total_venta_producto = $precio_venta_producto * $und_venta; } 
		elseif ($nombre_tipo_precio_venta == 'PV4') { $precio_venta_producto = $precio_venta_producto4; $total_venta_producto = $precio_venta_producto * $und_venta; } 
		elseif ($nombre_tipo_precio_venta == 'PV5') { $precio_venta_producto = $precio_venta_producto5; $total_venta_producto = $precio_venta_producto * $und_venta; } 
		elseif ($nombre_tipo_precio_venta == 'PVAR') { $precio_venta_producto = $datos_venta_producto['precio_venta_producto']; $total_venta_producto = $precio_venta_producto * $und_venta; } 
		else { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto * $und_venta; }

		if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

		$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
		precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
		precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
		nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
		cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, 
		precio_venta_producto_orig, und_producto, cod_base_caja, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, 
		cod_check_imp, cajas_sobre, und_sobre, peso_producto, unidad_medida_peso, cod_estado_componente_und_venta, cod_origen_produccion, cod_estado_cava, iva_ptj) 
		VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
		'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
		'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
		'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
		'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta',
		'$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', '$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', 
		'$cod_check_imp', '$cajas_sobre', '$und_sobre', '$peso_producto', '$unidad_medida_peso', '$cod_estado_componente_und_venta', '$cod_origen_produccion', '$cod_estado_cava', '$iva_ptj')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
	nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion) 
	VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
	'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$pagina_redirect                    = "../admin/facturacion_venta_temporal_producto_barras_pos.php"."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual.$condicional_url_categoria."&pagina=facturacion_venta_temporal_producto_manual_pos.php";
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } ?>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>