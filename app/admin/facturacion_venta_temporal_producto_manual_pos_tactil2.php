<?php
$nombre_pagina          = "Checkout";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_ext.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_ext.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante_ext.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">
<link href="../estilo_css/chosen.css" rel="stylesheet">
<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_ext.php"); ?>
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
$sql_datos_info = "SELECT * FROM tbl15_info_factura_venta_carrito_compra WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') AND (nombre_estado_factura = 'ABIERTA')";
$consulta_info = mysqli_query($conectar, $sql_datos_info) or die(mysqli_error($conectar));
$cantidad_resultado = mysqli_num_rows($consulta_info);
$datos_info = mysqli_fetch_assoc($consulta_info);

$cod_info_factura_venta_carrito_compra              = $datos_info['cod_info_factura_venta_carrito_compra'];
$cod_info_factura_venta_carrito_compra_codif        = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta_carrito_compra);
$cod_info_factura_venta_carrito_compra_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_carrito_compra_codif);

$cod_factura                         = $datos_info['cod_factura'];
$nombre1_tercero                     = $datos_info['nombre1_tercero'];
$nombre2_tercero                     = $datos_info['nombre2_tercero'];
$apellido1_tercero                   = $datos_info['apellido1_tercero'];
$apellido2_tercero                   = $datos_info['apellido2_tercero'];
$identificacion_tercero              = $datos_info['identificacion_tercero'];
$fecha_nac_tercero                   = $datos_info['fecha_nac_tercero'];
$direccion_tercero                   = $datos_info['direccion_tercero'];
$telefono1_tercero                   = $datos_info['telefono1_tercero'];
$correo_tercero                      = $datos_info['correo_tercero'];
$cod_tipo_forma_pago                 = $datos_info['cod_tipo_forma_pago'];
$cod_zona_envio                      = $datos_info['cod_zona_envio'];
$cod_tipo_aplicacion                 = '2';

$cod_factura_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_factura);
$cod_factura_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_factura_codif);

$fecha_dia                           = $datos_info['fecha_dia'];
$cod_cupon                           = $datos_info['cod_cupon'];
$costo_cupon                         = $datos_info['costo_cupon'];
$descuento_ptj                       = $datos_info['descuento_ptj'];
$observacion                         = $datos_info['observacion'];

$cod_tercero                         = $datos_info['cod_tercero'];
$cod_tercero_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
$cod_tercero_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
$sql_zona1 = "SELECT cod_zona_envio, nombre_zona_envio, costo_zona_envio FROM tbl15_zona_envio WHERE (cod_zona_envio = '1')";
$consulta_zona1 = mysqli_query($conectar, $sql_zona1);
$datos_zona1 = mysqli_fetch_assoc($consulta_zona1);

$codigo1                             = $datos_zona1['cod_zona_envio'];
$nombre1                             = $datos_zona1['nombre_zona_envio'];
$costo1                              = $datos_zona1['costo_zona_envio'];

$sql_zona2 = "SELECT cod_zona_envio, nombre_zona_envio, costo_zona_envio FROM tbl15_zona_envio WHERE (cod_zona_envio = '2')";
$consulta_zona2 = mysqli_query($conectar, $sql_zona2);
$datos_zona2 = mysqli_fetch_assoc($consulta_zona2);

$codigo2                             = $datos_zona2['cod_zona_envio'];
$nombre2                             = $datos_zona2['nombre_zona_envio'];
$costo2                              = $datos_zona2['costo_zona_envio'];
?>
<form action="../admin/venta_producto_carrito_compra_reg.php" method="post">
    <div class="cart-box-main">
        <div class="container">

            <div class="row new-account-login"></div>

            <div class="row">
                <div class="col-sm-8 col-lg-8 mb-3">


                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
<?php
$tab                               = "producto";
$tab_codif                         = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                             = "cod_producto";
$campo_codif                       = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                   = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                              = "carrito";
$tipo_codif                        = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                            = "registrar";
$accion_codif                      = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                            = "carrito";
$origen_codif                      = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$accion_whatapp                    = "redirecionar_whatapp";
$accion_whatapp_codif              = DAXCODIFCRYPTOR::encodiftextodax($accion_whatapp);
$accion_whatapp_codifcryp          = DAXCODIFCRYPTOR::encriptardax($accion_whatapp_codif);

