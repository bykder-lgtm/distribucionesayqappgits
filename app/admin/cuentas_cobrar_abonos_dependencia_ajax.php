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
$cuenta_actual                    = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$valor_intro                      = addslashes($_GET['valor']);
$campo                            = addslashes($_GET['campo']);
$cod_cuentas_cobrar_abonos        = intval($_GET['id']);

if ($campo == 'cod_dependencia') {

$cod_dependencia = intval($valor_intro);

$data_sql = ("UPDATE tbl15_cuentas_cobrar_abonos SET cod_dependencia = '$cod_dependencia' WHERE cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'nombre_tipo_precio_venta') {

}

else {

}
?>