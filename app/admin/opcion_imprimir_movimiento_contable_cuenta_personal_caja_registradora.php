<?php $serguridad_pagina = 1; ?>
<?php $cod_tipo_accion_caja_registradora = "1"; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<?php include_once('../admin/01_modulo_permisos.php'); ?>
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

<script type="text/javascript" src="../js/qrious.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<style> .deshabilitar_boton { pointer-events: none; } </style>
</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<body>
<?php 
if (isset($_GET['cod_movimiento_contable_cuenta_personal_concepto'])) { 

  $cod_movimiento_contable_cuenta_personal_concepto    = intval($_GET['cod_movimiento_contable_cuenta_personal_concepto']);

  $sql_concepto_movimiento_caja = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (cod_movimiento_contable_cuenta_personal_concepto = '$cod_movimiento_contable_cuenta_personal_concepto')";
  $resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
  $info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);

  $codigo_puc                                             = $info_concepto_movimiento_caja['codigo_puc'];
  $nombre_puc                                             = $info_concepto_movimiento_caja['nombre_puc'];
  $simbolo_tipo_operacion                                 = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];
  $costo_movimiento_contable                              = $info_concepto_movimiento_caja['costo_movimiento_contable'];
  $comentario                                             = $info_concepto_movimiento_caja['comentario'];
  $cod_tercero                                            = $info_concepto_movimiento_caja['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
  $sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
  $total_cliente = mysqli_fetch_assoc($consulta_cliente);

  $identificacion_tercero         = $total_cliente['identificacion_tercero'];
  $nombre1_tercero                = $total_cliente['nombre1_tercero'];
  $apellido1_tercero              = $total_cliente['apellido1_tercero'];
  $nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
  $fecha_dmy                      = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
  $fecha_impr                  = date("Ymd");
  $hora_impr                   = date("His");
?>
  <script>
  function printPageArea(areaID){

  var cod_egreso_strpad = <?php echo $cod_movimiento_contable_cuenta_personal_concepto; ?>;
  $("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_egreso_strpad+'&size=25&codetype=Code128&print=false"/>');

  var printContent = document.getElementById(areaID);
  var WinPrint = window.open('', '', 'width=400,height=1000');
  WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
  }
  </script>
  <table class="table table-striped">
    <tr>
      <td><font color='black' size= "+3">ID GASTO:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_movimiento_contable_cuenta_personal_concepto; ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">CONCEPTO:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_puc ?> (<?php echo $codigo_puc ?>) | <?php echo $nombre1_tercero ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">VALOR:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($costo_movimiento_contable, 0, ",", "."); ?></font></td>
    </tr>
  </table>

  <table class="table table-striped">
    <tr>
      <td style="text-align:center; width:50%"><a href="../admin/facturacion_caja_registradora.php" class="btn btn-primary">Ir a Caja Registradora</a></td>
      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center; width:50%"><button id="btnImprimirGasto"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
      <?php } ?>
      <th style="text-align:center"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></th>
    </tr>
  </table>

  <script>  
  $(document).ready(function(){  
    $('#btnImprimirGasto').click(function(){
    var cod_movimiento_contable_cuenta_personal_concepto = <?php echo $cod_movimiento_contable_cuenta_personal_concepto ?>;
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_ingreso_egreso_gasto_movimiento.contable_personal_ticket_pos.php", method:"GET", data:{cod_movimiento_contable_cuenta_personal_concepto:cod_movimiento_contable_cuenta_personal_concepto, campo:"cod_movimiento_contable_cuenta_personal_concepto", id:cod_movimiento_contable_cuenta_personal_concepto, origen:origen }, 
       success: function(response) {
           if(response==1){
               //alert('Imprimiendo....');
           } else {
               //alert('Error');
           }
       }
      });  
    });
  });  
  </script>
<?php } ?>


<hr>
<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../admin/lista_caja_virtual.php" class="btn btn-warning">Ir a Modulo Administrativo</a></td>
  </tr>
</table>

</body>
</html>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:12pt;"><strong><?php echo $cabecera_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>MOVIMIENTO</strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong>CONCEPTO</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>VALOR</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:8pt;"><strong>COMENTARIO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:8pt;"><strong>FECHA</strong></td>
</tr>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_puc ?> (<?php echo $codigo_puc ?>) | <?php echo $nombre1_tercero ?></strong></td>
<td style="text-align: center; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($costo_movimiento_contable, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo $comentario ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong><?php echo $fecha_dmy ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_php"></div></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_movimiento_contable_cuenta_personal_concepto ?></strong>_imp_nrm_cajregegret</td>
  </tr>
</table>

        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->