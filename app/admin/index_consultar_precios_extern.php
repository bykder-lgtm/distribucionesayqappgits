<?php
$nombre_pagina          = "Tienda Online";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_ext_index.php"); ?>
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

<script>
window.onload = function() {
    $("#cod_producto_barra").focus();
    //document.getElementById("cod_producto_barra").focus();
}
</script>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->

<?php if (isset($_GET['cod_producto_barra'])) { $buscador_get = addslashes($_GET['cod_producto_barra']); } else { $buscador_get = ''; } ?>

<?php include_once("../menu/05_modulo_menu_visitante_ext_index.php"); ?>


    <div class="shop-detail-box-mai">
    <!--<div class="shop-detail-box-main">-->
        <!--<div class="container">-->
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="search-product">
                            <form action="" method="GET">
                                <input type="text" name="cod_producto_barra" id="cod_producto_barra" value="" class="form-control" required>
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>

                        <?php
                        if (isset($_GET['cod_producto_barra'])) {
                            $cod_producto_barra                = addslashes($_GET['cod_producto_barra']);

                            $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
                            precio_venta_producto4 FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
                            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                            $datos_producto = mysqli_fetch_assoc($consulta_producto);

                            $cod_producto                      = $datos_producto['cod_producto'];
                            $cod_producto_codif                = DAXCODIFCRYPTOR::encodifdax($cod_producto);
                            $cod_producto_codifcryp            = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);

                            $nombre_producto                   = $datos_producto['nombre_producto'];
                            $und_producto                      = $datos_producto['und_producto'];
                            $precio_venta_producto             = $datos_producto['precio_venta_producto'];
                            $precio_venta_producto2            = $datos_producto['precio_venta_producto2'];
                            $precio_venta_producto3            = $datos_producto['precio_venta_producto3'];
                            $precio_venta_producto4            = $datos_producto['precio_venta_producto4'];
                        ?>
                <div id="info_producto_consulta" class="col-xl-8 col-lg-8 col-md-8">
                    <div class="single-product-details">
                        <h1 style="text-align:left; font-size:40px;">Nombre: <a><?php echo ($nombre_producto) ?></a></h1>
                    </div>
                    <div class="single-product-details">
                        <h1 style="text-align:left; font-size:50px; color:red;">Precio Venta: <?php echo number_format($precio_venta_producto, 0, ",", ".") ?></h1>
                    </div>
                    <div class="single-product-details">
                        <h3>Codigo: <?php echo $cod_producto_barra ?></h3>
                    </div>
                </div>
                        <?php } ?>

                </div>

                <div class="col-xl-8 col-lg-8 col-md-8">
        <!-- Start Slider -->
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $conteo = 0;
                            $sql_producto = "SELECT * FROM tbl15_publicidad WHERE (cod_estado = '1') ORDER BY cod_posicion ASC";
                            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                                $conteo++;
                                $cod_publicidad                    = $datos_producto['cod_publicidad'];
                                $cod_publicidad_codif              = DAXCODIFCRYPTOR::encodifdax($cod_publicidad);
                                $cod_publicidad_codifcryp          = DAXCODIFCRYPTOR::encriptardax($cod_publicidad_codif);

                                $nombre_publicidad                 = $datos_producto['nombre_publicidad'];
                                $descripcion_publicidad            = $datos_producto['descripcion_publicidad'];
                                $url_imagen                        = $datos_producto['url_imagen'];
                                $url_imagen_min                    = $datos_producto['url_imagen_min'];
                                $alineacion_texto_publicidad       = $datos_producto['alineacion_texto_publicidad'];
                                $cod_estado                        = $datos_producto['cod_estado'];

                                if ($conteo==1) { $estado_active = "active"; } else { $estado_active = ""; }
                            ?>
                            <div class="carousel-item <?php echo $estado_active ?>"><img class="d-block w-100" src="<?php echo $url_imagen ?>" alt=""></div>
                            <?php } ?>  
                        </div>
                        <!--
                            <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i><span class="sr-only">Previous</span></a>
                            <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i><span class="sr-only">Next</span></a>
                        -->
                    </div>
        <!-- End Slider -->
                </div>

            </div>

        <!--</div>-->
    </div>






<?php include_once("../admin/09_modulo_footer_visitante_ext.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_ext_index.php"); ?>

</body>

</html>

<script language="javascript">
setInterval("refrescar_pagina_ajax()",10000);

function refrescar_pagina_ajax(){
    //window.location.replace("../admin/index_consultar_precios_extern.php");
    //window.location.reload("../admin/index_consultar_precios_extern.php", true);
    document.getElementById('info_producto_consulta').innerHTML = '';
}
</script>
