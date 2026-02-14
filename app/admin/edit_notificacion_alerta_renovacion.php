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
<?php
$cod_notificacion_alerta_renovacion              = intval($_GET['cod_notificacion_alerta_renovacion']);
$pagina                                          = addslashes($_GET['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_notificacion_alerta_renovacion WHERE cod_notificacion_alerta_renovacion = '$cod_notificacion_alerta_renovacion'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

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
$cantidad_dias_antelacion_alerta                 = $matriz_consulta['cantidad_dias_antelacion_alerta'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Renovaciones y Alertas</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_notificacion_alerta_renovacion_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
		    <th style="text-align:center">NOMBRE RENOVACION</th>
		    <th style="text-align:center">DESCRIPCION RENOVACION</th>
		    <th style="text-align:center; width:250px;">TERCERO</th>
		    <th style="text-align:center">COSTO RENOVACION</th>
		    <th style="text-align:center">TIPO COBRO</th>
		    <th style="text-align:center">FECHA INICIO</th>
		    <th style="text-align:center">FECHA COBRO</th>
      		<th style="text-align:center">DIAS ANTELACION ALERTA</th>
		    <th style="text-align:center">ESTADO</th>
		</tr>
	</thead>
    <tbody>
	    <tr>
		    <td style="text-align:center;"><textarea id="nombre_notificacion_alerta_renovacion" name="nombre_notificacion_alerta_renovacion" class="input-block-level" rows="5" cols="10"><?php echo $nombre_notificacion_alerta_renovacion ?></textarea></td>
			<td style="text-align:center;"><textarea id="descipcion_notificacion_alerta_renovacion" name="descipcion_notificacion_alerta_renovacion" class="input-block-level" rows="5" cols="10"><?php echo $descipcion_notificacion_alerta_renovacion ?></textarea></td>
		    <th style="text-align:left;">
		        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
		            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>"; } else { echo  "<option value='' selected ></option>"; }
		            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
		            FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
		            $consulta2 = mysqli_query($conectar, $consulta2_sql);
		            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
		            $seleccionado = "selected"; } else { $seleccionado = ""; }
		            $codigo = $datos2['cod_tercero'];
            		$nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
		            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		        </select>
		    </td>
		    <td style="text-align:center;"><input class="input-block-level" name="precio_venta_notificacion_alerta_renovacion" type="number" value="<?php echo $precio_venta_notificacion_alerta_renovacion ?>" placeholder="" /></td>

		    <td style="text-align:center;">
		        <select name="nombre_tipo_cobro" class="input-block-level">
		            <?php if (isset($nombre_tipo_cobro)) { echo "<option value='' $seleccionado >NINGUNO</option>"; } else { echo "<option value='' $seleccionado >NINGUNO</option>"; }
		            $consulta2_sql = "SELECT cod_tipo_cobro, nombre_tipo_cobro FROM tbl15_tipo_cobro WHERE (cod_estado = '1') ORDER BY nombre_tipo_cobro ASC";
		            $consulta2 = mysqli_query($conectar, $consulta2_sql);
		            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		            if(isset($nombre_tipo_cobro) AND $nombre_tipo_cobro == $datos2['nombre_tipo_cobro']) {
		            $seleccionado = "selected"; } else { $seleccionado = ""; }
		            $codigo = $datos2['nombre_tipo_cobro'];
		            $nombre = $datos2['nombre_tipo_cobro'];
		            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		        </select>
		    </td>

		    <td style="text-align:center;"><input class="input-block-level" name="fecha_inicio_notificacion_alerta_renovacion" type="date" value="<?php echo $fecha_inicio_notificacion_alerta_renovacion ?>" placeholder="" required/></td>
		    <td style="text-align:center;"><input class="input-block-level" name="fecha_cobro_notificacion_alerta_renovacion" type="date" value="<?php echo $fecha_cobro_notificacion_alerta_renovacion ?>" placeholder="" required/></td>
      		<td style="text-align:center;"><input class="input-block-level" name="cantidad_dias_antelacion_alerta" type="number" value="<?php echo $cantidad_dias_antelacion_alerta ?>" placeholder="" /></td>

		    <td style="text-align:center;">
		        <select name="cod_estado" class="input-block-level">
		            <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
		            $consulta2_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
		            $consulta2 = mysqli_query($conectar, $consulta2_sql);
		            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		            if(isset($cod_estado) AND $cod_estado == $datos2['cod_estado']) {
		            $seleccionado = "selected"; } else { $seleccionado = ""; }
		            $codigo = $datos2['cod_estado'];
		            $nombre = $datos2['nombre_estado'];
		            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		        </select>
		    </td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_notificacion_alerta_renovacion" value="<?php echo $cod_notificacion_alerta_renovacion ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
</fieldset>
</form>
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