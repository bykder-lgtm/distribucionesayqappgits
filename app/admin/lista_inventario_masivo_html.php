<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('inventario_masivo_editable_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>
</head>
<body onLoad="myajax = new isiAJAX();" id="pageBody">

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="../admin/lista_inventario_editable_ajax.php"><h6>Inventario</h6></a>
<a class="btn btn-primary" href="#"><h6>Inventario Masivo</h6></a>
<?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
<a class="btn btn-primary" href="../admin/lista_inventario_masivo_editable_activo_visitante_ext_ajax.php"><h6>Inventario Masivo Estado</h6></a>
<?php } ?>
<?php if ($cod_estado_origen_produccion_global == '1') { ?>
<a class="btn btn-primary" href="../admin/lista_inventario_masivo_editable_origen_produccion_ajax.php"><h6>Inventario Masivo Origen Produccion</h6></a>
<?php } ?>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                               = $_SERVER['PHP_SELF'];
$tab                                  = 'tbl15_informe_condiciones_salud';
$tipo                                 = 'eliminar';
$campo                                = 'cod_informe_condiciones_salud';
$fecha                                = date("Y/m/d");
$origen                               = 'PARACLINICOS';
$seleccionado                         = 0;
$filtro_consulta_dependencia          = "";
$filtro_consulta_dependencia_and      = "";
$filtro_consulta_dependencia_rel      = "";

if (isset($_GET['campo_ordenamiento'])) {
$campo_ordenamiento = addslashes($_GET['campo_ordenamiento']);
$tipo_ordenamiento = addslashes($_GET['tipo_ordenamiento']);
$buscar = '';
$cod_dependencias = '0';
} else {
$campo_ordenamiento = 'nombre_producto';
$tipo_ordenamiento = 'DESC';
$buscar = '';
$cod_dependencias = '0';
}



