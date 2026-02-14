<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$nombre_empresa = addslashes($_POST['nombre_empresa']);
$fecha_ymd_hora = addslashes($_POST['fecha_ymd_hora']);
$fecha_time     = strtotime($fecha_ymd_hora);
$fecha_ymd      = date("Y/m/d", $fecha_time);
$fecha_my       = date("m/Y", $fecha_time);
$fecha_dia      = date("d", $fecha_time);
$fecha_mes      = date("m", $fecha_time);
$fecha_anyo     = date("Y", $fecha_time);

$sql_max_factura = "SELECT Max(cod_factura) AS cod_factura_max FROM tbl15_historia_clinica";
$consulta_max_factura = mysqli_query($conectar, $sql_max_factura) or die(mysqli_error($conectar));
$datos_max_factura = mysqli_fetch_assoc($consulta_max_factura);
$cod_factura_max = $datos_max_factura['cod_factura_max'];

$sql_tipo_facturacion = "SELECT cod_tipo_facturacion, nombre_empresa FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_tipo_facturacion = mysqli_query($conectar, $sql_tipo_facturacion) or die(mysqli_error($conectar));
$datos_tipo_facturacion = mysqli_fetch_assoc($consulta_tipo_facturacion);
$cod_tipo_facturacion = $datos_tipo_facturacion['cod_tipo_facturacion'];

if ($cod_tipo_facturacion == 1) { // INICIO SI LA FACTURACION  PARA UN HOTEL DECAMERON

if ($fecha_dia <= 22) {
$fecha_mes_resta       = strtotime($fecha_ymd_hora.'-1 month');
$fecha_mes_resta_solo  = date("m", $fecha_mes_resta);
$fecha_mes_resta_ymd   = date("Y/m/d", $fecha_mes_resta);

$fecha_mes_ini          = $fecha_anyo.'/'.$fecha_mes_resta_solo.'/'.$dia_ini_facturacion_emp;
$fecha_mes_fin          = $fecha_anyo.'/'.$fecha_mes.'/'.$dia_fin_facturacion_emp;
}
if ($fecha_dia >= 23) {
$fecha_mes_sumado       = strtotime($fecha_ymd_hora.'+1 month');
$fecha_mes_sumado_solo  = date("m", $fecha_mes_sumado);
$fecha_mes_sumado_ymd   = date("Y/m/d", $fecha_mes_sumado);

$fecha_mes_ini          = $fecha_anyo.'/'.$fecha_mes.'/'.$dia_ini_facturacion_emp;
$fecha_mes_fin          = $fecha_anyo.'/'.$fecha_mes_sumado_solo.'/'.$dia_fin_facturacion_emp;
}

$sql_factura = "SELECT cod_factura FROM tbl15_historia_clinica WHERE nombre_empresa = '$nombre_empresa' AND fecha_ymd BETWEEN '$fecha_mes_ini' AND '$fecha_mes_fin' AND cod_estado_facturacion = '1' AND cod_estado_facturacion = '1' AND cod_estado_facturacion = '1'";
$consulta_factura = mysqli_query($conectar, $sql_factura) or die(mysqli_error($conectar));
$datos_factura = mysqli_fetch_assoc($consulta_factura);
$total_reg = mysqli_num_rows($consulta_factura);


if ($total_reg == 0) { 
    $cod_factura = $cod_factura_max + 1;
	echo "<br>total_reg == 0 | ";
	echo "<br>fecha_ymd = ".$fecha_ymd;
	echo "<br>cod_factura = ".$cod_factura;
	echo "<br>nombre_empresa = ".$nombre_empresa;
	echo "<br>fecha_mes_ini = ".$fecha_mes_ini;
	echo "<br>fecha_mes_fin = ".$fecha_mes_fin;
} 
if ($total_reg <> 0) { 
	$cod_factura = $datos_factura['cod_factura'];
	echo "<br>total_reg <> 0 | ";
	echo "<br>fecha_ymd = ".$fecha_ymd;
	echo "<br>cod_factura = ".$cod_factura;
	echo "<br>nombre_empresa = ".$nombre_empresa;
	echo "<br>fecha_mes_ini = ".$fecha_mes_ini;
	echo "<br>fecha_mes_fin = ".$fecha_mes_fin;
}

} // FIN SI LA FACTURACION  PARA UN HOTEL DECAMERON

if ($cod_tipo_facturacion <> 1) { // INICIO SI LA ES FACTURACION PARA UNA EMPRESA NORMAL

$sql_verific = "SELECT cod_factura FROM tbl15_historia_clinica WHERE nombre_empresa = '$nombre_empresa' AND (fecha_mes = '$fecha_my')";
$consulta_verific = mysqli_query($conectar, $sql_verific) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_verific);

$sql_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_historia_clinica WHERE nombre_empresa = '$nombre_empresa' AND (fecha_mes = '$fecha_my')";
$consulta_factura = mysqli_query($conectar, $sql_factura) or die(mysqli_error($conectar));
$datos_factura = mysqli_fetch_assoc($consulta_factura);

if ($total_reg == 0) { $cod_factura = $cod_factura_max + 1; echo "<br>if (total_reg == 0) | "; echo "cod_factura = ".$cod_factura; } 
else { $cod_factura = $datos_factura['cod_factura'];  echo "<br>else | "; echo "cod_factura = ".$cod_factura; }

echo "<br>cod_tipo_facturacion <> 1";
echo "<br>fecha_my = ".$fecha_my;
echo "<br>nombre_empresa = ".$nombre_empresa;
echo "<br>cod_factura = ".$cod_factura;
} // FIN SI LA FACTURACION ES PARA UNA EMPRESA NORMAL


$pagina_else = addslashes($_POST['pagina']);
$cod_historia_clinica = intval($_POST['cod_historia_clinica']);

if (isset($_POST['motivo']) <> '') { $motivo = addslashes($_POST['motivo']); } else { $motivo = ''; }

//---------------------------------------------------------------------------------------------------------------------------------------------//
$hora = date("H:i", $fecha_time);
$fecha_reg_time = time();
$cuenta = $cuenta_actual;
$cod_estado_facturacion = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<h3>Se ha guardado correctamente la historia clinica</h3>
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_else?>">
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>