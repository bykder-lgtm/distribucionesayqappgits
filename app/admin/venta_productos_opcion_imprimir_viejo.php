<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
$pagina_local                         = $_SERVER['PHP_SELF'];
$cod_administrador_sesion_db          = $cod_administrador;
$subtitulo_tipo_caja                  = '';

$sql_info_impresora = "SELECT tamano_papel_impresora FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_sesion_db'";
$consultar_info_impresora = mysqli_query($conectar, $sql_info_impresora) or die(mysqli_error($conectar));
$info_impresora = mysqli_fetch_assoc($consultar_info_impresora);

$tamano_papel_impresora               = $info_impresora['tamano_papel_impresora'];

$cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
$pagina                               = addslashes($_GET['pagina']).'?cod_info_factura_venta='.$cod_info_factura_venta;
$cod_info_factura_venta_codif         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
$cod_info_factura_venta_codif_cryp    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);

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
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                         = $info_fact['cod_factura'];
$fecha_anyo                          = $info_fact['fecha_anyo'];
$fecha_hora                          = substr($info_fact['fecha_hora'], 0, 5);
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
$cod_caja_virtual                    = $info_fact['cod_caja_virtual'];
$cod_base_caja                       = $info_fact['cod_base_caja'];
$monto_deuda                         = $info_fact['monto_deuda'];
$subtotal                            = $info_fact['subtotal'];
$abonado                             = $info_fact['abonado'];
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
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_venta_product = "SELECT Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_manual,
Sum(((und_venta*precio_venta_producto_orig) - ((descuento_ptj/100)*(und_venta*precio_venta_producto_orig)))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento_automatico, 
Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '33333333')";
$consulta_venta_product = mysqli_query($conectar, $sql_venta_product) or die(mysqli_error($conectar));
$suma_venta_product = mysqli_fetch_assoc($consulta_venta_product);

$subtotal_base_sin_descuento_manual             = ($suma_venta_product['subtotal_base_sin_descuento_manual']);
$subtotal_base_sin_descuento_automatico         = ($suma_venta_product['subtotal_base_sin_descuento_automatico']);
$total_peso_producto                            = ($suma_venta_product['total_peso_producto']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto 
WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_temporal);

$total_venta_neta                    = ($subtotal_base_sin_descuento_automatico);

if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') {
	$subtotal_base                       = 0;
	$total_iva                           = 0;
} else {
	$subtotal_base                       = ($suma['subtotal_base']);
	$total_iva                           = ($suma['total_iva']);
}


$total_venta_temp                    = ($suma['total_venta']);
$total_venta_sin_descuento           = ($subtotal_base_sin_descuento_automatico);
$vlr_cambio                          = ($vlr_cancelado - $total_venta_temp);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_existe_descuento_manual = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '33333333')";
$consulta_existe_descuento_manual = mysqli_query($conectar, $sql_existe_descuento_manual) or die(mysqli_error($conectar));
$existe_descuento_manual = mysqli_num_rows($consulta_existe_descuento_manual);

if ($existe_descuento_manual == '0') {
$nombre_producto_descuento             = '';
$precio_venta_producto_descuento       = '0';
$total_venta_producto_descuento        = '0';
//$total_descuento_venta                 = ($subtotal_base_sin_descuento_automatico - $subtotal_base_sin_descuento_manual);
$total_descuento_venta                 = 0;
//$descuento_ptj_dif                     = ($total_descuento_venta / $subtotal_base_sin_descuento_automatico) * 100;
$descuento_ptj_dif                     = 0;
//$subtotal_base_sin_descuento           = ($subtotal_base_sin_descuento_automatico);
$subtotal_base_sin_descuento           = ($total_venta_temp);
} else {
$sql_servicio_descuento = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, nombre_tipo_precio 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '33333333')";
$consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
$existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
$info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

$nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
$precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
$total_venta_producto_descuento        = $subtotal_base_sin_descuento_manual;
$total_descuento_venta                 = $info_servicio_descuento['total_venta_producto'];
$descuento_ptj_dif                     = $info_servicio_descuento['nombre_tipo_precio'];
$subtotal_base_sin_descuento           = ($subtotal_base_sin_descuento_manual);
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '22222222')";
$consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
$existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
$info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

$nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
$precio_venta_producto_propina         = $info_servicio_propina['precio_venta_producto'];
$total_venta_producto_propina          = $info_servicio_propina['total_venta_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                   = str_pad($cod_factura, 3, "0", STR_PAD_LEFT);
$cod_info_factura_strpad              = str_pad($cod_info_factura_venta, 3, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_subproducto_mostrar_imprimir_global == '1') {
	$condcional_mostrar_subproductos_imprimir = " AND (nombre_tipo_producto <> 'SUBPRODUCTO')";
} else {
	$condcional_mostrar_subproductos_imprimir = '';
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_agrupar_por_producto_imp_global == '1') { 
  $agrupar_productos_imp = 'GROUP BY cod_producto_barra';
  $select_productos_imp = 'SUM(und_venta) as und_venta, precio_venta_producto, SUM(total_venta_producto) as total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj, precio_ipc, comentario_producto, und_caja_sobre, cajas_sobre, nombre_tipo_und_caja_sobre, nombre_tipo_unidad_medida'; 
} else { 
  $agrupar_productos_imp = ''; 
  $select_productos_imp = 'und_venta, precio_venta_producto, total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj, precio_ipc, comentario_producto, und_caja_sobre, cajas_sobre, nombre_tipo_und_caja_sobre, nombre_tipo_unidad_medida'; 
}
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
$url_qr                              = $url_encuesta_experiencia_compra."/pageditaxe/admin/inicio.php?cod_info_factura_venta_codif_cryp=".$cod_info_factura_venta_codif_cryp;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<script>
function printPageArea(areaID){

var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
$("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

var printContent = document.getElementById(areaID);
$("#area_imprimible_invisible").show();
$("#area_imprimible_invisible_cocina").hide();
document.getElementById("listo").focus();

var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<script>
function printPageAreaCocina(areaID2){

var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
$("#codigo_codabar_zapateria_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

var printContent2 = document.getElementById(areaID2);
$("#area_imprimible_invisible").hide();
$("#area_imprimible_invisible_cocina").show();

var WinPrint2 = window.open('', '', 'width=400,height=1000');
WinPrint2.document.write(printContent2.innerHTML);
WinPrint2.document.close();
WinPrint2.focus();
WinPrint2.print();
WinPrint2.close();
}
</script>

<div class="table-responsive">
<center>
<table class="table table-striped">
  <tr>
    <td><font color='black' size= "+3">TIPO FACTURA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">FACTURA NO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TIPO DE PAGO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_pago; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">CLIENTE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">SUBTOTAL:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">%DESCUENTO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo intval($descuento_ptj_dif).'%'; ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">$DESCUENTO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_descuento_venta, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">IVA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_iva, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TOTAL VENTA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_venta_temp, 0, ",", "."); ?></font></td>
  </tr>

<?php if (($cod_tipo_pago == '2') && ($cod_estado_tipo_venta_zapateria_global == '1')) { ?>
  <tr>
    <td><font color='black' size= "+3">ABONADO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">PENDIENTE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
  </tr>
<?php } ?>

<?php if ($cod_tipo_pago == '1') { ?>
  <tr>
    <td><font color='black' size= "+3">RECIBIDO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($vlr_cancelado, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+4">CAMBIO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+4"><?php echo number_format($vlr_cambio, 0, ",", "."); ?></font></td>
  </tr>
<?php } ?>
</table>

<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"><br>REGRESAR</a></td>

	<?php if ($cod_estado_habilitar_btn_imp_venta_nav_global == '0') { ?>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"><br>IMPRIMIR FACTURA</a></td>
	<?php } ?>

    <?php if ($cod_estado_btn_imprimir_venta_nav_zapateria_global == '1') { ?>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir2" onclick="printPageAreaCocina('area_imprimible_invisible_cocina')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"><br>IMPRIMIR TICKET</a></td>
    <?php } ?>

	<?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
    <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button><br>IMPRIMIR FACTURA</td>
	<?php } ?>

	<?php if ($cod_estado_habilitar_btn_imp_nav_carta_pdf_global == '0') { ?>
    <td style="text-align:center;"><a href="../admin/ver_factura_venta_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR FACTURA PDF</a></td>
	<?php } ?>

	<?php if ($cod_estado_btn_imp_nav_carta_por_caja_pdf_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/ver_factura_venta_por_caja_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR FACTURA POR CAJA PDF</a></td>
	<?php } ?>

	<?php if ($cod_estado_btn_imp_nav_carta_por_caja_remision_pdf_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/ver_factura_venta_por_caja_remision_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"><br>IMPRIMIR REMISION PDF</a></td>
	<?php } ?>

	<?php if ($cod_estado_abrir_cajon_monedero_driv_direct == '1') { ?>
    <td style="text-align:center;"><button id="btnAbrirCaja"><img src="../imagenes/abrir_caja_reg.png" alt="Abrir"></button><br>ABRIR CAJON MONEDERO</td>
	<?php } ?>

<?php 
if ($nombre_tipo_factura == 'ELECTRONICA') { ?>
    <td style="text-align:center;"></td>
    <?php if ($nombre_operador_factura_electronica == 'DATAICO') { ?>
    <td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_puntoycoma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png"></a></td>
    <!--<td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_coma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_csv.png"></a></td>-->
    <?php } ?>
    <?php if ($nombre_operador_factura_electronica == 'MONEYBOX') { ?>
    <td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_moneybox_xlsx.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png"></a></td>
    <?php } ?>
<?php } ?>
  </tr>
</table>
</center>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($tamano_papel_impresora == '58') { ?>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_emp; ?></strong></td>
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


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FECHA: <?php echo $fecha_anyo; ?>|<?php echo $fecha_hora; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FACTURA DE VENTA: <?php echo $prefijo_resolucion_facturacion.' '.$cod_factura; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TIPO DE PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_tipo_identificacion; ?> CLIENTE: <?php echo $cedula_cli.$digito_tercero; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CLIENTE: <?php echo utf8_decode($nombre_cliente); ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CAJA: <?php echo $cod_caja; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_concepto_multi_virtual; ?> VIRTUAL: <?php echo $cod_base_caja; ?></strong></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>VENDEDOR (A): <?php echo $usario_vendedor; ?></strong></td>
    <?php if ($cod_estado_peso_producto_global == '1') { ?>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TOTAL PESO (KG): <?php echo number_format($total_peso_producto, 0, ",", "."); ?></strong></td>
    <?php } ?>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong>CANT</strong></th>
<th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong></strong></th>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:9pt;">..</th><?php } ?>
<th style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong>DESCRIPCION</strong></th>
<th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong>P.UNIT</strong></th>
<th style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong>P.TOTAL</strong></th>
<th style="text-align: center; width:10%; font-family: Courier; font-size:5pt;"><strong></strong></th>
</tr>
<?php
if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }


$resultado_sql = "SELECT $select_productos_imp 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND ((cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222')) 
$condcional_mostrar_subproductos_imprimir $agrupar_productos_imp $ordenamiento";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

	$cod_producto                = $info_venta['cod_producto'];
	$cod_producto_barra          = $info_venta['cod_producto_barra'];
	$nombre_producto             = $info_venta['nombre_producto'];
	$und_venta                   = $info_venta['und_venta'];
	$precio_venta_producto       = $info_venta['precio_venta_producto'];
	$total_venta_producto        = $info_venta['total_venta_producto'];
	$iva_ptj                     = $info_venta['iva_ptj'];
	$precio_ipc                  = $info_venta['precio_ipc'];
	$comentario_producto         = $info_venta['comentario_producto'];
	$und_caja_sobre              = $info_venta['und_caja_sobre'];
	$cajas_sobre                 = $info_venta['cajas_sobre'];
	$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
	$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

	if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
	if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
	if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

	$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
	$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
	$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

	$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

	if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $und_venta.$subtitulo_tipo_caja ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_tipo_und_caja_sobre ?></strong></td>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
<td style="text-align: left; width:50%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong><?php echo $nombre_tipo_iva ?></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>SUBTOTAL</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>%DESC</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>$DESC</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong>IVA</strong></td>
	<?php if ($existe_servicio_propina <> '0') { ?>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_producto_propina." ".$ptj_servicio_propina."%" ?></strong></td>
	<?php } ?>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($subtotal_base_sin_descuento, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo intval($descuento_ptj_dif) ?>%</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format(abs($total_descuento_venta), 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_iva, 0, ",", ".") ?></strong></td>
	<?php if ($existe_servicio_propina <> '0') { ?>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto_propina, 0, ",", ".") ?></strong></td>
	<?php } ?>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
</table>

<?php if ($cod_tipo_pago == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong>RECIBIDO</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong>CAMBIO</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($vlr_cancelado, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($vlr_cambio, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
</table>
<?php } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
</table>
<?php } ?>


<?php if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') { ?>
<?php } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:20%; font-family: Courier; font-size:8pt;"><strong>RESUMEN DE IMPUESTOS</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>TIPO</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>COMPRA</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>BASE/IMP</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>IVA</strong></td>
</td>
<?php
$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19')";
$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5')";
$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0')";
$consulta_total_tipos_iva_0 = mysqli_query($conectar, $sql_total_tipos_iva_0) or die(mysqli_error($conectar));
$datos_total_tipos_iva_0 = mysqli_fetch_assoc($consulta_total_tipos_iva_0);

$total_venta_0                         = $datos_total_tipos_iva_0['total_venta'];
$total_base_iva_0                      = $datos_total_tipos_iva_0['total_base_iva'];
$total_iva_0                           = $datos_total_tipos_iva_0['total_iva'];
//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;

$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc) AS total_precio_ipc
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

$total_precio_ipc                      = $datos_total_tipos_iva_ipc['total_precio_ipc'];
$total_valor_base                      = $total_base_iva_19 + $total_base_iva_5 + $total_base_iva_0;
$total_valor_iva                       = $total_iva_19 + $total_iva_5 + $total_iva_0;
$total_valor_total                     = $total_venta_19 + $total_venta_5 + $total_venta_0;
//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;
/*
$resultado_sql = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$nombre_tipo_iva             = $info_venta['nombre_tipo_iva'];
$descripcion_tipo_iva        = $info_venta['descripcion_tipo_iva'];
$iva                         = $info_venta['iva'];

$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (iva_ptj = '$iva_ptj')";
$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

$total_venta                         = $datos_total_tipos_iva['total_venta'];
$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
$total_iva                           = $datos_total_tipos_iva['total_iva'];
*/
?>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:8pt;"><strong>G=19%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_19, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_base_iva_19, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_iva_19, 0, ",", ".") ?></strong></td>
</tr>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:8pt;"><strong>S=5%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_5, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_base_iva_5, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_iva_5, 0, ",", ".") ?></strong></td>
</tr>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:8pt;"><strong>A=0%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_0, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_base_iva_0, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_iva_0, 0, ",", ".") ?></strong></td>
</tr>
<?php //} ?>
</table>
<?php } ?>


<?php 
$sql_total_imp_bolsa = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '0000')";
$consulta_total_imp_bolsa = mysqli_query($conectar, $sql_total_imp_bolsa) or die(mysqli_error($conectar));
$total_imp_bolsa = mysqli_num_rows($consulta_total_imp_bolsa);
$datos_total_imp_bolsa = mysqli_fetch_assoc($consulta_total_imp_bolsa);

