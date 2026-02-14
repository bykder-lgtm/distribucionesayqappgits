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
include_once('../admin/funcion_eliminar_acentos.php');

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_entidad_origen_archivo']) <> '') { $cod_entidad_origen_archivo = addslashes($_POST['cod_entidad_origen_archivo']); } else { $cod_entidad_origen_archivo = ''; }
	if (isset($_POST['nombre_paciente']) <> '') { $nombre_paciente = addslashes($_POST['nombre_paciente']); } else { $nombre_paciente = ''; }
	if (isset($_POST['nombre_medico_tratante']) <> '') { $nombre_medico_tratante = addslashes($_POST['nombre_medico_tratante']); } else { $nombre_medico_tratante = ''; }
	if (isset($_POST['cod_historia_clinica']) <> '') { $cod_historia_clinica = addslashes($_POST['cod_historia_clinica']); } else { $cod_historia_clinica = '0'; }
	if (isset($_POST['cod_factura']) <> '') { $cod_factura = addslashes($_POST['cod_factura']); } else { $cod_factura = ''; }
	if (isset($_POST['cod_tipo_ambito']) <> '') { $cod_tipo_ambito = addslashes($_POST['cod_tipo_ambito']); } else { $cod_tipo_ambito = '0'; }
	if (isset($_POST['cod_tipo_estante']) <> '') { $cod_tipo_estante = addslashes($_POST['cod_tipo_estante']); } else { $cod_tipo_estante = '0'; }
	if (isset($_POST['cod_tipo_cubiculo']) <> '') { $cod_tipo_cubiculo = addslashes($_POST['cod_tipo_cubiculo']); } else { $cod_tipo_cubiculo = '0'; }
	if (isset($_POST['cod_tipo_carpeta']) <> '') { $cod_tipo_carpeta = addslashes($_POST['cod_tipo_carpeta']); } else { $cod_tipo_carpeta = '0'; }
	if (isset($_POST['cod_tipo_archivo']) <> '') { $cod_tipo_archivo = addslashes($_POST['cod_tipo_archivo']); } else { $cod_tipo_archivo = '0'; }
	if (isset($_POST['cod_tabla_retencion_documental']) <> '') { $cod_tabla_retencion_documental = addslashes($_POST['cod_tabla_retencion_documental']); } else { $cod_tabla_retencion_documental = '0'; }
	if (isset($_POST['cantidad_folios']) <> '') { $cantidad_folios = addslashes($_POST['cantidad_folios']); } else { $cantidad_folios = ''; }
	if (isset($_POST['cod_tipo_nota_observacion']) <> '') { $cod_tipo_nota_observacion = intval($_POST['cod_tipo_nota_observacion']); } else { $cod_tipo_nota_observacion = '1'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_POST['nombre_archivador']) <> '') { $nombre_archivador = addslashes($_POST['nombre_archivador']); } else { $nombre_archivador = ''; }
	if (isset($_POST['descripcion_archivador']) <> '') { $descripcion_archivador = addslashes($_POST['descripcion_archivador']); } else { $descripcion_archivador = ''; }
	$observacion_archivador                                         = $nombre_archivador;

	//if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = mysqli_real_escape_string($conectar, strip_tags($_POST['fecha_ymd'])); } else { $fecha_ymd = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_archivador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_archivador'";
	$exec_autoincremento_archivador = mysqli_query($conectar, $sql_autoincremento_archivador) or die(mysqli_error($conectar));
	$datos_autoincremento_archivador = mysqli_fetch_assoc($exec_autoincremento_archivador);
	$cod_archivador                                     = $datos_autoincremento_archivador['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_archivo_adjunto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_archivo_adjunto'";
	$exec_autoincremento_archivo_adjunto = mysqli_query($conectar, $sql_autoincremento_archivo_adjunto) or die(mysqli_error($conectar));
	$datos_autoincremento_archivo_adjunto = mysqli_fetch_assoc($exec_autoincremento_archivo_adjunto);
	$cod_archivo_adjunto                                = $datos_autoincremento_archivo_adjunto['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_nota_observacion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_nota_observacion'";
	$exec_autoincremento_nota_observacion = mysqli_query($conectar, $sql_autoincremento_nota_observacion) or die(mysqli_error($conectar));
	$datos_autoincremento_nota_observacion = mysqli_fetch_assoc($exec_autoincremento_nota_observacion);
	$cod_nota_observacion                                = $datos_autoincremento_nota_observacion['AUTO_INCREMENT'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_archivo_adjunto = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_archivo_adjunto WHERE (cod_archivador = '$cod_archivador')";
	$consulta_archivo_adjunto = mysqli_query($conectar, $sql_archivo_adjunto);
	$datos_archivo_adjunto = mysqli_fetch_assoc($consulta_archivo_adjunto);

	$cod_guia                                         = $datos_archivo_adjunto['cod_guia'] + 1;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
	$consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
	$datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

	$nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_entidad_origen_archivo = "SELECT * FROM tbl15_entidad_origen_archivo WHERE (cod_entidad_origen_archivo = '$cod_entidad_origen_archivo')";
	$consulta_entidad_origen_archivo = mysqli_query($conectar, $sql_entidad_origen_archivo);
	$datos_entidad_origen_archivo = mysqli_fetch_assoc($consulta_entidad_origen_archivo);

	$nombre_entidad_origen_archivo                  = $datos_entidad_origen_archivo['nombre_entidad_origen_archivo'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tipo_archivo = "SELECT * FROM tbl15_tipo_archivo WHERE (cod_tipo_archivo = '$cod_tipo_archivo')";
	$consulta_tipo_archivo = mysqli_query($conectar, $sql_tipo_archivo);
	$datos_tipo_archivo = mysqli_fetch_assoc($consulta_tipo_archivo);

	$nombre_tipo_archivo                            = $datos_tipo_archivo['nombre_tipo_archivo'];
	$nombre_tipo_archivo_abrev                      = $datos_tipo_archivo['nombre_tipo_archivo_abrev'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tipo_ambito = "SELECT * FROM tbl15_tipo_ambito WHERE (cod_tipo_ambito = '$cod_tipo_ambito')";
	$consulta_tipo_ambito = mysqli_query($conectar, $sql_tipo_ambito);
	$datos_tipo_ambito = mysqli_fetch_assoc($consulta_tipo_ambito);

	$nombre_tipo_ambito                            = $datos_tipo_ambito['nombre_tipo_ambito'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tipo_estante = "SELECT * FROM tbl15_tipo_estante WHERE (cod_tipo_estante = '$cod_tipo_estante')";
	$consulta_tipo_estante = mysqli_query($conectar, $sql_tipo_estante);
	$datos_tipo_estante = mysqli_fetch_assoc($consulta_tipo_estante);

	$nombre_tipo_estante                            = $datos_tipo_estante['nombre_tipo_estante'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tipo_cubiculo = "SELECT * FROM tbl15_tipo_cubiculo WHERE (cod_tipo_cubiculo = '$cod_tipo_cubiculo')";
	$consulta_tipo_cubiculo = mysqli_query($conectar, $sql_tipo_cubiculo);
	$datos_tipo_cubiculo = mysqli_fetch_assoc($consulta_tipo_cubiculo);

	$nombre_tipo_cubiculo                            = $datos_tipo_cubiculo['nombre_tipo_cubiculo'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tipo_carpeta = "SELECT * FROM tbl15_tipo_carpeta WHERE (cod_tipo_carpeta = '$cod_tipo_carpeta')";
	$consulta_tipo_carpeta = mysqli_query($conectar, $sql_tipo_carpeta);
	$datos_tipo_carpeta = mysqli_fetch_assoc($consulta_tipo_carpeta);

	$nombre_tipo_carpeta                            = $datos_tipo_carpeta['nombre_tipo_carpeta'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_tabla_retencion_documental = "SELECT * FROM tbl15_tabla_retencion_documental WHERE (cod_tabla_retencion_documental = '$cod_tabla_retencion_documental')";
	$consulta_tabla_retencion_documental = mysqli_query($conectar, $sql_tabla_retencion_documental);
	$datos_tabla_retencion_documental = mysqli_fetch_assoc($consulta_tabla_retencion_documental);

	$nombre_tabla_retencion_documental                  = $datos_tabla_retencion_documental['nombre_tabla_retencion_documental'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$fecha_hora                                         = date("H:i:s");
	$fecha_creacion                                     = date("Y-m-d");
	$tipo_soporte                                       = "ARCHIVADOR";
/* ----------------------------------------------------------------------------------------------------------/ */
	$limpiar_nombre_archivador                          = str_replace(' ','_', funcion_eliminar_acentos(trim(substr($nombre_archivador, 0, 30))));
	$limpiar_descripcion_archivador                     = str_replace(' ','_', funcion_eliminar_acentos(trim(substr($descripcion_archivador, 0, 30))));
	$limpiar_nombre_tipo_archivo_abrev                  = str_replace(' ','_', funcion_eliminar_acentos(trim($nombre_tipo_archivo_abrev)));
	$limpiar_cod_historia_clinica                       = str_replace(' ','', funcion_eliminar_acentos(trim(substr($cod_historia_clinica, 0, 10))));
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_ymdHis                                       = date("YmdHis");
	$formato                                            = 'jpg';
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");

	$ruta_firma_miniatura                               = '../archivador/documentos/';
	$ruta_foto_miniatura                                = '../archivador/documentos/';
	$ruta_firma_orig                                    = '../archivador/documentos/';
	$ruta_foto_orig                                     = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                       = explode(".", $url_img1);
		$formato_img2                                       = end($formato_img2);
		$nombre_normal2                                     = $limpiar_descripcion_archivador.'__'.$cod_archivador.'__'.$cod_nota_observacion.'__'.$fecha_ymdHis.'.'.$formato_img2;
		$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                               = $ruta_foto_orig.$nombre_normal2;
		$peso_archivo                                       = $_FILES["url_img1"]["size"];
	} else { 
		$formato_img2                                       = "";
		$formato_img2                                       = "";
		$nombre_normal2                                     = "";
		$url_img_orig_producto                              = "";
		$url_img_min_producto                               = "";
		$peso_archivo                                       = 0;
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	$nombre_tipo_extencion_archivo                      = $formato_img2;
	$nombre_archivo_adjunto                             = $_FILES['url_img1']['name'];
	$nombre_original_archivo                            = $_FILES['url_img1']['name'];
	$descripcion_archivo_adjunto                        = $observacion_archivador;
	$nombre_nota_observacion                            = $descripcion_archivador;
 	$nombre_origen_archivo                              = $cod_entidad_origen_archivo;
 	$numero_historia_clinica                            = $cod_historia_clinica;
/* ----------------------------------------------------------------------------------------------------------/ */
	if (move_uploaded_file($_FILES['url_img1']['tmp_name'], $url_img_orig_producto)) {
		$sql_archivador = "INSERT INTO tbl15_archivador (nombre_archivador, descripcion_archivador, observacion_archivador, cod_historia_clinica, nombre_paciente, nombre_medico_tratante, 
		cod_factura, cod_tipo_ambito, cod_tipo_estante, cod_tipo_cubiculo, cod_tipo_carpeta, cod_tabla_retencion_documental, cod_entidad_origen_archivo, cod_tipo_archivo, 
		cod_tipo_nota_observacion, nombre_original_archivo, cantidad_folios, nombre_tipo_extencion_archivo, numero_historia_clinica, fecha_creacion, peso_archivo, 
		cuenta, cod_administrador, url_img_orig_producto, url_img_min_producto) 
		VALUES ('$nombre_archivador', '$descripcion_archivador', '$observacion_archivador', '$cod_historia_clinica', UPPER('$nombre_paciente'), UPPER('$nombre_medico_tratante'), 
		'$cod_factura', '$cod_tipo_ambito', '$cod_tipo_estante', '$cod_tipo_cubiculo', '$cod_tipo_carpeta', '$cod_tabla_retencion_documental', '$cod_entidad_origen_archivo', '$cod_tipo_archivo', 
		'$cod_tipo_nota_observacion', '$nombre_original_archivo', '$cantidad_folios', '$nombre_tipo_extencion_archivo', '$numero_historia_clinica', '$fecha_creacion', '$peso_archivo',
		'$cuenta_actual', '$cod_administrador', '$url_img_orig_producto', '$url_img_min_producto')";
		$resultado_archivador = mysqli_query($conectar, $sql_archivador) or die(mysqli_error($conectar));
		
		$sql_archivo_adjunto = "INSERT INTO tbl15_archivo_adjunto (cod_archivador, cod_historia_clinica, nombre_archivo_adjunto, descripcion_archivo_adjunto, nombre_paciente, nombre_medico_tratante, 
		observacion_archivador, cod_factura, cod_tipo_ambito, cod_tipo_estante, cod_tipo_cubiculo, cod_tipo_carpeta, cod_tabla_retencion_documental, cod_entidad_origen_archivo, cod_tipo_archivo, 
		cod_tipo_nota_observacion, nombre_original_archivo, cantidad_folios, nombre_tipo_extencion_archivo, nombre_nota_observacion, numero_historia_clinica, fecha_creacion, fecha_ymd, fecha_hora, peso_archivo, 
		cuenta, cod_administrador, cod_guia, url_img_orig_producto, url_img_min_producto) 
		VALUES ('$cod_archivador', '$cod_historia_clinica', '$nombre_archivo_adjunto', '$descripcion_archivo_adjunto', UPPER('$nombre_paciente'), UPPER('$nombre_medico_tratante'), 
		'$observacion_archivador', '$cod_factura', '$cod_tipo_ambito', '$cod_tipo_estante', '$cod_tipo_cubiculo', '$cod_tipo_carpeta', '$cod_tabla_retencion_documental', '$cod_entidad_origen_archivo', '$cod_tipo_archivo', 
		'$cod_tipo_nota_observacion', '$nombre_original_archivo', '$cantidad_folios', '$nombre_tipo_extencion_archivo', '$nombre_nota_observacion', '$numero_historia_clinica', '$fecha_creacion', '$fecha_ymd', '$fecha_hora', '$peso_archivo',
		'$cuenta_actual', '$cod_administrador', '$cod_guia', '$url_img_orig_producto', '$url_img_min_producto')";
		$resultado_archivo_adjunto = mysqli_query($conectar, $sql_archivo_adjunto) or die(mysqli_error($conectar));

		$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, cod_tipo_nota_observacion, cod_archivador, url_img_orig_producto, url_img_min_producto, 
		cod_tipo_ambito, cod_tipo_estante, cod_tipo_cubiculo, cod_tipo_carpeta, cod_entidad_origen_archivo, cod_tipo_archivo, cod_tabla_retencion_documental, cantidad_folios) 
		VALUES ('$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$cod_administrador', '$fecha_creacion', '$cod_tipo_nota_observacion', '$cod_archivador', '$url_img_orig_producto', '$url_img_min_producto', 
		'$cod_tipo_ambito', '$cod_tipo_estante', '$cod_tipo_cubiculo', '$cod_tipo_carpeta', '$cod_entidad_origen_archivo', '$cod_tipo_archivo', '$cod_tabla_retencion_documental', '$cantidad_folios')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

	 	$resultado_subir_archivo = 'SUBIDO_CORRECTAMENTE';
	 	$url_redirect = "";
	 } else {
	 	$resultado_subir_archivo = 'NO_SUBIDO';
	 	$url_redirect = "";
	 }
 	$pagina_redirect                                    = '../admin/ver_historial_archivador_archivo_adjunto.php'.'?cod_archivador='.$cod_archivador.'&cod_archivo_adjunto='.$cod_archivo_adjunto.'&cod_nota_observacion='.$cod_nota_observacion.'&resultado_subir_archivo='.$resultado_subir_archivo;
/* ----------------------------------------------------------------------------------------------------------/ */
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
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