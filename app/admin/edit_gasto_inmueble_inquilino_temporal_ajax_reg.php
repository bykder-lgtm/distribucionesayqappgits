<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
header('Content-Type: application/json');

$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_gasto_inmueble_inquilino_venta_temporal          = intval($_GET['id']);
$valor_intro                                        = addslashes($_GET['valor']);
$campo                                              = addslashes($_GET['campo']);
$respuesta_ajax                                     = array();

$sql_productos = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);

$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
$cod_factura                                        = $datos_producto['cod_factura'];
$precio_compra_producto                             = $datos_producto['precio_compra_producto'];
$precio_venta_producto                              = $datos_producto['precio_venta_producto'];


if ($campo == 'descripcion_gasto_inmueble_detalle') {

	$descripcion_gasto_inmueble_detalle          = addslashes($valor_intro); 

	$data_sql = ("UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET descripcion_gasto_inmueble_detalle = UPPER('$descripcion_gasto_inmueble_detalle') WHERE cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$sql_productos = "SELECT SUM(precio_compra_producto) AS total_precio_compra, SUM(precio_venta_producto) AS total_precio_venta FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE cod_factura = '$cod_factura'";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$total_precio_compra                               = $datos_producto['total_precio_compra'];
	$total_precio_venta                                = $datos_producto['total_precio_venta'];
	$total_gasto                                       = $total_precio_venta;
	$total_gasto_compra                                = $total_precio_compra;
	$total_gasto_venta                                 = $total_precio_venta;
	$total_gasto_ganancia                              = $total_gasto_venta - $total_gasto_compra;

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['total_gasto']                     = $total_gasto;
	$respuesta_ajax['total_gasto_format']              = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['total_gasto_compra_format']       = number_format($total_gasto_compra, 0, ",", ".");
	$respuesta_ajax['total_gasto_venta_format']        = number_format($total_gasto_venta, 0, ",", ".");
	$respuesta_ajax['total_gasto_ganancia_format']     = number_format($total_gasto_ganancia, 0, ",", ".");
	$respuesta_ajax['emisor']                          = 'descripcion_gasto_inmueble_detalle';
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
elseif ($campo == 'precio_venta_producto') {

	$precio_venta_producto                             = intval($valor_intro);
	$ganancia                                          = $precio_venta_producto - $precio_compra_producto;

	$data_sql = ("UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET precio_venta_producto = '$precio_venta_producto' WHERE cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$sql_productos = "SELECT SUM(precio_compra_producto) AS total_precio_compra, SUM(precio_venta_producto) AS total_precio_venta FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_factura = '$cod_factura') AND (cod_tipo_estado_incluido = '0')";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$total_precio_compra                               = $datos_producto['total_precio_compra'];
	$total_precio_venta                                = $datos_producto['total_precio_venta'];
	$total_gasto                                       = $total_precio_venta;
	$total_gasto_compra                                = $total_precio_compra;
	$total_gasto_venta                                 = $total_precio_venta;
	$total_gasto_ganancia                              = $total_gasto_venta - $total_gasto_compra;

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['total_gasto']                     = $total_gasto;
	$respuesta_ajax['total_gasto_format']              = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['total_gasto_compra_format']       = number_format($total_gasto_compra, 0, ",", ".");
	$respuesta_ajax['total_gasto_venta_format']        = number_format($total_gasto_venta, 0, ",", ".");
	$respuesta_ajax['total_gasto_ganancia_format']     = number_format($total_gasto_ganancia, 0, ",", ".");
	$respuesta_ajax['ganancia_format']                 = number_format($ganancia , 0, ",", ".");
	$respuesta_ajax['emisor']                          = 'precio_venta_producto';
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
elseif ($campo == 'precio_compra_producto') {

	$precio_compra_producto                            = intval($valor_intro);
	$ganancia                                          = $precio_venta_producto - $precio_compra_producto;

	$data_sql = ("UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET precio_compra_producto = '$precio_compra_producto' WHERE cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$sql_productos = "SELECT SUM(precio_compra_producto) AS total_precio_compra, SUM(precio_venta_producto) AS total_precio_venta FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_factura = '$cod_factura') AND (cod_tipo_estado_incluido = '0')";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$total_precio_compra                               = $datos_producto['total_precio_compra'];
	$total_precio_venta                                = $datos_producto['total_precio_venta'];
	$total_gasto                                       = $total_precio_venta;
	$total_gasto_compra                                = $total_precio_compra;
	$total_gasto_venta                                 = $total_precio_venta;
	$total_gasto_ganancia                              = $total_gasto_venta - $total_gasto_compra;

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['total_gasto']                     = $total_gasto;
	$respuesta_ajax['total_gasto_format']              = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['total_gasto_compra_format']       = number_format($total_gasto_compra, 0, ",", ".");
	$respuesta_ajax['total_gasto_venta_format']        = number_format($total_gasto_venta, 0, ",", ".");
	$respuesta_ajax['total_gasto_ganancia_format']     = number_format($total_gasto_ganancia, 0, ",", ".");
	$respuesta_ajax['ganancia_format']                 = number_format($ganancia , 0, ",", ".");
	$respuesta_ajax['emisor']                          = 'precio_compra_producto';
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
else {

	$valor_intro                          = addslashes($valor_intro);

	$data_sql = ("UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET $campo = '$valor_intro' WHERE cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
}
?>