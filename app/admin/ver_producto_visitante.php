<?php
$nombre_pagina          = "Tienda Online";
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

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->

<?php if (isset($_GET['buscador'])) { $buscador_get = addslashes($_GET['buscador']); } else { $buscador_get = ''; } ?>

<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante.php"); ?>
    <!-- End Main Top -->
<?php //include_once("../admin/06_modulo_imagen_head_visitante.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante.php"); ?>

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
?>

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias_visitante.php"); ?>

<!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">

                        <div class="search-product">
                            <form action="" method="GET">
                                <input type="text" name="buscador" id="buscador" value="<?php echo $buscador_get ?>" class="form-control" placeholder="Buscar aqui...">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>

<?php include_once("../admin/modulo_categoria_producto_filtro_visitante.php"); ?>

<?php //include_once("../admin/modulo_precio_producto_filtro_visitante.php"); ?>

<?php //include_once("../admin/modulo_marca_verical_producto_filtro_visitante.php"); ?>

                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">

<?php //include_once("modulo_cabecera_ordenar_visualizar_filtro_visitante.php"); ?>                    

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

if (isset($_GET['nombre_categoria_codifcryp'])) {
$nombre_categoria_codifcryp      = ($_GET['nombre_categoria_codifcryp']);
$nombre_categoria_codif          = DAXCODIFCRYPTOR::descriptardax($nombre_categoria_codifcryp);
$nombre_categoria                = DAXCODIFCRYPTOR::descodiftextodax($nombre_categoria_codif);

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_categoria = '$nombre_categoria') ORDER BY nombre_producto DESC";
}
elseif (isset($_GET['buscador'])) { 
$buscador_get = addslashes($_GET['buscador']); 

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_producto LIKE '%$buscador_get%') ORDER BY nombre_producto DESC";
}
elseif (isset($_GET['nombre_marca_codifcryp'])) { 
$nombre_marca_codifcryp              = ($_GET['nombre_marca_codifcryp']);
$nombre_marca_codif                  = DAXCODIFCRYPTOR::descriptardax($nombre_marca_codifcryp);
$nombre_marca                        = DAXCODIFCRYPTOR::descodiftextodax($nombre_marca_codif);

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_marca LIKE '$nombre_marca') ORDER BY nombre_producto DESC";
}
else { 
$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') ORDER BY nombre_producto DESC";
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
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="<?php echo $nombre_promocion_ing ?>"><?php echo $nombre_promocion ?></p>
                                                    </div>
                                                    <img src="<?php echo $url_img_orig_producto ?>" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <?php if ($inicio_sesion == 'SI') { ?>
                                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_barra=<?php echo $cod_producto_barra ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Contactar por WhatsApp" target="_blank"><i class="fas fa-comments"></i></a></li>
                                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_barra=<?php echo $cod_producto_barra ?>&accion_codifcryp=<?php echo $accion_telefono_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Llamar" target="_blank"><i class="fas fa-phone"></i></a></li>
                                                            <li><a href="../admin/producto_detalle.php?cod_producto_barra=<?php echo $cod_producto_barra ?>" data-toggle="tooltip" data-placement="right" title="Ver Producto"><i class="fas fa-image"></i></a></li>
                                                            <li id="cart-ok<?php echo $cod_producto_barra ?>"></li>
                                                            <?php } else { ?>
                                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_barra=<?php echo $cod_producto_barra ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Contactar por WhatsApp" target="_blank"><i class="fas fa-comments"></i></a></li>
                                                            <li><a href="tel:573012910881" data-toggle="tooltip" data-placement="right" title="Llamar" target="_blank"><i class="fas fa-phone"></i></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                            <?php if ($inicio_sesion == 'SI') { ?>
                                                            <a class="cart" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">Agregar al Carrito</a>
                                                            <?php } else { ?>
                                                            <a  class="cart" href="../admin/producto_detalle.php?cod_producto_barra=<?php echo $cod_producto_barra ?>" data-toggle="tooltip" data-placement="right" title="">Ver Descripción</a>
                                                            <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4><?php echo $nombre_producto ?></h4>
                                                    <h5> $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></h5>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="list-view">
<?php
$contador = 0;

if (isset($_GET['nombre_categoria'])) { 
$nombre_categoria_get = addslashes($_GET['nombre_categoria']); 

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_categoria = '$nombre_categoria_get') ORDER BY nombre_producto DESC";
}
elseif (isset($_GET['buscador'])) { 
$buscador_get = addslashes($_GET['buscador']); 

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_producto LIKE '%$buscador_get%') ORDER BY nombre_producto DESC";
}
else { 
$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
nombre_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') ORDER BY nombre_producto DESC";
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
$cod_estado                        = $datos_producto['cod_estado'];
if ($url_img_orig_producto=='') { $url_img_orig_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }
//$ptj_descuento                     = round((($precio_venta_producto2 - $precio_venta_producto) / $precio_venta_producto), 2) * 100;
?>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="<?php echo $nombre_promocion_ing ?>"><?php echo $nombre_promocion ?></p>
                                                        </div>
                                                        <img src="<?php echo $url_img_orig_producto ?>" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                            <?php if ($inicio_sesion == 'SI') { ?>
                                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_barra=<?php echo $cod_producto_barra ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Contactar por WhatsApp" target="_blank"><i class="fas fa-comments"></i></a></li>
                                                            <li><a href="tel:573012910881" data-toggle="tooltip" data-placement="right" title="Llamar" target="_blank"><i class="fas fa-phone"></i></a></li>
                                                            <li><a href="../admin/producto_detalle.php?cod_producto_barra=<?php echo $cod_producto_barra ?>" data-toggle="tooltip" data-placement="right" title="Ver Producto"><i class="fas fa-image"></i></a></li>
                                                            <li id="cart-ok<?php echo $cod_producto_barra ?>"></li>
                                                            <?php } else { ?>
                                                            <li><a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_barra=<?php echo $cod_producto_barra ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>" data-toggle="tooltip" data-placement="right" title="Contactar por WhatsApp" target="_blank"><i class="fas fa-comments"></i></a></li>
                                                            <li><a href="tel:573012910881" data-toggle="tooltip" data-placement="right" title="Llamar" target="_blank"><i class="fas fa-phone"></i></a></li>
                                                            <?php } ?>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4><?php echo $nombre_producto ?></h4>
                                                    <p><?php echo $descripcion_producto ?></p>
                                                    <?php if ($inicio_sesion == 'SI') { ?>
                                                    <a class="hvr-hover" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">Agregar al Carrito</a>
                                                    <?php } else { ?>
                                                    <a class="hvr-hover" href="../admin/producto_detalle.php?cod_producto_barra=<?php echo $cod_producto_barra ?>" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">Ver Descripción</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

<?php //include_once("../admin/05_modulo_algunos_productos_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_marcas_footer_visitante.php"); ?>

<?php //include_once("../admin/08_modulo_instagram_visitante.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook_visitante.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp_visitante.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante.php"); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.hvr-hover').click(function(){
        //var cod_producto_barra2 = $(this).parent().attr('id');
        var cod_producto_barra = $(this).attr('data-id');
        var und_vendida = $('#und_vendida').val();
        var datos_url_ajax = 'llave_codifcryp='+cod_producto_barra+'&'+'und_vendida='+und_vendida+'&'+'tab_codifcryp='+'<?php echo $tab_codifcryp ?>'+'&'+'campo_codifcryp='+'<?php echo $campo_codifcryp ?>'+'&'+'accion_codifcryp='+'<?php echo $accion_codifcryp ?>'+'&'+'origen_codifcryp='+'<?php echo $origen_codifcryp ?>'+'&'+'tipo_codifcryp='+'<?php echo $tipo_codifcryp ?>';

        $.ajax({
            type: "POST",
            url: "../admin/reg_venta_temporal_producto_visitante_ajax_reg.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $('#cart-hvr-hover-ok'+cod_producto_barra).append('<img src="../imagenes/correcto.jpg">').fadeIn("slow");
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(respuesta).fadeIn('slow');
                //$('#loader').html('');
                console.log("respuesta");
            }
        });
    });

});
</script>


