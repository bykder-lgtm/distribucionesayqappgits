<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../js/qrcode.js"></script>
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
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local = $_SERVER['PHP_SELF'];

$cod_info_factura_sticker             = intval($_GET['cod_info_factura_sticker']);
$pagina                               = addslashes($_GET['pagina']).'?cod_info_factura_sticker='.$cod_info_factura_sticker;

$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
$info_emp = mysqli_fetch_assoc($consultar_informacion);

$titulo_emp                             = $info_emp['titulo'];
$desarrollador_emp                      = $info_emp['desarrollador'];
$pag_desarrollador_emp                  = $info_emp['pag_desarrollador'];
$correo_desarrollador_emp               = $info_emp['correo_desarrollador'];
$anyo_emp                               = $info_emp['anyo'];
$nombre_emp                             = $info_emp['nombre'];
$eslogan_emp                            = $info_emp['eslogan'];
$nombre_propietario_emp                 = $info_emp['nombre_propietario'];
$cedula_propietario_emp                 = $info_emp['cedula_propietario'];
$res_emp                                = $info_emp['res'];
$res1_emp                               = $info_emp['res1'];
$res2_emp                               = $info_emp['res2'];
$fecha_res_emp                          = $info_emp['fecha_res'];
$prefijo_res_emp                        = $info_emp['prefijo_res'];
$pais_emp                               = $info_emp['pais'];
$departamento_emp                       = $info_emp['departamento'];
$ciudad_emp                             = $info_emp['ciudad'];
$localidad_emp                          = $info_emp['localidad'];
$direccion_emp                          = $info_emp['direccion'];
$correo_emp                             = $info_emp['correo'];
$cabecera_emp                           = $info_emp['cabecera'];
$telefono_emp                           = $info_emp['telefono'];
$nit_empresa_emp                        = $info_emp['nit_empresa'];
$regimen_emp                            = $info_emp['regimen'];
$propietario_nombres_apellidos_emp      = $info_emp['propietario_nombres_apellidos'];
$propietario_nit_emp                    = $info_emp['propietario_nit'];
$propietario_url_firma_emp              = $info_emp['propietario_url_firma'];
$url_encuesta_experiencia_compra_emp    = $info_emp['url_encuesta_experiencia_compra'];
$nombre_empresa_sticker_emp             = $info_emp['nombre_empresa_sticker'];

