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

<div class="breadcrumbs">
<a href="#"><h4>Modificaciones Manuales Cuentas Personales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_parametrizacion_movimiento_contable_cuenta_personal.php">Saldo Cuentas Personales Activas</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local = $_SERVER['PHP_SELF'];
$pagina = $_SERVER['PHP_SELF'];
?>

<div class="table-responsive">

<table class="table table-striped">
	<thead>
		<tr>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;">ELIM</th>-->
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">ID</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">CODIGO PUC</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">CUENTA PUC</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">SALDO VIEJO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">SALDO NUEVO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">USUARIO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">FECHA MODIFICACION</th>
		</tr>
	</thead>
	<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal_historial_modificacion ORDER BY cod_movimiento_contable_cuenta_personal_historial_modificacion DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_movimiento_contable_cuenta_personal_historial_modificacion      = $matriz_consulta['cod_movimiento_contable_cuenta_personal_historial_modificacion'];
    $cod_movimiento_contable_cuenta_personal                             = $matriz_consulta['cod_movimiento_contable_cuenta_personal'];
    $total_saldo_viejo_modificacion                                      = $matriz_consulta['total_saldo_viejo_modificacion'];
    $total_saldo_nuevo_modificacion                                      = $matriz_consulta['total_saldo_nuevo_modificacion'];
    $fecha_creacion                                                      = $matriz_consulta['fecha_creacion'];
    $fecha_modificacion                                                  = $matriz_consulta['fecha_modificacion'];
    $cuenta                                                              = $matriz_consulta['cuenta'];
    $cod_puc                                                             = $matriz_consulta['cod_puc'];
    $codigo_puc                                                          = $matriz_consulta['codigo_puc'];
    $nombre_puc                                                          = $matriz_consulta['nombre_puc'];
    $cod_administrador                                                   = $matriz_consulta['cod_administrador'];
?>
		<tr>
			<td style="text-align:center;"><?php echo $cod_movimiento_contable_cuenta_personal_historial_modificacion ?></td>
			<td style="text-align:center;"><?php echo $codigo_puc ?></td>
            <td style="text-align:left;"><?php echo $nombre_puc ?></td>
            <td style="text-align:right;"><?php echo number_format($total_saldo_viejo_modificacion, 0, ",", "."); ?></td>
            <td style="text-align:right;"><?php echo number_format($total_saldo_nuevo_modificacion, 0, ",", "."); ?></td>
            <td style="text-align:center;"><?php echo $cuenta ?></td>
            <td style="text-align:center;"><?php echo $fecha_modificacion ?></td>
		</tr>
	<?php } ?>
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