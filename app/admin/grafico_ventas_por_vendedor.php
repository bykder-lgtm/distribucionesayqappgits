<?php
require_once("menu_estadisticas.php");
?>
<br>
<center>
<form method="GET" name="formulario" action="">
<table align="center">
<td nowrap align="right">VENDEDORES:</td>
<td bordercolor="0">
<select name="vendedor" id="vendedor">
<?php $sql_consulta1="SELECT DISTINCT vendedor FROM tbl15_venta_producto ORDER BY vendedor DESC";
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
echo "<center><td><font size='+3' color='yellow'>VENTAS: $vendedor</font><td><center>";
?>
<!-- Latest compiled and minified JavaScript -->
<script src="jquery.js"></script>
<!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="highstock.js"></script>
<script src="exporting.js"></script>
<center>
<table>
<?php
function conectarBD(){
$server = "localhost";
$usuario = "pinsalud";
$pass = "836db8837d23c4c49cfec04ebc2a950f";
$BD = "pinsalud";
//variable que guarda la conexión de la base de datos
$conexion = mysqli_connect($server, $usuario, $pass, $BD);
//Comprobamos si la conexión ha tenido exito
if(!$conexion){
echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>';
}
//devolvemos el objeto de conexión para usarlo en las consultas  
return $conexion;
}  
/*Desconectar la conexion a la base de datos*/
function desconectarBD($conexion){
//Cierra la conexión y guarda el estado de la operación en una variable
$close = mysqli_close($conexion);
//Comprobamos si se ha cerrado la conexión correctamente
if(!$close){  
echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
}    
//devuelve el estado del cierre de conexión
return $close;        
}
 //Devuelve un array multidimensional con el resultado de la consulta
function getArraySQL($sql){
//Creamos la conexión
$conexion = conectarBD();
//generamos la consulta
if(!$result = mysqli_query($conexion, $sql)) die(); 
$vector_de_datos = array();
//guardamos en un array multidimensional todos los datos de la consulta
$i=0;
while($matriz = mysqli_fetch_array($result)) {  
//guardamos en vector_de_datos todos los vectores/filas que nos devuelve la consulta
$vector_de_datos[$i] = $matriz;
$i++;
}
//Cerramos la base de datos
desconectarBD($conexion);
//devolvemos vector_de_datos
return $vector_de_datos;
}
//Sentencia SQL
$sql = "SELECT SUM(total_venta_producto) AS total_venta_producto, vendedor, fecha_ymd_venta_producto FROM tbl15_venta_producto WHERE vendedor = '$vendedor' GROUP BY fecha_ymd_venta_producto ORDER BY fecha_ymd_venta_producto ASC";
//Array Multidimensional
$vector_de_datos = getArraySQL($sql);
//Adaptar el tiempo
for($i=0;$i<count($vector_de_datos);$i++){
//$time = $vector_de_datos[$i]["fecha_invert"];
$time = date("Y/m/d", $vector_de_datos[$i]["fecha_ymd_venta_producto"]);
$vend = $vector_de_datos[$i]["vendedor"];
$date = new DateTime($time);
$vector_de_datos[$i]["fecha_ymd_venta_producto"]=$date->getTimestamp()*1000;
}
?> 
<HTML>
<BODY>
<meta charset="utf-8">
<div id="container"></div>
<script type='text/javascript'>
$(function () {
$(document).ready(function() {
Highcharts.setOptions({
global: {
useUTC: false
}
});
var chart;
$('#container').highcharts({
chart: {
type: 'area',
animation: Highcharts.svg, // don't animate in old IE
marginRight: 10,
events: {
load: function() {
}
}
},
title: {
text: "Grafica de ventas por vendedor <?php $vendedor?>"
},
xAxis: {
type: 'datetime',
tickPixelInterval: 150
},
yAxis: {
title: {
text: 'Valores en pesos'
},
plotLines: [{
value: 0,
width: 1,
color: '#808080'
}]
},
tooltip: {
formatter: function() {
return '<b>'+ this.series.name +'</b><br/>'+ Highcharts.dateFormat('%d/%m/%Y', this.x) +'<br/><b>$'+ Highcharts.numberFormat(this.y, 0)+'</b>';
//Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+ Highcharts.numberFormat(this.y, 0);
}
},
legend: {
enabled: true
},
exporting: {
enabled: true
},
series: [{
name: 'Ventas',
data: (function() {
var data = [];
<?php
for($i = 0 ;$i<count($vector_de_datos);$i++){
?>
data.push([<?php echo $vector_de_datos[$i]["fecha_ymd_venta_producto"];?>,<?php echo $vector_de_datos[$i]["total_venta_producto"];?>]);
<?php } ?>
return data;
})()
},{            
}]
});
});  
});
</script>
</html>
</table>
</fieldset>
</center>
<?php
}
?>