if (isset($_POST['buscar'])) {
$buscar                                  = addslashes($_POST['buscar']);
$cod_dependencias                        = intval($_POST['cod_dependencias']);
}
?>
<form action="" method="post">
<table>
<td style="text-align:center"><input name="buscar" autofocus /></td>
<td style="text-align:left;">
    <select name="cod_dependencias" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_dependencias)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
        $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY nombre_dependencia ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_dependencias) AND $cod_dependencias == $datos2['cod_dependencia']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_dependencia'];
        $nombre = $datos2['nombre_dependencia'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
<td style="text-align:center"><input type="submit" name="buscador" value="Buscar productos" /></td>
</table>
</form>

<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';

if (isset($_POST['buscar'])) {
$buscar                                  = addslashes($_POST['buscar']);
$cod_dependencias                        = intval($_POST['cod_dependencias']);
/*
$total_productos_inventario = "SELECT * FROM tbl15_producto";
$consulta_inventario = mysqli_query($conectar, $total_productos_inventario);
$total_productos = mysqli_num_rows($consulta_inventario);

$total_unidades = "SELECT Sum(unidades_faltantes) AS unidades_faltantes FROM tbl15_producto";
$consulta_inventario_total_unidades = mysqli_query($conectar, $total_unidades);
$inventario_total_unidades = mysqli_fetch_assoc($consulta_inventario_total_unidades);

$calculos_inventario = "SELECT Sum(precio_costo * unidades_faltantes) As tot_precio_costo, Sum(precio_venta * unidades_faltantes) As tot_precio_venta, 
Sum(unidades_faltantes * precio_compra) As tot_precio_compra FROM tbl15_producto";
$consulta_calculos_inventario = mysqli_query($conectar, $calculos_inventario);
$matriz_inventario = mysqli_fetch_assoc($consulta_calculos_inventario);

$sql_ultima_llave_productos = "SELECT max(cod_productos) AS ultimo FROM tbl15_producto";
$consulta_ultima_llave_productos = mysqli_query($conectar, $sql_ultima_llave_productos);
$resultado = mysqli_fetch_assoc($consulta_ultima_llave_productos);

$ultimo_id = $resultado['ultimo'];
*/
} else {
$buscar                                  = '';
$cod_dependencias                        = '0';
}

if ($cod_dependencias==0) {
$filtro_consulta_dependencia = "";
$filtro_consulta_dependencia_and = "";
$filtro_consulta_dependencia_rel = "";

$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$nombre_dependencia_get                             = 'TODOS';
} else {
$filtro_consulta_dependencia = "WHERE (cod_dependencia = '$cod_dependencias')";
$filtro_consulta_dependencia_and = "AND (cod_dependencia = '$cod_dependencias')";
$filtro_consulta_dependencia_rel = "WHERE (tbl15_producto.cod_dependencia = '$cod_dependencias')";

$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto $filtro_consulta_dependencia";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencias'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia_get                             = $datos_dependencia['nombre_dependencia'];
}

$total_codigos                           = $datos_conteo_atendido_mujer['total_codigos'];
$total_compra_producto                   = $datos_conteo_atendido_mujer['total_compra_producto'];
$total_venta_producto                    = $datos_conteo_atendido_mujer['total_venta_producto'];
$total_compra_producto_bodega            = $datos_conteo_atendido_mujer['total_compra_producto_bodega'];
$total_venta_producto_bodega             = $datos_conteo_atendido_mujer['total_venta_producto_bodega'];

$total_ganacia_invenario                 = $total_venta_producto - $total_compra_producto;
$total_ganacia_invenario_ptj             = ($total_compra_producto / $total_venta_producto) * 100;

$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Y-m-d");
$hora_venta_his                          = date("H:i:s");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
$pagina                                  = $_SERVER['PHP_SELF'];
?>
<br>
<div class="table-responsive">

<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
    <tr>
        <th style="text-align:center">Cod Baras Producto</th>
        <th style="text-align:center">Nombre Producto</th>
        <th style="text-align:center">Unidades Inv</th>
        <th style="text-align:center">P.Compra</th>
        <th style="text-align:center">P.Venta</th>
    </tr>
    <tr>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=cod_producto_barra&tipo_ordenamiento=DESC">De Mayor a Menor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=nombre_producto&tipo_ordenamiento=DESC">De Mayor a Menor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=und_producto&tipo_ordenamiento=DESC">De Mayor a Menor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=precio_compra_producto&tipo_ordenamiento=DESC">De Mayor a Menor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=precio_venta_producto&tipo_ordenamiento=DESC">De Mayor a Menor</a></th>
    </tr>
    <tr>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=cod_producto_barra&tipo_ordenamiento=ASC">De Menor a Mayor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=nombre_producto&tipo_ordenamiento=ASC">De Menor a Mayor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=und_producto&tipo_ordenamiento=ASC">De Menor a Mayor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=precio_compra_producto&tipo_ordenamiento=ASC">De Menor a Mayor</a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=precio_venta_producto&tipo_ordenamiento=ASC">De Menor a Mayor</a></th>
    </tr>
</table>


<table class="table table-striped">
<tr>
<th style="text-align:center">Total Codigos</th>
<th style="text-align:center">Total Inv Precio Compra</th>
<th style="text-align:center">Total Inv Precio Venta</th>

<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<th style="text-align:center">Total Inv Precio Compra Bodega</th>
<th style="text-align:center">Total Inv Precio Venta Bodega</th>
<?php } ?>

<?php if ($cod_estado_diferencia_ganancia_inventario_global == '1') { ?>
<th style="text-align:center">Ganancia $</th>
<?php } ?>

<?php if ($cod_estado_diferencia_ganancia_inventario_ptj_promedio_global == '1') { ?>
<th style="text-align:center">Ganancia % Promedio</th>
<?php } ?>

<th style="text-align:center">Dependencia</th>

<?php if ($cod_estado_prod_exportar == '1') { ?>
<th style="text-align:center">Export Xls</th>
<th style="text-align:center">Export Xlsx</th>
<?php } ?>
</tr>
<tr>
<th style="text-align:center"><?php echo number_format($total_codigos, 0, ",", ".") ?></th>
<th style="text-align:center"><?php echo number_format($total_compra_producto, 0, ",", ".") ?></th>
<th style="text-align:center"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></th>
<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<th style="text-align:center"><?php echo number_format($total_compra_producto_bodega, 0, ",", ".") ?></th>
<th style="text-align:center"><?php echo number_format($total_venta_producto_bodega, 0, ",", ".") ?></th>
<?php } ?>

