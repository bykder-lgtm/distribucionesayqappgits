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
     	$aColumns = array('tbl15_tercero.nombre1_tercero', 'tbl15_tercero.identificacion_tercero', 'tbl15_entidad_crediticia.nombre_entidad_crediticia'); //Columnas de busqueda
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
    $sWhere.=" ORDER BY tbl15_info_factura_venta.cod_info_factura_venta DESC";
} else {
    $sWhere.=" ORDER BY tbl15_info_factura_venta.cod_info_factura_venta DESC";
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

	$calcular_datos_cuenta_cobrar = "SELECT tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, 
    tbl15_info_factura_venta.nombre_tipo_cobro, tbl15_info_factura_venta.cod_tercero, tbl15_info_factura_venta.monto_deuda, 
    tbl15_info_factura_venta.monto_cuota, tbl15_info_factura_venta.cod_entidad_crediticia, tbl15_info_factura_venta.nombre_estado_factura, 
    tbl15_info_factura_venta.cod_resolucion_facturacion, tbl15_info_factura_venta.cod_estado_factura, tbl15_info_factura_venta.fecha_creacion, 
    tbl15_info_factura_venta.cod_tienda, tbl15_info_factura_venta.cod_administrador, tbl15_info_factura_venta.cod_tipo_pago, 
    tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, 
    tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.correo_tercero, 
    tbl15_info_factura_venta.cod_operador_credito, tbl15_info_factura_venta.cod_tipo_forma_pago_operador_credito, 
    tbl15_info_factura_venta.cod_administrador_lider, tbl15_info_factura_venta.cod_administrador_coordinador, tbl15_info_factura_venta.cod_administrador_asesor, 
    tbl15_info_factura_venta.cod_administrador_aliado_estrategico, tbl15_info_factura_venta.cod_administrador_revisor, 
    tbl15_info_factura_venta.cod_vendedor, tbl15_info_factura_venta.cod_banco_cuenta, tbl15_info_factura_venta.cod_tipo_forma_pago, 
    tbl15_info_factura_venta.observacion_tercero
	FROM $sTable $sWhere LIMIT $registro_inicio, $numero_registro_por_pagina";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
	while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

		$cod_info_factura_venta                                         = $datos_cuenta_cobrar['cod_info_factura_venta'];
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

		$nombre_tienda = $datos_tienda['nombre_tienda'] ? $datos_tienda['nombre_tienda'] : 'Sin tienda';
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
        $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
        $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

        $nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
        $consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
        $datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);

        $nombre_banco_cuenta                                          = $datos_banco_cuenta['nombre_banco_cuenta'].' | '.$datos_banco_cuenta['numero_banco_cuenta'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_vendedor = "SELECT * FROM tbl15_vendedor WHERE (cod_vendedor = '$cod_vendedor')";
        $consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
        $datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);

        $nombre_vendedor                                               = $datos_vendedor['nombres'].' '.$datos_vendedor['apellidos'];
        /* ----------------------------------------------------------------------------------------------------------/ */
		$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
		$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
		$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

		$nombre_tipo_pago                                               = $datos_tipo_pago['nombre_tipo_pago'] ? $datos_tipo_pago['nombre_tipo_pago'] : 'Sin tipo de pago';
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
        $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

        $nombre_tipo_forma_pago                                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
        /* ----------------------------------------------------------------------------------------------------------/ */
        $sql_tipo_forma_pago_operador_credito = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_operador_credito')";
        $consulta_tipo_forma_pago_operador_credito = mysqli_query($conectar, $sql_tipo_forma_pago_operador_credito) or die(mysqli_error($conectar));
        $datos_tipo_forma_pago_operador_credito = mysqli_fetch_assoc($consulta_tipo_forma_pago_operador_credito);

        $nombre_tipo_forma_pago_operador_credito                        = $datos_tipo_forma_pago_operador_credito['nombre_tipo_forma_pago'];
        /* ----------------------------------------------------------------------------------------------------------/ */
		// Obtener nombre del administrador (aliado)
		$sql_admin = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_factura'";
		$consulta_admin = mysqli_query($conectar, $sql_admin);
		$datos_admin = mysqli_fetch_assoc($consulta_admin);

		$nombre_aliado                                                  = trim($datos_admin['nombre1_tercero'].' '.$datos_admin['apellido1_tercero']);
		if (!$nombre_aliado) $nombre_aliado = 'Sin asignar';
        /* ----------------------------------------------------------------------------------------------------------/ */
	    $sql_estado_facturacion = "SELECT * FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$cod_estado_factura')";
	    $consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion) or die(mysqli_error($conectar));
	    $datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

	    $nombre_estado_facturacion                                      = $datos_estado_facturacion['nombre_estado_facturacion'];
        $estilo_css_estado_factura                                      = $datos_estado_facturacion['color_fondo_celda_estado'];
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
        if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; }

        $sql_venta_producto_temporal = "SELECT cod_producto_barra, nombre_producto, serial1_producto, serial2_producto FROM $tabla_productos_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
	    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

	    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
	    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
	    $serial1_producto                                               = $datos_venta_producto_temporal['serial1_producto'];
	    $serial2_producto                                               = $datos_venta_producto_temporal['serial2_producto'];
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
                            <?php echo json_encode($cod_tercero); ?>,
                            <?php echo json_encode($cod_info_factura_venta); ?>
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

                    <?php if ($cod_estado_factura == '0') { ?>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="btn_procesar_solicitud" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_tercero="<?php echo $cod_tercero; ?>" class="btn_estudio_movil_enrollment w-100">Cargar imagenes</button>
                        </div>
                    </div>
                    <?php } elseif ($cod_estado_factura == '1') { ?>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="btn_procesar_otras_imagenes" data-cod_info_factura_venta="<?php echo $cod_info_factura_venta; ?>" data-cod_tercero="<?php echo $cod_tercero; ?>" class="btn_estudio_movil_enrollment w-100">Cargar otras imagenes</button>
                            <p id="texto_aviso" style="background-color: #2d3748; color: #ffffff; padding: 0.4rem 1rem; border-radius: 8px; margin-top: 0.75rem; font-size: 0.85rem; font-weight: 500; text-align: center; border-left: 4px solid #667eea; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 0; line-height: 1.2;">Atento al grupo para envío del código o link al cliente</p>
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

<!-- Modal Detalle de Crédito -->
<div class="modal fade" id="modalDetalleCredito" tabindex="-1" aria-labelledby="modalDetalleCreditoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            
    <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 0.1rem; display: block; position: relative;">
        <button type="button" class="close-modal-solicitud" data-bs-dismiss="modal" aria-label="Cerrar" style="position: absolute; top: 0.8rem; right: 0.8rem;">
            <span style="font-size: 1.25rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
        </button>
                <div style="text-align: center; width: 100%;">
                    <div style="margin-bottom: 0.8rem;">
                        <span id="modalEstadoCredito" style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600;"></span>
                    </div>
                    <h5 class="modal-title" id="modalDetalleCreditoLabel" style="font-weight: 700; font-size: 1.3rem; margin: 0; text-align: center;">
                        <span id="modalNombreCliente" style="color: #00d4ff;"></span>
                    </h5>
					<p style="text-align: center; color: #cbd5e0; margin-bottom: 1.5rem;">
						CC: <span id="modalCedulaCliente"></span>
					</p>
                </div>
            </div>

			<div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem; display: block; position: relative;">
               
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="text-align: left;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Valor</p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;">$<span id="modalValorCredito"></span></p>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Tipo de venta</p>
                        <p style="font-size: 1rem; font-weight: 700; margin: 0;"><span id="modalTipoVenta" style="color: white;"></span></p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="text-align: left;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Fecha de creación</p>
                        <p style="font-weight: 600; color: white; margin: 0;" id="modalFechaCreacion"></p>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Hora</p>
                        <p style="font-weight: 600; color: white; margin: 0;" id="modalHora"></p>
                    </div>
                </div>
            </div>

			<div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem; display: block; position: relative;">
               	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="text-align: left;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Tienda</p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><span id="modalTienda"></span></p>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Aliado</p>
                        <p style="font-size: 1rem; font-weight: 700; margin: 0;"><span id="modalAliado" style="color: white;"></span></p>
                    </div>
                </div>
				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="text-align: left;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">linea de Credito</p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><span id="modal_entidad_crediticia"></span></p>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Cuenta de Banco</p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><span id="modal_nombre_banco_cuenta"></span></p>
                    </div>
                </div>
            </div>

			<div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem; display: block; position: relative;">

				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="text-align: left;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">Observaciones</p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><span id="modal_observacion_tercero"></span></p>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.3rem;">ID Credito</p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><span id="modalIDApp"></span></p>
                    </div>
                </div>

				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="text-align: center;">
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><a href="../admin/contactar_por_whatapp_registro_cliente_y_precredito_revisor_siscredito_visitante_intern.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&notificar=REVISOR" target="_blank" class="btn-action btn-share">Notificar al Revisor</a></p>
                    </div>
                    <div style="text-align: center;">
                        <p style="font-size: 1.2rem; font-weight: 700; color: white; margin: 0;"><a href="../admin/contactar_por_whatapp_registro_cliente_y_precredito_revisor_siscredito_visitante_intern.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&notificar=CLIENTE" target="_blank" class="btn-action btn-share">Notificar al Cliente</a></p>
                    </div>
                </div>

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
<div class="modal fade" id="modalListaCapturaImagenes" tabindex="-1" aria-labelledby="modalListaCapturaImagenesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down" style="max-width: 500px; max-height: 90vh;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); background: #ffffff; height: 100%;">
            <!-- Header fijo -->
             <input type="hidden" id="cod_info_factura_venta_modal_lista_captura_imagenes" value="">
             <input type="hidden" id="cod_tercero_modal_lista_captura_imagenes" value="">
             <input type="hidden" id="cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes" value="">

            <div class="modal-header" style="border-bottom: 1px solid #dee2e6; padding: 1.5rem 1.5rem 1rem 1.5rem; position: relative; flex-shrink: 0;">
                <!-- Botón X de cierre -->
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d; z-index: 10;"></button>
                <!-- Encabezado -->
                <div class="text-center w-100">
                    <!--<h4 style="font-size: 1.4rem; font-weight: 600; color: #333333; margin-bottom: 0.5rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Enrolar Crédito - Paso 4/5</h4>-->
                    <p style="font-size: 1.1rem; color: #666666; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Captura de imágenes</p>
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
                    <button type="button" class="btn" id="btnAnteriorModalCaptura">Anterior</button>
                    <button type="button" class="btn" id="btnCancelarModalCaptura" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnSiguienteModalCaptura">Guardar</button>
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
                        <i class="fas fa-lightbulb"></i>
                    </button>
                    <!-- Botones principales (centro) -->
                    <div class="d-flex justify-content-center flex-grow-1" style="gap: 1.5rem;">
                        <button type="button" class="btn btn-lg" id="btnCapturarFoto" data-cod-info-factura="<?php echo $cod_info_factura_venta ?>" data-cod-tercero="<?php echo $cod_tercero ?>"  data-cod-nota-observacion="<?php echo $cod_nota_observacion ?>"><i class="fas fa-camera"></i> Capturar</button>
                        <button type="button" class="btn btn-lg" id="btnCancelarCamara" onclick="cerrarModalCamara(); document.getElementById('modalCapturaCamara').style.display='none'; return false;" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
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
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; opacity: 0.4; font-size: 1.2rem; border: none; background: none; color: #6c757d; z-index: 10;"></button>
                <!-- Encabezado -->
                <div class="text-center w-100">
                    <p style="font-size: 1.1rem; color: #666666; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Cargar otras imágenes</p>
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
                    <button type="button" class="btn" id="btnCancelarModalProcesarOtrasImagenes" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnSiguienteModalProcesarOtrasImagenes">Guardar</button>
                </div>
            </div>
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
                    <p style="font-size: 1.1rem; color: #666666; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Cargar otras imágenes</p>
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
                    <button type="button" class="btn" id="btnSiguienteModalProcesarOtrasImagenes">Siguiente</button>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
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

/* Botones modalListaCapturaImagenes */
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
/* Botones modalListaCapturaImagenes */
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
#btnSiguienteModalCaptura {
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

/* Botones modalProcesarOtrasImagenes - mismos estilos que modalListaCapturaImagenes */
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
#btnSiguienteModalProcesarOtrasImagenes {
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
#modalListaCapturaImagenes .modal-content {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

#modalListaCapturaImagenes .modal-dialog {
    max-height: 90vh !important;
    margin: 1rem auto !important;
}

