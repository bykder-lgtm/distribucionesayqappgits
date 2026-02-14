<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
if (isset($_GET['cod_producto_barra'])) {

	$cod_producto_barra                           = addslashes($_GET['cod_producto_barra']);
	$nombre_tipo_moneda                           = addslashes($_GET['nombre_tipo_moneda']);
	$nombre_tipo_factura                          = addslashes($_GET['nombre_tipo_factura']);
	$foco                                         = addslashes($_GET['foco']);
	$cod_estado_vacuna                            = intval($_GET['cod_estado_vacuna']);
	$buscar_por                                   = addslashes($_GET['buscar_por']);
	$cuenta                                       = addslashes($_GET['cuenta']);
	$cod_caja_virtual                             = addslashes($_GET['cod_caja_virtual']);
	$cod_check_imp                                = '1';
	$cod_tipo_metodo_envio                        = '1';
	$cod_base_caja                                = ($_SESSION['cod_base_caja']);


	if (isset($_GET['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_GET['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '0'; }
	if (isset($_GET['cod_categoria'])) { $cod_categoria = intval($_GET['cod_categoria']); $condicional_url_categoria = "&cod_categoria=".$cod_categoria; } else { $condicional_url_categoria = ""; }
	if ($cod_producto_barra == '55555555') { $cod_estado_cava = 1; } else { $cod_estado_cava = 0; }

	$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows($consulta_producto);
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$cod_producto                       = $datos_producto['cod_producto'];
	//$cod_producto_barra                 = $datos_producto['cod_producto_barra'];
	$nombre_producto                    = $datos_producto['nombre_producto'];
	$und_producto                       = $datos_producto['und_producto'];
	$precio_compra_producto             = $datos_producto['precio_compra_producto'];
	$precio_costo_producto              = $datos_producto['precio_costo_producto'];
	$precio_venta_producto              = $datos_producto['precio_venta_producto'];
	$precio_venta_producto2             = $datos_producto['precio_venta_producto2'];
	$precio_venta_producto3             = $datos_producto['precio_venta_producto3']; 
	$precio_venta_producto4             = $datos_producto['precio_venta_producto4'];
	$precio_venta_producto5             = $datos_producto['precio_venta_producto5'];
	$nombre_tipo_unidad_medida          = $datos_producto['nombre_tipo_unidad_medida'];
	$posologia_cantidad                 = $datos_producto['posologia_cantidad'];
	$posologia_peso                     = $datos_producto['posologia_peso'];
	$iva_ptj                            = $datos_producto['iva_ptj'];
	$nombre_tipo_producto               = $datos_producto['nombre_tipo_producto'];
	$nombre_tipo_presentacion           = $datos_producto['nombre_tipo_presentacion'];
	$nombre_via_administracion          = $datos_producto['nombre_via_administracion'];
	$nombre_frec_duracion               = $datos_producto['nombre_frec_duracion'];
	$cod_marca                          = $datos_producto['cod_marca'];
	$cod_proveedor                      = $datos_producto['cod_proveedor'];
	$cod_estado                         = $datos_producto['cod_estado'];
	$cod_dependencia                    = $datos_producto['cod_dependencia'];
	$fecha_ult_compra                   = $datos_producto['fecha_ult_compra'];
	$fecha_ult_venta                    = $datos_producto['fecha_ult_venta'];
	$fecha_vencimiento1                 = $datos_producto['fecha_vencimiento1'];
	$vencimiento_lote1                  = $datos_producto['vencimiento_lote1'];
	$fecha_vencimiento2                 = $datos_producto['fecha_vencimiento2'];
	$vencimiento_lote2                  = $datos_producto['vencimiento_lote2'];
	$tope_min                           = $datos_producto['tope_min'];
	$fecha_creacion                     = $datos_producto['fecha_creacion'];
	$fecha_modificacion                 = $datos_producto['fecha_modificacion'];
	$cod_info_factura_compra            = $datos_producto['cod_info_factura_compra'];
	$nombre_tipo_precio                 = $datos_producto['nombre_tipo_precio'];
	$nombre_tipo_precio_venta           = $datos_producto['nombre_tipo_precio_venta'];
	$cod_opcion_descontable_inv         = $datos_producto['cod_opcion_descontable_inv'];
	$cajas_sobre                        = $datos_producto['cajas_sobre'];
	$und_sobre                          = $datos_producto['und_sobre'];

	$cod_categoria                      = $datos_producto['cod_categoria'];
	$cod_categoria_sub                  = $datos_producto['cod_categoria_sub'];
	$cod_tipo_producto_cocina           = $datos_producto['cod_tipo_producto_cocina'];

	$peso_producto                      = $datos_producto['peso_producto'];
	$unidad_medida_peso                 = $datos_producto['unidad_medida_peso'];
	$cod_origen_produccion              = $datos_producto['cod_origen_produccion'];

	$fecha_ymd_venta_producto           = date("Y-m-d");
	$fecha_mes_venta_producto           = date("Y-m");
	$fecha_anyo_venta_producto          = date("Y");
	$fecha_seg_venta_producto           = time();
	//$cuenta                             = $cuenta_actual;
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
	$observacion                        = '';
	$cod_empresa                        = '0';
	$fecha_ymdhis                       = date("Y-m-d H:is");
	$cod_tipo_cobrar                    = '1';
	$cod_tercero                        = '1';
	$nombre_estado_factura              = 'ABIERTA';
	$cod_tipo_pago                      = "1";
	$cod_tipo_forma_pago                = "1";

	$und_venta                          = "1";
	$total_compra_producto              = $precio_compra_producto;
	$total_costo_producto               = $precio_costo_producto;
	$total_venta_producto               = $precio_venta_producto;
	$cod_tipo_inventario                = "1";
	$precio_venta_producto_orig         = $precio_venta_producto;
	$cod_estado_revisado                = "0";
	$cod_estado_timbre_entrada          = "0";
	$cod_estado_peso                    = $datos_producto['cod_estado_peso'];
	$cod_estado_peso                    = $datos_producto['cod_estado_peso'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
	if ($nombre_tipo_presentacion_defect_global == 'CAJA') {
		if ($precio_venta_producto2 == '0') { 
			$precio_venta_producto = $precio_venta_producto; 
			$und_venta = $cajas_sobre;  
			$total_venta_producto = $precio_venta_producto * $und_venta;
		} else { 
			$precio_venta_producto = $precio_venta_producto2; 
			$und_venta = $cajas_sobre; 
			$total_venta_producto = $precio_venta_producto * $und_venta;
		}
		$nombre_tipo_precio_venta           = 'PV2';
		$und_caja_sobre                     = '1';
		$nombre_tipo_und_caja_sobre         = 'CAJA';
		$nombre_tipo_unidad_medida          = 'CAJA';
	} elseif ($nombre_tipo_presentacion_defect_global == 'SOBRE') {
		if ($precio_venta_producto3 == '0') { 
			$precio_venta_producto = $precio_venta_producto; 
			$und_venta = $und_sobre;
			$total_venta_producto = $precio_venta_producto * $und_venta;
		} else { 
			$precio_venta_producto = $precio_venta_producto3; 
			$und_venta = $und_sobre; 
			$total_venta_producto = $precio_venta_producto * $und_venta;
		}
		$nombre_tipo_precio_venta           = 'PV3';
		$und_caja_sobre                     = '0';
		$nombre_tipo_und_caja_sobre         = 'SOBRE';
		$nombre_tipo_unidad_medida          = 'SOBRE';
	} else {
		$precio_venta_producto = $precio_venta_producto; 
		$und_venta = $und_venta; 
		$total_venta_producto = $precio_venta_producto * $und_venta;
		$nombre_tipo_und_caja_sobre         = 'UND';
		$nombre_tipo_unidad_medida          = 'UND';
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	if ($nombre_tipo_producto == 'HABITACION') {
		$cod_tipo_habitacion_hotel          = $datos_producto['cod_tipo_habitacion_hotel'];
		$cod_estado_habitacion_hotel        = 1;
		$cod_estado_tipo_hotel_parqueo      = 1;
	    $fecha_ymd_parqueo_ini              = date("Y-m-d");
	    $fecha_ymd_parqueo_fin              = date("Y-m-d", strtotime($fecha_ymd_parqueo_ini."+ 1 days"));
	    $fecha_hora_parqueo_ini             = date("H:i:s");
	    $fecha_hora_parqueo_fin             = date("H:i:s");
		$total_dias                         = 1;
		$total_horas                        = 0;

	    $sql_autoincremento_venta_producto_temporal = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_venta_producto_temporal'";
	    $exec_autoincremento_venta_producto_temporal = mysqli_query($conectar, $sql_autoincremento_venta_producto_temporal) or die(mysqli_error($conectar));
	    $datos_autoincremento_venta_producto_temporal = mysqli_fetch_assoc($exec_autoincremento_venta_producto_temporal);

	    $cod_venta_producto_temporal        = $datos_autoincremento_venta_producto_temporal['AUTO_INCREMENT'];

	    $sql_autoincremento_limpieza_hotel = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_limpieza_hotel'";
	    $exec_autoincremento_limpieza_hotel = mysqli_query($conectar, $sql_autoincremento_limpieza_hotel) or die(mysqli_error($conectar));
	    $datos_autoincremento_limpieza_hotel = mysqli_fetch_assoc($exec_autoincremento_limpieza_hotel);

	    $cod_limpieza_hotel                 = $datos_autoincremento_limpieza_hotel['AUTO_INCREMENT'];
	} else {
		$cod_tipo_habitacion_hotel          = 0;
		$cod_estado_habitacion_hotel        = 0;
		$cod_estado_tipo_hotel_parqueo      = 0;
	    $fecha_ymd_parqueo_ini              = '';
	    $fecha_ymd_parqueo_fin              = '';
	    $fecha_hora_parqueo_ini             = '';
	    $fecha_hora_parqueo_fin             = '';
	    $cod_venta_producto_temporal        = 0;
	    $cod_limpieza_hotel                 = 0;
		$total_dias                         = 0;
		$total_horas                        = 0;
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
	    $condic_estado_info = ", cod_estado_cocina = '0'"; 
	    $condic_estado_venta_temp = ", cod_estado_revisado_cocina = '0'"; 
	    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
	    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
	} 
	elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
	    $condic_estado_info = ", cod_estado_bartender = '0'"; 
	    $condic_estado_venta_temp = ", cod_estado_revisado_bartender = '0'"; 
	    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
	    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
	} 
	elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
	    $condic_estado_info = ", cod_estado_jugueria = '0'"; 
	    $condic_estado_venta_temp = ", cod_estado_revisado_jugueria = '0'"; 
	    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
	    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
	} 
	else { 
	    $condic_estado_info = ", cod_estado_revisado_universal = '0'"; 
	    $condic_estado_venta_temp = ""; 
	    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
	    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
	} 
//---------------------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_bascula_balanza_electronica_pesar_producto_global == '1') { 
		if ($cod_estado_peso == '1') {
			$foco = 'und_venta1'; 
		} else {
			$foco = $foco; 
		}
	} else { 
		$foco = $foco; 
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$pagina = addslashes($_GET['pagina'])."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual.$condicional_url_categoria."&pagina=facturacion_venta_temporal_producto_manual_pos.php";

	if ($cod_estado_deshabilitar_und_venta_ventatemp == '1') { $cod_estado_componente_und_venta = '1'; } else { $cod_estado_componente_und_venta = '0'; }

	if ($cod_estado_facturacion_venta_precio_venta_predet_user == '1') {
		if ($nombre_tipo_precio_venta_predet_user == 'PV1') { 
			$nombre_tipo_precio_venta = 'PV1';
		} elseif ($nombre_tipo_precio_venta_predet_user == 'PV2') {
			$nombre_tipo_precio_venta = 'PV2';
		} elseif ($nombre_tipo_precio_venta_predet_user == 'PV3') {
			$nombre_tipo_precio_venta = 'PV3';
		} elseif ($nombre_tipo_precio_venta_predet_user == 'PV4') {
			$nombre_tipo_precio_venta = 'PV4';
		} elseif ($nombre_tipo_precio_venta_predet_user == 'PV5') {
			$nombre_tipo_precio_venta = 'PV5';
		} elseif ($nombre_tipo_precio_venta_predet_user == 'PVAR') {
			$nombre_tipo_precio_venta = 'PVAR';
		} else {
			$nombre_tipo_precio_venta = 'PV1';
		}
	} else {
		$nombre_tipo_precio_venta           = $datos_producto['nombre_tipo_precio_venta'];
	}

	if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	if ($nombre_tipo_precio_venta=='PV1') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; } 
	elseif ($nombre_tipo_precio_venta=='PV2') { $precio_venta_producto = $precio_venta_producto2; $total_venta_producto = $precio_venta_producto2; } 
	elseif ($nombre_tipo_precio_venta=='PV3') { $precio_venta_producto = $precio_venta_producto3; $total_venta_producto = $precio_venta_producto3; } 
	elseif ($nombre_tipo_precio_venta=='PV4') { $precio_venta_producto = $precio_venta_producto4; $total_venta_producto = $precio_venta_producto4; } 
	elseif ($nombre_tipo_precio_venta=='PV5') { $precio_venta_producto = $precio_venta_producto5; $total_venta_producto = $precio_venta_producto5; } 
	elseif ($nombre_tipo_precio_venta=='PVAR') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; } 
	else { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; }

	$sql_info = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_info = mysqli_query($conectar, $sql_info) or die(mysqli_error($conectar));
	$factura_abierta = mysqli_num_rows($consulta_info);
	//$datos_info = mysqli_fetch_assoc($consulta_info);

	if (($cod_estado_venta_prod_en_cero_global <> '0') && ($und_producto <= '0')) { ?>
	<table class="table table-striped">
	<tr>
	<th style="text-align:center"><a href="<?php echo $pagina?>"><h3>Regresar</h3></a></th>
	</tr>
	<tr>
	<th style="text-align:center"><h4><img src=../imagenes/advertencia.gif alt='Advertencia'>EL PRODUCTO NO TIENE UNIDADES DISPONIBLES PARA VENDER<img src=../imagenes/advertencia.gif alt='Advertencia'></h4></th>
	</tr>
	<tr>
	<th style="text-align:center"><h4><?php echo $nombre_producto.' | '.$cod_producto_barra ?></h4></th>
	</tr>
	</table>
	<?php
	} else {

	if ($existe_producto > '0') {
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
		if ($factura_abierta == '0') {

			$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
			$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
			$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

			$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;

			$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
			$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
			$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

			$cod_info_factura_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
			fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
			nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion, 
			cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin) 
			VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
			'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
			'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', 
			'$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

			$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
			precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
			precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
			nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
			cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, 
			precio_venta_producto_orig, und_producto, cod_base_caja, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, 
			cod_check_imp, cajas_sobre, und_sobre, peso_producto, unidad_medida_peso, cod_estado_componente_und_venta, cod_origen_produccion, cod_estado_cava, iva_ptj, 
			cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin, cod_estado_tipo_hotel_parqueo, total_dias, total_horas, nombre_tipo_und_caja_sobre, und_caja_sobre) 
			VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
			'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
			'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
			'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
			'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta',
			'$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', '$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', 
			'$cod_check_imp', '$cajas_sobre', '$und_sobre', '$peso_producto', '$unidad_medida_peso', '$cod_estado_componente_und_venta', '$cod_origen_produccion', '$cod_estado_cava', '$iva_ptj', 
			'$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin', '$cod_estado_tipo_hotel_parqueo', '$total_dias', '$total_horas', '$nombre_tipo_und_caja_sobre', '$und_caja_sobre')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

			$sql_data = sprintf("UPDATE tbl15_producto SET cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel', cod_info_factura_venta = '$cod_info_factura_venta', 
        	cod_venta_producto_temporal = '$cod_venta_producto_temporal' WHERE (cod_producto_barra = '$cod_producto_barra')");
        	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));


