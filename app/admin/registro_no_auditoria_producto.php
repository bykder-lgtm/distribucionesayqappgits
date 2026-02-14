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
if (last != valor)
myajax.Link('guardar_auditoria_resultado_comentario_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_factura_auditoria_producto';
$campo                             = 'cod_factura_auditoria_producto';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

if (isset($_GET['cod_info_factura_auditoria'])) { $cod_info_factura_auditoria = intval($_GET['cod_info_factura_auditoria']); } else { $cod_info_factura_auditoria = 0; }
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$sql_incluidos = "SELECT cod_producto_barra, nombre_producto, und_producto FROM tbl15_factura_auditoria_producto WHERE(cod_info_factura_auditoria = '$cod_info_factura_auditoria')";
$consulta_incluidos = mysqli_query($conectar, $sql_incluidos);
$datos_incluidos = mysqli_fetch_assoc($consulta_incluidos);
$total_incluidos = mysqli_num_rows($consulta_incluidos);
$total_datos = mysqli_num_rows($consulta_incluidos);

$sql_productos_auditoria = "SELECT cod_producto_barra FROM tbl15_factura_auditoria_producto WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria')";
$consulta_productos_auditoria = mysqli_query($conectar, $sql_productos_auditoria);
while ($datos_productos_auditoria = mysqli_fetch_assoc($consulta_productos_auditoria)) { 
$cod_producto_barra_vector[]                   = $datos_productos_auditoria['cod_producto_barra'];
}

foreach ($cod_producto_barra_vector as $key => $cod_producto_barra) {
$contador = 0;
$sql_factura_auditoria_producto = "SELECT cod_producto_barra, nombre_producto, und_producto FROM tbl15_producto WHERE(cod_producto_barra <> '$cod_producto_barra') AND (und_producto <> '0.00')";
$consulta_factura_auditoria_producto = mysqli_query($conectar, $sql_factura_auditoria_producto);
$datos_factura_auditoria_producto = mysqli_fetch_assoc($consulta_factura_auditoria_producto);
$total_no_incluidos = mysqli_num_rows($consulta_factura_auditoria_producto);

$sql_factura_auditoria_producto_cero = "SELECT cod_producto_barra, nombre_producto, und_producto FROM tbl15_producto WHERE(cod_producto_barra <> '$cod_producto_barra') AND (und_producto = '0.00')";
$consulta_factura_auditoria_producto_cero = mysqli_query($conectar, $sql_factura_auditoria_producto_cero);
$datos_factura_auditoria_producto_cero = mysqli_fetch_assoc($consulta_factura_auditoria_producto_cero);
$total_cero = mysqli_num_rows($consulta_factura_auditoria_producto_cero);
}
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_auditoria.php">LISTA DE AUDITORIAS</a></strong></td>
    </tr></tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_auditoria_final_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_auditoria.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<?php

?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">CODIGO AUDITORIA</th>
<th style="text-align:center;">TOTAL NO INCLUIDOS EN AUDITORIA <> 0</th>
<th style="text-align:center;">TOTAL NO INCLUIDOS EN AUDITORIA EN CERO</th>
<th style="text-align:center;">TOTAL INCLUIDOS EN AUDITORIA</th>
<th style="text-align:center;">TOTAL</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:center;"></td>
<td style="text-align:center;"><?php echo $cod_info_factura_auditoria ?></td>
<td style="text-align:center;"><?php echo number_format($total_no_incluidos, 0, ",", "."); ?></td>
<td style="text-align:center;"><?php echo number_format($total_cero, 0, ",", "."); ?></td>
<td style="text-align:center;"><?php echo number_format($total_incluidos, 0, ",", "."); ?></td>
<td style="text-align:center;"><?php echo number_format($total_no_incluidos + $total_cero, 0, ",", "."); ?></td>
<td style="text-align:center;"></td>
</tr>
</tbody>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">#</th>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<?php if ($cod_seguridad == '1') { ?><th style="text-align:center;">UND</th><?php } ?>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
do { 

$cod_producto_barra                            = $datos_factura_auditoria_producto['cod_producto_barra'];
$nombre_producto                               = $datos_factura_auditoria_producto['nombre_producto'];
$und_producto                                  = $datos_factura_auditoria_producto['und_producto'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }

$contador++;
?>
<tr>
<td style="text-align:center;"></td>
<td style="text-align:center;"><?php echo $contador ?></td>
<td style="text-align:left;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<?php if ($cod_seguridad == '1') { ?><td style="text-align:center;"><?php echo $und_producto ?></td><?php } ?>
<td style="text-align:center;"></td>
</tr>
<?php } while ($datos_factura_auditoria_producto = mysqli_fetch_assoc($consulta_factura_auditoria_producto)); ?>
</tbody>
</table>
<?php } ?>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
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