#modalListaCapturaImagenes .modal-body {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

#modalListaCapturaImagenes .modal-body::-webkit-scrollbar {
    width: 6px;
}

#modalListaCapturaImagenes .modal-body::-webkit-scrollbar-track {
    background: #f7fafc;
    border-radius: 3px;
}

#modalListaCapturaImagenes .modal-body::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 3px;
}

#modalListaCapturaImagenes .modal-body::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

#modalListaCapturaImagenes .btn-close {
    font-size: 1.5rem;
    line-height: 1;
    color: #999;
    background: none;
    border: none;
    opacity: 0.4;
}

#modalListaCapturaImagenes .btn-close:hover {
    opacity: 0.7;
    color: #666;
}

#modalListaCapturaImagenes .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.2s ease;
}

#modalListaCapturaImagenes .btn:focus {
    box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
    outline: none;
}

#modalListaCapturaImagenes button[style*="background-color: #e3f2fd"]:hover {
    background-color: #bbdefb !important;
    border-color: #90caf9 !important;
}

#modalListaCapturaImagenes button[style*="background-color: #ffebee"]:hover {
    background-color: #ffcdd2 !important;
    border-color: #ef9a9a !important;
}

#modalListaCapturaImagenes #btnAnteriorModalCaptura:hover,
#modalListaCapturaImagenes #btnCancelarModalCaptura:hover {
    background-color: #5a6268 !important;
}

