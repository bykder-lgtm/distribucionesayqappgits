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
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }


if (isset($_GET['cod_barra_nombre_producto'])) { 
    $cod_barra_nombre_producto = addslashes($_GET['cod_barra_nombre_producto']); 
    if ($cod_barra_nombre_producto <> '') { 

        if ($buscar_por == 'nombre_producto') {
        $mostrar_datos_sql = "AND (nombre_producto LIKE '$cod_barra_nombre_producto%')";
        } elseif ($buscar_por == 'cod_producto_barra') {
        $mostrar_datos_sql = "AND (cod_producto_barra LIKE '$cod_barra_nombre_producto')";
        } elseif ($buscar_por == 'cod_producto_barra_nombre_producto') {
        $mostrar_datos_sql = "AND (nombre_producto LIKE '$cod_barra_nombre_producto%') OR (cod_producto_barra LIKE '$cod_barra_nombre_producto')";
        } else {
        $mostrar_datos_sql = "AND (nombre_producto LIKE '%$cod_barra_nombre_producto%') OR (cod_producto_barra LIKE '$cod_barra_nombre_producto')";
        }

        $filtro_cod_barra_nombre_producto = $mostrar_datos_sql; 
    } else { 
        $filtro_cod_barra_nombre_producto = "";  
    }
} else { 
    $cod_barra_nombre_producto = ''; 
    $filtro_cod_barra_nombre_producto = ""; 
}


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
    <th style="text-align:center;">CODIGO O NOMBRE</th>
    <?php if ($cod_estado_dependencia_global == '1') { ?><th style="text-align:center;">DEPENDENCIA</th><?php } ?> 
    <th style="text-align:center;">TIPO PRODUCTO</th>
    <th style="text-align:center;">TIPO PRECIO</th>
    <th style="text-align:center;">UNIDAD DE MEDIDA</th>
  </tr>
  <tr>
    <td style="text-align:center;">
        <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
            <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_buscar_por'];
            $nombre = $datos2['titulo_buscar_por'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <input class="input-block-level" name="cod_barra_nombre_producto" id="cod_barra_nombre_producto" type="text" value="" style="width: 200px;" />
    </td>

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
  </tr>
  </table>

  <table class="table table-striped" cellspacing="0" cellpadding="0">
  <tr>
    <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?><th style="text-align:center;">ESTADO PRODUCTO</th><?php } ?> 
    <?php if ($cod_estado_categoria_global == '1') { ?><th style="text-align:center;">CATEGORIA</th><?php } ?> 
    <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center;">TIPO COMPRA</th><?php } ?>  
    <?php if ($cod_estado_promocion_global == '1') { ?><th style="text-align:center;">PROMOCION</th><?php } ?> 
    <?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?><th style="text-align:center;">DESCONTABLE INV</th><?php } ?> 
  </tr>
  <tr>
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
<div class="actions">
<input type="submit" value="Buscar Productos" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
<?php
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto WHERE (cod_producto >= '0')
$filtro_cod_barra_nombre_producto $filtro_dependencia $filtro_tipo_producto $filtro_tipo_precio_venta $filtro_tipo_unidad_medida $filtro_nombre_estado $filtro_categoria
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

