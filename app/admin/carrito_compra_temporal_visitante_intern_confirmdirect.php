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
$tab_elim                          = "tbl15_carrito_compra_temporal";
$tab_elim_codif                    = DAXCODIFCRYPTOR::encodiftextodax($tab_elim);
$tab_elim_codifcryp                = DAXCODIFCRYPTOR::encriptardax($tab_elim_codif);

$campo_elim                        = "cod_carrito_compra_temporal";
$campo_elim_codif                  = DAXCODIFCRYPTOR::encodiftextodax($campo_elim);
$campo_elim_codifcryp              = DAXCODIFCRYPTOR::encriptardax($campo_elim_codif);

$tipo_elim                         = "eliminar";
$tipo_elim_codif                   = DAXCODIFCRYPTOR::encodiftextodax($tipo_elim);
$tipo_elim_codifcryp               = DAXCODIFCRYPTOR::encriptardax($tipo_elim_codif);
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
                                    <!--<th>#</th>-->
                                    <th>Eli</th>
                                    <th>Imagen</th>
                                    <th>Nombre producto</th>
                                    <th>Precio</th>
                                    <th>Cant</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                          <tbody>
<?php
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

$cod_cliente                              = 0;
$conteo                                   = 0;
$total_venta                              = 0;
$incre                                    = 0;
$smtr_iva_valor                           = 0;

$datos_info = "SELECT cod_info_factura_venta, cod_factura, cod_cupon, costo_cupon, descuento_ptj, costo_tipo_envio, cod_tipo_envio
FROM tbl15_info_factura_venta WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$cantidad_resultado = mysqli_num_rows($consulta_info);
$datos_info = mysqli_fetch_assoc($consulta_info);

$cod_info_factura_venta                   = $datos_info['cod_info_factura_venta'];
$cod_factura                              = $datos_info['cod_factura'];
$cod_cupon                                = $datos_info['cod_cupon'];
$costo_cupon                              = $datos_info['costo_cupon'];
$descuento_ptj                            = $datos_info['descuento_ptj'];
$costo_tipo_envio                         = $datos_info['costo_tipo_envio'];
$cod_tipo_envio                           = $datos_info['cod_tipo_envio'];

$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_venta, precio_venta_producto, 
total_venta_producto, url_img_min_producto, url_img_orig_producto, iva_ptj 
FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') ORDER BY cod_carrito_compra_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_producto);
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_carrito_compra_temporal              = $datos_producto['cod_carrito_compra_temporal'];
$cod_carrito_compra_temporal_codif        = DAXCODIFCRYPTOR::encodifdax($cod_carrito_compra_temporal);
$cod_carrito_compra_temporal_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_carrito_compra_temporal_codif);
$nombre_producto                          = $datos_producto['nombre_producto'];
$und_venta                                = intval($datos_producto['und_venta']);
$precio_venta_producto                    = intval($datos_producto['precio_venta_producto']);
$total_venta_producto                     = intval($datos_producto['total_venta_producto']);
$iva_ptj                                  = $datos_producto['iva_ptj'];
$url_img_min_producto                     = $datos_producto['url_img_min_producto'];
$url_img_orig_producto                    = $datos_producto['url_img_orig_producto'];
$total_venta_producto                     = $und_venta * $precio_venta_producto;
$total_venta                             += $und_venta * $precio_venta_producto;
$incre++;
?>
                                <tr id="tr-<?php echo $cod_carrito_compra_temporal;?>">
                                    <!--<td id="num-<?php //echo $cod_carrito_compra_temporal;?>"><?php //echo $incre;?></td>-->
                                    <td id="cod_carrito_compra_temporal-<?php echo $cod_carrito_compra_temporal;?>" data="<?php echo $cod_carrito_compra_temporal ?>" class="remove-pr"><a class="eliminar" id="cod_carrito_compra_temporal<?php echo $cod_carrito_compra_temporal ?>"><i id="eliminar_load<?php echo $cod_carrito_compra_temporal ?>" class="fas fa-times"></i></a></td>
                                    <td id="url_img_min_producto-<?php echo $cod_carrito_compra_temporal;?>" class="thumbnail-img"><a href="#"><img class="img-fluid" src="<?php echo $url_img_min_producto ?>" alt="" /></a></td>
                                    <td id="nombre_producto-<?php echo $cod_carrito_compra_temporal;?>" class="name-pr"><a href="#"><?php echo $nombre_producto ?></a></td>
                                    <td id="precio_venta_producto-<?php echo $cod_carrito_compra_temporal;?>" class="price-pr"><p>$ <?php echo number_format($precio_venta_producto, 0, ",", ".") ?></p></td>
                                    <td id="und_venta-<?php echo $cod_carrito_compra_temporal;?>" class="quantity-box"><input type="number" name="<?php echo $campo_codifcryp;?>" id="und_venta<?php echo $incre;?>" min="1" max="5" data_codifcryp="<?php echo $cod_carrito_compra_temporal;?>" size="4" min="0" step="1" class="c-input-text qty text" value="<?php echo $und_venta;?>" readonly>
                                    <td id="total_venta-<?php echo $cod_carrito_compra_temporal;?>" class="total-pr"><p id="total_venta_producto<?php echo $incre;?>">$ <?php echo number_format($total_venta_producto, 0, ",", ".") ?></p></td>
                                    <input type="hidden" id="precio_venta_producto<?php echo $incre;?>" class="precio_venta_producto-<?php echo $cod_carrito_compra_temporal;?>" value="<?php echo $precio_venta_producto;?>">
                                    <input type="hidden" id="iva_ptj<?php echo $incre;?>" class="iva_ptj-<?php echo $cod_carrito_compra_temporal;?>" value="<?php echo $iva_ptj;?>">
                                </tr id="tr-<?php echo $cod_carrito_compra_temporal;?>">
