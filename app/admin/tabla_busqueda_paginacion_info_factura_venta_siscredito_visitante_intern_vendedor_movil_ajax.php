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
$cod_estado_tipo_compra_global                               = $info_empresa_data['cod_estado_tipo_compra_global'];
$cod_estado_puntos_redimibles_campanya_global                = $info_empresa_data['cod_estado_puntos_redimibles_campanya_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina_local                                                = "";
$pagina_complt                                               = $_SERVER['PHP_SELF'];
$fragm                                                       = explode("/", $pagina_complt);
$ultimo                                                      = end($fragm);
$total_elementos                                             = count($fragm) - 1;
$concatenador                                                = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina                                                      = $concatenador."lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php";
//---------------------------------------------------------------------------------------------------------------------------------//
if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
        $condicional_consulta_tercero_rel = '';
        $condicional_consulta_cuenta_cobrar = '';
    } else { 
        $condicional_consulta_tercero = 'AND cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_tercero_rel = 'WHERE cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_cuenta_cobrar = 'WHERE cod_administrador = "'.$cod_administrador.'"';
    }

} else { 
	$condicional_consulta_tercero = ''; 
	$condicional_consulta_tercero_rel = '';
	$condicional_consulta_cuenta_cobrar = '';
}
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
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

if($action == 'ajax') {
    $busqueda_ajax                   = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
    $buscar_por                      = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));
    $numero_registro_por_pagina      = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['numero_registro_por_pagina'], ENT_QUOTES)));
    $cod_administrador               = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['cod_administrador'], ENT_QUOTES)));
    $cod_seguridad                   = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['cod_seguridad'], ENT_QUOTES)));
    $tabla                           = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
    $nombre_estado_factura           = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['nombre_estado_factura'], ENT_QUOTES)));
    $pagina                          = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['pagina'], ENT_QUOTES)));
}
if($busqueda_ajax <> NULL) {
	if($buscar_por == 'nombre1_tercero') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('tbl15_tercero.nombre1_tercero'); //Columnas de busqueda
	} elseif ($buscar_por == 'identificacion_tercero') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('tbl15_tercero.identificacion_tercero'); //Columnas de busqueda
	} elseif ($buscar_por == 'nombre1_tercero_identificacion_tercero') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('tbl15_tercero.nombre1_tercero', 'tbl15_tercero.identificacion_tercero', 'tbl15_entidad_crediticia.nombre_entidad_crediticia'); //Columnas de busqueda
	} else {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('tbl15_tercero.nombre1_tercero', 'tbl15_tercero.apellido1_tercero', 'tbl15_tercero.identificacion_tercero', 'tbl15_entidad_crediticia.nombre_entidad_crediticia'); //Columnas de busqueda
	}
}
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
$nombre_estado_factura                       = "ABIERTA";
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
    if($action == 'ajax') {
// escaping, additionally removing everything that could be (html/javascript-) code
     $sTable = "tbl15_tercero RIGHT JOIN tbl15_info_factura_venta ON tbl15_tercero.cod_tercero = tbl15_info_factura_venta.cod_tercero LEFT JOIN tbl15_entidad_crediticia ON tbl15_info_factura_venta.cod_entidad_crediticia = tbl15_entidad_crediticia.cod_entidad_crediticia";

     $sWhere = " WHERE (tbl15_info_factura_venta.cod_tienda = '$cod_tienda')";
    if ( $_GET['busqueda_ajax'] != "" ) {
        $sWhere = " WHERE (tbl15_info_factura_venta.cod_tienda = '$cod_tienda') AND ( ";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            $sWhere .= $aColumns[$i]." LIKE '$busq_aprox_der".$busqueda_ajax."$busq_aprox_izq' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
if ($_GET['busqueda_ajax'] == "") {
    $sWhere.=" ORDER BY tbl15_info_factura_venta.fecha_modificacion DESC";
} else {
    $sWhere.=" ORDER BY tbl15_info_factura_venta.fecha_modificacion DESC";
}

include_once('../admin/paginacion_ajax_buscador_sistecredito.php'); //include pagination file

    //pagination variables
    $page                        = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page                    = 10; //how much records you want to show
    $adjacents                   = 4; //gap between pages after number of adjacents
    $registro_inicio             = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $sql_cantidad_registros      = "SELECT count(*) AS cantidad_registros FROM $sTable $sWhere";
    $consulta_cantidad_registros = mysqli_query($conectar, $sql_cantidad_registros) or die(mysqli_error($conectar));
    $datos_cantidad_registros    = mysqli_fetch_array($consulta_cantidad_registros);
    $cantidad_registros          = $datos_cantidad_registros['cantidad_registros'];
    $total_pages                 = ceil($cantidad_registros/$per_page);
    $reload                      = '../admin/lista_info_factura_venta_abierta_siscredito_visitante_intern_aliado_estrategico_movil.php';
    //loop through fetched data
    $modo_venta_por_defecto = '';

    if ($cantidad_registros>0) { 

	$cod_cliente                              = 0;
	$conteo                                   = 0;
	$total_venta                              = 0;
	$incre                                    = 0;
	$smtr_iva_valor                           = 0;

	$tab                                      = 'tbl15_info_factura_venta';
	$tab2                                     = 'tbl15_info_factura_venta_archivar_por_tercero';
	$campo                                    = 'cod_tercero';
	$tipo                                     = 'eliminar';
	$total_monto_deuda_sum                    = 0;
	$total_abonado_sum                        = 0;
	$total_subtotal_sum                       = 0;
	$fecha_hoy                                = date("Y-m-d");

	$calcular_datos_cuenta_cobrar = "SELECT tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, tbl15_info_factura_venta.monto_deuda_sin_interes, 
    tbl15_info_factura_venta.nombre_tipo_cobro, tbl15_info_factura_venta.cod_tercero, tbl15_info_factura_venta.monto_deuda, 
    tbl15_info_factura_venta.monto_cuota, tbl15_info_factura_venta.cod_entidad_crediticia, tbl15_info_factura_venta.nombre_estado_factura, 
    tbl15_info_factura_venta.cod_resolucion_facturacion, tbl15_info_factura_venta.cod_estado_factura, tbl15_info_factura_venta.fecha_creacion, 
    tbl15_info_factura_venta.cod_tienda, tbl15_info_factura_venta.cod_administrador, tbl15_info_factura_venta.cod_tipo_pago, 
    tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, 
    tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.correo_tercero, 
    tbl15_info_factura_venta.cod_operador_credito, tbl15_info_factura_venta.cod_tipo_forma_pago_operador_credito, 
    tbl15_info_factura_venta.cod_administrador_lider, tbl15_info_factura_venta.cod_administrador_coordinador, tbl15_info_factura_venta.cod_administrador_asesor, 
    tbl15_info_factura_venta.cod_administrador_aliado_estrategico, tbl15_info_factura_venta.cod_administrador_revisor, 
    tbl15_info_factura_venta.cod_vendedor, tbl15_info_factura_venta.cod_banco_cuenta, tbl15_info_factura_venta.cod_tipo_forma_pago, tbl15_info_factura_venta.observacion_tercero, 
    tbl15_info_factura_venta.cod_estado_facturacion, tbl15_info_factura_venta.codigo_estado_facturacion, tbl15_info_factura_venta.codigo_tipo_estado_cargue_documentacion, 
    tbl15_info_factura_venta.cuenta, tbl15_info_factura_venta.cod_caja_virtual, tbl15_info_factura_venta.numero_cuota
	FROM $sTable $sWhere LIMIT $registro_inicio, $numero_registro_por_pagina";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
	while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

		$cod_info_factura_venta                                         = $datos_cuenta_cobrar['cod_info_factura_venta'];
		$monto_deuda_sin_interes                                        = $datos_cuenta_cobrar['monto_deuda_sin_interes'];
		$monto_deuda                                                    = $datos_cuenta_cobrar['monto_deuda'];
		$monto_cuota                                                    = $datos_cuenta_cobrar['monto_cuota'];
		$cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];
		$cod_factura                                                    = $datos_cuenta_cobrar['cod_factura'];
		$nombres_apellidos                                              = trim($datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero']);
		$direccion_tercero                                              = $datos_cuenta_cobrar['direccion_tercero'];
		$telefono1_tercero                                              = $datos_cuenta_cobrar['telefono1_tercero'];
		$identificacion_tercero                                         = $datos_cuenta_cobrar['identificacion_tercero'];
		$nombre_tipo_cobro                                              = $datos_cuenta_cobrar['nombre_tipo_cobro'];
		$correo_tercero                                                 = $datos_cuenta_cobrar['correo_tercero'];
		$nombre_estado_factura                                          = $datos_cuenta_cobrar['nombre_estado_factura'];
		$cod_resolucion_facturacion                                     = $datos_cuenta_cobrar['cod_resolucion_facturacion'];
		$cod_estado_factura                                             = $datos_cuenta_cobrar['cod_estado_factura'];
		$fecha_creacion                                                 = $datos_cuenta_cobrar['fecha_creacion'];
		$cod_administrador_factura                                      = $datos_cuenta_cobrar['cod_administrador'];
		$cod_tipo_pago                                                  = $datos_cuenta_cobrar['cod_tipo_pago'];
        $cod_tipo_forma_pago                                            = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
        $cod_entidad_crediticia                                         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
        $cod_tienda                                                     = $datos_cuenta_cobrar['cod_tienda'];
        $cod_operador_credito                                           = $datos_cuenta_cobrar['cod_operador_credito'];
        $cod_tipo_forma_pago_operador_credito                           = $datos_cuenta_cobrar['cod_tipo_forma_pago_operador_credito'];
        $cod_administrador_lider                                        = $datos_cuenta_cobrar['cod_administrador_lider'];
        $cod_administrador_coordinador                                  = $datos_cuenta_cobrar['cod_administrador_coordinador'];
        $cod_administrador_asesor                                       = $datos_cuenta_cobrar['cod_administrador_asesor'];
        $cod_administrador_aliado_estrategico                           = $datos_cuenta_cobrar['cod_administrador_aliado_estrategico'];
        $cod_administrador_revisor                                      = $datos_cuenta_cobrar['cod_administrador_revisor'];
        $cod_vendedor                                                   = $datos_cuenta_cobrar['cod_vendedor'];
        $cod_banco_cuenta                                               = $datos_cuenta_cobrar['cod_banco_cuenta'];
        $observacion_tercero                                            = $datos_cuenta_cobrar['observacion_tercero'];
        $cod_estado_facturacion                                         = $datos_cuenta_cobrar['cod_estado_facturacion'];
        $codigo_estado_facturacion                                      = $datos_cuenta_cobrar['codigo_estado_facturacion'];
        $codigo_tipo_estado_cargue_documentacion                           = $datos_cuenta_cobrar['codigo_tipo_estado_cargue_documentacion'];
        $cuenta                                                         = $datos_cuenta_cobrar['cuenta'];
        $cod_caja_virtual                                               = $datos_cuenta_cobrar['cod_caja_virtual'];
        $numero_cuota                                                   = $datos_cuenta_cobrar['numero_cuota'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_administrador_lider = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_lider')";
        $consulta_administrador_lider = mysqli_query($conectar, $sql_administrador_lider) or die(mysqli_error($conectar));
        $datos_administrador_lider = mysqli_fetch_assoc($consulta_administrador_lider);

        $nombres_apellidos_lider                                        = $datos_administrador_lider['nombres'].' '.$datos_administrador_lider['apellidos'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_administrador_coordinador = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_coordinador')";
        $consulta_administrador_coordinador = mysqli_query($conectar, $sql_administrador_coordinador) or die(mysqli_error($conectar));
        $datos_administrador_coordinador = mysqli_fetch_assoc($consulta_administrador_coordinador);

        $nombres_apellidos_coordinador                                  = $datos_administrador_coordinador['nombres'].' '.$datos_administrador_coordinador['apellidos'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_administrador_asesor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_asesor')";
        $consulta_administrador_asesor = mysqli_query($conectar, $sql_administrador_asesor) or die(mysqli_error($conectar));
        $datos_administrador_asesor = mysqli_fetch_assoc($consulta_administrador_asesor);

        $nombres_apellidos_asesor                                       = $datos_administrador_asesor['nombres'].' '.$datos_administrador_asesor['apellidos'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_administrador_aliado_estrategico = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_aliado_estrategico')";
        $consulta_administrador_aliado_estrategico = mysqli_query($conectar, $sql_administrador_aliado_estrategico) or die(mysqli_error($conectar));
        $datos_administrador_aliado_estrategico = mysqli_fetch_assoc($consulta_administrador_aliado_estrategico);

        $nombres_apellidos_aliado_estrategico                           = $datos_administrador_aliado_estrategico['nombres'].' '.$datos_administrador_aliado_estrategico['apellidos'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_administrador_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
        $consulta_administrador_revisor = mysqli_query($conectar, $sql_administrador_revisor) or die(mysqli_error($conectar));
        $datos_administrador_revisor = mysqli_fetch_assoc($consulta_administrador_revisor);

        $nombres_apellidos_revisor                                       = $datos_administrador_revisor['nombres'].' '.$datos_administrador_revisor['apellidos'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
        $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
        $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

        $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
        /* ----------------------------------------------------------------------------------------------------------/ */
		$sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
		$consulta_tienda = mysqli_query($conectar, $sql_tienda);
		$datos_tienda = mysqli_fetch_assoc($consulta_tienda);
        $existe_tienda = mysqli_num_rows($consulta_tienda);
        if ($existe_tienda > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

        $nombre_tienda                                                = $datos_tienda['nombre_tienda'] ?: "No especificada";
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
        $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
        $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

        $nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
        $consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
        $datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);
        $existe_banco_cuenta = mysqli_num_rows($consulta_banco_cuenta);
        if ($existe_banco_cuenta > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

        $nombre_banco_cuenta                                          = $datos_banco_cuenta['nombre_banco_cuenta'].$separador_texto.$datos_banco_cuenta['numero_banco_cuenta'] ?: "No especificado";
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_vendedor = "SELECT * FROM tbl15_vendedor WHERE (cod_vendedor = '$cod_vendedor')";
        $consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
        $datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);
        $existe_vendedor = mysqli_num_rows($consulta_vendedor);
        if ($existe_vendedor > 0) { $separador_texto = ' '; } else { $separador_texto = ''; }

        $nombre_vendedor                                              = $datos_vendedor['nombres'].$separador_texto.$datos_vendedor['apellidos'] ?: "No especificado";
        /* ----------------------------------------------------------------------------------------------------------/ */
		$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
		$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
		$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);
        $existe_tipo_pago = mysqli_num_rows($consulta_tipo_pago);
        if ($existe_tipo_pago > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

        $nombre_tipo_pago                                             = $datos_tipo_pago['nombre_tipo_pago'] ?: "No especificado";
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
        $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);
        $existe_tipo_forma_pago = mysqli_num_rows($consulta_tipo_forma_pago);
        if ($existe_tipo_forma_pago > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

        $nombre_tipo_forma_pago                                       = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_tipo_forma_pago_operador_credito = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_operador_credito')";
        $consulta_tipo_forma_pago_operador_credito = mysqli_query($conectar, $sql_tipo_forma_pago_operador_credito) or die(mysqli_error($conectar));
        $datos_tipo_forma_pago_operador_credito = mysqli_fetch_assoc($consulta_tipo_forma_pago_operador_credito);
        $existe_tipo_forma_pago_operador_credito = mysqli_num_rows($consulta_tipo_forma_pago_operador_credito);
        if ($existe_tipo_forma_pago_operador_credito > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

        $nombre_tipo_forma_pago_operador_credito                      = $datos_tipo_forma_pago_operador_credito['nombre_tipo_forma_pago'];
        /* ----------------------------------------------------------------------------------------------------------/ */
		// Obtener nombre del administrador (aliado)
		$sql_aliado = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_factura'";
		$consulta_aliado = mysqli_query($conectar, $sql_aliado);
		$datos_aliado = mysqli_fetch_assoc($consulta_aliado);
        $existe_aliado = mysqli_num_rows($consulta_aliado);
        if ($existe_aliado > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

        $nombre_aliado                                                = trim($datos_aliado['nombre1_tercero'].$separador_texto.$datos_aliado['apellido1_tercero']) ?: "No especificado";
        /* ----------------------------------------------------------------------------------------------------------/ */
	    $sql_estado_facturacion = "SELECT * FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$codigo_estado_facturacion')";
	    $consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion) or die(mysqli_error($conectar));
	    $datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

	    $nombre_estado_facturacion                                    = $datos_estado_facturacion['nombre_estado_facturacion'];
        $estilo_css_estado_factura                                    = $datos_estado_facturacion['color_fondo_celda_estado'];
        /* ----------------------------------------------------------------------------------------------------------/ */
		$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_nota_observacion DESC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$matriz_consulta = mysqli_fetch_assoc($consulta);

	    $cod_nota_observacion                                           = $matriz_consulta['cod_nota_observacion'];
	    $nombre_nota_observacion                                        = $matriz_consulta['nombre_nota_observacion'];
	    $fecha_ymd                                                      = $matriz_consulta['fecha_ymd'];
	    $fecha_hora                                                     = $matriz_consulta['fecha_hora'];
	    $cuenta                                                         = $matriz_consulta['cuenta'];
	    $url_img_orig_producto                                          = $matriz_consulta['url_img_orig_producto'];
	    $url_img_min_producto                                           = $matriz_consulta['url_img_min_producto'];
	    $cod_posicion                                                   = $matriz_consulta['cod_posicion'];
	    $active                                                         = $matriz_consulta['active'];
	    $codigo_estado_revision                                         = $matriz_consulta['codigo_estado_revision'];
		//---------------------------------------------------------------------------------------------------------------------------------//
	    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
	    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
	    $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

	    $nombre_estado_revision                                         = $datos_estado_revision['nombre_estado_revision'];
		//---------------------------------------------------------------------------------------------------------------------------------//
		$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
		$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
		$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

		$nombre_tipo_factura                                            = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
    //---------------------------------------------------------------------------------------------------------------------------------//
		$obtener_nota_observacion_cedula_en_mano = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO DEL CLIENTE CON CEDULA EN MANO')";
		$resultado_nota_observacion_cedula_en_mano = mysqli_query($conectar, $obtener_nota_observacion_cedula_en_mano) or die(mysqli_error($conectar));
		$info_nota_observacion_cedula_en_mano = mysqli_fetch_assoc($resultado_nota_observacion_cedula_en_mano);

		$url_img_min_producto_cedula_en_mano                            = $info_nota_observacion_cedula_en_mano['url_img_min_producto'];
    //---------------------------------------------------------------------------------------------------------------------------------//
		$obtener_nota_observacion_prod_const_entrega = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO CON EL PRODUCTO COMO CONSTANCIA DE ENTREGA')";
		$resultado_nota_observacion_prod_const_entrega = mysqli_query($conectar, $obtener_nota_observacion_prod_const_entrega) or die(mysqli_error($conectar));
		$info_nota_observacion_prod_const_entrega = mysqli_fetch_assoc($resultado_nota_observacion_prod_const_entrega);

		$url_img_min_producto_prod_const_entrega                        = $info_nota_observacion_prod_const_entrega['url_img_min_producto'];
        /* ----------------------------------------------------------------------------------------------------------/ */

        if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; $url_imprimir = '#'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; $url_imprimir = '../admin/venta_productos_opcion_imprimir_siscredito_visitante_intern.php?cod_info_factura_venta='.$cod_info_factura_venta; }
        /* ----------------------------------------------------------------------------------------------------------/ */
        $contanenar_nombre_producto                                      = "";
        $sql_venta_producto_temporal = "SELECT cod_producto_barra, nombre_producto, serial1_producto, serial2_producto FROM $tabla_productos_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
	    while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

            $cod_producto_barra                                         = $datos_venta_producto_temporal['cod_producto_barra'];
            $nombre_producto                                            = $datos_venta_producto_temporal['nombre_producto'];
            $serial1_producto                                           = $datos_venta_producto_temporal['serial1_producto'];
            $serial2_producto                                           = $datos_venta_producto_temporal['serial2_producto'];
            $contanenar_nombre_producto                                .= $nombre_producto.' '; 
        }
    //---------------------------------------------------------------------------------------------------------------------------------//
	    if ($cod_factura == '0') { $cod_factura = 'Sin asignar'; } else { $cod_factura = $cod_factura; }
    //---------------------------------------------------------------------------------------------------------------------------------//
		if (($url_img_min_producto_cedula_en_mano == '') AND ($url_img_min_producto_prod_const_entrega == '')) {
			$url_img_min_producto = '../imagenes/secretary.png';
		} elseif (($url_img_min_producto_cedula_en_mano <> '') AND ($url_img_min_producto_prod_const_entrega == '')) {
			$url_img_min_producto = $url_img_min_producto_cedula_en_mano;
		} elseif (($url_img_min_producto_cedula_en_mano == '') AND ($url_img_min_producto_prod_const_entrega <> '')) {
			$url_img_min_producto = $url_img_min_producto_prod_const_entrega;
		} elseif (($url_img_min_producto_cedula_en_mano <> '') AND ($url_img_min_producto_prod_const_entrega <> '')) {
			$url_img_min_producto = $url_img_min_producto_prod_const_entrega;
		} else {
			$url_img_min_producto = '../imagenes/secretary.png';
		}
        /* ----------------------------------------------------------------------------------------------------------/ */
		$fecha_formateada                                               = date('M d, Y', strtotime($fecha_creacion));
		$hora_formateada                                                = date('h:i A', strtotime($fecha_creacion));
?>
        <div class="card_app_movil_enrollment mb-3 p-3">
            <div class="d-flex flex-row align-items-start mb-3">
                <img class="avatar_app_movil_enrollment me-3" src="<?php echo $url_img_min_producto ?>" alt=""> 
                <div class="flex-grow-1">
                    <h6 id="estilo_nombres_apellidos" class="mb-1" style="cursor: pointer;" 
                        onclick='abrirModalDetalleCredito(
                            <?php echo json_encode($nombres_apellidos); ?>,
                            <?php echo json_encode($identificacion_tercero); ?>,
                            <?php echo json_encode(number_format($monto_deuda, 0, ',', '.')); ?>,
                            <?php echo json_encode(number_format($monto_deuda_sin_interes, 0, ',', '.')); ?>,
                            <?php echo json_encode(number_format($monto_cuota, 0, ',', '.')); ?>,
                            <?php echo json_encode($nombre_tipo_pago); ?>,
                            <?php echo json_encode($cod_entidad_crediticia); ?>,
                            <?php echo json_encode($nombre_entidad_crediticia); ?>,
                            <?php echo json_encode($nombre_operador_credito); ?>,
						    <?php echo json_encode($nombre_tienda); ?>,
                            <?php echo json_encode($nombre_aliado); ?>,
                            <?php echo json_encode($nombre_banco_cuenta); ?>,
                            <?php echo json_encode($nombre_estado_facturacion); ?>,
                            <?php echo json_encode($nombre_estado_revision); ?>,
                            <?php echo json_encode($nombres_apellidos_asesor); ?>,
                            <?php echo json_encode($observacion_tercero); ?>,
                            <?php echo json_encode($fecha_formateada); ?>,
                            <?php echo json_encode($hora_formateada); ?>,
                            <?php echo json_encode($contanenar_nombre_producto); ?>,
                            <?php echo json_encode($nombre_vendedor); ?>,
                            <?php echo json_encode($cod_tercero); ?>,
                            <?php echo json_encode($cod_info_factura_venta); ?>,
                            <?php echo json_encode($cod_vendedor); ?>,
                            <?php echo json_encode($cod_tienda); ?>,
                            <?php echo json_encode($cod_banco_cuenta); ?>,
                            <?php echo json_encode($numero_cuota); ?>
                        )'>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong><?php echo $nombres_apellidos ?></strong>
                            <div id="estilo_tipo_pago" class="tipo_pago_app_movil_enrollment <?php echo ($nombre_tipo_pago == 'CONTADO') ? 'tipo_pago_contado' : 'tipo_pago_credito'; ?>"><?php echo $nombre_tipo_pago ?></div>
                        </div>
                    </h6>
					<div class="d-flex justify-content-between align-items-center mb-2">
                        <p id="estilo_identificacion" class="mb-0 small"><strong>CC:</strong> <?php echo $identificacion_tercero ?></p>
                        <?php if (!empty($nombre_entidad_crediticia)) { ?>
                        <span id="estilo_entidad_crediticia" class="estado_credito_app_movil_enrollment_entidad"><?php echo $nombre_entidad_crediticia ?></span>
                        <?php } ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p id="estilo_id" class="mb-0 small"><strong>ID:</strong> <?php echo $cod_info_factura_venta ?></p>
                        <?php if (!empty($monto_deuda) && $monto_deuda > 0) { ?>
                            <span id="estilo_precio" class="precio_credito_app_movil_enrollment flex-shrink-0">$<?php echo number_format($monto_deuda, 0, ",", ".") ?></span>
                        <?php } ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2" style="gap: 0.75rem;">
                        <p id="estilo_nombre_producto" class="mb-0 small flex-shrink-1" style="margin-right: 0.5rem;"><strong>Producto:</strong> <?php echo $nombre_producto ?></p>
                        <span id="estilo_estado" class="estado_credito_app_movil_enrollment flex-shrink-0 <?php echo $estilo_css_estado_factura ?>"><?php echo $nombre_estado_facturacion ?></span>
                    </div>

                    <?php if ($codigo_tipo_estado_cargue_documentacion == '0') { ?><!-- SIN CARGUE DE DOCUMENTACIÓN INICIAL -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="btn_procesar_solicitud" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_tercero="<?php echo $cod_tercero; ?>" class="btn_estudio_movil_enrollment w-100">Cargar imagenes</button>
                            <!--<button id="btn_procesar_solicitud" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_tercero="<?php echo $cod_tercero; ?>" class="btn_estudio_movil_enrollment w-100">Cargar imagenes</button>-->
                        </div>
                    </div>
                    <?php } elseif ($codigo_tipo_estado_cargue_documentacion == '1') { ?><!-- SIN CARGUE DE DOCUMENTACIÓN FINAL -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="btn_procesar_otras_imagenes" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_tercero="<?php echo $cod_tercero; ?>" class="btn_estudio_movil_enrollment w-100">Cargar imagenes finales</button>
                            <p id="texto_aviso" class="estilo_rainbow_shine">Atento al grupo de whatsapp para envío del código o link al cliente</p>
                        </div>
                    </div>
                    <?php } elseif ($codigo_tipo_estado_cargue_documentacion == '2') { ?><!-- TODOS LOS DOCUMENTOS OBLIGATORIOS CARGADOS -->
                    <div class="row mt-2">
                        <div class="col-6">
                            <button id="btn_asignar_vendedor" class="btn btn-primary btn-sm btn-block btn-asignar-vendedor" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_vendedor="<?php echo $cod_vendedor; ?>" <?php echo ($cod_vendedor != '0' && $cod_vendedor != '' && !empty($cod_vendedor)) ? 'disabled' : ''; ?>>Asignar vendedor</button>
                        </div>
                        <div class="col-6">
                            <button id="btn_asignar_cuenta_banco" class="btn btn-secondary btn-sm btn-block btn-asignar-banco-cuenta" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_banco_cuenta="<?php echo $cod_banco_cuenta; ?>" <?php echo ($cod_banco_cuenta != '0' && $cod_banco_cuenta != '' && !empty($cod_banco_cuenta)) ? 'disabled' : ''; ?>>Asignar cuenta banco</button>
                        </div>
                    </div>
                    <?php } elseif ($codigo_tipo_estado_cargue_documentacion == '3') { ?><!-- Venta Aprobada -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <a href="../admin/ver_factura_venta_siscredito_visitante_intern_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>" target='_blank' id="btn_descargar_factura_venta"><div id="nombre_boton_accion"><button class="btn_estudio_movil_enrollment w-100">Ver Factura de Venta</button></div></a>
                        </div>
                    </div>
                    <?php } else { ?>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php } ?>
        <?php } else { ?> 
            <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php    
        }
    }
?>
<!--
estilo_neon_pulse - Efecto neón pulsante
estilo_fire_alert - Alerta de fuego
estilo_electric_blue - Azul eléctrico
estilo_rainbow_shine - Brillo arcoíris
estilo_cyber_green - Verde cibernético
estilo_sunset_warning - Advertencia atardecer
estilo_galaxy_purple - Púrpura galaxia
estilo_matrix_code - Código Matrix
estilo_tropical_sunset - Atardecer tropical
estilo_crystal_ice - Hielo cristal
estilo_lava_flow - Flujo de lava
estilo_hologram - Holograma
-->

<div class="modal fade" id="modalDetalleCredito" tabindex="-1" aria-labelledby="modalDetalleCreditoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
            <!-- Header con gradiente morado -->
            <div class="modal-header modal-detalle-header">
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">×</span>
                </button>
                <div style="text-align: center; width: 100%;">
                    <div style="margin-bottom: 1rem;">
                        <span id="modalEstadoCredito" class="estado-badge"></span>
                    </div>
                    <h4 style="font-weight: 700; font-size: 1.8rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa fa-user-circle"></i>
                        <span id="modalNombreCliente"></span>
                    </h4>
                    <p style="margin: 0.5rem 0 0 0; font-size: 1rem; opacity: 0.9;">
                        <i class="fa fa-id-card" style="margin-right: 0.5rem;"></i>CC: <span id="modalCedulaCliente"></span>
                    </p>
                </div>
            </div>

            <!-- Sección: Información del Producto -->
            <div class="modal-body detalle-section">
                <div class="section-divider-detalle">
                    <span><i class="fa fa-box"></i> Información del Producto</span>
                </div>
                
                <div class="detalle-info-box" style="text-align: center; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);">
                    <p class="detalle-label" style="justify-content: center;"><i class="fa fa-shopping-bag"></i> Producto</p>
                    <p class="detalle-value-large" id="modalNombreProducto"></p>
                </div>
                
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-credit-card"></i> Valor a Crédito</p>
                            <p class="detalle-value-large" style="color: #10b981;">$<span id="modalValorCredito"></span></p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-money"></i> Valor de Contado</p>
                            <p class="detalle-value-large" style="color: #3b82f6;">$<span id="modalTotalPrecioVenta"></span></p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-calendar-check-o"></i> Número de Cuotas</p>
                            <p class="detalle-value-large" style="color: #f59e0b;"><span id="modalNumeroCuotas"></span></p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-calendar-o"></i> Cuota Mensual</p>
                            <p class="detalle-value-large" style="color: #8b5cf6;">$<span id="modalMontoCuota"></span></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-shopping-cart"></i> Tipo de Venta</p>
                            <p class="detalle-value" id="modalTipoVenta"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-bank"></i> Línea de Crédito</p>
                            <p class="detalle-value" id="modal_entidad_crediticia"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button type="button" id="btnEditarEntidadCrediticia" onclick="abrirModalCambiarEntidadCrediticia(document.getElementById('modalIDApp').textContent, document.getElementById('modalCodEntidadCrediticia').value)" class="btn-detalle-action">
                            <i class="fa fa-edit"></i> Editar linea de credito y valores
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sección: Información Adicional -->
            <div class="modal-body detalle-section">
                <div class="section-divider-detalle">
                    <span><i class="fa fa-info-circle"></i> Información Adicional</span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-user-tie"></i> Vendedor</p>
                            <p class="detalle-value" id="modalNombresApellidosVendedor"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-university"></i> Cuenta de Banco</p>
                            <p class="detalle-value" id="modal_nombre_banco_cuenta"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-comment"></i> Observaciones</p>
                            <p class="detalle-value" id="modal_observacion_tercero" style="font-size: 0.95rem; font-weight: 400;"></p>
                            <button type="button" onclick="abrirModalEditarObservacion(document.getElementById('modalIDApp').textContent, document.getElementById('modal_observacion_tercero').textContent)" class="btn-detalle-action mt-2">
                                <i class="fa fa-edit"></i> Editar
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-hashtag"></i> ID Solicitud</p>
                            <p class="detalle-value-large" id="modalIDApp" style="color: #667eea;"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sección: Imágenes Capturadas -->
            <div class="modal-body detalle-section">
                <div class="section-divider-detalle">
                    <span><i class="fa fa-camera"></i> Imágenes Capturadas</span>
                </div>
                <div id="modal_imagenes_container" class="imagenes-grid">
                    <!-- Las imágenes se cargarán dinámicamente aquí -->
                    <div style="text-align: center; color: #718096; padding: 2rem; grid-column: 1/-1;">
                        <i class="fa fa-image" style="font-size: 2.5rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                        <p style="font-size: 0.9rem; margin: 0;">Cargando imágenes...</p>
                    </div>
                </div>
            </div>

            <!-- Sección: Fecha y Tienda -->
            <div class="modal-body detalle-section">
                <div class="row">
                    <div class="col-md-4">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-calendar"></i> Fecha</p>
                            <p class="detalle-value" id="modalFechaCreacion"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-clock-o"></i> Hora</p>
                            <p class="detalle-value" id="modalHora"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detalle-info-box">
                            <p class="detalle-label"><i class="fa fa-store"></i> Tienda</p>
                            <p class="detalle-value" id="modalTienda"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer" style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 1.5rem; justify-content: center;">
                <button type="button" id="btnCerrarModalDetalleCredito" class="btn btn-detalle-action" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="padding: 1rem 3rem; font-size: 1rem;">
                    <i class="fa fa-times-circle"></i> Cerrar
                </button>
            </div>
            <!-- Campos ocultos para almacenar datos -->
            <input type="hidden" id="modalCodEntidadCrediticia" value="">
            <input type="hidden" id="modalCodVendedor" value="">
            <input type="hidden" id="modalCodBancoCuenta" value="">
            <input type="hidden" id="modalCodTienda" value="">
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Vendedor -->
<div class="modal fade" id="modalCambiarVendedor" tabindex="-1" aria-labelledby="modalCambiarVendedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalCambiarVendedorLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-edit" style="margin-right: 8px;"></i>Cambiar Vendedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formCambiarVendedor">
                    <input type="hidden" id="CambiarVendedorCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="CambiarVendedorCodActual" name="cod_vendedor_actual">
                    
                    <div class="mb-3">
                        <label for="CambiarVendedorSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Vendedor</label>
                        <select id="CambiarVendedorSelect" name="cod_vendedor" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando vendedores...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertCambiarVendedor" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarCambiarVendedor" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarCambiarVendedor" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Asignar Vendedor (duplicado de Cambiar Vendedor) -->
<div class="modal fade" id="modalAsignarVendedor" tabindex="-1" aria-labelledby="modalAsignarVendedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalAsignarVendedorLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-user-plus" style="margin-right: 8px;"></i>Asignar Vendedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formAsignarVendedor">
                    <input type="hidden" id="AsignarVendedorCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="AsignarVendedorCodActual" name="cod_vendedor_actual">
            
                    <div class="mb-3">
                        <label for="AsignarVendedorSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Vendedor</label>
                        <select id="AsignarVendedorSelect" name="cod_vendedor" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando vendedores...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertAsignarVendedor" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarAsignarVendedor" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarAsignarVendedor" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Asignación</button>
            </div>
        </div>
    </div>
</div>

        <!-- Modal Registrar Vendedor -->
<div class="modal fade" id="modalRegistrarVendedor" tabindex="-1" aria-labelledby="modalRegistrarVendedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalRegistrarVendedorLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-plus" style="margin-right: 8px;"></i>Registrar Nuevo Vendedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formRegistrarVendedor">
                    <input type="hidden" id="registrarVendedorCodInfoFactura" name="cod_info_factura_venta">

                    <div class="mb-3">
                        <label for="registrarVendedorCedula" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Documento * </label>
                        <input type="number" id="registrarVendedorCedula" name="cedula" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registrarVendedorNombres" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombres *</label>
                            <input type="text" id="registrarVendedorNombres" name="nombres" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registrarVendedorApellidos" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Apellidos *</label>
                            <input type="text" id="registrarVendedorApellidos" name="apellidos" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                    </div>
                    <div class="alert" id="alertRegistrarVendedor" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarRegistrarVendedor" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarRegistrarVendedor" class="btn" style="background: linear-gradient(90deg, #10b981, #059669); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Registrar Vendedor</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Banco Cuenta -->
<div class="modal fade" id="modalCambiarBancoCuenta" tabindex="-1" aria-labelledby="modalCambiarBancoCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalCambiarBancoCuentaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-university" style="margin-right: 8px;"></i>Cambiar Cuenta Bancaria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formCambiarBancoCuenta">
                    <input type="hidden" id="CambiarBancoCuentaCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="CambiarBancoCuentaCodActual" name="cod_banco_cuenta_actual">
                    
                    <div class="mb-3">
                        <label for="CambiarBancoCuentaSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Cuenta Bancaria</label>
                        <select id="CambiarBancoCuentaSelect" name="cod_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando cuentas bancarias...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertCambiarBancoCuenta" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarCambiarBancoCuenta" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarCambiarBancoCuenta" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Asignar Cuenta Banco (duplicado de Cambiar Cuenta Banco) -->
<div class="modal fade" id="modalAsignarBancoCuenta" tabindex="-1" aria-labelledby="modalAsignarBancoCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalAsignarBancoCuentaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-university" style="margin-right: 8px;"></i>Asignar Cuenta Bancaria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formAsignarBancoCuenta">
                    <input type="hidden" id="AsignarBancoCuentaCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="AsignarBancoCuentaCodActual" name="cod_banco_cuenta_actual">
                    
                    <div class="mb-3">
                        <label for="AsignarBancoCuentaSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Cuenta Bancaria</label>
                        <select id="AsignarBancoCuentaSelect" name="cod_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando cuentas bancarias...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertAsignarBancoCuenta" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarAsignarBancoCuenta" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarAsignarBancoCuenta" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Asignación</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Banco Cuenta -->
<div class="modal fade" id="modalRegistrarBancoCuenta" tabindex="-1" aria-labelledby="modalRegistrarBancoCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalRegistrarBancoCuentaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-plus-circle" style="margin-right: 8px;"></i>Registrar Nueva Cuenta Bancaria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formRegistrarBancoCuenta">
                    <input type="hidden" id="registrarBancoCuentaCodInfoFactura" name="cod_info_factura_venta">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaNumero" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombre del Banco *</label>
                            <input type="text" id="registrarBancoCuentaNombre" name="nombre_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaNumero" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Número de Cuenta *</label>
                            <input type="text" id="registrarBancoCuentaNumero" name="numero_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaTitular" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombre del Titular de la Cuenta</label>
                            <input type="text" id="registrarBancoCuentaTitular" name="nombre_titular_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaIdentificacion" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Documento del titular de la cuenta</label>
                            <input type="text" id="registrarBancoCuentaIdentificacion" name="identificacion_titular_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                    </div>  

                    <div class="alert" id="alertRegistrarBancoCuenta" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarRegistrarBancoCuenta" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarRegistrarBancoCuenta" class="btn" style="background: linear-gradient(90deg, #10b981, #059669); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Registrar Cuenta</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Tienda -->
<div class="modal fade" id="modalCambiarTienda" tabindex="-1" aria-labelledby="modalCambiarTiendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalCambiarTiendaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-store" style="margin-right: 8px;"></i>Cambiar Tienda
                </h5>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formCambiarTienda">
                    <div class="form-group mb-3">
                        <label for="CambiarTiendaSelect" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Seleccione la Tienda</label>
                        <select class="form-control" id="CambiarTiendaSelect" name="cod_tienda" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto !important; min-height: 45px !important; line-height: 1.5 !important; font-size: 1rem !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important;">
                            <option value="" style="background: #1a1d3a; color: white;">Cargando...</option>
                        </select>
                    </div>
                    <div class="alert" id="alertCambiarTienda" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarCambiarTienda" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarCambiarTienda" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Tienda -->
<div class="modal fade" id="modalRegistrarTienda" tabindex="-1" aria-labelledby="modalRegistrarTiendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalRegistrarTiendaLabel" style="font-weight: 700; color: #10b981;">
                    <i class="fa fa-plus-circle" style="margin-right: 8px;"></i>Registrar Nueva Tienda
                </h5>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formRegistrarTienda">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="registrarTiendaNombre" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Nombre de la Tienda *</label>
                            <input type="text" class="form-control" id="registrarTiendaNombre" name="nombre_tienda" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="registrarTiendaDireccion" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Dirección</label>
                            <input type="text" class="form-control" id="registrarTiendaDireccion" name="direccion_tienda" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="registrarTiendaTelefono" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Teléfono</label>
                            <input type="text" class="form-control" id="registrarTiendaTelefono" name="telefono_tienda" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                        </div>
                    </div>  

                    <div class="alert" id="alertRegistrarTienda" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarRegistrarTienda" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarRegistrarTienda" class="btn" style="background: linear-gradient(90deg, #10b981, #059669); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Registrar Tienda</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Observación -->
<div class="modal fade" id="modalEditarObservacion" tabindex="-1" aria-labelledby="modalEditarObservacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalEditarObservacionLabel" style="color: #00d4ff; font-weight: 700; margin: 0;">
                    <i class="fa fa-edit" style="margin-right: 8px;"></i>Editar Observación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="display: none;" id="alertEditarObservacion" class="alert" role="alert"></div>
                
                <input type="hidden" id="editarObservacionCodInfoFactura" value="">
                
                <div style="margin-bottom: 1rem;">
                    <label for="editarObservacionTexto" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Observación</label>
                    <textarea class="form-control" id="editarObservacionTexto" rows="5" 
                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; resize: vertical; font-size: 1rem;"
                        placeholder="Escriba la observación..."></textarea>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarEditarObservacion" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarEditarObservacion" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Imágenes Faltantes -->
<div class="modal fade" id="modalImagenesFaltantes" tabindex="-1" aria-labelledby="modalImagenesFaltantesLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalImagenesFaltantesLabel" style="color: #00d4ff; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>Imágenes Obligatorias Faltantes
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p style="margin: 0; color: #ff8787; font-size: 0.95rem; font-weight: 500;">
                        <i class="fa fa-info-circle" style="margin-right: 6px;"></i>
                        Faltan las siguientes imágenes obligatorias:
                    </p>
                </div>
                
                <div id="listaImagenesFaltantes" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(102, 126, 234, 0.2); border-radius: 8px; padding: 1rem;">
                    <!-- La lista se llenará dinámicamente -->
                </div>

                <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(0, 212, 255, 0.1); border-radius: 8px; border-left: 4px solid #00d4ff;">
                    <p style="margin: 0; color: #cbd5e0; font-size: 0.9rem;">
                        <i class="fa fa-camera" style="margin-right: 6px; color: #00d4ff;"></i>
                        Por favor, capture todas las imágenes marcadas con <span style="color: #ff5757; font-weight: 700;">(*)</span> antes de continuar.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; justify-content: center;">
                <button type="button" id="btnCerrarModalImagenes" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 2rem; font-weight: 600;">
                    <i class="fa fa-check" style="margin-right: 6px;"></i>Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación Eliminar Foto -->
<div class="modal fade" id="modalConfirmarEliminarFoto" tabindex="-1" aria-labelledby="modalConfirmarEliminarFotoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalConfirmarEliminarFotoLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-trash" style="margin-right: 8px;"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
<!--
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="display: inline-block; width: 80px; height: 80px; background: rgba(255, 87, 87, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fa fa-exclamation-triangle" style="font-size: 2.5rem; color: #ff5757;"></i>
                    </div>
                </div>
-->
                
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p style="margin: 0; color: #fff; font-size: 1rem; font-weight: 500; text-align: center;">
                        ¿Está seguro de que desea eliminar esta foto?
                    </p>
                </div>

                <div style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
                    <p style="margin: 0; color: #cbd5e0; font-size: 0.9rem; text-align: center;">
                        <i class="fa fa-info-circle" style="margin-right: 6px; color: #00d4ff;"></i>
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem; justify-content: center;">
                <button type="button" id="btnCancelarEliminarFoto" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">
                    <i class="fa fa-times" style="margin-right: 6px;"></i>Cancelar
                </button>
                <button type="button" id="btnConfirmarEliminarFoto" class="btn" style="background: linear-gradient(90deg, #ff5757, #ff3838); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">
                    <i class="fa fa-trash" style="margin-right: 6px;"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Datos Requeridos -->
<div class="modal fade" id="modalErrorDatosRequeridos" tabindex="-1" aria-labelledby="modalErrorDatosRequeridosLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorDatosRequeridosLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-circle" style="margin-right: 8px;"></i>Error de Validación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="display: inline-block; width: 80px; height: 80px; background: rgba(255, 87, 87, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fa fa-times-circle" style="font-size: 2.5rem; color: #ff5757;"></i>
                    </div>
                </div>
                
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p id="mensajeErrorDatosRequeridos" style="margin: 0; color: #fff; font-size: 1rem; font-weight: 500; text-align: center;">
                        Faltan datos requeridos para procesar las imágenes.
                    </p>
                </div>

                <div style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
                    <p style="margin: 0; color: #cbd5e0; font-size: 0.9rem; text-align: center;">
                        <i class="fa fa-info-circle" style="margin-right: 6px; color: #00d4ff;"></i>
                        Por favor, verifica que todos los campos necesarios estén completos.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; justify-content: center;">
                <button type="button" id="btnCerrarModalError" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 2rem; font-weight: 600;">
                    <i class="fa fa-check" style="margin-right: 6px;"></i>Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Navegador Sin Soporte de Cámara -->
<div class="modal fade" id="modalErrorNavegadorCamara" tabindex="-1" aria-labelledby="modalErrorNavegadorCamaraLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorNavegadorCamaraLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>Navegador No Compatible
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-chrome" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center;">
                    Su navegador no soporta acceso a la cámara.
                </p>
                <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; text-align: center; margin-bottom: 1.5rem;">
                    Por favor, use un navegador más reciente como:
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 1.5rem; color: #e0e0e0;">
                        <li style="margin-bottom: 0.5rem;"><i class="fa fa-chrome" style="margin-right: 8px; color: #00d4ff;"></i>Google Chrome</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fa fa-firefox" style="margin-right: 8px; color: #00d4ff;"></i>Mozilla Firefox</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fa fa-edge" style="margin-right: 8px; color: #00d4ff;"></i>Microsoft Edge</li>
                        <li><i class="fa fa-safari" style="margin-right: 8px; color: #00d4ff;"></i>Safari</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Motivo Rechazo Vacío -->
<div class="modal fade" id="modalErrorMotivoRechazoVacio" tabindex="-1" aria-labelledby="modalErrorMotivoRechazoVacioLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 193, 7, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorMotivoRechazoVacioLabel" style="color: #ffc107; font-weight: 700; margin: 0;">
                    <i class="fa fa-edit" style="margin-right: 8px;"></i>Campo Requerido
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-pencil-square-o" style="font-size: 4rem; color: #ffc107; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    Por favor, ingrese el motivo del rechazo.
                </p>
                <div style="background: rgba(255, 193, 7, 0.1); border-left: 3px solid #ffc107; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Es necesario especificar el motivo del rechazo antes de continuar.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 193, 7, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" id="btnCerrarMotivoRechazoVacio" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Código de Factura No Encontrado -->
<div class="modal fade" id="modalErrorCodigoFacturaNoEncontrado" tabindex="-1" aria-labelledby="modalErrorCodigoFacturaNoEncontradoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorCodigoFacturaNoEncontradoLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Error de Sistema
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-file-text-o" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    No se encontró el código de factura.
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Por favor, verifique que la factura esté correctamente seleccionada o intente nuevamente.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Éxito Solicitud Rechazada -->
<div class="modal fade" id="modalExitoSolicitudRechazada" tabindex="-1" aria-labelledby="modalExitoSolicitudRechazadaLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(76, 175, 80, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalExitoSolicitudRechazadaLabel" style="color: #4caf50; font-weight: 700; margin: 0;">
                    <i class="fa fa-check-circle" style="margin-right: 8px;"></i>Éxito
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-check-circle" style="font-size: 4rem; color: #4caf50; opacity: 0.9;"></i>
                </div>
                <p id="mensajeExitoRechazo" style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    Solicitud rechazada correctamente.
                </p>
                <div style="background: rgba(76, 175, 80, 0.1); border-left: 3px solid #4caf50; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        La solicitud ha sido rechazada exitosamente y se actualizará la lista.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(76, 175, 80, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" id="btnCerrarExitoRechazo" style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error al Rechazar Solicitud -->
<div class="modal fade" id="modalErrorRechazarSolicitud" tabindex="-1" aria-labelledby="modalErrorRechazarSolicitudLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorRechazarSolicitudLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Error
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-exclamation-triangle" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p id="mensajeErrorRechazo" style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    No se pudo rechazar la solicitud.
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Por favor, verifique la información e intente nuevamente.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error de Conexión al Rechazar -->
<div class="modal fade" id="modalErrorConexionRechazo" tabindex="-1" aria-labelledby="modalErrorConexionRechazoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorConexionRechazoLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-wifi" style="margin-right: 8px;"></i>Error de Conexión
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-plug" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    Error al procesar el rechazo.
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        No se pudo conectar con el servidor. Por favor, verifique su conexión e intente nuevamente.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Cámara No Lista -->
<div class="modal fade" id="modalErrorCamaraNoLista" tabindex="-1" aria-labelledby="modalErrorCamaraNoListaLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 193, 7, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorCamaraNoListaLabel" style="color: #ffc107; font-weight: 700; margin: 0;">
                    <i class="fa fa-video-camera" style="margin-right: 8px;"></i>Cámara No Disponible
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-camera" style="font-size: 4rem; color: #ffc107; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    La cámara no está lista.
                </p>
                <div style="background: rgba(255, 193, 7, 0.1); border-left: 3px solid #ffc107; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Por favor, espere un momento e intente nuevamente. Asegúrese de haber otorgado los permisos necesarios.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 193, 7, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Marco de Captura No Encontrado -->
<div class="modal fade" id="modalErrorMarcoNoEncontrado" tabindex="-1" aria-labelledby="modalErrorMarcoNoEncontradoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorMarcoNoEncontradoLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>Error de Configuración
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-square-o" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    No se encontró el marco de captura.
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Por favor, recargue la página e intente nuevamente. Si el problema persiste, contacte al administrador.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error: Error al capturar foto -->
<div class="modal fade" id="modalErrorCapturarFoto" tabindex="-1" aria-labelledby="modalErrorCapturarFotoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.3); background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);">
            <div class="modal-header" style="border-bottom: 2px solid #00d4ff; padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorCapturarFotoLabel" style="color: #ff5757; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-triangle" style="font-size: 1.5rem;"></i>
                    Error al Capturar Foto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; color: #e0e0e0;">
                <p style="margin-bottom: 1rem; font-size: 1rem; line-height: 1.6;">
                    <i class="fa fa-camera" style="color: #ff5757; margin-right: 8px;"></i>
                    No se pudo capturar la fotografía correctamente.
                </p>
                <p style="margin-bottom: 1rem; font-size: 0.95rem; color: #b0b0b0;">
                    Posibles causas:
                </p>
                <ul style="color: #b0b0b0; font-size: 0.9rem; margin-left: 1rem;">
                    <li>Error de conexión con el servidor</li>
                    <li>Problema con la cámara o permisos</li>
                    <li>Formato de imagen no válido</li>
                </ul>
                <p style="margin-bottom: 0; font-size: 0.95rem; color: #ffc107;">
                    <i class="fa fa-lightbulb-o" style="margin-right: 8px;"></i>
                    Por favor, inténtalo de nuevo en unos momentos.
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1rem 1.5rem;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #ff5757 0%, #ff7b7b 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;">
                    <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error: Error al guardar foto en servidor -->
<div class="modal fade" id="modalErrorGuardarFoto" tabindex="-1" aria-labelledby="modalErrorGuardarFotoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.3); background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);">
            <div class="modal-header" style="border-bottom: 2px solid #00d4ff; padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorGuardarFotoLabel" style="color: #ff5757; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-database" style="font-size: 1.5rem;"></i>
                    Error al Guardar Foto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; color: #e0e0e0;">
                <p style="margin-bottom: 1rem; font-size: 1rem; line-height: 1.6;">
                    <i class="fa fa-exclamation-circle" style="color: #ff5757; margin-right: 8px;"></i>
                    No se pudo guardar la fotografía en el servidor.
                </p>
                <div style="background: rgba(255,87,87,0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                    <p style="margin: 0; font-size: 0.9rem; color: #ffb3b3; font-weight: 500;">
                        <i class="fa fa-info-circle" style="margin-right: 8px;"></i>
                        <strong>Detalle:</strong>
                    </p>
                    <p id="mensajeErrorGuardarFoto" style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: #e0e0e0;"></p>
                </div>
                <p style="margin-bottom: 0; font-size: 0.95rem; color: #ffc107;">
                    <i class="fa fa-lightbulb-o" style="margin-right: 8px;"></i>
                    Verifica tu conexión e inténtalo nuevamente.
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1rem 1.5rem;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #ff5757 0%, #ff7b7b 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;">
                    <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error: Error al eliminar foto -->
<div class="modal fade" id="modalErrorEliminarFoto" tabindex="-1" aria-labelledby="modalErrorEliminarFotoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.3); background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);">
            <div class="modal-header" style="border-bottom: 2px solid #00d4ff; padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorEliminarFotoLabel" style="color: #ff5757; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-trash" style="font-size: 1.5rem;"></i>
                    Error al Eliminar Foto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; color: #e0e0e0;">
                <p style="margin-bottom: 1rem; font-size: 1rem; line-height: 1.6;">
                    <i class="fa fa-exclamation-circle" style="color: #ff5757; margin-right: 8px;"></i>
                    No se pudo eliminar la fotografía del servidor.
                </p>
                <div style="background: rgba(255,87,87,0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                    <p style="margin: 0; font-size: 0.9rem; color: #ffb3b3; font-weight: 500;">
                        <i class="fa fa-info-circle" style="margin-right: 8px;"></i>
                        <strong>Detalle:</strong>
                    </p>
                    <p id="mensajeErrorEliminarFoto" style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: #e0e0e0;"></p>
                </div>
                <p style="margin-bottom: 0; font-size: 0.95rem; color: #ffc107;">
                    <i class="fa fa-lightbulb-o" style="margin-right: 8px;"></i>
                    Verifica tu conexión e inténtalo nuevamente.
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1rem 1.5rem;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #ff5757 0%, #ff7b7b 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;">
                    <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Error - Código de factura no encontrado (WhatsApp) -->
<div class="modal fade" id="modalErrorCodigoFacturaWhatsapp" tabindex="-1" aria-labelledby="modalErrorCodigoFacturaWhatsappLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0, 212, 255, 0.3); background: rgba(255, 193, 7, 0.1);">
                <h5 class="modal-title" id="modalErrorCodigoFacturaWhatsappLabel" style="color: #ffc107; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-triangle"></i>
                    Código de Factura No Encontrado
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #00d4ff; opacity: 0.8; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #e0e0e0; padding: 25px;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <i class="fa fa-file-text-o" style="font-size: 48px; color: #ffc107;"></i>
                </div>
                <p style="text-align: center; font-size: 16px; margin-bottom: 0;">
                    No se encontró el código de factura para enviar la notificación por WhatsApp.
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0, 212, 255, 0.3); justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: #0a0e27; border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4); transition: all 0.3s ease;">
                    <i class="fa fa-check"></i> Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Error - Datos necesarios no encontrados -->
<div class="modal fade" id="modalErrorDatosNecesarios" tabindex="-1" aria-labelledby="modalErrorDatosNecesariosLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0, 212, 255, 0.3); background: rgba(255, 87, 87, 0.1);">
                <h5 class="modal-title" id="modalErrorDatosNecesariosLabel" style="color: #ff5757; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-circle"></i>
                    Datos Necesarios No Encontrados
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #00d4ff; opacity: 0.8; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #e0e0e0; padding: 25px;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <i class="fa fa-database" style="font-size: 48px; color: #ff5757;"></i>
                </div>
                <p style="text-align: center; font-size: 16px; margin-bottom: 0;">
                    No se encontraron los datos necesarios para procesar esta solicitud.
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0, 212, 255, 0.3); justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #ff5757 0%, #ff7b7b 100%); color: white; border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 87, 87, 0.4); transition: all 0.3s ease;">
                    <i class="fa fa-times-circle"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Error - Número de cuotas inválido -->
<div class="modal fade" id="modalErrorNumeroCuotas" tabindex="-1" aria-labelledby="modalErrorNumeroCuotasLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0, 212, 255, 0.3); background: rgba(255, 193, 7, 0.1);">
                <h5 class="modal-title" id="modalErrorNumeroCuotasLabel" style="color: #ffc107; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-triangle"></i>
                    Número de Cuotas Inválido
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #00d4ff; opacity: 0.8; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #e0e0e0; padding: 25px;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <i class="fa fa-calculator" style="font-size: 48px; color: #ffc107;"></i>
                </div>
                <p style="text-align: center; font-size: 16px; margin-bottom: 0;">
                    Por favor ingrese un número de cuotas válido (mayor a 0).
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0, 212, 255, 0.3); justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: #0a0e27; border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4); transition: all 0.3s ease;">
                    <i class="fa fa-check"></i> Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Error - Valor de contado inválido -->
<div class="modal fade" id="modalErrorValorContado" tabindex="-1" aria-labelledby="modalErrorValorContadoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0, 212, 255, 0.3); background: rgba(255, 193, 7, 0.1);">
                <h5 class="modal-title" id="modalErrorValorContadoLabel" style="color: #ffc107; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-triangle"></i>
                    Valor de Contado Inválido
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #00d4ff; opacity: 0.8; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #e0e0e0; padding: 25px;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <i class="fa fa-dollar" style="font-size: 48px; color: #ffc107;"></i>
                </div>
                <p style="text-align: center; font-size: 16px; margin-bottom: 0;">
                    Por favor ingrese un valor de contado válido (mayor a 0).
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0, 212, 255, 0.3); justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: #0a0e27; border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4); transition: all 0.3s ease;">
                    <i class="fa fa-check"></i> Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Error - Entidad crediticia no seleccionada -->
<div class="modal fade" id="modalErrorEntidadCrediticia" tabindex="-1" aria-labelledby="modalErrorEntidadCrediticiaLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0, 212, 255, 0.3); background: rgba(255, 193, 7, 0.1);">
                <h5 class="modal-title" id="modalErrorEntidadCrediticiaLabel" style="color: #ffc107; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-triangle"></i>
                    Entidad Crediticia No Seleccionada
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #00d4ff; opacity: 0.8; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #e0e0e0; padding: 25px;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <i class="fa fa-university" style="font-size: 48px; color: #ffc107;"></i>
                </div>
                <p style="text-align: center; font-size: 16px; margin-bottom: 0;">
                    Por favor seleccione una entidad crediticia para continuar.
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0, 212, 255, 0.3); justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: #0a0e27; border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4); transition: all 0.3s ease;">
                    <i class="fa fa-check"></i> Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Error al actualizar -->
