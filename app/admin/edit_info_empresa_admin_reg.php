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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_info_empresa                            = intval($_POST['cod_info_empresa']);
$titulo                                      = addslashes($_POST['titulo']);
$nombre                                      = addslashes($_POST['nombre']);
$eslogan                                     = addslashes($_POST['eslogan']);
$res                                         = addslashes($_POST['res']);
$res1                                        = addslashes($_POST['res1']);
$res2                                        = addslashes($_POST['res2']);
$fecha_res                                   = addslashes($_POST['fecha_res']);
$pais                                        = addslashes($_POST['pais']);
$departamento                                = addslashes($_POST['departamento']);
$ciudad                                      = addslashes($_POST['ciudad']);
$localidad                                   = addslashes($_POST['localidad']);
$direccion                                   = addslashes($_POST['direccion']);
$correo                                      = addslashes($_POST['correo']);
$cabecera                                    = addslashes($_POST['cabecera']);
$img_cabecera                                = addslashes($_POST['img_cabecera']);
$telefono                                    = addslashes($_POST['telefono']);
$nit_empresa                                 = addslashes($_POST['nit_empresa']);
$regimen                                     = addslashes($_POST['regimen']);
$logotipo                                    = addslashes($_POST['logotipo']);
$icono                                       = '../imagenes/'.addslashes($_POST['icono']);
$nombre_font                                 = addslashes($_POST['nombre_font']);
$tamano_font_hc                              = intval($_POST['tamano_font_hc']);
$tamano_font_aptlab                          = intval($_POST['tamano_font_aptlab']);
$tamano_font_trabaltu                        = intval($_POST['tamano_font_trabaltu']);
$tamano_font_manaliment                      = intval($_POST['tamano_font_manaliment']);
$tamano_font_informe                         = intval($_POST['tamano_font_informe']);
$tamano_font_remision                        = intval($_POST['tamano_font_remision']);
$tamano_font_factura                         = intval($_POST['tamano_font_factura']);
$propietario_nombres_apellidos               = addslashes($_POST['propietario_nombres_apellidos']);
$propietario_nit                             = addslashes($_POST['propietario_nit']);
//$propietario_url_firma                       = addslashes($_POST['propietario_url_firma']);
$info_legal                                  = addslashes($_POST['info_legal']);
$reg_medico                                  = addslashes($_POST['reg_medico']);
$licencia                                    = addslashes($_POST['licencia']);
$smtp_correo_host                            = addslashes($_POST['smtp_correo_host']);
$smtp_correo_auth                            = addslashes($_POST['smtp_correo_auth']);
$smtp_correo_username                        = addslashes($_POST['smtp_correo_username']);
$smtp_correo_password                        = addslashes($_POST['smtp_correo_password']);
$smtp_correo_secure                          = addslashes($_POST['smtp_correo_secure']);
$smtp_correo_port                            = addslashes($_POST['smtp_correo_port']);
//$info_histclinic                           = addslashes($_POST['info_histclinic']);
$info_aptlaboral                             = addslashes($_POST['info_aptlaboral']);
$dia_ini_facturacion                         = addslashes($_POST['dia_ini_facturacion']);
$dia_fin_facturacion                         = addslashes($_POST['dia_fin_facturacion']);
$dia_fin_facturacion                         = addslashes($_POST['dia_fin_facturacion']);
$pagina                                      = addslashes($_POST['pagina']);
$numero_precio                               = addslashes($_POST['numero_precio']);
$nombre_tipo_precio_venta                    = addslashes($_POST['nombre_tipo_precio_venta']);
$nombre_concepto_multi_virtual               = addslashes($_POST['nombre_concepto_multi_virtual']);
$ptj_servicio_propina                        = addslashes($_POST['ptj_servicio_propina']);
$cod_servicio_propina                        = addslashes($_POST['cod_servicio_propina']);
$nombre_servicio_propina                     = addslashes($_POST['nombre_servicio_propina']);
$precio_servicio_propina                     = addslashes($_POST['precio_servicio_propina']);
$ptj_bolsa                                   = addslashes($_POST['ptj_bolsa']);
$cod_bolsa                                   = addslashes($_POST['cod_bolsa']);
$nombre_bolsa                                = addslashes($_POST['nombre_bolsa']);
$precio_bolsa                                = addslashes($_POST['precio_bolsa']);
$nombre_tipo_empresa                         = addslashes($_POST['nombre_tipo_empresa']);
$dias_vencimiento_producto_alerta            = intval($_POST['dias_vencimiento_producto_alerta']);
$url_encuesta_experiencia_compra             = addslashes($_POST['url_encuesta_experiencia_compra']);
$nombre_operador_factura_electronica         = addslashes($_POST['nombre_operador_factura_electronica']);
$nombre_tipo_impresora_zebra_ticket          = addslashes($_POST['nombre_tipo_impresora_zebra_ticket']);
$nombre_empresa_sticker                      = addslashes($_POST['nombre_empresa_sticker']);
$nombre_buscar_por                           = addslashes($_POST['nombre_buscar_por']);
$limite_mostrar_producto_lista_caja_virtual  = intval($_POST['limite_mostrar_producto_lista_caja_virtual']);

$cod_servicio_domicilio                      = addslashes($_POST['cod_servicio_domicilio']);
$nombre_servicio_domicilio                   = addslashes($_POST['nombre_servicio_domicilio']);
$precio_servicio_domicilio                   = addslashes($_POST['precio_servicio_domicilio']);
$ptj_servicio_domicilio                      = addslashes($_POST['ptj_servicio_domicilio']);

$ptj_servicio_cava                           = addslashes($_POST['ptj_servicio_cava']);
$cod_servicio_cava                           = addslashes($_POST['cod_servicio_cava']);
$nombre_servicio_cava                        = addslashes($_POST['nombre_servicio_cava']);
$precio_servicio_cava                        = addslashes($_POST['precio_servicio_cava']);

$dias_alerta_entrega_venta                   = addslashes($_POST['dias_alerta_entrega_venta']);

