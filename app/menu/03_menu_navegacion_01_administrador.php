﻿<div id="decorative2">
<div class="container">
<div class="divPanel topArea notop nobottom">
<div class="row-fluid">
<div class="span12">

<div id="divLogo" class="pull-left">
<?php if ($tipo_dispositivo_encontrado == 'PC') { ?>
<a href="#" id="divSiteTitle"><img src="<?php echo $img_cabecera_emp; ?>" alt="logo"></a>
<?php } ?>
</div>

<div id="divMenuRight" class="pull-right">

<?php //if ($tipo_dispositivo == 'PC') { include_once("../admin/notificacion_publicidad_alerta.php"); } else { } ?>

<div class="navbar">
<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">MENU <span class="icon-chevron-down icon-white"></span></button>
<div class="nav-collapse collapse">
<ul class="nav nav-pills ddmenu">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_producto_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Productos<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/reg_producto.php">Registrar Productos</a></li>
<?php if ($cod_estado_subproducto_global == '1') { ?><li><a href="../admin/facturacion_subproducto_temporal_producto_manual_pos.php">Asignar SubProductos</a></li><?php } ?>
<?php if ($cod_estado_factura_compra_global == '1') { ?><li><a href="../admin/facturacion_compra_iva_inc_temporal_producto_manual_pos.php">Cargar Factura Compra Iva Inc</a></li><?php } ?>
<?php if ($cod_estado_inventario_bodega_global == '1') { ?><li><a href="../admin/lista_info_factura_trasnferencia.php">Transferencias</a></li><?php } ?>
<?php if ($cod_estado_auditoria_global == '1') { ?><li><a href="../admin/lista_info_factura_auditoria.php">Crear Auditoria</a></li><?php } ?>
<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?><li class="dropdown"><a href="../admin/lista_info_factura_mantenimiento.php">Mantenimiento</a></li><?php } ?>
<?php if ($cod_estado_nuevo_inventario_global == '1') { ?><li><a href="../admin/lista_info_producto_copia_inventario.php">Nuevo Inventario Productos</a></li><?php } ?>
<?php if ($cod_estado_prod_inventario_producto_masivo == '1') { ?><li><a href="../admin/lista_inventario_editable_ajax.php">Inventario Productos</a></li><?php } ?>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_contabilidad_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Contabilidad<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/lista_puc.php">Plan Unico de Cuentas (PUC)</a></li>
<?php if ($cod_estado_pyg_global == '1') { ?><li><a href="../admin/lista_pyg.php">Pyg</a></li><?php } ?>
<?php if ($cod_estado_balance_global == '1') { ?><li><a href="../admin/lista_balance_general.php">Balance General</a></li><?php } ?>
<li><a href="../admin/lista_movimiento_contable_cuenta.php">Movimientos Contables</a></li>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_parqueo_hotel_global == '1') { ?>
<li class="dropdown active"><a href="../admin/lista_info_factura_parqueo_cotizacion_venta.php" class="dropdown-toggle">Parqueadero</a>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_facturacion_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Facturación<b class="caret"></b></a>
<ul class="dropdown-menu">
<?php if ($cod_estado_modulo_venta_global == '1') { ?><li><a href="../admin/lista_info_factura_venta.php">Factura de Venta</a></li><?php } ?>
<?php if ($cod_estado_factura_compra_global == '1') { ?><li><a href="../admin/lista_info_factura_compra.php">Factura de Compra</a></li><?php } ?>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_cotizacion_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Cotizacion<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/lista_info_factura_cotizacion_venta.php">Cotizacion Venta</a></li>
<li><a href="../admin/lista_info_factura_cotizacion_compra.php">Cotizacion Compra</a></li>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_orden_produccion_global == '1') { ?>
<li class="dropdown"><a href="../admin/lista_info_factura_orden_produccion_venta.php">Orden Produccion</a></li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_venta_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Venta<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/facturacion_venta_temporal_producto_manual_pos.php">Manual</a></li>
<li><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php">Barras</a></li>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_tercero_global == '1') { ?><li class="dropdown"><a href="../admin/lista_tercero.php">Terceros</a></li><?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_cita_global == '1') { ?><li class="dropdown"><a href="../admin/lista_info_factura_cita_venta.php">Citas</a></li><?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_cuenta_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Cuentas<b class="caret"></b></a>
<ul class="dropdown-menu">
<?php if ($cod_estado_cuenta_cobrar_global == '1') { ?><li><a href="../admin/lista_cuentas_cobrar.php">Cuentas por Cobrar</a></li><?php } ?>
<?php if ($cod_estado_cuenta_pagar_global == '1') { ?><li><a href="../admin/lista_cuentas_pagar.php">Cuentas por Pagar</a></li><?php } ?>
<?php if ($cod_estado_cierre_caja_global == '1') { ?><li><a href="../admin/lista_cierre_caja.php">Cierre de Caja</a></li><?php } ?>
<?php if ($cod_estado_egreso_global == '1') { ?><li><a href="../admin/lista_egreso.php">Egresos</a></li><?php } ?>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_sticker_barras_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Sticker<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/lista_info_factura_sticker.php">Sticker Barras</a></li>
<li><a href="../admin/importar_archivo_csv_stiker_barras_xlsx_ajax.php">Importar Archivo Sticker Barras</a></li>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_modulo_reporte_global == '1') { ?>
<li class="dropdown active"><a href="#" class="dropdown-toggle">Reporte<b class="caret"></b></a>
<ul class="dropdown-menu">
<?php if ($cod_estado_modulo_venta_global == '1') { ?><li><a href="../admin/reporte_venta_fechas.php">Reporte Venta</a></li><?php } ?>
<?php if ($cod_estado_factura_compra_global == '1') { ?><li><a href="../admin/reporte_compra_fechas.php">Reporte Compra</a></li><?php } ?>
<?php if ($cod_estado_modulo_contabilidad_global == '1') { ?><li><a href="../admin/reporte_movimiento_contable.php">Reporte Movimiento Contable</a></li><?php } ?>
<?php if ($cod_estado_modulo_venta_global == '1') { ?><li><a href="../admin/reporte_general.php">Reporte General</a></li><?php } ?>
<?php if ($cod_estado_modulo_venta_global == '1') { ?><li><a href="../admin/reporte_venta_fechas_productos.php">Reporte Venta Por Producto</a></li><?php } ?>
<?php if ($cod_estado_modulo_producto_global == '1') { ?><li><a href="../admin/reporte_inventario.php">Reporte Inventario</a></li><?php } ?>
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?><li><a href="../admin/reporte_fecha_vencimiento.php">Reporte Productos a Vencer</a></li><?php } ?>
<?php if ($cod_estado_alerta_fecha_nac_global == '1') { ?><li><a href="../admin/reporte_fecha_cumpleanos.php">Reporte Cumpleaños Terceros</a></li><?php } ?>
</ul>
</li>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<li class="dropdown active"><a href="#" class="dropdown-toggle">Admin<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/lista_info_empresa.php">Info Empresa</a></li>
<li><a href="../admin/lista_seguridad.php">Tipo de Roles</a></li>
<?php if ($cod_estado_usuario_global == '1') { ?><li><a href="../admin/lista_usuario.php">Usuarios</a></li><?php } ?>
<?php if ($cod_estado_dependencia_global == '1') { ?><li><a href="../admin/lista_dependencia.php">Dependencias</a></li><?php } ?>
<?php if ($cod_estado_categoria_global == '1') { ?><li><a href="../admin/lista_categoria.php">Categorias</a></li><?php } ?>
<?php if ($cod_estado_cantidad_caja_mesa_global == '1') { ?><li><a href="../admin/lista_caja_mesa.php">Cajas Mesas Vendedor</a></li><?php } ?>
<?php if ($cod_estado_resolucion_factura_global == '1') { ?><li><a href="../admin/lista_resolucion_facturacion.php">Resolucion Facturacion</a></li><?php } ?>
<?php if ($cod_estado_numero_letra_global == '1') { ?><li><a href="../admin/lista_letra_numero.php">Numeros Letras</a></li><?php } ?>
<li><a href="../admin/lista_puc.php">Lista PUC</a></li>
<?php if ($cod_estado_resolucion_factura_global == '1') { ?><li><a href="../admin/lista_resolucion_facturacion.php">Resolucion Facturacion</a></li><?php } ?>
<?php if ($cod_estado_productos_con_problema_precios == '1') { ?><li><a href="../admin/lista_inventario_editable_ajax_problema_precios.php">Productos con problemas en los precios</a></li><?php } ?>
<?php if ($cod_estado_domiciliario == '1') { ?><li><a href="../admin/lista_domiciliario.php">Domiciliarios</a></li><?php } ?>
<li><a href="../admin/lista_parametrizacion_modulos_tipo_forma_pago.php">Parametrizar plan unico de cuentas (PUC)</a></li>
<li><a href="../admin/reporte_historial_de_trazabilidad_rastreo_comportamiento_por_producto.php">Reporte Historial Trazabilidad Rastreo Comportamiento Producto Caja</a></li>
<?php if ($cod_estado_egreso_editar == '1') { ?><li><a href="../admin/lista_egreso_movimiento_caja_fisica.php">Saldo Caja</a></li><?php } ?>
<li><a href="../admin/lista_envio_correo.php">Correos enviados</a></li>
<li><a href="../admin/lista_producto_auxiliar.php">Productos Auxiliares</a></li>
<li><a href="../admin/lista_asignacion_tipo_unidad_medida_segun_tipo_precio_venta.php">Asignacion de Precios Segun Tipo de Venta</a></li>
<?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?><li><a href="../admin/lista_puntos_redimibles_campanya.php">Puntos Redimibles Campaña</a></li><?php } ?>
<li><a href="../admin/copia_seguridad_manual_mysqldump_reg.php">Crear copia de seguridad</a></li>
<!--<li><a href="../admin/lista_videotutorial.php">Videotutorial</a></li>-->
<li><a href="../licencia/licencia_gpl_espanol.pdf" target="_blank">Licencia Español</a></li>
<li><a href="../licencia/licencia_gpl_ingles.pdf" target="_blank">Licencia Ingles</a></li>
<li><a href="https://github.com/editaxe/Hlaboral" target="_blank">Repositorio</a></li>
<li><a href="../admin/menu_eliminar.php">Eliminar</a></li>
</ul>
</li>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<li class="dropdown"><a href="../session/salir.php?token=<?php echo $token ?>">Salir</a></li>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="breadcrumbs"><a href="#"><h6>HOLA <?php echo $nombres_des.' '.$apellidos_des; ?></a></h6></div>