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
if (isset($_GET['cod_producto_barra'])) {
    $cod_producto_barra                              = addslashes($_GET['cod_producto_barra']);
    $pagina                                          = addslashes($_GET['pagina']);

    $sql_habitaciones_hotel = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, precio_venta_producto, cod_venta_producto_temporal, cod_info_factura_venta 
    FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
    $consulta_habitaciones_hotel = mysqli_query($conectar, $sql_habitaciones_hotel);
    $datos_habitaciones_hotel = mysqli_fetch_assoc($consulta_habitaciones_hotel);

    $cod_producto                                = $datos_habitaciones_hotel['cod_producto'];
    $cod_producto_barra                          = $datos_habitaciones_hotel['cod_producto_barra'];
    $nombre_producto                             = $datos_habitaciones_hotel['nombre_producto'];
    $cod_estado_habitacion_hotel                 = $datos_habitaciones_hotel['cod_estado_habitacion_hotel'];
    $cod_tipo_habitacion_hotel                   = $datos_habitaciones_hotel['cod_tipo_habitacion_hotel'];
    $precio_venta_producto                       = $datos_habitaciones_hotel['precio_venta_producto'];
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
    $sql_estado_habitacion_hotel = "SELECT cod_tipo_habitacion_hotel, nombre_tipo_habitacion_hotel FROM tbl15_tipo_habitacion_hotel WHERE (cod_tipo_habitacion_hotel = '$cod_tipo_habitacion_hotel')";
    $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
    $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);
    $nombre_tipo_habitacion_hotel                = $datos_estado_habitacion_hotel['nombre_tipo_habitacion_hotel'];
    /* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
    $sql_info_factura_venta = "SELECT fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, cod_tercero, cod_administrador
    FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
    $existe_info_factura_venta = mysqli_num_rows($consulta_info_factura_venta);
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    if ($existe_info_factura_venta <> 0) {
        $fecha_ymd_parqueo_ini                       = $datos_info_factura_venta['fecha_ymd_parqueo_ini'];
        $fecha_hora_parqueo_ini                      = $datos_info_factura_venta['fecha_hora_parqueo_ini'];
        $fecha_ymd_parqueo_fin                       = $datos_info_factura_venta['fecha_ymd_parqueo_fin'];
        $fecha_hora_parqueo_fin                      = $datos_info_factura_venta['fecha_hora_parqueo_fin'];
        $cod_tercero                                 = $datos_info_factura_venta['cod_tercero'];
        $cod_administrador                           = $datos_info_factura_venta['cod_administrador'];
    } else {
        $fecha_ymd_parqueo_ini                       = date("Y-m-d");
        $fecha_hora_parqueo_ini                      = date("H:i:s");
        $fecha_ymd_parqueo_fin                       = date("Y-m-d", strtotime($fecha_ymd_parqueo_ini."+ 1 days"));
        $fecha_hora_parqueo_fin                      = date("H:i:s");
        $cod_tercero                                 = $nombre_cod_tercero_defec_global;
        $cod_administrador                           = $cod_administrador;
    }
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
?>
<script type="text/javascript">
var precio_venta_producto = '<?php echo $precio_venta_producto ?>';
var dias_hospedaje = 1;
var und_venta = dias_hospedaje;

function calcular_dias() {
    var fecha_ymd_parqueo_ini = document.getElementById('fecha_ymd_parqueo_ini').value;
    var fecha_ymd_parqueo_fin = document.getElementById('fecha_ymd_parqueo_fin').value;

    var fecha_ymd_parqueo_date_ini = new Date(fecha_ymd_parqueo_ini).getTime();
    var fecha_ymd_parqueo_date_fin = new Date(fecha_ymd_parqueo_fin).getTime();

    var diferencia_tiempo = fecha_ymd_parqueo_date_fin - fecha_ymd_parqueo_date_ini;
    var dias_hospedaje = diferencia_tiempo/(1000*60*60*24);
    var und_venta = dias_hospedaje;

    var total_venta_producto = parseFloat(precio_venta_producto * dias_hospedaje);

    $('#total_venta_producto').val(total_venta_producto);
    $('#total_venta_producto_hidden').val(total_venta_producto);
    $('#und_venta').val(und_venta);
}

$(document).ready(function() {
    $('#total_venta_producto').number( true, 0 );
    $("#total_venta_producto").keyup(function () {
        var total_venta_producto = $(this).val();
        $("#total_venta_producto_hidden").val(total_venta_producto);
    });

    var total_venta_producto = parseFloat(precio_venta_producto * dias_hospedaje);

    $('#total_venta_producto').val(total_venta_producto);
    $('#total_venta_producto_hidden').val(total_venta_producto);
});
/*
document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");

var abonado = parseFloat($('#abonado').val());
var total_pendiente = total_pagar_hidden - abonado;
$('#total_pendiente_hidden').val(total_pendiente);
$('#total_recibido_hidden').val(abonado);

document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
*/
</script>




                            <div class="m-n2">

                            <?php include_once('../admin/modal_registrar_tercero_venta_hotel.php'); ?>

                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form name="formulario" method="post" enctype="multipart/form-data" action="../admin/reg_alquilar_habitacion_libre_hotel_reg.php">
                                            <div class="row text-white text-center">
                                                <div class="col-12 bg-success border" style="text-align: center; font-size:24px;"><?php echo $sobrenombre_estado_habitacion_hotel ?></div>
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
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="../imagenes/boton_mas_blanco.png"></button>
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
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Fecha Ingreso</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Fecha Salida</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 border" style="text-align: center; font-size:24px;"><input type="date" name="fecha_ymd_parqueo_ini" id="fecha_ymd_parqueo_ini" value="<?php echo $fecha_ymd_parqueo_ini ?>" class="form-control" onchange="calcular_dias()" style="font-size:24px;" require></div>
                                                <div class="col-6 border" style="text-align: center; font-size:24px;"><input type="date" name="fecha_ymd_parqueo_fin" id="fecha_ymd_parqueo_fin" value="<?php echo $fecha_ymd_parqueo_fin ?>" class="form-control" onchange="calcular_dias()" style="font-size:24px;" require></div>
                                            </div>

                                            <div class="row text-white text-center">
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Precio</div>
                                                <div class="col-6 bg-success border" style="text-align: center; font-size:24px;">Total Pagar</div>
                                            </div>
                                            <div class="row text-white text-center">
                                                <div class="col-6 border" style="text-align: center; font-size:24px;"><?php echo number_format($precio_venta_producto) ?></div>
                                                <div class="col-6 border" style="text-align: center; font-size:24px;"><input type="text" name="total_venta_producto" id="total_venta_producto" class="form-control" style="text-align: center; font-size:24px;"></div>
                                            </div>

                                            <hr>
                                            <br>
                                            <input type="hidden" name="total_venta_producto_hidden" id="total_venta_producto_hidden">
                                            <input type="hidden" name="nombre_tipo_factura" id="nombre_tipo_factura" value="POS">
                                            <input type="hidden" name="nombre_tipo_moneda" id="nombre_tipo_moneda" value="COP">

                                            <input type="hidden" name="cod_producto" value="<?php echo $cod_producto ?>">
                                            <input type="hidden" name="cod_producto_barra" value="<?php echo $cod_producto_barra ?>">
                                            <input type="hidden" name="cod_venta_producto_temporal" value="<?php echo $cod_venta_producto_temporal ?>">
                                            <input type="hidden" name="cod_estado_habitacion_hotel" value="<?php echo $cod_estado_habitacion_hotel ?>">
                                            <input type="hidden" name="cod_tipo_habitacion_hotel" value="<?php echo $cod_tipo_habitacion_hotel ?>">
                                            <input type="hidden" name="precio_venta_producto" value="<?php echo $precio_venta_producto ?>">
                                            <input type="hidden" name="und_venta" id="und_venta" value="1">
                                            <input type="hidden" name="pagina" value="<?php echo $pagina ?>">

                                            <!-- Libre -->
                                            <?php if ($cod_estado_habitacion_hotel == '0') { ?>
                                            <button type="submit" class="btn btn-success" name="btn_enviar" value="btn_Alquilar">Alquilar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <!--<button type="submit" class="btn btn-warning" name="btn_enviar" value="btn_Reservar">Reservar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <!--<button type="submit" class="btn btn-info" name="btn_enviar" value="btn_Limpiar">Limpiar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <button type="submit" class="btn btn-light" name="btn_enviar" value="btn_Cancelar">Cancelar</button>
                                            <?php } ?>

                                            <!-- Ocupado -->
                                            <?php if ($cod_estado_habitacion_hotel == '1') { ?>
                                            <!--
                                            <button type="submit" class="btn btn-primary" name="btn_enviar" value="btn_Eliminar_Ocupado">Eliminar Alquiler</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-primary" name="btn_enviar" value="btn_Facturar_Ocupado">Facturar Alquiler</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-success" name="btn_enviar" value="btn_Modificar_Ocupado">Modificar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-info" name="btn_enviar" value="btn_Cancelar">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-light" name="btn_enviar" value="btn_Ver_Registros">Ver Registros</button>
                                            -->
                                            <?php } ?>

                                            <!-- Reservado -->
                                            <?php if ($cod_estado_habitacion_hotel == '2') { ?>
                                            <!--
                                            <button type="submit" class="btn btn-success" name="btn_enviar" value="btn_Eliminar_Reserva">Eliminar Reserva</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-success" name="btn_enviar" value="btn_Reserva_Alquilar">Registrar Alquiler</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-info" name="btn_enviar" value="btn_Modificar_Reserva">Modificar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-info" name="btn_enviar" value="btn_Ver_Registros">Ver Registros</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-light" name="btn_enviar" value="btn_Cancelar">Cancelar</button>
                                            -->
                                            <?php } ?>

                                            <!-- Limpieza -->
                                            <?php if ($cod_estado_habitacion_hotel == '3') { ?>
                                            <!--
                                            <button type="submit" class="btn btn-success" name="btn_enviar" value="btn_Eliminar_Limpieza">Eliminar Limpieza</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-light" name="btn_enviar" value="btn_Cancelar">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-light" name="btn_enviar" value="btn_Ver_Registros">Ver Registros</button>
                                            -->
                                            <?php } ?>

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
