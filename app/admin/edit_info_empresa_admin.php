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
$cod_info_empresa                 = intval($_GET['cod_info_empresa']);
$pagina                           = addslashes($_GET['pagina']);
$pagina_local                     = $_SERVER['PHP_SELF'];

$mostrar_datos_sql = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '$cod_info_empresa'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$titulo                                                            = $matriz_consulta['titulo'];
$nombre                                                            = $matriz_consulta['nombre'];
$eslogan                                                           = $matriz_consulta['eslogan'];
$direccion                                                         = $matriz_consulta['direccion'];
$ciudad                                                            = $matriz_consulta['ciudad'];
$pais                                                              = $matriz_consulta['pais'];
$correo                                                            = $matriz_consulta['correo'];
$img_cabecera                                                      = $matriz_consulta['img_cabecera'];
$telefono                                                          = $matriz_consulta['telefono'];
$info_legal                                                        = $matriz_consulta['info_legal'];
$logotipo                                                          = $matriz_consulta['logotipo'];
$propietario_nombres_apellidos                                     = $matriz_consulta['propietario_nombres_apellidos'];
$propietario_nit                                                   = $matriz_consulta['propietario_nit'];
$nit_empresa                                                       = $matriz_consulta['nit_empresa'];
$cabecera                                                          = $matriz_consulta['cabecera'];
$icono                                                             = $matriz_consulta['icono'];
$desarrollador                                                     = $matriz_consulta['desarrollador'];
$pag_desarrollador                                                 = $matriz_consulta['pag_desarrollador'];
$anyo                                                              = $matriz_consulta['anyo'];
$url_pag                                                           = $matriz_consulta['url_pag'];
$nombre_font                                                       = $matriz_consulta['nombre_font'];
$res                                                               = $matriz_consulta['res'];
$res1                                                              = $matriz_consulta['res1'];
$res2                                                              = $matriz_consulta['res2'];
$fecha_res                                                         = $matriz_consulta['fecha_res'];
$departamento                                                      = $matriz_consulta['departamento'];
$localidad                                                         = $matriz_consulta['localidad'];
$reg_medico                                                        = $matriz_consulta['reg_medico'];
$regimen                                                           = $matriz_consulta['regimen'];
$version                                                           = $matriz_consulta['version'];
$propietario_url_firma                                             = $matriz_consulta['propietario_url_firma'];
$fecha_time                                                        = $matriz_consulta['fecha_time'];
$licencia                                                          = $matriz_consulta['licencia'];
$tamano_font                                                       = $matriz_consulta['tamano_font'];
$info_histclinic                                                   = $matriz_consulta['info_histclinic'];
$info_aptlaboral                                                   = $matriz_consulta['info_aptlaboral'];
$dia_ini_facturacion                                               = $matriz_consulta['dia_ini_facturacion'];
$dia_fin_facturacion                                               = $matriz_consulta['dia_fin_facturacion'];
$smtp_correo_host                                                  = $matriz_consulta['smtp_correo_host'];
$smtp_correo_auth                                                  = $matriz_consulta['smtp_correo_auth'];
$smtp_correo_username                                              = $matriz_consulta['smtp_correo_username'];
$smtp_correo_password                                              = $matriz_consulta['smtp_correo_password'];
$smtp_correo_secure                                                = $matriz_consulta['smtp_correo_secure'];
$smtp_correo_port                                                  = $matriz_consulta['smtp_correo_port'];
$nombre_concepto_multi_virtual                                     = $matriz_consulta['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                                          = $matriz_consulta['nombre_tipo_precio_venta'];
$numero_precio                                                     = $matriz_consulta['numero_precio'];
$nombre_tipo_empresa                                               = $matriz_consulta['nombre_tipo_empresa'];

$limite_mostrar_producto_lista_caja_virtual                        = $matriz_consulta['limite_mostrar_producto_lista_caja_virtual'];

$ptj_servicio_propina                                              = $matriz_consulta['ptj_servicio_propina'];
$cod_servicio_propina                                              = $matriz_consulta['cod_servicio_propina'];
$nombre_servicio_propina                                           = $matriz_consulta['nombre_servicio_propina'];
$precio_servicio_propina                                           = $matriz_consulta['precio_servicio_propina'];
$ptj_bolsa                                                         = $matriz_consulta['ptj_bolsa'];
$cod_bolsa                                                         = $matriz_consulta['cod_bolsa'];
$nombre_bolsa                                                      = $matriz_consulta['nombre_bolsa'];
$precio_bolsa                                                      = $matriz_consulta['precio_bolsa'];

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

$cod_estado_nocodif_precio_compra_sticker_global                    = $matriz_consulta['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global                     = $matriz_consulta['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global                           = $matriz_consulta['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global                             = $matriz_consulta['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global                              = $matriz_consulta['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global                               = $matriz_consulta['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global                     = $matriz_consulta['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                                       = $matriz_consulta['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                                             = $matriz_consulta['nombre_empresa_sticker'];
$nombre_buscar_por                                                  = $matriz_consulta['nombre_buscar_por'];

$cod_estado_img_producto_global                                     = $matriz_consulta['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global                              = $matriz_consulta['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                                           = $matriz_consulta['cod_estado_animal_global'];
$cod_estado_producto_serial_global                                  = $matriz_consulta['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global                               = $matriz_consulta['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                                  = $matriz_consulta['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global                    = $matriz_consulta['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                                             = $matriz_consulta['nombre_tipo_componente'];
$cod_estado_subproducto_global                                      = $matriz_consulta['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                                 = $matriz_consulta['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                                        = $matriz_consulta['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                                      = $matriz_consulta['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global                        = $matriz_consulta['cod_estado_observacion_tercero_venta_global'];

$cod_estado_alerta_fecha_nac_global                                 = $matriz_consulta['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                        = $matriz_consulta['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                                    = $matriz_consulta['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                                 = $matriz_consulta['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                              = $matriz_consulta['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                             = $matriz_consulta['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                        = $matriz_consulta['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                                      = $matriz_consulta['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                            = $matriz_consulta['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                           = $matriz_consulta['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                         = $matriz_consulta['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                           = $matriz_consulta['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                       = $matriz_consulta['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                           = $matriz_consulta['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                          = $matriz_consulta['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                                      = $matriz_consulta['costo_parqueo'];
$nombre_tipo_cobro_hotel                                            = $matriz_consulta['nombre_tipo_cobro_hotel'];
$costo_hotel                                                        = $matriz_consulta['costo_hotel'];
$cod_estado_parqueo_hotel_global                                    = $matriz_consulta['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                            = $matriz_consulta['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                          = $matriz_consulta['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                            = $matriz_consulta['cod_estado_plan_accion_correcion_global'];

$tamano_font                                                        = $matriz_consulta['tamano_font'];
$tamano_font_hc                                                     = $matriz_consulta['tamano_font_hc'];
$tamano_font_aptlab                                                 = $matriz_consulta['tamano_font_aptlab'];
$tamano_font_trabaltu                                               = $matriz_consulta['tamano_font_trabaltu'];
$tamano_font_manaliment                                             = $matriz_consulta['tamano_font_manaliment'];
$tamano_font_informe                                                = $matriz_consulta['tamano_font_informe'];
$tamano_font_remision                                               = $matriz_consulta['tamano_font_remision'];
$tamano_font_factura                                                = $matriz_consulta['tamano_font_factura'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global                = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global         = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                        = $matriz_consulta['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global             = $matriz_consulta['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global                     = $matriz_consulta['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global                    = $matriz_consulta['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global                    = $matriz_consulta['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global                  = $matriz_consulta['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global                  = $matriz_consulta['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global                  = $matriz_consulta['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global                = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global                = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global               = $matriz_consulta['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                        = $matriz_consulta['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global                = $matriz_consulta['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global                      = $matriz_consulta['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global                  = $matriz_consulta['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global                  = $matriz_consulta['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global                     = $matriz_consulta['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                        = $matriz_consulta['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                           = $matriz_consulta['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                                      = $matriz_consulta['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                        = $matriz_consulta['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                                   = $matriz_consulta['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                            = $matriz_consulta['cod_estado_marca_global'];
$cod_estado_proveedor_global                                        = $matriz_consulta['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                                  = $matriz_consulta['cod_estado_archivo_adjunto_global'];
$cod_estado_precio_compra_mod_venta_global                          = $matriz_consulta['cod_estado_precio_compra_mod_venta_global'];

$cod_estado_timbre_entrada_pedido_temporal_cocina_global            = $matriz_consulta['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global             = $matriz_consulta['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_estado_subproducto_mostrar_imprimir_global                     = $matriz_consulta['cod_estado_subproducto_mostrar_imprimir_global'];

$cod_estado_diferencia_ganancia_inventario_global                   = $matriz_consulta['cod_estado_diferencia_ganancia_inventario_global'];
$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global      = $matriz_consulta['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'];
$cod_estado_opcion_descontable_inv_global                           = $matriz_consulta['cod_estado_opcion_descontable_inv_global'];
$cod_estado_hora_reporte_venta_global                               = $matriz_consulta['cod_estado_hora_reporte_venta_global'];

$cod_estado_cantidad_caja_mesa_global                               = $matriz_consulta['cod_estado_cantidad_caja_mesa_global'];
$cod_estado_venta_por_categoria_mod_venta_global                    = $matriz_consulta['cod_estado_venta_por_categoria_mod_venta_global'];
$cod_estado_habilitar_btn_facturar_mod_venta_global                 = $matriz_consulta['cod_estado_habilitar_btn_facturar_mod_venta_global'];
$cod_estado_btn_imprimir_preventa_cocina_global                     = $matriz_consulta['cod_estado_btn_imprimir_preventa_cocina_global'];
$cod_estado_producto_de_cocina_global                               = $matriz_consulta['cod_estado_producto_de_cocina_global'];
$cantidad_caja_mesa                                                 = $matriz_consulta['cantidad_caja_mesa'];
$tamano_papel_impresora                                             = $matriz_consulta['tamano_papel_impresora'];


$cod_estado_posicion_gps_pedidos_global                             = $matriz_consulta['cod_estado_posicion_gps_pedidos_global'];
$cod_estado_precio_venta_variable_disponible_admin_global           = $matriz_consulta['cod_estado_precio_venta_variable_disponible_admin_global'];
$cod_estado_check_imp_global                                        = $matriz_consulta['cod_estado_check_imp_global'];
$cod_estado_dividir_factura_caja_mesa_global                        = $matriz_consulta['cod_estado_dividir_factura_caja_mesa_global'];
$cod_estado_agrupar_por_producto_imp_global                         = $matriz_consulta['cod_estado_agrupar_por_producto_imp_global'];
$cod_estado_descuento_concepto_venta_neg_global                     = $matriz_consulta['cod_estado_descuento_concepto_venta_neg_global'];

$cod_estado_habilitar_btn_imp_venta_nav_global                      = $matriz_consulta['cod_estado_habilitar_btn_imp_venta_nav_global'];
$cod_estado_habilitar_btn_imp_venta_direct_driv_global              = $matriz_consulta['cod_estado_habilitar_btn_imp_venta_direct_driv_global'];
$cod_estado_habilitar_btn_imp_nav_carta_pdf_global                  = $matriz_consulta['cod_estado_habilitar_btn_imp_nav_carta_pdf_global'];
$cod_estado_habilitar_btn_imp_preventodo_nav_global                 = $matriz_consulta['cod_estado_habilitar_btn_imp_preventodo_nav_global'];
$cod_estado_habilitar_btn_imp_preventodo_direct_driv_global         = $matriz_consulta['cod_estado_habilitar_btn_imp_preventodo_direct_driv_global'];
$cod_estado_habilitar_btn_imp_cocina_nav_global                     = $matriz_consulta['cod_estado_habilitar_btn_imp_cocina_nav_global'];
$cod_estado_habilitar_btn_imp_cocina_direct_driv_global             = $matriz_consulta['cod_estado_habilitar_btn_imp_cocina_direct_driv_global'];
$cod_estado_habilitar_btn_imp_repventa_consol_nav_global            = $matriz_consulta['cod_estado_habilitar_btn_imp_repventa_consol_nav_global'];
$cod_estado_habilitar_btn_imp_repventa_direct_driv_global           = $matriz_consulta['cod_estado_habilitar_btn_imp_repventa_direct_driv_global'];
$cod_estado_modificar_und_venta_una_sola_vez_global                 = $matriz_consulta['cod_estado_modificar_und_venta_una_sola_vez_global'];

$cod_estado_habilitar_hora_venta_temporal_global                    = $info_empresa_data['cod_estado_habilitar_hora_venta_temporal_global'];
$cod_estado_revisado_venta_temporal_global                          = $info_empresa_data['cod_estado_revisado_venta_temporal_global'];
$cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global         = $info_empresa_data['cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global'];
$cod_estado_prioridad_caja_mesa_global                              = $info_empresa_data['cod_estado_prioridad_caja_mesa_global'];
$cod_estado_transferencia_empresa_extern_global                     = $info_empresa_data['cod_estado_transferencia_empresa_extern_global'];
$nombre_tipo_campo_componente_html_und_venta                        = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];

$cod_estado_descuento_automatico_por_cambio_precio_venta_global     = $info_empresa_data['cod_estado_descuento_automatico_por_cambio_precio_venta_global'];
$cod_estado_btn_categoria_desplegable_global                        = $info_empresa_data['cod_estado_btn_categoria_desplegable_global'];


$cod_estado_consultar_precios_extern_global                         = $info_empresa_data['cod_estado_consultar_precios_extern_global'];
$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global        = $info_empresa_data['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'];
$cod_estado_nombre_producto_editable_factura_compra_global          = $info_empresa_data['cod_estado_nombre_producto_editable_factura_compra_global'];
$cod_estado_tipo_compra_global                                      = $info_empresa_data['cod_estado_tipo_compra_global'];
$cod_estado_grafico_estadistico_global                              = $info_empresa_data['cod_estado_grafico_estadistico_global'];
$cod_estado_inventario_bodega2_global                               = $info_empresa_data['cod_estado_inventario_bodega2_global'];
$cod_estado_tipo_roles_global                                       = $info_empresa_data['cod_estado_tipo_roles_global'];

$cod_estado_bascula_balanza_electronica_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global        = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];

$cod_tipo_sistema_numeracion                                        = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_estado_lote_compra_global                                      = $info_empresa_data['cod_estado_lote_compra_global'];
$cod_estado_tipo_metodo_envio_global                                = $info_empresa_data['cod_estado_tipo_metodo_envio_global'];
$cod_estado_mod_domicilio_y_estado_habilitado_producto_global       = $info_empresa_data['cod_estado_mod_domicilio_y_estado_habilitado_producto_global'];
$cod_estado_promocion_global                                        = $info_empresa_data['cod_estado_promocion_global'];

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

$cod_estado_limite_venta_pos_factura_electronica_global             = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$cod_estado_recalcular_factura_compra_global                        = $info_empresa_data['cod_estado_recalcular_factura_compra_global'];
$cod_estado_comentario_venta_mostrar_imprimir_global                = $info_empresa_data['cod_estado_comentario_venta_mostrar_imprimir_global'];
$cod_estado_mostrar_agrupado_produc_repventa_imprimir_global        = $info_empresa_data['cod_estado_mostrar_agrupado_produc_repventa_imprimir_global'];
$cod_estado_sumar_producto_repetido_venta_temporal_global           = $info_empresa_data['cod_estado_sumar_producto_repetido_venta_temporal_global'];
$cod_estado_edit_precio_venta_btn_factura_venta_global              = $info_empresa_data['cod_estado_edit_precio_venta_btn_factura_venta_global'];
$cod_estado_busqueda_venta_manual_resultado_unico_redirect_global   = $info_empresa_data['cod_estado_busqueda_venta_manual_resultado_unico_redirect_global'];
$cod_tipo_cierre_caja_global                                        = $info_empresa_data['cod_tipo_cierre_caja_global'];
$cod_estado_soporte_factura_venta_global                            = $info_empresa_data['cod_estado_soporte_factura_venta_global'];
$cod_estado_cargar_factura_compra_simplificada_carniceria_global    = $info_empresa_data['cod_estado_cargar_factura_compra_simplificada_carniceria_global'];
$cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global    = $info_empresa_data['cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global'];

$cod_estado_cod_barra2_global                                       = $info_empresa_data['cod_estado_cod_barra2_global'];
$cod_estado_publicidad_global                                       = $info_empresa_data['cod_estado_publicidad_global'];
$cod_estado_habitacion_hotel_global                                 = $info_empresa_data['cod_estado_habitacion_hotel_global'];
$cod_estado_tipo_habitacion_hotel_global                            = $info_empresa_data['cod_estado_tipo_habitacion_hotel_global'];
$cod_estado_limpieza_hotel_global                                   = $info_empresa_data['cod_estado_limpieza_hotel_global'];

$cod_estado_tipo_moviento_contable_credito_debito_global            = $info_empresa_data['cod_estado_tipo_moviento_contable_credito_debito_global'];
$cod_estado_iva_saludable_ptj_global                                = $info_empresa_data['cod_estado_iva_saludable_ptj_global'];

$cod_estado_pvar_calculo_automatico_pcompra_global                  = $info_empresa_data['cod_estado_pvar_calculo_automatico_pcompra_global'];
$ptj_pvar_calculo_automatico_pcompra                                = $info_empresa_data['ptj_pvar_calculo_automatico_pcompra'];


$cod_estado_movimiento_contable_cuenta_personal_global              = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
$nombre_tipo_presentacion_defect_global                             = $info_empresa_data['nombre_tipo_presentacion_defect_global'];
$cod_estado_mostrar_venta_por_caja_global                           = $info_empresa_data['cod_estado_mostrar_venta_por_caja_global'];
$cod_estado_btn_imp_nav_carta_por_caja_pdf_global                   = $info_empresa_data['cod_estado_btn_imp_nav_carta_por_caja_pdf_global'];
$cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global          = $info_empresa_data['cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global'];
$cod_estado_espacio_firma_bodega_imprimir_global                    = $info_empresa_data['cod_estado_espacio_firma_bodega_imprimir_global'];
$cod_estado_espacio_firma_transportador_imprimir_global             = $info_empresa_data['cod_estado_espacio_firma_transportador_imprimir_global'];

$cod_estado_tipo_cobro_aviso_alerta_renovacion_global               = $info_empresa_data['cod_estado_tipo_cobro_aviso_alerta_renovacion_global'];
$cod_estado_tipo_export_excel_global                                = $info_empresa_data['cod_estado_tipo_export_excel_global'];
$cod_estado_tipo_nominacion_moneda_cierre_caja_global               = $info_empresa_data['cod_estado_tipo_nominacion_moneda_cierre_caja_global'];


$cod_estado_domiciliario_global                                   = $info_empresa_data['cod_estado_domiciliario_global'];
$cod_estado_generar_movimiento_contable_automatico_global         = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_promediar_precio_compra_y_venta_cargar_factura_global = $info_empresa_data['cod_estado_promediar_precio_compra_y_venta_cargar_factura_global'];
$cod_estado_btn_imp_pos_nav_orden_compra_global                   = $info_empresa_data['cod_estado_btn_imp_pos_nav_orden_compra_global'];
$cod_estado_btn_imp_pos_direct_driv_orden_compra_global           = $info_empresa_data['cod_estado_btn_imp_pos_direct_driv_orden_compra_global'];
$cod_estado_btn_imp_carta_nav_orden_compra_pdf_global             = $info_empresa_data['cod_estado_btn_imp_carta_nav_orden_compra_pdf_global'];
$cod_estado_converir_und_a_caja_mostrar_imprimir_global           = $info_empresa_data['cod_estado_converir_und_a_caja_mostrar_imprimir_global'];
$cod_estado_sistema_transferencia_interna_global                  = $info_empresa_data['cod_estado_sistema_transferencia_interna_global'];
$cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global     = $info_empresa_data['cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global'];
$cod_estado_empresa_transferencia_directa_global                  = $info_empresa_data['cod_estado_empresa_transferencia_directa_global'];
$cod_empresa_transferencia_directa_global                         = $info_empresa_data['cod_empresa_transferencia_directa_global'];
$cod_estado_forzar_dos_decimales_und_venta_step_html_global       = $info_empresa_data['cod_estado_forzar_dos_decimales_und_venta_step_html_global'];
$cod_estado_tipo_producto_global                                  = $info_empresa_data['cod_estado_tipo_producto_global'];
$cod_estado_deshabilitar_total_editable_cargarfacturacompr_global = $info_empresa_data['cod_estado_deshabilitar_total_editable_cargarfacturacompr_global'];
$cod_estado_modulo_puc_global                                     = $info_empresa_data['cod_estado_modulo_puc_global'];
$modo_venta_por_defecto_global                                    = $info_empresa_data['modo_venta_por_defecto_global'];

$cod_estado_deshabilitar_edicion_totales_factura_compra_global    = $info_empresa_data['cod_estado_deshabilitar_edicion_totales_factura_compra_global'];
$dataico_entorno_desarrollo_api_global                            = $info_empresa_data['dataico_entorno_desarrollo_api_global'];
$dataico_account_id_api_global                                    = $info_empresa_data['dataico_account_id_api_global'];
$dataico_auth_token_api_global                                    = $info_empresa_data['dataico_auth_token_api_global'];
$dataico_tipo_factura_api_global                                  = $info_empresa_data['dataico_tipo_factura_api_global'];
$dataico_send_dian_api_global                                     = $info_empresa_data['dataico_send_dian_api_global'];
$dataico_send_email_api_global                                    = $info_empresa_data['dataico_send_email_api_global'];
$cod_estado_enviar_factura_venta_electronica_dian_api_global      = $info_empresa_data['cod_estado_enviar_factura_venta_electronica_dian_api_global'];
$cod_estado_modelo_factura_tirilla_avenidajuan_global             = $info_empresa_data['cod_estado_modelo_factura_tirilla_avenidajuan_global'];
$cod_agente_dian_contribuyente                                    = $info_empresa_data['cod_agente_dian_contribuyente'];
$cod_agente_dian_retenedor                                        = $info_empresa_data['cod_agente_dian_retenedor'];
$cod_agente_dian_autoretenedor                                    = $info_empresa_data['cod_agente_dian_autoretenedor'];
$nombre_tipo_factura_defecto_global                               = $info_empresa_data['nombre_tipo_factura_defecto_global'];
$tiempo_espera_respuesta_factura_venta_electronica_global         = $info_empresa_data['tiempo_espera_respuesta_factura_venta_electronica_global'];
$cod_estado_dia_sin_iva_global                                    = $info_empresa_data['cod_estado_dia_sin_iva_global'];
$cod_estado_campos_sector_salud_global                            = $info_empresa_data['cod_estado_campos_sector_salud_global'];
$cod_estado_perfil_sociodemografico_global                        = $info_empresa_data['cod_estado_perfil_sociodemografico_global'];
$cod_tipo_sistema_numeracion_und_unidades_presentacion            = $info_empresa_data['cod_tipo_sistema_numeracion_und_unidades_presentacion'];
$cod_tipo_sistema_numeracion_und_caja_presentacion                = $info_empresa_data['cod_tipo_sistema_numeracion_und_caja_presentacion'];
$cod_estado_mostrar_descuento_manual_factura_venta_global         = $info_empresa_data['cod_estado_mostrar_descuento_manual_factura_venta_global'];
$cod_resolucion_facturacion_venta_defecto_global                  = $info_empresa_data['cod_resolucion_facturacion_venta_defecto_global'];

$cod_estado_reporte_por_caja_virtual_global                       = $info_empresa_data['cod_estado_reporte_por_caja_virtual_global'];
$cod_estado_puntos_redimibles_campanya_global                     = $info_empresa_data['cod_estado_puntos_redimibles_campanya_global'];
$cod_estado_enviar_factura_documento_soporte_dian_api_global      = $info_empresa_data['cod_estado_enviar_factura_documento_soporte_dian_api_global'];





$cod_puntos_redimibles_campanya_predef_global                     = $info_empresa_data['cod_puntos_redimibles_campanya_predef_global'];
$cod_estado_movimiento_contable_caja_personal_global              = $info_empresa_data['cod_estado_movimiento_contable_caja_personal_global'];
$cod_estado_deshabilitar_descuento_impresion_venta_global         = $info_empresa_data['cod_estado_deshabilitar_descuento_impresion_venta_global'];
$cod_estado_retefuente_global                                     = $info_empresa_data['cod_estado_retefuente_global'];
$cod_estado_reteica_global                                        = $info_empresa_data['cod_estado_reteica_global'];
$cod_estado_reteiva_global                                        = $info_empresa_data['cod_estado_reteiva_global'];
$cod_movimiento_contable_cuenta_personal_defect_global            = $info_empresa_data['cod_movimiento_contable_cuenta_personal_defect_global'];
$cod_movimiento_caja_defect_global                                = $info_empresa_data['cod_movimiento_caja_defect_global'];
$cod_puc_defect_global                                            = $info_empresa_data['cod_puc_defect_global'];
$codigo_tipo_modulo_cuenta_cobrar_defect_global                   = $info_empresa_data['codigo_tipo_modulo_cuenta_cobrar_defect_global'];
$cod_estado_reporte_venta_total_compra_caja_registradora_global   = $info_empresa_data['cod_estado_reporte_venta_total_compra_caja_registradora_global'];
$cod_estado_provee_fechacompra_inv_masivo_global                  = $info_empresa_data['cod_estado_provee_fechacompra_inv_masivo_global'];
$cod_estado_nota_credito_global                                   = $info_empresa_data['cod_estado_nota_credito_global'];
$cod_estado_nota_debito_global                                    = $info_empresa_data['cod_estado_nota_debito_global'];
$cod_estado_renta_alquiler_global                                 = $info_empresa_data['cod_estado_renta_alquiler_global'];
$cod_estado_nuevo_inventario_con_existencia_global                = $info_empresa_data['cod_estado_nuevo_inventario_con_existencia_global'];
$cod_estado_edicion_fact_compra_e_inv_global                      = $info_empresa_data['cod_estado_edicion_fact_compra_e_inv_global'];
$cod_estado_saldo_recarga_global                                  = $info_empresa_data['cod_estado_saldo_recarga_global'];
$cod_estado_puntos_redimibles_campanya_recarga_global             = $info_empresa_data['cod_estado_puntos_redimibles_campanya_recarga_global'];
$cod_estado_tipo_servicio_global                                  = $info_empresa_data['cod_estado_tipo_servicio_global'];
$cod_estado_subproducto_cuenta_servicio_global                    = $info_empresa_data['cod_estado_subproducto_cuenta_servicio_global'];
$cod_estado_modulo_cuenta_pagar_abono_editar_compra_global        = $info_empresa_data['cod_estado_modulo_cuenta_pagar_abono_editar_compra_global'];
$cod_estado_verificar_unidad_venta_en_cero_venta_temp_global      = $info_empresa_data['cod_estado_verificar_unidad_venta_en_cero_venta_temp_global'];
$cod_estado_verificar_precio_venta_en_cero_venta_temp_global      = $info_empresa_data['cod_estado_verificar_precio_venta_en_cero_venta_temp_global'];
$cod_estado_factura_electronica_sector_salud_global               = $info_empresa_data['cod_estado_factura_electronica_sector_salud_global'];
$cod_estado_producto_destacado_global                             = $info_empresa_data['cod_estado_producto_destacado_global'];
$cod_estado_tienda_global                                         = $info_empresa_data['cod_estado_tienda_global'];
$cod_estado_tipo_rol_sistecredito_global                          = $info_empresa_data['cod_estado_tipo_rol_sistecredito_global'];
$limite_base_venta_aplicar_retefuente_global                      = $info_empresa_data['limite_base_venta_aplicar_retefuente_global'];
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_info_empresa_admin_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO PRODUCTOS (INVENTARIO)</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_modulo_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_producto_global" type='checkbox' value='<?php echo $cod_estado_modulo_producto_global ?>' <?php if($cod_estado_modulo_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBPRODUCTOS</th>
			<td style='text-align:center'><input name='cod_estado_subproducto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subproducto_global" type='checkbox' value='<?php echo $cod_estado_subproducto_global ?>' <?php if($cod_estado_subproducto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subproducto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NUEVO INVENTARIO</th>
			<td style='text-align:center'><input name='cod_estado_nuevo_inventario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nuevo_inventario_global" type='checkbox' value='<?php echo $cod_estado_nuevo_inventario_global ?>' <?php if($cod_estado_nuevo_inventario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nuevo_inventario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TRANSFERENCIA INTERNA (INVENTARIO BODEGA 1)</th>
			<td style='text-align:center'><input name='cod_estado_inventario_bodega_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_inventario_bodega_global" type='checkbox' value='<?php echo $cod_estado_inventario_bodega_global ?>' <?php if($cod_estado_inventario_bodega_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_inventario_bodega_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TRANSFERENCIA EMPRESA EXTERNA (TRANSMISION ARCHIVO PLANO)</th>
			<td style='text-align:center'><input name='cod_estado_transferencia_empresa_extern_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_transferencia_empresa_extern_global" type='checkbox' value='<?php echo $cod_estado_transferencia_empresa_extern_global ?>' <?php if($cod_estado_transferencia_empresa_extern_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_transferencia_empresa_extern_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR INVENTARIO BODEGA 2</th>
			<td style='text-align:center'><input name='cod_estado_inventario_bodega2_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_inventario_bodega2_global" type='checkbox' value='<?php echo $cod_estado_inventario_bodega2_global ?>' <?php if($cod_estado_inventario_bodega2_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_inventario_bodega2_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR AUDITORIA</th>
			<td style='text-align:center'><input name='cod_estado_auditoria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_auditoria_global" type='checkbox' value='<?php echo $cod_estado_auditoria_global ?>' <?php if($cod_estado_auditoria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_auditoria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR +%GANANCIA (REG PRODUCTO - CARGAR FACTURA COMPRA)</th>
			<td style='text-align:center'><input name='cod_estado_ganancia_ptj_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_ganancia_ptj_global" type='checkbox' value='<?php echo $cod_estado_ganancia_ptj_global ?>' <?php if($cod_estado_ganancia_ptj_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_ganancia_ptj_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMAGEN PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_img_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_img_producto_global" type='checkbox' value='<?php echo $cod_estado_img_producto_global ?>' <?php if($cod_estado_img_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_img_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PRODUCTO UNIDADES NO DESCONTABLES INV</th>
			<td style='text-align:center'><input name='cod_estado_opcion_descontable_inv_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_opcion_descontable_inv_global" type='checkbox' value='<?php echo $cod_estado_opcion_descontable_inv_global ?>' <?php if($cod_estado_opcion_descontable_inv_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_opcion_descontable_inv_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMPOCONSUMO</th>
			<td style='text-align:center'><input name='cod_estado_impoconsumo_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_impoconsumo_global" type='checkbox' value='<?php echo $cod_estado_impoconsumo_global ?>' <?php if($cod_estado_impoconsumo_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_impoconsumo_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR %DTO1</th>
			<td style='text-align:center'><input name='cod_estado_dto1_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_dto1_global" type='checkbox' value='<?php echo $cod_estado_dto1_global ?>' <?php if($cod_estado_dto1_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_dto1_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR %DTO2</th>
			<td style='text-align:center'><input name='cod_estado_dto2_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_dto2_global" type='checkbox' value='<?php echo $cod_estado_dto2_global ?>' <?php if($cod_estado_dto2_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_dto2_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO CONSUMIBLE</th>
			<td style='text-align:center'><input name='cod_estado_producto_consumo_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_producto_consumo_global" type='checkbox' value='<?php echo $cod_estado_producto_consumo_global ?>' <?php if($cod_estado_producto_consumo_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_producto_consumo_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FECHA VENCIMIENTO</th>
			<th style="text-align:center"><input name='cod_estado_fecha_vencimiento_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_fecha_vencimiento_global" type='checkbox' value='<?php echo $cod_estado_fecha_vencimiento_global ?>' <?php if($cod_estado_fecha_vencimiento_global=='1'){ echo 'checked'; } ?>></th>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_fecha_vencimiento_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CATEGORIA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_categoria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_categoria_global" type='checkbox' value='<?php echo $cod_estado_categoria_global ?>' <?php if($cod_estado_categoria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_categoria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ESTANTE PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_estante_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_estante_producto_global" type='checkbox' value='<?php echo $cod_estado_estante_producto_global ?>' <?php if($cod_estado_estante_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_estante_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR COMPRA X CAJA</th>
			<td style='text-align:center'><input name='cod_estado_compra_caja_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_compra_caja_global" type='checkbox' value='<?php echo $cod_estado_compra_caja_global ?>' <?php if($cod_estado_compra_caja_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_compra_caja_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR UND CAJA</th>
			<td style='text-align:center'><input name='cod_estado_cajas_sobre_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cajas_sobre_global" type='checkbox' value='<?php echo $cod_estado_cajas_sobre_global ?>' <?php if($cod_estado_cajas_sobre_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cajas_sobre_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR UND SOBRE</th>
			<td style='text-align:center'><input name='cod_estado_und_sobre_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_und_sobre_global" type='checkbox' value='<?php echo $cod_estado_und_sobre_global ?>' <?php if($cod_estado_und_sobre_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_und_sobre_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DEPENDENCIA</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_dependencia_global" type='checkbox' value='<?php echo $cod_estado_dependencia_global ?>' <?php if($cod_estado_dependencia_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_dependencia_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NOMBRE PRODUCTO EDITABE FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_nombre_producto_editable_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nombre_producto_editable_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_nombre_producto_editable_factura_compra_global ?>' <?php if($cod_estado_nombre_producto_editable_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nombre_producto_editable_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MANTENIMIENTO</th>
			<td style='text-align:center'><input name='cod_estado_prodcuto_mantenimiento_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_prodcuto_mantenimiento_global" type='checkbox' value='<?php echo $cod_estado_prodcuto_mantenimiento_global ?>' <?php if($cod_estado_prodcuto_mantenimiento_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_prodcuto_mantenimiento_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FECHA MANTENIMIENTO</th>
			<td style='text-align:center'><input name='cod_estado_fecha_mantenimiento_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_fecha_mantenimiento_global" type='checkbox' value='<?php echo $cod_estado_fecha_mantenimiento_global ?>' <?php if($cod_estado_fecha_mantenimiento_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_fecha_mantenimiento_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MESES GARANTIA</th>
			<td style='text-align:center'><input name='cod_estado_meses_garantia_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_meses_garantia_global" type='checkbox' value='<?php echo $cod_estado_meses_garantia_global ?>' <?php if($cod_estado_meses_garantia_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_meses_garantia_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MARCA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_marca_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_marca_global" type='checkbox' value='<?php echo $cod_estado_marca_global ?>' <?php if($cod_estado_marca_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_marca_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PROVEEDOR PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_proveedor_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_proveedor_global" type='checkbox' value='<?php echo $cod_estado_proveedor_global ?>' <?php if($cod_estado_proveedor_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_proveedor_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">LOTE DE COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_lote_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_lote_compra_global" type='checkbox' value='<?php echo $cod_estado_lote_compra_global ?>' <?php if($cod_estado_lote_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_lote_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ANIMAL</th>
			<td style='text-align:center'><input name='cod_estado_animal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_animal_global" type='checkbox' value='<?php echo $cod_estado_animal_global ?>' <?php if($cod_estado_animal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_animal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SERIAL PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_producto_serial_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_producto_serial_global" type='checkbox' value='<?php echo $cod_estado_producto_serial_global ?>' <?php if($cod_estado_producto_serial_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_producto_serial_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR COMISION PRODUCTO VENTA</th>
			<td style='text-align:center'><input name='cod_estado_ptj_comision_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_ptj_comision_global" type='checkbox' value='<?php echo $cod_estado_ptj_comision_global ?>' <?php if($cod_estado_ptj_comision_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_ptj_comision_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ARCHIVO ADJUNTO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_archivo_adjunto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_archivo_adjunto_global" type='checkbox' value='<?php echo $cod_estado_archivo_adjunto_global ?>' <?php if($cod_estado_archivo_adjunto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_archivo_adjunto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DIFERENCIA GANANCIA INVENTARIO (INVENTARIO PRODUCTOS)</th>
			<td style='text-align:center'><input name='cod_estado_diferencia_ganancia_inventario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_diferencia_ganancia_inventario_global" type='checkbox' value='<?php echo $cod_estado_diferencia_ganancia_inventario_global ?>' <?php if($cod_estado_diferencia_ganancia_inventario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_diferencia_ganancia_inventario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DIFERENCIA GANANCIA PROMEDIO INVENTARIO (INVENTARIO PRODUCTOS)</th>
			<td style='text-align:center'><input name='cod_estado_diferencia_ganancia_inventario_ptj_promedio_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_diferencia_ganancia_inventario_ptj_promedio_global" type='checkbox' value='<?php echo $cod_estado_diferencia_ganancia_inventario_ptj_promedio_global ?>' <?php if($cod_estado_diferencia_ganancia_inventario_ptj_promedio_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_diferencia_ganancia_inventario_ptj_promedio_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PRODUCTO DE COCINA (SI-NO)</th>
			<td style='text-align:center'><input name='cod_estado_producto_de_cocina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_producto_de_cocina_global" type='checkbox' value='<?php echo $cod_estado_producto_de_cocina_global ?>' <?php if($cod_estado_producto_de_cocina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_producto_de_cocina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO COMPRA (NORMAL - ESPECIAL)</th>
			<td style='text-align:center'><input name='cod_estado_tipo_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_compra_global" type='checkbox' value='<?php echo $cod_estado_tipo_compra_global ?>' <?php if($cod_estado_tipo_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ESTADO DEL PRODUCTO (HABILITADO VISITANTE EXTERN - DOMICILIO - INVENTARIO MASIVO ESTADO)</th>
			<td style='text-align:center'><input name='cod_estado_mod_domicilio_y_estado_habilitado_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_mod_domicilio_y_estado_habilitado_producto_global" type='checkbox' value='<?php echo $cod_estado_mod_domicilio_y_estado_habilitado_producto_global ?>' <?php if($cod_estado_mod_domicilio_y_estado_habilitado_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_mod_domicilio_y_estado_habilitado_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ORIGEN PRODUCCION PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_origen_produccion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_origen_produccion_global" type='checkbox' value='<?php echo $cod_estado_origen_produccion_global ?>' <?php if($cod_estado_origen_produccion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_origen_produccion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PRODUCTOS POCO MOVIMIENTO REPORTE</th>
			<td style='text-align:center'><input name='cod_estado_productos_poco_movimiento_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_productos_poco_movimiento_global" type='checkbox' value='<?php echo $cod_estado_productos_poco_movimiento_global ?>' <?php if($cod_estado_productos_poco_movimiento_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_productos_poco_movimiento_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NUEVO INVENTARIO POR LETRA</th>
			<td style='text-align:center'><input name='cod_estado_nuevo_inventario_por_letra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nuevo_inventario_por_letra_global" type='checkbox' value='<?php echo $cod_estado_nuevo_inventario_por_letra_global ?>' <?php if($cod_estado_nuevo_inventario_por_letra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nuevo_inventario_por_letra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR UNIDADES PRODUCTO INVENTARIO</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_und_producto_inventario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_und_producto_inventario_global" type='checkbox' value='<?php echo $cod_estado_actualizar_und_producto_inventario_global ?>' <?php if($cod_estado_actualizar_und_producto_inventario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_und_producto_inventario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBDEPENDENCIA-SEDE</th>
			<td style='text-align:center'><input name='cod_estado_dependencia_sub_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_dependencia_sub_global" type='checkbox' value='<?php echo $cod_estado_dependencia_sub_global ?>' <?php if($cod_estado_dependencia_sub_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_dependencia_sub_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CODIGO FACTURA COMPRA PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_factura_compra_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_factura_compra_producto_global" type='checkbox' value='<?php echo $cod_estado_factura_compra_producto_global ?>' <?php if($cod_estado_factura_compra_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_factura_compra_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CODIGO DE BARRAS 2</th>
			<td style='text-align:center'><input name='cod_estado_cod_barra2_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cod_barra2_global" type='checkbox' value='<?php echo $cod_estado_cod_barra2_global ?>' <?php if($cod_estado_cod_barra2_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cod_barra2_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ESTADO HABITACION HOTEL</th>
			<td style='text-align:center'><input name='cod_estado_habitacion_hotel_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habitacion_hotel_global" type='checkbox' value='<?php echo $cod_estado_habitacion_hotel_global ?>' <?php if($cod_estado_habitacion_hotel_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habitacion_hotel_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO HABITACION HOTEL</th>
			<td style='text-align:center'><input name='cod_estado_tipo_habitacion_hotel_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_habitacion_hotel_global" type='checkbox' value='<?php echo $cod_estado_tipo_habitacion_hotel_global ?>' <?php if($cod_estado_tipo_habitacion_hotel_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_habitacion_hotel_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR LIMPIEZA HOTEL</th>
			<td style='text-align:center'><input name='cod_estado_limpieza_hotel_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_limpieza_hotel_global" type='checkbox' value='<?php echo $cod_estado_limpieza_hotel_global ?>' <?php if($cod_estado_limpieza_hotel_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_limpieza_hotel_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TRANSFERENCIA INTERNA</th>
			<td style='text-align:center'><input name='cod_estado_sistema_transferencia_interna_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_sistema_transferencia_interna_global" type='checkbox' value='<?php echo $cod_estado_sistema_transferencia_interna_global ?>' <?php if($cod_estado_sistema_transferencia_interna_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_sistema_transferencia_interna_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_tipo_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_producto_global" type='checkbox' value='<?php echo $cod_estado_tipo_producto_global ?>' <?php if($cod_estado_tipo_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR EMPRESA TRANSFERENCIA DIRECTA</th>
			<td style='text-align:center'><input name='cod_estado_empresa_transferencia_directa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_empresa_transferencia_directa_global" type='checkbox' value='<?php echo $cod_estado_empresa_transferencia_directa_global ?>' <?php if($cod_estado_empresa_transferencia_directa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_empresa_transferencia_directa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IVA SALUDABLE</th>
			<td style='text-align:center'><input name='cod_estado_iva_saludable_ptj_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_iva_saludable_ptj_global" type='checkbox' value='<?php echo $cod_estado_iva_saludable_ptj_global ?>' <?php if($cod_estado_iva_saludable_ptj_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_iva_saludable_ptj_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR INVENTARIO MASIVO PROVEEDOR FECHA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_provee_fechacompra_inv_masivo_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_provee_fechacompra_inv_masivo_global" type='checkbox' value='<?php echo $cod_estado_provee_fechacompra_inv_masivo_global ?>' <?php if($cod_estado_provee_fechacompra_inv_masivo_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_provee_fechacompra_inv_masivo_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NUEVO INVENTARIO CON EXISTENCIA</th>
			<td style='text-align:center'><input name='cod_estado_nuevo_inventario_con_existencia_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nuevo_inventario_con_existencia_global" type='checkbox' value='<?php echo $cod_estado_nuevo_inventario_con_existencia_global ?>' <?php if($cod_estado_nuevo_inventario_con_existencia_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nuevo_inventario_con_existencia_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR EDICION FACTURA COMPRA E INVENTARIO (EDITAR EL INVENTARIO AL MODIFICAR LA FACTURA DE COMPRA)</th>
			<td style='text-align:center'><input name='cod_estado_edicion_fact_compra_e_inv_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_edicion_fact_compra_e_inv_global" type='checkbox' value='<?php echo $cod_estado_edicion_fact_compra_e_inv_global ?>' <?php if($cod_estado_edicion_fact_compra_e_inv_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_edicion_fact_compra_e_inv_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PRODUCTOS DESTACADOS (DISTRIB AYQ - SISTECREDIT)</th>
			<td style='text-align:center'><input name='cod_estado_producto_destacado_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_producto_destacado_global" type='checkbox' value='<?php echo $cod_estado_producto_destacado_global ?>' <?php if($cod_estado_producto_destacado_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_producto_destacado_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIENDA (DISTRIB AYQ - SISTECREDIT)</th>
			<td style='text-align:center'><input name='cod_estado_tienda_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tienda_global" type='checkbox' value='<?php echo $cod_estado_tienda_global ?>' <?php if($cod_estado_tienda_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tienda_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO ROL (DISTRIB AYQ - SISTECREDIT)</th>
			<td style='text-align:center'><input name='cod_estado_tipo_rol_sistecredito_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_rol_sistecredito_global" type='checkbox' value='<?php echo $cod_estado_tipo_rol_sistecredito_global ?>' <?php if($cod_estado_tipo_rol_sistecredito_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_rol_sistecredito_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">TIPO DE SERVICIO</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO DE SERVICIO (URBAN STREA)</th>
			<td style='text-align:center'><input name='cod_estado_tipo_servicio_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_servicio_global" type='checkbox' value='<?php echo $cod_estado_tipo_servicio_global ?>' <?php if($cod_estado_tipo_servicio_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_servicio_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">PESAR PRODUCTO OPCIONES</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PESO PRODUCTO (CARACTERISTICA)</th>
			<td style='text-align:center'><input name='cod_estado_peso_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_peso_producto_global" type='checkbox' value='<?php echo $cod_estado_peso_producto_global ?>' <?php if($cod_estado_peso_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_peso_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PESAR EL PRODUCTO (BASCULA BALANZA COD BARAS VENTA TEMP)</th>
			<td style='text-align:center'><input name='cod_estado_bascula_balanza_cod_barras_pesar_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_bascula_balanza_cod_barras_pesar_producto_global" type='checkbox' value='<?php echo $cod_estado_bascula_balanza_cod_barras_pesar_producto_global ?>' <?php if($cod_estado_bascula_balanza_cod_barras_pesar_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_bascula_balanza_cod_barras_pesar_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PESAR EL PRODUCTO (BASCULA BALANZA ELECTRONICA VENTA TEMP)</th>
			<td style='text-align:center'><input name='cod_estado_bascula_balanza_electronica_pesar_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_bascula_balanza_electronica_pesar_producto_global" type='checkbox' value='<?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global ?>' <?php if($cod_estado_bascula_balanza_electronica_pesar_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_bascula_balanza_electronica_pesar_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR EL PRODUCTO NECESITA SER PESADO ?</th>
			<td style='text-align:center'><input name='cod_estado_peso_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_peso_global" type='checkbox' value='<?php echo $cod_estado_peso_global ?>' <?php if($cod_estado_peso_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_peso_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULOS OLEINA ACEITE</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACEITE OLEINA</th>
			<td style='text-align:center'><input name='cod_estado_aceite_oleina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_aceite_oleina_global" type='checkbox' value='<?php echo $cod_estado_aceite_oleina_global ?>' <?php if($cod_estado_aceite_oleina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_aceite_oleina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR VALOR FLETE ACEITE OLEINA</th>
			<td style='text-align:center'><input name='cod_estado_valor_flete_aceite_oleina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_valor_flete_aceite_oleina_global" type='checkbox' value='<?php echo $cod_estado_valor_flete_aceite_oleina_global ?>' <?php if($cod_estado_valor_flete_aceite_oleina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_valor_flete_aceite_oleina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">CAJA FRACCION (CAJ|FRACC)</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CAJA FRACCION</th>
			<td style='text-align:center'><input name='cod_estado_caja_fraccion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_caja_fraccion_global" type='checkbox' value='<?php echo $cod_estado_caja_fraccion_global ?>' <?php if($cod_estado_caja_fraccion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_caja_fraccion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">PUBLICIDAD</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PUBLICIDAD EXTERNA</th>
			<td style='text-align:center'><input name='cod_estado_publicidad_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_publicidad_global" type='checkbox' value='<?php echo $cod_estado_publicidad_global ?>' <?php if($cod_estado_publicidad_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_publicidad_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">ACTUALIZAR TABLAS SISTEMA</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR BASE DE DATOS POR ARCHIVO PLANO</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_base_datos_arch_plano_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_base_datos_arch_plano_global" type='checkbox' value='<?php echo $cod_estado_actualizar_base_datos_arch_plano_global ?>' <?php if($cod_estado_actualizar_base_datos_arch_plano_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_base_datos_arch_plano_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR ARCHIVO PLANO PRODUCTOS</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_base_datos_arch_plano_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_base_datos_arch_plano_producto_global" type='checkbox' value='<?php echo $cod_estado_actualizar_base_datos_arch_plano_producto_global ?>' <?php if($cod_estado_actualizar_base_datos_arch_plano_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_base_datos_arch_plano_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR ARCHIVO PLANO VENTA</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_base_datos_arch_plano_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_base_datos_arch_plano_venta_global" type='checkbox' value='<?php echo $cod_estado_actualizar_base_datos_arch_plano_venta_global ?>' <?php if($cod_estado_actualizar_base_datos_arch_plano_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_base_datos_arch_plano_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR ARCHIVO PLANO VENTA INFO</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_base_datos_arch_plano_info_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_base_datos_arch_plano_info_venta_global" type='checkbox' value='<?php echo $cod_estado_actualizar_base_datos_arch_plano_info_venta_global ?>' <?php if($cod_estado_actualizar_base_datos_arch_plano_info_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_base_datos_arch_plano_info_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR ARCHIVO PLANO COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_base_datos_arch_plano_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_base_datos_arch_plano_compra_global" type='checkbox' value='<?php echo $cod_estado_actualizar_base_datos_arch_plano_compra_global ?>' <?php if($cod_estado_actualizar_base_datos_arch_plano_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_base_datos_arch_plano_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ACTUALIZAR ARCHIVO PLANO COMPRA INFO</th>
			<td style='text-align:center'><input name='cod_estado_actualizar_base_datos_arch_plano_info_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_actualizar_base_datos_arch_plano_info_compra_global" type='checkbox' value='<?php echo $cod_estado_actualizar_base_datos_arch_plano_info_compra_global ?>' <?php if($cod_estado_actualizar_base_datos_arch_plano_info_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_actualizar_base_datos_arch_plano_info_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO FACTURACION</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO FACTURACION</th>
			<td style='text-align:center'><input name='cod_estado_modulo_facturacion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_facturacion_global" type='checkbox' value='<?php echo $cod_estado_modulo_facturacion_global ?>' <?php if($cod_estado_modulo_facturacion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_facturacion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FACTURA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_modulo_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_venta_global" type='checkbox' value='<?php echo $cod_estado_modulo_venta_global ?>' <?php if($cod_estado_modulo_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_factura_compra_global ?>' <?php if($cod_estado_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SOPORTE FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_soporte_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_soporte_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_soporte_factura_compra_global ?>' <?php if($cod_estado_soporte_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_soporte_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR OBSERVACION FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_observacion_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_observacion_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_observacion_factura_compra_global ?>' <?php if($cod_estado_observacion_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_observacion_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ORIGEN FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_origen_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_origen_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_origen_factura_compra_global ?>' <?php if($cod_estado_origen_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_origen_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR EXISTE PRODUCTO FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_existe_producto_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_existe_producto_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_existe_producto_factura_compra_global ?>' <?php if($cod_estado_existe_producto_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_existe_producto_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CHECK FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_chk_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_chk_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_chk_factura_compra_global ?>' <?php if($cod_estado_chk_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_chk_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CHECK CAJA FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_check_caja_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_check_caja_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_check_caja_factura_compra_global ?>' <?php if($cod_estado_check_caja_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_check_caja_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CHECK UNIDAD FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_check_und_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_check_und_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_check_und_factura_compra_global ?>' <?php if($cod_estado_check_und_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_check_und_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CARGAR FACTURA COMPRA POR ARCHIVO PLANO INTERNO</th>
			<td style='text-align:center'><input name='cod_estado_cargar_archivo_plano_interno_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cargar_archivo_plano_interno_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_cargar_archivo_plano_interno_factura_compra_global ?>' <?php if($cod_estado_cargar_archivo_plano_interno_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cargar_archivo_plano_interno_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CARGAR FACTURA COMPRA POR ARCHIVO PLANO EXTERNO</th>
			<td style='text-align:center'><input name='cod_estado_cargar_archivo_plano_externo_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cargar_archivo_plano_externo_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_cargar_archivo_plano_externo_factura_compra_global ?>' <?php if($cod_estado_cargar_archivo_plano_externo_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cargar_archivo_plano_externo_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CARGUE INMEDIATO FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_factura_compra_cargue_inmediato_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_factura_compra_cargue_inmediato_global" type='checkbox' value='<?php echo $cod_estado_factura_compra_cargue_inmediato_global ?>' <?php if($cod_estado_factura_compra_cargue_inmediato_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_factura_compra_cargue_inmediato_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBIO BAJO PRECIO PRODUCTO FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global" type='checkbox' value='<?php echo $cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global ?>' <?php if($cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR BOTON RECALCULAR FACTURA COMPRA (EDICION FACTURA COMPRA)</th>
			<td style='text-align:center'><input name='cod_estado_recalcular_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_recalcular_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_recalcular_factura_compra_global ?>' <?php if($cod_estado_recalcular_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_recalcular_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FACTURA COMPRA SIMPLIFICADA (CARNICERIA)</th>
			<td style='text-align:center'><input name='cod_estado_cargar_factura_compra_simplificada_carniceria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cargar_factura_compra_simplificada_carniceria_global" type='checkbox' value='<?php echo $cod_estado_cargar_factura_compra_simplificada_carniceria_global ?>' <?php if($cod_estado_cargar_factura_compra_simplificada_carniceria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cargar_factura_compra_simplificada_carniceria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR EDICION TOTALES FACTURA COMPRA (FNR)</th>
			<td style='text-align:center'><input name='cod_estado_deshabilitar_edicion_totales_factura_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_deshabilitar_edicion_totales_factura_compra_global" type='checkbox' value='<?php echo $cod_estado_deshabilitar_edicion_totales_factura_compra_global ?>' <?php if($cod_estado_deshabilitar_edicion_totales_factura_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_deshabilitar_edicion_totales_factura_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PROMEDIAR PRECIOS COMPRA (PONDERADO = ((PRECIO COMPRA NUEVO * UND NUEVAS) + (PRECIO COMPRA INV * UND INV)) / (UND NUEVAS + UND INV)</th>
			<td style='text-align:center'><input name='cod_estado_promediar_precio_compra_y_venta_cargar_factura_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_promediar_precio_compra_y_venta_cargar_factura_global" type='checkbox' value='<?php echo $cod_estado_promediar_precio_compra_y_venta_cargar_factura_global ?>' <?php if($cod_estado_promediar_precio_compra_y_venta_cargar_factura_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_promediar_precio_compra_y_venta_cargar_factura_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR EDICION CAMPOS TOTALES CARGAR FACTURA COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_deshabilitar_total_editable_cargarfacturacompr_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_deshabilitar_total_editable_cargarfacturacompr_global" type='checkbox' value='<?php echo $cod_estado_deshabilitar_total_editable_cargarfacturacompr_global ?>' <?php if($cod_estado_deshabilitar_total_editable_cargarfacturacompr_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_deshabilitar_total_editable_cargarfacturacompr_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO CONTABILIDAD</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CONTABILIDAD</th>
			<td style='text-align:center'><input name='cod_estado_modulo_contabilidad_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_contabilidad_global" type='checkbox' value='<?php echo $cod_estado_modulo_contabilidad_global ?>' <?php if($cod_estado_modulo_contabilidad_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_contabilidad_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOVIMIENTO CONTABLE</th>
			<td style='text-align:center'><input name='cod_estado_mov_contable_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_mov_contable_global" type='checkbox' value='<?php echo $cod_estado_mov_contable_global ?>' <?php if($cod_estado_mov_contable_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_mov_contable_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PYG</th>
			<td style='text-align:center'><input name='cod_estado_pyg_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_pyg_global" type='checkbox' value='<?php echo $cod_estado_pyg_global ?>' <?php if($cod_estado_pyg_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_pyg_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR BALANCE</th>
			<td style='text-align:center'><input name='cod_estado_balance_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_balance_global" type='checkbox' value='<?php echo $cod_estado_balance_global ?>' <?php if($cod_estado_balance_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_balance_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO PUC (MODULO MOVIMIENTO CONTABLE EN VENTA - PUC GLOBAL)</th>
			<td style='text-align:center'><input name='cod_estado_modulo_puc_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_puc_global" type='checkbox' value='<?php echo $cod_estado_modulo_puc_global ?>' <?php if($cod_estado_modulo_puc_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_puc_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR GENERAR MOVIMIENTO CONTABLE AUTOMATICO</th>
			<td style='text-align:center'><input name='cod_estado_generar_movimiento_contable_automatico_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_generar_movimiento_contable_automatico_global" type='checkbox' value='<?php echo $cod_estado_generar_movimiento_contable_automatico_global ?>' <?php if($cod_estado_generar_movimiento_contable_automatico_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_generar_movimiento_contable_automatico_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOVIMIENTO CUENTA CONTABLE PERSONAL</th>
			<td style='text-align:center'><input name='cod_estado_movimiento_contable_cuenta_personal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_movimiento_contable_cuenta_personal_global" type='checkbox' value='<?php echo $cod_estado_movimiento_contable_cuenta_personal_global ?>' <?php if($cod_estado_movimiento_contable_cuenta_personal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_movimiento_contable_cuenta_personal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOVIMIENTO CONTABLE SIMPLE (SOLO CAJA GENERAL EFECTIVO - FNR)</th>
			<td style='text-align:center'><input name='cod_estado_movimiento_contable_caja_personal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_movimiento_contable_caja_personal_global" type='checkbox' value='<?php echo $cod_estado_movimiento_contable_caja_personal_global ?>' <?php if($cod_estado_movimiento_contable_caja_personal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_movimiento_contable_caja_personal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO COTIZACION</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR COTIZACION</th>
			<td style='text-align:center'><input name='cod_estado_modulo_cotizacion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_cotizacion_global" type='checkbox' value='<?php echo $cod_estado_modulo_cotizacion_global ?>' <?php if($cod_estado_modulo_cotizacion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_cotizacion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO CUENTAS</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO CUENTAS</th>
			<td style='text-align:center'><input name='cod_estado_modulo_cuenta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_cuenta_global" type='checkbox' value='<?php echo $cod_estado_modulo_cuenta_global ?>' <?php if($cod_estado_modulo_cuenta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_cuenta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CUENTAS POR COBRAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cuenta_cobrar_global" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_global ?>' <?php if($cod_estado_cuenta_cobrar_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cuenta_cobrar_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CUENTAS POR PAGAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_pagar_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cuenta_pagar_global" type='checkbox' value='<?php echo $cod_estado_cuenta_pagar_global ?>' <?php if($cod_estado_cuenta_pagar_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cuenta_pagar_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR EGRESOS</th>
			<td style='text-align:center'><input name='cod_estado_egreso_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_egreso_global" type='checkbox' value='<?php echo $cod_estado_egreso_global ?>' <?php if($cod_estado_egreso_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_egreso_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_modulo_tercero_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_tercero_global" type='checkbox' value='<?php echo $cod_estado_modulo_tercero_global ?>' <?php if($cod_estado_modulo_tercero_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_tercero_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ABONO GLOBAL CUENTA POR COBRAR</th>
			<td style='text-align:center'><input name='cod_estado_cuenta_cobrar_abono_glob_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cuenta_cobrar_abono_glob_global" type='checkbox' value='<?php echo $cod_estado_cuenta_cobrar_abono_glob_global ?>' <?php if($cod_estado_cuenta_cobrar_abono_glob_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cuenta_cobrar_abono_glob_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODIFICAR LA CUENTA POR PAGAR AL EDITAR LA FACTURA DE COMPRA</th>
			<td style='text-align:center'><input name='cod_estado_modulo_cuenta_pagar_abono_editar_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_cuenta_pagar_abono_editar_compra_global" type='checkbox' value='<?php echo $cod_estado_modulo_cuenta_pagar_abono_editar_compra_global ?>' <?php if($cod_estado_modulo_cuenta_pagar_abono_editar_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_cuenta_pagar_abono_editar_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO VENTAS</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PERMITIR VENTA PRECIO MINIMO</th>
			<td style='text-align:center'><input name='cod_estado_venta_precio_min_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_venta_precio_min_venta_global" type='checkbox' value='<?php echo $cod_estado_venta_precio_min_venta_global ?>' <?php if($cod_estado_venta_precio_min_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_venta_precio_min_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR COMENTARIO VENTA</th>
			<td style='text-align:center'><input name='cod_estado_comentario_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_comentario_venta_global" type='checkbox' value='<?php echo $cod_estado_comentario_venta_global ?>' <?php if($cod_estado_comentario_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_comentario_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR OBSERVACION VENTA TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_observacion_tercero_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_observacion_tercero_venta_global" type='checkbox' value='<?php echo $cod_estado_observacion_tercero_venta_global ?>' <?php if($cod_estado_observacion_tercero_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_observacion_tercero_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NO PERMITIR VENDER CON INV EN CERO</th>
			<td style='text-align:center'><input name='cod_estado_venta_prod_en_cero_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_venta_prod_en_cero_global" type='checkbox' value='<?php echo $cod_estado_venta_prod_en_cero_global ?>' <?php if($cod_estado_venta_prod_en_cero_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_venta_prod_en_cero_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">ORDENAMIENTO ALFABETICO IMP VENTA</th>
			<td style='text-align:center'><input name='cod_estado_ordenamiento_alfabetico_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_ordenamiento_alfabetico_venta_global" type='checkbox' value='<?php echo $cod_estado_ordenamiento_alfabetico_venta_global ?>' <?php if($cod_estado_ordenamiento_alfabetico_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_ordenamiento_alfabetico_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOSTRAR PRECIO COMPRA MOD VENTA</th>
			<td style='text-align:center'><input name='cod_estado_precio_compra_mod_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_precio_compra_mod_venta_global" type='checkbox' value='<?php echo $cod_estado_precio_compra_mod_venta_global ?>' <?php if($cod_estado_precio_compra_mod_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_precio_compra_mod_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR OPCION MODIFICAR UND VENTA UNA SOLA VEZ (VENDEDORES)</th>
			<td style='text-align:center'><input name='cod_estado_modificar_und_venta_una_sola_vez_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modificar_und_venta_una_sola_vez_global" type='checkbox' value='<?php echo $cod_estado_modificar_und_venta_una_sola_vez_global ?>' <?php if($cod_estado_modificar_und_venta_una_sola_vez_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modificar_und_venta_una_sola_vez_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR HORA EN VENTA TEMPORAL</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_hora_venta_temporal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_hora_venta_temporal_global" type='checkbox' value='<?php echo $cod_estado_habilitar_hora_venta_temporal_global ?>' <?php if($cod_estado_habilitar_hora_venta_temporal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_hora_venta_temporal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR VENTAS POR CATEGORIAS</th>
			<td style='text-align:center'><input name='cod_estado_venta_por_categoria_mod_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_venta_por_categoria_mod_venta_global" type='checkbox' value='<?php echo $cod_estado_venta_por_categoria_mod_venta_global ?>' <?php if($cod_estado_venta_por_categoria_mod_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_venta_por_categoria_mod_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR VENTAS POR CATEGORIAS MENU DESPLEGABLE</th>
			<td style='text-align:center'><input name='cod_estado_btn_categoria_desplegable_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_categoria_desplegable_global" type='checkbox' value='<?php echo $cod_estado_btn_categoria_desplegable_global ?>' <?php if($cod_estado_btn_categoria_desplegable_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_categoria_desplegable_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REVISADO (BTN VERDE) VENTA TEMPORAL</th>
			<td style='text-align:center'><input name='cod_estado_revisado_venta_temporal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_revisado_venta_temporal_global" type='checkbox' value='<?php echo $cod_estado_revisado_venta_temporal_global ?>' <?php if($cod_estado_revisado_venta_temporal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_revisado_venta_temporal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR COCINA</th>
			<td style='text-align:center'><input name='cod_estado_cocina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cocina_global" type='checkbox' value='<?php echo $cod_estado_cocina_global ?>' <?php if($cod_estado_cocina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center" id="cod_estado_cocina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIMBRE ENTRADA PEDIDO COCINA</th>
			<td style='text-align:center'><input name='cod_estado_timbre_entrada_pedido_temporal_cocina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_timbre_entrada_pedido_temporal_cocina_global" type='checkbox' value='<?php echo $cod_estado_timbre_entrada_pedido_temporal_cocina_global ?>' <?php if($cod_estado_timbre_entrada_pedido_temporal_cocina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_timbre_entrada_pedido_temporal_cocina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIMBRE SALIDA PEDIDO COCINA</th>
			<td style='text-align:center'><input name='cod_estado_timbre_salida_pedido_temporal_cocina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_timbre_salida_pedido_temporal_cocina_global" type='checkbox' value='<?php echo $cod_estado_timbre_salida_pedido_temporal_cocina_global ?>' <?php if($cod_estado_timbre_salida_pedido_temporal_cocina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_timbre_salida_pedido_temporal_cocina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMPRIMIR SUBPRODUCTO FACTURA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_subproducto_mostrar_imprimir_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subproducto_mostrar_imprimir_global" type='checkbox' value='<?php echo $cod_estado_subproducto_mostrar_imprimir_global ?>' <?php if($cod_estado_subproducto_mostrar_imprimir_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subproducto_mostrar_imprimir_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PRECIO VARIABLE SIEMPRE DISPONIBLE PARA ADMIN</th>
			<td style='text-align:center'><input name='cod_estado_precio_venta_variable_disponible_admin_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_precio_venta_variable_disponible_admin_global" type='checkbox' value='<?php echo $cod_estado_precio_venta_variable_disponible_admin_global ?>' <?php if($cod_estado_precio_venta_variable_disponible_admin_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_precio_venta_variable_disponible_admin_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR AGRUPAR POR PRODUCTO AL IMPRIMIR</th>
			<td style='text-align:center'><input name='cod_estado_agrupar_por_producto_imp_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_agrupar_por_producto_imp_global" type='checkbox' value='<?php echo $cod_estado_agrupar_por_producto_imp_global ?>' <?php if($cod_estado_agrupar_por_producto_imp_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_agrupar_por_producto_imp_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
			<th style="text-align:left; width:90%;">HABILITAR DESCUENTO AUTOMATICO POR CAMBIO DE PRECIO DE VENTA</th>
			<td style='text-align:center'><input name='cod_estado_descuento_automatico_por_cambio_precio_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_descuento_automatico_por_cambio_precio_venta_global" type='checkbox' value='<?php echo $cod_estado_descuento_automatico_por_cambio_precio_venta_global ?>' <?php if($cod_estado_descuento_automatico_por_cambio_precio_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_descuento_automatico_por_cambio_precio_venta_global<?php echo $cod_info_empresa ?>"></td>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DEVOLUCION BTN VERDE</th>
			<td style='text-align:center'><input name='cod_estado_devolucion_btn_verde_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_devolucion_btn_verde_global" type='checkbox' value='<?php echo $cod_estado_devolucion_btn_verde_global ?>' <?php if($cod_estado_devolucion_btn_verde_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_devolucion_btn_verde_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PARQUEADERO - HOTEL</th>
			<td style='text-align:center'><input name='cod_estado_parqueo_hotel_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_parqueo_hotel_global" type='checkbox' value='<?php echo $cod_estado_parqueo_hotel_global ?>' <?php if($cod_estado_parqueo_hotel_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_parqueo_hotel_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PARQUEADERO</th>
			<td style='text-align:center'><input name='cod_estado_parqueo_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_parqueo_global" type='checkbox' value='<?php echo $cod_estado_parqueo_global ?>' <?php if($cod_estado_parqueo_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_parqueo_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR HOTEL</th>
			<td style='text-align:center'><input name='cod_estado_hotel_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_hotel_global" type='checkbox' value='<?php echo $cod_estado_hotel_global ?>' <?php if($cod_estado_hotel_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_hotel_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">METODO DE ENVIO</th>
			<td style='text-align:center'><input name='cod_estado_tipo_metodo_envio_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_metodo_envio_global" type='checkbox' value='<?php echo $cod_estado_tipo_metodo_envio_global ?>' <?php if($cod_estado_tipo_metodo_envio_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_metodo_envio_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR VENTA POR DEPENDENCIA DE USUARIO</th>
			<td style='text-align:center'><input name='cod_estado_venta_dependencia_de_usuario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_venta_dependencia_de_usuario_global" type='checkbox' value='<?php echo $cod_estado_venta_dependencia_de_usuario_global ?>' <?php if($cod_estado_venta_dependencia_de_usuario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_venta_dependencia_de_usuario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MAPA GPS DOMICILIO FACTURA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_posicion_mapa_gps_pedidos_info_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_posicion_mapa_gps_pedidos_info_venta_global" type='checkbox' value='<?php echo $cod_estado_posicion_mapa_gps_pedidos_info_venta_global ?>' <?php if($cod_estado_posicion_mapa_gps_pedidos_info_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_posicion_mapa_gps_pedidos_info_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SERVICIO CAVA</th>
			<td style='text-align:center'><input name='cod_estado_servicio_cava_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_servicio_cava_global" type='checkbox' value='<?php echo $cod_estado_servicio_cava_global ?>' <?php if($cod_estado_servicio_cava_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_servicio_cava_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ESCOGER PRECIO VENTA AUTOMATICO MASIVO</th>
			<td style='text-align:center'><input name='cod_estado_escoger_precio_venta_automatico_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_escoger_precio_venta_automatico_global" type='checkbox' value='<?php echo $cod_estado_escoger_precio_venta_automatico_global ?>' <?php if($cod_estado_escoger_precio_venta_automatico_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_escoger_precio_venta_automatico_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO VENTA PARA ZAPATERIA (DETECCION AUTOAMTICA DE CREDITO POR EL RECIBIDO)</th>
			<td style='text-align:center'><input name='cod_estado_tipo_venta_zapateria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_venta_zapateria_global" type='checkbox' value='<?php echo $cod_estado_tipo_venta_zapateria_global ?>' <?php if($cod_estado_tipo_venta_zapateria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_venta_zapateria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FECHA ENTREGA DEL SERVICIO (ZAPATERIA)</th>
			<td style='text-align:center'><input name='cod_estado_fecha_entrega_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_fecha_entrega_venta_global" type='checkbox' value='<?php echo $cod_estado_fecha_entrega_venta_global ?>' <?php if($cod_estado_fecha_entrega_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_fecha_entrega_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR HORA ENTREGA DEL SERVICIO (ZAPATERIA)</th>
			<td style='text-align:center'><input name='cod_estado_hora_entrega_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_hora_entrega_venta_global" type='checkbox' value='<?php echo $cod_estado_hora_entrega_venta_global ?>' <?php if($cod_estado_hora_entrega_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_hora_entrega_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMPRIMIR VENTA ZAPATERIA NAV</th>
			<td style='text-align:center'><input name='cod_estado_btn_imprimir_venta_nav_zapateria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imprimir_venta_nav_zapateria_global" type='checkbox' value='<?php echo $cod_estado_btn_imprimir_venta_nav_zapateria_global ?>' <?php if($cod_estado_btn_imprimir_venta_nav_zapateria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imprimir_venta_nav_zapateria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMPRIMIR VENTA ZAPATERIA DRIV DIRECT</th>
			<td style='text-align:center'><input name='cod_estado_btn_imprimir_venta_direct_driv_zapateria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imprimir_venta_direct_driv_zapateria_global" type='checkbox' value='<?php echo $cod_estado_btn_imprimir_venta_direct_driv_zapateria_global ?>' <?php if($cod_estado_btn_imprimir_venta_direct_driv_zapateria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imprimir_venta_direct_driv_zapateria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ESCRIBIR NOMBRE CLIENTE VENTA</th>
			<td style='text-align:center'><input name='cod_estado_opcion_escribir_nombre_cliente_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_opcion_escribir_nombre_cliente_venta_global" type='checkbox' value='<?php echo $cod_estado_opcion_escribir_nombre_cliente_venta_global ?>' <?php if($cod_estado_opcion_escribir_nombre_cliente_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_opcion_escribir_nombre_cliente_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FILTRO APLICACION TV CHEF - BARTENDER - JUGUERIA</th>
			<td style='text-align:center'><input name='cod_estado_filtro_aplicacion_chef_bartender_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_filtro_aplicacion_chef_bartender_global" type='checkbox' value='<?php echo $cod_estado_filtro_aplicacion_chef_bartender_global ?>' <?php if($cod_estado_filtro_aplicacion_chef_bartender_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_filtro_aplicacion_chef_bartender_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ABONOS EN EDITAR VENTA</th>
			<td style='text-align:center'><input name='cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global" type='checkbox' value='<?php echo $cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global ?>' <?php if($cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ABRIR CAJON MONEDERO (DRIVER DIREC)</th>
			<td style='text-align:center'><input name='cod_estado_abrir_cajon_monedero_driv_direct_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_abrir_cajon_monedero_driv_direct_global" type='checkbox' value='<?php echo $cod_estado_abrir_cajon_monedero_driv_direct_global ?>' <?php if($cod_estado_abrir_cajon_monedero_driv_direct_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_abrir_cajon_monedero_driv_direct_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR LIMITE EN VENTA TEMPORAL POS (AL PASAR EL LIMITE DE 212.000 SE VUELVE FACTURA ELECTRONICA)</th>
			<td style='text-align:center'><input name='cod_estado_limite_venta_pos_factura_electronica_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_limite_venta_pos_factura_electronica_global" type='checkbox' value='<?php echo $cod_estado_limite_venta_pos_factura_electronica_global ?>' <?php if($cod_estado_limite_venta_pos_factura_electronica_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_limite_venta_pos_factura_electronica_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOSTRAR COMENTARIO EN EL IMPRIMIBLE DE LA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_comentario_venta_mostrar_imprimir_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_comentario_venta_mostrar_imprimir_global" type='checkbox' value='<?php echo $cod_estado_comentario_venta_mostrar_imprimir_global ?>' <?php if($cod_estado_comentario_venta_mostrar_imprimir_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_comentario_venta_mostrar_imprimir_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOSTRAR PRODUCTOS AGRUPADOS EN EL IMPRIMIBLE DE LA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_mostrar_agrupado_produc_repventa_imprimir_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_mostrar_agrupado_produc_repventa_imprimir_global" type='checkbox' value='<?php echo $cod_estado_mostrar_agrupado_produc_repventa_imprimir_global ?>' <?php if($cod_estado_mostrar_agrupado_produc_repventa_imprimir_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_mostrar_agrupado_produc_repventa_imprimir_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUMAR UNIDADES DE PRODUCTO REPETIDO EN VENTA TEMPORAL</th>
			<td style='text-align:center'><input name='cod_estado_sumar_producto_repetido_venta_temporal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_sumar_producto_repetido_venta_temporal_global" type='checkbox' value='<?php echo $cod_estado_sumar_producto_repetido_venta_temporal_global ?>' <?php if($cod_estado_sumar_producto_repetido_venta_temporal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_sumar_producto_repetido_venta_temporal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPOS DE PRECIOS MASIVOS (EDICION FACTURA VENTA - CAMBIAR TODOS LOS PRECIOS AL PRESIONAR BOTON PV1-PV2-PV3-PV4-PV4)</th>
			<td style='text-align:center'><input name='cod_estado_edit_precio_venta_btn_factura_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_edit_precio_venta_btn_factura_venta_global" type='checkbox' value='<?php echo $cod_estado_edit_precio_venta_btn_factura_venta_global ?>' <?php if($cod_estado_edit_precio_venta_btn_factura_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_edit_precio_venta_btn_factura_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR EN VENTA MANUAL (SI EL RESULTADO DE LA BUSQUEDA DA UN SOLO RESULTADO. AUTOMATICAMENTE SE INSERTA EL REGISTRO)</th>
			<td style='text-align:center'><input name='cod_estado_busqueda_venta_manual_resultado_unico_redirect_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_busqueda_venta_manual_resultado_unico_redirect_global" type='checkbox' value='<?php echo $cod_estado_busqueda_venta_manual_resultado_unico_redirect_global ?>' <?php if($cod_estado_busqueda_venta_manual_resultado_unico_redirect_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_busqueda_venta_manual_resultado_unico_redirect_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SOPORTE EN FACTURA DE VENTA (ADJUNTAR ARCHIVO)</th>
			<td style='text-align:center'><input name='cod_estado_soporte_factura_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_soporte_factura_venta_global" type='checkbox' value='<?php echo $cod_estado_soporte_factura_venta_global ?>' <?php if($cod_estado_soporte_factura_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_soporte_factura_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CALCULO AUTOMATICO PRECIO COMPRA DEL PRODUCTO CUANDO ESTA EN PVAR (AJAX VENTA TEMPORAL - SE CALCULA A PARTIR DEL PRECIO VENTA - JAVENIDA)</th>
			<td style='text-align:center'><input name='cod_estado_pvar_calculo_automatico_pcompra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_pvar_calculo_automatico_pcompra_global" type='checkbox' value='<?php echo $cod_estado_pvar_calculo_automatico_pcompra_global ?>' <?php if($cod_estado_pvar_calculo_automatico_pcompra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_pvar_calculo_automatico_pcompra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOSTRAR VENTA POR CAJA (CASTLIC)</th>
			<td style='text-align:center'><input name='cod_estado_mostrar_venta_por_caja_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_mostrar_venta_por_caja_global" type='checkbox' value='<?php echo $cod_estado_mostrar_venta_por_caja_global ?>' <?php if($cod_estado_mostrar_venta_por_caja_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_mostrar_venta_por_caja_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMPRIMIR FACTURA VENTA POR CAJA CARTA PDF (CASTLIC)</th>
			<td style='text-align:center'><input name='cod_estado_btn_imp_nav_carta_por_caja_pdf_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imp_nav_carta_por_caja_pdf_global" type='checkbox' value='<?php echo $cod_estado_btn_imp_nav_carta_por_caja_pdf_global ?>' <?php if($cod_estado_btn_imp_nav_carta_por_caja_pdf_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imp_nav_carta_por_caja_pdf_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR IMPRIMIR FACTURA RESMISION POR CAJA CARTA PDF (CASTLIC)</th>
			<td style='text-align:center'><input name='cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global" type='checkbox' value='<?php echo $cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global ?>' <?php if($cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FIRMA BODEGUERO IMPRESION (CASTLIC)</th>
			<td style='text-align:center'><input name='cod_estado_espacio_firma_bodega_imprimir_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_espacio_firma_bodega_imprimir_global" type='checkbox' value='<?php echo $cod_estado_espacio_firma_bodega_imprimir_global ?>' <?php if($cod_estado_espacio_firma_bodega_imprimir_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_espacio_firma_bodega_imprimir_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">FIRMA TRANSPORTADOR IMPRESION (CASTLIC) </th>
			<td style='text-align:center'><input name='cod_estado_espacio_firma_transportador_imprimir_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_espacio_firma_transportador_imprimir_global" type='checkbox' value='<?php echo $cod_estado_espacio_firma_transportador_imprimir_global ?>' <?php if($cod_estado_espacio_firma_transportador_imprimir_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_espacio_firma_transportador_imprimir_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DOMICILIARIO VENTA TEMP</th>
			<td style='text-align:center'><input name='cod_estado_domiciliario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_domiciliario_global" type='checkbox' value='<?php echo $cod_estado_domiciliario_global ?>' <?php if($cod_estado_domiciliario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_domiciliario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR FORZAR DOS DECIMALES UND VENTA TEMP (STEP HTML)</th>
			<td style='text-align:center'><input name='cod_estado_forzar_dos_decimales_und_venta_step_html_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_forzar_dos_decimales_und_venta_step_html_global" type='checkbox' value='<?php echo $cod_estado_forzar_dos_decimales_und_venta_step_html_global ?>' <?php if($cod_estado_forzar_dos_decimales_und_venta_step_html_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_forzar_dos_decimales_und_venta_step_html_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOSTRAR TIRILLA FACTURA VENTA ESTILO MODELO VIEJO CAMPOS SEPARADOS (AVENIDA)</th>
			<td style='text-align:center'><input name='cod_estado_modelo_factura_tirilla_avenidajuan_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modelo_factura_tirilla_avenidajuan_global" type='checkbox' value='<?php echo $cod_estado_modelo_factura_tirilla_avenidajuan_global ?>' <?php if($cod_estado_modelo_factura_tirilla_avenidajuan_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modelo_factura_tirilla_avenidajuan_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MOSTRAR DESCUENTO EN TIRILLA VENTA POR MODIFICACION MANUAL AL PRECIO DE VENTA O POR CAMBIO EN LOS TIPOS DE PRECIOS (PV1 - PV2 - PV3 ETC)</th>
			<td style='text-align:center'><input name='cod_estado_mostrar_descuento_manual_factura_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_mostrar_descuento_manual_factura_venta_global" type='checkbox' value='<?php echo $cod_estado_mostrar_descuento_manual_factura_venta_global ?>' <?php if($cod_estado_mostrar_descuento_manual_factura_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_mostrar_descuento_manual_factura_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CONVERTIR UNIDADES A CAJA MOSTRAR AL IMPRIMIR (CASTLIC)</th>
			<td style='text-align:center'><input name='cod_estado_converir_und_a_caja_mostrar_imprimir_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_converir_und_a_caja_mostrar_imprimir_global" type='checkbox' value='<?php echo $cod_estado_converir_und_a_caja_mostrar_imprimir_global ?>' <?php if($cod_estado_converir_und_a_caja_mostrar_imprimir_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_converir_und_a_caja_mostrar_imprimir_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR AVISO ALERTA TIMBRE VENDEDOR PEDIDO COCINA</th>
			<td style='text-align:center'><input name='cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global" type='checkbox' value='<?php echo $cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global ?>' <?php if($cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DIA SIN IVA</th>
			<td style='text-align:center'><input name='cod_estado_dia_sin_iva_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_dia_sin_iva_global" type='checkbox' value='<?php echo $cod_estado_dia_sin_iva_global ?>' <?php if($cod_estado_dia_sin_iva_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_dia_sin_iva_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PUNTOS REDIMIBLES VENTA</th>
			<td style='text-align:center'><input name='cod_estado_puntos_redimibles_campanya_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_puntos_redimibles_campanya_global" type='checkbox' value='<?php echo $cod_estado_puntos_redimibles_campanya_global ?>' <?php if($cod_estado_puntos_redimibles_campanya_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_puntos_redimibles_campanya_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PUNTOS REDIMIBLES CAMPAÑA RECARGA (URBAN STREA)</th>
			<td style='text-align:center'><input name='cod_estado_puntos_redimibles_campanya_recarga_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_puntos_redimibles_campanya_recarga_global" type='checkbox' value='<?php echo $cod_estado_puntos_redimibles_campanya_recarga_global ?>' <?php if($cod_estado_puntos_redimibles_campanya_recarga_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_puntos_redimibles_campanya_recarga_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SALDO RECARGA (URBAN STREA)</th>
			<td style='text-align:center'><input name='cod_estado_saldo_recarga_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_saldo_recarga_global" type='checkbox' value='<?php echo $cod_estado_saldo_recarga_global ?>' <?php if($cod_estado_saldo_recarga_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_saldo_recarga_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBPRODUCTO CUENTA SERVICIO (URBAN STREA)</th>
			<td style='text-align:center'><input name='cod_estado_subproducto_cuenta_servicio_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subproducto_cuenta_servicio_global" type='checkbox' value='<?php echo $cod_estado_subproducto_cuenta_servicio_global ?>' <?php if($cod_estado_subproducto_cuenta_servicio_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subproducto_cuenta_servicio_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR DESCUENTO EN TIRILLA DE IMPRESION VENTA</th>
			<td style='text-align:center'><input name='cod_estado_deshabilitar_descuento_impresion_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_deshabilitar_descuento_impresion_venta_global" type='checkbox' value='<?php echo $cod_estado_deshabilitar_descuento_impresion_venta_global ?>' <?php if($cod_estado_deshabilitar_descuento_impresion_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_deshabilitar_descuento_impresion_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR VERIFICAR UNIDADES DE VENTA EN CERO VENTA</th>
			<td style='text-align:center'><input name='cod_estado_verificar_unidad_venta_en_cero_venta_temp_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_verificar_unidad_venta_en_cero_venta_temp_global" type='checkbox' value='<?php echo $cod_estado_verificar_unidad_venta_en_cero_venta_temp_global ?>' <?php if($cod_estado_verificar_unidad_venta_en_cero_venta_temp_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_verificar_unidad_venta_en_cero_venta_temp_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR VERIFICAR PRECIO DE VENTA EN CERO VENTA</th>
			<td style='text-align:center'><input name='cod_estado_verificar_precio_venta_en_cero_venta_temp_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_verificar_precio_venta_en_cero_venta_temp_global" type='checkbox' value='<?php echo $cod_estado_verificar_precio_venta_en_cero_venta_temp_global ?>' <?php if($cod_estado_verificar_precio_venta_en_cero_venta_temp_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_verificar_precio_venta_en_cero_venta_temp_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR RETE FUENTE VENTA</th>
			<td style='text-align:center'><input name='cod_estado_retefuente_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_retefuente_global" type='checkbox' value='<?php echo $cod_estado_retefuente_global ?>' <?php if($cod_estado_retefuente_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_retefuente_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR RETE ICA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_reteica_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reteica_global" type='checkbox' value='<?php echo $cod_estado_reteica_global ?>' <?php if($cod_estado_reteica_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reteica_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR RETE IVA VENTA</th>
			<td style='text-align:center'><input name='cod_estado_reteiva_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reteiva_global" type='checkbox' value='<?php echo $cod_estado_reteiva_global ?>' <?php if($cod_estado_reteiva_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reteiva_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO PREVENTA</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PREVENTA</th>
			<td style='text-align:center'><input name='cod_estado_preventa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_preventa_global" type='checkbox' value='<?php echo $cod_estado_preventa_global ?>' <?php if($cod_estado_preventa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_preventa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PROPINA</th>
			<td style='text-align:center'><input name='cod_estado_propina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_propina_global" type='checkbox' value='<?php echo $cod_estado_propina_global ?>' <?php if($cod_estado_propina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_propina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR DIVIDIR FACTURA PREVENTA</th>
			<td style='text-align:center'><input name='cod_estado_dividir_factura_caja_mesa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_dividir_factura_caja_mesa_global" type='checkbox' value='<?php echo $cod_estado_dividir_factura_caja_mesa_global ?>' <?php if($cod_estado_dividir_factura_caja_mesa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_dividir_factura_caja_mesa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CHECK IMPRESORA PREVENTA</th>
			<td style='text-align:center'><input name='cod_estado_check_imp_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_check_imp_global" type='checkbox' value='<?php echo $cod_estado_check_imp_global ?>' <?php if($cod_estado_check_imp_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_check_imp_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CONCEPTO DESCUENTO PREVENTA NEGATIVO</th>
			<td style='text-align:center'><input name='cod_estado_descuento_concepto_venta_neg_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_descuento_concepto_venta_neg_global" type='checkbox' value='<?php echo $cod_estado_descuento_concepto_venta_neg_global ?>' <?php if($cod_estado_descuento_concepto_venta_neg_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_descuento_concepto_venta_neg_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR BOTON IMPRIMIR TICKET PREVENTA PARA COCINA</th>
			<td style='text-align:center'><input name='cod_estado_btn_imprimir_preventa_cocina_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imprimir_preventa_cocina_global" type='checkbox' value='<?php echo $cod_estado_btn_imprimir_preventa_cocina_global ?>' <?php if($cod_estado_btn_imprimir_preventa_cocina_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imprimir_preventa_cocina_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO SECTOR SALUD</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CAMPOS SECTOR SALUD</th>
			<td style='text-align:center'><input name='cod_estado_campos_sector_salud_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_campos_sector_salud_global" type='checkbox' value='<?php echo $cod_estado_campos_sector_salud_global ?>' <?php if($cod_estado_campos_sector_salud_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_campos_sector_salud_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PERFIL SOCIODEMOGRAFICO</th>
			<td style='text-align:center'><input name='cod_estado_perfil_sociodemografico_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_perfil_sociodemografico_global" type='checkbox' value='<?php echo $cod_estado_perfil_sociodemografico_global ?>' <?php if($cod_estado_perfil_sociodemografico_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_perfil_sociodemografico_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CAMPOS FACTURA ELECTRONICA SECTOR SALUD (HLAB)</th>
			<td style='text-align:center'><input name='cod_estado_factura_electronica_sector_salud_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_factura_electronica_sector_salud_global" type='checkbox' value='<?php echo $cod_estado_factura_electronica_sector_salud_global ?>' <?php if($cod_estado_factura_electronica_sector_salud_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_factura_electronica_sector_salud_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO CAJAS Y MESAS VIRTUALES</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MESAS CAJAS VISUALES</th>
			<td style='text-align:center'><input name='cod_estado_cantidad_caja_mesa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cantidad_caja_mesa_global" type='checkbox' value='<?php echo $cod_estado_cantidad_caja_mesa_global ?>' <?php if($cod_estado_cantidad_caja_mesa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cantidad_caja_mesa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ORDENAR CAJA MESA POR FECHA MODIFICACION</th>
			<td style='text-align:center'><input name='cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global" type='checkbox' value='<?php echo $cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global ?>' <?php if($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PRIORIDAD CAJA MESA</th>
			<td style='text-align:center'><input name='cod_estado_prioridad_caja_mesa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_prioridad_caja_mesa_global" type='checkbox' value='<?php echo $cod_estado_prioridad_caja_mesa_global ?>' <?php if($cod_estado_prioridad_caja_mesa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_prioridad_caja_mesa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MARCADO REVISADO CAJA MESA</th>
			<td style='text-align:center'><input name='cod_estado_marcado_revisado_caja_mesa_venta_temporal_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_marcado_revisado_caja_mesa_venta_temporal_global" type='checkbox' value='<?php echo $cod_estado_marcado_revisado_caja_mesa_venta_temporal_global ?>' <?php if($cod_estado_marcado_revisado_caja_mesa_venta_temporal_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_marcado_revisado_caja_mesa_venta_temporal_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">NOTAS CREDITO Y NOTAS DEBITO</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO NOTA CREDITO (VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_nota_credito_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nota_credito_global" type='checkbox' value='<?php echo $cod_estado_nota_credito_global ?>' <?php if($cod_estado_nota_credito_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nota_credito_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO NOTA DEBITO (COMPRA)</th>
			<td style='text-align:center'><input name='cod_estado_nota_debito_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nota_debito_global" type='checkbox' value='<?php echo $cod_estado_nota_debito_global ?>' <?php if($cod_estado_nota_debito_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nota_debito_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO ALQUILER - RENTA (VENTA FERRE LYS)</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO ALQUILER - RENTA (VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_renta_alquiler_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_renta_alquiler_global" type='checkbox' value='<?php echo $cod_estado_renta_alquiler_global ?>' <?php if($cod_estado_renta_alquiler_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_renta_alquiler_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO REPORTES</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO REPORTE</th>
			<td style='text-align:center'><input name='cod_estado_modulo_reporte_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_reporte_global" type='checkbox' value='<?php echo $cod_estado_modulo_reporte_global ?>' <?php if($cod_estado_modulo_reporte_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_reporte_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR HORA REPORTE VENTA</th>
			<td style='text-align:center'><input name='cod_estado_hora_reporte_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_hora_reporte_venta_global" type='checkbox' value='<?php echo $cod_estado_hora_reporte_venta_global ?>' <?php if($cod_estado_hora_reporte_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_hora_reporte_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR GRAFICOS Y ESTADISTICAS</th>
			<td style='text-align:center'><input name='cod_estado_grafico_estadistico_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_grafico_estadistico_global" type='checkbox' value='<?php echo $cod_estado_grafico_estadistico_global ?>' <?php if($cod_estado_grafico_estadistico_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_grafico_estadistico_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE COMPRA POR PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_reporte_compra_por_producto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reporte_compra_por_producto_global" type='checkbox' value='<?php echo $cod_estado_reporte_compra_por_producto_global ?>' <?php if($cod_estado_reporte_compra_por_producto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reporte_compra_por_producto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE VENTA CON PRODUCTOS</th>
			<td style='text-align:center'><input name='cod_estado_imprimir_reporte_venta_con_productos_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_imprimir_reporte_venta_con_productos_global" type='checkbox' value='<?php echo $cod_estado_imprimir_reporte_venta_con_productos_global ?>' <?php if($cod_estado_imprimir_reporte_venta_con_productos_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_imprimir_reporte_venta_con_productos_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE FECHA PAGO FACTURA EN CREDITO (ALERTA GIMN)</th>
			<td style='text-align:center'><input name='cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global" type='checkbox' value='<?php echo $cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global ?>' <?php if($cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE FECHA ENTREGA FACTURA EN CREDITO (ALERTA ZAPATERIA)</th>
			<td style='text-align:center'><input name='cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global" type='checkbox' value='<?php echo $cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global ?>' <?php if($cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE MANTENIMIENTO</th>
			<td style='text-align:center'><input name='cod_estado_reporte_mantenimiento_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reporte_mantenimiento_global" type='checkbox' value='<?php echo $cod_estado_reporte_mantenimiento_global ?>' <?php if($cod_estado_reporte_mantenimiento_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reporte_mantenimiento_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR DIA</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_venta_diaria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_venta_diaria_global" type='checkbox' value='<?php echo $cod_estado_subreporte_venta_diaria_global ?>' <?php if($cod_estado_subreporte_venta_diaria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_venta_diaria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR MES</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_venta_mensual_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_venta_mensual_global" type='checkbox' value='<?php echo $cod_estado_subreporte_venta_mensual_global ?>' <?php if($cod_estado_subreporte_venta_mensual_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_venta_mensual_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR AÑO</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_venta_anual_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_venta_anual_global" type='checkbox' value='<?php echo $cod_estado_subreporte_venta_anual_global ?>' <?php if($cod_estado_subreporte_venta_anual_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_venta_anual_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE TOTAL VENTA</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_totalventa_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_totalventa_global" type='checkbox' value='<?php echo $cod_estado_subreporte_totalventa_global ?>' <?php if($cod_estado_subreporte_totalventa_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_totalventa_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE IMPUESTOS VENTA</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_impuestos_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_impuestos_global" type='checkbox' value='<?php echo $cod_estado_subreporte_impuestos_global ?>' <?php if($cod_estado_subreporte_impuestos_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_impuestos_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTAS GENERALES</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasgenerales_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasgenerales_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasgenerales_global ?>' <?php if($cod_estado_subreporte_ventasgenerales_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasgenerales_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTAS POR FACTURA</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasporfacturas_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasporfacturas_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasporfacturas_global ?>' <?php if($cod_estado_subreporte_ventasporfacturas_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasporfacturas_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR TIPO DE FACTURA</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasportipofacturas_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasportipofacturas_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasportipofacturas_global ?>' <?php if($cod_estado_subreporte_ventasportipofacturas_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasportipofacturas_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR DEPENDENCIA</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventaspordependencia_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventaspordependencia_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventaspordependencia_global ?>' <?php if($cod_estado_subreporte_ventaspordependencia_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventaspordependencia_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR TIPO DE PRODUCTO</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasportipoproducto_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasportipoproducto_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasportipoproducto_global ?>' <?php if($cod_estado_subreporte_ventasportipoproducto_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasportipoproducto_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR VENDEDOR</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasporvendedor_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasporvendedor_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasporvendedor_global ?>' <?php if($cod_estado_subreporte_ventasporvendedor_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasporvendedor_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR PROPINA VENDEDOR</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasporpropinavendedor_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasporpropinavendedor_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasporpropinavendedor_global ?>' <?php if($cod_estado_subreporte_ventasporpropinavendedor_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasporpropinavendedor_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR SUBREPORTE VENTA POR CREDITO CLIENTE</th>
			<td style='text-align:center'><input name='cod_estado_subreporte_ventasporcreditocliente_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_subreporte_ventasporcreditocliente_global" type='checkbox' value='<?php echo $cod_estado_subreporte_ventasporcreditocliente_global ?>' <?php if($cod_estado_subreporte_ventasporcreditocliente_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_subreporte_ventasporcreditocliente_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE POR CAJA VIRTUAL</th>
			<td style='text-align:center'><input name='cod_estado_reporte_por_caja_virtual_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reporte_por_caja_virtual_global" type='checkbox' value='<?php echo $cod_estado_reporte_por_caja_virtual_global ?>' <?php if($cod_estado_reporte_por_caja_virtual_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reporte_por_caja_virtual_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR REPORTE VENTA TOTAL COMPRA CAJA REGISTRADORA (CARN HYE)</th>
			<td style='text-align:center'><input name='cod_estado_reporte_venta_total_compra_caja_registradora_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_reporte_venta_total_compra_caja_registradora_global" type='checkbox' value='<?php echo $cod_estado_reporte_venta_total_compra_caja_registradora_global ?>' <?php if($cod_estado_reporte_venta_total_compra_caja_registradora_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_reporte_venta_total_compra_caja_registradora_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO OTROS</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO ADMIN</th>
			<td style='text-align:center'><input name='cod_estado_modulo_admin_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_admin_global" type='checkbox' value='<?php echo $cod_estado_modulo_admin_global ?>' <?php if($cod_estado_modulo_admin_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_admin_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ORDEN DE PRODUCCION</th>
			<td style='text-align:center'><input name='cod_estado_modulo_orden_produccion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_modulo_orden_produccion_global" type='checkbox' value='<?php echo $cod_estado_modulo_orden_produccion_global ?>' <?php if($cod_estado_modulo_orden_produccion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_modulo_orden_produccion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CITAS</th>
			<td style='text-align:center'><input name='cod_estado_cita_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cita_global" type='checkbox' value='<?php echo $cod_estado_cita_global ?>' <?php if($cod_estado_cita_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cita_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR USUARIO</th>
			<td style='text-align:center'><input name='cod_estado_usuario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_usuario_global" type='checkbox' value='<?php echo $cod_estado_usuario_global ?>' <?php if($cod_estado_usuario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_usuario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR RESOLUCION</th>
			<td style='text-align:center'><input name='cod_estado_resolucion_factura_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_resolucion_factura_global" type='checkbox' value='<?php echo $cod_estado_resolucion_factura_global ?>' <?php if($cod_estado_resolucion_factura_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_resolucion_factura_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TERCERO POR USUARIO APPPREST</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_tercero_por_usuario_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_tercero_por_usuario_global" type='checkbox' value='<?php echo $cod_estado_habilitar_tercero_por_usuario_global ?>' <?php if($cod_estado_habilitar_tercero_por_usuario_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_tercero_por_usuario_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CIERRE CAJA</th>
			<td style='text-align:center'><input name='cod_estado_cierre_caja_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cierre_caja_global" type='checkbox' value='<?php echo $cod_estado_cierre_caja_global ?>' <?php if($cod_estado_cierre_caja_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cierre_caja_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PLAN SEPARE</th>
			<td style='text-align:center'><input name='cod_estado_plan_separe_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_plan_separe_global" type='checkbox' value='<?php echo $cod_estado_plan_separe_global ?>' <?php if($cod_estado_plan_separe_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_plan_separe_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO ADMIN</th>
			<td style='text-align:center'><input name='cod_estado_admin_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_admin_global" type='checkbox' value='<?php echo $cod_estado_admin_global ?>' <?php if($cod_estado_admin_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_admin_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ELIMINAR</th>
			<td style='text-align:center'><input name='cod_estado_eliminar_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_eliminar_global" type='checkbox' value='<?php echo $cod_estado_eliminar_global ?>' <?php if($cod_estado_eliminar_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_eliminar_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PLAN ACCION</th>
			<td style='text-align:center'><input name='cod_estado_plan_accion_correcion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_plan_accion_correcion_global" type='checkbox' value='<?php echo $cod_estado_plan_accion_correcion_global ?>' <?php if($cod_estado_plan_accion_correcion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_plan_accion_correcion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR POSICION GPS PEDIDO CLIENTE</th>
			<td style='text-align:center'><input name='cod_estado_posicion_gps_pedidos_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_posicion_gps_pedidos_global" type='checkbox' value='<?php echo $cod_estado_posicion_gps_pedidos_global ?>' <?php if($cod_estado_posicion_gps_pedidos_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_posicion_gps_pedidos_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CONSULTAR PRECIO PRODUCTOS (EXTERNO)</th>
			<td style='text-align:center'><input name='cod_estado_consultar_precios_extern_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_consultar_precios_extern_global" type='checkbox' value='<?php echo $cod_estado_consultar_precios_extern_global ?>' <?php if($cod_estado_consultar_precios_extern_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_consultar_precios_extern_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NOTAS Y OBSERVACIONES</th>
			<td style='text-align:center'><input name='cod_estado_nota_observacion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nota_observacion_global" type='checkbox' value='<?php echo $cod_estado_nota_observacion_global ?>' <?php if($cod_estado_nota_observacion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nota_observacion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR TIPO DE ROLES</th>
			<td style='text-align:center'><input name='cod_estado_tipo_roles_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_roles_global" type='checkbox' value='<?php echo $cod_estado_tipo_roles_global ?>' <?php if($cod_estado_tipo_roles_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_roles_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR PROMOCION (VISITANTE EXTERN)</th>
			<td style='text-align:center'><input name='cod_estado_promocion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_promocion_global" type='checkbox' value='<?php echo $cod_estado_promocion_global ?>' <?php if($cod_estado_promocion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_promocion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO IMPRESORAS</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR LOGO FACTURA VENTA (IMPRIMIR)</th>
			<td style='text-align:center'><input name='cod_estado_img_impimir_factura_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_img_impimir_factura_global" type='checkbox' value='<?php echo $cod_estado_img_impimir_factura_global ?>' <?php if($cod_estado_img_impimir_factura_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_img_impimir_factura_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR VENTA NAVEGADOR</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_venta_nav_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_venta_nav_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_venta_nav_global ?>' <?php if($cod_estado_habilitar_btn_imp_venta_nav_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_venta_nav_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR VENTA DIRECTA DRIVER</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_venta_direct_driv_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_venta_direct_driv_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_venta_direct_driv_global ?>' <?php if($cod_estado_habilitar_btn_imp_venta_direct_driv_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_venta_direct_driv_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR VENTA CARTA</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_nav_carta_pdf_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_nav_carta_pdf_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_nav_carta_pdf_global ?>' <?php if($cod_estado_habilitar_btn_imp_nav_carta_pdf_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_nav_carta_pdf_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR PREVENTA TODO NAVEGADOR</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_preventodo_nav_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_preventodo_nav_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_preventodo_nav_global ?>' <?php if($cod_estado_habilitar_btn_imp_preventodo_nav_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_preventodo_nav_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR PREVENTA TODO DIRECTA DRIVER</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_preventodo_direct_driv_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_preventodo_direct_driv_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_preventodo_direct_driv_global ?>' <?php if($cod_estado_habilitar_btn_imp_preventodo_direct_driv_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_preventodo_direct_driv_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR COCINA NAVEGADOR</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_cocina_nav_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_cocina_nav_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_cocina_nav_global ?>' <?php if($cod_estado_habilitar_btn_imp_cocina_nav_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_cocina_nav_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR COCINA DIRECTA DRIVER </th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_cocina_direct_driv_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_cocina_direct_driv_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_cocina_direct_driv_global ?>' <?php if($cod_estado_habilitar_btn_imp_cocina_direct_driv_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_cocina_direct_driv_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR REPORTE VENTA NAVEGADOR</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_repventa_consol_nav_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_repventa_consol_nav_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_repventa_consol_nav_global ?>' <?php if($cod_estado_habilitar_btn_imp_repventa_consol_nav_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_repventa_consol_nav_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">DESHABILITAR BOTON IMPRIMIR REPORTE VENTA DIRECTA DRIVER</th>
			<td style='text-align:center'><input name='cod_estado_habilitar_btn_imp_repventa_direct_driv_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_habilitar_btn_imp_repventa_direct_driv_global" type='checkbox' value='<?php echo $cod_estado_habilitar_btn_imp_repventa_direct_driv_global ?>' <?php if($cod_estado_habilitar_btn_imp_repventa_direct_driv_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_habilitar_btn_imp_repventa_direct_driv_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR HABILITAR QR ENCUESTA</th>
			<td style='text-align:center'><input name='cod_estado_encuesta_experiencia_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_encuesta_experiencia_compra_global" type='checkbox' value='<?php echo $cod_estado_encuesta_experiencia_compra_global ?>' <?php if($cod_estado_encuesta_experiencia_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_encuesta_experiencia_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR BOTON IMPRIMIR ORDEN COMPRA NAVEGADOR (MODULO VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_btn_imp_pos_nav_orden_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imp_pos_nav_orden_compra_global" type='checkbox' value='<?php echo $cod_estado_btn_imp_pos_nav_orden_compra_global ?>' <?php if($cod_estado_btn_imp_pos_nav_orden_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imp_pos_nav_orden_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR BOTON IMPRIMIR ORDEN COMPRA DIRECTA DRIVER (MODULO VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_btn_imp_pos_direct_driv_orden_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imp_pos_direct_driv_orden_compra_global" type='checkbox' value='<?php echo $cod_estado_btn_imp_pos_direct_driv_orden_compra_global ?>' <?php if($cod_estado_btn_imp_pos_direct_driv_orden_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imp_pos_direct_driv_orden_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR BOTON IMPRIMIR ORDEN COMPRA CARTA PDF (MODULO VENTA)</th>
			<td style='text-align:center'><input name='cod_estado_btn_imp_carta_nav_orden_compra_pdf_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_btn_imp_carta_nav_orden_compra_pdf_global" type='checkbox' value='<?php echo $cod_estado_btn_imp_carta_nav_orden_compra_pdf_global ?>' <?php if($cod_estado_btn_imp_carta_nav_orden_compra_pdf_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_btn_imp_carta_nav_orden_compra_pdf_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO STICKER CODIGO DE BARRAS</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR STICKER BARRAS</th>
			<td style='text-align:center'><input name='cod_estado_sticker_barras_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_sticker_barras_global" type='checkbox' value='<?php echo $cod_estado_sticker_barras_global ?>' <?php if($cod_estado_sticker_barras_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_sticker_barras_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CODIFICACION P.COMPRA STICKER</th>
			<td style='text-align:center'><input name='cod_estado_codif_precio_compra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_codif_precio_compra_global" type='checkbox' value='<?php echo $cod_estado_codif_precio_compra_global ?>' <?php if($cod_estado_codif_precio_compra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_codif_precio_compra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR CODIFICACION P.VENTA STICKER</th>
			<td style='text-align:center'><input name='cod_estado_codif_precio_venta_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_codif_precio_venta_global" type='checkbox' value='<?php echo $cod_estado_codif_precio_venta_global ?>' <?php if($cod_estado_codif_precio_venta_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_codif_precio_venta_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR P.COMPRA NO CODIF</th>
			<td style='text-align:center'><input name='cod_estado_nocodif_precio_compra_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nocodif_precio_compra_sticker_global" type='checkbox' value='<?php echo $cod_estado_nocodif_precio_compra_sticker_global ?>' <?php if($cod_estado_nocodif_precio_compra_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nocodif_precio_compra_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR P.VENTA NO CODIF</th>
			<td style='text-align:center'><input name='cod_estado_nocodif_precio_venta_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nocodif_precio_venta_sticker_global" type='checkbox' value='<?php echo $cod_estado_nocodif_precio_venta_sticker_global ?>' <?php if($cod_estado_nocodif_precio_venta_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nocodif_precio_venta_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR NOMBRE EMPRESA STICKER</th>
			<td style='text-align:center'><input name='cod_estado_nombre_empresa_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nombre_empresa_sticker_global" type='checkbox' value='<?php echo $cod_estado_nombre_empresa_sticker_global ?>' <?php if($cod_estado_nombre_empresa_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nombre_empresa_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR FECHA COMPRA STICKER</th>
			<td style='text-align:center'><input name='cod_estado_fecha_compra_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_fecha_compra_sticker_global" type='checkbox' value='<?php echo $cod_estado_fecha_compra_sticker_global ?>' <?php if($cod_estado_fecha_compra_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_fecha_compra_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR COD TERCERO STICKER</th>
			<td style='text-align:center'><input name='cod_estado_cod_tercero_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_cod_tercero_sticker_global" type='checkbox' value='<?php echo $cod_estado_cod_tercero_sticker_global ?>' <?php if($cod_estado_cod_tercero_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_cod_tercero_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR URL PAG STICKER</th>
			<td style='text-align:center'><input name='cod_estado_url_pagina_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_url_pagina_sticker_global" type='checkbox' value='<?php echo $cod_estado_url_pagina_sticker_global ?>' <?php if($cod_estado_url_pagina_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_url_pagina_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR NOMBRE DESARROLLADOR STICKER</th>
			<td style='text-align:center'><input name='cod_estado_nombre_desarrollador_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_nombre_desarrollador_sticker_global" type='checkbox' value='<?php echo $cod_estado_nombre_desarrollador_sticker_global ?>' <?php if($cod_estado_nombre_desarrollador_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_nombre_desarrollador_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">MOSTRAR QR STICKER</th>
			<td style='text-align:center'><input name='cod_estado_qr_sticker_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_qr_sticker_global" type='checkbox' value='<?php echo $cod_estado_qr_sticker_global ?>' <?php if($cod_estado_qr_sticker_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_qr_sticker_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR NUMERO LETRAS</th>
			<td style='text-align:center'><input name='cod_estado_numero_letra_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_numero_letra_global" type='checkbox' value='<?php echo $cod_estado_numero_letra_global ?>' <?php if($cod_estado_numero_letra_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_numero_letra_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;"></th>
			<td style="text-align:center"></td>
			<td style='text-align:center'></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO ALERTAS Y NOTIFICACIONES CORREO</th></tr></thead></table>
<table border="1" class="table table-hover">
	<thead>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR MODULO ALERTAS Y NOTIFICACIONES</th>
			<td style='text-align:center'><input name='cod_estado_notificacion_alerta_correo_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_notificacion_alerta_correo_global" type='checkbox' value='<?php echo $cod_estado_notificacion_alerta_correo_global ?>' <?php if($cod_estado_notificacion_alerta_correo_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_notificacion_alerta_correo_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ALERTA Y NOTIFICACION FECHA NAC TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_alerta_fecha_nac_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_alerta_fecha_nac_global" type='checkbox' value='<?php echo $cod_estado_alerta_fecha_nac_global ?>' <?php if($cod_estado_alerta_fecha_nac_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_alerta_fecha_nac_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ALERTA Y NOTIFICACION CUMPLEÑOS TERCERO</th>
			<td style='text-align:center'><input name='cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global" type='checkbox' value='<?php echo $cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global ?>' <?php if($cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ALERTA Y NOTIFICACION COPIA SEGURIDAD</th>
			<td style='text-align:center'><input name='cod_estado_notificacion_alerta_correo_copia_seguridad_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_notificacion_alerta_correo_copia_seguridad_global" type='checkbox' value='<?php echo $cod_estado_notificacion_alerta_correo_copia_seguridad_global ?>' <?php if($cod_estado_notificacion_alerta_correo_copia_seguridad_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_notificacion_alerta_correo_copia_seguridad_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ALERTA Y NOTIFICACION PRODUCTOS A VENCER</th>
			<td style='text-align:center'><input name='cod_estado_notificacion_alerta_correo_productos_a_vencer_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_notificacion_alerta_correo_productos_a_vencer_global" type='checkbox' value='<?php echo $cod_estado_notificacion_alerta_correo_productos_a_vencer_global ?>' <?php if($cod_estado_notificacion_alerta_correo_productos_a_vencer_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_notificacion_alerta_correo_productos_a_vencer_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ALERTA Y NOTIFICACION PRODUCTOS AGOTADOS</th>
			<td style='text-align:center'><input name='cod_estado_notificacion_alerta_correo_productos_agotados_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_notificacion_alerta_correo_productos_agotados_global" type='checkbox' value='<?php echo $cod_estado_notificacion_alerta_correo_productos_agotados_global ?>' <?php if($cod_estado_notificacion_alerta_correo_productos_agotados_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_notificacion_alerta_correo_productos_agotados_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ALERTA Y NOTIFICACION VENTA DIARIA</th>
			<td style='text-align:center'><input name='cod_estado_notificacion_alerta_correo_venta_diaria_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_notificacion_alerta_correo_venta_diaria_global" type='checkbox' value='<?php echo $cod_estado_notificacion_alerta_correo_venta_diaria_global ?>' <?php if($cod_estado_notificacion_alerta_correo_venta_diaria_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_notificacion_alerta_correo_venta_diaria_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ENVIO SMS</th>
			<td style='text-align:center'><input name='cod_estado_envio_sms_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_envio_sms_global" type='checkbox' value='<?php echo $cod_estado_envio_sms_global ?>' <?php if($cod_estado_envio_sms_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_envio_sms_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ENVIO CORREO ALERTA Y NOTIFICACION CIERRE CAJA</th>
			<td style='text-align:center'><input name='cod_estado_envio_correo_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_envio_correo_global" type='checkbox' value='<?php echo $cod_estado_envio_correo_global ?>' <?php if($cod_estado_envio_correo_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_envio_correo_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
		<tr>
			<th style="text-align:left; width:90%;">HABILITAR ENVIO CORREO ALERTA RENOVACION RESOLUCION DIAN</th>
			<td style='text-align:center'><input name='cod_estado_tipo_cobro_aviso_alerta_renovacion_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_tipo_cobro_aviso_alerta_renovacion_global" type='checkbox' value='<?php echo $cod_estado_tipo_cobro_aviso_alerta_renovacion_global ?>' <?php if($cod_estado_tipo_cobro_aviso_alerta_renovacion_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><a href="#" class="aaaaaa<?php echo $cod_info_empresa ?>"><img src="../imagenes/empty.gif"></a></td>
			<td style="text-align:center" id="cod_estado_tipo_cobro_aviso_alerta_renovacion_global<?php echo $cod_info_empresa ?>"></td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO FACTURA ELECTRONICA API (DATAICO)</th></tr></thead></table>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">HABILITAR ENVIAR FACTURA ELECTRONICA POR API (DATAICO)</th>
			<th style="text-align:center">HABILITAR ENVIAR FACTURA DOCUMENTO SOPORTE POR API (DATAICO)</th>
			<th style="text-align:center">ENTORNO DE DESARROLLO API (DATAICO)</th>
			<th style="text-align:center">ACCOUNT ID API (DATAICO)</th>
			<th style="text-align:center">AUTH TOKEN API (DATAICO)</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style='text-align:center'><input name='cod_estado_enviar_factura_venta_electronica_dian_api_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_enviar_factura_venta_electronica_dian_api_global" type='checkbox' value='<?php echo $cod_estado_enviar_factura_venta_electronica_dian_api_global ?>' <?php if($cod_estado_enviar_factura_venta_electronica_dian_api_global=='1'){ echo 'checked'; } ?>></td>
			<td style='text-align:center'><input name='cod_estado_enviar_factura_documento_soporte_dian_api_global' class="<?php echo $cod_info_empresa ?>" id="cod_estado_enviar_factura_documento_soporte_dian_api_global" type='checkbox' value='<?php echo $cod_estado_enviar_factura_documento_soporte_dian_api_global ?>' <?php if($cod_estado_enviar_factura_documento_soporte_dian_api_global=='1'){ echo 'checked'; } ?>></td>
			<td style="text-align:center"><input type="text" name="dataico_entorno_desarrollo_api_global" value="<?php echo ($dataico_entorno_desarrollo_api_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="dataico_account_id_api_global" value="<?php echo ($dataico_account_id_api_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="width: 300px;"/></td>
			<td style="text-align:center"><input type="text" name="dataico_auth_token_api_global" value="<?php echo ($dataico_auth_token_api_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="width: 300px;"/></td>
		</tr>
		<tr>
			<th style="text-align:center">TIPO FACTURA API (DATAICO)</th>
			<th style="text-align:center">ENVIAR FACTURA DIRECTA A DIAN API (DATAICO)</th>
			<th style="text-align:center">ENVIAR CORREO AL CLIENTE API (DATAICO)</th>
			<th style="text-align:center">TIEMPO DE ESPERA PARA HABILITAR IMPRESORA ENVIO DE LA FACTURA API (DATAICO)</th>
		</tr>
			<td style="text-align:center"><input type="text" name="dataico_tipo_factura_api_global" value="<?php echo ($dataico_tipo_factura_api_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center">
				<select name="dataico_send_dian_api_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="width: 60px;">
			        <?php if (isset($dataico_send_dian_api_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_sino";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($dataico_send_dian_api_global) and $dataico_send_dian_api_global == $datos2['nombre_sino_ingles']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_sino_ingles'];
			        $nombre_select           = $datos2['nombre_sino'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre_select."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="dataico_send_email_api_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="width: 60px;">
			        <?php if (isset($dataico_send_email_api_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_sino";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($dataico_send_email_api_global) and $dataico_send_email_api_global == $datos2['nombre_sino_ingles']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_sino_ingles'];
			        $nombre_select           = $datos2['nombre_sino'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre_select."</option>"; } ?>
				</select>
			</td>			
			<td style="text-align:center"><input type="number" name="tiempo_espera_respuesta_factura_venta_electronica_global" value="<?php echo ($tiempo_espera_respuesta_factura_venta_electronica_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="width: 60px;"/></td>
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-hover"><thead><tr><th style="text-align:center">MODULO TIPO AGENTE DIAN</th></tr></thead></table>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">AGENTE CONTRIBUYENTE DIAN</th>
			<th style="text-align:center">AGENTE RETENEDOR DIAN</th>
			<th style="text-align:center">AGENTE AUTORETENEDOR DIAN</th>
			<th style="text-align:center">RESOLUCION DE VENTA POR DEFECTO</th>
			<th style="text-align:center">TIPO DE FACTURA POR DEFECTO (POS - ELECTRONICA)</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center">
				<select name="cod_agente_dian_contribuyente" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_agente_dian_contribuyente)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_agente_dian WHERE (cod_tipo_agente_dian = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_agente_dian_contribuyente) and $cod_agente_dian_contribuyente == $datos2['cod_agente_dian']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_agente_dian'];
			        $nombre_select    = $datos2['nombre_agente_dian'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre_select."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_agente_dian_retenedor" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_agente_dian_retenedor)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_agente_dian WHERE (cod_tipo_agente_dian = '2')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_agente_dian_retenedor) and $cod_agente_dian_retenedor == $datos2['cod_agente_dian']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_agente_dian'];
			        $nombre_select    = $datos2['nombre_agente_dian'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre_select."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_agente_dian_autoretenedor" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_agente_dian_autoretenedor)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_agente_dian WHERE (cod_tipo_agente_dian = '3')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_agente_dian_autoretenedor) and $cod_agente_dian_autoretenedor == $datos2['cod_agente_dian']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_agente_dian'];
			        $nombre_select    = $datos2['nombre_agente_dian'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre_select."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_resolucion_facturacion_venta_defecto_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_resolucion_facturacion_venta_defecto_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '1') AND (nombre_tipo_estado = 'ACTIVO')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_resolucion_facturacion_venta_defecto_global) and $cod_resolucion_facturacion_venta_defecto_global == $datos2['cod_resolucion_facturacion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_resolucion_facturacion'];
                	$nombre_select    = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre_select."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><input type="text" name="nombre_tipo_factura_defecto_global" value="<?php echo ($nombre_tipo_factura_defecto_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CABECERA PROGRAM</th>
			<th style="text-align:center">ESLOGAN</th>
			<th style="text-align:center">TITULO</th>
			<th style="text-align:center">CABECERA FACTURA</th>
			<th style="text-align:center">LEYENDA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input type="text" name="nombre" value="<?php echo ($nombre) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="eslogan" value="<?php echo ($eslogan) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="titulo" value="<?php echo ($titulo) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="cabecera" value="<?php echo ($cabecera) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><textarea id="<?php echo $cod_info_empresa ?>" class="input-block-level" name="info_legal" rows="1" cols="20"><?php echo $info_legal ?></textarea></td>
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PAIS</th>
			<th style="text-align:center">DEPARTAMENTO</th>
			<th style="text-align:center">CIUDAD</th>
			<th style="text-align:center">LOCALIDAD</th>
			<th style="text-align:center">DIRECCIÓN</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="pais" value="<?php echo ($pais) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="departamento" value="<?php echo ($departamento) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="ciudad" value="<?php echo ($ciudad) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="localidad" value="<?php echo ($localidad) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="direccion" value="<?php echo ($direccion) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TELÉFONO</th>
			<th style="text-align:center">CORREO</th>
			<th style="text-align:center">NIT EMPRESA</th>
			<th style="text-align:center">RÉGIMEN</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input type="text" name="telefono" value="<?php echo ($telefono) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="correo" value="<?php echo ($correo) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="nit_empresa" value="<?php echo ($nit_empresa) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center">
				<select name="regimen" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($regimen)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_impuesto";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($regimen) and $regimen == $datos2['nombre_tipo_impuesto']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_impuesto'];
			        $nombre           = $datos2['nombre_tipo_impuesto'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">RESOLUCIÓN DIAN</th>
			<th style="text-align:center">DE</th>
			<th style="text-align:center">A</th>
			<th style="text-align:center">FECHA RESOLUCIÓN</th>
			<th style="text-align:center">EMPRESA TRANSFERENCIA</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input type="text" name="res" value="<?php echo ($res) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="res1" value="<?php echo ($res1) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="res2" value="<?php echo ($res2) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="date" name="fecha_res" value="<?php echo ($fecha_res) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center">
				<select name="cod_empresa_transferencia_directa_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  style="font-size:15px">
					<?php if (isset($cod_empresa_transferencia_directa_global)) { echo "<option value='' >Selecione</option>"; } else { echo  "<option value='' selected >Selecione</option>"; }
			        $consulta2_sql = "SELECT * FROM tbl15_empresa_transferencia_directa WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_empresa_transferencia_directa_global) and $cod_empresa_transferencia_directa_global == $datos2['cod_empresa_transferencia_directa']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_empresa_transferencia_directa'];
			        $nombre           = $datos2['nombre_empresa_transferencia_directa'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TAMAÑO LETRA BARRA PDF</th>
			<th style="text-align:center">ANCHO BARRA PDF</th>
			<th style="text-align:center">ALTO BARRA PDF</th>
			<th style="text-align:center">CANTIDAD COLUMNAS BARRA PDF</th>
			<th style="text-align:center">ESTANDAR BARRA PDF</th>
			<th style="text-align:center">TIPO HOJA BARRA PDF</th>
			<th style="text-align:center">TAMAÑO PAPEL IMPRESORA POS</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input type="number" name="tamano_font_sticker_barra_pdf" value="<?php echo ($tamano_font_sticker_barra_pdf) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="number" name="ancho_sticker_barra_pdf" value="<?php echo ($ancho_sticker_barra_pdf) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="number" name="alto_sticker_barra_pdf" value="<?php echo ($alto_sticker_barra_pdf) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="number" name="columnas_sticker_barra_pdf" value="<?php echo ($columnas_sticker_barra_pdf) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="nombre_estandar_sticker_barra_pdf" value="<?php echo ($nombre_estandar_sticker_barra_pdf) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="tipo_hoja_sticker_barra_pdf" value="<?php echo ($tipo_hoja_sticker_barra_pdf) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="number" name="tamano_papel_impresora" value="<?php echo ($tamano_papel_impresora) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE CAMPO UND INV 1</th>
			<th style="text-align:center">NOMBRE CAMPO UND INV 2</th>
			<th style="text-align:center">NOMBRE CAMPO UND INV 3</th>
			<th style="text-align:center">TIPO CIERRE DE CAJA</th>
			<th style="text-align:center">CALCULAR LA GANANCIA REPORTE VENTA</th>
		</tr>
	</thead>

    <tbody>
    	<tr>
			<td style="text-align:center"><input type="text" name="nombre_campo_undidades_inv1" value="<?php echo ($nombre_campo_undidades_inv1) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="nombre_campo_undidades_inv2" value="<?php echo ($nombre_campo_undidades_inv2) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="nombre_campo_undidades_inv3" value="<?php echo ($nombre_campo_undidades_inv3) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center">
				<select name="cod_tipo_cierre_caja_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_cierre_caja_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_tipo_cierre_caja, nombre_tipo_cierre_caja FROM tbl15_tipo_cierre_caja WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_cierre_caja_global) and $cod_tipo_cierre_caja_global == $datos2['cod_tipo_cierre_caja']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_cierre_caja'];
			        $nombre           = $datos2['nombre_tipo_cierre_caja'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_calcular_ptjganancia_venta_ref_pcompra_pventa, nombre_calcular_ptjganancia_venta_ref_pcompra_pventa FROM tbl15_calcular_ptjganancia_venta_ref_pcompra_pventa WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global) and $cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == $datos2['cod_calcular_ptjganancia_venta_ref_pcompra_pventa']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_calcular_ptjganancia_venta_ref_pcompra_pventa'];
			        $nombre           = $datos2['nombre_calcular_ptjganancia_venta_ref_pcompra_pventa'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE EMPRESA STICKER</th>
			<th style="text-align:center">PTJ CALCULO AUTOMATICO PCOMPRA PVAR</th>
			<th style="text-align:center">BUSCAR POR DEFECTO</th>
			<th style="text-align:center">TIPO MOVIMIENTO CONTABLE</th>
			<th style="text-align:center">TIPO DE EXPORTACION EN EXCEL</th>

		</tr>
	</thead>
	<tbody>
    	<tr>   
			<td style="text-align:center"><input type="text" name="nombre_empresa_sticker" value="<?php echo ($nombre_empresa_sticker) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="ptj_pvar_calculo_automatico_pcompra" value="<?php echo ($ptj_pvar_calculo_automatico_pcompra) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>

			<td style="text-align:center">
				<select name="nombre_buscar_por" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_buscar_por)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_buscar_por) and $nombre_buscar_por == $datos2['nombre_buscar_por']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_buscar_por'];
			        $nombre           = $datos2['titulo_buscar_por'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_estado_tipo_moviento_contable_credito_debito_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_estado_tipo_moviento_contable_credito_debito_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT cod_tipo_moviento_contable_credito_debito, nombre_tipo_moviento_contable_credito_debito FROM tbl15_tipo_moviento_contable_credito_debito WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_tipo_moviento_contable_credito_debito_global) and $cod_estado_tipo_moviento_contable_credito_debito_global == $datos2['cod_tipo_moviento_contable_credito_debito']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_moviento_contable_credito_debito'];
			        $nombre           = $datos2['nombre_tipo_moviento_contable_credito_debito'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_estado_tipo_export_excel_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_estado_tipo_export_excel_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_tipo_export_excel, nombre_tipo_export_excel FROM tbl15_tipo_export_excel WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_tipo_export_excel_global) and $cod_estado_tipo_export_excel_global == $datos2['cod_tipo_export_excel']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_export_excel'];
			        $nombre           = $datos2['nombre_tipo_export_excel'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>


    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE DE LA CUENTA PUC POR DEFECTO EN VENTA TEMP (PUC)</th>
			<th style="text-align:center">NOMBRE DE LA CUENTA PERSONAL POR DEFECTO EN VENTA TEMP (ME)</th>
			<th style="text-align:center">NOMBRE DE LA CUENTA CAJA POR DEFECTO (FNR)</th>
			<th style="text-align:center">TIPO DE MODULO CUENTA POR COBRAR POR DEFECTO</th>
			<th style="text-align:center">CAMPAÑA PUNTOS REDIMIBLES POR COBRAR POR DEFECTO</th>
			<th style="text-align:center">BASE PARA PLICAR RETEFUENTE A LA VENATA</th>
		</tr>
	</thead>

    <tbody>
    	<tr>
			<td style="text-align:center">
				<select name="cod_puc_defect_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_puc_defect_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_puc WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_puc_defect_global) and $cod_puc_defect_global == $datos2['cod_puc']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_puc'];
			        $nombre           = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_movimiento_contable_cuenta_personal_defect_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_movimiento_contable_cuenta_personal_defect_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal GROUP BY cod_puc";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_movimiento_contable_cuenta_personal_defect_global) and $cod_movimiento_contable_cuenta_personal_defect_global == $datos2['cod_puc']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_puc'];
			        $nombre           = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_movimiento_caja_defect_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_movimiento_caja_defect_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_caja";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_movimiento_caja_defect_global) and $cod_movimiento_caja_defect_global == $datos2['cod_puc']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_puc'];
			        $nombre           = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="codigo_tipo_modulo_cuenta_cobrar_defect_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($codigo_tipo_modulo_cuenta_cobrar_defect_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT codigo_tipo_modulo_cuenta_cobrar, nombre_tipo_modulo_cuenta_cobrar, cod_estado FROM tbl15_tipo_modulo_cuenta_cobrar WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($codigo_tipo_modulo_cuenta_cobrar_defect_global) and $codigo_tipo_modulo_cuenta_cobrar_defect_global == $datos2['codigo_tipo_modulo_cuenta_cobrar']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['codigo_tipo_modulo_cuenta_cobrar'];
			        $nombre           = $datos2['nombre_tipo_modulo_cuenta_cobrar'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_puntos_redimibles_campanya_predef_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_puntos_redimibles_campanya_predef_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_puntos_redimibles_campanya, nombre_puntos_redimibles_campanya, cod_estado FROM tbl15_puntos_redimibles_campanya WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_puntos_redimibles_campanya_predef_global) and $cod_puntos_redimibles_campanya_predef_global == $datos2['cod_puntos_redimibles_campanya']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_puntos_redimibles_campanya'];
			        $nombre           = $datos2['nombre_puntos_redimibles_campanya'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><input type="text" name="limite_base_venta_aplicar_retefuente_global" value="<?php echo ($limite_base_venta_aplicar_retefuente_global) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE EMPRESA STICKER</th>
			<th style="text-align:center">PTJ CALCULO AUTOMATICO PCOMPRA PVAR</th>
			<th style="text-align:center">BUSCAR POR DEFECTO</th>
			<th style="text-align:center">TIPO MOVIMIENTO CONTABLE</th>
			<th style="text-align:center">TIPO DE EXPORTACION EN EXCEL</th>

		</tr>
	</thead>
	<tbody>
    	<tr>   
			<td style="text-align:center"><input type="text" name="nombre_empresa_sticker" value="<?php echo ($nombre_empresa_sticker) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center"><input type="text" name="ptj_pvar_calculo_automatico_pcompra" value="<?php echo ($ptj_pvar_calculo_automatico_pcompra) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>

			<td style="text-align:center">
				<select name="nombre_buscar_por" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_buscar_por)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_buscar_por) and $nombre_buscar_por == $datos2['nombre_buscar_por']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_buscar_por'];
			        $nombre           = $datos2['titulo_buscar_por'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_estado_tipo_moviento_contable_credito_debito_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_estado_tipo_moviento_contable_credito_debito_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT cod_tipo_moviento_contable_credito_debito, nombre_tipo_moviento_contable_credito_debito FROM tbl15_tipo_moviento_contable_credito_debito WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_tipo_moviento_contable_credito_debito_global) and $cod_estado_tipo_moviento_contable_credito_debito_global == $datos2['cod_tipo_moviento_contable_credito_debito']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_moviento_contable_credito_debito'];
			        $nombre           = $datos2['nombre_tipo_moviento_contable_credito_debito'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_estado_tipo_export_excel_global" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_estado_tipo_export_excel_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT cod_tipo_export_excel, nombre_tipo_export_excel FROM tbl15_tipo_export_excel WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_tipo_export_excel_global) and $cod_estado_tipo_export_excel_global == $datos2['cod_tipo_export_excel']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_export_excel'];
			        $nombre           = $datos2['nombre_tipo_export_excel'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>


    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TIPO VALOR UNIDAD DE COMPRA (UND COMPRA)</th>
			<th style="text-align:center">TIPO VALOR UNIDAD DE VENTA (UND VENTA)</th>
			<th style="text-align:center">TIPO VALOR PRECIO DE COMPRA (PRECIO COMPRA)</th>
			<th style="text-align:center">TIPO VALOR PRECIO DE VENTA (PRECIO VENTA)</th>
			<th style="text-align:center">TIPO VALOR UNIDAD PRESENTACION (CAJA)</th>
			<th style="text-align:center">TIPO VALOR SOBRE PRESENTACION (SOBRE)</th>

		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center">
				<select name="cod_tipo_sistema_numeracion_und_compra" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_sistema_numeracion_und_compra)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_sistema_numeracion WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_sistema_numeracion_und_compra) and $cod_tipo_sistema_numeracion_und_compra == $datos2['cod_tipo_sistema_numeracion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_sistema_numeracion'];
			        $nombre           = $datos2['nombre_tipo_sistema_numeracion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_tipo_sistema_numeracion_und_venta" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_sistema_numeracion_und_venta)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_sistema_numeracion WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_sistema_numeracion_und_venta) and $cod_tipo_sistema_numeracion_und_venta == $datos2['cod_tipo_sistema_numeracion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_sistema_numeracion'];
			        $nombre           = $datos2['nombre_tipo_sistema_numeracion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_tipo_sistema_numeracion_precio_compra" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_sistema_numeracion_precio_compra)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_sistema_numeracion WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_sistema_numeracion_precio_compra) and $cod_tipo_sistema_numeracion_precio_compra == $datos2['cod_tipo_sistema_numeracion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_sistema_numeracion'];
			        $nombre           = $datos2['nombre_tipo_sistema_numeracion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_tipo_sistema_numeracion_precio_venta" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_sistema_numeracion_precio_venta)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_sistema_numeracion WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_sistema_numeracion_precio_venta) and $cod_tipo_sistema_numeracion_precio_venta == $datos2['cod_tipo_sistema_numeracion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_sistema_numeracion'];
			        $nombre           = $datos2['nombre_tipo_sistema_numeracion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>

			<td style="text-align:center">
				<select name="cod_tipo_sistema_numeracion_und_unidades_presentacion" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_sistema_numeracion_und_unidades_presentacion)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_sistema_numeracion WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_sistema_numeracion_und_unidades_presentacion) and $cod_tipo_sistema_numeracion_und_unidades_presentacion == $datos2['cod_tipo_sistema_numeracion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_sistema_numeracion'];
			        $nombre           = $datos2['nombre_tipo_sistema_numeracion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_tipo_sistema_numeracion_und_caja_presentacion" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($cod_tipo_sistema_numeracion_und_caja_presentacion)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_sistema_numeracion WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_tipo_sistema_numeracion_und_caja_presentacion) and $cod_tipo_sistema_numeracion_und_caja_presentacion == $datos2['cod_tipo_sistema_numeracion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_sistema_numeracion'];
			        $nombre           = $datos2['nombre_tipo_sistema_numeracion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TIPO COMPONENTE UNIDAD DE COMPRA (NUMBER - TEXT)</th>
			<th style="text-align:center">TIPO COMPONENTE UNIDAD DE VENTA (NUMBER - TEXT)</th>
			<th style="text-align:center">TIPO COMPONENTE PRECIO DE COMPRA (NUMBER - TEXT)</th>
			<th style="text-align:center">TIPO COMPONENTE PRECIO DE VENTA (NUMBER - TEXT)</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center">
				<select name="nombre_tipo_campo_componente_html_und_compra" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_tipo_campo_componente_html_und_compra)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_campo_componente_html WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_campo_componente_html_und_compra) and $nombre_tipo_campo_componente_html_und_compra == $datos2['nombre_tipo_campo_componente_html']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_campo_componente_html'];
			        $nombre           = $datos2['descripcion_tipo_campo_componente_html'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="nombre_tipo_campo_componente_html_und_venta" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_tipo_campo_componente_html_und_venta)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_campo_componente_html WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_campo_componente_html_und_venta) and $nombre_tipo_campo_componente_html_und_venta == $datos2['nombre_tipo_campo_componente_html']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_campo_componente_html'];
			        $nombre           = $datos2['descripcion_tipo_campo_componente_html'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="nombre_tipo_campo_componente_html_precio_compra" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_tipo_campo_componente_html_precio_compra)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_campo_componente_html WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_campo_componente_html_precio_compra) and $nombre_tipo_campo_componente_html_precio_compra == $datos2['nombre_tipo_campo_componente_html']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_campo_componente_html'];
			        $nombre           = $datos2['descripcion_tipo_campo_componente_html'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="nombre_tipo_campo_componente_html_precio_venta" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_tipo_campo_componente_html_precio_venta)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_campo_componente_html WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_campo_componente_html_precio_venta) and $nombre_tipo_campo_componente_html_precio_venta == $datos2['nombre_tipo_campo_componente_html']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_campo_componente_html'];
			        $nombre           = $datos2['descripcion_tipo_campo_componente_html'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>

    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TIPO DE EMPRESA</th>
			<th style="text-align:center">NUM PRECIO</th>
			<th style="text-align:center">PRECIO PREDETERMINADO</th>
			<th style="text-align:center">CAJA-MESA VIRTUAL</th>
			<th style="text-align:center">CANTIDAD CAJA-MESA VIRTUAL VISUAL</th>
			<th style="text-align:center">DIAS ALERTA VENCIMIENTO</th>
			<th style="text-align:center">NUMERO DE PRODUCTOS MOSTRAR LISTA CAJA MESA VIRTUAL</th>
			<th style="text-align:center">DIAS ALERTA COBRO EMTREGA SERVICIO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center">
	<select name="nombre_tipo_empresa" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="width: 130px;">
        <?php if (isset($nombre_tipo_empresa)) { echo ""; } else { echo ""; }
        $consulta2_sql = "SELECT * FROM tbl15_tipo_empresa";
        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($nombre_tipo_empresa) and $nombre_tipo_empresa == $datos2['nombre_tipo_empresa']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo           = $datos2['nombre_tipo_empresa'];
        $nombre           = $datos2['nombre_tipo_empresa'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
<td style="text-align:center">
	<select name="numero_precio" id="<?php echo $cod_info_empresa ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;">
	<?php if (isset($numero_precio)) { echo "<option value='' >Selecione</option>"; } else { echo  "<option value='' selected >Selecione</option>"; }
	$consulta2_sql = ("SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta WHERE (cod_tipo_precio_venta <= 5) ORDER BY cod_tipo_precio_venta ASC");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	if(isset($numero_precio) and $numero_precio == $datos2['cod_tipo_precio_venta']) {
	$seleccionado = "selected"; } else { $seleccionado = ""; }
	$codigo = $datos2['cod_tipo_precio_venta'];
	$nombre = $datos2['cod_tipo_precio_venta'];
	echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
<td style="text-align:center">
	<select name="nombre_tipo_precio_venta" id="<?php echo $cod_info_empresa ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;">
	<?php if (isset($nombre_tipo_precio_venta)) { echo "<option value='' >Selecione</option>";
	} else { echo  "<option value='' selected >Selecione</option>"; }
	$consulta2_sql = ("SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta ORDER BY cod_tipo_precio_venta ASC");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	if(isset($nombre_tipo_precio_venta) and $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
	$seleccionado = "selected"; } else { $seleccionado = ""; }
	$codigo = $datos2['nombre_tipo_precio_venta'];
	$nombre = $datos2['nombre_tipo_precio_venta'];
	echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
<td style="text-align:center"><input type="text" name="nombre_concepto_multi_virtual" value="<?php echo ($nombre_concepto_multi_virtual) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="cantidad_caja_mesa" value="<?php echo ($cantidad_caja_mesa) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>	
<td style="text-align:center"><input type="number" name="dias_vencimiento_producto_alerta" value="<?php echo ($dias_vencimiento_producto_alerta) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>	
<td style="text-align:center"><input type="number" name="limite_mostrar_producto_lista_caja_virtual" value="<?php echo ($limite_mostrar_producto_lista_caja_virtual) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>	
<td style="text-align:center"><input type="number" name="dias_alerta_entrega_venta" value="<?php echo ($dias_alerta_entrega_venta) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>	
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">OPERADOR DE FACTURA ELECTRONCIA</th>
			<th style="text-align:center">TIPO IMPRESORA ZEBRA TICKET</th>
			<th style="text-align:center">URL ENCUESTA EXPERIENCIA COMPRA</th>
			<th style="text-align:center">TIPO DE NOMINACION MONEDAS CIERRE CAJA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center">
				<select name="nombre_operador_factura_electronica" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_operador_factura_electronica)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_operador_factura_electronica";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_operador_factura_electronica) and $nombre_operador_factura_electronica == $datos2['nombre_operador_factura_electronica']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_operador_factura_electronica'];
			        $nombre           = $datos2['nombre_operador_factura_electronica'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="nombre_tipo_impresora_zebra_ticket" id="<?php echo $cod_info_empresa ?>" class="input-block-level" style="font-size:15px">
			        <?php if (isset($nombre_tipo_impresora_zebra_ticket)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_impresora_zebra_ticket";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_impresora_zebra_ticket) and $nombre_tipo_impresora_zebra_ticket == $datos2['nombre_tipo_impresora_zebra_ticket']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_impresora_zebra_ticket'];
			        $nombre           = $datos2['nombre_tipo_impresora_zebra_ticket'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><input type="text" name="url_encuesta_experiencia_compra" value="<?php echo ($url_encuesta_experiencia_compra) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>	
			<td style="text-align:center">
				<select name="cod_estado_tipo_nominacion_moneda_cierre_caja_global" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_estado_tipo_nominacion_moneda_cierre_caja_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_nominacion_moneda_cierre_caja WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_tipo_nominacion_moneda_cierre_caja_global) and $cod_estado_tipo_nominacion_moneda_cierre_caja_global == $datos2['cod_tipo_nominacion_moneda_cierre_caja']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_nominacion_moneda_cierre_caja'];
			        $nombre           = $datos2['nombre_tipo_nominacion_moneda_cierre_caja'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PTJ PROPINA</th>
			<th style="text-align:center">COD PROPINA</th>
			<th style="text-align:center">NOMBRE PROPINA</th>
			<th style="text-align:center">PRECIO PROPINA</th>
			<th style="text-align:center">PTJ BOLSA</th>
			<th style="text-align:center">COD BOLSA</th>
			<th style="text-align:center">NOMBRE BOLSA</th>
			<th style="text-align:center">PRECIO BOLSA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="ptj_servicio_propina" value="<?php echo ($ptj_servicio_propina) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="cod_servicio_propina" value="<?php echo ($cod_servicio_propina) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_servicio_propina" value="<?php echo ($nombre_servicio_propina) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="precio_servicio_propina" value="<?php echo ($precio_servicio_propina) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="ptj_bolsa" value="<?php echo ($ptj_bolsa) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="cod_bolsa" value="<?php echo ($cod_bolsa) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_bolsa" value="<?php echo ($nombre_bolsa) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="precio_bolsa" value="<?php echo ($precio_bolsa) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">COD DOMICILIO</th>
			<th style="text-align:center">NOMBRE DOMICILIO</th>
			<th style="text-align:center">PRECIO DOMICILIO</th>
			<th style="text-align:center">PTJ DOMICILIO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="cod_servicio_domicilio" value="<?php echo ($cod_servicio_domicilio) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_servicio_domicilio" value="<?php echo ($nombre_servicio_domicilio) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="precio_servicio_domicilio" value="<?php echo ($precio_servicio_domicilio) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="ptj_servicio_domicilio" value="<?php echo ($ptj_servicio_domicilio) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">COD CAVA</th>
			<th style="text-align:center">NOMBRE CAVA</th>
			<th style="text-align:center">PRECIO CAVA</th>
			<th style="text-align:center">PTJ CAVA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="cod_servicio_cava" value="<?php echo ($cod_servicio_cava) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_servicio_cava" value="<?php echo ($nombre_servicio_cava) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="precio_servicio_cava" value="<?php echo ($precio_servicio_cava) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="ptj_servicio_cava" value="<?php echo ($ptj_servicio_cava) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE PROPIETARIO</th>
			<th style="text-align:center">NIT PROPIETARIO</th>
			<th style="text-align:center">FIRMA PROPIETARIO</th>
			<th style="text-align:center">CAMBIAR FIRMA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>   
<td style="text-align:center"><input type="text" name="propietario_nombres_apellidos" value="<?php echo ($propietario_nombres_apellidos) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>   
<td style="text-align:center"><input type="text" name="propietario_nit" value="<?php echo ($propietario_nit) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td> 
<td style="text-align:center"><img src="<?php echo ($propietario_url_firma) ?>" height="20"></td>
<td style="text-align:center"><a href="../admin/edit_cargar_firma_empresa.php?cod_info_empresa=<?php echo $cod_info_empresa; ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/cambiar_firma_usuario.png"></a></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">REG MEDICO</th>
			<th style="text-align:center">LICENCIA</th>
			<!--<th style="text-align:center">INFO HC</th>-->
			<th style="text-align:center">INFO APTLAB</th>
			<th style="text-align:center">DIA INI FACT</th>
			<th style="text-align:center">DIA FIN FACT</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="reg_medico" value="<?php echo ($reg_medico) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="licencia" value="<?php echo ($licencia) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<!--<td style="text-align:center"><input type="text" name="info_histclinic" value="<?php echo ($info_histclinic) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>-->
<td style="text-align:center"><textarea id="<?php echo $cod_info_empresa ?>" class="input-block-level" name="info_aptlaboral" rows="5" cols="20"><?php echo $info_aptlaboral ?></textarea></td>
<td style="text-align:center"><input type="text" name="dia_ini_facturacion" value="<?php echo ($dia_ini_facturacion) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  size="1"/></td> 
<td style="text-align:center"><input type="text" name="dia_fin_facturacion" value="<?php echo ($dia_fin_facturacion) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level"  size="1"/></td> 
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TAMAÑO LETRA</th>
			<th style="text-align:center">LETRA HC</th>
			<th style="text-align:center">LETRA APTLAB</th>
			<th style="text-align:center">LETRA TRABALTURA</th>
			<th style="text-align:center">LETRA MANALIMENT</th>
			<th style="text-align:center">LETRA INFORME</th>
			<th style="text-align:center">LETRA REMISION</th>
			<th style="text-align:center">LETRA FACTURA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input type="number" name="tamano_font" value="<?php echo ($tamano_font) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td>
			<td style="text-align:center"><input type="number" name="tamano_font_hc" value="<?php echo ($tamano_font_hc) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level"min="1" max="99" /></td>
			<td style="text-align:center"><input type="number" name="tamano_font_aptlab" value="<?php echo ($tamano_font_aptlab) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td>
			<td style="text-align:center"><input type="number" name="tamano_font_trabaltu" value="<?php echo ($tamano_font_trabaltu) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td>
			<td style="text-align:center"><input type="number" name="tamano_font_manaliment" value="<?php echo ($tamano_font_manaliment) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td>
			<td style="text-align:center"><input type="number" name="tamano_font_informe" value="<?php echo ($tamano_font_informe) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td>
			<td style="text-align:center"><input type="number" name="tamano_font_remision" value="<?php echo ($tamano_font_remision) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td>
			<td style="text-align:center"><input type="number" name="tamano_font_factura" value="<?php echo ($tamano_font_factura) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" min="1" max="99"/></td> 
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">IMAG CABECERA</th>
			<th style="text-align:center">LOGOTIPO</th>
			<th style="text-align:center">TIPOGRAFIA</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input type="text" name="img_cabecera" value="<?php echo ($img_cabecera) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>   
			<td style="text-align:center"><input type="text" name="logotipo" value="<?php echo ($logotipo) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
			<td style="text-align:center">
				<select name="nombre_font" id="<?php echo $cod_info_empresa ?>" class="selectpicker" data-show-subtext="true" data-live-search="true">
				<?php if (isset($nombre_font)) { echo "<option value='' >Selecione</option>";
				} else { echo  "<option value='' selected >Selecione</option>"; }
				$consulta2_sql = ("SELECT cod_font, nombre_font FROM tbl15_font ORDER BY nombre_font ASC");
				$consulta2 = mysqli_query($conectar, $consulta2_sql);
				while ($datos2 = mysqli_fetch_assoc($consulta2)) {
				if(isset($nombre_font) and $nombre_font == $datos2['nombre_font']) {
				$seleccionado = "selected"; } else { $seleccionado = ""; }
				$codigo = $datos2['cod_font'];
				$nombre = $datos2['nombre_font'];
				echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">SMTP HOST</th>
			<th style="text-align:center">SMTP AUTH</th>
			<th style="text-align:center">SMTP USER</th>
			<th style="text-align:center">SMTP PASS</th>
			<th style="text-align:center">SMTP SECURE</th>
			<th style="text-align:center">SMTP PORT</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="smtp_correo_host" value="<?php echo ($smtp_correo_host) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_auth" value="<?php echo ($smtp_correo_auth) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_username" value="<?php echo ($smtp_correo_username) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_password" value="<?php echo ($smtp_correo_password) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_secure" value="<?php echo ($smtp_correo_secure) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_port" value="<?php echo ($smtp_correo_port) ?>" id="<?php echo $cod_info_empresa ?>" class="input-block-level" /></td> 
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_info_empresa" value="<?php echo $cod_info_empresa ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<!--<input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />-->
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
var cod_estado_parqueo_hotel_global = $('#cod_estado_parqueo_hotel_global').val();
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
var cod_estado_limite_venta_pos_factura_electronica_global = $('#cod_estado_limite_venta_pos_factura_electronica_global').val();
var cod_estado_recalcular_factura_compra_global = $('#cod_estado_recalcular_factura_compra_global').val();
var cod_estado_comentario_venta_mostrar_imprimir_global = $('#cod_estado_comentario_venta_mostrar_imprimir_global').val();
var cod_estado_mostrar_agrupado_produc_repventa_imprimir_global = $('#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global').val();
var cod_estado_sumar_producto_repetido_venta_temporal_global = $('#cod_estado_sumar_producto_repetido_venta_temporal_global').val();
var cod_estado_edit_precio_venta_btn_factura_venta_global = $('#cod_estado_edit_precio_venta_btn_factura_venta_global').val();
var cod_estado_busqueda_venta_manual_resultado_unico_redirect_global = $('#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global').val();
var cod_estado_soporte_factura_venta_global = $('#cod_estado_soporte_factura_venta_global').val();
var cod_estado_cargar_factura_compra_simplificada_carniceria_global = $('#cod_estado_cargar_factura_compra_simplificada_carniceria_global').val();
var cod_estado_cod_barra2_global = $('#cod_estado_cod_barra2_global').val();
var cod_estado_publicidad_global = $('#cod_estado_publicidad_global').val();
var cod_estado_habitacion_hotel_global = $('#cod_estado_habitacion_hotel_global').val();
var cod_estado_limpieza_hotel_global = $('#cod_estado_limpieza_hotel_global').val();
var cod_estado_iva_saludable_ptj_global = $('#cod_estado_iva_saludable_ptj_global').val();
var cod_estado_pvar_calculo_automatico_pcompra_global = $('#cod_estado_pvar_calculo_automatico_pcompra_global').val();
var cod_estado_movimiento_contable_cuenta_personal_global = $('#cod_estado_movimiento_contable_cuenta_personal_global').val();
var cod_estado_mostrar_venta_por_caja_global = $('#cod_estado_mostrar_venta_por_caja_global').val();
var cod_estado_btn_imp_nav_carta_por_caja_pdf_global = $('#cod_estado_btn_imp_nav_carta_por_caja_pdf_global').val();
var cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global = $('#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global').val();
var cod_estado_espacio_firma_bodega_imprimir_global = $('#cod_estado_espacio_firma_bodega_imprimir_global').val();
var cod_estado_espacio_firma_transportador_imprimir_global = $('#cod_estado_espacio_firma_transportador_imprimir_global').val();
var cod_estado_tipo_cobro_aviso_alerta_renovacion_global = $('#cod_estado_tipo_cobro_aviso_alerta_renovacion_global').val();
var cod_estado_domiciliario_global = $('#cod_estado_domiciliario_global').val();
var cod_estado_generar_movimiento_contable_automatico_global = $('#cod_estado_generar_movimiento_contable_automatico_global').val();
var cod_estado_promediar_precio_compra_y_venta_cargar_factura_global = $('#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global').val();
var cod_estado_btn_imp_pos_nav_orden_compra_global = $('#cod_estado_btn_imp_pos_nav_orden_compra_global').val();
var cod_estado_btn_imp_pos_direct_driv_orden_compra_global = $('#cod_estado_btn_imp_pos_direct_driv_orden_compra_global').val();
var cod_estado_btn_imp_carta_nav_orden_compra_pdf_global = $('#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global').val();
var cod_estado_converir_und_a_caja_mostrar_imprimir_global = $('#cod_estado_converir_und_a_caja_mostrar_imprimir_global').val();
var cod_estado_sistema_transferencia_interna_global = $('#cod_estado_sistema_transferencia_interna_global').val();
var cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global = $('#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global').val();
var cod_estado_empresa_transferencia_directa_global = $('#cod_estado_empresa_transferencia_directa_global').val();
var cod_estado_forzar_dos_decimales_und_venta_step_html_global = $('#cod_estado_forzar_dos_decimales_und_venta_step_html_global').val();
var cod_estado_tipo_producto_global = $('#cod_estado_tipo_producto_global').val();
var cod_estado_deshabilitar_total_editable_cargarfacturacompr_global = $('#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global').val();
var cod_estado_modulo_puc_global = $('#cod_estado_modulo_puc_global').val();
var cod_estado_deshabilitar_edicion_totales_factura_compra_global = $('#cod_estado_deshabilitar_edicion_totales_factura_compra_global').val();
var cod_estado_enviar_factura_venta_electronica_dian_api_global = $('#cod_estado_enviar_factura_venta_electronica_dian_api_global').val();
var cod_estado_modelo_factura_tirilla_avenidajuan_global = $('#cod_estado_modelo_factura_tirilla_avenidajuan_global').val();
var cod_estado_dia_sin_iva_global = $('#cod_estado_dia_sin_iva_global').val();
var cod_estado_campos_sector_salud_global = $('#cod_estado_campos_sector_salud_global').val();
var cod_estado_perfil_sociodemografico_global = $('#cod_estado_perfil_sociodemografico_global').val();
var cod_estado_mostrar_descuento_manual_factura_venta_global = $('#cod_estado_mostrar_descuento_manual_factura_venta_global').val();
var cod_estado_reporte_por_caja_virtual_global = $('#cod_estado_reporte_por_caja_virtual_global').val();
var cod_estado_puntos_redimibles_campanya_global = $('#cod_estado_puntos_redimibles_campanya_global').val();
var cod_estado_enviar_factura_documento_soporte_dian_api_global = $('#cod_estado_enviar_factura_documento_soporte_dian_api_global').val();
var cod_estado_movimiento_contable_caja_personal_global = $('#cod_estado_movimiento_contable_caja_personal_global').val();
var cod_estado_deshabilitar_descuento_impresion_venta_global = $('#cod_estado_deshabilitar_descuento_impresion_venta_global').val();
var cod_estado_retefuente_global = $('#cod_estado_retefuente_global').val();
var cod_estado_reteica_global = $('#cod_estado_reteica_global').val();
var cod_estado_reteiva_global = $('#cod_estado_reteiva_global').val();
var cod_estado_verificar_precio_venta_en_cero_venta_temp_global = $('#cod_estado_verificar_precio_venta_en_cero_venta_temp_global').val();
var cod_estado_reporte_venta_total_compra_caja_registradora_global = $('#cod_estado_reporte_venta_total_compra_caja_registradora_global').val();
var cod_estado_provee_fechacompra_inv_masivo_global = $('#cod_estado_provee_fechacompra_inv_masivo_global').val();
var cod_estado_nota_credito_global = $('#cod_estado_nota_credito_global').val();
var cod_estado_nota_debito_global = $('#cod_estado_nota_debito_global').val();
var cod_estado_renta_alquiler_global = $('#cod_estado_renta_alquiler_global').val();
var cod_estado_nuevo_inventario_con_existencia_global = $('#cod_estado_nuevo_inventario_con_existencia_global').val();
var cod_estado_edicion_fact_compra_e_inv_global = $('#cod_estado_edicion_fact_compra_e_inv_global').val();
var cod_estado_saldo_recarga_global = $('#cod_estado_saldo_recarga_global').val();
var cod_estado_puntos_redimibles_campanya_recarga_global = $('#cod_estado_puntos_redimibles_campanya_recarga_global').val();
var cod_estado_tipo_servicio_global = $('#cod_estado_tipo_servicio_global').val();
var cod_estado_subproducto_cuenta_servicio_global = $('#cod_estado_subproducto_cuenta_servicio_global').val();
var cod_estado_modulo_cuenta_pagar_abono_editar_compra_global = $('#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global').val();
var cod_estado_verificar_unidad_venta_en_cero_venta_temp_global = $('#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global').val();
var cod_estado_factura_electronica_sector_salud_global = $('#cod_estado_factura_electronica_sector_salud_global').val();
var cod_estado_producto_destacado_global = $('#cod_estado_producto_destacado_global').val();
var cod_estado_tienda_global = $('#cod_estado_tienda_global').val();
var cod_estado_tipo_rol_sistecredito_global = $('#cod_estado_tipo_rol_sistecredito_global').val();



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
if (cod_estado_parqueo_hotel_global=='1') { $('#cod_estado_parqueo_hotel_global').val('1'); $('#cod_estado_parqueo_hotel_global').prop('checked',true); } else { $('#cod_estado_parqueo_hotel_global').val('0'); $('#cod_estado_parqueo_hotel_global').prop('checked',false); } 
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
if (cod_estado_limite_venta_pos_factura_electronica_global=='1') { $('#cod_estado_limite_venta_pos_factura_electronica_global').val('1'); $('#cod_estado_limite_venta_pos_factura_electronica_global').prop('checked',true); } else { $('#cod_estado_limite_venta_pos_factura_electronica_global').val('0'); $('#cod_estado_limite_venta_pos_factura_electronica_global').prop('checked',false); } 
if (cod_estado_recalcular_factura_compra_global=='1') { $('#cod_estado_recalcular_factura_compra_global').val('1'); $('#cod_estado_recalcular_factura_compra_global').prop('checked',true); } else { $('#cod_estado_recalcular_factura_compra_global').val('0'); $('#cod_estado_recalcular_factura_compra_global').prop('checked',false); } 
if (cod_estado_comentario_venta_mostrar_imprimir_global=='1') { $('#cod_estado_comentario_venta_mostrar_imprimir_global').val('1'); $('#cod_estado_comentario_venta_mostrar_imprimir_global').prop('checked',true); } else { $('#cod_estado_comentario_venta_mostrar_imprimir_global').val('0'); $('#cod_estado_comentario_venta_mostrar_imprimir_global').prop('checked',false); } 
if (cod_estado_mostrar_agrupado_produc_repventa_imprimir_global=='1') { $('#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global').val('1'); $('#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global').prop('checked',true); } else { $('#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global').val('0'); $('#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global').prop('checked',false); } 
if (cod_estado_sumar_producto_repetido_venta_temporal_global=='1') { $('#cod_estado_sumar_producto_repetido_venta_temporal_global').val('1'); $('#cod_estado_sumar_producto_repetido_venta_temporal_global').prop('checked',true); } else { $('#cod_estado_sumar_producto_repetido_venta_temporal_global').val('0'); $('#cod_estado_sumar_producto_repetido_venta_temporal_global').prop('checked',false); } 
if (cod_estado_edit_precio_venta_btn_factura_venta_global=='1') { $('#cod_estado_edit_precio_venta_btn_factura_venta_global').val('1'); $('#cod_estado_edit_precio_venta_btn_factura_venta_global').prop('checked',true); } else { $('#cod_estado_edit_precio_venta_btn_factura_venta_global').val('0'); $('#cod_estado_edit_precio_venta_btn_factura_venta_global').prop('checked',false); } 
if (cod_estado_busqueda_venta_manual_resultado_unico_redirect_global=='1') { $('#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global').val('1'); $('#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global').prop('checked',true); } else { $('#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global').val('0'); $('#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global').prop('checked',false); } 
if (cod_estado_soporte_factura_venta_global=='1') { $('#cod_estado_soporte_factura_venta_global').val('1'); $('#cod_estado_soporte_factura_venta_global').prop('checked',true); } else { $('#cod_estado_soporte_factura_venta_global').val('0'); $('#cod_estado_soporte_factura_venta_global').prop('checked',false); } 
if (cod_estado_cargar_factura_compra_simplificada_carniceria_global=='1') { $('#cod_estado_cargar_factura_compra_simplificada_carniceria_global').val('1'); $('#cod_estado_cargar_factura_compra_simplificada_carniceria_global').prop('checked',true); } else { $('#cod_estado_cargar_factura_compra_simplificada_carniceria_global').val('0'); $('#cod_estado_cargar_factura_compra_simplificada_carniceria_global').prop('checked',false); } 
if (cod_estado_cod_barra2_global=='1') { $('#cod_estado_cod_barra2_global').val('1'); $('#cod_estado_cod_barra2_global').prop('checked',true); } else { $('#cod_estado_cod_barra2_global').val('0'); $('#cod_estado_cod_barra2_global').prop('checked',false); } 
if (cod_estado_publicidad_global=='1') { $('#cod_estado_publicidad_global').val('1'); $('#cod_estado_publicidad_global').prop('checked',true); } else { $('#cod_estado_publicidad_global').val('0'); $('#cod_estado_publicidad_global').prop('checked',false); } 
if (cod_estado_habitacion_hotel_global=='1') { $('#cod_estado_habitacion_hotel_global').val('1'); $('#cod_estado_habitacion_hotel_global').prop('checked',true); } else { $('#cod_estado_habitacion_hotel_global').val('0'); $('#cod_estado_habitacion_hotel_global').prop('checked',false); } 
if (cod_estado_tipo_habitacion_hotel_global=='1') { $('#cod_estado_tipo_habitacion_hotel_global').val('1'); $('#cod_estado_tipo_habitacion_hotel_global').prop('checked',true); } else { $('#cod_estado_tipo_habitacion_hotel_global').val('0'); $('#cod_estado_tipo_habitacion_hotel_global').prop('checked',false); } 
if (cod_estado_limpieza_hotel_global=='1') { $('#cod_estado_limpieza_hotel_global').val('1'); $('#cod_estado_limpieza_hotel_global').prop('checked',true); } else { $('#cod_estado_limpieza_hotel_global').val('0'); $('#cod_estado_limpieza_hotel_global').prop('checked',false); } 
if (cod_estado_iva_saludable_ptj_global=='1') { $('#cod_estado_iva_saludable_ptj_global').val('1'); $('#cod_estado_iva_saludable_ptj_global').prop('checked',true); } else { $('#cod_estado_iva_saludable_ptj_global').val('0'); $('#cod_estado_iva_saludable_ptj_global').prop('checked',false); } 
if (cod_estado_pvar_calculo_automatico_pcompra_global=='1') { $('#cod_estado_pvar_calculo_automatico_pcompra_global').val('1'); $('#cod_estado_pvar_calculo_automatico_pcompra_global').prop('checked',true); } else { $('#cod_estado_pvar_calculo_automatico_pcompra_global').val('0'); $('#cod_estado_pvar_calculo_automatico_pcompra_global').prop('checked',false); } 
if (cod_estado_movimiento_contable_cuenta_personal_global=='1') { $('#cod_estado_movimiento_contable_cuenta_personal_global').val('1'); $('#cod_estado_movimiento_contable_cuenta_personal_global').prop('checked',true); } else { $('#cod_estado_movimiento_contable_cuenta_personal_global').val('0'); $('#cod_estado_movimiento_contable_cuenta_personal_global').prop('checked',false); } 
if (cod_estado_mostrar_venta_por_caja_global=='1') { $('#cod_estado_mostrar_venta_por_caja_global').val('1'); $('#cod_estado_mostrar_venta_por_caja_global').prop('checked',true); } else { $('#cod_estado_mostrar_venta_por_caja_global').val('0'); $('#cod_estado_mostrar_venta_por_caja_global').prop('checked',false); } 
if (cod_estado_btn_imp_nav_carta_por_caja_pdf_global=='1') { $('#cod_estado_btn_imp_nav_carta_por_caja_pdf_global').val('1'); $('#cod_estado_btn_imp_nav_carta_por_caja_pdf_global').prop('checked',true); } else { $('#cod_estado_btn_imp_nav_carta_por_caja_pdf_global').val('0'); $('#cod_estado_btn_imp_nav_carta_por_caja_pdf_global').prop('checked',false); } 
if (cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global=='1') { $('#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global').val('1'); $('#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global').prop('checked',true); } else { $('#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global').val('0'); $('#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global').prop('checked',false); } 
if (cod_estado_espacio_firma_bodega_imprimir_global=='1') { $('#cod_estado_espacio_firma_bodega_imprimir_global').val('1'); $('#cod_estado_espacio_firma_bodega_imprimir_global').prop('checked',true); } else { $('#cod_estado_espacio_firma_bodega_imprimir_global').val('0'); $('#cod_estado_espacio_firma_bodega_imprimir_global').prop('checked',false); } 
if (cod_estado_espacio_firma_transportador_imprimir_global=='1') { $('#cod_estado_espacio_firma_transportador_imprimir_global').val('1'); $('#cod_estado_espacio_firma_transportador_imprimir_global').prop('checked',true); } else { $('#cod_estado_espacio_firma_transportador_imprimir_global').val('0'); $('#cod_estado_espacio_firma_transportador_imprimir_global').prop('checked',false); } 
if (cod_estado_tipo_cobro_aviso_alerta_renovacion_global=='1') { $('#cod_estado_tipo_cobro_aviso_alerta_renovacion_global').val('1'); $('#cod_estado_tipo_cobro_aviso_alerta_renovacion_global').prop('checked',true); } else { $('#cod_estado_tipo_cobro_aviso_alerta_renovacion_global').val('0'); $('#cod_estado_tipo_cobro_aviso_alerta_renovacion_global').prop('checked',false); } 
if (cod_estado_domiciliario_global=='1') { $('#cod_estado_domiciliario_global').val('1'); $('#cod_estado_domiciliario_global').prop('checked',true); } else { $('#cod_estado_domiciliario_global').val('0'); $('#cod_estado_domiciliario_global').prop('checked',false); } 
if (cod_estado_generar_movimiento_contable_automatico_global=='1') { $('#cod_estado_generar_movimiento_contable_automatico_global').val('1'); $('#cod_estado_generar_movimiento_contable_automatico_global').prop('checked',true); } else { $('#cod_estado_generar_movimiento_contable_automatico_global').val('0'); $('#cod_estado_generar_movimiento_contable_automatico_global').prop('checked',false); } 
if (cod_estado_promediar_precio_compra_y_venta_cargar_factura_global=='1') { $('#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global').val('1'); $('#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global').prop('checked',true); } else { $('#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global').val('0'); $('#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global').prop('checked',false); } 
if (cod_estado_btn_imp_pos_nav_orden_compra_global=='1') { $('#cod_estado_btn_imp_pos_nav_orden_compra_global').val('1'); $('#cod_estado_btn_imp_pos_nav_orden_compra_global').prop('checked',true); } else { $('#cod_estado_btn_imp_pos_nav_orden_compra_global').val('0'); $('#cod_estado_btn_imp_pos_nav_orden_compra_global').prop('checked',false); } 
if (cod_estado_btn_imp_pos_direct_driv_orden_compra_global=='1') { $('#cod_estado_btn_imp_pos_direct_driv_orden_compra_global').val('1'); $('#cod_estado_btn_imp_pos_direct_driv_orden_compra_global').prop('checked',true); } else { $('#cod_estado_btn_imp_pos_direct_driv_orden_compra_global').val('0'); $('#cod_estado_btn_imp_pos_direct_driv_orden_compra_global').prop('checked',false); } 
if (cod_estado_btn_imp_carta_nav_orden_compra_pdf_global=='1') { $('#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global').val('1'); $('#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global').prop('checked',true); } else { $('#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global').val('0'); $('#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global').prop('checked',false); } 
if (cod_estado_converir_und_a_caja_mostrar_imprimir_global=='1') { $('#cod_estado_converir_und_a_caja_mostrar_imprimir_global').val('1'); $('#cod_estado_converir_und_a_caja_mostrar_imprimir_global').prop('checked',true); } else { $('#cod_estado_converir_und_a_caja_mostrar_imprimir_global').val('0'); $('#cod_estado_converir_und_a_caja_mostrar_imprimir_global').prop('checked',false); } 
if (cod_estado_sistema_transferencia_interna_global=='1') { $('#cod_estado_sistema_transferencia_interna_global').val('1'); $('#cod_estado_sistema_transferencia_interna_global').prop('checked',true); } else { $('#cod_estado_sistema_transferencia_interna_global').val('0'); $('#cod_estado_sistema_transferencia_interna_global').prop('checked',false); } 
if (cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global=='1') { $('#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global').val('1'); $('#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global').prop('checked',true); } else { $('#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global').val('0'); $('#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global').prop('checked',false); } 
if (cod_estado_empresa_transferencia_directa_global=='1') { $('#cod_estado_empresa_transferencia_directa_global').val('1'); $('#cod_estado_empresa_transferencia_directa_global').prop('checked',true); } else { $('#cod_estado_empresa_transferencia_directa_global').val('0'); $('#cod_estado_empresa_transferencia_directa_global').prop('checked',false); } 
if (cod_estado_forzar_dos_decimales_und_venta_step_html_global=='1') { $('#cod_estado_forzar_dos_decimales_und_venta_step_html_global').val('1'); $('#cod_estado_forzar_dos_decimales_und_venta_step_html_global').prop('checked',true); } else { $('#cod_estado_forzar_dos_decimales_und_venta_step_html_global').val('0'); $('#cod_estado_forzar_dos_decimales_und_venta_step_html_global').prop('checked',false); } 
if (cod_estado_tipo_producto_global=='1') { $('#cod_estado_tipo_producto_global').val('1'); $('#cod_estado_tipo_producto_global').prop('checked',true); } else { $('#cod_estado_tipo_producto_global').val('0'); $('#cod_estado_tipo_producto_global').prop('checked',false); } 
if (cod_estado_deshabilitar_total_editable_cargarfacturacompr_global=='1') { $('#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global').val('1'); $('#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global').prop('checked',true); } else { $('#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global').val('0'); $('#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global').prop('checked',false); } 
if (cod_estado_modulo_puc_global=='1') { $('#cod_estado_modulo_puc_global').val('1'); $('#cod_estado_modulo_puc_global').prop('checked',true); } else { $('#cod_estado_modulo_puc_global').val('0'); $('#cod_estado_modulo_puc_global').prop('checked',false); } 
if (cod_estado_deshabilitar_edicion_totales_factura_compra_global=='1') { $('#cod_estado_deshabilitar_edicion_totales_factura_compra_global').val('1'); $('#cod_estado_deshabilitar_edicion_totales_factura_compra_global').prop('checked',true); } else { $('#cod_estado_deshabilitar_edicion_totales_factura_compra_global').val('0'); $('#cod_estado_deshabilitar_edicion_totales_factura_compra_global').prop('checked',false); } 
if (cod_estado_enviar_factura_venta_electronica_dian_api_global=='1') { $('#cod_estado_enviar_factura_venta_electronica_dian_api_global').val('1'); $('#cod_estado_enviar_factura_venta_electronica_dian_api_global').prop('checked',true); } else { $('#cod_estado_enviar_factura_venta_electronica_dian_api_global').val('0'); $('#cod_estado_enviar_factura_venta_electronica_dian_api_global').prop('checked',false); } 
if (cod_estado_modelo_factura_tirilla_avenidajuan_global=='1') { $('#cod_estado_modelo_factura_tirilla_avenidajuan_global').val('1'); $('#cod_estado_modelo_factura_tirilla_avenidajuan_global').prop('checked',true); } else { $('#cod_estado_modelo_factura_tirilla_avenidajuan_global').val('0'); $('#cod_estado_modelo_factura_tirilla_avenidajuan_global').prop('checked',false); } 
if (cod_estado_dia_sin_iva_global=='1') { $('#cod_estado_dia_sin_iva_global').val('1'); $('#cod_estado_dia_sin_iva_global').prop('checked',true); } else { $('#cod_estado_dia_sin_iva_global').val('0'); $('#cod_estado_dia_sin_iva_global').prop('checked',false); } 
if (cod_estado_campos_sector_salud_global=='1') { $('#cod_estado_campos_sector_salud_global').val('1'); $('#cod_estado_campos_sector_salud_global').prop('checked',true); } else { $('#cod_estado_campos_sector_salud_global').val('0'); $('#cod_estado_campos_sector_salud_global').prop('checked',false); } 
if (cod_estado_perfil_sociodemografico_global=='1') { $('#cod_estado_perfil_sociodemografico_global').val('1'); $('#cod_estado_perfil_sociodemografico_global').prop('checked',true); } else { $('#cod_estado_perfil_sociodemografico_global').val('0'); $('#cod_estado_perfil_sociodemografico_global').prop('checked',false); } 
if (cod_estado_mostrar_descuento_manual_factura_venta_global=='1') { $('#cod_estado_mostrar_descuento_manual_factura_venta_global').val('1'); $('#cod_estado_mostrar_descuento_manual_factura_venta_global').prop('checked',true); } else { $('#cod_estado_mostrar_descuento_manual_factura_venta_global').val('0'); $('#cod_estado_mostrar_descuento_manual_factura_venta_global').prop('checked',false); } 
if (cod_estado_reporte_por_caja_virtual_global=='1') { $('#cod_estado_reporte_por_caja_virtual_global').val('1'); $('#cod_estado_reporte_por_caja_virtual_global').prop('checked',true); } else { $('#cod_estado_reporte_por_caja_virtual_global').val('0'); $('#cod_estado_reporte_por_caja_virtual_global').prop('checked',false); } 
if (cod_estado_puntos_redimibles_campanya_global=='1') { $('#cod_estado_puntos_redimibles_campanya_global').val('1'); $('#cod_estado_puntos_redimibles_campanya_global').prop('checked',true); } else { $('#cod_estado_puntos_redimibles_campanya_global').val('0'); $('#cod_estado_puntos_redimibles_campanya_global').prop('checked',false); } 
if (cod_estado_enviar_factura_documento_soporte_dian_api_global=='1') { $('#cod_estado_enviar_factura_documento_soporte_dian_api_global').val('1'); $('#cod_estado_enviar_factura_documento_soporte_dian_api_global').prop('checked',true); } else { $('#cod_estado_enviar_factura_documento_soporte_dian_api_global').val('0'); $('#cod_estado_enviar_factura_documento_soporte_dian_api_global').prop('checked',false); } 
if (cod_estado_movimiento_contable_caja_personal_global=='1') { $('#cod_estado_movimiento_contable_caja_personal_global').val('1'); $('#cod_estado_movimiento_contable_caja_personal_global').prop('checked',true); } else { $('#cod_estado_movimiento_contable_caja_personal_global').val('0'); $('#cod_estado_movimiento_contable_caja_personal_global').prop('checked',false); } 
if (cod_estado_deshabilitar_descuento_impresion_venta_global=='1') { $('#cod_estado_deshabilitar_descuento_impresion_venta_global').val('1'); $('#cod_estado_deshabilitar_descuento_impresion_venta_global').prop('checked',true); } else { $('#cod_estado_deshabilitar_descuento_impresion_venta_global').val('0'); $('#cod_estado_deshabilitar_descuento_impresion_venta_global').prop('checked',false); } 
if (cod_estado_retefuente_global=='1') { $('#cod_estado_retefuente_global').val('1'); $('#cod_estado_retefuente_global').prop('checked',true); } else { $('#cod_estado_retefuente_global').val('0'); $('#cod_estado_retefuente_global').prop('checked',false); } 
if (cod_estado_reteica_global=='1') { $('#cod_estado_reteica_global').val('1'); $('#cod_estado_reteica_global').prop('checked',true); } else { $('#cod_estado_reteica_global').val('0'); $('#cod_estado_reteica_global').prop('checked',false); } 
if (cod_estado_reteiva_global=='1') { $('#cod_estado_reteiva_global').val('1'); $('#cod_estado_reteiva_global').prop('checked',true); } else { $('#cod_estado_reteiva_global').val('0'); $('#cod_estado_reteiva_global').prop('checked',false); } 
if (cod_estado_verificar_precio_venta_en_cero_venta_temp_global=='1') { $('#cod_estado_verificar_precio_venta_en_cero_venta_temp_global').val('1'); $('#cod_estado_verificar_precio_venta_en_cero_venta_temp_global').prop('checked',true); } else { $('#cod_estado_verificar_precio_venta_en_cero_venta_temp_global').val('0'); $('#cod_estado_verificar_precio_venta_en_cero_venta_temp_global').prop('checked',false); } 
if (cod_estado_reporte_venta_total_compra_caja_registradora_global=='1') { $('#cod_estado_reporte_venta_total_compra_caja_registradora_global').val('1'); $('#cod_estado_reporte_venta_total_compra_caja_registradora_global').prop('checked',true); } else { $('#cod_estado_reporte_venta_total_compra_caja_registradora_global').val('0'); $('#cod_estado_reporte_venta_total_compra_caja_registradora_global').prop('checked',false); } 
if (cod_estado_provee_fechacompra_inv_masivo_global=='1') { $('#cod_estado_provee_fechacompra_inv_masivo_global').val('1'); $('#cod_estado_provee_fechacompra_inv_masivo_global').prop('checked',true); } else { $('#cod_estado_provee_fechacompra_inv_masivo_global').val('0'); $('#cod_estado_provee_fechacompra_inv_masivo_global').prop('checked',false); } 
if (cod_estado_nota_credito_global=='1') { $('#cod_estado_nota_credito_global').val('1'); $('#cod_estado_nota_credito_global').prop('checked',true); } else { $('#cod_estado_nota_credito_global').val('0'); $('#cod_estado_nota_credito_global').prop('checked',false); } 
if (cod_estado_nota_debito_global=='1') { $('#cod_estado_nota_debito_global').val('1'); $('#cod_estado_nota_debito_global').prop('checked',true); } else { $('#cod_estado_nota_debito_global').val('0'); $('#cod_estado_nota_debito_global').prop('checked',false); } 
if (cod_estado_renta_alquiler_global=='1') { $('#cod_estado_renta_alquiler_global').val('1'); $('#cod_estado_renta_alquiler_global').prop('checked',true); } else { $('#cod_estado_renta_alquiler_global').val('0'); $('#cod_estado_renta_alquiler_global').prop('checked',false); } 
if (cod_estado_nuevo_inventario_con_existencia_global=='1') { $('#cod_estado_nuevo_inventario_con_existencia_global').val('1'); $('#cod_estado_nuevo_inventario_con_existencia_global').prop('checked',true); } else { $('#cod_estado_nuevo_inventario_con_existencia_global').val('0'); $('#cod_estado_nuevo_inventario_con_existencia_global').prop('checked',false); } 
if (cod_estado_edicion_fact_compra_e_inv_global=='1') { $('#cod_estado_edicion_fact_compra_e_inv_global').val('1'); $('#cod_estado_edicion_fact_compra_e_inv_global').prop('checked',true); } else { $('#cod_estado_edicion_fact_compra_e_inv_global').val('0'); $('#cod_estado_edicion_fact_compra_e_inv_global').prop('checked',false); } 
if (cod_estado_saldo_recarga_global=='1') { $('#cod_estado_saldo_recarga_global').val('1'); $('#cod_estado_saldo_recarga_global').prop('checked',true); } else { $('#cod_estado_saldo_recarga_global').val('0'); $('#cod_estado_saldo_recarga_global').prop('checked',false); } 
if (cod_estado_puntos_redimibles_campanya_recarga_global=='1') { $('#cod_estado_puntos_redimibles_campanya_recarga_global').val('1'); $('#cod_estado_puntos_redimibles_campanya_recarga_global').prop('checked',true); } else { $('#cod_estado_puntos_redimibles_campanya_recarga_global').val('0'); $('#cod_estado_puntos_redimibles_campanya_recarga_global').prop('checked',false); } 
if (cod_estado_tipo_servicio_global=='1') { $('#cod_estado_tipo_servicio_global').val('1'); $('#cod_estado_tipo_servicio_global').prop('checked',true); } else { $('#cod_estado_tipo_servicio_global').val('0'); $('#cod_estado_tipo_servicio_global').prop('checked',false); } 
if (cod_estado_subproducto_cuenta_servicio_global=='1') { $('#cod_estado_subproducto_cuenta_servicio_global').val('1'); $('#cod_estado_subproducto_cuenta_servicio_global').prop('checked',true); } else { $('#cod_estado_subproducto_cuenta_servicio_global').val('0'); $('#cod_estado_subproducto_cuenta_servicio_global').prop('checked',false); } 
if (cod_estado_modulo_cuenta_pagar_abono_editar_compra_global=='1') { $('#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global').val('1'); $('#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global').prop('checked',true); } else { $('#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global').val('0'); $('#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global').prop('checked',false); } 
if (cod_estado_verificar_unidad_venta_en_cero_venta_temp_global=='1') { $('#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global').val('1'); $('#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global').prop('checked',true); } else { $('#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global').val('0'); $('#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global').prop('checked',false); } 
if (cod_estado_factura_electronica_sector_salud_global=='1') { $('#cod_estado_factura_electronica_sector_salud_global').val('1'); $('#cod_estado_factura_electronica_sector_salud_global').prop('checked',true); } else { $('#cod_estado_factura_electronica_sector_salud_global').val('0'); $('#cod_estado_factura_electronica_sector_salud_global').prop('checked',false); } 
if (cod_estado_producto_destacado_global=='1') { $('#cod_estado_producto_destacado_global').val('1'); $('#cod_estado_producto_destacado_global').prop('checked',true); } else { $('#cod_estado_producto_destacado_global').val('0'); $('#cod_estado_producto_destacado_global').prop('checked',false); } 
if (cod_estado_tienda_global=='1') { $('#cod_estado_tienda_global').val('1'); $('#cod_estado_tienda_global').prop('checked',true); } else { $('#cod_estado_tienda_global').val('0'); $('#cod_estado_tienda_global').prop('checked',false); } 
if (cod_estado_tipo_rol_sistecredito_global=='1') { $('#cod_estado_tipo_rol_sistecredito_global').val('1'); $('#cod_estado_tipo_rol_sistecredito_global').prop('checked',true); } else { $('#cod_estado_tipo_rol_sistecredito_global').val('0'); $('#cod_estado_tipo_rol_sistecredito_global').prop('checked',false); } 




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
$("#cod_estado_parqueo_hotel_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_parqueo_hotel_global").val("1"); } else { $("#cod_estado_parqueo_hotel_global").val("0"); } });
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
$("#cod_estado_limite_venta_pos_factura_electronica_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_limite_venta_pos_factura_electronica_global").val("1"); } else { $("#cod_estado_limite_venta_pos_factura_electronica_global").val("0"); } });
$("#cod_estado_recalcular_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_recalcular_factura_compra_global").val("1"); } else { $("#cod_estado_recalcular_factura_compra_global").val("0"); } });
$("#cod_estado_comentario_venta_mostrar_imprimir_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_comentario_venta_mostrar_imprimir_global").val("1"); } else { $("#cod_estado_comentario_venta_mostrar_imprimir_global").val("0"); } });
$("#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global").val("1"); } else { $("#cod_estado_mostrar_agrupado_produc_repventa_imprimir_global").val("0"); } });
$("#cod_estado_sumar_producto_repetido_venta_temporal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_sumar_producto_repetido_venta_temporal_global").val("1"); } else { $("#cod_estado_sumar_producto_repetido_venta_temporal_global").val("0"); } });
$("#cod_estado_edit_precio_venta_btn_factura_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_edit_precio_venta_btn_factura_venta_global").val("1"); } else { $("#cod_estado_edit_precio_venta_btn_factura_venta_global").val("0"); } });
$("#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global").val("1"); } else { $("#cod_estado_busqueda_venta_manual_resultado_unico_redirect_global").val("0"); } });
$("#cod_estado_soporte_factura_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_soporte_factura_venta_global").val("1"); } else { $("#cod_estado_soporte_factura_venta_global").val("0"); } });
$("#cod_estado_cargar_factura_compra_simplificada_carniceria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cargar_factura_compra_simplificada_carniceria_global").val("1"); } else { $("#cod_estado_cargar_factura_compra_simplificada_carniceria_global").val("0"); } });
$("#cod_estado_cod_barra2_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cod_barra2_global").val("1"); } else { $("#cod_estado_cod_barra2_global").val("0"); } });
$("#cod_estado_publicidad_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_publicidad_global").val("1"); } else { $("#cod_estado_publicidad_global").val("0"); } });
$("#cod_estado_habitacion_hotel_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habitacion_hotel_global").val("1"); } else { $("#cod_estado_habitacion_hotel_global").val("0"); } });
$("#cod_estado_tipo_habitacion_hotel_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_habitacion_hotel_global").val("1"); } else { $("#cod_estado_tipo_habitacion_hotel_global").val("0"); } });
$("#cod_estado_limpieza_hotel_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_limpieza_hotel_global").val("1"); } else { $("#cod_estado_limpieza_hotel_global").val("0"); } });
$("#cod_estado_iva_saludable_ptj_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_iva_saludable_ptj_global").val("1"); } else { $("#cod_estado_iva_saludable_ptj_global").val("0"); } });
$("#cod_estado_pvar_calculo_automatico_pcompra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_pvar_calculo_automatico_pcompra_global").val("1"); } else { $("#cod_estado_pvar_calculo_automatico_pcompra_global").val("0"); } });
$("#cod_estado_movimiento_contable_cuenta_personal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_movimiento_contable_cuenta_personal_global").val("1"); } else { $("#cod_estado_movimiento_contable_cuenta_personal_global").val("0"); } });
$("#cod_estado_mostrar_venta_por_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_mostrar_venta_por_caja_global").val("1"); } else { $("#cod_estado_mostrar_venta_por_caja_global").val("0"); } });
$("#cod_estado_btn_imp_nav_carta_por_caja_pdf_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imp_nav_carta_por_caja_pdf_global").val("1"); } else { $("#cod_estado_btn_imp_nav_carta_por_caja_pdf_global").val("0"); } });
$("#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global").val("1"); } else { $("#cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global").val("0"); } });
$("#cod_estado_espacio_firma_bodega_imprimir_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_espacio_firma_bodega_imprimir_global").val("1"); } else { $("#cod_estado_espacio_firma_bodega_imprimir_global").val("0"); } });
$("#cod_estado_espacio_firma_transportador_imprimir_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_espacio_firma_transportador_imprimir_global").val("1"); } else { $("#cod_estado_espacio_firma_transportador_imprimir_global").val("0"); } });
$("#cod_estado_tipo_cobro_aviso_alerta_renovacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_cobro_aviso_alerta_renovacion_global").val("1"); } else { $("#cod_estado_tipo_cobro_aviso_alerta_renovacion_global").val("0"); } });
$("#cod_estado_domiciliario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_domiciliario_global").val("1"); } else { $("#cod_estado_domiciliario_global").val("0"); } });
$("#cod_estado_generar_movimiento_contable_automatico_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_generar_movimiento_contable_automatico_global").val("1"); } else { $("#cod_estado_generar_movimiento_contable_automatico_global").val("0"); } });
$("#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global").val("1"); } else { $("#cod_estado_promediar_precio_compra_y_venta_cargar_factura_global").val("0"); } });
$("#cod_estado_btn_imp_pos_nav_orden_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imp_pos_nav_orden_compra_global").val("1"); } else { $("#cod_estado_btn_imp_pos_nav_orden_compra_global").val("0"); } });
$("#cod_estado_btn_imp_pos_direct_driv_orden_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imp_pos_direct_driv_orden_compra_global").val("1"); } else { $("#cod_estado_btn_imp_pos_direct_driv_orden_compra_global").val("0"); } });
$("#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global").val("1"); } else { $("#cod_estado_btn_imp_carta_nav_orden_compra_pdf_global").val("0"); } });
$("#cod_estado_converir_und_a_caja_mostrar_imprimir_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_converir_und_a_caja_mostrar_imprimir_global").val("1"); } else { $("#cod_estado_converir_und_a_caja_mostrar_imprimir_global").val("0"); } });
$("#cod_estado_sistema_transferencia_interna_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_sistema_transferencia_interna_global").val("1"); } else { $("#cod_estado_sistema_transferencia_interna_global").val("0"); } });
$("#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global").val("1"); } else { $("#cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global").val("0"); } });
$("#cod_estado_empresa_transferencia_directa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_empresa_transferencia_directa_global").val("1"); } else { $("#cod_estado_empresa_transferencia_directa_global").val("0"); } });
$("#cod_estado_forzar_dos_decimales_und_venta_step_html_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_forzar_dos_decimales_und_venta_step_html_global").val("1"); } else { $("#cod_estado_forzar_dos_decimales_und_venta_step_html_global").val("0"); } });
$("#cod_estado_tipo_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_producto_global").val("1"); } else { $("#cod_estado_tipo_producto_global").val("0"); } });
$("#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global").val("1"); } else { $("#cod_estado_deshabilitar_total_editable_cargarfacturacompr_global").val("0"); } });
$("#cod_estado_modulo_puc_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_puc_global").val("1"); } else { $("#cod_estado_modulo_puc_global").val("0"); } });
$("#cod_estado_deshabilitar_edicion_totales_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_deshabilitar_edicion_totales_factura_compra_global").val("1"); } else { $("#cod_estado_deshabilitar_edicion_totales_factura_compra_global").val("0"); } });
$("#cod_estado_enviar_factura_venta_electronica_dian_api_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_enviar_factura_venta_electronica_dian_api_global").val("1"); } else { $("#cod_estado_enviar_factura_venta_electronica_dian_api_global").val("0"); } });
$("#cod_estado_modelo_factura_tirilla_avenidajuan_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modelo_factura_tirilla_avenidajuan_global").val("1"); } else { $("#cod_estado_modelo_factura_tirilla_avenidajuan_global").val("0"); } });
$("#cod_estado_dia_sin_iva_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dia_sin_iva_global").val("1"); } else { $("#cod_estado_dia_sin_iva_global").val("0"); } });
$("#cod_estado_campos_sector_salud_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_campos_sector_salud_global").val("1"); } else { $("#cod_estado_campos_sector_salud_global").val("0"); } });
$("#cod_estado_perfil_sociodemografico_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_perfil_sociodemografico_global").val("1"); } else { $("#cod_estado_perfil_sociodemografico_global").val("0"); } });
$("#cod_estado_mostrar_descuento_manual_factura_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_mostrar_descuento_manual_factura_venta_global").val("1"); } else { $("#cod_estado_mostrar_descuento_manual_factura_venta_global").val("0"); } });
$("#cod_estado_reporte_por_caja_virtual_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reporte_por_caja_virtual_global").val("1"); } else { $("#cod_estado_reporte_por_caja_virtual_global").val("0"); } });
$("#cod_estado_puntos_redimibles_campanya_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_puntos_redimibles_campanya_global").val("1"); } else { $("#cod_estado_puntos_redimibles_campanya_global").val("0"); } });
$("#cod_estado_enviar_factura_documento_soporte_dian_api_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_enviar_factura_documento_soporte_dian_api_global").val("1"); } else { $("#cod_estado_enviar_factura_documento_soporte_dian_api_global").val("0"); } });
$("#cod_estado_movimiento_contable_caja_personal_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_movimiento_contable_caja_personal_global").val("1"); } else { $("#cod_estado_movimiento_contable_caja_personal_global").val("0"); } });
$("#cod_estado_deshabilitar_descuento_impresion_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_deshabilitar_descuento_impresion_venta_global").val("1"); } else { $("#cod_estado_deshabilitar_descuento_impresion_venta_global").val("0"); } });
$("#cod_estado_retefuente_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_retefuente_global").val("1"); } else { $("#cod_estado_retefuente_global").val("0"); } });
$("#cod_estado_reteica_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reteica_global").val("1"); } else { $("#cod_estado_reteica_global").val("0"); } });
$("#cod_estado_reteiva_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reteiva_global").val("1"); } else { $("#cod_estado_reteiva_global").val("0"); } });
$("#cod_estado_verificar_precio_venta_en_cero_venta_temp_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_verificar_precio_venta_en_cero_venta_temp_global").val("1"); } else { $("#cod_estado_verificar_precio_venta_en_cero_venta_temp_global").val("0"); } });
$("#cod_estado_reporte_venta_total_compra_caja_registradora_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_reporte_venta_total_compra_caja_registradora_global").val("1"); } else { $("#cod_estado_reporte_venta_total_compra_caja_registradora_global").val("0"); } });
$("#cod_estado_provee_fechacompra_inv_masivo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_provee_fechacompra_inv_masivo_global").val("1"); } else { $("#cod_estado_provee_fechacompra_inv_masivo_global").val("0"); } });
$("#cod_estado_nota_credito_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nota_credito_global").val("1"); } else { $("#cod_estado_nota_credito_global").val("0"); } });
$("#cod_estado_nota_debito_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nota_debito_global").val("1"); } else { $("#cod_estado_nota_debito_global").val("0"); } });
$("#cod_estado_renta_alquiler_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_renta_alquiler_global").val("1"); } else { $("#cod_estado_renta_alquiler_global").val("0"); } });
$("#cod_estado_nuevo_inventario_con_existencia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nuevo_inventario_con_existencia_global").val("1"); } else { $("#cod_estado_nuevo_inventario_con_existencia_global").val("0"); } });
$("#cod_estado_edicion_fact_compra_e_inv_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_edicion_fact_compra_e_inv_global").val("1"); } else { $("#cod_estado_edicion_fact_compra_e_inv_global").val("0"); } });
$("#cod_estado_saldo_recarga_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_saldo_recarga_global").val("1"); } else { $("#cod_estado_saldo_recarga_global").val("0"); } });
$("#cod_estado_puntos_redimibles_campanya_recarga_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_puntos_redimibles_campanya_recarga_global").val("1"); } else { $("#cod_estado_puntos_redimibles_campanya_recarga_global").val("0"); } });
$("#cod_estado_tipo_servicio_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_servicio_global").val("1"); } else { $("#cod_estado_tipo_servicio_global").val("0"); } });
$("#cod_estado_subproducto_cuenta_servicio_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subproducto_cuenta_servicio_global").val("1"); } else { $("#cod_estado_subproducto_cuenta_servicio_global").val("0"); } });
$("#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global").val("1"); } else { $("#cod_estado_modulo_cuenta_pagar_abono_editar_compra_global").val("0"); } });
$("#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global").val("1"); } else { $("#cod_estado_verificar_unidad_venta_en_cero_venta_temp_global").val("0"); } });
$("#cod_estado_factura_electronica_sector_salud_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_electronica_sector_salud_global").val("1"); } else { $("#cod_estado_factura_electronica_sector_salud_global").val("0"); } });
$("#cod_estado_producto_destacado_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_destacado_global").val("1"); } else { $("#cod_estado_producto_destacado_global").val("0"); } });
$("#cod_estado_tienda_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tienda_global").val("1"); } else { $("#cod_estado_tienda_global").val("0"); } });
$("#cod_estado_tipo_rol_sistecredito_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_tipo_rol_sistecredito_global").val("1"); } else { $("#cod_estado_tipo_rol_sistecredito_global").val("0"); } });

});
</script>


