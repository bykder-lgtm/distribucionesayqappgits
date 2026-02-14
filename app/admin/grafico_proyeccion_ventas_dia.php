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
<a class="btn btn-primary" href="#"><h6>Reporte Inventario</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_ventas.php");
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
            text: 'VENTAS POR MES'
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
$sql = "SELECT fecha_ymd_venta_producto FROM tbl15_venta_producto GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysqli_fetch_array($result)) {
?>
'<?php echo $registros["fecha_ymd_venta_producto"] ?>',
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
            name: 'VENTAS',
            data: [
<?php
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysqli_fetch_array($result)) {
$total_venta_producto = intval($registros["total_venta_producto"]);
?>
<?php echo $total_venta_producto ?>,
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
<script src="../js/highcharts/exporting.js"></script>
<div id="container_grafico_estadistico" style="height: 500px"></div>

</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>