<script type="text/javascript">
$(document).ready(function() {

    $('.cart').click(function(){
        //var cod_producto2 = $(this).parent().attr('id');
        var cod_producto_barra = $(this).attr('data-id');
        var cuenta = '<?php echo $cuenta_actual ?>';
        var cod_caja_virtual = '<?php echo $cod_caja_virtual ?>';
        var cod_base_caja = '<?php echo $cod_base_caja ?>';
        var nombre_tipo_moneda = 'COP';
        var nombre_tipo_factura = 'POS';
        var foco = 'busqueda';
        var cod_estado_vacuna = '0';
        var buscar_por = 'cod_producto_barra';
        var pagina = '<?php echo $pagina_local ?>';


        var datos_url_ajax = 'cod_producto_barra='+cod_producto_barra+'&'+'cuenta='+cuenta+'&'+'cod_caja_virtual='+cod_caja_virtual+'&'+'cod_base_caja='+cod_base_caja+'&'+'nombre_tipo_moneda='+nombre_tipo_moneda+'&'+'nombre_tipo_factura='+nombre_tipo_factura+'&'+'foco='+foco+'&'+'cod_estado_vacuna='+cod_estado_vacuna+'&'+'buscar_por='+buscar_por+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/reg_venta_temporal_producto_visitante_ajax_reg.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var carrito_compra_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
                var carrito_compra_temporal = respuesta.salida_info_actualizada_carrito_compra_menu_ajax;

                $("#salida_info_actualizada_carrito_compra_menu_total_reg_ajax").html(carrito_compra_temporal_total_reg).fadeIn('slow');
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(carrito_compra_temporal).fadeIn('slow');

                $('#cart-ok'+cod_producto_barra).append('<img src="../imagenes/correcto_visitante.png">').fadeIn("slow");
                $('#loader').html('');
            }
        });
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.hvr-hover').click(function(){
        //var cod_producto2 = $(this).parent().attr('id');
        var cod_producto_barra = $(this).attr('data-id');
        var und_vendida = '<?php echo $und_vendida ?>';
        var datos_url_ajax = 'llave_codifcryp='+cod_producto_barra+'&'+'und_vendida='+und_vendida+'&'+'tab_codifcryp='+'<?php echo $tab_codifcryp ?>'+'&'+'campo_codifcryp='+'<?php echo $campo_codifcryp ?>'+'&'+'accion_codifcryp='+'<?php echo $accion_codifcryp ?>'+'&'+'origen_codifcryp='+'<?php echo $origen_codifcryp ?>'+'&'+'tipo_codifcryp='+'<?php echo $tipo_codifcryp ?>'+'&'+'vendedor_codifcryp='+'<?php echo $vendedor_codifcryp ?>';

        $.ajax({
            type: "POST",
            url: "../admin/reg_venta_temporal_producto_visitante_ajax_reg.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $('#cart-hvr-hover-ok'+cod_producto_barra).append('<img src="../imagenes/correcto_visitante.png">').fadeIn("slow");
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(respuesta).fadeIn('slow');
                //$('#loader').html('');
            }
        });
    });

});
</script>

</body>

</html>