<div class="modal fade" id="modalErrorActualizar" tabindex="-1" aria-labelledby="modalErrorActualizarLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0, 212, 255, 0.3); background: rgba(255, 87, 87, 0.1);">
                <h5 class="modal-title" id="modalErrorActualizarLabel" style="color: #ff5757; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-circle"></i>
                    Error al Actualizar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #00d4ff; opacity: 0.8; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #e0e0e0; padding: 25px;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <i class="fa fa-times-circle" style="font-size: 48px; color: #ff5757;"></i>
                </div>
                <p id="mensajeErrorActualizar" style="text-align: center; font-size: 16px; margin-bottom: 0;">
                    Error desconocido
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0, 212, 255, 0.3); justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #ff5757 0%, #ff7b7b 100%); color: white; border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 87, 87, 0.4); transition: all 0.3s ease;">
                    <i class="fa fa-times-circle"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Estudio de Crédito -->
<div class="modal fade" id="modalEstudioCredito" tabindex="-1" aria-labelledby="modalEstudioCreditoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff;">
            <!-- Contenido del Modal -->
             <input type="hidden" id="cod_info_factura_venta_modal_estudio_credito" value="">
             <input type="hidden" id="cod_tercero_modal_estudio_credito" value="">
            <div style="padding: 3rem 2.5rem;">
                <!-- Botón X de cierre -->
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d;"></button>
                <!-- Icono circular con interrogación -->
                <div class="text-center mb-4">
                    <div style="width: 90px; height: 90px; border-radius: 50%; border: 4px solid #7ba8b8; margin: 0 auto; 
                                display: flex; align-items: center; justify-content: center; background-color: #ffffff;">
                        <span style="font-size: 3rem; color: #7ba8b8; font-weight: 300; font-family: Arial, sans-serif;">?</span>
                    </div>
                </div>
                <!-- Título y subtítulo -->
                <div class="text-center mb-4">
                    <h4 style="font-size: 1.4rem; font-weight: 600; color: #4a4a4a; margin-bottom: 0.2rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        Estudio de crédito ID# <span style="font-size: 1.4rem; font-weight: 700; color: #2c2c2c; margin-bottom: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" id="creditoIDNumero"></span>
                    </h4>
                    <!--<h4 style="font-size: 1.4rem; font-weight: 700; color: #2c2c2c; margin-bottom: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" id="creditoIDNumero">1073869521</h4>-->
                </div>
                <!-- Pregunta -->
                <div class="text-center mb-4" style="margin-bottom: 2.5rem !important;">
                    <p style="font-size: 1.1rem; color: #5a5a5a; margin: 0; font-weight: 400; line-height: 1.4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        ¿Qué desea hacer con esta solicitud?
                    </p>
                </div>
                <!-- Botones -->
                <div class="d-flex justify-content-center" style="gap: 1.5rem;">
                    <button type="button" class="btn" id="btnRechazarModalEstudio">Rechazar</button>
                    <button type="button" class="btn" id="btnCancelarModalEstudio" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnValidarModalEstudio" data-cod_info_factura_venta_validar="<?php echo $cod_info_factura_venta; ?>" data-cod_tercero_validar="<?php echo $cod_tercero; ?>">Validar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Motivo de Rechazo -->
<div class="modal fade" id="modalMotivoRechazo" tabindex="-1" aria-labelledby="modalMotivoRechazoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff;">
            <!-- Contenido del Modal -->
            <input type="hidden" id="cod_info_factura_venta_modal_motivo_rechazo" value="">
            <input type="hidden" id="cod_tercero_modal_motivo_rechazo" value="">
            <div style="padding: 2.5rem 2rem;">
                <!-- Botón X de cierre -->
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d;"></button>
                <!-- Título -->
                <div class="text-center mb-4">
                    <h4 style="font-size: 1.5rem; font-weight: 600; color: #4a4a4a; margin-bottom: 1.5rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        Ingrese el motivo de rechazo
                    </h4>
                </div>
                <!-- Textarea para el motivo -->
                <div class="mb-4">
                    <textarea id="textareaMotivoRechazo" class="form-control" rows="5" placeholder="Escriba el motivo aquí..." style="border: 2px solid #7ba8b8; border-radius: 8px; padding: 15px; font-size: 1rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; resize: vertical; min-height: 120px;"></textarea>
                </div>
                <!-- Botones -->
                <div class="d-flex justify-content-center" style="gap: 1.5rem;">
                    <button type="button" class="btn" id="btnCancelarMotivoRechazo" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnConfirmarRechazo">Rechazar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Método de Aprobación -->
