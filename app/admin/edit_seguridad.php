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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Tipo de Rol</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_seguridad                                                       = intval($_GET['cod_seguridad']);
$pagina                                                              = addslashes($_GET['pagina']);

$sql_datos_permiso_usuario = "SELECT * FROM tbl15_seguridad WHERE cod_seguridad = '$cod_seguridad'";
$consulta_datos_permiso_usuario = mysqli_query($conectar, $sql_datos_permiso_usuario) or die(mysqli_error($conectar));
$matriz_datos_permiso_usuario = mysqli_fetch_assoc($consulta_datos_permiso_usuario);

$nombre_seguridad                                                    = $matriz_datos_permiso_usuario['nombre_seguridad'];
$funcion                                                             = $matriz_datos_permiso_usuario['funcion'];
$cod_estado                                                          = $matriz_datos_permiso_usuario['cod_estado'];

$cod_estado_prod                                                     = $matriz_datos_permiso_usuario['cod_estado_prod'];
$cod_estado_prod_reg_producto                                        = $matriz_datos_permiso_usuario['cod_estado_prod_reg_producto'];
$cod_estado_prod_asig_subproducto                                    = $matriz_datos_permiso_usuario['cod_estado_prod_asig_subproducto'];
$cod_estado_prod_cargar_factura_compra                               = $matriz_datos_permiso_usuario['cod_estado_prod_cargar_factura_compra'];
$cod_estado_prod_cargar_factura_compra_soporte                       = $matriz_datos_permiso_usuario['cod_estado_prod_cargar_factura_compra_soporte'];
$cod_estado_prod_cargar_factura_compra_observacion                   = $matriz_datos_permiso_usuario['cod_estado_prod_cargar_factura_compra_observacion'];
$cod_estado_prod_transferencia                                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia'];
$cod_estado_prod_auditoria                                           = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria'];
$cod_estado_prod_nuevo_invenario                                     = $matriz_datos_permiso_usuario['cod_estado_prod_nuevo_invenario'];
$cod_estado_prod_inventario_producto                                 = $matriz_datos_permiso_usuario['cod_estado_prod_inventario_producto'];
$cod_estado_prod_registrar                                           = $matriz_datos_permiso_usuario['cod_estado_prod_registrar'];
$cod_estado_prod_editar                                              = $matriz_datos_permiso_usuario['cod_estado_prod_editar'];
$cod_estado_prod_eliminar                                            = $matriz_datos_permiso_usuario['cod_estado_prod_eliminar'];
$cod_estado_prod_imprimir                                            = $matriz_datos_permiso_usuario['cod_estado_prod_imprimir'];
$cod_estado_prod_exportar                                            = $matriz_datos_permiso_usuario['cod_estado_prod_exportar'];

$cod_estado_prod_subproducto                                         = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto'];
$cod_estado_prod_und_producto                                        = $matriz_datos_permiso_usuario['cod_estado_prod_und_producto'];
$cod_estado_prod_und_producto_bodega                                 = $matriz_datos_permiso_usuario['cod_estado_prod_und_producto_bodega'];
$cod_estado_prod_precio_compra_producto                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_compra_producto'];
$cod_estado_prod_precio_costo_producto                               = $matriz_datos_permiso_usuario['cod_estado_prod_precio_costo_producto'];
$cod_estado_prod_precio_venta_producto                               = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto'];
$cod_estado_prod_precio_venta_producto2                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto2'];
$cod_estado_prod_precio_venta_producto3                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto3'];
$cod_estado_prod_precio_venta_producto4                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto4'];
$cod_estado_prod_precio_venta_producto5                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto5'];
$cod_estado_prod_nombre_tipo_unidad_medida                           = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_unidad_medida'];
$cod_estado_prod_iva_ptj                                             = $matriz_datos_permiso_usuario['cod_estado_prod_iva_ptj'];
$cod_estado_prod_nombre_tipo_producto                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_producto'];
$cod_estado_prod_cod_marca                                           = $matriz_datos_permiso_usuario['cod_estado_prod_cod_marca'];
$cod_estado_prod_cod_proveedor                                       = $matriz_datos_permiso_usuario['cod_estado_prod_cod_proveedor'];
$cod_estado_prod_cod_tercero                                         = $matriz_datos_permiso_usuario['cod_estado_prod_cod_tercero'];
$cod_estado_prod_cod_estado                                          = $matriz_datos_permiso_usuario['cod_estado_prod_cod_estado'];
$cod_estado_prod_cod_dependencia                                     = $matriz_datos_permiso_usuario['cod_estado_prod_cod_dependencia'];
$cod_estado_prod_fecha_ult_compra                                    = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_ult_compra'];
$cod_estado_prod_fecha_ult_venta                                     = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_ult_venta'];
$cod_estado_prod_fecha_vencimiento                                   = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_vencimiento'];
$cod_estado_prod_tope_min                                            = $matriz_datos_permiso_usuario['cod_estado_prod_tope_min'];
$cod_estado_prod_fecha_creacion                                      = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_creacion'];
$cod_estado_prod_fecha_modificacion                                  = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_modificacion'];
$cod_estado_prod_nombre_tipo_precio_venta                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_precio_venta'];
$cod_estado_prod_url_img_orig_producto                               = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_orig_producto'];
$cod_estado_prod_url_img_min_producto                                = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_min_producto'];
$cod_estado_prod_comision_ptj                                        = $matriz_datos_permiso_usuario['cod_estado_prod_comision_ptj'];
$cod_estado_prod_dto1                                                = $matriz_datos_permiso_usuario['cod_estado_prod_dto1'];
$cod_estado_prod_dto2                                                = $matriz_datos_permiso_usuario['cod_estado_prod_dto2'];
$cod_estado_prod_ipc_ptj                                             = $matriz_datos_permiso_usuario['cod_estado_prod_ipc_ptj'];
$cod_estado_prod_precio_ipc                                          = $matriz_datos_permiso_usuario['cod_estado_prod_precio_ipc'];
$cod_estado_prod_ret_ica_ptj                                         = $matriz_datos_permiso_usuario['cod_estado_prod_ret_ica_ptj'];
$cod_estado_prod_iva_teorico_ptj                                     = $matriz_datos_permiso_usuario['cod_estado_prod_iva_teorico_ptj'];
$cod_estado_prod_tarifa_rete_vigente_ptj                             = $matriz_datos_permiso_usuario['cod_estado_prod_tarifa_rete_vigente_ptj'];
$cod_estado_prod_rete_iva_asumido_ptj                                = $matriz_datos_permiso_usuario['cod_estado_prod_rete_iva_asumido_ptj'];
$cod_estado_prod_nombre_tipo_compra                                  = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_compra'];
$cod_estado_prod_nombre_tipo_cargue_factura                          = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_cargue_factura'];
$cod_estado_prod_nombre_tipo_medida                                  = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_medida'];
$cod_estado_prod_cajas_sobre                                         = $matriz_datos_permiso_usuario['cod_estado_prod_cajas_sobre'];
$cod_estado_prod_und_sobre                                           = $matriz_datos_permiso_usuario['cod_estado_prod_und_sobre'];
$cod_estado_prod_cod_interno                                         = $matriz_datos_permiso_usuario['cod_estado_prod_cod_interno'];
$cod_estado_prod_cod_original                                        = $matriz_datos_permiso_usuario['cod_estado_prod_cod_original'];
$cod_estado_prod_codificacion                                        = $matriz_datos_permiso_usuario['cod_estado_prod_codificacion'];
$cod_estado_prod_cod_producto_serial                                 = $matriz_datos_permiso_usuario['cod_estado_prod_cod_producto_serial'];
$cod_estado_prod_fecha_mantenimiento                                 = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_mantenimiento'];
$cod_estado_prod_peso_producto                                       = $matriz_datos_permiso_usuario['cod_estado_prod_peso_producto'];

$cod_estado_plan_separe                                              = $matriz_datos_permiso_usuario['cod_estado_plan_separe'];
$cod_estado_plan_separe_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_plan_separe_registrar'];
$cod_estado_plan_separe_editar                                       = $matriz_datos_permiso_usuario['cod_estado_plan_separe_editar'];
$cod_estado_plan_separe_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_plan_separe_eliminar'];
$cod_estado_plan_separe_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_plan_separe_imprimir'];
$cod_estado_plan_separe_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_plan_separe_exportar'];

$cod_estado_contabilidad                                             = $matriz_datos_permiso_usuario['cod_estado_contabilidad'];
$cod_estado_contabilidad_mov_contable                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable'];
$cod_estado_contabilidad_mov_contable_registrar                      = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_registrar'];
$cod_estado_contabilidad_mov_contable_editar                         = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_editar'];
$cod_estado_contabilidad_mov_contable_eliminar                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_eliminar'];
$cod_estado_contabilidad_mov_contable_imprimir                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_imprimir'];
$cod_estado_contabilidad_mov_contable_exportar                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_exportar'];

$cod_estado_contabilidad_pyg                                         = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg'];
$cod_estado_contabilidad_pyg_registrar                               = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_registrar'];
$cod_estado_contabilidad_pyg_editar                                  = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_editar'];
$cod_estado_contabilidad_pyg_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_eliminar'];
$cod_estado_contabilidad_pyg_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_imprimir'];
$cod_estado_contabilidad_pyg_exportar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_exportar'];

$cod_estado_contabilidad_balance                                     = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance'];
$cod_estado_contabilidad_balance_pyg_registrar                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_registrar'];
$cod_estado_contabilidad_balance_pyg_editar                          = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_editar'];
$cod_estado_contabilidad_balance_pyg_eliminar                        = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_eliminar'];
$cod_estado_contabilidad_balance_pyg_imprimir                        = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_imprimir'];
$cod_estado_contabilidad_balance_pyg_exportar                        = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_exportar'];

$cod_estado_contabilidad_puc                                         = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc'];
$cod_estado_contabilidad_puc_registrar                               = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_registrar'];
$cod_estado_contabilidad_puc_editar                                  = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_editar'];
$cod_estado_contabilidad_puc_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_eliminar'];
$cod_estado_contabilidad_puc_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_imprimir'];
$cod_estado_contabilidad_puc_exportar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_exportar'];

$cod_estado_facturacion                                              = $matriz_datos_permiso_usuario['cod_estado_facturacion'];
$cod_estado_facturacion_venta                                        = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta'];
$cod_estado_facturacion_venta_registrar                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_registrar'];
$cod_estado_facturacion_venta_editar                                 = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_editar'];
$cod_estado_facturacion_venta_eliminar                               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_eliminar'];
$cod_estado_facturacion_venta_imprimir                               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_imprimir'];
$cod_estado_facturacion_venta_exportar                               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_exportar'];
$cod_estado_facturacion_venta_devol                                  = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_devol'];

$cod_estado_facturacion_compra                                       = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra'];
$cod_estado_facturacion_compra_registrar                             = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_registrar'];
$cod_estado_facturacion_compra_editar                                = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_editar'];
$cod_estado_facturacion_compra_eliminar                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_eliminar'];
$cod_estado_facturacion_compra_imprimir                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_imprimir'];
$cod_estado_facturacion_compra_exportar                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_exportar'];
$cod_estado_facturacion_compra_devol                                 = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_devol'];

$cod_estado_facturacion_devol_venta                                  = $matriz_datos_permiso_usuario['cod_estado_facturacion_devol_venta'];
$cod_estado_facturacion_devol_inventario                             = $matriz_datos_permiso_usuario['cod_estado_facturacion_devol_inventario'];

$cod_estado_cotizacion                                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion'];
$cod_estado_cotizacion_venta                                         = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta'];
$cod_estado_cotizacion_venta_registrar                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_registrar'];
$cod_estado_cotizacion_venta_editar                                  = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_editar'];
$cod_estado_cotizacion_venta_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_eliminar'];
$cod_estado_cotizacion_venta_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_imprimir'];
$cod_estado_cotizacion_venta_exportar                                = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_exportar'];

$cod_estado_cotizacion_compra                                        = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra'];
$cod_estado_cotizacion_compra_registrar                              = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_registrar'];
$cod_estado_cotizacion_compra_editar                                 = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_editar'];
$cod_estado_cotizacion_compra_eliminar                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_eliminar'];
$cod_estado_cotizacion_compra_imprimir                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_imprimir'];
$cod_estado_cotizacion_compra_exportar                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_exportar'];

$cod_estado_venta                                                    = $matriz_datos_permiso_usuario['cod_estado_venta'];
$cod_estado_venta_manual                                             = $matriz_datos_permiso_usuario['cod_estado_venta_manual'];
$cod_estado_venta_barras                                             = $matriz_datos_permiso_usuario['cod_estado_venta_barras'];
$cod_estado_venta_fecha_venta                                        = $matriz_datos_permiso_usuario['cod_estado_venta_fecha_venta'];
$cod_estado_venta_preventa                                           = $matriz_datos_permiso_usuario['cod_estado_venta_preventa'];
$cod_estado_venta_propina                                            = $matriz_datos_permiso_usuario['cod_estado_venta_propina'];
$cod_estado_venta_bolsa                                              = $matriz_datos_permiso_usuario['cod_estado_venta_bolsa'];
$cod_estado_venta_observacion                                        = $matriz_datos_permiso_usuario['cod_estado_venta_observacion'];

$cod_estado_tercero                                                  = $matriz_datos_permiso_usuario['cod_estado_tercero'];
$cod_estado_tercero_registrar                                        = $matriz_datos_permiso_usuario['cod_estado_tercero_registrar'];
$cod_estado_tercero_editar                                           = $matriz_datos_permiso_usuario['cod_estado_tercero_editar'];
$cod_estado_tercero_eliminar                                         = $matriz_datos_permiso_usuario['cod_estado_tercero_eliminar'];
$cod_estado_tercero_imprimir                                         = $matriz_datos_permiso_usuario['cod_estado_tercero_imprimir'];
$cod_estado_tercero_exportar                                         = $matriz_datos_permiso_usuario['cod_estado_tercero_exportar'];

$cod_estado_cita                                                     = $matriz_datos_permiso_usuario['cod_estado_cita'];
$cod_estado_cita_registrar                                           = $matriz_datos_permiso_usuario['cod_estado_cita_registrar'];
$cod_estado_cita_editar                                              = $matriz_datos_permiso_usuario['cod_estado_cita_editar'];
$cod_estado_cita_eliminar                                            = $matriz_datos_permiso_usuario['cod_estado_cita_eliminar'];
$cod_estado_cita_imprimir                                            = $matriz_datos_permiso_usuario['cod_estado_cita_imprimir'];
$cod_estado_cita_exportar                                            = $matriz_datos_permiso_usuario['cod_estado_cita_exportar'];

$cod_estado_cuenta                                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta'];
$cod_estado_cuenta_cobrar                                            = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar'];
$cod_estado_cuenta_cobrar_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_registrar'];
$cod_estado_cuenta_cobrar_editar                                     = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_editar'];
$cod_estado_cuenta_cobrar_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_eliminar'];
$cod_estado_cuenta_cobrar_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_imprimir'];
$cod_estado_cuenta_cobrar_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_exportar'];

$cod_estado_cuenta_pagar                                             = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar'];
$cod_estado_cuenta_pagar_registrar                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_registrar'];
$cod_estado_cuenta_pagar_editar                                      = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_editar'];
$cod_estado_cuenta_pagar_eliminar                                    = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_eliminar'];
$cod_estado_cuenta_pagar_imprimir                                    = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_imprimir'];
$cod_estado_cuenta_pagar_exportar                                    = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_exportar'];

$cod_estado_cierre_caja                                              = $matriz_datos_permiso_usuario['cod_estado_cierre_caja'];
$cod_estado_cierre_caja_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_registrar'];
$cod_estado_cierre_caja_editar                                       = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_editar'];
$cod_estado_cierre_caja_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_eliminar'];
$cod_estado_cierre_caja_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_imprimir'];
$cod_estado_cierre_caja_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_exportar'];

$cod_estado_egreso                                                   = $matriz_datos_permiso_usuario['cod_estado_egreso'];
$cod_estado_egreso_registrar                                         = $matriz_datos_permiso_usuario['cod_estado_egreso_registrar'];
$cod_estado_egreso_editar                                            = $matriz_datos_permiso_usuario['cod_estado_egreso_editar'];
$cod_estado_egreso_eliminar                                          = $matriz_datos_permiso_usuario['cod_estado_egreso_eliminar'];
$cod_estado_egreso_imprimir                                          = $matriz_datos_permiso_usuario['cod_estado_egreso_imprimir'];
$cod_estado_egreso_exportar                                          = $matriz_datos_permiso_usuario['cod_estado_egreso_exportar'];

$cod_estado_sticker_barra                                            = $matriz_datos_permiso_usuario['cod_estado_sticker_barra'];
$cod_estado_sticker_barra_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_registrar'];
$cod_estado_sticker_barra_editar                                     = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_editar'];
$cod_estado_sticker_barra_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_eliminar'];
$cod_estado_sticker_barra_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_imprimir'];
$cod_estado_sticker_barra_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_exportar'];
$cod_estado_sticker_barra_observacion                                = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_observacion'];
$cod_estado_sticker_barra_archivo_plano                              = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_archivo_plano'];

$cod_estado_reporte                                                  = $matriz_datos_permiso_usuario['cod_estado_reporte'];
$cod_estado_reporte_venta                                            = $matriz_datos_permiso_usuario['cod_estado_reporte_venta'];
$cod_estado_reporte_venta_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_registrar'];
$cod_estado_reporte_venta_editar                                     = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_editar'];
$cod_estado_reporte_venta_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_eliminar'];
$cod_estado_reporte_venta_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_imprimir'];
$cod_estado_reporte_venta_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_exportar'];

$cod_estado_reporte_compra                                           = $matriz_datos_permiso_usuario['cod_estado_reporte_compra'];
$cod_estado_reporte_compra_registrar                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_registrar'];
$cod_estado_reporte_compra_editar                                    = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_editar'];
$cod_estado_reporte_compra_eliminar                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_eliminar'];
$cod_estado_reporte_compra_imprimir                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_imprimir'];
$cod_estado_reporte_compra_exportar                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_exportar'];

$cod_estado_reporte_general                                          = $matriz_datos_permiso_usuario['cod_estado_reporte_general'];
$cod_estado_reporte_general_registrar                                = $matriz_datos_permiso_usuario['cod_estado_reporte_general_registrar'];
$cod_estado_reporte_general_editar                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_general_editar'];
$cod_estado_reporte_general_eliminar                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_general_eliminar'];
$cod_estado_reporte_general_imprimir                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_general_imprimir'];
$cod_estado_reporte_general_exportar                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_general_exportar'];

$cod_estado_reporte_mov_contable                                     = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable'];
$cod_estado_reporte_mov_contable_registrar                           = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_registrar'];
$cod_estado_reporte_mov_contable_editar                              = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_editar'];
$cod_estado_reporte_mov_contable_eliminar                            = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_eliminar'];
$cod_estado_reporte_mov_contable_imprimir                            = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_imprimir'];
$cod_estado_reporte_mov_contable_exportar                            = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_exportar'];

$cod_estado_reporte_venta_por_producto                               = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto'];
$cod_estado_reporte_venta_por_producto_registrar                     = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_registrar'];
$cod_estado_reporte_venta_por_producto_editar                        = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_editar'];
$cod_estado_reporte_venta_por_producto_eliminar                      = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_eliminar'];
$cod_estado_reporte_venta_por_producto_imprimir                      = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_imprimir'];
$cod_estado_reporte_venta_por_producto_exportar                      = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_exportar'];

$cod_estado_reporte_inventario                                       = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario'];
$cod_estado_reporte_inventario_registrar                             = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_registrar'];
$cod_estado_reporte_inventario_editar                                = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_editar'];
$cod_estado_reporte_inventario_eliminar                              = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_eliminar'];
$cod_estado_reporte_inventario_imprimir                              = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_imprimir'];
$cod_estado_reporte_inventario_exportar                              = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_exportar'];

$cod_estado_reporte_prodcuto_vencer                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer'];
$cod_estado_reporte_prodcuto_vencer_registrar                        = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_registrar'];
$cod_estado_reporte_prodcuto_vencer_editar                           = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_editar'];
$cod_estado_reporte_prodcuto_vencer_eliminar                         = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_eliminar'];
$cod_estado_reporte_prodcuto_vencer_imprimir                         = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_imprimir'];
$cod_estado_reporte_prodcuto_vencer_exportar                         = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_exportar'];

$cod_estado_reporte_prodcuto_mantenimiento                           = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento'];
$cod_estado_reporte_prodcuto_mantenimiento_registrar                 = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_registrar'];
$cod_estado_reporte_prodcuto_mantenimiento_editar                    = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_editar'];
$cod_estado_reporte_prodcuto_mantenimiento_eliminar                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_eliminar'];
$cod_estado_reporte_prodcuto_mantenimiento_imprimir                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_imprimir'];
$cod_estado_reporte_prodcuto_mantenimiento_exportar                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_exportar'];

$cod_estado_reporte_cumplanos_tercero                                = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero'];
$cod_estado_reporte_cumplanos_tercero_registrar                      = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_registrar'];
$cod_estado_reporte_cumplanos_tercero_editar                         = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_editar'];
$cod_estado_reporte_cumplanos_tercero_eliminar                       = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_eliminar'];
$cod_estado_reporte_cumplanos_tercero_imprimir                       = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_imprimir'];
$cod_estado_reporte_cumplanos_tercero_exportar                       = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_exportar'];

$cod_estado_admin                                                    = $matriz_datos_permiso_usuario['cod_estado_admin'];

$cod_estado_info_empresa                                             = $matriz_datos_permiso_usuario['cod_estado_info_empresa'];
$cod_estado_info_empresa_registrar                                   = $matriz_datos_permiso_usuario['cod_estado_info_empresa_registrar'];
$cod_estado_info_empresa_editar                                      = $matriz_datos_permiso_usuario['cod_estado_info_empresa_editar'];
$cod_estado_info_empresa_eliminar                                    = $matriz_datos_permiso_usuario['cod_estado_info_empresa_eliminar'];
$cod_estado_info_empresa_imprimir                                    = $matriz_datos_permiso_usuario['cod_estado_info_empresa_imprimir'];
$cod_estado_info_empresa_exportar                                    = $matriz_datos_permiso_usuario['cod_estado_info_empresa_exportar'];

$cod_estado_usuario                                                  = $matriz_datos_permiso_usuario['cod_estado_usuario'];
$cod_estado_usuario_registrar                                        = $matriz_datos_permiso_usuario['cod_estado_usuario_registrar'];
$cod_estado_usuario_editar                                           = $matriz_datos_permiso_usuario['cod_estado_usuario_editar'];
$cod_estado_usuario_eliminar                                         = $matriz_datos_permiso_usuario['cod_estado_usuario_eliminar'];
$cod_estado_usuario_imprimir                                         = $matriz_datos_permiso_usuario['cod_estado_usuario_imprimir'];
$cod_estado_usuario_exportar                                         = $matriz_datos_permiso_usuario['cod_estado_usuario_exportar'];

$cod_estado_dependencia                                              = $matriz_datos_permiso_usuario['cod_estado_dependencia'];
$cod_estado_dependencia_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_dependencia_registrar'];
$cod_estado_dependencia_editar                                       = $matriz_datos_permiso_usuario['cod_estado_dependencia_editar'];
$cod_estado_dependencia_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_dependencia_eliminar'];
$cod_estado_dependencia_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_dependencia_imprimir'];
$cod_estado_dependencia_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_dependencia_exportar'];

$cod_estado_resol_facturacion                                        = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion'];
$cod_estado_resol_facturacion_registrar                              = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_registrar'];
$cod_estado_resol_facturacion_editar                                 = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_editar'];
$cod_estado_resol_facturacion_eliminar                               = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_eliminar'];
$cod_estado_resol_facturacion_imprimir                               = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_imprimir'];
$cod_estado_resol_facturacion_exportar                               = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_exportar'];

$cod_estado_numero_letras                                            = $matriz_datos_permiso_usuario['cod_estado_numero_letras'];
$cod_estado_numero_letras_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_numero_letras_registrar'];
$cod_estado_numero_letras_editar                                     = $matriz_datos_permiso_usuario['cod_estado_numero_letras_editar'];
$cod_estado_numero_letras_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_numero_letras_eliminar'];
$cod_estado_numero_letras_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_numero_letras_imprimir'];
$cod_estado_numero_letras_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_numero_letras_exportar'];

$cod_estado_eliminar                                                 = $matriz_datos_permiso_usuario['cod_estado_eliminar'];
$cod_estado_eliminar_usuario                                         = $matriz_datos_permiso_usuario['cod_estado_eliminar_usuario'];
$cod_estado_eliminar_tercero                                         = $matriz_datos_permiso_usuario['cod_estado_eliminar_tercero'];
$cod_estado_eliminar_producto                                        = $matriz_datos_permiso_usuario['cod_estado_eliminar_producto'];

$cod_estado_licencia                                                 = $matriz_datos_permiso_usuario['cod_estado_licencia'];
$cod_estado_licencia_registrar                                       = $matriz_datos_permiso_usuario['cod_estado_licencia_registrar'];
$cod_estado_licencia_editar                                          = $matriz_datos_permiso_usuario['cod_estado_licencia_editar'];
$cod_estado_licencia_imprimir                                        = $matriz_datos_permiso_usuario['cod_estado_licencia_imprimir'];
$cod_estado_licencia_exportar                                        = $matriz_datos_permiso_usuario['cod_estado_licencia_exportar'];

$cod_estado_repositorio                                              = $matriz_datos_permiso_usuario['cod_estado_repositorio'];
$cod_estado_repositorio_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_repositorio_registrar'];
$cod_estado_repositorio_editar                                       = $matriz_datos_permiso_usuario['cod_estado_repositorio_editar'];
$cod_estado_repositorio_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_repositorio_eliminar'];
$cod_estado_repositorio_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_repositorio_imprimir'];
$cod_estado_repositorio_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_repositorio_exportar'];

$cod_estado_prod_cod_rodeo                                           = $matriz_datos_permiso_usuario['cod_estado_prod_cod_rodeo'];
$cod_estado_prod_nombre_rodeo                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_rodeo'];
$cod_estado_prod_nombre_sexo                                         = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_sexo'];
$cod_estado_prod_de_monta                                            = $matriz_datos_permiso_usuario['cod_estado_prod_de_monta'];
$cod_estado_prod_nombre_estatus                                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_estatus'];
$cod_estado_prod_nombre_condicion_corporal                           = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_condicion_corporal'];
$cod_estado_prod_nombre_categoria_ingreso                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_ingreso'];
$cod_estado_prod_nombre_categoria_actual                             = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_actual'];
$cod_estado_prod_nombre_categoria_futura                             = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_futura'];
$cod_estado_prod_nombre_procedencia                                  = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_procedencia'];
$cod_estado_prod_nombre_tipo_monta                                   = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_monta'];
$cod_estado_prod_nombre_lote_categoria                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_lote_categoria'];
$cod_estado_prod_nombre_prog_reproductivo                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_prog_reproductivo'];
$cod_estado_prod_nombre_potrero                                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_potrero'];
$cod_estado_prod_nombre_lote                                         = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_lote'];
$cod_estado_prod_nombre_calidad_animal                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_calidad_animal'];
$cod_estado_prod_nombre_tipo_explotacion                             = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_explotacion'];
$cod_estado_prod_peso_compra                                         = $matriz_datos_permiso_usuario['cod_estado_prod_peso_compra'];
$cod_estado_prod_precio_compra                                       = $matriz_datos_permiso_usuario['cod_estado_prod_precio_compra'];
$cod_estado_prod_fecha_nac                                           = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_nac'];
$cod_estado_prod_fecha_compra                                        = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_compra'];
$cod_estado_prod_fecha_castracion                                    = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_castracion'];
$cod_estado_prod_nro_hierros                                         = $matriz_datos_permiso_usuario['cod_estado_prod_nro_hierros'];
$cod_estado_prod_hierro_animal                                       = $matriz_datos_permiso_usuario['cod_estado_prod_hierro_animal'];
$cod_estado_prod_numero_partos                                       = $matriz_datos_permiso_usuario['cod_estado_prod_numero_partos'];
$cod_estado_prod_id_electronica                                      = $matriz_datos_permiso_usuario['cod_estado_prod_id_electronica'];
$cod_estado_prod_nombre_raza1                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza1'];
$cod_estado_prod_nombre_raza2                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza2'];
$cod_estado_prod_nombre_raza3                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza3'];
$cod_estado_prod_nombre_raza4                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza4'];
$cod_estado_prod_ptj_raza1                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza1'];
$cod_estado_prod_ptj_raza2                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza2'];
$cod_estado_prod_ptj_raza3                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza3'];
$cod_estado_prod_ptj_raza4                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza4'];
$cod_estado_prod_id_padre                                            = $matriz_datos_permiso_usuario['cod_estado_prod_id_padre'];
$cod_estado_prod_raza_padre                                          = $matriz_datos_permiso_usuario['cod_estado_prod_raza_padre'];
$cod_estado_prod_id_madre                                            = $matriz_datos_permiso_usuario['cod_estado_prod_id_madre'];
$cod_estado_prod_raza_madre                                          = $matriz_datos_permiso_usuario['cod_estado_prod_raza_madre'];
$cod_estado_prod_partos_madre                                        = $matriz_datos_permiso_usuario['cod_estado_prod_partos_madre'];
$cod_estado_prod_id_abuelo_paterno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuelo_paterno'];
$cod_estado_prod_id_abuelo_materno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuelo_materno'];
$cod_estado_prod_nombre_abuelo_paterno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuelo_paterno'];
$cod_estado_prod_nombre_abuelo_materno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuelo_materno'];
$cod_estado_prod_raza_abuelo_paterno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuelo_paterno'];
$cod_estado_prod_raza_abuelo_materno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuelo_materno'];
$cod_estado_prod_id_abuela_paterno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuela_paterno'];
$cod_estado_prod_id_abuela_materno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuela_materno'];
$cod_estado_prod_nombre_abuela_paterno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuela_paterno'];
$cod_estado_prod_nombre_abuela_materno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuela_materno'];
$cod_estado_prod_raza_abuela_paterno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuela_paterno'];
$cod_estado_prod_raza_abuela_materno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuela_materno'];
$cod_estado_prod_nombre_tipo_concepcion                              = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_concepcion'];
$cod_estado_prod_nombre_especie                                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_especie'];
$cod_estado_prod_marcas_tatuado                                      = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_tatuado'];
$cod_estado_prod_marcas_herrado                                      = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_herrado'];
$cod_estado_prod_marcas_descornado                                   = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_descornado'];
$cod_estado_prod_marcas_castrado                                     = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_castrado'];
$cod_estado_prod_nombre_color                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_color'];
$cod_estado_prod_nombre_temperamento                                 = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_temperamento'];
$cod_estado_prod_peso_nacer                                          = $matriz_datos_permiso_usuario['cod_estado_prod_peso_nacer'];
$cod_estado_prod_aplomo_corvejon                                     = $matriz_datos_permiso_usuario['cod_estado_prod_aplomo_corvejon'];
$cod_estado_prod_aplomo_cuartilla                                    = $matriz_datos_permiso_usuario['cod_estado_prod_aplomo_cuartilla'];
$cod_estado_prod_aplomo_cascos                                       = $matriz_datos_permiso_usuario['cod_estado_prod_aplomo_cascos'];
$cod_estado_prod_genital_circun_escrotal                             = $matriz_datos_permiso_usuario['cod_estado_prod_genital_circun_escrotal'];
$cod_estado_prod_genital_prepusio                                    = $matriz_datos_permiso_usuario['cod_estado_prod_genital_prepusio'];
$cod_estado_prod_genital_potencia                                    = $matriz_datos_permiso_usuario['cod_estado_prod_genital_potencia'];
$cod_estado_prod_genital_semen                                       = $matriz_datos_permiso_usuario['cod_estado_prod_genital_semen'];
$cod_estado_prod_observacion_animal                                  = $matriz_datos_permiso_usuario['cod_estado_prod_observacion_animal'];
$cod_estado_prod_nombre_estado                                       = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_estado'];
$cod_estado_prod_nombre_tipo_movimiento                              = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_movimiento'];
$cod_estado_prod_nombre_categoria_animal_extern                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_animal_extern'];
$cod_estado_prod_cod_finca                                           = $matriz_datos_permiso_usuario['cod_estado_prod_cod_finca'];
$cod_estado_prod_nombre_finca                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_finca'];
$cod_estado_prod_nombre_categoria                                    = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria'];
$cod_estado_prod_nombre_categoria_sub                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_sub'];
$cod_estado_prod_und_inv                                             = $matriz_datos_permiso_usuario['cod_estado_prod_und_inv'];
$cod_estado_prod_descripcion_producto                                = $matriz_datos_permiso_usuario['cod_estado_prod_descripcion_producto'];
$cod_estado_prod_url_img_producto_min                                = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_producto_min'];
$cod_estado_prod_url_img_producto_orig                               = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_producto_orig'];

$cod_estado_prod_nombre_promocion                                    = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_promocion'];
$cod_estado_prod_nombre_promocion_ing                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_promocion_ing'];

$cod_estado_prod_posologia_cantidad                                  = $matriz_datos_permiso_usuario['cod_estado_prod_posologia_cantidad'];
$cod_estado_prod_posologia_peso                                      = $matriz_datos_permiso_usuario['cod_estado_prod_posologia_peso'];
$cod_estado_prod_nombre_tipo_presentacion                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_presentacion'];
$cod_estado_prod_nombre_via_administracion                           = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_via_administracion'];
$cod_estado_prod_nombre_frec_duracion                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_frec_duracion'];

$cod_estado_prod_subproducto_registrar                               = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_registrar'];
$cod_estado_prod_subproducto_editar                                  = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_editar'];
$cod_estado_prod_subproducto_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_eliminar'];
$cod_estado_prod_subproducto_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_imprimir'];
$cod_estado_prod_subproducto_exportar                                = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_exportar'];

$cod_estado_prod_transferencia_registrar                             = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_registrar'];
$cod_estado_prod_transferencia_editar                                = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_editar'];
$cod_estado_prod_transferencia_eliminar                              = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_eliminar'];
$cod_estado_prod_transferencia_imprimir                              = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_imprimir'];
$cod_estado_prod_transferencia_exportar                              = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_exportar'];

$cod_estado_prod_auditoria_registrar                                 = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_registrar'];
$cod_estado_prod_auditoria_editar                                    = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_editar'];
$cod_estado_prod_auditoria_eliminar                                  = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_eliminar'];
$cod_estado_prod_auditoria_imprimir                                  = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_imprimir'];
$cod_estado_prod_auditoria_exportar                                  = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_exportar'];

$cod_estado_eliminar_caja_mesa_virtual                               = $matriz_datos_permiso_usuario['cod_estado_eliminar_caja_mesa_virtual'];
$cod_estado_precio_compra_mod_venta                                  = $matriz_datos_permiso_usuario['cod_estado_precio_compra_mod_venta'];
$cod_estado_deshabilitar_opc_eliminar_ventatemp                      = $matriz_datos_permiso_usuario['cod_estado_deshabilitar_opc_eliminar_ventatemp'];

$cod_estado_seguridad                                                = $matriz_datos_permiso_usuario['cod_estado_seguridad'];
$cod_estado_seguridad_registrar                                      = $matriz_datos_permiso_usuario['cod_estado_seguridad_registrar'];
$cod_estado_seguridad_editar                                         = $matriz_datos_permiso_usuario['cod_estado_seguridad_editar'];
$cod_estado_seguridad_eliminar                                       = $matriz_datos_permiso_usuario['cod_estado_seguridad_eliminar'];
$cod_estado_seguridad_imprimir                                       = $matriz_datos_permiso_usuario['cod_estado_seguridad_imprimir'];
$cod_estado_seguridad_exportar                                       = $matriz_datos_permiso_usuario['cod_estado_seguridad_exportar'];

$cod_estado_grafico_estadistico                                      = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico'];
$cod_estado_grafico_estadistico_registrar                            = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_registrar'];
$cod_estado_grafico_estadistico_editar                               = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_editar'];
$cod_estado_grafico_estadistico_eliminar                             = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_eliminar'];
$cod_estado_grafico_estadistico_imprimir                             = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_imprimir'];
$cod_estado_grafico_estadistico_exportar                             = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_exportar'];

$cod_estado_nota_observacion                                         = $matriz_datos_permiso_usuario['cod_estado_nota_observacion'];
$cod_estado_nota_observacion_registrar                               = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_registrar'];
$cod_estado_nota_observacion_editar                                  = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_editar'];
$cod_estado_nota_observacion_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_eliminar'];
$cod_estado_nota_observacion_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_imprimir'];
$cod_estado_nota_observacion_exportar                                = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_exportar'];

$cod_estado_tipo_roles                                               = $matriz_datos_permiso_usuario['cod_estado_tipo_roles'];
$cod_estado_tipo_roles_registrar                                     = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_registrar'];
$cod_estado_tipo_roles_editar                                        = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_editar'];
$cod_estado_tipo_roles_eliminar                                      = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_eliminar'];
$cod_estado_tipo_roles_imprimir                                      = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_imprimir'];
$cod_estado_tipo_roles_exportar                                      = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_exportar'];

$cod_estado_agregar_productos_a_venta_facturada                      = $matriz_datos_permiso_usuario['cod_estado_agregar_productos_a_venta_facturada'];
$cod_estado_eliminar_productos_a_venta_facturada                     = $matriz_datos_permiso_usuario['cod_estado_eliminar_productos_a_venta_facturada'];
$cod_estado_habilitar_total_venta_ventatemp                          = $matriz_datos_permiso_usuario['cod_estado_habilitar_total_venta_ventatemp'];
$cod_estado_habilitar_total_venta_caja_mesa_virtual                  = $matriz_datos_permiso_usuario['cod_estado_habilitar_total_venta_caja_mesa_virtual'];
$cod_estado_habilitar_caja_mesa_virtual_en_uso                       = $matriz_datos_permiso_usuario['cod_estado_habilitar_caja_mesa_virtual_en_uso'];
$cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso           = $matriz_datos_permiso_usuario['cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso'];

$cod_estado_prod_inventario_producto_masivo                          = $matriz_datos_permiso_usuario['cod_estado_prod_inventario_producto_masivo'];
$cod_estado_prod_transferencia_extern                                = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern'];
$cod_estado_prod_transferencia_extern_registrar                      = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_registrar'];
$cod_estado_prod_transferencia_extern_editar                         = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_editar'];
$cod_estado_prod_transferencia_extern_eliminar                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_eliminar'];
$cod_estado_prod_transferencia_extern_imprimir                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_imprimir'];
$cod_estado_prod_transferencia_extern_exportar                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_exportar'];

$cod_estado_categoria                                                = $matriz_datos_permiso_usuario['cod_estado_categoria'];
$cod_estado_categoria_registrar                                      = $matriz_datos_permiso_usuario['cod_estado_categoria_registrar'];
$cod_estado_categoria_editar                                         = $matriz_datos_permiso_usuario['cod_estado_categoria_editar'];
$cod_estado_categoria_eliminar                                       = $matriz_datos_permiso_usuario['cod_estado_categoria_eliminar'];
$cod_estado_categoria_imprimir                                       = $matriz_datos_permiso_usuario['cod_estado_categoria_imprimir'];
$cod_estado_categoria_exportar                                       = $matriz_datos_permiso_usuario['cod_estado_categoria_exportar'];

$cod_estado_caja_mesa                                                = $matriz_datos_permiso_usuario['cod_estado_caja_mesa'];
$cod_estado_caja_mesa_registrar                                      = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_registrar'];
$cod_estado_caja_mesa_editar                                         = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_editar'];
$cod_estado_caja_mesa_eliminar                                       = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_eliminar'];
$cod_estado_caja_mesa_imprimir                                       = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_imprimir'];
$cod_estado_caja_mesa_exportar                                       = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_exportar'];

$cod_estado_usuario_cambiar_contrasena                               = $matriz_datos_permiso_usuario['cod_estado_usuario_cambiar_contrasena'];
$cod_estado_usuario_cambiar_firma                                    = $matriz_datos_permiso_usuario['cod_estado_usuario_cambiar_firma'];
$cod_estado_usuario_permisos_personalizados                          = $matriz_datos_permiso_usuario['cod_estado_usuario_permisos_personalizados'];
$cod_estado_usuario_permisos_asignar_matriz                          = $matriz_datos_permiso_usuario['cod_estado_usuario_permisos_asignar_matriz'];
$cod_estado_usuario_cambiar_tipo_rol                                 = $matriz_datos_permiso_usuario['cod_estado_usuario_cambiar_tipo_rol'];

$cod_estado_facturacion_venta_dependencia_user                       = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_dependencia_user'];
$cod_estado_facturacion_venta_precio_venta_predet_user               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_precio_venta_predet_user'];
$cod_estado_facturacion_venta_acceso_facturas_otros_user             = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_acceso_facturas_otros_user'];

$cod_estado_grafico_venta                                            = $matriz_datos_permiso_usuario['cod_estado_grafico_venta'];
$cod_estado_grafico_compra                                           = $matriz_datos_permiso_usuario['cod_estado_grafico_compra'];
$cod_estado_grafico_venta_compra                                     = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_compra'];
$cod_estado_grafico_venta_egreso                                     = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_egreso'];
$cod_estado_grafico_venta_tipo_pago                                  = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tipo_pago'];
$cod_estado_grafico_venta_tipo_forma_pago                            = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tipo_forma_pago'];
$cod_estado_grafico_venta_tipo_factura                               = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tipo_factura'];
$cod_estado_grafico_venta_categoria                                  = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_categoria'];
$cod_estado_grafico_venta_dependencia                                = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_dependencia'];
$cod_estado_grafico_venta_tipo_compra                                = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tipo_compra'];
$cod_estado_grafico_venta_tipo_metodo_envio                          = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tipo_metodo_envio'];
$cod_estado_grafico_venta_tipo_aplicacion                            = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tipo_aplicacion'];
$cod_estado_grafico_venta_producto                                   = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_producto'];
$cod_estado_grafico_venta_tercero                                    = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tercero'];
$cod_estado_grafico_venta_tercero_producto                           = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tercero_producto'];
$cod_estado_grafico_venta_tercero_domicilio                          = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_tercero_domicilio'];
$cod_estado_grafico_producto_mas_vendido_und_venta                   = $matriz_datos_permiso_usuario['cod_estado_grafico_producto_mas_vendido_und_venta'];
$cod_estado_grafico_producto_mas_vendido_precio_venta                = $matriz_datos_permiso_usuario['cod_estado_grafico_producto_mas_vendido_precio_venta'];
$cod_estado_grafico_producto_menos_vendido_und_venta                 = $matriz_datos_permiso_usuario['cod_estado_grafico_producto_menos_vendido_und_venta'];
$cod_estado_grafico_producto_menos_vendido_precio_venta              = $matriz_datos_permiso_usuario['cod_estado_grafico_producto_menos_vendido_precio_venta'];
$cod_estado_grafico_compra_precio_compra_precio_venta                = $matriz_datos_permiso_usuario['cod_estado_grafico_compra_precio_compra_precio_venta'];
$cod_estado_grafico_ganancia_venta_egreso                            = $matriz_datos_permiso_usuario['cod_estado_grafico_ganancia_venta_egreso'];
$cod_estado_grafico_ganancia_venta                                   = $matriz_datos_permiso_usuario['cod_estado_grafico_ganancia_venta'];
$cod_estado_grafico_venta_por_vendedor                               = $matriz_datos_permiso_usuario['cod_estado_grafico_venta_por_vendedor'];
$cod_estado_grafico_extras                                           = $matriz_datos_permiso_usuario['cod_estado_grafico_extras'];

$cod_estado_deshabilitar_und_venta_ventatemp                         = $matriz_datos_permiso_usuario['cod_estado_deshabilitar_und_venta_ventatemp'];
$cod_estado_deshabilitar_und_venta_atendido_cocina_chef              = $matriz_datos_permiso_usuario['cod_estado_deshabilitar_und_venta_atendido_cocina_chef'];

$cod_estado_reporte_venta_total_ganancia                             = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_total_ganancia'];
$cod_estado_reporte_venta_total_utilidad                             = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_total_utilidad'];
$cod_estado_reporte_venta_total_comision                             = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_total_comision'];
$cod_estado_reporte_venta_total_propina                              = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_total_propina'];

?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_seguridad_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:center">TIPO DE ROL</th>
			<th style="text-align:left">FUNCION DEL ROL</th>
		</tr></thead>
    <tbody>
    	<tr>
    		<td style="text-align:center"><input type="text" name="nombre_seguridad" value="<?php echo $nombre_seguridad ?>"  class="input-block-level" required/></td>
			<td style="text-align:center"><textarea class="input-block-level" name="funcion" rows="2" cols="20"><?php echo $funcion ?></textarea></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_producto_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO PRODUCTOS</th></tr></thead></table>

<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">MODULO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod' class="" id="cod_estado_prod" type='checkbox' value='<?php echo $cod_estado_prod ?>' <?php if($cod_estado_prod=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO VER</th>
			<td style='text-align:center'><input name='cod_estado_prod_inventario_producto' class="" id="cod_estado_prod_inventario_producto" type='checkbox' value='<?php echo $cod_estado_prod_inventario_producto ?>' <?php if($cod_estado_prod_inventario_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_reg_producto' class="" id="cod_estado_prod_reg_producto" type='checkbox' value='<?php echo $cod_estado_prod_reg_producto ?>' <?php if($cod_estado_prod_reg_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO UNIDADES</th>
			<td style='text-align:center'><input name='cod_estado_prod_und_producto' class="" id="cod_estado_prod_und_producto" type='checkbox' value='<?php echo $cod_estado_prod_und_producto ?>' <?php if($cod_estado_prod_und_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO PRECIO COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_compra_producto' class="" id="cod_estado_prod_precio_compra_producto" type='checkbox' value='<?php echo $cod_estado_prod_precio_compra_producto ?>' <?php if($cod_estado_prod_precio_compra_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO PRECIO VENTA</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_venta_producto' class="" id="cod_estado_prod_precio_venta_producto" type='checkbox' value='<?php echo $cod_estado_prod_precio_venta_producto ?>' <?php if($cod_estado_prod_precio_venta_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_editar' class="" id="cod_estado_prod_editar" type='checkbox' value='<?php echo $cod_estado_prod_editar ?>' <?php if($cod_estado_prod_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_eliminar' class="" id="cod_estado_prod_eliminar" type='checkbox' value='<?php echo $cod_estado_prod_eliminar ?>' <?php if($cod_estado_prod_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_prod_imprimir' class="" id="cod_estado_prod_imprimir" type='checkbox' value='<?php echo $cod_estado_prod_imprimir ?>' <?php if($cod_estado_prod_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_exportar' class="" id="cod_estado_prod_exportar" type='checkbox' value='<?php echo $cod_estado_prod_exportar ?>' <?php if($cod_estado_prod_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO INVENTARIO MASIVO</th>
			<td style='text-align:center'><input name='cod_estado_prod_inventario_producto_masivo' class="" id="cod_estado_prod_inventario_producto_masivo" type='checkbox' value='<?php echo $cod_estado_prod_inventario_producto_masivo ?>' <?php if($cod_estado_prod_inventario_producto_masivo=='1'){ echo 'checked'; } ?>></td>
		</tr>

		<?php if ($cod_estado_img_producto_global == '1') { ?>
		<tr>
			<th style="text-align:left">IMAGEN PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_url_img_producto_orig' class="" id="cod_estado_prod_url_img_producto_orig" type='checkbox' value='<?php echo $cod_estado_prod_url_img_producto_orig ?>' <?php if($cod_estado_prod_url_img_producto_orig=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_nuevo_inventario_global == '1') { ?>
		<tr>
			<th style="text-align:left">MODULO NUEVO INVENTARIO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nuevo_invenario' class="" id="cod_estado_prod_nuevo_invenario" type='checkbox' value='<?php echo $cod_estado_prod_nuevo_invenario ?>' <?php if($cod_estado_prod_nuevo_invenario=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
		<tr>
			<th style="text-align:left">UNIDADES BODEGA</th>
			<td style='text-align:center'><input name='cod_estado_prod_und_producto_bodega' class="" id="cod_estado_prod_und_producto_bodega" type='checkbox' value='<?php echo $cod_estado_prod_und_producto_bodega ?>' <?php if($cod_estado_prod_und_producto_bodega=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_dependencia_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO DEPENDENCIA</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_dependencia' class="" id="cod_estado_prod_cod_dependencia" type='checkbox' value='<?php echo $cod_estado_prod_cod_dependencia ?>' <?php if($cod_estado_prod_cod_dependencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO FECHA VENCIMIENTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_vencimiento' class="" id="cod_estado_prod_fecha_vencimiento" type='checkbox' value='<?php echo $cod_estado_prod_fecha_vencimiento ?>' <?php if($cod_estado_prod_fecha_vencimiento=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_ptj_comision_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO COMISION</th>
			<td style='text-align:center'><input name='cod_estado_prod_comision_ptj' class="" id="cod_estado_prod_comision_ptj" type='checkbox' value='<?php echo $cod_estado_prod_comision_ptj ?>' <?php if($cod_estado_prod_comision_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_dto1_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO DTO 1</th>
			<td style='text-align:center'><input name='cod_estado_prod_dto1' class="" id="cod_estado_prod_dto1" type='checkbox' value='<?php echo $cod_estado_prod_dto1 ?>' <?php if($cod_estado_prod_dto1=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_dto2_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO DTO 2</th>
			<td style='text-align:center'><input name='cod_estado_prod_dto2' class="" id="cod_estado_prod_dto2" type='checkbox' value='<?php echo $cod_estado_prod_dto2 ?>' <?php if($cod_estado_prod_dto2=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_impoconsumo_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO PTJ IMPOCONSUMO</th>
			<td style='text-align:center'><input name='cod_estado_prod_ipc_ptj' class="" id="cod_estado_prod_ipc_ptj" type='checkbox' value='<?php echo $cod_estado_prod_ipc_ptj ?>' <?php if($cod_estado_prod_ipc_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO PRECIO IMPOCONSUMO</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_ipc' class="" id="cod_estado_prod_precio_ipc" type='checkbox' value='<?php echo $cod_estado_prod_precio_ipc ?>' <?php if($cod_estado_prod_precio_ipc=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_compra_caja_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO CAJA SOBRE</th>
			<td style='text-align:center'><input name='cod_estado_prod_cajas_sobre' class="" id="cod_estado_prod_cajas_sobre" type='checkbox' value='<?php echo $cod_estado_prod_cajas_sobre ?>' <?php if($cod_estado_prod_cajas_sobre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO UND SOBRE</th>
			<td style='text-align:center'><input name='cod_estado_prod_und_sobre' class="" id="cod_estado_prod_und_sobre" type='checkbox' value='<?php echo $cod_estado_prod_und_sobre ?>' <?php if($cod_estado_prod_und_sobre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_producto_serial_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO SERIAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_producto_serial' class="" id="cod_estado_prod_cod_producto_serial" type='checkbox' value='<?php echo $cod_estado_prod_cod_producto_serial ?>' <?php if($cod_estado_prod_cod_producto_serial=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO FECHA MANTENIMIENTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_mantenimiento' class="" id="cod_estado_prod_fecha_mantenimiento" type='checkbox' value='<?php echo $cod_estado_prod_fecha_mantenimiento ?>' <?php if($cod_estado_prod_fecha_mantenimiento=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_peso_producto_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO PESO</th>
			<td style='text-align:center'><input name='cod_estado_prod_peso_producto' class="" id="cod_estado_prod_peso_producto" type='checkbox' value='<?php echo $cod_estado_prod_peso_producto ?>' <?php if($cod_estado_prod_peso_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_categoria_global == '1') { ?>
		<tr>
			<th style="text-align:left">PRODUCTO SUBCATEGORIA</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_categoria_sub' class="" id="cod_estado_prod_nombre_categoria_sub" type='checkbox' value='<?php echo $cod_estado_prod_nombre_categoria_sub ?>' <?php if($cod_estado_prod_nombre_categoria_sub=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>
<!--
		<tr>
			<th style="text-align:left">PRODUCTO TOPE MINIMO</th>
			<td style='text-align:center'><input name='cod_estado_prod_tope_min' class="" id="cod_estado_prod_tope_min" type='checkbox' value='<?php echo $cod_estado_prod_tope_min ?>' <?php if($cod_estado_prod_tope_min=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO TIPO PRECIO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_precio_venta' class="" id="cod_estado_prod_nombre_tipo_precio_venta" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_precio_venta ?>' <?php if($cod_estado_prod_nombre_tipo_precio_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO DESCRIPCION</th>
			<td style='text-align:center'><input name='cod_estado_prod_descripcion_producto' class="" id="cod_estado_prod_descripcion_producto" type='checkbox' value='<?php echo $cod_estado_prod_descripcion_producto ?>' <?php if($cod_estado_prod_descripcion_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO UNIDAD MEDIDA</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_unidad_medida' class="" id="cod_estado_prod_nombre_tipo_unidad_medida" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_unidad_medida ?>' <?php if($cod_estado_prod_nombre_tipo_unidad_medida=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO IVA</th>
			<td style='text-align:center'><input name='cod_estado_prod_iva_ptj' class="" id="cod_estado_prod_iva_ptj" type='checkbox' value='<?php echo $cod_estado_prod_iva_ptj ?>' <?php if($cod_estado_prod_iva_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRODUCTO TIPO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_producto' class="" id="cod_estado_prod_nombre_tipo_producto" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_producto ?>' <?php if($cod_estado_prod_nombre_tipo_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO MEDIDA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_medida' class="" id="cod_estado_prod_nombre_tipo_medida" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_medida ?>' <?php if($cod_estado_prod_nombre_tipo_medida=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">UND INVENTARIO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_und_inv' class="" id="cod_estado_prod_und_inv" type='checkbox' value='<?php echo $cod_estado_prod_und_inv ?>' <?php if($cod_estado_prod_und_inv=='1'){ echo 'checked'; } ?>></td>
		</tr>
			<tr>
			<th style="text-align:left">URL IMG MIN PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_url_img_producto_min' class="" id="cod_estado_prod_url_img_producto_min" type='checkbox' value='<?php echo $cod_estado_prod_url_img_producto_min ?>' <?php if($cod_estado_prod_url_img_producto_min=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRECIO COSTO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_costo_producto' class="" id="cod_estado_prod_precio_costo_producto" type='checkbox' value='<?php echo $cod_estado_prod_precio_costo_producto ?>' <?php if($cod_estado_prod_precio_costo_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRECIO VENTA 2 PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_venta_producto2' class="" id="cod_estado_prod_precio_venta_producto2" type='checkbox' value='<?php echo $cod_estado_prod_precio_venta_producto2 ?>' <?php if($cod_estado_prod_precio_venta_producto2=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRECIO VENTA 3 PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_venta_producto3' class="" id="cod_estado_prod_precio_venta_producto3" type='checkbox' value='<?php echo $cod_estado_prod_precio_venta_producto3 ?>' <?php if($cod_estado_prod_precio_venta_producto3=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRECIO VENTA 4 PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_venta_producto4' class="" id="cod_estado_prod_precio_venta_producto4" type='checkbox' value='<?php echo $cod_estado_prod_precio_venta_producto4 ?>' <?php if($cod_estado_prod_precio_venta_producto4=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRECIO VENTA 5 PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_venta_producto5' class="" id="cod_estado_prod_precio_venta_producto5" type='checkbox' value='<?php echo $cod_estado_prod_precio_venta_producto5 ?>' <?php if($cod_estado_prod_precio_venta_producto5=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MARCA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_marca' class="" id="cod_estado_prod_cod_marca" type='checkbox' value='<?php echo $cod_estado_prod_cod_marca ?>' <?php if($cod_estado_prod_cod_marca=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PROVEEDOR PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_proveedor' class="" id="cod_estado_prod_cod_proveedor" type='checkbox' value='<?php echo $cod_estado_prod_cod_proveedor ?>' <?php if($cod_estado_prod_cod_proveedor=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TERCERO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_tercero' class="" id="cod_estado_prod_cod_tercero" type='checkbox' value='<?php echo $cod_estado_prod_cod_tercero ?>' <?php if($cod_estado_prod_cod_tercero=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ESTADO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_estado' class="" id="cod_estado_prod_cod_estado" type='checkbox' value='<?php echo $cod_estado_prod_cod_estado ?>' <?php if($cod_estado_prod_cod_estado=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA ULTIMA COMPRA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_ult_compra' class="" id="cod_estado_prod_fecha_ult_compra" type='checkbox' value='<?php echo $cod_estado_prod_fecha_ult_compra ?>' <?php if($cod_estado_prod_fecha_ult_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA ULTIMA VENTA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_ult_venta' class="" id="cod_estado_prod_fecha_ult_venta" type='checkbox' value='<?php echo $cod_estado_prod_fecha_ult_venta ?>' <?php if($cod_estado_prod_fecha_ult_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA CREACION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_creacion' class="" id="cod_estado_prod_fecha_creacion" type='checkbox' value='<?php echo $cod_estado_prod_fecha_creacion ?>' <?php if($cod_estado_prod_fecha_creacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA MODIFICACION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_modificacion' class="" id="cod_estado_prod_fecha_modificacion" type='checkbox' value='<?php echo $cod_estado_prod_fecha_modificacion ?>' <?php if($cod_estado_prod_fecha_modificacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">IMAGEN ORIG PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_url_img_orig_producto' class="" id="cod_estado_prod_url_img_orig_producto" type='checkbox' value='<?php echo $cod_estado_prod_url_img_orig_producto ?>' <?php if($cod_estado_prod_url_img_orig_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">IMAGEN MIN PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_url_img_min_producto' class="" id="cod_estado_prod_url_img_min_producto" type='checkbox' value='<?php echo $cod_estado_prod_url_img_min_producto ?>' <?php if($cod_estado_prod_url_img_min_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RETE ICA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_ret_ica_ptj' class="" id="cod_estado_prod_ret_ica_ptj" type='checkbox' value='<?php echo $cod_estado_prod_ret_ica_ptj ?>' <?php if($cod_estado_prod_ret_ica_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">IVA TEORICO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_iva_teorico_ptj' class="" id="cod_estado_prod_iva_teorico_ptj" type='checkbox' value='<?php echo $cod_estado_prod_iva_teorico_ptj ?>' <?php if($cod_estado_prod_iva_teorico_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RETE VIGENTE PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_tarifa_rete_vigente_ptj' class="" id="cod_estado_prod_tarifa_rete_vigente_ptj" type='checkbox' value='<?php echo $cod_estado_prod_tarifa_rete_vigente_ptj ?>' <?php if($cod_estado_prod_tarifa_rete_vigente_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RETE ICA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_rete_iva_asumido_ptj' class="" id="cod_estado_prod_rete_iva_asumido_ptj" type='checkbox' value='<?php echo $cod_estado_prod_rete_iva_asumido_ptj ?>' <?php if($cod_estado_prod_rete_iva_asumido_ptj=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO COMPRA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_compra' class="" id="cod_estado_prod_nombre_tipo_compra" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_compra ?>' <?php if($cod_estado_prod_nombre_tipo_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO CARGUE PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_cargue_factura' class="" id="cod_estado_prod_nombre_tipo_cargue_factura" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_cargue_factura ?>' <?php if($cod_estado_prod_nombre_tipo_cargue_factura=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COD INTERNO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_interno' class="" id="cod_estado_prod_cod_interno" type='checkbox' value='<?php echo $cod_estado_prod_cod_interno ?>' <?php if($cod_estado_prod_cod_interno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COD ORIGINAL PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_original' class="" id="cod_estado_prod_cod_original" type='checkbox' value='<?php echo $cod_estado_prod_cod_original ?>' <?php if($cod_estado_prod_cod_original=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CODIFICACION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_codificacion' class="" id="cod_estado_prod_codificacion" type='checkbox' value='<?php echo $cod_estado_prod_codificacion ?>' <?php if($cod_estado_prod_codificacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PROMOCION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_promocion' class="" id="cod_estado_prod_nombre_promocion" type='checkbox' value='<?php echo $cod_estado_prod_nombre_promocion ?>' <?php if($cod_estado_prod_nombre_promocion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PROMOCION ING PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_promocion_ing' class="" id="cod_estado_prod_nombre_promocion_ing" type='checkbox' value='<?php echo $cod_estado_prod_nombre_promocion_ing ?>' <?php if($cod_estado_prod_nombre_promocion_ing=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">POSOLOGIA CANTIDAD PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_posologia_cantidad' class="" id="cod_estado_prod_posologia_cantidad" type='checkbox' value='<?php echo $cod_estado_prod_posologia_cantidad ?>' <?php if($cod_estado_prod_posologia_cantidad=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">POSOLOGIA PESO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_posologia_peso' class="" id="cod_estado_prod_posologia_peso" type='checkbox' value='<?php echo $cod_estado_prod_posologia_peso ?>' <?php if($cod_estado_prod_posologia_peso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO PRESENTACION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_presentacion' class="" id="cod_estado_prod_nombre_tipo_presentacion" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_presentacion ?>' <?php if($cod_estado_prod_nombre_tipo_presentacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">VIA ADMINISTRACION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_via_administracion' class="" id="cod_estado_prod_nombre_via_administracion" type='checkbox' value='<?php echo $cod_estado_prod_nombre_via_administracion ?>' <?php if($cod_estado_prod_nombre_via_administracion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FRECUENCIA DURACION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_frec_duracion' class="" id="cod_estado_prod_nombre_frec_duracion" type='checkbox' value='<?php echo $cod_estado_prod_nombre_frec_duracion ?>' <?php if($cod_estado_prod_nombre_frec_duracion=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_subproducto_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO SUBPRODUCTO</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">SUBPRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_prod_subproducto' class="" id="cod_estado_prod_subproducto" type='checkbox' value='<?php echo $cod_estado_prod_subproducto ?>' <?php if($cod_estado_prod_subproducto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">SUBPRODUCTO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_subproducto_registrar' class="" id="cod_estado_prod_subproducto_registrar" type='checkbox' value='<?php echo $cod_estado_prod_subproducto_registrar ?>' <?php if($cod_estado_prod_subproducto_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">SUBPRODUCTO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_subproducto_editar' class="" id="cod_estado_prod_subproducto_editar" type='checkbox' value='<?php echo $cod_estado_prod_subproducto_editar ?>' <?php if($cod_estado_prod_subproducto_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">SUBPRODUCTO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_subproducto_eliminar' class="" id="cod_estado_prod_subproducto_eliminar" type='checkbox' value='<?php echo $cod_estado_prod_subproducto_eliminar ?>' <?php if($cod_estado_prod_subproducto_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">SUBPRODUCTO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_prod_subproducto_imprimir' class="" id="cod_estado_prod_subproducto_imprimir" type='checkbox' value='<?php echo $cod_estado_prod_subproducto_imprimir ?>' <?php if($cod_estado_prod_subproducto_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">SUBPRODUCTO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_subproducto_exportar' class="" id="cod_estado_prod_subproducto_exportar" type='checkbox' value='<?php echo $cod_estado_prod_subproducto_exportar ?>' <?php if($cod_estado_prod_subproducto_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_factura_compra_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO FACTURA COMPRA</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra' class="" id="cod_estado_facturacion_compra" type='checkbox' value='<?php echo $cod_estado_facturacion_compra ?>' <?php if($cod_estado_facturacion_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CARGAR FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_prod_cargar_factura_compra' class="" id="cod_estado_prod_cargar_factura_compra" type='checkbox' value='<?php echo $cod_estado_prod_cargar_factura_compra ?>' <?php if($cod_estado_prod_cargar_factura_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>

		<?php if ($cod_estado_soporte_factura_compra_global == '1') { ?>
		<tr>
			<th style="text-align:left">SOPORTE FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_prod_cargar_factura_compra_soporte' class="" id="cod_estado_prod_cargar_factura_compra_soporte" type='checkbox' value='<?php echo $cod_estado_prod_cargar_factura_compra_soporte ?>' <?php if($cod_estado_prod_cargar_factura_compra_soporte=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_observacion_factura_compra_global == '1') { ?>
		<tr>
			<th style="text-align:left">OBSERVACION FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_prod_cargar_factura_compra_observacion' class="" id="cod_estado_prod_cargar_factura_compra_observacion" type='checkbox' value='<?php echo $cod_estado_prod_cargar_factura_compra_observacion ?>' <?php if($cod_estado_prod_cargar_factura_compra_observacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<tr>
			<th style="text-align:left">FACTURA COMPRA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra_registrar' class="" id="cod_estado_facturacion_compra_registrar" type='checkbox' value='<?php echo $cod_estado_facturacion_compra_registrar ?>' <?php if($cod_estado_facturacion_compra_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA COMPRA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra_editar' class="" id="cod_estado_facturacion_compra_editar" type='checkbox' value='<?php echo $cod_estado_facturacion_compra_editar ?>' <?php if($cod_estado_facturacion_compra_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA COMPRA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra_eliminar' class="" id="cod_estado_facturacion_compra_eliminar" type='checkbox' value='<?php echo $cod_estado_facturacion_compra_eliminar ?>' <?php if($cod_estado_facturacion_compra_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA COMPRA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra_imprimir' class="" id="cod_estado_facturacion_compra_imprimir" type='checkbox' value='<?php echo $cod_estado_facturacion_compra_imprimir ?>' <?php if($cod_estado_facturacion_compra_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA COMPRA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra_exportar' class="" id="cod_estado_facturacion_compra_exportar" type='checkbox' value='<?php echo $cod_estado_facturacion_compra_exportar ?>' <?php if($cod_estado_facturacion_compra_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA COMPRA DEVOLUCION</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_compra_devol' class="" id="cod_estado_facturacion_compra_devol" type='checkbox' value='<?php echo $cod_estado_facturacion_compra_devol ?>' <?php if($cod_estado_facturacion_compra_devol=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO TRANSFERENCIAS BODEGA (INTERNAS)</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia' class="" id="cod_estado_prod_transferencia" type='checkbox' value='<?php echo $cod_estado_prod_transferencia ?>' <?php if($cod_estado_prod_transferencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_registrar' class="" id="cod_estado_prod_transferencia_registrar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_registrar ?>' <?php if($cod_estado_prod_transferencia_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_editar' class="" id="cod_estado_prod_transferencia_editar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_editar ?>' <?php if($cod_estado_prod_transferencia_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_eliminar' class="" id="cod_estado_prod_transferencia_eliminar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_eliminar ?>' <?php if($cod_estado_prod_transferencia_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_imprimir' class="" id="cod_estado_prod_transferencia_imprimir" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_imprimir ?>' <?php if($cod_estado_prod_transferencia_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_exportar' class="" id="cod_estado_prod_transferencia_exportar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_exportar ?>' <?php if($cod_estado_prod_transferencia_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_transferencia_empresa_extern_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO TRANSFERENCIAS EXTERNAS</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXTERNAS</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_extern' class="" id="cod_estado_prod_transferencia_extern" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_extern ?>' <?php if($cod_estado_prod_transferencia_extern=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXTERNAS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_extern_registrar' class="" id="cod_estado_prod_transferencia_extern_registrar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_extern_registrar ?>' <?php if($cod_estado_prod_transferencia_extern_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXTERNAS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_extern_editar' class="" id="cod_estado_prod_transferencia_extern_editar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_extern_editar ?>' <?php if($cod_estado_prod_transferencia_extern_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXTERNAS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_extern_eliminar' class="" id="cod_estado_prod_transferencia_extern_eliminar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_extern_eliminar ?>' <?php if($cod_estado_prod_transferencia_extern_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXTERNAS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_extern_imprimir' class="" id="cod_estado_prod_transferencia_extern_imprimir" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_extern_imprimir ?>' <?php if($cod_estado_prod_transferencia_extern_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TRANSFERENCIAS EXTERNAS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_transferencia_extern_exportar' class="" id="cod_estado_prod_transferencia_extern_exportar" type='checkbox' value='<?php echo $cod_estado_prod_transferencia_extern_exportar ?>' <?php if($cod_estado_prod_transferencia_extern_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>

<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_auditoria_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO AUDITORIAS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">AUDITORIAS</th>
			<td style='text-align:center'><input name='cod_estado_prod_auditoria' class="" id="cod_estado_prod_auditoria" type='checkbox' value='<?php echo $cod_estado_prod_auditoria ?>' <?php if($cod_estado_prod_auditoria=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">AUDITORIAS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_auditoria_registrar' class="" id="cod_estado_prod_auditoria_registrar" type='checkbox' value='<?php echo $cod_estado_prod_auditoria_registrar ?>' <?php if($cod_estado_prod_auditoria_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">AUDITORIAS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_auditoria_editar' class="" id="cod_estado_prod_auditoria_editar" type='checkbox' value='<?php echo $cod_estado_prod_auditoria_editar ?>' <?php if($cod_estado_prod_auditoria_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">AUDITORIAS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_auditoria_eliminar' class="" id="cod_estado_prod_auditoria_eliminar" type='checkbox' value='<?php echo $cod_estado_prod_auditoria_eliminar ?>' <?php if($cod_estado_prod_auditoria_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">AUDITORIAS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_prod_auditoria_imprimir' class="" id="cod_estado_prod_auditoria_imprimir" type='checkbox' value='<?php echo $cod_estado_prod_auditoria_imprimir ?>' <?php if($cod_estado_prod_auditoria_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">AUDITORIAS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_prod_auditoria_exportar' class="" id="cod_estado_prod_auditoria_exportar" type='checkbox' value='<?php echo $cod_estado_prod_auditoria_exportar ?>' <?php if($cod_estado_prod_auditoria_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_plan_separe_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO SEPARE</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">PAN SEPARE</th>
			<td style='text-align:center'><input name='cod_estado_plan_separe' class="" id="cod_estado_plan_separe" type='checkbox' value='<?php echo $cod_estado_plan_separe ?>' <?php if($cod_estado_plan_separe=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PAN SEPARE REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_plan_separe_registrar' class="" id="cod_estado_plan_separe_registrar" type='checkbox' value='<?php echo $cod_estado_plan_separe_registrar ?>' <?php if($cod_estado_plan_separe_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PAN SEPARE EDITAR </th>
			<td style='text-align:center'><input name='cod_estado_plan_separe_editar' class="" id="cod_estado_plan_separe_editar" type='checkbox' value='<?php echo $cod_estado_plan_separe_editar ?>' <?php if($cod_estado_plan_separe_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PAN SEPARE ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_plan_separe_eliminar' class="" id="cod_estado_plan_separe_eliminar" type='checkbox' value='<?php echo $cod_estado_plan_separe_eliminar ?>' <?php if($cod_estado_plan_separe_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PAN SEPARE IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_plan_separe_imprimir' class="" id="cod_estado_plan_separe_imprimir" type='checkbox' value='<?php echo $cod_estado_plan_separe_imprimir ?>' <?php if($cod_estado_plan_separe_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PAN SEPARE EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_plan_separe_exportar' class="" id="cod_estado_plan_separe_exportar" type='checkbox' value='<?php echo $cod_estado_plan_separe_exportar ?>' <?php if($cod_estado_plan_separe_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_contabilidad_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO CONTABILIDAD</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">CONTABILIDAD</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad' class="" id="cod_estado_contabilidad" type='checkbox' value='<?php echo $cod_estado_contabilidad ?>' <?php if($cod_estado_contabilidad=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CONTABILIDAD MOV CONTABLE</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_mov_contable' class="" id="cod_estado_contabilidad_mov_contable" type='checkbox' value='<?php echo $cod_estado_contabilidad_mov_contable ?>' <?php if($cod_estado_contabilidad_mov_contable=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MOV CONTABLE REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_mov_contable_registrar' class="" id="cod_estado_contabilidad_mov_contable_registrar" type='checkbox' value='<?php echo $cod_estado_contabilidad_mov_contable_registrar ?>' <?php if($cod_estado_contabilidad_mov_contable_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MOV CONTABLE EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_mov_contable_editar' class="" id="cod_estado_contabilidad_mov_contable_editar" type='checkbox' value='<?php echo $cod_estado_contabilidad_mov_contable_editar ?>' <?php if($cod_estado_contabilidad_mov_contable_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MOV CONTABLE ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_mov_contable_eliminar' class="" id="cod_estado_contabilidad_mov_contable_eliminar" type='checkbox' value='<?php echo $cod_estado_contabilidad_mov_contable_eliminar ?>' <?php if($cod_estado_contabilidad_mov_contable_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MOV CONTABLE IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_mov_contable_imprimir' class="" id="cod_estado_contabilidad_mov_contable_imprimir" type='checkbox' value='<?php echo $cod_estado_contabilidad_mov_contable_imprimir ?>' <?php if($cod_estado_contabilidad_mov_contable_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MOV CONTABLE EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_mov_contable_exportar' class="" id="cod_estado_contabilidad_mov_contable_exportar" type='checkbox' value='<?php echo $cod_estado_contabilidad_mov_contable_exportar ?>' <?php if($cod_estado_contabilidad_mov_contable_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>

		<?php if ($cod_estado_pyg_global == '1') { ?>
		<tr>
			<th style="text-align:left">PYG</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_pyg' class="" id="cod_estado_contabilidad_pyg" type='checkbox' value='<?php echo $cod_estado_contabilidad_pyg ?>' <?php if($cod_estado_contabilidad_pyg=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PYG REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_pyg_registrar' class="" id="cod_estado_contabilidad_pyg_registrar" type='checkbox' value='<?php echo $cod_estado_contabilidad_pyg_registrar ?>' <?php if($cod_estado_contabilidad_pyg_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PYG EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_pyg_editar' class="" id="cod_estado_contabilidad_pyg_editar" type='checkbox' value='<?php echo $cod_estado_contabilidad_pyg_editar ?>' <?php if($cod_estado_contabilidad_pyg_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PYG ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_pyg_eliminar' class="" id="cod_estado_contabilidad_pyg_eliminar" type='checkbox' value='<?php echo $cod_estado_contabilidad_pyg_eliminar ?>' <?php if($cod_estado_contabilidad_pyg_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PYG IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_pyg_imprimir' class="" id="cod_estado_contabilidad_pyg_imprimir" type='checkbox' value='<?php echo $cod_estado_contabilidad_pyg_imprimir ?>' <?php if($cod_estado_contabilidad_pyg_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PYG EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_pyg_exportar' class="" id="cod_estado_contabilidad_pyg_exportar" type='checkbox' value='<?php echo $cod_estado_contabilidad_pyg_exportar ?>' <?php if($cod_estado_contabilidad_pyg_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_balance_global == '1') { ?>
		<tr>
			<th style="text-align:left">BALANCE</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_balance' class="" id="cod_estado_contabilidad_balance" type='checkbox' value='<?php echo $cod_estado_contabilidad_balance ?>' <?php if($cod_estado_contabilidad_balance=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">BALANCE REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_balance_pyg_registrar' class="" id="cod_estado_contabilidad_balance_pyg_registrar" type='checkbox' value='<?php echo $cod_estado_contabilidad_balance_pyg_registrar ?>' <?php if($cod_estado_contabilidad_balance_pyg_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">BALANCE EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_balance_pyg_editar' class="" id="cod_estado_contabilidad_balance_pyg_editar" type='checkbox' value='<?php echo $cod_estado_contabilidad_balance_pyg_editar ?>' <?php if($cod_estado_contabilidad_balance_pyg_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">BALANCE ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_balance_pyg_eliminar' class="" id="cod_estado_contabilidad_balance_pyg_eliminar" type='checkbox' value='<?php echo $cod_estado_contabilidad_balance_pyg_eliminar ?>' <?php if($cod_estado_contabilidad_balance_pyg_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">BALANCE IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_balance_pyg_imprimir' class="" id="cod_estado_contabilidad_balance_pyg_imprimir" type='checkbox' value='<?php echo $cod_estado_contabilidad_balance_pyg_imprimir ?>' <?php if($cod_estado_contabilidad_balance_pyg_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">BALANCE EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_balance_pyg_exportar' class="" id="cod_estado_contabilidad_balance_pyg_exportar" type='checkbox' value='<?php echo $cod_estado_contabilidad_balance_pyg_exportar ?>' <?php if($cod_estado_contabilidad_balance_pyg_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<tr>
			<th style="text-align:left">PUC</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_puc' class="" id="cod_estado_contabilidad_puc" type='checkbox' value='<?php echo $cod_estado_contabilidad_puc ?>' <?php if($cod_estado_contabilidad_puc=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PUC REGISTAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_puc_registrar' class="" id="cod_estado_contabilidad_puc_registrar" type='checkbox' value='<?php echo $cod_estado_contabilidad_puc_registrar ?>' <?php if($cod_estado_contabilidad_puc_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PUC EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_puc_editar' class="" id="cod_estado_contabilidad_puc_editar" type='checkbox' value='<?php echo $cod_estado_contabilidad_puc_editar ?>' <?php if($cod_estado_contabilidad_puc_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PUC ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_puc_eliminar' class="" id="cod_estado_contabilidad_puc_eliminar" type='checkbox' value='<?php echo $cod_estado_contabilidad_puc_eliminar ?>' <?php if($cod_estado_contabilidad_puc_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PUC IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_puc_imprimir' class="" id="cod_estado_contabilidad_puc_imprimir" type='checkbox' value='<?php echo $cod_estado_contabilidad_puc_imprimir ?>' <?php if($cod_estado_contabilidad_puc_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PUC EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_contabilidad_puc_exportar' class="" id="cod_estado_contabilidad_puc_exportar" type='checkbox' value='<?php echo $cod_estado_contabilidad_puc_exportar ?>' <?php if($cod_estado_contabilidad_puc_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_facturacion_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">FACTURACION</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">FACTURACION</th>
			<td style='text-align:center'><input name='cod_estado_facturacion' class="" id="cod_estado_facturacion" type='checkbox' value='<?php echo $cod_estado_facturacion ?>' <?php if($cod_estado_facturacion=='1'){ echo 'checked'; } ?>></td>
		</tr>


	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->

<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">FACTURACION </th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">DEVOLUCION VENTA</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_devol_venta' class="" id="cod_estado_facturacion_devol_venta" type='checkbox' value='<?php echo $cod_estado_facturacion_devol_venta ?>' <?php if($cod_estado_facturacion_devol_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DEVOLUCION INVENTARIO</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_devol_inventario' class="" id="cod_estado_facturacion_devol_inventario" type='checkbox' value='<?php echo $cod_estado_facturacion_devol_inventario ?>' <?php if($cod_estado_facturacion_devol_inventario=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>

<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_cotizacion_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">COTIZACION</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">COTIZACION</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion' class="" id="cod_estado_cotizacion" type='checkbox' value='<?php echo $cod_estado_cotizacion ?>' <?php if($cod_estado_cotizacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION VENTA</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_venta' class="" id="cod_estado_cotizacion_venta" type='checkbox' value='<?php echo $cod_estado_cotizacion_venta ?>' <?php if($cod_estado_cotizacion_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION VENTA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_venta_registrar' class="" id="cod_estado_cotizacion_venta_registrar" type='checkbox' value='<?php echo $cod_estado_cotizacion_venta_registrar ?>' <?php if($cod_estado_cotizacion_venta_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION VENTA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_venta_editar' class="" id="cod_estado_cotizacion_venta_editar" type='checkbox' value='<?php echo $cod_estado_cotizacion_venta_editar ?>' <?php if($cod_estado_cotizacion_venta_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION VENTA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_venta_eliminar' class="" id="cod_estado_cotizacion_venta_eliminar" type='checkbox' value='<?php echo $cod_estado_cotizacion_venta_eliminar ?>' <?php if($cod_estado_cotizacion_venta_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION VENTA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_venta_imprimir' class="" id="cod_estado_cotizacion_venta_imprimir" type='checkbox' value='<?php echo $cod_estado_cotizacion_venta_imprimir ?>' <?php if($cod_estado_cotizacion_venta_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION VENTA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_venta_exportar' class="" id="cod_estado_cotizacion_venta_exportar" type='checkbox' value='<?php echo $cod_estado_cotizacion_venta_exportar ?>' <?php if($cod_estado_cotizacion_venta_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_compra' class="" id="cod_estado_cotizacion_compra" type='checkbox' value='<?php echo $cod_estado_cotizacion_compra ?>' <?php if($cod_estado_cotizacion_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION COMPRA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_compra_registrar' class="" id="cod_estado_cotizacion_compra_registrar" type='checkbox' value='<?php echo $cod_estado_cotizacion_compra_registrar ?>' <?php if($cod_estado_cotizacion_compra_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION COMPRA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_compra_editar' class="" id="cod_estado_cotizacion_compra_editar" type='checkbox' value='<?php echo $cod_estado_cotizacion_compra_editar ?>' <?php if($cod_estado_cotizacion_compra_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION COMPRA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_compra_eliminar' class="" id="cod_estado_cotizacion_compra_eliminar" type='checkbox' value='<?php echo $cod_estado_cotizacion_compra_eliminar ?>' <?php if($cod_estado_cotizacion_compra_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION COMPRA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_compra_imprimir' class="" id="cod_estado_cotizacion_compra_imprimir" type='checkbox' value='<?php echo $cod_estado_cotizacion_compra_imprimir ?>' <?php if($cod_estado_cotizacion_compra_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COTIZACION COMPRA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_cotizacion_compra_exportar' class="" id="cod_estado_cotizacion_compra_exportar" type='checkbox' value='<?php echo $cod_estado_cotizacion_compra_exportar ?>' <?php if($cod_estado_cotizacion_compra_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_venta_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">VENTAS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">VENTAS</th>
			<td style='text-align:center'><input name='cod_estado_venta' class="" id="cod_estado_venta" type='checkbox' value='<?php echo $cod_estado_venta ?>' <?php if($cod_estado_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">VENTA MANUAL</th>
			<td style='text-align:center'><input name='cod_estado_venta_manual' class="" id="cod_estado_venta_manual" type='checkbox' value='<?php echo $cod_estado_venta_manual ?>' <?php if($cod_estado_venta_manual=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">VENTA BARRAS</th>
			<td style='text-align:center'><input name='cod_estado_venta_barras' class="" id="cod_estado_venta_barras" type='checkbox' value='<?php echo $cod_estado_venta_barras ?>' <?php if($cod_estado_venta_barras=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_venta_fecha_venta' class="" id="cod_estado_venta_fecha_venta" type='checkbox' value='<?php echo $cod_estado_venta_fecha_venta ?>' <?php if($cod_estado_venta_fecha_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PREVENTA</th>
			<td style='text-align:center'><input name='cod_estado_venta_preventa' class="" id="cod_estado_venta_preventa" type='checkbox' value='<?php echo $cod_estado_venta_preventa ?>' <?php if($cod_estado_venta_preventa=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">VENTA PROPINA</th>
			<td style='text-align:center'><input name='cod_estado_venta_propina' class="" id="cod_estado_venta_propina" type='checkbox' value='<?php echo $cod_estado_venta_propina ?>' <?php if($cod_estado_venta_propina=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">VENTA BOLSA</th>
			<td style='text-align:center'><input name='cod_estado_venta_bolsa' class="" id="cod_estado_venta_bolsa" type='checkbox' value='<?php echo $cod_estado_venta_bolsa ?>' <?php if($cod_estado_venta_bolsa=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">VENTA OBSERVACION</th>
			<td style='text-align:center'><input name='cod_estado_venta_observacion' class="" id="cod_estado_venta_observacion" type='checkbox' value='<?php echo $cod_estado_venta_observacion ?>' <?php if($cod_estado_venta_observacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta' class="" id="cod_estado_facturacion_venta" type='checkbox' value='<?php echo $cod_estado_facturacion_venta ?>' <?php if($cod_estado_facturacion_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_registrar' class="" id="cod_estado_facturacion_venta_registrar" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_registrar ?>' <?php if($cod_estado_facturacion_venta_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_editar' class="" id="cod_estado_facturacion_venta_editar" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_editar ?>' <?php if($cod_estado_facturacion_venta_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_eliminar' class="" id="cod_estado_facturacion_venta_eliminar" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_eliminar ?>' <?php if($cod_estado_facturacion_venta_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_imprimir' class="" id="cod_estado_facturacion_venta_imprimir" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_imprimir ?>' <?php if($cod_estado_facturacion_venta_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_exportar' class="" id="cod_estado_facturacion_venta_exportar" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_exportar ?>' <?php if($cod_estado_facturacion_venta_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>		
		<tr>
			<th style="text-align:left">FACTURA VENTA DEVOLUCION</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_devol' class="" id="cod_estado_facturacion_venta_devol" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_devol ?>' <?php if($cod_estado_facturacion_venta_devol=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MOSTRAR PRECIO DE COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_precio_compra_mod_venta' class="" id="cod_estado_precio_compra_mod_venta" type='checkbox' value='<?php echo $cod_estado_precio_compra_mod_venta ?>' <?php if($cod_estado_precio_compra_mod_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PERMITIR ELIMINAR CAJA/MESA VENTA TEMPORAL</th>
			<td style='text-align:center'><input name='cod_estado_eliminar_caja_mesa_virtual' class="" id="cod_estado_eliminar_caja_mesa_virtual" type='checkbox' value='<?php echo $cod_estado_eliminar_caja_mesa_virtual ?>' <?php if($cod_estado_eliminar_caja_mesa_virtual=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR BOTON ELIMINAR VENTA TEMPORAL</th>
			<td style='text-align:center'><input name='cod_estado_deshabilitar_opc_eliminar_ventatemp' class="" id="cod_estado_deshabilitar_opc_eliminar_ventatemp" type='checkbox' value='<?php echo $cod_estado_deshabilitar_opc_eliminar_ventatemp ?>' <?php if($cod_estado_deshabilitar_opc_eliminar_ventatemp=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR BOTON FACTURAR VENTA</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_facturar_mod_venta' class="" id="cod_estado_habilitar_btn_facturar_mod_venta" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_facturar_mod_venta ?>' <?php if($cod_estado_habilitar_btn_facturar_mod_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">AGREGAR PRODUCTOS A VENTA FACTURADA</th>
			<td style='text-align:center'><input name='cod_estado_agregar_productos_a_venta_facturada' class="" id="cod_estado_agregar_productos_a_venta_facturada" type='checkbox' value='<?php echo $cod_estado_agregar_productos_a_venta_facturada ?>' <?php if($cod_estado_agregar_productos_a_venta_facturada=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ELIMINAR PRODUCTOS A VENTA FACTURADA</th>
			<td style='text-align:center'><input name='cod_estado_eliminar_productos_a_venta_facturada' class="" id="cod_estado_eliminar_productos_a_venta_facturada" type='checkbox' value='<?php echo $cod_estado_eliminar_productos_a_venta_facturada ?>' <?php if($cod_estado_eliminar_productos_a_venta_facturada=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR TOTAL VENTA (VENTA TEMPORAL)</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_total_venta_ventatemp' class="" id="cod_estado_habilitar_total_venta_ventatemp" type='checkbox' value='<?php echo $cod_estado_habilitar_total_venta_ventatemp ?>' <?php if($cod_estado_habilitar_total_venta_ventatemp=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR NUMERO DE CAJA MESAS EN USO (CAJA MESA VIRTUAL)</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_caja_mesa_virtual_en_uso' class="" id="cod_estado_habilitar_caja_mesa_virtual_en_uso" type='checkbox' value='<?php echo $cod_estado_habilitar_caja_mesa_virtual_en_uso ?>' <?php if($cod_estado_habilitar_caja_mesa_virtual_en_uso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR TOTAL VENTA PARTE SUPERIOR (CAJA MESA VIRTUAL)</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso' class="" id="cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso" type='checkbox' value='<?php echo $cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso ?>' <?php if($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR TOTAL VENTA PARTE INFERIOR (CAJA MESA VIRTUAL)</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_total_venta_caja_mesa_virtual' class="" id="cod_estado_habilitar_total_venta_caja_mesa_virtual" type='checkbox' value='<?php echo $cod_estado_habilitar_total_venta_caja_mesa_virtual ?>' <?php if($cod_estado_habilitar_total_venta_caja_mesa_virtual=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA MARCAR VENTA POR DEPENDECIA DEL USUARIO</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_dependencia_user' class="" id="cod_estado_facturacion_venta_dependencia_user" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_dependencia_user ?>' <?php if($cod_estado_facturacion_venta_dependencia_user=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA PRECIO DE VENTA PREDETERMINADO USUARIO</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_precio_venta_predet_user' class="" id="cod_estado_facturacion_venta_precio_venta_predet_user" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_precio_venta_predet_user ?>' <?php if($cod_estado_facturacion_venta_precio_venta_predet_user=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FACTURA VENTA ACCESO A FACTURAS DE VENTA DE OTROS USUARIOS</th>
			<td style='text-align:center'><input name='cod_estado_facturacion_venta_acceso_facturas_otros_user' class="" id="cod_estado_facturacion_venta_acceso_facturas_otros_user" type='checkbox' value='<?php echo $cod_estado_facturacion_venta_acceso_facturas_otros_user ?>' <?php if($cod_estado_facturacion_venta_acceso_facturas_otros_user=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR UND VENTA EDITABLE (CANTIDAD)</th>
			<td style='text-align:center'><input name='cod_estado_deshabilitar_und_venta_ventatemp' class="" id="cod_estado_deshabilitar_und_venta_ventatemp" type='checkbox' value='<?php echo $cod_estado_deshabilitar_und_venta_ventatemp ?>' <?php if($cod_estado_deshabilitar_und_venta_ventatemp=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DESHABILITAR UND VENTA EDITABLE CUANDO CHEF DA CLIC EN ATENDER (CANTIDAD)</th>
			<td style='text-align:center'><input name='cod_estado_deshabilitar_und_venta_atendido_cocina_chef' class="" id="cod_estado_deshabilitar_und_venta_atendido_cocina_chef" type='checkbox' value='<?php echo $cod_estado_deshabilitar_und_venta_atendido_cocina_chef ?>' <?php if($cod_estado_deshabilitar_und_venta_atendido_cocina_chef=='1'){ echo 'checked'; } ?>></td>
		</tr>

	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_tercero_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">TERCEROS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">TERCEROS</th>
			<td style='text-align:center'><input name='cod_estado_tercero' class="" id="cod_estado_tercero" type='checkbox' value='<?php echo $cod_estado_tercero ?>' <?php if($cod_estado_tercero=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TERCEROS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_tercero_registrar' class="" id="cod_estado_tercero_registrar" type='checkbox' value='<?php echo $cod_estado_tercero_registrar ?>' <?php if($cod_estado_tercero_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TERCEROS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_tercero_editar' class="" id="cod_estado_tercero_editar" type='checkbox' value='<?php echo $cod_estado_tercero_editar ?>' <?php if($cod_estado_tercero_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TERCEROS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_tercero_eliminar' class="" id="cod_estado_tercero_eliminar" type='checkbox' value='<?php echo $cod_estado_tercero_eliminar ?>' <?php if($cod_estado_tercero_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TERCEROS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_tercero_imprimir' class="" id="cod_estado_tercero_imprimir" type='checkbox' value='<?php echo $cod_estado_tercero_imprimir ?>' <?php if($cod_estado_tercero_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TERCEROS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_tercero_exportar' class="" id="cod_estado_tercero_exportar" type='checkbox' value='<?php echo $cod_estado_tercero_exportar ?>' <?php if($cod_estado_tercero_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_cita_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">CITAS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">CITAS</th>
			<td style='text-align:center'><input name='cod_estado_cita' class="" id="cod_estado_cita" type='checkbox' value='<?php echo $cod_estado_cita ?>' <?php if($cod_estado_cita=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CITA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_cita_registrar' class="" id="cod_estado_cita_registrar" type='checkbox' value='<?php echo $cod_estado_cita_registrar ?>' <?php if($cod_estado_cita_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CITA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_cita_editar' class="" id="cod_estado_cita_editar" type='checkbox' value='<?php echo $cod_estado_cita_editar ?>' <?php if($cod_estado_cita_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CITA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_cita_eliminar' class="" id="cod_estado_cita_eliminar" type='checkbox' value='<?php echo $cod_estado_cita_eliminar ?>' <?php if($cod_estado_cita_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CITA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_cita_imprimir' class="" id="cod_estado_cita_imprimir" type='checkbox' value='<?php echo $cod_estado_cita_imprimir ?>' <?php if($cod_estado_cita_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CITA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_cita_exportar' class="" id="cod_estado_cita_exportar" type='checkbox' value='<?php echo $cod_estado_cita_exportar ?>' <?php if($cod_estado_cita_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_cuenta_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">CUENTAS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">CUENTAS</th>
			<td style='text-align:center'><input name='cod_estado_cuenta' class="" id="cod_estado_cuenta" type='checkbox' value='<?php echo $cod_estado_cuenta ?>' <?php if($cod_estado_cuenta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php if ($cod_estado_cuenta_cobrar_global == '1') { ?>
		<tr>
			<th style="text-align:left">CUENTA COBRAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar' class="" id="cod_estado_cuenta_cobrar" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar ?>' <?php if($cod_estado_cuenta_cobrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA COBRAR REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_registrar' class="" id="cod_estado_cuenta_cobrar_registrar" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_registrar ?>' <?php if($cod_estado_cuenta_cobrar_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA COBRAR EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_editar' class="" id="cod_estado_cuenta_cobrar_editar" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_editar ?>' <?php if($cod_estado_cuenta_cobrar_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA COBRAR ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_eliminar' class="" id="cod_estado_cuenta_cobrar_eliminar" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_eliminar ?>' <?php if($cod_estado_cuenta_cobrar_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA COBRAR IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_imprimir' class="" id="cod_estado_cuenta_cobrar_imprimir" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_imprimir ?>' <?php if($cod_estado_cuenta_cobrar_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA COBRAR EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_exportar' class="" id="cod_estado_cuenta_cobrar_exportar" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_exportar ?>' <?php if($cod_estado_cuenta_cobrar_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>

		<?php if ($cod_estado_cuenta_pagar_global == '1') { ?>
		<tr>
			<th style="text-align:left">CUENTA PAGAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar' class="" id="cod_estado_cuenta_pagar" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar ?>' <?php if($cod_estado_cuenta_pagar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA PAGAR REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar_registrar' class="" id="cod_estado_cuenta_pagar_registrar" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar_registrar ?>' <?php if($cod_estado_cuenta_pagar_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA PAGAR EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar_editar' class="" id="cod_estado_cuenta_pagar_editar" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar_editar ?>' <?php if($cod_estado_cuenta_pagar_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA PAGAR ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar_eliminar' class="" id="cod_estado_cuenta_pagar_eliminar" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar_eliminar ?>' <?php if($cod_estado_cuenta_pagar_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA PAGAR IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar_imprimir' class="" id="cod_estado_cuenta_pagar_imprimir" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar_imprimir ?>' <?php if($cod_estado_cuenta_pagar_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CUENTA PAGAR EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar_exportar' class="" id="cod_estado_cuenta_pagar_exportar" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar_exportar ?>' <?php if($cod_estado_cuenta_pagar_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<?php } ?>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_cierre_caja_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">CIERRE CAJA</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">CIERRE CAJA</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja' class="" id="cod_estado_cierre_caja" type='checkbox' value='<?php echo $cod_estado_cierre_caja ?>' <?php if($cod_estado_cierre_caja=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CIERRE CAJA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja_registrar' class="" id="cod_estado_cierre_caja_registrar" type='checkbox' value='<?php echo $cod_estado_cierre_caja_registrar ?>' <?php if($cod_estado_cierre_caja_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CIERRE CAJA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja_editar' class="" id="cod_estado_cierre_caja_editar" type='checkbox' value='<?php echo $cod_estado_cierre_caja_editar ?>' <?php if($cod_estado_cierre_caja_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CIERRE CAJA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja_eliminar' class="" id="cod_estado_cierre_caja_eliminar" type='checkbox' value='<?php echo $cod_estado_cierre_caja_eliminar ?>' <?php if($cod_estado_cierre_caja_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CIERRE CAJA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja_imprimir' class="" id="cod_estado_cierre_caja_imprimir" type='checkbox' value='<?php echo $cod_estado_cierre_caja_imprimir ?>' <?php if($cod_estado_cierre_caja_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CIERRE CAJA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja_exportar' class="" id="cod_estado_cierre_caja_exportar" type='checkbox' value='<?php echo $cod_estado_cierre_caja_exportar ?>' <?php if($cod_estado_cierre_caja_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_egreso_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">EGRESOS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">EGRESOS</th>
			<td style='text-align:center'><input name='cod_estado_egreso' class="" id="cod_estado_egreso" type='checkbox' value='<?php echo $cod_estado_egreso ?>' <?php if($cod_estado_egreso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">EGRESOS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_egreso_registrar' class="" id="cod_estado_egreso_registrar" type='checkbox' value='<?php echo $cod_estado_egreso_registrar ?>' <?php if($cod_estado_egreso_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">EGRESOS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_egreso_editar' class="" id="cod_estado_egreso_editar" type='checkbox' value='<?php echo $cod_estado_egreso_editar ?>' <?php if($cod_estado_egreso_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">EGRESOS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_egreso_eliminar' class="" id="cod_estado_egreso_eliminar" type='checkbox' value='<?php echo $cod_estado_egreso_eliminar ?>' <?php if($cod_estado_egreso_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">EGRESOS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_egreso_imprimir' class="" id="cod_estado_egreso_imprimir" type='checkbox' value='<?php echo $cod_estado_egreso_imprimir ?>' <?php if($cod_estado_egreso_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">EGRESOS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_egreso_exportar' class="" id="cod_estado_egreso_exportar" type='checkbox' value='<?php echo $cod_estado_egreso_exportar ?>' <?php if($cod_estado_egreso_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_sticker_barras_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">STICKER BARRAS</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">STICKER BARRAS</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra' class="" id="cod_estado_sticker_barra" type='checkbox' value='<?php echo $cod_estado_sticker_barra ?>' <?php if($cod_estado_sticker_barra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_registrar' class="" id="cod_estado_sticker_barra_registrar" type='checkbox' value='<?php echo $cod_estado_sticker_barra_registrar ?>' <?php if($cod_estado_sticker_barra_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_editar' class="" id="cod_estado_sticker_barra_editar" type='checkbox' value='<?php echo $cod_estado_sticker_barra_editar ?>' <?php if($cod_estado_sticker_barra_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_eliminar' class="" id="cod_estado_sticker_barra_eliminar" type='checkbox' value='<?php echo $cod_estado_sticker_barra_eliminar ?>' <?php if($cod_estado_sticker_barra_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_imprimir' class="" id="cod_estado_sticker_barra_imprimir" type='checkbox' value='<?php echo $cod_estado_sticker_barra_imprimir ?>' <?php if($cod_estado_sticker_barra_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_exportar' class="" id="cod_estado_sticker_barra_exportar" type='checkbox' value='<?php echo $cod_estado_sticker_barra_exportar ?>' <?php if($cod_estado_sticker_barra_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS OBSERVACION</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_observacion' class="" id="cod_estado_sticker_barra_observacion" type='checkbox' value='<?php echo $cod_estado_sticker_barra_observacion ?>' <?php if($cod_estado_sticker_barra_observacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STICKER BARRAS ARCHIVO PLANO</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barra_archivo_plano' class="" id="cod_estado_sticker_barra_archivo_plano" type='checkbox' value='<?php echo $cod_estado_sticker_barra_archivo_plano ?>' <?php if($cod_estado_sticker_barra_archivo_plano=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_modulo_reporte_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">REPORTES</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">REPORTES</th>
			<td style='text-align:center'><input name='cod_estado_reporte' class="" id="cod_estado_reporte" type='checkbox' value='<?php echo $cod_estado_reporte ?>' <?php if($cod_estado_reporte=='1'){ echo 'checked'; } ?>></td>
		</tr>

		<?php if ($cod_estado_modulo_venta_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE VENTA</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta' class="" id="cod_estado_reporte_venta" type='checkbox' value='<?php echo $cod_estado_reporte_venta ?>' <?php if($cod_estado_reporte_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_imprimir' class="" id="cod_estado_reporte_venta_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_venta_imprimir ?>' <?php if($cod_estado_reporte_venta_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_exportar' class="" id="cod_estado_reporte_venta_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_exportar ?>' <?php if($cod_estado_reporte_venta_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE VENTA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_registrar' class="" id="cod_estado_reporte_venta_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_registrar ?>' <?php if($cod_estado_reporte_venta_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_editar' class="" id="cod_estado_reporte_venta_editar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_editar ?>' <?php if($cod_estado_reporte_venta_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_eliminar' class="" id="cod_estado_reporte_venta_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_eliminar ?>' <?php if($cod_estado_reporte_venta_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_factura_compra_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra' class="" id="cod_estado_reporte_compra" type='checkbox' value='<?php echo $cod_estado_reporte_compra ?>' <?php if($cod_estado_reporte_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE COMPRA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra_imprimir' class="" id="cod_estado_reporte_compra_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_compra_imprimir ?>' <?php if($cod_estado_reporte_compra_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE COMPRA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra_exportar' class="" id="cod_estado_reporte_compra_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_compra_exportar ?>' <?php if($cod_estado_reporte_compra_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE COMPRA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra_registrar' class="" id="cod_estado_reporte_compra_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_compra_registrar ?>' <?php if($cod_estado_reporte_compra_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE COMPRA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra_editar' class="" id="cod_estado_reporte_compra_editar" type='checkbox' value='<?php echo $cod_estado_reporte_compra_editar ?>' <?php if($cod_estado_reporte_compra_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE COMPRA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra_eliminar' class="" id="cod_estado_reporte_compra_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_compra_eliminar ?>' <?php if($cod_estado_reporte_compra_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_modulo_venta_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE GENERAL</th>
			<td style='text-align:center'><input name='cod_estado_reporte_general' class="" id="cod_estado_reporte_general" type='checkbox' value='<?php echo $cod_estado_reporte_general ?>' <?php if($cod_estado_reporte_general=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE GENERAL IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_general_imprimir' class="" id="cod_estado_reporte_general_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_general_imprimir ?>' <?php if($cod_estado_reporte_general_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE GENERAL EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_general_exportar' class="" id="cod_estado_reporte_general_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_general_exportar ?>' <?php if($cod_estado_reporte_general_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE GENERAL REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_general_registrar' class="" id="cod_estado_reporte_general_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_general_registrar ?>' <?php if($cod_estado_reporte_general_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE GENERAL EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_general_editar' class="" id="cod_estado_reporte_general_editar" type='checkbox' value='<?php echo $cod_estado_reporte_general_editar ?>' <?php if($cod_estado_reporte_general_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE GENERAL ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_general_eliminar' class="" id="cod_estado_reporte_general_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_general_eliminar ?>' <?php if($cod_estado_reporte_general_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_modulo_contabilidad_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE MOVIMIENTO CONTABLE</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mov_contable' class="" id="cod_estado_reporte_mov_contable" type='checkbox' value='<?php echo $cod_estado_reporte_mov_contable ?>' <?php if($cod_estado_reporte_mov_contable=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MOVIMIENTO CONTABLE IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mov_contable_imprimir' class="" id="cod_estado_reporte_mov_contable_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_mov_contable_imprimir ?>' <?php if($cod_estado_reporte_mov_contable_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MOVIMIENTO CONTABLE EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mov_contable_exportar' class="" id="cod_estado_reporte_mov_contable_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_mov_contable_exportar ?>' <?php if($cod_estado_reporte_mov_contable_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE MOVIMIENTO CONTABLE REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mov_contable_registrar' class="" id="cod_estado_reporte_mov_contable_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_mov_contable_registrar ?>' <?php if($cod_estado_reporte_mov_contable_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MOVIMIENTO CONTABLE EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mov_contable_editar' class="" id="cod_estado_reporte_mov_contable_editar" type='checkbox' value='<?php echo $cod_estado_reporte_mov_contable_editar ?>' <?php if($cod_estado_reporte_mov_contable_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MOVIMIENTO CONTABLE ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mov_contable_eliminar' class="" id="cod_estado_reporte_mov_contable_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_mov_contable_eliminar ?>' <?php if($cod_estado_reporte_mov_contable_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_modulo_venta_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE VENTA POR PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_por_producto' class="" id="cod_estado_reporte_venta_por_producto" type='checkbox' value='<?php echo $cod_estado_reporte_venta_por_producto ?>' <?php if($cod_estado_reporte_venta_por_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA POR PRODUCTO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_por_producto_imprimir' class="" id="cod_estado_reporte_venta_por_producto_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_venta_por_producto_imprimir ?>' <?php if($cod_estado_reporte_venta_por_producto_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA POR PRODUCTO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_por_producto_exportar' class="" id="cod_estado_reporte_venta_por_producto_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_por_producto_exportar ?>' <?php if($cod_estado_reporte_venta_por_producto_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE VENTA POR PRODUCTO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_por_producto_registrar' class="" id="cod_estado_reporte_venta_por_producto_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_por_producto_registrar ?>' <?php if($cod_estado_reporte_venta_por_producto_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA POR PRODUCTO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_por_producto_editar' class="" id="cod_estado_reporte_venta_por_producto_editar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_por_producto_editar ?>' <?php if($cod_estado_reporte_venta_por_producto_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA POR PRODUCTO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_por_producto_eliminar' class="" id="cod_estado_reporte_venta_por_producto_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_venta_por_producto_eliminar ?>' <?php if($cod_estado_reporte_venta_por_producto_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_modulo_producto_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE INVENTARIO</th>
			<td style='text-align:center'><input name='cod_estado_reporte_inventario' class="" id="cod_estado_reporte_inventario" type='checkbox' value='<?php echo $cod_estado_reporte_inventario ?>' <?php if($cod_estado_reporte_inventario=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE INVENTARIO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_inventario_imprimir' class="" id="cod_estado_reporte_inventario_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_inventario_imprimir ?>' <?php if($cod_estado_reporte_inventario_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE INVENTARIO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_inventario_exportar' class="" id="cod_estado_reporte_inventario_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_inventario_exportar ?>' <?php if($cod_estado_reporte_inventario_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE INVENTARIO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_inventario_registrar' class="" id="cod_estado_reporte_inventario_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_inventario_registrar ?>' <?php if($cod_estado_reporte_inventario_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE INVENTARIO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_inventario_editar' class="" id="cod_estado_reporte_inventario_editar" type='checkbox' value='<?php echo $cod_estado_reporte_inventario_editar ?>' <?php if($cod_estado_reporte_inventario_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE INVENTARIO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_inventario_eliminar' class="" id="cod_estado_reporte_inventario_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_inventario_eliminar ?>' <?php if($cod_estado_reporte_inventario_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE PRODUCTO A VENCER</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_vencer' class="" id="cod_estado_reporte_prodcuto_vencer" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_vencer ?>' <?php if($cod_estado_reporte_prodcuto_vencer=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE PRODUCTO A VENCER IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_vencer_imprimir' class="" id="cod_estado_reporte_prodcuto_vencer_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_vencer_imprimir ?>' <?php if($cod_estado_reporte_prodcuto_vencer_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE PRODUCTO A VENCER EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_vencer_exportar' class="" id="cod_estado_reporte_prodcuto_vencer_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_vencer_exportar ?>' <?php if($cod_estado_reporte_prodcuto_vencer_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE PRODUCTO A VENCER REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_vencer_registrar' class="" id="cod_estado_reporte_prodcuto_vencer_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_vencer_registrar ?>' <?php if($cod_estado_reporte_prodcuto_vencer_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE PRODUCTO A VENCER EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_vencer_editar' class="" id="cod_estado_reporte_prodcuto_vencer_editar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_vencer_editar ?>' <?php if($cod_estado_reporte_prodcuto_vencer_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE PRODUCTO A VENCER ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_vencer_eliminar' class="" id="cod_estado_reporte_prodcuto_vencer_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_vencer_eliminar ?>' <?php if($cod_estado_reporte_prodcuto_vencer_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_prodcuto_mantenimiento_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE MANTENIMIENTO</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_mantenimiento' class="" id="cod_estado_reporte_prodcuto_mantenimiento" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_mantenimiento ?>' <?php if($cod_estado_reporte_prodcuto_mantenimiento=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MANTENIMIENTO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_mantenimiento_imprimir' class="" id="cod_estado_reporte_prodcuto_mantenimiento_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_mantenimiento_imprimir ?>' <?php if($cod_estado_reporte_prodcuto_mantenimiento_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MANTENIMIENTO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_mantenimiento_exportar' class="" id="cod_estado_reporte_prodcuto_mantenimiento_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_mantenimiento_exportar ?>' <?php if($cod_estado_reporte_prodcuto_mantenimiento_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE MANTENIMIENTO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_mantenimiento_registrar' class="" id="cod_estado_reporte_prodcuto_mantenimiento_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_mantenimiento_registrar ?>' <?php if($cod_estado_reporte_prodcuto_mantenimiento_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MANTENIMIENTO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_mantenimiento_editar' class="" id="cod_estado_reporte_prodcuto_mantenimiento_editar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_mantenimiento_editar ?>' <?php if($cod_estado_reporte_prodcuto_mantenimiento_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE MANTENIMIENTO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_prodcuto_mantenimiento_eliminar' class="" id="cod_estado_reporte_prodcuto_mantenimiento_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_prodcuto_mantenimiento_eliminar ?>' <?php if($cod_estado_reporte_prodcuto_mantenimiento_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<?php if ($cod_estado_alerta_fecha_nac_global == '1') { ?>
		<tr>
			<th style="text-align:left">REPORTE CUMPLEAÑOS TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_reporte_cumplanos_tercero' class="" id="cod_estado_reporte_cumplanos_tercero" type='checkbox' value='<?php echo $cod_estado_reporte_cumplanos_tercero ?>' <?php if($cod_estado_reporte_cumplanos_tercero=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE CUMPLEAÑOS TERCERO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_cumplanos_tercero_imprimir' class="" id="cod_estado_reporte_cumplanos_tercero_imprimir" type='checkbox' value='<?php echo $cod_estado_reporte_cumplanos_tercero_imprimir ?>' <?php if($cod_estado_reporte_cumplanos_tercero_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE CUMPLEAÑOS TERCERO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_cumplanos_tercero_exportar' class="" id="cod_estado_reporte_cumplanos_tercero_exportar" type='checkbox' value='<?php echo $cod_estado_reporte_cumplanos_tercero_exportar ?>' <?php if($cod_estado_reporte_cumplanos_tercero_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPORTE CUMPLEAÑOS TERCERO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_cumplanos_tercero_registrar' class="" id="cod_estado_reporte_cumplanos_tercero_registrar" type='checkbox' value='<?php echo $cod_estado_reporte_cumplanos_tercero_registrar ?>' <?php if($cod_estado_reporte_cumplanos_tercero_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE CUMPLEAÑOS TERCERO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_cumplanos_tercero_editar' class="" id="cod_estado_reporte_cumplanos_tercero_editar" type='checkbox' value='<?php echo $cod_estado_reporte_cumplanos_tercero_editar ?>' <?php if($cod_estado_reporte_cumplanos_tercero_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE CUMPLEAÑOS TERCERO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_reporte_cumplanos_tercero_eliminar' class="" id="cod_estado_reporte_cumplanos_tercero_eliminar" type='checkbox' value='<?php echo $cod_estado_reporte_cumplanos_tercero_eliminar ?>' <?php if($cod_estado_reporte_cumplanos_tercero_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>
		<tr>
			<th style="text-align:left">REPORTE VENTA MOSTRAR GANANCIA</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_total_ganancia' class="" id="cod_estado_reporte_venta_total_ganancia" type='checkbox' value='<?php echo $cod_estado_reporte_venta_total_ganancia ?>' <?php if($cod_estado_reporte_venta_total_ganancia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA MOSTRAR UTILIDAD</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_total_utilidad' class="" id="cod_estado_reporte_venta_total_utilidad" type='checkbox' value='<?php echo $cod_estado_reporte_venta_total_utilidad ?>' <?php if($cod_estado_reporte_venta_total_utilidad=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA MOSTRAR COMISION</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_total_comision' class="" id="cod_estado_reporte_venta_total_comision" type='checkbox' value='<?php echo $cod_estado_reporte_venta_total_comision ?>' <?php if($cod_estado_reporte_venta_total_comision=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPORTE VENTA MOSTRAR PROPINA</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_total_propina' class="" id="cod_estado_reporte_venta_total_propina" type='checkbox' value='<?php echo $cod_estado_reporte_venta_total_propina ?>' <?php if($cod_estado_reporte_venta_total_propina=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_admin_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">ADMIN</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">ADMIN</th>
			<td style='text-align:center'><input name='cod_estado_admin' class="" id="cod_estado_admin" type='checkbox' value='<?php echo $cod_estado_admin ?>' <?php if($cod_estado_admin=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">INFO EMPRESA</th>
			<td style='text-align:center'><input name='cod_estado_info_empresa' class="" id="cod_estado_info_empresa" type='checkbox' value='<?php echo $cod_estado_info_empresa ?>' <?php if($cod_estado_info_empresa=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">INFO EMPRESA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_info_empresa_editar' class="" id="cod_estado_info_empresa_editar" type='checkbox' value='<?php echo $cod_estado_info_empresa_editar ?>' <?php if($cod_estado_info_empresa_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">INFO EMPRESA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_info_empresa_registrar' class="" id="cod_estado_info_empresa_registrar" type='checkbox' value='<?php echo $cod_estado_info_empresa_registrar ?>' <?php if($cod_estado_info_empresa_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">INFO EMPRESA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_info_empresa_eliminar' class="" id="cod_estado_info_empresa_eliminar" type='checkbox' value='<?php echo $cod_estado_info_empresa_eliminar ?>' <?php if($cod_estado_info_empresa_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">INFO EMPRESA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_info_empresa_imprimir' class="" id="cod_estado_info_empresa_imprimir" type='checkbox' value='<?php echo $cod_estado_info_empresa_imprimir ?>' <?php if($cod_estado_info_empresa_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">INFO EMPRESA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_info_empresa_exportar' class="" id="cod_estado_info_empresa_exportar" type='checkbox' value='<?php echo $cod_estado_info_empresa_exportar ?>' <?php if($cod_estado_info_empresa_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->

		<?php if ($cod_estado_numero_letra_global == '1') { ?>
		<tr>
			<th style="text-align:left">NUMERO LETRAS</th>
			<td style='text-align:center'><input name='cod_estado_numero_letras' class="" id="cod_estado_numero_letras" type='checkbox' value='<?php echo $cod_estado_numero_letras ?>' <?php if($cod_estado_numero_letras=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NUMERO LETRAS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_numero_letras_registrar' class="" id="cod_estado_numero_letras_registrar" type='checkbox' value='<?php echo $cod_estado_numero_letras_registrar ?>' <?php if($cod_estado_numero_letras_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NUMERO LETRAS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_numero_letras_editar' class="" id="cod_estado_numero_letras_editar" type='checkbox' value='<?php echo $cod_estado_numero_letras_editar ?>' <?php if($cod_estado_numero_letras_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">NUMERO LETRAS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_numero_letras_eliminar' class="" id="cod_estado_numero_letras_eliminar" type='checkbox' value='<?php echo $cod_estado_numero_letras_eliminar ?>' <?php if($cod_estado_numero_letras_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NUMERO LETRAS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_numero_letras_imprimir' class="" id="cod_estado_numero_letras_imprimir" type='checkbox' value='<?php echo $cod_estado_numero_letras_imprimir ?>' <?php if($cod_estado_numero_letras_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NUMERO LETRAS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_numero_letras_exportar' class="" id="cod_estado_numero_letras_exportar" type='checkbox' value='<?php echo $cod_estado_numero_letras_exportar ?>' <?php if($cod_estado_numero_letras_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<?php } ?>

		<tr>
			<th style="text-align:left">LICENCIA</th>
			<td style='text-align:center'><input name='cod_estado_licencia' class="" id="cod_estado_licencia" type='checkbox' value='<?php echo $cod_estado_licencia ?>' <?php if($cod_estado_licencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">LICENCIA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_licencia_registrar' class="" id="cod_estado_licencia_registrar" type='checkbox' value='<?php echo $cod_estado_licencia_registrar ?>' <?php if($cod_estado_licencia_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">LICENCIA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_licencia_editar' class="" id="cod_estado_licencia_editar" type='checkbox' value='<?php echo $cod_estado_licencia_editar ?>' <?php if($cod_estado_licencia_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">LICENCIA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_licencia_imprimir' class="" id="cod_estado_licencia_imprimir" type='checkbox' value='<?php echo $cod_estado_licencia_imprimir ?>' <?php if($cod_estado_licencia_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">LICENCIA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_licencia_exportar' class="" id="cod_estado_licencia_exportar" type='checkbox' value='<?php echo $cod_estado_licencia_exportar ?>' <?php if($cod_estado_licencia_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
		<tr>
			<th style="text-align:left">REPOSITORIO</th>
			<td style='text-align:center'><input name='cod_estado_repositorio' class="" id="cod_estado_repositorio" type='checkbox' value='<?php echo $cod_estado_repositorio ?>' <?php if($cod_estado_repositorio=='1'){ echo 'checked'; } ?>></td>
		</tr>
<!--
		<tr>
			<th style="text-align:left">REPOSITORIO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_repositorio_registrar' class="" id="cod_estado_repositorio_registrar" type='checkbox' value='<?php echo $cod_estado_repositorio_registrar ?>' <?php if($cod_estado_repositorio_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPOSITORIO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_repositorio_editar' class="" id="cod_estado_repositorio_editar" type='checkbox' value='<?php echo $cod_estado_repositorio_editar ?>' <?php if($cod_estado_repositorio_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPOSITORIO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_repositorio_eliminar' class="" id="cod_estado_repositorio_eliminar" type='checkbox' value='<?php echo $cod_estado_repositorio_eliminar ?>' <?php if($cod_estado_repositorio_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPOSITORIO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_repositorio_imprimir' class="" id="cod_estado_repositorio_imprimir" type='checkbox' value='<?php echo $cod_estado_repositorio_imprimir ?>' <?php if($cod_estado_repositorio_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">REPOSITORIO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_repositorio_exportar' class="" id="cod_estado_repositorio_exportar" type='checkbox' value='<?php echo $cod_estado_repositorio_exportar ?>' <?php if($cod_estado_repositorio_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
-->
	</thead>
</table>

<?php if ($cod_estado_usuario_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">USUARIOS</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">USUARIOS</th>
			<td style='text-align:center'><input name='cod_estado_usuario' class="" id="cod_estado_usuario" type='checkbox' value='<?php echo $cod_estado_usuario ?>' <?php if($cod_estado_usuario=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_usuario_registrar' class="" id="cod_estado_usuario_registrar" type='checkbox' value='<?php echo $cod_estado_usuario_registrar ?>' <?php if($cod_estado_usuario_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_usuario_editar' class="" id="cod_estado_usuario_editar" type='checkbox' value='<?php echo $cod_estado_usuario_editar ?>' <?php if($cod_estado_usuario_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_usuario_eliminar' class="" id="cod_estado_usuario_eliminar" type='checkbox' value='<?php echo $cod_estado_usuario_eliminar ?>' <?php if($cod_estado_usuario_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_usuario_imprimir' class="" id="cod_estado_usuario_imprimir" type='checkbox' value='<?php echo $cod_estado_usuario_imprimir ?>' <?php if($cod_estado_usuario_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_usuario_exportar' class="" id="cod_estado_usuario_exportar" type='checkbox' value='<?php echo $cod_estado_usuario_exportar ?>' <?php if($cod_estado_usuario_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO CAMBIAR CONTRASEÑA</th>
			<td style='text-align:center'><input name='cod_estado_usuario_cambiar_contrasena' class="" id="cod_estado_usuario_cambiar_contrasena" type='checkbox' value='<?php echo $cod_estado_usuario_cambiar_contrasena ?>' <?php if($cod_estado_usuario_cambiar_contrasena=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO CAMBIAR TIPO ROL</th>
			<td style='text-align:center'><input name='cod_estado_usuario_cambiar_tipo_rol' class="" id="cod_estado_usuario_cambiar_tipo_rol" type='checkbox' value='<?php echo $cod_estado_usuario_cambiar_tipo_rol ?>' <?php if($cod_estado_usuario_cambiar_tipo_rol=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO CAMBIAR FIRMA</th>
			<td style='text-align:center'><input name='cod_estado_usuario_cambiar_firma' class="" id="cod_estado_usuario_cambiar_firma" type='checkbox' value='<?php echo $cod_estado_usuario_cambiar_firma ?>' <?php if($cod_estado_usuario_cambiar_firma=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO PERMISOS PERSONALIZADOS</th>
			<td style='text-align:center'><input name='cod_estado_usuario_permisos_personalizados' class="" id="cod_estado_usuario_permisos_personalizados" type='checkbox' value='<?php echo $cod_estado_usuario_permisos_personalizados ?>' <?php if($cod_estado_usuario_permisos_personalizados=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">USUARIO PERMISOS ASIGNAR POR MATRIZ</th>
			<td style='text-align:center'><input name='cod_estado_usuario_permisos_asignar_matriz' class="" id="cod_estado_usuario_permisos_asignar_matriz" type='checkbox' value='<?php echo $cod_estado_usuario_permisos_asignar_matriz ?>' <?php if($cod_estado_usuario_permisos_asignar_matriz=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>


<?php if ($cod_estado_eliminar_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">ELIMINAR</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_eliminar' class="" id="cod_estado_eliminar" type='checkbox' value='<?php echo $cod_estado_eliminar ?>' <?php if($cod_estado_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ELIMINAR USUARIO</th>
			<td style='text-align:center'><input name='cod_estado_eliminar_usuario' class="" id="cod_estado_eliminar_usuario" type='checkbox' value='<?php echo $cod_estado_eliminar_usuario ?>' <?php if($cod_estado_eliminar_usuario=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ELIMINAR TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_eliminar_tercero' class="" id="cod_estado_eliminar_tercero" type='checkbox' value='<?php echo $cod_estado_eliminar_tercero ?>' <?php if($cod_estado_eliminar_tercero=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ELIMINAR PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_eliminar_producto' class="" id="cod_estado_eliminar_producto" type='checkbox' value='<?php echo $cod_estado_eliminar_producto ?>' <?php if($cod_estado_eliminar_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>


<?php if ($cod_estado_tipo_roles_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">TIPO DE ROLES</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">TIPO DE ROL</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles' class="" id="cod_estado_tipo_roles" type='checkbox' value='<?php echo $cod_estado_tipo_roles ?>' <?php if($cod_estado_tipo_roles=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO DE ROL REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles_registrar' class="" id="cod_estado_tipo_roles_registrar" type='checkbox' value='<?php echo $cod_estado_tipo_roles_registrar ?>' <?php if($cod_estado_tipo_roles_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO DE ROL EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles_editar' class="" id="cod_estado_tipo_roles_editar" type='checkbox' value='<?php echo $cod_estado_tipo_roles_editar ?>' <?php if($cod_estado_tipo_roles_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO DE ROL ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles_eliminar' class="" id="cod_estado_tipo_roles_eliminar" type='checkbox' value='<?php echo $cod_estado_tipo_roles_eliminar ?>' <?php if($cod_estado_tipo_roles_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO DE ROL IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles_imprimir' class="" id="cod_estado_tipo_roles_imprimir" type='checkbox' value='<?php echo $cod_estado_tipo_roles_imprimir ?>' <?php if($cod_estado_tipo_roles_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO DE ROL EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles_exportar' class="" id="cod_estado_tipo_roles_exportar" type='checkbox' value='<?php echo $cod_estado_tipo_roles_exportar ?>' <?php if($cod_estado_tipo_roles_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>


<?php if ($cod_estado_grafico_estadistico_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">GRAFICO ESTADISTICO</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">GRAFICO ESTADISTICO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico' class="" id="cod_estado_grafico_estadistico" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico ?>' <?php if($cod_estado_grafico_estadistico=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO ESTADISTICO REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico_registrar' class="" id="cod_estado_grafico_estadistico_registrar" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico_registrar ?>' <?php if($cod_estado_grafico_estadistico_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO ESTADISTICO EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico_editar' class="" id="cod_estado_grafico_estadistico_editar" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico_editar ?>' <?php if($cod_estado_grafico_estadistico_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO ESTADISTICO ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico_eliminar' class="" id="cod_estado_grafico_estadistico_eliminar" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico_eliminar ?>' <?php if($cod_estado_grafico_estadistico_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO ESTADISTICO IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico_imprimir' class="" id="cod_estado_grafico_estadistico_imprimir" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico_imprimir ?>' <?php if($cod_estado_grafico_estadistico_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO ESTADISTICO EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico_exportar' class="" id="cod_estado_grafico_estadistico_exportar" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico_exportar ?>' <?php if($cod_estado_grafico_estadistico_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">--------------------------------------------------</th>
			<td style='text-align:center'></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta' class="" id="cod_estado_grafico_venta" type='checkbox' value='<?php echo $cod_estado_grafico_venta ?>' <?php if($cod_estado_grafico_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO COMPRAS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_compra' class="" id="cod_estado_grafico_compra" type='checkbox' value='<?php echo $cod_estado_grafico_compra ?>' <?php if($cod_estado_grafico_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS Y COMPRAS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_compra' class="" id="cod_estado_grafico_venta_compra" type='checkbox' value='<?php echo $cod_estado_grafico_venta_compra ?>' <?php if($cod_estado_grafico_venta_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS Y EGRESOS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_egreso' class="" id="cod_estado_grafico_venta_egreso" type='checkbox' value='<?php echo $cod_estado_grafico_venta_egreso ?>' <?php if($cod_estado_grafico_venta_egreso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR TIPO DE PAGO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tipo_pago' class="" id="cod_estado_grafico_venta_tipo_pago" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tipo_pago ?>' <?php if($cod_estado_grafico_venta_tipo_pago=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR FORMA DE PAGO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tipo_forma_pago' class="" id="cod_estado_grafico_venta_tipo_forma_pago" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tipo_forma_pago ?>' <?php if($cod_estado_grafico_venta_tipo_forma_pago=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS TIPO DE FACTURA</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tipo_factura' class="" id="cod_estado_grafico_venta_tipo_factura" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tipo_factura ?>' <?php if($cod_estado_grafico_venta_tipo_factura=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR CATEGORIA</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_categoria' class="" id="cod_estado_grafico_venta_categoria" type='checkbox' value='<?php echo $cod_estado_grafico_venta_categoria ?>' <?php if($cod_estado_grafico_venta_categoria=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR DEPENDENCIA</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_dependencia' class="" id="cod_estado_grafico_venta_dependencia" type='checkbox' value='<?php echo $cod_estado_grafico_venta_dependencia ?>' <?php if($cod_estado_grafico_venta_dependencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR TIPO DE COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tipo_compra' class="" id="cod_estado_grafico_venta_tipo_compra" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tipo_compra ?>' <?php if($cod_estado_grafico_venta_tipo_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR METODO DE ENVIO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tipo_metodo_envio' class="" id="cod_estado_grafico_venta_tipo_metodo_envio" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tipo_metodo_envio ?>' <?php if($cod_estado_grafico_venta_tipo_metodo_envio=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR TIPO DE APLICACION</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tipo_aplicacion' class="" id="cod_estado_grafico_venta_tipo_aplicacion" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tipo_aplicacion ?>' <?php if($cod_estado_grafico_venta_tipo_aplicacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_producto' class="" id="cod_estado_grafico_venta_producto" type='checkbox' value='<?php echo $cod_estado_grafico_venta_producto ?>' <?php if($cod_estado_grafico_venta_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tercero' class="" id="cod_estado_grafico_venta_tercero" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tercero ?>' <?php if($cod_estado_grafico_venta_tercero=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR TERCERO PRODUCTOS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tercero_producto' class="" id="cod_estado_grafico_venta_tercero_producto" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tercero_producto ?>' <?php if($cod_estado_grafico_venta_tercero_producto=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR TERCERO DOMICILIO</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_tercero_domicilio' class="" id="cod_estado_grafico_venta_tercero_domicilio" type='checkbox' value='<?php echo $cod_estado_grafico_venta_tercero_domicilio ?>' <?php if($cod_estado_grafico_venta_tercero_domicilio=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS PRODUCTOS MAS VENDIDOS (POR UNIDAD)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_producto_mas_vendido_und_venta' class="" id="cod_estado_grafico_producto_mas_vendido_und_venta" type='checkbox' value='<?php echo $cod_estado_grafico_producto_mas_vendido_und_venta ?>' <?php if($cod_estado_grafico_producto_mas_vendido_und_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS PRODUCTOS MAS VENDIDOS (POR PRECIO VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_producto_mas_vendido_precio_venta' class="" id="cod_estado_grafico_producto_mas_vendido_precio_venta" type='checkbox' value='<?php echo $cod_estado_grafico_producto_mas_vendido_precio_venta ?>' <?php if($cod_estado_grafico_producto_mas_vendido_precio_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO GRAFICO VENTAS PRODUCTOS MENOS VENDIDOS (POR UNIDAD)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_producto_menos_vendido_und_venta' class="" id="cod_estado_grafico_producto_menos_vendido_und_venta" type='checkbox' value='<?php echo $cod_estado_grafico_producto_menos_vendido_und_venta ?>' <?php if($cod_estado_grafico_producto_menos_vendido_und_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS PRODUCTOS MENOS VENDIDOS (POR PRECIO VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_producto_menos_vendido_precio_venta' class="" id="cod_estado_grafico_producto_menos_vendido_precio_venta" type='checkbox' value='<?php echo $cod_estado_grafico_producto_menos_vendido_precio_venta ?>' <?php if($cod_estado_grafico_producto_menos_vendido_precio_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO COMPRAS (PRECIO COMPRA - PRECIO VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_compra_precio_compra_precio_venta' class="" id="cod_estado_grafico_compra_precio_compra_precio_venta" type='checkbox' value='<?php echo $cod_estado_grafico_compra_precio_compra_precio_venta ?>' <?php if($cod_estado_grafico_compra_precio_compra_precio_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS (GANACIAS- EGRESOS)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_ganancia_venta_egreso' class="" id="cod_estado_grafico_ganancia_venta_egreso" type='checkbox' value='<?php echo $cod_estado_grafico_ganancia_venta_egreso ?>' <?php if($cod_estado_grafico_ganancia_venta_egreso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS (GANACIAS)</th>
			<td style='text-align:center'><input name='cod_estado_grafico_ganancia_venta' class="" id="cod_estado_grafico_ganancia_venta" type='checkbox' value='<?php echo $cod_estado_grafico_ganancia_venta ?>' <?php if($cod_estado_grafico_ganancia_venta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO VENTAS POR VENDEDOR</th>
			<td style='text-align:center'><input name='cod_estado_grafico_venta_por_vendedor' class="" id="cod_estado_grafico_venta_por_vendedor" type='checkbox' value='<?php echo $cod_estado_grafico_venta_por_vendedor ?>' <?php if($cod_estado_grafico_venta_por_vendedor=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GRAFICO EXTRAS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_extras' class="" id="cod_estado_grafico_extras" type='checkbox' value='<?php echo $cod_estado_grafico_extras ?>' <?php if($cod_estado_grafico_extras=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>


<?php if ($cod_estado_nota_observacion_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">NOTAS Y OBSERVACIONES</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">NOTAS Y OBSERVACIONES</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion' class="" id="cod_estado_nota_observacion" type='checkbox' value='<?php echo $cod_estado_nota_observacion ?>' <?php if($cod_estado_nota_observacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOTAS Y OBSERVACIONES REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion_registrar' class="" id="cod_estado_nota_observacion_registrar" type='checkbox' value='<?php echo $cod_estado_nota_observacion_registrar ?>' <?php if($cod_estado_nota_observacion_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOTAS Y OBSERVACIONES EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion_editar' class="" id="cod_estado_nota_observacion_editar" type='checkbox' value='<?php echo $cod_estado_nota_observacion_editar ?>' <?php if($cod_estado_nota_observacion_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOTAS Y OBSERVACIONES ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion_eliminar' class="" id="cod_estado_nota_observacion_eliminar" type='checkbox' value='<?php echo $cod_estado_nota_observacion_eliminar ?>' <?php if($cod_estado_nota_observacion_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOTAS Y OBSERVACIONES IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion_imprimir' class="" id="cod_estado_nota_observacion_imprimir" type='checkbox' value='<?php echo $cod_estado_nota_observacion_imprimir ?>' <?php if($cod_estado_nota_observacion_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOTAS Y OBSERVACIONES EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion_exportar' class="" id="cod_estado_nota_observacion_exportar" type='checkbox' value='<?php echo $cod_estado_nota_observacion_exportar ?>' <?php if($cod_estado_nota_observacion_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>

<?php if ($cod_estado_dependencia_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">DEPENDENCIAS</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">DEPENDENCIA</th>
			<td style='text-align:center'><input name='cod_estado_dependencia' class="" id="cod_estado_dependencia" type='checkbox' value='<?php echo $cod_estado_dependencia ?>' <?php if($cod_estado_dependencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DEPENDENCIA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_registrar' class="" id="cod_estado_dependencia_registrar" type='checkbox' value='<?php echo $cod_estado_dependencia_registrar ?>' <?php if($cod_estado_dependencia_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DEPENDENCIA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_editar' class="" id="cod_estado_dependencia_editar" type='checkbox' value='<?php echo $cod_estado_dependencia_editar ?>' <?php if($cod_estado_dependencia_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DEPENDENCIA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_eliminar' class="" id="cod_estado_dependencia_eliminar" type='checkbox' value='<?php echo $cod_estado_dependencia_eliminar ?>' <?php if($cod_estado_dependencia_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DEPENDENCIA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_imprimir' class="" id="cod_estado_dependencia_imprimir" type='checkbox' value='<?php echo $cod_estado_dependencia_imprimir ?>' <?php if($cod_estado_dependencia_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">DEPENDENCIA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_exportar' class="" id="cod_estado_dependencia_exportar" type='checkbox' value='<?php echo $cod_estado_dependencia_exportar ?>' <?php if($cod_estado_dependencia_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>

<?php if ($cod_estado_categoria_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">CATEGORIAS</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">CATEGORIA</th>
			<td style='text-align:center'><input name='cod_estado_categoria' class="" id="cod_estado_categoria" type='checkbox' value='<?php echo $cod_estado_categoria ?>' <?php if($cod_estado_categoria=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_categoria_registrar' class="" id="cod_estado_categoria_registrar" type='checkbox' value='<?php echo $cod_estado_categoria_registrar ?>' <?php if($cod_estado_categoria_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_categoria_editar' class="" id="cod_estado_categoria_editar" type='checkbox' value='<?php echo $cod_estado_categoria_editar ?>' <?php if($cod_estado_categoria_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_categoria_eliminar' class="" id="cod_estado_categoria_eliminar" type='checkbox' value='<?php echo $cod_estado_categoria_eliminar ?>' <?php if($cod_estado_categoria_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_categoria_imprimir' class="" id="cod_estado_categoria_imprimir" type='checkbox' value='<?php echo $cod_estado_categoria_imprimir ?>' <?php if($cod_estado_categoria_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_categoria_exportar' class="" id="cod_estado_categoria_exportar" type='checkbox' value='<?php echo $cod_estado_categoria_exportar ?>' <?php if($cod_estado_categoria_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>


<?php if ($cod_estado_cantidad_caja_mesa_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">CAJAS MESAS</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">CAJAS MESAS</th>
			<td style='text-align:center'><input name='cod_estado_caja_mesa' class="" id="cod_estado_caja_mesa" type='checkbox' value='<?php echo $cod_estado_caja_mesa ?>' <?php if($cod_estado_caja_mesa=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CAJAS MESAS REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_caja_mesa_registrar' class="" id="cod_estado_caja_mesa_registrar" type='checkbox' value='<?php echo $cod_estado_caja_mesa_registrar ?>' <?php if($cod_estado_caja_mesa_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CAJAS MESAS EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_caja_mesa_editar' class="" id="cod_estado_caja_mesa_editar" type='checkbox' value='<?php echo $cod_estado_caja_mesa_editar ?>' <?php if($cod_estado_caja_mesa_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CAJAS MESAS ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_caja_mesa_eliminar' class="" id="cod_estado_caja_mesa_eliminar" type='checkbox' value='<?php echo $cod_estado_caja_mesa_eliminar ?>' <?php if($cod_estado_caja_mesa_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CAJAS MESAS IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_caja_mesa_imprimir' class="" id="cod_estado_caja_mesa_imprimir" type='checkbox' value='<?php echo $cod_estado_caja_mesa_imprimir ?>' <?php if($cod_estado_caja_mesa_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CAJAS MESAS EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_caja_mesa_exportar' class="" id="cod_estado_caja_mesa_exportar" type='checkbox' value='<?php echo $cod_estado_caja_mesa_exportar ?>' <?php if($cod_estado_caja_mesa_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>

<?php if ($cod_estado_resolucion_factura_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">RESOLUCION</th></tr></thead></table>
		<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">RESOLUCION</th>
			<td style='text-align:center'><input name='cod_estado_resol_facturacion' class="" id="cod_estado_resol_facturacion" type='checkbox' value='<?php echo $cod_estado_resol_facturacion ?>' <?php if($cod_estado_resol_facturacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RESOLUCION REGISTRAR</th>
			<td style='text-align:center'><input name='cod_estado_resol_facturacion_registrar' class="" id="cod_estado_resol_facturacion_registrar" type='checkbox' value='<?php echo $cod_estado_resol_facturacion_registrar ?>' <?php if($cod_estado_resol_facturacion_registrar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RESOLUCION EDITAR</th>
			<td style='text-align:center'><input name='cod_estado_resol_facturacion_editar' class="" id="cod_estado_resol_facturacion_editar" type='checkbox' value='<?php echo $cod_estado_resol_facturacion_editar ?>' <?php if($cod_estado_resol_facturacion_editar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RESOLUCION ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_resol_facturacion_eliminar' class="" id="cod_estado_resol_facturacion_eliminar" type='checkbox' value='<?php echo $cod_estado_resol_facturacion_eliminar ?>' <?php if($cod_estado_resol_facturacion_eliminar=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RESOLUCION IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_resol_facturacion_imprimir' class="" id="cod_estado_resol_facturacion_imprimir" type='checkbox' value='<?php echo $cod_estado_resol_facturacion_imprimir ?>' <?php if($cod_estado_resol_facturacion_imprimir=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RESOLUCION EXPORTAR</th>
			<td style='text-align:center'><input name='cod_estado_resol_facturacion_exportar' class="" id="cod_estado_resol_facturacion_exportar" type='checkbox' value='<?php echo $cod_estado_resol_facturacion_exportar ?>' <?php if($cod_estado_resol_facturacion_exportar=='1'){ echo 'checked'; } ?>></td>
		</tr>
</table>
<?php } ?>

<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<?php if ($cod_estado_animal_global == '1') { ?>
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">ANIMALES</th></tr></thead></table>
<table border="1" class="table table-hover">
		<tr>
			<th style="text-align:left">COD RODEO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_rodeo' class="" id="cod_estado_prod_cod_rodeo" type='checkbox' value='<?php echo $cod_estado_prod_cod_rodeo ?>' <?php if($cod_estado_prod_cod_rodeo=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOMBRE RODEO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_rodeo' class="" id="cod_estado_prod_nombre_rodeo" type='checkbox' value='<?php echo $cod_estado_prod_nombre_rodeo ?>' <?php if($cod_estado_prod_nombre_rodeo=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">SEXO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_sexo' class="" id="cod_estado_prod_nombre_sexo" type='checkbox' value='<?php echo $cod_estado_prod_nombre_sexo ?>' <?php if($cod_estado_prod_nombre_sexo=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MONTA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_de_monta' class="" id="cod_estado_prod_de_monta" type='checkbox' value='<?php echo $cod_estado_prod_de_monta ?>' <?php if($cod_estado_prod_de_monta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">STATUS ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_estatus' class="" id="cod_estado_prod_nombre_estatus" type='checkbox' value='<?php echo $cod_estado_prod_nombre_estatus ?>' <?php if($cod_estado_prod_nombre_estatus=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CONDICCION CORPORAL ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_condicion_corporal' class="" id="cod_estado_prod_nombre_condicion_corporal" type='checkbox' value='<?php echo $cod_estado_prod_nombre_condicion_corporal ?>' <?php if($cod_estado_prod_nombre_condicion_corporal=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA INGRESO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_categoria_ingreso' class="" id="cod_estado_prod_nombre_categoria_ingreso" type='checkbox' value='<?php echo $cod_estado_prod_nombre_categoria_ingreso ?>' <?php if($cod_estado_prod_nombre_categoria_ingreso=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA ACTUAL ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_categoria_actual' class="" id="cod_estado_prod_nombre_categoria_actual" type='checkbox' value='<?php echo $cod_estado_prod_nombre_categoria_actual ?>' <?php if($cod_estado_prod_nombre_categoria_actual=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA FUTURA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_categoria_futura' class="" id="cod_estado_prod_nombre_categoria_futura" type='checkbox' value='<?php echo $cod_estado_prod_nombre_categoria_futura ?>' <?php if($cod_estado_prod_nombre_categoria_futura=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PROCEDENCIA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_procedencia' class="" id="cod_estado_prod_nombre_procedencia" type='checkbox' value='<?php echo $cod_estado_prod_nombre_procedencia ?>' <?php if($cod_estado_prod_nombre_procedencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO MONTA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_monta' class="" id="cod_estado_prod_nombre_tipo_monta" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_monta ?>' <?php if($cod_estado_prod_nombre_tipo_monta=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">LOTE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_lote_categoria' class="" id="cod_estado_prod_nombre_lote_categoria" type='checkbox' value='<?php echo $cod_estado_prod_nombre_lote_categoria ?>' <?php if($cod_estado_prod_nombre_lote_categoria=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PROGRAMA REPRODUCTIVO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_prog_reproductivo' class="" id="cod_estado_prod_nombre_prog_reproductivo" type='checkbox' value='<?php echo $cod_estado_prod_nombre_prog_reproductivo ?>' <?php if($cod_estado_prod_nombre_prog_reproductivo=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">POTRERO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_potrero' class="" id="cod_estado_prod_nombre_potrero" type='checkbox' value='<?php echo $cod_estado_prod_nombre_potrero ?>' <?php if($cod_estado_prod_nombre_potrero=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">LOTE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_lote' class="" id="cod_estado_prod_nombre_lote" type='checkbox' value='<?php echo $cod_estado_prod_nombre_lote ?>' <?php if($cod_estado_prod_nombre_lote=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CALIDAD ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_calidad_animal' class="" id="cod_estado_prod_nombre_calidad_animal" type='checkbox' value='<?php echo $cod_estado_prod_nombre_calidad_animal ?>' <?php if($cod_estado_prod_nombre_calidad_animal=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO EXPLOTACION ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_explotacion' class="" id="cod_estado_prod_nombre_tipo_explotacion" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_explotacion ?>' <?php if($cod_estado_prod_nombre_tipo_explotacion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PESO COMPRA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_peso_compra' class="" id="cod_estado_prod_peso_compra" type='checkbox' value='<?php echo $cod_estado_prod_peso_compra ?>' <?php if($cod_estado_prod_peso_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PRECIO COMPRA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_precio_compra' class="" id="cod_estado_prod_precio_compra" type='checkbox' value='<?php echo $cod_estado_prod_precio_compra ?>' <?php if($cod_estado_prod_precio_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA NACIMIENTO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_nac' class="" id="cod_estado_prod_fecha_nac" type='checkbox' value='<?php echo $cod_estado_prod_fecha_nac ?>' <?php if($cod_estado_prod_fecha_nac=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA COMPRA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_compra' class="" id="cod_estado_prod_fecha_compra" type='checkbox' value='<?php echo $cod_estado_prod_fecha_compra ?>' <?php if($cod_estado_prod_fecha_compra=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">FECHA CASTRACION ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_fecha_castracion' class="" id="cod_estado_prod_fecha_castracion" type='checkbox' value='<?php echo $cod_estado_prod_fecha_castracion ?>' <?php if($cod_estado_prod_fecha_castracion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NRO HIERROS ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nro_hierros' class="" id="cod_estado_prod_nro_hierros" type='checkbox' value='<?php echo $cod_estado_prod_nro_hierros ?>' <?php if($cod_estado_prod_nro_hierros=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">HIERRO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_hierro_animal' class="" id="cod_estado_prod_hierro_animal" type='checkbox' value='<?php echo $cod_estado_prod_hierro_animal ?>' <?php if($cod_estado_prod_hierro_animal=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NUMERO PARTOS ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_numero_partos' class="" id="cod_estado_prod_numero_partos" type='checkbox' value='<?php echo $cod_estado_prod_numero_partos ?>' <?php if($cod_estado_prod_numero_partos=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID ELECTRONICA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_electronica' class="" id="cod_estado_prod_id_electronica" type='checkbox' value='<?php echo $cod_estado_prod_id_electronica ?>' <?php if($cod_estado_prod_id_electronica=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA 1 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_raza1' class="" id="cod_estado_prod_nombre_raza1" type='checkbox' value='<?php echo $cod_estado_prod_nombre_raza1 ?>' <?php if($cod_estado_prod_nombre_raza1=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA 2 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_raza2' class="" id="cod_estado_prod_nombre_raza2" type='checkbox' value='<?php echo $cod_estado_prod_nombre_raza2 ?>' <?php if($cod_estado_prod_nombre_raza2=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA 3 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_raza3' class="" id="cod_estado_prod_nombre_raza3" type='checkbox' value='<?php echo $cod_estado_prod_nombre_raza3 ?>' <?php if($cod_estado_prod_nombre_raza3=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA 4 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_raza4' class="" id="cod_estado_prod_nombre_raza4" type='checkbox' value='<?php echo $cod_estado_prod_nombre_raza4 ?>' <?php if($cod_estado_prod_nombre_raza4=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PTJ RAZA 1 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_ptj_raza1' class="" id="cod_estado_prod_ptj_raza1" type='checkbox' value='<?php echo $cod_estado_prod_ptj_raza1 ?>' <?php if($cod_estado_prod_ptj_raza1=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PTJ RAZA 2 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_ptj_raza2' class="" id="cod_estado_prod_ptj_raza2" type='checkbox' value='<?php echo $cod_estado_prod_ptj_raza2 ?>' <?php if($cod_estado_prod_ptj_raza2=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PTJ RAZA 3 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_ptj_raza3' class="" id="cod_estado_prod_ptj_raza3" type='checkbox' value='<?php echo $cod_estado_prod_ptj_raza3 ?>' <?php if($cod_estado_prod_ptj_raza3=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PTJ RAZA 4 ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_ptj_raza4' class="" id="cod_estado_prod_ptj_raza4" type='checkbox' value='<?php echo $cod_estado_prod_ptj_raza4 ?>' <?php if($cod_estado_prod_ptj_raza4=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID PADRE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_padre' class="" id="cod_estado_prod_id_padre" type='checkbox' value='<?php echo $cod_estado_prod_id_padre ?>' <?php if($cod_estado_prod_id_padre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA PADRE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_raza_padre' class="" id="cod_estado_prod_raza_padre" type='checkbox' value='<?php echo $cod_estado_prod_raza_padre ?>' <?php if($cod_estado_prod_raza_padre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID MADRE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_madre' class="" id="cod_estado_prod_id_madre" type='checkbox' value='<?php echo $cod_estado_prod_id_madre ?>' <?php if($cod_estado_prod_id_madre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA MADRE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_raza_madre' class="" id="cod_estado_prod_raza_madre" type='checkbox' value='<?php echo $cod_estado_prod_raza_madre ?>' <?php if($cod_estado_prod_raza_madre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PARTOS MADRE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_partos_madre' class="" id="cod_estado_prod_partos_madre" type='checkbox' value='<?php echo $cod_estado_prod_partos_madre ?>' <?php if($cod_estado_prod_partos_madre=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID ABUELO PATERNO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_abuelo_paterno' class="" id="cod_estado_prod_id_abuelo_paterno" type='checkbox' value='<?php echo $cod_estado_prod_id_abuelo_paterno ?>' <?php if($cod_estado_prod_id_abuelo_paterno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID ABUELO MATERNO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_abuelo_materno' class="" id="cod_estado_prod_id_abuelo_materno" type='checkbox' value='<?php echo $cod_estado_prod_id_abuelo_materno ?>' <?php if($cod_estado_prod_id_abuelo_materno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOMBRE ABUELO PATERNO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_abuelo_paterno' class="" id="cod_estado_prod_nombre_abuelo_paterno" type='checkbox' value='<?php echo $cod_estado_prod_nombre_abuelo_paterno ?>' <?php if($cod_estado_prod_nombre_abuelo_paterno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOMBRE ABUELO MATERNO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_abuelo_materno' class="" id="cod_estado_prod_nombre_abuelo_materno" type='checkbox' value='<?php echo $cod_estado_prod_nombre_abuelo_materno ?>' <?php if($cod_estado_prod_nombre_abuelo_materno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA ABUELO MATERNO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_raza_abuelo_paterno' class="" id="cod_estado_prod_raza_abuelo_paterno" type='checkbox' value='<?php echo $cod_estado_prod_raza_abuelo_paterno ?>' <?php if($cod_estado_prod_raza_abuelo_paterno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA ABUELO MATERNO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_raza_abuelo_materno' class="" id="cod_estado_prod_raza_abuelo_materno" type='checkbox' value='<?php echo $cod_estado_prod_raza_abuelo_materno ?>' <?php if($cod_estado_prod_raza_abuelo_materno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID ABUELA PATERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_abuela_paterno' class="" id="cod_estado_prod_id_abuela_paterno" type='checkbox' value='<?php echo $cod_estado_prod_id_abuela_paterno ?>' <?php if($cod_estado_prod_id_abuela_paterno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ID ABUELA MATERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_id_abuela_materno' class="" id="cod_estado_prod_id_abuela_materno" type='checkbox' value='<?php echo $cod_estado_prod_id_abuela_materno ?>' <?php if($cod_estado_prod_id_abuela_materno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOMBRE ABUELA PATERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_abuela_paterno' class="" id="cod_estado_prod_nombre_abuela_paterno" type='checkbox' value='<?php echo $cod_estado_prod_nombre_abuela_paterno ?>' <?php if($cod_estado_prod_nombre_abuela_paterno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOMBRE ABUELA MATERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_abuela_materno' class="" id="cod_estado_prod_nombre_abuela_materno" type='checkbox' value='<?php echo $cod_estado_prod_nombre_abuela_materno ?>' <?php if($cod_estado_prod_nombre_abuela_materno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA ABUELA PATERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_raza_abuela_paterno' class="" id="cod_estado_prod_raza_abuela_paterno" type='checkbox' value='<?php echo $cod_estado_prod_raza_abuela_paterno ?>' <?php if($cod_estado_prod_raza_abuela_paterno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">RAZA ABUELA MATERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_raza_abuela_materno' class="" id="cod_estado_prod_raza_abuela_materno" type='checkbox' value='<?php echo $cod_estado_prod_raza_abuela_materno ?>' <?php if($cod_estado_prod_raza_abuela_materno=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO CONCEPCION ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_concepcion' class="" id="cod_estado_prod_nombre_tipo_concepcion" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_concepcion ?>' <?php if($cod_estado_prod_nombre_tipo_concepcion=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ESPECIE ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_especie' class="" id="cod_estado_prod_nombre_especie" type='checkbox' value='<?php echo $cod_estado_prod_nombre_especie ?>' <?php if($cod_estado_prod_nombre_especie=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MARCAS TATUADO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_marcas_tatuado' class="" id="cod_estado_prod_marcas_tatuado" type='checkbox' value='<?php echo $cod_estado_prod_marcas_tatuado ?>' <?php if($cod_estado_prod_marcas_tatuado=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MARCAS HERRADO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_marcas_herrado' class="" id="cod_estado_prod_marcas_herrado" type='checkbox' value='<?php echo $cod_estado_prod_marcas_herrado ?>' <?php if($cod_estado_prod_marcas_herrado=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MARCAS DESCONADO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_marcas_descornado' class="" id="cod_estado_prod_marcas_descornado" type='checkbox' value='<?php echo $cod_estado_prod_marcas_descornado ?>' <?php if($cod_estado_prod_marcas_descornado=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">MARCAS CASTRADO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_marcas_castrado' class="" id="cod_estado_prod_marcas_castrado" type='checkbox' value='<?php echo $cod_estado_prod_marcas_castrado ?>' <?php if($cod_estado_prod_marcas_castrado=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COLOR ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_color' class="" id="cod_estado_prod_nombre_color" type='checkbox' value='<?php echo $cod_estado_prod_nombre_color ?>' <?php if($cod_estado_prod_nombre_color=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TEMPERAMENTO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_temperamento' class="" id="cod_estado_prod_nombre_temperamento" type='checkbox' value='<?php echo $cod_estado_prod_nombre_temperamento ?>' <?php if($cod_estado_prod_nombre_temperamento=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">PESO AL NACER ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_peso_nacer' class="" id="cod_estado_prod_peso_nacer" type='checkbox' value='<?php echo $cod_estado_prod_peso_nacer ?>' <?php if($cod_estado_prod_peso_nacer=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">APLOMOS CORVEJON ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_aplomo_corvejon' class="" id="cod_estado_prod_aplomo_corvejon" type='checkbox' value='<?php echo $cod_estado_prod_aplomo_corvejon ?>' <?php if($cod_estado_prod_aplomo_corvejon=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">APLOMOS CUARTILLAS ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_aplomo_cuartilla' class="" id="cod_estado_prod_aplomo_cuartilla" type='checkbox' value='<?php echo $cod_estado_prod_aplomo_cuartilla ?>' <?php if($cod_estado_prod_aplomo_cuartilla=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">APLOMOS CASCOS ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_aplomo_cascos' class="" id="cod_estado_prod_aplomo_cascos" type='checkbox' value='<?php echo $cod_estado_prod_aplomo_cascos ?>' <?php if($cod_estado_prod_aplomo_cascos=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GENITAL CIRCUNFERENCIA ESCROTAL ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_genital_circun_escrotal' class="" id="cod_estado_prod_genital_circun_escrotal" type='checkbox' value='<?php echo $cod_estado_prod_genital_circun_escrotal ?>' <?php if($cod_estado_prod_genital_circun_escrotal=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GENITAL PREPUSIO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_genital_prepusio' class="" id="cod_estado_prod_genital_prepusio" type='checkbox' value='<?php echo $cod_estado_prod_genital_prepusio ?>' <?php if($cod_estado_prod_genital_prepusio=='1'){ echo 'checked'; } ?>></td>
		</tr>	
		<tr>
			<th style="text-align:left">GENITAL POTENCIA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_genital_potencia' class="" id="cod_estado_prod_genital_potencia" type='checkbox' value='<?php echo $cod_estado_prod_genital_potencia ?>' <?php if($cod_estado_prod_genital_potencia=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">GENITAL SEMEN ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_genital_semen' class="" id="cod_estado_prod_genital_semen" type='checkbox' value='<?php echo $cod_estado_prod_genital_semen ?>' <?php if($cod_estado_prod_genital_semen=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">OBSERVACIONES ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_observacion_animal' class="" id="cod_estado_prod_observacion_animal" type='checkbox' value='<?php echo $cod_estado_prod_observacion_animal ?>' <?php if($cod_estado_prod_observacion_animal=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">ESTADO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_estado' class="" id="cod_estado_prod_nombre_estado" type='checkbox' value='<?php echo $cod_estado_prod_nombre_estado ?>' <?php if($cod_estado_prod_nombre_estado=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">TIPO MOVIMIENTO ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_tipo_movimiento' class="" id="cod_estado_prod_nombre_tipo_movimiento" type='checkbox' value='<?php echo $cod_estado_prod_nombre_tipo_movimiento ?>' <?php if($cod_estado_prod_nombre_tipo_movimiento=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATERGORIA NIAL EXTERNA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_categoria_animal_extern' class="" id="cod_estado_prod_nombre_categoria_animal_extern" type='checkbox' value='<?php echo $cod_estado_prod_nombre_categoria_animal_extern ?>' <?php if($cod_estado_prod_nombre_categoria_animal_extern=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">COD FINCA</th>
			<td style='text-align:center'><input name='cod_estado_prod_cod_finca' class="" id="cod_estado_prod_cod_finca" type='checkbox' value='<?php echo $cod_estado_prod_cod_finca ?>' <?php if($cod_estado_prod_cod_finca=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">NOMBRE FINCA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_finca' class="" id="cod_estado_prod_nombre_finca" type='checkbox' value='<?php echo $cod_estado_prod_nombre_finca ?>' <?php if($cod_estado_prod_nombre_finca=='1'){ echo 'checked'; } ?>></td>
		</tr>
		<tr>
			<th style="text-align:left">CATEGORIA ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_prod_nombre_categoria' class="" id="cod_estado_prod_nombre_categoria" type='checkbox' value='<?php echo $cod_estado_prod_nombre_categoria ?>' <?php if($cod_estado_prod_nombre_categoria=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************************************* -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_seguridad" value="<?php echo $cod_seguridad ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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


<script type="text/javascript">
$(document).ready(function() {
var cod_estado_prod = $('#cod_estado_prod').val();
var cod_estado_prod_reg_producto = $('#cod_estado_prod_reg_producto').val();
var cod_estado_prod_subproducto_registrar = $('#cod_estado_prod_subproducto_registrar').val();
var cod_estado_prod_cargar_factura_compra = $('#cod_estado_prod_cargar_factura_compra').val();
var cod_estado_prod_cargar_factura_compra_soporte = $('#cod_estado_prod_cargar_factura_compra_soporte').val();
var cod_estado_prod_cargar_factura_compra_observacion = $('#cod_estado_prod_cargar_factura_compra_observacion').val();
var cod_estado_prod_transferencia = $('#cod_estado_prod_transferencia').val();
var cod_estado_prod_auditoria = $('#cod_estado_prod_auditoria').val();
var cod_estado_prod_nuevo_invenario = $('#cod_estado_prod_nuevo_invenario').val();
var cod_estado_prod_inventario_producto = $('#cod_estado_prod_inventario_producto').val();
var cod_estado_prod_registrar = $('#cod_estado_prod_registrar').val();
var cod_estado_prod_editar = $('#cod_estado_prod_editar').val();
var cod_estado_prod_eliminar = $('#cod_estado_prod_eliminar').val();
var cod_estado_prod_imprimir = $('#cod_estado_prod_imprimir').val();
var cod_estado_prod_exportar = $('#cod_estado_prod_exportar').val();
var cod_estado_prod_subproducto = $('#cod_estado_prod_subproducto').val();
var cod_estado_prod_und_producto = $('#cod_estado_prod_und_producto').val();
var cod_estado_prod_und_producto_bodega = $('#cod_estado_prod_und_producto_bodega').val();
var cod_estado_prod_precio_compra_producto = $('#cod_estado_prod_precio_compra_producto').val();
var cod_estado_prod_precio_costo_producto = $('#cod_estado_prod_precio_costo_producto').val();
var cod_estado_prod_precio_venta_producto = $('#cod_estado_prod_precio_venta_producto').val();
var cod_estado_prod_precio_venta_producto2 = $('#cod_estado_prod_precio_venta_producto2').val();
var cod_estado_prod_precio_venta_producto3 = $('#cod_estado_prod_precio_venta_producto3').val();
var cod_estado_prod_precio_venta_producto4 = $('#cod_estado_prod_precio_venta_producto4').val();
var cod_estado_prod_precio_venta_producto5 = $('#cod_estado_prod_precio_venta_producto5').val();
var cod_estado_prod_nombre_tipo_unidad_medida = $('#cod_estado_prod_nombre_tipo_unidad_medida').val();
var cod_estado_prod_iva_ptj = $('#cod_estado_prod_iva_ptj').val();
var cod_estado_prod_nombre_tipo_producto = $('#cod_estado_prod_nombre_tipo_producto').val();
var cod_estado_prod_cod_marca = $('#cod_estado_prod_cod_marca').val();
var cod_estado_prod_cod_proveedor = $('#cod_estado_prod_cod_proveedor').val();
var cod_estado_prod_cod_tercero = $('#cod_estado_prod_cod_tercero').val();
var cod_estado_prod_cod_estado = $('#cod_estado_prod_cod_estado').val();
var cod_estado_prod_cod_dependencia = $('#cod_estado_prod_cod_dependencia').val();
var cod_estado_prod_fecha_ult_compra = $('#cod_estado_prod_fecha_ult_compra').val();
var cod_estado_prod_fecha_ult_venta = $('#cod_estado_prod_fecha_ult_venta').val();
var cod_estado_prod_fecha_vencimiento = $('#cod_estado_prod_fecha_vencimiento').val();
var cod_estado_prod_tope_min = $('#cod_estado_prod_tope_min').val();
var cod_estado_prod_fecha_creacion = $('#cod_estado_prod_fecha_creacion').val();
var cod_estado_prod_fecha_modificacion = $('#cod_estado_prod_fecha_modificacion').val();
var cod_estado_prod_nombre_tipo_precio_venta = $('#cod_estado_prod_nombre_tipo_precio_venta').val();
var cod_estado_prod_url_img_orig_producto = $('#cod_estado_prod_url_img_orig_producto').val();
var cod_estado_prod_url_img_min_producto = $('#cod_estado_prod_url_img_min_producto').val();
var cod_estado_prod_comision_ptj = $('#cod_estado_prod_comision_ptj').val();
var cod_estado_prod_dto1 = $('#cod_estado_prod_dto1').val();
var cod_estado_prod_dto2 = $('#cod_estado_prod_dto2').val();
var cod_estado_prod_ipc_ptj = $('#cod_estado_prod_ipc_ptj').val();
var cod_estado_prod_precio_ipc = $('#cod_estado_prod_precio_ipc').val();
var cod_estado_prod_ret_ica_ptj = $('#cod_estado_prod_ret_ica_ptj').val();
var cod_estado_prod_iva_teorico_ptj = $('#cod_estado_prod_iva_teorico_ptj').val();
var cod_estado_prod_tarifa_rete_vigente_ptj = $('#cod_estado_prod_tarifa_rete_vigente_ptj').val();
var cod_estado_prod_rete_iva_asumido_ptj = $('#cod_estado_prod_rete_iva_asumido_ptj').val();
var cod_estado_prod_nombre_tipo_compra = $('#cod_estado_prod_nombre_tipo_compra').val();
var cod_estado_prod_nombre_tipo_cargue_factura = $('#cod_estado_prod_nombre_tipo_cargue_factura').val();
var cod_estado_prod_nombre_tipo_medida = $('#cod_estado_prod_nombre_tipo_medida').val();
var cod_estado_prod_cajas_sobre = $('#cod_estado_prod_cajas_sobre').val();
var cod_estado_prod_und_sobre = $('#cod_estado_prod_und_sobre').val();
var cod_estado_prod_cod_interno = $('#cod_estado_prod_cod_interno').val();
var cod_estado_prod_cod_original = $('#cod_estado_prod_cod_original').val();
var cod_estado_prod_codificacion = $('#cod_estado_prod_codificacion').val();
var cod_estado_prod_cod_producto_serial = $('#cod_estado_prod_cod_producto_serial').val();
var cod_estado_prod_fecha_mantenimiento = $('#cod_estado_prod_fecha_mantenimiento').val();
var cod_estado_prod_peso_producto = $('#cod_estado_prod_peso_producto').val();
var cod_estado_prod_cod_rodeo = $('#cod_estado_prod_cod_rodeo').val();
var cod_estado_prod_nombre_rodeo = $('#cod_estado_prod_nombre_rodeo').val();
var cod_estado_prod_nombre_sexo = $('#cod_estado_prod_nombre_sexo').val();
var cod_estado_prod_de_monta = $('#cod_estado_prod_de_monta').val();
var cod_estado_prod_nombre_estatus = $('#cod_estado_prod_nombre_estatus').val();
var cod_estado_prod_nombre_condicion_corporal = $('#cod_estado_prod_nombre_condicion_corporal').val();
var cod_estado_prod_nombre_categoria_ingreso = $('#cod_estado_prod_nombre_categoria_ingreso').val();
var cod_estado_prod_nombre_categoria_actual = $('#cod_estado_prod_nombre_categoria_actual').val();
var cod_estado_prod_nombre_categoria_futura = $('#cod_estado_prod_nombre_categoria_futura').val();
var cod_estado_prod_nombre_procedencia = $('#cod_estado_prod_nombre_procedencia').val();
var cod_estado_prod_nombre_tipo_monta = $('#cod_estado_prod_nombre_tipo_monta').val();
var cod_estado_prod_nombre_lote_categoria = $('#cod_estado_prod_nombre_lote_categoria').val();
var cod_estado_prod_nombre_prog_reproductivo = $('#cod_estado_prod_nombre_prog_reproductivo').val();
var cod_estado_prod_nombre_potrero = $('#cod_estado_prod_nombre_potrero').val();
var cod_estado_prod_nombre_lote = $('#cod_estado_prod_nombre_lote').val();
var cod_estado_prod_nombre_calidad_animal = $('#cod_estado_prod_nombre_calidad_animal').val();
var cod_estado_prod_nombre_tipo_explotacion = $('#cod_estado_prod_nombre_tipo_explotacion').val();
var cod_estado_prod_peso_compra = $('#cod_estado_prod_peso_compra').val();
var cod_estado_prod_precio_compra = $('#cod_estado_prod_precio_compra').val();
var cod_estado_prod_fecha_nac = $('#cod_estado_prod_fecha_nac').val();
var cod_estado_prod_fecha_compra = $('#cod_estado_prod_fecha_compra').val();
var cod_estado_prod_fecha_castracion = $('#cod_estado_prod_fecha_castracion').val();
var cod_estado_prod_nro_hierros = $('#cod_estado_prod_nro_hierros').val();
var cod_estado_prod_hierro_animal = $('#cod_estado_prod_hierro_animal').val();
var cod_estado_prod_numero_partos = $('#cod_estado_prod_numero_partos').val();
var cod_estado_prod_id_electronica = $('#cod_estado_prod_id_electronica').val();
var cod_estado_prod_nombre_raza1 = $('#cod_estado_prod_nombre_raza1').val();
var cod_estado_prod_nombre_raza2 = $('#cod_estado_prod_nombre_raza2').val();
var cod_estado_prod_nombre_raza3 = $('#cod_estado_prod_nombre_raza3').val();
var cod_estado_prod_nombre_raza4 = $('#cod_estado_prod_nombre_raza4').val();
var cod_estado_prod_ptj_raza1 = $('#cod_estado_prod_ptj_raza1').val();
var cod_estado_prod_ptj_raza2 = $('#cod_estado_prod_ptj_raza2').val();
var cod_estado_prod_ptj_raza3 = $('#cod_estado_prod_ptj_raza3').val();
var cod_estado_prod_ptj_raza4 = $('#cod_estado_prod_ptj_raza4').val();
var cod_estado_prod_id_padre = $('#cod_estado_prod_id_padre').val();
var cod_estado_prod_raza_padre = $('#cod_estado_prod_raza_padre').val();
var cod_estado_prod_id_madre = $('#cod_estado_prod_id_madre').val();
var cod_estado_prod_raza_madre = $('#cod_estado_prod_raza_madre').val();
var cod_estado_prod_partos_madre = $('#cod_estado_prod_partos_madre').val();
var cod_estado_prod_id_abuelo_paterno = $('#cod_estado_prod_id_abuelo_paterno').val();
var cod_estado_prod_id_abuelo_materno = $('#cod_estado_prod_id_abuelo_materno').val();
var cod_estado_prod_nombre_abuelo_paterno = $('#cod_estado_prod_nombre_abuelo_paterno').val();
var cod_estado_prod_nombre_abuelo_materno = $('#cod_estado_prod_nombre_abuelo_materno').val();
var cod_estado_prod_raza_abuelo_paterno = $('#cod_estado_prod_raza_abuelo_paterno').val();
var cod_estado_prod_raza_abuelo_materno = $('#cod_estado_prod_raza_abuelo_materno').val();
var cod_estado_prod_id_abuela_paterno = $('#cod_estado_prod_id_abuela_paterno').val();
var cod_estado_prod_id_abuela_materno = $('#cod_estado_prod_id_abuela_materno').val();
var cod_estado_prod_nombre_abuela_paterno = $('#cod_estado_prod_nombre_abuela_paterno').val();
var cod_estado_prod_nombre_abuela_materno = $('#cod_estado_prod_nombre_abuela_materno').val();
var cod_estado_prod_raza_abuela_paterno = $('#cod_estado_prod_raza_abuela_paterno').val();
var cod_estado_prod_raza_abuela_materno = $('#cod_estado_prod_raza_abuela_materno').val();
var cod_estado_prod_nombre_tipo_concepcion = $('#cod_estado_prod_nombre_tipo_concepcion').val();
var cod_estado_prod_nombre_especie = $('#cod_estado_prod_nombre_especie').val();
var cod_estado_prod_marcas_tatuado = $('#cod_estado_prod_marcas_tatuado').val();
var cod_estado_prod_marcas_herrado = $('#cod_estado_prod_marcas_herrado').val();
var cod_estado_prod_marcas_descornado = $('#cod_estado_prod_marcas_descornado').val();
var cod_estado_prod_marcas_castrado = $('#cod_estado_prod_marcas_castrado').val();
var cod_estado_prod_nombre_color = $('#cod_estado_prod_nombre_color').val();
var cod_estado_prod_nombre_temperamento = $('#cod_estado_prod_nombre_temperamento').val();
var cod_estado_prod_peso_nacer = $('#cod_estado_prod_peso_nacer').val();
var cod_estado_prod_aplomo_corvejon = $('#cod_estado_prod_aplomo_corvejon').val();
var cod_estado_prod_aplomo_cuartilla = $('#cod_estado_prod_aplomo_cuartilla').val();
var cod_estado_prod_aplomo_cascos = $('#cod_estado_prod_aplomo_cascos').val();
var cod_estado_prod_genital_circun_escrotal = $('#cod_estado_prod_genital_circun_escrotal').val();
var cod_estado_prod_genital_prepusio = $('#cod_estado_prod_genital_prepusio').val();
var cod_estado_prod_genital_potencia = $('#cod_estado_prod_genital_potencia').val();
var cod_estado_prod_genital_semen = $('#cod_estado_prod_genital_semen').val();
var cod_estado_prod_observacion_animal = $('#cod_estado_prod_observacion_animal').val();
var cod_estado_prod_nombre_estado = $('#cod_estado_prod_nombre_estado').val();
var cod_estado_prod_nombre_tipo_movimiento = $('#cod_estado_prod_nombre_tipo_movimiento').val();
var cod_estado_prod_nombre_categoria_animal_extern = $('#cod_estado_prod_nombre_categoria_animal_extern').val();
var cod_estado_prod_cod_finca = $('#cod_estado_prod_cod_finca').val();
var cod_estado_prod_nombre_finca = $('#cod_estado_prod_nombre_finca').val();
var cod_estado_prod_nombre_categoria = $('#cod_estado_prod_nombre_categoria').val();
var cod_estado_prod_nombre_categoria_sub = $('#cod_estado_prod_nombre_categoria_sub').val();
var cod_estado_prod_und_inv = $('#cod_estado_prod_und_inv').val();
var cod_estado_prod_descripcion_producto = $('#cod_estado_prod_descripcion_producto').val();
var cod_estado_prod_url_img_producto_min = $('#cod_estado_prod_url_img_producto_min').val();
var cod_estado_prod_url_img_producto_orig = $('#cod_estado_prod_url_img_producto_orig').val();
var cod_estado_prod_nombre_promocion = $('#cod_estado_prod_nombre_promocion').val();
var cod_estado_prod_nombre_promocion_ing = $('#cod_estado_prod_nombre_promocion_ing').val();
var cod_estado_prod_posologia_cantidad = $('#cod_estado_prod_posologia_cantidad').val();
var cod_estado_prod_posologia_peso = $('#cod_estado_prod_posologia_peso').val();
var cod_estado_prod_nombre_tipo_presentacion = $('#cod_estado_prod_nombre_tipo_presentacion').val();
var cod_estado_prod_nombre_via_administracion = $('#cod_estado_prod_nombre_via_administracion').val();
var cod_estado_prod_nombre_frec_duracion = $('#cod_estado_prod_nombre_frec_duracion').val();
var cod_estado_plan_separe = $('#cod_estado_plan_separe').val();
var cod_estado_plan_separe_registrar = $('#cod_estado_plan_separe_registrar').val();
var cod_estado_plan_separe_editar = $('#cod_estado_plan_separe_editar').val();
var cod_estado_plan_separe_eliminar = $('#cod_estado_plan_separe_eliminar').val();
var cod_estado_plan_separe_imprimir = $('#cod_estado_plan_separe_imprimir').val();
var cod_estado_plan_separe_exportar = $('#cod_estado_plan_separe_exportar').val();
var cod_estado_contabilidad = $('#cod_estado_contabilidad').val();
var cod_estado_contabilidad_mov_contable = $('#cod_estado_contabilidad_mov_contable').val();
var cod_estado_contabilidad_mov_contable_registrar = $('#cod_estado_contabilidad_mov_contable_registrar').val();
var cod_estado_contabilidad_mov_contable_editar = $('#cod_estado_contabilidad_mov_contable_editar').val();
var cod_estado_contabilidad_mov_contable_eliminar = $('#cod_estado_contabilidad_mov_contable_eliminar').val();
var cod_estado_contabilidad_mov_contable_imprimir = $('#cod_estado_contabilidad_mov_contable_imprimir').val();
var cod_estado_contabilidad_mov_contable_exportar = $('#cod_estado_contabilidad_mov_contable_exportar').val();
var cod_estado_contabilidad_pyg = $('#cod_estado_contabilidad_pyg').val();
var cod_estado_contabilidad_pyg_registrar = $('#cod_estado_contabilidad_pyg_registrar').val();
var cod_estado_contabilidad_pyg_editar = $('#cod_estado_contabilidad_pyg_editar').val();
var cod_estado_contabilidad_pyg_eliminar = $('#cod_estado_contabilidad_pyg_eliminar').val();
var cod_estado_contabilidad_pyg_imprimir = $('#cod_estado_contabilidad_pyg_imprimir').val();
var cod_estado_contabilidad_pyg_exportar = $('#cod_estado_contabilidad_pyg_exportar').val();
var cod_estado_contabilidad_balance = $('#cod_estado_contabilidad_balance').val();
var cod_estado_contabilidad_balance_pyg_registrar = $('#cod_estado_contabilidad_balance_pyg_registrar').val();
var cod_estado_contabilidad_balance_pyg_editar = $('#cod_estado_contabilidad_balance_pyg_editar').val();
var cod_estado_contabilidad_balance_pyg_eliminar = $('#cod_estado_contabilidad_balance_pyg_eliminar').val();
var cod_estado_contabilidad_balance_pyg_imprimir = $('#cod_estado_contabilidad_balance_pyg_imprimir').val();
var cod_estado_contabilidad_balance_pyg_exportar = $('#cod_estado_contabilidad_balance_pyg_exportar').val();
var cod_estado_contabilidad_puc = $('#cod_estado_contabilidad_puc').val();
var cod_estado_contabilidad_puc_registrar = $('#cod_estado_contabilidad_puc_registrar').val();
var cod_estado_contabilidad_puc_editar = $('#cod_estado_contabilidad_puc_editar').val();
var cod_estado_contabilidad_puc_eliminar = $('#cod_estado_contabilidad_puc_eliminar').val();
var cod_estado_contabilidad_puc_imprimir = $('#cod_estado_contabilidad_puc_imprimir').val();
var cod_estado_contabilidad_puc_exportar = $('#cod_estado_contabilidad_puc_exportar').val();
var cod_estado_facturacion = $('#cod_estado_facturacion').val();
var cod_estado_facturacion_venta = $('#cod_estado_facturacion_venta').val();
var cod_estado_facturacion_venta_registrar = $('#cod_estado_facturacion_venta_registrar').val();
var cod_estado_facturacion_venta_editar = $('#cod_estado_facturacion_venta_editar').val();
var cod_estado_facturacion_venta_eliminar = $('#cod_estado_facturacion_venta_eliminar').val();
var cod_estado_facturacion_venta_imprimir = $('#cod_estado_facturacion_venta_imprimir').val();
var cod_estado_facturacion_venta_exportar = $('#cod_estado_facturacion_venta_exportar').val();
var cod_estado_facturacion_venta_devol = $('#cod_estado_facturacion_venta_devol').val();
var cod_estado_facturacion_compra = $('#cod_estado_facturacion_compra').val();
var cod_estado_facturacion_compra_registrar = $('#cod_estado_facturacion_compra_registrar').val();
var cod_estado_facturacion_compra_editar = $('#cod_estado_facturacion_compra_editar').val();
var cod_estado_facturacion_compra_eliminar = $('#cod_estado_facturacion_compra_eliminar').val();
var cod_estado_facturacion_compra_imprimir = $('#cod_estado_facturacion_compra_imprimir').val();
var cod_estado_facturacion_compra_exportar = $('#cod_estado_facturacion_compra_exportar').val();
var cod_estado_facturacion_compra_devol = $('#cod_estado_facturacion_compra_devol').val();
var cod_estado_facturacion_devol_venta = $('#cod_estado_facturacion_devol_venta').val();
var cod_estado_facturacion_devol_inventario = $('#cod_estado_facturacion_devol_inventario').val();
var cod_estado_cotizacion = $('#cod_estado_cotizacion').val();
var cod_estado_cotizacion_venta = $('#cod_estado_cotizacion_venta').val();
var cod_estado_cotizacion_venta_registrar = $('#cod_estado_cotizacion_venta_registrar').val();
var cod_estado_cotizacion_venta_editar = $('#cod_estado_cotizacion_venta_editar').val();
var cod_estado_cotizacion_venta_eliminar = $('#cod_estado_cotizacion_venta_eliminar').val();
var cod_estado_cotizacion_venta_imprimir = $('#cod_estado_cotizacion_venta_imprimir').val();
var cod_estado_cotizacion_venta_exportar = $('#cod_estado_cotizacion_venta_exportar').val();
var cod_estado_cotizacion_compra = $('#cod_estado_cotizacion_compra').val();
var cod_estado_cotizacion_compra_registrar = $('#cod_estado_cotizacion_compra_registrar').val();
var cod_estado_cotizacion_compra_editar = $('#cod_estado_cotizacion_compra_editar').val();
var cod_estado_cotizacion_compra_eliminar = $('#cod_estado_cotizacion_compra_eliminar').val();
var cod_estado_cotizacion_compra_imprimir = $('#cod_estado_cotizacion_compra_imprimir').val();
var cod_estado_cotizacion_compra_exportar = $('#cod_estado_cotizacion_compra_exportar').val();
var cod_estado_venta = $('#cod_estado_venta').val();
var cod_estado_venta_manual = $('#cod_estado_venta_manual').val();
var cod_estado_venta_barras = $('#cod_estado_venta_barras').val();
var cod_estado_venta_fecha_venta = $('#cod_estado_venta_fecha_venta').val();
var cod_estado_venta_preventa = $('#cod_estado_venta_preventa').val();
var cod_estado_venta_propina = $('#cod_estado_venta_propina').val();
var cod_estado_venta_bolsa = $('#cod_estado_venta_bolsa').val();
var cod_estado_venta_observacion = $('#cod_estado_venta_observacion').val();
var cod_estado_tercero = $('#cod_estado_tercero').val();
var cod_estado_tercero_registrar = $('#cod_estado_tercero_registrar').val();
var cod_estado_tercero_editar = $('#cod_estado_tercero_editar').val();
var cod_estado_tercero_eliminar = $('#cod_estado_tercero_eliminar').val();
var cod_estado_tercero_imprimir = $('#cod_estado_tercero_imprimir').val();
var cod_estado_tercero_exportar = $('#cod_estado_tercero_exportar').val();
var cod_estado_cita = $('#cod_estado_cita').val();
var cod_estado_cita_registrar = $('#cod_estado_cita_registrar').val();
var cod_estado_cita_editar = $('#cod_estado_cita_editar').val();
var cod_estado_cita_eliminar = $('#cod_estado_cita_eliminar').val();
var cod_estado_cita_imprimir = $('#cod_estado_cita_imprimir').val();
var cod_estado_cita_exportar = $('#cod_estado_cita_exportar').val();
var cod_estado_cuenta = $('#cod_estado_cuenta').val();
var cod_estado_cuenta_cobrar = $('#cod_estado_cuenta_cobrar').val();
var cod_estado_cuenta_cobrar_registrar = $('#cod_estado_cuenta_cobrar_registrar').val();
var cod_estado_cuenta_cobrar_editar = $('#cod_estado_cuenta_cobrar_editar').val();
var cod_estado_cuenta_cobrar_eliminar = $('#cod_estado_cuenta_cobrar_eliminar').val();
var cod_estado_cuenta_cobrar_imprimir = $('#cod_estado_cuenta_cobrar_imprimir').val();
var cod_estado_cuenta_cobrar_exportar = $('#cod_estado_cuenta_cobrar_exportar').val();
var cod_estado_cuenta_pagar = $('#cod_estado_cuenta_pagar').val();
var cod_estado_cuenta_pagar_registrar = $('#cod_estado_cuenta_pagar_registrar').val();
var cod_estado_cuenta_pagar_editar = $('#cod_estado_cuenta_pagar_editar').val();
var cod_estado_cuenta_pagar_eliminar = $('#cod_estado_cuenta_pagar_eliminar').val();
var cod_estado_cuenta_pagar_imprimir = $('#cod_estado_cuenta_pagar_imprimir').val();
var cod_estado_cuenta_pagar_exportar = $('#cod_estado_cuenta_pagar_exportar').val();
var cod_estado_cierre_caja = $('#cod_estado_cierre_caja').val();
var cod_estado_cierre_caja_registrar = $('#cod_estado_cierre_caja_registrar').val();
var cod_estado_cierre_caja_editar = $('#cod_estado_cierre_caja_editar').val();
var cod_estado_cierre_caja_eliminar = $('#cod_estado_cierre_caja_eliminar').val();
var cod_estado_cierre_caja_imprimir = $('#cod_estado_cierre_caja_imprimir').val();
var cod_estado_cierre_caja_exportar = $('#cod_estado_cierre_caja_exportar').val();
var cod_estado_egreso = $('#cod_estado_egreso').val();
var cod_estado_egreso_registrar = $('#cod_estado_egreso_registrar').val();
var cod_estado_egreso_editar = $('#cod_estado_egreso_editar').val();
var cod_estado_egreso_eliminar = $('#cod_estado_egreso_eliminar').val();
var cod_estado_egreso_imprimir = $('#cod_estado_egreso_imprimir').val();
var cod_estado_egreso_exportar = $('#cod_estado_egreso_exportar').val();
var cod_estado_sticker_barra = $('#cod_estado_sticker_barra').val();
var cod_estado_sticker_barra_registrar = $('#cod_estado_sticker_barra_registrar').val();
var cod_estado_sticker_barra_editar = $('#cod_estado_sticker_barra_editar').val();
var cod_estado_sticker_barra_eliminar = $('#cod_estado_sticker_barra_eliminar').val();
var cod_estado_sticker_barra_imprimir = $('#cod_estado_sticker_barra_imprimir').val();
var cod_estado_sticker_barra_exportar = $('#cod_estado_sticker_barra_exportar').val();
var cod_estado_sticker_barra_observacion = $('#cod_estado_sticker_barra_observacion').val();
var cod_estado_sticker_barra_archivo_plano = $('#cod_estado_sticker_barra_archivo_plano').val();
var cod_estado_reporte = $('#cod_estado_reporte').val();
var cod_estado_reporte_venta = $('#cod_estado_reporte_venta').val();
var cod_estado_reporte_venta_registrar = $('#cod_estado_reporte_venta_registrar').val();
var cod_estado_reporte_venta_editar = $('#cod_estado_reporte_venta_editar').val();
var cod_estado_reporte_venta_eliminar = $('#cod_estado_reporte_venta_eliminar').val();
var cod_estado_reporte_venta_imprimir = $('#cod_estado_reporte_venta_imprimir').val();
var cod_estado_reporte_venta_exportar = $('#cod_estado_reporte_venta_exportar').val();
var cod_estado_reporte_compra = $('#cod_estado_reporte_compra').val();
var cod_estado_reporte_compra_registrar = $('#cod_estado_reporte_compra_registrar').val();
var cod_estado_reporte_compra_editar = $('#cod_estado_reporte_compra_editar').val();
var cod_estado_reporte_compra_eliminar = $('#cod_estado_reporte_compra_eliminar').val();
var cod_estado_reporte_compra_imprimir = $('#cod_estado_reporte_compra_imprimir').val();
var cod_estado_reporte_compra_exportar = $('#cod_estado_reporte_compra_exportar').val();
var cod_estado_reporte_general = $('#cod_estado_reporte_general').val();
var cod_estado_reporte_general_registrar = $('#cod_estado_reporte_general_registrar').val();
var cod_estado_reporte_general_editar = $('#cod_estado_reporte_general_editar').val();
var cod_estado_reporte_general_eliminar = $('#cod_estado_reporte_general_eliminar').val();
var cod_estado_reporte_general_imprimir = $('#cod_estado_reporte_general_imprimir').val();
var cod_estado_reporte_general_exportar = $('#cod_estado_reporte_general_exportar').val();
var cod_estado_reporte_mov_contable = $('#cod_estado_reporte_mov_contable').val();
var cod_estado_reporte_mov_contable_registrar = $('#cod_estado_reporte_mov_contable_registrar').val();
var cod_estado_reporte_mov_contable_editar = $('#cod_estado_reporte_mov_contable_editar').val();
var cod_estado_reporte_mov_contable_eliminar = $('#cod_estado_reporte_mov_contable_eliminar').val();
var cod_estado_reporte_mov_contable_imprimir = $('#cod_estado_reporte_mov_contable_imprimir').val();
var cod_estado_reporte_mov_contable_exportar = $('#cod_estado_reporte_mov_contable_exportar').val();
var cod_estado_reporte_venta_por_producto = $('#cod_estado_reporte_venta_por_producto').val();
var cod_estado_reporte_venta_por_producto_registrar = $('#cod_estado_reporte_venta_por_producto_registrar').val();
var cod_estado_reporte_venta_por_producto_editar = $('#cod_estado_reporte_venta_por_producto_editar').val();
var cod_estado_reporte_venta_por_producto_eliminar = $('#cod_estado_reporte_venta_por_producto_eliminar').val();
var cod_estado_reporte_venta_por_producto_imprimir = $('#cod_estado_reporte_venta_por_producto_imprimir').val();
var cod_estado_reporte_venta_por_producto_exportar = $('#cod_estado_reporte_venta_por_producto_exportar').val();
var cod_estado_reporte_inventario = $('#cod_estado_reporte_inventario').val();
var cod_estado_reporte_inventario_registrar = $('#cod_estado_reporte_inventario_registrar').val();
var cod_estado_reporte_inventario_editar = $('#cod_estado_reporte_inventario_editar').val();
var cod_estado_reporte_inventario_eliminar = $('#cod_estado_reporte_inventario_eliminar').val();
var cod_estado_reporte_inventario_imprimir = $('#cod_estado_reporte_inventario_imprimir').val();
var cod_estado_reporte_inventario_exportar = $('#cod_estado_reporte_inventario_exportar').val();
var cod_estado_reporte_prodcuto_vencer = $('#cod_estado_reporte_prodcuto_vencer').val();
var cod_estado_reporte_prodcuto_vencer_registrar = $('#cod_estado_reporte_prodcuto_vencer_registrar').val();
var cod_estado_reporte_prodcuto_vencer_editar = $('#cod_estado_reporte_prodcuto_vencer_editar').val();
var cod_estado_reporte_prodcuto_vencer_eliminar = $('#cod_estado_reporte_prodcuto_vencer_eliminar').val();
var cod_estado_reporte_prodcuto_vencer_imprimir = $('#cod_estado_reporte_prodcuto_vencer_imprimir').val();
var cod_estado_reporte_prodcuto_vencer_exportar = $('#cod_estado_reporte_prodcuto_vencer_exportar').val();
var cod_estado_reporte_prodcuto_mantenimiento = $('#cod_estado_reporte_prodcuto_mantenimiento').val();
var cod_estado_reporte_prodcuto_mantenimiento_registrar = $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').val();
var cod_estado_reporte_prodcuto_mantenimiento_editar = $('#cod_estado_reporte_prodcuto_mantenimiento_editar').val();
var cod_estado_reporte_prodcuto_mantenimiento_eliminar = $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').val();
var cod_estado_reporte_prodcuto_mantenimiento_imprimir = $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').val();
var cod_estado_reporte_prodcuto_mantenimiento_exportar = $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').val();
var cod_estado_reporte_cumplanos_tercero = $('#cod_estado_reporte_cumplanos_tercero').val();
var cod_estado_reporte_cumplanos_tercero_registrar = $('#cod_estado_reporte_cumplanos_tercero_registrar').val();
var cod_estado_reporte_cumplanos_tercero_editar = $('#cod_estado_reporte_cumplanos_tercero_editar').val();
var cod_estado_reporte_cumplanos_tercero_eliminar = $('#cod_estado_reporte_cumplanos_tercero_eliminar').val();
var cod_estado_reporte_cumplanos_tercero_imprimir = $('#cod_estado_reporte_cumplanos_tercero_imprimir').val();
var cod_estado_reporte_cumplanos_tercero_exportar = $('#cod_estado_reporte_cumplanos_tercero_exportar').val();
var cod_estado_admin = $('#cod_estado_admin').val();
var cod_estado_info_empresa = $('#cod_estado_info_empresa').val();
var cod_estado_info_empresa_registrar = $('#cod_estado_info_empresa_registrar').val();
var cod_estado_info_empresa_editar = $('#cod_estado_info_empresa_editar').val();
var cod_estado_info_empresa_eliminar = $('#cod_estado_info_empresa_eliminar').val();
var cod_estado_info_empresa_imprimir = $('#cod_estado_info_empresa_imprimir').val();
var cod_estado_info_empresa_exportar = $('#cod_estado_info_empresa_exportar').val();
var cod_estado_usuario = $('#cod_estado_usuario').val();
var cod_estado_usuario_registrar = $('#cod_estado_usuario_registrar').val();
var cod_estado_usuario_editar = $('#cod_estado_usuario_editar').val();
var cod_estado_usuario_eliminar = $('#cod_estado_usuario_eliminar').val();
var cod_estado_usuario_imprimir = $('#cod_estado_usuario_imprimir').val();
var cod_estado_usuario_exportar = $('#cod_estado_usuario_exportar').val();
var cod_estado_dependencia = $('#cod_estado_dependencia').val();
var cod_estado_dependencia_registrar = $('#cod_estado_dependencia_registrar').val();
var cod_estado_dependencia_editar = $('#cod_estado_dependencia_editar').val();
var cod_estado_dependencia_eliminar = $('#cod_estado_dependencia_eliminar').val();
var cod_estado_dependencia_imprimir = $('#cod_estado_dependencia_imprimir').val();
var cod_estado_dependencia_exportar = $('#cod_estado_dependencia_exportar').val();
var cod_estado_resol_facturacion = $('#cod_estado_resol_facturacion').val();
var cod_estado_resol_facturacion_registrar = $('#cod_estado_resol_facturacion_registrar').val();
var cod_estado_resol_facturacion_editar = $('#cod_estado_resol_facturacion_editar').val();
var cod_estado_resol_facturacion_eliminar = $('#cod_estado_resol_facturacion_eliminar').val();
var cod_estado_resol_facturacion_imprimir = $('#cod_estado_resol_facturacion_imprimir').val();
var cod_estado_resol_facturacion_exportar = $('#cod_estado_resol_facturacion_exportar').val();
var cod_estado_numero_letras = $('#cod_estado_numero_letras').val();
var cod_estado_numero_letras_registrar = $('#cod_estado_numero_letras_registrar').val();
var cod_estado_numero_letras_editar = $('#cod_estado_numero_letras_editar').val();
var cod_estado_numero_letras_eliminar = $('#cod_estado_numero_letras_eliminar').val();
var cod_estado_numero_letras_imprimir = $('#cod_estado_numero_letras_imprimir').val();
var cod_estado_numero_letras_exportar = $('#cod_estado_numero_letras_exportar').val();
var cod_estado_eliminar = $('#cod_estado_eliminar').val();
var cod_estado_eliminar_usuario = $('#cod_estado_eliminar_usuario').val();
var cod_estado_eliminar_tercero = $('#cod_estado_eliminar_tercero').val();
var cod_estado_eliminar_producto = $('#cod_estado_eliminar_producto').val();
var cod_estado_licencia = $('#cod_estado_licencia').val();
var cod_estado_licencia_registrar = $('#cod_estado_licencia_registrar').val();
var cod_estado_licencia_editar = $('#cod_estado_licencia_editar').val();
var cod_estado_licencia_imprimir = $('#cod_estado_licencia_imprimir').val();
var cod_estado_licencia_exportar = $('#cod_estado_licencia_exportar').val();
var cod_estado_repositorio = $('#cod_estado_repositorio').val();
var cod_estado_repositorio_registrar = $('#cod_estado_repositorio_registrar').val();
var cod_estado_repositorio_editar = $('#cod_estado_repositorio_editar').val();
var cod_estado_repositorio_eliminar = $('#cod_estado_repositorio_eliminar').val();
var cod_estado_repositorio_imprimir = $('#cod_estado_repositorio_imprimir').val();
var cod_estado_repositorio_exportar = $('#cod_estado_repositorio_exportar').val();
var cod_estado_prod_subproducto_editar = $('#cod_estado_prod_subproducto_editar').val();
var cod_estado_prod_subproducto_eliminar = $('#cod_estado_prod_subproducto_eliminar').val();
var cod_estado_prod_subproducto_imprimir = $('#cod_estado_prod_subproducto_imprimir').val();
var cod_estado_prod_subproducto_exportar = $('#cod_estado_prod_subproducto_exportar').val();
var cod_estado_prod_transferencia_registrar = $('#cod_estado_prod_transferencia_registrar').val();
var cod_estado_prod_transferencia_editar = $('#cod_estado_prod_transferencia_editar').val();
var cod_estado_prod_transferencia_eliminar = $('#cod_estado_prod_transferencia_eliminar').val();
var cod_estado_prod_transferencia_imprimir = $('#cod_estado_prod_transferencia_imprimir').val();
var cod_estado_prod_transferencia_exportar = $('#cod_estado_prod_transferencia_exportar').val();
var cod_estado_prod_auditoria_registrar = $('#cod_estado_prod_auditoria_registrar').val();
var cod_estado_prod_auditoria_editar = $('#cod_estado_prod_auditoria_editar').val();
var cod_estado_prod_auditoria_eliminar = $('#cod_estado_prod_auditoria_eliminar').val();
var cod_estado_prod_auditoria_imprimir = $('#cod_estado_prod_auditoria_imprimir').val();
var cod_estado_prod_auditoria_exportar = $('#cod_estado_prod_auditoria_exportar').val();
var cod_estado_eliminar_caja_mesa_virtual = $('#cod_estado_eliminar_caja_mesa_virtual').val();
var cod_estado_precio_compra_mod_venta = $('#cod_estado_precio_compra_mod_venta').val();
var cod_estado_deshabilitar_opc_eliminar_ventatemp = $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').val();
var cod_estado_habilitar_btn_facturar_mod_venta = $('#cod_estado_habilitar_btn_facturar_mod_venta').val();
var cod_estado_seguridad = $('#cod_estado_seguridad').val();
var cod_estado_seguridad_registrar = $('#cod_estado_seguridad_registrar').val();
var cod_estado_seguridad_editar = $('#cod_estado_seguridad_editar').val();
var cod_estado_seguridad_eliminar = $('#cod_estado_seguridad_eliminar').val();
var cod_estado_seguridad_imprimir = $('#cod_estado_seguridad_imprimir').val();
var cod_estado_seguridad_exportar = $('#cod_estado_seguridad_exportar').val();
var cod_estado_grafico_estadistico = $('#cod_estado_grafico_estadistico').val();
var cod_estado_grafico_estadistico_registrar = $('#cod_estado_grafico_estadistico_registrar').val();
var cod_estado_grafico_estadistico_editar = $('#cod_estado_grafico_estadistico_editar').val();
var cod_estado_grafico_estadistico_eliminar = $('#cod_estado_grafico_estadistico_eliminar').val();
var cod_estado_grafico_estadistico_imprimir = $('#cod_estado_grafico_estadistico_imprimir').val();
var cod_estado_grafico_estadistico_exportar = $('#cod_estado_grafico_estadistico_exportar').val();
var cod_estado_nota_observacion = $('#cod_estado_nota_observacion').val();
var cod_estado_nota_observacion_eliminar = $('#cod_estado_nota_observacion_eliminar').val();
var cod_estado_nota_observacion_registrar = $('#cod_estado_nota_observacion_registrar').val();
var cod_estado_nota_observacion_editar = $('#cod_estado_nota_observacion_editar').val();
var cod_estado_nota_observacion_imprimir = $('#cod_estado_nota_observacion_imprimir').val();
var cod_estado_nota_observacion_exportar = $('#cod_estado_nota_observacion_exportar').val();
var cod_estado_tipo_roles = $('#cod_estado_tipo_roles').val();
var cod_estado_tipo_roles_registrar = $('#cod_estado_tipo_roles_registrar').val();
var cod_estado_tipo_roles_editar = $('#cod_estado_tipo_roles_editar').val();
var cod_estado_tipo_roles_eliminar = $('#cod_estado_tipo_roles_eliminar').val();
var cod_estado_tipo_roles_imprimir = $('#cod_estado_tipo_roles_imprimir').val();
var cod_estado_tipo_roles_exportar = $('#cod_estado_tipo_roles_exportar').val();
var cod_estado_agregar_productos_a_venta_facturada = $('#cod_estado_agregar_productos_a_venta_facturada').val();
var cod_estado_eliminar_productos_a_venta_facturada = $('#cod_estado_eliminar_productos_a_venta_facturada').val();
var cod_estado_habilitar_total_venta_ventatemp = $('#cod_estado_habilitar_total_venta_ventatemp').val();
var cod_estado_habilitar_total_venta_caja_mesa_virtual = $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').val();
var cod_estado_habilitar_caja_mesa_virtual_en_uso = $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').val();
var cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso = $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').val();
var cod_estado_prod_inventario_producto_masivo = $('#cod_estado_prod_inventario_producto_masivo').val();
var cod_estado_prod_transferencia_extern = $('#cod_estado_prod_transferencia_extern').val();
var cod_estado_prod_transferencia_extern_registrar = $('#cod_estado_prod_transferencia_extern_registrar').val();
var cod_estado_prod_transferencia_extern_editar = $('#cod_estado_prod_transferencia_extern_editar').val();
var cod_estado_prod_transferencia_extern_eliminar = $('#cod_estado_prod_transferencia_extern_eliminar').val();
var cod_estado_prod_transferencia_extern_imprimir = $('#cod_estado_prod_transferencia_extern_imprimir').val();
var cod_estado_prod_transferencia_extern_exportar = $('#cod_estado_prod_transferencia_extern_exportar').val();
var cod_estado_categoria = $('#cod_estado_categoria').val();
var cod_estado_categoria_registrar = $('#cod_estado_categoria_registrar').val();
var cod_estado_categoria_editar = $('#cod_estado_categoria_editar').val();
var cod_estado_categoria_eliminar = $('#cod_estado_categoria_eliminar').val();
var cod_estado_categoria_imprimir = $('#cod_estado_categoria_imprimir').val();
var cod_estado_categoria_exportar = $('#cod_estado_categoria_exportar').val();
var cod_estado_caja_mesa = $('#cod_estado_caja_mesa').val();
var cod_estado_caja_mesa_registrar = $('#cod_estado_caja_mesa_registrar').val();
var cod_estado_caja_mesa_editar = $('#cod_estado_caja_mesa_editar').val();
var cod_estado_caja_mesa_eliminar = $('#cod_estado_caja_mesa_eliminar').val();
var cod_estado_caja_mesa_imprimir = $('#cod_estado_caja_mesa_imprimir').val();
var cod_estado_caja_mesa_exportar = $('#cod_estado_caja_mesa_exportar').val();
var cod_estado_usuario_cambiar_contrasena = $('#cod_estado_usuario_cambiar_contrasena').val();
var cod_estado_usuario_cambiar_firma = $('#cod_estado_usuario_cambiar_firma').val();
var cod_estado_usuario_permisos_personalizados = $('#cod_estado_usuario_permisos_personalizados').val();
var cod_estado_usuario_permisos_asignar_matriz = $('#cod_estado_usuario_permisos_asignar_matriz').val();
var cod_estado_usuario_cambiar_tipo_rol = $('#cod_estado_usuario_cambiar_tipo_rol').val();
var cod_estado_facturacion_venta_dependencia_user = $('#cod_estado_facturacion_venta_dependencia_user').val();
var cod_estado_facturacion_venta_precio_venta_predet_user = $('#cod_estado_facturacion_venta_precio_venta_predet_user').val();
var cod_estado_facturacion_venta_acceso_facturas_otros_user = $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').val();
var cod_estado_grafico_venta = $('#cod_estado_grafico_venta').val();
var cod_estado_grafico_compra = $('#cod_estado_grafico_compra').val();
var cod_estado_grafico_venta_compra = $('#cod_estado_grafico_venta_compra').val();
var cod_estado_grafico_venta_egreso = $('#cod_estado_grafico_venta_egreso').val();
var cod_estado_grafico_venta_tipo_pago = $('#cod_estado_grafico_venta_tipo_pago').val();
var cod_estado_grafico_venta_tipo_forma_pago = $('#cod_estado_grafico_venta_tipo_forma_pago').val();
var cod_estado_grafico_venta_tipo_factura = $('#cod_estado_grafico_venta_tipo_factura').val();
var cod_estado_grafico_venta_categoria = $('#cod_estado_grafico_venta_categoria').val();
var cod_estado_grafico_venta_dependencia = $('#cod_estado_grafico_venta_dependencia').val();
var cod_estado_grafico_venta_tipo_compra = $('#cod_estado_grafico_venta_tipo_compra').val();
var cod_estado_grafico_venta_tipo_metodo_envio = $('#cod_estado_grafico_venta_tipo_metodo_envio').val();
var cod_estado_grafico_venta_tipo_aplicacion = $('#cod_estado_grafico_venta_tipo_aplicacion').val();
var cod_estado_grafico_venta_producto = $('#cod_estado_grafico_venta_producto').val();
var cod_estado_grafico_venta_tercero = $('#cod_estado_grafico_venta_tercero').val();
var cod_estado_grafico_venta_tercero_producto = $('#cod_estado_grafico_venta_tercero_producto').val();
var cod_estado_grafico_venta_tercero_domicilio = $('#cod_estado_grafico_venta_tercero_domicilio').val();
var cod_estado_grafico_producto_mas_vendido_und_venta = $('#cod_estado_grafico_producto_mas_vendido_und_venta').val();
var cod_estado_grafico_producto_mas_vendido_precio_venta = $('#cod_estado_grafico_producto_mas_vendido_precio_venta').val();
var cod_estado_grafico_producto_menos_vendido_und_venta = $('#cod_estado_grafico_producto_menos_vendido_und_venta').val();
var cod_estado_grafico_producto_menos_vendido_precio_venta = $('#cod_estado_grafico_producto_menos_vendido_precio_venta').val();
var cod_estado_grafico_compra_precio_compra_precio_venta = $('#cod_estado_grafico_compra_precio_compra_precio_venta').val();
var cod_estado_grafico_ganancia_venta_egreso = $('#cod_estado_grafico_ganancia_venta_egreso').val();
var cod_estado_grafico_ganancia_venta = $('#cod_estado_grafico_ganancia_venta').val();
var cod_estado_grafico_venta_por_vendedor = $('#cod_estado_grafico_venta_por_vendedor').val();
var cod_estado_grafico_extras = $('#cod_estado_grafico_extras').val();
var cod_estado_deshabilitar_und_venta_ventatemp = $('#cod_estado_deshabilitar_und_venta_ventatemp').val();
var cod_estado_deshabilitar_und_venta_atendido_cocina_chef = $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').val();
var cod_estado_reporte_venta_total_ganancia = $('#cod_estado_reporte_venta_total_ganancia').val();
var cod_estado_reporte_venta_total_utilidad = $('#cod_estado_reporte_venta_total_utilidad').val();
var cod_estado_reporte_venta_total_comision = $('#cod_estado_reporte_venta_total_comision').val();
var cod_estado_reporte_venta_total_propina = $('#cod_estado_reporte_venta_total_propina').val();


if (cod_estado_prod=='1') { $('#cod_estado_prod').val('1'); $('#cod_estado_prod').prop('checked',true); } else { $('#cod_estado_prod').val('0'); $('#cod_estado_prod').prop('checked',false); } 
if (cod_estado_prod_reg_producto=='1') { $('#cod_estado_prod_reg_producto').val('1'); $('#cod_estado_prod_reg_producto').prop('checked',true); } else { $('#cod_estado_prod_reg_producto').val('0'); $('#cod_estado_prod_reg_producto').prop('checked',false); } 
if (cod_estado_prod_subproducto_registrar=='1') { $('#cod_estado_prod_subproducto_registrar').val('1'); $('#cod_estado_prod_subproducto_registrar').prop('checked',true); } else { $('#cod_estado_prod_subproducto_registrar').val('0'); $('#cod_estado_prod_subproducto_registrar').prop('checked',false); } 
if (cod_estado_prod_cargar_factura_compra=='1') { $('#cod_estado_prod_cargar_factura_compra').val('1'); $('#cod_estado_prod_cargar_factura_compra').prop('checked',true); } else { $('#cod_estado_prod_cargar_factura_compra').val('0'); $('#cod_estado_prod_cargar_factura_compra').prop('checked',false); } 
if (cod_estado_prod_cargar_factura_compra_soporte=='1') { $('#cod_estado_prod_cargar_factura_compra_soporte').val('1'); $('#cod_estado_prod_cargar_factura_compra_soporte').prop('checked',true); } else { $('#cod_estado_prod_cargar_factura_compra_soporte').val('0'); $('#cod_estado_prod_cargar_factura_compra_soporte').prop('checked',false); } 
if (cod_estado_prod_cargar_factura_compra_observacion=='1') { $('#cod_estado_prod_cargar_factura_compra_observacion').val('1'); $('#cod_estado_prod_cargar_factura_compra_observacion').prop('checked',true); } else { $('#cod_estado_prod_cargar_factura_compra_observacion').val('0'); $('#cod_estado_prod_cargar_factura_compra_observacion').prop('checked',false); } 
if (cod_estado_prod_transferencia=='1') { $('#cod_estado_prod_transferencia').val('1'); $('#cod_estado_prod_transferencia').prop('checked',true); } else { $('#cod_estado_prod_transferencia').val('0'); $('#cod_estado_prod_transferencia').prop('checked',false); } 
if (cod_estado_prod_auditoria=='1') { $('#cod_estado_prod_auditoria').val('1'); $('#cod_estado_prod_auditoria').prop('checked',true); } else { $('#cod_estado_prod_auditoria').val('0'); $('#cod_estado_prod_auditoria').prop('checked',false); } 
if (cod_estado_prod_nuevo_invenario=='1') { $('#cod_estado_prod_nuevo_invenario').val('1'); $('#cod_estado_prod_nuevo_invenario').prop('checked',true); } else { $('#cod_estado_prod_nuevo_invenario').val('0'); $('#cod_estado_prod_nuevo_invenario').prop('checked',false); } 
if (cod_estado_prod_inventario_producto=='1') { $('#cod_estado_prod_inventario_producto').val('1'); $('#cod_estado_prod_inventario_producto').prop('checked',true); } else { $('#cod_estado_prod_inventario_producto').val('0'); $('#cod_estado_prod_inventario_producto').prop('checked',false); } 
if (cod_estado_prod_registrar=='1') { $('#cod_estado_prod_registrar').val('1'); $('#cod_estado_prod_registrar').prop('checked',true); } else { $('#cod_estado_prod_registrar').val('0'); $('#cod_estado_prod_registrar').prop('checked',false); } 
if (cod_estado_prod_editar=='1') { $('#cod_estado_prod_editar').val('1'); $('#cod_estado_prod_editar').prop('checked',true); } else { $('#cod_estado_prod_editar').val('0'); $('#cod_estado_prod_editar').prop('checked',false); } 
if (cod_estado_prod_eliminar=='1') { $('#cod_estado_prod_eliminar').val('1'); $('#cod_estado_prod_eliminar').prop('checked',true); } else { $('#cod_estado_prod_eliminar').val('0'); $('#cod_estado_prod_eliminar').prop('checked',false); } 
if (cod_estado_prod_imprimir=='1') { $('#cod_estado_prod_imprimir').val('1'); $('#cod_estado_prod_imprimir').prop('checked',true); } else { $('#cod_estado_prod_imprimir').val('0'); $('#cod_estado_prod_imprimir').prop('checked',false); } 
if (cod_estado_prod_exportar=='1') { $('#cod_estado_prod_exportar').val('1'); $('#cod_estado_prod_exportar').prop('checked',true); } else { $('#cod_estado_prod_exportar').val('0'); $('#cod_estado_prod_exportar').prop('checked',false); } 
if (cod_estado_prod_subproducto=='1') { $('#cod_estado_prod_subproducto').val('1'); $('#cod_estado_prod_subproducto').prop('checked',true); } else { $('#cod_estado_prod_subproducto').val('0'); $('#cod_estado_prod_subproducto').prop('checked',false); } 
if (cod_estado_prod_und_producto=='1') { $('#cod_estado_prod_und_producto').val('1'); $('#cod_estado_prod_und_producto').prop('checked',true); } else { $('#cod_estado_prod_und_producto').val('0'); $('#cod_estado_prod_und_producto').prop('checked',false); } 
if (cod_estado_prod_und_producto_bodega=='1') { $('#cod_estado_prod_und_producto_bodega').val('1'); $('#cod_estado_prod_und_producto_bodega').prop('checked',true); } else { $('#cod_estado_prod_und_producto_bodega').val('0'); $('#cod_estado_prod_und_producto_bodega').prop('checked',false); } 
if (cod_estado_prod_precio_compra_producto=='1') { $('#cod_estado_prod_precio_compra_producto').val('1'); $('#cod_estado_prod_precio_compra_producto').prop('checked',true); } else { $('#cod_estado_prod_precio_compra_producto').val('0'); $('#cod_estado_prod_precio_compra_producto').prop('checked',false); } 
if (cod_estado_prod_precio_costo_producto=='1') { $('#cod_estado_prod_precio_costo_producto').val('1'); $('#cod_estado_prod_precio_costo_producto').prop('checked',true); } else { $('#cod_estado_prod_precio_costo_producto').val('0'); $('#cod_estado_prod_precio_costo_producto').prop('checked',false); } 
if (cod_estado_prod_precio_venta_producto=='1') { $('#cod_estado_prod_precio_venta_producto').val('1'); $('#cod_estado_prod_precio_venta_producto').prop('checked',true); } else { $('#cod_estado_prod_precio_venta_producto').val('0'); $('#cod_estado_prod_precio_venta_producto').prop('checked',false); } 
if (cod_estado_prod_precio_venta_producto2=='1') { $('#cod_estado_prod_precio_venta_producto2').val('1'); $('#cod_estado_prod_precio_venta_producto2').prop('checked',true); } else { $('#cod_estado_prod_precio_venta_producto2').val('0'); $('#cod_estado_prod_precio_venta_producto2').prop('checked',false); } 
if (cod_estado_prod_precio_venta_producto3=='1') { $('#cod_estado_prod_precio_venta_producto3').val('1'); $('#cod_estado_prod_precio_venta_producto3').prop('checked',true); } else { $('#cod_estado_prod_precio_venta_producto3').val('0'); $('#cod_estado_prod_precio_venta_producto3').prop('checked',false); } 
if (cod_estado_prod_precio_venta_producto4=='1') { $('#cod_estado_prod_precio_venta_producto4').val('1'); $('#cod_estado_prod_precio_venta_producto4').prop('checked',true); } else { $('#cod_estado_prod_precio_venta_producto4').val('0'); $('#cod_estado_prod_precio_venta_producto4').prop('checked',false); } 
if (cod_estado_prod_precio_venta_producto5=='1') { $('#cod_estado_prod_precio_venta_producto5').val('1'); $('#cod_estado_prod_precio_venta_producto5').prop('checked',true); } else { $('#cod_estado_prod_precio_venta_producto5').val('0'); $('#cod_estado_prod_precio_venta_producto5').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_unidad_medida=='1') { $('#cod_estado_prod_nombre_tipo_unidad_medida').val('1'); $('#cod_estado_prod_nombre_tipo_unidad_medida').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_unidad_medida').val('0'); $('#cod_estado_prod_nombre_tipo_unidad_medida').prop('checked',false); } 
if (cod_estado_prod_iva_ptj=='1') { $('#cod_estado_prod_iva_ptj').val('1'); $('#cod_estado_prod_iva_ptj').prop('checked',true); } else { $('#cod_estado_prod_iva_ptj').val('0'); $('#cod_estado_prod_iva_ptj').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_producto=='1') { $('#cod_estado_prod_nombre_tipo_producto').val('1'); $('#cod_estado_prod_nombre_tipo_producto').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_producto').val('0'); $('#cod_estado_prod_nombre_tipo_producto').prop('checked',false); } 
if (cod_estado_prod_cod_marca=='1') { $('#cod_estado_prod_cod_marca').val('1'); $('#cod_estado_prod_cod_marca').prop('checked',true); } else { $('#cod_estado_prod_cod_marca').val('0'); $('#cod_estado_prod_cod_marca').prop('checked',false); } 
if (cod_estado_prod_cod_proveedor=='1') { $('#cod_estado_prod_cod_proveedor').val('1'); $('#cod_estado_prod_cod_proveedor').prop('checked',true); } else { $('#cod_estado_prod_cod_proveedor').val('0'); $('#cod_estado_prod_cod_proveedor').prop('checked',false); } 
if (cod_estado_prod_cod_tercero=='1') { $('#cod_estado_prod_cod_tercero').val('1'); $('#cod_estado_prod_cod_tercero').prop('checked',true); } else { $('#cod_estado_prod_cod_tercero').val('0'); $('#cod_estado_prod_cod_tercero').prop('checked',false); } 
if (cod_estado_prod_cod_estado=='1') { $('#cod_estado_prod_cod_estado').val('1'); $('#cod_estado_prod_cod_estado').prop('checked',true); } else { $('#cod_estado_prod_cod_estado').val('0'); $('#cod_estado_prod_cod_estado').prop('checked',false); } 
if (cod_estado_prod_cod_dependencia=='1') { $('#cod_estado_prod_cod_dependencia').val('1'); $('#cod_estado_prod_cod_dependencia').prop('checked',true); } else { $('#cod_estado_prod_cod_dependencia').val('0'); $('#cod_estado_prod_cod_dependencia').prop('checked',false); } 
if (cod_estado_prod_fecha_ult_compra=='1') { $('#cod_estado_prod_fecha_ult_compra').val('1'); $('#cod_estado_prod_fecha_ult_compra').prop('checked',true); } else { $('#cod_estado_prod_fecha_ult_compra').val('0'); $('#cod_estado_prod_fecha_ult_compra').prop('checked',false); } 
if (cod_estado_prod_fecha_ult_venta=='1') { $('#cod_estado_prod_fecha_ult_venta').val('1'); $('#cod_estado_prod_fecha_ult_venta').prop('checked',true); } else { $('#cod_estado_prod_fecha_ult_venta').val('0'); $('#cod_estado_prod_fecha_ult_venta').prop('checked',false); } 
if (cod_estado_prod_fecha_vencimiento=='1') { $('#cod_estado_prod_fecha_vencimiento').val('1'); $('#cod_estado_prod_fecha_vencimiento').prop('checked',true); } else { $('#cod_estado_prod_fecha_vencimiento').val('0'); $('#cod_estado_prod_fecha_vencimiento').prop('checked',false); } 
if (cod_estado_prod_tope_min=='1') { $('#cod_estado_prod_tope_min').val('1'); $('#cod_estado_prod_tope_min').prop('checked',true); } else { $('#cod_estado_prod_tope_min').val('0'); $('#cod_estado_prod_tope_min').prop('checked',false); } 
if (cod_estado_prod_fecha_creacion=='1') { $('#cod_estado_prod_fecha_creacion').val('1'); $('#cod_estado_prod_fecha_creacion').prop('checked',true); } else { $('#cod_estado_prod_fecha_creacion').val('0'); $('#cod_estado_prod_fecha_creacion').prop('checked',false); } 
if (cod_estado_prod_fecha_modificacion=='1') { $('#cod_estado_prod_fecha_modificacion').val('1'); $('#cod_estado_prod_fecha_modificacion').prop('checked',true); } else { $('#cod_estado_prod_fecha_modificacion').val('0'); $('#cod_estado_prod_fecha_modificacion').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_precio_venta=='1') { $('#cod_estado_prod_nombre_tipo_precio_venta').val('1'); $('#cod_estado_prod_nombre_tipo_precio_venta').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_precio_venta').val('0'); $('#cod_estado_prod_nombre_tipo_precio_venta').prop('checked',false); } 
if (cod_estado_prod_url_img_orig_producto=='1') { $('#cod_estado_prod_url_img_orig_producto').val('1'); $('#cod_estado_prod_url_img_orig_producto').prop('checked',true); } else { $('#cod_estado_prod_url_img_orig_producto').val('0'); $('#cod_estado_prod_url_img_orig_producto').prop('checked',false); } 
if (cod_estado_prod_url_img_min_producto=='1') { $('#cod_estado_prod_url_img_min_producto').val('1'); $('#cod_estado_prod_url_img_min_producto').prop('checked',true); } else { $('#cod_estado_prod_url_img_min_producto').val('0'); $('#cod_estado_prod_url_img_min_producto').prop('checked',false); } 
if (cod_estado_prod_comision_ptj=='1') { $('#cod_estado_prod_comision_ptj').val('1'); $('#cod_estado_prod_comision_ptj').prop('checked',true); } else { $('#cod_estado_prod_comision_ptj').val('0'); $('#cod_estado_prod_comision_ptj').prop('checked',false); } 
if (cod_estado_prod_dto1=='1') { $('#cod_estado_prod_dto1').val('1'); $('#cod_estado_prod_dto1').prop('checked',true); } else { $('#cod_estado_prod_dto1').val('0'); $('#cod_estado_prod_dto1').prop('checked',false); } 
if (cod_estado_prod_dto2=='1') { $('#cod_estado_prod_dto2').val('1'); $('#cod_estado_prod_dto2').prop('checked',true); } else { $('#cod_estado_prod_dto2').val('0'); $('#cod_estado_prod_dto2').prop('checked',false); } 
if (cod_estado_prod_ipc_ptj=='1') { $('#cod_estado_prod_ipc_ptj').val('1'); $('#cod_estado_prod_ipc_ptj').prop('checked',true); } else { $('#cod_estado_prod_ipc_ptj').val('0'); $('#cod_estado_prod_ipc_ptj').prop('checked',false); } 
if (cod_estado_prod_precio_ipc=='1') { $('#cod_estado_prod_precio_ipc').val('1'); $('#cod_estado_prod_precio_ipc').prop('checked',true); } else { $('#cod_estado_prod_precio_ipc').val('0'); $('#cod_estado_prod_precio_ipc').prop('checked',false); } 
if (cod_estado_prod_ret_ica_ptj=='1') { $('#cod_estado_prod_ret_ica_ptj').val('1'); $('#cod_estado_prod_ret_ica_ptj').prop('checked',true); } else { $('#cod_estado_prod_ret_ica_ptj').val('0'); $('#cod_estado_prod_ret_ica_ptj').prop('checked',false); } 
if (cod_estado_prod_iva_teorico_ptj=='1') { $('#cod_estado_prod_iva_teorico_ptj').val('1'); $('#cod_estado_prod_iva_teorico_ptj').prop('checked',true); } else { $('#cod_estado_prod_iva_teorico_ptj').val('0'); $('#cod_estado_prod_iva_teorico_ptj').prop('checked',false); } 
if (cod_estado_prod_tarifa_rete_vigente_ptj=='1') { $('#cod_estado_prod_tarifa_rete_vigente_ptj').val('1'); $('#cod_estado_prod_tarifa_rete_vigente_ptj').prop('checked',true); } else { $('#cod_estado_prod_tarifa_rete_vigente_ptj').val('0'); $('#cod_estado_prod_tarifa_rete_vigente_ptj').prop('checked',false); } 
if (cod_estado_prod_rete_iva_asumido_ptj=='1') { $('#cod_estado_prod_rete_iva_asumido_ptj').val('1'); $('#cod_estado_prod_rete_iva_asumido_ptj').prop('checked',true); } else { $('#cod_estado_prod_rete_iva_asumido_ptj').val('0'); $('#cod_estado_prod_rete_iva_asumido_ptj').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_compra=='1') { $('#cod_estado_prod_nombre_tipo_compra').val('1'); $('#cod_estado_prod_nombre_tipo_compra').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_compra').val('0'); $('#cod_estado_prod_nombre_tipo_compra').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_cargue_factura=='1') { $('#cod_estado_prod_nombre_tipo_cargue_factura').val('1'); $('#cod_estado_prod_nombre_tipo_cargue_factura').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_cargue_factura').val('0'); $('#cod_estado_prod_nombre_tipo_cargue_factura').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_medida=='1') { $('#cod_estado_prod_nombre_tipo_medida').val('1'); $('#cod_estado_prod_nombre_tipo_medida').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_medida').val('0'); $('#cod_estado_prod_nombre_tipo_medida').prop('checked',false); } 
if (cod_estado_prod_cajas_sobre=='1') { $('#cod_estado_prod_cajas_sobre').val('1'); $('#cod_estado_prod_cajas_sobre').prop('checked',true); } else { $('#cod_estado_prod_cajas_sobre').val('0'); $('#cod_estado_prod_cajas_sobre').prop('checked',false); } 
if (cod_estado_prod_und_sobre=='1') { $('#cod_estado_prod_und_sobre').val('1'); $('#cod_estado_prod_und_sobre').prop('checked',true); } else { $('#cod_estado_prod_und_sobre').val('0'); $('#cod_estado_prod_und_sobre').prop('checked',false); } 
if (cod_estado_prod_cod_interno=='1') { $('#cod_estado_prod_cod_interno').val('1'); $('#cod_estado_prod_cod_interno').prop('checked',true); } else { $('#cod_estado_prod_cod_interno').val('0'); $('#cod_estado_prod_cod_interno').prop('checked',false); } 
if (cod_estado_prod_cod_original=='1') { $('#cod_estado_prod_cod_original').val('1'); $('#cod_estado_prod_cod_original').prop('checked',true); } else { $('#cod_estado_prod_cod_original').val('0'); $('#cod_estado_prod_cod_original').prop('checked',false); } 
if (cod_estado_prod_codificacion=='1') { $('#cod_estado_prod_codificacion').val('1'); $('#cod_estado_prod_codificacion').prop('checked',true); } else { $('#cod_estado_prod_codificacion').val('0'); $('#cod_estado_prod_codificacion').prop('checked',false); } 
if (cod_estado_prod_cod_producto_serial=='1') { $('#cod_estado_prod_cod_producto_serial').val('1'); $('#cod_estado_prod_cod_producto_serial').prop('checked',true); } else { $('#cod_estado_prod_cod_producto_serial').val('0'); $('#cod_estado_prod_cod_producto_serial').prop('checked',false); } 
if (cod_estado_prod_fecha_mantenimiento=='1') { $('#cod_estado_prod_fecha_mantenimiento').val('1'); $('#cod_estado_prod_fecha_mantenimiento').prop('checked',true); } else { $('#cod_estado_prod_fecha_mantenimiento').val('0'); $('#cod_estado_prod_fecha_mantenimiento').prop('checked',false); } 
if (cod_estado_prod_peso_producto=='1') { $('#cod_estado_prod_peso_producto').val('1'); $('#cod_estado_prod_peso_producto').prop('checked',true); } else { $('#cod_estado_prod_peso_producto').val('0'); $('#cod_estado_prod_peso_producto').prop('checked',false); } 
if (cod_estado_prod_cod_rodeo=='1') { $('#cod_estado_prod_cod_rodeo').val('1'); $('#cod_estado_prod_cod_rodeo').prop('checked',true); } else { $('#cod_estado_prod_cod_rodeo').val('0'); $('#cod_estado_prod_cod_rodeo').prop('checked',false); } 
if (cod_estado_prod_nombre_rodeo=='1') { $('#cod_estado_prod_nombre_rodeo').val('1'); $('#cod_estado_prod_nombre_rodeo').prop('checked',true); } else { $('#cod_estado_prod_nombre_rodeo').val('0'); $('#cod_estado_prod_nombre_rodeo').prop('checked',false); } 
if (cod_estado_prod_nombre_sexo=='1') { $('#cod_estado_prod_nombre_sexo').val('1'); $('#cod_estado_prod_nombre_sexo').prop('checked',true); } else { $('#cod_estado_prod_nombre_sexo').val('0'); $('#cod_estado_prod_nombre_sexo').prop('checked',false); } 
if (cod_estado_prod_de_monta=='1') { $('#cod_estado_prod_de_monta').val('1'); $('#cod_estado_prod_de_monta').prop('checked',true); } else { $('#cod_estado_prod_de_monta').val('0'); $('#cod_estado_prod_de_monta').prop('checked',false); } 
if (cod_estado_prod_nombre_estatus=='1') { $('#cod_estado_prod_nombre_estatus').val('1'); $('#cod_estado_prod_nombre_estatus').prop('checked',true); } else { $('#cod_estado_prod_nombre_estatus').val('0'); $('#cod_estado_prod_nombre_estatus').prop('checked',false); } 
if (cod_estado_prod_nombre_condicion_corporal=='1') { $('#cod_estado_prod_nombre_condicion_corporal').val('1'); $('#cod_estado_prod_nombre_condicion_corporal').prop('checked',true); } else { $('#cod_estado_prod_nombre_condicion_corporal').val('0'); $('#cod_estado_prod_nombre_condicion_corporal').prop('checked',false); } 
if (cod_estado_prod_nombre_categoria_ingreso=='1') { $('#cod_estado_prod_nombre_categoria_ingreso').val('1'); $('#cod_estado_prod_nombre_categoria_ingreso').prop('checked',true); } else { $('#cod_estado_prod_nombre_categoria_ingreso').val('0'); $('#cod_estado_prod_nombre_categoria_ingreso').prop('checked',false); } 
if (cod_estado_prod_nombre_categoria_actual=='1') { $('#cod_estado_prod_nombre_categoria_actual').val('1'); $('#cod_estado_prod_nombre_categoria_actual').prop('checked',true); } else { $('#cod_estado_prod_nombre_categoria_actual').val('0'); $('#cod_estado_prod_nombre_categoria_actual').prop('checked',false); } 
if (cod_estado_prod_nombre_categoria_futura=='1') { $('#cod_estado_prod_nombre_categoria_futura').val('1'); $('#cod_estado_prod_nombre_categoria_futura').prop('checked',true); } else { $('#cod_estado_prod_nombre_categoria_futura').val('0'); $('#cod_estado_prod_nombre_categoria_futura').prop('checked',false); } 
if (cod_estado_prod_nombre_procedencia=='1') { $('#cod_estado_prod_nombre_procedencia').val('1'); $('#cod_estado_prod_nombre_procedencia').prop('checked',true); } else { $('#cod_estado_prod_nombre_procedencia').val('0'); $('#cod_estado_prod_nombre_procedencia').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_monta=='1') { $('#cod_estado_prod_nombre_tipo_monta').val('1'); $('#cod_estado_prod_nombre_tipo_monta').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_monta').val('0'); $('#cod_estado_prod_nombre_tipo_monta').prop('checked',false); } 
if (cod_estado_prod_nombre_lote_categoria=='1') { $('#cod_estado_prod_nombre_lote_categoria').val('1'); $('#cod_estado_prod_nombre_lote_categoria').prop('checked',true); } else { $('#cod_estado_prod_nombre_lote_categoria').val('0'); $('#cod_estado_prod_nombre_lote_categoria').prop('checked',false); } 
if (cod_estado_prod_nombre_prog_reproductivo=='1') { $('#cod_estado_prod_nombre_prog_reproductivo').val('1'); $('#cod_estado_prod_nombre_prog_reproductivo').prop('checked',true); } else { $('#cod_estado_prod_nombre_prog_reproductivo').val('0'); $('#cod_estado_prod_nombre_prog_reproductivo').prop('checked',false); } 
if (cod_estado_prod_nombre_potrero=='1') { $('#cod_estado_prod_nombre_potrero').val('1'); $('#cod_estado_prod_nombre_potrero').prop('checked',true); } else { $('#cod_estado_prod_nombre_potrero').val('0'); $('#cod_estado_prod_nombre_potrero').prop('checked',false); } 
if (cod_estado_prod_nombre_lote=='1') { $('#cod_estado_prod_nombre_lote').val('1'); $('#cod_estado_prod_nombre_lote').prop('checked',true); } else { $('#cod_estado_prod_nombre_lote').val('0'); $('#cod_estado_prod_nombre_lote').prop('checked',false); } 
if (cod_estado_prod_nombre_calidad_animal=='1') { $('#cod_estado_prod_nombre_calidad_animal').val('1'); $('#cod_estado_prod_nombre_calidad_animal').prop('checked',true); } else { $('#cod_estado_prod_nombre_calidad_animal').val('0'); $('#cod_estado_prod_nombre_calidad_animal').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_explotacion=='1') { $('#cod_estado_prod_nombre_tipo_explotacion').val('1'); $('#cod_estado_prod_nombre_tipo_explotacion').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_explotacion').val('0'); $('#cod_estado_prod_nombre_tipo_explotacion').prop('checked',false); } 
if (cod_estado_prod_peso_compra=='1') { $('#cod_estado_prod_peso_compra').val('1'); $('#cod_estado_prod_peso_compra').prop('checked',true); } else { $('#cod_estado_prod_peso_compra').val('0'); $('#cod_estado_prod_peso_compra').prop('checked',false); } 
if (cod_estado_prod_precio_compra=='1') { $('#cod_estado_prod_precio_compra').val('1'); $('#cod_estado_prod_precio_compra').prop('checked',true); } else { $('#cod_estado_prod_precio_compra').val('0'); $('#cod_estado_prod_precio_compra').prop('checked',false); } 
if (cod_estado_prod_fecha_nac=='1') { $('#cod_estado_prod_fecha_nac').val('1'); $('#cod_estado_prod_fecha_nac').prop('checked',true); } else { $('#cod_estado_prod_fecha_nac').val('0'); $('#cod_estado_prod_fecha_nac').prop('checked',false); } 
if (cod_estado_prod_fecha_compra=='1') { $('#cod_estado_prod_fecha_compra').val('1'); $('#cod_estado_prod_fecha_compra').prop('checked',true); } else { $('#cod_estado_prod_fecha_compra').val('0'); $('#cod_estado_prod_fecha_compra').prop('checked',false); } 
if (cod_estado_prod_fecha_castracion=='1') { $('#cod_estado_prod_fecha_castracion').val('1'); $('#cod_estado_prod_fecha_castracion').prop('checked',true); } else { $('#cod_estado_prod_fecha_castracion').val('0'); $('#cod_estado_prod_fecha_castracion').prop('checked',false); } 
if (cod_estado_prod_nro_hierros=='1') { $('#cod_estado_prod_nro_hierros').val('1'); $('#cod_estado_prod_nro_hierros').prop('checked',true); } else { $('#cod_estado_prod_nro_hierros').val('0'); $('#cod_estado_prod_nro_hierros').prop('checked',false); } 
if (cod_estado_prod_hierro_animal=='1') { $('#cod_estado_prod_hierro_animal').val('1'); $('#cod_estado_prod_hierro_animal').prop('checked',true); } else { $('#cod_estado_prod_hierro_animal').val('0'); $('#cod_estado_prod_hierro_animal').prop('checked',false); } 
if (cod_estado_prod_numero_partos=='1') { $('#cod_estado_prod_numero_partos').val('1'); $('#cod_estado_prod_numero_partos').prop('checked',true); } else { $('#cod_estado_prod_numero_partos').val('0'); $('#cod_estado_prod_numero_partos').prop('checked',false); } 
if (cod_estado_prod_id_electronica=='1') { $('#cod_estado_prod_id_electronica').val('1'); $('#cod_estado_prod_id_electronica').prop('checked',true); } else { $('#cod_estado_prod_id_electronica').val('0'); $('#cod_estado_prod_id_electronica').prop('checked',false); } 
if (cod_estado_prod_nombre_raza1=='1') { $('#cod_estado_prod_nombre_raza1').val('1'); $('#cod_estado_prod_nombre_raza1').prop('checked',true); } else { $('#cod_estado_prod_nombre_raza1').val('0'); $('#cod_estado_prod_nombre_raza1').prop('checked',false); } 
if (cod_estado_prod_nombre_raza2=='1') { $('#cod_estado_prod_nombre_raza2').val('1'); $('#cod_estado_prod_nombre_raza2').prop('checked',true); } else { $('#cod_estado_prod_nombre_raza2').val('0'); $('#cod_estado_prod_nombre_raza2').prop('checked',false); } 
if (cod_estado_prod_nombre_raza3=='1') { $('#cod_estado_prod_nombre_raza3').val('1'); $('#cod_estado_prod_nombre_raza3').prop('checked',true); } else { $('#cod_estado_prod_nombre_raza3').val('0'); $('#cod_estado_prod_nombre_raza3').prop('checked',false); } 
if (cod_estado_prod_nombre_raza4=='1') { $('#cod_estado_prod_nombre_raza4').val('1'); $('#cod_estado_prod_nombre_raza4').prop('checked',true); } else { $('#cod_estado_prod_nombre_raza4').val('0'); $('#cod_estado_prod_nombre_raza4').prop('checked',false); } 
if (cod_estado_prod_ptj_raza1=='1') { $('#cod_estado_prod_ptj_raza1').val('1'); $('#cod_estado_prod_ptj_raza1').prop('checked',true); } else { $('#cod_estado_prod_ptj_raza1').val('0'); $('#cod_estado_prod_ptj_raza1').prop('checked',false); } 
if (cod_estado_prod_ptj_raza2=='1') { $('#cod_estado_prod_ptj_raza2').val('1'); $('#cod_estado_prod_ptj_raza2').prop('checked',true); } else { $('#cod_estado_prod_ptj_raza2').val('0'); $('#cod_estado_prod_ptj_raza2').prop('checked',false); } 
if (cod_estado_prod_ptj_raza3=='1') { $('#cod_estado_prod_ptj_raza3').val('1'); $('#cod_estado_prod_ptj_raza3').prop('checked',true); } else { $('#cod_estado_prod_ptj_raza3').val('0'); $('#cod_estado_prod_ptj_raza3').prop('checked',false); } 
if (cod_estado_prod_ptj_raza4=='1') { $('#cod_estado_prod_ptj_raza4').val('1'); $('#cod_estado_prod_ptj_raza4').prop('checked',true); } else { $('#cod_estado_prod_ptj_raza4').val('0'); $('#cod_estado_prod_ptj_raza4').prop('checked',false); } 
if (cod_estado_prod_id_padre=='1') { $('#cod_estado_prod_id_padre').val('1'); $('#cod_estado_prod_id_padre').prop('checked',true); } else { $('#cod_estado_prod_id_padre').val('0'); $('#cod_estado_prod_id_padre').prop('checked',false); } 
if (cod_estado_prod_raza_padre=='1') { $('#cod_estado_prod_raza_padre').val('1'); $('#cod_estado_prod_raza_padre').prop('checked',true); } else { $('#cod_estado_prod_raza_padre').val('0'); $('#cod_estado_prod_raza_padre').prop('checked',false); } 
if (cod_estado_prod_id_madre=='1') { $('#cod_estado_prod_id_madre').val('1'); $('#cod_estado_prod_id_madre').prop('checked',true); } else { $('#cod_estado_prod_id_madre').val('0'); $('#cod_estado_prod_id_madre').prop('checked',false); } 
if (cod_estado_prod_raza_madre=='1') { $('#cod_estado_prod_raza_madre').val('1'); $('#cod_estado_prod_raza_madre').prop('checked',true); } else { $('#cod_estado_prod_raza_madre').val('0'); $('#cod_estado_prod_raza_madre').prop('checked',false); } 
if (cod_estado_prod_partos_madre=='1') { $('#cod_estado_prod_partos_madre').val('1'); $('#cod_estado_prod_partos_madre').prop('checked',true); } else { $('#cod_estado_prod_partos_madre').val('0'); $('#cod_estado_prod_partos_madre').prop('checked',false); } 
if (cod_estado_prod_id_abuelo_paterno=='1') { $('#cod_estado_prod_id_abuelo_paterno').val('1'); $('#cod_estado_prod_id_abuelo_paterno').prop('checked',true); } else { $('#cod_estado_prod_id_abuelo_paterno').val('0'); $('#cod_estado_prod_id_abuelo_paterno').prop('checked',false); } 
if (cod_estado_prod_id_abuelo_materno=='1') { $('#cod_estado_prod_id_abuelo_materno').val('1'); $('#cod_estado_prod_id_abuelo_materno').prop('checked',true); } else { $('#cod_estado_prod_id_abuelo_materno').val('0'); $('#cod_estado_prod_id_abuelo_materno').prop('checked',false); } 
if (cod_estado_prod_nombre_abuelo_paterno=='1') { $('#cod_estado_prod_nombre_abuelo_paterno').val('1'); $('#cod_estado_prod_nombre_abuelo_paterno').prop('checked',true); } else { $('#cod_estado_prod_nombre_abuelo_paterno').val('0'); $('#cod_estado_prod_nombre_abuelo_paterno').prop('checked',false); } 
if (cod_estado_prod_nombre_abuelo_materno=='1') { $('#cod_estado_prod_nombre_abuelo_materno').val('1'); $('#cod_estado_prod_nombre_abuelo_materno').prop('checked',true); } else { $('#cod_estado_prod_nombre_abuelo_materno').val('0'); $('#cod_estado_prod_nombre_abuelo_materno').prop('checked',false); } 
if (cod_estado_prod_raza_abuelo_paterno=='1') { $('#cod_estado_prod_raza_abuelo_paterno').val('1'); $('#cod_estado_prod_raza_abuelo_paterno').prop('checked',true); } else { $('#cod_estado_prod_raza_abuelo_paterno').val('0'); $('#cod_estado_prod_raza_abuelo_paterno').prop('checked',false); } 
if (cod_estado_prod_raza_abuelo_materno=='1') { $('#cod_estado_prod_raza_abuelo_materno').val('1'); $('#cod_estado_prod_raza_abuelo_materno').prop('checked',true); } else { $('#cod_estado_prod_raza_abuelo_materno').val('0'); $('#cod_estado_prod_raza_abuelo_materno').prop('checked',false); } 
if (cod_estado_prod_id_abuela_paterno=='1') { $('#cod_estado_prod_id_abuela_paterno').val('1'); $('#cod_estado_prod_id_abuela_paterno').prop('checked',true); } else { $('#cod_estado_prod_id_abuela_paterno').val('0'); $('#cod_estado_prod_id_abuela_paterno').prop('checked',false); } 
if (cod_estado_prod_id_abuela_materno=='1') { $('#cod_estado_prod_id_abuela_materno').val('1'); $('#cod_estado_prod_id_abuela_materno').prop('checked',true); } else { $('#cod_estado_prod_id_abuela_materno').val('0'); $('#cod_estado_prod_id_abuela_materno').prop('checked',false); } 
if (cod_estado_prod_nombre_abuela_paterno=='1') { $('#cod_estado_prod_nombre_abuela_paterno').val('1'); $('#cod_estado_prod_nombre_abuela_paterno').prop('checked',true); } else { $('#cod_estado_prod_nombre_abuela_paterno').val('0'); $('#cod_estado_prod_nombre_abuela_paterno').prop('checked',false); } 
if (cod_estado_prod_nombre_abuela_materno=='1') { $('#cod_estado_prod_nombre_abuela_materno').val('1'); $('#cod_estado_prod_nombre_abuela_materno').prop('checked',true); } else { $('#cod_estado_prod_nombre_abuela_materno').val('0'); $('#cod_estado_prod_nombre_abuela_materno').prop('checked',false); } 
if (cod_estado_prod_raza_abuela_paterno=='1') { $('#cod_estado_prod_raza_abuela_paterno').val('1'); $('#cod_estado_prod_raza_abuela_paterno').prop('checked',true); } else { $('#cod_estado_prod_raza_abuela_paterno').val('0'); $('#cod_estado_prod_raza_abuela_paterno').prop('checked',false); } 
if (cod_estado_prod_raza_abuela_materno=='1') { $('#cod_estado_prod_raza_abuela_materno').val('1'); $('#cod_estado_prod_raza_abuela_materno').prop('checked',true); } else { $('#cod_estado_prod_raza_abuela_materno').val('0'); $('#cod_estado_prod_raza_abuela_materno').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_concepcion=='1') { $('#cod_estado_prod_nombre_tipo_concepcion').val('1'); $('#cod_estado_prod_nombre_tipo_concepcion').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_concepcion').val('0'); $('#cod_estado_prod_nombre_tipo_concepcion').prop('checked',false); } 
if (cod_estado_prod_nombre_especie=='1') { $('#cod_estado_prod_nombre_especie').val('1'); $('#cod_estado_prod_nombre_especie').prop('checked',true); } else { $('#cod_estado_prod_nombre_especie').val('0'); $('#cod_estado_prod_nombre_especie').prop('checked',false); } 
if (cod_estado_prod_marcas_tatuado=='1') { $('#cod_estado_prod_marcas_tatuado').val('1'); $('#cod_estado_prod_marcas_tatuado').prop('checked',true); } else { $('#cod_estado_prod_marcas_tatuado').val('0'); $('#cod_estado_prod_marcas_tatuado').prop('checked',false); } 
if (cod_estado_prod_marcas_herrado=='1') { $('#cod_estado_prod_marcas_herrado').val('1'); $('#cod_estado_prod_marcas_herrado').prop('checked',true); } else { $('#cod_estado_prod_marcas_herrado').val('0'); $('#cod_estado_prod_marcas_herrado').prop('checked',false); } 
if (cod_estado_prod_marcas_descornado=='1') { $('#cod_estado_prod_marcas_descornado').val('1'); $('#cod_estado_prod_marcas_descornado').prop('checked',true); } else { $('#cod_estado_prod_marcas_descornado').val('0'); $('#cod_estado_prod_marcas_descornado').prop('checked',false); } 
if (cod_estado_prod_marcas_castrado=='1') { $('#cod_estado_prod_marcas_castrado').val('1'); $('#cod_estado_prod_marcas_castrado').prop('checked',true); } else { $('#cod_estado_prod_marcas_castrado').val('0'); $('#cod_estado_prod_marcas_castrado').prop('checked',false); } 
if (cod_estado_prod_nombre_color=='1') { $('#cod_estado_prod_nombre_color').val('1'); $('#cod_estado_prod_nombre_color').prop('checked',true); } else { $('#cod_estado_prod_nombre_color').val('0'); $('#cod_estado_prod_nombre_color').prop('checked',false); } 
if (cod_estado_prod_nombre_temperamento=='1') { $('#cod_estado_prod_nombre_temperamento').val('1'); $('#cod_estado_prod_nombre_temperamento').prop('checked',true); } else { $('#cod_estado_prod_nombre_temperamento').val('0'); $('#cod_estado_prod_nombre_temperamento').prop('checked',false); } 
if (cod_estado_prod_peso_nacer=='1') { $('#cod_estado_prod_peso_nacer').val('1'); $('#cod_estado_prod_peso_nacer').prop('checked',true); } else { $('#cod_estado_prod_peso_nacer').val('0'); $('#cod_estado_prod_peso_nacer').prop('checked',false); } 
if (cod_estado_prod_aplomo_corvejon=='1') { $('#cod_estado_prod_aplomo_corvejon').val('1'); $('#cod_estado_prod_aplomo_corvejon').prop('checked',true); } else { $('#cod_estado_prod_aplomo_corvejon').val('0'); $('#cod_estado_prod_aplomo_corvejon').prop('checked',false); } 
if (cod_estado_prod_aplomo_cuartilla=='1') { $('#cod_estado_prod_aplomo_cuartilla').val('1'); $('#cod_estado_prod_aplomo_cuartilla').prop('checked',true); } else { $('#cod_estado_prod_aplomo_cuartilla').val('0'); $('#cod_estado_prod_aplomo_cuartilla').prop('checked',false); } 
if (cod_estado_prod_aplomo_cascos=='1') { $('#cod_estado_prod_aplomo_cascos').val('1'); $('#cod_estado_prod_aplomo_cascos').prop('checked',true); } else { $('#cod_estado_prod_aplomo_cascos').val('0'); $('#cod_estado_prod_aplomo_cascos').prop('checked',false); } 
if (cod_estado_prod_genital_circun_escrotal=='1') { $('#cod_estado_prod_genital_circun_escrotal').val('1'); $('#cod_estado_prod_genital_circun_escrotal').prop('checked',true); } else { $('#cod_estado_prod_genital_circun_escrotal').val('0'); $('#cod_estado_prod_genital_circun_escrotal').prop('checked',false); } 
if (cod_estado_prod_genital_prepusio=='1') { $('#cod_estado_prod_genital_prepusio').val('1'); $('#cod_estado_prod_genital_prepusio').prop('checked',true); } else { $('#cod_estado_prod_genital_prepusio').val('0'); $('#cod_estado_prod_genital_prepusio').prop('checked',false); } 
if (cod_estado_prod_genital_potencia=='1') { $('#cod_estado_prod_genital_potencia').val('1'); $('#cod_estado_prod_genital_potencia').prop('checked',true); } else { $('#cod_estado_prod_genital_potencia').val('0'); $('#cod_estado_prod_genital_potencia').prop('checked',false); } 
if (cod_estado_prod_genital_semen=='1') { $('#cod_estado_prod_genital_semen').val('1'); $('#cod_estado_prod_genital_semen').prop('checked',true); } else { $('#cod_estado_prod_genital_semen').val('0'); $('#cod_estado_prod_genital_semen').prop('checked',false); } 
if (cod_estado_prod_observacion_animal=='1') { $('#cod_estado_prod_observacion_animal').val('1'); $('#cod_estado_prod_observacion_animal').prop('checked',true); } else { $('#cod_estado_prod_observacion_animal').val('0'); $('#cod_estado_prod_observacion_animal').prop('checked',false); } 
if (cod_estado_prod_nombre_estado=='1') { $('#cod_estado_prod_nombre_estado').val('1'); $('#cod_estado_prod_nombre_estado').prop('checked',true); } else { $('#cod_estado_prod_nombre_estado').val('0'); $('#cod_estado_prod_nombre_estado').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_movimiento=='1') { $('#cod_estado_prod_nombre_tipo_movimiento').val('1'); $('#cod_estado_prod_nombre_tipo_movimiento').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_movimiento').val('0'); $('#cod_estado_prod_nombre_tipo_movimiento').prop('checked',false); } 
if (cod_estado_prod_nombre_categoria_animal_extern=='1') { $('#cod_estado_prod_nombre_categoria_animal_extern').val('1'); $('#cod_estado_prod_nombre_categoria_animal_extern').prop('checked',true); } else { $('#cod_estado_prod_nombre_categoria_animal_extern').val('0'); $('#cod_estado_prod_nombre_categoria_animal_extern').prop('checked',false); } 
if (cod_estado_prod_cod_finca=='1') { $('#cod_estado_prod_cod_finca').val('1'); $('#cod_estado_prod_cod_finca').prop('checked',true); } else { $('#cod_estado_prod_cod_finca').val('0'); $('#cod_estado_prod_cod_finca').prop('checked',false); } 
if (cod_estado_prod_nombre_finca=='1') { $('#cod_estado_prod_nombre_finca').val('1'); $('#cod_estado_prod_nombre_finca').prop('checked',true); } else { $('#cod_estado_prod_nombre_finca').val('0'); $('#cod_estado_prod_nombre_finca').prop('checked',false); } 
if (cod_estado_prod_nombre_categoria=='1') { $('#cod_estado_prod_nombre_categoria').val('1'); $('#cod_estado_prod_nombre_categoria').prop('checked',true); } else { $('#cod_estado_prod_nombre_categoria').val('0'); $('#cod_estado_prod_nombre_categoria').prop('checked',false); } 
if (cod_estado_prod_nombre_categoria_sub=='1') { $('#cod_estado_prod_nombre_categoria_sub').val('1'); $('#cod_estado_prod_nombre_categoria_sub').prop('checked',true); } else { $('#cod_estado_prod_nombre_categoria_sub').val('0'); $('#cod_estado_prod_nombre_categoria_sub').prop('checked',false); } 
if (cod_estado_prod_und_inv=='1') { $('#cod_estado_prod_und_inv').val('1'); $('#cod_estado_prod_und_inv').prop('checked',true); } else { $('#cod_estado_prod_und_inv').val('0'); $('#cod_estado_prod_und_inv').prop('checked',false); } 
if (cod_estado_prod_descripcion_producto=='1') { $('#cod_estado_prod_descripcion_producto').val('1'); $('#cod_estado_prod_descripcion_producto').prop('checked',true); } else { $('#cod_estado_prod_descripcion_producto').val('0'); $('#cod_estado_prod_descripcion_producto').prop('checked',false); } 
if (cod_estado_prod_url_img_producto_min=='1') { $('#cod_estado_prod_url_img_producto_min').val('1'); $('#cod_estado_prod_url_img_producto_min').prop('checked',true); } else { $('#cod_estado_prod_url_img_producto_min').val('0'); $('#cod_estado_prod_url_img_producto_min').prop('checked',false); } 
if (cod_estado_prod_url_img_producto_orig=='1') { $('#cod_estado_prod_url_img_producto_orig').val('1'); $('#cod_estado_prod_url_img_producto_orig').prop('checked',true); } else { $('#cod_estado_prod_url_img_producto_orig').val('0'); $('#cod_estado_prod_url_img_producto_orig').prop('checked',false); } 
if (cod_estado_prod_nombre_promocion=='1') { $('#cod_estado_prod_nombre_promocion').val('1'); $('#cod_estado_prod_nombre_promocion').prop('checked',true); } else { $('#cod_estado_prod_nombre_promocion').val('0'); $('#cod_estado_prod_nombre_promocion').prop('checked',false); } 
if (cod_estado_prod_nombre_promocion_ing=='1') { $('#cod_estado_prod_nombre_promocion_ing').val('1'); $('#cod_estado_prod_nombre_promocion_ing').prop('checked',true); } else { $('#cod_estado_prod_nombre_promocion_ing').val('0'); $('#cod_estado_prod_nombre_promocion_ing').prop('checked',false); } 
if (cod_estado_prod_posologia_cantidad=='1') { $('#cod_estado_prod_posologia_cantidad').val('1'); $('#cod_estado_prod_posologia_cantidad').prop('checked',true); } else { $('#cod_estado_prod_posologia_cantidad').val('0'); $('#cod_estado_prod_posologia_cantidad').prop('checked',false); } 
if (cod_estado_prod_posologia_peso=='1') { $('#cod_estado_prod_posologia_peso').val('1'); $('#cod_estado_prod_posologia_peso').prop('checked',true); } else { $('#cod_estado_prod_posologia_peso').val('0'); $('#cod_estado_prod_posologia_peso').prop('checked',false); } 
if (cod_estado_prod_nombre_tipo_presentacion=='1') { $('#cod_estado_prod_nombre_tipo_presentacion').val('1'); $('#cod_estado_prod_nombre_tipo_presentacion').prop('checked',true); } else { $('#cod_estado_prod_nombre_tipo_presentacion').val('0'); $('#cod_estado_prod_nombre_tipo_presentacion').prop('checked',false); } 
if (cod_estado_prod_nombre_via_administracion=='1') { $('#cod_estado_prod_nombre_via_administracion').val('1'); $('#cod_estado_prod_nombre_via_administracion').prop('checked',true); } else { $('#cod_estado_prod_nombre_via_administracion').val('0'); $('#cod_estado_prod_nombre_via_administracion').prop('checked',false); } 
if (cod_estado_prod_nombre_frec_duracion=='1') { $('#cod_estado_prod_nombre_frec_duracion').val('1'); $('#cod_estado_prod_nombre_frec_duracion').prop('checked',true); } else { $('#cod_estado_prod_nombre_frec_duracion').val('0'); $('#cod_estado_prod_nombre_frec_duracion').prop('checked',false); } 
if (cod_estado_plan_separe=='1') { $('#cod_estado_plan_separe').val('1'); $('#cod_estado_plan_separe').prop('checked',true); } else { $('#cod_estado_plan_separe').val('0'); $('#cod_estado_plan_separe').prop('checked',false); } 
if (cod_estado_plan_separe_registrar=='1') { $('#cod_estado_plan_separe_registrar').val('1'); $('#cod_estado_plan_separe_registrar').prop('checked',true); } else { $('#cod_estado_plan_separe_registrar').val('0'); $('#cod_estado_plan_separe_registrar').prop('checked',false); } 
if (cod_estado_plan_separe_editar=='1') { $('#cod_estado_plan_separe_editar').val('1'); $('#cod_estado_plan_separe_editar').prop('checked',true); } else { $('#cod_estado_plan_separe_editar').val('0'); $('#cod_estado_plan_separe_editar').prop('checked',false); } 
if (cod_estado_plan_separe_eliminar=='1') { $('#cod_estado_plan_separe_eliminar').val('1'); $('#cod_estado_plan_separe_eliminar').prop('checked',true); } else { $('#cod_estado_plan_separe_eliminar').val('0'); $('#cod_estado_plan_separe_eliminar').prop('checked',false); } 
if (cod_estado_plan_separe_imprimir=='1') { $('#cod_estado_plan_separe_imprimir').val('1'); $('#cod_estado_plan_separe_imprimir').prop('checked',true); } else { $('#cod_estado_plan_separe_imprimir').val('0'); $('#cod_estado_plan_separe_imprimir').prop('checked',false); } 
if (cod_estado_plan_separe_exportar=='1') { $('#cod_estado_plan_separe_exportar').val('1'); $('#cod_estado_plan_separe_exportar').prop('checked',true); } else { $('#cod_estado_plan_separe_exportar').val('0'); $('#cod_estado_plan_separe_exportar').prop('checked',false); } 
if (cod_estado_contabilidad=='1') { $('#cod_estado_contabilidad').val('1'); $('#cod_estado_contabilidad').prop('checked',true); } else { $('#cod_estado_contabilidad').val('0'); $('#cod_estado_contabilidad').prop('checked',false); } 
if (cod_estado_contabilidad_mov_contable=='1') { $('#cod_estado_contabilidad_mov_contable').val('1'); $('#cod_estado_contabilidad_mov_contable').prop('checked',true); } else { $('#cod_estado_contabilidad_mov_contable').val('0'); $('#cod_estado_contabilidad_mov_contable').prop('checked',false); } 
if (cod_estado_contabilidad_mov_contable_registrar=='1') { $('#cod_estado_contabilidad_mov_contable_registrar').val('1'); $('#cod_estado_contabilidad_mov_contable_registrar').prop('checked',true); } else { $('#cod_estado_contabilidad_mov_contable_registrar').val('0'); $('#cod_estado_contabilidad_mov_contable_registrar').prop('checked',false); } 
if (cod_estado_contabilidad_mov_contable_editar=='1') { $('#cod_estado_contabilidad_mov_contable_editar').val('1'); $('#cod_estado_contabilidad_mov_contable_editar').prop('checked',true); } else { $('#cod_estado_contabilidad_mov_contable_editar').val('0'); $('#cod_estado_contabilidad_mov_contable_editar').prop('checked',false); } 
if (cod_estado_contabilidad_mov_contable_eliminar=='1') { $('#cod_estado_contabilidad_mov_contable_eliminar').val('1'); $('#cod_estado_contabilidad_mov_contable_eliminar').prop('checked',true); } else { $('#cod_estado_contabilidad_mov_contable_eliminar').val('0'); $('#cod_estado_contabilidad_mov_contable_eliminar').prop('checked',false); } 
if (cod_estado_contabilidad_mov_contable_imprimir=='1') { $('#cod_estado_contabilidad_mov_contable_imprimir').val('1'); $('#cod_estado_contabilidad_mov_contable_imprimir').prop('checked',true); } else { $('#cod_estado_contabilidad_mov_contable_imprimir').val('0'); $('#cod_estado_contabilidad_mov_contable_imprimir').prop('checked',false); } 
if (cod_estado_contabilidad_mov_contable_exportar=='1') { $('#cod_estado_contabilidad_mov_contable_exportar').val('1'); $('#cod_estado_contabilidad_mov_contable_exportar').prop('checked',true); } else { $('#cod_estado_contabilidad_mov_contable_exportar').val('0'); $('#cod_estado_contabilidad_mov_contable_exportar').prop('checked',false); } 
if (cod_estado_contabilidad_pyg=='1') { $('#cod_estado_contabilidad_pyg').val('1'); $('#cod_estado_contabilidad_pyg').prop('checked',true); } else { $('#cod_estado_contabilidad_pyg').val('0'); $('#cod_estado_contabilidad_pyg').prop('checked',false); } 
if (cod_estado_contabilidad_pyg_registrar=='1') { $('#cod_estado_contabilidad_pyg_registrar').val('1'); $('#cod_estado_contabilidad_pyg_registrar').prop('checked',true); } else { $('#cod_estado_contabilidad_pyg_registrar').val('0'); $('#cod_estado_contabilidad_pyg_registrar').prop('checked',false); } 
if (cod_estado_contabilidad_pyg_editar=='1') { $('#cod_estado_contabilidad_pyg_editar').val('1'); $('#cod_estado_contabilidad_pyg_editar').prop('checked',true); } else { $('#cod_estado_contabilidad_pyg_editar').val('0'); $('#cod_estado_contabilidad_pyg_editar').prop('checked',false); } 
if (cod_estado_contabilidad_pyg_eliminar=='1') { $('#cod_estado_contabilidad_pyg_eliminar').val('1'); $('#cod_estado_contabilidad_pyg_eliminar').prop('checked',true); } else { $('#cod_estado_contabilidad_pyg_eliminar').val('0'); $('#cod_estado_contabilidad_pyg_eliminar').prop('checked',false); } 
if (cod_estado_contabilidad_pyg_imprimir=='1') { $('#cod_estado_contabilidad_pyg_imprimir').val('1'); $('#cod_estado_contabilidad_pyg_imprimir').prop('checked',true); } else { $('#cod_estado_contabilidad_pyg_imprimir').val('0'); $('#cod_estado_contabilidad_pyg_imprimir').prop('checked',false); } 
if (cod_estado_contabilidad_pyg_exportar=='1') { $('#cod_estado_contabilidad_pyg_exportar').val('1'); $('#cod_estado_contabilidad_pyg_exportar').prop('checked',true); } else { $('#cod_estado_contabilidad_pyg_exportar').val('0'); $('#cod_estado_contabilidad_pyg_exportar').prop('checked',false); } 
if (cod_estado_contabilidad_balance=='1') { $('#cod_estado_contabilidad_balance').val('1'); $('#cod_estado_contabilidad_balance').prop('checked',true); } else { $('#cod_estado_contabilidad_balance').val('0'); $('#cod_estado_contabilidad_balance').prop('checked',false); } 
if (cod_estado_contabilidad_balance_pyg_registrar=='1') { $('#cod_estado_contabilidad_balance_pyg_registrar').val('1'); $('#cod_estado_contabilidad_balance_pyg_registrar').prop('checked',true); } else { $('#cod_estado_contabilidad_balance_pyg_registrar').val('0'); $('#cod_estado_contabilidad_balance_pyg_registrar').prop('checked',false); } 
if (cod_estado_contabilidad_balance_pyg_editar=='1') { $('#cod_estado_contabilidad_balance_pyg_editar').val('1'); $('#cod_estado_contabilidad_balance_pyg_editar').prop('checked',true); } else { $('#cod_estado_contabilidad_balance_pyg_editar').val('0'); $('#cod_estado_contabilidad_balance_pyg_editar').prop('checked',false); } 
if (cod_estado_contabilidad_balance_pyg_eliminar=='1') { $('#cod_estado_contabilidad_balance_pyg_eliminar').val('1'); $('#cod_estado_contabilidad_balance_pyg_eliminar').prop('checked',true); } else { $('#cod_estado_contabilidad_balance_pyg_eliminar').val('0'); $('#cod_estado_contabilidad_balance_pyg_eliminar').prop('checked',false); } 
if (cod_estado_contabilidad_balance_pyg_imprimir=='1') { $('#cod_estado_contabilidad_balance_pyg_imprimir').val('1'); $('#cod_estado_contabilidad_balance_pyg_imprimir').prop('checked',true); } else { $('#cod_estado_contabilidad_balance_pyg_imprimir').val('0'); $('#cod_estado_contabilidad_balance_pyg_imprimir').prop('checked',false); } 
if (cod_estado_contabilidad_balance_pyg_exportar=='1') { $('#cod_estado_contabilidad_balance_pyg_exportar').val('1'); $('#cod_estado_contabilidad_balance_pyg_exportar').prop('checked',true); } else { $('#cod_estado_contabilidad_balance_pyg_exportar').val('0'); $('#cod_estado_contabilidad_balance_pyg_exportar').prop('checked',false); } 
if (cod_estado_contabilidad_puc=='1') { $('#cod_estado_contabilidad_puc').val('1'); $('#cod_estado_contabilidad_puc').prop('checked',true); } else { $('#cod_estado_contabilidad_puc').val('0'); $('#cod_estado_contabilidad_puc').prop('checked',false); } 
if (cod_estado_contabilidad_puc_registrar=='1') { $('#cod_estado_contabilidad_puc_registrar').val('1'); $('#cod_estado_contabilidad_puc_registrar').prop('checked',true); } else { $('#cod_estado_contabilidad_puc_registrar').val('0'); $('#cod_estado_contabilidad_puc_registrar').prop('checked',false); } 
if (cod_estado_contabilidad_puc_editar=='1') { $('#cod_estado_contabilidad_puc_editar').val('1'); $('#cod_estado_contabilidad_puc_editar').prop('checked',true); } else { $('#cod_estado_contabilidad_puc_editar').val('0'); $('#cod_estado_contabilidad_puc_editar').prop('checked',false); } 
if (cod_estado_contabilidad_puc_eliminar=='1') { $('#cod_estado_contabilidad_puc_eliminar').val('1'); $('#cod_estado_contabilidad_puc_eliminar').prop('checked',true); } else { $('#cod_estado_contabilidad_puc_eliminar').val('0'); $('#cod_estado_contabilidad_puc_eliminar').prop('checked',false); } 
if (cod_estado_contabilidad_puc_imprimir=='1') { $('#cod_estado_contabilidad_puc_imprimir').val('1'); $('#cod_estado_contabilidad_puc_imprimir').prop('checked',true); } else { $('#cod_estado_contabilidad_puc_imprimir').val('0'); $('#cod_estado_contabilidad_puc_imprimir').prop('checked',false); } 
if (cod_estado_contabilidad_puc_exportar=='1') { $('#cod_estado_contabilidad_puc_exportar').val('1'); $('#cod_estado_contabilidad_puc_exportar').prop('checked',true); } else { $('#cod_estado_contabilidad_puc_exportar').val('0'); $('#cod_estado_contabilidad_puc_exportar').prop('checked',false); } 
if (cod_estado_facturacion=='1') { $('#cod_estado_facturacion').val('1'); $('#cod_estado_facturacion').prop('checked',true); } else { $('#cod_estado_facturacion').val('0'); $('#cod_estado_facturacion').prop('checked',false); } 
if (cod_estado_facturacion_venta=='1') { $('#cod_estado_facturacion_venta').val('1'); $('#cod_estado_facturacion_venta').prop('checked',true); } else { $('#cod_estado_facturacion_venta').val('0'); $('#cod_estado_facturacion_venta').prop('checked',false); } 
if (cod_estado_facturacion_venta_registrar=='1') { $('#cod_estado_facturacion_venta_registrar').val('1'); $('#cod_estado_facturacion_venta_registrar').prop('checked',true); } else { $('#cod_estado_facturacion_venta_registrar').val('0'); $('#cod_estado_facturacion_venta_registrar').prop('checked',false); } 
if (cod_estado_facturacion_venta_editar=='1') { $('#cod_estado_facturacion_venta_editar').val('1'); $('#cod_estado_facturacion_venta_editar').prop('checked',true); } else { $('#cod_estado_facturacion_venta_editar').val('0'); $('#cod_estado_facturacion_venta_editar').prop('checked',false); } 
if (cod_estado_facturacion_venta_eliminar=='1') { $('#cod_estado_facturacion_venta_eliminar').val('1'); $('#cod_estado_facturacion_venta_eliminar').prop('checked',true); } else { $('#cod_estado_facturacion_venta_eliminar').val('0'); $('#cod_estado_facturacion_venta_eliminar').prop('checked',false); } 
if (cod_estado_facturacion_venta_imprimir=='1') { $('#cod_estado_facturacion_venta_imprimir').val('1'); $('#cod_estado_facturacion_venta_imprimir').prop('checked',true); } else { $('#cod_estado_facturacion_venta_imprimir').val('0'); $('#cod_estado_facturacion_venta_imprimir').prop('checked',false); } 
if (cod_estado_facturacion_venta_exportar=='1') { $('#cod_estado_facturacion_venta_exportar').val('1'); $('#cod_estado_facturacion_venta_exportar').prop('checked',true); } else { $('#cod_estado_facturacion_venta_exportar').val('0'); $('#cod_estado_facturacion_venta_exportar').prop('checked',false); } 
if (cod_estado_facturacion_venta_devol=='1') { $('#cod_estado_facturacion_venta_devol').val('1'); $('#cod_estado_facturacion_venta_devol').prop('checked',true); } else { $('#cod_estado_facturacion_venta_devol').val('0'); $('#cod_estado_facturacion_venta_devol').prop('checked',false); } 
if (cod_estado_facturacion_compra=='1') { $('#cod_estado_facturacion_compra').val('1'); $('#cod_estado_facturacion_compra').prop('checked',true); } else { $('#cod_estado_facturacion_compra').val('0'); $('#cod_estado_facturacion_compra').prop('checked',false); } 
if (cod_estado_facturacion_compra_registrar=='1') { $('#cod_estado_facturacion_compra_registrar').val('1'); $('#cod_estado_facturacion_compra_registrar').prop('checked',true); } else { $('#cod_estado_facturacion_compra_registrar').val('0'); $('#cod_estado_facturacion_compra_registrar').prop('checked',false); } 
if (cod_estado_facturacion_compra_editar=='1') { $('#cod_estado_facturacion_compra_editar').val('1'); $('#cod_estado_facturacion_compra_editar').prop('checked',true); } else { $('#cod_estado_facturacion_compra_editar').val('0'); $('#cod_estado_facturacion_compra_editar').prop('checked',false); } 
if (cod_estado_facturacion_compra_eliminar=='1') { $('#cod_estado_facturacion_compra_eliminar').val('1'); $('#cod_estado_facturacion_compra_eliminar').prop('checked',true); } else { $('#cod_estado_facturacion_compra_eliminar').val('0'); $('#cod_estado_facturacion_compra_eliminar').prop('checked',false); } 
if (cod_estado_facturacion_compra_imprimir=='1') { $('#cod_estado_facturacion_compra_imprimir').val('1'); $('#cod_estado_facturacion_compra_imprimir').prop('checked',true); } else { $('#cod_estado_facturacion_compra_imprimir').val('0'); $('#cod_estado_facturacion_compra_imprimir').prop('checked',false); } 
if (cod_estado_facturacion_compra_exportar=='1') { $('#cod_estado_facturacion_compra_exportar').val('1'); $('#cod_estado_facturacion_compra_exportar').prop('checked',true); } else { $('#cod_estado_facturacion_compra_exportar').val('0'); $('#cod_estado_facturacion_compra_exportar').prop('checked',false); } 
if (cod_estado_facturacion_compra_devol=='1') { $('#cod_estado_facturacion_compra_devol').val('1'); $('#cod_estado_facturacion_compra_devol').prop('checked',true); } else { $('#cod_estado_facturacion_compra_devol').val('0'); $('#cod_estado_facturacion_compra_devol').prop('checked',false); } 
if (cod_estado_facturacion_devol_venta=='1') { $('#cod_estado_facturacion_devol_venta').val('1'); $('#cod_estado_facturacion_devol_venta').prop('checked',true); } else { $('#cod_estado_facturacion_devol_venta').val('0'); $('#cod_estado_facturacion_devol_venta').prop('checked',false); } 
if (cod_estado_facturacion_devol_inventario=='1') { $('#cod_estado_facturacion_devol_inventario').val('1'); $('#cod_estado_facturacion_devol_inventario').prop('checked',true); } else { $('#cod_estado_facturacion_devol_inventario').val('0'); $('#cod_estado_facturacion_devol_inventario').prop('checked',false); } 
if (cod_estado_cotizacion=='1') { $('#cod_estado_cotizacion').val('1'); $('#cod_estado_cotizacion').prop('checked',true); } else { $('#cod_estado_cotizacion').val('0'); $('#cod_estado_cotizacion').prop('checked',false); } 
if (cod_estado_cotizacion_venta=='1') { $('#cod_estado_cotizacion_venta').val('1'); $('#cod_estado_cotizacion_venta').prop('checked',true); } else { $('#cod_estado_cotizacion_venta').val('0'); $('#cod_estado_cotizacion_venta').prop('checked',false); } 
if (cod_estado_cotizacion_venta_registrar=='1') { $('#cod_estado_cotizacion_venta_registrar').val('1'); $('#cod_estado_cotizacion_venta_registrar').prop('checked',true); } else { $('#cod_estado_cotizacion_venta_registrar').val('0'); $('#cod_estado_cotizacion_venta_registrar').prop('checked',false); } 
if (cod_estado_cotizacion_venta_editar=='1') { $('#cod_estado_cotizacion_venta_editar').val('1'); $('#cod_estado_cotizacion_venta_editar').prop('checked',true); } else { $('#cod_estado_cotizacion_venta_editar').val('0'); $('#cod_estado_cotizacion_venta_editar').prop('checked',false); } 
if (cod_estado_cotizacion_venta_eliminar=='1') { $('#cod_estado_cotizacion_venta_eliminar').val('1'); $('#cod_estado_cotizacion_venta_eliminar').prop('checked',true); } else { $('#cod_estado_cotizacion_venta_eliminar').val('0'); $('#cod_estado_cotizacion_venta_eliminar').prop('checked',false); } 
if (cod_estado_cotizacion_venta_imprimir=='1') { $('#cod_estado_cotizacion_venta_imprimir').val('1'); $('#cod_estado_cotizacion_venta_imprimir').prop('checked',true); } else { $('#cod_estado_cotizacion_venta_imprimir').val('0'); $('#cod_estado_cotizacion_venta_imprimir').prop('checked',false); } 
if (cod_estado_cotizacion_venta_exportar=='1') { $('#cod_estado_cotizacion_venta_exportar').val('1'); $('#cod_estado_cotizacion_venta_exportar').prop('checked',true); } else { $('#cod_estado_cotizacion_venta_exportar').val('0'); $('#cod_estado_cotizacion_venta_exportar').prop('checked',false); } 
if (cod_estado_cotizacion_compra=='1') { $('#cod_estado_cotizacion_compra').val('1'); $('#cod_estado_cotizacion_compra').prop('checked',true); } else { $('#cod_estado_cotizacion_compra').val('0'); $('#cod_estado_cotizacion_compra').prop('checked',false); } 
if (cod_estado_cotizacion_compra_registrar=='1') { $('#cod_estado_cotizacion_compra_registrar').val('1'); $('#cod_estado_cotizacion_compra_registrar').prop('checked',true); } else { $('#cod_estado_cotizacion_compra_registrar').val('0'); $('#cod_estado_cotizacion_compra_registrar').prop('checked',false); } 
if (cod_estado_cotizacion_compra_editar=='1') { $('#cod_estado_cotizacion_compra_editar').val('1'); $('#cod_estado_cotizacion_compra_editar').prop('checked',true); } else { $('#cod_estado_cotizacion_compra_editar').val('0'); $('#cod_estado_cotizacion_compra_editar').prop('checked',false); } 
if (cod_estado_cotizacion_compra_eliminar=='1') { $('#cod_estado_cotizacion_compra_eliminar').val('1'); $('#cod_estado_cotizacion_compra_eliminar').prop('checked',true); } else { $('#cod_estado_cotizacion_compra_eliminar').val('0'); $('#cod_estado_cotizacion_compra_eliminar').prop('checked',false); } 
if (cod_estado_cotizacion_compra_imprimir=='1') { $('#cod_estado_cotizacion_compra_imprimir').val('1'); $('#cod_estado_cotizacion_compra_imprimir').prop('checked',true); } else { $('#cod_estado_cotizacion_compra_imprimir').val('0'); $('#cod_estado_cotizacion_compra_imprimir').prop('checked',false); } 
if (cod_estado_cotizacion_compra_exportar=='1') { $('#cod_estado_cotizacion_compra_exportar').val('1'); $('#cod_estado_cotizacion_compra_exportar').prop('checked',true); } else { $('#cod_estado_cotizacion_compra_exportar').val('0'); $('#cod_estado_cotizacion_compra_exportar').prop('checked',false); } 
if (cod_estado_venta=='1') { $('#cod_estado_venta').val('1'); $('#cod_estado_venta').prop('checked',true); } else { $('#cod_estado_venta').val('0'); $('#cod_estado_venta').prop('checked',false); } 
if (cod_estado_venta_manual=='1') { $('#cod_estado_venta_manual').val('1'); $('#cod_estado_venta_manual').prop('checked',true); } else { $('#cod_estado_venta_manual').val('0'); $('#cod_estado_venta_manual').prop('checked',false); } 
if (cod_estado_venta_barras=='1') { $('#cod_estado_venta_barras').val('1'); $('#cod_estado_venta_barras').prop('checked',true); } else { $('#cod_estado_venta_barras').val('0'); $('#cod_estado_venta_barras').prop('checked',false); } 
if (cod_estado_venta_fecha_venta=='1') { $('#cod_estado_venta_fecha_venta').val('1'); $('#cod_estado_venta_fecha_venta').prop('checked',true); } else { $('#cod_estado_venta_fecha_venta').val('0'); $('#cod_estado_venta_fecha_venta').prop('checked',false); } 
if (cod_estado_venta_preventa=='1') { $('#cod_estado_venta_preventa').val('1'); $('#cod_estado_venta_preventa').prop('checked',true); } else { $('#cod_estado_venta_preventa').val('0'); $('#cod_estado_venta_preventa').prop('checked',false); } 
if (cod_estado_venta_propina=='1') { $('#cod_estado_venta_propina').val('1'); $('#cod_estado_venta_propina').prop('checked',true); } else { $('#cod_estado_venta_propina').val('0'); $('#cod_estado_venta_propina').prop('checked',false); } 
if (cod_estado_venta_bolsa=='1') { $('#cod_estado_venta_bolsa').val('1'); $('#cod_estado_venta_bolsa').prop('checked',true); } else { $('#cod_estado_venta_bolsa').val('0'); $('#cod_estado_venta_bolsa').prop('checked',false); } 
if (cod_estado_venta_observacion=='1') { $('#cod_estado_venta_observacion').val('1'); $('#cod_estado_venta_observacion').prop('checked',true); } else { $('#cod_estado_venta_observacion').val('0'); $('#cod_estado_venta_observacion').prop('checked',false); } 
if (cod_estado_tercero=='1') { $('#cod_estado_tercero').val('1'); $('#cod_estado_tercero').prop('checked',true); } else { $('#cod_estado_tercero').val('0'); $('#cod_estado_tercero').prop('checked',false); } 
if (cod_estado_tercero_registrar=='1') { $('#cod_estado_tercero_registrar').val('1'); $('#cod_estado_tercero_registrar').prop('checked',true); } else { $('#cod_estado_tercero_registrar').val('0'); $('#cod_estado_tercero_registrar').prop('checked',false); } 
if (cod_estado_tercero_editar=='1') { $('#cod_estado_tercero_editar').val('1'); $('#cod_estado_tercero_editar').prop('checked',true); } else { $('#cod_estado_tercero_editar').val('0'); $('#cod_estado_tercero_editar').prop('checked',false); } 
if (cod_estado_tercero_eliminar=='1') { $('#cod_estado_tercero_eliminar').val('1'); $('#cod_estado_tercero_eliminar').prop('checked',true); } else { $('#cod_estado_tercero_eliminar').val('0'); $('#cod_estado_tercero_eliminar').prop('checked',false); } 
if (cod_estado_tercero_imprimir=='1') { $('#cod_estado_tercero_imprimir').val('1'); $('#cod_estado_tercero_imprimir').prop('checked',true); } else { $('#cod_estado_tercero_imprimir').val('0'); $('#cod_estado_tercero_imprimir').prop('checked',false); } 
if (cod_estado_tercero_exportar=='1') { $('#cod_estado_tercero_exportar').val('1'); $('#cod_estado_tercero_exportar').prop('checked',true); } else { $('#cod_estado_tercero_exportar').val('0'); $('#cod_estado_tercero_exportar').prop('checked',false); } 
if (cod_estado_cita=='1') { $('#cod_estado_cita').val('1'); $('#cod_estado_cita').prop('checked',true); } else { $('#cod_estado_cita').val('0'); $('#cod_estado_cita').prop('checked',false); } 
if (cod_estado_cita_registrar=='1') { $('#cod_estado_cita_registrar').val('1'); $('#cod_estado_cita_registrar').prop('checked',true); } else { $('#cod_estado_cita_registrar').val('0'); $('#cod_estado_cita_registrar').prop('checked',false); } 
if (cod_estado_cita_editar=='1') { $('#cod_estado_cita_editar').val('1'); $('#cod_estado_cita_editar').prop('checked',true); } else { $('#cod_estado_cita_editar').val('0'); $('#cod_estado_cita_editar').prop('checked',false); } 
if (cod_estado_cita_eliminar=='1') { $('#cod_estado_cita_eliminar').val('1'); $('#cod_estado_cita_eliminar').prop('checked',true); } else { $('#cod_estado_cita_eliminar').val('0'); $('#cod_estado_cita_eliminar').prop('checked',false); } 
if (cod_estado_cita_imprimir=='1') { $('#cod_estado_cita_imprimir').val('1'); $('#cod_estado_cita_imprimir').prop('checked',true); } else { $('#cod_estado_cita_imprimir').val('0'); $('#cod_estado_cita_imprimir').prop('checked',false); } 
if (cod_estado_cita_exportar=='1') { $('#cod_estado_cita_exportar').val('1'); $('#cod_estado_cita_exportar').prop('checked',true); } else { $('#cod_estado_cita_exportar').val('0'); $('#cod_estado_cita_exportar').prop('checked',false); } 
if (cod_estado_cuenta=='1') { $('#cod_estado_cuenta').val('1'); $('#cod_estado_cuenta').prop('checked',true); } else { $('#cod_estado_cuenta').val('0'); $('#cod_estado_cuenta').prop('checked',false); } 
if (cod_estado_cuenta_cobrar=='1') { $('#cod_estado_cuenta_cobrar').val('1'); $('#cod_estado_cuenta_cobrar').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar').val('0'); $('#cod_estado_cuenta_cobrar').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_registrar=='1') { $('#cod_estado_cuenta_cobrar_registrar').val('1'); $('#cod_estado_cuenta_cobrar_registrar').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_registrar').val('0'); $('#cod_estado_cuenta_cobrar_registrar').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_editar=='1') { $('#cod_estado_cuenta_cobrar_editar').val('1'); $('#cod_estado_cuenta_cobrar_editar').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_editar').val('0'); $('#cod_estado_cuenta_cobrar_editar').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_eliminar=='1') { $('#cod_estado_cuenta_cobrar_eliminar').val('1'); $('#cod_estado_cuenta_cobrar_eliminar').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_eliminar').val('0'); $('#cod_estado_cuenta_cobrar_eliminar').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_imprimir=='1') { $('#cod_estado_cuenta_cobrar_imprimir').val('1'); $('#cod_estado_cuenta_cobrar_imprimir').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_imprimir').val('0'); $('#cod_estado_cuenta_cobrar_imprimir').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_exportar=='1') { $('#cod_estado_cuenta_cobrar_exportar').val('1'); $('#cod_estado_cuenta_cobrar_exportar').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_exportar').val('0'); $('#cod_estado_cuenta_cobrar_exportar').prop('checked',false); } 
if (cod_estado_cuenta_pagar=='1') { $('#cod_estado_cuenta_pagar').val('1'); $('#cod_estado_cuenta_pagar').prop('checked',true); } else { $('#cod_estado_cuenta_pagar').val('0'); $('#cod_estado_cuenta_pagar').prop('checked',false); } 
if (cod_estado_cuenta_pagar_registrar=='1') { $('#cod_estado_cuenta_pagar_registrar').val('1'); $('#cod_estado_cuenta_pagar_registrar').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_registrar').val('0'); $('#cod_estado_cuenta_pagar_registrar').prop('checked',false); } 
if (cod_estado_cuenta_pagar_editar=='1') { $('#cod_estado_cuenta_pagar_editar').val('1'); $('#cod_estado_cuenta_pagar_editar').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_editar').val('0'); $('#cod_estado_cuenta_pagar_editar').prop('checked',false); } 
if (cod_estado_cuenta_pagar_eliminar=='1') { $('#cod_estado_cuenta_pagar_eliminar').val('1'); $('#cod_estado_cuenta_pagar_eliminar').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_eliminar').val('0'); $('#cod_estado_cuenta_pagar_eliminar').prop('checked',false); } 
if (cod_estado_cuenta_pagar_imprimir=='1') { $('#cod_estado_cuenta_pagar_imprimir').val('1'); $('#cod_estado_cuenta_pagar_imprimir').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_imprimir').val('0'); $('#cod_estado_cuenta_pagar_imprimir').prop('checked',false); } 
if (cod_estado_cuenta_pagar_exportar=='1') { $('#cod_estado_cuenta_pagar_exportar').val('1'); $('#cod_estado_cuenta_pagar_exportar').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_exportar').val('0'); $('#cod_estado_cuenta_pagar_exportar').prop('checked',false); } 
if (cod_estado_cierre_caja=='1') { $('#cod_estado_cierre_caja').val('1'); $('#cod_estado_cierre_caja').prop('checked',true); } else { $('#cod_estado_cierre_caja').val('0'); $('#cod_estado_cierre_caja').prop('checked',false); } 
if (cod_estado_cierre_caja_registrar=='1') { $('#cod_estado_cierre_caja_registrar').val('1'); $('#cod_estado_cierre_caja_registrar').prop('checked',true); } else { $('#cod_estado_cierre_caja_registrar').val('0'); $('#cod_estado_cierre_caja_registrar').prop('checked',false); } 
if (cod_estado_cierre_caja_editar=='1') { $('#cod_estado_cierre_caja_editar').val('1'); $('#cod_estado_cierre_caja_editar').prop('checked',true); } else { $('#cod_estado_cierre_caja_editar').val('0'); $('#cod_estado_cierre_caja_editar').prop('checked',false); } 
if (cod_estado_cierre_caja_eliminar=='1') { $('#cod_estado_cierre_caja_eliminar').val('1'); $('#cod_estado_cierre_caja_eliminar').prop('checked',true); } else { $('#cod_estado_cierre_caja_eliminar').val('0'); $('#cod_estado_cierre_caja_eliminar').prop('checked',false); } 
if (cod_estado_cierre_caja_imprimir=='1') { $('#cod_estado_cierre_caja_imprimir').val('1'); $('#cod_estado_cierre_caja_imprimir').prop('checked',true); } else { $('#cod_estado_cierre_caja_imprimir').val('0'); $('#cod_estado_cierre_caja_imprimir').prop('checked',false); } 
if (cod_estado_cierre_caja_exportar=='1') { $('#cod_estado_cierre_caja_exportar').val('1'); $('#cod_estado_cierre_caja_exportar').prop('checked',true); } else { $('#cod_estado_cierre_caja_exportar').val('0'); $('#cod_estado_cierre_caja_exportar').prop('checked',false); } 
if (cod_estado_egreso=='1') { $('#cod_estado_egreso').val('1'); $('#cod_estado_egreso').prop('checked',true); } else { $('#cod_estado_egreso').val('0'); $('#cod_estado_egreso').prop('checked',false); } 
if (cod_estado_egreso_registrar=='1') { $('#cod_estado_egreso_registrar').val('1'); $('#cod_estado_egreso_registrar').prop('checked',true); } else { $('#cod_estado_egreso_registrar').val('0'); $('#cod_estado_egreso_registrar').prop('checked',false); } 
if (cod_estado_egreso_editar=='1') { $('#cod_estado_egreso_editar').val('1'); $('#cod_estado_egreso_editar').prop('checked',true); } else { $('#cod_estado_egreso_editar').val('0'); $('#cod_estado_egreso_editar').prop('checked',false); } 
if (cod_estado_egreso_eliminar=='1') { $('#cod_estado_egreso_eliminar').val('1'); $('#cod_estado_egreso_eliminar').prop('checked',true); } else { $('#cod_estado_egreso_eliminar').val('0'); $('#cod_estado_egreso_eliminar').prop('checked',false); } 
if (cod_estado_egreso_imprimir=='1') { $('#cod_estado_egreso_imprimir').val('1'); $('#cod_estado_egreso_imprimir').prop('checked',true); } else { $('#cod_estado_egreso_imprimir').val('0'); $('#cod_estado_egreso_imprimir').prop('checked',false); } 
if (cod_estado_egreso_exportar=='1') { $('#cod_estado_egreso_exportar').val('1'); $('#cod_estado_egreso_exportar').prop('checked',true); } else { $('#cod_estado_egreso_exportar').val('0'); $('#cod_estado_egreso_exportar').prop('checked',false); } 
if (cod_estado_sticker_barra=='1') { $('#cod_estado_sticker_barra').val('1'); $('#cod_estado_sticker_barra').prop('checked',true); } else { $('#cod_estado_sticker_barra').val('0'); $('#cod_estado_sticker_barra').prop('checked',false); } 
if (cod_estado_sticker_barra_registrar=='1') { $('#cod_estado_sticker_barra_registrar').val('1'); $('#cod_estado_sticker_barra_registrar').prop('checked',true); } else { $('#cod_estado_sticker_barra_registrar').val('0'); $('#cod_estado_sticker_barra_registrar').prop('checked',false); } 
if (cod_estado_sticker_barra_editar=='1') { $('#cod_estado_sticker_barra_editar').val('1'); $('#cod_estado_sticker_barra_editar').prop('checked',true); } else { $('#cod_estado_sticker_barra_editar').val('0'); $('#cod_estado_sticker_barra_editar').prop('checked',false); } 
if (cod_estado_sticker_barra_eliminar=='1') { $('#cod_estado_sticker_barra_eliminar').val('1'); $('#cod_estado_sticker_barra_eliminar').prop('checked',true); } else { $('#cod_estado_sticker_barra_eliminar').val('0'); $('#cod_estado_sticker_barra_eliminar').prop('checked',false); } 
if (cod_estado_sticker_barra_imprimir=='1') { $('#cod_estado_sticker_barra_imprimir').val('1'); $('#cod_estado_sticker_barra_imprimir').prop('checked',true); } else { $('#cod_estado_sticker_barra_imprimir').val('0'); $('#cod_estado_sticker_barra_imprimir').prop('checked',false); } 
if (cod_estado_sticker_barra_exportar=='1') { $('#cod_estado_sticker_barra_exportar').val('1'); $('#cod_estado_sticker_barra_exportar').prop('checked',true); } else { $('#cod_estado_sticker_barra_exportar').val('0'); $('#cod_estado_sticker_barra_exportar').prop('checked',false); } 
if (cod_estado_sticker_barra_observacion=='1') { $('#cod_estado_sticker_barra_observacion').val('1'); $('#cod_estado_sticker_barra_observacion').prop('checked',true); } else { $('#cod_estado_sticker_barra_observacion').val('0'); $('#cod_estado_sticker_barra_observacion').prop('checked',false); } 
if (cod_estado_sticker_barra_archivo_plano=='1') { $('#cod_estado_sticker_barra_archivo_plano').val('1'); $('#cod_estado_sticker_barra_archivo_plano').prop('checked',true); } else { $('#cod_estado_sticker_barra_archivo_plano').val('0'); $('#cod_estado_sticker_barra_archivo_plano').prop('checked',false); } 
if (cod_estado_reporte=='1') { $('#cod_estado_reporte').val('1'); $('#cod_estado_reporte').prop('checked',true); } else { $('#cod_estado_reporte').val('0'); $('#cod_estado_reporte').prop('checked',false); } 
if (cod_estado_reporte_venta=='1') { $('#cod_estado_reporte_venta').val('1'); $('#cod_estado_reporte_venta').prop('checked',true); } else { $('#cod_estado_reporte_venta').val('0'); $('#cod_estado_reporte_venta').prop('checked',false); } 
if (cod_estado_reporte_venta_registrar=='1') { $('#cod_estado_reporte_venta_registrar').val('1'); $('#cod_estado_reporte_venta_registrar').prop('checked',true); } else { $('#cod_estado_reporte_venta_registrar').val('0'); $('#cod_estado_reporte_venta_registrar').prop('checked',false); } 
if (cod_estado_reporte_venta_editar=='1') { $('#cod_estado_reporte_venta_editar').val('1'); $('#cod_estado_reporte_venta_editar').prop('checked',true); } else { $('#cod_estado_reporte_venta_editar').val('0'); $('#cod_estado_reporte_venta_editar').prop('checked',false); } 
if (cod_estado_reporte_venta_eliminar=='1') { $('#cod_estado_reporte_venta_eliminar').val('1'); $('#cod_estado_reporte_venta_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_venta_eliminar').val('0'); $('#cod_estado_reporte_venta_eliminar').prop('checked',false); } 
if (cod_estado_reporte_venta_imprimir=='1') { $('#cod_estado_reporte_venta_imprimir').val('1'); $('#cod_estado_reporte_venta_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_venta_imprimir').val('0'); $('#cod_estado_reporte_venta_imprimir').prop('checked',false); } 
if (cod_estado_reporte_venta_exportar=='1') { $('#cod_estado_reporte_venta_exportar').val('1'); $('#cod_estado_reporte_venta_exportar').prop('checked',true); } else { $('#cod_estado_reporte_venta_exportar').val('0'); $('#cod_estado_reporte_venta_exportar').prop('checked',false); } 
if (cod_estado_reporte_compra=='1') { $('#cod_estado_reporte_compra').val('1'); $('#cod_estado_reporte_compra').prop('checked',true); } else { $('#cod_estado_reporte_compra').val('0'); $('#cod_estado_reporte_compra').prop('checked',false); } 
if (cod_estado_reporte_compra_registrar=='1') { $('#cod_estado_reporte_compra_registrar').val('1'); $('#cod_estado_reporte_compra_registrar').prop('checked',true); } else { $('#cod_estado_reporte_compra_registrar').val('0'); $('#cod_estado_reporte_compra_registrar').prop('checked',false); } 
if (cod_estado_reporte_compra_editar=='1') { $('#cod_estado_reporte_compra_editar').val('1'); $('#cod_estado_reporte_compra_editar').prop('checked',true); } else { $('#cod_estado_reporte_compra_editar').val('0'); $('#cod_estado_reporte_compra_editar').prop('checked',false); } 
if (cod_estado_reporte_compra_eliminar=='1') { $('#cod_estado_reporte_compra_eliminar').val('1'); $('#cod_estado_reporte_compra_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_compra_eliminar').val('0'); $('#cod_estado_reporte_compra_eliminar').prop('checked',false); } 
if (cod_estado_reporte_compra_imprimir=='1') { $('#cod_estado_reporte_compra_imprimir').val('1'); $('#cod_estado_reporte_compra_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_compra_imprimir').val('0'); $('#cod_estado_reporte_compra_imprimir').prop('checked',false); } 
if (cod_estado_reporte_compra_exportar=='1') { $('#cod_estado_reporte_compra_exportar').val('1'); $('#cod_estado_reporte_compra_exportar').prop('checked',true); } else { $('#cod_estado_reporte_compra_exportar').val('0'); $('#cod_estado_reporte_compra_exportar').prop('checked',false); } 
if (cod_estado_reporte_general=='1') { $('#cod_estado_reporte_general').val('1'); $('#cod_estado_reporte_general').prop('checked',true); } else { $('#cod_estado_reporte_general').val('0'); $('#cod_estado_reporte_general').prop('checked',false); } 
if (cod_estado_reporte_general_registrar=='1') { $('#cod_estado_reporte_general_registrar').val('1'); $('#cod_estado_reporte_general_registrar').prop('checked',true); } else { $('#cod_estado_reporte_general_registrar').val('0'); $('#cod_estado_reporte_general_registrar').prop('checked',false); } 
if (cod_estado_reporte_general_editar=='1') { $('#cod_estado_reporte_general_editar').val('1'); $('#cod_estado_reporte_general_editar').prop('checked',true); } else { $('#cod_estado_reporte_general_editar').val('0'); $('#cod_estado_reporte_general_editar').prop('checked',false); } 
if (cod_estado_reporte_general_eliminar=='1') { $('#cod_estado_reporte_general_eliminar').val('1'); $('#cod_estado_reporte_general_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_general_eliminar').val('0'); $('#cod_estado_reporte_general_eliminar').prop('checked',false); } 
if (cod_estado_reporte_general_imprimir=='1') { $('#cod_estado_reporte_general_imprimir').val('1'); $('#cod_estado_reporte_general_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_general_imprimir').val('0'); $('#cod_estado_reporte_general_imprimir').prop('checked',false); } 
if (cod_estado_reporte_general_exportar=='1') { $('#cod_estado_reporte_general_exportar').val('1'); $('#cod_estado_reporte_general_exportar').prop('checked',true); } else { $('#cod_estado_reporte_general_exportar').val('0'); $('#cod_estado_reporte_general_exportar').prop('checked',false); } 
if (cod_estado_reporte_mov_contable=='1') { $('#cod_estado_reporte_mov_contable').val('1'); $('#cod_estado_reporte_mov_contable').prop('checked',true); } else { $('#cod_estado_reporte_mov_contable').val('0'); $('#cod_estado_reporte_mov_contable').prop('checked',false); } 
if (cod_estado_reporte_mov_contable_registrar=='1') { $('#cod_estado_reporte_mov_contable_registrar').val('1'); $('#cod_estado_reporte_mov_contable_registrar').prop('checked',true); } else { $('#cod_estado_reporte_mov_contable_registrar').val('0'); $('#cod_estado_reporte_mov_contable_registrar').prop('checked',false); } 
if (cod_estado_reporte_mov_contable_editar=='1') { $('#cod_estado_reporte_mov_contable_editar').val('1'); $('#cod_estado_reporte_mov_contable_editar').prop('checked',true); } else { $('#cod_estado_reporte_mov_contable_editar').val('0'); $('#cod_estado_reporte_mov_contable_editar').prop('checked',false); } 
if (cod_estado_reporte_mov_contable_eliminar=='1') { $('#cod_estado_reporte_mov_contable_eliminar').val('1'); $('#cod_estado_reporte_mov_contable_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_mov_contable_eliminar').val('0'); $('#cod_estado_reporte_mov_contable_eliminar').prop('checked',false); } 
if (cod_estado_reporte_mov_contable_imprimir=='1') { $('#cod_estado_reporte_mov_contable_imprimir').val('1'); $('#cod_estado_reporte_mov_contable_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_mov_contable_imprimir').val('0'); $('#cod_estado_reporte_mov_contable_imprimir').prop('checked',false); } 
if (cod_estado_reporte_mov_contable_exportar=='1') { $('#cod_estado_reporte_mov_contable_exportar').val('1'); $('#cod_estado_reporte_mov_contable_exportar').prop('checked',true); } else { $('#cod_estado_reporte_mov_contable_exportar').val('0'); $('#cod_estado_reporte_mov_contable_exportar').prop('checked',false); } 
if (cod_estado_reporte_venta_por_producto=='1') { $('#cod_estado_reporte_venta_por_producto').val('1'); $('#cod_estado_reporte_venta_por_producto').prop('checked',true); } else { $('#cod_estado_reporte_venta_por_producto').val('0'); $('#cod_estado_reporte_venta_por_producto').prop('checked',false); } 
if (cod_estado_reporte_venta_por_producto_registrar=='1') { $('#cod_estado_reporte_venta_por_producto_registrar').val('1'); $('#cod_estado_reporte_venta_por_producto_registrar').prop('checked',true); } else { $('#cod_estado_reporte_venta_por_producto_registrar').val('0'); $('#cod_estado_reporte_venta_por_producto_registrar').prop('checked',false); } 
if (cod_estado_reporte_venta_por_producto_editar=='1') { $('#cod_estado_reporte_venta_por_producto_editar').val('1'); $('#cod_estado_reporte_venta_por_producto_editar').prop('checked',true); } else { $('#cod_estado_reporte_venta_por_producto_editar').val('0'); $('#cod_estado_reporte_venta_por_producto_editar').prop('checked',false); } 
if (cod_estado_reporte_venta_por_producto_eliminar=='1') { $('#cod_estado_reporte_venta_por_producto_eliminar').val('1'); $('#cod_estado_reporte_venta_por_producto_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_venta_por_producto_eliminar').val('0'); $('#cod_estado_reporte_venta_por_producto_eliminar').prop('checked',false); } 
if (cod_estado_reporte_venta_por_producto_imprimir=='1') { $('#cod_estado_reporte_venta_por_producto_imprimir').val('1'); $('#cod_estado_reporte_venta_por_producto_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_venta_por_producto_imprimir').val('0'); $('#cod_estado_reporte_venta_por_producto_imprimir').prop('checked',false); } 
if (cod_estado_reporte_venta_por_producto_exportar=='1') { $('#cod_estado_reporte_venta_por_producto_exportar').val('1'); $('#cod_estado_reporte_venta_por_producto_exportar').prop('checked',true); } else { $('#cod_estado_reporte_venta_por_producto_exportar').val('0'); $('#cod_estado_reporte_venta_por_producto_exportar').prop('checked',false); } 
if (cod_estado_reporte_inventario=='1') { $('#cod_estado_reporte_inventario').val('1'); $('#cod_estado_reporte_inventario').prop('checked',true); } else { $('#cod_estado_reporte_inventario').val('0'); $('#cod_estado_reporte_inventario').prop('checked',false); } 
if (cod_estado_reporte_inventario_registrar=='1') { $('#cod_estado_reporte_inventario_registrar').val('1'); $('#cod_estado_reporte_inventario_registrar').prop('checked',true); } else { $('#cod_estado_reporte_inventario_registrar').val('0'); $('#cod_estado_reporte_inventario_registrar').prop('checked',false); } 
if (cod_estado_reporte_inventario_editar=='1') { $('#cod_estado_reporte_inventario_editar').val('1'); $('#cod_estado_reporte_inventario_editar').prop('checked',true); } else { $('#cod_estado_reporte_inventario_editar').val('0'); $('#cod_estado_reporte_inventario_editar').prop('checked',false); } 
if (cod_estado_reporte_inventario_eliminar=='1') { $('#cod_estado_reporte_inventario_eliminar').val('1'); $('#cod_estado_reporte_inventario_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_inventario_eliminar').val('0'); $('#cod_estado_reporte_inventario_eliminar').prop('checked',false); } 
if (cod_estado_reporte_inventario_imprimir=='1') { $('#cod_estado_reporte_inventario_imprimir').val('1'); $('#cod_estado_reporte_inventario_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_inventario_imprimir').val('0'); $('#cod_estado_reporte_inventario_imprimir').prop('checked',false); } 
if (cod_estado_reporte_inventario_exportar=='1') { $('#cod_estado_reporte_inventario_exportar').val('1'); $('#cod_estado_reporte_inventario_exportar').prop('checked',true); } else { $('#cod_estado_reporte_inventario_exportar').val('0'); $('#cod_estado_reporte_inventario_exportar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_vencer=='1') { $('#cod_estado_reporte_prodcuto_vencer').val('1'); $('#cod_estado_reporte_prodcuto_vencer').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_vencer').val('0'); $('#cod_estado_reporte_prodcuto_vencer').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_vencer_registrar=='1') { $('#cod_estado_reporte_prodcuto_vencer_registrar').val('1'); $('#cod_estado_reporte_prodcuto_vencer_registrar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_vencer_registrar').val('0'); $('#cod_estado_reporte_prodcuto_vencer_registrar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_vencer_editar=='1') { $('#cod_estado_reporte_prodcuto_vencer_editar').val('1'); $('#cod_estado_reporte_prodcuto_vencer_editar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_vencer_editar').val('0'); $('#cod_estado_reporte_prodcuto_vencer_editar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_vencer_eliminar=='1') { $('#cod_estado_reporte_prodcuto_vencer_eliminar').val('1'); $('#cod_estado_reporte_prodcuto_vencer_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_vencer_eliminar').val('0'); $('#cod_estado_reporte_prodcuto_vencer_eliminar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_vencer_imprimir=='1') { $('#cod_estado_reporte_prodcuto_vencer_imprimir').val('1'); $('#cod_estado_reporte_prodcuto_vencer_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_vencer_imprimir').val('0'); $('#cod_estado_reporte_prodcuto_vencer_imprimir').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_vencer_exportar=='1') { $('#cod_estado_reporte_prodcuto_vencer_exportar').val('1'); $('#cod_estado_reporte_prodcuto_vencer_exportar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_vencer_exportar').val('0'); $('#cod_estado_reporte_prodcuto_vencer_exportar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_mantenimiento=='1') { $('#cod_estado_reporte_prodcuto_mantenimiento').val('1'); $('#cod_estado_reporte_prodcuto_mantenimiento').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_mantenimiento').val('0'); $('#cod_estado_reporte_prodcuto_mantenimiento').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_mantenimiento_registrar=='1') { $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').val('1'); $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').val('0'); $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_mantenimiento_editar=='1') { $('#cod_estado_reporte_prodcuto_mantenimiento_editar').val('1'); $('#cod_estado_reporte_prodcuto_mantenimiento_editar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_editar').val('0'); $('#cod_estado_reporte_prodcuto_mantenimiento_editar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_mantenimiento_eliminar=='1') { $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').val('1'); $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').val('0'); $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_mantenimiento_imprimir=='1') { $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').val('1'); $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').val('0'); $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').prop('checked',false); } 
if (cod_estado_reporte_prodcuto_mantenimiento_exportar=='1') { $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').val('1'); $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').prop('checked',true); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').val('0'); $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').prop('checked',false); } 
if (cod_estado_reporte_cumplanos_tercero=='1') { $('#cod_estado_reporte_cumplanos_tercero').val('1'); $('#cod_estado_reporte_cumplanos_tercero').prop('checked',true); } else { $('#cod_estado_reporte_cumplanos_tercero').val('0'); $('#cod_estado_reporte_cumplanos_tercero').prop('checked',false); } 
if (cod_estado_reporte_cumplanos_tercero_registrar=='1') { $('#cod_estado_reporte_cumplanos_tercero_registrar').val('1'); $('#cod_estado_reporte_cumplanos_tercero_registrar').prop('checked',true); } else { $('#cod_estado_reporte_cumplanos_tercero_registrar').val('0'); $('#cod_estado_reporte_cumplanos_tercero_registrar').prop('checked',false); } 
if (cod_estado_reporte_cumplanos_tercero_editar=='1') { $('#cod_estado_reporte_cumplanos_tercero_editar').val('1'); $('#cod_estado_reporte_cumplanos_tercero_editar').prop('checked',true); } else { $('#cod_estado_reporte_cumplanos_tercero_editar').val('0'); $('#cod_estado_reporte_cumplanos_tercero_editar').prop('checked',false); } 
if (cod_estado_reporte_cumplanos_tercero_eliminar=='1') { $('#cod_estado_reporte_cumplanos_tercero_eliminar').val('1'); $('#cod_estado_reporte_cumplanos_tercero_eliminar').prop('checked',true); } else { $('#cod_estado_reporte_cumplanos_tercero_eliminar').val('0'); $('#cod_estado_reporte_cumplanos_tercero_eliminar').prop('checked',false); } 
if (cod_estado_reporte_cumplanos_tercero_imprimir=='1') { $('#cod_estado_reporte_cumplanos_tercero_imprimir').val('1'); $('#cod_estado_reporte_cumplanos_tercero_imprimir').prop('checked',true); } else { $('#cod_estado_reporte_cumplanos_tercero_imprimir').val('0'); $('#cod_estado_reporte_cumplanos_tercero_imprimir').prop('checked',false); } 
if (cod_estado_reporte_cumplanos_tercero_exportar=='1') { $('#cod_estado_reporte_cumplanos_tercero_exportar').val('1'); $('#cod_estado_reporte_cumplanos_tercero_exportar').prop('checked',true); } else { $('#cod_estado_reporte_cumplanos_tercero_exportar').val('0'); $('#cod_estado_reporte_cumplanos_tercero_exportar').prop('checked',false); } 
if (cod_estado_admin=='1') { $('#cod_estado_admin').val('1'); $('#cod_estado_admin').prop('checked',true); } else { $('#cod_estado_admin').val('0'); $('#cod_estado_admin').prop('checked',false); } 
if (cod_estado_info_empresa=='1') { $('#cod_estado_info_empresa').val('1'); $('#cod_estado_info_empresa').prop('checked',true); } else { $('#cod_estado_info_empresa').val('0'); $('#cod_estado_info_empresa').prop('checked',false); } 
if (cod_estado_info_empresa_registrar=='1') { $('#cod_estado_info_empresa_registrar').val('1'); $('#cod_estado_info_empresa_registrar').prop('checked',true); } else { $('#cod_estado_info_empresa_registrar').val('0'); $('#cod_estado_info_empresa_registrar').prop('checked',false); } 
if (cod_estado_info_empresa_editar=='1') { $('#cod_estado_info_empresa_editar').val('1'); $('#cod_estado_info_empresa_editar').prop('checked',true); } else { $('#cod_estado_info_empresa_editar').val('0'); $('#cod_estado_info_empresa_editar').prop('checked',false); } 
if (cod_estado_info_empresa_eliminar=='1') { $('#cod_estado_info_empresa_eliminar').val('1'); $('#cod_estado_info_empresa_eliminar').prop('checked',true); } else { $('#cod_estado_info_empresa_eliminar').val('0'); $('#cod_estado_info_empresa_eliminar').prop('checked',false); } 
if (cod_estado_info_empresa_imprimir=='1') { $('#cod_estado_info_empresa_imprimir').val('1'); $('#cod_estado_info_empresa_imprimir').prop('checked',true); } else { $('#cod_estado_info_empresa_imprimir').val('0'); $('#cod_estado_info_empresa_imprimir').prop('checked',false); } 
if (cod_estado_info_empresa_exportar=='1') { $('#cod_estado_info_empresa_exportar').val('1'); $('#cod_estado_info_empresa_exportar').prop('checked',true); } else { $('#cod_estado_info_empresa_exportar').val('0'); $('#cod_estado_info_empresa_exportar').prop('checked',false); } 
if (cod_estado_usuario=='1') { $('#cod_estado_usuario').val('1'); $('#cod_estado_usuario').prop('checked',true); } else { $('#cod_estado_usuario').val('0'); $('#cod_estado_usuario').prop('checked',false); } 
if (cod_estado_usuario_registrar=='1') { $('#cod_estado_usuario_registrar').val('1'); $('#cod_estado_usuario_registrar').prop('checked',true); } else { $('#cod_estado_usuario_registrar').val('0'); $('#cod_estado_usuario_registrar').prop('checked',false); } 
if (cod_estado_usuario_editar=='1') { $('#cod_estado_usuario_editar').val('1'); $('#cod_estado_usuario_editar').prop('checked',true); } else { $('#cod_estado_usuario_editar').val('0'); $('#cod_estado_usuario_editar').prop('checked',false); } 
if (cod_estado_usuario_eliminar=='1') { $('#cod_estado_usuario_eliminar').val('1'); $('#cod_estado_usuario_eliminar').prop('checked',true); } else { $('#cod_estado_usuario_eliminar').val('0'); $('#cod_estado_usuario_eliminar').prop('checked',false); } 
if (cod_estado_usuario_imprimir=='1') { $('#cod_estado_usuario_imprimir').val('1'); $('#cod_estado_usuario_imprimir').prop('checked',true); } else { $('#cod_estado_usuario_imprimir').val('0'); $('#cod_estado_usuario_imprimir').prop('checked',false); } 
if (cod_estado_usuario_exportar=='1') { $('#cod_estado_usuario_exportar').val('1'); $('#cod_estado_usuario_exportar').prop('checked',true); } else { $('#cod_estado_usuario_exportar').val('0'); $('#cod_estado_usuario_exportar').prop('checked',false); } 
if (cod_estado_dependencia=='1') { $('#cod_estado_dependencia').val('1'); $('#cod_estado_dependencia').prop('checked',true); } else { $('#cod_estado_dependencia').val('0'); $('#cod_estado_dependencia').prop('checked',false); } 
if (cod_estado_dependencia_registrar=='1') { $('#cod_estado_dependencia_registrar').val('1'); $('#cod_estado_dependencia_registrar').prop('checked',true); } else { $('#cod_estado_dependencia_registrar').val('0'); $('#cod_estado_dependencia_registrar').prop('checked',false); } 
if (cod_estado_dependencia_editar=='1') { $('#cod_estado_dependencia_editar').val('1'); $('#cod_estado_dependencia_editar').prop('checked',true); } else { $('#cod_estado_dependencia_editar').val('0'); $('#cod_estado_dependencia_editar').prop('checked',false); } 
if (cod_estado_dependencia_eliminar=='1') { $('#cod_estado_dependencia_eliminar').val('1'); $('#cod_estado_dependencia_eliminar').prop('checked',true); } else { $('#cod_estado_dependencia_eliminar').val('0'); $('#cod_estado_dependencia_eliminar').prop('checked',false); } 
if (cod_estado_dependencia_imprimir=='1') { $('#cod_estado_dependencia_imprimir').val('1'); $('#cod_estado_dependencia_imprimir').prop('checked',true); } else { $('#cod_estado_dependencia_imprimir').val('0'); $('#cod_estado_dependencia_imprimir').prop('checked',false); } 
if (cod_estado_dependencia_exportar=='1') { $('#cod_estado_dependencia_exportar').val('1'); $('#cod_estado_dependencia_exportar').prop('checked',true); } else { $('#cod_estado_dependencia_exportar').val('0'); $('#cod_estado_dependencia_exportar').prop('checked',false); } 
if (cod_estado_resol_facturacion=='1') { $('#cod_estado_resol_facturacion').val('1'); $('#cod_estado_resol_facturacion').prop('checked',true); } else { $('#cod_estado_resol_facturacion').val('0'); $('#cod_estado_resol_facturacion').prop('checked',false); } 
if (cod_estado_resol_facturacion_registrar=='1') { $('#cod_estado_resol_facturacion_registrar').val('1'); $('#cod_estado_resol_facturacion_registrar').prop('checked',true); } else { $('#cod_estado_resol_facturacion_registrar').val('0'); $('#cod_estado_resol_facturacion_registrar').prop('checked',false); } 
if (cod_estado_resol_facturacion_editar=='1') { $('#cod_estado_resol_facturacion_editar').val('1'); $('#cod_estado_resol_facturacion_editar').prop('checked',true); } else { $('#cod_estado_resol_facturacion_editar').val('0'); $('#cod_estado_resol_facturacion_editar').prop('checked',false); } 
if (cod_estado_resol_facturacion_eliminar=='1') { $('#cod_estado_resol_facturacion_eliminar').val('1'); $('#cod_estado_resol_facturacion_eliminar').prop('checked',true); } else { $('#cod_estado_resol_facturacion_eliminar').val('0'); $('#cod_estado_resol_facturacion_eliminar').prop('checked',false); } 
if (cod_estado_resol_facturacion_imprimir=='1') { $('#cod_estado_resol_facturacion_imprimir').val('1'); $('#cod_estado_resol_facturacion_imprimir').prop('checked',true); } else { $('#cod_estado_resol_facturacion_imprimir').val('0'); $('#cod_estado_resol_facturacion_imprimir').prop('checked',false); } 
if (cod_estado_resol_facturacion_exportar=='1') { $('#cod_estado_resol_facturacion_exportar').val('1'); $('#cod_estado_resol_facturacion_exportar').prop('checked',true); } else { $('#cod_estado_resol_facturacion_exportar').val('0'); $('#cod_estado_resol_facturacion_exportar').prop('checked',false); } 
if (cod_estado_numero_letras=='1') { $('#cod_estado_numero_letras').val('1'); $('#cod_estado_numero_letras').prop('checked',true); } else { $('#cod_estado_numero_letras').val('0'); $('#cod_estado_numero_letras').prop('checked',false); } 
if (cod_estado_numero_letras_registrar=='1') { $('#cod_estado_numero_letras_registrar').val('1'); $('#cod_estado_numero_letras_registrar').prop('checked',true); } else { $('#cod_estado_numero_letras_registrar').val('0'); $('#cod_estado_numero_letras_registrar').prop('checked',false); } 
if (cod_estado_numero_letras_editar=='1') { $('#cod_estado_numero_letras_editar').val('1'); $('#cod_estado_numero_letras_editar').prop('checked',true); } else { $('#cod_estado_numero_letras_editar').val('0'); $('#cod_estado_numero_letras_editar').prop('checked',false); } 
if (cod_estado_numero_letras_eliminar=='1') { $('#cod_estado_numero_letras_eliminar').val('1'); $('#cod_estado_numero_letras_eliminar').prop('checked',true); } else { $('#cod_estado_numero_letras_eliminar').val('0'); $('#cod_estado_numero_letras_eliminar').prop('checked',false); } 
if (cod_estado_numero_letras_imprimir=='1') { $('#cod_estado_numero_letras_imprimir').val('1'); $('#cod_estado_numero_letras_imprimir').prop('checked',true); } else { $('#cod_estado_numero_letras_imprimir').val('0'); $('#cod_estado_numero_letras_imprimir').prop('checked',false); } 
if (cod_estado_numero_letras_exportar=='1') { $('#cod_estado_numero_letras_exportar').val('1'); $('#cod_estado_numero_letras_exportar').prop('checked',true); } else { $('#cod_estado_numero_letras_exportar').val('0'); $('#cod_estado_numero_letras_exportar').prop('checked',false); } 
if (cod_estado_eliminar=='1') { $('#cod_estado_eliminar').val('1'); $('#cod_estado_eliminar').prop('checked',true); } else { $('#cod_estado_eliminar').val('0'); $('#cod_estado_eliminar').prop('checked',false); } 
if (cod_estado_eliminar_usuario=='1') { $('#cod_estado_eliminar_usuario').val('1'); $('#cod_estado_eliminar_usuario').prop('checked',true); } else { $('#cod_estado_eliminar_usuario').val('0'); $('#cod_estado_eliminar_usuario').prop('checked',false); } 
if (cod_estado_eliminar_tercero=='1') { $('#cod_estado_eliminar_tercero').val('1'); $('#cod_estado_eliminar_tercero').prop('checked',true); } else { $('#cod_estado_eliminar_tercero').val('0'); $('#cod_estado_eliminar_tercero').prop('checked',false); } 
if (cod_estado_eliminar_producto=='1') { $('#cod_estado_eliminar_producto').val('1'); $('#cod_estado_eliminar_producto').prop('checked',true); } else { $('#cod_estado_eliminar_producto').val('0'); $('#cod_estado_eliminar_producto').prop('checked',false); } 
if (cod_estado_licencia=='1') { $('#cod_estado_licencia').val('1'); $('#cod_estado_licencia').prop('checked',true); } else { $('#cod_estado_licencia').val('0'); $('#cod_estado_licencia').prop('checked',false); } 
if (cod_estado_licencia_registrar=='1') { $('#cod_estado_licencia_registrar').val('1'); $('#cod_estado_licencia_registrar').prop('checked',true); } else { $('#cod_estado_licencia_registrar').val('0'); $('#cod_estado_licencia_registrar').prop('checked',false); } 
if (cod_estado_licencia_editar=='1') { $('#cod_estado_licencia_editar').val('1'); $('#cod_estado_licencia_editar').prop('checked',true); } else { $('#cod_estado_licencia_editar').val('0'); $('#cod_estado_licencia_editar').prop('checked',false); } 
if (cod_estado_licencia_imprimir=='1') { $('#cod_estado_licencia_imprimir').val('1'); $('#cod_estado_licencia_imprimir').prop('checked',true); } else { $('#cod_estado_licencia_imprimir').val('0'); $('#cod_estado_licencia_imprimir').prop('checked',false); } 
if (cod_estado_licencia_exportar=='1') { $('#cod_estado_licencia_exportar').val('1'); $('#cod_estado_licencia_exportar').prop('checked',true); } else { $('#cod_estado_licencia_exportar').val('0'); $('#cod_estado_licencia_exportar').prop('checked',false); } 
if (cod_estado_repositorio=='1') { $('#cod_estado_repositorio').val('1'); $('#cod_estado_repositorio').prop('checked',true); } else { $('#cod_estado_repositorio').val('0'); $('#cod_estado_repositorio').prop('checked',false); } 
if (cod_estado_repositorio_registrar=='1') { $('#cod_estado_repositorio_registrar').val('1'); $('#cod_estado_repositorio_registrar').prop('checked',true); } else { $('#cod_estado_repositorio_registrar').val('0'); $('#cod_estado_repositorio_registrar').prop('checked',false); } 
if (cod_estado_repositorio_editar=='1') { $('#cod_estado_repositorio_editar').val('1'); $('#cod_estado_repositorio_editar').prop('checked',true); } else { $('#cod_estado_repositorio_editar').val('0'); $('#cod_estado_repositorio_editar').prop('checked',false); } 
if (cod_estado_repositorio_eliminar=='1') { $('#cod_estado_repositorio_eliminar').val('1'); $('#cod_estado_repositorio_eliminar').prop('checked',true); } else { $('#cod_estado_repositorio_eliminar').val('0'); $('#cod_estado_repositorio_eliminar').prop('checked',false); } 
if (cod_estado_repositorio_imprimir=='1') { $('#cod_estado_repositorio_imprimir').val('1'); $('#cod_estado_repositorio_imprimir').prop('checked',true); } else { $('#cod_estado_repositorio_imprimir').val('0'); $('#cod_estado_repositorio_imprimir').prop('checked',false); } 
if (cod_estado_repositorio_exportar=='1') { $('#cod_estado_repositorio_exportar').val('1'); $('#cod_estado_repositorio_exportar').prop('checked',true); } else { $('#cod_estado_repositorio_exportar').val('0'); $('#cod_estado_repositorio_exportar').prop('checked',false); } 
if (cod_estado_prod_subproducto_editar=='1') { $('#cod_estado_prod_subproducto_editar').val('1'); $('#cod_estado_prod_subproducto_editar').prop('checked',true); } else { $('#cod_estado_prod_subproducto_editar').val('0'); $('#cod_estado_prod_subproducto_editar').prop('checked',false); } 
if (cod_estado_prod_subproducto_eliminar=='1') { $('#cod_estado_prod_subproducto_eliminar').val('1'); $('#cod_estado_prod_subproducto_eliminar').prop('checked',true); } else { $('#cod_estado_prod_subproducto_eliminar').val('0'); $('#cod_estado_prod_subproducto_eliminar').prop('checked',false); } 
if (cod_estado_prod_subproducto_imprimir=='1') { $('#cod_estado_prod_subproducto_imprimir').val('1'); $('#cod_estado_prod_subproducto_imprimir').prop('checked',true); } else { $('#cod_estado_prod_subproducto_imprimir').val('0'); $('#cod_estado_prod_subproducto_imprimir').prop('checked',false); } 
if (cod_estado_prod_subproducto_exportar=='1') { $('#cod_estado_prod_subproducto_exportar').val('1'); $('#cod_estado_prod_subproducto_exportar').prop('checked',true); } else { $('#cod_estado_prod_subproducto_exportar').val('0'); $('#cod_estado_prod_subproducto_exportar').prop('checked',false); } 
if (cod_estado_prod_transferencia_registrar=='1') { $('#cod_estado_prod_transferencia_registrar').val('1'); $('#cod_estado_prod_transferencia_registrar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_registrar').val('0'); $('#cod_estado_prod_transferencia_registrar').prop('checked',false); } 
if (cod_estado_prod_transferencia_editar=='1') { $('#cod_estado_prod_transferencia_editar').val('1'); $('#cod_estado_prod_transferencia_editar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_editar').val('0'); $('#cod_estado_prod_transferencia_editar').prop('checked',false); } 
if (cod_estado_prod_transferencia_eliminar=='1') { $('#cod_estado_prod_transferencia_eliminar').val('1'); $('#cod_estado_prod_transferencia_eliminar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_eliminar').val('0'); $('#cod_estado_prod_transferencia_eliminar').prop('checked',false); } 
if (cod_estado_prod_transferencia_imprimir=='1') { $('#cod_estado_prod_transferencia_imprimir').val('1'); $('#cod_estado_prod_transferencia_imprimir').prop('checked',true); } else { $('#cod_estado_prod_transferencia_imprimir').val('0'); $('#cod_estado_prod_transferencia_imprimir').prop('checked',false); } 
if (cod_estado_prod_transferencia_exportar=='1') { $('#cod_estado_prod_transferencia_exportar').val('1'); $('#cod_estado_prod_transferencia_exportar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_exportar').val('0'); $('#cod_estado_prod_transferencia_exportar').prop('checked',false); } 
if (cod_estado_prod_auditoria_registrar=='1') { $('#cod_estado_prod_auditoria_registrar').val('1'); $('#cod_estado_prod_auditoria_registrar').prop('checked',true); } else { $('#cod_estado_prod_auditoria_registrar').val('0'); $('#cod_estado_prod_auditoria_registrar').prop('checked',false); } 
if (cod_estado_prod_auditoria_editar=='1') { $('#cod_estado_prod_auditoria_editar').val('1'); $('#cod_estado_prod_auditoria_editar').prop('checked',true); } else { $('#cod_estado_prod_auditoria_editar').val('0'); $('#cod_estado_prod_auditoria_editar').prop('checked',false); } 
if (cod_estado_prod_auditoria_eliminar=='1') { $('#cod_estado_prod_auditoria_eliminar').val('1'); $('#cod_estado_prod_auditoria_eliminar').prop('checked',true); } else { $('#cod_estado_prod_auditoria_eliminar').val('0'); $('#cod_estado_prod_auditoria_eliminar').prop('checked',false); } 
if (cod_estado_prod_auditoria_imprimir=='1') { $('#cod_estado_prod_auditoria_imprimir').val('1'); $('#cod_estado_prod_auditoria_imprimir').prop('checked',true); } else { $('#cod_estado_prod_auditoria_imprimir').val('0'); $('#cod_estado_prod_auditoria_imprimir').prop('checked',false); } 
if (cod_estado_prod_auditoria_exportar=='1') { $('#cod_estado_prod_auditoria_exportar').val('1'); $('#cod_estado_prod_auditoria_exportar').prop('checked',true); } else { $('#cod_estado_prod_auditoria_exportar').val('0'); $('#cod_estado_prod_auditoria_exportar').prop('checked',false); } 
if (cod_estado_eliminar_caja_mesa_virtual=='1') { $('#cod_estado_eliminar_caja_mesa_virtual').val('1'); $('#cod_estado_eliminar_caja_mesa_virtual').prop('checked',true); } else { $('#cod_estado_eliminar_caja_mesa_virtual').val('0'); $('#cod_estado_eliminar_caja_mesa_virtual').prop('checked',false); } 
if (cod_estado_precio_compra_mod_venta=='1') { $('#cod_estado_precio_compra_mod_venta').val('1'); $('#cod_estado_precio_compra_mod_venta').prop('checked',true); } else { $('#cod_estado_precio_compra_mod_venta').val('0'); $('#cod_estado_precio_compra_mod_venta').prop('checked',false); } 
if (cod_estado_deshabilitar_opc_eliminar_ventatemp=='1') { $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').val('1'); $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').prop('checked',true); } else { $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').val('0'); $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').prop('checked',false); } 
if (cod_estado_habilitar_btn_facturar_mod_venta=='1') { $('#cod_estado_habilitar_btn_facturar_mod_venta').val('1'); $('#cod_estado_habilitar_btn_facturar_mod_venta').prop('checked',true); } else { $('#cod_estado_habilitar_btn_facturar_mod_venta').val('0'); $('#cod_estado_habilitar_btn_facturar_mod_venta').prop('checked',false); } 
if (cod_estado_seguridad=='1') { $('#cod_estado_seguridad').val('1'); $('#cod_estado_seguridad').prop('checked',true); } else { $('#cod_estado_seguridad').val('0'); $('#cod_estado_seguridad').prop('checked',false); } 
if (cod_estado_seguridad_registrar=='1') { $('#cod_estado_seguridad_registrar').val('1'); $('#cod_estado_seguridad_registrar').prop('checked',true); } else { $('#cod_estado_seguridad_registrar').val('0'); $('#cod_estado_seguridad_registrar').prop('checked',false); } 
if (cod_estado_seguridad_editar=='1') { $('#cod_estado_seguridad_editar').val('1'); $('#cod_estado_seguridad_editar').prop('checked',true); } else { $('#cod_estado_seguridad_editar').val('0'); $('#cod_estado_seguridad_editar').prop('checked',false); } 
if (cod_estado_seguridad_eliminar=='1') { $('#cod_estado_seguridad_eliminar').val('1'); $('#cod_estado_seguridad_eliminar').prop('checked',true); } else { $('#cod_estado_seguridad_eliminar').val('0'); $('#cod_estado_seguridad_eliminar').prop('checked',false); } 
if (cod_estado_seguridad_imprimir=='1') { $('#cod_estado_seguridad_imprimir').val('1'); $('#cod_estado_seguridad_imprimir').prop('checked',true); } else { $('#cod_estado_seguridad_imprimir').val('0'); $('#cod_estado_seguridad_imprimir').prop('checked',false); } 
if (cod_estado_seguridad_exportar=='1') { $('#cod_estado_seguridad_exportar').val('1'); $('#cod_estado_seguridad_exportar').prop('checked',true); } else { $('#cod_estado_seguridad_exportar').val('0'); $('#cod_estado_seguridad_exportar').prop('checked',false); } 
if (cod_estado_grafico_estadistico=='1') { $('#cod_estado_grafico_estadistico').val('1'); $('#cod_estado_grafico_estadistico').prop('checked',true); } else { $('#cod_estado_grafico_estadistico').val('0'); $('#cod_estado_grafico_estadistico').prop('checked',false); } 
if (cod_estado_grafico_estadistico_registrar=='1') { $('#cod_estado_grafico_estadistico_registrar').val('1'); $('#cod_estado_grafico_estadistico_registrar').prop('checked',true); } else { $('#cod_estado_grafico_estadistico_registrar').val('0'); $('#cod_estado_grafico_estadistico_registrar').prop('checked',false); } 
if (cod_estado_grafico_estadistico_editar=='1') { $('#cod_estado_grafico_estadistico_editar').val('1'); $('#cod_estado_grafico_estadistico_editar').prop('checked',true); } else { $('#cod_estado_grafico_estadistico_editar').val('0'); $('#cod_estado_grafico_estadistico_editar').prop('checked',false); } 
if (cod_estado_grafico_estadistico_eliminar=='1') { $('#cod_estado_grafico_estadistico_eliminar').val('1'); $('#cod_estado_grafico_estadistico_eliminar').prop('checked',true); } else { $('#cod_estado_grafico_estadistico_eliminar').val('0'); $('#cod_estado_grafico_estadistico_eliminar').prop('checked',false); } 
if (cod_estado_grafico_estadistico_imprimir=='1') { $('#cod_estado_grafico_estadistico_imprimir').val('1'); $('#cod_estado_grafico_estadistico_imprimir').prop('checked',true); } else { $('#cod_estado_grafico_estadistico_imprimir').val('0'); $('#cod_estado_grafico_estadistico_imprimir').prop('checked',false); } 
if (cod_estado_grafico_estadistico_exportar=='1') { $('#cod_estado_grafico_estadistico_exportar').val('1'); $('#cod_estado_grafico_estadistico_exportar').prop('checked',true); } else { $('#cod_estado_grafico_estadistico_exportar').val('0'); $('#cod_estado_grafico_estadistico_exportar').prop('checked',false); } 
if (cod_estado_nota_observacion=='1') { $('#cod_estado_nota_observacion').val('1'); $('#cod_estado_nota_observacion').prop('checked',true); } else { $('#cod_estado_nota_observacion').val('0'); $('#cod_estado_nota_observacion').prop('checked',false); } 
if (cod_estado_nota_observacion_eliminar=='1') { $('#cod_estado_nota_observacion_eliminar').val('1'); $('#cod_estado_nota_observacion_eliminar').prop('checked',true); } else { $('#cod_estado_nota_observacion_eliminar').val('0'); $('#cod_estado_nota_observacion_eliminar').prop('checked',false); } 
if (cod_estado_nota_observacion_registrar=='1') { $('#cod_estado_nota_observacion_registrar').val('1'); $('#cod_estado_nota_observacion_registrar').prop('checked',true); } else { $('#cod_estado_nota_observacion_registrar').val('0'); $('#cod_estado_nota_observacion_registrar').prop('checked',false); } 
if (cod_estado_nota_observacion_editar=='1') { $('#cod_estado_nota_observacion_editar').val('1'); $('#cod_estado_nota_observacion_editar').prop('checked',true); } else { $('#cod_estado_nota_observacion_editar').val('0'); $('#cod_estado_nota_observacion_editar').prop('checked',false); } 
if (cod_estado_nota_observacion_imprimir=='1') { $('#cod_estado_nota_observacion_imprimir').val('1'); $('#cod_estado_nota_observacion_imprimir').prop('checked',true); } else { $('#cod_estado_nota_observacion_imprimir').val('0'); $('#cod_estado_nota_observacion_imprimir').prop('checked',false); } 
if (cod_estado_nota_observacion_exportar=='1') { $('#cod_estado_nota_observacion_exportar').val('1'); $('#cod_estado_nota_observacion_exportar').prop('checked',true); } else { $('#cod_estado_nota_observacion_exportar').val('0'); $('#cod_estado_nota_observacion_exportar').prop('checked',false); } 
if (cod_estado_tipo_roles=='1') { $('#cod_estado_tipo_roles').val('1'); $('#cod_estado_tipo_roles').prop('checked',true); } else { $('#cod_estado_tipo_roles').val('0'); $('#cod_estado_tipo_roles').prop('checked',false); } 
if (cod_estado_tipo_roles_registrar=='1') { $('#cod_estado_tipo_roles_registrar').val('1'); $('#cod_estado_tipo_roles_registrar').prop('checked',true); } else { $('#cod_estado_tipo_roles_registrar').val('0'); $('#cod_estado_tipo_roles_registrar').prop('checked',false); } 
if (cod_estado_tipo_roles_editar=='1') { $('#cod_estado_tipo_roles_editar').val('1'); $('#cod_estado_tipo_roles_editar').prop('checked',true); } else { $('#cod_estado_tipo_roles_editar').val('0'); $('#cod_estado_tipo_roles_editar').prop('checked',false); } 
if (cod_estado_tipo_roles_eliminar=='1') { $('#cod_estado_tipo_roles_eliminar').val('1'); $('#cod_estado_tipo_roles_eliminar').prop('checked',true); } else { $('#cod_estado_tipo_roles_eliminar').val('0'); $('#cod_estado_tipo_roles_eliminar').prop('checked',false); } 
if (cod_estado_tipo_roles_imprimir=='1') { $('#cod_estado_tipo_roles_imprimir').val('1'); $('#cod_estado_tipo_roles_imprimir').prop('checked',true); } else { $('#cod_estado_tipo_roles_imprimir').val('0'); $('#cod_estado_tipo_roles_imprimir').prop('checked',false); } 
if (cod_estado_tipo_roles_exportar=='1') { $('#cod_estado_tipo_roles_exportar').val('1'); $('#cod_estado_tipo_roles_exportar').prop('checked',true); } else { $('#cod_estado_tipo_roles_exportar').val('0'); $('#cod_estado_tipo_roles_exportar').prop('checked',false); } 
if (cod_estado_agregar_productos_a_venta_facturada=='1') { $('#cod_estado_agregar_productos_a_venta_facturada').val('1'); $('#cod_estado_agregar_productos_a_venta_facturada').prop('checked',true); } else { $('#cod_estado_agregar_productos_a_venta_facturada').val('0'); $('#cod_estado_agregar_productos_a_venta_facturada').prop('checked',false); } 
if (cod_estado_eliminar_productos_a_venta_facturada=='1') { $('#cod_estado_eliminar_productos_a_venta_facturada').val('1'); $('#cod_estado_eliminar_productos_a_venta_facturada').prop('checked',true); } else { $('#cod_estado_eliminar_productos_a_venta_facturada').val('0'); $('#cod_estado_eliminar_productos_a_venta_facturada').prop('checked',false); } 
if (cod_estado_habilitar_total_venta_ventatemp=='1') { $('#cod_estado_habilitar_total_venta_ventatemp').val('1'); $('#cod_estado_habilitar_total_venta_ventatemp').prop('checked',true); } else { $('#cod_estado_habilitar_total_venta_ventatemp').val('0'); $('#cod_estado_habilitar_total_venta_ventatemp').prop('checked',false); } 
if (cod_estado_habilitar_total_venta_caja_mesa_virtual=='1') { $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').val('1'); $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').prop('checked',true); } else { $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').val('0'); $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').prop('checked',false); } 
if (cod_estado_habilitar_caja_mesa_virtual_en_uso=='1') { $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').val('1'); $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').prop('checked',true); } else { $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').val('0'); $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').prop('checked',false); } 
if (cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso=='1') { $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').val('1'); $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').prop('checked',true); } else { $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').val('0'); $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').prop('checked',false); } 
if (cod_estado_prod_inventario_producto_masivo=='1') { $('#cod_estado_prod_inventario_producto_masivo').val('1'); $('#cod_estado_prod_inventario_producto_masivo').prop('checked',true); } else { $('#cod_estado_prod_inventario_producto_masivo').val('0'); $('#cod_estado_prod_inventario_producto_masivo').prop('checked',false); } 
if (cod_estado_prod_transferencia_extern=='1') { $('#cod_estado_prod_transferencia_extern').val('1'); $('#cod_estado_prod_transferencia_extern').prop('checked',true); } else { $('#cod_estado_prod_transferencia_extern').val('0'); $('#cod_estado_prod_transferencia_extern').prop('checked',false); } 
if (cod_estado_prod_transferencia_extern_registrar=='1') { $('#cod_estado_prod_transferencia_extern_registrar').val('1'); $('#cod_estado_prod_transferencia_extern_registrar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_extern_registrar').val('0'); $('#cod_estado_prod_transferencia_extern_registrar').prop('checked',false); } 
if (cod_estado_prod_transferencia_extern_editar=='1') { $('#cod_estado_prod_transferencia_extern_editar').val('1'); $('#cod_estado_prod_transferencia_extern_editar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_extern_editar').val('0'); $('#cod_estado_prod_transferencia_extern_editar').prop('checked',false); } 
if (cod_estado_prod_transferencia_extern_eliminar=='1') { $('#cod_estado_prod_transferencia_extern_eliminar').val('1'); $('#cod_estado_prod_transferencia_extern_eliminar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_extern_eliminar').val('0'); $('#cod_estado_prod_transferencia_extern_eliminar').prop('checked',false); } 
if (cod_estado_prod_transferencia_extern_imprimir=='1') { $('#cod_estado_prod_transferencia_extern_imprimir').val('1'); $('#cod_estado_prod_transferencia_extern_imprimir').prop('checked',true); } else { $('#cod_estado_prod_transferencia_extern_imprimir').val('0'); $('#cod_estado_prod_transferencia_extern_imprimir').prop('checked',false); } 
if (cod_estado_prod_transferencia_extern_exportar=='1') { $('#cod_estado_prod_transferencia_extern_exportar').val('1'); $('#cod_estado_prod_transferencia_extern_exportar').prop('checked',true); } else { $('#cod_estado_prod_transferencia_extern_exportar').val('0'); $('#cod_estado_prod_transferencia_extern_exportar').prop('checked',false); } 
if (cod_estado_categoria=='1') { $('#cod_estado_categoria').val('1'); $('#cod_estado_categoria').prop('checked',true); } else { $('#cod_estado_categoria').val('0'); $('#cod_estado_categoria').prop('checked',false); } 
if (cod_estado_categoria_registrar=='1') { $('#cod_estado_categoria_registrar').val('1'); $('#cod_estado_categoria_registrar').prop('checked',true); } else { $('#cod_estado_categoria_registrar').val('0'); $('#cod_estado_categoria_registrar').prop('checked',false); } 
if (cod_estado_categoria_editar=='1') { $('#cod_estado_categoria_editar').val('1'); $('#cod_estado_categoria_editar').prop('checked',true); } else { $('#cod_estado_categoria_editar').val('0'); $('#cod_estado_categoria_editar').prop('checked',false); } 
if (cod_estado_categoria_eliminar=='1') { $('#cod_estado_categoria_eliminar').val('1'); $('#cod_estado_categoria_eliminar').prop('checked',true); } else { $('#cod_estado_categoria_eliminar').val('0'); $('#cod_estado_categoria_eliminar').prop('checked',false); } 
if (cod_estado_categoria_imprimir=='1') { $('#cod_estado_categoria_imprimir').val('1'); $('#cod_estado_categoria_imprimir').prop('checked',true); } else { $('#cod_estado_categoria_imprimir').val('0'); $('#cod_estado_categoria_imprimir').prop('checked',false); } 
if (cod_estado_categoria_exportar=='1') { $('#cod_estado_categoria_exportar').val('1'); $('#cod_estado_categoria_exportar').prop('checked',true); } else { $('#cod_estado_categoria_exportar').val('0'); $('#cod_estado_categoria_exportar').prop('checked',false); } 
if (cod_estado_caja_mesa=='1') { $('#cod_estado_caja_mesa').val('1'); $('#cod_estado_caja_mesa').prop('checked',true); } else { $('#cod_estado_caja_mesa').val('0'); $('#cod_estado_caja_mesa').prop('checked',false); } 
if (cod_estado_caja_mesa_registrar=='1') { $('#cod_estado_caja_mesa_registrar').val('1'); $('#cod_estado_caja_mesa_registrar').prop('checked',true); } else { $('#cod_estado_caja_mesa_registrar').val('0'); $('#cod_estado_caja_mesa_registrar').prop('checked',false); } 
if (cod_estado_caja_mesa_editar=='1') { $('#cod_estado_caja_mesa_editar').val('1'); $('#cod_estado_caja_mesa_editar').prop('checked',true); } else { $('#cod_estado_caja_mesa_editar').val('0'); $('#cod_estado_caja_mesa_editar').prop('checked',false); } 
if (cod_estado_caja_mesa_eliminar=='1') { $('#cod_estado_caja_mesa_eliminar').val('1'); $('#cod_estado_caja_mesa_eliminar').prop('checked',true); } else { $('#cod_estado_caja_mesa_eliminar').val('0'); $('#cod_estado_caja_mesa_eliminar').prop('checked',false); } 
if (cod_estado_caja_mesa_imprimir=='1') { $('#cod_estado_caja_mesa_imprimir').val('1'); $('#cod_estado_caja_mesa_imprimir').prop('checked',true); } else { $('#cod_estado_caja_mesa_imprimir').val('0'); $('#cod_estado_caja_mesa_imprimir').prop('checked',false); } 
if (cod_estado_caja_mesa_exportar=='1') { $('#cod_estado_caja_mesa_exportar').val('1'); $('#cod_estado_caja_mesa_exportar').prop('checked',true); } else { $('#cod_estado_caja_mesa_exportar').val('0'); $('#cod_estado_caja_mesa_exportar').prop('checked',false); } 
if (cod_estado_usuario_cambiar_contrasena=='1') { $('#cod_estado_usuario_cambiar_contrasena').val('1'); $('#cod_estado_usuario_cambiar_contrasena').prop('checked',true); } else { $('#cod_estado_usuario_cambiar_contrasena').val('0'); $('#cod_estado_usuario_cambiar_contrasena').prop('checked',false); } 
if (cod_estado_usuario_cambiar_firma=='1') { $('#cod_estado_usuario_cambiar_firma').val('1'); $('#cod_estado_usuario_cambiar_firma').prop('checked',true); } else { $('#cod_estado_usuario_cambiar_firma').val('0'); $('#cod_estado_usuario_cambiar_firma').prop('checked',false); } 
if (cod_estado_usuario_permisos_personalizados=='1') { $('#cod_estado_usuario_permisos_personalizados').val('1'); $('#cod_estado_usuario_permisos_personalizados').prop('checked',true); } else { $('#cod_estado_usuario_permisos_personalizados').val('0'); $('#cod_estado_usuario_permisos_personalizados').prop('checked',false); } 
if (cod_estado_usuario_permisos_asignar_matriz=='1') { $('#cod_estado_usuario_permisos_asignar_matriz').val('1'); $('#cod_estado_usuario_permisos_asignar_matriz').prop('checked',true); } else { $('#cod_estado_usuario_permisos_asignar_matriz').val('0'); $('#cod_estado_usuario_permisos_asignar_matriz').prop('checked',false); } 
if (cod_estado_usuario_cambiar_tipo_rol=='1') { $('#cod_estado_usuario_cambiar_tipo_rol').val('1'); $('#cod_estado_usuario_cambiar_tipo_rol').prop('checked',true); } else { $('#cod_estado_usuario_cambiar_tipo_rol').val('0'); $('#cod_estado_usuario_cambiar_tipo_rol').prop('checked',false); } 
if (cod_estado_facturacion_venta_dependencia_user=='1') { $('#cod_estado_facturacion_venta_dependencia_user').val('1'); $('#cod_estado_facturacion_venta_dependencia_user').prop('checked',true); } else { $('#cod_estado_facturacion_venta_dependencia_user').val('0'); $('#cod_estado_facturacion_venta_dependencia_user').prop('checked',false); } 
if (cod_estado_facturacion_venta_precio_venta_predet_user=='1') { $('#cod_estado_facturacion_venta_precio_venta_predet_user').val('1'); $('#cod_estado_facturacion_venta_precio_venta_predet_user').prop('checked',true); } else { $('#cod_estado_facturacion_venta_precio_venta_predet_user').val('0'); $('#cod_estado_facturacion_venta_precio_venta_predet_user').prop('checked',false); } 
if (cod_estado_facturacion_venta_acceso_facturas_otros_user=='1') { $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').val('1'); $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').prop('checked',true); } else { $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').val('0'); $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').prop('checked',false); } 
if (cod_estado_grafico_venta=='1') { $('#cod_estado_grafico_venta').val('1'); $('#cod_estado_grafico_venta').prop('checked',true); } else { $('#cod_estado_grafico_venta').val('0'); $('#cod_estado_grafico_venta').prop('checked',false); } 
if (cod_estado_grafico_compra=='1') { $('#cod_estado_grafico_compra').val('1'); $('#cod_estado_grafico_compra').prop('checked',true); } else { $('#cod_estado_grafico_compra').val('0'); $('#cod_estado_grafico_compra').prop('checked',false); } 
if (cod_estado_grafico_venta_compra=='1') { $('#cod_estado_grafico_venta_compra').val('1'); $('#cod_estado_grafico_venta_compra').prop('checked',true); } else { $('#cod_estado_grafico_venta_compra').val('0'); $('#cod_estado_grafico_venta_compra').prop('checked',false); } 
if (cod_estado_grafico_venta_egreso=='1') { $('#cod_estado_grafico_venta_egreso').val('1'); $('#cod_estado_grafico_venta_egreso').prop('checked',true); } else { $('#cod_estado_grafico_venta_egreso').val('0'); $('#cod_estado_grafico_venta_egreso').prop('checked',false); } 
if (cod_estado_grafico_venta_tipo_pago=='1') { $('#cod_estado_grafico_venta_tipo_pago').val('1'); $('#cod_estado_grafico_venta_tipo_pago').prop('checked',true); } else { $('#cod_estado_grafico_venta_tipo_pago').val('0'); $('#cod_estado_grafico_venta_tipo_pago').prop('checked',false); } 
if (cod_estado_grafico_venta_tipo_forma_pago=='1') { $('#cod_estado_grafico_venta_tipo_forma_pago').val('1'); $('#cod_estado_grafico_venta_tipo_forma_pago').prop('checked',true); } else { $('#cod_estado_grafico_venta_tipo_forma_pago').val('0'); $('#cod_estado_grafico_venta_tipo_forma_pago').prop('checked',false); } 
if (cod_estado_grafico_venta_tipo_factura=='1') { $('#cod_estado_grafico_venta_tipo_factura').val('1'); $('#cod_estado_grafico_venta_tipo_factura').prop('checked',true); } else { $('#cod_estado_grafico_venta_tipo_factura').val('0'); $('#cod_estado_grafico_venta_tipo_factura').prop('checked',false); } 
if (cod_estado_grafico_venta_categoria=='1') { $('#cod_estado_grafico_venta_categoria').val('1'); $('#cod_estado_grafico_venta_categoria').prop('checked',true); } else { $('#cod_estado_grafico_venta_categoria').val('0'); $('#cod_estado_grafico_venta_categoria').prop('checked',false); } 
if (cod_estado_grafico_venta_dependencia=='1') { $('#cod_estado_grafico_venta_dependencia').val('1'); $('#cod_estado_grafico_venta_dependencia').prop('checked',true); } else { $('#cod_estado_grafico_venta_dependencia').val('0'); $('#cod_estado_grafico_venta_dependencia').prop('checked',false); } 
if (cod_estado_grafico_venta_tipo_compra=='1') { $('#cod_estado_grafico_venta_tipo_compra').val('1'); $('#cod_estado_grafico_venta_tipo_compra').prop('checked',true); } else { $('#cod_estado_grafico_venta_tipo_compra').val('0'); $('#cod_estado_grafico_venta_tipo_compra').prop('checked',false); } 
if (cod_estado_grafico_venta_tipo_metodo_envio=='1') { $('#cod_estado_grafico_venta_tipo_metodo_envio').val('1'); $('#cod_estado_grafico_venta_tipo_metodo_envio').prop('checked',true); } else { $('#cod_estado_grafico_venta_tipo_metodo_envio').val('0'); $('#cod_estado_grafico_venta_tipo_metodo_envio').prop('checked',false); } 
if (cod_estado_grafico_venta_tipo_aplicacion=='1') { $('#cod_estado_grafico_venta_tipo_aplicacion').val('1'); $('#cod_estado_grafico_venta_tipo_aplicacion').prop('checked',true); } else { $('#cod_estado_grafico_venta_tipo_aplicacion').val('0'); $('#cod_estado_grafico_venta_tipo_aplicacion').prop('checked',false); } 
if (cod_estado_grafico_venta_producto=='1') { $('#cod_estado_grafico_venta_producto').val('1'); $('#cod_estado_grafico_venta_producto').prop('checked',true); } else { $('#cod_estado_grafico_venta_producto').val('0'); $('#cod_estado_grafico_venta_producto').prop('checked',false); } 
if (cod_estado_grafico_venta_tercero=='1') { $('#cod_estado_grafico_venta_tercero').val('1'); $('#cod_estado_grafico_venta_tercero').prop('checked',true); } else { $('#cod_estado_grafico_venta_tercero').val('0'); $('#cod_estado_grafico_venta_tercero').prop('checked',false); } 
if (cod_estado_grafico_venta_tercero_producto=='1') { $('#cod_estado_grafico_venta_tercero_producto').val('1'); $('#cod_estado_grafico_venta_tercero_producto').prop('checked',true); } else { $('#cod_estado_grafico_venta_tercero_producto').val('0'); $('#cod_estado_grafico_venta_tercero_producto').prop('checked',false); } 
if (cod_estado_grafico_venta_tercero_domicilio=='1') { $('#cod_estado_grafico_venta_tercero_domicilio').val('1'); $('#cod_estado_grafico_venta_tercero_domicilio').prop('checked',true); } else { $('#cod_estado_grafico_venta_tercero_domicilio').val('0'); $('#cod_estado_grafico_venta_tercero_domicilio').prop('checked',false); } 
if (cod_estado_grafico_producto_mas_vendido_und_venta=='1') { $('#cod_estado_grafico_producto_mas_vendido_und_venta').val('1'); $('#cod_estado_grafico_producto_mas_vendido_und_venta').prop('checked',true); } else { $('#cod_estado_grafico_producto_mas_vendido_und_venta').val('0'); $('#cod_estado_grafico_producto_mas_vendido_und_venta').prop('checked',false); } 
if (cod_estado_grafico_producto_mas_vendido_precio_venta=='1') { $('#cod_estado_grafico_producto_mas_vendido_precio_venta').val('1'); $('#cod_estado_grafico_producto_mas_vendido_precio_venta').prop('checked',true); } else { $('#cod_estado_grafico_producto_mas_vendido_precio_venta').val('0'); $('#cod_estado_grafico_producto_mas_vendido_precio_venta').prop('checked',false); } 
if (cod_estado_grafico_producto_menos_vendido_und_venta=='1') { $('#cod_estado_grafico_producto_menos_vendido_und_venta').val('1'); $('#cod_estado_grafico_producto_menos_vendido_und_venta').prop('checked',true); } else { $('#cod_estado_grafico_producto_menos_vendido_und_venta').val('0'); $('#cod_estado_grafico_producto_menos_vendido_und_venta').prop('checked',false); } 
if (cod_estado_grafico_producto_menos_vendido_precio_venta=='1') { $('#cod_estado_grafico_producto_menos_vendido_precio_venta').val('1'); $('#cod_estado_grafico_producto_menos_vendido_precio_venta').prop('checked',true); } else { $('#cod_estado_grafico_producto_menos_vendido_precio_venta').val('0'); $('#cod_estado_grafico_producto_menos_vendido_precio_venta').prop('checked',false); } 
if (cod_estado_grafico_compra_precio_compra_precio_venta=='1') { $('#cod_estado_grafico_compra_precio_compra_precio_venta').val('1'); $('#cod_estado_grafico_compra_precio_compra_precio_venta').prop('checked',true); } else { $('#cod_estado_grafico_compra_precio_compra_precio_venta').val('0'); $('#cod_estado_grafico_compra_precio_compra_precio_venta').prop('checked',false); } 
if (cod_estado_grafico_ganancia_venta_egreso=='1') { $('#cod_estado_grafico_ganancia_venta_egreso').val('1'); $('#cod_estado_grafico_ganancia_venta_egreso').prop('checked',true); } else { $('#cod_estado_grafico_ganancia_venta_egreso').val('0'); $('#cod_estado_grafico_ganancia_venta_egreso').prop('checked',false); } 
if (cod_estado_grafico_ganancia_venta=='1') { $('#cod_estado_grafico_ganancia_venta').val('1'); $('#cod_estado_grafico_ganancia_venta').prop('checked',true); } else { $('#cod_estado_grafico_ganancia_venta').val('0'); $('#cod_estado_grafico_ganancia_venta').prop('checked',false); } 
if (cod_estado_grafico_venta_por_vendedor=='1') { $('#cod_estado_grafico_venta_por_vendedor').val('1'); $('#cod_estado_grafico_venta_por_vendedor').prop('checked',true); } else { $('#cod_estado_grafico_venta_por_vendedor').val('0'); $('#cod_estado_grafico_venta_por_vendedor').prop('checked',false); } 
if (cod_estado_grafico_extras=='1') { $('#cod_estado_grafico_extras').val('1'); $('#cod_estado_grafico_extras').prop('checked',true); } else { $('#cod_estado_grafico_extras').val('0'); $('#cod_estado_grafico_extras').prop('checked',false); } 
if (cod_estado_deshabilitar_und_venta_ventatemp=='1') { $('#cod_estado_deshabilitar_und_venta_ventatemp').val('1'); $('#cod_estado_deshabilitar_und_venta_ventatemp').prop('checked',true); } else { $('#cod_estado_deshabilitar_und_venta_ventatemp').val('0'); $('#cod_estado_deshabilitar_und_venta_ventatemp').prop('checked',false); } 
if (cod_estado_deshabilitar_und_venta_atendido_cocina_chef=='1') { $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').val('1'); $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').prop('checked',true); } else { $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').val('0'); $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').prop('checked',false); } 
if (cod_estado_reporte_venta_total_ganancia=='1') { $('#cod_estado_reporte_venta_total_ganancia').val('1'); $('#cod_estado_reporte_venta_total_ganancia').prop('checked',true); } else { $('#cod_estado_reporte_venta_total_ganancia').val('0'); $('#cod_estado_reporte_venta_total_ganancia').prop('checked',false); } 
if (cod_estado_reporte_venta_total_utilidad=='1') { $('#cod_estado_reporte_venta_total_utilidad').val('1'); $('#cod_estado_reporte_venta_total_utilidad').prop('checked',true); } else { $('#cod_estado_reporte_venta_total_utilidad').val('0'); $('#cod_estado_reporte_venta_total_utilidad').prop('checked',false); } 
if (cod_estado_reporte_venta_total_comision=='1') { $('#cod_estado_reporte_venta_total_comision').val('1'); $('#cod_estado_reporte_venta_total_comision').prop('checked',true); } else { $('#cod_estado_reporte_venta_total_comision').val('0'); $('#cod_estado_reporte_venta_total_comision').prop('checked',false); } 
if (cod_estado_reporte_venta_total_propina=='1') { $('#cod_estado_reporte_venta_total_propina').val('1'); $('#cod_estado_reporte_venta_total_propina').prop('checked',true); } else { $('#cod_estado_reporte_venta_total_propina').val('0'); $('#cod_estado_reporte_venta_total_propina').prop('checked',false); } 




$('#cod_estado_prod').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod').val('1'); } else { $('#cod_estado_prod').val('0'); } });
$('#cod_estado_prod_reg_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_reg_producto').val('1'); } else { $('#cod_estado_prod_reg_producto').val('0'); } });
$('#cod_estado_prod_subproducto_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_subproducto_registrar').val('1'); } else { $('#cod_estado_prod_subproducto_registrar').val('0'); } });
$('#cod_estado_prod_cargar_factura_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cargar_factura_compra').val('1'); } else { $('#cod_estado_prod_cargar_factura_compra').val('0'); } });
$('#cod_estado_prod_cargar_factura_compra_soporte').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cargar_factura_compra_soporte').val('1'); } else { $('#cod_estado_prod_cargar_factura_compra_soporte').val('0'); } });
$('#cod_estado_prod_cargar_factura_compra_observacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cargar_factura_compra_observacion').val('1'); } else { $('#cod_estado_prod_cargar_factura_compra_observacion').val('0'); } });
$('#cod_estado_prod_transferencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia').val('1'); } else { $('#cod_estado_prod_transferencia').val('0'); } });
$('#cod_estado_prod_auditoria').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_auditoria').val('1'); } else { $('#cod_estado_prod_auditoria').val('0'); } });
$('#cod_estado_prod_nuevo_invenario').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nuevo_invenario').val('1'); } else { $('#cod_estado_prod_nuevo_invenario').val('0'); } });
$('#cod_estado_prod_inventario_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_inventario_producto').val('1'); } else { $('#cod_estado_prod_inventario_producto').val('0'); } });
$('#cod_estado_prod_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_registrar').val('1'); } else { $('#cod_estado_prod_registrar').val('0'); } });
$('#cod_estado_prod_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_editar').val('1'); } else { $('#cod_estado_prod_editar').val('0'); } });
$('#cod_estado_prod_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_eliminar').val('1'); } else { $('#cod_estado_prod_eliminar').val('0'); } });
$('#cod_estado_prod_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_imprimir').val('1'); } else { $('#cod_estado_prod_imprimir').val('0'); } });
$('#cod_estado_prod_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_exportar').val('1'); } else { $('#cod_estado_prod_exportar').val('0'); } });
$('#cod_estado_prod_subproducto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_subproducto').val('1'); } else { $('#cod_estado_prod_subproducto').val('0'); } });
$('#cod_estado_prod_und_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_und_producto').val('1'); } else { $('#cod_estado_prod_und_producto').val('0'); } });
$('#cod_estado_prod_und_producto_bodega').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_und_producto_bodega').val('1'); } else { $('#cod_estado_prod_und_producto_bodega').val('0'); } });
$('#cod_estado_prod_precio_compra_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_compra_producto').val('1'); } else { $('#cod_estado_prod_precio_compra_producto').val('0'); } });
$('#cod_estado_prod_precio_costo_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_costo_producto').val('1'); } else { $('#cod_estado_prod_precio_costo_producto').val('0'); } });
$('#cod_estado_prod_precio_venta_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_venta_producto').val('1'); } else { $('#cod_estado_prod_precio_venta_producto').val('0'); } });
$('#cod_estado_prod_precio_venta_producto2').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_venta_producto2').val('1'); } else { $('#cod_estado_prod_precio_venta_producto2').val('0'); } });
$('#cod_estado_prod_precio_venta_producto3').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_venta_producto3').val('1'); } else { $('#cod_estado_prod_precio_venta_producto3').val('0'); } });
$('#cod_estado_prod_precio_venta_producto4').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_venta_producto4').val('1'); } else { $('#cod_estado_prod_precio_venta_producto4').val('0'); } });
$('#cod_estado_prod_precio_venta_producto5').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_venta_producto5').val('1'); } else { $('#cod_estado_prod_precio_venta_producto5').val('0'); } });
$('#cod_estado_prod_nombre_tipo_unidad_medida').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_unidad_medida').val('1'); } else { $('#cod_estado_prod_nombre_tipo_unidad_medida').val('0'); } });
$('#cod_estado_prod_iva_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_iva_ptj').val('1'); } else { $('#cod_estado_prod_iva_ptj').val('0'); } });
$('#cod_estado_prod_nombre_tipo_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_producto').val('1'); } else { $('#cod_estado_prod_nombre_tipo_producto').val('0'); } });
$('#cod_estado_prod_cod_marca').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_marca').val('1'); } else { $('#cod_estado_prod_cod_marca').val('0'); } });
$('#cod_estado_prod_cod_proveedor').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_proveedor').val('1'); } else { $('#cod_estado_prod_cod_proveedor').val('0'); } });
$('#cod_estado_prod_cod_tercero').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_tercero').val('1'); } else { $('#cod_estado_prod_cod_tercero').val('0'); } });
$('#cod_estado_prod_cod_estado').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_estado').val('1'); } else { $('#cod_estado_prod_cod_estado').val('0'); } });
$('#cod_estado_prod_cod_dependencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_dependencia').val('1'); } else { $('#cod_estado_prod_cod_dependencia').val('0'); } });
$('#cod_estado_prod_fecha_ult_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_ult_compra').val('1'); } else { $('#cod_estado_prod_fecha_ult_compra').val('0'); } });
$('#cod_estado_prod_fecha_ult_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_ult_venta').val('1'); } else { $('#cod_estado_prod_fecha_ult_venta').val('0'); } });
$('#cod_estado_prod_fecha_vencimiento').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_vencimiento').val('1'); } else { $('#cod_estado_prod_fecha_vencimiento').val('0'); } });
$('#cod_estado_prod_tope_min').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_tope_min').val('1'); } else { $('#cod_estado_prod_tope_min').val('0'); } });
$('#cod_estado_prod_fecha_creacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_creacion').val('1'); } else { $('#cod_estado_prod_fecha_creacion').val('0'); } });
$('#cod_estado_prod_fecha_modificacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_modificacion').val('1'); } else { $('#cod_estado_prod_fecha_modificacion').val('0'); } });
$('#cod_estado_prod_nombre_tipo_precio_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_precio_venta').val('1'); } else { $('#cod_estado_prod_nombre_tipo_precio_venta').val('0'); } });
$('#cod_estado_prod_url_img_orig_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_url_img_orig_producto').val('1'); } else { $('#cod_estado_prod_url_img_orig_producto').val('0'); } });
$('#cod_estado_prod_url_img_min_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_url_img_min_producto').val('1'); } else { $('#cod_estado_prod_url_img_min_producto').val('0'); } });
$('#cod_estado_prod_comision_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_comision_ptj').val('1'); } else { $('#cod_estado_prod_comision_ptj').val('0'); } });
$('#cod_estado_prod_dto1').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_dto1').val('1'); } else { $('#cod_estado_prod_dto1').val('0'); } });
$('#cod_estado_prod_dto2').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_dto2').val('1'); } else { $('#cod_estado_prod_dto2').val('0'); } });
$('#cod_estado_prod_ipc_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_ipc_ptj').val('1'); } else { $('#cod_estado_prod_ipc_ptj').val('0'); } });
$('#cod_estado_prod_precio_ipc').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_ipc').val('1'); } else { $('#cod_estado_prod_precio_ipc').val('0'); } });
$('#cod_estado_prod_ret_ica_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_ret_ica_ptj').val('1'); } else { $('#cod_estado_prod_ret_ica_ptj').val('0'); } });
$('#cod_estado_prod_iva_teorico_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_iva_teorico_ptj').val('1'); } else { $('#cod_estado_prod_iva_teorico_ptj').val('0'); } });
$('#cod_estado_prod_tarifa_rete_vigente_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_tarifa_rete_vigente_ptj').val('1'); } else { $('#cod_estado_prod_tarifa_rete_vigente_ptj').val('0'); } });
$('#cod_estado_prod_rete_iva_asumido_ptj').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_rete_iva_asumido_ptj').val('1'); } else { $('#cod_estado_prod_rete_iva_asumido_ptj').val('0'); } });
$('#cod_estado_prod_nombre_tipo_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_compra').val('1'); } else { $('#cod_estado_prod_nombre_tipo_compra').val('0'); } });
$('#cod_estado_prod_nombre_tipo_cargue_factura').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_cargue_factura').val('1'); } else { $('#cod_estado_prod_nombre_tipo_cargue_factura').val('0'); } });
$('#cod_estado_prod_nombre_tipo_medida').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_medida').val('1'); } else { $('#cod_estado_prod_nombre_tipo_medida').val('0'); } });
$('#cod_estado_prod_cajas_sobre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cajas_sobre').val('1'); } else { $('#cod_estado_prod_cajas_sobre').val('0'); } });
$('#cod_estado_prod_und_sobre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_und_sobre').val('1'); } else { $('#cod_estado_prod_und_sobre').val('0'); } });
$('#cod_estado_prod_cod_interno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_interno').val('1'); } else { $('#cod_estado_prod_cod_interno').val('0'); } });
$('#cod_estado_prod_cod_original').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_original').val('1'); } else { $('#cod_estado_prod_cod_original').val('0'); } });
$('#cod_estado_prod_codificacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_codificacion').val('1'); } else { $('#cod_estado_prod_codificacion').val('0'); } });
$('#cod_estado_prod_cod_producto_serial').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_producto_serial').val('1'); } else { $('#cod_estado_prod_cod_producto_serial').val('0'); } });
$('#cod_estado_prod_fecha_mantenimiento').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_mantenimiento').val('1'); } else { $('#cod_estado_prod_fecha_mantenimiento').val('0'); } });
$('#cod_estado_prod_peso_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_peso_producto').val('1'); } else { $('#cod_estado_prod_peso_producto').val('0'); } });
$('#cod_estado_prod_cod_rodeo').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_rodeo').val('1'); } else { $('#cod_estado_prod_cod_rodeo').val('0'); } });
$('#cod_estado_prod_nombre_rodeo').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_rodeo').val('1'); } else { $('#cod_estado_prod_nombre_rodeo').val('0'); } });
$('#cod_estado_prod_nombre_sexo').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_sexo').val('1'); } else { $('#cod_estado_prod_nombre_sexo').val('0'); } });
$('#cod_estado_prod_de_monta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_de_monta').val('1'); } else { $('#cod_estado_prod_de_monta').val('0'); } });
$('#cod_estado_prod_nombre_estatus').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_estatus').val('1'); } else { $('#cod_estado_prod_nombre_estatus').val('0'); } });
$('#cod_estado_prod_nombre_condicion_corporal').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_condicion_corporal').val('1'); } else { $('#cod_estado_prod_nombre_condicion_corporal').val('0'); } });
$('#cod_estado_prod_nombre_categoria_ingreso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_categoria_ingreso').val('1'); } else { $('#cod_estado_prod_nombre_categoria_ingreso').val('0'); } });
$('#cod_estado_prod_nombre_categoria_actual').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_categoria_actual').val('1'); } else { $('#cod_estado_prod_nombre_categoria_actual').val('0'); } });
$('#cod_estado_prod_nombre_categoria_futura').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_categoria_futura').val('1'); } else { $('#cod_estado_prod_nombre_categoria_futura').val('0'); } });
$('#cod_estado_prod_nombre_procedencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_procedencia').val('1'); } else { $('#cod_estado_prod_nombre_procedencia').val('0'); } });
$('#cod_estado_prod_nombre_tipo_monta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_monta').val('1'); } else { $('#cod_estado_prod_nombre_tipo_monta').val('0'); } });
$('#cod_estado_prod_nombre_lote_categoria').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_lote_categoria').val('1'); } else { $('#cod_estado_prod_nombre_lote_categoria').val('0'); } });
$('#cod_estado_prod_nombre_prog_reproductivo').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_prog_reproductivo').val('1'); } else { $('#cod_estado_prod_nombre_prog_reproductivo').val('0'); } });
$('#cod_estado_prod_nombre_potrero').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_potrero').val('1'); } else { $('#cod_estado_prod_nombre_potrero').val('0'); } });
$('#cod_estado_prod_nombre_lote').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_lote').val('1'); } else { $('#cod_estado_prod_nombre_lote').val('0'); } });
$('#cod_estado_prod_nombre_calidad_animal').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_calidad_animal').val('1'); } else { $('#cod_estado_prod_nombre_calidad_animal').val('0'); } });
$('#cod_estado_prod_nombre_tipo_explotacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_explotacion').val('1'); } else { $('#cod_estado_prod_nombre_tipo_explotacion').val('0'); } });
$('#cod_estado_prod_peso_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_peso_compra').val('1'); } else { $('#cod_estado_prod_peso_compra').val('0'); } });
$('#cod_estado_prod_precio_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_precio_compra').val('1'); } else { $('#cod_estado_prod_precio_compra').val('0'); } });
$('#cod_estado_prod_fecha_nac').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_nac').val('1'); } else { $('#cod_estado_prod_fecha_nac').val('0'); } });
$('#cod_estado_prod_fecha_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_compra').val('1'); } else { $('#cod_estado_prod_fecha_compra').val('0'); } });
$('#cod_estado_prod_fecha_castracion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_fecha_castracion').val('1'); } else { $('#cod_estado_prod_fecha_castracion').val('0'); } });
$('#cod_estado_prod_nro_hierros').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nro_hierros').val('1'); } else { $('#cod_estado_prod_nro_hierros').val('0'); } });
$('#cod_estado_prod_hierro_animal').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_hierro_animal').val('1'); } else { $('#cod_estado_prod_hierro_animal').val('0'); } });
$('#cod_estado_prod_numero_partos').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_numero_partos').val('1'); } else { $('#cod_estado_prod_numero_partos').val('0'); } });
$('#cod_estado_prod_id_electronica').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_electronica').val('1'); } else { $('#cod_estado_prod_id_electronica').val('0'); } });
$('#cod_estado_prod_nombre_raza1').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_raza1').val('1'); } else { $('#cod_estado_prod_nombre_raza1').val('0'); } });
$('#cod_estado_prod_nombre_raza2').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_raza2').val('1'); } else { $('#cod_estado_prod_nombre_raza2').val('0'); } });
$('#cod_estado_prod_nombre_raza3').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_raza3').val('1'); } else { $('#cod_estado_prod_nombre_raza3').val('0'); } });
$('#cod_estado_prod_nombre_raza4').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_raza4').val('1'); } else { $('#cod_estado_prod_nombre_raza4').val('0'); } });
$('#cod_estado_prod_ptj_raza1').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_ptj_raza1').val('1'); } else { $('#cod_estado_prod_ptj_raza1').val('0'); } });
$('#cod_estado_prod_ptj_raza2').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_ptj_raza2').val('1'); } else { $('#cod_estado_prod_ptj_raza2').val('0'); } });
$('#cod_estado_prod_ptj_raza3').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_ptj_raza3').val('1'); } else { $('#cod_estado_prod_ptj_raza3').val('0'); } });
$('#cod_estado_prod_ptj_raza4').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_ptj_raza4').val('1'); } else { $('#cod_estado_prod_ptj_raza4').val('0'); } });
$('#cod_estado_prod_id_padre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_padre').val('1'); } else { $('#cod_estado_prod_id_padre').val('0'); } });
$('#cod_estado_prod_raza_padre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_raza_padre').val('1'); } else { $('#cod_estado_prod_raza_padre').val('0'); } });
$('#cod_estado_prod_id_madre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_madre').val('1'); } else { $('#cod_estado_prod_id_madre').val('0'); } });
$('#cod_estado_prod_raza_madre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_raza_madre').val('1'); } else { $('#cod_estado_prod_raza_madre').val('0'); } });
$('#cod_estado_prod_partos_madre').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_partos_madre').val('1'); } else { $('#cod_estado_prod_partos_madre').val('0'); } });
$('#cod_estado_prod_id_abuelo_paterno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_abuelo_paterno').val('1'); } else { $('#cod_estado_prod_id_abuelo_paterno').val('0'); } });
$('#cod_estado_prod_id_abuelo_materno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_abuelo_materno').val('1'); } else { $('#cod_estado_prod_id_abuelo_materno').val('0'); } });
$('#cod_estado_prod_nombre_abuelo_paterno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_abuelo_paterno').val('1'); } else { $('#cod_estado_prod_nombre_abuelo_paterno').val('0'); } });
$('#cod_estado_prod_nombre_abuelo_materno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_abuelo_materno').val('1'); } else { $('#cod_estado_prod_nombre_abuelo_materno').val('0'); } });
$('#cod_estado_prod_raza_abuelo_paterno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_raza_abuelo_paterno').val('1'); } else { $('#cod_estado_prod_raza_abuelo_paterno').val('0'); } });
$('#cod_estado_prod_raza_abuelo_materno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_raza_abuelo_materno').val('1'); } else { $('#cod_estado_prod_raza_abuelo_materno').val('0'); } });
$('#cod_estado_prod_id_abuela_paterno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_abuela_paterno').val('1'); } else { $('#cod_estado_prod_id_abuela_paterno').val('0'); } });
$('#cod_estado_prod_id_abuela_materno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_id_abuela_materno').val('1'); } else { $('#cod_estado_prod_id_abuela_materno').val('0'); } });
$('#cod_estado_prod_nombre_abuela_paterno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_abuela_paterno').val('1'); } else { $('#cod_estado_prod_nombre_abuela_paterno').val('0'); } });
$('#cod_estado_prod_nombre_abuela_materno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_abuela_materno').val('1'); } else { $('#cod_estado_prod_nombre_abuela_materno').val('0'); } });
$('#cod_estado_prod_raza_abuela_paterno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_raza_abuela_paterno').val('1'); } else { $('#cod_estado_prod_raza_abuela_paterno').val('0'); } });
$('#cod_estado_prod_raza_abuela_materno').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_raza_abuela_materno').val('1'); } else { $('#cod_estado_prod_raza_abuela_materno').val('0'); } });
$('#cod_estado_prod_nombre_tipo_concepcion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_concepcion').val('1'); } else { $('#cod_estado_prod_nombre_tipo_concepcion').val('0'); } });
$('#cod_estado_prod_nombre_especie').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_especie').val('1'); } else { $('#cod_estado_prod_nombre_especie').val('0'); } });
$('#cod_estado_prod_marcas_tatuado').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_marcas_tatuado').val('1'); } else { $('#cod_estado_prod_marcas_tatuado').val('0'); } });
$('#cod_estado_prod_marcas_herrado').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_marcas_herrado').val('1'); } else { $('#cod_estado_prod_marcas_herrado').val('0'); } });
$('#cod_estado_prod_marcas_descornado').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_marcas_descornado').val('1'); } else { $('#cod_estado_prod_marcas_descornado').val('0'); } });
$('#cod_estado_prod_marcas_castrado').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_marcas_castrado').val('1'); } else { $('#cod_estado_prod_marcas_castrado').val('0'); } });
$('#cod_estado_prod_nombre_color').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_color').val('1'); } else { $('#cod_estado_prod_nombre_color').val('0'); } });
$('#cod_estado_prod_nombre_temperamento').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_temperamento').val('1'); } else { $('#cod_estado_prod_nombre_temperamento').val('0'); } });
$('#cod_estado_prod_peso_nacer').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_peso_nacer').val('1'); } else { $('#cod_estado_prod_peso_nacer').val('0'); } });
$('#cod_estado_prod_aplomo_corvejon').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_aplomo_corvejon').val('1'); } else { $('#cod_estado_prod_aplomo_corvejon').val('0'); } });
$('#cod_estado_prod_aplomo_cuartilla').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_aplomo_cuartilla').val('1'); } else { $('#cod_estado_prod_aplomo_cuartilla').val('0'); } });
$('#cod_estado_prod_aplomo_cascos').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_aplomo_cascos').val('1'); } else { $('#cod_estado_prod_aplomo_cascos').val('0'); } });
$('#cod_estado_prod_genital_circun_escrotal').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_genital_circun_escrotal').val('1'); } else { $('#cod_estado_prod_genital_circun_escrotal').val('0'); } });
$('#cod_estado_prod_genital_prepusio').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_genital_prepusio').val('1'); } else { $('#cod_estado_prod_genital_prepusio').val('0'); } });
$('#cod_estado_prod_genital_potencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_genital_potencia').val('1'); } else { $('#cod_estado_prod_genital_potencia').val('0'); } });
$('#cod_estado_prod_genital_semen').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_genital_semen').val('1'); } else { $('#cod_estado_prod_genital_semen').val('0'); } });
$('#cod_estado_prod_observacion_animal').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_observacion_animal').val('1'); } else { $('#cod_estado_prod_observacion_animal').val('0'); } });
$('#cod_estado_prod_nombre_estado').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_estado').val('1'); } else { $('#cod_estado_prod_nombre_estado').val('0'); } });
$('#cod_estado_prod_nombre_tipo_movimiento').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_movimiento').val('1'); } else { $('#cod_estado_prod_nombre_tipo_movimiento').val('0'); } });
$('#cod_estado_prod_nombre_categoria_animal_extern').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_categoria_animal_extern').val('1'); } else { $('#cod_estado_prod_nombre_categoria_animal_extern').val('0'); } });
$('#cod_estado_prod_cod_finca').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_cod_finca').val('1'); } else { $('#cod_estado_prod_cod_finca').val('0'); } });
$('#cod_estado_prod_nombre_finca').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_finca').val('1'); } else { $('#cod_estado_prod_nombre_finca').val('0'); } });
$('#cod_estado_prod_nombre_categoria').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_categoria').val('1'); } else { $('#cod_estado_prod_nombre_categoria').val('0'); } });
$('#cod_estado_prod_nombre_categoria_sub').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_categoria_sub').val('1'); } else { $('#cod_estado_prod_nombre_categoria_sub').val('0'); } });
$('#cod_estado_prod_und_inv').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_und_inv').val('1'); } else { $('#cod_estado_prod_und_inv').val('0'); } });
$('#cod_estado_prod_descripcion_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_descripcion_producto').val('1'); } else { $('#cod_estado_prod_descripcion_producto').val('0'); } });
$('#cod_estado_prod_url_img_producto_min').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_url_img_producto_min').val('1'); } else { $('#cod_estado_prod_url_img_producto_min').val('0'); } });
$('#cod_estado_prod_url_img_producto_orig').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_url_img_producto_orig').val('1'); } else { $('#cod_estado_prod_url_img_producto_orig').val('0'); } });
$('#cod_estado_prod_nombre_promocion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_promocion').val('1'); } else { $('#cod_estado_prod_nombre_promocion').val('0'); } });
$('#cod_estado_prod_nombre_promocion_ing').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_promocion_ing').val('1'); } else { $('#cod_estado_prod_nombre_promocion_ing').val('0'); } });
$('#cod_estado_prod_posologia_cantidad').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_posologia_cantidad').val('1'); } else { $('#cod_estado_prod_posologia_cantidad').val('0'); } });
$('#cod_estado_prod_posologia_peso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_posologia_peso').val('1'); } else { $('#cod_estado_prod_posologia_peso').val('0'); } });
$('#cod_estado_prod_nombre_tipo_presentacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_tipo_presentacion').val('1'); } else { $('#cod_estado_prod_nombre_tipo_presentacion').val('0'); } });
$('#cod_estado_prod_nombre_via_administracion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_via_administracion').val('1'); } else { $('#cod_estado_prod_nombre_via_administracion').val('0'); } });
$('#cod_estado_prod_nombre_frec_duracion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_nombre_frec_duracion').val('1'); } else { $('#cod_estado_prod_nombre_frec_duracion').val('0'); } });
$('#cod_estado_plan_separe').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_plan_separe').val('1'); } else { $('#cod_estado_plan_separe').val('0'); } });
$('#cod_estado_plan_separe_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_plan_separe_registrar').val('1'); } else { $('#cod_estado_plan_separe_registrar').val('0'); } });
$('#cod_estado_plan_separe_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_plan_separe_editar').val('1'); } else { $('#cod_estado_plan_separe_editar').val('0'); } });
$('#cod_estado_plan_separe_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_plan_separe_eliminar').val('1'); } else { $('#cod_estado_plan_separe_eliminar').val('0'); } });
$('#cod_estado_plan_separe_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_plan_separe_imprimir').val('1'); } else { $('#cod_estado_plan_separe_imprimir').val('0'); } });
$('#cod_estado_plan_separe_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_plan_separe_exportar').val('1'); } else { $('#cod_estado_plan_separe_exportar').val('0'); } });
$('#cod_estado_contabilidad').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad').val('1'); } else { $('#cod_estado_contabilidad').val('0'); } });
$('#cod_estado_contabilidad_mov_contable').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_mov_contable').val('1'); } else { $('#cod_estado_contabilidad_mov_contable').val('0'); } });
$('#cod_estado_contabilidad_mov_contable_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_mov_contable_registrar').val('1'); } else { $('#cod_estado_contabilidad_mov_contable_registrar').val('0'); } });
$('#cod_estado_contabilidad_mov_contable_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_mov_contable_editar').val('1'); } else { $('#cod_estado_contabilidad_mov_contable_editar').val('0'); } });
$('#cod_estado_contabilidad_mov_contable_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_mov_contable_eliminar').val('1'); } else { $('#cod_estado_contabilidad_mov_contable_eliminar').val('0'); } });
$('#cod_estado_contabilidad_mov_contable_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_mov_contable_imprimir').val('1'); } else { $('#cod_estado_contabilidad_mov_contable_imprimir').val('0'); } });
$('#cod_estado_contabilidad_mov_contable_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_mov_contable_exportar').val('1'); } else { $('#cod_estado_contabilidad_mov_contable_exportar').val('0'); } });
$('#cod_estado_contabilidad_pyg').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_pyg').val('1'); } else { $('#cod_estado_contabilidad_pyg').val('0'); } });
$('#cod_estado_contabilidad_pyg_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_pyg_registrar').val('1'); } else { $('#cod_estado_contabilidad_pyg_registrar').val('0'); } });
$('#cod_estado_contabilidad_pyg_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_pyg_editar').val('1'); } else { $('#cod_estado_contabilidad_pyg_editar').val('0'); } });
$('#cod_estado_contabilidad_pyg_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_pyg_eliminar').val('1'); } else { $('#cod_estado_contabilidad_pyg_eliminar').val('0'); } });
$('#cod_estado_contabilidad_pyg_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_pyg_imprimir').val('1'); } else { $('#cod_estado_contabilidad_pyg_imprimir').val('0'); } });
$('#cod_estado_contabilidad_pyg_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_pyg_exportar').val('1'); } else { $('#cod_estado_contabilidad_pyg_exportar').val('0'); } });
$('#cod_estado_contabilidad_balance').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_balance').val('1'); } else { $('#cod_estado_contabilidad_balance').val('0'); } });
$('#cod_estado_contabilidad_balance_pyg_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_balance_pyg_registrar').val('1'); } else { $('#cod_estado_contabilidad_balance_pyg_registrar').val('0'); } });
$('#cod_estado_contabilidad_balance_pyg_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_balance_pyg_editar').val('1'); } else { $('#cod_estado_contabilidad_balance_pyg_editar').val('0'); } });
$('#cod_estado_contabilidad_balance_pyg_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_balance_pyg_eliminar').val('1'); } else { $('#cod_estado_contabilidad_balance_pyg_eliminar').val('0'); } });
$('#cod_estado_contabilidad_balance_pyg_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_balance_pyg_imprimir').val('1'); } else { $('#cod_estado_contabilidad_balance_pyg_imprimir').val('0'); } });
$('#cod_estado_contabilidad_balance_pyg_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_balance_pyg_exportar').val('1'); } else { $('#cod_estado_contabilidad_balance_pyg_exportar').val('0'); } });
$('#cod_estado_contabilidad_puc').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_puc').val('1'); } else { $('#cod_estado_contabilidad_puc').val('0'); } });
$('#cod_estado_contabilidad_puc_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_puc_registrar').val('1'); } else { $('#cod_estado_contabilidad_puc_registrar').val('0'); } });
$('#cod_estado_contabilidad_puc_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_puc_editar').val('1'); } else { $('#cod_estado_contabilidad_puc_editar').val('0'); } });
$('#cod_estado_contabilidad_puc_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_puc_eliminar').val('1'); } else { $('#cod_estado_contabilidad_puc_eliminar').val('0'); } });
$('#cod_estado_contabilidad_puc_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_puc_imprimir').val('1'); } else { $('#cod_estado_contabilidad_puc_imprimir').val('0'); } });
$('#cod_estado_contabilidad_puc_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_contabilidad_puc_exportar').val('1'); } else { $('#cod_estado_contabilidad_puc_exportar').val('0'); } });
$('#cod_estado_facturacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion').val('1'); } else { $('#cod_estado_facturacion').val('0'); } });
$('#cod_estado_facturacion_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta').val('1'); } else { $('#cod_estado_facturacion_venta').val('0'); } });
$('#cod_estado_facturacion_venta_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_registrar').val('1'); } else { $('#cod_estado_facturacion_venta_registrar').val('0'); } });
$('#cod_estado_facturacion_venta_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_editar').val('1'); } else { $('#cod_estado_facturacion_venta_editar').val('0'); } });
$('#cod_estado_facturacion_venta_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_eliminar').val('1'); } else { $('#cod_estado_facturacion_venta_eliminar').val('0'); } });
$('#cod_estado_facturacion_venta_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_imprimir').val('1'); } else { $('#cod_estado_facturacion_venta_imprimir').val('0'); } });
$('#cod_estado_facturacion_venta_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_exportar').val('1'); } else { $('#cod_estado_facturacion_venta_exportar').val('0'); } });
$('#cod_estado_facturacion_venta_devol').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_devol').val('1'); } else { $('#cod_estado_facturacion_venta_devol').val('0'); } });
$('#cod_estado_facturacion_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra').val('1'); } else { $('#cod_estado_facturacion_compra').val('0'); } });
$('#cod_estado_facturacion_compra_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra_registrar').val('1'); } else { $('#cod_estado_facturacion_compra_registrar').val('0'); } });
$('#cod_estado_facturacion_compra_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra_editar').val('1'); } else { $('#cod_estado_facturacion_compra_editar').val('0'); } });
$('#cod_estado_facturacion_compra_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra_eliminar').val('1'); } else { $('#cod_estado_facturacion_compra_eliminar').val('0'); } });
$('#cod_estado_facturacion_compra_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra_imprimir').val('1'); } else { $('#cod_estado_facturacion_compra_imprimir').val('0'); } });
$('#cod_estado_facturacion_compra_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra_exportar').val('1'); } else { $('#cod_estado_facturacion_compra_exportar').val('0'); } });
$('#cod_estado_facturacion_compra_devol').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_compra_devol').val('1'); } else { $('#cod_estado_facturacion_compra_devol').val('0'); } });
$('#cod_estado_facturacion_devol_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_devol_venta').val('1'); } else { $('#cod_estado_facturacion_devol_venta').val('0'); } });
$('#cod_estado_facturacion_devol_inventario').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_devol_inventario').val('1'); } else { $('#cod_estado_facturacion_devol_inventario').val('0'); } });
$('#cod_estado_cotizacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion').val('1'); } else { $('#cod_estado_cotizacion').val('0'); } });
$('#cod_estado_cotizacion_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_venta').val('1'); } else { $('#cod_estado_cotizacion_venta').val('0'); } });
$('#cod_estado_cotizacion_venta_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_venta_registrar').val('1'); } else { $('#cod_estado_cotizacion_venta_registrar').val('0'); } });
$('#cod_estado_cotizacion_venta_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_venta_editar').val('1'); } else { $('#cod_estado_cotizacion_venta_editar').val('0'); } });
$('#cod_estado_cotizacion_venta_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_venta_eliminar').val('1'); } else { $('#cod_estado_cotizacion_venta_eliminar').val('0'); } });
$('#cod_estado_cotizacion_venta_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_venta_imprimir').val('1'); } else { $('#cod_estado_cotizacion_venta_imprimir').val('0'); } });
$('#cod_estado_cotizacion_venta_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_venta_exportar').val('1'); } else { $('#cod_estado_cotizacion_venta_exportar').val('0'); } });
$('#cod_estado_cotizacion_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_compra').val('1'); } else { $('#cod_estado_cotizacion_compra').val('0'); } });
$('#cod_estado_cotizacion_compra_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_compra_registrar').val('1'); } else { $('#cod_estado_cotizacion_compra_registrar').val('0'); } });
$('#cod_estado_cotizacion_compra_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_compra_editar').val('1'); } else { $('#cod_estado_cotizacion_compra_editar').val('0'); } });
$('#cod_estado_cotizacion_compra_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_compra_eliminar').val('1'); } else { $('#cod_estado_cotizacion_compra_eliminar').val('0'); } });
$('#cod_estado_cotizacion_compra_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_compra_imprimir').val('1'); } else { $('#cod_estado_cotizacion_compra_imprimir').val('0'); } });
$('#cod_estado_cotizacion_compra_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cotizacion_compra_exportar').val('1'); } else { $('#cod_estado_cotizacion_compra_exportar').val('0'); } });
$('#cod_estado_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta').val('1'); } else { $('#cod_estado_venta').val('0'); } });
$('#cod_estado_venta_manual').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_manual').val('1'); } else { $('#cod_estado_venta_manual').val('0'); } });
$('#cod_estado_venta_barras').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_barras').val('1'); } else { $('#cod_estado_venta_barras').val('0'); } });
$('#cod_estado_venta_fecha_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_fecha_venta').val('1'); } else { $('#cod_estado_venta_fecha_venta').val('0'); } });
$('#cod_estado_venta_preventa').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_preventa').val('1'); } else { $('#cod_estado_venta_preventa').val('0'); } });
$('#cod_estado_venta_propina').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_propina').val('1'); } else { $('#cod_estado_venta_propina').val('0'); } });
$('#cod_estado_venta_bolsa').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_bolsa').val('1'); } else { $('#cod_estado_venta_bolsa').val('0'); } });
$('#cod_estado_venta_observacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_venta_observacion').val('1'); } else { $('#cod_estado_venta_observacion').val('0'); } });
$('#cod_estado_tercero').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tercero').val('1'); } else { $('#cod_estado_tercero').val('0'); } });
$('#cod_estado_tercero_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tercero_registrar').val('1'); } else { $('#cod_estado_tercero_registrar').val('0'); } });
$('#cod_estado_tercero_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tercero_editar').val('1'); } else { $('#cod_estado_tercero_editar').val('0'); } });
$('#cod_estado_tercero_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tercero_eliminar').val('1'); } else { $('#cod_estado_tercero_eliminar').val('0'); } });
$('#cod_estado_tercero_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tercero_imprimir').val('1'); } else { $('#cod_estado_tercero_imprimir').val('0'); } });
$('#cod_estado_tercero_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tercero_exportar').val('1'); } else { $('#cod_estado_tercero_exportar').val('0'); } });
$('#cod_estado_cita').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cita').val('1'); } else { $('#cod_estado_cita').val('0'); } });
$('#cod_estado_cita_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cita_registrar').val('1'); } else { $('#cod_estado_cita_registrar').val('0'); } });
$('#cod_estado_cita_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cita_editar').val('1'); } else { $('#cod_estado_cita_editar').val('0'); } });
$('#cod_estado_cita_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cita_eliminar').val('1'); } else { $('#cod_estado_cita_eliminar').val('0'); } });
$('#cod_estado_cita_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cita_imprimir').val('1'); } else { $('#cod_estado_cita_imprimir').val('0'); } });
$('#cod_estado_cita_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cita_exportar').val('1'); } else { $('#cod_estado_cita_exportar').val('0'); } });
$('#cod_estado_cuenta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta').val('1'); } else { $('#cod_estado_cuenta').val('0'); } });
$('#cod_estado_cuenta_cobrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_cobrar').val('1'); } else { $('#cod_estado_cuenta_cobrar').val('0'); } });
$('#cod_estado_cuenta_cobrar_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_cobrar_registrar').val('1'); } else { $('#cod_estado_cuenta_cobrar_registrar').val('0'); } });
$('#cod_estado_cuenta_cobrar_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_cobrar_editar').val('1'); } else { $('#cod_estado_cuenta_cobrar_editar').val('0'); } });
$('#cod_estado_cuenta_cobrar_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_cobrar_eliminar').val('1'); } else { $('#cod_estado_cuenta_cobrar_eliminar').val('0'); } });
$('#cod_estado_cuenta_cobrar_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_cobrar_imprimir').val('1'); } else { $('#cod_estado_cuenta_cobrar_imprimir').val('0'); } });
$('#cod_estado_cuenta_cobrar_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_cobrar_exportar').val('1'); } else { $('#cod_estado_cuenta_cobrar_exportar').val('0'); } });
$('#cod_estado_cuenta_pagar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_pagar').val('1'); } else { $('#cod_estado_cuenta_pagar').val('0'); } });
$('#cod_estado_cuenta_pagar_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_pagar_registrar').val('1'); } else { $('#cod_estado_cuenta_pagar_registrar').val('0'); } });
$('#cod_estado_cuenta_pagar_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_pagar_editar').val('1'); } else { $('#cod_estado_cuenta_pagar_editar').val('0'); } });
$('#cod_estado_cuenta_pagar_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_pagar_eliminar').val('1'); } else { $('#cod_estado_cuenta_pagar_eliminar').val('0'); } });
$('#cod_estado_cuenta_pagar_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_pagar_imprimir').val('1'); } else { $('#cod_estado_cuenta_pagar_imprimir').val('0'); } });
$('#cod_estado_cuenta_pagar_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cuenta_pagar_exportar').val('1'); } else { $('#cod_estado_cuenta_pagar_exportar').val('0'); } });
$('#cod_estado_cierre_caja').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cierre_caja').val('1'); } else { $('#cod_estado_cierre_caja').val('0'); } });
$('#cod_estado_cierre_caja_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cierre_caja_registrar').val('1'); } else { $('#cod_estado_cierre_caja_registrar').val('0'); } });
$('#cod_estado_cierre_caja_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cierre_caja_editar').val('1'); } else { $('#cod_estado_cierre_caja_editar').val('0'); } });
$('#cod_estado_cierre_caja_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cierre_caja_eliminar').val('1'); } else { $('#cod_estado_cierre_caja_eliminar').val('0'); } });
$('#cod_estado_cierre_caja_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cierre_caja_imprimir').val('1'); } else { $('#cod_estado_cierre_caja_imprimir').val('0'); } });
$('#cod_estado_cierre_caja_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_cierre_caja_exportar').val('1'); } else { $('#cod_estado_cierre_caja_exportar').val('0'); } });
$('#cod_estado_egreso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_egreso').val('1'); } else { $('#cod_estado_egreso').val('0'); } });
$('#cod_estado_egreso_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_egreso_registrar').val('1'); } else { $('#cod_estado_egreso_registrar').val('0'); } });
$('#cod_estado_egreso_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_egreso_editar').val('1'); } else { $('#cod_estado_egreso_editar').val('0'); } });
$('#cod_estado_egreso_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_egreso_eliminar').val('1'); } else { $('#cod_estado_egreso_eliminar').val('0'); } });
$('#cod_estado_egreso_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_egreso_imprimir').val('1'); } else { $('#cod_estado_egreso_imprimir').val('0'); } });
$('#cod_estado_egreso_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_egreso_exportar').val('1'); } else { $('#cod_estado_egreso_exportar').val('0'); } });
$('#cod_estado_sticker_barra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra').val('1'); } else { $('#cod_estado_sticker_barra').val('0'); } });
$('#cod_estado_sticker_barra_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_registrar').val('1'); } else { $('#cod_estado_sticker_barra_registrar').val('0'); } });
$('#cod_estado_sticker_barra_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_editar').val('1'); } else { $('#cod_estado_sticker_barra_editar').val('0'); } });
$('#cod_estado_sticker_barra_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_eliminar').val('1'); } else { $('#cod_estado_sticker_barra_eliminar').val('0'); } });
$('#cod_estado_sticker_barra_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_imprimir').val('1'); } else { $('#cod_estado_sticker_barra_imprimir').val('0'); } });
$('#cod_estado_sticker_barra_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_exportar').val('1'); } else { $('#cod_estado_sticker_barra_exportar').val('0'); } });
$('#cod_estado_sticker_barra_observacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_observacion').val('1'); } else { $('#cod_estado_sticker_barra_observacion').val('0'); } });
$('#cod_estado_sticker_barra_archivo_plano').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_sticker_barra_archivo_plano').val('1'); } else { $('#cod_estado_sticker_barra_archivo_plano').val('0'); } });
$('#cod_estado_reporte').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte').val('1'); } else { $('#cod_estado_reporte').val('0'); } });
$('#cod_estado_reporte_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta').val('1'); } else { $('#cod_estado_reporte_venta').val('0'); } });
$('#cod_estado_reporte_venta_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_registrar').val('1'); } else { $('#cod_estado_reporte_venta_registrar').val('0'); } });
$('#cod_estado_reporte_venta_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_editar').val('1'); } else { $('#cod_estado_reporte_venta_editar').val('0'); } });
$('#cod_estado_reporte_venta_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_eliminar').val('1'); } else { $('#cod_estado_reporte_venta_eliminar').val('0'); } });
$('#cod_estado_reporte_venta_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_imprimir').val('1'); } else { $('#cod_estado_reporte_venta_imprimir').val('0'); } });
$('#cod_estado_reporte_venta_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_exportar').val('1'); } else { $('#cod_estado_reporte_venta_exportar').val('0'); } });
$('#cod_estado_reporte_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_compra').val('1'); } else { $('#cod_estado_reporte_compra').val('0'); } });
$('#cod_estado_reporte_compra_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_compra_registrar').val('1'); } else { $('#cod_estado_reporte_compra_registrar').val('0'); } });
$('#cod_estado_reporte_compra_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_compra_editar').val('1'); } else { $('#cod_estado_reporte_compra_editar').val('0'); } });
$('#cod_estado_reporte_compra_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_compra_eliminar').val('1'); } else { $('#cod_estado_reporte_compra_eliminar').val('0'); } });
$('#cod_estado_reporte_compra_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_compra_imprimir').val('1'); } else { $('#cod_estado_reporte_compra_imprimir').val('0'); } });
$('#cod_estado_reporte_compra_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_compra_exportar').val('1'); } else { $('#cod_estado_reporte_compra_exportar').val('0'); } });
$('#cod_estado_reporte_general').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_general').val('1'); } else { $('#cod_estado_reporte_general').val('0'); } });
$('#cod_estado_reporte_general_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_general_registrar').val('1'); } else { $('#cod_estado_reporte_general_registrar').val('0'); } });
$('#cod_estado_reporte_general_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_general_editar').val('1'); } else { $('#cod_estado_reporte_general_editar').val('0'); } });
$('#cod_estado_reporte_general_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_general_eliminar').val('1'); } else { $('#cod_estado_reporte_general_eliminar').val('0'); } });
$('#cod_estado_reporte_general_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_general_imprimir').val('1'); } else { $('#cod_estado_reporte_general_imprimir').val('0'); } });
$('#cod_estado_reporte_general_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_general_exportar').val('1'); } else { $('#cod_estado_reporte_general_exportar').val('0'); } });
$('#cod_estado_reporte_mov_contable').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_mov_contable').val('1'); } else { $('#cod_estado_reporte_mov_contable').val('0'); } });
$('#cod_estado_reporte_mov_contable_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_mov_contable_registrar').val('1'); } else { $('#cod_estado_reporte_mov_contable_registrar').val('0'); } });
$('#cod_estado_reporte_mov_contable_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_mov_contable_editar').val('1'); } else { $('#cod_estado_reporte_mov_contable_editar').val('0'); } });
$('#cod_estado_reporte_mov_contable_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_mov_contable_eliminar').val('1'); } else { $('#cod_estado_reporte_mov_contable_eliminar').val('0'); } });
$('#cod_estado_reporte_mov_contable_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_mov_contable_imprimir').val('1'); } else { $('#cod_estado_reporte_mov_contable_imprimir').val('0'); } });
$('#cod_estado_reporte_mov_contable_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_mov_contable_exportar').val('1'); } else { $('#cod_estado_reporte_mov_contable_exportar').val('0'); } });
$('#cod_estado_reporte_venta_por_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_por_producto').val('1'); } else { $('#cod_estado_reporte_venta_por_producto').val('0'); } });
$('#cod_estado_reporte_venta_por_producto_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_por_producto_registrar').val('1'); } else { $('#cod_estado_reporte_venta_por_producto_registrar').val('0'); } });
$('#cod_estado_reporte_venta_por_producto_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_por_producto_editar').val('1'); } else { $('#cod_estado_reporte_venta_por_producto_editar').val('0'); } });
$('#cod_estado_reporte_venta_por_producto_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_por_producto_eliminar').val('1'); } else { $('#cod_estado_reporte_venta_por_producto_eliminar').val('0'); } });
$('#cod_estado_reporte_venta_por_producto_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_por_producto_imprimir').val('1'); } else { $('#cod_estado_reporte_venta_por_producto_imprimir').val('0'); } });
$('#cod_estado_reporte_venta_por_producto_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_por_producto_exportar').val('1'); } else { $('#cod_estado_reporte_venta_por_producto_exportar').val('0'); } });
$('#cod_estado_reporte_inventario').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_inventario').val('1'); } else { $('#cod_estado_reporte_inventario').val('0'); } });
$('#cod_estado_reporte_inventario_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_inventario_registrar').val('1'); } else { $('#cod_estado_reporte_inventario_registrar').val('0'); } });
$('#cod_estado_reporte_inventario_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_inventario_editar').val('1'); } else { $('#cod_estado_reporte_inventario_editar').val('0'); } });
$('#cod_estado_reporte_inventario_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_inventario_eliminar').val('1'); } else { $('#cod_estado_reporte_inventario_eliminar').val('0'); } });
$('#cod_estado_reporte_inventario_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_inventario_imprimir').val('1'); } else { $('#cod_estado_reporte_inventario_imprimir').val('0'); } });
$('#cod_estado_reporte_inventario_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_inventario_exportar').val('1'); } else { $('#cod_estado_reporte_inventario_exportar').val('0'); } });
$('#cod_estado_reporte_prodcuto_vencer').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_vencer').val('1'); } else { $('#cod_estado_reporte_prodcuto_vencer').val('0'); } });
$('#cod_estado_reporte_prodcuto_vencer_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_vencer_registrar').val('1'); } else { $('#cod_estado_reporte_prodcuto_vencer_registrar').val('0'); } });
$('#cod_estado_reporte_prodcuto_vencer_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_vencer_editar').val('1'); } else { $('#cod_estado_reporte_prodcuto_vencer_editar').val('0'); } });
$('#cod_estado_reporte_prodcuto_vencer_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_vencer_eliminar').val('1'); } else { $('#cod_estado_reporte_prodcuto_vencer_eliminar').val('0'); } });
$('#cod_estado_reporte_prodcuto_vencer_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_vencer_imprimir').val('1'); } else { $('#cod_estado_reporte_prodcuto_vencer_imprimir').val('0'); } });
$('#cod_estado_reporte_prodcuto_vencer_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_vencer_exportar').val('1'); } else { $('#cod_estado_reporte_prodcuto_vencer_exportar').val('0'); } });
$('#cod_estado_reporte_prodcuto_mantenimiento').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_mantenimiento').val('1'); } else { $('#cod_estado_reporte_prodcuto_mantenimiento').val('0'); } });
$('#cod_estado_reporte_prodcuto_mantenimiento_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').val('1'); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_registrar').val('0'); } });
$('#cod_estado_reporte_prodcuto_mantenimiento_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_mantenimiento_editar').val('1'); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_editar').val('0'); } });
$('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').val('1'); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_eliminar').val('0'); } });
$('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').val('1'); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_imprimir').val('0'); } });
$('#cod_estado_reporte_prodcuto_mantenimiento_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').val('1'); } else { $('#cod_estado_reporte_prodcuto_mantenimiento_exportar').val('0'); } });
$('#cod_estado_reporte_cumplanos_tercero').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_cumplanos_tercero').val('1'); } else { $('#cod_estado_reporte_cumplanos_tercero').val('0'); } });
$('#cod_estado_reporte_cumplanos_tercero_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_cumplanos_tercero_registrar').val('1'); } else { $('#cod_estado_reporte_cumplanos_tercero_registrar').val('0'); } });
$('#cod_estado_reporte_cumplanos_tercero_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_cumplanos_tercero_editar').val('1'); } else { $('#cod_estado_reporte_cumplanos_tercero_editar').val('0'); } });
$('#cod_estado_reporte_cumplanos_tercero_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_cumplanos_tercero_eliminar').val('1'); } else { $('#cod_estado_reporte_cumplanos_tercero_eliminar').val('0'); } });
$('#cod_estado_reporte_cumplanos_tercero_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_cumplanos_tercero_imprimir').val('1'); } else { $('#cod_estado_reporte_cumplanos_tercero_imprimir').val('0'); } });
$('#cod_estado_reporte_cumplanos_tercero_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_cumplanos_tercero_exportar').val('1'); } else { $('#cod_estado_reporte_cumplanos_tercero_exportar').val('0'); } });
$('#cod_estado_admin').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_admin').val('1'); } else { $('#cod_estado_admin').val('0'); } });
$('#cod_estado_info_empresa').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_info_empresa').val('1'); } else { $('#cod_estado_info_empresa').val('0'); } });
$('#cod_estado_info_empresa_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_info_empresa_registrar').val('1'); } else { $('#cod_estado_info_empresa_registrar').val('0'); } });
$('#cod_estado_info_empresa_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_info_empresa_editar').val('1'); } else { $('#cod_estado_info_empresa_editar').val('0'); } });
$('#cod_estado_info_empresa_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_info_empresa_eliminar').val('1'); } else { $('#cod_estado_info_empresa_eliminar').val('0'); } });
$('#cod_estado_info_empresa_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_info_empresa_imprimir').val('1'); } else { $('#cod_estado_info_empresa_imprimir').val('0'); } });
$('#cod_estado_info_empresa_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_info_empresa_exportar').val('1'); } else { $('#cod_estado_info_empresa_exportar').val('0'); } });
$('#cod_estado_usuario').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario').val('1'); } else { $('#cod_estado_usuario').val('0'); } });
$('#cod_estado_usuario_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_registrar').val('1'); } else { $('#cod_estado_usuario_registrar').val('0'); } });
$('#cod_estado_usuario_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_editar').val('1'); } else { $('#cod_estado_usuario_editar').val('0'); } });
$('#cod_estado_usuario_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_eliminar').val('1'); } else { $('#cod_estado_usuario_eliminar').val('0'); } });
$('#cod_estado_usuario_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_imprimir').val('1'); } else { $('#cod_estado_usuario_imprimir').val('0'); } });
$('#cod_estado_usuario_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_exportar').val('1'); } else { $('#cod_estado_usuario_exportar').val('0'); } });
$('#cod_estado_dependencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_dependencia').val('1'); } else { $('#cod_estado_dependencia').val('0'); } });
$('#cod_estado_dependencia_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_dependencia_registrar').val('1'); } else { $('#cod_estado_dependencia_registrar').val('0'); } });
$('#cod_estado_dependencia_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_dependencia_editar').val('1'); } else { $('#cod_estado_dependencia_editar').val('0'); } });
$('#cod_estado_dependencia_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_dependencia_eliminar').val('1'); } else { $('#cod_estado_dependencia_eliminar').val('0'); } });
$('#cod_estado_dependencia_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_dependencia_imprimir').val('1'); } else { $('#cod_estado_dependencia_imprimir').val('0'); } });
$('#cod_estado_dependencia_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_dependencia_exportar').val('1'); } else { $('#cod_estado_dependencia_exportar').val('0'); } });
$('#cod_estado_resol_facturacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_resol_facturacion').val('1'); } else { $('#cod_estado_resol_facturacion').val('0'); } });
$('#cod_estado_resol_facturacion_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_resol_facturacion_registrar').val('1'); } else { $('#cod_estado_resol_facturacion_registrar').val('0'); } });
$('#cod_estado_resol_facturacion_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_resol_facturacion_editar').val('1'); } else { $('#cod_estado_resol_facturacion_editar').val('0'); } });
$('#cod_estado_resol_facturacion_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_resol_facturacion_eliminar').val('1'); } else { $('#cod_estado_resol_facturacion_eliminar').val('0'); } });
$('#cod_estado_resol_facturacion_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_resol_facturacion_imprimir').val('1'); } else { $('#cod_estado_resol_facturacion_imprimir').val('0'); } });
$('#cod_estado_resol_facturacion_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_resol_facturacion_exportar').val('1'); } else { $('#cod_estado_resol_facturacion_exportar').val('0'); } });
$('#cod_estado_numero_letras').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_numero_letras').val('1'); } else { $('#cod_estado_numero_letras').val('0'); } });
$('#cod_estado_numero_letras_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_numero_letras_registrar').val('1'); } else { $('#cod_estado_numero_letras_registrar').val('0'); } });
$('#cod_estado_numero_letras_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_numero_letras_editar').val('1'); } else { $('#cod_estado_numero_letras_editar').val('0'); } });
$('#cod_estado_numero_letras_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_numero_letras_eliminar').val('1'); } else { $('#cod_estado_numero_letras_eliminar').val('0'); } });
$('#cod_estado_numero_letras_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_numero_letras_imprimir').val('1'); } else { $('#cod_estado_numero_letras_imprimir').val('0'); } });
$('#cod_estado_numero_letras_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_numero_letras_exportar').val('1'); } else { $('#cod_estado_numero_letras_exportar').val('0'); } });
$('#cod_estado_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_eliminar').val('1'); } else { $('#cod_estado_eliminar').val('0'); } });
$('#cod_estado_eliminar_usuario').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_eliminar_usuario').val('1'); } else { $('#cod_estado_eliminar_usuario').val('0'); } });
$('#cod_estado_eliminar_tercero').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_eliminar_tercero').val('1'); } else { $('#cod_estado_eliminar_tercero').val('0'); } });
$('#cod_estado_eliminar_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_eliminar_producto').val('1'); } else { $('#cod_estado_eliminar_producto').val('0'); } });
$('#cod_estado_licencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_licencia').val('1'); } else { $('#cod_estado_licencia').val('0'); } });
$('#cod_estado_licencia_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_licencia_registrar').val('1'); } else { $('#cod_estado_licencia_registrar').val('0'); } });
$('#cod_estado_licencia_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_licencia_editar').val('1'); } else { $('#cod_estado_licencia_editar').val('0'); } });
$('#cod_estado_licencia_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_licencia_imprimir').val('1'); } else { $('#cod_estado_licencia_imprimir').val('0'); } });
$('#cod_estado_licencia_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_licencia_exportar').val('1'); } else { $('#cod_estado_licencia_exportar').val('0'); } });
$('#cod_estado_repositorio').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_repositorio').val('1'); } else { $('#cod_estado_repositorio').val('0'); } });
$('#cod_estado_repositorio_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_repositorio_registrar').val('1'); } else { $('#cod_estado_repositorio_registrar').val('0'); } });
$('#cod_estado_repositorio_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_repositorio_editar').val('1'); } else { $('#cod_estado_repositorio_editar').val('0'); } });
$('#cod_estado_repositorio_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_repositorio_eliminar').val('1'); } else { $('#cod_estado_repositorio_eliminar').val('0'); } });
$('#cod_estado_repositorio_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_repositorio_imprimir').val('1'); } else { $('#cod_estado_repositorio_imprimir').val('0'); } });
$('#cod_estado_repositorio_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_repositorio_exportar').val('1'); } else { $('#cod_estado_repositorio_exportar').val('0'); } });
$('#cod_estado_prod_subproducto_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_subproducto_editar').val('1'); } else { $('#cod_estado_prod_subproducto_editar').val('0'); } });
$('#cod_estado_prod_subproducto_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_subproducto_eliminar').val('1'); } else { $('#cod_estado_prod_subproducto_eliminar').val('0'); } });
$('#cod_estado_prod_subproducto_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_subproducto_imprimir').val('1'); } else { $('#cod_estado_prod_subproducto_imprimir').val('0'); } });
$('#cod_estado_prod_subproducto_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_subproducto_exportar').val('1'); } else { $('#cod_estado_prod_subproducto_exportar').val('0'); } });
$('#cod_estado_prod_transferencia_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_registrar').val('1'); } else { $('#cod_estado_prod_transferencia_registrar').val('0'); } });
$('#cod_estado_prod_transferencia_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_editar').val('1'); } else { $('#cod_estado_prod_transferencia_editar').val('0'); } });
$('#cod_estado_prod_transferencia_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_eliminar').val('1'); } else { $('#cod_estado_prod_transferencia_eliminar').val('0'); } });
$('#cod_estado_prod_transferencia_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_imprimir').val('1'); } else { $('#cod_estado_prod_transferencia_imprimir').val('0'); } });
$('#cod_estado_prod_transferencia_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_exportar').val('1'); } else { $('#cod_estado_prod_transferencia_exportar').val('0'); } });

$('#cod_estado_prod_auditoria_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_auditoria_registrar').val('1'); } else { $('#cod_estado_prod_auditoria_registrar').val('0'); } });
$('#cod_estado_prod_auditoria_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_auditoria_editar').val('1'); } else { $('#cod_estado_prod_auditoria_editar').val('0'); } });
$('#cod_estado_prod_auditoria_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_auditoria_eliminar').val('1'); } else { $('#cod_estado_prod_auditoria_eliminar').val('0'); } });
$('#cod_estado_prod_auditoria_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_auditoria_imprimir').val('1'); } else { $('#cod_estado_prod_auditoria_imprimir').val('0'); } });
$('#cod_estado_prod_auditoria_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_auditoria_exportar').val('1'); } else { $('#cod_estado_prod_auditoria_exportar').val('0'); } });

$('#cod_estado_eliminar_caja_mesa_virtual').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_eliminar_caja_mesa_virtual').val('1'); } else { $('#cod_estado_eliminar_caja_mesa_virtual').val('0'); } });
$('#cod_estado_precio_compra_mod_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_precio_compra_mod_venta').val('1'); } else { $('#cod_estado_precio_compra_mod_venta').val('0'); } });
$('#cod_estado_deshabilitar_opc_eliminar_ventatemp').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').val('1'); } else { $('#cod_estado_deshabilitar_opc_eliminar_ventatemp').val('0'); } });
$('#cod_estado_habilitar_btn_facturar_mod_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_habilitar_btn_facturar_mod_venta').val('1'); } else { $('#cod_estado_habilitar_btn_facturar_mod_venta').val('0'); } });

$('#cod_estado_seguridad').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_seguridad').val('1'); } else { $('#cod_estado_seguridad').val('0'); } });
$('#cod_estado_seguridad_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_seguridad_registrar').val('1'); } else { $('#cod_estado_seguridad_registrar').val('0'); } });
$('#cod_estado_seguridad_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_seguridad_editar').val('1'); } else { $('#cod_estado_seguridad_editar').val('0'); } });
$('#cod_estado_seguridad_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_seguridad_eliminar').val('1'); } else { $('#cod_estado_seguridad_eliminar').val('0'); } });
$('#cod_estado_seguridad_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_seguridad_imprimir').val('1'); } else { $('#cod_estado_seguridad_imprimir').val('0'); } });
$('#cod_estado_seguridad_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_seguridad_exportar').val('1'); } else { $('#cod_estado_seguridad_exportar').val('0'); } });

$('#cod_estado_grafico_estadistico').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_estadistico').val('1'); } else { $('#cod_estado_grafico_estadistico').val('0'); } });
$('#cod_estado_grafico_estadistico_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_estadistico_registrar').val('1'); } else { $('#cod_estado_grafico_estadistico_registrar').val('0'); } });
$('#cod_estado_grafico_estadistico_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_estadistico_editar').val('1'); } else { $('#cod_estado_grafico_estadistico_editar').val('0'); } });
$('#cod_estado_grafico_estadistico_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_estadistico_eliminar').val('1'); } else { $('#cod_estado_grafico_estadistico_eliminar').val('0'); } });
$('#cod_estado_grafico_estadistico_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_estadistico_imprimir').val('1'); } else { $('#cod_estado_grafico_estadistico_imprimir').val('0'); } });
$('#cod_estado_grafico_estadistico_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_estadistico_exportar').val('1'); } else { $('#cod_estado_grafico_estadistico_exportar').val('0'); } });

$('#cod_estado_nota_observacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_nota_observacion').val('1'); } else { $('#cod_estado_nota_observacion').val('0'); } });
$('#cod_estado_nota_observacion_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_nota_observacion_eliminar').val('1'); } else { $('#cod_estado_nota_observacion_eliminar').val('0'); } });
$('#cod_estado_nota_observacion_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_nota_observacion_registrar').val('1'); } else { $('#cod_estado_nota_observacion_registrar').val('0'); } });
$('#cod_estado_nota_observacion_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_nota_observacion_editar').val('1'); } else { $('#cod_estado_nota_observacion_editar').val('0'); } });
$('#cod_estado_nota_observacion_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_nota_observacion_imprimir').val('1'); } else { $('#cod_estado_nota_observacion_imprimir').val('0'); } });
$('#cod_estado_nota_observacion_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_nota_observacion_exportar').val('1'); } else { $('#cod_estado_nota_observacion_exportar').val('0'); } });

$('#cod_estado_tipo_roles').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tipo_roles').val('1'); } else { $('#cod_estado_tipo_roles').val('0'); } });
$('#cod_estado_tipo_roles_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tipo_roles_registrar').val('1'); } else { $('#cod_estado_tipo_roles_registrar').val('0'); } });
$('#cod_estado_tipo_roles_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tipo_roles_editar').val('1'); } else { $('#cod_estado_tipo_roles_editar').val('0'); } });
$('#cod_estado_tipo_roles_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tipo_roles_eliminar').val('1'); } else { $('#cod_estado_tipo_roles_eliminar').val('0'); } });
$('#cod_estado_tipo_roles_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tipo_roles_imprimir').val('1'); } else { $('#cod_estado_tipo_roles_imprimir').val('0'); } });
$('#cod_estado_tipo_roles_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_tipo_roles_exportar').val('1'); } else { $('#cod_estado_tipo_roles_exportar').val('0'); } });

$('#cod_estado_agregar_productos_a_venta_facturada').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_agregar_productos_a_venta_facturada').val('1'); } else { $('#cod_estado_agregar_productos_a_venta_facturada').val('0'); } });
$('#cod_estado_eliminar_productos_a_venta_facturada').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_eliminar_productos_a_venta_facturada').val('1'); } else { $('#cod_estado_eliminar_productos_a_venta_facturada').val('0'); } });
$('#cod_estado_habilitar_total_venta_ventatemp').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_habilitar_total_venta_ventatemp').val('1'); } else { $('#cod_estado_habilitar_total_venta_ventatemp').val('0'); } });
$('#cod_estado_habilitar_total_venta_caja_mesa_virtual').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').val('1'); } else { $('#cod_estado_habilitar_total_venta_caja_mesa_virtual').val('0'); } });
$('#cod_estado_habilitar_caja_mesa_virtual_en_uso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').val('1'); } else { $('#cod_estado_habilitar_caja_mesa_virtual_en_uso').val('0'); } });
$('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').val('1'); } else { $('#cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso').val('0'); } });

$('#cod_estado_prod_inventario_producto_masivo').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_inventario_producto_masivo').val('1'); } else { $('#cod_estado_prod_inventario_producto_masivo').val('0'); } });

$('#cod_estado_prod_transferencia_extern').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_extern').val('1'); } else { $('#cod_estado_prod_transferencia_extern').val('0'); } });
$('#cod_estado_prod_transferencia_extern_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_extern_registrar').val('1'); } else { $('#cod_estado_prod_transferencia_extern_registrar').val('0'); } });
$('#cod_estado_prod_transferencia_extern_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_extern_editar').val('1'); } else { $('#cod_estado_prod_transferencia_extern_editar').val('0'); } });
$('#cod_estado_prod_transferencia_extern_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_extern_eliminar').val('1'); } else { $('#cod_estado_prod_transferencia_extern_eliminar').val('0'); } });
$('#cod_estado_prod_transferencia_extern_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_extern_imprimir').val('1'); } else { $('#cod_estado_prod_transferencia_extern_imprimir').val('0'); } });
$('#cod_estado_prod_transferencia_extern_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_prod_transferencia_extern_exportar').val('1'); } else { $('#cod_estado_prod_transferencia_extern_exportar').val('0'); } });

$('#cod_estado_categoria').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_categoria').val('1'); } else { $('#cod_estado_categoria').val('0'); } });
$('#cod_estado_categoria_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_categoria_registrar').val('1'); } else { $('#cod_estado_categoria_registrar').val('0'); } });
$('#cod_estado_categoria_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_categoria_editar').val('1'); } else { $('#cod_estado_categoria_editar').val('0'); } });
$('#cod_estado_categoria_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_categoria_eliminar').val('1'); } else { $('#cod_estado_categoria_eliminar').val('0'); } });
$('#cod_estado_categoria_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_categoria_imprimir').val('1'); } else { $('#cod_estado_categoria_imprimir').val('0'); } });
$('#cod_estado_categoria_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_categoria_exportar').val('1'); } else { $('#cod_estado_categoria_exportar').val('0'); } });

$('#cod_estado_caja_mesa').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_caja_mesa').val('1'); } else { $('#cod_estado_caja_mesa').val('0'); } });
$('#cod_estado_caja_mesa_registrar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_caja_mesa_registrar').val('1'); } else { $('#cod_estado_caja_mesa_registrar').val('0'); } });
$('#cod_estado_caja_mesa_editar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_caja_mesa_editar').val('1'); } else { $('#cod_estado_caja_mesa_editar').val('0'); } });
$('#cod_estado_caja_mesa_eliminar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_caja_mesa_eliminar').val('1'); } else { $('#cod_estado_caja_mesa_eliminar').val('0'); } });
$('#cod_estado_caja_mesa_imprimir').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_caja_mesa_imprimir').val('1'); } else { $('#cod_estado_caja_mesa_imprimir').val('0'); } });
$('#cod_estado_caja_mesa_exportar').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_caja_mesa_exportar').val('1'); } else { $('#cod_estado_caja_mesa_exportar').val('0'); } });

$('#cod_estado_usuario_cambiar_contrasena').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_cambiar_contrasena').val('1'); } else { $('#cod_estado_usuario_cambiar_contrasena').val('0'); } });
$('#cod_estado_usuario_cambiar_firma').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_cambiar_firma').val('1'); } else { $('#cod_estado_usuario_cambiar_firma').val('0'); } });
$('#cod_estado_usuario_permisos_personalizados').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_permisos_personalizados').val('1'); } else { $('#cod_estado_usuario_permisos_personalizados').val('0'); } });
$('#cod_estado_usuario_permisos_asignar_matriz').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_permisos_asignar_matriz').val('1'); } else { $('#cod_estado_usuario_permisos_asignar_matriz').val('0'); } });
$('#cod_estado_usuario_cambiar_tipo_rol').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_usuario_cambiar_tipo_rol').val('1'); } else { $('#cod_estado_usuario_cambiar_tipo_rol').val('0'); } });

$('#cod_estado_facturacion_venta_dependencia_user').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_dependencia_user').val('1'); } else { $('#cod_estado_facturacion_venta_dependencia_user').val('0'); } });
$('#cod_estado_facturacion_venta_precio_venta_predet_user').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_precio_venta_predet_user').val('1'); } else { $('#cod_estado_facturacion_venta_precio_venta_predet_user').val('0'); } });
$('#cod_estado_facturacion_venta_acceso_facturas_otros_user').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').val('1'); } else { $('#cod_estado_facturacion_venta_acceso_facturas_otros_user').val('0'); } });

$('#cod_estado_grafico_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta').val('1'); } else { $('#cod_estado_grafico_venta').val('0'); } });
$('#cod_estado_grafico_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_compra').val('1'); } else { $('#cod_estado_grafico_compra').val('0'); } });
$('#cod_estado_grafico_venta_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_compra').val('1'); } else { $('#cod_estado_grafico_venta_compra').val('0'); } });
$('#cod_estado_grafico_venta_egreso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_egreso').val('1'); } else { $('#cod_estado_grafico_venta_egreso').val('0'); } });
$('#cod_estado_grafico_venta_tipo_pago').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tipo_pago').val('1'); } else { $('#cod_estado_grafico_venta_tipo_pago').val('0'); } });
$('#cod_estado_grafico_venta_tipo_forma_pago').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tipo_forma_pago').val('1'); } else { $('#cod_estado_grafico_venta_tipo_forma_pago').val('0'); } });
$('#cod_estado_grafico_venta_tipo_factura').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tipo_factura').val('1'); } else { $('#cod_estado_grafico_venta_tipo_factura').val('0'); } });
$('#cod_estado_grafico_venta_categoria').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_categoria').val('1'); } else { $('#cod_estado_grafico_venta_categoria').val('0'); } });
$('#cod_estado_grafico_venta_dependencia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_dependencia').val('1'); } else { $('#cod_estado_grafico_venta_dependencia').val('0'); } });
$('#cod_estado_grafico_venta_tipo_compra').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tipo_compra').val('1'); } else { $('#cod_estado_grafico_venta_tipo_compra').val('0'); } });
$('#cod_estado_grafico_venta_tipo_metodo_envio').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tipo_metodo_envio').val('1'); } else { $('#cod_estado_grafico_venta_tipo_metodo_envio').val('0'); } });
$('#cod_estado_grafico_venta_tipo_aplicacion').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tipo_aplicacion').val('1'); } else { $('#cod_estado_grafico_venta_tipo_aplicacion').val('0'); } });
$('#cod_estado_grafico_venta_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_producto').val('1'); } else { $('#cod_estado_grafico_venta_producto').val('0'); } });
$('#cod_estado_grafico_venta_tercero').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tercero').val('1'); } else { $('#cod_estado_grafico_venta_tercero').val('0'); } });
$('#cod_estado_grafico_venta_tercero_producto').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tercero_producto').val('1'); } else { $('#cod_estado_grafico_venta_tercero_producto').val('0'); } });
$('#cod_estado_grafico_venta_tercero_domicilio').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_tercero_domicilio').val('1'); } else { $('#cod_estado_grafico_venta_tercero_domicilio').val('0'); } });
$('#cod_estado_grafico_producto_mas_vendido_und_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_producto_mas_vendido_und_venta').val('1'); } else { $('#cod_estado_grafico_producto_mas_vendido_und_venta').val('0'); } });
$('#cod_estado_grafico_producto_mas_vendido_precio_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_producto_mas_vendido_precio_venta').val('1'); } else { $('#cod_estado_grafico_producto_mas_vendido_precio_venta').val('0'); } });
$('#cod_estado_grafico_producto_menos_vendido_und_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_producto_menos_vendido_und_venta').val('1'); } else { $('#cod_estado_grafico_producto_menos_vendido_und_venta').val('0'); } });
$('#cod_estado_grafico_producto_menos_vendido_precio_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_producto_menos_vendido_precio_venta').val('1'); } else { $('#cod_estado_grafico_producto_menos_vendido_precio_venta').val('0'); } });
$('#cod_estado_grafico_compra_precio_compra_precio_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_compra_precio_compra_precio_venta').val('1'); } else { $('#cod_estado_grafico_compra_precio_compra_precio_venta').val('0'); } });
$('#cod_estado_grafico_ganancia_venta_egreso').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_ganancia_venta_egreso').val('1'); } else { $('#cod_estado_grafico_ganancia_venta_egreso').val('0'); } });
$('#cod_estado_grafico_ganancia_venta').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_ganancia_venta').val('1'); } else { $('#cod_estado_grafico_ganancia_venta').val('0'); } });
$('#cod_estado_grafico_venta_por_vendedor').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_venta_por_vendedor').val('1'); } else { $('#cod_estado_grafico_venta_por_vendedor').val('0'); } });
$('#cod_estado_grafico_extras').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_grafico_extras').val('1'); } else { $('#cod_estado_grafico_extras').val('0'); } });
$('#cod_estado_deshabilitar_und_venta_ventatemp').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_deshabilitar_und_venta_ventatemp').val('1'); } else { $('#cod_estado_deshabilitar_und_venta_ventatemp').val('0'); } });
$('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').val('1'); } else { $('#cod_estado_deshabilitar_und_venta_atendido_cocina_chef').val('0'); } });

$('#cod_estado_reporte_venta_total_ganancia').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_total_ganancia').val('1'); } else { $('#cod_estado_reporte_venta_total_ganancia').val('0'); } });
$('#cod_estado_reporte_venta_total_utilidad').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_total_utilidad').val('1'); } else { $('#cod_estado_reporte_venta_total_utilidad').val('0'); } });
$('#cod_estado_reporte_venta_total_comision').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_total_comision').val('1'); } else { $('#cod_estado_reporte_venta_total_comision').val('0'); } });
$('#cod_estado_reporte_venta_total_propina').change(function(){ if( $(this).is(':checked') ){ $('#cod_estado_reporte_venta_total_propina').val('1'); } else { $('#cod_estado_reporte_venta_total_propina').val('0'); } });

});
</script>