<?php if ($cod_estado_diferencia_ganancia_inventario_global == '1') { ?>
<th style="text-align:center"><?php echo number_format($total_ganacia_invenario, 0, ",", ".") ?></th>
<?php } ?>

<?php if ($cod_estado_diferencia_ganancia_inventario_ptj_promedio_global == '1') { ?>
<th style="text-align:center"><?php echo number_format($total_ganacia_invenario_ptj, 0, ",", ".") ?>%</th>
<?php } ?>

<th style="text-align:center"><?php echo $nombre_dependencia_get ?></th>

<?php if ($cod_estado_prod_exportar == '1') { ?>
<td style="text-align:center"><a href="../admin/descargar_inventario_xls.php?cod_administrador=<?php echo $cod_administrador?>&cod_dependencia=<?php echo $cod_dependencias?>&nombre_dependencia_get=<?php echo $nombre_dependencia_get?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
<td style="text-align:center"><a href="../admin/descargar_inventario_xlsx.php?cod_administrador=<?php echo $cod_administrador?>&cod_dependencia=<?php echo $cod_dependencias?>&nombre_dependencia_get=<?php echo $nombre_dependencia_get?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
<?php } ?>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<th style="text-align:center">COD PRODUCTO</th>
<th style="text-align:center">NOMBRE PRODUCTO</th>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<th style="text-align:center">T.UND</th>
<?php } ?>

<?php if ($cod_estado_prod_und_producto_bodega == '1') { ?>
<th style="text-align:center">T.UND BODEGA</th>
<?php } ?>

<?php if ($cod_estado_marca_global == '1') { ?>
<th style="text-align:center">MARCA</th>
<?php } ?>

<th style="text-align:center">MEDIDA</th>

<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
<th style="text-align:center">P.COMPRA</th>
<?php } ?>

<th style="text-align:center">T.P</th>

<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>
<?php } ?>

<?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
<th style="text-align:center;">CAJA</th>
<?php } ?>

<?php if ($cod_estado_und_sobre_global  == '1') { ?>
<th style="text-align:center;">SOBRE</th>
<?php } ?>

<th style="text-align:center">IVA</th>

<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<th style="text-align:center">COMISION</th>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<th style="text-align:center">F.VENCIMIENTO</th>
<th style="text-align:center">LOTE</th>
<?php } ?>

<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<th style="text-align:center">FECHA MANTENIMIENTO</th>
<th style="text-align:center">MANTENIMIENTO MESES</th>
<?php } ?>

<?php if ($cod_estado_meses_garantia_global  == '1') { ?>
<th style="text-align:center;">GARANTIA MESES</th>
<?php } ?>

<?php if ($cod_estado_factura_compra_producto_global == '1') { ?>
<th style="text-align:center">FACTURA</th>
<?php } ?>

<?php if ($cod_estado_producto_serial_global == '1') { ?>
<th style="text-align:center">SERIAL PRODUCTO</th>
<?php } ?>

<th style="text-align:center">TIPO PRODUCTO</th>

<?php if ($cod_estado_peso_producto_global == '1') { ?>
<th style="text-align:center">PESO (KG)</th>
<?php } ?>

<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
<th style="text-align:center">DESCONTABLE</th>
<?php } ?>

<?php if ($cod_estado_categoria_global == '1') { ?>
<th style="text-align:center">CATEGORIA</th>
<?php } ?>

<?php if ($cod_estado_producto_de_cocina_global == '1') { ?>
<th style="text-align:center">IMPRIMIR EN COCINA</th>
<?php } ?>

<th style="text-align:center">DEPENDENCIA</th>

