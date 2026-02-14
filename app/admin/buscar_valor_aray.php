<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                  = $info_empresa_data['titulo'];
$nombre_emp                                                  = $info_empresa_data['nombre'];
$eslogan_emp                                                 = $info_empresa_data['eslogan'];
$direccion_emp                                               = $info_empresa_data['direccion'];
$ciudad_emp                                                  = $info_empresa_data['ciudad'];
$pais_emp                                                    = $info_empresa_data['pais'];
$correo_emp                                                  = $info_empresa_data['correo'];
$img_cabecera_emp                                            = $info_empresa_data['img_cabecera'];
$telefono_emp                                                = $info_empresa_data['telefono'];
$info_legal_emp                                              = $info_empresa_data['info_legal'];
$logotipo_emp                                                = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                           = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                         = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                             = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                = $info_empresa_data['cabecera'];
$icono_emp                                                   = $info_empresa_data['icono'];
$desarrollador_emp                                           = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                                       = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                                    = $info_empresa_data['anyo'];
$url_pag                                                     = $info_empresa_data['url_pag'];
$nombre_font                                                 = $info_empresa_data['nombre_font'];
$res_emp                                                     = $info_empresa_data['res'];
$res1_emp                                                    = $info_empresa_data['res1'];
$res2_emp                                                    = $info_empresa_data['res2'];
$departamento_emp                                            = $info_empresa_data['departamento'];
$localidad_emp                                               = $info_empresa_data['localidad'];
$reg_medico_emp                                              = $info_empresa_data['reg_medico'];
$regimen_emp                                                 = $info_empresa_data['regimen'];
$version_emp                                                 = $info_empresa_data['version'];
$propietario_url_firma_emp                                   = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                              = $info_empresa_data['fecha_time'];
$licencia_emp                                                = $info_empresa_data['licencia'];
$tamano_font_emp                                             = $info_empresa_data['tamano_font'];
$info_histclinic_emp                                         = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                         = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                                     = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                                     = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                                        = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                                        = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                                    = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                                    = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                                      = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                                        = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual                               = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                                    = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                                               = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                                         = $info_empresa_data['nombre_tipo_empresa'];
$cantidad_caja_mesa                                          = $info_empresa_data['cantidad_caja_mesa'];

$tamano_font_sticker_barra_pdf                               = $info_empresa_data['tamano_font_sticker_barra_pdf'];
$ancho_sticker_barra_pdf                                     = $info_empresa_data['ancho_sticker_barra_pdf'];
$alto_sticker_barra_pdf                                      = $info_empresa_data['alto_sticker_barra_pdf'];
$columnas_sticker_barra_pdf                                  = $info_empresa_data['columnas_sticker_barra_pdf'];
$nombre_estandar_sticker_barra_pdf                           = $info_empresa_data['nombre_estandar_sticker_barra_pdf'];
$tipo_hoja_sticker_barra_pdf                                 = $info_empresa_data['tipo_hoja_sticker_barra_pdf'];

$titulo                                                      = $info_empresa_data['titulo'];
$dir_oficiana1                                               = $info_empresa_data['dir_oficiana1'];
$dir_oficiana2                                               = $info_empresa_data['dir_oficiana2'];
$dir_oficiana3                                               = $info_empresa_data['dir_oficiana3'];
$dir_oficiana4                                               = $info_empresa_data['dir_oficiana4'];
$tel1                                                        = $info_empresa_data['tel1'];
$tel2                                                        = $info_empresa_data['tel2'];
$tel3                                                        = $info_empresa_data['tel3'];
$tel4                                                        = $info_empresa_data['tel4'];
$resena_info_empresa                                         = $info_empresa_data['resena_info_empresa'];
$mision_info_empresa                                         = $info_empresa_data['mision_info_empresa'];
$vision_info_empresa                                         = $info_empresa_data['vision_info_empresa'];
$declaracion_privacidad_info_empresa                         = $info_empresa_data['declaracion_privacidad_info_empresa'];
$politica_devolucion_info_empresa                            = $info_empresa_data['politica_devolucion_info_empresa'];
$info_entrega_info_empresa                                   = $info_empresa_data['info_entrega_info_empresa'];
$keywords                                                    = $info_empresa_data['keywords'];
$description                                                 = $info_empresa_data['description'];
$author                                                      = $info_empresa_data['author'];
$longitud                                                    = $info_empresa_data['longitud'];
$latitud                                                     = $info_empresa_data['latitud'];
$url_mapa1                                                   = $info_empresa_data['url_mapa1'];
$url_mapa2                                                   = $info_empresa_data['url_mapa2'];
$cod_estado_reg_veterinaria                                  = $info_empresa_data['cod_estado_reg_veterinaria'];
$frag_icono                                                  = explode('../', $icono_emp);
$pos_icono                                                   = $frag_icono[1];

