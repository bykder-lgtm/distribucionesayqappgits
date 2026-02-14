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
<a class="btn btn-primary" href="../admin/lista_inventario_masivo_editable_ajax.php"><h6>Inventario Masivo Origen Produccion</h6></a>
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
$filtro_consulta_estado               = "";
$filtro_consulta_estado_and           = "";
$filtro_consulta_estado_rel           = "";

if (isset($_POST['buscar'])) {
$buscar                               = addslashes($_POST['buscar']);
$cod_origen_produccion                       = addslashes($_POST['cod_origen_produccion']);
}
?>
<form action="" method="post">
<table>
<td style="text-align:center"><input name="buscar" autofocus /></td>
<td style="text-align:left;">
    <select name="cod_origen_produccion" class="selectpicker" data-show-subtext="true" data-live-search="true">
        <?php if (isset($cod_origen_produccion)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo "<option value='' $seleccionado >TODOS</option>"; }
        $consulta2_sql = "SELECT cod_origen_produccion, nombre_origen_produccion FROM tbl15_origen_produccion ORDER BY cod_origen_produccion ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_origen_produccion) AND $cod_origen_produccion == $datos2['cod_origen_produccion']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_origen_produccion'];
        $nombre = $datos2['nombre_origen_produccion'];
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
$cod_origen_produccion                          = addslashes($_POST['cod_origen_produccion']);
} else {
$buscar                                  = '';
$cod_origen_produccion                          = '';
}

if ($cod_origen_produccion == '') {
$filtro_consulta_estado = "";
$filtro_consulta_estado_and = "";
$filtro_consulta_estado_rel = "";

$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$nombre_dependencia_get                             = 'TODOS';
} else {
$filtro_consulta_estado = "WHERE (cod_origen_produccion = '$cod_origen_produccion')";
$filtro_consulta_estado_and = "AND (cod_origen_produccion = '$cod_origen_produccion')";
$filtro_consulta_estado_rel = "WHERE (tbl15_producto.cod_origen_produccion = '$cod_origen_produccion')";

$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto $filtro_consulta_estado";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$sql_dependencia = "SELECT nombre_origen_produccion FROM tbl15_origen_produccion WHERE cod_origen_produccion = '$cod_origen_produccion'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia_get                             = $datos_dependencia['nombre_origen_produccion'];
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

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<th style="text-align:center">COD PRODUCTO</th>
<th style="text-align:center">NOMBRE PRODUCTO</th>
<th style="text-align:center">ORIGEN PRODUCCION</th>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<th style="text-align:center">T.UND</th>
<?php } ?>

<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<th style="text-align:center">T.UND BODEGA</th>
<?php } ?>

<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
<th style="text-align:center">P.COMPRA</th>
<?php } ?>

<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>
<?php } ?>

<?php if ($cod_estado_categoria_global == '1') { ?>
<th style="text-align:center">CATEGORIA</th>
<?php } ?>

<th style="text-align:center">DEPENDENCIA</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_compra_producto, precio_costo_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
nombre_estado, iva_ptj, nombre_tipo_producto, comision_ptj, fecha_vencimiento, fecha_vencimiento1, lote_vencimiento, 
vencimiento_lote1, nombre_tipo_precio_venta, und_producto_bodega, nombre_tipo_unidad_medida, fecha_mantenimiento, cajas_sobre, 
und_sobre, cod_opcion_descontable_inv, cod_categoria, cod_tipo_producto_cocina, nombre_promocion, nombre_promocion_ing, cod_origen_produccion
FROM tbl15_producto WHERE (cod_producto_barra = '$buscar' OR nombre_producto LIKE '%$buscar%') $filtro_consulta_estado_and ORDER BY nombre_producto DESC";
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
$nombre_estado                  = $info_info_factura['nombre_estado'];
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
$nombre_promocion               = $info_info_factura['nombre_promocion'];
$nombre_promocion_ing           = $info_info_factura['nombre_promocion_ing'];
$cod_origen_produccion          = $info_info_factura['cod_origen_produccion'];

?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra;?></td>

<td style="text-align:left">
<?php if ($nombre_tipo_componente == 'TEXTAREA') { ?>
<?php echo $nombre_producto;?>
<?php } else { ?><?php echo $nombre_producto;?><?php } ?>
</td>

<td style="text-align:center">
<select name="cod_origen_produccion" id="cod_origen_produccion-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($cod_origen_produccion)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_origen_produccion, nombre_origen_produccion FROM tbl15_origen_produccion ORDER BY cod_origen_produccion ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_origen_produccion) and $cod_origen_produccion == $datos2['cod_origen_produccion']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_origen_produccion'];
$nombre = $datos2['nombre_origen_produccion'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<td style="text-align:center"><?php echo $und_producto;?></td>
<?php } ?>

<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<td style="text-align:center"><?php echo $und_producto_bodega;?></td>
<?php } ?>

<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
<td style="text-align:center"><?php echo number_format($precio_compra_producto, 0, ",", ".");?></td>
<?php } ?>

<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center"><?php echo number_format($precio_ventas, 0, ",", "."); ?></td>
<?php } ?>
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

<td style="text-align:center">
<select name="cod_dependencia" id="cod_dependencia-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($cod_dependencia)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY cod_dependencia ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_dependencia) and $cod_dependencia == $datos2['cod_dependencia']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_dependencia'];
$nombre = $datos2['nombre_dependencia'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>
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

  $('select[name="nombre_estado"]').change(function(){ 
  var nombre_estado = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_estado, campo:"nombre_estado", id:id }, success:function(data){ $('#result').html(data); }  
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

 <script>  
 $(document).ready(function(){  

  $('select[name="cod_promocion"]').change(function(){ 
  var cod_promocion = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_promocion, campo:"cod_promocion", id:id }, success:function(data){ $('#result').html(data); }  
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