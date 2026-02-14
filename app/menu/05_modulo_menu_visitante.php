    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="../admin/ver_producto.php"><img src="../imagenes/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">

                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a class="nav-link" href="../admin/ver_producto_visitante.php">Tienda Virtual</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/carrito_compra_temporal_visitante.php">Carrito</a></li>
                            <li class="nav-item"><a class="nav-link" href="../session/salir.php?token=<?php echo $token ?>&pagina_salir=<?php echo $pagina_salir_visitante ?>">Salir</a></li>
                        </ul>
                </div>
<?php
$conteo = 0;
$sql_venta_producto_temporal = "SELECT * FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_carrito_compra_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_venta_producto_temporal);
?>
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="side-menu"><a href="#"><i class="fa fa-shopping-bag"></i><span class="badge" id="total_reg_carrito"><div id="salida_info_actualizada_carrito_compra_menu_total_reg_ajax"><?php echo $total_reg ?></div></span></a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list" id="salida_info_actualizada_carrito_compra_menu_ajax">
<?php
$total_venta = 0;

while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$conteo++;
$cod_carrito_compra_temporal              = $datos_venta_producto_temporal['cod_carrito_compra_temporal'];
$cod_producto                             = $datos_venta_producto_temporal['cod_producto'];
$cod_producto_barra                       = $datos_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                          = $datos_venta_producto_temporal['nombre_producto'];
$cedula                                   = $datos_venta_producto_temporal['cedula'];
$nombre_cliente                           = $datos_venta_producto_temporal['nombre_cliente'];
$und_venta                                = $datos_venta_producto_temporal['und_venta'];
$precio_costo_producto                    = $datos_venta_producto_temporal['precio_costo_producto'];
$precio_compra_producto                   = $datos_venta_producto_temporal['precio_compra_producto'];
$total_costo_producto                     = $datos_venta_producto_temporal['total_costo_producto'];
$precio_venta_producto                    = $datos_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto                     = $datos_venta_producto_temporal['total_venta_producto'];
$nombre_tipo_producto                     = $datos_venta_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                       = $datos_venta_producto_temporal['posologia_cantidad'];
$posologia_peso                           = $datos_venta_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion                 = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion                = $datos_venta_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion                     = $datos_venta_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                          = $datos_venta_producto_temporal['cod_tipo_cobrar'];
$cod_info_factura_venta_carrito_compra    = $datos_venta_producto_temporal['cod_info_factura_venta_carrito_compra'];
$nombre_tipo_precio_venta                 = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
$und_producto                             = $datos_venta_producto_temporal['und_producto'];
$cajas_sobre                              = $datos_venta_producto_temporal['cajas_sobre'];
$und_sobre                                = $datos_venta_producto_temporal['und_sobre'];

$comentario_producto                      = $datos_venta_producto_temporal['comentario_producto'];
$placa_producto                           = $datos_venta_producto_temporal['placa_producto'];
$fecha_ymd_parqueo_ini                    = $datos_venta_producto_temporal['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini                   = $datos_venta_producto_temporal['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin                    = $datos_venta_producto_temporal['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin                   = $datos_venta_producto_temporal['fecha_hora_parqueo_fin'];
$url_img_min_producto                     = $datos_venta_producto_temporal['url_img_min_producto'];
$url_img_orig_producto                    = $datos_venta_producto_temporal['url_img_orig_producto'];
$total_venta                             += $und_venta * $precio_venta_producto;
?>
                        <li>
                            <a href="#" class="photo"><img src="<?php echo $url_img_min_producto ?>" class="cart-thumb" alt="" /></a>
                            <h6><a href="#"><?php echo $nombre_producto ?></a></h6>
                            <p><?php echo $und_venta ?>x - <span class="price">$<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></span></p>
                        </li>
<?php } ?>
                        <li class="total">
                            <a href="../admin/carrito_compra_temporal_visitante.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>
                            <span class="float-right"><strong></strong>$<?php echo number_format($total_venta, 0, ",", ".") ?></span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>