<div class="modal fade" id="modalMetodoAprobacion" tabindex="-1" aria-labelledby="modalMetodoAprobacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff;">
            <!-- Contenido del Modal -->
             <input type="hidden" id="cod_info_factura_venta_modal_metodo_aprobaccion" value="">
             <input type="hidden" id="cod_tercero_modal_metodo_aprobaccion" value="">
            <div style="padding: 2.5rem 2rem;">
                <!-- Botón X de cierre -->
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d;"></button>
                <!-- Línea decorativa superior -->
                <div style="width: 50px; height: 3px; background-color: #6c757d; margin: 0 auto 2rem auto; border-radius: 2px;"></div>
                <!-- Título -->
                <div class="text-center mb-4">
                    <h4 style="font-size: 1.5rem; font-weight: 600; color: #333333; margin-bottom: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Método de aprobación</h4>
                </div>
                <!-- Dropdown -->
                <div class="mb-4">
                    <label style="font-size: 1rem; color: #666666; margin-bottom: 0.5rem; display: block; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Método de aprobación*</label>
                    <select name="cod_tipo_metodo_aprobacion" class="form-select" id="cod_tipo_metodo_aprobacion_select" required>
                        <?php if (isset($cod_tipo_metodo_aprobacion)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                        $consulta2_sql = "SELECT cod_tipo_metodo_aprobacion, nombre_tipo_metodo_aprobacion FROM tbl15_tipo_metodo_aprobacion WHERE (cod_estado = '1') ORDER BY cod_tipo_metodo_aprobacion DESC";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_tipo_metodo_aprobacion) AND $cod_tipo_metodo_aprobacion == $datos2['cod_tipo_metodo_aprobacion']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['cod_tipo_metodo_aprobacion'];
                        $nombre = $datos2['nombre_tipo_metodo_aprobacion'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </div>
                <!-- Botones -->
                <div class="d-flex justify-content-center" style="gap: 1rem; margin-top: 2.5rem;">
                    <button type="button" class="btn" id="btnAnteriorModalAprobacion">Anterior</button>
                    <button type="button" class="btn" id="btnCancelarModalAprobacion" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnSiguienteModalAprobacion">Siguiente</button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal Captura de Imágenes -->
<div class="modal fade" id="modalListaCapturaImagenesIniciales" tabindex="-1" aria-labelledby="modalListaCapturaImagenesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down" style="max-width: 500px; max-height: 90vh;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff; height: 100%;">
            <!-- Header fijo -->
             <input type="hidden" id="cod_info_factura_venta_modal_lista_captura_imagenes" value="">
             <input type="hidden" id="cod_tercero_modal_lista_captura_imagenes" value="">
             <input type="hidden" id="cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes" value="0">

            <div class="modal-header" style="border-bottom: 1px solid #dee2e6; padding: 1.5rem 1.5rem 1rem 1.5rem; position: relative; flex-shrink: 0;">
                <!-- Botón X de cierre -->
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d; z-index: 10;"></button>
                <!-- Encabezado -->
                <div class="text-center w-100">
                    <!--<h4 style="font-size: 1.4rem; font-weight: 600; color: #333333; margin-bottom: 0.5rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Enrolar Crédito - Paso 4/5</h4>-->
                    <p style="font-size: 1.1rem; color: #666666; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Captura de imágenes iniciales</p>
                </div>
            </div>
            <!-- Contenido con scroll -->
            <div class="modal-body" style="padding: 1.5rem; overflow-y: auto; flex-grow: 1; max-height: calc(90vh - 200px);">
                <!-- Campos de Captura -->
                <div class="row g-3" id="mostrar_datos_ajax_obtener_nota_observacion_modal"></div>
            </div>
            <!-- Footer fijo con botones -->
            <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 1rem 1.5rem; flex-shrink: 0;">
                <div class="d-flex justify-content-center w-100" style="gap: 1rem;">
                    <!--<button type="button" class="btn" id="btnAnteriorModalCaptura">Anterior</button>-->
                    <button type="button" class="btn" id="btnCancelarModalCaptura" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnGuardarModalCaptura">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Captura de Cámara -->
<div class="modal fade" id="modalCapturaCamara" tabindex="-1" aria-labelledby="modalCapturaCamaraLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down" style="max-width: 600px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #000000; height: 100vh;">
            <!-- Header -->
            <div class="modal-header" style="border-bottom: none; padding: 1rem; position: absolute; top: 0; left: 0; right: 0; z-index: 10; background: rgba(0,0,0,0.5);">
                <div class="text-center w-100">
                    <h5 class="modal-title text-white" id="modalCapturaCamaraLabel" style="font-weight: 600; margin: 0;">
                        Alinee el documento dentro del recuadro
                    </h5>
                </div>
            </div>
            <!-- Área de cámara -->
            <div class="modal-body p-0 position-relative" style="height: 100vh; overflow: hidden;">
                <!-- Video de la cámara -->
                <video id="videoCamera" autoplay playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"></video>
                <!-- Canvas oculto para capturar la foto -->
                <canvas id="canvasCapture" style="display: none;"></canvas>
                <!-- Overlay con guía de captura -->
                <div class="capture-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; pointer-events: none;">
                    <!-- Recuadro de captura SIN fondo oscuro -->
                    <div class="capture-frame" style="position: absolute; top: 50%; left: 50%; width: 420px; height: 300px; margin-left: -210px; margin-top: -150px; border: 4px solid #2196F3; border-radius: 12px; background: transparent; box-shadow: 0 0 0 9999px rgba(0,0,0,0.7); z-index: 2;"></div>
                </div>
            </div>
            <!-- Footer con botones -->
            <div class="modal-footer" id="cameraModalFooter" style="border-top: none; padding: 1rem; background: rgba(0,0,0,0.95); z-index: 1050;">
                <div class="d-flex justify-content-between align-items-center w-100" style="gap: 1rem;">
                    <!-- Botón de linterna (izquierda) -->
                    <button type="button" class="btn btn-outline-light" id="btnToggleLinterna" style="display: none; min-width: 50px; opacity: 0.9;">
                        <i class="fa fa-lightbulb"></i>
                    </button>
                    <!-- Botones principales (centro) -->
                    <div class="d-flex justify-content-center flex-grow-1" style="gap: 1.5rem;">
                        <button type="button" class="btn btn-lg" id="btnCapturarFoto" data-cod-info-factura="<?php echo $cod_info_factura_venta ?>" data-cod-tercero="<?php echo $cod_tercero ?>"  data-cod-nota-observacion="<?php echo $cod_nota_observacion ?>"><i class="fa fa-camera"></i> Capturar</button>
                        <button type="button" class="btn btn-lg" id="btnCancelarCamara" onclick="cerrarModalCamara(); document.getElementById('modalCapturaCamara').style.display='none'; return false;" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    </div>
                    <!-- Espacio vacío (derecha) para balance visual -->
                    <div style="min-width: 50px;"></div>
                </div>
            </div>
            <input type="hidden" id="cod_info_factura_venta_modal_captura_imagenes" value="">
            <input type="hidden" id="cod_tercero_modal_captura_imagenes" value="">
            <input type="hidden" id="cod_tipo_metodo_aprobacion_modal_captura_imagenes" value="">
            <input type="hidden" id="cod_nota_observacion_modal_captura_imagenes" value="">
        </div>
    </div>
</div>


<!-- Modal Procesar Otras Imágenes -->
<div class="modal fade" id="modalProcesarOtrasImagenes" tabindex="-1" aria-labelledby="modalProcesarOtrasImagenesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down" style="max-width: 500px; max-height: 90vh;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff; height: 100%;">
            <!-- Header fijo -->
             <input type="hidden" id="cod_info_factura_venta_modal_procesar_otras_imagenes" value="">
             <input type="hidden" id="cod_tercero_modal_procesar_otras_imagenes" value="">
             <input type="hidden" id="cod_tipo_metodo_aprobacion_modal_procesar_otras_imagenes" value="">

            <div class="modal-header" style="border-bottom: 1px solid #dee2e6; padding: 1.5rem 1.5rem 1rem 1.5rem; position: relative; flex-shrink: 0;">
                <!-- Botón X de cierre -->
                <button type="button" class="close btn-close position-absolute" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d; z-index: 10;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Encabezado -->
                <div class="text-center w-100">
                    <p style="font-size: 1.1rem; color: #666666; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Cargar imágenes finales</p>
                </div>
            </div>
            <!-- Contenido con scroll -->
            <div class="modal-body" style="padding: 1.5rem; overflow-y: auto; flex-grow: 1; max-height: calc(90vh - 200px);">
                <!-- Campos de Captura -->
                <div class="row g-3" id="mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes"></div>
            </div>
            <!-- Footer fijo con botones -->
            <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 1rem 1.5rem; flex-shrink: 0;">
                <div class="d-flex justify-content-center w-100" style="gap: 1rem;">
                    <button type="button" class="btn" id="btnAnteriorModalProcesarOtrasImagenes">Anterior</button>
                    <button type="button" class="btn" id="btnCancelarModalProcesarOtrasImagenes" data-dismiss="modal" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnGuardarModalProcesarOtrasImagenes">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Notificaciones WhatsApp -->
<div class="modal fade" id="modalNotificacionesWhatsapp" tabindex="-1" aria-labelledby="modalNotificacionesWhatsappLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff;">
            <!-- Header del Modal -->
            <div class="modal-header" style="border-bottom: 1px solid #dee2e6; padding: 1.5rem 1.5rem 1rem 1.5rem; position: relative;">
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 1.2rem; opacity: 0.4; cursor: pointer;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="text-center w-100">
                    <h5 class="modal-title" id="modalNotificacionesWhatsappLabel" style="font-weight: 600; color: #333; margin: 0;">
                        <i class="fa fa-whatsapp" style="color: #25d366; margin-right: 8px; font-size: 1.2rem;"></i>
                        Notificar por WhatsApp
                    </h5>
                    <p style="color: #666; font-size: 0.9rem; margin: 0.5rem 0 0 0;">Selecciona a quién enviar la notificación</p>
                </div>
            </div>
            <!-- Contenido del Modal -->
            <div class="modal-body" style="padding: 2rem;">
                <div class="row g-3">
                    <!-- Botón Notificar Cliente -->
                    <div class="col-12">
                        <button type="button" id="btnNotificarCliente" class="btn w-100" style="background: linear-gradient(135deg, #25d366 0%, #20ba5a 100%); color: white; border: none; border-radius: 10px; padding: 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fa fa-user" style="font-size: 1.3rem; margin-right: 12px;"></i>
                                <div class="text-start">
                                    <div style="font-size: 1rem;">Notificar al Cliente</div>
                                    <small style="opacity: 0.9; font-size: 0.85rem;">Enviar mensaje al cliente</small>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- Botón Notificar Revisor -->
                    <div class="col-12">
                        <button type="button" id="btnNotificarRevisor" class="btn w-100" style="background: linear-gradient(135deg, #128c7e 0%, #075e54 100%); color: white; border: none; border-radius: 10px; padding: 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fa fa-check-circle" style="font-size: 1.3rem; margin-right: 12px;"></i>
                                <div class="text-start">
                                    <div style="font-size: 1rem;">Notificar al Revisor</div>
                                    <small style="opacity: 0.9; font-size: 0.85rem;">Enviar mensaje al revisor</small>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Footer del Modal -->
            <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 1rem 1.5rem;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal" style="border-radius: 8px;">Cerrar</button>
            </div>
            <!-- Campos hidden para almacenar datos -->
            <input type="hidden" id="modal_whatsapp_cod_info_factura_venta" value="">
            <input type="hidden" id="modal_whatsapp_cod_tercero" value="">
            <input type="hidden" id="modal_whatsapp_telefono_cliente" value="">
            <input type="hidden" id="modal_whatsapp_telefono_revisor" value="">
            <input type="hidden" id="modal_whatsapp_codigo_estado_facturacion" value="">
        </div>
    </div>
</div>

<!-- Modal Editar Entidad Crediticia -->
<div class="modal fade" id="modalEditarEntidadCrediticia" tabindex="-1" aria-labelledby="modalEditarEntidadCrediticiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
            <!-- Header con gradiente morado -->
            <div class="modal-header modal-detalle-header">
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">×</span>
                </button>
                <div style="text-align: center; width: 100%;">
                    <h4 style="font-weight: 700; font-size: 1.8rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa fa-credit-card"></i>
                        <span>Editar Línea de Crédito y Simular</span>
                    </h4>
                </div>
            </div>
            
            <div class="modal-body detalle-section" style="padding: 2rem;">
                <input type="hidden" id="cod_info_factura_venta_editar" value="">
                
                <!-- Entidad Crediticia y Tipo de Simulación en fila -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <label class="detalle-label"><i class="fa fa-bank"></i> Línea de Crédito</label>
                            <select id="cod_entidad_crediticia" class="form-control" style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; height: auto; min-height: 45px; line-height: 1.5; background: white; color: #2d3748;" onchange="actualizarPorcentajeEntidad()">
                                <!--<option value="">Seleccionar entidad...</option>-->
                                <!-- Las opciones se cargarán dinámicamente -->
                            </select>
                        </div>
                    </div>
                    <?php $cod_tipo_simulacion_credito = '1'; ?>
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <label class="detalle-label"><i class="fa fa-calculator"></i> Tipo de Simulación</label>
                            <select id="cod_tipo_simulacion_credito" name="cod_tipo_simulacion_credito" class="form-control" onchange="calcularValorCredito()" style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; height: auto; min-height: 45px; line-height: 1.5; background: white; color: #2d3748;">
                            <?php if (isset($cod_tipo_simulacion_credito)) { echo ""; } else { echo ""; }
                            $consulta2_sql = "SELECT cod_tipo_simulacion_credito, nombre_tipo_simulacion_credito FROM tbl15_tipo_simulacion_credito WHERE (cod_estado = '1')";
                            $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            if(isset($cod_tipo_simulacion_credito) and $cod_tipo_simulacion_credito == $datos2['cod_tipo_simulacion_credito']) {
                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo           = $datos2['cod_tipo_simulacion_credito'];
                            $nombre           = $datos2['nombre_tipo_simulacion_credito'];
                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                        </select>
                        </div>
                    </div>
                </div>
                <!-- Valor de Contado y Número de Cuotas en fila -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <label class="detalle-label"><i class="fa fa-money"></i><div id="text_label_valor" style="display: inline;"> Valor de Contado</div></label>
                            <input type="number" id="precio_venta_producto" class="form-control" 
                                style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 0.9rem; background: white; color: #2d3748;" 
                                placeholder="" onkeyup="calcularValorCredito()" onchange="calcularValorCredito()">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detalle-info-box">
                            <label class="detalle-label"><i class="fa fa-list-ol"></i> Número de Cuotas</label>
                            <input type="number" id="numero_cuotas" class="form-control" min="1" max="36"
                                style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 0.9rem; background: white; color: #2d3748;" 
                                placeholder="Nº de cuotas" onkeyup="calcularValorCredito()" onchange="calcularValorCredito()">
                        </div>
                    </div>
                </div>
                
                <!-- Mensaje de Advertencia para Entidad Crediticia -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div id="observaciones_entidad_crediticia_modal_editar" style="background: rgba(102, 126, 234, 0.15); border-left: 4px solid #667eea; padding: 1rem; border-radius: 8px; color: #2d3748; font-size: 0.9rem; line-height: 1.6; display: none;">
                            <i class="fa fa-info-circle" style="margin-right: 0.5rem; font-size: 1.2rem; vertical-align: middle; color: #667eea;"></i>
                            <span id="observaciones_entidad_crediticia_texto_modal_editar"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Resultados del Cálculo -->
                <div id="resultadosCalculo" style="background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 10px; padding: 1.5rem; color: white; margin-bottom: 1rem; display: none;">
                    <h6 style="margin-bottom: 1rem; text-align: center; font-weight: 700;">Resumen del Crédito</h6>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div style="text-align: center;">
                            <p style="font-size: 0.8rem; opacity: 0.8; margin-bottom: 0.3rem;"><div id="text_label_valor_calc">Valor Total a Crédito</div></p>
                            <p style="font-size: 1.2rem; font-weight: 700; margin: 0;">$<span id="valorTotalCredito">0</span></p>
                        </div>
                        <div style="text-align: center;">
                            <p style="font-size: 0.8rem; opacity: 0.8; margin-bottom: 0.3rem;">Valor por Cuota</p>
                            <p style="font-size: 1.2rem; font-weight: 700; margin: 0;">$<span id="valorPorCuota">0</span></p>
                        </div>
                    </div>
                    
                    <div style="text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                        <p style="font-size: 0.8rem; opacity: 0.8; margin-bottom: 0.3rem; display: none">Intereses Generados</p>
                        <p style="font-size: 1.1rem; font-weight: 700; margin: 0; display: none">$<span id="interesesGenerados">0</span></p>
                    </div>
                    
                </div>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer" style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 1.5rem; justify-content: space-between;">
                <button type="button" class="btn btn-detalle-action" data-dismiss="modal" data-bs-dismiss="modal" 
                    style="background: linear-gradient(135deg, #718096 0%, #4a5568 100%); padding: 0.75rem 1.5rem;">
                    <i class="fa fa-times-circle"></i> Cancelar
                </button>
                <button type="button" id="btnGuardarEntidadCrediticia" onclick="guardarEntidadCrediticia()" 
                    class="btn-detalle-action" style="background: linear-gradient(135deg, #48bb78, #38a169); padding: 0.75rem 1.5rem;">
                    <i class="fa fa-save" style="margin-right: 6px;"></i> Guardar Cambios
                </button>
            </div>
            </div>
        </div>
    </div>
                <!-- Información de la entidad seleccionada -->
                <div id="infoEntidadSeleccionada" style="background: #f7fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; display: none;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #4a5568; font-size: 0.85rem; display: none;">Porcentaje de interés:</span>
                        <span id="porcentajeEntidad" style="color: #667eea; font-weight: 700; font-size: 1rem; display: none;"></span>
                    </div>  
                </div>
</div>

<script>
// ============================================
// Variables globales para datos de crédito
// ============================================
var cod_info_factura_venta_global = null;
var cod_tercero_global = null;

// Función para abrir el modal con los datos del crédito
function abrirModalDetalleCredito(nombres_apellidos, identificacion_tercero, monto_deuda, monto_deuda_sin_interes, monto_cuota, nombre_tipo_pago, cod_entidad_crediticia, nombre_entidad_crediticia, nombre_operador_credito, nombre_tienda, nombre_aliado, nombre_banco_cuenta, nombre_estado_facturacion, nombre_estado_revision, nombres_apellidos_asesor, observacion_tercero, fecha_formateada, hora_formateada, contanenar_nombre_producto, nombre_vendedor, cod_tercero, cod_info_factura_venta, cod_vendedor, cod_tienda, cod_banco_cuenta, numero_cuota) {
    document.getElementById('modalNombreCliente').textContent = nombres_apellidos;
    document.getElementById('modalCedulaCliente').textContent = identificacion_tercero;
    document.getElementById('modalValorCredito').textContent = monto_deuda;
    document.getElementById('modalTotalPrecioVenta').textContent = monto_deuda_sin_interes;
    document.getElementById('modalTipoVenta').textContent = nombre_tipo_pago;
    document.getElementById('modal_entidad_crediticia').textContent = nombre_entidad_crediticia;
    document.getElementById('modalNumeroCuotas').textContent = numero_cuota || '0';
    //document.getElementById('modal_operador_credito').textContent = operador_credito;
    document.getElementById('modalTienda').textContent = nombre_tienda;
    //document.getElementById('modalAliado').textContent = nombre_aliado;
    document.getElementById('modal_nombre_banco_cuenta').textContent = nombre_banco_cuenta;
    //document.getElementById('modalNombresApellidosAsesor').textContent = nombres_apellidos_asesor;
    document.getElementById('modalNombresApellidosVendedor').textContent = nombre_vendedor;
    //document.getElementById('modal_estado_revision').textContent = estado_revision;
    document.getElementById('modalFechaCreacion').textContent = fecha_formateada;
    document.getElementById('modalHora').textContent = hora_formateada;
    document.getElementById('modalNombreProducto').textContent = contanenar_nombre_producto;
    document.getElementById('modal_observacion_tercero').textContent = observacion_tercero;   
    document.getElementById('modalIDApp').textContent = cod_info_factura_venta;
    document.getElementById('modalCodVendedor').value = cod_vendedor;
    document.getElementById('modalCodEntidadCrediticia').value = cod_entidad_crediticia;
    document.getElementById('modalCodTienda').value = cod_tienda;
    document.getElementById('modalCodBancoCuenta').value = cod_banco_cuenta;
    document.getElementById('modalMontoCuota').textContent = monto_cuota;
    // Guardar todos los parámetros en variables globales para poder reabrir el modal
    window.modalParams = {
        nombres_apellidos: nombres_apellidos,
        identificacion_tercero: identificacion_tercero,
        monto_deuda: monto_deuda,
        monto_deuda_sin_interes: monto_deuda_sin_interes,
        monto_cuota: monto_cuota,
        nombre_tipo_pago: nombre_tipo_pago,
        cod_entidad_crediticia: cod_entidad_crediticia,
        nombre_entidad_crediticia: nombre_entidad_crediticia,
        nombre_operador_credito: nombre_operador_credito,
        nombre_tienda: nombre_tienda,
        nombre_aliado: nombre_aliado,
        nombre_banco_cuenta: nombre_banco_cuenta,
        nombre_estado_facturacion: nombre_estado_facturacion,
        nombre_estado_revision: nombre_estado_revision,
        nombres_apellidos_asesor: nombres_apellidos_asesor,
        observacion_tercero: observacion_tercero,
        fecha_formateada: fecha_formateada,
        hora_formateada: hora_formateada,
        contanenar_nombre_producto: contanenar_nombre_producto,
        nombre_vendedor: nombre_vendedor,
        cod_tercero: cod_tercero,
        cod_info_factura_venta: cod_info_factura_venta,
        cod_vendedor: cod_vendedor,
        cod_tienda: cod_tienda,
        cod_banco_cuenta: cod_banco_cuenta,
        numero_cuota: numero_cuota
    };
    console.log('Desplegar modal: modalDetalleCredito:', { codInfoFacturaVenta: cod_info_factura_venta, codTercero: cod_tercero, numeroCuota: numero_cuota });
    // Cargar imágenes guardadas
    cargarImagenesModal(cod_info_factura_venta);
    // mostrar modal modalDetalleCredito
    $('#modalDetalleCredito').modal('show');
}


// Función para cargar las imágenes guardadas en el modal
function cargarImagenesModal(cod_info_factura_venta) {
    console.log('Cargando imágenes para cod_info_factura_venta:', cod_info_factura_venta);
    
    const container = document.getElementById('modal_imagenes_container');
    if (!container) {
        console.error('Contenedor de imágenes no encontrado');
        return;
    }
    // Mostrar loading
    container.innerHTML = `
        <div style="text-align: center; color: #a0aec0; padding: 1rem; grid-column: 1/-1;">
            <i class="fa fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 8px;"></i>
            <p style="font-size: 0.8rem; margin: 0;">Cargando imágenes...</p>
        </div>
    `;
    
    // Hacer petición AJAX para obtener las imágenes
    $.ajax({
        url: '../admin/obtener_imagenes_nota_observacion_modal_ajax.php',
        type: 'POST',
        dataType: 'text',
        data: { cod_info_factura_venta: cod_info_factura_venta },
        success: function(responseText) {
            let response;
            try {
                response = JSON.parse(responseText);
            } catch (parseError) {
                console.error('Error parsing JSON:', parseError);
                console.error('Respuesta que causó el error:', responseText);
                container.innerHTML = `
                    <div style="text-align: center; color: #f56565; padding: 1.5rem; grid-column: 1/-1;">
                        <i class="fa fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 8px;"></i>
                        <p style="font-size: 0.8rem; margin: 0;">Error de formato en respuesta del servidor</p>
                    </div>
                `;
                return;
            }
            if (response && response.success && response.imagenes && response.imagenes.length > 0) {
                let html = '';
                response.imagenes.forEach(function(imagen) {
                    // Verificar si el estado es APROBADO para desactivar el clic
                    const esAprobado = imagen.nombre_estado_revision === 'ACEPTADO';
                    const cursorStyle = esAprobado ? 'default' : 'pointer';
                    const onclickAttr = esAprobado ? '' : `onclick="mostrarImagenCompleta('${imagen.url_img_orig_producto}', '${imagen.nombre_nota_observacion}')"`;
                    const opacityStyle = esAprobado ? 'opacity: 0.7;' : '';
                    
                    html += `
                        <div style="border-radius: 8px; overflow: hidden; border: 2px solid rgba(102, 126, 234, 0.3); background: rgba(0, 0, 0, 0.5); margin-bottom: 1.2rem;">
                            <img src="${imagen.url_img_min_producto}" 
                                 alt="${imagen.nombre_nota_observacion}" 
                                 style="width: 100%; height: 80px; object-fit: cover; cursor: ${cursorStyle}; ${opacityStyle}"
                                 ${onclickAttr}
                                 ${esAprobado ? 'title="Imagen aprobada - No se puede ampliar"' : ''}>
                            <div style="padding: 6px; text-align: center;">
                                <p style="font-size: 0.7rem; color: #a0aec0; margin: 0; line-height: 1.2; font-weight: 600;">${imagen.nombre_nota_observacion}</p>
                                <span style="display: inline-block; margin-top: 2px; padding: 2px 10px; border-radius: 12px; font-size: 0.8rem; font-weight: 500; background: ${imagen.color_fondo_celda || '#e2e8f0'}; color: #222;">${imagen.nombre_estado_revision || ''}</span>
                                ${esAprobado ? '<p style="font-size: 0.65rem; color: #48bb78; margin: 2px 0 0 0;"><i class="fa fa-check-circle"></i> Aprobada</p>' : ''}
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            } else {
                container.innerHTML = `
                    <div style="text-align: center; color: #666; padding: 1.5rem; grid-column: 1/-1;">
                        <i class="fa fa-image" style="font-size: 2rem; opacity: 0.3; margin-bottom: 8px;"></i>
                        <p style="font-size: 0.8rem; margin: 0;">No hay imágenes guardadas</p>
                    </div>
                `;
            }
        },
        error: function(xhr, status, error) {
            console.error('Error cargando imágenes:', error);
            container.innerHTML = `
                <div style="text-align: center; color: #f56565; padding: 1.5rem; grid-column: 1/-1;">
                    <i class="fa fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 8px;"></i>
                    <p style="font-size: 0.8rem; margin: 0;">Error al cargar imágenes</p>
                </div>
            `;
        }
    });
}

// Función para mostrar imagen completa en modal
function mostrarImagenCompleta(urlImagen, nombre) {
    // Crear modal temporal para mostrar imagen completa
    const modalHtml = `
        <div class="modal fade" id="modalImagenCompleta" tabindex="-1" style="z-index: 9999;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="background: #000; border: none;">
                    <div class="modal-header" style="border: none; padding: 1rem;">
                        <h5 style="color: white; margin: 0;">${nombre}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" style="background: white; opacity: 0.8;">
                            <span style="color: black;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="padding: 0;">
                        <img src="${urlImagen}" style="max-width: 100%; max-height: 70vh; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remover modal anterior si existe
    $('#modalImagenCompleta').remove();
    
    // Agregar nuevo modal al DOM
    $('body').append(modalHtml);
    
    // Mostrar modal
    $('#modalImagenCompleta').modal('show');
    
    // Remover modal del DOM cuando se cierre
    $('#modalImagenCompleta').on('hidden.bs.modal', function() {
        $(this).remove();
    });
}

// Función para abrir el modal de editar entidad crediticia
function abrirModalCambiarEntidadCrediticia(codInfoFacturaVenta, codEntidadCrediticia) {
    //console.log('Abriendo modal con parámetros:', codInfoFacturaVenta, codEntidadCrediticia);
    // Almacenar los valores en los campos del modal
    document.getElementById('cod_info_factura_venta_editar').value = codInfoFacturaVenta;
    // Cargar las entidades crediticias disponibles
    cargarEntidadesCrediticias(codInfoFacturaVenta, codEntidadCrediticia);
    // Mostrar el modal
    console.log('Desplegar modal: modalEditarEntidadCrediticia:', { codInfoFacturaVenta: codInfoFacturaVenta });
    $('#modalEditarEntidadCrediticia').modal('show');
}

// Función para cargar las entidades crediticias en el select
function cargarEntidadesCrediticias(codInfoFacturaVenta, codEntidadCrediticiaActual) {
    //console.log('Cargando entidades para factura:', codInfoFacturaVenta, 'Entidad actual:', codEntidadCrediticiaActual);
    
    $.ajax({
        url: '../admin/obtener_entidades_crediticias_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            cod_info_factura_venta: codInfoFacturaVenta,
            cod_entidad_crediticia: codEntidadCrediticiaActual
        },
        success: function(response) {
            if (response && response.success && response.entidades) {
                const select = document.getElementById('cod_entidad_crediticia');
                select.innerHTML = '<option value="">Seleccionar entidad...</option>';
                
                response.entidades.forEach(function(entidad) {
                    const option = document.createElement('option');
                    option.value = entidad.cod_entidad_crediticia;
                    option.textContent = entidad.nombre_entidad_crediticia;
                    option.setAttribute('data-porcentaje', entidad.aliado_estrategico_interes_ptj);
                    
                    // Agregar observaciones si existen
                    if (entidad.observaciones_entidad_crediticia) {
                        option.setAttribute('data-observaciones', entidad.observaciones_entidad_crediticia);
                    }
                    
                    // Preseleccionar la entidad actual si coincide
                    if (codEntidadCrediticiaActual && entidad.cod_entidad_crediticia == codEntidadCrediticiaActual) {
                        option.selected = true;
                    }
                    
                    select.appendChild(option);
                });
                // Asegurar que el select muestre la opción actual seleccionada
                if (codEntidadCrediticiaActual) {
                    try { select.value = codEntidadCrediticiaActual; } catch (e) { /* noop */ }
                }
                
                // Si hay una entidad preseleccionada, mostrar su información
                if (codEntidadCrediticiaActual) {
                    actualizarPorcentajeEntidad();
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error cargando entidades crediticias:', error);
        }
    });
}

// Función para actualizar el porcentaje cuando se selecciona una entidad
function actualizarPorcentajeEntidad() {
    const select = document.getElementById('cod_entidad_crediticia');
    const selectedOption = select.options[select.selectedIndex];
    const infoDiv = document.getElementById('infoEntidadSeleccionada');
    const porcentajeSpan = document.getElementById('porcentajeEntidad');
    const observacionesDiv = document.getElementById('observaciones_entidad_crediticia_modal_editar');
    const observacionesTexto = document.getElementById('observaciones_entidad_crediticia_texto_modal_editar');
    
    if (selectedOption.value && selectedOption.getAttribute('data-porcentaje')) {
        const porcentaje = selectedOption.getAttribute('data-porcentaje');
        porcentajeSpan.textContent = porcentaje + '%';
        infoDiv.style.display = 'block';
        
        // Mostrar observaciones si existen
        const observaciones = selectedOption.getAttribute('data-observaciones');
        if (observaciones && observaciones.trim() !== '') {
            observacionesTexto.innerHTML = observaciones;
            observacionesDiv.style.display = 'block';
        } else {
            observacionesDiv.style.display = 'none';
        }
        
        // Recalcular si ya hay valores ingresados
        calcularValorCredito();
    } else {
        infoDiv.style.display = 'none';
        observacionesDiv.style.display = 'none';
        ocultarResultados();
    }
}

// Función para calcular el valor del crédito
function calcularValorCredito() {
    const precio_venta_producto = parseFloat(document.getElementById('precio_venta_producto').value) || 0;
    const numeroCuotas = parseInt(document.getElementById('numero_cuotas').value) || 0;
    const numero_cuotas = numeroCuotas;

    const select_entidad_crediticia_id = document.getElementById('cod_entidad_crediticia');
    const cod_entidad_crediticia_html = select_entidad_crediticia_id.options[select_entidad_crediticia_id.selectedIndex];
    const cod_entidad_crediticia = cod_entidad_crediticia_html.value;

    const select_tipo_simulacion_credito_id = document.getElementById('cod_tipo_simulacion_credito');
    const cod_tipo_simulacion_credito_html = select_tipo_simulacion_credito_id.options[select_tipo_simulacion_credito_id.selectedIndex];
    const cod_tipo_simulacion_credito = cod_tipo_simulacion_credito_html.value;

    if(cod_tipo_simulacion_credito == '1'){ 
        document.getElementById('text_label_valor').textContent = "Valor de Contado";
        document.getElementById('text_label_valor_calc').textContent = "Valor Total a Crédito";
    } else {
        document.getElementById('text_label_valor').textContent = "Valor a Crédito";
        document.getElementById('text_label_valor_calc').textContent = "Valor Total de Contado";
    }

    if (precio_venta_producto > 0 && numeroCuotas > 0 && cod_entidad_crediticia) {
        // Enviar datos al servidor
        $.ajax({
            url: '../admin/calcular_valor_credito_tipo_simulacion_ajax.php',
            type: 'POST',
            data: { precio_venta_producto: precio_venta_producto, numero_cuotas: numero_cuotas, cod_entidad_crediticia: cod_entidad_crediticia, cod_tipo_simulacion_credito: cod_tipo_simulacion_credito },
            dataType: 'json',
            success: function(response) {
                var total_pagar = response.total_pagar;
                var cuota_credito = response.cuota_credito;
                var numero_cuotas = response.numero_cuotas;
                var precio_venta_producto = response.precio_venta_producto;
                var interes_ptj = response.interes_ptj;
                var total_interes = response.total_interes;
                var text_label_valor = response.text_label_valor;
                var valor_contado = response.valor_contado;
                var valor_credito_calculado = response.valor_credito_calculado;
                var cod_tipo_simulacion = response.cod_tipo_simulacion_credito;
                var success = response.success;
                
                if (response && success) {
                    // Mostrar el valor según el tipo de simulación
                    // Si es precio contado (1): mostrar el valor a crédito calculado
                    // Si es precio crédito (2): mostrar el valor de contado calculado
                    if (cod_tipo_simulacion == '1' || cod_tipo_simulacion == '0') {
                        document.getElementById('valorTotalCredito').textContent = formatearNumero(valor_credito_calculado);
                    } else {
                        document.getElementById('valorTotalCredito').textContent = formatearNumero(valor_contado);
                    }
                    document.getElementById('valorPorCuota').textContent = formatearNumero(cuota_credito);
                    document.getElementById('interesesGenerados').textContent = formatearNumero(total_interes);
                    document.getElementById('resultadosCalculo').style.display = 'block';     
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al guardar:', error);
                var msg = 'Error al guardar los cambios. Por favor intente nuevamente.';
                if ($('#modalErrorActualizar').length) {
                    $('#mensajeErrorActualizar').text(msg);
                    $('#modalErrorActualizar').modal('show');
                } else if (typeof showFloatingNotification === 'function') {
                    showFloatingNotification(msg);
                } else {
                    showFloatingNotification(msg);
                }
            }
        });
    } else {
        ocultarResultados();
    }    
}

// Función para formatear números con separadores de miles
function formatearNumero(numero) {
    return numero.toLocaleString('es-CO', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
}

// Función para ocultar los resultados del cálculo
function ocultarResultados() {
    document.getElementById('resultadosCalculo').style.display = 'none';
}

// ==================== FUNCIONES PARA VENDEDOR ====================

// Función para abrir el modal de editar vendedor
function abrirModalCambiarVendedor(codInfoFacturaVenta, codVendedor) {
    console.log('Abriendo modal editar vendedor:', { codInfoFacturaVenta, codVendedor });
    
    // Ocultar el modal de detalle de crédito antes de abrir el nuevo modal
    $('#modalDetalleCredito').modal('hide');
    
    // Almacenar los valores en los campos del modal
    document.getElementById('CambiarVendedorCodInfoFactura').value = codInfoFacturaVenta;
    document.getElementById('CambiarVendedorCodActual').value = codVendedor;
    
    // Cargar los vendedores disponibles
    cargarVendedores(codInfoFacturaVenta, codVendedor);
    
    // Esperar a que el modal anterior se cierre completamente antes de abrir el nuevo
    setTimeout(function() {
        $('#modalCambiarVendedor').modal('show');
    }, 300);
}

// Función para abrir el modal de registrar vendedor
function abrirModalRegistrarVendedor(codInfoFacturaVenta) {
    console.log('Abriendo modal registrar vendedor:', { codInfoFacturaVenta });
    
    // Ocultar el modal de detalle de crédito antes de abrir el nuevo modal
    $('#modalDetalleCredito').modal('hide');
    
    // Almacenar el código de factura
    document.getElementById('registrarVendedorCodInfoFactura').value = codInfoFacturaVenta;
    
    // Limpiar el formulario
    document.getElementById('formRegistrarVendedor').reset();
    document.getElementById('alertRegistrarVendedor').style.display = 'none';
    
    // Esperar a que el modal anterior se cierre completamente antes de abrir el nuevo
    setTimeout(function() {
        $('#modalRegistrarVendedor').modal('show');
    }, 300);
}

// Función para cargar los vendedores en el select
function cargarVendedores(codInfoFacturaVenta, codVendedorActual, selectId) {
    // selectId opcional: si no se provee, usar el select por defecto 'CambiarVendedorSelect'
    var targetSelectId = selectId || 'CambiarVendedorSelect';

    $.ajax({
        url: '../admin/obtener_vendedores_modal_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            cod_info_factura_venta: codInfoFacturaVenta
        },
        success: function(response) {
            if (response && response.success && response.vendedores) {
                var select = document.getElementById(targetSelectId);
                if (!select) return console.error('Select no encontrado:', targetSelectId);
                select.innerHTML = '<option value="">Seleccionar vendedor...</option>';

                response.vendedores.forEach(function(vendedor) {
                    var option = document.createElement('option');
                    option.value = vendedor.cod_vendedor;
                    option.textContent = vendedor.nombres + ' ' + vendedor.apellidos;

                    // Preseleccionar el vendedor actual si coincide
                    if (codVendedorActual && vendedor.cod_vendedor == codVendedorActual) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                });
                // Asegurar que el select muestre la opción seleccionada actualmente
                if (codVendedorActual) {
                    try { select.value = codVendedorActual; } catch (e) { /* noop */ }
                }
            } else {
                console.error('Error al cargar vendedores');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error cargando vendedores:', error);
            var sel = document.getElementById(targetSelectId);
            if (sel) sel.innerHTML = '<option value="">Error al cargar vendedores</option>';
        }
    });
}

// delegación para botones dinámicos de asignar vendedor
$(document).on('click', '.btn-asignar-vendedor', function(e) {
    e.preventDefault();
    var codInfo = $(this).data('cod_info_factura_venta');
    var codVendedor = $(this).data('cod_vendedor') || '';

    // Llenar el campo oculto de la nueva modal y cargar vendedores en el select correspondiente
    $('#AsignarVendedorCodInfoFactura').val(codInfo);
    cargarVendedores(codInfo, codVendedor, 'AsignarVendedorSelect');
    // Mostrar la modal duplicada
    setTimeout(function() {
        $('#modalAsignarVendedor').modal('show');
    }, 200);
});

// ==================== FUNCIONES PARA BANCO CUENTA ====================

// delegación para botones dinámicos de asignar banco cuenta
$(document).on('click', '.btn-asignar-banco-cuenta', function(e) {
    e.preventDefault();
    var codInfo = $(this).data('cod_info_factura_venta');
    var codBancoCuenta = $(this).data('cod_banco_cuenta') || '';

    // Llenar el campo oculto de la nueva modal y cargar bancos en el select correspondiente
    $('#AsignarBancoCuentaCodInfoFactura').val(codInfo);
    cargarBancosCuentas(codInfo, codBancoCuenta, 'AsignarBancoCuentaSelect');
    // Mostrar la modal duplicada
    setTimeout(function() {
        $('#modalAsignarBancoCuenta').modal('show');
    }, 200);
});

// ==================== FUNCIONES PARA BANCO CUENTA ====================

// Función para abrir el modal de cambiar banco cuenta
function abrirModalCambiarBancoCuenta(codInfoFacturaVenta, codBancoCuenta) {
    console.log('Abriendo modal cambiar banco cuenta:', { codInfoFacturaVenta, codBancoCuenta });
    
    // Ocultar el modal de detalle de crédito antes de abrir el nuevo modal
    $('#modalDetalleCredito').modal('hide');
    
    // Almacenar los valores en los campos del modal
    document.getElementById('CambiarBancoCuentaCodInfoFactura').value = codInfoFacturaVenta;
    document.getElementById('CambiarBancoCuentaCodActual').value = codBancoCuenta;
    
    // Cargar las cuentas bancarias disponibles
    cargarBancosCuentas(codInfoFacturaVenta, codBancoCuenta);
    
    // Esperar a que el modal anterior se cierre completamente antes de abrir el nuevo
    setTimeout(function() {
        $('#modalCambiarBancoCuenta').modal('show');
    }, 300);
}

// Función para abrir el modal de registrar banco cuenta
function abrirModalRegistrarBancoCuenta(codInfoFacturaVenta) {
    console.log('Abriendo modal registrar banco cuenta:', { codInfoFacturaVenta });
    
    // Ocultar el modal de detalle de crédito antes de abrir el nuevo modal
    $('#modalDetalleCredito').modal('hide');
    
    // Almacenar el código de factura
    document.getElementById('registrarBancoCuentaCodInfoFactura').value = codInfoFacturaVenta;
    
    // Limpiar el formulario
    document.getElementById('formRegistrarBancoCuenta').reset();
    document.getElementById('alertRegistrarBancoCuenta').style.display = 'none';
    
    // Esperar a que el modal anterior se cierre completamente antes de abrir el nuevo
    setTimeout(function() {
        $('#modalRegistrarBancoCuenta').modal('show');
    }, 300);
}

// Función para cargar las cuentas bancarias en el select
function cargarBancosCuentas(codInfoFacturaVenta, codBancoCuentaActual, selectId) {
    // selectId opcional: si no se provee, usar el select por defecto 'CambiarBancoCuentaSelect'
    var targetSelectId = selectId || 'CambiarBancoCuentaSelect';

    $.ajax({
        url: '../admin/obtener_lista_bancos_cuentas_modal_factura_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            cod_info_factura_venta: codInfoFacturaVenta
        },
        success: function(response) {
            if (response && response.success && response.bancos_cuentas) {
                var select = document.getElementById(targetSelectId);
                if (!select) return console.error('Select no encontrado:', targetSelectId);
                select.innerHTML = '<option value="">Seleccionar cuenta bancaria...</option>';
                
                response.bancos_cuentas.forEach(function(banco) {
                    var option = document.createElement('option');
                    option.value = banco.cod_banco_cuenta;
                    option.textContent = banco.nombre_banco_cuenta + ' | ' + banco.numero_banco_cuenta;
                    
                    // Preseleccionar la cuenta actual si coincide
                    if (codBancoCuentaActual && banco.cod_banco_cuenta == codBancoCuentaActual) {
                        option.selected = true;
                    }
                    
                    select.appendChild(option);
                });
                // Asegurar que el select muestre la cuenta actualmente seleccionada
                if (codBancoCuentaActual) {
                    try { select.value = codBancoCuentaActual; } catch (e) { /* noop */ }
                }
            } else {
                var sel = document.getElementById(targetSelectId);
                if (sel) sel.innerHTML = '<option value="">No hay cuentas bancarias disponibles</option>';
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar cuentas bancarias:', error);
            var sel = document.getElementById(targetSelectId);
            if (sel) sel.innerHTML = '<option value="">Error al cargar cuentas bancarias</option>';
        }
    });
}

// ==================== FUNCIONES PARA GESTIÓN DE TIENDAS ====================

function abrirModalCambiarTienda(codInfoFacturaVenta, codTiendaActual) {
    console.log('Abriendo modal cambiar tienda. Factura:', codInfoFacturaVenta, 'Tienda actual:', codTiendaActual);
    
    // Cerrar modal actual
    $('#modalDetalleCredito').modal('hide');
    
    // Esperar a que se cierre completamente
    $('#modalDetalleCredito').on('hidden.bs.modal', function() {
        $(this).off('hidden.bs.modal');
        
        // Abrir modal de cambiar tienda
        $('#modalCambiarTienda').modal('show');
        
        // Guardar el cod_info_factura_venta para usarlo después
        $('#modalCambiarTienda').data('codInfoFacturaVenta', codInfoFacturaVenta);
        
        // Cargar las tiendas disponibles
        cargarTiendas(codInfoFacturaVenta, codTiendaActual);
    });
}

function abrirModalRegistrarTienda(codInfoFacturaVenta) {
    console.log('Abriendo modal registrar tienda. Factura:', codInfoFacturaVenta);
    
    // Cerrar modal actual
    $('#modalDetalleCredito').modal('hide');
    
    // Esperar a que se cierre completamente
    $('#modalDetalleCredito').on('hidden.bs.modal', function() {
        $(this).off('hidden.bs.modal');
        
        // Limpiar formulario
        $('#formRegistrarTienda')[0].reset();
        $('#alertRegistrarTienda').hide();
        
        // Abrir modal
        $('#modalRegistrarTienda').modal('show');
        
        // Guardar el cod_info_factura_venta
        $('#modalRegistrarTienda').data('codInfoFacturaVenta', codInfoFacturaVenta);
    });
}

function cargarTiendas(codInfoFacturaVenta, codTiendaActual) {
    $.ajax({
        url: '../admin/obtener_actualizar_lista_tiendas_modal_factura_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            cod_info_factura_venta: codInfoFacturaVenta
        },
        success: function(response) {
            if (response && response.success && response.tiendas) {
                const select = document.getElementById('CambiarTiendaSelect');
                select.innerHTML = '<option value="">Seleccionar tienda...</option>';
                
                response.tiendas.forEach(function(tienda) {
                    const option = document.createElement('option');
                    option.value = tienda.cod_tienda;
                    option.textContent = tienda.nombre_tienda;
                    
                    // Preseleccionar la tienda actual si coincide
                    if (codTiendaActual && tienda.cod_tienda == codTiendaActual) {
                        option.selected = true;
                    }
                    
                    select.appendChild(option);
                });
                // Asegurar que el select muestre la tienda actualmente seleccionada
                if (codTiendaActual) {
                    try { select.value = codTiendaActual; } catch (e) { /* noop */ }
                }
            } else {
                document.getElementById('CambiarTiendaSelect').innerHTML = '<option value="">No hay tiendas disponibles</option>';
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar tiendas:', error);
            document.getElementById('CambiarTiendaSelect').innerHTML = '<option value="">Error al cargar tiendas</option>';
        }
    });
}

// ==================== FUNCIONES PARA OBSERVACIÓN ====================

function abrirModalEditarObservacion(codInfoFacturaVenta, observacionActual) {
    console.log('Abriendo modal editar observación:', { codInfoFacturaVenta, observacionActual });
    
    // Cerrar modal actual
    $('#modalDetalleCredito').modal('hide');
    
    // Esperar a que se cierre completamente
    $('#modalDetalleCredito').on('hidden.bs.modal', function() {
        $(this).off('hidden.bs.modal');
        
        // Establecer valores en el modal
        $('#editarObservacionCodInfoFactura').val(codInfoFacturaVenta);
        $('#editarObservacionTexto').val(observacionActual || '');
        $('#alertEditarObservacion').hide();
        
        // Abrir modal de editar observación
        $('#modalEditarObservacion').modal('show');
    });
}

// ==================== BOTONES CANCELAR MODALES VENDEDOR ====================
// Estos eventos están FUERA del DOMContentLoaded para asegurar que funcionen

// Botón para cancelar edición de vendedor
$(document).on('click', '#btnCancelarCambiarVendedor', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Cambiar Vendedor clickeado');
    
    // Cerrar modal actual
    $('#modalCambiarVendedor').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalCambiarVendedor').on('hidden.bs.modal', function(e) {
        // Remover el evento para que no se ejecute múltiples veces
        $(this).off('hidden.bs.modal');
        // Abrir el modal anterior
        $('#modalDetalleCredito').modal('show');
    });
});

// Botón para cancelar registro de vendedor
$(document).on('click', '#btnCancelarRegistrarVendedor', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Registrar Vendedor clickeado');
    
    // Cerrar modal actual
    $('#modalRegistrarVendedor').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalRegistrarVendedor').on('hidden.bs.modal', function(e) {
        // Remover el evento para que no se ejecute múltiples veces
        $(this).off('hidden.bs.modal');
        // Abrir el modal anterior
        $('#modalDetalleCredito').modal('show');
    });
});

// ==================== BOTONES GUARDAR MODALES VENDEDOR ====================
// Estos eventos están FUERA del DOMContentLoaded para asegurar que funcionen

// Botón para guardar cambios del vendedor
$(document).on('click', '#btnGuardarCambiarVendedor', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Cambiar Vendedor clickeado');
    
    const codInfoFactura = $('#CambiarVendedorCodInfoFactura').val();
    const codVendedor = $('#CambiarVendedorSelect').val();
    const alertDiv = $('#alertCambiarVendedor');
    
    if (!codVendedor) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor seleccione un vendedor');
        alertDiv.show();
        return;
    }
    
    // Enviar datos al servidor
    $.ajax({
        url: '../admin/cambiar_vendedor_modal_factura_ajax_reg.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFactura,
            cod_vendedor: codVendedor
        },
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message || 'Vendedor actualizado correctamente');
                alertDiv.show();
                
                // Recargar la página después de 1 segundo para actualizar los datos
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al actualizar el vendedor');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al guardar:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al guardar los cambios. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// Botón para asignar vendedor (modal duplicada) - Cancelar
$(document).on('click', '#btnCancelarAsignarVendedor', function(e) {
    e.preventDefault();
    // Cerrar modal actual
    $('#modalAsignarVendedor').modal('hide');
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalAsignarVendedor').on('hidden.bs.modal', function(e) {
        $(this).off('hidden.bs.modal');
        //$('#modalDetalleCredito').modal('show');
    });
});

// Botón para guardar asignación desde la modal duplicada
$(document).on('click', '#btnGuardarAsignarVendedor', function(e) {
    e.preventDefault();

    const codInfoFactura = $('#AsignarVendedorCodInfoFactura').val();
    const codVendedor = $('#AsignarVendedorSelect').val();
    const alertDiv = $('#alertAsignarVendedor');

    if (!codVendedor) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor seleccione un vendedor');
        alertDiv.show();
        return;
    }

    // Enviar datos al servidor (mismo endpoint que CambiarVendedor)
    $.ajax({
        url: '../admin/cambiar_vendedor_modal_factura_ajax_reg.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFactura,
            cod_vendedor: codVendedor
        },
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message || 'Vendedor asignado correctamente');
                alertDiv.show();

                // Recargar la página después de 1 segundo para actualizar los datos
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al asignar el vendedor');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al guardar asignación:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al guardar los cambios. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// Botón para registrar nuevo vendedor
$(document).on('click', '#btnGuardarRegistrarVendedor', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Registrar Vendedor clickeado');
    
    const formData = new FormData($('#formRegistrarVendedor')[0]);
    const alertDiv = $('#alertRegistrarVendedor');
    
    // Obtener y agregar el código de info_factura_venta al FormData
    const codInfoFactura = $('#registrarVendedorCodInfoFactura').val();
    if (codInfoFactura) {
        formData.append('cod_info_factura_venta', codInfoFactura);
    }
    
    // Validar campos requeridos
    const nombres = $('#registrarVendedorNombres').val().trim();
    const apellidos = $('#registrarVendedorApellidos').val().trim();
    const cedula = $('#registrarVendedorCedula').val().trim();
    
    if (!nombres || !apellidos || !cedula) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor complete los campos obligatorios (Cédula, Nombres y Apellidos)');
        alertDiv.show();
        return;
    }
    
    // Enviar datos al servidor
    $.ajax({
        url: '../admin/reg_nuevo_vendedor_modal_registrar_vendedor_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message || 'Vendedor registrado correctamente');
                alertDiv.show();
                
                // Obtener el código de factura
                const codInfoFactura = $('#registrarVendedorCodInfoFactura').val();
                
                // Si hay un código de factura y un código de vendedor, actualizar el vendedor en la factura
                if (codInfoFactura && response.cod_vendedor) {
                    $.ajax({
                        url: '../admin/cambiar_vendedor_modal_factura_ajax_reg.php',
                        type: 'POST',
                        data: {
                            cod_info_factura_venta: codInfoFactura,
                            cod_vendedor: response.cod_vendedor
                        },
                        dataType: 'json',
                        success: function(updateResponse) {
                            // Construir el nombre completo del vendedor
                            const nombreVendedor = nombres + ' ' + apellidos;
                            
                            // Actualizar el valor en el modal de detalle
                            $('#modalNombresApellidosVendedor').text(nombreVendedor);
                            $('#modalCodVendedor').val(response.cod_vendedor);
                            
                            // Cerrar modal actual y reabrir el anterior después de 1 segundo
                            setTimeout(function() {
                                $('#modalRegistrarVendedor').modal('hide');
                                
                                // Esperar a que se cierre completamente y abrir el modal anterior
                                $('#modalRegistrarVendedor').on('hidden.bs.modal', function(e) {
                                    $(this).off('hidden.bs.modal');
                                    $('#modalDetalleCredito').modal('show');
                                });
                            }, 1000);
                        },
                        error: function() {
                            // Si falla la actualización, mostrar el modal de detalle de todos modos
                            setTimeout(function() {
                                $('#modalRegistrarVendedor').modal('hide');
                                $('#modalRegistrarVendedor').on('hidden.bs.modal', function(e) {
                                    $(this).off('hidden.bs.modal');
                                    $('#modalDetalleCredito').modal('show');
                                });
                            }, 1000);
                        }
                    });
                } else {
                    // Si no hay código de factura, solo cerrar el modal y recargar
                    setTimeout(function() {
                        $('#modalRegistrarVendedor').modal('hide');
                        location.reload();
                    }, 1500);
                }
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al registrar el vendedor');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al registrar:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al registrar el vendedor. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// ==================== BOTONES CANCELAR MODALES BANCO CUENTA ====================
// Estos eventos están FUERA del DOMContentLoaded para asegurar que funcionen

// Botón para cancelar cambio de banco cuenta
$(document).on('click', '#btnCancelarCambiarBancoCuenta', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Cambiar Banco Cuenta clickeado');
    
    // Cerrar modal actual
    $('#modalCambiarBancoCuenta').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalCambiarBancoCuenta').on('hidden.bs.modal', function(e) {
        // Remover el evento para que no se ejecute múltiples veces
        $(this).off('hidden.bs.modal');
        // Abrir el modal anterior
        $('#modalDetalleCredito').modal('show');
    });
});

// Botón para cancelar registro de banco cuenta
$(document).on('click', '#btnCancelarRegistrarBancoCuenta', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Registrar Banco Cuenta clickeado');
    
    // Cerrar modal actual
    $('#modalRegistrarBancoCuenta').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalRegistrarBancoCuenta').on('hidden.bs.modal', function(e) {
        // Remover el evento para que no se ejecute múltiples veces
        $(this).off('hidden.bs.modal');
        // Abrir el modal anterior
        $('#modalDetalleCredito').modal('show');
    });
});

