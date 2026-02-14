<?php
$nombre_pagina          = "Checkout";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">
<link href="../estilo_css/chosen.css" rel="stylesheet">
<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<!-- Start Cart  -->
<?php
$tab                               = "tbl15_info_factura_venta_carrito_compra";
$tab_codif                         = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                             = "latitud_longitud";
$campo_codif                       = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                   = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                              = "checkout";
$tipo_codif                        = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                            = "actualizar";
$accion_codif                      = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                            = "checkout";
$origen_codif                      = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$contador                          = 0;
$total_venta                       = 0;


$accion1                           = "registrar";
$accion_codif1                     = DAXCODIFCRYPTOR::encodiftextodax($accion1);
$accion_codifcryp1                 = DAXCODIFCRYPTOR::encriptardax($accion_codif1);

$tipo1                             = "checkout";
$tipo_codif1                       = DAXCODIFCRYPTOR::encodiftextodax($tipo1);
$tipo_codifcryp1                   = DAXCODIFCRYPTOR::encriptardax($tipo_codif1);

$origen1                           = "carrito";
$origen_codif1                     = DAXCODIFCRYPTOR::encodiftextodax($origen1);
$origen_codifcryp1                 = DAXCODIFCRYPTOR::encriptardax($origen_codif1);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
$sql_datos_info = "SELECT cod_info_factura_venta_carrito_compra, cod_factura, fecha_dia, cod_cupon, costo_cupon, descuento_ptj, cod_tercero 
FROM tbl15_info_factura_venta_carrito_compra WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info = mysqli_query($conectar, $sql_datos_info) or die(mysqli_error($conectar));
$cantidad_resultado = mysqli_num_rows($consulta_info);
$datos_info = mysqli_fetch_assoc($consulta_info);

$cod_info_factura_venta_carrito_compra              = $datos_info['cod_info_factura_venta_carrito_compra'];
$cod_info_factura_venta_carrito_compra_codif        = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta_carrito_compra);
$cod_info_factura_venta_carrito_compra_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_carrito_compra_codif);

$cod_factura                         = $datos_info['cod_factura'];
$cod_factura_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_factura);
$cod_factura_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_factura_codif);

$fecha_dia                           = $datos_info['fecha_dia'];
$cod_cupon                           = $datos_info['cod_cupon'];
$costo_cupon                         = $datos_info['costo_cupon'];
$descuento_ptj                       = $datos_info['descuento_ptj'];

$cod_tercero                         = $datos_info['cod_tercero'];
$cod_tercero_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
$cod_tercero_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);
?>
<form action="../admin/venta_producto_reg.php" method="post">
    <div class="cart-box-main">
        <div class="container">

            <div class="row new-account-login"></div>

            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Dirección de Envio</h3>
                        </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">

                            <div class="mb-3">
                                <label for="address">ID de Venta *</label>
                                <?php echo str_pad($cod_info_factura_venta_carrito_compra, 6, "0", STR_PAD_LEFT) ?>
                            </div>

                                    <label for="firstName">Nombres *</label>
                                        <?php if ($cod_seguridad == 1) { ?>
                                        <select name="cod_administrador_codifcryp" id="cod_administrador_codifcryp" class="chosen-select" data-show-subtext="true" data-live-search="true">
                                        <?php                                   
                                        $consulta2_sql = ("SELECT cod_administrador, cedula, nombres, apellidos, cuenta FROM tbl15_administrador ORDER BY nombres ASC");
                                        } elseif ($cod_seguridad == 2) { ?>
                                        <select name="cod_administrador_codifcryp" id="cod_administrador_codifcryp" class="chosen-select" data-show-subtext="true" data-live-search="true">
                                        <?php                                   
                                        $consulta2_sql = ("SELECT cod_administrador, cedula, nombres, apellidos, cuenta FROM tbl15_administrador ORDER BY nombres ASC");
                                        } elseif ($cod_seguridad == 3) { ?>
                                        <select name="cod_administrador_codifcryp" id="cod_administrador_codifcryp" class="form-control">
                                        <?php                                   
                                        $consulta2_sql = ("SELECT cod_administrador, cedula, nombres, apellidos, cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'");
                                        }
                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                        if(isset($cod_administrador) and $cod_administrador == $datos2['cod_administrador']) {
                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                        $cod_administrador              = $datos2['cod_administrador'];
                                        $cod_administrador_codif        = DAXCODIFCRYPTOR::encodifdax($cod_administrador);
                                        $cod_administrador_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_administrador_codif);
                                        $cuenta = $datos2['cuenta'];
                                        $cedula = $datos2['cedula'];
                                        $nombres = $datos2['nombres'];
                                        $apellidos = $datos2['apellidos'];
                                        $nombre = $cuenta.' | '.$nombres.' '.$apellidos.' | '.$cedula;
                                        echo "<option value='".$cod_administrador_codifcryp."' $seleccionado >".$nombre."</option>"; } ?>
                                     </select>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="telefono">Telefono *</label>
                                <input type="number" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono ?>" placeholder="">
                                <div class="invalid-feedback"> Ingrese su telefono. </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Dirección de correo electrónico *</label>
                                <input type="email" class="form-control" name="correo" id="email" value="<?php echo $correo ?>" placeholder="">
                                <div class="invalid-feedback"> Ingrese una dirección de correo electrónico válida para las actualizaciones de envío. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Dirección *</label>
                                <input type="text" class="form-control" name="direccion" id="address" value="<?php echo $direccion ?>" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
