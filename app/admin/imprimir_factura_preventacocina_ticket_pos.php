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
$cuenta                                         = addslashes($_GET['cuenta']);
$cod_caja_virtual                               = intval($_GET['cod_caja_virtual']);
$cod_info_factura_venta                         = intval($_GET['cod_info_factura_venta']);
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
$tamano_papel_impresora                                            = $info_empresa_data['tamano_papel_impresora'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];
$cod_estado_tipo_servicio_global                                   = $info_empresa_data['cod_estado_tipo_servicio_global'];

if ($nombre_tipo_campo_componente_html_und_venta == 'text') { $nombre_tipo_campo_componente_html_und_venta = 'text'; } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if ($nombre_tipo_campo_componente_html_und_compra == 'text') { $nombre_tipo_campo_componente_html_und_compra = 'text'; } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_compra == 'text') { $nombre_tipo_campo_componente_html_precio_compra = 'text'; } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_venta == 'text') { $nombre_tipo_campo_componente_html_precio_venta = 'text'; } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_agrupar_por_producto_imp_global == '1') { 
  $agrupar_productos_imp = 'GROUP BY cod_producto_barra';
  $select_productos_imp = 'SUM(und_venta) as und_venta, precio_venta_producto, SUM(total_venta_producto) as total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj'; 
} else { 
  $agrupar_productos_imp = ''; 
  $select_productos_imp = 'und_venta, precio_venta_producto, total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj'; 
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                         = $info_fact['cod_factura'];
$fecha_anyo                          = $info_fact['fecha_anyo'];
$fecha_hora                          = substr($info_fact['fecha_hora'], 0, 5);
$total_precio_compra                 = $info_fact['total_precio_compra'];
$total_precio_venta                  = $info_fact['total_precio_venta'];
$total_datos_data                    = $info_fact['total_datos_data'];
$cod_tercero                         = $info_fact['cod_tercero'];
//$cuenta                              = $info_fact['cuenta'];
$vlr_cancelado                       = $info_fact['vlr_cancelado'];
$vlr_vuelto                          = $info_fact['vlr_vuelto'];
$cod_tipo_pago                       = $info_fact['cod_tipo_pago'];
$cod_administrador                   = $info_fact['cod_administrador'];
$cod_tipo_forma_pago                 = $info_fact['cod_tipo_forma_pago'];
$nombre_tipo_factura                 = $info_fact['nombre_tipo_factura'];
$nombre_tipo_moneda                  = $info_fact['nombre_tipo_moneda'];
$cod_resolucion_facturacion          = $info_fact['cod_resolucion_facturacion'];
$descuento_ptj                       = $info_fact['descuento_ptj'];
$cod_caja_virtual                    = $info_fact['cod_caja_virtual'];
$cod_base_caja                       = $info_fact['cod_base_caja'];
$cod_prioridad                       = $info_fact['cod_prioridad'];
$cod_tipo_servicio                   = $info_fact['cod_tipo_servicio'];
$cod_info_factura_strpad             = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

$cod_info_factura_venta_codif        = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
$cod_info_factura_venta_codif_cryp   = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                         = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

$cod_tipo_resolucion_facturacion        = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
$nombre_tipo_resolucion_facturacion     = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$numero_resolucion_facturacion          = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
$ini_resolucion_facturacion             = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
$fin_resolucion_facturacion             = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
$prefijo_resolucion_facturacion         = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
$fecha_resolucion_facturacion           = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
$vigencia_meses_resolucion_facturacion  = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
$nombre_tipo_estado                     = $matriz_resolucion_facturacion['nombre_tipo_estado'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cuenta = '$cuenta')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                     = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                            = $matriz_usario_vendedor['cod_caja'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_servicio_propina                                 = '22222222';
$cod_servicio_cava                                    = '55555555';
$cod_servicio_domicilio                               = '44444444';
$cod_servicio_descuento_punto_redimible               = '11112222';
$cod_servicio_descuento                               = '33333333';
$cod_servicio_imp_bolsa                               = '11111111';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$total_venta_temp                    = 0;
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
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora                                = date("His");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
$fecha_hoy                           = date("Y-m-d");
$hora_impresion                      = date("H:i:s");
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_producto_barra = '$cod_servicio_propina') ORDER BY cod_venta_producto_temporal ASC";
$consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
$existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
$info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

$nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
$precio_venta_producto_propina         = $info_servicio_propina['precio_venta_producto'];
$total_venta_producto_propina          = $info_servicio_propina['total_venta_producto'];

$sql_servicio_descuento = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_producto_barra = '$cod_servicio_descuento') ORDER BY cod_venta_producto_temporal ASC";
$consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
$existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
$info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

$nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
$precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
$total_venta_producto_descuento        = $info_servicio_descuento['total_venta_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$suma_subtotal_venta = "SELECT Sum(total_venta_producto) As subtotal_venta FROM tbl15_venta_producto_temporal 
WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_producto_barra <> '$cod_servicio_propina' AND cod_producto_barra <> '$cod_servicio_descuento')";
$consulta_subtotal_venta = mysqli_query($conectar, $suma_subtotal_venta);
$matriz_subtotal_venta = mysqli_fetch_assoc($consulta_subtotal_venta);

$subtotal_venta                 = $matriz_subtotal_venta['subtotal_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_impresora = "SELECT nombres, apellidos, nombre_maquina, nombre_impresora FROM tbl15_administrador WHERE (cuenta = '$cuenta_actual')";
$consultar_info_impresora = mysqli_query($conectar, $sql_info_impresora) or die(mysqli_error($conectar));
$info_impresora = mysqli_fetch_assoc($consultar_info_impresora);

$nombre_maquina                                 = $info_impresora['nombre_maquina'];
$nombre_impresora                               = $info_impresora['nombre_impresora'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_servicio = "SELECT * FROM tbl15_tipo_servicio WHERE (cod_tipo_servicio = '$cod_tipo_servicio')";
$resultado_tipo_servicio = mysqli_query($conectar, $sql_tipo_servicio) or die(mysqli_error($conectar));
$info_tipo_servicio = mysqli_fetch_assoc($resultado_tipo_servicio);

$nombre_tipo_servicio                         = $info_tipo_servicio['nombre_tipo_servicio'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_base_caja == '0') { $cod_base_caja = 'DOMICILIO'; } else { $cod_base_caja = $cod_base_caja; }
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
}catch(Exception $e){ }
}

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text($cabecera_emp."\n");
$printer->setEmphasis(false);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<==========================>>");
$printer->text("\n");

$printer->setEmphasis(true);
$printer->text("TICKET DE CHEF"."\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text("ID: ".$cod_info_factura_strpad."\n");
//$printer->setTextSize(2, 2);
$printer->setEmphasis(true);
$printer->text("FECHA: ".$fecha_anyo." - ".$hora_impresion."\n");
//$printer->setTextSize(1, 1);
$printer->setEmphasis(false);
$printer->text("VENDEDOR (A): ".$usario_vendedor."\n");
$printer->text($nombre_concepto_multi_virtual.": ".$cod_base_caja."\n");
//$printer->text("PRIORIDAD: ".$cod_prioridad."\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<==========================>>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad("CANT", 5));
$printer->text(str_pad("DESCRIPCION", 20));
//$printer->text(str_pad("OBSERVACION", 16));
$printer->text(str_pad("P.UNIT", 7));
$printer->setEmphasis(false);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<==========================>>");
$printer->text("\n");

$total_venta_temp = 0;
$condicional_entero = "";

$resultado_sql = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_check_imp = '1') ORDER BY cod_venta_producto_temporal DESC";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$cod_producto                = $info_venta['cod_producto'];
$cod_producto_barra          = $info_venta['cod_producto_barra'];
$nombre_producto             = $info_venta['nombre_producto'];
$und_venta                   = $info_venta['und_venta'];
$comentario_producto         = substr(trim($info_venta['comentario_producto']), 0, 15);
$precio_venta_producto       = $info_venta['precio_venta_producto'];
$total_venta_producto        = $info_venta['total_venta_producto'];
$total_venta_temp           += $total_venta_producto;

if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$total_caracteres_producto = strlen($nombre_producto);
//---------------------------------------------------------------------------------------------------------------------------------//
if ($total_caracteres_producto > 17) {
$nombre_producto1   = substr(trim($nombre_producto), 0, 17);
$nombre_producto2   = substr(trim($nombre_producto), 17, 40);

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad($und_venta, 4));
$printer->text(str_pad($nombre_producto1, 17));
//$printer->text(str_pad($comentario_producto, 16));
$printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));

if ($nombre_producto2 <> "") {
$printer->text("\n");
$printer->text(str_pad("", 4));
$printer->text(str_pad($nombre_producto2, 17));
//$printer->text(str_pad("", 1,' ',STR_PAD_LEFT));
$printer->text(str_pad("", 1,' ',STR_PAD_LEFT));
}

$printer->text("\n");
} else {
$nombre_producto1   = substr($nombre_producto, 0, 17);
$nombre_producto2   = "";

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad($und_venta, 4));
$printer->text(str_pad($nombre_producto1, 17));
//$printer->text(str_pad($comentario_producto, 16));
$printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));
$printer->text("\n");
}
//---------------------------------------------------------------------------------------------------------------------------------//
}
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<==========================>>");
$printer->text("\n");
$printer->text("".$fecha.$hora."-".$cod_factura."-".$cod_info_factura_venta."_precodriv58");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->feed(3);

