<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_compras_y_ventas.php");
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
            text: '<?php echo utf8_decode("COMPRAS Y VENTAS POR AÑOS")?>'
        },
        subtitle: {
            text: '<?php echo $nombre_emp ?>'
        },
        xAxis: [{
            categories: [
<?php
$sql = "SELECT anyo FROM tbl15_venta_producto GROUP BY anyo ORDER BY anyo ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total = mysqli_num_rows($result);
while ($registros = mysqli_fetch_array($result)) {
$fecha_anyo = $registros["anyo"]
?>
'<?php echo $fecha_anyo ?>',
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
                text: 'Compras',
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
            name: 'TOTAL VENTAS',
            type: 'column',
            yAxis: 1,
            data: [
<?php
$sql = "SELECT SUM(total_venta_producto) AS total_venta FROM tbl15_venta_producto GROUP BY anyo ORDER BY anyo ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysqli_fetch_array($result)) {
$total_venta = intval($registros["total_venta"]);
?>
<?php echo $total_venta ?>,
<?php
}
?>
            ],
            tooltip: {
                valueSuffix: ''
            }

        }, {
            name: 'TOTAL COMPRAS',
            type: 'column',
            yAxis: 1,
            data: [
<?php
$sql = "SELECT SUM(precio_costo_producto*unidades_total) AS total_compra FROM facturas_cargadas_inv GROUP BY anyo ORDER BY anyo ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysqli_fetch_array($result)) {
$total_compra = intval($registros["total_compra"]);
?>
<?php echo $total_compra ?>,
<?php
}
?>
            ],
            tooltip: {
                valueSuffix: ''
            }

        }, ]
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