if ($cod_estado_url_pagina_sticker_global == '1') { $url_encuesta_experiencia_compra_emp = $info_emp['url_encuesta_experiencia_compra']; } else { $url_encuesta_experiencia_compra_emp = '.'; }
if ($cod_estado_nombre_empresa_sticker_global == '1') { $nombre_empresa_sticker_emp = $info_emp['nombre_empresa_sticker']; } else { $nombre_empresa_sticker_emp = '.'; }
if ($cod_estado_nombre_desarrollador_sticker_global == '1') { $titulo_emp = $info_emp['titulo']; } else { $titulo_emp = '.'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_sticker WHERE (cod_info_factura_sticker = '$cod_info_factura_sticker')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                         = $info_fact['cod_factura'];
$fecha_anyo                          = $info_fact['fecha_anyo'];
$fecha_hora                          = $info_fact['fecha_hora'];
$total_precio_compra                 = $info_fact['total_precio_compra'];
$total_precio_venta                  = $info_fact['total_precio_venta'];
$total_datos_data                    = $info_fact['total_datos_data'];
$cod_tercero                         = $info_fact['cod_tercero'];
$cuenta                              = $info_fact['cuenta'];
$vlr_cancelado                       = $info_fact['vlr_cancelado'];
$vlr_vuelto                          = $info_fact['vlr_vuelto'];
$cod_tipo_pago                       = $info_fact['cod_tipo_pago'];
$cod_administrador                   = $info_fact['cod_administrador'];
$cod_tipo_forma_pago                 = $info_fact['cod_tipo_forma_pago'];
$nombre_tipo_factura                 = $info_fact['nombre_tipo_factura'];
$nombre_tipo_moneda                  = $info_fact['nombre_tipo_moneda'];
$cod_resolucion_facturacion          = $info_fact['cod_resolucion_facturacion'];
$descuento_ptj                       = $info_fact['descuento_ptj'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                         = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

$cod_tipo_resolucion_facturacion        = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
$nombre_tipo_resolucion_facturacion     = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$numero_resolucion_facturacion          = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
$ini_resolucion_facturacion             = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
$fin_resolucion_facturacion             = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
$prefijo_resolucion_facturacion         = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
$fecha_resolucion_facturacion           = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
$vigencia_meses_resolucion_facturacion  = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
$nombre_tipo_estado                     = $matriz_resolucion_facturacion['nombre_tipo_estado'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                     = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                            = $matriz_usario_vendedor['cod_caja'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva, 
Sum(total_venta_producto*(descuento_ptj/100)) AS total_desc, Sum(total_venta_producto) AS total_venta_neta FROM tbl15_sticker_producto 
WHERE (cod_info_factura_sticker= '$cod_info_factura_sticker')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_temporal);

$total_venta_neta                    = ($suma['total_venta_neta']);
$subtotal_base                       = ($suma['subtotal_base']);
$total_desc                          = ($suma['total_desc']);
$total_iva                           = ($suma['total_iva']);
$total_venta_temp                    = ($suma['total_venta']);
$vlr_cambio                          = ($vlr_cancelado - $total_venta_temp);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$cod_info_factura_strpad   = str_pad($cod_info_factura_sticker, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora                                = date("His");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
$fecha_hoy                           = date("Y-m-d");
?>
<script>
function printPageArea(areaID){

var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;

var printContent = document.getElementById(areaID);
document.getElementById("listo").focus();
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<div class="table-responsive">
<center>
<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><font color='black' size= "+3">STIKERS GUARDADOS CORRECTAMENTE</font></td>
  </tr>
  <tr>
    <td style="text-align:center;"><font color='black' size= "+3">ID NO: <?php echo $cod_info_factura_sticker; ?></font></td>
  </tr>
</table>
<table class="table table-striped">
  <tr>
    <th style="text-align:center;">REGRESAR</th>
    <th style="text-align:center;">IMP EN HOJA CARTA</th>
    <!--<th style="text-align:center;"></th>-->
    <th style="text-align:center;"><?php echo $nombre_tipo_impresora_zebra_ticket?></th>
    <th style="text-align:center;">IMP POS 80MM</th>
    <th style="text-align:center;">EXPORTAR XLSX</th>
    <th style="text-align:center;">EXPORTAR XLS</th>
    <th style="text-align:center;">EXPORTAR CSV</th>
  </tr>
  <tr>
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a></td>
    <td style="text-align:center;"><a href="../admin/imprimir_stiker_productos_estante_con_barras.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker?>&cod_factura=<?php echo $cod_factura?>&fecha=<?php echo $fecha_hoy?>&origen=PARACLINICOS&destino=FACTURA" target="_blank"><img src="../imagenes/imprimir_.png"></a></td>
    <!--<td style="text-align:center;"><a href="../admin/imprimir_stiker_productos_estante_con_barras_pos80_pdf.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker?>&cod_factura=<?php echo $cod_factura?>&fecha=<?php echo $fecha_hoy?>&origen=PARACLINICOS&destino=FACTURA" target="_blank"><img src="../imagenes/imprimir_.png"></a></td>-->
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos_ticket.png" alt="imprimir"></a></td>
    <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <td style="text-align:center;"><a href="../admin/descargar_sticker_producto_xlsx.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
    <td style="text-align:center;"><a href="../admin/descargar_sticker_producto_html_xls.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
    <td style="text-align:center;"><a href="../admin/descargar_sticker_producto_csv.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker?>"><img src=../imagenes/btn_csv.png alt="imprimir_peq"></a></td>
  </tr>
</table>
</center>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if (($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 57x30MM') || ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 32x57MM')) { ?>
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;">
<?php
  $incremento                  = 0;
  $arrayCodigos                = array();
  $cod_letra_numero_compra     = 0;
  $cod_letra_numero_venta      = 0;
  $nombre_letra_numero_compra  = 0;
  $nombre_letra_numero_venta   = 0;
  $aument_for_57mm             = 0;

  $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
  nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
  FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_sticker_producto          = $datos['cod_sticker_producto'];
    $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
    $und_venta                     = $datos['und_venta'];
    $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
    $cod_producto_barra            = $datos['cod_producto_barra'];
    $precio_compra_producto        = intval($datos['precio_compra_producto']);
    $precio_venta_producto         = intval($datos['precio_venta_producto']);
    //$fecha_ult_compra              = $datos['fecha_ult_compra'];
    $arrayCodigos[]                = (string)$cod_producto_barra; 
    $cantidad_contadores           = substr_count($precio_compra_producto, '0');
    $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
    $cantidad_separaciones         = count($contar_palabra);

    $cantidad_digitos_compra       = strlen($precio_compra_producto);
    $matriz_digitos_compra         = str_split($precio_compra_producto);
    $codif_letra_precio_compra     = "";

    $cantidad_digitos_venta        = strlen($precio_venta_producto);
    $matriz_digitos_venta          = str_split($precio_venta_producto);
    $codif_letra_precio_venta      = "";

    $total_caracteres              = strlen($nombre_producto);
    $contar_ceros_compra           = 0;
    $contar_ceros_venta            = 0;

    if ($total_caracteres > 28) {
      $nombre_producto1           = substr($nombre_producto, 0, 28);
      $nombre_producto2           = substr($nombre_producto, 28, 27);
    } else {
      $nombre_producto1              = ".";
      $nombre_producto2              = substr($nombre_producto, 0, 28);
    }


    for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
      $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

      $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
      $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
      $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

      if ($cod_letra_numero_compra == '0') {
        $nombre_letra_numero_compra = $contar_ceros_compra++;
      } else {
        $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
      }

      $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
    }

    for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

      $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

      $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
      $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
      $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

      if ($cod_letra_numero_venta == '0') { 
        $nombre_letra_numero_venta = $contar_ceros_venta++;
      } else {
        $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
      }

      $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
    }

    $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $datos_producto = mysqli_fetch_assoc($consulta_producto);

    $cod_tercero                = $datos_producto['cod_tercero'];
    $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
    $fecha_compra               = date("mY", strtotime($fecha_ult_compra));

    $incremento++;

  for ($i=0; $i < $und_venta; $i++) {
  $aument_for_57mm++;
?>
  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <?php if (($aument_for_57mm <> 1)) { ?>
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>.</strong></td>
  </tr>
  <?php } ?>

  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
  </tr>
  <?php if ($nombre_producto2 <> '') { ?>
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto2 ?></strong></td>
  </tr>
  <?php } ?>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
  </tr>
  </table>

  <table width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
  <td style="text-align: center; width:99%; font-family: Courier; font-size:7pt;"><strong>
    <?php echo $cod_producto_barra ?> 
    <?php if ($cod_estado_codif_precio_compra_global == '1') { echo $codif_letra_precio_compra; } else { echo ""; } ?>
    <?php if ($cod_estado_codif_precio_venta_global == '1') { echo $codif_letra_precio_venta; } else { echo ""; } ?>
    <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo $precio_venta_producto; } else { echo ""; } ?>
    <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $fecha_compra; } else { echo ""; } ?>
    <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo $cod_tercero; } else { echo ""; } ?>
    <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $cod_factura_compra_producto; } else { echo ""; } ?>
    <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $cod_factura_compra_producto; } else { echo ""; } ?>
  </strong></td>
  </tr>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
  <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq15.png"></td>
  <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $url_encuesta_experiencia_compra_emp ?></strong></td>
  <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq15.png"></td>
  </tr>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
  <td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong><img src="../imagenes/qr_vacio_peq15.png"></strong></td>
  <td style="text-align: center; width:78%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_empresa_sticker_emp ?></strong></td>
  <td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong><img src="../imagenes/qr_vacio_peq15.png"></strong></td>
  </tr>
  </table>
  <div style="page-break-after: always;"></div> 
  <?php } ?>

  <?php } ?>
  </table>
  <div>
