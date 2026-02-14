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
}
if($busqueda_ajax <> NULL) {
	if($buscar_por == 'nombre1_tercero') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('nombre1_tercero'); //Columnas de busqueda
	} elseif ($buscar_por == 'identificacion_tercero') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('identificacion_tercero'); //Columnas de busqueda
	} elseif ($buscar_por == 'nombre1_tercero_identificacion_tercero') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('nombre1_tercero', 'identificacion_tercero'); //Columnas de busqueda
	} else {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('nombre1_tercero', 'identificacion_tercero'); //Columnas de busqueda
	}
}
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
    if($action == 'ajax') {
// escaping, additionally removing everything that could be (html/javascript-) code
     $sTable = "tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero ";

     $sWhere = " WHERE (tbl15_cuentas_cobrar.cod_administrador = '$cod_administrador') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0')";
    if ( $_GET['busqueda_ajax'] != "" ) {
        $sWhere = " WHERE (tbl15_cuentas_cobrar.cod_administrador = '$cod_administrador') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') AND ( ";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            $sWhere .= $aColumns[$i]." LIKE '$busq_aprox_der".$busqueda_ajax."$busq_aprox_izq' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
if ($_GET['busqueda_ajax'] == "") {
    $sWhere.=" GROUP BY tbl15_cuentas_cobrar.cod_tercero ORDER BY tbl15_tercero.nombre1_tercero";
} else {
    $sWhere.=" GROUP BY tbl15_cuentas_cobrar.cod_tercero ORDER BY tbl15_tercero.nombre1_tercero";
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
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form-right">
                        <div class="row p-3 mb-2 bg-primary text-white">
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Ver</div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align:center;" class="">Nombres</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Total Deuda</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Total Abonado</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Total Pendiente</div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align:center;" class="">Direccion</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Telefono</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">ID</div>
                            </div>
                        </div>
<?php
$cod_cliente                              = 0;
$conteo                                   = 0;
$total_venta                              = 0;
$incre                                    = 0;
$smtr_iva_valor                           = 0;

$tab                                      = 'tbl15_cuentas_cobrar';
$tab2                                     = 'tbl15_cuentas_cobrar_archivar_por_tercero';
$campo                                    = 'cod_tercero';
$tipo                                     = 'eliminar';
$total_monto_deuda_sum                    = 0;
$total_abonado_sum                        = 0;
$total_subtotal_sum                       = 0;
$fecha_hoy                                = date("Y-m-d");

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, tbl15_cuentas_cobrar.cod_tercero, 
Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero FROM $sTable $sWhere LIMIT $registro_inicio, $numero_registro_por_pagina";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

		$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
		$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
		$subtotal                      = $datos_cuenta_cobrar['subtotal'];
		$abonado                       = $datos_cuenta_cobrar['abonado'];
		$cod_tercero                   = $datos_cuenta_cobrar['cod_tercero'];
		$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
		$nombres_apellidos             = trim($datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero']);
		$direccion_tercero             = $datos_cuenta_cobrar['direccion_tercero'];
		$telefono1_tercero             = $datos_cuenta_cobrar['telefono1_tercero'];
		$nombre_ciudad                 = $datos_cuenta_cobrar['nombre_ciudad'];
		$identificacion_tercero        = $datos_cuenta_cobrar['identificacion_tercero'];

		$total_monto_deuda_sum        += $monto_deuda;
		$total_abonado_sum            += $abonado;
		$total_subtotal_sum           += $subtotal;
?>
                        <div class="row">
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><a href="../admin/cuentas_cobrar_detalle_factura_visitante_intern.php?cod_tercero=<?php echo $cod_tercero; ?>"><img src="../imagenes/ver.png"></a></div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align:center;" class=""><a href="../admin/cuentas_cobrar_detalle_factura_visitante_intern.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $nombres_apellidos ?> | <?php echo $identificacion_tercero ?></a></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo number_format($monto_deuda, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo number_format($abonado, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo number_format($subtotal, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align:center;" class=""><?php echo $direccion_tercero ?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $telefono1_tercero ?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $cod_tercero ?></div>
                            </div>
                        </div>
                        <hr>
<?php } ?>
                    </div>

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