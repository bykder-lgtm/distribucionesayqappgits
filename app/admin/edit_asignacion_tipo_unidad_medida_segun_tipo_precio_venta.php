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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Asignacion de Precios Segun Tipo de Venta</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_tipo_unidad_medida                  = intval($_GET['cod_tipo_unidad_medida']);

$mostrar_datos_sql = "SELECT * FROM tbl15_tipo_unidad_medida WHERE cod_tipo_unidad_medida = '$cod_tipo_unidad_medida'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_tipo_unidad_medida                  = $matriz_consulta['cod_tipo_unidad_medida'];
$nombre_tipo_unidad_medida               = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_completo_tipo_unidad_medida      = $matriz_consulta['nombre_completo_tipo_unidad_medida'];
$nombre_tipo_unidad_medida_abrev         = $matriz_consulta['nombre_tipo_unidad_medida_abrev'];
$valor_equivalencia                      = $matriz_consulta['valor_equivalencia'];
$nombre_equivalencia                     = $matriz_consulta['nombre_equivalencia'];
$nombre_tipo_precio_venta                = $matriz_consulta['nombre_tipo_precio_venta'];
$cod_estado                              = $matriz_consulta['cod_estado'];
$cod_estado_tipo_precio_venta            = $matriz_consulta['cod_estado_tipo_precio_venta'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_asignacion_tipo_unidad_medida_segun_tipo_precio_venta_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">COD</th>
			<th style="text-align:center">PRESENTACION</th>
			<th style="text-align:center">TIPO DE PRECIO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
            <td style="text-align:center"><?php echo ($cod_tipo_unidad_medida) ?></td>
            <td style="text-align:center"><?php echo ($nombre_tipo_unidad_medida) ?></td>
            <td style="text-align:center">        
                <select name="nombre_tipo_precio_venta" id="nombre_tipo_precio_venta" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                    <?php if (isset($nombre_tipo_precio_venta)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                    $consulta2_sql = "SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta WHERE (cod_estado_tipo_precio_venta = '1') ORDER BY nombre_tipo_precio_venta ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_precio_venta) AND $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_precio_venta'];
                    $nombre = $datos2['nombre_tipo_precio_venta'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_tipo_unidad_medida" value="<?php echo $cod_tipo_unidad_medida ?>"/>
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