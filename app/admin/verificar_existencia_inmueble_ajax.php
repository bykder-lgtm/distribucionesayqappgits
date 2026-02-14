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

$tipo_ajax                   = $_REQUEST['tipo_ajax'];
$campo                       = $_REQUEST['campo'];

if ($campo == 'cod_inmueble_barra') {
$cod_inmueble_barra          = addslashes($_REQUEST['cod_inmueble_barra']);

$obtener_entidad = "SELECT nombre_inmueble FROM tbl15_inmueble WHERE cod_inmueble_barra = '".($cod_inmueble_barra)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$existe_inmueble = mysqli_num_rows(@$consultar_entidad);
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

if($existe_inmueble > 0) {
$nombre_inmueble             = $info_entidad['nombre_inmueble'];
echo "<img src=../imagenes/advertencia.gif>EL CODIGO: ".$cod_inmueble_barra." YA EXISTE. (".$nombre_inmueble.")<img src=../imagenes/advertencia.gif>";
} else {
echo "<img src=../imagenes/corecto.png>";
}

}
?>