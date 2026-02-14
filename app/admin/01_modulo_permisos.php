<?php
$sql_permiso_usuario = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$cedula_usuar                                                        = $matriz_permiso_usuario['cedula'];
$nombres_usuar                                                       = $matriz_permiso_usuario['nombres'];
$apellidos_usuar                                                     = $matriz_permiso_usuario['apellidos'];
$cuenta_usuar                                                        = $matriz_permiso_usuario['cuenta'];
$cod_seguridad_usuar                                                 = $matriz_permiso_usuario['cod_seguridad'];
$nombre_usuario                                                      = $nombres_usuar.' '.$apellidos_usuar;
$cod_dependencia_user                                                = $matriz_permiso_usuario['cod_dependencia_user'];
$nombre_tipo_precio_venta_predet_user                                = $matriz_permiso_usuario['nombre_tipo_precio_venta_predet_user'];
$numero_precio_user                                                  = $matriz_permiso_usuario['numero_precio_user'];
$num_max_caja_mesa_usuario                                           = $matriz_permiso_usuario['num_max_caja_mesa_usuario'];
$cod_origen_produccion_user                                          = $matriz_permiso_usuario['cod_origen_produccion_user'];

$cod_estado_prod                                                     = $matriz_permiso_usuario['cod_estado_prod'];
$cod_estado_prod_reg_producto                                        = $matriz_permiso_usuario['cod_estado_prod_reg_producto'];
$cod_estado_prod_asig_subproducto                                    = $matriz_permiso_usuario['cod_estado_prod_asig_subproducto'];
$cod_estado_prod_cargar_factura_compra                               = $matriz_permiso_usuario['cod_estado_prod_cargar_factura_compra'];
$cod_estado_prod_cargar_factura_compra_soporte                       = $matriz_permiso_usuario['cod_estado_prod_cargar_factura_compra_soporte'];
$cod_estado_prod_cargar_factura_compra_observacion                   = $matriz_permiso_usuario['cod_estado_prod_cargar_factura_compra_observacion'];
$cod_estado_prod_transferencia                                       = $matriz_permiso_usuario['cod_estado_prod_transferencia'];
$cod_estado_prod_auditoria                                           = $matriz_permiso_usuario['cod_estado_prod_auditoria'];
$cod_estado_prod_nuevo_invenario                                     = $matriz_permiso_usuario['cod_estado_prod_nuevo_invenario'];
$cod_estado_prod_inventario_producto                                 = $matriz_permiso_usuario['cod_estado_prod_inventario_producto'];
$cod_estado_prod_registrar                                           = $matriz_permiso_usuario['cod_estado_prod_registrar'];
$cod_estado_prod_editar                                              = $matriz_permiso_usuario['cod_estado_prod_editar'];
$cod_estado_prod_eliminar                                            = $matriz_permiso_usuario['cod_estado_prod_eliminar'];
$cod_estado_prod_imprimir                                            = $matriz_permiso_usuario['cod_estado_prod_imprimir'];
$cod_estado_prod_exportar                                            = $matriz_permiso_usuario['cod_estado_prod_exportar'];

$cod_estado_prod_subproducto                                         = $matriz_permiso_usuario['cod_estado_prod_subproducto'];
$cod_estado_prod_und_producto                                        = $matriz_permiso_usuario['cod_estado_prod_und_producto'];
$cod_estado_prod_und_producto_bodega                                 = $matriz_permiso_usuario['cod_estado_prod_und_producto_bodega'];
$cod_estado_prod_precio_compra_producto                              = $matriz_permiso_usuario['cod_estado_prod_precio_compra_producto'];
$cod_estado_prod_precio_costo_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_costo_producto'];
$cod_estado_prod_precio_venta_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto'];
$cod_estado_prod_precio_venta_producto2                              = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto2'];
$cod_estado_prod_precio_venta_producto3                              = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto3'];
$cod_estado_prod_precio_venta_producto4                              = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto4'];
$cod_estado_prod_precio_venta_producto5                              = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto5'];
$cod_estado_prod_nombre_tipo_unidad_medida                           = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_unidad_medida'];
$cod_estado_prod_iva_ptj                                             = $matriz_permiso_usuario['cod_estado_prod_iva_ptj'];
$cod_estado_prod_nombre_tipo_producto                                = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_producto'];
$cod_estado_prod_cod_marca                                           = $matriz_permiso_usuario['cod_estado_prod_cod_marca'];
$cod_estado_prod_cod_proveedor                                       = $matriz_permiso_usuario['cod_estado_prod_cod_proveedor'];
$cod_estado_prod_cod_tercero                                         = $matriz_permiso_usuario['cod_estado_prod_cod_tercero'];
$cod_estado_prod_cod_estado                                          = $matriz_permiso_usuario['cod_estado_prod_cod_estado'];
$cod_estado_prod_cod_dependencia                                     = $matriz_permiso_usuario['cod_estado_prod_cod_dependencia'];
$cod_estado_prod_fecha_ult_compra                                    = $matriz_permiso_usuario['cod_estado_prod_fecha_ult_compra'];
$cod_estado_prod_fecha_ult_venta                                     = $matriz_permiso_usuario['cod_estado_prod_fecha_ult_venta'];
$cod_estado_prod_fecha_vencimiento                                   = $matriz_permiso_usuario['cod_estado_prod_fecha_vencimiento'];
$cod_estado_prod_tope_min                                            = $matriz_permiso_usuario['cod_estado_prod_tope_min'];
$cod_estado_prod_fecha_creacion                                      = $matriz_permiso_usuario['cod_estado_prod_fecha_creacion'];
$cod_estado_prod_fecha_modificacion                                  = $matriz_permiso_usuario['cod_estado_prod_fecha_modificacion'];
$cod_estado_prod_nombre_tipo_precio_venta                            = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_precio_venta'];
$cod_estado_prod_url_img_orig_producto                               = $matriz_permiso_usuario['cod_estado_prod_url_img_orig_producto'];
$cod_estado_prod_url_img_min_producto                                = $matriz_permiso_usuario['cod_estado_prod_url_img_min_producto'];
$cod_estado_prod_comision_ptj                                        = $matriz_permiso_usuario['cod_estado_prod_comision_ptj'];
$cod_estado_prod_dto1                                                = $matriz_permiso_usuario['cod_estado_prod_dto1'];
$cod_estado_prod_dto2                                                = $matriz_permiso_usuario['cod_estado_prod_dto2'];
$cod_estado_prod_ipc_ptj                                             = $matriz_permiso_usuario['cod_estado_prod_ipc_ptj'];
$cod_estado_prod_precio_ipc                                          = $matriz_permiso_usuario['cod_estado_prod_precio_ipc'];
$cod_estado_prod_ret_ica_ptj                                         = $matriz_permiso_usuario['cod_estado_prod_ret_ica_ptj'];
$cod_estado_prod_iva_teorico_ptj                                     = $matriz_permiso_usuario['cod_estado_prod_iva_teorico_ptj'];
$cod_estado_prod_tarifa_rete_vigente_ptj                             = $matriz_permiso_usuario['cod_estado_prod_tarifa_rete_vigente_ptj'];
$cod_estado_prod_rete_iva_asumido_ptj                                = $matriz_permiso_usuario['cod_estado_prod_rete_iva_asumido_ptj'];
$cod_estado_prod_nombre_tipo_compra                                  = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_compra'];
$cod_estado_prod_nombre_tipo_cargue_factura                          = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_cargue_factura'];
$cod_estado_prod_nombre_tipo_medida                                  = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_medida'];
$cod_estado_prod_cajas_sobre                                         = $matriz_permiso_usuario['cod_estado_prod_cajas_sobre'];
$cod_estado_prod_und_sobre                                           = $matriz_permiso_usuario['cod_estado_prod_und_sobre'];
$cod_estado_prod_cod_interno                                         = $matriz_permiso_usuario['cod_estado_prod_cod_interno'];
$cod_estado_prod_cod_original                                        = $matriz_permiso_usuario['cod_estado_prod_cod_original'];
$cod_estado_prod_codificacion                                        = $matriz_permiso_usuario['cod_estado_prod_codificacion'];
$cod_estado_prod_cod_producto_serial                                 = $matriz_permiso_usuario['cod_estado_prod_cod_producto_serial'];
$cod_estado_prod_fecha_mantenimiento                                 = $matriz_permiso_usuario['cod_estado_prod_fecha_mantenimiento'];
$cod_estado_prod_peso_producto                                       = $matriz_permiso_usuario['cod_estado_prod_peso_producto'];

$cod_estado_prod_transferencia                                       = $matriz_permiso_usuario['cod_estado_prod_transferencia'];
$cod_estado_prod_transferencia_registrar                             = $matriz_permiso_usuario['cod_estado_prod_transferencia_registrar'];
$cod_estado_prod_transferencia_editar                                = $matriz_permiso_usuario['cod_estado_prod_transferencia_editar'];
$cod_estado_prod_transferencia_eliminar                              = $matriz_permiso_usuario['cod_estado_prod_transferencia_eliminar'];
$cod_estado_prod_transferencia_imprimir                              = $matriz_permiso_usuario['cod_estado_prod_transferencia_imprimir'];
$cod_estado_prod_transferencia_exportar                              = $matriz_permiso_usuario['cod_estado_prod_transferencia_exportar'];

$cod_estado_prod_auditoria                                            = $matriz_permiso_usuario['cod_estado_prod_auditoria'];
$cod_estado_prod_auditoria_registrar                                  = $matriz_permiso_usuario['cod_estado_prod_auditoria_registrar'];
$cod_estado_prod_auditoria_editar                                     = $matriz_permiso_usuario['cod_estado_prod_auditoria_editar'];
$cod_estado_prod_auditoria_eliminar                                   = $matriz_permiso_usuario['cod_estado_prod_auditoria_eliminar'];
$cod_estado_prod_auditoria_imprimir                                   = $matriz_permiso_usuario['cod_estado_prod_auditoria_imprimir'];
$cod_estado_prod_auditoria_exportar                                   = $matriz_permiso_usuario['cod_estado_prod_auditoria_exportar'];

