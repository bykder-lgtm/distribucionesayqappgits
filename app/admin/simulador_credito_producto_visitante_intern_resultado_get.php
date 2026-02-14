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
if (isset($_REQUEST['cod_producto_codifcryp'])) { 
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

    if (isset($_REQUEST['valor_credito'])) { $valor_credito = addslashes($_REQUEST['valor_credito']); } else { $valor_credito = $precio_venta_producto; }
    if (isset($_REQUEST['cod_entidad_crediticia'])) { $cod_entidad_crediticia = addslashes($_REQUEST['cod_entidad_crediticia']); } else { $cod_entidad_crediticia = '0'; }
    if (isset($_REQUEST['cod_tipo_cobro'])) { $cod_tipo_cobro = addslashes($_REQUEST['cod_tipo_cobro']); } else { $cod_tipo_cobro = '4'; }
    if (isset($_REQUEST['cod_meses_credito'])) { $cod_meses_credito = addslashes($_REQUEST['cod_meses_credito']); } else { $cod_meses_credito = '1'; }

    $sql_tipo_cobro = "SELECT cod_tipo_cobro, nombre_tipo_cobro FROM tbl15_tipo_cobro WHERE (cod_tipo_cobro = '$cod_tipo_cobro')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $nombre_tipo_cobro                           = $datos_tipo_cobro['nombre_tipo_cobro'];
    if ($nombre_tipo_cobro == 'MENSUAL') { $numero_tipo_cobro = 1; } else { $numero_tipo_cobro = 2; }

    $sql_meses_credito = "SELECT * FROM tbl15_meses_credito WHERE (cod_meses_credito = '$cod_meses_credito')";
    $consulta_meses_credito = mysqli_query($conectar, $sql_meses_credito) or die(mysqli_error($conectar));
    $datos_meses_credito = mysqli_fetch_assoc($consulta_meses_credito);

    $codigo_meses_credito                        = $datos_meses_credito['codigo_meses_credito'];
    $nombre_meses_credito                        = $datos_meses_credito['nombre_meses_credito'];

    if ($cod_entidad_crediticia == '0') { $condicion_entidad_crediticia = "WHERE (cod_estado = '1')"; } else { $condicion_entidad_crediticia = "WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia') AND (cod_estado = '1')"; }
    $nombre_compo_interes_ptj                    = 'asesor_interes_ptj';
    $nombre_compo_aval_ptj                       = 'asesor_aval_ptj';

    $cod_seguridad                               = '25'; //CLIENTE 
    $nombre_tipo_tercero_text                    = ucfirst(strtolower('CLIENTE'));
?>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <!--<h2 class="noo-sh-title">Nuestras Categorias</h2>-->
                <div class="single-product-details"><h2>Resultados Simulación del Credito</h2></div>
                <div class="single-product-details"><h2>Nombre del producto: <?php echo $nombre_producto ?></h2></div>
                <div class="single-product-details"><h2>Valor con Descuento: $ <?php echo number_format($valor_credito, 0, ",", ".") ?></h2></div>
            </div>
            <?php
            $sql_producto = "SELECT * FROM tbl15_entidad_crediticia $condicion_entidad_crediticia ORDER BY cod_posicion ASC";
            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                $cod_entidad_crediticia                        = $datos_producto['cod_entidad_crediticia'];
                $nombre_entidad_crediticia                     = $datos_producto['nombre_entidad_crediticia'];
                $meses_max_entidad_crediticia                  = $datos_producto['meses_max_entidad_crediticia'];
                $quicenal_max_entidad_crediticia               = $datos_producto['quicenal_max_entidad_crediticia'];
                $url_entidad_crediticia_imag_min               = $datos_producto['url_entidad_crediticia_imag_min'];
                $url_entidad_crediticia_imag_orig              = $datos_producto['url_entidad_crediticia_imag_orig'];

                if (($meses_max_entidad_crediticia <> '0' && $quicenal_max_entidad_crediticia == '0')) { //CUANDO SEA POR MES Y NO QUINCENAL
                    $nombre_tipo_cobro = 'MENSUAL';
                    $numero_tipo_cobro = 1;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    if ($numero_cuotas > $meses_max_entidad_crediticia) {
                        $numero_cuotas = $meses_max_entidad_crediticia  * $numero_tipo_cobro;
                    } else {
                        $numero_cuotas = $numero_cuotas;
                    }
                } elseif (($meses_max_entidad_crediticia == '0' && $quicenal_max_entidad_crediticia <> '0')) { //CUANDO NO SEA POR MES Y SI QUINCENAL
                    $nombre_tipo_cobro = 'QUINCENAL';
                    $numero_tipo_cobro = 2;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    if ($numero_cuotas > $quicenal_max_entidad_crediticia) {
                        $numero_cuotas = $quicenal_max_entidad_crediticia;
                    } else {
                        $numero_cuotas = $numero_cuotas;
                    }
                } else { //CUANDO SEA POR MES Y QUINCENAL O NINGUNO DE LOS DOS (TIENE PRIORIDAD EL MES)
                    $nombre_tipo_cobro = 'MENSUAL';
                    $numero_tipo_cobro = 1;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                }

                $interes_ptj                                   = $datos_producto[$nombre_compo_interes_ptj];
                $aval_ptj                                      = $datos_producto[$nombre_compo_aval_ptj];
                $total_interes                                 = $valor_credito * ($interes_ptj / 100);
                $total_pagar                                   = $valor_credito + $total_interes;
                //$numero_cuotas                                 = $numero_tipo_cobro * $codigo_meses_credito;
                $cuota_credito                                 = $total_pagar / $numero_cuotas;
            ?>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-thumbnail" src="<?php echo $url_entidad_crediticia_imag_orig ?>" alt="" />
                    <!--<a class="btn hvr-hover" href="../admin/ver_producto_visitante_extnosesion.php?cod_entidad_crediticia=<?php echo $cod_entidad_crediticia ?>"><?php echo $nombre_entidad_crediticia ?></a>-->
                    <hr>
                    <!--<h2 class="footer-company" style="text-align:center; font-size: 18px" class="hvr-hover"><?php echo $nombre_entidad_crediticia ?></h2>-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 18px" class="hvr-hover">Valor aproximado a pagar por cada cuota: $ <?php echo number_format($cuota_credito, 0, ",", ".") ?></th>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center; font-size: 18px" class="hvr-hover"> <?php echo $numero_cuotas ?> Cuotas: <?php echo $nombre_tipo_cobro ?>ES</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center; font-size: 18px" class="hvr-hover"> Cuotas Defect: <?php echo $codigo_meses_credito ?></th>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center;"><a class="btn hvr-hover_modif" href="../admin/reg_siscredito_tercero_cliente_simulador.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>&cod_seguridad=<?php echo $cod_seguridad ?>&valor_credito=<?php echo $valor_credito ?>&cod_entidad_crediticia=<?php echo $cod_entidad_crediticia ?>&cod_tipo_cobro=<?php echo $cod_tipo_cobro ?>&cod_meses_credito=<?php echo $cod_meses_credito ?>">Solicita tu crédito ahora</a></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>