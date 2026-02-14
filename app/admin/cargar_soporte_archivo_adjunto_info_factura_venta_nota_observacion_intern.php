<?php 
$nombre_pagina          = "Adjuntar Soporte";
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
$tab_elim                          = "tbl15_carrito_compra_temporal";
$tab_elim_codif                    = DAXCODIFCRYPTOR::encodiftextodax($tab_elim);
$tab_elim_codifcryp                = DAXCODIFCRYPTOR::encriptardax($tab_elim_codif);

$campo_elim                        = "cod_carrito_compra_temporal";
$campo_elim_codif                  = DAXCODIFCRYPTOR::encodiftextodax($campo_elim);
$campo_elim_codifcryp              = DAXCODIFCRYPTOR::encriptardax($campo_elim_codif);

$tipo_elim                         = "eliminar";
$tipo_elim_codif                   = DAXCODIFCRYPTOR::encodiftextodax($tipo_elim);
$tipo_elim_codifcryp               = DAXCODIFCRYPTOR::encriptardax($tipo_elim_codif);

$cuenta                            = addslashes($_GET['cuenta']);
$cod_caja_virtual                  = addslashes($_GET['cod_caja_virtual']);
$nombre_estado_factura             = addslashes($_GET['nombre_estado_factura']);
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
    <form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/cargar_soporte_archivo_adjunto_info_factura_venta_nota_observacion_intern_reg.php">
        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <tr>
                                <td><input type="file" id="url_img1" name="url_img1" multiple required/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" name="cuenta" value="<?php echo $cuenta ?>"/>
            <input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual ?>"/>
            <input type="hidden" name="nombre_estado_factura" value="<?php echo $nombre_estado_factura ?>"/>
            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
            <input type="hidden" name="insertar_datos" value="formulario">
            <div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Guardar Soporte</button>
        </div>
    </div>
    </form>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>