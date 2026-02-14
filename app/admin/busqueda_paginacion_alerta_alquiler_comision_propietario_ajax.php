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
$fecha_alerta_ini      = addslashes($_REQUEST['fecha_alerta_ini']);
$fecha_alerta_fin      = addslashes($_REQUEST['fecha_alerta_fin']);
$fecha_hoy             = date('Y-m-d');
$pagina_local          = $pagina;

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

$monto_deuda_smtr                                  = 0;
$abonado_smtr                                      = 0;
$subtotal_smtr                                     = 0;
$fecha_hoy                                         = date('Y-m-d');
$fecha_un_mes_atras                                = date('Y-m-d', strtotime($fecha_hoy.'-1 month'));
$palabra                                           = "";
?>
<table class="table table-bordered table-hover table-sm">
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FACTURAR COMISION PROPIETARIO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">CONT</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">PROPIETARIO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">INMUEBLE</th>
        <!--<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">MES</th>-->
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ABONO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA COBRO INQ</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">TIPO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA PAGO PROP ALERT</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FORMA PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ID</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">EXCLUIR</th>
    </tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_alerta, 
tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_abonos, 
tbl15_cuentas_cobrar_alerta.cod_tercero, tbl15_cuentas_cobrar_alerta.cod_tercero_propietario, tbl15_cuentas_cobrar_alerta.cod_factura, tbl15_cuentas_cobrar_alerta.numero_alerta, 
tbl15_cuentas_cobrar_alerta.cod_producto, tbl15_cuentas_cobrar_alerta.cod_producto_barra, tbl15_cuentas_cobrar_alerta.nombre_producto, tbl15_cuentas_cobrar_alerta.monto_deuda, 
tbl15_cuentas_cobrar_alerta.monto_cuota, tbl15_cuentas_cobrar_alerta.total_pendiente, tbl15_cuentas_cobrar_alerta.total_recibido, tbl15_cuentas_cobrar_alerta.fecha_pago, 
tbl15_cuentas_cobrar_alerta.fecha_pago_reg, tbl15_cuentas_cobrar_alerta.cod_estado_pago_propietario, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_factura_comision_propietario, 
tbl15_producto.dia_pago_propietario_inmueble, tbl15_producto.nombre_tipo_cobro_propietario_inmueble, tbl15_producto.cod_tipo_forma_pago, 
tbl15_cuentas_cobrar_alerta.fecha_mes, tbl15_cuentas_cobrar_alerta.anyo, tbl15_cuentas_cobrar_alerta.cod_estado_envio_correo_cuenta_cobro, 
tbl15_cuentas_cobrar_alerta.cod_estado_envio_correo_comision_propietario, tbl15_cuentas_cobrar_alerta.fecha_pago_periodo_orig, tbl15_cuentas_cobrar_alerta.fecha_alerta_pago_comision_prop
FROM tbl15_producto RIGHT JOIN tbl15_cuentas_cobrar_alerta ON tbl15_producto.cod_producto = tbl15_cuentas_cobrar_alerta.cod_producto
WHERE (tbl15_cuentas_cobrar_alerta.fecha_alerta_pago_comision_prop = '$fecha_alerta_ini') AND (tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_factura_comision_propietario = '0')  
AND (tbl15_producto.dia_pago_propietario_inmueble <> '') AND ((tbl15_cuentas_cobrar_alerta.cod_estado_pago = '1') OR (tbl15_cuentas_cobrar_alerta.cod_estado_pago = '0')) AND (tbl15_cuentas_cobrar_alerta.cod_excluir_pago_propietario = '0') 
ORDER BY tbl15_cuentas_cobrar_alerta.fecha_pago_periodo_orig ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar_alerta                         = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar                                = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$numero_alerta                                     = $datos_cuenta_cobrar['numero_alerta'];
$cod_factura                                       = $datos_cuenta_cobrar['cod_factura'];
$monto_deuda                                       = $datos_cuenta_cobrar['monto_deuda'];
$fecha_pago                                        = $datos_cuenta_cobrar['fecha_pago'];
$monto_cuota                                       = $datos_cuenta_cobrar['monto_cuota'];
$cod_cuentas_cobrar_abonos                         = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
$total_pendiente                                   = $datos_cuenta_cobrar['total_pendiente'];
$cod_cuentas_cobrar_factura_comision_propietario   = $datos_cuenta_cobrar['cod_cuentas_cobrar_factura_comision_propietario'];
$cod_estado_envio_correo_cuenta_cobro              = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
$cod_estado_envio_correo_comision_propietario      = $datos_cuenta_cobrar['cod_estado_envio_correo_comision_propietario'];
$nombre_producto                                   = $datos_cuenta_cobrar['nombre_producto'];
$dia_pago_propietario_inmueble                     = $datos_cuenta_cobrar['dia_pago_propietario_inmueble'];
$nombre_tipo_cobro_propietario_inmueble            = $datos_cuenta_cobrar['nombre_tipo_cobro_propietario_inmueble'];
$fecha_pago_reg_db                                 = $datos_cuenta_cobrar['fecha_pago_reg'];
$cod_tercero_propietario                           = $datos_cuenta_cobrar['cod_tercero_propietario'];
$cod_tercero                                       = $datos_cuenta_cobrar['cod_tercero'];
$cod_estado_pago_propietario                       = $datos_cuenta_cobrar['cod_estado_pago_propietario'];
$fecha_mes                                         = $datos_cuenta_cobrar['fecha_mes'];
$total_recibido                                    = $datos_cuenta_cobrar['total_recibido'];
$cod_tipo_forma_pago                               = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
$fecha_pago_periodo_orig                           = $datos_cuenta_cobrar['fecha_pago_periodo_orig'];
$fecha_alerta_pago_comision_prop                   = $datos_cuenta_cobrar['fecha_alerta_pago_comision_prop'];