$cod_estado_plan_separe                                              = $matriz_permiso_usuario['cod_estado_plan_separe'];
$cod_estado_plan_separe_registrar                                    = $matriz_permiso_usuario['cod_estado_plan_separe_registrar'];
$cod_estado_plan_separe_editar                                       = $matriz_permiso_usuario['cod_estado_plan_separe_editar'];
$cod_estado_plan_separe_eliminar                                     = $matriz_permiso_usuario['cod_estado_plan_separe_eliminar'];
$cod_estado_plan_separe_imprimir                                     = $matriz_permiso_usuario['cod_estado_plan_separe_imprimir'];
$cod_estado_plan_separe_exportar                                     = $matriz_permiso_usuario['cod_estado_plan_separe_exportar'];

$cod_estado_contabilidad                                             = $matriz_permiso_usuario['cod_estado_contabilidad'];
$cod_estado_contabilidad_mov_contable                                = $matriz_permiso_usuario['cod_estado_contabilidad_mov_contable'];
$cod_estado_contabilidad_mov_contable_registrar                      = $matriz_permiso_usuario['cod_estado_contabilidad_mov_contable_registrar'];
$cod_estado_contabilidad_mov_contable_editar                         = $matriz_permiso_usuario['cod_estado_contabilidad_mov_contable_editar'];
$cod_estado_contabilidad_mov_contable_eliminar                       = $matriz_permiso_usuario['cod_estado_contabilidad_mov_contable_eliminar'];
$cod_estado_contabilidad_mov_contable_imprimir                       = $matriz_permiso_usuario['cod_estado_contabilidad_mov_contable_imprimir'];
$cod_estado_contabilidad_mov_contable_exportar                       = $matriz_permiso_usuario['cod_estado_contabilidad_mov_contable_exportar'];

$cod_estado_contabilidad_pyg                                         = $matriz_permiso_usuario['cod_estado_contabilidad_pyg'];
$cod_estado_contabilidad_pyg_registrar                               = $matriz_permiso_usuario['cod_estado_contabilidad_pyg_registrar'];
$cod_estado_contabilidad_pyg_editar                                  = $matriz_permiso_usuario['cod_estado_contabilidad_pyg_editar'];
$cod_estado_contabilidad_pyg_eliminar                                = $matriz_permiso_usuario['cod_estado_contabilidad_pyg_eliminar'];
$cod_estado_contabilidad_pyg_imprimir                                = $matriz_permiso_usuario['cod_estado_contabilidad_pyg_imprimir'];
$cod_estado_contabilidad_pyg_exportar                                = $matriz_permiso_usuario['cod_estado_contabilidad_pyg_exportar'];

$cod_estado_contabilidad_balance                                     = $matriz_permiso_usuario['cod_estado_contabilidad_balance'];
$cod_estado_contabilidad_balance_pyg_registrar                       = $matriz_permiso_usuario['cod_estado_contabilidad_balance_pyg_registrar'];
$cod_estado_contabilidad_balance_pyg_editar                          = $matriz_permiso_usuario['cod_estado_contabilidad_balance_pyg_editar'];
$cod_estado_contabilidad_balance_pyg_eliminar                        = $matriz_permiso_usuario['cod_estado_contabilidad_balance_pyg_eliminar'];
$cod_estado_contabilidad_balance_pyg_imprimir                        = $matriz_permiso_usuario['cod_estado_contabilidad_balance_pyg_imprimir'];
$cod_estado_contabilidad_balance_pyg_exportar                        = $matriz_permiso_usuario['cod_estado_contabilidad_balance_pyg_exportar'];

$cod_estado_contabilidad_puc                                         = $matriz_permiso_usuario['cod_estado_contabilidad_puc'];
$cod_estado_contabilidad_puc_registrar                               = $matriz_permiso_usuario['cod_estado_contabilidad_puc_registrar'];
$cod_estado_contabilidad_puc_editar                                  = $matriz_permiso_usuario['cod_estado_contabilidad_puc_editar'];
$cod_estado_contabilidad_puc_eliminar                                = $matriz_permiso_usuario['cod_estado_contabilidad_puc_eliminar'];
$cod_estado_contabilidad_puc_imprimir                                = $matriz_permiso_usuario['cod_estado_contabilidad_puc_imprimir'];
$cod_estado_contabilidad_puc_exportar                                = $matriz_permiso_usuario['cod_estado_contabilidad_puc_exportar'];

$cod_estado_facturacion                                              = $matriz_permiso_usuario['cod_estado_facturacion'];
$cod_estado_facturacion_venta                                        = $matriz_permiso_usuario['cod_estado_facturacion_venta'];
$cod_estado_facturacion_venta_registrar                              = $matriz_permiso_usuario['cod_estado_facturacion_venta_registrar'];
$cod_estado_facturacion_venta_editar                                 = $matriz_permiso_usuario['cod_estado_facturacion_venta_editar'];
$cod_estado_facturacion_venta_eliminar                               = $matriz_permiso_usuario['cod_estado_facturacion_venta_eliminar'];
$cod_estado_facturacion_venta_imprimir                               = $matriz_permiso_usuario['cod_estado_facturacion_venta_imprimir'];
$cod_estado_facturacion_venta_exportar                               = $matriz_permiso_usuario['cod_estado_facturacion_venta_exportar'];
$cod_estado_facturacion_venta_devol                                  = $matriz_permiso_usuario['cod_estado_facturacion_venta_devol'];

$cod_estado_facturacion_compra                                       = $matriz_permiso_usuario['cod_estado_facturacion_compra'];
$cod_estado_facturacion_compra_registrar                             = $matriz_permiso_usuario['cod_estado_facturacion_compra_registrar'];
$cod_estado_facturacion_compra_editar                                = $matriz_permiso_usuario['cod_estado_facturacion_compra_editar'];
$cod_estado_facturacion_compra_eliminar                              = $matriz_permiso_usuario['cod_estado_facturacion_compra_eliminar'];
$cod_estado_facturacion_compra_imprimir                              = $matriz_permiso_usuario['cod_estado_facturacion_compra_imprimir'];
$cod_estado_facturacion_compra_exportar                              = $matriz_permiso_usuario['cod_estado_facturacion_compra_exportar'];
$cod_estado_facturacion_compra_devol                                 = $matriz_permiso_usuario['cod_estado_facturacion_compra_devol'];

$cod_estado_facturacion_devol_venta                                  = $matriz_permiso_usuario['cod_estado_facturacion_devol_venta'];
$cod_estado_facturacion_devol_inventario                             = $matriz_permiso_usuario['cod_estado_facturacion_devol_inventario'];

$cod_estado_cotizacion                                               = $matriz_permiso_usuario['cod_estado_cotizacion'];
$cod_estado_cotizacion_venta                                         = $matriz_permiso_usuario['cod_estado_cotizacion_venta'];
$cod_estado_cotizacion_venta_registrar                               = $matriz_permiso_usuario['cod_estado_cotizacion_venta_registrar'];
$cod_estado_cotizacion_venta_editar                                  = $matriz_permiso_usuario['cod_estado_cotizacion_venta_editar'];
$cod_estado_cotizacion_venta_eliminar                                = $matriz_permiso_usuario['cod_estado_cotizacion_venta_eliminar'];
$cod_estado_cotizacion_venta_imprimir                                = $matriz_permiso_usuario['cod_estado_cotizacion_venta_imprimir'];
$cod_estado_cotizacion_venta_exportar                                = $matriz_permiso_usuario['cod_estado_cotizacion_venta_exportar'];

$cod_estado_cotizacion_compra                                        = $matriz_permiso_usuario['cod_estado_cotizacion_compra'];
$cod_estado_cotizacion_compra_registrar                              = $matriz_permiso_usuario['cod_estado_cotizacion_compra_registrar'];
$cod_estado_cotizacion_compra_editar                                 = $matriz_permiso_usuario['cod_estado_cotizacion_compra_editar'];
$cod_estado_cotizacion_compra_eliminar                               = $matriz_permiso_usuario['cod_estado_cotizacion_compra_eliminar'];
$cod_estado_cotizacion_compra_imprimir                               = $matriz_permiso_usuario['cod_estado_cotizacion_compra_imprimir'];
$cod_estado_cotizacion_compra_exportar                               = $matriz_permiso_usuario['cod_estado_cotizacion_compra_exportar'];

$cod_estado_venta                                                    = $matriz_permiso_usuario['cod_estado_venta'];
$cod_estado_venta_manual                                             = $matriz_permiso_usuario['cod_estado_venta_manual'];
$cod_estado_venta_barras                                             = $matriz_permiso_usuario['cod_estado_venta_barras'];
$cod_estado_venta_fecha_venta                                        = $matriz_permiso_usuario['cod_estado_venta_fecha_venta'];
$cod_estado_venta_preventa                                           = $matriz_permiso_usuario['cod_estado_venta_preventa'];
$cod_estado_venta_propina                                            = $matriz_permiso_usuario['cod_estado_venta_propina'];
$cod_estado_venta_bolsa                                              = $matriz_permiso_usuario['cod_estado_venta_bolsa'];
$cod_estado_venta_observacion                                        = $matriz_permiso_usuario['cod_estado_venta_observacion'];

