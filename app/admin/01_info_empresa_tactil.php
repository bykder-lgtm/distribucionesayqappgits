<?php
$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE (cod_info_empresa = '1')";
$consultar_info_empresa = mysqli_query($conectar, $sql_info_empresa) or die(mysqli_error($conectar));
$datos_info_empresa = mysqli_fetch_array($consultar_info_empresa);

$titulo                                                            = $datos_info_empresa['titulo'];
$desarrollador                                                     = $datos_info_empresa['desarrollador'];
$pag_desarrollador                                                 = $datos_info_empresa['pag_desarrollador'];
$anyo                                                              = $datos_info_empresa['anyo'];
$nombre                                                            = $datos_info_empresa['nombre'];
$eslogan                                                           = $datos_info_empresa['eslogan'];
$direccion                                                         = $datos_info_empresa['direccion'];
$localidad                                                         = $datos_info_empresa['localidad'];
$correo                                                            = $datos_info_empresa['correo'];
$dir_oficiana1                                                     = $datos_info_empresa['dir_oficiana1'];
$dir_oficiana2                                                     = $datos_info_empresa['dir_oficiana2'];
$dir_oficiana3                                                     = $datos_info_empresa['dir_oficiana3'];
$dir_oficiana4                                                     = $datos_info_empresa['dir_oficiana4'];
$tel1                                                              = $datos_info_empresa['tel1'];
$tel2                                                              = $datos_info_empresa['tel2'];
$tel3                                                              = $datos_info_empresa['tel3'];
$tel4                                                              = $datos_info_empresa['tel4'];
$cabecera                                                          = $datos_info_empresa['cabecera'];
$img_cabecera                                                      = $datos_info_empresa['img_cabecera'];
$telefono                                                          = $datos_info_empresa['telefono'];
//$nit                                                             = $datos_info_empresa['nit'];
$nit_empresa                                                       = $datos_info_empresa['nit_empresa'];
$regimen                                                           = $datos_info_empresa['regimen'];
$logotipo                                                          = $datos_info_empresa['logotipo'];
$icono                                                             = $datos_info_empresa['icono'];
$version                                                           = $datos_info_empresa['version'];
$url_redsocial_facebook                                            = $datos_info_empresa['url_redsocial_facebook'];
$url_redsocial_twitter                                             = $datos_info_empresa['url_redsocial_twitter'];
$url_redsocial_linkedin                                            = $datos_info_empresa['url_redsocial_linkedin'];
$url_redsocial_skype                                               = $datos_info_empresa['url_redsocial_skype'];
$url_redsocial_generic1                                            = $datos_info_empresa['url_redsocial_generic1'];
$url_redsocial_generic2                                            = $datos_info_empresa['url_redsocial_generic2'];
$url_redsocial_generic3                                            = $datos_info_empresa['url_redsocial_generic3'];
$keywords                                                          = $datos_info_empresa['keywords'];
$description                                                       = $datos_info_empresa['description'];
$author                                                            = $datos_info_empresa['author'];
$resena_info_empresa                                               = $datos_info_empresa['resena_info_empresa'];
$mision_info_empresa                                               = $datos_info_empresa['mision_info_empresa'];
$vision_info_empresa                                               = $datos_info_empresa['vision_info_empresa'];
$declaracion_privacidad_info_empresa                               = $datos_info_empresa['declaracion_privacidad_info_empresa'];
$politica_devolucion_info_empresa                                  = $datos_info_empresa['politica_devolucion_info_empresa'];
$info_entrega_info_empresa                                         = $datos_info_empresa['info_entrega_info_empresa'];
$longitud                                                          = $datos_info_empresa['longitud'];
$latitud                                                           = $datos_info_empresa['latitud'];
$url_mapa1                                                         = $datos_info_empresa['url_mapa1'];
$url_mapa2                                                         = $datos_info_empresa['url_mapa2'];
$cod_estado_reg_veterinaria                                        = $datos_info_empresa['cod_estado_reg_veterinaria'];
$cod_estado_posicion_gps_pedidos_global                            = $datos_info_empresa['cod_estado_posicion_gps_pedidos_global'];
$frag_icono                                                        = explode('../', $icono);
$pos_icono                                                         = $frag_icono[1];
$nombre_concepto_multi_virtual                                     = $datos_info_empresa['nombre_concepto_multi_virtual'];