#modalListaCapturaImagenes #btnSiguienteModalCaptura:hover {
    background-color: #5a2d91 !important;
}

/* Responsive para el modal de captura de imágenes */
@media (max-width: 576px) {
    #modalListaCapturaImagenes .modal-dialog {
        max-width: 95% !important;
        margin: 0.5rem !important;
        max-height: 95vh !important;
    }
    
    #modalListaCapturaImagenes .modal-body {
        max-height: calc(95vh - 180px) !important;
        padding: 1rem !important;
    }
    
    #modalListaCapturaImagenes .modal-header {
        padding: 1rem !important;
    }
    
    #modalListaCapturaImagenes .modal-footer {
        padding: 0.75rem 1rem !important;
    }
    
    #modalListaCapturaImagenes .modal-footer .d-flex {
        flex-direction: row !important;
        gap: 0.5rem !important;
        justify-content: center !important;
    }
    
    #modalListaCapturaImagenes .btn {
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
}    #modalListaCapturaImagenes div[style*="padding: 1.5rem"] {
        padding: 1rem !important;
    }
}

@media (max-height: 600px) {
    #modalListaCapturaImagenes .modal-dialog {
        max-height: 95vh !important;
        margin: 0.5rem auto !important;
    }
    
    #modalListaCapturaImagenes .modal-body {
        max-height: calc(95vh - 160px) !important;
    }
    
    #modalListaCapturaImagenes .modal-header,
    #modalListaCapturaImagenes .modal-footer {
        padding: 0.75rem 1.5rem !important;
    }
}

