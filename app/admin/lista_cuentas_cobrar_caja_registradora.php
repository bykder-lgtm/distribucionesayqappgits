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
  <table class="table table-striped">
    <tr>
      <td style="text-align:center;"><a href="../admin/lista_caja_registradora.php" class="btn btn-warning">Regresar</a></td>
      <td style="text-align:center;"><a href="#" class="btn btn-info">Lista Cuentas Por Cobrar</a></td>
    </tr>
  </table>


  <table class="table table-striped">
      <thead>
        <tr>
          <th style="text-align:center">NIT</th>
          <th style="text-align:center">CLIENTE</th>
          <th style="text-align:center">TOTAL DEUDA</th>
          <th style="text-align:center">TOTAL ABONADO</th>
          <th style="text-align:center">PENDIENTE</th>
          <th style="text-align:center">DIRECCION</th>
          <th style="text-align:center">TELEFONO</th>
        </tr>
      </thead>
      <tbody>
  <?php
  $calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, 
  tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, 
  Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
  subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
  tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
  FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
  GROUP BY tbl15_cuentas_cobrar.cod_tercero ORDER BY tbl15_tercero.nombre1_tercero";
  $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
  while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {
    
    $cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
    $monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
    $subtotal                      = $datos_cuenta_cobrar['subtotal'];
    $abonado                       = $datos_cuenta_cobrar['abonado'];
    $cod_tercero                   = $datos_cuenta_cobrar['cod_tercero'];
    $cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
    $cliente                       = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
    $direccion_tercero             = $datos_cuenta_cobrar['direccion_tercero'];
    $telefono1_tercero             = $datos_cuenta_cobrar['telefono1_tercero'];
    $nombre_ciudad                 = $datos_cuenta_cobrar['nombre_ciudad'];
    $identificacion_tercero        = $datos_cuenta_cobrar['identificacion_tercero'];
  ?>
      <tr>
        <td><font size='2'><a href="../admin/cuentas_cobrar_detalle_factura_caja_registradora.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $identificacion_tercero;?></a></font></td>
        <td><font size='2'><a href="../admin/cuentas_cobrar_detalle_factura_caja_registradora.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $cliente;?></a></font></td>
        <td style="text-align: right;"><font size='2'><a href="../admin/cuentas_cobrar_detalle_factura_caja_registradora.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo number_format($monto_deuda, 0, ",", "."); ?></a></font></td>
        <td style="text-align: right;"><font size='2'><a href="../admin/cuentas_cobrar_detalle_factura_caja_registradora.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo number_format($abonado, 0, ",", "."); ?></a></font></td>
        <?php if ($subtotal <= 0) { ?> <td style="text-align: right;"><font size='2'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td><?php } else { ?> <td style="text-align: right;"><font size='2'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td> <?php } ?>
        <td style="text-align: right;"><font size='2'><?php echo $direccion_tercero; ?></font></td>
        <td style="text-align: right;"><font size='2'><?php echo $telefono1_tercero; ?></font></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

</body>
</html>