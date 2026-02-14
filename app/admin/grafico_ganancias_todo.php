<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_ganancias.php");
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
            text: 'GANANCIA HISTORICO'
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
'GANANCIA HISTORICO',
            ]
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'GANANCIA',
            data: [
<?php
$sql = "SELECT SUM(total_venta_producto - total_compra_producto) AS ganacia FROM tbl15_venta_producto";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysqli_fetch_array($result)) {
$ganacia = intval($registros["ganacia"]);
?>
<?php echo $ganacia ?>,
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
