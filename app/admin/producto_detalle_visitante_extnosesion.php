<?php 
$nombre_pagina          = "Detalle del producto";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_extnosesion.php"); ?>
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

$sql_producto_ind = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, precio_venta_producto3, url_img_producto_min, url_img_producto_orig, cod_estado, und_inv, nombre_categoria,
nombre_categoria_sub, cod_marca 
FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta_producto_ind = mysqli_query($conectar, $sql_producto_ind) or die(mysqli_error($conectar));
$datos_producto_ind = mysqli_fetch_assoc($consulta_producto_ind);

$nombre_producto                 = $datos_producto_ind['nombre_producto'];
$precio_venta_producto           = $datos_producto_ind['precio_venta_producto'];
$precio_venta_producto2          = $datos_producto_ind['precio_venta_producto2'];
$descripcion_producto            = $datos_producto_ind['descripcion_producto'];
$und_inv                         = $datos_producto_ind['und_inv'];
$nombre_categoria                = $datos_producto_ind['nombre_categoria'];
$nombre_categoria_sub            = $datos_producto_ind['nombre_categoria_sub'];
$cod_marca                       = $datos_producto_ind['cod_marca'];
$url_img_producto_orig           = $datos_producto_ind['url_img_producto_orig'];
$frag                            = explode('..', $url_img_producto_orig);
$url_img_producto_orig_comple    = '<?php echo ($url_pag) ?>/editaxe'.$frag['1'];
?>
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