//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
		}
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
	else { 

		$sql_info_factura = "SELECT cod_info_factura_venta, cod_tercero FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
		$consulta_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
		$datos_info_factura = mysqli_fetch_assoc($consulta_info_factura);

		$cod_info_factura_venta             = $datos_info_factura['cod_info_factura_venta'];
		$cod_tercero                        = $datos_info_factura['cod_tercero'];
		$fecha_ymdhis                       = date("Y-m-d H:i:s");

		$sql_venta_producto_temporal_repetido = "SELECT und_venta, precio_venta_producto FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_producto_barra = '$cod_producto_barra')";
		$consulta_venta_producto_temporal_repetido = mysqli_query($conectar, $sql_venta_producto_temporal_repetido);
		$existe_venta_producto_temporal_repetido = mysqli_num_rows($consulta_venta_producto_temporal_repetido);
		$datos_venta_producto_temporal_repetido = mysqli_fetch_assoc($consulta_venta_producto_temporal_repetido);

		$und_venta_aument                   = $datos_venta_producto_temporal_repetido['und_venta'] + 1;
		$precio_venta_producto_aument       = $datos_venta_producto_temporal_repetido['precio_venta_producto'];
		$total_venta_producto_aument        = $und_venta_aument * $precio_venta_producto_aument;

		if (($existe_venta_producto_temporal_repetido <> '0') && ($cod_estado_sumar_producto_repetido_venta_temporal_global == '1')) {

			$sql_data = sprintf("UPDATE tbl15_venta_producto_temporal SET und_venta = '$und_venta_aument', total_venta_producto = '$total_venta_producto_aument' WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_producto_barra = '$cod_producto_barra')");
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));	
		} else {
			$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
			precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
			precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
			nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
			cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, precio_venta_producto_orig, und_producto, 
			cod_base_caja, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, cod_check_imp, cajas_sobre, und_sobre, peso_producto, 
			unidad_medida_peso, cod_estado_componente_und_venta, cod_origen_produccion, cod_estado_cava, iva_ptj, 
			cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin, cod_estado_tipo_hotel_parqueo, total_dias, total_horas, nombre_tipo_und_caja_sobre, und_caja_sobre) 
			VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
			'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
			'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
			'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
			'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$precio_venta_producto_orig', '$und_producto', 
			'$cod_base_caja', '$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', '$cod_check_imp', '$cajas_sobre', '$und_sobre', '$peso_producto', 
			'$unidad_medida_peso', '$cod_estado_componente_und_venta', '$cod_origen_produccion', '$cod_estado_cava', '$iva_ptj', 
			'$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin', '$cod_estado_tipo_hotel_parqueo', '$total_dias', '$total_horas', '$nombre_tipo_und_caja_sobre', '$und_caja_sobre')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

			$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_timbre_entrada = '$cod_estado_timbre_entrada', cod_estado_revisado = '0' $condic_estado_info WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

			$sql_data = sprintf("UPDATE tbl15_producto SET cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel', cod_info_factura_venta = '$cod_info_factura_venta', 
        	cod_venta_producto_temporal = '$cod_venta_producto_temporal' WHERE (cod_producto_barra = '$cod_producto_barra')");
        	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
	FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
	$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

	$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else {
?>
<table class="table table-striped">
<tr>
<th style="text-align:center"><img src=../imagenes/advertencia.gif alt='Advertencia'>EL CODIGO <?php echo $cod_producto_barra ?> NO EXISTE EN EL INVENTARIO.<img src=../imagenes/advertencia.gif alt='Advertencia'></th>
</tr>
</table>
<META HTTP-EQUIV="REFRESH" CONTENT="3; <?php echo $pagina?>">
<?php } ?>

<?php } ?>

<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>