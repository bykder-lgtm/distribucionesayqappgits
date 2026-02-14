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
<a href="../admin/lista_parametrizacion_movimiento_contable_cuenta_personal.php"><h4>Cuentas Personales Activas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="#">Cuentas Personales Inactivas</h4></a>
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
?>

<div class="table-responsive">

<table class="table table-striped">
	<thead>
		<tr>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;">ELIM</th>-->
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">ID</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">ID PUC</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000;">CODIGO PUC</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000;">CUENTA PUC</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">SALDO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
            <?php if ($cod_estado_egreso_editar == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">EDIT</th><?php } ?>
		</tr>
	</thead>
	<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_estado <> '1') ORDER BY cod_movimiento_contable_cuenta_personal";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_movimiento_contable_cuenta_personal     = $matriz_consulta['cod_movimiento_contable_cuenta_personal'];
    $total_compra_producto                       = $matriz_consulta['total_compra_producto'];
    $total_venta_producto                        = $matriz_consulta['total_venta_producto'];
    $total_saldo                                 = $matriz_consulta['total_saldo'];
    $fecha_ymd_movimiento_caja                   = $matriz_consulta['fecha_ymd_movimiento_caja'];
    $fecha_mes_movimiento_caja                   = $matriz_consulta['fecha_mes_movimiento_caja'];
    $fecha_anyo_movimiento_caja                  = $matriz_consulta['fecha_anyo_movimiento_caja'];
    $fecha_hora_movimiento_caja                  = $matriz_consulta['fecha_hora_movimiento_caja'];
    $fecha_seg_movimiento_caja                   = $matriz_consulta['fecha_seg_movimiento_caja'];
    $fecha_creacion                              = $matriz_consulta['fecha_creacion'];
    $fecha_modificacion                          = $matriz_consulta['fecha_modificacion'];
    $cuenta                                      = $matriz_consulta['cuenta'];
    $cod_puc                                     = $matriz_consulta['cod_puc'];
    $codigo_puc                                  = $matriz_consulta['codigo_puc'];
    $nombre_puc                                  = $matriz_consulta['nombre_puc'];
    $tipo_puc                                    = $matriz_consulta['tipo_puc'];
    $saldo_inicial_puc                           = $matriz_consulta['saldo_inicial_puc'];
    $subtotal_puc                                = $matriz_consulta['subtotal_puc'];
    $saldo_actual_puc                            = $matriz_consulta['saldo_actual_puc'];
    $nombre_modulo_puc                           = $matriz_consulta['nombre_modulo_puc'];
?>
		<tr>
            <!--<td style="text-align:center;"><a href="../admin/eliminar_parametrizacion_puc_movimiento_contable.php?cod_parametrizacion_puc_movimiento_contable=<?php echo $cod_parametrizacion_puc_movimiento_contable?>&nombre_modulo_puc=<?php echo $nombre_modulo_puc?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
			<td style="text-align:center;"><?php echo $cod_movimiento_contable_cuenta_personal ?></td>
			<td style="text-align:center;"><?php echo $cod_puc ?></td>
			<td style="text-align:center;"><?php echo $codigo_puc ?></td>
            <td style="text-align:left;"><?php echo $nombre_puc ?></td>
            <td style="text-align:center;"><?php echo number_format($total_saldo, 0, ",", "."); ?></td>
            <td style="text-align:center;"><?php echo $fecha_ymd_movimiento_caja ?></td>
            <?php if ($cod_estado_egreso_editar == '1') { ?><td style="text-align:center;"><a href="../admin/edit_movimiento_contable_cuenta_personal.php?cod_movimiento_contable_cuenta_personal=<?php echo $cod_movimiento_contable_cuenta_personal?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td><?php } ?>
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