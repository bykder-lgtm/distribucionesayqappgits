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
<div class="breadcrumbs"><a href="#"><h4>SALDO CAJA</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_caja WHERE cod_movimiento_caja = '1'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$existe_registro = mysqli_num_rows($consulta);

if ($existe_registro == 0) {
	$fecha_ymd_movimiento_caja        = date("Y-m-d");
	$fecha_mes_movimiento_caja        = date("Y-m");
	$fecha_anyo_movimiento_caja       = date("Y");
	$fecha_hora_movimiento_caja       = date("H:i:s");
	$fecha_seg_movimiento_caja        = time();
	$fecha_creacion                   = date("Y-m-d H:i:s");

	$agregar_reg = "INSERT INTO tbl15_movimiento_caja (cod_movimiento_caja, fecha_ymd_movimiento_caja, fecha_mes_movimiento_caja, fecha_anyo_movimiento_caja, fecha_hora_movimiento_caja, fecha_seg_movimiento_caja, fecha_creacion)
	VALUES ('1', '$fecha_ymd_movimiento_caja', '$fecha_mes_movimiento_caja', '$fecha_anyo_movimiento_caja', '$fecha_hora_movimiento_caja', '$fecha_seg_movimiento_caja', '$fecha_creacion')";
	$resultado_cuentas_cobrar = mysqli_query($conectar, $agregar_reg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_egreso_movimiento_caja_fisica.php?cod_movimiento_caja=1">
<?php } ?>

<div class="table-responsive">
 <table class="table">
<thead>
	<tr>
		<th style="text-align:center;">Id</th>
		<!--<th style="text-align:center;">Total Venta Hoy</th>-->
		<th style="text-align:center;">Total Saldo Caja</th>
		<th style="text-align:center;">Fecha</th>
		<?php if ($cod_estado_egreso_editar == '1') { ?><th style="text-align:center;">Edit</th><?php } ?>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_caja WHERE cod_movimiento_caja = '1'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_movimiento_caja                 = $matriz_consulta['cod_movimiento_caja'];
	$total_compra_producto               = $matriz_consulta['total_compra_producto'];
	$total_venta_producto                = $matriz_consulta['total_venta_producto'];
	$total_saldo                         = $matriz_consulta['total_saldo'];
	$fecha_ymd_movimiento_caja           = $matriz_consulta['fecha_ymd_movimiento_caja'];
	$fecha_mes_movimiento_caja           = $matriz_consulta['fecha_mes_movimiento_caja'];
	$fecha_anyo_movimiento_caja          = $matriz_consulta['fecha_anyo_movimiento_caja'];
	$fecha_hora_movimiento_caja          = $matriz_consulta['fecha_hora_movimiento_caja'];
	$fecha_seg_movimiento_caja           = $matriz_consulta['fecha_seg_movimiento_caja'];
	$fecha_creacion                      = $matriz_consulta['fecha_creacion'];
	$fecha_modificacion                  = $matriz_consulta['fecha_modificacion'];
	$ip                                  = $matriz_consulta['ip'];
	$cuenta                              = $matriz_consulta['cuenta'];
?>
	<tr>
		<td style="text-align:center;"><?php echo $cod_movimiento_caja; ?></td>
		<!--<td ><?php echo number_format($total_venta_producto, 0, ",", "."); ?></td>-->
		<td style="text-align:center;"><?php echo number_format($total_saldo, 0, ",", "."); ?></td>
		<td style="text-align:center;"><?php echo $fecha_ymd_movimiento_caja; ?></td>
		<?php if ($cod_estado_egreso_editar == '1') { ?><td style="text-align:center;"><a href="../admin/edit_egreso_movimiento_caja_fisica.php?cod_movimiento_caja=<?php echo $cod_movimiento_caja?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td><?php } ?>
	</tr>
<?php
}
?>
</tr>
</tbody>
</table>
</div>
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