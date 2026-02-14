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

	$cod_tipo_origen_factura_compra   = intval($_POST['cod_tipo_origen_factura_compra']);
	$pagina                           = addslashes($_POST['pagina']);
	$cod_tercero                      = intval($_POST['cod_tercero']);
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


	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);

	$cod_info_factura_compra            = $datos_autoincremento_sesion['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$pagina_redirect                    = $pagina.'?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_compra='.$cod_info_factura_compra;
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$chk                               = '0';
	$ip                                = $_SERVER['REMOTE_ADDR'];
	$fecha                             = strtotime(date("Y-m-d"));
	$fechas_vencimiento                = '0000-00-00';
	$fechas_vencimiento_seg            = '0';
	$estado                            = 'ABIERTA';
	$tipo_pago                         = 'CONTADO';
	$vendedor                          = $cuenta_actual;
	$fecha_dia                         = date("d/m/Y", $fecha);
	$fecha_mes                         = date("m/Y", $fecha);
	$fecha_anyo                        = date("d/m/Y", $fecha);
	$fecha_hora                        = date("H:i:s");
	$anyo                              = date("Y", $fecha);
	$fecha_pago                        = date("d/m/Y", $fecha);
	$fecha_invert                      = date("Y/m/d", $fecha);
	$nombre_tipo_compra                = 'NORMAL';
	$valor_bruto                       = 0;
	//$cod_tercero                       = 0;
	$descuento                         = 0;
	$valor_neto                        = 0;
	$valor_iva                         = 0;
	$total                             = 0;
	$subtotal                          = 0;
	$nombre_rete_fuente_ptj            = 0;
	$ptj_ipc                           = 0;
	$precio_ipc                        = 0;
	$precio_ipc_total                  = 0;
	$ptj_ret_ica                       = 0;
	$total_ret_ica                     = 0;
	$ptj_iva_teorico                   = 0;
	$total_iva_teorico                 = 0;
	$ptj_tarifa_rete_vigente           = 0;
	$total_tarifa_rete_vigente         = 0;
	$ptj_rete_iva_asumido              = 0;
	$total_rete_iva_asumido            = 0;
	$iva_19                            = 0;
	$iva_5                             = 0;
	$total_rete_fuente                 = 0;
	$total_factura_compra_retefuente   = 0;
	$total_factura_compra              = 0;
	$precio_compra_con_descuento       = 0;
	$detalles                          = 'PV1';
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
	$datos_archivo_plano_intern         = array();
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$archivo_plano_csv                  = $_FILES['csv']['tmp_name'];
	$abrir_archivo_plano_csv            = fopen($archivo_plano_csv,"r");
	do {
		if ($datos_archivo_plano_intern) {

			$cod_producto_barra                     = trim($datos_archivo_plano_intern[1]);

			$sql_producto = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
			$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
			$existe_producto = mysqli_num_rows($consulta_producto);
			$datos_producto = mysqli_fetch_assoc($consulta_producto);

			$nombre_producto                        = trim($datos_archivo_plano_intern[2]);
			$und_unidades                           = trim($datos_archivo_plano_intern[3]);
			$und_caja                               = trim($datos_archivo_plano_intern[4]);
			$und_caja                               = trim($datos_archivo_plano_intern[5]);
			$und_sobre                              = trim($datos_archivo_plano_intern[6]);
			$und_compra                             = trim($datos_archivo_plano_intern[7]);
			$precio_compra_producto                 = trim($datos_archivo_plano_intern[8]);
			$precio_costo_producto                  = trim($datos_archivo_plano_intern[9]);
			$precio_venta_producto                  = trim($datos_archivo_plano_intern[10]);
			$precio_venta_producto2                 = trim($datos_archivo_plano_intern[11]);
			$precio_venta_producto3                 = trim($datos_archivo_plano_intern[12]);
			$precio_venta_producto4                 = trim($datos_archivo_plano_intern[13]);
			$precio_venta_producto5                 = trim($datos_archivo_plano_intern[14]);
			$total_venta_producto                   = trim($datos_archivo_plano_intern[15]);
			$total_compra_producto                  = trim($datos_archivo_plano_intern[16]);
			$precio_compra_producto                 = trim($datos_archivo_plano_intern[17]);
			$cod_interno                            = trim($datos_archivo_plano_intern[18]);
			$nombre_tipo_precio_venta               = trim($datos_archivo_plano_intern[19]);
			//$cod_tercero                            = trim($datos_archivo_plano_intern[20]);
			$cod_tipo_pago                          = trim($datos_archivo_plano_intern[21]);
			$descuento                              = trim($datos_archivo_plano_intern[22]);
			$dto1                                   = trim($datos_archivo_plano_intern[23]);
			$dto2                                   = trim($datos_archivo_plano_intern[24]);
			$iva_ptj                                = trim($datos_archivo_plano_intern[25]);
			$valor_iva                              = trim($datos_archivo_plano_intern[26]);
			$valor_iva                              = trim($datos_archivo_plano_intern[27]);
			$nombre_rete_fuente_ptj                 = trim($datos_archivo_plano_intern[28]);
			$ipc_ptj                                = trim($datos_archivo_plano_intern[29]);
			$precio_ipc                             = trim($datos_archivo_plano_intern[30]);
			$precio_ipc_total                       = trim($datos_archivo_plano_intern[31]);
			$cod_factura                            = trim($datos_archivo_plano_intern[32]);
			$cod_original                           = trim($datos_archivo_plano_intern[33]);
			$codificacion                           = trim($datos_archivo_plano_intern[34]);
			$comision_ptj                           = trim($datos_archivo_plano_intern[35]);
			$ganancia_ptj                           = trim($datos_archivo_plano_intern[36]);
			$tope_min                               = trim($datos_archivo_plano_intern[37]);
			//$cuenta                                 = trim($datos_archivo_plano_intern[38]);
			//$fecha_seg_venta_producto               = trim($datos_archivo_plano_intern[39]);
			//$fecha_mes_venta_producto               = trim($datos_archivo_plano_intern[40]);
			//$fecha_ymd_venta_producto               = trim($datos_archivo_plano_intern[41]);
			//$fecha_anyo_venta_producto              = trim($datos_archivo_plano_intern[42]);
			//$fecha_hora                             = trim($datos_archivo_plano_intern[43]);
			$fecha_vencimiento                      = trim($datos_archivo_plano_intern[44]);
			$fechas_vencimiento_seg                 = trim($datos_archivo_plano_intern[45]);
			$ip                                     = trim($datos_archivo_plano_intern[46]);
			//$cod_dependencia                        = trim($datos_archivo_plano_intern[47]);
			$fecha_ymdhis_seg                       = trim($datos_archivo_plano_intern[48]);
			//$precio_compra_producto_viejo           = trim($datos_archivo_plano_intern[49]);
			//$precio_costo_producto_viejo            = trim($datos_archivo_plano_intern[50]);
			$nombre_tipo_compra                     = trim($datos_archivo_plano_intern[51]);
			$und_min_precio_venta_desc              = trim($datos_archivo_plano_intern[52]);
			//$cod_tercero                            = trim($datos_archivo_plano_intern[53]);
			//$cod_info_factura_compra                = trim($datos_archivo_plano_intern[54]);

			$total_costo_producto                   = $precio_costo_producto * $und_compra;
			$und_producto                           = $datos_producto['und_producto'];
			$cod_producto_barra2                    = $datos_producto['cod_producto_barra2'];
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			if (($existe_producto == '1')) {
				$precio_compra_producto_viejo     = $datos_producto['precio_compra_producto'];
				$precio_costo_producto_viejo      = $datos_producto['precio_compra_producto'];
				$tope_min                         = $datos_producto['tope_min'];

				$cod_producto                     = $datos_producto['cod_producto'];
				$nombre_tipo_producto             = $datos_producto['nombre_tipo_producto'];
				$nombre_tipo_unidad_medida        = $datos_producto['nombre_tipo_unidad_medida'];
				$nombre_tipo_precio_venta         = $datos_producto['nombre_tipo_precio_venta'];
				//$comision_ptj                     = $datos_producto['comision_ptj'];
				$peso_producto                    = $datos_producto['peso_producto'];
				$unidad_medida_peso               = $datos_producto['unidad_medida_peso'];
				$cod_dependencia                  = 1;
			} else {
				$precio_venta_producto            = '0';
				$precio_venta_producto2           = '0';
				$precio_venta_producto3           = '0';
				$precio_venta_producto4           = '0';
				$precio_venta_producto5           = '0';
				$precio_compra_producto_viejo     = '0';
				$precio_costo_producto_viejo      = '0';
				$tope_min                         = '1';
				$cod_producto                     = '0';
				$nombre_tipo_producto             = 'PRODUCTO';
				$nombre_tipo_unidad_medida        = 'UND';
				$nombre_tipo_precio_venta         = 'PV1';
				$comision_ptj                     = '0';
				$peso_producto                    = '0';
				$unidad_medida_peso               = 'UND';
				$cod_dependencia                  = '1';
			}
			/*
			if ($cod_tipo_origen_factura_compra == '2') {
				$und_unidades                     = $datos_producto['und_unidades'];
				$cajas_sobre                      = $datos_producto['cajas_sobre'];
				$und_sobre                        = $datos_producto['und_sobre'];
			}
			*/
				$und_unidades                     = $datos_producto['und_unidades'];
				$cajas_sobre                      = $datos_producto['cajas_sobre'];
				$und_sobre                        = $datos_producto['und_sobre'];
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			//if ($und_caja == '0') { $und_caja = '1'; } else { $und_caja = intval(trim($datos_archivo_plano_intern[5])); }
			//if ($und_unidades == '0') { $und_unidades = '1'; } else { $und_unidades = intval($datos_producto['und_unidades']); }
			//if($iva_ptj == '0') { $dto1 = '10'; $dto2 = '3'; } else { $dto1 = '0'; $dto2 = '0'; }
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			/*
			if ($und_unidades == '1') {
			$und_compra                       = $und_unidades * $und_caja;
			$unidades_total                   = $und_compra;
			$precio_compra_producto_unidad    = $precio_compra_producto_caj;
			$calc_dto1                        = $precio_compra_producto_unidad * ($dto1/100);
			$precio_compra_producto_dto1      = $precio_compra_producto_unidad - $calc_dto1;
			$calc_dto2                        = $precio_compra_producto_dto1 * ($dto2/100);
			$precio_compra_producto_dto2      = $precio_compra_producto_dto1 - $calc_dto2;
			$precio_compra_dto_iva            = $precio_compra_producto_dto2 * ($iva_ptj/100);
			$precio_compra_producto           = $precio_compra_producto_dto2 + $precio_compra_dto_iva;
			$precio_costo_producto            = $precio_compra_producto_unidad;
			$valor_bruto                      = $valor_bruto + ($precio_costo_producto * $und_compra);
			$descuento                        = $descuento + (($calc_dto1 * $und_compra) + ($calc_dto2 * $und_compra));
			$valor_neto                       = $valor_neto + ($precio_compra_producto * $und_compra);
			$valor_iva                        = $valor_iva + ($precio_compra_dto_iva * $und_compra);
			$total                            = $total + ($precio_compra_producto * $und_compra);
			$subtotal                         = $subtotal + ($precio_costo_producto * $und_compra);
			$total_compra_producto            = $precio_compra_producto * $und_caja;
			$total_costo_producto             = $precio_costo_producto * $und_caja;
			$condic                           = 'si';
			} else {
			$und_compra                       = $und_unidades * $und_caja;
			$unidades_total                   = $und_compra;
			$precio_compra_producto_unidad    = ($precio_compra_producto_caj * $und_caja) / $und_compra;
			$calc_dto1                        = $precio_compra_producto_unidad * ($dto1/100);
			$precio_compra_producto_dto1      = $precio_compra_producto_unidad - $calc_dto1;
			$calc_dto2                        = $precio_compra_producto_dto1 * ($dto2/100);
			$precio_compra_producto_dto2      = $precio_compra_producto_dto1 - $calc_dto2;
			$precio_compra_dto_iva            = $precio_compra_producto_dto2 * ($iva_ptj/100);
			$precio_compra_producto           = $precio_compra_producto_dto2 + $precio_compra_dto_iva;
			$precio_costo_producto            = $precio_compra_producto_unidad;
			$valor_bruto                      = $valor_bruto + ($precio_costo_producto * $und_compra);
			$descuento                        = $descuento + (($calc_dto1 * $und_compra) + ($calc_dto2 * $und_compra));
			$valor_neto                       = $valor_neto + ($precio_compra_producto * $und_compra);
			$valor_iva                        = $valor_iva + ($precio_compra_dto_iva * $und_compra);
			$total                            = $total + ($precio_compra_producto * $und_compra);
			$subtotal                         = $subtotal + ($precio_costo_producto * $und_compra);
			$total_compra_producto            = $precio_compra_producto * $und_compra;
			$total_costo_producto             = $precio_costo_producto * $und_compra;
			$condic                           = 'sino';
			}
			*/
			//---------------------------------------------------------------------------------------------------------------------------------------------//
			$sql_data = "INSERT INTO tbl15_compra_producto_temporal (cod_info_factura_compra, cod_producto, cod_producto_barra, nombre_producto, und_compra, 
			precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
			precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
			nombre_tipo_producto, nombre_tipo_unidad_medida, iva_ptj, precio_compra_producto_viejo, precio_costo_producto_viejo, 
			fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
			cod_administrador, cod_tipo_cobrar, cod_caja_virtual, nombre_tipo_precio_venta, 
			und_unidades, und_caja, nombre_tipo_cargue_factura, comision_ptj, peso_producto, unidad_medida_peso, cod_tipo_origen_factura_compra, 
			cajas_sobre, und_sobre, cod_dependencia, dto1, dto2, und_producto, cod_producto_barra2) 
			VALUES ('$cod_info_factura_compra', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', 
			'$precio_compra_producto', '$total_compra_producto',  '$precio_costo_producto', '$total_costo_producto', 
			'$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5', 
			'$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$iva_ptj', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
			'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
			'$cod_administrador', '$cod_tipo_cobrar', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
			'$und_unidades', '$und_caja', '$nombre_tipo_cargue_factura', '$comision_ptj', '$peso_producto', '$unidad_medida_peso', '$cod_tipo_origen_factura_compra', 
			'$cajas_sobre', '$und_sobre', '$cod_dependencia', '$dto1', '$dto2', '$und_producto', '$cod_producto_barra2')";
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		}
	} while ($datos_archivo_plano_intern = fgetcsv($abrir_archivo_plano_csv,1000,";","'"));
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