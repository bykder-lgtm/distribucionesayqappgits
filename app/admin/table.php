<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//$cuenta_actual = addslashes($_SESSION['usuario']);
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des         = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion    = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion     = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo        = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion      = ($_SESSION['cod_cliente_sesion']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);
$cod_seguridad           = ($_SESSION['cod_seguridad']);
$cod_caja_virtual        = ($_SESSION['cod_caja_virtual']);
$token                   = ($_SESSION['token']);

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

if ($nombre_tipo_campo_componente_html_und_venta == 'text') { $nombre_tipo_campo_componente_html_und_venta = 'text'; } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if ($nombre_tipo_campo_componente_html_und_compra == 'text') { $nombre_tipo_campo_componente_html_und_compra = 'text'; } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_compra == 'text') { $nombre_tipo_campo_componente_html_precio_compra = 'text'; } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_venta == 'text') { $nombre_tipo_campo_componente_html_precio_venta = 'text'; } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }

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

include_once('../admin/01_modulo_permisos.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Editaxe App</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="../imagenes/icono.ico" rel="icon">
    <!-- Icon Font Stylesheet -->
    <link href="../estilo_css/aplicacion_tv_all.min.css" rel="stylesheet">
    <link href="../estilo_css/aplicacion_tv_bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="../estilo_css/aplicacion_tv_owl.carousel.min.css" rel="stylesheet">
    <link href="../estilo_css/aplicacion_tv_tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../estilo_css/aplicacion_tv_bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="../estilo_css/aplicacion_tv_style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">App Tv</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $cuenta_actual; ?></h6>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link"><h6 class="mb-0">Mesas por Atender</h6></a>
                    <a href="index.html" class="nav-item nav-link"><h6 class="mb-0">Mesas Atedidas</h6></a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">

            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h5 class="text-primary">App Tv</h5>
            </nav>
<?php
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = 'lista_caja_virtual_cocina.php'; } else { $pagina_redirect = 'lista_caja_virtual_cocina.php'; }
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY fecha_modificacion DESC'; } else { $ordenar_consulta = 'ORDER BY cod_prioridad'; }
$pagina_local        = $_SERVER['PHP_SELF'];


if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
    $condic_estado_info = "AND (cod_estado_cocina = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_cocina = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
    $condic_estado_info = "AND (cod_estado_bartender = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_bartender = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
    $condic_estado_info = "AND (cod_estado_jugueria = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_jugueria = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
else { 
    $condic_estado_info = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_origen_produccion_user = ""; 
}
?>
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4"><?php echo $nombre_concepto_multi_virtual; ?>S POR ATENDER</h6>
                            <div class="table-responsive">

                                <div id="salida_tabla_caja_mesa_ajax">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">VER</th>
                                                <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
                                                <th style="text-align:center;">USUARIO</th>
                                                <th style="text-align:center;">DESCRIPCION</th>
                                                <th style="text-align:center;"></th>
                                                <?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?><th style="text-align:center;">PRIORIDAD</th><?php } ?>
                                                <th style="text-align:center;">FECHA | HORA</th>
                                                <th style="text-align:center;">ATENDIDO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$nombre_producto_concat             = '';
$salida_tra                         = '';


