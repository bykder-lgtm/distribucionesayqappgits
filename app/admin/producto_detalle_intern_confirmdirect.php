<?php 
$nombre_pagina          = "Detalle del producto";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_confirmdirect.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_confirmdirect.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php
$cod_producto_codifcryp            = ($_GET['cod_producto_codifcryp']);
$cod_producto_codif                = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
$cod_producto                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

if (isset($_GET['fbclid']) <> '') { $fbclid = mysqli_real_escape_string($conectar,($_GET['fbclid'])); } else { $fbclid = ''; }
?>

<?php //include_once("../admin/01_rastreador.php"); ?>
<?php //include_once("../admin/01_rastreador_geolocalizacion_gps_javacript.php"); ?>

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

$contador                          = 0;
$estado_active                     = "";
$conteo                            = 0;

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, cod_categoria, cod_estado 
FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

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
if ($url_img_min_producto=='') { $url_img_min_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }
$frag                            = explode('..', $url_img_orig_producto);
$url_img_producto_orig_comple    = 'https://corfibra.com/editaxe'.$frag['1'];
?>
<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre_producto) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $descripcion_producto ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_producto ?>" />
<meta property="og:description"        content="<?php echo $descripcion_producto ?>" />
<meta property="og:image"              content="<?php echo $url_img_producto_orig_comple ?>" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="<?php echo $usuario_redsocial_facebook ?>"/>
<meta name="twitter:card"              content="<?php echo $nombre_producto ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>?cod_blog_codifcryp=<?php echo $cod_blog_codifcryp ?>">
<meta name="twitter:title"             content="<?php echo $nombre_producto ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo $url_img_producto_orig_comple ?>">

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
<?php //include_once("../admin/06_modulo_estamos_en_mantenimiento_head.php"); ?>

<?php //include_once("../admin/06_modulo_imagen_head_visitante.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias_visitante.php"); ?>



    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-7">

<div class="single-product-details"><h1><?php echo $nombre_producto ?> - <?php echo $cod_producto ?></h1></div>

                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $sql_producto = "SELECT * FROM tbl15_producto_imagen WHERE cod_producto = '$cod_producto'";
                            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                                $conteo++;
                                $url_img_min_producto             = $datos_producto['url_img_min_producto'];
                                $url_img_orig_producto            = $datos_producto['url_img_orig_producto'];
                                $active                           = $datos_producto['active'];

                                if ($conteo==1) { $estado_active = "active"; } else { $estado_active = ""; }
                            ?>
                            <div class="carousel-item <?php echo $estado_active ?>"><img class="d-block w-100" src="<?php echo $url_img_orig_producto ?>" alt=""></div>
                            <?php } ?>  
                                                    </div>
                            <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i><span class="sr-only">Previous</span></a>
                            <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i><span class="sr-only">Next</span></a>
                                                    <ol class="carousel-indicators">
                            <?php
                            $contador = 0;
                            $sql_producto = "SELECT * FROM tbl15_producto_imagen WHERE cod_producto = '$cod_producto'";
                            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                                $url_img_min_producto            = $datos_producto['url_img_min_producto'];
                                $url_img_orig_producto           = $datos_producto['url_img_orig_producto'];
                                $active                          = $datos_producto['active'];
                            ?>
                            <li data-target="#carousel-example-1" data-slide-to="<?php echo $contador ?>" class="<?php echo $active ?>">
                                <img class="d-block w-100 img-fluid" src="<?php echo $url_img_min_producto ?>" alt="" />
                            </li>
                            <?php $contador++; } ?>
                        </ol>
                    </div>