$accion_telefono                   = "redirecionar_telefono";
$accion_telefono_codif             = DAXCODIFCRYPTOR::encodiftextodax($accion_telefono);
$accion_telefono_codifcryp         = DAXCODIFCRYPTOR::encriptardax($accion_telefono_codif);

$und_vendida                       = 1;
$und_vendida_codif                 = DAXCODIFCRYPTOR::encodifdax($und_vendida);
$und_vendida_codifcryp             = DAXCODIFCRYPTOR::encriptardax($und_vendida_codif);

$contador                       = 0;

if (isset($_GET['cod_categoria'])) {
$cod_categoria      = intval($_GET['cod_categoria']);
//$cod_categoria_codif          = DAXCODIFCRYPTOR::descriptardax($cod_categoria);
//$cod_categoria                = DAXCODIFCRYPTOR::descodiftextodax($cod_categoria_codif);

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (cod_categoria = '$cod_categoria') ORDER BY nombre_producto DESC";
}
elseif (isset($_GET['buscador'])) { 
$buscador_get = addslashes($_GET['buscador']); 

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_producto LIKE '%$buscador_get%') ORDER BY nombre_producto DESC";
}
elseif (isset($_GET['nombre_marca_codifcryp'])) { 
$nombre_marca_codifcryp              = ($_GET['nombre_marca_codifcryp']);
$nombre_marca_codif                  = DAXCODIFCRYPTOR::descriptardax($nombre_marca_codifcryp);
$nombre_marca                        = DAXCODIFCRYPTOR::descodiftextodax($nombre_marca_codif);

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_marca LIKE '$nombre_marca') ORDER BY nombre_producto DESC";
}
else { 
$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') ORDER BY nombre_producto DESC";
}
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$contador++;
$cod_producto                      = $datos_producto['cod_producto'];
$cod_producto_codif                = DAXCODIFCRYPTOR::encodifdax($cod_producto);
$cod_producto_codifcryp            = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);

$cod_producto_barra                = $datos_producto['cod_producto_barra'];
$nombre_producto                   = $datos_producto['nombre_producto'];
$und_producto                      = $datos_producto['und_producto'];
$precio_venta_producto             = $datos_producto['precio_venta_producto'];
$precio_venta_producto2            = $datos_producto['precio_venta_producto2'];
$descripcion_producto              = $datos_producto['descripcion_producto'];
$url_img_min_producto              = $datos_producto['url_img_min_producto'];
$url_img_orig_producto             = $datos_producto['url_img_orig_producto'];
$nombre_promocion                  = $datos_producto['nombre_promocion'];
$nombre_promocion_ing              = $datos_producto['nombre_promocion_ing'];
$cod_estado                        = $datos_producto['cod_estado'];
if ($url_img_orig_producto=='') { $url_img_orig_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }
//$ptj_descuento                     = round((($precio_venta_producto2 - $precio_venta_producto) / $precio_venta_producto), 2) * 100;
?>
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <a class="cart" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">
                                                <div class="box-img-hover">
                                                    <img src="<?php echo $url_img_orig_producto ?>" class="img-fluid" alt="Image">
                                                    <!--
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li id="cart-ok<?php echo $cod_producto_barra ?>"></li>
                                                        </ul>
                                                            <a class="cart" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">Agregar al Carrito</a>
                                                    </div>
                                                    -->
                                                </div>
                                                </a>

                                                <div class="why-text">
                                                    <h4><?php echo $nombre_producto ?></h4>
                                                    <h5> $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></h5>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <div class="col-sm-4 col-lg-4 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">


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
///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
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

<input type="hidden" name="cod_tipo_aplicacion" value="<?php echo $cod_tipo_aplicacion;?>">
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

<?php include_once("../admin/09_modulo_footer_visitante_ext.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_ext.php"); ?>

<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/json2.min.js"></script>

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_factura_venta_carrito_compra";
            $.post("guardar_info_factura_y_carrito_compra_temporal_visitante_ext_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta_carrito_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("textarea").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_factura_venta_carrito_compra";
            $.post("guardar_info_factura_y_carrito_compra_temporal_visitante_ext_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta_carrito_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_factura_venta_carrito_compra";
            $.post("guardar_info_factura_y_carrito_compra_temporal_visitante_ext_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta_carrito_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

</body>

</html>