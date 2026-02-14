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
<h4><a href="#">Cuentas de cobro por mes</a></h4>
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
?>
<div class="table-responsive">

<table class="table table-striped">
<thead>
</thead>
<tbody>
<?php
$contador = 0;

$calcular_datos_cuenta_cobrar = "SELECT cod_tabla_mes, nombre_tabla_mes, nombre_letra_tabla_mes FROM tbl15_tabla_mes ORDER BY cod_tabla_mes ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$contador++;
$cod_tabla_mes                              = $datos_cuenta_cobrar['cod_tabla_mes'];
$nombre_tabla_mes                           = $datos_cuenta_cobrar['nombre_tabla_mes'];
$nombre_letra_tabla_mes                     = $datos_cuenta_cobrar['nombre_letra_tabla_mes'];
$modulo                                     = $contador % 5;

if ($contador%7 == 0) { ?>
<tr></tr>
<td style="text-align: center;"><font size='3'><a href="../admin/cuentas_cobrar_detalle_factura_alquiler.php?cod_tabla_mes=<?php echo $cod_tabla_mes; ?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes; ?>&nombre_letra_tabla_mes=<?php echo $nombre_letra_tabla_mes; ?>&pagina=<?php echo $pagina; ?>"><?php echo $nombre_letra_tabla_mes?></a></font></td>
<?php } else { ?>
<td style="text-align: center;"><font size='3'><a href="../admin/cuentas_cobrar_detalle_factura_alquiler.php?cod_tabla_mes=<?php echo $cod_tabla_mes; ?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes; ?>&nombre_letra_tabla_mes=<?php echo $nombre_letra_tabla_mes; ?>&pagina=<?php echo $pagina; ?>"><?php echo $nombre_letra_tabla_mes?></a></font></td>
<?php } ?>
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