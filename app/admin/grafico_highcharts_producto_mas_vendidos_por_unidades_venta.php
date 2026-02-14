<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<!--<a class="btn btn-primary" href="#"><h6>Reporte Estadistico productos Mas Vendidos Por Unidades</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET["fecha_ymd_venta_producto_ini"])) {
    $fecha_ymd_venta_producto_ini           = addslashes($_GET["fecha_ymd_venta_producto_ini"]);
    $fecha_ymd_venta_producto_fin           = addslashes($_GET["fecha_ymd_venta_producto_fin"]);
    $total_reg_mostrar                      = intval($_GET["total_reg_mostrar"]);
} else {
    $fecha_ymd_venta_producto_ini           = date("Y-m-d");
    $fecha_ymd_venta_producto_fin           = date("Y-m-d");
    $total_reg_mostrar                      = 10;
}
include ("../admin/menu_graficos_estadisticos.php");
include ("../admin/menu_grafico_ventas_mas_vendidos.php");
?>

<br>

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">MAS VENDIDOS POR UNIDADES</th>
  </tr>
</table>

<form action="" id="" method="GET">
<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:center;">MOSTRAR</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" style="width: 140px;" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" style="width: 140px;" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="total_reg_mostrar" type="number" value="<?php echo $total_reg_mostrar ?>" style="width: 140px;" required/></td>
    <td style="text-align:center;"><input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
  </tr>
</table>
</form>

<?php
if (isset($_GET["fecha_ymd_venta_producto_ini"])) {
    $fecha_ymd_venta_producto_ini           = addslashes($_GET["fecha_ymd_venta_producto_ini"]);
    $fecha_ymd_venta_producto_fin           = addslashes($_GET["fecha_ymd_venta_producto_fin"]);
    $total_reg_mostrar                      = intval($_GET["total_reg_mostrar"]);
?>
    <style type="text/css">
    #container_grafico_estadistico { height: 400px; min-width: 10%; max-width: 100%; margin: 0 auto; }
    </style>

    <script type="text/javascript">
    $(function () {
        $('#container_grafico_estadistico').highcharts({
            chart: {
                type: 'column',
                margin: 100,
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 200
                }
            },
            title: {
                text: 'LOS <?php echo $total_reg_mostrar ?> PRODUCTOS MAS VENDIDOS POR UNIDAD DEL <?php echo date("d-m-Y", strtotime($fecha_ymd_venta_producto_ini)) ?> AL <?php echo date("d-m-Y", strtotime($fecha_ymd_venta_producto_fin)) ?>'
            },
            subtitle: {
                text: '<?php echo $nombre_emp ?>'
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: [
    <?php
    $sql = "SELECT nombre_producto, SUM(und_venta) AS total_und_venta, SUM(total_venta_producto) AS total_venta_producto 
    FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') GROUP BY nombre_producto ORDER BY 2 DESC LIMIT 0, $total_reg_mostrar";
    $result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    while ($registros = mysqli_fetch_array($result)) {
    ?>
        '<?php echo $registros["nombre_producto"] ?>',
    <?php
    }
    ?>
                ]
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            series: [{
                name: 'PRODUCTOS MAS VENDIDOS POR UNIDADES',
                data: [
    <?php
    $sql = "SELECT nombre_producto, SUM(und_venta) AS total_und_venta, SUM(total_venta_producto) AS total_venta_producto 
    FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') GROUP BY nombre_producto ORDER BY 2 DESC LIMIT 0, $total_reg_mostrar";
    $result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    while ($registros = mysqli_fetch_array($result)) {
    $total_und_venta = ($registros["total_und_venta"]);
    ?>
        <?php echo $total_und_venta ?>,
    <?php
    }
    ?>
                ]
            }]
        });
    });
    		</script>
    	</head>
    	<body>
    <script src="../js/highcharts/highcharts.js"></script>
    <!--<script src="highcharts-3d.js"></script>-->
    <!--<script src="../js/highcharts/exporting.js"></script>-->
<?php } ?>

</div>
<!--End Main Content Area-->
</div>

<div id="footerInnerSeparator"></div>
</div>

</div>

<?php if (isset($_GET["fecha_ymd_venta_producto_ini"])) { ?>
    <div id="container_grafico_estadistico" style="height: 500px"></div>

    <br>

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; font-size:13pt;">#</th>
                <th style="text-align:center; font-size:13pt;">PRODUCTO</th>
                <th style="text-align:center; font-size:13pt;">TOTAL UNIDADES</th>
                <th style="text-align:center; font-size:13pt;">TOTAL VENTA</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $contador = 0;

    $sql_total_tipo_factura = "SELECT nombre_producto, SUM(und_venta) AS total_und_venta, SUM(total_venta_producto) AS total_venta_producto 
    FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') GROUP BY nombre_producto ORDER BY 2 DESC LIMIT 0, $total_reg_mostrar";
    $consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
    while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

        $nombre_producto               = $datos_total_tipo_factura['nombre_producto'];
        $total_und_venta               = $datos_total_tipo_factura['total_und_venta'];
        $total_venta_producto          = $datos_total_tipo_factura['total_venta_producto'];
        $contador++;
    ?>
            <tr>
                <td style="text-align:center; font-size:13pt;"><?php echo $contador?></td>
                <td style="text-align:left; font-size:13pt;"><?php echo $nombre_producto?></td>
                <td style="text-align:center; font-size:13pt;"><?php echo number_format($total_und_venta, 0, ",", ".") ?></td>
                <td style="text-align:center; font-size:13pt;"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></td>
            </tr>
    <?php } ?>
        </tbody>
    </table>
<?php } ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>