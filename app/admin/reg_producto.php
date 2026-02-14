<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>-->
<a class="btn btn-success" href="#">Registrar Producto</a>
<?php if ($cod_estado_prod_inventario_producto == '1') { ?><a class="btn btn-primary" href="../admin/lista_producto.php">Lista de Productos</a><?php } ?>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$pagina = $_SERVER['PHP_SELF']; 
//select cod_producto_barra,substring(cod_producto_barra, 1, 2) as bcd, CONVERT(SUBSTRING(cod_producto_barra, 3, 9),UNSIGNED INTEGER) AS num from tbl15_producto order by cod_producto_barra
//$mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra ), 10,0) DESC LIMIT 0,1";
$mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra), 20,0) DESC LIMIT 0,1";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra                = $matriz_consulta['cod_producto_barra'] + 1;
$nombre_tipo_producto              = 'PRODUCTO';
$cod_opcion_descontable_inv        = 0;
$iva_ptj                           = 0;
$iva_saludable_ptj                 = 0;
?>

<?php if ($cod_estado_prod_reg_producto == '1') { ?>
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_producto_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center" id="mensaje_verificacion_producto">.</th>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CODIGO PRODUCTO</th>

			<?php if ($cod_estado_cod_barra2_global == '1') { ?><th style="text-align:center">CODIGO PRODUCTO 2</th><?php } ?>

			<th style="text-align:center">NOMBRE PRODUCTO</th>
			<th style="text-align:center">UND PRODUCTO</th>
			<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
			<th style="text-align:center">UND PRODUCTO BODEGA</th>
			<?php } ?>
			<th style="text-align:center">UNIDAD MEDIDA</th>
			<th style="text-align:center">TIPO PRODUCTO</th>

			<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
			<th style="text-align:center">DESCONTABLE</th>
			<?php } ?>
		</tr>
    	<tr>
			<td style="text-align:center"><input class="input-block-level" name="cod_producto_barra" id="cod_producto_barra" type="text" value="<?php echo $cod_producto_barra ?>" size="30" required /></td>

			<?php if ($cod_estado_cod_barra2_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="cod_producto_barra2" id="cod_producto_barra2" type="text" value="" size="30" /></td><?php } ?>

			<td style="text-align:center">
			<?php if ($nombre_tipo_componente == 'TEXTAREA') { ?>
			<textarea class="input-block-level" name="nombre_producto" rows="9" cols="50" required></textarea>
			<?php } else { ?><input class="input-block-level" name="nombre_producto" type="text" value="" size="120" required /><?php } ?>
			</td>

			<td style="text-align:center"><input class="input-block-level" name="und_producto" type="text" value="" size="10" /></td>
			<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
			<td style="text-align:center"><input class="input-block-level" name="und_producto_bodega" type="text" value="" size="10" /></td>
			<?php } ?>

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
				<select name="nombre_tipo_producto" id="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
					<?php if (isset($nombre_tipo_producto_predef)) { echo ""; } else { echo ""; }
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

			<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_opcion_descontable_inv" id="cod_opcion_descontable_inv" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;" required>
					<?php if (isset($cod_opcion_descontable_inv)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_opcion_descontable_inv, nombre_opcion_descontable_inv FROM tbl15_opcion_descontable_inv ORDER BY cod_opcion_descontable_inv ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_opcion_descontable_inv) and $cod_opcion_descontable_inv == $datos2['cod_opcion_descontable_inv']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_opcion_descontable_inv'];
					$nombre = $datos2['nombre_opcion_descontable_inv'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<?php if ($cod_estado_tienda_global == '1') { ?>
			<th style="text-align:center">TIENDA</th>
			<?php } ?>

			<?php if ($cod_estado_peso_producto_global == '1') { ?>
			<th style="text-align:center">PESO (KG)</th>
			<?php } ?>
			
			<?php if ($cod_estado_marca_global == '1') { ?>
			<th style="text-align:center">MARCA</th>
			<?php } ?>

			<?php if ($cod_estado_proveedor_global == '1') { ?>
			<th style="text-align:center">PROVEEDOR</th>
			<?php } ?>

			<th style="text-align:center">TIPO PRECIO</th>

			<?php if ($cod_estado_producto_serial_global == '1') { ?>
			<th style="text-align:center">CODIGO SERIAL</th>
			<?php } ?>

			<?php if ($cod_estado_lote_compra_global  == '1') { ?>
			<th style="text-align:center">LOTE COMPRA</th>
			<?php } ?>
			
			<th style="text-align:center">PRECIO COMPRA</th>

			<?php if ($cod_estado_ganancia_ptj_global  == '1') { ?>
			<th style="text-align:center">%GANANCIA</th>
			<?php } ?>

			<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
			<th style="text-align:center">PRECIO VENTA<?php echo $contador; ?></th>
			<?php } ?>
		</tr>
    	<tr>
			<?php if ($cod_estado_tienda_global == '1') { ?>
			<th style="text-align:center">
				<select name="cod_tienda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;">
					<?php if (isset($cod_tienda)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE (cod_estado = '1') ORDER BY cod_tienda ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tienda) and $cod_tienda == $datos2['cod_tienda']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tienda'];
					$nombre = $datos2['nombre_tienda'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</th>
			<?php } ?>

			<?php if ($cod_estado_peso_producto_global == '1') { ?>
			<td style="text-align:center"><input class="input-block-level" name="peso_producto" id="peso_producto" type="number" value="" size="20" step="any"/></td>
			<?php } ?>

			<?php if ($cod_estado_marca_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_marca" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;">
					<?php if (isset($cod_marca)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_marca, nombre_marca FROM tbl15_marca WHERE (cod_estado = '1') ORDER BY cod_marca ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_marca) and $cod_marca == $datos2['cod_marca']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_marca'];
					$nombre = $datos2['nombre_marca'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>

			<?php if ($cod_estado_proveedor_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;">
					<?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tercero, nombre1_tercero FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'PROVEEDOR') ORDER BY cod_tercero ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tercero'];
					$nombre = $datos2['nombre1_tercero'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>

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

			<?php if ($cod_estado_producto_serial_global == '1') { ?>
			<td style="text-align:center"><input class="input-block-level" name="cod_producto_serial" type="text" value="" size="15" /></td>
			<?php } ?>

			<?php if ($cod_estado_lote_compra_global == '1') { ?>
			<td style="text-align:center"><input class="input-block-level" name="lote_compra" type="text" value="" size="15" /></td>
			<?php } ?>

			<td style="text-align:center"><input class="input-block-level" name="precio_compra_producto" id="precio_compra_producto" type="number" value="" size="50" step="any" min=0 required/></td>
			
			<?php if ($cod_estado_ganancia_ptj_global  == '1') { ?>
			<td style="text-align:center;"><input name="ganancia_ptj" type="number" id="ganancia_ptj" class="" value="" style="width: 50px;" /></td>
			<?php } ?>

			<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1;  
			if ($i==1) { $contador = ""; } elseif ($i==2) { $contador = $i; } elseif ($i==3) { $contador = $i; } elseif ($i==4) { $contador = $i; } elseif ($i==5) { $contador = $i; } else { $contador = ""; } ?>
			<td style="text-align:center"><input class="input-block-level" name="precio_venta_producto<?php echo $contador; ?>" id="precio_venta_producto<?php echo $contador; ?>" type="number" value="" size="50" /></td>
			<?php } ?>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<?php if ($cod_estado_cajas_sobre_global == '1') { ?><th style="text-align:center">UND CAJA</th><?php } ?>
			<?php if ($cod_estado_und_sobre_global == '1') { ?><th style="text-align:center">UND SOBRE</th><?php } ?>

			<th style="text-align:center">STOCK</th>
			<th style="text-align:center">IVA</th>

			<?php if ($cod_estado_iva_saludable_ptj_global == '1') { ?>
			<th style="text-align:center">IVA SALUDABLE</th>
			<?php } ?>

			<?php if ($cod_estado_categoria_global == '1') { ?>
			<th style="text-align:center">CATEGORIA</th>
			<!--<th style="text-align:center">SUBCATEGORIA</th>-->
			<?php } ?>

			<?php if ($cod_estado_origen_produccion_global == '1') { ?>
			<th style="text-align:center">ORIGEN PRODUCCION</th>
			<?php } ?>

			<?php if ($cod_estado_producto_de_cocina_global == '1') { ?>
			<th style="text-align:center">IMPRIMIR EN COCINA</th>
			<?php } ?>

			<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
			<th style="text-align:center">FECHA VENCIMIENTO</th>
			<th style="text-align:center">LOTE</th>
			<?php } ?>

			<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
			<th style="text-align:center">FECHA MANTENIMIENTO</th>
			<th style="text-align:center">MANTENIMIENTO MESES</th>
			<?php } ?>

			<?php if ($cod_estado_meses_garantia_global == '1') { ?><th style="text-align:center">GARANTIA MESES</th><?php } ?>

			<?php if ($cod_estado_factura_compra_producto_global == '1') { ?><th style="text-align:center">FACTURA</th><?php } ?>

			<?php if ($cod_estado_promocion_global == '1') { ?><th style="text-align:center">LABEL PROMOCION</th><?php } ?>
			
			<th style="text-align:center">ESTADO</th>

		</tr>
    	<tr>
			<?php if ($cod_estado_cajas_sobre_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="cajas_sobre" type="number" lang="en" step="any" value="" size="5" /></td><?php } ?>
			<?php if ($cod_estado_und_sobre_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="und_sobre" type="number" value="" size="5" /></td><?php } ?>

			<td style="text-align:center"><input class="input-block-level" name="tope_min" type="number" value="" size="5" /></td>

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


            <?php if ($cod_estado_iva_saludable_ptj_global == '1') { ?>
            <td style="text-align:center">
                <select name="iva_saludable_ptj" id="select_iva_saludable_ptj" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;">
                <?php if (isset($iva_saludable_ptj)) { echo ""; } else { echo ""; }
                $sql_consulta2 = "SELECT iva, descripcion_tipo_iva FROM tbl15_tipo_iva WHERE (cod_estado_iva_saludable = '1') ORDER BY iva ASC";
                $consulta2 = mysqli_query($conectar, $sql_consulta2);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($iva_saludable_ptj) and $iva_saludable_ptj == $datos2['iva']) {
                $seleccionado = "selected";
                } else { $seleccionado = ""; }
                $codigo = $datos2['iva'];
                $nombre = $datos2['iva'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
                </select>
            </td>
			<?php } ?>

			<?php if ($cod_estado_categoria_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_categoria" id="select_nombre_categoria" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 300px;" required>
					<?php if (isset($cod_categoria)) { echo "<option value='' >Selecione</option>"; } else { echo  "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_categoria, nombre_categoria FROM tbl15_categoria ORDER BY cod_categoria ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_categoria'];
					$nombre = $datos2['nombre_categoria'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>

<!--
			<td style="text-align:center">
				<select name="nombre_categoria_sub" id="select_nombre_categoria_sub" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 300px;">
					<?php if (isset($nombre_categoria_sub)) { echo "<option value='' >Selecione</option>"; } else { echo  "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_categoria_sub, nombre_categoria_sub FROM tbl15_categoria_sub ORDER BY cod_categoria_sub ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_categoria_sub) and $nombre_categoria_sub == $datos2['nombre_categoria_sub']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_categoria_sub'];
					$nombre = $datos2['nombre_categoria_sub'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
-->
			<?php if ($cod_estado_origen_produccion_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_origen_produccion" id="select_cod_origen_produccion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
					<?php if (isset($cod_origen_produccion)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_origen_produccion, nombre_origen_produccion FROM tbl15_origen_produccion WHERE (cod_estado = '1') ORDER BY cod_origen_produccion ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_origen_produccion) and $cod_origen_produccion == $datos2['cod_origen_produccion']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_origen_produccion'];
					$nombre = $datos2['nombre_origen_produccion'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>

			<?php if ($cod_estado_producto_de_cocina_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_tipo_producto_cocina" id="select_nombre_categoria" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 60px;" required>
					<?php if (isset($cod_tipo_producto_cocina)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tipo_producto_cocina, nombre_tipo_producto_cocina FROM tbl15_tipo_producto_cocina ORDER BY cod_tipo_producto_cocina ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tipo_producto_cocina) and $cod_tipo_producto_cocina == $datos2['cod_tipo_producto_cocina']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tipo_producto_cocina'];
					$nombre = $datos2['nombre_tipo_producto_cocina'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>

			<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
			<td style="text-align:center"><input class="input-block-level" name="fecha_vencimiento1" type="date" value="" size="10" /></td>
			<td style="text-align:center"><input class="input-block-level" name="vencimiento_lote1" type="text" value="" size="10" /></td>
			<?php } ?>

			<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
			<td style="text-align:center"><input class="input-block-level" name="fecha_mantenimiento" type="date" value="" size="10" /></td>
			<td style="text-align:center"><input class="input-block-level" name="meses_mantenimiento" type="number" value="" size="10" /></td>
			<?php } ?>

			<?php if ($cod_estado_meses_garantia_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="meses_garantia" type="number" value="" size="10" /></td><?php } ?>

            <?php if ($cod_estado_factura_compra_producto_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="cod_factura" type="text" value="" size="10" /></td><?php } ?>

			<?php if ($cod_estado_promocion_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_promocion" id="select_cod_promocion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" >
					<?php if (isset($cod_promocion)) { echo "<option value='' selected >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_promocion, nombre_promocion FROM tbl15_promocion WHERE (cod_estado = '1') ORDER BY cod_promocion ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_promocion) and $cod_promocion == $datos2['cod_promocion']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_promocion'];
					$nombre = $datos2['nombre_promocion'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>

			<td style="text-align:center">
				<select name="codigo_estado" id="select_codigo_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" >
					<?php if (isset($codigo_estado)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT codigo_estado, nombre_estado FROM tbl15_estado");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($codigo_estado) and $codigo_estado == $datos2['codigo_estado']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['codigo_estado'];
					$nombre = $datos2['nombre_estado'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<?php if ($cod_estado_tipo_habitacion_hotel_global == '1') { ?><th style="text-align:center">TIPO HABITACION</th><?php } ?>
			<?php if ($cod_estado_habitacion_hotel_global == '1') { ?><th style="text-align:center">ESTADO HABITACION</th><?php } ?>
		</tr>
    	<tr>
			<?php if ($cod_estado_tipo_habitacion_hotel_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_tipo_habitacion_hotel" id="select_nombre_categoria" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 300px;" required>
					<?php if (isset($cod_tipo_habitacion_hotel)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tipo_habitacion_hotel, nombre_tipo_habitacion_hotel FROM tbl15_tipo_habitacion_hotel ORDER BY cod_tipo_habitacion_hotel ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tipo_habitacion_hotel) and $cod_tipo_habitacion_hotel == $datos2['cod_tipo_habitacion_hotel']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tipo_habitacion_hotel'];
					$nombre = $datos2['nombre_tipo_habitacion_hotel'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>
			<?php if ($cod_estado_habitacion_hotel_global == '1') { ?>
			<td style="text-align:center">
				<select name="cod_estado_habitacion_hotel" id="select_nombre_categoria" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 300px;" required>
					<?php if (isset($cod_estado_habitacion_hotel)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_estado_habitacion_hotel, nombre_estado_habitacion_hotel FROM tbl15_estado_habitacion_hotel ORDER BY cod_estado_habitacion_hotel ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_estado_habitacion_hotel) and $cod_estado_habitacion_hotel == $datos2['cod_estado_habitacion_hotel']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_estado_habitacion_hotel'];
					$nombre = $datos2['nombre_estado_habitacion_hotel'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<?php } ?>
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_subproducto_global == '1') { ?>
<!--
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CARGAR SUBPRODUCTOS <button type="button" onclick="agregarFila()"><img src="../imagenes/mas.png"/></button> - <button type="button" onclick="eliminarFila()"><img src="../imagenes/eliminar.png"/></button></th>
		</tr>
	</thead>
</table>


<table border="1" class="table table-responsive" id="tabla_subproductos">
  <thead class="thead-dark">
    <tr>
      <th style="text-align:center">COD PRODUCTO</th>
      <th style="text-align:center">PRODUCTO</th>
      <th style="text-align:center">UND</th>
      <th style="text-align:center">MD</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
-->
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<?php if ($cod_estado_ptj_comision_global == '1') { ?>
			<th style="text-align:center">PTJ COMISION</th>
			<?php } ?>
			<th style="text-align:center">DEPENDENCIA</th>

			<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
			<th style="text-align:center">SUB DEPENDENCIA - SEDE</th>
			<?php } ?>

			<th style="text-align:center">DESCRIPCION</th>

			<?php if ($cod_estado_img_producto_global == '1') { ?>
			<th style="text-align:center">IMAGEN</th>
			<?php } ?>

			<?php if ($cod_estado_archivo_adjunto_global == '1') { ?>
			<th style="text-align:center">ADJUNTAR ARCHIVO</th>
			<?php } ?>
		</tr>
		<tr>
			<?php if ($cod_estado_ptj_comision_global == '1') { ?>
			<th style="text-align:center"><input class="input-block-level" name="comision_ptj" type="number" value="" size="5"/></th>
			<?php } ?>

			<th style="text-align:center">
			<select name="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
			<?php if (isset($cod_dependencia)) { echo ""; } else { echo ""; }
			$consulta2_sql = ("SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY cod_dependencia ASC");
			$consulta2 = mysqli_query($conectar, $consulta2_sql);
			while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			if(isset($cod_dependencia) and $cod_dependencia == $datos2['cod_dependencia']) {
			$seleccionado = "selected"; } else { $seleccionado = ""; }
			$codigo = $datos2['cod_dependencia'];
			$nombre = $datos2['nombre_dependencia'];
			echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
			</th>

			<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
			<th style="text-align:center">
			<select name="cod_dependencia_sub" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
			<?php if (isset($cod_dependencia_sub)) { echo ""; } else { echo ""; }
			$consulta2_sql = ("SELECT cod_dependencia_sub, nombre_dependencia_sub FROM tbl15_dependencia_sub ORDER BY cod_dependencia_sub ASC");
			$consulta2 = mysqli_query($conectar, $consulta2_sql);
			while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			if(isset($cod_dependencia_sub) and $cod_dependencia_sub == $datos2['cod_dependencia_sub']) {
			$seleccionado = "selected"; } else { $seleccionado = ""; }
			$codigo = $datos2['cod_dependencia_sub'];
			$nombre = $datos2['nombre_dependencia_sub'];
			echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
			</th>
			<?php } ?>

			
			<th style="text-align:center"><textarea class="input-block-level" name="descripcion_producto" rows="2" cols="20"></textarea></th>
			<?php if ($cod_estado_img_producto_global == '1') { ?>
			<th style="text-align:center">
			<input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a>
			<div id="vista_archivo">
			</th>
			<?php } ?>

			<?php if ($cod_estado_archivo_adjunto_global == '1') { ?>
    		<td style="text-align:center;"><input type="file" name="archivo_adjunto" id="archivo_adjunto"></td>
			<?php } ?>			
		</tr>
	</thead>
</table>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="ganadero">
<?php if ($cod_estado_animal_global == '1') { ?>
<fieldset><legend>DATOS GENERALES</legend>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">SEXO</th>
			<th style="text-align:center">ESTATUS</th>
			<th style="text-align:center">FECHA NACIMIENTO</th>
			<th style="text-align:center">CONDICION CORPORAL</th>
			<th style="text-align:center">CATEGORIA INGRESO</th>
		</tr>
    	<tr>
			<td style="text-align:center">
				<select name="nombre_sexo" id="nombre_sexo" class="nombre_sexo">
                    <?php if (isset($nombre_sexo)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_sexo, nombre_sexo FROM tbl15_sexo");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_sexo) and $nombre_sexo == $datos2['nombre_sexo']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_sexo'];
                    $nombre = $datos2['nombre_sexo'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
                <spam id="de_monta_oculto">&nbsp;&nbsp;&nbsp;<input name="de_monta" id="de_monta" class="de_monta" type="checkbox" value="SI" /><strong>DE MONTA</strong></spam>
			</td>
			<td style="text-align:center">
                 <select name="nombre_estatus" id="nombre_estatus" class="nombre_estatus">
                    <?php if (isset($nombre_estatus)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_estatus, nombre_estatus FROM tbl15_estatus");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_estatus) and $nombre_estatus == $datos2['nombre_estatus']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_estatus'];
                    $nombre = $datos2['nombre_estatus'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="fecha_nac" id="fecha_nac" class="fecha_nac" maxlength="11" type="date" value=""></td>
			<td style="text-align:center">
            	<select name="nombre_condicion_corporal" id="nombre_condicion_corporal" class="nombre_condicion_corporal">
                    <?php if (isset($nombre_condicion_corporal)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_condicion_corporal, nombre_condicion_corporal FROM tbl15_condicion_corporal");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_condicion_corporal) AND $nombre_condicion_corporal == $datos2['nombre_condicion_corporal']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_condicion_corporal'];
                    $nombre = $datos2['nombre_condicion_corporal'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_categoria_ingreso" id="nombre_categoria_ingreso" class="nombre_categoria_ingreso">
                    <?php if (isset($nombre_categoria_ingreso)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_categoria, nombre_categoria FROM tbl15_categoria");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_categoria_ingreso) AND $nombre_categoria_ingreso == $datos2['nombre_categoria']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_categoria'];
                    $nombre = $datos2['nombre_categoria'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PROCEDENCIA</th>
			<th style="text-align:center">PROGRAMA REPRODUCTIVO</th>
			<th style="text-align:center">TIPO EXPLOTACION</th>
			<th style="text-align:center">TIPO MONTA</th>
			<th style="text-align:center">LOTE</th>
		</tr>
    	<tr>
			<td style="text-align:center">
                <select name="nombre_procedencia" id="nombre_procedencia" class="nombre_procedencia" >
                    <?php if (isset($nombre_procedencia)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_procedencia, nombre_procedencia FROM tbl15_procedencia");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_procedencia) AND $nombre_procedencia == $datos2['nombre_procedencia']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_procedencia'];
                    $nombre = $datos2['nombre_procedencia'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_prog_reproductivo" id="nombre_prog_reproductivo" class="nombre_prog_reproductivo" >
                    <?php if (isset($nombre_prog_reproductivo)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_prog_reproductivo, nombre_prog_reproductivo FROM tbl15_prog_reproductivo");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_prog_reproductivo) AND $nombre_prog_reproductivo == $datos2['nombre_prog_reproductivo']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_prog_reproductivo'];
                    $nombre = $datos2['nombre_prog_reproductivo'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_tipo_explotacion" id="nombre_tipo_explotacion" class="nombre_tipo_explotacion">
                    <?php if (isset($nombre_tipo_explotacion)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_tipo_explotacion, nombre_tipo_explotacion FROM tbl15_tipo_explotacion");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_explotacion) AND $nombre_tipo_explotacion == $datos2['nombre_tipo_explotacion']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_explotacion'];
                    $nombre = $datos2['nombre_tipo_explotacion'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_tipo_monta" id="nombre_tipo_monta" class="nombre_tipo_monta">
                    <?php if (isset($nombre_tipo_monta)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_tipo_monta, nombre_tipo_monta FROM tbl15_tipo_monta");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_monta) AND $nombre_tipo_monta == $datos2['nombre_tipo_monta']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_monta'];
                    $nombre = $datos2['nombre_tipo_monta'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_lote_categoria" id="nombre_lote_categoria" class="nombre_lote_categoria">
                    <?php if (isset($nombre_lote_categoria)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_lote_categoria, nombre_lote_categoria FROM tbl15_lote_categoria");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_lote_categoria) AND $nombre_lote_categoria == $datos2['nombre_lote_categoria']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_lote_categoria'];
                    $nombre = $datos2['nombre_lote_categoria'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">POTRERO</th>
			<th style="text-align:center">CALIDAD ANIMAL</th>
			<th style="text-align:center">PARTOS MADRE</th>
			<th style="text-align:center">PESO COMPRA</th>
			<th style="text-align:center">FECHA COMPRA</th>
		</tr>
    	<tr>
			<td style="text-align:center">
                <select name="nombre_potrero" id="nombre_potrero" class="nombre_potrero">
                    <?php if (isset($nombre_potrero)) { echo "<option value='' selected >Seleccione</option>"; } else { echo  "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_potrero, nombre_potrero FROM tbl15_potrero");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_potrero) AND $nombre_potrero == $datos2['nombre_potrero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_potrero'];
                    $nombre = $datos2['nombre_potrero'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_calidad_animal" id="nombre_calidad_animal" class="nombre_calidad_animal">
                    <?php if (isset($nombre_calidad_animal)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_calidad_animal, nombre_calidad_animal FROM tbl15_calidad_animal");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_calidad_animal) AND $nombre_calidad_animal == $datos2['nombre_calidad_animal']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_calidad_animal'];
                    $nombre = $datos2['nombre_calidad_animal'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="numero_partos" id="numero_partos" class="numero_partos" maxlength="1" type="number" value=""></td>
			<td style="text-align:center"><input name="peso_compra" id="peso_compra" class="peso_compra" maxlength="4" type="number" value=""></td>
			<td style="text-align:center"><input name="fecha_compra" id="fecha_compra" class="fecha_compra" maxlength="11" type="date" value=""></td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CATEGORIA ANIMAL</th>
			<th style="text-align:center">TIPO CONCEPCION</th>
			<th style="text-align:center">ESPECIE</th>
			<th style="text-align:center">HIERRO</th>
			<th style="text-align:center">ID ELECTRONICA</th>
		</tr>
    	<tr>
			<td style="text-align:center">
                <select name="nombre_categoria_animal_extern" id="nombre_categoria_animal_extern" class="nombre_categoria_animal_extern" >
                    <?php if (isset($nombre_categoria_animal_extern)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = "SELECT cod_categoria_animal_extern, nombre_categoria_animal_extern FROM tbl15_categoria_animal_extern";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_categoria_animal_extern) AND $nombre_categoria_animal_extern == $datos2['nombre_categoria_animal_extern']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_categoria_animal_extern'];
                    $nombre = $datos2['nombre_categoria_animal_extern'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_tipo_concepcion" id="nombre_tipo_concepcion" class="nombre_tipo_concepcion">
                    <?php if (isset($nombre_tipo_concepcion)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_tipo_concepcion, nombre_tipo_concepcion FROM tbl15_tipo_concepcion");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_concepcion) AND $nombre_tipo_concepcion == $datos2['nombre_tipo_concepcion']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_concepcion'];
                    $nombre = $datos2['nombre_tipo_concepcion'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center">
                <select name="nombre_especie" id="nombre_especie" class="nombre_especie" >
                    <?php if (isset($nombre_especie)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_especie, nombre_especie FROM tbl15_especie WHERE (cod_estado = '1')");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_especie) AND $nombre_especie == $datos2['nombre_especie']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_especie'];
                    $nombre = $datos2['nombre_especie'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="hierro_animal" id="hierro_animal" class="hierro_animal" maxlength="11" type="text" value=""></td>
			<td style="text-align:center"><input name="id_electronica" id="id_electronica" class="id_electronica" maxlength="11" type="text" value=""></td>
    	</tr>
	</thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset><legend>GENEALOGIA</legend>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">RAZA 1</th>
			<th style="text-align:center">%</th>
			<th style="text-align:center">RAZA 2</th>
			<th style="text-align:center">%</th>
			<th style="text-align:center">RAZA 3</th>
			<th style="text-align:center">%</th>
			<th style="text-align:center">RAZA 4</th>
			<th style="text-align:center">%</th>
		</tr>
    	<tr>
			<td style="text-align:center">
                <select name="nombre_raza1" id="nombre_raza1" class="nombre_raza1" >
                    <?php if (isset($nombre_raza1)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_raza1) and $nombre_raza1 == $datos2['nombre_raza']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_raza'];
                    $nombre = $datos2['nombre_raza'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="ptj_raza1" id="ptj_raza1" class="input-block-level" maxlength="11" type="text" value=""></td>
			<td style="text-align:center">
                <select name="nombre_raza2" id="nombre_raza2" class="nombre_raza2">
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_raza1) and $nombre_raza1 == $datos2['nombre_raza']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_raza'];
                    $nombre = $datos2['nombre_raza'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="ptj_raza2" id="ptj_raza2" class="input-block-level" maxlength="2" type="text" value=""></td>
			<td style="text-align:center">
                <select name="nombre_raza3" id="nombre_raza3" class="nombre_raza3">
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_raza1) and $nombre_raza1 == $datos2['nombre_raza']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_raza'];
                    $nombre = $datos2['nombre_raza'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="ptj_raza3" id="ptj_raza3" class="input-block-level" maxlength="2" type="text" value=""></td>
			<td style="text-align:center">
                <select name="nombre_raza4" id="nombre_raza4" class="nombre_raza4">
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                    $consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_raza1) and $nombre_raza1 == $datos2['nombre_raza']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_raza'];
                    $nombre = $datos2['nombre_raza'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>
			<td style="text-align:center"><input name="ptj_raza4" id="ptj_raza4" class="input-block-level" maxlength="2" type="text" value=""></td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">ID PADRE</th>
			<th style="text-align:center">ID MADRE</th>
			<th style="text-align:center">ID ABUELO PATERNO</th>
			<th style="text-align:center">ID ABUELO MATERNO</th>
			<th style="text-align:center">ID ABUELA PATERNA</th>
			<th style="text-align:center">ID ABUELA MATERNA</th>
		</tr>
    	<tr>
			<td style="text-align:center"><input name="id_padre" id="id_padre" class="input-block-level" maxlength="10" type="text" value=""></td>
			<td style="text-align:center"><input name="id_madre" id="id_madre" class="input-block-level" maxlength="10" type="text" value=""></td>
			<td style="text-align:center"><input name="id_abuelo_paterno" id="id_abuelo_paterno" class="input-block-level" maxlength="10" type="text" value=""></td>
			<td style="text-align:center"><input name="id_abuelo_materno" id="id_abuelo_materno" class="input-block-level" maxlength="10" type="text" value=""></td>
			<td style="text-align:center"><input name="id_abuela_paterno" id="id_abuela_paterno" class="input-block-level" maxlength="10" type="text" value=""></td>
			<td style="text-align:center"><input name="id_abuela_materno" id="id_abuela_materno" class="input-block-level" maxlength="10" type="text" value=""></td>
    	</tr>
	</thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset><legend>FENOTIPO</legend>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">ESTADO</th>
			<th style="text-align:center">COLOR</th>
			<th style="text-align:center">TEMPERAMENTO</th>
			<th style="text-align:center">PESO AL NACER</th>
		</tr>
    	<tr>
			<td style="text-align:left">
				<div><input name="marcas_tatuado" id="marcas_tatuado" class="marcas_tatuado" type="checkbox" value="SI" /><strong>Tatuado</strong></div>
				<div><input name="marcas_herrado" id="marcas_herrado" class="marcas_herrado" type="checkbox" value="SI" /><strong>Herrado</strong></div>
				<div><input name="marcas_descornado" id="marcas_descornado" class="marcas_herrado" type="checkbox" value="SI" /><strong>Descornado</strong></div>
				<div><input name="marcas_castrado" id="marcas_castrado" class="marcas_herrado" type="checkbox" value="SI" /><strong>Castrado</strong><div>
				<div><strong>Fecha Castracion:</strong><input name="fecha_castracion" id="fecha_castracion" class="fecha_castracion" maxlength="11" type="date" value=""></div>
			</td>
			<td style="text-align:center"><input name="nombre_color" id="nombre_color" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="nombre_temperamento" id="nombre_temperamento" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="peso_nacer" id="peso_nacer" class="peso_nacer" maxlength="30" type="text" value=""></td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">APLOMOS CORVEJON</th>
			<th style="text-align:center">APLOMOS CUARTILLAS</th>
			<th style="text-align:center">APLOMOS CASCOS</th>
			<th style="text-align:center">CIRCUNFERENCIA ESCROTAL</th>
		</tr>
    	<tr>
			<td style="text-align:center"><input name="aplomo_corvejon" id="aplomo_corvejon" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="aplomo_cuartilla" id="aplomo_cuartilla" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="aplomo_cascos" id="aplomo_cascos" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="genital_circun_escrotal" id="genital_circun_escrotal" class="input-block-level" maxlength="30" type="text" value=""></td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PREPUCIO</th>
			<th style="text-align:center">POTENCIA</th>
			<th style="text-align:center">SEMEN</th>
			<th style="text-align:center">NOTAS</th>
		</tr>
    	<tr>
			<td style="text-align:center"><input name="genital_prepusio" id="genital_prepusio" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="genital_potencia" id="genital_potencia" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><input name="genital_semen" id="genital_semen" class="input-block-level" maxlength="30" type="text" value=""></td>
			<td style="text-align:center"><textarea rows="2" cols="50" class="span8" name="observacion_animal" id="observacion_animal" class="input-block-level"></textarea></td>
    	</tr>
	</thead>
</table>
</fieldset>
<?php } ?>
</div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
<?php } ?>
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
<script src="js/jquery-ui.js"></script>

<?php if ($cod_estado_ganancia_ptj_global  == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#ganancia_ptj").on('change', function () {
            //var precio_compra_producto = $("#precio_compra_producto").val();
            //var ganancia_ptj = $(this).val();
            var ganancia_ptj = 0;
            var precio_compra_producto = 0;
            ganancia_ptj = document.getElementById("ganancia_ptj").value;
            precio_compra_producto = document.getElementById("precio_compra_producto").value;

            if (precio_compra_producto == '') { precio_compra_producto = 0 };
            if (ganancia_ptj == '') { ganancia_ptj = 0 };

            var precio_venta_producto = parseInt(precio_compra_producto) + parseInt(precio_compra_producto * (ganancia_ptj/100));
            document.getElementById("precio_venta_producto").value = precio_venta_producto;

            console.log(precio_venta_producto);
   });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#precio_compra_producto").on('change', function () {
            //var ganancia_ptj = $("#ganancia_ptj").val();
            //var precio_compra_producto = $(this).val();
            var ganancia_ptj = 0;
            var precio_compra_producto = 0;
            ganancia_ptj = document.getElementById("ganancia_ptj").value;
            precio_compra_producto = document.getElementById("precio_compra_producto").value;
            
            if (precio_compra_producto == '') { precio_compra_producto = 0 };
            if (ganancia_ptj == '') { ganancia_ptj = 0 };

            var precio_venta_producto = parseInt(precio_compra_producto) + parseInt(precio_compra_producto * (ganancia_ptj/100));
            document.getElementById("precio_venta_producto").value = precio_venta_producto;

            console.log(precio_venta_producto);
   });
});
</script>
<?php } ?>
<!--
<script type="text/javascript">
function agregarFila(){

var tabla_subproductos = document.getElementById("tabla_subproductos");
var numero_reg = tabla_subproductos.rows.length;
console.log("numero_reg - "+numero_reg);

  document.getElementById("tabla_subproductos").insertRow(-1).innerHTML = ''
  +
  '<td style="text-align:center"><input type="text" name="cod_producto_barra_sub" id="cod_producto_barra_sub" class="cod_producto_barra_sub__'+numero_reg+'" value="" size="10"/></td>'
  +
  '<td style="text-align:center"><input type="text" name="nombre_producto_sub" id="nombre_producto_sub" class="nombre_producto_sub__'+numero_reg+'" value="" size="50"/></td>'
  +
  '<td style="text-align:center"><input type="text" name="und_producto_sub" id="und_producto_sub" class="und_producto_sub__'+numero_reg+'" value="" size="5"/></td>'
  +
  '<td style="text-align:center"><input type="text" name="nombre_tipo_unidad_medida_sub" id="nombre_tipo_unidad_medida_sub" class="nombre_tipo_unidad_medida_sub__'+numero_reg+'" value="" size="5"/></td>'
  ;
}
	
function eliminarFila(){
  var tabla_subproductos = document.getElementById("tabla_subproductos");
  var cantidad_subproductos = tabla_subproductos.rows.length;
  //console.log(cantidad_subproductos);
  
  if(cantidad_subproductos <= 1)
    alert('No se puede eliminar el encabezado');
  else
    tabla_subproductos.deleteRow(cantidad_subproductos -1);
}
</script>
-->
<script language="javascript">
$(document).ready(function(){

var nombre_tipo_producto = $("#nombre_tipo_producto").val();

if (nombre_tipo_producto=='ANIMAL') {
document.getElementById("ganadero").style.display = "block";
} else {
//document.getElementById("ganadero").style.display = "none";
}

$("#nombre_tipo_producto").on('change', function () {
var nombre_tipo_producto = $("#nombre_tipo_producto").val();

if (nombre_tipo_producto=='ANIMAL') {
document.getElementById("ganadero").style.display = "block";
} else {
//document.getElementById("ganadero").style.display = "none";
}
});

});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#cod_producto_barra").on('change', function () {
            var cod_producto_barra = $(this).val();
            var campo = "cod_producto_barra";
            var tipo_ajax = "tbl15_producto";
            $.post("verificar_existencia_producto_ajax.php", { cod_producto_barra:cod_producto_barra, campo:campo, tipo_ajax:tipo_ajax }, function(data){
                $("#mensaje_verificacion_producto").html(data);
        });
   });
});
</script>


<script>
$(document).ready(function() {
    $("#select_nombre_categoria").change(function(){
        var valor = $("#select_nombre_categoria").val();
        var campo = 'nombre_categoria';
        var tipo_ajax = 'nombre_categoria';
            
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/recargar_categoria_sub_select_dependiente_ajax.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#select_nombre_categoria_sub').html(resp);
            }
        });
    });
});
</script>

<script type="text/javascript">
$('#id_padre').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'MACHO';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>


<script type="text/javascript">
$('#id_madre').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<script type="text/javascript">
$('#id_abuelo_paterno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'MACHO';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<script type="text/javascript">
$('#id_abuelo_materno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'MACHO';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<script type="text/javascript">
$('#id_abuela_paterno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>


<script type="text/javascript">
$('#id_abuela_materno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<?php if ($cod_estado_img_producto_global == '1') { ?>
<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img1 = document.getElementById("url_img1"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img1) {
    url_img1.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>
<?php } ?>


<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
	descripcion_producto = CKEDITOR.replace("descripcion_producto");
	CKFinder.setupCKEditor(descripcion_producto, 'ckeditor/ckfinder');
}
</script>

</body>
</html>