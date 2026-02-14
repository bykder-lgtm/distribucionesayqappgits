<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_ventas_y_costos.php");
?>
<style type="text/css">
#container_grafico_estadistico { height: 400px; min-width: 10%; max-width: 100%; margin: 0 auto; }
</style>

<script type="text/javascript">
$(function () {
    $('#container_grafico_estadistico').highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'VENTAS Y COSTOS POR DIAS'
        },
        subtitle: {
            text: '<?php echo $nombre_emp ?>'
        },
        xAxis: [{
            categories: [
<?php
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto, fecha_anyo FROM tbl15_venta_producto GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total = mysqli_num_rows($result);
while ($registros = mysqli_fetch_array($result)) {
?>
'<?php echo $registros["fecha_anyo"] ?>',
<?php
}
?>
            ],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Costos',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'Ventas',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
            name: 'TOTAL VENTA',
            type: 'area',
            yAxis: 1,
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
            ],
            tooltip: {
                valueSuffix: ''
            }

        }, {
            name: 'TOTAL COSTO',
            type: 'spline',
            yAxis: 1,
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto FROM tbl15_venta_producto GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysqli_fetch_array($result)) {
$total_compra_producto = intval($registros["total_compra_producto"]);
?>
<?php echo $total_compra_producto ?>,
<?php
}
?>
            ],
            tooltip: {
                valueSuffix: ''
            }
        }]
    });
});
        </script>
    </head>
    <body>
<script src="highcharts.js"></script>
<script src="exporting.js"></script>

<div id="container_grafico_estadistico" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</body>
</html>