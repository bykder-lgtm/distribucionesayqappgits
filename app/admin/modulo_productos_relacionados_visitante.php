            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
<?php
$sql_producto_component = "SELECT cod_producto, url_img_min_producto, nombre_producto, precio_venta_producto FROM tbl15_producto WHERE nombre_componente = '$nombre_componente'";
$consulta_producto_component = mysqli_query($conectar, $sql_producto_component) or die(mysqli_error($conectar));
while ($datos_producto_component = mysqli_fetch_assoc($consulta_producto_component)) {

$cod_producto                  = $datos_producto_component['cod_producto'];
$nombre_producto               = $datos_producto_component['nombre_producto'];
$precio_venta_producto         = $datos_producto_component['precio_venta_producto'];
$url_img_min_producto          = $datos_producto_component['url_img_min_producto'];
?>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="<?php echo $url_img_min_producto ?>" width="304" height="200px" class="img-rounde" alt="<?php echo $nombre_producto ?>">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="../admin/producto_detalle.php?cod_producto=<?php echo $cod_producto ?>" data-toggle="tooltip" data-placement="right" title="Ver Producto"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comparar"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Añadir a la lista de deseos"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Añadir al carrito</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4><?php echo $nombre_producto ?></h4>
                                    <h5> $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></h5>
                                </div>
                            </div>
                        </div>
<?php } ?>
                    </div>
                </div>
            </div>