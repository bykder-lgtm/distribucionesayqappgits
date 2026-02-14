<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/lista_alquiler_renta.php"><h4>Lista de Alquileres - Rentas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
Lista de Alquileres - Rentas Archivados</h4>
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina                 = $_SERVER['PHP_SELF'];
$fecha_hoy              = date("Y-m-d");
?>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
	<th style="text-align:center">TERCERO</th>
	<th style="text-align:center"></th>
	<th style="text-align:center">VALOR</th>
	<th style="text-align:center">FECHA INICIO</th>
	<th style="text-align:center">FECHA FINAL</th>
	<!--
	<th style="text-align:center">RENOVACION VENCE EN</th>
	<th style="text-align:center">ESTADO</th>
-->
	<th style="text-align:center">ID</th>
	<th style="text-align:center">FECHA ENTREGA</th>
	<!--<th style="text-align:center">MARCAR ENTREGA</th>-->
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta WHERE (fecha_fin_renta_alquiler <> '') AND (nombre_estado_factura = 'CERRADA') AND (cod_estado_alquiler_renta = '0') ORDER BY fecha_fin_renta_alquiler ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_info_factura_venta                          = $matriz_consulta['cod_info_factura_venta'];
	$cod_tercero                                     = $matriz_consulta['cod_tercero'];
	$cod_factura                                     = $matriz_consulta['cod_factura'];
	$total_precio_venta                              = $matriz_consulta['total_precio_venta'];
	$fecha_ini_renta_alquiler                        = $matriz_consulta['fecha_ini_renta_alquiler'];
	$fecha_fin_renta_alquiler                        = $matriz_consulta['fecha_fin_renta_alquiler'];
	$cod_estado_alquiler_renta                       = $matriz_consulta['cod_estado_alquiler_renta'];
	$fecha_entrega_renta_alquiler                    = $matriz_consulta['fecha_entrega_renta_alquiler'];
	$hora_entrega_renta_alquiler                     = $matriz_consulta['hora_entrega_renta_alquiler'];

    $sql_tipo_notificacion_alerta_renovacion = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_tipo_notificacion_alerta_renovacion = mysqli_query($conectar, $sql_tipo_notificacion_alerta_renovacion);
    $datos_tipo_notificacion_alerta_renovacion = mysqli_fetch_assoc($consulta_tipo_notificacion_alerta_renovacion);

    $nombre1_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre1_tercero'];
    $nombre2_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre2_tercero'];
    $apellido1_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido1_tercero'];
    $apellido2_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido2_tercero'];

	$nombres_apellidos_tercero                       = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
    $nombre_producto_concat                          = '';

    $sql_datos_venta_temp = "SELECT cod_producto_barra, und_venta, nombre_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
        $und_venta_con                       = $datos_venta_temp['und_venta'];
        $nombre_producto_concat             .= "".$nombre_producto_con.' | <br>';
    }

    $sql_estado = "SELECT * FROM tbl15_estado WHERE (cod_estado = '$cod_estado_alquiler_renta')";
    $consulta_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($consulta_estado);

    $nombre_estado                                   = $datos_estado['nombre_estado'];

	$fecha_ini_seg                                   = strtotime($fecha_hoy);
	$fecha_fin_seg                                   = strtotime($fecha_fin_renta_alquiler);
	$fecha_dif_seg                                   = floor($fecha_fin_seg - $fecha_ini_seg);
	$dias_vence_vigencia                             = ($fecha_dif_seg / (60 * 60 * 24));
    if ($dias_vence_vigencia < 0) { $titulo_alerta = '(VENCIO HACE '.abs($dias_vence_vigencia).' DIAS)'; $color_alerta_fondo = 'background-color:#A40000'; $color_alerta_letra = 'color:#FFFFFF'; } elseif ($dias_vence_vigencia > 0) { $titulo_alerta  = '(FALTAN '.abs($dias_vence_vigencia).' DIAS)'; $color_alerta_fondo = 'background-color:#DBE0F3'; $color_alerta_letra = 'color:#000000'; } else { $titulo_alerta  = '(ES HOY)'; $color_alerta_fondo = 'background-color:#009933'; $color_alerta_letra = 'color:#000000'; }
?>
<tr>
	<td style="text-align:left; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombres_apellidos_tercero; ?></td>
	<td style="text-align:left; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombre_producto_concat; ?></td>
	<td style="text-align:left; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo number_format($total_precio_venta, 0, ",", "."); ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $fecha_ini_renta_alquiler; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $fecha_fin_renta_alquiler; ?></td>
	<!--
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $titulo_alerta; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombre_estado; ?></td>
-->
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $cod_info_factura_venta; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $fecha_entrega_renta_alquiler; ?> | <?php echo $hora_entrega_renta_alquiler; ?></td>
	<!--<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><a href="../admin/marcar_entrega_alquiler_renta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/active.png" class="img-polaroid" alt=""></a></td>-->
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
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>