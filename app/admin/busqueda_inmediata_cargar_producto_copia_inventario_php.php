<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                                        = addslashes($_POST['buscar']);
$pagina                                        = addslashes($_POST['pagina']);
$nombre_tipo_moneda                            = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                           = addslashes($_POST['nombre_tipo_factura']);
$cod_estado_vacuna                             = addslashes($_POST['cod_estado_vacuna']);
$nombre_tipo_cargue_factura                    = addslashes($_POST['nombre_tipo_cargue_factura']);
$buscar_por                                    = addslashes($_POST['buscar_por']);
$cod_info_producto_copia_inventario            = intval($_POST['cod_info_producto_copia_inventario']);

if($buscar <> NULL) {
if ($buscar_por == 'nombre_producto') {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto_copia_inventario WHERE ((nombre_producto LIKE '$buscar%') AND (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')) ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
} elseif ($buscar_por == 'cod_producto_barra') {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto_copia_inventario WHERE ((cod_producto_barra LIKE '$buscar') AND (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')) ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
} else {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto_copia_inventario WHERE ((nombre_producto LIKE '%$buscar%') OR (cod_producto_barra LIKE '$buscar')) AND (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
}
echo $total_resultados." Resultados para: ".$buscar."<br>";
}
if ($total_resultados <> 0) {
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th>CODIGO</th>
<th>NOMBRE PRODUCTO</th>
<th>PRECIO VENTA</th>
</tr>
<?php
$tab                                = 'tbl15_producto_copia_inventario';
$campo                              = 'cod_producto_copia_inventario';
$tipo                               = 'insertar';
$foco                               = 'busqueda';

while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_producto_copia_inventario      = $matriz_consulta['cod_producto_copia_inventario'];
$cod_producto_barra                 = $matriz_consulta['cod_producto_barra'];
$nombre_producto                    = $matriz_consulta['nombre_producto'];
$precio_compra_producto             = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto              = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto              = $matriz_consulta['precio_venta_producto'];
?>
<td align="Left"><?php echo $cod_producto_barra; ?></td>
<td align="Left"><a href="../admin/reg_cargar_producto_copia_inventario.php?cod_producto_copia_inventario=<?php echo $cod_producto_copia_inventario?>&cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario?>&cod_producto_barra=<?php echo $cod_producto_barra?>&buscar_por=<?php echo $buscar_por?>&nombre_tipo_cargue_factura=<?php echo $nombre_tipo_cargue_factura?>&nombre_tipo_moneda=<?php echo $nombre_tipo_moneda?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&foco=<?php echo $foco?>&cod_estado_vacuna=<?php echo $cod_estado_vacuna?>&pagina=<?php echo $pagina?>" tabindex=3><?php echo $nombre_producto ?></a></td>
<td align="right"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>