<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                        = ($_SESSION['usuario']);
$tab                           = addslashes($_POST['tab']);
$tipo                          = addslashes($_POST['tipo']);
$campo                         = addslashes($_POST['campo']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_tercero') {
	$llave                         = intval($_POST['llave']);
	$cod_tercero                   = $llave;

	$sql_tercero = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
	$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

	$nombre_tipo_tercero                       = $datos_tercero['nombre_tipo_tercero'];
	$nombre_tipo_identificacion                = $datos_tercero['nombre_tipo_identificacion'];
	$identificacion_tercero                    = $datos_tercero['identificacion_tercero'];
	$digito_tercero                            = $datos_tercero['digito_tercero'];
	$nombre1_tercero                           = $datos_tercero['nombre1_tercero'];
	$nombre2_tercero                           = $datos_tercero['nombre2_tercero'];
	$apellido1_tercero                         = $datos_tercero['apellido1_tercero'];
	$apellido2_tercero                         = $datos_tercero['apellido2_tercero'];
	$fecha_nac_tercero                         = $datos_tercero['fecha_nac_tercero'];
	$direccion_tercero                         = $datos_tercero['direccion_tercero'];
	$telefono1_tercero                         = $datos_tercero['telefono1_tercero'];
	$telefono2_tercero                         = $datos_tercero['telefono2_tercero'];
	$correo_tercero                            = $datos_tercero['correo_tercero'];
	$nombre_pais                               = $datos_tercero['nombre_pais'];
	$nombre_departamento                       = $datos_tercero['nombre_departamento'];
	$nombre_ciudad                             = $datos_tercero['nombre_ciudad'];
	$nombre_tipo_cliente                       = $datos_tercero['nombre_tipo_cliente'];
	$nombre_tipo_regimen                       = $datos_tercero['nombre_tipo_regimen'];
	$nombre_tipo_impuesto                      = $datos_tercero['nombre_tipo_impuesto'];
	$contacto_tercero                          = $datos_tercero['contacto_tercero'];
	$fax_tercero                               = $datos_tercero['fax_tercero'];
	$observacion_tercero                       = $datos_tercero['observacion_tercero'];
	$fecha_creacion                            = $datos_tercero['fecha_creacion'];
	$fecha_modificacion                        = $datos_tercero['fecha_modificacion'];
	$nombre_sino                               = $datos_tercero['nombre_sino'];
	$cod_estado                                = $datos_tercero['cod_estado'];
	$cod_administrador                         = $datos_tercero['cod_administrador'];
	$fecha_pago                                = $datos_tercero['fecha_pago'];
	$monto_deuda                               = $datos_tercero['monto_deuda'];
	$monto_deuda_sin_interes                   = $datos_tercero['monto_deuda_sin_interes'];
	$subtotal                                  = $datos_tercero['subtotal'];
	$subtotal_sin_interes                      = $datos_tercero['subtotal_sin_interes'];
	$numero_cuota                              = $datos_tercero['numero_cuota'];
	$monto_cuota                               = $datos_tercero['monto_cuota'];
	$monto_cuota_sin_interes                   = $datos_tercero['monto_cuota_sin_interes'];
	$interes_ptj                               = $datos_tercero['interes_ptj'];
	$monto_deuda_mas_interes                   = $datos_tercero['monto_deuda_mas_interes'];
	$monto_cuota_interes                       = $datos_tercero['monto_cuota_interes'];
	$nombre_tipo_cobro                         = $datos_tercero['nombre_tipo_cobro'];

	$sql_data = "INSERT INTO tbl15_tercero_copia (cod_tercero, nombre_tipo_tercero, nombre_tipo_identificacion, identificacion_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, 
	apellido1_tercero, apellido2_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, telefono2_tercero, correo_tercero, nombre_pais, 
	nombre_departamento, nombre_ciudad, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, contacto_tercero, fax_tercero, observacion_tercero, 
	fecha_creacion, fecha_modificacion, nombre_sino, cod_estado, cod_administrador, fecha_pago, monto_deuda, monto_deuda_sin_interes, subtotal, 
	subtotal_sin_interes, numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, nombre_tipo_cobro) 
	VALUES ('$cod_tercero', '$nombre_tipo_tercero', '$nombre_tipo_identificacion', '$identificacion_tercero', '$digito_tercero', '$nombre1_tercero', '$nombre2_tercero', 
	'$apellido1_tercero', '$apellido2_tercero', '$fecha_nac_tercero', '$direccion_tercero', '$telefono1_tercero', '$telefono2_tercero', '$correo_tercero', '$nombre_pais', 
	'$nombre_departamento', '$nombre_ciudad', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$contacto_tercero', '$fax_tercero', '$observacion_tercero', 
	'$fecha_creacion', '$fecha_modificacion', '$nombre_sino', '$cod_estado', '$cod_administrador', fecha_pago, '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', 
	'$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$nombre_tipo_cobro')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_gasto_inmueble_detalle') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_gasto_inmueble_detalle_venta_temporal') {
	$cod_gasto_inmueble_detalle_venta_temporal          = intval($_POST['llave']);
	$cod_tipo_estado_incluido                           = 1;

	$sql_productos = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
	$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
	$cod_factura                                        = $datos_producto['cod_factura'];

	//$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$cod_gasto_inmueble_detalle_venta_temporal'");
	//$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_tipo_estado_incluido = '$cod_tipo_estado_incluido' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	header('Content-Type: application/json');

	$respuesta_ajax                                     = array();

	$sql_totales = "SELECT SUM(precio_compra_producto) AS total_precio_compra, SUM(precio_venta_producto) AS total_precio_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_factura = '$cod_factura') AND (cod_tipo_estado_incluido = '0')";
	$consulta_totales = mysqli_query($conectar, $sql_totales) or die(mysqli_error($conectar));
	$datos_totales = mysqli_fetch_assoc($consulta_totales);

	$total_precio_compra                               = $datos_producto['total_precio_compra'];
	$total_precio_venta                                = $datos_producto['total_precio_venta'];
	$total_gasto                                       = $total_precio_venta;
	$total_gasto_compra                                = $total_precio_compra;
	$total_gasto_venta                                 = $total_precio_venta;
	$total_gasto_ganancia                              = $total_gasto_venta - $total_gasto_compra;



	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	$respuesta_ajax['cod_cuentas_cobrar_alerta']       = $cod_cuentas_cobrar_alerta;
	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['total_gasto']                     = $total_gasto;
	$respuesta_ajax['total_gasto_format']              = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['total_gasto_compra_format']       = number_format($total_gasto_compra, 0, ",", ".");
	$respuesta_ajax['total_gasto_venta_format']        = number_format($total_gasto_venta, 0, ",", ".");
	$respuesta_ajax['total_gasto_ganancia_format']     = number_format($total_gasto_ganancia, 0, ",", ".");
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_alerta_cod_excluir_pago_propietario') {
$cod_cuentas_cobrar_alerta                          = intval($_POST['llave']);
$cod_tipo_estado_incluido                           = 1;

$sql_productos = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);

