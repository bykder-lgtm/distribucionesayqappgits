<?php 
$nombre_pagina          = "Nosotros";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>
<?php //include_once("../admin/01_rastreador_geolocalizacion_gps_javacript.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<!--<meta name="description"               content="<?php echo $resena_info_empresa ?>">-->
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="<?php echo $usuario_redsocial_facebook ?>"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<!--<meta name="twitter:description"       content="<?php echo $resena_info_empresa ?>">-->
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_extnosesion.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_facebook.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante_extnosesion.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_extnosesion.php"); ?>
    <!-- End Main Top -->
<?php //include_once("../admin/06_modulo_estamos_en_mantenimiento_head_extnosesion.php"); ?>

<?php //include_once("../admin/06_modulo_imagen_head_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante_extnosesion.php"); ?>

<?php
$tab                               = "producto";
$tab_codif                         = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                             = "cod_producto";
$campo_codif                       = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                   = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                              = "carrito";
$tipo_codif                        = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                            = "registrar";
$accion_codif                      = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                            = "carrito";
$origen_codif                      = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$accion_whatapp                    = "redirecionar_whatapp";
$accion_whatapp_codif              = DAXCODIFCRYPTOR::encodiftextodax($accion_whatapp);
$accion_whatapp_codifcryp          = DAXCODIFCRYPTOR::encriptardax($accion_whatapp_codif);

$accion_telefono                   = "redirecionar_telefono";
$accion_telefono_codif             = DAXCODIFCRYPTOR::encodiftextodax($accion_telefono);
$accion_telefono_codifcryp         = DAXCODIFCRYPTOR::encriptardax($accion_telefono_codif);

$und_vendida                       = 1;
$und_vendida_codif                 = DAXCODIFCRYPTOR::encodifdax($und_vendida);
$und_vendida_codifcryp             = DAXCODIFCRYPTOR::encriptardax($und_vendida_codif);
?>

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias.php"); ?>

    <div class="about-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-product-details"><h2>Misión</h2></div>
                    <p><?php echo ($mision_info_empresa) ?></p>
                    <img class="" style="widht:50%" src="../imagenes/patrocinador_person.png" alt="" />
                </div>

                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid" src="../imagenes/quienes_somos_mision.jpg" alt="" />
                    </div>
                </div>
            </div>
            <div class="row my-5">

            <div class="row my-4">
                <div class="col-12">
                    <div class="single-product-details"><h2>Nuestros representantes de la marca</h2></div>
                </div>
<?php
$sql_info_nuestro_equipo = "SELECT * FROM tbl15_nuestro_equipo WHERE (cod_tipo_tercero = '7') AND (nombre_estado = 'ACTIVO')";
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
            

            <div class="row my-4">
                <div class="col-12">
                    <div class="single-product-details"><h2>Nuestros representantes regionales</h2></div>
                </div>
<?php
$sql_info_nuestro_equipo = "SELECT * FROM tbl15_nuestro_equipo WHERE (cod_tipo_tercero = '8') AND (nombre_estado = 'ACTIVO')";
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


<?php include_once("../admin/05_modulo_algunas_categorias_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/05_modulo_algunos_productos_extnosesion.php"); ?>
<?php //include_once("../admin/05_modulo_slider_marcas_footer_extnosesion.php"); ?>
<?php //include_once("../admin/08_modulo_instagram_extnosesion.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

</body>

</html>