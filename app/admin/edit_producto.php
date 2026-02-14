<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 

<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
    descripcion_producto = CKEDITOR.replace("descripcion_producto");
    CKFinder.setupCKEditor(descripcion_producto, 'ckeditor/ckfinder');
    console.log("sdsd");
}
</script>
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
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Producto</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                  = $_SERVER['PHP_SELF'];

$cod_producto                  = intval($_GET['cod_producto']);
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'nombre_producto'; }

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra           = $matriz_consulta['cod_producto_barra'];
$nombre_producto              = $matriz_consulta['nombre_producto'];
$und_producto                 = $matriz_consulta['und_producto'];
$precio_compra_producto       = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto        = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto        = $matriz_consulta['precio_venta_producto'];
$precio_venta_producto2       = $matriz_consulta['precio_venta_producto2'];
$precio_venta_producto3       = $matriz_consulta['precio_venta_producto3'];
$precio_venta_producto4       = $matriz_consulta['precio_venta_producto4'];
$precio_venta_producto5       = $matriz_consulta['precio_venta_producto5'];

$nombre_tipo_producto         = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida    = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion     = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_tipo_precio_venta     = $matriz_consulta['nombre_tipo_precio_venta'];
$tope_min                     = $matriz_consulta['tope_min'];
$iva_ptj                      = $matriz_consulta['iva_ptj'];
$fecha_vencimiento1           = $matriz_consulta['fecha_vencimiento1'];
$vencimiento_lote1            = $matriz_consulta['vencimiento_lote1'];
$fecha_mantenimiento          = $matriz_consulta['fecha_mantenimiento'];
$comision_ptj                 = $matriz_consulta['comision_ptj'];
$cod_dependencia              = $matriz_consulta['cod_dependencia'];
$cod_producto_serial          = $matriz_consulta['cod_producto_serial'];