$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
$cod_factura                                        = $datos_producto['cod_factura'];

$data_sql = ("UPDATE tbl15_cuentas_cobrar_alerta SET cod_excluir_pago_propietario = '1' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

header('Content-Type: application/json');

$respuesta_ajax                                     = array();
$total_gasto                                        = 0;

if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
$respuesta_ajax['cod_cuentas_cobrar_alerta'] = $cod_cuentas_cobrar_alerta;
$respuesta_ajax['afectado']                  = $afectado;
$respuesta_ajax['total_gasto']               = $total_gasto;
$respuesta_ajax['total_gasto_format']        = number_format($total_gasto, 0, ",", ".");
$respuesta_ajax['mensaje']                   = 'Datos cargados correctamente.';

echo json_encode($respuesta_ajax);
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_alerta_cod_excluir_pago_propietario_excluido') {
$cod_cuentas_cobrar_alerta                          = intval($_POST['llave']);
$cod_tipo_estado_incluido                           = 1;

$sql_productos = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);

$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
$cod_factura                                        = $datos_producto['cod_factura'];

$data_sql = ("UPDATE tbl15_cuentas_cobrar_alerta SET cod_excluir_pago_propietario = '0' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

header('Content-Type: application/json');

$respuesta_ajax                                     = array();
$total_gasto                                        = 0;

if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
$respuesta_ajax['cod_cuentas_cobrar_alerta'] = $cod_cuentas_cobrar_alerta;
$respuesta_ajax['afectado']                  = $afectado;
$respuesta_ajax['total_gasto']               = $total_gasto;
$respuesta_ajax['total_gasto_format']        = number_format($total_gasto, 0, ",", ".");
$respuesta_ajax['mensaje']                   = 'Datos cargados correctamente.';

echo json_encode($respuesta_ajax);
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_historial_fecha_vencimiento') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_subproducto') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_administrador') {
$llave                         = intval($_POST['llave']);

