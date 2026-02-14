<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="js/jquery-barcode.js"></script>
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
<h4>
<a class="btn btn-primary" href="../admin/lista_cuentas_cobrar_agrupado_historial_alquiler.php">Regresar</a>
</h4>
</div>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                         = $_SERVER['PHP_SELF'];
$pagina_local                   = $_SERVER['PHP_SELF'];
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);

if (isset($_GET['cod_estado_hoy'])) { $cod_estado_hoy = addslashes($_GET['cod_estado_hoy']); } else { $cod_estado_hoy = '1'; }
if (isset($_GET['cod_estado_pago'])) { $cod_estado_pago = addslashes($_GET['cod_estado_pago']); } else { $cod_estado_pago = '0'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'documento_nombre_inquilino'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
$fecha_hoy                      = date("Y-m-d");

$monto_deuda_smtr               = 0;
$abonado_smtr                   = 0;
$subtotal_smtr                  = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta,
tbl15_cuentas_cobrar.monto_deuda_sin_interes, tbl15_cuentas_cobrar.subtotal_sin_interes, tbl15_cuentas_cobrar.numero_cuota, tbl15_cuentas_cobrar.monto_cuota, 
tbl15_cuentas_cobrar.monto_cuota_sin_interes, tbl15_cuentas_cobrar.interes_ptj, tbl15_cuentas_cobrar.monto_cuota_interes,
tbl15_cuentas_cobrar.nombre_tipo_cobro, tbl15_cuentas_cobrar.cod_tipo_moneda, tbl15_cuentas_cobrar.clausula_alquiler, tbl15_cuentas_cobrar.cod_producto, 
tbl15_cuentas_cobrar.cod_producto_barra, tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_administrador, 
tbl15_cuentas_cobrar.url_img_orig_producto, tbl15_cuentas_cobrar.cod_estado_contrato
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_factura = '$cod_factura') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC LIMIT 0,1";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura                    = $datos_total_facturas['cod_factura'];
$cod_tercero                    = $datos_total_facturas['cod_tercero'];
$monto_deuda                    = $datos_total_facturas['monto_deuda'];
$monto_deuda_sin_interes        = $datos_total_facturas['monto_deuda_sin_interes'];
$subtotal                       = $datos_total_facturas['subtotal'];
$subtotal_sin_interes           = $datos_total_facturas['subtotal_sin_interes'];
$numero_cuota                   = $datos_total_facturas['numero_cuota'];
$monto_cuota                    = $datos_total_facturas['monto_cuota'];
$monto_cuota_sin_interes        = $datos_total_facturas['monto_cuota_sin_interes'];
$interes_ptj                    = $datos_total_facturas['interes_ptj'];
$monto_cuota_interes            = $datos_total_facturas['monto_cuota_interes'];
$nombre_tipo_cobro              = $datos_total_facturas['nombre_tipo_cobro'];
$abonado                        = $datos_total_facturas['abonado'];

$cod_tipo_moneda                = $datos_total_facturas['cod_tipo_moneda'];
$clausula_alquiler              = $datos_total_facturas['clausula_alquiler'];
$cod_producto                   = $datos_total_facturas['cod_producto'];
$cod_producto_barra             = $datos_total_facturas['cod_producto_barra'];
$nombre_producto                = $datos_total_facturas['nombre_producto'];
$cod_estado_contrato            = $datos_total_facturas['cod_estado_contrato'];
$url_img_orig_producto          = $datos_total_facturas['url_img_orig_producto'];
$cod_factura_strpad             = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$numero_alerta                  = '0';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_inquilino = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_inquilino = mysqli_query($conectar, $sql_consulta_inquilino) or die(mysqli_error($conectar));
$total_inquilino = mysqli_fetch_assoc($consulta_inquilino);

