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
if (isset($_GET["cod_tercero"])) {

	$cod_tercero                                                = intval($_GET['cod_tercero']);
	$nombre_tipo_tercero                                        = addslashes($_GET['nombre_tipo_tercero']);
	$pagina                                                     = addslashes($_GET['pagina']);

	$sql_autoincremento_administrador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
	$exec_autoincremento_administrador = mysqli_query($conectar, $sql_autoincremento_administrador) or die(mysqli_error($conectar));
	$datos_autoincremento_administrador = mysqli_fetch_assoc($exec_autoincremento_administrador);

	$cod_administrador                                          = $datos_autoincremento_administrador['AUTO_INCREMENT'];

	$mostrar_datos_sql = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_tercero                                                = $matriz_consulta['cod_tercero'];
	$nombre_tipo_identificacion                                 = $matriz_consulta['nombre_tipo_identificacion'];
	$identificacion_tercero                                     = $matriz_consulta['identificacion_tercero'];
	$nombre1_tercero                                            = $matriz_consulta['nombre1_tercero'];
	$nombre2_tercero                                            = $matriz_consulta['nombre2_tercero'];
	$apellido1_tercero                                          = $matriz_consulta['apellido1_tercero'];
	$apellido2_tercero                                          = $matriz_consulta['apellido2_tercero'];
	$direccion_tercero                                          = $matriz_consulta['direccion_tercero'];
	$telefono1_tercero                                          = $matriz_consulta['telefono1_tercero'];
	$correo_tercero                                             = $matriz_consulta['correo_tercero'];
	$fecha_nac_tercero                                          = $matriz_consulta['fecha_nac_tercero'];
	$nombre_tipo_cliente                                        = $matriz_consulta['nombre_tipo_cliente'];
	$nombre_tipo_regimen                                        = $matriz_consulta['nombre_tipo_regimen'];
	$nombre_tipo_impuesto                                       = $matriz_consulta['nombre_tipo_impuesto'];
	$cod_estado_cliente                                         = $matriz_consulta['cod_estado_cliente'];
	$cod_estado_lider                                           = $matriz_consulta['cod_estado_lider'];
	$cod_estado_coordinador                                     = $matriz_consulta['cod_estado_coordinador'];
	$cod_estado_asesor                                          = $matriz_consulta['cod_estado_asesor'];
	$cod_estado_proveedor                                       = $matriz_consulta['cod_estado_proveedor'];
	$cod_estado_vendedor                                        = $matriz_consulta['cod_estado_vendedor'];
	$cod_estado_aliado_estrategico                              = $matriz_consulta['cod_estado_aliado_estrategico'];
	$cod_estado_entidad_crediticia                              = $matriz_consulta['cod_estado_entidad_crediticia'];

	$cod_seguridad                                              = 2;
	$cedula                                                     = $identificacion_tercero;
	$nombres                                                    = trim($nombre1_tercero.' '.$nombre2_tercero);
	$apellidos                                                  = trim($apellido1_tercero.' '.$apellido2_tercero);
	$cuenta                                                     = $identificacion_tercero;
	$contrasena                                                 = sha1($identificacion_tercero);
	$cod_tipo_aplicacion                                        = "";
	$cod_estado_activacion_usuario                              = 0;

	$sql_tipo_tercero = "SELECT * FROM tbl15_tipo_tercero WHERE (nombre_tipo_tercero = '$nombre_tipo_tercero')";
	$consulta_tipo_tercero = mysqli_query($conectar, $sql_tipo_tercero) or die(mysqli_error($conectar));
	$matriz_tipo_tercero = mysqli_fetch_assoc($consulta_tipo_tercero);

	$cod_tipo_tercero                                           = $matriz_tipo_tercero['cod_tipo_tercero'];
	$nombre_tipo_tercero                                        = $matriz_tipo_tercero['nombre_tipo_tercero'];
	$fecha                                                      = date("Y-m-d");
	$fecha_hora                                                 = date("H:i:s");
	$cod_estado_existe_usuario                                  = 1;

	$cod_estado_cliente             = 0;
	$cod_estado_lider               = 0;
	$cod_estado_coordinador         = 0;
	$cod_estado_asesor              = 0;
	$cod_estado_proveedor           = 0;
	$cod_estado_vendedor            = 0;
	$cod_estado_aliado_estrategico  = 0;
	$cod_estado_entidad_crediticia  = 0;
	$cod_cliente                    = 0;
	$cod_lider                      = 0;
	$cod_coordinador                = 0;
	$cod_asesor                     = 0;
	$cod_vendedor                   = 0;
	$cod_proveedor                  = 0;
	$cod_aliado_estrategico         = 0;
	$cod_entidad_crediticia         = 0;

	if ($nombre_tipo_tercero == 'CLIENTE') {
		$cod_estado_cliente             = 1;
		$cod_cliente                    = $cod_tercero;
	} elseif ($nombre_tipo_tercero == 'LIDER') {
		$cod_estado_lider              = 1;
		$cod_lider                    = $cod_tercero;
	} elseif ($nombre_tipo_tercero == 'COORDINADOR') {
		$cod_estado_coordinador       = 1;
		$cod_coordinador              = $cod_tercero;
	} elseif ($nombre_tipo_tercero == 'ASESOR') {
		$cod_estado_asesor            = 1;
		$cod_asesor                   = $cod_tercero;
	} elseif ($nombre_tipo_tercero == 'VENDEDOR') {
		$cod_estado_vendedor          = 1;
		$cod_vendedor                 = $cod_tercero;
	} elseif ($nombre_tipo_tercero == 'PROVEEDOR') {
		$cod_estado_proveedor          = 1;
		$cod_proveedor                 = $cod_tercero;
	} elseif ($nombre_tipo_tercero == 'ALIADO_ESTRATEGICO') {
		$cod_estado_aliado_estrategico = 1;
		$cod_aliado_estrategico        = $cod_tercero;
	} else {
		$aaa = 0;
	}
	$pagina_redirect                                            = $pagina.'?nombre_tipo_tercero='.$nombre_tipo_tercero.'&cod_administrador='.$cod_administrador.'&foco='.'foco'.$cod_tercero;

	$sql_data = sprintf("UPDATE tbl15_tercero SET cod_administrador = '$cod_administrador', cod_estado_existe_usuario = '$cod_estado_existe_usuario' WHERE cod_tercero = '$cod_tercero'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_administrador (cod_administrador, cod_tercero, nombre_tipo_identificacion, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, direccion_tercero, 
	telefono1_tercero, correo_tercero, fecha_nac_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, 
	cod_estado_cliente, cod_estado_lider, cod_estado_coordinador, cod_estado_asesor, cod_estado_proveedor, cod_estado_vendedor, 
	cod_estado_aliado_estrategico, cod_estado_entidad_crediticia, cod_seguridad, cedula, nombres, apellidos, cuenta, contrasena, 
	cod_tipo_aplicacion, cod_estado_activacion_usuario, nombre_tipo_tercero, cod_tipo_tercero, fecha, fecha_hora, 
	cod_cliente, cod_lider, cod_coordinador, cod_asesor, cod_vendedor, cod_proveedor, cod_aliado_estrategico, cod_entidad_crediticia, cod_estado) 
	VALUES ('$cod_administrador', '$cod_tercero', '$nombre_tipo_identificacion', '$identificacion_tercero', '$nombre1_tercero', '$nombre2_tercero', '$apellido1_tercero', '$apellido2_tercero', '$direccion_tercero', 
	'$telefono1_tercero', '$correo_tercero', '$fecha_nac_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', 
	'$cod_estado_cliente', '$cod_estado_lider', '$cod_estado_coordinador', '$cod_estado_asesor', '$cod_estado_proveedor', '$cod_estado_vendedor', 
	'$cod_estado_aliado_estrategico', '$cod_estado_entidad_crediticia', '$cod_seguridad', '$cedula', '$nombres', '$apellidos', '$cuenta', '$contrasena', 
	'$cod_tipo_aplicacion', '$cod_estado_activacion_usuario', '$nombre_tipo_tercero', '$cod_tipo_tercero', '$fecha', '$fecha_hora', 
	'$cod_cliente', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_vendedor', '$cod_proveedor', '$cod_aliado_estrategico', '$cod_entidad_crediticia', '1')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
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