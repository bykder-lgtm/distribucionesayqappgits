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
<a href="#"><h4>Caja Abierta</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php

?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th style="text-align:center">NO SE PUEDE CERRAR SESION</th>
</tr>
<tr>
<th style="text-align:center">HAY <?php echo $nombre_concepto_multi_virtual; ?>S DE VENTA ABIERTAS</th>
</tr>
<tr>
<th style="text-align:center"><a href="../admin/lista_caja_virtual.php">POR FAVOR CIERRE LO QUE FALTA POR FACTURAR</a></th>
</tr>
<tr>
<th style="text-align:center"><a href="../admin/lista_caja_virtual.php">VER LISTA DE <?php echo $nombre_concepto_multi_virtual; ?>S</a></th>
</tr>
<tr>
<th style="text-align:center">.</th>
</tr>
<tr>
<th style="text-align:center">.</th>
</tr>
<tr>
<th style="text-align:center"><a href="../session/salir_admin.php">SALIR DE TODOS MODOS</a></th>
</tr>
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