<?php
} 
$total_carrito = (($total_venta) - ($costo_cupon));
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<!--
            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="cod_cupon" id="cod_cupon" value="<?php echo $cod_cupon ?>"placeholder="Ingrese su código de cupón" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button id="btn_aplicar_cupon" class="btn btn-theme" type="button" onPress="calc_cupon();">Aplicar Cupón</button>
                                <div id="cupon-ok"></div>
                            </div>
                        </div>

                <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <input value="Actualizar la compra" type="submit">
                    </div>
                </div>
            </div>
-->

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Resumen del pedido</h3>
                        <div class="d-flex">
                            <h4>SubTotal</h4>
                            <div id="subtotal_carrito" class="ml-auto font-weight-bold"> $ <?php echo number_format($total_venta, 0, ",", ".") ?> </div>
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
                            <div id="total_carrito" class="ml-auto h5"> $ <?php echo number_format($total_carrito, 0, ",", ".") ?> </div>
                            <input type="hidden" id="total_carrito_hidden" value="<?php echo $total_carrito; ?>">
                        </div>
                        <hr>
                    </div>
                </div>
                <?php if ($total_reg <> '0') { ?>
                <div class="col-12 d-flex shopping-box"><a href="../admin/checkout_visitante_intern_confirmdirect.php" class="ml-auto btn hvr-hover">Revisar Compra</a> </div>
                <?php } ?>
            </div>

        </div>

        </form>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern_confirmdirect.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_confirmdirect.php"); ?>

<script type="text/javascript">
function calc_total_venta(){

var i = 0;
var incre = <?php echo $total_reg;?>;
var und_venta_text = "";
var precio_venta_producto_text = "";
var total_venta_producto_text = "";
var iva_ptj_text = "";
var smtr_total_venta = 0;
var und_venta = 0;
var precio_venta_producto = 0;
var total_venta_producto = 0;
var smtr_iva_valor = 0;
var subtotal_carrito = 0;
var total_carrito = 0;
var descuento_cupon_carrito_hidden = document.getElementById("descuento_cupon_carrito_hidden").value;

for (i=1; i<=incre; i++){

und_venta_text = "und_venta"+i;
precio_venta_producto_text = "precio_venta_producto"+i;
total_venta_producto_text = "total_venta_producto"+i;
iva_ptj_text = "iva_ptj"+i;

und_venta = document.getElementById(und_venta_text).value;
precio_venta_producto = document.getElementById(precio_venta_producto_text).value;
total_venta_producto = (und_venta * precio_venta_producto);
smtr_total_venta = smtr_total_venta + total_venta_producto;
iva_valor = und_venta * (precio_venta_producto - (precio_venta_producto/((iva_ptj_text/100)+1)));

document.getElementById(total_venta_producto_text).innerHTML=total_venta_producto.toLocaleString("es-ES");
//document.getElementById(iva_valor_text).innerHTML=iva_valor.toLocaleString("es-ES");
}

subtotal_carrito = smtr_total_venta;
total_carrito = (smtr_total_venta-descuento_cupon_carrito_hidden);

document.getElementById("subtotal_carrito").innerHTML=subtotal_carrito.toLocaleString("es-ES");
document.getElementById("subtotal_carrito_hidden").value = subtotal_carrito;

//document.getElementById("iva_carrito").innerHTML=smtr_iva_valor.toLocaleString("es-ES");
//document.getElementById("iva_carrito_hidden").value = smtr_iva_valor;

document.getElementById("total_carrito").innerHTML=total_carrito.toLocaleString("es-ES");
document.getElementById("total_carrito_hidden").value = total_carrito;

}
</script>

