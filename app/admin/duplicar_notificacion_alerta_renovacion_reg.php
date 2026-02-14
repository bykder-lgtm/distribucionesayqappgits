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
if (isset($_GET["cod_notificacion_alerta_renovacion"])) {

	$cod_notificacion_alerta_renovacion                  = intval($_GET['cod_notificacion_alerta_renovacion']);
	$pagina                                              = (addslashes($_GET['pagina']));
	$fecha_creacion                                      = date("Y-m-d");
	$cod_estado_inactivo                                 = 0;
	$cod_estado_activo                                   = 1;
	$cod_estado_aviso                                    = 1;
	$cod_estado                                          = 1;

	$sql_max_guia = "SELECT MAX(cod_guia) as cod_guia FROM tbl15_notificacion_alerta_renovacion";
	$consulta_max_guia = mysqli_query($conectar, $sql_max_guia) or die(mysqli_error($conectar));
	$matriz_max_guia = mysqli_fetch_assoc($consulta_max_guia);

	$cod_guia                                            = $matriz_max_guia['cod_guia'] + 1;

	$mostrar_datos_sql = "SELECT * FROM tbl15_notificacion_alerta_renovacion WHERE cod_notificacion_alerta_renovacion = '$cod_notificacion_alerta_renovacion'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$nombre_tipo_cobro                                   = $matriz_consulta['nombre_tipo_cobro'];

	$nombre_notificacion_alerta_renovacion               = $matriz_consulta['nombre_notificacion_alerta_renovacion'];
	$descipcion_notificacion_alerta_renovacion           = $matriz_consulta['descipcion_notificacion_alerta_renovacion'];
	$cod_tercero                                         = $matriz_consulta['cod_tercero'];
	$cod_producto                                        = $matriz_consulta['cod_producto'];
	$cod_producto_barra                                  = $matriz_consulta['cod_producto_barra'];
	$precio_venta_notificacion_alerta_renovacion         = $matriz_consulta['precio_venta_notificacion_alerta_renovacion'];
	$cod_venta_producto                                  = $matriz_consulta['cod_venta_producto'];
	$cod_info_factura_venta                              = $matriz_consulta['cod_info_factura_venta'];
	$cod_factura                                         = $matriz_consulta['cod_factura'];
	$nombre_tipo_producto                                = $matriz_consulta['nombre_tipo_producto'];
	$fecha_inicio_notificacion_alerta_renovacion         = $matriz_consulta['fecha_cobro_notificacion_alerta_renovacion'];
	$pagina_redirect                                     = $pagina;
 	$numero_cuota                                        = 1;

	if ($nombre_tipo_cobro == 'DIARIO') { $tipo_cobro = 'day'; $numero_alerta = 0; $numero_alerta_correcion = 0; } 
	elseif ($nombre_tipo_cobro == 'SEMANAL') { $tipo_cobro = 'week'; $numero_alerta = 0; $numero_alerta_correcion = 0; } 
	elseif ($nombre_tipo_cobro == 'QUINCENAL') { $tipo_cobro = 'week'; $numero_alerta = 0; $numero_alerta_correcion = 0; } 
	elseif ($nombre_tipo_cobro == 'MES VENCIDO') { $tipo_cobro = 'month'; $numero_alerta = 0; $numero_alerta_correcion = 0; } 
	elseif ($nombre_tipo_cobro == 'MES ANTICIPADO') { $tipo_cobro = 'month'; $numero_alerta = 0; $numero_alerta_correcion = -1;	} 
	else { $tipo_cobro = 'year'; $numero_alerta = 0; $numero_alerta_correcion = 0; }

	$fecha_cobro_notificacion_alerta_renovacion          = date("Y-m-d", strtotime($fecha_inicio_notificacion_alerta_renovacion.' +1 '.$tipo_cobro));
	$fecha_pago                                          = $fecha_cobro_notificacion_alerta_renovacion;

	for ($contador=0; $contador < $numero_cuota ; $contador++) { 

		$numero_alerta++;
		$numero_alerta_correcion++;
		$dia_corte_pago                 = date("d", strtotime($fecha_pago));
		$mes_corte_pago                 = date("m", strtotime($fecha_pago));
		$anyo_corte_pago                = date("Y", strtotime($fecha_pago));
	    $fecha_pago_modif               = $anyo_corte_pago.'-'.$mes_corte_pago.'-'.'01';
	    $fecha_mes_pago_modif           = $anyo_corte_pago.'-'.$mes_corte_pago;
	    $fecha_mes_modif                = date('Y-m-d', strtotime($fecha_pago_modif.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
	    $fecha_mes_real                 = date("Y-m", strtotime($fecha_mes_modif));

		$fecha_pago_alerta_datetime     = DateTime::createFromFormat('Y-m-d', $fecha_mes_modif); //(1) aquí se pone el formato que tiene el dato original
		$ultimo_del_dia	                = $fecha_pago_alerta_datetime->format('t');

		if ($dia_corte_pago > $ultimo_del_dia) { 
			//$fecha_cobro_notificacion_alerta_renovacion              = $fecha_mes_real.'-'.$ultimo_del_dia;
			//$fecha_mes	                    = date("Y-m", strtotime($fecha_cobro_notificacion_alerta_renovacion));
			//$anyo	                        = date("Y", strtotime($fecha_cobro_notificacion_alerta_renovacion));
			//$fecha_pago_periodo_orig        = $fecha_cobro_notificacion_alerta_renovacion;
		} else { 
			//$fecha_cobro_notificacion_alerta_renovacion              = $fecha_mes_real.'-'.$dia_corte_pago;
			//$fecha_mes	                    = date("Y-m", strtotime($fecha_cobro_notificacion_alerta_renovacion));
			//$anyo	                        = date("Y", strtotime($fecha_cobro_notificacion_alerta_renovacion));
			//$fecha_pago_periodo_orig        = $fecha_cobro_notificacion_alerta_renovacion;
		}
		//$dia_pago_propietario                              = date("d", strtotime($dia_pago_propietario_inmueble));
		//$fecha_alerta_mes                                  = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+1 month'));
	/* ----------------------------------------------------------------------------------------------------------/ */
		$agreg = "INSERT INTO tbl15_notificacion_alerta_renovacion (nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, cod_tercero, precio_venta_notificacion_alerta_renovacion, 
		fecha_inicio_notificacion_alerta_renovacion, nombre_tipo_cobro, cod_guia, nombre_tipo_producto, cod_estado, cod_estado_aviso, fecha_creacion, fecha_cobro_notificacion_alerta_renovacion) 
		VALUES ('$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', '$cod_tercero', '$precio_venta_notificacion_alerta_renovacion', 
		'$fecha_inicio_notificacion_alerta_renovacion', '$nombre_tipo_cobro', '$cod_guia', '$nombre_tipo_producto', '$cod_estado', '$cod_estado_aviso', '$fecha_creacion', '$fecha_cobro_notificacion_alerta_renovacion')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------------------/ */
	}
	$data_sql = ("UPDATE tbl15_notificacion_alerta_renovacion SET cod_estado = '0' WHERE cod_notificacion_alerta_renovacion = '$cod_notificacion_alerta_renovacion'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
/*
	$numero_alerta_correcion++;
	$dia_corte_pago                 = date("d", strtotime($fecha_pago));
	$mes_corte_pago                 = date("m", strtotime($fecha_pago));
	$anyo_corte_pago                = date("Y", strtotime($fecha_pago));
    $fecha_pago_modif               = $anyo_corte_pago.'-'.$mes_corte_pago.'-'.'01';
    $fecha_mes_pago_modif           = $anyo_corte_pago.'-'.$mes_corte_pago;
    $fecha_mes_modif                = date('Y-m-d', strtotime($fecha_pago_modif.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
    $fecha_mes_real                 = date("Y-m", strtotime($fecha_mes_modif));

	$fecha_pago_alerta_datetime     = DateTime::createFromFormat('Y-m-d', $fecha_mes_modif); //(1) aquí se pone el formato que tiene el dato original
	$ultimo_del_dia	                = $fecha_pago_alerta_datetime->format('t');

	if ($dia_corte_pago > $ultimo_del_dia) { 
		$fecha_cobro_notificacion_alerta_renovacion              = $fecha_mes_real.'-'.$ultimo_del_dia;
		$fecha_mes	                    = date("Y-m", strtotime($fecha_cobro_notificacion_alerta_renovacion));
		$anyo	                        = date("Y", strtotime($fecha_cobro_notificacion_alerta_renovacion));
		$fecha_pago_periodo_orig        = $fecha_cobro_notificacion_alerta_renovacion;
	} else { 
		$fecha_cobro_notificacion_alerta_renovacion              = $fecha_mes_real.'-'.$dia_corte_pago;
		$fecha_mes	                    = date("Y-m", strtotime($fecha_cobro_notificacion_alerta_renovacion));
		$anyo	                        = date("Y", strtotime($fecha_cobro_notificacion_alerta_renovacion));
		$fecha_pago_periodo_orig        = $fecha_cobro_notificacion_alerta_renovacion;
	}


 	$sql_data = sprintf("UPDATE tbl15_notificacion_alerta_renovacion SET cod_estado = '$cod_estado_inactivo' WHERE (cod_notificacion_alerta_renovacion = '$cod_notificacion_alerta_renovacion')");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = "INSERT INTO tbl15_info_factura_venta (nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, cod_guia, cod_tercero, cod_producto, 
	cod_producto_barra, precio_venta_notificacion_alerta_renovacion, nombre_tipo_producto, nombre_tipo_cobro, fecha_inicio_notificacion_alerta_renovacion, 
	fecha_cobro_notificacion_alerta_renovacion, cod_estado, cod_estado_aviso, fecha_creacion) 
	VALUES ('$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', '$cod_guia', '$cod_tercero', '$cod_producto', 
	'$cod_producto_barra', '$precio_venta_notificacion_alerta_renovacion', '$nombre_tipo_producto', '$nombre_tipo_cobro', '$fecha_inicio_notificacion_alerta_renovacion', 
	'$fecha_cobro_notificacion_alerta_renovacion', '$cod_estado_activo', '$cod_estado_aviso', '$fecha_creacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
*/
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