/* Estilos específicos para el Modal Estudio de Crédito */
#modalEstudioCredito .modal-content {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
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
/* Botones modalListaCapturaImagenes */                   
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
</style>

<script>
// ============================================
// Variables globales para datos de crédito
// ============================================
var cod_info_factura_venta_global = null;
var cod_tercero_global = null;

// Función para abrir el modal con los datos del crédito

function abrirModalDetalleCredito(nombres_apellidos, identificacion_tercero, monto_deuda, monto_deuda_sin_interes, nombre_tipo_pago, cod_entidad_crediticia, nombre_entidad_crediticia, nombre_operador_credito, nombre_tienda, nombre_aliado, nombre_banco_cuenta, nombre_estado_facturacion, nombre_estado_revision, nombres_apellidos_asesor, observacion_tercero, fecha_formateada, hora_formateada, cod_tercero, cod_info_factura_venta) {
    
    document.getElementById('modalNombreCliente').textContent = nombres_apellidos;
    document.getElementById('modalCedulaCliente').textContent = identificacion_tercero;
    document.getElementById('modalValorCredito').textContent = monto_deuda;
    document.getElementById('modalTipoVenta').textContent = nombre_estado_facturacion;
    document.getElementById('modal_entidad_crediticia').textContent = nombre_entidad_crediticia;
    //document.getElementById('modal_operador_credito').textContent = operador_credito;
    document.getElementById('modalTienda').textContent = nombre_tienda;
    document.getElementById('modalAliado').textContent = nombre_aliado;
    document.getElementById('modal_nombre_banco_cuenta').textContent = nombre_banco_cuenta;
    //document.getElementById('modal_estado_revision').textContent = estado_revision;
    document.getElementById('modalFechaCreacion').textContent = fecha_formateada;
    document.getElementById('modalHora').textContent = hora_formateada;
    document.getElementById('modal_observacion_tercero').textContent = observacion_tercero;   
    document.getElementById('modalIDApp').textContent = cod_info_factura_venta;

    // Mostrar el estado del crédito con colores según el estado
    var estadoElement = document.getElementById('modalEstadoCredito');
    estadoElement.textContent = estadoCredito;
    
    $('#modalDetalleCredito').modal('show');
}

// Función para copiar al portapapeles
function copiarAlPortapapeles(texto) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(texto).then(function() {
            // Mostrar notificación de éxito
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'ID copiado al portapapeles'
            });
        }).catch(function(err) {
            alert('ID Aplicación: ' + texto);
        });
    } else {
        // Fallback para navegadores antiguos
        var textArea = document.createElement("textarea");
        textArea.value = texto;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            alert('ID copiado: ' + texto);
        } catch (err) {
            alert('ID Aplicación: ' + texto);
        }
        document.body.removeChild(textArea);
    }
}

// ============================================
// Función para procesar solicitud de crédito
// ============================================
function procesarSolicitudCredito(codInfoFacturaVenta, codTercero) {
    // Almacenar en variables globales
    cod_info_factura_venta_global = codInfoFacturaVenta;
    cod_tercero_global = codTercero;
    console.log('Desplegar modal: modalEstudioCredito:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global  });   
    // Actualizar el ID en el modal de estudio
    $('#creditoIDNumero').text(codInfoFacturaVenta);
    // Abrir el modal de estudio de crédito
    $('#modalEstudioCredito').modal('show');
    $('#cod_info_factura_venta_modal_estudio_credito').val(codInfoFacturaVenta);
    $('#cod_tercero_modal_estudio_credito').val(codTercero);
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
    // Llamar a la función de procesamiento
    procesarSolicitudCredito(codInfoFacturaVenta, codTercero);
});