<?php } ?>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 57x40MM') { ?>
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;">
  <?php
  $incremento                  = 0;
  $arrayCodigos                = array();
  $cod_letra_numero_compra     = 0;
  $cod_letra_numero_venta      = 0;
  $nombre_letra_numero_compra  = 0;
  $nombre_letra_numero_venta   = 0;
  $aument_for_40mm             = 0;

  $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
  nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
  FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_sticker_producto          = $datos['cod_sticker_producto'];
    $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
    $und_venta                     = $datos['und_venta'];
    $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
    $cod_producto_barra            = $datos['cod_producto_barra'];
    $precio_compra_producto        = intval($datos['precio_compra_producto']);
    $precio_venta_producto         = intval($datos['precio_venta_producto']);
    //$fecha_ult_compra              = $datos['fecha_ult_compra'];
    $arrayCodigos[]                = (string)$cod_producto_barra; 
    $cantidad_contadores           = substr_count($precio_compra_producto, '0');
    $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
    $cantidad_separaciones         = count($contar_palabra);

    $cantidad_digitos_compra       = strlen($precio_compra_producto);
    $matriz_digitos_compra         = str_split($precio_compra_producto);
    $codif_letra_precio_compra     = "";

    $cantidad_digitos_venta        = strlen($precio_venta_producto);
    $matriz_digitos_venta          = str_split($precio_venta_producto);
    $codif_letra_precio_venta      = "";

    $total_caracteres              = strlen($nombre_producto);
    $contar_ceros_compra           = 0;
    $contar_ceros_venta            = 0;

    if ($total_caracteres > 28) {
      $nombre_producto1              = substr($nombre_producto, 0, 28);
      $nombre_producto2              = substr($nombre_producto, 28, 27);
    } else {
      $nombre_producto1              = ".";
      $nombre_producto2              = substr($nombre_producto, 0, 28);
    }

    for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
      $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

      $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
      $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
      $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

      if ($cod_letra_numero_compra == '0') {
        $nombre_letra_numero_compra = $contar_ceros_compra++;
      } else {
        $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
      }
      $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
    }

    for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

      $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

      $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
      $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
      $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

      if ($cod_letra_numero_venta == '0') { 
        $nombre_letra_numero_venta = $contar_ceros_venta++;
      } else {
        $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
      }
      $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
    }

    $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $datos_producto = mysqli_fetch_assoc($consulta_producto);

    $cod_tercero                = $datos_producto['cod_tercero'];
    $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
    $fecha_compra               = date("mY", strtotime($fecha_ult_compra));

    $incremento++;

    for ($i=0; $i < $und_venta; $i++) {
      $aument_for_40mm++;
    ?>
      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
      <?php if (($aument_for_40mm <> 1)) { ?>
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>.</strong></td>
        </tr>
      <?php } ?>

        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
        </tr>
      <?php if ($nombre_producto2 <> '') { ?>
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto2 ?></strong></td>
        </tr>
      <?php } ?>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
        </tr>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;">
          <strong>
          <?php echo $cod_producto_barra ?> 
          <?php if ($cod_estado_codif_precio_compra_global == '1') { echo $codif_letra_precio_compra; } else { echo ""; } ?>
          <?php if ($cod_estado_codif_precio_venta_global == '1') { echo $codif_letra_precio_venta; } else { echo ""; } ?>
          <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo $precio_venta_producto; } else { echo ""; } ?>
          <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $fecha_compra; } else { echo ""; } ?>
          <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo $cod_tercero; } else { echo ""; } ?>
          <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $cod_factura_compra_producto; } else { echo ""; } ?>
          </strong>
          </td>
        </tr>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; font-family: Courier; font-size:7pt;" id="qrcode"><img src="../imagenes/qr_vacio_peq.png"></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_empresa_sticker_emp ?></strong></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $cod_sticker_producto ?></strong></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $cod_info_factura_sticker ?></strong></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $titulo_emp ?></strong></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq.png"></td>
        </tr>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq.png"></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $url_encuesta_experiencia_compra_emp ?></strong></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq.png"></td>
        </tr>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq.png"></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><strong><?php echo $propietario_nombres_apellidos_emp ?></strong></td>
          <td style="text-align: center; font-family: Courier; font-size:7pt;"><img src="../imagenes/qr_vacio_peq.png"></td>
        </tr>
      </table>
    <?php } ?>

  <?php } ?>
  <div>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 57x40MM - DOUBLE') { ?>
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;">
  <?php
  $incremento                  = 0;
  $arrayCodigos                = array();
  $cod_letra_numero_compra     = 0;
  $cod_letra_numero_venta      = 0;
  $nombre_letra_numero_compra  = 0;
  $nombre_letra_numero_venta   = 0;
  $aument_for_40mm             = 0;
  $aument_for_40mm_dual        = 0;

  $sql_total_sticker = "SELECT SUM(und_venta) AS total_sticker FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta_total_sticker = mysqli_query($conectar, $sql_total_sticker) or die(mysqli_error($conectar));
  $datos_total_sticker = mysqli_fetch_assoc($consulta_total_sticker);

  $total_sticker          = $datos_total_sticker['total_sticker'];

  $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
  nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
  FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_sticker_producto          = $datos['cod_sticker_producto'];
    $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
    $und_venta                     = $datos['und_venta'];
    $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
    $cod_producto_barra            = $datos['cod_producto_barra'];
    $precio_compra_producto        = intval($datos['precio_compra_producto']);
    $precio_venta_producto         = intval($datos['precio_venta_producto']);
    //$fecha_ult_compra              = $datos['fecha_ult_compra'];
    $arrayCodigos[]                = (string)$cod_producto_barra; 
    $cantidad_contadores           = substr_count($precio_compra_producto, '0');
    $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
    $cantidad_separaciones         = count($contar_palabra);

    $cantidad_digitos_compra       = strlen($precio_compra_producto);
    $matriz_digitos_compra         = str_split($precio_compra_producto);
    $codif_letra_precio_compra     = "";

    $cantidad_digitos_venta        = strlen($precio_venta_producto);
    $matriz_digitos_venta          = str_split($precio_venta_producto);
    $codif_letra_precio_venta      = "";

    $total_caracteres              = strlen($nombre_producto);
    $contar_ceros_compra           = 0;
    $contar_ceros_venta            = 0;
    $nombre_producto1              = substr($nombre_producto, 0, 50);
