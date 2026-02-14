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
$cod_administrador  = $_SESSION['cod_administrador'];
include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                        = $info_empresa_data['titulo'];
$nombre_emp                                        = $info_empresa_data['nombre'];
$eslogan_emp                                       = $info_empresa_data['eslogan'];
$direccion_emp                                     = $info_empresa_data['direccion'];
$ciudad_emp                                        = $info_empresa_data['ciudad'];
$pais_emp                                          = $info_empresa_data['pais'];
$correo_emp                                        = $info_empresa_data['correo'];
$img_cabecera_emp                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                      = $info_empresa_data['telefono'];
$info_legal_emp                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                 = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                      = $info_empresa_data['cabecera'];
$icono_emp                                         = $info_empresa_data['icono'];
$desarrollador_emp                                 = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                             = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                          = $info_empresa_data['anyo'];
$url_pag                                           = $info_empresa_data['url_pag'];
$nombre_font                                       = $info_empresa_data['nombre_font'];
$res_emp                                           = $info_empresa_data['res'];
$res1_emp                                          = $info_empresa_data['res1'];
$res2_emp                                          = $info_empresa_data['res2'];
$departamento_emp                                  = $info_empresa_data['departamento'];
$localidad_emp                                     = $info_empresa_data['localidad'];
$reg_medico_emp                                    = $info_empresa_data['reg_medico'];
$regimen_emp                                       = $info_empresa_data['regimen'];
$version_emp                                       = $info_empresa_data['version'];
$propietario_url_firma_emp                         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                    = $info_empresa_data['fecha_time'];
$licencia_emp                                      = $info_empresa_data['licencia'];
$tamano_font_emp                                   = $info_empresa_data['tamano_font'];
$info_histclinic_emp                               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                               = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                           = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                           = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                              = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                              = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                          = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                          = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                            = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                              = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual                     = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                          = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                                     = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                               = $info_empresa_data['nombre_tipo_empresa'];

