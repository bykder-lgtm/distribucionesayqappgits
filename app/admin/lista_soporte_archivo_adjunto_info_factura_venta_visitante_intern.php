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
                                    <th style="text-align:center;">ID</th>
                                    <th style="text-align:center;">Nota Observacion</th>
                                    <th style="text-align:center;">Tipo</th>
                                    <th style="text-align:center;">Fecha</th>
                                    <th style="text-align:center;">Hora</th>
                                    <th style="text-align:center;">Usuario</th>
                                    <th style="text-align:center;">Soporte</th>
                                </tr>
                            </thead>
                          <tbody>
<?php
$cod_info_factura_venta                   = intval($_GET['cod_info_factura_venta']);
$cod_cliente                              = 0;
$conteo                                   = 0;
$total_venta                              = 0;
$incre                                    = 0;
$smtr_iva_valor                           = 0;

$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_nota_observacion DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_nota_observacion                           = $matriz_consulta['cod_nota_observacion'];
    $nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];
    $fecha_ymd                                      = $matriz_consulta['fecha_ymd'];
    $fecha_hora                                     = $matriz_consulta['fecha_hora'];
    $cuenta                                         = $matriz_consulta['cuenta'];
    $cod_tipo_nota_observacion                      = $matriz_consulta['cod_tipo_nota_observacion'];
    $cod_info_factura_compra                        = $matriz_consulta['cod_info_factura_compra'];
    $cod_info_cotizacion_factura_compra             = $matriz_consulta['cod_info_cotizacion_factura_compra'];
    $cod_info_cotizacion_factura_venta              = $matriz_consulta['cod_info_cotizacion_factura_venta'];
    $cod_info_factura_auditoria                     = $matriz_consulta['cod_info_factura_auditoria'];
    $cod_info_factura_transferencia                 = $matriz_consulta['cod_info_factura_transferencia'];
    $cod_info_factura_transferencia_bodega_entrada  = $matriz_consulta['cod_info_factura_transferencia_bodega_entrada'];
    $cod_info_factura_transferencia_bodega          = $matriz_consulta['cod_info_factura_transferencia_bodega'];
    $cod_movimiento_contable                        = $matriz_consulta['cod_movimiento_contable'];
    $cod_egreso                                     = $matriz_consulta['cod_egreso'];
    $url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
    $url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];
    $cod_posicion                                   = $matriz_consulta['cod_posicion'];
    $active                                         = $matriz_consulta['active'];

    if ($active == 1) { $url_img_active = "../imagenes/active.png"; } else { $url_img_active = "../imagenes/inactive.png"; }

    if (($cod_tipo_nota_observacion == 0) && ($url_img_orig_producto <> '')) { //NOTAS Y OBSERVACIONES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_nota_observacion='.$cod_nota_observacion;
    } elseif (($cod_tipo_nota_observacion == 1) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE VENTA
        $url_redirect_recurso = '../admin/edit_factura_venta.php'.'?cod_info_factura_venta='.$cod_info_factura_venta;
    } elseif (($cod_tipo_nota_observacion == 2) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE COMPRA
        $url_redirect_recurso = '../admin/ver_factura_compra.php'.'?cod_info_factura_compra='.$cod_info_factura_compra;
    } elseif (($cod_tipo_nota_observacion == 3) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE COMPRA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_compra='.$cod_info_cotizacion_factura_compra;
    } elseif (($cod_tipo_nota_observacion == 4) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE VENTA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_venta='.$cod_info_cotizacion_factura_venta;
    } elseif (($cod_tipo_nota_observacion == 5) && ($url_img_orig_producto <> '')) { //SOPORTES AUDITORIA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_auditoria='.$cod_info_factura_auditoria;
    } elseif (($cod_tipo_nota_observacion == 6) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIAS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia='.$cod_info_factura_transferencia;
    } elseif (($cod_tipo_nota_observacion == 7) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA ENTRADA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega_entrada='.$cod_info_factura_transferencia_bodega_entrada;
    } elseif (($cod_tipo_nota_observacion == 8) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA SALIDA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega='.$cod_info_factura_transferencia_bodega;
    } elseif (($cod_tipo_nota_observacion == 9) && ($url_img_orig_producto <> '')) { //SOPORTES MOVIMIENTOS CONTABLES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_movimiento_contable='.$cod_movimiento_contable;
    } elseif (($cod_tipo_nota_observacion == 10) && ($url_img_orig_producto <> '')) { //SOPORTES EGRESOS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_egreso='.$cod_egreso;
    } else {
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?aaaaaa='.$aaaaaa;
    }
    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

    $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];
?>
                                <tr>
                                    <td style="text-align:center;" class="name-pr"><?php echo ($cod_nota_observacion) ?></td>
                                    <td style="text-align:left;" class="name-pr"><?php echo $nombre_nota_observacion ?></td>
                                    <td style="text-align:left;" class="name-pr"><?php echo $nombre_tipo_nota_observacion ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $fecha_ymd ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $fecha_hora ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cuenta ?></td>
                                    <td style="text-align:center;" style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>
                                </tr>
<?php } ?>
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