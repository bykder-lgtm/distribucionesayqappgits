<?php 
$nombre_pagina          = "Carrito de Compra";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_confirmdirect.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_confirmdirect.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante_intern_confirmdirect.php"); ?>
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
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern_confirmdirect.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
$tab_elim                                     = "tbl15_carrito_compra_temporal";
$tab_elim_codif                               = DAXCODIFCRYPTOR::encodiftextodax($tab_elim);
$tab_elim_codifcryp                           = DAXCODIFCRYPTOR::encriptardax($tab_elim_codif);

$campo_elim                                   = "cod_carrito_compra_temporal";
$campo_elim_codif                             = DAXCODIFCRYPTOR::encodiftextodax($campo_elim);
$campo_elim_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($campo_elim_codif);

$tipo_elim                                    = "eliminar";
$tipo_elim_codif                              = DAXCODIFCRYPTOR::encodiftextodax($tipo_elim);
$tipo_elim_codifcryp                          = DAXCODIFCRYPTOR::encriptardax($tipo_elim_codif);

$tipo                                         = "carrito";
$tipo_codif                                   = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                               = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                                       = "registrar";
$accion_codif                                 = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                             = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                                       = "carrito";
$origen_codif                                 = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                             = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$accion_whatapp                               = "redirecionar_whatapp";
$accion_whatapp_codif                         = DAXCODIFCRYPTOR::encodiftextodax($accion_whatapp);
$accion_whatapp_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($accion_whatapp_codif);

$accion_telefono                              = "redirecionar_telefono";
$accion_telefono_codif                        = DAXCODIFCRYPTOR::encodiftextodax($accion_telefono);
$accion_telefono_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($accion_telefono_codif);

if (isset($_GET['cod_info_factura_venta_carrito_compra'])) {
    $cod_info_factura_venta_carrito_compra        = intval($_GET['cod_info_factura_venta_carrito_compra']);
    $cod_info_factura_venta                       = intval($_GET['cod_info_factura_venta']);
    $info_pedido_producto_concat                  = "";

    $sql_profesional = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $resultado_profesional = mysqli_query($conectar, $sql_profesional);
    $info_profesional = mysqli_fetch_assoc($resultado_profesional);

    $cod_factura                       = $info_profesional['cod_factura'];
    $cod_tercero                       = $info_profesional['cod_tercero'];
    $cod_caja_virtual                  = $info_profesional['cod_caja_virtual'];
    $cod_resolucion_facturacion        = $info_profesional['cod_resolucion_facturacion'];
    $cod_tipo_pago                     = $info_profesional['cod_tipo_pago'];
    $cod_tipo_forma_pago               = $info_profesional['cod_tipo_forma_pago'];
    $nombre_tipo_factura               = $info_profesional['nombre_tipo_factura'];
    $nombre_tipo_moneda                = $info_profesional['nombre_tipo_moneda'];
    $cod_tipo_metodo_envio             = $info_profesional['cod_tipo_metodo_envio'];
    $cod_tipo_pedido                   = $info_profesional['cod_tipo_pedido'];
    $cod_zona_envio                    = $info_profesional['cod_zona_envio'];
    $fecha_anyo                        = $info_profesional['fecha_anyo'];

    $sql_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $total_reg = mysqli_num_rows($consulta_producto);
    while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

        $cod_venta_producto                       = $datos_producto['cod_venta_producto'];
        $nombre_producto                          = $datos_producto['nombre_producto'];
        $und_venta                                = $datos_producto['und_venta'];
        $precio_venta_producto                    = $datos_producto['precio_venta_producto'];
        $total_venta_producto                     = $datos_producto['total_venta_producto'];
        ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
        if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
        if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
        $total_venta_ind                          = $und_venta * $precio_venta_producto;
        $total_venta                             += $und_venta * $precio_venta_producto;
        $info_pedido_producto_concat             .= '<strong>X'.$und_venta.' '.$nombre_producto.' $'.$precio_venta_producto.'</strong>';
    }
}
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form>

        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">

                        <table class="table">
                            <tr>
                                <th style="text-align:left;">Numero de compra:</th>
                                <th style="text-align:right;"><?php echo $cod_factura ?></th>
                            </tr>
                            <tr>
                                <th style="text-align:left;">Fecha de compra:</th>
                                <th style="text-align:right;"><?php echo $fecha_anyo ?></th>
                            </tr>
                            <tr>
                                <th style="text-align:left;">Correo de compra:</th>
                                <th style="text-align:right;"><?php echo $correo ?></th>
                            </tr>
                            <tr>
                                <th style="text-align:left;">Total de la compra:</th>
                                <th style="text-align:right;"><?php echo number_format($total_venta, 0, ",", ".") ?></th>
                            </tr>
                            <tr>
                                <th style="text-align:left;">Metodo de pago:</th>
                                <th style="text-align:right;">Pago mediante saldo en monedero</th>
                            </tr>
                            <tr>
                                <th style="text-align:left;">Id  de Pedido: </th>
                                <th style="text-align:right;"><?php echo $cod_info_factura_venta ?></th>
                            </tr>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Detalles de la compra</th>
                                </tr>
                            </thead>
                        </table>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:left;">Producto</th>
                                    <th style="text-align:right;">Total</th>
                                </tr>
                            </thead>