<!--
                            <div class="mb-3">
                                <label for="address2">Dirección 2 *</label>
                                <input type="text" class="form-control" id="address2" placeholder=""> 
                            </div>
-->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-control" id="direccion_gpss">Ubicación Gps*<div id="respuesta_latit_longit"></div></label>
                                    <a id="obtener_ubicacion" class="ml-auto btn hvr-hover">Clic aqui para obtener ubicación</a>
                                    <input type="hidden" name="latitud_longitud" id="direccion_gps" class="orm-control" required>
                                    <input type="hidden" name="latitud" id="latitud" class="form-control" required>
                                    <input type="hidden" name="longitud" id="longitud" class="form-control" required>
                                    <div class="invalid-feedback"> Direccion Gps requerida. </div>
                                    <div id="mensaje_gps"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div id="mostrar_mapa_div" style="width: 400px; height: 311px;"> </div>
                            </div>

                            <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="direcion_misma_factura" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">La dirección de envío es la misma que mi dirección de facturación</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="guarda_info_prox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Guarda esta información para la próxima vez</label>
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Pago</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="efectivo" name="nombre_tipo_forma_pago" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="efectivo">Efectivo</label>
                                </div>
                            </div>
<!--
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Nombre en la tarjeta</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required> <small class="text-muted">Nombre completo como se muestra en la tarjeta</small>
                                    <div class="invalid-feedback"> Se requiere el nombre en la tarjeta </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Número de tarjeta de crédito</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback"> Se requiere número de tarjeta de crédito </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Vencimiento</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback"> Fecha de vencimiento requerida </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback"> Código de seguridad requerido </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="payment-icon">
                                        <ul>
                                            <li><img class="img-fluid" src="../imagenes/payment-icon/1.png" alt=""></li>
                                            <li><img class="img-fluid" src="../imagenes/payment-icon/2.png" alt=""></li>
                                            <li><img class="img-fluid" src="../imagenes/payment-icon/3.png" alt=""></li>
                                            <li><img class="img-fluid" src="../imagenes/payment-icon/5.png" alt=""></li>
                                            <li><img class="img-fluid" src="../imagenes/payment-icon/7.png" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
-->
                            <hr class="mb-1">


                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Método de envío</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="nombre_tipo_entrega" class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Entrega estándar</label> <span class="float-right font-weight-bold">GRATIS</span> </div>
<!--
                                    <div class="ml-4 mb-2 small">(3-7 días hábiles)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Entrega Express</label> <span class="float-right font-weight-bold">$10.00</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 días hábiles)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Siguiente día de negocios</label> <span class="float-right font-weight-bold">$20.00</span> </div>
-->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Carrito de compras</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
<?php
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
$conteo = 0;

