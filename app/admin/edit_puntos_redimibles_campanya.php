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
<?php $pagina = addslashes($_GET['pagina']); ?>

<?php
$cod_puntos_redimibles_campanya                           = intval($_GET['cod_puntos_redimibles_campanya']);

$mostrar_datos_sql = "SELECT * FROM tbl15_puntos_redimibles_campanya  WHERE (cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_puntos_redimibles_campanya                        = $matriz_consulta['nombre_puntos_redimibles_campanya'];
$valor_puntos_redimibles_campanya                         = $matriz_consulta['valor_puntos_redimibles_campanya'];
$cantidad_puntos_x_valor_redimibles_campanya              = $matriz_consulta['cantidad_puntos_x_valor_redimibles_campanya'];
$fecha_creacion                                           = $matriz_consulta['fecha_creacion'];
$cod_estado                                               = $matriz_consulta['cod_estado'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Campaña Puntos Redimibles</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_puntos_redimibles_campanya_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">COD</th>
			<th style="text-align:center">NOMBRE CAMPAÑA PUNTOS REDIMIBLES</th>
      		<th style="text-align:center">POR CADA ($PESOS)</th>
			<th style="text-align:center">GANAS (PUNTO)</th>
			<th style="text-align:center">EQUIVALENCIA EN PESOS DE UN PUNTO (VALOR DEL PUNTO)</th>
			<th style="text-align:center">ESTADO</th>
			<th style="text-align:center">FECHA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><?php echo ($cod_puntos_redimibles_campanya) ?></td>
			<td style="text-align:center;"><input class="input-block-level" name="nombre_puntos_redimibles_campanya" type="text" value="<?php echo ($nombre_puntos_redimibles_campanya) ?>" placeholder="" required/></td>
			<td style="text-align:center;"><input class="input-block-level" name="valor_puntos_redimibles_campanya" type="number" value="<?php echo ($valor_puntos_redimibles_campanya) ?>" placeholder="" min="1" required/></td>
      		<td style="text-align:center;"><input class="input-block-level" name="cantidad_puntos_x_valor_redimibles_campanya" type="number" value="<?php echo ($cantidad_puntos_x_valor_redimibles_campanya) ?>" readonly placeholder="" min="1" required/></td>
      		<td style="text-align:center;"><input class="input-block-level" name="equivalencia_en_pesos_de_un_punto" type="number" value="<?php echo ($equivalencia_en_pesos_de_un_punto) ?>" placeholder="" min="0" required/></td>
			<td style="text-align:center">
				<select name="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
					<?php if (isset($cod_estado)) { echo "";
					} else { echo  ""; }
					$consulta2_sql = ("SELECT cod_tipo_estado, nombre_tipo_estado FROM tbl15_tipo_estado ORDER BY cod_tipo_estado ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_estado) and $cod_estado == $datos2['cod_tipo_estado']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tipo_estado'];
					$nombre = $datos2['nombre_tipo_estado'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><?php echo ($fecha_creacion) ?></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_puntos_redimibles_campanya" value="<?php echo $cod_puntos_redimibles_campanya ?>"/>
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