<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-barcode.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_cuentas_cobrar_abonos_editable.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>


</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);
$cliente                        = addslashes($_GET['cliente']);
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = "../admin/cuentas_cobrar_abonos.php"; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta, cod_info_factura_venta, nombre1_tercero FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                    = $sum_monto_deuda['total_venta'];
$total_abonado                  = $sum_abonos['total_abonado'];
$total_deuda                    = $total_venta - $total_abonado;
$cod_info_factura_venta         = $sum_monto_deuda['cod_info_factura_venta'];
$nombre1_tercero_ext            = $sum_monto_deuda['nombre1_tercero'];

if ($nombre1_tercero_ext <> '') { $nombre1_tercero_ext = ' | '.$nombre1_tercero_ext; } else { $nombre1_tercero_ext = ''; }

$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
?>
<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura ?>";
var estandar_barras = "code128";
var renderer = "css";
//var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 40, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
//$("#barcodeTarget").html("").show().barcode(cod_factura, estandar_barras, settings);
var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong><a href="../admin/cuentas_cobrar_detalle_factura.php?cod_tercero=<?php echo $cod_tercero?>"><font size="5px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="6px">ABONOS CLIENTE: <?php echo $nombre_cliente.$nombre1_tercero_ext ;?> </font></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="6px">FACTURA: <?php echo $cod_factura; ?></font></strong></td>
</tr>
<?php if ($total_deuda <> '0') { ?>
<tr>
<td style="text-align: center;"><a href="../admin/modificar_cuentas_cobrar.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>&cod_tercero=<?php echo $cod_tercero?>&cod_factura=<?php echo $cod_factura?>&pagina=<?php echo $pagina?>"><font size="6px">NUEVO ABONO</font></a></td>
</tr>
<?php } ?>
</table>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
<!--<td style="text-align: center;"><a href="../admin/descargar_abonos_cuentas_cobrar_por_factura_xls.php?cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>"><img src=../imagenes/btn_xls.png alt="btn_xls"></a></td>-->
</tr>
</table>
<br>

<table class="table table-striped">
    <tr>
        <td style="text-align: center;"><strong>ABONOS</strong></td>
        <td style="text-align: center;"><strong>PAGO A</strong></td>
        <td style="text-align: center;"><strong>MENSAJE</strong></td>
        <td style="text-align: center;"><strong>FORMA PAGO</strong></td>
        <td style="text-align: center;"><strong>DEPENDENCIA</strong></td>
        <td style="text-align: center;"><strong>FECHA</strong></td>
        <td style="text-align: center;"><strong>HORA</strong></td>
        <td style="text-align: center;"><strong>ID</strong></td>
        <!--<td style="text-align: center;"><strong>IMP</strong></td>-->
    </tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0') ORDER BY cod_cuentas_cobrar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
    $abonado                    = $datos['abonado'];
    $cuenta                     = $datos['cuenta'];
    $mensaje                    = $datos['mensaje'];
    $fecha_pago                 = $datos['fecha_pago'];
    $hora                       = $datos['hora'];
    $cod_dependencia            = $datos['cod_dependencia'];
    $cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];

    $sql_datos_cuenta_cobrar = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $nombre_tipo_forma_pago       = $datos_cuenta_cobrar['nombre_tipo_forma_pago'];

    $sql_datos_movimiento_contable_cuenta_personal_concepto = "SELECT cod_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
    $consulta_datos_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal_concepto);
    $datos_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal_concepto);

    $cod_movimiento_contable_cuenta_personal       = $datos_movimiento_contable_cuenta_personal_concepto['cod_movimiento_contable_cuenta_personal'];

    $sql_datos_movimiento_contable_cuenta_personal = "SELECT nombre_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
    $consulta_datos_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal);
    $datos_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal);

    $nombre_puc       = $datos_movimiento_contable_cuenta_personal['nombre_puc'];
?>
    <tr>
    <?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'abonado', <?php echo $cod_cuentas_cobrar_abonos;?>)" class="cajgrand" id="<?php echo $cod_cuentas_cobrar_abonos;?>" value="<?php echo $abonado;?>" size="3"></td><?php } else { ?><td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td><?php } ?>
    <td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
    <td style="text-align: left;"><font size="4px"><?php echo $mensaje; ?></font></td>
        <td style="text-align: center;">
            <font size="4px">
            <?php echo $nombre_tipo_forma_pago; ?>
            <br>
            <a href="../admin/edit_modificar_cuentas_cobrar_forma_pago_movimiento_contable_cuenta_personal.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_movimiento_contable_cuenta_personal=<?php echo $cod_movimiento_contable_cuenta_personal ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>">(<?php echo $nombre_puc; ?>)</a>
            </font>
        </td>
    <td style="text-align: center">
        <select name="cod_dependencia" id="<?php echo $cod_cuentas_cobrar_abonos; ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_dependencia)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_dependencia'];
            $nombre = $datos2['nombre_dependencia'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align: center;"><font size="4px"><?php echo $fecha_pago; ?></font></td>
    <td style="text-align: center;"><font size="4px"><?php echo $hora; ?></font></td>
    <td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_cobrar_abonos; ?></font></td>
    <!--<td style="text-align: center;"><a href="../admin/cuentas_cobrar_abonos_imprimir_80mm_pdf.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos?>&cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>"  target="_blank"><img src=../imagenes/imprimir_imgpeq.png alt="imprimir_imgpeq"></a></td>-->
    </tr>
<?php } ?>
</table>