$total_venta_imp_bolsa                 = $datos_total_imp_bolsa['total_venta'];
$total_base_iva_imp_bolsa              = $datos_total_imp_bolsa['total_base_iva'];
$total_iva_imp_bolsa                   = $datos_total_imp_bolsa['total_iva'];

if (intval($total_venta_imp_bolsa) == '0') { } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>IMP A LA BOLSA</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_imp_bolsa, 0, ",", ".") ?></strong></td>
</tr>
</table>
<?php } ?>


<?php 
$sql_total_impoconsumo = "SELECT Sum(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
$consulta_total_impoconsumo = mysqli_query($conectar, $sql_total_impoconsumo) or die(mysqli_error($conectar));
$total_impoconsumo = mysqli_num_rows($consulta_total_impoconsumo);
$datos_total_impoconsumo = mysqli_fetch_assoc($consulta_total_impoconsumo);

$total_impoconsumo                     = $datos_total_impoconsumo['total_impoconsumo'];

if (intval($total_impoconsumo) == '0') { } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong>I = IMPO CONSUMO</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_impoconsumo, 0, ",", ".") ?></strong></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>FACTURA <?php echo $nombre_tipo_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>RESOLUCION DIAN: <?php echo $numero_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>DESDE <?php echo $prefijo_resolucion_facturacion ?> <?php echo ($ini_resolucion_facturacion) ?> AL <?php echo $prefijo_resolucion_facturacion ?> <?php echo $fin_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>REGIMEN <?php echo $regimen_emp ?></strong></td>
  </tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong>Muchas gracias por su preferencia</strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_php"></div></td>
  </tr>