$cod_estado_tercero                                                  = $matriz_permiso_usuario['cod_estado_tercero'];
$cod_estado_tercero_registrar                                        = $matriz_permiso_usuario['cod_estado_tercero_registrar'];
$cod_estado_tercero_editar                                           = $matriz_permiso_usuario['cod_estado_tercero_editar'];
$cod_estado_tercero_eliminar                                         = $matriz_permiso_usuario['cod_estado_tercero_eliminar'];
$cod_estado_tercero_imprimir                                         = $matriz_permiso_usuario['cod_estado_tercero_imprimir'];
$cod_estado_tercero_exportar                                         = $matriz_permiso_usuario['cod_estado_tercero_exportar'];

$cod_estado_cita                                                     = $matriz_permiso_usuario['cod_estado_cita'];
$cod_estado_cita_registrar                                           = $matriz_permiso_usuario['cod_estado_cita_registrar'];
$cod_estado_cita_editar                                              = $matriz_permiso_usuario['cod_estado_cita_editar'];
$cod_estado_cita_eliminar                                            = $matriz_permiso_usuario['cod_estado_cita_eliminar'];
$cod_estado_cita_imprimir                                            = $matriz_permiso_usuario['cod_estado_cita_imprimir'];
$cod_estado_cita_exportar                                            = $matriz_permiso_usuario['cod_estado_cita_exportar'];

$cod_estado_cuenta                                                   = $matriz_permiso_usuario['cod_estado_cuenta'];
$cod_estado_cuenta_cobrar                                            = $matriz_permiso_usuario['cod_estado_cuenta_cobrar'];
$cod_estado_cuenta_cobrar_registrar                                  = $matriz_permiso_usuario['cod_estado_cuenta_cobrar_registrar'];
$cod_estado_cuenta_cobrar_editar                                     = $matriz_permiso_usuario['cod_estado_cuenta_cobrar_editar'];
$cod_estado_cuenta_cobrar_eliminar                                   = $matriz_permiso_usuario['cod_estado_cuenta_cobrar_eliminar'];
$cod_estado_cuenta_cobrar_imprimir                                   = $matriz_permiso_usuario['cod_estado_cuenta_cobrar_imprimir'];
$cod_estado_cuenta_cobrar_exportar                                   = $matriz_permiso_usuario['cod_estado_cuenta_cobrar_exportar'];

$cod_estado_cuenta_pagar                                             = $matriz_permiso_usuario['cod_estado_cuenta_pagar'];
$cod_estado_cuenta_pagar_registrar                                   = $matriz_permiso_usuario['cod_estado_cuenta_pagar_registrar'];
$cod_estado_cuenta_pagar_editar                                      = $matriz_permiso_usuario['cod_estado_cuenta_pagar_editar'];
$cod_estado_cuenta_pagar_eliminar                                    = $matriz_permiso_usuario['cod_estado_cuenta_pagar_eliminar'];
$cod_estado_cuenta_pagar_imprimir                                    = $matriz_permiso_usuario['cod_estado_cuenta_pagar_imprimir'];
$cod_estado_cuenta_pagar_exportar                                    = $matriz_permiso_usuario['cod_estado_cuenta_pagar_exportar'];

$cod_estado_cierre_caja                                              = $matriz_permiso_usuario['cod_estado_cierre_caja'];
$cod_estado_cierre_caja_registrar                                    = $matriz_permiso_usuario['cod_estado_cierre_caja_registrar'];
$cod_estado_cierre_caja_editar                                       = $matriz_permiso_usuario['cod_estado_cierre_caja_editar'];
$cod_estado_cierre_caja_eliminar                                     = $matriz_permiso_usuario['cod_estado_cierre_caja_eliminar'];
$cod_estado_cierre_caja_imprimir                                     = $matriz_permiso_usuario['cod_estado_cierre_caja_imprimir'];
$cod_estado_cierre_caja_exportar                                     = $matriz_permiso_usuario['cod_estado_cierre_caja_exportar'];

$cod_estado_egreso                                                   = $matriz_permiso_usuario['cod_estado_egreso'];
$cod_estado_egreso_registrar                                         = $matriz_permiso_usuario['cod_estado_egreso_registrar'];
$cod_estado_egreso_editar                                            = $matriz_permiso_usuario['cod_estado_egreso_editar'];
$cod_estado_egreso_eliminar                                          = $matriz_permiso_usuario['cod_estado_egreso_eliminar'];
$cod_estado_egreso_imprimir                                          = $matriz_permiso_usuario['cod_estado_egreso_imprimir'];
$cod_estado_egreso_exportar                                          = $matriz_permiso_usuario['cod_estado_egreso_exportar'];

$cod_estado_sticker_barra                                            = $matriz_permiso_usuario['cod_estado_sticker_barra'];
$cod_estado_sticker_barra_registrar                                  = $matriz_permiso_usuario['cod_estado_sticker_barra_registrar'];
$cod_estado_sticker_barra_editar                                     = $matriz_permiso_usuario['cod_estado_sticker_barra_editar'];
$cod_estado_sticker_barra_eliminar                                   = $matriz_permiso_usuario['cod_estado_sticker_barra_eliminar'];
$cod_estado_sticker_barra_imprimir                                   = $matriz_permiso_usuario['cod_estado_sticker_barra_imprimir'];
$cod_estado_sticker_barra_exportar                                   = $matriz_permiso_usuario['cod_estado_sticker_barra_exportar'];
$cod_estado_sticker_barra_observacion                                = $matriz_permiso_usuario['cod_estado_sticker_barra_observacion'];
$cod_estado_sticker_barra_archivo_plano                              = $matriz_permiso_usuario['cod_estado_sticker_barra_archivo_plano'];

$cod_estado_reporte                                                  = $matriz_permiso_usuario['cod_estado_reporte'];
$cod_estado_reporte_venta                                            = $matriz_permiso_usuario['cod_estado_reporte_venta'];
$cod_estado_reporte_venta_registrar                                  = $matriz_permiso_usuario['cod_estado_reporte_venta_registrar'];
$cod_estado_reporte_venta_editar                                     = $matriz_permiso_usuario['cod_estado_reporte_venta_editar'];
$cod_estado_reporte_venta_eliminar                                   = $matriz_permiso_usuario['cod_estado_reporte_venta_eliminar'];
$cod_estado_reporte_venta_imprimir                                   = $matriz_permiso_usuario['cod_estado_reporte_venta_imprimir'];
$cod_estado_reporte_venta_exportar                                   = $matriz_permiso_usuario['cod_estado_reporte_venta_exportar'];

$cod_estado_reporte_compra                                           = $matriz_permiso_usuario['cod_estado_reporte_compra'];
$cod_estado_reporte_compra_registrar                                 = $matriz_permiso_usuario['cod_estado_reporte_compra_registrar'];
$cod_estado_reporte_compra_editar                                    = $matriz_permiso_usuario['cod_estado_reporte_compra_editar'];
$cod_estado_reporte_compra_eliminar                                  = $matriz_permiso_usuario['cod_estado_reporte_compra_eliminar'];
$cod_estado_reporte_compra_imprimir                                  = $matriz_permiso_usuario['cod_estado_reporte_compra_imprimir'];
$cod_estado_reporte_compra_exportar                                  = $matriz_permiso_usuario['cod_estado_reporte_compra_exportar'];

$cod_estado_reporte_general                                          = $matriz_permiso_usuario['cod_estado_reporte_general'];
$cod_estado_reporte_general_registrar                                = $matriz_permiso_usuario['cod_estado_reporte_general_registrar'];
$cod_estado_reporte_general_editar                                   = $matriz_permiso_usuario['cod_estado_reporte_general_editar'];
$cod_estado_reporte_general_eliminar                                 = $matriz_permiso_usuario['cod_estado_reporte_general_eliminar'];
$cod_estado_reporte_general_imprimir                                 = $matriz_permiso_usuario['cod_estado_reporte_general_imprimir'];
$cod_estado_reporte_general_exportar                                 = $matriz_permiso_usuario['cod_estado_reporte_general_exportar'];

$cod_estado_reporte_mov_contable                                     = $matriz_permiso_usuario['cod_estado_reporte_mov_contable'];
$cod_estado_reporte_mov_contable_registrar                           = $matriz_permiso_usuario['cod_estado_reporte_mov_contable_registrar'];
$cod_estado_reporte_mov_contable_editar                              = $matriz_permiso_usuario['cod_estado_reporte_mov_contable_editar'];
$cod_estado_reporte_mov_contable_eliminar                            = $matriz_permiso_usuario['cod_estado_reporte_mov_contable_eliminar'];
$cod_estado_reporte_mov_contable_imprimir                            = $matriz_permiso_usuario['cod_estado_reporte_mov_contable_imprimir'];
$cod_estado_reporte_mov_contable_exportar                            = $matriz_permiso_usuario['cod_estado_reporte_mov_contable_exportar'];

$cod_estado_reporte_venta_por_producto                               = $matriz_permiso_usuario['cod_estado_reporte_venta_por_producto'];
$cod_estado_reporte_venta_por_producto_registrar                     = $matriz_permiso_usuario['cod_estado_reporte_venta_por_producto_registrar'];
$cod_estado_reporte_venta_por_producto_editar                        = $matriz_permiso_usuario['cod_estado_reporte_venta_por_producto_editar'];
$cod_estado_reporte_venta_por_producto_eliminar                      = $matriz_permiso_usuario['cod_estado_reporte_venta_por_producto_eliminar'];
$cod_estado_reporte_venta_por_producto_imprimir                      = $matriz_permiso_usuario['cod_estado_reporte_venta_por_producto_imprimir'];
$cod_estado_reporte_venta_por_producto_exportar                      = $matriz_permiso_usuario['cod_estado_reporte_venta_por_producto_exportar'];