if (isset($_POST['cod_estado_fecha_vencimiento_global'])) { $cod_estado_fecha_vencimiento_global = intval($_POST['cod_estado_fecha_vencimiento_global']); } else { $cod_estado_fecha_vencimiento_global = '0'; }
if (isset($_POST['cod_estado_ptj_comision_global'])) { $cod_estado_ptj_comision_global = intval($_POST['cod_estado_ptj_comision_global']); } else { $cod_estado_ptj_comision_global = '0'; }
if (isset($_POST['cod_estado_impoconsumo_global'])) { $cod_estado_impoconsumo_global = intval($_POST['cod_estado_impoconsumo_global']); } else { $cod_estado_impoconsumo_global = '0'; }
if (isset($_POST['cod_estado_dto1_global'])) { $cod_estado_dto1_global = intval($_POST['cod_estado_dto1_global']); } else { $cod_estado_dto1_global = '0'; }
if (isset($_POST['cod_estado_dto2_global'])) { $cod_estado_dto2_global = intval($_POST['cod_estado_dto2_global']); } else { $cod_estado_dto2_global = '0'; }
if (isset($_POST['cod_estado_preventa_global'])) { $cod_estado_preventa_global = intval($_POST['cod_estado_preventa_global']); } else { $cod_estado_preventa_global = '0'; }
if (isset($_POST['cod_estado_propina_global'])) { $cod_estado_propina_global = intval($_POST['cod_estado_propina_global']); } else { $cod_estado_propina_global = '0'; }
if (isset($_POST['cod_estado_img_impimir_factura_global'])) { $cod_estado_img_impimir_factura_global = intval($_POST['cod_estado_img_impimir_factura_global']); } else { $cod_estado_img_impimir_factura_global = '0'; }
if (isset($_POST['cod_estado_encuesta_experiencia_compra_global'])) { $cod_estado_encuesta_experiencia_compra_global = intval($_POST['cod_estado_encuesta_experiencia_compra_global']); } else { $cod_estado_encuesta_experiencia_compra_global = '0'; }
if (isset($_POST['cod_estado_codif_precio_compra_global'])) { $cod_estado_codif_precio_compra_global = intval($_POST['cod_estado_codif_precio_compra_global']); } else { $cod_estado_codif_precio_compra_global = '0'; }
if (isset($_POST['cod_estado_codif_precio_venta_global'])) { $cod_estado_codif_precio_venta_global = intval($_POST['cod_estado_codif_precio_venta_global']); } else { $cod_estado_codif_precio_venta_global = '0'; }
if (isset($_POST['cod_estado_inventario_bodega_global'])) { $cod_estado_inventario_bodega_global = intval($_POST['cod_estado_inventario_bodega_global']); } else { $cod_estado_inventario_bodega_global = '0'; }
if (isset($_POST['cod_estado_sticker_barras_global'])) { $cod_estado_sticker_barras_global = intval($_POST['cod_estado_sticker_barras_global']); } else { $cod_estado_sticker_barras_global = '0'; }
if (isset($_POST['cod_estado_modulo_contabilidad_global'])) { $cod_estado_modulo_contabilidad_global = intval($_POST['cod_estado_modulo_contabilidad_global']); } else { $cod_estado_modulo_contabilidad_global = '0'; }
if (isset($_POST['cod_estado_modulo_cotizacion_global'])) { $cod_estado_modulo_cotizacion_global = intval($_POST['cod_estado_modulo_cotizacion_global']); } else { $cod_estado_modulo_cotizacion_global = '0'; }
if (isset($_POST['cod_estado_producto_consumo_global'])) { $cod_estado_producto_consumo_global = intval($_POST['cod_estado_producto_consumo_global']); } else { $cod_estado_producto_consumo_global = '0'; }
if (isset($_POST['cod_estado_compra_caja_global'])) { $cod_estado_compra_caja_global = intval($_POST['cod_estado_compra_caja_global']); } else { $cod_estado_compra_caja_global = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar_global'])) { $cod_estado_cuenta_cobrar_global = intval($_POST['cod_estado_cuenta_cobrar_global']); } else { $cod_estado_cuenta_cobrar_global = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar_global'])) { $cod_estado_cuenta_pagar_global = intval($_POST['cod_estado_cuenta_pagar_global']); } else { $cod_estado_cuenta_pagar_global = '0'; }
if (isset($_POST['cod_estado_egreso_global'])) { $cod_estado_egreso_global = intval($_POST['cod_estado_egreso_global']); } else { $cod_estado_egreso_global = '0'; }
if (isset($_POST['cod_estado_usuario_global'])) { $cod_estado_usuario_global = intval($_POST['cod_estado_usuario_global']); } else { $cod_estado_usuario_global = '0'; }
if (isset($_POST['cod_estado_dependencia_global'])) { $cod_estado_dependencia_global = intval($_POST['cod_estado_dependencia_global']); } else { $cod_estado_dependencia_global = '0'; }
if (isset($_POST['cod_estado_numero_letra_global'])) { $cod_estado_numero_letra_global = intval($_POST['cod_estado_numero_letra_global']); } else { $cod_estado_numero_letra_global = '0'; }
if (isset($_POST['cod_estado_resolucion_factura_global'])) { $cod_estado_resolucion_factura_global = intval($_POST['cod_estado_resolucion_factura_global']); } else { $cod_estado_resolucion_factura_global = '0'; }
if (isset($_POST['cod_estado_cita_global'])) { $cod_estado_cita_global = intval($_POST['cod_estado_cita_global']); } else { $cod_estado_cita_global = '0'; }
if (isset($_POST['cod_estado_factura_compra_global'])) { $cod_estado_factura_compra_global = intval($_POST['cod_estado_factura_compra_global']); } else { $cod_estado_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_modulo_producto_global'])) { $cod_estado_modulo_producto_global = intval($_POST['cod_estado_modulo_producto_global']); } else { $cod_estado_modulo_producto_global = '0'; }
if (isset($_POST['cod_estado_modulo_facturacion_global'])) { $cod_estado_modulo_facturacion_global = intval($_POST['cod_estado_modulo_facturacion_global']); } else { $cod_estado_modulo_facturacion_global = '0'; }
if (isset($_POST['cod_estado_modulo_venta_global'])) { $cod_estado_modulo_venta_global = intval($_POST['cod_estado_modulo_venta_global']); } else { $cod_estado_modulo_venta_global = '0'; }
if (isset($_POST['cod_estado_modulo_tercero_global'])) { $cod_estado_modulo_tercero_global = intval($_POST['cod_estado_modulo_tercero_global']); } else { $cod_estado_modulo_tercero_global = '0'; }
if (isset($_POST['cod_estado_modulo_cuenta_global'])) { $cod_estado_modulo_cuenta_global = intval($_POST['cod_estado_modulo_cuenta_global']); } else { $cod_estado_modulo_cuenta_global = '0'; }
if (isset($_POST['cod_estado_modulo_reporte_global'])) { $cod_estado_modulo_reporte_global = intval($_POST['cod_estado_modulo_reporte_global']); } else { $cod_estado_modulo_reporte_global = '0'; }
if (isset($_POST['cod_estado_modulo_admin_global'])) { $cod_estado_modulo_admin_global = intval($_POST['cod_estado_modulo_admin_global']); } else { $cod_estado_modulo_admin_global = '0'; }
if (isset($_POST['cod_estado_pyg_global'])) { $cod_estado_pyg_global = intval($_POST['cod_estado_pyg_global']); } else { $cod_estado_pyg_global = '0'; }
if (isset($_POST['cod_estado_balance_global'])) { $cod_estado_balance_global = intval($_POST['cod_estado_balance_global']); } else { $cod_estado_balance_global = '0'; }
if (isset($_POST['cod_estado_mov_contable_global'])) { $cod_estado_mov_contable_global = intval($_POST['cod_estado_mov_contable_global']); } else { $cod_estado_mov_contable_global = '0'; }
if (isset($_POST['cod_estado_ganancia_ptj_global'])) { $cod_estado_ganancia_ptj_global = intval($_POST['cod_estado_ganancia_ptj_global']); } else { $cod_estado_ganancia_ptj_global = '0'; }
if (isset($_POST['cod_estado_modulo_orden_produccion_global'])) { $cod_estado_modulo_orden_produccion_global = intval($_POST['cod_estado_modulo_orden_produccion_global']); } else { $cod_estado_modulo_orden_produccion_global = '0'; }
if (isset($_POST['cod_estado_comentario_venta_global'])) { $cod_estado_comentario_venta_global = intval($_POST['cod_estado_comentario_venta_global']); } else { $cod_estado_comentario_venta_global = '0'; }
if (isset($_POST['cod_estado_envio_sms_global'])) { $cod_estado_envio_sms_global = intval($_POST['cod_estado_envio_sms_global']); } else { $cod_estado_envio_sms_global = '0'; }
if (isset($_POST['cod_estado_envio_correo_global'])) { $cod_estado_envio_correo_global = intval($_POST['cod_estado_envio_correo_global']); } else { $cod_estado_envio_correo_global = '0'; }

if (isset($_POST['cod_estado_ordenamiento_alfabetico_venta_global'])) { $cod_estado_ordenamiento_alfabetico_venta_global = intval($_POST['cod_estado_ordenamiento_alfabetico_venta_global']); } else { $cod_estado_ordenamiento_alfabetico_venta_global = '0'; }
if (isset($_POST['cod_estado_nocodif_precio_compra_sticker_global'])) { $cod_estado_nocodif_precio_compra_sticker_global = intval($_POST['cod_estado_nocodif_precio_compra_sticker_global']); } else { $cod_estado_nocodif_precio_compra_sticker_global = '0'; }
if (isset($_POST['cod_estado_nocodif_precio_venta_sticker_global'])) { $cod_estado_nocodif_precio_venta_sticker_global = intval($_POST['cod_estado_nocodif_precio_venta_sticker_global']); } else { $cod_estado_nocodif_precio_venta_sticker_global = '0'; }
if (isset($_POST['cod_estado_nombre_empresa_sticker_global'])) { $cod_estado_nombre_empresa_sticker_global = intval($_POST['cod_estado_nombre_empresa_sticker_global']); } else { $cod_estado_nombre_empresa_sticker_global = '0'; }
if (isset($_POST['cod_estado_fecha_compra_sticker_global'])) { $cod_estado_fecha_compra_sticker_global = intval($_POST['cod_estado_fecha_compra_sticker_global']); } else { $cod_estado_fecha_compra_sticker_global = '0'; }
if (isset($_POST['cod_estado_cod_tercero_sticker_global'])) { $cod_estado_cod_tercero_sticker_global = intval($_POST['cod_estado_cod_tercero_sticker_global']); } else { $cod_estado_cod_tercero_sticker_global = '0'; }
if (isset($_POST['cod_estado_url_pagina_sticker_global'])) { $cod_estado_url_pagina_sticker_global = intval($_POST['cod_estado_url_pagina_sticker_global']); } else { $cod_estado_url_pagina_sticker_global = '0'; }
if (isset($_POST['cod_estado_nombre_desarrollador_sticker_global'])) { $cod_estado_nombre_desarrollador_sticker_global = intval($_POST['cod_estado_nombre_desarrollador_sticker_global']); } else { $cod_estado_nombre_desarrollador_sticker_global = '0'; }
if (isset($_POST['cod_estado_qr_sticker_global'])) { $cod_estado_qr_sticker_global = intval($_POST['cod_estado_qr_sticker_global']); } else { $cod_estado_qr_sticker_global = '0'; }
if (isset($_POST['cod_estado_habilitar_tercero_por_usuario_global'])) { $cod_estado_habilitar_tercero_por_usuario_global = intval($_POST['cod_estado_habilitar_tercero_por_usuario_global']); } else { $cod_estado_habilitar_tercero_por_usuario_global = '0'; }
if (isset($_POST['cod_estado_subproducto_global'])) { $cod_estado_subproducto_global = intval($_POST['cod_estado_subproducto_global']); } else { $cod_estado_subproducto_global = '0'; }
if (isset($_POST['cod_estado_nuevo_inventario_global'])) { $cod_estado_nuevo_inventario_global = intval($_POST['cod_estado_nuevo_inventario_global']); } else { $cod_estado_nuevo_inventario_global = '0'; }
if (isset($_POST['cod_estado_auditoria_global'])) { $cod_estado_auditoria_global = intval($_POST['cod_estado_auditoria_global']); } else { $cod_estado_auditoria_global = '0'; }
if (isset($_POST['cod_estado_cierre_caja_global'])) { $cod_estado_cierre_caja_global = intval($_POST['cod_estado_cierre_caja_global']); } else { $cod_estado_cierre_caja_global = '0'; }

if (isset($_POST['tamano_font_sticker_barra_pdf'])) { $tamano_font_sticker_barra_pdf = intval($_POST['tamano_font_sticker_barra_pdf']); } else { $tamano_font_sticker_barra_pdf = '0'; }
if (isset($_POST['ancho_sticker_barra_pdf'])) { $ancho_sticker_barra_pdf = intval($_POST['ancho_sticker_barra_pdf']); } else { $ancho_sticker_barra_pdf = '0'; }
if (isset($_POST['alto_sticker_barra_pdf'])) { $alto_sticker_barra_pdf = intval($_POST['alto_sticker_barra_pdf']); } else { $alto_sticker_barra_pdf = '0'; }
if (isset($_POST['columnas_sticker_barra_pdf'])) { $columnas_sticker_barra_pdf = intval($_POST['columnas_sticker_barra_pdf']); } else { $columnas_sticker_barra_pdf = '0'; }
if (isset($_POST['nombre_estandar_sticker_barra_pdf'])) { $nombre_estandar_sticker_barra_pdf = addslashes($_POST['nombre_estandar_sticker_barra_pdf']); } else { $nombre_estandar_sticker_barra_pdf = ''; }
if (isset($_POST['tipo_hoja_sticker_barra_pdf'])) { $tipo_hoja_sticker_barra_pdf = addslashes($_POST['tipo_hoja_sticker_barra_pdf']); } else { $tipo_hoja_sticker_barra_pdf = ''; }

if (isset($_POST['cod_estado_fecha_mantenimiento_global'])) { $cod_estado_fecha_mantenimiento_global = intval($_POST['cod_estado_fecha_mantenimiento_global']); } else { $cod_estado_fecha_mantenimiento_global = '0'; }
if (isset($_POST['cod_estado_animal_global'])) { $cod_estado_animal_global = intval($_POST['cod_estado_animal_global']); } else { $cod_estado_animal_global = '0'; }
if (isset($_POST['cod_estado_producto_serial_global'])) { $cod_estado_producto_serial_global = intval($_POST['cod_estado_producto_serial_global']); } else { $cod_estado_producto_serial_global = '0'; }
if (isset($_POST['cod_estado_venta_prod_en_cero_global'])) { $cod_estado_venta_prod_en_cero_global = intval($_POST['cod_estado_venta_prod_en_cero_global']); } else { $cod_estado_venta_prod_en_cero_global = '0'; }
if (isset($_POST['cod_estado_observacion_tercero_venta_global'])) { $cod_estado_observacion_tercero_venta_global = intval($_POST['cod_estado_observacion_tercero_venta_global']); } else { $cod_estado_observacion_tercero_venta_global = '0'; }
if (isset($_POST['cod_estado_alerta_fecha_nac_global'])) { $cod_estado_alerta_fecha_nac_global = intval($_POST['cod_estado_alerta_fecha_nac_global']); } else { $cod_estado_alerta_fecha_nac_global = '0'; }
if (isset($_POST['cod_estado_categoria_global'])) { $cod_estado_categoria_global = intval($_POST['cod_estado_categoria_global']); } else { $cod_estado_categoria_global = '0'; }
if (isset($_POST['cod_estado_peso_producto_global'])) { $cod_estado_peso_producto_global = intval($_POST['cod_estado_peso_producto_global']); } else { $cod_estado_peso_producto_global = '0'; }
if (isset($_POST['cod_estado_estante_producto_global'])) { $cod_estado_estante_producto_global = intval($_POST['cod_estado_estante_producto_global']); } else { $cod_estado_estante_producto_global = '0'; }
if (isset($_POST['cod_estado_devolucion_btn_verde_global'])) { $cod_estado_devolucion_btn_verde_global = intval($_POST['cod_estado_devolucion_btn_verde_global']); } else { $cod_estado_devolucion_btn_verde_global = '0'; }
if (isset($_POST['cod_estado_plan_separe_global'])) { $cod_estado_plan_separe_global = intval($_POST['cod_estado_plan_separe_global']); } else { $cod_estado_plan_separe_global = '0'; }
if (isset($_POST['cod_estado_admin_global'])) { $cod_estado_admin_global = intval($_POST['cod_estado_admin_global']); } else { $cod_estado_admin_global = '0'; }
if (isset($_POST['cod_estado_prodcuto_mantenimiento_global'])) { $cod_estado_prodcuto_mantenimiento_global = intval($_POST['cod_estado_prodcuto_mantenimiento_global']); } else { $cod_estado_prodcuto_mantenimiento_global = '0'; }
if (isset($_POST['cod_estado_eliminar_global'])) { $cod_estado_eliminar_global = intval($_POST['cod_estado_eliminar_global']); } else { $cod_estado_eliminar_global = '0'; }
if (isset($_POST['cod_estado_soporte_factura_compra_global'])) { $cod_estado_soporte_factura_compra_global = intval($_POST['cod_estado_soporte_factura_compra_global']); } else { $cod_estado_soporte_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_observacion_factura_compra_global'])) { $cod_estado_observacion_factura_compra_global = intval($_POST['cod_estado_observacion_factura_compra_global']); } else { $cod_estado_observacion_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_venta_precio_min_venta_global'])) { $cod_estado_venta_precio_min_venta_global = intval($_POST['cod_estado_venta_precio_min_venta_global']); } else { $cod_estado_venta_precio_min_venta_global = '0'; }
if (isset($_POST['cod_estado_hotel_global'])) { $cod_estado_hotel_global = intval($_POST['cod_estado_hotel_global']); } else { $cod_estado_hotel_global = '0'; }
if (isset($_POST['cod_estado_parqueo_global'])) { $cod_estado_parqueo_global = intval($_POST['cod_estado_parqueo_global']); } else { $cod_estado_parqueo_global = '0'; }
if (isset($_POST['cod_estado_plan_accion_correcion_global'])) { $cod_estado_plan_accion_correcion_global = intval($_POST['cod_estado_plan_accion_correcion_global']); } else { $cod_estado_plan_accion_correcion_global = '0'; }
if (isset($_POST['cod_estado_cocina_global'])) { $cod_estado_cocina_global = intval($_POST['cod_estado_cocina_global']); } else { $cod_estado_cocina_global = '0'; }
if (isset($_POST['cod_estado_cajas_sobre_global'])) { $cod_estado_cajas_sobre_global = intval($_POST['cod_estado_cajas_sobre_global']); } else { $cod_estado_cajas_sobre_global = '0'; }
if (isset($_POST['cod_estado_und_sobre_global'])) { $cod_estado_und_sobre_global = intval($_POST['cod_estado_und_sobre_global']); } else { $cod_estado_und_sobre_global = '0'; }
if (isset($_POST['cod_estado_meses_garantia_global'])) { $cod_estado_meses_garantia_global = intval($_POST['cod_estado_meses_garantia_global']); } else { $cod_estado_meses_garantia_global = '0'; }
if (isset($_POST['cod_estado_marca_global'])) { $cod_estado_marca_global = intval($_POST['cod_estado_marca_global']); } else { $cod_estado_marca_global = '0'; }
if (isset($_POST['cod_estado_proveedor_global'])) { $cod_estado_proveedor_global = intval($_POST['cod_estado_proveedor_global']); } else { $cod_estado_proveedor_global = '0'; }
if (isset($_POST['cod_estado_archivo_adjunto_global'])) { $cod_estado_archivo_adjunto_global = intval($_POST['cod_estado_archivo_adjunto_global']); } else { $cod_estado_archivo_adjunto_global = '0'; }
if (isset($_POST['cod_estado_precio_compra_mod_venta_global'])) { $cod_estado_precio_compra_mod_venta_global = intval($_POST['cod_estado_precio_compra_mod_venta_global']); } else { $cod_estado_precio_compra_mod_venta_global = '0'; }
if (isset($_POST['cod_estado_timbre_entrada_pedido_temporal_cocina_global'])) { $cod_estado_timbre_entrada_pedido_temporal_cocina_global = intval($_POST['cod_estado_timbre_entrada_pedido_temporal_cocina_global']); } else { $cod_estado_timbre_entrada_pedido_temporal_cocina_global = '0'; }
if (isset($_POST['cod_estado_timbre_salida_pedido_temporal_cocina_global'])) { $cod_estado_timbre_salida_pedido_temporal_cocina_global = intval($_POST['cod_estado_timbre_salida_pedido_temporal_cocina_global']); } else { $cod_estado_timbre_salida_pedido_temporal_cocina_global = '0'; }
if (isset($_POST['cod_estado_subproducto_mostrar_imprimir_global'])) { $cod_estado_subproducto_mostrar_imprimir_global = intval($_POST['cod_estado_subproducto_mostrar_imprimir_global']); } else { $cod_estado_subproducto_mostrar_imprimir_global = '0'; }
if (isset($_POST['cod_estado_img_producto_global'])) { $cod_estado_img_producto_global = intval($_POST['cod_estado_img_producto_global']); } else { $cod_estado_img_producto_global = '0'; }

