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
<a href="../admin/menu_lista.php"><h4>Lista de Renovaciones y Alertas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="../admin/lista_notificacion_alerta_renovacion_inhabilitado.php">.</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../admin/reg_notificacion_alerta_renovacion.php">Registrar Renovaciones y Alertas</h4></a>
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
	<th style="text-align:center">NOMBRE RENOVACION</th>
	<th style="text-align:center">DESCRIPCION RENOVACION</th>
	<th style="text-align:center">TERCERO</th>
	<th style="text-align:center">COSTO RENOVACION</th>
	<th style="text-align:center">FECHA INICIO</th>
	<th style="text-align:center">FECHA COBRO</th>
	<th style="text-align:center">VENCE EN</th>
	<th style="text-align:center">TIPO COBRO</th>
	<th style="text-align:center">TIPO PRODUCTO</th>
	<th style="text-align:center">ESTADO</th>
	<th style="text-align:center">ID</th>
	<th style="text-align:center">DUPL</th>
	<th style="text-align:center">EDIT</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_notificacion_alerta_renovacion WHERE (cod_estado = '1') ORDER BY fecha_cobro_notificacion_alerta_renovacion ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_notificacion_alerta_renovacion              = $matriz_consulta['cod_notificacion_alerta_renovacion'];
	$nombre_notificacion_alerta_renovacion           = $matriz_consulta['nombre_notificacion_alerta_renovacion'];
	$descipcion_notificacion_alerta_renovacion       = $matriz_consulta['descipcion_notificacion_alerta_renovacion'];
	$cod_guia                                        = $matriz_consulta['cod_guia'];
	$cod_tercero                                     = $matriz_consulta['cod_tercero'];
	$cod_producto                                    = $matriz_consulta['cod_producto'];
	$cod_producto_barra                              = $matriz_consulta['cod_producto_barra'];
	$precio_venta_notificacion_alerta_renovacion     = $matriz_consulta['precio_venta_notificacion_alerta_renovacion'];
	$cod_venta_producto                              = $matriz_consulta['cod_venta_producto'];
	$cod_info_factura_venta                          = $matriz_consulta['cod_info_factura_venta'];
	$cod_factura                                     = $matriz_consulta['cod_factura'];
	$nombre_tipo_producto                            = $matriz_consulta['nombre_tipo_producto'];
	$nombre_tipo_cobro                               = $matriz_consulta['nombre_tipo_cobro'];
	$fecha_inicio_notificacion_alerta_renovacion     = $matriz_consulta['fecha_inicio_notificacion_alerta_renovacion'];
	$fecha_cobro_notificacion_alerta_renovacion      = $matriz_consulta['fecha_cobro_notificacion_alerta_renovacion'];
	$cod_estado                                      = $matriz_consulta['cod_estado'];
	$cod_estado_aviso                                = $matriz_consulta['cod_estado_aviso'];
	$fecha_creacion                                  = $matriz_consulta['fecha_creacion'];
	$fecha_modificacion                              = $matriz_consulta['fecha_modificacion'];

    $sql_tipo_notificacion_alerta_renovacion = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_tipo_notificacion_alerta_renovacion = mysqli_query($conectar, $sql_tipo_notificacion_alerta_renovacion);
    $datos_tipo_notificacion_alerta_renovacion = mysqli_fetch_assoc($consulta_tipo_notificacion_alerta_renovacion);

    $nombre1_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre1_tercero'];
    $nombre2_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre2_tercero'];
    $apellido1_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido1_tercero'];
    $apellido2_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido2_tercero'];

	$nombres_apellidos_tercero                       = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

    $sql_estado = "SELECT * FROM tbl15_estado WHERE (cod_estado = '$cod_estado')";
    $consulta_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($consulta_estado);

    $nombre_estado                                   = $datos_estado['nombre_estado'];

	$fecha_ini_seg                                   = strtotime($fecha_hoy);
	$fecha_fin_seg                                   = strtotime($fecha_cobro_notificacion_alerta_renovacion);
	$fecha_dif_seg                                   = floor($fecha_fin_seg - $fecha_ini_seg);
	$dias_vence_vigencia                             = ($fecha_dif_seg / (60 * 60 * 24));
    if ($dias_vence_vigencia < 0) { $titulo_alerta = '(VENCIO HACE '.abs($dias_vence_vigencia).' DIAS)'; $color_alerta_fondo = 'background-color:#A40000'; $color_alerta_letra = 'color:#FFFFFF'; } elseif ($dias_vence_vigencia > 0) { $titulo_alerta  = '(FALTAN '.abs($dias_vence_vigencia).' DIAS)'; $color_alerta_fondo = 'background-color:#DBE0F3'; $color_alerta_letra = 'color:#000000'; } else { $titulo_alerta  = '(ES HOY)'; $color_alerta_fondo = 'background-color:#009933'; $color_alerta_letra = 'color:#000000'; }
?>
<tr>
	<td style="text-align:left; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombre_notificacion_alerta_renovacion; ?></td>
	<td style="text-align:left; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $descipcion_notificacion_alerta_renovacion; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombres_apellidos_tercero; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo number_format($precio_venta_notificacion_alerta_renovacion, 0, ",", "."); ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $fecha_inicio_notificacion_alerta_renovacion; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $fecha_cobro_notificacion_alerta_renovacion; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $titulo_alerta; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombre_tipo_cobro; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombre_tipo_producto; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $nombre_estado; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><?php echo $cod_notificacion_alerta_renovacion; ?></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><a href="../admin/duplicar_notificacion_alerta_renovacion_reg.php?cod_notificacion_alerta_renovacion=<?php echo $cod_notificacion_alerta_renovacion?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/duplicar_factura_venta.png" class="img-polaroid" alt=""></a></td>
	<td style="text-align:center; <?php echo $color_alerta_fondo; ?>; <?php echo $color_alerta_letra; ?>"><a href="../admin/edit_notificacion_alerta_renovacion.php?cod_notificacion_alerta_renovacion=<?php echo $cod_notificacion_alerta_renovacion?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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