// Manejar las acciones de los botones del modal
$(document).ready(function() {   
    // ============================================
    // Función para validar estudio de crédito
    // ============================================
    function validarEstudioCredito(codInfoFacturaVenta, codTercero) {
        // Cerrar el modal actual
        $('#modalEstudioCredito').modal('hide');
        // Esperar a que se cierre completamente antes de abrir el nuevo
        setTimeout(function() {
            $('#modalMetodoAprobacion').modal('show');
            console.log('Desplegar modal: modalMetodoAprobacion:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global  });   
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
        var codInfoFacturaVenta = $(this).data('cod_info_factura_venta');
        var codTercero = $(this).data('cod_tercero');
        
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
        // Cerrar el modal actual
        $('#modalMetodoAprobacion').modal('hide');
        // Esperar a que se cierre completamente antes de abrir el nuevo
        setTimeout(function() {
            $('#modalListaCapturaImagenes').modal('show');
            
            console.log('Desplegar modal: modalListaCapturaImagenes:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global  });   
            $('#cod_info_factura_venta_modal_lista_captura_imagenes').val(cod_info_factura_venta_global);
            $('#cod_tercero_modal_lista_captura_imagenes').val(cod_tercero_global);
            $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val(cod_tipo_metodo_aprobacion);
        }, 300);
    });
    
    // Botones del Modal Captura de Imágenes
    
    // Botón Anterior - Volver al modal anterior
    $('#btnAnteriorModalCaptura').click(function() {
        // Cerrar el modal actual
        $('#modalListaCapturaImagenes').modal('hide');
        
        // Esperar a que se cierre completamente antes de abrir el anterior
        setTimeout(function() {
            $('#modalMetodoAprobacion').modal('show');
        }, 300);
    });
    
    // Botón Siguiente - Validar y enviar imágenes
    $('#btnSiguienteModalCaptura').click(function() {
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
            alert('Error: Faltan datos requeridos para procesar las imágenes.');
            return;
        }
        
        // Validar que todas las imágenes estén cargadas
        var todasImagenesCargadas = validarTodasImagenesCargadas();
        
        if (!todasImagenesCargadas) {
            alert('Por favor, capture todas las imágenes requeridas antes de continuar.');
            return;
        }
        
        // Si todas las validaciones pasan, enviar por AJAX
        enviarImagenesAjax(cod_info_factura_venta, cod_tercero, cod_tipo_metodo_aprobacion);
    });
    
    // Botón Cancelar ya tiene data-bs-dismiss="modal" en el HTML
});

// Función para validar que todas las imágenes obligatorias estén cargadas
function validarTodasImagenesCargadas() {
    console.log('Validando que todas las imágenes obligatorias estén cargadas...');
    
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
    
    console.log('Total de imágenes obligatorias:', totalImagenesObligatorias);
    console.log('Imágenes obligatorias completadas:', imagenesObligatoriasCompletadas);
    //console.log('Imágenes obligatorias faltantes:', imagenesObligatoriasFaltantes);
    
    // Si faltan imágenes obligatorias, mostrar mensaje específico
    if (imagenesObligatoriasFaltantes.length > 0) {
        var mensajeFaltantes = 'Faltan las siguientes imágenes obligatorias:\n\n';
        imagenesObligatoriasFaltantes.forEach(function(imagen, index) {
            mensajeFaltantes += '• ' + imagen + '\n';
        });
        mensajeFaltantes += '\nPor favor, capture todas las imágenes marcadas con (*) antes de continuar.';
        
        alert(mensajeFaltantes);
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

// Función para enviar las imágenes por AJAX
function enviarImagenesAjax(cod_info_factura_venta, cod_tercero, cod_tipo_metodo_aprobacion) {
    var tab = '';
    var campo = '';
    var tipo_ajax = '';
    var pagina = '';
    console.log('Guardando imágenes por AJAX...');
    // Mostrar indicador de carga
    $('#btnSiguienteModalCaptura').prop('disabled', true);
    $('#btnSiguienteModalCaptura').html('<i class="fa fa-spinner fa-spin"></i> Procesando...');
    
    // Crear FormData para enviar los datos
    var formData = new FormData();
    formData.append('action', 'procesar_imagenes_credito');
    formData.append('cod_info_factura_venta', cod_info_factura_venta);
    formData.append('cod_tercero', cod_tercero);
    formData.append('cod_tipo_metodo_aprobacion', cod_tipo_metodo_aprobacion);
    
    // Enviar solicitud AJAX
    $.ajax({
        url: '../admin/procesar_imagenes_credito_ajax.php', // Archivo PHP que procesará las imágenes
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
            $('#btnSiguienteModalCaptura').html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

            if (success) {
                // Si la respuesta es exitosa, proceder a enviar la notificación al chatbot
                var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
                $.ajax({
                    type: "GET",
                    url: "../admin/enviar_notificacion_chatbot_canal_telegram_registro_cliente_simulador_credito_json.php",
                    data: datos_url_ajax,
                    //dataType: 'json',
                    beforeSend: function(objeto){
                        //$('#btnSiguienteModalCaptura').html('<i class="fa fa-spinner fa-spin"></i> Notificando..');
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
                                $('#btnSiguienteModalCaptura').html('<img src="../imagenes/ajax-loader.gif"> Notificando Telegram...');
                            },
                            success:function(respuesta){
                                // Éxito - cerrar modal y mostrar mensaje
                                $('#modalListaCapturaImagenes').modal('hide');
                                alert('Imágenes procesadas exitosamente. ' + message);
                                
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
                alert('Error al procesar las imágenes: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX:', error);
            alert('Error de conexión al procesar las imágenes. Por favor, inténtelo de nuevo.');
        },
        complete: function() {
            // Restaurar botón
            $('#btnSiguienteModalCaptura').prop('disabled', false);
            $('#btnSiguienteModalCaptura').html('Guardando...');
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

// Función para abrir el modal de cámara
function abrirModalCamara(cod_nota_observacion) {
    window.currentCodNotaObservacion = cod_nota_observacion;
    var cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val();
    // Verificar si Bootstrap está disponible
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap no está disponible');
        alert('Error: Bootstrap no está cargado');
        return;
    }
    
    const modalElement = document.getElementById('modalCapturaCamara');
    if (!modalElement) {
        console.error('Modal no encontrado');
        alert('Error: Modal de cámara no encontrado');
        return;
    }
    
    try {
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();
        
        //console.log('Modal abierto exitosamente');
        
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

            console.log('Desplegar modal: modalCapturaCamara:', { codInfoFacturaVenta: cod_info_factura_venta_global, codTercero: cod_tercero_global, codNotaObservacion: cod_nota_observacion });   
            $('#cod_info_factura_venta_modal_captura_imagenes').val(cod_info_factura_venta_global);
            $('#cod_tercero_modal_captura_imagenes').val(cod_tercero_global);
            $('#cod_tipo_metodo_aprobacion_modal_captura_imagenes').val(cod_tipo_metodo_aprobacion);
            $('#cod_nota_observacion_modal_captura_imagenes').val(cod_nota_observacion);
        }, 500);
    } catch (error) {
        console.error('Error al abrir modal:', error);
        alert('Error al abrir el modal de cámara');
    }
}
// Función para inicializar la cámara
async function inicializarCamara() {
    window.video = document.getElementById('videoCamera');
    window.canvas = document.getElementById('canvasCapture');
    
    // Verificar si el navegador soporta acceso a la cámara
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.error('El navegador no soporta acceso a la cámara');
        alert('Su navegador no soporta acceso a la cámara. Use un navegador más reciente.');
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
                    console.log('✅ Autoenfoque continuo activado');
                } catch (focusError) {
                    console.warn('⚠️ No se pudo activar autoenfoque continuo:', focusError);
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
                    //console.error('❌ Error al reproducir video:', playError);
                    alert('Error al inicializar la vista de la cámara.');
                });
            };
        }
        
    } catch (error) {
        console.error('❌ Error al acceder a la cámara:', error);
        // FALLBACK: Intentar con configuración de calidad media
        try {
            console.log('Intentando con calidad media...');
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
                        alert('Error al inicializar la vista de la cámara.');
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
            alert(mensaje);
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
        console.error('❌ Error al activar/desactivar linterna:', error);
        alert('No se pudo activar la linterna en este dispositivo.');
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
        
        // Cargar notas dinámicamente cuando se muestra modalListaCapturaImagenes
        if (event.target.id === 'modalListaCapturaImagenes') {
            // Verificar si ya se cargaron las notas para esta sesión del modal
            if (!event.target.dataset.notasCargadas) {
                console.log('Bootstrap 5 - Modal modalListaCapturaImagenes mostrado por primera vez, ejecutando cargarNotasModalDinamicamente...');
                event.target.dataset.notasCargadas = 'true';
                setTimeout(() => {
                    cargarNotasModalDinamicamente();
                }, 100);
            } else {
                console.log('Bootstrap 5 - Modal modalListaCapturaImagenes ya tiene notas cargadas, saltando cargarNotasModalDinamicamente');
            }
        }
    });

    // Compatibilidad con jQuery/Bootstrap 4 para modalListaCapturaImagenes
    $(document).on('shown.bs.modal', '#modalListaCapturaImagenes', function() {
        // Verificar si ya se cargaron las notas para esta sesión del modal
        if (!$(this).data('notas-cargadas')) {
            //console.log('jQuery/Bootstrap 4 - Modal modalListaCapturaImagenes mostrado por primera vez, ejecutando cargarNotasModalDinamicamente...');
            $(this).data('notas-cargadas', true);
            setTimeout(() => {
                cargarNotasModalDinamicamente();
            }, 100);
        } else {
            //console.log('jQuery/Bootstrap 4 - Modal modalListaCapturaImagenes ya tiene notas cargadas, saltando cargarNotasModalDinamicamente');
        }
    });

    // Limpiar bandera cuando se cierre el modal para permitir recarga en próxima apertura
    document.addEventListener('hidden.bs.modal', function(event) {
        if (event.target.id === 'modalListaCapturaImagenes') {
            console.log('🗑️ Modal modalListaCapturaImagenes cerrado, limpiando bandera de notas cargadas');
            delete event.target.dataset.notasCargadas;
        }
    });

    // Compatibilidad jQuery para limpiar bandera
    $(document).on('hidden.bs.modal', '#modalListaCapturaImagenes', function() {
        //console.log('Modal modalListaCapturaImagenes cerrado (jQuery), limpiando bandera de notas cargadas');
        $(this).removeData('notas-cargadas');
    });
    //console.log('✅ Event listeners configurados para modalListaCapturaImagenes');
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
            //console.log('Cerrando modalListaCapturaImagenes desde btnCancelarModalCaptura');
            // Compatibilidad Bootstrap 4 y 5
            if (typeof $ !== 'undefined' && $.fn.modal) {
                // Bootstrap 4 con jQuery
                $('#modalListaCapturaImagenes').modal('hide');
                //console.log('Modal cerrado usando jQuery/Bootstrap 4');
            } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                // Bootstrap 5
                const modalListaCapturaImagenes = document.getElementById('modalListaCapturaImagenes');
                if (modalListaCapturaImagenes) {
                    try {
                        // Intentar getInstance si existe (Bootstrap 5.1+)
                        const modal = bootstrap.Modal.getInstance ? 
                                     bootstrap.Modal.getInstance(modalListaCapturaImagenes) || new bootstrap.Modal(modalListaCapturaImagenes) :
                                     new bootstrap.Modal(modalListaCapturaImagenes);
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
                alert('Por favor, ingrese el motivo del rechazo.');
                document.getElementById('textareaMotivoRechazo').focus();
                return;
            }
            
            // Validar que tengamos el código de factura
            if (!codInfoFacturaVenta || codInfoFacturaVenta === '') {
                alert('Error: No se encontró el código de factura.');
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
                        
                        // Mostrar mensaje de éxito
                        alert('' + (response.message || 'Solicitud rechazada correctamente.'));
                        
                        // Recargar la lista de solicitudes
                        if (typeof load !== 'undefined') {
                            load(1);
                        } else {
                            location.reload();
                        }
                    } else {
                        alert('Error: ' + (response.message || 'No se pudo rechazar la solicitud.'));
                        // Rehabilitar botón
                        btnConfirmarRechazo.disabled = false;
                        btnConfirmarRechazo.textContent = 'Rechazar';
                    }
                },
                error: function(xhr, status, error) {
                     alert('Error al procesar el rechazo. Por favor, intente nuevamente.');
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
                console.log('🔄 Modal de aprobación abierto - Revalidando selección');
                validarSeleccionMetodoAprobacion();
            });
            // Compatibilidad con jQuery Bootstrap
            $(modalMetodoAprobacion).on('shown.bs.modal', function() {
                //console.log('🔄 Modal de aprobación abierto (jQuery) - Revalidando selección');
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
        alert('La cámara no está lista');
        window._isCapturing = false;
        if (btn) btn.disabled = false;
        return;
    }
    console.log("Tomar foto");
    const context = canvas.getContext('2d');
    
    // Obtener el marco de captura
    const captureFrame = document.querySelector('.capture-frame');
    
    if (!captureFrame) {
        alert('No se encontró el marco de captura');
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
    // Convertir a blob para enviar al servidor
    canvas.toBlob(async (blob) => {
        try {
            // Crear FormData para enviar la imagen
            const formData = new FormData();
            var cod_info_factura_venta = $('#cod_info_factura_venta_modal_captura_imagenes').val();
            var cod_tercero = $('#cod_tercero_modal_captura_imagenes').val();
            var cod_tipo_metodo_aprobacion = $('#cod_tipo_metodo_aprobacion_modal_captura_imagenes').val();
            var cod_nota_observacion = $('#cod_nota_observacion_modal_captura_imagenes').val();

            formData.append('cod_info_factura_venta', cod_info_factura_venta);
            formData.append('cod_tercero', cod_tercero);
            formData.append('cod_tipo_metodo_aprobacion', cod_tipo_metodo_aprobacion);
            formData.append('cod_nota_observacion', cod_nota_observacion);
            formData.append('url_img1', blob, `foto_${cod_info_factura_venta}_${cod_tercero}_${cod_nota_observacion}_${cod_tipo_metodo_aprobacion}_${Date.now()}.jpg`);
            // Enviar imagen al servidor
            const response = await fetch('../admin/guardar_foto_camara_ajax.php', {
                method: 'POST',
                body: formData
            });
            
            // Verificar si la respuesta es válida
            if (!response.ok) {
                throw new Error(`HTTP Error: ${response.status} ${response.statusText}`);
            }
            
            // Obtener el texto de la respuesta primero para depuración
            const responseText = await response.text();
            //console.log('Respuesta del servidor:', responseText);
            
            // Intentar parsear como JSON
            let result;
            try {
                result = JSON.parse(responseText);
            } catch (parseError) {
                console.error('Error al parsear JSON:', parseError);
                console.error('Respuesta recibida:', responseText);
                throw new Error('La respuesta del servidor no es JSON válido: ' + responseText.substring(0, 100));
            }
            
            if (result.success) {
                //console.log('Foto guardada exitosamente:', result.filename);
                
                // Cerrar modal de cámara
                cerrarModalCamara();
                
                // Mostrar previsualización en el modal de captura
                mostrarPrevisualizacion(result.url, result.cod_info_factura_venta, result.cod_nota_observacion, result.cod_tercero);
                
            } else {
                alert('Error al guardar la foto: ' + result.message);
            }
            
        } catch (error) {
            console.error('Error al capturar la foto:', error);
            alert('Error al capturar la foto. Inténtalo de nuevo.');
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
        //console.log('Mostrando previsualización para cod_nota_observacion:', cod_nota_observacion);
        
        if (!cod_nota_observacion) {
            console.error('cod_nota_observacion no especificado');
            return;
        }
        
        // Buscar el span correspondiente
        const previsualizar_foto_tomada = document.getElementById(`foto_tomada_${cod_nota_observacion}`);
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
                btnActivarCamara.innerHTML = '<i class="fas fa-check me-2"></i>Foto Capturada';
                
                //console.log('Botón de cámara deshabilitado exitosamente para:', cod_nota_observacion);
            } else {
                console.warn('No se encontró el botón de activar cámara para:', cod_nota_observacion);
            }
            //console.log('✅ Previsualización mostrada correctamente. Modal modalListaCapturaImagenes ya está abierto, no es necesario volver a abrirlo.');
        } else {
            console.error('Span foto_tomada no encontrado para:', cod_nota_observacion);
        }
    } catch (error) {
        console.error('Error al mostrar previsualización:', error);
    }
}

// Función para cargar notas dinámicamente en modalListaCapturaImagenes
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
            const container = document.querySelector('#modalListaCapturaImagenes .modal-body #mostrar_datos_ajax_obtener_nota_observacion_modal');
            //console.log('🎯 Contenedor encontrado:', container ? 'SÍ' : 'NO');
            if (container) {
                container.innerHTML = html;
                //console.log('Lista de imagenes cargada');
            } else {
                console.error('No se encontró el contenedor .row.g-3 dentro del modalListaCapturaImagenes');
            }
        })
        .catch(error => {
            console.error('Error al cargar las notas:', error);

            // Mostrar mensaje de error en el modal
            const container = document.querySelector('#modalListaCapturaImagenes .modal-body .row.g-3');
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
    // Obtener valores desde data-attributes
    var codInfo = $(this).attr('data-cod_info_factura_venta') || '';
    var codTercero = $(this).attr('data-cod_tercero') || '';
    console.log('Desplegar modal: modalProcesarOtrasImagenes:', { codInfoFacturaVenta: codInfo, codTercero: codTercero });   
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
    console.log('Modal cerrado, limpiando contenido...');
    $('#mostrar_datos_ajax_obtener_nota_observacion_modal_otras_imagenes').html('');
});


// Delegación de eventos para botones dinámicos
document.addEventListener('click', function(event) {
    // Manejar clics en botones de eliminar foto
    if (event.target.classList.contains('btn_cancelar_foto') || 
        event.target.closest('.btn_cancelar_foto')) {
        
        const button = event.target.classList.contains('btn_cancelar_foto') ? 
                      event.target : event.target.closest('.btn_cancelar_foto');
        
        const buttonId = button.id;
        if (buttonId && buttonId.startsWith('btn_borrar_foto_tomada_')) {
            const codNotaObservacion = buttonId.replace('btn_borrar_foto_tomada_', '');
            eliminarFotoTomada(codNotaObservacion);
        }
    }
    
    // Manejar clics en botones de activar cámara dinámicos
    if (event.target.classList.contains('btn_activar_camara') || 
        event.target.closest('.btn_activar_camara')) {
        
        const button = event.target.classList.contains('btn_activar_camara') ? 
                      event.target : event.target.closest('.btn_activar_camara');
        
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
    
    if (!confirm('¿Está seguro de que desea eliminar esta foto?')) {
        return;
    }
    
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
       // console.log('Respuesta del servidor:', data);
        
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
                btnActivarCamara.innerHTML = '<i class="fas fa-camera me-2"></i>Cámara';
            }
            
            alert('Foto eliminada exitosamente');
        } else {
            alert('Error al eliminar la foto: ' + (data.message || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error al eliminar foto:', error);
        alert('Error al eliminar la foto: ' + error.message);
    });
}

</script>