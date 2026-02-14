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

<!-- Start Cart -->
<?php
if (isset($_REQUEST['precio_venta_producto'])) {

    if (isset($_REQUEST['valor_credito'])) { $valor_credito = addslashes($_REQUEST['valor_credito']); } else { $valor_credito = ''; }
    if (isset($_REQUEST['cod_entidad_crediticia'])) { $cod_entidad_crediticia = addslashes($_REQUEST['cod_entidad_crediticia']); } else { $cod_entidad_crediticia = '0'; }
    if (isset($_REQUEST['cod_tipo_cobro'])) { $cod_tipo_cobro = addslashes($_REQUEST['cod_tipo_cobro']); } else { $cod_tipo_cobro = '0'; }
    if (isset($_REQUEST['cod_meses_credito'])) { $cod_meses_credito = addslashes($_REQUEST['cod_meses_credito']); } else { $cod_meses_credito = '1'; }
    if (isset($_REQUEST['nombre_tipo_origen_simulacion'])) { $nombre_tipo_origen_simulacion = addslashes($_REQUEST['nombre_tipo_origen_simulacion']); } else { $nombre_tipo_origen_simulacion = ''; }
    if (isset($_REQUEST['nombre_producto'])) { $nombre_producto = addslashes($_REQUEST['nombre_producto']); } else { $nombre_producto = ''; }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                               = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    if ($nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL') {
        $cod_producto_codifcryp            = ($_REQUEST['cod_producto_codifcryp']);
        $cod_producto_codif                = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
        $cod_producto                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

        $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
        precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
        cod_categoria, cod_estado FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
        $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
        $datos_producto = mysqli_fetch_assoc($consulta_producto);

        $cod_producto_barra                                           = $datos_producto['cod_producto_barra'];
        $nombre_producto                                              = $datos_producto['nombre_producto'];
        $cod_categoria                                                = $datos_producto['cod_categoria'];
        $precio_venta_producto                                        = $datos_producto['precio_venta_producto'];
        $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    } elseif ($nombre_tipo_origen_simulacion == 'SIMULACION_VALOR_LIBRE') {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = addslashes($_REQUEST['nombre_producto']);
        $cod_categoria                                                = '';
        $precio_venta_producto                                        = intval($_REQUEST['precio_venta_producto']);
        $cod_producto_codifcryp                                       = ''; 
        $cod_producto_codif                                           = ''; 
        $cod_producto                                                 = ''; 
        $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    } else {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = "";
        $cod_categoria                                                = '';
        $precio_venta_producto                                        = 0;
        $cod_producto_codifcryp                                       = ''; 
        $cod_producto_codif                                           = ''; 
        $cod_producto                                                 = ''; 
        $precio_venta_producto_mas_comision_funcionamiento            = 0;
    }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    ?>
    <!-- Start Cart  -->
    <form name="formulario_de_actualizacion" method="POST" action="../admin/simulador_credito_producto_visitante_intern_interes_max_entidad_crediticia_resultado_get.php">
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
                                    <div style="text-align:center;" class="">Nombre del producto * <br><?php echo $nombre_producto ?>
                                        <?php if ($nombre_producto == '') { ?><input type="text" class="form-control" name="nombre_producto" id="nombre_producto" value="<?php echo $nombre_producto ?>" placeholder="" required><?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="text-align:center;" class="">Valor del crédito * <br><?php echo number_format($precio_venta_producto_mas_comision_funcionamiento, 0, ",", ".") ?>
                                        <!--<input type="number" class="form-control" name="valor_credito" id="valor_credito" value="<?php echo $precio_venta_producto_mas_comision_funcionamiento ?>" placeholder="" required>-->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="text-align:center;" class="">Categoria * <br>
                                        <select id="cod_categoria" name="cod_categoria" class="form-control" required>
                                            <?php if (isset($cod_categoria)) { echo ""; } else { echo ""; }
                                            $consulta2_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1')";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo           = $datos2['cod_categoria'];
                                            $nombre           = $datos2['nombre_categoria'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <!--<input type="number" class="form-control" name="valor_credito" id="valor_credito" value="<?php echo $precio_venta_producto_mas_comision_funcionamiento ?>" placeholder="" required>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Simular Credito</div></button>
                                <input type="hidden" class="form-control" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
                                <input type="hidden" class="form-control" name="precio_venta_producto" value="<?php echo $precio_venta_producto ?>">
                                <input type="hidden" class="form-control" name="cod_producto_codifcryp" id="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp ?>">
                                <input type="hidden" class="form-control" name="cod_meses_credito" value="<?php echo $cod_meses_credito ?>">
                                <input type="hidden" class="form-control" name="precio_venta_producto_mas_comision_funcionamiento" value="<?php echo $precio_venta_producto_mas_comision_funcionamiento ?>">
                                <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                                <input type="hidden" name="insertar_datos" value="formulario">                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>