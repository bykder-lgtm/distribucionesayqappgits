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
<?php
$pagina                         = $_SERVER['PHP_SELF'];
$pagina_local                   = $_SERVER['PHP_SELF'];
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);
$palabra                        = addslashes($_GET['palabra']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
$fecha_hoy                      = date("Y-m-d");

$monto_deuda_smtr               = 0;
$abonado_smtr                   = 0;
$subtotal_smtr                  = 0;
?>
<div class="breadcrumbs">
<h4>
<a class="btn btn-primary" href="../admin/facturacion_alquiler_comision_propietario.php?palabra=<?php echo $palabra ?>">Regresar</a>
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

//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta,
tbl15_cuentas_cobrar.monto_deuda_sin_interes, tbl15_cuentas_cobrar.subtotal_sin_interes, tbl15_cuentas_cobrar.numero_cuota, tbl15_cuentas_cobrar.monto_cuota, 
tbl15_cuentas_cobrar.monto_cuota_sin_interes, tbl15_cuentas_cobrar.interes_ptj, tbl15_cuentas_cobrar.monto_cuota_interes,
tbl15_cuentas_cobrar.nombre_tipo_cobro, 
tbl15_cuentas_cobrar.cod_tipo_moneda, tbl15_cuentas_cobrar.clausula_alquiler, tbl15_cuentas_cobrar.cod_producto, 
tbl15_cuentas_cobrar.cod_producto_barra, tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_administrador, 
tbl15_cuentas_cobrar.url_img_orig_producto, tbl15_cuentas_cobrar.cod_estado_contrato
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_factura='$cod_factura') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
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
            <th style="text-align:center">ID</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $cod_factura ?></td>
            <?php if ($url_img_orig_producto <> '') { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/adjuntar_archivo.png" class="img-polaroid" alt=""></a></td><?php } ?>          
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar ?></td>
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
<legend>HISTORIAL DE PAGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="https://sucursalpersonas.transaccionesbancolombia.com/" target="_blank"><img src=../imagenes/btn_bancolobia.png alt="btn_bancolobia"></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="../admin/comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>&palabra=<?php echo $palabra ?>">REGRESAR</a>
</legend>
<table class="table table-bordered table-hover table-sm">
    <tr>
        <?php if ($cod_seguridad== '3') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ELIM</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">EDIT</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FACTURAR COMISION PROPIETARIO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">NUMERO DE PERIODO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">MES</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">PRECIO ALQUILER</th>
        <!--<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA LIMITE PAGO</th>-->
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">REG PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">CONSIGADO/EFECTIVO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ESTADO PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ENVIAR</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">EDIT ESTADO PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">CARGAR SOPORTE PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">VER</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">INCLUIR</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ID</th>
    </tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_factura = '$cod_factura') AND (cod_estado_archivado = '0') AND (cod_excluir_pago_propietario = '1') ORDER BY fecha_pago ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar_alerta                         = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar                                = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$numero_alerta                                     = $datos_cuenta_cobrar['numero_alerta'];
$cod_factura                                       = $datos_cuenta_cobrar['cod_factura'];
$monto_deuda                                       = $datos_cuenta_cobrar['monto_deuda'];
$abonado                                           = $datos_cuenta_cobrar['abonado'];
$subtotal                                          = $datos_cuenta_cobrar['subtotal'];
$mensaje                                           = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                                        = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                                          = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr                                  = $monto_deuda_smtr + $monto_deuda;
$monto_cuota                                       = $datos_cuenta_cobrar['monto_cuota'];
$cod_estado                                        = $datos_cuenta_cobrar['cod_estado'];
$hora_pago_reg                                     = $datos_cuenta_cobrar['hora_pago_reg'];
$cod_cuentas_cobrar_abonos                         = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
$total_pendiente                                   = $datos_cuenta_cobrar['total_pendiente'];
$cod_cuentas_cobrar_factura_comision_propietario   = $datos_cuenta_cobrar['cod_cuentas_cobrar_factura_comision_propietario'];

$fecha_mes                                         = $datos_cuenta_cobrar['fecha_mes'];
$nombre_tabla_anyo                                 = $datos_cuenta_cobrar['anyo'];
$cod_estado_envio_correo_cuenta_cobro              = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
$cod_estado_envio_correo_comprobante_ingreso       = $datos_cuenta_cobrar['cod_estado_envio_correo_comprobante_ingreso'];
$cod_estado_envio_correo_comision_propietario      = $datos_cuenta_cobrar['cod_estado_envio_correo_comision_propietario'];

$cod_estado_pago_const                             = 1;
$cod_tercero                                       = $datos_cuenta_cobrar['cod_tercero'];
$cod_estado_pago_propietario                       = $datos_cuenta_cobrar['cod_estado_pago_propietario'];
$fecha_mes_complet                                 = $fecha_mes.'-01';

$abonado_smtr                                      = $abonado_smtr + $abonado;
$subtotal_smtr                                     = $subtotal_smtr + $subtotal;
//$nombre_tabla_mes                                  = date("m", strtotime($fecha_pago));
$fecha_pago_dmy                                    = date("d-m-Y", strtotime($fecha_pago));
$nombre_tabla_mes                                  = date("m", strtotime($fecha_mes_complet));

$sql_cuentas_cobrar_factura_comision_propietario = "SELECT total_recibido, fecha_pago_reg, url_img_orig_producto FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$consulta_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
$matriz_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_cuentas_cobrar_factura_comision_propietario);

