<?php
include_once('../conexiones/conexione.php');

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$cod_administrador                  = ($_SESSION['cod_administrador']);
$cod_base_caja                      = ($_SESSION['cod_base_caja']);
$cod_seguridad                      = ($_SESSION['cod_seguridad']);
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                             = addslashes($_POST['buscar']);
$pagina                             = addslashes($_POST['pagina']);
$nombre_tipo_moneda                 = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                = addslashes($_POST['nombre_tipo_factura']);
$cod_estado_vacuna                  = addslashes($_POST['cod_estado_vacuna']);
$tipo_busqueda                      = addslashes($_POST['tipo_busqueda']);
$buscar_por                         = addslashes($_POST['buscar_por']);
$cuenta                             = addslashes($_POST['cuenta']);
$cod_caja_virtual                   = addslashes($_POST['cod_caja_virtual']);

$sql_permiso_usuario = "SELECT cod_estado_prod_und_producto,cod_estado_prod_precio_compra_producto, cod_estado_prod_precio_costo_producto, cod_estado_prod_precio_venta_producto 
FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$cod_estado_prod_und_producto                                        = $matriz_permiso_usuario['cod_estado_prod_und_producto'];
$cod_estado_prod_precio_compra_producto                              = $matriz_permiso_usuario['cod_estado_prod_precio_compra_producto'];
$cod_estado_prod_precio_costo_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_costo_producto'];
$cod_estado_prod_precio_venta_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto'];

if($buscar <> NULL) {
if ($buscar_por == 'nombre_producto') {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE ((nombre_producto LIKE '$buscar%')) ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
} elseif ($buscar_por == 'cod_producto_barra') {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE ((cod_producto_barra LIKE '$buscar')) ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
} elseif ($buscar_por == 'cod_producto_barra_nombre_producto') {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE (nombre_producto LIKE '$buscar%') OR (cod_producto_barra LIKE '$buscar') ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
} else {
$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE (nombre_producto LIKE '%$buscar%') OR (cod_producto_barra LIKE '$buscar') ORDER BY nombre_producto ASC";
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
<th style="text-align:center;">CODIGO</th>
<th style="text-align:left;">NOMBRE PRODUCTO</th>
<?php if ($cod_estado_prod_und_producto == '1') { ?><th style="text-align:center;">UND</th><?php } ?>
<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?><th style="text-align:center;">PRECIO COMPRA</th><?php } ?>
<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?><th style="text-align:center;">PRECIO VENTA</th><?php } ?>
<th style="text-align:center;">TIPO PRODUCTO</th>
</tr>
<?php
$tab                      = 'tbl15_producto';
$campo                    = 'cod_producto';
$tipo                     = 'insertar';
$foco                     = 'busqueda';
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_producto             = $matriz_consulta['cod_producto'];
$cod_producto_barra       = $matriz_consulta['cod_producto_barra'];
$nombre_producto          = $matriz_consulta['nombre_producto'];
$und_producto             = $matriz_consulta['und_producto'];
$precio_compra_producto   = $matriz_consulta['precio_compra_producto'];
$precio_venta_producto    = $matriz_consulta['precio_venta_producto'];
$nombre_tipo_producto     = $matriz_consulta['nombre_tipo_producto'];
?>
<td style="text-align:center;"><?php echo $cod_producto_barra; ?></td>
<td style="text-align:left;"><a href="../admin/actualizar_unidades_producto_inventario.php?cod_producto_barra=<?php echo $cod_producto_barra?>&buscar_por=<?php echo $buscar_por?>&nombre_tipo_moneda=<?php echo $nombre_tipo_moneda?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&foco=<?php echo $foco?>&cod_estado_vacuna=<?php echo $cod_estado_vacuna?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina?>"><?php echo $nombre_producto ?></a></td>
<?php if ($cod_estado_prod_und_producto == '1') { ?><td style="text-align:center;"><?php echo $und_producto; ?></td><?php } ?>
<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?><td style="text-align:center;"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td><?php } ?>
<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?><td style="text-align:center;"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td><?php } ?>
<td style="text-align:center;"><?php echo $nombre_tipo_producto; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } else { } ?>