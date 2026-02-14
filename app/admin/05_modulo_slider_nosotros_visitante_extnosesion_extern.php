<section id="main-slider_css_slider" class="no-margin_css_slider">
    <div class="carousel slide">
        <!--<ol class="carousel-indicators">-->
        <?php
        //$contador1 = 0;
        //$aumentar = -1;

        //$sql_info_portafolio = "SELECT * FROM tbl15_banner_slider WHERE (cod_estado = '1') ORDER BY RAND()";
        //$cons_info_portafolio = mysqli_query($conectar, $sql_info_portafolio) or die(mysqli_error($conectar));
        //while ($datos_info_portafolio = mysqli_fetch_assoc($cons_info_portafolio)) {

            //$active_banner_slider                      = $datos_info_portafolio['active_banner_slider'];
            //$aumentar ++;
            //$contador1 ++;
            //if ($contador1 == '1' && $active_banner_slider == '') { $active_banner_slider = 'active'; } else { $active_banner_slider = ''; }
        ?>
        <!--<li data-target="#main-slider_css_slider" data-slide-to="<?php echo $aumentar ?>" class="<?php echo $active_banner_slider ?>"></li>-->
        <?php //} ?>
        <!--</ol>-->
        <!--<div class="carousel-inner">-->
        <?php
        $contador = 0;
        $sql_info_portafolio = "SELECT * FROM tbl15_banner_slider WHERE (cod_estado = '1') ORDER BY RAND()";
        $cons_info_portafolio = mysqli_query($conectar, $sql_info_portafolio) or die(mysqli_error($conectar));
        while ($datos_info_portafolio = mysqli_fetch_assoc($cons_info_portafolio)) {

            $cod_banner_slider                          = $datos_info_portafolio['cod_banner_slider'];
            $cod_banner_slider_codif                    = DAXCODIFCRYPTOR::encodifdax($cod_banner_slider);
            $cod_banner_slider_codifcryp                = DAXCODIFCRYPTOR::encriptardax($cod_banner_slider_codif);
            $nombre_banner_slider                       = $datos_info_portafolio['nombre_banner_slider'];
            $descripcion_banner_slider                  = $datos_info_portafolio['descripcion_banner_slider'];
            $texto_boton_accion_banner_slider           = $datos_info_portafolio['texto_boton_accion_banner_slider'];
            $url_img_banner_slider_orig                 = $datos_info_portafolio['url_img_banner_slider_orig'];
            $url_img_banner_slider_min                  = $datos_info_portafolio['url_img_banner_slider_min'];
            $url_personaje_banner_slider                = $datos_info_portafolio['url_personaje_banner_slider'];
            $active_banner_slider                       = $datos_info_portafolio['active_banner_slider'];
            $url_accion_banner_slider                   = $datos_info_portafolio['url_accion_banner_slider'];
            $url_accion_banner_slider_final             = $url_accion_banner_slider.'?'.'cod_banner_slider_codifcryp='.$cod_banner_slider_codifcryp;
            //$active_banner_slider                     = 'active';
            if ($texto_boton_accion_banner_slider <> '') { $texto_boton_accion_banner_slider = $texto_boton_accion_banner_slider; } else { $texto_boton_accion_banner_slider = 'Leer Mas'; }
            $contador ++;
            if ($contador == '1' && $active_banner_slider == '') { $active_banner_slider = 'active'; } else { $active_banner_slider = 'active'; }
        ?>
        <div class="item <?php echo $active_banner_slider ?>" style="background-image: url(<?php echo $nombre_carpeta_pagina ?>/<?php echo $nombre_carpeta_pagina ?>/<?php echo $url_img_banner_slider_orig ?>)">
            <div class="container">
                <div class="row slide-margin">
                    <div class="col-sm-6">
                        <div class="carousel-content">
                            <h2 id="h1_css_slider" class="animation animated-item-1"><?php echo $nombre_banner_slider ?></h2>
                            <h2 id="h2_css_slider" class="animation animated-item-2"><?php echo (substr($descripcion_banner_slider ,0 ,500)) ?></h2>
                            <a class="btn-slide animation animated-item-3" href="<?php echo $nombre_carpeta_pagina ?>/<?php echo $url_accion_banner_slider_final ?>"><?php echo $texto_boton_accion_banner_slider ?></a>
                            <!--<a class="btn-slide animation animated-item-3" href="../admin/portafolio_detalle.php?cod_banner_slider=<?php echo $cod_banner_slider ?>"><?php echo $texto_boton_accion_banner_slider ?></a>-->
                        </div>
                    </div>
                    <div class="col-sm-6 hidden-xs animation animated-item-4">
                        <div class="slider-img">
                            <img src="<?php echo $nombre_carpeta_pagina ?>/<?php echo $nombre_carpeta_pagina ?>/<?php echo $url_personaje_banner_slider ?>" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.item-->
        <?php } ?>
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
<!--
    <a class="prev hidden-xs" href="#main-slider_css_slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
    <a class="next hidden-xs" href="#main-slider_css_slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
-->
</section><!--/#main-slider_css_slider-->