$cod_estado_reporte_inventario                                       = $matriz_permiso_usuario['cod_estado_reporte_inventario'];
$cod_estado_reporte_inventario_registrar                             = $matriz_permiso_usuario['cod_estado_reporte_inventario_registrar'];
$cod_estado_reporte_inventario_editar                                = $matriz_permiso_usuario['cod_estado_reporte_inventario_editar'];
$cod_estado_reporte_inventario_eliminar                              = $matriz_permiso_usuario['cod_estado_reporte_inventario_eliminar'];
$cod_estado_reporte_inventario_imprimir                              = $matriz_permiso_usuario['cod_estado_reporte_inventario_imprimir'];
$cod_estado_reporte_inventario_exportar                              = $matriz_permiso_usuario['cod_estado_reporte_inventario_exportar'];

$cod_estado_reporte_prodcuto_vencer                                  = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_vencer'];
$cod_estado_reporte_prodcuto_vencer_registrar                        = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_vencer_registrar'];
$cod_estado_reporte_prodcuto_vencer_editar                           = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_vencer_editar'];
$cod_estado_reporte_prodcuto_vencer_eliminar                         = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_vencer_eliminar'];
$cod_estado_reporte_prodcuto_vencer_imprimir                         = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_vencer_imprimir'];
$cod_estado_reporte_prodcuto_vencer_exportar                         = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_vencer_exportar'];

$cod_estado_reporte_prodcuto_mantenimiento                           = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento'];
$cod_estado_reporte_prodcuto_mantenimiento_registrar                 = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_registrar'];
$cod_estado_reporte_prodcuto_mantenimiento_editar                    = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_editar'];
$cod_estado_reporte_prodcuto_mantenimiento_eliminar                  = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_eliminar'];
$cod_estado_reporte_prodcuto_mantenimiento_imprimir                  = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_imprimir'];
$cod_estado_reporte_prodcuto_mantenimiento_exportar                  = $matriz_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_exportar'];

$cod_estado_reporte_cumplanos_tercero                                = $matriz_permiso_usuario['cod_estado_reporte_cumplanos_tercero'];
$cod_estado_reporte_cumplanos_tercero_registrar                      = $matriz_permiso_usuario['cod_estado_reporte_cumplanos_tercero_registrar'];
$cod_estado_reporte_cumplanos_tercero_editar                         = $matriz_permiso_usuario['cod_estado_reporte_cumplanos_tercero_editar'];
$cod_estado_reporte_cumplanos_tercero_eliminar                       = $matriz_permiso_usuario['cod_estado_reporte_cumplanos_tercero_eliminar'];
$cod_estado_reporte_cumplanos_tercero_imprimir                       = $matriz_permiso_usuario['cod_estado_reporte_cumplanos_tercero_imprimir'];
$cod_estado_reporte_cumplanos_tercero_exportar                       = $matriz_permiso_usuario['cod_estado_reporte_cumplanos_tercero_exportar'];

$cod_estado_admin                                                    = $matriz_permiso_usuario['cod_estado_admin'];

$cod_estado_info_empresa                                             = $matriz_permiso_usuario['cod_estado_info_empresa'];
$cod_estado_info_empresa_registrar                                   = $matriz_permiso_usuario['cod_estado_info_empresa_registrar'];
$cod_estado_info_empresa_editar                                      = $matriz_permiso_usuario['cod_estado_info_empresa_editar'];
$cod_estado_info_empresa_eliminar                                    = $matriz_permiso_usuario['cod_estado_info_empresa_eliminar'];
$cod_estado_info_empresa_imprimir                                    = $matriz_permiso_usuario['cod_estado_info_empresa_imprimir'];
$cod_estado_info_empresa_exportar                                    = $matriz_permiso_usuario['cod_estado_info_empresa_exportar'];

$cod_estado_usuario                                                  = $matriz_permiso_usuario['cod_estado_usuario'];
$cod_estado_usuario_registrar                                        = $matriz_permiso_usuario['cod_estado_usuario_registrar'];
$cod_estado_usuario_editar                                           = $matriz_permiso_usuario['cod_estado_usuario_editar'];
$cod_estado_usuario_eliminar                                         = $matriz_permiso_usuario['cod_estado_usuario_eliminar'];
$cod_estado_usuario_imprimir                                         = $matriz_permiso_usuario['cod_estado_usuario_imprimir'];
$cod_estado_usuario_exportar                                         = $matriz_permiso_usuario['cod_estado_usuario_exportar'];

$cod_estado_dependencia                                              = $matriz_permiso_usuario['cod_estado_dependencia'];
$cod_estado_dependencia_registrar                                    = $matriz_permiso_usuario['cod_estado_dependencia_registrar'];
$cod_estado_dependencia_editar                                       = $matriz_permiso_usuario['cod_estado_dependencia_editar'];
$cod_estado_dependencia_eliminar                                     = $matriz_permiso_usuario['cod_estado_dependencia_eliminar'];
$cod_estado_dependencia_imprimir                                     = $matriz_permiso_usuario['cod_estado_dependencia_imprimir'];
$cod_estado_dependencia_exportar                                     = $matriz_permiso_usuario['cod_estado_dependencia_exportar'];

$cod_estado_resol_facturacion                                        = $matriz_permiso_usuario['cod_estado_resol_facturacion'];
$cod_estado_resol_facturacion_registrar                              = $matriz_permiso_usuario['cod_estado_resol_facturacion_registrar'];
$cod_estado_resol_facturacion_editar                                 = $matriz_permiso_usuario['cod_estado_resol_facturacion_editar'];
$cod_estado_resol_facturacion_eliminar                               = $matriz_permiso_usuario['cod_estado_resol_facturacion_eliminar'];
$cod_estado_resol_facturacion_imprimir                               = $matriz_permiso_usuario['cod_estado_resol_facturacion_imprimir'];
$cod_estado_resol_facturacion_exportar                               = $matriz_permiso_usuario['cod_estado_resol_facturacion_exportar'];

$cod_estado_numero_letras                                            = $matriz_permiso_usuario['cod_estado_numero_letras'];
$cod_estado_numero_letras_registrar                                  = $matriz_permiso_usuario['cod_estado_numero_letras_registrar'];
$cod_estado_numero_letras_editar                                     = $matriz_permiso_usuario['cod_estado_numero_letras_editar'];
$cod_estado_numero_letras_eliminar                                   = $matriz_permiso_usuario['cod_estado_numero_letras_eliminar'];
$cod_estado_numero_letras_imprimir                                   = $matriz_permiso_usuario['cod_estado_numero_letras_imprimir'];
$cod_estado_numero_letras_exportar                                   = $matriz_permiso_usuario['cod_estado_numero_letras_exportar'];

$cod_estado_eliminar                                                 = $matriz_permiso_usuario['cod_estado_eliminar'];
$cod_estado_eliminar_usuario                                         = $matriz_permiso_usuario['cod_estado_eliminar_usuario'];
$cod_estado_eliminar_tercero                                         = $matriz_permiso_usuario['cod_estado_eliminar_tercero'];
$cod_estado_eliminar_producto                                        = $matriz_permiso_usuario['cod_estado_eliminar_producto'];

$cod_estado_licencia                                                 = $matriz_permiso_usuario['cod_estado_licencia'];
$cod_estado_licencia_registrar                                       = $matriz_permiso_usuario['cod_estado_licencia_registrar'];
$cod_estado_licencia_editar                                          = $matriz_permiso_usuario['cod_estado_licencia_editar'];
$cod_estado_licencia_imprimir                                        = $matriz_permiso_usuario['cod_estado_licencia_imprimir'];
$cod_estado_licencia_exportar                                        = $matriz_permiso_usuario['cod_estado_licencia_exportar'];

$cod_estado_repositorio                                              = $matriz_permiso_usuario['cod_estado_repositorio'];
$cod_estado_repositorio_registrar                                    = $matriz_permiso_usuario['cod_estado_repositorio_registrar'];
$cod_estado_repositorio_editar                                       = $matriz_permiso_usuario['cod_estado_repositorio_editar'];
$cod_estado_repositorio_eliminar                                     = $matriz_permiso_usuario['cod_estado_repositorio_eliminar'];
$cod_estado_repositorio_imprimir                                     = $matriz_permiso_usuario['cod_estado_repositorio_imprimir'];
$cod_estado_repositorio_exportar                                     = $matriz_permiso_usuario['cod_estado_repositorio_exportar'];


