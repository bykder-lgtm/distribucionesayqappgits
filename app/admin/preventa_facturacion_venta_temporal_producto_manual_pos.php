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
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }
if (isset($_GET['pagina'])) { $pagina_regresar = $_GET['pagina']; } else { $pagina_regresar = '../admin/facturacion_venta_temporal_producto_manual_pos.php'; }

$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];

$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }

$datos_factura = "SELECT cod_venta_producto_temporal, cod_info_factura_venta FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
$datos_consulta = mysqli_fetch_assoc($consulta);

$cod_info_factura_venta            = $datos_consulta['cod_info_factura_venta'];
$seleccionar_todos                 = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_agrupar_por_producto_imp_global == '1') { 
  $agrupar_productos_imp = 'GROUP BY cod_producto_barra';
  $select_productos_imp = 'SUM(und_venta) as und_venta, precio_venta_producto, SUM(total_venta_producto) as total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj'; 
} else { 
  $agrupar_productos_imp = ''; 
  $select_productos_imp = 'und_venta, precio_venta_producto, total_venta_producto, comentario_producto, cod_producto, cod_producto_barra, nombre_producto, iva_ptj'; 
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/preventa_info_factura_venta_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<script>
function printPageArea(areaID){

var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
$("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_info_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

var printContent = document.getElementById(areaID);
$("#area_imprimible_invisible").show();
$("#area_imprimible_invisible_cocina").hide();

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

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<?php if ($cod_estado_check_imp_global == '1') { ?>
<th style="text-align:center;"><input type="checkbox" name="seleccionar_todos" class="seleccionar_todos" id="<?php echo $cod_info_factura_venta ?>" value="0"><strong>TODOS</strong></th>
<?php } ?>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>
<th style="text-align:center;">CANTIDAD</th>
<th style="text-align:center;"></th>
<th style="text-align:center;">VALOR UNITARIO</th>
<th style="text-align:center;">VALOR TOTAL</th>
<th style="text-align:center;">HORA</th>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">OK</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
$cod_producto                      = $datos_venta_producto_temporal['cod_producto'];
$cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                   = $datos_venta_producto_temporal['nombre_producto'];
$cedula                            = $datos_venta_producto_temporal['cedula'];
$nombre_cliente                    = $datos_venta_producto_temporal['nombre_cliente'];
$und_venta                         = $datos_venta_producto_temporal['und_venta'];
$precio_compra_producto            = $datos_venta_producto_temporal['precio_compra_producto'];
$total_costo_producto              = $datos_venta_producto_temporal['total_costo_producto'];
$precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto              = $datos_venta_producto_temporal['total_venta_producto'];
$nombre_tipo_producto              = $datos_venta_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_venta_producto_temporal['posologia_cantidad'];
$posologia_peso                    = $datos_venta_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion          = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_venta_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_venta_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_venta_producto_temporal['cod_tipo_cobrar'];
$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta'];
$nombre_tipo_precio_venta          = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta         = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
$comentario_producto               = $datos_venta_producto_temporal['comentario_producto'];
$fecha_seg_venta_producto          = $datos_venta_producto_temporal['fecha_seg_venta_producto'];
$cod_check_imp                     = $datos_venta_producto_temporal['cod_check_imp'];
$precio_venta_producto_orig        = $datos_venta_producto_temporal['precio_venta_producto_orig'];

$fecha_hora                        = date("H:i:s", $fecha_seg_venta_producto);
$max_precio_venta                  = '';
$min_precio_venta                  = '';

if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
if ($cod_producto_barra == '33333333') { $max_precio_venta = 'max="-1"'; $min_precio_venta = ''; }
if ($cod_producto_barra == '11112222') { $max_precio_venta = 'max="-1"'; $min_precio_venta = "min=".$precio_venta_producto_orig; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<td style="text-align:center;"></td>
<?php if ($cod_estado_check_imp_global == '1') { ?>
<td style="text-align:center;"><div id="listado"><input name="cod_check_imp" class="cod_check_imp" id="cod_check_imp__<?php echo $cod_venta_producto_temporal ?>" type="checkbox" value="0" <?php if($cod_check_imp=='1'){ echo "checked"; } ?>></div></td>
<?php } ?>

<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $comentario_producto ?></td><?php } ?>
<td style="text-align:right;" id="und_venta_<?php echo $incre;?>"><?php echo $und_venta;?></td>
<input name="und_venta" type="hidden" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_venta;?>">

<td style="text-align:center;">
<?php for ($i=1; $i <= $numero_precio_user; $i++) { ?>
<img src="<?php if ($nombre_tipo_precio_venta=="PV$i") { echo "../imagenes/PV".$i."_R.png"; } else { echo "../imagenes/PV$i.png"; } ?>">
<?php } ?>
</td>

<?php if ($cod_producto_barra == '22222222' || $cod_producto_barra == '33333333' || $cod_producto_barra == '11112222') { ?>
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" <?php echo $max_precio_venta;?> <?php echo $min_precio_venta;?> value="<?php echo $precio_venta_producto;?>" style="width: 100px;" /></td>
<?php } else { ?>
<td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", ".");?></td>
<?php } ?>

<td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
<td style="text-align:center;" id="total_venta_producto<?php echo $incre;?>"><?php echo $fecha_hora; ?></td>
<td style="text-align:left;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>
<td style="text-align:center;"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<?php } ?>
</tbody>
</table>

<?php } else { } ?>

</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--<div id="wrapper" style="width: 99%;">-->
<div id="area_imprimible_invisible" style="width: 99%;text-align: center;">
<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:12pt;"><strong><?php echo $nombre_emp; ?></strong></td>
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
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TICKET DE PREVENTA</strong></td>
   </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>ID: <?php echo $cod_info_factura_strpad; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>VENDEDOR (A): <?php echo $nombres_vendedor; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_concepto_multi_virtual; ?>: <?php echo $cod_base_caja; ?></strong></td>
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
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>DESCRIPCION</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.UNIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.TOTAL</strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<?php
$total_venta_temp = 0;
$condicional_entero = "";

$resultado_sql = "SELECT $select_productos_imp FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
AND (cod_producto_barra <> '22222222' AND cod_producto_barra <> '33333333') $agrupar_productos_imp ORDER BY cod_venta_producto_temporal DESC";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$cod_producto                = $info_venta['cod_producto'];
$cod_producto_barra          = $info_venta['cod_producto_barra'];
$nombre_producto             = $info_venta['nombre_producto'];
$und_venta                   = $info_venta['und_venta'];
$precio_venta_producto       = $info_venta['precio_venta_producto'];
$total_venta_producto        = $info_venta['total_venta_producto'];
$total_venta_temp           += $total_venta_producto;

if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong></strong></td>
</tr>
<?php } ?>
</table>

