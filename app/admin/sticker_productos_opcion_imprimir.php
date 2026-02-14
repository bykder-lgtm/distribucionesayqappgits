<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a></td>
    <td style="text-align:center;"><a href="../admin/imprimir_stiker_productos_estante_con_barras.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker?>&cod_factura=<?php echo $cod_factura?>&fecha=<?php echo $fecha_hoy?>&origen=PARACLINICOS&destino=FACTURA" target="_blank"><img src="../imagenes/imprimir_.png"></a></td>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
  </tr>
</table>
</center>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<table border="0" width="250px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<?php
$incremento                 = 0;
$mostrar_datos_sql = "SELECT und_venta, nombre_producto, cod_producto_barra FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

$und_venta                  = $datos['und_venta'];
$nombre_producto            = $datos['nombre_producto'];
$cod_producto_barra         = $datos['cod_producto_barra'];
$incremento++;

for ($i=0; $i < $und_venta; $i++) {
?>
<tr>
<td style="text-align: center; width:99%; font-family: Courier; font-size:7pt;"><?php echo $nombre_producto ?></td>
</tr>
<tr>
<td style="text-align: center; width:99%; font-family: Courier; font-size:7pt;"><div id="codigo_codabar_php<?php echo $incremento ?>"></div></td>
</tr>
<tr>
<td style="text-align: center; width:99%; font-family: Courier; font-size:7pt;"><?php echo $cod_producto_barra ?></td>
</tr>
<tr>
<td style="text-align: center; width:99%; font-family: Courier; font-size:7pt;">---------------------------------</td>
</tr>
<script>
$("#codigo_codabar_php"+<?php echo $incremento ?>).html('<img src="class_php\\barcode.php?text='+<?php echo $cod_producto_barra ?>+'&size=25&codetype=Code128&print=false"/>');
</script>
<?php } ?>

<?php } ?>
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