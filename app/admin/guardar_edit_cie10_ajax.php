<?php
if (isset($_REQUEST['valor']) && isset($_REQUEST['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$valor_intro                     = addslashes($_REQUEST['valor']);
$campo                           = addslashes($_REQUEST['campo']);
$cod_cie10                       = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_cie10 SET $campo = '$valor_intro' WHERE cod_cie10 = '$cod_cie10'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

}
?>