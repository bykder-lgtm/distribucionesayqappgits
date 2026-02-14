    <div class="about-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
<?php
$sql_info_principal_resena = "SELECT * FROM tbl15_resena";
$cons_info_principal_resena = mysqli_query($conectar, $sql_info_principal_resena) or die(mysqli_error($conectar));
while ($dato_principal_resena = mysqli_fetch_assoc($cons_info_principal_resena)) {

$cod_resena                       = $dato_principal_resena['cod_resena'];
$nombre_resena                    = $dato_principal_resena['nombre_resena'];
$descripcion_resena               = $dato_principal_resena['descripcion_resena'];
$url_imagen                       = $dato_principal_resena['url_imagen'];
?>
                    <!--<h2 class="noo-sh-title">Nuestra <span><?php echo $nombre_resena ?></span></h2>-->
                    <div class="single-product-details"><h2>Nuestra <span><?php echo ($nombre_resena) ?></span></h2></div>
                    <p><?php echo ($descripcion_resena) ?></p>
<?php } ?>
                </div>
                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid" src="../imagenes/quienes_somos.jpg" alt="" />
                    </div>
                </div>
            </div>
            <div class="row my-5">
<?php
$sql_info_principal_mision = "SELECT * FROM tbl15_mision";
$cons_info_principal_mision = mysqli_query($conectar, $sql_info_principal_mision) or die(mysqli_error($conectar));
while ($dato_principal_mision = mysqli_fetch_assoc($cons_info_principal_mision)) {

$cod_mision                       = $dato_principal_mision['cod_mision'];
$nombre_mision                    = $dato_principal_mision['nombre_mision'];
$descripcion_mision               = $dato_principal_mision['descripcion_mision'];
$url_imagen                       = $dato_principal_mision['url_imagen'];
?>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <!--<h3>Nuestra <?php echo $nombre_mision ?></h3>-->
                        <div class="single-product-details"><h2>Nuestra <span><?php echo ($nombre_mision) ?></span></h2></div>
                        <p><?php echo (($descripcion_mision)) ?></p>
                    </div>
                </div>
<?php } ?>

<?php
$sql_info_principal_vision = "SELECT * FROM tbl15_vision";
$cons_info_principal_vision = mysqli_query($conectar, $sql_info_principal_vision) or die(mysqli_error($conectar));
while ($dato_principal_vision = mysqli_fetch_assoc($cons_info_principal_vision)) {

$cod_vision                       = $dato_principal_vision['cod_vision'];
$nombre_vision                    = $dato_principal_vision['nombre_vision'];
$descripcion_vision               = $dato_principal_vision['descripcion_vision'];
$url_imagen                       = $dato_principal_vision['url_imagen'];
?>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <!--<h3>Nuestra <?php echo $nombre_vision ?></h3>-->
                        <div class="single-product-details"><h2>Nuestra <span><?php echo ($nombre_vision) ?></span></h2></div>
                        <p><?php echo (($descripcion_vision)) ?></p>
                    </div>
                </div>
<?php } ?>

            </div>
            <div class="row my-4">
                <div class="col-12">
                    <div class="single-product-details"><h2>Nuestro Equipo</h2></div>
                    <!--<h2 class="noo-sh-title">Nuestro Equipo</h2>-->
                </div>
<?php
$sql_info_nuestro_equipo = "SELECT * FROM tbl15_nuestro_equipo WHERE (nombre_estado = 'ACTIVO')";
$cons_info_nuestro_equipo = mysqli_query($conectar, $sql_info_nuestro_equipo) or die(mysqli_error($conectar));
while ($dato_nuestro_equipo = mysqli_fetch_assoc($cons_info_nuestro_equipo)) {
                                         
$cod_nuestro_equipo               = $dato_nuestro_equipo['cod_nuestro_equipo'];
$nombre_nuestro_equipo            = $dato_nuestro_equipo['nombre_nuestro_equipo'];
$nombre_cargo                     = $dato_nuestro_equipo['nombre_cargo'];
$url_img_equipo_min               = $dato_nuestro_equipo['url_img_equipo_min'];
$url_img_equipo_orig              = $dato_nuestro_equipo['url_img_equipo_orig'];
$url_redsocial_facebook           = $dato_nuestro_equipo['url_redsocial_facebook'];
$url_redsocial_twitter            = $dato_nuestro_equipo['url_redsocial_twitter'];
$url_redsocial_linkedin           = $dato_nuestro_equipo['url_redsocial_linkedin'];
$url_redsocial_skype              = $dato_nuestro_equipo['url_redsocial_skype'];
$url_redsocial_instagram          = $dato_nuestro_equipo['url_redsocial_instagram'];
$url_redsocial_pinterest          = $dato_nuestro_equipo['url_redsocial_pinterest'];
$url_redsocial_generic1           = $dato_nuestro_equipo['url_redsocial_generic1'];
$url_redsocial_generic2           = $dato_nuestro_equipo['url_redsocial_generic2'];
?>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="<?php echo $url_img_equipo_orig ?>" alt="" />
                            <div class="team-content">
                                <h3 class="title"><?php echo $nombre_nuestro_equipo ?></h3> <span class="post"><?php echo $nombre_cargo ?></span> </div>
                            <ul class="social">
                                <li><a href="<?php echo $url_redsocial_facebook ?>" target="_blank" class="fab fa-facebook"></a></li>
                                <li><a href="<?php echo $url_redsocial_twitter ?>" target="_blank" class="fab fa-twitter"></a></li>
                                <li><a href="<?php echo $url_redsocial_generic1 ?>" target="_blank" class="fab fa-google-plus"></a></li>
                                <li><a href="<?php echo $url_redsocial_generic2 ?>" target="_blank" class="fab fa-youtube"></a></li>
                            </ul>
                            <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                        </div>
                        <!--<div class="team-description"><p>Lorem ipsum dolor sit amette.</p></div>-->
                        <hr class="my-0"> 
                    </div>
                </div>
<?php } ?>
            </div>
        </div>
    </div>
    <!-- End About Page -->