<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
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
<!--<a href="#"><h4>Reporte Cuentas por Cobrar - Cartera Vencida</h4></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                                      = $_SERVER['PHP_SELF'];
$fecha_impr                                  = date("Ymd");
$hora_impr                                   = date("His");
$fecha_hoy                                   = date("Y-m-d");
$monto_deuda_smtr                            = 0;
$abonado_smtr                                = 0;
$subtotal_smtr                               = 0;

$seleccionado                                = 0;


if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
	$cod_tercero                                 = intval($_GET['cod_tercero']);
	$fecha_ymd_venta_producto_ini                = addslashes($_GET['fecha_ymd_venta_producto_ini']);
	$fecha_ymd_venta_producto_fin                = addslashes($_GET['fecha_ymd_venta_producto_fin']);
} else {
	$cod_tercero                                 = 0;
	$fecha_ymd_venta_producto_ini                = date("Y-m-d");
	$fecha_ymd_venta_producto_fin                = date("Y-m-d");
}


if ($cod_tercero==0) {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
    $filtro_consulta_tercero_abonos_rel = "";
} else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_cuentas_cobrar.cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_abonos_rel = "AND (tbl15_cuentas_cobrar_abonos.cod_tercero = '$cod_tercero')";
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">

<table class="table table-striped">
	<tr>
		<th style="text-align: center;"><h4>Reporte Cuentas por Cobrar Archivadas</h4></th>
	</tr>
</table>


<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
  <tr>
    <td style="text-align:left;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>

