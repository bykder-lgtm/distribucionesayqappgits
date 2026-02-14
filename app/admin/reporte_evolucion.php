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
<div class="breadcrumbs"><a href="#"><h4>Lista de Evoluciones Por Paciente</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$buscar = 1;
if (isset($buscar)) {
$pagina = $_SERVER['PHP_SELF'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_cliente = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_administrador.nombres AS nombre_prof, 
tbl15_administrador.apellidos AS apellidos_prof , tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica, Count(tbl15_evolucion.cod_evolucion) AS total_evolucion, 
tbl15_historia_clinica.total_terapia, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.motivo, tbl15_historia_clinica.fecha_time
FROM (tbl15_tipo_historia_clinica RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON 
tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON 
tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_historia_clinica.cod_tipo_historia_clinica) LEFT JOIN tbl15_evolucion ON 
tbl15_historia_clinica.cod_historia_clinica = tbl15_evolucion.cod_historia_clinica
GROUP BY tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_administrador.nombres, 
tbl15_administrador.apellidos, tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica, tbl15_historia_clinica.total_terapia
 ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<br>
<form action="" id="titulo_centrado_busqueda" method="post">
<td align="center">FECHA: <?php echo $buscar ?></td>
</form> 
<br>

<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Cedula</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Motivo</th>
<th>Profesional</th>
<th>Terapias</th>
<th>Fecha</th>
<th>Hora</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_historia_clinica = $info_cliente['cod_historia_clinica'];
$cod_cliente = $info_cliente['cod_cliente'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$motivo = $info_cliente['motivo'];
$nombre_prof = $info_cliente['nombre_prof'];
$apellidos_prof = $info_cliente['apellidos_prof'];
$nombre_tipo_historia_clinica = $info_cliente['nombre_tipo_historia_clinica'];
$total_evolucion = $info_cliente['total_evolucion'];
$total_terapia = $info_cliente['total_terapia'];
$fecha_time = $info_cliente['fecha_time'];
$fecha_dmy = date("Y/m/d", $fecha_time);
$hora = date("H:i", $fecha_time);
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres?></td>
<td><?php echo $apellido1.' '.$apellido2 ?></td>
<td><?php echo $motivo?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof ?></td>
<td><?php echo $total_evolucion.' de '.$total_terapia ?></td>
<td><?php echo $fecha_dmy?></td>
<td><?php echo $hora?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<?php } ?>

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