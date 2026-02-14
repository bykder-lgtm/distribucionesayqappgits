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
<a class="btn btn-primary" href="#"><h6>Lista inventarios cargados</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped">
    <tr>
        <th style="text-align:center">VER</th>
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
<?php
$pagina                               = $_SERVER['PHP_SELF'];

$sql_info_reg_actualizacion_tabla_sistema = "SELECT * FROM tbl15_info_reg_actualizacion_tabla_sistema ORDER BY cod_info_reg_actualizacion_tabla_sistema DESC";
$consulta_info_reg_actualizacion_tabla_sistema = mysqli_query($conectar, $sql_info_reg_actualizacion_tabla_sistema) or die(mysqli_error($conectar));
while ($datos_info_reg_actualizacion_tabla_sistema = mysqli_fetch_assoc($consulta_info_reg_actualizacion_tabla_sistema)) {

$cod_info_reg_actualizacion_tabla_sistema   = $datos_info_reg_actualizacion_tabla_sistema['cod_info_reg_actualizacion_tabla_sistema'];
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
    <tr>
        <td style="text-align:center"><a href="../admin/lista_reg_actualizacion_tabla_sistema_inventario_masivo_html.php?cod_info_reg_actualizacion_tabla_sistema=<?php echo $cod_info_reg_actualizacion_tabla_sistema?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
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
<?php } ?>
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