// ==================== BOTONES GUARDAR MODALES BANCO CUENTA ====================
// Estos eventos están FUERA del DOMContentLoaded para asegurar que funcionen

// Botón para guardar cambios de banco cuenta
$(document).on('click', '#btnGuardarCambiarBancoCuenta', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Cambiar Banco Cuenta clickeado');
    
    const codInfoFactura = $('#CambiarBancoCuentaCodInfoFactura').val();
    const codBancoCuenta = $('#CambiarBancoCuentaSelect').val();
    const alertDiv = $('#alertCambiarBancoCuenta');
    
    if (!codBancoCuenta) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor seleccione una cuenta bancaria');
        alertDiv.show();
        return;
    }
    
    // Enviar datos al servidor
    $.ajax({
        url: '../admin/cambiar_banco_cuenta_modal_factura_ajax.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFactura,
            cod_banco_cuenta: codBancoCuenta
        },
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message || 'Cuenta bancaria actualizada correctamente');
                alertDiv.show();
                
                // Recargar la página después de 1 segundo para actualizar los datos
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al actualizar la cuenta bancaria');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al guardar:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al guardar los cambios. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// Botón para asignar banco cuenta (modal duplicada) - Cancelar
$(document).on('click', '#btnCancelarAsignarBancoCuenta', function(e) {
    e.preventDefault();
    // Cerrar modal actual
    $('#modalAsignarBancoCuenta').modal('hide');
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalAsignarBancoCuenta').on('hidden.bs.modal', function(e) {
        $(this).off('hidden.bs.modal');
        //$('#modalDetalleCredito').modal('show');
    });
});

// Botón para guardar asignación desde la modal duplicada de banco cuenta
$(document).on('click', '#btnGuardarAsignarBancoCuenta', function(e) {
    e.preventDefault();

    const codInfoFactura = $('#AsignarBancoCuentaCodInfoFactura').val();
    const codBancoCuenta = $('#AsignarBancoCuentaSelect').val();
    const alertDiv = $('#alertAsignarBancoCuenta');

    if (!codBancoCuenta) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor seleccione una cuenta bancaria');
        alertDiv.show();
        return;
    }

    // Enviar datos al servidor (mismo endpoint que CambiarBancoCuenta)
    $.ajax({
        url: '../admin/cambiar_banco_cuenta_modal_factura_ajax.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFactura,
            cod_banco_cuenta: codBancoCuenta
        },
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message || 'Cuenta bancaria asignada correctamente');
                alertDiv.show();

                // Recargar la página después de 1 segundo para actualizar los datos
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al asignar la cuenta bancaria');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al guardar asignación:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al guardar los cambios. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// Botón para registrar nueva cuenta bancaria
$(document).on('click', '#btnGuardarRegistrarBancoCuenta', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Registrar Banco Cuenta clickeado');
    
    const formData = new FormData($('#formRegistrarBancoCuenta')[0]);
    const alertDiv = $('#alertRegistrarBancoCuenta');
    
    // Obtener y agregar el código de info_factura_venta al FormData
    const codInfoFactura = $('#registrarBancoCuentaCodInfoFactura').val();
    if (codInfoFactura) {
        formData.append('cod_info_factura_venta', codInfoFactura);
    }
    
    // Validar campos requeridos
    const nombreBanco = $('#registrarBancoCuentaNombre').val().trim();
    const numeroCuenta = $('#registrarBancoCuentaNumero').val().trim();
    
    if (!nombreBanco || !numeroCuenta) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor complete los campos obligatorios (Nombre del Banco y Número de Cuenta)');
        alertDiv.show();
        return;
    }
    
    // Enviar datos al servidor
    $.ajax({
        url: '../admin/reg_nuevo_banco_cuenta_modal_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message || 'Cuenta bancaria registrada correctamente');
                alertDiv.show();
                
                // Obtener el código de factura
                const codInfoFactura = $('#registrarBancoCuentaCodInfoFactura').val();
                
                // Si hay un código de factura y un código de banco cuenta, actualizar la cuenta en la factura
                if (codInfoFactura && response.cod_banco_cuenta) {
                    $.ajax({
                        url: '../admin/cambiar_banco_cuenta_modal_factura_ajax.php',
                        type: 'POST',
                        data: {
                            cod_info_factura_venta: codInfoFactura,
                            cod_banco_cuenta: response.cod_banco_cuenta
                        },
                        dataType: 'json',
                        success: function(updateResponse) {
                            // Construir el nombre completo de la cuenta
                            const nombreCuentaBanco = nombreBanco + ' | ' + numeroCuenta;
                            
                            // Actualizar el valor en el modal de detalle
                            $('#modal_nombre_banco_cuenta').text(nombreCuentaBanco);
                            $('#modalCodBancoCuenta').val(response.cod_banco_cuenta);
                            
                            // Cerrar modal actual y reabrir el anterior después de 1 segundo
                            setTimeout(function() {
                                $('#modalRegistrarBancoCuenta').modal('hide');
                                
                                // Esperar a que se cierre completamente y abrir el modal anterior
                                $('#modalRegistrarBancoCuenta').on('hidden.bs.modal', function(e) {
                                    $(this).off('hidden.bs.modal');
                                    $('#modalDetalleCredito').modal('show');
                                });
                            }, 1000);
                        },
                        error: function() {
                            // Si falla la actualización, mostrar el modal de detalle de todos modos
                            setTimeout(function() {
                                $('#modalRegistrarBancoCuenta').modal('hide');
                                $('#modalRegistrarBancoCuenta').on('hidden.bs.modal', function(e) {
                                    $(this).off('hidden.bs.modal');
                                    $('#modalDetalleCredito').modal('show');
                                });
                            }, 1000);
                        }
                    });
                } else {
                    // Si no hay código de factura, solo cerrar el modal y recargar
                    setTimeout(function() {
                        $('#modalRegistrarBancoCuenta').modal('hide');
                        location.reload();
                    }, 1500);
                }
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al registrar la cuenta bancaria');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al registrar:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al registrar la cuenta bancaria. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// ==================== BOTONES TIENDA ====================

// Botón para cancelar cambio de tienda
$(document).on('click', '#btnCancelarCambiarTienda', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Cambiar Tienda clickeado');
    
    // Cerrar modal actual
    $('#modalCambiarTienda').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalCambiarTienda').on('hidden.bs.modal', function(e) {
        $(this).off('hidden.bs.modal');
        $('#modalDetalleCredito').modal('show');
    });
});

// Botón para cancelar registro de tienda
$(document).on('click', '#btnCancelarRegistrarTienda', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Registrar Tienda clickeado');
    
    // Cerrar modal actual
    $('#modalRegistrarTienda').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalRegistrarTienda').on('hidden.bs.modal', function(e) {
        $(this).off('hidden.bs.modal');
        $('#modalDetalleCredito').modal('show');
    });
});

