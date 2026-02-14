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
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 0,
                depth: 100
            }
        },
        title: {
            text: 'VENTAS HISTORICO'
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
'VENTAS HISTORICO',
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
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto";
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

<script src="highcharts.js"></script>
<script src="highcharts-3d.js"></script>
<script src="exporting.js"></script>
<div id="container_grafico_estadistico" style="height: 400px"></div>
	</body>
</html>