$dias_vencimiento_producto_alerta                            = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global                         = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                              = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                               = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                                      = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                                      = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                                  = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                                   = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global                       = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra                             = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global               = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global                       = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global                        = $info_empresa_data['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global                         = $info_empresa_data['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                            = $info_empresa_data['cod_estado_sticker_barras_global'];

$cod_estado_modulo_contabilidad_global                       = $info_empresa_data['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global                         = $info_empresa_data['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica                         = $info_empresa_data['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                          = $info_empresa_data['cod_estado_producto_consumo_global'];
$cod_estado_compra_caja_global                               = $info_empresa_data['cod_estado_compra_caja_global'];
$nombre_tipo_impresora_zebra_ticket                          = $info_empresa_data['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                             = $info_empresa_data['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                              = $info_empresa_data['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                                    = $info_empresa_data['cod_estado_egreso_global'];
$cod_estado_usuario_global                                   = $info_empresa_data['cod_estado_usuario_global'];
$cod_estado_dependencia_global                               = $info_empresa_data['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                              = $info_empresa_data['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global                        = $info_empresa_data['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                                      = $info_empresa_data['cod_estado_cita_global'];
$cod_estado_factura_compra_global                            = $info_empresa_data['cod_estado_factura_compra_global'];

$cod_estado_modulo_producto_global                           = $info_empresa_data['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global                        = $info_empresa_data['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                              = $info_empresa_data['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                            = $info_empresa_data['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                             = $info_empresa_data['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                            = $info_empresa_data['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                              = $info_empresa_data['cod_estado_modulo_admin_global'];
$cod_estado_pyg_global                                       = $info_empresa_data['cod_estado_pyg_global'];
$cod_estado_balance_global                                   = $info_empresa_data['cod_estado_balance_global'];
$cod_estado_mov_contable_global                              = $info_empresa_data['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                              = $info_empresa_data['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global                   = $info_empresa_data['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                          = $info_empresa_data['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                                 = $info_empresa_data['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                              = $info_empresa_data['cod_estado_envio_correo_global'];
$cod_estado_ordenamiento_alfabetico_venta_global             = $info_empresa_data['cod_estado_ordenamiento_alfabetico_venta_global'];

$cod_estado_nocodif_precio_compra_sticker_global             = $info_empresa_data['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global              = $info_empresa_data['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global                    = $info_empresa_data['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global                      = $info_empresa_data['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global                       = $info_empresa_data['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global                        = $info_empresa_data['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global              = $info_empresa_data['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                                = $info_empresa_data['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                                      = $info_empresa_data['nombre_empresa_sticker'];
$nombre_buscar_por                                           = $info_empresa_data['nombre_buscar_por'];

$cod_estado_img_producto_global                              = $info_empresa_data['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global                       = $info_empresa_data['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                                    = $info_empresa_data['cod_estado_animal_global'];
$cod_estado_producto_serial_global                           = $info_empresa_data['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global                        = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                           = $info_empresa_data['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global             = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                                      = $info_empresa_data['nombre_tipo_componente'];
$cod_estado_subproducto_global                               = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                          = $info_empresa_data['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                                 = $info_empresa_data['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                               = $info_empresa_data['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global                 = $info_empresa_data['cod_estado_observacion_tercero_venta_global'];

$cod_estado_alerta_fecha_nac_global                          = $info_empresa_data['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                 = $info_empresa_data['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                             = $info_empresa_data['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                          = $info_empresa_data['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                       = $info_empresa_data['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                      = $info_empresa_data['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                 = $info_empresa_data['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                               = $info_empresa_data['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                     = $info_empresa_data['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                    = $info_empresa_data['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                  = $info_empresa_data['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                    = $info_empresa_data['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                = $info_empresa_data['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                    = $info_empresa_data['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                   = $info_empresa_data['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                               = $info_empresa_data['costo_parqueo'];
$nombre_tipo_cobro_hotel                                     = $info_empresa_data['nombre_tipo_cobro_hotel'];
$costo_hotel                                                 = $info_empresa_data['costo_hotel'];
$cod_estado_parqueo_hotel_global                             = $info_empresa_data['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                     = $info_empresa_data['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                   = $info_empresa_data['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                     = $info_empresa_data['cod_estado_plan_accion_correcion_global'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global  = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                 = $info_empresa_data['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global      = $info_empresa_data['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global              = $info_empresa_data['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global             = $info_empresa_data['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global             = $info_empresa_data['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global        = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                 = $info_empresa_data['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global              = $info_empresa_data['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                    = $info_empresa_data['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                               = $info_empresa_data['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                 = $info_empresa_data['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                            = $info_empresa_data['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                     = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_proveedor_global                                 = $info_empresa_data['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                           = $info_empresa_data['cod_estado_archivo_adjunto_global'];
$cod_estado_precio_compra_mod_venta_global                   = $info_empresa_data['cod_estado_precio_compra_mod_venta_global'];

$cod_estado_timbre_entrada_pedido_temporal_cocina_global     = $info_empresa_data['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global      = $info_empresa_data['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_estado_subproducto_mostrar_imprimir_global              = $info_empresa_data['cod_estado_subproducto_mostrar_imprimir_global'];

$cod_estado_diferencia_ganancia_inventario_global            = $info_empresa_data['cod_estado_diferencia_ganancia_inventario_global'];
$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global = $info_empresa_data['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'];
$cod_estado_opcion_descontable_inv_global                    = $info_empresa_data['cod_estado_opcion_descontable_inv_global'];
$cod_estado_hora_reporte_venta_global                        = $info_empresa_data['cod_estado_hora_reporte_venta_global'];

$cod_estado_cantidad_caja_mesa_global                        = $info_empresa_data['cod_estado_cantidad_caja_mesa_global'];



$mesas_caja_en_uso = array();

$contador_mesas_array = 1;

$sql_mesas_caja_en_uso = "SELECT cod_base_caja FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') ORDER BY cod_base_caja";
$consulta_mesas_caja_en_uso = mysqli_query($conectar, $sql_mesas_caja_en_uso);
while ($datos_mesas_caja_en_uso = mysqli_fetch_assoc($consulta_mesas_caja_en_uso)) {

$cod_base_caja_en_uso                      = $datos_mesas_caja_en_uso['cod_base_caja'];

$mesas_caja_en_uso[$contador_mesas_array] = $cod_base_caja_en_uso;
$contador_mesas_array ++;
}

$smtr = 0;

$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_venta_producto_temporal WHERE cuenta = '$cuenta_actual'";
$resultado_animal = mysqli_query($conectar, $sql_animal);
$info_animal = mysqli_fetch_assoc($resultado_animal);

$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
$cod_base_caja                      = $info_animal['cod_base_caja'] + 1;

$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA')";
$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

$cod_prioridad                      = $datos_max_prioridad['cod_prioridad'] + 1;

var_export ($mesas_caja_en_uso);
?>
<table class="table table-striped">
<tr>
<?php for ($i=1; $i < $cantidad_caja_mesa+1; $i++) { 
		if ($smtr % 4 == 0) { echo "<tr></tr>"; }
		$smtr++;
		$indice_mesas_caja_en_uso = array_search($i, $mesas_caja_en_uso, false);

		if ($indice_mesas_caja_en_uso == '') { echo "<br>indice vacio // ".$indice_mesas_caja_en_uso; } 
		elseif ($indice_mesas_caja_en_uso == 0) { echo "<br>indice 0 // ".$indice_mesas_caja_en_uso; }
		else { echo "<br>diferente de ceo y vacio // ".$indice_mesas_caja_en_uso; } ?>

<?php } ?>
</tr>
</table>