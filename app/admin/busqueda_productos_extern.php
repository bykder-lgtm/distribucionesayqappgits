<?php error_reporting(E_ALL ^ E_NOTICE);?>
<?php require_once('../admin/01_modulo_inicio_sesion_extern.php'); 

$buscar                          = addslashes($_POST['buscar']);

if($buscar <> '') {
?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th style="text-align:center" class="column-title">CODIGO</th>
<th style="text-align:center" class="column-title">NOMBRE</th>
<th style="text-align:center" class="column-title">UND</th>
<th style="text-align:center" class="column-title">PRECIO NORMAL</th>
<th style="text-align:center" class="column-title">PRECIO MINIMO</th>
</tr>
</thead>
<tbody>
<?php
$sql_producto_ciclo = "SELECT * FROM tbl15_producto WHERE ((cod_producto_barra = '$buscar') OR (nombre_producto LIKE '%$buscar%')) ORDER BY nombre_producto ASC";
$consulta_producto_ciclo = mysqli_query($conectar, $sql_producto_ciclo) or die(mysqli_error($conectar));
while ($datos_producto_ciclo = mysqli_fetch_array($consulta_producto_ciclo)) {

$cod_producto_barra               = $datos_producto_ciclo['cod_producto_barra'];
$nombre_producto                  = $datos_producto_ciclo['nombre_producto'];
$und_producto                     = $datos_producto_ciclo['und_producto'];
$precio_venta_producto            = $datos_producto_ciclo['precio_venta_producto'];
$precio_venta_producto2           = $datos_producto_ciclo['precio_venta_producto2'];
$precio_venta_producto3           = $datos_producto_ciclo['precio_venta_producto3'];
$precio_venta_producto4           = $datos_producto_ciclo['precio_venta_producto4'];
?>
<tr class="even pointer">
<th style="text-align:left; font-size:12pt"><?php echo $cod_producto_barra ?></th>
<th style="text-align:left; font-size:12pt"><?php echo $nombre_producto ?></th>
<th style="text-align:center; font-size:12pt"><?php echo $und_producto ?></th>
<th style="text-align:right; font-size:15pt"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></th>
<th style="text-align:right; font-size:15pt; color:#FF0000"><?php echo number_format($precio_venta_producto3, 0, ",", ".") ?></th>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { } ?>