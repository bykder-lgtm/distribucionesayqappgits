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
<div class="breadcrumbs">
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_POST['cod_tipo_origen_factura_compra'])) {

	$cod_tipo_origen_factura_compra   = addslashes($_POST['cod_tipo_origen_factura_compra']);
	$pagina                           = addslashes($_POST['pagina']);
	$cod_tercero                      = intval($_POST['cod_tercero']);
	$buscar_por                       = 'cod_producto_barra';
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_tercero = "SELECT dto1_con_iva_tercero, dto2_con_iva_tercero, dto1_sin_iva_tercero, dto2_sin_iva_tercero, dto1_excento_iva_tercero, dto2_excento_iva_tercero 
	FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_info_tercero = mysqli_query($conectar, $sql_info_tercero) or die(mysqli_error($conectar));
	$datos_info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

	$dto1_con_iva_tercero                               = $datos_info_tercero['dto1_con_iva_tercero'];
	$dto2_con_iva_tercero                               = $datos_info_tercero['dto2_con_iva_tercero'];
	$dto1_sin_iva_tercero                               = $datos_info_tercero['dto1_sin_iva_tercero'];
	$dto2_sin_iva_tercero                               = $datos_info_tercero['dto2_sin_iva_tercero'];
	$dto1_excento_iva_tercero                           = $datos_info_tercero['dto1_excento_iva_tercero'];
	$dto2_excento_iva_tercero                           = $datos_info_tercero['dto2_excento_iva_tercero'];
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_compra_producto_temporal";
	$resultado_animal = mysqli_query($conectar, $sql_animal);
	$info_animal = mysqli_fetch_assoc($resultado_animal);

	$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
	$_SESSION['cod_caja_virtual']       = $cod_caja_virtual;
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);

	$cod_info_factura_compra            = $datos_autoincremento_sesion['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$pagina_redirect                    = $pagina.'?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_compra='.$cod_info_factura_compra;
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$chk                                = '0';
	$ip                                 = $_SERVER['REMOTE_ADDR'];
	$fecha                              = strtotime(date("Y-m-d"));
	$fechas_vencimiento                 = '0000-00-00';
	$fechas_vencimiento_seg             = '0';
	$estado                             = 'ABIERTA';
	$tipo_pago                          = 'CONTADO';
	$vendedor                           = $cuenta_actual;
	$fecha_dia                          = date("d/m/Y", $fecha);
	$fecha_mes                          = date("m/Y", $fecha);
	$fecha_anyo                         = date("d/m/Y", $fecha);
	$fecha_hora                         = date("H:i:s");
	$anyo                               = date("Y", $fecha);
	$fecha_pago                         = date("d/m/Y", $fecha);
	$fecha_invert                       = date("Y/m/d", $fecha);
	$nombre_tipo_compra                 = 'NORMAL';
	$valor_bruto                        = 0;
	//$cod_tercero                        = 0;
	$descuento                          = 0;
	$valor_neto                         = 0;
	$valor_iva                          = 0;
	$total                              = 0;
	$subtotal                           = 0;
	$nombre_rete_fuente_ptj             = 0;
	$ptj_ipc                            = 0;
	$precio_ipc                         = 0;
	$precio_ipc_total                   = 0;
	$ptj_ret_ica                        = 0;
	$total_ret_ica                      = 0;
	$ptj_iva_teorico                    = 0;
	$total_iva_teorico                  = 0;
	$ptj_tarifa_rete_vigente            = 0;
	$total_tarifa_rete_vigente          = 0;
	$ptj_rete_iva_asumido               = 0;
	$total_rete_iva_asumido             = 0;
	$iva_19                             = 0;
	$iva_5                              = 0;
	$total_rete_fuente                  = 0;
	$total_factura_compra_retefuente    = 0;
	$total_factura_compra               = 0;
	$precio_compra_con_descuento        = 0;
	$detalles                           = 'PV1';
	$fecha_ymd_venta_producto           = date("Y-m-d");
	$fecha_mes_venta_producto           = date("Y-m");
	$fecha_anyo_venta_producto          = date("Y");
	$fecha_seg_venta_producto           = time();
	$cuenta                             = $cuenta_actual;
	$cod_estado_factura                 = '1';
	$descuento_ptj                      = '0';
	$flete_ptj                          = '0';
	$vlr_cancelado                      = '';
	$vlr_vuelto                         = '';
	$fecha_dia                          = strtotime(date("Y-m-d"));
	$fecha_mes                          = date("Y-m");
	$fecha_anyo                         = date("Y-m-d");
	$anyo                               = date("Y");
	$fecha_hora                         = date("H:i:s");
	$fecha_remision                     = date("Y-m-d");
	$nombre_ccosto                      = '';
	$garantia_meses                     = '';
	$observacion                        = '';
	$cod_tipo_pago                      = '1';
	$cod_empresa                        = '0';
	$fecha_ymdhis                       = date("Y-m-d H:is");
	$cod_tipo_cobrar                    = '1';
	$nombre_estado_factura              = 'ABIERTA';
	$nombre_tipo_compra                 = 'NORMAL';
	$cod_tipo_producto_consumo          = '1';
	$cod_tipo_forma_pago                = "1";
	$nombre_tipo_cargue_factura         = 'FACTURA_COMPRA_NORMAL';
	$nombre_tipo_factura                = 'POS';
	$nombre_tipo_moneda                 = 'COP';
	$cod_tipo_inventario                = "1";
//---------------------------------------------------------------------------------------------------------------------------------------------//
	$datos_archivo_plano_extern         = array();
	$archivo_plano_csv                  = $_FILES['csv']['tmp_name'];
	$abrir_archivo_plano_csv            = fopen($archivo_plano_csv,"r");

	do {
		if ($datos_archivo_plano_extern[0]) {

			$cod_producto_barra_get              = trim($datos_archivo_plano_extern[10]);

			if (($cod_estado_cod_barra2_global == '1') && ($buscar_por == 'cod_producto_barra')) {
				$campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."') OR (cod_producto_barra2 = '".$cod_producto_barra_get."')";
			} elseif (($cod_estado_cod_barra2_global == '1') && ($buscar_por == 'cod_producto_barra2')) {
				$campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."') OR (cod_producto_barra2 = '".$cod_producto_barra_get."')";
			} else {
				$campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."')";
			}

			$sql_producto = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, und_unidades, und_sobre, tope_min, precio_compra_producto AS precio_compra_producto_viejo, 
			nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_precio_venta, comision_ptj, peso_producto, unidad_medida_peso, und_caja, cajas_sobre, 
			precio_costo_producto AS precio_costo_producto_viejo, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, 
			precio_venta_producto5, cod_dependencia, und_producto, nombre_producto
			FROM tbl15_producto WHERE $campo_busqueda";
			$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
			$existe_producto = mysqli_num_rows($consulta_producto);
			$datos_producto = mysqli_fetch_assoc($consulta_producto);

			$cod_producto_barra                     = $datos_producto['cod_producto_barra'];
			$cod_producto_barra2                    = $datos_producto['cod_producto_barra2'];
			$fecha_vector                           = trim($datos_archivo_plano_extern[1]);
			$cod_factura                            = trim($datos_archivo_plano_extern[2]);
			//$nombre_producto0                       = trim($datos_archivo_plano_extern[4]);
			//$nombre_producto0                       = mysqli_real_escape_string($conectar, ($nombre_producto0)); 
			//$nombre_producto1                       = str_replace("'", " PULG ", $nombre_producto0);
			//$nombre_producto2                       = str_replace(",", ".", $nombre_producto1);
			//$nombre_producto3                       = str_replace("#", " NO ", $nombre_producto2);
			//$nombre_producto4                       = str_replace("%", " PTJ ", $nombre_producto3);
			//$nombre_producto                        = trim(str_replace('"', " PULG ", $nombre_producto4));
			$ivax                                   = trim($datos_archivo_plano_extern[8]);
			$nombre_tipo_medida                     = trim($datos_archivo_plano_extern[14]);
			$precio_compra_producto_caj             = trim($datos_archivo_plano_extern[6]);
			$precio_costo_producto_caj              = trim($datos_archivo_plano_extern[7]);
			$nombre_proveedor                       = $precio_compra_producto_caj;
			$iva_vect                               = explode('.', $ivax);
			$iva_ptj                                = end($iva_vect);
			$und_caja                               = intval(trim($datos_archivo_plano_extern[5]));
			$und_unidades                           = $datos_producto['cajas_sobre'];
			$cod_dependencia                        = $datos_producto['cod_dependencia'];
			$und_producto                           = $datos_producto['und_producto'];
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			if ($cod_producto_barra == '') { $cod_producto_barra = $cod_producto_barra_get; } else { $cod_producto_barra = $cod_producto_barra; }
			if ($und_caja == '0') { $und_caja = '1'; } else { $und_caja = intval(trim($datos_archivo_plano_extern[5])); }
			if ($und_unidades == '0') { $und_unidades = '1'; } else { $und_unidades = $datos_producto['cajas_sobre']; }
			if($iva_ptj == '0') { $dto1 = $dto1_sin_iva_tercero; $dto2 = $dto2_sin_iva_tercero; } else { $dto1 = $dto1_con_iva_tercero; $dto2 = $dto2_con_iva_tercero; }
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			if ($und_unidades == '1') {
				$und_compra                             = $und_unidades * $und_caja;
				$unidades_total                         = $und_compra;
				$precio_compra_producto_unidad          = $precio_compra_producto_caj;
				$precio_compra_producto_ant_desc        = $precio_compra_producto_unidad + ($precio_compra_producto_unidad * ($iva_ptj/100));
				$total_compra_producto_ant_desc         = $precio_compra_producto_ant_desc * $unidades_total;
				$precio_compra_producto_base_iva        = $precio_compra_producto_ant_desc / (($iva_ptj/100)+1);
				$precio_compra_producto_dto1            = $precio_compra_producto_base_iva - ($precio_compra_producto_base_iva * ($dto1/100));
				$precio_compra_producto_dto2            = $precio_compra_producto_dto1 * ($dto2/100);
				$precio_compra_producto_dto             = $precio_compra_producto_dto1 - $precio_compra_producto_dto2;
				$total_iva                              = $precio_compra_producto_ant_desc - $precio_compra_producto_base_iva;
				$precio_compra_producto                 = ($precio_compra_producto_dto + $total_iva);
				$calc_dto1                              = $precio_compra_producto_base_iva * ($dto1/100);
				$precio_compra_producto_dto1            = $precio_compra_producto_base_iva - $calc_dto1;
				$calc_dto2                              = $precio_compra_producto_dto1 * ($dto2/100);
				$precio_compra_producto_dto2            = $precio_compra_producto_dto1 - $calc_dto2;
				$precio_compra_dto_iva                  = $precio_compra_producto_dto2 * ($iva_ptj/100);
				$precio_costo_producto                  = $precio_compra_producto_base_iva;
				$valor_bruto                            = $valor_bruto + ($precio_costo_producto * $und_compra);
				$descuento                              = $descuento + (($calc_dto1 * $und_compra) + ($calc_dto2 * $und_compra));
				$valor_neto                             = $valor_neto + ($precio_compra_producto * $und_compra);
				$valor_iva                              = $valor_iva + ($precio_compra_dto_iva * $und_compra);
				$total                                  = $total + ($precio_compra_producto * $und_compra);
				$subtotal                               = $subtotal + ($precio_costo_producto * $und_compra);
				$total_compra_producto                  = $precio_compra_producto * $und_caja;
				$total_costo_producto                   = $precio_costo_producto * $und_caja;
				$condic                                 = 'si';
			} else {
				$und_compra                             = $und_unidades * $und_caja;
				$unidades_total                         = $und_compra;
				$precio_compra_producto_unidad          = ($precio_compra_producto_caj * $und_caja) / $und_compra;
				$precio_compra_producto_ant_desc        = $precio_compra_producto_unidad + ($precio_compra_producto_unidad * ($iva_ptj/100));
				$total_compra_producto_ant_desc         = $precio_compra_producto_ant_desc * $unidades_total;
				$precio_compra_producto_base_iva        = $precio_compra_producto_ant_desc / (($iva_ptj/100)+1);
				$precio_compra_producto_dto1            = $precio_compra_producto_base_iva - ($precio_compra_producto_base_iva * ($dto1/100));
				$precio_compra_producto_dto2            = $precio_compra_producto_dto1 * ($dto2/100);
				$precio_compra_producto_dto             = $precio_compra_producto_dto1 - $precio_compra_producto_dto2;
				$total_iva                              = $precio_compra_producto_ant_desc - $precio_compra_producto_base_iva;
				$precio_compra_producto                 = ($precio_compra_producto_dto + $total_iva);
				$calc_dto1                              = $precio_compra_producto_base_iva * ($dto1/100);
				$precio_compra_producto_dto1            = $precio_compra_producto_base_iva - $calc_dto1;
				$calc_dto2                              = $precio_compra_producto_dto1 * ($dto2/100);
				$precio_compra_producto_dto2            = $precio_compra_producto_dto1 - $calc_dto2;
				$precio_compra_dto_iva                  = $precio_compra_producto_dto2 * ($iva_ptj/100);
				$precio_costo_producto                  = $precio_compra_producto_base_iva;
				$valor_bruto                            = $valor_bruto + ($precio_costo_producto * $und_compra);
				$descuento                              = $descuento + (($calc_dto1 * $und_compra) + ($calc_dto2 * $und_compra));
				$valor_neto                             = $valor_neto + ($precio_compra_producto * $und_compra);
				$valor_iva                              = $valor_iva + ($precio_compra_dto_iva * $und_compra);
				$total                                  = $total + ($precio_compra_producto * $und_compra);
				$subtotal                               = $subtotal + ($precio_costo_producto * $und_compra);
				$total_compra_producto                  = $precio_compra_producto * $und_compra;
				$total_costo_producto                   = $precio_costo_producto * $und_compra;
				$condic                                 = 'sino';
			}
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
			if ($existe_producto == '1') {
				$precio_venta_producto            = $datos_producto['precio_venta_producto'];
				$precio_venta_producto2           = $datos_producto['precio_venta_producto2'];
				$precio_venta_producto3           = $datos_producto['precio_venta_producto3'];
				$precio_venta_producto4           = $datos_producto['precio_venta_producto4'];
				$precio_venta_producto5           = $datos_producto['precio_venta_producto5'];
				$precio_compra_producto_viejo     = $datos_producto['precio_compra_producto_viejo'];
				$precio_costo_producto_viejo      = $datos_producto['precio_costo_producto_viejo'];
				$tope_min                         = $datos_producto['tope_min'];
				$und_unidades                     = $datos_producto['cajas_sobre'];
				$und_sobre                        = $datos_producto['und_sobre'];
				$cod_producto                     = $datos_producto['cod_producto'];
				$nombre_tipo_producto             = $datos_producto['nombre_tipo_producto'];
				$nombre_tipo_unidad_medida        = $datos_producto['nombre_tipo_unidad_medida'];
				$nombre_tipo_precio_venta         = $datos_producto['nombre_tipo_precio_venta'];
				$comision_ptj                     = $datos_producto['comision_ptj'];
				$peso_producto                    = $datos_producto['peso_producto'];
				$unidad_medida_peso               = $datos_producto['unidad_medida_peso'];
				$nombre_producto                  = $datos_producto['nombre_producto'];
			} else {
				$precio_venta_producto            = '0';
				$precio_venta_producto2           = '0';
				$precio_venta_producto3           = '0';
				$precio_venta_producto4           = '0';
				$precio_venta_producto5           = '0';
				$precio_compra_producto_viejo     = '0';
				$precio_costo_producto_viejo      = '0';
				$und_unidades                     = '1';
				$und_sobre                        = '1';
				$tope_min                         = '1';
				$cod_producto                     = '0';
				$nombre_tipo_producto             = 'PRODUCTO';
				$nombre_tipo_unidad_medida        = 'UND';
				$nombre_tipo_precio_venta         = 'PV1';
				$comision_ptj                     = '0';
				$peso_producto                    = '0';
				$unidad_medida_peso               = 'UND';

				$nombre_producto0                 = trim($datos_archivo_plano_extern[4]);
				$nombre_producto0                 = mysqli_real_escape_string($conectar, ($nombre_producto0)); 
				$nombre_producto1                 = str_replace("'", " PULG ", $nombre_producto0);
				$nombre_producto2                 = str_replace(",", ".", $nombre_producto1);
				$nombre_producto3                 = str_replace("#", " NO ", $nombre_producto2);
				$nombre_producto4                 = str_replace("%", " PTJ ", $nombre_producto3);
				$nombre_producto                  = trim(str_replace('"', " PULG ", $nombre_producto4));
			}
			$cajas_sobre                      = $datos_producto['cajas_sobre'];

			if ($existe_producto == '0') { $precio_compra_producto = $precio_compra_producto_caj; $total_compra_producto = $precio_compra_producto * $und_caja; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
			$sql_data = "INSERT INTO tbl15_compra_producto_temporal (cod_info_factura_compra, cod_producto, cod_producto_barra, nombre_producto, und_compra, 
			precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
			precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
			nombre_tipo_producto, nombre_tipo_unidad_medida, iva_ptj, precio_compra_producto_viejo, precio_costo_producto_viejo, 
			fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
			cod_administrador, cod_tipo_cobrar, cod_caja_virtual, nombre_tipo_precio_venta, 
			und_unidades, und_caja, nombre_tipo_cargue_factura, comision_ptj, peso_producto, unidad_medida_peso, cod_tipo_origen_factura_compra, 
			cajas_sobre, und_sobre, cod_dependencia, dto1, dto2, und_producto, precio_compra_producto_ant_desc, total_compra_producto_ant_desc, cod_producto_barra2) 
			VALUES ('$cod_info_factura_compra', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', 
			'$precio_compra_producto', '$total_compra_producto',  '$precio_costo_producto', '$total_costo_producto', 
			'$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5', 
			'$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$iva_ptj', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
			'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
			'$cod_administrador', '$cod_tipo_cobrar', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
			'$und_unidades', '$und_caja', '$nombre_tipo_cargue_factura', '$comision_ptj', '$peso_producto', '$unidad_medida_peso', '$cod_tipo_origen_factura_compra', 
			'$cajas_sobre', '$und_sobre', '$cod_dependencia', '$dto1', '$dto2', '$und_producto', '$precio_compra_producto_ant_desc', '$total_compra_producto_ant_desc', '$cod_producto_barra2')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		}
	} while ($datos_archivo_plano_extern = fgetcsv($abrir_archivo_plano_csv,1000,",","'"));
//---------------------------------------------------------------------------------------------------------------------------------------------//
			$sql_data = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, cod_factura, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
			fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, 
			nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, nombre_tipo_cargue_factura, cod_tipo_inventario, nombre_tipo_compra, 
			cod_tipo_producto_consumo, cod_tipo_origen_factura_compra) 
			VALUES ('$cod_info_factura_compra', '$cod_factura', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
			'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', 
			'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$nombre_tipo_cargue_factura', '$cod_tipo_inventario', '$nombre_tipo_compra', 
			'$cod_tipo_producto_consumo', '$cod_tipo_origen_factura_compra')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
//header("Location: $pagina?cod_info_factura_compra=$cod_info_factura_compra&cod_caja_virtual=$cod_caja_virtual&cuenta=$cuenta");
}
?>
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