if (isset($_POST['cod_estado_diferencia_ganancia_inventario_global'])) { $cod_estado_diferencia_ganancia_inventario_global = intval($_POST['cod_estado_diferencia_ganancia_inventario_global']); } else { $cod_estado_diferencia_ganancia_inventario_global = '0'; }
if (isset($_POST['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'])) { $cod_estado_diferencia_ganancia_inventario_ptj_promedio_global = intval($_POST['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global']); } else { $cod_estado_diferencia_ganancia_inventario_ptj_promedio_global = '0'; }
if (isset($_POST['cod_estado_opcion_descontable_inv_global'])) { $cod_estado_opcion_descontable_inv_global = intval($_POST['cod_estado_opcion_descontable_inv_global']); } else { $cod_estado_opcion_descontable_inv_global = '0'; }
if (isset($_POST['cod_estado_hora_reporte_venta_global'])) { $cod_estado_hora_reporte_venta_global = intval($_POST['cod_estado_hora_reporte_venta_global']); } else { $cod_estado_hora_reporte_venta_global = '0'; }
if (isset($_POST['cod_estado_cantidad_caja_mesa_global'])) { $cod_estado_cantidad_caja_mesa_global = intval($_POST['cod_estado_cantidad_caja_mesa_global']); } else { $cod_estado_cantidad_caja_mesa_global = '0'; }
if (isset($_POST['cod_estado_venta_por_categoria_mod_venta_global'])) { $cod_estado_venta_por_categoria_mod_venta_global = intval($_POST['cod_estado_venta_por_categoria_mod_venta_global']); } else { $cod_estado_venta_por_categoria_mod_venta_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_facturar_mod_venta_global'])) { $cod_estado_habilitar_btn_facturar_mod_venta_global = intval($_POST['cod_estado_habilitar_btn_facturar_mod_venta_global']); } else { $cod_estado_habilitar_btn_facturar_mod_venta_global = '0'; }
if (isset($_POST['cod_estado_btn_imprimir_preventa_cocina_global'])) { $cod_estado_btn_imprimir_preventa_cocina_global = intval($_POST['cod_estado_btn_imprimir_preventa_cocina_global']); } else { $cod_estado_btn_imprimir_preventa_cocina_global = '0'; }
if (isset($_POST['cod_estado_producto_de_cocina_global'])) { $cod_estado_producto_de_cocina_global = intval($_POST['cod_estado_producto_de_cocina_global']); } else { $cod_estado_producto_de_cocina_global = '0'; }
if (isset($_POST['cantidad_caja_mesa'])) { $cantidad_caja_mesa = intval($_POST['cantidad_caja_mesa']); } else { $cantidad_caja_mesa = '1'; }

if (isset($_POST['cod_estado_posicion_gps_pedidos_global'])) { $cod_estado_posicion_gps_pedidos_global = intval($_POST['cod_estado_posicion_gps_pedidos_global']); } else { $cod_estado_posicion_gps_pedidos_global = '0'; }
if (isset($_POST['cod_estado_precio_venta_variable_disponible_admin_global'])) { $cod_estado_precio_venta_variable_disponible_admin_global = intval($_POST['cod_estado_precio_venta_variable_disponible_admin_global']); } else { $cod_estado_precio_venta_variable_disponible_admin_global = '0'; }
if (isset($_POST['cod_estado_check_imp_global'])) { $cod_estado_check_imp_global = intval($_POST['cod_estado_check_imp_global']); } else { $cod_estado_check_imp_global = '0'; }
if (isset($_POST['cod_estado_dividir_factura_caja_mesa_global'])) { $cod_estado_dividir_factura_caja_mesa_global = intval($_POST['cod_estado_dividir_factura_caja_mesa_global']); } else { $cod_estado_dividir_factura_caja_mesa_global = '0'; }
if (isset($_POST['cod_estado_agrupar_por_producto_imp_global'])) { $cod_estado_agrupar_por_producto_imp_global = intval($_POST['cod_estado_agrupar_por_producto_imp_global']); } else { $cod_estado_agrupar_por_producto_imp_global = '0'; }
if (isset($_POST['cod_estado_descuento_concepto_venta_neg_global'])) { $cod_estado_descuento_concepto_venta_neg_global = intval($_POST['cod_estado_descuento_concepto_venta_neg_global']); } else { $cod_estado_descuento_concepto_venta_neg_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_venta_nav_global'])) { $cod_estado_habilitar_btn_imp_venta_nav_global = intval($_POST['cod_estado_habilitar_btn_imp_venta_nav_global']); } else { $cod_estado_habilitar_btn_imp_venta_nav_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_venta_direct_driv_global'])) { $cod_estado_habilitar_btn_imp_venta_direct_driv_global = intval($_POST['cod_estado_habilitar_btn_imp_venta_direct_driv_global']); } else { $cod_estado_habilitar_btn_imp_venta_direct_driv_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_nav_carta_pdf_global'])) { $cod_estado_habilitar_btn_imp_nav_carta_pdf_global = intval($_POST['cod_estado_habilitar_btn_imp_nav_carta_pdf_global']); } else { $cod_estado_habilitar_btn_imp_nav_carta_pdf_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_preventodo_nav_global'])) { $cod_estado_habilitar_btn_imp_preventodo_nav_global = intval($_POST['cod_estado_habilitar_btn_imp_preventodo_nav_global']); } else { $cod_estado_habilitar_btn_imp_preventodo_nav_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_preventodo_direct_driv_global'])) { $cod_estado_habilitar_btn_imp_preventodo_direct_driv_global = intval($_POST['cod_estado_habilitar_btn_imp_preventodo_direct_driv_global']); } else { $cod_estado_habilitar_btn_imp_preventodo_direct_driv_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_cocina_nav_global'])) { $cod_estado_habilitar_btn_imp_cocina_nav_global = intval($_POST['cod_estado_habilitar_btn_imp_cocina_nav_global']); } else { $cod_estado_habilitar_btn_imp_cocina_nav_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_cocina_direct_driv_global'])) { $cod_estado_habilitar_btn_imp_cocina_direct_driv_global = intval($_POST['cod_estado_habilitar_btn_imp_cocina_direct_driv_global']); } else { $cod_estado_habilitar_btn_imp_cocina_direct_driv_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_repventa_consol_nav_global'])) { $cod_estado_habilitar_btn_imp_repventa_consol_nav_global = intval($_POST['cod_estado_habilitar_btn_imp_repventa_consol_nav_global']); } else { $cod_estado_habilitar_btn_imp_repventa_consol_nav_global = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_imp_repventa_direct_driv_global'])) { $cod_estado_habilitar_btn_imp_repventa_direct_driv_global = intval($_POST['cod_estado_habilitar_btn_imp_repventa_direct_driv_global']); } else { $cod_estado_habilitar_btn_imp_repventa_direct_driv_global = '0'; }
if (isset($_POST['cod_estado_modificar_und_venta_una_sola_vez_global'])) { $cod_estado_modificar_und_venta_una_sola_vez_global = intval($_POST['cod_estado_modificar_und_venta_una_sola_vez_global']); } else { $cod_estado_modificar_und_venta_una_sola_vez_global = '0'; }

if (isset($_POST['cod_estado_habilitar_hora_venta_temporal_global'])) { $cod_estado_habilitar_hora_venta_temporal_global = intval($_POST['cod_estado_habilitar_hora_venta_temporal_global']); } else { $cod_estado_habilitar_hora_venta_temporal_global = '0'; }
if (isset($_POST['cod_estado_revisado_venta_temporal_global'])) { $cod_estado_revisado_venta_temporal_global = intval($_POST['cod_estado_revisado_venta_temporal_global']); } else { $cod_estado_revisado_venta_temporal_global = '0'; }
if (isset($_POST['cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global'])) { $cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global = intval($_POST['cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global']); } else { $cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global = '0'; }
if (isset($_POST['cod_estado_prioridad_caja_mesa_global'])) { $cod_estado_prioridad_caja_mesa_global = intval($_POST['cod_estado_prioridad_caja_mesa_global']); } else { $cod_estado_prioridad_caja_mesa_global = '0'; }
if (isset($_POST['cod_estado_transferencia_empresa_extern_global'])) { $cod_estado_transferencia_empresa_extern_global = intval($_POST['cod_estado_transferencia_empresa_extern_global']); } else { $cod_estado_transferencia_empresa_extern_global = '0'; }
if (isset($_POST['cod_estado_descuento_automatico_por_cambio_precio_venta_global'])) { $cod_estado_descuento_automatico_por_cambio_precio_venta_global = addslashes($_POST['cod_estado_descuento_automatico_por_cambio_precio_venta_global']); } else { $cod_estado_descuento_automatico_por_cambio_precio_venta_global = '0'; }
if (isset($_POST['cod_estado_btn_categoria_desplegable_global'])) { $cod_estado_btn_categoria_desplegable_global = addslashes($_POST['cod_estado_btn_categoria_desplegable_global']); } else { $cod_estado_btn_categoria_desplegable_global = '0'; }
if (isset($_POST['tamano_papel_impresora'])) { $tamano_papel_impresora = intval($_POST['tamano_papel_impresora']); } else { $tamano_papel_impresora = '80'; }

if (isset($_POST['nombre_campo_undidades_inv1'])) { $nombre_campo_undidades_inv1 = addslashes($_POST['nombre_campo_undidades_inv1']); } else { $nombre_campo_undidades_inv1 = '0'; }
if (isset($_POST['nombre_campo_undidades_inv2'])) { $nombre_campo_undidades_inv2 = addslashes($_POST['nombre_campo_undidades_inv2']); } else { $nombre_campo_undidades_inv2 = '0'; }
if (isset($_POST['nombre_campo_undidades_inv3'])) { $nombre_campo_undidades_inv3 = addslashes($_POST['nombre_campo_undidades_inv3']); } else { $nombre_campo_undidades_inv3 = '0'; }

if (isset($_POST['cod_estado_consultar_precios_extern_global'])) { $cod_estado_consultar_precios_extern_global = intval($_POST['cod_estado_consultar_precios_extern_global']); } else { $cod_estado_consultar_precios_extern_global = '0'; }
if (isset($_POST['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'])) { $cod_estado_marcado_revisado_caja_mesa_venta_temporal_global = intval($_POST['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global']); } else { $cod_estado_marcado_revisado_caja_mesa_venta_temporal_global = '0'; }
if (isset($_POST['cod_estado_nombre_producto_editable_factura_compra_global'])) { $cod_estado_nombre_producto_editable_factura_compra_global = intval($_POST['cod_estado_nombre_producto_editable_factura_compra_global']); } else { $cod_estado_nombre_producto_editable_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_tipo_compra_global'])) { $cod_estado_tipo_compra_global = intval($_POST['cod_estado_tipo_compra_global']); } else { $cod_estado_tipo_compra_global = '0'; }
if (isset($_POST['cod_estado_nota_observacion_global'])) { $cod_estado_nota_observacion_global = intval($_POST['cod_estado_nota_observacion_global']); } else { $cod_estado_nota_observacion_global = '0'; }
if (isset($_POST['cod_estado_grafico_estadistico_global'])) { $cod_estado_grafico_estadistico_global = intval($_POST['cod_estado_grafico_estadistico_global']); } else { $cod_estado_grafico_estadistico_global = '0'; }
if (isset($_POST['cod_estado_inventario_bodega2_global'])) { $cod_estado_inventario_bodega2_global = intval($_POST['cod_estado_inventario_bodega2_global']); } else { $cod_estado_inventario_bodega2_global = '0'; }
if (isset($_POST['cod_estado_tipo_roles_global'])) { $cod_estado_tipo_roles_global = intval($_POST['cod_estado_tipo_roles_global']); } else { $cod_estado_tipo_roles_global = '0'; }
if (isset($_POST['cod_estado_bascula_balanza_electronica_pesar_producto_global'])) { $cod_estado_bascula_balanza_electronica_pesar_producto_global = addslashes($_POST['cod_estado_bascula_balanza_electronica_pesar_producto_global']); } else { $cod_estado_bascula_balanza_electronica_pesar_producto_global = '0'; }
if (isset($_POST['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'])) { $cod_estado_bascula_balanza_cod_barras_pesar_producto_global = addslashes($_POST['cod_estado_bascula_balanza_cod_barras_pesar_producto_global']); } else { $cod_estado_bascula_balanza_cod_barras_pesar_producto_global = '0'; }
if (isset($_POST['cod_tipo_sistema_numeracion'])) { $cod_tipo_sistema_numeracion = intval($_POST['cod_tipo_sistema_numeracion']); } else { $cod_tipo_sistema_numeracion = ''; }
if (isset($_POST['cod_estado_lote_compra_global'])) { $cod_estado_lote_compra_global = intval($_POST['cod_estado_lote_compra_global']); } else { $cod_estado_lote_compra_global = '0'; }
if (isset($_POST['cod_estado_tipo_metodo_envio_global'])) { $cod_estado_tipo_metodo_envio_global = intval($_POST['cod_estado_tipo_metodo_envio_global']); } else { $cod_estado_tipo_metodo_envio_global = '0'; }
if (isset($_POST['cod_estado_mod_domicilio_y_estado_habilitado_producto_global'])) { $cod_estado_mod_domicilio_y_estado_habilitado_producto_global = addslashes($_POST['cod_estado_mod_domicilio_y_estado_habilitado_producto_global']); } else { $cod_estado_mod_domicilio_y_estado_habilitado_producto_global = '0'; }
if (isset($_POST['cod_estado_promocion_global'])) { $cod_estado_promocion_global = intval($_POST['cod_estado_promocion_global']); } else { $cod_estado_promocion_global = '0'; }
if (isset($_POST['cod_estado_notificacion_alerta_correo_global'])) { $cod_estado_notificacion_alerta_correo_global = intval($_POST['cod_estado_notificacion_alerta_correo_global']); } else { $cod_estado_notificacion_alerta_correo_global = '0'; }
if (isset($_POST['cod_estado_notificacion_alerta_correo_copia_seguridad_global'])) { $cod_estado_notificacion_alerta_correo_copia_seguridad_global = addslashes($_POST['cod_estado_notificacion_alerta_correo_copia_seguridad_global']); } else { $cod_estado_notificacion_alerta_correo_copia_seguridad_global = '0'; }
if (isset($_POST['cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global'])) { $cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global = addslashes($_POST['cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global']); } else { $cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global = '0'; }
if (isset($_POST['cod_estado_notificacion_alerta_correo_productos_a_vencer_global'])) { $cod_estado_notificacion_alerta_correo_productos_a_vencer_global = addslashes($_POST['cod_estado_notificacion_alerta_correo_productos_a_vencer_global']); } else { $cod_estado_notificacion_alerta_correo_productos_a_vencer_global = '0'; }
if (isset($_POST['cod_estado_notificacion_alerta_correo_productos_agotados_global'])) { $cod_estado_notificacion_alerta_correo_productos_agotados_global = addslashes($_POST['cod_estado_notificacion_alerta_correo_productos_agotados_global']); } else { $cod_estado_notificacion_alerta_correo_productos_agotados_global = '0'; }
if (isset($_POST['cod_estado_notificacion_alerta_correo_venta_diaria_global'])) { $cod_estado_notificacion_alerta_correo_venta_diaria_global = addslashes($_POST['cod_estado_notificacion_alerta_correo_venta_diaria_global']); } else { $cod_estado_notificacion_alerta_correo_venta_diaria_global = '0'; }

if (isset($_POST['cod_tipo_sistema_numeracion_und_compra'])) { $cod_tipo_sistema_numeracion_und_compra = intval($_POST['cod_tipo_sistema_numeracion_und_compra']); } else { $cod_tipo_sistema_numeracion_und_compra = '0'; }
if (isset($_POST['cod_tipo_sistema_numeracion_und_venta'])) { $cod_tipo_sistema_numeracion_und_venta = intval($_POST['cod_tipo_sistema_numeracion_und_venta']); } else { $cod_tipo_sistema_numeracion_und_venta = '0'; }
if (isset($_POST['cod_tipo_sistema_numeracion_precio_compra'])) { $cod_tipo_sistema_numeracion_precio_compra = intval($_POST['cod_tipo_sistema_numeracion_precio_compra']); } else { $cod_tipo_sistema_numeracion_precio_compra = '0'; }
if (isset($_POST['cod_tipo_sistema_numeracion_precio_venta'])) { $cod_tipo_sistema_numeracion_precio_venta = intval($_POST['cod_tipo_sistema_numeracion_precio_venta']); } else { $cod_tipo_sistema_numeracion_precio_venta = '0'; }
if (isset($_POST['nombre_tipo_campo_componente_html_und_venta'])) { $nombre_tipo_campo_componente_html_und_venta = addslashes($_POST['nombre_tipo_campo_componente_html_und_venta']); } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if (isset($_POST['nombre_tipo_campo_componente_html_und_compra'])) { $nombre_tipo_campo_componente_html_und_compra = addslashes($_POST['nombre_tipo_campo_componente_html_und_compra']); } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if (isset($_POST['nombre_tipo_campo_componente_html_precio_compra'])) { $nombre_tipo_campo_componente_html_precio_compra = addslashes($_POST['nombre_tipo_campo_componente_html_precio_compra']); } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if (isset($_POST['nombre_tipo_campo_componente_html_precio_venta'])) { $nombre_tipo_campo_componente_html_precio_venta = addslashes($_POST['nombre_tipo_campo_componente_html_precio_venta']); } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }
if (isset($_POST['cod_estado_venta_dependencia_de_usuario_global'])) { $cod_estado_venta_dependencia_de_usuario_global = intval($_POST['cod_estado_venta_dependencia_de_usuario_global']); } else { $cod_estado_venta_dependencia_de_usuario_global = '0'; }
if (isset($_POST['cod_estado_posicion_mapa_gps_pedidos_info_venta_global'])) { $cod_estado_posicion_mapa_gps_pedidos_info_venta_global = intval($_POST['cod_estado_posicion_mapa_gps_pedidos_info_venta_global']); } else { $cod_estado_posicion_mapa_gps_pedidos_info_venta_global = '0'; }

if (isset($_POST['cod_estado_origen_factura_compra_global'])) { $cod_estado_origen_factura_compra_global = intval($_POST['cod_estado_origen_factura_compra_global']); } else { $cod_estado_origen_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_existe_producto_factura_compra_global'])) { $cod_estado_existe_producto_factura_compra_global = intval($_POST['cod_estado_existe_producto_factura_compra_global']); } else { $cod_estado_existe_producto_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_chk_factura_compra_global'])) { $cod_estado_chk_factura_compra_global = intval($_POST['cod_estado_chk_factura_compra_global']); } else { $cod_estado_chk_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_check_caja_factura_compra_global'])) { $cod_estado_check_caja_factura_compra_global = intval($_POST['cod_estado_check_caja_factura_compra_global']); } else { $cod_estado_check_caja_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_check_und_factura_compra_global'])) { $cod_estado_check_und_factura_compra_global = intval($_POST['cod_estado_check_und_factura_compra_global']); } else { $cod_estado_check_und_factura_compra_global = '0'; }