<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_info_empresa";
        var id_atrib = $(this).attr("class");
        var pagina = "<?php echo $pagina_local; ?>";
        //let id = this.id;
        if (id_atrib == '1' || id_atrib == '0') { var tipo_componente = "checkbox"; } else { var tipo_componente = "input"; }
        if (tipo_componente == 'checkbox') { var id = $(this).attr("class"); } else { var id = $(this).attr("id"); }
        var campo_incre = id;

        var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_permisos_info_empresa_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
	            $('#'+campo+''+id).html('<img src="../imagenes/loading.gif">');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;
                if ((afectado == 'SI')) {
                	$('#'+campo+''+id).html('');
	            	$('#'+campo+''+id).html('<img src="../imagenes/spam_reg.png">');
                } else {
                	$('#'+campo+''+id).html('');
	            	$('#'+campo+''+id).html('Error');
                }
            }
        });
    });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("select").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_info_empresa";
        var id = $(this).attr("id");
        var campo_incre = id;
        var pagina = "<?php echo $pagina_local; ?>";
        //let id = this.id;
        let c1 = document.getElementsByName(campo);
        console.log(c1[0].tagName);

        var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_permisos_info_empresa_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;

                if ((afectado == 'SI')) {
                    var subtotal = respuesta.subtotal;
                    var total_precio_ipc = respuesta.total_precio_ipc;
                    //$("#subtotal").html(''+subtotal);
                }
            }
        });
    });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("textarea").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_info_empresa";
        var id = $(this).attr("id");
        var campo_incre = id;
        var pagina = "<?php echo $pagina_local; ?>";
        //let id = this.id;
        let c1 = document.getElementsByName(campo);
        console.log(c1[0].tagName);

        var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_permisos_info_empresa_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;

                if ((afectado == 'SI')) {
                    var subtotal = respuesta.subtotal;
                    var total_precio_ipc = respuesta.total_precio_ipc;
                    //$("#subtotal").html(''+subtotal);
                }
            }
        });
    });
});
</script>