<?php 
$nombre_pagina          = "Factura de Compra";
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
$cod_info_factura_venta            = intval($_GET['cod_info_factura_venta']);

$tab_elim                          = "tbl15_carrito_compra_temporal";
$tab_elim_codif                    = DAXCODIFCRYPTOR::encodiftextodax($tab_elim);
$tab_elim_codifcryp                = DAXCODIFCRYPTOR::encriptardax($tab_elim_codif);

$campo_elim                        = "cod_carrito_compra_temporal";
$campo_elim_codif                  = DAXCODIFCRYPTOR::encodiftextodax($campo_elim);
$campo_elim_codifcryp              = DAXCODIFCRYPTOR::encriptardax($campo_elim_codif);

$tipo_elim                         = "eliminar";
$tipo_elim_codif                   = DAXCODIFCRYPTOR::encodiftextodax($tipo_elim);
$tipo_elim_codifcryp               = DAXCODIFCRYPTOR::encriptardax($tipo_elim_codif);

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta                                      = $data_info_factura['cod_info_factura_venta'];
$cod_factura                                                 = $data_info_factura['cod_factura'];
$cod_tercero                                                 = $data_info_factura['cod_tercero'];
$cod_historia_clinica                                        = $data_info_factura['cod_historia_clinica'];
$fecha_ini                                                   = $data_info_factura['fecha_ini'];
$fecha_fin                                                   = $data_info_factura['fecha_fin'];
$cod_empresa                                                 = $data_info_factura['cod_empresa'];
$nombre_empresa                                              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                         = $data_info_factura['razonsocial_empresa'];
$total_motivo                                                = $data_info_factura['total_motivo'];
$total_muestra                                               = $data_info_factura['total_muestra'];
$fecha_ymdhis                                                = $data_info_factura['fecha_ymdhis'];
$cuenta                                                      = $data_info_factura['cuenta'];
$cod_estado_factura                                          = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                               = $data_info_factura['cod_base_caja'];
$descuento_ptj                                               = $data_info_factura['descuento_ptj'];
$iva_ptj                                                     = $data_info_factura['iva_ptj'];
$flete_ptj                                                   = $data_info_factura['flete_ptj'];
$cod_cliente                                                 = $data_info_factura['cod_cliente'];
$vlr_cancelado                                               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                                                   = $data_info_factura['fecha_dia'];
$fecha_mes                                                   = $data_info_factura['fecha_mes'];
$fecha_anyo                                                  = $data_info_factura['fecha_anyo'];
$anyo                                                        = $data_info_factura['anyo'];
$fecha_hora                                                  = $data_info_factura['fecha_hora'];
$fecha_remision                                              = $data_info_factura['fecha_remision'];
$nombre_ccosto                                               = $data_info_factura['nombre_ccosto'];
$garantia_meses                                              = $data_info_factura['garantia_meses'];
$observacion                                                 = $data_info_factura['observacion'];
$cod_tipo_pago                                               = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                         = $data_info_factura['total_precio_compra'];
$total_precio_venta                                          = $data_info_factura['total_precio_venta'];
$cod_dependencia                                             = $data_info_factura['cod_dependencia'];
$servicio                                                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                                      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                                 = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                              = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                          = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                                  = $data_info_factura['cod_resolucion_facturacion'];
$cod_cufe                                                    = $data_info_factura['cod_cufe'];
$observacion_tercero                                         = $data_info_factura['observacion_tercero'];
$cod_cuentas_cobrar                                          = $data_info_factura['cod_cuentas_cobrar'];
$fecha_entrega                                               = $data_info_factura['fecha_entrega'];
$url_img_orig_producto                                       = $data_info_factura['url_img_orig_producto'];
$tiempo_ejecucion                                            = $data_info_factura['tiempo_ejecucion'];
$tiempo_ejecucion_dian_dataico                               = $data_info_factura['tiempo_ejecucion_dian_dataico'];
$cod_estado_alquiler_renta                                   = $data_info_factura['cod_estado_alquiler_renta'];
$fecha_ini_renta_alquiler                                    = $data_info_factura['fecha_ini_renta_alquiler'];
$fecha_fin_renta_alquiler                                    = $data_info_factura['fecha_fin_renta_alquiler'];
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
                                    <th style="text-align:center;">Codigo</th>
                                    <th style="text-align:center;">Concepto</th>
                                    <th style="text-align:center;">Cantidad</th>
                                    <th style="text-align:center;">Precio Unitario</th>
                                    <th style="text-align:center;">Precio Total</th>
                                    <th style="text-align:center;">ID</th>
                                </tr>
                            </thead>
                          <tbody>
