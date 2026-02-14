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
<a href="#"><h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
$cod_tipo_pago                        = intval($_GET['cod_tipo_pago']);
$total_precio_venta                   = addslashes($_GET['total_precio_venta']);
$vlr_cancelado                        = addslashes($_GET['vlr_cancelado']);
$pagina                               = addslashes($_GET['pagina']);
?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td style="text-align:center;"><img src=../imagenes/advertencia.gif alt='Advertencia'><strong> EL VALOR RECIBIDO ES MENOR QUE EL VALOR TOTAL DE LA VENTA. </strong><img src=../imagenes/advertencia.gif alt='Advertencia'></td>
</tr>
<tr>
<td style="text-align:center;">TOTAL VENTA: <?php echo number_format($total_precio_venta, 0, ",", "."); ?></td>
</tr>
<tr>
<td style="text-align:center;">RECIBIDO: <?php echo number_format($vlr_cancelado, 0, ",", "."); ?></td>
</tr>
<tr>
<td style="text-align:center;"><a href="<?php echo $pagina;?>"><img src='../imagenes/regresar.png'></a></td>
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