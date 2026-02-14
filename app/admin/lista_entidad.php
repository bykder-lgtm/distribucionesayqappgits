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
<a href="../admin/menu_lista.php"><h4>Lista de Entidades Eps&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_entidad.php">Registrar Entidad Eps</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT * FROM tbl15_entidad";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<!--
<th>Elm</th>
-->
<th>Entidad Eps</th>
<th>Dirección</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Cod</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php

while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_entidad = $info_cliente['cod_entidad'];
$cod_eps = $info_cliente['cod_eps'];
$nombre_entidad = $info_cliente['nombre_entidad'];
$direccion = $info_cliente['direccion'];
$telefono = $info_cliente['telefono'];
$correo = $info_cliente['correo'];
$atiende = $info_cliente['atiende'];
?>
<tr>
<!--
<td align="center"><a href="../admin/crear_historial_clinico.php?cod_entidad=<?php echo $cod_entidad?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
-->
<td><?php echo $nombre_entidad?></td>
<td><?php echo $direccion?></td>
<td><?php echo $telefono?></td>
<td><?php echo $correo?></td>
<td><?php echo $cod_entidad?></td>
<td align="center"><a href="../admin/edit_entidad.php?cod_entidad=<?php echo $cod_entidad?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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