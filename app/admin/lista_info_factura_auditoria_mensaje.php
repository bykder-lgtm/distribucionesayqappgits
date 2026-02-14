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
<!--<a class="btn btn-primary" href="#"><h6>Lista Auditoria</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$pagina_local                = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_info_factura_auditoria';
$tipo                        = 'eliminar';
$campo                       = 'cod_info_factura_auditoria';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
    	<th style="text-align:center"><a href="../admin/lista_info_factura_auditoria.php"><font size='+2'>REGRESAR</font></a></th>
    </tr>
    <tr>
        <th style="text-align:center"><font size='+2'>VER LA LISTA DE TODOS LOS RESULTADOS DE AUDITORIA EN MASIVO</font></th>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<?php if ($cod_estado_prod_auditoria == '1') { ?>
<form method="POST" name="formulario" action="resultado_auditoria_producto_manual_pos_masiva.php">
	<table class="table table-striped">
		<?php
		$sql_info_factura = "SELECT cod_info_factura_auditoria FROM tbl15_info_factura_auditoria WHERE (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_auditoria DESC";
		$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
		while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
		    
		$cod_info_factura_auditoria            = $info_info_factura['cod_info_factura_auditoria'];
		?>
		<input type="hidden" name="cod_info_factura_auditoria[]" value="<?php echo $cod_info_factura_auditoria; ?>">
		<?php } ?>
		<td style="text-align:center;"><input type="submit" value="VER AUDITORIA MASIVA" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
		<input type="hidden" name="insertar_datos" value="formulario">
	</table>
</form>
<?php } ?>
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