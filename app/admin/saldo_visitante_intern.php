<?php 
$nombre_pagina          = "Compras";
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

$tab                                      = "producto";
$tab_codif                                = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                            = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                                    = "cod_producto";
$campo_codif                              = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                          = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                                     = "carrito";
$tipo_codif                               = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                           = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                                   = "registrar";
$accion_codif                             = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                                   = "cupon";
$origen_codif                             = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$tab1                                     = "tbl15_carrito_compra_temporal";
$tab_codif1                               = DAXCODIFCRYPTOR::encodiftextodax($tab1);
$tab_codifcryp1                           = DAXCODIFCRYPTOR::encriptardax($tab_codif1);

$tipo1                                    = "carrito";
$tipo_codif1                              = DAXCODIFCRYPTOR::encodiftextodax($tipo1);
$tipo_codifcryp1                          = DAXCODIFCRYPTOR::encriptardax($tipo_codif1);

$accion1                                  = "actualizar";
$accion_codif1                            = DAXCODIFCRYPTOR::encodiftextodax($accion1);
$accion_codifcryp1                        = DAXCODIFCRYPTOR::encriptardax($accion_codif1);

$origen1                                  = "tbl15_carrito_compra_temporal";
$origen_codif1                            = DAXCODIFCRYPTOR::encodiftextodax($origen1);
$origen_codifcryp1                        = DAXCODIFCRYPTOR::encriptardax($origen_codif1);

$campo                                    = "und_venta";
$campo_codif                              = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                          = DAXCODIFCRYPTOR::encriptardax($campo_codif);
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form>

<div id="eliminar_ok" style="display:none;">&nbsp;</div>

        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Documento</th>
                                    <th style="text-align:center;">Vendedor</th>
                                    <th style="text-align:center;">Saldo Actual</th>
                                    <th style="text-align:center;">ID</th>

                                </tr>
                            </thead>
                          <tbody>
<?php
$sql_total_tipo_factura = "SELECT cod_administrador, cuenta, nombre1_tercero, apellido1_tercero, correo, total_saldo_recarga, identificacion_tercero FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

$cod_administrador             = $datos_total_tipo_factura['cod_administrador'];
$cuenta                        = $datos_total_tipo_factura['cuenta'];
$nombre1_tercero               = $datos_total_tipo_factura['nombre1_tercero'];
$apellido1_tercero             = $datos_total_tipo_factura['apellido1_tercero'];
$correo                        = $datos_total_tipo_factura['correo'];
$total_saldo_recarga           = $datos_total_tipo_factura['total_saldo_recarga'];
$cedula_vendedor_tercero       = $datos_total_tipo_factura['identificacion_tercero'];
$cliente_vendedor_tercero      = $nombre1_tercero.' '.$apellido1_tercero;
?>
                                <tr>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cedula_vendedor_tercero ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cliente_vendedor_tercero ?></td>
                                    <td style="text-align:center;" class="total-pr"><?php echo number_format($total_saldo_recarga, 0, ",", ".") ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cod_administrador ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>