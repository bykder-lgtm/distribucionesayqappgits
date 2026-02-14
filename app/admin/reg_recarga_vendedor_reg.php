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

	$cod_administrador                                                   = intval($_POST['cod_administrador']);
	$recarga_actual                                                      = addslashes($_POST['recarga_actual']);
	$pagina                                                              = addslashes($_POST['pagina']);

	$mostrar_datos_sql = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$total_saldo_recarga_anterior                                        = $matriz_consulta['total_saldo_recarga'];
	$total_saldo_recarga                                                 = $total_saldo_recarga_anterior + $recarga_actual;
	$saldo_recarga                                                       = $total_saldo_recarga_anterior;
	$cod_administrador_vendedor                                          = $cod_administrador;
	$fecha_recarga_vendedor                                              = date("Y-m-d");
	$hora_recarga_vendedor                                               = date("H:i:s");
	$fecha_seg_recarga_vendedor                                          = time();

	$sql_data = sprintf("UPDATE tbl15_administrador SET total_saldo_recarga = '$total_saldo_recarga' WHERE cod_administrador = '$cod_administrador'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_recarga_vendedor (recarga_actual, saldo_recarga, cod_administrador_vendedor, fecha_recarga_vendedor, hora_recarga_vendedor, fecha_seg_recarga_vendedor) 
	VALUES ('$recarga_actual', '$saldo_recarga', '$cod_administrador_vendedor', '$fecha_recarga_vendedor', '$hora_recarga_vendedor', '$fecha_seg_recarga_vendedor')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
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