/*
    if ($total_caracteres > 50) {
      $nombre_producto1              = substr($nombre_producto, 0, 50);
      $nombre_producto2              = substr($nombre_producto, 50, 49);
    } else {
      $nombre_producto1              = "";
      $nombre_producto2              = substr($nombre_producto, 0, 50);
    }
*/
    for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
      $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

      $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
      $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
      $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

      if ($cod_letra_numero_compra == '0') {
        $nombre_letra_numero_compra = $contar_ceros_compra++;
      } else {
        $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
      }
      $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
    }

    for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

      $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

      $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
      $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
      $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

      if ($cod_letra_numero_venta == '0') { 
        $nombre_letra_numero_venta = $contar_ceros_venta++;
      } else {
        $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
      }
      $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
    }

    $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $datos_producto = mysqli_fetch_assoc($consulta_producto);

    $cod_tercero                = $datos_producto['cod_tercero'];
    $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
    $fecha_compra               = date("mY", strtotime($fecha_ult_compra));

    $incremento++;

    for ($contador_dual = 0; $contador_dual < $und_venta; $contador_dual++) {
      $aument_for_40mm++;
      $aument_for_40mm_dual++;
      $modulo_doble_sticker = $aument_for_40mm_dual % 2;
    ?>
      <?php if (($modulo_doble_sticker == '0')) { ?>
        <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
          <tr>
            <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>----------------------------------</strong></td>
          </tr>
        </table>
      <?php } ?>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
        </tr>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
        </tr>
      </table>

      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
          <td style="text-align: center; width:98%; font-family: Courier; font-size:8pt;">
          <strong>
          <?php echo $cod_producto_barra ?> 
          <?php if ($cod_estado_codif_precio_compra_global == '1') { echo $codif_letra_precio_compra; } else { echo ""; } ?>
          <?php if ($cod_estado_codif_precio_venta_global == '1') { echo $codif_letra_precio_venta; } else { echo ""; } ?>
          <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo $precio_venta_producto; } else { echo ""; } ?>
          <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $fecha_compra; } else { echo ""; } ?>
          <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo $cod_tercero; } else { echo ""; } ?>
          <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $cod_factura_compra_producto; } else { echo ""; } ?>
          </strong>
          </td>
        </tr>
      </table>
      <?php if (($total_sticker <> $aument_for_40mm_dual) && ($modulo_doble_sticker == '0')) { ?>
        <div style="page-break-after: always;"></div>      
      <?php } ?>

    <?php } ?>

  <?php } ?>
  <div>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 100x100MM TRIPLE') { ?>
    <div id="area_imprimible_invisible" style="width: 99%; text-align: center;">
      <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
        <tr>
    <?php
    $incremento                  = 0;
    $arrayCodigos                = array();
    $cod_letra_numero_compra     = 0;
    $cod_letra_numero_venta      = 0;
    $nombre_letra_numero_compra  = 0;
    $nombre_letra_numero_venta   = 0;
    $aument_for_40mm             = 0;
    $aument_for_40mm_triple      = 0;
    $columnas_por_fila           = 3;

    $sql_total_sticker = "SELECT SUM(und_venta) AS total_sticker FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
    $consulta_total_sticker = mysqli_query($conectar, $sql_total_sticker) or die(mysqli_error($conectar));
    $datos_total_sticker = mysqli_fetch_assoc($consulta_total_sticker);

    $total_sticker          = $datos_total_sticker['total_sticker'];

    $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
    nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
    FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $conteo_sticker = mysqli_num_rows($consulta);
    while ($datos = mysqli_fetch_assoc($consulta)) {

      $cod_sticker_producto          = $datos['cod_sticker_producto'];
      $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
      //$und_venta                     = $datos['und_venta'];
      $und_venta                     = 1;
      $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
      $cod_producto_barra            = $datos['cod_producto_barra'];
      $precio_compra_producto        = intval($datos['precio_compra_producto']);
      $precio_venta_producto         = intval($datos['precio_venta_producto']);
      //$fecha_ult_compra              = $datos['fecha_ult_compra'];
      $arrayCodigos[]                = (string)$cod_producto_barra; 
      $cantidad_contadores           = substr_count($precio_compra_producto, '0');
      $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
      $cantidad_separaciones         = count($contar_palabra);

      $cantidad_digitos_compra       = strlen($precio_compra_producto);
      $matriz_digitos_compra         = str_split($precio_compra_producto);
      $codif_letra_precio_compra     = "";

      $cantidad_digitos_venta        = strlen($precio_venta_producto);
      $matriz_digitos_venta          = str_split($precio_venta_producto);
      $codif_letra_precio_venta      = "";

      $total_caracteres              = strlen($nombre_producto);
      $contar_ceros_compra           = 0;
      $contar_ceros_venta            = 0;

      if ($total_caracteres > 20) {
        $nombre_producto1              = substr($nombre_producto, 0, 20);
        $nombre_producto2              = substr($nombre_producto, 20, 20);
        //$nombre_producto2              = ".";
      } else {
        $nombre_producto1              = ".";
        $nombre_producto2              = substr($nombre_producto, 0, 20);
      }

      for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
        $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

        $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
        $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
        $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

        if ($cod_letra_numero_compra == '0') {
          $nombre_letra_numero_compra = $contar_ceros_compra++;
        } else {
          $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
        }
        $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
      }

      for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

        $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

        $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
        $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
        $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

        if ($cod_letra_numero_venta == '0') { 
          $nombre_letra_numero_venta = $contar_ceros_venta++;
        } else {
          $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
        }
        $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
      }

      $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
      $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
      $datos_producto = mysqli_fetch_assoc($consulta_producto);

      $cod_tercero                = $datos_producto['cod_tercero'];
      $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
      $fecha_compra               = date("mY", strtotime($fecha_ult_compra));
      $incremento++;
      $salto_de_hoja              = $incremento % 25;

      //for ($contador_triple = 0; $contador_triple < $und_venta; $contador_triple++) {
        //$aument_for_40mm++;
        //$aument_for_40mm_triple++;
        //$modulo_triple_sticker = $aument_for_40mm_triple % 3;
      ?>   
                <td style="text-align: center; width: 100px; font-family: Courier; font-size:6pt;">
                  <?php 
                  echo "<br>".$nombre_producto1;
                  if ($nombre_producto2 <> '') { echo "<br>".$nombre_producto2; }
                  ?>
                  <br>
                  <svg id='<?php echo "barcode".$cod_producto_barra; ?>'>
                  <br>
                  <?php echo $cod_producto_barra ?>
                  <?php if ($cod_estado_codif_precio_compra_global == '1') { echo $codif_letra_precio_compra; } else { echo ""; } ?>
                  <?php if ($cod_estado_codif_precio_venta_global == '1') { echo $codif_letra_precio_venta; } else { echo ""; } ?>
                  <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo $precio_venta_producto; } else { echo ""; } ?>
                  <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $fecha_compra; } else { echo ""; } ?>
                  <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo $cod_tercero; } else { echo ""; } ?>
                  <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $cod_factura_compra_producto; } else { echo ""; } ?>
                </td>

                <?php if (($incremento + 1) % $columnas_por_fila == 0) { 
                  echo "</tr>"; // Cierra la fila actual 
                  if ($incremento < $conteo_sticker - 1) { // Abre una nueva fila, pero solo si no es la última iteración
                    echo "<tr>";
                  }
                } 
                ?>

        <?php //} // for ?>
        <?php if (($conteo_sticker <> $incremento) && ($salto_de_hoja == '0')) { ?><!--<div style="page-break-after: always;"></div>--><?php } ?>

    <?php } // while ?>
      </table>
    <div>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 50x25MM') { ?>
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;">

  <?php
  $incremento                  = 0;
  $arrayCodigos                = array();
  $cod_letra_numero_compra     = 0;
  $cod_letra_numero_venta      = 0;
  $nombre_letra_numero_compra  = 0;
  $nombre_letra_numero_venta   = 0;
  $aument_for_25mm             = 0;
  $contador_sticker            = 0;

  $sql_total_sticker = "SELECT SUM(und_venta) AS total_sticker FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta_total_sticker = mysqli_query($conectar, $sql_total_sticker) or die(mysqli_error($conectar));
  $datos_total_sticker = mysqli_fetch_assoc($consulta_total_sticker);

  $total_sticker          = $datos_total_sticker['total_sticker'];

  $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
  nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
  FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_sticker_producto          = $datos['cod_sticker_producto'];
    $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
    $und_venta                     = $datos['und_venta'];
    $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
    $cod_producto_barra            = $datos['cod_producto_barra'];
    $precio_compra_producto        = intval($datos['precio_compra_producto']);
    $precio_venta_producto         = intval($datos['precio_venta_producto']);
    //$fecha_ult_compra              = $datos['fecha_ult_compra'];
    $arrayCodigos[]                = (string)$cod_producto_barra; 
    $cantidad_contadores           = substr_count($precio_compra_producto, '0');
    $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
    $cantidad_separaciones         = count($contar_palabra);

    $cantidad_digitos_compra       = strlen($precio_compra_producto);
    $matriz_digitos_compra         = str_split($precio_compra_producto);
    $codif_letra_precio_compra     = "";

    $cantidad_digitos_venta        = strlen($precio_venta_producto);
    $matriz_digitos_venta          = str_split($precio_venta_producto);
    $codif_letra_precio_venta      = "";

    $total_caracteres              = strlen($nombre_producto);
    $contar_ceros_compra           = 0;
    $contar_ceros_venta            = 0;

    if ($total_caracteres > 28) {
      $nombre_producto1              = substr($nombre_producto, 0, 28);
      $nombre_producto2              = substr($nombre_producto, 28, 27);
    } else {
      $nombre_producto1              = ".";
      $nombre_producto2              = substr($nombre_producto, 0, 28);
    }


    for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
      $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

      $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
      $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
      $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

      if ($cod_letra_numero_compra == '0') {
        $nombre_letra_numero_compra = $contar_ceros_compra++;
      } else {
        $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
      }
      $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
    }

    for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

      $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

      $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
      $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
      $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

      if ($cod_letra_numero_venta == '0') { 
        $nombre_letra_numero_venta = $contar_ceros_venta++;
      } else {
        $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
      }
      $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
    }

  $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
  $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
  $datos_producto = mysqli_fetch_assoc($consulta_producto);

  $cod_tercero                = $datos_producto['cod_tercero'];
  $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
  $fecha_compra               = date("mY", strtotime($fecha_ult_compra));

  $incremento++;

  for ($increment_for=0; $increment_for < $und_venta; $increment_for++) {
  $aument_for_25mm++;
  $contador_sticker++;
?>
  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <?php if (($aument_for_25mm <> 1)) { ?>
    <tr>
      <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>.</strong></td>
    </tr>
    <?php } else { ?>

    <?php } ?>

    <tr>
      <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
    </tr>
    <?php if ($nombre_producto2 <> '') { ?>
    <tr>
      <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto2 ?></strong></td>
    </tr>
    <?php } ?>
    </table>

    <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
    <tr>
    <td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
    </tr>
    </table>


    <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
      <tr>
        <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;">
      <strong>
        <?php echo $cod_producto_barra ?> 
        <?php if ($cod_estado_codif_precio_compra_global == '1') { echo $codif_letra_precio_compra; } else { echo ""; } ?>
        <?php if ($cod_estado_codif_precio_venta_global == '1') { echo $codif_letra_precio_venta; } else { echo ""; } ?>
        <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo $precio_venta_producto; } else { echo ""; } ?>
        <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $fecha_compra; } else { echo ""; } ?>
        <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo $cod_tercero; } else { echo ""; } ?>
        <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo $cod_factura_compra_producto; } else { echo ""; } ?>
        </strong>
        </td>
      </tr>
    </table>

    <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
      <tr>
        <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_empresa_sticker_emp ?></strong></td>
      </tr>
    </table>
  <?php } ?>

  <?php if ($total_sticker <> $contador_sticker) { ?><div style="page-break-after: always;"></div><?php } ?>

  <?php } ?>

  <div>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 50x15MM') { ?>