<?php if (isset($_GET['cod_barra_nombre_producto'])) { ?>
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=cod_producto_barra&tipo_ordenamiento=DESC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_arriba.gif"></a>Cod Baras Producto<a href="<?php echo $pagina ?>?campo_ordenamiento=cod_producto_barra&tipo_ordenamiento=ASC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_abajo.gif"></a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=nombre_producto&tipo_ordenamiento=DESC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_arriba.gif"></a>Nombre Producto<a href="<?php echo $pagina ?>?campo_ordenamiento=nombre_producto&tipo_ordenamiento=ASC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_abajo.gif"></a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=und_producto&tipo_ordenamiento=DESC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_arriba.gif"></a>Unidades Inv<a href="<?php echo $pagina ?>?campo_ordenamiento=und_producto&tipo_ordenamiento=ASC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_abajo.gif"></a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=precio_compra_producto&tipo_ordenamiento=DESC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_arriba.gif"></a>P.Compra<a href="<?php echo $pagina ?>?campo_ordenamiento=precio_compra_producto&tipo_ordenamiento=ASC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_abajo.gif"></a></th>
        <th style="text-align:center"><a href="<?php echo $pagina ?>?campo_ordenamiento=precio_venta_producto&tipo_ordenamiento=DESC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_arriba.gif"></a>P.Venta<a href="<?php echo $pagina ?>?campo_ordenamiento=precio_venta_producto&tipo_ordenamiento=ASC&cod_barra_nombre_producto=<?php echo $cod_barra_nombre_producto?>&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>"><img src="../imagenes/flecha_abajo.gif"></a></th>
    </tr>
</table>
<br>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>


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
        <th style="text-align:center"><a href="../admin/descargar_inventario_spout_xlsx.php?cod_administrador=<?php echo $cod_administrador?>&cod_barra_nombre_producto=&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>&campo_ordenamiento=<?php echo $campo_ordenamiento?>&tipo_ordenamiento=<?php echo $tipo_ordenamiento?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></th>
    <?php } else { ?>
        <th style="text-align:center"><a href="../admin/descargar_inventario_xlsx.php?cod_administrador=<?php echo $cod_administrador?>&cod_barra_nombre_producto=&cod_dependencia=<?php echo $cod_dependencia?>&nombre_tipo_producto=<?php echo $nombre_tipo_producto?>&nombre_tipo_precio_venta=<?php echo $nombre_tipo_precio_venta?>&nombre_tipo_unidad_medida=<?php echo $nombre_tipo_unidad_medida?>&nombre_estado=<?php echo $nombre_estado?>&cod_categoria=<?php echo $cod_categoria?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>&cod_tipo_producto_cocina=<?php echo $cod_tipo_producto_cocina?>&nombre_promocion=<?php echo $nombre_promocion?>&cod_opcion_descontable_inv=<?php echo $cod_opcion_descontable_inv?>&campo_ordenamiento=<?php echo $campo_ordenamiento?>&tipo_ordenamiento=<?php echo $tipo_ordenamiento?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></th>
    <?php } ?>
<?php } ?>
</tr>
</table>


<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<th style="text-align:center">COD PRODUCTO</th>

<?php if ($cod_estado_cod_barra2_global == '1') { ?>
<th style="text-align:center">CODIGO BARRA 2</th>
<?php } ?>

<th style="text-align:center">NOMBRE PRODUCTO</th>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<th style="text-align:center">T.UND</th>
<?php } ?>

<?php if ($cod_estado_caja_fraccion_global == '1') { ?>
<th style="text-align:center">CAJ|FRAC</th>
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
<th style="text-align:center;">CAJA (PRESENTACION)</th>
<?php } ?>

<?php if ($cod_estado_und_sobre_global  == '1') { ?>
<th style="text-align:center;">SOBRE</th>
<?php } ?>

<th style="text-align:center">IVA</th>

<?php if ($cod_estado_iva_saludable_ptj_global == '1') { ?>
<th style="text-align:center">IVA SALUDABLE</th>
<?php } ?>

<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<th style="text-align:center">COMISION</th>
<?php } ?>

