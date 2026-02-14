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
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_visita.php">Visitas</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_usuario.php">Registrados</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_recurso.php">Recursos</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_campanya.php">Campañas</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/estadistica_proyeccion_visita_dia.php">Estadisticas</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/salir.php">Salir</a></li>
                        </ul>
                </div>
<?php
$conteo = 0;
$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_vendida, precio_venta_producto, 
vlr_total_venta, url_img_min_producto, url_img_orig_producto FROM tbl15_carrito_compra_temporal WHERE (vendedor = '$vendedor') 
ORDER BY cod_carrito_compra_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_producto);
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

while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_carrito_compra_temporal         = $datos_producto['cod_carrito_compra_temporal'];
$nombre_producto                     = $datos_producto['nombre_producto'];
$und_vendida                         = $datos_producto['und_vendida'];
$precio_venta_producto               = $datos_producto['precio_venta_producto'];
$vlr_total_venta                     = $datos_producto['vlr_total_venta'];
$url_img_min_producto                = $datos_producto['url_img_min_producto'];
$url_img_orig_producto               = $datos_producto['url_img_orig_producto'];
$total_venta                        += $und_vendida * $precio_venta_producto;
?>
                        <li>
                            <a href="#" class="photo"><img src="<?php echo $url_img_min_producto ?>" class="cart-thumb" alt="" /></a>
                            <h6><a href="#"><?php echo $nombre_producto ?></a></h6>
                            <p><?php echo $und_vendida ?>x - <span class="price">$<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></span></p>
                        </li>
<?php } ?>
                        <li class="total">
                            <a href="../admin/carrito_compra_temporal.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>
                            <span class="float-right"><strong></strong>$<?php echo number_format($total_venta, 0, ",", ".") ?></span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>