$cod_rodeo                    = $matriz_consulta['cod_rodeo'];
$nombre_rodeo                 = $matriz_consulta['nombre_rodeo'];
$nombre_sexo                  = $matriz_consulta['nombre_sexo'];
$de_monta                     = $matriz_consulta['de_monta'];
$nombre_estatus               = $matriz_consulta['nombre_estatus'];
$nombre_condicion_corporal    = $matriz_consulta['nombre_condicion_corporal'];
$nombre_categoria_ingreso     = $matriz_consulta['nombre_categoria_ingreso'];
$nombre_categoria_actual      = $matriz_consulta['nombre_categoria_actual'];
$nombre_categoria_futura      = $matriz_consulta['nombre_categoria_futura'];
$nombre_procedencia           = $matriz_consulta['nombre_procedencia'];
$nombre_tipo_monta            = $matriz_consulta['nombre_tipo_monta'];
$nombre_lote_categoria        = $matriz_consulta['nombre_lote_categoria'];
$nombre_prog_reproductivo     = $matriz_consulta['nombre_prog_reproductivo'];
$nombre_potrero               = $matriz_consulta['nombre_potrero'];
$nombre_lote                  = $matriz_consulta['nombre_lote'];
$nombre_calidad_animal        = $matriz_consulta['nombre_calidad_animal'];
$nombre_tipo_explotacion      = $matriz_consulta['nombre_tipo_explotacion'];
$peso_compra                  = $matriz_consulta['peso_compra'];
$precio_compra                = $matriz_consulta['precio_compra'];
$nombre_propietario           = $matriz_consulta['nombre_propietario'];
$fecha_nac                    = $matriz_consulta['fecha_nac'];
$fecha_compra                 = $matriz_consulta['fecha_compra'];
$fecha_castracion             = $matriz_consulta['fecha_castracion'];
$nro_hierros                  = $matriz_consulta['nro_hierros'];
$hierro_animal                = $matriz_consulta['hierro_animal'];
$numero_partos                = $matriz_consulta['numero_partos'];
$id_electronica               = $matriz_consulta['id_electronica'];
$nombre_raza                  = $matriz_consulta['nombre_raza'];
$nombre_raza1                 = $matriz_consulta['nombre_raza1'];
$nombre_raza2                 = $matriz_consulta['nombre_raza2'];
$nombre_raza3                 = $matriz_consulta['nombre_raza3'];
$nombre_raza4                 = $matriz_consulta['nombre_raza4'];
$ptj_raza1                    = $matriz_consulta['ptj_raza1'];
$ptj_raza2                    = $matriz_consulta['ptj_raza2'];
$ptj_raza3                    = $matriz_consulta['ptj_raza3'];
$ptj_raza4                    = $matriz_consulta['ptj_raza4'];
$id_padre                     = $matriz_consulta['id_padre'];
$raza_padre                   = $matriz_consulta['raza_padre'];
$id_madre                     = $matriz_consulta['id_madre'];
$raza_madre                   = $matriz_consulta['raza_madre'];
$partos_madre                 = $matriz_consulta['partos_madre'];
$id_abuelo_paterno            = $matriz_consulta['id_abuelo_paterno'];
$id_abuelo_materno            = $matriz_consulta['id_abuelo_materno'];
$nombre_abuelo_paterno        = $matriz_consulta['nombre_abuelo_paterno'];
$nombre_abuelo_materno        = $matriz_consulta['nombre_abuelo_materno'];
$raza_abuelo_paterno          = $matriz_consulta['raza_abuelo_paterno'];
$raza_abuelo_materno          = $matriz_consulta['raza_abuelo_materno'];
$id_abuela_paterno            = $matriz_consulta['id_abuela_paterno'];
$id_abuela_materno            = $matriz_consulta['id_abuela_materno'];
$nombre_abuela_paterno        = $matriz_consulta['nombre_abuela_paterno'];
$nombre_abuela_materno        = $matriz_consulta['nombre_abuela_materno'];
$raza_abuela_paterno          = $matriz_consulta['raza_abuela_paterno'];
$raza_abuela_materno          = $matriz_consulta['raza_abuela_materno'];
$nombre_tipo_concepcion       = $matriz_consulta['nombre_tipo_concepcion'];
$nombre_especie               = $matriz_consulta['nombre_especie'];
$marcas_tatuado               = $matriz_consulta['marcas_tatuado'];
$marcas_herrado               = $matriz_consulta['marcas_herrado'];
$marcas_descornado            = $matriz_consulta['marcas_descornado'];
$marcas_castrado              = $matriz_consulta['marcas_castrado'];
$nombre_color                 = $matriz_consulta['nombre_color'];
$nombre_temperamento          = $matriz_consulta['nombre_temperamento'];
$peso_nacer                   = $matriz_consulta['peso_nacer'];
$aplomo_corvejon              = $matriz_consulta['aplomo_corvejon'];
$aplomo_cuartilla             = $matriz_consulta['aplomo_cuartilla'];
$aplomo_cascos                = $matriz_consulta['aplomo_cascos'];
$genital_circun_escrotal      = $matriz_consulta['genital_circun_escrotal'];
$genital_prepusio             = $matriz_consulta['genital_prepusio'];
$genital_potencia             = $matriz_consulta['genital_potencia'];
$genital_semen                = $matriz_consulta['genital_semen'];
$observacion_animal           = $matriz_consulta['observacion_animal'];
$nombre_estado                = $matriz_consulta['nombre_estado'];
$nombre_tipo_movimiento       = $matriz_consulta['nombre_tipo_movimiento'];
$nombre_categoria_animal_extern = $matriz_consulta['nombre_categoria_animal_extern'];
$descripcion_producto         = $matriz_consulta['descripcion_producto'];
$und_producto_bodega          = $matriz_consulta['und_producto_bodega'];

$cajas_sobre                  = $matriz_consulta['cajas_sobre'];
$und_sobre                    = $matriz_consulta['und_sobre'];