<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
<th style="text-align:center">SUB DEPENDENCIA - SEDE</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_compra_producto, precio_costo_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
cod_dependencia, iva_ptj, nombre_tipo_producto, comision_ptj, fecha_vencimiento, fecha_vencimiento1, lote_vencimiento, 
vencimiento_lote1, nombre_tipo_precio_venta, und_producto_bodega, nombre_tipo_unidad_medida, fecha_mantenimiento, cajas_sobre, 
und_sobre, cod_opcion_descontable_inv, cod_categoria, cod_tipo_producto_cocina, peso_producto, unidad_medida_peso, cod_estado_peso, 
cod_dependencia_sub, cod_factura, meses_mantenimiento, meses_garantia, cod_producto_serial, cod_marca
FROM tbl15_producto WHERE (cod_producto_barra = '$buscar' OR nombre_producto LIKE '%$buscar%') $filtro_consulta_dependencia_and ORDER BY $campo_ordenamiento $tipo_ordenamiento";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_producto                   = $info_info_factura['cod_producto'];
$cod_producto_barra             = $info_info_factura['cod_producto_barra'];
$nombre_producto                = $info_info_factura['nombre_producto'];
$und_producto                   = $info_info_factura['und_producto'];
$precio_compra_producto         = $info_info_factura['precio_compra_producto'];
$precio_costo_producto          = $info_info_factura['precio_costo_producto'];
$precio_venta_producto          = $info_info_factura['precio_venta_producto'];
$precio_venta_producto2         = $info_info_factura['precio_venta_producto2'];
$precio_venta_producto3         = $info_info_factura['precio_venta_producto3'];
$precio_venta_producto4         = $info_info_factura['precio_venta_producto4'];
$precio_venta_producto5         = $info_info_factura['precio_venta_producto5'];
if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
$cod_dependencia                = $info_info_factura['cod_dependencia'];
$iva_ptj                        = $info_info_factura['iva_ptj'];
$nombre_tipo_producto           = $info_info_factura['nombre_tipo_producto'];
$comision_ptj                   = $info_info_factura['comision_ptj'];
$fecha_vencimiento              = $info_info_factura['fecha_vencimiento'];
$fecha_vencimiento1             = $info_info_factura['fecha_vencimiento1'];
$lote_vencimiento               = $info_info_factura['lote_vencimiento'];
$vencimiento_lote1              = $info_info_factura['vencimiento_lote1'];
$nombre_tipo_precio_venta       = $info_info_factura['nombre_tipo_precio_venta'];
$und_producto_bodega            = $info_info_factura['und_producto_bodega'];
$nombre_tipo_unidad_medida      = $info_info_factura['nombre_tipo_unidad_medida'];
$fecha_mantenimiento            = $info_info_factura['fecha_mantenimiento'];
$cajas_sobre                    = $info_info_factura['cajas_sobre'];
$und_sobre                      = $info_info_factura['und_sobre'];
$cod_opcion_descontable_inv     = $info_info_factura['cod_opcion_descontable_inv'];
$cod_categoria                  = $info_info_factura['cod_categoria'];
$cod_tipo_producto_cocina       = $info_info_factura['cod_tipo_producto_cocina'];
$peso_producto                  = $info_info_factura['peso_producto'];
$unidad_medida_peso             = $info_info_factura['unidad_medida_peso'];
$cod_estado_peso                = $info_info_factura['cod_estado_peso'];
$cod_dependencia_sub            = $info_info_factura['cod_dependencia_sub'];
$cod_factura                    = $info_info_factura['cod_factura'];
$meses_mantenimiento            = $info_info_factura['meses_mantenimiento'];
$meses_garantia                 = $info_info_factura['meses_garantia'];
$cod_producto_serial            = $info_info_factura['cod_producto_serial'];
$cod_marca                      = $info_info_factura['cod_marca'];
?>
<tr>
<td style="text-align:center"><?php echo $cod_producto_barra;?></td>

<td style="text-align:left"><?php echo $nombre_producto;?></td>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<td style="text-align:center"><?php echo $und_producto;?></td>
<?php } ?>

<?php if ($cod_estado_prod_und_producto_bodega == '1') { ?>
<td style="text-align:center"><?php echo $und_producto_bodega;?></td>
<?php } ?>

<?php if ($cod_estado_marca_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_marca;?></td>
<?php } ?>

