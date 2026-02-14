<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                        = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_empresa_transferencia_directa_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_empresa_transferencia_directa_global  = $info_empresa_data['cod_empresa_transferencia_directa_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_info_factura_transferencia_bodega'])) {

	$cod_info_factura_transferencia_bodega = intval($_POST['cod_info_factura_transferencia_bodega']);
	$fecha_anyo                            = addslashes($_POST['fecha_anyo']);
	$cod_tercero                           = intval($_POST['cod_tercero']);
	$nombre_tipo_moneda                    = 'COP';
	$nombre_tipo_factura                   = 'POS';
	$cod_tipo_forma_pago                   = '1';
	$cod_tipo_pago                         = '1';
	$cod_administrador                     = intval($_POST['cod_administrador']);
	$total_datos                           = intval($_POST['total_datos']);
	$pagina                                = addslashes($_POST['pagina']);
	$fecha_anyo_seg                        = strtotime($fecha_anyo);
	$total_datos_data                      = $total_datos;
	$nombre_estado_factura                 = 'CERRADA';
	$nombre_maquina                        = gethostname();
	$fecha_seg_venta_producto              = time();
	if (isset($_POST['cod_empresa_transferencia_directa'])) { $cod_empresa_transferencia_directa = intval($_POST['cod_empresa_transferencia_directa']); } else { $cod_empresa_transferencia_directa = '0'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_empresa_transferencia_directa = "SELECT nombre_base_datos_empresa_transferencia_directa FROM tbl15_empresa_transferencia_directa WHERE (cod_empresa_transferencia_directa = '$cod_empresa_transferencia_directa')";
	$consulta_empresa_transferencia_directa = mysqli_query($conectar, $sql_empresa_transferencia_directa) or die(mysqli_error($conectar));
	$datos_empresa_transferencia_directa = mysqli_fetch_assoc($consulta_empresa_transferencia_directa);

	$nombre_base_datos_empresa_transferencia_directa  = $datos_empresa_transferencia_directa['nombre_base_datos_empresa_transferencia_directa'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_impuesto_facturas = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_transferencia_bodega_entrada'";
	$exec_info_impuesto_facturas = mysqli_query($conectar, $sql_info_impuesto_facturas) or die(mysqli_error($conectar));
	$datos_info_impuesto_facturas = mysqli_fetch_assoc($exec_info_impuesto_facturas);

	$cod_info_factura_transferencia_bodega_entrada           = $datos_info_impuesto_facturas['AUTO_INCREMENT'];
	$cod_factura                                             = time();
	$fecha                                                   = date("d-m-Y");
	$fecha_invert                                            = date("Y-m-d");
	$hora                                                    = date("H:i:s");
	$fecha_cargue_import                                     = date("Y-m-d");
	$fecha_cargue                                            = date("Y/m/d - H:i:s");
	$fecha_llegada                                           = date("d/m/Y");
	$respuesta_ajax                                          = array();
	$contador                                                = '0';
	$contador_alter                                          = '0';
	$fecha_cargue_import                                     = date("Y-m-d");
	$fecha_ymd_venta_producto                                = date("Y-m-d");
	$fecha_hora_venta_producto                               = date("H:i:s");
	$nombre_empresa                                          = "";
	$razonsocial_empresa                                     = "";
	$datos_reg_excel                                         = "0";
	$cod_tipo_origen_factura_compra                          = "4";
	$total_precio_costo                                      = 0;
	$total_precio_compra                                     = 0;
	$total_precio_venta                                      = 0;
	$cod_caja_virtual          = 1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_empresa = "SELECT nombre FROM tbl15_info_empresa WHERE (cod_info_empresa = '1')";
	$consulta_info_empresa = mysqli_query($conectar, $sql_info_empresa) or die(mysqli_error($conectar));
	$datos_info_empresa = mysqli_fetch_assoc($consulta_info_empresa);

	$nombre_cliente                        = $datos_info_empresa['nombre'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_tercero = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_info_tercero = mysqli_query($conectar, $sql_info_tercero) or die(mysqli_error($conectar));
	$datos_info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

	$nombre_empresa                        = $nombre_cliente;
	$razonsocial_empresa                   = $datos_info_tercero['nombre1_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = addslashes($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_transferencia_bodega 
	WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
	$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
	$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

	//$cod_factura                         = $maxima_factura['cod_factura']+1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_transferencia_bodega WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'";
	$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
	$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
	$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

	$fecha_ymdhis                      = $matriz_info_imp_factura['fecha_ymdhis'];
	//$cuenta                            = $cuenta_actual;
	$cod_estado_factura                = '0';
	$descuento_ptj                     = '0';
	$iva_ptj                           = '0';
	$flete_ptj                         = '0';
	//$cod_cliente                       = '0';
	$vlr_vuelto                        = '0';
	$fecha_dia                         = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes                         = date("Y-m", $fecha_anyo_seg);
	$anyo                              = date("Y", $fecha_anyo_seg);
	$fecha_hora                        = date("H:i:s");
	$fecha_hora_venta_producto         = date("H:i:s");
	$fecha_remision                    = $matriz_info_imp_factura['fecha_remision'];
	$nombre_ccosto                     = $matriz_info_imp_factura['nombre_ccosto'];
	$garantia_meses                    = $matriz_info_imp_factura['garantia_meses'];
	$observacion                       = $matriz_info_imp_factura['observacion'];
	$cod_tipo_inventario               = $matriz_info_imp_factura['cod_tipo_inventario'];
	//$cod_administrador                 = $matriz_info_imp_factura['cod_administrador'];
	$fecha_ymd_venta_producto          = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_venta_producto          = date("Y-m", $fecha_anyo_seg);
	$fecha_anyo_venta_producto         = date("Y", $fecha_anyo_seg);
	$fecha_seg_venta_producto          = time();
	if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//


	$tiempo_final                      = microtime(true);
	$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;
	$vlr_vuelto                        = 0 - 0;
	$vlr_vuetotal_precio_compralto     = 0;
	$total_precio_venta                = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_total_venta_producto_temporal = "SELECT * FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
	$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
	while ($datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal)) {

		$cod_producto                      = $datos_total_venta_producto_temporal['cod_producto'];

		$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
		$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
		$datos_prod = mysqli_fetch_assoc($modificar_consulta);
		//-----------------------------------------------------------------------------------------------------------------------------------------//
		//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
		$cod_producto_barra                               = $datos_total_venta_producto_temporal['cod_producto_barra'];
		$nombre_producto                                  = $datos_total_venta_producto_temporal['nombre_producto'];
		$und_venta                                        = $datos_total_venta_producto_temporal['und_venta'];
		$precio_compra_producto                           = $datos_total_venta_producto_temporal['precio_compra_producto'];
		$total_compra_producto                            = $precio_compra_producto * $und_venta;
		$precio_costo_producto                            = $datos_total_venta_producto_temporal['precio_costo_producto'];
		$total_costo_producto                             = $precio_costo_producto * $und_venta;
		$precio_venta_producto                            = $datos_total_venta_producto_temporal['precio_venta_producto'];
		$total_venta_producto                             = $datos_total_venta_producto_temporal['total_venta_producto'];
		$nombre_tipo_producto                             = $datos_total_venta_producto_temporal['nombre_tipo_producto'];
		$nombre_tipo_unidad_medida                        = $datos_total_venta_producto_temporal['nombre_tipo_unidad_medida'];
		$posologia_cantidad                               = $datos_total_venta_producto_temporal['posologia_cantidad'];
		$posologia_peso                                   = $datos_total_venta_producto_temporal['posologia_peso'];
		$nombre_tipo_presentacion                         = $datos_total_venta_producto_temporal['nombre_tipo_presentacion'];
		$nombre_via_administracion                        = $datos_total_venta_producto_temporal['nombre_via_administracion'];
		$nombre_frec_duracion                             = $datos_total_venta_producto_temporal['nombre_frec_duracion'];
		$cod_caja_virtual                                 = $datos_total_venta_producto_temporal['cod_caja_virtual'];
		$fecha_alerta                                     = $datos_total_venta_producto_temporal['fecha_alerta'];
		$nombre_tipo_precio_venta                         = $datos_total_venta_producto_temporal['nombre_tipo_precio_venta'];
		$iva_ptj                                          = $datos_prod['iva_ptj'];
		$und_producto_inv                                 = $datos_prod['und_producto'];
		$und_producto_bodega_inv                          = $datos_prod['und_producto_bodega'];
		$comision_ptj                                     = $datos_prod['comision_ptj'];
		$cod_dependencia                                  = $datos_prod['cod_dependencia'];
		$und_producto                                     = $und_producto_inv - $und_venta;
		$total_precio_compra                              = $total_precio_compra + ($und_venta * $precio_costo_producto);
		$total_precio_venta                               = $total_precio_venta + ($und_venta * $precio_venta_producto);

		$datos_info_producto = "SELECT und_producto AS und_producto_antiguo,  precio_compra_producto AS precio_compra_producto_antiguo FROM $nombre_base_datos_empresa_transferencia_directa.tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$consulta_info_producto = mysqli_query($conectar, $datos_info_producto) or die(mysqli_error($conectar));
		$info_producto = mysqli_fetch_assoc($consulta_info_producto);

		$und_producto_antiguo                             = intval($info_producto['und_producto_antiguo']);
		$precio_compra_producto_antiguo                   = intval($info_producto['precio_compra_producto_antiguo']);
		$total_precio_compra_producto_antiguo             = intval($und_producto_antiguo * $precio_compra_producto_antiguo);
		$und_producto_nuevo                               = intval($und_venta);
		$precio_compra_producto_nuevo                     = intval($precio_compra_producto);
		$total_precio_compra_producto_nuevo               = ($und_producto_nuevo * $precio_compra_producto_nuevo);
		$total_und_producto                               = $und_producto_antiguo + $und_producto_nuevo;
		$total_precio_compra_producto                     = $total_precio_compra_producto_antiguo + $total_precio_compra_producto_nuevo;
		$precio_compra_producto_promedio                  = ($total_precio_compra_producto) / ($total_und_producto);
	//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
		$agregar_reg_venta_producto = "INSERT INTO tbl15_transferencia_bodega_producto (cod_info_factura_transferencia_bodega, cod_factura, cod_producto, cod_producto_barra, 
		nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
		total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
		nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
		fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
		fecha_alerta, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
		cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, 
		cod_dependencia, cod_tipo_inventario, cod_tipo_producto_consumo, nombre_cliente, cod_empresa_transferencia_directa, precio_compra_producto_promedio)
		VALUES ('$cod_info_factura_transferencia_bodega', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
		'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
		'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
		'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
		'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
		'$fecha_alerta', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
		'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', 
		'$cod_dependencia', '$cod_tipo_inventario', '$cod_tipo_producto_consumo', '$nombre_cliente', '$cod_empresa_transferencia_directa', '$precio_compra_producto_promedio')";
		$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
		$actualiza_producto = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));

		if ($cod_empresa_transferencia_directa <> '0') {

			$sql_info_impuesto_facturas = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$nombre_base_datos_empresa_transferencia_directa' AND TABLE_NAME = 'tbl15_info_factura_transferencia_bodega_entrada'";
			$exec_info_impuesto_facturas = mysqli_query($conectar, $sql_info_impuesto_facturas) or die(mysqli_error($conectar));
			$datos_info_impuesto_facturas = mysqli_fetch_assoc($exec_info_impuesto_facturas);

			$cod_info_factura_transferencia_bodega_entrada           = $datos_info_impuesto_facturas['AUTO_INCREMENT'];
	
			$sql = "INSERT INTO $nombre_base_datos_empresa_transferencia_directa.tbl15_transferencia_bodega_entrada_producto_temporal (cod_empresa_transferencia_directa, cod_producto, cod_producto_barra, 
			nombre_producto, und_venta, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, fecha_ymd_venta_producto, nombre_tipo_precio_venta, 
			nombre_cliente, cod_info_factura_transferencia_bodega_entrada, cod_tipo_origen_factura_compra, total_costo_producto, total_compra_producto, total_venta_producto, precio_compra_producto_promedio) 
			VALUES ('$cod_empresa_transferencia_directa_global', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
			'$und_venta', '$precio_compra_producto', '$precio_venta_producto', '$nombre_tipo_producto','$nombre_tipo_unidad_medida', '$fecha_ymd_venta_producto', '$nombre_tipo_precio_venta', 
			'$nombre_cliente', '$cod_info_factura_transferencia_bodega_entrada', '$cod_tipo_origen_factura_compra', '$total_costo_producto', '$total_compra_producto', '$total_venta_producto', '$precio_compra_producto_promedio')";
			$consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
		}
	}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//   
	$agregar_regis = sprintf("UPDATE tbl15_info_factura_transferencia_bodega SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
	total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
	nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_tipo_producto_consumo = '$cod_tipo_producto_consumo', 
	nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa', cod_empresa_transferencia_directa = '$cod_empresa_transferencia_directa'
	WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	if ($cod_empresa_transferencia_directa <> '0') {
  		$cod_caja_virtual          = 1;
		$nombre_estado_factura     = 'ABIERTA';
		$fecha_ymdhis              = date("Y-m-d H:i:s");
		$cuenta                    = $cuenta_actual;
		$cod_estado_factura        = 1;
		$fecha_dia                 = date("Y-m-d");
		$fecha_mes                 = date("Y-m");
		$fecha_anyo                = date("Y-m-d");
		$anyo                      = date("Y");
		$fecha_hora                = date("H:i:s");
		$cod_tipo_pago             = 1;
		$cod_administrador         = $cod_administrador;
		$cod_dependencia           = 1;
		$cod_tipo_forma_pago       = 1;
		$nombre_tipo_factura       = 'POS';
		$nombre_tipo_moneda        = 'COP';
		$fecha_modificacion        = date("Y-m-d H:i:s");

		$sql = "INSERT INTO $nombre_base_datos_empresa_transferencia_directa.tbl15_info_factura_transferencia_bodega_entrada (cod_empresa_transferencia_directa, cod_factura, cod_tercero, cod_caja_virtual, nombre_estado_factura, 
		fecha_ymdhis, cuenta, cod_estado_factura, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, 
		cod_administrador, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, fecha_modificacion, 
		cod_info_factura_transferencia_bodega_entrada, nombre_empresa, razonsocial_empresa, cod_tipo_origen_factura_compra, total_precio_costo, total_precio_compra, total_precio_venta) 
		VALUES ('$cod_empresa_transferencia_directa_global', '$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_estado_factura', 
		'$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', 
		'$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$fecha_modificacion', 
		'$cod_info_factura_transferencia_bodega_entrada', '$nombre_empresa', '$razonsocial_empresa', '$cod_tipo_origen_factura_compra', '$total_precio_costo', '$total_precio_compra', '$total_precio_venta')";
		$consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	$url_redir = "../admin/transferenica_bodega_productos_opcion_imprimir.php?cod_info_factura_transferencia_bodega=".$cod_info_factura_transferencia_bodega."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
	header("Location: $url_redir");
}
?>