// Botón para guardar cambio de tienda
$(document).on('click', '#btnGuardarCambiarTienda', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Cambiar Tienda clickeado');
    
    const codInfoFactura = $('#modalCambiarTienda').data('codInfoFacturaVenta');
    const codTienda = $('#CambiarTiendaSelect').val();
    const alertDiv = $('#alertCambiarTienda');
    
    if (!codTienda) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('Por favor seleccione una tienda');
        alertDiv.show();
        return;
    }
    
    $.ajax({
        url: '../admin/cambiar_tienda_modal_factura_ajax_reg.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFactura,
            cod_tienda: codTienda
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message);
                alertDiv.show();
                
                // Actualizar el valor en el modal de detalle
                $('#modalTienda').text(response.nombre_tienda);
                $('#modalCodTienda').val(codTienda);
                
                // Cerrar modal actual y reabrir el anterior después de 1 segundo
                setTimeout(function() {
                    $('#modalCambiarTienda').modal('hide');
                    
                    // Esperar a que se cierre completamente y abrir el modal anterior
                    $('#modalCambiarTienda').on('hidden.bs.modal', function(e) {
                        $(this).off('hidden.bs.modal');
                        $('#modalDetalleCredito').modal('show');
                    });
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al cambiar la tienda');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cambiar tienda:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al cambiar la tienda. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// Botón para guardar registro de tienda
$(document).on('click', '#btnGuardarRegistrarTienda', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Registrar Tienda clickeado');
    
    const codInfoFactura = $('#modalRegistrarTienda').data('codInfoFacturaVenta');
    const nombreTienda = $('#registrarTiendaNombre').val().trim();
    const direccionTienda = $('#registrarTiendaDireccion').val().trim();
    const telefonoTienda = $('#registrarTiendaTelefono').val().trim();
    const alertDiv = $('#alertRegistrarTienda');
    
    if (!nombreTienda) {
        alertDiv.removeClass().addClass('alert alert-warning');
        alertDiv.text('El nombre de la tienda es requerido');
        alertDiv.show();
        return;
    }
    
    $.ajax({
        url: '../admin/reg_tienda_modal_ajax_reg.php',
        type: 'POST',
        data: {
            nombre_tienda: nombreTienda,
            direccion_tienda: direccionTienda,
            telefono_tienda: telefonoTienda,
            cod_info_factura_venta: codInfoFactura
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message);
                alertDiv.show();
                
                // Actualizar el valor en el modal de detalle
                $('#modalTienda').text(response.nombre_tienda);
                $('#modalCodTienda').val(response.cod_tienda);
                
                // Cerrar modal actual y reabrir el anterior después de 1 segundo
                setTimeout(function() {
                    $('#modalRegistrarTienda').modal('hide');
                    
                    // Esperar a que se cierre completamente y abrir el modal anterior
                    $('#modalRegistrarTienda').on('hidden.bs.modal', function(e) {
                        $(this).off('hidden.bs.modal');
                        $('#modalDetalleCredito').modal('show');
                    });
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al registrar la tienda');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al registrar:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al registrar la tienda. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// ==================== BOTONES OBSERVACIÓN ====================

// Botón para cancelar edición de observación
$(document).on('click', '#btnCancelarEditarObservacion', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar Editar Observación clickeado');
    
    // Cerrar modal actual
    $('#modalEditarObservacion').modal('hide');
    
    // Esperar a que se cierre completamente y reabrir el modal anterior
    $('#modalEditarObservacion').on('hidden.bs.modal', function(e) {
        $(this).off('hidden.bs.modal');
        $('#modalDetalleCredito').modal('show');
    });
});

// Botón para guardar edición de observación
$(document).on('click', '#btnGuardarEditarObservacion', function(e) {
    e.preventDefault();
    console.log('Botón Guardar Editar Observación clickeado');
    
    const codInfoFactura = $('#editarObservacionCodInfoFactura').val();
    const observacionTexto = $('#editarObservacionTexto').val().trim();
    const alertDiv = $('#alertEditarObservacion');
    
    $.ajax({
        url: '../admin/actualizar_observacion_modal_factura_ajax_reg.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFactura,
            observacion_tercero: observacionTexto
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alertDiv.removeClass().addClass('alert alert-success');
                alertDiv.text(response.message);
                alertDiv.show();
                
                // Actualizar el valor en el modal de detalle
                $('#modal_observacion_tercero').text(response.observacion_tercero || 'Sin observaciones');
                
                // Cerrar modal actual y reabrir el anterior después de 1 segundo
                setTimeout(function() {
                    $('#modalEditarObservacion').modal('hide');
                    
                    $('#modalEditarObservacion').on('hidden.bs.modal', function(e) {
                        $(this).off('hidden.bs.modal');
                        $('#modalDetalleCredito').modal('show');
                    });
                }, 1000);
            } else {
                alertDiv.removeClass().addClass('alert alert-danger');
                alertDiv.text(response.message || 'Error al actualizar la observación');
                alertDiv.show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al actualizar:', error);
            alertDiv.removeClass().addClass('alert alert-danger');
            alertDiv.text('Error al actualizar la observación. Por favor intente nuevamente.');
            alertDiv.show();
        }
    });
});

// Función para guardar los cambios de la entidad crediticia
function guardarEntidadCrediticia() {
    const codInfoFacturaVenta = document.getElementById('cod_info_factura_venta_editar').value;
    const codEntidadCrediticia = document.getElementById('cod_entidad_crediticia').value;
    const codTipoSimulacionCredito = document.getElementById('cod_tipo_simulacion_credito').value;
    const valorInput = document.getElementById('precio_venta_producto').value;
    const numeroCuotas = document.getElementById('numero_cuotas').value;
    const valorTotalCredito = document.getElementById('valorTotalCredito').textContent.replace(/\./g, '');
    const valorPorCuota = document.getElementById('valorPorCuota').textContent.replace(/\./g, '');

    // Validaciones
    if (!codEntidadCrediticia) {
        $('#modalErrorEntidadCrediticia').modal('show');
        return;
    }
    if (!valorInput || parseFloat(valorInput) <= 0) {
        $('#modalErrorValorContado').modal('show');
        return;
    }
    if (!numeroCuotas || parseInt(numeroCuotas) <= 0) {
        $('#modalErrorNumeroCuotas').modal('show');
        return;
    }
    // Calcular valores finales
    const select = document.getElementById('cod_entidad_crediticia');
    const selectedOption = select.options[select.selectedIndex];
    const porcentajeInteres = parseFloat(selectedOption.getAttribute('data-porcentaje')) || 0;
    const valorInputNum = parseFloat(valorInput);
    const numeroCuotasNum = parseInt(numeroCuotas);
    
    // Determinar valores según tipo de simulación
    let montoDeudaFinal, montoContadoFinal;
    if (codTipoSimulacionCredito == '1' || codTipoSimulacionCredito == '0') {
        // PRECIO DE CONTADO: El input es el valor de contado, valorTotalCredito es el crédito
        montoContadoFinal = valorInputNum;
        montoDeudaFinal = parseFloat(valorTotalCredito);
    } else {
        // PRECIO A CRÉDITO: El input es el valor a crédito, valorTotalCredito muestra el contado
        montoDeudaFinal = valorInputNum;  // El input es el precio a crédito
        montoContadoFinal = parseFloat(valorTotalCredito);  // valorTotalCredito muestra el contado
    }
    
    // Enviar datos al servidor
    $.ajax({
        url: '../admin/actualizar_entidad_crediticia_modal_factura_ajax_reg.php',
        type: 'POST',
        data: {
            cod_info_factura_venta: codInfoFacturaVenta,
            cod_entidad_crediticia: codEntidadCrediticia,
            cod_tipo_simulacion_credito: codTipoSimulacionCredito,
            monto_deuda: valorTotalCredito,
            monto_cuota: valorPorCuota,
            numero_cuotas: numeroCuotasNum,
            valor_contado: valorInputNum
        },
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                // Cerrar modal
                $('#modalEditarEntidadCrediticia').modal('hide');
                
                // Esperar a que se cierre el modal y reabrir el modal de detalle con datos actualizados
                setTimeout(function() {
                    if (window.modalParams) {
                        // Actualizar los valores en modalParams con los nuevos datos
                        window.modalParams.nombre_entidad_crediticia = selectedOption.textContent;
                        window.modalParams.monto_deuda = formatearNumero(montoDeudaFinal);
                        window.modalParams.monto_deuda_sin_interes = formatearNumero(montoContadoFinal);
                        window.modalParams.cod_entidad_crediticia = codEntidadCrediticia;
                        window.modalParams.numero_cuota = numeroCuotasNum;
                        window.modalParams.monto_cuota = formatearNumero(parseFloat(valorPorCuota));
                        
                        // Reabrir el modal de detalle con los parámetros actualizados
                        abrirModalDetalleCredito(
                            window.modalParams.nombres_apellidos,
                            window.modalParams.identificacion_tercero,
                            window.modalParams.monto_deuda,
                            window.modalParams.monto_deuda_sin_interes,
                            window.modalParams.monto_cuota,
                            window.modalParams.nombre_tipo_pago,
                            window.modalParams.cod_entidad_crediticia,
                            window.modalParams.nombre_entidad_crediticia,
                            window.modalParams.nombre_operador_credito,
                            window.modalParams.nombre_tienda,
                            window.modalParams.nombre_aliado,
                            window.modalParams.nombre_banco_cuenta,
                            window.modalParams.nombre_estado_facturacion,
                            window.modalParams.nombre_estado_revision,
                            window.modalParams.nombres_apellidos_asesor,
                            window.modalParams.observacion_tercero,
                            window.modalParams.fecha_formateada,
                            window.modalParams.hora_formateada,
                            window.modalParams.contanenar_nombre_producto,
                            window.modalParams.nombre_vendedor,
                            window.modalParams.cod_tercero,
                            window.modalParams.cod_info_factura_venta,
                            window.modalParams.cod_vendedor,
                            window.modalParams.cod_tienda,
                            window.modalParams.cod_banco_cuenta,
                            window.modalParams.numero_cuota
                        );
                    }
                }, 500);
            } else {
                $('#mensajeErrorActualizar').text('Error al actualizar: ' + (response.message || 'Error desconocido'));
                $('#modalErrorActualizar').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al guardar:', error);
            var msg = 'Error al guardar los cambios. Por favor intente nuevamente.';
            if ($('#modalErrorActualizar').length) {
                $('#mensajeErrorActualizar').text(msg);
                $('#modalErrorActualizar').modal('show');
            } else if (typeof showFloatingNotification === 'function') {
                showFloatingNotification(msg);
            } else {
                showFloatingNotification(msg);
            }
        }
    });
}

// Función para actualizar los datos en el modal de detalle
function actualizarDatosModalDetalle(nombreEntidad, valorTotal, valorContado) {
    document.getElementById('modal_entidad_crediticia').textContent = nombreEntidad;
    document.getElementById('modalValorCredito').textContent = formatearNumero(valorTotal);
    document.getElementById('modalTotalPrecioVenta').textContent = formatearNumero(valorContado);
}
// ============================================
// Función para procesar solicitud de crédito
// ============================================
function procesarSolicitudCredito(codInfoFacturaVenta, codTercero) {
    // Almacenar en variables globales
    cod_info_factura_venta_global = codInfoFacturaVenta;
    cod_tercero_global = codTercero;
    cod_tipo_metodo_aprobacion = 1;

    //console.log('Desplegar modal: modalEstudioCredito:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global });
    // Actualizar el ID en el modal de estudio
    //$('#creditoIDNumero').text(codInfoFacturaVenta);
    // Abrir el modal de estudio de crédito
    //$('#modalEstudioCredito').modal('show');
    //$('#cod_info_factura_venta_modal_estudio_credito').val(codInfoFacturaVenta);
    //$('#cod_tercero_modal_estudio_credito').val(codTercero);

    setTimeout(function() {
        console.log('Desplegar modal: modalListaCapturaImagenesIniciales:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global });
        $('#modalListaCapturaImagenesIniciales').modal('show');
        $('#cod_info_factura_venta_modal_lista_captura_imagenes').val(cod_info_factura_venta_global);
        $('#cod_tercero_modal_lista_captura_imagenes').val(cod_tercero_global);
        $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val(cod_tipo_metodo_aprobacion);
    }, 300);
}
// ============================================
// Funcionalidad Modal Estudio de Crédito
// ============================================
// Abrir modal al hacer clic en el botón "Cargar imagenes"
$(document).on('click', '#btn_procesar_solicitud', function(e) {
    e.preventDefault();
    // Obtener los datos desde los atributos data del botón
    var codInfoFacturaVenta = $(this).data('cod_info_factura_venta');
    var codTercero = $(this).data('cod_tercero');
    cod_info_factura_venta_global = codInfoFacturaVenta;
    cod_tercero_global = codTercero;
    // Llamar a la función de procesamiento
    procesarSolicitudCredito(codInfoFacturaVenta, codTercero);
});

// Manejar las acciones de los botones del modal
$(document).ready(function() {   
    // ============================================
    // Verificar si debe abrir modal de notificaciones WhatsApp después de recargar
    // ============================================
    if (sessionStorage.getItem('abrirModalNotificacionesWhatsapp') === 'true') {
        var codInfoFacturaVentaNotificacion = sessionStorage.getItem('cod_info_factura_venta_notificacion');
        
        // Limpiar el sessionStorage
        sessionStorage.removeItem('abrirModalNotificacionesWhatsapp');
        sessionStorage.removeItem('cod_info_factura_venta_notificacion');
        
        // Esperar un momento para que la página cargue completamente
        setTimeout(function() {
            $('#modalNotificacionesWhatsapp').modal('show');
            console.log('Modal modalNotificacionesWhatsapp abierto automáticamente después de procesar imágenes');
        }, 500);
    }
    
    // ============================================
    // Función para validar estudio de crédito
    // ============================================
    function validarEstudioCredito(codInfoFacturaVenta, codTercero) {
        // Cerrar el modal actual
        $('#modalEstudioCredito').modal('hide');
        // Esperar a que se cierre completamente antes de abrir el nuevo
        setTimeout(function() {
            $('#modalMetodoAprobacion').modal('show');
            console.log('Desplegar modal: modalMetodoAprobacion:', { codInfoFacturaVenta: codInfoFacturaVenta, codTercero: codTercero });
            $('#cod_info_factura_venta_modal_metodo_aprobaccion').val(cod_info_factura_venta_global);
            $('#cod_tercero_modal_metodo_aprobaccion').val(cod_tercero_global);
        }, 300);
        // Aquí puedes agregar más lógica como:
        // - Validaciones adicionales
        // - Llamadas AJAX para actualizar estado
        // - Preparar datos para el siguiente modal
    }
    
    // Botón Validar
    $('#btnValidarModalEstudio').click(function() {
        // Obtener los datos desde los atributos data del botón
        var codInfoFacturaVenta = $(this).data('cod_info_factura_venta_validar');
        var codTercero = $(this).data('cod_tercero_validar');
        cod_info_factura_venta_global = codInfoFacturaVenta;
        cod_tercero_global = codTercero;
        // Llamar a la función de validación
        validarEstudioCredito(codInfoFacturaVenta, codTercero);
    });
    
    // Botones del Modal Método de Aprobación
    
    // Botón Anterior - Volver al modal anterior
    $('#btnAnteriorModalAprobacion').click(function() {
        // Cerrar el modal actual usando jQuery
        $('#modalMetodoAprobacion').modal('hide');
        
        // Esperar a que se cierre completamente antes de abrir el anterior
        setTimeout(function() {
            $('#modalEstudioCredito').modal('show');
        }, 300);
    });
    
    // Botón Siguiente - Abrir modal de captura de imágenes
    $('#btnSiguienteModalAprobacion').click(function() {
        var creditoID = $('#creditoIDNumero').text();
        var cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_select option:selected').val();
        cod_info_factura_venta_global = creditoID;
        //cod_tercero_global = codTercero;
        // Cerrar el modal actual
        $('#modalMetodoAprobacion').modal('hide');
        // Esperar a que se cierre completamente antes de abrir el nuevo
        setTimeout(function() {
            $('#modalListaCapturaImagenesIniciales').modal('show');
            
            console.log('Desplegar modal: modalListaCapturaImagenesIniciales:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global });
            $('#cod_info_factura_venta_modal_lista_captura_imagenes').val(cod_info_factura_venta_global);
            $('#cod_tercero_modal_lista_captura_imagenes').val(cod_tercero_global);
            $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val(cod_tipo_metodo_aprobacion);
        }, 300);
    });
    
    // Botones del Modal Captura de Imágenes
    
    // Array global para almacenar imágenes capturadas temporalmente
    window.imagenesCapturadasTemp = window.imagenesCapturadasTemp || [];

    // Botón Anterior - Volver al modal anterior
    $('#btnAnteriorModalCaptura').click(function() {
        // Cerrar el modal actual
        $('#modalListaCapturaImagenesIniciales').modal('hide');
        
        // Esperar a que se cierre completamente antes de abrir el anterior
        setTimeout(function() {
            $('#modalMetodoAprobacion').modal('show');
        }, 300);
    });
    
    // Botón Siguiente - Validar y enviar imágenes
    $('#btnGuardarModalCaptura').click(function() {
        // Obtener los valores de los campos hidden
        var cod_info_factura_venta = $('#cod_info_factura_venta_modal_lista_captura_imagenes').val();
        var cod_tercero = $('#cod_tercero_modal_lista_captura_imagenes').val();
        var cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val();
        
        //console.log('Iniciando validación de imágenes...');
        //console.log('cod_info_factura_venta:', cod_info_factura_venta);
        //console.log('cod_tercero:', cod_tercero);
        //console.log('cod_tipo_metodo_aprobacion:', cod_tipo_metodo_aprobacion);
        
        // Validar que todos los campos estén llenos
        if (!cod_info_factura_venta || !cod_tercero || !cod_tipo_metodo_aprobacion) {
            // Mostrar modal de error
            $('#modalErrorDatosRequeridos').modal('show');
            return;
        }
        // Validar que todas las imágenes estén cargadas
        var todasImagenesCargadas = validarTodasImagenesCargadas();
        
        if (!todasImagenesCargadas) {
            // La función validarTodasImagenesCargadas() ya prepara y muestra el contenido
            // del modal con la lista de imágenes faltantes. Aseguramos mostrarlo aquí
            // y proporcionamos un fallback tipo toast si el modal no está presente.
            if ($('#modalImagenesFaltantes').length) {
                $('#modalImagenesFaltantes').modal('show');
            } else {
                showFloatingNotification('Por favor, capture todas las imágenes requeridas antes de continuar.');
            }
            return;
        }
        // Si todas las validaciones pasan, enviar por AJAX
        enviarImagenesAjax(cod_info_factura_venta, cod_tercero, cod_tipo_metodo_aprobacion);
    });
    
    // Botón Cancelar ya tiene data-bs-dismiss="modal" en el HTML
});

// Función para validar que todas las imágenes obligatorias estén cargadas
function validarTodasImagenesCargadas() {
    //console.log('Validando que todas las imágenes obligatorias estén cargadas...');
    
    var imagenesObligatoriasFaltantes = [];
    var totalImagenesObligatorias = 0;
    var imagenesObligatoriasCompletadas = 0;
    
    // Buscar todos los contenedores de imágenes
    $('#mostrar_datos_ajax_obtener_nota_observacion_modal .col-12').each(function() {
        var container = $(this);
        var titulo = container.find('h6').text().trim();
        
        // Verificar si la imagen es obligatoria (contiene "*")
        if (titulo.includes('*')) {
            totalImagenesObligatorias++;
            var botonCamara = container.find('.btn_activar_camara');
            
            // Verificar si el botón está deshabilitado (indica que la imagen ya fue capturada)
            if (botonCamara.prop('disabled')) {
                imagenesObligatoriasCompletadas++;
                console.log('✓ Imagen obligatoria completada:', titulo);
            } else {
                imagenesObligatoriasFaltantes.push(titulo.replace('*', '').trim());
                console.log('✗ Imagen obligatoria faltante:', titulo);
            }
        }
    });
    //console.log('Total de imágenes obligatorias:', totalImagenesObligatorias);
    //console.log('Imágenes obligatorias completadas:', imagenesObligatoriasCompletadas);
    //console.log('Imágenes obligatorias faltantes:', imagenesObligatoriasFaltantes);
    
    // Si faltan imágenes obligatorias, mostrar mensaje específico
    if (imagenesObligatoriasFaltantes.length > 0) {
        // Construir la lista de imágenes faltantes para el modal
        var listaHTML = '<ul style="list-style: none; padding: 0; margin: 0;">';
        imagenesObligatoriasFaltantes.forEach(function(imagen, index) {
            listaHTML += '<li style="padding: 0.75rem; margin-bottom: 0.5rem; background: rgba(255,255,255,0.05); border-left: 3px solid #00d4ff; border-radius: 4px; color: #fff; font-size: 0.95rem;">';
            listaHTML += '<i class="fa fa-camera" style="margin-right: 10px; color: #ff5757;"></i>';
            listaHTML += '<span style="font-weight: 500;">' + imagen + '</span>';
            listaHTML += '</li>';
        });
        listaHTML += '</ul>';
        // Llenar el contenido del modal
        $('#listaImagenesFaltantes').html(listaHTML);
        // Mostrar el modal
        $('#modalImagenesFaltantes').modal('show');
        return false;
    }
    // Verificar que haya al menos una imagen obligatoria
    if (totalImagenesObligatorias === 0) {
        console.log('No se encontraron imágenes obligatorias');
        return true; // Si no hay imágenes obligatorias, permitir continuar
    }
    // Retornar true solo si todas las imágenes obligatorias están cargadas
    return imagenesObligatoriasCompletadas === totalImagenesObligatorias;
}

// Notificación flotante ligera y moderna (fallback si no existe el modal)
function showFloatingNotification(message, duration = 3500) {
    try {
        var existing = document.getElementById('copilot-floating-notification');
        if (existing) {
            existing.textContent = message;
            existing.classList.add('visible');
            if (existing._hideTimeout) clearTimeout(existing._hideTimeout);
            existing._hideTimeout = setTimeout(function() { existing.classList.remove('visible'); }, duration);
            return;
        }
        var style = document.createElement('style');
        style.id = 'copilot-floating-notification-style';
        style.textContent = '\n#copilot-floating-notification{position:fixed;right:20px;bottom:20px;z-index:11000;background:linear-gradient(90deg,#111827,#1f2937);color:#fff;padding:12px 16px;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,0.4);font-weight:600;opacity:0;transform:translateY(6px);transition:opacity .18s,transform .18s;}\n#copilot-floating-notification.visible{opacity:1;transform:translateY(0);}\n';
        document.head.appendChild(style);
        var div = document.createElement('div');
        div.id = 'copilot-floating-notification';
        div.textContent = message;
        document.body.appendChild(div);
        // Activar animación
        setTimeout(function() { div.classList.add('visible'); }, 10);
        div._hideTimeout = setTimeout(function() { div.classList.remove('visible'); }, duration);
    } catch (e) {
        // Fallback final: usar alert si todo lo demás falla
        try { alert(message); } catch (err) { console.log(message); }
    }
}

// Función para enviar las imágenes por AJAX

// Función para enviar las imágenes por AJAX
function enviarImagenesAjax(cod_info_factura_venta, cod_tercero, cod_tipo_metodo_aprobacion) {
    var tab = '';
    var campo = '';
    var tipo_ajax = '';
    var pagina = '';
    console.log('Enviando imágenes por AJAX...');
    // Mostrar indicador de carga
    $('#btnGuardarModalCaptura').prop('disabled', true);
    $('#btnGuardarModalCaptura').html('<i class="fa fa-spinner fa-spin"></i> Procesando...');
    
    // Crear FormData para enviar los datos
    var formData = new FormData();
    formData.append('action', 'procesar_imagenes_credito');
    formData.append('cod_info_factura_venta', cod_info_factura_venta);
    formData.append('cod_tercero', cod_tercero);
    formData.append('cod_tipo_metodo_aprobacion', cod_tipo_metodo_aprobacion);
    
    // Primero guardar todas las imágenes capturadas
    if (window.imagenesCapturadasTemp && window.imagenesCapturadasTemp.length > 0) {
        console.log('Guardando', window.imagenesCapturadasTemp.length, 'imágenes capturadas...');
        guardarImagenesCapturadas().then(function() {
            // Después de guardar las imágenes, continuar con el proceso
            enviarProcesarImagenes(formData);
        }).catch(function(error) {
            console.error('Error al guardar imágenes:', error);
            $('#btnGuardarModalCaptura').prop('disabled', false);
            $('#btnGuardarModalCaptura').html('Guardar');
            alert('Error al guardar las imágenes capturadas');
        });
    } else {
        // Si no hay imágenes nuevas, continuar directamente
        enviarProcesarImagenes(formData);
    }
}

// Función auxiliar para guardar las imágenes capturadas
function guardarImagenesCapturadas() {
    return new Promise(function(resolve, reject) {
        var promesas = [];
        
        window.imagenesCapturadasTemp.forEach(function(imagen) {
            var formData = new FormData();
            formData.append('cod_info_factura_venta', imagen.cod_info_factura_venta);
            formData.append('cod_tercero', imagen.cod_tercero);
            formData.append('cod_tipo_metodo_aprobacion', imagen.cod_tipo_metodo_aprobacion);
            formData.append('cod_nota_observacion', imagen.cod_nota_observacion);
            formData.append('url_img1', imagen.blob, imagen.filename);
            
            var promesa = fetch('../admin/guardar_foto_camara_ajax.php', {
                method: 'POST',
                body: formData
            }).then(function(response) {
                return response.text();
            }).then(function(responseText) {
                try {
                    var result = JSON.parse(responseText);
                    if (result.success) {
                        console.log('Imagen guardada:', imagen.filename);
                    } else {
                        throw new Error(result.message || 'Error al guardar imagen');
                    }
                } catch (parseError) {
                    throw new Error('Error al procesar respuesta del servidor');
                }
            });
            promesas.push(promesa);
        });
        
        Promise.all(promesas)
            .then(function() {
                console.log('Todas las imágenes guardadas exitosamente');
                // Limpiar array temporal
                window.imagenesCapturadasTemp = [];
                resolve();
            })
            .catch(function(error) {
                reject(error);
            });
    });
}

// Función auxiliar para enviar el procesamiento
function enviarProcesarImagenes(formData) {
    var cod_info_factura_venta = formData.get('cod_info_factura_venta');
    var cod_tercero = formData.get('cod_tercero');
    var tab = '';
    var campo = '';
    var tipo_ajax = '';
    var pagina = '';
    // Enviar solicitud AJAX
    $.ajax({
        url: '../admin/reg_procesar_imagenes_credito_modal_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            var success = response.success;
            var afectado = response.afectado;
            var message = response.message;
            //console.log('Respuesta del servidor:', response);
            $('#btnGuardarModalCaptura').html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

            if (success) {
                // Si la respuesta es exitosa, proceder a enviar la notificación al chatbot
                var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
                $.ajax({
                    type: "GET",
                    url: "../admin/enviar_notificacion_chatbot_canal_telegram_registro_cliente_simulador_credito_json.php",
                    data: datos_url_ajax,
                    //dataType: 'json',
                    beforeSend: function(objeto){
                        $('#btnGuardarModalCaptura').html('<i class="fa fa-spinner fa-spin"></i> Notificando via..');
                    },
                    success:function(respuesta){
                        var respuesta_ok = respuesta.ok;

                        if(respuesta_ok == '1') {
                            var cod_estado_enviado = 1;
                        } else {
                            var cod_estado_enviado = 0;
                        }
                        var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'respuesta_ok='+respuesta_ok+'&'+'cod_estado_enviado='+cod_estado_enviado+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_info_factura_venta_notificacion_chatbot_telegram_registro_cliente_simulador_credito_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#btnGuardarModalCaptura').html('<img src="../imagenes/ajax-loader.gif"> Notificando...');
                            },
                            success:function(respuesta){
                                var cod_estado_enviado = respuesta.cod_estado_enviado;
                                var telefono_cliente = respuesta.telefono1_tercero;
                                var telefono_revisor = respuesta.telefono_revisor;
                                var codigo_estado_facturacion = respuesta.codigo_estado_facturacion;

                                // Éxito - cerrar modal y mostrar mensaje
                                $('#modalListaCapturaImagenesIniciales').modal('hide');
                                //alert('Imágenes procesadas exitosamente. ' + message);
                                
                                // Guardar en sessionStorage que debe abrir el modal después de recargar
                                sessionStorage.setItem('abrirModalNotificacionesWhatsapp', 'true');
                                sessionStorage.setItem('cod_info_factura_venta_notificacion', cod_info_factura_venta);
                
                                // Llenar los campos hidden del modal de notificaciones
                                $('#modal_whatsapp_cod_info_factura_venta').val(cod_info_factura_venta);
                                $('#modal_whatsapp_cod_tercero').val(cod_tercero);
                                $('#modal_whatsapp_telefono_cliente').val(telefono_cliente);
                                $('#modal_whatsapp_telefono_revisor').val(telefono_revisor);
                                $('#modal_whatsapp_codigo_estado_facturacion').val(codigo_estado_facturacion);
                                // Guardar datos en localStorage para mostrar el modal después de recargar
                                localStorage.setItem('mostrarModalWhatsapp', 'true');
                                localStorage.setItem('whatsapp_cod_info_factura_venta', cod_info_factura_venta);
                                localStorage.setItem('whatsapp_cod_tercero', cod_tercero);
                                localStorage.setItem('whatsapp_telefono_cliente', telefono_cliente);
                                localStorage.setItem('whatsapp_telefono_revisor', telefono_revisor);
                                localStorage.setItem('whatsapp_codigo_estado_facturacion', codigo_estado_facturacion);
                                
                                // Limpiar URL y recargar la página después del éxito
                                setTimeout(function() {
                                    // Limpiar todas las variables de la URL manteniendo solo la página base
                                    const baseUrl = window.location.origin + window.location.pathname;
                                    window.history.replaceState({}, document.title, baseUrl);
                                    location.reload();
                                }, 1000); // Esperar 1 segundo para que el usuario vea el mensaje
                            }
                        });
                    }
                });
            } else {
                // Error del servidor
                var msg = 'Error al procesar las imágenes: ' + (response.message || 'Error desconocido');
                if ($('#modalErrorGuardarFoto').length) {
                    $('#mensajeErrorGuardarFoto').text(msg);
                    $('#modalErrorGuardarFoto').modal('show');
                } else if ($('#modalErrorActualizar').length) {
                    $('#mensajeErrorActualizar').text(msg);
                    $('#modalErrorActualizar').modal('show');
                } else if (typeof showFloatingNotification === 'function') {
                    showFloatingNotification(msg);
                } else {
                    showFloatingNotification(msg);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX:', error);
            var msg = 'Error de conexión al procesar las imágenes. Por favor, inténtelo de nuevo.';
            if ($('#modalErrorConexionRechazo').length) {
                $('#modalErrorConexionRechazo').modal('show');
            } else if (typeof showFloatingNotification === 'function') {
                showFloatingNotification(msg);
            } else {
                showFloatingNotification(msg);
            }
        },
        complete: function() {
            // Restaurar botón
            $('#btnGuardarModalCaptura').prop('disabled', false);
            $('#btnGuardarModalCaptura').html('Guardando...');
        }
    });
}
// ===============================
// FUNCIONES PARA MODAL DE CÁMARA
// ===============================
// Variables globales para la cámara
window.stream = window.stream || null;
window.video = window.video || null;
window.canvas = window.canvas || null;
window.currentCodNotaObservacion = window.currentCodNotaObservacion || null;

// Función para reabrir el modal de origen después de cerrar la cámara
function reabrirModalOrigen() {
    if (window.modalOrigenCamara) {
        console.log('Reabriendo modal de origen:', window.modalOrigenCamara);
        setTimeout(() => {
            if (window.modalOrigenCamara === 'modalListaCapturaImagenesIniciales') {
                $('#modalListaCapturaImagenesIniciales').modal('show');
                console.log('Modal modalListaCapturaImagenesIniciales reabierto exitosamente');
            } else if (window.modalOrigenCamara === 'modalProcesarOtrasImagenes') {
                console.log('Reabriendo modal = modalProcesarOtrasImagenes');
                $('#modalProcesarOtrasImagenes').modal('show');
                //console.log('Modal modalProcesarOtrasImagenes reabierto exitosamente');
                
                // Recargar los datos del modal modalProcesarOtrasImagenes
                setTimeout(() => {
                    const codInfo = $('#cod_info_factura_venta_modal_procesar_otras_imagenes').val();
                    const codTercero = $('#cod_tercero_modal_procesar_otras_imagenes').val();
                    if (codInfo && codTercero) {
                        console.log('Recargando datos del modal modalProcesarOtrasImagenes...');
                        cargarDatosModalOtrasImagenes(codInfo, codTercero);
                    }
                }, 200);
            }
            // Limpiar la referencia
            window.modalOrigenCamara = null;
        }, 500);
    }
}

// Función para abrir el modal de cámara
function abrirModalCamara(cod_nota_observacion) {
    window.currentCodNotaObservacion = cod_nota_observacion;
    // Variables para los valores correctos
    let cod_info_factura_venta = '';
    let cod_tercero = '';
    let cod_tipo_metodo_aprobacion = '';
    let modalOrigen = null;

    // Verificar si modalListaCapturaImagenesIniciales está abierto
    const modalListaCaptura = document.getElementById('modalListaCapturaImagenesIniciales');
    if (modalListaCaptura && modalListaCaptura.classList.contains('show')) {
        modalOrigen = 'modalListaCapturaImagenesIniciales';
        console.log('Cámara abierta desde modalListaCapturaImagenesIniciales');
        cod_info_factura_venta = $('#cod_info_factura_venta_modal_lista_captura_imagenes').val();
        cod_tercero = $('#cod_tercero_modal_lista_captura_imagenes').val();
        cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val();
    }

    // Verificar si modalProcesarOtrasImagenes está abierto
    const modalProcesarOtras = document.getElementById('modalProcesarOtrasImagenes');
    if (modalProcesarOtras && modalProcesarOtras.classList.contains('show')) {
        modalOrigen = 'modalProcesarOtrasImagenes';
        console.log('Cámara abierta desde modalProcesarOtrasImagenes');
        cod_info_factura_venta = $('#cod_info_factura_venta_modal_procesar_otras_imagenes').val();
        cod_tercero = $('#cod_tercero_modal_procesar_otras_imagenes').val();
        cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_modal_procesar_otras_imagenes').val();
        // Ocultar el modal modalProcesarOtrasImagenes
        $('#modalProcesarOtrasImagenes').modal('hide');
    }

    // Guardar referencia del modal de origen para restaurarlo después
    window.modalOrigenCamara = modalOrigen;

    // Verificar si Bootstrap está disponible
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap no está disponible');
        var msg = 'Error: Bootstrap no está cargado';
        if (typeof showFloatingNotification === 'function') {
            showFloatingNotification(msg);
        } else {
            showFloatingNotification(msg);
        }
        return;
    }

    const modalElement = document.getElementById('modalCapturaCamara');
    if (!modalElement) {
        console.error('Modal no encontrado');
        var msg = 'Error: Modal de cámara no encontrado';
        if (typeof showFloatingNotification === 'function') {
            showFloatingNotification(msg);
        } else {
            showFloatingNotification(msg);
        }
        return;
    }

    try {
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();

        // Ajustar posicionamiento INMEDIATAMENTE para móviles
        if (window.innerWidth <= 576) {
            ajustarModalCamaraMovil();
        }

        // Ajustar posicionamiento específicamente para móviles con delay adicional
        setTimeout(() => {
            if (window.innerWidth <= 576) {
                ajustarModalCamaraMovil();
            }
        }, 100);

        // Tercer ajuste para asegurar que se aplique
        setTimeout(() => {
            if (window.innerWidth <= 576) {
                ajustarModalCamaraMovil();
            }
        }, 300);

        // Inicializar cámara cuando se abre el modal
        setTimeout(() => {
            inicializarCamara();
            // Asignar los valores correctos a los campos ocultos
            $('#cod_info_factura_venta_modal_captura_imagenes').val(cod_info_factura_venta);
            $('#cod_tercero_modal_captura_imagenes').val(cod_tercero);
            $('#cod_tipo_metodo_aprobacion_modal_captura_imagenes').val(cod_tipo_metodo_aprobacion);
            $('#cod_nota_observacion_modal_captura_imagenes').val(cod_nota_observacion);
        }, 500);
    } catch (error) {
        console.error('Error al abrir modal:', error);
        var msg = 'Error al abrir el modal de cámara';
        if (typeof showFloatingNotification === 'function') {
            showFloatingNotification(msg);
        } else {
            showFloatingNotification(msg);
        }
    }
}
// Función para inicializar la cámara
async function inicializarCamara() {
    window.video = document.getElementById('videoCamera');
    window.canvas = document.getElementById('canvasCapture');
    
    // Verificar si el navegador soporta acceso a la cámara
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.error('El navegador no soporta acceso a la cámara');
        $('#modalErrorNavegadorCamara').modal('show');
        return;
    }
    
    // Verificar si estamos en HTTPS (requerido para cámara)
    if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
        console.warn('Conexión no segura detectada. La cámara puede no funcionar correctamente sin HTTPS.');
    }
    
    try {
        // Solicitar acceso a la cámara con AUTOENFOQUE CONTINUO y máxima calidad
        const constraints = {
            video: {
                facingMode: { ideal: 'environment' }, // Preferir cámara trasera
                width: { ideal: 1920, min: 1280 },    // Resolución máxima posible
                height: { ideal: 1080, min: 720 },    // Resolución máxima posible
                aspectRatio: { ideal: 16/9 },         // Aspecto ideal
                frameRate: { ideal: 30, min: 15 },    // Frame rate alto
                focusMode: { ideal: 'continuous' },   // AUTOENFOQUE CONTINUO
                resizeMode: 'none'                    // Sin redimensionamiento automático
            }
        };
        
        //console.log('📸 Solicitando acceso a la cámara con autoenfoque...');
        window.stream = await navigator.mediaDevices.getUserMedia(constraints);
        
        if (window.video && window.stream) {
            window.video.srcObject = window.stream;
            
            // Obtener el track de video para configurar capacidades avanzadas
            const videoTrack = window.stream.getVideoTracks()[0];
            const settings = videoTrack.getSettings();
            const capabilities = videoTrack.getCapabilities();
            
            //console.log('✅ Resolución obtenida:', settings.width + 'x' + settings.height);
            //console.log('📋 Capacidades de la cámara:', capabilities);
            
            // Configurar AUTOENFOQUE CONTINUO si está disponible
            if (capabilities.focusMode && capabilities.focusMode.includes('continuous')) {
                try {
                    await videoTrack.applyConstraints({
                        advanced: [{ focusMode: 'continuous' }]
                    });
                    //console.log('✅ Autoenfoque continuo activado');
                } catch (focusError) {
                    //console.warn('⚠️ No se pudo activar autoenfoque continuo:', focusError);
                }
            }
            
            // Verificar si hay soporte para linterna (torch)
            if (capabilities.torch) {
                console.log('🔦 Linterna disponible');
                window.torchSupported = true;
                window.videoTrack = videoTrack;
                mostrarBotonLinterna();
            } else {
                //console.log('⚠️ Linterna no disponible en este dispositivo');
                window.torchSupported = false;
            }
            
            // Esperar a que el video esté listo antes de reproducir
            window.video.onloadedmetadata = () => {
                //console.log('📐 Dimensiones del video:', window.video.videoWidth + 'x' + window.video.videoHeight);
                window.video.play().then(() => {
                    //console.log('✅ Cámara inicializada con autoenfoque');
                    }).catch(playError => {
                    console.error('❌ Error al reproducir video:', playError);
                    var msg = 'Error al inicializar la vista de la cámara.';
                    if ($('#modalErrorCamaraNoLista').length) {
                        $('#modalErrorCamaraNoLista').modal('show');
                    } else if (typeof showFloatingNotification === 'function') {
                        showFloatingNotification(msg);
                    } else {
                        showFloatingNotification(msg);
                    }
                });
            };
        }
        
    } catch (error) {
        console.error('❌ Error al acceder a la cámara:', error);
        // FALLBACK: Intentar con configuración de calidad media
        try {
            //console.log('Intentando con calidad media...');
            const fallbackConstraints = {
                video: {
                    facingMode: { ideal: 'environment' },
                    width: { ideal: 1280, min: 720 },
                    height: { ideal: 720, min: 480 }
                }
            };
            
            window.stream = await navigator.mediaDevices.getUserMedia(fallbackConstraints);
            
            if (window.video && window.stream) {
                window.video.srcObject = window.stream;
                const videoTrack = window.stream.getVideoTracks()[0];
                const settings = videoTrack.getSettings();
                console.log('Resolución fallback obtenida:', settings.width + 'x' + settings.height);
                
                window.video.onloadedmetadata = () => {
                    window.video.play().then(() => {
                        //console.log('Cámara inicializada con calidad media');
                    }).catch(playError => {
                        console.error('Error al reproducir video:', playError);
                        var msg = 'Error al inicializar la vista de la cámara.';
                        if ($('#modalErrorCamaraNoLista').length) {
                            $('#modalErrorCamaraNoLista').modal('show');
                        } else if (typeof showFloatingNotification === 'function') {
                            showFloatingNotification(msg);
                        } else {
                            showFloatingNotification(msg);
                        }
                    });
                };
            }
            
        } catch (fallbackError) {
            console.error('Error también con calidad media:', fallbackError);
            // Proporcionar mensajes de error más específicos
            let mensaje = 'No se pudo acceder a la cámara. ';
            
            if (fallbackError.name === 'NotAllowedError') {
                mensaje += 'Permiso denegado. Por favor, permite el acceso a la cámara en tu navegador.';
            } else if (fallbackError.name === 'NotFoundError') {
                mensaje += 'No se encontró ninguna cámara en este dispositivo.';
            } else if (fallbackError.name === 'NotReadableError') {
                mensaje += 'La cámara está siendo usada por otra aplicación. Cierra otras aplicaciones que puedan estar usando la cámara.';
            } else if (fallbackError.name === 'OverconstrainedError') {
                mensaje += 'La configuración de la cámara no es compatible con este dispositivo.';
            } else if (fallbackError.name === 'AbortError') {
                mensaje += 'La solicitud fue cancelada. Por favor, intenta de nuevo.';
            } else {
                mensaje += 'Error desconocido: ' + fallbackError.message;
            }
            // Mostrar modal específico de navegador/cámara si existe, si no usar toast, si no alert
            if ($('#modalErrorNavegadorCamara').length) {
                // Reemplazar el párrafo principal en el modal por el mensaje detallado
                $('#modalErrorNavegadorCamara .modal-body p').first().text(mensaje);
                $('#modalErrorNavegadorCamara').modal('show');
            } else if (typeof showFloatingNotification === 'function') {
                showFloatingNotification(mensaje);
            } else {
                alert(mensaje);
            }
        }
    }
}

// Función para mostrar el botón de linterna
function mostrarBotonLinterna() {
    const btnLinterna = document.getElementById('btnToggleLinterna');
    if (btnLinterna && window.torchSupported) {
        btnLinterna.style.display = 'block';
        console.log('✅ Botón de linterna visible');
    }
}

// Variable global para estado de la linterna
window.torchEnabled = false;

// Función para activar/desactivar la linterna
async function toggleLinterna() {
    if (!window.torchSupported || !window.videoTrack) {
        console.warn('⚠️ Linterna no disponible');
        return;
    }
    
    try {
        window.torchEnabled = !window.torchEnabled;
        
        await window.videoTrack.applyConstraints({
            advanced: [{ torch: window.torchEnabled }]
        });
        
        const btnLinterna = document.getElementById('btnToggleLinterna');
        if (btnLinterna) {
            if (window.torchEnabled) {
                btnLinterna.classList.remove('btn-outline-light');
                btnLinterna.classList.add('btn-warning');
                btnLinterna.innerHTML = '<i class="fas fa-lightbulb"></i>';
                console.log('🔦 Linterna ENCENDIDA');
            } else {
                btnLinterna.classList.remove('btn-warning');
                btnLinterna.classList.add('btn-outline-light');
                btnLinterna.innerHTML = '<i class="fas fa-lightbulb"></i>';
                console.log('🔦 Linterna APAGADA');
            }
        }
    } catch (error) {
        //console.error('Error al activar/desactivar linterna:', error);
        var msg = 'No se pudo activar la linterna en este dispositivo.';
        if (typeof showFloatingNotification === 'function') {
            showFloatingNotification(msg);
        } else {
            showFloatingNotification(msg);
        }
    }
}

// Event listener para el botón de linterna
document.addEventListener('DOMContentLoaded', function() {
    const btnLinterna = document.getElementById('btnToggleLinterna');
    if (btnLinterna) {
        btnLinterna.addEventListener('click', toggleLinterna);
    }
});

// Función para cerrar el modal y limpiar recursos
function cerrarModalCamara() {
    // Prevenir recursión infinita
    if (window._modalClosing) {
        //console.log('Modal ya está cerrándose, evitando recursión');
        return;
    }
    window._modalClosing = true;
    
    //console.log('Cerrando modal de cámara...');
    
    // Apagar la linterna si está encendida
    if (window.torchEnabled && window.videoTrack) {
        window.videoTrack.applyConstraints({
            advanced: [{ torch: false }]
        }).catch(err => console.warn('Error al apagar linterna:', err));
        window.torchEnabled = false;
    }
    
    // Ocultar botón de linterna
    const btnLinterna = document.getElementById('btnToggleLinterna');
    if (btnLinterna) {
        btnLinterna.style.display = 'none';
        btnLinterna.classList.remove('btn-warning');
        btnLinterna.classList.add('btn-outline-light');
    }
    
    // Detener stream de cámara con referencia correcta
    if (window.stream) {
        window.stream.getTracks().forEach(track => {
            track.stop();
            //console.log('Track detenido:', track.kind);
        });
        window.stream = null;
    }
    
    // Limpiar video element
    if (window.video) {
        window.video.srcObject = null;
    }
    
    // Cerrar modal usando métodos directos sin disparar eventos adicionales
    const modalElement = document.getElementById('modalCapturaCamara');
    if (modalElement) {
        try {
            // Método directo: manipulación del DOM sin eventos
            modalElement.style.display = 'none';
            modalElement.classList.remove('show', 'fade');
            modalElement.setAttribute('aria-hidden', 'true');
            modalElement.removeAttribute('aria-modal');
            modalElement.removeAttribute('role');
            
            // Remover todos los backdrops
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            
            // Restaurar estado del body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.body.style.position = '';
            
            // Remover clases de Bootstrap del html
            document.documentElement.classList.remove('modal-open');
            
            //console.log('Modal cerrado correctamente');
            
        } catch (error) {
            console.error('Error al cerrar modal:', error);
            
            // Fallback extremo
            modalElement.style.display = 'none !important';
            modalElement.style.visibility = 'hidden';
            modalElement.style.opacity = '0';
            console.log('Modal ocultado con fallback extremo');
        }
    }
    
    // Restablecer flag después de un breve delay
    setTimeout(() => {
        window._modalClosing = false;
    }, 100);
}

// Función para ajustar el modal de cámara específicamente en móviles
function ajustarModalCamaraMovil() {
    // Verificar si estamos en un dispositivo móvil
    if (window.innerWidth <= 576) {
        console.log('Ajustando modal para dispositivo móvil...');
        
        const modalDialog = document.querySelector('#modalCapturaCamara .modal-dialog');
        const modalContent = document.querySelector('#modalCapturaCamara .modal-content');
        const modalHeader = document.querySelector('#modalCapturaCamara .modal-header');
        const modalBody = document.querySelector('#modalCapturaCamara .modal-body');
        const modalFooter = document.querySelector('#modalCapturaCamara .modal-footer');
        
        // Obtener altura real del viewport
        const viewportHeight = window.innerHeight;
        const viewportWidth = window.innerWidth;
        
        console.log(`Viewport: ${viewportWidth}x${viewportHeight}`);
        
        if (modalDialog && modalContent && modalFooter) {
            // Modal dialog ocupando toda la pantalla
            modalDialog.style.cssText = `position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important;
            bottom: 0 !important; width: ${viewportWidth}px !important; height: ${viewportHeight}px !important; max-width: ${viewportWidth}px !important;
            max-height: ${viewportHeight}px !important; margin: 0 !important; padding: 0 !important; z-index: 1055 !important;`;
            // Modal content ocupando toda la pantalla
            modalContent.style.cssText = `position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important;
            bottom: 0 !important; width: ${viewportWidth}px !important; height: ${viewportHeight}px !important; max-width: ${viewportWidth}px !important;
            max-height: ${viewportHeight}px !important; border-radius: 0 !important; border: none !important; margin: 0 !important;
            padding: 0 !important; background: #000000 !important;`;
            // Header en la parte superior
            if (modalHeader) {
                modalHeader.style.cssText = `position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; 
                width: ${viewportWidth}px !important; height: 50px !important; z-index: 1060 !important; background: rgba(0,0,0,0.9) !important; padding: 8px 15px !important;
                border-bottom: none !important; display: flex !important; align-items: center !important; justify-content: center !important;`;
            }
            // Body ocupando el área entre header y footer
            if (modalBody) {
                const bodyHeight = viewportHeight - 130; // 50px header + 80px footer
                modalBody.style.cssText = `position: fixed !important; top: 50px !important; left: 0 !important; right: 0 !important;
                bottom: 80px !important; width: ${viewportWidth}px !important; height: ${bodyHeight}px !important;
                padding: 0 !important; margin: 0 !important; overflow: hidden !important; z-index: 1000 !important;`;
            }
            // Footer FIJO en la parte inferior visible
            modalFooter.style.cssText = `position: fixed !important; bottom: 0 !important; left: 0 !important;
                right: 0 !important; width: ${viewportWidth}px !important; height: 80px !important;
                z-index: 1070 !important; background: rgba(0,0,0,0.95) !important; padding: 10px 15px !important;
                margin: 0 !important; border-top: 2px solid rgba(255,255,255,0.3) !important; display: flex !important;
                align-items: center !important; justify-content: center !important; box-shadow: 0 -3px 15px rgba(0,0,0,0.8) !important;`;
            // Asegurar que los botones sean visibles y funcionales
            const buttons = modalFooter.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.style.cssText += `min-height: 45px !important; max-height: 45px !important; font-size: 14px !important;
                font-weight: 600 !important; border-radius: 22px !important; box-shadow: 0 2px 8px rgba(0,0,0,0.4) !important;
                border: 2px solid rgba(255,255,255,0.1) !important; z-index: 1071 !important; min-width: 120px !important; max-width: 140px !important;`;
            });
            // Ajustar el contenedor de botones
            const buttonContainer = modalFooter.querySelector('.d-flex');
            if (buttonContainer) {
                buttonContainer.style.cssText = `width: 100% !important; max-width: 400px !important; justify-content: center !important;
                align-items: center !important; gap: 15px !important; height: 100% !important; margin: 0 auto !important;`;
            }
            //console.log('Modal ajustado correctamente para móvil con medidas exactas');
        }
    }
}
// Event listeners usando event delegation para contenido AJAX
//console.log('Configurando event delegation para botones de cámara...');

