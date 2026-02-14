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
<div class="breadcrumbs"><a href="#"><h4>Info Empresa</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$mostrar_datos_sql = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
?>
<div class="table-responsive">
 <table class="table">
<thead>
<tr>
<th>Titulo</th>
<th>Cabecera Program</th>
<th>Eslogan</th>
<th>Cabecera Factura</th>
<th>Res</th>
<th>De</th>
<th>A</th>
<th>Localidad</th>
<th>Telefono</th>
<th>Direccion</th>
<th>Nit Empresa</th>
<th>Icono</th>
<?php if ($cod_estado_info_empresa_editar == '1') { ?><th>Edit</th><?php } ?>
</tr>
</thead>
<tbody>
<?php
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_info_empresa = $matriz_consulta['cod_info_empresa'];
$titulo = $matriz_consulta['titulo'];
$nombre = $matriz_consulta['nombre'];
$eslogan = $matriz_consulta['eslogan'];
$cabecera = $matriz_consulta['cabecera'];
$res = $matriz_consulta['res'];
$res1 = $matriz_consulta['res1'];
$res2 = $matriz_consulta['res2'];
$localidad = $matriz_consulta['localidad'];
$telefono = $matriz_consulta['telefono'];
$direccion = $matriz_consulta['direccion'];
$nit_empresa = $matriz_consulta['nit_empresa'];
$icono = $matriz_consulta['icono'];
?>
<tr>
<td ><?php echo $titulo; ?></td>
<td ><?php echo $nombre; ?></td>
<td ><?php echo $eslogan; ?></td>
<td ><?php echo $cabecera; ?></td>
<td ><?php echo $res; ?></td>
<td ><?php echo $res1; ?></td>
<td ><?php echo $res2; ?></td>
<td ><?php echo $localidad; ?></td>
<td ><?php echo $telefono; ?></td>
<td ><?php echo $direccion; ?></td>
<td ><?php echo $nit_empresa; ?></td>
<td align="center"><img src="<?php echo $icono; ?>" alt="icono"></td>
<?php if ($cod_estado_info_empresa_editar == '1') { ?><td align="center"><a href="../admin/edit_info_empresa.php?cod_info_empresa=<?php echo $cod_info_empresa?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td><?php } ?>
</tr>
<?php
}
?>
</tr>
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