<?php include_once("../admin/03_modulo_css_visitante_extnosesion.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">
</head>

<body>
    <!-- End Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_extnosesion.php"); ?>
    <!-- End Main Top -->
<?php //include_once("../admin/06_modulo_imagen_head_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante_extnosesion.php"); ?>

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

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias.php"); ?>



    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-7">

<div class="single-product-details"><h1><?php echo $nombre_producto ?></h1></div>

                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $sql_producto = "SELECT * FROM tbl15_producto_imagen WHERE cod_producto = '$cod_producto'";
                            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                                $conteo++;
                                $url_img_producto_min             = $datos_producto['url_img_producto_min'];
                                $url_img_producto_orig            = $datos_producto['url_img_producto_orig'];
                                $active                           = $datos_producto['active'];

                                if ($conteo==1) { $estado_active = "active"; } else { $estado_active = ""; }
                            ?>
                            <div class="carousel-item <?php echo $estado_active ?>"><img class="d-block w-100" src="<?php echo $url_img_producto_orig ?>" alt=""></div>
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

                            $url_img_producto_min            = $datos_producto['url_img_producto_min'];
                            $url_img_producto_orig           = $datos_producto['url_img_producto_orig'];
                            $active                          = $datos_producto['active'];
                            ?>
                            <li data-target="#carousel-example-1" data-slide-to="<?php echo $contador ?>" class="<?php echo $active ?>">
                                <img class="d-block w-100 img-fluid" src="<?php echo $url_img_producto_min ?>" alt="" />
                            </li>
                            <?php $contador++; } ?>
                        </ol>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="contact-form-right">
                            <h2>Ingresa tus datos personales</h2>
                            <form action="../admin/reg_siscredito_tercero_cliente_visitante_extnosesion_reg.php" method="post" id="contactForm">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="select_nombre_tipo_identificacion" name="nombre_tipo_identificacion" class="form-control" required>
                                                <?php if (isset($nombre_tipo_identificacion)) { echo ""; } else { echo ""; }
                                                $consulta2_sql = "SELECT cod_tipo_identificacion, nombre_tipo_identificacion FROM tbl15_tipo_identificacion WHERE (cod_estado = '1')";
                                                $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                if(isset($nombre_tipo_identificacion) and $nombre_tipo_identificacion == $datos2['nombre_tipo_identificacion']) {
                                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                $codigo           = $datos2['nombre_tipo_identificacion'];
                                                $nombre           = $datos2['nombre_tipo_identificacion'];
                                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="identificacion_tercero" name="identificacion_tercero" placeholder="Numero de identificación" required data-error="Por favor, escriba su numero de identificación" required/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nombre1_tercero" name="nombre1_tercero" placeholder="Primer nombre" required data-error="Por favor, ingrese su primer nombre" required/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nombre2_tercero" name="nombre2_tercero" placeholder="Segundo nombre" data-error="Por favor, ingrese su segundo nombre" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="apellido1_tercero" name="apellido1_tercero" placeholder="Primer apellido" required data-error="Por favor, ingrese su primer apellido" required/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="apellido2_tercero" name="apellido2_tercero" placeholder="Segundo apellido" data-error="Por favor, ingrese su segundo apellido" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Fecha de nacimiento</p>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="fecha_nac_tercero" name="fecha_nac_tercero" placeholder="Fecha de nacimiento" required data-error="Por favor, ingrese su fecha de nacimiento" required/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Fecha de expedición</p>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="fecha_expedicion_tercero" name="fecha_expedicion_tercero" placeholder="Fecha de expedición" required data-error="Por favor, ingrese su fecha de expedición"/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="telefono1_tercero" name="telefono1_tercero" placeholder="Celular" required data-error="Por favor, ingrese su celular" required/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="correo_tercero" name="correo_tercero" placeholder="Correo" required data-error="Por favor, ingrese su Correo" required/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="direccion_tercero" name="direccion_tercero" placeholder="Dirección" required data-error="Por favor, ingrese su dirección" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="select_nombre_estado_civil" name="nombre_estado_civil" class="form-control" required>
                                                <?php if (isset($nombre_estado_civil)) { echo ""; } else { echo ""; }
                                                $consulta2_sql = "SELECT cod_estado_civil, nombre_estado_civil FROM tbl15_estado_civil";
                                                $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                if(isset($nombre_estado_civil) and $nombre_estado_civil == $datos2['nombre_estado_civil']) {
                                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                $codigo           = $datos2['nombre_estado_civil'];
                                                $nombre           = $datos2['nombre_estado_civil'];
                                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="submit-button text-center">
                                            <button class="btn hvr-hover" id="submit" type="submit">Registrarse</button>
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                            <input type="hidden" name="asunto" value="Cotizacion Por Pagina Web" />
                                            <input type="hidden" name="nombre_origen_formulario" value="FORMULARIO_COTIZACION_PRODUCTO" />
                                            <input type="hidden" name="cod_producto_codifcryp" id="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp;?>" />
                                            <input type="hidden" name="pagina" value="<?php echo $pagina_local;?>" />
                                            <input type="hidden" name="valor_credito" value="<?php echo $precio_venta_producto;?>" />
                                            <input type="hidden" name="cod_entidad_crediticia" value="0" />
                                            <input type="hidden" name="cod_tipo_cobro" value="2" />
                                            <input type="hidden" name="cod_meses_credito" value="1" />
                                            <input type="hidden" name="nombre_tipo_tercero" value="" />
                                            <input type="hidden" name="nombre_tipo_tercero_modulo_creacion" value="" />
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

<!--
                    <div class="col-lg-12 col-sm-12">
                        <div class="contact-form-right">
                            <h2>Formulario de cotización de precios</h2>
                            <form action="../admin/formulario_cotizacion_visitante_extnosesion_reg.php" method="post" id="contactForm">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre *" required data-error="Por favor ingresa tu nombre">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo *" required data-error="Por favor ingresa tu corres">
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
                                            <input type="hidden" name="pagina" value="<?php echo $pagina_local;?>" />
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
                                        <a class="btn hvr-hover" href="<?php echo $url_redsocial_instagram ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        -->
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

<?php //include_once("../admin/05_modulo_algunos_productos_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/05_modulo_slider_marcas_footer_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/08_modulo_instagram_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/09_modulo_chat_messenger_facebook_visitante_extnosesion.php"); ?>
<?php include_once("../admin/09_modulo_chat_whatsapp_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/05_modulo_slider_marcas_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.hvr-hover').click(function(){
        //var cod_producto_codifcryp2 = $(this).parent().attr('id');
        var cod_producto_codifcryp = $(this).attr('data-id');
        var und_vendida = $('#und_vendida').val();
        var datos_url_ajax = 'llave_codifcryp='+cod_producto_codifcryp+'&'+'und_vendida='+und_vendida+'&'+'tab_codifcryp='+'<?php echo $tab_codifcryp ?>'+'&'+'campo_codifcryp='+'<?php echo $campo_codifcryp ?>'+'&'+'accion_codifcryp='+'<?php echo $accion_codifcryp ?>'+'&'+'origen_codifcryp='+'<?php echo $origen_codifcryp ?>'+'&'+'tipo_codifcryp='+'<?php echo $tipo_codifcryp ?>';

        $.ajax({
            type: "POST",
            url: "../admin/carrito_compra_temporal_ajax.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $('#cart-hvr-hover-ok'+cod_producto_codifcryp).append('<img src="../imagenes/correcto.jpg">').fadeIn("slow");
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(respuesta).fadeIn('slow');
                //$('#loader').html('');
                console.log("respuesta");
            }
        });
    });

});
</script>

</body>

</html>