if (isset($_POST['cod_estado_peso_global'])) { $cod_estado_peso_global = intval($_POST['cod_estado_peso_global']); } else { $cod_estado_peso_global = ''; }
if (isset($_POST['cod_estado_cargar_archivo_plano_interno_factura_compra_global'])) { $cod_estado_cargar_archivo_plano_interno_factura_compra_global = intval($_POST['cod_estado_cargar_archivo_plano_interno_factura_compra_global']); } else { $cod_estado_cargar_archivo_plano_interno_factura_compra_global = '0'; }
if (isset($_POST['cod_estado_cargar_archivo_plano_externo_factura_compra_global'])) { $cod_estado_cargar_archivo_plano_externo_factura_compra_global = intval($_POST['cod_estado_cargar_archivo_plano_externo_factura_compra_global']); } else { $cod_estado_cargar_archivo_plano_externo_factura_compra_global = '0'; }

if (isset($_POST['cod_estado_cuenta_cobrar_abono_glob_global'])) { $cod_estado_cuenta_cobrar_abono_glob_global = intval($_POST['cod_estado_cuenta_cobrar_abono_glob_global']); } else { $cod_estado_cuenta_cobrar_abono_glob_global = '0'; }
if (isset($_POST['cod_estado_reporte_compra_por_producto_global'])) { $cod_estado_reporte_compra_por_producto_global = intval($_POST['cod_estado_reporte_compra_por_producto_global']); } else { $cod_estado_reporte_compra_por_producto_global = '0'; }

