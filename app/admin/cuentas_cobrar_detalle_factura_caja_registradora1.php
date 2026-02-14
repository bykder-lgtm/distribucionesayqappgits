<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../estilo_css/caja_registradora_jqueryscripttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../estilo_css/caja_registradora_bootstrap.min.css">
<script src="../js/caja_registradora_math.min.js"></script>
<script src="../js/caja_registradora_jquery-3.2.1.min.js"></script>
<script src="../js/caja_registradora_popper.min.js"></script>
<script src="../js/caja_registradora_bootstrap.min.js"></script>

<script src="../js/default.js" type="text/javascript"></script>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../estilo_css/chosen_600px.css">

<link rel="stylesheet" href="../estilo_css/caja_registradora_font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/estilo_caja_registradora.css">
</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<body>
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$cod_tercero                       = intval($_GET['cod_tercero']);

$tab                               = 'tbl15_cuentas_cobrar_por_factura';
$campo                             = 'cod_tercero';
$tipo                              = 'eliminar';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente);
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                        = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') AND (tbl15_cuentas_cobrar.subtotal > '0') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_cuentas_cobrar     = $datos_total_facturas['cod_cuentas_cobrar'];
$cod_factura            = $datos_total_facturas['cod_factura'];
$cod_factura_strpad     = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$fecha_hoy              = date("Y-m-d");
?>

  <table class="table table-striped">
    <tr>
      <td style="text-align:center;"><a href="../admin/lista_cuentas_cobrar_caja_registradora.php" class="btn btn-warning">Regresar</a></td>
      <td style="text-align:center;"><a href="#" class="btn btn-info">CUENTAS POR COBRAR (FACTURAS EN CREDITO - <?php echo $nombre1_tercero ?>)</a></td>
      <td style="text-align:center;"><a href="../admin/cuentas_cobrar_detalle_factura.php?cod_tercero=<?php echo $cod_tercero;?>" class="btn btn-warning">Imprimible General</a></td>
    </tr>
  </table>

  <table class="table table-striped">
    <tr>
      <td style="text-align: center;"><strong>FACTURA</strong></td>
      <td style="text-align: center;"><strong>CLIENTE</strong></td>
      <td style="text-align: center;"><strong>TOTAL CREDITO</strong></td>
      <td style="text-align: center;"><strong>TOTAL ABONADO</strong></td>
      <td style="text-align: center;"><strong>TOTAL PENDIENTE</strong></td>
      <td style="text-align: center;"><strong>ABONAR</strong></td>
      <td style="text-align: center;"><strong>FECHA REG</strong></td>
      <td style="text-align: center;"><strong>FECHA PAGO</strong></td>
      <td style="text-align: center;"><strong>VENDEDOR</strong></td>
    </tr>
  <?php
  $calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
  tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
  tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta
  FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
  WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.cod_cuentas_cobrar DESC";
  $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
  $total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
  while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

  $cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
  $cod_info_factura_venta         = $datos_cuenta_cobrar['cod_info_factura_venta'];
  $cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
  $cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
  $monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
  $abonado                        = $datos_cuenta_cobrar['abonado'];
  $subtotal                       = $datos_cuenta_cobrar['subtotal'];
  $mensaje                        = $datos_cuenta_cobrar['mensaje'];
  $fecha                          = $datos_cuenta_cobrar['fecha'];
  $fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
  $vendedor                       = $datos_cuenta_cobrar['vendedor'];
  $monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
  $abonado_smtr                   = $abonado_smtr + $abonado;
  $subtotal_smtr                  = $subtotal_smtr + $subtotal;

  if (($fecha_hoy > $fecha_pago) && ($subtotal > '0')) { $boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; } else { $boton_alerta_caducidad = ''; }
  ?>
    <tr>
      <td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
      <td><font size='3'><?php echo $cliente;?></font></td>
      <td style="text-align: right;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></td>
      <td style="text-align: right;"><font size='3'><a href="../admin/modificar_cuentas_cobrar_caja_registradora.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><?php echo number_format($abonado, 0, ",", ".");?></a></font></td>
      <td style="text-align: right;"><font size='5'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
      <td style="text-align: center;"><a href="../admin/modificar_cuentas_cobrar_caja_registradora.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/base_caja.png alt="Abonar"></a></td>
      <!--<td style="text-align: center;"><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/agregar.png alt="productos"></a></td>-->
      <td style="text-align: center;"><font size='3'><?php echo $fecha;?></font></td>
      <td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>
      <td style="text-align: center;"><font size='3'><?php echo $vendedor; ?></font></td>
    </tr>
    <?php } ?>
  </table>

  <br>

  <table class="table table-striped">
    <tr>
      <td style="text-align: center;"><strong><font size='5'>TOTAL CREDITO</font></strong></td>
      <td style="text-align: center;"><strong><font size='5'>TOTAL ABONADO</font></strong></td>
      <td style="text-align: center;"><strong><font size='5'>TOTAL PENDIENTE</font></strong></td>
      </tr>
      <tr>
      <td style="text-align: center;"><font size='5'><?php echo number_format($monto_deuda_smtr, 0, ",", ".")?></font></a></td>
      <td style="text-align: center;"><font size='5'><?php echo number_format($abonado_smtr, 0, ",", ".");?></font></td>
      <td style="text-align: center;"><font size='5'><?php echo number_format($subtotal_smtr, 0, ",", "."); ?></font></td>
    </tr>
  </table>

</body>
</html>