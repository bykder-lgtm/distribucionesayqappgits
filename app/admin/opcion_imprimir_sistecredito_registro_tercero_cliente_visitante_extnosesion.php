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
<html lang="en">
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
<?php //include_once("../pixel_facebook_js/pixel_facebook.php"); ?>
</head>

<body class="homepage">
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
if (isset($_GET['cod_tercero_codifcryp'])) { 

    $cod_tercero_codifcryp            = ($_GET['cod_tercero_codifcryp']);
    $cod_tercero_codif                = DAXCODIFCRYPTOR::descriptardax($cod_tercero_codifcryp);
    $cod_tercero                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_tercero_codif));

    $sql_producto_ind = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_producto_ind = mysqli_query($conectar, $sql_producto_ind) or die(mysqli_error($conectar));
    $datos_producto_ind = mysqli_fetch_assoc($consulta_producto_ind);

    $correo_tercero                          = $datos_producto_ind['correo_tercero'];
    $telefono1_tercero                       = $datos_producto_ind['telefono1_tercero'];
?>
    <!-- Start Shop Page  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h4>Se ha enviado correctamente el mensaje a nuestro sistema, dentro de poco nos contactaremos con usted.</h4>
                        <p>Correo: <?php echo ($correo_tercero) ?></p>
                        <p>Numero de Telefono: <?php echo ($telefono1_tercero) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- End About Page -->

<?php //include_once("../admin/05_modulo_algunos_productos_extnosesion.php"); ?>
<?php //include_once("../admin/05_modulo_slider_marcas_footer_extnosesion.php"); ?>
<?php //include_once("../admin/08_modulo_instagram_extnosesion.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<script src="../js/jquery_css_slider.js"></script>
<script src="../js/bootstrap_ccs_slider.min.js"></script>

<?php //include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>
</body>

</html>