<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
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
<!--<a class="btn btn-primary" href="#"><h6>Reporte Compras Retencion en la Fuente por Rango de Fechas</h6></a>-->
</div>
<?php $nombre_certificado_retefuente = 'RETENCIÓN APLICADA A VENTAS DECLARANTES'; ?>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_certificado_retencion_en_la_fuente_venta.php"><font size='+1'>Registrar Certificado Retefuente Por Reporte de Ventas</font></a></th>
    </tr>
</table>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$seleccionado                                = 0;
$cod_tercero                                 = 0;
$nombre_tipo_factura                         = "ELECTRONICA";

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);
    $fecha                                   = date("Y-m-d");
} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
    $cod_tercero                             = 0;
    $nombre_tipo_factura                     = "ELECTRONICA";
    $fecha                                   = date("Y-m-d");
}
if ($cod_tercero==0) {
    $nombre_cliente                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
$nombre_origen_modulo                    = "VENTA";
$nombre_origen_creacion                  = "REPORTE";
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
  <tr>
    <td style="text-align:left;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
            <?php if (isset($nombre_tipo_factura)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura ORDER BY nombre_tipo_factura DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $motivo                                  = 'TODOS';
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $fecha                                   = date("Y/m/d");
    $pagina                                  = $_SERVER['PHP_SELF'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_tercero==0) {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
    $filtro_consulta_tercero_productos_rel = "";
} else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_info_factura_venta.cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_productos_rel = "AND (tbl15_factura_compra_producto.cod_tercero = '$cod_tercero')";
}

if ($nombre_tipo_factura=="0") {
    $filtro_consulta_nombre_tipo_factura = "";
    $filtro_consulta_nombre_tipo_factura_rel = "";
} else {
    $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
    $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_info_factura_venta.nombre_tipo_factura = '$nombre_tipo_factura')";
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
    $cod_servicio_propina                                           = '22222222';
    $cod_servicio_cava                                              = '55555555';
    $cod_servicio_domicilio                                         = '44444444';
    $cod_servicio_descuento_punto_redimible                         = '11112222';
    $cod_servicio_descuento                                         = '33333333';
    $cod_servicio_imp_bolsa                                         = '11111111';
    $cod_servicio_retefuente                                        = '11113333';
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
    $subtotal_base_retencion_auxiliar                               = 0;
    $total_rete_fuente_valor_retenido_auxiliar                      = 0;
    $subtotal_base_retencion                                        = 0;
    $total_rete_fuente_valor_retenido                               = 0;

    $sql_info_venta = "SELECT cod_info_factura_venta, retefuente_ptj, total_retefuente FROM tbl15_info_factura_venta 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (nombre_estado_factura = 'CERRADA') AND (retefuente_ptj <> '0') $filtro_consulta_tercero $filtro_consulta_nombre_tipo_factura";
    $consulta_info_venta = mysqli_query($conectar, $sql_info_venta) or die(mysqli_error($conectar));
    while ($datos_info_venta = mysqli_fetch_assoc($consulta_info_venta)) {

        $cod_info_factura_venta                      = $datos_info_venta['cod_info_factura_venta'];
        $retefuente_ptj                              = $datos_info_venta['retefuente_ptj'];
        $total_retefuente                            = $datos_info_venta['total_retefuente'];

        $sql_retefuente_en_factura = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_retencion 
        FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
        AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente')";
        $resultado_retefuente_en_factura  = mysqli_query($conectar, $sql_retefuente_en_factura);
        $info_retefuente_en_factura = mysqli_fetch_assoc($resultado_retefuente_en_factura);

        $subtotal_base_retencion_auxiliar                           = $info_retefuente_en_factura['subtotal_base_retencion'];
        $total_rete_fuente_valor_retenido_auxiliar                  = $subtotal_base_retencion_auxiliar * ($retefuente_ptj/100);
        $subtotal_base_retencion                                   += $subtotal_base_retencion_auxiliar;
        $total_rete_fuente_valor_retenido                          += $total_rete_fuente_valor_retenido_auxiliar;
    }
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped">
<tr>
<td style="text-align:left;">TERCERO: <?php echo $nombre_cliente ?></td>
<td style="text-align:left;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?></td>
<td style="text-align:left;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?></td>
</tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
    <tr>
        <th style="text-align:center;"><a href="#">BASE RETENCION</a></th>
        <th style="text-align:center;"><a href="#">VALOR RETENIDO</a></th>
        <th style="text-align:center;"><a href="#">DESCARGAR CERTIFICADO DE RETENCION PDF</a></th>
    </tr>
    <tr>
        <td style="text-align:center;"><?php echo number_format($subtotal_base_retencion, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_rete_fuente_valor_retenido, 0, ",", ".") ?></td>
        <td style="text-align:center;"><a href="../admin/certificado_de_retencion_en_la_fuente_en_venta_por_reporte_reg.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_tercero=<?php echo $cod_tercero?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&nombre_origen_modulo=<?php echo $nombre_origen_modulo?>&nombre_origen_creacion=<?php echo $nombre_origen_creacion?>&nombre_certificado_retefuente=<?php echo $nombre_certificado_retefuente?>" target="_blank"><img src=../imagenes/pdf.png alt="imprimir_peq"></a></td>
    </tr>
</table>

<hr>
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#"><strong>VENTAS POR FACTURA</strong></a></th>
</tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        
        <th style="text-align:center">Tipo Factura</th>
        <th style="text-align:center">Factura</th>
        <th style="text-align:center">Cliente</th>
        <th style="text-align:center">%Rete Fuente</th>
        <th style="text-align:center">Base Retencion</th>
        <th style="text-align:center">Valor Retenido</th>
        <th style="text-align:center">Total Venta</th>
        <th style="text-align:center">Tipo Pago</th>
        <th style="text-align:center">Vendedor</th>
        <th style="text-align:center">Fecha | Hora</th>
        <th style="text-align:center">Id</th>
    </tr>
</thead>
<tbody>
<?php
$subtotal_base_retencion_auxiliar                               = 0;
$total_rete_fuente_valor_retenido_auxiliar                      = 0;
$subtotal_base_retencion                                        = 0;
$total_rete_fuente_valor_retenido                               = 0;

$sql_cliente = "SELECT tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, tbl15_info_factura_venta.nombre_tipo_factura, 
tbl15_info_factura_venta.retefuente_ptj, tbl15_info_factura_venta.total_precio_venta, tbl15_info_factura_venta.fecha_anyo, tbl15_info_factura_venta.cod_administrador, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_info_factura_venta.fecha_hora, 
tbl15_tercero.direccion_tercero, tbl15_info_factura_venta.cuenta, tbl15_info_factura_venta.cod_tipo_pago, tbl15_info_factura_venta.cod_tipo_forma_pago  
FROM tbl15_tercero RIGHT JOIN tbl15_info_factura_venta ON tbl15_tercero.cod_tercero = tbl15_info_factura_venta.cod_tercero 
WHERE (tbl15_info_factura_venta.fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_info_factura_venta.nombre_estado_factura = 'CERRADA') AND (tbl15_info_factura_venta.retefuente_ptj <> '0')
$filtro_consulta_tercero_rel $filtro_consulta_nombre_tipo_factura_rel
ORDER BY tbl15_info_factura_venta.cod_info_factura_venta DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_info_factura_venta                  = $info_cliente['cod_info_factura_venta'];
    $cod_factura                             = $info_cliente['cod_factura'];
    $fecha_anyo                              = $info_cliente['fecha_anyo'];
    $cod_administrador_db                    = $info_cliente['cod_administrador'];
    $nombre_propietario                      = $info_cliente['nombre1_tercero'];
    $cod_tipo_pago                           = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago                     = $info_cliente['cod_tipo_forma_pago'];
    $nombre_tipo_factura                     = $info_cliente['nombre_tipo_factura'];
    $retefuente_ptj                          = $info_cliente['retefuente_ptj'];
    $total_precio_venta                      = $info_cliente['total_precio_venta'];
    $fecha_hora                              = $info_cliente['fecha_hora'];

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $sql_retefuente_en_factura = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_retencion 
    FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
    AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente')";
    $resultado_retefuente_en_factura  = mysqli_query($conectar, $sql_retefuente_en_factura);
    $info_retefuente_en_factura = mysqli_fetch_assoc($resultado_retefuente_en_factura);

    $subtotal_base_retencion_auxiliar                           = $info_retefuente_en_factura['subtotal_base_retencion'];
    $total_rete_fuente_valor_retenido_auxiliar                  = $subtotal_base_retencion_auxiliar * ($retefuente_ptj/100);
    $subtotal_base_retencion                                   += $subtotal_base_retencion_auxiliar;
    $total_rete_fuente_valor_retenido                          += $total_rete_fuente_valor_retenido_auxiliar;
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo $cod_factura?></td>
        <td style="text-align:left"><?php echo $nombre_propietario?></td>
        <td style="text-align:center"><?php echo $retefuente_ptj?>%</td>
        <td style="text-align:center;"><?php echo number_format($subtotal_base_retencion, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_rete_fuente_valor_retenido, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
        <td style="text-align:center"><?php echo $cuenta?></td>
        <td style="text-align:center"><?php echo $fecha_anyo?> | <?php echo $fecha_hora?></td>
        <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->

<script>
function printPageArea(areaID){

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

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
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>REPORTE COMPRAS</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>VENDEDOR: <?php echo $cuenta_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>DEPENDENCIA: <?php echo $nombre_dependencia_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TIPO PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA INI: <?php echo $fecha_ymd_venta_producto_ini; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'_'?></strong>_imp_repvent</td>
  </tr>
</table>
</div>
<?php } ?>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>