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
<?php $nombre_certificado_retefuente = 'RETENCIÓN APLICADA A COMPRAS DECLARANTES'; ?>
<div class="breadcrumbs">
</div>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_certificado_retencion_en_la_fuente_compra.php"><font size='+1'>Lista Certificados Retefuente Compra</font></a></th>
        <th style="text-align:right"><a href="../admin/reporte_compra_fechas_tercero_certificado_retencion_en_la_fuente_compra.php?nombre_certificado_retefuente=<?php echo $nombre_certificado_retefuente; ?>"><font size='+1'>Registrar Certificado Por Reporte</font></a></th>
        <th style="text-align:right"><a href="../admin/reg_certificado_retencion_en_la_fuente_compra_manual.php?nombre_certificado_retefuente=<?php echo $nombre_certificado_retefuente; ?>"><font size='+1'>Registrar Certificado Manual</font></a></th>
    </tr>
</table>
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
	<tr>
		<th style="text-align:center">ID</th>
		<th style="text-align:center">TERCERO</th>
		<th style="text-align:center">CONCEPTO</th>
		<th style="text-align:center">FECHA INICIAL</th>
		<th style="text-align:center">FECHA FINAL</th>
		<th style="text-align:center">TASA%</th>
		<th style="text-align:center">BASE RETENCION</th>
		<th style="text-align:center">VALOR RETENIDO</th>
		<th style="text-align:center">FECHA CREACION</th>
		<!--<th style="text-align:center">ESTADO</th>-->
		<th style="text-align:center">ORIGEN</th>
		<th style="text-align:center">EDIT</th>
		<th style="text-align:center">IMP</th>
	</tr>
</thead>
<tbody>
<?php
$fecha_alerta_vence_vigencia                     = "";
$fecha_hoy                                       = date("Y-m-d");

$mostrar_datos_sql = "SELECT * FROM tbl15_certificado_retefuente WHERE (nombre_certificado_retefuente = '$nombre_certificado_retefuente') ORDER BY cod_certificado_retefuente DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_certificado_retefuente                          = $matriz_consulta['cod_certificado_retefuente'];
	$cod_tercero                                         = $matriz_consulta['cod_tercero'];
	$nombre_certificado_retefuente                       = $matriz_consulta['nombre_certificado_retefuente'];
	$fecha_ini_certificado_retefuente                    = $matriz_consulta['fecha_ini_certificado_retefuente'];
	$fecha_fin_certificado_retefuente                    = $matriz_consulta['fecha_fin_certificado_retefuente'];
	$fecha_generacion_documento_certificado_retefuente   = $matriz_consulta['fecha_generacion_documento_certificado_retefuente'];
	$hora_generacion_documento_certificado_retefuente    = $matriz_consulta['hora_generacion_documento_certificado_retefuente'];
	$nombre_rete_fuente_ptj                              = $matriz_consulta['nombre_rete_fuente_ptj'];
	$subtotal_base_retencion                             = $matriz_consulta['subtotal_base_retencion'];
	$total_retefuente_valor_retenido                     = $matriz_consulta['total_retefuente_valor_retenido'];
	$fecha_creacion                                      = $matriz_consulta['fecha_creacion'];
	$fecha_modificacion                                  = $matriz_consulta['fecha_modificacion'];
	$cod_administrador                                   = $matriz_consulta['cod_administrador'];
	$nombre_origen_creacion                              = $matriz_consulta['nombre_origen_creacion'];
	$cod_estado                                          = $matriz_consulta['cod_estado'];

	$sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_tercero = mysqli_query($conectar, $sql_tercero);
	$matriz_tercero = mysqli_fetch_assoc($consulta_tercero);

	$nombre1_tercero                                     = trim($matriz_tercero['nombre1_tercero'].' ('.$matriz_tercero['identificacion_tercero'].')');
?>
	<tr>
		<td style="text-align:center"><?php echo $cod_certificado_retefuente; ?></td>
		<td style="text-align:left"><?php echo $nombre1_tercero; ?></td>
		<td style="text-align:left"><?php echo $nombre_certificado_retefuente; ?></td>
		<td style="text-align:center"><?php echo $fecha_ini_certificado_retefuente; ?></td>
		<td style="text-align:center"><?php echo $fecha_fin_certificado_retefuente; ?></td>
		<td style="text-align:center"><?php echo $nombre_rete_fuente_ptj; ?></td>
		<td style="text-align:center"><?php echo number_format($subtotal_base_retencion, 0, ",", "."); ?></td>
		<td style="text-align:center"><?php echo number_format($total_retefuente_valor_retenido, 0, ",", "."); ?></td>
		<td style="text-align:center"><?php echo $fecha_generacion_documento_certificado_retefuente.' '.$hora_generacion_documento_certificado_retefuente; ?></td>
		<!--<td style="text-align:center"><?php echo $cod_estado; ?></td>-->
		<td style="text-align:center"><?php echo $nombre_origen_creacion; ?></td>
		<td style="text-align:center"><a href="../admin/edit_certificado_retencion_en_la_fuente.php?cod_certificado_retefuente=<?php echo $cod_certificado_retefuente; ?>"><img src=../imagenes/editar.png alt="Actualizar"></a></td>
		<td style="text-align:center"><a href="../admin/certificado_de_retencion_en_la_fuente_pdf.php?cod_certificado_retefuente=<?php echo $cod_certificado_retefuente; ?>" target="_blank"><img src=../imagenes/pdf_peq.png alt="pdf"></a></td>
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