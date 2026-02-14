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

	$cod_movimiento_contable_cuenta_personal     = intval($_POST['cod_movimiento_contable_cuenta_personal']);
	$total_saldo                                 = addslashes($_POST['total_saldo']);
	$fecha_ymd_movimiento_caja                   = addslashes($_POST['fecha_ymd_movimiento_caja']);
	$cod_tipo_forma_pago                         = intval($_POST['cod_tipo_forma_pago']);
	$cod_estado                                  = intval($_POST['cod_estado']);
	$fecha_mes_movimiento_caja                   = date("Y-m", strtotime($fecha_ymd_movimiento_caja));
	$fecha_anyo_movimiento_caja                  = date("Y", strtotime($fecha_ymd_movimiento_caja));
	$fecha_hora_movimiento_caja                  = date("H:i:s");
	$fecha_creacion                              = date("Y-m-d");
	$fecha_modificacion                          = date("Y-m-d H:i:s");
	$fecha_seg_movimiento_caja                   = time();
	$fecha_time                                  = time();
	$cuenta                                      = $cuenta_actual;

	$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$total_saldo_viejo_modificacion              = $matriz_consulta['total_saldo'];
	$total_saldo_nuevo_modificacion              = $total_saldo;
    $cod_puc                                     = $matriz_consulta['cod_puc'];
    $codigo_puc                                  = $matriz_consulta['codigo_puc'];
    $nombre_puc                                  = $matriz_consulta['nombre_puc'];
    $tipo_puc                                    = $matriz_consulta['tipo_puc'];

	$sql_data = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_historial_modificacion (cod_movimiento_contable_cuenta_personal, total_saldo_viejo_modificacion, total_saldo_nuevo_modificacion, 
	cod_puc, codigo_puc, nombre_puc, tipo_puc, cuenta, cod_administrador, fecha_creacion, fecha_modificacion, fecha_time) 
	VALUES ('$cod_movimiento_contable_cuenta_personal', '$total_saldo_viejo_modificacion', '$total_saldo_nuevo_modificacion', 
	'$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$cuenta', '$cod_administrador', '$fecha_creacion', '$fecha_modificacion', '$fecha_time')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', fecha_ymd_movimiento_caja = '$fecha_ymd_movimiento_caja', fecha_mes_movimiento_caja = '$fecha_mes_movimiento_caja', 
	fecha_anyo_movimiento_caja = '$fecha_anyo_movimiento_caja', fecha_hora_movimiento_caja = '$fecha_hora_movimiento_caja', fecha_seg_movimiento_caja = '$fecha_seg_movimiento_caja', 
	cod_estado = '$cod_estado', cod_tipo_forma_pago = '$cod_tipo_forma_pago'
	WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_parametrizacion_movimiento_contable_cuenta_personal.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_parametrizacion_movimiento_contable_cuenta_personal.php">
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