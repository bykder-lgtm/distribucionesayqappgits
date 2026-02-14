<?php
date_default_timezone_set("America/Bogota");
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                                = $_SESSION['usuario'];
$cod_administrador                                     = $_SESSION['cod_administrador'];
$respuesta_ajax                                        = array();
$cod_tipo_estado_incluido                              = 0;
$cod_caja_virtual                                      = 1;
$nombre_estado_factura                                 = 'ABIERTA';

if (isset($_POST['llave'])) {
	$cod_gasto_inmueble_detalle_venta                 = intval($_POST['llave']);
	$cod_cuentas_cobrar_alerta                        = intval($_POST['cod_cuentas_cobrar_alerta']);
	$tipo_ajax                                        = addslashes($_POST['tipo_ajax']);
	$campo                                            = addslashes($_POST['campo']);
	$valor                                            = addslashes($_POST['valor']);
	$opcion                                           = addslashes($_POST['opcion']);
	$tipo                                             = addslashes($_POST['tipo']);
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
	if (($tipo_ajax == 'tbl15_gasto_inmueble_detalle_venta') && ($campo == 'cod_gasto_inmueble_detalle_venta')) { 

		$sql_gasto_inmueble_detalle_venta = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'";
		$consulta_gasto_inmueble_detalle_venta = mysqli_query($conectar, $sql_gasto_inmueble_detalle_venta) or die(mysqli_error($conectar));
		$datos_gasto_inmueble_detalle_venta = mysqli_fetch_assoc($consulta_gasto_inmueble_detalle_venta);

		$nombre_gasto_inmueble_detalle                         = $datos_gasto_inmueble_detalle_venta['nombre_gasto_inmueble_detalle'];
		$descripcion_gasto_inmueble_detalle                    = $datos_gasto_inmueble_detalle_venta['descripcion_gasto_inmueble_detalle'];
		$costo_gasto_inmueble_detalle                          = $datos_gasto_inmueble_detalle_venta['costo_gasto_inmueble_detalle'];
		$cod_gasto_inmueble                                    = $datos_gasto_inmueble_detalle_venta['cod_gasto_inmueble'];
		$cod_cuentas_cobrar                                    = $datos_gasto_inmueble_detalle_venta['cod_cuentas_cobrar'];
		$cod_cuentas_cobrar_alerta                             = $datos_gasto_inmueble_detalle_venta['cod_cuentas_cobrar_alerta'];
		$cod_cuentas_cobrar_abonos                             = $datos_gasto_inmueble_detalle_venta['cod_cuentas_cobrar_abonos'];
		$cod_cuentas_cobrar_factura_comision_propietario       = $datos_gasto_inmueble_detalle_venta['cod_cuentas_cobrar_factura_comision_propietario'];
		$cod_tercero_propietario                               = $datos_gasto_inmueble_detalle_venta['cod_tercero_propietario'];
		$fecha_gasto_inmueble_detalle                          = $datos_gasto_inmueble_detalle_venta['fecha_gasto_inmueble_detalle'];
		$fecha                                                 = $datos_gasto_inmueble_detalle_venta['fecha'];
		$fecha_mes                                             = $datos_gasto_inmueble_detalle_venta['fecha_mes'];
		$anyo                                                  = $datos_gasto_inmueble_detalle_venta['anyo'];
		$fecha_invert                                          = $datos_gasto_inmueble_detalle_venta['fecha_invert'];
		$fecha_seg                                             = $datos_gasto_inmueble_detalle_venta['fecha_seg'];
		$fecha_creacion                                        = $datos_gasto_inmueble_detalle_venta['fecha_creacion'];
		$cod_producto                                          = $datos_gasto_inmueble_detalle_venta['cod_producto'];
		$cod_producto_barra                                    = $datos_gasto_inmueble_detalle_venta['cod_producto_barra'];
		$cod_info_gasto_inmueble_detalle_venta                 = $datos_gasto_inmueble_detalle_venta['cod_info_gasto_inmueble_detalle_venta'];
		$cod_factura                                           = $datos_gasto_inmueble_detalle_venta['cod_factura'];
		$cod_tercero                                           = $datos_gasto_inmueble_detalle_venta['cod_tercero'];
		//$cod_caja_virtual                                      = $datos_gasto_inmueble_detalle_venta['cod_caja_virtual'];
		$nombre_producto                                       = $datos_gasto_inmueble_detalle_venta['nombre_producto'];
		$und_venta                                             = $datos_gasto_inmueble_detalle_venta['und_venta'];
		$precio_compra_producto                                = $datos_gasto_inmueble_detalle_venta['precio_compra_producto'];
		$total_compra_producto                                 = $datos_gasto_inmueble_detalle_venta['total_compra_producto'];
		$precio_costo_producto                                 = $datos_gasto_inmueble_detalle_venta['precio_costo_producto'];
		$total_costo_producto                                  = $datos_gasto_inmueble_detalle_venta['total_costo_producto'];
		$precio_venta_producto                                 = $datos_gasto_inmueble_detalle_venta['precio_venta_producto'];
		$total_venta_producto                                  = $datos_gasto_inmueble_detalle_venta['total_venta_producto'];
		$precio_venta_producto_orig                            = $datos_gasto_inmueble_detalle_venta['precio_venta_producto_orig'];
		$und_producto                                          = $datos_gasto_inmueble_detalle_venta['und_producto'];
		$fecha_ymd_venta_producto                              = $datos_gasto_inmueble_detalle_venta['fecha_ymd_venta_producto'];
		$fecha_mes_venta_producto                              = $datos_gasto_inmueble_detalle_venta['fecha_mes_venta_producto'];
		$fecha_anyo_venta_producto                             = $datos_gasto_inmueble_detalle_venta['fecha_anyo_venta_producto'];
		$fecha_hora_venta_producto                             = $datos_gasto_inmueble_detalle_venta['fecha_hora_venta_producto'];
		$fecha_seg_venta_producto                              = $datos_gasto_inmueble_detalle_venta['fecha_seg_venta_producto'];
		//$cuenta                                                = $datos_gasto_inmueble_detalle_venta['cuenta'];
		$cod_administrador                                     = $datos_gasto_inmueble_detalle_venta['cod_administrador'];
		$cod_base_caja                                         = $datos_gasto_inmueble_detalle_venta['cod_base_caja'];
		$nombre_tipo_precio                                    = $datos_gasto_inmueble_detalle_venta['nombre_tipo_precio'];
		$nombre_tipo_precio_venta                              = $datos_gasto_inmueble_detalle_venta['nombre_tipo_precio_venta'];
		$cod_tipo_pago                                         = $datos_gasto_inmueble_detalle_venta['cod_tipo_pago'];
		$cod_tipo_forma_pago                                   = $datos_gasto_inmueble_detalle_venta['cod_tipo_forma_pago'];
		$nombre_tipo_factura                                   = $datos_gasto_inmueble_detalle_venta['nombre_tipo_factura'];
		$url_img_producto_min                                  = $datos_gasto_inmueble_detalle_venta['url_img_producto_min'];
		$url_img_producto_orig                                 = $datos_gasto_inmueble_detalle_venta['url_img_producto_orig'];
		$cod_dependencia                                       = $datos_gasto_inmueble_detalle_venta['cod_dependencia'];
		$comentario_producto                                   = $datos_gasto_inmueble_detalle_venta['comentario_producto'];
		$cod_dia_semana                                        = $datos_gasto_inmueble_detalle_venta['cod_dia_semana'];

		$agreg = "INSERT INTO tbl15_gasto_inmueble_detalle_venta_temporal (cod_tipo_estado_incluido, nombre_gasto_inmueble_detalle, descripcion_gasto_inmueble_detalle, costo_gasto_inmueble_detalle, 
		cod_gasto_inmueble, cod_cuentas_cobrar, cod_cuentas_cobrar_alerta, cod_cuentas_cobrar_abonos, cod_cuentas_cobrar_factura_comision_propietario, cod_tercero_propietario, fecha_gasto_inmueble_detalle, 
		fecha, fecha_mes, anyo, fecha_invert, fecha_seg, fecha_creacion, cod_producto, cod_producto_barra, cod_info_gasto_inmueble_detalle_venta, cod_factura, cod_tercero, cod_caja_virtual, 
		nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, total_venta_producto, precio_venta_producto_orig, und_producto, 
		fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, cod_base_caja, nombre_tipo_precio, 
		nombre_tipo_precio_venta, cod_tipo_forma_pago, url_img_producto_min, url_img_producto_orig, comentario_producto) 
		VALUES ('$cod_tipo_estado_incluido', '$nombre_gasto_inmueble_detalle', '$descripcion_gasto_inmueble_detalle', '$costo_gasto_inmueble_detalle', 
		'$cod_gasto_inmueble', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar_factura_comision_propietario', '$cod_tercero_propietario', '$fecha_gasto_inmueble_detalle', 
		'$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$fecha_creacion', '$cod_producto', '$cod_producto_barra', '$cod_info_gasto_inmueble_detalle_venta', '$cod_factura', '$cod_tercero', '$cod_caja_virtual', 
		'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$precio_venta_producto_orig', '$und_producto', 
		'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', '$cod_base_caja', '$nombre_tipo_precio', 
		'$nombre_tipo_precio_venta', '$cod_tipo_forma_pago', '$url_img_producto_min', '$url_img_producto_orig', '$comentario_producto')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

		$actualizar_sql1 = sprintf("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cuenta = '$cuenta', cod_caja_virtual = '$cod_caja_virtual', nombre_estado_factura = '$nombre_estado_factura' 
		WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
		$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

		$borrar_gasto_inmueble_detalle_venta = sprintf("DELETE FROM tbl15_gasto_inmueble_detalle_venta WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
		$Result1_gasto_inmueble_detalle_venta = mysqli_query($conectar, $borrar_gasto_inmueble_detalle_venta) or die(mysqli_error($conectar));

		$sql_gasto_inmueble_detalle_venta = "SELECT SUM(precio_venta_producto) AS total_gasto FROM tbl15_gasto_inmueble_detalle_venta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
		$consulta_gasto_inmueble_detalle_venta = mysqli_query($conectar, $sql_gasto_inmueble_detalle_venta) or die(mysqli_error($conectar));
		$datos_gasto_inmueble_detalle_venta = mysqli_fetch_assoc($consulta_gasto_inmueble_detalle_venta);

		$total_gasto                         = $datos_gasto_inmueble_detalle_venta['total_gasto'];
		//-------------------------------------- -----------------------------------------------------------------//
		$respuesta_ajax['llave']                                = $cod_gasto_inmueble_detalle_venta;
		$respuesta_ajax['cod_cuentas_cobrar_alerta']            = $cod_cuentas_cobrar_alerta;
		$respuesta_ajax['total_gasto']                          = number_format($total_gasto, 0, ",", ".");
		$respuesta_ajax['estado']                               = '1';
		$respuesta_ajax['total_datos_data']                     = 1;

		echo json_encode($respuesta_ajax);
	}
}
?>