if (isset($_POST['cod_estado_servicio_cava_global'])) { $cod_estado_servicio_cava_global = intval($_POST['cod_estado_servicio_cava_global']); } else { $cod_estado_servicio_cava_global = '0'; }
if (isset($_POST['cod_estado_escoger_precio_venta_automatico_global'])) { $cod_estado_escoger_precio_venta_automatico_global = intval($_POST['cod_estado_escoger_precio_venta_automatico_global']); } else { $cod_estado_escoger_precio_venta_automatico_global = '0'; }

if (isset($_POST['cod_estado_origen_produccion_global'])) { $cod_estado_origen_produccion_global = intval($_POST['cod_estado_origen_produccion_global']); } else { $cod_estado_origen_produccion_global = '0'; }

if (isset($_POST['cod_estado_imprimir_reporte_venta_con_productos_global'])) { $cod_estado_imprimir_reporte_venta_con_productos_global = intval($_POST['cod_estado_imprimir_reporte_venta_con_productos_global']); } else { $cod_estado_imprimir_reporte_venta_con_productos_global = '0'; }
if (isset($_POST['cod_estado_factura_compra_cargue_inmediato_global'])) { $cod_estado_factura_compra_cargue_inmediato_global = intval($_POST['cod_estado_factura_compra_cargue_inmediato_global']); } else { $cod_estado_factura_compra_cargue_inmediato_global = '0'; }
if (isset($_POST['cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global'])) { $cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global = intval($_POST['cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global']); } else { $cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global = '0'; }
if (isset($_POST['cod_estado_actualizar_base_datos_arch_plano_global'])) { $cod_estado_actualizar_base_datos_arch_plano_global = intval($_POST['cod_estado_actualizar_base_datos_arch_plano_global']); } else { $cod_estado_actualizar_base_datos_arch_plano_global = '0'; }
if (isset($_POST['cod_estado_actualizar_base_datos_arch_plano_producto_global'])) { $cod_estado_actualizar_base_datos_arch_plano_producto_global = intval($_POST['cod_estado_actualizar_base_datos_arch_plano_producto_global']); } else { $cod_estado_actualizar_base_datos_arch_plano_producto_global = '0'; }
if (isset($_POST['cod_estado_actualizar_base_datos_arch_plano_venta_global'])) { $cod_estado_actualizar_base_datos_arch_plano_venta_global = intval($_POST['cod_estado_actualizar_base_datos_arch_plano_venta_global']); } else { $cod_estado_actualizar_base_datos_arch_plano_venta_global = '0'; }
if (isset($_POST['cod_estado_actualizar_base_datos_arch_plano_info_venta_global'])) { $cod_estado_actualizar_base_datos_arch_plano_info_venta_global = intval($_POST['cod_estado_actualizar_base_datos_arch_plano_info_venta_global']); } else { $cod_estado_actualizar_base_datos_arch_plano_info_venta_global = '0'; }
if (isset($_POST['cod_estado_actualizar_base_datos_arch_plano_compra_global'])) { $cod_estado_actualizar_base_datos_arch_plano_compra_global = intval($_POST['cod_estado_actualizar_base_datos_arch_plano_compra_global']); } else { $cod_estado_actualizar_base_datos_arch_plano_compra_global = '0'; }
if (isset($_POST['cod_estado_actualizar_base_datos_arch_plano_info_compra_global'])) { $cod_estado_actualizar_base_datos_arch_plano_info_compra_global = intval($_POST['cod_estado_actualizar_base_datos_arch_plano_info_compra_global']); } else { $cod_estado_actualizar_base_datos_arch_plano_info_compra_global = '0'; }
if (isset($_POST['cod_estado_actualizar_und_producto_inventario_global'])) { $cod_estado_actualizar_und_producto_inventario_global = intval($_POST['cod_estado_actualizar_und_producto_inventario_global']); } else { $cod_estado_actualizar_und_producto_inventario_global = '0'; }
if (isset($_POST['cod_estado_tipo_venta_zapateria_global'])) { $cod_estado_tipo_venta_zapateria_global = intval($_POST['cod_estado_tipo_venta_zapateria_global']); } else { $cod_estado_tipo_venta_zapateria_global = '0'; }
if (isset($_POST['cod_estado_opcion_escribir_nombre_cliente_venta_global'])) { $cod_estado_opcion_escribir_nombre_cliente_venta_global = intval($_POST['cod_estado_opcion_escribir_nombre_cliente_venta_global']); } else { $cod_estado_opcion_escribir_nombre_cliente_venta_global = '0'; }
if (isset($_POST['cod_estado_btn_imprimir_venta_nav_zapateria_global'])) { $cod_estado_btn_imprimir_venta_nav_zapateria_global = intval($_POST['cod_estado_btn_imprimir_venta_nav_zapateria_global']); } else { $cod_estado_btn_imprimir_venta_nav_zapateria_global = '0'; }
if (isset($_POST['cod_estado_btn_imprimir_venta_direct_driv_zapateria_global'])) { $cod_estado_btn_imprimir_venta_direct_driv_zapateria_global = intval($_POST['cod_estado_btn_imprimir_venta_direct_driv_zapateria_global']); } else { $cod_estado_btn_imprimir_venta_direct_driv_zapateria_global = '0'; }
if (isset($_POST['cod_estado_fecha_entrega_venta_global'])) { $cod_estado_fecha_entrega_venta_global = intval($_POST['cod_estado_fecha_entrega_venta_global']); } else { $cod_estado_fecha_entrega_venta_global = '0'; }
if (isset($_POST['cod_estado_hora_entrega_venta_global'])) { $cod_estado_hora_entrega_venta_global = intval($_POST['cod_estado_hora_entrega_venta_global']); } else { $cod_estado_hora_entrega_venta_global = '0'; }
if (isset($_POST['cod_estado_productos_poco_movimiento_global'])) { $cod_estado_productos_poco_movimiento_global = intval($_POST['cod_estado_productos_poco_movimiento_global']); } else { $cod_estado_productos_poco_movimiento_global = '0'; }
if (isset($_POST['cod_estado_nuevo_inventario_por_letra_global'])) { $cod_estado_nuevo_inventario_por_letra_global = intval($_POST['cod_estado_nuevo_inventario_por_letra_global']); } else { $cod_estado_nuevo_inventario_por_letra_global = '0'; }
if (isset($_POST['cod_estado_filtro_aplicacion_chef_bartender_global'])) { $cod_estado_filtro_aplicacion_chef_bartender_global = intval($_POST['cod_estado_filtro_aplicacion_chef_bartender_global']); } else { $cod_estado_filtro_aplicacion_chef_bartender_global = '0'; }