$sql_infos_admin = "SELECT * FROM tbl15_administrador WHERE ($campo = '$llave')";
$resultado_infos_admin = mysqli_query($conectar, $sql_infos_admin);
$info_infos_admin = mysqli_fetch_assoc($resultado_infos_admin);

$cod_administrador             = $info_infos_admin['cod_administrador'];
$cedula                        = $info_infos_admin['cedula'];
$nombres                       = $info_infos_admin['nombres'];
$apellidos                     = $info_infos_admin['apellidos'];
$nombre_sexo                   = $info_infos_admin['nombre_sexo'];
$cuenta                        = $info_infos_admin['cuenta'];
$contrasena                    = $info_infos_admin['contrasena'];
$creador                       = $info_infos_admin['creador'];
$correo                        = $info_infos_admin['correo'];
$telefono                      = $info_infos_admin['telefono'];
$cod_seguridad                 = $info_infos_admin['cod_seguridad'];
$cod_tipo_historia_clinica     = $info_infos_admin['cod_tipo_historia_clinica'];
$tamano_font                   = $info_infos_admin['tamano_font'];
$url_img_foto_prof_min         = $info_infos_admin['url_img_foto_prof_min'];
$url_img_foto_prof_orig        = $info_infos_admin['url_img_foto_prof_orig'];
$url_img_firma_prof_min        = $info_infos_admin['url_img_firma_prof_min'];
$url_img_firma_prof_ori        = $info_infos_admin['url_img_firma_prof_ori'];
$estilo_css                    = $info_infos_admin['estilo_css'];
$especialidad                  = $info_infos_admin['especialidad'];
$especialidad2                 = $info_infos_admin['especialidad2'];
$universidad                   = $info_infos_admin['universidad'];
$departamento                  = $info_infos_admin['departamento'];
$ciudad                        = $info_infos_admin['ciudad'];
$reg_medico                    = $info_infos_admin['reg_medico'];
$licencia                      = $info_infos_admin['licencia'];
$tarjeta_profesional           = $info_infos_admin['tarjeta_profesional'];
$chip                          = $info_infos_admin['chip'];
$fecha                         = $info_infos_admin['fecha'];
$fecha_hora                    = $info_infos_admin['fecha_hora'];
$total_base_cierre_caja        = $info_infos_admin['total_base_cierre_caja'];
$url_redsocial_facebook        = $info_infos_admin['url_redsocial_facebook'];
$url_redsocial_twitter         = $info_infos_admin['url_redsocial_twitter'];
$url_redsocial_linkedin        = $info_infos_admin['url_redsocial_linkedin'];
$url_redsocial_skype           = $info_infos_admin['url_redsocial_skype'];
$url_redsocial_generic1        = $info_infos_admin['url_redsocial_generic1'];
$url_redsocial_generic2        = $info_infos_admin['url_redsocial_generic2'];
$url_redsocial_generic3        = $info_infos_admin['url_redsocial_generic3'];
$cod_caja_virtual              = $info_infos_admin['cod_caja_virtual'];
$cod_caja                      = $info_infos_admin['cod_caja'];
$nombre_maquina                = $info_infos_admin['nombre_maquina'];
$nombre_impresora              = $info_infos_admin['nombre_impresora'];
$tamano_papel_impresora        = $info_infos_admin['tamano_papel_impresora'];
$cod_estado                    = $info_infos_admin['cod_estado'];

