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
$sql_infos_empresas = "SELECT cod_estado_marca_global, cod_estado_busqueda_venta_manual_resultado_unico_redirect_global, cod_estado_cod_barra2_global, cod_estado_venta_prod_en_cero_global, modo_venta_por_defecto_global 
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_marca_global                                           = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_busqueda_venta_manual_resultado_unico_redirect_global  = $info_empresa_data['cod_estado_busqueda_venta_manual_resultado_unico_redirect_global'];
$cod_estado_cod_barra2_global                                      = $info_empresa_data['cod_estado_cod_barra2_global'];
$cod_estado_venta_prod_en_cero_global                              = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$modo_venta_por_defecto                                            = $info_empresa_data['modo_venta_por_defecto_global'];
//----------------------------------------------------------------------------------------------------------------//
$buscar                                                            = addslashes($_POST['buscar']);
$pagina                                                            = addslashes($_POST['pagina']);
$nombre_tipo_moneda                                                = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                                               = addslashes($_POST['nombre_tipo_factura']);
$cod_estado_vacuna                                                 = addslashes($_POST['cod_estado_vacuna']);
$tipo_busqueda                                                     = addslashes($_POST['tipo_busqueda']);
$buscar_por                                                        = addslashes($_POST['buscar_por']);
$cuenta                                                            = addslashes($_POST['cuenta']);
$cod_caja_virtual                                                  = addslashes($_POST['cod_caja_virtual']);

$sql_permiso_usuario = "SELECT cod_estado_prod_und_producto,cod_estado_prod_precio_compra_producto, cod_estado_prod_precio_costo_producto, cod_estado_prod_precio_venta_producto, cod_estado_comision_ventatemp 
FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$cod_estado_prod_und_producto                                        = $matriz_permiso_usuario['cod_estado_prod_und_producto'];
$cod_estado_prod_precio_compra_producto                              = $matriz_permiso_usuario['cod_estado_prod_precio_compra_producto'];
$cod_estado_prod_precio_costo_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_costo_producto'];
$cod_estado_prod_precio_venta_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto'];
$cod_estado_comision_ventatemp                                       = $matriz_permiso_usuario['cod_estado_comision_ventatemp'];
//----------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_categoria'])) { $cod_categoria = intval($_GET['cod_categoria']); $condicional_url_categoria = "&cod_categoria=".$cod_categoria; } else { $condicional_url_categoria = ""; }
if ($cod_estado_cod_barra2_global == '1') { $condicional_barra2 = " OR (cod_producto_barra2 LIKE '$buscar')"; } else { $condicional_barra2 = ""; }

$tab                      = 'tbl15_producto';
$campo                    = 'cod_producto';
$tipo                     = 'insertar';
$foco                     = 'busqueda';

