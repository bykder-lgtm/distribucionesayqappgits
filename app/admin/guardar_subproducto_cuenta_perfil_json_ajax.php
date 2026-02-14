<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                     = $_SESSION['usuario'];
$tipo_ajax                                  = addslashes($_REQUEST['tipo_ajax']);
$campo                                      = addslashes($_REQUEST['campo']);

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'correo_cuenta_servicio') && ($tipo_ajax == 'tbl15_producto_sub')) {
	$correo_cuenta_servicio                            = addslashes($_REQUEST['valor']);
	$cod_producto_sub                                  = intval($_REQUEST['id']);

	$data_sql = ("UPDATE tbl15_producto_sub SET correo_cuenta_servicio = '$correo_cuenta_servicio' WHERE cod_producto_sub = '$cod_producto_sub'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'contrasena_cuenta_servicio') && ($tipo_ajax == 'tbl15_producto_sub')) {
	$contrasena_cuenta_servicio                        = addslashes($_REQUEST['valor']);
	$cod_producto_sub                                  = intval($_REQUEST['id']);

	$data_sql = ("UPDATE tbl15_producto_sub SET contrasena_cuenta_servicio = '$contrasena_cuenta_servicio' WHERE cod_producto_sub = '$cod_producto_sub'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'perfil_cuenta_servicio') && ($tipo_ajax == 'tbl15_producto_sub')) {
	$perfil_cuenta_servicio                            = addslashes($_REQUEST['valor']);
	$cod_producto_sub                                  = intval($_REQUEST['id']);

	$data_sql = ("UPDATE tbl15_producto_sub SET perfil_cuenta_servicio = '$perfil_cuenta_servicio' WHERE cod_producto_sub = '$cod_producto_sub'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'cod_estado') && ($tipo_ajax == 'tbl15_producto_sub')) {
	$cod_estado                                        = addslashes($_REQUEST['valor']);
	$cod_producto_sub                                  = intval($_REQUEST['id']);
	$cod_producto                                      = intval($_REQUEST['cod_producto']);

	$data_sql = ("UPDATE tbl15_producto_sub SET cod_estado = '$cod_estado' WHERE cod_producto_sub = '$cod_producto_sub'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	$sql_subproducto_habilitado = "SELECT * FROM tbl15_producto_sub WHERE (cod_producto = '$cod_producto') AND (cod_estado = '1')";
	$modificar_subproducto_habilitado = mysqli_query($conectar, $sql_subproducto_habilitado) or die(mysqli_error($conectar));
	$datos_subproducto_habilitado = mysqli_fetch_assoc($modificar_subproducto_habilitado);
	$total_datos = mysqli_num_rows($modificar_subproducto_habilitado);
	$und_producto = $total_datos;
    //$cod_factura                                  = $datos_adm['cod_factura'];
	$data_sql = ("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto = '$cod_producto'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';
	echo json_encode($respuesta_ajax);
}
?>