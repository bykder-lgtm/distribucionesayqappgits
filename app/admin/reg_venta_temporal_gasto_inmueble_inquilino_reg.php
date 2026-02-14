<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
if (isset($_GET['cod_gasto_inmueble'])) {


$cod_gasto_inmueble                           = addslashes($_GET['cod_gasto_inmueble']);
$nombre_tipo_moneda                           = addslashes($_GET['nombre_tipo_moneda']);
$nombre_tipo_factura                          = addslashes($_GET['nombre_tipo_factura']);
$foco                                         = addslashes($_GET['foco']);
$cod_estado_vacuna                            = intval($_GET['cod_estado_vacuna']);
$buscar_por                                   = addslashes($_GET['buscar_por']);
$cuenta                                       = addslashes($_GET['cuenta']);
$cod_caja_virtual                             = addslashes($_GET['cod_caja_virtual']);
$cod_factura                                 = intval($_GET['cod_factura']);
$cod_check_imp                                = '1';
$cod_tipo_metodo_envio                        = '1';
$cod_base_caja                                = ($_SESSION['cod_base_caja']);


if (isset($_GET['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_GET['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '0'; }
if ($cod_gasto_inmueble == '55555555') { $cod_estado_cava = 1; } else { $cod_estado_cava = 0; }

$sql_gasto_inmueble = "SELECT * FROM tbl15_gasto_inmueble WHERE (cod_gasto_inmueble = '$cod_gasto_inmueble')";
$consulta_gasto_inmueble = mysqli_query($conectar, $sql_gasto_inmueble) or die(mysqli_error($conectar));
$existe_gasto_inmueble = mysqli_num_rows($consulta_gasto_inmueble);
$datos_gasto_inmueble = mysqli_fetch_assoc($consulta_gasto_inmueble);

$cod_gasto_inmueble                 = $datos_gasto_inmueble['cod_gasto_inmueble'];
$nombre_gasto_inmueble_detalle      = $datos_gasto_inmueble['nombre_gasto_inmueble'];

$fecha_gasto_inmueble_detalle 	    = date("Y-m-d");
$fecha 	                            = date("Y-m-d");
$fecha_mes 	                        = date("Y-m");
$anyo 	                            = date("Y");
$fecha_invert 	                    = date("Y-m-d");
$fecha_seg 	                        = time();
$fecha_creacion 	                = date("Y-m-d H:i:s");

$fecha_ymd_venta_producto           = date("Y-m-d");
$fecha_mes_venta_producto           = date("Y-m");
$fecha_anyo_venta_producto          = date("Y");
$fecha_seg_venta_producto           = time();
//$cuenta                             = $cuenta_actual;
$cod_estado_factura                 = '1';
$descuento_ptj                      = '0';
$flete_ptj                          = '0';
$vlr_cancelado                      = '';
$vlr_vuelto                         = '';
$fecha_dia                          = strtotime(date("Y/m/d"));
$fecha_mes                          = date("Y-m");
$fecha_anyo                         = date("Y-m-d");
$anyo                               = date("Y");
$fecha_hora                         = date("H:i:s");
$fecha_remision                     = date("Y-m-d");
$nombre_ccosto                      = '';
$garantia_meses                     = '';
$observacion                        = '';
$cod_empresa                        = '0';
$fecha_ymdhis                       = date("Y-m-d H:is");
$cod_tipo_cobrar                    = '1';
$cod_tercero                        = '1';
$nombre_estado_factura              = 'ABIERTA';
$cod_tipo_pago                      = "1";
$cod_tipo_forma_pago                = "1";

$und_venta                          = "1";
$cod_tipo_inventario                = "1";
$cod_estado_revisado                = "0";
$cod_estado_timbre_entrada          = "0";

$pagina = addslashes($_GET['pagina'])."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&pagina=facturacion_venta_temporal_producto_manual_pos.php";

$sql_info = "SELECT * FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info = mysqli_query($conectar, $sql_info) or die(mysqli_error($conectar));
$factura_abierta = mysqli_num_rows($consulta_info);
$datos_info = mysqli_fetch_assoc($consulta_info);

if (($cod_estado_venta_prod_en_cero_global <> '0') && ($und_producto <= '0')) { ?>
<table class="table table-striped">
<tr>
<th style="text-align:center"><a href="<?php echo $pagina?>"><h3>Regresar</h3></a></th>
</tr>
<tr>
<th style="text-align:center"><h4><img src=../imagenes/advertencia.gif alt='Advertencia'>EL PRODUCTO NO TIENE UNIDADES DISPONIBLES PARA VENDER<img src=../imagenes/advertencia.gif alt='Advertencia'></h4></th>
</tr>
<tr>
<th style="text-align:center"><h4><?php echo $nombre_producto.' | '.$cod_gasto_inmueble ?></h4></th>
</tr>
</table>
<?php
} else {

if ($existe_gasto_inmueble > '0') {
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
if ($factura_abierta == '0') {

$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;

$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_gasto_inmueble_inquilino_venta'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_gasto_inmueble_inquilino_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_info_gasto_inmueble_inquilino_venta (cod_info_gasto_inmueble_inquilino_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_factura) 
VALUES ('$cod_info_gasto_inmueble_inquilino_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$cod_factura')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = "INSERT INTO tbl15_gasto_inmueble_inquilino_venta_temporal (cod_info_gasto_inmueble_inquilino_venta, nombre_gasto_inmueble_detalle, cod_gasto_inmueble,  
fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
cod_administrador, cod_caja_virtual, fecha_gasto_inmueble_detalle, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, fecha_creacion, und_venta, cod_factura) 
VALUES ('$cod_info_gasto_inmueble_inquilino_venta', '$nombre_gasto_inmueble_detalle', '$cod_gasto_inmueble',  
'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
'$cod_administrador', '$cod_caja_virtual', '$fecha_gasto_inmueble_detalle', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$fecha_creacion', '$und_venta', '$cod_factura')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
else { 

	$sql_info_factura = "SELECT cod_info_gasto_inmueble_inquilino_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto 
	FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
	$datos_info_factura = mysqli_fetch_assoc($consulta_info_factura);

	$cod_info_gasto_inmueble_inquilino_venta             = $datos_info_factura['cod_info_gasto_inmueble_inquilino_venta'];
	$cod_tercero                                       = $datos_info_factura['cod_tercero'];
	$cod_producto                                      = $datos_info_factura['cod_producto'];
	$cod_producto_barra                                = $datos_info_factura['cod_producto_barra'];
	$nombre_producto                                   = $datos_info_factura['nombre_producto'];
	$fecha_ymdhis                                      = date("Y-m-d H:i:s");

	$sql_data = "INSERT INTO tbl15_gasto_inmueble_inquilino_venta_temporal (cod_info_gasto_inmueble_inquilino_venta, nombre_gasto_inmueble_detalle, cod_gasto_inmueble, 
	cod_producto, cod_producto_barra, nombre_producto, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
	cod_administrador, cod_caja_virtual, fecha_gasto_inmueble_detalle, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, fecha_creacion, und_venta, cod_factura) 
	VALUES ('$cod_info_gasto_inmueble_inquilino_venta', '$nombre_gasto_inmueble_detalle', '$cod_gasto_inmueble', 
	'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
	'$cod_administrador', '$cod_caja_virtual', '$fecha_gasto_inmueble_detalle', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$fecha_creacion', '$und_venta', '$cod_factura')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else {
?>
<table class="table table-striped">
<tr>
<th style="text-align:center"><img src=../imagenes/advertencia.gif alt='Advertencia'>EL CODIGO <?php echo $cod_gasto_inmueble ?> NO EXISTE EN EL INVENTARIO.<img src=../imagenes/advertencia.gif alt='Advertencia'></th>
</tr>
</table>
<META HTTP-EQUIV="REFRESH" CONTENT="3; <?php echo $pagina?>">
<?php } ?>

<?php } ?>

<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>