<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET["cod_compra_producto_temporal"])) {

	$cod_compra_producto_temporal         = intval($_GET['cod_compra_producto_temporal']);
	$cod_info_factura_compra              = intval($_GET['cod_info_factura_compra']);
	$cuenta                               = addslashes($_GET['cuenta']);
	$cod_caja_virtual                     = addslashes($_GET['cod_caja_virtual']);
	$campo                                = addslashes($_GET['campo']);
	$foco                                 = addslashes($_GET['foco']);
	$pagina                               = addslashes($_GET['pagina']);

	$pagina_redirect                      = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_compra='.$cod_info_factura_compra.'&cod_compra_producto_temporal='.$cod_compra_producto_temporal.'&foco='.$foco;

	$datos_info_tercero = "SELECT cod_tercero, nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta_info_tercero = mysqli_query($conectar, $datos_info_tercero) or die(mysqli_error($conectar));
	$info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

	$cod_tercero                            = $info_tercero['cod_tercero'];
	$nombre_rete_fuente_ptj                 = $info_tercero['nombre_rete_fuente_ptj'];
	$ret_ica_ptj                            = $info_tercero['ret_ica_ptj'];

	$datos_info_temporal = "SELECT und_unidades, und_compra, precio_compra_producto_por_caja, precio_venta_producto_por_caja, iva_ptj, dto1, dto2 FROM tbl15_compra_producto_temporal WHERE (cod_compra_producto_temporal = '$cod_compra_producto_temporal')";
	$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
	$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

	$precio_compra_producto_por_caja        = $info_temporal['precio_compra_producto_por_caja'];
	$precio_venta_producto_por_caja         = $info_temporal['precio_venta_producto_por_caja'];
	$und_unidades                           = $info_temporal['und_unidades'];
	$und_compra                             = $info_temporal['und_compra'];
	$iva_ptj                                = $info_temporal['iva_ptj'];
	$dto1                                   = $info_temporal['dto1'];
	$dto2                                   = $info_temporal['dto2'];

	if ($und_unidades == '0') { $und_unidades = 1; }

	$precio_compra_producto                 = ($precio_compra_producto_por_caja / $und_unidades);
	$precio_venta_producto                  = ($precio_venta_producto_por_caja / $und_unidades);
	if ($precio_venta_producto == '0') { $precio_venta_producto = 1; }
	$precio_compra_producto_nuevo           = $precio_compra_producto;
	$precio_compra_producto_ant_desc        = ($precio_compra_producto_nuevo);
	$total_compra_producto_ant_desc         = ($precio_compra_producto_ant_desc * $und_unidades);

	$precio_compra_producto_base_iva        = $precio_compra_producto / (($iva_ptj/100)+1);
	$precio_compra_producto_dto1            = $precio_compra_producto_base_iva - ($precio_compra_producto_base_iva * ($dto1/100));
	$precio_compra_producto_dto2            = $precio_compra_producto_dto1 * ($dto2/100);
	$precio_compra_producto_dto             = $precio_compra_producto_dto1 - $precio_compra_producto_dto2;
	$total_iva                              = $precio_compra_producto - $precio_compra_producto_base_iva;
	$precio_compra_producto                 = ($precio_compra_producto_dto + $total_iva);
	$total_compra_producto                  = ($precio_compra_producto * $und_compra);
	$ganancia_ptj                           = intval((($precio_venta_producto - $precio_compra_producto) / $precio_venta_producto) * 100);

	$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
	$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
	$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
	$descuento                              = ($precio_compra_producto_base_iva - $precio_compra_producto_dto);
	$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
	$total_costo_producto                   = $precio_costo_producto * $und_compra;
	$total_dto                              = ($descuento * $und_unidades);

	if ($campo == 'PRECIO_COMPRA_POR_CAJA') {
		$cod_estado_precio_compra_producto_por_caja = 1;

		$data_sql = ("UPDATE tbl15_compra_producto_temporal SET precio_compra_producto = '$precio_compra_producto', total_compra_producto = '$total_compra_producto', 
		precio_costo_producto = '$precio_costo_producto', total_costo_producto = '$total_costo_producto', precio_compra_producto_ant_desc = '$precio_compra_producto_ant_desc', 
		total_compra_producto_ant_desc = '$total_compra_producto_ant_desc', descuento = '$descuento', total_dto = '$total_dto', ganancia_ptj = '$ganancia_ptj', 
		cod_estado_precio_compra_producto_por_caja = '$cod_estado_precio_compra_producto_por_caja' 
		WHERE cod_compra_producto_temporal = '$cod_compra_producto_temporal'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

		$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
		SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto_ant_desc * und_compra)) AS con_iva, SUM(((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) * (dto1/100)) AS total_dto, 
		SUM((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) AS base_valor_iva_ant_desc, SUM(precio_compra_producto_ant_desc * und_compra) AS total_compra_producto_ant_desc
		FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
		$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
		$suma = mysqli_fetch_assoc($consulta_suma);

		$total                                             = round($suma['total_compra_producto'], 2);
		$total_precio_costo                                = round($suma['total_precio_costo'], 2);
		$subtotal                                          = $suma['subtotal'];
		$total_sin_iva                                     = $subtotal;
		$total_con_iva                                     = round($suma['con_iva'], 2);
		$valor_iva                                         = $total_con_iva - $total_sin_iva;
		$total_precio_ipc                                  = $suma['total_precio_ipc'];
		$valor_neto                                        = $total;
		$total_rete_fuente                                 = $subtotal * ($nombre_rete_fuente_ptj/100);
		$total_ret_ica                                     = $subtotal * ($ret_ica_ptj/1000);
		$total_factura_compra_retefuente                   = ($total - ($total_rete_fuente + $total_ret_ica));
		$total_factura_compra                              = $total; 
		$total_descuento                                   = round($suma['total_dto'], 2);
		$total_compra_imp                                  = $total_con_iva;
		$base_valor_iva_ant_desc                           = round($suma['base_valor_iva_ant_desc'], 2);
		$total_compra_producto_ant_desc                    = round($suma['total_compra_producto_ant_desc'], 2);

		$data_sql = ("UPDATE tbl15_info_factura_compra SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
		valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
		total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
		WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	}
	if ($campo == 'PRECIO_VENTA_POR_CAJA') {
		$cod_estado_precio_venta_producto_por_caja = 1;
		$data_sql = ("UPDATE tbl15_compra_producto_temporal SET precio_venta_producto = '$precio_venta_producto', cod_estado_precio_venta_producto_por_caja = '$cod_estado_precio_venta_producto_por_caja' 
			WHERE cod_compra_producto_temporal = '$cod_compra_producto_temporal'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	}
/* ----------------------------------------------------------------------------------------------------------/ */
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>