</table>

<?php if ($cod_estado_encuesta_experiencia_compra_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Califica tu experiencia de compra en</strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $url_encuesta_experiencia_compra ?></strong></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;"><div id="qrcode"></div></td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;"><strong>ESCANEAME</strong></td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:8pt;">.</td>
  </tr>
</table>
<?php } ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrm58 ==></strong></td>
  </tr>
</table>


<?php if ($cod_estado_btn_imprimir_venta_nav_zapateria_global == '1') { ?>
<div id="area_imprimible_invisible_cocina" style="width: 99%;text-align: center;">
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:12pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TICKET</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?> | <?php echo $fecha_hora; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>USUARIO (A): <?php echo $usario_vendedor; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>ID: <?php echo $cod_info_factura_strpad; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>CANT</strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:7pt;">..</th><?php } ?>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>DESCRIPCION</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.TOTAL</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<?php
$total_venta_temp = 0;
$condicional_entero = "";

$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

	$cod_producto                = $info_venta['cod_producto'];
	$cod_producto_barra          = $info_venta['cod_producto_barra'];
	$nombre_producto             = $info_venta['nombre_producto'];
	$und_venta                   = $info_venta['und_venta'];
	$comentario_producto         = $info_venta['comentario_producto'];
	$precio_venta_producto       = $info_venta['precio_venta_producto'];
	$total_venta_producto        = $info_venta['total_venta_producto'];
	$total_venta_temp           += $total_venta_producto;
	$comentario_producto         = $info_venta['comentario_producto'];
	$und_caja_sobre              = $info_venta['und_caja_sobre'];
	$cajas_sobre                 = $info_venta['cajas_sobre'];
	$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
	$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

  if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
  if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
  if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
  if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta.$subtitulo_tipo_caja ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_tipo_und_caja_sobre ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:5%; font-family: Courier; font-size:5pt;"><strong></strong></td>
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
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>TOTAL</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>ABANADO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>PENDIENTE</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:5pt;"><strong></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_zapateria_php"></div></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrmzap58 ==></strong></td>
  </tr>
</table>
</div>
<?php } ?>

