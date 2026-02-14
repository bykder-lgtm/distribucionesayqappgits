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
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina_complt                                               = $_SERVER['PHP_SELF'];
$fragm                                                       = explode("/", $pagina_complt);
$ultimo                                                      = end($fragm);
$total_elementos                                             = count($fragm) - 1;
$concatenador                                                = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina                                                      = $concatenador."lista_siscredito_tercero_crear_nuevo_credito.php";
//---------------------------------------------------------------------------------------------------------------------------------//
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
    $numero_registro_por_pagina      = 999999;
    $tabla                           = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
	if (isset($_REQUEST['nombre_tipo_tercero'])) { $nombre_tipo_tercero = addslashes($_REQUEST['nombre_tipo_tercero']); } else { $nombre_tipo_tercero = 'CLIENTE'; }
}
if($busqueda_ajax <> NULL) {
	if($buscar_por == 'nombre_producto') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('nombre_producto'); //Columnas de busqueda
	} elseif ($buscar_por == 'cod_producto_barra') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('cod_producto_barra'); //Columnas de busqueda
	} elseif ($buscar_por == 'cod_producto_barra2') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('cod_producto_barra2'); //Columnas de busqueda
	} elseif ($buscar_por == 'cod_producto_barra_nombre_producto') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('cod_producto_barra', 'nombre_producto'); //Columnas de busqueda
	} elseif ($buscar_por == 'nombre1_tercero') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('nombre1_tercero', 'nombre2_tercero', 'apellido1_tercero', 'apellido2_tercero'); //Columnas de busqueda
	} elseif ($buscar_por == 'identificacion_tercero') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('identificacion_tercero'); //Columnas de busqueda
	} else {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('cod_producto_barra', 'nombre_producto'); //Columnas de busqueda
	}
}
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
    if($busqueda_ajax <> '') {
        $sTable = "tbl15_tercero";

        $sWhere = "WHERE ((nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'TODO'))";
        if ($_GET['busqueda_ajax'] != "") {
            $sWhere = " WHERE ((nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'TODO')) AND (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
                $sWhere .= $aColumns[$i]." LIKE '$busq_aprox_der".$busqueda_ajax."$busq_aprox_izq' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
include_once('../ajax/pagination.php'); //include pagination file

    //pagination variables
    $page                        = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page                    = 10; //how much records you want to show
    $adjacents                   = 4; //gap between pages after number of adjacents
    $registro_inicio             = 999999;
    //$sql_conteo                  = "SELECT count(*) AS cantidad_registros FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'TODO') OR (nombre_tipo_tercero = 'CLIENTE') OR MATCH (identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero) AGAINST ('$busqueda_ajax')";
    $sql_conteo                  = "SELECT count(*) AS cantidad_registros FROM tbl15_tercero $sWhere";
    $consulta_conteo             = mysqli_query($conectar, $sql_conteo);
    $datos_conteo                = mysqli_fetch_array($consulta_conteo);
    $cantidad_registros          = $datos_conteo['cantidad_registros'];
    $total_pages                 = ceil($cantidad_registros/$per_page);
    $reload                      = '../admin/lista_siscredito_tercero_crear_nuevo_credito.php';
    //loop through fetched data
    //if ($cantidad_registros>0) { 
    ?>
    <table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th style="text-align:center">Tipo</th>
            <th style="text-align:center">T.Doc</th>
            <th style="text-align:center">Documento</th>
            <th style="text-align:center">Nombre</th>
            <th style="text-align:center">Direccion</th>
            <th style="text-align:center">Telefono</th>
            <th style="text-align:center">Ciudad</th>
            <th style="text-align:center">Subalt</th>
            <th style="text-align:center">Cod</th>
            <?php if ($cod_estado_tercero_editar == '1') { ?><th style="text-align:center">Edit</th><?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php
    //$sql_consulta = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'TODO') OR (nombre_tipo_tercero = 'CLIENTE') OR MATCH (identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero) AGAINST ('$busqueda_ajax')";
    $sql_consulta = "SELECT * FROM tbl15_tercero $sWhere";
    $query_consulta = mysqli_query($conectar, $sql_consulta);
    while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

        $cod_tercero                   = $datos_consulta['cod_tercero'];
        $nombre_tipo_tercero           = $datos_consulta['nombre_tipo_tercero'];
        $nombre_tipo_identificacion    = $datos_consulta['nombre_tipo_identificacion'];
        $identificacion_tercero        = $datos_consulta['identificacion_tercero'];
        $digito_tercero                = $datos_consulta['digito_tercero'];
        $nombre1_tercero               = $datos_consulta['nombre1_tercero'];
        $nombre2_tercero               = $datos_consulta['nombre2_tercero'];
        $apellido1_tercero             = $datos_consulta['apellido1_tercero'];
        $apellido2_tercero             = $datos_consulta['apellido2_tercero'];
        $direccion_tercero             = $datos_consulta['direccion_tercero'];
        $telefono1_tercero             = $datos_consulta['telefono1_tercero'];
        $telefono2_tercero             = $datos_consulta['telefono2_tercero'];
        $correo_tercero                = $datos_consulta['correo_tercero'];
        $nombre_pais                   = $datos_consulta['nombre_pais'];
        $nombre_departamento           = $datos_consulta['nombre_departamento'];
        $nombre_ciudad                 = $datos_consulta['nombre_ciudad'];
        $nombre_tipo_cliente           = $datos_consulta['nombre_tipo_cliente'];
        $nombre_tipo_regimen           = $datos_consulta['nombre_tipo_regimen'];
        $nombre_tipo_impuesto          = $datos_consulta['nombre_tipo_impuesto'];
        $contacto_tercero              = $datos_consulta['contacto_tercero'];
        $fax_tercero                   = $datos_consulta['fax_tercero'];
        $cod_administrador             = $datos_consulta['cod_administrador'];

        $sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
        $resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
        $info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
            
        $cedula                        = $info_usuario_admin['cedula'];
        $nombres                       = $info_usuario_admin['nombres'];
        $apellidos                     = $info_usuario_admin['apellidos'];
        $cuenta                        = $info_usuario_admin['cuenta'];
        $usuario                       = $nombres.' '.$apellidos.' | '.$cuenta;
        $nombre_subalterno_concat      = '';
/*
        $sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (cod_lider = '$cod_tercero')";
        $query_tercero = mysqli_query($conectar, $sql_tercero);
        while ($datos_tercero = mysqli_fetch_array($query_tercero)) {

            $nombre1_tercero               = $datos_tercero['nombre1_tercero'];
            $nombre2_tercero               = $datos_tercero['nombre2_tercero'];
            $apellido1_tercero             = $datos_tercero['apellido1_tercero'];
            $apellido2_tercero             = $datos_tercero['apellido2_tercero'];
            $identificacion_tercero        = $datos_tercero['identificacion_tercero'];
            $nombre_subalterno_concat     .= trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero.' - '.$identificacion_tercero.'<br>');
        }
*/
    ?>
        <tr class="even pointer">
            <td style="text-align:center"><?php echo $nombre_tipo_tercero?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero?></td>
            <td style="text-align:left"><a href="../admin/reg_siscredito_tercero_crear_nuevo_credito.php?cod_tercero=<?php echo $cod_tercero?>&pagina=<?php echo $pagina ?>"><?php echo trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero) ?></a></td>
            <td style="text-align:left"><?php echo $direccion_tercero?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero?></td>
            <td style="text-align:center"><?php echo $nombre_ciudad?></td>
            <td style="text-align:left"><?php echo $nombre_subalterno_concat?></td>
            <td style="text-align:center"><?php echo $cod_tercero?></td>
            <?php if ($cod_estado_tercero_editar == '1') { ?>
            <td style="text-align:center"><a href="../admin/edit_siscredito_tercero.php?cod_tercero=<?php echo $cod_tercero?>&nombre_tipo_tercero=<?php echo $nombre_tipo_tercero ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
            <?php } ?>
        </tr>
    <?php } ?>
    </table>
<?php } ?>