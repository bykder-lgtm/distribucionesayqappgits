<?php
if (isset($_GET['valor']) && isset($_GET['id'])) {
include_once('../conexiones/conexione.php'); 

$valor_intro = addslashes($_GET['valor']);
$cod_temporal_historia_clinica = intval($_GET['id']);
$campo = addslashes($_GET['campo']);

$data_sql = ("UPDATE temporal_historia_clinica SET $campo = '$valor_intro' WHERE cod_temporal_historia_clinica = '$cod_temporal_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
?>