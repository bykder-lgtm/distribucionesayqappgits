        <div class="container">
            <div class="row">

                <div class="col-12">
                    <!--<h2 class="noo-sh-title">Nuestras Categorias</h2>-->
                    <div class="single-product-details"><h2>Nuestras Categorias</h2></div>
                </div>
<?php
$sql_producto = "SELECT * FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY cod_categoria ASC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

    $cod_categoria                   = $datos_producto['cod_categoria'];
    $nombre_categoria                = $datos_producto['nombre_categoria'];
    $nombre_categoria_codif          = DAXCODIFCRYPTOR::encodiftextodax($nombre_categoria);
    $nombre_categoria_codifcryp      = DAXCODIFCRYPTOR::encriptardax($nombre_categoria_codif);
    $descripcion_categoria           = $datos_producto['descripcion_categoria'];
    $url_categoria_min               = $datos_producto['url_categoria_min'];
    $url_categoria_orig              = $datos_producto['url_categoria_orig'];
?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="<?php echo $url_categoria_orig ?>" alt="" />
                        <a class="btn hvr-hover" href="../admin/ver_catalogo_producto_visitante_extnosesion.php?nombre_categoria_codifcryp=<?php echo $nombre_categoria_codifcryp ?>">VER MAS</a>
                        <hr><h2 class="footer-company"><?php echo $nombre_categoria ?></h2>
                        <p><?php echo $descripcion_categoria ?></p><hr>
                    </div>
                </div>
<?php } ?>
            </div>
        </div>