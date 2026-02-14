<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<!--<script type="text/javascript" src="../js/qrcode.js"></script>-->
<script type="text/javascript" src="../js/qrious.js"></script>
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
$cod_info_factura_compra              = intval($_GET['cod_info_factura_compra']);
$pagina                               = addslashes($_GET['pagina']).'?cod_info_factura_compra='.$cod_info_factura_compra;
$pagina_local                         = $_SERVER['PHP_SELF'];
$hora_compra_his                      = date("His");

$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
$info_emp = mysqli_fetch_assoc($consultar_informacion);

$titulo_emp                          = $info_emp['titulo'];
$desarrollador_emp                   = $info_emp['desarrollador'];
$pag_desarrollador_emp               = $info_emp['pag_desarrollador'];
$correo_desarrollador_emp            = $info_emp['correo_desarrollador'];
$anyo_emp                            = $info_emp['anyo'];
$nombre_emp                          = $info_emp['nombre'];
$eslogan_emp                         = $info_emp['eslogan'];
$nombre_propietario_emp              = $info_emp['nombre_propietario'];
$cedula_propietario_emp              = $info_emp['cedula_propietario'];
$res_emp                             = $info_emp['res'];
$res1_emp                            = $info_emp['res1'];
$res2_emp                            = $info_emp['res2'];
$fecha_res_emp                       = $info_emp['fecha_res'];
$prefijo_res_emp                     = $info_emp['prefijo_res'];
$pais_emp                            = $info_emp['pais'];
$departamento_emp                    = $info_emp['departamento'];
$ciudad_emp                          = $info_emp['ciudad'];
$localidad_emp                       = $info_emp['localidad'];
$direccion_emp                       = $info_emp['direccion'];
$correo_emp                          = $info_emp['correo'];
$cabecera_emp                        = $info_emp['cabecera'];
$telefono_emp                        = $info_emp['telefono'];
$nit_empresa_emp                     = $info_emp['nit_empresa'];
$regimen_emp                         = $info_emp['regimen'];
$propietario_nombres_apellidos_emp   = $info_emp['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_emp['propietario_nit'];
$propietario_url_firma_emp           = $info_emp['propietario_url_firma'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$data_info_factura = mysqli_fetch_assoc($resultado_info_fact);

$cod_info_factura_compra                              = $data_info_factura['cod_info_factura_compra'];
$cod_factura                                          = $data_info_factura['cod_factura'];
$cod_tercero                                          = $data_info_factura['cod_tercero'];
//$cod_caja_virtual                                     = $data_info_factura['cod_caja_virtual'];
$nombre_estado_factura                                = $data_info_factura['nombre_estado_factura'];
$nombre_tipo_cargue_factura                           = $data_info_factura['nombre_tipo_cargue_factura'];
$nombre_tipo_compra                                   = $data_info_factura['nombre_tipo_compra'];
$cod_empresa                                          = $data_info_factura['cod_empresa'];
$nombre_empresa                                       = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                  = $data_info_factura['razonsocial_empresa'];
$total_muestra                                        = $data_info_factura['total_muestra'];
$fecha_ymdhis                                         = $data_info_factura['fecha_ymdhis'];
$cuenta                                               = $data_info_factura['cuenta'];
$cod_estado_factura                                   = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                        = $data_info_factura['cod_base_caja'];
$descuento_ptj                                        = $data_info_factura['descuento_ptj'];
$iva_ptj                                              = $data_info_factura['iva_ptj'];
$flete_ptj                                            = $data_info_factura['flete_ptj'];
$subtotal                                             = $data_info_factura['subtotal'];
$valor_iva                                            = $data_info_factura['valor_iva'];
$cod_cliente                                          = $data_info_factura['cod_cliente'];
$vlr_cancelado                                        = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                           = $data_info_factura['vlr_vuelto'];
$fecha_dia                                            = $data_info_factura['fecha_dia'];
$fecha_mes                                            = $data_info_factura['fecha_mes'];
$fecha_anyo                                           = $data_info_factura['fecha_anyo'];
$anyo                                                 = $data_info_factura['anyo'];
$fecha_hora                                           = $data_info_factura['fecha_hora'];
$fecha_remision                                       = $data_info_factura['fecha_remision'];
$nombre_ccosto                                        = $data_info_factura['nombre_ccosto'];
$garantia_meses                                       = $data_info_factura['garantia_meses'];
$observacion                                          = $data_info_factura['observacion'];
$cod_tipo_pago                                        = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                    = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                 = $data_info_factura['nombre_tipo_producto'];
$total_precio_costo                                   = $data_info_factura['total_precio_costo'];
$total_precio_compra                                  = $data_info_factura['total_precio_compra'];
$total_precio_venta                                   = $data_info_factura['total_precio_venta'];
$cod_dependencia                                      = $data_info_factura['cod_dependencia'];
$servicio                                             = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                  = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                               = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                          = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                  = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                   = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                      = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                       = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                   = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                       = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                      = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                    = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                           = $data_info_factura['cod_resolucion_facturacion'];
$total_datos_data                                     = $data_info_factura['total_datos_data'];
$tiempo_ejecucion                                     = $data_info_factura['tiempo_ejecucion'];
$ipc_ptj                                              = $data_info_factura['ipc_ptj'];
$precio_ipc                                           = $data_info_factura['precio_ipc'];
$precio_ipc_total                                     = $data_info_factura['precio_ipc_total'];
$ret_ica_ptj                                          = $data_info_factura['ret_ica_ptj'];
$total_ret_ica                                        = $data_info_factura['total_ret_ica'];
$iva_teorico_ptj                                      = $data_info_factura['iva_teorico_ptj'];
$total_iva_teorico                                    = $data_info_factura['total_iva_teorico'];
$tarifa_rete_vigente_ptj                              = $data_info_factura['tarifa_rete_vigente_ptj'];
$total_tarifa_rete_vigente                            = $data_info_factura['total_tarifa_rete_vigente'];
$rete_iva_asumido_ptj                                 = $data_info_factura['rete_iva_asumido_ptj'];
$total_rete_iva_asumido                               = $data_info_factura['total_rete_iva_asumido'];
$iva_19                                               = $data_info_factura['iva_19'];
$iva_5                                                = $data_info_factura['iva_5'];
$nombre_rete_fuente_ptj                               = $data_info_factura['nombre_rete_fuente_ptj'];
$total_compra_imp                                     = $data_info_factura['total_compra_imp'];
$total_precio_ipc                                     = $data_info_factura['total_precio_ipc'];
$total_descuento                                      = $data_info_factura['total_descuento'];
$total_rete_fuente                                    = $data_info_factura['total_rete_fuente'];
$total_factura_compra_retefuente                      = $data_info_factura['total_factura_compra_retefuente'];
$total_factura_compra                                 = $data_info_factura['total_factura_compra'];
$cod_doc_soporte                                      = $data_info_factura['cod_doc_soporte'];
$total_inv_precio_costo                               = $data_info_factura['total_inv_precio_costo'];
$total_inv_precio_compra                              = $data_info_factura['total_inv_precio_compra'];
$total_inv_precio_venta                               = $data_info_factura['total_inv_precio_venta'];
$total_compra_precio_costo                            = $data_info_factura['total_compra_precio_costo'];
$total_compra_precio_compra                           = $data_info_factura['total_compra_precio_compra'];
$total_compra_precio_venta                            = $data_info_factura['total_compra_precio_venta'];
$total_inv_compra_desp_factura                        = $data_info_factura['total_inv_compra_desp_factura'];
$cod_estado                                           = $data_info_factura['cod_estado'];
$subtotal_total_precio_compra                         = $data_info_factura['subtotal_total_precio_compra'];
$subtotal_total_precio_costo                          = $data_info_factura['subtotal_total_precio_costo'];
$cod_tipo_inventario                                  = $data_info_factura['cod_tipo_inventario'];
$cod_tipo_producto_consumo                            = $data_info_factura['cod_tipo_producto_consumo'];

$cod_cufe                                             = $data_info_factura['cod_cufe'];
$dataico_email_status                                 = $data_info_factura['dataico_email_status'];
$dataico_uuid                                         = $data_info_factura['dataico_uuid'];
$dataico_issue_date                                   = $data_info_factura['dataico_issue_date'];
$dataico_dian_messages                                = $data_info_factura['dataico_dian_messages'];
$dataico_payment_date                                 = $data_info_factura['dataico_payment_date'];
$dataico_xml_url                                      = $data_info_factura['dataico_xml_url'];
$dataico_customer_status                              = $data_info_factura['dataico_customer_status'];
$dataico_validation_date                              = $data_info_factura['dataico_validation_date'];
$dataico_qrcode                                       = $data_info_factura['dataico_qrcode'];
$dataico_xml                                          = $data_info_factura['dataico_xml'];
$dataico_invoice_type_code                            = $data_info_factura['dataico_invoice_type_code'];
$dataico_pdf_url                                      = $data_info_factura['dataico_pdf_url'];
$dataico_dian_status                                  = $data_info_factura['dataico_dian_status'];
$dataico_dian_error                                   = $data_info_factura['dataico_dian_error'];
$dataico_dian_path                                    = $data_info_factura['dataico_dian_path'];
$cod_estado_factura_electronica_enviado_dian          = $data_info_factura['cod_estado_factura_electronica_enviado_dian'];
$cod_estado_factura_electronica_enviado_dataico       = $data_info_factura['cod_estado_factura_electronica_enviado_dataico'];

$longitud_cod_cufe                                    = strlen($cod_cufe);
$mitad_longitud_cod_cufe                              = $longitud_cod_cufe / 2;
$cod_cufe_parte1                                      = substr($cod_cufe, 0, $mitad_longitud_cod_cufe);
$cod_cufe_parte2                                      = substr($cod_cufe, $mitad_longitud_cod_cufe+1, $longitud_cod_cufe);
$url_vpfe_dian                                        = "https://catalogo-vpfe.dian.gov.co/document/searchqr";
$url_vpfe_dian_qr                                     = $url_vpfe_dian."?documentkey=".'<br>'.$cod_cufe_parte1.'<br>'.$cod_cufe_parte2;
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
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$cod_info_factura_strpad   = str_pad($cod_info_factura_compra, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora                                = date("His");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
?>
<script>
function printPageArea(areaID){

var cod_factura_strpad = '<?php echo $cod_factura_strpad; ?>';
var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
$("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

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


<?php if ($cod_estado_enviar_factura_documento_soporte_dian_api_global == '1' && $nombre_tipo_factura == 'DOCUMENTO_SOPORTE') { ?>
<table class="table table-striped">
  <tr>
  	<?php if ($cod_estado_factura_electronica_enviado_dian == '1') { ?>
    <td style="text-align:center;" id="resultado_envio_dian<?php echo $cod_info_factura_compra ?>"><img src="../imagenes/btn_dian_peq.png" class='img-polaroid'><br>Enviado a la Dian</td>
    <?php } ?>
    <?php if ($dataico_dian_error <> '') { ?>
    <td style="text-align:center;" id="resultado_error_envio_dian_dataico<?php echo $cod_info_factura_compra ?>"><?php echo $dataico_dian_error; ?></td>
    <?php } ?>
    <?php if ($cod_estado_factura_electronica_enviado_dian == '0' && $cod_estado_factura_electronica_enviado_dataico == '1') { ?>
    <td style="text-align:center;" id="apidian<?php echo $cod_info_factura_compra ?>" data="<?php echo $cod_info_factura_compra ?>"><a class="EnviarFacturaDianDataico" style="cursor:pointer;"><img src="../imagenes/enviar_historia_clinica_correo.png" class="img-polaroid" alt=""></a></td>
    <?php } ?>
    <?php if ($cod_estado_factura_electronica_enviado_dataico == '1') { ?>
    <td style="text-align:center;" id="cod_estado_factura_electronica_enviado_dataico<?php echo $cod_info_factura_compra ?>"><img src="../imagenes/btn_dataico.png" class='img-polaroid'><br>Enviado a Dataico</td>
    <?php } ?>
  </tr>
</table>
<?php } ?>

<table class="table table-striped">
  <tr>
    <td><font color='black' size= "+3">TIPO FACTURA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">FACTURA DE COMPRA NO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TIPO DE PAGO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_pago; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">PROVEEDOR:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
  </tr>
  <tr>
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a></td>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <?php } ?>
    <!--<td align='center'><a href="../admin/imprimir_factura_venta_grande_bootstrap_mpdf_pdf.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>" target="_blank"><img src="../imagenes/imprimir_.png"></a></td>-->
  </tr>
</table>

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
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_emp; ?></strong></td>
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
<td style="text-align: center;"><=======================================></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?> - <?php echo $fecha_hora; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FACTURA DE COMPRA: <?php echo $prefijo_resolucion_facturacion.' '.$cod_factura; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TIPO DE PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>NIT TERCERO: <?php echo ($cedula_cli); ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>NOMBRE TERCERO: <?php echo utf8_decode($nombre_cliente); ?></strong></td>
  </tr>
  <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>OBSERVACION: <?php echo $observacion; ?></strong></td>
  </tr>
  <?php } ?>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong>CANT</strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>ARTICULO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:8pt;"><strong>P.COMPRA</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:8pt;"><strong>P.TOTAL</strong></td>
</tr>
<?php
$resultado_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_compra, precio_compra_producto, total_compra_producto, iva_ptj, 
precio_ipc, nombre_tipo_unidad_medida FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

	$cod_producto                = $info_venta['cod_producto'];
	$cod_producto_barra          = $info_venta['cod_producto_barra'];
	$nombre_producto             = $info_venta['nombre_producto'];
	$und_compra                  = $info_venta['und_compra'];
	$precio_compra_producto      = $info_venta['precio_compra_producto'];
	$total_compra_producto       = $info_venta['total_compra_producto'];
	$iva_ptj                     = $info_venta['iva_ptj'];
	$precio_ipc                  = $info_venta['precio_ipc'];
	$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

	if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
	if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }

	$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
	$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
	$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

	$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

	if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_compra ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_tipo_unidad_medida ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_compra_producto, 0, ",", ".") ?></strong></td>
</tr>
<?php } ?>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:8pt;"><strong>SUBTOTAL</strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:8pt;"><strong>$DESC</strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_descuento, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:8pt;"><strong>IVA</strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($valor_iva, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>

  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:8pt;"><strong>TOTAL</strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_factura_compra_retefuente, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:8pt;"><strong>USUARIO</strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:8pt;"><strong><?php echo $cuenta ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<?php if ($cod_estado_enviar_factura_documento_soporte_dian_api_global == '1' && $nombre_tipo_factura == 'DOCUMENTO_SOPORTE') { ?>
	<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:7pt;">
	  <tr>
	    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><br></th>
	  </tr>
	  <tr>
	    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;">CUFE: <?php echo $cod_cufe_parte1."<br>".$cod_cufe_parte2 ?></th>
	  </tr>
	  <tr>
	    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><br></th>
	  </tr>
	  <tr>
	    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><?php echo $url_vpfe_dian_qr ?></th>
	  </tr>
	  <tr>
	    <th style="text-align: center; width: 95%; font-family: Helvetica; font-size:7pt;"><img id="qr_factura_electronica"></th>
	  </tr>
	</table>
	<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
	<tr>
	<td style="text-align: center;"><=======================================></td>
	</tr>
	</table>
