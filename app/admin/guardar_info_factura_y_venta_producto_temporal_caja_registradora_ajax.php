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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = $_SESSION['usuario'];
$cod_administrador                     = $_SESSION['cod_administrador'];
$tipo_ajax                             = addslashes($_POST['tipo_ajax']);
$campo                                 = addslashes($_POST['campo']);
$valor                                 = addslashes($_POST['valor']);
$opcion                                = addslashes($_POST['opcion']);
$cod_info_factura_venta                = intval($_POST['cod_info_factura_venta']);
$cod_tipo_forma_pago                   = intval($_POST['cod_tipo_forma_pago']);
$cod_tercero                           = intval($_POST['cod_tercero']);
$array_precio_venta_producto           = explode("+", $valor);
$total_datos_data                      = count($array_precio_venta_producto);
$total_datos                           = $total_datos_data;
$array_recibido                        = explode("|", $valor);

if (isset($_POST['cod_tipo_pago'])) { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
if (isset($_POST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = addslashes($_POST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes($_POST['nombre1_tercero']); } else { $nombre1_tercero = ''; }
if (isset($_POST['fecha_entrega'])) { $fecha_entrega = addslashes($_POST['fecha_entrega']); } else { $fecha_entrega = ''; }
if (isset($_POST['descripcion_tipo_forma_pago'])) { $descripcion_tipo_forma_pago = addslashes($_POST['descripcion_tipo_forma_pago']); } else { $descripcion_tipo_forma_pago = ''; }
if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = ''; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

$nombre_tipo_factura                   = 'POS';
$respuesta_ajax                        = array();
$fecha_anyo                            = date("Y-m-d");
// ------------------------------------------------------------------------------------------------- //
$fecha_ymdHis                    = date("YmdHis");
$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
$ruta_firma_orig                 = '../archivador/firma/original/';
$ruta_foto_orig                  = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img1 <> '') { 
	$formato_img2                    = explode(".", $url_img1);
	$formato_img2                    = end($formato_img2);
	$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_info_factura_venta.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
	$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
	$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
	copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
} else { 
	$formato_img2                    = "";
	$formato_img2                    = "";
	$nombre_normal2                  = "";
	$url_img_orig_producto           = "";
	$url_img_min_producto            = "";
}
// ------------------------------------------------------------------------------------------------- //
$fecha_anyo_seg                = strtotime($fecha_anyo);
$nombre_estado_factura         = 'CERRADA';
$nombre_maquina                = gethostname();
$fecha_pago_abono              = date("Y-m-d");
$fecha                         = date("Y-m-d");
$fecha_invert                  = date("Y-m-d");
$fecha_seg                     = time();
$fecha_creacion                = date("Y-m-d H:i:s");
$fecha_hoy                     = date("Y-m-d");
// ------------------------------------------------------------------------------------------------- //
$datos_info = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];
// ------------------------------------------------------------------------------------------------- //
$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta 
WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
// ------------------------------------------------------------------------------------------------- //
$cod_producto                        = '0';
$cod_producto_barra                  = '999999';
$nombre_producto                     = 'PRODUCTOS VARIOS';
$und_venta                           = '1';
$precio_compra_producto              = '0.01';
$total_compra_producto               = '0.01';
$precio_costo_producto               = '0.01';
$total_costo_producto                = '0.01';
$nombre_tipo_producto                = 'PRODUCTO';
$und_producto                        = '0';
$und_producto_bodega_inv             = '0';
$nombre_tipo_unidad_medida           = 'UND';
$iva_ptj                             = '0';
$cod_caja_virtual                    = '1';
$nombre_tipo_precio_venta            = 'PV1';
$nombre_tipo_moneda                  = 'COP';
$cod_dependencia                     = '1';
$cod_categoria                       = '1';
$cod_categoria_sub                   = '1';
$total_precio_compra                 = '0';
$cod_tipo_inventario                 = '1';
$comentario_producto                 = 'CAJA_REG';
$direccion_tercero                   = 'CAJA_REG';

$fecha_anyo_seg                      = strtotime($fecha_anyo);
$cod_estado_factura                  = '0';
$descuento_ptj                       = '0';
$iva_ptj                             = '0';
$flete_ptj                           = '0';
$vlr_vuelto                          = '0';
$fecha_dia                           = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                           = date("m-Y", $fecha_anyo_seg);
$anyo                                = date("Y", $fecha_anyo_seg);
$fecha_hora                          = date("H:i:s");
$fecha_hora_venta_producto           = date("H:i:s");
$fecha_ymd_venta_producto            = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto            = date("m-Y", $fecha_anyo_seg);
$fecha_anyo_venta_producto           = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto            = time();
$fecha_pago                          = $fecha_anyo;

// ------------------------------------------------------------------------------------------------- //
$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion          = intval($matriz_resol_fact['cod_resolucion_facturacion']);
// ------------------------------------------------------------------------------------------------- //
if ($cod_tipo_pago == '2') {
	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

	$cod_cuentas_cobrar           = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
} else {
	$cod_cuentas_cobrar           = '0';
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'precio_venta_producto') && ($tipo_ajax == 'tbl15_venta_producto_temporal') && ($valor <> '')) {

	$precio_venta_producto_concat = $valor;
	$total_precio_venta           = 0;
	$total_venta_producto         = 0;

	for($i = 0; $i < $total_datos_data; $i++)   {
		$precio_venta_producto = intval($array_precio_venta_producto[$i]);
		$total_venta_producto = $precio_venta_producto;
		$precio_venta_producto_orig = $precio_venta_producto;

		if (($precio_venta_producto <> '') || ($precio_venta_producto <> '0')) {

			$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
			nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
			total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
			nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
			cod_resolucion_facturacion, iva_ptj, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
			cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, 
			cod_dependencia, precio_venta_producto_orig, cod_categoria, cod_categoria_sub, total_datos_data, comentario_producto)
			VALUES ('$cod_info_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
			'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
			'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
			'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
			'$cod_resolucion_facturacion', '$iva_ptj', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
			'$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda',
			'$cod_dependencia', '$precio_venta_producto_orig', '$cod_categoria', '$cod_categoria_sub', '$total_datos_data', '$comentario_producto')";
			$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));

			$total_precio_venta    += $precio_venta_producto;
		}
	}

	//if ($total_recibido <> '0') { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }
	if (strpos($valor, '|') != false) { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }

	$tiempo_final                      = microtime(true);
	$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;

	$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
	total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
	nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_resolucion_facturacion = '$cod_resolucion_facturacion', 
	cod_tipo_inventario = '$cod_tipo_inventario', direccion_tercero = '$direccion_tercero', cod_cuentas_cobrar = '$cod_cuentas_cobrar' 
	WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	if ($cod_tipo_pago == '2') {
		$monto_deuda                           = $total_precio_venta; 
		$vlr_cancelado_abono                   = 0;
		$subtotal                              = $total_precio_venta - $vlr_cancelado_abono; 
		$abonado                               = $vlr_cancelado_abono; 
		$hora                                  = $fecha_hora;
		$mensaje                               = '';
		$vendedor                              = $cuenta;
		$cod_estado_cuenta_cobrar              = 1;
		$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

		$agregar_reg_cuentas_cobrar = "INSERT INTO tbl15_cuentas_cobrar (cod_factura, cod_tercero, monto_deuda, subtotal, vendedor, cuenta, abonado, 
		fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_info_factura_venta, nombre1_tercero)
		VALUES ('$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$vendedor', '$cuenta', '$abonado', 
		'$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_info_factura_venta', '$nombre1_tercero')";
		$resultado_cuentas_cobrar = mysqli_query($conectar, $agregar_reg_cuentas_cobrar) or die(mysqli_error($conectar));

		$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
		FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
		$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
		$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

		$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
		$total_subtotal_cuenta_cobrar          = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
		$total_abonado_cuenta_cobrar           = $datos_cuenta_cobrar['total_abonado_cuenta_cobrar'];

		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
		total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
		WHERE (cod_tercero = '$cod_tercero')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
	}
	$respuesta_ajax['llave']                    = $cod_info_factura_venta;
	$respuesta_ajax['total_precio_venta']       = $total_precio_venta;
	$respuesta_ajax['vlr_cancelado']            = $vlr_cancelado;
	$respuesta_ajax['vlr_vuelto']               = $vlr_vuelto;
	$respuesta_ajax['estado']                   = '1';
	$respuesta_ajax['total_datos_data']         = $total_datos_data;

	echo json_encode($respuesta_ajax);
} else {
	$respuesta_ajax['llave']                    = 0;
	$respuesta_ajax['total_precio_venta']       = 0;
	$respuesta_ajax['vlr_cancelado']            = 0;
	$respuesta_ajax['vlr_vuelto']               = 0;
	$respuesta_ajax['estado']                   = '0';
	$respuesta_ajax['total_datos_data']         = 0;

	echo json_encode($respuesta_ajax);
}

?>