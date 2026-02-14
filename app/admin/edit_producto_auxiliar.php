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
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Producto Auxiliar</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_producto_auxiliar             = intval($_GET['cod_producto_auxiliar']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto_auxiliar WHERE cod_producto_auxiliar = '$cod_producto_auxiliar'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra                 = $matriz_consulta['cod_producto_barra'];
$nombre_producto                    = $matriz_consulta['nombre_producto'];
$precio_compra_producto             = $matriz_consulta['precio_compra_producto'];
$precio_venta_producto              = $matriz_consulta['precio_venta_producto'];
$iva_ptj                            = $matriz_consulta['iva_ptj'];
$nombre_tipo_unidad_medida          = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_producto               = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_precio_venta           = $matriz_consulta['nombre_tipo_precio_venta'];
$cod_dependencia                    = $matriz_consulta['cod_dependencia'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_producto_auxiliar_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
            <th style="text-align:center">COD BARRA</th>
            <th style="text-align:center">NOMBRE PRODUCTO</th>
            <th style="text-align:center">PRECIO COMPRA</th>
            <th style="text-align:center">PRECIO VENTA</th>
            <th style="text-align:center">IVA</th>
            <th style="text-align:center">TIPO PRECIO</th>
            <th style="text-align:center">UNIDAD MEDIDA</th>
            <th style="text-align:center">TIPO PRODUCTO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
            <td style="text-align:center"><input class="input-block-level" name="cod_producto_barra" id="cod_producto_barra" type="text" value="<?php echo $cod_producto_barra; ?>" size="30" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="nombre_producto" type="text" value="<?php echo $nombre_producto; ?>" size="50" required/></td>
            <td style="text-align:center"><input class="input-block-level" name="precio_compra_producto" type="number" value="<?php echo $precio_compra_producto; ?>" size="30" step="any" min=0 required/></td>
            <td style="text-align:center"><input class="input-block-level" name="precio_venta_producto" type="number" value="<?php echo $precio_venta_producto; ?>" size="30" step="any" min=0 required/></td>
            <td style="text-align:center">
                <select name="iva_ptj" id="select_iva_ptj" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;">
                <?php if (isset($iva_ptj)) { echo ""; } else { echo ""; }
                $sql_consulta2 = "SELECT iva, descripcion_tipo_iva FROM tbl15_tipo_iva WHERE (cod_estado = '1') ORDER BY iva ASC";
                $consulta2 = mysqli_query($conectar, $sql_consulta2);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($iva_ptj) and $iva_ptj == $datos2['iva']) {
                $seleccionado = "selected";
                } else { $seleccionado = ""; }
                $codigo = $datos2['iva'];
                $nombre = $datos2['iva'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
                </select>
            </td>

            <td style="text-align:center">
                <select name="nombre_tipo_precio_venta" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                    <?php if (isset($nombre_tipo_precio_venta)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta ORDER BY cod_tipo_precio_venta ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_precio_venta) and $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_precio_venta'];
                    $nombre = $datos2['nombre_tipo_precio_venta'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            
            <td style="text-align:center">
                <select name="nombre_tipo_unidad_medida" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                    <?php if (isset($nombre_tipo_unidad_medida)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tipo_unidad_medida, nombre_tipo_unidad_medida FROM tbl15_tipo_unidad_medida WHERE (cod_estado = '1') ORDER BY cod_tipo_unidad_medida ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_unidad_medida) and $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_unidad_medida'];
                    $nombre = $datos2['nombre_tipo_unidad_medida'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:center">
                <select name="nombre_tipo_producto" id="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                    <?php if (isset($nombre_tipo_producto)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY nombre_tipo_producto DESC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_producto_predef) and $nombre_tipo_producto_predef == $datos2['nombre_tipo_producto']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_producto'];
                    $nombre = $datos2['nombre_tipo_producto'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_producto_auxiliar" value="<?php echo $cod_producto_auxiliar ?>"/>
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