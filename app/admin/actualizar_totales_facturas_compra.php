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
if (isset($_GET["cod_info_factura_compra"])) {

	$cod_info_factura_compra              = intval($_GET['cod_info_factura_compra']);
	$cuenta                               = addslashes($_GET['cuenta']);
	$cod_caja_virtual                     = addslashes($_GET['cod_caja_virtual']);
	$pagina                               = addslashes($_GET['pagina']);
	$pagina_redirect                      = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_compra='.$cod_info_factura_compra;

	$datos_info_tercero = "SELECT cod_tercero, nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta_info_tercero = mysqli_query($conectar, $datos_info_tercero) or die(mysqli_error($conectar));
	$info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

	$cod_tercero                            = $info_tercero['cod_tercero'];
	$nombre_rete_fuente_ptj                 = $info_tercero['nombre_rete_fuente_ptj'];
	$ret_ica_ptj                            = $info_tercero['ret_ica_ptj'];

	$datos_tercero = "SELECT cod_estado_dto_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_tercero = mysqli_query($conectar, $datos_tercero) or die(mysqli_error($conectar));
	$dato_tercero = mysqli_fetch_assoc($consulta_tercero);

	$cod_estado_dto_tercero                 = $dato_tercero['cod_estado_dto_tercero'];

	$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
	SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto_ant_desc * und_compra)) AS con_iva, 
	SUM(((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) * (dto1/100)) AS total_dto, 
	SUM((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) AS base_valor_iva_ant_desc, SUM(precio_compra_producto_ant_desc * und_compra) AS total_compra_producto_ant_desc
	FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
	$suma = mysqli_fetch_assoc($consulta_suma);

	$total                                  = round($suma['total_compra_producto'], 2);
	$total_precio_costo                     = round($suma['total_precio_costo'], 2);
	//$valor_iva                              = round($suma['valor_iva'], 2);
	$subtotal                               = $suma['subtotal'];
	$total_sin_iva                          = $subtotal;
	$total_con_iva                          = round($suma['con_iva'], 2);
	$valor_iva                              = $total_con_iva - $total_sin_iva;
	$total_precio_ipc                       = $suma['total_precio_ipc'];
	$valor_neto                             = $total;
	$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
	$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
	$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
	$total_factura_compra                   = $total; 
	$total_descuento                        = round($suma['total_dto'], 2);
	$total_compra_imp                       = $total_con_iva;
	$base_valor_iva_ant_desc                = round($suma['base_valor_iva_ant_desc'], 2);
	$total_compra_producto_ant_desc         = round($suma['total_compra_producto_ant_desc'], 2);

	if ($cod_estado_dto_tercero == '1') { $valor_iva = $total_compra_producto_ant_desc - $base_valor_iva_ant_desc; } else { $valor_iva = $valor_iva; }

	$data_sql = ("UPDATE tbl15_info_factura_compra SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
	valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
	total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
	WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
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