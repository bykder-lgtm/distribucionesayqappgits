<?php
header('Content-Type: text/html; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
if (verificar_usuario()) { } else { header("Location:../index.php"); }

$cod_administrador = $_SESSION['cod_administrador'];
include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_habilitar_tercero_por_usuario_global = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];

$pagina_local = "";
$pagina_complt = $_SERVER['PHP_SELF'];
$fragm = explode("/", $pagina_complt);
$ultimo = end($fragm);
$total_elementos = count($fragm) - 1;
$concatenador = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element . "/"; } }

$pagina = $concatenador . "lista_info_factura_venta_revisor_diseno_vertical.php";

if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {
    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = '';
        $condicional_consulta_tercero_rel = '';
        $condicional_consulta_cuenta_cobrar = '';
    } else {
        $condicional_consulta_tercero = " AND (tbl15_tercero.cod_administrador = '$cod_administrador')";
        $condicional_consulta_tercero_rel = " AND (tbl15_tercero_rel.cod_administrador = '$cod_administrador')";
        $condicional_consulta_cuenta_cobrar = " AND (tbl15_info_factura_venta.cod_administrador = '$cod_administrador')";
    }
} else {
    $condicional_consulta_tercero = '';
    $condicional_consulta_tercero_rel = '';
    $condicional_consulta_cuenta_cobrar = '';
}

$cuenta_actual = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);

$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; }
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5] . $frag1[6]; }
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7]; }
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7] . $frag1[8]; }
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7] . $frag1[8] . $frag1[9]; }
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7] . $frag1[8] . $frag1[9] . $frag1[10]; }
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7] . $frag1[8] . $frag1[9] . $frag1[10] . $frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7] . $frag1[8] . $frag1[9] . $frag1[10] . $frag1[11] . $frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5] . $frag1[6] . $frag1[7] . $frag1[8] . $frag1[9] . $frag1[10] . $frag1[11] . $frag1[12] . $frag1[13]; }

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
    $busqueda_ajax = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
    $buscar_por = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));
    $numero_registro_por_pagina = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['numero_registro_por_pagina'], ENT_QUOTES)));
    $cod_administrador = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['cod_administrador'], ENT_QUOTES)));
    $cod_seguridad = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['cod_seguridad'], ENT_QUOTES)));
    $tabla = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
    $nombre_estado_factura = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['nombre_estado_factura'], ENT_QUOTES)));
    $pagina = mysqli_real_escape_string($conectar, (strip_tags($_REQUEST['pagina'], ENT_QUOTES)));
}

if ($busqueda_ajax <> NULL) {
    if ($buscar_por == 'nombre1_tercero') {
        $aColumns = array('tbl15_tercero.nombres_apellidos_tercero');
    } elseif ($buscar_por == 'identificacion_tercero') {
        $aColumns = array('tbl15_tercero.identificacion_tercero');
    } elseif ($buscar_por == 'nombre1_tercero_identificacion_tercero') {
        $aColumns = array('tbl15_tercero.nombres_apellidos_tercero', 'tbl15_tercero.identificacion_tercero', 'tbl15_entidad_crediticia.nombre_entidad_crediticia');
    } else {
        $aColumns = array('tbl15_tercero.nombres_apellidos_tercero', 'tbl15_tercero.identificacion_tercero', 'tbl15_entidad_crediticia.nombre_entidad_crediticia');
    }
}

$nombre_estado_factura = "ABIERTA";

