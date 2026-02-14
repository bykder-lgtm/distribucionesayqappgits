<?php
$nombre_pagina          = "Detalle del producto";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_inicio_sesion_extern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title>Consultar Productos</title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="">
<meta name="description"               content="">
<meta name="author"                    content="">
<meta property="og:url"                content="">
<meta property="og:type"               content="website" />
<meta property="og:title"              content="">
<meta property="og:description"        content="">
<meta property="og:image"              content="">
<meta property="og:site_name"          content="">
<meta property="fb:admins"             content="">
<meta name="twitter:card"              content="">
<meta name="twitter:url"               content="">
<meta name="twitter:title"             content="">
<meta name="twitter:description"       content="">
<meta name="twitter:image"             content="">

<?php include_once("../admin/03_modulo_css_extern.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize.css">
</head>

<body>
    <!-- End Main Top -->
<?php include_once("04_modulo_main_top_extern.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../menu/05_modulo_menu_visitante_extern.php"); ?>
    <!-- End Main Top -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">

<script type="text/javascript" src="inmediata_busqueda_productos_extern.js"></script>

                    <ul>
                        <li>
                            <div class="form-group size-st">
                            

                                <form action="" method="GET" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                    <select name="nombre_tipo_busqueda" id="basic" class="selectpicker show-tick form-control">
                                        <?php if (isset($nombre_tipo_busqueda)) { echo ""; } else { echo ""; }
                                        $sql_consulta2 = "SELECT * FROM tbl15_tipo_busqueda ORDER BY cod_tipo_busqueda DESC";
                                        $consulta2 = mysqli_query($conectar, $sql_consulta2);
                                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                        if(isset($nombre_tipo_busqueda) and $nombre_tipo_busqueda == $datos2['nombre_tipo_busqueda']) {
                                        $seleccionado = "selected";
                                        } else { $seleccionado = ""; }
                                        $codigo = $datos2['nombre_tipo_busqueda'];
                                        $nombre = $datos2['titulo_tipo_busqueda'];
                                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                    </select>
                                    <input type="text" name="busqueda" id="busqueda" class="form-control" value="" onkeyup="hacer_busqueda()" required autofocus>
                                    <!-- <button class="btn hvr-hover"  type="submit">Buscar Producto</button> -->
                                    <input name="verificador" class="form-control" value="1" type="hidden">
                                </form>
                            </div>
                        </li>
                    </ul>

<?php 
if (isset($_REQUEST['busqueda'])) { 
   $buscar = addslashes($_REQUEST['busqueda']);
?>
    <table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
    <th style="text-align:center" class="column-title">CODIGO</th>
    <th style="text-align:center" class="column-title">NOMBRE</th>
    <th style="text-align:center" class="column-title">UND</th>
    <th style="text-align:center" class="column-title">PRECIO NORMAL</th>
    <th style="text-align:center" class="column-title">PRECIO MINIMO</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql_producto_ciclo = "SELECT * FROM tbl15_producto WHERE ((cod_producto_barra = '$buscar') OR (nombre_producto LIKE '%$buscar%')) ORDER BY nombre_producto ASC";
    $consulta_producto_ciclo = mysqli_query($conectar, $sql_producto_ciclo) or die(mysqli_error($conectar));
    while ($datos_producto_ciclo = mysqli_fetch_array($consulta_producto_ciclo)) {

    $cod_producto_barra               = $datos_producto_ciclo['cod_producto_barra'];
    $nombre_producto                  = $datos_producto_ciclo['nombre_producto'];
    $und_producto                     = $datos_producto_ciclo['und_producto'];
    $precio_venta_producto            = $datos_producto_ciclo['precio_venta_producto'];
    $precio_venta_producto2           = $datos_producto_ciclo['precio_venta_producto2'];
    $precio_venta_producto3           = $datos_producto_ciclo['precio_venta_producto3'];
    $precio_venta_producto4           = $datos_producto_ciclo['precio_venta_producto4'];
    ?>
    <tr class="even pointer">
    <th style="text-align:left; font-size:12pt"><?php echo $cod_producto_barra ?></th>
    <th style="text-align:left; font-size:12pt"><?php echo $nombre_producto ?></th>
    <th style="text-align:center; font-size:12pt"><?php echo $und_producto ?></th>
    <th style="text-align:right; font-size:15pt"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></th>
    <th style="text-align:right; font-size:15pt; color:#FF0000"><?php echo number_format($precio_venta_producto3, 0, ",", ".") ?></th>
    </tr>
    <?php } ?>
    </tbody>
    </table>
<?php } else { ?>
    <div id="logo_cargador"></div>
<?php } ?>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="single-product-details">
                        <ul>
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">

                            <?php
                            $conteo = 0;
                            $sql_producto = "SELECT * FROM tbl15_patrocinador ORDER BY RAND()";
                            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
                            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                            $conteo++;
                            $url_imagen                       = $datos_producto['url_imagen'];

                            if ($conteo==1) { $estado_active = "active"; } else { $estado_active = ""; }
                            ?>
                            <div class="carousel-item <?php echo $estado_active ?>"><img class="d-block w-100" src="<?php echo $url_imagen ?>" alt=""></div>
                            <?php } ?>  

                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i><span class="sr-only">Previous</span></a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i><span class="sr-only">Next</span></a>
                    </div>
                        </ul>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!-- End Cart -->
    <!-- End Shop Page -->
<?php include_once("../admin/09_modulo_footer.php"); ?>

<?php include_once("../admin/10_modulo_js_extern.php"); ?>

</body>

</html>