<?php 
$nombre_pagina                            = "Alquiler de Habitaciones";
$url_pagina_local_completa                = $_SERVER['PHP_SELF'];
$explode_url_pagina_local_completa        = explode('/', $url_pagina_local_completa);
$url_pagina_local_parcial                 = end($explode_url_pagina_local_completa);
?>
<!-- ************************************************************************************************************************* -->
<?php include_once('../admin/01_modulo_diseno_superior_aplicacion_hotel.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../admin/02_modulo_estilo_css_aplicacion_hotel.php'); ?>
<script src="../js/aplicacion_tv_jquery-3.4.1.min.js"></script>

<!--<script src="js/jquery.min.js"></script>-->
<script src="js/jquery-ui.js"></script>
<script src="js/json2.min.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<?php
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }

$cod_info_factura_venta                         = intval($_GET['cod_info_factura_venta']);
$cuenta                                         = addslashes($_GET['cuenta']);
$cod_caja_virtual                               = intval($_GET['cod_caja_virtual']);

$pagina                                         = $_SERVER['PHP_SELF'];
$pagina_local                                   = $_SERVER['PHP_SELF'];
$incre                                          = 0;
$tab                                            = 'tbl15_venta_producto_temporal';
$campo                                          = 'cod_venta_producto_temporal';
$tipo                                           = 'eliminar';
$nombre_tipo_moneda                             = "COP";
$nombre_tipo_factura                            = "POS";
$cod_estado_vacuna                              = "0";

$time_seg                                       = time();
$fecha                                          = date("Ymd");
$hora                                           = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>

<script>
window.onload = function() {
    document.getElementById("busqueda").focus();
}

$(document).ready(function() {
    $('#vlr_cancelado_number').number( true, 0 );
    $("#vlr_cancelado_number").keyup(function () {
        var vlr_cancelado_number = $(this).val();
        $("#vlr_cancelado").val(vlr_cancelado_number);
    });

    $('#vlr_cancelado_number').val(vlr_cancelado_number);
    $('#vlr_cancelado').val(vlr_cancelado_number);
});
</script>



<script type="text/javascript">
function hacer_busqueda() {
var xmlhttp;

var valor_buscar = document.getElementById('busqueda').value;
var pagina = document.getElementById('pagina').value;
var nombre_tipo_moneda = "COP";
var nombre_tipo_factura = "POS";
var cod_estado_vacuna = "0";
var tipo_busqueda = "parcial";
var buscar_por = $("#buscar_por").val();
var cuenta = "<?php echo $cuenta_actual ?>";
var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";
var cod_info_factura_venta = "<?php echo $cod_info_factura_venta ?>";


if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_venta_temporal_producto_hotel_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_info_factura_venta="+cod_info_factura_venta+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&pagina="+pagina);
}
</script>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
		  <?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">

            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h5 class="text-primary"><?php echo $nombre_pagina ?></h5>
            </nav>
<!-- ******************************************************************************************************************************* -->
<!-- ******************************************************************************************************************************* -->
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">


                            <!--<h3 class="text-primary"><?php echo $nombre_concepto_multi_virtual; ?>S POR ATENDER</h3>-->
                            <div class="table-responsive">
                                <div id="salida_tabla_caja_mesa_ajax">

                                </div>
                            </div>

