<?php 
$nombre_pagina          = "Simulador de Credito";
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
if (isset($_REQUEST['valor_credito'])) { $valor_credito = addslashes($_REQUEST['valor_credito']); } else { $valor_credito = ''; }
if (isset($_REQUEST['cod_entidad_crediticia'])) { $cod_entidad_crediticia = addslashes($_REQUEST['cod_entidad_crediticia']); } else { $cod_entidad_crediticia = '0'; }
if (isset($_REQUEST['cod_tipo_cobro'])) { $cod_tipo_cobro = addslashes($_REQUEST['cod_tipo_cobro']); } else { $cod_tipo_cobro = '0'; }
if (isset($_REQUEST['cod_meses_credito'])) { $cod_meses_credito = addslashes($_REQUEST['cod_meses_credito']); } else { $cod_meses_credito = '0'; }

if (isset($_REQUEST['cod_producto_codifcryp'])) { $cod_producto_codifcryp = addslashes($_REQUEST['cod_producto_codifcryp']); } else { $cod_producto_codifcryp = ''; }
$cod_producto_codifcryp            = ($_REQUEST['cod_producto_codifcryp']);
$cod_producto_codif                = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
$cod_producto                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
cod_categoria, cod_estado FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                = $datos_producto['cod_producto_barra'];
$nombre_producto                   = $datos_producto['nombre_producto'];
$und_producto                      = $datos_producto['und_producto'];
$precio_venta_producto             = $datos_producto['precio_venta_producto'];
$descripcion_producto              = $datos_producto['descripcion_producto'];
$url_img_min_producto              = $datos_producto['url_img_min_producto'];
$url_img_orig_producto             = $datos_producto['url_img_orig_producto'];
if ($url_img_min_producto=='') { $url_img_min_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }
?>

<!-- Start Cart  -->
<form name="formulario_de_actualizacion" method="POST" enctype="multipart/form-data" action="../admin/simulador_credito_producto_por_cuotas_visitante_intern_resultado_get.php">
    <div class="cart-box-main">
        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Simulador de Credito</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form-right">
                        <div class="row">
                            <div class="col-md-4">
                                <div style="text-align:center;" class="">Nombre del producto *
                                    <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" value="<?php echo $nombre_producto ?>" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="text-align:center;" class="">Escribe el valor del crédito *
                                    <input type="text" class="form-control" name="valor_credito" id="valor_credito" value="<?php echo $precio_venta_producto ?>" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="text-align:center;" class="">Cuotas *
                                    <select name="cod_meses_credito" id="cod_meses_credito" class="form-control" data-show-subtext="false" data-live-search="false" tabindex="1" required>
                                        <?php if (isset($cod_meses_credito)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                                        $consulta2_sql = "SELECT cod_meses_credito, nombre_meses_credito FROM tbl15_meses_credito WHERE (cod_estado = '1') ORDER BY cod_meses_credito ASC";
                                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                        if(isset($cod_meses_credito) AND $cod_meses_credito == $datos2['cod_meses_credito']) {
                                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                                        $codigo = $datos2['cod_meses_credito'];
                                        $nombre = $datos2['nombre_meses_credito'];
                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Simular Credito</div></button>
                            <input type="hidden" class="form-control" name="cod_producto_codifcryp" id="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp ?>">
                            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                            <input type="hidden" name="insertar_datos" value="formulario">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>