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
<a class="btn btn-primary" href="../admin/lista_actualizacion_tabla_sistema_inventario_masivo.php"><h6>Resultado del Cargue</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_info_reg_actualizacion_tabla_sistema'])) { $cod_info_reg_actualizacion_tabla_sistema = intval($_GET['cod_info_reg_actualizacion_tabla_sistema']); } else { $cod_info_reg_actualizacion_tabla_sistema = '0'; }

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


$sql_info_reg_actualizacion_tabla_sistema = "SELECT * FROM tbl15_info_reg_actualizacion_tabla_sistema WHERE cod_info_reg_actualizacion_tabla_sistema = '$cod_info_reg_actualizacion_tabla_sistema'";
$consulta_info_reg_actualizacion_tabla_sistema = mysqli_query($conectar, $sql_info_reg_actualizacion_tabla_sistema) or die(mysqli_error($conectar));
$datos_info_reg_actualizacion_tabla_sistema = mysqli_fetch_assoc($consulta_info_reg_actualizacion_tabla_sistema);

$nombre_tipo_actualizacion_tabla_sistema    = $datos_info_reg_actualizacion_tabla_sistema['nombre_tipo_actualizacion_tabla_sistema'];
$total_reg_insertado                        = $datos_info_reg_actualizacion_tabla_sistema['total_reg_insertado'];
$total_reg_actualizado                      = $datos_info_reg_actualizacion_tabla_sistema['total_reg_actualizado'];
$cod_estado_und_producto                    = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_und_producto'];
$cod_estado_nombre_producto                 = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_nombre_producto'];
$cod_estado_precio_compra_producto          = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_precio_compra_producto'];
$cod_estado_precio_venta_producto           = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_precio_venta_producto'];
$cod_estado_precio_venta_producto2          = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_precio_venta_producto2'];
$cod_estado_precio_venta_producto3          = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_precio_venta_producto3'];
$cod_estado_precio_venta_producto4          = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_precio_venta_producto4'];
$cod_estado_precio_venta_producto5          = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_precio_venta_producto5'];
$cod_estado_iva_ptj                         = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_iva_ptj'];
$cod_estado_comision_ptj                    = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_comision_ptj'];
$cod_estado_cod_dependencia                 = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_cod_dependencia'];
$cod_estado_cajas_sobre                     = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_cajas_sobre'];
$cod_estado_und_sobre                       = $datos_info_reg_actualizacion_tabla_sistema['cod_estado_und_sobre'];
$cod_administrador                          = $datos_info_reg_actualizacion_tabla_sistema['cod_administrador'];
$cuenta                                     = $datos_info_reg_actualizacion_tabla_sistema['cuenta'];
$fecha_reg                                  = $datos_info_reg_actualizacion_tabla_sistema['fecha_reg'];
$hora_reg                                   = $datos_info_reg_actualizacion_tabla_sistema['hora_reg'];

