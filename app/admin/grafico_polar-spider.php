<?php
include_once("menu_estadisticas.php");
include ("menu_grafico_extras.php");
?>
<style type="text/css">
#container_grafico_estadistico { height: 400px; min-width: 10%; max-width: 100%; margin: 0 auto; }
</style>

<script type="text/javascript">
$(function () {

    $('#container_grafico_estadistico').highcharts({

        chart: {
            polar: true,
            type: 'line'
        },

        title: {
            text: 'VENTAS MESES POLAR',
            x: -80
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: [
<?php
$sql = "SELECT fecha_mes_venta_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$fecha_mes_venta_producto = $registros["fecha_mes_venta_producto"];
?>
            '<?php echo $fecha_mes_venta_producto ?>',
<?php
}
?>
            ],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },

        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },

        series: [{
            name: 'Total Precio Costo',
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$total_compra_producto = intval($registros["total_compra_producto"]);

echo $total_compra_producto.',';
}
?>
            ],
            pointPlacement: 'on'
        }, {
            name: 'Total Precio Venta',
            data: [
<?php
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$total_venta_producto = intval($registros["total_venta_producto"]);

echo $total_venta_producto.',';
}
?>
            ],
            pointPlacement: 'on'
        }]

    });
});
        </script>
    </head>
    <body>
<script src="../js/highcharts.js"></script>
<script src="../js/highcharts-more.js"></script>
<script src="../js/modules/exporting.js"></script>
<div id="container_grafico_estadistico" style="height: 400px"></div>
	</body>
</html>
