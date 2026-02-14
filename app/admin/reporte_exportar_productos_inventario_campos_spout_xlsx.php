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
<a class="btn btn-primary" href="#"><h6>Inventario</h6></a>
<a class="btn btn-primary" href="../admin/lista_inventario_masivo_editable_ajax.php"><h6>Inventario Masivo</h6></a>
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
$seleccionado                      = 0;
$nombre_dependencia_get            = '';
$pagina                            = $_SERVER['PHP_SELF'];

if (isset($_GET['cod_dependencia'])) { 
    $cod_dependencia = intval($_GET['cod_dependencia']); 
    if ($cod_dependencia <> '') { 
        $filtro_dependencia = "AND (cod_dependencia = '$cod_dependencia')"; 
    } else { 
        $filtro_dependencia = "";  
    }
} else { 
    $cod_dependencia = ''; 
    $filtro_dependencia = ""; 
}


if (isset($_GET['nombre_tipo_producto'])) { 
    $nombre_tipo_producto = addslashes($_GET['nombre_tipo_producto']); 
    if ($nombre_tipo_producto <> '') { 
        $filtro_tipo_producto = "AND (nombre_tipo_producto = '$nombre_tipo_producto')"; 
    } else { 
        $filtro_tipo_producto = "";  
    }
} else { 
    $nombre_tipo_producto = ''; 
    $filtro_tipo_producto = ""; 
}

if (isset($_GET['nombre_tipo_precio_venta'])) { 
    $nombre_tipo_precio_venta = addslashes($_GET['nombre_tipo_precio_venta']); 
    if ($nombre_tipo_precio_venta <> '') { 
        $filtro_tipo_precio_venta = "AND (nombre_tipo_precio_venta = '$nombre_tipo_precio_venta')"; 
    } else { 
        $filtro_tipo_precio_venta = "";  
    }
} else { 
    $nombre_tipo_precio_venta = ''; 
    $filtro_tipo_precio_venta = ""; 
}


if (isset($_GET['nombre_tipo_unidad_medida'])) { 
    $nombre_tipo_unidad_medida = addslashes($_GET['nombre_tipo_unidad_medida']); 
    if ($nombre_tipo_unidad_medida <> '') { 
        $filtro_tipo_unidad_medida = "AND (nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida')"; 
    } else { 
        $filtro_tipo_unidad_medida = "";  
    }
} else { 
    $nombre_tipo_unidad_medida = ''; 
    $filtro_tipo_unidad_medida = ""; 
}

if (isset($_GET['nombre_estado'])) { 
    $nombre_estado = addslashes($_GET['nombre_estado']); 
    if ($nombre_estado <> '') { 
        $filtro_nombre_estado = "AND (nombre_estado = '$nombre_estado')"; 
    } else { 
        $filtro_nombre_estado = "";  
    }
} else { 
    $nombre_estado = ''; 
    $filtro_nombre_estado = ""; 
}


if (isset($_GET['cod_categoria'])) { 
    $cod_categoria = intval($_GET['cod_categoria']); 
    if ($cod_categoria <> '') { 
        $filtro_categoria = "AND (cod_categoria = '$cod_categoria')"; 
    } else { 
        $filtro_categoria = "";  
    }
} else { 
    $cod_categoria = ''; 
    $filtro_categoria = ""; 
}

if (isset($_GET['nombre_tipo_compra'])) { 
    $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); 
    if ($nombre_tipo_compra <> '') { 
        $filtro_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')"; 
    } else { 
        $filtro_tipo_compra = "";  
    }
} else { 
    $nombre_tipo_compra = ''; 
    $filtro_tipo_compra = ""; 
}

if (isset($_GET['cod_tipo_producto_cocina'])) { 
    $cod_tipo_producto_cocina = intval($_GET['cod_tipo_producto_cocina']); 
    if ($cod_tipo_producto_cocina <> '') { 
        $filtro_tipo_producto_cocina = "AND (cod_tipo_producto_cocina = '$cod_tipo_producto_cocina')"; 
    } else { 
        $filtro_tipo_producto_cocina = "";  
    }
} else { 
    $cod_tipo_producto_cocina = ''; 
    $filtro_tipo_producto_cocina = ""; 
}

if (isset($_GET['nombre_promocion'])) { 
    $nombre_promocion = addslashes($_GET['nombre_promocion']); 
    if ($nombre_promocion <> '') { 
        $filtro_promocion = "AND (nombre_promocion = '$nombre_promocion')"; 
    } else { 
        $filtro_promocion = "";  
    }
} else { 
    $nombre_promocion = ''; 
    $filtro_promocion = ""; 
}