<!--
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Formulario de cotización de precios</h2>
                        <form action="../admin/formulario_cotizacion_reg.php" method="post" id="contactForm">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre *" required data-error="Por favor ingresa tu nombre">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="correo" id="correo" class="form-control" placeholder="Correo *" required data-error="Por favor ingresa tu corres">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Numero de Telefono *" data-error="Por favor ingresa tu numero de telefono">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="telefono_whatsapp" id="telefono_whatsapp" class="form-control" placeholder="Numero de Whatsapp *" data-error="Por favor ingresa tu numero de whatsapp">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    <textarea name="comentario" id="comentario" class="form-control" rows="2" cols="10" placeholder="Escribe tus dudas o comentarios aqui !"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Cotizar Producto</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <input type="hidden" name="asunto" value="Cotizacion Por Pagina Web" />
                                        <input type="hidden" name="nombre_origen_formulario" value="FORMULARIO_COTIZACION_PRODUCTO" />
                                        <input type="hidden" name="cod_producto_codifcryp" id="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp;?>" />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
<hr>
<div class="col-xl-12 col-lg-5 col-md-6">
    <div class="single-product-details">
    <h2><div id="texto_resaltado">Comunícate con nosotros al siguiente número de whatsapp para obtener mejores precios.</div></h2>
    <a href="../admin/contactar_por_whatapp_telefono.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>&accion_codifcryp=<?php echo $accion_whatapp_codifcryp ?>&tipo_codifcryp=<?php echo $tipo_codifcryp ?>&origen_codifcryp=<?php echo $origen_codifcryp ?>"  target="_blank"><img src="../admin/crear_escribir_sobre_imagen_whatapp_empresa.php?tel1=<?php echo $tel1 ?>" /></a>
    <a href="tel:57<?php echo $tel1 ?>"  target="_blank"><img src="../admin/crear_escribir_sobre_imagen_telefono_empresa.php?tel1=<?php echo $tel1 ?>" /></a>
    </div>
</div>
-->

                </div>


                <div class="col-xl-5 col-lg-5 col-md-5">
                    <div class="single-product-details">
                                <h4>Descripción:</h4>
                                <p><?php echo ($descripcion_producto) ?></p>
                                <ul>
                                    <div class="share-bar">
                                        <a class="btn hvr-hover" href="<?php echo $url_redsocial_facebook ?>" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="<?php echo $url_redsocial_youtube ?>" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a>

                                        <!--
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                        -->
                                        <a class="btn hvr-hover" href="<?php echo $url_redsocial_instagram ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>&text=Hola" target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                    </div>
                </div>


            </div>

<?php //include_once("../admin/modulo_productos_relacionados.php"); ?>

        </div>
    </div>
    <!-- End Cart -->
    <!-- End Shop Page -->

<?php //include_once("../admin/05_modulo_algunos_productos_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_marcas_footer_visitante.php"); ?>

<?php //include_once("../admin/08_modulo_instagram_visitante.php"); ?>

<?php //include_once("../admin/09_modulo_chat_messenger_facebook_visitante.php"); ?>
<?php include_once("../admin/09_modulo_chat_whatsapp_visitante.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante_intern_confirmdirect.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_confirmdirect.php"); ?>


<script type="text/javascript">
popupWhatsApp = () => {
  
  let btnClosePopup = document.querySelector('.closePopup');
  let btnOpenPopup = document.querySelector('.whatsapp-button');
  let popup = document.querySelector('.popup-whatsapp');
  let sendBtn = document.getElementById('send-btn');

  btnClosePopup.addEventListener("click",  () => {
    popup.classList.toggle('is-active-whatsapp-popup')
  })
  
  btnOpenPopup.addEventListener("click",  () => {
    popup.classList.toggle('is-active-whatsapp-popup')
     popup.style.animation = "fadeIn .6s 0.0s both";
  })
  
  sendBtn.addEventListener("click", () => {
  let mensaje = document.getElementById('whats-in').value;
  let mensaje_trad = mensaje.replace(/ /g,"%20");
     
   window.open('https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>&text='+mensaje_trad, '_blank'); 
  
  });

  setTimeout(() => {
    popup.classList.toggle('is-active-whatsapp-popup');
  }, 3000);
}

popupWhatsApp();
</script>

</body>

</html>