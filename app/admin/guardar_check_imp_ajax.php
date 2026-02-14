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
$id                              = addslashes($_REQUEST['id']);
$campo                           = addslashes($_REQUEST['campo']);
$valor_intro                     = addslashes($_REQUEST['valor']);
/* -------------------------------------------------------------------------------------------------------------- */
if ($campo == 'cod_check_imp') { 
$fragmentador                    = explode('__', $id);
$cod_venta_producto_temporal     = $fragmentador[1];
$cod_check_imp                   = $valor_intro;

$data_sql = ("UPDATE tbl15_venta_producto_temporal SET cod_check_imp = '$cod_check_imp' WHERE (cod_venta_producto_temporal = '$cod_venta_producto_temporal')");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo == 'seleccionar_todos') { 
$cod_info_factura_venta          = $id;
$cod_check_imp                   = $valor_intro;

$data_sql = ("UPDATE tbl15_venta_producto_temporal SET cod_check_imp = '$cod_check_imp' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
else {
}
/* -------------------------------------------------------------------------------------------------------------- */
}
?>