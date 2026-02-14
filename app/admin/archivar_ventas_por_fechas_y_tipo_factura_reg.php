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

<div class="breadcrumbs"><a href="../admin/archivar_ventas_por_fechas_y_tipo_factura.php"><h4>Archivando Facturas de Venta</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<?php if (isset($_POST['cod_info_factura_venta'])) {

	foreach($_POST["cod_info_factura_venta"] as $key => $cod_info_factura_venta) {

		$fecha_archivado                                    = date("Y-m-d H:i:s");
		$cuenta_archivado                                   = $cuenta_actual;
		$fecha_time                                         = time();
		$contador_venta                                     = 0;
		$contador_info_venta                                = 0;
		$cod_estado_check_factura_electronica_ext           = 0;

		$sql_datos = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
		$resultado_datos = mysqli_query($conectar, $sql_datos);
		while ($info_datos = mysqli_fetch_assoc($resultado_datos)) {

			$cod_venta_producto                           = $info_datos['cod_venta_producto']; 
			$cod_producto                                 = $info_datos['cod_producto']; 
			$cod_producto_barra                           = $info_datos['cod_producto_barra']; 
			$cod_producto_barra_madre                     = $info_datos['cod_producto_barra_madre']; 
			$cod_info_factura_venta                       = $info_datos['cod_info_factura_venta']; 
			$cod_factura                                  = $info_datos['cod_factura']; 
			$cod_tercero                                  = $info_datos['cod_tercero']; 
			$cod_caja_virtual                             = $info_datos['cod_caja_virtual']; 
			$nombre_producto                              = $info_datos['nombre_producto']; 
			$und_venta                                    = $info_datos['und_venta']; 
			$precio_compra_producto                       = $info_datos['precio_compra_producto']; 
			$total_compra_producto                        = $info_datos['total_compra_producto']; 
			$precio_costo_producto                        = $info_datos['precio_costo_producto']; 
			$total_costo_producto                         = $info_datos['total_costo_producto']; 
			$precio_venta_producto                        = $info_datos['precio_venta_producto']; 
			$total_venta_producto                         = $info_datos['total_venta_producto']; 
			$precio_venta_producto_orig                   = $info_datos['precio_venta_producto_orig']; 
			$und_caja_sobre                               = $info_datos['und_caja_sobre']; 
			$cajas_sobre                                  = $info_datos['cajas_sobre']; 
			$nombre_tipo_und_caja_sobre                   = $info_datos['nombre_tipo_und_caja_sobre']; 
			$posologia_cantidad                           = $info_datos['posologia_cantidad']; 
			$posologia_peso                               = $info_datos['posologia_peso']; 
			$peso_producto                                = $info_datos['peso_producto']; 
			$unidad_medida_peso                           = $info_datos['unidad_medida_peso']; 
			$nombre_tipo_producto                         = $info_datos['nombre_tipo_producto']; 
			$nombre_tipo_unidad_medida                    = $info_datos['nombre_tipo_unidad_medida']; 
			$nombre_tipo_presentacion                     = $info_datos['nombre_tipo_presentacion']; 
			$nombre_via_administracion                    = $info_datos['nombre_via_administracion']; 
			$nombre_frec_duracion                         = $info_datos['nombre_frec_duracion']; 
			$und_producto                                 = $info_datos['und_producto']; 
			$fecha_ymd_venta_producto                     = $info_datos['fecha_ymd_venta_producto']; 
			$fecha_mes_venta_producto                     = $info_datos['fecha_mes_venta_producto']; 
			$fecha_anyo_venta_producto                    = $info_datos['fecha_anyo_venta_producto']; 
			$fecha_hora_venta_producto                    = $info_datos['fecha_hora_venta_producto']; 
			$fecha_seg_venta_producto                     = $info_datos['fecha_seg_venta_producto']; 
			$fecha_alerta                                 = $info_datos['fecha_alerta']; 
			$cod_estado_vacuna                            = $info_datos['cod_estado_vacuna']; 
			$cuenta                                       = $info_datos['cuenta']; 
			$cod_administrador                            = $info_datos['cod_administrador']; 
			$cod_base_caja                                = $info_datos['cod_base_caja']; 
			$cod_opcion_descontable_inv                   = $info_datos['cod_opcion_descontable_inv']; 
			$und_producto_inv                             = $info_datos['und_producto_inv']; 
			$und_producto_bodega_inv                      = $info_datos['und_producto_bodega_inv']; 
			$cod_tipo_cobrar                              = $info_datos['cod_tipo_cobrar']; 
			$descuento_ptj                                = $info_datos['descuento_ptj']; 
			$iva_ptj                                      = $info_datos['iva_ptj']; 
			$iva_saludable_ptj                            = $info_datos['iva_saludable_ptj']; 
			$ptj_imp_consumo                              = $info_datos['ptj_imp_consumo']; 
			$ptj_ret_iva                                  = $info_datos['ptj_ret_iva']; 
			$ptj_ret_ica                                  = $info_datos['ptj_ret_ica']; 
			$ptj_ret_fuente                               = $info_datos['ptj_ret_fuente']; 
			$ptj_ipc                                      = $info_datos['ptj_ipc']; 
			$precio_ipc_total                             = $info_datos['precio_ipc_total']; 
			$precio_ipc                                   = $info_datos['precio_ipc']; 
			$cod_factura_electronica                      = $info_datos['cod_factura_electronica']; 
			$cod_resolucion_facturacion                   = $info_datos['cod_resolucion_facturacion']; 
			$nombre_tipo_precio                           = $info_datos['nombre_tipo_precio']; 
			$nombre_tipo_precio_venta                     = $info_datos['nombre_tipo_precio_venta']; 
			$comision_ptj                                 = $info_datos['comision_ptj']; 
			$nombre_cliente                               = $info_datos['nombre_cliente']; 
			$cedula                                       = $info_datos['cedula']; 
			$nombre_empresa                               = $info_datos['nombre_empresa']; 
			$cod_empresa                                  = $info_datos['cod_empresa']; 
			$cod_cliente                                  = $info_datos['cod_cliente']; 
			$cod_historia_clinica                         = $info_datos['cod_historia_clinica']; 
			$cod_prioridad                                = $info_datos['cod_prioridad']; 
			$cod_cufe                                     = $info_datos['cod_cufe']; 
			$cod_tipo_mantenimiento                       = $info_datos['cod_tipo_mantenimiento']; 
			$cod_tipo_pago                                = $info_datos['cod_tipo_pago']; 
			$cod_tipo_forma_pago                          = $info_datos['cod_tipo_forma_pago']; 
			$total_datos_data                             = $info_datos['total_datos_data']; 
			$nombre_tipo_factura                          = $info_datos['nombre_tipo_factura']; 
			$nombre_tipo_moneda                           = $info_datos['nombre_tipo_moneda']; 
			$vlr_cancelado                                = $info_datos['vlr_cancelado']; 
			$vlr_vuelto                                   = $info_datos['vlr_vuelto']; 
			$nombre_promocion                             = $info_datos['nombre_promocion']; 
			$nombre_promocion_ing                         = $info_datos['nombre_promocion_ing']; 
			$url_img_producto_min                         = $info_datos['url_img_producto_min']; 
			$url_img_producto_orig                        = $info_datos['url_img_producto_orig']; 
			$cod_categoria                                = $info_datos['cod_categoria']; 
			$cod_categoria_sub                            = $info_datos['cod_categoria_sub']; 
			$cod_estado                                   = $info_datos['cod_estado']; 
			$cod_dependencia                              = $info_datos['cod_dependencia']; 
			$cod_tipo_inventario                          = $info_datos['cod_tipo_inventario']; 
			$cod_tipo_pedido                              = $info_datos['cod_tipo_pedido']; 
			$cod_factura_compra_producto                  = $info_datos['cod_factura_compra_producto']; 
			$cod_tipo_producto_cocina                     = $info_datos['cod_tipo_producto_cocina']; 
			$cod_cierre_caja                              = $info_datos['cod_cierre_caja']; 
			$fecha_cierre_caja                            = $info_datos['fecha_cierre_caja']; 
			$hora_cierre_caja                             = $info_datos['hora_cierre_caja']; 
			$fecha_time_cierre_caja                       = $info_datos['fecha_time_cierre_caja']; 
			$comentario_producto                          = $info_datos['comentario_producto']; 
			$nombre_categoria                             = $info_datos['nombre_categoria']; 
			$nombre_categoria_sub                         = $info_datos['nombre_categoria_sub']; 
			$nombre_tipo_compra                           = $info_datos['nombre_tipo_compra']; 
			$placa_producto                               = $info_datos['placa_producto']; 
			$fecha_ymd_parqueo_ini                        = $info_datos['fecha_ymd_parqueo_ini']; 
			$fecha_hora_parqueo_ini                       = $info_datos['fecha_hora_parqueo_ini']; 
			$fecha_ymd_parqueo_fin                        = $info_datos['fecha_ymd_parqueo_fin']; 
			$fecha_hora_parqueo_fin                       = $info_datos['fecha_hora_parqueo_fin']; 
			$cod_info_parqueo_cotizacion_factura_venta    = $info_datos['cod_info_parqueo_cotizacion_factura_venta']; 
			$cod_parqueo_cotizacion_venta_producto        = $info_datos['cod_parqueo_cotizacion_venta_producto']; 
			$cod_info_hotel_cotizacion_factura_venta      = $info_datos['cod_info_hotel_cotizacion_factura_venta']; 
			$cod_hotel_cotizacion_venta_producto          = $info_datos['cod_hotel_cotizacion_venta_producto']; 
			$cod_tipo_metodo_envio                        = $info_datos['cod_tipo_metodo_envio']; 
			$cod_tipo_aplicacion                          = $info_datos['cod_tipo_aplicacion']; 
			$cod_zona_envio                               = $info_datos['cod_zona_envio']; 
			$cod_estado_cava                              = $info_datos['cod_estado_cava']; 
			$cod_dia_semana                               = $info_datos['cod_dia_semana']; 
			$cod_estado_check_factura_electronica         = $info_datos['cod_estado_check_factura_electronica']; 
			$cod_estado_factura_electronica_enviado_dian  = $info_datos['cod_estado_factura_electronica_enviado_dian']; 
			$cod_factura_antigua                          = $info_datos['cod_factura_antigua']; 
			$cod_venta_producto_temporal                  = $info_datos['cod_venta_producto_temporal']; 
			$cod_estado_habitacion_hotel                  = $info_datos['cod_estado_habitacion_hotel']; 
			$cod_tipo_habitacion_hotel                    = $info_datos['cod_tipo_habitacion_hotel']; 
			$cod_estado_tipo_hotel_parqueo                = $info_datos['cod_estado_tipo_hotel_parqueo']; 
			$total_horas                                  = $info_datos['total_horas']; 
			$total_dias                                   = $info_datos['total_dias']; 
			$cod_tipo_cod_barra                           = $info_datos['cod_tipo_cod_barra']; 
			$nombre_tipo_cobro                            = $info_datos['nombre_tipo_cobro']; 
			$fecha_cobro_renovacion                       = $info_datos['fecha_cobro_renovacion']; 
			$cod_puc                                      = $info_datos['cod_puc']; 

			$agregar_operacion = "INSERT INTO tbl15_venta_producto_archivado (
			cod_venta_producto, 
			cod_producto, 
			cod_producto_barra, 
			cod_producto_barra_madre, 
			cod_info_factura_venta, 
			cod_factura, 
			cod_tercero, 
			cod_caja_virtual, 
			nombre_producto, 
			und_venta, 
			precio_compra_producto, 
			total_compra_producto, 
			precio_costo_producto, 
			total_costo_producto, 
			precio_venta_producto, 
			total_venta_producto, 
			precio_venta_producto_orig, 
			und_caja_sobre, 
			cajas_sobre, 
			nombre_tipo_und_caja_sobre, 
			posologia_cantidad, 
			posologia_peso, 
			peso_producto, 
			unidad_medida_peso, 
			nombre_tipo_producto, 
			nombre_tipo_unidad_medida, 
			nombre_tipo_presentacion, 
			nombre_via_administracion, 
			nombre_frec_duracion, 
			und_producto, 
			fecha_ymd_venta_producto, 
			fecha_mes_venta_producto, 
			fecha_anyo_venta_producto, 
			fecha_hora_venta_producto, 
			fecha_seg_venta_producto, 
			fecha_alerta, 
			cod_estado_vacuna, 
			cuenta, 
			cod_administrador, 
			cod_base_caja, 
			cod_opcion_descontable_inv, 
			und_producto_inv, 
			und_producto_bodega_inv, 
			cod_tipo_cobrar, 
			descuento_ptj, 
			iva_ptj, 
			iva_saludable_ptj, 
			ptj_imp_consumo, 
			ptj_ret_iva, 
			ptj_ret_ica, 
			ptj_ret_fuente, 
			ptj_ipc, 
			precio_ipc_total, 
			precio_ipc, 
			cod_factura_electronica, 
			cod_resolucion_facturacion, 
			nombre_tipo_precio, 
			nombre_tipo_precio_venta, 
			comision_ptj, 
			nombre_cliente, 
			cedula, 
			nombre_empresa, 
			cod_empresa, 
			cod_cliente, 
			cod_historia_clinica, 
			cod_prioridad, 
			cod_cufe, 
			cod_tipo_mantenimiento, 
			cod_tipo_pago, 
			cod_tipo_forma_pago, 
			total_datos_data, 
			nombre_tipo_factura, 
			nombre_tipo_moneda, 
			vlr_cancelado, 
			vlr_vuelto, 
			nombre_promocion, 
			nombre_promocion_ing, 
			url_img_producto_min, 
			url_img_producto_orig, 
			cod_categoria, 
			cod_categoria_sub, 
			cod_estado, 
			cod_dependencia, 
			cod_tipo_inventario, 
			cod_tipo_pedido, 
			cod_factura_compra_producto, 
			cod_tipo_producto_cocina, 
			cod_cierre_caja, 
			fecha_cierre_caja, 
			hora_cierre_caja, 
			fecha_time_cierre_caja, 
			comentario_producto, 
			nombre_categoria, 
			nombre_categoria_sub, 
			nombre_tipo_compra, 
			placa_producto, 
			fecha_ymd_parqueo_ini, 
			fecha_hora_parqueo_ini, 
			fecha_ymd_parqueo_fin, 
			fecha_hora_parqueo_fin, 
			cod_info_parqueo_cotizacion_factura_venta, 
			cod_parqueo_cotizacion_venta_producto, 
			cod_info_hotel_cotizacion_factura_venta, 
			cod_hotel_cotizacion_venta_producto, 
			cod_tipo_metodo_envio, 
			cod_tipo_aplicacion, 
			cod_zona_envio, 
			cod_estado_cava, 
			cod_dia_semana, 
			cod_estado_check_factura_electronica, 
			cod_estado_factura_electronica_enviado_dian, 
			cod_factura_antigua, 
			cod_venta_producto_temporal, 
			cod_estado_habitacion_hotel, 
			cod_tipo_habitacion_hotel, 
			cod_estado_tipo_hotel_parqueo, 
			total_horas, 
			total_dias, 
			cod_tipo_cod_barra, 
			nombre_tipo_cobro, 
			fecha_cobro_renovacion, 
			cod_puc, 
			fecha_archivado, 
			cuenta_archivado) 
			VALUES (
			'$cod_venta_producto', 
			'$cod_producto', 
			'$cod_producto_barra', 
			'$cod_producto_barra_madre', 
			'$cod_info_factura_venta', 
			'$cod_factura', 
			'$cod_tercero', 
			'$cod_caja_virtual', 
			'$nombre_producto', 
			'$und_venta', 
			'$precio_compra_producto', 
			'$total_compra_producto', 
			'$precio_costo_producto', 
			'$total_costo_producto', 
			'$precio_venta_producto', 
			'$total_venta_producto', 
			'$precio_venta_producto_orig', 
			'$und_caja_sobre', 
			'$cajas_sobre', 
			'$nombre_tipo_und_caja_sobre', 
			'$posologia_cantidad', 
			'$posologia_peso', 
			'$peso_producto', 
			'$unidad_medida_peso', 
			'$nombre_tipo_producto', 
			'$nombre_tipo_unidad_medida', 
			'$nombre_tipo_presentacion', 
			'$nombre_via_administracion', 
			'$nombre_frec_duracion', 
			'$und_producto', 
			'$fecha_ymd_venta_producto', 
			'$fecha_mes_venta_producto', 
			'$fecha_anyo_venta_producto', 
			'$fecha_hora_venta_producto', 
			'$fecha_seg_venta_producto', 
			'$fecha_alerta', 
			'$cod_estado_vacuna', 
			'$cuenta', 
			'$cod_administrador', 
			'$cod_base_caja', 
			'$cod_opcion_descontable_inv', 
			'$und_producto_inv', 
			'$und_producto_bodega_inv', 
			'$cod_tipo_cobrar', 
			'$descuento_ptj', 
			'$iva_ptj', 
			'$iva_saludable_ptj', 
			'$ptj_imp_consumo', 
			'$ptj_ret_iva', 
			'$ptj_ret_ica', 
			'$ptj_ret_fuente', 
			'$ptj_ipc', 
			'$precio_ipc_total', 
			'$precio_ipc', 
			'$cod_factura_electronica', 
			'$cod_resolucion_facturacion', 
			'$nombre_tipo_precio', 
			'$nombre_tipo_precio_venta', 
			'$comision_ptj', 
			'$nombre_cliente', 
			'$cedula', 
			'$nombre_empresa', 
			'$cod_empresa', 
			'$cod_cliente', 
			'$cod_historia_clinica', 
			'$cod_prioridad', 
			'$cod_cufe', 
			'$cod_tipo_mantenimiento', 
			'$cod_tipo_pago', 
			'$cod_tipo_forma_pago', 
			'$total_datos_data', 
			'$nombre_tipo_factura', 
			'$nombre_tipo_moneda', 
			'$vlr_cancelado', 
			'$vlr_vuelto', 
			'$nombre_promocion', 
			'$nombre_promocion_ing', 
			'$url_img_producto_min', 
			'$url_img_producto_orig', 
			'$cod_categoria', 
			'$cod_categoria_sub', 
			'$cod_estado', 
			'$cod_dependencia', 
			'$cod_tipo_inventario', 
			'$cod_tipo_pedido', 
			'$cod_factura_compra_producto', 
			'$cod_tipo_producto_cocina', 
			'$cod_cierre_caja', 
			'$fecha_cierre_caja', 
			'$hora_cierre_caja', 
			'$fecha_time_cierre_caja', 
			'$comentario_producto', 
			'$nombre_categoria', 
			'$nombre_categoria_sub', 
			'$nombre_tipo_compra', 
			'$placa_producto', 
			'$fecha_ymd_parqueo_ini', 
			'$fecha_hora_parqueo_ini', 
			'$fecha_ymd_parqueo_fin', 
			'$fecha_hora_parqueo_fin', 
			'$cod_info_parqueo_cotizacion_factura_venta', 
			'$cod_parqueo_cotizacion_venta_producto', 
			'$cod_info_hotel_cotizacion_factura_venta', 
			'$cod_hotel_cotizacion_venta_producto', 
			'$cod_tipo_metodo_envio', 
			'$cod_tipo_aplicacion', 
			'$cod_zona_envio', 
			'$cod_estado_cava', 
			'$cod_dia_semana', 
			'$cod_estado_check_factura_electronica', 
			'$cod_estado_factura_electronica_enviado_dian', 
			'$cod_factura_antigua', 
			'$cod_venta_producto_temporal', 
			'$cod_estado_habitacion_hotel', 
			'$cod_tipo_habitacion_hotel', 
			'$cod_estado_tipo_hotel_parqueo', 
			'$total_horas', 
			'$total_dias', 
			'$cod_tipo_cod_barra', 
			'$nombre_tipo_cobro', 
			'$fecha_cobro_renovacion', 
			'$cod_puc', 
			'$fecha_archivado', 
			'$cuenta_archivado')";
			$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

			$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto WHERE cod_venta_producto = '$cod_venta_producto'");
			$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

			$contador_venta++;
		}
		echo "<br>Total registros de Venta Archivados: ".$contador_venta;

		$sql_datos = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
		$resultado_datos = mysqli_query($conectar, $sql_datos);
		while ($info_datos = mysqli_fetch_assoc($resultado_datos)) {

			$cod_info_factura_venta                       = $info_datos['cod_info_factura_venta']; 
			$cod_factura                                  = $info_datos['cod_factura']; 
			$cod_tercero                                  = $info_datos['cod_tercero']; 
			$cod_caja_virtual                             = $info_datos['cod_caja_virtual']; 
			$cod_cufe                                     = $info_datos['cod_cufe']; 
			$cod_prioridad                                = $info_datos['cod_prioridad']; 
			$nombre_estado_factura                        = $info_datos['nombre_estado_factura']; 
			$cod_historia_clinica                         = $info_datos['cod_historia_clinica']; 
			$fecha_ini                                    = $info_datos['fecha_ini']; 
			$fecha_fin                                    = $info_datos['fecha_fin']; 
			$cod_empresa                                  = $info_datos['cod_empresa']; 
			$nombre_empresa                               = $info_datos['nombre_empresa']; 
			$razonsocial_empresa                          = $info_datos['razonsocial_empresa']; 
			$total_motivo                                 = $info_datos['total_motivo']; 
			$total_muestra                                = $info_datos['total_muestra']; 
			$motivo                                       = $info_datos['motivo']; 
			$fecha_ymdhis                                 = $info_datos['fecha_ymdhis']; 
			$cuenta                                       = $info_datos['cuenta']; 
			$cod_estado_factura                           = $info_datos['cod_estado_factura']; 
			$cod_base_caja                                = $info_datos['cod_base_caja']; 
			$descuento_ptj                                = $info_datos['descuento_ptj']; 
			$iva_ptj                                      = $info_datos['iva_ptj']; 
			$flete_ptj                                    = $info_datos['flete_ptj']; 
			$cod_cliente                                  = $info_datos['cod_cliente']; 
			$vlr_cancelado                                = $info_datos['vlr_cancelado']; 
			$vlr_vuelto                                   = $info_datos['vlr_vuelto']; 
			$fecha_dia                                    = $info_datos['fecha_dia']; 
			$fecha_mes                                    = $info_datos['fecha_mes']; 
			$fecha_anyo                                   = $info_datos['fecha_anyo']; 
			$anyo                                         = $info_datos['anyo']; 
			$fecha_hora                                   = $info_datos['fecha_hora']; 
			$fecha_remision                               = $info_datos['fecha_remision']; 
			$nombre_ccosto                                = $info_datos['nombre_ccosto']; 
			$garantia_meses                               = $info_datos['garantia_meses']; 
			$observacion                                  = $info_datos['observacion']; 
			$cod_tipo_pago                                = $info_datos['cod_tipo_pago']; 
			$cod_administrador                            = $info_datos['cod_administrador']; 
			$nombre_tipo_producto                         = $info_datos['nombre_tipo_producto']; 
			$total_precio_compra                          = $info_datos['total_precio_compra']; 
			$total_precio_venta                           = $info_datos['total_precio_venta']; 
			$total_peso_producto                          = $info_datos['total_peso_producto']; 
			$cod_dependencia                              = $info_datos['cod_dependencia']; 
			$servicio                                     = $info_datos['servicio']; 
			$cod_tipo_pedido                              = $info_datos['cod_tipo_pedido']; 
			$cod_tipo_mantenimiento                       = $info_datos['cod_tipo_mantenimiento']; 
			$cod_tipo_forma_pago                          = $info_datos['cod_tipo_forma_pago']; 
			$nombre_tipo_forma_pago                       = $info_datos['nombre_tipo_forma_pago']; 
			$descripcion_tipo_forma_pago                  = $info_datos['descripcion_tipo_forma_pago']; 
			$nombre_tipo_factura                          = $info_datos['nombre_tipo_factura']; 
			$nombre_tipo_moneda                           = $info_datos['nombre_tipo_moneda']; 
			$cod_cierre_caja                              = $info_datos['cod_cierre_caja']; 
			$fecha_creacion                               = $info_datos['fecha_creacion']; 
			$fecha_modificacion                           = $info_datos['fecha_modificacion']; 
			$nombre_maquina                               = $info_datos['nombre_maquina']; 
			$cod_tipo_cobrar                              = $info_datos['cod_tipo_cobrar']; 
			$cod_estado_vacuna                            = $info_datos['cod_estado_vacuna']; 
			$cod_resolucion_facturacion                   = $info_datos['cod_resolucion_facturacion']; 
			$total_datos_data                             = $info_datos['total_datos_data']; 
			$tiempo_ejecucion                             = $info_datos['tiempo_ejecucion']; 
			$cod_tipo_inventario                          = $info_datos['cod_tipo_inventario']; 
			$url_img_orig_producto                        = $info_datos['url_img_orig_producto']; 
			$url_img_min_producto                         = $info_datos['url_img_min_producto']; 
			$observacion_tercero                          = $info_datos['observacion_tercero']; 
			$cod_cupon                                    = $info_datos['cod_cupon']; 
			$costo_cupon                                  = $info_datos['costo_cupon']; 
			$activado                                     = $info_datos['activado']; 
			$costo_tipo_envio                             = $info_datos['costo_tipo_envio']; 
			$cod_tipo_envio                               = $info_datos['cod_tipo_envio']; 
			$nombre_tipo_entrega                          = $info_datos['nombre_tipo_entrega']; 
			$direcion_misma_factura                       = $info_datos['direcion_misma_factura']; 
			$guarda_info_prox                             = $info_datos['guarda_info_prox']; 
			$latitud                                      = $info_datos['latitud']; 
			$longitud                                     = $info_datos['longitud']; 
			$latitud_longitud                             = $info_datos['latitud_longitud']; 
			$latitud_confirm                              = $info_datos['latitud_confirm']; 
			$longitud_confirm                             = $info_datos['longitud_confirm']; 
			$latitud_longitud_confirm                     = $info_datos['latitud_longitud_confirm']; 
			$cod_estado                                   = $info_datos['cod_estado']; 
			$cod_estado_cocina                            = $info_datos['cod_estado_cocina']; 
			$cod_estado_bartender                         = $info_datos['cod_estado_bartender']; 
			$cod_estado_jugueria                          = $info_datos['cod_estado_jugueria']; 
			$cod_estado_timbre_entrada                    = $info_datos['cod_estado_timbre_entrada']; 
			$cod_estado_timbre_salida                     = $info_datos['cod_estado_timbre_salida']; 
			$nombre1_tercero                              = $info_datos['nombre1_tercero']; 
			$nombre2_tercero                              = $info_datos['nombre2_tercero']; 
			$apellido1_tercero                            = $info_datos['apellido1_tercero']; 
			$apellido2_tercero                            = $info_datos['apellido2_tercero']; 
			$identificacion_tercero                       = $info_datos['identificacion_tercero']; 
			$fecha_nac_tercero                            = $info_datos['fecha_nac_tercero']; 
			$direccion_tercero                            = $info_datos['direccion_tercero']; 
			$telefono1_tercero                            = $info_datos['telefono1_tercero']; 
			$correo_tercero                               = $info_datos['correo_tercero']; 
			$cod_info_factura_venta_carrito_compra        = $info_datos['cod_info_factura_venta_carrito_compra']; 
			$cod_estado_revisado                          = $info_datos['cod_estado_revisado']; 
			$cod_estado_revisado_cocina                   = $info_datos['cod_estado_revisado_cocina']; 
			$cod_estado_revisado_bartender                = $info_datos['cod_estado_revisado_bartender']; 
			$cod_estado_revisado_jugueria                 = $info_datos['cod_estado_revisado_jugueria']; 
			$cod_estado_revisado_universal                = $info_datos['cod_estado_revisado_universal']; 
			$cod_estado_revisado_notificacion_vendedor    = $info_datos['cod_estado_revisado_notificacion_vendedor']; 
			$cod_tipo_metodo_envio                        = $info_datos['cod_tipo_metodo_envio']; 
			$cod_tipo_aplicacion                          = $info_datos['cod_tipo_aplicacion']; 
			$cod_zona_envio                               = $info_datos['cod_zona_envio']; 
			$cod_estado_cava                              = $info_datos['cod_estado_cava']; 
			$cod_cuentas_cobrar                           = $info_datos['cod_cuentas_cobrar']; 
			$monto_deuda                                  = $info_datos['monto_deuda']; 
			$monto_deuda_sin_interes                      = $info_datos['monto_deuda_sin_interes']; 
			$subtotal                                     = $info_datos['subtotal']; 
			$abonado                                      = $info_datos['abonado']; 
			$subtotal_sin_interes                         = $info_datos['subtotal_sin_interes']; 
			$numero_cuota                                 = $info_datos['numero_cuota']; 
			$monto_cuota                                  = $info_datos['monto_cuota']; 
			$monto_cuota_sin_interes                      = $info_datos['monto_cuota_sin_interes']; 
			$interes_ptj                                  = $info_datos['interes_ptj']; 
			$monto_deuda_mas_interes                      = $info_datos['monto_deuda_mas_interes']; 
			$monto_cuota_interes                          = $info_datos['monto_cuota_interes']; 
			$nombre_tipo_cobro                            = $info_datos['nombre_tipo_cobro']; 
			$nombre_factura_remision                      = $info_datos['nombre_factura_remision']; 
			$nombre_tipo_pendiente                        = $info_datos['nombre_tipo_pendiente']; 
			$descripcion_tipo_pendiente                   = $info_datos['descripcion_tipo_pendiente']; 
			$fecha_entrega                                = $info_datos['fecha_entrega']; 
			$hora_entrega                                 = $info_datos['hora_entrega']; 
			$nombre_elaboro                               = $info_datos['nombre_elaboro']; 
			$fecha_pago                                   = $info_datos['fecha_pago']; 
			$cod_dia_semana                               = $info_datos['cod_dia_semana']; 
			$cod_estado_check_factura_electronica         = $info_datos['cod_estado_check_factura_electronica']; 
			$cod_estado_factura_electronica_enviado_dian  = $info_datos['cod_estado_factura_electronica_enviado_dian']; 
			$cod_factura_antigua                          = $info_datos['cod_factura_antigua']; 
			$fecha_ymd_parqueo_ini                        = $info_datos['fecha_ymd_parqueo_ini']; 
			$fecha_hora_parqueo_ini                       = $info_datos['fecha_hora_parqueo_ini']; 
			$fecha_ymd_parqueo_fin                        = $info_datos['fecha_ymd_parqueo_fin']; 
			$fecha_hora_parqueo_fin                       = $info_datos['fecha_hora_parqueo_fin']; 
			$cod_estado_habitacion_hotel                  = $info_datos['cod_estado_habitacion_hotel']; 
			$cod_tipo_habitacion_hotel                    = $info_datos['cod_tipo_habitacion_hotel']; 
			$total_horas                                  = $info_datos['total_horas']; 
			$cod_info_factura_venta_appdomicilio          = $info_datos['cod_info_factura_venta_appdomicilio']; 
			$cod_domiciliario                             = $info_datos['cod_domiciliario']; 
			$cod_puc                                      = $info_datos['cod_puc']; 

			$dataico_email_status                         = $info_datos['dataico_email_status']; 
			$dataico_uuid                                 = $info_datos['dataico_uuid']; 
			$dataico_issue_date                           = $info_datos['dataico_issue_date']; 
			$dataico_dian_messages                        = $info_datos['dataico_dian_messages']; 
			$dataico_payment_date                         = $info_datos['dataico_payment_date']; 
			$dataico_xml_url                              = $info_datos['dataico_xml_url']; 
			$dataico_customer_status                      = $info_datos['dataico_customer_status']; 
			$dataico_validation_date                      = $info_datos['dataico_validation_date']; 
			$dataico_qrcode                               = $info_datos['dataico_qrcode']; 
			$dataico_xml                                  = $info_datos['dataico_xml']; 
			$dataico_invoice_type_code                    = $info_datos['dataico_invoice_type_code']; 
			$dataico_pdf_url                              = $info_datos['dataico_pdf_url']; 
			$dataico_dian_status                          = $info_datos['dataico_dian_status']; 
			$dataico_dian_error                           = $info_datos['dataico_dian_error']; 
			$dataico_dian_path                            = $info_datos['dataico_dian_path']; 
			$cod_estado_factura_electronica_enviado_dataico = $info_datos['cod_estado_factura_electronica_enviado_dataico']; 

			$agregar_operacion = "INSERT INTO tbl15_info_factura_venta_archivado (
			cod_info_factura_venta, 
			cod_factura, 
			cod_tercero, 
			cod_caja_virtual, 
			cod_cufe, 
			cod_prioridad, 
			nombre_estado_factura, 
			cod_historia_clinica, 
			fecha_ini, 
			fecha_fin, 
			cod_empresa, 
			nombre_empresa, 
			razonsocial_empresa, 
			total_motivo, 
			total_muestra, 
			motivo, 
			fecha_ymdhis, 
			cuenta, 
			cod_estado_factura, 
			cod_base_caja, 
			descuento_ptj, 
			iva_ptj, 
			flete_ptj, 
			cod_cliente, 
			vlr_cancelado, 
			vlr_vuelto, 
			fecha_dia, 
			fecha_mes, 
			fecha_anyo, 
			anyo, 
			fecha_hora, 
			fecha_remision, 
			nombre_ccosto, 
			garantia_meses, 
			observacion, 
			cod_tipo_pago, 
			cod_administrador, 
			nombre_tipo_producto, 
			total_precio_compra, 
			total_precio_venta, 
			total_peso_producto, 
			cod_dependencia, 
			servicio, 
			cod_tipo_pedido, 
			cod_tipo_mantenimiento, 
			cod_tipo_forma_pago, 
			nombre_tipo_forma_pago, 
			descripcion_tipo_forma_pago, 
			nombre_tipo_factura, 
			nombre_tipo_moneda, 
			cod_cierre_caja, 
			fecha_creacion, 
			fecha_modificacion, 
			nombre_maquina, 
			cod_tipo_cobrar, 
			cod_estado_vacuna, 
			cod_resolucion_facturacion, 
			total_datos_data, 
			tiempo_ejecucion, 
			cod_tipo_inventario, 
			url_img_orig_producto, 
			url_img_min_producto, 
			observacion_tercero, 
			cod_cupon, 
			costo_cupon, 
			activado, 
			costo_tipo_envio, 
			cod_tipo_envio, 
			nombre_tipo_entrega, 
			direcion_misma_factura, 
			guarda_info_prox, 
			latitud, 
			longitud, 
			latitud_longitud, 
			latitud_confirm, 
			longitud_confirm, 
			latitud_longitud_confirm, 
			cod_estado, 
			cod_estado_cocina, 
			cod_estado_bartender, 
			cod_estado_jugueria, 
			cod_estado_timbre_entrada, 
			cod_estado_timbre_salida, 
			nombre1_tercero, 
			nombre2_tercero, 
			apellido1_tercero, 
			apellido2_tercero, 
			identificacion_tercero, 
			fecha_nac_tercero, 
			direccion_tercero, 
			telefono1_tercero, 
			correo_tercero, 
			cod_info_factura_venta_carrito_compra, 
			cod_estado_revisado, 
			cod_estado_revisado_cocina, 
			cod_estado_revisado_bartender, 
			cod_estado_revisado_jugueria, 
			cod_estado_revisado_universal, 
			cod_estado_revisado_notificacion_vendedor, 
			cod_tipo_metodo_envio, 
			cod_tipo_aplicacion, 
			cod_zona_envio, 
			cod_estado_cava, 
			cod_cuentas_cobrar, 
			monto_deuda, 
			monto_deuda_sin_interes, 
			subtotal, 
			abonado, 
			subtotal_sin_interes, 
			numero_cuota, 
			monto_cuota, 
			monto_cuota_sin_interes, 
			interes_ptj, 
			monto_deuda_mas_interes, 
			monto_cuota_interes, 
			nombre_tipo_cobro, 
			nombre_factura_remision, 
			nombre_tipo_pendiente, 
			descripcion_tipo_pendiente, 
			fecha_entrega, 
			hora_entrega, 
			nombre_elaboro, 
			fecha_pago, 
			cod_dia_semana, 
			cod_estado_check_factura_electronica, 
			cod_estado_factura_electronica_enviado_dian, 
			cod_factura_antigua, 
			fecha_ymd_parqueo_ini, 
			fecha_hora_parqueo_ini, 
			fecha_ymd_parqueo_fin, 
			fecha_hora_parqueo_fin, 
			cod_estado_habitacion_hotel, 
			cod_tipo_habitacion_hotel, 
			total_horas, 
			cod_info_factura_venta_appdomicilio, 
			cod_domiciliario, 
			cod_puc, 
			dataico_email_status, 
			dataico_uuid, 
			dataico_issue_date, 
			dataico_dian_messages, 
			dataico_payment_date, 
			dataico_xml_url, 
			dataico_customer_status, 
			dataico_validation_date, 
			dataico_qrcode, 
			dataico_xml, 
			dataico_invoice_type_code, 
			dataico_pdf_url, 
			dataico_dian_status, 
			dataico_dian_error, 
			dataico_dian_path, 
			cod_estado_factura_electronica_enviado_dataico, 
			fecha_archivado, 
			cuenta_archivado) 
			VALUES (
			'$cod_info_factura_venta', 
			'$cod_factura', 
			'$cod_tercero', 
			'$cod_caja_virtual', 
			'$cod_cufe', 
			'$cod_prioridad', 
			'$nombre_estado_factura', 
			'$cod_historia_clinica', 
			'$fecha_ini', 
			'$fecha_fin', 
			'$cod_empresa', 
			'$nombre_empresa', 
			'$razonsocial_empresa', 
			'$total_motivo', 
			'$total_muestra', 
			'$motivo', 
			'$fecha_ymdhis', 
			'$cuenta', 
			'$cod_estado_factura', 
			'$cod_base_caja', 
			'$descuento_ptj', 
			'$iva_ptj', 
			'$flete_ptj', 
			'$cod_cliente', 
			'$vlr_cancelado', 
			'$vlr_vuelto', 
			'$fecha_dia', 
			'$fecha_mes', 
			'$fecha_anyo', 
			'$anyo', 
			'$fecha_hora', 
			'$fecha_remision', 
			'$nombre_ccosto', 
			'$garantia_meses', 
			'$observacion', 
			'$cod_tipo_pago', 
			'$cod_administrador', 
			'$nombre_tipo_producto', 
			'$total_precio_compra', 
			'$total_precio_venta', 
			'$total_peso_producto', 
			'$cod_dependencia', 
			'$servicio', 
			'$cod_tipo_pedido', 
			'$cod_tipo_mantenimiento', 
			'$cod_tipo_forma_pago', 
			'$nombre_tipo_forma_pago', 
			'$descripcion_tipo_forma_pago', 
			'$nombre_tipo_factura', 
			'$nombre_tipo_moneda', 
			'$cod_cierre_caja', 
			'$fecha_creacion', 
			'$fecha_modificacion', 
			'$nombre_maquina', 
			'$cod_tipo_cobrar', 
			'$cod_estado_vacuna', 
			'$cod_resolucion_facturacion', 
			'$total_datos_data', 
			'$tiempo_ejecucion', 
			'$cod_tipo_inventario', 
			'$url_img_orig_producto', 
			'$url_img_min_producto', 
			'$observacion_tercero', 
			'$cod_cupon', 
			'$costo_cupon', 
			'$activado', 
			'$costo_tipo_envio', 
			'$cod_tipo_envio', 
			'$nombre_tipo_entrega', 
			'$direcion_misma_factura', 
			'$guarda_info_prox', 
			'$latitud', 
			'$longitud', 
			'$latitud_longitud', 
			'$latitud_confirm', 
			'$longitud_confirm', 
			'$latitud_longitud_confirm', 
			'$cod_estado', 
			'$cod_estado_cocina', 
			'$cod_estado_bartender', 
			'$cod_estado_jugueria', 
			'$cod_estado_timbre_entrada', 
			'$cod_estado_timbre_salida', 
			'$nombre1_tercero', 
			'$nombre2_tercero', 
			'$apellido1_tercero', 
			'$apellido2_tercero', 
			'$identificacion_tercero', 
			'$fecha_nac_tercero', 
			'$direccion_tercero', 
			'$telefono1_tercero', 
			'$correo_tercero', 
			'$cod_info_factura_venta_carrito_compra', 
			'$cod_estado_revisado', 
			'$cod_estado_revisado_cocina', 
			'$cod_estado_revisado_bartender', 
			'$cod_estado_revisado_jugueria', 
			'$cod_estado_revisado_universal', 
			'$cod_estado_revisado_notificacion_vendedor', 
			'$cod_tipo_metodo_envio', 
			'$cod_tipo_aplicacion', 
			'$cod_zona_envio', 
			'$cod_estado_cava', 
			'$cod_cuentas_cobrar', 
			'$monto_deuda', 
			'$monto_deuda_sin_interes', 
			'$subtotal', 
			'$abonado', 
			'$subtotal_sin_interes', 
			'$numero_cuota', 
			'$monto_cuota', 
			'$monto_cuota_sin_interes', 
			'$interes_ptj', 
			'$monto_deuda_mas_interes', 
			'$monto_cuota_interes', 
			'$nombre_tipo_cobro', 
			'$nombre_factura_remision', 
			'$nombre_tipo_pendiente', 
			'$descripcion_tipo_pendiente', 
			'$fecha_entrega', 
			'$hora_entrega', 
			'$nombre_elaboro', 
			'$fecha_pago', 
			'$cod_dia_semana', 
			'$cod_estado_check_factura_electronica', 
			'$cod_estado_factura_electronica_enviado_dian', 
			'$cod_factura_antigua', 
			'$fecha_ymd_parqueo_ini', 
			'$fecha_hora_parqueo_ini', 
			'$fecha_ymd_parqueo_fin', 
			'$fecha_hora_parqueo_fin', 
			'$cod_estado_habitacion_hotel', 
			'$cod_tipo_habitacion_hotel', 
			'$total_horas', 
			'$cod_info_factura_venta_appdomicilio', 
			'$cod_domiciliario', 
			'$cod_puc', 
			'$dataico_email_status', 
			'$dataico_uuid', 
			'$dataico_issue_date', 
			'$dataico_dian_messages', 
			'$dataico_payment_date', 
			'$dataico_xml_url', 
			'$dataico_customer_status', 
			'$dataico_validation_date', 
			'$dataico_qrcode', 
			'$dataico_xml', 
			'$dataico_invoice_type_code', 
			'$dataico_pdf_url', 
			'$dataico_dian_status', 
			'$dataico_dian_error', 
			'$dataico_dian_path', 
			'$cod_estado_factura_electronica_enviado_dataico', 
			'$fecha_archivado', 
			'$cuenta_archivado')";
			$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

			$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
			$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

			$contador_info_venta++;
			//echo '.';	
		}
		echo "<br>Total registros de Info Venta Archivados: ".$contador_info_venta;
		echo "<br>Correcto";
	}
}
?>
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