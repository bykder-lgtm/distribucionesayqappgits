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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Medicamento</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_medicamento';
$tipo = 'eliminar';
$campo = 'cod_medicamento';


$sql_cliente = "SELECT cod_medicamento, cod_atc, nombre_medicamento, principio_activo, concentracion, forma, aclaracion, cod_tipo_pos, 
cod_estado, cod_laboratorio FROM tbl15_medicamento ORDER BY nombre_medicamento ASC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Elim</th>
<th>Nombre</th>
<th>Cod</th>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_medicamento = $info_cliente['cod_medicamento'];
$cod_atc = $info_cliente['cod_atc'];
$nombre_medicamento = $info_cliente['nombre_medicamento'];
$principio_activo = $info_cliente['principio_activo'];
$concentracion = $info_cliente['concentracion'];
$forma = $info_cliente['forma'];
$aclaracion = $info_cliente['aclaracion'];
$cod_tipo_pos = $info_cliente['cod_tipo_pos'];
$cod_estado = $info_cliente['cod_estado'];
$cod_laboratorio = $info_cliente['cod_laboratorio'];
?>
<tr>
<td align="center"><a href="../admin/eliminar.php?llave=<?php echo $cod_medicamento?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $nombre_medicamento?></td>
<td><?php echo $cod_medicamento?></td>
</tr>
<?php
}
?>
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