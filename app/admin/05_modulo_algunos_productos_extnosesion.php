    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">

                    <div class="col-12">
                        <!--<h1 class="noo-sh-title">Algunos de Nuestros Productos</h1>-->
                        <div class="single-product-details"><h2>Algunos de Nuestros Productos</h2></div>
                    </div>

                    <!--<div class="title-all text-left"> <h1>Algunos de Nuestros Productos</h1> </div>-->
                    <div class="featured-products-box owl-carousel owl-theme">
<?php
$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') ORDER BY nombre_producto DESC LIMIT 0, 30";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$contador++;
$cod_producto                      = $datos_producto['cod_producto'];
$cod_producto_codif                = DAXCODIFCRYPTOR::encodifdax($cod_producto);
$cod_producto_codifcryp            = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);

$nombre_producto                   = $datos_producto['nombre_producto'];
$und_inv                           = $datos_producto['und_inv'];
$precio_venta_producto             = $datos_producto['precio_venta_producto'];
$precio_venta_producto2            = $datos_producto['precio_venta_producto2'];
$descripcion_producto              = $datos_producto['descripcion_producto'];
$url_img_min_producto              = $datos_producto['url_img_min_producto'];
$url_img_orig_producto             = $datos_producto['url_img_orig_producto'];
$nombre_promocion                  = $datos_producto['nombre_promocion'];
$nombre_promocion_ing              = $datos_producto['nombre_promocion_ing'];
$cod_estado                        = $datos_producto['cod_estado'];
?>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="<?php echo $url_img_orig_producto ?>" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Contactar por WhatsApp" target="_blank"><i class="fas fa-comments"></i></a></li>
                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>&accion_codifcryp=<?php echo $accion_telefono_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Llamar" target="_blank"><i class="fas fa-phone"></i></a></li>
                                            <li><a href="../admin/producto_detalle.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Ver Producto"><i class="fas fa-image"></i></a></li>
                                        </ul>
                                        <?php if ($inicio_sesion == 'SI') { ?>
                                        <a class="cart" data-id="<?php echo $cod_producto_codifcryp ?>" id="<?php echo $cod_producto_codifcryp ?>">Agregar al Carrito</a>
                                        <?php } else { ?>
                                        <a  class="cart" href="../admin/producto_detalle.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="">Cotizar</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="why-text"><h4><?php echo $nombre_producto ?></h4><!--<h5> $9.79</h5>--></div>
                            </div>
                        </div>
<?php } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->