$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, observacion, 
nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, 
cod_estado_revisado, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, latitud, longitud, latitud_longitud, 
cod_estado_revisado_cocina, cod_estado_revisado_bartender, cod_estado_revisado_jugueria
FROM tbl15_info_factura_venta 
WHERE (nombre_estado_factura = 'ABIERTA') $condic_estado_info $ordenar_consulta";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_reg = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$nombre_producto_concat             = '';
$cod_info_factura_venta             = $datos['cod_info_factura_venta'];
$cod_caja_virtual                   = $datos['cod_caja_virtual'];
$cuenta                             = $datos['cuenta'];
$cod_tercero                        = $datos['cod_tercero'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_hora                         = $datos['fecha_hora'];
$cod_administrador                  = $datos['cod_administrador'];
$cod_prioridad                      = $datos['cod_prioridad'];
$cod_base_caja                      = $datos['cod_base_caja'];

$nombre1_tercero                    = $datos['nombre1_tercero'];
$nombre2_tercero                    = $datos['nombre2_tercero'];
$apellido1_tercero                  = $datos['apellido1_tercero'];
$apellido2_tercero                  = $datos['apellido2_tercero'];
$identificacion_tercero             = $datos['identificacion_tercero'];
$fecha_nac_tercero                  = $datos['fecha_nac_tercero'];
$direccion_tercero                  = $datos['direccion_tercero'];
$telefono1_tercero                  = $datos['telefono1_tercero'];
$correo_tercero                     = $datos['correo_tercero'];
$cod_estado_revisado                = $datos['cod_estado_revisado'];
$cod_tipo_metodo_envio              = $datos['cod_tipo_metodo_envio'];
$cod_tipo_aplicacion                = $datos['cod_tipo_aplicacion'];
$cod_zona_envio                     = $datos['cod_zona_envio'];
$observacion_db                     = $datos['observacion'];
$latitud                            = $datos['latitud'];
$longitud                           = $datos['longitud'];
$latitud_longitud                   = $datos['latitud_longitud'];
$cod_estado_revisado_cocina         = $datos['cod_estado_revisado_cocina'];
$cod_estado_revisado_bartender      = $datos['cod_estado_revisado_bartender'];
$cod_estado_revisado_jugueria       = $datos['cod_estado_revisado_jugueria'];

if ($observacion_db == '') { $observacion = ""; } else { $observacion = "<br>[".$observacion_db."]"; }
if ($nombre1_tercero == '') { $nombre_cliente_visitante = ""; } else { $nombre_cliente_visitante = " (".$nombre1_tercero.")"; }
//if (($cod_estado_revisado_cocina == '0') && ($cod_origen_produccion_user == '1')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }
//if (($cod_estado_revisado_bartender == '0') && ($cod_origen_produccion_user == '2')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }
//if (($cod_estado_revisado_jugueria == '0') && ($cod_origen_produccion_user == '3')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

$sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
$nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
$apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
$apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

$cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_info_usuario = "SELECT cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
$datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

$nombres                            = $datos_info_usuario['nombres'];
$apellidos                          = $datos_info_usuario['apellidos'];
$nombre_usuario                     = $nombres.' '.$apellidos;
$cuenta_usuario                     = $datos_info_usuario['cuenta'];

$sql_datos_venta_temp = "SELECT cod_venta_producto_temporal, cod_producto_barra, und_venta, nombre_producto, cod_estado_revisado, cod_estado_revisado_cocina, 
cod_estado_revisado_bartender, cod_estado_revisado_jugueria, comentario_producto, cod_origen_produccion 
FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') $condic_origen_produccion_user $condic_estado_venta_temp ORDER BY cod_venta_producto_temporal DESC";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

$nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
$und_venta_con                       = $datos_venta_temp['und_venta'];
$comentario_producto_con             = $datos_venta_temp['comentario_producto'];
$cod_origen_produccion_con           = $datos_venta_temp['cod_origen_produccion'];
$cod_estado_revisado_con             = $datos_venta_temp['cod_estado_revisado'];
$cod_estado_revisado_cocina_con      = $datos_venta_temp['cod_estado_revisado_cocina'];
$cod_estado_revisado_bartender_con   = $datos_venta_temp['cod_estado_revisado_bartender'];
$cod_estado_revisado_jugueria_con    = $datos_venta_temp['cod_estado_revisado_jugueria'];

if ($cod_estado_marcado_revisado_caja_mesa_venta_temporal_global == '1') { $nombre_producto_concat .= "<mark>".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.'</mark><br>'; } else { $nombre_producto_concat .= "".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.'<br>'; }

}

$sql_datos_venta_temp_total = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_datos_venta_temp_total = mysqli_query($conectar, $sql_datos_venta_temp_total);
$datos_venta_temp_total = mysqli_fetch_assoc($consulta_datos_venta_temp_total);

