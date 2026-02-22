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
$pagina_else                = addslashes($_POST['pagina']);
$numero_alerta              = 0;

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	$mostrar_datos_sql = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_notificacion_alerta_renovacion";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	if (isset($_POST['nombre_notificacion_alerta_renovacion']) <> '') { $nombre_notificacion_alerta_renovacion_post = addslashes($_POST['nombre_notificacion_alerta_renovacion']); } else { $nombre_notificacion_alerta_renovacion_post = ''; }
	if (isset($_POST['descipcion_notificacion_alerta_renovacion']) <> '') { $descipcion_notificacion_alerta_renovacion_post = addslashes($_POST['descipcion_notificacion_alerta_renovacion']); } else { $descipcion_notificacion_alerta_renovacion_post = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
	if (isset($_POST['precio_venta_notificacion_alerta_renovacion']) <> '') { $precio_venta_notificacion_alerta_renovacion = intval($_POST['precio_venta_notificacion_alerta_renovacion']); } else { $precio_venta_notificacion_alerta_renovacion = ''; }
	if (isset($_POST['fecha_inicio_notificacion_alerta_renovacion']) <> '') { $fecha_inicio_notificacion_alerta_renovacion_post = addslashes($_POST['fecha_inicio_notificacion_alerta_renovacion']); } else { $fecha_inicio_notificacion_alerta_renovacion_post = ''; }
	if (isset($_POST['nombre_tipo_cobro']) <> '') { $nombre_tipo_cobro = addslashes($_POST['nombre_tipo_cobro']); } else { $nombre_tipo_cobro = ''; }
	if (isset($_POST['cantidad_dias_antelacion_alerta']) <> '') { $cantidad_dias_antelacion_alerta = intval($_POST['cantidad_dias_antelacion_alerta']); } else { $cantidad_dias_antelacion_alerta = ''; }
	if (isset($_POST['numero_cuota']) <> '') { $numero_cuota = intval($_POST['numero_cuota']); } else { $numero_cuota = '1'; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$cod_guia                           = $matriz_consulta['cod_guia'] + 1;
	$nombre_tipo_producto               = "SERVICIO";
	$cod_estado                         = 0;
	$cod_estado_aviso                   = 0;
	$fecha_creacion                     = date("Y-m-d H:i:s");
	$total_numero_cuota                 = $numero_cuota;
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($nombre_tipo_cobro == 'DIARIO') { 
		$tipo_cobro                     = 'day';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'SEMANAL') {
		$tipo_cobro                     = 'week';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'QUINCENAL') {
		$tipo_cobro                     = 'week';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'MES VENCIDO') {
		$tipo_cobro                     = 'month';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'MES ANTICIPADO') {
		$tipo_cobro                     = 'month';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = -1;
	} else {
		$tipo_cobro                     = 'year';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	for ($contador=0; $contador < $numero_cuota ; $contador++) { 

		$numero_alerta++;
		$numero_alerta_correcion++;
		$dia_corte_pago                                      = date("d", strtotime($fecha_inicio_notificacion_alerta_renovacion_post));
		$mes_corte_pago                                      = date("m", strtotime($fecha_inicio_notificacion_alerta_renovacion_post));
		$anyo_corte_pago                                     = date("Y", strtotime($fecha_inicio_notificacion_alerta_renovacion_post));
	    $fecha_pago_modif                                    = $anyo_corte_pago.'-'.$mes_corte_pago.'-'.'01';
	    $fecha_mes_pago_modif                                = $anyo_corte_pago.'-'.$mes_corte_pago;
	    $fecha_mes_modif                                     = date('Y-m-d', strtotime($fecha_pago_modif.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
	    $fecha_mes_real                                      = date("Y-m", strtotime($fecha_mes_modif));

		$fecha_pago_alerta_datetime                          = DateTime::createFromFormat('Y-m-d', $fecha_mes_modif); //(1) aquí se pone el formato que tiene el dato original
		$ultimo_del_dia	                                     = $fecha_pago_alerta_datetime->format('t');

		if ($dia_corte_pago > $ultimo_del_dia) { 
			$fecha_pago_alerta                               = $fecha_mes_real.'-'.$ultimo_del_dia;
			$fecha_mes	                                     = date("Y-m", strtotime($fecha_pago_alerta));
			$anyo	                                         = date("Y", strtotime($fecha_pago_alerta));
			$fecha_inicio_notificacion_alerta_renovacion     = $fecha_pago_alerta;
		} else { 
			$fecha_pago_alerta                               = $fecha_mes_real.'-'.$dia_corte_pago;
			$fecha_mes	                                     = date("Y-m", strtotime($fecha_pago_alerta));
			$anyo	                                         = date("Y", strtotime($fecha_pago_alerta));
			$fecha_inicio_notificacion_alerta_renovacion     = $fecha_pago_alerta;
		}

		$nombre_notificacion_alerta_renovacion               = $nombre_notificacion_alerta_renovacion_post;
		$descipcion_notificacion_alerta_renovacion           = $descipcion_notificacion_alerta_renovacion_post.' | '.$numero_alerta.' DE '.$numero_cuota;
		$fecha_cobro_notificacion_alerta_renovacion          = $fecha_pago_alerta;
		//$fecha_cobro_notificacion_alerta_renovacion          = date("Y-m-d", strtotime($fecha_inicio_notificacion_alerta_renovacion.' - '.$cantidad_dias_antelacion_alerta.' DAY'));

		$cod_administrador_sesion = $_SESSION['cod_administrador'];
		$sql_admin_tienda = "SELECT cod_tienda FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_sesion'";
		$consulta_admin_tienda = mysqli_query($conectar, $sql_admin_tienda);
		$datos_admin_tienda = mysqli_fetch_assoc($consulta_admin_tienda);
		$cod_tienda_sesion = isset($datos_admin_tienda['cod_tienda']) ? $datos_admin_tienda['cod_tienda'] : 0;

		$agreg = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, cod_tercero, precio_venta_notificacion_alerta_renovacion, 
		fecha_inicio_notificacion_alerta_renovacion, nombre_tipo_cobro, cod_guia, nombre_tipo_producto, cod_estado, cod_estado_aviso, fecha_creacion, 
		fecha_cobro_notificacion_alerta_renovacion, cantidad_dias_antelacion_alerta, total_numero_cuota, numero_cuota, numero_alerta) 
		VALUES ('$cod_administrador_sesion', '$cod_tienda_sesion', UPPER('$nombre_notificacion_alerta_renovacion'), UPPER('$descipcion_notificacion_alerta_renovacion'), '$cod_tercero', '$precio_venta_notificacion_alerta_renovacion', 
		'$fecha_inicio_notificacion_alerta_renovacion', '$nombre_tipo_cobro', '$cod_guia', '$nombre_tipo_producto', '$cod_estado', '$cod_estado_aviso', '$fecha_creacion', 
		'$fecha_cobro_notificacion_alerta_renovacion', '$cantidad_dias_antelacion_alerta', '$total_numero_cuota', '$numero_cuota', '$numero_alerta')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	}
/* ----------------------------------------------------------------------------------------------------------/ */
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_notificacion_alerta_renovacion.php">
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