$meses_mantenimiento          = $matriz_consulta['meses_mantenimiento'];
$meses_garantia               = $matriz_consulta['meses_garantia'];
$cod_factura                  = $matriz_consulta['cod_factura'];
$cod_marca                    = $matriz_consulta['cod_marca'];
$cod_tercero                  = $matriz_consulta['cod_tercero'];
$lote_compra                  = $matriz_consulta['lote_compra'];
$cod_categoria                = $matriz_consulta['cod_categoria'];
$cod_origen_produccion        = $matriz_consulta['cod_origen_produccion'];
$cod_dependencia_sub          = $matriz_consulta['cod_dependencia_sub'];

$cod_tipo_habitacion_hotel    = $matriz_consulta['cod_tipo_habitacion_hotel'];
$cod_estado_habitacion_hotel  = $matriz_consulta['cod_estado_habitacion_hotel'];
$iva_saludable_ptj            = $matriz_consulta['iva_saludable_ptj'];
$cod_producto_barra2          = $matriz_consulta['cod_producto_barra2'];

$cod_promocion                = $matriz_consulta['cod_promocion'];
$cod_estado                   = $matriz_consulta['cod_estado'];
$codigo_estado                = $cod_estado;

$url_img_orig_producto        = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto         = $matriz_consulta['url_img_min_producto'];

if ($url_img_min_producto == '') {
    $url_img_orig_producto        = '../imagenes/img_no_disponible_grand.png';
    $url_img_min_producto         = '../imagenes/img_no_disponible_grand.png';
} else {
    $url_img_orig_producto        = $matriz_consulta['url_img_orig_producto'];
    $url_img_min_producto         = $matriz_consulta['url_img_min_producto'];
}

