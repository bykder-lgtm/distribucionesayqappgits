<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

if (isset($_POST['cod_cuentas_cobrar_alerta']) <> '') { $cod_cuentas_cobrar_alerta = intval($_POST['cod_cuentas_cobrar_alerta']); } else { $cod_cuentas_cobrar_alerta = ''; }
if (isset($_POST['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = intval($_POST['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = ''; }
if (isset($_POST['cod_renovacion_contrato']) <> '') { $cod_renovacion_contrato = intval($_POST['cod_renovacion_contrato']); } else { $cod_renovacion_contrato = ''; }
if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes = '0'; }
if (isset($_POST['deduccion_retefuente_hidden']) <> '') { $deduccion_retefuente = mysqli_real_escape_string($conectar, ($_POST['deduccion_retefuente_hidden'])); } else { $deduccion_retefuente = '0'; }
if (isset($_POST['deduccion_otro_concepto_hidden']) <> '') { $deduccion_otro_concepto = mysqli_real_escape_string($conectar, ($_POST['deduccion_otro_concepto_hidden'])); } else { $deduccion_otro_concepto = '0'; }
if (isset($_POST['nombre_tabla_mes']) <> '') { $nombre_tabla_mes = mysqli_real_escape_string($conectar, ($_POST['nombre_tabla_mes'])); } else { $nombre_tabla_mes = ''; }

$monto_deuda 	                 = $monto_deuda_sin_interes;
$subtotal 	                     = $monto_deuda_sin_interes;
$subtotal_sin_interes            = $monto_deuda_sin_interes;
$monto_cuota 	                 = $monto_deuda_sin_interes;
$monto_cuota_sin_interes         = $monto_deuda_sin_interes;

$fecha                           = $fecha_pago;
$anyo                            = date("Y", strtotime($fecha_pago));
$fecha_invert                    = $fecha_pago;
$fecha_mes                       = date("Y").'-'.$nombre_tabla_mes;
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_total_facturas = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura                     = $datos_total_facturas['cod_factura'];
$cod_tercero                     = $datos_total_facturas['cod_tercero'];
$cod_producto                    = $datos_total_facturas['cod_producto'];
$cod_producto_barra              = $datos_total_facturas['cod_producto_barra'];
$nombre_producto                 = $datos_total_facturas['nombre_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$formato                         = 'jpg';
$fecha_hora                      = date("H:i:s");
$fecha_ymd                       = date("Y-m-d");
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET monto_deuda_sin_interes = '$monto_deuda_sin_interes', monto_deuda = '$monto_deuda', subtotal = '$subtotal', 
subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota = '$monto_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes', fecha_pago = '$fecha_pago', fecha = '$fecha', 
fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_invert = '$fecha_invert', cod_renovacion_contrato = '$cod_renovacion_contrato', deduccion_retefuente = '$deduccion_retefuente', 
deduccion_otro_concepto = '$deduccion_otro_concepto'
WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET monto_deuda_sin_interes = '$monto_deuda_sin_interes', monto_deuda = '$monto_deuda', subtotal = '$subtotal', 
subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota_sin_interes = '$monto_cuota_sin_interes', fecha_pago = '$fecha_pago', 
fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_invert = '$fecha_invert', cod_renovacion_contrato = '$cod_renovacion_contrato', deduccion_retefuente = '$deduccion_retefuente', 
deduccion_otro_concepto = '$deduccion_otro_concepto'
WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina_else ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>