$cod_estado_prod_cod_rodeo                                           = $matriz_permiso_usuario['cod_estado_prod_cod_rodeo'];
$cod_estado_prod_nombre_rodeo                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_rodeo'];
$cod_estado_prod_nombre_sexo                                         = $matriz_permiso_usuario['cod_estado_prod_nombre_sexo'];
$cod_estado_prod_de_monta                                            = $matriz_permiso_usuario['cod_estado_prod_de_monta'];
$cod_estado_prod_nombre_estatus                                      = $matriz_permiso_usuario['cod_estado_prod_nombre_estatus'];
$cod_estado_prod_nombre_condicion_corporal                           = $matriz_permiso_usuario['cod_estado_prod_nombre_condicion_corporal'];
$cod_estado_prod_nombre_categoria_ingreso                            = $matriz_permiso_usuario['cod_estado_prod_nombre_categoria_ingreso'];
$cod_estado_prod_nombre_categoria_actual                             = $matriz_permiso_usuario['cod_estado_prod_nombre_categoria_actual'];
$cod_estado_prod_nombre_categoria_futura                             = $matriz_permiso_usuario['cod_estado_prod_nombre_categoria_futura'];
$cod_estado_prod_nombre_procedencia                                  = $matriz_permiso_usuario['cod_estado_prod_nombre_procedencia'];
$cod_estado_prod_nombre_tipo_monta                                   = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_monta'];
$cod_estado_prod_nombre_lote_categoria                               = $matriz_permiso_usuario['cod_estado_prod_nombre_lote_categoria'];
$cod_estado_prod_nombre_prog_reproductivo                            = $matriz_permiso_usuario['cod_estado_prod_nombre_prog_reproductivo'];
$cod_estado_prod_nombre_potrero                                      = $matriz_permiso_usuario['cod_estado_prod_nombre_potrero'];
$cod_estado_prod_nombre_lote                                         = $matriz_permiso_usuario['cod_estado_prod_nombre_lote'];
$cod_estado_prod_nombre_calidad_animal                               = $matriz_permiso_usuario['cod_estado_prod_nombre_calidad_animal'];
$cod_estado_prod_nombre_tipo_explotacion                             = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_explotacion'];
$cod_estado_prod_peso_compra                                         = $matriz_permiso_usuario['cod_estado_prod_peso_compra'];
$cod_estado_prod_precio_compra                                       = $matriz_permiso_usuario['cod_estado_prod_precio_compra'];
$cod_estado_prod_fecha_nac                                           = $matriz_permiso_usuario['cod_estado_prod_fecha_nac'];
$cod_estado_prod_fecha_compra                                        = $matriz_permiso_usuario['cod_estado_prod_fecha_compra'];
$cod_estado_prod_fecha_castracion                                    = $matriz_permiso_usuario['cod_estado_prod_fecha_castracion'];
$cod_estado_prod_nro_hierros                                         = $matriz_permiso_usuario['cod_estado_prod_nro_hierros'];
$cod_estado_prod_hierro_animal                                       = $matriz_permiso_usuario['cod_estado_prod_hierro_animal'];
$cod_estado_prod_numero_partos                                       = $matriz_permiso_usuario['cod_estado_prod_numero_partos'];
$cod_estado_prod_id_electronica                                      = $matriz_permiso_usuario['cod_estado_prod_id_electronica'];
$cod_estado_prod_nombre_raza1                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_raza1'];
$cod_estado_prod_nombre_raza2                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_raza2'];
$cod_estado_prod_nombre_raza3                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_raza3'];
$cod_estado_prod_nombre_raza4                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_raza4'];
$cod_estado_prod_ptj_raza1                                           = $matriz_permiso_usuario['cod_estado_prod_ptj_raza1'];
$cod_estado_prod_ptj_raza2                                           = $matriz_permiso_usuario['cod_estado_prod_ptj_raza2'];
$cod_estado_prod_ptj_raza3                                           = $matriz_permiso_usuario['cod_estado_prod_ptj_raza3'];
$cod_estado_prod_ptj_raza4                                           = $matriz_permiso_usuario['cod_estado_prod_ptj_raza4'];
$cod_estado_prod_id_padre                                            = $matriz_permiso_usuario['cod_estado_prod_id_padre'];
$cod_estado_prod_raza_padre                                          = $matriz_permiso_usuario['cod_estado_prod_raza_padre'];
$cod_estado_prod_id_madre                                            = $matriz_permiso_usuario['cod_estado_prod_id_madre'];
$cod_estado_prod_raza_madre                                          = $matriz_permiso_usuario['cod_estado_prod_raza_madre'];
$cod_estado_prod_partos_madre                                        = $matriz_permiso_usuario['cod_estado_prod_partos_madre'];
$cod_estado_prod_id_abuelo_paterno                                   = $matriz_permiso_usuario['cod_estado_prod_id_abuelo_paterno'];
$cod_estado_prod_id_abuelo_materno                                   = $matriz_permiso_usuario['cod_estado_prod_id_abuelo_materno'];
$cod_estado_prod_nombre_abuelo_paterno                               = $matriz_permiso_usuario['cod_estado_prod_nombre_abuelo_paterno'];
$cod_estado_prod_nombre_abuelo_materno                               = $matriz_permiso_usuario['cod_estado_prod_nombre_abuelo_materno'];
$cod_estado_prod_raza_abuelo_paterno                                 = $matriz_permiso_usuario['cod_estado_prod_raza_abuelo_paterno'];
$cod_estado_prod_raza_abuelo_materno                                 = $matriz_permiso_usuario['cod_estado_prod_raza_abuelo_materno'];
$cod_estado_prod_id_abuela_paterno                                   = $matriz_permiso_usuario['cod_estado_prod_id_abuela_paterno'];
$cod_estado_prod_id_abuela_materno                                   = $matriz_permiso_usuario['cod_estado_prod_id_abuela_materno'];
$cod_estado_prod_nombre_abuela_paterno                               = $matriz_permiso_usuario['cod_estado_prod_nombre_abuela_paterno'];
$cod_estado_prod_nombre_abuela_materno                               = $matriz_permiso_usuario['cod_estado_prod_nombre_abuela_materno'];
$cod_estado_prod_raza_abuela_paterno                                 = $matriz_permiso_usuario['cod_estado_prod_raza_abuela_paterno'];
$cod_estado_prod_raza_abuela_materno                                 = $matriz_permiso_usuario['cod_estado_prod_raza_abuela_materno'];
$cod_estado_prod_nombre_tipo_concepcion                              = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_concepcion'];
$cod_estado_prod_nombre_especie                                      = $matriz_permiso_usuario['cod_estado_prod_nombre_especie'];
$cod_estado_prod_marcas_tatuado                                      = $matriz_permiso_usuario['cod_estado_prod_marcas_tatuado'];
$cod_estado_prod_marcas_herrado                                      = $matriz_permiso_usuario['cod_estado_prod_marcas_herrado'];
$cod_estado_prod_marcas_descornado                                   = $matriz_permiso_usuario['cod_estado_prod_marcas_descornado'];
$cod_estado_prod_marcas_castrado                                     = $matriz_permiso_usuario['cod_estado_prod_marcas_castrado'];
$cod_estado_prod_nombre_color                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_color'];
$cod_estado_prod_nombre_temperamento                                 = $matriz_permiso_usuario['cod_estado_prod_nombre_temperamento'];
$cod_estado_prod_peso_nacer                                          = $matriz_permiso_usuario['cod_estado_prod_peso_nacer'];
$cod_estado_prod_aplomo_corvejon                                     = $matriz_permiso_usuario['cod_estado_prod_aplomo_corvejon'];
$cod_estado_prod_aplomo_cuartilla                                    = $matriz_permiso_usuario['cod_estado_prod_aplomo_cuartilla'];
$cod_estado_prod_aplomo_cascos                                       = $matriz_permiso_usuario['cod_estado_prod_aplomo_cascos'];
$cod_estado_prod_genital_circun_escrotal                             = $matriz_permiso_usuario['cod_estado_prod_genital_circun_escrotal'];
$cod_estado_prod_genital_prepusio                                    = $matriz_permiso_usuario['cod_estado_prod_genital_prepusio'];
$cod_estado_prod_genital_potencia                                    = $matriz_permiso_usuario['cod_estado_prod_genital_potencia'];
$cod_estado_prod_genital_semen                                       = $matriz_permiso_usuario['cod_estado_prod_genital_semen'];
$cod_estado_prod_observacion_animal                                  = $matriz_permiso_usuario['cod_estado_prod_observacion_animal'];
$cod_estado_prod_nombre_estado                                       = $matriz_permiso_usuario['cod_estado_prod_nombre_estado'];
$cod_estado_prod_nombre_tipo_movimiento                              = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_movimiento'];
$cod_estado_prod_nombre_categoria_animal_extern                      = $matriz_permiso_usuario['cod_estado_prod_nombre_categoria_animal_extern'];
$cod_estado_prod_cod_finca                                           = $matriz_permiso_usuario['cod_estado_prod_cod_finca'];
$cod_estado_prod_nombre_finca                                        = $matriz_permiso_usuario['cod_estado_prod_nombre_finca'];
$cod_estado_prod_nombre_categoria                                    = $matriz_permiso_usuario['cod_estado_prod_nombre_categoria'];
$cod_estado_prod_nombre_categoria_sub                                = $matriz_permiso_usuario['cod_estado_prod_nombre_categoria_sub'];
$cod_estado_prod_und_inv                                             = $matriz_permiso_usuario['cod_estado_prod_und_inv'];
$cod_estado_prod_descripcion_producto                                = $matriz_permiso_usuario['cod_estado_prod_descripcion_producto'];
$cod_estado_prod_url_img_producto_min                                = $matriz_permiso_usuario['cod_estado_prod_url_img_producto_min'];
$cod_estado_prod_url_img_producto_orig                               = $matriz_permiso_usuario['cod_estado_prod_url_img_producto_orig'];

$cod_estado_prod_nombre_promocion                                    = $matriz_permiso_usuario['cod_estado_prod_nombre_promocion'];
$cod_estado_prod_nombre_promocion_ing                                = $matriz_permiso_usuario['cod_estado_prod_nombre_promocion_ing'];

$cod_estado_prod_posologia_cantidad                                  = $matriz_permiso_usuario['cod_estado_prod_posologia_cantidad'];
$cod_estado_prod_posologia_peso                                      = $matriz_permiso_usuario['cod_estado_prod_posologia_peso'];
$cod_estado_prod_nombre_tipo_presentacion                            = $matriz_permiso_usuario['cod_estado_prod_nombre_tipo_presentacion'];
$cod_estado_prod_nombre_via_administracion                           = $matriz_permiso_usuario['cod_estado_prod_nombre_via_administracion'];
$cod_estado_prod_nombre_frec_duracion                                = $matriz_permiso_usuario['cod_estado_prod_nombre_frec_duracion'];