<?php if ($cod_estado_prod_tope_min == '1') { ?>
<th style="text-align:center">STOCK</th>
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

<?php if ($cod_estado_peso_global == '1') { ?>
<th style="text-align:center">PESAR?</th>
<?php } ?>

<?php if ($cod_estado_origen_produccion_global == '1') { ?>
<th style="text-align:center">ORIGEN</th>
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
$sql_info_factura = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_costo_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
cod_dependencia, iva_ptj, nombre_tipo_producto, comision_ptj, fecha_vencimiento, fecha_vencimiento1, lote_vencimiento, 
vencimiento_lote1, nombre_tipo_precio_venta, und_producto_bodega, nombre_tipo_unidad_medida, fecha_mantenimiento, cajas_sobre, 
und_sobre, cod_opcion_descontable_inv, cod_categoria, cod_tipo_producto_cocina, peso_producto, unidad_medida_peso, cod_estado_peso, 
cod_dependencia_sub, cod_factura, meses_mantenimiento, meses_garantia, cod_producto_serial, cod_marca, iva_saludable_ptj, tope_min, cod_origen_produccion
FROM tbl15_producto WHERE (cod_producto >= '0') 
$filtro_cod_barra_nombre_producto $filtro_dependencia $filtro_tipo_producto $filtro_tipo_precio_venta $filtro_tipo_unidad_medida $filtro_nombre_estado $filtro_categoria
$filtro_tipo_compra $filtro_tipo_producto_cocina $filtro_promocion $filtro_opcion_descontable_inv
ORDER BY $campo_ordenamiento $tipo_ordenamiento";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_producto                   = $info_info_factura['cod_producto'];
$cod_producto_barra             = $info_info_factura['cod_producto_barra'];
$cod_producto_barra2            = $info_info_factura['cod_producto_barra2'];
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
$iva_saludable_ptj              = $info_info_factura['iva_saludable_ptj'];
$tope_min                       = $info_info_factura['tope_min'];
$cod_origen_produccion          = $info_info_factura['cod_origen_produccion'];



if ($cajas_sobre > '1') {
    $total_cajas                    = intval($und_producto / $cajas_sobre);
    $total_fraccion                 = $und_producto - ($total_cajas * $cajas_sobre);
    $total_caja_fraccion            = $total_cajas.'|'.$total_fraccion;
} else {
    $total_cajas                    = '';
    $total_fraccion                 = '';
    $total_caja_fraccion            = '';
}
?>
<tr>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_producto_barra', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_producto_barra;?>" class="input-block-level" style="width: 130px;"></td>

<?php if ($cod_estado_cod_barra2_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_producto_barra2', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_producto_barra2;?>" class="input-block-level" style="width: 130px;"></td>
<?php } ?>

<td style="text-align:center">
<?php if ($nombre_tipo_componente == 'TEXTAREA') { ?>
<textarea onFocus="Focus(this.id, this.value)" name="nombre_producto" onBlur="Blur(this.id, this.value, 'nombre_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" class="input-block-level" rows="9" cols="50"><?php echo $nombre_producto;?></textarea>
<?php } else { ?><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'nombre_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $nombre_producto;?>" class="input-block-level" style="width: 500px;"><?php } ?>
</td>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'und_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $und_producto;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_caja_fraccion_global == '1') { ?>
<td style="text-align:center"><?php echo $total_caja_fraccion;?></td>
<?php } ?>

<?php if ($cod_estado_prod_und_producto_bodega == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'und_producto_bodega', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $und_producto_bodega;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_marca_global == '1') { ?>
<td style="text-align:center">
<select name="cod_marca" id="cod_marca-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($cod_marca)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_marca, nombre_marca FROM tbl15_marca ORDER BY cod_marca ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_marca) and $cod_marca == $datos2['cod_marca']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_marca'];
$nombre = $datos2['nombre_marca'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>
<?php } ?>


<td align="center">
<select name="nombre_tipo_unidad_medida" id="nombre_tipo_unidad_medida-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 70px;">
<?php if (isset($nombre_tipo_unidad_medida)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT nombre_tipo_unidad_medida FROM tbl15_tipo_unidad_medida WHERE (cod_estado = '1') ORDER BY cod_tipo_unidad_medida ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_unidad_medida) and $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_unidad_medida'];
$nombre = $datos2['nombre_tipo_unidad_medida'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'precio_compra_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $precio_compra_producto;?>" class="input-block-level" style="width: 100px;"></td>
<?php } ?>

<td align="center">
<select name="nombre_tipo_precio_venta" id="nombre_tipo_precio_venta-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 70px;">
<?php if (isset($nombre_tipo_precio_venta)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta ORDER BY nombre_tipo_precio_venta ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_precio_venta) and $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_precio_venta'];
$nombre = $datos2['nombre_tipo_precio_venta'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'precio_venta_producto<?php echo $contador; ?>', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo "$precio_ventas"; ?>" class="input-block-level" style="width: 100px;"></td>
<?php } ?>
<?php } ?>

<?php if ($cod_estado_cajas_sobre_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cajas_sobre', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cajas_sobre;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_und_sobre_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'und_sobre', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $und_sobre;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'iva_ptj', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $iva_ptj;?>" class="input-block-level" style="width: 60px;"></td>

<?php if ($cod_estado_iva_saludable_ptj_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'iva_saludable_ptj', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $iva_saludable_ptj;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'comision_ptj', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $comision_ptj;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_prod_tope_min == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'tope_min', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $tope_min;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center"><input type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_vencimiento1', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $fecha_vencimiento1;?>" class="input-block-level" size="10"></td>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'vencimiento_lote1', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $vencimiento_lote1;?>" class="input-block-level" size="30"></td>
<?php } ?>

<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<td style="text-align:center"><input type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_mantenimiento', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $fecha_mantenimiento;?>" class="input-block-level" style="width: 140px;"></td>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'meses_mantenimiento', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $meses_mantenimiento;?>" class="input-block-level" size="30"></td>
<?php } ?>

<?php if ($cod_estado_meses_garantia_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'meses_garantia', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $meses_garantia;?>" class="input-block-level" size="30"></td>
<?php } ?>


<?php if ($cod_estado_factura_compra_producto_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_factura', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_factura;?>" class="input-block-level" size="30"></td>
<?php } ?>

<?php if ($cod_estado_producto_serial_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_producto_serial', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_producto_serial;?>" class="input-block-level" size="30"></td>
<?php } ?>

<td style="text-align:center">
<select name="nombre_tipo_producto" id="nombre_tipo_producto-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($nombre_tipo_producto)) { echo "<option value='' >Selecione</option>";
} else { echo "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY nombre_tipo_producto ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_producto'];
$nombre = $datos2['nombre_tipo_producto'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_peso_producto_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'peso_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $peso_producto;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>


<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_opcion_descontable_inv" id="cod_opcion_descontable_inv-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 50px;">
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
    </td>
<?php } ?>

<?php if ($cod_estado_categoria_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_categoria" id="cod_categoria-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
    <?php if (isset($cod_categoria)) { echo "<option value='' >Selecione</option>";
    } else { echo  "<option value='' selected >Selecione</option>"; }
    $sql_consulta2 = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria ORDER BY cod_categoria ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_categoria'];
    $nombre = $datos2['nombre_categoria'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<?php if ($cod_estado_peso_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_estado_peso" id="cod_estado_peso-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 50px;">
    <?php if (isset($cod_estado_peso)) { echo ""; } else { echo ""; }
    $sql_consulta2 = "SELECT cod_estado_peso, nombre_estado_peso FROM tbl15_estado_peso ORDER BY cod_estado_peso ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_estado_peso) and $cod_estado_peso == $datos2['cod_estado_peso']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_estado_peso'];
    $nombre = $datos2['nombre_estado_peso'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<?php if ($cod_estado_origen_produccion_global == '1') { ?>
<td style="text-align:center">
    <select name="cod_origen_produccion" id="cod_origen_produccion-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 140px;" required>
        <?php if (isset($cod_origen_produccion)) { echo "<option value='' >Selecione</option>"; } else { echo  "<option value='' selected >Selecione</option>"; }
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
    <select name="cod_tipo_producto_cocina" id="cod_tipo_producto_cocina-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 50px;">
    <?php if (isset($cod_tipo_producto_cocina)) { echo "<option value='' >Selecione</option>";
    } else { echo  "<option value='' selected >Selecione</option>"; }
    $sql_consulta2 = "SELECT cod_tipo_producto_cocina, nombre_tipo_producto_cocina FROM tbl15_tipo_producto_cocina ORDER BY cod_tipo_producto_cocina ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_tipo_producto_cocina) and $cod_tipo_producto_cocina == $datos2['cod_tipo_producto_cocina']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tipo_producto_cocina'];
    $nombre = $datos2['nombre_tipo_producto_cocina'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<td style="text-align:center">
<select name="cod_dependencia" id="cod_dependencia-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($cod_dependencia)) { echo "<option value='' >Selecione</option>";
} else { echo "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_dependencia) and $cod_dependencia == $datos2['cod_dependencia']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_dependencia'];
$nombre = $datos2['nombre_dependencia'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
    <th style="text-align:center">
    <select name="cod_dependencia_sub" id="cod_dependencia_sub-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
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

</tr>
<?php } ?>
</tbody>
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

  $('select[name="cod_estado_peso"]').change(function(){ 
  var cod_estado_peso = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_estado_peso, campo:"cod_estado_peso", id:id }, success:function(data){ $('#result').html(data); }  
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

 <script>  
 $(document).ready(function(){  

  $('textarea[name="nombre_producto"]').change(function(){ 
  var nombre_producto = $(this).val();  
  //let id = this.id;
  var id = $(this).attr("class");
  console.log("id = "+id);
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_producto, campo:"nombre_producto", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_origen_produccion"]').change(function(){ 
  var cod_origen_produccion = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_origen_produccion, campo:"cod_origen_produccion", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>
 
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</body>
</html>

<script type="text/javascript">
    document.getElementById("cod_barra_nombre_producto").select();
</script>
