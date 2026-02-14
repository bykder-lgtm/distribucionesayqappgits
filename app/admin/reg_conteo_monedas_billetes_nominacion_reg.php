<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
//require '../PHPMailer/PHPMailerAutoload.php';
//include_once '../admin/class_php/smtp.conf.outlook.php';

$pagina_local                                                   = $_SERVER['PHP_SELF'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_administrador'])) {

  $fecha_ymd_venta_producto                                     = addslashes($_POST['fecha_ymd_venta_producto']);
  $total_fisico_cierre_caja                                     = addslashes($_POST['total_fisico_cierre_caja']);
  $cod_administrador                                            = intval($_POST['cod_administrador']);

  $total_sistema_contado_efectivo_cierre_caja                   = addslashes($_POST['total_sistema_contado_efectivo_cierre_caja']);
  $total_base_cierre_caja                                       = addslashes($_POST['total_base_cierre_caja']);
  $total_retirar_caja                                           = addslashes($_POST['total_retirar_caja']);
  $total_base_mas_fisico_cierre_caja                            = addslashes($_POST['total_base_mas_fisico_cierre_caja']);
  //$resultado_cierre_caja                                        = addslashes($_POST['resultado_cierre_caja']);

  $total_sistema_contado_transferencia                          = addslashes($_POST['total_sistema_contado_transferencia']);
  $comentario                                                   = addslashes($_POST['comentario']);

  $resultado_cierre_caja                                       = $total_sistema_contado_efectivo_cierre_caja - ($total_fisico_cierre_caja - $total_base_cierre_caja);

  $moneda_50                                                    = intval($_POST['moneda_50']); 
  $moneda_100                                                   = intval($_POST['moneda_100']); 
  $moneda_200                                                   = intval($_POST['moneda_200']); 
  $moneda_500                                                   = intval($_POST['moneda_500']); 
  $moneda_1000                                                  = intval($_POST['moneda_1000']); 
  $moneda_2000                                                  = intval($_POST['moneda_2000']); 
  $moneda_5000                                                  = intval($_POST['moneda_5000']); 
  $moneda_10000                                                 = intval($_POST['moneda_10000']); 
  $moneda_20000                                                 = intval($_POST['moneda_20000']); 
  $moneda_50000                                                 = intval($_POST['moneda_50000']); 
  $moneda_100000                                                = intval($_POST['moneda_100000']);

  $retirar_moneda_50                                            = intval($_POST['retirar_moneda_50']); 
  $retirar_moneda_100                                           = intval($_POST['retirar_moneda_100']); 
  $retirar_moneda_200                                           = intval($_POST['retirar_moneda_200']); 
  $retirar_moneda_500                                           = intval($_POST['retirar_moneda_500']); 
  $retirar_moneda_1000                                          = intval($_POST['retirar_moneda_1000']); 
  $retirar_moneda_2000                                          = intval($_POST['retirar_moneda_2000']); 
  $retirar_moneda_5000                                          = intval($_POST['retirar_moneda_5000']); 
  $retirar_moneda_10000                                         = intval($_POST['retirar_moneda_10000']); 
  $retirar_moneda_20000                                         = intval($_POST['retirar_moneda_20000']); 
  $retirar_moneda_50000                                         = intval($_POST['retirar_moneda_50000']); 
  $retirar_moneda_100000                                        = intval($_POST['retirar_moneda_100000']);

  $moneda_50_actual                                             = $moneda_50 - $retirar_moneda_50; 
  $moneda_100_actual                                            = $moneda_100 - $retirar_moneda_100; 
  $moneda_200_actual                                            = $moneda_200 - $retirar_moneda_200; 
  $moneda_500_actual                                            = $moneda_500 - $retirar_moneda_500; 
  $moneda_1000_actual                                           = $moneda_1000 - $retirar_moneda_1000; 
  $moneda_2000_actual                                           = $moneda_2000 - $retirar_moneda_2000; 
  $moneda_5000_actual                                           = $moneda_5000 - $retirar_moneda_5000; 
  $moneda_10000_actual                                          = $moneda_10000 - $retirar_moneda_10000; 
  $moneda_20000_actual                                          = $moneda_20000 - $retirar_moneda_20000; 
  $moneda_50000_actual                                          = $moneda_50000 - $retirar_moneda_50000; 
  $moneda_100000_actual                                         = $moneda_100000 - $retirar_moneda_100000; 
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $fecha_anyo                                                   = $fecha_ymd_venta_producto;
  $fecha_anyo_seg                                               = strtotime($fecha_anyo);
  $fecha_dia                                                    = date("Y-m-d", $fecha_anyo_seg);
  $anyo                                                         = date("Y", $fecha_anyo_seg);
  $fecha_mes                                                    = date("Y-m", strtotime($fecha_anyo));
  $hora                                                         = date("H:i:s");
  $hora_cierre_caja                                             = date("H:i:s");
  $fecha_time_cierre_caja                                       = time();
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $obtener_info_cliente = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
  $resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
  $info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

  $usuario_cuenta                                               = $info_cliente['cuenta'];
  $cuenta                                                       = $info_cliente['cuenta'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_conteo_monedas_billetes_nominacion'";
  $exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
  $datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);

  //$cod_conteo_monedas_billetes_nominacion                       = $datos_autoincremento_sesion['AUTO_INCREMENT'];
  $cod_conteo_monedas_billetes_nominacion                       = 1;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $pagina                                                       = "../admin/factura_conteo_monedas_billetes_nominacion_opcion_imprimir.php"."?cod_conteo_monedas_billetes_nominacion=".$cod_conteo_monedas_billetes_nominacion;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $sql_data = sprintf("UPDATE tbl15_conteo_monedas_billetes_nominacion SET total_fisico_cierre_caja = '$total_fisico_cierre_caja', vendedor = '$cuenta_actual', fecha_anyo = '$fecha_anyo', fecha_mes = '$fecha_mes', 
  hora_cierre_caja = '$hora_cierre_caja', fecha_time_cierre_caja = '$fecha_time_cierre_caja', cod_administrador = '$cod_administrador', total_sistema_contado_efectivo_cierre_caja = '$total_sistema_contado_efectivo_cierre_caja', 
  total_base_cierre_caja = '$total_base_cierre_caja', total_retirar_caja = '$total_retirar_caja', total_base_mas_fisico_cierre_caja = '$total_base_mas_fisico_cierre_caja', 
  resultado_cierre_caja = '$resultado_cierre_caja', total_sistema_contado_transferencia = '$total_sistema_contado_transferencia', comentario = '$comentario', 
  moneda_50 = '$moneda_50', moneda_100 = '$moneda_100', moneda_200 = '$moneda_200', moneda_500 = '$moneda_500', moneda_1000 = '$moneda_1000', moneda_2000 = '$moneda_2000', moneda_5000 = '$moneda_5000', 
  moneda_10000 = '$moneda_10000', moneda_20000 = '$moneda_20000', moneda_50000 = '$moneda_50000', moneda_100000 = '$moneda_100000', 
  retirar_moneda_50 = '$retirar_moneda_50', retirar_moneda_100 = '$retirar_moneda_100', retirar_moneda_200 = '$retirar_moneda_200', retirar_moneda_500 = '$retirar_moneda_500', 
  retirar_moneda_1000 = '$retirar_moneda_1000', retirar_moneda_2000 = '$retirar_moneda_2000', retirar_moneda_5000 = '$retirar_moneda_5000', retirar_moneda_10000 = '$retirar_moneda_10000', 
  retirar_moneda_20000 = '$retirar_moneda_20000', retirar_moneda_50000 = '$retirar_moneda_50000', retirar_moneda_100000 = '$retirar_moneda_100000', 
  moneda_50_actual = '$moneda_50_actual', moneda_100_actual = '$moneda_100_actual', moneda_200_actual = '$moneda_200_actual', moneda_500_actual = '$moneda_500_actual', 
  moneda_1000_actual = '$moneda_1000_actual', moneda_2000_actual = '$moneda_2000_actual', moneda_5000_actual = '$moneda_5000_actual', moneda_10000_actual = '$moneda_10000_actual', 
  moneda_20000_actual = '$moneda_20000_actual', moneda_50000_actual = '$moneda_50000_actual', moneda_100000_actual = '$moneda_100000_actual'
  WHERE cod_conteo_monedas_billetes_nominacion = '$cod_conteo_monedas_billetes_nominacion'");
  $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

  $agregar_operacion = "INSERT INTO tbl15_conteo_monedas_billetes_nominacion_historial (cod_conteo_monedas_billetes_nominacion, total_fisico_cierre_caja, vendedor, fecha_anyo, fecha_mes, hora_cierre_caja, 
  fecha_time_cierre_caja, cod_administrador, total_sistema_contado_efectivo_cierre_caja, total_base_cierre_caja, total_retirar_caja, total_base_mas_fisico_cierre_caja, resultado_cierre_caja, 
  total_sistema_contado_transferencia, comentario, 
  moneda_50, moneda_100, moneda_200, moneda_500, moneda_1000, moneda_2000, moneda_5000, moneda_10000, moneda_20000, moneda_50000, moneda_100000, 
  retirar_moneda_50, retirar_moneda_100, retirar_moneda_200, retirar_moneda_500, retirar_moneda_1000, retirar_moneda_2000, 
  retirar_moneda_5000, retirar_moneda_10000, retirar_moneda_20000, retirar_moneda_50000, retirar_moneda_100000, 
  moneda_50_actual, moneda_100_actual, moneda_200_actual, moneda_500_actual, moneda_1000_actual, moneda_2000_actual, moneda_5000_actual, moneda_10000_actual, moneda_20000_actual, moneda_50000_actual, moneda_100000_actual)
  VALUES ('$cod_conteo_monedas_billetes_nominacion', '$total_fisico_cierre_caja', '$cuenta_actual', '$fecha_anyo', '$fecha_mes', '$hora_cierre_caja', 
  '$fecha_time_cierre_caja', '$cod_administrador', 
  '$total_sistema_contado_efectivo_cierre_caja', '$total_base_cierre_caja', '$total_retirar_caja', '$total_base_mas_fisico_cierre_caja', '$resultado_cierre_caja', 
  '$total_sistema_contado_transferencia', '$comentario', 
  '$moneda_50', '$moneda_100', '$moneda_200', '$moneda_500', '$moneda_1000', '$moneda_2000', '$moneda_5000', '$moneda_10000', '$moneda_20000', '$moneda_50000', '$moneda_100000', 
  '$retirar_moneda_50', '$retirar_moneda_100', '$retirar_moneda_200', '$retirar_moneda_500', '$retirar_moneda_1000', '$retirar_moneda_2000', 
  '$retirar_moneda_5000', '$retirar_moneda_10000', '$retirar_moneda_20000', '$retirar_moneda_50000', '$retirar_moneda_100000', 
  '$moneda_50_actual', '$moneda_100_actual', '$moneda_200_actual', '$moneda_500_actual', '$moneda_1000_actual', '$moneda_2000_actual', '$moneda_5000_actual', '$moneda_10000_actual', '$moneda_20000_actual', '$moneda_50000_actual', '$moneda_100000_actual')";
  $resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
?>
  <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>