<div id="area_imprimible_invisible" style="width: 99%;text-align: center;">

<?php
$incremento                  = 0;
$arrayCodigos                = array();
$cod_letra_numero_compra     = 0;
$cod_letra_numero_venta      = 0;
$nombre_letra_numero_compra  = 0;
$nombre_letra_numero_venta   = 0;
$aument_for_15mm             = 0;

$mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_sticker_producto          = $datos['cod_sticker_producto'];
$cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
$und_venta                     = $datos['und_venta'];
$nombre_producto               = substr($datos['nombre_producto'], 0, 80);
$cod_producto_barra            = $datos['cod_producto_barra'];
$precio_compra_producto        = intval($datos['precio_compra_producto']);
$precio_venta_producto         = intval($datos['precio_venta_producto']);
//$fecha_ult_compra              = $datos['fecha_ult_compra'];
$arrayCodigos[]                = (string)$cod_producto_barra; 
$cantidad_contadores           = substr_count($precio_compra_producto, '0');
$contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
$cantidad_separaciones         = count($contar_palabra);

$cantidad_digitos_compra       = strlen($precio_compra_producto);
$matriz_digitos_compra         = str_split($precio_compra_producto);
$codif_letra_precio_compra     = "";

$cantidad_digitos_venta        = strlen($precio_venta_producto);
$matriz_digitos_venta          = str_split($precio_venta_producto);
$codif_letra_precio_venta      = "";

