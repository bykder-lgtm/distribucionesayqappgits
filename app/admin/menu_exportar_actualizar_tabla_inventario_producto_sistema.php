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
<!--<div class="container">-->
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/menu_exportar_actualizar_tabla_inventario_producto_sistema.php"><h4>Actualizar Inventario Productos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
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
//-----------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">
<table class="table table-striped">
	<thead>
		<tr>
			<?php if ($cod_estado_actualizar_base_datos_arch_plano_producto_global == '1') { ?>
				<?php if ($cod_estado_tipo_export_excel_global == '1') { ?>
					<th style="text-align:center"><a href="../admin/reporte_exportar_productos_inventario_campos_spout_xlsx.php">DESCARGAR CAMPOS INVENTARIO PRODUCTOS (XLSX)</a></th>
				<?php } else { ?>
					<th style="text-align:center"><a href="../admin/exportar_productos_inventario_campos_punto_y_coma_csv.php">DESCARGAR CAMPOS INVENTARIO PRODUCTOS (CSV)</a></th>
				<?php } ?>
			<?php } ?>
			<?php if ($cod_estado_actualizar_base_datos_arch_plano_producto_global == '1') { ?>
			<th style="text-align:center"><a href="../admin/lista_actualizacion_tabla_sistema_inventario_masivo.php">VER CARGADOS</a></th><?php } ?>
			<?php if ($cod_estado_actualizar_base_datos_arch_plano_producto_global == '1') { ?>
				<?php if ($cod_estado_tipo_export_excel_global == '1') { ?>
					<th style="text-align:center"><a href="../admin/actualizar_productos_inventario_campos_spout_xlsx.php">ACTUALIZAR CAMPOS INVENTARIO PRODUCTOS (XLSX)</a></th>
				<?php } else { ?>
					<th style="text-align:center"><a href="../admin/actualizar_productos_inventario_campos_punto_y_coma_csv.php">ACTUALIZAR CAMPOS INVENTARIO PRODUCTOS (CSV)</a></th>
				<?php } ?>
			<?php } ?>
		</tr>
	</thead>
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
<!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>