<?php } else { ?>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?>|<?php echo $fecha_hora; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:8pt;"><strong>FACTURA DE VENTA: <?php echo $prefijo_resolucion_facturacion.' '.$cod_factura; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TIPO DE PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_tipo_identificacion; ?> CLIENTE: <?php echo $cedula_cli.$digito_tercero; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CLIENTE: <?php echo utf8_decode($nombre_cliente); ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CAJA: <?php echo $cod_caja; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_concepto_multi_virtual; ?> VIRTUAL: <?php echo $cod_base_caja; ?></strong></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>VENDEDOR (A): <?php echo $usario_vendedor; ?></strong></td>
    <?php if ($cod_estado_peso_producto_global == '1') { ?>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TOTAL PESO (KG): <?php echo number_format($total_peso_producto, 0, ",", "."); ?></strong></td>
    <?php } ?>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>CANT</strong></td>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:7pt;">..</th><?php } ?>
<td style="text-align: center; width:50%; font-family: Courier; font-size:7pt;"><strong>DESCRIPCION</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.UNIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.TOTAL</strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<?php
if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }


$resultado_sql = "SELECT $select_productos_imp 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND ((cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222')) 
$condcional_mostrar_subproductos_imprimir $agrupar_productos_imp $ordenamiento ";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

	$cod_producto                = $info_venta['cod_producto'];
	$cod_producto_barra          = $info_venta['cod_producto_barra'];
	$nombre_producto             = $info_venta['nombre_producto'];
	$und_venta                   = $info_venta['und_venta'];
	$precio_venta_producto       = $info_venta['precio_venta_producto'];
	$total_venta_producto        = $info_venta['total_venta_producto'];
	$iva_ptj                     = $info_venta['iva_ptj'];
	$precio_ipc                  = $info_venta['precio_ipc'];
	$comentario_producto         = $info_venta['comentario_producto'];
	$und_caja_sobre              = $info_venta['und_caja_sobre'];
	$cajas_sobre                 = $info_venta['cajas_sobre'];
	$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
	$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

	if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
	if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
	if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

	$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
	$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
	$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

	$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

	if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong><?php echo $und_venta.$subtitulo_tipo_caja ?></strong></td>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