<?php
$sql_servicio_propina = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
AND (cod_producto_barra = '22222222') ORDER BY cod_venta_producto_temporal ASC";
$consulta_servicio_propina = mysqli_query($conectar, $sql_servicio_propina) or die(mysqli_error($conectar));
$existe_servicio_propina = mysqli_num_rows($consulta_servicio_propina);
$info_servicio_propina = mysqli_fetch_assoc($consulta_servicio_propina);

$nombre_producto_propina               = $info_servicio_propina['nombre_producto'];
$precio_venta_producto                 = $info_servicio_propina['precio_venta_producto'];
$total_venta_producto                  = $info_servicio_propina['total_venta_producto'];

$sql_servicio_descuento = "SELECT nombre_producto, precio_venta_producto, total_venta_producto 
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
AND (cod_producto_barra = '33333333') ORDER BY cod_venta_producto_temporal ASC";
$consulta_servicio_descuento = mysqli_query($conectar, $sql_servicio_descuento) or die(mysqli_error($conectar));
$existe_servicio_descuento = mysqli_num_rows($consulta_servicio_descuento);
$info_servicio_descuento = mysqli_fetch_assoc($consulta_servicio_descuento);

$nombre_producto_descuento             = $info_servicio_descuento['nombre_producto'];
$precio_venta_producto_descuento       = $info_servicio_descuento['precio_venta_producto'];
$total_venta_producto_descuento        = $info_servicio_descuento['total_venta_producto'];
?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: left; width: 35%; font-family: Courier; font-size:8pt;"><strong>SUBTOTAL:</strong></td>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: center; width: 35%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($subtotal_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 2%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
<?php if ($existe_servicio_propina <> '0') { ?>
  <tr>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: left; width: 35%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto_propina ?> (<?php echo $ptj_servicio_propina ?>%):</strong></td>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: center; width: 35%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 2%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
<?php } else { } ?>
<?php if ($existe_servicio_descuento <> '0') { ?>
  <tr>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: left; width: 35%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto_descuento ?>:</strong></td>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: center; width: 35%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_descuento, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 2%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
<?php } else { } ?>
  <tr>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: left; width: 35%; font-family: Courier; font-size:8pt;"><strong>TOTAL:</strong></td>
    <td style="text-align: center; width: 0%; font-family: Courier; font-size:8pt;"><strong></strong></td>
    <td style="text-align: center; width: 35%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 2%; font-family: Courier; font-size:8pt;"><strong></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_php"></div></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha.$hora.'-'.$cod_info_factura_strpad ?></strong>-imp_prevnt</td>
  </tr>
