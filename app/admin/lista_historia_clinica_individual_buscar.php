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
<div class="breadcrumbs"><a href="../admin/lista_historia_clinica_individual.php"><h4>Buscar Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<form action="" id="searchform" method="post">
<input type="text" name="buscar" placeholder="Buscar" include autofocus>
<button type="submit">Buscar</button>
</form> 
<?php
if (isset($_POST['buscar'])) {
$buscar = addslashes($_POST['buscar']);
$pagina = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.apellido2, tbl15_historia_clinica.motivo, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.cuenta
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE MATCH(tbl15_cliente.nombres, tbl15_cliente.apellido1) AGAINST ('$buscar') ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Cedula</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Fecha</th>
<th>Cuenta</th>
<th>Ver</th>
<th>Pdf</th>
<th>Edit</th>
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
$fecha_dmy = $info_cliente['fecha_dmy'];
$cuenta = $info_cliente['cuenta'];
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres?></td>
<td><?php echo $apellido1.' '.$apellido2 ?></td>
<td><?php echo $fecha_dmy?></td>
<td><?php echo $cuenta?></td>
<td align="center"><a href="../admin/ver_historia_clinica_html.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/ver_peq.png" class="img-polaroid" alt=""></a></td>
<td align="center"><a href="../admin/ver_historial_clinico_pdf.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<td align="center"><a href="../admin/edit_historia_clinica.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/actualizar.png" class="img-polaroid" alt=""></a></td>
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