if ($action == 'ajax') {
    $sTable = "tbl15_tercero RIGHT JOIN tbl15_info_factura_venta ON tbl15_tercero.cod_tercero = tbl15_info_factura_venta.cod_tercero LEFT JOIN tbl15_entidad_crediticia ON tbl15_info_factura_venta.cod_entidad_crediticia = tbl15_entidad_crediticia.cod_entidad_crediticia";
    $sWhere = " WHERE (tbl15_info_factura_venta.cod_administrador_revisor = '$cod_administrador')";

    if ($_GET['busqueda_ajax'] != "") {
        $sWhere = " WHERE (tbl15_info_factura_venta.cod_administrador_revisor = '$cod_administrador') AND ( ";
        for ($i = 0; $i < count($aColumns); $i++) { $sWhere .= $aColumns[$i] . " LIKE '%" . $busqueda_ajax . "%' OR "; }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    if ($_GET['busqueda_ajax'] == "") { $sWhere .= " ORDER BY tbl15_info_factura_venta.fecha_modificacion DESC"; } else { $sWhere .= " ORDER BY tbl15_info_factura_venta.fecha_modificacion DESC"; }

    include_once('../admin/paginacion_ajax_buscador_sistecredito.php');
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 10;
    $adjacents = 4;
    $registro_inicio = ($page - 1) * $per_page;

    $sql_cantidad_registros = "SELECT count(*) AS cantidad_registros FROM $sTable $sWhere";
    $consulta_cantidad_registros = mysqli_query($conectar, $sql_cantidad_registros) or die(mysqli_error($conectar));
    $datos_cantidad_registros = mysqli_fetch_array($consulta_cantidad_registros);
    $cantidad_registros = $datos_cantidad_registros['cantidad_registros'];
    $total_pages = ceil($cantidad_registros / $per_page);
    $reload = '../admin/lista_info_factura_venta_revisor_diseno_vertical.php';

    if ($cantidad_registros > 0) {
        ?>
        <table class="table table-striped table-hover jambo_table bulk_action" id="tablaFacturasRevisor">
            <thead>
                <tr class="headings">
                    <th style="text-align:center" class="column-title">ID</th>
                    <th style="text-align:center" class="column-title">Fecha</th>
                    <th style="text-align:center" class="column-title">Aliado</th>
                    <th style="text-align:center" class="column-title">Cliente</th>
                    <th style="text-align:center" class="column-title">Identificación</th>
                    <th style="text-align:center" class="column-title">Valor de Contado</th>
                    <th style="text-align:center" class="column-title">Valor a Credito</th>
                    <th style="text-align:center" class="column-title">Porcentaje</th>
                    <th style="text-align:center" class="column-title">Linea de Credito</th>
                    <th style="text-align:center" class="column-title">Operador del Credito</th>
                    <th style="text-align:center" class="column-title">Banco</th>
                    <th style="text-align:center" class="column-title">Cuenta</th>
                    <th style="text-align:center" class="column-title">Estado</th>
                    <th style="text-align:center" class="column-title">Comprobante</th>
                    <th style="text-align:center" class="column-title">Notif</th>
                    <th style="text-align:center" class="column-title">Valid</th>

                </tr>
                <tr class="filtros-tabla">
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="ID" data-column="0" style="width:7px; min-width:30px; font-size:1.2rem; padding:0.1rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Fecha" data-column="1" style="width:10px; min-width:90px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Aliado" data-column="2" style="width:100%; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Cliente" data-column="3" style="width:100%; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Identificación" data-column="4" style="width:100%; min-width:110px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Contado" data-column="5" style="width:100%; min-width:100px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Crédito" data-column="6" style="width:100%; min-width:100px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="%" data-column="7" style="width:100%; min-width:70px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Línea"  data-column="8" style="width:20px; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Operador" data-column="9" style="width:100%; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Banco" data-column="10" style="width:100%; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Cuenta" data-column="11" style="width:100%; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"><input type="text" class="form-control filtro-input" placeholder="Estado" data-column="12" style="width:100%; min-width:120px; font-size:1.2rem; padding:0.5rem;"></th>
                    <th style="text-align:center"></th>
                    <th style="text-align:center"></th>
                    <th style="text-align:center"></th>
                </tr>
            </thead>
            <tbody>
                <?php
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
    tbl15_info_factura_venta.numero_cuota, 
    tbl15_info_factura_venta.cod_estado_dilig_todo, tbl15_info_factura_venta.cod_estado_dilig_infocliente, tbl15_info_factura_venta.cod_estado_dilig_infoproducto, 
    tbl15_info_factura_venta.cod_estado_dilig_infocreditval, tbl15_info_factura_venta.cod_estado_dilig_infoequipogest, tbl15_info_factura_venta.cod_estado_dilig_infocomercial, 
    tbl15_info_factura_venta.cod_estado_dilig_infodocumentfoto, tbl15_info_factura_venta.fecha_ymdhis,
    tbl15_info_factura_venta.url_img_orig_producto
    FROM $sTable $sWhere LIMIT $registro_inicio, $numero_registro_por_pagina";
                $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
                while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

                    $cod_info_factura_venta                    = $datos_cuenta_cobrar['cod_info_factura_venta'];
                    $monto_deuda_sin_interes                   = $datos_cuenta_cobrar['monto_deuda_sin_interes'];
                    $monto_deuda                               = $datos_cuenta_cobrar['monto_deuda'];
                    $monto_cuota                               = $datos_cuenta_cobrar['monto_cuota'];
                    $cod_tercero                               = $datos_cuenta_cobrar['cod_tercero'];
                    $cod_factura                               = $datos_cuenta_cobrar['cod_factura'];
                    $nombres_apellidos                         = trim($datos_cuenta_cobrar['nombre1_tercero'] . " " . $datos_cuenta_cobrar['nombre2_tercero'] . " " . $datos_cuenta_cobrar['apellido1_tercero'] . " " . $datos_cuenta_cobrar['apellido2_tercero']);
                    $direccion_tercero                         = $datos_cuenta_cobrar['direccion_tercero'];
                    $telefono1_tercero                         = $datos_cuenta_cobrar['telefono1_tercero'];
                    $identificacion_tercero                    = $datos_cuenta_cobrar['identificacion_tercero'];
                    $nombre_tipo_cobro                         = $datos_cuenta_cobrar['nombre_tipo_cobro'];
                    $correo_tercero                            = $datos_cuenta_cobrar['correo_tercero'];
                    $nombre_estado_factura                     = $datos_cuenta_cobrar['nombre_estado_factura'];
                    $cod_resolucion_facturacion                = $datos_cuenta_cobrar['cod_resolucion_facturacion'];
                    $cod_estado_factura                        = $datos_cuenta_cobrar['cod_estado_factura'];
                    $fecha_creacion                            = $datos_cuenta_cobrar['fecha_creacion'];
                    $cod_administrador_factura                 = $datos_cuenta_cobrar['cod_administrador'];
                    $cod_tipo_pago                             = $datos_cuenta_cobrar['cod_tipo_pago'];
                    $cod_tipo_forma_pago                       = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
                    $cod_entidad_crediticia                    = $datos_cuenta_cobrar['cod_entidad_crediticia'];
                    $cod_tienda                                = $datos_cuenta_cobrar['cod_tienda'];
                    $cod_operador_credito                      = $datos_cuenta_cobrar['cod_operador_credito'];
                    $cod_tipo_forma_pago_operador_credito      = $datos_cuenta_cobrar['cod_tipo_forma_pago_operador_credito'];
                    $cod_administrador_lider                   = $datos_cuenta_cobrar['cod_administrador_lider'];
                    $cod_administrador_coordinador             = $datos_cuenta_cobrar['cod_administrador_coordinador'];
                    $cod_administrador_asesor                  = $datos_cuenta_cobrar['cod_administrador_asesor'];
                    $cod_administrador_aliado_estrategico      = $datos_cuenta_cobrar['cod_administrador_aliado_estrategico'];
                    $cod_administrador_revisor                 = $datos_cuenta_cobrar['cod_administrador_revisor'];
                    $cod_vendedor                              = $datos_cuenta_cobrar['cod_vendedor'];
                    $cod_banco_cuenta                          = $datos_cuenta_cobrar['cod_banco_cuenta'];
                    $observacion_tercero                       = $datos_cuenta_cobrar['observacion_tercero'];
                    $cod_estado_facturacion                    = $datos_cuenta_cobrar['cod_estado_facturacion'];
                    $codigo_estado_facturacion                 = $datos_cuenta_cobrar['codigo_estado_facturacion'];
                    $codigo_tipo_estado_cargue_documentacion   = $datos_cuenta_cobrar['codigo_tipo_estado_cargue_documentacion'];
                    $numero_cuota                              = $datos_cuenta_cobrar['numero_cuota'];
                    $cod_estado_dilig_todo                     = $datos_cuenta_cobrar['cod_estado_dilig_todo'];
                    $cod_estado_dilig_infocliente              = $datos_cuenta_cobrar['cod_estado_dilig_infocliente'];
                    $cod_estado_dilig_infoproducto             = $datos_cuenta_cobrar['cod_estado_dilig_infoproducto'];
                    $cod_estado_dilig_infocreditval            = $datos_cuenta_cobrar['cod_estado_dilig_infocreditval'];
                    $cod_estado_dilig_infoequipogest           = $datos_cuenta_cobrar['cod_estado_dilig_infoequipogest'];
                    $cod_estado_dilig_infocomercial            = $datos_cuenta_cobrar['cod_estado_dilig_infocomercial'];
                    $cod_estado_dilig_infodocumentfoto         = $datos_cuenta_cobrar['cod_estado_dilig_infodocumentfoto'];
                    $fecha_ymdhis                              = $datos_cuenta_cobrar['fecha_ymdhis'];
                    $url_comprobante_pago                      = $datos_cuenta_cobrar['url_img_orig_producto'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_administrador_lider = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_lider')";
                    $consulta_administrador_lider = mysqli_query($conectar, $sql_administrador_lider) or die(mysqli_error($conectar));
                    $datos_administrador_lider = mysqli_fetch_assoc($consulta_administrador_lider);

                    $nombres_apellidos_lider = $datos_administrador_lider['nombres'] . ' ' . $datos_administrador_lider['apellidos'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_administrador_coordinador = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_coordinador')";
                    $consulta_administrador_coordinador = mysqli_query($conectar, $sql_administrador_coordinador) or die(mysqli_error($conectar));
                    $datos_administrador_coordinador = mysqli_fetch_assoc($consulta_administrador_coordinador);

                    $nombres_apellidos_coordinador = $datos_administrador_coordinador['nombres'] . ' ' . $datos_administrador_coordinador['apellidos'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_administrador_asesor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_asesor')";
                    $consulta_administrador_asesor = mysqli_query($conectar, $sql_administrador_asesor) or die(mysqli_error($conectar));
                    $datos_administrador_asesor = mysqli_fetch_assoc($consulta_administrador_asesor);

                    $nombres_apellidos_asesor = $datos_administrador_asesor['nombres'] . ' ' . $datos_administrador_asesor['apellidos'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    // Obtener nombre del administrador (aliado)
                    $sql_administrador_aliado_estrategico = "SELECT nombres, apellidos, nombres_apellidos_tercero FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_aliado_estrategico')";
                    $consulta_administrador_aliado_estrategico = mysqli_query($conectar, $sql_administrador_aliado_estrategico) or die(mysqli_error($conectar));
                    $datos_administrador_aliado_estrategico = mysqli_fetch_assoc($consulta_administrador_aliado_estrategico);

                    /*
                    $sql_aliado = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_factura'";
                    $consulta_aliado = mysqli_query($conectar, $sql_aliado);
                    $datos_aliado = mysqli_fetch_assoc($consulta_aliado);
                    $existe_aliado = mysqli_num_rows($consulta_aliado);
                    if ($existe_aliado > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }
                    */
                    $nombres_apellidos_aliado_estrategico = $datos_administrador_aliado_estrategico['nombres_apellidos_tercero'].' ('.$datos_administrador_aliado_estrategico['nombres'].' '.$datos_administrador_aliado_estrategico['apellidos'].')';
                    $nombre_aliado = trim($nombres_apellidos_aliado_estrategico) ?: "No especificado";
                    //$nombre_aliado                                                = trim($datos_aliado['nombre1_tercero'].$separador_texto.$datos_aliado['apellido1_tercero']) ?: "No especificado";
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_administrador_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
                    $consulta_administrador_revisor = mysqli_query($conectar, $sql_administrador_revisor) or die(mysqli_error($conectar));
                    $datos_administrador_revisor = mysqli_fetch_assoc($consulta_administrador_revisor);

                    $nombres_apellidos_revisor = $datos_administrador_revisor['nombres'] . ' ' . $datos_administrador_revisor['apellidos'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
                    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
                    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

                    $nombre_entidad_crediticia = $datos_entidad_crediticia['nombre_entidad_crediticia'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
                    $consulta_tienda = mysqli_query($conectar, $sql_tienda);
                    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);
                    $existe_tienda = mysqli_num_rows($consulta_tienda);
                    if ($existe_tienda > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

                    $nombre_tienda = $datos_tienda['nombre_tienda'] ?: "No especificada";
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
                    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
                    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

                    $nombre_operador_credito = $datos_operador_credito['nombre_operador_credito'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
                    $consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
                    $datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);
                    $existe_banco_cuenta = mysqli_num_rows($consulta_banco_cuenta);
                    if ($existe_banco_cuenta > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

                    $nombre_banco_cuenta = $datos_banco_cuenta['nombre_banco_cuenta'] ?: "No especificado";
                    $numero_banco_cuenta = $datos_banco_cuenta['numero_banco_cuenta'] ?: "No especificado";
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    // Consultar vendedor desde tbl15_administrador (cod_seguridad = '2')
                    $sql_vendedor = "SELECT nombres_apellidos_tercero, identificacion_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_vendedor' AND cod_seguridad = '2'";
                    $consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
                    $datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);
                    $existe_vendedor = mysqli_num_rows($consulta_vendedor);
                    if ($existe_vendedor > 0) { $separador_texto = ' '; } else { $separador_texto = ''; }

                    $nombre_vendedor = $datos_vendedor['nombres_apellidos_tercero'] ?: "No especificado";
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
                    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
                    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);
                    $existe_tipo_pago = mysqli_num_rows($consulta_tipo_pago);
                    if ($existe_tipo_pago > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

                    $nombre_tipo_pago = $datos_tipo_pago['nombre_tipo_pago'] ?: "No especificado";
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
                    $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
                    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);
                    $existe_tipo_forma_pago = mysqli_num_rows($consulta_tipo_forma_pago);
                    if ($existe_tipo_forma_pago > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

                    $nombre_tipo_forma_pago = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_tipo_forma_pago_operador_credito = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_operador_credito')";
                    $consulta_tipo_forma_pago_operador_credito = mysqli_query($conectar, $sql_tipo_forma_pago_operador_credito) or die(mysqli_error($conectar));
                    $datos_tipo_forma_pago_operador_credito = mysqli_fetch_assoc($consulta_tipo_forma_pago_operador_credito);
                    $existe_tipo_forma_pago_operador_credito = mysqli_num_rows($consulta_tipo_forma_pago_operador_credito);
                    if ($existe_tipo_forma_pago_operador_credito > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

                    $nombre_tipo_forma_pago_operador_credito = $datos_tipo_forma_pago_operador_credito['nombre_tipo_forma_pago'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $sql_estado_facturacion = "SELECT * FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$codigo_estado_facturacion')";
                    $consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion) or die(mysqli_error($conectar));
                    $datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

                    $nombre_estado_facturacion = $datos_estado_facturacion['nombre_estado_facturacion'];
                    $estilo_css_estado_factura = $datos_estado_facturacion['color_fondo_celda_estado'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_nota_observacion DESC";
                    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
                    $matriz_consulta = mysqli_fetch_assoc($consulta);

                    $cod_nota_observacion = $matriz_consulta['cod_nota_observacion'];
                    $nombre_nota_observacion = $matriz_consulta['nombre_nota_observacion'];
                    $fecha_ymd = $matriz_consulta['fecha_ymd'];
                    $fecha_hora = $matriz_consulta['fecha_hora'];
                    $cuenta = $matriz_consulta['cuenta'];
                    $url_img_orig_producto = $matriz_consulta['url_img_orig_producto'];
                    $url_img_min_producto = $matriz_consulta['url_img_min_producto'];
                    $cod_posicion = $matriz_consulta['cod_posicion'];
                    $active = $matriz_consulta['active'];
                    $codigo_estado_revision = $matriz_consulta['codigo_estado_revision'];
                    //---------------------------------------------------------------------------------------------------------------------------------//
                    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
                    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
                    $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

                    $nombre_estado_revision = $datos_estado_revision['nombre_estado_revision'];
                    //---------------------------------------------------------------------------------------------------------------------------------//
                    $obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
                    $resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
                    $info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

                    $nombre_tipo_factura = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
                    //---------------------------------------------------------------------------------------------------------------------------------//
                    $obtener_nota_observacion_cedula_en_mano = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO DEL CLIENTE CON CEDULA EN MANO')";
                    $resultado_nota_observacion_cedula_en_mano = mysqli_query($conectar, $obtener_nota_observacion_cedula_en_mano) or die(mysqli_error($conectar));
                    $info_nota_observacion_cedula_en_mano = mysqli_fetch_assoc($resultado_nota_observacion_cedula_en_mano);

                    $url_img_min_producto_cedula_en_mano = $info_nota_observacion_cedula_en_mano['url_img_min_producto'];
                    //---------------------------------------------------------------------------------------------------------------------------------//
                    $obtener_nota_observacion_prod_const_entrega = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO CON EL PRODUCTO COMO CONSTANCIA DE ENTREGA')";
                    $resultado_nota_observacion_prod_const_entrega = mysqli_query($conectar, $obtener_nota_observacion_prod_const_entrega) or die(mysqli_error($conectar));
                    $info_nota_observacion_prod_const_entrega = mysqli_fetch_assoc($resultado_nota_observacion_prod_const_entrega);

                    $url_img_min_producto_prod_const_entrega = $info_nota_observacion_prod_const_entrega['url_img_min_producto'];
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    if ($nombre_estado_factura == 'ABIERTA') {
                        $tabla_productos_venta = 'tbl15_venta_producto_temporal';
                    } else {
                        $tabla_productos_venta = 'tbl15_venta_producto';
                    }
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $contanenar_nombre_producto = "";
                    $sql_productos_en_venta = "SELECT cod_producto, cod_producto_barra, nombre_producto, serial1_producto, serial2_producto, cod_categoria 
                    FROM $tabla_productos_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
                    $consulta_productos_en_venta = mysqli_query($conectar, $sql_productos_en_venta) or die(mysqli_error($conectar));
                    $existe_varios_productos_en_venta = mysqli_num_rows($consulta_productos_en_venta);
                    if ($existe_varios_productos_en_venta > '1') { $separador_br = '<br>'; } else { $separador_br = ''; }
                    while ($datos_productos_en_venta = mysqli_fetch_assoc($consulta_productos_en_venta)) {

                        $cod_producto = $datos_productos_en_venta['cod_producto'];
                        $cod_producto_barra = $datos_productos_en_venta['cod_producto_barra'];
                        $nombre_producto = $datos_productos_en_venta['nombre_producto'];
                        $cod_categoria = $datos_productos_en_venta['cod_categoria'];
                        $serial1_producto = $datos_productos_en_venta['serial1_producto'];
                        $serial2_producto = $datos_productos_en_venta['serial2_producto'];

                        $sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria'";
                        $consulta_categoria = mysqli_query($conectar, $sql_categoria);
                        $datos_categoria = mysqli_fetch_assoc($consulta_categoria);

                        $nombre_categoria = trim($datos_categoria['nombre_categoria']) ?: "No especificado";

                        if ($cod_categoria == '2') { //Celulares
                            $contanenar_nombre_producto .= $nombre_producto . ' | Categoria: ' . $nombre_categoria . ' [ Imei1: ' . $serial1_producto . ' - Imei2: ' . $serial2_producto . ' ] ' . $separador_br;
                        } else {
                            $contanenar_nombre_producto .= $nombre_producto . ' | CATEGORIA: ' . $nombre_categoria . $separador_br;
                        }
                    }
                    /* ----------------------------------------------------------------------------------------------------------/ */
                    $porcentaje_interes_ganancia                  = (($monto_deuda - $monto_deuda_sin_interes) / $monto_deuda_sin_interes) * 100;
                    $porcentaje_interes_ganancia                  = round($porcentaje_interes_ganancia, 2);
                    $fecha_formateada                             = date('M d, Y', strtotime($fecha_ymdhis));
                    $hora_formateada                              = date('h:i A', strtotime($fecha_ymdhis));
                    ?>
                    <tr>
                        <td style="text-align:center; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                        )'><?php echo $cod_info_factura_venta; ?></td>
                        <td style="text-align:center; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'><?php echo $fecha_creacion; ?></td>
                        <td style="text-align:left; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'><?php echo $nombre_aliado; ?></td>
                        <td style="text-align:left; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'><?php echo $nombres_apellidos; ?></td>
                        <td style="text-align:center; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'><?php echo $identificacion_tercero; ?></td>
                        <td style="text-align:right">$<?php echo number_format($monto_deuda_sin_interes, 0, ",", "."); ?></td>
                        <td style="text-align:right; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'>$<?php echo number_format($monto_deuda, 0, ",", "."); ?></td>
                        <td style="text-align:center"><?php echo $porcentaje_interes_ganancia; ?>%</td>
                        <td style="text-align:center; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'><?php echo $nombre_entidad_crediticia; ?></td>
                        <td style="text-align:center; cursor:pointer; color: #81e6d9;" onclick='abrirModalDetalleCredito(
                        <?php echo json_encode($cod_estado_dilig_todo); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocliente); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoproducto); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocreditval); ?>,
                        <?php echo json_encode($cod_estado_dilig_infoequipogest); ?>,
                        <?php echo json_encode($cod_estado_dilig_infocomercial); ?>,
                        <?php echo json_encode($cod_estado_dilig_infodocumentfoto); ?>,
                        <?php echo json_encode($nombre_estado_factura); ?>,
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
                        <?php echo json_encode($numero_cuota); ?>,
                        <?php echo json_encode($nombres_apellidos_lider); ?>,
                        <?php echo json_encode($nombres_apellidos_coordinador); ?>,
                        <?php echo json_encode($nombres_apellidos_aliado_estrategico); ?>,
                        <?php echo json_encode($nombres_apellidos_revisor); ?>,
                        <?php echo json_encode($cod_administrador_lider); ?>,
                        <?php echo json_encode($cod_administrador_coordinador); ?>,
                        <?php echo json_encode($cod_administrador_asesor); ?>,
                        <?php echo json_encode($cod_administrador_aliado_estrategico); ?>,
                        <?php echo json_encode($cod_administrador_revisor); ?>,
                        <?php echo json_encode($cod_operador_credito); ?>,
                        <?php echo json_encode($direccion_tercero); ?>,
                        <?php echo json_encode($telefono1_tercero); ?>,
                        <?php echo json_encode($correo_tercero); ?>
                    )'><?php echo $nombre_operador_credito; ?></td>
                        <td style="text-align:center"><?php echo $nombre_banco_cuenta; ?></td>
                        <td style="text-align:center"><?php echo $numero_banco_cuenta; ?></td>
                        <!--<td style="text-align:center"><span class="badge" style="background-color: <?php echo ($nombre_tipo_pago == 'CONTADO') ? '#28a745' : '#007bff'; ?>;"><?php echo $nombre_tipo_pago; ?></span></td>-->
                        <!--<td style="text-align:center; cursor:pointer;" id="validar_datos_estado_facturacion" onclick="abrirModalValidarDatos('<?php echo $cod_info_factura_venta; ?>', '<?php echo $codigo_estado_facturacion; ?>')">Validar</td>-->
                        <td style="text-align:center; cursor:pointer;"><span class="badge" style="background-color: <?php echo $estilo_css_estado_factura; ?>;"><?php echo $nombre_estado_facturacion; ?></span> </td>
                        <!--<td style="text-align:center; cursor:pointer;" onclick='verificarEstadoYAbrirModal(<?php echo json_encode($cod_info_factura_venta); ?>, <?php echo json_encode($codigo_estado_facturacion); ?>, <?php echo json_encode($cod_tercero); ?>, <?php echo json_encode($nombres_apellidos); ?>, <?php echo json_encode($codigo_tipo_estado_cargue_documentacion); ?>)'><span class="badge" style="background-color: <?php echo $estilo_css_estado_factura; ?>;"><?php echo $nombre_estado_facturacion; ?></span></td>-->
                        <!--<td style="text-align:center; cursor:pointer;" onclick='verificarEstadoYAbrirModal(<?php echo json_encode($cod_info_factura_venta); ?>, <?php echo json_encode($codigo_estado_facturacion); ?>, <?php echo json_encode($cod_tercero); ?>, <?php echo json_encode($nombres_apellidos); ?>, <?php echo json_encode($codigo_tipo_estado_cargue_documentacion); ?>, <?php echo json_encode("multiple_seleccion"); ?>)'><span class="badge" style="background-color: <?php echo $estilo_css_estado_factura; ?>;"><?php echo $nombre_estado_facturacion; ?></span></td>-->
                        <td style="text-align:center; cursor:pointer;" title="<?php echo ($url_comprobante_pago != '') ? 'Comprobante cargado - Clic para ver/reemplazar' : 'Sin comprobante - Clic para cargar'; ?>" onclick="abrirModalComprobanteRevisor('<?php echo $cod_info_factura_venta; ?>')">
                            <?php if ($url_comprobante_pago != ''): ?>
                                <i class="fa fa-check-circle" id="iconoComprobante_<?php echo $cod_info_factura_venta; ?>" style="font-size:22px; color:#10b981; text-shadow: 0 0 6px rgba(16,185,129,0.6);"></i>
                            <?php else: ?>
                                <i class="fa fa-file-image-o" id="iconoComprobante_<?php echo $cod_info_factura_venta; ?>" style="font-size:22px; color:#FFD700; text-shadow: 0 0 5px rgba(255,215,0,0.5);"></i>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:center; cursor:pointer;" id="crear_nueva_notificacion" onclick="abrirModalCrearNotificacion('<?php echo $cod_info_factura_venta; ?>', 'tabla')"><i class="fa fa-bell" style="font-size:20px; color:#1E90FF;"></i></td>
                        <?php if ($nombre_estado_factura == 'CERRADA' || $nombre_estado_factura == 'CARRADA'): ?>
                        <td style="text-align:center; cursor:not-allowed; opacity:0.5;" id="validar_datos_revisor" title="No se puede validar una factura cerrada"><i class="fa fa-check-circle" style="font-size:20px; color:#999;"></i></td>
                        <?php else: ?>
                        <td style="text-align:center; cursor:pointer;" id="validar_datos_revisor" onclick='verificarEstadoYAbrirModal(<?php echo json_encode($cod_info_factura_venta); ?>, <?php echo json_encode($codigo_estado_facturacion); ?>, <?php echo json_encode($cod_tercero); ?>, <?php echo json_encode($nombres_apellidos); ?>, <?php echo json_encode($codigo_tipo_estado_cargue_documentacion); ?>, <?php echo json_encode("unica_seleccion"); ?>)'><i class="fa fa-check-circle" style="font-size:20px; color:#32CD32;"></i></td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo paginador_ajax($reload, $page, $total_pages, $adjacents);
    } else { ?>
        <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php
    }
}
?>
<!-- Modal Detalle de Crédito -->
<div class="modal fade" id="modalDetalleCreditoRevisor" tabindex="-1" aria-labelledby="modalDetalleCreditoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado oscuro -->
                <div class="modal-header"
                    style="background: #0E112B; color: white; border-bottom: none; padding: 2rem;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                        style="color: white; opacity: 1; font-size: 2rem;">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4 style="font-weight: 700; font-size: 2.2rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            Detalles del Crédito - Revisor [<div id="modal_cod_info_factura_venta"></div>]
                        </h4>
                    </div>
                </div>

                <!-- Sección: Información del Cliente -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-user"
                                style="font-size: 1.5rem;"></i> Información del Cliente</span>
                        <!-- Switch Checkbox Llamativo -->
                        <div class="switch-container"
                            style="position: relative; display: inline-block; width: 60px; height: 30px;">
                            <input type="checkbox" id="cod_estado_dilig_infocliente" style="opacity: 0; width: 0; height: 0;">
                            <label for="cod_estado_dilig_infocliente" class="switch-slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ff6b6b, #ee5a52); transition: all 0.4s ease; border-radius: 30px; box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);">
                                <span style="position: absolute; content: ''; height: 22px; width: 22px; left: 4px; bottom: 4px; background-color: white; transition: all 0.4s ease; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-id-card" style="color: #0E112B; font-size: 1.2rem;"></i> Nombre del Cliente</p>
                                <p class="detalle-value" id="modalNombreCliente" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-id-card" style="color: #0E112B; font-size: 1.2rem;"></i> Identificación</p>
                                <p class="detalle-value" id="modalCedulaCliente" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-phone" style="color: #0E112B; font-size: 1.2rem;"></i> Teléfono</p>
                                <p class="detalle-value" id="modalClienteTelefono" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-envelope" style="color: #0E112B; font-size: 1.2rem;"></i> Correo Electrónico</p>
                                <p class="detalle-value" id="modalClienteCorreo" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-map-marker" style="color: #0E112B; font-size: 1.2rem;"></i> Dirección</p>
                                <p class="detalle-value" id="modalClienteDireccion" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="text-align: center; margin-top: 1.5rem;">
                            <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border: none; border-radius: 8px; font-weight: 600; transition: all 0.2s ease;"
                                onclick="abrirModalEditarInfoCliente()"
                                onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Editar Información del cliente</button>
                        </div>
                    </div>
                </div>

                <!-- Sección: Información del Producto -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-box" style="font-size: 1.5rem;"></i> Información del Producto</span>
                        <!-- Switch Checkbox Llamativo -->
                        <div class="switch-container"
                            style="position: relative; display: inline-block; width: 60px; height: 30px;">
                            <input type="checkbox" id="cod_estado_dilig_infoproducto" style="opacity: 0; width: 0; height: 0;">
                            <label for="cod_estado_dilig_infoproducto" class="switch-slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ff6b6b, #ee5a52); transition: all 0.4s ease; border-radius: 30px; box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);">
                                <span style="position: absolute; content: ''; height: 22px; width: 22px; left: 4px; bottom: 4px; background-color: white; transition: all 0.4s ease; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                            </label>
                        </div>
                    </div>

                    <div class="detalle-info-box"
                        style="text-align: center; background: #0E112B15; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <p class="detalle-label" style="justify-content: center; color: #2d3748; font-weight: 600; margin: 0; font-size: 1.3rem;">
                                <i class="fa fa-shopping-bag" style="color: #0E112B; font-size: 1.3rem;"></i> Producto</p>
                        </div>
                        <p class="detalle-value-large" id="modalNombreProducto" style="font-size: 1.4rem; color: #2d3748; font-weight: 700;"></p>
                    </div>
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border: none; border-radius: 8px; font-weight: 600; transition: all 0.2s ease;"
                            onclick="abrirModalEditarProducto()" onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                            onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                            <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Editar Producto</button>
                    </div>

                    <div class="row">
                        <div class="section-divider-detalle"
                            style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i
                                    class="fa fa-credit-card" style="font-size: 1.5rem;"></i> Información del Crédito</span>
                            <!-- Switch Checkbox Llamativo -->
                            <div class="switch-container" style="position: relative; display: inline-block; width: 60px; height: 30px;">
                                <input type="checkbox" id="cod_estado_dilig_infocreditval" style="opacity: 0; width: 0; height: 0;">
                                <label for="cod_estado_dilig_infocreditval" class="switch-slider" style=" position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ff6b6b, #ee5a52); transition: all 0.4s ease; border-radius: 30px; box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);">
                                    <span style="position: absolute; content: ''; height: 22px; width: 22px; left: 4px; bottom: 4px; background-color: white; transition: all 0.4s ease; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;"><i
                                            class="fa fa-credit-card" style="color: #0E112B; font-size: 1.2rem;"></i> Valor a Crédito</p>
                                    <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalEditarValorCredito()" onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Editar</button>
                                </div>
                                <p class="detalle-value-large" style="color: #48bb78; font-size: 1.6rem; font-weight: 700; margin: 0;">$<span id="modalValorCredito"></span></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;"><i
                                            class="fa fa-money" style="color: #0E112B; font-size: 1.2rem;"></i> Valor de Contado</p>
                                    <button type="button" class="btn btn-sm"
                                        style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalEditarValorContado()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Editar
                                    </button>
                                </div>
                                <p class="detalle-value-large" style="color: #81e6d9; font-size: 1.6rem; font-weight: 700; margin: 0;">$<span id="modalTotalPrecioVenta"></span></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;"><i class="fa fa-calendar-check-o"
                                            style="color: #0E112B; font-size: 1.2rem;"></i> Número de Cuotas</p>
                                    <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalEditarNumeroCuotas()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit"
                                            style="margin-right: 0.3rem; color: white !important;"></i> Editar
                                    </button>
                                </div>
                                <p class="detalle-value-large" style="color: #f59e0b; font-size: 1.6rem; font-weight: 700; margin: 0;"><span id="modalNumeroCuotas"></span></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;"><i
                                            class="fa fa-calculator" style="color: #0E112B; font-size: 1.2rem;"></i> Cuota Mensual</p>
                                    <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalEditarCuotaMensual()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Editar
                                    </button>
                                </div>
                                <p class="detalle-value-large" style="color: #4a5568; font-size: 1.6rem; font-weight: 700; margin: 0;">$<span id="modalMontoCuota"></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-shopping-cart" style="color: #0E112B; font-size: 1.2rem;"></i> Tipo de Venta
                                </p>
                                <p class="detalle-value" id="modalTipoVenta" style="color: #4a5568; font-size: 1.3rem;">
                                </p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-bank" style="color: #0E112B; font-size: 1.2rem;"></i> Línea de Crédito
                                </p>
                                <p class="detalle-value" id="modal_entidad_crediticia" style="color: #4a5568; font-size: 1.3rem;"></p>
                            </div>
                        </div>


                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-credit-card" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Operador del Crédito
                                    </p>
                                    <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalCambiarOperadorCredito()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar</button>
                                </div>
                                <p class="detalle-value" id="modalOperadorCredito" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>


                    </div>

                    <!-- Botón Editar Línea de Crédito y Valores -->
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <button type="button" id="btnEditarEntidadCrediticia"
                            onclick="abrirModalCambiarEntidadCrediticia(document.getElementById('modalIDApp').textContent, document.getElementById('modalCodEntidadCrediticia').value)"
                            class="btn-detalle-action"
                            style="background: #0E112B; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border: none; border-radius: 8px; font-weight: 600; transition: all 0.2s ease;">
                            <i class="fa fa-edit" style="color: white !important; margin-right: 0.5rem;"></i> Editar linea de credito y valores
                        </button>
                    </div>
                </div>

                <!-- Sección: Equipo de Gestión -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-users"
                                style="font-size: 1.5rem;"></i> Equipo de Gestión</span>
                        <!-- Switch Checkbox Llamativo -->
                        <div class="switch-container" style="position: relative; display: inline-block; width: 60px; height: 30px;">
                            <input type="checkbox" id="cod_estado_dilig_infoequipogest" style="opacity: 0; width: 0; height: 0;">
                            <label for="cod_estado_dilig_infoequipogest" class="switch-slider"
                                style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ff6b6b, #ee5a52); transition: all 0.4s ease; border-radius: 30px; box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);">
                                <span style="position: absolute; content: ''; height: 22px; width: 22px; left: 4px; bottom: 4px; background-color: white; transition: all 0.4s ease; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-star" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Líder</p>
                                    <!--
                                <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;" onclick="abrirModalCambiarLider()" onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';" onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                    <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                </button>
                                -->
                                </div>
                                <p class="detalle-value" id="modalLider" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-sitemap" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Coordinador</p>
                                    <!--
                                <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;" onclick="abrirModalCambiarCoordinador()" onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';" onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                    <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                </button>
                                -->
                                </div>
                                <p class="detalle-value" id="modalCoordinador" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box"  style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-user-circle" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Asesor</p>
                                    <!--
                                <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;" onclick="abrirModalCambiarAsesor()" onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';" onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                    <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                </button>
                                -->
                                </div>
                                <p class="detalle-value" id="modalAsesor" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-handshake-o" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Aliado Estratégico</p>
                                    <!--
                                <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease; white-space: nowrap;" onclick="abrirModalCambiarAliadoEstrategico()" onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';" onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                    <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                </button>
                                -->
                                </div>
                                <p class="detalle-value" id="modalAliadoEstrategico" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-check-square-o" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Call Center</p>
                                    <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalCambiarRevisor()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                    </button>
                                </div>
                                <p class="detalle-value" id="modalRevisor" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección: Información Comercial -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle" style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-briefcase" style="font-size: 1.5rem;"></i> Información Comercial</span>
                        <!-- Switch Checkbox Llamativo -->
                        <div class="switch-container"
                            style="position: relative; display: inline-block; width: 60px; height: 30px;">
                            <input type="checkbox" id="cod_estado_dilig_infocomercial" style="opacity: 0; width: 0; height: 0;">
                            <label for="cod_estado_dilig_infocomercial" class="switch-slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ff6b6b, #ee5a52); transition: all 0.4s ease; border-radius: 30px; box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);">
                                <span style="position: absolute; content: ''; height: 22px; width: 22px; left: 4px; bottom: 4px; background-color: white; transition: all 0.4s ease; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-store" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Tienda</p>
                                    <button type="button" class="btn btn-sm"
                                        style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalCambiarTienda()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                    </button>
                                </div>
                                <p class="detalle-value" id="modalTienda"
                                    style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label"
                                        style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-user-tie" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i>Vendedor
                                    </p>
                                    <button type="button" class="btn btn-sm" style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalCambiarVendedor()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                    </button>
                                </div>
                                <p class="detalle-value" id="modalVendedor" style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label"
                                        style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;">
                                        <i class="fa fa-bank" style="color: #0E112B; font-size: 1.2rem; margin-right: 0.3rem;"></i> Cuenta de Banco
                                    </p>
                                    <button type="button" class="btn btn-sm"
                                        style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalCambiarBancoCuenta()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Cambiar
                                    </button>
                                </div>
                                <p class="detalle-value" id="modalBancoCuenta"
                                    style="color: #4a5568; font-size: 1.3rem; margin: 0;"></p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sección: Imágenes Adjuntas -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-camera"
                                style="font-size: 1.5rem;"></i> Documentación Fotográfica</span>
                        <!-- Switch Checkbox Llamativo -->
                        <div class="switch-container" style="position: relative; display: inline-block; width: 60px; height: 30px;">
                            <input type="checkbox" id="cod_estado_dilig_infodocumentfoto"
                                style="opacity: 0; width: 0; height: 0;">
                            <label for="cod_estado_dilig_infodocumentfoto" class="switch-slider"
                                style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ff6b6b, #ee5a52); transition: all 0.4s ease; border-radius: 30px; box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);">
                                <span
                                    style="position: absolute; content: ''; height: 22px; width: 22px; left: 4px; bottom: 4px; background-color: white; transition: all 0.4s ease; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                            </label>
                        </div>
                    </div>

                    <div id="contenedorTodasLasImagenes" class="row">
                        <div class="col-12 text-center" style="padding: 3rem;">
                            <i class="fa fa-spinner fa-spin" style="font-size: 3rem; color: #0E112B;"></i>
                            <p style="color: #718096; font-size: 1.2rem; margin-top: 1rem;">Cargando imágenes...</p>
                        </div>
                    </div>

                    <!-- Botón Aprobar Venta -->
                    <div class="row" id="contenedorBotonAprobarVenta" style="display: none; margin-top: 1.5rem;">
                        <div class="col-12">
                            <button type="button" class="btn btn-success btn-lg btn-block"
                                id="btnAprobarVentaDiligenciamiento"
                                style="font-size: 1.4rem; padding: 1rem 2.5rem; border-radius: 12px; box-shadow: 0 8px 16px rgba(72, 187, 120, 0.3); background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); border: none; transition: all 0.3s ease; width: 100%;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 20px rgba(72, 187, 120, 0.4)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 16px rgba(72, 187, 120, 0.3)';">
                                <i class="fa fa-check-circle" style="margin-right: 0.7rem;"></i>Aprobar Venta
                            </button>
                        </div>
                    </div>

                    <div class="row" id="contenedorBotonVerFacuraVenta" style="display: none; margin-top: 1.5rem;">
                        <div class="col-12">
                            <button type="button" class="btn btn-success btn-lg btn-block" id="btnVerFacuraVenta"
                                style="width: 100%;">Ver Factura de Venta</button>
                        </div>
                    </div>
                </div>

                <!-- Sección: Comprobante de Pago -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-receipt"
                                style="font-size: 1.5rem;"></i> Comprobante de Pago</span>
                    </div>

                    <div id="contenedorComprobantePago" style="padding: 1.5rem; background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px;">
                        <!-- Comprobante actual si existe -->
                        <div id="comprobanteActualRevisor" style="display: none; margin-bottom: 1.5rem;">
                            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); padding: 1.5rem; border-radius: 12px; text-align: center;">
                                <i class="fa fa-check-circle" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem; display: block;"></i>
                                <p style="color: #2d3748; margin: 0 0 1rem 0; font-size: 1.1rem; font-weight: 600;">Comprobante de pago registrado</p>
                                <a id="linkComprobanteActualRevisor" href="#" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 10px; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <i class="fa fa-eye"></i>
                                    Ver comprobante
                                </a>
                            </div>
                            <div style="height: 1px; background: rgba(14, 18, 43, 0.1); margin: 1.5rem 0;"></div>
                        </div>

                        <!-- Formulario para cargar nuevo comprobante -->
                        <input type="hidden" id="codCreditoComprobanteRevisor" value="">
                        <div style="margin-top: 0;">
                            <label style="display: block; color: #2d3748; font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">
                                <i class="fa fa-upload"></i> Cargar nuevo comprobante:
                            </label>
                            
                            <input type="file" id="inputComprobanteRevisor" accept="image/*,.pdf,.doc,.docx" style="display: none;" onchange="previsualizarComprobanteRevisor(this)">
                            <label for="inputComprobanteRevisor" style="display: block; cursor: pointer; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; text-align: center; padding: 1.5rem; border-radius: 12px; transition: all 0.3s ease; border: 2px dashed rgba(245, 158, 11, 0.5);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(245, 158, 11, 0.4)'; this.style.borderColor='rgba(245, 158, 11, 0.8)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='rgba(245, 158, 11, 0.5)'">
                                <i class="fa fa-cloud-upload-alt" style="font-size: 2.5rem; display: block; margin-bottom: 0.75rem;"></i>
                                <span style="font-weight: 600; font-size: 1.1rem; display: block;">Seleccionar archivo</span>
                                <span style="display: block; font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.9;">JPG, PNG, PDF, DOC, DOCX (Máx. 10MB)</span>
                            </label>

                            <!-- Preview del archivo -->
                            <div id="previewComprobanteRevisor" style="display: none; margin-top: 1.5rem;">
                                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); padding: 1.5rem; border-radius: 10px; text-align: center;">
                                    <i class="fa fa-file-alt" style="font-size: 2.5rem; color: #10b981; margin-bottom: 0.75rem;"></i>
                                    <p style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1rem;" id="nombreArchivoComprobanteRevisor"></p>
                                    <p style="color: #718096; font-size: 0.9rem; margin: 0;" id="tamanoArchivoComprobanteRevisor"></p>
                                </div>
                                <button type="button" onclick="cargarComprobanteRevisor()" style="width: 100%; margin-top: 1rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 1rem 1.5rem; border-radius: 10px; font-size: 1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <i class="fa fa-upload"></i> Cargar Comprobante
                                </button>
                                <button type="button" onclick="cancelarComprobanteRevisor()" style="width: 100%; margin-top: 0.5rem; background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.75rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                                    <i class="fa fa-times"></i> Cancelar
                                </button>
                            </div>
                            
                            <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 0.75rem; margin-top: 1rem;">
                                <div style="color: #2d3748; font-size: 0.85rem; line-height: 1.5;">
                                    <i class="fa fa-info-circle" style="color: #3b82f6; margin-right: 0.5rem;"></i>
                                    El comprobante es opcional y puede ser una imagen o documento que evidencie el pago realizado por el cliente.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección: Crear notificacion -->
                <div class="modal-body detalle-section">
                    <div class="row" style="text-align: center; margin-top: 1.5rem;">
                        <div class="col-12">
                            <button type="button" class="btn btn-sm"
                                style="background: #0E112B; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border: none; border-radius: 8px; font-weight: 600; transition: all 0.2s ease;"
                                onclick="abrirModalCrearNotificacion('', 'modal')"
                                onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                <i class="fa fa-plus-circle" style="margin-right: 0.3rem; color: white !important;"></i>Crear Nueva Notificación
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sección: Historial de Notificaciones -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-history"
                                style="font-size: 1.5rem;"></i> Historial de Notificaciones</span>
                    </div>

                    <div id="contenedorHistorialNotificaciones" style="margin-top: 1rem;">
                        <!-- Aquí se cargarán las notificaciones mediante AJAX -->
                        <div class="text-center" style="padding: 2rem;">
                            <i class="fa fa-spinner fa-spin" style="font-size: 2rem; color: #0E112B;"></i>
                            <p style="color: #718096; font-size: 1rem; margin-top: 1rem;">Cargando notificaciones...</p>
                        </div>
                    </div>
                </div>

                <!-- Sección: Información Adicional -->
                <div class="modal-body detalle-section">
                    <div class="section-divider-detalle"
                        style="margin: 1.5rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #0E112B;">
                        <span style="color: #0E112B; font-weight: 600; font-size: 1.5rem;"><i class="fa fa-info-circle" style="font-size: 1.5rem;"></i> Información Adicional</span>
                    </div>
                    <!--
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                            <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;"><i class="fa fa-user-tie" style="color: #0E112B; font-size: 1.2rem;"></i> Vendedor</p>
                            <p class="detalle-value" id="modalNombresApellidosVendedor" style="color: #4a5568; font-size: 1.3rem;"></p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="detalle-info-box" style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                            <p class="detalle-label" style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;"><i class="fa fa-university" style="color: #0E112B; font-size: 1.2rem;"></i> Cuenta de Banco</p>
                            <p class="detalle-value" id="modal_nombre_banco_cuenta" style="color: #4a5568; font-size: 1.3rem;"></p>
                        </div>
                    </div>
                </div>
-->
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <p class="detalle-label"
                                        style="color: #2d3748; font-weight: 600; margin: 0; font-size: 1.2rem;"><i
                                            class="fa fa-comment" style="color: #0E112B; font-size: 1.2rem;"></i>
                                        Observaciones</p>
                                    <button type="button" class="btn btn-sm"
                                        style="background: #0E112B; color: white !important; padding: 0.35rem 0.8rem; font-size: 0.95rem; border: none; border-radius: 4px; font-weight: 500; transition: all 0.2s ease;"
                                        onclick="abrirModalEditarObservacion()"
                                        onmouseover="this.style.background='#1a1f3a'; this.style.boxShadow='0 2px 4px rgba(14, 17, 43, 0.2)';"
                                        onmouseout="this.style.background='#0E112B'; this.style.boxShadow='none';">
                                        <i class="fa fa-edit" style="margin-right: 0.3rem; color: white !important;"></i> Editar
                                    </button>
                                </div>
                                <p class="detalle-value" id="modal_observacion_tercero"
                                    style="font-size: 1.2rem; font-weight: 400; color: #4a5568;"></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-hashtag" style="color: #0E112B; font-size: 1.2rem;"></i> ID Solicitud
                                </p>
                                <p class="detalle-value-large" id="modalIDApp" style="color: #0E112B; font-size: 1.6rem; font-weight: 700;"></p>
                            </div>
                        </div>



                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-calendar" style="color: #0E112B; font-size: 1.2rem;"></i> Fecha
                                </p>
                                <p class="detalle-value" id="modalFechaCreacion"
                                    style="color: #4a5568; font-size: 1.3rem;"></p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="detalle-info-box"
                                style="background: white; padding: 1rem; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 1rem;">
                                <p class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.2rem;">
                                    <i class="fa fa-clock-o" style="color: #0E112B; font-size: 1.2rem;"></i> Hora
                                </p>
                                <p class="detalle-value" id="modalHora" style="color: #4a5568; font-size: 1.3rem;"></p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 1.5rem; justify-content: center;">
                    <button type="button" id="btnCerrarModalDetalleCredito" class="btn" data-dismiss="modal"
                        aria-label="Cerrar"
                        style="background: #0E112B; color: white; padding: 1rem 3rem; font-size: 1.3rem; border-radius: 8px; border: none; font-weight: 600;">
                        <i class="fa fa-times-circle" style="font-size: 1.3rem;"></i> Cerrar
                    </button>
                </div>
                <!-- Campos ocultos para almacenar datos -->
                <input type="hidden" id="modalCodEntidadCrediticia" value="">
                <input type="hidden" id="modalCodVendedor" value="">
                <input type="hidden" id="modalCodBancoCuenta" value="">
                <input type="hidden" id="modalCodTienda" value="">
                <input type="hidden" id="modalCodOperadorCredito" value="">
                <input type="hidden" id="modalCodInfoFacturaVenta" value="">
                <input type="hidden" id="modalCodTercero" value="">
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Información del Cliente -->
<div class="modal fade" id="modalEditarInfoCliente" tabindex="-1" aria-labelledby="modalEditarInfoClienteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header -->
                <div class="modal-header modal-detalle-header" style="background: #0E112B; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                        style="color: white; opacity: 1;">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.2rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-user-circle" style="font-size: 2.2rem;"></i>
                            Editar Información del Cliente
                        </h4>
                    </div>
                </div>

                <!-- Body -->
                <div class="modal-body detalle-section">
                    <!-- Área de mensajes -->
                    <div id="mensajeEdicionCliente"
                        style="display: none; margin-bottom: 1.5rem; padding: 1rem; border-radius: 8px; font-size: 1.2rem; font-weight: 600; text-align: center;">
                        <i class="fa" style="margin-right: 0.5rem; font-size: 1.3rem;"></i>
                        <span id="textoMensajeEdicion"></span>
                    </div>

                    <input type="hidden" id="edit_cod_tercero" name="cod_tercero">
                    <input type="hidden" id="edit_cod_info_factura_venta" name="cod_info_factura_venta">

                    <!-- Identificación -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-id-card" style="color: #0E112B; font-size: 1.4rem;"></i>
                                    Identificación *
                                </label>
                                <input type="number" id="edit_identificacion_tercero" name="identificacion_tercero"
                                    class="form-control" required
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>
                    </div>

                    <!-- Nombres -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-user" style="color: #0E112B; font-size: 1.4rem;"></i> Primer Nombre
                                    *
                                </label>
                                <input type="text" id="edit_nombre1_tercero" name="nombre1_tercero" class="form-control"
                                    required
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-user" style="color: #0E112B; font-size: 1.4rem;"></i> Segundo Nombre
                                </label>
                                <input type="text" id="edit_nombre2_tercero" name="nombre2_tercero" class="form-control"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>
                    </div>

                    <!-- Apellidos -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-user" style="color: #0E112B; font-size: 1.4rem;"></i> Primer
                                    Apellido *
                                </label>
                                <input type="text" id="edit_apellido1_tercero" name="apellido1_tercero"
                                    class="form-control" required
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-user" style="color: #0E112B; font-size: 1.4rem;"></i> Segundo
                                    Apellido
                                </label>
                                <input type="text" id="edit_apellido2_tercero" name="apellido2_tercero"
                                    class="form-control"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>
                    </div>

                    <!-- Teléfono y Correo -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-phone" style="color: #0E112B; font-size: 1.4rem;"></i> Teléfono *
                                </label>
                                <input type="text" id="edit_telefono1_tercero" name="telefono1_tercero"
                                    class="form-control" required
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-envelope" style="color: #0E112B; font-size: 1.4rem;"></i> Correo
                                    Electrónico
                                </label>
                                <input type="email" id="edit_correo_tercero" name="correo_tercero" class="form-control"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px;">
                            </div>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-map-marker" style="color: #0E112B; font-size: 1.4rem;"></i>
                                    Dirección
                                </label>
                                <textarea id="edit_direccion_tercero" name="direccion_tercero" class="form-control"
                                    rows="3"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; min-height: 85px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" onclick="regresarAlModalAnterior()"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" id="btnGuardarInfoCliente" onclick="guardarInfoCliente()"
                        class="btn-detalle-action"
                        style="background: #0E112B; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-save" style="font-size: 1.4rem; color: white !important;"></i> Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Imagen -->
<div class="modal fade" id="modalCambiarImagen" tabindex="-1" aria-labelledby="modalCambiarImagenLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <div class="modal-header modal-detalle-header" style="background: #0E112B; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <i class="fa fa-image" style="font-size: 1.8rem;"></i>
                            Cambiar Imagen
                        </h4>
                    </div>
                </div>

                <div class="modal-body detalle-section">
                    <!-- Área de alertas -->
                    <div id="alertaCambiarImagen" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.2rem; padding: 1rem;"></div>

                    <!-- Campo oculto para el código de nota -->
                    <input type="hidden" id="cambiar_cod_nota" value="">

                    <!-- Previsualización de imagen actual -->
                    <div class="detalle-info-box" style="text-align: center; margin-bottom: 1.5rem;">
                        <p class="detalle-label"
                            style="font-size: 1.1rem; color: #2d3748 !important; margin-bottom: 0.75rem;">
                            <i class="fa fa-eye" style="font-size: 1.1rem; color: #0E112B;"></i> Imagen Actual
                        </p>
                        <div style="margin-bottom: 1rem;">
                            <img id="imagenActualPreview" src="" alt="Imagen actual"
                                style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 6px; border: 2px solid #e2e8f0;">
                        </div>
                    </div>

                    <!-- Selección de nueva imagen -->
                    <div class="detalle-info-box" style="text-align: center;">
                        <p class="detalle-label"
                            style="font-size: 1.1rem; color: #2d3748 !important; margin-bottom: 0.75rem;">
                            <i class="fa fa-upload" style="font-size: 1.1rem; color: #667eea;"></i> Seleccionar Nueva
                            Imagen
                        </p>

                        <!-- Previsualización de nueva imagen -->
                        <div style="margin-bottom: 1rem;">
                            <img id="nuevaImagenPreview" src="" alt="Previsualización"
                                style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 6px; display: none; margin-bottom: 0.75rem; border: 2px solid #48bb78;">
                        </div>

                        <!-- Input de archivo -->
                        <div style="margin-bottom: 1rem;">
                            <input type="file" id="inputCambiarImagen" accept="image/*" class="form-control"
                                style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem;">
                        </div>

                        <!-- Información de formatos aceptados -->
                        <p style="color: #718096; font-size: 0.9rem; margin: 0;">
                            <i class="fa fa-info-circle" style="margin-right: 0.3rem;"></i>
                            Formatos aceptados: JPG, JPEG, PNG, GIF (máximo 5MB)
                        </p>
                    </div>
                </div>

                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 1.5rem; justify-content: center; gap: 1rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 0.9rem 2rem; font-size: 1rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1rem;"></i> Cancelar
                    </button>
                    <button type="button" id="btnSubirImagen" class="btn-detalle-action"
                        style="background: #0E112B; color: white !important; padding: 0.9rem 2rem; font-size: 1rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-cloud-upload" style="font-size: 1rem;"></i> Cambiar Imagen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header -->
                <div class="modal-header modal-detalle-header" style="background: #0E112B; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                        style="color: white; opacity: 1;">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4 style="font-weight: 700; font-size: 2.2rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-shopping-bag" style="font-size: 2.2rem;"></i> Editar Información del Producto
                        </h4>
                    </div>
                </div>

                <!-- Body -->
                <div class="modal-body detalle-section">
                    <!-- Área de mensajes -->
                    <div id="alertaEditarProducto" class="alert"
                        style="display: none; margin-bottom: 1.5rem; padding: 1rem; border-radius: 8px; font-size: 1.2rem; font-weight: 600; text-align: center;">
                        <i class="fa" style="margin-right: 0.5rem; font-size: 1.3rem;"></i>
                        <span id="textoAlertaProducto"></span>
                    </div>

                    <!-- Campos ocultos -->
                    <input type="hidden" id="editProductoCodProducto" value="">
                    <input type="hidden" id="editProductoCodCategoria" value="">

                    <!-- Código de Barra y Nombre del Producto -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-6 mb-md-0">
                            <div class="detalle-info-box">
                                <label class="detalle-label" style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-barcode" style="color: #0E112B; font-size: 1.4rem;"></i> Código de Barra
                                </label>
                                <input type="text" id="editProductoCodigoBarra" class="form-control" style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px; width: 100% !important;">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-6 mb-md-0">
                            <div class="detalle-info-box">
                                <label class="detalle-label" style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-shopping-bag" style="color: #0E112B; font-size: 1.4rem;"></i> Nombre del Producto *
                                </label>
                                <input type="text" id="editProductoNombre" class="form-control" required style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px; width: 100% !important;">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-6 mb-md-0">
                            <div class="detalle-info-box">
                                <label class="detalle-label" style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-shopping-bag" style="color: #0E112B; font-size: 1.4rem;"></i> IMEI 1 *
                                </label>
                                <input type="number" id="editProductoSerial1" class="form-control" required style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px; width: 100% !important;">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-6 mb-md-0">
                            <div class="detalle-info-box">
                                <label class="detalle-label" style="color: #2d3748; font-weight: 600; font-size: 1.4rem; margin-bottom: 0.75rem;">
                                    <i class="fa fa-shopping-bag" style="color: #0E112B; font-size: 1.4rem;"></i> IMEI 2</label>
                                <input type="number" id="editProductoSerial2" class="form-control" required style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; font-size: 1.4rem; background: white; color: #2d3748; height: 55px; width: 100% !important;">
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 gap-sm-3 w-100">
                        <button type="button" class="btn btn-secondary" onclick="regresarAlModalAnterior()"
                            style="background: #718096 !important; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border-radius: 8px; font-weight: 600; border: none; flex: 1; max-width: 250px;">
                            <i class="fa fa-times" style="font-size: 1.3rem;"></i> Cancelar
                        </button>
                        <button type="button" id="btnGuardarProducto" class="btn-detalle-action"
                            style="background: #0E112B; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border-radius: 8px; font-weight: 600; border: none; flex: 1; max-width: 250px;">
                            <i class="fa fa-save" style="font-size: 1.3rem; color: white !important;"></i> Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Notificación -->
<div class="modal fade" id="modalCrearNotificacion" tabindex="-1" aria-labelledby="modalCrearNotificacionLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <div class="modal-header modal-detalle-header">
                    <h5 class="modal-title" id="modalCrearNotificacionLabel">
                        <i class="fa fa-bell" style="margin-right: 0.5rem;"></i> Crear Nueva Notificación
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body detalle-section">
                    <!-- Alerta para mensajes -->
                    <div id="alertaCrearNotificacion" class="alert" style="display: none; margin-bottom: 1rem;"></div>

                    <div class="form-group" style="display: none;">
                        <label for="inputNombreNotificacion">
                            <i class="fa fa-tag" style="margin-right: 0.5rem;"></i> Nombre de la Notificación
                        </label>
                        <input type="text" class="form-control" id="inputNombreNotificacion"
                            placeholder="Ingrese el nombre de la notificación" maxlength="100" disabled>
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle"></i> Máximo 100 caracteres
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="selectTipoNotificacion">
                            <i class="fa fa-file-text" style="margin-right: 0.5rem;"></i> Tipo de Notificación
                        </label>
                        <input type="hidden" id="origen_boton">
                        <select id="cod_tipo_notificacion_alerta" name="cod_tipo_notificacion_alerta" class="form-control" onchange="actualizarDescripcionNotificacion()"
                            style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; height: auto; min-height: 45px; background: white; color: #2d3748;">
                            <?php $cod_tipo_notificacion_alerta = 1;
                            if (isset($cod_tipo_notificacion_alerta)) { echo ""; } else { echo ""; }
                            $consulta2_sql = "SELECT cod_tipo_notificacion_alerta, nombre_tipo_notificacion_alerta, descripcion_tipo_notificacion_alerta FROM tbl15_tipo_notificacion_alerta WHERE (cod_estado = '1' AND cod_tipo = '1')";
                            $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if (isset($cod_tipo_notificacion_alerta) and $cod_tipo_notificacion_alerta == $datos2['cod_tipo_notificacion_alerta']) { $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_tipo_notificacion_alerta'];
                                $nombre = $datos2['nombre_tipo_notificacion_alerta'];
                                $descripcion = $datos2['descripcion_tipo_notificacion_alerta'];
                                echo "<option value='" . $codigo . "' data-descripcion='" . htmlspecialchars($descripcion, ENT_QUOTES) . "' $seleccionado >" . $nombre . "</option>";
                            } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="textareaDescripcionNotificacion">
                            <i class="fa fa-file-text" style="margin-right: 0.5rem;"></i> Descripción de la Notificación
                        </label>
                        <textarea class="form-control" id="textareaDescripcionNotificacion" rows="4"
                            placeholder="Ingrese la descripción detallada de la notificación" maxlength="500"
                            style="resize: vertical;"></textarea>
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle"></i> Máximo 500 caracteres
                        </small>
                    </div>
                    <div id="mensajeCrearNotificacion" style="margin-top: 1rem; display: none;"></div>
                </div>
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 0.9rem 2rem; font-size: 1rem; border-radius: 8px; font-weight: 600; border: none; margin-right: 1rem;">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                    <button type="button" id="btnGuardarNotificacion" class="btn btn-success"
                        style="background: #48bb78 !important; color: white !important; padding: 0.9rem 2rem; font-size: 1rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-save"></i> Guardar Notificación
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Líder -->
<div class="modal fade" id="modalCambiarLider" tabindex="-1" aria-labelledby="modalCambiarLiderLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-star" style="font-size: 2.5rem;"></i>
                            Cambiar Líder
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaLider" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-user" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el nuevo
                            líder</p>
                        <select id="selectNuevoLider" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un líder --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioLider()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Coordinador -->
<div class="modal fade" id="modalCambiarCoordinador" tabindex="-1" aria-labelledby="modalCambiarCoordinadorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-sitemap" style="font-size: 2.5rem;"></i>
                            Cambiar Coordinador
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaCoordinador" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-user" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el nuevo
                            coordinador</p>
                        <select id="selectNuevoCoordinador" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un coordinador --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioCoordinador()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Asesor -->
<div class="modal fade" id="modalCambiarAsesor" tabindex="-1" aria-labelledby="modalCambiarAsesorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-user-circle" style="font-size: 2.5rem;"></i>
                            Cambiar Asesor
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaAsesor" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-user" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el nuevo
                            asesor</p>
                        <select id="selectNuevoAsesor" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un asesor --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioAsesor()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Aliado Estratégico -->
<div class="modal fade" id="modalCambiarAliadoEstrategico" tabindex="-1"
    aria-labelledby="modalCambiarAliadoEstrategicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-handshake-o" style="font-size: 2.5rem;"></i>
                            Cambiar Aliado Estratégico
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaAliadoEstrategico" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-user" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el nuevo
                            aliado estratégico</p>
                        <select id="selectNuevoAliadoEstrategico" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un aliado estratégico --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioAliadoEstrategico()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Revisor -->
<div class="modal fade" id="modalCambiarRevisor" tabindex="-1" aria-labelledby="modalCambiarRevisorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-check-square-o" style="font-size: 2.5rem;"></i>
                            Cambiar Back Office
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaRevisor" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-user" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el nuevo
                            revisor</p>
                        <select id="selectNuevoRevisor" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un Back Office --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioRevisor()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Tienda -->
<div class="modal fade" id="modalCambiarTienda" tabindex="-1" aria-labelledby="modalCambiarTiendaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-store" style="font-size: 2.5rem;"></i>
                            Cambiar Tienda
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaTienda" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-store" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione la nueva
                            tienda</p>
                        <select id="selectNuevaTienda" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione una tienda --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioTienda()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Valor a Crédito -->
<div class="modal fade" id="modalEditarValorCredito" tabindex="-1" aria-labelledby="modalEditarValorCreditoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
        <div class="modal-content"
            style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 2rem 2.5rem;">
                <h5 class="modal-title" id="modalEditarValorCreditoLabel" style="font-size: 2.2rem; font-weight: 700;">
                    <i class="fa fa-credit-card" style="margin-right: 0.75rem; font-size: 2.2rem;"></i> Editar Valor a
                    Crédito
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color: white; opacity: 1; font-size: 2.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2.5rem 3rem;">
                <div class="form-group">
                    <label for="inputNuevoValorCreditoFormateado"
                        style="font-size: 1.6rem; font-weight: 600; margin-bottom: 1rem; display: block;">
                        <i class="fa fa-dollar" style="margin-right: 0.5rem; font-size: 1.6rem;"></i> Nuevo Valor a
                        Crédito
                    </label>
                    <input type="text" class="form-control" id="inputNuevoValorCreditoFormateado"
                        placeholder="Ingrese el nuevo valor"
                        style="background: rgba(255,255,255,0.1) !important; border: 2px solid rgba(255,255,255,0.3) !important; color: white !important; font-size: 2rem !important; padding: 1.25rem 1.5rem !important; border-radius: 10px !important; min-height: 70px !important;"
                        onfocus="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='#81e6d9';"
                        onblur="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.3)';"
                        oninput="actualizarValorCreditoReal(this)">
                    <input type="hidden" id="inputNuevoValorCredito" value="">
                    <small style="color: #81e6d9; display: block; margin-top: 1rem; font-size: 1.2rem;">
                        <i class="fa fa-info-circle"></i> Se formatea automáticamente con separador de miles
                    </small>
                </div>
                <div id="mensajeEditarValorCredito" style="margin-top: 1.5rem; display: none; font-size: 1.3rem;"></div>
            </div>
            <div class="modal-footer"
                style="border-top: 1px solid rgba(255,255,255,0.1); padding: 2rem 2.5rem; justify-content: center; gap: 1.5rem;">
                <button type="button" class="btn" data-dismiss="modal"
                    style="background: #4a5568; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 10px; font-weight: 600;">
                    <i class="fa fa-times" style="font-size: 1.5rem;"></i> Cancelar
                </button>
                <button type="button" class="btn" onclick="guardarNuevoValorCredito()"
                    style="background: #48bb78; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 10px; font-weight: 600;">
                    <i class="fa fa-save" style="font-size: 1.5rem;"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Valor de Contado -->
<div class="modal fade" id="modalEditarValorContado" tabindex="-1" aria-labelledby="modalEditarValorContadoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
        <div class="modal-content"
            style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 1.5rem;">
                <h5 class="modal-title" id="modalEditarValorContadoLabel" style="font-size: 2.2rem; font-weight: 700;">
                    <i class="fa fa-money" style="margin-right: 0.5rem;"></i> Editar Valor de Contado
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color: white; opacity: 1; font-size: 2.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div class="form-group">
                    <label for="inputNuevoValorContadoFormateado"
                        style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">
                        <i class="fa fa-dollar" style="margin-right: 0.5rem;"></i> Nuevo Valor de Contado
                    </label>
                    <input type="text" class="form-control" id="inputNuevoValorContadoFormateado"
                        placeholder="Ingrese el nuevo valor"
                        style="background: rgba(255,255,255,0.1) !important; border: 2px solid rgba(255,255,255,0.3) !important; color: white !important; font-size: 2rem !important; padding: 1.25rem 1.5rem !important; border-radius: 10px !important; min-height: 70px !important;"
                        onfocus="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='#81e6d9';"
                        onblur="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.3)';"
                        oninput="actualizarValorContadoRealModal(this)">
                    <input type="hidden" id="inputNuevoValorContado" value="">
                    <small style="color: #81e6d9; display: block; margin-top: 0.5rem;">
                        <i class="fa fa-info-circle"></i> Ingrese el valor (se formateará automáticamente)
                    </small>
                </div>
                <div id="mensajeEditarValorContado" style="margin-top: 1rem; display: none;"></div>
            </div>
            <div class="modal-footer"
                style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1.5rem; justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal"
                    style="background: #4a5568; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 8px; font-weight: 600; margin-right: 1rem;">
                    <i class="fa fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn" onclick="guardarNuevoValorContado()"
                    style="background: #48bb78; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 8px; font-weight: 600;">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Número de Cuotas -->
<div class="modal fade" id="modalEditarNumeroCuotas" tabindex="-1" aria-labelledby="modalEditarNumeroCuotasLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
        <div class="modal-content"
            style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 1.5rem;">
                <h5 class="modal-title" id="modalEditarNumeroCuotasLabel" style="font-size: 2.2rem; font-weight: 700;">
                    <i class="fa fa-calendar-check-o" style="margin-right: 0.5rem;"></i> Editar Número de Cuotas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color: white; opacity: 1; font-size: 2.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div class="form-group">
                    <label for="inputNuevoNumeroCuotasFormateado"
                        style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">
                        <i class="fa fa-hashtag" style="margin-right: 0.5rem;"></i> Nuevo Número de Cuotas
                    </label>
                    <input type="number" class="form-control" id="inputNuevoNumeroCuotasFormateado"
                        placeholder="Ingrese el número de cuotas"
                        style="background: rgba(255,255,255,0.1) !important; border: 2px solid rgba(255,255,255,0.3) !important; color: white !important; font-size: 2rem !important; padding: 1.25rem 1.5rem !important; border-radius: 10px !important; min-height: 70px !important;"
                        onfocus="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='#81e6d9';"
                        onblur="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.3)';"
                        oninput="actualizarNumeroCuotasReal(this)">
                    <input type="hidden" id="inputNuevoNumeroCuotas" value="">
                    <small style="color: #81e6d9; display: block; margin-top: 0.5rem;">
                        <i class="fa fa-info-circle"></i> Ingrese el número de cuotas (se formateará automáticamente)
                    </small>
                </div>
                <div id="mensajeEditarNumeroCuotas" style="margin-top: 1rem; display: none;"></div>
            </div>
            <div class="modal-footer"
                style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1.5rem; justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal"
                    style="background: #4a5568; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 8px; font-weight: 600; margin-right: 1rem;">
                    <i class="fa fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn" onclick="guardarNuevoNumeroCuotas()"
                    style="background: #48bb78; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 8px; font-weight: 600;">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Cuota Mensual -->
<div class="modal fade" id="modalEditarCuotaMensual" tabindex="-1" aria-labelledby="modalEditarCuotaMensualLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
        <div class="modal-content"
            style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 1.5rem;">
                <h5 class="modal-title" id="modalEditarCuotaMensualLabel" style="font-size: 2.2rem; font-weight: 700;">
                    <i class="fa fa-calculator" style="margin-right: 0.5rem;"></i> Editar Cuota Mensual
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color: white; opacity: 1; font-size: 2.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div class="form-group">
                    <label for="inputNuevoCuotaMensualFormateado"
                        style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">
                        <i class="fa fa-dollar" style="margin-right: 0.5rem;"></i> Nueva Cuota Mensual
                    </label>
                    <input type="text" class="form-control" id="inputNuevoCuotaMensualFormateado"
                        placeholder="Ingrese el valor de la cuota"
                        style="background: rgba(255,255,255,0.1) !important; border: 2px solid rgba(255,255,255,0.3) !important; color: white !important; font-size: 2rem !important; padding: 1.25rem 1.5rem !important; border-radius: 10px !important; min-height: 70px !important;"
                        onfocus="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='#81e6d9';"
                        onblur="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.3)';"
                        oninput="actualizarCuotaMensualReal(this)">
                    <input type="hidden" id="inputNuevoCuotaMensual" value="">
                    <small style="color: #81e6d9; display: block; margin-top: 0.5rem;">
                        <i class="fa fa-info-circle"></i> Ingrese el valor (se formateará automáticamente)
                    </small>
                </div>
                <div id="mensajeEditarCuotaMensual" style="margin-top: 1rem; display: none;"></div>
            </div>
            <div class="modal-footer"
                style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1.5rem; justify-content: center;">
                <button type="button" class="btn" data-dismiss="modal"
                    style="background: #4a5568; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 8px; font-weight: 600; margin-right: 1rem;">
                    <i class="fa fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn" onclick="guardarNuevoCuotaMensual()"
                    style="background: #48bb78; color: white; padding: 1.25rem 3rem; font-size: 1.5rem; border: none; border-radius: 8px; font-weight: 600;">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Vendedor -->
<div class="modal fade" id="modalCambiarVendedor" tabindex="-1" aria-labelledby="modalCambiarVendedorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-user-tie" style="font-size: 2.5rem;"></i>
                            Cambiar Vendedor
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaVendedor" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-user-tie" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el
                            nuevo vendedor</p>
                        <select id="selectNuevoVendedor" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un vendedor --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioVendedor()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Operador de Crédito -->
<div class="modal fade" id="modalCambiarOperadorCredito" tabindex="-1"
    aria-labelledby="modalCambiarOperadorCreditoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-credit-card" style="font-size: 2.5rem;"></i>
                            Cambiar Operador de Crédito
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaOperadorCredito" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-credit-card" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el
                            nuevo operador</p>
                        <select id="selectNuevoOperadorCredito" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un operador --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioOperadorCredito()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Observación -->
<div class="modal fade" id="modalEditarObservacion" tabindex="-1" aria-labelledby="modalEditarObservacionLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h5 class="modal-title" id="modalEditarObservacionLabel"
                            style="font-size: 1.8rem; font-weight: 700; margin: 0; color: white;">
                            <i class="fa fa-comment-o" style="font-size: 1.8rem;"></i> Editar Observaciones
                        </h5>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaObservacion" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <label for="textareaObservacion" class="detalle-label"
                            style="display: block; margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600; color: #2d3748;">
                            <i class="fa fa-comment" style="color: #0E112B; margin-right: 0.5rem;"></i> Observación
                        </label>
                        <textarea id="textareaObservacion" class="form-control" rows="5"
                            style="font-size: 1.3rem; padding: 1rem; border: 2px solid #cbd5e0; border-radius: 8px; resize: vertical; min-height: 150px;"
                            placeholder="Ingrese las observaciones..."></textarea>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarObservacion()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Cuenta de Banco -->
<div class="modal fade" id="modalCambiarBancoCuenta" tabindex="-1" aria-labelledby="modalCambiarBancoCuentaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-bank" style="font-size: 2.5rem;"></i>
                            Cambiar Cuenta de Banco
                        </h4>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaBancoCuenta" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-bank" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione la nueva
                            cuenta</p>
                        <select id="selectNuevaBancoCuenta" class="form-control"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione una cuenta --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" onclick="guardarCambioBancoCuenta()" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Entidad Crediticia -->
<div class="modal fade" id="modalEditarEntidadCrediticia" tabindex="-1"
    aria-labelledby="modalEditarEntidadCrediticiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header -->
                <div class="modal-header modal-detalle-header" style="background: #0E112B; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                        style="color: white; opacity: 1;">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4 style="font-weight: 700; font-size: 2.2rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-edit" style="font-size: 2.2rem;"></i>Editar Línea de Crédito y Simular
                        </h4>
                    </div>
                </div>

                <!-- Body -->
                <div class="modal-body detalle-section">
                    <input type="hidden" id="cod_info_factura_venta_editar" name="cod_info_factura_venta_editar">

                    <!-- Entidad Crediticia y Tipo de Simulación -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.2rem;">
                                    <i class="fa fa-bank" style="color: #0E112B; font-size: 1.2rem;"></i> Línea de
                                    Crédito
                                </label>
                                <select id="cod_entidad_crediticia" name="cod_entidad_crediticia" class="form-control"
                                    onchange="actualizarPorcentajeEntidad()"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; height: auto; min-height: 45px; background: white; color: #2d3748;">
                                    <option value="">Seleccionar entidad...</option>
                                </select>
                            </div>
                        </div>

                        <?php $cod_tipo_simulacion_credito = '1'; ?>
                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.2rem;">
                                    <i class="fa fa-calculator" style="color: #0E112B; font-size: 1.2rem;"></i> Tipo de
                                    Simulación
                                </label>
                                <select id="cod_tipo_simulacion_credito" name="cod_tipo_simulacion_credito"
                                    class="form-control" onchange="calcularValorCredito()"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; height: auto; min-height: 45px; background: white; color: #2d3748;">
                                    <?php if (isset($cod_tipo_simulacion_credito)) { echo ""; } else { echo ""; }
                                    $consulta2_sql = "SELECT cod_tipo_simulacion_credito, nombre_tipo_simulacion_credito FROM tbl15_tipo_simulacion_credito WHERE (cod_estado = '1')";
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                        if (isset($cod_tipo_simulacion_credito) and $cod_tipo_simulacion_credito == $datos2['cod_tipo_simulacion_credito']) { $seleccionado = "selected"; } else { $seleccionado = ""; }
                                        $codigo = $datos2['cod_tipo_simulacion_credito'];
                                        $nombre = $datos2['nombre_tipo_simulacion_credito'];
                                        echo "<option value='" . $codigo . "' $seleccionado >" . $nombre . "</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Información de la Entidad Seleccionada -->
                    <div id="infoEntidadSeleccionada"
                        style="display: none; background: #f7fafc; border: 2px solid #0E112B; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
                        <p style="margin: 0; color: #2d3748; font-size: 1.1rem;">
                            <i class="fa fa-info-circle" style="color: #0E112B;"></i>
                            <strong>Porcentaje de administración:</strong> <span id="porcentajeEntidad"
                                style="color: #0E112B; font-weight: 700;">0</span>%
                        </p>
                        <div id="observaciones_entidad_crediticia_modal_editar"
                            style="display: none; margin-top: 0.75rem; padding: 0.75rem; background: white; border-left: 4px solid #0E112B; border-radius: 4px;">
                            <p style="margin: 0; color: #4a5568; font-size: 1rem;">
                                <i class="fa fa-comment" style="color: #0E112B;"></i>
                                <strong>Observaciones:</strong> <span id="observacionesTexto"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Valor de Contado y Número de Cuotas -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.2rem;">
                                    <i class="fa fa-money" style="color: #0E112B; font-size: 1.2rem;"></i>
                                    <div id="text_label_valor" style="display: inline;"> Valor de Contado</div>
                                </label>
                                <input type="text" id="precio_venta_producto_formateado"
                                    name="precio_venta_producto_formateado" class="form-control"
                                    placeholder="Ingrese el valor" oninput="actualizarValorContadoReal(this)"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; background: white; color: #2d3748;">
                                <input type="hidden" id="precio_venta_producto" name="precio_venta_producto" value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detalle-info-box">
                                <label class="detalle-label"
                                    style="color: #2d3748; font-weight: 600; font-size: 1.2rem;">
                                    <i class="fa fa-calendar-check-o" style="color: #0E112B; font-size: 1.2rem;"></i>
                                    Número de Cuotas
                                </label>
                                <input type="number" id="numero_cuotas" name="numero_cuotas" class="form-control"
                                    placeholder="Ingrese el número de cuotas" min="1" max="36"
                                    onkeyup="calcularValorCredito()" onchange="calcularValorCredito()"
                                    style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; background: white; color: #2d3748;">
                            </div>
                        </div>
                    </div>

                    <!-- Resultados del Cálculo -->
                    <div id="resultadosCalculo"
                        style="display: none; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 1.5rem; margin-top: 1.5rem; color: #ffffff; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                        <h5
                            style="text-align: center; font-weight: 700; margin-bottom: 1.5rem; font-size: clamp(1.3rem, 4vw, 2rem); color: #ffffff !important; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                            <i class="fa fa-calculator"
                                style="font-size: clamp(1.3rem, 4vw, 2rem); color: #ffffff !important;"></i> Resultados
                            de la Simulación
                        </h5>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 text-center" style="padding: 0.75rem;">
                                <div
                                    style="background: rgba(255,255,255,0.25); border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                    <p
                                        style="margin: 0; font-size: clamp(1rem, 3vw, 1.3rem); color: #ffffff !important; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                                    <div id="text_label_valor_calc" style="display: inline; color: #ffffff !important;">
                                        Valor Total a Crédito</div>
                                    </p>
                                    <p
                                        style="margin: 0.75rem 0 0 0; font-size: clamp(1.6rem, 5vw, 2.4rem); font-weight: 700; color: #ffffff !important; text-shadow: 0 2px 4px rgba(0,0,0,0.2); word-break: break-word;">
                                        $<span id="valorTotalCredito" style="color: #ffffff !important;">0</span></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 text-center" style="padding: 0.75rem;">
                                <div
                                    style="background: rgba(255,255,255,0.25); border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                    <p
                                        style="margin: 0; font-size: clamp(1rem, 3vw, 1.3rem); color: #ffffff !important; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                                        Valor por Cuota <i class="fa fa-edit"
                                            style="font-size: clamp(0.8rem, 2.5vw, 1rem); opacity: 0.8;"></i></p>
                                    <div style="margin: 0.75rem 0 0 0;">
                                        <span
                                            style="font-size: clamp(1.6rem, 5vw, 2.4rem); font-weight: 700; color: #ffffff !important; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">$</span>
                                        <input type="text" id="valorPorCuotaFormateado"
                                            style="background: rgba(255,255,255,0.3); border: 2px solid rgba(255,255,255,0.5); color: #ffffff !important; font-size: clamp(1.6rem, 5vw, 2.4rem); font-weight: 700; text-align: center; width: 70%; max-width: 250px; padding: 0.5rem; border-radius: 8px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"
                                            value="0" oninput="actualizarValorCuotaReal(this)" />
                                        <input type="hidden" id="valorPorCuota" value="0" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" id="btnGuardarEntidadCrediticia" onclick="guardarEntidadCrediticia()"
                        class="btn-detalle-action"
                        style="background: #0E112B; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-save" style="font-size: 1.4rem; color: white !important;"></i> Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Estado de Facturación -->
<div class="modal fade" id="modalCambiarEstadoFacturacion" tabindex="-1"
    aria-labelledby="modalCambiarEstadoFacturacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4 style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-exchange" style="font-size: 2.5rem;"></i>
                            Cambiar Estado del Crédito
                        </h4>
                        <p style="margin: 0.75rem 0 0 0; font-size: 1.5rem; opacity: 0.9;">
                            <i class="fa fa-user" style="margin-right: 0.75rem; font-size: 1.5rem;"></i><span
                                id="modalEstadoNombreCliente"></span>
                        </p>
                    </div>
                </div>
                <!-- Sección: Formulario -->
                <div class="modal-body detalle-section">
                    <div id="alertaEstadoFacturacion" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box">
                        <p class="detalle-label" style="font-size: 1.3rem; color: #2d3748 !important;"><i
                                class="fa fa-list-alt" style="font-size: 1.3rem; color: #667eea;"></i> Seleccione el nuevo estado</p>
                        <select class="form-control" id="nuevoEstadoFacturacion"
                            style="background-color: white !important; color: #2d3748 !important; border: 2px solid #e2e8f0; border-radius: 8px; padding: 1.25rem; font-size: 1.6rem; font-weight: 600; width: 100%; height: auto; min-height: 60px;">
                            <option value="">-- Seleccione un estado --</option>
                        </select>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" id="btnGuardarEstadoFacturacion" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-save" style="font-size: 1.4rem;"></i> Guardar Cambio
                    </button>
                </div>
                <!-- Campos ocultos -->
                <input type="hidden" id="hiddenCodInfoFacturaVenta" value="">
                <input type="hidden" id="hiddenEstadoActual" value="">
                <input type="hidden" id="hiddenorigen_boton_selecion" value="">
            </div>
        </div>
    </div>
</div>

<!-- Modal Aprobar Venta -->
<div class="modal fade" id="modalAprobarVenta" tabindex="-1" aria-labelledby="modalAprobarVentaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-check-circle" style="font-size: 2.5rem;"></i>
                            Aprobar Venta
                        </h4>
                        <p style="margin: 0.75rem 0 0 0; font-size: 1.5rem; opacity: 0.9;">
                            <i class="fa fa-user" style="margin-right: 0.75rem; font-size: 1.5rem;"></i><span
                                id="modalAprobarNombreCliente"></span>
                        </p>
                    </div>
                </div>
                <!-- Sección: Confirmación -->
                <div class="modal-body detalle-section">
                    <div id="alertaAprobarVenta" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box" style="text-align: center;">
                        <i class="fa fa-info-circle" style="font-size: 3rem; color: #667eea; margin-bottom: 1rem;"></i>
                        <p style="font-size: 1.3rem; color: #4a5568; margin: 0;">¿Está seguro que desea aprobar esta
                            venta y cambiar el estado a <strong>"Venta Aprobada"</strong>?</p>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" id="btnConfirmarAprobarVenta" name="codigo_estado_facturacion"
                        class="btn-detalle-action" style="padding: 1.15rem 3rem; font-size: 1.4rem;">
                        <i class="fa fa-check" style="font-size: 1.4rem;"></i> Si, Aprobar Venta
                    </button>
                </div>
                <!-- Campos ocultos -->
                <input type="hidden" id="hiddenCodInfoFacturaVentaAprobar" value="">
                <input type="hidden" id="hiddenCodTipoEstadoCargueDocumentacion" value="">
            </div>
        </div>
    </div>
</div>

<!-- Modal Factura Aprobada -->
<div class="modal fade" id="modalFacturaAprobada" tabindex="-1" aria-labelledby="modalFacturaAprobadaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente morado -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-check-circle" style="font-size: 2.5rem; color: #48bb78;"></i>
                            ¡Venta Aprobada!
                        </h4>
                        <p style="margin: 0.75rem 0 0 0; font-size: 1.3rem; opacity: 0.9;">La factura ha sido generada
                            exitosamente</p>
                    </div>
                </div>
                <!-- Sección: Información de la factura -->
                <div class="modal-body detalle-section">
                    <div class="detalle-info-box"
                        style="text-align: center; background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%); border: 2px solid #48bb78;">
                        <i class="fa fa-file-text" style="font-size: 3rem; color: #276749; margin-bottom: 1rem;"></i>
                        <p style="font-size: 1.1rem; color: #276749; margin: 0.5rem 0;"><strong>Factura No.:</strong>
                            <span id="modalFacturaCodigo" style="font-size: 1.5rem; font-weight: 700;"></span>
                        </p>
                        <p style="font-size: 1.1rem; color: #276749; margin: 0.5rem 0;"><strong>Cliente:</strong> <span
                                id="modalFacturaCliente"></span></p>
                        <p style="font-size: 1.1rem; color: #276749; margin: 0.5rem 0;"><strong>Monto Total:</strong>
                            <span id="modalFacturaMonto" style="font-size: 1.3rem; font-weight: 700;"></span>
                        </p>
                    </div>

                    <div class="detalle-info-box" style="text-align: center;">
                        <p style="font-size: 1.1rem; color: #4a5568; margin: 0;">Haga clic en el botón para ver e
                            imprimir la factura de venta</p>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cerrar
                    </button>
                    <a href="#" id="btnVerFactura" target="_blank" class="btn-detalle-action"
                        style="padding: 1.15rem 3rem; font-size: 1.4rem; text-decoration: none; color: white !important;">
                        <i class="fa fa-eye" style="font-size: 1.4rem; color: white !important;"></i> Ver Factura
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function actualizarDescripcionNotificacion() {
        var select = document.getElementById('cod_tipo_notificacion_alerta');
        var textarea = document.getElementById('textareaDescripcionNotificacion');
        var origen_boton = document.getElementById('origen_boton');

        var selectedOption = select.options[select.selectedIndex];
        var descripcion = selectedOption.getAttribute('data-descripcion');

        if (descripcion) {
            textarea.value = descripcion;
        } else {
            textarea.value = '';
        }
    }
</script>

<!-- Modal Motivo de Rechazo de Foto -->
<div class="modal fade" id="modalMotivoRechazoFoto" tabindex="-1" aria-labelledby="modalMotivoRechazoFotoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: #0E112B; color: white;">
                <h5 class="modal-title" id="modalMotivoRechazoFotoLabel"><i class="fa fa-exclamation-triangle"></i>
                    Motivo del Rechazo de la Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="descripcionMotivoRechazo">Describa el motivo del rechazo:</label>
                    <textarea id="descripcionMotivoRechazo" class="form-control" rows="4"
                        placeholder="Ingrese el motivo del rechazo..." style="resize: vertical;"></textarea>
                </div>
                <input type="hidden" id="codNotaObservacionRechazo" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnGuardarMotivoRechazoFoto"><i class="fa fa-save"></i>
                    Guardar Motivo</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación Aprobar Venta Diligenciamiento -->
<div class="modal fade" id="modalConfirmacionAprobarVenta" tabindex="-1"
    aria-labelledby="modalConfirmacionAprobarVentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente -->
                <div class="modal-header modal-detalle-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-check-circle" style="font-size: 2.5rem; color: #48bb78;"></i>Confirmar
                            Aprobación
                        </h4>
                        <p style="margin: 0.75rem 0 0 0; font-size: 1.5rem; opacity: 0.9;"> Esta acción aprobará
                            definitivamente la venta</p>
                    </div>
                </div>
                <!-- Sección: Confirmación -->
                <div class="modal-body detalle-section">
                    <div id="alertaConfirmacionAprobacion" class="alert"
                        style="display: none; border-radius: 8px; font-size: 1.4rem; padding: 1.25rem;"></div>

                    <div class="detalle-info-box"
                        style="text-align: center; background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%); border: 2px solid #48bb78;">
                        <i class="fa fa-thumbs-up" style="font-size: 3rem; color: #2f855a; margin-bottom: 1rem;"></i>
                        <p style="font-size: 1.4rem; color: #2d3748; margin: 0; font-weight: 600;">¿Está seguro que
                            desea <strong>APROBAR</strong> esta venta?</p>
                        <p id="nombreClienteConfirmacion"
                            style="font-size: 1.3rem; color: #2f855a; margin: 1rem 0 0 0; font-weight: 600;"></p>
                        <p style="font-size: 1.2rem; color: #4a5568; margin: 0.5rem 0 0 0;">Una vez aprobada, el estado
                            cambiará y se procesará la venta.</p>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                    </button>
                    <button type="button" id="btnConfirmarAprobacionVenta" class="btn"
                        style="background: #48bb78; color: white; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-check" style="font-size: 1.4rem;"></i> Sí, Aprobar Venta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Validar Datos Estado Facturación -->
<div class="modal fade" id="modalValidarDatosEstadoFacturacion" tabindex="-1" aria-labelledby="modalValidarDatosLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header -->
                <div class="modal-header modal-detalle-header" style="background: #0E112B; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                        style="color: white; opacity: 1;">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.2rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fa fa-check-circle" style="font-size: 2.2rem;"></i>
                            Validar Datos de Facturación
                        </h4>
                    </div>
                </div>

                <!-- Body -->
                <div class="modal-body detalle-section">
                    <!-- Área de mensajes -->
                    <div id="alertaValidarDatos" class="alert"
                        style="display: none; margin-bottom: 1.5rem; padding: 1rem; border-radius: 8px; font-size: 1.2rem; font-weight: 600; text-align: center;">
                        <i class="fa" style="margin-right: 0.5rem; font-size: 1.3rem;"></i>
                        <span id="textoAlertaValidar"></span>
                    </div>

                    <!-- Campos ocultos -->
                    <input type="hidden" id="validarCodInfoFacturaVenta" value="">
                    <input type="hidden" id="validarCodigoEstadoFacturacion" value="">

                    <!-- Mensaje de confirmación -->
                    <div class="detalle-info-box"
                        style="text-align: center; background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%); border: 2px solid #38b2ac;">
                        <i class="fa fa-info-circle" style="font-size: 3rem; color: #234e52; margin-bottom: 1rem;"></i>
                        <p style="font-size: 1.4rem; color: #2d3748; margin: 0; font-weight: 600;">¿Está seguro que
                            desea cambiar el estado de esta factura a <strong>VALIDACIÓN DE DATOS</strong>?</p>
                        <p style="font-size: 1.2rem; color: #4a5568; margin: 1rem 0 0 0;">Esta acción actualizará el estado de facturación.</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 gap-sm-3 w-100">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="background: #718096 !important; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border-radius: 8px; font-weight: 600; border: none; flex: 1; max-width: 250px;">
                            <i class="fa fa-times" style="font-size: 1.3rem;"></i> Cancelar
                        </button>
                        <button type="button" id="btnGuardarValidarDatos" class="btn-detalle-action"
                            style="background: #0E112B; color: white !important; padding: 1rem 2rem; font-size: 1.3rem; border-radius: 8px; font-weight: 600; border: none; flex: 1; max-width: 250px;">
                            <i class="fa fa-check" style="font-size: 1.3rem; color: white !important;"></i> Confirmar Validación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Éxito Facturación -->
<div class="modal fade" id="modalExitoFacturacion" tabindex="-1" aria-labelledby="modalExitoFacturacionLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-detalle-content">
            <div class="modal-detalle-wrapper">
                <!-- Header con gradiente de éxito -->
                <div class="modal-header modal-detalle-header"
                    style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);">
                    <div style="text-align: center; width: 100%;">
                        <h4
                            style="font-weight: 700; font-size: 2.5rem; margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.75rem; color: white;">
                            <i class="fa fa-check-circle" style="font-size: 3rem;"></i> ¡Facturación Exitosa!
                        </h4>
                        <p style="margin: 0.75rem 0 0 0; font-size: 1.5rem; color: rgba(255,255,255,0.95);">La venta ha
                            sido aprobada y facturada correctamente</p>
                    </div>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body detalle-section" style="padding: 3rem 2.5rem;">
                    <div style="text-align: center;">
                        <div
                            style="background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%); border-radius: 12px; padding: 2.5rem; margin-bottom: 2rem; border: 2px solid #48bb78;">
                            <i class="fa fa-file-pdf-o"
                                style="font-size: 4rem; color: #2f855a; margin-bottom: 1rem;"></i>
                            <p style="font-size: 1.6rem; color: #2d3748; margin: 0; font-weight: 600;">La factura está
                                lista para visualizar</p>
                            <p style="font-size: 1.3rem; color: #4a5568; margin: 1rem 0 0 0;">Haga clic en el botón para
                                ver la factura en formato PDF</p>
                        </div>

                        <!-- Botón Ver Factura PDF -->
                        <a id="btnVerFacturaPdfExito" href="#" target="_blank" class="btn"
                            style="background: #e53e3e; color: white; padding: 1.5rem 4rem; font-size: 1.6rem; border-radius: 10px; font-weight: 700; border: none; text-decoration: none; display: inline-block; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(229, 62, 62, 0.3); transition: all 0.3s;">
                            <i class="fa fa-file-pdf-o" style="font-size: 1.8rem; margin-right: 0.5rem;"></i> Ver
                            Factura PDF
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer"
                    style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center;">
                    <button type="button" id="btnCerrarModalExito" class="btn btn-secondary"
                        style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                        <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Toast Confirmación Checkbox -->
<div class="modal fade" id="modalToastCheckbox" tabindex="-1" aria-hidden="true" data-backdrop="false"
    data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="background: transparent; border: none; box-shadow: none;">
            <div id="toastCheckboxContent"
                style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 1.5rem 2rem; border-radius: 12px; text-align: center; box-shadow: 0 10px 40px rgba(72, 187, 120, 0.4);">
                <i class="fa fa-check-circle" style="font-size: 2.5rem; margin-bottom: 0.75rem; display: block;"></i>
                <p id="toastCheckboxMessage" style="margin: 0; font-size: 1.3rem; font-weight: 600;">Cambio guardado correctamente</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación Cambio de Estado -->
<div class="modal fade" id="modalConfirmarCambioEstado" tabindex="-1" aria-labelledby="modalConfirmarCambioEstadoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-detalle-header"
                style="background: linear-gradient(135deg, #0E112B 0%, #1a1d3a 100%); color: white; border-bottom: none;">
                <h5 class="modal-title" id="modalConfirmarCambioEstadoLabel"
                    style="font-weight: 700; font-size: 1.3rem;">
                    <i class="fa fa-question-circle" style="margin-right: 0.5rem;"></i>Confirmar Cambio de Estado
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color: white; opacity: 1; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <input type="hidden" id="codNotaObservacionConfirmar" value="">
                <input type="hidden" id="nuevoEstadoConfirmar" value="">

                <div class="alert alert-info"
                    style="background: #e6fffa !important; border-left: 4px solid #4fd1c7; color: #234e52 !important; font-size: 1.1rem;">
                    <i class="fa fa-info-circle" style="margin-right: 0.5rem; color: #234e52 !important;"></i>
                    <strong style="color: #234e52 !important;">Estado seleccionado: </strong> <span
                        id="nombreEstadoSeleccionado" style="font-weight: 600; color: #234e52 !important;"></span>
                </div>

                <div id="contenedorMotivoRechazo" style="display: none; margin-top: 1rem;">
                    <label for="motivoRechazoConfirmar"
                        style="display: block; color: #2d3748; font-weight: 600; margin-bottom: 0.5rem;">
                        <i class="fa fa-exclamation-triangle" style="color: #e53e3e; margin-right: 0.3rem;"></i>
                        Motivo del Rechazo: <span style="color: #e53e3e;">*</span>
                    </label>
                    <textarea id="motivoRechazoConfirmar" class="form-control" rows="4"
                        placeholder="Ingrese el motivo del rechazo de la foto..."
                        style="border: 2px solid #e53e3e; border-radius: 6px; resize: vertical;"></textarea>
                    <small class="text-muted" style="display: block; margin-top: 0.25rem;">
                        <i class="fa fa-info-circle"></i> Este motivo será visible para el usuario
                    </small>
                </div>

                <p style="margin-top: 1rem; color: #718096; font-size: 0.95rem;">
                    ¿Está seguro de cambiar el estado de revisión de esta imagen?
                </p>
            </div>
            <div class="modal-footer"
                style="background: #f7fafc; border-top: 2px solid #e2e8f0; padding: 2rem; justify-content: center; gap: 1.5rem;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="background: #718096 !important; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                    <i class="fa fa-times" style="font-size: 1.4rem;"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnConfirmarCambioEstado"
                    style="background: #0E112B; color: white !important; padding: 1.15rem 3rem; font-size: 1.4rem; border-radius: 8px; font-weight: 600; border: none;">
                    <i class="fa fa-check" style="font-size: 1.4rem;"></i> Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    // Manejador para botones de estado de revisión
    $(document).on('click', '.btn-estado-revision', function () {
        var $btn = $(this);
        var codNotaObservacion = $btn.data('cod-nota');
        var nuevoEstado = $btn.data('estado');
        var nombreEstado = $btn.data('nombre-estado');

        // Guardar valores en el modal
        $('#codNotaObservacionConfirmar').val(codNotaObservacion);
        $('#nuevoEstadoConfirmar').val(nuevoEstado);
        $('#nombreEstadoSeleccionado').text(nombreEstado);

        // Si es RECHAZADO, mostrar campo de motivo
        if (nombreEstado === 'RECHAZADO') {
            $('#contenedorMotivoRechazo').show();
            $('#motivoRechazoConfirmar').val('').prop('required', true);
        } else {
            $('#contenedorMotivoRechazo').hide();
            $('#motivoRechazoConfirmar').val('').prop('required', false);
        }

        // Abrir modal de confirmación
        $('#modalConfirmarCambioEstado').modal('show');
    });

    // Confirmar cambio de estado
    $('#btnConfirmarCambioEstado').on('click', function () {
        var codNotaObservacion = $('#codNotaObservacionConfirmar').val();
        var nuevoEstado = $('#nuevoEstadoConfirmar').val();
        var nombreEstado = $('#nombreEstadoSeleccionado').text();
        var motivoRechazo = $('#motivoRechazoConfirmar').val().trim();

        // Validar motivo si es RECHAZADO
        if (nombreEstado === 'RECHAZADO' && !motivoRechazo) {
            alert('Por favor ingrese el motivo del rechazo.');
            $('#motivoRechazoConfirmar').focus();
            return;
        }

        // Deshabilitar botón
        var $boton = $(this);
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Procesando...');

        // Obtener el select origen
        var $selectOrigen = $('#modalConfirmarCambioEstado').data('select-origen');

        // Actualizar estado
        $.ajax({
            url: '../admin/actualizar_estado_revision_imagen_ajax.php',
            type: 'POST',
            data: {
                cod_nota_observacion: codNotaObservacion,
                codigo_estado_revision: nuevoEstado,
                descripcion_nota_observacion: motivoRechazo
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Actualizar visualmente el select con el nuevo estado
                    if ($selectOrigen && $selectOrigen.length) {
                        $selectOrigen.val(nuevoEstado);
                        $selectOrigen.data('estado-anterior', nuevoEstado);
                    }

                    // Cerrar modal de confirmación
                    $('#modalConfirmarCambioEstado').modal('hide');

                    // Recargar imágenes para mostrar cambios
                    var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();
                    if (codInfoFacturaVenta) {
                        cargarImagenesCredito(codInfoFacturaVenta);
                    }

                    // Mostrar mensaje de éxito
                    //alert('Estado actualizado correctamente');
                } else {
                    alert('Error al actualizar: ' + (response.message || 'Error desconocido'));
                    $('#modalConfirmarCambioEstado').modal('hide');
                }
                $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Confirmar');
            },
            error: function (xhr, status, error) {
                console.error('Error al actualizar estado:', error);
                alert('Error de conexión al actualizar el estado.');
                $('#modalConfirmarCambioEstado').modal('hide');
                $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Confirmar');
            }
        });
    });

    // Reset del modal al cerrar (NO revertir el select porque se hace en el evento change)
    $('#modalConfirmarCambioEstado').on('hidden.bs.modal', function () {
        $('#motivoRechazoConfirmar').val('');
        $('#contenedorMotivoRechazo').hide();
        $('#btnConfirmarCambioEstado').prop('disabled', false).html('<i class="fa fa-check"></i> Confirmar');

        // Limpiar datos guardados
        $(this).removeData('select-origen');
        $(this).removeData('estado-anterior');
        $(this).removeData('nuevo-estado');
    });

    // Mostrar modal de confirmación al cambiar el estado de revisión
    $(document).on('change', '.select-estado-revision', function () {
        var $select = $(this);
        var nuevoEstado = $select.val();
        var estadoAnterior = $select.data('estado-anterior');
        var codNotaObservacion = $select.data('cod-nota');

        // Si no hay cambio real, no hacer nada
        if (nuevoEstado === estadoAnterior) {
            return;
        }

        // Obtener el nombre del estado seleccionado
        var nombreEstado = $select.find('option[value="' + nuevoEstado + '"]').text().replace(/^[⏱️✅❌ℹ️]\s*/, '');

        // Si es RECHAZADO, abrir modal de confirmación con motivo
        if (nombreEstado === 'RECHAZADO') {
            // Revertir al estado anterior
            $select.val(estadoAnterior);

            // Guardar valores en el modal de confirmación
            $('#codNotaObservacionConfirmar').val(codNotaObservacion);
            $('#nuevoEstadoConfirmar').val(nuevoEstado);
            $('#nombreEstadoSeleccionado').text(nombreEstado);

            // Guardar referencia al select
            $('#modalConfirmarCambioEstado').data('select-origen', $select);
            $('#modalConfirmarCambioEstado').data('estado-anterior', estadoAnterior);
            $('#modalConfirmarCambioEstado').data('nuevo-estado', nuevoEstado);

            // Mostrar campo de motivo
            $('#contenedorMotivoRechazo').show();
            $('#motivoRechazoConfirmar').val('').prop('required', true);

            // Abrir modal de confirmación
            $('#modalConfirmarCambioEstado').modal('show');
        } else {
            // Para otros estados, guardar directamente por AJAX
            $.ajax({
                url: '../admin/actualizar_estado_revision_imagen_ajax.php',
                type: 'POST',
                data: {
                    cod_nota_observacion: codNotaObservacion,
                    codigo_estado_revision: nuevoEstado,
                    descripcion_nota_observacion: ''
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Actualizar el estado anterior
                        $select.data('estado-anterior', nuevoEstado);

                        // Recargar imágenes para mostrar cambios
                        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();
                        if (codInfoFacturaVenta) {
                            cargarImagenesCredito(codInfoFacturaVenta);
                        }

                        // Mostrar modal de éxito
                        $('#toastCheckboxMessage').text('Estado actualizado correctamente');
                        $('#modalToastCheckbox').modal('show');
                        setTimeout(function() {
                            $('#modalToastCheckbox').modal('hide');
                        }, 2000);
                    } else {
                        // Revertir al estado anterior en caso de error
                        $select.val(estadoAnterior);
                        alert('Error al actualizar: ' + (response.message || 'Error desconocido'));
                    }
                },
                error: function (xhr, status, error) {
                    // Revertir al estado anterior en caso de error
                    $select.val(estadoAnterior);
                    console.error('Error al actualizar estado:', error);
                    alert('Error de conexión al actualizar el estado.');
                }
            });
        }
    });

    // Mostrar modal automáticamente si la respuesta AJAX contiene estado RECHAZADO
    function mostrarModalMotivoRechazoSiEsNecesario(nombreEstado, codNotaObservacion) {
        if (nombreEstado === 'RECHAZADO') {
            $('#codNotaObservacionRechazo').val(codNotaObservacion || '');
            $('#descripcionMotivoRechazo').val('');
            $('#modalMotivoRechazoFoto').modal('show');
        }
    }

    // Ejemplo de integración: llamar tras la respuesta AJAX que actualiza el estado de revisión
    // Suponiendo que tienes un callback de éxito como este:
    // $.ajax({ ... , success: function(resp) { ... } });
    // Debes extraer el nombre del estado y el código de nota de observación de la respuesta o del contexto
    // Por ejemplo:
    // mostrarModalMotivoRechazoSiEsNecesario(nombreEstado, codNotaObservacion);

    // Guardar motivo de rechazo
    $('#btnGuardarMotivoRechazoFoto').on('click', function () {
        var descripcion = $('#descripcionMotivoRechazo').val().trim();
        var codNotaObservacion = $('#codNotaObservacionRechazo').val();
        if (!descripcion) {
            alert('Por favor ingrese el motivo del rechazo.');
            return;
        }
        // Enviar por AJAX
        $.ajax({
            url: '../admin/guardar_motivo_rechazo_foto_ajax.php',
            type: 'POST',
            data: { descripcion_nota_observacion: descripcion, cod_nota_observacion: codNotaObservacion },
            success: function (resp) {
                $('#modalMotivoRechazoFoto').modal('hide');

                // Esperar a que se cierre el modal y luego reabrir el modal principal con datos actualizados
                setTimeout(function () {
                    if (window.modalParams && window.modalParams.cod_info_factura_venta) {
                        // Recargar las imágenes de la documentación fotográfica
                        cargarImagenesConEstados(window.modalParams.cod_info_factura_venta);
                        // Reabrir el modal de detalle de crédito
                        $('#modalDetalleCreditoRevisor').modal('show');
                    }
                }, 400);
            },
            error: function () {
                alert('Error al guardar el motivo de rechazo.');
            }
        });
    });

    // Función para formatear número con separador de miles (punto)
    function formatearNumeroConMiles(numero) {
        return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Función para quitar el formato de miles y obtener el número real
    function quitarFormatoMiles(texto) {
        return texto.replace(/\./g, "");
    }

    // Función que se llama cuando el usuario escribe en el campo formateado
    function actualizarValorCuotaReal(input) {
        // Obtener solo números del input
        var valorSinFormato = quitarFormatoMiles(input.value).replace(/[^\d]/g, "");

        // Guardar el valor real (sin formato) en el input hidden
        $('#valorPorCuota').val(valorSinFormato);

        // Mostrar el valor formateado en el input visible
        if (valorSinFormato) {
            input.value = formatearNumeroConMiles(valorSinFormato);
        } else {
            input.value = "";
        }
    }

    // Función para establecer el valor desde código (cuando se carga o calcula)
    function setValorPorCuotaFormateado(valor) {
        var valorNumerico = parseInt(valor) || 0;
        $('#valorPorCuota').val(valorNumerico);
        $('#valorPorCuotaFormateado').val(formatearNumeroConMiles(valorNumerico));
    }

    // Función que se llama cuando el usuario escribe en el campo de Valor de Contado formateado
    function actualizarValorContadoReal(input) {
        // Obtener solo números del input
        var valorSinFormato = quitarFormatoMiles(input.value).replace(/[^\d]/g, "");

        // Guardar el valor real (sin formato) en el input hidden
        $('#precio_venta_producto').val(valorSinFormato);

        // Mostrar el valor formateado en el input visible
        if (valorSinFormato) {
            input.value = formatearNumeroConMiles(valorSinFormato);
        } else {
            input.value = "";
        }

        // Llamar a calcularValorCredito después de actualizar el valor
        calcularValorCredito();
    }

    // Función para establecer el valor de contado desde código (cuando se carga)
    function setPrecioVentaProductoFormateado(valor) {
        var valorNumerico = parseInt(valor) || 0;
        $('#precio_venta_producto').val(valorNumerico);
        if (valorNumerico > 0) {
            $('#precio_venta_producto_formateado').val(formatearNumeroConMiles(valorNumerico));
        } else {
            $('#precio_venta_producto_formateado').val('');
        }
    }

    // Función que se llama cuando el usuario escribe en el campo de Valor a Crédito formateado
    function actualizarValorCreditoReal(input) {
        // Obtener solo números del input
        var valorSinFormato = quitarFormatoMiles(input.value).replace(/[^\d]/g, "");

        // Guardar el valor real (sin formato) en el input hidden
        $('#inputNuevoValorCredito').val(valorSinFormato);

        // Mostrar el valor formateado en el input visible
        if (valorSinFormato) {
            input.value = formatearNumeroConMiles(valorSinFormato);
        } else {
            input.value = "";
        }
    }

    // Función para establecer el valor de crédito desde código (cuando se abre el modal)
    function setNuevoValorCreditoFormateado(valor) {
        var valorNumerico = parseInt(valor) || 0;
        $('#inputNuevoValorCredito').val(valorNumerico);
        if (valorNumerico > 0) {
            $('#inputNuevoValorCreditoFormateado').val(formatearNumeroConMiles(valorNumerico));
        } else {
            $('#inputNuevoValorCreditoFormateado').val('');
        }
    }
</script>

<script>
    // ==================== FUNCIÓN PARA VALIDAR CAMPOS DE CRÉDITO ====================
    function validarCheckboxInfoCredito() {
        // Obtener valores de los campos
        var valorCredito = $('#modalValorCredito').text().trim();
        var valorContado = $('#modalTotalPrecioVenta').text().trim();
        var numeroCuotas = $('#modalNumeroCuotas').text().trim();
        var cuotaMensual = $('#modalMontoCuota').text().trim();
        var codEntidadCrediticia = $('#modalCodEntidadCrediticia').val();
        var codOperadorCredito = $('#modalCodOperadorCredito').val();

        // Validar que todos los campos estén llenos
        var todosCamposLlenos = (
            valorCredito && valorCredito !== '' && valorCredito !== '0' &&
            valorContado && valorContado !== '' && valorContado !== '0' &&
            numeroCuotas && numeroCuotas !== '' && numeroCuotas !== '0' &&
            cuotaMensual && cuotaMensual !== '' && cuotaMensual !== '0' &&
            codEntidadCrediticia && codEntidadCrediticia !== '0' &&
            codOperadorCredito && codOperadorCredito !== '0'
        );

        var $checkbox = $('#cod_estado_dilig_infocreditval');
        var $label = $('label[for="cod_estado_dilig_infocreditval"]');

        if (!todosCamposLlenos) {
            // Deshabilitar checkbox si los campos no están completos
            $checkbox.prop('disabled', true);
            $label.css({
                'opacity': '0.5',
                'cursor': 'not-allowed',
                'pointer-events': 'none'
            });
            
            // Si estaba marcado, desmarcarlo
            if ($checkbox.prop('checked')) {
                $checkbox.prop('checked', false);
                // Actualizar en la BD
                actualizarEstadoDiligenciamiento('cod_estado_dilig_infocreditval', '0');
            }
        } else {
            // Habilitar checkbox si todos los campos están llenos
            $checkbox.prop('disabled', false);
            $label.css({
                'opacity': '1',
                'cursor': 'pointer',
                'pointer-events': 'auto'
            });
        }
    }

    // ==================== FUNCIÓN PARA VALIDAR CAMPOS DE EQUIPO DE GESTIÓN ====================
    function validarCheckboxEquipoGestion() {
        // Obtener valores de los códigos de administradores desde las variables globales
        var codLider = window.codAdministradorLiderActual;
        var codCoordinador = window.codAdministradorCoordinadorActual;
        var codAsesor = window.codAdministradorAsesorActual;
        var codAliadoEstrategico = window.codAdministradorAliadoEstrategicoActual;
        var codRevisor = window.codAdministradorRevisorActual;

        // Validar que todos los campos estén llenos
        var todosCamposLlenos = (
            codLider && codLider !== '' && codLider !== '0' &&
            codCoordinador && codCoordinador !== '' && codCoordinador !== '0' &&
            codAsesor && codAsesor !== '' && codAsesor !== '0' &&
            codAliadoEstrategico && codAliadoEstrategico !== '' && codAliadoEstrategico !== '0' &&
            codRevisor && codRevisor !== '' && codRevisor !== '0'
        );

        var $checkbox = $('#cod_estado_dilig_infoequipogest');
        var $label = $('label[for="cod_estado_dilig_infoequipogest"]');

        if (!todosCamposLlenos) {
            // Deshabilitar checkbox si los campos no están completos
            $checkbox.prop('disabled', true);
            $label.css({
                'opacity': '0.5',
                'cursor': 'not-allowed',
                'pointer-events': 'none'
            });
            
            // Si estaba marcado, desmarcarlo
            if ($checkbox.prop('checked')) {
                $checkbox.prop('checked', false);
                // Actualizar en la BD
                actualizarEstadoDiligenciamiento('cod_estado_dilig_infoequipogest', '0');
            }
        } else {
            // Habilitar checkbox si todos los campos están llenos
            $checkbox.prop('disabled', false);
            $label.css({
                'opacity': '1',
                'cursor': 'pointer',
                'pointer-events': 'auto'
            });
        }
    }

    // Función para actualizar el estado de diligenciamiento en la BD
    function actualizarEstadoDiligenciamiento(campo, valor) {
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();
        if (!codInfoFacturaVenta) return;

        $.ajax({
            url: '../admin/actualizar_estado_diligenciamiento_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                campo: campo,
                valor: valor
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log('Estado de diligenciamiento actualizado:', campo, valor);
                }
            },
            error: function() {
                console.error('Error al actualizar estado de diligenciamiento');
            }
        });
    }

    // Función para abrir el modal con los datos del crédito
    function abrirModalDetalleCredito(cod_estado_dilig_todo, cod_estado_dilig_infocliente, cod_estado_dilig_infoproducto, cod_estado_dilig_infocreditval, cod_estado_dilig_infoequipogest, cod_estado_dilig_infocomercial, cod_estado_dilig_infodocumentfoto, nombre_estado_factura, nombres_apellidos, identificacion_tercero, monto_deuda, monto_deuda_sin_interes, monto_cuota, nombre_tipo_pago, cod_entidad_crediticia, nombre_entidad_crediticia, nombre_operador_credito, nombre_tienda, nombre_aliado, nombre_banco_cuenta, nombre_estado_facturacion, nombre_estado_revision, nombres_apellidos_asesor, observacion_tercero, fecha_formateada, hora_formateada, contanenar_nombre_producto, nombre_vendedor, cod_tercero, cod_info_factura_venta, cod_vendedor, cod_tienda, cod_banco_cuenta, numero_cuota, nombres_apellidos_lider, nombres_apellidos_coordinador, nombres_apellidos_aliado_estrategico, nombres_apellidos_revisor, cod_administrador_lider, cod_administrador_coordinador, cod_administrador_asesor, cod_administrador_aliado_estrategico, cod_administrador_revisor, cod_operador_credito, direccion_tercero, telefono1_tercero, correo_tercero) {
        document.getElementById('modalNombreCliente').textContent = nombres_apellidos;
        document.getElementById('modalCedulaCliente').textContent = identificacion_tercero;
        //document.getElementById('modalClienteIdentificacion').textContent = identificacion_tercero || 'No especificado';
        document.getElementById('modalClienteTelefono').textContent = telefono1_tercero || 'No especificado';
        document.getElementById('modalClienteCorreo').textContent = correo_tercero || 'No especificado';
        document.getElementById('modalClienteDireccion').textContent = direccion_tercero || 'No especificado';
        document.getElementById('modalValorCredito').textContent = monto_deuda;
        document.getElementById('modalTotalPrecioVenta').textContent = monto_deuda_sin_interes;
        document.getElementById('modalMontoCuota').textContent = monto_cuota; // Aquí se debe pasar el monto de la cuota
        document.getElementById('modalTipoVenta').textContent = nombre_tipo_pago;
        document.getElementById('modal_entidad_crediticia').textContent = nombre_entidad_crediticia;
        document.getElementById('modalNumeroCuotas').textContent = numero_cuota || '0';
        document.getElementById('modalTienda').textContent = nombre_tienda;
        //document.getElementById('modal_nombre_banco_cuenta').textContent = nombre_banco_cuenta;
        //document.getElementById('modalNombresApellidosVendedor').textContent = nombre_vendedor;
        document.getElementById('modalFechaCreacion').textContent = fecha_formateada;
        document.getElementById('modalHora').textContent = hora_formateada;
        document.getElementById('modalNombreProducto').textContent = contanenar_nombre_producto;
        document.getElementById('modal_observacion_tercero').textContent = observacion_tercero;
        document.getElementById('modalIDApp').textContent = cod_info_factura_venta;
        document.getElementById('modal_cod_info_factura_venta').textContent = cod_info_factura_venta;
        document.getElementById('modalCodVendedor').value = cod_vendedor;
        document.getElementById('modalCodEntidadCrediticia').value = cod_entidad_crediticia;
        document.getElementById('modalCodTienda').value = cod_tienda;
        document.getElementById('modalCodBancoCuenta').value = cod_banco_cuenta;
        document.getElementById('modalCodOperadorCredito').value = cod_operador_credito;
        document.getElementById('modalCodInfoFacturaVenta').value = cod_info_factura_venta;
        document.getElementById('modalCodTercero').value = cod_tercero;

        // Guardar todos los parámetros en variables globales para poder reabrir el modal
        window.modalParams = {
            cod_estado_dilig_todo: cod_estado_dilig_todo,
            cod_estado_dilig_infocliente: cod_estado_dilig_infocliente,
            cod_estado_dilig_infoproducto: cod_estado_dilig_infoproducto,
            cod_estado_dilig_infocreditval: cod_estado_dilig_infocreditval,
            cod_estado_dilig_infoequipogest: cod_estado_dilig_infoequipogest,
            cod_estado_dilig_infocomercial: cod_estado_dilig_infocomercial,
            cod_estado_dilig_infodocumentfoto: cod_estado_dilig_infodocumentfoto,
            nombre_estado_factura: nombre_estado_factura,
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
            cod_operador_credito: cod_operador_credito,
            numero_cuota: numero_cuota,
            nombres_apellidos_lider: nombres_apellidos_lider,
            nombres_apellidos_coordinador: nombres_apellidos_coordinador,
            nombres_apellidos_aliado_estrategico: nombres_apellidos_aliado_estrategico,
            nombres_apellidos_revisor: nombres_apellidos_revisor,
            cod_administrador_lider: cod_administrador_lider,
            cod_administrador_coordinador: cod_administrador_coordinador,
            cod_administrador_asesor: cod_administrador_asesor,
            cod_administrador_aliado_estrategico: cod_administrador_aliado_estrategico,
            cod_administrador_revisor: cod_administrador_revisor,
            direccion_tercero: direccion_tercero,
            telefono1_tercero: telefono1_tercero,
            correo_tercero: correo_tercero
        };
        // Guardar códigos de administradores en variables globales para los modales
        window.codAdministradorLiderActual = cod_administrador_lider;
        window.codAdministradorCoordinadorActual = cod_administrador_coordinador;
        window.codAdministradorAsesorActual = cod_administrador_asesor;
        window.codAdministradorAliadoEstrategicoActual = cod_administrador_aliado_estrategico;
        window.codAdministradorRevisorActual = cod_administrador_revisor;

        // Asignar equipo de gestión
        document.getElementById('modalLider').textContent = nombres_apellidos_lider || 'No asignado';
        document.getElementById('modalCoordinador').textContent = nombres_apellidos_coordinador || 'No asignado';
        document.getElementById('modalAsesor').textContent = nombres_apellidos_asesor || 'No asignado';
        document.getElementById('modalAliadoEstrategico').textContent = nombres_apellidos_aliado_estrategico || 'No asignado';
        document.getElementById('modalRevisor').textContent = nombres_apellidos_revisor || 'No asignado';

        // Asignar información comercial
        document.getElementById('modalTienda').textContent = nombre_tienda || 'No asignado';
        document.getElementById('modalVendedor').textContent = nombre_vendedor || 'No asignado';
        document.getElementById('modalBancoCuenta').textContent = nombre_banco_cuenta || 'No asignado';
        document.getElementById('modalOperadorCredito').textContent = nombre_operador_credito || 'No asignado';

        console.log('Abrir modal detalle crédito revisor:', { codInfoFacturaVenta: cod_info_factura_venta, codTercero: cod_tercero, numeroCuota: numero_cuota });

        // Configurar estados de diligenciamiento recibidos como parámetros
        $('#cod_estado_dilig_infocliente').prop('checked', cod_estado_dilig_infocliente === '1');
        $('#cod_estado_dilig_infoproducto').prop('checked', cod_estado_dilig_infoproducto === '1');
        $('#cod_estado_dilig_infocreditval').prop('checked', cod_estado_dilig_infocreditval === '1');
        $('#cod_estado_dilig_infoequipogest').prop('checked', cod_estado_dilig_infoequipogest === '1');
        $('#cod_estado_dilig_infocomercial').prop('checked', cod_estado_dilig_infocomercial === '1');
        $('#cod_estado_dilig_infodocumentfoto').prop('checked', cod_estado_dilig_infodocumentfoto === '1');

        // Deshabilitar inicialmente el checkbox de documentación fotográfica
        // Se habilitará automáticamente si todas las imágenes obligatorias están aceptadas
        var $checkboxDocFoto = $('#cod_estado_dilig_infodocumentfoto');
        var $labelDocFoto = $checkboxDocFoto.next('.switch-slider');
        $checkboxDocFoto.prop('disabled', true);
        $labelDocFoto.css({
            'cursor': 'not-allowed',
            'opacity': '0.5'
        });

        // Validar y controlar el checkbox de información de crédito
        validarCheckboxInfoCredito();
        
        // Validar y controlar el checkbox de equipo de gestión
        validarCheckboxEquipoGestion();

        // Verificar si todos están completos para habilitar botón de aprobar
        var todosCompletos = (cod_estado_dilig_infocliente === '1' && cod_estado_dilig_infoproducto === '1' && cod_estado_dilig_infocreditval === '1' && cod_estado_dilig_infoequipogest === '1' && cod_estado_dilig_infocomercial === '1' && cod_estado_dilig_infodocumentfoto === '1');

        // Mostrar/ocultar el botón "Aprobar Venta" según el estado del diligenciamiento y el estado de la factura
        if ((cod_estado_dilig_todo === '1' || todosCompletos) && nombre_estado_factura !== 'CERRADA') {
            $('#contenedorBotonAprobarVenta').show();
            console.log('Botón Aprobar Venta mostrado - Diligenciamiento completo al abrir modal');
        } else {
            $('#contenedorBotonAprobarVenta').hide();
            if (nombre_estado_factura === 'CERRADA') {
                console.log('Botón Aprobar Venta oculto - Estado de factura: CERRADA');
            } else {
                console.log('Botón Aprobar Venta oculto - Diligenciamiento incompleto al abrir modal');
            }
        }

        // Mostrar/ocultar el botón "Ver Factura de Venta" según el estado de la factura
        if (nombre_estado_factura === 'CERRADA') {
            var urlFactura = '../admin/ver_factura_venta_siscredito_visitante_intern_pdf.php?cod_info_factura_venta=' + cod_info_factura_venta;
            $('#btnVerFacuraVenta').attr('onclick', "window.open('" + urlFactura + "', '_blank')");
            $('#contenedorBotonVerFacuraVenta').show();
            console.log('Botón Ver Factura de Venta mostrado - Estado: CERRADA');
        } else {
            $('#contenedorBotonVerFacuraVenta').hide();
            console.log('Botón Ver Factura de Venta oculto - Estado:', nombre_estado_factura);
        }

        // Actualizar botón de aprobar venta
        actualizarBotonAprobarVenta(todosCompletos);

        // Cargar imágenes adjuntas
        cargarImagenesCredito(cod_info_factura_venta);

        // Cargar historial de notificaciones
        cargarHistorialNotificaciones(cod_info_factura_venta);

        // Cargar comprobante de pago
        cargarComprobanteActualRevisor(cod_info_factura_venta);

        // Mostrar modal
        $('#modalDetalleCreditoRevisor').modal('show');
    }

    // ==================== FUNCIÓN PARA ACTUALIZAR CHECKBOXES DESDE BD ====================
    // Esta función consulta la base de datos para obtener el estado real de los checkboxes
    function actualizarCheckboxesDesdeBD(codInfoFacturaVenta) {
        if (!codInfoFacturaVenta) {
            console.error('No se proporcionó cod_info_factura_venta para actualizar checkboxes');
            return;
        }

        $.ajax({
            url: '../admin/obtener_estados_diligenciamiento_ajax.php',
            type: 'POST',
            data: { cod_info_factura_venta: codInfoFacturaVenta },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.estados) {
                    var estados = response.estados;

                    // Actualizar los checkboxes con los valores reales de la BD
                    $('#cod_estado_dilig_infocliente').prop('checked', estados.cod_estado_dilig_infocliente === '1');
                    $('#cod_estado_dilig_infoproducto').prop('checked', estados.cod_estado_dilig_infoproducto === '1');
                    $('#cod_estado_dilig_infocreditval').prop('checked', estados.cod_estado_dilig_infocreditval === '1');
                    $('#cod_estado_dilig_infoequipogest').prop('checked', estados.cod_estado_dilig_infoequipogest === '1');
                    $('#cod_estado_dilig_infocomercial').prop('checked', estados.cod_estado_dilig_infocomercial === '1');
                    $('#cod_estado_dilig_infodocumentfoto').prop('checked', estados.cod_estado_dilig_infodocumentfoto === '1');

                    // Actualizar también window.modalParams para mantener sincronizado
                    if (window.modalParams) {
                        window.modalParams.cod_estado_dilig_todo = estados.cod_estado_dilig_todo;
                        window.modalParams.cod_estado_dilig_infocliente = estados.cod_estado_dilig_infocliente;
                        window.modalParams.cod_estado_dilig_infoproducto = estados.cod_estado_dilig_infoproducto;
                        window.modalParams.cod_estado_dilig_infocreditval = estados.cod_estado_dilig_infocreditval;
                        window.modalParams.cod_estado_dilig_infoequipogest = estados.cod_estado_dilig_infoequipogest;
                        window.modalParams.cod_estado_dilig_infocomercial = estados.cod_estado_dilig_infocomercial;
                        window.modalParams.cod_estado_dilig_infodocumentfoto = estados.cod_estado_dilig_infodocumentfoto;
                    }

                    // Verificar si todos están completos para habilitar botón de aprobar
                    var todosCompletos = (estados.cod_estado_dilig_infocliente === '1' &&
                        estados.cod_estado_dilig_infoproducto === '1' &&
                        estados.cod_estado_dilig_infocreditval === '1' &&
                        estados.cod_estado_dilig_infoequipogest === '1' &&
                        estados.cod_estado_dilig_infocomercial === '1' &&
                        estados.cod_estado_dilig_infodocumentfoto === '1');

                    // Mostrar/ocultar el botón "Aprobar Venta"
                    if (estados.cod_estado_dilig_todo === '1' || todosCompletos) {
                        $('#contenedorBotonAprobarVenta').show();
                    } else {
                        $('#contenedorBotonAprobarVenta').hide();
                    }

                    // Actualizar botón de aprobar venta
                    if (typeof actualizarBotonAprobarVenta === 'function') {
                        actualizarBotonAprobarVenta(todosCompletos);
                    }

                    console.log('Checkboxes actualizados desde BD:', estados);
                } else {
                    console.error('Error al obtener estados:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error AJAX al obtener estados de diligenciamiento:', error);
            }
        });
    }

    // ==================== FUNCIONES PARA CREAR NOTIFICACIÓN ====================

    // Función para abrir modal de crear notificación
    function abrirModalCrearNotificacion(codInfoFacturaVenta, origen_boton) {

        // Limpiar formulario
        document.getElementById('inputNombreNotificacion').value = '';
        document.getElementById('textareaDescripcionNotificacion').value = '';
        document.getElementById('origen_boton').value = origen_boton;

        //document.getElementById('selectTipoNotificacion').value = '';
        $('#alertaCrearNotificacion').hide();
        $('#btnGuardarNotificacion').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Notificación');

        // Establecer el cod_info_factura_venta
        if (codInfoFacturaVenta) {
            document.getElementById('modalCodInfoFacturaVenta').value = codInfoFacturaVenta;
        } else if (window.modalParams && window.modalParams.cod_info_factura_venta) {
            document.getElementById('modalCodInfoFacturaVenta').value = window.modalParams.cod_info_factura_venta;
        }
        // Cerrar modal principal y abrir el de crear notificación
        if (origen_boton == 'modal') {
            $('#modalDetalleCreditoRevisor').modal('hide');
        }
        setTimeout(function () { $('#modalCrearNotificacion').modal('show'); }, 500);
    }

    // Función para guardar la notificación
    function guardarNotificacion() {
        var codInfoFacturaVenta = document.getElementById('modalCodInfoFacturaVenta').value;
        var nombreNotificacion = document.getElementById('inputNombreNotificacion').value.trim();
        var descripcionNotificacion = document.getElementById('textareaDescripcionNotificacion').value.trim();
        var codTipoNotificacion = document.getElementById('cod_tipo_notificacion_alerta').value;
        var origen_boton = document.getElementById('origen_boton').value;

        //var codTipoNotificacion = 0;

        // Validaciones
        if (!descripcionNotificacion) {
            $('#alertaCrearNotificacion').removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> La descripción de la notificación es requerida')
                .show();
            return;
        }
        /*
        if (!codTipoNotificacion) {
            $('#alertaCrearNotificacion').removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> Debe seleccionar un tipo de notificación')
                .show();
            return;
        }
        -*/
        if (!codInfoFacturaVenta) {
            $('#alertaCrearNotificacion').removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> No se pudo identificar la factura')
                .show();
            return;
        }

        // Deshabilitar botón mientras se procesa
        var $boton = $('#btnGuardarNotificacion');
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

        // Enviar datos por AJAX
        $.ajax({
            url: '../admin/crear_notificacion_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                nombre_notificacion_alerta_renovacion: nombreNotificacion,
                descripcion_notificacion_alerta_renovacion: descripcionNotificacion,
                cod_tipo_notificacion_alerta: codTipoNotificacion
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Mostrar mensaje de éxito
                    $('#alertaCrearNotificacion').removeClass('alert-danger').addClass('alert-success')
                        .html('<i class="fa fa-check-circle"></i> <strong>¡Éxito!</strong> Notificación creada exitosamente')
                        .show();

                    // Recargar historial de notificaciones
                    cargarHistorialNotificaciones(codInfoFacturaVenta);

                    // Después de 2 segundos, cerrar modal y volver al anterior
                    if (origen_boton == 'modal') {
                        setTimeout(function () {
                            $('#modalCrearNotificacion').modal('hide');
                            setTimeout(function () { $('#modalDetalleCreditoRevisor').modal('show'); }, 300);
                        }, 2000);
                    } else {
                        setTimeout(function () { $('#modalCrearNotificacion').modal('hide'); }, 300);
                    }
                } else {
                    $('#alertaCrearNotificacion').removeClass('alert-success').addClass('alert-danger')
                        .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> ' + (response.message || 'Error desconocido'))
                        .show();
                    $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Notificación');
                }
            },
            error: function (xhr, status, error) {
                $('#alertaCrearNotificacion').removeClass('alert-success').addClass('alert-danger')
                    .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> Error de conexión al guardar la notificación')
                    .show();
                $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Notificación');
            }
        });
    }

    // Event handler para el botón de guardar notificación
    $(document).on('click', '#btnGuardarNotificacion', function () {
        guardarNotificacion();
    });

    // Event handler para el botón "Cancelar" - volver al modal anterior
    $(document).on('click', '#modalCrearNotificacion .btn[data-dismiss="modal"]', function () {
        $('#modalCrearNotificacion').modal('hide');
        setTimeout(function () {
            $('#modalDetalleCreditoRevisor').modal('show');
        }, 300);
    });

    // Reset del modal al cerrar
    $('#modalCrearNotificacion').on('hidden.bs.modal', function () {
        document.getElementById('inputNombreNotificacion').value = '';
        document.getElementById('textareaDescripcionNotificacion').value = '';
        document.getElementById('origen_boton').value = '';
        // Comentado porque el campo está comentado en el HTML
        // document.getElementById('selectTipoNotificacion').value = '';
        $('#alertaCrearNotificacion').hide();
        $('#btnGuardarNotificacion').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Notificación');
    });

    // ==================== FIN FUNCIONES CREAR NOTIFICACIÓN ====================

    // Función para abrir modal de editar información del cliente
    function abrirModalEditarInfoCliente() {
        // Obtener datos del tercero desde los campos del modal principal
        var cod_tercero = document.getElementById('modalCodTercero').value;
        var cod_info_factura_venta = document.getElementById('modalCodInfoFacturaVenta').value;
        var nombres_apellidos = document.getElementById('modalNombreCliente').textContent;
        var identificacion = document.getElementById('modalCedulaCliente').textContent;
        var telefono = document.getElementById('modalClienteTelefono').textContent;
        var correo = document.getElementById('modalClienteCorreo').textContent;
        var direccion = document.getElementById('modalClienteDireccion').textContent;

        // Separar nombres y apellidos (asumiendo formato: Nombre1 Nombre2 Apellido1 Apellido2)
        var partesNombre = nombres_apellidos.trim().split(' ');
        var nombre1 = partesNombre[0] || '';
        var nombre2 = partesNombre[1] || '';
        var apellido1 = partesNombre[2] || '';
        var apellido2 = partesNombre[3] || '';

        // Si solo hay 3 partes, ajustar (Nombre1 Apellido1 Apellido2)
        if (partesNombre.length === 3) {
            nombre2 = '';
            apellido1 = partesNombre[1] || '';
            apellido2 = partesNombre[2] || '';
        }

        // Llenar el formulario con los datos actuales
        document.getElementById('edit_cod_tercero').value = cod_tercero;
        document.getElementById('edit_cod_info_factura_venta').value = cod_info_factura_venta;
        document.getElementById('edit_identificacion_tercero').value = identificacion !== 'No especificado' ? identificacion : '';
        document.getElementById('edit_nombre1_tercero').value = nombre1;
        document.getElementById('edit_nombre2_tercero').value = nombre2;
        document.getElementById('edit_apellido1_tercero').value = apellido1;
        document.getElementById('edit_apellido2_tercero').value = apellido2;
        document.getElementById('edit_telefono1_tercero').value = telefono !== 'No especificado' ? telefono : '';
        document.getElementById('edit_correo_tercero').value = correo !== 'No especificado' ? correo : '';
        document.getElementById('edit_direccion_tercero').value = direccion !== 'No especificado' ? direccion : '';

        // Cerrar el modal principal y abrir el de edición
        $('#modalDetalleCreditoRevisor').modal('hide');
        setTimeout(function () {
            $('#modalEditarInfoCliente').modal('show');
        }, 500);
    }

    // Función para guardar la información del cliente
    function guardarInfoCliente() {
        // Validar campos requeridos
        var identificacion = document.getElementById('edit_identificacion_tercero').value.trim();
        var nombre1 = document.getElementById('edit_nombre1_tercero').value.trim();
        var apellido1 = document.getElementById('edit_apellido1_tercero').value.trim();
        var telefono = document.getElementById('edit_telefono1_tercero').value.trim();

        if (!identificacion || !nombre1 || !apellido1 || !telefono) {
            var mensajeDiv = document.getElementById('mensajeEdicionCliente');
            var textoMensaje = document.getElementById('textoMensajeEdicion');
            var iconoMensaje = mensajeDiv.querySelector('.fa');

            mensajeDiv.style.display = 'block';
            mensajeDiv.style.backgroundColor = '#f56565';
            mensajeDiv.style.color = 'white';
            iconoMensaje.className = 'fa fa-exclamation-triangle';
            textoMensaje.textContent = 'Por favor complete todos los campos obligatorios (*)';
            return;
        }

        // Obtener todos los datos del formulario
        var formData = {
            cod_tercero: document.getElementById('edit_cod_tercero').value,
            cod_info_factura_venta: document.getElementById('edit_cod_info_factura_venta').value,
            identificacion_tercero: identificacion,
            nombre1_tercero: nombre1,
            nombre2_tercero: document.getElementById('edit_nombre2_tercero').value.trim(),
            apellido1_tercero: apellido1,
            apellido2_tercero: document.getElementById('edit_apellido2_tercero').value.trim(),
            telefono1_tercero: telefono,
            correo_tercero: document.getElementById('edit_correo_tercero').value.trim(),
            direccion_tercero: document.getElementById('edit_direccion_tercero').value.trim()
        };

        // Deshabilitar botón para evitar doble clic
        var btnGuardar = document.getElementById('btnGuardarInfoCliente');
        btnGuardar.disabled = true;
        btnGuardar.innerHTML = '<i class="fa fa-spinner fa-spin" style="color: white !important;"></i> Guardando...';

        // Enviar datos por AJAX
        $.ajax({
            url: 'guardar_info_cliente_ajax.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                // Rehabilitar botón
                btnGuardar.disabled = false;
                btnGuardar.innerHTML = '<i class="fa fa-save" style="font-size: 1.4rem; color: white !important;"></i> Guardar Cambios';

                if (response.success) {
                    // Construir el nombre completo
                    var nombreCompleto = formData.nombre1_tercero + ' ' + formData.nombre2_tercero + ' ' + formData.apellido1_tercero + ' ' + formData.apellido2_tercero;
                    nombreCompleto = nombreCompleto.replace(/\s+/g, ' ').trim();

                    // Mostrar mensaje de éxito
                    var mensajeDiv = document.getElementById('mensajeEdicionCliente');
                    var textoMensaje = document.getElementById('textoMensajeEdicion');
                    var iconoMensaje = mensajeDiv.querySelector('.fa');

                    mensajeDiv.style.display = 'block';
                    mensajeDiv.style.backgroundColor = '#48bb78';
                    mensajeDiv.style.color = 'white';
                    iconoMensaje.className = 'fa fa-check-circle';
                    textoMensaje.textContent = 'Información del cliente actualizada correctamente';

                    // Recargar la tabla
                    load(1);

                    // Cerrar modal y reabrir modal principal con datos actualizados
                    setTimeout(function () {
                        $('#modalEditarInfoCliente').modal('hide');
                        // Limpiar cualquier backdrop residual
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        setTimeout(function () {
                            if (window.modalParams) {
                                // Actualizar los valores en modalParams con los nuevos datos
                                window.modalParams.nombres_apellidos = nombreCompleto;
                                window.modalParams.identificacion_tercero = formData.identificacion_tercero;
                                window.modalParams.direccion_tercero = formData.direccion_tercero;
                                window.modalParams.telefono1_tercero = formData.telefono1_tercero;
                                window.modalParams.correo_tercero = formData.correo_tercero;

                                // Reabrir el modal de detalle con los parámetros actualizados
                                abrirModalDetalleCredito(
                                    window.modalParams.cod_estado_dilig_todo,
                                    window.modalParams.cod_estado_dilig_infocliente,
                                    window.modalParams.cod_estado_dilig_infoproducto,
                                    window.modalParams.cod_estado_dilig_infocreditval,
                                    window.modalParams.cod_estado_dilig_infoequipogest,
                                    window.modalParams.cod_estado_dilig_infocomercial,
                                    window.modalParams.cod_estado_dilig_infodocumentfoto,
                                    window.modalParams.nombre_estado_factura,

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
                                    window.modalParams.numero_cuota,
                                    window.modalParams.nombres_apellidos_lider,
                                    window.modalParams.nombres_apellidos_coordinador,
                                    window.modalParams.nombres_apellidos_aliado_estrategico,
                                    window.modalParams.nombres_apellidos_revisor,
                                    window.modalParams.cod_administrador_lider,
                                    window.modalParams.cod_administrador_coordinador,
                                    window.modalParams.cod_administrador_asesor,
                                    window.modalParams.cod_administrador_aliado_estrategico,
                                    window.modalParams.cod_administrador_revisor,
                                    window.modalParams.cod_operador_credito,
                                    window.modalParams.direccion_tercero,
                                    window.modalParams.telefono1_tercero,
                                    window.modalParams.correo_tercero
                                );
                                // Actualizar checkboxes desde la BD después de reabrir el modal
                                setTimeout(function () {
                                    actualizarCheckboxesDesdeBD(window.modalParams.cod_info_factura_venta);
                                }, 200);
                            }
                        }, 500);
                    }, 2000);
                } else {
                    // Mostrar mensaje de error
                    var mensajeDiv = document.getElementById('mensajeEdicionCliente');
                    var textoMensaje = document.getElementById('textoMensajeEdicion');
                    var iconoMensaje = mensajeDiv.querySelector('.fa');

                    mensajeDiv.style.display = 'block';
                    mensajeDiv.style.backgroundColor = '#f56565';
                    mensajeDiv.style.color = 'white';
                    iconoMensaje.className = 'fa fa-exclamation-circle';
                    textoMensaje.textContent = 'Error al guardar: ' + (response.message || 'Error desconocido');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error AJAX:', error);

                // Rehabilitar botón
                btnGuardar.disabled = false;
                btnGuardar.innerHTML = '<i class="fa fa-save" style="font-size: 1.4rem; color: white !important;"></i> Guardar Cambios';

                // Mostrar mensaje de error
                var mensajeDiv = document.getElementById('mensajeEdicionCliente');
                var textoMensaje = document.getElementById('textoMensajeEdicion');
                var iconoMensaje = mensajeDiv.querySelector('.fa');

                mensajeDiv.style.display = 'block';
                mensajeDiv.style.backgroundColor = '#f56565';
                mensajeDiv.style.color = 'white';
                iconoMensaje.className = 'fa fa-exclamation-triangle';
                textoMensaje.textContent = 'Error al guardar la información. Por favor intente nuevamente.';

                // Desplazar al inicio del modal para que se vea el mensaje
                document.querySelector('#modalEditarInfoCliente .modal-body').scrollTop = 0;
            },
            complete: function () {
                // Rehabilitar botón
                btnGuardar.disabled = false;
                btnGuardar.innerHTML = '<i class="fa fa-save"></i> Guardar Cambios';
            }
        });
    }

    // Funciones para abrir modales de cambio de equipo de gestión
    function abrirModalCambiarLider() { cargarAdministradoresPorSeguridad('selectNuevoLider', window.codAdministradorLiderActual); $('#modalCambiarLider').modal('show'); }
    function abrirModalCambiarCoordinador() { cargarAdministradoresPorSeguridad('selectNuevoCoordinador', window.codAdministradorCoordinadorActual); $('#modalCambiarCoordinador').modal('show'); }
    function abrirModalCambiarAsesor() { cargarAdministradoresPorSeguridad('selectNuevoAsesor', window.codAdministradorAsesorActual); $('#modalCambiarAsesor').modal('show'); }
    function abrirModalCambiarAliadoEstrategico() { cargarAdministradoresPorSeguridad('selectNuevoAliadoEstrategico', window.codAdministradorAliadoEstrategicoActual); $('#modalCambiarAliadoEstrategico').modal('show'); }
    function abrirModalCambiarRevisor() { cargarAdministradoresPorSeguridad('selectNuevoRevisor', window.codAdministradorRevisorActual); $('#modalCambiarRevisor').modal('show'); }

    // Funciones para abrir modales de información comercial
    function abrirModalCambiarTienda() {
        $('#modalCambiarTienda').modal('show');
        var codAliadoEstrategico = window.modalParams.cod_administrador_aliado_estrategico;
        cargarTiendasPorAliado('selectNuevaTienda', window.modalParams.cod_tienda, codAliadoEstrategico);
    }

    function abrirModalCambiarVendedor() {
        $('#modalCambiarVendedor').modal('show');
        var codAliadoEstrategico = window.modalParams.cod_administrador_aliado_estrategico;
        cargarVendedoresPorAliado('selectNuevoVendedor', window.modalParams.cod_vendedor, codAliadoEstrategico);
    }

    function abrirModalCambiarBancoCuenta() {
        $('#modalCambiarBancoCuenta').modal('show');
        var codAliadoEstrategico = window.modalParams.cod_administrador_aliado_estrategico;
        cargarBancosCuentaPorAliado('selectNuevaBancoCuenta', window.modalParams.cod_banco_cuenta, codAliadoEstrategico);
    }

    function abrirModalCambiarOperadorCredito() {
        $('#modalCambiarOperadorCredito').modal('show');
        cargarOperadoresCredito('selectNuevoOperadorCredito', window.modalParams.cod_operador_credito);
    }

    // Función para abrir modal de editar producto
    function abrirModalEditarProducto() {
        console.log('Abriendo modal editar producto');

        if (!window.modalParams) {
            console.error('No hay modalParams disponibles');
            return;
        }

        // Obtener información del producto desde modalParams
        var nombreProducto = window.modalParams.contanenar_nombre_producto || '';
        var codInfoFacturaVenta = window.modalParams.cod_info_factura_venta;

        // Hacer AJAX para obtener datos detallados del producto
        $.ajax({
            url: '../admin/obtener_datos_producto_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta
            },
            dataType: 'json',
            success: function (response) {
                if (response && response.success) {
                    var producto = response.data;

                    // Llenar campos del formulario
                    $('#editProductoCodProducto').val(producto.cod_producto);
                    $('#editProductoCodCategoria').val(producto.cod_categoria);
                    $('#editProductoCodigoBarra').val(producto.cod_producto_barra);
                    $('#editProductoNombre').val(producto.nombre_producto);

                    // Mostrar/ocultar campos según categoría
                    if (producto.cod_categoria == '2') {
                        // Es celular, mostrar campos IMEI
                        $('#camposCelulares').show();
                        $('#editProductoSerial1').val(producto.serial1_producto);
                        $('#editProductoSerial2').val(producto.serial2_producto);
                    } else {
                        // No es celular, ocultar campos IMEI
                        $('#camposCelulares').hide();
                        $('#editProductoSerial1').val('');
                        $('#editProductoSerial2').val('');
                    }

                    // Limpiar alertas
                    $('#alertaEditarProducto').hide().removeClass('alert-danger alert-success');
                    $('#btnGuardarProducto').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');

                    // Cerrar modal principal y abrir modal de editar
                    $('#modalDetalleCreditoRevisor').modal('hide');
                    setTimeout(function () {
                        $('#modalEditarProducto').modal('show');
                    }, 500);

                } else {
                    console.error('Error al obtener datos del producto:', response.message);
                    alert('Error al cargar los datos del producto: ' + (response.message || 'Error desconocido'));
                }
            },
            error: function (xhr, status, error) {
                console.error('Error AJAX al obtener datos del producto:', error);
                alert('Error al cargar los datos del producto. Por favor intente nuevamente.');
            }
        });
    }
    // Función para cargar administradores según cod_seguridad
    function cargarAdministradoresPorSeguridad(selectId, valorActual) {
        var select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Cargando...</option>';

        $.ajax({
            url: '../admin/obtener_equipo_gestion_ajax.php',
            type: 'POST',
            data: { tipo_equipo_gestion: selectId, valor_actual: valorActual },
            dataType: 'json',
            success: function (response) {
                if (response.ok_ajax === 'SI') {
                    select.innerHTML = '<option value="">-- Seleccione --</option>';
                    response.administradores.forEach(function (admin) {
                        var option = document.createElement('option');
                        option.value = admin.cod_administrador;
                        option.textContent = admin.nombres + ' ' + admin.apellidos + ' | ' + admin.cuenta;
                        // Preseleccionar el valor actual
                        if (valorActual && admin.cod_administrador == valorActual) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                } else {
                    select.innerHTML = '<option value="">Error al cargar</option>';
                }
            },
            error: function () {
                select.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    }
    // Funciones para guardar cambios del equipo de gestión
    function guardarCambioLider() { guardarCambioEquipo('cod_administrador_lider', 'selectNuevoLider', 'modalCambiarLider', 'Líder', 'alertaLider', 'btnGuardarLider'); }
    function guardarCambioCoordinador() { guardarCambioEquipo('cod_administrador_coordinador', 'selectNuevoCoordinador', 'modalCambiarCoordinador', 'Coordinador', 'alertaCoordinador', 'btnGuardarCoordinador'); }
    function guardarCambioAsesor() { guardarCambioEquipo('cod_administrador_asesor', 'selectNuevoAsesor', 'modalCambiarAsesor', 'Asesor', 'alertaAsesor', 'btnGuardarAsesor'); }
    function guardarCambioAliadoEstrategico() { guardarCambioEquipo('cod_administrador_aliado_estrategico', 'selectNuevoAliadoEstrategico', 'modalCambiarAliadoEstrategico', 'Aliado Estratégico', 'alertaAliadoEstrategico', 'btnGuardarAliadoEstrategico'); }
    function guardarCambioRevisor() { guardarCambioEquipo('cod_administrador_revisor', 'selectNuevoRevisor', 'modalCambiarRevisor', 'Revisor', 'alertaRevisor', 'btnGuardarRevisor'); }

    // Funciones para cargar datos de información comercial
    function cargarTiendasPorAliado(selectId, valorActual, codAliadoEstrategico) {
        var select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Cargando...</option>';

        $.ajax({
            url: '../admin/obtener_tiendas_por_aliado_ajax.php',
            type: 'POST',
            data: { cod_aliado_estrategico: codAliadoEstrategico },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.tiendas) {
                    select.innerHTML = '<option value="">-- Seleccione --</option>';
                    response.tiendas.forEach(function (tienda) {
                        var option = document.createElement('option');
                        option.value = tienda.cod_tienda;
                        option.textContent = tienda.nombre_tienda + ' | ' + tienda.cod_tienda;
                        if (valorActual && tienda.cod_tienda == valorActual) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                } else {
                    select.innerHTML = '<option value="">Error al cargar</option>';
                }
            },
            error: function () {
                select.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    }

    function cargarVendedoresPorAliado(selectId, valorActual, codAliadoEstrategico) {
        var select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Cargando...</option>';

        $.ajax({
            url: '../admin/obtener_vendedores_por_aliado_ajax.php',
            type: 'POST',
            data: { cod_aliado_estrategico: codAliadoEstrategico },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.vendedores) {
                    select.innerHTML = '<option value="">-- Seleccione --</option>';
                    response.vendedores.forEach(function (vendedor) {
                        var option = document.createElement('option');
                        option.value = vendedor.cod_administrador;
                        option.textContent = vendedor.nombres_apellidos_tercero + ' | CC: ' + vendedor.identificacion_tercero;
                        if (valorActual && vendedor.cod_administrador == valorActual) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                } else {
                    select.innerHTML = '<option value="">Sin vendedores disponibles</option>';
                }
            },
            error: function () {
                select.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    }

    function cargarVendedoresPorTienda(selectId, valorActual, codTienda) {
        var select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Cargando...</option>';

        $.ajax({
            url: '../admin/obtener_vendedores_por_tienda_ajax.php',
            type: 'POST',
            data: { cod_tienda: codTienda },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.vendedores) {
                    select.innerHTML = '<option value="">-- Seleccione --</option>';
                    response.vendedores.forEach(function (vendedor) {
                        var option = document.createElement('option');
                        option.value = vendedor.cod_vendedor;
                        option.textContent = vendedor.nombres + ' ' + vendedor.apellidos + ' | ' + vendedor.cod_vendedor;
                        if (valorActual && vendedor.cod_vendedor == valorActual) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                } else {
                    select.innerHTML = '<option value="">Error al cargar</option>';
                }
            },
            error: function () {
                select.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    }

    function cargarBancosCuentaPorAliado(selectId, valorActual, codAliadoEstrategico) {
        var select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Cargando...</option>';

        $.ajax({
            url: '../admin/obtener_bancos_cuenta_por_aliado_ajax.php',
            type: 'POST',
            data: { cod_aliado_estrategico: codAliadoEstrategico },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.bancos) {
                    select.innerHTML = '<option value="">-- Seleccione --</option>';
                    response.bancos.forEach(function (banco) {
                        var option = document.createElement('option');
                        option.value = banco.cod_banco_cuenta;
                        option.textContent = banco.nombre_banco_cuenta + ' | ' + banco.numero_banco_cuenta + ' | ' + banco.nombre_titular_cuenta;
                        if (valorActual && banco.cod_banco_cuenta == valorActual) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                } else {
                    select.innerHTML = '<option value="">Error al cargar</option>';
                }
            },
            error: function () {
                select.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    }

    // Función para cargar operadores de crédito
    function cargarOperadoresCredito(selectId, valorActual) {
        var select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Cargando...</option>';

        $.ajax({
            url: '../admin/obtener_operadores_credito_ajax.php',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.success && response.operadores) {
                    select.innerHTML = '<option value="">-- Seleccione --</option>';
                    response.operadores.forEach(function (operador) {
                        var option = document.createElement('option');
                        option.value = operador.cod_operador_credito;
                        option.textContent = operador.nombre_operador_credito;
                        if (valorActual && operador.cod_operador_credito == valorActual) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                } else {
                    select.innerHTML = '<option value="">Error al cargar</option>';
                }
            },
            error: function () {
                select.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    }

    // Funciones para guardar cambios de información comercial
    function guardarCambioTienda() { guardarCambioEquipo('cod_tienda', 'selectNuevaTienda', 'modalCambiarTienda', 'Tienda', 'alertaTienda', 'btnGuardarTienda'); }
    function guardarCambioVendedor() { guardarCambioEquipo('cod_vendedor', 'selectNuevoVendedor', 'modalCambiarVendedor', 'Vendedor', 'alertaVendedor', 'btnGuardarVendedor'); }
    function guardarCambioBancoCuenta() { guardarCambioEquipo('cod_banco_cuenta', 'selectNuevaBancoCuenta', 'modalCambiarBancoCuenta', 'Cuenta de Banco', 'alertaBancoCuenta', 'btnGuardarBancoCuenta'); }
    function guardarCambioOperadorCredito() { guardarCambioEquipo('cod_operador_credito', 'selectNuevoOperadorCredito', 'modalCambiarOperadorCredito', 'Operador de Crédito', 'alertaOperadorCredito', 'btnGuardarOperadorCredito'); }

    // ==================== FUNCIONES PARA EDITAR OBSERVACIÓN ====================

    // Función para abrir el modal de editar observación
    function abrirModalEditarObservacion() {
        var observacionActual = document.getElementById('modal_observacion_tercero').textContent;
        document.getElementById('textareaObservacion').value = observacionActual;
        $('#alertaObservacion').hide();
        $('#modalEditarObservacion').modal('show');
    }

    // Función para guardar la observación
    function guardarObservacion() {
        var codInfoFacturaVenta = document.getElementById('modalCodInfoFacturaVenta').value;
        var observacion = document.getElementById('textareaObservacion').value.trim();

        // Validación
        if (!observacion) {
            $('#alertaObservacion').removeClass('alert-success').addClass('alert-danger')
                .text('Por favor ingrese una observación').show();
            return;
        }

        // Deshabilitar botón mientras se procesa
        var $boton = $('#modalEditarObservacion').find('.btn-detalle-action');
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

        $.ajax({
            url: '../admin/actualizar_observacion_factura_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                observacion_tercero: observacion
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#alertaObservacion').removeClass('alert-danger').addClass('alert-success')
                        .text('Observación actualizada correctamente').show();

                    // Actualizar el valor en modalParams
                    window.modalParams.observacion_tercero = observacion;

                    // Cerrar modal después de 1.5 segundos y reabrir modal principal
                    setTimeout(function () {
                        $('#modalEditarObservacion').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        setTimeout(function () {
                            var p = window.modalParams;
                            abrirModalDetalleCredito(
                                p.cod_estado_dilig_todo,
                                p.cod_estado_dilig_infocliente,
                                p.cod_estado_dilig_infoproducto,
                                p.cod_estado_dilig_infocreditval,
                                p.cod_estado_dilig_infoequipogest,
                                p.cod_estado_dilig_infocomercial,
                                p.cod_estado_dilig_infodocumentfoto,
                                p.nombre_estado_factura,

                                p.nombres_apellidos,
                                p.identificacion_tercero,
                                p.monto_deuda,
                                p.monto_deuda_sin_interes,
                                p.monto_cuota,
                                p.nombre_tipo_pago,
                                p.cod_entidad_crediticia,
                                p.nombre_entidad_crediticia,
                                p.nombre_operador_credito,
                                p.nombre_tienda,
                                p.nombre_aliado,
                                p.nombre_banco_cuenta,
                                p.nombre_estado_facturacion,
                                p.nombre_estado_revision,
                                p.nombres_apellidos_asesor,
                                p.observacion_tercero,
                                p.fecha_formateada,
                                p.hora_formateada,
                                p.contanenar_nombre_producto,
                                p.nombre_vendedor,
                                p.cod_tercero,
                                p.cod_info_factura_venta,
                                p.cod_vendedor,
                                p.cod_tienda,
                                p.cod_banco_cuenta,
                                p.numero_cuota,
                                p.nombres_apellidos_lider,
                                p.nombres_apellidos_coordinador,
                                p.nombres_apellidos_aliado_estrategico,
                                p.nombres_apellidos_revisor,
                                p.cod_administrador_lider,
                                p.cod_administrador_coordinador,
                                p.cod_administrador_asesor,
                                p.cod_administrador_aliado_estrategico,
                                p.cod_administrador_revisor,
                                p.cod_operador_credito,
                                p.direccion_tercero,
                                p.telefono1_tercero,
                                p.correo_tercero
                            );
                            // Actualizar checkboxes desde la BD después de reabrir el modal
                            setTimeout(function () {
                                actualizarCheckboxesDesdeBD(p.cod_info_factura_venta);
                                // Validar estado del checkbox después de actualizar
                                validarCheckboxInfoCredito();
                                validarCheckboxEquipoGestion();
                            }, 200);
                        }, 300);
                    }, 1500);
                } else {
                    $('#alertaObservacion').removeClass('alert-success').addClass('alert-danger')
                        .text('Error: ' + (response.message || 'No se pudo actualizar')).show();
                    $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
                }
            },
            error: function () {
                $('#alertaObservacion').removeClass('alert-success').addClass('alert-danger')
                    .text('Error de conexión al guardar').show();
                $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
            }
        });
    }

    // Reset del modal al cerrar
    $('#modalEditarObservacion').on('hidden.bs.modal', function () {
        $('#textareaObservacion').val('');
        $('#alertaObservacion').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
    });

    // ==================== FUNCIONES PARA EDITAR ENTIDAD CREDITICIA ====================

    // Función para abrir el modal de editar entidad crediticia
    function abrirModalCambiarEntidadCrediticia(codInfoFacturaVenta, codEntidadCrediticia) {
        document.getElementById('cod_info_factura_venta_editar').value = codInfoFacturaVenta;
        cargarEntidadesCrediticias(codInfoFacturaVenta, codEntidadCrediticia);
        console.log('Desplegar modal: modalEditarEntidadCrediticia:', { codInfoFacturaVenta: codInfoFacturaVenta });
        $('#modalEditarEntidadCrediticia').modal('show');
    }

    // Función para cargar las entidades crediticias
    function cargarEntidadesCrediticias(codInfoFacturaVenta, codEntidadCrediticiaActual) {
        $.ajax({
            url: '../admin/obtener_entidades_crediticias_ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                cod_entidad_crediticia: codEntidadCrediticiaActual
            },
            success: function (response) {
                if (response && response.success && response.entidades) {
                    const select = document.getElementById('cod_entidad_crediticia');
                    select.innerHTML = '<option value="">Seleccionar entidad...</option>';

                    response.entidades.forEach(function (entidad) {
                        const option = document.createElement('option');
                        option.value = entidad.cod_entidad_crediticia;
                        option.textContent = entidad.nombre_entidad_crediticia;
                        option.setAttribute('data-porcentaje', entidad.aliado_estrategico_interes_ptj);

                        if (entidad.observaciones_entidad_crediticia) {
                            option.setAttribute('data-observaciones', entidad.observaciones_entidad_crediticia);
                        }

                        if (codEntidadCrediticiaActual && entidad.cod_entidad_crediticia == codEntidadCrediticiaActual) {
                            option.selected = true;
                        }

                        select.appendChild(option);
                    });

                    if (codEntidadCrediticiaActual) {
                        actualizarPorcentajeEntidad();
                    }

                    // Cargar valores actuales
                    if (response.datos_factura) {
                        setPrecioVentaProductoFormateado(response.datos_factura.total_precio_venta || '');
                        document.getElementById('numero_cuotas').value = response.datos_factura.numero_cuotas || '';
                        document.getElementById('cod_tipo_simulacion_credito').value = response.datos_factura.cod_tipo_simulacion_credito || '1';

                        // Calcular si hay datos
                        if (response.datos_factura.total_precio_venta && response.datos_factura.numero_cuotas) {
                            calcularValorCredito();
                        }
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar entidades crediticias:', error);
            }
        });
    }

    // Función para actualizar el porcentaje de la entidad seleccionada
    function actualizarPorcentajeEntidad() {
        const select = document.getElementById('cod_entidad_crediticia');
        const selectedOption = select.options[select.selectedIndex];

        if (selectedOption && selectedOption.value) {
            const porcentaje = selectedOption.getAttribute('data-porcentaje') || '0';
            const observaciones = selectedOption.getAttribute('data-observaciones');

            // Mostrar porcentaje
            document.getElementById('porcentajeEntidad').textContent = porcentaje;
            document.getElementById('infoEntidadSeleccionada').style.display = 'block';

            // Mostrar observaciones si existen
            if (observaciones) {
                document.getElementById('observacionesTexto').textContent = observaciones;
                document.getElementById('observaciones_entidad_crediticia_modal_editar').style.display = 'block';
            } else {
                document.getElementById('observaciones_entidad_crediticia_modal_editar').style.display = 'none';
            }

            // Calcular valor si ya hay datos ingresados
            calcularValorCredito();
        } else {
            document.getElementById('infoEntidadSeleccionada').style.display = 'none';
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

        if (cod_tipo_simulacion_credito == '1') {
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
                success: function (response) {
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
                        setValorPorCuotaFormateado(cuota_credito);
                        // document.getElementById('interesesGenerados').textContent = formatearNumero(total_interes); // Campo oculto
                        document.getElementById('resultadosCalculo').style.display = 'block';
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al calcular:', error);
                    ocultarResultados();
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

    // Función para guardar la entidad crediticia
    function guardarEntidadCrediticia() {
        const codInfoFacturaVenta = document.getElementById('cod_info_factura_venta_editar').value;
        const codEntidadCrediticia = document.getElementById('cod_entidad_crediticia').value;
        const codTipoSimulacionCredito = document.getElementById('cod_tipo_simulacion_credito').value;
        const valorInput = document.getElementById('precio_venta_producto').value;
        const numeroCuotas = document.getElementById('numero_cuotas').value;
        const valorTotalCredito = document.getElementById('valorTotalCredito').textContent.replace(/\./g, '');
        const valorPorCuota = document.getElementById('valorPorCuota').value.replace(/\./g, '');

        // Validaciones
        if (!codEntidadCrediticia) {
            alert('Por favor seleccione una entidad crediticia');
            return;
        }
        if (!valorInput || parseFloat(valorInput) <= 0) {
            alert('Por favor ingrese un valor válido');
            return;
        }
        if (!numeroCuotas || parseInt(numeroCuotas) <= 0) {
            alert('Por favor ingrese un número de cuotas válido');
            return;
        }

        // Convertir valores
        const valorInputNum = parseFloat(valorInput);
        const numeroCuotasNum = parseInt(numeroCuotas);
        const select = document.getElementById('cod_entidad_crediticia');
        const selectedOption = select.options[select.selectedIndex];
        const nombreEntidad = selectedOption.textContent;
        
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

        // Deshabilitar botón mientras se procesa
        const $boton = $('#btnGuardarEntidadCrediticia');
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

        // AJAX call
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
            success: function (response) {
                if (response && response.success) {
                    $('#modalEditarEntidadCrediticia').modal('hide');
                    // Esperar a que se cierre el modal y reabrir el modal de detalle con datos actualizados
                    setTimeout(function () {
                        if (window.modalParams) {
                            // Actualizar los valores en modalParams con los nuevos datos
                            window.modalParams.nombre_entidad_crediticia = nombreEntidad;
                            window.modalParams.monto_deuda = formatearNumero(montoDeudaFinal);
                            window.modalParams.monto_deuda_sin_interes = formatearNumero(montoContadoFinal);
                            window.modalParams.cod_entidad_crediticia = codEntidadCrediticia;
                            window.modalParams.numero_cuota = numeroCuotasNum;
                            window.modalParams.monto_cuota = formatearNumero(parseInt(valorPorCuota));
                            // Reabrir el modal de detalle con los parámetros actualizados
                            abrirModalDetalleCredito(
                                window.modalParams.cod_estado_dilig_todo,
                                window.modalParams.cod_estado_dilig_infocliente,
                                window.modalParams.cod_estado_dilig_infoproducto,
                                window.modalParams.cod_estado_dilig_infocreditval,
                                window.modalParams.cod_estado_dilig_infoequipogest,
                                window.modalParams.cod_estado_dilig_infocomercial,
                                window.modalParams.cod_estado_dilig_infodocumentfoto,
                                window.modalParams.nombre_estado_factura,

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
                                window.modalParams.numero_cuota,
                                window.modalParams.nombres_apellidos_lider,
                                window.modalParams.nombres_apellidos_coordinador,
                                window.modalParams.nombres_apellidos_aliado_estrategico,
                                window.modalParams.nombres_apellidos_revisor,
                                window.modalParams.cod_administrador_lider,
                                window.modalParams.cod_administrador_coordinador,
                                window.modalParams.cod_administrador_asesor,
                                window.modalParams.cod_administrador_aliado_estrategico,
                                window.modalParams.cod_administrador_revisor,
                                window.modalParams.cod_operador_credito,
                                window.modalParams.direccion_tercero,
                                window.modalParams.telefono1_tercero,
                                window.modalParams.correo_tercero
                            );
                            // Actualizar checkboxes desde la BD después de reabrir el modal
                            setTimeout(function () {
                                actualizarCheckboxesDesdeBD(window.modalParams.cod_info_factura_venta);
                                // Validar estado del checkbox después de actualizar
                                validarCheckboxInfoCredito();
                            }, 200);
                        }
                    }, 500);
                } else {
                    alert('Error al actualizar: ' + (response.message || 'Error desconocido'));
                    $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al guardar:', error);
                alert('Error al guardar los cambios. Por favor intente nuevamente.');
                $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
            }
        });
    }

    // Función para actualizar los datos en el modal de detalle
    function actualizarDatosModalDetalle(nombreEntidad, valorTotal, valorContado) {
        document.getElementById('modal_entidad_crediticia').textContent = nombreEntidad;
        document.getElementById('modalValorCredito').textContent = formatearNumero(valorTotal);
        document.getElementById('modalTotalPrecioVenta').textContent = formatearNumero(valorContado);
        // Si tienes el monto de la cuota, también puedes actualizarlo aquí
    }

    // Función para obtener datos actualizados del administrador
    function obtenerDatosAdministrador(codAdministrador, callback) {
        if (!codAdministrador) {
            callback('No asignado');
            return;
        }

        $.ajax({
            url: '../admin/obtener_administrador_por_codigo.php',
            type: 'POST',
            data: { cod_administrador: codAdministrador },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.administrador) {
                    callback(response.administrador.nombres + ' ' + response.administrador.apellidos);
                } else {
                    callback('No asignado');
                }
            },
            error: function () {
                callback('No asignado');
            }
        });
    }

    // Función genérica para guardar cambios en el equipo
    function guardarCambioEquipo(campo, selectId, modalId, nombreCampo, alertaId, botonId) {
        var codInfoFacturaVenta = document.getElementById('modalCodInfoFacturaVenta').value;
        var valorSeleccionado = document.getElementById(selectId).value;

        if (!valorSeleccionado || valorSeleccionado === '') {
            $('#' + alertaId).removeClass('alert-success').addClass('alert-danger')
                .text('Por favor seleccione un ' + nombreCampo).show();
            return;
        }

        // Deshabilitar botón mientras se procesa
        var $boton = $('#' + modalId).find('.btn-detalle-action');
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

        $.ajax({
            url: '../admin/cambiar_equipo_gestion_ajax_reg.php',
            type: 'POST',
            data: {
                valor: valorSeleccionado,
                campo: campo,
                tipo_ajax: 'tbl15_info_factura_venta',
                id: codInfoFacturaVenta
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#' + alertaId).removeClass('alert-danger').addClass('alert-success').text(nombreCampo + ' actualizado correctamente').show();
                    // Actualizar el código del administrador en las variables globales
                    if (campo === 'cod_administrador_lider') {
                        window.modalParams.cod_administrador_lider = valorSeleccionado;
                        window.codAdministradorLiderActual = valorSeleccionado;
                    } else if (campo === 'cod_administrador_coordinador') {
                        window.modalParams.cod_administrador_coordinador = valorSeleccionado;
                        window.codAdministradorCoordinadorActual = valorSeleccionado;
                    } else if (campo === 'cod_administrador_asesor') {
                        window.modalParams.cod_administrador_asesor = valorSeleccionado;
                        window.codAdministradorAsesorActual = valorSeleccionado;
                    } else if (campo === 'cod_administrador_aliado_estrategico') {
                        window.modalParams.cod_administrador_aliado_estrategico = valorSeleccionado;
                        window.codAdministradorAliadoEstrategicoActual = valorSeleccionado;
                    } else if (campo === 'cod_administrador_revisor') {
                        window.modalParams.cod_administrador_revisor = valorSeleccionado;
                        window.codAdministradorRevisorActual = valorSeleccionado;
                    } else if (campo === 'cod_tienda') {
                        window.modalParams.cod_tienda = valorSeleccionado;
                    } else if (campo === 'cod_vendedor') {
                        window.modalParams.cod_vendedor = valorSeleccionado;
                    } else if (campo === 'cod_banco_cuenta') {
                        window.modalParams.cod_banco_cuenta = valorSeleccionado;
                    } else if (campo === 'cod_operador_credito') {
                        window.modalParams.cod_operador_credito = valorSeleccionado;
                    }
                    // Obtener el nombre del elemento seleccionado
                    var nombreSeleccionado = $('#' + selectId + ' option:selected').text();
                    // Actualizar el nombre en las variables globales
                    if (campo === 'cod_administrador_lider') {
                        window.modalParams.nombres_apellidos_lider = nombreSeleccionado;
                    } else if (campo === 'cod_administrador_coordinador') {
                        window.modalParams.nombres_apellidos_coordinador = nombreSeleccionado;
                    } else if (campo === 'cod_administrador_asesor') {
                        window.modalParams.nombres_apellidos_asesor = nombreSeleccionado;
                    } else if (campo === 'cod_administrador_aliado_estrategico') {
                        window.modalParams.nombres_apellidos_aliado_estrategico = nombreSeleccionado;
                    } else if (campo === 'cod_administrador_revisor') {
                        window.modalParams.nombres_apellidos_revisor = nombreSeleccionado;
                    } else if (campo === 'cod_tienda') {
                        window.modalParams.nombre_tienda = nombreSeleccionado;
                    } else if (campo === 'cod_vendedor') {
                        window.modalParams.nombre_vendedor = nombreSeleccionado;
                    } else if (campo === 'cod_banco_cuenta') {
                        window.modalParams.nombre_banco_cuenta = nombreSeleccionado;
                    } else if (campo === 'cod_operador_credito') {
                        window.modalParams.nombre_operador_credito = nombreSeleccionado;
                    }
                    // Cerrar modal después de 1.5 segundos y reabrir modal principal
                    setTimeout(function () {
                        // Cerrar modal secundario y limpiar backdrop
                        $('#' + modalId).modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        // Pequeña pausa para asegurar que el modal se cerró completamente
                        setTimeout(function () {
                            // Reabrir el modal principal con los datos actualizados
                            var p = window.modalParams;
                            abrirModalDetalleCredito(
                                p.cod_estado_dilig_todo,
                                p.cod_estado_dilig_infocliente,
                                p.cod_estado_dilig_infoproducto,
                                p.cod_estado_dilig_infocreditval,
                                p.cod_estado_dilig_infoequipogest,
                                p.cod_estado_dilig_infocomercial,
                                p.cod_estado_dilig_infodocumentfoto,
                                p.nombre_estado_factura,

                                p.nombres_apellidos,
                                p.identificacion_tercero,
                                p.monto_deuda,
                                p.monto_deuda_sin_interes,
                                p.monto_cuota,
                                p.nombre_tipo_pago,
                                p.cod_entidad_crediticia,
                                p.nombre_entidad_crediticia,
                                p.nombre_operador_credito,
                                p.nombre_tienda,
                                p.nombre_aliado,
                                p.nombre_banco_cuenta,
                                p.nombre_estado_facturacion,
                                p.nombre_estado_revision,
                                p.nombres_apellidos_asesor,
                                p.observacion_tercero,
                                p.fecha_formateada,
                                p.hora_formateada,
                                p.contanenar_nombre_producto,
                                p.nombre_vendedor,
                                p.cod_tercero,
                                p.cod_info_factura_venta,
                                p.cod_vendedor,
                                p.cod_tienda,
                                p.cod_banco_cuenta,
                                p.numero_cuota,
                                p.nombres_apellidos_lider,
                                p.nombres_apellidos_coordinador,
                                p.nombres_apellidos_aliado_estrategico,
                                p.nombres_apellidos_revisor,
                                p.cod_administrador_lider,
                                p.cod_administrador_coordinador,
                                p.cod_administrador_asesor,
                                p.cod_administrador_aliado_estrategico,
                                p.cod_administrador_revisor,
                                p.cod_operador_credito,
                                p.direccion_tercero,
                                p.telefono1_tercero,
                                p.correo_tercero
                            );
                            // Actualizar checkboxes desde la BD después de reabrir el modal
                            setTimeout(function () {
                                actualizarCheckboxesDesdeBD(p.cod_info_factura_venta);
                                // Validar estado del checkbox después de actualizar
                                validarCheckboxInfoCredito();
                                validarCheckboxEquipoGestion();
                            }, 200);
                        }, 300);
                    }, 1500);
                } else {
                    $('#' + alertaId).removeClass('alert-success').addClass('alert-danger').text('Error: ' + (response.message || 'No se pudo actualizar')).show();
                    $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
                }
            },
            error: function () {
                $('#' + alertaId).removeClass('alert-success').addClass('alert-danger').text('Error de conexión al guardar').show();
                $boton.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
            }
        });
    }

    // Event handlers para resetear modales al cerrar
    $('#modalCambiarLider').on('hidden.bs.modal', function () {
        $('#selectNuevoLider').val('');
        $('#alertaLider').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarCoordinador').on('hidden.bs.modal', function () {
        $('#selectNuevoCoordinador').val('');
        $('#alertaCoordinador').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarAsesor').on('hidden.bs.modal', function () {
        $('#selectNuevoAsesor').val('');
        $('#alertaAsesor').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarAliadoEstrategico').on('hidden.bs.modal', function () {
        $('#selectNuevoAliadoEstrategico').val('');
        $('#alertaAliadoEstrategico').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarRevisor').on('hidden.bs.modal', function () {
        $('#selectNuevoRevisor').val('');
        $('#alertaRevisor').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarTienda').on('hidden.bs.modal', function () {
        $('#selectNuevaTienda').val('');
        $('#alertaTienda').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarVendedor').on('hidden.bs.modal', function () {
        $('#selectNuevoVendedor').val('');
        $('#alertaVendedor').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarBancoCuenta').on('hidden.bs.modal', function () {
        $('#selectNuevaBancoCuenta').val('');
        $('#alertaBancoCuenta').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    $('#modalCambiarOperadorCredito').on('hidden.bs.modal', function () {
        $('#selectNuevoOperadorCredito').val('');
        $('#alertaOperadorCredito').hide();
        $(this).find('.btn-detalle-action').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    // Variable global para almacenar los estados de revisión
    var estadosRevisionGlobal = [];

    // Función para verificar si todas las imágenes obligatorias están en estado ACEPTADO
    function verificarImagenesObligatoriasYHabilitarCheckbox(imagenes) {
        var todasObligatoriasAceptadas = true;
        var imagenesObligatorias = [];
        
        // Filtrar imágenes obligatorias (cod_estado_obligatorio == "1")
        $.each(imagenes, function(index, imagen) {
            if (imagen.cod_estado_obligatorio == '1') {
                imagenesObligatorias.push(imagen);
                
                // Buscar el nombre del estado actual
                var nombreEstado = '';
                $.each(estadosRevisionGlobal, function(i, estado) {
                    if (estado.codigo_estado_revision == imagen.codigo_estado_revision) {
                        nombreEstado = estado.nombre_estado_revision;
                        return false; // Break loop
                    }
                });
                
                // Verificar si no está en estado ACEPTADO
                if (nombreEstado !== 'ACEPTADO') {
                    todasObligatoriasAceptadas = false;
                }
            }
        });
        
        console.log('Imágenes obligatorias encontradas:', imagenesObligatorias.length);
        console.log('¿Todas aceptadas?:', todasObligatoriasAceptadas);
        
        // Habilitar o deshabilitar el checkbox según el resultado
        var $checkbox = $('#cod_estado_dilig_infodocumentfoto');
        var $label = $checkbox.next('.switch-slider');
        
        if (todasObligatoriasAceptadas && imagenesObligatorias.length > 0) {
            // Habilitar checkbox
            $checkbox.prop('disabled', false);
            $label.css({
                'cursor': 'pointer',
                'opacity': '1'
            });
        } else {
            // Deshabilitar checkbox y desmarcarlo
            $checkbox.prop('disabled', true).prop('checked', false);
            $label.css({
                'cursor': 'not-allowed',
                'opacity': '0.5'
            });
            
            // Actualizar el estado en la base de datos
            var codInfoFacturaVenta = window.modalParams ? window.modalParams.cod_info_factura_venta : '';
            if (codInfoFacturaVenta) {
                guardarEstadoDiligenciamiento(codInfoFacturaVenta, 'cod_estado_dilig_infodocumentfoto', '0');
            }
        }
    }

    // Función para cargar imágenes del crédito
    function cargarImagenesCredito(codInfoFacturaVenta) {
        // Mostrar indicador de carga
        $('#contenedorTodasLasImagenes').html(
            '<div class="col-12 text-center" style="padding: 3rem;">' +
            '<i class="fa fa-spinner fa-spin" style="font-size: 3rem; color: #0E112B;"></i>' +
            '<p style="color: #718096; font-size: 1.2rem; margin-top: 1rem;">Cargando imágenes...</p>' +
            '</div>'
        );

        // Primero cargar los estados de revisión
        $.ajax({
            url: '../admin/obtener_estados_revision_ajax.php',
            type: 'GET',
            dataType: 'json',
            success: function (responseEstados) {
                if (responseEstados.success && responseEstados.estados) {
                    estadosRevisionGlobal = responseEstados.estados;
                    console.log('Estados de revisión cargados:', estadosRevisionGlobal);

                    // Ahora cargar las imágenes
                    cargarImagenesConEstados(codInfoFacturaVenta);
                } else {
                    console.error('Error al cargar estados de revisión');
                    cargarImagenesConEstados(codInfoFacturaVenta);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener estados:', error);
                cargarImagenesConEstados(codInfoFacturaVenta);
            }
        });
    }

    // Función auxiliar para cargar imágenes con los estados ya disponibles
    function cargarImagenesConEstados(codInfoFacturaVenta) {
        // Realizar petición AJAX para obtener todas las imágenes
        $.ajax({
            url: '../admin/obtener_imagenes_nota_observacion_todas_modal_ajax.php',
            type: 'POST',
            data: { cod_info_factura_venta: codInfoFacturaVenta },
            dataType: 'json',
            success: function (response) {
                console.log('Respuesta completa del servidor:', response);
                console.log('Success:', response.success);
                console.log('Total imágenes:', response.total);
                console.log('Array imágenes:', response.imagenes);

                // Limpiar contenedor
                $('#contenedorTodasLasImagenes').empty();
                // Verificar si hay imágenes
                if (response.success === true && response.imagenes && response.imagenes.length > 0) {
                    // Recorrer todas las imágenes y crear las tarjetas
                    $.each(response.imagenes, function (index, imagen) {
                        // Determinar el ícono según el tipo de imagen
                        var icono = '';
                        // Usar imagen miniatura si existe, sino la original
                        var urlImagen = imagen.url_img_orig_producto;
                        // Verificar si la imagen tiene URL válida
                        var tieneImagen = (urlImagen && urlImagen !== '' && urlImagen !== null && urlImagen !== 'null');
                        // Crear select (combo box) de estado
                        var selectEstados = '';
                        //if (estadosRevisionGlobal.length > 0 && tieneImagen) {
                        if (estadosRevisionGlobal.length > 0) {
                            selectEstados = '<select class="select-estado-revision" ' + 'data-cod-nota="' + imagen.cod_nota_observacion + '" ' + 'data-estado-anterior="' + imagen.codigo_estado_revision + '" ' + 'style="width: 100%; padding: 0.8rem 1rem; border: 2px solid #e2e8f0; border-radius: 8px; ' + 'font-size: 1rem; font-weight: 600; background: white; color: #2d3748; ' + 'cursor: pointer; transition: all 0.3s ease; outline: none;">';

                            $.each(estadosRevisionGlobal, function (i, estado) {
                                var esActual = (estado.codigo_estado_revision == imagen.codigo_estado_revision);
                                var icono = '';

                                // Asignar iconos según el estado
                                if (estado.nombre_estado_revision === 'POR REVISAR') {
                                    icono = '⏱️';
                                } else if (estado.nombre_estado_revision === 'ACEPTADO') {
                                    icono = '✅';
                                } else if (estado.nombre_estado_revision === 'RECHAZADO') {
                                    icono = '❌';
                                } else {
                                    icono = 'ℹ️';
                                }
                                selectEstados += '<option value="' + estado.codigo_estado_revision + '" ' + (esActual ? 'selected' : '') + '>' + icono + ' ' + estado.nombre_estado_revision + '</option>';
                            });

                            selectEstados += '</select>';
                        } else if (!tieneImagen) {
                            selectEstados = '<div style="padding: 0.75rem; background: #f7fafc; border-radius: 6px; color: #a0aec0; font-size: 0.9rem; text-align: center; width: 100%;">' + '<i class="fa fa-ban" style="margin-right: 0.3rem;"></i>Sin imagen cargada' + '</div>';
                        } else {
                            selectEstados = '<div style="padding: 0.75rem; background: #fed7d7; border-radius: 6px; color: #e53e3e; font-size: 0.9rem; text-align: center; width: 100%;">' + '<i class="fa fa-exclamation-triangle" style="margin-right: 0.3rem;"></i>Sin estados disponibles' + '</div>';
                        }

                        // Verificar si el estado es RECHAZADO y hay motivo de rechazo
                        var motivoRechazoHtml = '';
                        var nombreEstadoActual = '';

                        // Buscar el nombre del estado actual
                        $.each(estadosRevisionGlobal, function (i, estado) {
                            if (estado.codigo_estado_revision == imagen.codigo_estado_revision) {
                                nombreEstadoActual = estado.nombre_estado_revision;
                                return false; // Break loop
                            }
                        });

                        // Si el estado es RECHAZADO y hay descripción de rechazo, mostrarla
                        if (nombreEstadoActual === 'RECHAZADO' && imagen.descripcion_nota_observacion && imagen.descripcion_nota_observacion.trim() !== '') {
                            motivoRechazoHtml = '<div style="margin-top: 1rem; padding: 0.75rem; background: #fed7d7; border-left: 4px solid #e53e3e; border-radius: 4px; text-align: left;">' + '<p style="margin: 0; color: #742a2a; font-size: 0.85rem; font-weight: 600;">' + '<i class="fa fa-exclamation-triangle" style="margin-right: 0.3rem;"></i>Motivo del Rechazo:' + '</p>' + '<p style="margin: 0.25rem 0 0 0; color: #742a2a; font-size: 0.9rem; line-height: 1.4;">' + imagen.descripcion_nota_observacion + '</p>' + '</div>';
                        }
                        // Determinar el tipo de obligatoriedad de la imagen
                        var esPrimario = (imagen.cod_estado_obligatorio == '1');
                        var esSecundario = (imagen.cod_estado_obligatorio2 == '1');
                        var esObligatoria = (esPrimario || esSecundario);
                        // Definir clases y textos según el tipo de obligatoriedad
                        var claseObligatoria = '';
                        var claseLabel = '';
                        var labelText = '';

                        if (esPrimario) {
                            // Obligatorio primario (cod_estado_obligatorio = "1") - Color rojo intenso
                            claseObligatoria = 'tarjeta-imagen-obligatoria';
                            claseLabel = 'label-obligatoria';
                            labelText = '' + imagen.nombre_nota_observacion;
                        } else if (esSecundario) {
                            // Obligatorio secundario (cod_estado_obligatorio2 = "1") - Color rojo suave
                            claseObligatoria = 'tarjeta-imagen-obligatoria-secundaria';
                            claseLabel = 'label-obligatoria-secundaria';
                            labelText = '' + imagen.nombre_nota_observacion;
                        } else {
                            // Opcional (ambos = "0")
                            claseObligatoria = '';
                            claseLabel = 'label-opcional';
                            labelText = imagen.nombre_nota_observacion;
                        }

                        // Crear tarjeta para cada imagen (incluye botón para cambiar imagen)
                        var tarjetaHtml =
                            '<div class="col-12 col-md-6 col-lg-4 tarjeta-imagen" data-cod-nota="' + imagen.cod_nota_observacion + '" data-url="' + (imagen.url_img_orig_producto || urlImagen).replace(/"/g, '&quot;') + '" style="margin-bottom: 1.5rem;">' +
                            '<div class="detalle-info-box ' + claseObligatoria + '" style="background: white; padding: 1rem; border-radius: 8px; text-align: center; height: 100%;">' +
                            '<p class="detalle-label ' + claseLabel + '" style="font-weight: 600; margin-bottom: 1rem; font-size: 1.1rem; justify-content: center; display: inline-block; width: 100%;">' +
                            '<i class="fa ' + icono + '" style="color: #0E112B; font-size: 1.1rem; margin-right: 0.5rem;"></i>' +
                            '<span style="font-size: 1rem;">' + labelText + '</span>' +
                            '</p>' +
                            '<div style="min-height: 200px; max-height: 300px; display: flex; align-items: center; justify-content: center; background: #f7fafc; border-radius: 8px; padding: 0.5rem; overflow: hidden;">' +
                            '<img src="' + urlImagen + '" alt="' + imagen.nombre_nota_observacion + '" ' +
                            'style="max-width: 100%; max-height: 280px; object-fit: contain; border-radius: 6px; cursor: pointer;" ' +
                            'onclick="window.open(\'' + (imagen.url_img_orig_producto || urlImagen) + '\', \'_blank\')" ' +
                            'title="Clic para ver en tamaño completo">' +
                            '</div>' +
                            '<p style="color: #718096; font-size: 0.9rem; margin-top: 0.5rem; margin-bottom: 0.5rem;">' +
                            '<i class="fa fa-calendar" style="margin-right: 0.3rem;"></i>' + imagen.fecha_ymd + ' ' +
                            '<i class="fa fa-clock-o" style="margin-left: 0.5rem; margin-right: 0.3rem;"></i>' + imagen.fecha_hora +
                            '</p>' +
                            '<div style="margin-top: 0.75rem; padding: 0 0.5rem;">' +
                            '<div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">' +
                            '<label style="color: #2d3748; font-weight: 600; font-size: 0.95rem; margin: 0; white-space: nowrap;">' +
                            '<i class="fa fa-check-circle" style="color: #0E112B; margin-right: 0.3rem;"></i>Estado de Revisión:' +
                            '</label>' +
                            '<div style="flex: 1;">' +
                            selectEstados +
                            '</div>' +
                            '</div>' +
                            motivoRechazoHtml +
                            // Botón para cambiar imagen
                            '<div style="display: flex; justify-content: center; margin-top: 0.75rem;">' +
                            '<button type="button" class="btn btn-secondary btn-cambiar-imagen" data-cod-nota="' + imagen.cod_nota_observacion + '" data-url="' + (imagen.url_img_orig_producto || urlImagen).replace(/"/g, '&quot;') + '" style="padding: 0.6rem 1.2rem; font-size: 0.95rem; border-radius: 6px;">' +
                            '<i class="fa fa-image" style="margin-right: 0.45rem;"></i>Cambiar Imagen' +
                            '</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('#contenedorTodasLasImagenes').append(tarjetaHtml);
                    });

                    // Deshabilitar selects donde no hay imagen
                    $('.select-estado-revision').each(function () {
                        var $tarjeta = $(this).closest('.detalle-info-box');
                        var tieneImg = $tarjeta.find('img').length > 0;
                        if (!tieneImg) {
                            $(this).prop('disabled', true);
                        }
                    });

                    // Verificar si todas las imágenes obligatorias están en estado ACEPTADO
                    verificarImagenesObligatoriasYHabilitarCheckbox(response.imagenes);

                } else {
                    // No hay imágenes disponibles
                    $('#contenedorTodasLasImagenes').html(
                        '<div class="col-12">' +
                        '<div class="detalle-info-box" style="background: white; padding: 3rem; border-radius: 8px; border: 2px solid #e2e8f0; text-align: center;">' +
                        '<i class="fa fa-images" style="font-size: 4rem; color: #cbd5e0; margin-bottom: 1rem;"></i>' +
                        '<p style="color: #a0aec0; font-size: 1.3rem; margin: 0; font-weight: 600;">No hay imágenes cargadas</p>' +
                        '<p style="color: #cbd5e0; font-size: 1.1rem; margin-top: 0.5rem;">Aún no se han adjuntado fotografías para este crédito</p>' +
                        '</div>' +
                        '</div>'
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar imágenes:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);

                $('#contenedorTodasLasImagenes').html(
                    '<div class="col-12">' +
                    '<div class="detalle-info-box" style="background: white; padding: 3rem; border-radius: 8px; border: 2px solid #fed7d7; text-align: center;">' +
                    '<i class="fa fa-exclamation-triangle" style="font-size: 4rem; color: #f56565; margin-bottom: 1rem;"></i>' +
                    '<p style="color: #e53e3e; font-size: 1.3rem; margin: 0; font-weight: 600;">Error al cargar las imágenes</p>' +
                    '<p style="color: #fc8181; font-size: 1.1rem; margin-top: 0.5rem;">Por favor, intente nuevamente o contacte al administrador</p>' +
                    '</div>' +
                    '</div>'
                );
            }
        });
    }

    // ==================== FUNCIÓN PARA CARGAR HISTORIAL DE NOTIFICACIONES ====================
    function cargarHistorialNotificaciones(codInfoFacturaVenta) {
        // Mostrar indicador de carga
        $('#contenedorHistorialNotificaciones').html(
            '<div class="text-center" style="padding: 2rem;">' +
            '<i class="fa fa-spinner fa-spin" style="font-size: 2rem; color: #0E112B;"></i>' +
            '<p style="color: #718096; font-size: 1rem; margin-top: 1rem;">Cargando notificaciones...</p>' +
            '</div>'
        );

        // Realizar petición AJAX para obtener las notificaciones
        $.ajax({
            url: '../admin/obtener_historial_notificaciones_ajax.php',
            type: 'POST',
            data: { cod_info_factura_venta: codInfoFacturaVenta },
            dataType: 'json',
            success: function (response) {
                console.log('Respuesta historial notificaciones:', response);

                // Limpiar contenedor
                $('#contenedorHistorialNotificaciones').empty();

                // Verificar si hay notificaciones
                if (response.success === true && response.notificaciones && response.notificaciones.length > 0) {
                    // Crear tabla
                    var tablaHtml = '<div class="table-responsive">' +
                        '<table class="table table-striped table-hover" style="margin-bottom: 0;">' +
                        '<thead style="background: #0F1428; color: white;">' +
                        '<tr>' +
                        '<th style="padding: 1rem; text-align: left; font-size: 1rem; font-weight: 600;">Descripción</th>' +
                        '<th style="padding: 1rem; text-align: center; font-size: 1rem; font-weight: 600;">Fecha</th>' +
                        '<th style="padding: 1rem; text-align: center; font-size: 1rem; font-weight: 600;">Leido</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    // Recorrer todas las notificaciones y crear las filas
                    $.each(response.notificaciones, function (index, notificacion) {
                        // Formatear fecha
                        var fecha = new Date(notificacion.fecha_modificacion);
                        var fechaFormateada = fecha.toLocaleDateString('es-CO', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });

                        tablaHtml += '<tr style="border-bottom: 1px solid #0F1428;">' +
                            '<td style="padding: 1rem; text-align: left; font-size: 0.95rem; color: #0F1428;">' + (notificacion.descipcion_notificacion_alerta_renovacion || 'Sin descripción') + '</td>' +
                            '<td style="padding: 1rem; text-align: center; font-size: 0.95rem; color: #0F1428;">' + fechaFormateada + '</td>' +
                            '<td style="padding: 1rem; text-align: center;">' + notificacion.estado_leido + '</td>' +
                            '</tr>';
                    });

                    tablaHtml += '</tbody></table></div>';

                    $('#contenedorHistorialNotificaciones').html(tablaHtml);
                } else {
                    // No hay notificaciones
                    $('#contenedorHistorialNotificaciones').html(
                        '<div class="detalle-info-box" style="background: white; padding: 2rem; border-radius: 8px; border: 2px solid #e2e8f0; text-align: center;">' +
                        '<i class="fa fa-bell-slash" style="font-size: 3rem; color: #cbd5e0; margin-bottom: 1rem;"></i>' +
                        '<p style="color: #a0aec0; font-size: 1.2rem; margin: 0; font-weight: 600;">No hay notificaciones registradas</p>' +
                        '<p style="color: #cbd5e0; font-size: 1rem; margin-top: 0.5rem;">Aún no se han creado notificaciones para esta factura</p>' +
                        '</div>'
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar notificaciones:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);

                $('#contenedorHistorialNotificaciones').html(
                    '<div class="detalle-info-box" style="background: white; padding: 2rem; border-radius: 8px; border: 2px solid #fed7d7; text-align: center;">' +
                    '<i class="fa fa-exclamation-triangle" style="font-size: 3rem; color: #f56565; margin-bottom: 1rem;"></i>' +
                    '<p style="color: #e53e3e; font-size: 1.2rem; margin: 0; font-weight: 600;">Error al cargar las notificaciones</p>' +
                    '<p style="color: #fc8181; font-size: 1rem; margin-top: 0.5rem;">Por favor, intente nuevamente o contacte al administrador</p>' +
                    '</div>'
                );
            }
        });
    }

    // Manejador para cambio de estado de revisión de imagen - DESACTIVADO
    // Ahora se usa el modal de confirmación definido arriba
    /*
    $(document).on('change', '.select-estado-revision', function() {
        var $select = $(this);
        var codNotaObservacion = $select.data('cod-nota');
        var nuevoEstado = $select.val();
        var $tarjeta = $select.closest('.detalle-info-box');
        
        // Deshabilitar el select mientras se procesa
        $select.prop('disabled', true);
        
        // Agregar indicador visual
        var originalBorder = $tarjeta.css('border');
        $tarjeta.css('border', '2px solid #f6ad55');
        
        $.ajax({
            url: '../admin/actualizar_estado_revision_imagen_ajax.php',
            type: 'POST',
            data: {
                cod_nota_observacion: codNotaObservacion,
                codigo_estado_revision: nuevoEstado
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Cambiar borde a verde por 2 segundos
                    var nombreEstado = response.nombre_estado;
                    $tarjeta.css('border', '2px solid #48bb78');
                    
                    setTimeout(function() {
                        $tarjeta.css('border', originalBorder);
                    }, 2000);
                    
                    //console.log('Estado actualizado correctamente:', response.nombre_estado);
                    mostrarModalMotivoRechazoSiEsNecesario(nombreEstado, codNotaObservacion);
                } else {
                    alert('Error al actualizar estado: ' + response.message);
                    $tarjeta.css('border', originalBorder);
                }
                $select.prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error al actualizar estado:', error);
                alert('Error de conexión al actualizar el estado. Por favor, intente nuevamente.');
                $tarjeta.css('border', originalBorder);
                $select.prop('disabled', false);
            }
        });
    });
    */

    // Función para verificar estado y abrir modal correspondiente
    function verificarEstadoYAbrirModal(codInfoFacturaVenta, estadoActual, codTercero, nombreCliente, codTipoEstadoCargueDocumentacion, origen_boton_selecion) {
        if (estadoActual == '2') {
            // Si el estado es "2" (En Generación de Factura), abrir modal de aprobar venta
            abrirModalAprobarVenta(codInfoFacturaVenta, nombreCliente, codTipoEstadoCargueDocumentacion);
        } else {
            // Para otros estados, abrir modal de cambiar estado
            abrirModalCambiarEstadoFacturacion(codInfoFacturaVenta, estadoActual, codTercero, nombreCliente, origen_boton_selecion);
        }
    }

    // Función para abrir modal de aprobar venta
    function abrirModalAprobarVenta(codInfoFacturaVenta, nombreCliente, codTipoEstadoCargueDocumentacion) {
        $('#hiddenCodInfoFacturaVentaAprobar').val(codInfoFacturaVenta);
        $('#hiddenCodTipoEstadoCargueDocumentacion').val(codTipoEstadoCargueDocumentacion);
        $('#modalAprobarNombreCliente').text(nombreCliente);
        $('#alertaAprobarVenta').hide();

        // Mostrar advertencia si las imágenes no están cargadas
        if (codTipoEstadoCargueDocumentacion != '1') {
            $('#alertaAprobarVenta').removeClass('alert-success').addClass('alert-warning')
                .html('<i class="fa fa-exclamation-triangle"></i> <strong>Advertencia:</strong> Las imágenes iniciales no han sido cargadas. Se recomienda cargarlas antes de aprobar la venta.')
                .show();
        }

        // Abrir modal
        $('#modalAprobarVenta').modal('show');
    }

    // Manejador del botón aprobar venta
    $(document).on('click', '#btnConfirmarAprobarVenta', function () {
        // Prevenir ejecuciones duplicadas
        var $boton = $(this);
        if ($boton.prop('disabled')) {
            console.log('Botón ya está procesando, evitando ejecución duplicada');
            return false;
        }

        var codInfoFacturaVenta = $('#hiddenCodInfoFacturaVentaAprobar').val();
        var codTipoEstadoCargueDocumentacion = $('#hiddenCodTipoEstadoCargueDocumentacion').val();

        // Validar que las imágenes iniciales estén cargadas
        if (codTipoEstadoCargueDocumentacion != '1') {
            $('#alertaAprobarVenta').removeClass('alert-success alert-warning').addClass('alert-danger')
                .html('<i class="fa fa-times-circle"></i> <strong>Error:</strong> No se puede aprobar la venta. Las imágenes iniciales deben estar cargadas primero.')
                .show();
            return false;
        }

        // Obtener variables necesarias
        var cuenta = typeof usuario !== 'undefined' ? usuario : '0';
        var codCajaVirtual = typeof cod_caja_virtual !== 'undefined' ? cod_caja_virtual : 0;
        var modoVentaPorDefecto = typeof modo_venta_por_defecto !== 'undefined' ? modo_venta_por_defecto : 0;
        var paginaOrigen = window.location.pathname;

        // Deshabilitar botón mientras se procesa
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Aprobando...');

        $.ajax({
            url: '../admin/aprobar_venta_estado_facturacion_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                cuenta: cuenta,
                cod_caja_virtual: codCajaVirtual,
                modo_venta_por_defecto: modoVentaPorDefecto,
                pagina: paginaOrigen
            },
            dataType: 'json',
            success: function (response) {
                console.log('Respuesta recibida:', response);
                if (response.success) {
                    // Mostrar mensaje de éxito en el modal
                    $('#alertaAprobarVenta').removeClass('alert-danger alert-warning').addClass('alert-success')
                        .html('<i class="fa fa-check-circle"></i> <strong>¡Éxito!</strong> La venta ha sido aprobada correctamente.')
                        .show();

                    // Ocultar el botón de aprobar y mostrar solo el de cerrar
                    $('#btnConfirmarAprobarVenta').hide();

                    // Cambiar el texto del botón cancelar a "Cerrar"
                    $('#modalAprobarVenta .btn-secondary').html('<i class="fa fa-times"></i> Cerrar');

                    // Después de 2 segundos, cerrar modal y abrir el de factura aprobada
                    setTimeout(function () {
                        $('#modalAprobarVenta').modal('hide');

                        // Esperar a que el modal se cierre completamente antes de abrir el siguiente
                        setTimeout(function () {
                            // Limpiar backdrop residual
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            // Abrir modal con la URL de la factura
                            console.log('Abriendo modal de factura aprobada con datos:', response.data);
                            abrirModalFacturaAprobada(response.data);
                        }, 500);
                    }, 2000);
                } else {
                    $('#alertaAprobarVenta').removeClass('alert-success').addClass('alert-danger').text('Error: ' + response.message).show();
                    $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Aprobar Venta');
                }
            },
            error: function (xhr, status, error) {
                var errorMsg = 'Error de conexión al aprobar la venta';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $('#alertaAprobarVenta').removeClass('alert-success').addClass('alert-danger').text(errorMsg).show();
                $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Aprobar Venta');
            }
        });
    });

    // Función para abrir modal con URL de factura aprobada
    function abrirModalFacturaAprobada(data) {
        console.log('Función abrirModalFacturaAprobada llamada');
        console.log('Datos recibidos:', data);

        // Verificar que los elementos existen
        if ($('#modalFacturaAprobada').length === 0) {
            console.error('El modal #modalFacturaAprobada no existe en el DOM');
            return;
        }

        // Obtener variables necesarias
        var cuenta = typeof usuario !== 'undefined' ? usuario : '0';
        var codCajaVirtual = typeof cod_caja_virtual !== 'undefined' ? cod_caja_virtual : 0;
        var modoVentaPorDefecto = typeof modo_venta_por_defecto !== 'undefined' ? modo_venta_por_defecto : 0;
        var paginaLocal = window.location.pathname;
        // Construir URL con todos los parámetros
        var urlFactura = '../admin/ver_factura_venta_siscredito_visitante_intern_pdf.php?' + 'cod_info_factura_venta=' + (data.cod_info_factura_venta);
        // Asignar valores a los elementos del modal
        $('#modalFacturaCodigo').text(data.cod_factura || 'N/A');
        $('#modalFacturaCliente').text(data.nombre_cliente || 'N/A');
        $('#modalFacturaMonto').text('$' + (data.monto_total || '0'));
        $('#btnVerFactura').attr('href', urlFactura);

        console.log('URL de factura construida:', urlFactura);
        console.log('Valores asignados al modal');
        console.log('Abriendo modal...');

        // Abrir el modal
        $('#modalFacturaAprobada').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#modalFacturaAprobada').modal('show');

        console.log('Modal abierto');
    }

    // Reset del modal al cerrar
    $('#modalAprobarVenta').on('hidden.bs.modal', function () {
        $('#alertaAprobarVenta').hide();
        $('#btnConfirmarAprobarVenta').prop('disabled', false).html('<i class="fa fa-check"></i> Aprobar Venta').show();
        // Restaurar el texto del botón cancelar
        $('#modalAprobarVenta .btn-secondary').html('<i class="fa fa-times"></i> Cancelar');
    });

    // Reset del modal de confirmación al cerrar
    $('#modalConfirmacionAprobarVenta').on('hidden.bs.modal', function () {
        $('#alertaConfirmacionAprobacion').hide();
        $('#btnConfirmarAprobacionVenta').prop('disabled', false).html('<i class="fa fa-check"></i> Sí, Aprobar Venta').show();
        // Restaurar el texto del botón cancelar
        $('#modalConfirmacionAprobarVenta .btn-secondary').html('<i class="fa fa-times"></i> Cancelar');
    });

    // Función para abrir modal de cambiar estado
    function abrirModalCambiarEstadoFacturacion(codInfoFacturaVenta, estadoActual, codTercero, nombreCliente, origen_boton_selecion) {
        $('#hiddenCodInfoFacturaVenta').val(codInfoFacturaVenta);
        $('#hiddenEstadoActual').val(estadoActual);
        $('#modalEstadoNombreCliente').text(nombreCliente);
        $('#alertaEstadoFacturacion').hide();
        $('#nuevoEstadoFacturacion').val('');
        $('#hiddenorigen_boton_selecion').val(origen_boton_selecion);

        // Cargar estados disponibles
        cargarEstadosFacturacion();

        // Abrir modal
        $('#modalCambiarEstadoFacturacion').modal('show');
    }

    // ========== FUNCIONES PARA CAMBIAR IMAGEN ==========

    // Abrir modal para cambiar imagen
    $(document).on('click', '.btn-cambiar-imagen', function () {
        var codNota = $(this).data('cod-nota');
        var urlActual = $(this).data('url') || '';

        console.log('Abriendo modal cambiar imagen para nota:', codNota);

        // Guardar código de nota
        $('#cambiar_cod_nota').val(codNota);

        // Mostrar imagen actual si existe
        if (urlActual && urlActual !== 'null' && urlActual !== '') {
            $('#imagenActualPreview').attr('src', urlActual).show();
        } else {
            $('#imagenActualPreview').attr('src', '').hide();
        }

        // Limpiar selección y preview de nueva imagen
        $('#inputCambiarImagen').val('');
        $('#nuevaImagenPreview').hide().attr('src', '');
        $('#alertaCambiarImagen').hide().removeClass('alert-danger alert-success');
        $('#btnSubirImagen').prop('disabled', false).html('<i class="fa fa-cloud-upload"></i> Cambiar Imagen');

        // Abrir modal
        $('#modalCambiarImagen').modal('show');
    });

    // Previsualizar imagen seleccionada
    $(document).on('change', '#inputCambiarImagen', function (e) {
        var file = this.files && this.files[0];

        if (!file) {
            $('#nuevaImagenPreview').hide().attr('src', '');
            return;
        }

        // Validar tipo de archivo
        var tipoArchivo = file.type;
        if (!tipoArchivo.match(/^image\/(jpeg|jpg|png|gif)$/i)) {
            $('#alertaCambiarImagen')
                .removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> Por favor selecciona un archivo de imagen válido (JPG, JPEG, PNG, GIF).')
                .show();
            $(this).val('');
            $('#nuevaImagenPreview').hide();
            return;
        }

        // Validar tamaño del archivo (5MB máximo)
        var tamanoMaximo = 5 * 1024 * 1024; // 5MB en bytes
        if (file.size > tamanoMaximo) {
            $('#alertaCambiarImagen')
                .removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> El archivo es demasiado grande. El tamaño máximo permitido es de 5MB.')
                .show();
            $(this).val('');
            $('#nuevaImagenPreview').hide();
            return;
        }

        // Ocultar alertas si todo está bien
        $('#alertaCambiarImagen').hide();

        // Mostrar previsualización
        var reader = new FileReader();
        reader.onload = function (evt) {
            $('#nuevaImagenPreview').attr('src', evt.target.result).show();
        };
        reader.readAsDataURL(file);
    });

    // Subir nueva imagen via AJAX
    $(document).on('click', '#btnSubirImagen', function () {
        var $btn = $(this);

        // Evitar doble envío
        if ($btn.prop('disabled')) {
            return false;
        }

        var codNota = $('#cambiar_cod_nota').val();
        var fileInput = $('#inputCambiarImagen')[0];
        var file = fileInput.files && fileInput.files[0];

        // Validaciones
        if (!file) {
            $('#alertaCambiarImagen').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> Por favor selecciona una imagen antes de continuar.').show();
            return false;
        }
        if (!codNota) {
            $('#alertaCambiarImagen').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> No se pudo identificar la imagen a cambiar.').show();
            return false;
        }

        // Preparar datos para envío
        var formData = new FormData();
        formData.append('imagen', file);
        formData.append('cod_nota_observacion', codNota);
        // Agregar cod_info_factura_venta y cod_tercero desde modalParams
        if (window.modalParams) {
            if (window.modalParams.cod_info_factura_venta) {
                formData.append('cod_info_factura_venta', window.modalParams.cod_info_factura_venta);
            }
            if (window.modalParams.cod_tercero) {
                formData.append('cod_tercero', window.modalParams.cod_tercero);
            }
        }

        // Deshabilitar botón y mostrar estado de carga
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Subiendo...');
        $('#alertaCambiarImagen').hide();

        // Enviar archivo via AJAX
        $.ajax({
            url: '../admin/subir_imagen_nota_observacion_ajax.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            timeout: 30000, // 30 segundos timeout
            success: function (response) {
                //console.log('Respuesta del servidor:', response);

                if (response && response.success) {
                    // Mostrar mensaje de éxito
                    $('#alertaCambiarImagen').removeClass('alert-danger').addClass('alert-success').html('<i class="fa fa-check-circle"></i> <strong>¡Éxito!</strong> ' + (response.message || 'La imagen se ha actualizado correctamente.')).show();
                    // Cerrar modal después de un momento
                    setTimeout(function () {
                        $('#modalCambiarImagen').modal('hide');
                        // Recargar imágenes del crédito para mostrar la nueva imagen
                        if (window.modalParams && window.modalParams.cod_info_factura_venta) {
                            cargarImagenesCredito(window.modalParams.cod_info_factura_venta);
                        }
                    }, 1500);
                } else {
                    // Mostrar error
                    var mensaje = response && response.message ? response.message : 'Error desconocido al subir la imagen.';
                    $('#alertaCambiarImagen')
                        .removeClass('alert-success').addClass('alert-danger')
                        .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> ' + mensaje)
                        .show();

                    // Rehabilitar botón
                    $btn.prop('disabled', false).html('<i class="fa fa-cloud-upload"></i> Cambiar Imagen');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en petición AJAX:', { xhr: xhr, status: status, error: error });

                var mensajeError = 'Error de conexión al subir la imagen.';

                if (status === 'timeout') {
                    mensajeError = 'La subida de la imagen tardó demasiado. Por favor intenta nuevamente.';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    mensajeError = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    try {
                        var respuesta = JSON.parse(xhr.responseText);
                        if (respuesta.message) {
                            mensajeError = respuesta.message;
                        }
                    } catch (e) {
                        // Si no se puede parsear el JSON, usar mensaje genérico
                    }
                }

                $('#alertaCambiarImagen')
                    .removeClass('alert-success').addClass('alert-danger')
                    .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> ' + mensajeError + ' Por favor intenta nuevamente.')
                    .show();

                // Rehabilitar botón
                $btn.prop('disabled', false).html('<i class="fa fa-cloud-upload"></i> Cambiar Imagen');
            }
        });
    });

    // Limpiar modal al cerrar
    $('#modalCambiarImagen').on('hidden.bs.modal', function () {
        $('#cambiar_cod_nota').val('');
        $('#inputCambiarImagen').val('');
        $('#imagenActualPreview').attr('src', '').hide();
        $('#nuevaImagenPreview').attr('src', '').hide();
        $('#alertaCambiarImagen').hide().removeClass('alert-danger alert-success');
        $('#btnSubirImagen').prop('disabled', false).html('<i class="fa fa-cloud-upload"></i> Cambiar Imagen');
    });
    // ========== FIN FUNCIONES CAMBIAR IMAGEN ==========
    // ========== FUNCIONES PARA CHECKBOXES DE DILIGENCIAMIENTO ==========

    // Función para mostrar el toast de confirmación de checkbox
    function mostrarToastCheckbox(isChecked) {
        var mensaje = isChecked ? 'Verificación activada correctamente' : 'Verificación desactivada correctamente';
        var icono = isChecked ? 'fa-check-circle' : 'fa-times-circle';
        var colorFondo = isChecked
            ? 'linear-gradient(135deg, #48bb78 0%, #38a169 100%)'
            : 'linear-gradient(135deg, #ed8936 0%, #dd6b20 100%)';
        var colorSombra = isChecked
            ? 'rgba(72, 187, 120, 0.4)'
            : 'rgba(237, 137, 54, 0.4)';

        // Actualizar contenido del toast
        $('#toastCheckboxContent').css({
            'background': colorFondo,
            'box-shadow': '0 10px 40px ' + colorSombra
        });
        $('#toastCheckboxContent i').removeClass('fa-check-circle fa-times-circle').addClass(icono);
        $('#toastCheckboxMessage').text(mensaje);

        // Mostrar modal toast
        $('#modalToastCheckbox').modal('show');

        // Auto-cerrar después de 1.5 segundos con efecto fade
        setTimeout(function () {
            $('#modalToastCheckbox').modal('hide');
        }, 500);
    }

    // Array con los IDs de todos los checkboxes de diligenciamiento
    var checkboxesDiligenciamiento = ['cod_estado_dilig_infocliente', 'cod_estado_dilig_infoproducto', 'cod_estado_dilig_infocreditval', 'cod_estado_dilig_infoequipogest', 'cod_estado_dilig_infocomercial', 'cod_estado_dilig_infodocumentfoto'];

    // Manejar cambios en los checkboxes de diligenciamiento
    $(document).on('change', 'input[type="checkbox"][id^="cod_estado_dilig_"]', function () {
        var checkboxId = $(this).attr('id');
        var isChecked = $(this).is(':checked');
        var valorEstado = isChecked ? '1' : '0';
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();

        console.log('Checkbox cambiado:', { checkboxId: checkboxId, valor: valorEstado, codFactura: codInfoFacturaVenta });

        // Validar que tenemos el código de factura
        if (!codInfoFacturaVenta) {
            console.error('No se encontró cod_info_factura_venta');
            // Revertir el cambio del checkbox
            $(this).prop('checked', !isChecked);
            alert('Error: No se pudo identificar la factura. Por favor recarga la página.');
            return;
        }

        // Deshabilitar temporalmente el checkbox mientras se procesa
        $(this).prop('disabled', true);

        // Calcular el estado de todos los checkboxes
        var todosCompletos = true;
        checkboxesDiligenciamiento.forEach(function (otroCheckboxId) {
            var esteCheckbox = (otroCheckboxId === checkboxId);
            var estaChecked = esteCheckbox ? isChecked : $('#' + otroCheckboxId).is(':checked');
            if (!estaChecked) {
                todosCompletos = false;
            }
        });

        var estadoGeneral = todosCompletos ? '1' : '0';

        // Realizar AJAX para guardar ambos estados en una sola llamada
        $.ajax({
            url: '../admin/actualizar_estado_diligenciamiento_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                campo_individual: checkboxId,
                estado_individual: valorEstado,
                estado_general: estadoGeneral
            },
            dataType: 'json',
            success: function (response) {
                console.log('Respuesta AJAX:', response);

                if (response.success) {
                    console.log('Estados guardados exitosamente para:', checkboxId, 'Estado general:', estadoGeneral);

                    // Mostrar modal toast de confirmación
                    mostrarToastCheckbox(isChecked);

                    // Mostrar/ocultar el botón "Aprobar Venta" según el estado general
                    if (response.estado_general == 1) {
                        $('#contenedorBotonAprobarVenta').slideDown(400);
                        console.log('Botón Aprobar Venta mostrado - Diligenciamiento completo');
                    } else {
                        $('#contenedorBotonAprobarVenta').slideUp(400);
                        console.log('Botón Aprobar Venta oculto - Diligenciamiento incompleto');
                    }

                    // Habilitar o deshabilitar el botón "Aprobar Venta"
                    actualizarBotonAprobarVenta(todosCompletos);
                } else {
                    console.error('Error al guardar:', response.message);
                    alert('Error al guardar: ' + (response.message || 'Error desconocido'));

                    // Revertir el cambio del checkbox
                    $('#' + checkboxId).prop('checked', !isChecked);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error AJAX:', { xhr: xhr, status: status, error: error });
                alert('Error de conexión al guardar el estado. Por favor intenta nuevamente.');

                // Revertir el cambio del checkbox
                $('#' + checkboxId).prop('checked', !isChecked);
            },
            complete: function () {
                // Rehabilitar el checkbox
                $('#' + checkboxId).prop('disabled', false);
            }
        });
    });

    // Event handler para el botón "Aprobar Venta" - Mostrar modal de confirmación
    $(document).on('click', '#btnAprobarVentaDiligenciamiento', function () {
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();
        var nombreCliente = $('#modalNombreCliente').text();

        if (!codInfoFacturaVenta) {
            alert('Error: No se pudo identificar la factura. Por favor recarga la página.');
            return;
        }

        // Actualizar el nombre del cliente en el modal de confirmación
        $('#nombreClienteConfirmacion').text('Cliente: ' + nombreCliente);

        // Cerrar modal actual y mostrar confirmación
        $('#modalDetalleCreditoRevisor').modal('hide');

        setTimeout(function () {
            $('#modalConfirmacionAprobarVenta').modal('show');
        }, 300);
    });

    // Event handler para confirmar la aprobación
    $(document).on('click', '#btnConfirmarAprobacionVenta', function () {
        var $boton = $(this);

        // Prevenir ejecuciones duplicadas
        if ($boton.prop('disabled')) {
            return false;
        }

        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();
        var nombreCliente = $('#modalNombreCliente').text();

        // Deshabilitar botón mientras se procesa
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Aprobando...');

        // Simular AJAX (reemplaza con tu lógica real)
        $.ajax({
            url: '../admin/aprobar_venta_diligenciamiento_ajax.php', // Crea este archivo según tu lógica
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                accion: 'aprobar_venta_diligenciamiento'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Cerrar el modal de confirmación
                    $('#modalConfirmacionAprobarVenta').modal('hide');

                    // Actualizar el estado en la tabla inmediatamente
                    if (response.cod_info_factura_venta && response.nombre_estado_facturacion && response.color_estado) {
                        // Buscar la fila en la tabla que corresponde a este cod_info_factura_venta
                        $('#tablaFacturasRevisor tbody tr').each(function () {
                            var $fila = $(this);
                            var codFacturaFila = $fila.find('td:first').text().trim();

                            if (codFacturaFila == response.cod_info_factura_venta) {
                                // Encontrar la celda del estado (última columna) y actualizar
                                var $celdaEstado = $fila.find('td:last');
                                var $badge = $celdaEstado.find('.badge');

                                // Actualizar texto y color del badge
                                $badge.text(response.nombre_estado_facturacion);
                                $badge.css('background-color', response.color_estado);

                                // Opcional: añadir efecto visual para indicar el cambio
                                $fila.addClass('table-success').delay(2000).queue(function () {
                                    $(this).removeClass('table-success').dequeue();
                                });
                            }
                        });
                    }

                    // Configurar el enlace al PDF con el código de la factura
                    var urlPdf = '../admin/ver_factura_venta_siscredito_visitante_intern_pdf.php?cod_info_factura_venta=' + codInfoFacturaVenta;
                    $('#btnVerFacturaPdfExito').attr('href', urlPdf);

                    // Mostrar el modal de éxito después de un pequeño delay
                    setTimeout(function () {
                        $('#modalExitoFacturacion').modal('show');
                    }, 400);

                } else {
                    $('#alertaConfirmacionAprobacion').removeClass('alert-success').addClass('alert-danger')
                        .text('Error: ' + (response.message || 'Error desconocido')).show();
                    $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Sí, Aprobar Venta');
                }
            },
            error: function (xhr, status, error) {
                $('#alertaConfirmacionAprobacion').removeClass('alert-success').addClass('alert-danger')
                    .text('Error de conexión al aprobar la venta').show();
                $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Sí, Aprobar Venta');
            }
        });
    });

    // Manejador para el botón Cerrar del modal de éxito de facturación
    $(document).on('click', '#btnCerrarModalExito', function () {
        // Cerrar el modal
        $('#modalExitoFacturacion').modal('hide');

        // Refrescar la página después de cerrar el modal
        setTimeout(function () {
            load(1);
        }, 300);
    });

    // Función para habilitar/deshabilitar el botón "Aprobar Venta"
    function actualizarBotonAprobarVenta(habilitar) {
        var $botonAprobar = $('#btnAprobarVentaDiligenciamiento');

        if (habilitar) {
            $botonAprobar.prop('disabled', false).removeClass('btn-secondary').addClass('btn-success').html('<i class="fa fa-check-circle"></i> Aprobar Venta').show();
        } else {
            $botonAprobar.prop('disabled', true).removeClass('btn-success').addClass('btn-secondary').html('<i class="fa fa-clock-o"></i> Complete el diligenciamiento').hide();
        }
    }

    // Función para cargar los estados iniciales de los checkboxes al abrir el modal
    function cargarEstadosDiligenciamiento(codInfoFacturaVenta) {
        if (!codInfoFacturaVenta) {
            console.error('No hay cod_info_factura_venta para cargar estados');
            return;
        }

        $.ajax({
            url: '../admin/obtener_estados_diligenciamiento_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta
            },
            dataType: 'json',
            success: function (response) {
                console.log('Estados cargados:', response);

                if (response.success && response.estados) {
                    // Actualizar cada checkbox según su estado en BD
                    checkboxesDiligenciamiento.forEach(function (checkboxId) {
                        var estado = response.estados[checkboxId] || '0';
                        $('#' + checkboxId).prop('checked', estado === '1');
                    });

                    // Verificar completitud sin hacer AJAX (solo actualizar UI)
                    var todosCompletos = checkboxesDiligenciamiento.every(function (checkboxId) {
                        return $('#' + checkboxId).is(':checked');
                    });

                    // Actualizar botón según estado
                    actualizarBotonAprobarVenta(todosCompletos);
                } else {
                    console.error('Error al cargar estados:', response.message);
                    // Dejar todos los checkboxes sin marcar por defecto
                    checkboxesDiligenciamiento.forEach(function (checkboxId) {
                        $('#' + checkboxId).prop('checked', false);
                    });
                    actualizarBotonAprobarVenta(false);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar estados de diligenciamiento:', { xhr: xhr, status: status, error: error });
                // En caso de error, dejar checkboxes sin marcar
                checkboxesDiligenciamiento.forEach(function (checkboxId) {
                    $('#' + checkboxId).prop('checked', false);
                });
                actualizarBotonAprobarVenta(false);
            }
        });
    }

    // ========== FIN FUNCIONES DILIGENCIAMIENTO ==========

    // Función para cargar estados de facturación
    function cargarEstadosFacturacion() {
        var estadoActual = $('#hiddenEstadoActual').val();
        var origen_boton_selecion = $('#hiddenorigen_boton_selecion').val();

        $.ajax({
            url: '../admin/obtener_estados_facturacion_ajax.php?origen_boton_selecion=' + origen_boton_selecion,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    var selectEstado = $('#nuevoEstadoFacturacion');
                    selectEstado.empty();
                    selectEstado.append('<option value="">-- Seleccione un estado --</option>');

                    $.each(response.estados, function (index, estado) {
                        var selected = (estado.codigo_estado_facturacion == estadoActual) ? 'selected' : '';
                        selectEstado.append('<option value="' + estado.codigo_estado_facturacion + '" ' + selected + '>' + estado.nombre_estado_facturacion + '</option>');
                    });
                } else {
                    $('#alertaEstadoFacturacion').removeClass('alert-success').addClass('alert-danger').text('Error al cargar los estados: ' + response.message).show();
                }
            },
            error: function () {
                $('#alertaEstadoFacturacion').removeClass('alert-success').addClass('alert-danger').text('Error de conexión al cargar los estados').show();
            }
        });
    }

    // Manejador del botón guardar
    $(document).on('click', '#btnGuardarEstadoFacturacion', function () {
        var codInfoFacturaVenta = $('#hiddenCodInfoFacturaVenta').val();
        var nuevoEstado = $('#nuevoEstadoFacturacion').val();

        if (nuevoEstado === '' || nuevoEstado === null) {
            $('#alertaEstadoFacturacion').removeClass('alert-success').addClass('alert-danger').text('Por favor seleccione un estado').show();
            return;
        }
        // Deshabilitar botón mientras se procesa
        $('#btnGuardarEstadoFacturacion').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

        $.ajax({
            url: '../admin/cambiar_estado_facturacion_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                nuevo_estado: nuevoEstado
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#alertaEstadoFacturacion').removeClass('alert-danger').addClass('alert-success').text(response.message).show();

                    // Cerrar modal después de 1.5 segundos y recargar tabla
                    setTimeout(function () {
                        // Cerrar modal y limpiar backdrop
                        $('#modalCambiarEstadoFacturacion').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        // Recargar la tabla
                        load(1);
                    }, 1500);
                } else {
                    $('#alertaEstadoFacturacion').removeClass('alert-success').addClass('alert-danger').text('Error: ' + response.message).show();
                    $('#btnGuardarEstadoFacturacion').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
                }
            },
            error: function () {
                $('#alertaEstadoFacturacion').removeClass('alert-success').addClass('alert-danger').text('Error de conexión al guardar').show();
                $('#btnGuardarEstadoFacturacion').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
            }
        });
    });
    // Reset del modal al cerrar
    $('#modalCambiarEstadoFacturacion').on('hidden.bs.modal', function () {
        $('#nuevoEstadoFacturacion').val('');
        $('#alertaEstadoFacturacion').hide();
        $('#btnGuardarEstadoFacturacion').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambio');
    });

    // ==================== FILTROS DE BÚSQUEDA POR COLUMNA ====================
    $(document).on('keyup', '.filtro-input', function () {
        var columna = $(this).data('column');
        var valorFiltro = $(this).val().toLowerCase();

        $('#tablaFacturasRevisor tbody tr').each(function () {
            var textoColumna = $(this).find('td').eq(columna).text().toLowerCase();

            if (textoColumna.indexOf(valorFiltro) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Verificar todos los filtros activos
        verificarTodosFiltros();
    });

    function verificarTodosFiltros() {
        var filtrosActivos = [];

        $('.filtro-input').each(function () {
            var valor = $(this).val().toLowerCase();
            if (valor !== '') {
                filtrosActivos.push({
                    columna: $(this).data('column'),
                    valor: valor
                });
            }
        });

        if (filtrosActivos.length === 0) {
            $('#tablaFacturasRevisor tbody tr').show();
            return;
        }

        $('#tablaFacturasRevisor tbody tr').each(function () {
            var $fila = $(this);
            var mostrar = true;

            $.each(filtrosActivos, function (index, filtro) {
                var textoColumna = $fila.find('td').eq(filtro.columna).text().toLowerCase();
                if (textoColumna.indexOf(filtro.valor) === -1) {
                    mostrar = false;
                    return false; // break
                }
            });

            if (mostrar) {
                $fila.show();
            } else {
                $fila.hide();
            }
        });
    }

    // Función para abrir el modal de editar valor a crédito
    function abrirModalEditarValorCredito() {
        var valorActual = $('#modalValorCredito').text().replace(/\./g, '').replace(/,/g, '');
        setNuevoValorCreditoFormateado(valorActual);
        $('#mensajeEditarValorCredito').hide();
        $('#modalEditarValorCredito').modal('show');
    }

    // Función para guardar el nuevo valor a crédito
    function guardarNuevoValorCredito() {
        var nuevoValor = $('#inputNuevoValorCredito').val();
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();

        if (nuevoValor === '' || nuevoValor <= 0) {
            $('#mensajeEditarValorCredito').html('<div class="alert alert-warning" style="background: rgba(245, 158, 11, 0.2); border: 1px solid #f59e0b; color: #f59e0b; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-exclamation-triangle"></i> Por favor ingrese un valor válido</div>').show();
            return;
        }

        // Mostrar mensaje de carga
        $('#mensajeEditarValorCredito').html('<div class="alert alert-info" style="background: rgba(129, 230, 217, 0.2); border: 1px solid #81e6d9; color: #81e6d9; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-spinner fa-spin"></i> Guardando...</div>').show();

        $.ajax({
            url: 'actualizar_valor_credito_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                nuevo_valor_credito: nuevoValor
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#mensajeEditarValorCredito').html('<div class="alert alert-success" style="background: rgba(72, 187, 120, 0.2); border: 1px solid #48bb78; color: #48bb78; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-check-circle"></i> ' + response.message + '</div>').show();

                    // Actualizar el valor en el modal principal
                    $('#modalValorCredito').text(new Intl.NumberFormat('es-CO').format(nuevoValor));

                    // Validar estado del checkbox después de actualizar
                    validarCheckboxInfoCredito();

                    // Cerrar el modal de edición después de 1.5 segundos
                    setTimeout(function () {
                        $('#modalEditarValorCredito').modal('hide');
                        // El modal principal ya está abierto, no necesitamos reabrirlo
                    }, 1500);
                } else {
                    $('#mensajeEditarValorCredito').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> ' + response.message + '</div>').show();
                }
            },
            error: function (xhr, status, error) {
                $('#mensajeEditarValorCredito').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> Error al guardar: ' + error + '</div>').show();
            }
        });
    }

    // Función para abrir el modal de editar valor de contado
    function abrirModalEditarValorContado() {
        var valorActual = $('#modalTotalPrecioVenta').text().replace(/\./g, '').replace(/,/g, '');
        $('#inputNuevoValorContado').val(valorActual);
        $('#inputNuevoValorContadoFormateado').val(formatearNumeroConMiles(valorActual));
        $('#mensajeEditarValorContado').hide();
        $('#modalEditarValorContado').modal('show');
    }

    // Función para actualizar el valor real de contado cuando se escribe (Modal pequeño)
    function actualizarValorContadoRealModal(input) {
        var valorSinFormato = input.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        $('#inputNuevoValorContado').val(valorSinFormato);
        var cursorPos = input.selectionStart;
        var longitudAntes = input.value.length;
        input.value = formatearNumeroConMiles(valorSinFormato);
        var longitudDespues = input.value.length;
        var nuevaPosicion = cursorPos + (longitudDespues - longitudAntes);
        input.setSelectionRange(nuevaPosicion, nuevaPosicion);
    }

    // Función para guardar el nuevo valor de contado
    function guardarNuevoValorContado() {
        var nuevoValor = $('#inputNuevoValorContado').val();
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();

        if (nuevoValor === '' || nuevoValor <= 0) {
            $('#mensajeEditarValorContado').html('<div class="alert alert-warning" style="background: rgba(245, 158, 11, 0.2); border: 1px solid #f59e0b; color: #f59e0b; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-exclamation-triangle"></i> Por favor ingrese un valor válido</div>').show();
            return;
        }

        $('#mensajeEditarValorContado').html('<div class="alert alert-info" style="background: rgba(129, 230, 217, 0.2); border: 1px solid #81e6d9; color: #81e6d9; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-spinner fa-spin"></i> Guardando...</div>').show();

        $.ajax({
            url: 'actualizar_valor_contado_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                nuevo_valor_contado: nuevoValor
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#mensajeEditarValorContado').html('<div class="alert alert-success" style="background: rgba(72, 187, 120, 0.2); border: 1px solid #48bb78; color: #48bb78; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-check-circle"></i> ' + response.message + '</div>').show();
                    $('#modalTotalPrecioVenta').text(new Intl.NumberFormat('es-CO').format(nuevoValor));
                    
                    // Validar estado del checkbox después de actualizar
                    validarCheckboxInfoCredito();
                    
                    setTimeout(function () {
                        $('#modalEditarValorContado').modal('hide');
                    }, 1500);
                } else {
                    $('#mensajeEditarValorContado').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> ' + response.message + '</div>').show();
                }
            },
            error: function (xhr, status, error) {
                $('#mensajeEditarValorContado').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> Error al guardar: ' + error + '</div>').show();
            }
        });
    }

    // Función para abrir el modal de editar número de cuotas
    function abrirModalEditarNumeroCuotas() {
        var valorActual = $('#modalNumeroCuotas').text().replace(/\./g, '').replace(/,/g, '');
        $('#inputNuevoNumeroCuotas').val(valorActual);
        $('#inputNuevoNumeroCuotasFormateado').val(formatearNumeroConMiles(valorActual));
        $('#mensajeEditarNumeroCuotas').hide();
        $('#modalEditarNumeroCuotas').modal('show');
    }

    // Función para actualizar el valor real de número de cuotas cuando se escribe
    function actualizarNumeroCuotasReal(input) {
        var valorSinFormato = input.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        $('#inputNuevoNumeroCuotas').val(valorSinFormato);
        var cursorPos = input.selectionStart;
        var longitudAntes = input.value.length;
        input.value = formatearNumeroConMiles(valorSinFormato);
        var longitudDespues = input.value.length;
        var nuevaPosicion = cursorPos + (longitudDespues - longitudAntes);
        input.setSelectionRange(nuevaPosicion, nuevaPosicion);
    }

    // Función para guardar el nuevo número de cuotas
    function guardarNuevoNumeroCuotas() {
        var nuevoValor = $('#inputNuevoNumeroCuotas').val();
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();

        if (nuevoValor === '' || nuevoValor <= 0 || !Number.isInteger(parseFloat(nuevoValor))) {
            $('#mensajeEditarNumeroCuotas').html('<div class="alert alert-warning" style="background: rgba(245, 158, 11, 0.2); border: 1px solid #f59e0b; color: #f59e0b; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-exclamation-triangle"></i> Por favor ingrese un número entero válido</div>').show();
            return;
        }

        $('#mensajeEditarNumeroCuotas').html('<div class="alert alert-info" style="background: rgba(129, 230, 217, 0.2); border: 1px solid #81e6d9; color: #81e6d9; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-spinner fa-spin"></i> Guardando...</div>').show();

        $.ajax({
            url: 'actualizar_numero_cuotas_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                nuevo_numero_cuotas: nuevoValor
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#mensajeEditarNumeroCuotas').html('<div class="alert alert-success" style="background: rgba(72, 187, 120, 0.2); border: 1px solid #48bb78; color: #48bb78; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-check-circle"></i> ' + response.message + '</div>').show();
                    $('#modalNumeroCuotas').text(nuevoValor);
                    
                    // Validar estado del checkbox después de actualizar
                    validarCheckboxInfoCredito();
                    
                    setTimeout(function () {
                        $('#modalEditarNumeroCuotas').modal('hide');
                    }, 1500);
                } else {
                    $('#mensajeEditarNumeroCuotas').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> ' + response.message + '</div>').show();
                }
            },
            error: function (xhr, status, error) {
                $('#mensajeEditarNumeroCuotas').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> Error al guardar: ' + error + '</div>').show();
            }
        });
    }

    // Función para abrir el modal de editar cuota mensual
    function abrirModalEditarCuotaMensual() {
        var valorActual = $('#modalMontoCuota').text().replace(/\./g, '').replace(/,/g, '');
        $('#inputNuevoCuotaMensual').val(valorActual);
        $('#inputNuevoCuotaMensualFormateado').val(formatearNumeroConMiles(valorActual));
        $('#mensajeEditarCuotaMensual').hide();
        $('#modalEditarCuotaMensual').modal('show');
    }

    // Función para actualizar el valor real de cuota mensual cuando se escribe
    function actualizarCuotaMensualReal(input) {
        var valorSinFormato = input.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        $('#inputNuevoCuotaMensual').val(valorSinFormato);
        var cursorPos = input.selectionStart;
        var longitudAntes = input.value.length;
        input.value = formatearNumeroConMiles(valorSinFormato);
        var longitudDespues = input.value.length;
        var nuevaPosicion = cursorPos + (longitudDespues - longitudAntes);
        input.setSelectionRange(nuevaPosicion, nuevaPosicion);
    }

    // Función para guardar la nueva cuota mensual
    function guardarNuevoCuotaMensual() {
        var nuevoValor = $('#inputNuevoCuotaMensual').val();
        var codInfoFacturaVenta = $('#modalCodInfoFacturaVenta').val();

        if (nuevoValor === '' || nuevoValor <= 0) {
            $('#mensajeEditarCuotaMensual').html('<div class="alert alert-warning" style="background: rgba(245, 158, 11, 0.2); border: 1px solid #f59e0b; color: #f59e0b; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-exclamation-triangle"></i> Por favor ingrese un valor válido</div>').show();
            return;
        }

        $('#mensajeEditarCuotaMensual').html('<div class="alert alert-info" style="background: rgba(129, 230, 217, 0.2); border: 1px solid #81e6d9; color: #81e6d9; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-spinner fa-spin"></i> Guardando...</div>').show();

        $.ajax({
            url: 'actualizar_cuota_mensual_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta,
                nueva_cuota_mensual: nuevoValor
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#mensajeEditarCuotaMensual').html('<div class="alert alert-success" style="background: rgba(72, 187, 120, 0.2); border: 1px solid #48bb78; color: #48bb78; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-check-circle"></i> ' + response.message + '</div>').show();
                    $('#modalMontoCuota').text(new Intl.NumberFormat('es-CO').format(nuevoValor));
                    
                    // Validar estado del checkbox después de actualizar
                    validarCheckboxInfoCredito();
                    
                    setTimeout(function () {
                        $('#modalEditarCuotaMensual').modal('hide');
                    }, 1500);
                } else {
                    $('#mensajeEditarCuotaMensual').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> ' + response.message + '</div>').show();
                }
            },
            error: function (xhr, status, error) {
                $('#mensajeEditarCuotaMensual').html('<div class="alert alert-danger" style="background: rgba(229, 62, 62, 0.2); border: 1px solid #e53e3e; color: #e53e3e; padding: 0.8rem; border-radius: 8px;"><i class="fa fa-times-circle"></i> Error al guardar: ' + error + '</div>').show();
            }
        });
    }

    // Limpiar filtros al recargar tabla
    $(document).on('click', '.pagination a', function () {
        setTimeout(function () {
            $('.filtro-input').val('');
        }, 500);
    });

    // ========== FUNCIONES PARA EDITAR PRODUCTO ==========

    // Manejador del botón guardar producto
    $(document).on('click', '#btnGuardarProducto', function () {
        var $btn = $(this);
        // Evitar doble envío
        if ($btn.prop('disabled')) { return false; }

        // Obtener datos del formulario
        var codProducto = $('#editProductoCodProducto').val();
        var codCategoria = $('#editProductoCodCategoria').val();
        var codigoBarra = $('#editProductoCodigoBarra').val().trim();
        var nombreProducto = $('#editProductoNombre').val().trim();
        var serial1 = $('#editProductoSerial1').val().trim();
        var serial2 = $('#editProductoSerial2').val().trim();

        // Validaciones básicas
        if (!codigoBarra) {
            $('#alertaEditarProducto').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> El código de barra es requerido.').show();
            return false;
        }
        if (!nombreProducto) {
            $('#alertaEditarProducto').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> El nombre del producto es requerido.').show();
            return false;
        }
        // Validaciones específicas para celulares
        if (codCategoria == '2') {
            if (!serial1) {
                $('#alertaEditarProducto').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> El IMEI 1 es requerido para celulares.').show();
                return false;
            }
            if (!serial2) {
                $('#alertaEditarProducto').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> El IMEI 2 es requerido para celulares.').show();
                return false;
            }
        }

        // Obtener cod_info_factura_venta y nombre_estado_factura desde modalParams
        var codInfoFacturaVenta = '';
        var nombreEstadoFactura = '';

        if (window.modalParams) {
            codInfoFacturaVenta = window.modalParams.cod_info_factura_venta;
            nombreEstadoFactura = window.modalParams.nombre_estado_factura;
        }

        if (!codInfoFacturaVenta) {
            $('#alertaEditarProducto').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> No se pudo obtener el código de factura.').show();
            return false;
        }

        // Deshabilitar botón y mostrar estado de carga
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');
        $('#alertaEditarProducto').hide();

        // Preparar datos para envío
        var datosProducto = {
            cod_producto: codProducto,
            cod_categoria: codCategoria,
            cod_producto_barra: codigoBarra,
            nombre_producto: nombreProducto,
            serial1_producto: serial1,
            serial2_producto: serial2,
            cod_info_factura_venta: codInfoFacturaVenta,
            nombre_estado_factura: nombreEstadoFactura
        };

        // Enviar datos via AJAX
        $.ajax({
            url: '../admin/editar_producto_ajax.php',
            type: 'POST',
            data: datosProducto,
            dataType: 'json',
            timeout: 30000,
            success: function (response) {
                console.log('Respuesta del servidor:', response);

                if (response && response.success) {
                    // Mostrar mensaje de éxito
                    $('#alertaEditarProducto').removeClass('alert-danger').addClass('alert-success')
                        .html('<i class="fa fa-check-circle"></i> <strong>¡Éxito!</strong> ' + (response.message || 'Producto actualizado correctamente.'))
                        .show();

                    // Actualizar modalParams si está disponible
                    if (window.modalParams && response.producto_actualizado) {
                        window.modalParams.contanenar_nombre_producto = response.producto_actualizado;
                    }

                    // Recargar la tabla
                    load(1);

                    // Cerrar modal y reabrir modal principal con datos actualizados
                    setTimeout(function () {
                        $('#modalEditarProducto').modal('hide');
                        // Limpiar cualquier backdrop residual
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        setTimeout(function () {
                            if (window.modalParams) {
                                // Reabrir el modal de detalle con los parámetros actualizados
                                abrirModalDetalleCredito(
                                    window.modalParams.cod_estado_dilig_todo,
                                    window.modalParams.cod_estado_dilig_infocliente,
                                    window.modalParams.cod_estado_dilig_infoproducto,
                                    window.modalParams.cod_estado_dilig_infocreditval,
                                    window.modalParams.cod_estado_dilig_infoequipogest,
                                    window.modalParams.cod_estado_dilig_infocomercial,
                                    window.modalParams.cod_estado_dilig_infodocumentfoto,
                                    window.modalParams.nombre_estado_factura,

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
                                    window.modalParams.numero_cuota,
                                    window.modalParams.nombres_apellidos_lider,
                                    window.modalParams.nombres_apellidos_coordinador,
                                    window.modalParams.nombres_apellidos_aliado_estrategico,
                                    window.modalParams.nombres_apellidos_revisor,
                                    window.modalParams.cod_administrador_lider,
                                    window.modalParams.cod_administrador_coordinador,
                                    window.modalParams.cod_administrador_asesor,
                                    window.modalParams.cod_administrador_aliado_estrategico,
                                    window.modalParams.cod_administrador_revisor,
                                    window.modalParams.cod_operador_credito,
                                    window.modalParams.direccion_tercero,
                                    window.modalParams.telefono1_tercero,
                                    window.modalParams.correo_tercero
                                );
                                // Actualizar checkboxes desde la BD después de reabrir el modal
                                setTimeout(function () {
                                    actualizarCheckboxesDesdeBD(window.modalParams.cod_info_factura_venta);
                                }, 200);
                            }
                        }, 300);
                    }, 1500);

                } else {
                    // Mostrar error
                    var mensaje = response && response.message ? response.message : 'Error desconocido al actualizar el producto.';
                    $('#alertaEditarProducto')
                        .removeClass('alert-success').addClass('alert-danger')
                        .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> ' + mensaje)
                        .show();
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error AJAX:', error);
                var mensaje = 'Error de conexión al actualizar el producto.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    mensaje = xhr.responseJSON.message;
                }
                $('#alertaEditarProducto')
                    .removeClass('alert-success').addClass('alert-danger')
                    .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> ' + mensaje)
                    .show();
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');
            }
        });
    });

    // Reset del modal al cerrar
    $('#modalEditarProducto').on('hidden.bs.modal', function () {
        $('#alertaEditarProducto').hide().removeClass('alert-danger alert-success');
        $('#btnGuardarProducto').prop('disabled', false).html('<i class="fa fa-save"></i> Guardar Cambios');

        // Limpiar campos
        $('#editProductoCodProducto').val('');
        $('#editProductoCodCategoria').val('');
        $('#editProductoCodigoBarra').val('');
        $('#editProductoNombre').val('');
        $('#editProductoSerial1').val('');
        $('#editProductoSerial2').val('');
        $('#camposCelulares').hide();
    });

    // Función para regresar al modal anterior desde modales de edición
    function regresarAlModalAnterior() {
        // Detectar qué modal está abierto y cerrarlo
        if ($('#modalEditarProducto').is(':visible') || $('#modalEditarProducto').hasClass('show')) {
            $('#modalEditarProducto').modal('hide');
        } else if ($('#modalEditarInfoCliente').is(':visible') || $('#modalEditarInfoCliente').hasClass('show')) {
            $('#modalEditarInfoCliente').modal('hide');
        } else {
            // Si no detecta ningún modal específico, cerrar cualquier modal abierto
            $('.modal.show').modal('hide');
        }

        // Esperar a que se cierre completamente y abrir el modal anterior
        setTimeout(function () {
            $('#modalDetalleCreditoRevisor').modal('show');
        }, 300);
    }

    // ==================== FUNCIONES VALIDAR DATOS ESTADO FACTURACIÓN ====================

    // Función para abrir modal de validar datos
    function abrirModalValidarDatos(cod_info_factura_venta, codigo_estado_facturacion) {
        // Guardar los valores en los campos ocultos
        document.getElementById('validarCodInfoFacturaVenta').value = cod_info_factura_venta;
        document.getElementById('validarCodigoEstadoFacturacion').value = codigo_estado_facturacion;

        // Limpiar cualquier mensaje anterior
        $('#alertaValidarDatos').hide();

        // Abrir el modal
        $('#modalValidarDatosEstadoFacturacion').modal('show');
    }

    // Event handler para el botón de guardar validación
    $(document).on('click', '#btnGuardarValidarDatos', function () {
        var cod_info_factura_venta = $('#validarCodInfoFacturaVenta').val();
        var codigo_estado_facturacion = $('#validarCodigoEstadoFacturacion').val();

        // Validar que tengamos los datos necesarios
        if (!cod_info_factura_venta || !codigo_estado_facturacion) {
            $('#alertaValidarDatos')
                .removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fa fa-exclamation-triangle"></i> Error: Datos incompletos')
                .show();
            return;
        }

        // Deshabilitar botón para evitar doble clic
        var $boton = $(this);
        $boton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Procesando...');

        // Enviar datos por AJAX
        $.ajax({
            url: '../admin/validar_datos_estado_facturacion_ajax.php',
            type: 'POST',
            data: {
                cod_info_factura_venta: cod_info_factura_venta,
                codigo_estado_facturacion: codigo_estado_facturacion
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Mostrar mensaje de éxito
                    $('#alertaValidarDatos')
                        .removeClass('alert-danger').addClass('alert-success')
                        .html('<i class="fa fa-check-circle"></i> <strong>¡Éxito!</strong> ' + response.message)
                        .show();

                    // Después de 2 segundos, cerrar modal y refrescar tabla
                    setTimeout(function () {
                        $('#modalValidarDatosEstadoFacturacion').modal('hide');
                        // Refrescar la tabla
                        load(1);
                    }, 2000);
                } else {
                    $('#alertaValidarDatos')
                        .removeClass('alert-success').addClass('alert-danger')
                        .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> ' + (response.message || 'Error desconocido'))
                        .show();
                    $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Confirmar Validación');
                }
            },
            error: function (xhr, status, error) {
                $('#alertaValidarDatos')
                    .removeClass('alert-success').addClass('alert-danger')
                    .html('<i class="fa fa-exclamation-triangle"></i> <strong>Error:</strong> Error de conexión al validar los datos')
                    .show();
                $boton.prop('disabled', false).html('<i class="fa fa-check"></i> Confirmar Validación');
            }
        });
    });

    // Reset del modal al cerrar
    $('#modalValidarDatosEstadoFacturacion').on('hidden.bs.modal', function () {
        $('#validarCodInfoFacturaVenta').val('');
        $('#validarCodigoEstadoFacturacion').val('');
        $('#alertaValidarDatos').hide();
        $('#btnGuardarValidarDatos').prop('disabled', false).html('<i class="fa fa-check"></i> Confirmar Validación');
    });

    // ==================== FIN FUNCIONES VALIDAR DATOS ESTADO FACTURACIÓN ====================

    // ==================== FUNCIONES COMPROBANTE DE PAGO REVISOR ====================

    function abrirModalComprobanteRevisor(codInfoFacturaVenta) {
        // Eliminar modal previo si existe
        $('#modalComprobanteRevisorOverlay').remove();

        var modalHTML = '<div id="modalComprobanteRevisorOverlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9998;display:flex;align-items:center;justify-content:center;">' +
            '<div style="background:#1a1f2e;border:1px solid #2d3748;border-radius:16px;max-width:550px;width:90%;max-height:90vh;overflow-y:auto;box-shadow:0 10px 40px rgba(0,0,0,0.5);">' +
                '<div style="background:linear-gradient(135deg,#0E112B 0%,#1a1f2e 100%);padding:1.5rem;border-radius:16px 16px 0 0;position:relative;border-bottom:2px solid #81e6d9;">' +
                    '<h4 style="color:#81e6d9;margin:0;font-size:1.4rem;font-weight:700;text-align:center;">' +
                        '<i class="fa fa-file-image-o" style="margin-right:0.5rem;"></i> Comprobante de Pago' +
                    '</h4>' +
                    '<button onclick="cerrarModalComprobanteRevisor()" style="position:absolute;top:1rem;right:1rem;background:rgba(129,230,217,0.1);border:1px solid #81e6d9;color:#81e6d9;font-size:1.5rem;width:35px;height:35px;border-radius:50%;cursor:pointer;">&times;</button>' +
                '</div>' +
                '<div style="padding:1.5rem;">' +
                    '<div id="areaComprobanteActualModal" style="margin-bottom:1.5rem;text-align:center;padding:1rem;">' +
                        '<i class="fa fa-spinner fa-spin" style="font-size:2rem;color:#81e6d9;"></i>' +
                        '<p style="color:#81e6d9;margin-top:0.5rem;">Cargando comprobante...</p>' +
                    '</div>' +
                    '<div style="background:#0E112B;border:2px dashed #81e6d9;border-radius:12px;padding:1.5rem;text-align:center;">' +
                        '<label for="inputComprobanteModal" style="cursor:pointer;display:block;">' +
                            '<i class="fa fa-cloud-upload" style="font-size:3rem;color:#81e6d9;margin-bottom:0.5rem;"></i>' +
                            '<p style="color:#81e6d9;font-size:1rem;margin:0;">Haz clic para seleccionar un archivo</p>' +
                            '<p style="color:#a0aec0;font-size:0.85rem;margin-top:0.5rem;">M\u00e1ximo 10MB - Im\u00e1genes, PDF o Word</p>' +
                        '</label>' +
                        '<input type="file" id="inputComprobanteModal" accept="image/*,.pdf,.doc,.docx" style="display:none;" onchange="previsualizarComprobanteModal(this)">' +
                    '</div>' +
                    '<div id="previewComprobanteModal" style="display:none;margin-top:1rem;background:#0E112B;border:1px solid #2d3748;border-radius:8px;padding:1rem;text-align:center;">' +
                        '<p style="color:#81e6d9;margin:0 0 0.5rem 0;"><i class="fa fa-paperclip"></i> <span id="nombreArchivoModal"></span> (<span id="tamanoArchivoModal"></span>)</p>' +
                    '</div>' +
                    '<div style="display:flex;gap:1rem;margin-top:1.5rem;">' +
                        '<button onclick="cargarComprobanteModal(\'' + codInfoFacturaVenta + '\')" style="flex:1;background:#81e6d9;color:#0E112B;border:none;padding:0.75rem;border-radius:8px;font-size:1rem;font-weight:600;cursor:pointer;"><i class="fa fa-upload"></i> Cargar</button>' +
                        '<button onclick="cerrarModalComprobanteRevisor()" style="flex:1;background:#2d3748;color:#81e6d9;border:1px solid #4a5568;padding:0.75rem;border-radius:8px;font-size:1rem;font-weight:600;cursor:pointer;"><i class="fa fa-times"></i> Cerrar</button>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>';

        $('body').append(modalHTML);

        // Cargar comprobante actual via AJAX
        $.ajax({
            url: '../admin/obtener_comprobante_pago_ajax.php',
            type: 'POST',
            data: { cod_info_factura_venta: codInfoFacturaVenta },
            dataType: 'json',
            success: function(response) {
                if (response.success && response.url_comprobante) {
                    $('#areaComprobanteActualModal').html(
                        '<div style="background:#0E112B;border:2px solid #10b981;padding:1rem;border-radius:8px;text-align:center;">' +
                            '<i class="fa fa-check-circle" style="font-size:2rem;color:#10b981;margin-bottom:0.5rem;"></i>' +
                            '<p style="color:#81e6d9;margin:0 0 0.75rem 0;font-size:1rem;font-weight:600;">Comprobante registrado</p>' +
                            '<a href="' + response.url_comprobante + '" target="_blank" style="display:inline-flex;align-items:center;gap:0.5rem;background:#81e6d9;color:#0E112B;padding:0.5rem 1rem;border-radius:8px;text-decoration:none;font-size:0.9rem;font-weight:700;">' +
                                '<i class="fa fa-eye"></i> Ver comprobante' +
                            '</a>' +
                        '</div>'
                    );
                } else {
                    $('#areaComprobanteActualModal').html(
                        '<div style="background:#0E112B;border:2px solid #f59e0b;padding:1rem;border-radius:8px;text-align:center;">' +
                            '<i class="fa fa-exclamation-triangle" style="font-size:2rem;color:#f59e0b;opacity:0.8;margin-bottom:0.5rem;"></i>' +
                            '<p style="color:#81e6d9;margin:0;font-size:0.9rem;font-weight:600;">Sin comprobante registrado</p>' +
                        '</div>'
                    );
                }
            },
            error: function() {
                $('#areaComprobanteActualModal').html(
                    '<div style="background:#0E112B;border:2px solid #ef4444;padding:1rem;border-radius:8px;text-align:center;">' +
                        '<i class="fa fa-exclamation-triangle" style="font-size:2rem;color:#ef4444;"></i>' +
                        '<p style="color:#81e6d9;margin:0.5rem 0 0 0;">Error al consultar comprobante</p>' +
                    '</div>'
                );
            }
        });
    }

    function cerrarModalComprobanteRevisor() {
        $('#modalComprobanteRevisorOverlay').remove();
    }

    function previsualizarComprobanteModal(input) {
        if (input.files && input.files[0]) {
            var archivo = input.files[0];
            var tamanoMB = (archivo.size / (1024 * 1024)).toFixed(2);
            if (archivo.size > 10 * 1024 * 1024) {
                if (typeof swal !== 'undefined') { swal('Error', 'El archivo no debe superar los 10MB', 'error'); } else { alert('El archivo no debe superar los 10MB'); }
                input.value = ''; return;
            }
            var tiposPermitidos = ['image/jpeg','image/jpg','image/png','image/gif','application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!tiposPermitidos.includes(archivo.type)) {
                if (typeof swal !== 'undefined') { swal('Error', 'Solo se permiten imagenes, PDF o documentos Word', 'error'); } else { alert('Tipo de archivo no permitido'); }
                input.value = ''; return;
            }
            $('#nombreArchivoModal').text(archivo.name);
            $('#tamanoArchivoModal').text(tamanoMB + ' MB');
            $('#previewComprobanteModal').show();
        }
    }

    function cargarComprobanteModal(codInfoFacturaVenta) {
        var input = document.getElementById('inputComprobanteModal');
        if (!input || !input.files || !input.files[0]) {
            if (typeof swal !== 'undefined') { swal('Advertencia', 'Por favor selecciona un archivo primero', 'warning'); } else { alert('Por favor selecciona un archivo'); }
            return;
        }

        if (typeof swal !== 'undefined') {
            swal({ title: 'Cargando comprobante...', html: '<i class="fa fa-spinner fa-spin" style="font-size:2rem;color:#f59e0b;"></i><p style="margin-top:1rem;">Por favor espere...</p>', showConfirmButton: false, allowOutsideClick: false, background: '#1a1f2e' });
        }

        var formData = new FormData();
        formData.append('comprobante', input.files[0]);
        formData.append('cod_info_factura_venta', codInfoFacturaVenta);

        $.ajax({
            url: '../admin/cargar_comprobante_pago_ajax.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var icono = document.getElementById('iconoComprobante_' + codInfoFacturaVenta);
                    if (icono) {
                        icono.className = 'fa fa-check-circle';
                        icono.style.color = '#10b981';
                        icono.style.textShadow = '0 0 6px rgba(16,185,129,0.6)';
                        icono.closest('td').title = 'Comprobante cargado - Clic para ver/reemplazar';
                    }
                    cerrarModalComprobanteRevisor();
                    if (typeof swal !== 'undefined') {
                        swal({ type: 'success', title: '!Cargado!', text: response.mensaje || 'Comprobante cargado correctamente', background: '#1a1f2e', confirmButtonColor: '#10b981', timer: 2000 }).catch(function(){});
                    }
                } else {
                    if (typeof swal !== 'undefined') {
                        swal({ type: 'error', title: 'Error', text: response.mensaje || 'No se pudo cargar el comprobante', background: '#1a1f2e', confirmButtonColor: '#e53e3e' });
                    } else { alert(response.mensaje || 'Error al cargar'); }
                }
            },
            error: function() {
                if (typeof swal !== 'undefined') {
                    swal({ type: 'error', title: 'Error de conexion', text: 'No se pudo conectar con el servidor', background: '#1a1f2e', confirmButtonColor: '#e53e3e' });
                } else { alert('Error de conexion'); }
            }
        });
    }

    // ==================== FIN FUNCIONES COMPROBANTE DE PAGO REVISOR ====================
</script>

<style>
    /* Estilos para el botón Ver Factura PDF */
    #btnVerFacturaPdfExito:hover {
        background: #c53030 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(229, 62, 62, 0.4) !important;
    }

    #btnVerFacturaPdfExito:active {
        transform: translateY(0);
    }

    /* Estilos para los switches llamativos de diligenciamiento */
    .switch-container input[type="checkbox"]:checked+.switch-slider {
        background: linear-gradient(135deg, #48bb78, #38a169) !important;
        box-shadow: 0 4px 8px rgba(72, 187, 120, 0.4) !important;
    }

    .switch-container input[type="checkbox"]:checked+.switch-slider span {
        transform: translateX(30px);
        background-color: #ffffff;
    }

    .switch-container .switch-slider:hover {
        box-shadow: 0 6px 12px rgba(255, 107, 107, 0.4);
        transform: translateY(-1px);
    }

    .switch-container input[type="checkbox"]:checked+.switch-slider:hover {
        box-shadow: 0 6px 12px rgba(72, 187, 120, 0.5);
    }

    .switch-container .switch-slider span {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .switch-container input[type="checkbox"]:focus+.switch-slider {
        outline: 2px solid #4299e1;
        outline-offset: 2px;
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
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .estado_default::before {
        content: '';
        margin-right: 0.3rem;
        font-size: 0.6rem;
    }

    .modal-detalle-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 2rem;
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
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .detalle-section {
        background: #f7fafc;
        padding: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .detalle-section * {
        color: #2d3748 !important;
    }

    .detalle-section i {
        color: #667eea !important;
    }

    .detalle-info-box {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .detalle-info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    /* Estilos para imágenes obligatorias primarias (cod_estado_obligatorio = "1") - SIMPLE */
    .tarjeta-imagen-obligatoria {
        border: 2px solid #10162D !important;
        box-shadow: 0 2px 8px rgba(16, 22, 45, 0.15) !important;
        background: linear-gradient(145deg, #ffffff, #e8e9f0) !important;
    }

    .tarjeta-imagen-obligatoria:hover {
        border-color: #0a0e1f !important;
    }

    .label-obligatoria {
        background: #c5c8db !important;
        color: #10162D !important;
        padding: 0.4rem 0.8rem !important;
        border-radius: 6px !important;
        font-weight: 700 !important;
        border: 1px solid #10162D !important;
    }

    /* Estilos para imágenes obligatorias secundarias (cod_estado_obligatorio2 = "1") */
    .tarjeta-imagen-obligatoria-secundaria {
        border: 2px solid #xxxxxxx !important;
        box-shadow: 0 2px 8px rgba(43, 85, 0, 0.12) !important;
        background: linear-gradient(145deg, #ffffff, #e8f0e0) !important;
    }

    .tarjeta-imagen-obligatoria-secundaria:hover {
        border-color: #1a3300 !important;
    }

    .label-obligatoria-secundaria {
        background: #d4e5c4 !important;
        color: #xxxxxxx !important;
        padding: 0.4rem 0.8rem !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        border: 1px solid #xxxxxxx !important;
    }

    .label-opcional {
        background: #f7fafc !important;
        color: #4a5568 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 4px !important;
        padding: 0.2rem 0.4rem !important;
    }

    .detalle-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #2d3748 !important;
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
        color: white;
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .modal-detalle-wrapper {
        max-height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }

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

    @media (max-width: 768px) {
        .modal-detalle-wrapper {
            max-height: 85vh;
        }

        .detalle-info-box {
            padding: 0.75rem;
        }

        .section-divider-detalle {
            margin: 1rem 0 0.5rem 0;
        }

        .detalle-section {
            padding: 1rem;
        }

        .modal-detalle-header {
            padding: 1rem;
        }

        .modal-detalle-header h4 {
            font-size: 1.3rem;
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
    }

    /* Estilos para tabla con fondo oscuro homogéneo */
    .table.jambo_table tbody tr {
        background-color: #10162D !important;
        transition: background-color 0.2s ease;
    }

    .table.jambo_table tbody tr:hover {
        background-color: #090C1A !important;
    }

    .table.jambo_table tbody td {
        background-color: transparent !important;
        color: #ffffff !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* Estilos para fila de filtros */
    .filtros-tabla {
        background-color: #1a2038 !important;
    }

    .filtros-tabla th {
        padding: 0.5rem !important;
        background-color: #1a2038 !important;
        border-bottom: 2px solid #667eea !important;
    }

    .filtro-input {
        background-color: #2d3748 !important;
        color: #ffffff !important;
        border: 1px solid #4a5568 !important;
        border-radius: 4px;
        font-size: 1.2rem;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .filtro-input:focus {
        background-color: #374151 !important;
        border-color: #667eea !important;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
        color: #ffffff !important;
    }

    .filtro-input::placeholder {
        color: #9ca3af !important;
        opacity: 0.7;
    }

    /* Estilos para los select del modal de Editar Entidad Crediticia */
    #modalEditarEntidadCrediticia #cod_entidad_crediticia,
    #modalEditarEntidadCrediticia #cod_tipo_simulacion_credito {
        background-color: white !important;
        color: #2d3748 !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 1.25rem !important;
        font-size: 1.6rem !important;
        height: auto !important;
        min-height: 60px !important;
        line-height: 1.5 !important;
        font-weight: 600 !important;
        width: 100% !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232d3748' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 1rem center !important;
        background-size: 1.5rem !important;
        padding-right: 3rem !important;
    }

    #modalEditarEntidadCrediticia #cod_entidad_crediticia option,
    #modalEditarEntidadCrediticia #cod_tipo_simulacion_credito option {
        background-color: white !important;
        color: #2d3748 !important;
        padding: 1rem !important;
        font-size: 1.6rem !important;
        font-weight: 600 !important;
    }

    #modalEditarEntidadCrediticia #cod_entidad_crediticia:hover,
    #modalEditarEntidadCrediticia #cod_tipo_simulacion_credito:hover {
        border-color: #0E112B !important;
        box-shadow: 0 2px 8px rgba(14, 17, 43, 0.1) !important;
    }

    #modalEditarEntidadCrediticia #cod_entidad_crediticia:focus,
    #modalEditarEntidadCrediticia #cod_tipo_simulacion_credito:focus {
        outline: none !important;
        border-color: #0E112B !important;
        box-shadow: 0 0 0 0.2rem rgba(14, 17, 43, 0.15) !important;
        background-color: white !important;
        color: #2d3748 !important;
    }

    /* Estilos para los inputs del modal de Editar Entidad Crediticia */
    #modalEditarEntidadCrediticia #precio_venta_producto,
    #modalEditarEntidadCrediticia #precio_venta_producto_formateado,
    #modalEditarEntidadCrediticia #numero_cuotas {
        background-color: white !important;
        color: #2d3748 !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 1.25rem !important;
        font-size: 1.6rem !important;
        font-weight: 600 !important;
        width: 100% !important;
        min-height: 60px !important;
    }

    #modalEditarEntidadCrediticia #precio_venta_producto:focus,
    #modalEditarEntidadCrediticia #precio_venta_producto_formateado:focus,
    #modalEditarEntidadCrediticia #numero_cuotas:focus {
        outline: none !important;
        border-color: #0E112B !important;
        box-shadow: 0 0 0 0.2rem rgba(14, 17, 43, 0.15) !important;
        background-color: white !important;
        color: #2d3748 !important;
    }

    #modalEditarEntidadCrediticia #precio_venta_producto::placeholder,
    #modalEditarEntidadCrediticia #precio_venta_producto_formateado::placeholder,
    #modalEditarEntidadCrediticia #numero_cuotas::placeholder {
        color: #a0aec0 !important;
        opacity: 0.8 !important;
        font-size: 1.4rem !important;
    }

    body {
        background-color: #0a0e27 !important;
        background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 50%, #0a0e27 100%) !important;
    }

    .right_col {
        background-color: transparent !important;
    }

    .x_panel,
    .x_content {
        background-color: rgba(15, 20, 40, 0.8) !important;
        border-color: #1a1f3a !important;
    }

    .form-control {
        background-color: rgba(15, 20, 40, 0.9) !important;
        border-color: #2a2f4a !important;
        color: #ffffff !important;
    }

    .form-control:focus {
        background-color: rgba(20, 25, 45, 0.9) !important;
        border-color: #3a4f7a !important;
        color: #ffffff !important;
    }

    /* Estilos específicos para inputs en modales de edición de valores */
    #modalEditarValorCredito .form-control,
    #modalEditarValorContado .form-control,
    #modalEditarNumeroCuotas .form-control,
    #modalEditarCuotaMensual .form-control {
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: white !important;
        font-size: 1.3rem !important;
        padding: 0.8rem !important;
        border-radius: 8px !important;
    }

    #modalEditarValorCredito .form-control:focus,
    #modalEditarValorContado .form-control:focus,
    #modalEditarNumeroCuotas .form-control:focus,
    #modalEditarCuotaMensual .form-control:focus {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: #81e6d9 !important;
        color: white !important;
    }

    .table {
        color: #ffffff !important;
    }

    .table thead th {
        background-color: rgba(15, 20, 40, 0.9) !important;
        color: #ffffff !important;
        border-color: #2a2f4a !important;
    }

    .table tbody td {
        background-color: rgba(10, 14, 39, 0.5) !important;
        border-color: #2a2f4a !important;
        color: #e0e0e0 !important;
    }

    .table tbody tr:hover {
        background-color: rgba(10, 14, 30, 0.95) !important;
    }

    .table tbody tr:hover td {
        background-color: rgba(10, 14, 30, 0.95) !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(10, 14, 30, 0.95) !important;
    }

    .table-hover tbody tr:hover td {
        background-color: rgba(10, 14, 30, 0.95) !important;
    }

    .modal-content {
        background-color: #0f1428 !important;
        color: #ffffff !important;
        border-color: #2a2f4a !important;
    }

    .modal-header,
    .modal-footer {
        border-color: #2a2f4a !important;
    }

    .page-title {
        color: #ffffff !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    span,
    label,
    div {
        color: inherit !important;
    }

    select.form-control option {
        background-color: #0f1428 !important;
        color: #ffffff !important;
    }
</style>