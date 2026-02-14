<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_ventas_vendedor.php");
?>
<style type="text/css">
${demo.css}
</style>

<script type="text/javascript">
$(function () {
    $('#container_grafico_estadistico').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 5
            }
        },
        title: {
            text: 'VENTAS TOTALES VENDEDORES<br><?php echo $nombre_emp ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Porcentaje',
            data: [
            <?php
            $sql = "SELECT SUM(total_venta_producto) AS total_venta_producto, vendedor FROM tbl15_venta_producto GROUP BY vendedor ORDER BY total_venta_producto DESC";
            $result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
           while ($registros = mysqli_fetch_array($result)) {
$vendedor = strtoupper($registros["vendedor"]);
$total_venta_producto = intval($registros["total_venta_producto"]);
           ?>
['<?php echo $vendedor.'<br> $ '.number_format($total_venta_producto, 0, ",", "."); ?>', <?php echo $total_venta_producto; ?>],
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
<script src="highcharts.js"></script>
<script src="highcharts-3d.js"></script>
<script src="exporting.js"></script>
<div id="container_grafico_estadistico" style="height: 500px"></div>
	</body>
</html>
