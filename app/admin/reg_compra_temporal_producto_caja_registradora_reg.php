<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php
if (isset($_GET['cuenta'])) {
	$nombre_tipo_cargue_factura         = 'FACTURA_COMPRA_NORMAL';
	$nombre_tipo_moneda	                = "COP";
	$nombre_tipo_factura                = "POS";
	$cod_estado_vacuna                  = "0";
	$cod_estado_factura                 = '1';
	$descuento_ptj                      = '0';
	$flete_ptj                          = '0';
	$vlr_cancelado                      = '';
	$vlr_vuelto                         = '';
	$fecha_dia                          = strtotime(date("Y/m/d"));
	$fecha_mes                          = date("Y-m");
	$fecha_anyo                         = date("Y-m-d");
	$anyo                               = date("Y");
	$fecha_hora                         = date("H:i:s");
	$fecha_remision                     = date("Y-m-d");
	$nombre_ccosto                      = '';
	$garantia_meses                     = '';
	$cod_tipo_pago                      = '1';
	$cod_empresa                        = '0';
	$fecha_ymdhis                       = date("Y-m-d H:is");
	$cod_tipo_cobrar                    = '1';
	$nombre_estado_factura              = 'ABIERTA';
	$nombre_tipo_compra                 = 'NORMAL';
	$cod_tipo_producto_consumo          = '1';
	$cod_tipo_forma_pago                = "1";
	$und_venta                          = "1";
	$cod_tipo_inventario                = "1";
	$cod_dependencia                    = "1";
	$cod_tercero                        = "2";
	$observacion                        = 'cargada por mod caja registradora';
	$foco                               = 'busqueda';
	$cuenta                             = $cuenta_actual;
	$buscar_por                         = '';
	$pagina                             = '../admin/facturacion_compra_temporal_producto_manual_caja_registradora_pos.php';
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_info_factura_compra            = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_info_factura_compra";
	$resultado_animal = mysqli_query($conectar, $sql_animal);
	$info_animal = mysqli_fetch_assoc($resultado_animal);

	$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
	$cod_base_caja                      = $info_animal['cod_base_caja'] + 1;
	$_SESSION['cod_base_caja']          = $cod_base_caja;
	$_SESSION['cod_caja_virtual']       = $cod_caja_virtual;
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$pagina_redirect                             = $pagina."?&cuenta=".$cuenta_actual."&cod_caja_virtual=".$cod_caja_virtual."&cod_info_factura_compra=".$cod_info_factura_compra;
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
	nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, nombre_tipo_cargue_factura, cod_tipo_inventario, nombre_tipo_compra, cod_tipo_producto_consumo, observacion) 
	VALUES ('$cod_info_factura_compra', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
	'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$nombre_tipo_cargue_factura', '$cod_tipo_inventario', '$nombre_tipo_compra', '$cod_tipo_producto_consumo', '$observacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } ?>