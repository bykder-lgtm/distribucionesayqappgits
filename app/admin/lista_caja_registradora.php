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
    <td style="text-align:center;"><a href="../admin/facturacion_venta_temporal_producto_manual_caja_registradora_pos.php" class="btn btn-warning">Ir a Ventas</a></td>
    <td style="text-align:center;"><a href="../admin/facturacion_compra_temporal_producto_manual_caja_registradora_pos.php" class="btn btn-info">Ir a Compras</a></td>
    <td style="text-align:center;"><a href="../admin/lista_cuentas_cobrar_caja_registradora.php" class="btn btn-info">Ir a Abonos (Cuentas Cobrar)</a></td>
    <td style="text-align:center;"><a href="../admin/lista_tercero.php" class="btn btn-warning">Modulo Administrativo</a></td>

  </tr>
</table>

</body>
</html>