<td style="text-align:center"><?php echo $nombre_tipo_unidad_medida;?></td>

<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
<td style="text-align:center"><?php echo $precio_compra_producto;?></td>
<?php } ?>

<td style="text-align:center"><?php echo $nombre_tipo_precio_venta;?></td>

<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center"><?php echo "$precio_ventas"; ?></td>
<?php } ?>
<?php } ?>

<?php if ($cod_estado_cajas_sobre_global == '1') { ?>
<td style="text-align:center"><?php echo $cajas_sobre;?></td>
<?php } ?>

<?php if ($cod_estado_und_sobre_global == '1') { ?>
<td style="text-align:center"><?php echo $und_sobre;?></td>
<?php } ?>

<td style="text-align:center"><?php echo $iva_ptj;?></td>

<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<td style="text-align:center"><?php echo $comision_ptj;?></td>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center"><?php echo $fecha_vencimiento1;?></td>
<td style="text-align:center"><?php echo $vencimiento_lote1;?></td>
<?php } ?>

<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<td style="text-align:center"><?php echo $fecha_mantenimiento;?></td>
<td style="text-align:center"><?php echo $meses_mantenimiento;?></td>
<?php } ?>

<?php if ($cod_estado_meses_garantia_global == '1') { ?>
<td style="text-align:center"><?php echo $meses_garantia;?></td>
<?php } ?>

<?php if ($cod_estado_factura_compra_producto_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_factura;?></td>
<?php } ?>

<?php if ($cod_estado_producto_serial_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_producto_serial;?></td>
<?php } ?>

<td style="text-align:center"><?php echo $nombre_tipo_producto;?></td>

<?php if ($cod_estado_peso_producto_global == '1') { ?>
<td style="text-align:center"><?php echo $peso_producto;?></td>
<?php } ?>

<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_opcion_descontable_inv;?></td>
<?php } ?>

<?php if ($cod_estado_categoria_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_categoria;?></td>
<?php } ?>

<?php if ($cod_estado_producto_de_cocina_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_tipo_producto_cocina;?></td>
<?php } ?>

<td style="text-align:center"><?php echo $cod_dependencia;?></td>

<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
<td style="text-align:center"><?php echo $cod_dependencia_sub;?></td>
<?php } ?>

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
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_venta = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_venta+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_venta+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_venta).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_venta).fadeOut("slow");
                $('#edit'+cod_info_factura_venta).fadeOut("slow");
                $('#excel'+cod_info_factura_venta).fadeOut("slow");
                $('#imp'+cod_info_factura_venta).fadeOut("slow");
                $('#lista'+cod_info_factura_venta).fadeOut("slow");
                $('#tr'+cod_info_factura_venta).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia_sub"]').change(function(){ 
  var cod_dependencia_sub = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_dependencia_sub, campo:"cod_dependencia_sub", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_categoria"]').change(function(){ 
  var cod_categoria = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_categoria, campo:"cod_categoria", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_marca"]').change(function(){ 
  var cod_marca = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_marca, campo:"cod_marca", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_tipo_producto_cocina"]').change(function(){ 
  var cod_tipo_producto_cocina = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_tipo_producto_cocina, campo:"cod_tipo_producto_cocina", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>


<script>  
 $(document).ready(function(){  

  $('select[name="cod_opcion_descontable_inv"]').change(function(){ 
  var cod_opcion_descontable_inv = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_opcion_descontable_inv, campo:"cod_opcion_descontable_inv", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
</script>

<script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_precio_venta"]').change(function(){ 
  var nombre_tipo_precio_venta = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_tipo_precio_venta, campo:"nombre_tipo_precio_venta", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_producto"]').change(function(){ 
  var nombre_tipo_producto = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_tipo_producto, campo:"nombre_tipo_producto", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_unidad_medida"]').change(function(){ 
  var nombre_tipo_unidad_medida = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_tipo_unidad_medida, campo:"nombre_tipo_unidad_medida", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="unidad_medida_peso"]').change(function(){ 
  var unidad_medida_peso = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:unidad_medida_peso, campo:"unidad_medida_peso", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

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