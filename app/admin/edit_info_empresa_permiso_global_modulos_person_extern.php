<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_info_empresa.php"><h4>Editar Información</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_info_empresa                 = '1';
$pagina                           = '';

$mostrar_datos_sql = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '$cod_info_empresa'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$titulo                                                      = $matriz_consulta['titulo'];
$nombre                                                      = $matriz_consulta['nombre'];
$eslogan                                                     = $matriz_consulta['eslogan'];
$direccion                                                   = $matriz_consulta['direccion'];
$ciudad                                                      = $matriz_consulta['ciudad'];
$pais                                                        = $matriz_consulta['pais'];
$correo                                                      = $matriz_consulta['correo'];
$img_cabecera                                                = $matriz_consulta['img_cabecera'];
$telefono                                                    = $matriz_consulta['telefono'];
$info_legal                                                  = $matriz_consulta['info_legal'];
$logotipo                                                    = $matriz_consulta['logotipo'];
$propietario_nombres_apellidos                               = $matriz_consulta['propietario_nombres_apellidos'];
$propietario_nit                                             = $matriz_consulta['propietario_nit'];
$nit_empresa                                                 = $matriz_consulta['nit_empresa'];
$cabecera                                                    = $matriz_consulta['cabecera'];
$icono                                                       = $matriz_consulta['icono'];
$desarrollador                                               = $matriz_consulta['desarrollador'];
$pag_desarrollador                                           = $matriz_consulta['pag_desarrollador'];
$anyo                                                        = $matriz_consulta['anyo'];
$url_pag                                                     = $matriz_consulta['url_pag'];
$nombre_font                                                 = $matriz_consulta['nombre_font'];
$res                                                         = $matriz_consulta['res'];
$res1                                                        = $matriz_consulta['res1'];
$res2                                                        = $matriz_consulta['res2'];
$fecha_res                                                   = $matriz_consulta['fecha_res'];
$departamento                                                = $matriz_consulta['departamento'];
$localidad                                                   = $matriz_consulta['localidad'];
$reg_medico                                                  = $matriz_consulta['reg_medico'];
$regimen                                                     = $matriz_consulta['regimen'];
$version                                                     = $matriz_consulta['version'];
$propietario_url_firma                                       = $matriz_consulta['propietario_url_firma'];
$fecha_time                                                  = $matriz_consulta['fecha_time'];
$licencia                                                    = $matriz_consulta['licencia'];
$tamano_font                                                 = $matriz_consulta['tamano_font'];
$info_histclinic                                             = $matriz_consulta['info_histclinic'];
$info_aptlaboral                                             = $matriz_consulta['info_aptlaboral'];
$dia_ini_facturacion                                         = $matriz_consulta['dia_ini_facturacion'];
$dia_fin_facturacion                                         = $matriz_consulta['dia_fin_facturacion'];
$smtp_correo_host                                            = $matriz_consulta['smtp_correo_host'];
$smtp_correo_auth                                            = $matriz_consulta['smtp_correo_auth'];
$smtp_correo_username                                        = $matriz_consulta['smtp_correo_username'];
$smtp_correo_password                                        = $matriz_consulta['smtp_correo_password'];
$smtp_correo_secure                                          = $matriz_consulta['smtp_correo_secure'];
$smtp_correo_port                                            = $matriz_consulta['smtp_correo_port'];
$nombre_concepto_multi_virtual                               = $matriz_consulta['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                                    = $matriz_consulta['nombre_tipo_precio_venta'];
$numero_precio                                               = $matriz_consulta['numero_precio'];
$nombre_tipo_empresa                                         = $matriz_consulta['nombre_tipo_empresa'];

$limite_mostrar_producto_lista_caja_virtual                        = $matriz_consulta['limite_mostrar_producto_lista_caja_virtual'];

$ptj_servicio_propina                                              = $matriz_consulta['ptj_servicio_propina'];
$cod_servicio_propina                                              = $matriz_consulta['cod_servicio_propina'];
$nombre_servicio_propina                                           = $matriz_consulta['nombre_servicio_propina'];
$precio_servicio_propina                                           = $matriz_consulta['precio_servicio_propina'];
$ptj_bolsa                                                         = $matriz_consulta['ptj_bolsa'];
$cod_bolsa                                                         = $matriz_consulta['cod_bolsa'];
$nombre_bolsa                                                      = $matriz_consulta['nombre_bolsa'];
$precio_bolsa                                                     = $matriz_consulta['precio_bolsa'];

$tamano_font_sticker_barra_pdf                                     = $matriz_consulta['tamano_font_sticker_barra_pdf'];
$ancho_sticker_barra_pdf                                           = $matriz_consulta['ancho_sticker_barra_pdf'];
$alto_sticker_barra_pdf                                            = $matriz_consulta['alto_sticker_barra_pdf'];
$columnas_sticker_barra_pdf                                        = $matriz_consulta['columnas_sticker_barra_pdf'];
$nombre_estandar_sticker_barra_pdf                                 = $matriz_consulta['nombre_estandar_sticker_barra_pdf'];
$tipo_hoja_sticker_barra_pdf                                       = $matriz_consulta['tipo_hoja_sticker_barra_pdf'];

$dias_vencimiento_producto_alerta                                  = $matriz_consulta['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global                               = $matriz_consulta['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                                    = $matriz_consulta['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                                     = $matriz_consulta['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                                            = $matriz_consulta['cod_estado_dto1_global'];
$cod_estado_dto2_global                                            = $matriz_consulta['cod_estado_dto2_global'];
$cod_estado_preventa_global                                        = $matriz_consulta['cod_estado_preventa_global'];
$cod_estado_propina_global                                         = $matriz_consulta['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global                             = $matriz_consulta['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra                                   = $matriz_consulta['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global                     = $matriz_consulta['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global                             = $matriz_consulta['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global                              = $matriz_consulta['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global                               = $matriz_consulta['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                                  = $matriz_consulta['cod_estado_sticker_barras_global'];

$cod_estado_modulo_contabilidad_global                             = $matriz_consulta['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global                               = $matriz_consulta['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica                               = $matriz_consulta['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                                = $matriz_consulta['cod_estado_producto_consumo_global'];
$cod_estado_compra_caja_global                                     = $matriz_consulta['cod_estado_compra_caja_global'];
$nombre_tipo_impresora_zebra_ticket                                = $matriz_consulta['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                                   = $matriz_consulta['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                                    = $matriz_consulta['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                                          = $matriz_consulta['cod_estado_egreso_global'];
$cod_estado_usuario_global                                         = $matriz_consulta['cod_estado_usuario_global'];
$cod_estado_dependencia_global                                     = $matriz_consulta['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                                    = $matriz_consulta['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global                              = $matriz_consulta['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                                            = $matriz_consulta['cod_estado_cita_global'];
$cod_estado_factura_compra_global                                  = $matriz_consulta['cod_estado_factura_compra_global'];

$cod_estado_modulo_producto_global                                 = $matriz_consulta['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global                              = $matriz_consulta['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                                    = $matriz_consulta['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                                  = $matriz_consulta['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                                   = $matriz_consulta['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                                  = $matriz_consulta['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                                    = $matriz_consulta['cod_estado_modulo_admin_global'];
$cod_estado_pyg_global                                             = $matriz_consulta['cod_estado_pyg_global'];
$cod_estado_balance_global                                         = $matriz_consulta['cod_estado_balance_global'];
$cod_estado_mov_contable_global                                    = $matriz_consulta['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                                    = $matriz_consulta['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global                         = $matriz_consulta['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                                = $matriz_consulta['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                                       = $matriz_consulta['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                                    = $matriz_consulta['cod_estado_envio_correo_global'];
$cod_estado_ordenamiento_alfabetico_venta_global                   = $matriz_consulta['cod_estado_ordenamiento_alfabetico_venta_global'];

$cod_estado_nocodif_precio_compra_sticker_global                   = $matriz_consulta['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global                    = $matriz_consulta['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global                          = $matriz_consulta['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global                            = $matriz_consulta['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global                             = $matriz_consulta['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global                              = $matriz_consulta['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global                    = $matriz_consulta['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                                      = $matriz_consulta['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                                            = $matriz_consulta['nombre_empresa_sticker'];
$nombre_buscar_por                                                 = $matriz_consulta['nombre_buscar_por'];

$cod_estado_img_producto_global                                    = $matriz_consulta['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global                             = $matriz_consulta['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                                          = $matriz_consulta['cod_estado_animal_global'];
$cod_estado_producto_serial_global                                 = $matriz_consulta['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global                              = $matriz_consulta['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                                 = $matriz_consulta['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global                   = $matriz_consulta['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                                            = $matriz_consulta['nombre_tipo_componente'];
$cod_estado_subproducto_global                                     = $matriz_consulta['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                                = $matriz_consulta['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                                       = $matriz_consulta['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                                     = $matriz_consulta['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global                       = $matriz_consulta['cod_estado_observacion_tercero_venta_global'];

$cod_estado_alerta_fecha_nac_global                                = $matriz_consulta['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                       = $matriz_consulta['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                                   = $matriz_consulta['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                                = $matriz_consulta['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                             = $matriz_consulta['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                            = $matriz_consulta['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                       = $matriz_consulta['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                                     = $matriz_consulta['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                           = $matriz_consulta['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                          = $matriz_consulta['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                        = $matriz_consulta['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                          = $matriz_consulta['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                      = $matriz_consulta['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                          = $matriz_consulta['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                         = $matriz_consulta['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                                     = $matriz_consulta['costo_parqueo'];
$nombre_tipo_cobro_hotel                                           = $matriz_consulta['nombre_tipo_cobro_hotel'];
$costo_hotel                                                       = $matriz_consulta['costo_hotel'];
$cod_estado_parqueo_hotel_global                                   = $matriz_consulta['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                           = $matriz_consulta['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                         = $matriz_consulta['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                           = $matriz_consulta['cod_estado_plan_accion_correcion_global'];

$tamano_font_hc                                                    = $matriz_consulta['tamano_font_hc'];
$tamano_font_aptlab                                                = $matriz_consulta['tamano_font_aptlab'];
$tamano_font_trabaltu                                              = $matriz_consulta['tamano_font_trabaltu'];
$tamano_font_manaliment                                            = $matriz_consulta['tamano_font_manaliment'];
$tamano_font_informe                                               = $matriz_consulta['tamano_font_informe'];
$tamano_font_remision                                              = $matriz_consulta['tamano_font_remision'];
$tamano_font_factura                                               = $matriz_consulta['tamano_font_factura'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global               = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global        = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                       = $matriz_consulta['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global            = $matriz_consulta['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global                    = $matriz_consulta['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global                   = $matriz_consulta['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global                   = $matriz_consulta['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global                 = $matriz_consulta['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global                 = $matriz_consulta['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global                 = $matriz_consulta['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global               = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global               = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global              = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                       = $matriz_consulta['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global               = $matriz_consulta['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global                     = $matriz_consulta['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global                 = $matriz_consulta['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global                 = $matriz_consulta['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global                    = $matriz_consulta['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                       = $matriz_consulta['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                          = $matriz_consulta['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                                     = $matriz_consulta['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                       = $matriz_consulta['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                                  = $matriz_consulta['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                           = $matriz_consulta['cod_estado_marca_global'];
$cod_estado_proveedor_global                                       = $matriz_consulta['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                                 = $matriz_consulta['cod_estado_archivo_adjunto_global'];
$cod_estado_precio_compra_mod_venta_global                         = $matriz_consulta['cod_estado_precio_compra_mod_venta_global'];

$cod_estado_timbre_entrada_pedido_temporal_cocina_global           = $matriz_consulta['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global            = $matriz_consulta['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_estado_subproducto_mostrar_imprimir_global                    = $matriz_consulta['cod_estado_subproducto_mostrar_imprimir_global'];

$cod_estado_diferencia_ganancia_inventario_global                  = $matriz_consulta['cod_estado_diferencia_ganancia_inventario_global'];
$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global     = $matriz_consulta['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'];
$cod_estado_opcion_descontable_inv_global                          = $matriz_consulta['cod_estado_opcion_descontable_inv_global'];
$cod_estado_hora_reporte_venta_global                              = $matriz_consulta['cod_estado_hora_reporte_venta_global'];

$cod_estado_cantidad_caja_mesa_global                              = $matriz_consulta['cod_estado_cantidad_caja_mesa_global'];
$cod_estado_venta_por_categoria_mod_venta_global                   = $matriz_consulta['cod_estado_venta_por_categoria_mod_venta_global'];
$cod_estado_habilitar_btn_facturar_mod_venta_global                = $matriz_consulta['cod_estado_habilitar_btn_facturar_mod_venta_global'];
$cod_estado_btn_imprimir_preventa_cocina_global                    = $matriz_consulta['cod_estado_btn_imprimir_preventa_cocina_global'];
$cod_estado_producto_de_cocina_global                              = $matriz_consulta['cod_estado_producto_de_cocina_global'];
$cantidad_caja_mesa                                                = $matriz_consulta['cantidad_caja_mesa'];
$tamano_papel_impresora                                            = $matriz_consulta['tamano_papel_impresora'];


$cod_estado_posicion_gps_pedidos_global                            = $matriz_consulta['cod_estado_posicion_gps_pedidos_global'];
$cod_estado_precio_venta_variable_disponible_admin_global          = $matriz_consulta['cod_estado_precio_venta_variable_disponible_admin_global'];
$cod_estado_check_imp_global                                       = $matriz_consulta['cod_estado_check_imp_global'];
$cod_estado_dividir_factura_caja_mesa_global                       = $matriz_consulta['cod_estado_dividir_factura_caja_mesa_global'];
$cod_estado_agrupar_por_producto_imp_global                        = $matriz_consulta['cod_estado_agrupar_por_producto_imp_global'];
$cod_estado_descuento_concepto_venta_neg_global                    = $matriz_consulta['cod_estado_descuento_concepto_venta_neg_global'];

$cod_estado_habilitar_btn_imp_venta_nav_global                     = $matriz_consulta['cod_estado_habilitar_btn_imp_venta_nav_global'];
$cod_estado_habilitar_btn_imp_venta_direct_driv_global             = $matriz_consulta['cod_estado_habilitar_btn_imp_venta_direct_driv_global'];
$cod_estado_habilitar_btn_imp_nav_carta_pdf_global                 = $matriz_consulta['cod_estado_habilitar_btn_imp_nav_carta_pdf_global'];
$cod_estado_habilitar_btn_imp_preventodo_nav_global                = $matriz_consulta['cod_estado_habilitar_btn_imp_preventodo_nav_global'];
$cod_estado_habilitar_btn_imp_preventodo_direct_driv_global        = $matriz_consulta['cod_estado_habilitar_btn_imp_preventodo_direct_driv_global'];
$cod_estado_habilitar_btn_imp_cocina_nav_global                    = $matriz_consulta['cod_estado_habilitar_btn_imp_cocina_nav_global'];
$cod_estado_habilitar_btn_imp_cocina_direct_driv_global            = $matriz_consulta['cod_estado_habilitar_btn_imp_cocina_direct_driv_global'];
$cod_estado_habilitar_btn_imp_repventa_consol_nav_global           = $matriz_consulta['cod_estado_habilitar_btn_imp_repventa_consol_nav_global'];
$cod_estado_habilitar_btn_imp_repventa_direct_driv_global          = $matriz_consulta['cod_estado_habilitar_btn_imp_repventa_direct_driv_global'];
$cod_estado_modificar_und_venta_una_sola_vez_global                = $matriz_consulta['cod_estado_modificar_und_venta_una_sola_vez_global'];

$cod_estado_habilitar_hora_venta_temporal_global                   = $info_empresa_data['cod_estado_habilitar_hora_venta_temporal_global'];
$cod_estado_revisado_venta_temporal_global                         = $info_empresa_data['cod_estado_revisado_venta_temporal_global'];
$cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global        = $info_empresa_data['cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global'];
$cod_estado_prioridad_caja_mesa_global                             = $info_empresa_data['cod_estado_prioridad_caja_mesa_global'];
$cod_estado_transferencia_empresa_extern_global                    = $info_empresa_data['cod_estado_transferencia_empresa_extern_global'];
$nombre_tipo_campo_componente_html_und_venta                                  = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];

$cod_estado_descuento_automatico_por_cambio_precio_venta_global    = $info_empresa_data['cod_estado_descuento_automatico_por_cambio_precio_venta_global'];
$cod_estado_btn_categoria_desplegable_global                       = $info_empresa_data['cod_estado_btn_categoria_desplegable_global'];


$cod_estado_consultar_precios_extern_global                        = $info_empresa_data['cod_estado_consultar_precios_extern_global'];
$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global       = $info_empresa_data['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'];
$cod_estado_nombre_producto_editable_factura_compra_global         = $info_empresa_data['cod_estado_nombre_producto_editable_factura_compra_global'];
$cod_estado_tipo_compra_global                                     = $info_empresa_data['cod_estado_tipo_compra_global'];
$cod_estado_grafico_estadistico_global                             = $info_empresa_data['cod_estado_grafico_estadistico_global'];
$cod_estado_inventario_bodega2_global                              = $info_empresa_data['cod_estado_inventario_bodega2_global'];
$cod_estado_tipo_roles_global                                      = $info_empresa_data['cod_estado_tipo_roles_global'];

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];

$cod_tipo_sistema_numeracion                                       = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_estado_lote_compra_global                                     = $info_empresa_data['cod_estado_lote_compra_global'];
$cod_estado_tipo_metodo_envio_global                               = $info_empresa_data['cod_estado_tipo_metodo_envio_global'];
$cod_estado_mod_domicilio_y_estado_habilitado_producto_global      = $info_empresa_data['cod_estado_mod_domicilio_y_estado_habilitado_producto_global'];
$cod_estado_promocion_global                                       = $info_empresa_data['cod_estado_promocion_global'];

$cod_estado_notificacion_alerta_correo_global                       = $info_empresa_data['cod_estado_notificacion_alerta_correo_global'];
$cod_estado_notificacion_alerta_correo_copia_seguridad_global       = $info_empresa_data['cod_estado_notificacion_alerta_correo_copia_seguridad_global'];
$cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global    = $info_empresa_data['cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global'];
$cod_estado_notificacion_alerta_correo_productos_a_vencer_global    = $info_empresa_data['cod_estado_notificacion_alerta_correo_productos_a_vencer_global'];
$cod_estado_notificacion_alerta_correo_productos_agotados_global    = $info_empresa_data['cod_estado_notificacion_alerta_correo_productos_agotados_global'];
$cod_estado_notificacion_alerta_correo_venta_diaria_global          = $info_empresa_data['cod_estado_notificacion_alerta_correo_venta_diaria_global'];

$nombre_tipo_campo_componente_html_und_venta                        = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                     = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];

$cod_servicio_domicilio                                             = $info_empresa_data['cod_servicio_domicilio'];
$nombre_servicio_domicilio                                          = $info_empresa_data['nombre_servicio_domicilio'];
$precio_servicio_domicilio                                          = $info_empresa_data['precio_servicio_domicilio'];
$ptj_servicio_domicilio                                             = $info_empresa_data['ptj_servicio_domicilio'];

$cod_tipo_sistema_numeracion_und_compra                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                              = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                           = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                        = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                     = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];

$cod_estado_venta_dependencia_de_usuario_global                     = $info_empresa_data['cod_estado_venta_dependencia_de_usuario_global'];
$cod_estado_posicion_mapa_gps_pedidos_info_venta_global             = $info_empresa_data['cod_estado_posicion_mapa_gps_pedidos_info_venta_global'];

$cod_estado_origen_factura_compra_global                            = $info_empresa_data['cod_estado_origen_factura_compra_global'];
$cod_estado_existe_producto_factura_compra_global                   = $info_empresa_data['cod_estado_existe_producto_factura_compra_global'];
$cod_estado_chk_factura_compra_global                               = $info_empresa_data['cod_estado_chk_factura_compra_global'];
$cod_estado_check_caja_factura_compra_global                        = $info_empresa_data['cod_estado_check_caja_factura_compra_global'];
$cod_estado_check_und_factura_compra_global                         = $info_empresa_data['cod_estado_check_und_factura_compra_global'];

$cod_estado_peso_global                                             = $info_empresa_data['cod_estado_peso_global'];
$cod_estado_cargar_archivo_plano_interno_factura_compra_global      = $info_empresa_data['cod_estado_cargar_archivo_plano_interno_factura_compra_global'];
$cod_estado_cargar_archivo_plano_externo_factura_compra_global      = $info_empresa_data['cod_estado_cargar_archivo_plano_externo_factura_compra_global'];

$cod_estado_cuenta_cobrar_abono_glob_global                         = $info_empresa_data['cod_estado_cuenta_cobrar_abono_glob_global'];
$cod_estado_reporte_compra_por_producto_global                      = $info_empresa_data['cod_estado_reporte_compra_por_producto_global'];

$ptj_servicio_cava                                                  = $info_empresa_data['ptj_servicio_cava'];
$cod_servicio_cava                                                  = $info_empresa_data['cod_servicio_cava'];
$nombre_servicio_cava                                               = $info_empresa_data['nombre_servicio_cava'];
$precio_servicio_cava                                               = $info_empresa_data['precio_servicio_cava'];
$cod_estado_servicio_cava_global                                    = $info_empresa_data['cod_estado_servicio_cava_global'];
$cod_estado_escoger_precio_venta_automatico_global                  = $info_empresa_data['cod_estado_escoger_precio_venta_automatico_global'];
$cod_estado_origen_produccion_global                                = $info_empresa_data['cod_estado_origen_produccion_global'];

$dias_alerta_entrega_venta                                          = $info_empresa_data['dias_alerta_entrega_venta'];
$cod_estado_imprimir_reporte_venta_con_productos_global             = $info_empresa_data['cod_estado_imprimir_reporte_venta_con_productos_global'];
$cod_estado_factura_compra_cargue_inmediato_global                  = $info_empresa_data['cod_estado_factura_compra_cargue_inmediato_global'];
$cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global   = $info_empresa_data['cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global'];
$cod_estado_actualizar_base_datos_arch_plano_global                 = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_global'];
$cod_estado_actualizar_base_datos_arch_plano_producto_global        = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_producto_global'];
$cod_estado_actualizar_base_datos_arch_plano_venta_global           = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_venta_global'];
$cod_estado_actualizar_base_datos_arch_plano_info_venta_global      = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_info_venta_global'];
$cod_estado_actualizar_base_datos_arch_plano_compra_global          = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_compra_global'];
$cod_estado_actualizar_base_datos_arch_plano_info_compra_global     = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_info_compra_global'];
$cod_estado_actualizar_und_producto_inventario_global               = $info_empresa_data['cod_estado_actualizar_und_producto_inventario_global'];
$cod_estado_tipo_venta_zapateria_global                             = $info_empresa_data['cod_estado_tipo_venta_zapateria_global'];
$cod_estado_opcion_escribir_nombre_cliente_venta_global             = $info_empresa_data['cod_estado_opcion_escribir_nombre_cliente_venta_global'];
$cod_estado_btn_imprimir_venta_nav_zapateria_global                 = $info_empresa_data['cod_estado_btn_imprimir_venta_nav_zapateria_global'];
$cod_estado_btn_imprimir_venta_direct_driv_zapateria_global         = $info_empresa_data['cod_estado_btn_imprimir_venta_direct_driv_zapateria_global'];
$cod_estado_fecha_entrega_venta_global                              = $info_empresa_data['cod_estado_fecha_entrega_venta_global'];
$cod_estado_hora_entrega_venta_global                               = $info_empresa_data['cod_estado_hora_entrega_venta_global'];
$cod_estado_productos_poco_movimiento_global                        = $info_empresa_data['cod_estado_productos_poco_movimiento_global'];
$cod_estado_nuevo_inventario_por_letra_global                       = $info_empresa_data['cod_estado_nuevo_inventario_por_letra_global'];
$cod_estado_filtro_aplicacion_chef_bartender_global                 = $info_empresa_data['cod_estado_filtro_aplicacion_chef_bartender_global'];

$cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global          = $info_empresa_data['cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global'];
$cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global           = $info_empresa_data['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global'];
$cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global        = $info_empresa_data['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global'];
$cod_estado_reporte_mantenimiento_global                            = $info_empresa_data['cod_estado_reporte_mantenimiento_global'];

$cod_estado_abrir_cajon_monedero_driv_direct_global                 = $info_empresa_data['cod_estado_abrir_cajon_monedero_driv_direct_global'];
$cod_estado_subreporte_venta_diaria_global                          = $info_empresa_data['cod_estado_subreporte_venta_diaria_global'];
$cod_estado_subreporte_venta_mensual_global                         = $info_empresa_data['cod_estado_subreporte_venta_mensual_global'];
$cod_estado_subreporte_venta_anual_global                           = $info_empresa_data['cod_estado_subreporte_venta_anual_global'];
$cod_estado_subreporte_totalventa_global                            = $info_empresa_data['cod_estado_subreporte_totalventa_global'];
$cod_estado_subreporte_impuestos_global                             = $info_empresa_data['cod_estado_subreporte_impuestos_global'];
$cod_estado_subreporte_ventasgenerales_global                       = $info_empresa_data['cod_estado_subreporte_ventasgenerales_global'];
$cod_estado_subreporte_ventasporfacturas_global                     = $info_empresa_data['cod_estado_subreporte_ventasporfacturas_global'];
$cod_estado_subreporte_ventasportipofacturas_global                 = $info_empresa_data['cod_estado_subreporte_ventasportipofacturas_global'];
$cod_estado_subreporte_ventaspordependencia_global                  = $info_empresa_data['cod_estado_subreporte_ventaspordependencia_global'];
$cod_estado_subreporte_ventasportipoproducto_global                 = $info_empresa_data['cod_estado_subreporte_ventasportipoproducto_global'];
$cod_estado_subreporte_ventasporvendedor_global                     = $info_empresa_data['cod_estado_subreporte_ventasporvendedor_global'];
$cod_estado_subreporte_ventasporpropinavendedor_global              = $info_empresa_data['cod_estado_subreporte_ventasporpropinavendedor_global'];
$cod_estado_subreporte_ventasporcreditocliente_global               = $info_empresa_data['cod_estado_subreporte_ventasporcreditocliente_global'];
$cod_estado_dependencia_sub_global                                  = $info_empresa_data['cod_estado_dependencia_sub_global'];

$cod_estado_factura_compra_producto_global                          = $info_empresa_data['cod_estado_factura_compra_producto_global'];
$cod_estado_aceite_oleina_global                                    = $info_empresa_data['cod_estado_aceite_oleina_global'];
$cod_estado_valor_flete_aceite_oleina_global                        = $info_empresa_data['cod_estado_valor_flete_aceite_oleina_global'];
$cod_estado_caja_fraccion_global                                    = $info_empresa_data['cod_estado_caja_fraccion_global'];
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO PREVENTA</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left">HABILITAR PROPINA</th>
			<td style='text-align:center'><input name='cod_estado_propina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_propina_global" type='checkbox' value='<?php echo $cod_estado_propina_global ?>' <?php if($cod_estado_propina_global=='1'){ echo 'checked'; } ?>></td>
		</tr>
	</thead>
</table>

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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {
var cod_estado_modulo_producto_global = $('#cod_estado_modulo_producto_global').val();
var cod_estado_modulo_facturacion_global = $('#cod_estado_modulo_facturacion_global').val();
var cod_estado_modulo_venta_global = $('#cod_estado_modulo_venta_global').val();
var cod_estado_modulo_tercero_global = $('#cod_estado_modulo_tercero_global').val();
var cod_estado_modulo_cuenta_global = $('#cod_estado_modulo_cuenta_global').val();
var cod_estado_modulo_reporte_global = $('#cod_estado_modulo_reporte_global').val();
var cod_estado_modulo_admin_global = $('#cod_estado_modulo_admin_global').val();
var cod_estado_mov_contable_global = $('#cod_estado_mov_contable_global').val();
var cod_estado_pyg_global = $('#cod_estado_pyg_global').val();
var cod_estado_balance_global = $('#cod_estado_balance_global').val();
var cod_estado_ganancia_ptj_global = $('#cod_estado_ganancia_ptj_global').val();
var cod_estado_modulo_orden_produccion_global = $('#cod_estado_modulo_orden_produccion_global').val();
var cod_estado_comentario_venta_global = $('#cod_estado_comentario_venta_global').val();
var cod_estado_envio_sms_global = $('#cod_estado_envio_sms_global').val();
var cod_estado_envio_correo_global = $('#cod_estado_envio_correo_global').val();
var cod_estado_fecha_vencimiento_global = $('#cod_estado_fecha_vencimiento_global').val();
var cod_estado_ptj_comision_global = $('#cod_estado_ptj_comision_global').val();
var cod_estado_impoconsumo_global = $('#cod_estado_impoconsumo_global').val();
var cod_estado_dto1_global = $('#cod_estado_dto1_global').val();
var cod_estado_dto2_global = $('#cod_estado_dto2_global').val();
var cod_estado_producto_consumo_global = $('#cod_estado_producto_consumo_global').val();
var cod_estado_cuenta_cobrar_global = $('#cod_estado_cuenta_cobrar_global').val();
var cod_estado_cuenta_pagar_global = $('#cod_estado_cuenta_pagar_global').val();
var cod_estado_egreso_global = $('#cod_estado_egreso_global').val();
var cod_estado_factura_compra_global = $('#cod_estado_factura_compra_global').val();
var cod_estado_cita_global = $('#cod_estado_cita_global').val();
var cod_estado_usuario_global = $('#cod_estado_usuario_global').val();
var cod_estado_dependencia_global = $('#cod_estado_dependencia_global').val();
var cod_estado_resolucion_factura_global = $('#cod_estado_resolucion_factura_global').val();
var cod_estado_numero_letra_global = $('#cod_estado_numero_letra_global').val();
var cod_estado_encuesta_experiencia_compra_global = $('#cod_estado_encuesta_experiencia_compra_global').val();
var cod_estado_codif_precio_compra_global = $('#cod_estado_codif_precio_compra_global').val();
var cod_estado_codif_precio_venta_global = $('#cod_estado_codif_precio_venta_global').val();
var cod_estado_img_impimir_factura_global = $('#cod_estado_img_impimir_factura_global').val();
var cod_estado_preventa_global = $('#cod_estado_preventa_global').val();
var cod_estado_propina_global = $('#cod_estado_propina_global').val();
var cod_estado_inventario_bodega_global = $('#cod_estado_inventario_bodega_global').val();
var cod_estado_modulo_contabilidad_global = $('#cod_estado_modulo_contabilidad_global').val();
var cod_estado_modulo_cotizacion_global = $('#cod_estado_modulo_cotizacion_global').val();
var cod_estado_compra_caja_global = $('#cod_estado_compra_caja_global').val();
var cod_estado_sticker_barras_global = $('#cod_estado_sticker_barras_global').val();
var cod_estado_modulo_cotizacion_global = $('#cod_estado_modulo_cotizacion_global').val();
var cod_estado_producto_consumo_global = $('#cod_estado_producto_consumo_global').val();
var cod_estado_compra_caja_global = $('#cod_estado_compra_caja_global').val();
var cod_estado_cuenta_cobrar_global = $('#cod_estado_cuenta_cobrar_global').val();
var cod_estado_cuenta_pagar_global = $('#cod_estado_cuenta_pagar_global').val();
var cod_estado_egreso_global = $('#cod_estado_egreso_global').val();
var cod_estado_usuario_global = $('#cod_estado_usuario_global').val();
var cod_estado_dependencia_global = $('#cod_estado_dependencia_global').val();
var cod_estado_numero_letra_global = $('#cod_estado_numero_letra_global').val();
var cod_estado_resolucion_factura_global = $('#cod_estado_resolucion_factura_global').val();
var cod_estado_cita_global = $('#cod_estado_cita_global').val();
var cod_estado_factura_compra_global = $('#cod_estado_factura_compra_global').val();
var cod_estado_modulo_producto_global = $('#cod_estado_modulo_producto_global').val();
var cod_estado_modulo_facturacion_global = $('#cod_estado_modulo_facturacion_global').val();
var cod_estado_modulo_venta_global = $('#cod_estado_modulo_venta_global').val();
var cod_estado_modulo_tercero_global = $('#cod_estado_modulo_tercero_global').val();
var cod_estado_modulo_cuenta_global = $('#cod_estado_modulo_cuenta_global').val();
var cod_estado_modulo_reporte_global = $('#cod_estado_modulo_reporte_global').val();
var cod_estado_modulo_admin_global = $('#cod_estado_modulo_admin_global').val();
var cod_estado_pyg_global = $('#cod_estado_pyg_global').val();
var cod_estado_balance_global = $('#cod_estado_balance_global').val();
var cod_estado_ganancia_ptj_global = $('#cod_estado_ganancia_ptj_global').val();
var cod_estado_modulo_orden_produccion_global = $('#cod_estado_modulo_orden_produccion_global').val();
var cod_estado_comentario_venta_global = $('#cod_estado_comentario_venta_global').val();
var cod_estado_envio_sms_global = $('#cod_estado_envio_sms_global').val();
var cod_estado_envio_correo_global = $('#cod_estado_envio_correo_global').val();
var cod_estado_ordenamiento_alfabetico_venta_global = $('#cod_estado_ordenamiento_alfabetico_venta_global').val();
var cod_estado_nocodif_precio_compra_sticker_global = $('#cod_estado_nocodif_precio_compra_sticker_global').val();
var cod_estado_nocodif_precio_venta_sticker_global = $('#cod_estado_nocodif_precio_venta_sticker_global').val();
var cod_estado_nombre_empresa_sticker_global = $('#cod_estado_nombre_empresa_sticker_global').val();
var cod_estado_fecha_compra_sticker_global = $('#cod_estado_fecha_compra_sticker_global').val();
var cod_estado_cod_tercero_sticker_global = $('#cod_estado_cod_tercero_sticker_global').val();
var cod_estado_url_pagina_sticker_global = $('#cod_estado_url_pagina_sticker_global').val();
var cod_estado_nombre_desarrollador_sticker_global = $('#cod_estado_nombre_desarrollador_sticker_global').val();
var cod_estado_qr_sticker_global = $('#cod_estado_qr_sticker_global').val();
var cod_estado_habilitar_tercero_por_usuario_global = $('#cod_estado_habilitar_tercero_por_usuario_global').val();
var cod_estado_subproducto_global = $('#cod_estado_subproducto_global').val();
var cod_estado_nuevo_inventario_global = $('#cod_estado_nuevo_inventario_global').val();
var cod_estado_auditoria_global = $('#cod_estado_auditoria_global').val();
var cod_estado_cierre_caja_global = $('#cod_estado_cierre_caja_global').val();
var cod_estado_fecha_mantenimiento_global = $('#cod_estado_fecha_mantenimiento_global').val();
var cod_estado_animal_global = $('#cod_estado_animal_global').val();
var cod_estado_producto_serial_global = $('#cod_estado_producto_serial_global').val();
var cod_estado_venta_prod_en_cero_global = $('#cod_estado_venta_prod_en_cero_global').val();
var cod_estado_observacion_tercero_venta_global = $('#cod_estado_observacion_tercero_venta_global').val();
var cod_estado_alerta_fecha_nac_global = $('#cod_estado_alerta_fecha_nac_global').val();
var cod_estado_categoria_global = $('#cod_estado_categoria_global').val();
var cod_estado_peso_producto_global = $('#cod_estado_peso_producto_global').val();
var cod_estado_estante_producto_global = $('#cod_estado_estante_producto_global').val();
var cod_estado_devolucion_btn_verde_global = $('#cod_estado_devolucion_btn_verde_global').val();
var cod_estado_plan_separe_global = $('#cod_estado_plan_separe_global').val();
var cod_estado_admin_global = $('#cod_estado_admin_global').val();
var cod_estado_prodcuto_mantenimiento_global = $('#cod_estado_prodcuto_mantenimiento_global').val();
var cod_estado_eliminar_global = $('#cod_estado_eliminar_global').val();
var cod_estado_soporte_factura_compra_global = $('#cod_estado_soporte_factura_compra_global').val();
var cod_estado_observacion_factura_compra_global = $('#cod_estado_observacion_factura_compra_global').val();
var cod_estado_venta_precio_min_venta_global = $('#cod_estado_venta_precio_min_venta_global').val();
var cod_estado_hotel_global = $('#cod_estado_hotel_global').val();
var cod_estado_parqueo_global = $('#cod_estado_parqueo_global').val();
var cod_estado_plan_accion_correcion_global = $('#cod_estado_plan_accion_correcion_global').val();
var cod_estado_cocina_global = $('#cod_estado_cocina_global').val();
var cod_estado_cajas_sobre_global = $('#cod_estado_cajas_sobre_global').val();
var cod_estado_und_sobre_global = $('#cod_estado_und_sobre_global').val();
var cod_estado_meses_garantia_global = $('#cod_estado_meses_garantia_global').val();
var cod_estado_marca_global = $('#cod_estado_marca_global').val();
var cod_estado_proveedor_global = $('#cod_estado_proveedor_global').val();
var cod_estado_archivo_adjunto_global = $('#cod_estado_archivo_adjunto_global').val();
var cod_estado_precio_compra_mod_venta_global = $('#cod_estado_precio_compra_mod_venta_global').val();
var cod_estado_timbre_entrada_pedido_temporal_cocina_global = $('#cod_estado_timbre_entrada_pedido_temporal_cocina_global').val();
var cod_estado_timbre_salida_pedido_temporal_cocina_global = $('#cod_estado_timbre_salida_pedido_temporal_cocina_global').val();
var cod_estado_subproducto_mostrar_imprimir_global = $('#cod_estado_subproducto_mostrar_imprimir_global').val();
var cod_estado_img_producto_global = $('#cod_estado_img_producto_global').val();
var cod_estado_diferencia_ganancia_inventario_global = $('#cod_estado_diferencia_ganancia_inventario_global').val();
var cod_estado_diferencia_ganancia_inventario_ptj_promedio_global = $('#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global').val();
var cod_estado_opcion_descontable_inv_global = $('#cod_estado_opcion_descontable_inv_global').val();
var cod_estado_hora_reporte_venta_global = $('#cod_estado_hora_reporte_venta_global').val();
var cod_estado_cantidad_caja_mesa_global = $('#cod_estado_cantidad_caja_mesa_global').val();
var cod_estado_venta_por_categoria_mod_venta_global = $('#cod_estado_venta_por_categoria_mod_venta_global').val();
var cod_estado_habilitar_btn_facturar_mod_venta_global = $('#cod_estado_habilitar_btn_facturar_mod_venta_global').val();
var cod_estado_btn_imprimir_preventa_cocina_global = $('#cod_estado_btn_imprimir_preventa_cocina_global').val();
var cod_estado_producto_de_cocina_global = $('#cod_estado_producto_de_cocina_global').val();
var cod_estado_posicion_gps_pedidos_global = $('#cod_estado_posicion_gps_pedidos_global').val();
var cod_estado_precio_venta_variable_disponible_admin_global = $('#cod_estado_precio_venta_variable_disponible_admin_global').val();
var cod_estado_check_imp_global = $('#cod_estado_check_imp_global').val();
var cod_estado_dividir_factura_caja_mesa_global = $('#cod_estado_dividir_factura_caja_mesa_global').val();
var cod_estado_agrupar_por_producto_imp_global = $('#cod_estado_agrupar_por_producto_imp_global').val();
var cod_estado_descuento_concepto_venta_neg_global = $('#cod_estado_descuento_concepto_venta_neg_global').val();
var cod_estado_habilitar_btn_imp_venta_nav_global = $('#cod_estado_habilitar_btn_imp_venta_nav_global').val();
var cod_estado_habilitar_btn_imp_venta_direct_driv_global = $('#cod_estado_habilitar_btn_imp_venta_direct_driv_global').val();
var cod_estado_habilitar_btn_imp_nav_carta_pdf_global = $('#cod_estado_habilitar_btn_imp_nav_carta_pdf_global').val();
var cod_estado_habilitar_btn_imp_preventodo_nav_global = $('#cod_estado_habilitar_btn_imp_preventodo_nav_global').val();
var cod_estado_habilitar_btn_imp_preventodo_direct_driv_global = $('#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global').val();
var cod_estado_habilitar_btn_imp_cocina_nav_global = $('#cod_estado_habilitar_btn_imp_cocina_nav_global').val();
var cod_estado_habilitar_btn_imp_cocina_direct_driv_global = $('#cod_estado_habilitar_btn_imp_cocina_direct_driv_global').val();
var cod_estado_habilitar_btn_imp_repventa_consol_nav_global = $('#cod_estado_habilitar_btn_imp_repventa_consol_nav_global').val();
var cod_estado_habilitar_btn_imp_repventa_direct_driv_global = $('#cod_estado_habilitar_btn_imp_repventa_direct_driv_global').val();
var cod_estado_modificar_und_venta_una_sola_vez_global = $('#cod_estado_modificar_und_venta_una_sola_vez_global').val();
var cod_estado_habilitar_hora_venta_temporal_global = $('#cod_estado_habilitar_hora_venta_temporal_global').val();
var cod_estado_revisado_venta_temporal_global = $('#cod_estado_revisado_venta_temporal_global').val();
var cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global = $('#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global').val();
var cod_estado_prioridad_caja_mesa_global = $('#cod_estado_prioridad_caja_mesa_global').val();
var cod_estado_transferencia_empresa_extern_global = $('#cod_estado_transferencia_empresa_extern_global').val();
var cod_estado_descuento_automatico_por_cambio_precio_venta_global = $('#cod_estado_descuento_automatico_por_cambio_precio_venta_global').val();
var cod_estado_btn_categoria_desplegable_global = $('#cod_estado_btn_categoria_desplegable_global').val();
var cod_estado_consultar_precios_extern_global = $('#cod_estado_consultar_precios_extern_global').val();
var cod_estado_marcado_revisado_caja_mesa_venta_temporal_global = $('#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global').val();
var cod_estado_nombre_producto_editable_factura_compra_global = $('#cod_estado_nombre_producto_editable_factura_compra_global').val();
var cod_estado_tipo_compra_global = $('#cod_estado_tipo_compra_global').val();
var cod_estado_nota_observacion_global = $('#cod_estado_nota_observacion_global').val();
var cod_estado_grafico_estadistico_global = $('#cod_estado_grafico_estadistico_global').val();
var cod_estado_inventario_bodega2_global = $('#cod_estado_inventario_bodega2_global').val();
var cod_estado_tipo_roles_global = $('#cod_estado_tipo_roles_global').val();
var cod_estado_bascula_balanza_electronica_pesar_producto_global = $('#cod_estado_bascula_balanza_electronica_pesar_producto_global').val();
var cod_estado_bascula_balanza_cod_barras_pesar_producto_global = $('#cod_estado_bascula_balanza_cod_barras_pesar_producto_global').val();
var cod_estado_lote_compra_global = $('#cod_estado_lote_compra_global').val();
var cod_estado_tipo_metodo_envio_global = $('#cod_estado_tipo_metodo_envio_global').val();
var cod_estado_mod_domicilio_y_estado_habilitado_producto_global = $('#cod_estado_mod_domicilio_y_estado_habilitado_producto_global').val();
var cod_estado_promocion_global = $('#cod_estado_promocion_global').val();
var cod_estado_notificacion_alerta_correo_global = $('#cod_estado_notificacion_alerta_correo_global').val();
var cod_estado_notificacion_alerta_correo_copia_seguridad_global = $('#cod_estado_notificacion_alerta_correo_copia_seguridad_global').val();
var cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global = $('#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global').val();
var cod_estado_notificacion_alerta_correo_productos_a_vencer_global = $('#cod_estado_notificacion_alerta_correo_productos_a_vencer_global').val();
var cod_estado_notificacion_alerta_correo_productos_agotados_global = $('#cod_estado_notificacion_alerta_correo_productos_agotados_global').val();
var cod_estado_notificacion_alerta_correo_venta_diaria_global = $('#cod_estado_notificacion_alerta_correo_venta_diaria_global').val();
var cod_estado_venta_dependencia_de_usuario_global = $('#cod_estado_venta_dependencia_de_usuario_global').val();
var cod_estado_posicion_mapa_gps_pedidos_info_venta_global = $('#cod_estado_posicion_mapa_gps_pedidos_info_venta_global').val();
var cod_estado_origen_factura_compra_global = $('#cod_estado_origen_factura_compra_global').val();
var cod_estado_existe_producto_factura_compra_global = $('#cod_estado_existe_producto_factura_compra_global').val();
var cod_estado_chk_factura_compra_global = $('#cod_estado_chk_factura_compra_global').val();
var cod_estado_check_caja_factura_compra_global = $('#cod_estado_check_caja_factura_compra_global').val();
var cod_estado_check_und_factura_compra_global = $('#cod_estado_check_und_factura_compra_global').val();
var cod_estado_peso_global = $('#cod_estado_peso_global').val();
var cod_estado_cargar_archivo_plano_interno_factura_compra_global = $('#cod_estado_cargar_archivo_plano_interno_factura_compra_global').val();
var cod_estado_cargar_archivo_plano_externo_factura_compra_global = $('#cod_estado_cargar_archivo_plano_externo_factura_compra_global').val();
var cod_estado_cuenta_cobrar_abono_glob_global = $('#cod_estado_cuenta_cobrar_abono_glob_global').val();
var cod_estado_reporte_compra_por_producto_global = $('#cod_estado_reporte_compra_por_producto_global').val();
var cod_estado_servicio_cava_global = $('#cod_estado_servicio_cava_global').val();
var cod_estado_escoger_precio_venta_automatico_global = $('#cod_estado_escoger_precio_venta_automatico_global').val();
var cod_estado_origen_produccion_global = $('#cod_estado_origen_produccion_global').val();
var cod_estado_imprimir_reporte_venta_con_productos_global = $('#cod_estado_imprimir_reporte_venta_con_productos_global').val();
var cod_estado_factura_compra_cargue_inmediato_global = $('#cod_estado_factura_compra_cargue_inmediato_global').val();
var cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global = $('#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global').val();
var cod_estado_actualizar_base_datos_arch_plano_global = $('#cod_estado_actualizar_base_datos_arch_plano_global').val();
var cod_estado_actualizar_base_datos_arch_plano_producto_global = $('#cod_estado_actualizar_base_datos_arch_plano_producto_global').val();
var cod_estado_actualizar_base_datos_arch_plano_venta_global = $('#cod_estado_actualizar_base_datos_arch_plano_venta_global').val();
var cod_estado_actualizar_base_datos_arch_plano_info_venta_global = $('#cod_estado_actualizar_base_datos_arch_plano_info_venta_global').val();
var cod_estado_actualizar_base_datos_arch_plano_compra_global = $('#cod_estado_actualizar_base_datos_arch_plano_compra_global').val();
var cod_estado_actualizar_base_datos_arch_plano_info_compra_global = $('#cod_estado_actualizar_base_datos_arch_plano_info_compra_global').val();
var cod_estado_actualizar_und_producto_inventario_global = $('#cod_estado_actualizar_und_producto_inventario_global').val();
var cod_estado_tipo_venta_zapateria_global = $('#cod_estado_tipo_venta_zapateria_global').val();
var cod_estado_opcion_escribir_nombre_cliente_venta_global = $('#cod_estado_opcion_escribir_nombre_cliente_venta_global').val();
var cod_estado_btn_imprimir_venta_nav_zapateria_global = $('#cod_estado_btn_imprimir_venta_nav_zapateria_global').val();
var cod_estado_btn_imprimir_venta_direct_driv_zapateria_global = $('#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global').val();
var cod_estado_fecha_entrega_venta_global = $('#cod_estado_fecha_entrega_venta_global').val();
var cod_estado_hora_entrega_venta_global = $('#cod_estado_hora_entrega_venta_global').val();
var cod_estado_productos_poco_movimiento_global = $('#cod_estado_productos_poco_movimiento_global').val();
var cod_estado_nuevo_inventario_por_letra_global = $('#cod_estado_nuevo_inventario_por_letra_global').val();
var cod_estado_filtro_aplicacion_chef_bartender_global = $('#cod_estado_filtro_aplicacion_chef_bartender_global').val();
var cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global = $('#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global').val();
var cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global = $('#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global').val();
var cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global = $('#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global').val();
var cod_estado_reporte_mantenimiento_global = $('#cod_estado_reporte_mantenimiento_global').val();
var cod_estado_abrir_cajon_monedero_driv_direct_global = $('#cod_estado_abrir_cajon_monedero_driv_direct_global').val();
var cod_estado_subreporte_venta_diaria_global = $('#cod_estado_subreporte_venta_diaria_global').val();
var cod_estado_subreporte_venta_mensual_global = $('#cod_estado_subreporte_venta_mensual_global').val();
var cod_estado_subreporte_venta_anual_global = $('#cod_estado_subreporte_venta_anual_global').val();
var cod_estado_subreporte_totalventa_global = $('#cod_estado_subreporte_totalventa_global').val();
var cod_estado_subreporte_impuestos_global = $('#cod_estado_subreporte_impuestos_global').val();
var cod_estado_subreporte_ventasgenerales_global = $('#cod_estado_subreporte_ventasgenerales_global').val();
var cod_estado_subreporte_ventasporfacturas_global = $('#cod_estado_subreporte_ventasporfacturas_global').val();
var cod_estado_subreporte_ventasportipofacturas_global = $('#cod_estado_subreporte_ventasportipofacturas_global').val();
var cod_estado_subreporte_ventaspordependencia_global = $('#cod_estado_subreporte_ventaspordependencia_global').val();
var cod_estado_subreporte_ventasportipoproducto_global = $('#cod_estado_subreporte_ventasportipoproducto_global').val();
var cod_estado_subreporte_ventasporvendedor_global = $('#cod_estado_subreporte_ventasporvendedor_global').val();
var cod_estado_subreporte_ventasporpropinavendedor_global = $('#cod_estado_subreporte_ventasporpropinavendedor_global').val();
var cod_estado_subreporte_ventasporcreditocliente_global = $('#cod_estado_subreporte_ventasporcreditocliente_global').val();
var cod_estado_dependencia_sub_global = $('#cod_estado_dependencia_sub_global').val();
var cod_estado_factura_compra_producto_global = $('#cod_estado_factura_compra_producto_global').val();
var cod_estado_aceite_oleina_global = $('#cod_estado_aceite_oleina_global').val();
var cod_estado_valor_flete_aceite_oleina_global = $('#cod_estado_valor_flete_aceite_oleina_global').val();
var cod_estado_caja_fraccion_global = $('#cod_estado_caja_fraccion_global').val();





if (cod_estado_modulo_producto_global=='1') { $('#cod_estado_modulo_producto_global').val('1'); $('#cod_estado_modulo_producto_global').prop('checked',true); } else { $('#cod_estado_modulo_producto_global').val('0'); $('#cod_estado_modulo_producto_global').prop('checked',false); } 
if (cod_estado_modulo_facturacion_global=='1') { $('#cod_estado_modulo_facturacion_global').val('1'); $('#cod_estado_modulo_facturacion_global').prop('checked',true); } else { $('#cod_estado_modulo_facturacion_global').val('0'); $('#cod_estado_modulo_facturacion_global').prop('checked',false); }
if (cod_estado_modulo_venta_global=='1') { $('#cod_estado_modulo_venta_global').val('1'); $('#cod_estado_modulo_venta_global').prop('checked',true); } else { $('#cod_estado_modulo_venta_global').val('0'); $('#cod_estado_modulo_venta_global').prop('checked',false); } 
if (cod_estado_modulo_tercero_global=='1') { $('#cod_estado_modulo_tercero_global').val('1'); $('#cod_estado_modulo_tercero_global').prop('checked',true); } else { $('#cod_estado_modulo_tercero_global').val('0'); $('#cod_estado_modulo_tercero_global').prop('checked',false); } 
if (cod_estado_modulo_cuenta_global=='1') { $('#cod_estado_modulo_cuenta_global').val('1'); $('#cod_estado_modulo_cuenta_global').prop('checked',true); } else { $('#cod_estado_modulo_cuenta_global').val('0'); $('#cod_estado_modulo_cuenta_global').prop('checked',false); } 
if (cod_estado_modulo_reporte_global=='1') { $('#cod_estado_modulo_reporte_global').val('1'); $('#cod_estado_modulo_reporte_global').prop('checked',true); } else { $('#cod_estado_modulo_reporte_global').val('0'); $('#cod_estado_modulo_reporte_global').prop('checked',false); } 
if (cod_estado_modulo_admin_global=='1') { $('#cod_estado_modulo_admin_global').val('1'); $('#cod_estado_modulo_admin_global').prop('checked',true); } else { $('#cod_estado_modulo_admin_global').val('0'); $('#cod_estado_modulo_admin_global').prop('checked',false); } 
if (cod_estado_mov_contable_global=='1') { $('#cod_estado_mov_contable_global').val('1'); $('#cod_estado_mov_contable_global').prop('checked',true); } else { $('#cod_estado_mov_contable_global').val('0'); $('#cod_estado_mov_contable_global').prop('checked',false); } 
if (cod_estado_pyg_global=='1') { $('#cod_estado_pyg_global').val('1'); $('#cod_estado_pyg_global').prop('checked',true); } else { $('#cod_estado_pyg_global').val('0'); $('#cod_estado_pyg_global').prop('checked',false); } 
if (cod_estado_balance_global=='1') { $('#cod_estado_balance_global').val('1'); $('#cod_estado_balance_global').prop('checked',true); } else { $('#cod_estado_balance_global').val('0'); $('#cod_estado_balance_global').prop('checked',false); } 
if (cod_estado_ganancia_ptj_global=='1') { $('#cod_estado_ganancia_ptj_global').val('1'); $('#cod_estado_ganancia_ptj_global').prop('checked',true); } else { $('#cod_estado_ganancia_ptj_global').val('0'); $('#cod_estado_ganancia_ptj_global').prop('checked',false); } 
if (cod_estado_modulo_orden_produccion_global=='1') { $('#cod_estado_modulo_orden_produccion_global').val('1'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',true); } else { $('#cod_estado_modulo_orden_produccion_global').val('0'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',false); } 
if (cod_estado_comentario_venta_global=='1') { $('#cod_estado_comentario_venta_global').val('1'); $('#cod_estado_comentario_venta_global').prop('checked',true); } else { $('#cod_estado_comentario_venta_global').val('0'); $('#cod_estado_comentario_venta_global').prop('checked',false); } 
if (cod_estado_envio_sms_global=='1') { $('#cod_estado_envio_sms_global').val('1'); $('#cod_estado_envio_sms_global').prop('checked',true); } else { $('#cod_estado_envio_sms_global').val('0'); $('#cod_estado_envio_sms_global').prop('checked',false); } 
if (cod_estado_envio_correo_global=='1') { $('#cod_estado_envio_correo_global').val('1'); $('#cod_estado_envio_correo_global').prop('checked',true); } else { $('#cod_estado_envio_correo_global').val('0'); $('#cod_estado_envio_correo_global').prop('checked',false); } 
if (cod_estado_fecha_vencimiento_global=='1') { $('#cod_estado_fecha_vencimiento_global').val('1'); $('#cod_estado_fecha_vencimiento_global').prop('checked',true); } else { $('#cod_estado_fecha_vencimiento_global').val('0'); $('#cod_estado_fecha_vencimiento_global').prop('checked',false); } 
if (cod_estado_ptj_comision_global=='1') { $('#cod_estado_ptj_comision_global').val('1'); $('#cod_estado_ptj_comision_global').prop('checked',true); } else { $('#cod_estado_ptj_comision_global').val('0'); $('#cod_estado_ptj_comision_global').prop('checked',false); } 
if (cod_estado_impoconsumo_global=='1') { $('#cod_estado_impoconsumo_global').val('1'); $('#cod_estado_impoconsumo_global').prop('checked',true); } else { $('#cod_estado_impoconsumo_global').val('0'); $('#cod_estado_impoconsumo_global').prop('checked',false); } 
if (cod_estado_dto1_global=='1') { $('#cod_estado_dto1_global').val('1'); $('#cod_estado_dto1_global').prop('checked',true); } else { $('#cod_estado_dto1_global').val('0'); $('#cod_estado_dto1_global').prop('checked',false); } 
if (cod_estado_dto2_global=='1') { $('#cod_estado_dto2_global').val('1'); $('#cod_estado_dto2_global').prop('checked',true); } else { $('#cod_estado_dto2_global').val('0'); $('#cod_estado_dto2_global').prop('checked',false); } 
if (cod_estado_producto_consumo_global=='1') { $('#cod_estado_producto_consumo_global').val('1'); $('#cod_estado_producto_consumo_global').prop('checked',true); } else { $('#cod_estado_producto_consumo_global').val('0'); $('#cod_estado_producto_consumo_global').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_global=='1') { $('#cod_estado_cuenta_cobrar_global').val('1'); $('#cod_estado_cuenta_cobrar_global').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_global').val('0'); $('#cod_estado_cuenta_cobrar_global').prop('checked',false); } 
if (cod_estado_cuenta_pagar_global=='1') { $('#cod_estado_cuenta_pagar_global').val('1'); $('#cod_estado_cuenta_pagar_global').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_global').val('0'); $('#cod_estado_cuenta_pagar_global').prop('checked',false); } 
if (cod_estado_egreso_global=='1') { $('#cod_estado_egreso_global').val('1'); $('#cod_estado_egreso_global').prop('checked',true); } else { $('#cod_estado_egreso_global').val('0'); $('#cod_estado_egreso_global').prop('checked',false); } 
if (cod_estado_factura_compra_global=='1') { $('#cod_estado_factura_compra_global').val('1'); $('#cod_estado_factura_compra_global').prop('checked',true); } else { $('#cod_estado_factura_compra_global').val('0'); $('#cod_estado_factura_compra_global').prop('checked',false); } 
if (cod_estado_cita_global=='1') { $('#cod_estado_cita_global').val('1'); $('#cod_estado_cita_global').prop('checked',true); } else { $('#cod_estado_cita_global').val('0'); $('#cod_estado_cita_global').prop('checked',false); } 
if (cod_estado_usuario_global=='1') { $('#cod_estado_usuario_global').val('1'); $('#cod_estado_usuario_global').prop('checked',true); } else { $('#cod_estado_usuario_global').val('0'); $('#cod_estado_usuario_global').prop('checked',false); } 
if (cod_estado_dependencia_global=='1') { $('#cod_estado_dependencia_global').val('1'); $('#cod_estado_dependencia_global').prop('checked',true); } else { $('#cod_estado_dependencia_global').val('0'); $('#cod_estado_dependencia_global').prop('checked',false); } 
if (cod_estado_resolucion_factura_global=='1') { $('#cod_estado_resolucion_factura_global').val('1'); $('#cod_estado_resolucion_factura_global').prop('checked',true); } else { $('#cod_estado_resolucion_factura_global').val('0'); $('#cod_estado_resolucion_factura_global').prop('checked',false); } 
if (cod_estado_numero_letra_global=='1') { $('#cod_estado_numero_letra_global').val('1'); $('#cod_estado_numero_letra_global').prop('checked',true); } else { $('#cod_estado_numero_letra_global').val('0'); $('#cod_estado_numero_letra_global').prop('checked',false); } 
if (cod_estado_encuesta_experiencia_compra_global=='1') { $('#cod_estado_encuesta_experiencia_compra_global').val('1'); $('#cod_estado_encuesta_experiencia_compra_global').prop('checked',true); } else { $('#cod_estado_encuesta_experiencia_compra_global').val('0'); $('#cod_estado_encuesta_experiencia_compra_global').prop('checked',false); } 
if (cod_estado_codif_precio_compra_global=='1') { $('#cod_estado_codif_precio_compra_global').val('1'); $('#cod_estado_codif_precio_compra_global').prop('checked',true); } else { $('#cod_estado_codif_precio_compra_global').val('0'); $('#cod_estado_codif_precio_compra_global').prop('checked',false); } 
if (cod_estado_codif_precio_venta_global=='1') { $('#cod_estado_codif_precio_venta_global').val('1'); $('#cod_estado_codif_precio_venta_global').prop('checked',true); } else { $('#cod_estado_codif_precio_venta_global').val('0'); $('#cod_estado_codif_precio_venta_global').prop('checked',false); } 
if (cod_estado_img_impimir_factura_global=='1') { $('#cod_estado_img_impimir_factura_global').val('1'); $('#cod_estado_img_impimir_factura_global').prop('checked',true); } else { $('#cod_estado_img_impimir_factura_global').val('0'); $('#cod_estado_img_impimir_factura_global').prop('checked',false); } 
if (cod_estado_preventa_global=='1') { $('#cod_estado_preventa_global').val('1'); $('#cod_estado_preventa_global').prop('checked',true); } else { $('#cod_estado_preventa_global').val('0'); $('#cod_estado_preventa_global').prop('checked',false); } 
if (cod_estado_propina_global=='1') { $('#cod_estado_propina_global').val('1'); $('#cod_estado_propina_global').prop('checked',true); } else { $('#cod_estado_propina_global').val('0'); $('#cod_estado_propina_global').prop('checked',false); } 
if (cod_estado_inventario_bodega_global=='1') { $('#cod_estado_inventario_bodega_global').val('1'); $('#cod_estado_inventario_bodega_global').prop('checked',true); } else { $('#cod_estado_inventario_bodega_global').val('0'); $('#cod_estado_inventario_bodega_global').prop('checked',false); } 
if (cod_estado_modulo_contabilidad_global=='1') { $('#cod_estado_modulo_contabilidad_global').val('1'); $('#cod_estado_modulo_contabilidad_global').prop('checked',true); } else { $('#cod_estado_modulo_contabilidad_global').val('0'); $('#cod_estado_modulo_contabilidad_global').prop('checked',false); } 
if (cod_estado_modulo_cotizacion_global=='1') { $('#cod_estado_modulo_cotizacion_global').val('1'); $('#cod_estado_modulo_cotizacion_global').prop('checked',true); } else { $('#cod_estado_modulo_cotizacion_global').val('0'); $('#cod_estado_modulo_cotizacion_global').prop('checked',false); } 
if (cod_estado_compra_caja_global=='1') { $('#cod_estado_compra_caja_global').val('1'); $('#cod_estado_compra_caja_global').prop('checked',true); } else { $('#cod_estado_compra_caja_global').val('0'); $('#cod_estado_compra_caja_global').prop('checked',false); } 
if (cod_estado_sticker_barras_global=='1') { $('#cod_estado_sticker_barras_global').val('1'); $('#cod_estado_sticker_barras_global').prop('checked',true); } else { $('#cod_estado_sticker_barras_global').val('0'); $('#cod_estado_sticker_barras_global').prop('checked',false); } 
if (cod_estado_modulo_cotizacion_global=='1') { $('#cod_estado_modulo_cotizacion_global').val('1'); $('#cod_estado_modulo_cotizacion_global').prop('checked',true); } else { $('#cod_estado_modulo_cotizacion_global').val('0'); $('#cod_estado_modulo_cotizacion_global').prop('checked',false); } 
if (cod_estado_producto_consumo_global=='1') { $('#cod_estado_producto_consumo_global').val('1'); $('#cod_estado_producto_consumo_global').prop('checked',true); } else { $('#cod_estado_producto_consumo_global').val('0'); $('#cod_estado_producto_consumo_global').prop('checked',false); } 
if (cod_estado_compra_caja_global=='1') { $('#cod_estado_compra_caja_global').val('1'); $('#cod_estado_compra_caja_global').prop('checked',true); } else { $('#cod_estado_compra_caja_global').val('0'); $('#cod_estado_compra_caja_global').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_global=='1') { $('#cod_estado_cuenta_cobrar_global').val('1'); $('#cod_estado_cuenta_cobrar_global').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_global').val('0'); $('#cod_estado_cuenta_cobrar_global').prop('checked',false); } 
if (cod_estado_cuenta_pagar_global=='1') { $('#cod_estado_cuenta_pagar_global').val('1'); $('#cod_estado_cuenta_pagar_global').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_global').val('0'); $('#cod_estado_cuenta_pagar_global').prop('checked',false); } 
if (cod_estado_egreso_global=='1') { $('#cod_estado_egreso_global').val('1'); $('#cod_estado_egreso_global').prop('checked',true); } else { $('#cod_estado_egreso_global').val('0'); $('#cod_estado_egreso_global').prop('checked',false); } 
if (cod_estado_usuario_global=='1') { $('#cod_estado_usuario_global').val('1'); $('#cod_estado_usuario_global').prop('checked',true); } else { $('#cod_estado_usuario_global').val('0'); $('#cod_estado_usuario_global').prop('checked',false); } 
if (cod_estado_dependencia_global=='1') { $('#cod_estado_dependencia_global').val('1'); $('#cod_estado_dependencia_global').prop('checked',true); } else { $('#cod_estado_dependencia_global').val('0'); $('#cod_estado_dependencia_global').prop('checked',false); } 
if (cod_estado_numero_letra_global=='1') { $('#cod_estado_numero_letra_global').val('1'); $('#cod_estado_numero_letra_global').prop('checked',true); } else { $('#cod_estado_numero_letra_global').val('0'); $('#cod_estado_numero_letra_global').prop('checked',false); } 
if (cod_estado_resolucion_factura_global=='1') { $('#cod_estado_resolucion_factura_global').val('1'); $('#cod_estado_resolucion_factura_global').prop('checked',true); } else { $('#cod_estado_resolucion_factura_global').val('0'); $('#cod_estado_resolucion_factura_global').prop('checked',false); } 
if (cod_estado_cita_global=='1') { $('#cod_estado_cita_global').val('1'); $('#cod_estado_cita_global').prop('checked',true); } else { $('#cod_estado_cita_global').val('0'); $('#cod_estado_cita_global').prop('checked',false); } 
if (cod_estado_factura_compra_global=='1') { $('#cod_estado_factura_compra_global').val('1'); $('#cod_estado_factura_compra_global').prop('checked',true); } else { $('#cod_estado_factura_compra_global').val('0'); $('#cod_estado_factura_compra_global').prop('checked',false); } 
if (cod_estado_modulo_producto_global=='1') { $('#cod_estado_modulo_producto_global').val('1'); $('#cod_estado_modulo_producto_global').prop('checked',true); } else { $('#cod_estado_modulo_producto_global').val('0'); $('#cod_estado_modulo_producto_global').prop('checked',false); } 
if (cod_estado_modulo_facturacion_global=='1') { $('#cod_estado_modulo_facturacion_global').val('1'); $('#cod_estado_modulo_facturacion_global').prop('checked',true); } else { $('#cod_estado_modulo_facturacion_global').val('0'); $('#cod_estado_modulo_facturacion_global').prop('checked',false); } 
if (cod_estado_modulo_venta_global=='1') { $('#cod_estado_modulo_venta_global').val('1'); $('#cod_estado_modulo_venta_global').prop('checked',true); } else { $('#cod_estado_modulo_venta_global').val('0'); $('#cod_estado_modulo_venta_global').prop('checked',false); } 
if (cod_estado_modulo_tercero_global=='1') { $('#cod_estado_modulo_tercero_global').val('1'); $('#cod_estado_modulo_tercero_global').prop('checked',true); } else { $('#cod_estado_modulo_tercero_global').val('0'); $('#cod_estado_modulo_tercero_global').prop('checked',false); } 
if (cod_estado_modulo_cuenta_global=='1') { $('#cod_estado_modulo_cuenta_global').val('1'); $('#cod_estado_modulo_cuenta_global').prop('checked',true); } else { $('#cod_estado_modulo_cuenta_global').val('0'); $('#cod_estado_modulo_cuenta_global').prop('checked',false); } 
if (cod_estado_modulo_reporte_global=='1') { $('#cod_estado_modulo_reporte_global').val('1'); $('#cod_estado_modulo_reporte_global').prop('checked',true); } else { $('#cod_estado_modulo_reporte_global').val('0'); $('#cod_estado_modulo_reporte_global').prop('checked',false); } 
if (cod_estado_modulo_admin_global=='1') { $('#cod_estado_modulo_admin_global').val('1'); $('#cod_estado_modulo_admin_global').prop('checked',true); } else { $('#cod_estado_modulo_admin_global').val('0'); $('#cod_estado_modulo_admin_global').prop('checked',false); } 
if (cod_estado_pyg_global=='1') { $('#cod_estado_pyg_global').val('1'); $('#cod_estado_pyg_global').prop('checked',true); } else { $('#cod_estado_pyg_global').val('0'); $('#AAAA').prop('checked',false); } 
if (cod_estado_balance_global=='1') { $('#cod_estado_balance_global').val('1'); $('#cod_estado_balance_global').prop('checked',true); } else { $('#cod_estado_balance_global').val('0'); $('#cod_estado_balance_global').prop('checked',false); } 
if (cod_estado_ganancia_ptj_global=='1') { $('#cod_estado_ganancia_ptj_global').val('1'); $('#cod_estado_ganancia_ptj_global').prop('checked',true); } else { $('#cod_estado_ganancia_ptj_global').val('0'); $('#cod_estado_ganancia_ptj_global').prop('checked',false); } 
if (cod_estado_modulo_orden_produccion_global=='1') { $('#cod_estado_modulo_orden_produccion_global').val('1'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',true); } else { $('#cod_estado_modulo_orden_produccion_global').val('0'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',false); } 
if (cod_estado_comentario_venta_global=='1') { $('#cod_estado_comentario_venta_global').val('1'); $('#cod_estado_comentario_venta_global').prop('checked',true); } else { $('#cod_estado_comentario_venta_global').val('0'); $('#cod_estado_comentario_venta_global').prop('checked',false); } 
if (cod_estado_envio_sms_global=='1') { $('#cod_estado_envio_sms_global').val('1'); $('#cod_estado_envio_sms_global').prop('checked',true); } else { $('#cod_estado_envio_sms_global').val('0'); $('#cod_estado_envio_sms_global').prop('checked',false); } 
if (cod_estado_envio_correo_global=='1') { $('#cod_estado_envio_correo_global').val('1'); $('#cod_estado_envio_correo_global').prop('checked',true); } else { $('#cod_estado_envio_correo_global').val('0'); $('#cod_estado_envio_correo_global').prop('checked',false); } 
if (cod_estado_ordenamiento_alfabetico_venta_global=='1') { $('#cod_estado_ordenamiento_alfabetico_venta_global').val('1'); $('#cod_estado_ordenamiento_alfabetico_venta_global').prop('checked',true); } else { $('#cod_estado_ordenamiento_alfabetico_venta_global').val('0'); $('#cod_estado_ordenamiento_alfabetico_venta_global').prop('checked',false); } 
if (cod_estado_nocodif_precio_compra_sticker_global=='1') { $('#cod_estado_nocodif_precio_compra_sticker_global').val('1'); $('#cod_estado_nocodif_precio_compra_sticker_global').prop('checked',true); } else { $('#cod_estado_nocodif_precio_compra_sticker_global').val('0'); $('#cod_estado_nocodif_precio_compra_sticker_global').prop('checked',false); } 
if (cod_estado_nocodif_precio_venta_sticker_global=='1') { $('#cod_estado_nocodif_precio_venta_sticker_global').val('1'); $('#cod_estado_nocodif_precio_venta_sticker_global').prop('checked',true); } else { $('#cod_estado_nocodif_precio_venta_sticker_global').val('0'); $('#cod_estado_nocodif_precio_venta_sticker_global').prop('checked',false); } 
if (cod_estado_nombre_empresa_sticker_global=='1') { $('#cod_estado_nombre_empresa_sticker_global').val('1'); $('#cod_estado_nombre_empresa_sticker_global').prop('checked',true); } else { $('#cod_estado_nombre_empresa_sticker_global').val('0'); $('#cod_estado_nombre_empresa_sticker_global').prop('checked',false); } 
if (cod_estado_fecha_compra_sticker_global=='1') { $('#cod_estado_fecha_compra_sticker_global').val('1'); $('#cod_estado_fecha_compra_sticker_global').prop('checked',true); } else { $('#cod_estado_fecha_compra_sticker_global').val('0'); $('#cod_estado_fecha_compra_sticker_global').prop('checked',false); } 
if (cod_estado_cod_tercero_sticker_global=='1') { $('#cod_estado_cod_tercero_sticker_global').val('1'); $('#cod_estado_cod_tercero_sticker_global').prop('checked',true); } else { $('#cod_estado_cod_tercero_sticker_global').val('0'); $('#cod_estado_cod_tercero_sticker_global').prop('checked',false); } 
if (cod_estado_url_pagina_sticker_global=='1') { $('#cod_estado_url_pagina_sticker_global').val('1'); $('#cod_estado_url_pagina_sticker_global').prop('checked',true); } else { $('#cod_estado_url_pagina_sticker_global').val('0'); $('#cod_estado_url_pagina_sticker_global').prop('checked',false); } 
if (cod_estado_nombre_desarrollador_sticker_global=='1') { $('#cod_estado_nombre_desarrollador_sticker_global').val('1'); $('#cod_estado_nombre_desarrollador_sticker_global').prop('checked',true); } else { $('#cod_estado_nombre_desarrollador_sticker_global').val('0'); $('#cod_estado_nombre_desarrollador_sticker_global').prop('checked',false); } 
if (cod_estado_qr_sticker_global=='1') { $('#cod_estado_qr_sticker_global').val('1'); $('#cod_estado_qr_sticker_global').prop('checked',true); } else { $('#cod_estado_qr_sticker_global').val('0'); $('#cod_estado_qr_sticker_global').prop('checked',false); } 
if (cod_estado_habilitar_tercero_por_usuario_global=='1') { $('#cod_estado_habilitar_tercero_por_usuario_global').val('1'); $('#cod_estado_habilitar_tercero_por_usuario_global').prop('checked',true); } else { $('#cod_estado_habilitar_tercero_por_usuario_global').val('0'); $('#cod_estado_habilitar_tercero_por_usuario_global').prop('checked',false); } 
if (cod_estado_subproducto_global=='1') { $('#cod_estado_subproducto_global').val('1'); $('#cod_estado_subproducto_global').prop('checked',true); } else { $('#cod_estado_subproducto_global').val('0'); $('#cod_estado_subproducto_global').prop('checked',false); } 
if (cod_estado_nuevo_inventario_global=='1') { $('#cod_estado_nuevo_inventario_global').val('1'); $('#cod_estado_nuevo_inventario_global').prop('checked',true); } else { $('#cod_estado_nuevo_inventario_global').val('0'); $('#cod_estado_nuevo_inventario_global').prop('checked',false); } 
if (cod_estado_auditoria_global=='1') { $('#cod_estado_auditoria_global').val('1'); $('#cod_estado_auditoria_global').prop('checked',true); } else { $('#cod_estado_auditoria_global').val('0'); $('#cod_estado_auditoria_global').prop('checked',false); } 
if (cod_estado_cierre_caja_global=='1') { $('#cod_estado_cierre_caja_global').val('1'); $('#cod_estado_cierre_caja_global').prop('checked',true); } else { $('#cod_estado_cierre_caja_global').val('0'); $('#cod_estado_cierre_caja_global').prop('checked',false); } 
if (cod_estado_fecha_mantenimiento_global=='1') { $('#cod_estado_fecha_mantenimiento_global').val('1'); $('#cod_estado_fecha_mantenimiento_global').prop('checked',true); } else { $('#cod_estado_fecha_mantenimiento_global').val('0'); $('#cod_estado_fecha_mantenimiento_global').prop('checked',false); } 
if (cod_estado_animal_global=='1') { $('#cod_estado_animal_global').val('1'); $('#cod_estado_animal_global').prop('checked',true); } else { $('#cod_estado_animal_global').val('0'); $('#cod_estado_animal_global').prop('checked',false); } 
if (cod_estado_producto_serial_global=='1') { $('#cod_estado_producto_serial_global').val('1'); $('#cod_estado_producto_serial_global').prop('checked',true); } else { $('#cod_estado_producto_serial_global').val('0'); $('#cod_estado_producto_serial_global').prop('checked',false); } 
if (cod_estado_venta_prod_en_cero_global=='1') { $('#cod_estado_venta_prod_en_cero_global').val('1'); $('#cod_estado_venta_prod_en_cero_global').prop('checked',true); } else { $('#cod_estado_venta_prod_en_cero_global').val('0'); $('#cod_estado_venta_prod_en_cero_global').prop('checked',false); } 
if (cod_estado_observacion_tercero_venta_global=='1') { $('#cod_estado_observacion_tercero_venta_global').val('1'); $('#cod_estado_observacion_tercero_venta_global').prop('checked',true); } else { $('#cod_estado_observacion_tercero_venta_global').val('0'); $('#cod_estado_observacion_tercero_venta_global').prop('checked',false); } 
if (cod_estado_alerta_fecha_nac_global=='1') { $('#cod_estado_alerta_fecha_nac_global').val('1'); $('#cod_estado_alerta_fecha_nac_global').prop('checked',true); } else { $('#cod_estado_alerta_fecha_nac_global').val('0'); $('#cod_estado_alerta_fecha_nac_global').prop('checked',false); } 
if (cod_estado_categoria_global=='1') { $('#cod_estado_categoria_global').val('1'); $('#cod_estado_categoria_global').prop('checked',true); } else { $('#cod_estado_categoria_global').val('0'); $('#cod_estado_categoria_global').prop('checked',false); } 
if (cod_estado_peso_producto_global=='1') { $('#cod_estado_peso_producto_global').val('1'); $('#cod_estado_peso_producto_global').prop('checked',true); } else { $('#cod_estado_peso_producto_global').val('0'); $('#cod_estado_peso_producto_global').prop('checked',false); } 
if (cod_estado_estante_producto_global=='1') { $('#cod_estado_estante_producto_global').val('1'); $('#cod_estado_estante_producto_global').prop('checked',true); } else { $('#cod_estado_estante_producto_global').val('0'); $('#cod_estado_estante_producto_global').prop('checked',false); } 
if (cod_estado_devolucion_btn_verde_global=='1') { $('#cod_estado_devolucion_btn_verde_global').val('1'); $('#cod_estado_devolucion_btn_verde_global').prop('checked',true); } else { $('#cod_estado_devolucion_btn_verde_global').val('0'); $('#cod_estado_devolucion_btn_verde_global').prop('checked',false); } 
if (cod_estado_plan_separe_global=='1') { $('#cod_estado_plan_separe_global').val('1'); $('#cod_estado_plan_separe_global').prop('checked',true); } else { $('#cod_estado_plan_separe_global').val('0'); $('#cod_estado_plan_separe_global').prop('checked',false); } 
if (cod_estado_admin_global=='1') { $('#cod_estado_admin_global').val('1'); $('#cod_estado_admin_global').prop('checked',true); } else { $('#cod_estado_admin_global').val('0'); $('#cod_estado_admin_global').prop('checked',false); } 
if (cod_estado_prodcuto_mantenimiento_global=='1') { $('#cod_estado_prodcuto_mantenimiento_global').val('1'); $('#cod_estado_prodcuto_mantenimiento_global').prop('checked',true); } else { $('#cod_estado_prodcuto_mantenimiento_global').val('0'); $('#cod_estado_prodcuto_mantenimiento_global').prop('checked',false); } 
if (cod_estado_eliminar_global=='1') { $('#cod_estado_eliminar_global').val('1'); $('#cod_estado_eliminar_global').prop('checked',true); } else { $('#cod_estado_eliminar_global').val('0'); $('#cod_estado_eliminar_global').prop('checked',false); } 
if (cod_estado_soporte_factura_compra_global=='1') { $('#cod_estado_soporte_factura_compra_global').val('1'); $('#cod_estado_soporte_factura_compra_global').prop('checked',true); } else { $('#cod_estado_soporte_factura_compra_global').val('0'); $('#cod_estado_soporte_factura_compra_global').prop('checked',false); } 
if (cod_estado_observacion_factura_compra_global=='1') { $('#cod_estado_observacion_factura_compra_global').val('1'); $('#cod_estado_observacion_factura_compra_global').prop('checked',true); } else { $('#cod_estado_observacion_factura_compra_global').val('0'); $('#cod_estado_observacion_factura_compra_global').prop('checked',false); } 
if (cod_estado_venta_precio_min_venta_global=='1') { $('#cod_estado_venta_precio_min_venta_global').val('1'); $('#cod_estado_venta_precio_min_venta_global').prop('checked',true); } else { $('#cod_estado_venta_precio_min_venta_global').val('0'); $('#cod_estado_venta_precio_min_venta_global').prop('checked',false); } 
if (cod_estado_hotel_global=='1') { $('#cod_estado_hotel_global').val('1'); $('#cod_estado_hotel_global').prop('checked',true); } else { $('#cod_estado_hotel_global').val('0'); $('#cod_estado_hotel_global').prop('checked',false); } 
if (cod_estado_parqueo_global=='1') { $('#cod_estado_parqueo_global').val('1'); $('#cod_estado_parqueo_global').prop('checked',true); } else { $('#cod_estado_parqueo_global').val('0'); $('#cod_estado_parqueo_global').prop('checked',false); } 
if (cod_estado_plan_accion_correcion_global=='1') { $('#cod_estado_plan_accion_correcion_global').val('1'); $('#cod_estado_plan_accion_correcion_global').prop('checked',true); } else { $('#cod_estado_plan_accion_correcion_global').val('0'); $('#cod_estado_plan_accion_correcion_global').prop('checked',false); } 
if (cod_estado_cocina_global=='1') { $('#cod_estado_cocina_global').val('1'); $('#cod_estado_cocina_global').prop('checked',true); } else { $('#cod_estado_cocina_global').val('0'); $('#cod_estado_cocina_global').prop('checked',false); } 
if (cod_estado_cajas_sobre_global=='1') { $('#cod_estado_cajas_sobre_global').val('1'); $('#cod_estado_cajas_sobre_global').prop('checked',true); } else { $('#cod_estado_cajas_sobre_global').val('0'); $('#cod_estado_cajas_sobre_global').prop('checked',false); } 
if (cod_estado_und_sobre_global=='1') { $('#cod_estado_und_sobre_global').val('1'); $('#cod_estado_und_sobre_global').prop('checked',true); } else { $('#cod_estado_und_sobre_global').val('0'); $('#cod_estado_und_sobre_global').prop('checked',false); } 
if (cod_estado_meses_garantia_global=='1') { $('#cod_estado_meses_garantia_global').val('1'); $('#cod_estado_meses_garantia_global').prop('checked',true); } else { $('#cod_estado_meses_garantia_global').val('0'); $('#cod_estado_meses_garantia_global').prop('checked',false); } 
if (cod_estado_marca_global=='1') { $('#cod_estado_marca_global').val('1'); $('#cod_estado_marca_global').prop('checked',true); } else { $('#cod_estado_marca_global').val('0'); $('#cod_estado_marca_global').prop('checked',false); } 
if (cod_estado_proveedor_global=='1') { $('#cod_estado_proveedor_global').val('1'); $('#cod_estado_proveedor_global').prop('checked',true); } else { $('#cod_estado_proveedor_global').val('0'); $('#cod_estado_proveedor_global').prop('checked',false); } 
if (cod_estado_archivo_adjunto_global=='1') { $('#cod_estado_archivo_adjunto_global').val('1'); $('#cod_estado_archivo_adjunto_global').prop('checked',true); } else { $('#cod_estado_archivo_adjunto_global').val('0'); $('#cod_estado_archivo_adjunto_global').prop('checked',false); } 
if (cod_estado_precio_compra_mod_venta_global=='1') { $('#cod_estado_precio_compra_mod_venta_global').val('1'); $('#cod_estado_precio_compra_mod_venta_global').prop('checked',true); } else { $('#cod_estado_precio_compra_mod_venta_global').val('0'); $('#cod_estado_precio_compra_mod_venta_global').prop('checked',false); } 
if (cod_estado_timbre_entrada_pedido_temporal_cocina_global=='1') { $('#cod_estado_timbre_entrada_pedido_temporal_cocina_global').val('1'); $('#cod_estado_timbre_entrada_pedido_temporal_cocina_global').prop('checked',true); } else { $('#cod_estado_timbre_entrada_pedido_temporal_cocina_global').val('0'); $('#cod_estado_timbre_entrada_pedido_temporal_cocina_global').prop('checked',false); } 
if (cod_estado_timbre_salida_pedido_temporal_cocina_global=='1') { $('#cod_estado_timbre_salida_pedido_temporal_cocina_global').val('1'); $('#cod_estado_timbre_salida_pedido_temporal_cocina_global').prop('checked',true); } else { $('#cod_estado_timbre_salida_pedido_temporal_cocina_global').val('0'); $('#cod_estado_timbre_salida_pedido_temporal_cocina_global').prop('checked',false); } 
if (cod_estado_subproducto_mostrar_imprimir_global=='1') { $('#cod_estado_subproducto_mostrar_imprimir_global').val('1'); $('#cod_estado_subproducto_mostrar_imprimir_global').prop('checked',true); } else { $('#cod_estado_subproducto_mostrar_imprimir_global').val('0'); $('#cod_estado_subproducto_mostrar_imprimir_global').prop('checked',false); } 
if (cod_estado_img_producto_global=='1') { $('#cod_estado_img_producto_global').val('1'); $('#cod_estado_img_producto_global').prop('checked',true); } else { $('#cod_estado_img_producto_global').val('0'); $('#cod_estado_img_producto_global').prop('checked',false); } 
if (cod_estado_diferencia_ganancia_inventario_global=='1') { $('#cod_estado_diferencia_ganancia_inventario_global').val('1'); $('#cod_estado_diferencia_ganancia_inventario_global').prop('checked',true); } else { $('#cod_estado_diferencia_ganancia_inventario_global').val('0'); $('#cod_estado_diferencia_ganancia_inventario_global').prop('checked',false); } 
if (cod_estado_diferencia_ganancia_inventario_ptj_promedio_global=='1') { $('#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global').val('1'); $('#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global').prop('checked',true); } else { $('#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global').val('0'); $('#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global').prop('checked',false); } 
if (cod_estado_opcion_descontable_inv_global=='1') { $('#cod_estado_opcion_descontable_inv_global').val('1'); $('#cod_estado_opcion_descontable_inv_global').prop('checked',true); } else { $('#cod_estado_opcion_descontable_inv_global').val('0'); $('#cod_estado_opcion_descontable_inv_global').prop('checked',false); } 
if (cod_estado_hora_reporte_venta_global=='1') { $('#cod_estado_hora_reporte_venta_global').val('1'); $('#cod_estado_hora_reporte_venta_global').prop('checked',true); } else { $('#cod_estado_hora_reporte_venta_global').val('0'); $('#cod_estado_hora_reporte_venta_global').prop('checked',false); } 
if (cod_estado_cantidad_caja_mesa_global=='1') { $('#cod_estado_cantidad_caja_mesa_global').val('1'); $('#cod_estado_cantidad_caja_mesa_global').prop('checked',true); } else { $('#cod_estado_cantidad_caja_mesa_global').val('0'); $('#cod_estado_cantidad_caja_mesa_global').prop('checked',false); } 
if (cod_estado_venta_por_categoria_mod_venta_global=='1') { $('#cod_estado_venta_por_categoria_mod_venta_global').val('1'); $('#cod_estado_venta_por_categoria_mod_venta_global').prop('checked',true); } else { $('#cod_estado_venta_por_categoria_mod_venta_global').val('0'); $('#cod_estado_venta_por_categoria_mod_venta_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_facturar_mod_venta_global=='1') { $('#cod_estado_habilitar_btn_facturar_mod_venta_global').val('1'); $('#cod_estado_habilitar_btn_facturar_mod_venta_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_facturar_mod_venta_global').val('0'); $('#cod_estado_habilitar_btn_facturar_mod_venta_global').prop('checked',false); } 
if (cod_estado_btn_imprimir_preventa_cocina_global=='1') { $('#cod_estado_btn_imprimir_preventa_cocina_global').val('1'); $('#cod_estado_btn_imprimir_preventa_cocina_global').prop('checked',true); } else { $('#cod_estado_btn_imprimir_preventa_cocina_global').val('0'); $('#cod_estado_btn_imprimir_preventa_cocina_global').prop('checked',false); } 
if (cod_estado_producto_de_cocina_global=='1') { $('#cod_estado_producto_de_cocina_global').val('1'); $('#cod_estado_producto_de_cocina_global').prop('checked',true); } else { $('#cod_estado_producto_de_cocina_global').val('0'); $('#cod_estado_producto_de_cocina_global').prop('checked',false); } 
if (cod_estado_posicion_gps_pedidos_global=='1') { $('#cod_estado_posicion_gps_pedidos_global').val('1'); $('#cod_estado_posicion_gps_pedidos_global').prop('checked',true); } else { $('#cod_estado_posicion_gps_pedidos_global').val('0'); $('#cod_estado_posicion_gps_pedidos_global').prop('checked',false); } 
if (cod_estado_precio_venta_variable_disponible_admin_global=='1') { $('#cod_estado_precio_venta_variable_disponible_admin_global').val('1'); $('#cod_estado_precio_venta_variable_disponible_admin_global').prop('checked',true); } else { $('#cod_estado_precio_venta_variable_disponible_admin_global').val('0'); $('#cod_estado_precio_venta_variable_disponible_admin_global').prop('checked',false); } 
if (cod_estado_check_imp_global=='1') { $('#cod_estado_check_imp_global').val('1'); $('#cod_estado_check_imp_global').prop('checked',true); } else { $('#cod_estado_check_imp_global').val('0'); $('#cod_estado_check_imp_global').prop('checked',false); } 
if (cod_estado_dividir_factura_caja_mesa_global=='1') { $('#cod_estado_dividir_factura_caja_mesa_global').val('1'); $('#cod_estado_dividir_factura_caja_mesa_global').prop('checked',true); } else { $('#cod_estado_dividir_factura_caja_mesa_global').val('0'); $('#cod_estado_dividir_factura_caja_mesa_global').prop('checked',false); } 
if (cod_estado_agrupar_por_producto_imp_global=='1') { $('#cod_estado_agrupar_por_producto_imp_global').val('1'); $('#cod_estado_agrupar_por_producto_imp_global').prop('checked',true); } else { $('#cod_estado_agrupar_por_producto_imp_global').val('0'); $('#cod_estado_agrupar_por_producto_imp_global').prop('checked',false); } 
if (cod_estado_descuento_concepto_venta_neg_global=='1') { $('#cod_estado_descuento_concepto_venta_neg_global').val('1'); $('#cod_estado_descuento_concepto_venta_neg_global').prop('checked',true); } else { $('#cod_estado_descuento_concepto_venta_neg_global').val('0'); $('#cod_estado_descuento_concepto_venta_neg_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_venta_nav_global=='1') { $('#cod_estado_habilitar_btn_imp_venta_nav_global').val('1'); $('#cod_estado_habilitar_btn_imp_venta_nav_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_venta_nav_global').val('0'); $('#cod_estado_habilitar_btn_imp_venta_nav_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_venta_direct_driv_global=='1') { $('#cod_estado_habilitar_btn_imp_venta_direct_driv_global').val('1'); $('#cod_estado_habilitar_btn_imp_venta_direct_driv_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_venta_direct_driv_global').val('0'); $('#cod_estado_habilitar_btn_imp_venta_direct_driv_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_nav_carta_pdf_global=='1') { $('#cod_estado_habilitar_btn_imp_nav_carta_pdf_global').val('1'); $('#cod_estado_habilitar_btn_imp_nav_carta_pdf_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_nav_carta_pdf_global').val('0'); $('#cod_estado_habilitar_btn_imp_nav_carta_pdf_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_preventodo_nav_global=='1') { $('#cod_estado_habilitar_btn_imp_preventodo_nav_global').val('1'); $('#cod_estado_habilitar_btn_imp_preventodo_nav_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_preventodo_nav_global').val('0'); $('#cod_estado_habilitar_btn_imp_preventodo_nav_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_preventodo_direct_driv_global=='1') { $('#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global').val('1'); $('#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global').val('0'); $('#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_cocina_nav_global=='1') { $('#cod_estado_habilitar_btn_imp_cocina_nav_global').val('1'); $('#cod_estado_habilitar_btn_imp_cocina_nav_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_cocina_nav_global').val('0'); $('#cod_estado_habilitar_btn_imp_cocina_nav_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_cocina_direct_driv_global=='1') { $('#cod_estado_habilitar_btn_imp_cocina_direct_driv_global').val('1'); $('#cod_estado_habilitar_btn_imp_cocina_direct_driv_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_cocina_direct_driv_global').val('0'); $('#cod_estado_habilitar_btn_imp_cocina_direct_driv_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_repventa_consol_nav_global=='1') { $('#cod_estado_habilitar_btn_imp_repventa_consol_nav_global').val('1'); $('#cod_estado_habilitar_btn_imp_repventa_consol_nav_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_repventa_consol_nav_global').val('0'); $('#cod_estado_habilitar_btn_imp_repventa_consol_nav_global').prop('checked',false); } 
if (cod_estado_habilitar_btn_imp_repventa_direct_driv_global=='1') { $('#cod_estado_habilitar_btn_imp_repventa_direct_driv_global').val('1'); $('#cod_estado_habilitar_btn_imp_repventa_direct_driv_global').prop('checked',true); } else { $('#cod_estado_habilitar_btn_imp_repventa_direct_driv_global').val('0'); $('#cod_estado_habilitar_btn_imp_repventa_direct_driv_global').prop('checked',false); } 
if (cod_estado_modificar_und_venta_una_sola_vez_global=='1') { $('#cod_estado_modificar_und_venta_una_sola_vez_global').val('1'); $('#cod_estado_modificar_und_venta_una_sola_vez_global').prop('checked',true); } else { $('#cod_estado_modificar_und_venta_una_sola_vez_global').val('0'); $('#cod_estado_modificar_und_venta_una_sola_vez_global').prop('checked',false); } 
if (cod_estado_habilitar_hora_venta_temporal_global=='1') { $('#cod_estado_habilitar_hora_venta_temporal_global').val('1'); $('#cod_estado_habilitar_hora_venta_temporal_global').prop('checked',true); } else { $('#cod_estado_habilitar_hora_venta_temporal_global').val('0'); $('#cod_estado_habilitar_hora_venta_temporal_global').prop('checked',false); } 
if (cod_estado_revisado_venta_temporal_global=='1') { $('#cod_estado_revisado_venta_temporal_global').val('1'); $('#cod_estado_revisado_venta_temporal_global').prop('checked',true); } else { $('#cod_estado_revisado_venta_temporal_global').val('0'); $('#cod_estado_revisado_venta_temporal_global').prop('checked',false); } 
if (cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global=='1') { $('#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global').val('1'); $('#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global').prop('checked',true); } else { $('#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global').val('0'); $('#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global').prop('checked',false); } 
if (cod_estado_prioridad_caja_mesa_global=='1') { $('#cod_estado_prioridad_caja_mesa_global').val('1'); $('#cod_estado_prioridad_caja_mesa_global').prop('checked',true); } else { $('#cod_estado_prioridad_caja_mesa_global').val('0'); $('#cod_estado_prioridad_caja_mesa_global').prop('checked',false); } 
if (cod_estado_transferencia_empresa_extern_global=='1') { $('#cod_estado_transferencia_empresa_extern_global').val('1'); $('#cod_estado_transferencia_empresa_extern_global').prop('checked',true); } else { $('#cod_estado_transferencia_empresa_extern_global').val('0'); $('#cod_estado_transferencia_empresa_extern_global').prop('checked',false); } 
if (cod_estado_descuento_automatico_por_cambio_precio_venta_global=='1') { $('#cod_estado_descuento_automatico_por_cambio_precio_venta_global').val('1'); $('#cod_estado_descuento_automatico_por_cambio_precio_venta_global').prop('checked',true); } else { $('#cod_estado_descuento_automatico_por_cambio_precio_venta_global').val('0'); $('#cod_estado_descuento_automatico_por_cambio_precio_venta_global').prop('checked',false); } 
if (cod_estado_btn_categoria_desplegable_global=='1') { $('#cod_estado_btn_categoria_desplegable_global').val('1'); $('#cod_estado_btn_categoria_desplegable_global').prop('checked',true); } else { $('#cod_estado_btn_categoria_desplegable_global').val('0'); $('#cod_estado_btn_categoria_desplegable_global').prop('checked',false); } 
if (cod_estado_consultar_precios_extern_global=='1') { $('#cod_estado_consultar_precios_extern_global').val('1'); $('#cod_estado_consultar_precios_extern_global').prop('checked',true); } else { $('#cod_estado_consultar_precios_extern_global').val('0'); $('#cod_estado_consultar_precios_extern_global').prop('checked',false); } 
if (cod_estado_marcado_revisado_caja_mesa_venta_temporal_global=='1') { $('#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global').val('1'); $('#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global').prop('checked',true); } else { $('#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global').val('0'); $('#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global').prop('checked',false); } 
if (cod_estado_nombre_producto_editable_factura_compra_global=='1') { $('#cod_estado_nombre_producto_editable_factura_compra_global').val('1'); $('#cod_estado_nombre_producto_editable_factura_compra_global').prop('checked',true); } else { $('#cod_estado_nombre_producto_editable_factura_compra_global').val('0'); $('#cod_estado_nombre_producto_editable_factura_compra_global').prop('checked',false); } 
if (cod_estado_tipo_compra_global=='1') { $('#cod_estado_tipo_compra_global').val('1'); $('#cod_estado_tipo_compra_global').prop('checked',true); } else { $('#cod_estado_tipo_compra_global').val('0'); $('#cod_estado_tipo_compra_global').prop('checked',false); } 
if (cod_estado_nota_observacion_global=='1') { $('#cod_estado_nota_observacion_global').val('1'); $('#cod_estado_nota_observacion_global').prop('checked',true); } else { $('#cod_estado_nota_observacion_global').val('0'); $('#cod_estado_nota_observacion_global').prop('checked',false); } 
if (cod_estado_grafico_estadistico_global=='1') { $('#cod_estado_grafico_estadistico_global').val('1'); $('#cod_estado_grafico_estadistico_global').prop('checked',true); } else { $('#cod_estado_grafico_estadistico_global').val('0'); $('#cod_estado_grafico_estadistico_global').prop('checked',false); } 
if (cod_estado_inventario_bodega2_global=='1') { $('#cod_estado_inventario_bodega2_global').val('1'); $('#cod_estado_inventario_bodega2_global').prop('checked',true); } else { $('#cod_estado_inventario_bodega2_global').val('0'); $('#cod_estado_inventario_bodega2_global').prop('checked',false); } 
if (cod_estado_tipo_roles_global=='1') { $('#cod_estado_tipo_roles_global').val('1'); $('#cod_estado_tipo_roles_global').prop('checked',true); } else { $('#cod_estado_tipo_roles_global').val('0'); $('#cod_estado_tipo_roles_global').prop('checked',false); } 
if (cod_estado_bascula_balanza_electronica_pesar_producto_global=='1') { $('#cod_estado_bascula_balanza_electronica_pesar_producto_global').val('1'); $('#cod_estado_bascula_balanza_electronica_pesar_producto_global').prop('checked',true); } else { $('#cod_estado_bascula_balanza_electronica_pesar_producto_global').val('0'); $('#cod_estado_bascula_balanza_electronica_pesar_producto_global').prop('checked',false); } 
if (cod_estado_bascula_balanza_cod_barras_pesar_producto_global=='1') { $('#cod_estado_bascula_balanza_cod_barras_pesar_producto_global').val('1'); $('#cod_estado_bascula_balanza_cod_barras_pesar_producto_global').prop('checked',true); } else { $('#cod_estado_bascula_balanza_cod_barras_pesar_producto_global').val('0'); $('#cod_estado_bascula_balanza_cod_barras_pesar_producto_global').prop('checked',false); } 
if (cod_estado_lote_compra_global=='1') { $('#cod_estado_lote_compra_global').val('1'); $('#cod_estado_lote_compra_global').prop('checked',true); } else { $('#cod_estado_lote_compra_global').val('0'); $('#cod_estado_lote_compra_global').prop('checked',false); } 
if (cod_estado_tipo_metodo_envio_global=='1') { $('#cod_estado_tipo_metodo_envio_global').val('1'); $('#cod_estado_tipo_metodo_envio_global').prop('checked',true); } else { $('#cod_estado_tipo_metodo_envio_global').val('0'); $('#cod_estado_tipo_metodo_envio_global').prop('checked',false); } 
if (cod_estado_mod_domicilio_y_estado_habilitado_producto_global=='1') { $('#cod_estado_mod_domicilio_y_estado_habilitado_producto_global').val('1'); $('#cod_estado_mod_domicilio_y_estado_habilitado_producto_global').prop('checked',true); } else { $('#cod_estado_mod_domicilio_y_estado_habilitado_producto_global').val('0'); $('#cod_estado_mod_domicilio_y_estado_habilitado_producto_global').prop('checked',false); } 
if (cod_estado_promocion_global=='1') { $('#cod_estado_promocion_global').val('1'); $('#cod_estado_promocion_global').prop('checked',true); } else { $('#cod_estado_promocion_global').val('0'); $('#cod_estado_promocion_global').prop('checked',false); } 
if (cod_estado_notificacion_alerta_correo_global=='1') { $('#cod_estado_notificacion_alerta_correo_global').val('1'); $('#cod_estado_notificacion_alerta_correo_global').prop('checked',true); } else { $('#cod_estado_notificacion_alerta_correo_global').val('0'); $('#cod_estado_notificacion_alerta_correo_global').prop('checked',false); } 
if (cod_estado_notificacion_alerta_correo_copia_seguridad_global=='1') { $('#cod_estado_notificacion_alerta_correo_copia_seguridad_global').val('1'); $('#cod_estado_notificacion_alerta_correo_copia_seguridad_global').prop('checked',true); } else { $('#cod_estado_notificacion_alerta_correo_copia_seguridad_global').val('0'); $('#cod_estado_notificacion_alerta_correo_copia_seguridad_global').prop('checked',false); } 
if (cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global=='1') { $('#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global').val('1'); $('#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global').prop('checked',true); } else { $('#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global').val('0'); $('#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global').prop('checked',false); } 
if (cod_estado_notificacion_alerta_correo_productos_a_vencer_global=='1') { $('#cod_estado_notificacion_alerta_correo_productos_a_vencer_global').val('1'); $('#cod_estado_notificacion_alerta_correo_productos_a_vencer_global').prop('checked',true); } else { $('#cod_estado_notificacion_alerta_correo_productos_a_vencer_global').val('0'); $('#cod_estado_notificacion_alerta_correo_productos_a_vencer_global').prop('checked',false); } 
if (cod_estado_notificacion_alerta_correo_productos_agotados_global=='1') { $('#cod_estado_notificacion_alerta_correo_productos_agotados_global').val('1'); $('#cod_estado_notificacion_alerta_correo_productos_agotados_global').prop('checked',true); } else { $('#cod_estado_notificacion_alerta_correo_productos_agotados_global').val('0'); $('#cod_estado_notificacion_alerta_correo_productos_agotados_global').prop('checked',false); } 
if (cod_estado_notificacion_alerta_correo_venta_diaria_global=='1') { $('#cod_estado_notificacion_alerta_correo_venta_diaria_global').val('1'); $('#cod_estado_notificacion_alerta_correo_venta_diaria_global').prop('checked',true); } else { $('#cod_estado_notificacion_alerta_correo_venta_diaria_global').val('0'); $('#cod_estado_notificacion_alerta_correo_venta_diaria_global').prop('checked',false); } 
if (cod_estado_venta_dependencia_de_usuario_global=='1') { $('#cod_estado_venta_dependencia_de_usuario_global').val('1'); $('#cod_estado_venta_dependencia_de_usuario_global').prop('checked',true); } else { $('#cod_estado_venta_dependencia_de_usuario_global').val('0'); $('#cod_estado_venta_dependencia_de_usuario_global').prop('checked',false); } 
if (cod_estado_posicion_mapa_gps_pedidos_info_venta_global=='1') { $('#cod_estado_posicion_mapa_gps_pedidos_info_venta_global').val('1'); $('#cod_estado_posicion_mapa_gps_pedidos_info_venta_global').prop('checked',true); } else { $('#cod_estado_posicion_mapa_gps_pedidos_info_venta_global').val('0'); $('#cod_estado_posicion_mapa_gps_pedidos_info_venta_global').prop('checked',false); } 
if (cod_estado_origen_factura_compra_global=='1') { $('#cod_estado_origen_factura_compra_global').val('1'); $('#cod_estado_origen_factura_compra_global').prop('checked',true); } else { $('#cod_estado_origen_factura_compra_global').val('0'); $('#cod_estado_origen_factura_compra_global').prop('checked',false); } 
if (cod_estado_existe_producto_factura_compra_global=='1') { $('#cod_estado_existe_producto_factura_compra_global').val('1'); $('#cod_estado_existe_producto_factura_compra_global').prop('checked',true); } else { $('#cod_estado_existe_producto_factura_compra_global').val('0'); $('#cod_estado_existe_producto_factura_compra_global').prop('checked',false); } 
if (cod_estado_chk_factura_compra_global=='1') { $('#cod_estado_chk_factura_compra_global').val('1'); $('#cod_estado_chk_factura_compra_global').prop('checked',true); } else { $('#cod_estado_chk_factura_compra_global').val('0'); $('#cod_estado_chk_factura_compra_global').prop('checked',false); } 
if (cod_estado_check_caja_factura_compra_global=='1') { $('#cod_estado_check_caja_factura_compra_global').val('1'); $('#cod_estado_check_caja_factura_compra_global').prop('checked',true); } else { $('#cod_estado_check_caja_factura_compra_global').val('0'); $('#cod_estado_check_caja_factura_compra_global').prop('checked',false); } 
if (cod_estado_check_und_factura_compra_global=='1') { $('#cod_estado_check_und_factura_compra_global').val('1'); $('#cod_estado_check_und_factura_compra_global').prop('checked',true); } else { $('#cod_estado_check_und_factura_compra_global').val('0'); $('#cod_estado_check_und_factura_compra_global').prop('checked',false); } 
if (cod_estado_peso_global=='1') { $('#cod_estado_peso_global').val('1'); $('#cod_estado_peso_global').prop('checked',true); } else { $('#cod_estado_peso_global').val('0'); $('#cod_estado_peso_global').prop('checked',false); } 
if (cod_estado_cargar_archivo_plano_interno_factura_compra_global=='1') { $('#cod_estado_cargar_archivo_plano_interno_factura_compra_global').val('1'); $('#cod_estado_cargar_archivo_plano_interno_factura_compra_global').prop('checked',true); } else { $('#cod_estado_cargar_archivo_plano_interno_factura_compra_global').val('0'); $('#cod_estado_cargar_archivo_plano_interno_factura_compra_global').prop('checked',false); } 
if (cod_estado_cargar_archivo_plano_externo_factura_compra_global=='1') { $('#cod_estado_cargar_archivo_plano_externo_factura_compra_global').val('1'); $('#cod_estado_cargar_archivo_plano_externo_factura_compra_global').prop('checked',true); } else { $('#cod_estado_cargar_archivo_plano_externo_factura_compra_global').val('0'); $('#cod_estado_cargar_archivo_plano_externo_factura_compra_global').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_abono_glob_global=='1') { $('#cod_estado_cuenta_cobrar_abono_glob_global').val('1'); $('#cod_estado_cuenta_cobrar_abono_glob_global').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_abono_glob_global').val('0'); $('#cod_estado_cuenta_cobrar_abono_glob_global').prop('checked',false); } 
if (cod_estado_reporte_compra_por_producto_global=='1') { $('#cod_estado_reporte_compra_por_producto_global').val('1'); $('#cod_estado_reporte_compra_por_producto_global').prop('checked',true); } else { $('#cod_estado_reporte_compra_por_producto_global').val('0'); $('#cod_estado_reporte_compra_por_producto_global').prop('checked',false); } 
if (cod_estado_servicio_cava_global=='1') { $('#cod_estado_servicio_cava_global').val('1'); $('#cod_estado_servicio_cava_global').prop('checked',true); } else { $('#cod_estado_servicio_cava_global').val('0'); $('#cod_estado_servicio_cava_global').prop('checked',false); } 
if (cod_estado_escoger_precio_venta_automatico_global=='1') { $('#cod_estado_escoger_precio_venta_automatico_global').val('1'); $('#cod_estado_escoger_precio_venta_automatico_global').prop('checked',true); } else { $('#cod_estado_escoger_precio_venta_automatico_global').val('0'); $('#cod_estado_escoger_precio_venta_automatico_global').prop('checked',false); } 
if (cod_estado_origen_produccion_global=='1') { $('#cod_estado_origen_produccion_global').val('1'); $('#cod_estado_origen_produccion_global').prop('checked',true); } else { $('#cod_estado_origen_produccion_global').val('0'); $('#cod_estado_origen_produccion_global').prop('checked',false); } 
if (cod_estado_imprimir_reporte_venta_con_productos_global=='1') { $('#cod_estado_imprimir_reporte_venta_con_productos_global').val('1'); $('#cod_estado_imprimir_reporte_venta_con_productos_global').prop('checked',true); } else { $('#cod_estado_imprimir_reporte_venta_con_productos_global').val('0'); $('#cod_estado_imprimir_reporte_venta_con_productos_global').prop('checked',false); } 
if (cod_estado_factura_compra_cargue_inmediato_global=='1') { $('#cod_estado_factura_compra_cargue_inmediato_global').val('1'); $('#cod_estado_factura_compra_cargue_inmediato_global').prop('checked',true); } else { $('#cod_estado_factura_compra_cargue_inmediato_global').val('0'); $('#cod_estado_factura_compra_cargue_inmediato_global').prop('checked',false); } 
if (cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global=='1') { $('#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global').val('1'); $('#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global').prop('checked',true); } else { $('#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global').val('0'); $('#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global').prop('checked',false); } 
if (cod_estado_actualizar_base_datos_arch_plano_global=='1') { $('#cod_estado_actualizar_base_datos_arch_plano_global').val('1'); $('#cod_estado_actualizar_base_datos_arch_plano_global').prop('checked',true); } else { $('#cod_estado_actualizar_base_datos_arch_plano_global').val('0'); $('#cod_estado_actualizar_base_datos_arch_plano_global').prop('checked',false); } 
if (cod_estado_actualizar_base_datos_arch_plano_producto_global=='1') { $('#cod_estado_actualizar_base_datos_arch_plano_producto_global').val('1'); $('#cod_estado_actualizar_base_datos_arch_plano_producto_global').prop('checked',true); } else { $('#cod_estado_actualizar_base_datos_arch_plano_producto_global').val('0'); $('#cod_estado_actualizar_base_datos_arch_plano_producto_global').prop('checked',false); } 
if (cod_estado_actualizar_base_datos_arch_plano_venta_global=='1') { $('#cod_estado_actualizar_base_datos_arch_plano_venta_global').val('1'); $('#cod_estado_actualizar_base_datos_arch_plano_venta_global').prop('checked',true); } else { $('#cod_estado_actualizar_base_datos_arch_plano_venta_global').val('0'); $('#cod_estado_actualizar_base_datos_arch_plano_venta_global').prop('checked',false); } 
if (cod_estado_actualizar_base_datos_arch_plano_info_venta_global=='1') { $('#cod_estado_actualizar_base_datos_arch_plano_info_venta_global').val('1'); $('#cod_estado_actualizar_base_datos_arch_plano_info_venta_global').prop('checked',true); } else { $('#cod_estado_actualizar_base_datos_arch_plano_info_venta_global').val('0'); $('#cod_estado_actualizar_base_datos_arch_plano_info_venta_global').prop('checked',false); } 
if (cod_estado_actualizar_base_datos_arch_plano_compra_global=='1') { $('#cod_estado_actualizar_base_datos_arch_plano_compra_global').val('1'); $('#cod_estado_actualizar_base_datos_arch_plano_compra_global').prop('checked',true); } else { $('#cod_estado_actualizar_base_datos_arch_plano_compra_global').val('0'); $('#cod_estado_actualizar_base_datos_arch_plano_compra_global').prop('checked',false); } 
if (cod_estado_actualizar_base_datos_arch_plano_info_compra_global=='1') { $('#cod_estado_actualizar_base_datos_arch_plano_info_compra_global').val('1'); $('#cod_estado_actualizar_base_datos_arch_plano_info_compra_global').prop('checked',true); } else { $('#cod_estado_actualizar_base_datos_arch_plano_info_compra_global').val('0'); $('#cod_estado_actualizar_base_datos_arch_plano_info_compra_global').prop('checked',false); } 
if (cod_estado_actualizar_und_producto_inventario_global=='1') { $('#cod_estado_actualizar_und_producto_inventario_global').val('1'); $('#cod_estado_actualizar_und_producto_inventario_global').prop('checked',true); } else { $('#cod_estado_actualizar_und_producto_inventario_global').val('0'); $('#cod_estado_actualizar_und_producto_inventario_global').prop('checked',false); } 
if (cod_estado_tipo_venta_zapateria_global=='1') { $('#cod_estado_tipo_venta_zapateria_global').val('1'); $('#cod_estado_tipo_venta_zapateria_global').prop('checked',true); } else { $('#cod_estado_tipo_venta_zapateria_global').val('0'); $('#cod_estado_tipo_venta_zapateria_global').prop('checked',false); } 
if (cod_estado_opcion_escribir_nombre_cliente_venta_global=='1') { $('#cod_estado_opcion_escribir_nombre_cliente_venta_global').val('1'); $('#cod_estado_opcion_escribir_nombre_cliente_venta_global').prop('checked',true); } else { $('#cod_estado_opcion_escribir_nombre_cliente_venta_global').val('0'); $('#cod_estado_opcion_escribir_nombre_cliente_venta_global').prop('checked',false); } 
if (cod_estado_btn_imprimir_venta_nav_zapateria_global=='1') { $('#cod_estado_btn_imprimir_venta_nav_zapateria_global').val('1'); $('#cod_estado_btn_imprimir_venta_nav_zapateria_global').prop('checked',true); } else { $('#cod_estado_btn_imprimir_venta_nav_zapateria_global').val('0'); $('#cod_estado_btn_imprimir_venta_nav_zapateria_global').prop('checked',false); } 
if (cod_estado_btn_imprimir_venta_direct_driv_zapateria_global=='1') { $('#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global').val('1'); $('#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global').prop('checked',true); } else { $('#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global').val('0'); $('#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global').prop('checked',false); } 
if (cod_estado_fecha_entrega_venta_global=='1') { $('#cod_estado_fecha_entrega_venta_global').val('1'); $('#cod_estado_fecha_entrega_venta_global').prop('checked',true); } else { $('#cod_estado_fecha_entrega_venta_global').val('0'); $('#cod_estado_fecha_entrega_venta_global').prop('checked',false); } 
if (cod_estado_hora_entrega_venta_global=='1') { $('#cod_estado_hora_entrega_venta_global').val('1'); $('#cod_estado_hora_entrega_venta_global').prop('checked',true); } else { $('#cod_estado_hora_entrega_venta_global').val('0'); $('#cod_estado_hora_entrega_venta_global').prop('checked',false); } 
if (cod_estado_productos_poco_movimiento_global=='1') { $('#cod_estado_productos_poco_movimiento_global').val('1'); $('#cod_estado_productos_poco_movimiento_global').prop('checked',true); } else { $('#cod_estado_productos_poco_movimiento_global').val('0'); $('#cod_estado_productos_poco_movimiento_global').prop('checked',false); } 
if (cod_estado_nuevo_inventario_por_letra_global=='1') { $('#cod_estado_nuevo_inventario_por_letra_global').val('1'); $('#cod_estado_nuevo_inventario_por_letra_global').prop('checked',true); } else { $('#cod_estado_nuevo_inventario_por_letra_global').val('0'); $('#cod_estado_nuevo_inventario_por_letra_global').prop('checked',false); } 
if (cod_estado_filtro_aplicacion_chef_bartender_global=='1') { $('#cod_estado_filtro_aplicacion_chef_bartender_global').val('1'); $('#cod_estado_filtro_aplicacion_chef_bartender_global').prop('checked',true); } else { $('#cod_estado_filtro_aplicacion_chef_bartender_global').val('0'); $('#cod_estado_filtro_aplicacion_chef_bartender_global').prop('checked',false); } 
if (cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global=='1') { $('#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global').val('1'); $('#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global').prop('checked',true); } else { $('#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global').val('0'); $('#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global').prop('checked',false); } 
if (cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global=='1') { $('#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global').val('1'); $('#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global').prop('checked',true); } else { $('#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global').val('0'); $('#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global').prop('checked',false); } 
if (cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global=='1') { $('#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global').val('1'); $('#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global').prop('checked',true); } else { $('#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global').val('0'); $('#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global').prop('checked',false); } 
if (cod_estado_reporte_mantenimiento_global=='1') { $('#cod_estado_reporte_mantenimiento_global').val('1'); $('#cod_estado_reporte_mantenimiento_global').prop('checked',true); } else { $('#cod_estado_reporte_mantenimiento_global').val('0'); $('#cod_estado_reporte_mantenimiento_global').prop('checked',false); } 
if (cod_estado_abrir_cajon_monedero_driv_direct_global=='1') { $('#cod_estado_abrir_cajon_monedero_driv_direct_global').val('1'); $('#cod_estado_abrir_cajon_monedero_driv_direct_global').prop('checked',true); } else { $('#cod_estado_abrir_cajon_monedero_driv_direct_global').val('0'); $('#cod_estado_abrir_cajon_monedero_driv_direct_global').prop('checked',false); } 
if (cod_estado_subreporte_venta_diaria_global=='1') { $('#cod_estado_subreporte_venta_diaria_global').val('1'); $('#cod_estado_subreporte_venta_diaria_global').prop('checked',true); } else { $('#cod_estado_subreporte_venta_diaria_global').val('0'); $('#cod_estado_subreporte_venta_diaria_global').prop('checked',false); } 
if (cod_estado_subreporte_venta_mensual_global=='1') { $('#cod_estado_subreporte_venta_mensual_global').val('1'); $('#cod_estado_subreporte_venta_mensual_global').prop('checked',true); } else { $('#cod_estado_subreporte_venta_mensual_global').val('0'); $('#cod_estado_subreporte_venta_mensual_global').prop('checked',false); } 
if (cod_estado_subreporte_venta_anual_global=='1') { $('#cod_estado_subreporte_venta_anual_global').val('1'); $('#cod_estado_subreporte_venta_anual_global').prop('checked',true); } else { $('#cod_estado_subreporte_venta_anual_global').val('0'); $('#cod_estado_subreporte_venta_anual_global').prop('checked',false); } 
if (cod_estado_subreporte_totalventa_global=='1') { $('#cod_estado_subreporte_totalventa_global').val('1'); $('#cod_estado_subreporte_totalventa_global').prop('checked',true); } else { $('#cod_estado_subreporte_totalventa_global').val('0'); $('#cod_estado_subreporte_totalventa_global').prop('checked',false); } 
if (cod_estado_subreporte_impuestos_global=='1') { $('#cod_estado_subreporte_impuestos_global').val('1'); $('#cod_estado_subreporte_impuestos_global').prop('checked',true); } else { $('#cod_estado_subreporte_impuestos_global').val('0'); $('#cod_estado_subreporte_impuestos_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasgenerales_global=='1') { $('#cod_estado_subreporte_ventasgenerales_global').val('1'); $('#cod_estado_subreporte_ventasgenerales_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasgenerales_global').val('0'); $('#cod_estado_subreporte_ventasgenerales_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasporfacturas_global=='1') { $('#cod_estado_subreporte_ventasporfacturas_global').val('1'); $('#cod_estado_subreporte_ventasporfacturas_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasporfacturas_global').val('0'); $('#cod_estado_subreporte_ventasporfacturas_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasportipofacturas_global=='1') { $('#cod_estado_subreporte_ventasportipofacturas_global').val('1'); $('#cod_estado_subreporte_ventasportipofacturas_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasportipofacturas_global').val('0'); $('#cod_estado_subreporte_ventasportipofacturas_global').prop('checked',false); } 
if (cod_estado_subreporte_ventaspordependencia_global=='1') { $('#cod_estado_subreporte_ventaspordependencia_global').val('1'); $('#cod_estado_subreporte_ventaspordependencia_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventaspordependencia_global').val('0'); $('#cod_estado_subreporte_ventaspordependencia_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasportipoproducto_global=='1') { $('#cod_estado_subreporte_ventasportipoproducto_global').val('1'); $('#cod_estado_subreporte_ventasportipoproducto_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasportipoproducto_global').val('0'); $('#cod_estado_subreporte_ventasportipoproducto_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasporvendedor_global=='1') { $('#cod_estado_subreporte_ventasporvendedor_global').val('1'); $('#cod_estado_subreporte_ventasporvendedor_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasporvendedor_global').val('0'); $('#cod_estado_subreporte_ventasporvendedor_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasporpropinavendedor_global=='1') { $('#cod_estado_subreporte_ventasporpropinavendedor_global').val('1'); $('#cod_estado_subreporte_ventasporpropinavendedor_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasporpropinavendedor_global').val('0'); $('#cod_estado_subreporte_ventasporpropinavendedor_global').prop('checked',false); } 
if (cod_estado_subreporte_ventasporcreditocliente_global=='1') { $('#cod_estado_subreporte_ventasporcreditocliente_global').val('1'); $('#cod_estado_subreporte_ventasporcreditocliente_global').prop('checked',true); } else { $('#cod_estado_subreporte_ventasporcreditocliente_global').val('0'); $('#cod_estado_subreporte_ventasporcreditocliente_global').prop('checked',false); } 
if (cod_estado_dependencia_sub_global=='1') { $('#cod_estado_dependencia_sub_global').val('1'); $('#cod_estado_dependencia_sub_global').prop('checked',true); } else { $('#cod_estado_dependencia_sub_global').val('0'); $('#cod_estado_dependencia_sub_global').prop('checked',false); } 
if (cod_estado_factura_compra_producto_global=='1') { $('#cod_estado_factura_compra_producto_global').val('1'); $('#cod_estado_factura_compra_producto_global').prop('checked',true); } else { $('#cod_estado_factura_compra_producto_global').val('0'); $('#cod_estado_factura_compra_producto_global').prop('checked',false); } 
if (cod_estado_aceite_oleina_global=='1') { $('#cod_estado_aceite_oleina_global').val('1'); $('#cod_estado_aceite_oleina_global').prop('checked',true); } else { $('#cod_estado_aceite_oleina_global').val('0'); $('#cod_estado_aceite_oleina_global').prop('checked',false); } 
if (cod_estado_valor_flete_aceite_oleina_global=='1') { $('#cod_estado_valor_flete_aceite_oleina_global').val('1'); $('#cod_estado_valor_flete_aceite_oleina_global').prop('checked',true); } else { $('#cod_estado_valor_flete_aceite_oleina_global').val('0'); $('#cod_estado_valor_flete_aceite_oleina_global').prop('checked',false); } 
if (cod_estado_caja_fraccion_global=='1') { $('#cod_estado_caja_fraccion_global').val('1'); $('#cod_estado_caja_fraccion_global').prop('checked',true); } else { $('#cod_estado_caja_fraccion_global').val('0'); $('#cod_estado_caja_fraccion_global').prop('checked',false); } 





$("#cod_estado_modulo_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_producto_global").val("1"); } else { $("#cod_estado_modulo_producto_global").val("0"); } });
$("#cod_estado_modulo_facturacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_facturacion_global").val("1"); } else { $("#cod_estado_modulo_facturacion_global").val("0"); } });
$("#cod_estado_modulo_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_venta_global").val("1"); } else { $("#cod_estado_modulo_venta_global").val("0"); } });
$("#cod_estado_modulo_tercero_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_tercero_global").val("1"); } else { $("#cod_estado_modulo_tercero_global").val("0"); } });
$("#cod_estado_modulo_cuenta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cuenta_global").val("1"); } else { $("#cod_estado_modulo_cuenta_global").val("0"); } });
$("#cod_estado_modulo_reporte_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_reporte_global").val("1"); } else { $("#cod_estado_modulo_reporte_global").val("0"); } });
$("#cod_estado_modulo_admin_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_admin_global").val("1"); } else { $("#cod_estado_modulo_admin_global").val("0"); } });
$("#cod_estado_mov_contable_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_mov_contable_global").val("1"); } else { $("#cod_estado_mov_contable_global").val("0"); } });
$("#cod_estado_pyg_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_pyg_global").val("1"); } else { $("#cod_estado_pyg_global").val("0"); } });
$("#cod_estado_balance_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_balance_global").val("1"); } else { $("#cod_estado_balance_global").val("0"); } });
$("#cod_estado_ganancia_ptj_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ganancia_ptj_global").val("1"); } else { $("#cod_estado_ganancia_ptj_global").val("0"); } });
$("#cod_estado_modulo_orden_produccion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_orden_produccion_global").val("1"); } else { $("#cod_estado_modulo_orden_produccion_global").val("0"); } });
$("#cod_estado_comentario_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_comentario_venta_global").val("1"); } else { $("#cod_estado_comentario_venta_global").val("0"); } });
$("#cod_estado_envio_sms_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_sms_global").val("1"); } else { $("#cod_estado_envio_sms_global").val("0"); } });
$("#cod_estado_envio_correo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_correo_global").val("1"); } else { $("#cod_estado_envio_correo_global").val("0"); } });
$("#cod_estado_fecha_vencimiento_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_fecha_vencimiento_global").val("1"); } else { $("#cod_estado_fecha_vencimiento_global").val("0"); } });
$("#cod_estado_ptj_comision_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ptj_comision_global").val("1"); } else { $("#cod_estado_ptj_comision_global").val("0"); } });
$("#cod_estado_impoconsumo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_impoconsumo_global").val("1"); } else { $("#cod_estado_impoconsumo_global").val("0"); } });
$("#cod_estado_dto1_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dto1_global").val("1"); } else { $("#cod_estado_dto1_global").val("0"); } });
$("#cod_estado_dto2_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dto2_global").val("1"); } else { $("#cod_estado_dto2_global").val("0"); } });
$("#cod_estado_producto_consumo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_consumo_global").val("1"); } else { $("#cod_estado_producto_consumo_global").val("0"); } });
$("#cod_estado_cuenta_cobrar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_cobrar_global").val("1"); } else { $("#cod_estado_cuenta_cobrar_global").val("0"); } });
$("#cod_estado_cuenta_pagar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_pagar_global").val("1"); } else { $("#cod_estado_cuenta_pagar_global").val("0"); } });
$("#cod_estado_egreso_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_egreso_global").val("1"); } else { $("#cod_estado_egreso_global").val("0"); } });
$("#cod_estado_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_global").val("1"); } else { $("#cod_estado_factura_compra_global").val("0"); } });
$("#cod_estado_cita_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cita_global").val("1"); } else { $("#cod_estado_cita_global").val("0"); } });
$("#cod_estado_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_usuario_global").val("1"); } else { $("#cod_estado_usuario_global").val("0"); } });
$("#cod_estado_dependencia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dependencia_global").val("1"); } else { $("#cod_estado_dependencia_global").val("0"); } });
$("#cod_estado_resolucion_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_resolucion_factura_global").val("1"); } else { $("#cod_estado_resolucion_factura_global").val("0"); } });
$("#cod_estado_numero_letra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_numero_letra_global").val("1"); } else { $("#cod_estado_numero_letra_global").val("0"); } });
$("#cod_estado_encuesta_experiencia_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_encuesta_experiencia_compra_global").val("1"); } else { $("#cod_estado_encuesta_experiencia_compra_global").val("0"); } });
$("#cod_estado_codif_precio_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_codif_precio_compra_global").val("1"); } else { $("#cod_estado_codif_precio_compra_global").val("0"); } });
$("#cod_estado_codif_precio_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_codif_precio_venta_global").val("1"); } else { $("#cod_estado_codif_precio_venta_global").val("0"); } });
$("#cod_estado_img_impimir_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_img_impimir_factura_global").val("1"); } else { $("#cod_estado_img_impimir_factura_global").val("0"); } });
$("#cod_estado_preventa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_preventa_global").val("1"); } else { $("#cod_estado_preventa_global").val("0"); } });
$("#cod_estado_propina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_propina_global").val("1"); } else { $("#cod_estado_propina_global").val("0"); } });
$("#cod_estado_inventario_bodega_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_inventario_bodega_global").val("1"); } else { $("#cod_estado_inventario_bodega_global").val("0"); } });
$("#cod_estado_modulo_contabilidad_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_contabilidad_global").val("1"); } else { $("#cod_estado_modulo_contabilidad_global").val("0"); } });
$("#cod_estado_modulo_cotizacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cotizacion_global").val("1"); } else { $("#cod_estado_modulo_cotizacion_global").val("0"); } });
$("#cod_estado_compra_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_compra_caja_global").val("1"); } else { $("#cod_estado_compra_caja_global").val("0"); } });
$("#cod_estado_sticker_barras_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_sticker_barras_global").val("1"); } else { $("#cod_estado_sticker_barras_global").val("0"); } });
$("#cod_estado_modulo_cotizacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cotizacion_global").val("1"); } else { $("#cod_estado_modulo_cotizacion_global").val("0"); } });
$("#cod_estado_producto_consumo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_consumo_global").val("1"); } else { $("#cod_estado_producto_consumo_global").val("0"); } });
$("#cod_estado_compra_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_compra_caja_global").val("1"); } else { $("#cod_estado_compra_caja_global").val("0"); } });
$("#cod_estado_cuenta_cobrar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_cobrar_global").val("1"); } else { $("#cod_estado_cuenta_cobrar_global").val("0"); } });
$("#cod_estado_cuenta_pagar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_pagar_global").val("1"); } else { $("#cod_estado_cuenta_pagar_global").val("0"); } });
$("#cod_estado_egreso_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_egreso_global").val("1"); } else { $("#cod_estado_egreso_global").val("0"); } });
$("#cod_estado_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_usuario_global").val("1"); } else { $("#cod_estado_usuario_global").val("0"); } });
$("#cod_estado_dependencia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dependencia_global").val("1"); } else { $("#cod_estado_dependencia_global").val("0"); } });
$("#cod_estado_numero_letra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_numero_letra_global").val("1"); } else { $("#cod_estado_numero_letra_global").val("0"); } });
$("#cod_estado_resolucion_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_resolucion_factura_global").val("1"); } else { $("#cod_estado_resolucion_factura_global").val("0"); } });
$("#cod_estado_cita_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cita_global").val("1"); } else { $("#cod_estado_cita_global").val("0"); } });
$("#cod_estado_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_global").val("1"); } else { $("#cod_estado_factura_compra_global").val("0"); } });
$("#cod_estado_modulo_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_producto_global").val("1"); } else { $("#cod_estado_modulo_producto_global").val("0"); } });
$("#cod_estado_modulo_facturacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_facturacion_global").val("1"); } else { $("#cod_estado_modulo_facturacion_global").val("0"); } });
$("#cod_estado_modulo_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_venta_global").val("1"); } else { $("#cod_estado_modulo_venta_global").val("0"); } });
$("#cod_estado_modulo_tercero_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_tercero_global").val("1"); } else { $("#cod_estado_modulo_tercero_global").val("0"); } });
$("#cod_estado_modulo_cuenta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cuenta_global").val("1"); } else { $("#cod_estado_modulo_cuenta_global").val("0"); } });
$("#cod_estado_modulo_reporte_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_reporte_global").val("1"); } else { $("#cod_estado_modulo_reporte_global").val("0"); } });
$("#cod_estado_modulo_admin_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_admin_global").val("1"); } else { $("#cod_estado_modulo_admin_global").val("0"); } });
$("#cod_estado_pyg_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_pyg_global").val("1"); } else { $("#cod_estado_pyg_global").val("0"); } });
$("#cod_estado_balance_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_balance_global").val("1"); } else { $("#cod_estado_balance_global").val("0"); } });
$("#cod_estado_ganancia_ptj_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ganancia_ptj_global").val("1"); } else { $("#cod_estado_ganancia_ptj_global").val("0"); } });
$("#cod_estado_modulo_orden_produccion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_orden_produccion_global").val("1"); } else { $("#cod_estado_modulo_orden_produccion_global").val("0"); } });
$("#cod_estado_comentario_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_comentario_venta_global").val("1"); } else { $("#cod_estado_comentario_venta_global").val("0"); } });
$("#cod_estado_envio_sms_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_sms_global").val("1"); } else { $("#cod_estado_envio_sms_global").val("0"); } });
$("#cod_estado_envio_correo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_correo_global").val("1"); } else { $("#cod_estado_envio_correo_global").val("0"); } });
$("#cod_estado_ordenamiento_alfabetico_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ordenamiento_alfabetico_venta_global").val("1"); } else { $("#cod_estado_ordenamiento_alfabetico_venta_global").val("0"); } });
$("#cod_estado_nocodif_precio_compra_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nocodif_precio_compra_sticker_global").val("1"); } else { $("#cod_estado_nocodif_precio_compra_sticker_global").val("0"); } });
$("#cod_estado_nocodif_precio_venta_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nocodif_precio_venta_sticker_global").val("1"); } else { $("#cod_estado_nocodif_precio_venta_sticker_global").val("0"); } });
$("#cod_estado_nombre_empresa_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nombre_empresa_sticker_global").val("1"); } else { $("#cod_estado_nombre_empresa_sticker_global").val("0"); } });
$("#cod_estado_fecha_compra_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_fecha_compra_sticker_global").val("1"); } else { $("#cod_estado_fecha_compra_sticker_global").val("0"); } });
$("#cod_estado_cod_tercero_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cod_tercero_sticker_global").val("1"); } else { $("#cod_estado_cod_tercero_sticker_global").val("0"); } });
$("#cod_estado_url_pagina_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_url_pagina_sticker_global").val("1"); } else { $("#cod_estado_url_pagina_sticker_global").val("0"); } });
$("#cod_estado_nombre_desarrollador_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nombre_desarrollador_sticker_global").val("1"); } else { $("#cod_estado_nombre_desarrollador_sticker_global").val("0"); } });
$("#cod_estado_qr_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_qr_sticker_global").val("1"); } else { $("#cod_estado_qr_sticker_global").val("0"); } });
$("#cod_estado_habilitar_tercero_por_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_tercero_por_usuario_global").val("1"); } else { $("#cod_estado_habilitar_tercero_por_usuario_global").val("0"); } });
$("#cod_estado_subproducto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subproducto_global").val("1"); } else { $("#cod_estado_subproducto_global").val("0"); } });
$("#cod_estado_nuevo_inventario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nuevo_inventario_global").val("1"); } else { $("#cod_estado_nuevo_inventario_global").val("0"); } });
$("#cod_estado_auditoria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_auditoria_global").val("1"); } else { $("#cod_estado_auditoria_global").val("0"); } });
$("#cod_estado_cierre_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cierre_caja_global").val("1"); } else { $("#cod_estado_cierre_caja_global").val("0"); } });
$("#cod_estado_fecha_mantenimiento_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_fecha_mantenimiento_global").val("1"); } else { $("#cod_estado_fecha_mantenimiento_global").val("0"); } });
$("#cod_estado_animal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_animal_global").val("1"); } else { $("#cod_estado_animal_global").val("0"); } });
$("#cod_estado_producto_serial_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_serial_global").val("1"); } else { $("#cod_estado_producto_serial_global").val("0"); } });
$("#cod_estado_venta_prod_en_cero_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_venta_prod_en_cero_global").val("1"); } else { $("#cod_estado_venta_prod_en_cero_global").val("0"); } });
$("#cod_estado_observacion_tercero_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_observacion_tercero_venta_global").val("1"); } else { $("#cod_estado_observacion_tercero_venta_global").val("0"); } });
$("#cod_estado_alerta_fecha_nac_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_alerta_fecha_nac_global").val("1"); } else { $("#cod_estado_alerta_fecha_nac_global").val("0"); } });
$("#cod_estado_categoria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_categoria_global").val("1"); } else { $("#cod_estado_categoria_global").val("0"); } });
$("#cod_estado_peso_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_peso_producto_global").val("1"); } else { $("#cod_estado_peso_producto_global").val("0"); } });
$("#cod_estado_estante_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_estante_producto_global").val("1"); } else { $("#cod_estado_estante_producto_global").val("0"); } });
$("#cod_estado_devolucion_btn_verde_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_devolucion_btn_verde_global").val("1"); } else { $("#cod_estado_devolucion_btn_verde_global").val("0"); } });
$("#cod_estado_plan_separe_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_plan_separe_global").val("1"); } else { $("#cod_estado_plan_separe_global").val("0"); } });
$("#cod_estado_admin_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_admin_global").val("1"); } else { $("#cod_estado_admin_global").val("0"); } });
$("#cod_estado_prodcuto_mantenimiento_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_prodcuto_mantenimiento_global").val("1"); } else { $("#cod_estado_prodcuto_mantenimiento_global").val("0"); } });
$("#cod_estado_eliminar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_eliminar_global").val("1"); } else { $("#cod_estado_eliminar_global").val("0"); } });
$("#cod_estado_soporte_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_soporte_factura_compra_global").val("1"); } else { $("#cod_estado_soporte_factura_compra_global").val("0"); } });
$("#cod_estado_observacion_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_observacion_factura_compra_global").val("1"); } else { $("#cod_estado_observacion_factura_compra_global").val("0"); } });
$("#cod_estado_venta_precio_min_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_venta_precio_min_venta_global").val("1"); } else { $("#cod_estado_venta_precio_min_venta_global").val("0"); } });
$("#cod_estado_hotel_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_hotel_global").val("1"); } else { $("#cod_estado_hotel_global").val("0"); } });
$("#cod_estado_parqueo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_parqueo_global").val("1"); } else { $("#cod_estado_parqueo_global").val("0"); } });
$("#cod_estado_plan_accion_correcion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_plan_accion_correcion_global").val("1"); } else { $("#cod_estado_plan_accion_correcion_global").val("0"); } });
$("#cod_estado_cocina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cocina_global").val("1"); } else { $("#cod_estado_cocina_global").val("0"); } });
$("#cod_estado_cajas_sobre_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cajas_sobre_global").val("1"); } else { $("#cod_estado_cajas_sobre_global").val("0"); } });
$("#cod_estado_und_sobre_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_und_sobre_global").val("1"); } else { $("#cod_estado_und_sobre_global").val("0"); } });
$("#cod_estado_meses_garantia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_meses_garantia_global").val("1"); } else { $("#cod_estado_meses_garantia_global").val("0"); } });
$("#cod_estado_marca_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_marca_global").val("1"); } else { $("#cod_estado_marca_global").val("0"); } });
$("#cod_estado_proveedor_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_proveedor_global").val("1"); } else { $("#cod_estado_proveedor_global").val("0"); } });
$("#cod_estado_archivo_adjunto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_archivo_adjunto_global").val("1"); } else { $("#cod_estado_archivo_adjunto_global").val("0"); } });
$("#cod_estado_precio_compra_mod_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_precio_compra_mod_venta_global").val("1"); } else { $("#cod_estado_precio_compra_mod_venta_global").val("0"); } });
$("#cod_estado_timbre_entrada_pedido_temporal_cocina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_timbre_entrada_pedido_temporal_cocina_global").val("1"); } else { $("#cod_estado_timbre_entrada_pedido_temporal_cocina_global").val("0"); } });
$("#cod_estado_timbre_salida_pedido_temporal_cocina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_timbre_salida_pedido_temporal_cocina_global").val("1"); } else { $("#cod_estado_timbre_salida_pedido_temporal_cocina_global").val("0"); } });
$("#cod_estado_subproducto_mostrar_imprimir_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subproducto_mostrar_imprimir_global").val("1"); } else { $("#cod_estado_subproducto_mostrar_imprimir_global").val("0"); } });
$("#cod_estado_img_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_img_producto_global").val("1"); } else { $("#cod_estado_img_producto_global").val("0"); } });
$("#cod_estado_diferencia_ganancia_inventario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_diferencia_ganancia_inventario_global").val("1"); } else { $("#cod_estado_diferencia_ganancia_inventario_global").val("0"); } });
$("#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global").val("1"); } else { $("#cod_estado_diferencia_ganancia_inventario_ptj_promedio_global").val("0"); } });
$("#cod_estado_opcion_descontable_inv_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_opcion_descontable_inv_global").val("1"); } else { $("#cod_estado_opcion_descontable_inv_global").val("0"); } });
$("#cod_estado_hora_reporte_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_hora_reporte_venta_global").val("1"); } else { $("#cod_estado_hora_reporte_venta_global").val("0"); } });
$("#cod_estado_cantidad_caja_mesa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cantidad_caja_mesa_global").val("1"); } else { $("#cod_estado_cantidad_caja_mesa_global").val("0"); } });
$("#cod_estado_venta_por_categoria_mod_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_venta_por_categoria_mod_venta_global").val("1"); } else { $("#cod_estado_venta_por_categoria_mod_venta_global").val("0"); } });
$("#cod_estado_habilitar_btn_facturar_mod_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_facturar_mod_venta_global").val("1"); } else { $("#cod_estado_habilitar_btn_facturar_mod_venta_global").val("0"); } });
$("#cod_estado_btn_imprimir_preventa_cocina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imprimir_preventa_cocina_global").val("1"); } else { $("#cod_estado_btn_imprimir_preventa_cocina_global").val("0"); } });
$("#cod_estado_producto_de_cocina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_de_cocina_global").val("1"); } else { $("#cod_estado_producto_de_cocina_global").val("0"); } });
$("#cod_estado_posicion_gps_pedidos_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_posicion_gps_pedidos_global").val("1"); } else { $("#cod_estado_posicion_gps_pedidos_global").val("0"); } });
$("#cod_estado_precio_venta_variable_disponible_admin_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_precio_venta_variable_disponible_admin_global").val("1"); } else { $("#cod_estado_precio_venta_variable_disponible_admin_global").val("0"); } });
$("#cod_estado_check_imp_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_check_imp_global").val("1"); } else { $("#cod_estado_check_imp_global").val("0"); } });
$("#cod_estado_dividir_factura_caja_mesa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dividir_factura_caja_mesa_global").val("1"); } else { $("#cod_estado_dividir_factura_caja_mesa_global").val("0"); } });
$("#cod_estado_agrupar_por_producto_imp_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_agrupar_por_producto_imp_global").val("1"); } else { $("#cod_estado_agrupar_por_producto_imp_global").val("0"); } });
$("#cod_estado_descuento_concepto_venta_neg_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_descuento_concepto_venta_neg_global").val("1"); } else { $("#cod_estado_descuento_concepto_venta_neg_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_venta_nav_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_venta_nav_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_venta_nav_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_venta_direct_driv_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_venta_direct_driv_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_venta_direct_driv_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_nav_carta_pdf_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_nav_carta_pdf_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_nav_carta_pdf_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_preventodo_nav_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_preventodo_nav_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_preventodo_nav_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_preventodo_direct_driv_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_cocina_nav_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_cocina_nav_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_cocina_nav_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_cocina_direct_driv_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_cocina_direct_driv_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_cocina_direct_driv_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_repventa_consol_nav_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_repventa_consol_nav_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_repventa_consol_nav_global").val("0"); } });
$("#cod_estado_habilitar_btn_imp_repventa_direct_driv_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_btn_imp_repventa_direct_driv_global").val("1"); } else { $("#cod_estado_habilitar_btn_imp_repventa_direct_driv_global").val("0"); } });
$("#cod_estado_modificar_und_venta_una_sola_vez_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modificar_und_venta_una_sola_vez_global").val("1"); } else { $("#cod_estado_modificar_und_venta_una_sola_vez_global").val("0"); } });
$("#cod_estado_habilitar_hora_venta_temporal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_hora_venta_temporal_global").val("1"); } else { $("#cod_estado_habilitar_hora_venta_temporal_global").val("0"); } });
$("#cod_estado_revisado_venta_temporal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_revisado_venta_temporal_global").val("1"); } else { $("#cod_estado_revisado_venta_temporal_global").val("0"); } });
$("#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global").val("1"); } else { $("#cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global").val("0"); } });
$("#cod_estado_prioridad_caja_mesa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_prioridad_caja_mesa_global").val("1"); } else { $("#cod_estado_prioridad_caja_mesa_global").val("0"); } });
$("#cod_estado_transferencia_empresa_extern_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_transferencia_empresa_extern_global").val("1"); } else { $("#cod_estado_transferencia_empresa_extern_global").val("0"); } });
$("#cod_estado_descuento_automatico_por_cambio_precio_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_descuento_automatico_por_cambio_precio_venta_global").val("1"); } else { $("#cod_estado_descuento_automatico_por_cambio_precio_venta_global").val("0"); } });
$("#cod_estado_btn_categoria_desplegable_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_categoria_desplegable_global").val("1"); } else { $("#cod_estado_btn_categoria_desplegable_global").val("0"); } });
$("#cod_estado_consultar_precios_extern_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_consultar_precios_extern_global").val("1"); } else { $("#cod_estado_consultar_precios_extern_global").val("0"); } });
$("#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global").val("1"); } else { $("#cod_estado_marcado_revisado_caja_mesa_venta_temporal_global").val("0"); } });
$("#cod_estado_nombre_producto_editable_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nombre_producto_editable_factura_compra_global").val("1"); } else { $("#cod_estado_nombre_producto_editable_factura_compra_global").val("0"); } });
$("#cod_estado_tipo_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_compra_global").val("1"); } else { $("#cod_estado_tipo_compra_global").val("0"); } });
$("#cod_estado_nota_observacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nota_observacion_global").val("1"); } else { $("#cod_estado_nota_observacion_global").val("0"); } });
$("#cod_estado_grafico_estadistico_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_grafico_estadistico_global").val("1"); } else { $("#cod_estado_grafico_estadistico_global").val("0"); } });
$("#cod_estado_inventario_bodega2_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_inventario_bodega2_global").val("1"); } else { $("#cod_estado_inventario_bodega2_global").val("0"); } });
$("#cod_estado_tipo_roles_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_roles_global").val("1"); } else { $("#cod_estado_tipo_roles_global").val("0"); } });
$("#cod_estado_bascula_balanza_electronica_pesar_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_bascula_balanza_electronica_pesar_producto_global").val("1"); } else { $("#cod_estado_bascula_balanza_electronica_pesar_producto_global").val("0"); } });
$("#cod_estado_bascula_balanza_cod_barras_pesar_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_bascula_balanza_cod_barras_pesar_producto_global").val("1"); } else { $("#cod_estado_bascula_balanza_cod_barras_pesar_producto_global").val("0"); } });
$("#cod_estado_lote_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_lote_compra_global").val("1"); } else { $("#cod_estado_lote_compra_global").val("0"); } });
$("#cod_estado_tipo_metodo_envio_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_metodo_envio_global").val("1"); } else { $("#cod_estado_tipo_metodo_envio_global").val("0"); } });
$("#cod_estado_mod_domicilio_y_estado_habilitado_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_mod_domicilio_y_estado_habilitado_producto_global").val("1"); } else { $("#cod_estado_mod_domicilio_y_estado_habilitado_producto_global").val("0"); } });
$("#cod_estado_promocion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_promocion_global").val("1"); } else { $("#cod_estado_promocion_global").val("0"); } });
$("#cod_estado_notificacion_alerta_correo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_notificacion_alerta_correo_global").val("1"); } else { $("#cod_estado_notificacion_alerta_correo_global").val("0"); } });
$("#cod_estado_notificacion_alerta_correo_copia_seguridad_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_notificacion_alerta_correo_copia_seguridad_global").val("1"); } else { $("#cod_estado_notificacion_alerta_correo_copia_seguridad_global").val("0"); } });
$("#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global").val("1"); } else { $("#cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global").val("0"); } });
$("#cod_estado_notificacion_alerta_correo_productos_a_vencer_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_notificacion_alerta_correo_productos_a_vencer_global").val("1"); } else { $("#cod_estado_notificacion_alerta_correo_productos_a_vencer_global").val("0"); } });
$("#cod_estado_notificacion_alerta_correo_productos_agotados_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_notificacion_alerta_correo_productos_agotados_global").val("1"); } else { $("#cod_estado_notificacion_alerta_correo_productos_agotados_global").val("0"); } });
$("#cod_estado_notificacion_alerta_correo_venta_diaria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_notificacion_alerta_correo_venta_diaria_global").val("1"); } else { $("#cod_estado_notificacion_alerta_correo_venta_diaria_global").val("0"); } });
$("#cod_estado_venta_dependencia_de_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_venta_dependencia_de_usuario_global").val("1"); } else { $("#cod_estado_venta_dependencia_de_usuario_global").val("0"); } });
$("#cod_estado_posicion_mapa_gps_pedidos_info_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_posicion_mapa_gps_pedidos_info_venta_global").val("1"); } else { $("#cod_estado_posicion_mapa_gps_pedidos_info_venta_global").val("0"); } });
$("#cod_estado_origen_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_origen_factura_compra_global").val("1"); } else { $("#cod_estado_origen_factura_compra_global").val("0"); } });
$("#cod_estado_existe_producto_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_existe_producto_factura_compra_global").val("1"); } else { $("#cod_estado_existe_producto_factura_compra_global").val("0"); } });
$("#cod_estado_chk_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_chk_factura_compra_global").val("1"); } else { $("#cod_estado_chk_factura_compra_global").val("0"); } });
$("#cod_estado_check_caja_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_check_caja_factura_compra_global").val("1"); } else { $("#cod_estado_check_caja_factura_compra_global").val("0"); } });
$("#cod_estado_check_und_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_check_und_factura_compra_global").val("1"); } else { $("#cod_estado_check_und_factura_compra_global").val("0"); } });
$("#cod_estado_peso_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_peso_global").val("1"); } else { $("#cod_estado_peso_global").val("0"); } });
$("#cod_estado_cargar_archivo_plano_interno_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cargar_archivo_plano_interno_factura_compra_global").val("1"); } else { $("#cod_estado_cargar_archivo_plano_interno_factura_compra_global").val("0"); } });
$("#cod_estado_cargar_archivo_plano_externo_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cargar_archivo_plano_externo_factura_compra_global").val("1"); } else { $("#cod_estado_cargar_archivo_plano_externo_factura_compra_global").val("0"); } });
$("#cod_estado_cuenta_cobrar_abono_glob_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_cobrar_abono_glob_global").val("1"); } else { $("#cod_estado_cuenta_cobrar_abono_glob_global").val("0"); } });
$("#cod_estado_reporte_compra_por_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reporte_compra_por_producto_global").val("1"); } else { $("#cod_estado_reporte_compra_por_producto_global").val("0"); } });
$("#cod_estado_servicio_cava_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_servicio_cava_global").val("1"); } else { $("#cod_estado_servicio_cava_global").val("0"); } });
$("#cod_estado_escoger_precio_venta_automatico_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_escoger_precio_venta_automatico_global").val("1"); } else { $("#cod_estado_escoger_precio_venta_automatico_global").val("0"); } });
$("#cod_estado_origen_produccion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_origen_produccion_global").val("1"); } else { $("#cod_estado_origen_produccion_global").val("0"); } });
$("#cod_estado_imprimir_reporte_venta_con_productos_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_imprimir_reporte_venta_con_productos_global").val("1"); } else { $("#cod_estado_imprimir_reporte_venta_con_productos_global").val("0"); } });
$("#cod_estado_factura_compra_cargue_inmediato_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_cargue_inmediato_global").val("1"); } else { $("#cod_estado_factura_compra_cargue_inmediato_global").val("0"); } });
$("#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global").val("1"); } else { $("#cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global").val("0"); } });
$("#cod_estado_actualizar_base_datos_arch_plano_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_base_datos_arch_plano_global").val("1"); } else { $("#cod_estado_actualizar_base_datos_arch_plano_global").val("0"); } });
$("#cod_estado_actualizar_base_datos_arch_plano_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_base_datos_arch_plano_producto_global").val("1"); } else { $("#cod_estado_actualizar_base_datos_arch_plano_producto_global").val("0"); } });
$("#cod_estado_actualizar_base_datos_arch_plano_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_base_datos_arch_plano_venta_global").val("1"); } else { $("#cod_estado_actualizar_base_datos_arch_plano_venta_global").val("0"); } });
$("#cod_estado_actualizar_base_datos_arch_plano_info_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_base_datos_arch_plano_info_venta_global").val("1"); } else { $("#cod_estado_actualizar_base_datos_arch_plano_info_venta_global").val("0"); } });
$("#cod_estado_actualizar_base_datos_arch_plano_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_base_datos_arch_plano_compra_global").val("1"); } else { $("#cod_estado_actualizar_base_datos_arch_plano_compra_global").val("0"); } });
$("#cod_estado_actualizar_base_datos_arch_plano_info_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_base_datos_arch_plano_info_compra_global").val("1"); } else { $("#cod_estado_actualizar_base_datos_arch_plano_info_compra_global").val("0"); } });
$("#cod_estado_actualizar_und_producto_inventario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_actualizar_und_producto_inventario_global").val("1"); } else { $("#cod_estado_actualizar_und_producto_inventario_global").val("0"); } });
$("#cod_estado_tipo_venta_zapateria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_venta_zapateria_global").val("1"); } else { $("#cod_estado_tipo_venta_zapateria_global").val("0"); } });
$("#cod_estado_opcion_escribir_nombre_cliente_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_opcion_escribir_nombre_cliente_venta_global").val("1"); } else { $("#cod_estado_opcion_escribir_nombre_cliente_venta_global").val("0"); } });
$("#cod_estado_btn_imprimir_venta_nav_zapateria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imprimir_venta_nav_zapateria_global").val("1"); } else { $("#cod_estado_btn_imprimir_venta_nav_zapateria_global").val("0"); } });
$("#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global").val("1"); } else { $("#cod_estado_btn_imprimir_venta_direct_driv_zapateria_global").val("0"); } });
$("#cod_estado_fecha_entrega_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_fecha_entrega_venta_global").val("1"); } else { $("#cod_estado_fecha_entrega_venta_global").val("0"); } });
$("#cod_estado_hora_entrega_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_hora_entrega_venta_global").val("1"); } else { $("#cod_estado_hora_entrega_venta_global").val("0"); } });
$("#cod_estado_productos_poco_movimiento_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_productos_poco_movimiento_global").val("1"); } else { $("#cod_estado_productos_poco_movimiento_global").val("0"); } });
$("#cod_estado_nuevo_inventario_por_letra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nuevo_inventario_por_letra_global").val("1"); } else { $("#cod_estado_nuevo_inventario_por_letra_global").val("0"); } });
$("#cod_estado_filtro_aplicacion_chef_bartender_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_filtro_aplicacion_chef_bartender_global").val("1"); } else { $("#cod_estado_filtro_aplicacion_chef_bartender_global").val("0"); } });
$("#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global").val("1"); } else { $("#cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global").val("0"); } });
$("#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global").val("1"); } else { $("#cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global").val("0"); } });
$("#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global").val("1"); } else { $("#cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global").val("0"); } });
$("#cod_estado_reporte_mantenimiento_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reporte_mantenimiento_global").val("1"); } else { $("#cod_estado_reporte_mantenimiento_global").val("0"); } });
$("#cod_estado_abrir_cajon_monedero_driv_direct_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_abrir_cajon_monedero_driv_direct_global").val("1"); } else { $("#cod_estado_abrir_cajon_monedero_driv_direct_global").val("0"); } });
$("#cod_estado_subreporte_venta_diaria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_venta_diaria_global").val("1"); } else { $("#cod_estado_subreporte_venta_diaria_global").val("0"); } });
$("#cod_estado_subreporte_venta_mensual_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_venta_mensual_global").val("1"); } else { $("#cod_estado_subreporte_venta_mensual_global").val("0"); } });
$("#cod_estado_subreporte_venta_anual_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_venta_anual_global").val("1"); } else { $("#cod_estado_subreporte_venta_anual_global").val("0"); } });
$("#cod_estado_subreporte_totalventa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_totalventa_global").val("1"); } else { $("#cod_estado_subreporte_totalventa_global").val("0"); } });
$("#cod_estado_subreporte_impuestos_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_impuestos_global").val("1"); } else { $("#cod_estado_subreporte_impuestos_global").val("0"); } });
$("#cod_estado_subreporte_ventasgenerales_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasgenerales_global").val("1"); } else { $("#cod_estado_subreporte_ventasgenerales_global").val("0"); } });
$("#cod_estado_subreporte_ventasporfacturas_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasporfacturas_global").val("1"); } else { $("#cod_estado_subreporte_ventasporfacturas_global").val("0"); } });
$("#cod_estado_subreporte_ventasportipofacturas_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasportipofacturas_global").val("1"); } else { $("#cod_estado_subreporte_ventasportipofacturas_global").val("0"); } });
$("#cod_estado_subreporte_ventaspordependencia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventaspordependencia_global").val("1"); } else { $("#cod_estado_subreporte_ventaspordependencia_global").val("0"); } });
$("#cod_estado_subreporte_ventasportipoproducto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasportipoproducto_global").val("1"); } else { $("#cod_estado_subreporte_ventasportipoproducto_global").val("0"); } });
$("#cod_estado_subreporte_ventasporvendedor_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasporvendedor_global").val("1"); } else { $("#cod_estado_subreporte_ventasporvendedor_global").val("0"); } });
$("#cod_estado_subreporte_ventasporpropinavendedor_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasporpropinavendedor_global").val("1"); } else { $("#cod_estado_subreporte_ventasporpropinavendedor_global").val("0"); } });
$("#cod_estado_subreporte_ventasporcreditocliente_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subreporte_ventasporcreditocliente_global").val("1"); } else { $("#cod_estado_subreporte_ventasporcreditocliente_global").val("0"); } });
$("#cod_estado_dependencia_sub_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dependencia_sub_global").val("1"); } else { $("#cod_estado_dependencia_sub_global").val("0"); } });
$("#cod_estado_factura_compra_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_producto_global").val("1"); } else { $("#cod_estado_factura_compra_producto_global").val("0"); } });
$("#cod_estado_aceite_oleina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_aceite_oleina_global").val("1"); } else { $("#cod_estado_aceite_oleina_global").val("0"); } });
$("#cod_estado_valor_flete_aceite_oleina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_valor_flete_aceite_oleina_global").val("1"); } else { $("#cod_estado_valor_flete_aceite_oleina_global").val("0"); } });
$("#cod_estado_caja_fraccion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_caja_fraccion_global").val("1"); } else { $("#cod_estado_caja_fraccion_global").val("0"); } });


});
</script>

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_empresa";
            var id = $(this).attr("class");;
            $.post("guardar_permisos_info_empresa_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>