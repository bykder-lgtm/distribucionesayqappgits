<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
require_once('../evitar_mensaje_error/error.php'); 
date_default_timezone_set("America/Bogota");

include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
      } else { header("Location:../index.php");
}
$cuenta_actual                                  = addslashes($_SESSION['usuario']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_venta                         = intval($_REQUEST['cod_info_factura_venta']);
if (isset($_REQUEST['origen'])) { $origen = $_REQUEST['origen']; } else { $origen = 0; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_info_empresa_global = "SELECT qr_pago_bancolombia, numero_cuenta_pago_bancolombia FROM tbl15_info_empresa_global WHERE cod_info_empresa_global = '1'";
$consultar_info_info_empresa_global = mysqli_query($conectar, $sql_info_info_empresa_global) or die(mysqli_error($conectar));
$info_info_empresa_global = mysqli_fetch_assoc($consultar_info_info_empresa_global);

$qr_pago_bancolombia                                  = $info_info_empresa_global['qr_pago_bancolombia'];
$numero_cuenta_pago_bancolombia                       = $info_info_empresa_global['numero_cuenta_pago_bancolombia'];
$generar_qr_pago_bancolombia                          = $qr_pago_bancolombia;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                        = $info_empresa_data['titulo'];
$nombre_emp                                                        = $info_empresa_data['nombre'];
$eslogan_emp                                                       = $info_empresa_data['eslogan'];
$direccion_emp                                                     = $info_empresa_data['direccion'];
$ciudad_emp                                                        = $info_empresa_data['ciudad'];
$pais_emp                                                          = $info_empresa_data['pais'];
$correo_emp                                                        = $info_empresa_data['correo'];
$correo_notificacion_alerta                                        = $info_empresa_data['correo_notificacion_alerta'];
$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                                      = $info_empresa_data['telefono'];
$info_legal_emp                                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                                 = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                      = $info_empresa_data['cabecera'];
$icono_emp                                                         = $info_empresa_data['icono'];
$desarrollador_emp                                                 = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                                             = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                                          = $info_empresa_data['anyo'];
$url_pag                                                           = $info_empresa_data['url_pag'];
$nombre_font                                                       = $info_empresa_data['nombre_font'];
$res_emp                                                           = $info_empresa_data['res'];
$res1_emp                                                          = $info_empresa_data['res1'];
$res2_emp                                                          = $info_empresa_data['res2'];
$departamento_emp                                                  = $info_empresa_data['departamento'];
$localidad_emp                                                     = $info_empresa_data['localidad'];
$reg_medico_emp                                                    = $info_empresa_data['reg_medico'];
$regimen_emp                                                       = $info_empresa_data['regimen'];
$version_emp                                                       = $info_empresa_data['version'];
$propietario_url_firma_emp                                         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                                    = $info_empresa_data['fecha_time'];
$licencia_emp                                                      = $info_empresa_data['licencia'];
$tamano_font_emp                                                   = $info_empresa_data['tamano_font'];
$info_histclinic_emp                                               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                               = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                                           = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                                           = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                                              = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                                              = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                                          = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                                          = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                                            = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                                              = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual                                     = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                                          = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                                                     = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                                               = $info_empresa_data['nombre_tipo_empresa'];
$cantidad_caja_mesa                                                = $info_empresa_data['cantidad_caja_mesa'];

$ptj_servicio_propina                                              = $info_empresa_data['ptj_servicio_propina'];
$cod_servicio_propina                                              = $info_empresa_data['cod_servicio_propina'];
$nombre_servicio_propina                                           = $info_empresa_data['nombre_servicio_propina'];
$precio_servicio_propina                                           = $info_empresa_data['precio_servicio_propina'];

$tamano_font_sticker_barra_pdf                                     = $info_empresa_data['tamano_font_sticker_barra_pdf'];
$ancho_sticker_barra_pdf                                           = $info_empresa_data['ancho_sticker_barra_pdf'];
$alto_sticker_barra_pdf                                            = $info_empresa_data['alto_sticker_barra_pdf'];
$columnas_sticker_barra_pdf                                        = $info_empresa_data['columnas_sticker_barra_pdf'];
$nombre_estandar_sticker_barra_pdf                                 = $info_empresa_data['nombre_estandar_sticker_barra_pdf'];
$tipo_hoja_sticker_barra_pdf                                       = $info_empresa_data['tipo_hoja_sticker_barra_pdf'];

$titulo                                                            = $info_empresa_data['titulo'];
$dir_oficiana1                                                     = $info_empresa_data['dir_oficiana1'];
$dir_oficiana2                                                     = $info_empresa_data['dir_oficiana2'];
$dir_oficiana3                                                     = $info_empresa_data['dir_oficiana3'];
$dir_oficiana4                                                     = $info_empresa_data['dir_oficiana4'];
$tel1                                                              = $info_empresa_data['tel1'];
$tel2                                                              = $info_empresa_data['tel2'];
$tel3                                                              = $info_empresa_data['tel3'];
$tel4                                                              = $info_empresa_data['tel4'];
$resena_info_empresa                                               = $info_empresa_data['resena_info_empresa'];
$mision_info_empresa                                               = $info_empresa_data['mision_info_empresa'];
$vision_info_empresa                                               = $info_empresa_data['vision_info_empresa'];
$declaracion_privacidad_info_empresa                               = $info_empresa_data['declaracion_privacidad_info_empresa'];
$politica_devolucion_info_empresa                                  = $info_empresa_data['politica_devolucion_info_empresa'];
$info_entrega_info_empresa                                         = $info_empresa_data['info_entrega_info_empresa'];
$keywords                                                          = $info_empresa_data['keywords'];
$description                                                       = $info_empresa_data['description'];
$author                                                            = $info_empresa_data['author'];
$longitud                                                          = $info_empresa_data['longitud'];
$latitud                                                           = $info_empresa_data['latitud'];
$url_mapa1                                                         = $info_empresa_data['url_mapa1'];
$url_mapa2                                                         = $info_empresa_data['url_mapa2'];
$cod_estado_reg_veterinaria                                        = $info_empresa_data['cod_estado_reg_veterinaria'];
$frag_icono                                                        = explode('../', $icono_emp);
$pos_icono                                                         = $frag_icono[1];

$limite_mostrar_producto_lista_caja_virtual                        = $info_empresa_data['limite_mostrar_producto_lista_caja_virtual'];

$appid_api_facebook_autopublicador                                 = $info_empresa_data['appid_api_facebook_autopublicador'];
$xfbml_api_facebook_autopublicador                                 = $info_empresa_data['xfbml_api_facebook_autopublicador'];
$version_api_facebook_autopublicador                               = $info_empresa_data['version_api_facebook_autopublicador'];
$method_api_facebook_autopublicador                                = $info_empresa_data['method_api_facebook_autopublicador'];
$name_api_facebook_autopublicador                                  = $info_empresa_data['name_api_facebook_autopublicador'];
$hashtag_api_facebook_autopublicador                               = $info_empresa_data['hashtag_api_facebook_autopublicador'];
$quote_api_facebook_autopublicador                                 = $info_empresa_data['quote_api_facebook_autopublicador'];
$link_api_facebook_autopublicador                                  = $info_empresa_data['link_api_facebook_autopublicador'];
$href_api_facebook_autopublicador                                  = $info_empresa_data['href_api_facebook_autopublicador'];

$dias_vencimiento_producto_alerta                                  = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global                               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                                     = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                                            = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                                            = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                                        = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                                         = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global                             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra                                   = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global                     = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global                             = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global                              = $info_empresa_data['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global                               = $info_empresa_data['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                                  = $info_empresa_data['cod_estado_sticker_barras_global'];

$cod_estado_modulo_contabilidad_global                             = $info_empresa_data['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global                               = $info_empresa_data['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica                               = $info_empresa_data['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                                = $info_empresa_data['cod_estado_producto_consumo_global'];
$cod_estado_compra_caja_global                                     = $info_empresa_data['cod_estado_compra_caja_global'];
$nombre_tipo_impresora_zebra_ticket                                = $info_empresa_data['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                                   = $info_empresa_data['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                                    = $info_empresa_data['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                                          = $info_empresa_data['cod_estado_egreso_global'];
$cod_estado_usuario_global                                         = $info_empresa_data['cod_estado_usuario_global'];
$cod_estado_dependencia_global                                     = $info_empresa_data['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                                    = $info_empresa_data['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global                              = $info_empresa_data['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                                            = $info_empresa_data['cod_estado_cita_global'];
$cod_estado_factura_compra_global                                  = $info_empresa_data['cod_estado_factura_compra_global'];

$cod_estado_modulo_producto_global                                 = $info_empresa_data['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global                              = $info_empresa_data['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                                    = $info_empresa_data['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                                  = $info_empresa_data['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                                   = $info_empresa_data['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                                  = $info_empresa_data['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                                    = $info_empresa_data['cod_estado_modulo_admin_global'];
$cod_estado_pyg_global                                             = $info_empresa_data['cod_estado_pyg_global'];
$cod_estado_balance_global                                         = $info_empresa_data['cod_estado_balance_global'];
$cod_estado_mov_contable_global                                    = $info_empresa_data['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                                    = $info_empresa_data['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global                         = $info_empresa_data['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                                = $info_empresa_data['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                                       = $info_empresa_data['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                                    = $info_empresa_data['cod_estado_envio_correo_global'];
$cod_estado_ordenamiento_alfabetico_venta_global                   = $info_empresa_data['cod_estado_ordenamiento_alfabetico_venta_global'];

$cod_estado_nocodif_precio_compra_sticker_global                   = $info_empresa_data['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global                    = $info_empresa_data['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global                          = $info_empresa_data['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global                            = $info_empresa_data['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global                             = $info_empresa_data['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global                              = $info_empresa_data['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global                    = $info_empresa_data['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                                      = $info_empresa_data['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                                            = $info_empresa_data['nombre_empresa_sticker'];
$nombre_buscar_por                                                 = $info_empresa_data['nombre_buscar_por'];

$cod_estado_img_producto_global                                    = $info_empresa_data['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global                             = $info_empresa_data['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                                          = $info_empresa_data['cod_estado_animal_global'];
$cod_estado_producto_serial_global                                 = $info_empresa_data['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global                              = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                                 = $info_empresa_data['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global                   = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                                            = $info_empresa_data['nombre_tipo_componente'];
$cod_estado_subproducto_global                                     = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                                = $info_empresa_data['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                                       = $info_empresa_data['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                                     = $info_empresa_data['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global                       = $info_empresa_data['cod_estado_observacion_tercero_venta_global'];

$cod_estado_alerta_fecha_nac_global                                = $info_empresa_data['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                       = $info_empresa_data['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                                   = $info_empresa_data['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                                = $info_empresa_data['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                             = $info_empresa_data['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                            = $info_empresa_data['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                       = $info_empresa_data['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                                     = $info_empresa_data['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                           = $info_empresa_data['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                          = $info_empresa_data['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                        = $info_empresa_data['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                          = $info_empresa_data['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                      = $info_empresa_data['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                          = $info_empresa_data['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                         = $info_empresa_data['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                                     = $info_empresa_data['costo_parqueo'];
$nombre_tipo_cobro_hotel                                           = $info_empresa_data['nombre_tipo_cobro_hotel'];
$costo_hotel                                                       = $info_empresa_data['costo_hotel'];
$cod_estado_parqueo_hotel_global                                   = $info_empresa_data['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                           = $info_empresa_data['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                         = $info_empresa_data['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                           = $info_empresa_data['cod_estado_plan_accion_correcion_global'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global        = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                       = $info_empresa_data['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global            = $info_empresa_data['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global                    = $info_empresa_data['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global                   = $info_empresa_data['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global                   = $info_empresa_data['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global              = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                       = $info_empresa_data['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global                     = $info_empresa_data['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global                    = $info_empresa_data['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                       = $info_empresa_data['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                          = $info_empresa_data['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                                     = $info_empresa_data['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                       = $info_empresa_data['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                                  = $info_empresa_data['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                           = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_proveedor_global                                       = $info_empresa_data['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                                 = $info_empresa_data['cod_estado_archivo_adjunto_global'];
$cod_estado_precio_compra_mod_venta_global                         = $info_empresa_data['cod_estado_precio_compra_mod_venta_global'];

$cod_estado_timbre_entrada_pedido_temporal_cocina_global           = $info_empresa_data['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global            = $info_empresa_data['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_estado_subproducto_mostrar_imprimir_global                    = $info_empresa_data['cod_estado_subproducto_mostrar_imprimir_global'];

$cod_estado_diferencia_ganancia_inventario_global                  = $info_empresa_data['cod_estado_diferencia_ganancia_inventario_global'];
$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global     = $info_empresa_data['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'];
$cod_estado_opcion_descontable_inv_global                          = $info_empresa_data['cod_estado_opcion_descontable_inv_global'];
$cod_estado_hora_reporte_venta_global                              = $info_empresa_data['cod_estado_hora_reporte_venta_global'];

$cod_estado_cantidad_caja_mesa_global                              = $info_empresa_data['cod_estado_cantidad_caja_mesa_global'];
$cod_estado_venta_por_categoria_mod_venta_global                   = $info_empresa_data['cod_estado_venta_por_categoria_mod_venta_global'];
$cod_estado_habilitar_btn_facturar_mod_venta_global                = $info_empresa_data['cod_estado_habilitar_btn_facturar_mod_venta_global'];
$cod_estado_btn_imprimir_preventa_cocina_global                    = $info_empresa_data['cod_estado_btn_imprimir_preventa_cocina_global'];
$cod_estado_producto_de_cocina_global                              = $info_empresa_data['cod_estado_producto_de_cocina_global'];

$cod_estado_posicion_gps_pedidos_global                            = $info_empresa_data['cod_estado_posicion_gps_pedidos_global'];
$cod_estado_precio_venta_variable_disponible_admin_global          = $info_empresa_data['cod_estado_precio_venta_variable_disponible_admin_global'];
$cod_estado_check_imp_global                                       = $info_empresa_data['cod_estado_check_imp_global'];
$cod_estado_dividir_factura_caja_mesa_global                       = $info_empresa_data['cod_estado_dividir_factura_caja_mesa_global'];
$cod_estado_agrupar_por_producto_imp_global                        = $info_empresa_data['cod_estado_agrupar_por_producto_imp_global'];
$cod_estado_descuento_concepto_venta_neg_global                    = $info_empresa_data['cod_estado_descuento_concepto_venta_neg_global'];

$cod_estado_habilitar_btn_imp_venta_nav_global                     = $info_empresa_data['cod_estado_habilitar_btn_imp_venta_nav_global'];
$cod_estado_habilitar_btn_imp_venta_direct_driv_global             = $info_empresa_data['cod_estado_habilitar_btn_imp_venta_direct_driv_global'];
$cod_estado_habilitar_btn_imp_nav_carta_pdf_global                 = $info_empresa_data['cod_estado_habilitar_btn_imp_nav_carta_pdf_global'];
$cod_estado_habilitar_btn_imp_preventodo_nav_global                = $info_empresa_data['cod_estado_habilitar_btn_imp_preventodo_nav_global'];
$cod_estado_habilitar_btn_imp_preventodo_direct_driv_global        = $info_empresa_data['cod_estado_habilitar_btn_imp_preventodo_direct_driv_global'];
$cod_estado_habilitar_btn_imp_cocina_nav_global                    = $info_empresa_data['cod_estado_habilitar_btn_imp_cocina_nav_global'];
$cod_estado_habilitar_btn_imp_cocina_direct_driv_global            = $info_empresa_data['cod_estado_habilitar_btn_imp_cocina_direct_driv_global'];
$cod_estado_habilitar_btn_imp_repventa_consol_nav_global           = $info_empresa_data['cod_estado_habilitar_btn_imp_repventa_consol_nav_global'];
$cod_estado_habilitar_btn_imp_repventa_direct_driv_global          = $info_empresa_data['cod_estado_habilitar_btn_imp_repventa_direct_driv_global'];
$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];

$cod_estado_habilitar_hora_venta_temporal_global                   = $info_empresa_data['cod_estado_habilitar_hora_venta_temporal_global'];
$cod_estado_revisado_venta_temporal_global                         = $info_empresa_data['cod_estado_revisado_venta_temporal_global'];
$cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global        = $info_empresa_data['cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global'];
$cod_estado_prioridad_caja_mesa_global                             = $info_empresa_data['cod_estado_prioridad_caja_mesa_global'];
$cod_estado_transferencia_empresa_extern_global                    = $info_empresa_data['cod_estado_transferencia_empresa_extern_global'];

$cod_estado_descuento_automatico_por_cambio_precio_venta_global    = $info_empresa_data['cod_estado_descuento_automatico_por_cambio_precio_venta_global'];
$cod_estado_btn_categoria_desplegable_global                       = $info_empresa_data['cod_estado_btn_categoria_desplegable_global'];

$cod_estado_consultar_precios_extern_global                        = $info_empresa_data['cod_estado_consultar_precios_extern_global'];
$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global       = $info_empresa_data['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'];
$cod_estado_nombre_producto_editable_factura_compra_global         = $info_empresa_data['cod_estado_nombre_producto_editable_factura_compra_global'];
$cod_estado_tipo_compra_global                                     = $info_empresa_data['cod_estado_tipo_compra_global'];

$nombre_campo_undidades_inv1                                       = $info_empresa_data['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                       = $info_empresa_data['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                       = $info_empresa_data['nombre_campo_undidades_inv3'];
$cod_estado_nota_observacion_global                                = $info_empresa_data['cod_estado_nota_observacion_global'];
$cod_estado_grafico_estadistico_global                             = $info_empresa_data['cod_estado_grafico_estadistico_global'];
$cod_estado_inventario_bodega2_global                              = $info_empresa_data['cod_estado_inventario_bodega2_global'];
$cod_estado_tipo_roles_global                                      = $info_empresa_data['cod_estado_tipo_roles_global'];
$cod_estado_seguridad_global                                       = $info_empresa_data['cod_estado_seguridad_global'];

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];

$cod_tipo_sistema_numeracion                                       = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_estado_lote_compra_global                                     = $info_empresa_data['cod_estado_lote_compra_global'];
$cod_estado_tipo_metodo_envio_global                               = $info_empresa_data['cod_estado_tipo_metodo_envio_global'];
$cod_estado_mod_domicilio_y_estado_habilitado_producto_global      = $info_empresa_data['cod_estado_mod_domicilio_y_estado_habilitado_producto_global'];
$cod_estado_promocion_global                                       = $info_empresa_data['cod_estado_promocion_global'];

$cod_estado_notificacion_alerta_correo_global                      = $info_empresa_data['cod_estado_notificacion_alerta_correo_global'];
$cod_estado_notificacion_alerta_correo_copia_seguridad_global      = $info_empresa_data['cod_estado_notificacion_alerta_correo_copia_seguridad_global'];
$cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global   = $info_empresa_data['cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global'];
$cod_estado_notificacion_alerta_correo_productos_a_vencer_global   = $info_empresa_data['cod_estado_notificacion_alerta_correo_productos_a_vencer_global'];
$cod_estado_notificacion_alerta_correo_productos_agotados_global   = $info_empresa_data['cod_estado_notificacion_alerta_correo_productos_agotados_global'];
$cod_estado_notificacion_alerta_correo_venta_diaria_global         = $info_empresa_data['cod_estado_notificacion_alerta_correo_venta_diaria_global'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];

$cod_estado_venta_dependencia_de_usuario_global                    = $info_empresa_data['cod_estado_venta_dependencia_de_usuario_global'];
$cod_estado_posicion_mapa_gps_pedidos_info_venta_global            = $info_empresa_data['cod_estado_posicion_mapa_gps_pedidos_info_venta_global'];

$cod_estado_origen_factura_compra_global                           = $info_empresa_data['cod_estado_origen_factura_compra_global'];
$cod_estado_existe_producto_factura_compra_global                  = $info_empresa_data['cod_estado_existe_producto_factura_compra_global'];
$cod_estado_chk_factura_compra_global                              = $info_empresa_data['cod_estado_chk_factura_compra_global'];
$cod_estado_check_caja_factura_compra_global                       = $info_empresa_data['cod_estado_check_caja_factura_compra_global'];
$cod_estado_check_und_factura_compra_global                        = $info_empresa_data['cod_estado_check_und_factura_compra_global'];

$cod_estado_peso_global                                            = $info_empresa_data['cod_estado_peso_global'];
$cod_estado_cargar_archivo_plano_interno_factura_compra_global     = $info_empresa_data['cod_estado_cargar_archivo_plano_interno_factura_compra_global'];
$cod_estado_cargar_archivo_plano_externo_factura_compra_global     = $info_empresa_data['cod_estado_cargar_archivo_plano_externo_factura_compra_global'];

$cod_estado_cuenta_cobrar_abono_glob_global                        = $info_empresa_data['cod_estado_cuenta_cobrar_abono_glob_global'];
$cod_estado_reporte_compra_por_producto_global                     = $info_empresa_data['cod_estado_reporte_compra_por_producto_global'];

$ptj_servicio_cava                                                 = $info_empresa_data['ptj_servicio_cava'];
$cod_servicio_cava                                                 = $info_empresa_data['cod_servicio_cava'];
$nombre_servicio_cava                                              = $info_empresa_data['nombre_servicio_cava'];
$precio_servicio_cava                                              = $info_empresa_data['precio_servicio_cava'];
$cod_estado_servicio_cava_global                                   = $info_empresa_data['cod_estado_servicio_cava_global'];
$cod_estado_escoger_precio_venta_automatico_global                 = $info_empresa_data['cod_estado_escoger_precio_venta_automatico_global'];
$cod_estado_origen_produccion_global                               = $info_empresa_data['cod_estado_origen_produccion_global'];

$dias_alerta_entrega_venta                                         = $info_empresa_data['dias_alerta_entrega_venta'];
$cod_estado_imprimir_reporte_venta_con_productos_global            = $info_empresa_data['cod_estado_imprimir_reporte_venta_con_productos_global'];
$cod_estado_factura_compra_cargue_inmediato_global                 = $info_empresa_data['cod_estado_factura_compra_cargue_inmediato_global'];
$cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global  = $info_empresa_data['cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global'];
$cod_estado_actualizar_base_datos_arch_plano_global                = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_global'];
$cod_estado_actualizar_base_datos_arch_plano_producto_global       = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_producto_global'];
$cod_estado_actualizar_base_datos_arch_plano_venta_global          = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_venta_global'];
$cod_estado_actualizar_base_datos_arch_plano_info_venta_global     = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_info_venta_global'];
$cod_estado_actualizar_base_datos_arch_plano_compra_global         = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_compra_global'];
$cod_estado_actualizar_base_datos_arch_plano_info_compra_global    = $info_empresa_data['cod_estado_actualizar_base_datos_arch_plano_info_compra_global'];
$cod_estado_actualizar_und_producto_inventario_global              = $info_empresa_data['cod_estado_actualizar_und_producto_inventario_global'];
$cod_estado_tipo_venta_zapateria_global                            = $info_empresa_data['cod_estado_tipo_venta_zapateria_global'];
$cod_estado_opcion_escribir_nombre_cliente_venta_global            = $info_empresa_data['cod_estado_opcion_escribir_nombre_cliente_venta_global'];
$cod_estado_btn_imprimir_venta_nav_zapateria_global                = $info_empresa_data['cod_estado_btn_imprimir_venta_nav_zapateria_global'];
$cod_estado_btn_imprimir_venta_direct_driv_zapateria_global        = $info_empresa_data['cod_estado_btn_imprimir_venta_direct_driv_zapateria_global'];
$cod_estado_fecha_entrega_venta_global                             = $info_empresa_data['cod_estado_fecha_entrega_venta_global'];
$cod_estado_hora_entrega_venta_global                              = $info_empresa_data['cod_estado_hora_entrega_venta_global'];
$cod_estado_productos_poco_movimiento_global                       = $info_empresa_data['cod_estado_productos_poco_movimiento_global'];
$cod_estado_nuevo_inventario_por_letra_global                      = $info_empresa_data['cod_estado_nuevo_inventario_por_letra_global'];
$cod_estado_filtro_aplicacion_chef_bartender_global                = $info_empresa_data['cod_estado_filtro_aplicacion_chef_bartender_global'];

$cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global         = $info_empresa_data['cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global'];
$cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global          = $info_empresa_data['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global'];
$cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global       = $info_empresa_data['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global'];
$cod_estado_reporte_mantenimiento_global                           = $info_empresa_data['cod_estado_reporte_mantenimiento_global'];

$cod_estado_abrir_cajon_monedero_driv_direct_global                = $info_empresa_data['cod_estado_abrir_cajon_monedero_driv_direct_global'];
$cod_estado_subreporte_venta_diaria_global                         = $info_empresa_data['cod_estado_subreporte_venta_diaria_global'];
$cod_estado_subreporte_venta_mensual_global                        = $info_empresa_data['cod_estado_subreporte_venta_mensual_global'];
$cod_estado_subreporte_venta_anual_global                          = $info_empresa_data['cod_estado_subreporte_venta_anual_global'];
$cod_estado_subreporte_totalventa_global                           = $info_empresa_data['cod_estado_subreporte_totalventa_global'];
$cod_estado_subreporte_impuestos_global                            = $info_empresa_data['cod_estado_subreporte_impuestos_global'];
$cod_estado_subreporte_ventasgenerales_global                      = $info_empresa_data['cod_estado_subreporte_ventasgenerales_global'];
$cod_estado_subreporte_ventasporfacturas_global                    = $info_empresa_data['cod_estado_subreporte_ventasporfacturas_global'];
$cod_estado_subreporte_ventasportipofacturas_global                = $info_empresa_data['cod_estado_subreporte_ventasportipofacturas_global'];
$cod_estado_subreporte_ventaspordependencia_global                 = $info_empresa_data['cod_estado_subreporte_ventaspordependencia_global'];
$cod_estado_subreporte_ventasportipoproducto_global                = $info_empresa_data['cod_estado_subreporte_ventasportipoproducto_global'];
$cod_estado_subreporte_ventasporvendedor_global                    = $info_empresa_data['cod_estado_subreporte_ventasporvendedor_global'];
$cod_estado_subreporte_ventasporpropinavendedor_global             = $info_empresa_data['cod_estado_subreporte_ventasporpropinavendedor_global'];
$cod_estado_subreporte_ventasporcreditocliente_global              = $info_empresa_data['cod_estado_subreporte_ventasporcreditocliente_global'];
$cod_estado_dependencia_sub_global                                 = $info_empresa_data['cod_estado_dependencia_sub_global'];
$cod_estado_factura_compra_producto_global                         = $info_empresa_data['cod_estado_factura_compra_producto_global'];
$cod_estado_aceite_oleina_global                                   = $info_empresa_data['cod_estado_aceite_oleina_global'];
$cod_estado_valor_flete_aceite_oleina_global                       = $info_empresa_data['cod_estado_valor_flete_aceite_oleina_global'];
$cod_estado_caja_fraccion_global                                   = $info_empresa_data['cod_estado_caja_fraccion_global'];

$ptj_interes_inmobiliaria                                          = $info_empresa_data['ptj_interes_inmobiliaria'];
$ptj_comision_inmobiliaria                                         = $info_empresa_data['ptj_comision_inmobiliaria'];
$limite_venta_pos_factura_electronica                              = $info_empresa_data['limite_venta_pos_factura_electronica'];
$cod_estado_limite_venta_pos_factura_electronica_global            = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];

$nombre_pais_defec_global                                          = $info_empresa_data['nombre_pais_defec_global'];
$nombre_departamento_defec_global                                  = $info_empresa_data['nombre_departamento_defec_global'];
$nombre_ciudad_defec_global                                        = $info_empresa_data['nombre_ciudad_defec_global'];
$nombre_tipo_cliente_defec_global                                  = $info_empresa_data['nombre_tipo_cliente_defec_global'];
$nombre_tipo_regimen_defec_global                                  = $info_empresa_data['nombre_tipo_regimen_defec_global'];
$nombre_tipo_impuesto_defec_global                                 = $info_empresa_data['nombre_tipo_impuesto_defec_global'];
$leyenda1_defec_global                                             = $info_empresa_data['leyenda1_defec_global'];
$leyenda2_defec_global                                             = $info_empresa_data['leyenda2_defec_global'];
$leyenda3_defec_global                                             = $info_empresa_data['leyenda3_defec_global'];
$leyenda4_defec_global                                             = $info_empresa_data['leyenda4_defec_global'];
$leyenda5_defec_global                                             = $info_empresa_data['leyenda5_defec_global'];
$leyenda_envio_correo_defec_global                                 = $info_empresa_data['leyenda_envio_correo_defec_global'];
$cod_estado_recalcular_factura_compra_global                       = $info_empresa_data['cod_estado_recalcular_factura_compra_global'];
$cod_estado_comentario_venta_mostrar_imprimir_global               = $info_empresa_data['cod_estado_comentario_venta_mostrar_imprimir_global'];
$cod_estado_mostrar_agrupado_produc_repventa_imprimir_global       = $info_empresa_data['cod_estado_mostrar_agrupado_produc_repventa_imprimir_global'];
$cod_estado_sumar_producto_repetido_venta_temporal_global          = $info_empresa_data['cod_estado_sumar_producto_repetido_venta_temporal_global'];
$cod_estado_soporte_factura_venta_global                           = $info_empresa_data['cod_estado_soporte_factura_venta_global'];
$cod_estado_edit_precio_venta_btn_factura_venta_global             = $info_empresa_data['cod_estado_edit_precio_venta_btn_factura_venta_global'];

$nombre_concepto_egreso_defec_global                               = $info_empresa_data['nombre_concepto_egreso_defec_global'];
$nombre_cod_tercero_defec_global                                   = $info_empresa_data['nombre_cod_tercero_defec_global'];
$nombre_ccosto_defec_global                                        = $info_empresa_data['nombre_ccosto_defec_global'];
$nombre_cod_tipo_pago_defec_global                                 = $info_empresa_data['nombre_cod_tipo_pago_defec_global'];
$nombre_cod_tipo_forma_pago_defec_global                           = $info_empresa_data['nombre_cod_tipo_forma_pago_defec_global'];
$nombre_cod_dependencia_defec_global                               = $info_empresa_data['nombre_cod_dependencia_defec_global'];
$nombre_nombre_tipo_factura_defec_global                           = $info_empresa_data['nombre_nombre_tipo_factura_defec_global'];
$cod_estado_tipo_nominacion_moneda_cierre_caja_global              = $info_empresa_data['cod_estado_tipo_nominacion_moneda_cierre_caja_global'];
$cod_estado_busqueda_venta_manual_resultado_unico_redirect_global  = $info_empresa_data['cod_estado_busqueda_venta_manual_resultado_unico_redirect_global'];
$cod_tipo_cierre_caja_global                                       = $info_empresa_data['cod_tipo_cierre_caja_global'];
$cod_estado_cargar_factura_compra_simplificada_carniceria_global   = $info_empresa_data['cod_estado_cargar_factura_compra_simplificada_carniceria_global'];
$cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global   = $info_empresa_data['cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global'];

$cod_estado_cod_barra2_global                                      = $info_empresa_data['cod_estado_cod_barra2_global'];
$cod_estado_publicidad_global                                      = $info_empresa_data['cod_estado_publicidad_global'];
$cod_estado_habitacion_hotel_global                                = $info_empresa_data['cod_estado_habitacion_hotel_global'];
$cod_estado_tipo_habitacion_hotel_global                           = $info_empresa_data['cod_estado_tipo_habitacion_hotel_global'];
$cod_estado_limpieza_hotel_global                                  = $info_empresa_data['cod_estado_limpieza_hotel_global'];
$cod_estado_tipo_moviento_contable_credito_debito_global           = $info_empresa_data['cod_estado_tipo_moviento_contable_credito_debito_global'];
$cod_estado_iva_saludable_ptj_global                               = $info_empresa_data['cod_estado_iva_saludable_ptj_global'];

$cod_estado_movimiento_contable_cuenta_personal_global             = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
$nombre_tipo_presentacion_defect_global                            = $info_empresa_data['nombre_tipo_presentacion_defect_global'];
$cod_estado_mostrar_venta_por_caja_global                          = $info_empresa_data['cod_estado_mostrar_venta_por_caja_global'];
$cod_estado_btn_imp_nav_carta_por_caja_pdf_global                  = $info_empresa_data['cod_estado_btn_imp_nav_carta_por_caja_pdf_global'];
$cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global         = $info_empresa_data['cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global'];
$cod_estado_espacio_firma_bodega_imprimir_global                   = $info_empresa_data['cod_estado_espacio_firma_bodega_imprimir_global'];
$cod_estado_espacio_firma_transportador_imprimir_global            = $info_empresa_data['cod_estado_espacio_firma_transportador_imprimir_global'];

$cod_estado_tipo_cobro_aviso_alerta_renovacion_global              = $info_empresa_data['cod_estado_tipo_cobro_aviso_alerta_renovacion_global'];
$cod_estado_tipo_export_excel_global                               = $info_empresa_data['cod_estado_tipo_export_excel_global'];

$url_pag_redirec_ini_sesion_global                                = $info_empresa_data['url_pag_redirec_ini_sesion_global'];
$cod_estado_nombre_tipo_tercero_global                            = $info_empresa_data['cod_estado_nombre_tipo_tercero_global'];
$cod_estado_nombre_tipo_paciente_global                           = $info_empresa_data['cod_estado_nombre_tipo_paciente_global'];
$cod_estado_nombre_tipo_identificacion_global                     = $info_empresa_data['cod_estado_nombre_tipo_identificacion_global'];
$cod_estado_identificacion_tercero_global                         = $info_empresa_data['cod_estado_identificacion_tercero_global'];
$cod_estado_digito_tercero_global                                 = $info_empresa_data['cod_estado_digito_tercero_global'];
$cod_estado_nombre1_tercero_global                                = $info_empresa_data['cod_estado_nombre1_tercero_global'];
$cod_estado_nombre2_tercero_global                                = $info_empresa_data['cod_estado_nombre2_tercero_global'];
$cod_estado_apellido1_tercero_global                              = $info_empresa_data['cod_estado_apellido1_tercero_global'];
$cod_estado_apellido2_tercero_global                              = $info_empresa_data['cod_estado_apellido2_tercero_global'];
$cod_estado_direccion_tercero_global                              = $info_empresa_data['cod_estado_direccion_tercero_global'];
$cod_estado_telefono1_tercero_global                              = $info_empresa_data['cod_estado_telefono1_tercero_global'];
$cod_estado_telefono2_tercero_global                              = $info_empresa_data['cod_estado_telefono2_tercero_global'];
$cod_estado_correo_tercero_global                                 = $info_empresa_data['cod_estado_correo_tercero_global'];
$cod_estado_nombre_pais_global                                    = $info_empresa_data['cod_estado_nombre_pais_global'];
$cod_estado_nombre_departamento_global                            = $info_empresa_data['cod_estado_nombre_departamento_global'];
$cod_estado_nombre_ciudad_global                                  = $info_empresa_data['cod_estado_nombre_ciudad_global'];
$cod_estado_nombre_tipo_cliente_global                            = $info_empresa_data['cod_estado_nombre_tipo_cliente_global'];
$cod_estado_fecha_nac_ymd_global                                  = $info_empresa_data['cod_estado_fecha_nac_ymd_global'];
$cod_estado_nombre_sexo_global                                    = $info_empresa_data['cod_estado_nombre_sexo_global'];
$cod_estado_nombre_entidad_eps_global                             = $info_empresa_data['cod_estado_nombre_entidad_eps_global'];
$cod_estado_nombre_fondo_pension_global                           = $info_empresa_data['cod_estado_nombre_fondo_pension_global'];
$cod_estado_nombre_arl_global                                     = $info_empresa_data['cod_estado_nombre_arl_global'];
$cod_estado_nombre_tipo_regimen_global                            = $info_empresa_data['cod_estado_nombre_tipo_regimen_global'];
$cod_estado_nombre_tipo_impuesto_global                           = $info_empresa_data['cod_estado_nombre_tipo_impuesto_global'];
$cod_estado_cod_administrador_tercero_global                      = $info_empresa_data['cod_estado_cod_administrador_tercero_global'];
$cod_estado_nombre_grupo_rh_global                                = $info_empresa_data['cod_estado_nombre_grupo_rh_global'];
$cod_estado_nombre_estrato_global                                 = $info_empresa_data['cod_estado_nombre_estrato_global'];
$cod_estado_nombre_numero_hijos_global                            = $info_empresa_data['cod_estado_nombre_numero_hijos_global'];
$cod_estado_nombre_raza_global                                    = $info_empresa_data['cod_estado_nombre_raza_global'];
$cod_estado_nombre_religion_global                                = $info_empresa_data['cod_estado_nombre_religion_global'];
$cod_estado_nombre_estado_civil_global                            = $info_empresa_data['cod_estado_nombre_estado_civil_global'];
$cod_estado_nombre_escolaridad_global                             = $info_empresa_data['cod_estado_nombre_escolaridad_global'];
$cod_estado_nombre_empresa_contratante_global                     = $info_empresa_data['cod_estado_nombre_empresa_contratante_global'];
$cod_estado_cod_empresa_global                                    = $info_empresa_data['cod_estado_cod_empresa_global'];
$cod_estado_nombre_actividad_ecoemp_global                        = $info_empresa_data['cod_estado_nombre_actividad_ecoemp_global'];
$cod_estado_cod_grupo_area_cargo_global                           = $info_empresa_data['cod_estado_cod_grupo_area_cargo_global'];
$cod_estado_lugar_nac_global                                      = $info_empresa_data['cod_estado_lugar_nac_global'];
$cod_estado_lugar_procedencia_global                              = $info_empresa_data['cod_estado_lugar_procedencia_global'];
$cod_estado_lugar_residencia_global                               = $info_empresa_data['cod_estado_lugar_residencia_global'];
$cod_estado_nombre_ocupacion_global                               = $info_empresa_data['cod_estado_nombre_ocupacion_global'];
$cod_estado_nombre_contacto1_global                               = $info_empresa_data['cod_estado_nombre_contacto1_global'];
$cod_estado_parentesco_contacto1_global                           = $info_empresa_data['cod_estado_parentesco_contacto1_global'];
$cod_estado_tel_contacto1_global                                  = $info_empresa_data['cod_estado_tel_contacto1_global'];
$cod_estado_direccion_contacto1_global                            = $info_empresa_data['cod_estado_direccion_contacto1_global'];
$cod_estado_dto1_con_iva_tercero_global                           = $info_empresa_data['cod_estado_dto1_con_iva_tercero_global'];
$cod_estado_dto2_con_iva_tercero_global                           = $info_empresa_data['cod_estado_dto2_con_iva_tercero_global'];
$cod_estado_dto1_sin_iva_tercero_global                           = $info_empresa_data['cod_estado_dto1_sin_iva_tercero_global'];
$cod_estado_dto2_sin_iva_tercero_global                           = $info_empresa_data['cod_estado_dto2_sin_iva_tercero_global'];
$cod_estado_dto1_excento_iva_tercero_global                       = $info_empresa_data['cod_estado_dto1_excento_iva_tercero_global'];
$cod_estado_dto2_excento_iva_tercero_global                       = $info_empresa_data['cod_estado_dto2_excento_iva_tercero_global'];

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
$tamano_papel_impresora                                           = $info_empresa_data['tamano_papel_impresora'];
$cod_estado_mostrar_descuento_manual_factura_venta_global         = $info_empresa_data['cod_estado_mostrar_descuento_manual_factura_venta_global'];
$cod_estado_puntos_redimibles_campanya_global                     = $info_empresa_data['cod_estado_puntos_redimibles_campanya_global'];
$cod_estado_renta_alquiler_global                                 = $info_empresa_data['cod_estado_renta_alquiler_global'];
$codigo_tipo_modulo_cuenta_cobrar_defect_global                   = $info_empresa_data['codigo_tipo_modulo_cuenta_cobrar_defect_global'];
$cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global        = $info_empresa_data['cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global'];

if ($cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global == '1') { include_once('../admin/refrescar_alerta_sonido_timbre_despachado_pedido_venta_temporal_ajax.php'); }

if ($nombre_tipo_campo_componente_html_und_venta == 'text') { $nombre_tipo_campo_componente_html_und_venta = 'text'; } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if ($nombre_tipo_campo_componente_html_und_compra == 'text') { $nombre_tipo_campo_componente_html_und_compra = 'text'; } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_compra == 'text') { $nombre_tipo_campo_componente_html_precio_compra = 'text'; } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_venta == 'text') { $nombre_tipo_campo_componente_html_precio_venta = 'text'; } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }
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
$sql_agente_dian_no_aplicar_retencion = "SELECT * FROM tbl15_agente_dian WHERE (cod_agente_dian = '7' AND cod_estado = '1')";
$consulta_agente_dian_no_aplicar_retencion = mysqli_query($conectar, $sql_agente_dian_no_aplicar_retencion) or die(mysqli_error($conectar));
$existe_no_aplicar_retencion = intval(mysqli_num_rows($consulta_agente_dian_no_aplicar_retencion));
$matriz_agente_dian_no_aplicar_retencion = mysqli_fetch_assoc($consulta_agente_dian_no_aplicar_retencion);

$nombre_agente_dian_no_aplicar_retencion              = $matriz_agente_dian_no_aplicar_retencion['nombre_agente_dian'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (strlen($cabecera_emp) > 28) { $tamano_letra_cabecera_emp_80mm = 1; $tamano_letra_cabecera_emp_58mm = 1; } else { $tamano_letra_cabecera_emp_80mm = 2; $tamano_letra_cabecera_emp_58mm = 2; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
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
$identificacion_tercero                               = $info_fact['identificacion_tercero'];
$cod_estado_alquiler_renta                            = $info_fact['cod_estado_alquiler_renta'];
$fecha_ini_renta_alquiler                             = $info_fact['fecha_ini_renta_alquiler'];
$fecha_fin_renta_alquiler                             = $info_fact['fecha_fin_renta_alquiler'];
$retefuente_ptj                                       = $info_fact['retefuente_ptj'];
$reteica_ptj                                          = $info_fact['reteica_ptj'];
$reteiva_ptj                                          = $info_fact['reteiva_ptj'];

$longitud_cod_cufe                                    = strlen($cod_cufe);
$mitad_longitud_cod_cufe                              = $longitud_cod_cufe / 2;
$cod_cufe_parte1                                      = substr($cod_cufe, 0, $mitad_longitud_cod_cufe);
$cod_cufe_parte2                                      = substr($cod_cufe, $mitad_longitud_cod_cufe+1, $longitud_cod_cufe);
$url_vpfe_dian                                        = "https://catalogo-vpfe.dian.gov.co/document/searchqr";
$url_vpfe_dian_qr                                     = $url_vpfe_dian."?documentkey=".$cod_cufe;

$cod_info_factura_venta_codif                         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
$cod_info_factura_venta_codif_cryp                    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);
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
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                                      = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                                             = $matriz_usario_vendedor['cod_caja'];
$hora_impresion                                       = date("H:i:s");
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
$cod_servicio_propina                                 = '22222222';
$cod_servicio_cava                                    = '55555555';
$cod_servicio_domicilio                               = '44444444';
$cod_servicio_descuento_punto_redimible               = '11112222';
$cod_servicio_descuento                               = '33333333';
$cod_servicio_imp_bolsa                               = '11111111';
$cod_servicio_retefuente                              = '11113333';
$cod_servicio_cupobrilla                              = '11114444';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_venta_product = "SELECT Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_manual,
Sum(((und_venta*precio_venta_producto_orig) - ((und_venta*precio_venta_producto_orig)))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_automatico, 
Sum((und_venta*precio_venta_producto_orig) - (und_venta*precio_venta_producto)) As total_descuento_manual_producto,
Sum(und_venta*precio_venta_producto_orig) As subtotal_sin_descuento_con_impuestos, 
SUM((((und_venta * precio_venta_producto_orig) - (und_venta * precio_venta_producto)) + (und_venta * precio_venta_producto)) / ((iva_ptj/100)+(100/100))) As subtotal_con_descuento_e_impuestos, 
Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') AND (cod_producto_barra <> '$cod_servicio_domicilio') 
AND (cod_producto_barra <> '$cod_servicio_descuento')";
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
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
$consulta_venta_descuento_manual_como_concepto = mysqli_query($conectar, $sql_venta_descuento_manual_como_concepto) or die(mysqli_error($conectar));
$suma_venta_descuento_manual_como_concepto = mysqli_fetch_assoc($consulta_venta_descuento_manual_como_concepto);

$total_descuento_manual_como_concepto                 = ($suma_venta_descuento_manual_como_concepto['total_descuento_manual_como_concepto']);
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_venta_descuento_directamente_en_el_precio_venta = "SELECT Sum((und_venta*precio_venta_producto_orig) - (und_venta*precio_venta_producto)) As total_descuento_directamente_en_el_precio_venta 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
$consulta_venta_descuento_directamente_en_el_precio_venta = mysqli_query($conectar, $sql_venta_descuento_directamente_en_el_precio_venta) or die(mysqli_error($conectar));
$suma_venta_descuento_directamente_en_el_precio_venta = mysqli_fetch_assoc($consulta_venta_descuento_directamente_en_el_precio_venta);

$total_descuento_directamente_en_el_precio_venta      = ($suma_venta_descuento_directamente_en_el_precio_venta['total_descuento_directamente_en_el_precio_venta']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_venta_descuento_puntos_redimibles_como_concepto = "SELECT Sum(total_venta_producto) As total_descuento_puntos_redimibles_como_concepto, nombre_producto FROM tbl15_venta_producto 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento_punto_redimible')";
$consulta_venta_descuento_puntos_redimibles_como_concepto = mysqli_query($conectar, $sql_venta_descuento_puntos_redimibles_como_concepto) or die(mysqli_error($conectar));
$existe_descuento_puntos_redimibles = mysqli_num_rows($consulta_venta_descuento_puntos_redimibles_como_concepto);
$suma_venta_descuento_puntos_redimibles_como_concepto = mysqli_fetch_assoc($consulta_venta_descuento_puntos_redimibles_como_concepto);

$total_descuento_puntos_redimibles_como_concepto      = ($suma_venta_descuento_puntos_redimibles_como_concepto['total_descuento_puntos_redimibles_como_concepto']);
$nombre_producto_puntos_redimibles                    = ($suma_venta_descuento_puntos_redimibles_como_concepto['nombre_producto']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_venta_retefuente = "SELECT Sum(total_venta_producto) As total_descuento_retefuente, nombre_producto FROM tbl15_venta_producto 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_retefuente')";
$consulta_venta_retefuente = mysqli_query($conectar, $sql_venta_retefuente) or die(mysqli_error($conectar));
$existe_venta_retefuente = intval(mysqli_num_rows($consulta_venta_retefuente));
$suma_venta_retefuente = mysqli_fetch_assoc($consulta_venta_retefuente);

$total_descuento_retefuente                           = ($suma_venta_retefuente['total_descuento_retefuente']);
$nombre_producto_retefuente                           = ($suma_venta_retefuente['nombre_producto']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//$total_descuentos_manual_y_en_el_precio_venta         = $total_descuento_manual_como_concepto + (-$total_descuento_directamente_en_el_precio_venta);
//$total_suma_de_todos_los_descuentos                   = $total_descuento_manual_como_concepto + $total_descuento_puntos_redimibles_como_concepto + (-$total_descuento_directamente_en_el_precio_venta);
$total_descuentos_manual_y_en_el_precio_venta         = intval($total_descuento_manual_como_concepto);
$total_suma_de_todos_los_descuentos                   = intval($total_descuento_manual_como_concepto + $total_descuento_puntos_redimibles_como_concepto);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
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
//$total_desc                          = ($suma['total_desc']);
$total_venta_temp                    = ($suma['total_venta']);
$total_venta_sin_descuento           = ($subtotal_base_sin_descuento_automatico);
$vlr_cambio                          = ($vlr_cancelado - $total_venta_temp);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_existe_descuento_manual = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
$consulta_existe_descuento_manual = mysqli_query($conectar, $sql_existe_descuento_manual) or die(mysqli_error($conectar));
$existe_descuento_manual = mysqli_num_rows($consulta_existe_descuento_manual);

if ($existe_descuento_manual == '0' && $cod_estado_mostrar_descuento_manual_factura_venta_global == '1') {
	$nombre_producto_descuento             = '';
	$precio_venta_producto_descuento       = '0';
	$total_venta_producto_descuento        = '0';
	//$total_descuento_venta                 = ($subtotal_base_sin_descuento_automatico - $subtotal_base_sin_descuento_manual);
	$total_descuento_venta                 = $total_suma_de_todos_los_descuentos;
	//$descuento_ptj_dif                     = ($total_descuento_venta / $subtotal_base_sin_descuento_automatico) * 100;
	$descuento_ptj_dif                     = 0;
	//$subtotal_base_sin_descuento           = ($subtotal_base_sin_descuento_automatico);
	$subtotal_base_sin_descuento           = ($subtotal_con_descuento_e_impuestos);
	$existe_descuento_manual               = "NO";
} else {
	$sql_servicio_descuento = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, nombre_tipo_precio 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
	$consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
	$existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
	$info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

	$nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
	$precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
	$total_venta_producto_descuento        = $subtotal_base_sin_descuento_manual;
	$total_descuento_venta                 = $total_suma_de_todos_los_descuentos;
	$descuento_ptj_dif                     = $info_servicio_descuento['nombre_tipo_precio'];
	$subtotal_base_sin_descuento           = ($subtotal_base_sin_descuento_manual);
	$existe_descuento_manual               = "SI";
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_propina')";
$consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
$existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
$info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

$nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
$precio_venta_producto_propina         = $info_servicio_propina['precio_venta_producto'];
$total_venta_producto_propina          = $info_servicio_propina['total_venta_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_servicio_cupobrilla = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, cupo_credito_ptj
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_cupobrilla')";
$consulta_servicio_cupobrilla = mysqli_query($conectar, $sql_servicio_cupobrilla) or die(mysqli_error($conectar));
$existe_servicio_cupobrilla = mysqli_num_rows($consulta_servicio_cupobrilla);
$info_servicio_cupobrilla = mysqli_fetch_assoc($consulta_servicio_cupobrilla);

$nombre_producto_cupobrilla               = $info_servicio_cupobrilla['nombre_producto'];
$precio_venta_producto_cupobrilla         = $info_servicio_cupobrilla['precio_venta_producto'];
$total_venta_producto_cupobrilla          = $info_servicio_cupobrilla['total_venta_producto'];
$ptj_servicio_cupobrilla                  = $info_servicio_cupobrilla['cupo_credito_ptj'];
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_servicio_domicilio = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_domicilio')";
$consulta_servicio_domicilio = mysqli_query($conectar, $sql_servicio_domicilio) or die(mysqli_error($conectar));
$existe_servicio_domicilio = mysqli_num_rows($consulta_servicio_domicilio);
$info_servicio_domicilio = mysqli_fetch_assoc($consulta_servicio_domicilio);

$nombre_producto_domicilio               = $info_servicio_domicilio['nombre_producto'];
$precio_venta_producto_domicilio         = $info_servicio_domicilio['precio_venta_producto'];
$total_venta_producto_domicilio          = $info_servicio_domicilio['total_venta_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_servicio_descuento = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento')";
$consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
$existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
$info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

$nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
$precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
$total_venta_producto_descuento        = $info_servicio_descuento['total_venta_producto'];
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
  $select_productos_imp = 'SUM(und_venta) as und_venta, precio_venta_producto, SUM(total_venta_producto) as total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj, precio_ipc, comentario_producto, nombre_tipo_unidad_medida, und_caja_sobre, cajas_sobre, nombre_tipo_und_caja_sobre, cedula, nombre_cliente'; 
} else { 
  $agrupar_productos_imp = ''; 
  $select_productos_imp = 'und_venta, precio_venta_producto, total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj, precio_ipc, comentario_producto, nombre_tipo_unidad_medida, und_caja_sobre, cajas_sobre, nombre_tipo_und_caja_sobre, cedula, nombre_cliente'; 
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$saldo_pendiente_cuenta_cobrar = 0;
if (($cod_tipo_pago == '2') && ($cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global == '1')) {

    if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '1') {
        $calcular_datos_cuenta_cobrar = "SELECT total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
        $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
        $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);
        
        $total_subtotal_cuenta_cobrar                                = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
        $saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar;
        //$saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar + $total_venta;
    } else {
        $calcular_datos_cuenta_cobrar = "SELECT Sum(monto_deuda) AS monto_deuda, Sum(subtotal) AS total_subtotal_cuenta_cobrar, Sum(abonado) AS abonado 
        FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0') GROUP BY cod_tercero";
        $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
        $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);
        
        $total_subtotal_cuenta_cobrar                                = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
        $saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar;
        //$saldo_pendiente_cuenta_cobrar                               = $total_subtotal_cuenta_cobrar + $total_venta;
    }
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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($total_descuentos_manual_y_en_el_precio_venta == '0') { $existe_descuento_factura_signo = ''; } else { $existe_descuento_factura_signo = '-'; }
if ($total_descuento_puntos_redimibles_como_concepto == '0') { $existe_descuento_puntos_redimibles_signo = ''; } else { $existe_descuento_puntos_redimibles_signo = '-'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_btn_imp_pos_nav_orden_compra_global == '1') {
	$factura_venta_orden_venta = 'ORDEN DE PEDIDO';
}  else {
	$factura_venta_orden_venta = 'FACTURA DE VENTA';
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_mquina_impr = "SELECT nombre_maquina, nombre_impresora FROM tbl15_administrador WHERE cuenta = '$cuenta_actual'";
$resultado_info_mquina_impr = mysqli_query($conectar, $obtener_info_mquina_impr)or die(mysqli_error($conectar));
$info_mquina_impr = mysqli_fetch_assoc($resultado_info_mquina_impr);

$nombre_maquina             = $info_mquina_impr['nombre_maquina'];
$nombre_impresora           = $info_mquina_impr['nombre_impresora'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\CapabilityProfiles\EposTepCapabilityProfile;
//$connector = new WindowsPrintConnector($nombre_impresora);
$connector = new WindowsPrintConnector("smb://".$nombre_maquina."/".$nombre_impresora);
//$nombre_impresora = "\\192.168.1.213 \ Etiq2";
//$connector = new WindowsPrintConnector($nombre_impresora);
//$connector = new WindowsPrintConnector("smb://DESKTOP-5KUV4DP/POS-80C (copy 1)");

//$printer = new Printer($connector, $profile);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.

if ($tamano_papel_impresora == '58') {

	$printer->setFont(Printer::FONT_B);
	$printer->setTextSize(1, 1);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	if ($cod_estado_img_impimir_factura_global == '1') { 
		try{
			$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos_blanco_negro.jpg", false);
			$printer->bitImage($logo);
		} catch(Exception $e) { }
	}

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setTextSize($tamano_letra_cabecera_emp_80mm, $tamano_letra_cabecera_emp_80mm);
	$printer->setEmphasis(true);
	$printer->text($cabecera_emp."\n");
	$printer->setTextSize(1, 1);
	$printer->setEmphasis(false);
	$printer->text($localidad_emp."\n");
	$printer->text("NIT: ".$nit_empresa_emp."\n");
	$printer->text("DIRECCION: ".$direccion_emp."\n");
	$printer->text("TELEFONO: ".$telefono_emp."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("FECHA: ".$fecha_anyo.' - '.$fecha_hora, 30));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("FACTURA DE VENTA #:".$prefijo_resolucion_facturacion.' '.$cod_factura, 16));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 26));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("TIPO DE PAGO: ".$nombre_tipo_pago, 25));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad($nombre_tipo_identificacion." CLIENTE: ".$cedula_cli.$digito_tercero, 26));
	$printer->text("\n");
	$printer->text(str_pad("CLIENTE: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CAJA: ".$cod_caja, 12));
	$printer->text(str_pad($nombre_concepto_multi_virtual." VIRTUAL: ".$cod_base_caja, 12));
	$printer->text("\n");

	$printer->setEmphasis(true);
	$printer->text("VENDEDOR (A): ");
	$printer->text($usario_vendedor);
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	if ($origen == '0') { $printer->text(str_pad("CANT", 5)); }
	if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { $printer->text(str_pad("..", 5)); }
	$printer->text(str_pad("DESCRIPCION", 12));
	if ($origen == '0') { $printer->text(str_pad("P.UNIT", 7)); }
	$printer->text(str_pad("P.TOTAL", 7));
	$printer->setEmphasis(false);
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$resultado_sql = "SELECT $select_productos_imp 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND ((cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
	AND (cod_producto_barra <> '$cod_servicio_domicilio')) $condcional_mostrar_subproductos_imprimir $agrupar_productos_imp $ordenamiento";
	$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
	while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

		$cod_producto                = $info_venta['cod_producto'];
		$cod_producto_barra          = $info_venta['cod_producto_barra'];
		$nombre_producto             = $info_venta['nombre_producto'];
		$und_venta                   = $info_venta['und_venta'];
		$precio_venta_producto       = $info_venta['precio_venta_producto'];
		$total_venta_producto        = $info_venta['total_venta_producto'];
		$iva_ptj                     = $info_venta['iva_ptj'];
		$precio_ipc                  = $info_venta['precio_ipc'];
		$comentario_producto         = $info_venta['comentario_producto'];

		if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
		if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

		$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
		$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
		$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

		$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

		if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }

		$total_caracteres_producto = strlen($nombre_producto);
//---------------------------------------------------------------------------------------------------------------------------------//
		if ($total_caracteres_producto > 17) {
			$nombre_producto1   = substr(trim($nombre_producto), 0, 17);
			$nombre_producto2   = substr(trim($nombre_producto), 17, 25);

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($und_venta, 4)); }
			if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { $printer->text(str_pad($comentario_producto, 4)); }
			$printer->text(str_pad($nombre_producto1, 17));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));

			if ($nombre_producto2 <> "") {
				$printer->text("\n");
				$printer->text(str_pad("", 4));
				$printer->text(str_pad($nombre_producto2, 17));
				$printer->text(str_pad("", 1,' ',STR_PAD_LEFT));
			}
			$printer->text("\n");
		} else {
			$nombre_producto1   = substr($nombre_producto, 0, 17);
			$nombre_producto2   = "";

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($und_venta, 4)); }
			if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { $printer->text(str_pad($comentario_producto, 4)); }
			$printer->text(str_pad($nombre_producto1, 17));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));
			$printer->text("\n");
		}
//---------------------------------------------------------------------------------------------------------------------------------//
	}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("SUBTOTAL", 18));
	$printer->text(str_pad(number_format($subtotal_base_sin_descuento, 0, ",", "."), 10));
	$printer->text("\n");

	//$printer->setJustification(Printer::JUSTIFY_LEFT);
	//$printer->text(str_pad("%DESCUENTO", 18));
	//$printer->text(str_pad(intval($descuento_ptj_dif)."%", 10));
	//$printer->text("\n");

	//$printer->setJustification(Printer::JUSTIFY_LEFT);
	//$printer->text(str_pad("DESCUENTO", 18));
	//$printer->text(str_pad(number_format($total_descuento_venta, 0, ",", "."), 10));
	//$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("IVA", 18));
	$printer->text(str_pad(number_format($total_iva, 0, ",", "."), 7));
	$printer->text("\n");

	if ($nombre_producto_retefuente <> '0') {
		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->text(str_pad($nombre_producto_retefuente.' ('.$retefuente_ptj.'%)', 18));
		$printer->text(str_pad(number_format($total_descuento_retefuente, 0, ",", "."), 7));
		$printer->text("\n");
	}

	if ($existe_servicio_propina <> '0') {
		$printer->text(str_pad($nombre_producto_propina." ".$ptj_servicio_propina."%: ", 18));
		$printer->text(str_pad("".number_format($total_venta_producto_propina, 0, ",", "."), 7));
		$printer->text("\n");
	}

	if ($existe_servicio_cupobrilla <> '0') {
		$printer->text(str_pad($nombre_producto_cupobrilla." (".$ptj_servicio_cupobrilla."%): ", 18));
		$printer->text(str_pad("".number_format($total_venta_producto_cupobrilla, 0, ",", "."), 7));
		$printer->text("\n");
	}

	if ($existe_servicio_descuento <> '0') {
		$printer->text(str_pad($nombre_producto_descuento.": ", 18));
		$printer->text(str_pad("".number_format($total_venta_producto_descuento, 0, ",", "."), 7));
		$printer->text("\n");
	}

	$printer->setTextSize(2, 2);
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("TOTAL", 8));
	$printer->text(str_pad(number_format($total_venta_temp, 0, ",", "."), 7));
	$printer->setEmphasis(false);
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setTextSize(1, 1);
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_tipo_pago == '1') {
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->setEmphasis(true);
		$printer->text(str_pad("RECIBIDO", 18));
		$printer->text(str_pad("CAMBIO", 10));
		$printer->setEmphasis(false);
		$printer->text("\n");

		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->setEmphasis(true);
		$printer->text(str_pad("$ ".number_format($vlr_cancelado, 0, ",", "."), 18));
		$printer->text(str_pad("$ ".number_format($vlr_cambio, 0, ",", "."), 10));
		$printer->setEmphasis(false);
		$printer->text("\n");
	}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') {
	} else { 
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->text("<<==========================>>");
		$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->setEmphasis(true);
		$printer->text(str_pad("TIPO", 6));
		$printer->text(str_pad("COMPRA", 8));
		$printer->text(str_pad("BASE/IMP", 9));
		$printer->text(str_pad("IVA", 8));
		$printer->setEmphasis(false);
		$printer->text("\n");

		$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
		Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
		Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19') 
		AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
		$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
		$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

		$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
		$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
		$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
		//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

		$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
		Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
		Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5') 
		AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
		$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
		$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

		$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
		$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
		$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
		//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

		$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
		Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
		Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0') 
		AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
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
//---------------------------------------------------------------------------------------------------------------------------------//
		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->setEmphasis(false);
		$printer->text(str_pad("G=19%", 6));
		$printer->text(str_pad(number_format($total_venta_19, 0, ",", "."), 8));
		$printer->text(str_pad(number_format($total_base_iva_19, 0, ",", "."), 8));
		$printer->text(str_pad(number_format($total_iva_19, 0, ",", "."), 8));
		$printer->setEmphasis(false);
		$printer->text("\n");

		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->setEmphasis(false);
		$printer->text(str_pad("S=5%", 6));
		$printer->text(str_pad(number_format($total_venta_5, 0, ",", "."), 8));
		$printer->text(str_pad(number_format($total_base_iva_5, 0, ",", "."), 8));
		$printer->text(str_pad(number_format($total_iva_5, 0, ",", "."), 8));
		$printer->setEmphasis(false);
		$printer->text("\n");

		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->setEmphasis(false);
		$printer->text(str_pad("A=0%", 6));
		$printer->text(str_pad(number_format($total_venta_0, 0, ",", "."), 8));
		$printer->text(str_pad(number_format($total_base_iva_0, 0, ",", "."), 8));
		$printer->text(str_pad(number_format($total_iva_0, 0, ",", "."), 8));
		$printer->setEmphasis(false);
		$printer->text("\n");
	}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
	$printer->text("FACTURA ".$nombre_tipo_resolucion_facturacion);
	$printer->text("\n");
	$printer->text("RESOLUCION DIAN: ".$numero_resolucion_facturacion." ");
	//$printer->text(" DE: ".$fecha_res_emp."\n");
	$printer->text("DESDE ".$prefijo_resolucion_facturacion." ".$ini_resolucion_facturacion." AL ".$prefijo_resolucion_facturacion." ".$fin_resolucion_facturacion."\n");
	//$printer->text("VIGENCIA ".$vigencia_res_emp." MESES"."\n");
	$printer->text("REGIMEN ".$regimen_emp);
	$printer->text("\n");
	$printer->text("****************************");
	$printer->text("\n");
	$printer->setEmphasis(true);
	$printer->text("Muchas gracias por su compra"."\n");
	$printer->setEmphasis(false);
	$printer->text("****************************");
	$printer->text("\n");
	$printer->text("Software ".$titulo_emp." Version ".$version_emp."");
	$printer->text("\n");
	$printer->text("".$desarrollador_emp." : ".$pag_desarrollador_emp."");
	$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$estandar_a = "{A";
	$estandar_b = "{B";
	$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);
	$barra      = $estandar_b.str_pad($cod_factura, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);
	//$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_encuesta_experiencia_compra_global == '1') { 
		$url_qr = $url_encuesta_experiencia_compra."?cod_info_factura_venta_codif_cryp=".$cod_info_factura_venta_codif_cryp;  
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text("Califica tu experiencia de compra en:\n");
		$printer -> text($url_encuesta_experiencia_compra."\n");
		$printer -> qrCode($url_qr, Printer::QR_ECLEVEL_L, 3);

		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer->setEmphasis(true);
		$printer -> text("ESCANEAME");
		$printer->text("\n");
	}
	$printer->text("".$fecha.$hora."-".$cod_factura."-".$cod_info_factura_venta."_imposdriv58");
	$printer->feed(3);

	echo "1";
} else { 

	$printer->setFont(Printer::FONT_B);
	$printer->setTextSize(1, 1);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	if ($cod_estado_img_impimir_factura_global == '1') { 
		try{
		$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos_blanco_negro.jpg", false);
		$printer->bitImage($logo);
		} catch(Exception $e) { }
	}

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setTextSize($tamano_letra_cabecera_emp_80mm, $tamano_letra_cabecera_emp_80mm);
	$printer->setEmphasis(true);
	$printer->text($cabecera_emp."\n");

	$printer->setTextSize(1, 1);
	$printer->setEmphasis(false);
	$printer->text($localidad_emp."\n");
	$printer->text("NIT: ".$nit_empresa_emp."\n");
	$printer->text("DIRECCION: ".$direccion_emp."\n");
	$printer->text("TELEFONO: ".$telefono_emp."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("FECHA: ".$fecha_anyo.' - '.$fecha_hora, 30));
	$printer->text(str_pad("FACTURA DE VENTA: ".$prefijo_resolucion_facturacion.' '.$cod_factura_strpad, 25));
	$printer->text("\n");


/*
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 30));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("TIPO DE PAGO: ".$nombre_tipo_pago, 25));
	$printer->text("\n");
*/


	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("NOMBRE CLIENTE: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");

	$printer->setEmphasis(true);
	$printer->text(str_pad($nombre_tipo_identificacion." CLIENTE: ".$cedula_cli, 30));
	$printer->text("\n");

	if ($cod_estado_puntos_redimibles_campanya_global == '1') {
		$printer->setEmphasis(true);
		$printer->text("PUNTOS REDIMIBLES ACUMULADOS: ");
		$printer->text(intval($total_puntos_redimibles_campanya_tercero));
		$printer->text("\n");
	}

	if ($cod_estado_renta_alquiler_global == '1' && $cod_estado_alquiler_renta == '1') {
		$printer->setEmphasis(true);
		$printer->text("FECHA INICIO ALQUILER: ");
		$printer->text(($fecha_ini_renta_alquiler));
		$printer->text("\n");
		$printer->text("FECHA FINAL ALQUILER: ");
		$printer->text(($fecha_fin_renta_alquiler));
		$printer->text("\n");
	}

	if (($cod_tipo_pago == '2') && ($cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global == '1')) {
		$printer->setTextSize(2, 2);
		$printer->setEmphasis(true);
		$printer->text("SALDO PENDIENTE: ");
		$printer->text((number_format($saldo_pendiente_cuenta_cobrar, 0, ",", ".")));
		$printer->text("\n");
		$printer->setTextSize(1, 1);
	}
/*
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CAJA: ".$cod_caja, 30));
	$printer->text(str_pad($nombre_concepto_multi_virtual." VIRTUAL: ".$cod_base_caja, 25));
	$printer->text("\n");
*/
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setEmphasis(true);
	$printer->text("<<=================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	if ($origen == '0') { $printer->text(str_pad("CODIGO", 20)); }
	$printer->text(str_pad("DESCRIPCION", 33));
	$printer->text(str_pad("VALOR", 9));
	$printer->text(str_pad("", 2));
	$printer->text("\n");
/*
	if ($origen == '0') { $printer->text(str_pad("CANT", 4)); }
	if ($origen == '0') { $printer->text(str_pad("U/M", 4)); }
	if ($origen == '0') { $printer->text(str_pad("VALOR UN", 9)); }
	$printer->text("\n");
*/
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=================================================>>");
	$printer->text("\n");
	$printer->setEmphasis(false);

$resultado_sql = "SELECT $select_productos_imp 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') 
AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla') 
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

	if ($nombre_tipo_unidad_medida == 'CAJA') { $subtitulo_tipo_caja = 'CAJA'; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $subtitulo_tipo_caja = 'SOBRE'; } else { $subtitulo_tipo_caja = "UND"; }
	if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

	$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
	$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
	$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

	$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

	if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
	if ($nombre_cliente=='') { $nombre_producto_cliente = $nombre_producto; } else { $nombre_producto_cliente = $nombre_cliente.' - '.$nombre_producto; }

	
	if ($cajas_sobre == '0') { $cajas_sobre = 1; }
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
	}

	$total_caracteres_producto = strlen($nombre_producto);
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($total_caracteres_producto > 28) {
		$nombre_producto1   = substr(trim($nombre_producto), 0, 28);
		$nombre_producto2   = substr(trim($nombre_producto), 28, 27);
	} else {
			$nombre_producto1   = substr($nombre_producto, 0, 27);
			$nombre_producto2   = "";
	}

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	if ($origen == '0') { $printer->text(str_pad($cod_producto_barra, 20)); }
	$printer->text(str_pad($nombre_producto1, 27,' ',STR_PAD_RIGHT));
	$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 10,' ',STR_PAD_LEFT));
	$printer->text(str_pad(" ".$nombre_tipo_iva, 2));
	$printer->text("\n");
	$printer->text(str_pad($und_venta, 4));
	$printer->text(str_pad($nombre_tipo_unidad_medida, 2));
	$printer->text(str_pad(' X ', 1));
	$printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 10,' ',STR_PAD_RIGHT));
	$printer->text(str_pad($nombre_producto2, 27,' ',STR_PAD_RIGHT));
	$printer->text("\n");
/*
	if ($total_caracteres_producto > 28) {
		$nombre_producto1   = substr(trim($nombre_producto), 0, 39);
		$nombre_producto2   = substr(trim($nombre_producto), 39, 27);

		$printer->setJustification(Printer::JUSTIFY_LEFT);
		if ($origen == '0') { $printer->text(str_pad($cod_producto_barra, 14)); }
		if ($origen == '0') { $printer->text(str_pad($und_venta, 6)); }
		$printer->text(str_pad($nombre_producto1, 27));
		if ($origen == '0') { $printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
		$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 10,' ',STR_PAD_LEFT));
		$printer->text(str_pad(" ".$nombre_tipo_iva, 2));

		if ($nombre_producto2 <> "") {
			$printer->text("\n");
			if ($origen == '0') { $printer->text(str_pad("", 6)); }
			$printer->text(str_pad($nombre_producto2, 27));
			if ($origen == '0') { $printer->text(str_pad("", 7,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad("", 10,' ',STR_PAD_LEFT));
		}
		$printer->text("\n");
	} else {
			$nombre_producto1   = substr($nombre_producto, 0, 27);
			$nombre_producto2   = "";

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($cod_producto_barra, 14)); }
			if ($origen == '0') { $printer->text(str_pad($und_venta, 6)); }
			$printer->text(str_pad($nombre_producto1, 27));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 10,' ',STR_PAD_LEFT));
			$printer->text(str_pad(" ".$nombre_tipo_iva, 2));
			$printer->text("\n");
	}
*/
//---------------------------------------------------------------------------------------------------------------------------------//
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<=================================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("SUBTOTAL ", 45));
$printer->text(str_pad(number_format($subtotal_base_sin_descuento, 0, ",", "."), 15));
$printer->text("\n");

//$printer->setJustification(Printer::JUSTIFY_LEFT);
//$printer->text(str_pad("%DESCUENTO", 18));
//$printer->text(str_pad(intval($descuento_ptj_dif)."%", 10));
//$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("DESCUENTO", 45));
$printer->text(str_pad($existe_descuento_factura_signo." ".number_format($total_descuentos_manual_y_en_el_precio_venta, 0, ",", "."), 15));
$printer->text("\n");

if ($nombre_producto_puntos_redimibles <> '') {
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad($nombre_producto_puntos_redimibles, 45));
	$printer->text(str_pad($existe_descuento_puntos_redimibles_signo." ".number_format(abs($total_descuento_puntos_redimibles_como_concepto), 0, ",", "."), 15));
	$printer->text("\n");
}

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("TOTAL DESCUENTO", 45));
$printer->text(str_pad($existe_descuento_factura_signo." ".number_format($total_descuento_venta, 0, ",", "."), 15));
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("IVA", 45));
$printer->text(str_pad(number_format($total_iva, 0, ",", "."), 15));
$printer->text("\n");

if ($existe_servicio_propina <> '0') {
	$printer->text(str_pad($nombre_producto_propina." ".$ptj_servicio_propina."%: ", 45));
	$printer->text(str_pad("".number_format($total_venta_producto_propina, 0, ",", "."), 15));
	$printer->text("\n");
}

if ($existe_servicio_cupobrilla <> '0') {
	$printer->text(str_pad($nombre_producto_cupobrilla." (".$ptj_servicio_cupobrilla."%): ", 45));
	$printer->text(str_pad("".number_format($total_venta_producto_cupobrilla, 0, ",", "."), 15));
	$printer->text("\n");
}

if ($existe_servicio_domicilio <> '0') {
	$printer->text(str_pad($nombre_producto_domicilio, 45));
	$printer->text(str_pad("".number_format($total_venta_producto_domicilio, 0, ",", "."), 15));
	$printer->text("\n");
}

//if ($existe_servicio_descuento <> '0') {
	//$printer->text(str_pad($nombre_producto_descuento.": ", 45));
	//$printer->text(str_pad("".number_format($total_venta_producto_descuento, 0, ",", "."), 15));
	//$printer->text("\n");
//}

$printer->setTextSize(2, 2);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad("TOTAL", 20));
$printer->text(str_pad(number_format($total_venta_temp, 0, ",", "."), 15));
$printer->setEmphasis(false);
//$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setTextSize(1, 1);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<=================================================>>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_tipo_pago == '1') {
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setEmphasis(true);
	$printer->text(str_pad("RECIBIDO ".$nombre_tipo_forma_pago, 45));
	$printer->text(str_pad("$ ".number_format($vlr_cancelado, 0, ",", "."), 15));
	$printer->setEmphasis(false);
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CAMBIO ", 45));
	$printer->text(str_pad("$ ".number_format($vlr_cambio, 0, ",", "."), 15));
	$printer->setEmphasis(false);
	$printer->text("\n");
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') {
} else { 
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("TIPO", 13));
	$printer->text(str_pad("COMPRA", 13));
	$printer->text(str_pad("BASE/IMP", 13));
	$printer->text(str_pad("IVA", 13));
	$printer->setEmphasis(false);
	$printer->text("\n");

	$cod_servicio_propina                                 = '22222222';
	$cod_servicio_cava                                    = '55555555';
	$cod_servicio_domicilio                               = '44444444';
	$cod_servicio_descuento_punto_redimible               = '11112222';
	$cod_servicio_descuento                               = '33333333';
	$cod_servicio_imp_bolsa                               = '11111111';
	$cod_servicio_retefuente                              = '11113333';
			
	$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
	Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
	Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19') 
	AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
	$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
	$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

	$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
	$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
	$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
	//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

	$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
	Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
	Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5') 
	AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
	$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
	$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

	$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
	$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
	$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
	//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

	$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
	Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
	Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
	FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0') 
	AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente') AND (cod_producto_barra <> '$cod_servicio_cupobrilla')";
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
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("G=19%", 13));
	$printer->text(str_pad(number_format($total_venta_19, 0, ",", "."), 13));
	$printer->text(str_pad(number_format($total_base_iva_19, 0, ",", "."), 13));
	$printer->text(str_pad(number_format($total_iva_19, 0, ",", "."), 13));
	$printer->setEmphasis(false);
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("S=5%", 13));
	$printer->text(str_pad(number_format($total_venta_5, 0, ",", "."), 13));
	$printer->text(str_pad(number_format($total_base_iva_5, 0, ",", "."), 13));
	$printer->text(str_pad(number_format($total_iva_5, 0, ",", "."), 13));
	$printer->setEmphasis(false);
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("A=0%", 13));
	$printer->text(str_pad(number_format($total_venta_0, 0, ",", "."), 13));
	$printer->text(str_pad(number_format($total_base_iva_0, 0, ",", "."), 13));
	$printer->text(str_pad(number_format($total_iva_0, 0, ",", "."), 13));
	$printer->setEmphasis(false);
	$printer->text("\n");
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<=================================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("ID CLIENTE: ", 22));
$printer->text(str_pad('', 10));
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("CEDULA DE CIUDADANIA: ", 22));
$printer->text(str_pad($identificacion_tercero, 10));
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<=================================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("ATENDIDO POR: ".$usario_vendedor."\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<=================================================>>");
$printer->text("\n");
$printer->text("FACTURA ".$nombre_tipo_resolucion_facturacion);
$printer->text("\n");
$printer->text("RESOLUCION DIAN: ".$numero_resolucion_facturacion." ");
//$printer->text(" DE: ".$fecha_res_emp."\n");
$printer->text("DESDE ".$prefijo_resolucion_facturacion." ".$ini_resolucion_facturacion." AL ".$prefijo_resolucion_facturacion." ".$fin_resolucion_facturacion."\n");
//$printer->text("VIGENCIA ".$vigencia_res_emp." MESES"."\n");
$printer->text("REGIMEN ".$regimen_emp);
$printer->text("\n");
$printer->text("*****************************************************");
$printer->text("\n");
$printer->setEmphasis(true);
$printer->text("Muchas gracias por su compra"."\n");
$printer->setEmphasis(false);
$printer->text("*****************************************************");
$printer->text("\n");
$printer->text("<== Software ".$titulo_emp." Version ".$version_emp." ==>");
$printer->text("\n");
$printer->text("<== ".$desarrollador_emp." : ".$pag_desarrollador_emp." ==>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$estandar_a = "{A";
$estandar_b = "{B";
$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);
$barra      = $estandar_b.str_pad($cod_factura, 5, "0", STR_PAD_LEFT);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setBarcodeHeight(60);
//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer -> barcode($barra, Printer::BARCODE_CODE128);
//$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_encuesta_experiencia_compra_global == '1') { 
	$url_qr = $url_encuesta_experiencia_compra."?cod_info_factura_venta_codif_cryp=".$cod_info_factura_venta_codif_cryp;  
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> text("Califica tu experiencia de compra en:\n");
	$printer -> text($url_encuesta_experiencia_compra."\n");
	$printer -> qrCode($url_qr, Printer::QR_ECLEVEL_L, 3);

	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer->setEmphasis(true);
	$printer -> text("ESCANEAME");
	$printer->text("\n");
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_enviar_factura_venta_electronica_dian_api_global == '1' && $nombre_tipo_factura == 'ELECTRONICA') {

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("CUFE: ".$cod_cufe."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("".$url_vpfe_dian_qr);
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer -> qrCode($url_vpfe_dian_qr, Printer::QR_ECLEVEL_L, 5);
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("".$nombre_agente_dian_contribuyente."\n");
	$printer->text("".$nombre_agente_dian_retenedor."\n");
	$printer->text("".$nombre_agente_dian_autoretenedor."\n");
	if ($existe_no_aplicar_retencion <> '0') {
		$printer->text("".$nombre_agente_dian_no_aplicar_retencion."\n");
	}
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($qr_pago_bancolombia <> '') {

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=================================================>>");
	$printer->text("\n");
	
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer -> qrCode($generar_qr_pago_bancolombia, Printer::QR_ECLEVEL_L, 5);
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("Cuenta Bancolombia Ahorros: ".$numero_cuenta_pago_bancolombia);
	$printer->text("\n");

}
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->text("<== ".$fecha.$hora."-".$cod_factura."-".$cod_info_factura_venta."_imposdriv80 ==>");

$printer->feed(2);

echo "1";
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
/*Alimentamos el papel 3 veces*/
/* 	Cortamos el papel. Si nuestra impresora no tiene soporte para ello, no generará ningún error */
$printer->cut();
/* 	Por medio de la impresora mandamos un pulso. Esto es útil cuando la tenemos conectada por ejemplo a un cajón */
$printer->pulse();
/* Para imprimir realmente, tenemos que "cerrar" la conexión con la impresora. Recuerda incluir esto al final de todos los archivos */
$printer->close();
?>