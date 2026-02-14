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
include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_alerta_fecha_nac_global                          = $info_empresa_data['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                 = $info_empresa_data['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                             = $info_empresa_data['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                          = $info_empresa_data['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                       = $info_empresa_data['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                      = $info_empresa_data['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                 = $info_empresa_data['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                               = $info_empresa_data['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                     = $info_empresa_data['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                    = $info_empresa_data['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                  = $info_empresa_data['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                    = $info_empresa_data['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                = $info_empresa_data['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                    = $info_empresa_data['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                   = $info_empresa_data['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                               = $info_empresa_data['costo_parqueo'];
$nombre_tipo_cobro_hotel                                     = $info_empresa_data['nombre_tipo_cobro_hotel'];
$costo_hotel                                                 = $info_empresa_data['costo_hotel'];
$cod_estado_parqueo_hotel_global                             = $info_empresa_data['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                     = $info_empresa_data['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                   = $info_empresa_data['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                     = $info_empresa_data['cod_estado_plan_accion_correcion_global'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global  = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                 = $info_empresa_data['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global      = $info_empresa_data['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global              = $info_empresa_data['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global             = $info_empresa_data['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global             = $info_empresa_data['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global        = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                 = $info_empresa_data['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global         = $info_empresa_data['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global           = $info_empresa_data['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global              = $info_empresa_data['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                    = $info_empresa_data['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                               = $info_empresa_data['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                 = $info_empresa_data['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                            = $info_empresa_data['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                     = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_proveedor_global                                 = $info_empresa_data['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                           = $info_empresa_data['cod_estado_archivo_adjunto_global'];
//----------------------------------------------------------------------------------------------------------------//
$buscar                             = addslashes($_POST['buscar']);
$pagina                             = addslashes($_POST['pagina']);

$tab                                = 'tbl15_producto';
$campo                              = 'cod_producto';
$tipo                               = 'insertar';
$foco                               = 'busqueda';

if($buscar <> NULL) {
	$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE (cod_estado_destacado = '0') AND (cod_producto_barra LIKE '$buscar') OR (nombre_producto LIKE '%$buscar%') ORDER BY nombre_producto ASC";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$total_resultados = mysqli_num_rows($consulta);

	echo $total_resultados." Resultados para: ".$buscar."<br>";
}
if ($total_resultados <> 0) {
?>
	<br>
	<table class="table table-striped">
		<tr>
		    <th style="text-align:center" class="column-title">Codigo</th>
		    <th style="text-align:center" class="column-title">Nombre Producto</th>

		    <?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
		    <th style="text-align:center" class="column-title">Precio Compra</th>
		    <?php } ?>

		    <?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
		    <th style="text-align:center" class="column-title">Precio Venta</th>
		    <?php } ?>
		</tr>
	<?php
	while ($datos_consulta = mysqli_fetch_assoc($consulta)) {

	    $cod_producto              = $datos_consulta['cod_producto'];
	    $cod_producto_barra        = $datos_consulta['cod_producto_barra'];
	    $nombre_producto           = $datos_consulta['nombre_producto'];
	    $und_producto              = $datos_consulta['und_producto'];
	    $precio_costo_producto     = $datos_consulta['precio_costo_producto'];
	    $precio_compra_producto    = $datos_consulta['precio_compra_producto'];
	    $precio_venta_producto     = $datos_consulta['precio_venta_producto'];
	    $nombre_tipo_producto      = $datos_consulta['nombre_tipo_producto'];
	    $nombre_tipo_unidad_medida = $datos_consulta['nombre_tipo_unidad_medida'];
	    $posologia_cantidad        = $datos_consulta['posologia_cantidad'];
	    $posologia_peso            = $datos_consulta['posologia_peso'];
	    $nombre_tipo_presentacion  = $datos_consulta['nombre_tipo_presentacion'];
	    $nombre_via_administracion = $datos_consulta['nombre_via_administracion'];
	    $nombre_frec_duracion      = $datos_consulta['nombre_frec_duracion'];
	    $fecha_vencimiento1        = $datos_consulta['fecha_vencimiento1'];
	    $vencimiento_lote1         = $datos_consulta['vencimiento_lote1'];
	    $fecha_vencimiento2        = $datos_consulta['fecha_vencimiento2'];
	    $vencimiento_lote2         = $datos_consulta['vencimiento_lote2'];
	    $iva_ptj                   = $datos_consulta['iva_ptj'];
	    $tope_min                  = $datos_consulta['tope_min'];
	    $und_producto_bodega       = $datos_consulta['und_producto_bodega'];
	    $url_img_orig_producto     = $datos_consulta['url_img_orig_producto'];
	    $url_img_min_producto      = $datos_consulta['url_img_min_producto'];
	    $fecha_mantenimiento       = $datos_consulta['fecha_mantenimiento'];
	    $cod_marca                 = $datos_consulta['cod_marca'];
	    $descripcion_producto      = $datos_consulta['descripcion_producto'];

		$sql_marca = "SELECT cod_marca, nombre_marca FROM tbl15_marca WHERE (cod_marca = '$cod_marca')";
		$query_marca = mysqli_query($conectar, $sql_marca);
		$datos_marca = mysqli_fetch_array($query_marca);

		$nombre_marca                  = $datos_marca['nombre_marca'];

		if ($url_img_orig_producto == '') { $url_img_min_producto = '../imagenes/img_disponible.png'; } else { $url_img_min_producto = $url_img_min_producto; }
	?>
		<tr>
		    <td style="text-align:left"><?php echo $cod_producto_barra; ?></td>
		    <td style="text-align:left"><a href="../admin/reg_parametrizacion_slider_productos_destacados_siscredito_reg.php?cod_producto=<?php echo $cod_producto?>"><?php echo $nombre_producto; ?></a></td>

		    <?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
		    <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
		    <?php } ?>

		    <?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
		    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
		    <?php } ?>
		</tr>
	<?php } ?>
	</table>
<?php } else { } ?>