$cod_opcion_descontable_inv   = $matriz_consulta['cod_opcion_descontable_inv'];
$cod_estado_promocion         = $matriz_consulta['cod_estado_promocion'];
$posicion_promocion           = $matriz_consulta['posicion_promocion'];
$cod_estado_destacado         = $matriz_consulta['cod_estado_destacado'];
$posicion_destacado           = $matriz_consulta['posicion_destacado'];
$cod_tienda                   = $matriz_consulta['cod_tienda'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_producto_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="cod_producto_barra" id="cod_producto_barra" type="text" value="<?php echo $cod_producto_barra ?>" size="50" required /></td>
            <?php if ($cod_estado_cod_barra2_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="cod_producto_barra2" id="cod_producto_barra2" type="text" value="<?php echo $cod_producto_barra2 ?>" size="30" /></td><?php } ?>

            <td style="text-align:center"><input class="input-block-level" name="nombre_producto" id="nombre_producto" type="text" value="<?php echo $nombre_producto ?>" size="120" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="und_producto" type="text" value="<?php echo $und_producto ?>" size="10" /></td>
            <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
            <td style="text-align:center"><input class="input-block-level" name="und_producto_bodega" type="text" value="<?php echo $und_producto_bodega ?>" size="10" /></td>
            <?php } ?>

            <td style="text-align:center">
                <select name="nombre_tipo_unidad_medida" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                    <?php if (isset($nombre_tipo_unidad_medida)) { echo "";
                    } else { echo  ""; }
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
                <select name="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
                    <?php if (isset($nombre_tipo_producto)) { echo "";
                    } else { echo  ""; }
                    $consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY nombre_tipo_producto DESC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_producto'];
                    $nombre = $datos2['nombre_tipo_producto'];
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
            <?php if ($cod_estado_tienda_global == '1') { ?>
            <th style="text-align:center">TIENDA</th>
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
                    <?php if (isset($nombre_tipo_precio_venta)) { echo "";
                    } else { echo  ""; }
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
			<td style="text-align:center"><input class="input-block-level" name="cod_producto_serial" type="text" value="<?php echo $cod_producto_serial ?>" size="15" /></td>
			<?php } ?>

            <?php if ($cod_estado_lote_compra_global == '1') { ?>
            <td style="text-align:center"><input class="input-block-level" name="lote_compra" type="text" value="<?php echo $lote_compra ?>" size="15" /></td>
            <?php } ?>
            
            <td style="text-align:center"><input class="input-block-level" name="precio_compra_producto" type="number" value="<?php echo $precio_compra_producto ?>" size="50" step="any" min=0 required/></td>
            <?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
            if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
            } elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
            <td style="text-align:center"><input class="input-block-level" name="precio_venta_producto<?php echo $contador; ?>" type="number" value="<?php echo $precio_ventas ?>" size="50" /></td>
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

            <?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
            <th style="text-align:center">DESCONTABLE</th>
            <?php } ?>

            <?php if ($cod_estado_origen_produccion_global == '1') { ?>
            <th style="text-align:center">ORIGEN PRODUCCION</th>
            <?php } ?>

            <?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
            <th style="text-align:center">FECHA VENCIMIENTO</th>
            <th style="text-align:center">LOTE</th>
            <?php } ?>

            <?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
            <th style="text-align:center">FECHA MANTENIMIENTO</th>
            <th style="text-align:center">MANTENIMIENTO MESES</th>
            <?php } ?>

            <?php if ($cod_estado_meses_garantia_global  == '1') { ?><th style="text-align:center;">GARANTIA MESES</th><?php } ?>

            <?php if ($cod_estado_factura_compra_producto_global == '1') { ?><th style="text-align:center">FACTURA</th><?php } ?>    

            <th style="text-align:center">ESTADO PRODUCTO</th>      
        </tr>
        <tr>
            <?php if ($cod_estado_cajas_sobre_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="cajas_sobre" type="number" value="<?php echo $cajas_sobre ?>" lang="en" step="any" size="5" /></td><?php } ?>
            <?php if ($cod_estado_und_sobre_global == '1') { ?><td style="text-align:center"><input class="input-block-level" name="und_sobre" type="number" value="<?php echo $und_sobre ?>" size="5" /></td><?php } ?>
            
            <td style="text-align:center"><input class="input-block-level" name="tope_min" type="number" value="<?php echo $tope_min ?>" size="5" /></td>

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

            <?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
            <td style="text-align:center">
                <select name="cod_opcion_descontable_inv" id="select_cod_opcion_descontable_inv" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;">
                <?php if (isset($cod_opcion_descontable_inv)) { echo ""; } else { echo ""; }
                $sql_consulta2 = "SELECT cod_opcion_descontable_inv, nombre_opcion_descontable_inv FROM tbl15_opcion_descontable_inv ORDER BY cod_opcion_descontable_inv ASC";
                $consulta2 = mysqli_query($conectar, $sql_consulta2);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_opcion_descontable_inv) and $cod_opcion_descontable_inv == $datos2['cod_opcion_descontable_inv']) {
                $seleccionado = "selected";
                } else { $seleccionado = ""; }
                $codigo = $datos2['cod_opcion_descontable_inv'];
                $nombre = $datos2['nombre_opcion_descontable_inv'];
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
                    $consulta2_sql = ("SELECT cod_origen_produccion, nombre_origen_produccion FROM tbl15_origen_produccion ORDER BY cod_origen_produccion ASC");
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

            <?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
            <td style="text-align:center"><input class="input-block-level" name="fecha_vencimiento1" type="date" value="<?php echo $fecha_vencimiento1 ?>" size="10" /></td>
            <td style="text-align:center"><input class="input-block-level" name="vencimiento_lote1" type="text" value="<?php echo $vencimiento_lote1 ?>" size="10" /></td>
            <?php } ?>
            
            <?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
            <td style="text-align:center"><input class="input-block-level" name="fecha_mantenimiento" type="date" value="<?php echo $fecha_mantenimiento ?>" size="10" /></td>
            <td style="text-align:center"><input class="input-block-level" name="meses_mantenimiento" type="number" value="<?php echo $meses_mantenimiento ?>" size="10" /></td>
            <?php } ?>

            <?php if ($cod_estado_meses_garantia_global  == '1') { ?>
            <td style="text-align:center"><input class="input-block-level" name="meses_garantia" type="number" value="<?php echo $meses_garantia ?>" size="10" /></td>
            <?php } ?>

            <?php if ($cod_estado_factura_compra_producto_global == '1') { ?>
            <td style="text-align:center"><input class="input-block-level" name="cod_factura" type="text" value="<?php echo $cod_factura ?>" size="10" /></td>
            <?php } ?>

            <td style="text-align:center">
                <select name="cod_estado" id="" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" >
                    <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT codigo_estado, nombre_estado FROM tbl15_estado");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado) and $cod_estado == $datos2['codigo_estado']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['codigo_estado'];
                    $nombre = $datos2['nombre_estado'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
        </tr>
    </thead>
</table>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <?php if ($cod_estado_promocion_global == '1') { ?>
            <th style="text-align:center">ESTADO PROMOCION</th>
            <th style="text-align:center">POSICION PROMOCION</th>
            <th style="text-align:center">LABEL PROMOCION</th>
            <?php } ?>
            <?php if ($cod_estado_producto_destacado_global == '1') { ?>
            <th style="text-align:center">ESTADO DESCTACADO </th>
            <th style="text-align:center">POSICION DESCTACADO</th>
            <?php } ?>
        </tr>
        <tr>
            <?php if ($cod_estado_promocion_global == '1') { ?>
            <td style="text-align:center">
                <select name="cod_estado_promocion" id="" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" >
                    <?php if (isset($cod_estado_promocion)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT codigo_estado, nombre_estado FROM tbl15_estado");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_promocion) and $cod_estado_promocion == $datos2['codigo_estado']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['codigo_estado'];
                    $nombre = $datos2['nombre_estado'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>

            <td style="text-align:center"><input class="input-block-level" name="posicion_promocion" type="number" value="<?php echo $posicion_promocion ?>" size="10" /></td>

            <td style="text-align:center">
                <select name="cod_promocion" id="" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" >
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

            <?php if ($cod_estado_producto_destacado_global == '1') { ?>
            <td style="text-align:center">
                <select name="cod_estado_destacado" id="" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" >
                    <?php if (isset($cod_estado_destacado)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT codigo_estado, nombre_estado FROM tbl15_estado");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_destacado) and $cod_estado_destacado == $datos2['codigo_estado']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['codigo_estado'];
                    $nombre = $datos2['nombre_estado'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>

            <td style="text-align:center"><input class="input-block-level" name="posicion_destacado" type="number" value="<?php echo $posicion_destacado ?>" size="10" /></td>
            <?php } ?>
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
            <th style="text-align:center">CAMBIAR IMAGEN</th>
            <?php } ?>
        </tr>
        <tr>
            <?php if ($cod_estado_ptj_comision_global == '1') { ?>
            <th style="text-align:center"><input class="input-block-level" name="comision_ptj" type="number" value="<?php echo $comision_ptj ?>" size="5"/></th>
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

            <th style="text-align:center"><textarea class="input-block-level" name="descripcion_producto" id="descripcion_producto" rows="2" cols="20"><?php echo $descripcion_producto ?></textarea></th>
            <?php if ($cod_estado_img_producto_global == '1') { ?>
            <th style="text-align:center"><a href="../admin/lista_producto_imagen.php?cod_producto=<?php echo $cod_producto ?>&pagina=<?php echo $pagina ?>"><img src="<?php echo $url_img_min_producto ?>" class="img-polaroid" widht="30px" alt=""></a></th>
            <?php } ?>
        </tr>
    </thead>
</table>

<?php if ($cod_estado_subproducto_cuenta_servicio_global == '1') { ?>
    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">PERFILES CORREOS CUENTAS</th>
            </tr>
        </thead>
    </table>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">CORREO</th>
                <th style="text-align:center">CONTRASEÑA</th>
                <th style="text-align:center">PERFIL</th>
                <th style="text-align:center">PRECIO</th>
                <th style="text-align:center">ESTADO</th>
            </tr>
            <?php
            $sql_producto = "SELECT * FROM tbl15_producto_sub WHERE (cod_producto = '$cod_producto') ORDER BY cod_producto_sub DESC";
            $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
            while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

                $cod_producto_sub                   = $datos_producto['cod_producto_sub'];
                $correo_cuenta_servicio             = $datos_producto['correo_cuenta_servicio'];
                $contrasena_cuenta_servicio         = $datos_producto['contrasena_cuenta_servicio'];
                $perfil_cuenta_servicio             = $datos_producto['perfil_cuenta_servicio'];
                $precio_cuenta_servicio             = $datos_producto['precio_cuenta_servicio'];
                $cod_estado                         = $datos_producto['cod_estado'];
            ?>
            <tr>
                <td style="text-align:center"><input name="correo_cuenta_servicio" id="<?php echo $cod_producto_sub ?>" class="input-block-level" maxlength="30" type="text" value="<?php echo $correo_cuenta_servicio ?>"></td>
                <td style="text-align:center"><input name="contrasena_cuenta_servicio" id="<?php echo $cod_producto_sub ?>" class="input-block-level" maxlength="30" type="text" value="<?php echo $contrasena_cuenta_servicio ?>"></td>
                <td style="text-align:center"><input name="perfil_cuenta_servicio" id="<?php echo $cod_producto_sub ?>" class="input-block-level" maxlength="30" type="number" value="<?php echo $perfil_cuenta_servicio ?>"></td>
                <td style="text-align:center"><?php echo number_format($precio_cuenta_servicio, 0, ",", ".") ?></td>
                <td style="text-align:center">
                    <select name="cod_estado" id="<?php echo $cod_producto_sub ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                        <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
                        $consulta2_sql = "SELECT codigo_estado, nombre_estado FROM tbl15_estado";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_estado) AND $cod_estado == $datos2['codigo_estado']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['codigo_estado'];
                        $nombre = $datos2['nombre_estado'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
        </thead>
    </table>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:left"><a href="../admin/reg_subproducto_vacio_cuenta_perfil_reg.php?cod_producto=<?php echo $cod_producto?>&foco=reg_cuenta_subprod&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina_local?>" id="reg_cuenta_subprod"><img src=../imagenes/mas.png alt="mas"></a></th>
                <th style="text-align:right"><a href="../admin/edit_producto.php?cod_producto=<?php echo $cod_producto?>&foco=btn_refrescar&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina_local?>" id="btn_refrescar"><img src=../imagenes/corecto.png alt="mas"></a></th>
            </tr>
        </thead>
    </table>

    <script language="javascript">
    $(document).ready(function(){
        $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_producto_sub";
            var id = $(this).attr("id");
            var campo_incre = '';
            var pagina = "<?php echo $pagina; ?>";
            var cod_producto = "<?php echo $cod_producto; ?>";
            var nombre_modulo_puc = "";
            //let id = this.id;
            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'cod_producto='+cod_producto+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_subproducto_cuenta_perfil_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    var afectado = respuesta.afectado;
                    var campo = respuesta.emisor;
                    var mensaje = respuesta.mensaje;
                }
            });
        });
    });
    </script>


    <script language="javascript">
    $(document).ready(function(){
        $('select[name="cod_estado"]').change(function(){ 
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_producto_sub";
            var id = $(this).attr("id");
            var campo_incre = '';
            var pagina = "<?php echo $pagina; ?>";
            var cod_producto = "<?php echo $cod_producto; ?>";
            var nombre_modulo_puc = "";
            //let id = this.id;
            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'cod_producto='+cod_producto+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_subproducto_cuenta_perfil_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    var afectado = respuesta.afectado;
                    var campo = respuesta.emisor;
                    var mensaje = respuesta.mensaje;
                }
            });
        });
    });
    </script>