$total_caracteres              = strlen($nombre_producto);
$contar_ceros_compra           = 0;
$contar_ceros_venta            = 0;

if ($total_caracteres > 28) {
$nombre_producto1              = substr($nombre_producto, 0, 28);
$nombre_producto2              = substr($nombre_producto, 28, 27);
} else {
$nombre_producto1              = ".";
$nombre_producto2              = substr($nombre_producto, 0, 28);
}


for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
$cod_letra_numero_compra    = $matriz_digitos_compra[$i];

$sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
$consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
$datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

if ($cod_letra_numero_compra == '0') {
$nombre_letra_numero_compra = $contar_ceros_compra++;
} else {
$nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
}
$codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
}

for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

$cod_letra_numero_venta     = $matriz_digitos_venta[$i];

$sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
$consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
$datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

if ($cod_letra_numero_venta == '0') { 
$nombre_letra_numero_venta = $contar_ceros_venta++;
} else {
$nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
}
$codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
}

$sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_tercero                = $datos_producto['cod_tercero'];
$fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
$fecha_compra               = date("mY", strtotime($fecha_ult_compra));

$incremento++;

for ($i=0; $i < $und_venta; $i++) {
$aument_for_15mm++
?>
<table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<?php if (($aument_for_15mm <> 1)) { ?>
<tr>
<td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>.</strong></td>
</tr>
<?php } ?>
<tr>
<td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
</tr>
<tr>
<td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><strong><?php echo $nombre_producto2 ?></strong></td>
</tr>
</table>

<table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
</tr>
</table>
<?php } ?>