if($buscar <> NULL) {
	if ($buscar_por == 'nombre_producto') {
		$mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, cod_marca, comision_ptj 
		FROM tbl15_producto WHERE ((nombre_producto LIKE '$buscar%')) ORDER BY nombre_producto ASC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
		$cod_tipo_cod_barra = 0;
	} elseif ($buscar_por == 'cod_producto_barra') {
		$mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, cod_marca, comision_ptj 
		FROM tbl15_producto WHERE (cod_producto_barra LIKE '$buscar') $condicional_barra2 ORDER BY nombre_producto ASC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
		$cod_tipo_cod_barra = 0;
	} elseif ($buscar_por == 'cod_producto_barra_nombre_producto') {
		$mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, cod_marca, comision_ptj 
		FROM tbl15_producto WHERE (nombre_producto LIKE '$buscar%') OR (cod_producto_barra LIKE '$buscar') $condicional_barra2 ORDER BY nombre_producto ASC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
		$cod_tipo_cod_barra = 0;
	} elseif ($buscar_por == 'cod_producto_barra2') {
		$mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, cod_marca, comision_ptj 
		FROM tbl15_producto WHERE (cod_producto_barra2 LIKE '$buscar') ORDER BY nombre_producto ASC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
		$cod_tipo_cod_barra = 1;
	} else {
		$mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, cod_marca, comision_ptj 
		FROM tbl15_producto WHERE (nombre_producto LIKE '%$buscar%') OR (cod_producto_barra LIKE '$buscar') $condicional_barra2 ORDER BY nombre_producto ASC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
		$cod_tipo_cod_barra = 0;
	}
	if (($total_resultados == '1') && ($cod_estado_busqueda_venta_manual_resultado_unico_redirect_global == '1') && is_numeric($buscar)) {
		$matriz_consulta = mysqli_fetch_assoc($consulta);
		$cod_producto_barra            = $matriz_consulta['cod_producto_barra'];
		$pagina_redirect               = '../admin/reg_venta_temporal_producto_reg.php'."?&cod_producto_barra=".$cod_producto_barra."&buscar_por=".$buscar_por."&nombre_tipo_moneda=".$nombre_tipo_moneda."&nombre_tipo_factura=".$nombre_tipo_factura."&foco=".$foco."&cod_estado_vacuna=".$cod_estado_vacuna."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual.$condicional_url_categoria."&pagina=facturacion_venta_temporal_producto_manual_pos.php";
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
	<?php
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
<?php if ($cod_estado_cod_barra2_global == '1') { ?><th style="text-align:center">BARRA 2</th><?php } ?>
<th style="text-align:left;">NOMBRE PRODUCTO</th>
<?php if ($cod_estado_marca_global == '1') { ?><th style="text-align:center">MARCA</th><?php } ?>
<?php if ($cod_estado_prod_und_producto == '1') { ?><th style="text-align:center;">UND</th><?php } ?>
<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?><th style="text-align:center;">PRECIO COMPRA</th><?php } ?>
<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?><th style="text-align:center;">PRECIO VENTA</th><?php } ?>
<th style="text-align:center;">TIPO PRODUCTO</th>
<?php if ($cod_estado_comision_ventatemp == '1') { ?><th style="text-align:center;">COMISION</th><?php } ?>
</tr>
<?php
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_producto                  = $matriz_consulta['cod_producto'];
	$cod_producto_barra            = $matriz_consulta['cod_producto_barra'];
	$cod_producto_barra2           = $matriz_consulta['cod_producto_barra2'];
	$nombre_producto               = $matriz_consulta['nombre_producto'];
	$und_producto                  = $matriz_consulta['und_producto'];
	$precio_compra_producto        = $matriz_consulta['precio_compra_producto'];
	$precio_venta_producto         = $matriz_consulta['precio_venta_producto'];
	$nombre_tipo_producto          = $matriz_consulta['nombre_tipo_producto'];
	$cod_marca                     = $matriz_consulta['cod_marca'];
	$cod_producto_barra1           = $matriz_consulta['cod_producto_barra'];
	$comision_ptj                  = $matriz_consulta['comision_ptj'];

	$sql_marca = "SELECT cod_marca, nombre_marca FROM tbl15_marca WHERE (cod_marca = '$cod_marca')";
	$query_marca = mysqli_query($conectar, $sql_marca);
	$datos_marca = mysqli_fetch_array($query_marca);

	$nombre_marca                  = $datos_marca['nombre_marca'];

	if ($cod_tipo_cod_barra == '0') { $cod_producto_barra = $cod_producto_barra; } else { $cod_producto_barra = $cod_producto_barra2; }

	if ($cod_estado_venta_prod_en_cero_global == '1') { 
		if ($und_producto > '0') { 
			$condcional_para_habilitar_enlace_venta = 'SI'; 
		} 
		else { 
			$condcional_para_habilitar_enlace_venta = 'NO'; 
		} 
	} 
	else { 
		$condcional_para_habilitar_enlace_venta = 'SI'; 
	}
?>
<td style="text-align:center;"><?php echo $cod_producto_barra1; ?></td>
<?php if ($cod_estado_cod_barra2_global == '1') { ?><td style="text-align:center;"><?php echo $cod_producto_barra2; ?></td><?php } ?>

<?php if ($condcional_para_habilitar_enlace_venta == 'SI') { ?>
<td style="text-align:left;"><a href="../admin/reg_venta_temporal_producto_reg.php?cod_producto_barra=<?php echo $cod_producto_barra?>&buscar_por=<?php echo $buscar_por?>&cod_tipo_cod_barra=<?php echo $cod_tipo_cod_barra?>&nombre_tipo_moneda=<?php echo $nombre_tipo_moneda?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&foco=<?php echo $foco?>&cod_estado_vacuna=<?php echo $cod_estado_vacuna?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto?>&pagina=<?php echo $pagina?>"><?php echo $nombre_producto ?></a></td>
<?php } else { ?>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<?php } ?>

<?php if ($cod_estado_marca_global == '1') { ?><td style="text-align:center"><?php echo $nombre_marca; ?></td><?php } ?>
<?php if ($cod_estado_prod_und_producto == '1') { ?><td style="text-align:center;"><?php echo $und_producto; ?></td><?php } ?>
<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?><td style="text-align:center;"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td><?php } ?>
<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?><td style="text-align:center;"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td><?php } ?>
<td style="text-align:center;"><?php echo $nombre_tipo_producto; ?></td>
<?php if ($cod_estado_comision_ventatemp == '1') { ?><td style="text-align:center;"><?php echo $comision_ptj; ?>%</td><?php } ?>
</tr>
<?php } ?>
</table>
</div>
<?php } else { } ?>
