<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery.js" type="text/javascript"></script> 
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
<a href="#"><h4>Registrar Renovaciones y Alertas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_notificacion_alerta_renovacion.php">Lista de Renovaciones y Alertas</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF']; ?>

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_notificacion_alerta_renovacion_reg.php">
<fieldset>

<table border="1" class="table table-responsive">
	<thead>
		<tr>
      <th style="text-align:center">NOMBRE RENOVACION</th>
      <th style="text-align:center">DESCRIPCION RENOVACION</th>
      <th style="text-align:center; width:250px;">TERCERO</th>
      <th style="text-align:center">COSTO RENOVACION</th>
      <th style="text-align:center">TIPO COBRO</th>
      <th style="text-align:center">FECHA INICIO</th>
      <th style="text-align:center">TOTAL NUMERO DE CUOTAS</th>
      <th style="text-align:center">DIAS ANTELACION ALERTA</th>
		</tr>
	</thead>
    <tbody>
    <tr>
      <td style="text-align:center;"><textarea id="nombre_notificacion_alerta_renovacion" name="nombre_notificacion_alerta_renovacion" class="input-block-level" rows="5" cols="10"></textarea></td>
			<td style="text-align:center;"><textarea id="descipcion_notificacion_alerta_renovacion" name="descipcion_notificacion_alerta_renovacion" class="input-block-level" rows="5" cols="10"></textarea></td>
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
      <td style="text-align:center;"><input class="input-block-level" name="precio_venta_notificacion_alerta_renovacion" type="number" value="" placeholder="" /></td>

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
      
      <td style="text-align:center;"><input class="input-block-level" name="fecha_inicio_notificacion_alerta_renovacion" type="date" value="<?php echo date("Y-m-d") ?>" placeholder="" required/></td>
      <td style="text-align:center;"><input class="input-block-level" name="numero_cuota" type="number" value="1" placeholder="" /></td>
      <td style="text-align:center;"><input class="input-block-level" name="cantidad_dias_antelacion_alerta" type="number" value="15" placeholder="" /></td>
		</tr>
    	</tbody>
</table>

<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>