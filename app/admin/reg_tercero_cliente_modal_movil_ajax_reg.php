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
$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);
//$cuenta                                     = $_SESSION['usuario'];

$retorno_array                                                      = array();
$retorno_array2                                                     = array();
$codigoHTML_menu                                                    = '';
$codigoHTML_menu_total_reg                                          = '';
$respuesta_ajax                                                     = array();

if (isset($_POST['identificacion_tercero'])) {
	$identificacion_tercero                                         = intval($_POST['identificacion_tercero']);
	$nombre1_tercero                                                = trim(addslashes($_POST['nombre1_tercero']));
	$nombre2_tercero                                                = trim(addslashes($_POST['nombre2_tercero']));
	$apellido1_tercero                                              = trim(addslashes($_POST['apellido1_tercero']));
	$apellido2_tercero                                              = trim(addslashes($_POST['apellido2_tercero']));
	$telefono1_tercero                                              = trim(addslashes($_POST['telefono1_tercero']));
	$correo_tercero                                                 = trim(addslashes($_POST['correo_tercero']));
	$direccion_tercero                                              = trim(addslashes($_POST['direccion_tercero']));
	$nombre_estado_civil                                            = trim(addslashes($_POST['nombre_estado_civil']));
	$nombres_apellidos_tercero                                      = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

    $accion_soportes                                                = 'REFRESCAR_PAGINA';
	$fecha_creacion                                                 = date("Y-m-d H:i:s");
    $direccion_contacto1                                            = $_SERVER["REMOTE_ADDR"];
	$tel_contacto1                                                  = $cuenta_actual;
	$cod_estado_cliente                                             = 1;
	$fecha_anyo                                                     = date("Y-m-d", strtotime($fecha_creacion));
	$fecha_seg       	                                            = time();
	$fecha_mes	                                                    = date("Y-m", strtotime($fecha_creacion));
	$anyo		                                                    = date("Y", strtotime($fecha_creacion));
	$fecha	                                                        = $fecha_creacion;
	$fecha_invert	                                                = $fecha_creacion;
	$hora	                                                        = date("H:i:s");
	$cuenta                                                         = $cuenta_actual;
	$vendedor                                                       = $cuenta_actual;
	$cod_dependencia                                                = 1;
	$nombre_maquina                                                 = gethostname();
	$fecha_ymd                                                      = $fecha_creacion;
	$fecha_anyo_seg                                                 = strtotime($fecha_anyo);
	$fecha_dia                                                      = date("Y-m-d", $fecha_anyo_seg);
	$fecha_hora_venta_producto                                      = date("H:i:s");
	$nombre_tipo_moneda                                             = "COP";
	$cod_tipo_pago                                                  = 2;
	$cod_tipo_forma_pago                                            = 22;
	$cod_tipo_nota_observacion                                      = 20;
	$codigo_estado_revision                                         = 0;
	$fecha_ymd_venta_producto                                       = date("Y-m-d");
	$fecha_mes_venta_producto                                       = date("Y-m");
	$fecha_anyo_venta_producto                                      = date("Y");
	$fecha_seg_venta_producto                                       = time();
	$cod_estado_factura                                             = '1';
	$fecha_hora                                                     = date("H:i:s");
	$fecha_ymdhis                                                   = date("Y-m-d H:i:s");
	$nombre_estado_factura                                          = 'ABIERTA';
	$cod_tipo_pago                                                  = "2";
	$cod_caja_virtual                                               = 1;
	$cod_base_caja                                                  = 1;
	$cod_resolucion_facturacion                                     = 1;
	$codigo_estado_facturacion                                      = 0;
	$cod_estado_facturacion                                         = 0;
	$nombre_tipo_tercero                                            = "CLIENTE";
	$nombre_tipo_tercero_modulo_creacion                            = "CLIENTE_MODAL_MOVIL";
	$nombre_tipo_identificacion                                     = "CC";
	$und_venta                                                      = 1;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_factura_venta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
	$exec_autoincremento_info_factura_venta = mysqli_query($conectar, $sql_autoincremento_info_factura_venta) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura_venta = mysqli_fetch_assoc($exec_autoincremento_info_factura_venta);

	$cod_info_factura_venta                                         = $datos_autoincremento_info_factura_venta['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_tercero = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_dato_tercero = mysqli_query($conectar, $sql_dato_tercero) or die(mysqli_error($conectar));
	$info_dato_tercero = mysqli_fetch_assoc($consultar_dato_tercero);
	$existe_dato_tercero = mysqli_num_rows(@$consultar_dato_tercero);

	$cod_tercero                                                    = intval($info_dato_tercero['cod_tercero']);
   	$cod_tercero_codif                                              = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
	$cod_tercero_codifcryp                                          = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_administrador = "SELECT cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico, cod_tienda FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$resultado_administrador = mysqli_query($conectar, $obtener_administrador) or die(mysqli_error($conectar));
	$info_administrador = mysqli_fetch_assoc($resultado_administrador);

	$cod_lider                                                      = $info_administrador['cod_lider'];
	$cod_coordinador                                                = $info_administrador['cod_coordinador'];
	$cod_asesor                                                     = $info_administrador['cod_asesor'];
	$cod_aliado_estrategico                                         = $cod_administrador;
	$cod_tienda                                                     = $info_administrador['cod_tienda'];

	$cod_administrador_lider                                        = $cod_lider;
	$cod_administrador_coordinador                                  = $cod_coordinador;
	$cod_administrador_asesor                                       = $cod_asesor;
	$cod_administrador_aliado_estrategico                           = $cod_aliado_estrategico;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_lider = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_lider'";
	$resultado_lider = mysqli_query($conectar, $obtener_lider) or die(mysqli_error($conectar));
	$info_lider = mysqli_fetch_assoc($resultado_lider);

	$lider_comision_ptj                                             = $info_lider['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_coordinador = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_coordinador'";
	$resultado_coordinador = mysqli_query($conectar, $obtener_coordinador) or die(mysqli_error($conectar));
	$info_coordinador = mysqli_fetch_assoc($resultado_coordinador);

	$coordinador_comision_ptj                                       = $info_coordinador['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_asesor = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_asesor'";
	$resultado_asesor = mysqli_query($conectar, $obtener_asesor) or die(mysqli_error($conectar));
	$info_asesor = mysqli_fetch_assoc($resultado_asesor);

	$asesor_comision_ptj                                            = $info_asesor['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_tercero > 0) {

    } else {
		$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
		$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
		$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

		$cod_tercero                                                = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	   	$cod_tercero_codif                                          = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
    	$cod_tercero_codifcryp                                      = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);

		$sql_data = "INSERT INTO tbl15_tercero (cod_tercero, nombre_tipo_tercero, nombre_tipo_tercero_modulo_creacion, nombre_tipo_identificacion, identificacion_tercero, 
		nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, telefono1_tercero, correo_tercero, direccion_tercero, 
		nombre_estado_civil, fecha_creacion, cod_administrador, cod_estado_cliente, nombres_apellidos_tercero) 
		VALUES ('$cod_tercero', '$nombre_tipo_tercero', '$nombre_tipo_tercero_modulo_creacion', '$nombre_tipo_identificacion', '$identificacion_tercero', 
		UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), '$telefono1_tercero', '$correo_tercero', '$direccion_tercero', 
		'$nombre_estado_civil', '$fecha_creacion', '$cod_administrador', '$cod_estado_cliente', UPPER('$nombres_apellidos_tercero'))";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
/*
	$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_tipo_forma_pago, cod_administrador, nombre_tipo_moneda, cod_tercero, cod_base_caja, fecha_creacion, 
	cod_resolucion_facturacion, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, telefono1_tercero, 
	correo_tercero, direccion_tercero, cod_tienda, cod_administrador_lider, cod_administrador_coordinador, cod_administrador_asesor, cod_administrador_aliado_estrategico) 
	VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$codigo_estado_facturacion', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$cod_administrador', '$nombre_tipo_moneda', '$cod_tercero', '$cod_base_caja', '$fecha_creacion', 
	'$cod_resolucion_facturacion', '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), '$telefono1_tercero', 
	'$correo_tercero', '$direccion_tercero', '$cod_tienda', '$cod_administrador_lider', '$cod_administrador_coordinador', '$cod_administrador_asesor', '$cod_administrador_aliado_estrategico')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, und_venta, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, 
	fecha_seg_venta_producto, cuenta, cod_administrador, cod_caja_virtual, cod_base_caja) 
	VALUES ('$cod_info_factura_venta', '$cod_tercero', '$und_venta', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', 
	'$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', '$cod_caja_virtual', '$cod_base_caja')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
*/
	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                    = $afectado;
	$respuesta_ajax['cod_info_factura_venta']      = $cod_info_factura_venta;
	$respuesta_ajax['cod_tercero']                 = $cod_tercero;
	$respuesta_ajax['accion_soportes']             = $accion_soportes;
	$respuesta_ajax['mensaje']                     = 'Hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>