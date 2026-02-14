<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_version_tactil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_version_tactil.php"); ?>
<?php //include_once("../admin/01_modulo_permisos_version_tactil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php
$nombre_pagina          = "Tienda Virtual";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($titulo) ?></title>
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
<meta property="og:site_name"          content="<?php echo $nombre_emp ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $nombre_pagina ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_version_tactil.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>
<script type="text/javascript">
$(function(){
// Set up the number formatting.
$('#vlr_cancelado_number').on('change',function(){
//console.log('Change event.');
var vlr_cancelado_number = $('#vlr_cancelado_number').val();
$('#the_number').text( vlr_cancelado_number !== '' ? vlr_cancelado_number : '(empty)' );
});
//$('#vlr_cancelado').change(function(){ console.log('Second change event...'); });
$('#vlr_cancelado_number').number( true, 0 );

$("#vlr_cancelado_number").keyup(function () {
    var vlr_cancelado = $(this).val();
    $("#vlr_cancelado").val(vlr_cancelado);
});

});
</script>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->

<?php if (isset($_GET['buscador'])) { $buscador_get = addslashes($_GET['buscador']); } else { $buscador_get = ''; } ?>

<?php include_once("../seguridad/seguridad_diseno_plantillas_version_tactil.php"); ?>
    <!-- End Main Top -->
<?php //include_once("../admin/06_modulo_imagen_head_visitante.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante.php"); ?>

<?php
$pagina                              = $_SERVER['PHP_SELF'];
$pagina_local                        = $_SERVER['PHP_SELF'];

$tab                                 = "producto";
$tab_codif                           = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                       = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                               = "cod_producto";
$campo_codif                         = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                                = "carrito";
$tipo_codif                          = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                      = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                              = "registrar";
$accion_codif                        = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                              = "carrito";
$origen_codif                        = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$accion_whatapp                      = "redirecionar_whatapp";
$accion_whatapp_codif                = DAXCODIFCRYPTOR::encodiftextodax($accion_whatapp);
$accion_whatapp_codifcryp            = DAXCODIFCRYPTOR::encriptardax($accion_whatapp_codif);

$accion_telefono                     = "redirecionar_telefono";
$accion_telefono_codif               = DAXCODIFCRYPTOR::encodiftextodax($accion_telefono);
$accion_telefono_codifcryp           = DAXCODIFCRYPTOR::encriptardax($accion_telefono_codif);

$und_vendida                         = 1;
$und_vendida_codif                   = DAXCODIFCRYPTOR::encodifdax($und_vendida);
$und_vendida_codifcryp               = DAXCODIFCRYPTOR::encriptardax($und_vendida_codif);

$sql_info_factura_venta = "SELECT cod_info_factura_venta, cod_base_caja, cod_tipo_inventario, fecha_anyo, cod_administrador, cod_tipo_metodo_envio, 
nombre_tipo_moneda, nombre_tipo_factura, cod_tipo_forma_pago, descripcion_tipo_forma_pago, cod_tipo_pago, cod_tercero, observacion_tercero 
FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$cod_info_factura_venta              = $datos_info_factura_venta['cod_info_factura_venta'];
$cod_base_caja                       = $datos_info_factura_venta['cod_base_caja'];
$cod_tipo_inventario                 = $datos_info_factura_venta['cod_tipo_inventario'];
$fecha_anyo                          = $datos_info_factura_venta['fecha_anyo'];
$cod_administrador                   = $datos_info_factura_venta['cod_administrador'];
$cod_tipo_metodo_envio               = $datos_info_factura_venta['cod_tipo_metodo_envio'];
$nombre_tipo_moneda                  = $datos_info_factura_venta['nombre_tipo_moneda'];
$nombre_tipo_factura                 = $datos_info_factura_venta['nombre_tipo_factura'];
$cod_tipo_forma_pago                 = $datos_info_factura_venta['cod_tipo_forma_pago'];
$descripcion_tipo_forma_pago         = $datos_info_factura_venta['descripcion_tipo_forma_pago'];
$cod_tipo_pago                       = $datos_info_factura_venta['cod_tipo_pago'];
$cod_tercero                         = $datos_info_factura_venta['cod_tercero'];
$observacion_tercero                 = $datos_info_factura_venta['observacion_tercero'];
$cod_tipo_aplicacion                 = '3';