<?php } ?>

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
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha.$hora.'-'.$cod_factura ?></strong>_imp_cotiz_nrm</td>
  </tr>
</table>

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
<script>
window.onload = function() {
document.getElementById("foco_btn_imprimir").focus();
}
</script>
</body>
</html>


<?php if ($cod_estado_enviar_factura_documento_soporte_dian_api_global == '1' && $nombre_tipo_factura == 'DOCUMENTO_SOPORTE') { ?>
<script type="text/javascript">
$(document).ready(function() {
	var cod_cufe = "<?php echo $cod_cufe;?>";
	var url_vpfe_dian = "https://catalogo-vpfe.dian.gov.co/document/searchqr";
	var url_vpfe_dian_qr = url_vpfe_dian+"?documentkey="+cod_cufe;
	new QRious({
		element: document.getElementById("qr_factura_electronica"),
		value: url_vpfe_dian_qr, // La URL o el texto
		size: 120,
		backgroundAlpha: 0, // 0 para fondo transparente
		foreground: "#000", // Color del QR
		level: "L", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
	});
});
</script>
<?php } ?>

  <script>  
  $(document).ready(function(){  
    $('#btnImprimir').click(function(){
    var cod_info_factura_compra = <?php echo $cod_info_factura_compra ?>;  
      $.ajax({ url:"imprimir_factura_compra_ticket_pos.php", method:"GET", data:{cod_info_factura_compra:cod_info_factura_compra, campo:"cod_info_factura_compra", id:cod_info_factura_compra }, 
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