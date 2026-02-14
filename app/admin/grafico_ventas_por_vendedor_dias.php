<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_ventas_vendedor.php");
?>
<!DOCTYPE HTML>
<html>
<center>
<form method="GET" name="formulario" action="">
<table align="center">
<td nowrap align="right">VENDEDORES:</td>
<td bordercolor="0">
<select name="vendedor">
<?php $sql_consulta1="SELECT DISTINCT vendedor FROM tbl15_venta_producto ORDER BY vendedor";
$resultado = mysqli_query($sql_consulta1, $conectar) or die(mysql_error());
while ($contenedor=mysql_fetch_array($resultado)) {?>
<option value="<?php echo $contenedor['vendedor'] ?>"><?php echo $contenedor['vendedor'] ?></option>
<?php }?>
</select></td></td>
<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td bordercolor="1"><input type="submit" id="boton1" value="Consultar Ventas"></td>
</tr>
</table>
</form>
</center>
<?php
if (isset($_GET['vendedor'])) {
$vendedor = $_GET['vendedor'];
?>
<fieldset>
<?php
//echo "<center><td><font size='+3' color='yellow'>VENTAS DIAS: $vendedor</font><td><center>";
?>
<style type="text/css">
#container {
    height: 400px; 
    min-width: 100%; 
    max-width: 100%;
    margin: 0 auto;
}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'area',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 0,
                depth: 100
            }
        },
        title: {
            text: 'VENTAS POR DIA - <?php echo $vendedor?>'
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
<?php
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto, fecha_anyo FROM tbl15_venta_producto WHERE vendedor = '$vendedor' GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysql_fetch_array($result)) {
?>
'<?php echo $registros["fecha_anyo"] ?>',
<?php
}
?>
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
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto WHERE vendedor = '$vendedor' GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
$result = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($registros = mysql_fetch_array($result)) {
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
<div id="container" style="height: 400px"></div>
	</body>
<?php
} else {
}
?>
</html>