$fecha_mes_complet                                 = $fecha_mes.'-01';
$fecha_pago_dmy                                    = date("d-m-Y", strtotime($fecha_pago_periodo_orig));
$nombre_tabla_mes                                  = date("m", strtotime($fecha_mes_complet));
$cod_estado_pago_const                             = 1;

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes                            = $matriz_consulta['nombre_letra_tabla_mes'];

$sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado_pago_propietario'";
$consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
$matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

$color_fondo_celda_estado_pago                     = $matriz_estado_pago['color_fondo_celda_estado_pago'];
$color_letra_celda_estado_pago                     = $matriz_estado_pago['color_letra_celda_estado_pago'];
$dia_pago_propietario                              = date("d", strtotime($dia_pago_propietario_inmueble));
$fecha_alerta_mes                                  = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+1 month'));

$sql_cuentas_cobrar = "SELECT cod_producto FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar  = '$cod_cuentas_cobrar'";
$consulta_cuentas_cobrar = mysqli_query($conectar, $sql_cuentas_cobrar) or die(mysqli_error($conectar));
$matriz_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar);

$cod_producto                                      = $matriz_cuentas_cobrar['cod_producto'];

$sql_consulta_producto = "SELECT cod_tercero FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_tercero_propietario                           = $total_producto['cod_tercero'];

$sql_tercero = "SELECT nombre1_tercero FROM tbl15_tercero WHERE cod_tercero  = '$cod_tercero_propietario'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$matriz_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre1_tercero                                   = $matriz_tercero['nombre1_tercero'];
$cliente_inquilino                                 = $nombre1_tercero;

$sql_consulta_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_consulta_tipo_forma_pago) or die(mysqli_error($conectar));
$total_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago                           = $total_tipo_forma_pago['nombre_tipo_forma_pago'];


if ($nombre_tipo_cobro_propietario_inmueble == 'MES VENCIDO') { $fecha_alerta = date('Y-m', strtotime($fecha_alerta_mes)).'-'.$dia_pago_propietario; } else { $fecha_alerta = $fecha_pago_periodo_orig; }
?>
    <tr id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>">
        <!--<td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><a href="../admin/reg_comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina_local;?>&palabra=<?php echo $palabra;?>"><img src='../imagenes/base_caja.png' alt="Abonar"></a></td>-->
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><a href="../admin/comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina_local;?>&palabra=<?php echo $palabra;?>"><img src='../imagenes/base_caja.png' alt="Abonar"></a></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><a href="../admin/cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar; ?>&cod_tercero=<?php echo $cod_tercero; ?>&cod_factura=<?php echo $cod_factura; ?>&pagina=<?php echo $pagina; ?>" target="_blank"><?php echo $cod_factura ;?></a></font></td>
        <td style="text-align: left;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre1_tercero;?></font></td>
        <td style="text-align: left;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre_producto;?></font></td>
        <!--<td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre_letra_tabla_mes ;?></font></td>-->
        <td style="text-align: right;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo number_format($total_recibido, 0, ",", ".") ;?></font></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo date("d-m-Y", strtotime($fecha_pago_periodo_orig)) ;?></font></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre_tipo_cobro_propietario_inmueble ?></font></a></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo  date("d-m-Y", strtotime($fecha_alerta_pago_comision_prop)) ?></font></a></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre_tipo_forma_pago ;?></font></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $cod_cuentas_cobrar_alerta ;?></font></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" class="service_list" data="<?php echo $cod_cuentas_cobrar_alerta ?>"><a class="excluir_estado_pago_propietario" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><img src="../imagenes/eliminar_excluir_grand.png" class="img-polaroid" alt=""></a></td>
    </tr id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>">
<?php } ?>
</table>

<script type="text/javascript">
$(document).ready(function() {

    $('.excluir_estado_pago_propietario').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_cuentas_cobrar_alerta = $(this).parent().attr('data');
        var tab = 'tbl15_cuentas_cobrar_alerta_cod_excluir_pago_propietario';
        var campo = 'cod_cuentas_cobrar_alerta';
        var tipo = 'eliminar';
        var dataString = 'llave='+cod_cuentas_cobrar_alerta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo='+tipo;

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success:function(respuesta){ 
                var total_gasto_venta_format = respuesta.total_gasto_format;
                var afectado = respuesta.afectado;
                var mensaje = respuesta.mensaje;
                          
                $('#cod_cuentas_cobrar_alerta'+cod_cuentas_cobrar_alerta).fadeOut("slow");
                $('#tr'+cod_cuentas_cobrar_alerta).fadeOut("slow");
                
            }
        });
    });

});
</script>