$identificacion_tercero_inquilino         = $total_inquilino['identificacion_tercero'];
$nombre1_tercero_inquilino                = $total_inquilino['nombre1_tercero'];
$nombre2_tercero_inquilino                = $total_inquilino['nombre2_tercero'];
$apellido1_tercero_inquilino              = $total_inquilino['apellido1_tercero'];
$apellido2_tercero_inquilino              = $total_inquilino['apellido2_tercero'];
$nombre_cliente_inquilino                 = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$cliente_inquilino                        = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$nombre_tipo_identificacion_inquilino     = $total_inquilino['nombre_tipo_identificacion'];
$telefono1_tercero_inquilino              = $total_inquilino['telefono1_tercero'];
$correo_tercero_inquilino                 = $total_inquilino['correo_tercero'];
$nombre_pais_inquilino                    = $total_inquilino['nombre_pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_tipo_moneda = "SELECT nombre_tipo_moneda FROM tbl15_tipo_moneda WHERE cod_tipo_moneda = '$cod_tipo_moneda'";
$consulta_tipo_moneda = mysqli_query($conectar, $sql_consulta_tipo_moneda) or die(mysqli_error($conectar));
$total_tipo_moneda = mysqli_fetch_assoc($consulta_tipo_moneda);

$nombre_tipo_moneda             = $total_tipo_moneda['nombre_tipo_moneda'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT cod_producto_barra, nombre_producto, nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra               = $total_producto['cod_producto_barra'];
$nombre_producto                  = $total_producto['nombre_producto'];
$nombre_tipo_producto             = $total_producto['nombre_tipo_producto'];
$direccion_producto               = $total_producto['direccion_producto'];
$descripcion_producto             = $total_producto['descripcion_producto'];
$cod_tercero_propietario          = $total_producto['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_estado_contrato = "SELECT nombre_estado_contrato FROM tbl15_estado_contrato WHERE cod_estado_contrato = '$cod_estado_contrato'";
$consulta_estado_contrato = mysqli_query($conectar, $sql_consulta_estado_contrato) or die(mysqli_error($conectar));
$total_estado_contrato = mysqli_fetch_assoc($consulta_estado_contrato);

$nombre_estado_contrato          = $total_estado_contrato['nombre_estado_contrato'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_propietario = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_propietario = mysqli_query($conectar, $sql_consulta_propietario) or die(mysqli_error($conectar));
$total_propietario = mysqli_fetch_assoc($consulta_propietario);

$identificacion_tercero_propietario         = $total_propietario['identificacion_tercero'];
$nombre1_tercero_propietario                = $total_propietario['nombre1_tercero'];
$nombre2_tercero_propietario                = $total_propietario['nombre2_tercero'];
$apellido1_tercero_propietario              = $total_propietario['apellido1_tercero'];
$apellido2_tercero_propietario              = $total_propietario['apellido2_tercero'];
$nombre_cliente_propietario                 = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$cliente_propietario                        = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$nombre_tipo_identificacion_propietario     = $total_propietario['nombre_tipo_identificacion'];
$telefono1_tercero_propietario              = $total_propietario['telefono1_tercero'];
$correo_tercero_propietario                 = $total_propietario['correo_tercero'];
$nombre_pais_propietario                    = $total_propietario['nombre_pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura_strpad ?>";
var estandar_barras = "code128";
var renderer = "css";

var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 40, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
$("#barcodeTarget").html("").show().barcode(cod_factura, estandar_barras, settings);

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
<!--
<table class="table table-striped">
<tr>
<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
</tr>
</table>
-->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL CONTRATO DE ALQUILER</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CODIGO CONTRATO</th>
            <?php if ($url_img_orig_producto <> '') { ?><th style="text-align:center">SOPORTE CONTRATO</th><?php } ?>
            <th style="text-align:center">ESTADO</th>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">EDITAR</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $cod_factura ?></td>
            <?php if ($url_img_orig_producto <> '') { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/adjuntar_archivo.png" class="img-polaroid" alt=""></a></td><?php } ?>          
            <td style="text-align:center"><?php echo $nombre_estado_contrato ?></td>
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar ?></td>
            <td style="text-align:center"><a href="../admin/edit_cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>         
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL INQUILINO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE INQUILINO</th>
            <th style="text-align:center">TIPO DOCUMENTO</th>
            <th style="text-align:center">NUMERO DOCUMENTO</th>
            <th style="text-align:center">TELEFONO / CELULAR</th>
            <th style="text-align:center">CORREO ELECTRONICO</th>
            <!--<th style="text-align:center">NACIONALIDAD</th>-->
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre1_tercero_inquilino ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion_inquilino ?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero_inquilino ?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero_inquilino ?></td>
            <td style="text-align:center"><?php echo $correo_tercero_inquilino ?></td>
            <!--<td style="text-align:center"><?php echo $nombre_pais_inquilino ?></td>-->
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL INMUEBLE</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">TIPO INMUEBLE</th>
            <th style="text-align:center">CODIGO INMUEBLE</th>
            <th style="text-align:center">NOMBRE INMUEBLE</th>
            <th style="text-align:center">DIRECCION INMUEBLE</th>
            <th style="text-align:center">DESCRIPCION INMUEBLE</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_producto ?></td>
            <td style="text-align:center"><?php echo $cod_producto_barra ?></td>
            <td style="text-align:center"><?php echo $nombre_producto ?></td>
            <td style="text-align:center"><?php echo $direccion_producto ?></td>
            <td style="text-align:center"><?php echo $descripcion_producto ?></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
<?php
$sql_consulta = "SELECT * FROM tbl15_archivo_adjunto WHERE (cod_producto = '$cod_producto') ORDER BY fecha_modificacion DESC";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_archivo_adjunto            = $datos_consulta['cod_archivo_adjunto'];
$cod_producto                   = $datos_consulta['cod_producto'];
$cod_producto_barra             = $datos_consulta['cod_producto_barra'];
$fecha_creacion                 = $datos_consulta['fecha_creacion'];
$fecha_hora                     = $datos_consulta['fecha_hora'];
$url_archivo_adjunto            = $datos_consulta['url_archivo_adjunto'];
$nombre_archivo_adjunto         = $datos_consulta['nombre_archivo_adjunto'];
$descripcion_archivo_adjunto    = $datos_consulta['descripcion_archivo_adjunto'];
$formato                        = $datos_consulta['formato'];
?>
            <td style="text-align:center"><!--<a href="<?php echo $url_archivo_adjunto?>" target="_blank">--><?php echo $descripcion_archivo_adjunto; ?><!--</a>--></td>
<?php } ?>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL PROPIETARIO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE PROPIETARIO</th>
            <th style="text-align:center">TIPO DOCUMENTO</th>
            <th style="text-align:center">NUMERO DOCUMENTO</th>
            <th style="text-align:center">TELEFONO / CELULAR</th>
            <th style="text-align:center">CORREO ELECTRONICO</th>
            <!--<th style="text-align:center">NACIONALIDAD</th>-->
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre1_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion_propietario ?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $correo_tercero_propietario ?></td>
            <!--<td style="text-align:center"><?php echo $nombre_pais_propietario ?></td>-->
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>RENOVACIONES</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center;">TIPO ALQUILER</th>
            <th style="text-align:center;">CANTIDAD DE PERIODOS</th>
            <th style="text-align:center;">TIPO MONEDA</th>
            <th style="text-align:center;">PRECIO ALQUILER</th>
            <th style="text-align:center;"># RENOVACION</th>
            <th style="text-align:center;">SALDO A FAVOR</th>
            <th style="text-align:center;">ESTADO</th>
            <th style="text-align:center;">ID</th>
        </tr>
<?php
$monto_deuda_smtr                         = 0;
$abonado_smtr                             = 0;
$subtotal_smtr                            = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_facturas = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_factura = '$cod_factura') AND (cod_estado_archivado = '0') ORDER BY fecha_invert ASC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
while ($datos_total_facturas = mysqli_fetch_array($consulta_total_facturas)) {

$cod_cuentas_cobrar             = $datos_total_facturas['cod_cuentas_cobrar'];
$cod_factura                    = $datos_total_facturas['cod_factura'];
$cod_tercero                    = $datos_total_facturas['cod_tercero'];
$monto_deuda                    = $datos_total_facturas['monto_deuda'];
$monto_deuda_sin_interes        = $datos_total_facturas['monto_deuda_sin_interes'];
$subtotal                       = $datos_total_facturas['subtotal'];
$subtotal_sin_interes           = $datos_total_facturas['subtotal_sin_interes'];
$numero_cuota                   = $datos_total_facturas['numero_cuota'];
$monto_cuota                    = $datos_total_facturas['monto_cuota'];
$monto_cuota_sin_interes        = $datos_total_facturas['monto_cuota_sin_interes'];
$interes_ptj                    = $datos_total_facturas['interes_ptj'];
$monto_cuota_interes            = $datos_total_facturas['monto_cuota_interes'];
$nombre_tipo_cobro              = $datos_total_facturas['nombre_tipo_cobro'];
$abonado                        = $datos_total_facturas['abonado'];
$cod_estado_contratos           = $datos_total_facturas['cod_estado_contrato'];
$cod_renovacion_contrato        = $datos_total_facturas['cod_renovacion_contrato'];
$deduccion_saldo_favor          = $datos_total_facturas['deduccion_saldo_favor'];

$sql_estado_contrato = "SELECT nombre_estado_contrato FROM tbl15_estado_contrato WHERE (cod_estado_contrato = '$cod_estado_contratos')";
$resultado_estado_contrato = mysqli_query($conectar, $sql_estado_contrato);
$info_estado_contrato = mysqli_fetch_assoc($resultado_estado_contrato);
    
$nombre_estado_contrato        = $info_estado_contrato['nombre_estado_contrato'];
?>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_cobro ?></td>
            <td style="text-align:center"><?php echo $numero_cuota ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_moneda ?></td>
            <td style="text-align:center"><?php echo number_format($monto_cuota, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $cod_renovacion_contrato ?></td>
            <td style="text-align:center"><?php echo number_format($deduccion_saldo_favor, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $nombre_estado_contrato ?></td>
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar ?></td>
        </tr>
<?php } ?>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>

<table border="0" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:left"><legend>HISTORIAL DE PAGO - <a href="../admin/renovar_contrato_agrupado_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>">RENOVAR CONTRATO</a></legend></th>
            <th style="text-align:right"><legend><a href="../admin/facturacion_venta_temporal_gasto_inmueble_inquilino_get.php?cod_factura=<?php echo $cod_factura;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>">ULTIMO SALDO A FAVOR: <?php echo number_format($deduccion_saldo_favor, 0, ",", ".") ?></a></legend></th>
        </tr>
    </thead>
</table>

<table class="table table-bordered table-hover table-sm">
    <tr>
        <?php if ($cod_seguridad== '3') { ?><th  style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ELIM</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">EDIT</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">PAGAR</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">NUMERO DE PERIODO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">MES</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">PRECIO ALQUILER</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA LIMITE PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">REG PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">RECIBIDO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ESTADO PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"># RENOVACION</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">CARGAR SOPORTE PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">VER</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ENVIAR</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ID</th>
    </tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_factura = '$cod_factura') AND (cod_estado_archivado = '0') ORDER BY fecha_pago, numero_alerta, cod_cuentas_cobrar_alerta ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

    $cod_cuentas_cobrar_alerta                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
    $cod_cuentas_cobrar                            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
    $numero_alerta                                 = $datos_cuenta_cobrar['numero_alerta'];
    //$cod_factura                                 = $datos_cuenta_cobrar['cod_factura'];
    $monto_deuda                                   = $datos_cuenta_cobrar['monto_deuda'];
    $abonado                                       = $datos_cuenta_cobrar['abonado'];
    $subtotal                                      = $datos_cuenta_cobrar['subtotal'];
    $mensaje                                       = $datos_cuenta_cobrar['mensaje'];
    $fecha_pago                                    = $datos_cuenta_cobrar['fecha_pago'];
    $vendedor                                      = $datos_cuenta_cobrar['vendedor'];
    $monto_deuda_smtr                              = $monto_deuda_smtr + $monto_deuda;
    $monto_cuota                                   = $datos_cuenta_cobrar['monto_cuota'];
    $cod_estado                                    = $datos_cuenta_cobrar['cod_estado'];
    $fecha_pago_reg                                = $datos_cuenta_cobrar['fecha_pago_reg'];
    $hora_pago_reg                                 = $datos_cuenta_cobrar['hora_pago_reg'];
    $cod_cuentas_cobrar_abonos                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
    $url_img_orig_producto                         = $datos_cuenta_cobrar['url_img_orig_producto'];
    $total_recibido                                = $datos_cuenta_cobrar['total_recibido'];
    $total_pendiente                               = $datos_cuenta_cobrar['total_pendiente'];
    $cod_renovacion_contrato                       = $datos_cuenta_cobrar['cod_renovacion_contrato'];

    $fecha_mes                                     = $datos_cuenta_cobrar['fecha_mes'];
    $nombre_tabla_anyo                             = $datos_cuenta_cobrar['anyo'];
    $cod_estado_envio_correo_cuenta_cobro          = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
    $cod_estado_envio_correo_comprobante_ingreso   = $datos_cuenta_cobrar['cod_estado_envio_correo_comprobante_ingreso'];
    $fecha_mes_complet                             = $fecha_mes.'-01';

    $cod_estado_pago                               = 1;
    $cod_tercero                                   = $datos_cuenta_cobrar['cod_tercero'];
    $fecha_pago_periodo_orig                       = $datos_cuenta_cobrar['fecha_pago_periodo_orig'];
    $fecha_pago_dmy                                = date("d-m-Y", strtotime($fecha_pago_periodo_orig));

    if ($fecha_pago_reg <> '') { $fecha_pago_reg_dmy = date("d-m-Y", strtotime($fecha_pago_reg)); } else { $fecha_pago_reg_dmy = ""; }

    $abonado_smtr                                  = $abonado_smtr + $abonado;
    $subtotal_smtr                                 = $subtotal_smtr + $subtotal;

    //$nombre_tabla_mes                              = date("m", strtotime($fecha_pago));
    $nombre_tabla_mes                              = date("m", strtotime($fecha_mes_complet));


    $mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_letra_tabla_mes                   = $matriz_consulta['nombre_letra_tabla_mes'];

    $sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado'";
    $consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
    $matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

    $nombre_estado_pago             = $matriz_estado_pago['nombre_estado_pago'];
    $color_fondo_celda_estado_pago  = $matriz_estado_pago['color_fondo_celda_estado_pago'];
    $color_letra_celda_estado_pago  = $matriz_estado_pago['color_letra_celda_estado_pago'];

    if ($url_img_orig_producto == '') { $existe_archivo_cargado = '0'; } else { $existe_archivo_cargado = '1'; }
    if ($fecha_hoy == $fecha_pago) { $btn_imagen = 'base_caja_pago_hoy.gif'; } elseif ($fecha_hoy > $fecha_pago) { $btn_imagen = 'base_caja_pago_atrasado.gif'; } else { $btn_imagen = 'base_caja.png'; }
?>
    <tr>
        <?php if ($cod_seguridad== '3') { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../modificar_eliminar/eliminar_cuentas_cobrar_y_abonos.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>"><img src=../imagenes/eliminar.png alt="Abonar"></a></td>
        <?php } ?>

        <?php if (($cod_cuentas_cobrar_abonos <> '0') && ($cod_estado == '1')) { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/edit_cuentas_cobro_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>"><img src=../imagenes/editar.png alt="editar"></a></td>
        <?php } else { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td>
        <?php }  ?>

        <?php if ($cod_estado == '0' || $cod_estado == '2') { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/reg_cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina_local;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>"><img src=../imagenes/<?php echo $btn_imagen;?> alt="Abonar"></a></td>
        <?php } else { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/cuentas_cobrar_abonos_alquiler_comprobante_ingreso_imprimir_pdf.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>" target="_blank"><img src=../imagenes/imprimir_peq.png alt="Abonar"></a></td>
        <?php } ?>

        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $numero_alerta;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $nombre_letra_tabla_mes ;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo number_format($monto_cuota, 0, ",", ".") ?></a></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $fecha_pago_dmy;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $fecha_pago_reg_dmy;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo number_format($total_recibido, 0, ",", ".") ?></a></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $nombre_estado_pago;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $cod_renovacion_contrato;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/cuentas_cobrar_alquiler_soporte_pago_archivo_adjunto.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>"><img src=../imagenes/adjuntar_archivo.png alt="Adjuntar"><?php echo $existe_archivo_cargado;?></a></td>
        <?php if ($url_img_orig_producto) { ?><td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td><?php } else { ?><td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td><?php } ?>

        <?php if ($cod_cuentas_cobrar_abonos <> '0') { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/enviar_comprobante_ingreso_pagado_alquiler_correo_inquilino_reg.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&pagina=<?php echo $pagina_local;?>&cliente=<?php echo $cliente_inquilino;?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&buscar_por=<?php echo $buscar_por ?>"><img src=../imagenes/enviado_historia_clinica_correo.png alt="Adjuntar"><?php echo $cod_estado_envio_correo_comprobante_ingreso;?></a></td>
        <?php } else { ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td>
        <?php }  ?>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><?php echo $cod_cuentas_cobrar_alerta;?></td>
    </tr>
    <?php } ?>
</table>
</fieldset>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: left;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:11pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>PRESTAMOS (POR TERCERO)</strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT TERCERO: <?php echo $identificacion_tercero_inquilino; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE TERCERO: <?php echo $nombre_cliente_inquilino; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="1" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong>FACT</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:10pt;"><strong>CREDIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:10pt;"><strong>ABONAD</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>PENDIENTE</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>FECHA</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
<tr>
</tr>
<?php
$monto_deuda_smtr_1              = 0;
$abonado_smtr_1                  = 0;
$subtotal_smtr_1                 = 0;

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
$cliente                       = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
$abonado                       = $datos_cuenta_cobrar['abonado'];
$subtotal                      = $datos_cuenta_cobrar['subtotal'];
$mensaje                       = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                    = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                      = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr_1            = $monto_deuda_smtr_1 + $monto_deuda;
$abonado_smtr_1                = $abonado_smtr_1 + $abonado;
$subtotal_smtr_1               = $subtotal_smtr_1 + $subtotal;
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong><?php echo $cod_factura ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:15%; font-family: Courier; font-size:10pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
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
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL PENDIENTE:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
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
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cobdetallfact</td>
  </tr>
</table>

		</div>
	</div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
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
</body>
</html>