if ($cod_estado_und_producto == '1') { $cod_estado_und_producto = 'SI'; } else { $cod_estado_und_producto = 'NO'; }
if ($cod_estado_nombre_producto == '1') { $cod_estado_nombre_producto = 'SI'; } else { $cod_estado_nombre_producto = 'NO'; }
if ($cod_estado_precio_compra_producto == '1') { $cod_estado_precio_compra_producto = 'SI'; } else { $cod_estado_precio_compra_producto = 'NO'; }
if ($cod_estado_precio_venta_producto == '1') { $cod_estado_precio_venta_producto = 'SI'; } else { $cod_estado_precio_venta_producto = 'NO'; }
if ($cod_estado_precio_venta_producto2 == '1') { $cod_estado_precio_venta_producto2 = 'SI'; } else { $cod_estado_precio_venta_producto2 = 'NO'; }
if ($cod_estado_precio_venta_producto3 == '1') { $cod_estado_precio_venta_producto3 = 'SI'; } else { $cod_estado_precio_venta_producto3 = 'NO'; }
if ($cod_estado_precio_venta_producto4 == '1') { $cod_estado_precio_venta_producto4 = 'SI'; } else { $cod_estado_precio_venta_producto4 = 'NO'; }
if ($cod_estado_precio_venta_producto5 == '1') { $cod_estado_precio_venta_producto5 = 'SI'; } else { $cod_estado_precio_venta_producto5 = 'NO'; }
if ($cod_estado_iva_ptj == '1') { $cod_estado_iva_ptj = 'SI'; } else { $cod_estado_iva_ptj = 'NO'; }
if ($cod_estado_comision_ptj == '1') { $cod_estado_comision_ptj = 'SI'; } else { $cod_estado_comision_ptj = 'NO'; }
if ($cod_estado_cod_dependencia == '1') { $cod_estado_cod_dependencia = 'SI'; } else { $cod_estado_cod_dependencia = 'NO'; }
if ($cod_estado_cajas_sobre == '1') { $cod_estado_cajas_sobre = 'SI'; } else { $cod_estado_cajas_sobre = 'NO'; }
if ($cod_estado_und_sobre == '1') { $cod_estado_und_sobre = 'SI'; } else { $cod_estado_und_sobre = 'NO'; }
?>
<table class="table table-striped">
    <tr>
        <th style="text-align:center">ID</th>
        <th style="text-align:center">TIPO</th>
        <th style="text-align:center">UND INVENTARIO</th>
        <th style="text-align:center">NOMBRE PRODUCTO</th>
        <th style="text-align:center">PRECIO COMPRA</th>
        <th style="text-align:center">PRECIO VENTA 1</th>
        <th style="text-align:center">PRECIO VENTA 2</th>
        <th style="text-align:center">PRECIO VENTA 3</th>
        <th style="text-align:center">PRECIO VENTA 4</th>
        <th style="text-align:center">PRECIO VENTA 5</th>
        <th style="text-align:center">% IVA</th>
        <th style="text-align:center">% COMISION VENTA</th>
        <th style="text-align:center">DEPENDENCIA</th>
        <th style="text-align:center">PRESENTACION CAJA</th>
        <th style="text-align:center">PRESENTACION SOBRE</th>
        <th style="text-align:center">REG ACTUALIZADO</th>
        <th style="text-align:center">REG INSERTADO</th>
        <th style="text-align:center">FECHA | HORA</th>
    </tr>
    <tr>
        <th style="text-align:center"><?php echo $cod_info_reg_actualizacion_tabla_sistema ?></th>
        <th style="text-align:center"><?php echo $nombre_tipo_actualizacion_tabla_sistema ?></th>
        <th style="text-align:center"><?php echo $cod_estado_und_producto ?></th>
        <th style="text-align:center"><?php echo $cod_estado_nombre_producto ?></th>
        <th style="text-align:center"><?php echo $cod_estado_precio_compra_producto ?></th>
        <th style="text-align:center"><?php echo $cod_estado_precio_venta_producto ?></th>
        <th style="text-align:center"><?php echo $cod_estado_precio_venta_producto2 ?></th>
        <th style="text-align:center"><?php echo $cod_estado_precio_venta_producto3 ?></th>
        <th style="text-align:center"><?php echo $cod_estado_precio_venta_producto4 ?></th>
        <th style="text-align:center"><?php echo $cod_estado_precio_venta_producto5 ?></th>
        <th style="text-align:center"><?php echo $cod_estado_iva_ptj ?></th>
        <th style="text-align:center"><?php echo $cod_estado_comision_ptj ?></th>
        <th style="text-align:center"><?php echo $cod_estado_cod_dependencia ?></th>
        <th style="text-align:center"><?php echo $cod_estado_cajas_sobre ?></th>
        <th style="text-align:center"><?php echo $cod_estado_und_sobre ?></th>
        <th style="text-align:center"><?php echo $total_reg_actualizado ?></th>
        <th style="text-align:center"><?php echo $total_reg_insertado ?></th>
        <th style="text-align:center"><?php echo $fecha_reg.' | '.$hora_reg ?></th>
    </tr>
</table>

<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Y-m-d");
$hora_venta_his                          = date("H:i:s");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
?>
<br>
<div class="table-responsive">

<div id="eliminar-ok" style="display:none;">&nbsp;</div>

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

<th style="text-align:center">ACCION</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_compra_producto, precio_costo_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
cod_dependencia, iva_ptj, nombre_tipo_producto, comision_ptj, fecha_vencimiento, fecha_vencimiento1, lote_vencimiento, 
vencimiento_lote1, nombre_tipo_precio_venta, und_producto_bodega, nombre_tipo_unidad_medida, fecha_mantenimiento, cajas_sobre, 
und_sobre, cod_opcion_descontable_inv, cod_categoria, cod_tipo_producto_cocina, peso_producto, unidad_medida_peso, cod_estado_peso, 
cod_dependencia_sub, cod_factura, meses_mantenimiento, meses_garantia, cod_producto_serial, cod_marca, nombre_tipo_actualizacion_tabla_sistema
FROM tbl15_reg_actualizacion_tabla_sistema WHERE (cod_info_reg_actualizacion_tabla_sistema = '$cod_info_reg_actualizacion_tabla_sistema') $filtro_consulta_dependencia_and ORDER BY $campo_ordenamiento $tipo_ordenamiento";
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
$nombre_tipo_actualizacion_tabla_sistema                      = $info_info_factura['nombre_tipo_actualizacion_tabla_sistema'];
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

<td style="text-align:center"><?php echo $nombre_tipo_actualizacion_tabla_sistema;?></td>

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