if (isset($_GET['cod_opcion_descontable_inv'])) { 
    $cod_opcion_descontable_inv = intval($_GET['cod_opcion_descontable_inv']); 
    if ($cod_opcion_descontable_inv <> '') { 
        $filtro_opcion_descontable_inv = "AND (cod_opcion_descontable_inv = '$cod_opcion_descontable_inv')"; 
    } else { 
        $filtro_opcion_descontable_inv = "";  
    }
} else { 
    $cod_opcion_descontable_inv = ''; 
    $filtro_opcion_descontable_inv = ""; 
}

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
?>
<form action="" id="" method="GET">
<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <?php if ($cod_estado_dependencia_global == '1') { ?><th style="text-align:center;">DEPENDENCIA</th><?php } ?> 
    <th style="text-align:center;">TIPO PRODUCTO</th>
    <th style="text-align:center;">TIPO PRECIO</th>
    <th style="text-align:center;">UNIDAD DE MEDIDA</th>
    <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?><th style="text-align:center;">ESTADO PRODUCTO</th><?php } ?> 
    <?php if ($cod_estado_categoria_global == '1') { ?><th style="text-align:center;">CATEGORIA</th><?php } ?> 
    <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center;">TIPO COMPRA</th><?php } ?>  
    <?php if ($cod_estado_promocion_global == '1') { ?><th style="text-align:center;">PROMOCION</th><?php } ?> 
    <?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?><th style="text-align:center;">DESCONTABLE INV</th><?php } ?> 
  </tr>
  <tr>

    <?php if ($cod_estado_dependencia_global == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_dependencia" id="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($cod_dependencia)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo  "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY nombre_dependencia ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_dependencia'];
            $nombre = $datos2['nombre_dependencia'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?> 

    <td style="text-align:center;">
        <select name="nombre_tipo_producto" id="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($nombre_tipo_producto)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo  "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY nombre_tipo_producto ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_producto) AND $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_producto'];
            $nombre = $datos2['nombre_tipo_producto'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_precio_venta" id="nombre_tipo_precio_venta" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($nombre_tipo_precio_venta)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo  "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta WHERE (cod_estado = '1') ORDER BY cod_tipo_precio_venta ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_precio_venta) AND $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_precio_venta'];
            $nombre = $datos2['nombre_tipo_precio_venta'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_unidad_medida" id="nombre_tipo_unidad_medida" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($nombre_tipo_unidad_medida)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo  "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_unidad_medida, nombre_tipo_unidad_medida, nombre_completo_tipo_unidad_medida FROM tbl15_tipo_unidad_medida ORDER BY cod_tipo_unidad_medida ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_unidad_medida) AND $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_unidad_medida'];
            $nombre = $datos2['nombre_tipo_unidad_medida'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
    <td style="text-align:center;">
        <select name="nombre_estado" id="nombre_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($nombre_estado)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_estado FROM tbl15_estado ORDER BY nombre_estado DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_estado) AND $nombre_estado == $datos2['nombre_estado']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_estado'];
            $nombre = $datos2['nombre_estado'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>

    <?php if ($cod_estado_categoria_global == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_categoria" id="cod_categoria" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($cod_categoria)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria ORDER BY cod_categoria DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_categoria) AND $cod_categoria == $datos2['cod_categoria']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_categoria'];
            $nombre = $datos2['nombre_categoria'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>

    <?php if ($cod_estado_tipo_compra_global == '1') { ?>
    <td style="text-align:center;">
        <select name="nombre_tipo_compra" id="nombre_tipo_compra" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($nombre_tipo_compra)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_compra FROM tbl15_tipo_compra ORDER BY nombre_tipo_compra DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_compra) AND $nombre_tipo_compra == $datos2['nombre_tipo_compra']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_compra'];
            $nombre = $datos2['nombre_tipo_compra'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>


    <?php if ($cod_estado_promocion_global == '1') { ?>
    <td style="text-align:center;">
        <select name="nombre_promocion" id="nombre_promocion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($nombre_promocion)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_promocion FROM tbl15_promocion ORDER BY nombre_promocion DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_promocion) AND $nombre_promocion == $datos2['nombre_promocion']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_promocion'];
            $nombre = $datos2['nombre_promocion'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>

    <?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_opcion_descontable_inv" id="cod_opcion_descontable_inv" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
            <?php if (isset($cod_opcion_descontable_inv)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo "<option value='' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_opcion_descontable_inv, nombre_opcion_descontable_inv FROM tbl15_opcion_descontable_inv ORDER BY cod_opcion_descontable_inv DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_opcion_descontable_inv) AND $cod_opcion_descontable_inv == $datos2['cod_opcion_descontable_inv']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_opcion_descontable_inv'];
            $nombre = $datos2['nombre_opcion_descontable_inv'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>
  </tr>
  </table>

<table class="table table-striped" cellspacing="0" cellpadding="20">
    <tr>
        <th style="text-align:center;"><input type="submit" value="Generar Reporte Por Archivo" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></th>
    </tr>
</table>
</form>
<?php
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto WHERE (cod_producto >= '0') 
$filtro_dependencia $filtro_tipo_producto $filtro_tipo_precio_venta $filtro_tipo_unidad_medida $filtro_nombre_estado $filtro_categoria
$filtro_tipo_compra $filtro_tipo_producto_cocina $filtro_promocion $filtro_opcion_descontable_inv";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

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

<?php if (isset($_GET['cod_dependencia'])) { ?>
<br>
<div class="table-responsive">

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
    <td style="text-align:center"><a href="../admin/exportar_productos_inventario_campos_punto_y_coma_csv.php?cod_administrador=<?php echo $cod_administrador?>&cod_barra_nombre_producto=&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>&campo_ordenamiento=<?php echo $campo_ordenamiento?>&tipo_ordenamiento=<?php echo $tipo_ordenamiento?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td> 
    <?php if ($cod_estado_tipo_export_excel_global == '1') { ?>
        <th style="text-align:center"><a href="../admin/descargar_inventario_spout_xlsx.php?cod_administrador=<?php echo $cod_administrador?>&cod_barra_nombre_producto=&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>&campo_ordenamiento=<?php echo $campo_ordenamiento?>&tipo_ordenamiento=<?php echo $tipo_ordenamiento?>"><img src=../imagenes/btn_xls.png alt="imprimir_peq"></a></th>
    <?php } else { ?>
        <th style="text-align:center"><a href="../admin/descargar_inventario_xlsx.php?cod_administrador=<?php echo $cod_administrador?>&cod_barra_nombre_producto=&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>&campo_ordenamiento=<?php echo $campo_ordenamiento?>&tipo_ordenamiento=<?php echo $tipo_ordenamiento?>"><img src=../imagenes/btn_xls.png alt="imprimir_peq"></a></th>
    <?php } ?>
<?php } ?>
</tr>
</table>


</div>
<?php } else { } ?>
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