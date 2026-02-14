<?php
include_once("menu_estadisticas.php");
include ("menu_grafico_extras.php");
?>
<style type="text/css">
#container { height: 400px; min-width: 10%; max-width: 100%; margin: 0 auto; }
</style>

<script type="text/javascript">
$(function () {

    // Give the points a 3D feel by adding a radial gradient
    Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.4,
                cy: 0.3,
                r: 0.5
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.2).get('rgb')]
            ]
        };
    });

    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container_grafico_estadistico',
            margin: 100,
            type: 'scatter',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 30,
                depth: 250,
                viewDistance: 5,

                frame: {
                    bottom: { size: 1, color: 'rgba(0,0,0,0.02)' },
                    back: { size: 1, color: 'rgba(0,0,0,0.04)' },
                    side: { size: 1, color: 'rgba(0,0,0,0.06)' }
                }
            }
        },
        title: {
            text: 'VENTAS MESES 3D'
        },
        subtitle: {
            text: '<?php echo $nombre_emp ?>'
        },
        plotOptions: {
            scatter: {
                width: 100,
                height: 100,
                depth: 10
            }
        },
        yAxis: {
            min: 0,
            max: 100000000,
            title: null
        },
        xAxis: {
            min: 0,
            max: 100000000,
            gridLineWidth: 1
        },
        zAxis: {
            min: 0,
            max: 100000000,
            showFirstLabel: false
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Reading',
            colorByPoint: true,
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_venta_producto) AS total_venta_producto, SUM(precio_compra_producto) AS precio_compra_producto 
FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$total_compra_producto = intval($registros["total_compra_producto"]);
$total_venta_producto = intval($registros["total_venta_producto"]);
$precio_compra_producto = intval($registros["precio_compra_producto"]);
?>
[
<?php
echo $total_compra_producto ?>, <?php echo $total_venta_producto ?>, <?php echo $precio_compra_producto ?>
],
<?php
}
?>
            ]
        }]
    });


    // Add mouse events for rotation
    $(chart.container_grafico_estadistico).bind('mousedown.hc touchstart.hc', function (e) {
        e = chart.pointer.normalize(e);

        var posX = e.pageX,
            posY = e.pageY,
            alpha = chart.options.chart.options3d.alpha,
            beta = chart.options.chart.options3d.beta,
            newAlpha,
            newBeta,
            sensitivity = 5; // lower is more sensitive

        $(document).bind({
            'mousemove.hc touchdrag.hc': function (e) {
                // Run beta
                newBeta = beta + (posX - e.pageX) / sensitivity;
                chart.options.chart.options3d.beta = newBeta;

                // Run alpha
                newAlpha = alpha + (e.pageY - posY) / sensitivity;
                chart.options.chart.options3d.alpha = newAlpha;

                chart.redraw(false);
            },
            'mouseup touchend': function () {
                $(document).unbind('.hc');
            }
        });
    });

});
        </script>
    </head>
    <body>
<script src="../js/highcharts.js"></script>
<script src="../js/highcharts-3d.js"></script>
<script src="../js/modules/exporting.js"></script>
<div id="container_grafico_estadistico" style="height: 400px"></div>
	</body>
</html>
