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
$pagina                                                      = $concatenador."lista_producto.php";
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
     	$aColumns = array('tbl15_tercero.nombre1_tercero', 'tbl15_tercero.identificacion_tercero'); //Columnas de busqueda
	} else {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('tbl15_tercero.nombre1_tercero', 'tbl15_tercero.identificacion_tercero'); //Columnas de busqueda
	}
}
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
$nombre_estado_factura                       = "CERRADA";
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
    if($action == 'ajax') {
// escaping, additionally removing everything that could be (html/javascript-) code
     $sTable = "tbl15_tercero RIGHT JOIN tbl15_info_factura_venta ON tbl15_tercero.cod_tercero = tbl15_info_factura_venta.cod_tercero ";

     $sWhere = " WHERE (tbl15_info_factura_venta.cod_administrador = '$cod_administrador') AND (nombre_estado_factura = '$nombre_estado_factura')";
    if ( $_GET['busqueda_ajax'] != "" ) {
        $sWhere = " WHERE (tbl15_info_factura_venta.cod_administrador = '$cod_administrador') AND (nombre_estado_factura = '$nombre_estado_factura') AND ( ";
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
    $reload                      = '../admin/lista_cliente_siscredito_visitante_intern.php';
    //loop through fetched data

    if ($cantidad_registros>0) { ?>
        <div id="eliminar_ok" style="display:none;">&nbsp;</div>

        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Ver</th>
                                    <th style="text-align:center;">Nombres / Producto</th>
                                    <th style="text-align:center;">Entidad</th>
                                    <th style="text-align:center;">Total Deuda</th>
                                    <th style="text-align:center;">Cuota</th>
                                    <th style="text-align:center;">Operador Credito</th>
                                    <th style="text-align:center;">Telefono / Correo / Direccion</th>
                                    <th style="text-align:center;">ID</th>
                                </tr>
                            </thead>
                          	<tbody>
<?php
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

$calcular_datos_cuenta_cobrar = "SELECT tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, tbl15_info_factura_venta.nombre_tipo_cobro, 
tbl15_info_factura_venta.cod_tercero, tbl15_info_factura_venta.monto_deuda, tbl15_info_factura_venta.monto_cuota, tbl15_info_factura_venta.cod_entidad_crediticia, 
tbl15_info_factura_venta.nombre_estado_factura, tbl15_info_factura_venta.cod_resolucion_facturacion, tbl15_info_factura_venta.cod_operador_credito,
tbl15_info_factura_venta.nombre1_tercero, tbl15_info_factura_venta.nombre2_tercero, tbl15_info_factura_venta.apellido1_tercero, tbl15_info_factura_venta.apellido2_tercero, 
tbl15_info_factura_venta.identificacion_tercero, tbl15_info_factura_venta.direccion_tercero, tbl15_info_factura_venta.telefono1_tercero, tbl15_info_factura_venta.correo_tercero
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
	$cod_entidad_crediticia                                         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
	$cod_operador_credito                                           = $datos_cuenta_cobrar['cod_operador_credito'];

    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];

    if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; $url_imprimir = '#'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; $url_imprimir = '../admin/venta_productos_opcion_imprimir_siscredito_visitante_intern.php?cod_info_factura_venta='.$cod_info_factura_venta; }

    $sql_venta_producto_temporal = "SELECT cod_producto_barra, nombre_producto, serial1_producto, serial2_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
    $serial1_producto                                               = $datos_venta_producto_temporal['serial1_producto'];
    $serial2_producto                                               = $datos_venta_producto_temporal['serial2_producto'];

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

    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
    $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

    $nombre_estado_revision                                         = $datos_estado_revision['nombre_estado_revision'];

    $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito);
    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

    $nombre_operador_credito                                         = $datos_operador_credito['nombre_operador_credito'];

    if ($codigo_estado_revision == '0') { // 0 POR CARGAR
        $previsualizar_soporte = '';
        $url_estado_soporte = '<a href="../admin/soporte_por_cargar_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
    } 
    elseif ($codigo_estado_revision == '1') { // 1 POR REVISAR
        $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
        $url_estado_soporte = '<a href="../admin/soporte_por_revisar_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
    } 
    elseif ($codigo_estado_revision == '2') { // 2 ACEPTADO
        $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
        $url_estado_soporte = '<a href="#">'.$nombre_estado_revision.'</a>';
    }
    else { // 3 RECHAZADO
        $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
        $url_estado_soporte = '<a href="../admin/soporte_rechazado_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
	$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	$nombre_tipo_factura                           = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];

?>
		                        <tr>
		                            <td style="text-align:center;"><a href="../admin/lista_soportes_camara_o_documento_info_factura_venta_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>&nombre_estado_factura=<?php echo $nombre_estado_factura; ?>&pagina=<?php echo $pagina; ?>"><i class="fa fa-file-image fa-2x"></i></a></td>
		                            <td style="text-align:center;" class="name-pr"><?php echo $nombres_apellidos ?> | <?php echo $identificacion_tercero ?><br>(<?php echo $nombre_producto ?> - <?php echo $cod_producto_barra ?> <br> IMEI1: <?php echo $serial1_producto ?><br> IMEI2: <?php echo $serial2_producto ?>)</td>
		                            <td style="text-align:center;" class="name-pr"><?php echo $nombre_entidad_crediticia ?></td>
		                            <td style="text-align:right;" class="total-pr"><?php echo number_format($monto_deuda, 0, ",", ".") ?></td>
		                            <td style="text-align:center;" class="name-pr"><?php echo number_format($monto_cuota, 0, ",", ".") ?><br><?php echo $nombre_tipo_cobro ?></td>
		                            <td style="text-align:center;" class="name-pr"><?php echo $nombre_operador_credito ?></td>
		                            <td style="text-align:center;" class="name-pr"><?php echo $telefono1_tercero ?> <br> <?php echo $correo_tercero ?> <br> <?php echo $direccion_tercero ?></td>
		                            <td style="text-align:center;" class="name-pr"><?php echo $cod_info_factura_venta ?></td>
		                        </tr>
<?php } ?>
			                </tbody>
			            </table>

				        <div class="col-lg-12 col-md-12 col-sm-12">
				            <div class="contact-form-center">
				                <div class="row p-3 mb-2 bg-primary text-white">
				                    <div class="col-md-12">
				                        <div style="text-align:center;" class="pull-center"><?php echo paginador_ajax($reload, $page, $total_pages, $adjacents);?></div>
				                    </div>
				                </div>
				            </div>
				        </div>

	                </div>
	            </div>
	        </div>
        </div>
            <?php } else { ?> 
            <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php    
        }
    }
?>