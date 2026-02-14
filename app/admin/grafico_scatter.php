<?php
include_once("menu_estadisticas.php");
include ("menu_grafico_extras.php");
?>
<style type="text/css">
#container { height: 400px; min-width: 10%; max-width: 100%; margin: 0 auto; }
</style>

<script type="text/javascript">
$(function () {
    $('#container_grafico_estadistico').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'VENTAS MESES'
        },
        subtitle: {
            text: '<?php echo $nombre_emp ?>'
        },
        xAxis: {
            title: {
                enabled: true,
                text: 'Tiempo (T)'
            },
            startOnTick: true,
            endOnTick: true,
            showLastLabel: true
        },
        yAxis: {
            title: {
                text: 'Pesos ($)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 100,
            y: 70,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
            borderWidth: 1
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x} T, {point.y} $'
                }
            }
        },
        series: [{
            name: 'T.Compra - T.Venta',
            color: 'rgba(223, 83, 83, .5)',
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_venta_producto) AS total_venta_producto, fecha_mes_venta_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$total_compra_producto = intval($registros["total_compra_producto"]);
$total_venta_producto = intval($registros["total_venta_producto"]);
?>
[
<?php
echo $total_compra_producto ?>, <?php echo $total_venta_producto ?>
],
<?php
}
?>
             ]

        }, {
            name: 'P.Costo - P.Venta',
            color: 'rgba(119, 152, 191, .5)',
            data: [
<?php
$sql = "SELECT SUM(precio_costo) AS precio_costo, SUM(precio_venta) AS precio_venta FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$precio_costo = intval($registros["precio_costo"]);
$precio_venta = intval($registros["precio_venta"]);
?>
[
<?php
echo $precio_costo ?>, <?php echo $precio_venta ?>
],
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
<script src="../js/highcharts.js"></script>
<!--<script src="highcharts-3d.js"></script>-->
<script src="../js/modules/exporting.js"></script>
<div id="container_grafico_estadistico" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</body>
</html>