<?php } ?>

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
                <select name="nombre_sexo" id="nombre_sexo" class="nombre_sexo" required>
                    <?php if (isset($nombre_sexo)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                 <select name="nombre_estatus" id="nombre_estatus" class="nombre_estatus" required>
                    <?php if (isset($nombre_estatus)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
            <td style="text-align:center"><input name="fecha_nac" id="fecha_nac" class="fecha_nac" maxlength="11" type="date" value="<?php echo $fecha_nac ?>" required></td>
            <td style="text-align:center">
                <select name="nombre_condicion_corporal" id="nombre_condicion_corporal" class="nombre_condicion_corporal" required>
                    <?php if (isset($nombre_condicion_corporal)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                <select name="nombre_categoria_ingreso" id="nombre_categoria_ingreso" class="nombre_categoria_ingreso" required>
                    <?php if (isset($nombre_categoria_ingreso)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                <select name="nombre_procedencia" id="nombre_procedencia" class="nombre_procedencia" required>
                    <?php if (isset($nombre_procedencia)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                <select name="nombre_prog_reproductivo" id="nombre_prog_reproductivo" class="nombre_prog_reproductivo" required>
                    <?php if (isset($nombre_prog_reproductivo)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                    <?php if (isset($nombre_tipo_explotacion)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                    <?php if (isset($nombre_tipo_monta)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                    <?php if (isset($nombre_lote_categoria)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                    <?php if (isset($nombre_potrero)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                    <?php if (isset($nombre_calidad_animal)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
            <td style="text-align:center"><input name="numero_partos" id="numero_partos" class="numero_partos" maxlength="1" type="number" value="<?php echo $numero_partos ?>"></td>
            <td style="text-align:center"><input name="peso_compra" id="peso_compra" class="peso_compra" maxlength="4" type="number" value="<?php echo $peso_compra ?>"></td>
            <td style="text-align:center"><input name="fecha_compra" id="fecha_compra" class="fecha_compra" maxlength="11" type="date" value="<?php echo $fecha_compra ?>"></td>
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
                <select name="nombre_categoria_animal_extern" id="nombre_categoria_animal_extern" class="nombre_categoria_animal_extern" required>
                    <?php if (isset($nombre_categoria_animal_extern)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                    <?php if (isset($nombre_tipo_concepcion)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
                <select name="nombre_especie" id="nombre_especie" class="nombre_especie" required>
                    <?php if (isset($nombre_especie)) { echo ""; } else { echo  ""; }
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
            <td style="text-align:center"><input name="hierro_animal" id="hierro_animal" class="hierro_animal" maxlength="11" type="text" value="<?php echo $hierro_animal ?>"></td>
            <td style="text-align:center"><input name="id_electronica" id="id_electronica" class="id_electronica" maxlength="11" type="text" value="<?php echo $id_electronica ?>"></td>
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
                <select name="nombre_raza1" id="nombre_raza1" class="nombre_raza1" required>
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
            <td style="text-align:center"><input name="ptj_raza1" id="ptj_raza1" class="input-block-level" maxlength="11" type="text" value="<?php echo $ptj_raza1 ?>"></td>
            <td style="text-align:center">
                <select name="nombre_raza2" id="nombre_raza2" class="nombre_raza2">
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
            <td style="text-align:center"><input name="ptj_raza2" id="ptj_raza2" class="input-block-level" maxlength="2" type="text" value="<?php echo $ptj_raza2 ?>"></td>
            <td style="text-align:center">
                <select name="nombre_raza3" id="nombre_raza3" class="nombre_raza3">
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
            <td style="text-align:center"><input name="ptj_raza3" id="ptj_raza3" class="input-block-level" maxlength="2" type="text" value="<?php echo $ptj_raza3 ?>"></td>
            <td style="text-align:center">
                <select name="nombre_raza4" id="nombre_raza4" class="nombre_raza4">
                    <?php if (isset($nombre_raza1)) { echo "<option value='' >Seleccione</option>";
                    } else { echo  "<option value='' selected >Seleccione</option>"; }
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
            <td style="text-align:center"><input name="ptj_raza4" id="ptj_raza4" class="input-block-level" maxlength="2" type="text" value="<?php echo $ptj_raza4 ?>"></td>
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
            <td style="text-align:center"><input name="id_padre" id="id_padre" class="input-block-level" maxlength="10" type="text" value="<?php echo $id_padre ?>"></td>
            <td style="text-align:center"><input name="id_madre" id="id_madre" class="input-block-level" maxlength="10" type="text" value="<?php echo $id_madre ?>"></td>
            <td style="text-align:center"><input name="id_abuelo_paterno" id="id_abuelo_paterno" class="input-block-level" maxlength="10" type="text" value="<?php echo $id_abuelo_paterno ?>"></td>
            <td style="text-align:center"><input name="id_abuelo_materno" id="id_abuelo_materno" class="input-block-level" maxlength="10" type="text" value="<?php echo $id_abuelo_materno ?>"></td>
            <td style="text-align:center"><input name="id_abuela_paterno" id="id_abuela_paterno" class="input-block-level" maxlength="10" type="text" value="<?php echo $id_abuela_paterno ?>"></td>
            <td style="text-align:center"><input name="id_abuela_materno" id="id_abuela_materno" class="input-block-level" maxlength="10" type="text" value="<?php echo $id_abuela_materno ?>"></td>
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
                <div><strong>Fecha Castracion:</strong><input name="fecha_castracion" id="fecha_castracion" class="fecha_castracion" maxlength="11" type="date" value="<?php echo $fecha_castracion ?>"></div>
            </td>
            <td style="text-align:center"><input name="nombre_color" id="nombre_color" class="input-block-level" maxlength="30" type="text" value="<?php echo $nombre_color ?>"></td>
            <td style="text-align:center"><input name="nombre_temperamento" id="nombre_temperamento" class="input-block-level" maxlength="30" type="text" value="<?php echo $nombre_temperamento ?>"></td>
            <td style="text-align:center"><input name="peso_nacer" id="peso_nacer" class="peso_nacer" maxlength="30" type="text" value="<?php echo $peso_nacer ?>"></td>
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
            <td style="text-align:center"><input name="aplomo_corvejon" id="aplomo_corvejon" class="input-block-level" maxlength="30" type="text" value="<?php echo $aplomo_corvejon ?>"></td>
            <td style="text-align:center"><input name="aplomo_cuartilla" id="aplomo_cuartilla" class="input-block-level" maxlength="30" type="text" value="<?php echo $aplomo_cuartilla ?>"></td>
            <td style="text-align:center"><input name="aplomo_cascos" id="aplomo_cascos" class="input-block-level" maxlength="30" type="text" value="<?php echo $aplomo_cascos ?>"></td>
            <td style="text-align:center"><input name="genital_circun_escrotal" id="genital_circun_escrotal" class="input-block-level" maxlength="30" type="text" value="<?php echo $genital_circun_escrotal ?>"></td>
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
            <td style="text-align:center"><input name="genital_prepusio" id="genital_prepusio" class="input-block-level" maxlength="30" type="text" value="<?php echo $genital_prepusio ?>"></td>
            <td style="text-align:center"><input name="genital_potencia" id="genital_potencia" class="input-block-level" maxlength="30" type="text" value="<?php echo $genital_potencia ?>"></td>
            <td style="text-align:center"><input name="genital_semen" id="genital_semen" class="input-block-level" maxlength="30" type="text" value="<?php echo $genital_semen ?>"></td>
            <td style="text-align:center"><textarea rows="2" cols="50" class="span8" name="observacion_animal" id="observacion_animal" class="input-block-level"><?php echo $observacion_animal ?></textarea></td>
        </tr>
    </thead>
</table>
</fieldset>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_producto" value="<?php echo $cod_producto ?>"/>
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