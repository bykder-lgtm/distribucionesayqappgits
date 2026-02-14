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

	if (isset($_POST['nombre_tipo_tercero']) <> '') { $nombre_tipo_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_tercero'])); } else { $nombre_tipo_tercero = ''; }
	if (isset($_POST['nombre_tipo_identificacion']) <> '') { $nombre_tipo_identificacion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_identificacion'])); } else { $nombre_tipo_identificacion = 'NIT'; }
	if (isset($_POST['identificacion_tercero']) <> '') { $identificacion_tercero = mysqli_real_escape_string($conectar, ($_POST['identificacion_tercero'])); } else { $identificacion_tercero = ''; }
	if (isset($_POST['digito_tercero']) <> '') { $digito_tercero = mysqli_real_escape_string($conectar, ($_POST['digito_tercero'])); } else { $digito_tercero = ''; }
	if (isset($_POST['nombre1_tercero']) <> '') { $nombre1_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre1_tercero'])); } else { $nombre1_tercero = ''; }
	if (isset($_POST['nombre2_tercero']) <> '') { $nombre2_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre2_tercero'])); } else { $nombre2_tercero = ''; }
	if (isset($_POST['apellido1_tercero']) <> '') { $apellido1_tercero = mysqli_real_escape_string($conectar, ($_POST['apellido1_tercero'])); } else { $apellido1_tercero = ''; }
	if (isset($_POST['apellido2_tercero']) <> '') { $apellido2_tercero = mysqli_real_escape_string($conectar, ($_POST['apellido2_tercero'])); } else { $apellido2_tercero = ''; }
	if (isset($_POST['direccion_tercero']) <> '') { $direccion_tercero = mysqli_real_escape_string($conectar, ($_POST['direccion_tercero'])); } else { $direccion_tercero = ''; }
	if (isset($_POST['telefono1_tercero']) <> '') { $telefono1_tercero = mysqli_real_escape_string($conectar, ($_POST['telefono1_tercero'])); } else { $telefono1_tercero = ''; }
	if (isset($_POST['telefono2_tercero']) <> '') { $telefono2_tercero = mysqli_real_escape_string($conectar, ($_POST['telefono2_tercero'])); } else { $telefono2_tercero = ''; }
	if (isset($_POST['correo_tercero']) <> '') { $correo_tercero = mysqli_real_escape_string($conectar, ($_POST['correo_tercero'])); } else { $correo_tercero = ''; }
	if (isset($_POST['nombre_pais']) <> '') { $nombre_pais = mysqli_real_escape_string($conectar, ($_POST['nombre_pais'])); } else { $nombre_pais = ''; }
	if (isset($_POST['nombre_departamento']) <> '') { $nombre_departamento = mysqli_real_escape_string($conectar, ($_POST['nombre_departamento'])); } else { $nombre_departamento = ''; }
	if (isset($_POST['nombre_ciudad']) <> '') { $nombre_ciudad = mysqli_real_escape_string($conectar, ($_POST['nombre_ciudad'])); } else { $nombre_ciudad = ''; }
	if (isset($_POST['nombre_tipo_regimen']) <> '') { $nombre_tipo_regimen = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_regimen'])); } else { $nombre_tipo_regimen = ''; }
	if (isset($_POST['nombre_tipo_impuesto']) <> '') { $nombre_tipo_impuesto = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_impuesto'])); } else { $nombre_tipo_impuesto = ''; }
	if (isset($_POST['contacto_tercero']) <> '') { $contacto_tercero = mysqli_real_escape_string($conectar, ($_POST['contacto_tercero'])); } else { $contacto_tercero = ''; }
	if (isset($_POST['fax_tercero']) <> '') { $fax_tercero = mysqli_real_escape_string($conectar, ($_POST['fax_tercero'])); } else { $fax_tercero = ''; }
	if (isset($_POST['nombre_tipo_cliente']) <> '') { $nombre_tipo_cliente = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cliente'])); } else { $nombre_tipo_cliente = ''; }
	if (isset($_POST['fecha_nac_tercero']) <> '') { $fecha_nac_tercero = mysqli_real_escape_string($conectar, ($_POST['fecha_nac_tercero'])); } else { $fecha_nac_tercero = ''; }
	if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = mysqli_real_escape_string($conectar, ($_POST['cod_administrador'])); } else { $cod_administrador = ''; }

	if (isset($_POST['cod_estado_dto_tercero']) <> '') { $cod_estado_dto_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_estado_dto_tercero'])); } else { $cod_estado_dto_tercero = ''; }
	if (isset($_POST['dto1_con_iva_tercero']) <> '') { $dto1_con_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto1_con_iva_tercero'])); } else { $dto1_con_iva_tercero = ''; }
	if (isset($_POST['dto2_con_iva_tercero']) <> '') { $dto2_con_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto2_con_iva_tercero'])); } else { $dto2_con_iva_tercero = ''; }
	if (isset($_POST['dto1_sin_iva_tercero']) <> '') { $dto1_sin_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto1_sin_iva_tercero'])); } else { $dto1_sin_iva_tercero = ''; }
	if (isset($_POST['dto2_sin_iva_tercero']) <> '') { $dto2_sin_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto2_sin_iva_tercero'])); } else { $dto2_sin_iva_tercero = ''; }
	if (isset($_POST['dto1_excento_iva_tercero']) <> '') { $dto1_excento_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto1_excento_iva_tercero'])); } else { $dto1_excento_iva_tercero = ''; }
	if (isset($_POST['dto2_excento_iva_tercero']) <> '') { $dto2_excento_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto2_excento_iva_tercero'])); } else { $dto2_excento_iva_tercero = ''; }
	if (isset($_POST['cantidad_puntos_x_valor_redimibles_campanya']) <> '') { $total_puntos_redimibles_campanya_tercero = intval($_POST['cantidad_puntos_x_valor_redimibles_campanya']); } else { $total_puntos_redimibles_campanya_tercero = '0'; }

	if (isset($_POST['cod_pais']) <> '') { $cod_pais = intval($_POST['cod_pais']); } else { $cod_pais = '1'; }
	if (isset($_POST['cod_departamento']) <> '') { $cod_departamento = intval($_POST['cod_departamento']); } else { $cod_departamento = ''; }
	if (isset($_POST['cod_municipio']) <> '') { $cod_municipio = intval($_POST['cod_municipio']); } else { $cod_municipio = ''; }

	$nombre_operador_credito = $nombre1_tercero;

	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_operador_credito'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_operador_credito = $datos_autoincremento_sesion['AUTO_INCREMENT'];

	$obtener_pais = "SELECT * FROM tbl15_pais WHERE cod_pais = '".($cod_pais)."'";
	$consultar_pais = mysqli_query($conectar, $obtener_pais) or die(mysqli_error($conectar));
	$info_pais = mysqli_fetch_assoc($consultar_pais);

	$nombre_pais                        = $info_pais['nombre_pais'];

	$obtener_departamento = "SELECT * FROM tbl15_departamento WHERE cod_departamento = '".($cod_departamento)."'";
	$consultar_departamento = mysqli_query($conectar, $obtener_departamento) or die(mysqli_error($conectar));
	$info_departamento = mysqli_fetch_assoc($consultar_departamento);

	$nombre_departamento                = $info_departamento['nombre_departamento'];

	$obtener_municipio = "SELECT * FROM tbl15_municipio WHERE cod_municipio = '".($cod_municipio)."'";
	$consultar_municipio = mysqli_query($conectar, $obtener_municipio) or die(mysqli_error($conectar));
	$info_municipio = mysqli_fetch_assoc($consultar_municipio);

	$nombre_municipio                   = $info_municipio['nombre_municipio'];
	$nombre_ciudad                      = $nombre_municipio;

	$obtener_empresa = "SELECT identificacion_tercero FROM tbl15_operador_credito WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_empresa = mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
	$tbl15_info_empresa = mysqli_fetch_assoc($consultar_empresa);

	if(mysqli_num_rows(@$consultar_empresa) > 0) 	{
		echo '<img src="../imagenes/advertencia.gif"><h4>EL DOCUMENTO '. $identificacion_tercero.' YA ESTA REGISTRADO</h4></div>';
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="3; <?php echo $pagina_else ?>">
	<?php } else {
		$sql_data = "INSERT INTO tbl15_operador_credito (nombre_tipo_tercero, nombre_tipo_identificacion, identificacion_tercero, digito_tercero, 
		nombre_operador_credito, nombre1_tercero, direccion_tercero, telefono1_tercero, correo_tercero, cod_pais, cod_departamento, cod_municipio, 
		nombre_pais, nombre_departamento, nombre_ciudad, nombre_tipo_regimen, nombre_tipo_impuesto, nombre_tipo_cliente, cod_administrador) 
		VALUES ('$nombre_tipo_tercero', '$nombre_tipo_identificacion', '$identificacion_tercero', '$digito_tercero', 
		UPPER('$nombre_operador_credito'), UPPER('$nombre1_tercero'), '$direccion_tercero', '$telefono1_tercero', '$correo_tercero', '$cod_pais', '$cod_departamento', '$cod_municipio', 
		'$nombre_pais', '$nombre_departamento', '$nombre_ciudad', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$nombre_tipo_cliente', '$cod_administrador')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_operador_credito.php?cod_operador_credito=<?php echo $cod_operador_credito ?>">
	<?php } ?>
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