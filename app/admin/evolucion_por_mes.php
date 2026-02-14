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
<div class="breadcrumbs"><a href="#"><h4>Lista de Evoluciones</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>
<?php include_once("../admin/menu_evolucion.php") ?>

<form action="" id="searchform" method="GET">
<select name="fecha_mes" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php $sql_consulta = "SELECT fecha_mes FROM tbl15_evolucion GROUP BY fecha_mes ORDER BY fecha_ymd DESC";
$resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($contenedor = mysqli_fetch_assoc($resultado)) {?>
<option value="<?php echo $contenedor['fecha_mes'] ?>"><?php echo $contenedor['fecha_mes'] ?></option>
<?php } ?>
</select>
<td align="center"><button type="submit">Ver</button></td>
</form>
<?php
if (isset($_GET['fecha_mes'])) {
$fecha_mes = addslashes($_GET['fecha_mes']);
$pagina = $_SERVER['PHP_SELF'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_cliente = "SELECT tbl15_evolucion.cod_evolucion, tbl15_evolucion.nombre_evolucion, tbl15_evolucion.fecha_mes, tbl15_evolucion.fecha_anyo, 
tbl15_evolucion.fecha_ymd, tbl15_evolucion.fecha_time, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.motivo, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, tbl15_historia_clinica.cod_historia_clinica
FROM (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_evolucion ON tbl15_cliente.cod_cliente = tbl15_evolucion.cod_cliente) 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_evolucion.cod_historia_clinica HAVING (tbl15_evolucion.fecha_mes = '$fecha_mes') ORDER BY tbl15_evolucion.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<br>
<form action="" id="titulo_centrado_busqueda" method="GET">
<td align="center">FECHA: <?php echo $fecha_mes ?></td>
</form> 
<br>
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
$cod_historia_clinica = $info_cliente['cod_historia_clinica'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$motivo = $info_cliente['motivo'];
$nombre_evolucion = $info_cliente['nombre_evolucion'];
$nombre_prof = $info_cliente['nombre_prof'];
$apellidos_prof = $info_cliente['apellidos_prof'];
$fecha_time = $info_cliente['fecha_time'];
$fecha_dmy = date("Y/m/d", $fecha_time);
$hora = date("H:i", $fecha_time);
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1.' '.$apellido2?></td>
<td><strong><?php echo $motivo?></strong></td>
<td><?php echo $nombre_evolucion?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof ?></td>
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