<td style="text-align: left; width:50%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong><?php echo $nombre_tipo_iva ?></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>SUBTOTAL</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>%DESC</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>$DESC</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>IVA</strong></td>
	<?php if ($existe_servicio_propina <> '0') { ?>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto_propina." ".$ptj_servicio_propina."%" ?></strong></td>
	<?php } ?>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($subtotal_base_sin_descuento, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo intval($descuento_ptj_dif) ?>%</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format(abs($total_descuento_venta), 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva, 0, ",", ".") ?></strong></td>
	<?php if ($existe_servicio_propina <> '0') { ?>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_producto_propina, 0, ",", ".") ?></strong></td>
	<?php } ?>
  </tr>
</table>



<?php if ($cod_tipo_pago == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:7pt;"><strong>RECIBIDO</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong>CAMBIO</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($vlr_cancelado, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($vlr_cambio, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
</table>
<?php } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:7pt;"><strong></strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:7pt;"><strong></strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:9pt;"><strong></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
</table>
<?php } ?>



<?php if ($regimen_emp == 'NO_RESPONSABLE_DE_IVA') { ?>
<?php } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width:20%; font-family: Courier; font-size:7pt;"><strong>RESUMEN DE IMPUESTOS</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>TIPO</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>COMPRA</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>BASE/IMP</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>IVA</strong></td>
</td>
<?php
$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19')";
$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5')";
$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0')";
$consulta_total_tipos_iva_0 = mysqli_query($conectar, $sql_total_tipos_iva_0) or die(mysqli_error($conectar));
$datos_total_tipos_iva_0 = mysqli_fetch_assoc($consulta_total_tipos_iva_0);

