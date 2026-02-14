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
<a class="btn btn-primary" href="#"><h6>Lista de Paciente Atendidos Por Empresa</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>

<?php
$fecha = date("Y/m/d");
$sql_cliente = "SELECT cod_factura, Sum(costo_motivo_consulta) AS costo_motivo_consulta, 
Min(fecha_ymd) AS fecha_ini, Max(fecha_ymd) AS fecha_fin, Count(cod_factura) AS conteo_factura, nombre_empresa, cod_estado_facturacion
FROM tbl15_historia_clinica WHERE cod_estado_facturacion = '1' GROUP BY cod_factura DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Factura</th>-->
<th style="text-align:left">Empresa</th>
<th style="text-align:center">Cantidad</th>
<th style="text-align:center">Total Costo</th>
<th style="text-align:center">Fecha Ini</th>
<th style="text-align:center">Fecha Fin</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Lista</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$nombre_empresa             = $info_cliente['nombre_empresa'];
$cod_factura                = $info_cliente['cod_factura'];
$costo_motivo_consulta      = $info_cliente['costo_motivo_consulta'];
$conteo_factura             = $info_cliente['conteo_factura'];
$fecha_ini                  = $info_cliente['fecha_ini'];
$fecha_fin                  = $info_cliente['fecha_fin'];
?>
<tr>
<!--<td style="text-align:center"><?php echo $cod_factura?></td>-->
<td style="text-align:left"><?php echo $nombre_empresa?></td>
<td style="text-align:center"><?php echo $conteo_factura?></td>
<td style="text-align:right"><?php echo number_format($costo_motivo_consulta, 0, ",", ".")?></td>
<td style="text-align:center"><?php echo $fecha_ini?></td>
<td style="text-align:center"><?php echo $fecha_fin?></td>
<td style="text-align:center"><a href="../admin/ver_facturacion_por_factura_version_pdf.php?fecha=<?php echo $fecha?>&cod_factura=<?php echo $cod_factura?>&nombre_empresa=<?php echo $nombre_empresa?>" target="_blank"><img src="../imagenes/ver_factura_peq.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><a href="../admin/ver_lista_por_factura_version_pdf.php?fecha=<?php echo $fecha?>&cod_factura=<?php echo $cod_factura?>&nombre_empresa=<?php echo $nombre_empresa?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
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