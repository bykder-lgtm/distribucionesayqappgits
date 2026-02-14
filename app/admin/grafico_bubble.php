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
            type: 'bubble',
            zoomType: 'xy'
        },

        title: {
            text: 'VENTAS MESES PRECIOS'
        },

        series: [{
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_venta_producto) AS total_venta_producto, SUM(precio_venta_producto) AS precio_venta_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$total_compra_producto = intval($registros["total_compra_producto"]);
$total_venta_producto = intval($registros["total_venta_producto"]);
$precio_venta_producto = intval($registros["precio_venta_producto"]);
?>
[
<?php
echo $total_compra_producto ?>, <?php echo $total_venta_producto ?>, <?php echo $precio_venta_producto ?>
],
<?php
}
?>
            ]
        }, {
            data: [
<?php
$sql = "SELECT SUM(precio_costo_producto) AS precio_costo_producto, SUM(precio_venta_producto) AS precio_venta_producto, SUM(precio_compra_producto) AS precio_compra_producto FROM tbl15_venta_producto GROUP BY fecha_mes_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($sql, $conectar);
while ($registros = mysqli_fetch_array($result)) {

$precio_costo_producto = intval($registros["precio_costo_producto"]);
$precio_venta_producto = intval($registros["precio_venta_producto"]);
$precio_compra_producto = intval($registros["precio_compra_producto"]);
?>
[
<?php
echo $precio_costo_producto ?>, <?php echo $precio_venta_producto ?>, <?php echo $precio_compra_producto ?>
],
<?php
}
?>
            ]
        }, {
            data: [
<?php
$sql = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_venta_producto) AS total_venta_producto, SUM(precio_compra_producto) AS precio_compra_producto FROM facturas_cargadas_inv GROUP BY anyo ORDER BY anyo ASC";
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
