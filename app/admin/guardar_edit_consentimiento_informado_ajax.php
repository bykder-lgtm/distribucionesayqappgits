<?php
if (isset($_GET['valor']) && isset($_GET['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$valor_intro                     = addslashes($_GET['valor']);
$campo                           = addslashes($_GET['campo']);
$cod_consentimiento_informado    = intval($_GET['id']);

if ($campo=='fecha_ymd_hora') {

$fecha_ymd_hora                  = $valor_intro;
$fecha_time                      = strtotime($fecha_ymd_hora);
$fecha_ymd                       = date("Y-m-d", $fecha_time);
$fecha_mes                       = date("m-Y", $fecha_time);
$fecha_anyo                      = date("Y", $fecha_time);
$fecha_dmy                       = date("d-m-Y", $fecha_time);
$hora                            = date("H:i:s", $fecha_time);
$fecha_reg_time                  = time();

$data_sql = ("UPDATE tbl15_consentimiento_informado SET fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', fecha_mes = '$fecha_mes', 
fecha_anyo = '$fecha_anyo', fecha_dmy = '$fecha_dmy', fecha_reg_time = '$fecha_reg_time' 
WHERE cod_consentimiento_informado = '$cod_consentimiento_informado'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

} else {

$data_sql = ("UPDATE tbl15_consentimiento_informado SET $campo = '$valor_intro' WHERE cod_consentimiento_informado = '$cod_consentimiento_informado'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

}

}
?>