if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
?>

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias_visitante.php"); ?>

<!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                
                <div class="col-xl-4 col-lg-4 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                        <div class="search-product">
                            <form method="GET" name="formulario2" action="../admin/reg_venta_temporal_producto_reg.php">
                            <!--
                                <select name="buscar_por" id="buscar_por" class="form-control">
                                    <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['nombre_buscar_por'];
                                    $nombre = $datos2['titulo_buscar_por'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            -->
                                <input type="text" name="cod_producto_barra" id="busqueda" value="<?php echo $buscador_get ?>" class="form-control" placeholder="Codigo de Barras" required>
                                <button type="submit"> <i class="fa fa-search"></i> </button>

                                <input type="hidden" name="buscar_por" value="cod_producto_barra">
                                <input type="hidden" name="nombre_tipo_moneda" value="<?php echo $nombre_tipo_moneda; ?>">
                                <input type="hidden" name="nombre_tipo_factura" value="<?php echo $nombre_tipo_factura; ?>">
                                <input type="hidden" name="foco" value="<?php echo $foco; ?>">
                                <input type="hidden" name="cod_estado_vacuna" value="1">
                                <input type="hidden" name="cuenta" value="<?php echo $cuenta_actual; ?>">
                                <input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual; ?>">
                                <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
                                <input type="hidden" name="cod_tipo_aplicacion" value="<?php echo $cod_tipo_aplicacion; ?>">
                            </form>
                        </div>
<!-- ///////////////////////////////////////////////////////CARRITO COMPRA INI//////////////////////////////////////////////////////////////// -->
                <form method="POST" name="formulario" action="../admin/venta_producto_reg.php">
                    <div id="salida_info_actualizada_carrito_compra_ajax">
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3><a href="#"><?php echo $nombre_concepto_multi_virtual ?> DE VENTA  [<?php echo $cod_base_caja ?>] - ID: <?php echo $cod_info_factura_venta ?></a></h3>
                            </div>

                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
                                    <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                                        <div class="list-group">

                                            <div class="col-md-12 col-lg-12">
                                                <div class="odr-box">
                                                    <div class="rounded p-2 bg-light" id="div_madre">
<?php
$conteo = 0;

$sql_producto_total = "SELECT SUM(und_venta * precio_venta_producto) as total_venta, nombre_producto FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

$total_venta              = $datos_producto_total['total_venta'];

$sql_producto = "SELECT cod_venta_producto_temporal, nombre_producto, und_venta, precio_venta_producto, 
total_venta_producto, url_img_min_producto, url_img_orig_producto, fecha_seg_venta_producto
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
//$total_reg = mysqli_num_rows($consulta_producto);
$total_datos = mysqli_num_rows($consulta_producto);
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_venta_producto_temporal              = $datos_producto['cod_venta_producto_temporal'];
$cod_venta_producto_temporal_codif        = DAXCODIFCRYPTOR::encodifdax($cod_venta_producto_temporal);
$cod_venta_producto_temporal_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_venta_producto_temporal_codif);
$nombre_producto                          = $datos_producto['nombre_producto'];
$und_venta                                = $datos_producto['und_venta'];
$precio_venta_producto                    = $datos_producto['precio_venta_producto'];
$total_venta_producto                     = $datos_producto['total_venta_producto'];
$fecha_seg_venta_producto                 = $datos_producto['fecha_seg_venta_producto'];
$fecha_hora_venta_producto                = date("H:i", $fecha_seg_venta_producto);
///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
$url_img_min_producto                     = $datos_producto['url_img_min_producto'];
$url_img_orig_producto                    = $datos_producto['url_img_orig_producto'];
$total_venta_ind                          = $und_venta * $precio_venta_producto;
//$total_venta                             += $und_venta * $precio_venta_producto;
?>
                                                        <div id="productos_lista_temporal_venta">
                                                        <div class="media mb-2 border-bottom" id="elim<?php echo $cod_venta_producto_temporal ?>">
                                                            <div class="media-body"><a class="eliminar" data="<?php echo $cod_venta_producto_temporal ?>" id="cod_venta_producto_temporal<?php echo $cod_venta_producto_temporal ?>"><i class="fas fa-times"></i></a><span class="mx-2">|</span><a href="#"><?php echo $nombre_producto ?></a><span class="mx-2">|</span><?php echo $fecha_hora_venta_producto ?>
                                                                <div class="small text-muted">Precio: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?><span class="mx-2">|</span>Cant: <?php echo $und_venta ?><span class="mx-2">|</span>Total: $<?php echo number_format($total_venta_ind, 0, ",", ".") ?></div>
                                                            </div>
                                                        </div>
                                                        </div>
