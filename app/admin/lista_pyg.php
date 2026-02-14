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
<a class="btn btn-primary" href="#"><h6>Lista de Pyg</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
include_once('../admin/class_php/fecha_en_espanol_mes.php');

$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
		<?php if ($cod_estado_contabilidad_pyg_registrar == '1') { ?>
        <th style="text-align:left"><a href="../admin/reg_pyg.php"><font size='+2'>Crear Nuevo Pyg</font></a></th>
		<?php } ?>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center"><strong>AÑO</th>
<th style="text-align:center"><strong>MES</strong></th>
<th style="text-align:center"><strong>TOTAL</strong></th>
<th style="text-align:center"><strong>FECHA REG</strong></th>
<?php if ($cod_estado_contabilidad_pyg_imprimir == '1') { ?>
<th style="text-align:center"><strong>IMP</strong></th>
<?php } ?>
<?php if ($cod_estado_contabilidad_pyg_editar == '1') { ?>
<th style="text-align:center"><strong>EDIT</strong></th>
<?php } ?>
<?php if ($cod_estado_contabilidad_pyg_eliminar == '1') { ?>
<th style="text-align:center"><strong>ELM</strong></th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT cod_pyg, fecha_mes, anyo, fecha_anyo, fecha_ymd, total_resultado_ejercicio FROM tbl15_pyg ORDER BY cod_pyg DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) { 

$cod_pyg                           = $datos['cod_pyg'];
$fecha_mes                         = $datos['fecha_mes'];
$anyo                              = $datos['anyo'];
$fecha_anyo                        = $datos['fecha_anyo'];
$total_resultado_ejercicio         = $datos['total_resultado_ejercicio'];
$fecha_ymd                         = $datos['fecha_ymd'];
$fecha_dmy                         = $fecha_mes.'-01';
$frag_fecha                        = explode('-', $fecha_dmy);
$fecha_ymd_seg                     = strtotime($fecha_dmy);
$fecha_mes_esp                     = fecha_en_espanol_mes($fecha_ymd_seg);
?>
<tr>
<td style="text-align:center"><a href="#"><?php echo $anyo; ?></a></td>
<td style="text-align:center"><a href="#"><?php echo strtoupper($fecha_mes_esp); ?></a></td>
<td style="text-align:right"><a href="#"><?php echo number_format($total_resultado_ejercicio, 0, ",", "."); ?></a></td>
<td style="text-align:center"><a href="#"><?php echo $fecha_anyo; ?></a></td>
<?php if ($cod_estado_contabilidad_pyg_imprimir == '1') { ?>
<td style="text-align:center"><a href="../admin/ver_pyg_pdf.php?cod_pyg=<?php echo $cod_pyg?>&fecha_mes=<?php echo $fecha_mes?>" target="_blank"><img src=../imagenes/imprimir_peq.png alt="imprimir"></a></td>
<?php } ?>
<?php if ($cod_estado_contabilidad_pyg_editar == '1') { ?>
<td style="text-align:center"><a href="../admin/edit_pyg.php?cod_pyg=<?php echo $cod_pyg?>&fecha_mes=<?php echo $fecha_mes?>"><img src=../imagenes/editar.png alt="actualizar"></a></td>
<?php } ?>
<?php if ($cod_estado_contabilidad_pyg_eliminar == '1') { ?>
<td style="text-align:center"><a href="../admin/eliminar_pyg.php?cod_pyg=<?php echo $cod_pyg?>&tipo=eliminar&pagina=<?php echo $pagina?>"><img src=../imagenes/eliminar_grand.png alt="Eliminar"></a></td>
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
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>