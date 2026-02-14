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
<a class="btn btn-primary" href="../admin/lista_egreso.php"><h6>Lista conceptos de egreso</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_gastos_tabla';
$tipo                        = 'eliminar';
$campo                       = 'cod_gastos_tabla';
$fecha                       = date("Y-m-d");
$origen                      = 'PARACLINICOS';
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">ELM</th>
<th style="text-align:center">CONCEPTO</th>
<th style="text-align:center">EDIT</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_gastos_tabla";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_gastos_tabla                    = $info_info_factura['cod_gastos_tabla'];
$conceptos                           = $info_info_factura['conceptos'];
?>
<tr>
<td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_gastos_tabla ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:left"><?php echo $conceptos?></td>
<td style="text-align:center"><a href="../admin/edit_concepto_egreso.php?cod_gastos_tabla=<?php echo $cod_gastos_tabla ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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

