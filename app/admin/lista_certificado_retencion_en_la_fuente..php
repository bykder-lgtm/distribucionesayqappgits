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
</div>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Certificados Retefuente</font></a></th>
        <th style="text-align:right"><a href="../admin/reporte_compra_fechas_tercero_certificado_retencion_en_la_fuente.php"><font size='+2'>Registrar Certificado Por Reporte</font></a></th>
        <th style="text-align:right"><a href="../admin/reg_certificado_retencion_en_la_fuente.php"><font size='+2'>Registrar Certificado Manual</font></a></th>
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
		<th style="text-align:center">TIPO DE FACTURACION</th>
		<th style="text-align:center">TIPO DE MODULO</th>
		<th style="text-align:center">NUMERO DE RESOLUCION</th>
		<th style="text-align:center">INICIO DE NUMERACION</th>
		<th style="text-align:center">FINAL DE NUMERACION</th>
		<th style="text-align:center">PREFIJO DE NUMERACION</th>
		<th style="text-align:center">FECHA DE RESOLUCION</th>
		<th style="text-align:center">VIGENICA RESOLUCION (MESES)</th>
		<th style="text-align:center">VENCE</th>
		<th style="text-align:center">ESTADO</th>
		<th style="text-align:center">EDIT</th>
	</tr>
</thead>
<tbody>
<?php
$fecha_alerta_vence_vigencia                     = "";
$fecha_hoy                                       = date("Y-m-d");

$mostrar_datos_sql = "SELECT * FROM tbl15_resolucion_facturacion ORDER BY cod_resolucion_facturacion DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_resolucion_facturacion                     = $matriz_consulta['cod_resolucion_facturacion'];
	$cod_tipo_resolucion_facturacion                = $matriz_consulta['cod_tipo_resolucion_facturacion'];
	$nombre_tipo_resolucion_facturacion             = $matriz_consulta['nombre_tipo_resolucion_facturacion'];
	$numero_resolucion_facturacion                  = $matriz_consulta['numero_resolucion_facturacion'];
	$ini_resolucion_facturacion                     = $matriz_consulta['ini_resolucion_facturacion'];
	$fin_resolucion_facturacion                     = $matriz_consulta['fin_resolucion_facturacion'];
	$prefijo_resolucion_facturacion                 = $matriz_consulta['prefijo_resolucion_facturacion'];
	$fecha_resolucion_facturacion                   = $matriz_consulta['fecha_resolucion_facturacion'];
	$vigencia_meses_resolucion_facturacion          = $matriz_consulta['vigencia_meses_resolucion_facturacion'];
	$fecha_reg                                      = $matriz_consulta['fecha_reg'];
	$nombre_tipo_estado                             = $matriz_consulta['nombre_tipo_estado'];
	$fecha_vencimiento_resolucion_facturacion       = $matriz_consulta['fecha_vencimiento_resolucion_facturacion'];
	$cod_origen_resolucion_facturacion              = $matriz_consulta['cod_origen_resolucion_facturacion'];
    $fecha_alerta_vence_vigencia                    = strtotime($fecha_vencimiento_resolucion_facturacion) - strtotime($fecha_hoy);
    $dias_vence_vigencia                            = $fecha_alerta_vence_vigencia/(60*60*24);

	$sql_origen_resolucion_facturacion = "SELECT * FROM tbl15_origen_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '$cod_origen_resolucion_facturacion')";
	$consulta_origen_resolucion_facturacion = mysqli_query($conectar, $sql_origen_resolucion_facturacion);
	$matriz_origen_resolucion_facturacion = mysqli_fetch_assoc($consulta_origen_resolucion_facturacion);

	$nombre_origen_resolucion_facturacion          = $matriz_origen_resolucion_facturacion['nombre_origen_resolucion_facturacion'];

    if ($dias_vence_vigencia < 0) { $titulo_alerta  = '<br>(VENCIO HACE '.abs($dias_vence_vigencia).' DIAS)'; } elseif ($dias_vence_vigencia > 0) { $titulo_alerta  = '<br>(FALTAN '.abs($dias_vence_vigencia).' DIAS)'; } else { $titulo_alerta  = '<br>(ES HOY)'; }
?>
	<tr>
		<td style="text-align:left"><?php echo $cod_resolucion_facturacion; ?></td>
		<td style="text-align:left"><?php echo $nombre_tipo_resolucion_facturacion; ?></td>
		<td style="text-align:left"><?php echo $nombre_origen_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $numero_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $ini_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $fin_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $prefijo_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $fecha_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $vigencia_meses_resolucion_facturacion; ?></td>
		<td style="text-align:center"><?php echo $fecha_vencimiento_resolucion_facturacion.' '.$titulo_alerta.''; ?></td>
		<td style="text-align:center"><?php echo $nombre_tipo_estado; ?></td>
		<td style="text-align:center"><a href="../admin/edit_resolucion_facturacion.php?cod_resolucion_facturacion=<?php echo $cod_resolucion_facturacion; ?>"><img src=../imagenes/actualizar.png alt="Actualizar"></a></td>
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