$total_venta_0                         = $datos_total_tipos_iva_0['total_venta'];
$total_base_iva_0                      = $datos_total_tipos_iva_0['total_base_iva'];
$total_iva_0                           = $datos_total_tipos_iva_0['total_iva'];
//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;

$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc) AS total_precio_ipc
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

$total_precio_ipc                      = $datos_total_tipos_iva_ipc['total_precio_ipc'];
$total_valor_base                      = $total_base_iva_19 + $total_base_iva_5 + $total_base_iva_0;
$total_valor_iva                       = $total_iva_19 + $total_iva_5 + $total_iva_0;
$total_valor_total                     = $total_venta_19 + $total_venta_5 + $total_venta_0;
//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;
/*
$resultado_sql = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$nombre_tipo_iva             = $info_venta['nombre_tipo_iva'];
$descripcion_tipo_iva        = $info_venta['descripcion_tipo_iva'];
$iva                         = $info_venta['iva'];

$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (iva_ptj = '$iva_ptj')";
$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

$total_venta                         = $datos_total_tipos_iva['total_venta'];
$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
$total_iva                           = $datos_total_tipos_iva['total_iva'];
*/
?>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong>G=19%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_19, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_base_iva_19, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva_19, 0, ",", ".") ?></strong></td>
</tr>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong>S=5%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_5, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_base_iva_5, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva_5, 0, ",", ".") ?></strong></td>
</tr>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong>A=0%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_0, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_base_iva_0, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva_0, 0, ",", ".") ?></strong></td>
</tr>
<?php //} ?>
</table>
<?php } ?>

<?php 
$sql_total_imp_bolsa = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '0000')";
$consulta_total_imp_bolsa = mysqli_query($conectar, $sql_total_imp_bolsa) or die(mysqli_error($conectar));
$total_imp_bolsa = mysqli_num_rows($consulta_total_imp_bolsa);
$datos_total_imp_bolsa = mysqli_fetch_assoc($consulta_total_imp_bolsa);

$total_venta_imp_bolsa                 = $datos_total_imp_bolsa['total_venta'];
$total_base_iva_imp_bolsa              = $datos_total_imp_bolsa['total_base_iva'];
$total_iva_imp_bolsa                   = $datos_total_imp_bolsa['total_iva'];

if (intval($total_venta_imp_bolsa) == '0') { } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>IMP A LA BOLSA</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_imp_bolsa, 0, ",", ".") ?></strong></td>
</tr>
</table>
<?php } ?>


<?php 
$sql_total_impoconsumo = "SELECT Sum(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
$consulta_total_impoconsumo = mysqli_query($conectar, $sql_total_impoconsumo) or die(mysqli_error($conectar));
$total_impoconsumo = mysqli_num_rows($consulta_total_impoconsumo);
$datos_total_impoconsumo = mysqli_fetch_assoc($consulta_total_impoconsumo);

$total_impoconsumo                     = $datos_total_impoconsumo['total_impoconsumo'];

if (intval($total_impoconsumo) == '0') { } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>I = IMPO CONSUMO</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_impoconsumo, 0, ",", ".") ?></strong></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><=============================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>FACTURA <?php echo $nombre_tipo_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>RESOLUCION DIAN: <?php echo $numero_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>DESDE <?php echo $prefijo_resolucion_facturacion ?> <?php echo ($ini_resolucion_facturacion) ?> AL <?php echo $prefijo_resolucion_facturacion ?> <?php echo $fin_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>REGIMEN <?php echo $regimen_emp ?></strong></td>
  </tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>Muchas gracias por su preferencia</strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><div id="codigo_codabar_php"></div></td>
  </tr>
</table>

<?php if ($cod_estado_encuesta_experiencia_compra_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong>Califica tu experiencia de compra en</strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong><?php echo $url_encuesta_experiencia_compra ?></strong></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;"><div id="qrcode"></div></td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;"><strong>ESCANEAME</strong></td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
  </tr>
</table>
<?php } ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrm80 ==></strong></td>
  </tr>
