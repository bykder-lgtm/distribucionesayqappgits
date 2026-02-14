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
<a href="../admin/lista_cuentas_cobrar_archivado.php"><h4>Lista de Creditos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<?php if ($cod_estado_cuenta_cobrar_registrar == '1') { ?>
<a href="../admin/lista_siscredito_tercero_crear_nuevo_credito.php">Registrar Nuevo Credito</h4></a>
<?php } ?>
</div>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$tab                               = 'tbl15_cuentas_cobrar';
$campo                             = 'cod_tercero';
$tipo                              = 'eliminar';

$sql_total_cuenta_cobrar = "SELECT SUM(total_monto_deuda_cuenta_cobrar) AS total_monto_deuda_cuenta_cobrar_sum, SUM(total_abonado_cuenta_cobrar) AS total_abonado_cuenta_cobrar_sum, 
SUM(total_subtotal_cuenta_cobrar) AS total_subtotal_cuenta_cobrar_sum FROM tbl15_tercero";
$consulta_total_cuenta_cobrar = mysqli_query($conectar, $sql_total_cuenta_cobrar);
$datos_total_cuenta_cobrar = mysqli_fetch_assoc($consulta_total_cuenta_cobrar);

$total_monto_deuda_cuenta_cobrar_sum            = $datos_total_cuenta_cobrar['total_monto_deuda_cuenta_cobrar_sum'];
$total_abonado_cuenta_cobrar_sum                = $datos_total_cuenta_cobrar['total_abonado_cuenta_cobrar_sum'];
$total_subtotal_cuenta_cobrar_sum               = $datos_total_cuenta_cobrar['total_subtotal_cuenta_cobrar_sum'];

if (isset($_POST['palabra'])) { $palabra = addslashes($_POST['palabra']); } else { $palabra = ''; } 
if (isset($_POST['buscar_por'])) { $buscar_por = addslashes($_POST['buscar_por']); } else { $buscar_por = 'nombre1_tercero'; } 

?>
<div class="table-responsive">
	
<?php if ($cod_estado_cuenta_cobrar == '1') { ?>
<table class="table table-striped">
<tr>
<form action="" method="post">
<td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
<select class="form-control" name="buscar_por" id="buscar_por" style="width: 180px;">
<?php if (isset($buscar_por)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '2') ORDER BY cod_buscar_por ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_buscar_por'];
$nombre = $datos2['titulo_buscar_por'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
<input id="foco" name="palabra" value="<?php echo $palabra ?>" />
<input type="submit" name="buscador" value="Buscar Clientes" />
</td>
</form>
</tr>
</table>

<table class="table table-striped">
<tr>
<td align="center"><strong><font size='4'>TOTAL PENDIENTE:</font></strong></td>
<td align="center"><strong><font size='4'><?php echo number_format($total_subtotal_cuenta_cobrar_sum, 0, ",", ".") ?></font></strong></td>
<!--<td align="center"><a href="../admin/descargar_cuentas_cobrar_xls.php" target="_blank"><img src=../imagenes/btn_xls.png alt="imprimir"></a></td>-->
</tr>
</table>

<table class="table table-striped">
	<thead>
		<tr>
			<?php if ($cod_estado_cuenta_cobrar_eliminar == '1') { ?>
			<th style="text-align:center">ELIM</th>
			<?php } ?>
			<th style="text-align:center">NIT</th>
			<th style="text-align:center">CLIENTE</th>
			<th style="text-align:center">TOTAL DEUDA</th>
			<th style="text-align:center">TOTAL ABONADO</th>
			<th style="text-align:center">PENDIENTE</th>
			<th style="text-align:center">DIRECCION</th>
			<th style="text-align:center">TELEFONO</th>
			<th style="text-align:center">OK</th>
		</tr>
	</thead>
	<tbody>
<?php
if (isset($_POST['palabra'])) { 
	$palabra = addslashes($_POST['palabra']);

	$calcular_datos_cuenta_cobrar = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar, direccion_tercero, 
	nombre_ciudad, telefono1_tercero, identificacion_tercero
	FROM tbl15_tercero WHERE ((nombre1_tercero LIKE '%$palabra%') OR (apellido1_tercero LIKE '%$palabra%')) AND (total_monto_deuda_cuenta_cobrar > '0') ORDER BY nombre1_tercero";
} 
else { 
	$calcular_datos_cuenta_cobrar = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar, direccion_tercero, 
	nombre_ciudad, telefono1_tercero, identificacion_tercero FROM tbl15_tercero WHERE (total_monto_deuda_cuenta_cobrar > '0') ORDER BY nombre1_tercero";
} 
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {
	
	$total_monto_deuda_cuenta_cobrar                   = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar                      = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
	$total_abonado_cuenta_cobrar                       = $datos_cuenta_cobrar['total_abonado_cuenta_cobrar'];
	$cod_tercero                                       = $datos_cuenta_cobrar['cod_tercero'];
	$cliente                                           = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero'];
	$direccion_tercero                                 = $datos_cuenta_cobrar['direccion_tercero'];
	$telefono1_tercero                                 = $datos_cuenta_cobrar['telefono1_tercero'];
	$nombre_ciudad                                     = $datos_cuenta_cobrar['nombre_ciudad'];
	$identificacion_tercero                            = $datos_cuenta_cobrar['identificacion_tercero'];
?>
		<tr>
			<?php if ($cod_estado_cuenta_cobrar_eliminar == '1') { ?>
			<?php if ($total_subtotal_cuenta_cobrar <= '0') { ?><td style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_tercero; ?>&tab=<?php echo $tab; ?>&campo=<?php echo $campo; ?>&tipo=<?php echo $tipo; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td><?php } else { ?><td></td><?php } ?>
			<?php } ?>
			<td><font size='4'><a href="../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura_sistecredito.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $identificacion_tercero;?></a></font></td>
			<td><font size='4'><a href="../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura_sistecredito.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $cliente;?></a></font></td>
			<td style="text-align: right;"><font size='4'><?php echo number_format($total_monto_deuda_cuenta_cobrar, 0, ",", "."); ?></font></td>
			<td style="text-align: right;"><font size='4'><?php echo number_format($total_abonado_cuenta_cobrar, 0, ",", "."); ?></font></td>
			<?php if ($total_subtotal_cuenta_cobrar <= 0) { ?> <td style="text-align: right;"><font size='4'><?php echo number_format($total_subtotal_cuenta_cobrar, 0, ",", "."); ?></font></td>
			<?php } else { ?> <td style="text-align: right;"><font size='4'><?php echo number_format($total_subtotal_cuenta_cobrar, 0, ",", "."); ?></font></td> <?php } ?>
			<td style="text-align: right;"><font size='4'><?php echo $direccion_tercero; ?></font></td>
			<td style="text-align: right;"><font size='4'><?php echo $telefono1_tercero; ?></font></td>
			<td style="text-align: center;"><font size='4'><a href="../admin/cuentas_cobrar_cliente_actualizar_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/correcto.png"></a></font></td>
		</tr>
<?php } ?>
	</tbody>
</table>
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>