<?php } ?>
<div>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA ARTESTIA 50x25') { ?>
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;">

  <?php
  $incremento                  = 0;
  $arrayCodigos                = array();
  $cod_letra_numero_compra     = 0;
  $cod_letra_numero_venta      = 0;
  $nombre_letra_numero_compra  = 0;
  $nombre_letra_numero_venta   = 0;
  $aument_for_25mm             = 0;
  $contador_sticker            = 0;

  $sql_total_sticker = "SELECT SUM(und_venta) AS total_sticker FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker'";
  $consulta_total_sticker = mysqli_query($conectar, $sql_total_sticker) or die(mysqli_error($conectar));
  $datos_total_sticker = mysqli_fetch_assoc($consulta_total_sticker);

  $total_sticker          = $datos_total_sticker['total_sticker'];

  $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
  nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
  FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_sticker_producto          = $datos['cod_sticker_producto'];
    $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
    $und_venta                     = $datos['und_venta'];
    $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
    $cod_producto_barra            = $datos['cod_producto_barra'];
    $precio_compra_producto        = intval($datos['precio_compra_producto']);
    $precio_venta_producto         = intval($datos['precio_venta_producto']);
    //$fecha_ult_compra              = $datos['fecha_ult_compra'];
    $arrayCodigos[]                = (string)$cod_producto_barra; 
    $cantidad_contadores           = substr_count($precio_compra_producto, '0');
    $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
    $cantidad_separaciones         = count($contar_palabra);

    $cantidad_digitos_compra       = strlen($precio_compra_producto);
    $matriz_digitos_compra         = str_split($precio_compra_producto);
    $codif_letra_precio_compra     = "";

    $cantidad_digitos_venta        = strlen($precio_venta_producto);
    $matriz_digitos_venta          = str_split($precio_venta_producto);
    $codif_letra_precio_venta      = "";

    $total_caracteres              = strlen($nombre_producto);
    $contar_ceros_compra           = 0;
    $contar_ceros_venta            = 0;

    if ($total_caracteres > 28) {
      $nombre_producto1              = substr($nombre_producto, 0, 28);
      $nombre_producto2              = substr($nombre_producto, 28, 27);
    } else {
      $nombre_producto1              = ".";
      $nombre_producto2              = substr($nombre_producto, 0, 28);
    }


    for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
      $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

      $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
      $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
      $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

      if ($cod_letra_numero_compra == '0') {
        $nombre_letra_numero_compra = $contar_ceros_compra++;
      } else {
        $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
      }
      $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
    }

    for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

      $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

      $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
      $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
      $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

      if ($cod_letra_numero_venta == '0') { 
        $nombre_letra_numero_venta = $contar_ceros_venta++;
      } else {
        $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
      }
      $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
    }

  $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
  $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
  $datos_producto = mysqli_fetch_assoc($consulta_producto);

  $cod_tercero                = $datos_producto['cod_tercero'];
  $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
  $fecha_compra               = date("mY", strtotime($fecha_ult_compra));

  $incremento++;

  for ($increment_for=0; $increment_for < $und_venta; $increment_for++) {
  $aument_for_25mm++;
  $contador_sticker++;
?>
  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <?php if (($aument_for_25mm <> 1)) { ?>
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>.</strong></td>
  </tr>
  <?php } else { ?>

  <?php } ?>

  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
  </tr>
  <?php if ($nombre_producto2 <> '') { ?>
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto2 ?></strong></td>
  </tr>
  <?php } ?>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
  </tr>
  </table>


  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
    <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;">
    <strong>
      <?php echo '['.$cod_producto_barra.']' ?> 
      <?php if ($cod_estado_codif_precio_compra_global == '1') { echo '['.$codif_letra_precio_compra.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_codif_precio_venta_global == '1') { echo '['.$codif_letra_precio_venta.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo '['.$precio_venta_producto.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo '['.$fecha_compra.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo '['.$cod_tercero.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo '['.$cod_factura_compra_producto.']'; } else { echo ""; } ?>
    </strong>
  </td>
  </tr>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
    <tr>
      <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_empresa_sticker_emp ?></strong></td>
    </tr>
  </table>
  <?php } ?>
  
  <?php if ($total_sticker <> $contador_sticker) { ?><div style="page-break-after: always;"></div><?php } ?>

  <?php } ?>

  <div>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA ARTESTIA 57x40') { ?>
  <div id="area_imprimible_invisible" style="width: 99%;text-align: center;">

  <?php
  $incremento                  = 0;
  $arrayCodigos                = array();
  $cod_letra_numero_compra     = 0;
  $cod_letra_numero_venta      = 0;
  $nombre_letra_numero_compra  = 0;
  $nombre_letra_numero_venta   = 0;
  $aument_for_25mm             = 0;
  $contador_sticker            = 0;

  $sql_total_sticker = "SELECT SUM(und_venta) AS total_sticker FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker'";
  $consulta_total_sticker = mysqli_query($conectar, $sql_total_sticker) or die(mysqli_error($conectar));
  $datos_total_sticker = mysqli_fetch_assoc($consulta_total_sticker);

  $total_sticker          = $datos_total_sticker['total_sticker'];

  $mostrar_datos_sql = "SELECT cod_sticker_producto, cod_factura_compra_producto, und_venta, 
  nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
  FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_sticker_producto          = $datos['cod_sticker_producto'];
    $cod_factura_compra_producto   = $datos['cod_factura_compra_producto'];
    $und_venta                     = $datos['und_venta'];
    $nombre_producto               = substr($datos['nombre_producto'], 0, 80);
    $cod_producto_barra            = $datos['cod_producto_barra'];
    $precio_compra_producto        = intval($datos['precio_compra_producto']);
    $precio_venta_producto         = intval($datos['precio_venta_producto']);
    //$fecha_ult_compra              = $datos['fecha_ult_compra'];
    $arrayCodigos[]                = (string)$cod_producto_barra; 
    $cantidad_contadores           = substr_count($precio_compra_producto, '0');
    $contar_palabra                = str_word_count($precio_compra_producto, 1, '0');
    $cantidad_separaciones         = count($contar_palabra);

    $cantidad_digitos_compra       = strlen($precio_compra_producto);
    $matriz_digitos_compra         = str_split($precio_compra_producto);
    $codif_letra_precio_compra     = "";

    $cantidad_digitos_venta        = strlen($precio_venta_producto);
    $matriz_digitos_venta          = str_split($precio_venta_producto);
    $codif_letra_precio_venta      = "";

    $total_caracteres              = strlen($nombre_producto);
    $contar_ceros_compra           = 0;
    $contar_ceros_venta            = 0;

    if ($total_caracteres > 28) {
      $nombre_producto1              = substr($nombre_producto, 0, 28);
      $nombre_producto2              = substr($nombre_producto, 28, 27);
    } else {
      $nombre_producto1              = ".";
      $nombre_producto2              = substr($nombre_producto, 0, 28);
    }


    for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
      $cod_letra_numero_compra    = $matriz_digitos_compra[$i];

      $sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
      $consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
      $datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

      if ($cod_letra_numero_compra == '0') {
        $nombre_letra_numero_compra = $contar_ceros_compra++;
      } else {
        $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
      }
      $codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
    }

    for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

      $cod_letra_numero_venta     = $matriz_digitos_venta[$i];

      $sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
      $consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
      $datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

      if ($cod_letra_numero_venta == '0') { 
        $nombre_letra_numero_venta = $contar_ceros_venta++;
      } else {
        $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
      }
      $codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
    }

  $sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
  $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
  $datos_producto = mysqli_fetch_assoc($consulta_producto);

  $cod_tercero                = $datos_producto['cod_tercero'];
  $fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
  $fecha_compra               = date("mY", strtotime($fecha_ult_compra));

  $incremento++;

  for ($increment_for=0; $increment_for < $und_venta; $increment_for++) {
  $aument_for_25mm++;
  $contador_sticker++;
?>
  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <?php if (($aument_for_25mm <> 1)) { ?>
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong>.</strong></td>
  </tr>
  <?php } else { ?>

  <?php } ?>

  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto1 ?></strong></td>
  </tr>
  <?php if ($nombre_producto2 <> '') { ?>
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto2 ?></strong></td>
  </tr>
  <?php } ?>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:6pt;"><svg id='<?php echo "barcode".$cod_producto_barra; ?>'></td>
  </tr>
  </table>


  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
    <tr>
  <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;">
    <strong>
      <?php echo '['.$cod_producto_barra.']' ?> 
      <?php if ($cod_estado_codif_precio_compra_global == '1') { echo '['.$codif_letra_precio_compra.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_codif_precio_venta_global == '1') { echo '['.$codif_letra_precio_venta.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_nocodif_precio_venta_sticker_global == '1') { echo '['.$precio_venta_producto.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo '['.$fecha_compra.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_cod_tercero_sticker_global == '1') { echo '['.$cod_tercero.']'; } else { echo ""; } ?>
      <?php if ($cod_estado_fecha_compra_sticker_global == '1') { echo '['.$cod_factura_compra_producto.']'; } else { echo ""; } ?>
    </strong>
  </td>
  </tr>
  </table>

  <table border="0" width="99%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
    <tr>
      <td style="text-align: center; width:98%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_empresa_sticker_emp ?></strong></td>
    </tr>
  </table>
  <?php } ?>
  
  <?php if ($total_sticker <> $contador_sticker) { ?><div style="page-break-after: always;"></div><?php } ?>

  <?php } ?>

  <div>