if (isset($_POST['cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global'])) { $cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global = intval($_POST['cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global']); } else { $cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global = '0'; }
if (isset($_POST['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global'])) { $cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global = intval($_POST['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global']); } else { $cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global = '0'; }
if (isset($_POST['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global'])) { $cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global = intval($_POST['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global']); } else { $cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global = '0'; }
if (isset($_POST['cod_estado_reporte_mantenimiento_global'])) { $cod_estado_reporte_mantenimiento_global = intval($_POST['cod_estado_reporte_mantenimiento_global']); } else { $cod_estado_reporte_mantenimiento_global = '0'; }

if (isset($_POST['cod_estado_abrir_cajon_monedero_driv_direct_global'])) { $cod_estado_abrir_cajon_monedero_driv_direct_global = intval($_POST['cod_estado_abrir_cajon_monedero_driv_direct_global']); } else { $cod_estado_abrir_cajon_monedero_driv_direct_global = '0'; }
if (isset($_POST['cod_estado_subreporte_venta_diaria_global'])) { $cod_estado_subreporte_venta_diaria_global = intval($_POST['cod_estado_subreporte_venta_diaria_global']); } else { $cod_estado_subreporte_venta_diaria_global = '0'; }
if (isset($_POST['cod_estado_subreporte_venta_mensual_global'])) { $cod_estado_subreporte_venta_mensual_global = intval($_POST['cod_estado_subreporte_venta_mensual_global']); } else { $cod_estado_subreporte_venta_mensual_global = '0'; }
if (isset($_POST['cod_estado_subreporte_venta_anual_global'])) { $cod_estado_subreporte_venta_anual_global = intval($_POST['cod_estado_subreporte_venta_anual_global']); } else { $cod_estado_subreporte_venta_anual_global = '0'; }
if (isset($_POST['cod_estado_subreporte_totalventa_global'])) { $cod_estado_subreporte_totalventa_global = intval($_POST['cod_estado_subreporte_totalventa_global']); } else { $cod_estado_subreporte_totalventa_global = '0'; }
if (isset($_POST['cod_estado_subreporte_impuestos_global'])) { $cod_estado_subreporte_impuestos_global = intval($_POST['cod_estado_subreporte_impuestos_global']); } else { $cod_estado_subreporte_impuestos_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasgenerales_global'])) { $cod_estado_subreporte_ventasgenerales_global = intval($_POST['cod_estado_subreporte_ventasgenerales_global']); } else { $cod_estado_subreporte_ventasgenerales_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporfacturas_global'])) { $cod_estado_subreporte_ventasporfacturas_global = intval($_POST['cod_estado_subreporte_ventasporfacturas_global']); } else { $cod_estado_subreporte_ventasporfacturas_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasportipofacturas_global'])) { $cod_estado_subreporte_ventasportipofacturas_global = intval($_POST['cod_estado_subreporte_ventasportipofacturas_global']); } else { $cod_estado_subreporte_ventasportipofacturas_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventaspordependencia_global'])) { $cod_estado_subreporte_ventaspordependencia_global = intval($_POST['cod_estado_subreporte_ventaspordependencia_global']); } else { $cod_estado_subreporte_ventaspordependencia_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasportipoproducto_global'])) { $cod_estado_subreporte_ventasportipoproducto_global = intval($_POST['cod_estado_subreporte_ventasportipoproducto_global']); } else { $cod_estado_subreporte_ventasportipoproducto_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporvendedor_global'])) { $cod_estado_subreporte_ventasporvendedor_global = intval($_POST['cod_estado_subreporte_ventasporvendedor_global']); } else { $cod_estado_subreporte_ventasporvendedor_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporpropinavendedor_global'])) { $cod_estado_subreporte_ventasporpropinavendedor_global = intval($_POST['cod_estado_subreporte_ventasporpropinavendedor_global']); } else { $cod_estado_subreporte_ventasporpropinavendedor_global = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporcreditocliente_global'])) { $cod_estado_subreporte_ventasporcreditocliente_global = intval($_POST['cod_estado_subreporte_ventasporcreditocliente_global']); } else { $cod_estado_subreporte_ventasporcreditocliente_global = '0'; }
if (isset($_POST['cod_estado_dependencia_sub_global'])) { $cod_estado_dependencia_sub_global = intval($_POST['cod_estado_dependencia_sub_global']); } else { $cod_estado_dependencia_sub_global = '0'; }
if (isset($_POST['cod_estado_factura_compra_producto_global'])) { $cod_estado_factura_compra_producto_global = intval($_POST['cod_estado_factura_compra_producto_global']); } else { $cod_estado_factura_compra_producto_global = '0'; }
if (isset($_POST['cod_estado_aceite_oleina_global'])) { $cod_estado_aceite_oleina_global = intval($_POST['cod_estado_aceite_oleina_global']); } else { $cod_estado_aceite_oleina_global = '0'; }
if (isset($_POST['cod_estado_valor_flete_aceite_oleina_global'])) { $cod_estado_valor_flete_aceite_oleina_global = intval($_POST['cod_estado_valor_flete_aceite_oleina_global']); } else { $cod_estado_valor_flete_aceite_oleina_global = '0'; }
if (isset($_POST['cod_estado_caja_fraccion_global'])) { $cod_estado_caja_fraccion_global = intval($_POST['cod_estado_caja_fraccion_global']); } else { $cod_estado_caja_fraccion_global = '0'; }

if (isset($_POST['ptj_interes_inmobiliaria'])) { $ptj_interes_inmobiliaria = intval($_POST['ptj_interes_inmobiliaria']); } else { $ptj_interes_inmobiliaria = '0'; }
if (isset($_POST['ptj_comision_inmobiliaria'])) { $ptj_comision_inmobiliaria = intval($_POST['ptj_comision_inmobiliaria']); } else { $ptj_comision_inmobiliaria = '0'; }
if (isset($_POST['limite_venta_pos_factura_electronica'])) { $limite_venta_pos_factura_electronica = addslashes($_POST['limite_venta_pos_factura_electronica']); } else { $limite_venta_pos_factura_electronica = '0'; }
if (isset($_POST['cod_estado_limite_venta_pos_factura_electronica_global'])) { $cod_estado_limite_venta_pos_factura_electronica_global = intval($_POST['cod_estado_limite_venta_pos_factura_electronica_global']); } else { $cod_estado_limite_venta_pos_factura_electronica_global = '0'; }