<?php 
if (isset($_GET['cod_info_factura_venta'])) {
    $cod_info_factura_venta                         = intval($_GET['cod_info_factura_venta']);
    $cuenta                                         = addslashes($_GET['cuenta']);
    $cod_caja_virtual                               = intval($_GET['cod_caja_virtual']);

    $tab                                            = 'tbl15_venta_producto_temporal';
    $tipo                                           = 'eliminar';
    $campo                                          = 'cod_venta_producto_temporal';

    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $cod_info_factura_venta                         = $data_info_factura['cod_info_factura_venta'];
    $cod_factura                                    = $data_info_factura['cod_factura'];
    $cod_tercero                                    = $data_info_factura['cod_tercero'];
    $cod_historia_clinica                           = $data_info_factura['cod_historia_clinica'];
    $fecha_ini                                      = $data_info_factura['fecha_ini'];
    $fecha_fin                                      = $data_info_factura['fecha_fin'];
    $cod_empresa                                    = $data_info_factura['cod_empresa'];
    $nombre_empresa                                 = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                            = $data_info_factura['razonsocial_empresa'];
    $total_motivo                                   = $data_info_factura['total_motivo'];
    $total_muestra                                  = $data_info_factura['total_muestra'];
    $fecha_ymdhis                                   = $data_info_factura['fecha_ymdhis'];
    $cuenta                                         = $data_info_factura['cuenta'];
    $cod_estado_factura                             = $data_info_factura['cod_estado_factura'];
    $cod_base_caja                                  = $data_info_factura['cod_base_caja'];
    $descuento_ptj                                  = $data_info_factura['descuento_ptj'];
    $iva_ptj                                        = $data_info_factura['iva_ptj'];
    $flete_ptj                                      = $data_info_factura['flete_ptj'];
    $cod_cliente                                    = $data_info_factura['cod_cliente'];
    $vlr_cancelado                                  = $data_info_factura['vlr_cancelado'];
    $vlr_vuelto                                     = $data_info_factura['vlr_vuelto'];
    $fecha_dia                                      = $data_info_factura['fecha_dia'];
    $fecha_mes                                      = $data_info_factura['fecha_mes'];
    $fecha_anyo                                     = $data_info_factura['fecha_anyo'];
    $anyo                                           = $data_info_factura['anyo'];
    $fecha_hora                                     = $data_info_factura['fecha_hora'];
    $fecha_remision                                 = $data_info_factura['fecha_remision'];
    $nombre_ccosto                                  = $data_info_factura['nombre_ccosto'];
    $garantia_meses                                 = $data_info_factura['garantia_meses'];
    $observacion                                    = $data_info_factura['observacion'];
    $cod_tipo_pago                                  = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                              = $data_info_factura['cod_administrador'];
    $nombre_tipo_producto                           = $data_info_factura['nombre_tipo_producto'];
    $total_precio_compra                            = $data_info_factura['total_precio_compra'];
    $total_precio_venta                             = $data_info_factura['total_precio_venta'];
    $cod_dependencia                                = $data_info_factura['cod_dependencia'];
    $servicio                                       = $data_info_factura['servicio'];
    $cod_tipo_forma_pago                            = $data_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_forma_pago                         = $data_info_factura['nombre_tipo_forma_pago'];
    $descripcion_tipo_forma_pago                    = $data_info_factura['descripcion_tipo_forma_pago'];
    $nombre_tipo_factura                            = $data_info_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                             = $data_info_factura['nombre_tipo_moneda'];
    $cod_cierre_caja                                = $data_info_factura['cod_cierre_caja'];
    $fecha_creacion                                 = $data_info_factura['fecha_creacion'];
    $fecha_modificacion                             = $data_info_factura['fecha_modificacion'];
    $nombre_maquina                                 = $data_info_factura['nombre_maquina'];
    $cod_tipo_cobrar                                = $data_info_factura['cod_tipo_cobrar'];
    $cod_estado_vacuna                              = $data_info_factura['cod_estado_vacuna'];
    $cod_resolucion_facturacion                     = $data_info_factura['cod_resolucion_facturacion'];
    $cod_tipo_inventario                            = $data_info_factura['cod_tipo_inventario'];
    $observacion_tercero                            = $data_info_factura['observacion_tercero'];
    $cod_tipo_metodo_envio                          = $data_info_factura['cod_tipo_metodo_envio'];
    $nombre1_tercero_ext                            = $data_info_factura['nombre1_tercero'];
    $nombre_factura_remision                        = $data_info_factura['nombre_factura_remision'];
    $nombre_tipo_pendiente                          = $data_info_factura['nombre_tipo_pendiente'];
    $descripcion_tipo_pendiente                     = $data_info_factura['descripcion_tipo_pendiente'];
    $fecha_entrega                                  = $data_info_factura['fecha_entrega'];
    $hora_entrega                                   = $data_info_factura['hora_entrega'];
    $nombre_elaboro                                 = $data_info_factura['nombre_elaboro'];
    $fecha_pago                                     = $data_info_factura['fecha_pago'];
    $fecha_ymd_parqueo_ini                          = $data_info_factura['fecha_ymd_parqueo_ini'];
    $fecha_hora_parqueo_ini                         = $data_info_factura['fecha_hora_parqueo_ini'];
    $fecha_ymd_parqueo_fin                          = $data_info_factura['fecha_ymd_parqueo_fin'];
    $fecha_hora_parqueo_fin                         = $data_info_factura['fecha_hora_parqueo_fin'];
    $cod_estado_habitacion_hotel                    = $data_info_factura['cod_estado_habitacion_hotel'];
    $cod_tipo_habitacion_hotel                      = $data_info_factura['cod_tipo_habitacion_hotel'];
    $total_horas                                    = $data_info_factura['total_horas'];
    $cod_info_factura_strpad                        = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_mconsulta = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_estado_tipo_hotel_parqueo = '1')";
    $mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
    $datos_temp = mysqli_fetch_assoc($mconsulta);

    $cod_producto_barra                             = $datos_temp['cod_producto_barra'];
    $total_venta_producto_hospedaje                 = $datos_temp['total_venta_producto'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (nombre_tipo_factura = 'ELECTRONICA') AND (nombre_estado_factura = 'CERRADA')";
    $consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
    $maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

    $cod_ultima_factura_electronica                 = $maxima_factura['cod_factura'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
    $matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

    $nombres_vendedor                               = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    if ($cod_seguridad == '1') { $condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"'; } else { $condicion_inventario = 'cod_tipo_inventario = "1"'; }
    if ($cod_estado_cambiar_vendedor_al_vender == '1') { $condicion_vendedor = ''; } else { $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador; }
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_habitaciones_hotel = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, precio_venta_producto, cod_venta_producto_temporal, cod_info_factura_venta 
    FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
    $consulta_habitaciones_hotel = mysqli_query($conectar, $sql_habitaciones_hotel);
    $datos_habitaciones_hotel = mysqli_fetch_assoc($consulta_habitaciones_hotel);

    $cod_producto                                = $datos_habitaciones_hotel['cod_producto'];
    $cod_producto_barra                          = $datos_habitaciones_hotel['cod_producto_barra'];
    $nombre_producto                             = $datos_habitaciones_hotel['nombre_producto'];
    $cod_estado_habitacion_hotel                 = $datos_habitaciones_hotel['cod_estado_habitacion_hotel'];
    $cod_tipo_habitacion_hotel                   = $datos_habitaciones_hotel['cod_tipo_habitacion_hotel'];
    $precio_venta_producto_hospedaje             = $datos_habitaciones_hotel['precio_venta_producto'];
    $cod_venta_producto_temporal                 = $datos_habitaciones_hotel['cod_venta_producto_temporal'];
    $cod_info_factura_venta                      = $datos_habitaciones_hotel['cod_info_factura_venta'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_estado_habitacion_hotel = "SELECT * FROM tbl15_estado_habitacion_hotel 
    WHERE (cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel')";
    $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
    $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

    $nombre_estado_habitacion_hotel              = $datos_estado_habitacion_hotel['nombre_estado_habitacion_hotel'];
    $sobrenombre_estado_habitacion_hotel         = $datos_estado_habitacion_hotel['sobrenombre_estado_habitacion_hotel'];
    $estilo_estado_habitacion_hotel              = $datos_estado_habitacion_hotel['estilo_estado_habitacion_hotel'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_estado_habitacion_hotel = "SELECT nombre_tipo_habitacion_hotel FROM tbl15_tipo_habitacion_hotel WHERE (cod_tipo_habitacion_hotel = '$cod_tipo_habitacion_hotel')";
    $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
    $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

    $nombre_tipo_habitacion_hotel                = $datos_estado_habitacion_hotel['nombre_tipo_habitacion_hotel'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/*
    $sql_estado_venta_producto_temporal = "SELECT total_venta_producto, fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin 
    FROM tbl15_venta_producto_temporal WHERE (cod_venta_producto_temporal = '$cod_venta_producto_temporal')";
    $consulta_estado_venta_producto_temporal = mysqli_query($conectar, $sql_estado_venta_producto_temporal);
    $datos_estado_venta_producto_temporal = mysqli_fetch_assoc($consulta_estado_venta_producto_temporal);

    $total_venta_producto                        = $datos_estado_venta_producto_temporal['total_venta_producto'];
    $fecha_ymd_parqueo_ini                       = $datos_estado_venta_producto_temporal['fecha_ymd_parqueo_ini'];
    $fecha_hora_parqueo_ini                      = $datos_estado_venta_producto_temporal['fecha_hora_parqueo_ini'];
    $fecha_ymd_parqueo_fin                       = $datos_estado_venta_producto_temporal['fecha_ymd_parqueo_fin'];
    $fecha_hora_parqueo_fin                      = $datos_estado_venta_producto_temporal['fecha_hora_parqueo_fin'];
*/
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $seleccionado = 1;

    if ($cod_seguridad == '1') {
        $condicion_vendedor = '';
        $condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
    } else {
        if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
            $condicion_vendedor = '';
            $condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
        } else {
            $condicion_vendedor_option = '';
            $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador;
        }
    }
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
        if ($cod_administrador==0) {
            $filtro_consulta_vendedor = "";
            $filtro_consulta_vendedor_rel = "";
        } else {
            $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
            $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
        }
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
    }
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
    }
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                                  = $datos_administrador['cuenta'];

$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
?>
                            <div class="m-n2">

                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">

                                        <form name="formulario" method="post" enctype="multipart/form-data" action="../admin/venta_producto_hotel_reg.php">

                                            <div class="row text-white text-center">
                                                <div class="col-12 bg-success border" style="text-align: center; font-size:24px;">Informacion del Cliente</div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Cliente</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Recepcionista</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 border" style="text-align: center;">
                                                    <select class="form-select mb-3" name="cod_tercero" id="cod_tercero" style="font-size:24px;" data-show-subtext="true" data-live-search="true" required>
                                                        <?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
                                                        $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'CLIENTE' ORDER BY nombre1_tercero ASC";
                                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                        if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
                                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                        $codigo = $datos2['cod_tercero'];
                                                        $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'];
                                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                                    </select>
                                                </div>
                                                <div class="col-6 border" style="text-align: center;">
                                                    <select class="form-select mb-3" name="cod_administrador" id="cod_administrador" style="font-size:24px;" data-show-subtext="true" data-live-search="true" required>
                                                        <?php if (isset($cod_administrador)) { echo $condicion_vendedor_option; } else { echo $condicion_vendedor_option; }
                                                        $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador $condicion_vendedor ORDER BY cod_administrador ASC";
                                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                        if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
                                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                        $codigo = $datos2['cod_administrador'];
                                                        $nombre = $datos2['cuenta'];
                                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Forma de Pago</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Tipo de Pago</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 border" style="text-align: center;">
                                                    <select class="form-select mb-3" name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" style="font-size:24px;" data-show-subtext="true" data-live-search="true" required>
                                                        <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo ""; }
                                                        $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                        if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                        $codigo = $datos2['cod_tipo_forma_pago'];
                                                        $nombre = $datos2['nombre_tipo_forma_pago'];
                                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                                    </select>
                                                </div>
                                                <div class="col-6 border" style="text-align: center;">
                                                    <select class="form-select mb-3" name="cod_tipo_pago" id="cod_tipo_pago" style="font-size:24px;" data-show-subtext="true" data-live-search="true" required>
                                                        <?php if (isset($cod_tipo_pago)) { } else { }
                                                        $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
                                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                        if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
                                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                        $codigo = $datos2['cod_tipo_pago'];
                                                        $nombre = $datos2['nombre_tipo_pago'];
                                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Tipo de Factura</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Tipo de Moneda</div>
                                            </div>
                                    <div class="row text-white text-center">
                                                <div class="col-6 border" style="text-align: center;">
                                                    <select class="form-select mb-3" name="nombre_tipo_factura" id="nombre_tipo_factura" style="font-size:24px;" data-show-subtext="true" data-live-search="true" required>
                                                        <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo ""; }
                                                        $consulta2_sql = "SELECT * FROM tbl15_tipo_factura";
                                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                        if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
                                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                        $codigo = $datos2['nombre_tipo_factura'];
                                                        $nombre = $datos2['nombre_tipo_factura'];
                                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                                    </select>
                                                </div>
                                                <div class="col-6 border" style="text-align: center;">
                                                    <select class="form-select mb-3" name="nombre_tipo_moneda" id="nombre_tipo_moneda" style="font-size:24px;" data-show-subtext="true" data-live-search="true" required>
                                                        <?php if (isset($nombre_tipo_moneda)) { } else { }
                                                        $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
                                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                        if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
                                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                        $codigo = $datos2['nombre_tipo_moneda'];
                                                        $nombre = $datos2['nombre_tipo_moneda'];
                                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <hr>

                                            <div class="row text-white text-center">
                                                <div class="col-12 bg-success border" style="text-align: center; font-size:24px;">Informacion del Hospedaje</div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Habitacion</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Tipo Habitacion</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-dark border" style="text-align: center; font-size:24px;"><?php echo $cod_producto_barra ?></div>
                                                <div class="col-6 bg-dark border" style="text-align: center; font-size:24px;"><?php echo $nombre_tipo_habitacion_hotel ?></div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Fecha Ingreso</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Fecha Salida</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-dark border" style="text-align: center; font-size:24px;"><?php echo date("d-m-Y", strtotime($fecha_ymd_parqueo_ini)) ?></div>
                                                <div class="col-6 bg-dark border" style="text-align: center; font-size:24px;"><?php echo date("d-m-Y", strtotime($fecha_ymd_parqueo_fin)) ?></div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Precio</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Total Pagar Hospedaje</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 border" style="text-align: center; font-size:24px;"><?php echo number_format($precio_venta_producto_hospedaje, 0, ",", ".") ?></div>
                                                <div class="col-6 border" style="text-align: center; font-size:24px;"><?php echo number_format($total_venta_producto_hospedaje, 0, ",", ".") ?></div>
                                            </div>

<hr>

                                            <div class="row text-white text-center">
                                                <div class="col-12 bg-dark border" style="text-align: center; font-size:24px;">Informacion de los Productos</div>
                                            </div>

                                            <div class="col-12 bg-success border" style="text-align: center;">
                                                <input type="hidden" id="buscar_por" name="buscar_por" value="todo"/>
                                                : [<?php echo $cod_base_caja ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/>
                                            <div id="logo_cargador"></div>
                                            </div>

                                            <div class="col-sm-12 col-xl-12">
                                                <div class="bg-secondary rounded h-100 p-4" style="text-align: center; font-size:24px;">
                                                    <table class="table table-dark">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="text-align:center;">Codigo</th>
                                                                <th scope="col" style="text-align:center;">Nombre Producto</th>
                                                                <th scope="col" style="text-align:center;">Cantidad</th>
                                                                <th scope="col" style="text-align:center;">Precio Venta</th>
                                                                <th scope="col" style="text-align:center;">Total Venta</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $incre = 0;
                                                        $total_venta_producto_final = 0;

                                                        $sql_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_estado_tipo_hotel_parqueo = '0') ORDER BY cod_venta_producto_temporal DESC";
                                                        $consulta_producto_temporal = mysqli_query($conectar, $sql_producto_temporal) or die(mysqli_error($conectar));
                                                        $total_datos = mysqli_num_rows($consulta_producto_temporal);
                                                        while ($datos_producto_temporal = mysqli_fetch_assoc($consulta_producto_temporal)) {

                                                            $cod_venta_producto_temporal       = $datos_producto_temporal['cod_venta_producto_temporal'];
                                                            $cod_producto                      = $datos_producto_temporal['cod_producto'];
                                                            $cod_producto_barra                = $datos_producto_temporal['cod_producto_barra'];
                                                            $nombre_producto                   = $datos_producto_temporal['nombre_producto'];
                                                            $cedula                            = $datos_producto_temporal['cedula'];
                                                            $nombre_cliente                    = $datos_producto_temporal['nombre_cliente'];
                                                            $und_venta                         = $datos_producto_temporal['und_venta'];
                                                            $precio_costo_producto             = $datos_producto_temporal['precio_costo_producto'];
                                                            $precio_compra_producto            = $datos_producto_temporal['precio_compra_producto'];
                                                            $total_costo_producto              = $datos_producto_temporal['total_costo_producto'];
                                                            $precio_venta_producto             = $datos_producto_temporal['precio_venta_producto'];
                                                            $total_venta_producto              = $datos_producto_temporal['total_venta_producto'];
                                                            ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
                                                            if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
                                                            if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
                                                            if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
                                                            $nombre_tipo_producto              = $datos_producto_temporal['nombre_tipo_producto'];
                                                            $nombre_tipo_unidad_medida         = $datos_producto_temporal['nombre_tipo_unidad_medida'];
                                                            $posologia_cantidad                = $datos_producto_temporal['posologia_cantidad'];
                                                            $posologia_peso                    = $datos_producto_temporal['posologia_peso'];
                                                            $nombre_tipo_presentacion          = $datos_producto_temporal['nombre_tipo_presentacion'];
                                                            $nombre_via_administracion         = $datos_producto_temporal['nombre_via_administracion'];
                                                            $nombre_frec_duracion              = $datos_producto_temporal['nombre_frec_duracion'];
                                                            $cod_tipo_cobrar                   = $datos_producto_temporal['cod_tipo_cobrar'];
                                                            $cod_info_factura_venta            = $datos_producto_temporal['cod_info_factura_venta'];
                                                            $nombre_tipo_precio_venta          = $datos_producto_temporal['nombre_tipo_precio_venta'];
                                                            $cod_estado_permitir_venta         = $datos_producto_temporal['cod_estado_permitir_venta'];
                                                            $und_producto                      = $datos_producto_temporal['und_producto'];
                                                            $cajas_sobre                       = $datos_producto_temporal['cajas_sobre'];
                                                            $und_sobre                         = $datos_producto_temporal['und_sobre'];
                                                            $fecha_seg_venta_producto          = $datos_producto_temporal['fecha_seg_venta_producto'];
                                                            $hora_cargue                       = date("H:i:s", $fecha_seg_venta_producto);

                                                            $comentario_producto               = $datos_producto_temporal['comentario_producto'];
                                                            $placa_producto                    = $datos_producto_temporal['placa_producto'];
                                                            $fecha_ymd_parqueo_ini             = $datos_producto_temporal['fecha_ymd_parqueo_ini'];
                                                            $fecha_hora_parqueo_ini            = $datos_producto_temporal['fecha_hora_parqueo_ini'];
                                                            $fecha_ymd_parqueo_fin             = $datos_producto_temporal['fecha_ymd_parqueo_fin'];
                                                            $fecha_hora_parqueo_fin            = $datos_producto_temporal['fecha_hora_parqueo_fin'];
                                                            $cod_estado_componente_und_venta   = $datos_producto_temporal['cod_estado_componente_und_venta'];
                                                            $cod_estado_revisado               = $datos_producto_temporal['cod_estado_revisado'];
                                                            $peso_producto                     = $datos_producto_temporal['peso_producto'];
                                                            $unidad_medida_peso                = $datos_producto_temporal['unidad_medida_peso'];
                                                            $cod_origen_produccion             = $datos_producto_temporal['cod_origen_produccion'];
                                                            $und_caja_sobre                    = $datos_producto_temporal['und_caja_sobre'];
                                                            $nombre_tipo_und_caja_sobre        = $datos_producto_temporal['nombre_tipo_und_caja_sobre'];

                                                            if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
                                                            if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta = "max=".$und_producto; } else { $max_und_venta = ""; }
                                                            if ($cod_estado_venta_precio_min_venta_global == '1') { $min_precio_venta = "min=".$precio_compra_producto; } else { $min_precio_venta = ""; }
                                                            if ($cod_estado_revisado == '0') { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

                                                            if ($nombre_tipo_und_caja_sobre == 'CAJA') { $img_caja = "../imagenes/und_caja_R.png"; } else { $img_caja = "../imagenes/und_caja.png"; }
                                                            if ($nombre_tipo_und_caja_sobre == 'SOBRE') { $img_sobre = "../imagenes/und_sobre_R.png"; } else { $img_sobre = "../imagenes/und_sobre.png"; }
                                                            if (($nombre_tipo_und_caja_sobre=='UND') || ($nombre_tipo_und_caja_sobre=='')) { $img_und = "../imagenes/und_und_R.png"; } else { $img_und = "../imagenes/und_und.png"; }
                                                            $total_venta_producto_final += $total_venta_producto;
                                                            $incre++;
                                            ?>
                                                            <tr>
                                                                <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><?php echo $cod_producto_barra;?></td>
                                                                <td style="text-align:left;" id="und_venta_<?php echo $incre;?>"><?php echo $nombre_producto;?></td>

                                                                <?php if (($nombre_tipo_und_caja_sobre=='CAJA') || ($nombre_tipo_und_caja_sobre=='SOBRE')) { ?>
                                                                    <td style="text-align:center;" id="und_caja_sobre_<?php echo $incre;?>"><input name="und_caja_sobre" type="number" id="und_caja_sobre<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_caja_sobre;?>" step="any" style="width: 70px;" /></td>
                                                                    <input name="und_venta" type="hidden" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_venta;?>" />
                                                                <?php } else { ?>
                                                                    <?php if ($cod_seguridad=='1') { ?>
                                                                    <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="<?php echo $nombre_tipo_campo_componente_html_und_venta;?>" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" step="any" min=0 <?php echo $max_und_venta;?> oninput="validity.valid||(value='');" style="width: 70px;" /></td>
                                                                    <?php } else { 
                                                                        if ($cod_estado_componente_und_venta == '0') { ?>
                                                                            <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="<?php echo $nombre_tipo_campo_componente_html_und_venta;?>" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" step="any" min=0 <?php echo $max_und_venta;?> oninput="validity.valid||(value='');" style="width: 70px;" /></td>
                                                                        <?php } else { ?>
                                                                            <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><?php echo $und_venta;?></td>
                                                                     <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>

                                                                <?php if ($cod_estado_precio_compra_mod_venta==1) { ?>
                                                                <td style="text-align:center;" id="precio_compra_producto_<?php echo $incre;?>"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
                                                                <?php } ?>

                                                                <?php if ($cod_estado_precio_venta_variable_disponible=='1') { ?>
                                                                    <?php if ($nombre_tipo_precio_venta=='PVAR') { ?>
                                                                       <td style="text-align:center;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px;" /></td>
                                                                      <?php } else { ?>
                                                                    <td style="text-align:center;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px;" /></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php if ($nombre_tipo_precio_venta=='PVAR') { ?>
                                                                      <td style="text-align:center;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px;" /></td>
                                                                    <?php } else { ?>
                                                                    <input type="hidden" id="precio_venta_producto<?php echo $incre;?>" value="<?php echo $precio_venta_producto;?>">
                                                                    <td style="text-align:center;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                    <?php $total_pagar = $total_venta_producto_hospedaje + $total_venta_producto_final?>
                                                    <div class="row text-white text-center">
                                                        <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Total Pagar Productos</div>
                                                        <div class="col-6 bg-success border" style="text-align: center; font-size:24px;"><?php echo number_format($total_venta_producto_final, 0, ",", ".");?></div>
                                                    </div>
                                                    <div class="row text-white text-center">
                                                        <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Total Pagar Hospedaje</div>
                                                        <div class="col-6 bg-success border" style="text-align: center; font-size:24px;"><?php echo number_format($total_venta_producto_hospedaje, 0, ",", ".");?></div>
                                                    </div>

                                                    <hr>

                                                    <div class="row text-white text-center">
                                                        <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Total Factura</div>
                                                        <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Total Recibido</div>
                                                    </div>
                                                    <div class="row text-white text-center">
                                                        <div class="col-6 bg-dark border" style="text-align: center; font-size:24px;"><?php echo number_format($total_pagar, 0, ",", ".");?></div>
                                                        <div class="col-6 bg-dark border" style="text-align: center; font-size:24px;">
                                                            <input name="vlr_cancelado_number" id="vlr_cancelado_number" type="text" value="" style="width: 150px; font-size:30px; height: 50px;" required/>
                                                            <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <br>
                                            <input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>">
                                            <input type="hidden" name="fecha_anyo" value="<?php echo $fecha_anyo ?>">
                                            <input type="hidden" name="total_datos" value="<?php echo $total_datos ?>">
                                            <input type="hidden" name="observacion_tercero" value="<?php echo $observacion_tercero ?>">
                                            <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
                                            <button type="submit" class="btn btn-info" name="btn_enviar" value="btn_Facturar_Alquiler_Ocupado">Facturar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </form>
                                    </div>
                                </div>

                            </div>
<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
<!-- ******************************************************************************************************************************* -->
<!-- ******************************************************************************************************************************* -->
        <?php include_once('../admin/04_modulo_footer_aplicacion_hotel.php'); ?>
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>
<?php include_once('../admin/05_modulo_js_sin_jquery_aplicacion_hotel.php'); ?>
</body>
</html>