$dias_vencimiento_producto_alerta                  = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                     = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                            = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                            = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                        = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                         = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra                   = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global     = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global             = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global              = $info_empresa_data['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global               = $info_empresa_data['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                  = $info_empresa_data['cod_estado_sticker_barras_global'];

$cod_estado_modulo_contabilidad_global             = $info_empresa_data['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global               = $info_empresa_data['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica               = $info_empresa_data['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                = $info_empresa_data['cod_estado_producto_consumo_global'];
$cod_estado_compra_caja_global                     = $info_empresa_data['cod_estado_compra_caja_global'];
$nombre_tipo_impresora_zebra_ticket                = $info_empresa_data['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                   = $info_empresa_data['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                    = $info_empresa_data['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                          = $info_empresa_data['cod_estado_egreso_global'];
$cod_estado_usuario_global                         = $info_empresa_data['cod_estado_usuario_global'];
$cod_estado_dependencia_global                     = $info_empresa_data['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                    = $info_empresa_data['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global              = $info_empresa_data['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                            = $info_empresa_data['cod_estado_cita_global'];
$cod_estado_factura_compra_global                  = $info_empresa_data['cod_estado_factura_compra_global'];

$cod_estado_modulo_producto_global                 = $info_empresa_data['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global              = $info_empresa_data['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                    = $info_empresa_data['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                  = $info_empresa_data['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                   = $info_empresa_data['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                  = $info_empresa_data['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                    = $info_empresa_data['cod_estado_modulo_admin_global'];
$cod_estado_pyg_global                             = $info_empresa_data['cod_estado_pyg_global'];
$cod_estado_balance_global                         = $info_empresa_data['cod_estado_balance_global'];
$cod_estado_mov_contable_global                    = $info_empresa_data['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                    = $info_empresa_data['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global         = $info_empresa_data['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                = $info_empresa_data['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                       = $info_empresa_data['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                    = $info_empresa_data['cod_estado_envio_correo_global'];
$cod_estado_ordenamiento_alfabetico_venta_global   = $info_empresa_data['cod_estado_ordenamiento_alfabetico_venta_global'];

$cod_estado_nocodif_precio_compra_sticker_global   = $info_empresa_data['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global    = $info_empresa_data['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global          = $info_empresa_data['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global            = $info_empresa_data['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global             = $info_empresa_data['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global              = $info_empresa_data['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global    = $info_empresa_data['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                      = $info_empresa_data['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                            = $info_empresa_data['nombre_empresa_sticker'];
$nombre_buscar_por                                 = $info_empresa_data['nombre_buscar_por'];

$cod_estado_img_producto_global                    = $info_empresa_data['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global             = $info_empresa_data['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                          = $info_empresa_data['cod_estado_animal_global'];
$cod_estado_producto_serial_global                 = $info_empresa_data['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global              = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                 = $info_empresa_data['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global   = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                            = $info_empresa_data['nombre_tipo_componente'];
$cod_estado_subproducto_global                     = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                = $info_empresa_data['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                       = $info_empresa_data['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                     = $info_empresa_data['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global       = $info_empresa_data['cod_estado_observacion_tercero_venta_global'];

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


//---------------------------------------------------------------------------------------------------------------------------------//
$cuenta_actual      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);

$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_estado_hoy        = intval($_REQUEST['cod_estado_hoy']);
$cod_estado_pago       = intval($_REQUEST['cod_estado_pago']);
$buscar_por            = addslashes($_REQUEST['buscar_por']);
$busqueda_ajax         = addslashes($_REQUEST['busqueda_ajax']);
$action                = addslashes($_REQUEST['action']);
$tabla                 = addslashes($_REQUEST['tabla']);
$page                  = intval($_REQUEST['page']);
$pagina                = addslashes($_REQUEST['pagina']);
$fecha_hoy             = date('Y-m-d');

if ($busqueda_ajax == '') {
$filtro_consulta_estado_busqueda_ajax = "(1=1)";
$filtro_consulta_estado_busqueda_ajax_rel = "(1=1)";
} else {
$filtro_consulta_estado_busqueda_ajax = "(1=1)";
$filtro_consulta_estado_busqueda_ajax_rel = "(1=1)";
}

if ($cod_estado_hoy == '-1') {
$filtro_consulta_estado_hoy = "";
$filtro_consulta_estado_hoy_rel = "";
} else {
$filtro_consulta_estado_hoy = "AND ((fecha_pago = '$fecha_hoy'))";
$filtro_consulta_estado_hoy_rel = "AND ((tbl15_cuentas_cobrar_alerta.fecha_pago = '$fecha_hoy'))";
}

if ($cod_estado_pago == '-1') {
$filtro_consulta_estado_pago = "";
$filtro_consulta_estado_pago_rel = "";
} else {
$filtro_consulta_estado_pago = "AND ((cod_estado = '$cod_estado_pago'))";
$filtro_consulta_estado_pago_rel = "AND ((tbl15_cuentas_cobrar_alerta.cod_estado = '$cod_estado_pago'))";
}

if (($buscar_por == 'documento_nombre_inquilino') && ($busqueda_ajax <> '')) {
$filtro_consulta_buscar_por = "AND ((nombre1_tercero LIKE '%$busqueda_ajax%') OR (identificacion_tercero = '$busqueda_ajax'))";
$filtro_consulta_buscar_por_rel = "AND (((tbl15_tercero.nombre1_tercero LIKE '%$busqueda_ajax%') OR (tbl15_tercero.identificacion_tercero = '$busqueda_ajax')))";
} elseif (($buscar_por == 'fecha_limite_pago_alquiler') && ($busqueda_ajax <> '')) {
$filtro_consulta_buscar_por = "AND ((fecha_pago = '$busqueda_ajax'))";
$filtro_consulta_buscar_por_rel = "AND ((tbl15_cuentas_cobrar_alerta.fecha_pago = '$busqueda_ajax'))";
} else {
$filtro_consulta_buscar_por = "";
$filtro_consulta_buscar_por_rel = "";
}

?>
<table class="table table-bordered table-hover table-sm">
	<tr>
		<?php if ($cod_seguridad== '3') { ?>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ELIM</strong></th>
		<?php } ?>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>PAGAR</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>NOMBRE CLIENTE</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>DOCUMENTO CLIENTE</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>INMUEBLE</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>PERIODO</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>MES</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>PRECIO ALQUILER</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ATRASO</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>FECHA LIMITE PAGO</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>REG PAGO</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>CONTRATO</strong></th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ESTADO PAGO</strong></th>
	</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_tercero.cod_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.nombre1_tercero, 
tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_alerta, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar, tbl15_cuentas_cobrar_alerta.subtotal,
tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_abonos, tbl15_cuentas_cobrar_alerta.numero_alerta, tbl15_cuentas_cobrar_alerta.mensaje, 
tbl15_cuentas_cobrar_alerta.vendedor, tbl15_cuentas_cobrar_alerta.fecha_pago_reg, tbl15_cuentas_cobrar_alerta.hora_pago_reg, 
tbl15_cuentas_cobrar_alerta.cod_factura, tbl15_cuentas_cobrar_alerta.cod_producto, tbl15_cuentas_cobrar_alerta.cod_producto_barra, 
tbl15_cuentas_cobrar_alerta.nombre_producto, tbl15_cuentas_cobrar_alerta.monto_deuda, tbl15_cuentas_cobrar_alerta.monto_cuota, 
tbl15_cuentas_cobrar_alerta.fecha_pago, tbl15_cuentas_cobrar_alerta.cod_estado, tbl15_cuentas_cobrar_alerta.abonado
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar_alerta ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar_alerta.cod_tercero
WHERE $filtro_consulta_estado_busqueda_ajax_rel $filtro_consulta_estado_hoy_rel $filtro_consulta_estado_pago_rel $filtro_consulta_buscar_por_rel 
ORDER BY tbl15_cuentas_cobrar_alerta.fecha_pago ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar_alerta      = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$numero_alerta                  = $datos_cuenta_cobrar['numero_alerta'];
$cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
$abonado                        = $datos_cuenta_cobrar['abonado'];
$subtotal                       = $datos_cuenta_cobrar['subtotal'];
$mensaje                        = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                       = $datos_cuenta_cobrar['vendedor'];
$monto_cuota                    = $datos_cuenta_cobrar['monto_cuota'];
$cod_estado                     = $datos_cuenta_cobrar['cod_estado'];
$fecha_pago_reg                 = $datos_cuenta_cobrar['fecha_pago_reg'];
$hora_pago_reg                  = $datos_cuenta_cobrar['hora_pago_reg'];
$cod_tercero                    = $datos_cuenta_cobrar['cod_tercero'];
$cod_producto                   = $datos_cuenta_cobrar['cod_producto'];
$cod_producto_barra             = $datos_cuenta_cobrar['cod_producto_barra'];
$nombre_producto                = $datos_cuenta_cobrar['nombre_producto'];
$cod_cuentas_cobrar_abonos      = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];

if ($fecha_pago_reg == '') { $fecha_pago_reg = ''; $fecha_hoy = $fecha_hoy; } else { $fecha_pago_reg = date("d-m-Y", strtotime($fecha_pago_reg)); $fecha_hoy = $fecha_pago_reg; }

$dias_atraso_seg                = strtotime($fecha_hoy) - strtotime($fecha_pago);
$dias_atraso                    = $dias_atraso_seg/(60*60*24);

$nombre_tabla_mes               = date("m", strtotime($fecha_pago));
$nombre_anyo_mes                = date("Y", strtotime($fecha_pago));

$sql_consulta_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes         = $matriz_consulta['nombre_letra_tabla_mes'];

$sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado'";
$consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
$matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

$nombre_estado_pago             = $matriz_estado_pago['nombre_estado_pago'];
$color_fondo_celda_estado_pago  = $matriz_estado_pago['color_fondo_celda_estado_pago'];
$color_letra_celda_estado_pago  = $matriz_estado_pago['color_letra_celda_estado_pago'];

if ($fecha_hoy == $fecha_pago) { $btn_imagen = 'base_caja_pago_hoy.gif'; } elseif ($fecha_hoy > $fecha_pago) { $btn_imagen = 'base_caja_pago_atrasado.gif'; } else { $btn_imagen = 'base_caja.png'; }

$fecha_pago                     = date("d-m-Y", strtotime($fecha_pago));
?>
	<tr>
		<?php if ($cod_seguridad== '3') { ?>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><a href="../modificar_eliminar/eliminar_cuentas_cobrar_y_abonos.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $nombre1_tercero;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/eliminar.png alt="Abonar"></a></td>
		<?php } ?>
		<?php if ($cod_estado == '0' || $cod_estado == '2') { ?>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><a href="../admin/reg_cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $nombre1_tercero;?>&pagina=<?php echo $pagina;?>&cod_estado_hoy=<?php echo $cod_estado_hoy;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&buscar_por=<?php echo $buscar_por;?>&busqueda_ajax=<?php echo $busqueda_ajax;?>&action=<?php echo $action;?>&tabla=<?php echo $tabla;?>&page=<?php echo $page;?>"><img src=../imagenes/<?php echo $btn_imagen;?> alt="Abonar"></a></td>
		<?php } else { ?>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><a href="../admin/cuentas_cobrar_abonos_alquiler_comprobante_ingreso_imprimir_pdf.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $nombre1_tercero;?>&pagina=<?php echo $pagina;?>" target="_blank"><img src=../imagenes/imprimir_peq.png alt="Abonar"></a></td>
		<?php } ?>

		<td style="text-align: left; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $nombre1_tercero;?></td>
		<td style="text-align: left; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $identificacion_tercero;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $cod_producto_barra;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $numero_alerta;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $nombre_letra_tabla_mes.'<br>'.$nombre_anyo_mes ;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo number_format($monto_cuota, 0, ",", ".") ?></a></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $dias_atraso.' DIAS';?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $fecha_pago;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $fecha_pago_reg;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $cod_cuentas_cobrar;?></td>
		<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $nombre_estado_pago;?></td>
	</tr>
<?php } ?>
</table>