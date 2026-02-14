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
$cuenta_actual = addslashes($_SESSION['usuario']);

$valor_intro = strtoupper(addslashes($_GET['valor']));
$campo = addslashes($_GET['campo']);
$cod_cie10 = addslashes($_GET['id']);

$data_sql = ("UPDATE tbl15_cie10 SET $campo = '$valor_intro' WHERE cod_cie10 = '$cod_cie10'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
} else {
}
?>