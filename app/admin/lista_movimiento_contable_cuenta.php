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
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Lista de Movimientos Contables</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
include_once('../admin/class_php/fecha_en_espanol_mes.php');

$pagina                         = $_SERVER['PHP_SELF'];
$tab                            = 'tbl15_informe_condiciones_salud';
$tipo                           = 'eliminar';
$campo                          = 'cod_informe_condiciones_salud';
$fecha                          = date("Y/m/d");
$origen                         = 'PARACLINICOS';

$tab1                           = 'movimiento_contable_concepto';
$campo1                         = 'cod_movimiento_contable_concepto';
$tipo1                          = 'eliminar';
$tab2                           = 'movimiento_contable_codigo';
$campo2                         = 'cod_movimiento_contable_codigo';
$tipo2                          = 'eliminar';

$nombre_tab_mad1                = 'movimiento_contable';
$nombre_tab_mad2                = 'movimiento_contable';

$nombre_campo_key1              = 'cod_movimiento_contable';
$nombre_campo_key2              = 'cod_movimiento_contable';

$nombre_campo_calc1             = 'costo_movimiento_contable_concepto';
$nombre_campo_calc2             = 'costo_movimiento_contable_concepto';

$nombre_campo_update1           = 'nombres_clientes';
$nombre_campo_update2           = 'nombres_clientes';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/reg_movimiento_contable_temporal_cuenta.php"><font size='+2'>Crear Nuevo Movimiento Contable</font></a></th>
        <!--<th style="text-align:left"><a href="../admin/reporte_movimientos_contables_fechas.php"><font size='+2'>Reporte Movimiento Contable</font></a></th>-->
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<td style="text-align:center"><strong>NO</strong></td>
<td style="text-align:center"><strong>TIPO DOCUMENTO</strong></td>
<td style="text-align:center"><strong>NIT TERCERO</strong></td>
<td style="text-align:center"><strong>NOMBRE TERCERO</strong></td>
<td style="text-align:center"><strong>VALOR MOVIMIENTO</strong></td>
<td style="text-align:center"><strong>DESCRIPCION DEL MOVIMIENTO</strong></td>
<td style="text-align:center"><strong>FECHA</strong></td>
<td style="text-align:center"><strong>IMP</strong></td>
<td style="text-align:center"><strong>EDIT</strong></td>
<td style="text-align:center"><strong>ELM</strong></td>
<td style="text-align:center"><strong>COD</strong></td>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = 'CERRADA') ORDER BY cod_movimiento_contable DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) { 

$cod_movimiento_contable            = $datos['cod_movimiento_contable'];
$cod_factura                        = $datos['cod_factura'];
$doc_modifica                       = $datos['doc_modifica'];
$nombre_tipo_documento              = $datos['nombre_tipo_documento'];
$descripcion_movimiento             = $datos['descripcion_movimiento'];
$total_costo_movimiento_contable    = $datos['total_costo_movimiento_contable'];
$total_venta_movimiento_contable    = $datos['total_venta_movimiento_contable'];
$cod_clientes                       = $datos['cod_clientes'];
$nombres_clientes                   = $datos['nombres_clientes'];
$nit_cliente                        = $datos['nit_cliente'];
$digito                             = $datos['digito'];
$estado_devol                       = $datos['estado_devol'];
$motivo_devol                       = $datos['motivo_devol'];
$direccion                          = $datos['direccion'];
$no_cuenta                          = $datos['no_cuenta'];
$elaborada                          = $datos['elaborada'];
$revisada                           = $datos['revisada'];
$autorizada                         = $datos['autorizada'];
$contabilizada                      = $datos['contabilizada'];
$motivo_modificacion                = $datos['motivo_modificacion'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_ymd                          = $datos['fecha_ymd'];
$fecha_mes                          = $datos['fecha_mes'];
$anyo                               = $datos['anyo'];
$fecha_factura                      = $datos['fecha_factura'];
$ip                                 = $datos['ip'];
$cuenta                             = $datos['cuenta'];
$cod_guia                           = $datos['cod_guia'];
?>
<tr>
<td style="text-align:center"><?php echo $cod_guia; ?></td>
<td style="text-align:left"><?php echo $nombre_tipo_documento; ?></td>
<td style="text-align:right"><?php echo $nit_cliente; ?></td>
<td style="text-align:left"><?php echo $nombres_clientes; ?></td>
<td style="text-align:right"><?php echo number_format($total_costo_movimiento_contable, 0, ",", "."); ?></td>
<td style="text-align:left"><?php echo $descripcion_movimiento; ?></td>
<td style="text-align:center"><?php echo $fecha_ymd; ?></td>
<td style="text-align:center"><a href="../admin/ver_movimiento_contable_cuenta_pdf.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>" target="_blank"><img src=../imagenes/imprimir_peq.png alt="imprimir"></a></td>
<td style="text-align:center"><a href="../admin/edit_movimiento_contable_cuenta.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>"><img src=../imagenes/editar.png alt="actualizar"></a></td>
<td style="text-align:center"><a href="../admin/eliminar_movimiento_contable.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>&pagina=<?php echo $pagina?>"><img src=../imagenes/eliminar.png alt=""></a></td>
<td style="text-align:center"><?php echo $cod_movimiento_contable; ?></td>
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
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>