$sql_data = sprintf("UPDATE tbl15_info_empresa SET titulo = '$titulo', nombre = '$nombre', eslogan = '$eslogan', res = '$res', res1 = '$res1', 
res2 = '$res2', fecha_res = '$fecha_res', pais = '$pais', departamento = '$departamento', ciudad = '$ciudad', localidad = '$localidad', direccion = '$direccion', 
correo = '$correo', cabecera = '$cabecera', img_cabecera = '$img_cabecera', telefono = '$telefono', nit_empresa = '$nit_empresa', 
logotipo = '$logotipo', icono = '$icono', nombre_font = '$nombre_font', tamano_font_hc = '$tamano_font_hc', tamano_font_aptlab = '$tamano_font_aptlab', 
tamano_font_trabaltu = '$tamano_font_trabaltu', tamano_font_manaliment = '$tamano_font_manaliment', tamano_font_informe = '$tamano_font_informe', 
tamano_font_remision = '$tamano_font_remision', tamano_font_factura = '$tamano_font_factura', 
propietario_nombres_apellidos = '$propietario_nombres_apellidos', propietario_nit = '$propietario_nit', 
info_legal = '$info_legal', reg_medico = '$reg_medico', licencia = '$licencia', 
regimen = '$regimen', smtp_correo_host = '$smtp_correo_host', smtp_correo_auth = '$smtp_correo_auth', smtp_correo_username = '$smtp_correo_username', 
smtp_correo_password = '$smtp_correo_password', smtp_correo_secure = '$smtp_correo_secure', smtp_correo_port = '$smtp_correo_port', 
info_aptlaboral = '$info_aptlaboral', dia_ini_facturacion = '$dia_ini_facturacion', dia_fin_facturacion = '$dia_fin_facturacion', 
numero_precio = '$numero_precio', nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', nombre_concepto_multi_virtual = '$nombre_concepto_multi_virtual', 
ptj_servicio_propina = '$ptj_servicio_propina', cod_servicio_propina = '$cod_servicio_propina', nombre_servicio_propina = '$nombre_servicio_propina', 
precio_servicio_propina = '$precio_servicio_propina', ptj_bolsa = '$ptj_bolsa', cod_bolsa = '$cod_bolsa', 
nombre_bolsa = '$nombre_bolsa', precio_bolsa = '$precio_bolsa', nombre_tipo_empresa = '$nombre_tipo_empresa', 
dias_vencimiento_producto_alerta = '$dias_vencimiento_producto_alerta', cod_estado_fecha_vencimiento_global = '$cod_estado_fecha_vencimiento_global', 
cod_estado_ptj_comision_global = '$cod_estado_ptj_comision_global', cod_estado_impoconsumo_global = '$cod_estado_impoconsumo_global', cod_estado_dto1_global = '$cod_estado_dto1_global', 
cod_estado_dto2_global = '$cod_estado_dto2_global', cod_estado_preventa_global = '$cod_estado_preventa_global', cod_estado_propina_global = '$cod_estado_propina_global', 
cod_estado_img_impimir_factura_global = '$cod_estado_img_impimir_factura_global', url_encuesta_experiencia_compra = '$url_encuesta_experiencia_compra',
cod_estado_encuesta_experiencia_compra_global = '$cod_estado_encuesta_experiencia_compra_global', cod_estado_codif_precio_compra_global = '$cod_estado_codif_precio_compra_global', 
cod_estado_codif_precio_venta_global = '$cod_estado_codif_precio_venta_global', cod_estado_inventario_bodega_global = '$cod_estado_inventario_bodega_global', 
cod_estado_sticker_barras_global = '$cod_estado_sticker_barras_global', cod_estado_modulo_contabilidad_global = '$cod_estado_modulo_contabilidad_global', 
cod_estado_modulo_cotizacion_global = '$cod_estado_modulo_cotizacion_global', nombre_operador_factura_electronica = '$nombre_operador_factura_electronica',
cod_estado_producto_consumo_global = '$cod_estado_producto_consumo_global', cod_estado_compra_caja_global = '$cod_estado_compra_caja_global', 
nombre_tipo_impresora_zebra_ticket = '$nombre_tipo_impresora_zebra_ticket', cod_estado_cuenta_cobrar_global = '$cod_estado_cuenta_cobrar_global', 
cod_estado_cuenta_pagar_global = '$cod_estado_cuenta_pagar_global', cod_estado_egreso_global = '$cod_estado_egreso_global', cod_estado_usuario_global = '$cod_estado_usuario_global', 
cod_estado_dependencia_global = '$cod_estado_dependencia_global', cod_estado_numero_letra_global = '$cod_estado_numero_letra_global', 
cod_estado_resolucion_factura_global = '$cod_estado_resolucion_factura_global', cod_estado_cita_global = '$cod_estado_cita_global', cod_estado_factura_compra_global = '$cod_estado_factura_compra_global', 
cod_estado_modulo_producto_global = '$cod_estado_modulo_producto_global', cod_estado_modulo_facturacion_global = '$cod_estado_modulo_facturacion_global', cod_estado_modulo_venta_global = '$cod_estado_modulo_venta_global', 
cod_estado_modulo_tercero_global = '$cod_estado_modulo_tercero_global', cod_estado_modulo_cuenta_global = '$cod_estado_modulo_cuenta_global',
cod_estado_modulo_reporte_global = '$cod_estado_modulo_reporte_global', cod_estado_modulo_admin_global = '$cod_estado_modulo_admin_global',
cod_estado_pyg_global = '$cod_estado_pyg_global', cod_estado_balance_global = '$cod_estado_balance_global', cod_estado_mov_contable_global = '$cod_estado_mov_contable_global', 
cod_estado_ganancia_ptj_global = '$cod_estado_ganancia_ptj_global', cod_estado_modulo_orden_produccion_global = '$cod_estado_modulo_orden_produccion_global', 
cod_estado_comentario_venta_global = '$cod_estado_comentario_venta_global', cod_estado_envio_sms_global = '$cod_estado_envio_sms_global', cod_estado_envio_correo_global = '$cod_estado_envio_correo_global', 
cod_estado_ordenamiento_alfabetico_venta_global = '$cod_estado_ordenamiento_alfabetico_venta_global', cod_estado_nocodif_precio_compra_sticker_global = '$cod_estado_nocodif_precio_compra_sticker_global', 
cod_estado_nocodif_precio_venta_sticker_global = '$cod_estado_nocodif_precio_venta_sticker_global', cod_estado_nombre_empresa_sticker_global = '$cod_estado_nombre_empresa_sticker_global', 
cod_estado_fecha_compra_sticker_global = '$cod_estado_fecha_compra_sticker_global', cod_estado_cod_tercero_sticker_global = '$cod_estado_cod_tercero_sticker_global', 
cod_estado_url_pagina_sticker_global = '$cod_estado_url_pagina_sticker_global', cod_estado_nombre_desarrollador_sticker_global = '$cod_estado_nombre_desarrollador_sticker_global', 
cod_estado_qr_sticker_global = '$cod_estado_qr_sticker_global', nombre_empresa_sticker = '$nombre_empresa_sticker', nombre_buscar_por = '$nombre_buscar_por', 
cod_estado_habilitar_tercero_por_usuario_global = '$cod_estado_habilitar_tercero_por_usuario_global', cod_estado_subproducto_global = '$cod_estado_subproducto_global', 
cod_estado_nuevo_inventario_global = '$cod_estado_nuevo_inventario_global', cod_estado_auditoria_global = '$cod_estado_auditoria_global', cod_estado_cierre_caja_global = '$cod_estado_cierre_caja_global', 
tamano_font_sticker_barra_pdf = '$tamano_font_sticker_barra_pdf', ancho_sticker_barra_pdf = '$ancho_sticker_barra_pdf', alto_sticker_barra_pdf = '$alto_sticker_barra_pdf', 
columnas_sticker_barra_pdf = '$columnas_sticker_barra_pdf', nombre_estandar_sticker_barra_pdf = '$nombre_estandar_sticker_barra_pdf', tipo_hoja_sticker_barra_pdf = '$tipo_hoja_sticker_barra_pdf', 
cod_estado_fecha_mantenimiento_global = '$cod_estado_fecha_mantenimiento_global', cod_estado_animal_global = '$cod_estado_animal_global',
cod_estado_producto_serial_global = '$cod_estado_producto_serial_global', cod_estado_venta_prod_en_cero_global = '$cod_estado_venta_prod_en_cero_global',
cod_estado_observacion_tercero_venta_global = '$cod_estado_observacion_tercero_venta_global', cod_estado_alerta_fecha_nac_global = '$cod_estado_alerta_fecha_nac_global',
cod_estado_categoria_global = '$cod_estado_categoria_global', cod_estado_peso_producto_global = '$cod_estado_peso_producto_global',
cod_estado_estante_producto_global = '$cod_estado_estante_producto_global', cod_estado_devolucion_btn_verde_global = '$cod_estado_devolucion_btn_verde_global',
cod_estado_plan_separe_global = '$cod_estado_plan_separe_global', cod_estado_admin_global = '$cod_estado_admin_global',
cod_estado_prodcuto_mantenimiento_global = '$cod_estado_prodcuto_mantenimiento_global', cod_estado_eliminar_global = '$cod_estado_eliminar_global',
cod_estado_soporte_factura_compra_global = '$cod_estado_soporte_factura_compra_global', cod_estado_observacion_factura_compra_global = '$cod_estado_observacion_factura_compra_global',
cod_estado_venta_precio_min_venta_global = '$cod_estado_venta_precio_min_venta_global', cod_estado_hotel_global = '$cod_estado_hotel_global',
cod_estado_parqueo_global = '$cod_estado_parqueo_global', cod_estado_plan_accion_correcion_global = '$cod_estado_plan_accion_correcion_global',
cod_estado_cocina_global = '$cod_estado_cocina_global', cod_estado_cajas_sobre_global = '$cod_estado_cajas_sobre_global',
cod_estado_und_sobre_global = '$cod_estado_und_sobre_global', cod_estado_meses_garantia_global = '$cod_estado_meses_garantia_global',
cod_estado_marca_global = '$cod_estado_marca_global', cod_estado_proveedor_global = '$cod_estado_proveedor_global',
cod_estado_archivo_adjunto_global = '$cod_estado_archivo_adjunto_global', cod_estado_precio_compra_mod_venta_global = '$cod_estado_precio_compra_mod_venta_global',
cod_estado_timbre_entrada_pedido_temporal_cocina_global = '$cod_estado_timbre_entrada_pedido_temporal_cocina_global',
cod_estado_timbre_salida_pedido_temporal_cocina_global = '$cod_estado_timbre_salida_pedido_temporal_cocina_global',
cod_estado_subproducto_mostrar_imprimir_global = '$cod_estado_subproducto_mostrar_imprimir_global',
cod_estado_img_producto_global = '$cod_estado_img_producto_global', 
cod_estado_diferencia_ganancia_inventario_global = '$cod_estado_diferencia_ganancia_inventario_global', 
cod_estado_diferencia_ganancia_inventario_ptj_promedio_global = '$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global', 
cod_estado_opcion_descontable_inv_global = '$cod_estado_opcion_descontable_inv_global', 
cod_estado_hora_reporte_venta_global = '$cod_estado_hora_reporte_venta_global', 
cod_estado_cantidad_caja_mesa_global = '$cod_estado_cantidad_caja_mesa_global', 
cod_estado_venta_por_categoria_mod_venta_global = '$cod_estado_venta_por_categoria_mod_venta_global', 
cod_estado_habilitar_btn_facturar_mod_venta_global = '$cod_estado_habilitar_btn_facturar_mod_venta_global', 
cod_estado_btn_imprimir_preventa_cocina_global = '$cod_estado_btn_imprimir_preventa_cocina_global', 
cod_estado_producto_de_cocina_global = '$cod_estado_producto_de_cocina_global', cantidad_caja_mesa = '$cantidad_caja_mesa', 
cod_estado_posicion_gps_pedidos_global = '$cod_estado_posicion_gps_pedidos_global', 
cod_estado_precio_venta_variable_disponible_admin_global = '$cod_estado_precio_venta_variable_disponible_admin_global', 
cod_estado_check_imp_global = '$cod_estado_check_imp_global', 
cod_estado_dividir_factura_caja_mesa_global = '$cod_estado_dividir_factura_caja_mesa_global', 
cod_estado_agrupar_por_producto_imp_global = '$cod_estado_agrupar_por_producto_imp_global', 
cod_estado_descuento_concepto_venta_neg_global = '$cod_estado_descuento_concepto_venta_neg_global', 
cod_estado_habilitar_btn_imp_venta_nav_global = '$cod_estado_habilitar_btn_imp_venta_nav_global', 
cod_estado_habilitar_btn_imp_venta_direct_driv_global = '$cod_estado_habilitar_btn_imp_venta_direct_driv_global', 
cod_estado_habilitar_btn_imp_nav_carta_pdf_global = '$cod_estado_habilitar_btn_imp_nav_carta_pdf_global', 
cod_estado_habilitar_btn_imp_preventodo_nav_global = '$cod_estado_habilitar_btn_imp_preventodo_nav_global', 
cod_estado_habilitar_btn_imp_preventodo_direct_driv_global = '$cod_estado_habilitar_btn_imp_preventodo_direct_driv_global', 
cod_estado_habilitar_btn_imp_cocina_nav_global = '$cod_estado_habilitar_btn_imp_cocina_nav_global', 
cod_estado_habilitar_btn_imp_cocina_direct_driv_global = '$cod_estado_habilitar_btn_imp_cocina_direct_driv_global', 
cod_estado_habilitar_btn_imp_repventa_consol_nav_global = '$cod_estado_habilitar_btn_imp_repventa_consol_nav_global', 
cod_estado_habilitar_btn_imp_repventa_direct_driv_global = '$cod_estado_habilitar_btn_imp_repventa_direct_driv_global', 
cod_estado_modificar_und_venta_una_sola_vez_global = '$cod_estado_modificar_und_venta_una_sola_vez_global', 
cod_estado_habilitar_hora_venta_temporal_global = '$cod_estado_habilitar_hora_venta_temporal_global', 
cod_estado_revisado_venta_temporal_global = '$cod_estado_revisado_venta_temporal_global', 
cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global = '$cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global', 
cod_estado_prioridad_caja_mesa_global = '$cod_estado_prioridad_caja_mesa_global', 
cod_estado_transferencia_empresa_extern_global = '$cod_estado_transferencia_empresa_extern_global', 
cod_estado_descuento_automatico_por_cambio_precio_venta_global = '$cod_estado_descuento_automatico_por_cambio_precio_venta_global', 
cod_estado_btn_categoria_desplegable_global = '$cod_estado_btn_categoria_desplegable_global', tamano_papel_impresora = '$tamano_papel_impresora', 
cod_estado_consultar_precios_extern_global = '$cod_estado_consultar_precios_extern_global', 
cod_estado_marcado_revisado_caja_mesa_venta_temporal_global = '$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global', 
cod_estado_nombre_producto_editable_factura_compra_global = '$cod_estado_nombre_producto_editable_factura_compra_global', 
cod_estado_tipo_compra_global = '$cod_estado_tipo_compra_global',
nombre_campo_undidades_inv1 = '$nombre_campo_undidades_inv1',
nombre_campo_undidades_inv2 = '$nombre_campo_undidades_inv2',
nombre_campo_undidades_inv3 = '$nombre_campo_undidades_inv3',
cod_estado_nota_observacion_global = '$cod_estado_nota_observacion_global',
cod_estado_grafico_estadistico_global = '$cod_estado_grafico_estadistico_global', 
cod_estado_inventario_bodega2_global = '$cod_estado_inventario_bodega2_global', 
cod_estado_tipo_roles_global = '$cod_estado_tipo_roles_global', 
cod_estado_bascula_balanza_electronica_pesar_producto_global = '$cod_estado_bascula_balanza_electronica_pesar_producto_global', 
cod_estado_bascula_balanza_cod_barras_pesar_producto_global = '$cod_estado_bascula_balanza_cod_barras_pesar_producto_global',
cod_tipo_sistema_numeracion = '$cod_tipo_sistema_numeracion',
cod_estado_lote_compra_global = '$cod_estado_lote_compra_global',
cod_estado_tipo_metodo_envio_global = '$cod_estado_tipo_metodo_envio_global', 
cod_estado_mod_domicilio_y_estado_habilitado_producto_global = '$cod_estado_mod_domicilio_y_estado_habilitado_producto_global', 
cod_estado_promocion_global = '$cod_estado_promocion_global',
cod_estado_notificacion_alerta_correo_global = '$cod_estado_notificacion_alerta_correo_global',
cod_estado_notificacion_alerta_correo_copia_seguridad_global = '$cod_estado_notificacion_alerta_correo_copia_seguridad_global',
cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global = '$cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global',
cod_estado_notificacion_alerta_correo_productos_a_vencer_global = '$cod_estado_notificacion_alerta_correo_productos_a_vencer_global',
cod_estado_notificacion_alerta_correo_productos_agotados_global = '$cod_estado_notificacion_alerta_correo_productos_agotados_global',
cod_estado_notificacion_alerta_correo_venta_diaria_global = '$cod_estado_notificacion_alerta_correo_venta_diaria_global', 
cod_servicio_domicilio = '$cod_servicio_domicilio', nombre_servicio_domicilio = '$nombre_servicio_domicilio', 
precio_servicio_domicilio = '$precio_servicio_domicilio', ptj_servicio_domicilio = '$ptj_servicio_domicilio', 
cod_tipo_sistema_numeracion_und_compra = '$cod_tipo_sistema_numeracion_und_compra', cod_tipo_sistema_numeracion_und_venta = '$cod_tipo_sistema_numeracion_und_venta', 
cod_tipo_sistema_numeracion_precio_compra = '$cod_tipo_sistema_numeracion_precio_compra', cod_tipo_sistema_numeracion_precio_venta = '$cod_tipo_sistema_numeracion_precio_venta', 
nombre_tipo_campo_componente_html_und_venta = '$nombre_tipo_campo_componente_html_und_venta', nombre_tipo_campo_componente_html_und_compra = '$nombre_tipo_campo_componente_html_und_compra', 
nombre_tipo_campo_componente_html_precio_compra = '$nombre_tipo_campo_componente_html_precio_compra', nombre_tipo_campo_componente_html_precio_venta = '$nombre_tipo_campo_componente_html_precio_venta',
cod_estado_venta_dependencia_de_usuario_global = '$cod_estado_venta_dependencia_de_usuario_global', 
cod_estado_posicion_mapa_gps_pedidos_info_venta_global = '$cod_estado_posicion_mapa_gps_pedidos_info_venta_global',
cod_estado_origen_factura_compra_global = '$cod_estado_origen_factura_compra_global',
cod_estado_existe_producto_factura_compra_global = '$cod_estado_existe_producto_factura_compra_global',
cod_estado_chk_factura_compra_global = '$cod_estado_chk_factura_compra_global',
cod_estado_check_caja_factura_compra_global = '$cod_estado_check_caja_factura_compra_global',
cod_estado_check_und_factura_compra_global = '$cod_estado_check_und_factura_compra_global', 
cod_estado_peso_global = '$cod_estado_peso_global',
cod_estado_cargar_archivo_plano_interno_factura_compra_global = '$cod_estado_cargar_archivo_plano_interno_factura_compra_global',
cod_estado_cargar_archivo_plano_externo_factura_compra_global = '$cod_estado_cargar_archivo_plano_externo_factura_compra_global', 
cod_estado_cuenta_cobrar_abono_glob_global = '$cod_estado_cuenta_cobrar_abono_glob_global',
cod_estado_reporte_compra_por_producto_global = '$cod_estado_reporte_compra_por_producto_global', 
ptj_servicio_cava = '$ptj_servicio_cava',
cod_servicio_cava = '$cod_servicio_cava',
nombre_servicio_cava = '$nombre_servicio_cava',
precio_servicio_cava = '$precio_servicio_cava',
cod_estado_servicio_cava_global = '$cod_estado_servicio_cava_global',
cod_estado_escoger_precio_venta_automatico_global = '$cod_estado_escoger_precio_venta_automatico_global', 
limite_mostrar_producto_lista_caja_virtual = '$limite_mostrar_producto_lista_caja_virtual', 
cod_estado_origen_produccion_global = '$cod_estado_origen_produccion_global',  
dias_alerta_entrega_venta = '$dias_alerta_entrega_venta',
cod_estado_imprimir_reporte_venta_con_productos_global = '$cod_estado_imprimir_reporte_venta_con_productos_global',
cod_estado_factura_compra_cargue_inmediato_global = '$cod_estado_factura_compra_cargue_inmediato_global',
cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global = '$cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global',
cod_estado_actualizar_base_datos_arch_plano_global = '$cod_estado_actualizar_base_datos_arch_plano_global',
cod_estado_actualizar_base_datos_arch_plano_producto_global = '$cod_estado_actualizar_base_datos_arch_plano_producto_global',
cod_estado_actualizar_base_datos_arch_plano_venta_global = '$cod_estado_actualizar_base_datos_arch_plano_venta_global',
cod_estado_actualizar_base_datos_arch_plano_info_venta_global = '$cod_estado_actualizar_base_datos_arch_plano_info_venta_global',
cod_estado_actualizar_base_datos_arch_plano_compra_global = '$cod_estado_actualizar_base_datos_arch_plano_compra_global',
cod_estado_actualizar_base_datos_arch_plano_info_compra_global = '$cod_estado_actualizar_base_datos_arch_plano_info_compra_global',
cod_estado_actualizar_und_producto_inventario_global = '$cod_estado_actualizar_und_producto_inventario_global',
cod_estado_tipo_venta_zapateria_global = '$cod_estado_tipo_venta_zapateria_global',
cod_estado_opcion_escribir_nombre_cliente_venta_global = '$cod_estado_opcion_escribir_nombre_cliente_venta_global',
cod_estado_btn_imprimir_venta_nav_zapateria_global = '$cod_estado_btn_imprimir_venta_nav_zapateria_global',
cod_estado_btn_imprimir_venta_direct_driv_zapateria_global = '$cod_estado_btn_imprimir_venta_direct_driv_zapateria_global',
cod_estado_fecha_entrega_venta_global = '$cod_estado_fecha_entrega_venta_global',
cod_estado_hora_entrega_venta_global = '$cod_estado_hora_entrega_venta_global',
cod_estado_productos_poco_movimiento_global = '$cod_estado_productos_poco_movimiento_global',
cod_estado_nuevo_inventario_por_letra_global = '$cod_estado_nuevo_inventario_por_letra_global',
cod_estado_filtro_aplicacion_chef_bartender_global = '$cod_estado_filtro_aplicacion_chef_bartender_global', 
cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global = '$cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global',
cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global = '$cod_estado_reporte_fecha_pago_venta_cuenta_cobrar_global',
cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global = '$cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar_global', 
cod_estado_reporte_mantenimiento_global = '$cod_estado_reporte_mantenimiento_global', 
cod_estado_abrir_cajon_monedero_driv_direct_global = '$cod_estado_abrir_cajon_monedero_driv_direct_global',
cod_estado_subreporte_venta_diaria_global = '$cod_estado_subreporte_venta_diaria_global',
cod_estado_subreporte_venta_mensual_global = '$cod_estado_subreporte_venta_mensual_global',
cod_estado_subreporte_venta_anual_global = '$cod_estado_subreporte_venta_anual_global',
cod_estado_subreporte_totalventa_global = '$cod_estado_subreporte_totalventa_global',
cod_estado_subreporte_impuestos_global = '$cod_estado_subreporte_impuestos_global',
cod_estado_subreporte_ventasgenerales_global = '$cod_estado_subreporte_ventasgenerales_global',
cod_estado_subreporte_ventasporfacturas_global = '$cod_estado_subreporte_ventasporfacturas_global',
cod_estado_subreporte_ventasportipofacturas_global = '$cod_estado_subreporte_ventasportipofacturas_global',
cod_estado_subreporte_ventaspordependencia_global = '$cod_estado_subreporte_ventaspordependencia_global',
cod_estado_subreporte_ventasportipoproducto_global = '$cod_estado_subreporte_ventasportipoproducto_global',
cod_estado_subreporte_ventasporvendedor_global = '$cod_estado_subreporte_ventasporvendedor_global',
cod_estado_subreporte_ventasporpropinavendedor_global = '$cod_estado_subreporte_ventasporpropinavendedor_global',
cod_estado_subreporte_ventasporcreditocliente_global = '$cod_estado_subreporte_ventasporcreditocliente_global', 
cod_estado_dependencia_sub_global = '$cod_estado_dependencia_sub_global',
cod_estado_factura_compra_producto_global = '$cod_estado_factura_compra_producto_global',
cod_estado_aceite_oleina_global = '$cod_estado_aceite_oleina_global',
cod_estado_valor_flete_aceite_oleina_global = '$cod_estado_valor_flete_aceite_oleina_global',
cod_estado_caja_fraccion_global = '$cod_estado_caja_fraccion_global', 
ptj_interes_inmobiliaria = '$ptj_interes_inmobiliaria', 
ptj_comision_inmobiliaria = '$ptj_comision_inmobiliaria', 
limite_venta_pos_factura_electronica = '$limite_venta_pos_factura_electronica', 
cod_estado_limite_venta_pos_factura_electronica_global = '$cod_estado_limite_venta_pos_factura_electronica_global' 
WHERE cod_info_empresa = '$cod_info_empresa'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

if ($cod_estado_modificar_und_venta_una_sola_vez_global == '0') {
$sql_data = sprintf("UPDATE tbl15_venta_producto_temporal SET cod_estado_componente_und_venta = '0'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>
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