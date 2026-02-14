<?php 
$nombre_pagina          = "DashBoard";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

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
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_tienda                                     = $matriz_consulta['nombre_tienda'];
$nombre1_tercero                                   = $matriz_consulta['nombre1_tercero'];
$identificacion_tercero                            = $matriz_consulta['identificacion_tercero'];
$digito_tercero                                    = $matriz_consulta['digito_tercero'];
$direccion_tercero                                 = $matriz_consulta['direccion_tercero'];
$telefono1_tercero                                 = $matriz_consulta['telefono1_tercero'];
$correo_tercero                                    = $matriz_consulta['correo_tercero'];
$cod_pais                                          = $matriz_consulta['cod_pais'];
$cod_departamento                                  = $matriz_consulta['cod_departamento'];
$cod_municipio                                     = $matriz_consulta['cod_municipio'];
$nombre_tipo_cliente                               = $matriz_consulta['nombre_tipo_cliente'];
$nombre_tipo_regimen                               = $matriz_consulta['nombre_tipo_regimen'];
$nombre_tipo_impuesto                              = $matriz_consulta['nombre_tipo_impuesto'];
$url_img_orig_tienda                               = $matriz_consulta['url_img_orig_tienda'];
$url_img_min_tienda                                = $matriz_consulta['url_img_min_tienda'];

$sql_seguridad_usuario = "SELECT nombre_seguridad FROM tbl15_seguridad WHERE cod_seguridad = '$cod_seguridad_usuar'";
$consulta = mysqli_query($conectar, $sql_seguridad_usuario) or die(mysqli_error($conectar));
$matriz_seguridad_usuario = mysqli_fetch_assoc($consulta);

$nombre_seguridad                                 = $matriz_seguridad_usuario['nombre_seguridad'];
?>
    <!-- Start Cart -->
        <div id="salida_info_actualizada_carrito_compra_ajax">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="contact-form-right">

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center;" class=""><img src="<?php echo $url_img_min_tienda ?>" style="width:100px;"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center;" class="">Tienda: <?php echo $nombre_tienda ?></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center;" class="">Nombre Usuario: <?php echo $nombre_usuario ?> (<?php echo $cuenta_usuar ?>)</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center;" class="">Tipo Usuario: <?php echo $nombre_seguridad ?></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>