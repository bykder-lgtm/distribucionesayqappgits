<?php
if (isset($_REQUEST['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cod_auxiliar_pasante            = intval($_REQUEST['id']);
$cod_historia_clinica            = intval($_REQUEST['cod_historia_clinica']);
$cod_administrador               = intval($_REQUEST['cod_administrador']);
$campo                           = ($_REQUEST['campo']);

$fecha_mes                       = date("Y-m");
$fecha_anyo                      = date("Y");
$fecha_ymd                       = date("Y-m-d");
$fecha_dmy                       = date("d-m-Y");
$fecha_time                      = time();
$fecha_reg_time                  = time();
$cuenta                          = $_SESSION['usuario'];
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
if (isset($_REQUEST['cod_cliente']) <> '') { $cod_cliente = intval($_REQUEST['cod_cliente']); } else { $cod_cliente = '0'; }
/* -------------------------------------------------------------------------------------------------------------- */
if ($campo=='auxiliar_pasante_hist_clinic') {

$sql_producto = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);
 	 	 
$doc_auxiliar_pasante            = $datos_producto['cedula'];
$nombres                         = $datos_producto['nombres'];
$apellidos                       = $datos_producto['apellidos'];
$nombre_auxiliar_pasante         = $nombres.' '.$apellidos;

$data_sql = ("UPDATE tbl15_auxiliar_pasante SET cod_administrador = '$cod_administrador', doc_auxiliar_pasante = '$doc_auxiliar_pasante', nombre_auxiliar_pasante = '$nombre_auxiliar_pasante',
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_ymd = '$fecha_ymd', fecha_dmy = '$fecha_dmy', fecha_time = '$fecha_time', fecha_reg_time = '$fecha_reg_time', cuenta = '$cuenta'
WHERE cod_auxiliar_pasante = '$cod_auxiliar_pasante'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
else {
$data_sql = ("UPDATE tbl15_historia_clinica SET $campo = '$valor_intro' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
}
?>