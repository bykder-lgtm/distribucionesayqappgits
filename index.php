<?php 
$nombre_pagina          = "Inicio";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("app/admin/01_modulo_diseno_superior_visitante_extnosesion_extern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once($nombre_carpeta_pagina."/admin/01_info_empresa_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("admin/01_rastreador.php"); ?>
<?php //include_once("admin/01_rastreador_geolocalizacion_gps_javacript.php"); ?>

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

<?php include_once($nombre_carpeta_pagina."/admin/03_modulo_css_visitante_extnosesion_extern.php"); ?>
<link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/whatsapp_messenger_flotante.css">
<link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/animate_css_slider.min.css">
<link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/main_DarkSlateBlue_css_slider.css">
<link href="<?php echo $nombre_carpeta_pagina ?>/imagenes/icono.ico" type="image/x-icon" rel="shortcut icon" />

<?php //include_once("pixel_facebook_js/pixel_facebook.php"); ?>
</head>

<body class="homepage">
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante_extnosesion.php"); ?>
    <!-- Start Main Top -->
<?php include_once($nombre_carpeta_pagina."/seguridad/seguridad_diseno_plantillas_visitante_extnosesion_extern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("admin/06_modulo_estamos_en_mantenimiento_head_extnosesion.php"); ?>

<?php //include_once("admin/06_modulo_imagen_head_visitante_extnosesion.php"); ?>

<?php //include_once("admin/04_modulo_titulo_pagina_visitante_extnosesion.php"); ?>

<?php //include_once("admin/05_modulo_slider_visitante_extnosesion.php"); ?>

<?php //include_once($nombre_carpeta_pagina."/admin/05_modulo_slider_nosotros_visitante_extnosesion_extern.php"); ?>

<?php //include_once($nombre_carpeta_pagina."/admin/05_modulo_slider_estatico_extnosesion_extern.php"); ?>
<?php include_once($nombre_carpeta_pagina."/admin/05_modulo_slider_nosotros_visitante_extnosesion_extern.php"); ?>
<?php //include_once($nombre_carpeta_pagina."/admin/05_modulo_slider_producto_destacado_extnosesion_extern.php"); ?>

<?php //include_once("admin/05_modulo_quienes_somos_y_equipo.php"); ?>

<?php //include_once("admin/05_modulo_algunas_categorias.php"); ?>

    <div class="about-box-main">
        <div class="container">
<!--
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-product-details"><h2>Somos tu mejor <span>aliado</span></h2></div>
                    <p><?php echo ($resena_info_empresa) ?></p>
                    <img class="" src="<?php echo $nombre_carpeta_pagina ?>/imagenes/patrocinador_person.png" alt="" />
                </div>

                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid" src="<?php echo $nombre_carpeta_pagina ?>/imagenes/quienes_somos.jpg" alt="" />
                    </div>
                </div>
            </div>
-->
            <div class="row my-5">

            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="<?php echo $nombre_carpeta_pagina ?>/archivador/img_producto/orig/publicidad_entidad_crediticia_01.jpg" alt="" />
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="<?php echo $nombre_carpeta_pagina ?>/archivador/img_producto/orig/publicidad_entidad_crediticia_02.jpg" alt="" />
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="<?php echo $nombre_carpeta_pagina ?>/archivador/img_producto/orig/publicidad_entidad_crediticia_03.jpg" alt="" />
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="<?php echo $nombre_carpeta_pagina ?>/archivador/img_producto/orig/publicidad_entidad_crediticia_04.jpg" alt="" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End About Page -->


<?php include_once($nombre_carpeta_pagina."/admin/05_modulo_algunas_categorias_visitante_extnosesion_extern.php"); ?>

<?php //include_once("admin/05_modulo_algunos_productos_extnosesion.php"); ?>
<?php //include_once("admin/05_modulo_slider_marcas_footer_extnosesion.php"); ?>
<?php //include_once("admin/08_modulo_instagram_extnosesion.php"); ?>
<?php //include_once("admin/09_modulo_chat_messenger_facebook.php"); ?>
<?php //include_once("admin/09_modulo_chat_whatsapp.php"); ?>
<?php include_once($nombre_carpeta_pagina."/admin/09_modulo_chat_whatsapp_visitante_extnosesion_extern.php"); ?>

<?php include_once($nombre_carpeta_pagina."/admin/09_modulo_footer_visitante_extnosesion_extern.php"); ?>

<script src="<?php echo $nombre_carpeta_pagina ?>/js/jquery_css_slider.js"></script>
<script src="<?php echo $nombre_carpeta_pagina ?>/js/bootstrap_ccs_slider.min.js"></script>

<?php //include_once("admin/10_modulo_js_visitante_extnosesion.php"); ?>
</body>

</html>