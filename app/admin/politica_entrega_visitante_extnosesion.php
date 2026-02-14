<?php 
$nombre_pagina          = "Politica de Entrega";
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
                    <div class="single-product-details"><h2>Politica de Entrega</h2></div>
                    <p><?php echo ($info_entrega_info_empresa) ?></p>
                    <img class="" style="widht:50%" src="../imagenes/patrocinador_person.png" alt="" />
                </div>

                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid" src="../imagenes/quienes_somos_mision.jpg" alt="" />
                    </div>
                </div>
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