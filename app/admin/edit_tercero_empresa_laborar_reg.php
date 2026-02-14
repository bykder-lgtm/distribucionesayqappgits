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

	$cod_tercero                   = intval($_POST['cod_tercero']);
	if (isset($_POST['nombre_tipo_tercero']) <> '') { $nombre_tipo_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_tercero'])); } else { $nombre_tipo_tercero = ''; }
	if (isset($_POST['nombre_tipo_identificacion']) <> '') { $nombre_tipo_identificacion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_identificacion'])); } else { $nombre_tipo_identificacion = ''; }
	if (isset($_POST['identificacion_tercero']) <> '') { $identificacion_tercero = mysqli_real_escape_string($conectar, ($_POST['identificacion_tercero'])); } else { $identificacion_tercero = ''; }
	if (isset($_POST['digito_tercero']) <> '') { $digito_tercero = mysqli_real_escape_string($conectar, ($_POST['digito_tercero'])); } else { $digito_tercero = ''; }
	if (isset($_POST['nombre1_tercero']) <> '') { $nombre1_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre1_tercero'])); } else { $nombre1_tercero = ''; }
	if (isset($_POST['nombre2_tercero']) <> '') { $nombre2_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre2_tercero'])); } else { $nombre2_tercero = ''; }
	if (isset($_POST['apellido1_tercero']) <> '') { $apellido1_tercero = mysqli_real_escape_string($conectar, ($_POST['apellido1_tercero'])); } else { $apellido1_tercero = ''; }
	if (isset($_POST['apellido2_tercero']) <> '') { $apellido2_tercero = mysqli_real_escape_string($conectar, ($_POST['apellido2_tercero'])); } else { $apellido2_tercero = ''; }
	if (isset($_POST['direccion_tercero']) <> '') { $direccion_tercero = mysqli_real_escape_string($conectar, ($_POST['direccion_tercero'])); } else { $direccion_tercero = ''; }
	if (isset($_POST['telefono1_tercero']) <> '') { $telefono1_tercero = mysqli_real_escape_string($conectar, ($_POST['telefono1_tercero'])); } else { $telefono1_tercero = ''; }
	if (isset($_POST['telefono2_tercero']) <> '') { $telefono2_tercero = mysqli_real_escape_string($conectar, ($_POST['telefono2_tercero'])); } else { $telefono2_tercero = ''; }
	if (isset($_POST['nombre_pais']) <> '') { $nombre_pais = mysqli_real_escape_string($conectar, ($_POST['nombre_pais'])); } else { $nombre_pais = ''; }
	if (isset($_POST['nombre_departamento']) <> '') { $nombre_departamento = mysqli_real_escape_string($conectar, ($_POST['nombre_departamento'])); } else { $nombre_departamento = ''; }
	if (isset($_POST['nombre_ciudad']) <> '') { $nombre_ciudad = mysqli_real_escape_string($conectar, ($_POST['nombre_ciudad'])); } else { $nombre_ciudad = ''; }
	if (isset($_POST['nombre_tipo_cliente']) <> '') { $nombre_tipo_cliente = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cliente'])); } else { $nombre_tipo_cliente = ''; }
	if (isset($_POST['nombre_tipo_regimen']) <> '') { $nombre_tipo_regimen = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_regimen'])); } else { $nombre_tipo_regimen = ''; }
	if (isset($_POST['nombre_tipo_impuesto']) <> '') { $nombre_tipo_impuesto = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_impuesto'])); } else { $nombre_tipo_impuesto = ''; }
	if (isset($_POST['contacto_tercero']) <> '') { $contacto_tercero = mysqli_real_escape_string($conectar, ($_POST['contacto_tercero'])); } else { $contacto_tercero = ''; }
	if (isset($_POST['fax_tercero']) <> '') { $fax_tercero = mysqli_real_escape_string($conectar, ($_POST['fax_tercero'])); } else { $fax_tercero = ''; }
	if (isset($_POST['fecha_nac_tercero']) <> '') { $fecha_nac_tercero = mysqli_real_escape_string($conectar, ($_POST['fecha_nac_tercero'])); } else { $fecha_nac_tercero = ''; }
	if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = mysqli_real_escape_string($conectar, ($_POST['cod_administrador'])); } else { $cod_administrador = ''; }
	if (isset($_POST['correo_tercero']) <> '') { $correo_tercero = mysqli_real_escape_string($conectar, ($_POST['correo_tercero'])); } else { $correo_tercero = ''; }

	if (isset($_POST['cod_estado_dto_tercero']) <> '') { $cod_estado_dto_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_estado_dto_tercero'])); } else { $cod_estado_dto_tercero = ''; }
	if (isset($_POST['dto1_con_iva_tercero']) <> '') { $dto1_con_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto1_con_iva_tercero'])); } else { $dto1_con_iva_tercero = ''; }
	if (isset($_POST['dto2_con_iva_tercero']) <> '') { $dto2_con_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto2_con_iva_tercero'])); } else { $dto2_con_iva_tercero = ''; }
	if (isset($_POST['dto1_sin_iva_tercero']) <> '') { $dto1_sin_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto1_sin_iva_tercero'])); } else { $dto1_sin_iva_tercero = ''; }
	if (isset($_POST['dto2_sin_iva_tercero']) <> '') { $dto2_sin_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto2_sin_iva_tercero'])); } else { $dto2_sin_iva_tercero = ''; }
	if (isset($_POST['dto1_excento_iva_tercero']) <> '') { $dto1_excento_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto1_excento_iva_tercero'])); } else { $dto1_excento_iva_tercero = ''; }
	if (isset($_POST['dto2_excento_iva_tercero']) <> '') { $dto2_excento_iva_tercero = mysqli_real_escape_string($conectar, ($_POST['dto2_excento_iva_tercero'])); } else { $dto2_excento_iva_tercero = ''; }

	if (isset($_POST['cod_pais']) <> '') { $cod_pais = intval($_POST['cod_pais']); } else { $cod_pais = '1'; }
	if (isset($_POST['cod_departamento']) <> '') { $cod_departamento = intval($_POST['cod_departamento']); } else { $cod_departamento = ''; }
	if (isset($_POST['cod_municipio']) <> '') { $cod_municipio = intval($_POST['cod_municipio']); } else { $cod_municipio = ''; }
	$pagina                       = addslashes($_POST['pagina']);

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

	if (isset($_POST['fecha_ymd_venta_producto_ini_consulta'])) {
		$cod_tercero_consulta                    = intval($_POST['cod_tercero_consulta']);
		$fecha_ymd_venta_producto_ini_consulta   = addslashes($_POST['fecha_ymd_venta_producto_ini_consulta']);
	    $fecha_ymd_venta_producto_fin_consulta   = addslashes($_POST['fecha_ymd_venta_producto_fin_consulta']);
	    $cod_administrador_consulta              = intval($_POST['cod_administrador_consulta']);
	    $cod_tipo_pago_consulta                  = intval($_POST['cod_tipo_pago_consulta']);
	    $cod_tipo_forma_pago_consulta            = intval($_POST['cod_tipo_forma_pago_consulta']);
	    $cod_dependencia_consulta                = intval($_POST['cod_dependencia_consulta']);
	    $nombre_tipo_factura_consulta            = addslashes($_POST['nombre_tipo_factura_consulta']);
	    $nombre_tipo_compra_consulta             = addslashes($_POST['nombre_tipo_compra_consulta']);

	    $pagina_redirect                         = $pagina.'?'.'cod_administrador='.$cod_administrador_consulta.'&'.'cod_tercero='.$cod_tercero_consulta.'&'.'cod_dependencia='.$cod_dependencia_consulta.'&'.'cod_tipo_pago='.$cod_tipo_pago_consulta.'&'.'nombre_tipo_compra='.$nombre_tipo_compra_consulta.'&'.'cod_tipo_forma_pago='.$cod_tipo_forma_pago_consulta.'&'.'nombre_tipo_factura='.$nombre_tipo_factura_consulta.'&'.'fecha_ymd_venta_producto_ini='.$fecha_ymd_venta_producto_ini_consulta.'&'.'fecha_ymd_venta_producto_fin='.$fecha_ymd_venta_producto_fin_consulta.'&'.'submit=Ver+Registros';
	} else {
	    $pagina_redirect                         = $pagina;
	}

	$sql_data = sprintf("UPDATE tbl15_tercero SET nombre_tipo_tercero = '$nombre_tipo_tercero', nombre_tipo_identificacion = '$nombre_tipo_identificacion', 
	identificacion_tercero = '$identificacion_tercero', digito_tercero = '$digito_tercero', nombre1_tercero = '$nombre1_tercero', 
	nombre2_tercero = '$nombre2_tercero', apellido1_tercero = '$apellido1_tercero', apellido2_tercero = '$apellido2_tercero', 
	direccion_tercero = '$direccion_tercero', telefono1_tercero = '$telefono1_tercero', telefono2_tercero = '$telefono2_tercero', 
	cod_pais = '$cod_pais', cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio', nombre_pais = '$nombre_pais', nombre_departamento = '$nombre_departamento', 
	nombre_ciudad = '$nombre_ciudad', nombre_tipo_cliente = '$nombre_tipo_cliente', 	nombre_tipo_regimen = '$nombre_tipo_regimen', nombre_tipo_impuesto = '$nombre_tipo_impuesto', 
	contacto_tercero = '$contacto_tercero', fax_tercero = '$fax_tercero', 	fecha_nac_tercero = '$fecha_nac_tercero', cod_administrador = '$cod_administrador', 
	correo_tercero = '$correo_tercero', cod_estado_dto_tercero = '$cod_estado_dto_tercero', 
	dto1_con_iva_tercero = '$dto1_con_iva_tercero', dto2_con_iva_tercero = '$dto2_con_iva_tercero', dto1_sin_iva_tercero = '$dto1_sin_iva_tercero', dto2_sin_iva_tercero = '$dto2_sin_iva_tercero', 
	dto1_excento_iva_tercero = '$dto1_excento_iva_tercero', dto2_excento_iva_tercero = '$dto2_excento_iva_tercero' 
	WHERE cod_tercero = '$cod_tercero'");
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