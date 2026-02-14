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
        xAxis: {
            min: -0.5,
            max: 50
        },
        yAxis: {
            min: 0
        },
        title: {
            text: 'VENTAS MESES REGRESION'
        },
        series: [{
            type: 'line',
            name: 'Line de Regresion',
            data: [[0, 0], [160000, 160000]],
            marker: {
                enabled: false
            },
            states: {
                hover: {
                    lineWidth: 0
                }
            },
            enableMouseTracking: false
        }, {
            type: 'scatter',
            name: 'Datos',
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$total_compra_producto = intval($registros["total_compra_producto"]);
?>
<?php
echo $total_compra_producto ?>, 
<?php
}
?>
            ],
            marker: {
                radius: 4
            }
        }]
    });
});
        </script>
    </head>
    <body>
<script src="../js/highcharts.js"></script>
<script src="../js/modules/exporting.js"></script>
<div id="container_grafico_estadistico" style="height: 400px"></div>
	</body>
</html>