$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_venta, precio_venta_producto, 
total_venta_producto, url_img_min_producto, url_img_orig_producto FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_carrito_compra_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_producto);
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_carrito_compra_temporal              = $datos_producto['cod_carrito_compra_temporal'];
$cod_carrito_compra_temporal_codif        = DAXCODIFCRYPTOR::encodifdax($cod_carrito_compra_temporal);
$cod_carrito_compra_temporal_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_carrito_compra_temporal_codif);
$nombre_producto                          = $datos_producto['nombre_producto'];
$und_venta                                = $datos_producto['und_venta'];
$precio_venta_producto                    = $datos_producto['precio_venta_producto'];
$total_venta_producto                     = $datos_producto['total_venta_producto'];
$url_img_min_producto                     = $datos_producto['url_img_min_producto'];
$url_img_orig_producto                    = $datos_producto['url_img_orig_producto'];
$total_venta_ind                          = $und_venta * $precio_venta_producto;
$total_venta                             += $und_venta * $precio_venta_producto;
?>
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html"> <?php echo $nombre_producto ?></a>
                                            <div class="small text-muted">Precio: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?> <span class="mx-2">|</span> Cant: <?php echo $und_venta ?> <span class="mx-2">|</span> Subtotal: $<?php echo number_format($total_venta_ind, 0, ",", ".") ?></div>
                                        </div>
                                    </div>
<input type="hidden" name="cod_carrito_compra_temporal[]" value="<?php echo $cod_carrito_compra_temporal;?>">
<?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Su orden</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Producto</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>SubTotal</h4>
                                    <div class="ml-auto font-weight-bold"> $ <?php echo number_format($total_venta, 0, ",", ".") ?> </div>
                                </div>
<!--
                                <div class="d-flex">
                                    <h4>Descuento</h4>
                                    <div class="ml-auto font-weight-bold"> $ <?php echo number_format($descuento_ptj, 0, ",", ".") ?> </div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Cupon de Descuento</h4>
                                    <div class="ml-auto font-weight-bold"> $ <?php echo number_format($costo_cupon, 0, ",", ".") ?> </div>
                                </div>

                                <div class="d-flex">
                                    <h4>Impuesto</h4>
                                    <div class="ml-auto font-weight-bold"> $ <?php echo number_format($iva_ptj, 0, ",", ".") ?> </div>
                                </div>
-->
                                <div class="d-flex">
                                    <h4>Costo de envío</h4>
                                    <div class="ml-auto font-weight-bold"> Gratis </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total</h5>
                                    <div class="ml-auto h5"> $ <?php echo number_format($total_venta - $costo_cupon, 0, ",", ".") ?> </div>
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Realizar pedido</button>
                            <!--<a href="../admin/realizar_pedido.php?cod_info_factura_venta_carrito_compra_codifcryp=<?php echo $cod_info_factura_venta_carrito_compra_codifcryp ?>&cod_factura=<?php echo $cod_factura ?>" class="ml-auto btn hvr-hover">Realizar pedido</a>-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<input type="hidden" name="cod_info_factura_venta_carrito_compra_codifcryp" id="cod_info_factura_venta_carrito_compra_codifcryp" value="<?php echo $cod_info_factura_venta_carrito_compra_codifcryp;?>">
<input type="hidden" name="cod_info_factura_venta_carrito_compra" id="cod_info_factura_venta_carrito_compra" value="<?php echo $cod_info_factura_venta_carrito_compra;?>">

<input type="hidden" name="cod_factura_codifcryp" value="<?php echo $cod_factura_codifcryp;?>">
<input type="hidden" name="accion_codifcryp" value="<?php echo $accion_codifcryp1;?>">
<input type="hidden" name="tipo_codifcryp" value="<?php echo $tipo_codifcryp1;?>">
<input type="hidden" name="origen_codifcryp" value="<?php echo $origen_codifcryp1;?>">
</form>
    <!-- End Cart -->


<?php //include_once("modulo_productos_relacionados_visitante.php"); ?>

        </div>
    </div>
    <!-- End Cart -->
    <!-- End Shop Page -->

<?php //include_once("08_modulo_instagram_visitante.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante.php"); ?>

