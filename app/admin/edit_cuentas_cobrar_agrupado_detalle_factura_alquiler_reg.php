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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

//if (isset($_POST['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = intval($_POST['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
if (isset($_POST['cod_factura']) <> '') { $cod_factura = intval($_POST['cod_factura']); } else { $cod_factura = ''; }
if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_POST['cod_estado_contrato']) <> '') { $cod_estado_contrato = intval($_POST['cod_estado_contrato']); } else { $cod_estado_contrato = ''; }
if (isset($_POST['cod_producto']) <> '') { $cod_producto = mysqli_real_escape_string($conectar, ($_POST['cod_producto'])); } else { $cod_producto = ''; }
if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = intval($_POST['cod_administrador']); } else { $cod_administrador = ''; }
if (isset($_POST['pagina']) <> '') { $pagina = mysqli_real_escape_string($conectar, ($_POST['pagina'])); } else { $pagina = ''; }
if (isset($_POST['pagina2']) <> '') { $pagina2 = mysqli_real_escape_string($conectar, ($_POST['pagina2'])); } else { $pagina2 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tercero FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra               = $total_producto['cod_producto_barra'];
$cod_producto                     = $total_producto['cod_producto'];
$nombre_producto                  = $total_producto['nombre_producto'];
$cod_tercero_propietario          = $total_producto['cod_tercero'];

foreach ($_POST['cod_cuentas_cobrar'] as $clave=>$cod_cuentas_cobrar) {

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_factura = '$cod_factura', cod_tercero = '$cod_tercero', cod_estado_contrato = '$cod_estado_contrato', 
	cod_producto_barra = '$cod_producto_barra', cod_producto = '$cod_producto', nombre_producto = '$nombre_producto', cod_tercero_propietario = '$cod_tercero_propietario' 
	WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET cod_factura = '$cod_factura', cod_tercero = '$cod_tercero', cod_estado_contrato = '$cod_estado_contrato', 
	cod_producto_barra = '$cod_producto_barra', cod_producto = '$cod_producto', nombre_producto = '$nombre_producto', cod_tercero_propietario = '$cod_tercero_propietario' 
	WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_factura = '$cod_factura', cod_tercero = '$cod_tercero', cod_estado_contrato = '$cod_estado_contrato', 
	cod_producto_barra = '$cod_producto_barra', cod_producto = '$cod_producto', nombre_producto = '$nombre_producto', cod_tercero_propietario = '$cod_tercero_propietario' 
	WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
$pagina = $pagina2.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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