</table>
<div>

<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->

<?php if ($cod_estado_btn_imprimir_preventa_cocina_global == '1') { ?>
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
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TICKET DE CHEF</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>ID: <?php echo $cod_info_factura_strpad; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_anyo; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>VENDEDOR (A): <?php echo $nombres_vendedor; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_concepto_multi_virtual; ?>: <?php echo $cod_base_caja; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>PRIORIDAD: <?php echo $cod_prioridad; ?></strong></td>
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
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>DESCRIPCION</strong></td>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align: center; width:20%; font-family: Courier; font-size:8pt;"><strong>OBSERVACION</strong></td><?php } ?>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.UNIT</strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<?php
$total_venta_temp = 0;
$condicional_entero = "";

$resultado_sql = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
AND (cod_check_imp = '1') ORDER BY cod_venta_producto_temporal DESC";
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

if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $comentario_producto ?></strong></td><?php } ?>
<td style="text-align: right; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>
</div>
<?php } ?>
<!--</div>-->
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<script>
$(function(){
$('.seleccionar_todos').prop('checked',true);
$(".seleccionar_todos").change(function(){ if( $(this).is(':checked') ){ $(".seleccionar_todos").val("0"); } else { $(".seleccionar_todos").val("1"); } });
});
</script>

<script>
$('input:checkbox[name="cod_check_imp"]').change(function(){ 
var valor = $(this).val();
var campo = $(this).attr("name");
var id = $(this).attr("id");
let framentador = id.split('__');
var ids = framentador[1];
var cod_check_imp = valor;

if (campo == 'cod_check_imp') { if( $('#cod_check_imp__'+ids).prop('checked') ) { valor = 1; $('#cod_check_imp__'+ids).prop('checked',true); } else { valor = 0; $('#cod_check_imp__'+ids).prop('checked',false); } }

  $.ajax({
      url:"guardar_check_imp_ajax.php",
      method:"POST",
      data:{valor:valor, campo:campo, id:id},
      success:function(data){ 
           $('#result').html(data);
      }
  });

});
</script>

<script>
$('input:checkbox[name="seleccionar_todos"]').change(function(){ 
var valor = $(this).val();
var campo = $(this).attr("name");
var id = $(this).attr("id");
var seleccionar_todos = valor;

$('#listado > input[type=checkbox]').prop('checked', $(this).is(':checked'));

  $.ajax({
      url:"guardar_check_imp_ajax.php",
      method:"POST",
      data:{valor:valor, campo:campo, id:id},
      success:function(data){ 
           $('#result').html(data);
      }
  });

});
</script>

<script>
function calc_total_venta(){

var i=0;
var incre = <?php echo $total_datos;?>;
var und_venta_text = "";
var precio_venta_producto_text = "";
var total_venta_producto_text = "";
var total_venta = 0;
var und_venta = 0;
var precio_venta_producto = 0;
var total_venta_producto = 0;
var smtr_total_venta = 0;
var Max_Length = 4;
var length = 0;

for (i=1; i<=incre; i++){

und_venta_text = "und_venta"+i;
precio_venta_producto_text = "precio_venta_producto"+i;
total_venta_producto_text = "total_venta_producto"+i;
//mensaje_alerta_text = "mensaje_alerta"+i;

//mensaje_alerta = document.getElementById(mensaje_alerta_text).value;
und_venta = document.getElementById(und_venta_text).value;
precio_venta_producto = document.getElementById(precio_venta_producto_text).value;
total_venta_producto = (und_venta * precio_venta_producto);
smtr_total_venta = smtr_total_venta + total_venta_producto;
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
length = document.getElementById(und_venta_text).value.length;
if (length > Max_Length) {
//var objeto_mostrar_mensaje = document.getElementById("mensaje_alerta_"+i);
//objeto_mostrar_mensaje.parentNode.innerHTML = objeto_mostrar_mensaje.parentNode.innerHTML + "<p style='color:yellow'>Verificar</p>";
//  address1.parentNode.innerHTML = address1.parentNode.innerHTML + "<p style='color:red'>the max length of "+Max_Length + " characters is reached, you typed in  " + length + "characters</p>";
console.log(length);
} else {  }
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

document.getElementById(total_venta_producto_text).innerHTML=total_venta_producto.toLocaleString("es-ES");
}
total_venta = smtr_total_venta;
document.getElementById("total_venta").innerHTML=total_venta.toLocaleString("es-ES");
}
</script>