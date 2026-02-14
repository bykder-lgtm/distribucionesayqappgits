    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
<?php
$sql_producto = "SELECT * FROM tbl15_banner_slider WHERE (nombre_estado = 'ACTIVO') ORDER BY cod_banner_slider ASC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

    $cod_banner_slider                 = $datos_producto['cod_banner_slider'];
    $cod_banner_slider_codif           = DAXCODIFCRYPTOR::encodifdax($cod_banner_slider);
    $cod_banner_slider_codifcryp       = DAXCODIFCRYPTOR::encriptardax($cod_banner_slider_codif);

    $nombre_banner_slider              = $datos_producto['nombre_banner_slider'];
    $descripcion_banner_slider         = $datos_producto['descripcion_banner_slider'];
    $url_img_banner_slider_orig        = $datos_producto['url_img_banner_slider_orig'];
    $url_img_banner_slider_min         = $datos_producto['url_img_banner_slider_min'];
    $alineacion_texto_banner_slider    = $datos_producto['alineacion_texto_banner_slider'];
    $cod_estado                        = $datos_producto['cod_estado'];
?>
            <li class="<?php echo $alineacion_texto_banner_slider ?>">
                <img src="<?php echo $url_img_banner_slider_orig ?>" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong><?php //echo $nombre_banner_slider ?></strong></h1>
                            <p class="m-b-40"><?php echo $descripcion_banner_slider ?></p>
                            <!--<p><a class="btn hvr-hover" href="#">Ver Más</a></p>-->
                        </div>
                    </div>
                </div>
            </li>
<?php } ?>
        </ul>
    <!--
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    -->
    </div>
    <!-- End Slider -->