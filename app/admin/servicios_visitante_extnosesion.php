<?php 
$nombre_pagina          = "Servicios";
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
<link href="../estilo_css/animate_css_slider.min.css" rel="stylesheet">
<link href="../estilo_css/main_DarkSlateBlue_css_slider.css" rel="stylesheet">
<link href="../estilo_css/formulario_registro_cliente_visitante.css" rel="stylesheet">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />
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

        <div class="container">
            <div class="row">

                <div class="col-12">
                    <!--
                    <div class="single-product-details"><h2>Nuestros Servicios</h2></div>
                    -->
                    <hr>
                    <h2 style="text-align:center;" class="noo-sh-title">Nuestros Servicios</h2>
                    <hr>
                </div>
            <?php
                $sql_producto = "SELECT * FROM tbl15_portafolio_servicio WHERE (cod_estado = '1') ORDER BY cod_portafolio_servicio ASC";
                $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                    $cod_portafolio_servicio                      = $datos_producto['cod_portafolio_servicio'];
                    $cod_portafolio_servicio_codif                = DAXCODIFCRYPTOR::encodifdax($cod_portafolio_servicio);
                    $cod_portafolio_servicio_codifcryp            = DAXCODIFCRYPTOR::encriptardax($cod_portafolio_servicio_codif);
                    $nombre_portafolio_servicio                   = $datos_producto['nombre_portafolio_servicio'];
                    $descripcion_portafolio_servicio              = $datos_producto['descripcion_portafolio_servicio'];
                    $url_imagen                                   = $datos_producto['url_imagen'];
                    $cod_estado                                   = $datos_producto['cod_estado'];
            ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div style="text-align:center;" class="shop-cat-bo">
                        <img style="width:120px;" class="img-fluid" src="<?php echo $url_imagen ?>" alt="" />
                        <hr><h2 class="footer-company"><?php echo $nombre_portafolio_servicio ?></h2>
                        <!--<p><?php echo $descripcion_portafolio_servicio ?></p>-->
                    </div><hr>
                </div>
            <?php } ?>
            </div>
        </div>


    <div class="contact-box-main">
        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-info-center">
                        <div class="single-product-details"><h2>Lo que ofrecemos</h2></div>
                        <p class="footer-widget">Explore una variedad de opciones de crédito para ofrecer pagos flexibles a sus clientes.</p>
                        <div id="parent_entidad_crediticia" style="text-align:center;">
            <?php
                        $contado_entidad_crediticia = 0;
                        $sql_producto = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') ORDER BY cod_posicion ASC";
                        $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                        while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                            $cod_entidad_crediticia                        = $datos_producto['cod_entidad_crediticia'];
                            $nombre_entidad_crediticia                     = $datos_producto['nombre_entidad_crediticia'];
                            $url_entidad_crediticia_imag_min               = $datos_producto['url_entidad_crediticia_imag_min'];
                            $url_entidad_crediticia_imag_orig              = $datos_producto['url_entidad_crediticia_imag_orig'];
                            $contado_entidad_crediticia++;
            ?>
                            <div id="div<?php echo $contado_entidad_crediticia ?>_entidad_crediticia"><img style="width:150px;" src="<?php echo $url_entidad_crediticia_imag_orig ?>" class="" alt="" /></div>
            <?php } ?>
                            <div id="div7_entidad_crediticia" style="text-align:center;"><hr><a class="btn hvr-hover" href="../admin/lineas_credito_visitante_extnosesion.php">Explora Las Lineas de Credito</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-sm-12">
                    <div class="contact-form-right">
                        <div class="single-product-details"><h2>Plataforma</h2></div>
                        <div class="banner-frame"><img class="img-thumbnail img-fluid" src="../imagenes/servicio_acceso_plataforma.jpg" alt="" /></div>
                        <div style="text-align:center;"><hr><a class="btn hvr-hover" href="../admin/entrar_visitante_intern.php">Accede a la Plataforma</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Page -->

<?php //include_once("../admin/05_modulo_algunos_productos_extnosesion.php"); ?>
<?php //include_once("../admin/05_modulo_slider_marcas_footer_extnosesion.php"); ?>
<?php //include_once("../admin/08_modulo_instagram_extnosesion.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

</body>

</html>