$dias_vencimiento_producto_alerta                                  = $datos_info_empresa['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global                               = $datos_info_empresa['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                                    = $datos_info_empresa['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                                     = $datos_info_empresa['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                                            = $datos_info_empresa['cod_estado_dto1_global'];
$cod_estado_dto2_global                                            = $datos_info_empresa['cod_estado_dto2_global'];
$cod_estado_preventa_global                                        = $datos_info_empresa['cod_estado_preventa_global'];
$cod_estado_propina_global                                         = $datos_info_empresa['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global                             = $datos_info_empresa['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra                                   = $datos_info_empresa['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global                     = $datos_info_empresa['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global                             = $datos_info_empresa['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global                              = $datos_info_empresa['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global                               = $datos_info_empresa['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                                  = $datos_info_empresa['cod_estado_sticker_barras_global'];

$cod_estado_modulo_contabilidad_global                             = $datos_info_empresa['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global                               = $datos_info_empresa['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica                               = $datos_info_empresa['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                                = $datos_info_empresa['cod_estado_producto_consumo_global'];
$cod_estado_compra_caja_global                                     = $datos_info_empresa['cod_estado_compra_caja_global'];
$nombre_tipo_impresora_zebra_ticket                                = $datos_info_empresa['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                                   = $datos_info_empresa['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                                    = $datos_info_empresa['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                                          = $datos_info_empresa['cod_estado_egreso_global'];
$cod_estado_usuario_global                                         = $datos_info_empresa['cod_estado_usuario_global'];
$cod_estado_dependencia_global                                     = $datos_info_empresa['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                                    = $datos_info_empresa['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global                              = $datos_info_empresa['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                                            = $datos_info_empresa['cod_estado_cita_global'];
$cod_estado_factura_compra_global                                  = $datos_info_empresa['cod_estado_factura_compra_global'];

$cod_estado_modulo_producto_global                                 = $datos_info_empresa['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global                              = $datos_info_empresa['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                                    = $datos_info_empresa['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                                  = $datos_info_empresa['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                                   = $datos_info_empresa['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                                  = $datos_info_empresa['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                                    = $datos_info_empresa['cod_estado_modulo_admin_global'];
$cod_estado_pyg_global                                             = $datos_info_empresa['cod_estado_pyg_global'];
$cod_estado_balance_global                                         = $datos_info_empresa['cod_estado_balance_global'];
$cod_estado_mov_contable_global                                    = $datos_info_empresa['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                                    = $datos_info_empresa['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global                         = $datos_info_empresa['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                                = $datos_info_empresa['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                                       = $datos_info_empresa['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                                    = $datos_info_empresa['cod_estado_envio_correo_global'];
$cod_estado_ordenamiento_alfabetico_venta_global                   = $datos_info_empresa['cod_estado_ordenamiento_alfabetico_venta_global'];

$cod_estado_nocodif_precio_compra_sticker_global                   = $datos_info_empresa['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global                    = $datos_info_empresa['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global                          = $datos_info_empresa['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global                            = $datos_info_empresa['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global                             = $datos_info_empresa['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global                              = $datos_info_empresa['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global                    = $datos_info_empresa['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                                      = $datos_info_empresa['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                                            = $datos_info_empresa['nombre_empresa_sticker'];
$nombre_buscar_por                                                 = $datos_info_empresa['nombre_buscar_por'];

$cod_estado_img_producto_global                                    = $datos_info_empresa['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global                             = $datos_info_empresa['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                                          = $datos_info_empresa['cod_estado_animal_global'];
$cod_estado_producto_serial_global                                 = $datos_info_empresa['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global                              = $datos_info_empresa['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                                 = $datos_info_empresa['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global                   = $datos_info_empresa['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                                            = $datos_info_empresa['nombre_tipo_componente'];
$cod_estado_subproducto_global                                     = $datos_info_empresa['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                                = $datos_info_empresa['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                                       = $datos_info_empresa['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                                     = $datos_info_empresa['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global                       = $datos_info_empresa['cod_estado_observacion_tercero_venta_global'];

$cod_estado_alerta_fecha_nac_global                                = $datos_info_empresa['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                       = $datos_info_empresa['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                                   = $datos_info_empresa['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                                = $datos_info_empresa['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                             = $datos_info_empresa['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                            = $datos_info_empresa['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                       = $datos_info_empresa['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                                     = $datos_info_empresa['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                           = $datos_info_empresa['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                          = $datos_info_empresa['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                        = $datos_info_empresa['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                          = $datos_info_empresa['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                      = $datos_info_empresa['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                          = $datos_info_empresa['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                         = $datos_info_empresa['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                                     = $datos_info_empresa['costo_parqueo'];
$nombre_tipo_cobro_hotel                                           = $datos_info_empresa['nombre_tipo_cobro_hotel'];
$costo_hotel                                                       = $datos_info_empresa['costo_hotel'];
$cod_estado_parqueo_hotel_global                                   = $datos_info_empresa['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                           = $datos_info_empresa['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                         = $datos_info_empresa['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                           = $datos_info_empresa['cod_estado_plan_accion_correcion_global'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global               = $datos_info_empresa['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global        = $datos_info_empresa['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                       = $datos_info_empresa['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global            = $datos_info_empresa['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global                    = $datos_info_empresa['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global                   = $datos_info_empresa['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global                   = $datos_info_empresa['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global                 = $datos_info_empresa['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global                 = $datos_info_empresa['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global                 = $datos_info_empresa['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global               = $datos_info_empresa['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global               = $datos_info_empresa['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global              = $datos_info_empresa['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                       = $datos_info_empresa['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global               = $datos_info_empresa['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global                     = $datos_info_empresa['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global                 = $datos_info_empresa['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global                 = $datos_info_empresa['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global                    = $datos_info_empresa['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                       = $datos_info_empresa['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                          = $datos_info_empresa['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                                     = $datos_info_empresa['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                       = $datos_info_empresa['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                                  = $datos_info_empresa['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                           = $datos_info_empresa['cod_estado_marca_global'];
$cod_estado_proveedor_global                                       = $datos_info_empresa['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                                 = $datos_info_empresa['cod_estado_archivo_adjunto_global'];
$cod_estado_precio_compra_mod_venta_global                         = $datos_info_empresa['cod_estado_precio_compra_mod_venta_global'];

$cod_estado_timbre_entrada_pedido_temporal_cocina_global           = $datos_info_empresa['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global            = $datos_info_empresa['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_estado_subproducto_mostrar_imprimir_global                    = $datos_info_empresa['cod_estado_subproducto_mostrar_imprimir_global'];

$cod_estado_diferencia_ganancia_inventario_global                  = $datos_info_empresa['cod_estado_diferencia_ganancia_inventario_global'];
$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global     = $datos_info_empresa['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'];
$cod_estado_opcion_descontable_inv_global                          = $datos_info_empresa['cod_estado_opcion_descontable_inv_global'];
$cod_estado_hora_reporte_venta_global                              = $datos_info_empresa['cod_estado_hora_reporte_venta_global'];


$cod_estado_descuento_automatico_por_cambio_precio_venta_global    = $datos_info_empresa['cod_estado_descuento_automatico_por_cambio_precio_venta_global'];
$cod_estado_btn_categoria_desplegable_global                       = $datos_info_empresa['cod_estado_btn_categoria_desplegable_global'];

$cod_estado_consultar_precios_extern_global                        = $datos_info_empresa['cod_estado_consultar_precios_extern_global'];
$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global       = $datos_info_empresa['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'];
$cod_estado_nombre_producto_editable_factura_compra_global         = $datos_info_empresa['cod_estado_nombre_producto_editable_factura_compra_global'];
$cod_estado_tipo_compra_global                                     = $datos_info_empresa['cod_estado_tipo_compra_global'];

$nombre_campo_undidades_inv1                                       = $datos_info_empresa['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                       = $datos_info_empresa['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                       = $datos_info_empresa['nombre_campo_undidades_inv3'];
$cod_estado_nota_observacion_global                                = $datos_info_empresa['cod_estado_nota_observacion_global'];
$cod_estado_grafico_estadistico_global                             = $datos_info_empresa['cod_estado_grafico_estadistico_global'];
$cod_estado_inventario_bodega2_global                              = $datos_info_empresa['cod_estado_inventario_bodega2_global'];
$cod_estado_tipo_roles_global                                      = $datos_info_empresa['cod_estado_tipo_roles_global'];

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $datos_info_empresa['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $datos_info_empresa['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];

$cod_tipo_sistema_numeracion                                       = $datos_info_empresa['cod_tipo_sistema_numeracion'];

$cod_estado_lote_compra_global                                     = $datos_info_empresa['cod_estado_lote_compra_global'];
$cod_estado_tipo_metodo_envio_global                               = $datos_info_empresa['cod_estado_tipo_metodo_envio_global'];
$cod_estado_mod_domicilio_y_estado_habilitado_producto_global      = $datos_info_empresa['cod_estado_mod_domicilio_y_estado_habilitado_producto_global'];
$cod_estado_promocion_global                                       = $datos_info_empresa['cod_estado_promocion_global'];

$cod_estado_notificacion_alerta_correo_global                      = $datos_info_empresa['cod_estado_notificacion_alerta_correo_global'];
$cod_estado_notificacion_alerta_correo_copia_seguridad_global      = $datos_info_empresa['cod_estado_notificacion_alerta_correo_copia_seguridad_global'];
$cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global   = $datos_info_empresa['cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global'];
$cod_estado_notificacion_alerta_correo_productos_a_vencer_global   = $datos_info_empresa['cod_estado_notificacion_alerta_correo_productos_a_vencer_global'];
$cod_estado_notificacion_alerta_correo_productos_agotados_global   = $datos_info_empresa['cod_estado_notificacion_alerta_correo_productos_agotados_global'];
$cod_estado_notificacion_alerta_correo_venta_diaria_global         = $datos_info_empresa['cod_estado_notificacion_alerta_correo_venta_diaria_global'];

$cod_tipo_sistema_numeracion_und_compra                            = $datos_info_empresa['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $datos_info_empresa['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $datos_info_empresa['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $datos_info_empresa['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $datos_info_empresa['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $datos_info_empresa['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $datos_info_empresa['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $datos_info_empresa['nombre_tipo_campo_componente_html_precio_venta'];

if ($nombre_tipo_campo_componente_html_und_venta == 'text') { $nombre_tipo_campo_componente_html_und_venta = 'text'; } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if ($nombre_tipo_campo_componente_html_und_compra == 'text') { $nombre_tipo_campo_componente_html_und_compra = 'text'; } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_compra == 'text') { $nombre_tipo_campo_componente_html_precio_compra = 'text'; } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_venta == 'text') { $nombre_tipo_campo_componente_html_precio_venta = 'text'; } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }

$cod_estado_venta_dependencia_de_usuario_global                    = $datos_info_empresa['cod_estado_venta_dependencia_de_usuario_global'];
$nombre_carpeta_pagina                                             = $datos_info_empresa['nombre_carpeta_pagina'];
?>