<?php
                                $sql_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
                                $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                                $total_reg = mysqli_num_rows($consulta_producto);
                                while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                                    $cod_venta_producto                       = $datos_producto['cod_venta_producto'];
                                    $nombre_producto                          = $datos_producto['nombre_producto'];
                                    $und_venta                                = $datos_producto['und_venta'];
                                    $precio_venta_producto                    = $datos_producto['precio_venta_producto'];
                                    $total_venta_producto                     = $datos_producto['total_venta_producto'];
                                    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
                                    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
                                    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
                                    $total_venta_ind                          = $und_venta * $precio_venta_producto;
                                    $total_venta                             += $und_venta * $precio_venta_producto;
?>
                                <tr>
                                    <th style="text-align:left;"><?php echo $nombre_producto ?></th>
                                    <th style="text-align:right;"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></th>
                                </tr>
<?php
                                }
?>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:left;">Subtotal:</th>
                                    <th style="text-align:right;"><?php echo number_format($total_venta, 0, ",", ".") ?></th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Metodo de pago:</th>
                                    <th style="text-align:right;">Pago mediante saldo en monedero</th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Total de la compra:</th>
                                    <th style="text-align:right;"><?php echo number_format($total_venta, 0, ",", ".") ?></th>
                                </tr>
                            </thead>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Tu(s) clave(s) de licencia</th>
                                </tr>
                            </thead>
                        </table>

                        <table class="table">
<?php
                                $sql_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
                                $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                                $total_reg = mysqli_num_rows($consulta_producto);
                                while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                                    $cod_venta_producto                       = $datos_producto['cod_venta_producto'];
                                    $nombre_producto                          = $datos_producto['nombre_producto'];
                                    $und_venta                                = $datos_producto['und_venta'];
                                    $precio_venta_producto                    = $datos_producto['precio_venta_producto'];
                                    $total_venta_producto                     = $datos_producto['total_venta_producto'];

                                    $correo_cuenta_servicio                   = $datos_producto['correo_cuenta_servicio'];
                                    $contrasena_cuenta_servicio               = $datos_producto['contrasena_cuenta_servicio'];
                                    $perfil_cuenta_servicio                   = $datos_producto['perfil_cuenta_servicio'];
                                    $pin_cuenta_servicio                      = $datos_producto['pin_cuenta_servicio'];
                                    $cliente_cuenta_servicio                  = $datos_producto['cliente_cuenta_servicio'];
                                    $vence_cuenta_servicio                    = $datos_producto['vence_cuenta_servicio'];
                                    $precio_cuenta_servicio                   = $datos_producto['precio_cuenta_servicio'];
                                    $cod_producto_sub                         = $datos_producto['cod_producto_sub'];

                                    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
                                    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
                                    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
                                    $total_venta_ind                          = $und_venta * $precio_venta_producto;
                                    $total_venta                             += $und_venta * $precio_venta_producto;
?>
                                <thead>
                                <tr>
                                    <th style="text-align:center;" colspan='2'><?php echo $nombre_producto ?></th>
                                </tr>
                                </thead>
                                <tr>
                                    <th style="text-align:left;">Valido por: </th>
                                    <th style="text-align:right;">30 dias (Valido hasta <?php echo $vence_cuenta_servicio ?>)</th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Correo: </th>
                                    <th style="text-align:right;"><?php echo $correo_cuenta_servicio ?></th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Contraseña: </th>
                                    <th style="text-align:right;"><?php echo $contrasena_cuenta_servicio ?></th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Perfil: </th>
                                    <th style="text-align:right;"><?php echo $perfil_cuenta_servicio ?></th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Codsubp: </th>
                                    <th style="text-align:right;"><?php echo $cod_producto_sub ?></th>
                                </tr>
<?php
                                }
?>
                        </table>
<!--
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Casi terminando...</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">Id  de Pedido: <?php echo $cod_info_factura_venta ?></th>
                                </tr>
                            </thead>
                        </table>

                        <div class="col-xl-12 col-lg-5 col-md-6">
                            <div class="single-product-details">
                            <h2><div style="text-align:center;" id="texto_resaltado">ACCIÓN NECESARIA</div></h2>
                            <h3><div style="text-align:center;" id="texto_resaltado">Enviar confirmación via WhatsApp</div></h3>
                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;"><a href="../admin/ver_factura_venta_visitante_intern_confirmdirect_confirmada_whatsapp.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" target="_blank"><img src="../imagenes/btn_tel_whatapp_solo.png" /><br>Enviar</a></th>
                                </tr>
                            </thead>
                        </table>
-->
                    </div>
                </div>
            </div>

        </div>

        </form>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern_confirmdirect.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_confirmdirect.php"); ?>

</body>

</html>