// Registrar listeners globales una sola vez (evita duplicados si este script se inyecta varias veces)
if (!window._cameraEventsConfigured) {
    window._cameraEventsConfigured = true;
    //console.log('🔧 Configurando eventos de cámara y modal por primera vez...');

    // Event listeners para el modal cuando se carga la página
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', configurarModalEventos);
    } else {
        configurarModalEventos();
    }
    
    // Forzar ajuste cuando el modal se muestra (solo registrar una vez)
    document.addEventListener('shown.bs.modal', function(event) {
        if (event.target.id === 'modalCapturaCamara') {
            setTimeout(() => {
                ajustarModalCamaraMovil();
            }, 100);
        }
        
        // Cargar notas dinámicamente cuando se muestra modalListaCapturaImagenesIniciales
        if (event.target.id === 'modalListaCapturaImagenesIniciales') {
            // Verificar si ya se cargaron las notas para esta sesión del modal
            if (!event.target.dataset.notasCargadas) {
                console.log('Bootstrap 5 - Modal modalListaCapturaImagenesIniciales mostrado por primera vez, ejecutando cargarNotasModalDinamicamente...');
                event.target.dataset.notasCargadas = 'true';
                setTimeout(() => {
                    cargarNotasModalDinamicamente();
                }, 100);
            } else {
                console.log('Bootstrap 5 - Modal modalListaCapturaImagenesIniciales ya tiene notas cargadas, saltando cargarNotasModalDinamicamente');
            }
        }
    });

    // Compatibilidad con jQuery/Bootstrap 4 para modalListaCapturaImagenesIniciales
    $(document).on('shown.bs.modal', '#modalListaCapturaImagenesIniciales', function() {
        // Verificar si ya se cargaron las notas para esta sesión del modal
        if (!$(this).data('notas-cargadas')) {
            //console.log('jQuery/Bootstrap 4 - Modal modalListaCapturaImagenesIniciales mostrado por primera vez, ejecutando cargarNotasModalDinamicamente...');
            $(this).data('notas-cargadas', true);
            setTimeout(() => {
                cargarNotasModalDinamicamente();
            }, 100);
        } else {
            //console.log('jQuery/Bootstrap 4 - Modal modalListaCapturaImagenesIniciales ya tiene notas cargadas, saltando cargarNotasModalDinamicamente');
        }
    });

    // Limpiar bandera cuando se cierre el modal para permitir recarga en próxima apertura
    document.addEventListener('hidden.bs.modal', function(event) {
        if (event.target.id === 'modalListaCapturaImagenesIniciales') {
            console.log('🗑️ Modal modalListaCapturaImagenesIniciales cerrado, limpiando bandera de notas cargadas');
            delete event.target.dataset.notasCargadas;
        }
    });

    // Compatibilidad jQuery para limpiar bandera
    $(document).on('hidden.bs.modal', '#modalListaCapturaImagenesIniciales', function() {
        //console.log('Modal modalListaCapturaImagenesIniciales cerrado (jQuery), limpiando bandera de notas cargadas');
        $(this).removeData('notas-cargadas');
    });
    //console.log('✅ Event listeners configurados para modalListaCapturaImagenesIniciales');
}
// Handler para el botón capturar que lee los parámetros de data attributes
function handleCapturarFoto(event) {
    const btn = event.target.closest('#btnCapturarFoto');
    if (!btn) return;
    
    const codInfoFactura = btn.getAttribute('data-cod-info-factura');
    const cod_nota_observacion = btn.getAttribute('data-cod-nota-observacion'); 
    const codTercero = btn.getAttribute('data-cod-tercero');
    
    // Llamar a la función principal con los parámetros extraídos
    funcionCapturarFoto(codInfoFactura, codTercero, cod_nota_observacion);
}

function configurarModalEventos() {
    //console.log('Configurando eventos del modal...');
    
    // Conectar botón capturar
    const btnCapturar = document.getElementById('btnCapturarFoto');
    if (btnCapturar) {
        // Remover listener previo si existe para evitar duplicados
        btnCapturar.removeEventListener('click', handleCapturarFoto);
        
        // Añadir nuevo listener que lee los parámetros de data attributes
        btnCapturar.addEventListener('click', handleCapturarFoto);
    }
    
    // Conectar botón cancelar
    const btnCancelar = document.getElementById('btnCancelarCamara');
    if (btnCancelar) {
        btnCancelar.addEventListener('click', cerrarModalCamara);
    }
    
    // Conectar botón cancelar modal captura
    const btnCancelarModalCaptura = document.getElementById('btnCancelarModalCaptura');
    if (btnCancelarModalCaptura) {
        btnCancelarModalCaptura.addEventListener('click', function() {
            //console.log('Cerrando modalListaCapturaImagenesIniciales desde btnCancelarModalCaptura');
            // Compatibilidad Bootstrap 4 y 5
            if (typeof $ !== 'undefined' && $.fn.modal) {
                // Bootstrap 4 con jQuery
                $('#modalListaCapturaImagenesIniciales').modal('hide');
                //console.log('Modal cerrado usando jQuery/Bootstrap 4');
            } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                // Bootstrap 5
                const modalListaCapturaImagenesIniciales = document.getElementById('modalListaCapturaImagenesIniciales');
                if (modalListaCapturaImagenesIniciales) {
                    try {
                        // Intentar getInstance si existe (Bootstrap 5.1+)
                        const modal = bootstrap.Modal.getInstance ? 
                                     bootstrap.Modal.getInstance(modalListaCapturaImagenesIniciales) || new bootstrap.Modal(modalListaCapturaImagenesIniciales) :
                                     new bootstrap.Modal(modalListaCapturaImagenesIniciales);
                        modal.hide();
                        console.log('Modal cerrado usando Bootstrap 5');
                    } catch (error) {
                        console.error('Error cerrando modal con Bootstrap 5:', error);
                    }
                }
            } else {
                console.warn('No se encontró Bootstrap disponible');
            }
        });
    }
    
    // Conectar botón cancelar modal aprobación
    const btnCancelarModalAprobacion = document.getElementById('btnCancelarModalAprobacion');
    if (btnCancelarModalAprobacion) {
        btnCancelarModalAprobacion.addEventListener('click', function() {
            //console.log('Cerrando modalMetodoAprobacion desde btnCancelarModalAprobacion');
            // Compatibilidad Bootstrap 4 y 5
            if (typeof $ !== 'undefined' && $.fn.modal) {
                // Bootstrap 4 con jQuery
                $('#modalMetodoAprobacion').modal('hide');
                //console.log('Modal cerrado usando jQuery/Bootstrap 4');
            } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                // Bootstrap 5
                const modalMetodoAprobacion = document.getElementById('modalMetodoAprobacion');
                if (modalMetodoAprobacion) {
                    try {
                        // Intentar getInstance si existe (Bootstrap 5.1+)
                        const modal = bootstrap.Modal.getInstance ? 
                                     bootstrap.Modal.getInstance(modalMetodoAprobacion) || new bootstrap.Modal(modalMetodoAprobacion) :
                                     new bootstrap.Modal(modalMetodoAprobacion);
                        modal.hide();
                        console.log('Modal cerrado usando Bootstrap 5');
                    } catch (error) {
                        console.error('Error cerrando modal con Bootstrap 5:', error);
                    }
                }
            } else {
                console.warn('No se encontró Bootstrap disponible');
            }
        });
    }
    
    // Conectar botón cancelar modal estudio
    const btnCancelarModalEstudio = document.getElementById('btnCancelarModalEstudio');
    if (btnCancelarModalEstudio) {
        btnCancelarModalEstudio.addEventListener('click', function() {
            //console.log('Cerrando modalEstudioCredito desde btnCancelarModalEstudio');
            // Compatibilidad Bootstrap 4 y 5
            if (typeof $ !== 'undefined' && $.fn.modal) {
                // Bootstrap 4 con jQuery
                $('#modalEstudioCredito').modal('hide');
                //console.log('Modal cerrado usando jQuery/Bootstrap 4');
            } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                // Bootstrap 5
                const modalEstudioCredito = document.getElementById('modalEstudioCredito');
                if (modalEstudioCredito) {
                    try {
                        // Intentar getInstance si existe (Bootstrap 5.1+)
                        const modal = bootstrap.Modal.getInstance ? 
                                     bootstrap.Modal.getInstance(modalEstudioCredito) || new bootstrap.Modal(modalEstudioCredito) :
                                     new bootstrap.Modal(modalEstudioCredito);
                        modal.hide();
                        console.log('Modal cerrado usando Bootstrap 5');
                    } catch (error) {
                        console.error('Error cerrando modal con Bootstrap 5:', error);
                    }
                }
            } else {
                console.warn('No se encontró Bootstrap disponible');
            }
        });
    }
    
    // Conectar botón rechazar modal estudio
    const btnRechazarModalEstudio = document.getElementById('btnRechazarModalEstudio');
    if (btnRechazarModalEstudio) {
        btnRechazarModalEstudio.addEventListener('click', function() {
            //console.log('Abriendo modal de motivo de rechazo');
            // Obtener datos del modal de estudio
            const codInfoFacturaVenta = document.getElementById('cod_info_factura_venta_modal_estudio_credito').value;
            const codTercero = document.getElementById('cod_tercero_modal_estudio_credito').value;
            // Pasar datos al modal de motivo de rechazo
            document.getElementById('cod_info_factura_venta_modal_motivo_rechazo').value = codInfoFacturaVenta;
            document.getElementById('cod_tercero_modal_motivo_rechazo').value = codTercero;
            // Limpiar el textarea
            document.getElementById('textareaMotivoRechazo').value = '';
            // Cerrar modal de estudio
            if (typeof $ !== 'undefined' && $.fn.modal) {
                $('#modalEstudioCredito').modal('hide');
            } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                const modalEstudioCredito = document.getElementById('modalEstudioCredito');
                if (modalEstudioCredito) {
                    const modal = bootstrap.Modal.getInstance(modalEstudioCredito);
                    if (modal) modal.hide();
                }
            }
            // Abrir modal de motivo de rechazo
            setTimeout(() => {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#modalMotivoRechazo').modal('show');
                } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const modalMotivoRechazo = document.getElementById('modalMotivoRechazo');
                    if (modalMotivoRechazo) {
                        const modal = new bootstrap.Modal(modalMotivoRechazo);
                        modal.show();
                    }
                }
                console.log('Desplegar modal: modalMotivoRechazo:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global });
                $('#cod_info_factura_venta_modal_motivo_rechazo').val(cod_info_factura_venta_global);
                $('#cod_tercero_modal_motivo_rechazo').val(cod_tercero_global);
            }, 300);
        });
    }
    
    // Conectar botón confirmar rechazo
    const btnConfirmarRechazo = document.getElementById('btnConfirmarRechazo');
    if (btnConfirmarRechazo) {
        btnConfirmarRechazo.addEventListener('click', function() {
            const motivoRechazo = document.getElementById('textareaMotivoRechazo').value.trim();
            const codInfoFacturaVenta = document.getElementById('cod_info_factura_venta_modal_motivo_rechazo').value;
            const codTercero = document.getElementById('cod_tercero_modal_motivo_rechazo').value;
            
            // Validar que el textarea tenga contenido
            if (motivoRechazo === '') {
                $('#modalErrorMotivoRechazoVacio').modal('show');
                // Cuando se cierre el modal, hacer foco en el textarea
                $('#modalErrorMotivoRechazoVacio').on('hidden.bs.modal', function() {
                    document.getElementById('textareaMotivoRechazo').focus();
                });
                return;
            }
            
            // Validar que tengamos el código de factura
            if (!codInfoFacturaVenta || codInfoFacturaVenta === '') {
                $('#modalErrorCodigoFacturaNoEncontrado').modal('show');
                return;
            }           
            // Deshabilitar botón para evitar múltiples envíos
            btnConfirmarRechazo.disabled = true;
            btnConfirmarRechazo.textContent = 'Procesando...';
            
            // Enviar AJAX
            $.ajax({
                url: '../admin/rechazar_solicitud_credito_ajax.php', // Ajusta esta ruta según tu estructura
                type: 'POST',
                data: {
                    cod_info_factura_venta: codInfoFacturaVenta,
                    cod_tercero: codTercero,
                    motivo_rechazo: motivoRechazo,
                    action: 'rechazar_solicitud'
                },
                dataType: 'json',
                success: function(response) {
                    //console.log('✅ Respuesta del servidor:', response);
                    
                    if (response.success) {
                        // Cerrar modal
                        if (typeof $ !== 'undefined' && $.fn.modal) {
                            $('#modalMotivoRechazo').modal('hide');
                        } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            const modalMotivoRechazo = document.getElementById('modalMotivoRechazo');
                            if (modalMotivoRechazo) {
                                const modal = bootstrap.Modal.getInstance(modalMotivoRechazo);
                                if (modal) modal.hide();
                            }
                        }
                        // Limpiar textarea
                        document.getElementById('textareaMotivoRechazo').value = '';
                        // Mostrar mensaje de éxito con modal
                        $('#mensajeExitoRechazo').text(response.message || 'Solicitud rechazada correctamente.');
                        $('#modalExitoSolicitudRechazada').modal('show');
                        // Recargar cuando se cierre el modal de éxito
                        $('#modalExitoSolicitudRechazada').on('hidden.bs.modal', function() {
                            if (typeof load !== 'undefined') {
                                load(1);
                            } else {
                                location.reload();
                            }
                        });
                    } else {
                        // Mostrar error con modal
                        $('#mensajeErrorRechazo').text(response.message || 'No se pudo rechazar la solicitud.');
                        $('#modalErrorRechazarSolicitud').modal('show');
                        // Rehabilitar botón
                        btnConfirmarRechazo.disabled = false;
                        btnConfirmarRechazo.textContent = 'Rechazar';
                    }
                },
                error: function(xhr, status, error) {
                    // Mostrar error de conexión con modal
                    $('#modalErrorConexionRechazo').modal('show');
                    // Rehabilitar botón
                    btnConfirmarRechazo.disabled = false;
                    btnConfirmarRechazo.textContent = 'Rechazar';
                }
            });
        });
    }
    
    // Conectar botón cancelar motivo rechazo
    const btnCancelarMotivoRechazo = document.getElementById('btnCancelarMotivoRechazo');
    if (btnCancelarMotivoRechazo) {
        btnCancelarMotivoRechazo.addEventListener('click', function() {
            //console.log('Cerrando modalMotivoRechazo desde btnCancelarMotivoRechazo');
            // Compatibilidad Bootstrap 4 y 5
            if (typeof $ !== 'undefined' && $.fn.modal) {
                // Bootstrap 4 con jQuery
                $('#modalMotivoRechazo').modal('hide');
                //console.log('Modal cerrado usando jQuery/Bootstrap 4');
            } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                // Bootstrap 5
                const modalMotivoRechazo = document.getElementById('modalMotivoRechazo');
                if (modalMotivoRechazo) {
                    try {
                        // Intentar getInstance si existe (Bootstrap 5.1+)
                        const modal = bootstrap.Modal.getInstance ? 
                                     bootstrap.Modal.getInstance(modalMotivoRechazo) || new bootstrap.Modal(modalMotivoRechazo) :
                                     new bootstrap.Modal(modalMotivoRechazo);
                        modal.hide();
                        console.log('Modal cerrado usando Bootstrap 5');
                    } catch (error) {
                        console.error('Error cerrando modal con Bootstrap 5:', error);
                    }
                }
            } else {
                console.warn('No se encontró Bootstrap disponible');
            }
        });
    }
    
    // Controlar estado del botón Siguiente Modal Aprobación
    const codTipoMetodoAprobacionSelect = document.getElementById('cod_tipo_metodo_aprobacion_select');
    const btnSiguienteModalAprobacion = document.getElementById('btnSiguienteModalAprobacion');
    
    if (codTipoMetodoAprobacionSelect && btnSiguienteModalAprobacion) {
        // Función para validar selección y activar/desactivar botón
        function validarSeleccionMetodoAprobacion() {
            const valorSeleccionado = codTipoMetodoAprobacionSelect.value.trim();
            
            if (valorSeleccionado === '' || valorSeleccionado === null) {
                // Desactivar botón si no hay selección válida
                btnSiguienteModalAprobacion.disabled = true;
                btnSiguienteModalAprobacion.style.opacity = '0.6';
                btnSiguienteModalAprobacion.style.cursor = 'not-allowed';
                btnSiguienteModalAprobacion.style.backgroundColor = '#6c757d';
                //console.log('Botón Siguiente desactivado - No hay selección válida');
            } else {
                // Activar botón si hay selección válida
                btnSiguienteModalAprobacion.disabled = false;
                btnSiguienteModalAprobacion.style.opacity = '1';
                btnSiguienteModalAprobacion.style.cursor = 'pointer';
                btnSiguienteModalAprobacion.style.backgroundColor = '#28a745';
                //console.log('Botón Siguiente activado - Selección válida:', valorSeleccionado);
            }
        }
         // Inicializar estado del botón al cargar
        validarSeleccionMetodoAprobacion();
         // Event listener para cambios en el select
        codTipoMetodoAprobacionSelect.addEventListener('change', validarSeleccionMetodoAprobacion);
        // Event listener adicional para el evento input (compatibilidad)
        codTipoMetodoAprobacionSelect.addEventListener('input', validarSeleccionMetodoAprobacion);
        // Revalidar cuando se abra el modal
        const modalMetodoAprobacion = document.getElementById('modalMetodoAprobacion');
        if (modalMetodoAprobacion) {
            modalMetodoAprobacion.addEventListener('shown.bs.modal', function() {
                //console.log('Modal de aprobación abierto - Revalidando selección');
                validarSeleccionMetodoAprobacion();
            });
            // Compatibilidad con jQuery Bootstrap
            $(modalMetodoAprobacion).on('shown.bs.modal', function() {
                //console.log(' Modal de aprobación abierto (jQuery) - Revalidando selección');
                validarSeleccionMetodoAprobacion();
            });
        }
    }
    
    // Limpiar recursos cuando se cierra el modal
    const modalCapturaCamara = document.getElementById('modalCapturaCamara');
    if (modalCapturaCamara) {
        // Remover listener previo para evitar duplicados
        modalCapturaCamara.removeEventListener('hidden.bs.modal', cerrarModalCamara);
        
        // Añadir listener una sola vez
        modalCapturaCamara.addEventListener('hidden.bs.modal', function() {
            console.log('Modal cerrado por evento Bootstrap - ejecutando limpieza');
            // Solo limpiar recursos, no llamar cerrarModalCamara para evitar recursión
            if (window.stream) {
                window.stream.getTracks().forEach(track => track.stop());
                window.stream = null;
            }
            if (window.video) {
                window.video.srcObject = null;
            }
        });
        //console.log('Event listener modal configurado');
    }
}

// Event listeners para reajustar modal en cambios de orientación
window.addEventListener('resize', function() {
    const modalCapturaCamara = document.getElementById('modalCapturaCamara');
    if (modalCapturaCamara && modalCapturaCamara.classList.contains('show')) {
        setTimeout(() => {
            ajustarModalCamaraMovil();
        }, 300);
    }
});

window.addEventListener('orientationchange', function() {
    const modalCapturaCamara = document.getElementById('modalCapturaCamara');
    if (modalCapturaCamara && modalCapturaCamara.classList.contains('show')) {
        setTimeout(() => {
            ajustarModalCamaraMovil();
        }, 500);
    }
});

// Función mejorada para capturar foto y guardarla
function funcionCapturarFoto(cod_info_factura_venta, cod_tercero, cod_nota_observacion) {
    // Bandera para evitar doble ejecución por doble binding o doble click
    if (window._isCapturing) {
        console.warn('Captura ya en progreso, ignorando clic adicional');
        return;
    }

    const btn = document.getElementById('btnCapturarFoto');
    if (btn) {
        // Deshabilitar el botón para prevenir doble envío por click rápido
        btn.disabled = true;
    }
    window._isCapturing = true;

    if (!video || !canvas) {
        $('#modalErrorCamaraNoLista').modal('show');
        window._isCapturing = false;
        if (btn) btn.disabled = false;
        return;
    }
    console.log("Tomar foto");
    const context = canvas.getContext('2d');
    
    // Obtener el marco de captura
    const captureFrame = document.querySelector('.capture-frame');
    
    if (!captureFrame) {
        $('#modalErrorMarcoNoEncontrado').modal('show');
        window._isCapturing = false;
        if (btn) btn.disabled = false;
        return;
    }
    
    // Obtener dimensiones reales del video
    const videoWidth = video.videoWidth;   // Dimensiones reales del stream
    const videoHeight = video.videoHeight;
    
    //console.log('📐 Dimensiones del video real:', { videoWidth, videoHeight });
    
    // Obtener dimensiones mostradas del video en pantalla
    const videoRect = video.getBoundingClientRect();
    const displayWidth = videoRect.width;
    const displayHeight = videoRect.height;
    
    //console.log('📐 Dimensiones del video en pantalla:', { displayWidth, displayHeight });
    
    // Obtener posición y dimensiones del marco en pantalla
    const frameRect = captureFrame.getBoundingClientRect();
    /*
    console.log('📐 Marco en pantalla:', {
        left: frameRect.left,
        top: frameRect.top,
        width: frameRect.width,
        height: frameRect.height
    });
    */
    // Calcular la escala entre el video real y el mostrado
    const scaleX = videoWidth / displayWidth;
    const scaleY = videoHeight / displayHeight;
    
    //console.log('📏 Escalas calculadas:', { scaleX, scaleY });
    
    // Calcular la posición del marco RELATIVA al video (no a la pantalla)
    const frameXRelativeToVideo = (frameRect.left - videoRect.left);
    const frameYRelativeToVideo = (frameRect.top - videoRect.top);
    /*
    console.log('📍 Posición del marco relativa al video (pantalla):', {
        x: frameXRelativeToVideo,
        y: frameYRelativeToVideo
    });
    */
    // Convertir las coordenadas del marco a coordenadas del video real
    const cropX = frameXRelativeToVideo * scaleX;
    const cropY = frameYRelativeToVideo * scaleY;
    const cropWidth = frameRect.width * scaleX;
    const cropHeight = frameRect.height * scaleY;
    /*
    console.log('✂️ Área de recorte en video real:', {
        cropX: Math.round(cropX),
        cropY: Math.round(cropY),
        cropWidth: Math.round(cropWidth),
        cropHeight: Math.round(cropHeight)
    });
    */
    
    // Ajustar el canvas al tamaño del área recortada (sin escalar, 1:1)
    canvas.width = Math.round(cropWidth);
    canvas.height = Math.round(cropHeight);
    
    // Configurar context para máxima calidad
    context.imageSmoothingEnabled = true;
    context.imageSmoothingQuality = 'high';
    
    // Dibujar SOLO el área del marco en el canvas
    context.drawImage(
        video,                                    // Fuente
        Math.round(cropX),                        // X de origen en el video
        Math.round(cropY),                        // Y de origen en el video
        Math.round(cropWidth),                    // Ancho a copiar del video
        Math.round(cropHeight),                   // Alto a copiar del video
        0,                                        // X destino en canvas
        0,                                        // Y destino en canvas
        Math.round(cropWidth),                    // Ancho en canvas
        Math.round(cropHeight)                    // Alto en canvas
    );
    /*
    console.log('📸 Imagen capturada del marco. Dimensiones del canvas:', {
        width: canvas.width,
        height: canvas.height
    });
    */
    
    // Convertir a blob para mostrar previsualización (SIN GUARDAR AÚN)
    canvas.toBlob(async (blob) => {
        try {
            // Obtener datos necesarios
            var cod_info_factura_venta = $('#cod_info_factura_venta_modal_captura_imagenes').val();
            var cod_tercero = $('#cod_tercero_modal_captura_imagenes').val();
            var cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_modal_captura_imagenes').val();
            var cod_nota_observacion = $('#cod_nota_observacion_modal_captura_imagenes').val();

            // Crear URL temporal para previsualización
            const imageUrl = URL.createObjectURL(blob);
            
            // Almacenar imagen capturada temporalmente
            window.imagenesCapturadasTemp = window.imagenesCapturadasTemp || [];
            window.imagenesCapturadasTemp.push({
                blob: blob,
                cod_info_factura_venta: cod_info_factura_venta,
                cod_tercero: cod_tercero,
                cod_tipo_metodo_aprobacion: cod_tipo_metodo_aprobacion,
                cod_nota_observacion: cod_nota_observacion,
                filename: `foto_${cod_info_factura_venta}_${cod_tercero}_${cod_nota_observacion}_${cod_tipo_metodo_aprobacion}_${Date.now()}.jpg`,
                imageUrl: imageUrl
            });
            
            console.log('Imagen capturada y almacenada temporalmente. Total:', window.imagenesCapturadasTemp.length);
            
            // Cerrar modal de cámara
            cerrarModalCamara();
            
            // Mostrar previsualización con la URL temporal
            if (window.modalOrigenCamara !== 'modalProcesarOtrasImagenes') {
                mostrarPrevisualizacion(imageUrl, cod_info_factura_venta, cod_nota_observacion, cod_tercero);
            } else {
                console.log('Foto capturada desde modalProcesarOtrasImagenes');
                reabrirModalOrigen();
            }
            
        } catch (error) {
            console.error('Error al capturar la foto:', error);
            $('#modalErrorCapturarFoto').modal('show');
        } finally {
            // Reactivar la posibilidad de capturar
            window._isCapturing = false;
            if (btn) btn.disabled = false;
        }
    }, 'image/jpeg', 1.0); // MÁXIMA CALIDAD: 1.0 = 100% calidad JPEG
}

