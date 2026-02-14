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
$cuenta_actual                           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                  = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_auditoria              = intval($_POST['cod_info_factura_auditoria']);
$fecha_anyo                              = addslashes($_POST['fecha_anyo']);
$cod_tercero                             = intval($_POST['cod_tercero']);
$nombre_tipo_moneda                      = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                     = addslashes($_POST['nombre_tipo_factura']);
$nombre_tipo_cargue_factura              = addslashes($_POST['nombre_tipo_cargue_factura']);
$nombre_tipo_compra                      = addslashes($_POST['nombre_tipo_compra']);
$nombre_rete_fuente_ptj                  = addslashes($_POST['nombre_rete_fuente_ptj']);
$ret_ica_ptj                             = addslashes($_POST['ret_ica_ptj']);
$subtotal                                = addslashes($_POST['subtotal']);
$total_valor_iva                         = addslashes($_POST['valor_iva']);
$total_descuento                         = addslashes($_POST['total_descuento']);
$total_precio_ipc                        = addslashes($_POST['total_precio_ipc']);
$total_compra_imp                        = addslashes($_POST['total_compra_imp']);
$total_rete_fuente                       = addslashes($_POST['total_rete_fuente']);
$total_ret_ica                           = addslashes($_POST['total_ret_ica']);
$total_factura_compra_retefuente         = addslashes($_POST['total_factura_compra_retefuente']);
$cod_tipo_forma_pago                     = intval($_POST['cod_tipo_forma_pago']);
$cod_tipo_pago                           = intval($_POST['cod_tipo_pago']);
$cod_administrador                       = intval($_POST['cod_administrador']);
$cod_factura                             = addslashes($_POST['cod_factura']);
$cod_tipo_inventario                     = intval($_POST['cod_tipo_inventario']);
$total_datos                             = intval($_POST['total_datos']);
$vlr_cancelado                           = 0;
$pagina                                  = addslashes($_POST['pagina']);
$fecha_anyo_seg                          = strtotime($fecha_anyo);
$total_datos_data                        = $total_datos;
$nombre_estado_factura                   = 'CERRADA';
$nombre_maquina                          = gethostname();
$fecha_ult_compra                        = date("Y-m-d");
$total                                   = $total_factura_compra_retefuente;
$subtotal_total_precio_compra            = $subtotal;
$subtotal_total_precio_costo             = $subtotal;
$total_factura_compra                    = $total_factura_compra_retefuente;
$fecha_compra                            = $fecha_anyo;

if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = addslashes($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$time                                    = time();
$fecha_ymdHis                            = date("YmdHis");
$formato                                 = 'jpg';
$fecha_hora                              = date("H:i:s");
$fecha_ymd                               = date("Y-m-d");
$cod_estado_factura                      = '0';
$descuento_ptj                           = '0';
$iva_ptj                                 = '0';
$flete_ptj                               = '0';
$vlr_vuelto                              = '0';
$fecha_dia                               = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                               = date("Y-m", $fecha_anyo_seg);
$anyo                                    = date("Y", $fecha_anyo_seg);
$fecha_hora                              = date("H:i:s");
$fecha_hora_venta_producto               = date("H:i:s");
$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto                = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto                = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
if (isset($_POST['cod_info_factura_auditoria'])) {

	for ($i=0; $i < $total_datos; $i++) {

		$cod_auditoria_producto_temporal   = $_POST['cod_auditoria_producto_temporal'][$i];

		$sql_mconsulta = "SELECT * FROM tbl15_auditoria_producto_temporal WHERE (cod_auditoria_producto_temporal = '$cod_auditoria_producto_temporal')";
		$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
		$datos_temp = mysqli_fetch_assoc($mconsulta);

		$cod_producto                      = $datos_temp['cod_producto'];
		$cod_producto_barra                = $datos_temp['cod_producto_barra'];
		$nombre_tipo_precio_venta          = $datos_temp['nombre_tipo_precio_venta'];
		$nombre_producto                   = $datos_temp['nombre_producto'];
		$und_compra                        = $datos_temp['und_compra'];
		$precio_compra_producto            = $datos_temp['precio_compra_producto'];
		$total_compra_producto             = $datos_temp['total_compra_producto'];
		$precio_costo_producto             = $datos_temp['precio_costo_producto'];
		$total_costo_producto              = $datos_temp['total_costo_producto'];
		$precio_venta_producto             = $datos_temp['precio_venta_producto'];
		$total_venta_producto              = $datos_temp['total_venta_producto'];
		$nombre_tipo_producto              = $datos_temp['nombre_tipo_producto'];
		$nombre_tipo_unidad_medida         = $datos_temp['nombre_tipo_unidad_medida'];
		$nombre_tipo_precio                = $datos_temp['nombre_tipo_precio'];
		$cod_dependencia                   = $datos_temp['cod_dependencia'];
		$nombre_tipo_medida                = $datos_temp['nombre_tipo_medida'];
		$cod_base_caja                     = $datos_temp['cod_base_caja'];
		$cod_guia                          = $datos_temp['cod_guia'];
		$cuenta                            = $datos_temp['cuenta'];

		$sql_producto = "SELECT und_producto, und_producto_bodega, comision_ptj, precio_compra_producto, precio_costo_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
		$datos_producto = mysqli_fetch_assoc($consulta_producto);

		$und_producto                      = $datos_producto['und_producto'];

		$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_auditoria_producto (cod_info_factura_auditoria, cod_producto, cod_producto_barra, nombre_producto, 
		und_compra, und_producto, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
		precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
		fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
		nombre_tipo_precio, nombre_tipo_precio_venta,  cod_dependencia, nombre_tipo_compra, nombre_tipo_cargue_factura, nombre_tipo_medida,  
		cod_base_caja, cod_guia, cod_administrador, cuenta, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura)
		VALUES ('$cod_info_factura_auditoria', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
		'$und_compra', '$und_producto', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
		'$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', 
		'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
		'$nombre_tipo_precio', '$nombre_tipo_precio_venta',  '$cod_dependencia', '$nombre_tipo_compra', '$nombre_tipo_cargue_factura', '$nombre_tipo_medida',  
		'$cod_base_caja', '$cod_guia', '$cod_administrador', '$cuenta', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura')";
		$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
	}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM tbl15_auditoria_producto_temporal WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$tiempo_final                            = microtime(true);
	$tiempo_ejecucion                        = $tiempo_final - $tiempo_inicial;
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$agregar_regis = sprintf("UPDATE tbl15_info_factura_auditoria SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', cod_administrador = '$cod_administrador', tiempo_ejecucion = '$tiempo_ejecucion' 
	WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria')");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------------------/ */

	/* ----------------------------------------------------------------------------------------------------------/ */
	$url_redir = "../admin/factura_auditoria_productos_opcion_imprimir.php?cod_info_factura_auditoria=".$cod_info_factura_auditoria."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
	header("Location: $url_redir");
}
//-------------------------------------- LLAVE DE CIERRE DEL CONDICIONAL VENDER ------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>