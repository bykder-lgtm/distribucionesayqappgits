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
$valor_intro                 = addslashes($_GET['valor']);
$campo                       = addslashes($_GET['campo']);
$cod_medicamento_formulado   = intval($_GET['id']);


$data_sql = ("UPDATE tbl15_medicamento_formulado SET $campo = '$valor_intro' WHERE cod_medicamento_formulado = '$cod_medicamento_formulado'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
?>