// Función para mostrar la previsualización
function mostrarPrevisualizacion(imageUrl, cod_info_factura_venta, cod_nota_observacion, cod_tercero) {
    try {
        console.log('Mostrando previsualización para cod_nota_observacion:', cod_nota_observacion);
        
        if (!cod_nota_observacion) {
            console.error('cod_nota_observacion no especificado');
            return;
        }
        // Buscar el span correspondiente
        const previsualizar_foto_tomada = document.getElementById(`foto_tomada_${cod_nota_observacion}`);
        //console.log("aqui deberia salir mensaje reabrir modal = ", previsualizar_foto_tomada);

        if (previsualizar_foto_tomada) {
            // Crear imagen de previsualización
            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.cssText = `width: 100%; max-width: auto; height: 200px; border-radius: 8px; margin-top: 10px; border: 2px solid #4CAF50; box-shadow: 0 2px 8px rgba(0,0,0,0.1);`;
            img.alt = 'Foto capturada';
            // Limpiar contenido anterior y agregar la imagen
            previsualizar_foto_tomada.innerHTML = '';
            previsualizar_foto_tomada.appendChild(img);
            
            // DESHABILITAR EL BOTÓN DE LA CÁMARA DESPUÉS DE CAPTURA EXITOSA
            const btnActivarCamara = document.getElementById(`btn_activar_camara_${cod_nota_observacion}`);
            if (btnActivarCamara) {
                // Deshabilitar el botón
                btnActivarCamara.disabled = true;
                
                // Cambiar el estilo visual para indicar que está deshabilitado
                btnActivarCamara.style.backgroundColor = '#28a745';
                btnActivarCamara.style.color = 'white';
                btnActivarCamara.style.border = '2px solid #28a745';
                btnActivarCamara.style.cursor = 'not-allowed';
                btnActivarCamara.style.opacity = '0.8';
                
                // Cambiar el contenido del botón para mostrar estado capturado
                btnActivarCamara.innerHTML = '<i class="fa fa-check" style="margin-right: 8px;"></i>Foto Capturada';
                
                // Habilitar el botón de borrar foto
                const btnBorrarFoto = document.getElementById('btn_borrar_foto_tomada_' + cod_nota_observacion);
                if (btnBorrarFoto) {
                    btnBorrarFoto.disabled = false;
                    btnBorrarFoto.style.opacity = '1';
                    btnBorrarFoto.style.cursor = 'pointer';
                    //console.log('Botón de borrar habilitado para:', cod_nota_observacion);
                }
                //console.log('Botón de cámara deshabilitado exitosamente para:', cod_nota_observacion);
            } else {
                console.warn('No se encontró el botón de activar cámara para:', cod_nota_observacion);
            }
            
            // Solo reabrir modal de origen si NO es modalProcesarOtrasImagenes
            // (para ese modal, reabrirModalOrigen ya se llamó desde funcionCapturarFoto)
            if (window.modalOrigenCamara !== 'modalProcesarOtrasImagenes') {
                // Reabrir el modal correcto después de capturar la foto
                reabrirModalOrigen();
            }
            //console.log('✅ Previsualización mostrada correctamente.');
        } else {
            console.error('Span foto_tomada no encontrado para:', cod_nota_observacion);
        }
    } catch (error) {
        console.error('Error al mostrar previsualización:', error);
    }
}

// Función para cargar notas dinámicamente en modalListaCapturaImagenesIniciales
function cargarNotasModalDinamicamente() {
    try {
        //console.log('Cargando lista imagenes de Soporte');
        // Obtener el valor del campo oculto
        const inputCod = document.getElementById('cod_info_factura_venta_modal_lista_captura_imagenes');
        const codInfoFacturaVenta = inputCod ? inputCod.value.trim() : '';
              
        if (!codInfoFacturaVenta) {
            console.warn('cod_info_factura_venta_modal_lista_captura_imagenes está vacío, no se pueden cargar las notas');
            return;
        }
        //console.log('🚀 Cargando notas para cod_info_factura_venta:', codInfoFacturaVenta);
        // Crear FormData para la petición
        const formData = new FormData();
        formData.append('cod_info_factura_venta', codInfoFacturaVenta);
        //console.log('📡 Enviando petición AJAX a obtener_fotos_iniciales_nota_observacion_modal_ajax.php...');
        // Hacer la petición al endpoint
        fetch('../admin/obtener_fotos_iniciales_nota_observacion_modal_ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            //console.log('📥 Respuesta recibida, status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP Error: ${response.status} ${response.statusText}`);
            }
            return response.text();
        })
        .then(html => {
            //console.log('HTML recibido del servidor (primeros 200 chars):', html.substring(0, 200) + '...');
            // Buscar el contenedor donde insertar las notas
            const container = document.querySelector('#modalListaCapturaImagenesIniciales .modal-body #mostrar_datos_ajax_obtener_nota_observacion_modal');
            //console.log('🎯 Contenedor encontrado:', container ? 'SÍ' : 'NO');
            if (container) {
                container.innerHTML = html;
                //console.log('Lista de imagenes cargada');
            } else {
                console.error('No se encontró el contenedor .row.g-3 dentro del modalListaCapturaImagenesIniciales');
            }
        })
        .catch(error => {
            console.error('Error al cargar las notas:', error);

            // Mostrar mensaje de error en el modal
            const container = document.querySelector('#modalListaCapturaImagenesIniciales .modal-body .row.g-3');
            if (container) {
                container.innerHTML = '<div class="col-12"><div class="alert alert-danger">Error al cargar las notas: ' + error.message + '</div></div>';
            }
        });
    } catch (error) {
        console.error('Error en cargarNotasModalDinamicamente:', error);
    }
}


// Usar delegación de eventos con jQuery para soportar botones generados dinámicamente por AJAX
$(document).on('click', '#btn_procesar_otras_imagenes', function(e) {
    e.preventDefault();
    //console.log('Botón btn_procesar_otras_imagenes clickeado!', this);
    // Obtener valores desde data-attributes
    var codInfo = $(this).attr('data-cod_info_factura_venta') || '';
    var codTercero = $(this).attr('data-cod_tercero') || '';
    console.log('Desplegar modal: modalProcesarOtrasImagenes:', { codInfoFacturaVenta: codInfo, codTercero: codTercero  });
    //console.log('Datos obtenidos - codInfo:', codInfo, 'codTercero:', codTercero);
    // Rellenar inputs ocultos del modal
    $('#cod_info_factura_venta_modal_procesar_otras_imagenes').val(codInfo);
    $('#cod_tercero_modal_procesar_otras_imagenes').val(codTercero);
    $('#cod_tipo_metodo_aprobacion_modal_procesar_otras_imagenes').val('');

    //console.log('Inputs rellenados, intentando abrir modal...');

    // Mostrar modal usando jQuery (Bootstrap)
    $('#modalProcesarOtrasImagenes').modal('show');
    //console.log('Modal abierto exitosamente');
    // Cargar datos del modal via AJAX
    cargarDatosModalOtrasImagenes(codInfo, codTercero);

    // Al mostrar el modal, intentar previsualizar todas las imágenes temporales
    $('#modalProcesarOtrasImagenes').off('shown.bs.modal.__previsualizarFinales').on('shown.bs.modal.__previsualizarFinales', function() {
        if (window.imagenesCapturadasTemp && Array.isArray(window.imagenesCapturadasTemp)) {
            window.imagenesCapturadasTemp.forEach(function(img) {
                if (img && img.cod_nota_observacion && img.imageUrl) {
                    mostrarPrevisualizacion(img.imageUrl, img.cod_info_factura_venta, img.cod_nota_observacion, img.cod_tercero);
                }
            });
        }
    });
});
// Función para cargar datos del modal via AJAX
function cargarDatosModalOtrasImagenes(codInfo, codTercero) {
    //console.log('Cargando datos via AJAX para codInfo:', codInfo, 'codTercero:', codTercero);
    // Mostrar loading en el contenedor
    $('#mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes').html(
        '<div class="col-12 text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><p class="mt-2">Cargando imágenes...</p></div>'
    );
    $.ajax({
        url: '../admin/obtener_fotos_finales_nota_observacion_modal_ajax.php',
        type: 'POST',
        dataType: 'html',
        data: {
            cod_info_factura_venta: codInfo,
            cod_tercero: codTercero
        },
        success: function(response) {
            //console.log('Datos cargados exitosamente:', response);
            $('#mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error cargando datos:', error);
            $('#mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes').html(
                '<div class="col-12"><div class="alert alert-danger">Error al cargar los datos: ' + error + '</div></div>'
            );
        }
    });
}
// Handler para cerrar el modal al hacer click en Cancelar
$(document).on('click', '#btnCancelarModalProcesarOtrasImagenes', function(e) {
    e.preventDefault();
    console.log('Botón Cancelar clickeado, cerrando modal...');
    $('#modalProcesarOtrasImagenes').modal('hide');
});
// Handler para cerrar el modal con el botón X
$(document).on('click', '#modalProcesarOtrasImagenes .close, #modalProcesarOtrasImagenes .btn-close', function(e) {
    e.preventDefault();
    console.log('Botón X clickeado, cerrando modal...');
    $('#modalProcesarOtrasImagenes').modal('hide');
});
// Limpiar contenido del modal cuando se cierre
$('#modalProcesarOtrasImagenes').on('hidden.bs.modal', function () {
    //console.log('Modal cerrado, limpiando contenido...');
    $('#mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes').html('');
});

// Delegación de eventos para botones dinámicos
document.addEventListener('click', function(event) {
    // Manejar clics en botones de eliminar foto
    if (event.target.classList.contains('btn_cancelar_foto') || event.target.closest('.btn_cancelar_foto')) {
        
        const button = event.target.classList.contains('btn_cancelar_foto') ? event.target : event.target.closest('.btn_cancelar_foto');
        
        const buttonId = button.id;
        if (buttonId && buttonId.startsWith('btn_borrar_foto_tomada_')) {
            const codNotaObservacion = buttonId.replace('btn_borrar_foto_tomada_', '');
            eliminarFotoTomada(codNotaObservacion);
        }
    }
    
    // Manejar clics en botones de activar cámara dinámicos
    if (event.target.classList.contains('btn_activar_camara') || event.target.closest('.btn_activar_camara')) {
        
        const button = event.target.classList.contains('btn_activar_camara') ?  event.target : event.target.closest('.btn_activar_camara');
        
        const buttonId = button.id;
        if (buttonId && buttonId.startsWith('btn_activar_camara_')) {
            const codNotaObservacion = buttonId.replace('btn_activar_camara_', '');
            abrirModalCamara(codNotaObservacion);
        }
    }
});

// Función para eliminar foto tomada
function eliminarFotoTomada(cod_nota_observacion) {
    if (!cod_nota_observacion) {
        console.error('cod_nota_observacion no especificado');
        return;
    }
    
    // Mostrar modal de confirmación
    $('#modalConfirmarEliminarFoto').modal('show');
    
    // Configurar el botón de confirmar eliminación
    $('#btnConfirmarEliminarFoto').off('click').on('click', function() {
        // Cerrar el modal de confirmación
        $('#modalConfirmarEliminarFoto').modal('hide');
        
        console.log('Eliminando foto para cod_nota_observacion:', cod_nota_observacion);
        
        // Obtener cod_info_factura_venta y cod_tercero de los campos hidden del modal
        const cod_info_factura_venta = document.getElementById('cod_info_factura_venta_modal_lista_captura_imagenes')?.value || '';
        const cod_tercero = document.getElementById('cod_tercero_modal_lista_captura_imagenes')?.value || '';
        
        const formData = new FormData();
        formData.append('cod_nota_observacion', cod_nota_observacion);
        formData.append('cod_info_factura_venta', cod_info_factura_venta);
        formData.append('cod_tercero', cod_tercero);
        
        fetch('../admin/eliminar_foto_camara_ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            //console.log('Respuesta del servidor:', data);
            
            if (data.success) {
                // Limpiar la previsualización
                const spanFotoTomada = document.getElementById(`foto_tomada_${cod_nota_observacion}`);
                if (spanFotoTomada) {
                    spanFotoTomada.innerHTML = '';
                }
                
                // Reactivar el botón de cámara
                const btnActivarCamara = document.getElementById(`btn_activar_camara_${cod_nota_observacion}`);
                if (btnActivarCamara) {
                    btnActivarCamara.disabled = false;
                    btnActivarCamara.style.backgroundColor = '#e3f2fd';
                    btnActivarCamara.style.color = '#1976d2';
                    btnActivarCamara.style.border = '2px solid #bbdefb';
                    btnActivarCamara.style.cursor = 'pointer';
                    btnActivarCamara.style.opacity = '1';
                    btnActivarCamara.innerHTML = '<i class="fa fa-camera" style="margin-right: 8px;"></i>Cámara';
                }
                //alert('Foto eliminada exitosamente');
            } else {
                $('#mensajeErrorEliminarFoto').text(data.message || 'Error desconocido');
                $('#modalErrorEliminarFoto').modal('show');
            }
        })
        .catch(error => {
            console.error('Error al eliminar foto:', error);
            $('#mensajeErrorEliminarFoto').text(error.message || 'Error de conexión');
            $('#modalErrorEliminarFoto').modal('show');
        });
    });
}
</script>


<script>
// Handler para el botón Siguiente/Guardar del modal Procesar Otras Imágenes
$(document).on('click', '#btnGuardarModalProcesarOtrasImagenes', function(e) {
    e.preventDefault();

    //console.log('btnGuardarModalProcesarOtrasImagenes clickeado');

    const $btn = $(this);
    const codInfo = $('#cod_info_factura_venta_modal_procesar_otras_imagenes').val() || '';
    const codTercero = $('#cod_tercero_modal_procesar_otras_imagenes').val() || '';

    if (!codInfo) {
        // Mostrar modal de error si existe, sino usar el toast moderno (fallback),
        // y como último recurso usar alert para asegurar feedback.
        var msg = 'No se ha identificado la información de factura (cod_info_factura_venta).';
        if ($('#modalErrorDatosNecesarios').length) {
            $('#modalErrorDatosNecesarios').modal('show');
        } else if (typeof showFloatingNotification === 'function') {
            showFloatingNotification(msg);
        } else {
            showFloatingNotification(msg);
        }
        return;
    }

    // Recorrer los elementos cargados en el modal y validar las imágenes obligatorias
    const missing = [];
    $('#mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes').children('.col-12').each(function() {
        const $item = $(this);
        const titulo = $item.find('h6').first().text() || '';
        const isMandatory = titulo.indexOf('*') !== -1; // el asterisco marca obligatoria en el HTML servidor

        // Obtener el código de nota desde el id del botón de cámara dentro del item
        const $btnCamara = $item.find('button[id^="btn_activar_camara_"]').first();
        const btnId = $btnCamara.attr('id') || '';
        const codNota = btnId.replace('btn_activar_camara_', '');

        // Verificar si existe una imagen en el span correspondiente
        const $spanFoto = $item.find(`#foto_tomada_${codNota}`);
        const hasImg = $spanFoto.length && $spanFoto.find('img').length > 0;
        const btnDisabled = $btnCamara.prop('disabled') === true;

        if (isMandatory && !hasImg && !btnDisabled) {
            missing.push(titulo.replace('*', '').trim());
        }
    });

    if (missing.length > 0) {
        // Construir la lista de imágenes faltantes para el modal
        var listaHTML = '<ul style="list-style: none; padding: 0; margin: 0;">';
        missing.forEach(function(imagen) {
            listaHTML += '<li style="padding: 0.75rem; margin-bottom: 0.5rem; background: rgba(255,255,255,0.05); border-left: 3px solid #00d4ff; border-radius: 4px; color: #fff; font-size: 0.95rem;">';
            listaHTML += '<i class="fa fa-camera" style="margin-right: 10px; color: #ff5757;"></i>';
            listaHTML += '<span style="font-weight: 500;">' + imagen + '</span>';
            listaHTML += '</li>';
        });
        listaHTML += '</ul>';
        
        // Llenar el contenido del modal
        $('#listaImagenesFaltantes').html(listaHTML);
        
        // Mostrar el modal
        $('#modalImagenesFaltantes').modal('show');
        
        return;
    }

    // Todas las imágenes obligatorias están presentes: guardar imágenes y luego enviar al servidor
    $btn.prop('disabled', true);
    const originalText = $btn.text();
    $btn.text('Procesando...');
    var action = 'procesar_imagenes_credito';

    // Guardar imágenes primero (igual que en iniciales)
    if (window.imagenesCapturadasTemp && window.imagenesCapturadasTemp.length > 0) {
        guardarImagenesCapturadas().then(function() {
            enviarProcesarOtrasImagenes(codInfo, codTercero, action, $btn, originalText);
        }).catch(function(error) {
            console.error('Error al guardar imágenes:', error);
            $btn.prop('disabled', false).text(originalText);
            alert('Error al guardar las imágenes capturadas');
        });
    } else {
        // Si no hay imágenes nuevas, continuar directamente
        enviarProcesarOtrasImagenes(codInfo, codTercero, action, $btn, originalText);
    }

// Función auxiliar para enviar el procesamiento de otras imágenes
function enviarProcesarOtrasImagenes(codInfo, codTercero, action, $btn, originalText) {
    $.ajax({
        url: '../admin/reg_procesar_otras_imagenes_credito_ajax_reg.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: action,
            cod_info_factura_venta: codInfo,
            cod_tercero: codTercero
        },
        success: function(response) {
            console.log('Respuesta reg_procesar_otras_imagenes_credito_ajax_reg:', response);
            if (response && response.success) {
                // Obtener datos de la respuesta
                const telefono_cliente = response.data?.telefono1_tercero || '';
                const telefono_revisor = response.data?.telefono_revisor || '';
                // Cerrar el modal actual
                $('#modalProcesarOtrasImagenes').modal('hide');
                // Llenar los campos hidden del modal de notificaciones
                $('#modal_whatsapp_cod_info_factura_venta').val(codInfo);
                $('#modal_whatsapp_cod_tercero').val(codTercero);
                $('#modal_whatsapp_telefono_cliente').val(telefono_cliente);
                $('#modal_whatsapp_telefono_revisor').val(telefono_revisor);
                //$('#modal_whatsapp_codigo_estado_facturacion').val(codigo_estado_facturacion);
                // Guardar datos en localStorage para mostrar el modal después de recargar
                localStorage.setItem('mostrarModalWhatsapp', 'true');
                localStorage.setItem('whatsapp_cod_info_factura_venta', codInfo);
                localStorage.setItem('whatsapp_cod_tercero', codTercero);
                localStorage.setItem('whatsapp_telefono_cliente', telefono_cliente);
                localStorage.setItem('whatsapp_telefono_revisor', telefono_revisor);
                // Recargar la página
                //console.log('Recargando página antes de mostrar modal WhatsApp...');
                window.location.reload();
                // Restaurar el botón (aunque se recargará la página)
                $btn.prop('disabled', false).text(originalText);
            } else {
                var msg = 'Error procesando imágenes: ' + (response.message || 'Error desconocido');
                if ($('#modalErrorGuardarFoto').length) {
                    $('#mensajeErrorGuardarFoto').text(msg);
                    $('#modalErrorGuardarFoto').modal('show');
                } else if (typeof showFloatingNotification === 'function') {
                    showFloatingNotification(msg);
                } else {
                    showFloatingNotification(msg);
                }
                $btn.prop('disabled', false).text(originalText);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en AJAX reg_procesar_otras_imagenes_credito_ajax_reg:', error);
            var msg = 'Error en la solicitud: ' + error;
            if ($('#modalErrorConexionRechazo').length) {
                $('#modalErrorConexionRechazo').modal('show');
            } else if (typeof showFloatingNotification === 'function') {
                showFloatingNotification(msg);
            } else {
                showFloatingNotification(msg);
            }
            $btn.prop('disabled', false).text(originalText);
        }
    });
}
});

// Handler adicional para el botón de cerrar del modal Detalle de Crédito
$(document).on('click', '#modalDetalleCredito .btn-close', function(e) {
    e.preventDefault();
    console.log('Cerrando modal Detalle de Crédito...');
    $('#modalDetalleCredito').modal('hide');
});

// Handlers para los botones de notificación WhatsApp
$(document).on('click', '#btnNotificarCliente', function(e) {
    e.preventDefault();
    
    const codInfo = $('#modal_whatsapp_cod_info_factura_venta').val();
    const codTercero = $('#modal_whatsapp_cod_tercero').val();
    const telefonoCliente = $('#modal_whatsapp_telefono_cliente').val();

    if (!codInfo) { $('#modalErrorCodigoFacturaWhatsapp').modal('show'); return; }
    
    console.log('Notificando al cliente...', { codInfo, codTercero, telefonoCliente });
    // Construir URL para notificar al cliente
    const urlNotificarCliente = `../admin/contactar_por_whatapp_registro_cliente_y_precredito_revisor_siscredito_visitante_intern.php?cod_info_factura_venta=${codInfo}&notificar=CLIENTE`;
    // Abrir en nueva ventana
    window.open(urlNotificarCliente, '_blank');
    // El modal permanece abierto para permitir más notificaciones
    console.log('Notificación al cliente enviada');
});

$(document).on('click', '#btnNotificarRevisor', function(e) {
    e.preventDefault();
    
    const codInfo = $('#modal_whatsapp_cod_info_factura_venta').val();
    const codTercero = $('#modal_whatsapp_cod_tercero').val();
    const telefonoRevisor = $('#modal_whatsapp_telefono_revisor').val();

    if (!codInfo) { $('#modalErrorCodigoFacturaWhatsapp').modal('show'); return; }

    console.log('Notificando al revisor...', { codInfo, codTercero, telefonoRevisor });
    // Construir URL para notificar al revisor
    const urlNotificarRevisor = `../admin/contactar_por_whatapp_registro_cliente_y_precredito_revisor_siscredito_visitante_intern.php?cod_info_factura_venta=${codInfo}&notificar=REVISOR`;
    // Abrir en nueva ventana
    window.open(urlNotificarRevisor, '_blank');
    // El modal permanece abierto para permitir más notificaciones
    console.log('Notificación al revisor enviada');
});

// Handler para el botón de procesar solicitud (cargar imágenes)
$(document).on('click', '#btn_procesar_solicitud', function(e) {
    e.preventDefault();
    
    const codInfo = $(this).data('cod_info_factura_venta');
    const codTercero = $(this).data('cod_tercero');
    cod_info_factura_venta_global = codInfo;
    cod_tercero_global = codTercero;

    if (!codInfo || !codTercero) {
        $('#modalErrorDatosNecesarios').modal('show');
        return;
    }
    //console.log('Procesando solicitud para:', { codInfo, codTercero });
    // Llenar los campos hidden del modal
    $('#cod_info_factura_venta_modal_estudio_credito').val(codInfo);
    $('#cod_tercero_modal_estudio_credito').val(codTercero);
    
    // Mostrar el modal de estudio de crédito
    //$('#modalEstudioCredito').modal('show');
});

// Detectar si se debe mostrar el modal de WhatsApp después de recargar la página
$(document).ready(function() {
    // Verificar si hay una bandera para mostrar el modal de WhatsApp
    if (localStorage.getItem('mostrarModalWhatsapp') === 'true') {
        console.log('Detectada bandera para mostrar modal WhatsApp después de recarga');
        
        // Obtener los datos guardados
        const codInfo = localStorage.getItem('whatsapp_cod_info_factura_venta') || '';
        const codTercero = localStorage.getItem('whatsapp_cod_tercero') || '';
        const telefonoCliente = localStorage.getItem('whatsapp_telefono_cliente') || '';
        const telefonoRevisor = localStorage.getItem('whatsapp_telefono_revisor') || '';
        
        // Llenar los campos hidden del modal de notificaciones
        $('#modal_whatsapp_cod_info_factura_venta').val(codInfo);
        $('#modal_whatsapp_cod_tercero').val(codTercero);
        $('#modal_whatsapp_telefono_cliente').val(telefonoCliente);
        $('#modal_whatsapp_telefono_revisor').val(telefonoRevisor);
        
        // Limpiar localStorage
        localStorage.removeItem('mostrarModalWhatsapp');
        localStorage.removeItem('whatsapp_cod_info_factura_venta');
        localStorage.removeItem('whatsapp_cod_tercero');
        localStorage.removeItem('whatsapp_telefono_cliente');
        localStorage.removeItem('whatsapp_telefono_revisor');
        
        // Mostrar el modal con un pequeño delay para asegurar que la página esté completamente cargada
        setTimeout(function() {
            console.log('Mostrando modal WhatsApp después de recarga');
            $('#modalNotificacionesWhatsapp').modal('show');
        }, 1000);
    }
});

</script>


<style>
/* Estilos para el botón Simular Crédito */
#btnSimularCredito {
    transition: all 0.3s ease;
}

#btnSimularCredito:hover {
    background: linear-gradient(135deg, #2c5aa0, #2a4d8d) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3);
}

/* Estilos para los botones de notificación WhatsApp */
#btnNotificarCliente:hover {
    background: linear-gradient(135deg, #20ba5a 0%, #1da851 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

#btnNotificarRevisor:hover {
    background: linear-gradient(135deg, #075e54 0%, #064e47 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(18, 140, 126, 0.3);
}

/* Estilos para texto de aviso */
#texto_aviso {
    background-color: #2d3748;
    color: #ffffff;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-top: 0.75rem;
    font-size: 0.85rem;
    font-weight: 500;
    text-align: center;
    border-left: 4px solid #667eea;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

#modalNotificacionesWhatsapp .btn {
    transition: all 0.3s ease;
}

#modalNotificacionesWhatsapp .modal-content {
    animation: slideInUp 0.3s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Estilos para el select de vendedores */
#CambiarVendedorSelect {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

#CambiarVendedorSelect option {
    background: #1a1d3a;
    color: white;
    padding: 10px;
    font-size: 1rem;
    line-height: 1.5;
}

#CambiarVendedorSelect:focus {
    outline: none;
    border-color: rgba(102, 126, 234, 0.6);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

/* Estilos para los select de entidad crediticia y tipo simulación */
#cod_entidad_crediticia,
#cod_tipo_simulacion_credito {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

#cod_entidad_crediticia option,
#cod_tipo_simulacion_credito option {
    padding: 10px;
    font-size: 1rem;
    line-height: 1.5;
    background: white;
    color: #000;
}

#cod_entidad_crediticia:focus,
#cod_tipo_simulacion_credito:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

/* Estilos para el select de banco cuenta */
#CambiarBancoCuentaSelect {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

#CambiarBancoCuentaSelect option {
    background: #1a1d3a;
    color: white;
    padding: 10px;
    font-size: 1rem;
    line-height: 1.5;
}

#CambiarBancoCuentaSelect:focus {
    outline: none;
    border-color: rgba(102, 126, 234, 0.6);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

/* Estilos para el select de tipo de cuenta bancaria */
#registrarBancoCuentaTipo {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

#registrarBancoCuentaTipo option {
    background: #1a1d3a;
    color: white;
    padding: 10px;
    font-size: 1rem;
    line-height: 1.5;
}

#registrarBancoCuentaTipo:focus {
    outline: none;
    border-color: rgba(102, 126, 234, 0.6);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

/* ==================== ESTILOS GLOBALES PARA TODOS LOS SELECT EN MODALES ==================== */
/* Aplicar a todos los select dentro de modales para asegurar que el texto sea visible */
.modal-content select.form-control {
    height: auto !important;
    min-height: 45px !important;
    line-height: 1.5 !important;
    font-size: 1rem !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
}

.modal-content select.form-control option {
    padding: 10px !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
    background-color: #2d3748 !important;
    color: white !important;
}

.modal-content select.form-control:focus {
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2) !important;
}

/* Estilos para textarea en modales */
.modal-content textarea.form-control {
    background: rgba(255,255,255,0.1) !important;
    border: 1px solid rgba(102, 126, 234, 0.3) !important;
    color: white !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
}

.modal-content textarea.form-control:focus {
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2) !important;
    border-color: rgba(102, 126, 234, 0.5) !important;
}

.modal-content textarea.form-control::placeholder {
    color: rgba(255, 255, 255, 0.4) !important;
}

/* Estilos para la sección de imágenes en modalDetalleCredito */
#modal_imagenes_container {
    scrollbar-width: thin;
    scrollbar-color: rgba(102, 126, 234, 0.3) transparent;
}

#modal_imagenes_container::-webkit-scrollbar {
    width: 6px;
}

#modal_imagenes_container::-webkit-scrollbar-track {
    background: rgba(102, 126, 234, 0.1);
    border-radius: 3px;
}

#modal_imagenes_container::-webkit-scrollbar-thumb {
    background: rgba(102, 126, 234, 0.3);
    border-radius: 3px;
}

#modal_imagenes_container::-webkit-scrollbar-thumb:hover {
    background: rgba(102, 126, 234, 0.5);
}

/* Efectos hover para las imágenes */
#modal_imagenes_container img:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease;
}

#modal_imagenes_container > div:hover {
    border-color: rgba(0, 212, 255, 0.6) !important;
    transition: border-color 0.2s ease;
}

/* Estilos para el botón de editar entidad crediticia */
#btnEditarEntidadCrediticia:hover {
    background: #5a67d8 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    transition: all 0.2s ease;
}

/* Estilos para el modal de editar entidad crediticia */
#modalEditarEntidadCrediticia .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

#resultadosCalculo {
    animation: slideInUp 0.3s ease-out;
}

/* Estilos para el texto de aviso como notificación */
#texto_aviso {
    text-align: center;
    margin: 0.4rem auto 0 auto;
    padding: 0.3rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 500;
    font-style: normal;
    color: #6c757d;
    background: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #dee2e6;
    box-shadow: none;
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: all 0.2s ease;
    transform: translateZ(0);
    line-height: 1.2;
    opacity: 0.85;
}

/* Estilos para los estados de crédito */

/* Clase base para estados - similar al diseño de precio_credito_app_movil_enrollment */
.estado_credito_app_movil_enrollment {
    display: inline-block;
    font-weight: 600;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 6px;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    line-height: 1.2;
    transition: all 0.15s ease-in-out;
}

.estado_en_solicitud {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    color: #4a5568;
    border: 1px solid #cbd5e0;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
}

.estado_en_solicitud::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_en_proceso {
    background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
    color: #c53030;
    border: 1px solid #fc8181;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(197, 48, 48, 0.2);
    animation: pulse 2s infinite;
}

.estado_en_proceso::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_venta_aprobada {
    background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
    color: #276749;
    border: 1px solid #68d391;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(39, 103, 73, 0.2);
}

