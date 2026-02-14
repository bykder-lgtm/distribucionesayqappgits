<?php 
$nombre_pagina          = "Simulador de Credito";
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
if (isset($_GET['cod_nota_observacion'])) {
    $cod_nota_observacion                               = intval($_GET['cod_nota_observacion']);
    $cod_info_factura_venta                             = intval($_GET['cod_info_factura_venta']);
    $cod_tercero                                        = intval($_GET['cod_tercero']);
    //$pagina                                             = addslashes($_GET['pagina']);
    $pagina                                             = '../admin/lista_soportes_info_factura_venta_siscredito_visitante_intern.php';
    $pagina_redirect                                    = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta.'&cod_nota_observacion='.$cod_nota_observacion.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina;
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_info_fact = "SELECT cod_administrador_revisor FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
    $info_fact = mysqli_fetch_assoc($resultado_info_fact);

    $cod_administrador_revisor                          = $info_fact['cod_administrador_revisor'];
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_administrador_revisor = "SELECT telefono FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $resultado_administrador_revisor = mysqli_query($conectar, $obtener_administrador_revisor) or die(mysqli_error($conectar));
    $info_administrador_revisor = mysqli_fetch_assoc($resultado_administrador_revisor);

    $telefono_revisor                                   = $info_administrador_revisor['telefono'];
/* ----------------------------------------------------------------------------------------------------------/ */

    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_nota_observacion = '$cod_nota_observacion')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $cod_nota_observacion                           = $matriz_consulta['cod_nota_observacion'];
?>
    <!-- Start Cart -->
        <div id="salida_info_actualizada_carrito_compra_ajax">
            <div id="eliminar_ok" style="display:none;">&nbsp;</div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="contact-form-right">
                            <div class="row p-3 mb-2 bg-primary text-white">
                                <div class="col-md-6">
                                    <div style="text-align:center;" class="">Regresar</div>
                                </div>
                                <div class="col-md-6">
                                    <div style="text-align:center;" class="">Notificar Via WhatsApp</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div style="text-align:center;" class=""><a href="<?php echo $pagina_redirect ?>"><img src="../imagenes/listo.png" alt="listo"></a></div>
                                </div>
                                <div class="col-md-6">
                                    <div style="text-align:center;" class=""><a href="../admin/contactar_por_whatapp_soportes_info_factura_venta_revisor_siscredito_visitante_intern.php?cod_nota_observacion=<?php echo $cod_nota_observacion ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina ?>" target="_blank"><img src="../imagenes/btn_red_social_whatsapp.jpg" alt="listo"></a></div>
                                    <!--<div style="text-align:center;" class=""><a href="../admin/lista_soportes_info_factura_venta_siscredito_visitante_intern.php?cod_nota_observacion=<?php echo $cod_nota_observacion ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/btn_red_social_whatsapp.jpg" alt="listo"></a></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>