$total_recibido                                    = $matriz_cuentas_cobrar_factura_comision_propietario['total_recibido'];
$fecha_pago_reg                                    = $matriz_cuentas_cobrar_factura_comision_propietario['fecha_pago_reg'];
$url_img_orig_producto                             = $matriz_cuentas_cobrar_factura_comision_propietario['url_img_orig_producto'];

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes                            = $matriz_consulta['nombre_letra_tabla_mes'];

$sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado_pago_propietario'";
$consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
$matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

$nombre_estado_pago                                = $matriz_estado_pago['nombre_estado_pago'];
$color_fondo_celda_estado_pago                     = $matriz_estado_pago['color_fondo_celda_estado_pago'];
$color_letra_celda_estado_pago                     = $matriz_estado_pago['color_letra_celda_estado_pago'];

if ($url_img_orig_producto == '') { $existe_archivo_cargado = '0'; } else { $existe_archivo_cargado = '1'; }
if ($fecha_hoy == $fecha_pago) { $btn_imagen = 'base_caja_pago_hoy.gif'; } elseif ($fecha_hoy > $fecha_pago) { $btn_imagen = 'base_caja_pago_atrasado.gif'; } else { $btn_imagen = 'base_caja.png'; }
if ($fecha_pago_reg <> '') { $fecha_pago_reg_dmy = date("d-m-Y", strtotime($fecha_pago_reg)); } else { $fecha_pago_reg_dmy = ''; }
?>
    <tr id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>">
        <?php if ($cod_seguridad== '3') { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../modificar_eliminar/eliminar_cuentas_cobrar_y_abonos.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&palabra=<?php echo $palabra;?>"><img src=../imagenes/eliminar.png alt="Abonar"></a></td>
        <?php } ?>

        <?php if ($cod_cuentas_cobrar_factura_comision_propietario <> '0') { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/edit_cuentas_cobrar_abonos_alquiler_comprobante_comision_propietario.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago_const;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&palabra=<?php echo $palabra;?>"><img src=../imagenes/editar.png alt="editar"></a></td>
        <?php } else { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td>
        <?php }  ?>

        <?php if (($cod_cuentas_cobrar_factura_comision_propietario == '0')) { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/reg_comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina_local;?>&palabra=<?php echo $palabra;?>"><img src=../imagenes/<?php echo $btn_imagen;?> alt="Abonar"></a></td>
        <?php } elseif ($cod_estado_pago_propietario == '3') { ?><td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td><?php } 
        else { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/cuentas_cobrar_abonos_alquiler_comprobante_comision_propietario_imprimir_pdf.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>" target="_blank"><img src=../imagenes/imprimir_peq.png alt="Abonar"></a></td>
        <?php } ?>

        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo $numero_alerta;?></font></td>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo $nombre_letra_tabla_mes ;?></font></td>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo number_format($monto_cuota, 0, ",", ".") ?></font></a></td>
        <!--<td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo $fecha_pago_dmy;?></font></td>-->
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo $fecha_pago_reg_dmy;?></font></td>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo number_format($total_recibido, 0, ",", ".") ?></font></a></td>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo $nombre_estado_pago;?></font></td>
        <?php if ($cod_cuentas_cobrar_factura_comision_propietario <> '0') { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/enviar_comprobante_comision_propietario_pagado_alquiler_correo_inquilino_reg.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago_const;?>&pagina=<?php echo $pagina_local;?>&palabra=<?php echo $palabra;?>&cliente=<?php echo $cliente_inquilino;?>"><img src=../imagenes/enviado_historia_clinica_correo.png alt="Adjuntar"><?php echo $cod_estado_envio_correo_comision_propietario;?></a></td>
        <?php } else { ?><td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td><?php }  ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/edit_estado_pago_comision_propietario.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago_const;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&palabra=<?php echo $palabra;?>"><img src=../imagenes/editar.png alt="editar"></a></td>
        
        <?php if (($cod_cuentas_cobrar_factura_comision_propietario <> '0')) { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="../admin/comision_propietario_soporte_pago_archivo_adjunto.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago_const;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina;?>&palabra=<?php echo $palabra;?>"><img src=../imagenes/adjuntar_archivo.png alt="Adjuntar"><?php echo $existe_archivo_cargado;?></a></td>
        <?php } else { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td>
        <?php } ?>
        
        <?php if ($url_img_orig_producto) { ?><td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>
        <?php } else { ?>
        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"></td>
        <?php } ?>

        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" class="service_list" data="<?php echo $cod_cuentas_cobrar_alerta ?>"><a class="incluir_estado_pago_propietario" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><img src="../imagenes/correcto.png" class="img-polaroid" alt=""></a></td>

        <td id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>" style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 17px"><font size='3'><?php echo $cod_cuentas_cobrar_alerta;?></font></td>
    </tr id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>">
    <?php } ?>
</table>
</fieldset>
<br>

<script type="text/javascript">
$(document).ready(function() {

    $('.incluir_estado_pago_propietario').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_cuentas_cobrar_alerta = $(this).parent().attr('data');
        var tab = 'tbl15_cuentas_cobrar_alerta_cod_excluir_pago_propietario_excluido';
        var campo = 'cod_cuentas_cobrar_alerta';
        var tipo = 'eliminar';
        var dataString = 'llave='+cod_cuentas_cobrar_alerta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo='+tipo;

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success:function(respuesta){ 
                var total_gasto_venta_format = respuesta.total_gasto_format;
                var afectado = respuesta.afectado;
                var mensaje = respuesta.mensaje;
                          
                $('#cod_cuentas_cobrar_alerta'+cod_cuentas_cobrar_alerta).fadeOut("slow");
                $('#tr'+cod_cuentas_cobrar_alerta).fadeOut("slow");
                
            }
        });
    });

});
</script>
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