$total_venta_producto_ciclo                = $datos_venta_temp_total['total_venta_producto'];

$sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
$consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio);
$datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

$nombre_tipo_metodo_envio                  = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];

$sql_tipo_aplicacion = "SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion WHERE (cod_tipo_aplicacion = '$cod_tipo_aplicacion')";
$consulta_tipo_aplicacion = mysqli_query($conectar, $sql_tipo_aplicacion);
$datos_tipo_aplicacion = mysqli_fetch_assoc($consulta_tipo_aplicacion);

$nombre_tipo_aplicacion                    = $datos_tipo_aplicacion['nombre_tipo_aplicacion'];


$sql_zona_envio = "SELECT nombre_zona_envio FROM tbl15_zona_envio WHERE (cod_zona_envio = '$cod_zona_envio')";
$consulta_zona_envio = mysqli_query($conectar, $sql_zona_envio);
$datos_zona_envio = mysqli_fetch_assoc($consulta_zona_envio);

$nombre_zona_envio                         = $datos_zona_envio['nombre_zona_envio'];
?>
                                            <tr>
                                                <th style="text-align:center;"><a href="../admin/cocina_facturacion_venta_temporal_producto_manual_pos.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/ver3.png alt="ver"></th>
                                                <th style="text-align:center;"><?php echo $cod_base_caja; ?></th>
                                                <th style="text-align:left;"><?php echo $nombre_usuario; ?></th>
                                                <th style="text-align:left;"><?php echo $nombre_producto_concat; ?></th>
                                                <th style="text-align:left;"><?php echo $observacion; ?></th>
                                                <?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?><th style="text-align:center;"><?php echo $cod_prioridad; ?></th><?php } ?>
                                                <th style="text-align:center;"><?php echo $fecha_anyo.' | '.$fecha_hora; ?></th>
                                                <th style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/entregar_servicio_comida2.png alt="entregar_servicio_comida"></th>
                                            </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


            <!-- Footer Start -->
<!--
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            
                        </div>
                    </div>
                </div>
            </div>
-->
            <!-- Footer End -->
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="../js/aplicacion_tv_jquery-3.4.1.min.js"></script>
    <script src="../js/aplicacion_tv_bootstrap.bundle.min.js"></script>
    <script src="../js/aplicacion_tv_chart.min.js"></script>
    <script src="../js/aplicacion_tv_easing.min.js"></script>
    <script src="../js/aplicacion_tv_waypoints.min.js"></script>
    <script src="../js/aplicacion_tv_owl.carousel.min.js"></script>
    <script src="../js/aplicacion_tv_moment.min.js"></script>
    <script src="../js/aplicacion_tv_moment-timezone.min.js"></script>
    <script src="../js/aplicacion_tv_tempusdominus-bootstrap-4.min.js"></script>
    <!-- Template Javascript -->
    <script src="../js/aplicacion_tv_main.js"></script>
</body>
</html>


<script language="javascript">
setInterval("refrescar_pagina_ajax()",5000);

function refrescar_pagina_ajax(){

    var nombre_estado_factura = 'ABIERTA';
    var cod_estado_cocina = '0';
    var tipo_ajax = 'refrescar';
    var caja_mesa = '';
    var pagina = '';
    var pagina_redirect = '';

    var datos_url_ajax = 'nombre_estado_factura='+nombre_estado_factura+'&'+'cod_estado_cocina='+cod_estado_cocina+'&'+'tipo_ajax='+tipo_ajax+'&'+'caja_mesa='+caja_mesa+'&'+'pagina='+pagina+'&'+'pagina_redirect='+pagina_redirect;

    $.ajax({
        type: "POST",
        url: "../admin/refrescar_pagina_caja_virtual_cocina_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(respuesta){
            var salida_tabla_caja_mesa_ajax = respuesta.salida_tabla_caja_mesa_ajax;
            $('#salida_tabla_caja_mesa_ajax').html(salida_tabla_caja_mesa_ajax);
        }
    });

//console.log("refresco div")
}
</script>