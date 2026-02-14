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
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

$tipo_ajax                                  = $_REQUEST['tipo_ajax'];
$campo                                      = $_REQUEST['campo'];
$retorno_array                              = array();
$retorno_array2                             = array();
$respuesta_ajax                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';

if ($campo == 'identificacion_tercero') {
	$identificacion_tercero          = addslashes($_REQUEST['identificacion_tercero']);

	$sql_dato_tercero = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_dato_tercero = mysqli_query($conectar, $sql_dato_tercero) or die(mysqli_error($conectar));
	$info_dato_tercero = mysqli_fetch_assoc($consultar_dato_tercero);
	$existe_dato_tercero = mysqli_num_rows(@$consultar_dato_tercero);

    $identificacion_tercero               = $info_dato_tercero['identificacion_tercero'];
    $nombre1_tercero                      = $info_dato_tercero['nombre1_tercero'];
    $nombre2_tercero                      = $info_dato_tercero['nombre2_tercero'];
    $apellido1_tercero                    = $info_dato_tercero['apellido1_tercero'];
    $apellido2_tercero                    = $info_dato_tercero['apellido2_tercero'];
    $fecha_nac_tercero                    = $info_dato_tercero['fecha_nac_tercero'];
    $fecha_expedicion_tercero             = $info_dato_tercero['fecha_expedicion_tercero'];
    $telefono1_tercero                    = $info_dato_tercero['telefono1_tercero'];
    $correo_tercero                       = $info_dato_tercero['correo_tercero'];
    $direccion_tercero                    = $info_dato_tercero['direccion_tercero'];
    $nombre_tercero                       = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero);

	if($existe_dato_tercero > 0) {
		$resultado                        = $existe_dato_tercero;
		$mensaje                          = "<img src=../imagenes/advertencia.gif>EL DOCUMENTO: ".$identificacion_tercero." EXISTE EN LA LISTA (".$nombre_tercero.")<img src=../imagenes/advertencia.gif>";
	} else {
		$resultado                        = $existe_dato_tercero;
		$mensaje                          = "<img src=../imagenes/corecto.png>";
	}
	header('Content-Type: application/json');
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['resultado']                       = $resultado;
	$respuesta_ajax['identificacion_tercero']          = $identificacion_tercero;
	$respuesta_ajax['nombre1_tercero']                 = $nombre1_tercero;
	$respuesta_ajax['nombre2_tercero']                 = $nombre2_tercero;
	$respuesta_ajax['apellido1_tercero']               = $apellido1_tercero;
	$respuesta_ajax['apellido2_tercero']               = $apellido2_tercero;
	$respuesta_ajax['fecha_nac_tercero']               = $fecha_nac_tercero;
	$respuesta_ajax['fecha_expedicion_tercero']        = "";
	$respuesta_ajax['telefono1_tercero']               = "";
	$respuesta_ajax['correo_tercero']                  = "";
	$respuesta_ajax['direccion_tercero']               = "";
	$respuesta_ajax['mensaje']                         = $mensaje;
	$respuesta_ajax['ok_ajax']                         = '';

	echo json_encode($respuesta_ajax);
}
?>