<?php
$sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {
                        
    $cod_venta_producto                = $datos_venta_producto['cod_venta_producto'];
    $cod_producto                      = $datos_venta_producto['cod_producto'];
    $cod_producto_barra                = $datos_venta_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_venta_producto['nombre_producto'];
    $cedula                            = $datos_venta_producto['cedula'];
    $nombre_cliente                    = $datos_venta_producto['nombre_cliente'];
    $und_venta                         = $datos_venta_producto['und_venta'];
    $precio_compra_producto            = $datos_venta_producto['precio_compra_producto'];
    $precio_costo_producto             = $datos_venta_producto['precio_costo_producto'];
    $total_costo_producto              = $datos_venta_producto['total_costo_producto'];
    $precio_venta_producto             = $datos_venta_producto['precio_venta_producto'];
    $total_venta_producto              = $datos_venta_producto['total_venta_producto'];
    $nombre_tipo_producto              = $datos_venta_producto['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_venta_producto['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_venta_producto['posologia_cantidad'];
    $posologia_peso                    = $datos_venta_producto['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_venta_producto['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_venta_producto['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_venta_producto['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_venta_producto['cod_tipo_cobrar'];
    $cod_info_factura_venta            = $datos_venta_producto['cod_info_factura_venta'];
    $nombre_tipo_precio_venta          = $datos_venta_producto['nombre_tipo_precio_venta'];
    $comentario_producto               = $datos_venta_producto['comentario_producto'];
    $peso_producto                     = $datos_venta_producto['peso_producto'];
    $unidad_medida_peso                = $datos_venta_producto['unidad_medida_peso'];
    $cod_estado_cava                   = $datos_venta_producto['cod_estado_cava'];
    $cajas_sobre                       = intval($datos_venta_producto['cajas_sobre']);
?>
                                <tr>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cod_producto_barra ?></td>
                                    <td style="text-align:left;" class="name-pr"><?php echo $nombre_producto ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $und_venta ?></td>
                                    <td style="text-align:right;" class="total-pr"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
                                    <td style="text-align:right;" class="total-pr"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cod_venta_producto ?></td>
                                </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Resumen del pedido</h3>
                        <div class="d-flex">
                            <h4>SubTotal</h4>
                            <div id="subtotal_carrito" class="ml-auto font-weight-bold"> $ <?php echo number_format($total_precio_venta, 0, ",", ".") ?> </div>
                            <input type="hidden" id="subtotal_carrito_hidden" value="<?php echo $total_venta;?>">
                        </div>
<!--
                        <div class="d-flex">
                            <h4>Descuento</h4>
                            <div id="descuento_carrito" class="ml-auto font-weight-bold"> $ <?php echo $descuento_ptj ?> </div>
                            <input type="hidden" id="descuento_carrito_hidden" value="<?php echo $descuento_ptj;?>">
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Cupon de Descuento</h4>
                            <div id="descuento_cupon_carrito" class="ml-auto font-weight-bold"> $ <?php echo number_format($costo_cupon, 0, ",", ".") ?> </div>
                            <input type="hidden" id="descuento_cupon_carrito_hidden" value="<?php echo $costo_cupon;?>">
                        </div>
                        <div class="d-flex">
                            <h4>Impuesto</h4>
                            <div id="iva_carrito" class="ml-auto font-weight-bold"> $ <?php echo $smtr_iva_valor ?> </div>
                            <input type="hidden" id="iva_carrito_hidden" value="<?php echo $smtr_iva_valor;?>">
                        </div>
                        <div class="d-flex">
                            <h4>Costo de envío</h4>
                            <div id="costo_envio_carrito" class="ml-auto font-weight-bold"> Gratis </div>
                            <input type="hidden" id="costo_envio_carrito_hidden" value="<?php echo $costo_tipo_envio;?>">
                        </div>
-->
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Total</h5>
                            <div id="total_carrito" class="ml-auto h5"> $ <?php echo number_format($total_precio_venta, 0, ",", ".") ?> </div>
                        </div>
                        <hr>
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