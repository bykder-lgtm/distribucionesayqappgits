<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php
if (isset($_GET['cuenta'])) {
$cuenta                                       = addslashes($_GET['cuenta']);
$cod_caja_virtual                             = addslashes($_GET['cod_caja_virtual']);
$cod_check_imp                                = '1';

$cod_estado_factura                           = '1';
$fecha_dia                                    = date("Y-m-d");
$fecha_mes                                    = date("Y-m");
$fecha_anyo                                   = date("Y-m-d");
$anyo                                         = date("Y");
$fecha_hora                                   = date("H:i:s");
$cod_tipo_pago                                = '1';
$fecha_ymdhis                                 = date("Y-m-d H:is");
$cod_tercero                                  = '1';
$nombre_estado_factura                        = 'ABIERTA';
$cod_tipo_forma_pago                          = "1";
$nombre_tipo_moneda                           = "COP";
$nombre_tipo_factura                          = "POS";
$cod_base_caja                                = "1";
$pagina                                       = addslashes($_GET['pagina']);
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;

$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, 
nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_prioridad, cod_base_caja) 
VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', 
'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_prioridad', '$cod_base_caja')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>