<?php } ?>
<!--</div>-->
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php if (($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 57x30MM') || ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 32x57MM')) { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 57x40MM') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 57x40MM - DOUBLE') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.6, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 100x100MM TRIPLE') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.6, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 50x25MM') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 30, displayValue: false });
  }
  console.log("ZEBRA 50x25");
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 50x15MM') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 24, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if (($nombre_tipo_impresora_zebra_ticket == 'ZEBRA ARTESTIA 57x30') || ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA 32x57')) { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA ARTESTIA 57x40') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA ARTESTIA 50x25') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 30, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($nombre_tipo_impresora_zebra_ticket == 'ZEBRA ARTESTIA 50x15') { ?>
<script type="text/javascript">

  function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
      arr.push(json[x]);
    }
    return arr;
  }

  jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
  valores = arrayjsonbarcode(jsonvalor);

  for (var i = 0; i < valores.length; i++) {
    JsBarcode("#barcode" + valores[i], valores[i].toString(), { format: "CODE128", lineColor: "#000", width: 1.5, height: 24, displayValue: false });
  }
  
</script>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<script type="text/javascript">
/*
var qrcode = new QRCode(document.getElementById("qrcode"), { width : 50, height : 50 });

function makeCode () {    
  var text = "https://editaxe.xyz";
  qrcode.makeCode(text);
}
  makeCode();
*/
</script>

<script>
window.onload = function() {
document.getElementById("foco_btn_imprimir").focus();
}
</script>

<script>  
 $(document).ready(function(){  
  $('#btnImprimir').click(function(){
  var cod_info_factura_sticker = <?php echo $cod_info_factura_sticker ?>;  
    $.ajax({ url:"imprimir_sticker_barras_ticket_pos.php", method:"GET", data:{cod_info_factura_sticker:cod_info_factura_sticker, campo:"cod_info_factura_sticker", id:cod_info_factura_sticker }, 
     success: function(response){
         if(response==1){
             //alert('Imprimiendo....');
         }else{
             //alert('Error');
         }
     }
    });  
  });
 });  
 </script>

</body>
</html>