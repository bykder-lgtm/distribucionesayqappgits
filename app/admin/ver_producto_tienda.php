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
<?php $pagina = addslashes($_GET['pagina']); ?>
<?php
$cod_tienda                            = intval($_GET['cod_tienda']);

$mostrar_datos_sql = "SELECT nombre_tienda FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_tienda                         = $matriz_consulta['nombre_tienda'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>PRODDUCTOS TIENDA: <?php echo $nombre_tienda ?></h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
if (isset($_GET['cod_tienda'])) {
    $cod_tienda = intval($_GET['cod_tienda']);
?>
    <table border="1" class="table table-responsive">
    	<thead>
    		<tr>
                <th style="text-align:center">#</th>
    			<th style="text-align:center">COD</th>
                <th style="text-align:center">NOMBRE</th>
                <th style="text-align:center">PRECIO</th>
    			<th style="text-align:center">TIENDA</th>
                <th style="text-align:center">ID</th>
    		</tr>
    	</thead>
        <tbody>
        <?php
        $contador = 0;
        $mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto FROM tbl15_producto WHERE (cod_tienda = '$cod_tienda')";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

            $cod_producto                          = $matriz_consulta['cod_producto'];
            $cod_producto_barra                    = $matriz_consulta['cod_producto_barra'];
            $nombre_producto                       = $matriz_consulta['nombre_producto'];
            $precio_venta_producto                 = $matriz_consulta['precio_venta_producto'];
            $contador++;
        ?>
        	<tr>
                <td style="text-align:center"><?php echo $contador ?></td>
                <td style="text-align:center"><?php echo $cod_producto_barra ?></td>
                <td style="text-align:left"><?php echo $nombre_producto ?></td>
                <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
                <td style="text-align:center"><?php echo $nombre_tienda ?></td>
                <td style="text-align:center"><?php echo $cod_producto ?></td>
        	</tr>
        <?php } ?>
        </tbody>
    </table>
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