$cod_estado_eliminar_caja_mesa_virtual                               = $matriz_permiso_usuario['cod_estado_eliminar_caja_mesa_virtual'];
$cod_estado_precio_compra_mod_venta                                  = $matriz_permiso_usuario['cod_estado_precio_compra_mod_venta'];
$cod_estado_deshabilitar_opc_eliminar_ventatemp                      = $matriz_permiso_usuario['cod_estado_deshabilitar_opc_eliminar_ventatemp'];
$cod_estado_habilitar_btn_facturar_mod_venta                         = $matriz_permiso_usuario['cod_estado_habilitar_btn_facturar_mod_venta'];
$cod_estado_habilitar_ver_todas_facturas_vendedores                  = $matriz_permiso_usuario['cod_estado_habilitar_ver_todas_facturas_vendedores'];

$cod_estado_seguridad                                                = $matriz_permiso_usuario['cod_estado_seguridad'];
$cod_estado_seguridad_registrar                                      = $matriz_permiso_usuario['cod_estado_seguridad_registrar'];
$cod_estado_seguridad_editar                                         = $matriz_permiso_usuario['cod_estado_seguridad_editar'];
$cod_estado_seguridad_eliminar                                       = $matriz_permiso_usuario['cod_estado_seguridad_eliminar'];
$cod_estado_seguridad_imprimir                                       = $matriz_permiso_usuario['cod_estado_seguridad_imprimir'];
$cod_estado_seguridad_exportar                                       = $matriz_permiso_usuario['cod_estado_seguridad_exportar'];

$cod_estado_grafico_estadistico                                      = $matriz_permiso_usuario['cod_estado_grafico_estadistico'];
$cod_estado_grafico_estadistico_registrar                            = $matriz_permiso_usuario['cod_estado_grafico_estadistico_registrar'];
$cod_estado_grafico_estadistico_editar                               = $matriz_permiso_usuario['cod_estado_grafico_estadistico_editar'];
$cod_estado_grafico_estadistico_eliminar                             = $matriz_permiso_usuario['cod_estado_grafico_estadistico_eliminar'];
$cod_estado_grafico_estadistico_imprimir                             = $matriz_permiso_usuario['cod_estado_grafico_estadistico_imprimir'];
$cod_estado_grafico_estadistico_exportar                             = $matriz_permiso_usuario['cod_estado_grafico_estadistico_exportar'];

$cod_estado_nota_observacion                                         = $matriz_permiso_usuario['cod_estado_nota_observacion'];
$cod_estado_nota_observacion_registrar                               = $matriz_permiso_usuario['cod_estado_nota_observacion_registrar'];
$cod_estado_nota_observacion_editar                                  = $matriz_permiso_usuario['cod_estado_nota_observacion_editar'];
$cod_estado_nota_observacion_eliminar                                = $matriz_permiso_usuario['cod_estado_nota_observacion_eliminar'];
$cod_estado_nota_observacion_imprimir                                = $matriz_permiso_usuario['cod_estado_nota_observacion_imprimir'];
$cod_estado_nota_observacion_exportar                                = $matriz_permiso_usuario['cod_estado_nota_observacion_exportar'];

$cod_estado_tipo_roles                                               = $matriz_permiso_usuario['cod_estado_tipo_roles'];
$cod_estado_tipo_roles_registrar                                     = $matriz_permiso_usuario['cod_estado_tipo_roles_registrar'];
$cod_estado_tipo_roles_editar                                        = $matriz_permiso_usuario['cod_estado_tipo_roles_editar'];
$cod_estado_tipo_roles_eliminar                                      = $matriz_permiso_usuario['cod_estado_tipo_roles_eliminar'];
$cod_estado_tipo_roles_imprimir                                      = $matriz_permiso_usuario['cod_estado_tipo_roles_imprimir'];
$cod_estado_tipo_roles_exportar                                      = $matriz_permiso_usuario['cod_estado_tipo_roles_exportar'];

$cod_estado_agregar_productos_a_venta_facturada                      = $matriz_permiso_usuario['cod_estado_agregar_productos_a_venta_facturada'];
$cod_estado_eliminar_productos_a_venta_facturada                     = $matriz_permiso_usuario['cod_estado_eliminar_productos_a_venta_facturada'];
$cod_estado_habilitar_total_venta_ventatemp                          = $matriz_permiso_usuario['cod_estado_habilitar_total_venta_ventatemp'];
$cod_estado_habilitar_total_venta_caja_mesa_virtual                  = $matriz_permiso_usuario['cod_estado_habilitar_total_venta_caja_mesa_virtual'];
$cod_estado_habilitar_caja_mesa_virtual_en_uso                       = $matriz_permiso_usuario['cod_estado_habilitar_caja_mesa_virtual_en_uso'];
$cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso           = $matriz_permiso_usuario['cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso'];

$cod_estado_prod_inventario_producto_masivo                          = $matriz_permiso_usuario['cod_estado_prod_inventario_producto_masivo'];
$cod_estado_prod_transferencia_extern                                = $matriz_permiso_usuario['cod_estado_prod_transferencia_extern'];
$cod_estado_prod_transferencia_extern_registrar                      = $matriz_permiso_usuario['cod_estado_prod_transferencia_extern_registrar'];
$cod_estado_prod_transferencia_extern_editar                         = $matriz_permiso_usuario['cod_estado_prod_transferencia_extern_editar'];
$cod_estado_prod_transferencia_extern_eliminar                       = $matriz_permiso_usuario['cod_estado_prod_transferencia_extern_eliminar'];
$cod_estado_prod_transferencia_extern_imprimir                       = $matriz_permiso_usuario['cod_estado_prod_transferencia_extern_imprimir'];
$cod_estado_prod_transferencia_extern_exportar                       = $matriz_permiso_usuario['cod_estado_prod_transferencia_extern_exportar'];

$cod_estado_categoria                                                = $matriz_permiso_usuario['cod_estado_categoria'];
$cod_estado_categoria_registrar                                      = $matriz_permiso_usuario['cod_estado_categoria_registrar'];
$cod_estado_categoria_editar                                         = $matriz_permiso_usuario['cod_estado_categoria_editar'];
$cod_estado_categoria_eliminar                                       = $matriz_permiso_usuario['cod_estado_categoria_eliminar'];
$cod_estado_categoria_imprimir                                       = $matriz_permiso_usuario['cod_estado_categoria_imprimir'];
$cod_estado_categoria_exportar                                       = $matriz_permiso_usuario['cod_estado_categoria_exportar'];

$cod_estado_caja_mesa                                                = $matriz_permiso_usuario['cod_estado_caja_mesa'];
$cod_estado_caja_mesa_registrar                                      = $matriz_permiso_usuario['cod_estado_caja_mesa_registrar'];
$cod_estado_caja_mesa_editar                                         = $matriz_permiso_usuario['cod_estado_caja_mesa_editar'];
$cod_estado_caja_mesa_eliminar                                       = $matriz_permiso_usuario['cod_estado_caja_mesa_eliminar'];
$cod_estado_caja_mesa_imprimir                                       = $matriz_permiso_usuario['cod_estado_caja_mesa_imprimir'];
$cod_estado_caja_mesa_exportar                                       = $matriz_permiso_usuario['cod_estado_caja_mesa_exportar'];

$cod_estado_usuario_cambiar_contrasena                               = $matriz_permiso_usuario['cod_estado_usuario_cambiar_contrasena'];
$cod_estado_usuario_cambiar_firma                                    = $matriz_permiso_usuario['cod_estado_usuario_cambiar_firma'];
$cod_estado_usuario_permisos_personalizados                          = $matriz_permiso_usuario['cod_estado_usuario_permisos_personalizados'];
$cod_estado_usuario_permisos_asignar_matriz                          = $matriz_permiso_usuario['cod_estado_usuario_permisos_asignar_matriz'];
$cod_estado_usuario_cambiar_tipo_rol                                 = $matriz_permiso_usuario['cod_estado_usuario_cambiar_tipo_rol'];

$cod_estado_facturacion_venta_dependencia_user                       = $matriz_permiso_usuario['cod_estado_facturacion_venta_dependencia_user'];
$cod_estado_facturacion_venta_precio_venta_predet_user               = $matriz_permiso_usuario['cod_estado_facturacion_venta_precio_venta_predet_user'];
$cod_estado_facturacion_venta_acceso_facturas_otros_user             = $matriz_permiso_usuario['cod_estado_facturacion_venta_acceso_facturas_otros_user'];

