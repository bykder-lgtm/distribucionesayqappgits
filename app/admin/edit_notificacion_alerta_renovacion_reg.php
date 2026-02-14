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

	$cod_notificacion_alerta_renovacion                  = intval($_POST['cod_notificacion_alerta_renovacion']);
	$nombre_notificacion_alerta_renovacion               = (addslashes($_POST['nombre_notificacion_alerta_renovacion']));
	$descipcion_notificacion_alerta_renovacion           = (addslashes($_POST['descipcion_notificacion_alerta_renovacion']));
	$cod_tercero                                         = (intval($_POST['cod_tercero']));
	$precio_venta_notificacion_alerta_renovacion         = (intval($_POST['precio_venta_notificacion_alerta_renovacion']));
	$fecha_inicio_notificacion_alerta_renovacion         = (addslashes($_POST['fecha_inicio_notificacion_alerta_renovacion']));
	$fecha_cobro_notificacion_alerta_renovacion          = (addslashes($_POST['fecha_cobro_notificacion_alerta_renovacion']));
	$cantidad_dias_antelacion_alerta                     = (intval($_POST['cantidad_dias_antelacion_alerta']));
	$nombre_tipo_cobro                                   = (addslashes($_POST['nombre_tipo_cobro']));
	$cod_estado                                          = (intval($_POST['cod_estado']));
	$pagina                                              = (addslashes($_POST['pagina']));
	$pagina_redirect                                     = $pagina;

	$sql_data = sprintf("UPDATE tbl15_notificacion_alerta_renovacion SET cod_notificacion_alerta_renovacion = '$cod_notificacion_alerta_renovacion', nombre_notificacion_alerta_renovacion = '$nombre_notificacion_alerta_renovacion', 
	descipcion_notificacion_alerta_renovacion = '$descipcion_notificacion_alerta_renovacion', cod_tercero = '$cod_tercero', precio_venta_notificacion_alerta_renovacion = '$precio_venta_notificacion_alerta_renovacion', 
	fecha_inicio_notificacion_alerta_renovacion = '$fecha_inicio_notificacion_alerta_renovacion', fecha_cobro_notificacion_alerta_renovacion = '$fecha_cobro_notificacion_alerta_renovacion', 
	nombre_tipo_cobro = '$nombre_tipo_cobro', cantidad_dias_antelacion_alerta = '$cantidad_dias_antelacion_alerta', cod_estado = '$cod_estado' 
	WHERE (cod_notificacion_alerta_renovacion = '$cod_notificacion_alerta_renovacion')");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
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