echo "1";

} else { 

	$printer->setFont(Printer::FONT_B);
	$printer->setTextSize(1, 1);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	if ($cod_estado_img_impimir_factura_global == '1') { 
		try {
			$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos_blanco_negro.jpg", false);
			$printer->bitImage($logo);
		} catch(Exception $e) { }
	}

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setEmphasis(true);
	$printer->text($cabecera_emp."\n");
	$printer->setEmphasis(false);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================================================>>");
	$printer->text("\n");

	$printer->setEmphasis(true);
	$printer->text("TICKET DE CHEF"."\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->setTextSize(2, 2);
	$printer->text("FECHA: ".$fecha_anyo." - ".$hora_impresion."\n");
	$printer->setTextSize(1, 1);
	$printer->text("ID: ".$cod_info_factura_strpad."\n");
	$printer->text(str_pad("VENDEDOR (A): ".$usario_vendedor, 35));
	$printer->text(str_pad($nombre_concepto_multi_virtual.": ".$cod_base_caja, 23));
	$printer->text("\n");
	if ($cod_estado_tipo_servicio_global == '1') {
		$printer->text("TIPO SERVICIO: ".$nombre_tipo_servicio."\n");
	}
	//$printer->text("PRIORIDAD: ".$cod_prioridad."\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CANT", 5));
	$printer->text(str_pad("DESCRIPCION", 24));
	$printer->text(str_pad("", 23));
	$printer->text(str_pad("", 10));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================================================>>");
	$printer->text("\n");

	$total_venta_temp = 0;
	$condicional_entero = "";

	$resultado_sql = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_check_imp = '1') ORDER BY cod_venta_producto_temporal DESC";
	$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
	while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

		$cod_producto                = $info_venta['cod_producto'];
		$cod_producto_barra          = $info_venta['cod_producto_barra'];
		$nombre_producto             = $info_venta['nombre_producto'];
		$und_venta                   = $info_venta['und_venta'];
		$comentario_producto         = substr(trim($info_venta['comentario_producto']), 0, 40);
		$precio_venta_producto       = $info_venta['precio_venta_producto'];
		$total_venta_producto        = $info_venta['total_venta_producto'];
		$total_venta_temp           += $total_venta_producto;

		if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
		if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

		$total_caracteres_producto = strlen($nombre_producto);
		$total_caracteres_coment = strlen($comentario_producto);
	//---------------------------------------------------------------------------------------------------------------------------------//
		if ($total_caracteres_producto > 30) {
			$nombre_producto1   = substr(trim($nombre_producto), 0, 26);
			$nombre_producto2   = substr(trim($nombre_producto), 26, 25);

			$printer->setJustification(Printer::JUSTIFY_LEFT);

			$printer->setTextSize(2, 2);
			$printer->text(str_pad($und_venta, 3));
			$printer->text(str_pad($nombre_producto1, 26));
			$printer->text(str_pad('', 10));
			$printer->setTextSize(1, 1);
			//$printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 7,' ',STR_PAD_LEFT));

			if ($nombre_producto2 <> "") {
				//$printer->text("\n");
				$printer->text(str_pad("", 3));
				$printer->setTextSize(2, 2);
				$printer->text(str_pad($nombre_producto2, 26));
				$printer->setTextSize(1, 1);
				if ($comentario_producto <> '') { $printer->text(str_pad('', 2)); $printer->text(str_pad('('.$comentario_producto.')', 25)); }
				$printer->text(str_pad("", 10,' ',STR_PAD_LEFT));
			}
		$printer->text("\n");
		} else {
			$nombre_producto1   = substr($nombre_producto, 0, 26);
			$nombre_producto2   = "";

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$printer->setTextSize(2, 2);
			$printer->text(str_pad($und_venta, 3));
			$printer->text(str_pad($nombre_producto1, 26));
			$printer->setTextSize(1, 1);
			if ($comentario_producto <> '') { $printer->text("\n"); $printer->text(str_pad('', 2)); $printer->text(str_pad('('.$comentario_producto.')', 25)); }
			//$printer->text(str_pad(number_format($precio_venta_producto, 0, ",", "."), 7,' ',STR_PAD_LEFT));
			$printer->text("\n");
		}
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================================================>>");
	$printer->text("\n");
	$printer->text("".$fecha.$hora."-".$cod_factura."-".$cod_info_factura_venta."_precodriv80");
	$printer->feed(1);

	echo "1";
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
/*Alimentamos el papel 3 veces*/
/* 	Cortamos el papel. Si nuestra impresora no tiene soporte para ello, no generará ningún error */
$printer->cut();
/* 	Por medio de la impresora mandamos un pulso. Esto es útil cuando la tenemos conectada por ejemplo a un cajón */
//$printer->pulse();
/* Para imprimir realmente, tenemos que "cerrar" la conexión con la impresora. Recuerda incluir esto al final de todos los archivos */
$printer->close();

?>