$cod_estado_grafico_venta                                            = $matriz_permiso_usuario['cod_estado_grafico_venta'];
$cod_estado_grafico_compra                                           = $matriz_permiso_usuario['cod_estado_grafico_compra'];
$cod_estado_grafico_venta_compra                                     = $matriz_permiso_usuario['cod_estado_grafico_venta_compra'];
$cod_estado_grafico_venta_egreso                                     = $matriz_permiso_usuario['cod_estado_grafico_venta_egreso'];
$cod_estado_grafico_venta_tipo_pago                                  = $matriz_permiso_usuario['cod_estado_grafico_venta_tipo_pago'];
$cod_estado_grafico_venta_tipo_forma_pago                            = $matriz_permiso_usuario['cod_estado_grafico_venta_tipo_forma_pago'];
$cod_estado_grafico_venta_tipo_factura                               = $matriz_permiso_usuario['cod_estado_grafico_venta_tipo_factura'];
$cod_estado_grafico_venta_categoria                                  = $matriz_permiso_usuario['cod_estado_grafico_venta_categoria'];
$cod_estado_grafico_venta_dependencia                                = $matriz_permiso_usuario['cod_estado_grafico_venta_dependencia'];
$cod_estado_grafico_venta_tipo_compra                                = $matriz_permiso_usuario['cod_estado_grafico_venta_tipo_compra'];
$cod_estado_grafico_venta_tipo_metodo_envio                          = $matriz_permiso_usuario['cod_estado_grafico_venta_tipo_metodo_envio'];
$cod_estado_grafico_venta_tipo_aplicacion                            = $matriz_permiso_usuario['cod_estado_grafico_venta_tipo_aplicacion'];
$cod_estado_grafico_venta_producto                                   = $matriz_permiso_usuario['cod_estado_grafico_venta_producto'];
$cod_estado_grafico_venta_tercero                                    = $matriz_permiso_usuario['cod_estado_grafico_venta_tercero'];
$cod_estado_grafico_venta_tercero_producto                           = $matriz_permiso_usuario['cod_estado_grafico_venta_tercero_producto'];
$cod_estado_grafico_venta_tercero_domicilio                          = $matriz_permiso_usuario['cod_estado_grafico_venta_tercero_domicilio'];
$cod_estado_grafico_producto_mas_vendido_und_venta                   = $matriz_permiso_usuario['cod_estado_grafico_producto_mas_vendido_und_venta'];
$cod_estado_grafico_producto_mas_vendido_precio_venta                = $matriz_permiso_usuario['cod_estado_grafico_producto_mas_vendido_precio_venta'];
$cod_estado_grafico_producto_menos_vendido_und_venta                 = $matriz_permiso_usuario['cod_estado_grafico_producto_menos_vendido_und_venta'];
$cod_estado_grafico_producto_menos_vendido_precio_venta              = $matriz_permiso_usuario['cod_estado_grafico_producto_menos_vendido_precio_venta'];
$cod_estado_grafico_compra_precio_compra_precio_venta                = $matriz_permiso_usuario['cod_estado_grafico_compra_precio_compra_precio_venta'];
$cod_estado_grafico_ganancia_venta_egreso                            = $matriz_permiso_usuario['cod_estado_grafico_ganancia_venta_egreso'];
$cod_estado_grafico_ganancia_venta                                   = $matriz_permiso_usuario['cod_estado_grafico_ganancia_venta'];
$cod_estado_grafico_venta_por_vendedor                               = $matriz_permiso_usuario['cod_estado_grafico_venta_por_vendedor'];
$cod_estado_grafico_extras                                           = $matriz_permiso_usuario['cod_estado_grafico_extras'];
$cod_estado_deshabilitar_und_venta_ventatemp                         = $matriz_permiso_usuario['cod_estado_deshabilitar_und_venta_ventatemp'];
$cod_estado_deshabilitar_und_venta_atendido_cocina_chef              = $matriz_permiso_usuario['cod_estado_deshabilitar_und_venta_atendido_cocina_chef'];

$cod_estado_reporte_venta_total_ganancia                             = $matriz_permiso_usuario['cod_estado_reporte_venta_total_ganancia'];
$cod_estado_reporte_venta_total_utilidad                             = $matriz_permiso_usuario['cod_estado_reporte_venta_total_utilidad'];
$cod_estado_reporte_venta_total_comision                             = $matriz_permiso_usuario['cod_estado_reporte_venta_total_comision'];
$cod_estado_reporte_venta_total_propina                              = $matriz_permiso_usuario['cod_estado_reporte_venta_total_propina'];

$cod_estado_timbre_entrada_pedido_temporal_cocina                    = $matriz_permiso_usuario['cod_estado_timbre_entrada_pedido_temporal_cocina'];
$cod_estado_timbre_salida_pedido_temporal_cocina                     = $matriz_permiso_usuario['cod_estado_timbre_salida_pedido_temporal_cocina'];

$cod_estado_cuenta_cobrar_abono_glob                                 = $matriz_permiso_usuario['cod_estado_cuenta_cobrar_abono_glob'];
$cod_estado_origen_produccion                                        = $matriz_permiso_usuario['cod_estado_origen_produccion'];

$cod_estado_cantidad_caja_mesa                                       = $matriz_permiso_usuario['cod_estado_cantidad_caja_mesa'];
$cod_estado_reporte_fecha_pago_venta_cuenta_cobrar                   = $matriz_permiso_usuario['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar'];
$cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar                = $matriz_permiso_usuario['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar'];
$cod_estado_reporte_mantenimiento                                    = $matriz_permiso_usuario['cod_estado_reporte_mantenimiento'];
$cod_estado_lista_puc                                                = $matriz_permiso_usuario['cod_estado_lista_puc'];
$cod_estado_licencia_sistema                                         = $matriz_permiso_usuario['cod_estado_licencia_sistema'];
$cod_estado_repositorio_sistema                                      = $matriz_permiso_usuario['cod_estado_repositorio_sistema'];
$cod_estado_resolucion_factura                                       = $matriz_permiso_usuario['cod_estado_resolucion_factura'];
$cod_estado_numero_letra                                             = $matriz_permiso_usuario['cod_estado_numero_letra'];
$cod_estado_abrir_cajon_monedero_driv_direct                         = $matriz_permiso_usuario['cod_estado_abrir_cajon_monedero_driv_direct'];
$cod_estado_subreporte_venta_diaria                                  = $matriz_permiso_usuario['cod_estado_subreporte_venta_diaria'];
$cod_estado_subreporte_venta_mensual                                 = $matriz_permiso_usuario['cod_estado_subreporte_venta_mensual'];
$cod_estado_subreporte_venta_anual                                   = $matriz_permiso_usuario['cod_estado_subreporte_venta_anual'];
$cod_estado_subreporte_totalventa                                    = $matriz_permiso_usuario['cod_estado_subreporte_totalventa'];
$cod_estado_subreporte_impuestos                                     = $matriz_permiso_usuario['cod_estado_subreporte_impuestos'];
$cod_estado_subreporte_ventasgenerales                               = $matriz_permiso_usuario['cod_estado_subreporte_ventasgenerales'];
$cod_estado_subreporte_ventasporfacturas                             = $matriz_permiso_usuario['cod_estado_subreporte_ventasporfacturas'];
$cod_estado_subreporte_ventasportipofacturas                         = $matriz_permiso_usuario['cod_estado_subreporte_ventasportipofacturas'];
$cod_estado_subreporte_ventaspordependencia                          = $matriz_permiso_usuario['cod_estado_subreporte_ventaspordependencia'];
$cod_estado_subreporte_ventasportipoproducto                         = $matriz_permiso_usuario['cod_estado_subreporte_ventasportipoproducto'];
$cod_estado_subreporte_ventasporvendedor                             = $matriz_permiso_usuario['cod_estado_subreporte_ventasporvendedor'];
$cod_estado_subreporte_ventasporpropinavendedor                      = $matriz_permiso_usuario['cod_estado_subreporte_ventasporpropinavendedor'];
$cod_estado_subreporte_ventasporcreditocliente                       = $matriz_permiso_usuario['cod_estado_subreporte_ventasporcreditocliente'];
$cod_estado_dependencia_sub                                          = $matriz_permiso_usuario['cod_estado_dependencia_sub'];
$cod_estado_factura_compra_producto                                  = $matriz_permiso_usuario['cod_estado_factura_compra_producto'];
$cod_estado_precio_venta_variable_disponible                         = $matriz_permiso_usuario['cod_estado_precio_venta_variable_disponible'];
$cod_estado_habilitar_precio_venta_producto                          = $matriz_permiso_usuario['cod_estado_habilitar_precio_venta_producto'];
$cod_estado_und_producto_factura_compra                              = $matriz_permiso_usuario['cod_estado_und_producto_factura_compra'];
$cod_estado_edit_precio_venta_btn_factura_venta                      = $matriz_permiso_usuario['cod_estado_edit_precio_venta_btn_factura_venta'];
$cod_estado_edit_precio_venta_pvar_factura_venta                     = $matriz_permiso_usuario['cod_estado_edit_precio_venta_pvar_factura_venta'];
$cod_estado_edit_precio_venta_precio_estatico_factura_venta          = $matriz_permiso_usuario['cod_estado_edit_precio_venta_precio_estatico_factura_venta'];
$cod_estado_cambiar_vendedor_al_vender                               = $matriz_permiso_usuario['cod_estado_cambiar_vendedor_al_vender'];

$cod_estado_observacion_factura_compra                               = $matriz_permiso_usuario['cod_estado_observacion_factura_compra'];
$cod_estado_observacion_factura_venta                                = $matriz_permiso_usuario['cod_estado_observacion_factura_venta'];
$cod_estado_fecha_entrega_factura_compra                             = $matriz_permiso_usuario['cod_estado_fecha_entrega_factura_compra'];
$cod_estado_fecha_entrega_factura_venta                              = $matriz_permiso_usuario['cod_estado_fecha_entrega_factura_venta'];
$cod_estado_duplicar_factura_venta                                   = $matriz_permiso_usuario['cod_estado_duplicar_factura_venta'];
$cod_estado_publicidad                                               = $matriz_permiso_usuario['cod_estado_publicidad'];
$cod_estado_publicidad_registrar                                     = $matriz_permiso_usuario['cod_estado_publicidad_registrar'];
$cod_estado_publicidad_editar                                        = $matriz_permiso_usuario['cod_estado_publicidad_editar'];
$cod_estado_publicidad_eliminar                                      = $matriz_permiso_usuario['cod_estado_publicidad_eliminar'];
$cod_estado_publicidad_imprimir                                      = $matriz_permiso_usuario['cod_estado_publicidad_imprimir'];
$cod_estado_publicidad_exportar                                      = $matriz_permiso_usuario['cod_estado_publicidad_exportar'];
$cod_estado_editable_precio_total_venta_temp                         = $matriz_permiso_usuario['cod_estado_editable_precio_total_venta_temp'];
$cod_estado_btn_autopublicador_apifacebook_feed                      = $matriz_permiso_usuario['cod_estado_btn_autopublicador_apifacebook_feed'];
$cod_estado_btn_autopublicador_apifacebook_share                     = $matriz_permiso_usuario['cod_estado_btn_autopublicador_apifacebook_share'];

