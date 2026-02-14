<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="#"><h4></a>
</div>
-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_producto_barra_get'])) {
    //$cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
    $foco                                 = addslashes($_GET['foco']);
    $buscar_por                           = addslashes($_GET['buscar_por']);
    $cuenta                               = addslashes($_GET['cuenta']);
    $cod_caja_virtual                     = addslashes($_GET['cod_caja_virtual']);
    $modo_venta_por_defecto               = addslashes($_GET['modo_venta_por_defecto']);
    $pagina_get                           = addslashes($_GET['pagina']);
    $cod_producto_barra_get               = addslashes($_GET['cod_producto_barra_get']);
    $und_producto                         = addslashes($_GET['und_producto']);
    $und_venta_producto_temporal          = addslashes($_GET['und_venta_producto_temporal']);
    $und_producto_disponible_proyeccion   = addslashes($_GET['und_producto_disponible_proyeccion']);

    $pagina_local                         = $_SERVER['PHP_SELF'];
    $paginar_edirect                      = $pagina_get."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&modo_venta_por_defecto=".$modo_venta_por_defecto."&pagina=".$pagina_get;
    //---------------------------------------------------------------------------------------------------------------------------------------------//
    if (($cod_estado_cod_barra2_global == '1') && ($buscar_por == 'cod_producto_barra')) {
        $campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."') OR (cod_producto_barra2 = '".$cod_producto_barra_get."')";
    } elseif (($cod_estado_cod_barra2_global == '1') && ($buscar_por == 'cod_producto_barra2')) {
        $campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."') OR (cod_producto_barra2 = '".$cod_producto_barra_get."')";
    } else {
        $campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."')";
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto FROM tbl15_producto WHERE $campo_busqueda";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $existe_producto = mysqli_num_rows($consulta_producto);
    $datos_producto = mysqli_fetch_assoc($consulta_producto);

    $cod_producto                       = $datos_producto['cod_producto'];
    $cod_producto_barra                 = $datos_producto['cod_producto_barra'];
    $nombre_producto                    = $datos_producto['nombre_producto'];

    if ($und_producto <= '0') {
    ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th style="text-align:center"><a href="<?php echo $paginar_edirect?>"><h3>Regresar</h3></a></th>
                </tr>
                <tr>
                    <th style="text-align:center"><h4><img src=../imagenes/advertencia.gif alt='Advertencia'>EL PRODUCTO NO TIENE UNIDADES DISPONIBLES PARA VENDER<img src=../imagenes/advertencia.gif alt='Advertencia'></h4></th>
                </tr>
                <tr>
                    <th style="text-align:center"><h4><?php echo $nombre_producto.' | '.$cod_producto_barra ?></h4></th>
                </tr>
            </table>
        </div>
    <?php } elseif ($und_producto_disponible_proyeccion <= '0') { ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th style="text-align:center"><a href="<?php echo $paginar_edirect?>"><h3>Regresar</h3></a></th>
                </tr>
                <tr>
                    <th style="text-align:center"><h4><img src=../imagenes/advertencia.gif alt='Advertencia'>EL PRODUCTO TIENE TODAS UNIDADES DISPONIBLES EN USO<img src=../imagenes/advertencia.gif alt='Advertencia'></h4></th>
                </tr>
            </table>

            <table class="table table-striped">
                <tr>
                    <th style="text-align:center;">CODIGO</th>
                    <th style="text-align:center;">NOMBRE CONCEPTO</th>
                    <th style="text-align:center;">CANTIDAD</th>
                    <th style="text-align:center;">PRECIO VENTA UNITARIO</th>
                    <th style="text-align:center;">PRECIO VENTA TOTAL</th>
                    <th style="text-align:center;">VENDEDOR</th>
                    <th style="text-align:center;">CAJA</th>
                    <th style="text-align:center;">ID</th>
                </tr>
<?php
        $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_producto_barra = '$cod_producto_barra_get') ORDER BY cod_venta_producto_temporal DESC";
        $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
        while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

            $cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
            $cod_producto                      = $datos_venta_producto_temporal['cod_producto'];
            $cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
            $nombre_producto                   = $datos_venta_producto_temporal['nombre_producto'];
            $cedula                            = $datos_venta_producto_temporal['cedula'];
            $nombre_cliente                    = $datos_venta_producto_temporal['nombre_cliente'];
            $und_venta                         = $datos_venta_producto_temporal['und_venta'];
            $precio_costo_producto             = $datos_venta_producto_temporal['precio_costo_producto'];
            $precio_compra_producto            = $datos_venta_producto_temporal['precio_compra_producto'];
            $total_costo_producto              = $datos_venta_producto_temporal['total_costo_producto'];
            $precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
            $total_venta_producto              = $datos_venta_producto_temporal['total_venta_producto'];
            $cuenta                            = $datos_venta_producto_temporal['cuenta'];
            $cod_base_caja                     = $datos_venta_producto_temporal['cod_base_caja'];
?>
                <tr>
                    <td style="text-align:center;"><?php echo $cod_producto_barra?></td>
                    <td style="text-align:left;"><?php echo $nombre_producto?></td>
                    <td style="text-align:center;"><?php echo $und_venta?></td>
                    <td style="text-align:center;"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
                    <td style="text-align:center;"><?php echo number_format($total_venta_producto, 0, ",", ".")?></td>
                    <td style="text-align:center;"><?php echo $cuenta?></td>
                    <td style="text-align:center;"><?php echo $cod_base_caja?></td>
                    <td style="text-align:center;"><?php echo $cod_venta_producto_temporal?></td>
                </tr>
<?php } ?>
            </table>

            <table class="table table-striped">
                <tr>
                    <th style="text-align:center">UNIDADES DISPONIBLES</th>
                    <th style="text-align:center">UNIDADES EN USO</th>
                </tr>
                <tr>
                    <th style="text-align:center"><?php echo $und_producto?></th>
                    <th style="text-align:center"><?php echo $und_venta_producto_temporal?></th>
                </tr>
            </table>
        </div>
    <?php } else { ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th style="text-align:center"><a href="<?php echo $paginar_edirect?>"><h3>Regresar</h3></a></th>
                </tr>
                <tr>
                    <th style="text-align:center"><h4><img src=../imagenes/advertencia.gif alt='Advertencia'>EL PRODUCTO NO TIENE UNIDADES DISPONIBLES PARA VENDER<img src=../imagenes/advertencia.gif alt='Advertencia'></h4></th>
                </tr>
                <tr>
                    <th style="text-align:center"><h4><?php echo $nombre_producto.' | '.$cod_producto_barra ?></h4></th>
                </tr>
            </table>
        </div>
    <?php } ?>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>