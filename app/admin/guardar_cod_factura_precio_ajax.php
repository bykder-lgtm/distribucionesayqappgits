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
$valor_intro            = $_GET['valor'];
$campo                  = addslashes($_GET['campo']);
$cod_historia_clinica   = intval($_GET['id']);

if($campo == 'cod_factura') {
$cod_factura = intval($valor_intro);
$data_sql = ("UPDATE tbl15_historia_clinica SET cod_factura = '$cod_factura' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
if($campo == 'costo_motivo_consulta') {
$costo_motivo_consulta = intval($valor_intro);
$data_sql = ("UPDATE tbl15_historia_clinica SET costo_motivo_consulta = '$costo_motivo_consulta' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}

}
?>