$sql_data = "INSERT INTO tbl15_administrador_copia (cod_administrador, cedula, nombres, apellidos, nombre_sexo, cuenta, contrasena, creador, correo, telefono, cod_seguridad, cod_tipo_historia_clinica, 
tamano_font, url_img_foto_prof_min, url_img_foto_prof_orig, url_img_firma_prof_min, url_img_firma_prof_ori, estilo_css, especialidad, especialidad2, universidad, 
departamento, ciudad, reg_medico, licencia, tarjeta_profesional, chip, fecha, fecha_hora, total_base_cierre_caja, url_redsocial_facebook, 
url_redsocial_twitter, url_redsocial_linkedin, url_redsocial_skype, url_redsocial_generic1, url_redsocial_generic2, url_redsocial_generic3, 
cod_caja_virtual, cod_caja, nombre_maquina, nombre_impresora, tamano_papel_impresora, cod_estado) 
VALUES ('$cod_administrador', '$cedula', '$nombres', '$apellidos', '$nombre_sexo', '$cuenta', '$contrasena', '$creador', '$correo', '$telefono', '$cod_seguridad', '$cod_tipo_historia_clinica', 
'$tamano_font', '$url_img_foto_prof_min', '$url_img_foto_prof_orig', '$url_img_firma_prof_min', '$url_img_firma_prof_ori', '$estilo_css', '$especialidad', '$especialidad2', '$universidad', 
'$departamento', '$ciudad', '$reg_medico', '$licencia', '$tarjeta_profesional', '$chip', '$fecha', '$fecha_hora', '$total_base_cierre_caja', '$url_redsocial_facebook', 
'$url_redsocial_twitter', '$url_redsocial_linkedin', '$url_redsocial_skype', '$url_redsocial_generic1', '$url_redsocial_generic2', '$url_redsocial_generic3', 
'$cod_caja_virtual', '$cod_caja', '$nombre_maquina', '$nombre_impresora', '$tamano_papel_impresora', '$cod_estado')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("UPDATE $tab SET cod_estado = '0', cod_estado_activacion_usuario = '3' WHERE $campo = '$llave'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_plan_terapeutico') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_auxiliar_pasante') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_cie10diag') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_historia_clinica') {
$llave                         = intval($_POST['llave']);

$sql_data = "INSERT INTO tbl15_historia_clinica_copia SELECT * FROM tbl15_historia_clinica WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'historia_clinica_cita') {
$llave                         = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM tbl15_historia_clinica WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_manipulacion_alimento') {
$llave                         = intval($_POST['llave']);

$sql_data = "INSERT INTO tbl15_manipulacion_alimento_copia SELECT * FROM tbl15_manipulacion_alimento WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_trabajo_altura') {
$llave                        = intval($_POST['llave']);

$sql_data = "INSERT INTO tbl15_trabajo_altura_copia SELECT * FROM tbl15_trabajo_altura WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_cliente') {
$llave                        = intval($_POST['llave']);

$sql_data = "INSERT INTO tbl15_cliente_copia SELECT * FROM tbl15_cliente WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_grupo_area_cargo') {
$llave                        = intval($_POST['llave']);

$sql_data = "INSERT INTO tbl15_grupo_area_cargo_copia SELECT * FROM tbl15_grupo_area_cargo WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_empresa') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_empresa_contratante') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_escolaridad') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_estado_civil') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_fondo_pension') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_informe_condiciones_salud') {
$llave                        = intval($_POST['llave']);

//$sql_data = "INSERT INTO tbl15_informe_condiciones_salud_copia SELECT * FROM tbl15_informe_condiciones_salud WHERE $campo = '$llave'";
//$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_remision') {
$llave                        = intval($_POST['llave']);

$sql_data = "INSERT INTO tbl15_tbl15_remision_copiaSELECT * FROM tbl15_remision WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_entidad') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_actividad_ecoemp') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_administrador') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("UPDATE $tab SET cod_estado = '0', cod_estado_activacion_usuario = '3' WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_grupo_rh') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_numero_hijos') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_raza') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_religion') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_sexo') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_arl') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_tipo_regimen') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_tipo_doc') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_venta_producto_temporal') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT * FROM $tab WHERE (cuenta = '$cuenta')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == '0') {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE (cuenta = '$cuenta') AND (cod_estado_factura = '1')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysql_error());
}

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
elseif ($tipo == 'eliminar' && $tab == 'tbl15_venta_producto') {
$llave                        = intval($_POST['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>