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

	$cod_movimiento_caja                         = intval($_POST['cod_movimiento_caja']);
	$total_saldo                                 = addslashes($_POST['total_saldo']);
	$fecha_ymd_movimiento_caja                   = addslashes($_POST['fecha_ymd_movimiento_caja']);
	$cod_tipo_forma_pago                         = intval($_POST['cod_tipo_forma_pago']);
	$cod_estado                                  = intval($_POST['cod_estado']);
	$fecha_mes_movimiento_caja                   = date("Y-m", strtotime($fecha_ymd_movimiento_caja));
	$fecha_anyo_movimiento_caja                  = date("Y", strtotime($fecha_ymd_movimiento_caja));
	$fecha_hora_movimiento_caja                  = date("H:i:s");
	$fecha_seg_movimiento_caja                   = time();

	$sql_data = sprintf("UPDATE tbl15_movimiento_caja SET total_saldo = '$total_saldo', fecha_ymd_movimiento_caja = '$fecha_ymd_movimiento_caja', fecha_mes_movimiento_caja = '$fecha_mes_movimiento_caja', 
	fecha_anyo_movimiento_caja = '$fecha_anyo_movimiento_caja', fecha_hora_movimiento_caja = '$fecha_hora_movimiento_caja', fecha_seg_movimiento_caja = '$fecha_seg_movimiento_caja', 
	cod_estado = '$cod_estado', cod_tipo_forma_pago = '$cod_tipo_forma_pago'
	WHERE cod_movimiento_caja = '$cod_movimiento_caja'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_egreso_movimiento_caja_fisica.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_egreso_movimiento_caja_fisica.php">
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