.estado_venta_aprobada::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_generacion_factura {
    background: linear-gradient(135deg, #fef5e7 0%, #fbd38d 100%);
    color: #c05621;
    border: 1px solid #f6ad55;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(192, 86, 33, 0.2);
}

.estado_generacion_factura::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_generacion_pago {
    background: linear-gradient(135deg, #e6fffa 0%, #81e6d9 100%);
    color: #234e52;
    border: 1px solid #4fd1c7;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(35, 78, 82, 0.2);
}

.estado_generacion_pago::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_credito_exitoso {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    border: 1px solid #38a169;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 3px 6px rgba(72, 187, 120, 0.4);
    animation: glow 2s ease-in-out infinite alternate;
}

.estado_credito_exitoso::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_abandonado {
    background: linear-gradient(135deg, #fed7d7 0%, #f56565 100%);
    color: white;
    border: 1px solid #e53e3e;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(229, 62, 62, 0.3);
    opacity: 0.8;
}

.estado_abandonado::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_rechazado {
    background: linear-gradient(135deg, #fed7d7 0%, #f56565 100%);
    color: white;
    border: 1px solid #e53e3e;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(229, 62, 62, 0.3);
    opacity: 0.8;
}

.estado_rechazado::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_default {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
    color: #2d3748;
    border: 1px solid #a0aec0;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.estado_default::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}
/* Botones ModalEstudio */
#btnRechazarModalEstudio {
    background-color: #dc3545; 
    color: white; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 6px; 
    font-weight: 600; 
    font-size: 0.95rem; 
    min-width: 90px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnCancelarModalEstudio {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 6px; 
    font-weight: 600; 
    font-size: 0.95rem;
    min-width: 90px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnValidarModalEstudio {
    background-color: #28a745; 
    color: white; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 6px; 
    font-weight: 600; 
    font-size: 0.95rem; 
    min-width: 90px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Estilos para Modal Motivo de Rechazo */
#modalMotivoRechazo .modal-content {
    border-radius: 12px;
    border: none;
}

#modalMotivoRechazo h4 {
    color: #4a4a4a;
    font-weight: 600;
}

#modalMotivoRechazo #textareaMotivoRechazo {
    border: 2px solid #7ba8b8;
    border-radius: 8px;
    padding: 15px;
    font-size: 1rem;
    background-color: #f8f9fa;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#modalMotivoRechazo #textareaMotivoRechazo:focus {
    border-color: #5a9bd4;
    box-shadow: 0 0 0 0.2rem rgba(123, 168, 184, 0.25);
    outline: 0;
}

#modalMotivoRechazo #textareaMotivoRechazo::placeholder {
    color: #a0a0a0;
    font-style: italic;
}

#btnCancelarMotivoRechazo {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.95rem;
    min-width: 100px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: background-color 0.15s ease-in-out;
}

#btnCancelarMotivoRechazo:hover {
    background-color: #5a6268;
}

#btnConfirmarRechazo {
    background-color: #7b5394;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.95rem;
    min-width: 100px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: background-color 0.15s ease-in-out;
}

#btnConfirmarRechazo:hover {
    background-color: #6a4781;
}

/* Botones modalListaCapturaImagenesIniciales */
.btn_activar_camara {
    background-color: #e3f2fd; 
    color: #1976d2; 
    border: 2px solid #bbdefb; 
    padding: 12px; 
    border-radius: 6px; 
    font-weight: 500;
}
.btn_activar_camara:disabled {
    background-color: #28a745 !important; 
    color: white !important; 
    border: 2px solid #28a745 !important; 
    cursor: not-allowed !important;
    opacity: 0.8 !important;
    font-weight: 600 !important;
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3) !important;
}
.btn_activar_camara:hover:not(:disabled) {
    background-color: #bbdefb; 
    border-color: #90caf9;
}
.btn_cancelar_foto {
    background-color: #ffebee; 
    color: #d32f2f; 
    border: 2px solid #ffcdd2; 
    padding: 12px; 
    border-radius: 6px; 
    min-width: 50px;
}
/* Botones modalListaCapturaImagenesIniciales */
.btnAnteriorModalCaptura {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.btnCancelarModalCaptura {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnGuardarModalCaptura {
    background-color: #28a745 !important; 
    color: white !important; 
    border: none !important; 
    padding: 12px 20px !important; 
    border-radius: 6px !important; 
    font-weight: 600 !important; 
    font-size: 0.95rem !important; 
    min-width: 90px !important; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

/* Botones modalProcesarOtrasImagenes - mismos estilos que modalListaCapturaImagenesIniciales */
#btnAnteriorModalProcesarOtrasImagenes {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnCancelarModalProcesarOtrasImagenes {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnGuardarModalProcesarOtrasImagenes {
    background-color: #28a745 !important; 
    color: white !important; 
    border: none !important; 
    padding: 12px 20px !important; 
    border-radius: 6px !important; 
    font-weight: 600 !important; 
    font-size: 0.95rem !important; 
    min-width: 90px !important; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}
/* Botones modalCapturaCamara */
#btnCapturarFoto {
    background-color: #28a745 !important; 
    color: white !important; 
    border: none !important; 
    padding: 12px 20px !important; 
    border-radius: 6px !important; 
    font-weight: 600 !important; 
    font-size: 0.95rem !important; 
    min-width: 90px !important; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}
.btnCancelarCamara {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 25px; 
    border-radius: 50px; 
    font-weight: 600; 
    font-size: 1rem;
    min-width: 130px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    gap: 0.5rem;
}

/* Animaciones */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes glow {
    from { box-shadow: 0 3px 6px rgba(72, 187, 120, 0.4); }
    to { box-shadow: 0 3px 10px rgba(72, 187, 120, 0.7); }
}

/* Responsividad para móviles */
@media (max-width: 576px) {
    .estado_en_solicitud,
    .estado_en_proceso,
    .estado_venta_aprobada,
    .estado_generacion_factura,
    .estado_generacion_pago,
    .estado_credito_exitoso,
    .estado_abandonado,
    .estado_default {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }
    
    .tipo_pago_app_movil_enrollment {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }
}

/* Estilos para tipo de pago - similar al diseño de estado_credito_app_movil_enrollment_entidad */
.tipo_pago_app_movil_enrollment {
    display: inline-block;
    font-weight: 600;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 6px;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    line-height: 1.2;
    transition: all 0.15s ease-in-out;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-top: 0.25rem;
}

/* Estilo para CONTADO */
.tipo_pago_contado {
    background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
    color: #276749;
    border: 1px solid #68d391;
    box-shadow: 0 2px 4px rgba(39, 103, 73, 0.2);
}

.tipo_pago_contado::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

/* Estilo para CREDITO */
.tipo_pago_credito {
    background: linear-gradient(135deg, #bee3f8 0%, #90cdf4 100%);
    color: #2c5282;
    border: 1px solid #63b3ed;
    box-shadow: 0 2px 4px rgba(44, 82, 130, 0.2);
}

.tipo_pago_credito::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

/* Estilos específicos para el Modal Método de Aprobación */
#modalMetodoAprobacion .modal-content {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

#modalMetodoAprobacion .btn-close {
    font-size: 1.5rem;
    line-height: 1;
    color: #999;
    background: none;
    border: none;
    opacity: 0.4;
}

#modalMetodoAprobacion .btn-close:hover {
    opacity: 0.7;
    color: #666;
}

#modalMetodoAprobacion .form-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
}

#modalMetodoAprobacion .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.2s ease;
}

#modalMetodoAprobacion #btnAnteriorModalAprobacion:hover,
#modalMetodoAprobacion #btnCancelarModalAprobacion:hover {
    background-color: #5a6268 !important;
}

#modalMetodoAprobacion #btnSiguienteModalAprobacion:hover {
    background-color: #5a2d91 !important;
}

/* Efecto de foco para los botones del modal de aprobación */
#modalMetodoAprobacion .btn:focus {
    box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
    outline: none;
}

/* Responsive para el modal de aprobación */
@media (max-width: 576px) {
    #modalMetodoAprobacion .modal-dialog {
        max-width: 350px !important;
        margin: 1rem !important;
    }
    
    #modalMetodoAprobacion .d-flex {
        flex-direction: row !important;
        flex-wrap: wrap !important;
        gap: 0.5rem !important;
        justify-content: center !important;
    }
    
    #modalMetodoAprobacion .btn {
        flex: 1 1 auto !important;
        min-width: 80px !important;
        max-width: 100px !important;
        padding: 10px 8px !important;
        font-size: 0.85rem !important;
        white-space: nowrap !important;
    }
}

/* Estilos específicos para el Modal Captura de Imágenes */
#modalListaCapturaImagenesIniciales .modal-content {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

#modalListaCapturaImagenesIniciales .modal-dialog {
    max-height: 90vh !important;
    margin: 1rem auto !important;
}

#modalListaCapturaImagenesIniciales .modal-body {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

#modalListaCapturaImagenesIniciales .modal-body::-webkit-scrollbar {
    width: 6px;
}

#modalListaCapturaImagenesIniciales .modal-body::-webkit-scrollbar-track {
    background: #f7fafc;
    border-radius: 3px;
}

#modalListaCapturaImagenesIniciales .modal-body::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 3px;
}

#modalListaCapturaImagenesIniciales .modal-body::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

#modalListaCapturaImagenesIniciales .btn-close {
    font-size: 1.5rem;
    line-height: 1;
    color: #999;
    background: none;
    border: none;
    opacity: 0.4;
}

#modalListaCapturaImagenesIniciales .btn-close:hover {
    opacity: 0.7;
    color: #666;
}

#modalListaCapturaImagenesIniciales .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.2s ease;
}

#modalListaCapturaImagenesIniciales .btn:focus {
    box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
    outline: none;
}

#modalListaCapturaImagenesIniciales button[style*="background-color: #e3f2fd"]:hover {
    background-color: #bbdefb !important;
    border-color: #90caf9 !important;
}

#modalListaCapturaImagenesIniciales button[style*="background-color: #ffebee"]:hover {
    background-color: #ffcdd2 !important;
    border-color: #ef9a9a !important;
}

#modalListaCapturaImagenesIniciales #btnAnteriorModalCaptura:hover,
#modalListaCapturaImagenesIniciales #btnCancelarModalCaptura:hover {
    background-color: #5a6268 !important;
}

#modalListaCapturaImagenesIniciales #btnGuardarModalCaptura:hover {
    background-color: #5a2d91 !important;
}

/* Responsive para el modal de captura de imágenes */
@media (max-width: 576px) {
    #modalListaCapturaImagenesIniciales .modal-dialog {
        max-width: 95% !important;
        margin: 0.5rem !important;
        max-height: 95vh !important;
    }
    
    #modalListaCapturaImagenesIniciales .modal-body {
        max-height: calc(95vh - 180px) !important;
        padding: 1rem !important;
    }
    
    #modalListaCapturaImagenesIniciales .modal-header {
        padding: 1rem !important;
    }
    
    #modalListaCapturaImagenesIniciales .modal-footer {
        padding: 0.75rem 1rem !important;
    }
    
    #modalListaCapturaImagenesIniciales .modal-footer .d-flex {
        flex-direction: row !important;
        gap: 0.5rem !important;
        justify-content: center !important;
    }
    
    #modalListaCapturaImagenesIniciales .btn {
        flex: 1 !important;
    min-width: auto !important;
    padding: 12px 16px !important;
    font-size: 0.9rem !important;
}

/* Estilos específicos para el Modal de Captura de Cámara */
#modalCapturaCamara .modal-content {
    background: #000000 !important;
    border-radius: 0 !important;
    height: 100vh !important;
}

#modalCapturaCamara .capture-frame {
    animation: pulse-border 2s infinite;
}

@keyframes pulse-border {
    0% { border-color: #2196F3; opacity: 1; }
    50% { border-color: #64B5F6; opacity: 0.7; }
    100% { border-color: #2196F3; opacity: 1; }
}

#modalCapturaCamara .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

#modalCapturaCamara #btnCapturarFoto:hover {
    background-color: #45a049 !important;
}

#modalCapturaCamara #btnCancelarCamara:hover {
    background-color: #5a6268 !important;
}

/* Responsive para el modal de cámara */
/* Responsive para el modal de cámara */
@media (max-width: 576px) {
    /* Forzar que el modal ocupe toda la pantalla */
    #modalCapturaCamara .modal-dialog {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        max-width: 100vw !important;
        max-height: 100vh !important;
        margin: 0 !important;
        padding: 0 !important;
        z-index: 1050 !important;
    }
    
    #modalCapturaCamara .modal-content {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        max-width: 100vw !important;
        max-height: 100vh !important;
        border-radius: 0 !important;
        border: none !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #000000 !important;
    }
    
    /* Header completamente en la parte superior */
    #modalCapturaCamara .modal-header {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100vw !important;
        height: 50px !important;
        z-index: 1060 !important;
        background: rgba(0,0,0,0.9) !important;
        padding: 8px 15px !important;
        border-bottom: none !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    /* Área de video con altura exacta */
    #modalCapturaCamara .modal-body {
        position: fixed !important;
        top: 50px !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 80px !important;
        width: 100vw !important;
        height: calc(100vh - 130px) !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow: hidden !important;
        z-index: 1000 !important;
    }
    
    /* BOTONES FIJOS EN LA PARTE INFERIOR VISIBLE */
    #modalCapturaCamara .modal-footer {
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100vw !important;
        height: 80px !important;
        z-index: 1070 !important;
        background: rgba(0,0,0,0.95) !important;
        padding: 10px 15px !important;
        margin: 0 !important;
        border-top: 2px solid rgba(255,255,255,0.3) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 -3px 15px rgba(0,0,0,0.8) !important;
    }
    
    /* Contenedor de botones centrado */
    #modalCapturaCamara .modal-footer .d-flex {
        width: 100% !important;
        max-width: 400px !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 15px !important;
        height: 100% !important;
        margin: 0 auto !important;
    }
    
    /* Botones optimizados para móvil */
    #modalCapturaCamara .btn {
        min-width: 120px !important;
        max-width: 150px !important;
        height: 45px !important;
        padding: 8px 15px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        border-radius: 22px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.4) !important;
        border: 2px solid rgba(255,255,255,0.1) !important;
        flex: 1 !important;
        max-width: 140px !important;
    }
    
    /* Ajustar el recuadro de captura para área reducida */
    #modalCapturaCamara .capture-frame {
        width: 240px !important;
        height: 150px !important;
        margin-left: -120px !important;
        margin-top: -75px !important;
        top: calc(50% - 25px) !important;
    }
    
    /* Video ocupando exactamente su área */
    #modalCapturaCamara #videoCamera {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        z-index: 999 !important;
    }
    
    /* Overlay ajustado */
    #modalCapturaCamara .capture-overlay {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        z-index: 1001 !important;
        pointer-events: none !important;
    }
    
    /* Título más pequeño en móvil */
    #modalCapturaCamara .modal-title {
        font-size: 14px !important;
        font-weight: 600 !important;
        text-align: center !important;
    }
    
    /* Forzar que nada interfiera con los botones */
    #modalCapturaCamara .modal-footer * {
        position: relative !important;
        z-index: 1071 !important;
    }
    
    /* Sobrescribir cualquier estilo de Bootstrap que pueda interferir */
    #modalCapturaCamara.modal.show .modal-dialog {
        transform: none !important;
        margin: 0 !important;
    }
    
    /* Asegurar que el backdrop no interfiera */
    #modalCapturaCamara ~ .modal-backdrop {
        z-index: 1040 !important;
    }
}    #modalListaCapturaImagenesIniciales div[style*="padding: 1.5rem"] {
        padding: 1rem !important;
    }
}

@media (max-height: 600px) {
    #modalListaCapturaImagenesIniciales .modal-dialog {
        max-height: 95vh !important;
        margin: 0.5rem auto !important;
    }
    
    #modalListaCapturaImagenesIniciales .modal-body {
        max-height: calc(95vh - 160px) !important;
    }
    
    #modalListaCapturaImagenesIniciales .modal-header,
    #modalListaCapturaImagenesIniciales .modal-footer {
        padding: 0.75rem 1.5rem !important;
    }
}

/* Estilos específicos para el Modal Estudio de Crédito */
#modalEstudioCredito .modal-content {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

/* Forzar visibilidad del modal */
#modalEstudioCredito {
    z-index: 9999 !important;
}

#modalEstudioCredito.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

#modalEstudioCredito .modal-dialog {
    z-index: 10000 !important;
    position: relative !important;
}

#modalEstudioCredito .btn-close {
    font-size: 1.5rem;
    line-height: 1;
    color: #999;
    background: none;
    border: none;
    opacity: 0.4;
}

#modalEstudioCredito .btn-close:hover {
    opacity: 0.7;
    color: #666;
}

#modalEstudioCredito .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.2s ease;
}

#modalEstudioCredito #btnRechazarModalEstudio:hover {
    background-color: #c82333 !important;
}

#modalEstudioCredito #btnCancelarModalEstudio:hover {
    background-color: #5a6268 !important;
}

#modalEstudioCredito #btnValidarModalEstudio:hover {
    background-color: #218838 !important;
}

/* Efecto de foco para los botones */
#modalEstudioCredito .btn:focus {
    box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
    outline: none;
}

/* Responsive para el modal */
@media (max-width: 576px) {
    #modalEstudioCredito .modal-dialog {
        max-width: 350px !important;
        margin: 1rem !important;
    }
    
    #modalEstudioCredito .d-flex {
        flex-direction: row !important;
        gap: 1rem !important;
        justify-content: center !important;
    }
    
    #modalEstudioCredito .btn {
        min-width: 80px !important;
        padding: 12px 16px !important;
        font-size: 0.85rem !important;
    }
}
/* Botones ModalEstudio */
#btnRechazarModalEstudio {
    background-color: #dc3545; 
    color: white; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 6px; 
    font-weight: 600; 
    font-size: 0.95rem; 
    min-width: 90px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnCancelarModalEstudio {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 6px; 
    font-weight: 600; 
    font-size: 0.95rem;
    min-width: 90px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnValidarModalEstudio {
    background-color: #28a745; 
    color: white; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 6px; 
    font-weight: 600; 
    font-size: 0.95rem; 
    min-width: 90px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
/* Botones ModalMetodoAprobacion */
#cod_tipo_metodo_aprobacion_select {
    width: 100%; 
    padding: 12px 16px; 
    border: 2px solid #e0e6ed; 
    border-radius: 8px; 
    background-color: #f8fafc; 
    font-size: 1rem; 
    color: #333333; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    background-repeat: no-repeat; 
    background-position: right 12px center; 
    background-size: 12px;
}
#btnAnteriorModalAprobacion {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnCancelarModalAprobacion {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnSiguienteModalAprobacion {
    background-color: #6f42c1; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: all 0.3s ease;
}

#btnSiguienteModalAprobacion:disabled {
    background-color: #6c757d !important;
    color: #ffffff !important;
    opacity: 0.6 !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
}

#btnSiguienteModalAprobacion:not(:disabled):hover {
    background-color: #5a2d91;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(111, 66, 193, 0.3);
}
/* Botones modalListaCapturaImagenesIniciales */                   
.btn_activar_camara {
    background-color: #e3f2fd; 
    color: #1976d2; 
    border: 2px solid #bbdefb; 
    padding: 12px; 
    border-radius: 6px; 
    font-weight: 500;
}
.btn_cancelar_foto {
    background-color: #ffebee; 
    color: #d32f2f; 
    border: 2px solid #ffcdd2; 
    padding: 12px; 
    border-radius: 6px; 
    min-width: 50px;
}

/* Botones modalProcesarOtrasImagenes */
#btnAnteriorModalProcesarOtrasImagenes {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnCancelarModalProcesarOtrasImagenes {
    background-color: #6c757d; 
    color: white; 
    border: none; 
    padding: 12px 24px; 
    border-radius: 6px; 
    font-weight: 500; 
    font-size: 1rem; 
    min-width: 100px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#btnGuardarModalProcesarOtrasImagenes {
    background-color: #28a745 !important; 
    color: white !important; 
    border: none !important; 
    padding: 12px 20px !important; 
    border-radius: 6px !important; 
    font-weight: 600 !important; 
    font-size: 0.95rem !important; 
    min-width: 90px !important; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

/* Estilo 1: Neon Pulse - Efecto neón pulsante */
#texto_aviso.estilo_neon_pulse {
    background: linear-gradient(135deg, #ff0080 0%, #ff8c00 50%, #00d4ff 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 15px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 800;
    text-align: center;
    border: 2px solid #ff0080;
    box-shadow: 0 0 20px rgba(255, 0, 128, 0.6), 0 0 40px rgba(255, 140, 0, 0.4);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    animation: neonPulse 2s ease-in-out infinite alternate;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
}

@keyframes neonPulse {
    0% { 
        box-shadow: 0 0 20px rgba(255, 0, 128, 0.6), 0 0 40px rgba(255, 140, 0, 0.4);
        transform: scale(1);
    }
    100% { 
        box-shadow: 0 0 30px rgba(255, 0, 128, 1), 0 0 60px rgba(0, 212, 255, 0.8);
        transform: scale(1.05);
    }
}

/* Estilo 2: Fire Alert - Alerta de fuego */
#texto_aviso.estilo_fire_alert {
    background: linear-gradient(135deg, #ff4757 0%, #ff6b35 50%, #ffa502 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    margin-top: 0.75rem;
    font-size: 0.95rem;
    font-weight: 900;
    text-align: center;
    border: 3px solid #ff4757;
    box-shadow: 0 8px 25px rgba(255, 71, 87, 0.5);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    animation: fireFlicker 1.5s ease-in-out infinite;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
}

@keyframes fireFlicker {
    0%, 100% { 
        background: linear-gradient(135deg, #ff4757 0%, #ff6b35 50%, #ffa502 100%);
        box-shadow: 0 8px 25px rgba(255, 71, 87, 0.5);
    }
    50% { 
        background: linear-gradient(135deg, #ff6b35 0%, #ffa502 50%, #ff4757 100%);
        box-shadow: 0 8px 35px rgba(255, 107, 53, 0.8);
    }
}

/* Estilo 3: Electric Blue - Azul eléctrico */
#texto_aviso.estilo_electric_blue {
    background: linear-gradient(135deg, #0078ff 0%, #00d4ff 50%, #667eea 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 25px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 700;
    text-align: center;
    border: 2px solid #00d4ff;
    box-shadow: 0 6px 30px rgba(0, 120, 255, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.3);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: electricGlow 3s ease-in-out infinite;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}

@keyframes electricGlow {
    0%, 100% { 
        box-shadow: 0 6px 30px rgba(0, 120, 255, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }
    50% { 
        box-shadow: 0 6px 40px rgba(0, 212, 255, 0.8), inset 0 1px 0 rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }
}

/* Estilo 4: Rainbow Shine - Brillo arcoíris */
#texto_aviso.estilo_rainbow_shine {
    background: linear-gradient(45deg, #ff0080, #ff8c00, #00d4ff, #8a2be2, #ff0080);
    background-size: 400% 400%;
    color: #ffffff;
    padding: 0.5rem 1rem;
    border-radius: 30px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 800;
    text-align: center;
    border: 2px solid #ffffff;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: rainbowMove 4s ease infinite;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
}

@keyframes rainbowMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Estilo 5: Cyber Green - Verde cibernético */
#texto_aviso.estilo_cyber_green {
    background: linear-gradient(135deg, #39ff14 0%, #00ff41 50%, #00cc33 100%);
    color: #001100;
    padding: 0.4rem 1rem;
    border-radius: 12px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 900;
    text-align: center;
    border: 2px solid #39ff14;
    box-shadow: 0 0 20px rgba(57, 255, 20, 0.8), 0 4px 15px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
    font-family: 'Courier New', monospace;
    text-transform: uppercase;
    letter-spacing: 2px;
    animation: cyberGlitch 2.5s ease-in-out infinite;
    text-shadow: 0 0 5px rgba(57, 255, 20, 0.8);
}

@keyframes cyberGlitch {
    0%, 90%, 100% { 
        transform: translateX(0);
        filter: hue-rotate(0deg);
    }
    92% { 
        transform: translateX(-2px);
        filter: hue-rotate(90deg);
    }
    94% { 
        transform: translateX(2px);
        filter: hue-rotate(180deg);
    }
    96% { 
        transform: translateX(-1px);
        filter: hue-rotate(270deg);
    }
}

/* Estilo 6: Sunset Warning - Advertencia atardecer */
#texto_aviso.estilo_sunset_warning {
    background: linear-gradient(135deg, #ff7f50 0%, #ff6347 50%, #ff4500 100%);
    color: #ffffff;
    padding: 0.5rem 1rem;
    border-radius: 18px;
    margin-top: 0.75rem;
    font-size: 0.88rem;
    font-weight: 700;
    text-align: center;
    border: 3px solid #ff6347;
    box-shadow: 0 10px 30px rgba(255, 99, 71, 0.4), inset 0 2px 0 rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: sunsetPulse 3s ease-in-out infinite;
    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
}

@keyframes sunsetPulse {
    0%, 100% { 
        box-shadow: 0 10px 30px rgba(255, 99, 71, 0.4), inset 0 2px 0 rgba(255, 255, 255, 0.2);
        transform: scale(1);
    }
    50% { 
        box-shadow: 0 15px 40px rgba(255, 69, 0, 0.7), inset 0 2px 0 rgba(255, 255, 255, 0.4);
        transform: scale(1.03);
    }
}

/* Estilo 7: Galaxy Purple - Púrpura galaxia */
#texto_aviso.estilo_galaxy_purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #8e44ad 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 16px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 700;
    text-align: center;
    border: 2px solid #764ba2;
    box-shadow: 0 8px 25px rgba(118, 75, 162, 0.5);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: galaxyFloat 4s ease-in-out infinite;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
}

@keyframes galaxyFloat {
    0%, 100% { 
        transform: translateY(0) rotate(0deg);
        box-shadow: 0 8px 25px rgba(118, 75, 162, 0.5);
    }
    50% { 
        transform: translateY(-5px) rotate(1deg);
        box-shadow: 0 12px 35px rgba(142, 68, 173, 0.8);
    }
}

/* Estilo 8: Matrix Code - Código Matrix */
#texto_aviso.estilo_matrix_code {
    background: linear-gradient(135deg, #001100 0%, #003300 50%, #004400 100%);
    color: #00ff00;
    padding: 0.4rem 1rem;
    border-radius: 8px;
    margin-top: 0.75rem;
    font-size: 0.85rem;
    font-weight: 600;
    text-align: center;
    border: 1px solid #00ff00;
    box-shadow: 0 0 20px rgba(0, 255, 0, 0.5), inset 0 0 20px rgba(0, 255, 0, 0.1);
    position: relative;
    overflow: hidden;
    font-family: 'Courier New', monospace;
    text-transform: uppercase;
    letter-spacing: 1px;
    animation: matrixFlicker 2s linear infinite;
    text-shadow: 0 0 10px rgba(0, 255, 0, 0.8);
}

@keyframes matrixFlicker {
    0%, 95%, 100% { opacity: 1; }
    96%, 98% { opacity: 0.8; }
    97% { opacity: 0.9; }
}

/* Estilo 9: Tropical Sunset - Atardecer tropical */
#texto_aviso.estilo_tropical_sunset {
    background: linear-gradient(135deg, #ff9a56 0%, #ff6b9d 50%, #c44569 100%);
    color: #ffffff;
    padding: 0.5rem 1rem;
    border-radius: 22px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 700;
    text-align: center;
    border: 2px solid #ff6b9d;
    box-shadow: 0 8px 30px rgba(255, 107, 157, 0.4);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: tropicalWave 3.5s ease-in-out infinite;
    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
}

@keyframes tropicalWave {
    0%, 100% { 
        transform: skew(0deg) scale(1);
        filter: hue-rotate(0deg);
    }
    25% { 
        transform: skew(1deg) scale(1.02);
        filter: hue-rotate(10deg);
    }
    75% { 
        transform: skew(-1deg) scale(1.02);
        filter: hue-rotate(-10deg);
    }
}

/* Estilo 10: Crystal Ice - Hielo cristal */
#texto_aviso.estilo_crystal_ice {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 50%, #6c5ce7 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 700;
    text-align: center;
    border: 2px solid #74b9ff;
    box-shadow: 0 8px 32px rgba(116, 185, 255, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.5);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: crystalShine 4s ease-in-out infinite;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(10px);
}

@keyframes crystalShine {
    0%, 100% { 
        box-shadow: 0 8px 32px rgba(116, 185, 255, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.5);
    }
    50% { 
        box-shadow: 0 12px 40px rgba(9, 132, 227, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.7);
        transform: translateY(-3px);
    }
}

/* Estilo 11: Lava Flow - Flujo de lava */
#texto_aviso.estilo_lava_flow {
    background: linear-gradient(135deg, #ff3333 0%, #ff6600 50%, #cc0000 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 14px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 800;
    text-align: center;
    border: 3px solid #ff3333;
    box-shadow: 0 6px 25px rgba(255, 51, 51, 0.6);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: lavaFlow 3s ease-in-out infinite;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
}

@keyframes lavaFlow {
    0%, 100% { 
        background: linear-gradient(135deg, #ff3333 0%, #ff6600 50%, #cc0000 100%);
        box-shadow: 0 6px 25px rgba(255, 51, 51, 0.6);
    }
    33% { 
        background: linear-gradient(135deg, #ff6600 0%, #cc0000 50%, #ff3333 100%);
        box-shadow: 0 8px 30px rgba(255, 102, 0, 0.8);
    }
    66% { 
        background: linear-gradient(135deg, #cc0000 0%, #ff3333 50%, #ff6600 100%);
        box-shadow: 0 6px 25px rgba(204, 0, 0, 0.6);
    }
}

/* Estilo 12: Hologram - Holograma */
#texto_aviso.estilo_hologram {
    background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(255, 0, 255, 0.3) 50%, rgba(255, 255, 0, 0.3) 100%);
    color: #ffffff;
    padding: 0.4rem 1rem;
    border-radius: 18px;
    margin-top: 0.75rem;
    font-size: 0.9rem;
    font-weight: 700;
    text-align: center;
    border: 2px solid rgba(255, 255, 255, 0.5);
    box-shadow: 0 8px 32px rgba(0, 255, 255, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.6);
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: hologramShift 5s linear infinite;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(5px);
}

@keyframes hologramShift {
    0% { 
        background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(255, 0, 255, 0.3) 50%, rgba(255, 255, 0, 0.3) 100%);
        filter: hue-rotate(0deg);
    }
    33% { 
        background: linear-gradient(135deg, rgba(255, 0, 255, 0.3) 0%, rgba(255, 255, 0, 0.3) 50%, rgba(0, 255, 255, 0.3) 100%);
        filter: hue-rotate(120deg);
    }
    66% { 
        background: linear-gradient(135deg, rgba(255, 255, 0, 0.3) 0%, rgba(0, 255, 255, 0.3) 50%, rgba(255, 0, 255, 0.3) 100%);
        filter: hue-rotate(240deg);
    }
    100% { 
        background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(255, 0, 255, 0.3) 50%, rgba(255, 255, 0, 0.3) 100%);
        filter: hue-rotate(360deg);
    }
}
</style>

<!-- Modal Detalle de Crédito -->
<style>
    .modal-detalle-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 1.5rem;
        border: none;
        position: relative;
    }
    .modal-detalle-header .close {
        color: white;
        opacity: 1;
        text-shadow: none;
        font-size: 2rem;
        position: absolute;
        top: 0.5rem;
        right: 1rem;
        background: none;
        border: none;
        cursor: pointer;
    }
    .modal-detalle-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    .detalle-section {
        background: #f7fafc;
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .detalle-info-box {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    .detalle-info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }
    .detalle-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    .detalle-label i {
        margin-right: 0.5rem;
        color: #667eea;
    }
    .detalle-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
    }
    .detalle-value-large {
        font-size: 1.5rem;
        font-weight: 700;
        color: #667eea;
        margin: 0;
    }
    .btn-detalle-action {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-detalle-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    .btn-detalle-action i {
        font-size: 1rem;
    }
    .section-divider-detalle {
        display: flex;
        align-items: center;
        margin: 1.5rem 0 1rem 0;
    }
    .section-divider-detalle::before,
    .section-divider-detalle::after {
        content: '';
        flex: 1;
        border-bottom: 2px solid #e2e8f0;
    }
    .section-divider-detalle span {
        padding: 0 1rem;
        color: #667eea;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .estado-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .imagenes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .imagen-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .imagen-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    /* Scroll unificado para todo el modal */
    .modal-detalle-wrapper {
        max-height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Ocultar scrollbar en navegadores webkit */
    .modal-detalle-wrapper::-webkit-scrollbar {
        width: 8px;
    }
    
    .modal-detalle-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .modal-detalle-wrapper::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }
    
    .modal-detalle-wrapper::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    
    /* Estilos responsivos para pantallas pequeñas */
    @media (max-width: 768px) {
        .modal-detalle-wrapper {
            max-height: 85vh;
        }
        
        .detalle-info-box {
            margin-bottom: 0.75rem;
        }
        
        .section-divider-detalle {
            margin: 1rem 0 0.75rem 0;
        }
        
        .detalle-section {
            padding: 1rem;
        }
        
        .modal-detalle-header {
            padding: 1rem;
        }
        
        .modal-detalle-header h4 {
            font-size: 1.3rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .modal-lg {
            max-width: 95%;
            margin: 0.5rem auto;
        }
        
        .modal-detalle-wrapper {
            max-height: 80vh;
        }
        
        .detalle-value-large {
            font-size: 1.2rem;
        }
        
        .detalle-value {
            font-size: 0.95rem;
        }
        
        /* Mantener dos columnas incluso en pantallas pequeñas */
        .row > [class*="col-md-6"] {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
        
        .row > [class*="col-md-4"] {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
        
        .row > [class*="col-md-8"] {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
        
        /* Ajustar padding de las cajas para que se vean mejor en dos columnas */
        .detalle-info-box {
            padding: 0.75rem 0.5rem;
        }
        
        .detalle-label {
            font-size: 0.65rem;
        }
        
        .btn-detalle-action {
            font-size: 0.75rem;
            padding: 0.4rem 0.75rem;
        }
    }
</style>