<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/json2.min.js"></script>

<script src="https://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
var obtener_ubicacion = document.getElementById("obtener_ubicacion");
var mensaje_gps = document.getElementById("mensaje_gps");

obtener_ubicacion.onclick = function(e) { 
(function(){

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(objPosition) {

            //var cod_info_factura_venta_carrito_compra_codifcryp = document.getElementById("cod_info_factura_venta_carrito_compra_codifcryp").value;
            var cod_info_factura_venta_carrito_compra = document.getElementById("cod_info_factura_venta_carrito_compra").value;

            var latitud = objPosition.coords.latitude;
            var longitud = objPosition.coords.longitude;
            var latitud_longitud = latitud+','+longitud;

            //mensaje_gps.innerHTML = "<p><strong>Latitud:</strong> " + latitud + "</p><p><strong>Longitud:</strong> " + longitud + "</p>";
            document.getElementById("direccion_gps").value = latitud_longitud;
            document.getElementById("latitud").value = latitud;
            document.getElementById("longitud").value = longitud;
            mensaje_gps.innerHTML = "Hemos obtenido tu direccion: "+latitud+', '+longitud+". Mira el mapa para verificar tu direccion.";

            var datos_url_ajax = 'cod_info_factura_venta_carrito_compra='+cod_info_factura_venta_carrito_compra+'&'+'latitud='+latitud+'&'+'longitud='+longitud+'&'+'latitud_longitud='+latitud_longitud+'&'+'cod_tercero_codifcryp='+'<?php echo $cod_tercero_codifcryp ?>'+'&'+'tab_codifcryp='+'<?php echo $tab_codifcryp ?>'+'&'+'origen_codifcryp='+'<?php echo $origen_codifcryp ?>'+'&'+'accion_codifcryp='+'<?php echo $accion_codifcryp ?>'+'&'+'tipo_codifcryp='+'<?php echo $tipo_codifcryp ?>'+'&'+'vendedor_codifcryp='+'<?php echo $vendedor_codifcryp ?>'+'&'+'cod_factura_codifcryp='+'<?php echo $cod_factura_codifcryp ?>';

        $.ajax({
            type: "POST",
            url: "../admin/actualizar_longitud_latitud_info_factura_venta_carrito_compra_visitante_ajax.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $('#respuesta_latit_longit').empty();
                //$('#cupon-ok').append(respuesta).fadeIn("slow");
                $("#respuesta_latit_longit").html('<img src="../imagenes/correcto.jpg">');
                //$('#loader').html('');
            }
        });

function showGoogleMaps() {
    //Creamos el punto a partir de la latitud y longitud de una dirección:
    var point = new google.maps.LatLng(latitud, longitud);
     //Configuramos las opciones indicando zoom, punto y tipo de mapa
    var myOptions = {
        zoom: 15, 
        center: point, 
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
     //Creamos el mapa y lo asociamos a nuestro contenedor
    var map = new google.maps.Map(document.getElementById("mostrar_mapa_div"),  myOptions);
     //Mostramos el marcador en el punto que hemos creado
    var marker = new google.maps.Marker({
        position:point,
        map: map,
        title: "Ubicacion actual"
    });
}
showGoogleMaps();

        }, function(objPositionError) {
            switch (objPositionError.code) {
                case objPositionError.PERMISSION_DENIED:
                    mensaje_gps.innerHTML = "No se ha permitido el acceso a la posición del usuario.";
                break;
                case objPositionError.POSITION_UNAVAILABLE:
                    mensaje_gps.innerHTML = "No se ha podido acceder a la información de su posición.";
                break;
                case objPositionError.TIMEOUT:
                    mensaje_gps.innerHTML = "El servicio ha tardado demasiado tiempo en responder.";
                break;
                default:
                    mensaje_gps.innerHTML = "Error desconocido.";
            }
        }, {
            maximumAge: 75000,
            timeout: 15000
        });
    } else {
        mensaje_gps.innerHTML = "Su navegador no soporta la API de geolocalización.";
    }
})();
}
</script>

<script type="text/javascript"> 

</script>

</body>

</html>