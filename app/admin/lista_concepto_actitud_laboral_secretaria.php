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
<div class="breadcrumbs"><a href="#"><h4>Concepto de Aptitud Laboral</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT tbl15_actitud_laboral.cod_actitud_laboral, tbl15_actitud_laboral.cod_historia_clinica, 
tbl15_actitud_laboral.cod_cliente, tbl15_actitud_laboral.cod_administrador, tbl15_actitud_laboral.motivo_actilab, 
tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_historia_clinica.motivo, tbl15_actitud_laboral.fecha_time, tbl15_cliente.url_img_foto_min, tbl15_cliente.url_img_firma_min
FROM tbl15_historia_clinica RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_actitud_laboral 
ON tbl15_administrador.cod_administrador = tbl15_actitud_laboral.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_actitud_laboral.cod_cliente) 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_actitud_laboral.cod_historia_clinica ORDER BY tbl15_actitud_laboral.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//HAVING (((tbl15_cliente.cedula) LIKE '') OR ((tbl15_cliente.nombres) LIKE '') OR ((tbl15_cliente.apellido1) LIKE '')) ORDER BY tbl15_actitud_laboral.fecha_time DESC";
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Cedula</th>
<th>Nombre Paciente</th>
<th>Motivo</th>
<th>Nombre Profesional</th>
<th>Fecha</th>
<th>Imp</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_actitud_laboral = $info_cliente['cod_actitud_laboral'];
$cod_historia_clinica = $info_cliente['cod_historia_clinica'];
$cod_cliente = $info_cliente['cod_cliente'];
$cod_administrador_hist = $info_cliente['cod_administrador'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$motivo = $info_cliente['motivo'];
$nombre_prof = $info_cliente['nombre_prof'];
$apellidos_prof = $info_cliente['apellidos_prof'];
$url_img_firma_min = $info_cliente['url_img_firma_min'];
$url_img_foto_min = $info_cliente['url_img_foto_min'];
$fecha_time = $info_cliente['fecha_time'];
$fecha_dmy = date("Y/m/d", $fecha_time);
$hora = date("H:i", $fecha_time);
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><?php echo $motivo?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td><?php echo $fecha_dmy?></td>
<td align="center"><a href="../admin/ver_concepto_actitud_laboral_version_pdf.php?cod_actitud_laboral=<?php echo $cod_actitud_laboral?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
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