</table>

<?php if ($cod_estado_btn_imprimir_venta_nav_zapateria_global == '1') { ?>
<div id="area_imprimible_invisible_cocina" style="width: 99%;text-align: center;">
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:12pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TICKET</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?> | <?php echo $fecha_hora; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>USUARIO (A): <?php echo $usario_vendedor; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>ID: <?php echo $cod_info_factura_strpad; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>CANT</strong></td>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><th style="text-align: center; width:10%; font-family: Courier; font-size:7pt;">..</th><?php } ?>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>DESCRIPCION</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.TOTAL</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<?php
$total_venta_temp = 0;
$condicional_entero = "";

$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

	$cod_producto                = $info_venta['cod_producto'];
	$cod_producto_barra          = $info_venta['cod_producto_barra'];
	$nombre_producto             = $info_venta['nombre_producto'];
	$und_venta                   = $info_venta['und_venta'];
	$comentario_producto         = $info_venta['comentario_producto'];
	$precio_venta_producto       = $info_venta['precio_venta_producto'];
	$total_venta_producto        = $info_venta['total_venta_producto'];
	$total_venta_temp           += $total_venta_producto;
	$comentario_producto         = $info_venta['comentario_producto'];
	$und_caja_sobre              = $info_venta['und_caja_sobre'];
	$cajas_sobre                 = $info_venta['cajas_sobre'];
	$nombre_tipo_und_caja_sobre  = $info_venta['nombre_tipo_und_caja_sobre'];
	$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

  if ($cajas_sobre == '0') { $cajas_sobre = 1; } else { $cajas_sobre = $cajas_sobre; }
  if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_caja_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $precio_venta_producto = $precio_venta_producto * $cajas_sobre; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $precio_venta_producto = $precio_venta_producto; $subtitulo_tipo_caja = ""; } }
  if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
  if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta.$subtitulo_tipo_caja ?></strong></td>
<?php if ($cod_estado_comentario_venta_mostrar_imprimir_global == '1') { ?><td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:5%; font-family: Courier; font-size:5pt;"><strong></strong></td>
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
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>TOTAL</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>ABANADO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>PENDIENTE</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:5pt;"><strong></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_zapateria_php"></div></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrmzap80 ==></strong></td>
  </tr>
</table>
</div>
<?php } ?>

</div>
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
<script>
window.onload = function() {
var cod_estado_habilitar_btn_imp_venta_nav_global = "<?php echo $cod_estado_habilitar_btn_imp_venta_nav_global ?>";
console.log("cod_estado_habilitar_btn_imp_venta_nav_global = "+cod_estado_habilitar_btn_imp_venta_nav_global);

if (cod_estado_habilitar_btn_imp_venta_nav_global == '0') {
	document.getElementById("foco_btn_imprimir").focus();
} else {
	document.getElementById("btnImprimir").focus();
}
}
</script>

<script>  
$(document).ready(function(){  
  $('#btnImprimir').click(function(){
  var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;  
    $.ajax({ url:"imprimir_factura_venta_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta }, 
     success: function(response){
         if(response==1){
             //alert('Imprimiendo....');
         }else{
             //alert('Error');
         }
     }
    });
  document.getElementById("listo").focus();  
  });
});  
</script>

<script> 
$(document).ready(function(){  
  $('#btnAbrirCaja').click(function(){
  var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;
    $.ajax({ url:"imprimir_abrir_caja_reg_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta }, 
     success: function(response){
         if(response==1){
             //alert('Imprimiendo....');
         }else{
             //alert('Error');
         }
     }
    });
  document.getElementById("listo").focus();  
  });
});  
</script>

<script type="text/javascript">
/*
var qrcode = new QRCode(document.getElementById("qrcode"), {
  width : 60,
  height : 60
});
function makeCode () {    
  var text = "https://editaxe.xyz";
  qrcode.makeCode(text);
}
makeCode();
*/
</script>

</body>
</html>