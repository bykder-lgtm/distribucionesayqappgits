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
<div class="breadcrumbs">
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<td style="text-align:left">
			<?php if ($cod_estado_modulo_producto_global == '1') { ?>
				<ul>
					<li style="font-size:20px; line-height:2">Productos</li>
					<?php if ($cod_estado_prod_reg_producto == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reg_producto.php">Registrar Productos</a></li><?php } ?>
					<?php if ($cod_estado_subproducto_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/facturacion_subproducto_temporal_producto_manual_pos.php">Asignar SubProductos</a></li><?php } ?>
					<?php if ($cod_estado_factura_compra_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/facturacion_compra_iva_inc_temporal_producto_manual_pos.php">Cargar Factura Compra Iva Inc</a></li><?php } ?>
					<?php if ($cod_estado_actualizar_und_producto_inventario_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/actualizar_unidades_producto_inventario.php">Actualizar Unidades Inventario</a></li><?php } ?>
					<?php if ($cod_estado_inventario_bodega_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_trasnferencia.php">Transferencias</a></li><?php } ?>
					<?php if ($cod_estado_transferencia_empresa_extern_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_trasnferencia_bodega.php">Transferencia Productos</a></li><?php } ?>
					<?php if ($cod_estado_auditoria_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_auditoria.php">Crear Auditoria</a></li><?php } ?>
					<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_mantenimiento.php">Mantenimiento</a></li><?php } ?>
					<?php if ($cod_estado_nuevo_inventario_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_producto_copia_inventario.php">Nuevo Inventario Productos</a></li><?php } ?>
					<?php if ($cod_estado_prod_inventario_producto_masivo == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_inventario_editable_ajax.php">Inventario Productos</a></li><?php } ?>
				</ul>
			<?php } ?>
			</td>
			<td style="text-align:left">
			<?php if ($cod_estado_modulo_contabilidad_global == '1') { ?>
				<ul>
					<li style="font-size:20px; line-height:2">Contabilidad</li>
					<li style="font-size:20px; line-height:2"><a href="../admin/lista_puc.php">Plan Unico de Cuentas (PUC)</a></li>
					<?php if ($cod_estado_pyg_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_pyg.php">Pyg</a></li><?php } ?>
					<?php if ($cod_estado_balance_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_balance_general.php">Balance General</a></li><?php } ?>
					<?php if ($cod_estado_tipo_moviento_contable_credito_debito_global == '1') { ?>
					<li style="font-size:20px; line-height:2"><a href="../admin/lista_movimiento_contable.php">Movimientos Contables</a></li><?php } else { ?>
					<li style="font-size:20px; line-height:2"><a href="../admin/lista_movimiento_contable_cuenta.php">Movimientos Contables</a></li>
					<?php } ?>
				</ul>
			<?php } ?>
			</td>
			<td style="text-align:left">
			<?php if ($cod_estado_modulo_facturacion_global == '1') { ?>
				<ul>
					<li style="font-size:20px; line-height:2">Facturas</li>
					<?php if ($cod_estado_modulo_venta_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_venta.php">Factura de Venta</a></li><?php } ?>
					<?php if ($cod_estado_factura_compra_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_compra.php">Factura de Compra</a></li><?php } ?>
				</ul>
			<?php } ?>
			</td>
			<td style="text-align:left">
			<?php if ($cod_estado_modulo_cotizacion_global == '1') { ?>
				<ul>
					<li style="font-size:20px; line-height:2">Cotizaciones</li>
					<li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_cotizacion_venta.php">Cotizacion Venta</a></li>
					<li style="font-size:20px; line-height:2"><a href="../admin/lista_info_factura_cotizacion_compra.php">Cotizacion Compra</a></li>
				</ul>
			<?php } ?>
			</td>
			<td style="text-align:left">
			<?php if ($cod_estado_modulo_venta_global == '1') { ?>
				<ul>
					<li style="font-size:20px; line-height:2">Venta</li>
					<li style="font-size:20px; line-height:2"><a href="../admin/facturacion_venta_temporal_producto_manual_pos.php">Manual</a></li>
					<li style="font-size:20px; line-height:2"><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php">Barras</a></li>
				</ul>
			<?php } ?>
			</td>
		</tr>
	</table>

	<table class="table table-striped">
		<tr>
			<td style="text-align:left">
			<?php if ($cod_estado_modulo_cuenta_global == '1') { ?>
				<ul>
					<li style="font-size:20px; line-height:2">Cuentas</li>
					<?php if ($cod_estado_cuenta_cobrar_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_cuentas_cobrar.php">Cuentas por Cobrar</a></li><?php } ?>
					<?php if ($cod_estado_cuenta_pagar_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_cuentas_pagar.php">Cuentas por Pagar</a></li><?php } ?>
					<?php if ($cod_estado_cierre_caja_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_cierre_caja.php">Cierre de Caja</a></li><?php } ?>
					<?php if ($cod_estado_egreso_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_egreso.php">Egresos</a></li><?php } ?>
				</ul>
			<?php } ?>
			</td>
			<td style="text-align:left">
				<?php if ($cod_estado_modulo_reporte_global == '1') { ?>
					<ul>
					<li style="font-size:20px; line-height:2">Reportes</li>
					<?php if ($cod_estado_modulo_venta_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_venta_fechas.php">Reporte Venta</a></li><?php } ?>
					<?php if ($cod_estado_factura_compra_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_compra_fechas.php">Reporte Compra</a></li><?php } ?>
					<?php if ($cod_estado_modulo_contabilidad_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_movimiento_contable.php">Reporte Movimiento Contable</a></li><?php } ?>
					<?php if ($cod_estado_modulo_venta_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_general.php">Reporte General</a></li><?php } ?>
					<?php if ($cod_estado_modulo_venta_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_venta_fechas_productos.php">Reporte Venta Por Producto</a></li><?php } ?>
					<?php if ($cod_estado_reporte_compra_por_producto_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_compra_fechas_productos.php">Reporte Compra Por Producto</a></li><?php } ?>
					<?php if ($cod_estado_modulo_producto_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_inventario.php">Reporte Inventario</a></li><?php } ?>
					<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_fecha_vencimiento.php">Reporte Productos a Vencer</a></li><?php } ?>
					<?php if ($cod_estado_alerta_fecha_nac_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_fecha_cumpleanos.php">Reporte Cumpleaños Terceros</a></li><?php } ?>
					<?php if ($cod_estado_grafico_estadistico_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/grafico_ventas_meses.php">Reporte Estadistico</a></li><?php } ?>
					<?php if ($cod_estado_reporte_venta_total_comision == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_venta_fechas_productos_comision_venta.php">Reporte Comision Venta</a></li><?php } ?>
					<?php if ($cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_fecha_pago_credito_venta_caducados.php">Reporte Fecha Pago Credito</a></li><?php } ?>
					<?php if ($cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_fecha_entrega_venta_caducados.php">Reporte Fecha Entrega Servicio</a></li><?php } ?>
					<?php if ($cod_estado_reporte_mantenimiento_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/reporte_fecha_mantenimiento.php">Reporte Mantenimiento de Equipos</a></li><?php } ?>
					</ul>
				<?php } ?>
			</td>
			<td style="text-align:left">
				<ul>
					<li style="font-size:20px; line-height:2">Admin</li>
					<?php if ($cod_estado_usuario_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_usuario.php">Usuarios</a></li><?php } ?>
					<?php if ($cod_estado_dependencia_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_dependencia.php">Dependencias</a></li><?php } ?>
					<?php if ($cod_estado_resolucion_factura_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_resolucion_facturacion.php">Resolucion Facturacion</a></li><?php } ?>
					<?php if ($cod_estado_numero_letra_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_letra_numero.php">Numeros Letras</a></li><?php } ?>
					<?php if ($cod_estado_abrir_cajon_monedero_driv_direct == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/abrir_cajon_monedero.php">Abrir Cajon Monedero</a></li><?php } ?>
					<?php if ($cod_estado_marca_global == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_marca.php">Marcas</a></li><?php } ?>
					<?php if ($cod_estado_nota_observacion == '1') { ?><li style="font-size:20px; line-height:2"><a href="../admin/lista_nota_observacion.php">Notas y Observaciones</a></li><?php } ?>
				</ul>
			</td>
		</tr>
	</table>
</div>
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