<?php if (isset($_GET['fecha_ymd_venta_producto_ini'])) { ?>

	<table class="table table-striped">
		<tr>
			<th style="text-align: center;"><h4>Listado Por Abonos</h4></th>
		</tr>
	</table>

	<table class="table table-striped">
		<tr>
			<th style="text-align: center;">FACTURA</th>
			<th style="text-align: center;">TERCERO</th>
			<th style="text-align: center;">ABONO</th>
			<th style="text-align: center;">FORMA PAGO</th>
			<th style="text-align: center;">PAGO A</th>
			<th style="text-align: center;">FECHA</th>
			<th style="text-align: center;">HORA</th>
			<th style="text-align: center;">ID</th>
		</tr>
	<?php
	$total_abonado = 0;
	$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (fecha_pago BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_archivado = '1') $filtro_consulta_tercero ORDER BY cod_cuentas_cobrar_abonos DESC";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	$total_datos = mysqli_num_rows($consulta);
	while ($datos = mysqli_fetch_assoc($consulta)) {

		$cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
		$abonado                    = $datos['abonado'];
		$cod_factura                = $datos['cod_factura'];
		$cuenta                     = $datos['cuenta'];
		$mensaje                    = $datos['mensaje'];
		$fecha_pago                 = $datos['fecha_pago'];
		$hora                       = $datos['hora'];
		$cod_dependencia            = $datos['cod_dependencia'];
		$cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];
		$cod_tercero                = $datos['cod_tercero'];

		$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
		$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
		$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

		$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

	    $sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
	    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

		$cliente                    = trim($datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero']);
		$total_abonado             += $abonado;
	?>
		<tr>
			<td style="text-align: center;"><?php echo $cod_factura;?></td>
			<td style="text-align: left;"><?php echo $cliente;?></td>
			<td style="text-align: right;"><?php echo number_format($abonado, 0, ",", ".")?></td>
			<td style="text-align: center;"><?php echo $nombre_tipo_forma_pago;?></td>
			<td style="text-align: center;"><?php echo $cuenta;?></td>
			<td style="text-align: center;"><?php echo $fecha_pago;?></td>
			<td style="text-align: center;"><?php echo $hora;?></td>
			<td style="text-align: center;"><?php echo $cod_cuentas_cobrar_abonos; ?></td>
		</tr>
		<?php //} ?>
	<?php } ?>
	</table>

	<table class="table table-striped">
		<tr>
			<th style="text-align: center;"><h4>Listado Por Facturas</h4></th>
		</tr>
	</table>

	<table class="table table-striped">
		<tr>
			<th style="text-align: center;">FACTURA</th>
			<th style="text-align: center;">TERCERO</th>
			<th style="text-align: center;">TOTAL CREDITO</th>
			<th style="text-align: center;">TOTAL ABONADO</th>
			<th style="text-align: center;">TOTAL PENDIENTE</th>
			<th style="text-align: center;">FECHA REG</th>
			<th style="text-align: center;">FECHA PAGO</th>
			<th style="text-align: center;">VENDEDOR</th>
			<th style="text-align: center;">ID</th>
		</tr>
	<?php
	$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
	tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, 
	tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta, tbl15_cuentas_cobrar.cod_estado_pago
	FROM tbl15_cuentas_cobrar 
	WHERE (tbl15_cuentas_cobrar.fecha BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '1') $filtro_consulta_tercero_rel 
	ORDER BY tbl15_cuentas_cobrar.cod_cuentas_cobrar DESC";
	$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
	$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
	while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar)) {

		$cod_cuentas_cobrar                              = $datos_cuenta_pagar['cod_cuentas_cobrar'];
		$cod_info_factura_venta                          = $datos_cuenta_pagar['cod_info_factura_venta'];
		$cod_factura                                     = $datos_cuenta_pagar['cod_factura'];
		$monto_deuda                                     = $datos_cuenta_pagar['monto_deuda'];
		$abonado                                         = $datos_cuenta_pagar['abonado'];
		$subtotal                                        = $datos_cuenta_pagar['subtotal'];
		$mensaje                                         = $datos_cuenta_pagar['mensaje'];
		$fecha                                           = $datos_cuenta_pagar['fecha'];
		$fecha_pago                                      = $datos_cuenta_pagar['fecha_pago'];
		$vendedor                                        = $datos_cuenta_pagar['vendedor'];
		$cod_estado_pago                                 = $datos_cuenta_pagar['cod_estado_pago'];
		$cod_tercero                                     = $datos_cuenta_pagar['cod_tercero'];
		$monto_deuda_smtr                                = $monto_deuda_smtr + $monto_deuda;
		$abonado_smtr                                    = $abonado_smtr + $abonado;
		$subtotal_smtr                                   = $subtotal_smtr + $subtotal;

	    $sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
	    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

		$cliente                                         = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];

		$fecha_ini_seg                                   = strtotime($fecha_hoy);
		$fecha_fin_seg                                   = strtotime($fecha_pago);
		$fecha_dif_seg                                   = floor($fecha_fin_seg - $fecha_ini_seg);
		$dias_vence_vigencia                             = ($fecha_dif_seg / (60 * 60 * 24));

	    if ($dias_vence_vigencia < 0) { 
	    	$titulo_alerta = '(VENCIO HACE '.abs($dias_vence_vigencia).' DIAS)'; $color_alerta_fondo = 'background-color:#A40000'; $color_alerta_letra = 'color:#FFFFFF'; 
	    } elseif ($dias_vence_vigencia > 0) { 
	    	$titulo_alerta  = '(FALTAN '.abs($dias_vence_vigencia).' DIAS)'; $color_alerta_fondo = 'background-color:#DBE0F3'; $color_alerta_letra = 'color:#000000'; 
	    } else { 
	    	$titulo_alerta  = '(ES HOY)'; $color_alerta_fondo = 'background-color:#009933'; $color_alerta_letra = 'color:#000000'; 
	    }

		if (($subtotal > '0')) { $condicional_fecha_subtotal = true; } else { $condicional_fecha_subtotal = false; }
		if ($cod_estado_pago == '0') { $condicional_estado_pago = true; } else { $condicional_estado_pago = false; }

		if ($condicional_fecha_subtotal && $condicional_estado_pago) { 
			$cod_estado_pago_invert = '1';
			$url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_cobrar_reg.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
			$boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; 
		} else { 
			$cod_estado_pago_invert = '0';
			$url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_cobrar_reg.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
			$boton_alerta_caducidad = '<img src="../imagenes/sem_atendido_peq.png">'; 
		}
		
		if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '1') {
			$url_redirect = "../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura.php?cod_tercero=".$cod_tercero."&cod_cuentas_cobrar=".$cod_cuentas_cobrar.'&cod_estado_pago='.$cod_estado_pago."&pagina=".$pagina;
		} else {
			$url_redirect = "../admin/cuentas_cobrar_detalle_factura.php?cod_tercero=".$cod_tercero."&cod_cuentas_cobrar=".$cod_cuentas_cobrar.'&cod_estado_pago='.$cod_estado_pago."&pagina=".$pagina;
		}
		//if ($cod_estado_pago == '0' && $subtotal <= '0') {
	?>
		<tr>
			<td style="text-align: center;"><?php echo $cod_factura;?></td>
			<td style="text-align: left;"><?php echo $cliente;?></td>
			<td style="text-align: right;"><?php echo number_format($monto_deuda, 0, ",", ".")?></td>
			<td style="text-align: right;"><?php echo number_format($abonado, 0, ",", ".");?></td>
			<td style="text-align: right;"><?php echo number_format($subtotal, 0, ",", "."); ?></td>
			<td style="text-align: center;"><?php echo $fecha;?></td>
			<td style="text-align: center;"><?php echo $fecha_pago;?></td>
			<td style="text-align: center;"><?php echo $vendedor; ?></td>
			<td style="text-align: center;"><?php echo $cod_cuentas_cobrar; ?></td>
		</tr>
		<?php //} ?>
	<?php } ?>
	</table>
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
</body>
</html>