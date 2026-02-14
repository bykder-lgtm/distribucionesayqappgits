<section id="main-slider_css_slider" class="no-margin_css_slider">
    <div class="carousel slide">
        <ol class="carousel-indicators">
        <?php
        $contador1 = 0;
        $aumentar = -1;
        $sql_info_portafolio = "SELECT cod_producto, nombre_producto, descripcion_producto, url_img_orig_producto, url_img_min_producto, active_producto, cod_estado_destacado 
        FROM tbl15_producto WHERE (cod_estado_destacado = '1') ORDER BY posicion_destacado ASC";
        $cons_info_portafolio = mysqli_query($conectar, $sql_info_portafolio) or die(mysqli_error($conectar));
        while ($datos_info_portafolio = mysqli_fetch_assoc($cons_info_portafolio)) {

            $active_producto = $datos_info_portafolio['active_producto'];
            $aumentar ++;
            $contador1 ++;
            if ($contador1 == '1' && $active_producto == '') { $active_producto = 'active'; } else { $active_producto = ''; }
        ?>
        <!--<li data-target="#main-slider_css_slider" data-slide-to="<?php echo $aumentar ?>" class="<?php echo $active_producto ?>"></li>-->
        <?php } ?>
        </ol>
        <!--<div class="carousel-inner">-->

        <?php
        $contador = 0;
        $sql_info_portafolio = "SELECT cod_producto, nombre_producto, descripcion_producto, url_img_orig_producto, url_img_min_producto, active_producto, cod_estado_destacado 
        FROM tbl15_producto WHERE (cod_estado_destacado = '1') ORDER BY posicion_destacado ASC";
        $cons_info_portafolio = mysqli_query($conectar, $sql_info_portafolio) or die(mysqli_error($conectar));
        while ($datos_info_portafolio = mysqli_fetch_assoc($cons_info_portafolio)) {

            $cod_producto                               = $datos_info_portafolio['cod_producto'];
            $cod_producto_codif                         = DAXCODIFCRYPTOR::encodifdax($cod_producto);
            $cod_producto_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);
            $nombre_producto                            = $datos_info_portafolio['nombre_producto'];
            $descripcion_producto                       = $datos_info_portafolio['descripcion_producto'];
            $texto_boton_accion_producto                = "";
            $url_img_orig_producto                      = $datos_info_portafolio['url_img_orig_producto'];
            $url_img_min_producto                       = $datos_info_portafolio['url_img_min_producto'];
            $active_producto                            = $datos_info_portafolio['active_producto'];
            //$active_banner_slider                     = 'active';
            if ($texto_boton_accion_producto <> '') { $texto_boton_accion_producto = $texto_boton_accion_producto; } else { $texto_boton_accion_producto = 'Compra a crédito'; }
            $contador ++;
            if ($contador == '1' && $active_producto == '') { $active_producto = 'active'; } else { $active_producto = ''; }
        ?>
        <div class="item <?php echo $active_producto ?>" style="background-image: url(<?php echo $nombre_carpeta_pagina ?>/imagenes/fondo_slider_banner.jpg)">
            <div class="container">
                <div class="row slide-margin">
                    <div class="col-sm-6">
                        <div class="carousel-content">
                            <h2 id="h1_css_slider" class="animation animated-item-1"><?php echo $nombre_producto ?></h2>
                            <h2 id="h2_css_slider" class="animation animated-item-2"><?php echo (substr($descripcion_producto ,0 ,500)) ?></h2>
                            <a class="btn-slide animation animated-item-3" href="<?php echo $nombre_carpeta_pagina ?>/admin/producto_detalle_visitante_extnosesion.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>"><?php echo $texto_boton_accion_producto ?></a>
                            <!--<a class="btn-slide animation animated-item-3" href="../admin/portafolio_detalle.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>"><?php echo $texto_boton_accion_producto ?></a>-->
                        </div>
                    </div>
                    <div class="col-sm-6 hidden-xs animation animated-item-4">
                        <div class="slider-img">
                            <img src="<?php echo $nombre_carpeta_pagina ?>/<?php echo $nombre_carpeta_pagina ?>/<?php echo $url_img_orig_producto ?>" style="height:500px;" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.item-->
        <?php } ?>
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider_css_slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
    <a class="next hidden-xs" href="#main-slider_css_slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
</section><!--/#main-slider_css_slider-->