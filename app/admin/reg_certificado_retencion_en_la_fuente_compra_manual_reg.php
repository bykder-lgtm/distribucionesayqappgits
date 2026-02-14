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

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

    $cod_tercero                                          = intval($_POST['cod_tercero']);
    $fecha_ini_certificado_retefuente                     = addslashes($_POST['fecha_ini_certificado_retefuente']);
    $fecha_fin_certificado_retefuente                     = addslashes($_POST['fecha_fin_certificado_retefuente']);
    $nombre_rete_fuente_ptj                               = addslashes($_POST['nombre_rete_fuente_ptj']);
    $subtotal_base_retencion                              = addslashes($_POST['subtotal_base_retencion']);
    $total_retefuente_valor_retenido                      = addslashes($_POST['total_retefuente_valor_retenido']);
    $nombre_certificado_retefuente                        = addslashes($_POST['nombre_certificado_retefuente']);
	$fecha_generacion_documento_certificado_retefuente 	  = date("Y-m-d");
	$hora_generacion_documento_certificado_retefuente     = date("H:i:s");
	$fecha_creacion 		                              = date("Y-m-d H:i:s");
	$cod_estado                                           = 1;
    $cabecera_certificado_retefuente                      = addslashes($_POST['cabecera_certificado_retefuente']);
    $propietario_nit_certificado_retefuente               = addslashes($_POST['propietario_nit_certificado_retefuente']);
    $telefono_certificado_retefuente                      = addslashes($_POST['telefono_certificado_retefuente']);
    $correo_certificado_retefuente                        = addslashes($_POST['correo_certificado_retefuente']);
    $direccion_certificado_retefuente                     = addslashes($_POST['direccion_certificado_retefuente']);
    $localidad_certificado_retefuente                     = addslashes($_POST['localidad_certificado_retefuente']);
    $nombre_origen_modulo                                 = addslashes($_POST['nombre_origen_modulo']);
    $nombre_origen_creacion                               = addslashes($_POST['nombre_origen_creacion']);
	//$nombre_certificado_retefuente                        = "RETENCIÓN APLICADA A COMPRAS DECLARANTES";

	$sql_autoincremento_certificado_retefuente = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_certificado_retefuente'";
	$exec_autoincremento_certificado_retefuente = mysqli_query($conectar, $sql_autoincremento_certificado_retefuente) or die(mysqli_error($conectar));
	$datos_autoincremento_certificado_retefuente = mysqli_fetch_assoc($exec_autoincremento_certificado_retefuente);
	$cod_certificado_retefuente = $datos_autoincremento_certificado_retefuente['AUTO_INCREMENT'];

	$sql_data = "INSERT INTO tbl15_certificado_retefuente (cod_tercero, nombre_certificado_retefuente, fecha_ini_certificado_retefuente, fecha_fin_certificado_retefuente, 
	fecha_generacion_documento_certificado_retefuente, hora_generacion_documento_certificado_retefuente, nombre_rete_fuente_ptj, subtotal_base_retencion, 
	total_retefuente_valor_retenido, fecha_creacion, cod_estado, 
	cabecera_certificado_retefuente, propietario_nit_certificado_retefuente, telefono_certificado_retefuente, correo_certificado_retefuente, direccion_certificado_retefuente, 
	localidad_certificado_retefuente, nombre_origen_modulo, nombre_origen_creacion) 
	VALUES ('$cod_tercero', '$nombre_certificado_retefuente', '$fecha_ini_certificado_retefuente', '$fecha_fin_certificado_retefuente', 
	'$fecha_generacion_documento_certificado_retefuente', '$hora_generacion_documento_certificado_retefuente', '$nombre_rete_fuente_ptj', '$subtotal_base_retencion', 
	'$total_retefuente_valor_retenido', '$fecha_creacion', '$cod_estado', 
	'$cabecera_certificado_retefuente', '$propietario_nit_certificado_retefuente', '$telefono_certificado_retefuente', '$correo_certificado_retefuente', '$direccion_certificado_retefuente', 
	'$localidad_certificado_retefuente', '$nombre_origen_modulo', '$nombre_origen_creacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_certificado_retencion_en_la_fuente_compra.php?cod_certificado_retefuente=<?php echo $cod_certificado_retefuente; ?>">
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