<table class="table table-striped">
<tr>
<td align="left"><font size="6">TOTAL CREDITO: </font></td><td style="text-align: right;"><font size="6"><?php echo number_format($total_venta, 0, ",", "."); ?></font></td>
</tr>
<tr>
<td align="left"><font size="6">TOTAL ABONADO: </font></td><td style="text-align: right;"><font size="6"><?php echo number_format($total_abonado, 0, ",", "."); ?></font></td>
</tr>
<tr>
<td align="left"><font size="7">TOTAL PENDIENTE: </font></td><td style="text-align: right;"><font size="7"><?php echo number_format($total_deuda, 0, ",", "."); ?></font></td>
</tr>
</table>
</form>

<hr>
<?php if ($cod_estado_tipo_venta_zapateria_global == '1') { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">CANTIDAD</th>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">COMENTARIO</th><?php } ?>
<th style="text-align:center;">VALOR UNITARIO</th>
<th style="text-align:center;">VALOR TOTAL</th>
</tr>
</thead>
<tbody>
<?php
$incre = 0;

$sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {
              
    $cod_venta_producto                = $datos_venta_producto['cod_venta_producto'];
    $cod_producto                      = $datos_venta_producto['cod_producto'];
    $cod_producto_barra                = $datos_venta_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_venta_producto['nombre_producto'];
    $cedula                            = $datos_venta_producto['cedula'];
    $nombre_cliente                    = $datos_venta_producto['nombre_cliente'];
    $und_venta                         = $datos_venta_producto['und_venta'];
    $precio_compra_producto            = $datos_venta_producto['precio_compra_producto'];
    $precio_costo_producto             = $datos_venta_producto['precio_costo_producto'];
    $total_costo_producto              = $datos_venta_producto['total_costo_producto'];
    $precio_venta_producto             = $datos_venta_producto['precio_venta_producto'];
    $total_venta_producto              = $datos_venta_producto['total_venta_producto'];
    $nombre_tipo_producto              = $datos_venta_producto['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_venta_producto['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_venta_producto['posologia_cantidad'];
    $posologia_peso                    = $datos_venta_producto['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_venta_producto['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_venta_producto['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_venta_producto['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_venta_producto['cod_tipo_cobrar'];
    $cod_info_factura_venta            = $datos_venta_producto['cod_info_factura_venta'];
    $nombre_tipo_precio_venta          = $datos_venta_producto['nombre_tipo_precio_venta'];
    $comentario_producto               = $datos_venta_producto['comentario_producto'];
    $peso_producto                     = $datos_venta_producto['peso_producto'];
    $unidad_medida_peso                = $datos_venta_producto['unidad_medida_peso'];
    $cod_estado_cava                   = $datos_venta_producto['cod_estado_cava'];

    if ($cod_estado_cava == '1') { $img_entrega_cava = "<img src=../imagenes/sem_no_atendido_peq.png>"; $url_entrega_cava = "../admin/marcar_cava_entregada.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_venta_producto=".$cod_venta_producto; } else { $img_entrega_cava = ""; $url_entrega_cava = "#"; }

    $incre++;
?>
<tr style="text-align:left;" id="tr<?php echo $cod_venta_producto;?>">
<td style="text-align:left;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"  id="nombre_producto_<?php echo $incre;?>"><?php echo number_format($und_venta, 0, ",", ".") ?></td>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align:left;"><?php echo $comentario_producto;?></td><?php } ?>
<td style="text-align:right;"  id="nombre_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
<td style="text-align:right;" id="total_venta_producto_<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto;?>">
<?php } ?>
</tbody>
</table>
<?php } ?>
</div>

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

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>ABONOS CUENTAS POR COBRAR (POR FACTURA)</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT CLIENTE: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
    <tr>
        <th style="text-align: left; width:30%; font-family: Courier; font-size:9pt;">ABONO</th>
        <th style="text-align: left; width:30%; font-family: Courier; font-size:9pt;">FECHA</th>
        <th style="text-align: left; width:30%; font-family: Courier; font-size:9pt;">PAGO A</th>
        <th style="text-align: left; width:2%; font-family: Courier; font-size:9pt;"></th>
    </td>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0') ORDER BY fecha_invert DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta)) {

    $cod_cuentas_cobrar_abonos    = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
    $abonado                      = $datos_cuenta_cobrar['abonado'];
    $cuenta                       = $datos_cuenta_cobrar['cuenta'];
    $mensaje                      = $datos_cuenta_cobrar['mensaje'];
    $fecha_pago                   = $datos_cuenta_cobrar['fecha_pago'];
    $hora                         = $datos_cuenta_cobrar['hora'];
?>
    <tr>
        <th style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><?php echo number_format($abonado, 0, ",", ".") ?></th>
        <th style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><?php echo $fecha_pago ?></th>
        <th style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><?php echo $cuenta ?></th>
        <th style="text-align: left; width:2%; font-family: Courier; font-size:9pt;"></th>
    </tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>SALDO PENDIENTE:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_deuda, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"></td>
    <!--<td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"><div id="barcodeTarget" class="barcodeTarget"></div></td>-->
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cob_abon</td>
  </tr>
</table>

    </div>
  </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
    $.ajax({ url:"cuentas_cobrar_abonos_dependencia_ajax.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>
 
</body>
</html>