<script type="text/javascript">
function calc_cupon(){

var descuento_carrito_hidden = document.getElementById("descuento_carrito_hidden").value;
var descuento_cupon_carrito_hidden = document.getElementById("descuento_cupon_carrito_hidden").value;
var iva_carrito_hidden = document.getElementById("iva_carrito_hidden").value;
var costo_envio_carrito_hidden = document.getElementById("costo_envio_carrito_hidden").value;
var total_carrito_hidden = document.getElementById("total_carrito_hidden").value;
var cod_cupon = document.getElementById("cod_cupon").value;
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#btn_aplicar_cupon').click(function(){
        //var cod_producto2 = $(this).parent().attr('id');
        var cod_cupon = $("#cod_cupon").val();
        var datos_url_ajax = 'cod_cupon='+cod_cupon+'&'+'cod_cliente='+'<?php echo $cod_cliente ?>'+'&'+'origen='+'<?php echo $origen ?>'+'&'+'accion='+'<?php echo $accion ?>'+'&'+'tipo='+'<?php echo $tipo ?>'+'&'+'vendedor='+'<?php echo $vendedor ?>'+'&'+'cod_info_factura_venta='+'<?php echo $cod_info_factura_venta ?>'+'&'+'cod_factura='+'<?php echo $cod_factura ?>';

        $.ajax({
            type: "POST",
            url: "../admin/codigo_cupon_ajax.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/loader.gif">');
            },
            success:function(respuesta){
                $('#cupon-ok').empty();
                $('#cupon-ok').append(respuesta).fadeIn("slow");
                $("#salida_info_actualizada_carrito_compra_ajax").html(respuesta).fadeIn('slow');
                //$('#loader').html('');
            //if (respuesta =! '') { location.reload(); }
            }
        });
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_carrito_compra_temporal = $(this).parent().attr('data');
        var dataString = 'cod_carrito_compra_temporal='+cod_carrito_compra_temporal+'&'+'tab_codifcryp='+'<?php echo $tab_elim_codifcryp ?>'+'&'+'campo_codifcryp='+'<?php echo $campo_elim_codifcryp ?>'+'&'+'tipo_codifcryp='+'<?php echo $tipo_elim_codifcryp ?>';
        
        $.ajax({
            type: "POST",
            url: "../admin/eliminar_visitante_ajax.php",
            data: dataString,
            beforeSend: function(objeto){
                $('#eliminar_load'+cod_carrito_compra_temporal).empty();
                $('#eliminar_load'+cod_carrito_compra_temporal).html('<img src="../imagenes/loader.gif">');
            },
            success:function(respuesta){
                $('#eliminar_ok').empty();
                //$('#eliminar_ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_carrito_compra_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");

                var carrito_compra_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
                var carrito_compra_temporal = respuesta.salida_info_actualizada_carrito_compra_menu_ajax;

                var subtotal_carrito = respuesta.subtotal_carrito;
                var subtotal_carrito_hidden = respuesta.subtotal_carrito_hidden;
                var total_carrito = respuesta.total_carrito;
                var total_carrito_hidden = respuesta.total_carrito_hidden;

                $("#salida_info_actualizada_carrito_compra_menu_total_reg_ajax").html(carrito_compra_temporal_total_reg).fadeIn('slow');
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(carrito_compra_temporal).fadeIn('slow');

                $("#subtotal_carrito").html(subtotal_carrito);
                $("#subtotal_carrito_hidden").val(subtotal_carrito_hidden);
                $("#total_carrito").html(total_carrito);
                $("#total_carrito_hidden").val(total_carrito_hidden);

                $('#num-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#url_img_min_producto-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#nombre_producto-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#precio_venta_producto-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#und_venta-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#total_venta-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('.precio_venta_producto-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('.iva_ptj-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#cod_carrito_compra_temporal-'+cod_carrito_compra_temporal).fadeOut("slow");
                $('#tr-'+cod_carrito_compra_temporal).fadeOut("slow");
                //$("#salida_info_actualizada_carrito_compra_menu_ajax").html(respuesta).fadeIn('slow');
                //$('#'+parent).remove();
            //if (respuesta =! '') { location.reload(); }

            }

        });
    });

});
</script>

<script type="text/javascript">
    $("input").change(function(){  
        var cod_carrito_compra_temporal = $(this).attr('data_codifcryp');
        var valor = $(this).val();
        var campo_codifcryp = $(this).attr("name");
        var tab_codifcryp = '<?php echo $tab_codifcryp1 ?>';
        var tipo_codifcryp = '<?php echo $tipo_codifcryp1 ?>';
        var accion_codifcryp = '<?php echo $accion_codifcryp1 ?>';
        var origen_codifcryp = '<?php echo $origen_codifcryp1 ?>';
        var vendedor_codifcryp = '<?php echo $vendedor_codifcryp ?>';
        //let id = this.id;
        console.log("input");

        var tipo_ajax = "tbl15_venta_producto_temporal";
        var foco = '';
        var pagina = '';
        var datos_url_ajax = 'id='+cod_carrito_compra_temporal+'&'+'valor='+valor+'&'+'campo_codifcryp='+campo_codifcryp+'&'+'accion_codifcryp='+accion_codifcryp+'origen_codifcryp='+origen_codifcryp+'&'+'vendedor_codifcryp='+vendedor_codifcryp;

        $.ajax({
            type: "POST",
            url: "../admin/actualizar_und_precio_vend_carrito_compra_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
                //window.location.href = window.location.href;
                window.location.reload();
            }
        });
 
    });
</script>

</body>

</html>