$cod_estado_renovaciones_alerta                                      = $matriz_permiso_usuario['cod_estado_renovaciones_alerta'];
$cod_estado_productos_con_problema_precios                           = $matriz_permiso_usuario['cod_estado_productos_con_problema_precios'];
$url_pag_redirec_ini_sesion                                          = $matriz_permiso_usuario['url_pag_redirec_ini_sesion'];
$cod_estado_domiciliario                                             = $matriz_permiso_usuario['cod_estado_domiciliario'];
$cod_estado_domiciliario_registrar                                   = $matriz_permiso_usuario['cod_estado_domiciliario_registrar'];
$cod_estado_domiciliario_editar                                      = $matriz_permiso_usuario['cod_estado_domiciliario_editar'];
$cod_estado_domiciliario_eliminar                                    = $matriz_permiso_usuario['cod_estado_domiciliario_eliminar'];
$cod_estado_domiciliario_imprimir                                    = $matriz_permiso_usuario['cod_estado_domiciliario_imprimir'];
$cod_estado_domiciliario_exportar                                    = $matriz_permiso_usuario['cod_estado_domiciliario_exportar'];

$cod_estado_cargar_factura_compra_vendedor                           = $matriz_permiso_usuario['cod_estado_cargar_factura_compra_vendedor'];
$cod_estado_cambiar_caja_mesa_venta_temp                             = $matriz_permiso_usuario['cod_estado_cambiar_caja_mesa_venta_temp'];
$cod_estado_fecha_venta_temp                                         = $matriz_permiso_usuario['cod_estado_fecha_venta_temp'];
$cod_estado_vendedor_venta_temp                                      = $matriz_permiso_usuario['cod_estado_vendedor_venta_temp'];
$cod_estado_moneda_venta_temp                                        = $matriz_permiso_usuario['cod_estado_moneda_venta_temp'];
$cod_estado_tipo_factura_venta_temp                                  = $matriz_permiso_usuario['cod_estado_tipo_factura_venta_temp'];
$cod_estado_forma_pago_venta_temp                                    = $matriz_permiso_usuario['cod_estado_forma_pago_venta_temp'];
$cod_estado_tipo_pago_venta_temp                                     = $matriz_permiso_usuario['cod_estado_tipo_pago_venta_temp'];
$cod_estado_tercero_venta_temp                                       = $matriz_permiso_usuario['cod_estado_tercero_venta_temp'];
$cod_estado_reibido_venta_temp                                       = $matriz_permiso_usuario['cod_estado_reibido_venta_temp'];
$cod_estado_deshabilitar_und_venta_temp                              = $matriz_permiso_usuario['cod_estado_deshabilitar_und_venta_temp'];
$cod_estado_und_inv_ventatemp                                        = $matriz_permiso_usuario['cod_estado_und_inv_ventatemp'];
$cod_estado_cambio_precio_venta_predeterm_producto                   = $matriz_permiso_usuario['cod_estado_cambio_precio_venta_predeterm_producto'];
$cod_estado_comision_ventatemp                                       = $matriz_permiso_usuario['cod_estado_comision_ventatemp'];

$cod_estado_grafico_estadistico_ventas                               = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas'];
$cod_estado_grafico_estadistico_ventas_vs_compras                    = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_vs_compras'];
$cod_estado_grafico_estadistico_ventas_vs_costos_ventas              = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_vs_costos_ventas'];
$cod_estado_grafico_estadistico_ventas_ganancias                     = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_ganancias'];
$cod_estado_grafico_estadistico_ventas_utilidad_vs_gastos_egresos    = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_utilidad_vs_gastos_egresos'];
$cod_estado_grafico_estadistico_ventas_productos_mas_vendidos        = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_productos_mas_vendidos'];
$cod_estado_grafico_estadistico_ventas_vendedor_por_fechas           = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_vendedor_por_fechas'];
$cod_estado_grafico_estadistico_ventas_proyeccion                    = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_proyeccion'];
$cod_estado_grafico_estadistico_ventas_polar                         = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_polar'];
$cod_estado_grafico_estadistico_ventas_regresion                     = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_regresion'];
$cod_estado_grafico_estadistico_ventas_regresion_3d                  = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_regresion_3d'];
$cod_estado_grafico_estadistico_ventas_regresion_scatter             = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_regresion_scatter'];
$cod_estado_grafico_estadistico_ventas_regresion_bubble              = $matriz_permiso_usuario['cod_estado_grafico_estadistico_ventas_regresion_bubble'];
$cod_estado_grafico_estadistico_compras                              = $matriz_permiso_usuario['cod_estado_grafico_estadistico_compras'];
$cod_estado_grafico_estadistico_gastos_egresos_torta                 = $matriz_permiso_usuario['cod_estado_grafico_estadistico_gastos_egresos_torta'];
$cod_estado_grafico_estadistico_producto_historial                   = $matriz_permiso_usuario['cod_estado_grafico_estadistico_producto_historial'];

$cod_estado_enviar_factura_venta_electronica_dian_api                = $matriz_permiso_usuario['cod_estado_enviar_factura_venta_electronica_dian_api'];
$cod_estado_enviar_nomina_electronica_dian_api                       = $matriz_permiso_usuario['cod_estado_enviar_nomina_electronica_dian_api'];
$cod_estado_enviar_documento_soporte_dian_api                        = $matriz_permiso_usuario['cod_estado_enviar_documento_soporte_dian_api'];
$cod_estado_enviar_eventos_recepcion_dian_api                        = $matriz_permiso_usuario['cod_estado_enviar_eventos_recepcion_dian_api'];
$cod_estado_enviar_factura_electronica_salud_dian_api                = $matriz_permiso_usuario['cod_estado_enviar_factura_electronica_salud_dian_api'];

$cod_estado_archivar_venta                                           = $matriz_permiso_usuario['cod_estado_archivar_venta'];
$cod_estado_reporte_venta_archivada                                  = $matriz_permiso_usuario['cod_estado_reporte_venta_archivada'];
$cod_estado_reporte_venta_archivada_y_normal                         = $matriz_permiso_usuario['cod_estado_reporte_venta_archivada_y_normal'];

$cod_estado_deshabilitar_btn_guardar_cargar_factura_compra           = $matriz_permiso_usuario['cod_estado_deshabilitar_btn_guardar_cargar_factura_compra'];
$limite_max_venta_temp_por_caja_mesa_usuario                         = $matriz_permiso_usuario['limite_max_venta_temp_por_caja_mesa_usuario'];

$cod_estado_total_compra_ventatemp                                   = $matriz_permiso_usuario['cod_estado_total_compra_ventatemp'];
$cod_estado_nota_credito                                             = $matriz_permiso_usuario['cod_estado_nota_credito'];
$cod_estado_nota_debito                                              = $matriz_permiso_usuario['cod_estado_nota_debito'];
$cod_estado_renta_alquiler                                           = $matriz_permiso_usuario['cod_estado_renta_alquiler'];
$cod_estado_reporte_certificado_retefuente                           = $matriz_permiso_usuario['cod_estado_reporte_certificado_retefuente'];
$cod_estado_cotizacion_und_inventario                                = $matriz_permiso_usuario['cod_estado_cotizacion_und_inventario'];
$cod_estado_cotizacion_precio_compra                                 = $matriz_permiso_usuario['cod_estado_cotizacion_precio_compra'];
$cod_estado_reporte_venta_electronica                                = $matriz_permiso_usuario['cod_estado_reporte_venta_electronica'];
$cod_estado_cliente                                                  = $matriz_permiso_usuario['cod_estado_cliente'];
$cod_estado_lider                                                    = $matriz_permiso_usuario['cod_estado_lider'];
$cod_estado_coordinador                                              = $matriz_permiso_usuario['cod_estado_coordinador'];
$cod_estado_asesor                                                   = $matriz_permiso_usuario['cod_estado_asesor'];
$cod_estado_proveedor                                                = $matriz_permiso_usuario['cod_estado_proveedor'];
$cod_estado_vendedor                                                 = $matriz_permiso_usuario['cod_estado_vendedor'];
$cod_estado_aliado_estrategico                                       = $matriz_permiso_usuario['cod_estado_aliado_estrategico'];
$cod_estado_entidad_crediticia                                       = $matriz_permiso_usuario['cod_estado_entidad_crediticia'];
$fecha_expedicion_tercero                                            = $matriz_permiso_usuario['fecha_expedicion_tercero'];
$cod_tienda                                                          = $matriz_permiso_usuario['cod_tienda'];
$cod_tipo_rol_sistecredito                                           = $matriz_permiso_usuario['cod_tipo_rol_sistecredito'];
$cod_estado_movimiento_contable_personal_registrar                   = $matriz_permiso_usuario['cod_estado_movimiento_contable_personal_registrar'];
$cod_estado_movimiento_contable_personal_editar                      = $matriz_permiso_usuario['cod_estado_movimiento_contable_personal_editar'];
$cod_estado_movimiento_contable_personal_eliminar                    = $matriz_permiso_usuario['cod_estado_movimiento_contable_personal_eliminar'];
$cod_estado_movimiento_contable_personal_imprimir                    = $matriz_permiso_usuario['cod_estado_movimiento_contable_personal_imprimir'];
$cod_estado_movimiento_contable_personal_exportar                    = $matriz_permiso_usuario['cod_estado_movimiento_contable_personal_exportar'];
$comision_funcionamiento_interes_propio_empresa_ptj                  = $matriz_permiso_usuario['comision_funcionamiento_interes_propio_empresa_ptj'];
?>