<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <?php if ($total_datos <> '0') { ?>
                                            <div id="mostrar_si_existe_registro">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="order-box">
                                                    <div class="d-flex gr-total">
                                                        <h5>Total Venta</h5>
                                                        <div class="ml-auto h5" id="total_venta_tactil_ajax">$ <?php echo number_format($total_venta, 0, ",", ".") ?></div>
                                                    </div>
                                                    <div class="d-flex gr-total">
                                                        <h5>Recibido</h5>
                                                        <div class="ml-auto h5"><input type="text" name="vlr_cancelado_number" id="vlr_cancelado_number" value="" class="form-control" style="width: 150px;" required></div>
                                                        <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
                                                    </div>
                                                    <hr> 
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Facturar Venta</button></div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>">
                    <input type="hidden" name="cod_base_caja" value="<?php echo $cod_base_caja ?>">
                    <input type="hidden" name="cod_tipo_inventario" value="<?php echo $cod_tipo_inventario ?>">
                    <input type="hidden" name="fecha_anyo" value="<?php echo $fecha_anyo ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>">
                    <input type="hidden" name="cod_tipo_pago" value="<?php echo $cod_tipo_pago ?>">
                    <input type="hidden" name="cod_tipo_metodo_envio" value="<?php echo $cod_tipo_metodo_envio ?>">
                    <input type="hidden" name="nombre_tipo_moneda" value="<?php echo $nombre_tipo_moneda ?>">
                    <input type="hidden" name="nombre_tipo_factura" value="<?php echo $nombre_tipo_factura ?>">
                    <input type="hidden" name="cod_tipo_forma_pago" value="<?php echo $cod_tipo_forma_pago ?>">
                    <input type="hidden" name="descripcion_tipo_forma_pago" value="<?php echo $descripcion_tipo_forma_pago ?>">
                    <input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
                    <input type="hidden" name="observacion_tercero" value="<?php echo $observacion_tercero ?>">
                    <input type="hidden" name="total_datos" value="<?php echo $total_datos ?>">
                    <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
                    <input type="hidden" name="flete" value="0" size="15">
                    <input type="hidden" name="verificacion_envio" value="1">
                    <input type="hidden" name="cod_estado_vacuna" value="0">
                </form>
<!-- ///////////////////////////////////////////////////////CARRITO COMPRA FIN//////////////////////////////////////////////////////////////// -->
                    </div>
                </div>

<!-- ///////////////////////////////////////////////////////PRODUCTOS IMAG MENU INI//////////////////////////////////////////////////////////////// -->
                    <div class="col-xl-8 col-lg-8 col-sm-12 col-xs-12 shop-content-right">
                        <div class="right-product-box">

                            <div class="row product-categorie-box">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                        <div class="row" id="salida_info_actualizada_productos_menu_imag_ajax">
    <?php
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
    $contador = 0;

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
                                                <a class="agregar_carrito_compra" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">
                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">
                                                            <div class="type-lb">
                                                                <p class="<?php echo $nombre_promocion_ing ?>"><?php echo $nombre_promocion ?></p>
                                                            </div>
                                                            <img src="<?php echo $url_img_orig_producto ?>" class="img-fluid" alt="<?php echo $nombre_producto ?>">
                                                            <div class="mask-icon">
                                                                <ul>
                                                                    <li id="cart-ok<?php echo $cod_producto_barra ?>"></li>
                                                                </ul>
                                                                    <!--<a class="agregar_carrito_compra" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">Agregar al Carrito</a>-->
                                                            </div>
                                                        </div>
                                                        <div class="why-text">
                                                            <h4><?php echo $nombre_producto ?></h4>
                                                            <h5> $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
    <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>    
<!-- ///////////////////////////////////////////////////////PRODUCTOS IMAG MENU FIN//////////////////////////////////////////////////////////////// -->
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

<?php //include_once("../admin/05_modulo_algunos_productos_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_marcas_footer_visitante.php"); ?>

<?php //include_once("../admin/08_modulo_instagram_visitante.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook_visitante.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp_visitante.php"); ?>

<?php include_once("../admin/09_modulo_footer_version_tactil.php"); ?>

<?php include_once("../admin/10_modulo_js_sin_jquery_tactil.php"); ?>

<script type="text/javascript">
$(document).ready(function() {

    //$('.agregar_carrito_compra').live(function(){
    $(".agregar_carrito_compra").on("click", function(){
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
        var tipo_accion = 'registrar';
        var tab = 'tbl15_venta_producto_temporal';
        var campo = 'cod_producto_barra';
        var id = $(this).attr('data-id');
        var cod_tipo_aplicacion = '<?php echo $cod_tipo_aplicacion ?>';
        var cod_info_factura_venta = '<?php echo $cod_info_factura_venta ?>';

        var datos_url_ajax = 'cod_producto_barra='+cod_producto_barra+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'cod_tipo_aplicacion='+cod_tipo_aplicacion+'&'+'tipo_accion='+tipo_accion+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'id='+id+'&'+'cuenta='+cuenta+'&'+'cod_caja_virtual='+cod_caja_virtual+'&'+'cod_base_caja='+cod_base_caja+'&'+'nombre_tipo_moneda='+nombre_tipo_moneda+'&'+'nombre_tipo_factura='+nombre_tipo_factura+'&'+'foco='+foco+'&'+'cod_estado_vacuna='+cod_estado_vacuna+'&'+'buscar_por='+buscar_por+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/venta_temporal_producto_ajax_version_tactil.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var venta_producto_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
                var venta_producto_temporal = respuesta.salida_info_actualizada_carrito_compra_menu_ajax;
                var salida_info_actualizada_carrito_compra_ajax = respuesta.salida_info_actualizada_carrito_compra_ajax;
                var total_venta_tactil_ajax = respuesta.total_venta_tactil_ajax;
                var salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax = respuesta.salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax;

                var cod_venta_producto_temporal = respuesta.cod_venta_producto_temporal;
                var cod_producto_barra = respuesta.cod_producto_barra;
                var nombre_promocion_ing = respuesta.nombre_promocion_ing;
                var nombre_promocion = respuesta.nombre_promocion;
                var url_img_orig_producto = respuesta.url_img_orig_producto;
                var nombre_producto = respuesta.nombre_producto;
                var precio_venta_producto = respuesta.precio_venta_producto;
                var und_venta = respuesta.und_venta;
                var total_venta_ind = respuesta.total_venta_ind;
                var fecha_hora_venta_producto = respuesta.fecha_hora_venta_producto;


                $("#salida_info_actualizada_carrito_compra_menu_total_reg_ajax").html(venta_producto_temporal_total_reg).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(venta_producto_temporal).fadeIn('fast');
                //$("#salida_info_actualizada_carrito_compra_ajax").html(salida_info_actualizada_carrito_compra_ajax).fadeIn('fast');
                $("#total_venta_tactil_ajax").html(total_venta_tactil_ajax).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax").html(salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax).fadeIn('fast');
                                                        
                 var productos_lista_temporal_venta = '' +
                '<div class="media mb-2 border-bottom" id="elim'+cod_venta_producto_temporal+'">'+
                    '<div class="media-body"><a class="eliminar" data="'+cod_venta_producto_temporal+'" id="cod_venta_producto_temporal'+cod_venta_producto_temporal+'"><i class="fas fa-times"></i></a><span class="mx-2">|</span><a href="#">'+nombre_producto+'</a><span class="mx-2">|</span>'+fecha_hora_venta_producto+''+
                        '<div class="small text-muted">Precio: $'+precio_venta_producto+'<span class="mx-2">|</span>Cant: '+und_venta+'<span class="mx-2">|</span>Total: $'+total_venta_ind+'</div>'+
                    '</div>'+
                '</div>';

                //console.log(productos_lista_temporal_venta);
                $('#productos_lista_temporal_venta').append(productos_lista_temporal_venta);

                $('#cart-ok'+cod_producto_barra).append('<img src="../imagenes/correcto_visitante.png">').fadeIn("fast");
                $('#loader').html('');
            }
        });
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').on("click", function(){
        var cod_venta_producto_temporal = $(this).attr('data');
        var cuenta = '<?php echo $cuenta_actual ?>';
        var cod_caja_virtual = '<?php echo $cod_caja_virtual ?>';
        var cod_base_caja = '<?php echo $cod_base_caja ?>';
        var nombre_tipo_moneda = 'COP';
        var nombre_tipo_factura = 'POS';
        var foco = 'busqueda';
        var cod_estado_vacuna = '0';
        var buscar_por = 'cod_venta_producto_temporal';
        var pagina = '<?php echo $pagina_local ?>';
        var tipo_accion = 'eliminar';
        var tab = 'tbl15_venta_producto_temporal';
        var campo = 'cod_venta_producto_temporal';
        var id = $(this).attr('data');
        var cod_tipo_aplicacion = '<?php echo $cod_tipo_aplicacion ?>';
        var cod_info_factura_venta = '<?php echo $cod_info_factura_venta ?>';

        var datos_url_ajax = 'cod_venta_producto_temporal='+cod_venta_producto_temporal+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'cod_tipo_aplicacion='+cod_tipo_aplicacion+'&'+'tipo_accion='+tipo_accion+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'id='+id+'&'+'cuenta='+cuenta+'&'+'cod_caja_virtual='+cod_caja_virtual+'&'+'cod_base_caja='+cod_base_caja+'&'+'nombre_tipo_moneda='+nombre_tipo_moneda+'&'+'nombre_tipo_factura='+nombre_tipo_factura+'&'+'foco='+foco+'&'+'cod_estado_vacuna='+cod_estado_vacuna+'&'+'buscar_por='+buscar_por+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/venta_temporal_producto_ajax_version_tactil.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $('#elim'+cod_venta_producto_temporal).fadeOut("fast");

                var venta_producto_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
                var venta_producto_temporal = respuesta.salida_info_actualizada_carrito_compra_menu_ajax;
                var salida_info_actualizada_carrito_compra_ajax = respuesta.salida_info_actualizada_carrito_compra_ajax;
                var total_venta_tactil_ajax = respuesta.total_venta_tactil_ajax;
                var salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax = respuesta.salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax;

                $("#salida_info_actualizada_carrito_compra_menu_total_reg_ajax").html(venta_producto_temporal_total_reg).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(venta_producto_temporal).fadeIn('fast');
                //$("#salida_info_actualizada_carrito_compra_ajax").html(salida_info_actualizada_carrito_compra_ajax).fadeIn('fast');
                $("#total_venta_tactil_ajax").html(total_venta_tactil_ajax).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax").html(salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax).fadeIn('fast');
            }
        });
    });

});
</script>
</body>
</html>

<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>