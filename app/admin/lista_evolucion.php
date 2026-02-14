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
<?php
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);

$sql_historia_clinica = "SELECT cod_cliente FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$cod_cliente = $datos_historia_clinica['cod_cliente'];
$pagina = '';
?>
<div class="breadcrumbs">
<a href="../admin/reg_evolucion.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>&pagina=<?php echo $pagina ?>"><h4>Evoluciones</h4></a>
</div>
<!--<hr>-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_historia_clinica'])) {
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$pagina = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.motivo, tbl15_evolucion.cod_evolucion, tbl15_evolucion.nombre_evolucion, tbl15_evolucion.fecha_mes, tbl15_evolucion.fecha_anyo, tbl15_evolucion.fecha_ymd,
tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellido_prof, tbl15_evolucion.fecha_time, tbl15_historia_clinica.cod_historia_clinica
FROM (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_evolucion ON tbl15_cliente.cod_cliente = tbl15_evolucion.cod_cliente) ON 
tbl15_historia_clinica.cod_historia_clinica = tbl15_evolucion.cod_historia_clinica
WHERE (tbl15_historia_clinica.cod_historia_clinica=$cod_historia_clinica)";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
/*
$sql_cliente = "SELECT tbl15_evolucion.cod_evolucion, tbl15_evolucion.cod_historia_clinica, tbl15_evolucion.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_evolucion.nombre_evolucion, tbl15_evolucion.fecha_ymd, tbl15_evolucion.fecha_time, tbl15_evolucion.cuenta
FROM tbl15_evolucion LEFT JOIN tbl15_cliente ON tbl15_evolucion.cod_cliente = tbl15_cliente.cod_cliente
WHERE (tbl15_evolucion.cod_historia_clinica = '$cod_historia_clinica')";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
*/
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Cedula</th>
<th>Nombres</th>
<th>Motivo</th>
<th>Evolución</th>
<th>Profesional</th>
<th>Fecha</th>
<th>Hora</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_evolucion = $info_cliente['cod_evolucion'];
$cod_cliente = $info_cliente['cod_cliente'];
$motivo = $info_cliente['motivo'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$nombre_prof = $info_cliente['nombre_prof'];
$apellido_prof = $info_cliente['apellido_prof'];
$nombre_evolucion = $info_cliente['nombre_evolucion'];
$fecha_ymd = $info_cliente['fecha_ymd'];
$fecha_time = $info_cliente['fecha_time'];
$fecha = date("Y/m/d", $fecha_time);
$hora = date("H:i", $fecha_time);
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1.' '.$apellido2?></td>
<td><strong><?php echo $motivo?></strong></td>
<td><?php echo $nombre_evolucion?></td>
<td><?php echo $nombre_prof.' '.$apellido_prof?></td>
<td><?php echo $fecha?></td>
<td><?php echo $hora?></td>
</tr>
<?php
}
?>
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
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>